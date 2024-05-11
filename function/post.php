<?php
function getComments($conn, $postID)
{
    // Récupérer les commentaires pour le post spécifié
    $comments = request($conn, "SELECT * FROM commentaires AS c INNER JOIN user ON c.userID = user.id WHERE postID = $postID  ORDER BY commentID DESC");

    // Initialiser un tableau pour stocker les commentaires
    $commentList = [];

    // Parcourir les résultats et ajouter les commentaires au tableau
    while ($row = $comments->fetch()) {
        // Ajouter chaque commentaire avec le pseudo au tableau
        $commentList[] = [
            'commentaire' => $row['commentaire'],
            'date' => $row['date'],
            'commentID' => $row['commentID'],
            'pseudo' => $row['pseudo']
        ];
    }

    // Retourner le tableau des commentaires
    return $commentList;
}

// Vérifie si l'utilisateur a aimé le post
function userHasLikedPost($conn, $userID, $postID)
{
    // Exécutez une requête pour vérifier si une entrée existe dans votre table de likes
    $stmt = $conn->prepare("SELECT COUNT(*) FROM postlikes WHERE userID = $userID AND postID = $postID");
    $stmt->execute();
    $count = $stmt->fetchColumn(); // Récupère la première colonne de la prochaine ligne dans le jeu de résultats
    return $count > 0;
}

function getCommentCount($conn, $postID)
{
    $stmt = $conn->prepare("SELECT COUNT(*) AS comment_count FROM commentaires WHERE postID = ?");
    $stmt->execute([$postID]);
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    $comm = $result['comment_count'];

    $stmt = $conn->prepare("SELECT COUNT(*) AS reply_count FROM replies WHERE postID = ?");
    $stmt->execute([$postID]);
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    $reply = $result['reply_count'];

    $total = $comm + $reply;
    return $total;
}

function getReplies($conn, $commentID)
{
    $replies = array();

    // Requête SQL pour récupérer les réponses à partir de la base de données
    $query = "SELECT * FROM replies AS r JOIN user ON r.userID = user.id WHERE commentID = :commentID";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':commentID', $commentID, PDO::PARAM_INT);
    $stmt->execute();

    // Parcours des résultats de la requête et construction du tableau de réponses
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {

        $reply = array(
            'id' => $row['id'],
            'commentID' => $row['commentID'],
            'userID' => $row['userID'],
            'pseudo' => $row['pseudo'],
            'replyText' => $row['replyText'],
            'replyDate' => $row['replyDate']
        );
        $replies[] = $reply;
    }

    return $replies;
}

