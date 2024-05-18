$(document).ready(function () {
    // Fonction de validation d'un champ avec un regex et un message d'erreur
    function validateField(field, regex, errorElement, errorMessage) {
        const value = field.val().trim(); // Récupère la valeur du champ, en supprimant les espaces en début et fin
        if (!regex.test(value)) { // Vérifie si la valeur ne correspond pas au regex
            errorElement.text(errorMessage); // Affiche le message d'erreur
            return false; // Retourne false si la validation échoue
        } else {
            errorElement.text(""); // Vide le message d'erreur
            return true; // Retourne true si la validation réussit
        }
    }

    // Fonction de validation des mots de passe (vérifie s'ils correspondent)
    function validatePasswords(newPassword, confirmNewPassword, errorElement) {
        if (newPassword.val().trim() !== confirmNewPassword.val().trim()) { // Vérifie si les mots de passe ne correspondent pas
            errorElement.text("Les mots de passe ne correspondent pas."); // Affiche le message d'erreur
            return false; // Retourne false si la validation échoue
        } else {
            errorElement.text(""); // Vide le message d'erreur
            return true; // Retourne true si la validation réussit
        }
    }

    // Fonction de validation d'un champ spécifique en fonction de son type
    function validateInput(input) {
        const name = $("#name");
        const lname = $("#lname");
        const pseudo = $("#pseudo");
        const email = $("#email");
        const newPassword = $("#newPassword");
        const confirmNewPassword = $("#confirmNewPassword");

        // Définition des regex pour chaque type de champ
        const nameRegex = /^[A-Za-zÀ-ÖØ-öø-ÿ]+$/; // Lettres seulement
        const lnameRegex = /^[A-Za-zÀ-ÖØ-öø-ÿ]+$/; // Lettres seulement
        const pseudoRegex = /^[A-Za-z0-9_]+$/; // Lettres, chiffres, underscores
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/; // Format e-mail
        const passwordRegex = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[!@#$%^&*]).{8,}$/; // Mot de passe sécurisé

        let valid = true; // Indicateur de validation
        // Valide le champ correspondant à l'entrée courante
        if (input.is(name)) {
            valid = validateField(name, nameRegex, $("#name-error"), "Veuillez entrer un prénom valide.");
        } else if (input.is(lname)) {
            valid = validateField(lname, lnameRegex, $("#lname-error"), "Veuillez entrer un nom valide.");
        } else if (input.is(pseudo)) {
            valid = validateField(pseudo, pseudoRegex, $("#pseudo-error"), "Veuillez entrer un pseudo valide (lettres, chiffres, underscores).");
        } else if (input.is(email)) {
            valid = validateField(email, emailRegex, $("#email-error"), "Veuillez entrer un e-mail valide.");
        } else if (input.is(newPassword)) {
            valid = validateField(newPassword, passwordRegex, $("#new-password-error"), "Votre mot de passe doit contenir au moins un chiffre, une lettre minuscule, une majuscule, un caractère spécial, et min. 8 caractères.");
        } else if (input.is(confirmNewPassword)) {
            valid = validatePasswords(newPassword, confirmNewPassword, $("#confirm-password-error"));
        }

        return valid; // Retourne le résultat de la validation
    }

    // Ajoute des événements d'entrée pour chaque champ pour la validation en temps réel
    $("#name, #lname, #pseudo, #email, #newPassword, #confirmNewPassword").on("input", function () {
        validateInput($(this)); // Valide l'entrée courante
    });

    // Fonction de validation du formulaire entier
    function validateForm() {
        const name = $("#name");
        const lname = $("#lname");
        const pseudo = $("#pseudo");
        const email = $("#email");
        const newPassword = $("#newPassword");
        const confirmNewPassword = $("#confirmNewPassword");

        // Définition des regex pour chaque type de champ (répétition pour clarté)
        const nameRegex = /^[A-Za-zÀ-ÖØ-öø-ÿ]+$/; // Lettres seulement
        const lnameRegex = /^[A-Za-zÀ-ÖØ-öø-ÿ]+$/; // Lettres seulement
        const pseudoRegex = /^[A-Za-z0-9_]+$/; // Lettres, chiffres, underscores
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/; // Format e-mail
        const passwordRegex = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[!@#$%^&*]).{8,}$/; // Mot de passe sécurisé

        let valid = true; // Indicateur de validation global
        // Valide chaque champ et met à jour l'indicateur de validation global
        valid = validateField(name, nameRegex, $("#name-error"), "Veuillez entrer un prénom valide.") && valid;
        valid = validateField(lname, lnameRegex, $("#lname-error"), "Veuillez entrer un nom valide.") && valid;
        valid = validateField(pseudo, pseudoRegex, $("#pseudo-error"), "Veuillez entrer un pseudo valide (lettres, chiffres, underscores).") && valid;
        valid = validateField(email, emailRegex, $("#email-error"), "Veuillez entrer un e-mail valide.") && valid;
        valid = validateField(newPassword, passwordRegex, $("#new-password-error"), "Votre mot de passe doit contenir au moins un chiffre, une lettre minuscule, une majuscule, un caractère spécial, et min. 8 caractères.") && valid;
        valid = validatePasswords(newPassword, confirmNewPassword, $("#confirm-password-error")) && valid;

        return valid; // Retourne le résultat global de la validation
    }

    // Gère la soumission du formulaire
    $("form").submit(function (event) {
        event.preventDefault(); // Empêche la soumission par défaut du formulaire

        if (!validateForm()) { // Si la validation échoue
            return; // Arrêter l'exécution du code si la validation échoue
        }

        // Récupère les valeurs des champs du formulaire
        const pseudo = $("#pseudo").val().trim();
        const email = $("#email").val().trim();
        const name = $("#name").val().trim();
        const lname = $("#lname").val().trim();
        const newPassword = $("#newPassword").val().trim();
        const confirmNewPassword = $("#confirmNewPassword").val().trim();

        // Envoie une requête AJAX pour vérifier si le pseudo et l'e-mail existent déjà
        $.ajax({
            type: "POST",
            url: "../authentification/inscription.php", // URL de la requête
            dataType: "json", // Type de données attendu en réponse
            data: {
                inscription: true,
                pseudo: pseudo,
                email: email,
                name: name,
                lname: lname,
                newPassword: newPassword,
                confirmNewPassword: confirmNewPassword
            },
            success: function (response) {
                if (response.pseudo_exists) {
                    $("#pseudo-error").text("Le pseudo existe déjà."); // Affiche une erreur si le pseudo existe déjà
                } else {
                    $("#pseudo-error").text(""); // Vide le message d'erreur
                }

                if (response.email_exists) {
                    $("#email-error").text("L'email existe déjà."); // Affiche une erreur si l'email existe déjà
                } else {
                    $("#email-error").text(""); // Vide le message d'erreur
                }

                if (response.success) {
                    $("#success-message").text("Inscription réussie !");
                    // Redirection seulement en cas de succès
                    window.location.href = "/"; // Redirige vers la page d'accueil
                } else {
                    // Ne pas rediriger en cas d'erreur
                }
            },
            error: function () {
                $("#generic-error").text("Une erreur s'est produite lors de la vérification."); // Affiche un message d'erreur générique
            }
        });

    });
});
