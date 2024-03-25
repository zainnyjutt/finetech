<?php
require_once '../controller/attempt_login.php'; // Adjust the file path accordingly
?>
  <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Campuses-FineTech</title>
    <link rel="stylesheet" href="../view/students.css">
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
        .attendance{
    background-color:#133054;
    color: #f9c013;
    border: none;
    padding: 15px;
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
    <?php include('sidebar.php'); ?>

    <div class="content">
        <div class="header">
            <h1>Campuses</h1>
            <div class="search-bar">
                <input type="text" id="search-input" placeholder="Search...">
                <button><i class="fas fa-search"></i></button>
            </div>
        </div>
        
        <!-- The rest of your HTML content here -->
        <div class="card-container">
            <div class="card">
                <h2>Total Campuses</h2>
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
                $sql = "SELECT COUNT(*) as total_students FROM Campus";
                $result = mysqli_query($conn, $sql);

                if ($result && mysqli_num_rows($result) > 0) {
                    $row = mysqli_fetch_assoc($result);
                    echo '<p>' . $row['total_students'] . '</p>';
                } else {
                    echo '<p>0</p>';
                }

                // Close the database connection
                mysqli_close($conn);
                ?>
            </div>

            <div class="card">
                <h2>Add Campus</h2>
                <a href="add_campus.php">Add Campus</a>
            </div>

            <!-- Add more cards or features as needed -->
        </div>
        <?php
        // Your PHP code for fetching student records goes here

        // Initialize a serial number
        $serialNumber = 10;
        ?>
        <div class="student-table">
            </br>
        </br>
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
            <table>
                <thead>
                    <tr>
                        <th>Sr.</th>
                        <th>Name</th>
                        <th>Contact</th>
                        <th>Email</th>
                        <th>Location</th>
                        <th>View</th>
                        <th>Update</th>
                        <th>Delete</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Fetch student records from the database and populate the table
                    $conn = mysqli_connect($host, $username, $password, $database);

                    if (!$conn) {
                        die("Connection failed: " . mysqli_connect_error());
                    }

                    $sql = "SELECT * FROM campus LIMIT $startRecord, $studentsPerPage";
                    $result = mysqli_query($conn, $sql);

                    if ($result && mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_assoc($result)) {
    echo '<tr>';
    echo '<td>' . $serialNumber . '</td>';
    echo '<td>' . $row['name'] . '</td>';
    echo '<td>' . $row['contact'] . '</td>';
    echo '<td>' . $row['email'] . '</td>';
    echo '<td>' . $row['address'] . '</td>';
    
    // Display the link as a button named "View Campus"
    echo '<td ><a href="' . $row['link'] . '"  class="attendance" target="_blank">View Campus</a></td>';

    // Add Delete and Update buttons with links to corresponding PHP scripts
    echo '<td><a href="update_campus.php?id=' . $row['id'] . '" class="update">Update</a></td>';
    echo '<td><a href="../controller/delete_campus.php?delete_id=' . $row['id'] . '" class="delete">Delete</a></td>';
    echo '</tr>';
    $serialNumber++;
}

                    } else {
                        echo '<tr><td colspan="4">No Campus records found!</td></tr>';
                    }

                    // Close the database connection
                    mysqli_close($conn);
                    ?>
                </tbody>
            </table>
        </div>
          <div class="pagination">
    <?php
    // Calculate the total number of pages
    $conn = mysqli_connect($host, $username, $password, $database);
    $totalStudents = mysqli_query($conn, "SELECT COUNT(*) FROM seminars");
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
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>

        <!-- Add a container for live search results -->
        <div id="live-search-results"></div>
    

    <?php include('footer.php'); ?>
</div>
    <!-- JavaScript for live search -->
<!-- JavaScript for live search -->
    <script>
        // When the search input changes
        $(document).ready(function() {
            $('#search-input').on('input', function() {
                var searchText = $(this).val();

                // Make an AJAX request to fetch matching student records
                $.ajax({
                    url: 'search/search_campus.php',
                    method: 'POST',
                    data: { searchText: searchText },
                    success: function(response) {
                        // Update the table with the search results
                        $('.student-table tbody').html(response);
                    }
                });
            });
        });
    </script>

</body>
</html>
