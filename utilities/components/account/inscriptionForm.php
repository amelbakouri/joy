<div id="registration-card" class="container mt-5 d-flex justify-content-center">
    <div id="registration-infos" class="card px-5 py-3 bg-dark-pink rounded-4 shadow-sm">
        <div class="card-body">
            <h4 class="mb-4 text-center">Inscription</h4>

            <form method="POST" action="/authentification/inscription.php" onsubmit="return validateForm()">
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
                </div>

                <div class="col-sm-12 mt-4">
                    <div class="form-group">
                        <label for="pseudo">Pseudo :</label>
                        <input id="pseudo" name="pseudo" class="form-control bg-light-pink" type="text" placeholder="johnD" autocomplete="username" required>
                    </div>
                </div>

                <div class="col-sm-12 mt-4">
                    <div class="form-group">
                        <label for="email">Email :</label>
                        <input id="email" name="email" class="form-control bg-light-pink" type="text" placeholder="john@gmail.com" autocomplete="email" required>
                    </div>
                </div>

                <div class="col-sm-12 mt-4">
                    <div class="form-group">
                        <label for="new-password">Nouveau mot de passe :</label>
                        <div class="input-group">
                            <input id="newPassword" name="newPassword" class="form-control bg-light-pink" type="password" placeholder="*********" autocomplete="new-password" required>
                            <div class="input-group-append">
                                <input class="btn show-password-btn border-0" type="button" value="Afficher" onclick="togglePassword('newPassword')">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-sm-12 mt-4">
                    <div class="form-group">
                        <label for="confirmNewPassword">Confirmez le nouveau mot de passe :</label>
                        <div class="input-group">
                            <input id="confirmNewPassword" name="confirmNewPassword" class="form-control bg-light-pink" type="password" placeholder="*********" autocomplete="off" required>
                            <div class="input-group-append">
                                <input class="btn show-password-btn border-0" type="button" value="Afficher" onclick="togglePassword('confirmNewPassword')">
                            </div>
                        </div>
                    </div>
                </div>


                <!-- Div pour afficher les messages d'erreur -->
                <div id="error-message" class="text-danger text-center pt-3"></div>

                <div class="row justify-content-center mt-3">
                    <button name="inscription" class="w-50 btn bg-logo-color color-light-pink btn-block ">S'inscrire</button>
                </div>
            </form>

            <p class="d-flex justify-content-center mt-3">Vous avez déjà un compte ? &nbsp; <a href="#" class="color-logo" id="login-link"> Se connecter</a></p>
        </div>
    </div>
</div>

<script src="/js/regex/inscription.js"></script>
<script>
    function togglePassword(fieldId) {
        var passwordField = document.getElementById(fieldId);
        var showPasswordBtn = document.querySelector("#" + fieldId + " + .input-group-append .show-password-btn");

        if (passwordField.type === "password") {
            passwordField.type = "text";
            showPasswordBtn.textContent = "Masquer";
        } else {
            passwordField.type = "password";
            showPasswordBtn.textContent = "Afficher";
        }
    }
</script>