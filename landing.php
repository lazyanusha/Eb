<?php
$backgroundImagePath = "./images/hotel.png";
include 'connection.php';

// Retrieve hotel information from the database
$sql = "SELECT hotel_id, hotel_name, hotel_contact, hotel_address, photos, ratings FROM hotels"; // Adjust the query to fetch the required fields
$result = mysqli_query($conn, $sql);

// Fetch all hotel data into an array
$hotels = [];
while ($row_hotel = mysqli_fetch_assoc($result)) {
  $hotels[] = $row_hotel;
}
$userCity = isset ($_GET['location']) ? $_GET['location'] : "Thamel";

// Adjust SQL query to select hotels based on their city or region
$sql = "SELECT hotel_id, hotel_name, hotel_contact, hotel_address, photos, ratings FROM hotels WHERE hotel_address LIKE '%$userCity%'";
$result = mysqli_query($conn, $sql);

// Fetch hotels
$nearbyHotels = [];
while ($row_hotel = mysqli_fetch_assoc($result)) {
  $nearbyHotels[] = $row_hotel; // Add hotel to nearby hotels array
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
  <div>
    <nav class="navigation_bar">
      <div class="logo">
        <a href="home.php"><img src="./images/logo3.png" alt="logo"></a>
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

  <div class="first_section">
    <div class="layer1">
      <h1>WELCOME TO EASY BOOKINGS!!</h1>
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
                <p>Know more....</p>
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
              <p>Know more....</p>
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
                  <p class="know">Know more....</p>
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