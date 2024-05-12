<?php
require_once dirname(__DIR__, 2) . '/utilities/head.php';
require_once dirname(__DIR__, 2) . '/authentification/auth.php';
require_once dirname(__DIR__, 2) . '/function/generic.php';
require_once dirname(__DIR__, 2) . '/utilities/components/account/logout.php';

if ($_SESSION['role'] != 'moderateur') {
    redirectTo('/');
}
?>


<body>
    <div class="container-fluid">
        <div class="row">
            <!-- Bouton de basculement pour le menu burger -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarCollapse" aria-controls="sidebarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <!-- Navigation latérale -->
            <nav class="col-md-2 col-lg-2 d-md-block bg-dark-pink  sidebar collapse" id="sidebarCollapse">
                <div class="position-sticky">
                    <div class="list-group pt-4 text-center">
                        <a class="navbar-brand" href="/"><img id="logo" src="/assets/img/logo.png" alt="logo joy" draggable="false" height="100" /></a>
                        <a href="dashboard" class="list-group-item border-0 bg-dark-pink fs-5 mt-3">Profils</a>
                        <a href="posts" class="list-group-item border-0 bg-dark-pink fs-5">Posts</a>
                        <a href="signalement" class="list-group-item border-0 bg-dark-pink fs-5">Signalements</a>
                        <a href="#" data-bs-toggle="modal" data-bs-target="#confirmLogoutModal" class="list-group-item border-0 bg-dark-pink fs-5">Déconnexion</a>
                    </div>
                </div>
            </nav>