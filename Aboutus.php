<?php
if (session_status() === PHP_SESSION_NONE) {
  session_start();
}
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
      <h1>About EasyBookings!!</h1>
    </div>
  </div>
  <div class="hotel--section">
    <div class="text">
      <p>
        It aims to
        to simplify the reservation process, offering travelers a seamless and hassle-free experience, while
        simultaneously empowering hoteliers with efficient tools to
        manage bookings effectively. With a commitment to innovation and customer satisfaction, EasyBookings emerged as
        a pioneer in the hospitality industry, reshaping
        the way people book accommodations
        and enhancing the overall travel experience for all.
      </p>

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