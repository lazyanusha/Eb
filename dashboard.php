<?php
include 'connection.php';
// Fetch room details from the database
$sql = "SELECT COUNT(*) AS total_rooms FROM rooms";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
$total_rooms = $row['total_rooms'];

$sql = "SELECT COUNT(*) AS available_rooms FROM rooms WHERE availability = 'available'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
$available_rooms = $row['available_rooms'];

$sql = "SELECT COUNT(*) AS inquired_rooms FROM rooms WHERE availability = 'inquired'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
$inquired_rooms = $row['inquired_rooms'];

$sql = "SELECT COUNT(*) AS cancelled_rooms FROM rooms WHERE availability = 'cancelled'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
$cancelled_rooms = $row['cancelled_rooms'];
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
        <div class="card color1">
          <div class="card--content">
            <h2 class="card--title">Total Rooms</h2>
            <p class="card--details"><?php echo $total_rooms; ?></p>
          </div>
        </div>

        <div class="card color2">
          <div class="card--content">
            <h2 class="card--title">Available Rooms</h2>
            <p class="card--details"><?php echo $available_rooms; ?></p>
          </div>
        </div>
        <div class="card color3">
          <div class="card--content">
            <h2 class="card--title">Inquired Rooms</h2>
            <p class="card--details"><?php echo $inquired_rooms; ?></p>
          </div>
        </div>
        <div class="card color4">
          <div class="card--content">
            <h2 class="card--title">Cancelled Rooms</h2>
            <p class="card--details"><?php echo $cancelled_rooms; ?></p>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="footer"></div>
</body>

</html>