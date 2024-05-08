<?php
require_once 'utilities/header.php';
?>

<!-- Contenu principal -->
<main class="admin col-md-9 ms-sm-auto col-lg-10 px-md-4 pt-5">
    <h1 class="ms-2">Profils</h1>
    <div class="container">
        <div class="table-responsive">
            <table class="table table-hover text-center mt-5">
                <thead>
                    <tr>
                        <th class="bg-dark-pink border-grey" scope="col">Pseudo</th>
                        <th class="bg-dark-pink border-grey" scope="col">Rôle</th>
                        <th class="bg-dark-pink border-grey" scope="col">Nom</th>
                        <th class="bg-dark-pink border-grey" scope="col">Prénom</th>
                        <th class="bg-dark-pink border-grey" scope="col">Email</th>
                        <th class="bg-dark-pink border-grey" scope="col">Action</th>
                    </tr>
                </thead>

                <tbody>
                    <?php
                    $users = request($conn, "SELECT * from user");
                    while ($row = $users->fetch()) {
                    ?>
                        <tr>
                            <td class="bg-light-pink border-grey"><?= $row['pseudo'] ?></td>
                            <td class="bg-light-pink border-grey"><?= $row['role'] ?></td>
                            <td class="bg-light-pink border-grey"><?= $row['lname'] ?></td>
                            <td class="bg-light-pink border-grey"><?= $row['name'] ?></td>
                            <td class="bg-light-pink border-grey"><?= $row['email'] ?></td>

                            <td class="bg-light-pink border-grey">
                                <a href="/admin/edit.php?id=<?php echo 1 ?>" class="link-dark"><i class="fa-solid fa-pen-to-square fs-5 me-3"></i></a>
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