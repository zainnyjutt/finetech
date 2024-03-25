<!-- update_income.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../view/expense.css">
    <link rel="stylesheet" href="../view/add_expense.css">
    <title>Update Income</title>
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
        <h2 align="center" style="color:#133054;">Update Income</h2>

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

        if (isset($_GET["id"])) {
            $incomeId = $_GET["id"];

            // Fetch income data from the database
            $incomeSql = "SELECT * FROM income WHERE id = $incomeId";
            $incomeResult = $conn->query($incomeSql);

            if ($incomeResult->num_rows > 0) {
                $incomeData = $incomeResult->fetch_assoc();
                ?>
                <form action="../controller/update_income.php" method="POST">
                    <input type="hidden" name="income_id" value="<?php echo $incomeData['id']; ?>">

                    <label for="income_name">Income Name:</label>
                    <input type="text" id="income_name" name="income_name" value="<?php echo $incomeData['income_name']; ?>" required>

                    <label for="category">Category:</label>
                    <select id="category" name="category" required>
                        <?php
                        // Fetch categories from the database
                        $categorySql = "SELECT * FROM income_categories";
                        $categoryResult = $conn->query($categorySql);

                        if ($categoryResult->num_rows > 0) {
                            while ($row = $categoryResult->fetch_assoc()) {
                                $selected = ($row["category_name"] == $incomeData['category']) ? "selected" : "";
                                echo "<option value='" . $row["category_name"] . "' $selected>" . $row["category_name"] . "</option>";
                            }
                        } else {
                            echo "<option value='' disabled>No categories available</option>";
                        }
                        ?>
                    </select>

                    <label for="date">Date:</label>
                    <input type="date" id="date" name="date" value="<?php echo $incomeData['date']; ?>" required>

                    <button type="submit">Update Income</button>
                </form>
                <?php
            } else {
                echo "<p>No income found with the specified ID.</p>";
            }
        } else {
            echo "<p>Income ID not provided.</p>";
        }

        // Close the connection
        $conn->close();
        ?>
    </div>
</div>
</body>
</html>
