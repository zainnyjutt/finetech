<?php



$name = $_POST["full_name"];

$fees=$_POST["fees"];
$email = $_POST["email"];
$contact = $_POST["phone_number"];
$dob = $_POST["dob"];
$invites = $_POST["invites"];
$present = $_POST["present"];
$guest = $_POST["guest"];




$l="localhost";
$r="root";
$p="";
$d="finetech";

$conn=mysqli_connect($l,$r,$p,$d);

$q = "INSERT INTO `seminars`( `name`, `date`, `time`, `location`, `description`, `invites`, `present`, `cheif_guest`) VALUES ('$name','$fees','$email','$contact','$dob','$invites','$present','$guest')";
$n=mysqli_query($conn,$q);
if($n){  header("Location:../model/seminars.php");}
else{ header("Location:../model/error_add_news.html");}



?>
