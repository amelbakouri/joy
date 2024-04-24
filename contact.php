<?php
require_once 'utilities/head.php';
require_once 'utilities/nav.php';
require_once 'authentification/auth.php';
?>

<div class="container mt-5 mb-5 d-flex justify-content-center">
    <div class="card px-5 py-3 bg-dark-pink rounded-4 shadow-sm">
        <div class="card-body">
            <h4 class="mb-4 text-center">Un problème ? Contactez nous</h4>

            <!-- à faire : action="" -->
            <form id="contactForm" action=".php" method="post">
                <div class="row mb-4">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="name">Nom :</label>
                            <input id="name" class="form-control bg-light-pink" type="text" name="name" placeholder="John" required>
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="email">Email :</label>
                            <input id="email" class="form-control bg-light-pink" type="email" name="email" placeholder="john@gmail.com" required>
                        </div>
                    </div>
                </div>

                <div class="row mb-4">
                    <div class="col-sm-12">
                        <div class="form-group">
                            <textarea id="message" class="form-control bg-light-pink" style="height: 8rem;" name="message" placeholder="Votre message..." required></textarea>
                        </div>
                    </div>
                </div>

                <div class="row justify-content-center mt-3">
                    <button type="submit" class="w-50 btn bg-logo-color color-light-pink btn-block">Envoyer</button>
                </div>
            </form>
            <p class="mt-4 text-center">En envoyant ce message, vous acceptez notre <a href="">politique de confidentialité</a>.</p>
        </div>
    </div>
</div>

<?php
require_once 'utilities/footer.php';
?>