<?php
	session_start();
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
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Orbitron"> <!-- Title font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Electrolize"> <!-- Subtitle font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto"> <!-- Body font -->
  <script src="https://kit.fontawesome.com/66341603a8.js" crossorigin="anonymous"></script>  
  <script type="text/javascript" src="js/slideshow.js"></script>
  <script type="text/javascript" src="js/item_script.js"></script>
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
					<form id="actionForm" action="php/product_add_db.php" method="get">
					<input type="hidden" name="product_id" value="<?php echo $product['product_id']; ?>">
					<table id="table_product_desc" class="product-table">
						<tr>
							<td class="price-cell">
								<?php
								$discountedPrice = $product['product_price'] * (1 - $product['product_discount'] / 100);

								if ($product['product_discount'] > 0) {
									echo '<span style="color: red;">$' . number_format($discountedPrice, 2) . '&nbsp</span>';
									echo ' <span style="text-decoration: line-through; font-size: 80%; color: black;">$' . number_format($product['product_price'], 2) . '</span>';
								} else {
									echo '$' . number_format($product['product_price'], 2);
								}
								?>
							</td>
						</tr>
						</tr>
						<tr>
							<td class="stock-cell">
								<?php
								echo  $product['product_stock'] . ' items available'; // Display product stock
								?>
							</td>
						</tr>
						<tr>
							<td class="review-cell">
									<?php
										$reviewValue = $review; 
										echo 'Review : ' . $review . ' ';

										// Calculate the number of filled stars based on the review value
										$numFilledStars = floor($reviewValue); // Number of filled stars

										// Calculate the number of half-filled stars based on the review value
										$hasHalfStar = ($reviewValue - $numFilledStars) >= 0.5;

										// Add filled, half-filled, and empty stars based on the range
										for ($i = 1; $i <= 5; $i++) {
											if ($i <= $numFilledStars) {
												echo '<span class="star-filled">★</span>';
											} elseif ($i == $numFilledStars + 1 && $hasHalfStar) {
												echo '<span class="star-half">✭</span>';
											} else {
												echo '<span class="star-empty">☆</span>';
											}
										}
									?>
									<a href="review.php?product_id=<?php echo $product['product_id']; ?>" class="add-review-link">Add a Review</a>
							</td>
						</tr>
						<tr>
							<td>
								<?php
									if ($isInWishlist) {
										echo '<button type="submit" name="action" value="remove_wishlist" class="addcart-button">Remove from Wishlist</button>';
									} else {
										echo '<button type="submit" name="action" value="add_wishlist" class="addcart-button">Add to Wishlist</button>';
									}
								?>
							</td>
						</tr>
						<tr>
							<td>
								<button type="submit" name="action" value="cart" class="addcart-button">Add to Cart</button>
							</td>
						</tr>
						<!-- Additional product details can be displayed here -->
					</table>
					</form>
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
							<p><?php echo "<p>$productDesc</p>"; ?></p>
						  </div>
						  <div class="dropdown-content" id="specifications">
							<ul style="padding-left: 20px;">
								<?php
								// Split the product name into words
								$productNameWords = explode(' ', $product['product_name']);

								// Get the first word of the product name
								$productbrand = !empty($productNameWords) ? $productNameWords[0] : '';

								// Display the first word of the product name in the first <li>
								echo "<li>Brand: $productbrand</li>";

								// Display other specifications
								if (!empty($specs1)) echo "<li>$specs1</li>";
								if (!empty($specs2)) echo "<li>$specs2</li>";
								if (!empty($specs3)) echo "<li>$specs3</li>";
								if (!empty($specs4)) echo "<li>$specs4</li>";
								if (!empty($specs5)) echo "<li>$specs5</li>";
								?>
							</ul>
						  </div>
						  <div class="dropdown-content" id="askus">
							<div class="item-form">
							<form method="post" action="php/item_enquiry_email.php" name="itemform" class="itemform" id="itemform">
								<div>
								<input type="hidden" name="product_id" value="<?php echo $requestedProductId; ?>">
								<input type="hidden" name="product_name" value="<?php echo $product['product_name']; ?>">
								<p>Product ID: <?php echo $requestedProductId; ?></p>
								<p>Product Name: <?php echo $product['product_name']; ?></p>
								</div>
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
								  <textarea id="message" name="message" rows="10" cols="60" placeholder="Enter your message here" required></textarea>
								</div>
								
								<button type="reset" id="resetbutton" class="resetbutton">Clear</button>
								<button type="submit" id="submitbutton" class="submitbutton">Send Message</button>
							</form>
						  </div>
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
          <p>&copy; 2023 NovaTech Pte Ltd. All Rights Reserved.</p>
      </footer>
    </div>
    <!-- END OF FOOTER -->

	<script type="text/javascript">
		var itemform = document.getElementById("itemform");
		itemform.addEventListener('submit', (event) => {
			if (!validateitemForm()) event.preventDefault()
		})
	</script>
  </div>
</body>
</html>