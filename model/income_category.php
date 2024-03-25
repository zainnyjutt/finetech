<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../view/expense.css">
    <link rel="stylesheet" href="../view/expense_category.css">
    <title>Expense-Categories</title>
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
        <h2>Expense Categories</h2>
        <a href="add_income_category.php"><button class="adc">Add Expense Category</button></a>

        <table border="1">
            <tr>
                <th class="header-bg">Serial No.</th>
                <th class="header-bg">Category Name</th>
                <th class="header-bg">Update</th>
                <th class="header-bg">Delete</th>
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
            $sql = "SELECT * FROM income_categories";
            $result = $conn->query($sql);

            // Output data from the database
            if ($result->num_rows > 0) {
                $serialNo = 1; // Initialize serial number
                while ($row = $result->fetch_assoc()) {
                    echo "<tr class='" . ($serialNo % 2 == 0 ? 'even' : 'odd') . "'>";
                    echo "<td>" . $serialNo . "</td>";
                    echo "<td>" . $row["category_name"] . "</td>";
                    echo "<td class='update-cell'><a href='update_income_category.php?id=" . $row["id"] . "'><button class='update-button'>Update</button></a></td>";
                    echo "<td class='delete-cell'>
                            <form action='../controller/delete_income_category.php' method='POST'>
                                <input type='hidden' name='category_id' value='" . $row['id'] . "'>
                                <button type='submit' class='delete-button'>Delete</button>
                            </form>
                          </td>";
                    echo "</tr>";
                    $serialNo++; // Increment serial number
                }
            } else {
                echo "<tr><td colspan='4'>No data found</td></tr>";
            }
            ?>
        </table>
    </div>
</div>
</body>
</html>
