<?php
$backgroundImagePath = "./images/abc.jpg";
include 'connection.php';
include 'nav.php';

$sql = "SELECT hotel_id, hotel_name, hotel_contact, hotel_address, photos FROM hotels"; // Adjust the query to fetch the required fields
$result = mysqli_query($conn, $sql);
$hotels = [];
while ($row_hotel = mysqli_fetch_assoc($result)) {
  $hotels[] = $row_hotel;
}
$userCity = isset($_GET['location']) ? $_GET['location'] : "Pokhara";

$sql = "SELECT hotel_id, hotel_name, hotel_contact, hotel_address, photos FROM hotels WHERE hotel_address LIKE '%$userCity%'";
$result = mysqli_query($conn, $sql);
$nearbyHotels = [];
while ($row_hotel = mysqli_fetch_assoc($result)) {
  $nearbyHotels[] = $row_hotel;
}

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
    form button {
            font-size: 14px;
            letter-spacing: 1px;
            margin-top: -10px;
            cursor: pointer;
            padding: 10px 20px;
            align-self: center;
            border: none;
            border-radius: 10px;
        }
       
  </style>

</head>

<body>
  <div class="first_section">
    <div class="layer1">
      <h1>WELCOME TO EasyBookings!!</h1>
      <p>Enjoy your trip with safe and reliable shelters.!!</p>
    </div>
  </div>
  <div class="container">
    <div class="second_section">
      <div class="info">
        <h2 class="heading">Hotels list</h2>
        <a href="hotellist.php" class="button">See More</a>
      </div>
      <div class="card--container">
        <?php
        $count = 0;
        foreach ($hotels as $hotel):
          if ($count >= 8)
            break;
          ?>
          <div class="card">
            <a href="book.php?hotel_id=<?php echo $hotel['hotel_id']; ?>">
              <img src="uploads/<?php echo $hotel['photos']; ?>" alt="<?php echo $hotel['hotel_name']; ?>" />
              <div class="card--content">
                <h2 class="card--title">
                  <?php echo $hotel['hotel_name']; ?>
                </h2>
                <p class="card--details">
                  <?php echo $hotel['hotel_contact']; ?>
                </p>
                <p class="card--details">
                  <?php echo $hotel['hotel_address']; ?>
                </p>
                <?php if (isset($_SESSION['email'])): ?>
                  <a href="book.php?hotel_id=<?php echo $hotel['hotel_id']; ?>" class="button">Make Reservation</a>
                <?php else: ?>
                  <a href="login.php" class="button">Login to Book</a>
                <?php endif; ?>
                <br />
              </div>
            </a>
          </div>
          <?php
          $count++;
        endforeach;
        ?>
      </div>
    </div>
    <div class="second_section">
    <div class="info">
      <h2 class="heading">Hotels near
        <?php echo $userCity; ?>
      </h2>
      <a href="hotellist.php" class="button">See More</a>
    </div>


    <!-- Allow users to input their location -->
    <form action="" method="GET">
      <input type="text" id="location" name="location" placeholder="Enter city or region">
      <button type="submit"><i class="fas fa-search" style="color:#fff; padding: 9px;" ></i></button>
    </form>

    <div class="card--container">
      <?php $count = 0; // Initialize counter variable
      foreach ($nearbyHotels as $hotel):
        if ($count >= 8)
          break; // Exit loop if count reaches 2
        ?>
        <div class="card">
          <a href="book.php?hotel_id=<?php echo $hotel['hotel_id']; ?>">
            <img src="uploads/<?php echo $hotel['photos']; ?>" alt="<?php echo $hotel['hotel_name']; ?>" />
            <div class="card--content">
              <h2 class="card--title">
                <?php echo $hotel['hotel_name']; ?>
              </h2>
              <p class="card--details">
                <?php echo $hotel['hotel_contact']; ?>
              </p>
              <p class="card--details">
                <?php echo $hotel['hotel_address']; ?>
              </p>
              <!-- <div class="stars">
              <?php
              $ratings = $hotel['ratings'];
              for ($i = 0; $i < $ratings; $i++) {
                echo '<i class="fas fa-star"></i>';
              }
              ?>
            </div> -->
              <?php if (isset($_SESSION['email'])): ?>
                <a href="book.php?hotel_id=<?php echo $hotel['hotel_id']; ?>" class="button">Make Reservation</a>
              <?php else: ?>
                <a href="login.php" class="button">Login to Book</a>
              <?php endif; ?>
              <br />
            </div>

          </a>
        </div>
        <?php
        $count++;
      endforeach;
      ?>
    </div>
  </div>
  </div>
 

  <!-- <div class="second_section">
    <div class="info">
      <h2 class="heading">Most popular Hotels!!</h2>
      <a href="hotellist.php" class="button">See More</a>
    </div>
    <div class="card--container">
      <?php
      $count = 0;
      foreach ($hotels as $hotel):
        if ($count >= 8)
          break;
        ?>
        <?php if ($hotel['ratings'] >= 4): ?>
          <div class="card">
            <a href="book.php?hotel_id=<?php echo $hotel['hotel_id']; ?>">
              <img src="uploads/<?php echo $hotel['photos']; ?>" alt="<?php echo $hotel['hotel_name']; ?>" />
              <div class="card--content">
                <h2 class="card--title">
                  <?php echo $hotel['hotel_name']; ?>
                </h2>
                <p class="card--details">
                  <?php echo $hotel['hotel_contact']; ?>
                </p>
                <p class="card--details">
                  <?php echo $hotel['hotel_address']; ?>
                </p>
                <div class="stars">
                  <?php
                  $ratings = $hotel['ratings'];
                  for ($i = 0; $i < $ratings; $i++) {
                    echo '<i class="fas fa-star"></i>';
                  }
                  ?>
                </div>
                <?php if (isset($_SESSION['email'])): ?>
                  <a href="book.php?hotel_id=<?php echo $hotel['hotel_id']; ?>" class="button">Make Reservation</a>
                <?php else: ?>
                  <a href="login.php" class="button">Login to Book</a>
                <?php endif; ?>
                <br />
              </div>

            </a>
          </div>
        <?php endif; ?>
        <?php
        $count++;
      endforeach;
      ?>
    </div>
  </div> -->
  </div>

</body>

</html>
<?php
include ('footer.php')
  ?>