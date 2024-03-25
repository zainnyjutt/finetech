<?php
$host = 'localhost';
$username = 'root';
$password = '';
$database = 'finetech';

$conn = mysqli_connect($host, $username, $password, $database);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$selectedCourse = mysqli_real_escape_string($conn, $_GET['course']);

$sql = "SELECT fee FROM courses WHERE name = '$selectedCourse'";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    echo $row['fee'];
} else {
    echo "";
}

mysqli_close($conn);
?>
