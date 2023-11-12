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

    if (isset($member_id)) {
        $cart_count_query = "SELECT COUNT(*) AS cart_count FROM cart WHERE member_id = $member_id";
        $cart_count_result = mysqli_query($conn, $cart_count_query);

        if ($cart_count_result) {
            $cart_count = mysqli_fetch_assoc($cart_count_result)['cart_count'];
            echo '<a href="cart.php"><button class="topbuttons"><i class="fa-solid fa-cart-shopping"></i><br>Cart ('.$cart_count.')</button></a>';
        } else {
            // Handle errors if the query fails
            echo 'Error fetching cart items.';
        }
    } else {
        echo '<a href="cart.php"><button class="topbuttons"><i class="fa-solid fa-cart-shopping"></i><br>Cart</button></a>';
    }
} else {
    echo '<a href="cart.php"><button class="topbuttons"><i class="fa-solid fa-cart-shopping"></i><br>Cart</button></a>';
}

mysqli_close($conn);
?>