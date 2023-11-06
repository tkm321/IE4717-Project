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

// Check if the user is logged in and get their member_id (modify this as needed)
if (isset($_SESSION['valid_user'])) {
    $valid_user = $_SESSION['valid_user'];

    // Retrieve the member_id based on the user's email (modify as needed)
    $sql = "SELECT member_id FROM members WHERE member_email = '$valid_user'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $member_id = $row['member_id'];
        
        // SQL query to remove all items from the cart for the specific user
        $deleteSql = "DELETE FROM cart WHERE member_id = $member_id";
        
        if ($conn->query($deleteSql) === TRUE) {
            // Successfully cleared the user's cart
            header("Location: ../cart.php"); // Redirect to the shopping cart or any other appropriate page
        } else {
            header("refresh:5; url=../cart.php");
            echo "Error clearing the cart: " . $conn->error;
        }
    } else {
        // Handle the case where the user's member_id was not found
        header("refresh:5; url=../cart.php");
        echo "User not found.";
    }
}

// Close the database connection
$conn->close();
?>