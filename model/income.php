<!-- income.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../view/expenses.css">
    <title>Income</title>
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
        <h2>Income List</h2>
        <a href="add_income.php"><button class="add-expense-btn">Add New Income</button></a>

        <table border="1">
            <tr>
                <th>Serial No.</th>
                <th>Income</th>
                <th>Category</th>
                <th>Date</th>
                <th>Update</th>
                <th>Delete</th>
            </tr>
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

            // Fetch data from the database
            $sql = "SELECT * FROM income";
            $result = $conn->query($sql);

            // Output data from the database
            if ($result->num_rows > 0) {
                $serialNo = 1; // Initialize serial number
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $serialNo . "</td>";
                    echo "<td>" . $row["income_name"] . "</td>";
                    echo "<td>" . $row["category"] . "</td>";
                    echo "<td>" . $row["date"] . "</td>";
                    echo "<td><a href='update_income.php?id=" . $row["id"] . "'><button class='update1'>Update</button></a></td>";
                    echo "<td><a href='../controller/delete_income.php?id=" . $row["id"] . "'><button class='delete1'>Delete</button></a></td>";
                    echo "</tr>";
                    $serialNo++; // Increment serial number
                }
            } else {
                echo "<tr><td colspan='6'>No data found</td></tr>";
            }
            ?>
        </table>
    </div>
</div>
</body>
</html>
