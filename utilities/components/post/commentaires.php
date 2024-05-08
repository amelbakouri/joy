<!-- Modal -->
<div class="modal fade" id="commentModal" tabindex="-1" aria-labelledby="commentModalLabel" aria-hidden="true">
    <div class="modal-dialog ">
        <div class="modal-content bg-dark-pink" id="commentaireModal">
            <div class="modal-header">
                <h5 class="modal-title" id="commentModalLabel">Commentaires</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="comment-list" id="commentList">
                    <!-- Les commentaires seront ajoutés ici dynamiquement -->
                </div>
                <hr>
                <form id="commentForm">
                    <div class="input-group mb-3">
                        <input type="text" class="form-control bg-light-pink border-0" id="commentText" placeholder="Ajouter un commentaire">
                        <input type="hidden" id="userPseudo" value="<?= $_SESSION['pseudo'] ?>">
                        <button class="btn bg-light-pink" type="submit"><i class="fa fa-paper-plane"></i></button>
                    </div>
                    <input type="hidden" name="postID" value="<?php echo $postID; ?>"> <!-- Champ caché pour stocker l'ID du post -->
                </form>
            </div>
        </div>
    </div>
</div>