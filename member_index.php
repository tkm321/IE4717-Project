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

<php>
	
</php>

<body>
  <div id="container">
    <!-- START OF HEADER -->
    <div id="header">
        <div id="logo">
            <a href="index.html"><img src="images/logo.png"></a>
        </div>

        <div id="searchbar">
          <form action="searchresult.php" method="post">
            <input type="text" name="searchterm" id="searchterm" placeholder="Find a product..." required>
            <button type="submit" id="searchbuttons">Search <i class="fa fa-search"></i></button>
          </form>
        </div>

        <div id="topright">
			<div id="form-bg" class="form-background" onclick="closeForm()"></div>
			<button class="open-button" onclick="openForm()">Login</button>
			<div class="form-popup" id="loginForm">
				<form action="php/login.php" method="post" class="form-container">
					<h1>Member Login</h1>
			
					<input type="text" placeholder="Enter Email" name="loginemail" id="loginemail" required>
					<input type="password" placeholder="Enter Password" name="loginpassword" id="loginpassword" required>

					<p>No account yet? <a href="register.html">Register here!</a></p>
				
					<button type="submit" class="btn">Login</button>
					<button type="button" class="btn cancel" onclick="closeForm()">Close</button>
				</form>
			</div>

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
			  <li><a href="index.html">Home</a></li> | 
			  <li><a href="products.php">Products</a></li> |
			  <li><a href="aboutus.html">About Us</a></li> |
			  <li><a href="contact.html">Contact Us</a></li>
			</ul>
		  </nav>
		</div>
		<!-- END OF NAVBAR -->
  
		<!-- START OF BANNER -->
		<div class="banner">
		  <h1>PROMOTION</h1>
		  <!-- <div class="bannerpromo"> -->
			<img src="images/blackfriday.jpg" width="100%">
		  <!-- </div> -->
		</div>
		
		<div class="banner">
		  <h1>BESTSELLERS</h1>
		  <div class="bannerbest">
			<div><figure><img src="Product_imgs/Product_1/img_1.jpg" style="width: 100%"; >
						<figcaption> MacBook 15</figcaption></div>
			<div><img src="product_imgs/product_2/img_1.jpg" style="width: 100%";></div>
			<div><img src="product_imgs/product_3/img_1.jpg" style="width: 100%";></div>
			<div><img src="product_imgs/product_4/img_1.jpg" style="width: 100%";></div>
			<div><img src="product_imgs/product_5/img_1.jpg" style="width: 100%";></div>
		  </div>
		  <div class="bannerbestdesc">
			<div><p>Description 1</p></div>
			<div><p>Description 2</p></div>
			<div><p>Description 3</p></div>
			<div><p>Description 4</p></div>
			<div><p>Description 5</p></div>
		  </div> 
		</div>

		<div class="banner">
		  <h1>NEW ARRIVALS</h1>
		  <div class="bannernew">
			<div><img src="product_imgs/product_1"></div>
			<div><img src="product_imgs/product_1"></div>
			<div><img src="product_imgs/product_1"></div>
			<div><img src="product_imgs/product_1"></div>
			<div><img src="product_imgs/product_1"></div>
		  </div>
		  <div class="bannernewdesc">
			<div><p>Description 1</p></div>
			<div><p>Description 2</p></div>
			<div><p>Description 3</p></div>
			<div><p>Description 4</p></div>
			<div><p>Description 5</p></div>
		  </div> 
		</div>
		<!-- END OF BANNER -->
	</div>	
	<!-- End of Main Body -->

    <!-- START OF FOOTER -->
    <div id="footer">
      <footer>
          <div id="sitemap">
            <nav>
              <ul>
                <li><a href="index.html">Home</a></li>
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
</body>
</html>