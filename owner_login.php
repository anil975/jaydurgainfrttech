<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - ABC Construction</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            height: 100vh;
        }
        header {
            background-color: #87CEEB; /* Sky blue color */
            color: white;
            padding: 20px 0;
            text-align: center;
        }
        footer {
            background-color: #87CEEB; /* Sky blue color */
            color: white;
            text-align: center;
            padding: 10px 0;
            position: relative;
            bottom: 0;
        }
        .form-container {
            flex: 1;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        form {
            border: 1px solid #ccc;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 300px; /* Set a fixed width for the form */
        }
        input[type="text"], input[type="password"] {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        input[type="submit"] {
            background-color: #87CEEB;
            color: white;
            border: none;
            padding: 10px;
            cursor: pointer;
            border-radius: 5px;
            width: 100%;
        }
        input[type="submit"]:hover {
            background-color: #ADD8E6;
        }
    </style>
</head>
<body>

<header>
    <h1>Jay Durga Infratech Private Limited</h1>
</header>

<div class="form-container">
    <form action="authenticate.php" method="POST">
        <h2>Login</h2>
        <input type="text" name="username" placeholder="Username" required>
        <input type="password" name="password" placeholder="Password" required>
        <input type="submit" value="Login">
    </form>
</div>

<footer>
    <p>&copy; 2024 Jay Durga Infratech Private Limited. All rights reserved.</p>
</footer>

</body>
</html>
