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

// Check if the 'product_id' is set in the URL
if (isset($_GET['product_id'])) {
    $product_id = $_GET['product_id'];

    // SQL query to remove the item from the cart based on 'product_id'
    $sql = "DELETE FROM cart WHERE product_id = $product_id";

    if ($conn->query($sql) === TRUE) {
        // Successfully removed the item
        header("Location: ../cart.php"); //Redirect to the shopping cart or any other appropriate page
    } else {
        
        echo "Error removing the item from the cart: " . $conn->error;
		header("refresh:5; url=../cart.php");
    }
} else {
	echo "Error 404" . $conn->error;
    header("refresh:5; Location: ../../");  //Redirect to the shopping cart if 'product_id' is not provided
}

// Close the database connection
$conn->close();
?>