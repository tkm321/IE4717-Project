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
        // Get the current maximum batch ID
        $batchIdStmt = $conn->prepare("SELECT MAX(batch_id) FROM orders");
        $batchIdStmt->execute();
        $batchIdStmt->bind_result($maxBatchId);
        $batchIdStmt->fetch();
        $batchIdStmt->close();

        // Calculate the next batch ID
        $nextBatchId = $maxBatchId + 1;

        // Prepare the statement to insert orders
        $insertOrderStmt = $conn->prepare("INSERT INTO orders (batch_id, member_id, product_id, order_qty, order_name, order_email, order_contact, order_address, order_total_price) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");

        // Loop through the arrays and insert order details
        for ($i = 0; $i < count($product_ids); $i++) {
            $product_id = $product_ids[$i];
            $quantity = $quantities[$i];
            $total_price = floatval(str_replace(['$', ','], '', $total_prices[$i]));// Convert to float
            // Bind parameters and execute the insert statement
            $insertOrderStmt->bind_param("siisssssd", $nextBatchId, $member_id, $product_id, $quantity, $name, $email, $contact, $address, $total_price);
            $insertOrderStmt->execute();
        }
		
		// Update product stock in the products table
		$updateStockStmt = $conn->prepare("UPDATE products SET product_stock = product_stock - ? WHERE product_id = ?");

		// Loop through the arrays and insert order details
		for ($i = 0; $i < count($product_ids); $i++) {
			$product_id = $product_ids[$i];
			$quantity = $quantities[$i];

			// Bind parameters and execute the update statement
			$updateStockStmt->bind_param("ii", $quantity, $product_id);
			$updateStockStmt->execute();
		}

		// Close the update statement
		$updateStockStmt->close();
		
        // Close the insert statement
        $insertOrderStmt->close();

		 // Remove items from the user's cart after they are checked out
		$removeFromCartStmt = $conn->prepare("DELETE FROM cart WHERE member_id = ? AND product_id = ?");
    
		for ($i = 0; $i < count($product_ids); $i++) {
			$product_id = $product_ids[$i];
			// Bind parameters and execute the delete statement
			$removeFromCartStmt->bind_param("ii", $member_id, $product_id);
			$removeFromCartStmt->execute();
		}

		// Close the delete statement
		$removeFromCartStmt->close();

        echo "Orders have been successfully placed.";
        // Display the order details in a table
        echo "<table>";
        echo "<tr><th>Product ID</th><th>Quantity</th><th>Total Price</th></tr>";
        for ($i = 0; $i < count($product_ids); $i++) {
            $total_price_float = floatval(str_replace(['$', ','], '', $total_prices[$i])); // Convert to float
            echo "<tr><td>" . $product_ids[$i] . "</td><td>" . $quantities[$i] . "</td><td>" . number_format($total_price_float, 2) . "</td></tr>";
        }
        echo "</table>";
		

    } else {
        // No form submission
        echo "No order has been placed.";
    }
} else {
    echo 'Not logged in';
}
echo "Going back to Product Page in 5 seconds...<br>";
echo "Click <a href='../products.php'>here</a> to go back directly.";
header("refresh:5; url=../products.php");

mysqli_close($conn);
?>