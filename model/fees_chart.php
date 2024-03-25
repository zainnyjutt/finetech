<?php
require_once '../controller/attempt_login.php'; // Adjust the file path accordingly
?>
  <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Fees Overview</title>
    <!-- Include Chart.js library -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
    <div style="max-width: auto; min-width:auto" width="300" height="300">
        <canvas id="feesChart" ></canvas>
    </div>

    <?php
    // Database connection
    $host = 'localhost';
    $username = 'root';
    $password = '';
    $database = 'finetech';

    $conn = mysqli_connect($host, $username, $password, $database);

    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Query to calculate the total fees, paid fees, and remaining fees
    $sql = "SELECT SUM(fees) AS total_fees, SUM(paid) AS total_paid FROM students";
    $result = mysqli_query($conn, $sql);

    $row = mysqli_fetch_assoc($result);
    $totalFees = $row['total_fees'];
    $totalPaid = $row['total_paid'];
    $remainingFees = $totalFees - $totalPaid;

    // Close the database connection
    mysqli_close($conn);
    ?>

    <script>
        // Chart.js configuration
        var ctx = document.getElementById('feesChart').getContext('2d');
        var feesChart = new Chart(ctx, {
            type: 'pie',
            data: {
                labels: ['Total Fees', 'Paid Fees', 'Remaining Fees'],
                datasets: [{
                    data: [<?php echo $totalFees; ?>, <?php echo $totalPaid; ?>, <?php echo $remainingFees; ?>],
                    backgroundColor: ['#133054', '#f9c013', '#ccc'], // Total Fees: Dark Blue, Paid Fees: Green, Remaining Fees: Red
                }]
            },
            options: {
                plugins: {
                    title: {
                        display: true,
                        text: 'Student Fees Overview',
                        font: {
                            size: 20,
                            weight: 'bold',
                        }
                    },
                },
            }
        });
    </script>
</body>
</html>
