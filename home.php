<?php
include ('nav.php');
$backgroundImagePath = "./images/hotel.png";
?>
<?php

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Easybookings</title>
  <link rel="stylesheet" href="./css/style.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
  <style>
    .first_section {
      background-image: url('<?php echo $backgroundImagePath; ?>');

      width: 100%;
      height: 100vh;
      background-size: cover;
      background-position: center;
      display: flex;
      justify-content: center;
      align-items: center;
    }

    i {
      color: gold;
    }
  </style>

</head>

<body>


  <div class="first_section">
    <div class="layer1">
      <h1>WELCOME TO EASY BOOKINGS!!</h1>
      <p>Enjoy your trip with safe and reliable shelters.!!</p>
    </div>
  </div>
  <div class="container">
    <div class="second_section">
      <h2>Hotels near you.!!</h2>
      <div class="card--container">
        <div class="card">
          <a href="login.php"><img src="taleju.jpg" alt="hotel abc" /></a>
          <div class="card--content">
            <a href="login.php">
              <h2 class="card--title">Taleju Boutique Hotel</h2>
            </a>
            <p class="card--details">Thamel, Kathmandu</p>
            <p>Ratings</p>
            <i class="fa-solid fa-star"></i>
            <i class="fa-solid fa-star"></i>
            <i class="fa-solid fa-star"></i>
            <i class="fa-solid fa-star"></i>
            <a href="login.php" target="_self">
              <p>Know more....</p>
            </a><br />
          </div>
        </div>
      </div>

    </div>
    <div class="second_section">
      <h2>Most popular Hotels!!</h2>
      <div class="card--container">
        <div class="card">
          <a href="login.php"><img src="kathmandu.jpg" alt="hotel abc" /></a>
          <div class="card--content">
            <a href="login.php">
              <h2 class="card--title">Kathmandu Suite Hotel</h2>
            </a>
            <p class="card--details">Thamel, Kathmandu</p>
            <p>Ratings</p>
            <i class="fa-solid fa-star"></i>
            <i class="fa-solid fa-star"></i>
            <i class="fa-solid fa-star"></i>
            <i class="fa-solid fa-star"></i>
            <a href="login.php" target="_self">
              <button>More Detais</button>
            </a><br />
          </div>
        </div>
      </div>
    </div>
    <h2>Most popular Hotels!!</h2>
    <div class="card--container">
      <div class="card">
        <a href="login.php"><img src="taleju.jpg" alt="hotel abc" /></a>
        <div class="card--content">
          <a href="login.php">
            <h2 class="card--title">Taleju Boutique Hotel</h2>
          </a>
          <p class="card--details">Thamel, Kathmandu</p>
          <p>Ratings</p>
          <span><i class="fa-solid fa-star"></i>
            <i class="fa-solid fa-star"></i>
            <i class="fa-solid fa-star"></i>
            <i class="fa-solid fa-star"></i></span>
          <a href="login.php" target="_self">
            <p>Know more....</p>
          </a><br />
        </div>
      </div>
    </div>
  </div>

</body>

</html>
<?php
include ('footer.php')
  ?>