<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <title>NovaTech - Checkout</title>
  <meta charset="UTF-8">
  <link rel="stylesheet" href="css/styles.css">
  <link rel="stylesheet" href="css/checkoutstyles.css">
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
        <h1>Checkout Page</h1>
      </div>

      <div class="checkout-container">
        <form method="post" action="php/checkout_order_db.php" name="checkoutform" class="checkoutform" id="checkoutform">
          <div class="checkout-details-and-review">
            <div class="checkout-details">
              <p style="font-size: 24px; padding-left: 20px; margin-top: 10px; margin-bottom: 10px;"><strong><u>Your Details</strong></u></p><br>

              <div>
                <label for="name">*Name:</label>
                <input type="text" id="name" name="name" placeholder="Enter your name here" required><br><br>
              </div>

              <div>
                <label for="email">*Email:</label>
                <input type="email" id="email" name="email" placeholder="Enter your email here" required><br><br>
              </div>

              <div>
                <label for="contact">*Contact Number:</label>
                <input type="text" id="contact" name="contact" placeholder="Enter your contact number here" required><br><br>
              </div>

              <div>
                <label for="address">*Address:</label>
                <textarea id="address" name="address" rows="5" cols="80" placeholder="Enter your Address" required></textarea>
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
            <div class="payment-options">
              <label>
                <input type="radio" name="payment" value="visa">
                <img src="images/visa.png" alt="Option 1">
              </label>
              <label>
                <input type="radio" name="payment" value="master">
                <img src="images/master.png" alt="Option 2">
              </label>
              <label>
                <input type="radio" name="payment" value="amex">
                <img src="images/amex.png" alt="Option 3">
              </label>
              <label>
                <input type="radio" name="payment" value="applepay">
                <img src="images/applepay.png" alt="Option 4">
              </label>
              <label>
                <input type="radio" name="payment" value="googlepay">
                <img src="images/googlepay.png" alt="Option 5">
              </label>
            </div>
            <button type="submit" id="submitbutton" class="checkout-button" name="submit"><i class="fa-solid fa-lock"></i><br>Secure Checkout</button>
          </div>
        </form>
      </div>
    </div>

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
      var checkoutform = document.getElementById("checkoutform");
      checkoutform.addEventListener('submit', (event) => {
        if (!validateCheckoutForm()) event.preventDefault()
      })
    </script>
  </div>
</body>

</html>