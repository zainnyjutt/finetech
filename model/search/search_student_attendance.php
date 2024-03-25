<?php 
if (isset($_POST['searchText'])) {
    $searchText = $_POST['searchText'];

    $host = 'localhost';
    $username = 'root';
    $password = '';
    $database = 'finetech';
    $conn = mysqli_connect($host, $username, $password, $database);

    if ($conn) {
        $sql = "SELECT * FROM students WHERE
            name LIKE '%$searchText%' OR
            course LIKE '%$searchText%' OR
            gender LIKE '%$searchText%' OR
            cnic LIKE '%$searchText%'"; // Add '%' for cnic search

        $result = mysqli_query($conn, $sql);

        if ($result && mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                echo '<div class="student-record">';
                echo '<p>Serial No: ' . $row['id'] . '</p>';
                echo '<p>Student Name: ' . $row['name'] . '</p>';
                echo '<p>Course Name: ' . $row['course'] . '</p>';
                echo '<p>Gender: ' . $row['gender'] . '</p>';
                echo '<p>CNIC: ' . $row['cnic'] . '</p>';
                echo '<button class="check-in" data-studentid="' . $row['id'] . '">Check-In</button>';
                echo '<button class="check-out" data-studentid="' . $row['id'] . '">Check-Out</button>';
                echo '</div>';
            }
        } else {
            echo '<p>No matching student records found</p>';
        }

        mysqli_close($conn);
    }
}
?>