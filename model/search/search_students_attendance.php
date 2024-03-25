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
        $sql = "SELECT * FROM student_attendance WHERE
            name LIKE '%$searchText%' OR
            course LIKE '%$searchText%' OR
           
            cnic LIKE '%$searchText%' OR
          
            gender LIKE '%$searchText%' OR
            attendance_status LIKE '%$searchText%'";

        $result = mysqli_query($conn, $sql);

        if ($result && mysqli_num_rows($result) > 0) {
            $serialNumber = 1;
            while ($row = mysqli_fetch_assoc($result)) {
                echo '<tr>';
                echo '<td>' . $serialNumber . '</td>';
                echo '<td>' . $row['name'] . '</td>';
                echo '<td>' . $row['course'] . '</td>';
            
                echo '<td>' . $row['cnic'] . '</td>';
               
                echo '<td>' . $row['gender'] . '</td>';
                echo '<td>' . $row['attendance_status'] . '</td>';

                // Add other student record fields here as needed
               
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
