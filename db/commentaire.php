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
            case "add_comment":
                $postID = $_POST['postID'];
                $commentaire = htmlspecialchars($_POST['commentaire']);
                $pseudo = $_SESSION['pseudo']; // Supposons que le pseudo soit stocké en session

                // Insérer le commentaire dans la base de données
                $data = array(
                    'postID' => $postID,
                    'userID' => $userID,
                    'commentaire' => $commentaire
                );

                if (insertData($conn, 'commentaires', $data)) {
                    // Concaténer le pseudo et le commentaire
                    $commentaireAvecPseudo = $pseudo . ': ' . $commentaire;

                    // Répondre au client avec le commentaire formaté
                    header('Content-Type: application/json');
                    echo json_encode(['success' => true, 'commentaire' => $commentaireAvecPseudo]);
                    exit();
                } else {
                    // Répondre au client avec une erreur
                    header('Content-Type: application/json');
                    echo json_encode(['success' => false, 'error' => 'Erreur lors de l\'insertion du commentaire']);
                    exit();
                }
                break;

            case "get_comments":
                $postID = $_POST['postID'];
                $commentList = getComments($conn, $postID);

                // Ajoutez une vérification pour chaque commentaire s'il a des réponses
                foreach ($commentList as &$comment) {
                    $commentID = $comment['commentID'];
                    $replies = getReplies($conn, $commentID);
                    $comment['hasReplies'] = count($replies) > 0;
                    $comment['tempsEcoule'] = temps_ecoule($comment['date']);
                }

                // Répondre au client avec la liste des commentaires mise à jour
                header('Content-Type: application/json');
                echo json_encode(['success' => true, 'commentList' => $commentList]);
                exit();
                break;
            case "add_reply":
                $commentID = $_POST['replyToCommentID'];
                $postID = $_POST['postID'];
                $replyText = htmlspecialchars($_POST['replyText']);

                // Insérer la réponse dans la base de données
                $data = array(
                    'commentID' => $commentID,
                    'postID' => $postID,
                    'userID' => $userID,
                    'replyText' => $replyText
                );

                if (insertData($conn, 'replies', $data)) {
                    // Répondre au client avec un succès
                    header('Content-Type: application/json');
                    echo json_encode(['success' => true]);
                    exit();
                } else {
                    // Répondre au client avec une erreur
                    header('Content-Type: application/json');
                    echo json_encode(['success' => false, 'error' => 'Erreur lors de l\'insertion de la réponse']);
                    exit();
                }

                break;
            case "get_replies":
                $commentID = $_POST['commentID'];
                $replies = getReplies($conn, $commentID);

                // Répondre au client avec la liste des réponses
                header('Content-Type: application/json');
                echo json_encode(['success' => true, 'replies' => $replies]);
                exit();
                break;
        }
    }
}