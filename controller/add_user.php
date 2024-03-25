<?php
require_once '../controller/attempt_login.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $full_name = $_POST["full_name"];
    $cnic = $_POST["cnic"];
    $contact = $_POST["contact"];
    $email = $_POST["email"];
    $passwor =$_POST["password"];
    $role = $_POST["role"];

    $host = 'localhost';
    $username = 'root';
    $password = '';
    $database = 'finetech';

    $conn = mysqli_connect($host, $username, $password, $database);

    if (!$conn) {
        die("Not Connected: " . mysqli_connect_error());
    }

    // Use prepared statement to prevent SQL injection
    $sql = "INSERT INTO `userdata`(`name`, `cnic`, `contact`, `email`, `password`, `role`) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($conn, $sql);

    if ($stmt) {
        // Bind parameters
        mysqli_stmt_bind_param($stmt, "ssssss", $full_name, $cnic, $contact, $email, $passwor, $role);

        // Execute statement
        $result = mysqli_stmt_execute($stmt);

        if ($result) {
            header("Location: ../model/user.php");
        } else {
            echo "Error: " . mysqli_stmt_error($stmt);
        }

        mysqli_stmt_close($stmt);
    } else {
        echo "Error in prepared statement: " . mysqli_error($conn);
    }

    mysqli_close($conn);
}
?>
