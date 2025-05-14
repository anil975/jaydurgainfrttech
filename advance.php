<?php
include 'db.php';  // Include your database connection file

$message = ""; // Variable to hold success/error message

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $employee_name = $_POST['employee_name'];
    $advance_amount = $_POST['advance_amount'];
    $reason = $_POST['reason'];
    $date = date('Y-m-d');

    $sql_insert = "INSERT INTO advance_payments (employee_name, advance_amount, reason, date)
                   VALUES ('$employee_name', '$advance_amount', '$reason', '$date')";

    if ($conn->query($sql_insert) === TRUE) {
        $message = "Advance payment recorded successfully."; // Assign success message
    } else {
        $message = "Error: " . $sql_insert . "<br>" . $conn->error; // Assign error message
    }

    $conn->close(); // Close the database connection
}

// Employee names array
$employees = [
    "Ashish Kumar",
    "manu kumar",
    "amit",
    "Suresh Gupta",
    "Pooja Mehta",
    "Anil Joshi",
    "Ravi Verma",
    "Kavita Rao",
    "Vikram Patil",
    "Priya Sinha"
];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Record Advance Payment</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }
        header {
            background-color: #87CEEB;
            color: white;
            padding: 10px;
            text-align: center;
        }
        .container {
            flex: 1;
            width: 40%;
            margin: 20px auto;
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
        }
        footer {
            background-color: #87CEEB;
            color: white;
            text-align: center;
            padding: 10px;
            position: relative;
            bottom: 0;
            width: 100%;
        }
        form {
            display: flex;
            flex-direction: column;
        }
        label, select, input, button {
            margin: 10px 0;
        }
        select, input {
            padding: 10px;
            font-size: 16px;
        }
        button {
            padding: 10px;
            background-color: #87CEEB;
            border: none;
            color: white;
            cursor: pointer;
        }
        button:hover {
            background-color: #0096d1;
        }
        .message {
            margin: 10px 0;
            color: green; /* You can change this to red for error messages */
        }
    </style>
</head>
<body>

<header>
    <h1>Record Advance Payment</h1>
</header>

<div class="container">
    <form method="POST" action="">
        <label for="employee_name">Employee Name:</label>
        <select id="employee_name" name="employee_name" required>
            <option value="" disabled selected>Select Employee</option>
            <?php foreach ($employees as $employee): ?>
                <option value="<?php echo $employee; ?>"><?php echo $employee; ?></option>
            <?php endforeach; ?>
        </select>
        
        <label for="advance_amount">Advance Amount:</label>
        <input type="number" id="advance_amount" name="advance_amount" step="0.01" required>

        <label for="reason">Reason:</label>
        <input type="text" id="reason" name="reason" required>
        
        <button type="submit">Record Advance</button>
    </form>
     <button onclick="window.location.href='index_forman.php'">Back to Index</button>

    <!-- Display success/error message -->
    <?php if ($message): ?>
        <div class="message"><?php echo $message; ?></div>
    <?php endif; ?>
</div>

<footer>
    <p>&copy; 2024 Jay Durga Infratech Private Limited. All rights reserved.</p>
</footer>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
<script>
    $(document).ready(function() {
        $('#employee_name').select2();
    });
</script>

</body>
</html>
