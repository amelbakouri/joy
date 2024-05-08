<!-- Modal -->
<div class="modal fade mt-10" id="deleteAccount" tabindex="-1" aria-labelledby="deleteAccountLabel" aria-hidden="true">
    <div class="modal-dialog container d-flex justify-content-center align-items-center">
        <div class="modal-content card px-4 py-3 bg-dark-pink rounded-4 shadow-sm myModal-content">

            <h4 class="mb-4 text-center" id="deleteAccountLabel">Supprimer votre compte</h4>
            <button type="button" style="position: absolute; top: 10px; right: 10px;" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

            <div class="card-body">
                <!-- à faire action="" -->
                <form method="POST" action="/db/account.php">
                    <input type="hidden" name="form_name" value="deleteAccount">
                    <div class="row mb-4">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <!-- Champ de nom d'utilisateur caché pour l'accessibilité -->
                                <input type="hidden" name="username" value="<?= $_SESSION['pseudo'] ?>">

                                <label for="password">Mot de passe :</label>
                                <input id="password" name="passwordVerify" class="form-control bg-light-pink" type="password" autocomplete="new-password" required>
                            </div>
                        </div>
                    </div>

                    <p>Vous ne pourrez plus jamais récuperer votre compte après l'avoir supprimer.</p>

                    <div class="row justify-content-center mt-3">
                        <button type="submit" class="w-50 btn bg-logo-color color-light-pink btn-block">Supprimer</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>