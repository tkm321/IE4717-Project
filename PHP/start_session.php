
<?php 

$servername = "localhost";
$username = "jwongso001";
$password = "jwongso001";
$dbname = "Novatech";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$loginemail = $_POST['loginemail'];
$loginpassword = $_POST['loginpassword'];

// Retrieve member_name based on the member email
$sql = "SELECT member_name FROM members WHERE member_email='$enteredemail'";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
$member_name = $row['member_name'];

Session_start();

if (isset($_SESSION['loginemail']) && isset($SESSION['loginpassword']))
{
	echo 'Welcome, '.$_SESSION['loginemail'];
}
else
{ echo 'Please login';
}

?>