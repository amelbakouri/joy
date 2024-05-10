<?php

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

// Fonction d'insertion générique
function insertData($conn, $table, $data)
{

    // Création de la chaîne de paramètres pour la requête
    $fields = implode(', ', array_keys($data));
    $placeholders = ':' . implode(', :', array_keys($data));

    // Requête préparée
    $stmt = $conn->prepare("INSERT INTO $table ($fields) VALUES ($placeholders)");

    // Liaison des paramètres
    foreach ($data as $key => &$value) {
        $stmt->bindParam(":$key", $value);
    }

    // Exécution de la requête
    if ($stmt->execute()) { // Exécute la requête préparée
        return true; // Retourne vrai si l'exécution réussit
    } else {
        return false; // Retourne faux si l'exécution échoue
    }
}

// Fonction de redirection
function redirectTo($location)
{
    header("Location: $location");
    exit();
}

// Affiche le temps écoulé depuis la publication
function temps_ecoule($date)
{
    date_default_timezone_set('Europe/Paris');

    $temps_actuel = time();

    $temps = strtotime($date);

    $difference = $temps_actuel - $temps;

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
