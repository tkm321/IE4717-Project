<?php
session_start(); // Start the session to store the scroll position

$servername = "localhost";
$username = "jwongso001";
$password = "jwongso001";
$dbname = "Novatech";

// Create a new connection to the database
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// SQL query to remove all items from the cart (adjust table and column names as needed)
$sql = "DELETE FROM cart";

if ($conn->query($sql) === TRUE) {
    // Successfully cleared the cart
    header("Location: ../cart.php"); // Redirect to the shopping cart or any other appropriate page
} else {
    header("refresh:5; url=../cart.php");
    echo "Error clearing the cart: " . $conn->error;
}

// Close the database connection
$conn->close();
?>