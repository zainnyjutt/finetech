<?php
require_once '../controller/attempt_login.php'; // Adjust the file path accordingly
?>
  <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Registration</title>
    <!-- Link to separate CSS file -->
    <link rel="stylesheet" href="../view/student_form.css">
    <style>
    .phone-input {
        width: 40%;
        display: flex;
        align-items: center;
    }

    .phone-input select,
    .phone-input input {
        margin-right: 10px; /* Adjust as needed for spacing */
    }
</style>
</head>
<body>
    <section class="container">
        <header>Student Form</header>
        <form action="../controller/student_form.php" method="POST" class="form" enctype="multipart/form-data">
            <div class="input-box">
                <label for="full_name">Full Name</label>
                <input type="text" id="full_name" name="full_name" placeholder="Enter full name" required />
            </div>
            <div class="input-box">
    <label for="student_image">Student Image</label>
    <input type="file" id="student_image" name="student_image" accept="image/*" onchange="previewImage(event)" />
    <img id="image_preview" src="#" alt="Preview" style="max-width: 100px; max-height: 100px; display: none;" />
</div>  
            <!-- ... (previous form fields) ... -->
<div class="input-box">
    <label for="course">Course</label>
    <select id="course" name="course" required onchange="fetchCourseFees()">
        <option value="" disabled selected>Select a course</option>
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

        // Fetch course options from the database
        $sql = "SELECT name FROM courses"; // Change 'name' to the correct column name
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                echo '<option value="' . $row['name'] . '">' . $row['name'] . '</option>';
            }
        } else {
            echo '<option value="" disabled>No courses available</option>';
        }

        // Close the database connection
        mysqli_close($conn);
        ?>
    </select>
</div>

<div class="input-box">
    <label for="fees">Course Fees</label>
    <input type="number" id="fees" name="fees" placeholder="Enter Course Fees" required  />
</div>

<!-- Add a new input for discount percentage -->
<div class="input-box">
    <label for="discount">Discount Percentage</label>
    <input type="number" id="discount" name="discount" placeholder="Enter Discount Percentage" required/>
</div>

<!-- Add a new input for current fees -->
<div class="input-box">
    <label for="current_fees">Current Fees</label>
    <input type="number" id="current_fees" name="current_fees" placeholder="Current Fees" required  />
</div>

<div class="input-box">
    <label for="email">Email</label>
    <input type="text" id="email" name="email" placeholder="Enter Student Email" required  />
</div>

<div class="input-box">
    <label for="phone_number">Phone Number</label>
    <div class="phone-input">
        <select id="country_code" name="country_code" required>
           <option value="+92">+92 (Pakistan)</option>
            <option value="+20">+20 (Egypt)</option>
            <option value="+27">+27 (South Africa)</option>
            <option value="+44">+44 (UK)</option>
            <option value="+49">+49 (Germany)</option>
            <option value="+81">+81 (Japan)</option>
            <option value="+91">+91 (India)</option>
        </select>
        <input type="tel" style="height: 35px;" id="phone_number" name="phone_number" placeholder="3XXXXXXXXX" required />
    </div>
</div>
       
        
<div class="input-box">
    <label for="cnic_number">CNIC Number</label>
    <input type="text" id="cnic_number" name="cnic" placeholder="Enter CNIC number" required maxlength="13" />
</div>
            
        

                <div class="input-box">
                    <label for="birth_date">Birth Date</label>
                    <input type="date" id="birth_date" name="dob" placeholder="Enter birth date" required />
                </div>

                <div class="input-box">
    <label for="admission_date">Admission Date</label>
    <input type="date" id="admission_date" name="doa" placeholder="Enter Date of Admission" required />
</div>
<div class="input-box">
    <label for="student_status">Student Status</label>
    <select id="student_status" name="status" required>
        <option value="select_status">Select Status</option>
        <option value="Enrolled">Enrolled</option>
        <option value="Completed">Completed</option>
        <option value="Dropped">Dropped</option>
        <option value="Transferred">Transferred</option>
        <option value="Other">Other</option>
    </select>
</div>

<div id="otherStatusDate" class="input-box" style="display: none;">
    <label for="other_status_date">Leaving Date</label>
    <input type="date" id="other_status_date" name="doc" />
</div>



            
            <div class="gender-box">
                <h3>Gender</h3>
                <div class="gender-option">
                    <div class="gender">
                        <input type="radio" id="male" name="gender" value="Male" checked />
                        <label for="male">Male</label>
                    </div>
                    <div class="gender">
                        <input type="radio" id="female" name="gender" value="Female" />
                        <label for="female">Female</label>
                    </div>
                    <div class="gender">
                        <input type="radio" id="other" name="gender" value="Prefer not to say" />
                        <label for="other">Prefer not to say</label>
                    </div>
                </div>
            </div>
            <div class="input-box address">
                <label for="street_address">Address</label>
                <input type="text" id="street_address" name="street_address" placeholder="Enter street address" required />
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
        preview.src = '#';
        preview.style.display = 'none';
    }
}
</script>

<script>
    
function fetchCourseFees() {
    var selectedCourse = document.getElementById('course').value;

    // Fetch course fees using AJAX
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById('fees').value = this.responseText;
            calculateDiscount();
        }
    };
    xhr.open('GET', '../controller/fetch_fees.php?course=' + selectedCourse, true);
    xhr.send();
}
function calculateDiscount() {
    var fees = parseFloat(document.getElementById('fees').value);
    var discountPercentage = parseFloat(document.getElementById('discount').value);

    if (!isNaN(fees) && !isNaN(discountPercentage)) {
        var discountAmount = (fees * discountPercentage) / 100;
        var remainingFees = fees - discountAmount;

        // Update the fees input with the remaining fees after discount
        document.getElementById('current_fees').value = remainingFees.toFixed(2);

        // If you want to update the 'fees' input as well, uncomment the following line
        // document.getElementById('fees').value = remainingFees.toFixed(2);
    }
}


document.getElementById('student_status').addEventListener('change', function () {
    var otherStatusDateBox = document.getElementById('otherStatusDate');
    if (this.value !== 'Enrolled') {
        otherStatusDateBox.style.display = 'block';
    } else {
        otherStatusDateBox.style.display = 'none';
    }
});

document.getElementById('country_code').addEventListener('change', function () {
    document.getElementById('phone_number').value = '';
});

document.querySelector('form').addEventListener('submit', function () {
    // Concatenate country code and phone number values and set it to the hidden input
    var countryCode = document.getElementById('country_code').value;
    var phoneNumber = document.getElementById('phone_number').value;
    document.getElementById('phone_number_input').value = countryCode + phoneNumber;
});

// Add event listener to phone number input to restrict to 10 digits
document.getElementById('phone_number').addEventListener('input', function () {
    if (this.value.length > 10) {
        this.value = this.value.slice(0, 10);
    }
});

document.getElementById('cnic_number').addEventListener('input', function () {
    if (this.value.length > 13) {
        this.value = this.value.slice(0, 13);
    }
});

// Add event listener to country code selector to reset phone number on change
document.querySelector('form').addEventListener('submit', function () {
    // Concatenate country code and phone number values and set it to the hidden input
    var countryCode = document.getElementById('country_code').value;
    var phoneNumber = document.getElementById('phone_number').value;
    var concatenatedNumber = countryCode + phoneNumber;

    // Set the concatenated number to the hidden input
    document.getElementById('phone_number').value = concatenatedNumber;
});


// Add event listener for discount input
document.getElementById('discount').addEventListener('input', calculateDiscount);
</script>
</body>
</html>
