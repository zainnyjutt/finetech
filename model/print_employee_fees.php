<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Student Fee Details</title>

    <!-- Add your styles here -->
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            background-color: #f2f2f2;
        }

        .content1 {
            max-width: 600px;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h3 {
            color: #133054;
            border-bottom: 1px solid #ccc;
            padding-bottom: 10px;
        }

        p {
            margin-bottom: 10px;
        }

        /* Hide sidebar when printing */
        @media print {
            .sidebar {
                display: none;
            }
        }

        /* Add print button styles */
        button {
            margin-top: 20px;
            padding: 10px;
            background-color: #133054;
            color: #fff;
            cursor: pointer;
            border: none;
            border-radius: 5px;
            transition: background-color 0.3s;
        }

        button:hover {
            background-color: #007bff;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            color: #f9c013;
            background-color: #133054;
            padding: 10px;
            border-radius: 10px 10px 0 0;
        }

        .header h1 {
            margin: 0;
        }
    </style>
</head>
<body>

<?php
    include('sidebar.php');
?>

<div class="content1">
    <div class="header">
        <h1>EMPLOYEE SALARY DETAILS</h1>
    </div>

<?php
// fetch_student_details.php

$host = 'localhost';
$username = 'root';
$password = '';
$database = 'finetech';

$conn = mysqli_connect($host, $username, $password, $database);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if (isset($_GET['id'])) {
    $studentId = $_GET['id'];

    // Use prepared statement to avoid SQL injection
    $sql = "SELECT * FROM employees WHERE id = ?";
    $stmt = mysqli_prepare($conn, $sql);

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "i", $studentId);
        mysqli_stmt_execute($stmt);

        $result = mysqli_stmt_get_result($stmt);

        if ($result) {
            // Check if any rows were returned
            if (mysqli_num_rows($result) > 0) {
                $row = mysqli_fetch_assoc($result);

                // Format the student details as HTML
                $html = "
                    <h3>Student Details</h3>
                    <p><strong>Name:</strong> {$row['name']}</p>
                    <p><strong>Course:</strong> {$row['department']}</p>
                    <p><strong>Mobile Number:</strong> {$row['contact']}</p>
                    <p><strong>CNIC:</strong> {$row['cnic']}</p>
                    <p><strong>Total Salary:</strong> {$row['salary']}</p>
                    <p><strong>Paid Salary:</strong> {$row['paid']}</p>
                    <p><strong>Remaining Salary:</strong> " . ($row['salary'] - $row['paid']) . "</p>
                ";

                echo $html;

                // Add a button to print the page
                echo "<button onclick='window.print()'>Print</button>";
            } else {
                echo "No Employee found with the provided ID.";
            }
        } else {
            // Display the SQL error if the query fails
            echo "Error executing the query: " . mysqli_error($conn);
        }

        mysqli_stmt_close($stmt);
    } else {
        echo "Error preparing the statement: " . mysqli_error($conn);
    }
} else {
    echo "Employee ID not provided.";
}

mysqli_close($conn);
?>

</div>

</body>
</html>
