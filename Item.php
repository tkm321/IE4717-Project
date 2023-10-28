<!DOCTYPE html>
<html lang="en">
<head>
  <title>NovaTech - Your Ultimate Electronics Store</title>
  <meta charset="UTF-8">
  <link rel="stylesheet" href="css/styles.css">
  <link rel="stylesheet" href="css/itemstyles.css">
  <link rel="icon" type="image/x-icon" href="images/favicon/favicon.ico">
  <script type="text/javascript" src="js/login.js"></script>
</head>


<body>
  <div id="container">
    <!-- START OF HEADER -->
    <div id="header">
        <div id="logo">
            <a href="index.html"><img src="images/logo.png"></a>
        </div>

        <div id="searchbar">
          <form action="#.php" method="get">
            <input type="text" name="search" id="search" placeholder="Search...">
            <button type="submit" id="searchbuttons">Search</button>
          </form>
        </div>

        <div id="topright">
          <button class="open-button" onclick="openForm()">Login</button>
          <div class="form-popup" id="loginForm">
            <form action="#.php" class="form-container">
              <h1>Member Login</h1>
          
              <label for="username"><b>Username</b></label>
              <input type="text" placeholder="Enter Username" name="username" required>
          
              <label for="password"><b>Password</b></label>
              <input type="password" placeholder="Enter Password" name="psw" required>
          
              <button type="submit" class="btn">Login</button>
              <button type="button" class="btn cancel" onclick="closeForm()">Close</button>
            </form>
          </div>

          <a href="#.html"><button class="topbuttons">Wishlist</button></a>
          <a href="#.html"><button class="topbuttons">Cart</button></a>
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
			  <li><a href="#.html">Category 1</a></li> |
			  <li><a href="#.html">Category 2</a></li> |
			  <li><a href="#.html">Category 3</a></li> |
			  <li><a href="#.html">Category 4</a></li>
			  <!-- <li><a href="products.html">Products</a></li> |
			  <li><a href="aboutus.html">About Us</a></li> |
			  <li><a href="contact.html">Contact</a></li> -->
			</ul>
		  </nav>
		</div>
		<!-- END OF NAVBAR -->
		<!-- START OF ITEM PAGE -->
		<div class = "ITEM_PAGE">
			<div id="productid_1">
				<div class = "product_name" id="product_name">
					<h2 class = "product_name">Get from product id 1
				</div>
				<div class = "product_img" id ="product_img">
					<img src="product_imgs/product_2/img_1.jpg">
				</div>
				<div class = "product_desc" id="product_desc">
				
				</div>
			</div>
		</div>
	</div>	
		
		<!-- END OF ITEM PAGE -->
	<!-- End of Main Body -->
    <!-- START OF FOOTER -->
    <div id="footer">
      <footer>
          <div id="sitemap">
            <nav>
              <ul>
                <li><a href="index.html">Home</a></li>
                <li><a href="products.html">All Products</a></li>
                <li><a href="aboutus.html">About Us</a></li>
                <li><a href="contact.html">Contact Us</a></li>
                <!-- <li><a href="products.html">Products</a></li> |
                <li><a href="aboutus.html">About Us</a></li> |
                <li><a href="contact.html">Contact</a></li> -->
              </ul>
            </nav>
          </div>
          <p>&copy; 2023 NovaTech Pte Ltd. All Rights Reserved.</p>
      </footer>
    </div>
    <!-- END OF FOOTER -->
  </div>
</html>