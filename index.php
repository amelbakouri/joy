<?php
session_start();
require_once 'utilities/head.php';
require_once 'utilities/nav.php';
require_once 'function/generic.php';
?>

<div class="container col-lg-6">
    <div class="row">
        <?php
        $post = request($conn, "SELECT * FROM posts INNER JOIN user ON posts.userID = user.id ORDER BY posts.id DESC");

        if ($post->rowCount() > 0) {
            // Parcourir les résultats
            while ($row = $post->fetch()) {
                $content = $row['content'];
                $pseudo = $row['pseudo'];
        ?>
                <div class="card col-12 post bg-light-pink mt-4 rounded-0">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $pseudo;?>  • </h5>
                        <p class="card-text"><?php echo $content; ?></p>
                    </div>
                </div>
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