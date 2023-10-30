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

    // Close the database connection
    $conn->close();
} else {
    echo "Product ID not specified.";
}
?>