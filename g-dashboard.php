<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Dashboard</title>
    <link rel="stylesheet" href="../static/css/dashboard.css" />
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
      <style>
          .second--part{
  align-items: center;
  width: 20%;
}
      </style>
  </head>
  <body>
    <div class="dash--heading">
      <div class="hotel--name">
        <p>Easybookings</p>
      </div>
      <div class="second--part">
        <div class="search">

<i class="fa-solid fa-bell">
    <span class="badge"></span>
</i>

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
            <a href="g-dashboard.php">
              <div>Dashboard</div>
            </a>
          </li>
          <li>
            <a href="g-booking.php">
              <div>Bookings</div>
            </a>
          </li>
          <li>
            <a href="notify.php">
              <div>Notifications</div>
            </a>
          </li>
          <li>
            <a href="g-setting.php">
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
        <div class="card--container">
          <div class="card color1">
            <div class="card--content">
              <h2 class="card--title">Total Bookings</h2>
              <p class="card--details">3</p>
            </div>
          </div>

          <div class="card color2">
            <div class="card--content">
              <h2 class="card--title">Wishlist</h2>
              <p class="card--details">1</p>
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
             Bookings...
            </caption>
            <thead>
              <tr>
                <th>S.no</th>
                <th>Hotel Name</th>
                <th>Total Rooms</th>
                <th colspan="2">Booking Date</th>
                <th>View Booking</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>1</td>
                <td>Sumina Rokaha</td>
                <td>1</td>
                <td>18/2/2024</td>
                <td>18/2/2024</td>
                  <td><a href="g-booking.php">View...</a></td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
    <div class="footer"></div>
  </body>
</html>
