<?php
session_start();
require_once dirname(__DIR__) . '/function/generic.php';
require_once dirname(__DIR__) . '/config/connexion.php';

header('Content-Type: application/json');

$response = [
    'success' => false,
    'message' => 'Erreur lors de la soumission du formulaire'
];

if (isset($_POST['connexion'])) {
    if (!empty($_POST['loginPseudo']) && !empty($_POST['loginPassword'])) {
        $pseudo = htmlspecialchars($_POST['loginPseudo']);
        $password = $_POST['loginPassword'];
        $recupUser = request($conn, "SELECT * FROM user WHERE pseudo = '$pseudo'");

        if ($recupUser->rowCount() > 0) {
            $user = $recupUser->fetch();
            // Vérification du mot de passe avec password_verify()
            if (password_verify($password, $user['password'])) {
                $_SESSION['pseudo'] = $pseudo;
                $_SESSION['id'] = $user['id'];
                $_SESSION['role'] = $user['role'];

                $response['success'] = true;
                if ($_SESSION['role'] == 'moderateur') {
                    // Redirection vers la page d'administration
                    $response['redirect'] = '/admin/dashboard';
                } else {
                    // Redirection vers la page d'accueil
                    $response['redirect'] = '/';
                }
            } else {
                $response['message'] = 'Le pseudo ou le mot de passe est incorrect.';
            }
        } else {
            $response['message'] = 'Le pseudo ou le mot de passe est incorrect.';
        }
    } else {
        $response['message'] = 'Veuillez remplir tous les champs.';
    }
} else {
    $response['message'] = 'Erreur lors de la soumission du formulaire.';
}

echo json_encode($response);
