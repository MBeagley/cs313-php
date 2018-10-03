var sticky;
var cartCount;

// When the user scrolls the page, execute myFunction 
window.onscroll = function() {myFunction()};

window.onload = function() {
	// Get the navbar
	var navbar = document.getElementById("navbar");

	// Get the offset position of the navbar
	sticky = navbar.offsetTop;

	cartCount = 0;
};

// Add the sticky class to the navbar when you reach its scroll position. Remove "sticky" when you leave the scroll position
function myFunction() {

	if (window.pageYOffset >= sticky) {
		navbar.classList.add("sticky")
	} else {
		navbar.classList.remove("sticky");
		console.log("removed");
	}
}

function addItem(count) {
	cartCount += parseInt(count);
	document.getElementById("cart").innerHTML = "Cart(" + cartCount + ")";
}