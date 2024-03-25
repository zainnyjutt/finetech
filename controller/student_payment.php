<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $student_id = $_POST['student_id'];
    $installment = $_POST['installment'];

    // Database connection
    $host = 'localhost';
    $username = 'root';
    $password = '';
    $database = 'finetech';

    $conn = mysqli_connect($host, $username, $password, $database);

    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Fetch existing paid fees for the student
    $sql = "SELECT paid, fees FROM students WHERE id = $student_id";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $current_paid = $row['paid'];
        $total_fees = $row['fees'];

        // Calculate the new paid amount
        $new_paid = $current_paid + $installment;

        // Update the database with the new paid amount
        $update_sql = "UPDATE students SET paid = $new_paid WHERE id = $student_id";
        if (mysqli_query($conn, $update_sql)) {
            header("Location:../model/student_fees.php");
        } else {
            echo "Error updating payment: " . mysqli_error($conn);
        }
    } else {
        echo "Student not found.";
    }

    // Close the database connection
    mysqli_close($conn);
} else {
    echo "Invalid request method.";
}
?>
