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

        $loginpassword = md5($loginpassword); // Encrypt password entered

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
        }
        else
        {
            $errorMessage = "Incorrect Email or Password. Please try again.";
            // header("Location: ../index.php");
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

<!DOCTYPE html>
<html lang="en">
<head>
  <title>NovaTech - Your Ultimate Electronics Store</title>
  <meta charset="UTF-8">
  <link rel="stylesheet" href="../css/styles.css">
  <link rel="icon" type="image/x-icon" href="../images/favicon/favicon.ico">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <script type="text/javascript" src="../js/login.js"></script>
</head>

<body>
<div class="form-background" id="form-bg" style="display: block;">
		<div class="form-popup" id="loginForm" style="display: block;">
			<div id="close">
				<span id="close-button">×</span>
			</div>
			<form action="php/login.php" method="post" class="form-container">
				<h1>Member Login</h1>
                <div id="error-message" style="color: red;"><?php echo isset($errorMessage) ? $errorMessage : ''; ?></div>
				<input type="text" placeholder="Enter Email" name="loginemail" id="loginemail" required>
				<input type="password" placeholder="Enter Password" name="loginpassword" id="loginpassword" required>
			
				<p>No account yet? <a href="register.html" id="signup">Click here to sign up!</a></p>
			
				<button type="submit" class="btn">LOG IN</button>
			</form>
		</div>
	</div>