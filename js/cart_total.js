document.addEventListener("DOMContentLoaded", function () {
  // Get references to relevant elements
  const checkoutButton = document.getElementById("checkout-button");
  const productCheckboxes = document.querySelectorAll(".product-checkbox");
  const totalItemsCount = document.getElementById("total-items-count");
  const checkoutPriceForAll = document.getElementById("checkout-price-for-all");
  const quantityInputs = document.querySelectorAll(".product-quantity");

  // Add a change event listener to a common ancestor element
  document.getElementById("product-cart").addEventListener("change", function (event) {
    if (event.target.classList.contains("product-checkbox") || event.target.classList.contains("product-quantity")) {
      updateCheckoutTotals();
    }
  });

  // Calculate and update the checkout totals
  function updateCheckoutTotals() {
    let totalPrice = 0;
    let totalItems = 0;

    productCheckboxes.forEach(function (checkbox, index) {
      if (checkbox.checked) {
        const productRow = checkbox.closest("tr");
        const quantityInput = quantityInputs[index];
        const unitPrice = parseFloat(quantityInput.getAttribute("data-unit-price"));
        const quantity = parseInt(quantityInput.value);

        totalPrice += unitPrice * quantity;
        totalItems += quantity;
      }
    });

    // Update the total price
    updateTotalPrice(totalPrice);
    // Update the total item count
    updateTotalItemCount(totalItems);

    // Enable or disable the checkout button based on whether items are selected
    checkoutButton.disabled = totalItems === 0;
  }

  // Function to update the total price
  function updateTotalPrice(totalPrice) {
    checkoutPriceForAll.textContent = "$" + totalPrice.toFixed(2);
  }

  // Function to update the total item count
  function updateTotalItemCount(totalItems) {
    totalItemsCount.textContent = totalItems;
  }

  // Initialize the checkout totals on page load
  updateCheckoutTotals();

  // Function to confirm checkout
  function confirmCheckout() {
    return confirm("Do you want to proceed with the checkout?");
  }

  checkoutButton.addEventListener("click", function (event) {
    if (!confirmCheckout()) {
      event.preventDefault(); // Prevent the form submission if confirmation is canceled.
    }
  });

  // Polling interval to constantly check for quantity changes (you can adjust the interval as needed)
  setInterval(function () {
    updateCheckoutTotals();
  }, 0);
});