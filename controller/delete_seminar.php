<?php
// Check if the delete_id is set in the URL
if (isset($_GET['delete_id'])) {
    // Database connection
    $host = 'localhost';
    $username = 'root';
    $password = '';
    $database = 'finetech';

    $conn = mysqli_connect($host, $username, $password, $database);

    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Sanitize the input to prevent SQL injection
    $delete_id = mysqli_real_escape_string($conn, $_GET['delete_id']);

    // Perform the delete operation
    $sql = "DELETE FROM seminars WHERE id = $delete_id";

    if (mysqli_query($conn, $sql)) {
        // Student deleted successfully
        header("Location:../model/seminars.php");
        exit();
    } else {
        echo "Error deleting student: " . mysqli_error($conn);
    }

    // Close the database connection
    mysqli_close($conn);
}
?>
