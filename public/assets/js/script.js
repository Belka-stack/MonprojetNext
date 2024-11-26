// Menu Burger

// Sélection des éléments HTML

var navmob = document.getElementById("mobile"); 
var openBtn = document.getElementById("openBtn"); 
var closeBtn = document.getElementById("closeBtn");


// Quand on clique sur le bouton openBtn (menu burger), la fonction openNav est appelée.
// Quand on clique sur le bouton closeBtn (icône de fermeture "×"), la fonction closeNav est appelée.

openBtn.onclick = openNav;
closeBtn.onclick = closeNav;


// Cette fonction est appelée quand l'utilisateur clique sur le bouton pour ouvrir le menu mobile.
//  Elle ajoute la classe CSS "active" à l'élément navmob (le <div> du menu mobile)

function openNav() {
navmob.classList.add("active"); 
}

// Cette fonction est appelée quand l'utilisateur clique sur le bouton pour fermer le menu mobile.
// Elle retire la classe CSS "active" de l'élément navmob, ce qui cache le menu.

function closeNav() {
navmob.classList.remove("active");
}

