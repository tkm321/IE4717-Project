<?php
	session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>NovaTech - Your Ultimate Electronics Store</title>
  <meta charset="UTF-8">
  <link rel="stylesheet" href="css/styles.css">
  <link rel="stylesheet" href="css/checkoutstyles.css">
  <link rel="icon" type="image/x-icon" href="images/favicon/favicon.ico">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
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
            <button type="submit" id="searchbuttons">Search <i class="fa fa-search"></i></button>
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
                echo '<a href="login.php"><button class="topbuttons" id="login-button">Login</button></a>';
              }
         	?>
          <a href="wishlist.php"><button class="topbuttons">Wishlist</button></a>
          <a href="cart.php"><button class="topbuttons">Cart</button></a>
        </div>
    </div>
    <!-- END OF HEADER -->

    
    <div class = "Content_Wrapper">
    <!-- START OF NAVBAR -->
        <div id="navbar">
        <nav>
          <ul>
            <li><a href="index.php">Home</a></li> |
            <li><a href="products.php">Products</a></li> |
            <li><a href="aboutus.php">About Us</a></li> |
            <li><a href="contact.php">Contact Us</a></li>
          </ul>
        </nav>
        </div>
    <!-- END OF NAVBAR -->        
	
	<div class="page-header">
		<h2>Checkout Page</h2>
	</div>	
	<div class="checkout-container">
		<form method="post" action="php/checkout_order_db.php" name="contactform" class="contactform" id="contactform">
			<div class="checkout-details-and-review">
				<div class="checkout-details">
				 <p style="font-size: 24px; padding-left: 20px; margin-top: 10px; margin-bottom: 10px;"><strong><u>Your Details</strong></u></p><br>
				  
					<div>
					  <label for="name">*Name:</label>    
					  <input type="text" id="name" name="name" placeholder="Enter your name here" onchange="validateName(event)" required><br><br>
					</div>
				  
					<div>
					  <label for="email">*Email:</label>
					  <input type="email" id="email" name="email" placeholder="Enter your email here" onchange="validateEmail(event)" required><br><br>
					</div>
				  
					<div>
					  <label for="contact">*Contact Number:</label>
					  <input type="text" id="contact" name="contact" placeholder="Enter your contact number here" onchange="validateContact(event)" required><br><br>
					</div>
				  
					<div>
					  <label for="address">*Address:</label>
					  <textarea id="address" name="address" rows="5" cols="50" placeholder="Enter your Address" required></textarea>
					</div>
				</div>
			
				<div class="checkout-review-order">	
					<?php
						include 'PHP/checkout_order_review.php';
					?>
				</div>
			</div>
			<div class="checkout-payment">
				<div style="font-size: 24px;  margin-top: 10px; margin-bottom: 10px;">
					<strong><u>Make Payment</u></strong>
				</div>
				<button type="submit" id="submitbutton" class="submitbutton checkout-button" name="submit">Checkout</button>
			</div>
		</form>  
		</div>

		
		
	</div>
	</div>
	
  <!-- START OF FOOTER -->
	<div id="footer">
	<footer>
        <div id="sitemap">
          <nav>
            <ul>
              <li><a href="index.php">Home</a></li>
              <li><a href="products.php">Products</a></li>
              <li><a href="aboutus.php">About Us</a></li>
              <li><a href="contact.php">Contact Us</a></li>
            </ul>
          </nav>
        </div>
        <p>&copy; 2023 NovaTech Pte Ltd. All Rights Reserved.</p>
    </footer>
  </div>
  <!-- END OF FOOTER -->
  
  </div>
</body>
</html>
