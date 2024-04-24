<?php
require_once 'utilities/head.php';
require_once 'utilities/nav.php';
require_once 'authentification/auth.php';
?>

<div class="container mt-6 ">
    <div class="row justify-content-center ">
        <div class="col-md-5">
            <div class="card bg-dark-pink p-4 rounded-4 shadow-sm">
                <form method="POST" action="/php/db.php">
                    <input type="hidden" name="form_name" value="creer">
                    <h4 class="my-4 text-center">Créer un post:</h4>
                    <textarea name="textareaPost" id="textareaPost" class="form-control bg-light-pink my-4 rounded-4" placeholder="Écrivez quelque chose de positif..." style="height: 10rem;"></textarea>
                    <button type="submit" class="btn bg-logo-color color-light-pink d-block mx-auto my-4">poster</button>
                </form>
            </div>
        </div>
    </div>
</div>


<?php
require_once 'utilities/footer.php';
?>