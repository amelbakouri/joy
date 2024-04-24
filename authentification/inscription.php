<?php
session_start();
require_once dirname(__DIR__) . '/function/generic.php';
require_once dirname(__DIR__) . '/config/connexion.php';

if (isset($_POST['inscription'])) {
    $pseudo = sanitizeInput($_POST['pseudo']);
    $name = sanitizeInput($_POST['name']);
    $lname = sanitizeInput($_POST['lname']);
    $email = sanitizeInput($_POST['email']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $confirmPassword = $_POST['confirmPassword'];

    // Vérifier si les mots de passe correspondent
    if ($_POST['password'] !== $confirmPassword) {
        echo '<script>alert("Les mots de passe ne correspondent pas."); window.location.href = "/login.php";</script>';
        exit(); // Arrêter le script
    }

    // Vérifier si le pseudo est déjà pris
    $existingPseudo = request($conn, "SELECT * FROM user WHERE pseudo = '$pseudo'");

    if ($existingPseudo->rowCount() > 0) {
        echo '<script>alert("Le pseudo est déjà pris."); window.location.href = "/login.php";</script>';
    } else {
        // Vérifier si l'e-mail existe déjà
        $existingEmail = request($conn, "SELECT * FROM user WHERE email = '$email'", );

        if ($existingEmail->rowCount() > 0) {
            echo '<script>alert("L\'e-mail existe déjà."); window.location.href = "/login.php";</script>';
        } else {
            // Inscription de l'utilisateur
            request($conn, "INSERT INTO user (pseudo, name, lname, email, password) VALUES ('$pseudo', '$name', '$lname', '$email', '$password')");

            // Récupération de l'utilisateur enregistré
            $recupUser = request($conn, "SELECT * FROM user WHERE pseudo = '$pseudo'");

            if ($recupUser->rowCount() > 0) {
                $user = $recupUser->fetch();
                $_SESSION['pseudo'] = $user['pseudo'];
                $_SESSION['password'] = $user['password'];
                $_SESSION['id'] = $user['id'];
                // Redirection vers la page d'accueil
                header('Location: /');
                exit(); // Assure que le script s'arrête après la redirection
            } else {
                echo '<script>alert("Erreur, veuillez recommencer."); window.location.href = "/login.php";</script>';
            }
        }
    }
} else {
    echo '<script>alert("Erreur, veuillez recommencer."); window.location.href = "/login.php";</script>';
}
