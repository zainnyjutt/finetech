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
    $id = $_POST['id'];
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $detail = mysqli_real_escape_string($conn, $_POST['detail']);
    $gender = $_POST['gender'];
    $duration = $_POST['duration'];
    $fee = $_POST['fee'];
    $tutor = mysqli_real_escape_string($conn, $_POST['tutor']);

    $sql = "UPDATE courses SET name='$name', detail='$detail', gender='$gender', duration='$duration', fee='$fee', tutor='$tutor' WHERE id=$id";

    if (mysqli_query($conn, $sql)) {
        header("Location: ../model/courses.php"); // Redirect to the courses page
        exit;
    } else {
        echo "Error updating course: " . mysqli_error($conn);
    }
}

mysqli_close($conn);
?>
