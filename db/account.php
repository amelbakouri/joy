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
        }
    }
}
