<?php
// to prevent bypasssing of form submit action
if(!isset($_SERVER['HTTP_REFERER'])){
    // redirect to desired location
    header('location:../admin_inventory.php');
    exit;
}
// Function to retrieve original values from the database
function getOriginalValues($conn, $product_id) {
    $sql = "SELECT product_discount, product_stock, product_price FROM products WHERE product_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $product_id);
    $stmt->execute();
    $stmt->bind_result($originalDiscount, $originalStock, $originalPrice);
    $stmt->fetch();
    $stmt->close();

    return ['product_discount' => $originalDiscount, 'product_stock' => $originalStock, 'product_price' => $originalPrice];
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Connect to your MySQL database
    $servername = "localhost";
    $username = "jwongso001";
    $password = "jwongso001";
    $dbname = "Novatech";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Loop through the products to update discount and stock
    foreach ($_POST['discount'] as $product_id => $discount) {
        $price = $_POST['price'][$product_id];
        $stock = $_POST['stock'][$product_id];
        $update = $_POST['update'][$product_id]; // Check if the checkbox is selected

		if ($update == 1) {
			$product_id = (int) $product_id;
			$discount = trim($_POST['discount'][$product_id]) !== '' ? (float)$_POST['discount'][$product_id] : null;
			$stock = trim($_POST['stock'][$product_id]) !== '' ? (int)$_POST['stock'][$product_id] : null;
			$price = trim($_POST['price'][$product_id]) !== '' ? (float)$_POST['price'][$product_id] : null;

			// Check if there's new input; if not, retain the previous values
			if ($discount === null) {
				$originalValues = getOriginalValues($conn, $product_id);
				$discount = $originalValues['product_discount'];
			}

			if ($stock === null) {
				$originalValues = getOriginalValues($conn, $product_id);
				$stock = $originalValues['product_stock'];
			}

			if ($price === null) {
				$originalValues = getOriginalValues($conn, $product_id);
				$price = $originalValues['product_price'];
			}


            // Update the database for each product
            $sql = "UPDATE products SET product_discount = ?, product_stock = ?, product_price = ? WHERE product_id = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("didi", $discount, $stock, $price, $product_id);
            $stmt->execute();
            $stmt->close();
        }
    }

    // Close the database connection
    $conn->close();

    // Redirect back to the product table
    header("Location: ../admin_inventory.php");
} else {
    echo "Invalid request.";
}
?>