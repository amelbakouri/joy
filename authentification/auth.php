<?php
session_start();

// Vérifie si l'utilisateur est connecté
if (!isset($_SESSION['pseudo'])) {
    // Redirige vers la racine du site
    header('Location: /login.php');
    exit(); // Assure que le script s'arrête après la redirection
}


// Durée de la session en secondes 
$session_duration = 3600; // 1 heure

// Vérifie si le timestamp de la dernière activité est défini dans la session
if (isset($_SESSION['last_activity'])) {
    // Calcule le temps écoulé depuis la dernière activité
    $elapsed_time = time() - $_SESSION['last_activity'];
    // Si le temps écoulé dépasse la durée de session autorisée, déconnecte l'utilisateur
    if ($elapsed_time > $session_duration) {
        // Détruit toutes les données de session
        session_unset();
        session_destroy();
        // Redirige vers la page d'accueil
        header('Location: /');
        exit(); // Assure que le script s'arrête après la redirection
    }
}

// Met à jour le timestamp de la dernière activité de l'utilisateur
$_SESSION['last_activity'] = time();
