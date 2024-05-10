<!-- Modal de confirmation -->
<div class="modal fade" id="deleteSignModal<?php echo $postID; ?>" tabindex="-1" aria-labelledby="deleteSignModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content bg-dark-pink" style="margin-top: 43%;">
            <div class="modal-header">
                <h4 class="modal-title" id="deleteSignModalLabel">Confirmation de suppression</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <h5>Êtes-vous sûr de vouloir supprimer le signalement ? </h5>
                <p class="mt-3 text-center">Le post sera toujours visible par tous les utilisateurs.</p>
            </div>
            <div class="modal-footer">
                <form method="POST" action="/db/post.php">
                    <input type="hidden" name="form_name" value="deleteSign">
                    <input type="hidden" name="postID" value="<?php echo $postID; ?>">
                    <button type="submit" class="btn bg-logo-color color-light-pink d-block mx-auto" data-bs-dismiss="modal">Supprimer</button>
                </form>
            </div>
        </div>
    </div>
</div>