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
    if (isset($_POST['submit']) && isset($_POST['product_id']) && is_array($_POST['product_id']) && count($_POST['product_id']) > 0) {
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
		
		// Update product stock in the products table and update the total_sales table
		$updateStockStmt = $conn->prepare("UPDATE products SET product_stock = product_stock - ? WHERE product_id = ?");
		$insertTotalSalesStmt = $conn->prepare("INSERT INTO total_sales (product_id, total_price, total_qty) VALUES (?, ?, ?) ON DUPLICATE KEY UPDATE total_price = total_price + VALUES(total_price), total_qty = total_qty + VALUES(total_qty)");

		// Loop through the arrays and insert order details
		for ($i = 0; $i < count($product_ids); $i++) {
			$product_id = $product_ids[$i];
			$quantity = $quantities[$i];
			$total_price = floatval(str_replace(['$', ','], '', $total_prices[$i])); // Convert to float
			// Bind parameters and execute the update statement for product stock
			$updateStockStmt->bind_param("ii", $quantity, $product_id);
			$updateStockStmt->execute();
			
			// Bind parameters and execute the insert/update statement for total_sales
			$insertTotalSalesStmt->bind_param("idd", $product_id, $total_price, $quantity);
			$insertTotalSalesStmt->execute();
		}

		// Close the statements
		$updateStockStmt->close();
		$insertTotalSalesStmt->close();
		
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

        echo "Order have been successfully placed. A confirmation email has been sent to you.";
        // Display the order details in a table
        echo "<table>";
        echo "<tr><th>Product ID</th><th>Quantity</th><th>Total Price</th></tr>";
        for ($i = 0; $i < count($product_ids); $i++) {
            $total_price_float = floatval(str_replace(['$', ','], '', $total_prices[$i])); // Convert to float
            echo "<tr><td>" . $product_ids[$i] . "</td><td>" . $quantities[$i] . "</td><td>" . number_format($total_price_float, 2) . "</td></tr>";
        }
        echo "</table>";

        $to      = 'f32ee@localhost';
        $subject = 'Order Confirmation';
        $message =
        // START OF EMAIL MESSAGE STRUCTURE
        'Dear ' . $name . ",\r\n\n" .

        'We are pleased to inform that your order has been confirmed. Thank you for choosing NovaTech for your consumer electronics and IT product needs.' . "\r\n\n" .

        'Your order will be processed within 3 working days and shipped with care.' . "\r\n\n" .

        'If you have any questions about your order, shipment, or anything else, our dedicated customer support team is ready to assist you. Feel free to reach out via email at mailto:support@novatech.com.sg or by phone at tel:+6567671314.' . "\r\n\n" .
        
        'We value your trust and are committed to delivering high quality electronic products and exceptional service to your doorstep. Your satisfaction is our top priority.' . "\r\n\n" .

        'Best Regards,' . "\r\n" .
        'NovaTech Sales Team';
        // END OF EMAIL MESSAGE STRUCTURE
        
        $headers = 'From: confirmorder@novatech.com.sg' . "\r\n" .
            'Reply-To: confirmorder@novatech.com.sg' . "\r\n" .
            'X-Mailer: PHP/' . phpversion();

        mail($to, $subject, $message, $headers,'-ff32ee@localhost');
	
	echo "Going back to Product Page in 5 seconds...<br>";
	echo "Click <a href='../products.php'>here</a> to go back directly.";
	header("refresh:5; url=../products.php");


    } else {
        echo "No items selected for checkout.<br>";
		echo "Going back to Cart in 5 seconds...<br>";
		echo "Click <a href='../cart.php'>here</a> to go back directly.";
		header("refresh:5; url=../cart.php");
    }
} else {
    echo 'Not logged in<br>';
	echo "Going back to Product Page in 5 seconds...<br>";
	echo "Click <a href='../products.php'>here</a> to go back directly.";
	header("refresh:5; url=../products.php");
}

mysqli_close($conn);
?>