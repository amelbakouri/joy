<?php
session_start();

// Vérifie si l'utilisateur est déjà connecté
if (isset($_SESSION['pseudo'])) {
    // Redirige vers la page d'accueil
    header('Location: /');
    exit(); // Assure que le script s'arrête après la redirection
}

require_once 'utilities/head.php';
?>

<?php
require_once 'utilities/components/account/inscriptionForm.php';
require_once 'utilities/components/account/connexionForm.php';
?>



<?php
require_once 'utilities/footer.php';
?>
<script src="js/login.js"></script>