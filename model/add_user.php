<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Registration</title>
    <!-- Link to separate CSS file -->
    <link rel="stylesheet" href="../view/student_form.css">
     <style type="text/css">/* Reset some default styles */
body {
  margin: 0;
  padding: 0;
  font-family: Arial, sans-serif;
  background-color: #133054;
}

/* Container for the form */
.container {
  position: relative;
  max-width: 700px;
  width: 100%;
  background: #fff;
  padding: 25px;
  border-radius: 8px;
  box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
  margin: 0 auto;
  margin-top: 20px;
  box-sizing: border-box;
}

/* Form header */
.container header {
  font-size: 1.5rem;
  color: #333;
  font-weight: 500;
  text-align: center;
  margin-bottom: 20px;
}

/* Form input boxes and labels */
.input-box {
  margin-bottom: 20px;
}

.input-box label {
  color: #333;
  display: block;
  margin-bottom: 8px;
  font-weight: 500;
}

.input-box input[type="text"],
.input-box input[type="number"],
.input-box input[type="date"],
.input-box input[type="password"],
.input-box select {
  width: 100%;
  padding: 10px;
  border: 1px solid #ccc;
  border-radius: 4px;
  font-size: 16px;
  color: #333;
}

/* Form gender options */
.gender-box {
  margin-bottom: 20px;
}

.gender-box h3 {
  color: #333;
  font-size: 1rem;
  font-weight: 400;
  margin-bottom: 10px;
}

.gender-option {
  display: flex;
  gap: 15px;
}

.gender label {
  color: #333;
  font-weight: 500;
}

/* Submit button */
form button {
  display: block;
  width: 100%;
  padding: 10px;
  background-color: #133054;
  color: #fff;
  border: none;
  border-radius: 4px;
  font-size: 16px;
  cursor: pointer;
  transition: background-color 0.3s ease;
}

form button:hover {
  background-color: #001f3f;
}

/* Responsive */
@media screen and (max-width: 500px) {
  .gender-option {
      flex-direction: column;
      gap: 10px;
  }
}
</style>
</head>

<body>
    <section class="container">
        <header>Add User</header>
        <form action="../controller/add_user.php" method="POST" class="form">
            <div class="input-box">
                <label for="full_name">User Name</label>
                <input type="text" id="full_name" name="full_name" placeholder="Enter User name" required />
            </div>

            <div class="input-box">
                <label for="cnic">CNIC</label>
                <input type="number" id="cnic" name="cnic" placeholder="Enter CNIC" required />
            </div>

            <div class="input-box">
                <label for="contact">Contact</label>
                <input type="number" id="contact" name="contact" placeholder="Enter Contact Details" required />
            </div>

            <div class="input-box">
                <label for="email">Email</label>
                <input type="text" id="email" name="email" placeholder="Enter E-Mail" required />
            </div>

            <div class="input-box">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" placeholder="Enter Password" required />
            </div>

            <div class="input-box">
                <label for="role">Role</label>
                <select id="role" name="role">
                    <option value="Admin">Admin</option>
                    <option value="Accountant">Accountant</option>
                    <option value="Campus Manager">Campus Manager</option>
                    <option value="HR">HR</option>
                    <option value="Teacher">Teacher</option>
                    <option value="Faculty Management">Faculty Management</option>
                </select>
            </div>

            <button type="submit">Submit</button>
        </form>
    </section>
</body>

</html>
