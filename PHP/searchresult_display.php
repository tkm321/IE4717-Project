
<!DOCTYPE html>
<html lang="en">
<head>
  <title>NovaTech - Search Results</title>
  <meta charset="UTF-8">
  <link rel="stylesheet" href="css/styles.css">
  <link rel="icon" type="image/x-icon" href="images/favicon/favicon.ico">
</head>
<body>

<?php
$servername = "localhost";
$username = "jwongso001";
$password = "jwongso001";
$dbname = "Novatech";

$conn = new mysqli($servername, $username, $password, $dbname);

  if (mysqli_connect_errno()) {
     echo 'Error: Could not connect to database.  Please try again later.';
     exit;
  }

  // create short variable names
  $searchterm=trim($_POST['searchterm']);

  // if (!$searchterm) {
    // echo 'You have not entered search details.  Please try again.';
    // exit;
  // }
  $searchterm = addslashes($searchterm);

  $sql = "select * from products where product_name like '%".$searchterm."%'";
  $result = $conn->query($sql);

  $products = []; // Initialize an array to store product data

  if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
      $products[] = $row; // Store product data in the array
    }
  }
  else if ($result->num_rows == 0) {
    echo '<div class="product-divider">';
    echo '<h1>PRODUCT NOT FOUND</h1>';
    echo '</div>';
  }

  foreach ($products as $product) {
      $image_path = 'Product_imgs/Product_' . $product["product_id"] . '/img_1.jpg';
      echo '<div class="product-container">';
      echo '<h2><a href="item.php?product_id=' . $product["product_id"] . '" style="color: darkblue; text-decoration: none;" onmouseover="this.style.textDecoration=\'underline\';" onmouseout="this.style.textDecoration=\'none\';">' . $product["product_name"] . '</h2>';
      echo '<img src="' . $image_path . '" alt="' . $product["product_name"] . '"></a>';
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

  $result->free();
  $conn->close();
?>
</body>
</html>
