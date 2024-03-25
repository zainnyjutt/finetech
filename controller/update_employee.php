<?php
$host = 'localhost';
$username = 'root';
$password = '';
$database = 'finetech';

$link = mysqli_connect($host, $username, $password, $database);

if (!$link) {
    die("Connection failed: " . mysqli_connect_error());
}

$id = $_POST['id'];
$name = $_POST['full_name'];
$department = $_POST['department'];
$salary = $_POST['salary'];
$email = $_POST['email'];
$contact = $_POST['phone_number'];
$cnic = $_POST['cnic'];
$dob = $_POST['dob'];
$doj = $_POST['doj'];
$status = $_POST['status'];
$status_date = isset($_POST['dol']) ? $_POST['dol'] : null;
$gender = $_POST['gender'];
$address = $_POST['street_address'];

// Check if a new image is uploaded
if ($_FILES["employee_image"]["size"] > 0) {
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
        // Move the uploaded file to the target directory
        if (move_uploaded_file($_FILES["employee_image"]["tmp_name"], $targetFile)) {
            $image = $targetFile;
        } else {
            echo "Error uploading image.";
            exit;
        }
    } else {
        echo "Invalid file format or size.";
        exit;
    }
} else {
    // No new image uploaded, retrieve the existing image path from the database
    $existingImagePathQuery = "SELECT `image` FROM `employees` WHERE `id`='$id'";
    $result = mysqli_query($link, $existingImagePathQuery);

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $image = $row['image'];
    } else {
        echo "Error retrieving existing image path.";
        exit;
    }
}

// Update the database with the new image path or existing image path
$q = "UPDATE `employees` SET `name`='$name', `image`='$image', `department`='$department', `salary`='$salary', `email`='$email', `contact`='$contact', `cnic`='$cnic', `dob`='$dob', `doj`='$doj', `status`='$status', `dol`='$status_date', `gender`='$gender', `address`='$address' WHERE `id`='$id'";

if (mysqli_query($link, $q)) {
    header("Location:../model/employee.php");
} else {
    echo "Error updating record: " . mysqli_error($link);
}

mysqli_close($link);
?>
