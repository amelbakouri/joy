function validateForm() {
    var name = document.getElementById("name").value;
    var lname = document.getElementById("lname").value;
    var pseudo = document.getElementById("pseudo").value;
    var email = document.getElementById("email").value;
    var password = document.getElementById("newPassword").value;
    var confirmPassword = document.getElementById("confirmNewPassword").value;
    var errorDiv = document.getElementById("error-message");

    // Regex pour le nom et le prénom
    var nameRegex = /^[a-zA-ZÀ-ÿ\-']+$/;

    // Vérification du prénom
    if (!nameRegex.test(name)) {
        errorDiv.innerText = "Veuillez entrer un prénom valide.";
        return false;
    }

    // Vérification du nom
    if (!nameRegex.test(lname)) {
        errorDiv.innerText = "Veuillez entrer un nom valide.";
        return false;
    }

    // Vérification du pseudo
    var pseudoRegex = /^[a-zA-Z0-9_-]+$/; // Ne permet que des lettres, chiffres, tirets et underscores
    if (!pseudoRegex.test(pseudo)) {
        errorDiv.innerText = "Le pseudo ne peut contenir que des lettres, des chiffres, des tirets et des underscores.";
        return false;
    }

    // Vérification de l'email
    var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (!emailRegex.test(email)) {
        errorDiv.innerText = "Veuillez entrer une adresse email valide.";
        return false;
    }

    // Vérification de la force du mot de passe
    var passwordRegex = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[!@#$%^&*]).{8,}$/;
    if (!passwordRegex.test(password)) {
        errorDiv.innerText = "Le mot de passe doit contenir au moins 8 caractères, une lettre minuscule, une lettre majuscule, un chiffre et un caractère spécial.";
        return false;
    }

    // Vérification de la correspondance des mots de passe
    if (password !== confirmPassword) {
        errorDiv.innerText = "Les mots de passe ne correspondent pas.";
        return false;
    }

    // Tout est valide
    return true;
}