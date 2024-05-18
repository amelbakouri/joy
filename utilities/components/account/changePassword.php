<div id="myModal" class="modalStyle">
    <div id="success-container" class="bg-light-pink py-2" style="display: none;">
        <div id="success-message" class="text-success text-center fw-bold fs-5"></div> <!-- Message de succès -->
    </div>
    <div class="container d-flex justify-content-center align-items-center">
        <div class="card px-4 py-3 bg-dark-pink rounded-4 shadow-sm myModal-content">
            <div class="card-body">
                <h4 class="mb-4 text-center">Changer votre mot de passe</h4>
                <span class="close" style="position: absolute; top: 10px; right: 10px;">&times;</span>

                <form method="POST" action="/db/account.php" id="passwordForm">
                    <input type="hidden" name="username" id="pseudo" value="<?= $_SESSION['pseudo'] ?>">
                    <div class="row mb-4">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label for="oldPassword">Ancien mot de passe :</label>
                                <input id="oldPassword" name="oldPassword" class="form-control bg-light-pink" type="password" autocomplete="current-password" required>
                                <span id="oldPasswordError" class="text-danger"></span>
                            </div>
                        </div>
                    </div>

                    <div class="row mb-4">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label for="newPassword">Nouveau mot de passe :</label>
                                <input id="newPassword" name="newPassword" class="form-control bg-light-pink" type="password" autocomplete="new-password" required>
                                <span id="newPasswordError" class="text-danger"></span>
                            </div>
                        </div>
                    </div>

                    <div class="row mb-4">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label for="confirmPassword">Confirmez le mot de passe :</label>
                                <input id="confirmPassword" name="confirmPassword" class="form-control bg-light-pink" type="password" autocomplete="new-password" required>
                                <span id="confirmPasswordError" class="text-danger"></span>
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

<script>
    $(document).ready(function() {
        function validateField(field, regex, errorElement, errorMessage) {
            const value = field.val().trim();
            if (!regex.test(value)) {
                errorElement.text(errorMessage);
                return false;
            } else {
                errorElement.text("");
                return true;
            }
        }

        function validateNewPassword() {
            const newPassword = $("#newPassword");
            const passwordRegex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/;

            return validateField(newPassword, passwordRegex, $("#newPasswordError"), "Le mot de passe doit contenir au moins 8 caractères, dont une lettre majuscule, une lettre minuscule, un chiffre et un caractère spécial.");
        }

        function validatePasswordsMatch() {
            const newPassword = $("#newPassword").val().trim();
            const confirmPassword = $("#confirmPassword").val().trim();

            if (newPassword !== confirmPassword) {
                $("#confirmPasswordError").text("Les mots de passe ne correspondent pas.");
                return false;
            } else {
                $("#confirmPasswordError").text("");
                return true;
            }
        }

        // Ajouter des événements d'entrée pour chaque champ pour la validation en temps réel
        $("#newPassword").on("input", function() {
            validateNewPassword();
        });

        $("#confirmPassword").on("input", function() {
            validatePasswordsMatch();
        });

        $("form").submit(function(event) {
            event.preventDefault();

            const isNewPasswordValid = validateNewPassword();
            const doPasswordsMatch = validatePasswordsMatch();

            if (!isNewPasswordValid || !doPasswordsMatch) {
                return; // Arrêter l'exécution du code si la validation échoue
            }

            // Récupérer les données du formulaire
            const oldPassword = $("#oldPassword").val().trim();
            const newPassword = $("#newPassword").val().trim();
            const confirmPassword = $("#confirmPassword").val().trim();
            const pseudo = $("#pseudo").val(); // Ne pas utiliser trim() ici pour éviter les erreurs

            // Vérifier si le pseudo est défini
            if (pseudo === undefined || pseudo.trim() === "") {
                $("#oldPasswordError").text("Erreur : pseudo non défini.");
                return;
            }

            // Envoyer une requête AJAX pour changer le mot de passe
            $.ajax({
                type: "POST",
                url: "/db/account.php",
                dataType: "json",
                data: {
                    form_name: 'changePassword',
                    oldPassword: oldPassword,
                    newPassword: newPassword,
                    confirmPassword: confirmPassword,
                    pseudo: pseudo.trim()
                },
                success: function(response) {
                    const successMessage = $("#success-message");
                    successMessage.removeClass("text-success text-danger");
                    if (response.success) {
                        // Afficher le message de succès
                        successMessage.addClass("text-success").text(response.message);
                        $("#success-container").show();
                    } else {
                        // Afficher un message d'erreur si la modification a échoué
                        $("#oldPasswordError").text(response.message);
                    }
                },
                error: function() {
                    $("#oldPasswordError").text("Une erreur s'est produite lors du changement de mot de passe.");
                }
            });
        });
    });
</script>


<script src="/js/account/modalPassword.js"></script>

<!-- source modal: https://www.w3schools.com/howto/howto_css_modals.asp -->