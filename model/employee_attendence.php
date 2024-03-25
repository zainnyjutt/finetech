<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Assuming you have a database connection
$servername = "localhost";
$username = "root";
$password = "";
$database = "finetech";

$link = mysqli_connect($servername, $username, $password, $database);

if (!$link) {
    die("Connection failed: " . mysqli_connect_error());
}

// Fetch unique attendance dates from the database
$query_dates = "SELECT DISTINCT attendance_date FROM employee_attendance";
$result_dates = mysqli_query($link, $query_dates);

// Set the default date to today
$selected_date = date('Y-m-d');

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['date'])) {
    $selected_date = $_POST['date'];

    // Fetch attendance data for the selected date
    $query_attendance = "SELECT * FROM employee_attendance WHERE attendance_date = '$selected_date'";
    $result_attendance = mysqli_query($link, $query_attendance);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Attendance</title>
    
    <style>
        .pagination {
            text-align: center;
            margin-top: 20px;
        }

        .pagination a {
            display: inline-block;
            padding: 5px 10px;
            background-color: #133054;
            color: #f9c013;
            text-decoration: none;
            border-radius: 5px;
            margin: 5px;
        }

        .pagination .current-page {
            display: inline-block;
            padding: 5px 10px;
            background-color: #f9c013;
            color: #133054;
            text-decoration: none;
            border-radius: 5px;
            margin: 5px;
        }

        .pagination .previous,
        .pagination .next {
            padding: 5px 10px;
            background-color: #133054;
            color: #f9c013;
            text-decoration: none;
            border-radius: 5px;
            margin: 5px;
        }

        .pagination a:hover,
        .pagination .previous:hover,
        .pagination .next:hover {
            background-color: #f9c013;
            color: #133054;
        }

        .search-bar {
            display: flex;
            align-items: center;
        }

        .search-bar input {
            padding: 5px;
            border: none;
            border-radius: 5px;
            margin-right: 5px;
        }

        .search-bar button {
            background-color: #133054;
            color: #f9c013;
            border: none;
            border-radius: 5px;
            padding: 5px 10px;
            cursor: pointer;
        }

        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: right;
            color: #f9c013;
            background-color: #133054;
            padding: 10px;
        }

        .container {
            margin-top:20px;
            display: flex;
            flex-direction: column;
            max-width: 80%;
            margin-left: 270px; /* Adjust this margin based on your sidebar width */
        }

        .container2 {
            margin-top:15px;
            width: 96.79%;
            background-color: #fff;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            color: #133054; /* Dark Blue */
        }

        form {
            margin-bottom: 20px;
        }

        label {
            margin-right: 10px;
            font-size: 20px;
        }

        table, th, td {
            border-collapse:collapse;
            border: 1px solid #ddd;
        }

        th, td {
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: #133054;
            color: white;
        }

        .button {
            text-decoration: none;
            padding: 10px 15px;
            cursor: pointer;
        }

        .show-attendance {
            background-color: #133054; /* Yellow */
            color: #f9c013; /* Dark Blue */
            border: none;
        }

        .show-attendance:hover {
            background-color: #f9c013; /* Darker Yellow */
            color: #133054;
        }

        .mark-attendance {
            float:right;
            background-color: #133054; /* Dark Blue */
            color: #f9c013; /* Yellow */
            border: none;
        }

        .mark-attendance:hover {
            background-color: #f9c013; /* Darker Blue */
            color: #133054;
        }
        .ttt{
            width:100%
        }
    </style>
</head><body>
    <?php include('sidebar.php'); ?>

    <div class="container">
        <div class="header">
            <h1 style="color:#f9c013;">Employee Attendance</h1>
            <div class="search-bar">
                <input type="text" id="search-input" placeholder="Search...">
                <button><i class="fas fa-search"></i></button>
            </div>
        </div>

        <div class="container2">
            <!-- Date Selection -->
           <form method="post">
    <label for="date">Select Date:</label>
    <input type="date" id="date" name="date" value="<?php echo $selected_date; ?>">
    <input type="submit" class="button show-attendance" value="Show Attendance">
    <a href="mark_employee_attendance.php" class="button mark-attendance">Mark Attendance</a>
</form>
            <!-- Display Attendance Data -->
            <?php if (isset($result_attendance)) { ?>
                <table class="ttt">
                    <thead>
                        <tr>
                            <th>Serial No.</th>
                            <th>Name</th>
                            <th>Department</th>
                            <th>CNIC</th>
                            <th>Gender</th>
                            <th>Attendance Date</th>
                            <th>Attendance Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $serialNumber = 1; // Initialize the serial number
                        while ($row = mysqli_fetch_assoc($result_attendance)) {
                            ?>
                            <tr>
                                <td><?php echo $serialNumber; ?></td>
                                <td><?php echo $row['name']; ?></td>
                                <td><?php echo $row['department']; ?></td>
                                <td><?php echo $row['cnic']; ?></td>
                                <td><?php echo $row['gender']; ?></td>
                                <td><?php echo $row['attendance_date']; ?></td>
                                <td><?php echo $row['attendance_status']; ?></td>
                            </tr>
                            <?php
                            $serialNumber++; // Increment the serial number for the next row
                        }
                        ?>
                    </tbody>
                </table>
            <?php } ?>
        </div>
    </div>
</body>

</html>
