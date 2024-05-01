<?php
session_start();
$backgroundImagePath = "./images/hotel.png";
include 'connection.php';
include 'nav.php';


if (isset($_SESSION['success_message'])) {
  echo "<script>alert('" . $_SESSION['success_message'] . "');</script>";
  unset($_SESSION['success_message']);
}

// Retrieve hotel information from the database
$sql = "SELECT hotel_id, hotel_name, hotel_contact, hotel_address, photos, ratings FROM hotels"; // Adjust the query to fetch the required fields
$result = mysqli_query($conn, $sql);
$hotels = [];
while ($row_hotel = mysqli_fetch_assoc($result)) {
  $hotels[] = $row_hotel;
}
$userCity = isset($_GET['location']) ? $_GET['location'] : "Thamel";

// Adjust SQL query to select hotels based on their city or region
$sql = "SELECT hotel_id, hotel_name, hotel_contact, hotel_address, photos, ratings FROM hotels WHERE hotel_address LIKE '%$userCity%'";
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
      <h2 class="heading">Hotels list</h2>
      <div class="card--container">
        <?php foreach ($hotels as $hotel): ?>
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
                  <a href="book.php?hotel_id=<?php echo $hotel['hotel_id']; ?>" class="submit">Make Reservation</a>
                <?php else: ?>
                  <a href="login.php" class="submit">Login to Book</a>
                <?php endif; ?>
                <br />
              </div>
            </a>
          </div>
        <?php endforeach; ?>
      </div>
    </div>

    <h2 class="heading">Hotels near
      <?php echo $userCity; ?>
    </h2>
    <!-- Allow users to input their location -->
    <form action="" method="GET">
      <input type="text" id="location" name="location" placeholder="Enter city or region">
      <button type="submit"><i class="fas fa-search"></i></button>
    </form>

    <div class="card--container">
      <?php foreach ($nearbyHotels as $hotel): ?>
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
                <a href="book.php?hotel_id=<?php echo $hotel['hotel_id']; ?>" class="submit">Make Reservation</a>
              <?php else: ?>
                <a href="login.php" class="submit">Login to Book</a>
              <?php endif; ?>
              <br />
            </div>

          </a>
        </div>
      <?php endforeach; ?>
    </div>

    <div class="second_section">
      <h2 class="heading">Most popular Hotels!!</h2>
      <div class="card--container">
        <?php foreach ($hotels as $hotel): ?>
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
                    <a href="book.php?hotel_id=<?php echo $hotel['hotel_id']; ?>" class="submit">Make Reservation</a>
                  <?php else: ?>
                    <a href="login.php" class="submit">Login to Book</a>
                  <?php endif; ?>
                  <br />
                </div>

              </a>
            </div>
          <?php endif; ?>
        <?php endforeach; ?>
      </div>
    </div>
  </div>

</body>

</html>
<?php
include ('footer.php')
  ?>