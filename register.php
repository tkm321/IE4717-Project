<?php
	session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>NovaTech - Registration</title>
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
        
        <div class="registerform-wrapper">
            <div class="registerform-container">
              <form action="php/register_member.php" method="post" name="registerform" class="registerform" id="registerform">
                <h1>MEMBER REGISTRATION</h1>  
                <div>
                  <label for="name">*Name:</label>    
                  <input type="text" id="name" name="name" placeholder="Name" onchange="validateName(event)" required><br><br>
                </div>
              
                <div>
                  <label for="email">*Email:</label>
                  <input type="email" id="email" name="email" placeholder="Email" onchange="validateEmail(event)" required><br><br>
                </div>
              
                <div>
                  <label for="contact">*Contact Number:</label>
                  <input type="text" id="contact" name="contact" placeholder="Contact Number" onchange="validateContact(event)" required><br><br>
                </div>
              
                <div>
                  <label for="password">*Password:</label>
                  <input type="password" id="password" name="password" placeholder="Password" onchange="validatePassword(event)" required><br><br>
                </div>
              
                <div>
                  <label for="confirmpassword">*Confirm Password:</label>
                  <input type="password" id="confirmpassword" name="confirmpassword" placeholder="Confirm Password" onchange="validatePasswordSame(event)" required><br><br>
                </div>
                
                <button type="submit" id="registerbutton" class="registerbutton">REGISTER</button>
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
    var registerform = document.getElementById("registerform");
    registerform.addEventListener('submit', (event) => {
        if (!validateRegisterForm()) event.preventDefault()
    })
  </script>
  </div>
</body>
</html>
