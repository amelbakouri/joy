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
                $pseudo = htmlspecialchars($_POST['pseudo']);
                $email = htmlspecialchars($_POST['email']);

                // Vérification de l'existence du pseudo et de l'e-mail, en excluant l'utilisateur actuel
                $pseudoCheck = requestOne($conn, "SELECT COUNT(*) AS count FROM `user` WHERE `pseudo` = '$pseudo' AND `id` != $userID");
                $emailCheck = requestOne($conn, "SELECT COUNT(*) AS count FROM `user` WHERE `email` = '$email' AND `id` != $userID");

                $pseudoExists = $pseudoCheck['count'] > 0;
                $emailExists = $emailCheck['count'] > 0;

                if ($pseudoExists || $emailExists) {
                    header('Content-Type: application/json');
                    echo json_encode([
                        'pseudo_exists' => $pseudoExists,
                        'email_exists' => $emailExists
                    ]);
                    break;
                }

                $name = htmlspecialchars($_POST['name']);
                $lname = htmlspecialchars($_POST['lname']);
                request($conn, "UPDATE `user` SET `pseudo` = '$pseudo', `name` = '$name', `lname` = '$lname', `email` = '$email' WHERE `id` = $userID");

                // Réponse de succès
                header('Content-Type: application/json');
                echo json_encode(['success' => true]);
                break;
            case "changePassword":
                $pseudo = htmlspecialchars($_POST['pseudo']);
                $oldPassword = htmlspecialchars($_POST['oldPassword']);
                $newPassword = htmlspecialchars($_POST['newPassword']);
                $confirmPassword = htmlspecialchars($_POST['confirmPassword']);

                $stmt = $conn->prepare("SELECT `password` FROM `user` WHERE `pseudo` = :pseudo");
                $stmt->execute([':pseudo' => $pseudo]);
                $userData = $stmt->fetch(PDO::FETCH_ASSOC);
                $password = $userData['password'];

                $response = ['success' => false, 'message' => ''];

                if (password_verify($oldPassword, $password)) {
                    if ($newPassword === $confirmPassword) {
                        $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);
                        update($conn, 'user', [
                            'password' => $hashedPassword
                        ], [
                            'pseudo' => $pseudo
                        ]);
                        $response['success'] = true;
                        $response['message'] = 'Mot de passe modifié avec succès.';
                    } else {
                        $response['message'] = 'Les nouveaux mots de passe ne correspondent pas.';
                    }
                } else {
                    $response['message'] = 'Mot de passe actuel incorrect.';
                }

                header('Content-Type: application/json');
                echo json_encode($response);
                break;
            case "deleteAccount":
                // Récupérer le mot de passe actuel de l'utilisateur avec l'ID donné
                $userData = requestOne($conn, "SELECT `password` FROM `user` WHERE `id` = $userID");
                $password = $userData['password'];
                $passwordVerify = $_POST['passwordVerify'];

                if (password_verify($passwordVerify, $password)) {
                    request($conn, "DELETE FROM user WHERE id = $userID");
                    session_destroy();
                    header('Content-Type: application/json');
                    echo json_encode(['success' => true]);
                } else {
                    header('Content-Type: application/json');
                    echo json_encode(['success' => false, 'message' => 'Le mot de passe est incorrect.']);
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
                        break;
                    }
                } else {
                    // Gérer l'erreur si les données du formulaire sont manquantes
                    echo '<script>alert("Données manquantes pour mettre à jour le rôle."); window.location.href = "/admin/dashboard.php";</script>';
                    break;
                }
                break;
        }
    }
}
