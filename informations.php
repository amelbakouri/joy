<?php
require_once 'utilities/head.php';
require_once 'utilities/nav.php';
require_once 'function/generic.php';
$user = requestOne($conn, "SELECT pseudo, name, lname, email FROM user WHERE id = $userID");

// On appelle $user->name, parce que c'est un tableau d'objet de type stdclass et on recupere donc chaque donnée avec l'operateur ->

?>

<div class="container mt-6 mb-5 d-flex justify-content-center">
    <div class="card px-5 py-4 bg-dark-pink rounded-4 shadow-sm">
        <div class="card-body">
            <h4 class="mb-4 text-center">Modifier vos informations</h4>

            <form method="POST" action="/db/account.php">
                <input type="hidden" name="form_name" value="informations">
                <div class="row mb-4">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="name">Prénom :</label>
                            <input id="name" name="name" class="form-control bg-light-pink" type="text" value="<?php echo $user->name; ?>">
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="lname">Nom :</label>
                            <input id="lname" name="lname" class="form-control bg-light-pink" type="text" value="<?php echo $user->lname; ?>">
                        </div>
                    </div>
                </div>


                <div class="row mb-4">
                    <div class="col-sm-6 mt-4">
                        <div class="form-group">
                            <label for="pseudo">pseudo :</label>
                            <input id="pseudo" name="pseudo" class="form-control bg-light-pink" type="text" value="<?php echo $user->pseudo; ?>">
                        </div>
                    </div>

                    <div class="col-sm-6 mt-4">
                        <div class="form-group">
                            <label for="email">Email :</label>
                            <input id="email" name="email" class="form-control bg-light-pink" type="text" value="<?php echo $user->email; ?>">
                        </div>
                    </div>
                </div>


                <div class="row justify-content-center mt-5">
                    <button type="submit" class="w-50 btn bg-logo-color color-light-pink btn-block ">Modifier</button>
                </div>
            </form>

        </div>
    </div>
</div>


<?php
require_once 'utilities/footer.php';
?>