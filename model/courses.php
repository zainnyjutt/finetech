<?php
require_once '../controller/attempt_login.php'; // Adjust the file path accordingly
?>
  <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Course</title>
    <link rel="stylesheet" href="../view/course.css"  />
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

         .header1 {
    display: flex;
    justify-content: space-between;
    align-items: center;
    color: #f9c013;
    background-color: #133054;
    padding: 10px;
}

.search-bar1 {
    padding-left: 700px;
    display: flex;
    align-items: right;
}

.search-bar1 input {
    padding: 5px;
    border: none;
    border-radius: 5px;
    margin-right: 5px;
}

.search-bar1 button {
    background-color: #133054;
    color: #f9c013;
    border: none;
    border-radius: 5px;
    padding: 5px 10px;
    cursor: pointer;
}
.zx{
    font-size: 40px;
    font-weight: 50;
}
.attendance{
    background-color:#133054;
    color: #f9c013;
    border: none;
    padding: 10px 20px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 14px;
    border-radius: 5px;
    cursor: pointer;
    transition: background-color 0.3s;
}

.attendance:hover {
    background-color: #f9c013;
    color:#133054;
}
        </style>
</head>
<body>
    <?php
    include('sidebar.php');
    ?>
    <div class="content" >
 <div class="header1" >
    <div class="zx">COURSES</div>
    <div class="search-bar1">
        <input type="text" id="search-input" placeholder="Search...">
        <button><i class="fas fa-search"></i></button>
    </div>
</div>

    <div class="card1">
    <h3>Total Courses</h3>
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

                // Fetch total number of students from the database
                $sql = "SELECT COUNT(*) as course FROM courses";
                $result = mysqli_query($conn, $sql);

                if ($result && mysqli_num_rows($result) > 0) {
                    $row = mysqli_fetch_assoc($result);
                    echo '<p>' . $row['course'] . '</p>';
                } else {
                    echo '<p>0</p>';
                }

                // Close the database connection
                mysqli_close($conn);
                ?>
</div>

<div class="card2">
    <h3>Add Course</h3>
    <a href="add_course.php"><button  id="addCourseButton">Add Course</button></a>
</div>

      <?php
// Your PHP code for fetching student records goes here

// Define the number of students to display per page
$studentsPerPage = 5;

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


        <h1>Manage Courses</h1>
        <table class="fees-table">
            <thead>
                <tr>
                    <th>Sr.</th>
                    <th>Name</th>
                    <th>Details</th>
                    <th>Gender</th>
                    <th>Duration</th>
                    <th>Fees</th>
                    <th>Tutor</th>
                    <th>Attendance</th>
                    <th>Update</th>
                    <th>Delete</th>
                  
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

               $sql = "SELECT * FROM courses LIMIT $startRecord, $studentsPerPage";
                $result = mysqli_query($conn, $sql);

                if (mysqli_num_rows($result) > 0) {
                    $serial = 1;
                    while ($row = mysqli_fetch_assoc($result)) {
    echo "<tr>
            <td>" . $serial++ . "</td>
            <td>" . $row['name'] . "</td>
            <td>" . $row['detail'] . "</td>
            <td>" . $row['gender'] . "</td>
            <td>" . $row['duration'] . "</td>
            <td>" . $row['fee'] . "</td>
            <td>" . $row['tutor'] . "</td>
            <td>    
                <a class='attendance' href='view_course_attendance.php?course=" . $row['name'] . "'>Attendance</a> </td>

            </td>
            <td>
                <a class='update' href='update_course.php?id=" . $row['id'] . "'>Update</a> </td>
            <td>    
                <a class='delete' href='../controller/delete_course.php?id=" . $row['id'] . "'>Delete</a>
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
    $totalStudents = mysqli_query($conn, "SELECT COUNT(*) FROM courses");
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
    $('#search-input').on('input', function() {
        var searchText = $(this).val();

        // Make an AJAX request to fetch matching course records
        $.ajax({
            url: 'search/search_course.php',
            method: 'POST',
            data: { searchText: searchText },
            success: function(response) {
                // Update the table with the search results
                $('.fees-table tbody').html(response); // Use the correct class name 'fees-table'
            }
        });
    });
});


    </script>
</body>
</html>
