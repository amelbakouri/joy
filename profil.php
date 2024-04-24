<?php
require_once 'utilities/head.php';
require_once 'utilities/nav.php';
require_once 'authentification/auth.php';
?>


<div class="container mt-6">
    <div class="row justify-content-center">
        <div class="col-lg-5 col-md-7 col-sm-10">
            <div class="card">
                <ul class="list-group list-group-flush">
                    <li class="list-group-item rounded-top-4 param bg-dark-pink text-center "><a href="informations">Modifier vos informations</a></li>
                    <li class="list-group-item param bg-dark-pink text-center"><a href="#" id="click">Changer de mot de passe</a></li>
                    <li class="list-group-item param bg-dark-pink text-center"><a href="historique">Historique des posts</a></li>
                    <li class="list-group-item param bg-dark-pink text-center"><a href="#" data-bs-toggle="modal" data-bs-target="#deleteAccount">Supprimer votre compte</a></li>
                    <li class="list-group-item param bottom bg-dark-pink text-center"><a href="contact">Nous contacter</a></li>
                    <li class="list-group-item rounded-bottom-4 param bg-dark-pink text-center"><a href="#" data-bs-toggle="modal" data-bs-target="#confirmLogoutModal">Déconnexion</a></li>
                </ul>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="confirmLogoutModal" tabindex="-1" aria-labelledby="confirmLogoutModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content bg-dark-pink" style="margin-top: 53%;">
            <div class="modal-header">
                <h5 class="modal-title" id="confirmLogoutModalLabel">Confirmation de déconnexion</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center">
                Êtes-vous sûr de vouloir vous déconnecter ?
            </div>
            <div class="modal-footer d-flex justify-content-center">
                <a href="/authentification/logout.php" class="btn bg-logo-color color-light-pink">Déconnexion</a>
            </div>
        </div>
    </div>
</div>

<?php
require_once 'utilities/components/changePassword.php';
require_once 'utilities/components/deleteAccount.php';
?>

<?php
require_once 'utilities/footer.php';
?>