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
    <script type="text/javascript" src="js/login.js"></script>
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
                        echo '<a href="php/logout.php"><button class="open-button" id="open-button">Logout</button></a>';
                    }
                    else
                    {
                        echo '<button class="open-button" id="open-button" onclick="openForm()">Login</button>';
                    }
                ?>
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
                <li><a href="index.php">Home</a></li> | 
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
                    <div><img src="Product_imgs/Product_1/img_1.jpg" style="width: 100%";></div>
                    <div><img src="product_imgs/product_2/img_1.jpg" style="width: 100%";></div>
                    <div><img src="product_imgs/product_3/img_1.jpg" style="width: 100%";></div>
                    <div><img src="product_imgs/product_4/img_1.jpg" style="width: 100%";></div>
                    <div><img src="product_imgs/product_5/img_1.jpg" style="width: 100%";></div>
                </div>
                <div class="bannerbestdesc">
                    <div><p>MacBook 15</p></div>
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
                    <li><a href="index.php">Home</a></li>
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
    <script src="/js/login.js"></script>
</body>
</html>