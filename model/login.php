<!DOCTYPE html>
<html>
<head>
  <title>Login - FineTech</title>
  <link rel="stylesheet" type="text/css" href="../view/login.css">
</head>
<body>
  <div class="login-container">
    <div class="login-form">
      <h2>Login to Finetech</h2>
      <form method="POST" action="../controller/login.php">
        <div class="input-group">
          <label for="email">Email</label>
          <input type="text" id="email" placeholder="Enter your Email" name="email" required>
        </div>
        <div class="input-group">
          <label for="password">Password</label>
          <input type="password" id="password" placeholder="Enter your password" name="password" required>
        </div>
        <button type="submit">Login</button>
      </form>
      <div class="signup-link">
        Don't have an account?<b class="bbb"> Contact Admin!</b>
      </div>
    </div>
  </div>
</body>
</html>
