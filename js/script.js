// window.addEventListener("scroll", function() {
//   const header = document.querySelector("header");
//   const scrollPosition = window.scrollY;

//   if (scrollPosition > 100) {
//     header.classList.add("scrolled");
//   } else {
//     header.classList.remove("scrolled");
//   }
// });



// //header

// $(function () {
//   $(".menu-link").click(function () {
//    $(".menu-link").removeClass("is-active");
//    $(this).addClass("is-active");
//   });
//  });
 
//  $(function () {
//   $(".main-header-link").click(function () {
//    $(".main-header-link").removeClass("is-active");
//    $(this).addClass("is-active");
//   });
//  });
 
//  const dropdowns = document.querySelectorAll(".dropdown");
//  dropdowns.forEach((dropdown) => {
//   dropdown.addEventListener("click", (e) => {
//    e.stopPropagation();
//    dropdowns.forEach((c) => c.classList.remove("is-active"));
//    dropdown.classList.add("is-active");
//   });
//  });
 
//  $(".search-bar input")
//   .focus(function () {
//    $(".header").addClass("wide");
//   })
//   .blur(function () {
//    $(".header").removeClass("wide");
//   });
 
//  $(document).click(function (e) {
//   var container = $(".status-button");
//   var dd = $(".dropdown");
//   if (!container.is(e.target) && container.has(e.target).length === 0) {
//    dd.removeClass("is-active");
//   }
//  });
 
//  $(function () {
//   $(".dropdown").on("click", function (e) {
//    $(".content-wrapper").addClass("overlay");
//    e.stopPropagation();
//   });
//   $(document).on("click", function (e) {
//    if ($(e.target).is(".dropdown") === false) {
//     $(".content-wrapper").removeClass("overlay");
//    }
//   });
//  });
 
//  $(function () {
//   $(".status-button:not(.open)").on("click", function (e) {
//    $(".overlay-app").addClass("is-active");
//   });
//   $(".pop-up .close").click(function () {
//    $(".overlay-app").removeClass("is-active");
//   });
//  });
 
//  $(".status-button:not(.open)").click(function () {
//   $(".pop-up").addClass("visible");
//  });
 
//  $(".pop-up .close").click(function () {
//   $(".pop-up").removeClass("visible");
//  });
 
//  const toggleButton = document.querySelector('.dark-light');
 
//  toggleButton.addEventListener('click', () => {
//    document.body.classList.toggle('light-mode');
//  });

// //navbar

// document.addEventListener('DOMContentLoaded', function() {
//   const dropdownToggle = document.querySelector('.dropdown-toggle');
//   const dropdownMenu = document.querySelector('.dropdown-menu');

//   dropdownToggle.addEventListener('click', function(e) {
//       e.preventDefault();
//       dropdownMenu.style.display = dropdownMenu.style.display === 'block' ? 'none' : 'block';
//   });

//   // Ferme le menu si on clique en dehors
//   document.addEventListener('click', function(e) {
//       if (!dropdownToggle.contains(e.target) && !dropdownMenu.contains(e.target)) {
//           dropdownMenu.style.display = 'none';
//       }
//   });
// });





