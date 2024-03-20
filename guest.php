<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Dashboard</title>
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
            <a href="room.php">
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
  </body>
</html>
