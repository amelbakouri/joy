$(document).ready(function () {
    $("#loginForm").submit(function (event) {
        event.preventDefault();

        const pseudo = $("#loginPseudo").val().trim();
        const password = $("#loginPassword").val().trim();
        const errorElement = $("#loginError");

        if (pseudo === "" || password === "") {
            errorElement.text("Veuillez remplir tous les champs.");
            return;
        }

        $.ajax({
            type: "POST",
            url: "../authentification/connexion.php",
            dataType: "json",
            data: {
                loginPseudo: pseudo,
                loginPassword: password,
                connexion: true
            },
            success: function (response) {
                if (response.success) {
                    window.location.href = response.redirect;
                } else {
                    errorElement.text("Le pseudo ou le mot de passe est incorrect.");
                }
            },
            error: function () {
                errorElement.text("Une erreur s'est produite lors de la connexion.");
            }
        });
    });
});
