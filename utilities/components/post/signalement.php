<!-- Modal de signalement -->
<div class="modal fade" id="signalementModal<?= $postID; ?>" tabindex="-1" aria-labelledby="signalement ModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content bg-dark-pink" style="margin-top: 43%;">
            <div class="modal-header">
                <h5 class="modal-title" id="signalementModalLabel">Signalement</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Pourquoi signalez-vous ce post ?</p>
                <form method="POST" action="/db/post.php">
                    <input type="hidden" name="form_name" value="signalement">
                    <input type="hidden" name="postID" value="<?php echo $postID; ?>">
                    <textarea name="commentaire" class="form-control bg-light-pink" style="height: 15vh;" placeholder="Votre message..." required></textarea>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn bg-logo-color color-light-pink d-block mx-auto" data-bs-dismiss="modal">Envoyer</button>
                </form>
            </div>
        </div>
    </div>
</div>