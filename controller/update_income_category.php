<!-- update_category_process.php -->
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
    $newCategoryName = $_POST["category"];

    // Update the category
    $sql = "UPDATE income_categories SET category_name = '$newCategoryName' WHERE id = $categoryId";

    if ($conn->query($sql) === TRUE) {
        header("Location:../model/income_category.php");
    } else {
        echo "Error updating category: " . $conn->error;
    }
}

// Close the connection
$conn->close();
?>
