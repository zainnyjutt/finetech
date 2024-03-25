<?php
require_once '../controller/attempt_login.php'; // Adjust the file path accordingly
?>
  <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Students Joined by Month</title>
    <!-- Include Chart.js library -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        /* Style the canvas element */
        #studentChart {
            background-color: white;
            border: 1px solid #ccc;
            border-radius: 5px;
            margin: 20px auto;
            max-width: 800px; /* Fix the max-width value */
        }
    </style>
</head>
<body>
    <div style="width: 100%;">
       <canvas id="studentChart" width="600" height="350"></canvas>

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

    // Fetch student data and group by month, limited to the last 8 months
    $sql = "SELECT DATE_FORMAT(doa, '%M') AS month, COUNT(*) AS count
            FROM students
            WHERE doa >= '$startDate' AND doa <= '$endDate'
            GROUP BY DATE_FORMAT(doa, '%m-%Y')";
    $result = mysqli_query($conn, $sql);

    $months = [];
    $studentCounts = [];

    // Initialize data for the last 8 months
    $last8Months = [];
    for ($i = 7; $i >= 0; $i--) {
        $last8Months[] = date('F', strtotime("-$i months", strtotime($endDate)));
    }

    while ($row = mysqli_fetch_assoc($result)) {
        $months[] = $row['month'];
        $studentCounts[] = $row['count'];
    }

    // Fill in missing months with 0 student counts
    foreach ($last8Months as $monthName) {
        if (!in_array($monthName, $months)) {
            $months[] = $monthName;
            $studentCounts[] = 0;
        }
    }

    // Close the database connection
    mysqli_close($conn);
    ?>

    <script>
        // Chart.js configuration
        var ctx = document.getElementById('studentChart').getContext('2d');
        var studentChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: <?php echo json_encode($months); ?>,
                datasets: [{
                    label: 'Students Joined',
                    data: <?php echo json_encode($studentCounts); ?>,
                    backgroundColor: '#133054', // Adjust the bar color and transparency
                    borderColor: '#f9c013', // Set border color to #f9c013
                    borderWidth: 3, // Increase the border width
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            stepSize: 1, // Adjust the step size of the y-axis
                        },
                    }
                },
                plugins: {
                    title: {
                        display: true,
                        text: 'Students Joined by Month',
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
