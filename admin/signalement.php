<?php
require_once 'utilities/header.php';
?>

<!-- Contenu principal -->
<main class="admin col-md-9 ms-sm-auto col-lg-10 px-md-4 pt-5">
    <h1 class="ms-2">Signalements</h1>
    <div class="container">
        <form class="d-flex mt-5 w-50" action="signalement.php" method="GET">
            <div class="input-group bg-dark-pink rounded-pill me-3">
                <input type="search" class="form-control bg-dark-pink border-0 rounded-pill" placeholder="Pseudo" name="pseudo" value="<?php echo isset($_GET['pseudo']) ? htmlspecialchars($_GET['pseudo']) : ''; ?>">
            </div>
            <div class="input-group bg-dark-pink rounded-pill">
                <input type="search" class="form-control bg-dark-pink border-0 rounded-pill" placeholder="Post" name="post" value="<?php echo isset($_GET['post']) ? htmlspecialchars($_GET['post']) : ''; ?>">
            </div>
            <button class="ms-3 btn bg-dark-pink border-0 rounded-pill color-grey" type="submit">
                <i class="bi bi-search"></i>
            </button>
        </form>

        <div class="table-responsive">
            <table class="table table-hover text-center mt-5">
                <thead>
                    <tr>
                        <th class="bg-dark-pink border-grey" scope="col">Pseudo</th>
                        <th class="bg-dark-pink border-grey" scope="col">Commentaire</th>
                        <th class="bg-dark-pink border-grey" scope="col">Post</th>
                        <th class="bg-dark-pink border-grey" scope="col">Action</th>
                    </tr>
                </thead>

                <tbody>
                    <?php
                    $pseudoSearch = isset($_GET['pseudo']) ? $_GET['pseudo'] : '';
                    $pseudoSearch = htmlspecialchars($pseudoSearch);

                    $postSearch = isset($_GET['post']) ? $_GET['post'] : '';
                    $postSearch = htmlspecialchars($postSearch);

                    $signalements = request($conn, "SELECT * from signalements AS s JOIN posts AS p ON s.postID = p.id JOIN user AS u ON s.userID = u.id ORDER BY s.id DESC ");
                    while ($row = $signalements->fetch()) {
                        $postID = $row['postID'];
                        $post = request($conn, "SELECT * FROM posts AS p JOIN user AS u ON p.userID = u.id WHERE p.id = $postID AND (p.content LIKE '%$postSearch%' OR u.pseudo LIKE '%$postSearch%')")->fetch();
                        if ($post) {
                            $userID = $post['userID'];
                            $user = requestOne($conn, "SELECT * from user WHERE id = $userID AND user.pseudo LIKE '%$pseudoSearch%'");
                            if ($user) {
                                $pseudo = $user['pseudo'];
                                $content =  $row['content'];
                    ?>

                                <tr>
                                    <td class="bg-light-pink border-grey"><strong><?= $row['pseudo'] ?></strong></td>
                                    <td class="bg-light-pink border-grey"><?= $row['commentaire'] ?></td>
                                    <td class="bg-light-pink border-grey w-50">
                                        <?php
                                        // Afficher le contenu complet dans une boîte modale
                                        if (strlen($content) > 50) {
                                        ?>
                                            <button type="button" class="btn btn-link" data-bs-toggle="modal" data-bs-target="#modal<?= $row['id'] ?>"><strong><?= $pseudo ?></strong> : <?= substr($content, 0, 50) ?>...</button>

                                            <div class="modal fade" id="modal<?= $row['id'] ?>" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-lg modal-dialog-scrollable">
                                                    <div class="modal-content bg-dark-pink">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="modalLabel">Contenu complet</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <strong><?= $pseudo ?></strong> : <?= $content ?>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn bg-logo-color color-light-pink" data-bs-dismiss="modal">Fermer</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php
                                        } else {
                                            echo '<strong>' . $pseudo . '</strong> : ' . $content;
                                        }
                                        ?>
                                    </td>

                                    <td class="bg-light-pink border-grey">
                                        <button type="button" class="btn" data-bs-toggle="modal" data-bs-target="#confirmationModal<?= $postID ?>"><i class="fa-solid fa-trash fs-5"></i></button>
                                        <button type="button" class="btn" data-bs-toggle="modal" data-bs-target="#deleteSignModal<?= $postID ?>"><i class="fa fa-check fs-5 ms-2" aria-hidden="true"></i></button>
                                    </td>
                                </tr>
                    <?php
                                require '../utilities/components/post/deletePost.php'; // Modal de suppression de post
                                require 'utilities/modal/deleteSign.php'; // Modal de suppression de signalement
                            }
                        }
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</main>
</div>
</div>


</body>

</html>