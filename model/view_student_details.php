<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Details - FineTech</title>
    <link rel="stylesheet" href="../view/students.css">
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
            <h1 style="color: #f9c013;">Student Details</h1>
        </div>

        <div class="content2">
            <?php
            // Get the student ID from the query parameters
            if (isset($_GET['id'])) {
                $studentId = $_GET['id'];
                $host = 'localhost';
                $username = 'root';
                $password = '';
                $database = 'finetech';

                $conn = mysqli_connect($host, $username, $password, $database);

                if (!$conn) {
                    die("Connection failed: " . mysqli_connect_error());
                }

                $sql = "SELECT * FROM students WHERE id = $studentId";
                $result = mysqli_query($conn, $sql);

                if ($result && mysqli_num_rows($result) > 0) {
                    $studentDetails = mysqli_fetch_assoc($result);
                    // Display the details as needed

                    // Display the image
                    echo '<img src="' . $studentDetails['image'] . '" alt="Student Image" style="max-width: 200px; max-height: 200px;">';

                    echo '<p>Student Status: ' . $studentDetails['status'] . '</p>';
                    echo '<p>Name: ' . $studentDetails['name'] . '</p>';
                    echo '<p>Course: ' . $studentDetails['course'] . '</p>';
                    echo '<p>Email: ' . $studentDetails['email'] . '</p>';
                    echo '<p>Contact: ' . $studentDetails['contact'] . '</p>';
                    echo '<p>CNIC: ' . $studentDetails['cnic'] . '</p>';
                    echo '<p>Birth Date: ' . $studentDetails['dob'] . '</p>';
                    echo '<p>Admission Date: ' . $studentDetails['doa'] . '</p>';
                    echo '<p>Total Fees: ' . $studentDetails['fees'] . '</p>';
                    echo '<p>Fees Paid: ' . $studentDetails['paid'] . '</p>';
                    echo '<p>Leaving Date: ' . $studentDetails['doc'] . '</p>';
                    echo '<p>Address: ' . $studentDetails['address'] . '</p>';
                } else {
                    echo '<p>Student details not found</p>';
                }

                mysqli_close($conn);
            } else {
                echo '<p>Invalid student ID</p>';
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
