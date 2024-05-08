<?php
session_start();
require_once dirname(__DIR__) . '/function/generic.php';
require_once dirname(__DIR__) . '/config/connexion.php';

if (isset($_POST['connexion'])) {
    if (!empty($_POST['loginPseudo']) and !empty($_POST['loginPassword'])) {
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


                // Vérification du rôle pour l'accès à la page d'administration
                if ($_SESSION['role'] == 'moderateur') {
                    // Redirection vers la page d'administration
                    redirectTo('/admin/dashboard');
                } else {
                    // Redirection vers la page d'accueil
                    redirectTo('/');
                }
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
