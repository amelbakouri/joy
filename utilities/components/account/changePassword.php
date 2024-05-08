<div id="myModal" class="modalStyle">
    <div class="container d-flex justify-content-center align-items-center"> <!-- Ajout de align-items-center -->
        <div class="card px-4 py-3 bg-dark-pink rounded-4 shadow-sm myModal-content">
            <div class="card-body">
                <h4 class="mb-4 text-center">Changer votre mot de passe</h4>
                <span class="close" style="position: absolute; top: 10px; right: 10px;">&times;</span>

                <!-- à faire action="" -->
                <form method="POST" action="/db/account.php">
                    <input type="hidden" name="form_name" value="changePassword">
                    <!-- Champ de nom d'utilisateur caché pour l'accessibilité -->
                    <input type="hidden" name="username" value="<?= $_SESSION['pseudo'] ?>">
                    <div class="row mb-4">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label for="oldPassword">Ancien mot de passe :</label>
                                <input id="oldPassword" name="oldPassword" class="form-control bg-light-pink" type="password" autocomplete="current-password" required>
                            </div>
                        </div>
                    </div>

                    <div class="row mb-4">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label for="newPassword">Nouveau mot de passe :</label>
                                <input id="newPassword" name="newPassword" class="form-control bg-light-pink" type="password" autocomplete="new-password" required>
                            </div>
                        </div>
                    </div>

                    <div class="row mb-4">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label for="confirmPassword">Confirmez le mot de passe :</label>
                                <input id="confirmPassword" name="confirmPassword" class="form-control bg-light-pink" type="password" autocomplete="new-password" required>
                            </div>
                        </div>
                    </div>

                    <div class="row justify-content-center mt-3">
                        <button type="submit" class="w-50 btn bg-logo-color color-light-pink btn-block">Modifier</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>




<script src="/js/modalPassword.js"></script>

<!-- source modal: https://www.w3schools.com/howto/howto_css_modals.asp -->