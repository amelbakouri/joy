<?php
require_once 'authentification/auth.php';
$userID = $_SESSION['id'];

// Récupérer le nom de la page actuelle
$current_page = basename($_SERVER['PHP_SELF']);

?>

<body>
  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg">
    <div class="container-fluid">
      <!-- Logo -->
      <a class="navbar-brand ms-lg-5" href="/"><img id="logo" src="assets/img/logo.png" alt="logo joy" draggable="false" height="70" /></a>

      <!-- Bouton de basculement pour la navigation mobile -->
      <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="custom-icon"><i class="fa-solid fa-bars fs-1 color-logo"></i></span>
      </button>

      <!-- Contenu de la barre de navigation -->
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <!-- Barre de recherche -->
        <form class="d-flex ms-auto" action="index.php" method="GET">
          <div class="input-group bg-dark-pink rounded-pill">
            <input type="search" class="form-control bg-dark-pink border-0 rounded-pill" placeholder="Rechercher" name="query" value="<?php echo isset($_GET['query']) ? htmlspecialchars($_GET['query']) : ''; ?>">
            <button class="btn bg-dark-pink border-0 rounded-pill color-grey" type="submit">
              <i class="bi bi-search"></i> <!-- Icône de loupe -->
            </button>
          </div>
        </form>



        <!-- Liens à droite -->
        <ul class="navbar-nav ms-auto">
          <li class="nav-item">
            <a class="nav-link mx-2 pe-2 roboto-medium fs-5  <?= ($current_page == 'index.php') ? 'color-logo' : ''; ?>" href="/">Accueil</a>
          </li>
          <li class="nav-item">
            <a class="nav-link mx-2 pe-2 roboto-medium fs-5 <?= ($current_page == 'creer.php') ? 'color-logo' : ''; ?>" href="creer">Créer</a>
          </li>
          <li class="nav-item">
            <a class="nav-link mx-2 pe-2 roboto-medium fs-5 <?= ($current_page == 'profil.php') ? 'color-logo' : ''; ?>" href="profil">Profil</a>
          </li>
          <?php
          if ($_SESSION['role'] == 'moderateur') {
            echo "<li class='nav-item'>
            <a class='nav-link mx-2 pe-2 roboto-medium fs-5 ' href='/admin/dashboard'>Dashboard</a>
          </li>";
          }
          ?>
        </ul>
      </div>
    </div>
  </nav>