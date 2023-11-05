
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
          <a href="login.php"><button class="topbuttons" id="login-button">Login</button></a>
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
            <li><a href="index.php">Home</a></li> | 
            <li><a href="products.php">Products</a></li> |
            <li><a href="aboutus.html">About Us</a></li> |
            <li><a href="contact.html">Contact Us</a></li>
          </ul>
        </nav>
      </div>
      <!-- END OF NAVBAR -->
    <!-- Product display -->
    <div class="page-header">
      <h2>Wishlist</h2>
    </div>
    
    <?php
      // Include the PHP file and execute the code within it
      $products = include("PHP/wishlist_display.php");  
    ?>


    </div>
    <!-- End of Main Body -->
    
    <!-- START OF FOOTER -->
    <div id="footer">
      <footer>
          <div id="sitemap">
            <nav>
              <ul>
                <li><a href="index.php">Home</a></li>
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

  </div>
  <script src="js/login.js"></script>
</body>
</html>
