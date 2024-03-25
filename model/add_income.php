<!-- add_income.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../view/expense.css">
    <link rel="stylesheet" href="../view/add_expense.css">

    <title>Add Income</title>
</head>
<body>
<?php include('sidebar.php'); ?>

<div class="content">
    <div class="header">
        <h1>EXPENSE MANAGEMENT SYSTEM</h1>
    </div>
    <div class="navbar">
        <a href="expense.php">Expenses</a>
        <a href="income.php">Income</a>
        <a href="expense_category.php">Expense Category</a>
        <a href="income_category.php">Income Category</a>
        <a href="view_report.php">View Report</a>
    </div>

    <div>
        <h2 align="center" style="color: #133054;">Add New Income</h2>

        <form action="../controller/add_income.php" method="POST">
            <label for="income_name">Income Value:</label>
            <input type="number" id="income_name" name="income_name" placeholder="Enter Income Value" required>

            <label for="category">Category:</label>
            <select id="category" name="category" required>
                <option value="" disabled selected>Select Category</option>
                <?php
                // Fetch categories from the database
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

                $categorySql = "SELECT * FROM income_categories";
                $categoryResult = $conn->query($categorySql);

                if ($categoryResult->num_rows > 0) {
                    while ($row = $categoryResult->fetch_assoc()) {
                        echo "<option value='" . $row["category_name"] . "'>" . $row["category_name"] . "</option>";
                    }
                } else {
                    echo "<option value='' disabled>No categories available</option>";
                }

                // Close the connection
                $conn->close();
                ?>
            </select>

            <label for="date">Date:</label>
            <input type="date" id="date" name="date" placeholder="Enter Date" required>

            <button type="submit">Add Income</button>
        </form>
    </div>
</div>
</body>
</html>
