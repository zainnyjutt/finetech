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
        // Prepare and execute a query to fetch matching student records
        $sql = "SELECT * FROM students WHERE
            name LIKE '%$searchText%' OR
            course LIKE '%$searchText%' OR
            email LIKE '%$searchText%' OR
            contact LIKE '%$searchText%' OR
            cnic LIKE '%$searchText%' OR
            dob LIKE '%$searchText%' OR
            doa LIKE '%$searchText%' OR
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
                    echo '<td>' . $row['course'] . '</td>';
                    echo '<td>' . $row['email'] . '</td>';
                    echo '<td>' . $row['contact'] . '</td>';
                    echo '<td>' . $row['cnic'] . '</td>';
                    echo '<td>' . $row['status'] . '</td>';
                    echo '<td>' . $row['gender'] . '</td>';
                // Add other student record fields here as needed
                    echo '<td><a href="view_student_details.php?id=' . $row['id'] . '" style="background-color:green; padding:15px;">View Details</a></td>';
                echo '<td><a href="update_students.php?id=' . $row['id'] . '" class="update">Update</a></td>';
                echo '<td><a href="../controller/delete_student.php?delete_id=' . $row['id'] . '" class="delete">Delete</a></td>';
                echo '</tr>';
                $serialNumber++;
            }
        } else {
            echo '<tr><td colspan="9">No matching student records found</td></tr>';
        }

        // Close the database connection
        mysqli_close($conn);
    }
}
?>
