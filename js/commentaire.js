$(document).ready(function () {
    var replyToCommentID = null; // Variable pour stocker l'ID du commentaire auquel l'utilisateur répond

    // Gére l'ouverture de la modal des commentaires
    $('.comment-button').click(function () {
        var postID = $(this).data('post-id'); // Récupére l'ID de la publication
        $('input[name="postID"]').val(postID); // Met à jour la valeur du champ de formulaire postID
        $('#commentModal').modal('show'); // Ouvre la modal des commentaires
        loadComments(postID); // Charge les commentaires correspondants à cette publication
    });

    // Gérer le clic sur le bouton "Afficher les réponses"
    $(document).on('click', '.show-replies', function () {
        console.log("Clic sur le bouton 'Afficher les réponses'");
        var $repliesContainer = $(this).siblings('.replies'); // Sélectionner le conteneur des réponses

        // Vérifier si les réponses sont actuellement visibles
        var repliesVisible = $repliesContainer.hasClass('replies-visible');

        // Mettre à jour le texte du bouton en fonction de l'état d'affichage des réponses
        var buttonText = repliesVisible ? 'Afficher les réponses' : 'Masquer les réponses';
        console.log("Texte du bouton : " + buttonText);

        // Mettre à jour le texte du bouton
        $(this).text(buttonText);

        // Afficher ou masquer les réponses en fonction de leur état actuel
        if (repliesVisible) {
            $repliesContainer.removeClass('replies-visible');
        } else {
            $repliesContainer.addClass('replies-visible');

            // Récupérer l'ID du commentaire
            var commentID = $(this).data('comment-id');

            // Charger les réponses si le conteneur est visible
            loadReplies(commentID);
        }
    });



    $(document).on('click', '.reply-button', function () {
        var commentID = $(this).closest('.comment').data('comment-id'); // Recherche l'élément parent le plus proche qui a la classe CSS "comment"et récupère la valeur de l'attribut de données HTML "comment-id" de l'élément trouvé précédemment et l'assigne à la variable commentID.
        var pseudo = $(this).siblings('.pseudo').text(); // Sélectionne tous les éléments qui sont des frères de l'élément actuel et qui ont la classe CSS "pseudo" et récupère le contenu texte de l'élément trouvé précédemment et l'assigne à la variable pseudo.
        replyToCommentID = commentID; // Stock l'ID du commentaire auquel l'utilisateur répond
        $('#replyToCommentID').val(commentID); // Actualise le champ caché avec l'ID du commentaire
        $('#commentText').val('@' + pseudo + ' '); // Pré-rempli le champ de commentaire avec le pseudo de l'auteur du commentaire
        $('#commentText').focus(); // Met la barre qui clignote dans l'input du champ de commentaire pour indiquer que l'élément est actuellement sélectionné.

        // Gérer l'annulation de la réponse si le champ de commentaire est vide après la suppression du pseudo
        $('#commentText').on('input', function () {
            if ($(this).val().trim() === '') {
                replyToCommentID = null; // Retire l'id du commentaire auquel on allait répondre pour pouvoir écrire un simple commentaire.
            }
        });
    });

    // Soumission du formulaire de commentaire
    $('#commentForm').submit(function (event) {
        event.preventDefault(); // Empêche le comportement par défaut du formulaire (soumission)
        var postID = $('input[name="postID"]').val(); // Récupère la valeur d'un champ de formulaire input avec l'attribut name égal à "postID" et l'assigne à la variable postID.
        var commentText = $('#commentText').val(); // Récupère la valeur de l'élément de formulaire avec l'ID "commentText" dans le DOM et l'assigne à la variable commentText.

        // Vérifie si c'est une réponse à un commentaire
        if (replyToCommentID) {
            // Envoie la réponse à la fonction de gestion des réponses
            submitReply(postID, replyToCommentID, commentText);
        } else {
            // Envoie le nouveau commentaire à la fonction de gestion des commentaires
            submitComment(postID, commentText);
        }
    });

    // Fonction pour soumettre un nouveau commentaire
    function submitComment(postID, commentText) {
        var pseudo = $('#userPseudo').val(); // Récupérer le pseudo de l'utilisateur depuis un champ caché

        // Fonction jQuery qui envoie une requête AJAX. Elle prend un objet JavaScript en argument, qui spécifie les paramètres de la requête.
        $.ajax({
            type: 'POST', // Spécifie que la requête HTTP doit être de type POST. Cela signifie que les données seront envoyées au serveur dans le corps de la requête.
            url: '/db/commentaire.php', // URL à laquelle la requête AJAX est envoyée. 
            data: { // Objet JavaScript contenant les données à envoyer au serveur. Les données sont organisées sous forme de paires clé-valeur.
                form_name: 'add_comment', // Nom du formulaire
                postID: postID, // ID du post
                pseudo: pseudo, // Pseudo de l'utilisateur
                commentaire: commentText // Commentaire
            },
            success: function (response) { // Fonction callback qui sera exécutée si la requête AJAX réussit. Elle prend en argument la réponse renvoyée par le serveur.
                if (response.success) {
                    // Créer le HTML pour le nouveau commentaire
                    var newCommentHTML = '<div class="comment py-3>' +
                        '<span class="pseudo">' + pseudo + ': </span>' +
                        '<span class="commentaire">' + commentText + '</span>' +
                        '<button class="reply-button">Répondre</button>' +
                        '<button class="btn show-replies" data-comment-id="' + response.commentID + ' ">Afficher les réponses</button>' + // Ajoute le bouton pour afficher/masquer les réponses
                        '<div class="reply-form" style="display: none;">' +
                        '<form class="reply-form">' +
                        '<input type="hidden" class="replyToCommentID" value="' + response.commentID + '">' +
                        '<input type="text" class="form-control bg-light-pink reply-text" placeholder="Répondre au commentaire">' +
                        '<button class="btn bg-light-pink reply-submit" type="submit"><i class="fa fa-paper-plane"></i></button>' +
                        '</form>' +
                        '</div>' +
                        '</div>' +
                        '<div class="replies"></div>' + // Ajoute une section pour les réponses
                        '</div>';

                    // Ajoute le nouveau commentaire à la liste existante de commentaires dans l'élément avec l'ID 'commentList'.
                    $('#commentList').append(newCommentHTML);

                    // Efface le champ de texte où l'utilisateur a saisi son commentaire.
                    $('#commentText').val('');

                    // Réinitialise l'ID du commentaire auquel on répond
                    replyToCommentID = null;

                    // Charge à nouveau les commentaires après l'ajout du nouveau commentaire
                    loadComments(postID);
                } else {
                    console.error('Erreur lors de l\'ajout du commentaire');
                }
            },
            error: function (xhr, status, error) {
                console.error(error);
            }
        });
    }

    // Fonction pour soumettre une réponse à un commentaire
    function submitReply(postID, replyToCommentID, replyText) {
        var pseudo = $('#userPseudo').val(); // Récupérer le pseudo de l'utilisateur depuis un champ caché

        // Fonction jQuery qui envoie une requête AJAX. Elle prend un objet JavaScript en argument, qui spécifie les paramètres de la requête.
        $.ajax({
            type: 'POST', // Spécifie que la requête HTTP doit être de type POST. Cela signifie que les données seront envoyées au serveur dans le corps de la requête.
            url: '/db/commentaire.php', // URL à laquelle la requête AJAX est envoyée. 
            data: { // Objet JavaScript contenant les données à envoyer au serveur. Les données sont organisées sous forme de paires clé-valeur.
                form_name: 'add_reply', // Nom du formulaire
                postID: postID, // ID du post
                replyToCommentID: replyToCommentID, // ID du commentaire auquel on répond
                replyText: replyText, // texte de la réponse
                pseudo: pseudo // Pseudo de l'utilisateur
            },
            success: function (response) { // Fonction callback qui sera exécutée si la requête AJAX réussit. Elle prend en argument la réponse renvoyée par le serveur.
                if (response.success) {
                    // Créer le HTML pour la nouvelle réponse
                    var newReplyHTML = '<div class="reply ms-4">' +
                        '<span class="pseudo">' + pseudo + ': </span>' +
                        '<span class="reply-text">' + replyText + '</span>' +
                        '</div>';

                    // Recherche un élément qui a un attribut data-comment-id avec comme valeur replyToCommentID, une fois qu'il a été trouvé, .find recherche à l'intérieur de l'élément un élément qui a la classe CSS .replies. Ensuite l
                    $('[data-comment-id="' + replyToCommentID + '"]').find('.replies').append(newReplyHTML);

                    // Cacher le formulaire de réponse
                    $('[data-comment-id="' + replyToCommentID + '"]').find('.reply-form').hide();

                    // Réinitialiser l'ID du commentaire auquel on répond
                    replyToCommentID = null;

                } else {
                    console.error('Erreur lors de l\'ajout de la réponse');
                }
            },
            error: function (xhr, status, error) {
                console.error(error);
            }
        });
    }

    // Fonction pour charger les commentaires
    function loadComments(postID) {
        $.ajax({
            type: 'POST',
            url: '/db/commentaire.php',
            data: {
                form_name: 'get_comments',
                postID: postID
            },
            success: function (response) {
                var commentList = response.commentList;
                var commentHTML = '';

                // Vérifier s'il y a des commentaires
                if (commentList.length > 0) {
                    // Parcourir la liste des commentaires et construire le HTML
                    for (var i = 0; i < commentList.length; i++) {
                        var comment = commentList[i];
                        commentHTML += '<div class="comment py-3 " data-comment-id="' + comment.commentID + '">' +
                            '<span class="pseudo">' + comment.pseudo + ': </span>' +
                            '<span class="commentaire">' + comment.commentaire + '</span>' +
                            '<button class="reply-button btn border-0">Répondre</button>';

                        // Vérifier s'il y a des réponses pour ce commentaire
                        if (comment.hasReplies) {
                            commentHTML += '<button class="btn border-0 show-replies" data-comment-id="' + comment.commentID + '" >Afficher les réponses</button>';
                        }

                        commentHTML += '<div class="reply-form" style="display: none;">' +
                            '<form class="reply-form">' +
                            '<input type="hidden" class="replyToCommentID" value="' + comment.commentID + '">' +
                            '<input type="text" class="form-control bg-light-pink reply-text" placeholder="Répondre au commentaire">' +
                            '<button class="btn bg-light-pink reply-submit" type="submit"><i class="fa fa-paper-plane"></i></button>' +
                            '</form>' +
                            '</div>' +
                            '<div class="replies"></div>' + // Ajouter une section pour les réponses
                            '</div>';
                    }
                } else {
                    // Afficher un message si aucun commentaire n'est trouvé
                    commentHTML = '<div id="noCommentMessage" class="text-center mb-3">Écrivez le premier commentaire</div>';
                }

                // Afficher les commentaires dans la liste
                $('#commentList').html(commentHTML);
            },
            error: function (xhr, status, error) {
                console.error(error);
            }
        });
    }

    function loadReplies(commentID) {
        console.log("Chargement des réponses pour le commentaire avec l'ID : " + commentID);
        $.ajax({
            type: 'POST',
            url: '/db/commentaire.php',
            data: {
                form_name: 'get_replies',
                commentID: commentID
            },
            success: function (response) {
                console.log(response); // Afficher la réponse dans la console
                var replies = response.replies;
                var repliesHTML = '';

                if (replies.length > 0) {
                    for (var i = 0; i < replies.length; i++) {
                        repliesHTML += '<div class="reply ms-4">' +
                            '<span class="pseudo">' + replies[i].pseudo + ': </span>' +
                            '<span class="reply-text">' + replies[i].replyText + '</span>' +
                            '</div>';
                    }
                }

                $('.comment[data-comment-id="' + commentID + '"] .replies').html(repliesHTML);
            },
            error: function (xhr, status, error) {
                console.error(error);
            }
        });
    }
});
