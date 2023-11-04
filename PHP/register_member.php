<?php

$servername = "localhost";
$username = "jwongso001";
$password = "jwongso001";
$dbname = "Novatech";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$member_name = $_POST['name'];
$member_email = $_POST['email'];
$member_contact = $_POST['contact'];
$member_password = $_POST['password'];

$member_password = md5($member_password);

$sql = "INSERT INTO `members` (`member_name`, `member_email`, `member_contact`, `member_password`) VALUES ('$member_name','$member_email','$member_contact','$member_password')";
$conn->query($sql);

$conn->close();
header("Location: ../index.html");
?>