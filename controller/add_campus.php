<?php



$name = $_POST["full_name"];
$email = $_POST["email"];

$dob = $_POST["phone_number"];
$address = $_POST["street_address"];
$link = $_POST["link"];


$l="localhost";
$r="root";
$p="";
$d="finetech";

$conn=mysqli_connect($l,$r,$p,$d);

$q = "INSERT INTO `campus`( `name`, `contact`, `email`, `address`,`link`) VALUES ('$name','$email','$dob','$address','$link')";
$n=mysqli_query($conn,$q);
if($n){  header("Location:../model/campuses.php");}
else{ header("Location:../model/error_add_news.html");}



?>
