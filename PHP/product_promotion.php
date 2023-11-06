<?php

$servername = "localhost";
$username = "jwongso001";
$password = "jwongso001";
$dbname = "Novatech";

// Set the working directory to the directory of your PHP script
chdir(__DIR__);

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Query your database to fetch products with discounts
$sql = "SELECT * FROM products WHERE product_discount IS NOT NULL ORDER BY product_discount DESC LIMIT 3";
$result = $conn->query($sql);

$products = []; // Initialize an array to store product data

if ($result->num_rows > 0) {
  while ($row = $result->fetch_assoc()) {
    $products[] = $row; // Store product data in the array
  }
}

foreach ($products as $product) {
    $image_path = 'Product_imgs/Product_' . $product["product_id"] . '/img_1.jpg';
    echo '<div class="product-container">';
    echo '<h2><a href="item.php?product_id=' . $product["product_id"] . '" style="color: darkblue; text-decoration: none;" onmouseover="this.style.textDecoration=\'underline\';" onmouseout="this.style.textDecoration=\'none\';">' . $product["product_name"] . '</h2>';
    echo '<img src="' . $image_path . '" alt="' . $product["product_name"] . '"></a>';
    echo '<div class="price-container">';
    
    // Calculate the discounted price and the original price
    $discountedPrice = $product["product_price"] * (1 - $product["product_discount"] / 100);
    
    // Display the prices in the desired format
    echo '<p><span style="color: red;">$' . number_format($discountedPrice, 2) . '</span> <span style="font-size: 80%; text-decoration: line-through;">$' . number_format($product["product_price"], 2) . '</span></p>';
    echo '<p>Discount: ' . $product["product_discount"] . '%'. '</p>';
    
    echo '<div class="button-container">';
    echo '<form action="PHP/product_add_db.php" method="get">';
    echo '<input type="hidden" name="action" value="cart">';
    echo '<input type="hidden" name="product_id" value="' . $product["product_id"] . '">';
    echo '<button class="add-action" type="submit">Add to Cart</button>';
    echo '</form>';
    
    // Check if the product is in the wishlist
    $product_id = $product['product_id'];
    $isInWishlist = false;
    
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
    
    // Query the wishlist table to check if the product is already in the user's wishlist
    $wishlistCheckStmt = $conn->prepare("SELECT COUNT(*) FROM wishlist WHERE product_id = ? AND member_id = ?");
    $wishlistCheckStmt->bind_param("ii", $product_id, $member_id);
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
  
$conn->close();
?>