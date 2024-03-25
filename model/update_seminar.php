<?php
require_once '../controller/attempt_login.php'; // Adjust the file path accordingly
?>
  <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Seminar Registration</title>
    <!-- Link to separate CSS file -->
    <link rel="stylesheet" href="../view/add_seminar.css">
</head>
<body>
<?php
// Database connection
    $host = 'localhost';
    $username = 'root';
    $password = '';
    $database = 'finetech';

    $conn = mysqli_connect($host, $username, $password, $database);

    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    $id = $_GET['id'];

    $sql = "SELECT * FROM seminars WHERE id = $id";
    $result = mysqli_query($conn, $sql);

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $id = $row['id'];
        $name = $row['name'];
        $course = $row['date'];
        $fees = $row['time'];
        $email = $row['location'];
        $contact = $row['description'];
        $invites = $row['invites'];
        $present = $row['present'];
        $guest = $row['cheif_guest'];
      
    } else {
        echo "Seminar not found.";
        exit;
    }
    ?>

    <section class="container">
        <header>Update Seminar</header>
        <form action="../controller/update_seminar.php" method="POST" class="form">
        <input type="hidden" name="id" value="<?php echo $id; ?>">
            <div class="input-box">
                <label for="name">Name</label>
                <input type="text" id="full_name" value="<?php echo $name; ?>" name="name" placeholder="Enter Name" required />
            </div>
            <!-- ... (previous form fields) ... -->
          
            <div class="input-box">
                    <label for="date">Date</label>
                    <input type="date" id="birth_date" value="<?php echo $course; ?>" name="date" placeholder="Enter Date" required />
                </div>
            <div class="input-box">
                <label for="time">Time</label>
                <input type="time" id="email" name="time" value="<?php echo $fees; ?>" placeholder="Enter Time" required />
            </div>
            <div class="column">
                <div class="input-box">
                    <label for="address">Address</label>
                    <input type="text" id="phone_number" value="<?php echo $email; ?>" name="address" placeholder="Enter Address" required />
                </div>
                <div class="input-box">
                    <label for="description">Description</label>
                    <input type="text" id="birth_date" value="<?php echo $contact; ?>" name="dob" placeholder="Enter Details" required />
                </div>
                <div class="input-box">
                    <label for="total_invites">Total Invites</label>
                    <input type="number" id="invites" name="invites" value="<?php echo $invites; ?>" placeholder="Enter Total Invites" required />
                </div>
                <div class="input-box">
                    <label for="present">Total Attendance</label>
                    <input type="number" id="preset" name="present" value="<?php echo $present; ?>" placeholder="Enter Present Number" required />
                </div>
                <div class="input-box">
                    <label for="guest">Cheif Guest</label>
                    <input type="text" id="guest" name="guest" value="<?php echo $guest; ?>" placeholder="Enter Cheif Guest Name" required />
                </div>
            </div>
           
            <button type="submit">Submit</button>
        </form>
    </section>
</body>
</html>
