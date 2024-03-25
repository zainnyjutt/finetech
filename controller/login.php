<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();

$servername = "localhost";
$user = "root";
$pass = "";
$database = "finetech";

$email = $_POST["email"];
$password = $_POST["password"];
$link = mysqli_connect($servername, $user, $pass, $database);

if (!$link) {
    die("Connection failed: " . mysqli_connect_error());
}

$qry = "SELECT * FROM userdata WHERE email='$email' AND password='$password'";
$result = mysqli_query($link, $qry);
$row = mysqli_fetch_array($result);

if (is_array($row)) {
    $_SESSION["email"] = $row['email'];
    $_SESSION["password"] = $row['password'];

    // Set a session timeout (e.g., 30 minutes)
    $_SESSION['last_activity'] = time() + 1800; // 30 minutes

    // Redirect the user back to the original page
    if (isset($_SESSION['redirect_url'])) {
        $redirect_url = $_SESSION['redirect_url'];
        unset($_SESSION['redirect_url']);
        header("Location: $redirect_url");
        exit();
    } else {
        // If no specific page was stored, redirect to a default page
        header("Location: ../model/index.php");
        exit();
    }
} else {
    header("Location: ../model/errorlogin.php");
    exit();
}

mysqli_close($link);
?>
