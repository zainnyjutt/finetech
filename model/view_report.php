<!-- report_form.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../view/expense.css">
    <link rel="stylesheet" href="../view/report.css">
    <title>Expense Report</title>
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

        <div class="date-selector">
            <h2>Select Date Range for Report</h2>
            <form action="generat_expense_report.php" method="POST">
                <label for="start_date">Start Date:</label>
                <input type="date" id="start_date" name="start_date" required>

                <label for="end_date">End Date:</label>
                <input type="date" id="end_date" name="end_date" required>

                <button type="submit">Generate Report</button>
            </form>
        </div>
    </div>
</body>
</html>
s