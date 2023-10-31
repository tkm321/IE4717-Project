<?php
// Database connection configuration
$servername = "localhost"; // Change this to your database server
$username = "jwongso001"; // Change this to your database username
$password = "jwongso001"; // Change this to your database password
$database = "novatech"; // Change this to your database name

// Create a connection to the database
$conn = new mysqli($servername, $username, $password, $database);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle the form submission based on the "action" value
if (isset($_GET['action'])) {
    $action = $_GET['action'];

    // Capture the quantity from the form
    $quantity = isset($_GET['qty']) ? $_GET['qty'] : 0;

    if ($action === "wishlist") {
        // Add to wishlist logic here, regardless of quantity
        // For example, you can insert the product into the wishlist table
        // and display a message or perform any necessary actions
        echo "Product added to wishlist.";
    } elseif ($action === "cart") {
        // Add to cart logic here, but only if quantity is greater than 0
        if ($quantity > 0) {
            // Insert the product into the cart table and perform other cart-related actions
            echo "Product added to cart with quantity: " . $quantity;
        } else {
            // Handle the case where quantity is 0 for cart (e.g., display an error message)
            echo "Quantity must be greater than 0 to add to cart.";
        }
    } else {
        echo "Invalid action!";
    }
} else {
    echo "Action not specified!";
}
?>