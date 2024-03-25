<?php
require_once '../controller/attempt_login.php'; // Adjust the file path accordingly
?>
 <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../view/expense.css">
    <link rel="stylesheet" href="../view/expense_category.css">
    <link rel="stylesheet" href="../view/add_expense_category.css">
    <title>Add Expense Category</title>
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
    <section class="container">
        <header>Add Category</header>
        <form action="../controller/add_income_category.php" method="POST" class="form">
            
                
            <div class="input-box address">
                <label for="category">Category:</label>
                <input type="text" id="category" name="category" placeholder="Enter Category Name" required />
            </div>
            <button type="submit">Submit</button>
        </form>
    </section>
</div>
</body>
</html>
