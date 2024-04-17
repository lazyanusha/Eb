<?php
  include 'connection.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Document</title>
  <link rel="stylesheet" href="./css/home.css">
</head>

<body>
  <?php if (isset($_SESSION['email'])): ?>
    <div>
      <nav class="navigation_bar">
        <div class="logo">
          <a href="landing.php"><img src="./images/logo3.png" alt="logo"></a>
        </div>
        <div class="menu">
          <ul>
            <li><a href="landing.php">Home</a></li>
            <li><a href="Aboutus.php">About Us</a></li>
            <li><a href="hotellist.php">Hotels</a></li>
            <li><a href="contact_us.php">Contact Us</a></li>
          </ul>
        </div>
        <div class="new">
          <a href="logout.php">Log Out</a>
        </div>
      </nav>
    </div>
  <?php else: ?>
    <div>
      <nav class="navigation_bar">
        <div class="logo">
          <a href="landing.php"><img src="./images/logo3.png" alt="logo"></a>
        </div>
        <div class="menu">
          <ul>
            <li><a href="landing.php">Home</a></li>
            <li><a href="Aboutus.php">About Us</a></li>
            <li><a href="hotellist.php">Hotels</a></li>
            <li><a href="contact_us.php">Contact Us</a></li>

          </ul>
        </div>
        <div class="new">
          <a href="login.php">Log In</a>
          <a href="signup.php">Sign Up</a>
        </div>
      </nav>
    </div>
  <?php endif; ?>


</body>

</html>