<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Rooms</title>
  <link rel="stylesheet" href="./css/dashboard.css" />
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
        <a href="g-setting.php"> <img src="../static/images/logo.png" alt="img"></a>
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
        <li>
          <a href="#">
            <div>Booking Manage</div>
          </a>
        </li>
        <li>
          <a href="#">
            <div>Rooms</div>
          </a>
        </li>
        <li>
          <a href="check.php">
            <div>Check ins-outs</div>
          </a>
        </li>
        <li>
          <a href="setting.php">
            <div>Settings</div>
          </a>
        </li>
        <li>
          <a href="home.php">
            <div>Log out</div>
          </a>
        </li>
      </ul>
    </div>

    <div class="second--section">
      <div class="more--details">
        <h2 style="text-align:left;" >Room List</h2><br>
        <hr><br>
        <table border="1px" style="border-collapse: collapse; width: 100%"> 
          <thead>
            <tr>
              <th rowspan="2">S.no</th>
              <th colspan="2">Room</th>
              <th colspan="2">Date</th>
              <th colspan="2">Duration</th>
              <th rowspan="2">Booking Status</th>
              <th rowspan="2">Customer</th>
              <th rowspan="2">Phone Number</th>
              <th rowspan="2">Status</th>
            </tr>
            <tr>
              <th>Room type</th>
              <th>Room number</th>
              <th>Check-in</th>
              <th>Check-out</th>
              <th>Check-in</th>
              <th>Check-out</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
  <div class="footer"></div>
</body>

</html>