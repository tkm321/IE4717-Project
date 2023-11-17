<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <title>NovaTech - Search Result</title>
  <meta charset="UTF-8">
  <link rel="stylesheet" href="css/styles.css">
  <link rel="icon" type="image/x-icon" href="images/favicon/favicon.ico">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Orbitron"> <!-- Title font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Electrolize"> <!-- Subtitle font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto"> <!-- Body font -->
  <script src="https://kit.fontawesome.com/66341603a8.js" crossorigin="anonymous"></script>
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
        if (isset($_SESSION['valid_user'])) {
          // echo 'Welcome '.$member_name.'!<br />';
          echo 'You are logged in as: <b>' . $_SESSION['valid_user'] . '</b> <br />';
          echo '<a href="php/logout.php" onclick="return confirm(`Are you sure to logout?`);"><button class="topbuttons" id="logout-button"><i class="fa-solid fa-door-open"></i><br>Logout</button></a>';
        } else {
          echo '<a href="login.php"><button class="topbuttons" id="login-button"><i class="fa-solid fa-right-to-bracket"></i><br>Login</button></a>';
        }
        ?>
        <a href="wishlist.php"><button class="topbuttons"><i class="fa-solid fa-heart"></i><br>Wishlist</button></a>
        <?php include "php/cart_count.php"; ?>
      </div>
    </div>
    <!-- END OF HEADER -->

    <!-- Main Body -->
    <div class="Content_Wrapper">
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
      <div class="page-header">
        <h1>SEARCH RESULT: <?php echo $_POST['searchterm']; ?> </h1>
      </div>
      <!-- Product display -->
      <div class="product-divider">
        <?php
        // Include the PHP file and execute the code within it
        $products = include("PHP/searchresult_display.php");
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