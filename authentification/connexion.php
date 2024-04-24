<?php
session_start();
require_once dirname(__DIR__) . '/function/generic.php';
require_once dirname(__DIR__) . '/config/connexion.php';

if (isset($_POST['connexion'])) {
    if (!empty($_POST['pseudo']) and !empty($_POST['password'])) {
        $pseudo = sanitizeInput($_POST['pseudo']);
        $password = $_POST['password'];
        $recupUser = request($conn, "SELECT * FROM user WHERE pseudo = '$pseudo'");

        if ($recupUser->rowCount() > 0) {
            $user = $recupUser->fetch();
            // Vérification du mot de passe avec password_verify()
            if (password_verify($password, $user['password'])) {
                $_SESSION['pseudo'] = $pseudo;
                $_SESSION['id'] = $user['id'];
                $_SESSION['password'] = $user['password'];

                // Redirection vers la page d'accueil
                header('Location: /');
                exit(); // Assure que le script s'arrête après la redirection
            } else {
                echo 'Votre mot de passe est incorrect';
            }
        } else {
            echo 'Aucun utilisateur trouvé avec ce pseudo';
        }
    } else {
        echo 'Veuillez remplir tous les champs';
    }
} else {
    echo 'Erreur lors de la soumission du formulaire';
}
