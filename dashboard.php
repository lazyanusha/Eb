<?php
include 'connection.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Dashboard</title>
  <link rel="stylesheet" href="./css/dashboard.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
  <style>
    a {
      text-decoration: none;
      color: black;
    }

    a:hover {
      color: blueviolet;
    }

    .dropdown-btn {
      cursor: pointer;
      position: relative;
    }

    .dropdown-btn i {
      position: absolute;
      color: white;
      right: 10px;
      top: 50%;
      transform: translateY(-50%);
      transition: transform 0.3s ease;
    }

    .dropdown-content {
      display: none;
      position: inherit;
    }

    .dropdown.active .dropdown-content {
      display: block;
    }

    .dropdown.active .dropdown-btn i {
      transform: translateY(-50%) rotate(90deg);
    }
  </style>
</head>

<body>
  <div class="dash--heading">
    <div class="hotel--name">
      <img src="./images/logo3.png" alt="img">
    </div>
    <div class="admin--profile">
    <p>Welcome Admin.!</p>
    <a href="g-setting.php" class="profile-picture"><img src="logo.png" alt="img"></a>
</div>

  </div>
  <div class="dashboard">
    <!-- Sidebar Section -->
    <div class="sidebar">
      <!-- Main Navigation Links -->
      <ul class="main">
        <li><a href="dashboard.php">
            <div>Dashboard</div>
          </a></li>
        <li><a href="guest.php">
            <div>Guests</div>
          </a></li>
        <li class="dropdown">
          <div class="dropdown-btn">
            Booking Manage
            <i class="fas fa-chevron-right"></i>
          </div>
          <ul class="dropdown-content">
            <li><a href="booking_request.php">Booking Requests</a></li>
            <li><a href="all_bookings.php">All Bookings</a></li>
          </ul>
        </li>
        <li><a href="rooms.php">
            <div>Rooms</div>
          </a></li>
        <li class="dropdown">
          <div class="dropdown-btn">
            Manage Hotel
            <i class="fas fa-chevron-right"></i>
          </div>
          <ul class="dropdown-content">
            <li><a href="hoteladd.php">Add Hotel</a></li>
            <li><a href="imagegallery.php">Image Gallery</a></li>
          </ul>
        </li>
        <li><a href="setting.php">
            <div>Settings</div>
          </a></li>
      </ul>
    </div>

    <div class="second--section">
      <div class="card--container">
        <div class="card color1">
          <div class="card--content">
            <h2 class="card--title">Total Rooms</h2>
            <p class="card--details">345</p>
          </div>
        </div>

        <div class="card color2">
          <div class="card--content">
            <h2 class="card--title">Available Rooms</h2>
            <p class="card--details">201</p>
          </div>
        </div>
        <div class="card color3">
          <div class="card--content">
            <h2 class="card--title">Inquired Rooms</h2>
            <p class="card--details">144</p>
          </div>
        </div>
        <div class="card color4">
          <div class="card--content">
            <h2 class="card--title">Cancellations</h2>
            <p class="card--details">1</p>
          </div>
        </div>
      </div>
      <div class="more--details">
        <?php
        include 'reservation_details.php';
        ?>
      </div>
    </div>
  </div>
  <div class="footer"></div>

  <script>
    document.querySelectorAll('.dropdown-btn').forEach(btn => {
      btn.addEventListener('click', function () {
        const parent = this.parentElement;
        parent.classList.toggle('active');
      });
    });

  </script>
</body>

</html>