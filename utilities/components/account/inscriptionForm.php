<div id="registration-card" style="display: none !important;" class="container mt-5 d-flex justify-content-center">
    <div id="registration-infos" class="card px-lg-5 py-3 bg-dark-pink rounded-4 ">
        <div class="card-body">
            <h3 class="mb-4 text-center">Inscription</h3>

            <form method="POST">
                <div class="row mb-4">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="name">Prénom :</label>
                            <input id="name" name="name" class="form-control border-0 bg-light-pink" type="text" placeholder="John" required>
                            <span id="name-error" class="text-danger"></span>
                        </div>
                    </div>

                    <div class="col-sm-6 mt-3 mt-md-0">
                        <div class="form-group">
                            <label for="lname">Nom :</label>
                            <input id="lname" name="lname" class="form-control border-0 bg-light-pink" type="text" placeholder="Doe" required>
                            <span id="lname-error" class="text-danger"></span>
                        </div>
                    </div>
                </div>

                <div class="col-sm-12 mt-4">
                    <div class="form-group">
                        <label for="pseudo">Pseudo :</label>
                        <input id="pseudo" name="pseudo" class="form-control border-0 bg-light-pink" type="text" placeholder="johnD" autocomplete="username" required>
                        <span id="pseudo-error" class="text-danger"></span>
                    </div>
                </div>

                <div class="col-sm-12 mt-4">
                    <div class="form-group">
                        <label for="email">Email :</label>
                        <input id="email" name="email" class="form-control border-0 bg-light-pink" type="text" placeholder="john@gmail.com" autocomplete="email" required>
                        <span id="email-error" class="text-danger"></span>
                    </div>
                </div>

                <div class="col-sm-12 mt-4">
                    <div class="form-group">
                        <label for="new-password">Nouveau mot de passe :</label>
                        <input id="newPassword" name="newPassword" class="form-control border-0 bg-light-pink" type="password" placeholder="*********" autocomplete="new-password" required>
                        <span id="new-password-error" class="text-danger"></span>
                    </div>
                </div>

                <div class="col-sm-12 mt-4">
                    <div class="form-group">
                        <label for="confirmNewPassword">Confirmez le nouveau mot de passe :</label>
                        <input id="confirmNewPassword" name="confirmNewPassword" class="form-control border-0 bg-light-pink" type="password" placeholder="*********" autocomplete="off" required>
                        <span id="confirm-password-error" class="text-danger"></span>
                    </div>
                </div>


                <div class="row justify-content-center col-6 col-md-4 mx-auto mt-4">
                    <button name="inscription" class=" btn bg-logo-color color-light-pink btn-block ">S'inscrire</button>
                </div>
            </form>
            <div class="d-flex flex-column align-items-center">
                <p class="d-flex justify-content-center mb-0 mt-3">Vous avez déjà un compte ? </p>
                <p class="mb-0 fw-bold fs-5"><a href="#" class="color-logo" id="login-link"> Se connecter</a></p>
            </div>
        </div>
    </div>
</div>

<script src="/js/account/inscription.js"></script>