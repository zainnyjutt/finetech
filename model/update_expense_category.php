<!-- update_category.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../view/expense.css">
    <link rel="stylesheet" href="../view/expense_category.css">
    <link rel="stylesheet" href="../view/add_expense_category.css">
    <title>Update Expense Category</title>
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
        <h2>Update Expense Category</h2>
        
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

        if(isset($_GET['id'])) {
            $categoryId = $_GET['id'];
            $sql = "SELECT * FROM expense_categories WHERE id = $categoryId";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                ?>
                <section class="container">
                <form action="../controller/update_expense_category.php" method="POST">

                    <input type="hidden" name="category_id" value="<?php echo $row['id']; ?>">
                    <div class="input-box address">

                    <label for="category">Category Name:</label>
                    <input type="text" id="category" name="category" value="<?php echo $row['category_name']; ?>" required>
                </div>
                    <button type="submit">Update Category</button>
                </form>
                </section>
                <?php
            } else {
                echo "Category not found.";
            }
        } else {
            echo "Category ID not provided.";
        }

        // Close the connection
        $conn->close();
        ?>
    </div>
</div>
</body>
</html>
