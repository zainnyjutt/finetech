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

// Fetch student data from the database
$query_students = "SELECT * FROM students WHERE status = 'Enrolled'";;
$result_students = mysqli_query($link, $query_students);

// Fetch existing attendance data for the selected date
$attendance_date = isset($_POST['date']) ? $_POST['date'] : date('Y-m-d');
$query_existing_attendance = "SELECT * FROM student_attendance WHERE attendance_date = '$attendance_date'";
$result_existing_attendance = mysqli_query($link, $query_existing_attendance);
$existing_attendance = [];

while ($row = mysqli_fetch_assoc($result_existing_attendance)) {
    $existing_attendance[$row['id']] = $row['attendance_status'];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mark Attendance</title>

<style>
                 .header {
                    margin-left:0px;
    display: flex;
    justify-content: space-between;
    align-items: center;
    color: #f9c013;
    background-color: #133054;
    padding: 10px;
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
        }
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
        }

        .container2 {
            
            width: 97%;
            margin-left:0px;
            margin-top: 20px;
            
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
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table, th, td {
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
            padding: 10px;
            float:right;
            background-color: #133054; /* Dark Blue */
            color: #f9c013; /* Yellow */
            border: none;
        }

        .button:hover {
            background-color: #f9c013; /* Darker Blue */
            color: #133054;
        }
    </style>
</head>
<body>
     <?php include('sidebar.php'); ?>

    <div class="container">
             <div class="content">
<div class="header">
    <h1 style="color:#f9c013;">Mark Attendance</h1>
    <div class="search-bar">
        <input type="text" id="search-input" placeholder="Search...">
        <button><i class="fas fa-search"></i></button>
    </div>
</div>

    <div class="container2">
        <div class="header1">
            
            <div class="search-bar">
                <!-- Date Selection -->
                <form method="post">
                    <label for="date">Select Date:</label>
                    <input type="date" id="date" name="date" value="<?php echo $attendance_date; ?>">
                    <input type="submit" class="button show-attendance" value="Show Attendance">
                </form>
            </div>
        </div>

        <div class="container2">
            <!-- Attendance Form -->
            <form method="post" action="../controller/insert_student_attendance.php">
                <input type="hidden" name="attendance_date" value="<?php echo $attendance_date; ?>">

                <table>
                    <thead>
                        <tr>
                            <th>Serial No.</th>
                            <th>Name</th>
                            <th>Course</th>
                            <th>CNIC</th>
                            <th>Gender</th>
                            <th>Attendance</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $serial_number = 1;
                        while ($row = mysqli_fetch_assoc($result_students)) {
                        ?>
                            <tr>
                                <td><?php echo $serial_number++; ?></td>
                                <td><?php echo $row['name']; ?></td>
                                <td><?php echo $row['course']; ?></td>
                                <td><?php echo $row['cnic']; ?></td>
                                <td><?php echo $row['gender']; ?></td>
                                <td>
                                    <?php
                                    $student_id = $row['id'];
                                    $attendance_status = isset($existing_attendance[$student_id]) ? $existing_attendance[$student_id] : '';
                                    ?>
                                    <label><input type="radio" name="attendance[<?php echo $student_id; ?>]" value="Present" <?php echo $attendance_status === 'Present' ? 'checked' : ''; ?>> Present</label>
                                    <label><input type="radio" name="attendance[<?php echo $student_id; ?>]" value="Absent" <?php echo $attendance_status === 'Absent' ? 'checked' : ''; ?>> Absent</label>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>

                <input type="submit" style="margin-top:7px;" class="button" value="Submit Attendance">
            </form>
        </div>
    </div>
</div>
</body>
</html>
