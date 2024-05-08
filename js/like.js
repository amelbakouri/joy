document.addEventListener("DOMContentLoaded", function() {
    const likeButtons = document.querySelectorAll('.like-button');

    likeButtons.forEach(button => {
        const postId = button.getAttribute('data-post-id');
        const likeCountElement = button.parentElement.querySelector('.like-count');

        // Fonction pour mettre à jour le nombre de likes
        function updateLikeCount() {
            const xhr = new XMLHttpRequest();
            xhr.open('POST', '/db/post.php');
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

            xhr.onload = function() {
                if (xhr.status === 200) {
                    const response = JSON.parse(xhr.responseText);
                    if (response.success) {
                        likeCountElement.textContent = response.like_count;
                    } else {
                        console.error('Erreur de traitement :', response.error);
                    }
                } else {
                    console.error('Erreur de requête :', xhr.status);
                }
            };

            xhr.send('form_name=get_like_count&postID=' + postId);
        }

        // Appeler la fonction pour mettre à jour le nombre de likes au chargement de la page
        updateLikeCount();

        // Ajoutez cet événement de clic pour mettre à jour le nombre de likes après chaque clic sur le bouton de like
        button.addEventListener('click', function() {
            const isLiked = button.classList.contains('liked');

            const xhr = new XMLHttpRequest();
            xhr.open('POST', '/db/post.php');
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

            xhr.onload = function() {
                if (xhr.status === 200) {
                    const response = JSON.parse(xhr.responseText);
                    if (response.success) {
                        if (isLiked) {
                            button.classList.remove('liked');
                            button.innerHTML = '<i class="fa fa-heart"></i>';
                        } else {
                            button.classList.add('liked');
                            button.innerHTML = '<i class="fas fa-heart color-logo"></i>';
                        }
                        // Après avoir géré le like, mettez à jour le nombre de likes
                        updateLikeCount();
                    } else {
                        // Gérer les erreurs de la réponse du serveur
                        console.error('Erreur de traitement :', response.error);
                    }
                } else {
                    // Gérer les erreurs de la requête
                    console.error('Erreur de requête :', xhr.status);
                }
            };

            xhr.send('form_name=like&postID=' + postId + (isLiked ? '&unlike=true' : '&like=true'));
        });
    });
});