<?php
session_start();

$servername = "localhost";
$username = "jwongso001";
$password = "jwongso001";
$dbname = "Novatech";

$conn = new mysqli($servername, $username, $password, $dbname);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if (isset($_SESSION['valid_user'])) {
    $valid_user = $_SESSION['valid_user'];

    // Retrieve the member_id from the database based on the member_email (assuming member_email is unique)
    $memberEmail = $valid_user;

    $memberIdStmt = $conn->prepare("SELECT member_id FROM members WHERE member_email = ?");
    $memberIdStmt->bind_param("s", $memberEmail);
    $memberIdStmt->execute();
    $memberIdStmt->bind_result($member_id);
    $memberIdStmt->fetch();
    $memberIdStmt->close();
}


if (isset($member_id)) {
    // Check if the form has been submitted
    if (isset($_POST['submit'])) {
        // Retrieve the values from the hidden input fields as arrays
        $quantities = $_POST['quantity'];
        $total_prices = $_POST['total_price'];
        $product_ids = $_POST['product_id'];
        $name = $_POST['name'];
        $email = $_POST['email'];
        $contact = $_POST['contact'];
        $address = $_POST['address'];
		var_dump($_POST['email']);
		var_dump($_POST['address']);
        // Start a batch for this checkout
        $batch_id = uniqid(); // Generate a unique batch ID

        // Prepare the statement to insert orders
        $insertOrderStmt = $conn->prepare("INSERT INTO orders (batch_id, member_id, product_id, order_qty, order_name, order_email, order_contact, order_address, order_total_price) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");

        // Loop through the arrays and insert order details
        for ($i = 0; $i < count($product_ids); $i++) {
            $product_id = $product_ids[$i];
            $quantity = $quantities[$i];
            $total_price = floatval(str_replace(['$', ','], '', $total_prices[$i]));// Convert to float
            // Bind parameters and execute the insert statement
			echo "Inserting order for email: $email and address: $address<br>";
            $insertOrderStmt->bind_param("siissisds", $batch_id, $member_id, $product_id, $quantity, $name, $email, $contact, $address, $total_price);
            $insertOrderStmt->execute();
        }

        // Close the insert statement
        $insertOrderStmt->close();

        echo "Orders have been successfully placed.";

    } else {
        // No form submission
        echo "No order has been placed.";
    }
} else {
    echo 'Not logged in';
}

mysqli_close($conn);
?>