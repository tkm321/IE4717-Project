<?php
	session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>NovaTech - Your Ultimate Electronics Store</title>
  <meta charset="UTF-8">
  <link rel="stylesheet" href="css/styles.css">
  <link rel="icon" type="image/x-icon" href="images/favicon/favicon.ico">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  
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
                  echo '<a href="php/logout.php"><button class="topbuttons" id="login-button">Logout</button></a>';
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

    <!-- Main Body -->
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
