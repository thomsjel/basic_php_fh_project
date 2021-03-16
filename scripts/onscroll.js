
/*
// function wird aufgerufen beim scrollen
window.onscroll = function() {stickyHeader()};

// header
var header = document.getElementById("loginPost");

// header position
var sticky = header.offsetTop;

function stickyHeader() {
    if (window.pageYOffset > sticky) {
        header.classList.add("sticky");
        //header.classList.add("width");
        console.log("sticky ist da");
    } else {
        header.classList.remove("sticky");
        //header.classList.remove("width");
        console.log("sticky ist WEG");
    }
}
*/

//ScrollToTop

//Get the button:
var mybutton = document.getElementById("scrollToTopButton");

// When the user scrolls down 20px from the top of the document, show the button
window.onscroll = function() {scrollToTop()};

function scrollToTop() {
    if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
        mybutton.style.display = "block";
    } else {
        mybutton.style.display = "none";
    }
}

// When the user clicks on the button, scroll to the top of the document
function scrollToTopFunction() {
    document.body.scrollTop = 0; // For Safari
    document.documentElement.scrollTop = 0; // For Chrome, Firefox, IE and Opera
}

var msg = document.getElementById("messages");
