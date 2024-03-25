<?php

$name = $_POST["full_name"];
$course = $_POST["course"];
$fees = $_POST["current_fees"];
$email = $_POST["email"];
$contact = $_POST["phone_number"];
$cnic = $_POST["cnic"];
$dob = $_POST["dob"];
$doa = $_POST["doa"];
$status = $_POST["status"];
$doc = $_POST["doc"];
$gender = $_POST["gender"];
$address = $_POST["street_address"];

$l = "localhost";
$r = "root";
$p = "";
$d = "finetech";

$conn = mysqli_connect($l, $r, $p, $d);

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

// Check if file already exists
if (file_exists($targetFile)) {
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
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    header("Location:../model/error_add_news.html?error=file_upload");
    exit;
}

// Move the uploaded file to the target directory
if (move_uploaded_file($_FILES["student_image"]["tmp_name"], $targetFile)) {
    $image = $targetFile;

    $q = "INSERT INTO students (`name`, `image`, `course`, `fees`, `email`, `contact`, `cnic`, `dob`, `doa`, `status`, `doc`, `gender`, `address`) VALUES ('$name', '$image', '$course', '$fees', '$email' ,'$contact', '$cnic', '$dob', '$doa', '$status', '$doc', '$gender', '$address')";
    $n = mysqli_query($conn, $q);

    if ($n) {
        header("Location:../model/students.php");
        exit;
    } else {
        header("Location:../model/error_add_news.html?error=database_insert");
        exit;
    }
} else {
    header("Location:../model/error_add_news.html?error=file_move");
    exit;
}

mysqli_close($conn);
?>
