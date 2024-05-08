<?php
require_once 'utilities/head.php';
require_once 'utilities/nav.php';
require_once 'function/generic.php';
require_once 'function/post.php';
?>

<div class="container col-lg-6 pb-5">
    <div class="row">
        <?php
        $searchTerm = isset($_GET['query']) ? $_GET['query'] : '';
        $searchTerm = htmlspecialchars($searchTerm);

        $post = request($conn, "SELECT content, pseudo, posts.id AS postID, posts.creationDate AS postDate FROM posts INNER JOIN user ON posts.userID = user.id WHERE user.pseudo LIKE '%$searchTerm%' OR posts.content LIKE '%$searchTerm%' ORDER BY postDate DESC");


        if ($post->rowCount() > 0) {
            // Parcourir les résultats
            while ($row = $post->fetch()) {
                $content = $row['content'];
                $pseudo = $row['pseudo'];
                $postID = $row['postID'];
                $postDate = $row['postDate'];

                $user_has_liked = userHasLikedPost($conn, $userID, $postID);
                $like_count = requestOne($conn, "SELECT COUNT(*) AS like_count FROM postlikes WHERE postID = $postID")->like_count;
        ?>
                <div class="card col-12 post bg-light-pink mt-4 rounded-0 ">
                    <div class="card-body p-0 pt-5">
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="d-flex">
                                <h5 class="card-title"><?php echo $pseudo; ?> </h5>
                                <p class="opacity-75"> &nbsp; • <?= temps_ecoule($postDate); ?> </p>
                            </div>
                            <button type="button" class="btn p-0 icon-post border-0 " data-post-id="<?php echo $postID; ?>" data-bs-toggle="modal" data-bs-target="#signalementModal<?= $postID; ?>">
                                <i class="fa-solid fa-triangle-exclamation"></i>
                            </button>
                        </div>
                        <p class="card-text"><?php echo $content; ?></p>
                    </div>
                    <div class="d-flex justify-content-end align-items-center">
                        <!-- Ajouter le bouton de commentaire -->
                        <div class="d-flex flex-column text-center pe-3">
                            <button type="button" class="btn p-0 icon-post border-0 comment-button" data-post-id="<?php echo $postID; ?>" data-bs-toggle="modal" data-bs-target="#commentModal">
                                <i class="fas fa-message"></i>
                            </button>
                            <!-- Utilisation d'un span pour afficher le nombre de commentaires -->
                            <span class="comment-count"><?php echo getCommentCount($conn, $postID); ?></span>
                        </div>

                        <div class="d-flex flex-column text-center">
                            <button type="button" class="btn p-0 icon-post border-0 like-button <?php echo ($user_has_liked ? 'liked' : ''); ?>" data-post-id="<?php echo $postID; ?>">
                                <?php echo ($user_has_liked ? '<i class="fas fa-heart color-logo"></i>' : '<i class="fa fa-heart"></i>'); ?>
                            </button>
                            <span class="like-count"><?php echo $like_count; ?></span>
                        </div>
                    </div>
                </div>
        <?php
                require 'utilities/components/post/commentaires.php';
                require 'utilities/components/post/signalement.php';
            }
        } else {
            // Aucun post trouvé
            echo "<p class='text-center mt-5'>Aucun post trouvé.</p>";
        }
        ?>
    </div>
</div>

<?php
require_once 'utilities/footer.php';
?>

<script src="js/like.js"></script>
<script src="js/commentaire.js"></script>