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

if (isset($_POST['submit'])) { // Check if the form was submitted
    if (isset($_POST['product_ids']) && is_array($_POST['product_ids']) && !empty($_POST['product_ids'])) {
        // Retrieve the selected product IDs
        $selectedProductIds = $_POST['product_ids'];

        // Loop through the selected product IDs
        foreach ($selectedProductIds as $productId) {
            // Process each selected product ID as needed
            // You can insert them into the 'orders' table or perform other actions here
            echo "Selected Product ID: $productId<br>";
        }
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