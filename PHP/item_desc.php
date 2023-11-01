<?php
if (isset($_GET['product_id'])) {
    $requestedProductId = $_GET['product_id'];

    // Establish a database connection (similar to your previous code)
    $servername = "localhost";
    $username = "jwongso001";
    $password = "jwongso001";
    $dbname = "Novatech";

    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Perform a database query to fetch product details based on $requestedProductId
    $sql = "SELECT * FROM products WHERE product_id = $requestedProductId";

    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $product = $result->fetch_assoc();
    } else {
        echo "Product not found.";
    }
	// Fetch the review for the product
	$productId = $product['product_id'];
	$sql = "SELECT reviews FROM reviews WHERE product_id = $productId";
	$result = mysqli_query($conn, $sql);

	if ($result) {
		$row = mysqli_fetch_assoc($result);
		$review = $row['reviews'];
	} else {
		$review = "No reviews available"; // Display a message if there are no reviews
	}
	
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

    if ($wishlistCount > 0) {
        $isInWishlist = true;
    }


    // Close the database connection
    $conn->close();
} else {
    echo "Product ID not specified.";
}
?>