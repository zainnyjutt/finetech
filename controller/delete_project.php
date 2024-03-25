<?php
if (isset($_GET['id'])) {
    // Database connection
    $host = 'localhost';
    $username = 'root';
    $password = '';
    $database = 'finetech';

    $conn = mysqli_connect($host, $username, $password, $database);

    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Get the project ID from the URL parameter
    $projectId = $_GET['id'];

    // Create a SQL query to delete the project with the specified ID
    $deleteSql = "DELETE FROM projects WHERE id = $projectId";

    if (mysqli_query($conn, $deleteSql)) {
        echo header("Location:../model/projects.php");
    } else {
        echo "Error deleting project: " . mysqli_error($conn);
    }

    // Close the database connection
    mysqli_close($conn);
} else {
    echo "Invalid project ID.";
}
?>
