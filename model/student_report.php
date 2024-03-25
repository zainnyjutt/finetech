<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Student Report</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f9c013;
            color: #133054;
            margin: 0;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 25px;
        }

        th,
        td {
            padding: 5px;
            text-align: left;
            border: 1px solid white;
        }

        th {
            background-color: #133054;
            color: white;
        }

        tr:nth-child(odd) td {
            background-color: #ddd;
            /* Alternate color for odd rows */
        }

        form {
            margin-top: 20px;
        }

        input[type="date"],
        input[type="submit"],
        input[type="text"] {
            padding: 15px;
            /* Increased height */
            margin-right: 10px;
            border: 1px solid #133054;
        }

        input[type="submit"] {
            background-color: #133054;
            color: #f9c013;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #f9c013;
            color: #133054;
        }

        button {
            padding: 5px;
            /* Increased height */
            background-color: #133054;
            color: #f9c013;
            border: 3px solid #f9c013;
            cursor: pointer;
        }

        button:hover {
            background-color: #f9c013;
            color: #133054;
            border: 3px solid #133054;
            text-decoration: none;
        }

        .buttona {
            color: #f9c013;
            text-decoration: none;
            handover: #133054;
        }

        .buttona:hover {
            color: #133054;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            color: #f9c013;
            background-color: #133054;
            padding: 10px;
        }

        .search-bar {
            display: flex;
            align-items: center;
        }

        .search-bar input {
            padding: 10px;
            border: none;
            border-radius: 5px;
            margin-right: 5px;
        }

        .search-bar button {
            background-color: #133054;
            color: #f9c013;
            border: none;
            border-radius: 5px;
            padding: 10px 15px;
            /* Increased height */
            cursor: pointer;
        }
    </style>
</head>


<body>
    <?php
    include('sidebar.php');
    ?>
    <div class="content">
        <div class="header">
            <h1>STUDENTS REPORT</h1>
            <div class="search-bar">
                <input type="text" id="search-input" placeholder="Search...">
                <button><i class="fas fa-search"></i></button>
            </div>
        </div>

        <?php
        // Assuming you have a database connection
        $servername = "localhost";
        $username = "root";
        $password = "";
        $database = "finetech";

        $link = mysqli_connect($servername, $username, $password, $database);

        if (!$link) {
            die("Connection failed: " . mysqli_connect_error());
        }
        // Initialize selected date
        $selected_date = "";

        // Check if the form is submitted
        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['from_date']) && isset($_POST['to_date'])) {
            $from_date = $_POST['from_date'];
            $to_date = $_POST['to_date'];

            $selected_date = "Selected Date: $from_date to $to_date";

            function getWorkingDays($startDate, $endDate)
            {
                $startTimestamp = strtotime($startDate);
                $endTimestamp = strtotime($endDate);
                $workingDays = 0;

                while ($startTimestamp <= $endTimestamp) {
                    $currentDay = date("N", $startTimestamp);

                    // Check if the current day is not Saturday (6) or Sunday (7)
                    if ($currentDay < 6) {
                        $workingDays++;
                    }

                    // Move to the next day
                    $startTimestamp = strtotime("+1 day", $startTimestamp);
                }

                return $workingDays;
            }

            $query_students = "SELECT * FROM students";
            $result_students = mysqli_query($link, $query_students);

            if (!$result_students) {
                die("Query failed: " . mysqli_error($link));
            }

            echo "<p>$selected_date</p>";
            echo "<table border='1'>";
            echo "<tr>
                    <th>Sr.</th>
                    <th>Name</th>
                    <th>CNIC</th>
                    <th>Contact</th>
                    <th>Email</th>
                    <th>Total Fees</th>
                    <th>Fees Paid</th>
                    <th>Total Days</th>
                    <th>Absent Days</th>
                    
                    <th>Tasks Assigned</th>
                    <th>Tasks Done</th>
                    <th>Action</th>
                </tr>";

            $serialNo = 1; // Initialize serial number

            while ($student = mysqli_fetch_assoc($result_students)) {
                $student_id = $student['id'];

                // Calculate total working days between the selected date range
                $total_days = getWorkingDays($from_date, $to_date);

                $query_attendance = "SELECT * FROM student_attendance WHERE student_id = '$student_id' AND attendance_date BETWEEN '$from_date' AND '$to_date'";
                $result_attendance = mysqli_query($link, $query_attendance);

                if (!$result_attendance) {
                    die("Query failed: " . mysqli_error($link));
                }

                $total_absents = 0;

                while ($attendance = mysqli_fetch_assoc($result_attendance)) {
                    if ($attendance['attendance_status'] == 'Absent') {
                        $total_absents++;
                    }
                }

                // Display the form and pass parameters to the generate_report.php link
                echo "<tr>
                        <td>{$serialNo}</td>
                        <td>{$student['name']}</td>
                        <td>{$student['cnic']}</td>
                        <td>{$student['contact']}</td>
                        <td>{$student['email']}</td>
                        <td>{$student['fees']}</td>
                        <td>{$student['paid']}</td>
                        <td>$total_days</td>
                        <td>$total_absents</td>
                        <td><input type='text' id='tasks_assigned_$student_id'></td>
                        <td><input type='text' id='tasks_done_$student_id'></td>
                        <td>
                            <button onclick='generateReport($student_id, \"$from_date\", \"$to_date\")' class='buttona'>
                                Generate Report
                            </button>
                        </td>
                    </tr>";

                $serialNo++; // Increment serial number
            }

            echo "</table>";
        } else {
            echo "<form method='POST' action='{$_SERVER['PHP_SELF']}'>";
            echo "From Date: <input type='date' name='from_date' required> ";
            echo "To Date: <input type='date' name='to_date' required> ";
            echo "<input type='submit' value='Submit'>";
            echo "</form>";
        }

        mysqli_close($link);
        ?>

        <script>
            function generateReport(studentId, fromDate, toDate) {
                let tasksAssigned = document.getElementById('tasks_assigned_' + studentId).value;
                let tasksDone = document.getElementById('tasks_done_' + studentId).value;
                let url = 'generate_report.php?student_id=' + studentId + '&from_date=' + fromDate + '&to_date=' + toDate + '&tasks_assigned=' + tasksAssigned + '&tasks_done=' + tasksDone;
                window.open(url, '_blank');
            }
        </script>
    </div>
</body>


</html>
