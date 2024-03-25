<?php
require_once '../controller/attempt_login.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name = $_POST["full_name"];
    $course = $_POST["course"];
    $salary = $_POST["salary"];
    $email = $_POST["email"];
    $contact = $_POST["phone_number"];
    $cnic = $_POST["cnic"];
    $dob = $_POST["dob"];
    $doj = $_POST["doj"];
    $status = $_POST["status"];
    $dol = isset($_POST["dol"]) ? $_POST["dol"] : null;
    $gender = $_POST["gender"];
    $address = $_POST["street_address"];

    $host = 'localhost';
    $username = 'root';
    $password = '';
    $database = 'finetech';

    $conn = mysqli_connect($host, $username, $password, $database);

    if (!$conn) {
        die("Not Connected: " . mysqli_connect_error());
    }

    // Handle file upload
    $targetDir = "../images/uploads/";
    $targetFile = $targetDir . basename($_FILES["employee_image"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

    // Check if image file is a valid image
    $check = getimagesize($_FILES["employee_image"]["tmp_name"]);
    if ($check === false) {
        $uploadOk = 0;
    }

    // Check file size (500 KB limit)
    if ($_FILES["employee_image"]["size"] > 500000) {
        $uploadOk = 0;
    }

    // Allow only certain file formats
    $allowedFormats = ["jpg", "jpeg", "png", "gif"];
    if (!in_array($imageFileType, $allowedFormats)) {
        $uploadOk = 0;
    }

    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 1) {
// Use prepared statement to prevent SQL injection
$sql = "INSERT INTO `employees`(`name`, `image`, `department`, `salary`, `email`, `contact`, `cnic`, `dob`, `doj`, `status`, `dol`, `gender`, `address`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
$stmt = mysqli_prepare($conn, $sql);

if ($stmt) {
    // Bind parameters
    mysqli_stmt_bind_param($stmt, "sssssssssssss", $name, $targetFile, $course, $salary, $email, $contact, $cnic, $dob, $doj, $status, $dol, $gender, $address);

    // Execute statement
    $result = mysqli_stmt_execute($stmt);

    if ($result) {
        // Move the uploaded file to the target directory
        if (move_uploaded_file($_FILES["employee_image"]["tmp_name"], $targetFile)) {
            header("Location: ../model/employee.php");
        } else {
            header("Location: ../model/error_add_news.html");
        }
    } else {
        header("Location: ../model/error_add_news.html");
    }

    mysqli_stmt_close($stmt);
} else {
    echo "Error in prepared statement: " . mysqli_error($conn);
}
    } else {
        echo "Invalid file format or size.";
    }

    mysqli_close($conn);
}
?>
