<!-- delete_income_category.php -->
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
    $categoryId = $_POST["category_id"];

    // Delete the category
    $sql = "DELETE FROM income_categories WHERE id = $categoryId";

    if ($conn->query($sql) === TRUE) {
        header("Location:../model/income_category.php");
    } else {
        echo "Error deleting category: " . $conn->error;
    }
}

// Close the connection
$conn->close();
?>
