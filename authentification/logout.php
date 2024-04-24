<?php
session_start();

// Détruit toutes les données de session
session_unset();
session_destroy();

// Redirige vers la page d'accueil
header('Location: /');
exit();
