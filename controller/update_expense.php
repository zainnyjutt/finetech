<!-- update_expense_process.php -->
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
    $expenseId = $_POST["expense_id"];
    $expenseName = $_POST["expense_name"];
    $category = $_POST["category"];
    $date = $_POST["date"];

    // Update the expense in the database
    $sql = "UPDATE expenses SET expense_name = '$expenseName', category = '$category', date = '$date' WHERE id = $expenseId";

    if ($conn->query($sql) === TRUE) {
        header("Location:../model/expense.php");
    } else {
        echo "Error updating expense: " . $conn->error;
    }
}

// Close the connection
$conn->close();
?>
