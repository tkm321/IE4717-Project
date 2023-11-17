<?php
session_start();

// Function to establish a database connection
function connectToDatabase()
{
  $servername = "localhost";
  $username = "jwongso001";
  $password = "jwongso001";
  $dbname = "Novatech";

  $conn = new mysqli($servername, $username, $password, $dbname);

  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }

  return $conn;
}

if (!isset($_SESSION['valid_user'])) {
  echo '<script>alert("You are not logged in.");</script>';
  echo '<script>window.history.back();</script>';
  exit;
}

if (isset($_SESSION['member_id'])) {
  $member_id = $_SESSION['member_id'];
} else {
  $valid_user = $_SESSION['valid_user'];

  // Establish a connection if it's not already established
  if (!isset($conn)) {
    $conn = connectToDatabase();
  }

  $memberEmail = $valid_user;
  $memberIdStmt = $conn->prepare("SELECT member_id FROM members WHERE member_email = ?");
  $memberIdStmt->bind_param("s", $memberEmail);
  $memberIdStmt->execute();
  $memberIdStmt->bind_result($member_id);
  $memberIdStmt->fetch();
  $memberIdStmt->close();

  $_SESSION['member_id'] = $member_id;
}

if (isset($_GET['product_id'])) {
  $product_id = $_GET['product_id'];
} else {
  echo '<script>alert("Product ID not found.");</script>';
  echo '<script>window.history.back();</script>';
  exit;
}

// Check for an existing review
if (!isset($conn)) {
  $conn = connectToDatabase();
}

$checkReviewStmt = $conn->prepare("SELECT review_id FROM reviews_ind WHERE member_id = ? AND product_id = ?");
$checkReviewStmt->bind_param("ii", $member_id, $product_id);
$checkReviewStmt->execute();
$checkReviewStmt->store_result();

if ($checkReviewStmt->num_rows > 0) {
  echo '<script>alert("You have already reviewed this product.");</script>';
  echo '<script>window.history.back();</script>';
  exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <title>NovaTech - Leave a Review</title>
  <meta charset="UTF-8">
  <link rel="stylesheet" href="css/styles.css">
  <link rel="stylesheet" href="css/reviewstyles.css">
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
        if (isset($_SESSION['valid_user'])) {
          // echo 'Welcome '.$member_name.'!<br />';
          echo 'You are logged in as: <b>' . $_SESSION['valid_user'] . '</b> <br />';
          echo '<a href="php/logout.php" onclick="return confirm(`Are you sure to logout?`);"><button class="topbuttons" id="logout-button"><i class="fa-solid fa-door-open"></i><br>Logout</button></a>';
        } else {
          echo '<a href="login.php"><button class="topbuttons" id="login-button"><i class="fa-solid fa-right-to-bracket"></i><br>Login</button></a>';
        }
        ?>
        <a href="wishlist.php"><button class="topbuttons"><i class="fa-solid fa-heart"></i><br>Wishlist</button></a>
        <?php include "php/cart_count.php"; ?>
      </div>
    </div>
    <!-- END OF HEADER -->

    <!-- Main Body -->
    <div class="Content_Wrapper">
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

      <!-- Review Form -->
      <div class="review-form">
        <h2>Submit a Review</h2>
        <form method="post" action="php/review_db.php" name="reviewform" class="reviewform" id="reviewform">
          <div>
            <label for="name">*Name:</label>
            <input type="text" id="name" name="name" placeholder="Enter your name here" required><br><br>
          </div>

          <div>
            <label for="email">*Email:</label>
            <input type="email" id="email" name="email" placeholder="Enter your email here" required><br><br>
          </div>

          <div>
            <label for="contact">*Contact Number:</label>
            <input type="text" id="contact" name="contact" placeholder="Enter your contact number here" required><br><br>
          </div>

          <div>
            <label for="message">*Review:</label>
            <textarea id="message" name="message" rows="10" cols="100" placeholder="Enter your review here (Max 100 words)" required oninput="validateMessage(this)"></textarea>
          </div>

          <div>
            <label for="rating">*Rating:</label>
            <input type="number" id="rating" name="rating" min="1" max="5" placeholder="1-5" required oninput="validateRating(this)">
          </div>
          <input type="hidden" name="product_id" value="<?php echo $_GET['product_id']; ?>">

          <button type="reset" id="resetbutton" class="resetbutton">Clear</button>
          <button type="submit" id="submitbutton" class="submitbutton">Submit Review</button>
        </form>
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
        var reviewform = document.getElementById("reviewform");
        reviewform.addEventListener('submit', (event) => {
          if (!validateReviewForm()) event.preventDefault()
        })
      </script>
    </div>
</body>

</html>