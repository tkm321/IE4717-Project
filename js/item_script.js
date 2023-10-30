document.addEventListener('DOMContentLoaded', function () {
  // Get all the dropdown buttons
  const dropdownButtons = document.querySelectorAll('.dropdown-btn');

  // Add a click event listener to each dropdown button
  dropdownButtons.forEach(button => {
    button.addEventListener('click', () => {
      const contentId = button.getAttribute('data-content');
      const content = document.getElementById(contentId);

      // Hide all dropdown contents
      const allContents = document.querySelectorAll('.dropdown-content');
      allContents.forEach(content => {
        content.style.display = 'none';
      });

      // Show the corresponding content
      content.style.display = 'block';
    });
  });
});

document.addEventListener("DOMContentLoaded", function () {
    const decrementButton = document.getElementById("decrement");
    const incrementButton = document.getElementById("increment");
    const qtyInput = document.getElementById("qty");

    decrementButton.addEventListener("click", () => {
        if (parseInt(qtyInput.value) > 0) {
            qtyInput.value = parseInt(qtyInput.value) - 1;
        }
    });

    incrementButton.addEventListener("click", () => {
        qtyInput.value = parseInt(qtyInput.value) + 1;
    });
});