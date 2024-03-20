<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Dashboard</title>
  <link rel="stylesheet" href="./css/dashboard.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
  <style>
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
      <p>Easybookings</p>
    </div>
    <div class="second--part1">
      <div class="search">
        <form action="">
          <input type="search" placeholder="search here" name="search" />
          <button type="submit">search</button>
        </form>
      </div>
      <div class="admin--profile">
        <p>Welcome sweetpea.!</p>
        <a href="g-setting.php"> <img src="./images/logo3.png" alt="img"></a>
      </div>
    </div>
  </div>
  <div class="dashboard">
    <div class="sidebar">
      <ul class="main">
        <li>
          <a href="dashboard.php">
            <div>Dashboard</div>
          </a>
        </li>
        <li>
          <a href="guest.php">
            <div>Guests</div>
          </a>
        </li>
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
        <li>
          <a href="#">
            <div>Rooms</div>
          </a>
        </li>
        <li class="dropdown">
          <div class="dropdown-btn">
            Manage Hotel
            <i class="fas fa-chevron-right"></i>
          </div>
          <ul class="dropdown-content">
            <li><a href="roomtype.php">Room Type</a></li>
            <li><a href="bedtype.php">Bed Types</a></li>
            <li><a href="facilities.php">Facilities</a></li>
          </ul>
        </li>
        <li>
          <a href="setting.php">
            <div>Settings</div>
          </a>
        </li>
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
        <table border="1px" style="border-collapse: collapse; width: 100%">
          <caption>
            Past Records..
          </caption>
          <thead>
            <tr>
              <th rowspan="2">S.no</th>
              <th colspan="4">Guests</th>
              <th colspan="2">Date</th>
              <th colspan="2">Room</th>
              <th colspan="2">Duration</th>
            </tr>
            <tr>
              <th>Name</th>
              <th>Contact</th>
              <th>Email</th>
              <th>Guest count</th>
              <th>Check-in</th>
              <th>Check-out</th>
              <th>Room type</th>
              <th>Room number</th>
              <th>Check-in</th>
              <th>Check-out</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>1</td>
              <td>Sumina Rokaha</td>
              <td>9803428166</td>
              <td>sumina@gmail.com</td>
              <td>1</td>
              <td>18/2/2024</td>
              <td>18/2/2024</td>
              <td>Normal</td>
              <td>101</td>
              <td>07:00</td>
              <td>23:00</td>
            </tr>
          </tbody>
        </table>
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