<?php
	session_start();

  if (isset($_SESSION['valid_user'])) { // if user tries to access the login.php page after logged in 
    // Redirect to index.php
    header("Location: index.php");
    exit; // Ensure that no other code is executed after the redirection
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>NovaTech - Login</title>
  <meta charset="UTF-8">
  <link rel="stylesheet" href="css/styles.css">
  <link rel="icon" type="image/x-icon" href="images/favicon/favicon.ico">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Orbitron"> <!-- Title font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Electrolize"> <!-- Subtitle font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto"> <!-- Body font -->
  <script src="https://kit.fontawesome.com/66341603a8.js" crossorigin="anonymous"></script>  
  <script type="text/javascript" src="js/login.js"></script>
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
    
    <div class = "loginform-wrapper">
      <div class="loginform-container">
        <form action="php/auth_login.php" method="post" class="loginForm" id="loginForm">
          <h1>MEMBER LOGIN</h1>     
          <input type="text" placeholder="Enter Email" name="loginemail" id="loginemail" required>
          <input type="password" placeholder="Enter Password" name="loginpassword" id="loginpassword" required>
          
          <p>No account yet? <a href="register.php" id="signup">Click here to sign up!</a></p>
          <div id="error-message"></div>
          <button type="submit" class="btn">LOG IN</button>
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
              <li><a href="index.php">HOME</a></li>
              <li><a href="products.php">PRODUCTS</a></li>
              <li><a href="aboutus.php">ABOUT US</a></li>
              <li><a href="contact.php">CONTACT US</a></li>
            </ul>
          </nav>
        </div>
        <p>&copy; 2023 NovaTech Pte Ltd. All Rights Reserved.</p>
    </footer>
  </div>
  <!-- END OF FOOTER -->
  
	</script>
  <script src="js/login.js"></script>
  </div>
</body>
</html>
