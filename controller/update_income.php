<!-- update_income_process.php -->
<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "finetech";

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $incomeId = $_POST["income_id"];
    $incomeName = $_POST["income_name"];
    $category = $_POST["category"];
    $date = $_POST["date"];

    // Update the income in the database
    $sql = "UPDATE income SET income_name = '$incomeName', category = '$category', date = '$date' WHERE id = $incomeId";

    if ($conn->query($sql) === TRUE) {
        header("Location:../model/income.php");
    } else {
        echo "Error updating income: " . $conn->error;
    }
}

// Close the connection
$conn->close();
?>
