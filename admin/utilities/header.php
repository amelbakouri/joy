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
            <div class="d-md-none d-flex justify-content-between">
                <!-- Logo à gauche -->
                <div class="col-6 d-md-none">
                    <a class="navbar-brand" href="/"><img id="logo" src="/assets/img/logo.png" class="mt-2" alt="logo joy" draggable="false" height="65" /></a>
                </div>

                <!-- Bouton de menu pour les petits écrans -->
                <button class="btn d-md-none d-flex justify-content-end" id="menu-toggle">
                    <i class="fas fa-bars color-logo fs-1 mt-3"></i>
                </button>
            </div>

            <!-- Navigation latérale -->
            <nav id="sidebar" class="col-md-2 col-lg-2 bg-dark-pink">
                <div class="sidebar-header text-center mt-lg-4">
                    <a class="navbar-brand" href="/"><img id="logo" src="/assets/img/logo.png" alt="logo joy" draggable="false" height="100" /></a>
                </div>
                <ul class="list-unstyled components mt-lg-5">
                    <li class="mb-3 text-center">
                        <a href="dashboard" class="fs-4">Profils</a>
                    </li>
                    <li class="mb-3 text-center">
                        <a href="posts" class="fs-4">Posts</a>
                    </li>
                    <li class="mb-3 text-center">
                        <a href="signalement" class="fs-4">Signalements</a>
                    </li>
                    <li class="text-center">
                        <a href="#" data-bs-toggle="modal" data-bs-target="#confirmLogoutModal" class="fs-4">Déconnexion</a>
                    </li>
                </ul>
            </nav>

            <script>
                // Écouter le clic sur le bouton de menu pour afficher/masquer la navigation latérale
                document.getElementById("menu-toggle").addEventListener("click", function() {
                    document.getElementById("sidebar").classList.toggle("active");
                });
            </script>