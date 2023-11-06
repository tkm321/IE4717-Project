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

    // Check if the user is logged in and get their member_id
    if (isset($_SESSION['valid_user'])) {
        $valid_user = $_SESSION['valid_user'];

        // Retrieve the member_id based on the user's email (modify as needed)
        $sql = "SELECT member_id FROM members WHERE member_email = '$valid_user'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $member_id = $row['member_id'];

            // SQL query to remove the item from the cart based on 'product_id' and 'member_id'
            $deleteSql = "DELETE FROM cart WHERE product_id = $product_id AND member_id = $member_id";

            if ($conn->query($deleteSql) === TRUE) {
                // Successfully removed the item
                header("Location: ../cart.php"); // Redirect to the shopping cart or any other appropriate page
            } else {
                echo "Error removing the item from the cart: " . $conn->error;
                header("refresh:5; url=../cart.php");
            }
        } else {
            // Handle the case where the user's member_id was not found
            echo "User not found.";
            header("refresh:5; url=../cart.php");
        }
    } else {
        // Handle the case where the user is not logged in
        echo "User is not logged in.";
        header("refresh:5; url=../cart.php");
    }
} else {
    echo "Error 404: 'product_id' not provided.";
    header("refresh:5; url=../../"); // Redirect to the shopping cart if 'product_id' is not provided
}

// Close the database connection
$conn->close();
?>