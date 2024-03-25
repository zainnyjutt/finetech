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
        // Prepare and execute a query to fetch matching course records
        $sql = "SELECT * FROM campus WHERE
            name LIKE '%$searchText%' OR
            contact LIKE '%$searchText%' OR
              email LIKE '%$searchText%' OR
            
              
            address LIKE '%$searchText%'";

        $result = mysqli_query($conn, $sql);

        if ($result && mysqli_num_rows($result) > 0) {
            $serialNumber = 1;
            while ($row = mysqli_fetch_assoc($result)) {
                echo '<tr>';
                echo '<td>' . $serialNumber . '</td>';
                echo '<td>' . $row['name'] . '</td>';
                echo '<td>' . $row['contact'] . '</td>';
                echo '<td>' . $row['email'] . '</td>';
                 echo '<td>' . $row['address'] . '</td>';
                echo '<td ><a href="' . $row['link'] . '"  class="attendance" target="_blank">View Campus</a></td>';
                // Add other course record fields here as needed
                echo '<td><a href="update_campus.php?id=' . $row['id'] . '" class="update">Update</a></td>';
                echo '<td><a href="../controller/delete_campus.php?delete_id=' . $row['id'] . '" class="delete">Delete</a></td>';
                echo '</tr>';
                $serialNumber++;
            }
        } else {
            echo '<tr><td colspan="6">No matching Campus records found</td></tr>';
        }

        // Close the database connection
        mysqli_close($conn);
    }
}
?>