<!-- delete_expense_process.php -->
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

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    if (isset($_GET["id"])) {
        $expenseId = $_GET["id"];

        // Delete the expense
        $sql = "DELETE FROM expenses WHERE id = $expenseId";

        if ($conn->query($sql) === TRUE) {
            header("Location:../model/expense.php");
        } else {
            echo "Error deleting expense: " . $conn->error;
        }
    } else {
        echo "Expense ID not provided.";
    }
}

// Close the connection
$conn->close();
?>
