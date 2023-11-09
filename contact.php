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

        <!-- START OF CONTACT FORM -->
        <div class="contactus">
          <img src="images/contactus.png" width="80%" height="350px" style="display:block; margin-left:auto; margin-right:auto; width:100%; margin-bottom: 50px;">
        </div>
        
        <div class="contentform-wrapper">
          <p style="font-size:18px">Need to get in touch with us, whether to inquire about our products, discuss our services, or simply provide a feedback, we love to hear from you.</p><br>
          <form method="post" action="php/enquiry_confirmation_email.php" name="contactform" class="contactform" id="contactform">
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
              <label for="message">*Message:</label>
              <textarea id="message" name="message" rows="10" cols="100" placeholder="Enter your message here" required></textarea>
            </div>
            
            <button type="reset" id="resetbutton" class="resetbutton">Clear</button>
            <button type="submit" id="submitbutton" class="submitbutton">Send Message</button>
          </form>
        </div>
            
        <div class="banner">
          <div id="bannercontact">
            <div id="leftbanner">
              <h1 id="callus">Call Us</h1>
              <a href="tel:6567671314"><img src="images/call_icon.png" style="width:100px;">
              <p><b>+65-67671314</b></a><br><br>Mon - Fri: 10:00am - 10:00pm<br>Sat, Sun & Public Holidays: Closed</p>
            </div>
            <div id="rightbanner">
              <h1 id="emailus">Email Us</h1>
              <a href="mailto:f32ee@localhost"><img src="images/email_icon.png" style="width:100px;">
              <p><b>support@novatech.com.sg</b></a><br><br>We will be guaranteed to get back with yo<br>within 2 working days<br></p>
            </div>
          </div>
        </div>
        <!-- END OF CONTACT FORM -->
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
  
	<script type="text/javascript">
		var contactform = document.getElementById("contactform");
		contactform.addEventListener('submit', (event) => {
			if (!validateContactForm()) event.preventDefault()
		})
	</script>
  </div>
</body>
</html>
