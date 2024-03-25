<?php

// Include database connection
$l = "localhost";
$r = "root";
$p = "";
$d = "finetech";

$link = mysqli_connect($l, $r, $p, $d);

// Check connection
if (!$link) {
    die("Connection failed: " . mysqli_connect_error());
}

// Function to get all expense categories
function getExpenseCategories() {
    global $link;

    $categories = array();

    // Fetch expense categories from the database
    $sql = "SELECT * FROM finetech.expense_categories";
    $result = mysqli_query($link, $sql);

    // Check if the query was successful
    if ($result) {
        while ($row = mysqli_fetch_assoc($result)) {
            $categories[] = $row;
        }
    } else {
        // Output an error message if the query fails
        echo "Error: " . mysqli_error($link);
    }

    return $categories;
}

// Function to add a new expense category
function addExpenseCategory($categoryName) {
    global $link;

    $categoryName = mysqli_real_escape_string($link, $categoryName);

    // Perform the database insertion
    $sql = "INSERT INTO finetech.expense_categories (category_name) VALUES ('$categoryName')";
    $result = mysqli_query($link, $sql);

    // Check if the query was successful
    if (!$result) {
        // Output an error message if the query fails
        echo "Error: " . mysqli_error($link);
    }
}

// Function to update an existing expense category
function updateExpenseCategory($categoryId, $updatedCategoryName) {
    global $link;

    $categoryId = mysqli_real_escape_string($link, $categoryId);
    $updatedCategoryName = mysqli_real_escape_string($link, $updatedCategoryName);

    // Perform the database update
    $sql = "UPDATE finetech.expense_categories SET category_name = '$updatedCategoryName' WHERE id = '$categoryId'";
    $result = mysqli_query($link, $sql);

    // Check if the query was successful
    if (!$result) {
        // Output an error message if the query fails
        echo "Error: " . mysqli_error($link);
    }
}

// Function to delete an existing expense category
function deleteExpenseCategory($categoryId) {
    global $link;

    $categoryId = mysqli_real_escape_string($link, $categoryId);

    // Perform the database deletion
    $sql = "DELETE FROM finetech.expense_categories WHERE id = '$categoryId'";
    $result = mysqli_query($link, $sql);

    // Check if the query was successful
    if (!$result) {
        // Output an error message if the query fails
        echo "Error: " . mysqli_error($link);
    }
}

mysqli_close($link);
?>
