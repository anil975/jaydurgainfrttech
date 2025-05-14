<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: login.php"); // Redirect to login page
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ABC Construction</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        header {
            background-color: #87CEEB; /* Sky blue color */
            color: #fff;
            padding: 20px 0;
            text-align: center;
        }
        nav {
            display: flex;
            justify-content: center;
            background-color: #87CEEB; /* Sky blue color */
        }
        nav a {
            color: white;
            padding: 15px 20px;
            text-decoration: none;
        }
        nav a:hover {
            background-color: #ADD8E6; /* Light sky blue */
        }
        .hero {
            background: url('photos/bg.jpg') no-repeat center center/cover;
            height: 400px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            text-align: center;
        }
        .hero h1 {
            font-size: 3em;
            margin: 0;
            background-color: rgba(0, 0, 0, 0.5); /* Semi-transparent background for better readability */
            padding: 10px;
            border-radius: 10px;
        }
        .content {
            padding: 20px;
        }
        .content h2 {
            text-align: center;
            margin-top: 0;
        }
        .services, .contact {
            display: flex;
            justify-content: space-around;
            margin: 20px 0;
        }
        .services div, .contact div {
            width: 30%;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        footer {
            background-color: #87CEEB; /* Sky blue color */
            color: #fff;
            text-align: center;
            padding: 10px 0;
            position: fixed;
            width: 100%;
            bottom: 0;
        }
        .logout {
            position: absolute; /* Absolute positioning */
            top: 20px; /* Adjust as needed */
            right: 20px; /* Adjust as needed */
            color: white;
            text-decoration: none;
            font-size: 16px; /* Adjust font size as needed */
        }
    </style>
</head>
<body>

<header>
    <h1>Jay Durga Infratech Private Limited</h1>
    <a class="logout" href="index.php">Logout</a> <!-- Logout link -->
</header>

<nav>
    
    <a href="half_day_attendance.php">Half day Attendance</a>
    <a href="advance.php">Advance Payment</a>
    <a href="Empoloyee_Data/empoloyee_data.php">Empoloyee Detail</a>
    <a href="overtime.php">Overtime</a>
    <a href="attendance.php">Attendance</a>
    <a href="material%20data/main.php">Stock Update</a>

    

</nav>

<div class="hero">
    <h1>Building Your Dreams</h1>
</div>

<div class="content">
    <h2>Welcome to Jay Durga Infratech Private Limited</h2>
    <p>At Jay Durga Infratech Private Limited, we specialize in creating stunning and robust structures that stand the test of time. Our team of dedicated professionals works tirelessly to ensure every project meets our high standards of quality and excellence. From residential homes to commercial buildings, we have the expertise to handle all your construction needs.</p>

    <div class="services">
        <div>
            <h3>Residential Construction</h3>
            <p>We build homes that are not just structures, but also reflections of your personality and lifestyle.</p>
        </div>
        <div>
            <h3>Commercial Construction</h3>
            <p>Our commercial projects are designed to provide functionality and aesthetics to enhance your business operations.</p>
        </div>
        <div>
            <h3>Renovation Services</h3>
            <p>Whether it's a small remodel or a complete overhaul, we bring new life to your existing spaces.</p>
        </div>
    </div>

    <div class="contact">
        <div>
            <h3>Contact Us</h3>
            <p>Email: info@abcconstruction.com</p>
            <p>Phone: +1 (555) 123-4567</p>
            <p>Address: 123 Construction Lane, Buildtown, BT 12345</p>
        </div>
    </div>
</div>

<footer>
    <p>&copy; 2024 Jay Durga Infratech Private Limited. All rights reserved.</p>
</footer>

</body>
</html>
