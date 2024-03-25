<?php
if (isset($_POST['searchText'])) {
    $searchText = $_POST['searchText'];

    $host = 'localhost';
    $username = 'root';
    $password = '';
    $database = 'finetech';
    $conn = mysqli_connect($host, $username, $password, $database);

    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    $sql = "SELECT `id`, `name`, `department`, `contact`,`cnic`, `salary`, `paid` FROM employees WHERE
            name LIKE '%$searchText%' OR
            department LIKE '%$searchText%' OR
            contact LIKE '%$searchText%' OR
            cnic LIKE '%$searchText%' OR
            salary LIKE '%$searchText%' OR
            paid LIKE '%$searchText%'";

    $result = mysqli_query($conn, $sql);

    if ($result && mysqli_num_rows($result) > 0) {
        $serial = 1;
        while ($row = mysqli_fetch_assoc($result)) {
            $remaining_salary = $row['salary'] - $row['paid'];
            echo "<tr>
                <td>" . $serial++ . "</td>
                <td>" . $row['name'] . "</td>
                <td>" . $row['department'] . "</td>
                <td>" . $row['contact'] . "</td>
                <td>" . $row['cnic'] . "</td>
                <td>" . $row['salary'] . "</td>
                <td>" . $row['paid'] . "</td>
                <td class='" . ($remaining_salary == 0 ? 'paid' : 'remaining') . "'>" . $remaining_salary . "</td>
                <td>
                    <a class='add-payment-button' href='employee_payment.php?id=" . $row['id'] . "'>Give Payment</a>
                </td>
                <td><a class='add-payment-button' style='background-color:blue;' target='_blank' href='print_employee_fees.php?id=" . $row['id'] . "'>Print Report</a></td>


            </tr>";
        }
    } else {
        echo '<tr><td colspan="8">No matching employee salary records found</td></tr>';
    }

    mysqli_close($conn);
}
?>
