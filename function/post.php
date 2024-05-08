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
    return $result['comment_count'];
}

// Affiche le temps écoulé depuis la publication
function temps_ecoule($date_publication)
{
    date_default_timezone_set('Europe/Paris');

    $temps_actuel = time();

    $temps_publication = strtotime($date_publication);

    $difference = $temps_actuel - $temps_publication;

    // Convertir la différence en temps plus convivial
    if ($difference < 60) {
        return "Il y a quelques instants";
    } elseif ($difference < 3600) {
        $minutes = round($difference / 60);
        return "$minutes m";
    } elseif ($difference < 86400) {
        $heures = round($difference / 3600);
        return "$heures h";
    } else {
        $jours = round($difference / 86400);
        return "$jours j";
    }
}


function getReplies($conn, $commentID)
{
    $replies = array();

    // echo "Comment ID: " . $commentID; // Cette instruction d'écho est en commentaire
    // echo "Nombre de réponses trouvées: " . $stmt->rowCount(); // Cette instruction d'écho est en commentaire

    // Requête SQL pour récupérer les réponses à partir de la base de données
    $query = "SELECT * FROM replies AS r JOIN user ON r.userID = user.id WHERE commentID = :commentID";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':commentID', $commentID, PDO::PARAM_INT);
    $stmt->execute();

    // Parcours des résultats de la requête et construction du tableau de réponses
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        // var_dump($row); // Cette instruction de var_dump est en commentaire

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

    // var_dump($replies); // Cette instruction de var_dump est en commentaire

    return $replies;
}
