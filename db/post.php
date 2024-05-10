<?php
session_start();
require_once dirname(__DIR__) . '/function/generic.php';
require_once dirname(__DIR__) . '/function/post.php';
require_once dirname(__DIR__) . '/config/connexion.php';
$userID = $_SESSION['id'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["form_name"])) {
        $form_name = $_POST["form_name"];

        switch ($form_name) {
            case "creer":
                $content = htmlspecialchars($_POST["textareaPost"]);
                // Données à insérer
                $data = array(
                    'content' => $content,
                    'userID' => $userID
                );

                // Appel de la fonction insertData
                insertData($conn, 'posts', $data);

                redirectTo("/");
                break;
            case "modifierPost":
                $postID = $_POST['postID'];
                $newContent = htmlspecialchars($_POST['content']);
                request($conn, "UPDATE posts SET content = '$newContent ' WHERE id = $postID");
                redirectTo("/historique");
                break;
            case "deletePost":
                $postID = $_POST['postID'];
                request($conn, "DELETE FROM posts WHERE id = $postID");
                header("Location: " . $_SERVER["HTTP_REFERER"]);
                exit;
                break;
            case "like":
                $postID = $_POST['postID'];
                $isLiked = isset($_POST['like']);

                if ($isLiked) {
                    request($conn, "INSERT INTO postlikes (userID, postID) VALUES ($userID, $postID)");
                } else {
                    request($conn, "DELETE FROM postlikes WHERE userID = $userID AND postID = $postID");
                }

                // Réponse AJAX au client
                header('Content-Type: application/json');
                echo json_encode(['success' => true]);
                exit();
                break;
            case "get_like_count":
                $postID = $_POST['postID'];
                $likeCount = requestOne($conn, "SELECT COUNT(*) AS like_count FROM postlikes WHERE postID = $postID")->like_count;
                // Réponse AJAX au client
                header('Content-Type: application/json');
                echo json_encode(['success' => true, 'like_count' => $likeCount]);
                exit();
                break;

            case "signalement":
                $postID = $_POST['postID'];
                $commentaire = htmlspecialchars($_POST['commentaire']);

                $data = array('userID' => $userID, 'postID' => $postID, 'commentaire' => $commentaire);
                insertData($conn, 'signalements', $data);
                redirectTo("/");
                break;
            case "deleteSign":
                $postID = $_POST['postID'];
                request($conn, "DELETE FROM signalements WHERE postID = $postID");
                header("Location: " . $_SERVER["HTTP_REFERER"]);
                exit;
                break;
        }
    }
}
