<?php
$l = "localhost";
$r = "root";
$p = "";
$d = "finetech";

$id = $_POST['id'];

$link = mysqli_connect($l, $r, $p, $d);

if (!$link) {
    die("Connection failed: " . mysqli_connect_error());
}

$name = $_POST['name'];
$course = $_POST['course'];
$fees = $_POST['fees'];
$email = $_POST['email'];
$contact = $_POST['contact'];
$cnic = $_POST['cnic'];
$dob = $_POST['dob'];
$doa = $_POST['doa'];
$gender = $_POST['gender'];
$address = $_POST['address'];
$status = $_POST['status'];
$status_date = $_POST['doc'];

// Handle file upload
$targetDir = "../images/uploads/";
$targetFile = $targetDir . basename($_FILES["student_image"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

// Check if image file is a valid image
$check = getimagesize($_FILES["student_image"]["tmp_name"]);
if ($check === false) {
    $uploadOk = 0;
}

// Check file size (500 KB limit)
if ($_FILES["student_image"]["size"] > 500000) {
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
    if (move_uploaded_file($_FILES["student_image"]["tmp_name"], $targetFile)) {
        $image = $targetFile;

        // Update the database with the new image path
        $q = "UPDATE `students` SET `name`='$name', `image`='$image', `course`='$course', `fees`='$fees', `email`='$email', `contact`='$contact', `cnic`='$cnic', `dob`='$dob', `doa`='$doa', `status`='$status', `doc`='$status_date', `gender`='$gender', `address`='$address' WHERE `id`='$id'";

        if (mysqli_query($link, $q)) {
            header("Location:../model/students.php");
        } else {
            echo "Error updating record: " . mysqli_error($link);
        }
    } else {
        echo "Error uploading image.";
    }
} else {
    echo "Invalid file format or size.";
}

mysqli_close($link);
?>
