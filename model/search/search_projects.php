<?php
if (isset($_POST['searchText'])) {
    $searchText = $_POST['searchText'];

    // Database connection
    $host = 'localhost';
    $username = 'root';
    $password = '';
    $database = 'finetech';

    $conn = mysqli_connect($host, $username, $password, $database);

    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Fetch project records from the database and populate the cards
    $sql = "SELECT id, name, description, author, link FROM projects WHERE
            name LIKE '%$searchText%' OR
            description LIKE '%$searchText%' OR
            author LIKE '%$searchText%'";

    $result = mysqli_query($conn, $sql);

    if ($result && mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            echo '<div class="card">';
            echo '<h2>' . $row['name'] . '</h2>';
            echo '<p>' . $row['description'] . '</p>';
            echo '<p>Author: ' . $row['author'] . '</p>';
            echo '<a  href="' . $row['link'] . '" target="_blank" class="view">View Project</a>';
            
            // Add the Delete Project button with a link to the delete_project.php script
            echo '<a href="../controller/delete_project.php?id=' . $row['id'] . '" class="delete">Delete Project</a>';
            
            echo '</div>';
        }
    } else {
        echo '<p>No matching projects found</p>';
    }

    // Close the database connection
    mysqli_close($conn);
}
?>
