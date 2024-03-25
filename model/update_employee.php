<?php
require_once '../controller/attempt_login.php'; // Adjust the file path accordingly
?>
  <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Employee Registration</title>
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

    $sql = "SELECT * FROM employees WHERE id = $id";
    $result = mysqli_query($conn, $sql);

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $id = $row['id'];
        $name = $row['name'];
        $department = $row['department'];
        $salary = $row['salary'];
        $email = $row['email'];
        $contact = $row['contact'];
        $cnic = $row['cnic'];
        $dob = $row['dob'];
        $doj = $row['doj'];
        $status = $row['status'];
        $status_date = $row['dol'];
        $gender = $row['gender'];
        $address = $row['address'];
        $image = $row['image'];
    } else {
        echo "Employee not found.";
        exit;
    }
    ?>

    <section class="container">
        <header>Employee Form</header>
        <form action="../controller/update_employee.php" method="POST" class="form" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?php echo $id; ?>">

            <div class="input-box">
                <label for="full_name">Full Name</label>
                <input type="text" id="full_name" name="full_name" value="<?php echo $name; ?>" placeholder="Enter full name" required />
            </div>
             <div class="input-box">
                <label for="employee_image">Update Employee Image</label>
                <input type="file" id="employee_image" name="employee_image" accept="image/*" onchange="previewImage(event)" />
                <img id="image_preview" src="<?php echo $image; ?>" alt="Preview" style="max-width: 100px; max-height: 100px; display: <?php echo $image ? 'block' : 'none'; ?>" />
            </div>

            <div class="input-box">
                <label for="department">Department</label>
                <select id="department" name="department" required>
                    <?php
                    // Fetch department options from the database
                    $sql = "SELECT name FROM courses"; // Assuming 'name' is the column name
                    $result = mysqli_query($conn, $sql);

                    if (mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            $departmentName = $row['name'];
                            $selected = ($departmentName === $department) ? 'selected' : '';
                            echo "<option value='$departmentName' $selected>$departmentName</option>";
                        }
                    } else {
                        echo '<option value="" disabled>No departments available</option>';
                    }
                    ?>
                </select>
            </div>
            <div class="column">
                <div class="input-box">
                    <label for="phone_number">Salary</label>
                    <input type="number" id="phone_number" name="salary" value="<?php echo $salary; ?>" placeholder="Enter Salary" required />
                </div>

            <div class="input-box">
                <label for="email">Email Address</label>
                <input type="text" id="email" name="email" value="<?php echo $email; ?>" placeholder="Enter email address" required />
            </div>

            <div class="column">
                <div class="input-box">
                    <label for="phone_number">Phone Number</label>
                    <input type="text" id="phone_number" name="phone_number" value="<?php echo $contact; ?>" placeholder="Enter phone number" required />
                </div>
                 <div class="input-box">
                    <label for="cnic">CNIC Number</label>
                    <input type="text" id="phone_number" name="cnic" value="<?php echo $cnic; ?>" placeholder="Enter CNIC number" required />
                </div>
                <div class="input-box">
                    <label for="birth_date">Birth Date</label>
                    <input type="date" id="birth_date" name="dob" value="<?php echo $dob; ?>" required />

                </div>
                 <div class="input-box">
                    <label for="joining_date">Joining Date</label>
                    <input type="date" id="joining_date" name="doj" value="<?php echo $doj; ?>" required />

                </div>
            </div>
             <div class="input-box">
                <label for="student_status">Employee Status</label>
                <select id="student_status" name="status" required>
                    <option value="select_status" disabled>Select Status</option>
                    <option value="Joined" <?php echo ($status === 'Joined') ? 'selected' : ''; ?>>Joined</option>
                    <option value="Left" <?php echo ($status === 'Left') ? 'selected' : ''; ?>>Left</option>
                    <option value="Dropped" <?php echo ($status === 'Dropped') ? 'selected' : ''; ?>>Dropped</option>
                    <option value="Transferred" <?php echo ($status === 'Transferred') ? 'selected' : ''; ?>>Transferred</option>
                    <option value="Other" <?php echo ($status === 'Other') ? 'selected' : ''; ?>>Other</option>
                </select>
            </div>

            <div id="otherStatusDate" class="input-box" style="display: <?php echo ($status !== 'Joined') ? 'block' : 'none'; ?>;">
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
                <input type="text" id="street_address" name="street_address" value="<?php echo $address; ?>" placeholder="Enter street address" required />
            </div>

            <button type="submit">Submit</button>
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
        <script type="text/javascript">
        document.getElementById('student_status').addEventListener('change', function () {
            var otherStatusDateBox = document.getElementById('otherStatusDate');
            if (this.value !== 'Joined') {
                otherStatusDateBox.style.display = 'block';
            } else {
                otherStatusDateBox.style.display = 'none';
            }
        });
    </script>
</body>
</html>
