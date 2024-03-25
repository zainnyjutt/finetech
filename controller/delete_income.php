<!-- delete_income_process.php -->
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
        $incomeId = $_GET["id"];

        // Delete the income
        $sql = "DELETE FROM income WHERE id = $incomeId";

        if ($conn->query($sql) === TRUE) {
            header("Location:../model/income.php");
        } else {
            echo "Error deleting income: " . $conn->error;
        }
    } else {
        echo "income ID not provided.";
    }
}

// Close the connection
$conn->close();
?>
