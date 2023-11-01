
function confirmRemoveAll() {
	const confirmation = confirm("Are you sure you want to remove all?");
	if (confirmation) {
		// Proceed with the removal of all items action (you can implement this)
		// For example, you can send an AJAX request to clear the entire cart
	}
}

function confirmCheckout() {
    const confirmation = confirm("Checking out now. Are you sure?");
    return confirmation; // If confirmed, the form will be submitted; if canceled, the form submission will be prevented
}