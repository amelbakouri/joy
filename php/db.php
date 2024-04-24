<?php
session_start();
require_once dirname(__DIR__) . '/function/generic.php';
require_once dirname(__DIR__) . '/config/connexion.php';
$userID = $_SESSION['id'];
$password = $_SESSION['password'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["form_name"])) {
        $form_name = $_POST["form_name"];

        switch ($form_name) {
            case "creer":
                $content = sanitizeInput($_POST["textareaPost"]);
                request($conn, "INSERT INTO posts (content, userID) VALUES ('$content', '$userID')");
                redirectTo("/");
                break;
            case "informations":
                $name = sanitizeInput($_POST['name']);
                $lname = sanitizeInput($_POST['lname']);
                $pseudo = sanitizeInput($_POST['pseudo']);
                $email = sanitizeInput($_POST['email']);
                request($conn, "UPDATE `user` SET `pseudo` = '$pseudo', `name` = '$name', `lname` = '$lname',  `email` = '$email' WHERE `id` = $userID");
                redirectTo("/informations");
                break;
            case "changePassword":
                $oldPassword = sanitizeInput($_POST['oldPassword']);
                $newPassword = sanitizeInput($_POST['newPassword']);
                $confirmPassword = sanitizeInput($_POST['confirmPassword']);
                if (password_verify($oldPassword, $password)) {
                    if ($newPassword === $confirmPassword) {
                        $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);
                        request($conn, "UPDATE `user` SET `password` = '$hashedPassword' WHERE `id` = $userID");
                        redirectTo("/profil");
                    }
                }
                break;
            case "deleteAccount":
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
            case "modifierPost":
                $postID = $_POST['postID'];
                $newContent = sanitizeInput($_POST['content']);
                request($conn, "UPDATE posts SET content = '$newContent ' WHERE id = $postID");
                redirectTo("/historique");
                break;
            case "deletePost":
                $postID = $_POST['postID'];
                request($conn, "DELETE FROM posts WHERE id = $postID");
                redirectTo("/historique");
                break;
        }
    }
}
