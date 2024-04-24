<?php

require "config.php";
// Fonction qui permet de se connecter  à la base de données
// le fetch_assoc permet de ne pas avoir de repetitions
// try : essaie de se connecter, catch: s'il n'y arrive pas il envoit une message d'erreur qui
//  explique où est l'erreur

function getPDOlink()
{
    if (isset($_ENV['sqlConnector'])) {
        try {
            $pdo = new PDO('mysql:host=' . $_ENV['sqlConnector']["dbHost"] . ';dbname=' . $_ENV['sqlConnector']["dbName"], $_ENV['sqlConnector']["dbUser"], $_ENV['sqlConnector']["dbPass"]);
            $pdo->exec("SET NAMES utf8mb4");
        } catch (Exception $e) {
            die('Erreur : ' . $e->getMessage());
        }
        return $pdo;
    } else {
        return false;
    }
}

// Utilisation de la fonction getPDOlink pour obtenir la connexion PDO
$conn = getPDOlink();
