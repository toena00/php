<?php
$servername = "localhost";
$username = "root";  // Your DB user
$password = "";      // Your DB password
$dbname = "dbtoena"; // Your DB name

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>