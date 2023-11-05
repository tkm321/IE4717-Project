
<!DOCTYPE html>
<html lang="en">
<head>
  <title>NovaTech - Your Ultimate Electronics Store</title>
  <meta charset="UTF-8">
  <link rel="stylesheet" href="css/styles.css">
  <link rel="icon" type="image/x-icon" href="images/favicon/favicon.ico">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <script type="text/javascript" src="js/login.js"></script>
  
</head>

<body>
  <div id="container">

    <div class="form-background" id="form-bg">
      <div class="form-popup" id="loginForm">
        <div id="close">
          <span id="close-button">×</span>
        </div>
        <form action="php/login.php" method="post" class="form-container">
          <h1>Member Login</h1>
        
          <input type="text" placeholder="Enter Email" name="loginemail" id="loginemail" required>
          <input type="password" placeholder="Enter Password" name="loginpassword" id="loginpassword" required>
        
          <p>No account yet? <a href="register.html" id="signup">Click here to sign up!</a></p>
        
          <button type="submit" class="btn">LOG IN</button>
        </form>
      </div>
    </div>

    <!-- START OF HEADER -->
    <div id="header">
        <div id="logo">
            <a href="index.html"><img src="images/logo.png"></a>
        </div>

        <div id="searchbar">
          <form action="searchresult.php" method="post">
            <input type="text" name="searchterm" id="searchterm" placeholder="Find a product..." required>
            <button type="submit" id="searchbuttons">Search <i class="fa fa-search"></i></button>
          </form>
        </div>

        <div id="topright">			
          <button class="open-button" id="open-button" onclick="openForm()">Login</button>
          <a href="wishlist.php"><button class="topbuttons">Wishlist</button></a>
          <a href="cart.php"><button class="topbuttons">Cart</button></a>
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
          <li><a href="products.php">Products</a></li> |
          <li><a href="aboutus.html">About Us</a></li> |
          <li><a href="contact.html">Contact Us</a></li>
        </ul>
      </nav>
    </div>
    <!-- END OF NAVBAR -->
    <div class="page-header">
      <h2>All Products</h2>
    </div>
	  <!-- Product display -->
    <div class="product-divider">
      <?php
        // Include the PHP file and execute the code within it
        $products = include("PHP/product_display.php");  
      ?>
    </div>
  </div>
  <!-- End of Main Body -->
  
  <!-- START OF FOOTER -->
  <div id="footer">
    <footer>
        <div id="sitemap">
          <nav>
            <ul>
              <li><a href="index.html">Home</a></li>
              <li><a href="products.php">Products</a></li>
              <li><a href="aboutus.html">About Us</a></li>
              <li><a href="contact.html">Contact Us</a></li>
            </ul>
          </nav>
        </div>
        <p>&copy; 2023 NovaTech Pte Ltd. All Rights Reserved.</p>
    </footer>
  </div>
  <!-- END OF FOOTER -->
  
  <script src="js/login.js"></script>
  </div>
</body>
</html>
