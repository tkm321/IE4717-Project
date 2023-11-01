document.addEventListener("DOMContentLoaded", function() {
    // Get references to relevant elements
    const checkoutButton = document.getElementById("checkout-button");
    const productCheckboxes = document.querySelectorAll('.product-checkbox');
    const totalItemsCount = document.getElementById("total-items-count");
    const checkoutPriceForAll = document.getElementById("checkout-price-for-all");
    const quantityInputs = document.querySelectorAll('.product-quantity');

    // Add change event listener to checkboxes
    productCheckboxes.forEach(function(checkbox, index) {
        checkbox.addEventListener('change', updateCheckoutTotals);
        quantityInputs[index].addEventListener('input', updateCheckoutTotals);
    });

    // Calculate and update the checkout totals
    function updateCheckoutTotals() {
        let totalPrice = 0;
        let totalItems = 0;

        productCheckboxes.forEach(function(checkbox, index) {
            if (checkbox.checked) {
                const productRow = checkbox.closest('tr');
                const quantityInput = quantityInputs[index];
                const unitPrice = parseFloat(quantityInput.getAttribute('data-unit-price'));
                const quantity = parseInt(quantityInput.value);

                totalPrice += unitPrice * quantity;
                totalItems++;
            }
        });

        // Update the total items count and the checkout total price
        totalItemsCount.textContent = totalItems;
        checkoutPriceForAll.textContent = "$" + totalPrice.toFixed(2);

        // Enable or disable the checkout button based on whether items are selected
        checkoutButton.disabled = totalItems === 0;
    }

    // Initialize the checkout totals on page load
    updateCheckoutTotals();

    // Function to confirm checkout
    function confirmCheckout() {
        return confirm("Do you want to proceed with the checkout?");
    }

    checkoutButton.addEventListener('click', function(event) {
        if (!confirmCheckout()) {
            event.preventDefault(); // Prevent the form submission if confirmation is canceled.
        }
    });

    // Polling interval to constantly check for quantity changes
    setInterval(function() {
        updateCheckoutTotals();
    }, 0); // Adjust the polling interval as needed
});