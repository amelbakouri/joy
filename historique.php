<?php
require_once 'utilities/head.php';
require_once 'utilities/nav.php';
require_once 'function/generic.php';
$userID = $_SESSION['id'];
?>

<h1 class="text-center mt-5">Historique des posts</h1>

<div class="container col-lg-6 mb-5">
    <div class="row">
        <?php
        $post = request($conn, "SELECT posts.id AS postsID, content, pseudo FROM posts INNER JOIN user ON posts.userID = user.id WHERE userID = $userID");

        if ($post->rowCount() > 0) {
            // Parcourir les résultats
            while ($row = $post->fetch()) {
                $postID = $row['postsID'];
                $content = $row['content'];
                $pseudo = $row['pseudo'];
        ?>
                <div class="card col-12 bg-dark-pink mt-5 rounded-4">
                    <div class="card-body mt-3">
                        <p class="card-text"><?php echo $content; ?></p>
                        <div class="d-flex justify-content-between align-items-center mt-2">
                            <div></div>
                            <div>
                                <button type="button" class="btn me-2" data-bs-toggle="modal" data-bs-target="#editModal<?= $postID ?>"><i class="fas fa-edit"></i></button> <!-- Icône de modification -->
                                <button type="button" class="btn me-2" data-bs-toggle="modal" data-bs-target="#confirmationModal<?= $postID ?>"><i class="fas fa-trash-alt"></i></button> <!-- Icône de suppression -->
                            </div>
                        </div>
                    </div>
                </div>
                
                <?php
                require 'utilities/components/post/deletePost.php'; // Modal de suppression
                require 'utilities/components/post/modifPost.php'; // Modal de modification
                
                ?>
        <?php
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