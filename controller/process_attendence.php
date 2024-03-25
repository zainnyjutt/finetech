<?php
$host = 'localhost';
$username = 'root';
$password = '';
$database = 'finetech';

$conn = mysqli_connect($host, $username, $password, $database);



if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['student_id'])) {
        $studentId = $_POST['student_id'];
        $action = $_POST['action'];

        // Include your code to save the timestamp to the database here
        // Replace 'your_table_name' with your actual table name
        $query = "INSERT INTO attendance (`student_id`, `action`, `timestamp`) VALUES ('$studentId', '$action', NOW())";

        if (mysqli_query($conn, $query)) {
            // Get the newly inserted timestamp
            $timestampQuery = "SELECT timestamp FROM attendance WHERE student_id = $studentId AND action = '$action' ORDER BY timestamp DESC LIMIT 1";
            $result = mysqli_query($conn, $timestampQuery);

            if ($result && $row = mysqli_fetch_assoc($result)) {
                $timestamp = $row['timestamp'];
                echo $timestamp;
            } else {
                echo "error";
            }
        } else {
            echo "error";
        }
    }
}
mysqli_close($conn);
?>
