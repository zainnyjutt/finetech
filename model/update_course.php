<?php
require_once '../controller/attempt_login.php'; // Adjust the file path accordingly
?>
  <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Course</title>
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

    $sql = "SELECT * FROM courses WHERE id = $id";
    $result = mysqli_query($conn, $sql);

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $id = $row['id'];
        $name = $row['name'];
        $detail = $row['detail'];
        $gender = $row['gender'];
        $duration = $row['duration'];
        $fee = $row['fee'];
        $tutor = $row['tutor'];
    } else {
        echo "Course not found.";
        exit;
    }
    ?>

    <section class="container">
        <header>Update Course</header>
        <form action="../controller/update_course.php" method="POST" class="form">
            <input type="hidden" name="id" value="<?php echo $id; ?>">

            <div class="input-box">
                <label for="full_name">Course Name</label>
                <input type="text" id="full_name" name="name" value="<?php echo $name; ?>" placeholder="Enter Course name" required />
            </div>

            <div class="input-box">
                <label for="email">Details</label>
                <input type="text" id="email" name="detail" value="<?php echo $detail; ?>" placeholder="Enter Course Details" required />
            </div>

            <div class="gender-box">
                <h3>For Gender</h3>
                <div class="gender-option">
                    <div class="gender">
                        <input type="radio" id="male" name="gender" value="Male only" <?php echo ($gender === 'Male only') ? 'checked' : ''; ?> checked />
                        <label for="male">Male</label>
                    </div>
                    <div class="gender">
                        <input type="radio" id="female" name="gender" value="Female only" <?php echo ($gender === 'Female only') ? 'checked' : ''; ?> />
                        <label for="female">Female</label>
                    </div>
                    <div class="gender">
                        <input type="radio" id="other" name="gender" value="Male & Female both" <?php echo ($gender === 'Male & Female both') ? 'checked' : ''; ?> />
                        <label for="other">Male & Female</label>
                    </div>
                </div>
            </div>

            <div class="input-box">
                <label for="duration">Duration</label>
                <select id="duration" name="duration">
                    <option value="One Month" <?php echo ($duration === 'One Month') ? 'selected' : ''; ?>>One Month</option>
                    <option value="Two Months" <?php echo ($duration === 'Two Months') ? 'selected' : ''; ?>>Two Months</option>
                    <option value="Three Months" <?php echo ($duration === 'Three Months') ? 'selected' : ''; ?>>Three Months</option>
                    <option value="Six Months" <?php echo ($duration === 'Six Months') ? 'selected' : ''; ?>>Six Months</option>
                </select>
            </div>

            <div class="column">
                <div class="input-box">
                    <label for="fee">Fees</label>
                    <input type="number" id="fee" name="fee" value="<?php echo $fee; ?>" placeholder="Enter Course Fees" required />
                </div>

                <div class="input-box address">
                    <label for="tutor">Tutor</label>
                    <input type="text" id="tutor" name="tutor" value="<?php echo $tutor; ?>" placeholder="Enter Tutor Name" required />
                </div>
            </div>
            <button type="submit">Submit</button>
        </form>
    </section>
</body>
</html>
