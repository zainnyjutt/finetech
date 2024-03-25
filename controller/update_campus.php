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

$name = $_POST['full_name'];  // Updated field name
$contact = $_POST['email'];   // Updated field name
$email = $_POST['phone_number'];  // Updated field name
$address = $_POST['street_address'];  // Updated field name

$q = "UPDATE `campus` SET `name`='$name' , `contact`='$contact', `email`='$email',  `address`='$address' WHERE `id`='$id'"; // Updated table name

if (mysqli_query($link, $q)) {
    header("Location:../model/campuses.php");
} else {
    echo "Error updating record: " . mysqli_error($link);
}

mysqli_close($link);

?>
