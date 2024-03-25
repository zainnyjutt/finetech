<?php
$l = "localhost";
$r = "root";
$p = "";
$d = "finetech";

$link = mysqli_connect($l, $r, $p, $d);

$id = $_POST['id'];
$name = $_POST['name'];
$date = $_POST['date'];
$time = $_POST['time'];
$location = $_POST['address'];
$description = $_POST['dob'];
$invites = $_POST["invites"];
$present = $_POST["present"];
$guest = $_POST["guest"];

$q = "UPDATE seminars SET `name`='$name', `date`='$date', `time`='$time', `location`='$location', `description`='$description', `invites`='$invites', `present`='$present', `cheif_guest`='$guest' WHERE `id`='$id'";

if (mysqli_query($link, $q)) {
    header("Location:../model/seminars.php");
} else {
    echo "Error updating seminar: " . mysqli_error($link);
}

mysqli_close($link);
?>
