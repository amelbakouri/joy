<!-- Modal de modification -->
<div class="modal fade" id="editModal<?php echo $postID; ?>" tabindex="-1" aria-labelledby="editModalLabel<?php echo $postID; ?>" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content bg-dark-pink" style="margin-top: 43%;">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel<?php echo $postID; ?>">Modifier le post</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="/php/db.php" method="POST">
                    <input type="hidden" name="form_name" value="modifierPost"> 
                    <input type="hidden" name="postID" value="<?php echo $postID; ?>">
                    <div class="form-group">
                        <label for="editContent">Contenu du post :</label>
                        <textarea class="form-control bg-light-pink" id="editContent<?php echo $postID; ?>" name="content" rows="5"><?php echo $content; ?></textarea>
                    </div>
                    <button type="submit" class="btn bg-logo-color color-light-pink mt-3 d-block mx-auto">Modifier</button>
                </form>
            </div>
        </div>
    </div>
</div>