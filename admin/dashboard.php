<?php
require_once 'utilities/header.php';
?>

<!-- Contenu principal -->
<main class="admin col-md-9 ms-sm-auto col-lg-10 px-md-4 pt-5">
    <h1 class="ms-2">Profils</h1>
    <div class="container">

        <div class="d-flex">
            <form class="d-flex w-25 mt-5" action="dashboard.php" method="GET">
                <div class="input-group bg-dark-pink rounded-pill">
                    <input type="search" class="form-control bg-dark-pink border-0 rounded-pill" placeholder="Rechercher" name="query" value="<?php echo isset($_GET['query']) ? htmlspecialchars($_GET['query']) : ''; ?>">
                    <button class="btn bg-dark-pink border-0 rounded-pill color-grey" type="submit">
                        <i class="bi bi-search"></i>
                    </button>
                </div>
            </form>
        </div>

        <div class="table-responsive">
            <table class="table table-hover text-center mt-4">
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
                    $searchTerm = isset($_GET['query']) ? $_GET['query'] : '';
                    $searchTerm = htmlspecialchars($searchTerm);
                    $users = request($conn, "SELECT * FROM user WHERE pseudo LIKE '%$searchTerm%' OR lname LIKE '%$searchTerm%' OR name LIKE '%$searchTerm%' OR email LIKE '%$searchTerm%' OR role LIKE '%$searchTerm%' ");
                    while ($row = $users->fetch()) {
                    ?>
                        <tr>
                            <td class="bg-light-pink border-grey"><?= $row['pseudo'] ?></td>
                            <td class="bg-light-pink border-grey w-25">
                                <div id="roleDisplay_<?= $row['id'] ?>">
                                    <?= $row['role'] ?>
                                    <button class="btn btn-link" onclick="showRoleSelect(<?= $row['id'] ?>)"><i class="fas fa-edit"></i></button>
                                </div>
                                <form action="/db/account.php" method="POST" id="roleForm_<?= $row['id'] ?>" style="display: none;">
                                    <div class="d-flex justify-content-center">
                                        <input type="hidden" name="form_name" value="updateRole">
                                        <input type="hidden" name="user_id" value="<?= $row['id'] ?>">
                                        <select name="role" class="form-select bg-light-pink border-0 w-50">
                                            <option value="utilisateur" <?= ($row['role'] == 'utilisateur') ? 'selected' : '' ?>>Utilisateur</option>
                                            <option value="moderateur" <?= ($row['role'] == 'moderateur') ? 'selected' : '' ?>>Moderateur</option>
                                        </select>
                                        <button type="submit" class="btn color-logo fw-bold btn-sm">Modifier</button>
                                    </div>
                                </form>
                            </td>
                            <td class="bg-light-pink border-grey"><?= $row['lname'] ?></td>
                            <td class="bg-light-pink border-grey"><?= $row['name'] ?></td>
                            <td class="bg-light-pink border-grey"><?= $row['email'] ?></td>
                            <td class="bg-light-pink border-grey">
                                <a href="/admin/delete.php?id=<?= $row['id'] ?>" class="link-dark"><i class="fa-solid fa-trash fs-5"></i></a>
                            </td>
                        </tr>
                    <?php
                    }
                    ?>
                </tbody>

                <script>
                    function showRoleSelect(userId) {
                        document.getElementById('roleDisplay_' + userId).style.display = 'none';
                        document.getElementById('roleForm_' + userId).style.display = 'block';
                    }
                </script>


            </table>
        </div>
    </div>
</main>
</div>
</div>


</body>

</html>