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
            contact LIKE '%$searchText%' OR
            cnic LIKE '%$searchText%' OR
            fees LIKE '%$searchText%' OR
            paid LIKE '%$searchText%'";

        $result = mysqli_query($conn, $sql);

        if ($result && mysqli_num_rows($result) > 0) {
            $serialNumber = 1;
            while ($row = mysqli_fetch_assoc($result)) {
                $remaining_fees = $row['fees'] - $row['paid'];
                echo '<tr>';
                echo '<td>' . $serialNumber . '</td>';
                echo '<td>' . $row['name'] . '</td>';
                echo '<td>' . $row['course'] . '</td>';
                echo '<td>' . $row['contact'] . '</td>';
                echo '<td>' . $row['cnic'] . '</td>';
                echo '<td>' . $row['fees'] . '</td>';
                echo '<td>' . $row['paid'] . '</td>';
                echo '<td class="' . ($remaining_fees == 0 ? 'paid' : 'remaining') . '">' . $remaining_fees . '</td>';
                echo '<td><a href="student_payment.php?id=' . $row['id'] . '" class="add-payment-button">Add Payment</a></td>';
                echo '<td><a class="add-payment-button" style="background-color:blue;"   target="_blank" href="print_student_fees.php?id=' . $row['id'] . '">Print Report</a></td>';



                                
                echo '</tr>';
                $serialNumber++;
            }
        } else {
            echo '<tr><td colspan="8">No matching student fee records found</td></tr>';
        }

        mysqli_close($conn);
    }
}
?>
