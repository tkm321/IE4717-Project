<?php
// to prevent bypasssing of form submit action
if(!isset($_SERVER['HTTP_REFERER'])){
    // redirect to desired location
    header('location:../review.php');
    exit;
}
session_start();

$servername = "localhost";
$username = "jwongso001";
$password = "jwongso001";
$dbname = "Novatech";

$conn = new mysqli($servername, $username, $password, $dbname);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Check if the user is logged in
if (isset($_SESSION['valid_user'])) {
    $valid_user = $_SESSION['valid_user'];

    // Retrieve the member_id from the session
    if (isset($_SESSION['member_id'])) {
        $member_id = $_SESSION['member_id'];
    } else {
        // Retrieve the member_id from the database based on the member_email (assuming member_email is unique)
        $memberEmail = $valid_user;
        $memberIdStmt = $conn->prepare("SELECT member_id FROM members WHERE member_email = ?");
        $memberIdStmt->bind_param("s", $memberEmail);
        $memberIdStmt->execute();
        $memberIdStmt->bind_result($member_id);
        $memberIdStmt->fetch();
        $memberIdStmt->close();

        // Store member_id in the session for future use
        $_SESSION['member_id'] = $member_id;
    }

    if (isset($_POST['product_id'])) {
        $product_id = $_POST['product_id'];
        // Retrieve other form fields (name, email, message, rating) here
        $name = $_POST['name'];
        $email = $_POST['email'];
        $message = $_POST['message'];
        $rating = $_POST['rating'];
		// Check if the user has already reviewed the product
		$checkReviewStmt = $conn->prepare("SELECT review_id FROM reviews_ind WHERE member_id = ? AND product_id = ?");
        $checkReviewStmt->bind_param("ii", $member_id, $product_id);
        $checkReviewStmt->execute();
        $checkReviewStmt->store_result();
		
		if ($checkReviewStmt->num_rows > 0) {
            // User has already reviewed this product
            echo "You have already reviewed this product.<br>";
        } else {
			// Then insert the review data into the reviews_ind table
			$insertReviewStmt = $conn->prepare("INSERT INTO reviews_ind (product_id, member_id, reviews_name, reviews_email, reviews_message, reviews_rating) VALUES (?, ?, ?, ?, ?, ?)");
			$insertReviewStmt->bind_param("iisssi", $product_id, $member_id, $name, $email, $message, $rating);

			if ($insertReviewStmt->execute()) {
				// Update the reviews table
				$updateReviewsStmt = $conn->prepare("UPDATE reviews SET reviews_total = (SELECT SUM(reviews_rating) FROM reviews_ind WHERE product_id = ?), reviews_qty = (SELECT COUNT(*) FROM reviews_ind WHERE product_id = ?) WHERE product_id = ?");
				$updateReviewsStmt->bind_param("iii", $product_id, $product_id, $product_id);
				$updateReviewsStmt->execute();
				$updateReviewsStmt->close();

				// Redirect to a success page or the original product page
				echo "Review added!<br>";
				
			} else {
				// Handle errors during the review insertion
				echo "Error inserting review.<br>";
			}
			$insertReviewStmt->close();
		}
		$checkReviewStmt->close();
	}	
	else {
        // Handle errors or invalid data
        // Redirect to an error page or the original product page
        echo "Error 404<br>";
    }
} else {
    // Handle cases where the user is not logged in
    // You can redirect to a login page or display an error message
    echo "Error 404<br>";
}

echo "Going back to Item Page in 5 seconds...<br>";
echo "Click <a href='../item.php?product_id=$product_id'>here</a> to go back directly.";
header("refresh:5; url=../item.php?product_id=$product_id");
?>