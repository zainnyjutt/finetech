<!-- add_income_process.php -->
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
    $incomeName = $_POST["income_name"];
    $category = $_POST["category"];
    $date = $_POST["date"];

    // Insert the new income into the database
    $sql = "INSERT INTO income (income_name, category, date) VALUES ('$incomeName', '$category', '$date')";

    if ($conn->query($sql) === TRUE) {
        header("Location:../model/income.php");
    } else {
        echo "Error adding income: " . $conn->error;
    }
}

// Close the connection
$conn->close();
?>
