<?php
session_start(); // Start the session to store the scroll position

$servername = "localhost";
$username = "jwongso001";
$password = "jwongso001";
$dbname = "Novatech";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$redirectDelay = 5; // Delay in seconds

if (isset($_POST['submit'])) {
    if (isset($_POST['product_ids'], $_POST['quantity'])) {
        $selectedProductIds = $_POST['product_ids'];
        $quantities = $_POST['quantity'];

        // Loop through the selected product IDs and quantities
        for ($i = 0; $i < count($selectedProductIds); $i++) {
            $productId = $selectedProductIds[$i];
            $quantity = $quantities[$i];

            // Fetch product details (product_id and unit_price) from the database
            $sql = "SELECT product_id, product_price FROM products WHERE product_id = $productId";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                // Fetch the unit price from the database result
                $row = $result->fetch_assoc();
                $unitPrice = $row['product_price'];
				echo "Selected Product ID: $productId, Quantity: $quantity, Unit Price: $unitPrice<br>";
                
            } else {
                echo "Product with ID $productId not found in the database.";
            }
        }

        // Now, you have an array $productDetails with product IDs and their corresponding unit prices.

        // Perform further processing or database operations as needed.
    } else {
        // No products selected
        echo "No products selected for checkout.";
        echo "<p>Redirecting in $redirectDelay seconds...<br><a href='../cart.php'>Click here</a> to redirect instantly.</p>";

        echo "<script>
            setTimeout(function() {
                window.location.href = '../cart.php'; // Redirect after delay
            }, " . ($redirectDelay * 1000) . "); // Convert seconds to milliseconds
        </script>";
    }
}

$conn->close();
?>