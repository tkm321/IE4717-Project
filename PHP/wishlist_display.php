<?php
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

    // Query your database to fetch products in the wishlist
    $sql = "SELECT p.* FROM products p
            INNER JOIN wishlist w ON p.product_id = w.product_id
            WHERE w.member_id = ?";
    $wishlistStmt = $conn->prepare($sql);
    $wishlistStmt->bind_param("i", $member_id);
    $wishlistStmt->execute();
    $result = $wishlistStmt->get_result();
    $wishlistStmt->close();

    $products = []; // Initialize an array to store product data

    if ($result->num_rows > 0) {
        echo '<div class="product-divider">';
        foreach ($result as $product) {
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
            echo '<form action="PHP/product_add_db.php" method="get">';
            echo '<input type="hidden" name="action" value="add_wishlist">';
            echo '<input type="hidden" name="product_id" value="' . $product["product_id"] . '">';
            echo '<button class="add-action" type="submit">Add to Wishlist</button>';
            echo '</form>';
            echo '</div>'; // Close the button-container div
            echo '</div>'; // Close the price-container div
            echo '</div>'; // Close the product-container div
        }
        echo '</div>';
    } else {
        // Wishlist is empty, display a sad face and "Empty"
        echo '<div class="empty-wishlist">';
		echo '<div class="sad-face">😢</div>';
        echo 'Empty';
        echo '</div>';
		
    }
} else {
    // User is not logged in, show an empty wishlist
    echo '<div class="empty-wishlist">';
	echo '<div class="sad-face">😢</div>';
    echo 'You are not logged in.';
    echo '</div>';
	
}

$conn->close();
?>