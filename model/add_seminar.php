<?php
require_once '../controller/attempt_login.php'; // Adjust the file path accordingly
?>
  
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Seminar Registration</title>
    <!-- Link to separate CSS file -->
    <link rel="stylesheet" href="../view/add_seminar.css">
</head>
<body>
    <section class="container">
        <header>Add Seminar</header>
        <form action="../controller/add_seminar.php" method="POST" class="form">
            <div class="input-box">
                <label for="full_name">Name</label>
                <input type="text" id="full_name" name="full_name" placeholder="Enter Name" required />
            </div>
            <!-- ... (previous form fields) ... -->
          
            <div class="input-box">
                    <label for="birth_date">Date</label>
                    <input type="date" id="birth_date" name="fees" placeholder="Enter Date" required />
                </div>
            <div class="input-box">
                <label for="email">Time</label>
                <input type="time" id="email" name="email" placeholder="Enter Time" required />
            </div>
            <div class="column">
                <div class="input-box">
                    <label for="phone_number">Address</label>
                    <input type="text" id="phone_number" name="phone_number" placeholder="Enter Address" required />
                </div>
                <div class="input-box">
                    <label for="birth_date">Description</label>
                    <input type="text" id="birth_date" name="dob" placeholder="Enter Details" required />
                </div>
                <div class="input-box">
                    <label for="total_invites">Total Invites</label>
                    <input type="number" id="invites" name="invites" placeholder="Enter Total Invites" required />
                </div>
                <div class="input-box">
                    <label for="present">Total Attendance</label>
                    <input type="number" id="preset" name="present" placeholder="Enter Present Number" required />
                </div>
                <div class="input-box">
                    <label for="guest">Cheif Guest</label>
                    <input type="text" id="guest" name="guest" placeholder="Enter Cheif Guest Name" required />
                </div>
            </div>
           
            <button type="submit">Submit</button>
        </form>
    </section>
</body>
</html>
