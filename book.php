<?php
session_start();
include 'connection.php';

// Initialize variables
$hotelName = $hotelLocation = $hotelEmail = $hotelContact = $description = '';
$services = $rooms = array();

// Check if hotel_id is set in the session
if (isset ($_SESSION['hotel_id'])) {
  $hotel_id = $_SESSION['hotel_id'];

  // Retrieve hotel information from the database
  $sql = "SELECT * FROM hotels WHERE hotel_id = ?";
  $stmt = mysqli_prepare($conn, $sql);
  if ($stmt) {
    mysqli_stmt_bind_param($stmt, "i", $hotel_id);
    if (mysqli_stmt_execute($stmt)) {
      $result = mysqli_stmt_get_result($stmt);
      if ($row = mysqli_fetch_assoc($result)) {
        // Assign retrieved values to variables
        $hotelName = $row['hotel_name'];
        $hotelLocation = $row['hotel_address'];
        $hotelEmail = $row['hotel_email'];
        $hotelContact = $row['hotel_contact'];
        $description = $row['description'];
      }
    } else {
      echo "Error: " . mysqli_error($conn);
    }
    mysqli_stmt_close($stmt);
  } else {
    echo "Error: " . mysqli_error($conn);
  }

  // Retrieve services from the database
  $sql_services = "SELECT * FROM services WHERE hotel_id = ?";
  $stmt_services = mysqli_prepare($conn, $sql_services);
  if ($stmt_services) {
    mysqli_stmt_bind_param($stmt_services, "i", $hotel_id);
    if (mysqli_stmt_execute($stmt_services)) {
      $result_services = mysqli_stmt_get_result($stmt_services);
      while ($row_services = mysqli_fetch_assoc($result_services)) {
        $services[] = $row_services['service'];
      }
    } else {
      echo "Error: " . mysqli_error($conn);
    }
    mysqli_stmt_close($stmt_services);
  } else {
    echo "Error: " . mysqli_error($conn);
  }

  // Retrieve room details from the database
  $sql_rooms = "SELECT room_type, quantity FROM rooms WHERE hotel_id = ?";
  $stmt_rooms = mysqli_prepare($conn, $sql_rooms);
  if ($stmt_rooms) {
    mysqli_stmt_bind_param($stmt_rooms, "i", $hotel_id);
    if (mysqli_stmt_execute($stmt_rooms)) {
      $result_rooms = mysqli_stmt_get_result($stmt_rooms);
      while ($row_rooms = mysqli_fetch_assoc($result_rooms)) {
        $rooms[$row_rooms['room_type']] = $row_rooms['quantity'];
      }
    } else {
      echo "Error: " . mysqli_error($conn);
    }
    mysqli_stmt_close($stmt_rooms);
  } else {
    echo "Error: " . mysqli_error($conn);
  }

  $sql_images = "SELECT image_name FROM hotel_images WHERE hotel_id = ?";
  $stmt_images = mysqli_prepare($conn, $sql_images);
  mysqli_stmt_bind_param($stmt_images, "i", $_SESSION['hotel_id']); // Assuming you have stored hotel_id in session
  mysqli_stmt_execute($stmt_images);
  $result_images = mysqli_stmt_get_result($stmt_images);

  // Fetch and store image names in an array
  $images = array();
  while ($row_images = mysqli_fetch_assoc($result_images)) {
    $images[] = $row_images['image_name'];
  }
  // Close database connection
  mysqli_close($conn);
} else {
  echo "Hotel ID not found in session.";
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Reservation</title>
  <link rel="stylesheet" href="./css/style.css" />
  <!-- Slick Carousel CSS -->
  <link rel="stylesheet" type="text/css"
    href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.css" />
  <!-- Slick Carousel Theme CSS (optional) -->
  <link rel="stylesheet" type="text/css"
    href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick-theme.min.css" />
  <!-- jQuery (required by Slick Carousel) -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <!-- Slick Carousel JavaScript -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
  <style>
    .image img {
      height: 70vh;
      width: 100%;
    }

    .image {
      height: 80vh;
      margin-bottom: 150px;
    }

    .p {
      color: #343434;
      font-size: 16px;
    }

    .slick-prev,
    .slick-next {
      position: absolute;
      top: 50%;
      z-index: 1;
      width: 30px;
      height: 30px;
      background-color: rgba(0, 0, 0, 0.5);
      color: white;
      border: none;
      border-radius: 50%;
      cursor: pointer;
      transform: translateY(-50%);
      display: flex;
      justify-content: center;
      align-items: center;
    }

    .slick-prev {
      left: 10px;
    }

    .slick-next {
      right: 10px;
    }

    .thumbnails {
      gap: 0;
    }

    .thumbnails img {
      height: 50px;
      width: auto;
      margin: 5px;
      cursor: pointer;
    }
  </style>

<body>
  <div>
    <nav class="navigation_bar">
      <div class="logo">
        <a href="home.php">EasyBookings</a>
      </div>
      <div class="menu">
        <ul>
          <li><a href="landing.php">Home</a></li>
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
  <div class="image">
  <div class="carousel-container">
    <div class="carousel">
      <?php foreach ($images as $image): ?>
        <div><a href="<?php echo $image; ?>"><img src="<?php echo $image; ?>" alt="Hotel Image" loading="lazy"></a></div>
      <?php endforeach; ?>
    </div>
  </div>
  <!-- Thumbnails Carousel -->
  <div class="thumbnails-container">
    <div class="thumbnails">
      <?php foreach ($images as $image): ?>
        <div><img src="<?php echo $image; ?>" alt="Thumbnail Image" loading="lazy"></div>
      <?php endforeach; ?>
    </div>
  </div>
</div>



  <div class="sections">
    <div class="hotel--info">
      <h2>
        <?php echo $hotelName; ?>
      </h2>
      <p class="p">
        <?php echo $hotelLocation; ?>
      </p>
      <p class="p">
        <?php echo $hotelEmail; ?>
      </p>
      <p class="p">
        <?php echo $hotelContact; ?>
      </p>
      <p class="paragraph1">
        Description:
        <?php echo "<br>" . $description; ?>
      </p>
      <div class="area">
        <div class="list">
          <p class="paragraph">Our Services</p>
          <ul>
            <?php foreach ($services as $service): ?>
              <li>
                <?php echo $service; ?>
              </li>
            <?php endforeach; ?>
          </ul>
        </div>
        <div class="list">
          <p class="paragraph">Rooms Available:</p>
          <ul>
            <?php foreach ($rooms as $roomType => $quantity): ?>
              <li>
                <?php echo $roomType . ": " . $quantity; ?>
              </li>
            <?php endforeach; ?>
          </ul>
        </div>
        <div class="reviews">
          <p class="paragraph">Feedbacks</p>
          <p class="paragraph1">
            How was your stay with us? We'd love to hear your thoughts!
          </p>
          <form action="">
            <textarea rows="9" cols="100" placeholder="Write your message here....."></textarea>
            <div class="area">
              <input class="input" type="email" placeholder="Your email address" />
              <input class="button-1" type="submit" placeholder="Send" />
            </div>
          </form>
        </div>
      </div>
      <div class="booking">
        <form action="reservation.php" class="form--container" method="post">
          <div class="first--section">
            <h2>Reservation</h2>
          </div>
          <hr />
          <div class="reservation">
            <select class="reservation--info" name="room-type" placeholder="Type of room" id="room-type">
              <option value="" disabled selected>Select type of room</option>
              <option value="normal">Normal Room</option>
              <option value="Luxury">Luxury Room</option>
              <option value="deluxe">Deluxe Room</option>
              <option value="king">King Size</option>
            </select><br />
            <select class="reservation--info" name="bed-type" id="room-type">
              <option value="normal">Select bedding type</option>
              <option value="single">Single Bed</option>
              <option value="double">Double Bed</option>
              <option value="triple">Triple Bed</option>
            </select><br />
            <select class="reservation--info" name="number-of-room" id="room-type">
              <option value="">No of Room</option>
              <option value="room1">1</option>
              <option value="room2">2</option>
              <option value="room3">3</option>
              <option value="room4">4</option>
            </select><br /><br />

            <label for="guest" style="font-weight: bold">Guest: </label><br /><br />
            <div class="count">
              <div class="child">
                <label for="children">Children: </label>
              </div>
              <div class="number">
                <input type="number" value="children" /><br />
              </div>
            </div>
            <div class="count">
              <div class="child">
                <label for="adult">Adult: </label>
              </div>
              <div class="number">
                <input type="number" value="adult" />
              </div>
            </div>
            <div class="count">
              <div class="child">
                <label for="check in">check in</label>
              </div>
              <div class="number"><input type="date" value="date" /><br /></div>
            </div>
            <div class="count">
              <div class="child">
                <label for="check out">check out</label>
              </div>
              <div class="number"><input type="date" value="date" /><br /></div>
            </div>
            <button type="submit" class="submit">Check Availability</button>
          </div>
          <div></div>
        </form>
      </div>
    </div>
</body>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js"></script>
<script>
  $(document).ready(function () {
    // Initialize main carousel
    $('.carousel').slick({
      dots: false,
      arrows: true, // Show navigation arrows
      prevArrow: '<button type="button" class="slick-prev">Previous</button>',
      nextArrow: '<button type="button" class="slick-next">Next</button>',
      infinite: true,
      speed: 500, // Set the speed to 500 milliseconds for smooth sliding
      slidesToShow: 1,
      slidesToScroll: 1,
      asNavFor: '.thumbnails',
      autoplay: true,
      autoplaySpeed: 2000
    });

    // Initialize thumbnail carousel
    $('.thumbnails').slick({
      dots: false,
      arrows: false,
      infinite: true,
      speed: 500, // Set the speed to 500 milliseconds for smooth sliding
      slidesToShow: 5,
      slidesToScroll: 1,
      focusOnSelect: true,
      asNavFor: '.carousel'
    });
  });
</script>



</html>
<?php
include ('footer.php')
  ?>