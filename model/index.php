<?php
require_once '../controller/attempt_login.php'; // Adjust the file path accordingly
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
   <link rel="stylesheet" type="text/css" href="../view/index.css">
   <style>
    /* Reset some default styles */
    body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f0f0f0; /* Light gray background */
        }

        /* Card Styles */
        .dashboard {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-around;
            align-content: center;
            padding-top: 20px;
            margin-top: 50px;
        }

        .card {
            align-content: center;
            place-content: center;
            flex-basis: 35%; /* Adjust the width of the cards */
            padding: 20px;
            background: white; /* White background color */
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            text-align: center;
            transition: transform 0.2s; /* Add hover animation */
            margin-bottom: 20px;
        }

        .card:hover {
            transform: scale(1.05); /* Enlarge the card on hover */
        }

        .card h2 {
            font-size: 1.25rem;
            color: #333;
            font-weight: 500;
        }

        .view-button {
            display: inline-block;
            background-color: #133054; /* Custom color */
            color: white;
            padding: 10px 20px;
            border-radius: 4px;
            text-decoration: none;
            transition: background-color 0.3s;
        }

        .view-button:hover {
            background-color: #0e2c46; /* Darker color on hover */
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            color: #f9c013;
            background-color: #133054;
            padding: 10px;
        }
</style>
</head>
<body>
    <?php
    include('sidebar.php');
    ?>

    <div class="content">
        <div class="header">
            <h1>FINETECH</h1>
            <div class="search-bar">
                <!-- Add your search bar here -->
            </div>
        </div>

        <div class="dashboard">
            <div class="card students-card" style="padding:80px;">
                <h2>Total Students</h2>
                <?php
                // Database connection
                $host = 'localhost';
                $username = 'root';
                $password = '';
                $database = 'finetech';
                $conn = mysqli_connect($host, $username, $password, $database);

                if (!$conn) {
                    die("Connection failed: " . mysqli_connect_error());
                }

                // Fetch and display the total number of students
                $studentsQuery = "SELECT COUNT(*) as totalStudents FROM students";
                $result = mysqli_query($conn, $studentsQuery);
                $row = mysqli_fetch_assoc($result);
                $totalStudents = $row['totalStudents'];
                echo "<p>Total: $totalStudents Students</p>";

                // Close the database connection
                mysqli_close($conn);
                ?>
                <a href="students.php" class="view-button">View Students</a>
            </div>
<div class="sch">
            <?php
            include('student_chart.php');
            ?>
</div>
<div class="ech">

            <?php
            include('employee_chart.php');
            ?>
</div>
            <div class="card employees-card"  style="padding:80px;">
                <h2>Total Employees</h2>
                <?php
                // Database connection
                $host = 'localhost';
                $username = 'root';
                $password = '';
                $database = 'finetech';
                $conn = mysqli_connect($host, $username, $password, $database);

                if (!$conn) {
                    die("Connection failed: " . mysqli_connect_error());
                }

                // Fetch and display the total number of employees
                $employeesQuery = "SELECT COUNT(*) as totalEmployees FROM employees";
                $result = mysqli_query($conn, $employeesQuery);
                $row = mysqli_fetch_assoc($result);
                $totalEmployees = $row['totalEmployees'];
                echo "<p>Total: $totalEmployees Employees</p>";

                // Close the database connection
                mysqli_close($conn);
                ?>
                <a href="employee.php" class="view-button">View Employees</a>
            </div>

            <!-- Second Row -->
            <div class="card courses-card " style="padding:80px;">
                <h2>Total Courses</h2>
                <?php
                // Database connection
                $host = 'localhost';
                $username = 'root';
                $password = '';
                $database = 'finetech';
                $conn = mysqli_connect($host, $username, $password, $database);

                if (!$conn) {
                    die("Connection failed: " . mysqli_connect_error());
                }

                // Fetch and display the total number of courses
                $coursesQuery = "SELECT COUNT(*) as totalCourses FROM courses";
                $result = mysqli_query($conn, $coursesQuery);
                $row = mysqli_fetch_assoc($result);
                $totalCourses = $row['totalCourses'];
                echo "<p>Total: $totalCourses Courses</p>";

                // Close the database connection
                mysqli_close($conn);
                ?>
                <a href="courses.php" class="view-button">View Courses</a>
            </div>

            <div class="card projects-card" style="padding:80px;">
                <h2>Total Projects</h2>
                <?php
                // Database connection
                $host = 'localhost';
                $username = 'root';
                $password = '';
                $database = 'finetech';
                $conn = mysqli_connect($host, $username, $password, $database);

                if (!$conn) {
                    die("Connection failed: " . mysqli_connect_error());
                }

                // Fetch and display the total number of projects
                $projectsQuery = "SELECT COUNT(*) as totalProjects FROM projects";
                $result = mysqli_query($conn, $projectsQuery);
                $row = mysqli_fetch_assoc($result);
                $totalProjects = $row['totalProjects'];
                echo "<p>Total: $totalProjects Projects</p>";

                // Close the database connection
                mysqli_close($conn);
                ?>
                <a href="projects.php" class="view-button">View Projects</a>
            </div>

            <!-- Third Row -->
            <div class="card fees-card" style="padding:80px;">
                <h2>Fees Information</h2>
                <?php
                // Database connection
                $host = 'localhost';
                $username = 'root';
                $password = '';
                $database = 'finetech';
                $conn = mysqli_connect($host, $username, $password, $database);

                if (!$conn) {
                    die("Connection failed: " . mysqli_connect_error());
                }

                // Fetch and display fees information
                $feesQuery = "SELECT SUM(fees) as totalFees, SUM(paid) as totalPaid, SUM(fees - paid) as remainingFees FROM students";
                $result = mysqli_query($conn, $feesQuery);
                $row = mysqli_fetch_assoc($result);
                $totalFees = $row['totalFees'];
                $totalPaid = $row['totalPaid'];
                $remainingFees = $row['remainingFees'];
                echo "<p>Total Fees: $totalFees</p>";
                echo "<p>Total Paid: $totalPaid</p>";
                echo "<p>Remaining Fees: $remainingFees</p>";

                // Close the database connection
                mysqli_close($conn);
                ?>
                <a href="student_fees.php" class="view-button">View Students Fees</a>
            </div>

            <?php
            include('fees_chart.php');
            ?>

        </div>
    </div>
</body>
</html>
