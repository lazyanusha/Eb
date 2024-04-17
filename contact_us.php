<?php
session_start();
include ('nav.php');
$backgroundImagePath = "./images/hotel.png";
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Easybookings</title>
  <link rel="stylesheet" href="./css/home.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
  <style>
    .first_section {
      background-image: url('<?php echo $backgroundImagePath; ?>');
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


</body>

</html>
<?php
include ('footer.php')
  ?>