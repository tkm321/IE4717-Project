<?php

// Function to retrieve original values from the database
function getOriginalValues($conn, $product_id) {
    $sql = "SELECT product_discount, product_stock FROM products WHERE product_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $product_id);
    $stmt->execute();
    $stmt->bind_result($originalDiscount, $originalStock);
    $stmt->fetch();
    $stmt->close();

    return ['product_discount' => $originalDiscount, 'product_stock' => $originalStock];
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
        $stock = $_POST['stock'][$product_id];
        $update = $_POST['update'][$product_id]; // Check if the checkbox is selected

        if ($update == 1) {
            $product_id = (int) $product_id;
            $discount = (float) $discount;
            $stock = (int) $stock;

            // Check if discount or stock is empty and retrieve original values
            if (empty($discount) || empty($stock)) {
                $originalValues = getOriginalValues($conn, $product_id);
                if (empty($discount)) {
                    $discount = $originalValues['product_discount'];
                }
                if (empty($stock)) {
                    $stock = $originalValues['product_stock'];
                }
            }

            // Update the database for each product
            $sql = "UPDATE products SET product_discount = ?, product_stock = ? WHERE product_id = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("dii", $discount, $stock, $product_id);
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