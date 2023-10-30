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

$products = []; // Initialize an array to store product data

if ($result->num_rows > 0) {
  while ($row = $result->fetch_assoc()) {
    $products[] = $row; // Store product data in the array
  }
}

foreach ($products as $product) {
    $image_path = 'Product_imgs/Product_' . $product["product_id"] . '/img_1.jpg';
    echo '<div class="product-container">';
    echo '<h2><a href="item.php?product_id=' . $product["product_id"] . '" style="color: darkblue; text-decoration: none;" onmouseover="this.style.textDecoration=\'underline\';" onmouseout="this.style.textDecoration=\'none\';">' . $product["product_name"] . '</a></h2>';
    echo '<img src="' . $image_path . '" alt="' . $product["product_name"] . '">';
    echo '<div class="price-container">';
    echo '<p>Price: $' . $product["product_price"] . '</p>';
    echo '</div>'; // Close the price-container div
    echo '</div>'; // Close the product-container div
}
		  
$conn->close();


?>