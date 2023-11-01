document.addEventListener('DOMContentLoaded', function () {
    const selectAllButton = document.getElementById('select-all-button');
    const removeAllButton = document.getElementById('remove-all-button');
    const checkoutButton = document.getElementById('checkout-button');
    const productCheckboxes = document.querySelectorAll('.product-checkbox');
    const incrementButtons = document.querySelectorAll('.increment-button');
    const decrementButtons = document.querySelectorAll('.decrement-button');
    const quantityInputs = document.querySelectorAll('.product-quantity');
    const totalPrices = document.querySelectorAll('.cart-totalprice');

	selectAllButton.addEventListener('click', function () {
		event.preventDefault();
		const areAllChecked = [...productCheckboxes].every(checkbox => checkbox.checked);
		
		productCheckboxes.forEach(function (checkbox) {
			checkbox.checked = !areAllChecked;
		});
	});



    checkoutButton.addEventListener('click', function () {
        // Handle the checkout logic here
        // You can submit the form with AJAX or perform other actions
        document.getElementById('cart-form').submit();
    });

    // Function to update the quantity and total price
    function updateQuantityAndTotal(quantityInput, totalElement, change) {
        const unitPrice = parseFloat(quantityInput.getAttribute('data-unit-price'));
        let quantity = parseInt(quantityInput.value, 10) || 0;

        quantity += change;
        if (quantity < 0) {
            quantity = 0;
        }

        quantityInput.value = quantity;
        const totalPrice = unitPrice * quantity;

        // Format the total price with "$" and commas for thousands
        totalElement.textContent = totalPrice.toLocaleString('en-US', {
            style: 'currency',
            currency: 'USD',
            minimumFractionDigits: 2
        });
    }

    // Add event listeners to the increment buttons
    incrementButtons.forEach((button, index) => {
        button.addEventListener('click', (event) => {
            event.preventDefault();
            const quantityInput = quantityInputs[index];
            updateQuantityAndTotal(quantityInput, totalPrices[index], 1);
        });
    });

    // Add event listeners to the decrement buttons
    decrementButtons.forEach((button, index) => {
        button.addEventListener('click', (event) => {
            event.preventDefault();
            const quantityInput = quantityInputs[index];
            updateQuantityAndTotal(quantityInput, totalPrices[index], -1);
        });
    });

    // Add input event listener to quantity inputs
    quantityInputs.forEach((quantityInput, index) => {
        quantityInput.addEventListener('input', () => {
            updateQuantityAndTotal(quantityInput, totalPrices[index], 0);
        });
    });
	
	checkoutButton.addEventListener('click', function () {
        // Handle the checkout logic here
        // You can submit the form with AJAX or perform other actions
        // For now, let's redirect to checkout_order.php
        window.location.href = 'PHP/checkout_order.php';
    });
	
	    function confirmRemove(productId) {
        const confirmation = confirm("Are you sure you want to remove 1 item?");
        if (confirmation) {
            // Proceed with the removal action (you can implement this)
            // For example, you can send an AJAX request to remove the item from the cart
        }
    }

    function confirmRemoveAll() {
        const confirmation = confirm("Are you sure you want to remove all?");
        if (confirmation) {
            // Proceed with the removal of all items action (you can implement this)
            // For example, you can send an AJAX request to clear the entire cart
        }
    }

    function confirmCheckout() {
        const confirmation = confirm("Checking out now. Are you sure?");
        if (confirmation) {
            // If confirmed, the form will be submitted, and you'll go to checkout_order.php
        }
    }
});