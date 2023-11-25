/*This code displays the responsive menu*/
var menu_toggle = document.querySelector('header .menu-toggle');
var menu = document.querySelector('header .menu');
menu_toggle.onclick = function () {
    menu_toggle.classList.toggle('active');
    menu.classList.toggle('responsive');
}