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

        <!-- START OF CONTACT FORM -->
        <div class="contactus">
          <img src="images/contactus.png" width="80%" style="display:block; margin-left:auto; margin-right:auto; width:100%; margin-bottom: 50px;">
        </div>
        
        <div class="contentform-wrapper">
          <p style="font-size:18px">Need to get in touch with us, whether to inquire about our products, discuss our services, or simply provide a feedback, we love to hear from you.</p><br>
          <form method="post" action="#.php" name="contactform" class="contactform" id="contactform">
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
            <div>
              <figcaption>Call Us</figcaption>
              <a href="tel:6567671314"><img src="images/call_icon.png" style="width:100px;">
              <p><b>+65-67671314</b><br><br>Mon - Fri: 10:00am - 10:00pm<br>Sat, Sun & Public Holidays: Closed</p></a>
            </div>
            <div>
              <figcaption>Email Us</figcaption>
              <a href="mailto:f32ee@localhost"><img src="images/email_icon.png" style="width:100px;">
              <p><b>support@novatech.com.sg</b><br><br>We will be guaranteed to get back with yo<br>within 2 working days<br></p></a>
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
  
	<script type="text/javascript">
		var contactform = document.getElementById("contactform");
		contactform.addEventListener('submit', (event) => {
			if (!validateContactForm()) event.preventDefault()
		})
	</script>
  </div>
</body>
</html>