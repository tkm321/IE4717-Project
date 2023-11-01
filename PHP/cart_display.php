<?php
$servername = "localhost";
$username = "jwongso001";
$password = "jwongso001";
$dbname = "Novatech";

$conn = new mysqli($servername, $username, $password, $dbname);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Replace with your SQL query to fetch cart items
$sql = "SELECT c.product_id, p.product_name, p.product_price
        FROM cart c
        JOIN products p ON c.product_id = p.product_id";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    echo '<div class="shopping-cart">';
    echo '<div class="cart-controls">';
    echo '<button class="select-all-button" id="select-all-button">Select All</button>';
    echo '<button class="remove-all-button" name="remove_all" 
        onclick="confirmRemoveAll()">Remove All</button>';
    echo '</div>';
    echo '<form method="post" action="PHP/checkout_order.php" >';
    echo '<table id="product-cart">';
    echo '<tr>
            <th></th>
            <th>Product</th>
            <th>Unit Price</th>
            <th>Quantity</th>
            <th>Total Price</th>
            <th>Action</th>
          </tr>';

    while ($row = mysqli_fetch_assoc($result)) {
		$product_id = $row['product_id'];
		$product_name = $row['product_name'];
		$unit_price = $row['product_price'];
		$formatted_price = "$" . number_format($unit_price, 2);
		$quantity = 1;
		$total_price = number_format($unit_price * $quantity, 2);
		$product_image_url = "Product_imgs/Product_" . $product_id . "/img_1.jpg";

		echo "<tr>";
		echo "<td class='cart-checkbox'><input type='checkbox' name='product_ids[]' class='product-checkbox' value='$product_id' data-product-id='$product_id'></td>";
		echo "<td class='product-name-cell'>
				<a href='item.php?product_id=$product_id'>$product_name</a> <br> 
				<img src='$product_image_url' alt='$product_name' class='item-image'>
			</td>";
		echo "<td class='cart-unitprice'>$formatted_price</td>";
		echo "<td class='quantity-input'>
			<button class='decrement-button' data-product-id='$product_id'>-</button>
			<input type='number' name='quantity' class='styled-input product-quantity' value='$quantity' data-product-id='$product_id' data-unit-price='$unit_price'>
			<button class='increment-button' data-product-id='$product_id'>+</button>
		</td>";
		echo "<td class='cart-totalprice'><span id='total-price-for-product-$product_id'>$total_price</span></td>";
		echo "<td class='cart-action'>
				<button class='remove-button' data-product-id='$product_id' onclick='confirmRemove($product_id)'>Remove</button>
			</td>";
		echo "</tr>";
	}

    echo '</table>';
    echo '<div class="cart-bottom">'; // Remove the padding-bottom
    echo '<div class="checkout-total">';
    echo '<span class="total-items">Items: <span id="total-items-count">0</span></span>';
	echo "<span class='checkout-totalprice'>Total Price: <span id='checkout-price-for-all'></span></span>";
    echo '<button class="checkout-button" id="checkout-button" type="submit" name="submit" 
    onclick="return confirmCheckout()">Checkout</button>';
    echo '</div>';
    echo '</div>';
    echo '</form>';
    

} else {
    // Display "Empty" message with a sad face
    echo '<div class="empty-cart">';
    echo '<div class="sad-face">😢</div>';
    echo 'Empty';
    echo '</div>';
}

mysqli_close($conn);
?>