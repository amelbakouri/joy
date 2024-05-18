<div id="login-card" class="container mt-4 mb-5 d-flex justify-content-center">
    <div id="login-infos" class="card px-lg-5 py-4 bg-dark-pink rounded-4 loginModal">
        <div class="card-body">
            <h3 class="mb-3 text-center">Connexion</h3>

            <form id="loginForm" method="POST">
                <div class="row mb-4">
                    <div class="col-sm-12 mt-4">
                        <div class="form-group">
                            <label for="pseudo">Pseudo :</label>
                            <input id="loginPseudo" name="loginPseudo" class="form-control border-0 bg-light-pink" type="text" autocomplete="username" placeholder="johnD">
                        </div>
                    </div>
                </div>

                <div class="col-sm-12">
                    <div class="form-group">
                        <label for="password">Mot de passe :</label>
                        <input id="loginPassword" name="loginPassword" class="form-control border-0 bg-light-pink" type="password" autocomplete="current-password" placeholder="*******">
                    </div>
                </div>

                <div class="row justify-content-center col-6 col-md-4 mx-auto mt-4">
                    <button type="submit" class="btn bg-logo-color color-light-pink btn-block">Connexion</button>
                </div>
                <div class="row  col-12 mt-2">
                    <span id="loginError" class="text-danger text-center fw-bold"></span>
                </div>
            </form>

            <div class="d-flex flex-column align-items-center">
                <p class="d-flex justify-content-center mb-0 mt-3">Vous n'avez pas de compte ? </p>
                <p class="mb-0 fw-bold fs-5"><a href="#" class="color-logo" id="register-link">S'inscrire</a></p>
            </div>

        </div>
    </div>
</div>

<script src="/js/account/connexion.js"></script>