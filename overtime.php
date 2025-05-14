<?php
include 'db.php'; // Include your database connection file

$employees = [
    "pramod", "vindesari", "rajendra bhagat", "manu kumar", "Ashish Kumar",
    "mantu kumar", "santosh", "brijesh", "harikesh", "rajkumar","viruram","sanjay","babujan","amit","visarath","vijay"
];


$message = ""; // Variable to hold success/error messages

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $employee_name = $_POST['employee_name'];
    $date = $_POST['date'];
    $hours_worked = $_POST['hours_worked'];
    $reason = $_POST['reason'];

    $sql = "INSERT INTO overtime (employee_name, date, hours_worked, reason) VALUES ('$employee_name', '$date', '$hours_worked', '$reason')";

    if ($conn->query($sql) === TRUE) {
        $message = "Overtime record created successfully"; // Success message
    } else {
        $message = "Error: " . $sql . "<br>" . $conn->error; // Error message
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Overtime Form</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            background-color: #f0f0f0;
        }
        header {
            background-color: #87CEEB; /* Sky blue color */
            color: #fff;
            padding: 10px 0; /* Further reduced padding */
            text-align: center;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1); /* Shadow effect for depth */
        }
        footer {
            background-color: #87CEEB; /* Sky blue color */
            color: #fff;
            text-align: center;
            padding: 8px 0; /* Reduced padding */
            position: relative;
            bottom: 0;
            width: 100%;
            margin-top: 20px; /* Space above footer */
        }
        .container {
            width: 40%; /* Adjusted width for smaller form size */
            margin: 20px auto; /* Centered with margin */
            background-color: white;
            padding: 10px; /* Further reduced padding */
            border-radius: 8px; /* Rounded corners */
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1); /* Deeper shadow for depth */
        }
        .message {
            color: green; /* Change color based on success or error */
            font-weight: bold;
            margin: 10px 0; /* Space around the message */
            text-align: center; /* Center the message */
        }
        input[type="text"], input[type="date"], input[type="number"], select {
            width: calc(100% - 22px); /* Account for padding */
            padding: 8px; /* Reduced padding for height */
            margin: 6px 0; /* Reduced margin */
            border: 1px solid #ccc;
            border-radius: 5px; /* Slightly rounded borders */
            font-size: 14px; /* Smaller font size for reduced height */
        }
        input[type="submit"], button {
            padding: 8px 12px; /* Consistent padding */
            background-color: #87CEEB; /* Sky blue color */
            border: none;
            color: white;
            cursor: pointer;
            display: block; /* Center alignment */
            margin: 12px auto; /* Center alignment */
            font-size: 14px; /* Consistent smaller font size */
            border-radius: 5px; /* Rounded corners */
            transition: background-color 0.3s; /* Smooth color transition */
        }
        input[type="submit"]:hover, button:hover {
            background-color: #ADD8E6; /* Light sky blue on hover */
        }
        .search-container {
            position: relative;
        }
        .search-input {
            width: 100%;
            padding: 8px; /* Further reduced padding for height */
            border: 1px solid #ccc;
            border-radius: 5px; /* Rounded corners */
            font-size: 14px; /* Smaller font size */
        }
        .dropdown {
            position: absolute;
            top: 40px; /* Adjust according to your layout */
            left: 0;
            right: 0;
            z-index: 1000;
            background-color: white;
            border: 1px solid #ccc;
            max-height: 150px; /* Limit height */
            overflow-y: auto; /* Scroll if needed */
            display: none; /* Initially hidden */
            border-radius: 5px; /* Rounded corners */
        }
        .dropdown div {
            padding: 8px; /* Reduced padding */
            cursor: pointer;
            font-size: 14px; /* Consistent smaller font size */
        }
        .dropdown div:hover {
            background-color: #87CEEB; /* Highlight on hover */
            color: white; /* Change text color on hover */
        }
        table {
            width: 100%;
            margin-top: 15px; /* Space above table */
            border-collapse: collapse; /* Combine borders */
        }
        th, td {
            padding: 8px; /* Reduced padding */
            text-align: left;
            border: 1px solid #ddd; /* Light border for table */
        }
        th {
            background-color: #87CEEB; /* Header background color */
            color: white; /* Header text color */
        }
    </style>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const searchInput = document.getElementById("employee_search");
            const dropdown = document.getElementById("employee_dropdown");
            const employees = <?php echo json_encode($employees); ?>;

            searchInput.addEventListener("input", function() {
                const filter = this.value.toLowerCase();
                dropdown.innerHTML = "";
                const filteredEmployees = employees.filter(employee => employee.toLowerCase().includes(filter));
                
                filteredEmployees.forEach(employee => {
                    const div = document.createElement("div");
                    div.textContent = employee;
                    div.onclick = function() {
                        searchInput.value = employee;
                        dropdown.style.display = "none";
                        document.getElementById("employee_name").value = employee; // Set hidden input
                    };
                    dropdown.appendChild(div);
                });

                dropdown.style.display = filteredEmployees.length > 0 ? "block" : "none";
            });

            searchInput.addEventListener("focus", function() {
                dropdown.style.display = this.value ? "block" : "none";
            });

            document.addEventListener("click", function(event) {
                if (!searchInput.contains(event.target) && !dropdown.contains(event.target)) {
                    dropdown.style.display = "none";
                }
            });
        });
    </script>
</head>
<body>

<header>
    <h1>Jay Durga Infratech Private Limited</h1>
</header>

<div class="container">
    <h2>Overtime Form</h2>
    
    <form method="POST" action="overtime.php">
        <div class="search-container">
            <input type="text" id="employee_search" class="search-input" placeholder="Search Employee..." required>
            <div id="employee_dropdown" class="dropdown"></div>
        </div>
        <input type="hidden" id="employee_name" name="employee_name">
        
        <table>
            <tr>
                <th>Field</th>
                <th>Input</th>
            </tr>
            <tr>
                <td>Date:</td>
                <td><input type="date" id="date" name="date" required></td>
            </tr>
            <tr>
                <td>Hours Worked:</td>
                <td><input type="number" step="1" id="hours_worked" name="hours_worked" required></td>
            </tr>
            <tr>
                <td>Reason:</td>
                <td><input type="text" id="reason" name="reason" required></td>
            </tr>
        </table>

        <?php if (!empty($message)): ?>
            <div class="message"><?php echo $message; ?></div>
        <?php endif; ?>
        
        <input type="submit" value="Submit">
    </form>
    
    <button onclick="window.location.href='http://localhost:8888/Jay%20Durga%20Infratech/index_forman.php'">Back to Index</button>
</div>

<footer>
    <p>&copy; 2024 Jay Durga Infratech Private Limited. All rights reserved.</p>
</footer>

</body>
</html>

<?php
$conn->close(); // Close the database connection
?>
