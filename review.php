<?php
	session_start(); 
	
	if (!isset($_SESSION['valid_user'])) {
		// The user is not logged in
		echo '<script>alert("You are not logged in.");</script>';
		// Redirect the user back to the previous page (assuming it's the referring page)
		echo '<script>window.history.back();</script>';
		exit; // Exit to prevent further execution of the page
	}

	// Continue with the rest of your "review.php" page for logged-in users
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>NovaTech - Leave a Review</title>
  <meta charset="UTF-8">
  <link rel="stylesheet" href="css/styles.css">
  <link rel="stylesheet" href="css/reviewstyles.css">
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
	<div class = "Content_Wrapper">
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
		
		<!-- Review Form -->
		  <div class="review-form">
			<h2>Submit a Review</h2>
			<form method="post" action="php/review_db.php" name="reviewform" class="reviewform" id="reviewform">
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
			  <label for="message">*Review:</label>
			  <textarea
				id="message"
				name="message"
				rows="10"
				cols="100"
				placeholder="Enter your review here (Max 100 words)"
				required
				oninput="validateMessage(this)"
			  ></textarea>
			</div>
			
			<div>
			  <label for="rating">*Rating (1-5):</label>
			  <input type="number" id="rating" name="rating" min="1" max="5" value="5" required oninput="validateRating(this)"
			  >
			</div>
			<input type="hidden" name="product_id" value="<?php echo $_GET['product_id']; ?>">
			
			<button type="reset" id="resetbutton" class="resetbutton">Clear</button>
			<button type="submit" id="submitbutton" class="submitbutton">Submit Review</button>
			</form>
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

  </div>
</body>
</html>

