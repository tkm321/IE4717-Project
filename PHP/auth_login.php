<?php
    $servername = "localhost";
    $username = "jwongso001";
    $password = "jwongso001";
    $dbname = "Novatech";

    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check the connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    Session_start();

    if (isset($_POST['loginemail']) && isset($_POST['loginpassword'])) {
        $loginemail = $_POST['loginemail'];
        $loginpassword = $_POST['loginpassword'];

        if ($loginpassword != "admin") {
          $loginpassword = md5($loginpassword); // Encrypt password entered
        }

        // Retrieve member_name based on the member email
        // $fetchnamesql = "SELECT member_name FROM members WHERE member_email='$loginemail'";
        // $nameresult = $conn->query($fetchnamesql);
        // $name = $nameresult->fetch_assoc();
        // $member_name = $name['member_name'];

        $sql = "SELECT * FROM members WHERE member_email = '$loginemail' and member_password = '$loginpassword'";
        $result = $conn->query($sql);

        if($result->num_rows > 0) {         
            // log in user successfully and start session
            $_SESSION['valid_user'] = $loginemail;
            header("Location: ../index.php");
            exit();
        }
        else
        {
            // unsuccessful login
            $errorMessage = "Incorrect Email or Password. Please try again.";
        }
        $conn->close();
    }

    /*// Retrieve data from the form
    $enteredemail = $_POST['loginemail'];
    $enteredpassword = $_POST['loginpassword'];

    // Hash the entered password for comparison
    $hashedPassword = password_hash($enteredpassword, PASSWORD_DEFAULT);

    // Prepare and execute an SQL query to retrieve the stored password hash
    $sql = "SELECT member_password FROM members WHERE member_email = ?";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $enteredemail);
    $stmt->execute();
    $stmt->bind_result($storedPasswordHash);
    $stmt->fetch();
    
    // Verify the password
    // if (password_verify($enteredemail, $storedPasswordHash)) {
    if ($enteredpassword == $storedPasswordHash) {
        echo "Login successful!";
        // log in user successfully and start session
    } else {
        echo "Incorrect email or password. Please try again.";
        // prompt message for wrong username or password
    }*/

    // Close the database connection
    //$stmt->close();
    // $conn->close();
?>

<!-- UNSUCCESSFUL LOGIN WILL LOAD THIS PAGE -->
<!DOCTYPE html>
<html lang="en">
<head>
  <title>NovaTech - Your Ultimate Electronics Store</title>
  <meta charset="UTF-8">
  <link rel="stylesheet" href="../css/styles.css">
  <link rel="icon" type="image/x-icon" href="../images/favicon/favicon.ico">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <script type="text/javascript" src="../js/login.js"></script>
  <script type="text/javascript" src="../js/formvalidator.js"></script>
</head>

<body>
  <div id="container">
    <!-- START OF HEADER -->
    <div id="header">
        <div id="logo">
            <a href="../index.php"><img src="../images/logo.png"></a>
        </div>

        <div id="searchbar">
          <form action="../searchresult.php" method="post">
            <input type="text" name="searchterm" id="searchterm" placeholder="Find a product..." required>
            <button type="submit" id="searchbuttons">Search <i class="fa fa-search"></i></button>
          </form>
        </div>

        <div id="topright">			
			    <a href="../login.php"><button class="topbuttons" id="login-button">Login</button></a>
          <a href="../wishlist.php"><button class="topbuttons">Wishlist</button></a>
          <a href="../cart.php"><button class="topbuttons">Cart</button></a>
        </div>
    </div>
    <!-- END OF HEADER -->
    
    <div class = "Content_Wrapper">
    <!-- START OF NAVBAR -->
      <div id="navbar">
          <nav>
          <ul>
              <li><a href="../index.php">Home</a></li> | 
              <li><a href="../products.php">Products</a></li> |
              <li><a href="../aboutus.php">About Us</a></li> |
              <li><a href="../contact.php">Contact Us</a></li>
          </ul>
          </nav>
      </div>
    <!-- END OF NAVBAR -->
    
    <div class = "loginform-wrapper">
      <div class="loginform-container">
        <form action="auth_login.php" method="post" class="loginForm" id="loginForm">
          <h1>Member Login</h1>
          <input type="text" placeholder="Enter Email" name="loginemail" id="loginemail" required>
          <input type="password" placeholder="Enter Password" name="loginpassword" id="loginpassword" required>
          
          <p>No account yet? <a href="../register.php" id="signup">Click here to sign up!</a></p>
          <div id="error-message"><?php echo isset($errorMessage) ? $errorMessage : ''; ?></div>
          <button type="submit" class="btn">LOG IN</button>
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
              <li><a href="../index.php">Home</a></li>
              <li><a href="../products.php">Products</a></li>
              <li><a href="../aboutus.php">About Us</a></li>
              <li><a href="../contact.php">Contact Us</a></li>
            </ul>
          </nav>
        </div>
        <p>&copy; 2023 NovaTech Pte Ltd. All Rights Reserved.</p>
    </footer>
  </div>
  <!-- END OF FOOTER -->
  
	</script>
  <script src="../js/login.js"></script>
  </div>
</body>
</html>