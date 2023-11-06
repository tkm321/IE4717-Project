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

    // Query your database to fetch products in the wishlist, ordered by product_id
    $sql = "SELECT p.* FROM products p
            INNER JOIN wishlist w ON p.product_id = w.product_id
            WHERE w.member_id = ?
            ORDER BY p.product_id"; // Add ORDER BY clause to order by product_id
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
			echo '<h2><a href="item.php?product_id=' . $product["product_id"] . '" style="color: darkblue; text-decoration: none;" onmouseover="this.style.textDecoration=\'underline\';" onmouseout="this.style.textDecoration=\'none\';">' . $product["product_name"] . '</h2>';
			echo '<img src="' . $image_path . '" alt="' . $product["product_name"] . '"></a>';
			echo '<div class="price-container">';
			
			// Calculate the discounted price and the original price
			$discountedPrice = $product["product_price"] * (1 - $product["product_discount"] / 100);
			
			// Display the prices based on the discount
			echo '<p>';
			if ($product["product_discount"] > 0) {
				echo '<span style="color: red;">$' . number_format($discountedPrice, 2) . '</span> ';
				echo '<span style="font-size: 80%; text-decoration: line-through;">$' . number_format($product["product_price"], 2) . '</span> ';
				echo '<br><span style="color: red;">' . $product["product_discount"] . '% Off</span>';
			} else {
				echo 'Price: $' . number_format($product["product_price"], 2);
			}
			echo '</p>';
			
			echo '<div class="button-container">';
			echo '<form action="PHP/product_add_db.php" method="get">';
			echo '<input type="hidden" name="action" value="cart">';
			echo '<input type="hidden" name="product_id" value="' . $product["product_id"] . '">';
			echo '<button class="add-action" type="submit">Add to Cart</button>';
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
    // User is not logged in, show a message to log in
    echo '<div class="empty-wishlist">';
    echo '<div class="sad-face">😢</div>';
    echo 'You are not logged in. Please log in to view your wishlist.';
    echo '</div>';
}

$conn->close();
?>