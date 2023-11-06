<?php
session_start();

$servername = "localhost";
$username = "jwongso001";
$password = "jwongso001";
$dbname = "Novatech";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Initialize member_id and valid_user
$member_id = "";
$valid_user = "";

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

$product_id = isset($_GET['product_id']) ? (int)$_GET['product_id'] : null; // Get product_id from URL

if ($product_id !== null) {
    if (empty(trim($valid_user))) {
        // User is not logged in, show an alert
        $message = "You are not logged in. ".$valid_user;
    } else {
        $action = $_GET['action'];

        // Define a variable for the item name
        $product_name = "";

        // Retrieve the product name from the database based on the product_id
        $nameStmt = $conn->prepare("SELECT product_name FROM products WHERE product_id = ?");
        $nameStmt->bind_param("i", $product_id);
        $nameStmt->execute();
        $nameStmt->bind_result($product_name);
        $nameStmt->fetch();
        $nameStmt->close();

		if ($action === "cart") {
			// Check if the product is already in the cart for the current user
			$checkStmt = $conn->prepare("SELECT product_id FROM cart WHERE product_id = ? AND member_id = ?");
			$checkStmt->bind_param("ii", $product_id, $member_id);
			$checkStmt->execute();
			$checkStmt->bind_result($cartProductId);
			$checkStmt->fetch();
			$checkStmt->close();

			if ($cartProductId !== null) {
				// Product is already in the cart
				$message = $product_name . " is already in your cart.";
			} else {
				// Product is not in the cart, add it
				$stmt = $conn->prepare("INSERT INTO cart (product_id, member_id) VALUES (?, ?)");
				$stmt->bind_param("ii", $product_id, $member_id);

				if ($stmt->execute()) {
					$message = "Added " . $product_name . " to your cart.";
				} else {
					$message = "Failed to add product to your cart.";
				}

				$stmt->close();
			}
        } elseif ($action === "add_wishlist") {
            // Check if the product is already in the wishlist
            $checkStmt = $conn->prepare("SELECT product_id FROM wishlist WHERE product_id = ? AND member_id = ?");
            $checkStmt->bind_param("ii", $product_id, $member_id);
            $checkStmt->execute();
            $checkStmt->bind_result($wishlistProductId);
            $checkStmt->fetch();
            $checkStmt->close();

            if ($wishlistProductId !== null) {
                // Product is already in the wishlist
                $message = $product_name . " is already in your wishlist.";
            } else {
                // Product is not in the wishlist, add it
                $stmt = $conn->prepare("INSERT INTO wishlist (product_id, member_id) VALUES (?, ?)");
                $stmt->bind_param("ii", $product_id, $member_id);

                if ($stmt->execute()) {
                    $message = "Added " . $product_name . " to your wishlist.";
                } else {
                    $message = "Failed to add product to your wishlist.";
                }

                $stmt->close();
            }
        } elseif ($action === "remove_wishlist") {
            // Check if the product is in the wishlist and remove it
            $checkStmt = $conn->prepare("SELECT product_id FROM wishlist WHERE product_id = ? AND member_id = ?");
            $checkStmt->bind_param("ii", $product_id, $member_id);
            $checkStmt->execute();
            $checkStmt->bind_result($wishlistProductId);
            $checkStmt->fetch();
            $checkStmt->close();

            if ($wishlistProductId !== null) {
                // Product is in the wishlist, remove it
                $stmt = $conn->prepare("DELETE FROM wishlist WHERE product_id = ? AND member_id = ?");
                $stmt->bind_param("ii", $product_id, $member_id);

                if ($stmt->execute()) {
                    $message = $product_name . " has been removed from your wishlist.";
                } else {
                    $message = "Failed to remove product from your wishlist.";
                }

                $stmt->close();
            } else {
                $message = $product_name . " is not in your wishlist.";
            }
        } else {
            $message = "Invalid action!";
        }
    }
} else {
    $message = "Action or product ID not specified!";
}

$conn->close();
?>

<script>
    // Display the message in a JavaScript alert
    alert('<?php echo $message; ?>');

    // Function to determine the previous page and redirect accordingly
    function redirectBasedOnReferer() {
        if (document.referrer.includes('wishlist.php')) {
            // Redirect to the wishlist page
            window.location.href = '../wishlist.php';
        } else if (document.referrer.includes('products.php')) {
            // Redirect to the products page
            window.location.href = '../products.php';
        } else if (document.referrer.includes('item.php?product_id=<?php echo $product_id; ?>')) {
            // Redirect to the item page
            window.location.href = '../item.php?product_id=<?php echo $product_id; ?>';
        } else {
            window.location.href = '../';
        }
    }

    // Call the redirect function after a delay (0 seconds)
    setTimeout(redirectBasedOnReferer, 0);
</script>