<?php
$servername = "localhost";
$username = "jwongso001";
$password = "jwongso001";
$dbname = "Novatech";

$conn = new mysqli($servername, $username, $password, $dbname);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
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
}

if (isset($member_id)) {
    // Replace with your SQL query to fetch cart items
    $sql = "SELECT c.product_id, p.product_name, p.product_price, p.product_stock, p.product_discount
        FROM cart c
        JOIN products p ON c.product_id = p.product_id
        WHERE c.member_id = $member_id
        ORDER BY c.product_id"; // Add ORDER BY clause to order by product_id
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        echo '<div class="shopping-cart">';
        echo '<div class="cart-controls">';
        echo '<button class="select-all-button" id="select-all-button">Select All</button>';
        echo '<button class="remove-all-button" name="remove_all" 
            onclick="confirmRemoveAll()">Remove All</button>';
        echo '</div>';
        echo '<form method="post" action="checkout_order.php" >';
        echo '<table id="product-cart">';
        echo '<tr>
                <th></th>
                <th>Product</th>
                <th>Unit Price</th>
                <th>Quantity</th>
                <th>Total Price</th>
                <th>Action</th>
              </tr>';
        $totalPriceForAll = 0; // Initialize the total price

        while ($row = mysqli_fetch_assoc($result)) {
			$product_id = $row['product_id'];
			$product_name = $row['product_name'];
			$unit_price = $row['product_price'];
			$discount = $row['product_discount'];
			$quantity = 1;
			
			// Calculate the discounted price and the original price
			$discountedPrice = $unit_price * (1 - $discount / 100);

			// Calculate the total price for the current item
			$total_price = "$" . number_format($discountedPrice * $quantity, 2); // Format as currency

			$product_image_url = "Product_imgs/Product_" . $product_id . "/img_1.jpg";

			$formatted_price = "$" . number_format($discountedPrice, 2); // Format as currency
			$formatted_unit_price = "$" . number_format($unit_price, 2); // Format as currency

			// Calculate the total price for all items
			$totalPriceForAll += $discountedPrice * $quantity;

			echo "<tr>";
			echo "<td class='cart-checkbox'><input type='checkbox' name='product_ids[$product_id]' class='product-checkbox' value='$product_id' data-product-id='$product_id'></td>";
			echo "<td class='product-name-cell' style='text-align:center;'>
					<a href='item.php?product_id=$product_id'>$product_name</a> <br> 
					<img src='$product_image_url' alt='$product_name' class='item-image'>
				</td>";
			echo "<td class='cart-unitprice'>";

			// Display the discounted price
            if ($discountedPrice < $unit_price)
            {
                echo "<span style='color: red;'>$formatted_price</span> ";
            }
            else
            {
                echo "<span>$formatted_price</span> ";
            }

			// Display the original price with a smaller font and dashed style when there is a discount
			if ($discount > 0) {
				echo "<span style='font-size: 80%; text-decoration: line-through;'>$formatted_unit_price</span>";
			}

			echo "</td>";
			echo "<td class='quantity-input'>
						<button class='decrement-button' data-product-id='$product_id'>-</button>
						<input type='number' name='quantity[$product_id]' class='styled-input product-quantity' value='$quantity' data-product-id='$product_id' data-unit-price='$discountedPrice' data-product-stock='{$row['product_stock']}'>
						<button class='increment-button' data-product-id='$product_id'>+</button>
					</td>";
			echo "<td class='cart-totalprice'><span id='total-price-for-product-$product_id'>$total_price</span></td>";
			echo "<td class 'cart-action' style='text-align:center;'>
					<button type='submit' class='remove-button' data-product-id='$product_id'>Remove</button>
					 </td>";
			echo "</tr>";
		}

        echo '</table>';
        echo '<div class="cart-bottom">'; // Remove the padding-bottom
        echo '<div class="checkout-total">';
        echo '<span class="total-items"><b>Items: <span id="total-items-count"></b></span></span>';
        echo "<span class='checkout-totalprice'><b>Total Price: <span id='checkout-price-for-all'>$totalPriceForAll</b></span></span>";
        echo '<button class="checkout-button" id="checkout-button" type="submit" name="submit">Checkout</button>';
        echo '</div>';
        echo '</div>';
        echo '</form>';
        echo '</div>';
    } else {
        // Display "Empty" message with a sad face
        echo '<div class="empty-cart">';
        echo '<div class="sad-face">😢</div>';
        echo 'Empty';
        echo '</div>';
    }
} else {
    // User is not logged in, show a message that the cart is empty
    echo '<div class="empty-cart">';
    echo '<div class="sad-face">😢</div>';
    echo '<h4>You are not logged in. Please log in to view your cart.</h4>';
    echo '</div>';
}

mysqli_close($conn);
?>