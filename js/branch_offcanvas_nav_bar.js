// declared constatnts
const mainOnMenu1 = document.querySelector(".main-container");
const btnMenu1 = document.querySelector(".main-menu");
const menuText = document.querySelector(".of-txt");
const menuText1 = document.querySelector(".of-txt1");
const menuText3 = document.querySelector(".of-txt3");
const menuText4 = document.querySelector(".of-txt4");


const menuText7 = document.querySelector(".of-txt7");
const sideBar1 = document.querySelector(".sidebar-nav");
const navbarOnMenu1 = document.querySelector(".navbar");

// Click handler of menu button that hides offcanvas
btnMenu1.addEventListener("click", function () {
  menuText.classList.toggle("hidden");
  menuText1.classList.toggle("hidden");
  menuText3.classList.toggle("hidden");
  menuText4.classList.toggle("hidden");


  menuText7.classList.toggle("hidden");
  sideBar1.classList.toggle("reduced-size");
  navbarOnMenu1.classList.toggle("main-on-menu");
  mainOnMenu1.classList.toggle("main-on-menu");
});
let subMenu = document.getElementById("subMenu");

function toggleMenu() {
  subMenu.classList.toggle("open-menu");
}