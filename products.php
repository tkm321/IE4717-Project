
<!DOCTYPE html>
<html lang="en">
<head>
  <title>NovaTech - Your Ultimate Electronics Store</title>
  <meta charset="UTF-8">
  <link rel="stylesheet" href="css/styles.css">
  <link rel="icon" type="image/x-icon" href="images/favicon/favicon.ico">
  <script type="text/javascript" src="js/login.js"></script>
</head>

<body>
  <div id="container">
    <!-- START OF HEADER -->
    <div id="header">
        <div id="logo">
            <a href="index.html"><img src="images/logo.png"></a>
        </div>

        <div id="searchbar">
          <form action="#.php" method="get">
            <input type="text" name="search" id="search" placeholder="Search...">
            <button type="submit" class="topbuttons">Search</button>
          </form>
        </div>

        <div id="topright">
          <button class="open-button" onclick="openForm()">Login</button>
          <div class="form-popup" id="loginForm">
            <form action="#.php" class="form-container">
              <h1>Member Login</h1>
          
              <label for="username"><b>Username</b></label>
              <input type="text" placeholder="Enter Username" name="username" required>
          
              <label for="password"><b>Password</b></label>
              <input type="password" placeholder="Enter Password" name="psw" required>
          
              <button type="submit" class="btn">Login</button>
              <button type="button" class="btn cancel" onclick="closeForm()">Close</button>
            </form>
          </div>

          <a href="#.html"><button class="topbuttons">Wishlist</button></a>
          <a href="#.html"><button class="topbuttons">Cart</button></a>
        </div>
        
    </div>
    <!-- END OF HEADER -->

	<!-- Main Body -->
	<div class = "Content_Wrapper">
    <!-- START OF NAVBAR -->
    <div id="navbar">
      <nav>
        <ul>
          <li><a href="index.html">Home</a></li> | 
          <li><a href="#.html">Category 1</a></li> |
          <li><a href="#.html">Category 2</a></li> |
          <li><a href="#.html">Category 3</a></li> |
          <li><a href="#.html">Category 4</a></li>
          <!-- <li><a href="products.html">Products</a></li> |
          <li><a href="aboutus.html">About Us</a></li> |
          <li><a href="contact.html">Contact</a></li> -->
        </ul>
      </nav>
    </div>
    <!-- END OF NAVBAR -->
	<!-- Product display -->
	<div class="product-divider">
		<?php
		  // Include the PHP file and execute the code within it
		  $products = include("PHP/product_display.php");  

		  
		 ?>
		
	</div>

<!-- End of Main Body -->
  <!-- START OF FOOTER -->
  <div id="footer">
    <footer>
        <div id="sitemap">
          <nav>
            <ul>
              <li><a href="index.html">Home</a></li>
              <li><a href="products.html">All Products</a></li>
              <li><a href="aboutus.html">About Us</a></li>
              <li><a href="contact.html">Contact Us</a></li>
              <!-- <li><a href="products.html">Products</a></li> |
              <li><a href="aboutus.html">About Us</a></li> |
              <li><a href="contact.html">Contact</a></li> -->
            </ul>
          </nav>
        </div>
        <p>&copy; 2023 NovaTech Pte Ltd. All Rights Reserved.</p>
    </footer>
  </div>
  <!-- END OF FOOTER -->

  <script src="scripts.js"></script>
  </div>
</body>
</html>
