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

    // If quantity is 0, set it to 1, as we want the buyer to be able to add one item if never stated
    if ($quantity == 0) {
        $quantity = 1;
    }

    if ($action === "wishlist") {
        // For "Add to Wishlist," set the quantity to 1, as we don't care about qty for wishlist
        $quantity = 1;
        // Add to wishlist logic here, using $quantity
        // For example, you can insert the product into the wishlist table
        // and display a message or perform any necessary actions
        echo "Product added to wishlist with quantity: " . $quantity;
    } elseif ($action === "cart") {
        // For "Add to Cart," the quantity will be the entered quantity (with 0 turned into 1)
        // Add to cart logic here, using $quantity
        // For example, you can insert the product into the cart table
        // and display a message or perform any necessary actions
        echo "Product added to cart with quantity: " . $quantity;
    } else {
        echo "Invalid action!";
    }
} else {
    echo "Action not specified!";
}
?>





