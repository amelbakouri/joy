<div id="registration-card" class="container mt-5 mb-5 d-flex justify-content-center">
    <div id="registration-infos" class="card px-5 py-3 bg-dark-pink rounded-4 shadow-sm">
        <div class="card-body">
            <h4 class="mb-4 text-center">Inscription</h4>

            <form method="POST" action="/authentification/inscription.php">
                <div class="row mb-4">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="name">Prénom :</label>
                            <input id="name" name="name" class="form-control bg-light-pink" type="text" placeholder="John" required>
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="lname">Nom :</label>
                            <input id="lname" name="lname" class="form-control bg-light-pink" type="text" placeholder="Doe" required>
                        </div>
                    </div>

                    <div class="col-sm-12 mt-4">
                        <div class="form-group">
                            <label for="pseudo">Pseudo :</label>
                            <input id="pseudo" name="pseudo" class="form-control bg-light-pink" type="text" placeholder="johnD" required>
                        </div>
                    </div>

                    <div class="col-sm-12 mt-4">
                        <div class="form-group">
                            <label for="email">Email :</label>
                            <input id="email" name="email" class="form-control bg-light-pink" type="text" placeholder="john@gmail.com" required>
                        </div>
                    </div>

                    <div class="col-sm-12 mt-4">
                        <div class="form-group">
                            <label for="password">Mot de passe :</label>
                            <input id="password" name="password" class="form-control bg-light-pink" type="password" placeholder="*********" required>
                        </div>
                    </div>
                </div>

                <div class="col-sm-12 mt-4">
                        <div class="form-group">
                            <label for="confirmPassword">Confirmez le mot de passe :</label>
                            <input id="confirmPassword" name="confirmPassword" class="form-control bg-light-pink" type="password" placeholder="*********" required>
                        </div>
                    </div>
                </div>

                <div class="row justify-content-center mt-3">
                    <button name="inscription" class="w-50 btn bg-logo-color color-light-pink btn-block ">S'inscrire</button>
                </div>
            </form>

            <p class="d-flex justify-content-center mt-3">Vous avez déjà un compte ? <a href="#" class="color-logo" id="login-link">Se connecter</a></p>

        </div>
    </div>
</div>