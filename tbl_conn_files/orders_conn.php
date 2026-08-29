<?php
$dbServername = "localhost";
$dbUsername = "root";
$dbPassword = "";
$dbName = "ctg_inven_db";

/* Attempt to connect to MySQL database */
$conn = new mysqli($dbServername, $dbUsername, $dbPassword, $dbName);

// Check connection 
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
?>
