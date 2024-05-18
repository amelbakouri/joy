<?php
session_start();

// Vérifie si l'utilisateur est déjà connecté
if (isset($_SESSION['pseudo'])) {
    // Redirige vers la page d'accueil
    redirectTo('/');
}

require_once 'utilities/head.php';
?>

<?php
require_once 'utilities/components/account/inscriptionForm.php';
require_once 'utilities/components/account/connexionForm.php';
?>


<script src="js/account/login.js"></script>

<?php
require_once 'utilities/footer.php';
?>