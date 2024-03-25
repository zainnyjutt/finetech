<?php
require_once '../controller/attempt_login.php'; // Adjust the file path accordingly
?>
  <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Employees' Salary</title>
    <link rel="stylesheet" href="../view/employee_salary.css">
           <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <style>
              /* Style for the pagination links */
.pagination {
    text-align: center;
    margin-top: 20px;
}

.pagination a {
    display: inline-block;
    padding: 5px 10px;
    background-color: #133054;
    color: #f9c013;
    text-decoration: none;
    border-radius: 5px;
    margin: 5px;
}

/* Style for the current page number */
.pagination .current-page {
    display: inline-block;
    padding: 5px 10px;
    background-color: #f9c013;
    color: #133054;
    text-decoration: none;
    border-radius: 5px;
    margin: 5px;
}

/* Style for the "Previous" and "Next" buttons */
.pagination .previous,
.pagination .next {
    padding: 5px 10px;
    background-color: #133054;
    color: #f9c013;
    text-decoration: none;
    border-radius: 5px;
    margin: 5px;
}

/* Hover effect for the buttons */
.pagination a:hover,
.pagination .previous:hover,
.pagination .next:hover {
    background-color: #f9c013;
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
    padding: 5px;
    border: none;
    border-radius: 5px;
    margin-right: 5px;
}

.search-bar button {
    background-color: #133054;
    color: #f9c013;
    border: none;
    border-radius: 5px;
    padding: 5px 10px;
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
        <h1>Manage Employees' Salary</h1>

    <div class="search-bar">
        <input type="text" id="search-input" placeholder="Search...">
        <button><i class="fas fa-search"></i></button>
    </div>
</div>
<?php
// Your PHP code for fetching student records goes here

// Define the number of students to display per page
$studentsPerPage = 10;

// Get the current page number from the query string
if (isset($_GET['page'])) {
    $currentPage = $_GET['page'];
} else {
    $currentPage = 1;
}

// Calculate the starting record number
$startRecord = ($currentPage - 1) * $studentsPerPage;

// Initialize a serial number
$serialNumber = $startRecord + 1;
?>

        <table class="fees-table">
            <thead>
                <tr>
                    <th>Sr.</th>
                    <th>Name</th>
                    <th>Department</th>
                    <th>Mobile Number</th>
                    <th>CNIC</th>

                    <th>Total Salary</th>
                    <th>Salary Paid</th>
                    <th>Remaining Salary</th>
                    <th>Action</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $host = 'localhost';
                $username = 'root';
                $password = '';
                $database = 'finetech';

                $conn = mysqli_connect($host, $username, $password, $database);

                if (!$conn) {
                    die("Connection failed: " . mysqli_connect_error());
                }

                $sql = "SELECT `id`, `name`, `department`, `contact`, `cnic`, `salary`, `paid` FROM employees LIMIT $startRecord, $studentsPerPage";
                $result = mysqli_query($conn, $sql);

                if (mysqli_num_rows($result) > 0) {
                    $serial = 1;
                    while ($row = mysqli_fetch_assoc($result)) {
                        $remaining_fees = $row['salary'] - $row['paid'];
                        echo "<tr>
                                <td>" . $serial++ . "</td>
                                <td>" . $row['name'] . "</td>
                                <td>" . $row['department'] . "</td>
                                <td>" . $row['contact'] . "</td>
                                <td>" . $row['cnic'] . "</td>
                                <td>" . $row['salary'] . "</td>
                                <td>" . $row['paid'] . "</td>
                                <td class='" . ($remaining_fees == 0 ? 'paid' : 'remaining') . "'>" . $remaining_fees . "</td>
                                <td>
                                    <a class='add-payment-button' href='employee_payment.php?id=" . $row['id'] . "'>Give Payment</a>
                                </td>
                                <td>
                                 <a class='add-payment-button' style='background-color:blue;' target='_blank' href='print_employee_fees.php?id=" . $row['id'] . "'>Print Report</a>


                                </td>
                            </tr>";
                    }
                } else {
                    echo '<tr><td colspan="8">No data available</td></tr>';
                }

                mysqli_close($conn);
                ?>
            </tbody>
        </table>
        <div class="pagination">
    <?php
    // Calculate the total number of pages
    $conn = mysqli_connect($host, $username, $password, $database);
    $totalStudents = mysqli_query($conn, "SELECT COUNT(*) FROM employees");
    $totalPages = ceil(mysqli_fetch_array($totalStudents)[0] / $studentsPerPage);

    // Display "Previous" button if not on the first page
    if ($currentPage > 1) {
        echo '<a href="?page=' . ($currentPage - 1) . '">Previous</a>';
    }

    // Display page numbers
    for ($page = 1; $page <= $totalPages; $page++) {
        if ($page == $currentPage) {
            echo '<span class="current-page">' . $page . '</span>';
        } else {
            echo '<a href="?page=' . $page . '">' . $page . '</a>';
        }
    }

    // Display "Next" button if not on the last page
    if ($currentPage < $totalPages) {
        echo '<a href="?page=' . ($currentPage + 1) . '">Next</a>';
    }
    ?>
</div>
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
    <script>
$(document).ready(function() {
    // When the search input changes
    $('#search-input').on('input', function() {
        var searchText = $(this).val();

        // Make an AJAX request to fetch matching employee salary records
        $.ajax({
            url: 'search/search_salary.php', // The URL for the search_salary.php script
            method: 'POST',
            data: { searchText: searchText },
            success: function(response) {
                // Update the table with the search results
                $('.fees-table tbody').html(response); // Update tbody content
            }
        });
    });
});
</script>

</body>
</html>
