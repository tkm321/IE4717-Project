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
            <li><a href="index.php">Home</a></li> | 
            <li><a href="products.php">Products</a></li> |
            <li><a href="aboutus.php">About Us</a></li> |
            <li><a href="contact.php">Contact Us</a></li>
          </ul>
        </nav>
      </div>
      <!-- END OF NAVBAR -->
      <div class="aboutus">
        <img src="images/aboutus.jpg" width="80%" style="display:block; margin-left:auto; margin-right:auto; width:100%;">
      </div> 
      <div id="bodytext">
        <h1>Welcome to NovaTech - Your Ultimate Electronics Store</h1>
        <p>NovaTech is Singapore's up and coming ecommerce retailer offering to revolutionise the online shopping experience for consumer electronics and IT enthusiasts. With a diverse selection of consumer electronics, IT products, and accessories, our platform is dedicated to offering convenience and accessibility to our esteemed customers.</p><br>
        
        <h2>Our Story</h2>
        <p>At NovaTech, our story is one of passion, innovation, and a relentless pursuit of excellence. Founded in the heart of Singapore, our journey into the world of technology began with a vision: to make the latest and greatest in consumer electronics and IT products accessible to all.<br><br>
          With each step of our journey, we've remained steadfast in our commitment to serve you, our valued customers, with the most advanced gadgets and gizmos. Our story is a testament to the spirit of innovation and the belief that technology can enhance lives.</p><br>
        
        <h2>Mission & Vision</h2>
        <p><b>Mission:</b> To empower individuals and businesses with cutting-edge technology that simplifies life, fuels innovation, and unlocks new possibilities.<br><br>
          <b>Vision:</b> To be your trusted partner on the path to technological empowerment. We aim to reshape the way you experience and interact with technology by providing a platform that combines choice, quality, and service to exceed your expectations.</p><br>

        <h2>Why NovaTech?</h2>
          <ul>
            <li><p><b>Diverse Selection: </b>Explore an extensive range of consumer electronics, IT products, and accessories meticulously curated for quality, performance, and style.</p></li>
            <li><p><b>User-Friendly Experience: </b>Our website is designed with you in mind. Our user-friendly interface ensures a seamless shopping experience, allowing you to make informed decisions effortlessly.</p></li>
            <li><p><b>Customer-Centric Approach: </b>Your satisfaction is our top priority. Our dedicated customer support team is always at your service, ready to assist you at every step of your tech journey.</p></li>
            <li><p><b>Transparency and Trust: </b>We value your trust and are committed to fostering it through transparency. Your data and transactions are protected, and your expectations are exceeded.</p></li>
            <li><p><b>Innovation at its Finest: </b>NovaTech is not just about selling products; it's about being a part of your tech evolution. We're dedicated to staying on the cutting edge of technology, ensuring that you always have access to the latest innovations.</p></li>
          </ul><br>
      </div>
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

  </div>
</body>
</html>
