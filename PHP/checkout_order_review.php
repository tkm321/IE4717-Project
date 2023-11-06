<?php
$servername = "localhost";
$username = "jwongso001";
$password = "jwongso001";
$dbname = "Novatech";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$redirectDelay = 5; // Delay in seconds

if (isset($_POST['submit'])) {
    if (isset($_POST['product_ids'], $_POST['quantity'])) {
        $selectedProductIds = $_POST['product_ids'];
        $quantities = $_POST['quantity'];

        // Initialize an array to store the selected products and their total prices
        $selectedProducts = [];

        // Loop through the selected product IDs and quantities
        foreach ($selectedProductIds as $productId => $selected) {
            // Check if the checkbox is selected and quantity is greater than 0
            if ($selected && $quantities[$productId] > 0) {
                // Ensure the $productId is valid
                if (is_numeric($productId)) {
                    // Get the quantity for the selected product
                    $quantity = $quantities[$productId];

                    // Fetch product details (product_id, product_name, product_price, and product_discount) from the database
                    $sql = "SELECT product_id, product_name, product_price, product_discount FROM products WHERE product_id = $productId";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        // Fetch the product details from the database result
                        $row = $result->fetch_assoc();
                        $product_id = $row['product_id'];
                        $product_name = $row['product_name'];
                        $unitPrice = $row['product_price'];
                        $discount = $row['product_discount'];

                        // Calculate the discounted unit price (unit price - unit price * discount / 100)
                        $discountedUnitPrice = $unitPrice - ($unitPrice * $discount / 100);
                        // Calculate the total price (discounted unit price * quantity)
                        $totalPrice = $discountedUnitPrice * $quantity;

                        // Format the prices with a comma for every 3 digits and in the $ format
                        $unitPriceFormatted = "$" . number_format($discountedUnitPrice, 2, '.', ',');
                        $totalPriceFormatted = "$" . number_format($totalPrice, 2, '.', ',');

                        // Store the selected product in the array
                        $selectedProducts[] = [
                            'product_id' => $product_id,
                            'product_name' => $product_name,
                            'quantity' => $quantity,
                            'unit_price' => $unitPriceFormatted,
                            'total_price' => $totalPriceFormatted,
                        ];
                    } else {
                        echo "Product with ID $productId not found in the database.";
                    }
                }
            }
        }

        // Check if any products were selected
        if (!empty($selectedProducts)) {
            // Display the selected products in a table with formatted prices
            echo '<table class="checkout-table">';
            echo '<tr><th>Qty</th><th>Product</th><th>Unit Price</th><th>Total Price</th></tr>';
            $totalCombinedPrice = 0.0; // Initialize the total combined price
            foreach ($selectedProducts as $product) {
                $product_id = $product['product_id'];
                $product_name = $product['product_name'];
                $quantity = $product['quantity'];
                $unitPrice = $product['unit_price'];
                $totalPrice = $product['total_price'];
                echo '<tr>';
                echo '<td style="text-align: center">x' . $quantity . '</td>';
                echo '<td>' . $product_name . '</td>';
                echo '<td style="text-align: center">' . $unitPrice . '</td>';
                echo '<td style="text-align: center">' . $totalPrice . '</td>';
                echo '<input type="hidden" name="product_id[]" value="' . $product_id . '">';
                echo '<input type="hidden" name="product_name[]" value="' . $product_name . '">';
                echo '<input type="hidden" name="quantity[]" value="' . $quantity . '">';
                echo '<input type="hidden" name="unit_price[]" value="' . $unitPrice . '">';
                echo '<input type="hidden" name="total_price[]" value="' . $totalPrice . '">';
                echo '</tr>';

                // Add the total price of this product to the total combined price
                $totalCombinedPrice += floatval(str_replace(['$', ','], '', $totalPrice));
            }
            echo '</table>';

            // Display the total combined price below the table
            echo '<p>Total Combined Price: <strong><u>$' . number_format($totalCombinedPrice, 2, '.', ',') . '</u></strong></p>';
        } else {
            echo "No products selected for checkout.";
        }
    } else {
        // No products selected
        echo "No products selected for checkout.";
    }
} else {
    // User is not logged in, show an empty wishlist
    echo "You are not logged in.";
}

$conn->close();
?>