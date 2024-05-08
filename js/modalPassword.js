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