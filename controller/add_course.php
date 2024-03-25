<?php



$name = $_POST["full_name"];
$email = $_POST["email"];
$gender = $_POST["gender"];
$contact = $_POST["duration"];
$dob = $_POST["phone_number"];
$address = $_POST["street_address"];


$l="localhost";
$r="root";
$p="";
$d="finetech";

$conn=mysqli_connect($l,$r,$p,$d);

$q = "INSERT INTO `courses`(`name`, `detail`, `gender`, `duration`, `fee`, `tutor`) VALUES ('$name','$email','$gender','$contact','$dob','$address')";
$n=mysqli_query($conn,$q);
if($n){  header("Location:../model/courses.php");}
else{ header("Location:../model/error_add_news.html");}



?>
