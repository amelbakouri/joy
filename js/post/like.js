document.addEventListener("DOMContentLoaded", function () {
    // Sélectionne tous les boutons de like
    const likeButtons = document.querySelectorAll('.like-button');

    // Pour chaque bouton de like
    likeButtons.forEach(button => {
        // Récupère l'ID de la publication associée
        const postId = button.getAttribute('data-post-id');
        // Recherche l'élément affichant le nombre de likes
        const likeCountElement = button.parentElement.querySelector('.like-count');

        // Fonction pour mettre à jour le nombre de likes
        function updateLikeCount() {
            // Initialise une nouvelle requête XMLHttpRequest
            const xhr = new XMLHttpRequest();
            xhr.open('POST', '/db/post.php');
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

            // Fonction exécutée lorsque la requête est terminée
            xhr.onload = function () {
                if (xhr.status === 200) {
                    // Analyse la réponse JSON du serveur
                    const response = JSON.parse(xhr.responseText);
                    // Si la requête a réussi
                    if (response.success) {
                        // Met à jour le nombre de likes affiché
                        likeCountElement.textContent = response.like_count;
                    } else {
                        // Affiche une erreur en cas de problème de traitement côté serveur
                        console.error('Erreur de traitement :', response.error);
                    }
                } else {
                    // Affiche une erreur en cas de problème avec la requête
                    console.error('Erreur de requête :', xhr.status);
                }
            };

            // Envoie la requête avec les paramètres appropriés
            xhr.send('form_name=get_like_count&postID=' + postId);
        }

        // Appelle la fonction pour mettre à jour le nombre de likes au chargement de la page
        updateLikeCount();

        // Ajoute un gestionnaire d'événements de clic pour chaque bouton de like
        button.addEventListener('click', function () {
            // Vérifie si le bouton est déjà "liké"
            const isLiked = button.classList.contains('liked');

            // Initialise une nouvelle requête XMLHttpRequest
            const xhr = new XMLHttpRequest();
            xhr.open('POST', '/db/post.php');
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

            // Fonction exécutée lorsque la requête est terminée
            xhr.onload = function () {
                if (xhr.status === 200) {
                    // Analyse la réponse JSON du serveur
                    const response = JSON.parse(xhr.responseText);
                    // Si la requête a réussi
                    if (response.success) {
                        // Met à jour l'apparence du bouton en conséquence
                        if (isLiked) {
                            button.classList.remove('liked');
                            button.innerHTML = '<i class="fa fa-heart"></i>';
                        } else {
                            button.classList.add('liked');
                            button.innerHTML = '<i class="fas fa-heart color-logo"></i>';
                        }
                        // Après avoir géré le like, met à jour le nombre de likes
                        updateLikeCount();
                    } else {
                        // Affiche une erreur en cas de problème de traitement côté serveur
                        console.error('Erreur de traitement :', response.error);
                    }
                } else {
                    // Affiche une erreur en cas de problème avec la requête
                    console.error('Erreur de requête :', xhr.status);
                }
            };

            // Envoie la requête pour enregistrer ou annuler un like
            xhr.send('form_name=like&postID=' + postId + (isLiked ? '&unlike=true' : '&like=true'));
        });
    });
});
