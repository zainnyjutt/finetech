<?php
require_once '../controller/attempt_login.php'; // Adjust the file path accordingly
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us - Fine Tech</title>
    <!-- Assuming you have Font Awesome and your custom stylesheet linked -->
    <link rel="stylesheet" href="path/to/font-awesome/css/all.min.css">
    <link rel="stylesheet" href="../view/about_us.css"> <!-- Add your custom styles if needed -->

   
</head>
<body>
<?php
    include('sidebar.php');
    ?>

    <div class="content">
    <div class="header">
    <h1>ABOUT US</h1>
</div>

<section id="about">
    <h2 style="color:#133054;">About Fine Tech</h2>
    <p>Welcome to Fine Tech, your premier software house and IT training center.</p>

    <p>We pride ourselves on delivering top-notch solutions and providing quality training in the ever-evolving field of information technology.</p>

    <p>At Fine Tech, we are dedicated to excellence, innovation, and continuous learning.</p>
</section>

<section id="team">
    <h2 style="color:#133054;">Meet Our Team</h2>

    <div class="team-member">
        <img src="../images/raoumar.png" alt="Rao Umar">
        <h3>Rao Umar</h3>
        <p>CEO</p>
    </div>

    <div class="team-member">
        <img src="../images/mypic.jpeg" alt="Muhammad Zain Iftikhar">
        <h3>Muhammad Zain Iftikhar</h3>
        <p>Frontend & Backend Developer</p>
    </div>
</section>

<section id="contact">
    <h2 style="color:#133054;">Contact Us</h2>
    <p>If you have any questions or inquiries, feel free to reach out to us:</p>

    <p>Email: finetechdev@gmail.com</p>
    <p>Phone: +92 311 4902917</p>
</section>

s
    
</body>
</html>