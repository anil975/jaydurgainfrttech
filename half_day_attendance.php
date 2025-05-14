<?php
include 'db.php';

$employees = [
    "Virendra Pratap Singh", "Sunil Kumar Maurya", "panelal", "Vijay Kumar", "Ashish Kumar",
    "Bisarakh sekh", "Pavan Kumar Singh", "deepchandra", "Arvind", "Anil kumar Gupta"
];

$message = ""; // Variable to hold success/error messages

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $employee_name = $_POST['employee_name'];
    $date = $_POST['date'];
    $status = $_POST['status'];
    $time_in = $_POST['time_in']; // Get the time in value

    $sql = "INSERT INTO half_day_attendance (employee_name, date, status, time_in) VALUES ('$employee_name', '$date', '$status', '$time_in')";

    if ($conn->query($sql) === TRUE) {
        $message = "New record created successfully"; // Success message
    } else {
        $message = "Error: " . $sql . "<br>" . $conn->error; // Error message
    }

    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Half-Day Attendance Form</title>
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
            padding: 10px 0;
            text-align: center;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }
        footer {
            background-color: #87CEEB;
            color: #fff;
            text-align: center;
            padding: 8px 0;
            position: relative;
            bottom: 0;
            width: 100%;
            margin-top: 20px;
        }
        .container {
            width: 40%;
            margin: 20px auto;
            background-color: white;
            padding: 10px;
            border-radius: 8px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
        }
        .message {
            color: green;
            font-weight: bold;
            margin: 10px 0;
            text-align: center;
        }
        input[type="text"], input[type="date"], select {
            width: calc(100% - 22px);
            padding: 8px;
            margin: 6px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 14px;
        }
        select {
            height: 35px;
        }
        input[type="submit"], button {
            padding: 8px 12px;
            background-color: #87CEEB;
            border: none;
            color: white;
            cursor: pointer;
            display: block;
            margin: 12px auto;
            font-size: 14px;
            border-radius: 5px;
            transition: background-color 0.3s;
        }
        input[type="submit"]:hover, button:hover {
            background-color: #ADD8E6;
        }
        .search-container {
            position: relative;
        }
        .search-input {
            width: 100%;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 14px;
        }
        .dropdown {
            position: absolute;
            top: 40px;
            left: 0;
            right: 0;
            z-index: 1000;
            background-color: white;
            border: 1px solid #ccc;
            max-height: 150px;
            overflow-y: auto;
            display: none;
            border-radius: 5px;
        }
        .dropdown div {
            padding: 8px;
            cursor: pointer;
            font-size: 14px;
        }
        .dropdown div:hover {
            background-color: #87CEEB;
            color: white;
        }
        table {
            width: 100%;
            margin-top: 15px;
            border-collapse: collapse;
        }
        th, td {
            padding: 8px;
            text-align: left;
            border: 1px solid #ddd;
        }
        th {
            background-color: #87CEEB;
            color: white;
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
    <h2>Half-Day Attendance Form</h2>
    
    <form method="POST" action="half_day_attendance.php">
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
                <td>Status:</td>
                <td>
                    <select id="status" name="status" required>
                        <option value="Present">Present</option>
                        <option value="Absent">Half day</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td>Time In:</td>
                <td><input type="text" id="time_in" name="time_in" value="<?php echo date('H:i', time() + 5 * 3600 + 30 * 60); ?>" readonly></td>
            </tr>
        </table>

        <?php if (!empty($message)): ?>
            <div class="message"><?php echo $message; ?></div>
        <?php endif; ?>
        
        <input type="submit" value="Submit">
    </form>
    
    <button onclick="window.location.href='index_forman.php'">Back to Index</button>
</div>

<footer>
    <p>&copy; 2024 Jay Durga Infratech Private Limited. All rights reserved.</p>
</footer>

</body>
</html>
