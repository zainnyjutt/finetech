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
        $sql = "SELECT * FROM courses WHERE
            name LIKE '%$searchText%' OR
            detail LIKE '%$searchText%' OR
              gender LIKE '%$searchText%' OR
           duration LIKE '%$searchText%' OR
              fee LIKE '%$searchText%' OR
            
            tutor LIKE '%$searchText%'";

        $result = mysqli_query($conn, $sql);

        if ($result && mysqli_num_rows($result) > 0) {
            $serialNumber = 1;
            while ($row = mysqli_fetch_assoc($result)) {
                echo '<tr>';
                echo '<td>' . $serialNumber . '</td>';
                echo '<td>' . $row['name'] . '</td>';
                echo '<td>' . $row['detail'] . '</td>';
                echo '<td>' . $row['gender'] . '</td>';
                 echo '<td>' . $row['duration'] . '</td>';
                  echo '<td>' . $row['fee'] . '</td>';
                   echo '<td>' . $row['tutor'] . '</td>';
                // Add other course record fields here as needed
                echo '<td><a href="update_course.php?id=' . $row['id'] . '" class="update">Update</a></td>';
                echo '<td><a href="../controller/delete_course.php?delete_id=' . $row['id'] . '" class="delete">Delete</a></td>';
                echo '</tr>';
                $serialNumber++;
            }
        } else {
            echo '<tr><td colspan="6">No matching Course records found</td></tr>';
        }

        // Close the database connection
        mysqli_close($conn);
    }
}
?>