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

    // Function to update the quantity and total price
    function updateQuantityAndTotal(quantityInput, totalElement, change) {
        const unitPrice = parseFloat(quantityInput.getAttribute('data-unit-price'));
        let quantity = parseInt(quantityInput.value, 10) || 0;
		const stock = parseInt(quantityInput.getAttribute('data-product-stock'), 10) || 0;
		
        quantity += change;
        if (quantity < 0) {
            quantity = 0;
        }
		if (quantity > stock) {
        quantity = stock;
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

    // Code to handle removing items
    const removeButtons = document.querySelectorAll('.remove-button');
	removeButtons.forEach((button) => {
		button.addEventListener('click', function (event) {
			event.preventDefault();
			const productId = button.getAttribute('data-product-id');
			// Redirect to remove_cart.php with the productId
			window.location.href = 'php/remove_cart.php?product_id=' + productId;
		});
	});
});