<?php
session_start(); // Start the session to store the scroll position

$servername = "localhost";
$username = "jwongso001";
$password = "jwongso001";
$dbname = "Novatech";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


$conn->close();
?>

