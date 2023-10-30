<?php
	include("PHP/item_desc.php");  
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>NovaTech - Your Ultimate Electronics Store</title>
  <meta charset="UTF-8">
  <link rel="stylesheet" href="css/styles.css">
  <link rel="stylesheet" href="css/itemstyles.css">
  <link rel="icon" type="image/x-icon" href="images/favicon/favicon.ico">
  <script type="text/javascript" src="js/login.js"></script>
  <script type="text/javascript" src="js/slideshow.js"></script>
  <script type="text/javascript" src="js/dropdown.js"></script>
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
		
		<!-- Product details -->
		<div class="ITEM_PAGE">
			<div id="productid_<?php echo $product['product_id']; ?>"></div>
				<div class="product_name" id="product_name">
					<h2 class="product_name"><?php echo $product['product_name']; ?></h2>
				</div>
			<div class="product_info">
					
				<div class="product_img" id="product_img">
					<a class="prev" onclick="plusSlides(-1)">&#10094;</a>
					<div class="slideshow-container">
						
						<?php
						$image_folder = 'product_imgs/Product_' . $product['product_id'] . '/';
						$image_files = glob($image_folder . 'img_*.jpg');

						foreach ($image_files as $index => $image_path) {
							$style = ($index === 0) ? 'style="display: block;"' : 'style="display: none;"';
							echo '<div class="mySlides" ' . $style . '><img src="' . $image_path . '" alt="' . $product['product_name'] . '"></div>';
						}
						?>
					</div>
					<a class="next" onclick="plusSlides(1)">&#10095;</a>
					
					<!-- Thumbnail images -->
					<div class="thumbnail-container">
						<?php
						foreach ($image_files as $index => $image_path) {
							echo '<img class="thumbnail" src="' . $image_path . '" alt="' . $product['product_name'] . '" onclick="currentSlide(' . ($index + 1) . ')">';
						}
						?>
					</div>	
					
				</div>

				<!-- Product Details -->
				<div class="product_desc" id="product_desc">
					<table id="table_product_desc">
						<tr>
							<td>Price:</td>
							<td>$<?php echo $product['product_price']; ?></td>
						</tr>
						<tr>
							<td>Review:</td>
							<td>Review Taken from PHPMYADMIN(Add a Review Button)</td>
						</tr>
						<tr>
							<td>Amount:</td>
							<td>javascript</td>
						</tr>
						<tr>
							<td>Add to Wishlist:</td>
							<td>A Button</td>
						</tr>
						<tr>
							<td>Add to Cart</td>
							<td>A Button</td>
						</tr>
						<!-- Additional product details can be displayed here -->
					</table>
				</div>
			</div>

			<!-- Product Features -->
			<div class="product-features-container">
				<div class="product_features" id="product_features">
				  <table>
					  <tr>
						<td>
						  <button class="dropdown-btn" data-content="description">Description</button>
						</td>
						<td>
						  <button class="dropdown-btn" data-content="specifications">Specifications</button>
						</td>
						<td>
						  <button class="dropdown-btn" data-content="askus">Ask Us</button>
						</td>
						<td>
						  <button class="dropdown-btn" data-content="delivery">Delivery & Pickup Information</button>
						</td>
					  </tr>
					  <tr>
						<td colspan="4">
						  <div class="dropdown-content" id="description">
							<p>This is the description content.</p>
						  </div>
						  <div class="dropdown-content" id="specifications">
							<p>These are the specifications content.</p>
						  </div>
						  <div class="dropdown-content" id="askus">
							<p>Ask us anything here.</p>
						  </div>
						  <div class="dropdown-content" id="delivery">
							<p>All items available for online purchase are not guaranteed to be in stock at the time of order processing. If we are unable to fulfill your order, you will be offered an alternative or given a refund for the unavailable product.</p>
						  </div>
						</td>
					  </tr>
					</table>
				</div>
			</div>
			
		</div>
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