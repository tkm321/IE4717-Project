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

// Initialize message
$message = '';

// Handle the form submission based on the "action" value
if (isset($_GET['action'])) {
    $action = $_GET['action'];

    // Capture the quantity from the form
    $quantity = isset($_GET['qty']) ? $_GET['qty'] : 0;

    // If quantity is 0, set it to 1, as we want the buyer to be able to add one item if never stated
    if ($quantity == 0) {
        $quantity = 1;
    }

    $product_id = isset($_GET['product_id']) ? $_GET['product_id'] : null;

    if ($product_id !== null) {
		if ($action === "add_wishlist") {
			// Set the quantity to 1 when adding to the wishlist
            $quantity = 1;

            // Use prepared statement for inserting into wishlist
            $stmt = $conn->prepare("INSERT INTO wishlist (product_id, qty) VALUES (?, ?)");
            $stmt->bind_param("ii", $product_id, $quantity);

            if ($stmt->execute()) {
                $message = "Added to wishlist";
            } else {
                $message = "Failed to add product to wishlist";
            }

            $stmt->close();
			
		} elseif ($action === "remove_wishlist") {
            // Use prepared statement to remove the product from the wishlist
            $stmt = $conn->prepare("DELETE FROM wishlist WHERE product_id = ?");
            $stmt->bind_param("i", $product_id);

            if ($stmt->execute()) {
                $message = "Removed from wishlist";
            } else {
                $message = "Failed to remove product from wishlist";
            }

            $stmt->close();
		} elseif ($action === "cart") {
			// Check if the product is already in the cart
			$checkStmt = $conn->prepare("SELECT qty FROM cart WHERE product_id = ?");
			$checkStmt->bind_param("i", $product_id);
			$checkStmt->execute();
			$checkStmt->bind_result($cartQty);
			$checkStmt->fetch();
			$checkStmt->close();

			if ($cartQty !== null) {
				// Product is already in the cart, update the quantity
				$newQuantity = $cartQty + $quantity;
				$updateStmt = $conn->prepare("UPDATE cart SET qty = ? WHERE product_id = ?");
				$updateStmt->bind_param("ii", $newQuantity, $product_id);

				if ($updateStmt->execute()) {
					$message = "Added to cart (Quantity: $quantity)";
				} else {
					$message = "Failed to update quantity in the cart";
				}

				$updateStmt->close();
			} else {
				// Product is not in the cart, add it
				// Use prepared statement for inserting into cart
				$stmt = $conn->prepare("INSERT INTO cart (product_id, qty) VALUES (?, ?)");
				$stmt->bind_param("ii", $product_id, $quantity);

				if ($stmt->execute()) {
					$message = "Added to cart (Quantity: $quantity)";
				} else {
					$message = "Failed to add product to cart";
				}

				$stmt->close();
			}
		} else {
			$message = "Invalid action!";
		}
	} else {
		$message = "Product ID not specified!";
	}
} else {
    $message = "Action not specified!";
}

// Define the redirect URL based on the product_id
if (isset($product_id)) {
    $redirectURL = "../item.php?product_id=$product_id";
} else {
    $redirectURL = "../"; // Specify a default URL if $product_id is not set
}

// Create a JavaScript alert and redirect
$jsAlert = "<script>
    alert('$message'); // Display the message in an alert
    window.location.href = '$redirectURL'; // Redirect
</script>";

echo $jsAlert;

$conn->close();
?>