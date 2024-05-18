<?php
require_once 'utilities/header.php';
?>

<!-- Contenu principal -->
<main class="admin col-md-9 ms-sm-auto col-lg-10 px-md-4 pt-5">
    <h1>Posts</h1>
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
            ?>
                    <div class="card col-12 post bg-light-pink mt-4 rounded-0 ">
                        <div class="card-body p-0 pt-5">
                            <div class="d-flex">
                                <h5 class="card-title"><?php echo $pseudo; ?> </h5>
                                <p class="opacity-75"> &nbsp; • <?= temps_ecoule($postDate); ?> </p>
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
                        </div>
                    </div>
            <?php
                    require dirname(__DIR__) . '/utilities/components/post/commentaires.php';
                }
            } else {
                // Aucun post trouvé
                echo "<p class='text-center mt-5'>Aucun post trouvé.</p>";
            }
            ?>
        </div>
    </div>

</main>
</div>
</div>

<script src="/js/post/commentaire.js"></script>

</body>

</html>