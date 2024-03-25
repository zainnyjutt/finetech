<?php
require_once '../controller/attempt_login.php'; // Adjust the file path accordingly
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Student Registration</title>
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

    $sql = "SELECT * FROM students WHERE id = $id";
    $result = mysqli_query($conn, $sql);

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $id = $row['id'];
        $name = $row['name'];
        $course = $row['course'];
        $fees = $row['fees'];
        $email = $row['email'];
        $contact = $row['contact'];
        $cnic = $row['cnic'];
        $dob = $row['dob'];
        $doa = $row['doa'];
        $gender = $row['gender'];
        $address = $row['address'];
        $status = $row['status'];
        $status_date = $row['doc'];
        $image = $row['image'];
    } else {
        echo "Student not found.";
        exit;
    }
    ?>

    <section class="container">
        <header>Update Student Form</header>

        <form action="../controller/update_students.php" method="POST" class="form" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?php echo $id; ?>">

            <div class="input-box">
                <label for="full_name">Full Name</label>
                <input type="text" id="full_name" name="name" value="<?php echo $name; ?>" placeholder="Enter full name" required />
            </div>

            <!-- Add input field for updating the image -->
            <div class="input-box">
                <label for="student_image">Update Student Image</label>
                <input type="file" id="student_image" name="student_image" accept="image/*" onchange="previewImage(event)" />
                <img id="image_preview" src="<?php echo $image; ?>" alt="Preview" style="max-width: 100px; max-height: 100px; display: <?php echo $image ? 'block' : 'none'; ?>" />
            </div>

            <div class="input-box">
                <label for="course">Course</label>
                <select id="course" name="course" required>
                    <?php

                    // Fetch course options from the database
                    $sql = "SELECT name FROM courses"; // Assuming 'name' is the column name
                    $result = mysqli_query($conn, $sql);

                    if (mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            $courseName = $row['name'];
                            echo '<option value="' . $courseName . '" ' . ($course === $courseName ? 'selected' : '') . '>' . $courseName . '</option>';
                        }
                    } else {
                        echo '<option value="" disabled>No courses available</option>';
                    }
                    ?>
                </select>
            </div>

            </div>
         <div class="input-box">
                <label for="fees">Course Fees</label>
                <input type="number" id="fees" name="fees" value="<?php echo $fees; ?>" placeholder="Enter Course Fees" required />
            </div>

            <div class="input-box">
                <label for="email">Email Address</label>
                <input type="text" id="email" name="email" value="<?php echo $email; ?>" placeholder="Enter email address" required />
            </div>

            <div class="input-box">
                <label for="contact">Phone Number</label>
                <input type="text" id="phone_number" name="contact" value="<?php echo $contact; ?>" placeholder="Enter phone number" required />
            </div>

            <div class="input-box">
                <label for="cnic_number">CNIC Number</label>
                <input type="text" id="cnic_number" name="cnic" value="<?php echo $cnic; ?>" placeholder="Enter CNIC number" required maxlength="13" />
            </div>

            <div class="input-box">
                <label for="birth_date">Birth Date</label>
                <input type="date" id="birth_date" name="dob" value="<?php echo $dob; ?>" required />
            </div>

            <div class="input-box">
                <label for="admission_date">Admission Date</label>
                <input type="date" id="admission_date" name="doa" value="<?php echo $doa; ?>" required />
            </div>
              <div class="input-box">
                <label for="student_status">Student Status</label>
                <select id="student_status" name="status" required>
                    <option value="select_status" disabled>Select Status</option>
                    <option value="Enrolled" <?php echo ($status === 'Enrolled') ? 'selected' : ''; ?>>Enrolled</option>
                    <option value="Completed" <?php echo ($status === 'Completed') ? 'selected' : ''; ?>>Completed</option>
                    <option value="Dropped" <?php echo ($status === 'Dropped') ? 'selected' : ''; ?>>Dropped</option>
                    <option value="Transferred" <?php echo ($status === 'Transferred') ? 'selected' : ''; ?>>Transferred</option>
                    <option value="Other" <?php echo ($status === 'Other') ? 'selected' : ''; ?>>Other</option>
                </select>
            </div>

            <div id="otherStatusDate" class="input-box" style="display: <?php echo ($status !== 'Enrolled') ? 'block' : 'none'; ?>;">
                <label for="other_status_date">Leaving Date</label>
                <input type="date" id="other_status_date" name="doc" value="<?php echo $status_date; ?>" />
            </div>


            <div class="gender-box">
                <h3>Gender</h3>
                <div class="gender-option">
                    <div class="gender">
                        <input type="radio" id="male" name="gender" value="Male" <?php echo ($gender === 'Male') ? 'checked' : ''; ?> />
                        <label for="male">Male</label>
                    </div>
                    <div class="gender">
                        <input type="radio" id="female" name="gender" value="Female" <?php echo ($gender === 'Female') ? 'checked' : ''; ?> />
                        <label for="female">Female</label>
                    </div>
                    <div class="gender">
                        <input type="radio" id="other" name="gender" value="Prefer not to say" <?php echo ($gender === 'Prefer not to say') ? 'checked' : ''; ?> />
                        <label for="other">Prefer not to say</label>
                    </div>
                </div>
            </div>

            <div class="input-box address">
                <label for="street_address">Address</label>
                <input type="text" id="street_address" name="address" value="<?php echo $address; ?>" placeholder="Enter street address" required />
            </div>

            <button type="submit">Update</button>
        </form>
    </section>

    <script>
        function previewImage(event) {
            var input = event.target;
            var preview = document.getElementById('image_preview');

            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    preview.src = e.target.result;
                    preview.style.display = 'block';
                };

                reader.readAsDataURL(input.files[0]);
            } else {
                preview.src = '<?php echo $image; ?>';
                preview.style.display = 'none';
            }
        }
    </script>
</body>

</html>
