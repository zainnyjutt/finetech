<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

$servername = "localhost";
$username = "root";
$password = "";
$database = "finetech";

$link = mysqli_connect($servername, $username, $password, $database);

if (!$link) {
    die("Connection failed: " . mysqli_connect_error());
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['attendance'])) {
    $attendance_date = $_POST['attendance_date'];
    $attendance_data = $_POST['attendance'];

    foreach ($attendance_data as $student_id => $attendance_status) {
        $query_existing_record = "SELECT * FROM student_attendance WHERE attendance_date = '$attendance_date' AND student_id = '$student_id'";
        $result_existing_record = mysqli_query($link, $query_existing_record);

        if (!$result_existing_record) {
            die('Error checking existing record: ' . mysqli_error($link));
        }

        if (mysqli_num_rows($result_existing_record) > 0) {
            $query_update = "UPDATE student_attendance SET attendance_status = '$attendance_status' WHERE attendance_date = '$attendance_date' AND student_id = '$student_id'";
            $result_update = mysqli_query($link, $query_update);

            if (!$result_update) {
                die('Error updating record: ' . mysqli_error($link));
            }
        } else {
            $query_insert = "INSERT INTO student_attendance (student_id, name, course, cnic, gender, attendance_date, attendance_status) SELECT id, name, course, cnic, gender, '$attendance_date', '$attendance_status' FROM students WHERE id = '$student_id'";
            $result_insert = mysqli_query($link, $query_insert);

            if (!$result_insert) {
                die('Error inserting new record: ' . mysqli_error($link));
            }
        }
    }

    header("Location:../model/courses.php");
    exit();
} else {
    header("Location: mark_attendance.php");
    exit();
}
?>
