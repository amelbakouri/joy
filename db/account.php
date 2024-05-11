<?php
session_start();
require_once dirname(__DIR__) . '/function/generic.php';
require_once dirname(__DIR__) . '/config/connexion.php';
$userID = $_SESSION['id'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["form_name"])) {
        $form_name = $_POST["form_name"];

        switch ($form_name) {
            case "informations":
                $name = htmlspecialchars($_POST['name']);
                $lname = htmlspecialchars($_POST['lname']);
                $pseudo = htmlspecialchars($_POST['pseudo']);
                $email = htmlspecialchars($_POST['email']);
                request($conn, "UPDATE `user` SET `pseudo` = '$pseudo', `name` = '$name', `lname` = '$lname',  `email` = '$email' WHERE `id` = $userID");
                redirectTo("/informations");
                break;
            case "changePassword":
                // Récupérer le mot de passe actuel de l'utilisateur avec l'ID donné
                $userResult = request($conn, "SELECT `password` FROM `user` WHERE `id` = $userID");
                $userData = $userResult->fetch(PDO::FETCH_ASSOC);
                $password = $userData['password'];


                $oldPassword = htmlspecialchars($_POST['oldPassword']);
                $newPassword = htmlspecialchars($_POST['newPassword']);
                $confirmPassword = htmlspecialchars($_POST['confirmPassword']);
                if (password_verify($oldPassword, $password)) {
                    if ($newPassword === $confirmPassword) {
                        $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);
                        request($conn, "UPDATE `user` SET `password` = '$hashedPassword' WHERE `id` = $userID");
                        redirectTo("/profil");
                    }
                }
                break;
            case "deleteAccount":
                // Récupérer le mot de passe actuel de l'utilisateur avec l'ID donné
                $userResult = request($conn, "SELECT `password` FROM `user` WHERE `id` = $userID");
                $userData = $userResult->fetch(PDO::FETCH_ASSOC);
                $password = $userData['password'];
                $passwordVerify = $_POST['passwordVerify'];
                if (password_verify($passwordVerify, $password)) {
                    request($conn, "DELETE FROM user WHERE id = $userID");
                    session_destroy();
                    redirectTo("/");
                } else {
                    echo '<script>alert("Le mot de passe est incorrect."); window.location.href = "/profil.php";</script>';
                    exit();
                }
                break;
            case "updateRole":
                // Mettre à jour le rôle de l'utilisateur
                if (isset($_POST['user_id']) && isset($_POST['role'])) {
                    $user_id = $_POST['user_id'];
                    $role = $_POST['role'];

                    // Assurez-vous que le rôle est valide pour éviter les failles de sécurité
                    $validRoles = ['utilisateur', 'moderateur'];
                    if (in_array($role, $validRoles)) {
                        request($conn, "UPDATE `user` SET `role` = '$role' WHERE `id` = $user_id");
                        redirectTo("/admin/dashboard.php");
                    } else {
                        // Gérer l'erreur si le rôle n'est pas valide
                        echo '<script>alert("Le rôle sélectionné n\'est pas valide."); window.location.href = "/admin/dashboard.php";</script>';
                        exit();
                    }
                } else {
                    // Gérer l'erreur si les données du formulaire sont manquantes
                    echo '<script>alert("Données manquantes pour mettre à jour le rôle."); window.location.href = "/admin/dashboard.php";</script>';
                    exit();
                }
                break;
        }
    }
}
