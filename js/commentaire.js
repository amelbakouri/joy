$(document).ready(function () {
    var replyToCommentID = null; // Variable pour stocker l'ID du commentaire auquel l'utilisateur répond

    // Gérer l'ouverture de la modal des commentaires
    $('.comment-button').click(function () {
        var postID = $(this).data('post-id'); // Récupérer l'identifiant de la publication
        $('input[name="postID"]').val(postID); // Mettre à jour la valeur du champ de formulaire postID
        $('#commentModal').modal('show'); // Ouvrir la modal des commentaires
        loadComments(postID); // Charger les commentaires correspondants à cette publication
    });

    // Gérer le clic sur un commentaire pour afficher ses réponses
    $(document).on('click', '.comment-with-replies', function () {
        var commentID = $(this).data('comment-id');
        loadReplies(commentID);
    });

    $(document).on('click', '.reply-button', function () {
        var commentID = $(this).closest('.comment').data('comment-id');
        var pseudo = $(this).siblings('.pseudo').text();
        replyToCommentID = commentID; // Stocker l'ID du commentaire auquel l'utilisateur répond
        $('#replyToCommentID').val(commentID); // Actualiser le champ caché avec l'ID du commentaire
        $('#commentText').val('@' + pseudo + ' '); // Pré-remplir le champ de commentaire avec le pseudo de l'auteur du commentaire
        $('#commentText').focus(); // Mettre le focus sur le champ de commentaire

        // Gérer l'annulation de la réponse si le champ de commentaire est vide après la suppression du pseudo
        $('#commentText').on('input', function () {
            if ($(this).val().trim() === '') {
                replyToCommentID = null; // Annuler la réponse
            }
        });
    });


    // Soumission du formulaire de commentaire
    $('#commentForm').submit(function (event) {
        event.preventDefault();
        var postID = $('input[name="postID"]').val();
        var commentText = $('#commentText').val();

        // Vérifier si c'est une réponse à un commentaire
        if (replyToCommentID) {
            // Envoyer la réponse à la fonction de gestion des réponses
            submitReply(postID, replyToCommentID, commentText);
        } else {
            // Envoyer le nouveau commentaire à la fonction de gestion des commentaires
            submitComment(postID, commentText);
        }
    });

    // Fonction pour soumettre un nouveau commentaire
    function submitComment(postID, commentText) {
        var pseudo = $('#userPseudo').val(); // Récupérer le pseudo de l'utilisateur depuis un champ caché (assurez-vous d'avoir un champ avec l'id "userPseudo")

        $.ajax({
            type: 'POST',
            url: '/db/post.php',
            data: {
                form_name: 'add_comment',
                postID: postID,
                pseudo: pseudo, // Inclure le pseudo dans les données envoyées au serveur
                commentaire: commentText
            },
            success: function (response) {
                console.log(response);
                if (response.success) {
                    // Créer le HTML pour le nouveau commentaire
                    var newCommentHTML = '<div class="comment py-3 comment-with-replies" data-comment-id="' + response.commentID + '">' +
                        '<span class="pseudo">' + pseudo + ': </span>' + // Utiliser le pseudo récupéré plutôt que celui du commentaire précédent
                        '<span class="commentaire">' + commentText + '</span>' +
                        '<button class="reply-button">Répondre</button>' +
                        '<button class="btn show-replies">Afficher les réponses</button>' + // Ajouter le bouton pour afficher/masquer les réponses
                        '<div class="reply-form" style="display: none;">' +
                        '<form class="reply-form">' +
                        '<input type="hidden" class="replyToCommentID" value="' + response.commentID + '">' +
                        '<input type="text" class="form-control bg-light-pink reply-text" placeholder="Répondre au commentaire">' +
                        '<button class="btn bg-light-pink reply-submit" type="submit"><i class="fa fa-paper-plane"></i></button>' +
                        '</form>' +
                        '</div>' +
                        '<div class="replies"></div>' + // Ajouter une section pour les réponses
                        '</div>';

                    // Ajouter le nouveau commentaire à la liste existante
                    $('#commentList').append(newCommentHTML);

                    // Effacer le champ de texte
                    $('#commentText').val('');

                    // Réinitialiser l'ID du commentaire auquel on répond
                    replyToCommentID = null;

                    // Charger à nouveau les commentaires après l'ajout du nouveau commentaire
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

        $.ajax({
            type: 'POST',
            url: '/db/post.php',
            data: {
                form_name: 'add_reply',
                postID: postID,
                replyToCommentID: replyToCommentID,
                replyText: replyText,
                pseudo: pseudo // Inclure le pseudo dans les données envoyées au serveur
            },
            success: function (response) {
                console.log(response);
                if (response.success) {
                    // Créer le HTML pour la nouvelle réponse
                    var newReplyHTML = '<div class="reply ms-4">' +
                        '<span class="pseudo">' + pseudo + ': </span>' +
                        '<span class="reply-text">' + replyText + '</span>' +
                        '</div>';

                    // Ajouter la nouvelle réponse à la liste des réponses
                    $('[data-comment-id="' + replyToCommentID + '"]').find('.replies').append(newReplyHTML);

                    // Effacer le champ de texte de la réponse
                    $('[data-comment-id="' + replyToCommentID + '"]').find('.reply-text').val('');

                    // Cacher le formulaire de réponse
                    $('[data-comment-id="' + replyToCommentID + '"]').find('.reply-form').hide();

                    // Réinitialiser l'ID du commentaire auquel on répond
                    replyToCommentID = null;

                    // Charger à nouveau les réponses après l'ajout de la nouvelle réponse
                    loadReplies(replyToCommentID);
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
            url: '/db/post.php',
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
                        commentHTML += '<div class="comment py-3 comment-with-replies" data-comment-id="' + commentList[i].commentID + '">' +
                            '<span class="pseudo">' + commentList[i].pseudo + ': </span>' +
                            '<span class="commentaire">' + commentList[i].commentaire + '</span>' +
                            '<button class="reply-button btn">Répondre</button>' +
                            '<button class="btn show-replies">Afficher les réponses</button>' +
                            '<div class="reply-form" style="display: none;">' +
                            '<form class="reply-form">' +
                            '<input type="hidden" class="replyToCommentID" value="' + commentList[i].commentID + '">' +
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

    // Fonction pour charger les réponses à un commentaire
    function loadReplies(commentID) {

        $.ajax({
            type: 'POST',
            url: '/db/post.php',
            data: {
                form_name: 'get_replies',
                commentID: commentID
            },
            success: function (response) {
                console.log(response); // Afficher la réponse dans la console
                var replies = response.replies;
                var repliesHTML = '';

                // Vérifier s'il y a des réponses
                if (replies.length > 0) {
                    // Parcourir la liste des réponses et construire le HTML
                    for (var i = 0; i < replies.length; i++) {
                        repliesHTML += '<div class="reply ms-4">' +
                            '<span class="pseudo">' + replies[i].pseudo + ': </span>' +
                            '<span class="reply-text">' + replies[i].replyText + '</span>' +
                            '</div>';
                    }

                }

                // Afficher les réponses sous le commentaire correspondant
                $('.comment[data-comment-id="' + commentID + '"] .replies').html(repliesHTML);
            },
            error: function (xhr, status, error) {
                console.error(error);
            }
        });
    }

    // Gérer le clic sur le bouton "Voir les réponses"
    $(document).on('click', '.show-replies', function () {
        var $repliesContainer = $(this).siblings('.replies'); // Sélectionner le conteneur des réponses
        $repliesContainer.toggle(); // Afficher ou masquer les réponses

        // Modifier le texte du bouton en fonction de l'état d'affichage des réponses
        if ($repliesContainer.is(':visible')) {
            $(this).text('Masquer les réponses');
        } else {
            $(this).text('Afficher les réponses');
        }
    });
});
