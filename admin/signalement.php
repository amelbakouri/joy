<?php
require_once 'utilities/header.php';
?>

<!-- Contenu principal -->
<main class="admin col-md-9 ms-sm-auto col-lg-10 px-md-4 pt-5">
    <h1 class="ms-2">Signalements</h1>
    <div class="container">
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
                    $signalements = request($conn, "SELECT * from signalements AS s JOIN posts AS p ON s.postID = p.id JOIN user AS u ON s.userID = u.id ORDER BY s.id DESC ");
                    while ($row = $signalements->fetch()) {
                        $postID = $row['postID'];
                        $post = requestOne($conn, "SELECT * from posts WHERE id = $postID");
                        $userID = $post->userID;
                        $user = requestOne($conn, "SELECT * from user WHERE id = $userID");
                        $pseudo = $user->pseudo;
                        $content =  $row['content'];
                    ?>
                        <tr>
                            <td class="bg-light-pink border-grey"><strong><?= $pseudo ?></strong></td>
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
                                <a href="/admin/delete.php?id=<?php echo 2 ?>" class="link-dark"><i class="fa-solid fa-trash fs-5"></i></a>
                            </td>
                        </tr>
                    <?php
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