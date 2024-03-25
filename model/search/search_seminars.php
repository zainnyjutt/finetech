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
        $sql = "SELECT * FROM seminars WHERE
            name LIKE '%$searchText%' OR
            date LIKE '%$searchText%' OR
            time LIKE '%$searchText%' OR
            location LIKE '%$searchText%' OR
            cheif_guest LIKE '%$searchText%' OR
             description LIKE '%$searchText%'";

        $result = mysqli_query($conn, $sql);

        if ($result && mysqli_num_rows($result) > 0) {
            $serialNumber = 1;
            while ($row = mysqli_fetch_assoc($result)) {
                echo '<tr>';
                echo '<td>' . $serialNumber . '</td>';
                echo '<td>' . $row['name'] . '</td>';
                            echo '<td>' . $row['date'] . '</td>';
                            echo '<td>' . $row['time'] . '</td>';
                            echo '<td>' . $row['location'] . '</td>';
                            echo '<td>' . $row['description'] . '</td>';
                            echo '<td>' . $row['invites'] . '</td>';
                            echo '<td>' . $row['present'] . '</td>';
                            echo '<td>' . $row['cheif_guest'] . '</td>';
               
                // Add other student record fields here as needed
                 echo '<td><a href="update_seminar.php?id=' . $row['id'] . '" class="update">Update</a></td>';
                            echo '<td><a href="../controller/delete_seminar.php?delete_id=' . $row['id'] . '" class="delete">Delete</a></td>';
                            echo '</tr>';
                $serialNumber++;
            }
        } else {
            echo '<tr><td colspan="9">No matching Seminar records found</td></tr>';
        }

        // Close the database connection
        mysqli_close($conn);
    }
}
?>
