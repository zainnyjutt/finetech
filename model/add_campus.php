<?php
require_once '../controller/attempt_login.php'; // Adjust the file path accordingly
?>
  
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Campus Registration</title>
    <!-- Link to separate CSS file -->
    <link rel="stylesheet" href="../view/student_form.css">
</head>
<body>
    <section class="container">
        <header>Add Campus</header>
        <form action="../controller/add_campus.php" method="POST" class="form">
            <div class="input-box">
                <label for="full_name">Campus Name</label>
                <input type="text" id="full_name" name="full_name" placeholder="Enter Campus name" required />
            </div>

            <div class="input-box">
                <label for="email">Contact</label>
                <input type="number" id="email" name="email" placeholder="Enter Contact Detalis" required />
            </div>

       
            <div class="column">
                <div class="input-box">
                    <label for="phone_number">Email</label>
                    <input type="text" id="phone_number" name="phone_number" placeholder="Enter E-Mail" required />
                </div>
                
            <div class="input-box address">
                <label for="street_address">Address</label>
                <input type="text" id="street_address" name="street_address" placeholder="Enter Address" required />
            </div>
            <div class="input-box address">
                <label for="street_address">Link</label>
                <input type="text" id="street_address" name="link" placeholder="Enter Link " required />
            </div>
            <button type="submit">Submit</button>
        </form>
    </section>
</body>
</html>
