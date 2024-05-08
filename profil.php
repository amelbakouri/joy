<?php
require_once 'utilities/head.php';
require_once 'utilities/nav.php';
?>


<div class="container mt-6">
    <div class="row justify-content-center">
        <div class="col-lg-5 col-md-7 col-sm-10">
            <div class="card">
                <ul class="list-group list-group-flush">
                    <li class="list-group-item rounded-top-4 param bg-dark-pink text-center "><a href="informations">Modifier vos informations</a></li>
                    <li class="list-group-item param bg-dark-pink text-center"><a href="#" id="click">Changer de mot de passe</a></li>
                    <li class="list-group-item param bg-dark-pink text-center"><a href="historique">Historique des posts</a></li>
                    <li class="list-group-item param bg-dark-pink text-center"><a href="#">Historique des commentaires</a></li>
                    <li class="list-group-item param bg-dark-pink text-center"><a href="#" data-bs-toggle="modal" data-bs-target="#deleteAccount">Supprimer votre compte</a></li>
                    <li class="list-group-item param bottom bg-dark-pink text-center"><a href="contact">Nous contacter</a></li>
                    <li class="list-group-item rounded-bottom-4 param bg-dark-pink text-center"><a href="#" data-bs-toggle="modal" data-bs-target="#confirmLogoutModal">Déconnexion</a></li>
                </ul>
            </div>
        </div>
    </div>
</div>



<?php
require_once 'utilities/components/account/logout.php';
require_once 'utilities/components/account/changePassword.php';
require_once 'utilities/components/account/deleteAccount.php';
require_once 'utilities/footer.php';
?>