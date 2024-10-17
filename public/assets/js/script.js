// Menu Burger

var navmob = document.getElementById("mobile"); // Sélectionne l'élément du menu mobile en utilisant son ID mobile.
var openBtn = document.getElementById("openBtn"); // Sélectionne le bouton qui ouvre le menu en utilisant son ID openBtn.
var closeBtn = document.getElementById("closeBtn");// Sélectionne le bouton qui ferme le menu en utilisant son ID closeBtn.

openBtn.onclick = openNav;// Lorsque l'utilisateur clique sur le bouton d'ouverture, la fonction openNav est appelée.
closeBtn.onclick = closeNav;// Lorsque l'utilisateur clique sur le bouton de fermeture, la fonction closeNav est appelée.


function openNav() {
navmob.classList.add("active"); // Cette fonction ajoute la classe active à l'élément navmob, ce qui active le menu.
}


function closeNav() {
navmob.classList.remove("active");// Cette fonction supprime la classe active de l'élément navmob, fermant ainsi le menu.
}