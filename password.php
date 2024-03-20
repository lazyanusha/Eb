<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>EasyBookings</title>
  <link rel="stylesheet" href="../static/css/login.css" />
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
  </style>
</head>

<body>
  <div class="form--4">
    <form action="login.php" method="post">
      <h2>EasyBookings</h2>
      <div class="content">
        <label for="password">Password:</label>
        <div class="password-container">
          <input type="password" class="password" placeholder="Enter your password" name="password" required>
          <i class="fas fa-eye-slash togglePassword"></i>
        </div>
        <label for="password">Confirm password:</label>
        <div class="password-container">
          <input type="password" class="password" placeholder="Confirm your password" required name="password">
          <i class="fas fa-eye-slash togglePassword"></i>
        </div>
        <input class="button" type="submit" name="Submit" id="submit" value="submit" />
      </div>
    </form>
  </div>

  <script src="../static/js/script.js" >
  </script>
</body>

</html>
