<?php
require_once '../controller/attempt_login.php'; // Adjust the file path accordingly
?>
  
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Course Registration</title>
    <!-- Link to separate CSS file -->
    <link rel="stylesheet" href="../view/student_form.css">
</head>
<body>
    <section class="container">
        <header>Add Course</header>
        <form action="../controller/add_course.php" method="POST" class="form">
            <div class="input-box">
                <label for="full_name">Course Name</label>
                <input type="text" id="full_name" name="full_name" placeholder="Enter Course name" required />
            </div>

            <div class="input-box">
                <label for="email">Details</label>
                <input type="text" id="email" name="email" placeholder="Enter Course Detalis" required />
            </div>

            <div class="gender-box">
                <h3>For Gender</h3>
                <div class="gender-option">
                    <div class="gender">
                        <input type="radio" id="male" name="gender" value="Male only" checked />
                        <label for="male">Male</label>
                    </div>
                    <div class="gender">
                        <input type="radio" id="female" name="gender" value="Female only" />
                        <label for="female">Female</label>
                    </div>
                    <div class="gender">
                        <input type="radio" id="other" name="gender" value="Male & Female both" />
                        <label for="other">Male & Female</label>
                    </div>
                </div>
            </div>
       <div class="input-box">
            <select name="duration" >
            <option name="duration">Select Duration</option>
                <option name="duration">One Month</option>
                <option name="duration">Two Months</option>
                <option name="duration">Three Months</option>
                <option name="duration">Six Months</option>
            </select>    
</div> 
            <div class="column">
                <div class="input-box">
                    <label for="phone_number">Fees</label>
                    <input type="number" id="phone_number" name="phone_number" placeholder="Enter Course Fees" required />
                </div>
                
            <div class="input-box address">
                <label for="street_address">Tutor</label>
                <input type="text" id="street_address" name="street_address" placeholder="Enter Tutor Name" required />
            </div>
            <button type="submit">Submit</button>
        </form>
    </section>
</body>
</html>
