// declared constatnts
const mainOnMenu = document.querySelector(".main-container");
const btnMenu = document.querySelector(".main-menu");
const menuText = document.querySelector(".of-txt");
const menuText1 = document.querySelector(".of-txt1");
const menuText2 = document.querySelector(".of-txt2");
const menuText3 = document.querySelector(".of-txt3");
const menuText4 = document.querySelector(".of-txt4");
const menuText6 = document.querySelector(".of-txt6");
const menuText7 = document.querySelector(".of-txt7");
const sideBar = document.querySelector(".sidebar-nav");
const navbarOnMenu = document.querySelector(".navbar");

// Click handler of menu button that hides offcanvas
btnMenu.addEventListener("click", function () {
  menuText.classList.toggle("hidden");
  menuText1.classList.toggle("hidden");
  menuText2.classList.toggle("hidden");
  menuText3.classList.toggle("hidden");
  menuText4.classList.toggle("hidden");
  menuText6.classList.toggle("hidden");
  menuText7.classList.toggle("hidden");
  sideBar.classList.toggle("reduced-size");
  navbarOnMenu.classList.toggle("main-on-menu");
  mainOnMenu.classList.toggle("main-on-menu");
});
let subMenu = document.getElementById("subMenu");

function toggleMenu() {
  subMenu.classList.toggle("open-menu");
}
