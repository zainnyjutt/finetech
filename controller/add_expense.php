<!-- add_expense_process.php -->
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
    $expenseName = $_POST["expense_name"];
    $category = $_POST["category"];
    $date = $_POST["date"];

    // Insert the new expense into the database
    $sql = "INSERT INTO expenses (expense_name, category, date) VALUES ('$expenseName', '$category', '$date')";

    if ($conn->query($sql) === TRUE) {
        header("Location:../model/expense.php");
    } else {
        echo "Error adding expense: " . $conn->error;
    }
}

// Close the connection
$conn->close();
?>
