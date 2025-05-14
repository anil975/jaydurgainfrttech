<?php
$servername = "localhost"; // Change if necessary
$username = "root"; // Change if necessary
$password = "root"; // Change if necessary
$dbname = "employee_db";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
