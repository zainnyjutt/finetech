<?php
include('../db/db.php');

if (isset($_GET['query'])) {
    $query = $conn->real_escape_string($_GET['query']);
    $sql = "SELECT name, description FROM projects WHERE name LIKE '%$query%' OR description LIKE '%$query%'";

    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        echo "<table>";
        echo "<tr><th>Name</th><th>Description</th></tr>";

        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>{$row['name']}</td>";
            echo "<td>{$row['description']}</td>";
            echo "</tr>";
        }

        echo "</table>";
    } else {
        echo "No results found.";
    }
}
$conn->close();
?>
