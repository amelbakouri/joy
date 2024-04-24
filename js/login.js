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