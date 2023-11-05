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

    // Retrieve data from the form
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
    }

    // Close the database connection
    $stmt->close();
    $conn->close();
?>
