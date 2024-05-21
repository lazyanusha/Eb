<?php
session_start();
include 'connection.php';
include 'nav.php';

if (!isset($_SESSION['email'])) {
  header("location: login.php");
  exit;
}

if (isset($_SESSION['email'])) {
  $userEmail = $_SESSION['email'];
  $sql_user = "SELECT fullname, phone FROM users WHERE email = ?";
  $sql = "SELECT r.*, h.hotel_name, h.hotel_address, r.reservation_status 
FROM reservations r
INNER JOIN hotels h ON r.hotel_id = h.hotel_id 
ORDER BY CASE WHEN r.reservation_status = 'pending' THEN 0 ELSE 1 END, r.reservation_status ASC";
  
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Notifications</title>
  <link rel="stylesheet" href="./css/dashboard.css">
  <style>
    .table {
      margin: 55px;
      padding: 30px;

    }

    table,
    tr,
    td,
    th {
      border: 1px solid #8d69c0;
      padding: 10px;
    }

    button {
      padding: 10px 25px;
      cursor: pointer;
    }
  </style>
</head>

<body>
  <div class="table">
    <div class="part">
      <h2> Notifications!!</h2>
      <a href="dashboard.php"><button>Back</button></a>
    </div>
    <div class="more--details">

      <table border="1px" style="border-collapse: collapse; width: 100%">
        <thead>
          <tr>
            <th rowspan="2">Booking id</th>
            <th colspan="4">Guests</th>
            <th colspan="2">Date</th>
            <th colspan="2">Room</th>
            <th rowspan="2">Hotel Name</th>
            <th rowspan="2" colspan="2">Booking Status</th>
          </tr>
          <tr>
            <th>Name</th>
            <th>Contact</th>
            <th>Email</th>
            <th>Guest count</th>
            <th>Check-in</th>
            <th>Check-out</th>
            <th>Room type</th>
            <th>Room quantity</th>

          </tr>
        </thead>
        <tbody>
          <?php foreach ($reservations as $info): ?>
            <tr>
              <td><?php echo $info['reservation_id']; ?></td>
              <td><?php echo $info['guest_name']; ?></td>
              <td><?php echo $info['contact_information']; ?></td>
              <td><?php echo $info['email']; ?></td>
              <td><?php echo $info['guests_num']; ?></td>
              <td><?php echo $info['check_in_date']; ?></td>
              <td><?php echo $info['check_out_date']; ?></td>
              <td><?php echo $info['room_type']; ?></td>
              <td><?php echo $info['room_number']; ?></td>
              <td>
                <a href="book.php?hotel_id=<?php echo $info['hotel_id']; ?>">
                  <?php echo $info['hotel_name']; ?>
                </a>
              </td>

              <td>
                <?php if ($info['reservation_status'] == 'confirmed' || $info['reservation_status'] == 'cancelled'): ?>
                  <button type="button" disabled>View</button>
                <?php elseif ($info['reservation_status'] == 'pending'): ?>
                  <form action="reservation_update.php" method="post"
                    onsubmit="updateReservationStatus(this); return false;">
                    <input type="hidden" name="reservation_id" value="<?php echo $info['reservation_id']; ?>">
                    <select name="reservation_status">
                      <option value="Pending" <?php if ($info['reservation_status'] == "pending")
                        echo 'selected'; ?>>
                        Pending</option>
                      <option value="Confirmed" <?php if ($info['reservation_status'] == "confirmed")
                        echo 'selected'; ?>>
                        Confirm</option>
                      <option value="Cancelled" <?php if ($info['reservation_status'] == "cancelled")
                        echo 'selected'; ?>>
                        Cancel</option>
                    </select>
                    <button type="submit" name="submit">Update</button>
                  </form> <?php endif; ?>
              </td>

            </tr>

          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  </div>
</body>

</html>
<?php
include 'footer.php';
?>