<?php
session_start();
include 'connection.php';

$hotelName = $hotelLocation = '';

if (isset($_GET['hotel_id'])) {
    $hotel_id = $_GET['hotel_id'];

    // Fetch hotel information
    $sql_hotel = "SELECT * FROM hotels WHERE hotel_id = ?";
    $stmt_hotel = mysqli_prepare($conn, $sql_hotel);
    if ($stmt_hotel) {
        mysqli_stmt_bind_param($stmt_hotel, "i", $hotel_id);
        if (mysqli_stmt_execute($stmt_hotel)) {
            $result_hotel = mysqli_stmt_get_result($stmt_hotel);
            if ($row_hotel = mysqli_fetch_assoc($result_hotel)) {
                $hotelName = $row_hotel['hotel_name'];
                $hotelLocation = $row_hotel['hotel_address'];
            } else {
                echo "Hotel not found.";
                exit;
            }
        } else {
            echo "Error executing hotel query: " . mysqli_error($conn);
            exit;
        }
        mysqli_stmt_close($stmt_hotel);
    } else {
        echo "Error preparing hotel query: " . mysqli_error($conn);
        exit;
    }
}

// Retrieve reservation ID from the database
if (isset($_GET['reservation_id'])) {
    $reservation_id = $_GET['reservation_id'];

    $sql_reservation = "SELECT * FROM reservations WHERE reservation_id = ?";
    $stmt_reservation = mysqli_prepare($conn, $sql_reservation);
    if ($stmt_reservation) {
        mysqli_stmt_bind_param($stmt_reservation, "i", $reservation_id);
        if (mysqli_stmt_execute($stmt_reservation)) {
            $result_reservation = mysqli_stmt_get_result($stmt_reservation);
            if ($row_reservation = mysqli_fetch_assoc($result_reservation)) {
                // Assign reservation details to $info array
                $info = $row_reservation;
            } else {
                echo "Reservation not found.";
                exit;
            }
        } else {
            echo "Error executing reservation query: " . mysqli_error($conn);
            exit;
        }
        mysqli_stmt_close($stmt_reservation);
    } else {
        echo "Error preparing reservation query: " . mysqli_error($conn);
        exit;
    }
} else {
    echo "Reservation ID not provided.";
    exit;
}
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
        <a href="g-setting.php"> <img src="../static/images/logo.png" alt="img"></a>
      </div>
    </div>
  </div>
  <div class="dashboard">
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
              <th colspan="2">Hotel Information</th>
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
              <th>Hotel Name</th>
              <th>Hotel Address</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td><?php echo $info['reservation_id']; ?></td>
              <td><?php echo $info['guest_name']; ?></td>
              <td><?php echo $info['contact_information']; ?></td>
              <td><?php echo $info.['email']; ?></td>
              <td><?php echo $info['guests_num']; ?></td>
              <td><?php echo $info['check_in_date']; ?></td>
              <td><?php echo $info['check_out_date']; ?></td>
              <td><?php echo $info['room_type']; ?></td>
              <td><?php echo $info['room_number']; ?></td>
              <td><?php echo $hotelName; ?></td>
              <td><?php echo $hotelLocation; ?></td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
  <div class="footer"></div>
</body>

</html>
