


<?php



$name = $_POST["full_name"];

$fees=$_POST["fees"];
$email = $_POST["email"];
$contact = $_POST["phone_number"];




$l="localhost";
$r="root";
$p="";
$d="finetech";

$conn=mysqli_connect($l,$r,$p,$d);

$q = "INSERT INTO `projects`(`name`, `description`, `author`, `link`) VALUES ('$name','$fees','$email','$contact')";
$n=mysqli_query($conn,$q);
if($n){  header("Location:../model/projects.php");}
else{ header("Location:../model/error_add_news.html");}



?>
