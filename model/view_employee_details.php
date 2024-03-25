<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Details - FineTech</title>
    <link rel="stylesheet" href="../view/employees.css">
    <style>
        body {
            background-color: #ffffff;
            color: #133054;
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
        }

        .content1 {
            margin-left: 250px;
            margin-top: 10px;
            padding: 20px;
        }

        .content1 h1,
        .content1 p {
            font-weight: bold;
        }

        .content2 {
            border: 2px solid #133054;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-top: 10px;
            padding: 20px;
        }

        h1 {
            color: #133054;
            font-weight: bold;
        }

        p {
            color: #133054;
            margin-bottom: 10px;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            color: #f9c013;
            background-color: #133054;
            padding: 10px;
        }
    </style>
</head>

<body>
    <?php
    include('sidebar.php');
    ?>

    <div class="content1">
        <div class="header">
            <h1 style="color: #f9c013;">Employee Details</h1>
        </div>

        <div class="content2">
            <?php
            // Get the employee ID from the query parameters
            if (isset($_GET['id'])) {
                $employeeId = $_GET['id'];
                $host = 'localhost';
                $username = 'root';
                $password = '';
                $database = 'finetech';

                $conn = mysqli_connect($host, $username, $password, $database);

                if (!$conn) {
                    die("Connection failed: " . mysqli_connect_error());
                }

                $sql = "SELECT * FROM employees WHERE id = $employeeId";
                $result = mysqli_query($conn, $sql);

                if ($result && mysqli_num_rows($result) > 0) {
                    $employeeDetails = mysqli_fetch_assoc($result);
                    // Display the details as needed
                     echo '<img src="' . $employeeDetails['image'] . '" alt="Employee Image" style="max-width: 200px; max-height: 200px;">';
                    echo '<p>Employee Status: ' . $employeeDetails['status'] . '</p>';
                    echo '<p>Name: ' . $employeeDetails['name'] . '</p>';
                    echo '<p>department: ' . $employeeDetails['department'] . '</p>';
                    echo '<p>Email: ' . $employeeDetails['email'] . '</p>';
                    echo '<p>Contact: ' . $employeeDetails['contact'] . '</p>';
                    echo '<p>CNIC: ' . $employeeDetails['cnic'] . '</p>';
                    echo '<p>Birth Date: ' . $employeeDetails['dob'] . '</p>';
                    echo '<p>Joining Date: ' . $employeeDetails['doj'] . '</p>';
                    echo '<p>Total Salary: ' . $employeeDetails['salary'] . '</p>';
                    echo '<p>Salary Paid: ' . $employeeDetails['paid'] . '</p>';

                    echo '<p>Leaving Date: ' . $employeeDetails['dol'] . '</p>';
                    echo '<p>Address: ' . $employeeDetails['address'] . '</p>';
                } else {
                    echo '<p>employee details not found</p>';
                }

                mysqli_close($conn);
            } else {
                echo '<p>Invalid employee ID</p>';
            }
            ?>
        </div>

        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>

        <?php
        include('footer.php');
        ?>
    </div>
</body>
</html>
