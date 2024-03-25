<?php
require_once '../controller/attempt_login.php'; // Adjust the file path accordingly
?>
  <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employees Joined by Month</title>
    <!-- Include Chart.js library -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        /* Style the canvas element */
        #employeeChart {
            background-color: white;
            border: 1px solid #ccc;
            border-radius: 5px;
            margin: 20px auto;
            max-width: 800px;
        }
    </style>
</head>
<body>
    <div style="width: 100%;">
        <canvas id="employeeChart" width="600" height="350"></canvas>
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

    // Calculate the start date for the last 8 months
    $endDate = date('Y-m-d');
    $startDate = date('Y-m-d', strtotime($endDate . ' - 8 months'));

    // Fetch employee data and group by month, limited to the last 8 months
    $sql = "SELECT DATE_FORMAT(doj, '%M') AS month, COUNT(*) AS count
            FROM employees
            WHERE doj >= '$startDate' AND doj <= '$endDate'
            GROUP BY DATE_FORMAT(doj, '%m-%Y')";
    $result = mysqli_query($conn, $sql);

    $months = [];
    $employeeCounts = [];

    // Initialize data for the last 8 months
    $last8Months = [];
    for ($i = 7; $i >= 0; $i--) {
        $last8Months[] = date('F', strtotime("-$i months", strtotime($endDate)));
    }

    while ($row = mysqli_fetch_assoc($result)) {
        $months[] = $row['month'];
        $employeeCounts[] = $row['count'];
    }

    // Fill in missing months with 0 employee counts
    foreach ($last8Months as $monthName) {
        if (!in_array($monthName, $months)) {
            $months[] = $monthName;
            $employeeCounts[] = 0;
        }
    }

    // Close the database connection
    mysqli_close($conn);
    ?>

    <script>
        // Chart.js configuration
        var ctx = document.getElementById('employeeChart').getContext('2d');
        var employeeChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: <?php echo json_encode($months); ?>,
                datasets: [{
                    label: 'Employees Joined',
                    data: <?php echo json_encode($employeeCounts); ?>,
                    backgroundColor: '#133054',
                    borderColor: '#f9c013',
                    borderWidth: 3,
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            stepSize: 1,
                        },
                    }
                },
                plugins: {
                    title: {
                        display: true,
                        text: 'Employees Joined by Month',
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
