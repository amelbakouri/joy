<div id="login-card" style="display: none !important;" class="container mt-5 mb-5 d-flex justify-content-center">
    <div class="card px-5 py-4 bg-dark-pink rounded-4 shadow-sm loginModal">
        <div class="card-body">
            <h4 class="mb-3 text-center">Connexion</h4>

            <form method="POST" action="/authentification/connexion.php">
                <div class="row mb-4">
                    <div class="col-sm-12 mt-4">
                        <div class="form-group">
                            <label for="pseudo">Pseudo :</label>
                            <input id="loginPseudo" name="loginPseudo" class="form-control bg-light-pink" type="text" autocomplete="username" placeholder="johnD">
                        </div>
                    </div>
                </div>

                <div class="col-sm-12">
                    <div class="form-group">
                        <label for="password">Mot de passe :</label>
                        <input id="loginPassword" name="loginPassword" class="form-control bg-light-pink" type="password" autocomplete="current-password" placeholder="*******">
                    </div>
                </div>

                <div class="row justify-content-center mt-3">
                    <button name="connexion" class="w-30 btn bg-logo-color color-light-pink btn-block ">Se connecter</button>
                </div>
            </form>

            <p class="d-flex justify-content-center mt-3">Vous n'avez pas de compte ? &nbsp; <a href="#" class="color-logo" id="register-link">S'inscrire</a></p>

        </div>
    </div>
</div>