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
        $sql = "SELECT * FROM userdata WHERE
            name LIKE '%$searchText%' OR
            cnic LIKE '%$searchText%' OR
            contact LIKE '%$searchText%' OR
            email LIKE '%$searchText%' OR
            password LIKE '%$searchText%' OR
            
             role LIKE '%$searchText%'";

        $result = mysqli_query($conn, $sql);

        if ($result && mysqli_num_rows($result) > 0) {
            $serialNumber = 1;
            while ($row = mysqli_fetch_assoc($result)) {
                echo '<tr>';
                echo '<td>' . $serialNumber . '</td>';
                echo '<td>' . $row['name'] . '</td>';
                            echo '<td>' . $row['cnic'] . '</td>';
                            echo '<td>' . $row['email'] . '</td>';
                            echo '<td>' . $row['password'] . '</td>';
                            echo '<td>' . $row['role'] . '</td>';
                        
               
                // Add other student record fields here as needed
                 echo '<td><a href="update_user.php?id=' . $row['id'] . '" class="update">Update</a></td>';
                            echo '<td><a href="../controller/delete_user.php?delete_id=' . $row['id'] . '" class="delete">Delete</a></td>';
                            echo '</tr>';
                $serialNumber++;
            }
        } else {
            echo '<tr><td colspan="9">No matching User records found</td></tr>';
        }

        // Close the database connection
        mysqli_close($conn);
    }
}
?>
