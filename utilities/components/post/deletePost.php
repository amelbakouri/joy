<!-- Modal de confirmation -->
<div class="modal fade" id="confirmationModal<?php echo $postID; ?>" tabindex="-1" aria-labelledby="confirmationModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content bg-dark-pink" style="margin-top: 43%;">
            <div class="modal-header">
                <h5 class="modal-title" id="confirmationModalLabel">Confirmation de suppression</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Êtes-vous sûr de vouloir supprimer ce post ?
            </div>
            <div class="modal-footer">
                <form method="POST" action="/db/post.php">
                    <input type="hidden" name="form_name" value="deletePost">
                    <input type="hidden" name="postID" value="<?php echo $postID; ?>">
                    <button type="submit" class="btn bg-logo-color color-light-pink d-block mx-auto" data-bs-dismiss="modal">Supprimer</button>
                </form>
            </div>
        </div>
    </div>
</div>