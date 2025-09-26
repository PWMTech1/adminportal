

// When the user scrolls down 80px from the top of the document, resize the navbar's padding and the logo's font size
window.onscroll = function() {scrollFunction()};

function scrollFunction() {
  if (document.body.scrollTop > 80 || document.documentElement.scrollTop > 80) {
    document.getElementById("nav").classList.add('nav-shrink');
  } else {
    document.getElementById("nav").classList.remove('nav-shrink');
  }
}

/* Open when someone clicks on the span element */
function openNav() {
  document.getElementById("mobile-nav").style.width = "100%";
}

/* Close when someone clicks on the "x" symbol inside the overlay */
function closeNav() {
  document.getElementById("mobile-nav").style.width = "0%";
}


// HIGHLIGHTS THE NAV WHEN SCROLL TO SECTION
function navHighlighter() {

  // Get current scroll position
  let scrollY = window.pageYOffset;

  // Now we loop through sections to get height, top and ID values for each
  sections.forEach(current => {
      const sectionHeight = current.offsetHeight;
      const sectionTop = current.offsetTop - 150;
      const sectionId = current.getAttribute('id');

       /*
      - If our current scroll position enters the space where current section on screen is, add .active class to corresponding navigation link, else remove it
      - To know which link needs an active class, we use sectionId variable we are getting while looping through sections as an selector
      */
      if(
          scrollY > sectionTop &&
          scrollY <= sectionTop + sectionHeight
      ){
          document.querySelector(".nav-desktop a[href*=" + sectionId + "]").classList.add("active");
      } else {
          document.querySelector(".nav-desktop a[href*=" + sectionId + "]").classList.remove("active");
      }
  });

}