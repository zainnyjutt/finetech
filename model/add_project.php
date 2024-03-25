<?php
require_once '../controller/attempt_login.php'; // Adjust the file path accordingly
?>
  <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Project Registration</title>
    <!-- Link to separate CSS file -->
    <link rel="stylesheet" href="../view/add_seminar.css">
</head>
<body>
    <section class="container">
        <header>Add Project</header>
        <form action="../controller/add_project.php" method="POST" class="form">
            <div class="input-box">
                <label for="full_name">Name</label>
                <input type="text" id="full_name" name="full_name" placeholder="Enter Name" required />
            </div>
            <!-- ... (previous form fields) ... -->
          
            <div class="input-box">
                    <label for="birth_date">Description</label>
                    <input type="text" id="birth_date" name="fees" placeholder="Enter Description" required />
                </div>
            <div class="input-box">
                <label for="email">Created By</label>
                <input type="text" id="email" name="email" placeholder="Enter Author Name" required />
            </div>
            <div class="column">
                <div class="input-box">
                    <label for="phone_number">Link</label>
                    <input type="text" id="phone_number" name="phone_number" placeholder="Paste link here" required />
                </div>
               
            </div>
           
            <button type="submit">Submit</button>
        </form>
    </section>
</body>
</html>
