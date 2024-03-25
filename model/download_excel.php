<?php

if (
    isset($_GET['student_id']) &&
    isset($_GET['from_date']) &&
    isset($_GET['to_date']) &&
    isset($_GET['tasks_assigned']) &&
    isset($_GET['tasks_done'])
) {
    // Assuming you have a database connection
    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "finetech";

    $link = mysqli_connect($servername, $username, $password, $database);

    if (!$link) {
        die("Connection failed: " . mysqli_connect_error());
    }

    $student_id = $_GET['student_id'];
    $from_date = $_GET['from_date'];
    $to_date = $_GET['to_date'];
    $selected_date = " Date: From $from_date to $to_date";

    // Retrieve student and attendance details from the database
    $query_student = "SELECT * FROM students WHERE id = '$student_id'";
    $result_student = mysqli_query($link, $query_student);

    $query_attendance = "SELECT * FROM student_attendance WHERE student_id = '$student_id' AND attendance_date BETWEEN '$from_date' AND '$to_date'";
    $result_attendance = mysqli_query($link, $query_attendance);

    if (!$result_student || !$result_attendance) {
        die("Query failed: " . mysqli_error($link));
    }

    $student = mysqli_fetch_assoc($result_student);

    // Calculate total working days and absents
    $startTimestamp = strtotime($from_date);
    $endTimestamp = strtotime($to_date);
    $workingDays = 0;
    $total_absents = 0;

    while ($startTimestamp <= $endTimestamp) {
        $currentDay = date("N", $startTimestamp);

        // Check if the current day is not Saturday (6) or Sunday (7)
        if ($currentDay < 6) {
            $workingDays++;
        }

        // Check for absents
        $query_absent = "SELECT * FROM student_attendance WHERE student_id = '$student_id' AND attendance_date = '" . date("Y-m-d", $startTimestamp) . "' AND attendance_status = 'Absent'";
        $result_absent = mysqli_query($link, $query_absent);

        if (!$result_absent) {
            die("Query failed: " . mysqli_error($link));
        }

        if (mysqli_num_rows($result_absent) > 0) {
            $total_absents++;
        }

        // Move to the next day
        $startTimestamp = strtotime("+1 day", $startTimestamp);
    }

    // Create an array to store data
    $data = array(
        array('Student Report'),
        array('Name', $student['name']),
        array('CNIC', $student['cnic']),
        array('Email', $student['email']),
        array('Contact', $student['contact']),
        array('Fees', $student['fees']),
        array('Fees Paid', $student['paid']),
        array('Total Working Days', 'Total Absents'),
        array($workingDays, $total_absents),
        array('Tasks Assigned', 'Tasks Done'),
        array($_GET['tasks_assigned'], $_GET['tasks_done'])
    );

    // Output the Excel file
    header('Content-Type: application/vnd.ms-excel');
    header('Content-Disposition: attachment; filename="student_report.xls"');

    $fp = fopen('php://output', 'w');
    foreach ($data as $row) {
        fputcsv($fp, $row, "\t");
    }
    fclose($fp);

    mysqli_close($link);
} else {
    echo "Invalid request.";
}
?>
