<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>EasyBookings - Sign Up</title>
      <link rel="stylesheet" href="../static/css/login.css" />
  </head>

  <body>
    <div class="form">
    <form action="adminverify.php" method="post" onsubmit="return validateForm()">

      <h2 class="h2-2">Log In</h2>
      <div class="login--3">
      <input type="email" id="email" name="email" placeholder="Email" required />
        <input type="password" id="password" name="password" required placeholder="Password" />

      <!-- Submit Button -->
      <button class="button" type="submit">Log In</button>
      <div class="sign1">
        <a href="forgot.php">Forgotten password?</a>
        <p>or</p>
        <button class="button-1">
          <a href="admin_signup.php">Create an account?</a>
        </button>
      </div>
      </div>
    </form>
    </div>
  </body>
</html>
