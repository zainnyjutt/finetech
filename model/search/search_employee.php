<?php
if (isset($_POST['searchText'])) {
    // Sanitize and store the search text
    $searchText = $_POST['searchText'];

    // Database connection
    $host = 'localhost';
    $username = 'root';
    $password = '';
    $database = 'finetech';
    $conn = mysqli_connect($host, $username, $password, $database);

    if ($conn) {
        // Prepare and execute a query to fetch matching employee records
        $sql = "SELECT * FROM employees WHERE
            name LIKE '%$searchText%' OR
            department LIKE '%$searchText%' OR
            email LIKE '%$searchText%' OR
            contact LIKE '%$searchText%' OR
            cnic LIKE '%$searchText%' OR
            dob LIKE '%$searchText%' OR
            doj LIKE '%$searchText%' OR
            status LIKE '%$searchText%' OR

            gender LIKE '%$searchText%' OR
            address LIKE '%$searchText%'";

        $result = mysqli_query($conn, $sql);

        if ($result && mysqli_num_rows($result) > 0) {
            $serialNumber = 1;
            while ($row = mysqli_fetch_assoc($result)) {
                echo '<tr>';
                echo '<td>' . $serialNumber . '</td>';
               echo '<td>' . $row['name'] . '</td>';
                    echo '<td>' . $row['department'] . '</td>';
                    echo '<td>' . $row['email'] . '</td>';
                    echo '<td>' . $row['contact'] . '</td>';
                    echo '<td>' . $row['cnic'] . '</td>';
                    echo '<td>' . $row['status'] . '</td>';
                    echo '<td>' . $row['gender'] . '</td>';
                    echo '<td><a href="view_employee_details.php?id=' . $row['id'] . '" style="background-color:green; padding:13px;">View Details</a></td>';
                // Add other employee record fields here as needed
                echo '<td><a href="update_employee.php?id=' . $row['id'] . '" class="update">Update</a></td>';
                echo '<td><a href="../controller/delete_employee.php?delete_id=' . $row['id'] . '" class="delete">Delete</a></td>';
                echo '</tr>';
                $serialNumber++;
            }
        } else {
            echo '<tr><td colspan="9">No matching Employees records found</td></tr>';
        }

        // Close the database connection
        mysqli_close($conn);
    }
}
?>
