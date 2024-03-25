
<?php
require_once '../controller/attempt_login.php'; // Adjust the file path accordingly
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fine Tech</title>
    <link rel="stylesheet" href="../view/sidebar.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

</head>
<body>
<?php
$conn = mysqli_connect("localhost", "root", "", "finetech");
echo $_SESSION['email'];

$query = mysqli_prepare($conn, "SELECT * FROM userdata WHERE email = ?");
mysqli_stmt_bind_param($query, "s", $_SESSION['email']);
mysqli_stmt_execute($query);
$result = mysqli_stmt_get_result($query);

while ($row = mysqli_fetch_array($result)) {
    $role = $row['role'];
}

if ($role == 'Admin') {
    ?>
    <div class="sidebar">
       <div class="logo">
            <h2 style="color:#f9c013;">FineTech</h2>
        </div>
        <ul class="menu">

            <li class="menu-item">
                <a href="index.php"><i class="fas fa-chart-line"></i> Dashboard</a>
            </li>
            
            <li class="menu-item">
                <a href="students.php"><i class="fas fa-users"></i> Students</a>
            </li>
            <li class="menu-item with-dropdown"> 
                <a href="student_attendence.php"><i class="far fa-calendar-alt"></i> Student Attendance</a>
            </li>
            <li class="menu-item">
                <a href="employee.php"><i class="fas fa-user-tie"></i> Employees</a>
            </li>
            <li class="menu-item with-dropdown">
                <a href="employee_attendence.php"><i class="far fa-calendar-alt"></i> Employ Attendance</a>
            </li>
            <li class="menu-item">
                <a href="courses.php"><i class="fas fa-graduation-cap"></i> Courses</a>
            </li>
            <li class="menu-item">
                <a href="campuses.php"><i class="fa fa-university"></i> Campuses</a>
            </li>
            <li class="menu-item">
                <a href="student_fees.php"><i class="fas fa-money-bill"></i> Students Fees</a>
            </li>
            <li class="menu-item">
                <a href="employee_salary.php"><i class="fas fa-wallet"></i> Employee Salary</a>
            </li>
            <li class="menu-item">
                <a href="student_report.php"><i class="far fa-file-alt"></i> Student Report</a>
            </li>
            <li class="menu-item">
                <a href="employee_report.php"><i class="fas fa-file-signature"></i> Employee Report</a>
            </li>
            <li class="menu-item">
                <a href="projects.php"><i class="fas fa-tasks"></i> Projects</a>
            </li>
          
            <li class="menu-item">
                <a href="seminars.php"><i class="far fa-calendar-check"></i> Seminars</a>
            </li>
            <li class="menu-item">
                <a href="expense.php"><i class="fas fa-dollar-sign"></i> Expenses</a>
            </li>
            <li class="menu-item">
                <a href="user.php"><i class="fas fa-users"></i> Users</a>
            </li>
            <li class="menu-item">
    <a href="about_us.php"><i class="fas fa-info-circle"></i>   About Us</a>
</li>
        </ul>
        <!-- Logout Button -->
        <div class="logout-button">
            <a href="../controller/logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a>
        </div>
    </div>
<?php } elseif ($role == "Accountant") { ?>
    <div class="sidebar">
        <!-- ... (accountant menu items) ... -->
        <div class="logo">
            <h2 style="color:#f9c013;">FineTech</h2>
        </div>
        <ul class="menu">

            <li class="menu-item">
                <a href="index.php"><i class="fas fa-chart-line"></i> Dashboard</a>
            </li>
            
            
            
            
           
            <li class="menu-item">
                <a href="student_fees.php"><i class="fas fa-money-bill"></i> Students Fees</a>
            </li>
            <li class="menu-item">
                <a href="employee_salary.php"><i class="fas fa-wallet"></i> Employee Salary</a>
            </li>
           
            
            <li class="menu-item">
                <a href="expense.php"><i class="fas fa-dollar-sign"></i> Expenses</a>
            </li>
            <li class="menu-item">
    <a href="about_us.php"><i class="fas fa-info-circle"></i>   About Us</a>
</li>
        </ul>
        <div class="logout-button">
            <a href="../controller/logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a>
        </div>
    </div>
<?php } ?>
<div class="content">
    <!-- Your website content goes here -->
</div>
</body>
</html>
