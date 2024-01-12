// declared constatnts

const btnMenu = document.querySelector(".main-menu");
const menuText = document.querySelector(".of-txt");
const menuText1 = document.querySelector(".of-txt1");
const menuText2 = document.querySelector(".of-txt2");
const menuText3 = document.querySelector(".of-txt3");
const menuText4 = document.querySelector(".of-txt4");
const menuText5 = document.querySelector(".of-txt5");
const menuText6 = document.querySelector(".of-txt6");
const menuText7 = document.querySelector(".of-txt7");
const sideBar = document.querySelector(".sidebar-nav");
const mainOnMenu = document.querySelector(".main-container");
const navbarOnMenu = document.querySelector(".navbar");

// Offcanvas bar constant
const vehicles = document.querySelector(".vehicles");
const dashboard = document.querySelector(".dashboard");
const passengers = document.querySelector(".passengers");
const traffic = document.querySelector(".traffic");

// Main conatainers conastants
const dashboardMainContainers = document.querySelector(
  ".dashboard-main-container"
);
const vehiclesMainContainer = document.querySelector(
  ".vehicles-main-container"
);
const passengersMainContainers = document.querySelector(
  ".passengers-main-container"
);
const trafficMainContainer = document.querySelector(".traffic-main-container");

// Click handler of menu button that hides offcanvas
btnMenu.addEventListener("click", function () {
  menuText.classList.toggle("hidden");
  menuText1.classList.toggle("hidden");
  menuText2.classList.toggle("hidden");
  menuText3.classList.toggle("hidden");
  menuText4.classList.toggle("hidden");
  menuText5.classList.toggle("hidden");
  menuText6.classList.toggle("hidden");
  menuText7.classList.toggle("hidden");
  sideBar.classList.toggle("reduced-size");
  dashboardMainContainers.classList.toggle("main-on-menu");
  vehiclesMainContainer.classList.toggle("main-on-menu");
  passengersMainContainers.classList.toggle("main-on-menu");
  trafficMainContainer.classList.toggle("main-on-menu");
  navbarOnMenu.classList.toggle("main-on-menu");
});

// Get the button
let mybutton = document.getElementById("myBtn");

// When the user scrolls down 20px from the top of the document, show the button
window.onscroll = function () {
  scrollFunction();
};

function scrollFunction() {
  if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
    mybutton.style.display = "block";
  } else {
    mybutton.style.display = "none";
  }
}

// When the user clicks on the button, scroll to the top of the document
function topFunction() {
  document.body.scrollTop = 0;
  document.documentElement.scrollTop = 0;
}

// When the dashboard button clicked

dashboard.addEventListener("click", function () {
  dashboardMainContainers.classList.remove("hidden");
  vehiclesMainContainer.classList.add("hidden");
  passengersMainContainers.classList.add("hidden");
  trafficMainContainer.classList.add("hidden");
});

// When the vehicles button clicked

vehicles.addEventListener("click", function () {
  vehiclesMainContainer.classList.remove("hidden");
  dashboardMainContainers.classList.add("hidden");
  passengersMainContainers.classList.add("hidden");
  trafficMainContainer.classList.add("hidden");
});

// When the passengers button clicked

passengers.addEventListener("click", function () {
  passengersMainContainers.classList.remove("hidden");
  vehiclesMainContainer.classList.add("hidden");
  dashboardMainContainers.classList.add("hidden");
  trafficMainContainer.classList.add("hidden");
});

// When the traffic button clicked

traffic.addEventListener("click", function () {
  trafficMainContainer.classList.remove("hidden");
  passengersMainContainers.classList.add("hidden");
  vehiclesMainContainer.classList.add("hidden");
  dashboardMainContainers.classList.add("hidden");
});
