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
        $checkStmt = $conn->prepare("SELECT qty FROM cart WHERE product_id = ?");
        $checkStmt->bind_param("i", $product_id);
        $checkStmt->execute();
        $checkStmt->bind_result($cartQty);
        $checkStmt->fetch();
        $checkStmt->close();

        if ($cartQty !== null) {
            // Product is already in the cart, update the quantity
            $newQuantity = $cartQty + 1;
            $updateStmt = $conn->prepare("UPDATE cart SET qty = ? WHERE product_id = ?");
            $updateStmt->bind_param("ii", $newQuantity, $product_id);

            if ($updateStmt->execute()) {
                $message = $product_name . " added to cart. Quantity updated in the cart: " . $newQuantity;
            } else {
                $message = "Failed to update quantity in the cart.";
            }

            $updateStmt->close();
        } else {
            // Product is not in the cart, add it
            $stmt = $conn->prepare("INSERT INTO cart (product_id, qty) VALUES (?, 1)");
            $stmt->bind_param("i", $product_id);

            if ($stmt->execute()) {
                $message = $product_name . " added to cart. Quantity updated in the cart.";
            } else {
                $message = "Failed to add product to cart.";
            }

            $stmt->close();
        }
    } elseif ($action === "add_wishlist") {
        // Check if the product is already in the wishlist
        $checkStmt = $conn->prepare("SELECT qty FROM wishlist WHERE product_id = ?");
        $checkStmt->bind_param("i", $product_id);
        $checkStmt->execute();
        $checkStmt->bind_result($wishlistQty);
        $checkStmt->fetch();
        $checkStmt->close();

        if ($wishlistQty !== null) {
            // Product is already in the wishlist
            $message = $product_name . " is already in your wishlist.";
        } else {
            // Product is not in the wishlist, add it
            $stmt = $conn->prepare("INSERT INTO wishlist (product_id, qty) VALUES (?, 1)");
            $stmt->bind_param("i", $product_id);

            if ($stmt->execute()) {
                $message = "Added " . $product_name . " to wishlist.";
            } else {
                $message = "Failed to add product to wishlist.";
            }

            $stmt->close();
        }
    } elseif ($action === "remove_wishlist") {
        // Check if the product is in the wishlist and remove it
        $checkStmt = $conn->prepare("SELECT qty FROM wishlist WHERE product_id = ?");
        $checkStmt->bind_param("i", $product_id);
        $checkStmt->execute();
        $checkStmt->bind_result($wishlistQty);
        $checkStmt->fetch();
        $checkStmt->close();

        if ($wishlistQty !== null) {
            // Product is in the wishlist, remove it
            $stmt = $conn->prepare("DELETE FROM wishlist WHERE product_id = ?");
            $stmt->bind_param("i", $product_id);

            if ($stmt->execute()) {
                $message = $product_name . " has been removed from your wishlist.";
            } else {
                $message = "Failed to remove product from wishlist.";
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
        } else {
            // If the referrer is unknown, go back to the previous page with a random parameter
            window.history.back();
            location.href = location.href + '?rand=' + Math.random();
        }
    }

    // Call the redirect function after a delay (0 seconds)
    setTimeout(redirectBasedOnReferer, 0);
</script>