// Récupérer les éléments de la page
const registrationCard = document.getElementById("registration-card");
const registrationInfos = document.getElementById("registration-infos");
const loginCard = document.getElementById("login-card");
const loginLink = document.getElementById("login-link");
const registerLink = document.getElementById("register-link");

// Fonction pour afficher la carte de connexion et masquer la carte d'inscription
function showLoginCard() {
    registrationCard.style.setProperty("display", "none", "important");
    loginCard.style.setProperty("display", "block", "important");
}

// Fonction pour afficher la carte d'inscription et masquer la carte de connexion
function showRegistrationCard() {
    loginCard.style.setProperty("display", "none", "important");
    registrationCard.style.setProperty("display", "block", "important");
    registrationInfos.classList.add('registerModal');
}


// Écouteurs d'événements pour les liens de connexion et d'inscription
loginLink.addEventListener("click", showLoginCard);
registerLink.addEventListener("click", showRegistrationCard);



// Attendre que le DOM soit entièrement chargé
document.addEventListener("DOMContentLoaded", function() {
    // Récupérer le formulaire d'inscription
    const inscriptionForm = document.getElementById("inscription-form");

    // Fonction de validation du formulaire
    function validateInscriptionForm(event) {
        // Récupérer les valeurs des champs
        const name = document.getElementById("name").value.trim();
        const lname = document.getElementById("lname").value.trim();
        const pseudo = document.getElementById("pseudo").value.trim();
        const email = document.getElementById("email").value.trim();
        const newPassword = document.getElementById("newPassword").value.trim();
        const confirmNewPassword = document.getElementById("confirmNewPassword").value.trim();

        // Définir une variable pour suivre les erreurs
        let hasError = false;

        // Vérifier si les champs sont vides
        if (name === "" || lname === "" || pseudo === "" || email === "" || newPassword === "" || confirmNewPassword === "") {
            alert("Veuillez remplir tous les champs.");
            hasError = true;
        }

        // Valider l'adresse e-mail avec une expression régulière simple
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!emailRegex.test(email)) {
            alert("Veuillez saisir une adresse e-mail valide.");
            hasError = true;
        }

        // Valider la correspondance des mots de passe
        if (newPassword !== confirmNewPassword) {
            alert("Les mots de passe ne correspondent pas.");
            hasError = true;
        }

        // Si une erreur est détectée, empêcher l'envoi du formulaire
        if (hasError) {
            event.preventDefault(); // Empêcher la soumission du formulaire
        }
    }

    // Ajouter un écouteur d'événement pour la soumission du formulaire
    if (inscriptionForm) {
        inscriptionForm.addEventListener("submit", validateInscriptionForm);
    }
});
