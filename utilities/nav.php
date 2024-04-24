<body>
  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg">
    <div class="container-fluid">
      <!-- Logo -->
      <a class="navbar-brand ms-5" href="/"><img id="logo" src="assets/img/logo.png" alt="logo joy" draggable="false" height="80" /></a>

      <!-- Bouton de basculement pour la navigation mobile -->
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <!-- Contenu de la barre de navigation -->
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <!-- Barre de recherche -->
        <form class="d-flex ms-auto" action="/php/search.php" method="GET">
          <div class="input-group bg-dark-pink rounded-pill">
            <input type="search" class="form-control  bg-dark-pink border-0 rounded-pill" placeholder="Rechercher" name="query">
            <button class="btn bg-dark-pink border-0 rounded-pill color-grey" type="submit">
              <i class="bi bi-search"></i> <!-- Icône de loupe -->
            </button>
          </div>
        </form>

        <!-- Liens à droite -->
        <ul class="navbar-nav ms-auto me-5">
          <li class="nav-item">
            <a class="nav-link mx-2 pe-2 roboto-medium fs-5" href="/">Accueil</a>
          </li>
          <li class="nav-item">
            <a class="nav-link mx-2 pe-2 roboto-medium fs-5" href="creer">Créer</a>
          </li>
          <li class="nav-item">
            <a class="nav-link mx-2 pe-2 roboto-medium fs-5" href="profil">Profil</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>