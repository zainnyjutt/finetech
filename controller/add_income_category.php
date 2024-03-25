<?php
$category = $_POST["category"];

$l = "localhost";
$r = "root";
$p = "";
$d = "finetech";

$conn = mysqli_connect($l, $r, $p, $d);

// Use prepared statement to prevent SQL injection
$q = "INSERT INTO `income_categories` (`category_name`) VALUES ('$category')";
$stmt = mysqli_prepare($conn, $q);
mysqli_stmt_bind_param($stmt, "s", $category);
$n = mysqli_stmt_execute($stmt);

if ($n) {
    header("Location:../model/income_category.php");
} else {
    header("Location:../model/error_add_news.html");
}
mysqli_stmt_close($stmt);
mysqli_close($conn);
?>