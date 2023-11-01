
function confirmRemoveAll() {
	const confirmation = confirm("Are you sure you want to remove all?");
	if (confirmation) {
		window.location.href = "php/clear_cart.php"
	}
}
