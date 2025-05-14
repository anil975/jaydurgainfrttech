<?php
include 'db.php'; // Include your database connection file

// Initialize variables
$selected_month = date('m'); // Default month to current month
$selected_year = date('Y'); // Default year to current year
$employees_data = []; // Array to hold employee salary data

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $selected_month = $_POST['month'];
    $selected_year = $_POST['year'];

    // Fetching salary details for all employees, including salary
    $sql = "SELECT e.employee_name, e.salary,
                   (SELECT COUNT(*) FROM attendance WHERE employee_name = e.employee_name AND MONTH(date) = $selected_month AND YEAR(date) = $selected_year AND status = 'Present') AS present_days,
                   (SELECT COUNT(*) FROM half_day_attendance WHERE employee_name = e.employee_name AND MONTH(date) = $selected_month AND YEAR(date) = $selected_year) AS half_days,
                   (SELECT SUM(hours_worked) FROM overtime WHERE employee_name = e.employee_name AND MONTH(date) = $selected_month AND YEAR(date) = $selected_year) AS total_overtime_hours,
                   
            FROM employees e"; // Assuming you have an 'employees' table

    $result = $conn->query($sql);

    if ($result) {
        while ($row = $result->fetch_assoc()) {
            $salary = $row['salary'] ?? 0; // Salary per month
            $present_days = $row['present_days'] ?? 0;
            $half_days = $row['half_days'] ?? 0;
            $total_overtime_hours = $row['total_overtime_hours'] ?? 0;

            $overtime_days = $total_overtime_hours / 8; // Assuming 8 hours is a full overtime day
            $total_days_worked = $present_days + $overtime_days - $half_days * 0.5; // Adjusting for half days
            $total_salary = $total_days_worked * $salary; // Assuming monthly salary is divided by 30 for daily calculation
            $total_half_day_deduction = $half_days * (500); // Calculate deduction for half days
            $final_salary = $total_salary - $total_half_day_deduction; // Calculate final salary

            $employees_data[] = [
                'employee_name' => $row['employee_name'],
                'salary' => $salary,
                'present_days' => $present_days,
                'half_days' => $half_days,
                'overtime_days' => round($overtime_days, 2),
                'total_salary' => number_format($total_salary, 2),
                'final_salary' => number_format($final_salary, 2),
            ];
        }
    }
}

$conn->close(); // Close the database connection
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Salary Details</title>
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
            width: 80%;
            margin: 20px auto;
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #87CEEB;
            color: white;
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
    </style>
</head>
<body>

<header>
    <h1>Employee Salary Details</h1>
</header>

<div class="container">
    <h2>Select Month and Year</h2>
    
    <form method="post">
        <label for="month">Select Month:</label>
        <select name="month" id="month" required>
            <option value="01" <?php echo $selected_month == '01' ? 'selected' : ''; ?>>January</option>
            <option value="02" <?php echo $selected_month == '02' ? 'selected' : ''; ?>>February</option>
            <option value="03" <?php echo $selected_month == '03' ? 'selected' : ''; ?>>March</option>
            <option value="04" <?php echo $selected_month == '04' ? 'selected' : ''; ?>>April</option>
            <option value="05" <?php echo $selected_month == '05' ? 'selected' : ''; ?>>May</option>
            <option value="06" <?php echo $selected_month == '06' ? 'selected' : ''; ?>>June</option>
            <option value="07" <?php echo $selected_month == '07' ? 'selected' : ''; ?>>July</option>
            <option value="08" <?php echo $selected_month == '08' ? 'selected' : ''; ?>>August</option>
            <option value="09" <?php echo $selected_month == '09' ? 'selected' : ''; ?>>September</option>
            <option value="10" <?php echo $selected_month == '10' ? 'selected' : ''; ?>>October</option>
            <option value="11" <?php echo $selected_month == '11' ? 'selected' : ''; ?>>November</option>
            <option value="12" <?php echo $selected_month == '12' ? 'selected' : ''; ?>>December</option>
        </select>
        
        <label for="year">Select Year:</label>
        <select name="year" id="year" required>
            <?php 
                for ($year = date('Y'); $year >= 2000; $year--) {
                    echo "<option value='$year' " . ($selected_year == $year ? 'selected' : '') . ">$year</option>";
                }
            ?>
        </select>
        
        <button type="submit">View Salaries</button>
    </form>

    <?php if (!empty($employees_data)) : ?>
    <table>
        <thead>
            <tr>
                <th>Employee Name</th>
                <th>Present Days</th>
                <th>Half Days</th>
                <th>Overtime Days</th>
                
                <th>Monthly Salary</th>
                <th>Total Salary</th>
                <th>advance amount</th>
                <th>Final Salary</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($employees_data as $employee) : ?>
            <tr>
                <td><?php echo htmlspecialchars($employee['employee_name']); ?></td>
                <td><?php echo htmlspecialchars($employee['present_days']); ?></td>
                <td><?php echo htmlspecialchars($employee['half_days']); ?></td>
                <td><?php echo htmlspecialchars($employee['overtime_days']); ?></td>
                

                <td>₹<?php echo htmlspecialchars($employee['salary']); ?></td>
                <td>₹<?php echo htmlspecialchars($employee['total_salary']); ?></td>
                <td><?php echo htmlspecialchars($employee['overtime_days']); ?></td>
                <td>₹<?php echo htmlspecialchars($employee['final_salary']); ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <?php endif; ?>
</div>

<footer>
    <p>&copy; 2024 Jay Durga Infratech Private Limited. All rights reserved.</p>
</footer>

</body>
</html>
