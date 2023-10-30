
var slideIndex = 1;

// Function to show the initial slide
showSlides(slideIndex);

// Function to move to the next or previous slide
function plusSlides(n) {
	showSlides(slideIndex += n);
}

// Function to display a specific slide
function currentSlide(n) {
	showSlides(slideIndex = n);
}

// Function to control the slideshow
function showSlides(n) {
	var i;
	var slides = document.getElementsByClassName("mySlides");
	var thumbnails = document.getElementsByClassName("thumbnail");

	if (n > slides.length) {
		slideIndex = 1;
	}

	if (n < 1) {
		slideIndex = slides.length;
	}

	// Hide all slides and remove the "active" class from thumbnails
	for (i = 0; i < slides.length; i++) {
		slides[i].style.display = "none";
		thumbnails[i].classList.remove("active");
	}

	// Show the current slide and add the "active" class to the corresponding thumbnail
	slides[slideIndex - 1].style.display = "block";
	thumbnails[slideIndex - 1].classList.add("active");
}

