<?php

// Évite les injections de code dans les inputs
function sanitizeInput($input)
{
    return htmlspecialchars(addslashes($input));
}

function requestOne($conn, $request)
{
    // Vérifie si la connexion à la base de données est valide
    if ($conn) {
        // Prépare la requête SQL avec PDO
        $pdo_request = $conn->prepare($request);

        // Vérifie si l'exécution de la requête a réussi et si c'est une requête SELECT
        if ($pdo_request->execute() && strtolower(substr($request, 0, 6)) == "select") {
            // Récupère la première ligne de résultat sous forme d'objet PDO
            $resultData = $pdo_request->fetch(PDO::FETCH_OBJ);
            return $resultData;
        } else {
            // Si ce n'est pas une requête SELECT ou s'il y a une erreur, retourne le code d'erreur PDO
            return $pdo_request->errorCode() != "00000";
        }
    } else {
        // Si la connexion à la base de données n'est pas valide, retourne un message d'erreur
        return "DB :: Merci de vérifier l'accès à votre base de données.";
    }
}


function request($conn, $request)
{
    // Vérifie si la connexion à la base de données est valide
    if ($conn) {
        // Prépare la requête SQL avec PDO
        $pdo_request = $conn->prepare($request);

        // Vérifie le type de requête et exécute en conséquence
        if ($pdo_request->execute() && strtolower(substr($request, 0, 6)) == "select") {
            // Retourne l'objet PDOStatement pour les requêtes SELECT
            return $pdo_request;
        } elseif (strtolower(substr($request, 0, 6)) == "insert") {
            // Retourne l'ID généré par la dernière opération d'INSERT dans la connexion
            return $conn->lastInsertId();
        } elseif (strtolower(substr($request, 0, 6)) == "update") {
            // Retourne le nombre de lignes affectées par la requête UPDATE
            return $pdo_request->rowCount();
        } else {
            // Si ce n'est pas un SELECT, INSERT ou UPDATE ou s'il y a une erreur, retourne le code d'erreur PDO
            return $pdo_request->errorCode() != "00000";
        }
    } else {
        // Si la connexion à la base de données n'est pas valide, retourne un message d'erreur
        return "DB :: Merci de vérifier l'accès à votre base de données.";
    }
}



function redirectTo($location)
{
    header("Location: $location");
    exit();
}
