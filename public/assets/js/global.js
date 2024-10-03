// Menu Burger

var navmob = document.getElementById("mobile");
var openBtn = document.getElementById("openBtn");
var closeBtn = document.getElementById("closeBtn");

openBtn.onclick = openNav;
closeBtn.onclick = closeNav;

/* Set the width of the side navigation to 250px */
function openNav() {
navmob.classList.add("active");
}

/* Set the width of the side navigation to 0 */
function closeNav() {
navmob.classList.remove("active");
}
