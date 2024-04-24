<div id="myModal" class="modalStyle">
    <div class="container d-flex justify-content-center align-items-center"> <!-- Ajout de align-items-center -->
        <div class="card px-4 py-3 bg-dark-pink rounded-4 shadow-sm myModal-content">
            <div class="card-body">
                <h4 class="mb-4 text-center">Changer votre mot de passe</h4>
                <span class="close" style="position: absolute; top: 10px; right: 10px;">&times;</span>

                <!-- à faire action="" -->
                <form method="POST" action="/php/db.php">
                <input type="hidden" name="form_name" value="changePassword">
                    <div class="row mb-4">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label for="oldPassword">Ancien mot de passe :</label>
                                <input id="oldPassword" name="oldPassword" class="form-control bg-light-pink" type="password" required>
                            </div>
                        </div>
                    </div>

                    <div class="row mb-4">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label for="newPassword">Nouveau mot de passe :</label>
                                <input id="newPassword" name="newPassword" class="form-control bg-light-pink" type="password" required>
                            </div>
                        </div>
                    </div>

                    <div class="row mb-4">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label for="confirmPassword">Confirmez le mot de passe :</label>
                                <input id="confirmPassword" name="confirmPassword" class="form-control bg-light-pink" type="password" required>
                            </div>
                        </div>
                    </div>

                    <div class="row justify-content-center mt-3">
                        <button type="submit" class="w-50 btn bg-logo-color color-light-pink btn-block">Modifier</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>




<script>
// récuperer la modal
var modal = document.getElementById("myModal");

// récuperer l'endroit où on clique pour ouvrir la modal
var click = document.getElementById("click");

// récuperer la croix qui ferme la modal
var span = document.getElementsByClassName("close")[0];

// lorsqu'on clique on ouvre la modal
click.onclick = function() {
    modal.style.setProperty('display', 'block', 'important');
}

// fermer la modal quand on clique sur la croix
span.onclick = function() {
  modal.style.setProperty('display', 'none', 'important');
}

// Si l'on clique autre part que la modal ça la ferme
window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.setProperty('display', 'none', 'important');
  }
}

</script>

<!-- source modal: https://www.w3schools.com/howto/howto_css_modals.asp -->