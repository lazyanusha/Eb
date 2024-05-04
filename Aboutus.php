<?php
session_start();
include 'nav.php';
$backgroundImagePath = "./images/sunset-pool.jpg";
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Document</title>
   <link rel="stylesheet" href="./css/home.css">
    <script src=".js/hotel.js"></script>
    <style>
     .first_section {
      background-image: url('<?php echo $backgroundImagePath; ?>');
    }
      .hotel--section {
        display: flex;
        justify-content: space-around;
        margin: 50px 200px;
      }
      .text {
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        width: 100%;
      }
      .text p {
        color: rgb(39, 37, 37);
        font-size: 20px;
        text-align: center;
      }

      .text button {
        cursor: pointer;
        padding: 15px 40px;
        border-radius: 10px;
        font-size: 18px;
        letter-spacing: 0.1rem;
        border-width: 1px;
        margin-top: 50px;
      }
      a {
        color: #343434;
        text-decoration: none;
      }
      .image {
        width: 100%;
        margin-left: 200px;
      }
      .image img {
        width: 100%;
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
    <div class="hotel--section">
      <div class="text">
        <p>
          Easybookings is an open source platform for every kind of hotels to
          grow and promote their hotels.
        </p>
        <a href="hotelregister.php"
          ><button type="submit">Register your hotel now.</button></a
        >
      </div>
      <div class="image">
        <img src="./images/hotel.png" alt="" />
      </div>
    </div>
  </body>
</html>

<?php
  include 'footer.php';
?>