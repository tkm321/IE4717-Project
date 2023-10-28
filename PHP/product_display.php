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

// Query your database to fetch products
$sql = "SELECT * FROM products"; 
$result = $conn->query($sql);

$products_per_row = 3;
$products_per_page = 6;
$product_count = 0;

if ($result->num_rows > 0) {
  while ($row = $result->fetch_assoc()) {
    // Construct the image file path based on the product ID
	$image_path = '../Product_imgs/Product_' . $row["product_id"] . '/img_1.jpg';
	
	$filename = '../Product_imgs/Product_1/img_1,jpg';

    // Display products in a div
    echo '<div class="product">';
    echo '<h2>' . $row["product_name"] . '</h2>';
    // Display the image
    echo '<img src="' . $image_path . '" alt="' . $row["product_name"] . '">';
    echo '<p>Price: $' . $row["product_price"] . '</p>';
	echo '</div>';


    $product_count++;

    // Start a new row after 3 products
    if ($product_count % $products_per_row == 0) {
      echo '<div class="clear"></div>';
    }

    // End the page after 6 products
    if ($product_count % $products_per_page == 0) {
      break;
    }
  }
} else {
  echo "No products found.";
}

$conn->close();
?>