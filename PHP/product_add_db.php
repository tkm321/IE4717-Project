<?php
session_start(); // Start the session to store the scroll position

$servername = "localhost";
$username = "jwongso001";
$password = "jwongso001";
$dbname = "Novatech";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_GET['action']) && isset($_GET['product_id'])) {
    $action = $_GET['action'];
    $product_id = $_GET['product_id'];

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
        // Check if the product is already in the cart
        $checkStmt = $conn->prepare("SELECT product_id FROM cart WHERE product_id = ?");
        $checkStmt->bind_param("i", $product_id);
        $checkStmt->execute();
        $checkStmt->bind_result($cartProductId);
        $checkStmt->fetch();
        $checkStmt->close();

        if ($cartProductId !== null) {
            // Product is already in the cart
            $message = $product_name . " is already in your cart.";
        } else {
            // Product is not in the cart, add it
            $stmt = $conn->prepare("INSERT INTO cart (product_id) VALUES (?)");
            $stmt->bind_param("i", $product_id);

            if ($stmt->execute()) {
                $message = "Added " . $product_name . " to your cart.";
            } else {
                $message = "Failed to add product to your cart.";
            }

            $stmt->close();
        }
    } elseif ($action === "add_wishlist") {
        // Check if the product is already in the wishlist
        $checkStmt = $conn->prepare("SELECT product_id FROM wishlist WHERE product_id = ?");
        $checkStmt->bind_param("i", $product_id);
        $checkStmt->execute();
        $checkStmt->bind_result($wishlistProductId);
        $checkStmt->fetch();
        $checkStmt->close();

        if ($wishlistProductId !== null) {
            // Product is already in the wishlist
            $message = $product_name . " is already in your wishlist.";
        } else {
            // Product is not in the wishlist, add it
            $stmt = $conn->prepare("INSERT INTO wishlist (product_id) VALUES (?)");
            $stmt->bind_param("i", $product_id);

            if ($stmt->execute()) {
                $message = "Added " . $product_name . " to your wishlist.";
            } else {
                $message = "Failed to add product to your wishlist.";
            }

            $stmt->close();
        }
    } elseif ($action === "remove_wishlist") {
        // Check if the product is in the wishlist and remove it
        $checkStmt = $conn->prepare("SELECT product_id FROM wishlist WHERE product_id = ?");
        $checkStmt->bind_param("i", $product_id);
        $checkStmt->execute();
        $checkStmt->bind_result($wishlistProductId);
        $checkStmt->fetch();
        $checkStmt->close();

        if ($wishlistProductId !== null) {
            // Product is in the wishlist, remove it
            $stmt = $conn->prepare("DELETE FROM wishlist WHERE product_id = ?");
            $stmt->bind_param("i", $product_id);

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