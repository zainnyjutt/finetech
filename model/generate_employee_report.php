<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Report</title>
    <style>
        body {
            background-color: #ffffff;
            color: #133054;
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
            min-height: 100vh;
        }

        .header,
        .footer {
            position: fixed;
            width: 100%;
            background-color: #133054;
            color: #f9c013;
            padding: 10px;
            text-align: center;
            z-index: 1; /* Ensure the header and footer appear above other elements */
        }

        .header {
            top: 0;
        }

        .footer {
            bottom: 0;
        }

        .content1 {
            background-color: #ffffff;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border: 2px solid #133054;
            width: 78%;
            box-sizing: border-box;
            text-align: left;
            margin-left: 306px;
                   }

        h1 {
            color: #f9c013;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th,
        td {
            border: 1px solid #133054;
            padding: 10px;
            text-align: left;
        }

        button {
            background-color: #f9c013;
            color: #133054;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            margin-top: 20px;
        }

        button:hover {
            background-color: #133054;
            color: #ffffff;
        }

        .sidebar {
            
            width: 100px;
            background-color: #133054;
            color: #f9c013;
            padding: 20px;
            position: fixed;
            height: 100%;
            top: 0;
            left: 0;
        }
        .footer{
            visibility:hidden;
        }
        .header{
            visibility: hidden;
        }

        @media print {
            body > * {
                visibility: hidden;
            }

            .header,
            .footer,
            .content1,
            .content1 * {
                visibility: visible;
            }

            .no-print,
            .sidebar {
                display: none;
            }

            .content1 {
                position: static;
                left: auto;
                top: auto;
                width: 100%;
                margin-left: 0;
            }
        }
           .header111 {
            display: flex;
            justify-content: space-between;
            align-items: center;
            color: #f9c013;
            background-color: #133054;
            padding: 35px;
            width: 74%;
            margin-left: 306px;
            margin-top: 20px;
        }
    </style>
</head>

<body>
  

    <?php
    // Include the sidebar only for the original page, not for printing
    if (!isset($_GET['employee_id'])) {
        include('sidebar.php');
    }
    ?>

    <div class="header">
        <h1>FINETECH SOFTWARE HOUSE AND IT TRAINING CENTER</h1>
    </div>
    <div class="footer">
        <p>GOD BLESS YOU!</p>
    </div>
  
  <?php
include('sidebar.php');
    ?>

  <h1 class="header111">EMPLOYEE REPORT</h1>
    <div class="content1">
      

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

        // Check if the necessary parameters are present in the URL
        if (
            isset($_GET['employee_id']) &&
            isset($_GET['from_date']) &&
            isset($_GET['to_date']) &&
            isset($_GET['tasks_assigned']) &&
            isset($_GET['tasks_done'])
        ) {
            $employee_id = $_GET['employee_id'];
            $from_date = $_GET['from_date'];
            $to_date = $_GET['to_date'];
            $selected_date = " Date: From $from_date to $to_date";

            // Retrieve employee and attendance details from the database
            $query_employee = "SELECT * FROM employees WHERE id = '$employee_id'";
            $result_employee = mysqli_query($link, $query_employee);

            $query_attendance = "SELECT * FROM employee_attendance WHERE employee_id = '$employee_id' AND attendance_date BETWEEN '$from_date' AND '$to_date'";
            $result_attendance = mysqli_query($link, $query_attendance);

            if (!$result_employee || !$result_attendance) {
                die("Query failed: " . mysqli_error($link));
            }

            $employee = mysqli_fetch_assoc($result_employee);

            // Calculate total working days and absents
            $startTimestamp = strtotime($from_date);
            $endTimestamp = strtotime($to_date);
            $workingDays = 0;
            $total_absents = 0;

            while ($startTimestamp <= $endTimestamp) {
                $currentDay = date("N", $startTimestamp);

                // Check if the current day is not Saturday (6) or Sunday (7)
                if ($currentDay < 6) {
                    $workingDays++;
                }

                // Check for absents
                $query_absent = "SELECT * FROM employee_attendance WHERE employee_id = '$employee_id' AND attendance_date = '" . date("Y-m-d", $startTimestamp) . "' AND attendance_status = 'Absent'";
                $result_absent = mysqli_query($link, $query_absent);

                if (!$result_absent) {
                    die("Query failed: " . mysqli_error($link));
                }

                if (mysqli_num_rows($result_absent) > 0) {
                    $total_absents++;
                }

                // Move to the next day
                $startTimestamp = strtotime("+1 day", $startTimestamp);
            }

            // Display the detailed report
            echo "<p>$selected_date</p>";
            echo "<h2 class='print-style'>Employee REPORT for {$employee['name']}</h2>";
            echo "<p>CNIC: {$employee['cnic']}</p>";
            echo "<p>E-MAIL: {$employee['email']}</p>";
            echo "<p>TOTAL SALARY: {$employee['salary']}</p>";
            echo "<p>SALARY PAID: {$employee['paid']}</p>";
            echo "<p>CONTACT: {$employee['contact']}</p>";
            echo "<p>TOTAL DAYS: $workingDays</p>";
            echo "<p>TOTAL ABSENTS: $total_absents</p>";

            // Retrieve tasks_assigned and tasks_done from the URL
            $tasks_assigned = $_GET['tasks_assigned'];
            $tasks_done = $_GET['tasks_done'];

            // Display tasks assigned and done
            echo "<p>TASKS ASSIGNED: $tasks_assigned</p>";
            echo "<p>TASKS DONE: $tasks_done</p>";

            // Include a print button
            echo "<button onclick='window.print()' class='buttona no-print'>Print Report</button>";
        } else {
            echo "Invalid request.";
        }

        mysqli_close($link);
        ?>
        <button onclick="exportToExcel()" class="buttona no-print">Export to Excel</button>


    </div>
    <script>
    function exportToExcel() {
        // Redirect to the download_excel.php script with necessary parameters
        window.location.href = 'download_employee_excel.php' + window.location.search;
    }
</script>
</body>

</html>
