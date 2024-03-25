<?php
$host = 'localhost';
$username = 'root';
$password = '';
$database = 'finetech';

$conn = mysqli_connect($host, $username, $password, $database);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if (isset($_GET['id'])) {
        $id = $_GET['id'];

        // Use prepared statement to avoid SQL injection
        $sql = "DELETE FROM courses WHERE id = ?";
        $stmt = mysqli_prepare($conn, $sql);

        if ($stmt) {
            mysqli_stmt_bind_param($stmt, 'i', $id);

            if (mysqli_stmt_execute($stmt)) {
                header("Location: ../model/courses.php"); // Redirect to the courses page
                exit;
            } else {
                echo "Error deleting course: " . mysqli_error($conn);
            }
        } else {
            echo "Error preparing the delete statement: " . mysqli_error($conn);
        }
    }
}

mysqli_close($conn);
?>
