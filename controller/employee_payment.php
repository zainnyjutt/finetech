<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $student_id = $_POST['student_id'];
    $installment = $_POST['installment'];

    if (!is_numeric($student_id) || !is_numeric($installment)) {
        echo "Invalid data provided.";
        exit;
    }

    $host = 'localhost';
    $username = 'root';
    $password = '';
    $database = 'finetech';

    $conn = mysqli_connect($host, $username, $password, $database);

    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    $sql = "SELECT paid, salary FROM employees WHERE id = $student_id";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $current_paid = $row['paid'];
        $total_fees = $row['salary'];

        $new_paid = $current_paid + $installment;

        $update_sql = "UPDATE employees SET paid = $new_paid WHERE id = $student_id";
        if (mysqli_query($conn, $update_sql)) {
            header("Location: ../model/employee_salary.php");
        } else {
            echo "Error updating payment: " . mysqli_error($conn);
        }
    } else {
        echo "Employee not found.";
    }

    mysqli_close($conn);
} else {
    echo "Invalid request method.";
}
?>