$(document).ready(function () {
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

    function validateForm() {
        const name = $("#name");
        const lname = $("#lname");
        const pseudo = $("#pseudo");
        const email = $("#email");

        const nameRegex = /^[A-Za-zÀ-ÖØ-öø-ÿ]+$/; // Lettres seulement
        const lnameRegex = /^[A-Za-zÀ-ÖØ-öø-ÿ]+$/; // Lettres seulement
        const pseudoRegex = /^[A-Za-z0-9_]+$/; // Lettres, chiffres, underscores
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/; // Format e-mail

        let valid = true;
        valid = validateField(name, nameRegex, $("#name-error"), "Veuillez entrer un prénom valide.") && valid;
        valid = validateField(lname, lnameRegex, $("#lname-error"), "Veuillez entrer un nom valide.") && valid;
        valid = validateField(pseudo, pseudoRegex, $("#pseudo-error"), "Veuillez entrer un pseudo valide (lettres, chiffres, underscores).") && valid;
        valid = validateField(email, emailRegex, $("#email-error"), "Veuillez entrer un e-mail valide.") && valid;

        return valid;
    }

    // Ajouter des événements d'entrée pour chaque champ pour la validation en temps réel
    $("#name, #lname, #pseudo, #email").on("input", function () {
        validateForm();
    });

    $("form").submit(function (event) {
        event.preventDefault();

        if (!validateForm()) {
            return; // Arrêter l'exécution du code si la validation échoue
        }

        const pseudo = $("#pseudo").val().trim();
        const email = $("#email").val().trim();
        const name = $("#name").val().trim();
        const lname = $("#lname").val().trim();

        // Envoyer une requête AJAX pour vérifier si le pseudo et l'e-mail existent déjà
        $.ajax({
            type: "POST",
            url: "/db/account.php",
            dataType: "json",
            data: {
                form_name: 'informations',
                pseudo: pseudo,
                email: email,
                name: name,
                lname: lname
            },
            success: function (response) {
                if (response.pseudo_exists) {
                    $("#pseudo-error").text("Le pseudo existe déjà.");
                }
                if (response.email_exists) {
                    $("#email-error").text("L'email existe déjà.");
                }
                if (!response.pseudo_exists && !response.email_exists) {
                    if (response.success) {
                        // Afficher le message de succès
                        $("#success-message").text("Informations mises à jour avec succès.");
                    }
                }
            },
            error: function () {
                $("#pseudo-error").text("Une erreur s'est produite lors de la vérification.");
                $("#email-error").text("Une erreur s'est produite lors de la vérification.");
            }
        });
    });
});
