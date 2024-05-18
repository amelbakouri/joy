$(document).ready(function () {
    $("#deleteAccountForm").submit(function (event) {
        event.preventDefault();

        const passwordVerify = $("#password").val().trim();

        // Envoyer une requête AJAX pour vérifier le mot de passe
        $.ajax({
            type: "POST",
            url: "../db/account.php",
            dataType: "json",
            data: {
                form_name: "deleteAccount",
                passwordVerify: passwordVerify
            },
            success: function (response) {
                if (response.success) {
                    // Redirection ou action à effectuer après la suppression réussie
                    window.location.href = "/";
                } else {
                    // Afficher un message d'erreur si le mot de passe est incorrect
                    $("#password-error").text("Le mot de passe est incorrect.");
                }
            },
            error: function () {
                $("#password-error").text("Une erreur s'est produite lors de la vérification.");
            }
        });
    });
});
