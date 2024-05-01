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
      <p>Welcome sweetpea.!</p>
      <a href="g-setting.php" class="profile-picture"><img src="logo.png" alt="img"></a>
    </div>

  </div>
  <div class="dashboard">
    <div class="sidebar">
      <!-- Main Navigation Links -->
      <ul class="main">
        <li><a href="dashboard.php">
            <div>Dashboard</div>
          </a></li>
        <li class="dropdown"><a href="bookingmanage.php">
            <div>
              Booking Manage
            </div>
          </a>
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
      <?php
      include 'reservation_details.php';
      ?>
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