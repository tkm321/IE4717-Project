<?php
session_start();

// Check if the user is logged in and their member_email is "admin"
if (isset($_SESSION['valid_user']) && $_SESSION['valid_user'] === 'admin') {
    // The user is logged in as "admin"


	// Connect to your MySQL database
	$servername = "localhost";
	$username = "jwongso001";
	$password = "jwongso001";
	$dbname = "Novatech";

	$conn = new mysqli($servername, $username, $password, $dbname);

	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	}

	// Query to select product information
	$sql = "SELECT product_id, product_name, product_price, product_discount, product_stock FROM products";

	$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>NovaTech - Admin Inventory</title>
  <meta charset="UTF-8">
  <link rel="stylesheet" href="css/styles.css">
  <link rel="icon" type="image/x-icon" href="images/favicon/favicon.ico">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Orbitron"> <!-- Title font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Electrolize"> <!-- Subtitle font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto"> <!-- Body font -->
  <script src="https://kit.fontawesome.com/66341603a8.js" crossorigin="anonymous"></script>
  <script type="text/javascript" src="js/formvalidator.js"></script>
</head>

<body>
  <div id="container">
    <!-- START OF HEADER -->
    <div id="header">
        <div id="logo">
            <a href="index.php"><img src="images/logo.png"></a>
        </div>

        <div id="searchbar">
          <form action="searchresult.php" method="post">
            <input type="text" name="searchterm" id="searchterm" placeholder="Find a product..." required>
            <button type="submit" id="searchbuttons">Search <i class="fa-solid fa-magnifying-glass"></i></button>
          </form>
        </div>

        <div id="topright">			
			<?php
				if (isset($_SESSION['valid_user']))
				{
					// echo 'Welcome '.$member_name.'!<br />';
					echo 'You are logged in as: <b>'.$_SESSION['valid_user'].'</b> <br />';
					echo '<a href="php/logout.php" onclick="return confirm(`Are you sure to logout?`);"><button class="topbuttons" id="logout-button"><i class="fa-solid fa-door-open"></i><br>Logout</button></a>';
				}
				else
				{
					echo '<a href="login.php"><button class="topbuttons" id="login-button"><i class="fa-solid fa-right-to-bracket"></i><br>Login</button></a>';
				}
         	?>
			<a href="wishlist.php"><button class="topbuttons"><i class="fa-solid fa-heart"></i><br>Wishlist</button></a>
			<a href="cart.php"><button class="topbuttons"><i class="fa-solid fa-cart-shopping"></i><br>Cart</button></a>
        </div>
    </div>
    <!-- END OF HEADER -->

	<!-- Main Body -->
	<div class = "Inventory_Content_Wrapper">
	
		<!-- START OF NAVBAR -->
		<div id="navbar">
		  <nav>
			<ul>
			  <li><a href="index.php">HOME</a></li> | 
			  <li><a href="products.php">PRODUCTS</a></li> |
			  <li><a href="aboutus.php">ABOUT US</a></li> |
			  <li><a href="contact.php">CONTACT US</a></li>
			</ul>
		  </nav>
		</div>
		<!-- END OF NAVBAR -->
		<div class="inventoryform-container">
			<form action="php/admin_inventory_db.php" id="inventoryform" method="post">
				<table id="inventorytable">
					<tr>
						<th>Select</th>
						<th>Product ID</th>
						<th>Product Name</th>
						<th>Price ($)</th>
						<th>Discount (%)</th>
						<th>Stock (Qty)</th>
						<th>Update Price ($)</th>
						<th>Update Discount (%)</th>
						<th>Update Stock (Qty)</th>
					</tr>
					<?php
					if ($result->num_rows > 0) {
						while ($row = $result->fetch_assoc()) {
							echo "<tr>";
							echo "<td><input type='checkbox' name='update[" . $row['product_id'] . "]' class='checkbox' value='1'></td>";
							echo "<td>" . $row["product_id"] . "</td>";
							echo "<td>" . $row["product_name"] . "</td>";
							echo "<td>" . $row["product_price"] . "</td>";
							echo "<td>" . $row["product_discount"] . "</td>";
							echo "<td>" . $row["product_stock"] . "</td>";
							echo "<td><input type='number' name='price[" . $row['product_id'] . "]' onkeypress='return onlyNumberAndDecimal(event)'></td>";
							echo "<td><input type='number' name='discount[" . $row['product_id'] . "]' onkeypress='return onlyNumberAndDecimal(event)'></td>";
							echo "<td><input type='number' name='stock[" . $row['product_id'] . "]' onkeypress='return onlyNumber(event)'></td>";
							echo "</tr>";
						}
					} else {
						echo "No products found.";
					}
					?>
				</table>
				<div id="update-button-container">
					<input type="submit" class="update-button" id="update-button" value="Update">
				</div>
			</form>
		</div>

	</div>
	<!-- End of Main Body -->

    <!-- START OF FOOTER -->
    <div id="footer">
      <footer>
          <div id="sitemap">
            <nav>
              <ul>
                <li><a href="index.php">HOME</a></li>
                <li><a href="products.php">PRODUCTS</a></li>
                <li><a href="aboutus.php">ABOUT US</a></li>
                <li><a href="contact.php">CONTACT US</a></li>
              </ul>
            </nav>
          </div>
          <div class="socialmedia">
            <a href="#.php"><i class="fa-brands fa-facebook"></i></a>
            <a href="#.php"><i class="fa-brands fa-instagram"></i></a>
            <a href="#.php"><i class="fa-brands fa-x-twitter"></i></a>
            <a href="#.php"><i class="fa-brands fa-tiktok"></i></a>
          </div>
          <p>&copy; 2023 NovaTech Pte Ltd. All Rights Reserved.</p>
      </footer>
    </div>
    <!-- END OF FOOTER -->	
  
  	<script type="text/javascript">
		var inventoryform = document.getElementById("inventoryform");
		inventoryform.addEventListener('submit', (event) => {
			if (!validateInventoryForm()) event.preventDefault()
		})
	</script>
  </div>
</body>
</html>

<?php
} else {
    // Redirect to index.php
    header("Location: index.php");
    exit; // Ensure that no other code is executed after the redirection
}
?>