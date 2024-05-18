<?php
session_start();
require_once dirname(__DIR__) . '/function/generic.php';
require_once dirname(__DIR__) . '/config/connexion.php';

if (isset($_POST['inscription'])) {
    $pseudo = htmlspecialchars($_POST['pseudo']);
    $name = htmlspecialchars($_POST['name']);
    $lname = htmlspecialchars($_POST['lname']);
    $email = htmlspecialchars($_POST['email']);
    $password = password_hash($_POST['newPassword'], PASSWORD_DEFAULT);
    $confirmPassword = $_POST['confirmNewPassword'];

    // Vérification de l'existence du pseudo et de l'e-mail
    $pseudoCheck = requestOne($conn, "SELECT COUNT(*) AS count FROM `user` WHERE `pseudo` = '$pseudo'");
    $emailCheck = requestOne($conn, "SELECT COUNT(*) AS count FROM `user` WHERE `email` = '$email'");

    $pseudoExists = $pseudoCheck['count'] > 0;
    $emailExists = $emailCheck['count'] > 0;

    if ($pseudoExists || $emailExists) {
        header('Content-Type: application/json');
        echo json_encode([
            'pseudo_exists' => $pseudoExists,
            'email_exists' => $emailExists
        ]);
        exit();
    }

    // Inscription de l'utilisateur
    // Données à insérer
    $data = array(
        'pseudo' => $pseudo,
        'name' => $name,
        'lname' => $lname,
        'email' => $email,
        'password' => $password
    );

    // Appel de la fonction insertData
    insertData($conn, 'user', $data);

    // Récupération de l'utilisateur enregistré
    $recupUser = request($conn, "SELECT * FROM user WHERE pseudo = '$pseudo'");

    if ($recupUser->rowCount() > 0) {
        $user = $recupUser->fetch();
        $_SESSION['pseudo'] = $user['pseudo'];
        $_SESSION['id'] = $user['id'];
        $_SESSION['role'] = $user['role'];
        // Réponse de succès
        header('Content-Type: application/json');
        echo json_encode(['success' => true]);
        exit();
    } else {
        header('Content-Type: application/json');
        echo json_encode(['success' => false, 'error' => 'Erreur lors de l\'inscription']);
        exit();
    }
} else {
    header('Content-Type: application/json');
    echo json_encode(['success' => false, 'error' => 'Erreur de requête']);
    exit();
}
