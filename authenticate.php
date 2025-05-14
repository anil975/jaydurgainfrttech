<?php
session_start();

// Replace these with your actual username and password
$valid_username = 'admin';  // example username
$valid_password = 'password'; // example password

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Check if the username and password are correct
    if ($username === $valid_username && $password === $valid_password) {
        $_SESSION['loggedin'] = true;
        header("Location: index_owner.php"); // Redirect to the owner page
        exit;
    } else {
        echo "Invalid username or password.";
    }
}
?>
