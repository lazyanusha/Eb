<?php
include 'connection.php';
// Fetch room details from the database
$sql = "SELECT sum(quantity) AS total_rooms FROM rooms";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
$total_rooms = $row['total_rooms'];

$sql = "SELECT COUNT(*) AS inquired_rooms FROM reservations WHERE reservation_status = 'pending'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
$inquired_rooms = $row['inquired_rooms'];

$sql = "SELECT sum(room_number) AS booked_rooms FROM reservations WHERE reservation_status = 'confirmed'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
$booked_rooms = $row['booked_rooms'];

$sql = "SELECT sum(room_number) AS cancelled_rooms FROM reservations WHERE reservation_status = 'cancelled'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
$cancelled_rooms = $row['cancelled_rooms'];

$available_rooms = $total_rooms- $booked_rooms + $cancelled_rooms;

$sql = "SELECT COUNT(hotel_id) AS total_hotels FROM hotels";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
$total_hotels = $row['total_hotels'];


?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Dashboard</title>
  <link rel="stylesheet" href="./css/dashboard.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

</head>

<body>

  <?php
  include 'dashhead.php';
  ?>

  <div class="dashboard">
    <!-- Sidebar Section -->
    <?php
    include 'sidebar.php';
    ?>

    <div class="second--section">
      <div class="card--container">

        <div class="card--content">
          <h2 class="card--title">Total Rooms</h2>
          <p class="card--details"><?php echo $total_rooms; ?></p>
        </div>


        <div class="card--content">
          <h2 class="card--title">Available Rooms</h2>
          <p class="card--details"><?php echo $available_rooms; ?></p>

        </div>
        <a href="bookingmanage.php">

          <div class="card--content">
            <h2 class="card--title">Inquired Rooms</h2>
            <p class="card--details"><?php echo $inquired_rooms; ?></p>
          </div>

        </a>

        <div class="card--content">
          <h2 class="card--title">Booked Rooms</h2>
          <p class="card--details"><?php echo $booked_rooms; ?></p>
        </div>

        <div class="card--content">
          <h2 class="card--title">Cancelled Rooms</h2>
          <p class="card--details"><?php echo $cancelled_rooms; ?></p>
        </div>
        <a href="hotel-list.php">
          <div class="card--content">
            <h2 class="card--title">Total Hotels</h2>
            <p class="card--details"><?php echo $total_hotels; ?></p>
          </div>
        </a>
      </div>
    </div>
  </div>
  </div>
  <div class="footer"></div>
</body>

</html>