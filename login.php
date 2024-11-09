<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Hotel Reservation System - Log in</title>
  <link rel="stylesheet" href="./css/log.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
  <style>
    .password-container {
      position: relative;
      margin-top: 10px;
    }

    .password {
      padding-right: 30px;
    }

    .togglePassword {
      position: absolute;
      top: 35%;
      right: 10px;
      transform: translateY(-50%);
      cursor: pointer;
    }

    .error-message {
      color: red;
      font-size: clamp(0.75rem, 0.7067rem + 0.1923vw, 0.875rem);
      margin-top: 5px;
    }
  </style>
</head>

<body>
  <div class="form">
    <form action="loginverification.php" method="post" onsubmit="return validateForm()">

      <h2 class="h2">EasyBookings</h2>
      <div class="login">
        <input type="email" id="email" name="email" placeholder="Enter your email" required />
        <div class="password-container">
          <input type="password" class="password" placeholder="Enter your password" name="password" required>
          <i class="fas fa-eye-slash togglePassword"></i>
          <?php if (isset($error_message)): ?>
            <div class="error-message">
              <?php echo $error_message; ?>
            </div>
          <?php endif; ?>

        </div>

        <button type="submit" class="button" >  Log In</button>
      </div>
      <p>or</p>
      <div class="sign">
        <button class="button-1">
          <a href="signup.php">Create an account?</a>
        </button>
      </div>
    </form>
  </div>


  <script src="./js/script.js"></script>

</body>

</html>