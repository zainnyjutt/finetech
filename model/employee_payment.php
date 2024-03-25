<?php
require_once '../controller/attempt_login.php'; // Adjust the file path accordingly
?>
  <!-- add_payment_form.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Give Payment</title>
    <link rel="stylesheet" href="../view/employee_payment.css" />
</head>
<body>
<?php
    include('sidebar.php');
    ?>

    <div class="content">
    <h1>Give Payment</h1>
    <form action="../controller/employee_payment.php" method="POST">
        <?php
        $student_id = $_GET['id'];

        // Database connection and query to fetch student data
        $host = 'localhost';
        $username = 'root';
        $password = '';
        $database = 'finetech';

        $conn = mysqli_connect($host, $username, $password, $database);

        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }

        // Fetch the student's data from the database using $student_id
        $sql = "SELECT * FROM employees WHERE id = $student_id";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {
            $student_data = mysqli_fetch_assoc($result);

            echo '<input type="hidden" name="student_id" value="' . $student_id . '">';
            echo '<label>Name: ' . $student_data['name'] . '</label><br>';
            echo '<label>Department: ' . $student_data['department'] . '</label><br>';
            echo '<label>Contact: ' . $student_data['contact'] . '</label><br>';
            echo '<label>Total Salary: ' . $student_data['salary'] .' PKR'. '</label><br>';
            echo '<label>Salary Paid: ' . $student_data['paid'] .' PKR'. '</label><br>';
        } else {
            echo '<p>Employee not found.</p>';
        }

        // Close the database connection
        mysqli_close($conn);
        ?>
        <label for="installment">Installment Amount</label>
        <input type="number" id="installment" name="installment" placeholder="Enter installment amount" required>
        <!-- Add other form fields if needed -->
        <button type="submit">Give Payment</button>
    </form>
    </br>
                </br>
                </br>
                </br>
                </br>
                </br>
                </br>
                </br>
                </br>

        <?php
    include('footer.php');
    ?>

    </div>
</body>
</html>
