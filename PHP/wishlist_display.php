<?php
session_start(); // Start the session to store the scroll position

$servername = "localhost";
$username = "jwongso001";
$password = "jwongso001";
$dbname = "Novatech";

// Set the working directory to the directory of your PHP script
chdir(__DIR__);

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Query your database to fetch products in the wishlist
$sql = "SELECT p.* FROM products p
        INNER JOIN wishlist w ON p.product_id = w.product_id";
$result = $conn->query($sql);

$products = []; // Initialize an array to store product data

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $products[] = $row; // Store product data in the array
    }
}

if (empty($products)) {
    // Wishlist is empty, display a sad face and "Empty" message
	
    echo '<div class="empty-wishlist">';
    echo '<div class="sad-face">😢</div>';
    echo 'Empty';
    echo '</div>';
} else {
	echo '<div class="product-divider">';
    foreach ($products as $product) {
        $image_path = 'Product_imgs/Product_' . $product["product_id"] . '/img_1.jpg';
        echo '<div class="product-container">';
        echo '<h2><a href="item.php?product_id=' . $product["product_id"] . '" style="color: darkblue; text-decoration: none;" onmouseover="this.style.textDecoration=\'underline\';" onmouseout="this.style.textDecoration=\'none\';">' . $product["product_name"] . '</a></h2>';
        echo '<img src="' . $image_path . '" alt="' . $product["product_name"] . '">';
        echo '<div class="price-container">';
        echo '<p>Price: $' . $product["product_price"] . '</p>';
        echo '<div class="button-container">';
        echo '<form action="PHP/product_add_db.php" method="get">';
        echo '<input type="hidden" name="action" value="cart">';
        echo '<input type="hidden" name="product_id" value="' . $product["product_id"] . '">';
        echo '<button class="add-action" type="submit">Add to Cart</button>';
        echo '</form>';

        // Check if the product is in the wishlist
        $product_id = $product['product_id'];
        $isInWishlist = false;

        // Query the wishlist table to check if the product is already in the wishlist
        $wishlistCheckStmt = $conn->prepare("SELECT COUNT(*) FROM wishlist WHERE product_id = ?");
        $wishlistCheckStmt->bind_param("i", $product_id);
        $wishlistCheckStmt->execute();
        $wishlistCheckStmt->bind_result($wishlistCount);
        $wishlistCheckStmt->fetch();
        $wishlistCheckStmt->close();

        $isInWishlist = $wishlistCount > 0;

        if ($isInWishlist) {
            echo '<form action="PHP/product_add_db.php" method="get">';
            echo '<input type="hidden" name="action" value="remove_wishlist">';
            echo '<input type="hidden" name="product_id" value="' . $product["product_id"] . '">';
            echo '<button class="add-action" type="submit">Remove Wishlist</button>';
            echo '</form>';
        } else {
            echo '<form action="PHP/product_add_db.php" method="get">';
            echo '<input type="hidden" name="action" value="add_wishlist">';
            echo '<input type="hidden" name="product_id" value="' . $product["product_id"] . '">';
            echo '<button class="add-action" type="submit">Add to Wishlist</button>';
            echo '</form>';
        }

        echo '</div>'; // Close the button-container div
        echo '</div>'; // Close the price-container div
        echo '</div>'; // Close the product-container div
    }
	echo '</div>';
}

$conn->close();
?>