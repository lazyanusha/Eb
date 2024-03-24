<?php
$backgroundImagePath = "./images/hotel.png";

// Include database connection
include 'connection.php';

// Retrieve hotel information from the database
$sql = "SELECT hotel_name, hotel_contact, hotel_address, photos FROM hotels"; // Adjust the query to fetch the required fields
$result = mysqli_query($conn, $sql);

// Fetch all hotel data into an array
$hotels = [];
while ($row_hotel = mysqli_fetch_assoc($result)) {
  $hotels[] = $row_hotel;
}

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
  </style>

</head>

<body>
  <div>
    <nav class="navigation_bar">
      <div class="logo">
        <a href="home.php">EasyBookings</a>
      </div>
      <div class="menu">
        <ul>
          <li><a href="home.php">Home</a></li>
          <li><a href="About us.php">About Us</a></li>
          <li><a href="contact_us.php">Contact Us</a></li>
          <li><a href="services.php">Services</a></li>
        </ul>
      </div>
      <div class="new">
        <a href="g-dashboard.php">Dashboard</a>
        <a href="g-booking.php"><i class="fas fa-bed"></i>
        </a>

        <a href="home.php"><i class="fas fa-sign-out-alt"></i></a>

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
      <h2>Hotels near you.!!</h2>
      <div class="card--container">
        <?php foreach ($hotels as $hotel): ?>
          <div class="card">
            <a href="book.php"><img src="uploads/<?php echo $hotel['photos']; ?>"
                alt="<?php echo $hotel['hotel_name']; ?>" /></a>
            <div class="card--content">
              <a href="book.php">
                <h2 class="card--title">
                  <?php echo $hotel['hotel_name']; ?>
                </h2>
              </a>
              <p class="card--details">
                <?php echo $hotel['hotel_contact']; ?>
              </p>
              <p class="card--details">
                <?php echo $hotel['hotel_address']; ?>
              </p>
              <a href="book.php" target="_self">
                <p>Know more....</p>
              </a><br />
            </div>
          </div>
        <?php endforeach; ?>
      </div>
    </div>
    <div class="second_section">
      <h2>Most popular Hotels!!</h2>
      <div class="card--container">
        <?php foreach ($hotels as $hotel): ?>
          <div class="card">
            <a href="book.php?hotel_id=<?php echo $hotel['hotel_id']; ?>"> <!-- Include hotel_id as a URL parameter -->
              <img src="uploads/<?php echo $hotel['photos']; ?>" alt="<?php echo $hotel['hotel_name']; ?>" />
              <div class="card--content">
                <a href="book.php?hotel_id=<?php echo $hotel['hotel_id']; ?>">
                  <!-- Include hotel_id as a URL parameter -->
                  <h2 class="card--title">
                    <?php echo $hotel['hotel_name']; ?>
                  </h2>
                </a>
                <p class="card--details">
                  <?php echo $hotel['hotel_contact']; ?>
                </p>
                <p class="card--details">
                  <?php echo $hotel['hotel_address']; ?>
                </p>
                <a href="book.php?hotel_id=<?php echo $hotel['hotel_id']; ?>" target="_self">
                  <!-- Include hotel_id as a URL parameter -->
                  <p>Know more....</p>
                </a><br />
              </div>
            </a>
          </div>

        <?php endforeach; ?>
      </div>
    </div>

  </div>

</body>

</html>
<?php
include ('footer.php')
  ?>