<!-- generate_report.php -->
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
    $startDate = $_POST["start_date"];
    $endDate = $_POST["end_date"];

    // Query to get total expenses for the selected date range
    $expenseSql = "SELECT SUM(expense_name) as total_expenses FROM expenses WHERE date BETWEEN '$startDate' AND '$endDate'";
    $expenseResult = $conn->query($expenseSql);
    $totalExpenses = ($expenseResult->num_rows > 0) ? $expenseResult->fetch_assoc()['total_expenses'] : 0;

    // Query to get total income for the selected date range
    $incomeSql = "SELECT SUM(income_name) as total_income FROM income WHERE date BETWEEN '$startDate' AND '$endDate'";
    $incomeResult = $conn->query($incomeSql);
    $totalIncome = ($incomeResult->num_rows > 0) ? $incomeResult->fetch_assoc()['total_income'] : 0;

    // Calculate profit or loss
    $profitLoss = $totalIncome - $totalExpenses;
}

// Close the connection
$conn->close();
?>

<!-- Display the report on the same page -->
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

        <div class="report-container">
            <div class="report-details">
            <h2>Expense Report</h2>
            <p>Selected Date Range: <?php echo $startDate . ' to ' . $endDate; ?></p>
            <p>Total Expenses: <?php echo $totalExpenses; ?> .PKR</p>
            <p>Total Income: <?php echo $totalIncome; ?> .PKR</p>
            <p>Profit/Loss: <?php echo $profitLoss; ?> .PKR</p>
        </div>
        </div>
    </div>
</body>
</html>
