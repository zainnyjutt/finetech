<?php
require_once '../controller/attempt_login.php'; // Adjust the file path accordingly
?>
  <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Campus</title>
    <!-- Link to separate CSS file -->
    <link rel="stylesheet" href="../view/student_form.css">
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

    $sql = "SELECT * FROM campus WHERE id = $id";
    $result = mysqli_query($conn, $sql);

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $id = $row['id'];
        $name = $row['name'];
        $detail = $row['contact'];
        $gender = $row['email'];
        $duration = $row['address'];
        $link = $row['link'];
        
    } else {
        echo "Course not found.";
        exit;
    }
    ?>

    <section class="container">
        <header>Update Course</header>
        <form action="../controller/update_campus.php" method="POST" class="form">
            <input type="hidden" name="id" value="<?php echo $id; ?>">

             <div class="input-box">
                <label for="full_name">Campus Name</label>
                <input type="text" id="full_name" name="full_name" value="<?php echo $name; ?>" placeholder="Enter Campus name" required />
            </div>

            <div class="input-box">
                <label for="email">Contact</label>
                <input type="number" id="email" name="email" value="<?php echo $detail; ?>" placeholder="Enter Contact Detalis" required />
            </div>

       
            <div class="column">
                <div class="input-box">
                    <label for="phone_number">Email</label>
                    <input type="text" id="phone_number" name="phone_number" value="<?php echo $gender; ?>" placeholder="Enter E-Mail" required />
                </div>
                
            <div class="input-box address">
                <label for="street_address">Address</label>
                <input type="text" id="street_address" name="street_address" value="<?php echo $duration; ?>" placeholder="Enter Address" required />
            </div>
            <div class="input-box address">
                <label for="street_address">Link</label>
                <input type="text" id="street_address" name="link" value="<?php echo $link; ?>" placeholder="Enter Link " required />
            </div>
            <button type="submit">Submit</button>
        </form>
    </section>
</body>
</html>
