<?php

session_start();
include 'connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["action"]) && $_POST["action"] == "cancelled" && isset($_POST["reservation_id"])) {
  $reservationId = $_POST["reservation_id"];
  $loggedInEmail = $_SESSION['email'];

  if (!isset($_SESSION['canceled_reservations']) || !in_array($reservationId, $_SESSION['canceled_reservations'])) {
    $_SESSION['canceled_reservations'][] = $reservationId;

    $cancelSql = "UPDATE reservations SET reservation_status = 'cancelled' WHERE reservation_id = ? AND email = ?";
    $cancelStmt = $conn->prepare($cancelSql);
    $cancelStmt->bind_param("is", $reservationId, $loggedInEmail);

    if ($cancelStmt->execute()) {
      echo "<script>alert('Reservation update successfully, Thank you!!. window.location='ubooking.php';</script>";
      exit();
    } else {
      echo "Error occurred while cancelling the reservation.";
      exit();
    }
  }
} else {
  // Handle invalid request
  echo "Invalid request";
  exit();
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Reservation Update</title>
  <link rel="stylesheet" href="./css/dashboard.css">
</head>

<body>
  <?php echo $hotelName; ?>
  <div>
    <form action="#" method="post">
      <div>
        <h2>Reservation</h2>
      </div>
      <hr />
      <div class="reservation">
        <input type="hidden" name="reservation_id" value="<?php echo $reservation_id; ?>">
        <input type="hidden" name="hotel_id" value="<?php echo $hotel_id; ?>">
        <input name="fullname" value="<?php echo $guestName; ?>">
        <input name="contact" value="<?php echo $contact; ?>">
        <input type="hidden" name="email" value="<?php echo $userEmail; ?>">
        <label for="check-in" class="reservation--label">Check-in:</label>
        <input type="date" name="check-in" id="check-in" value="<?php echo $checkInDate; ?>"
          min="<?php echo date('Y-m-d', strtotime('+1 day')); ?>" required>

        <label for="check-out" class="reservation--label">Check-out:</label>
        <input type="date" name="check-out" id="check-out" value="<?php echo $checkOutDate; ?>">

        <!-- Room Type Selection -->
        <label for="room-type" class="reservation--label">Type of room:</label>
        <input type="text" name="room-type" id="room-type" value="<?php echo $roomType; ?>" readonly>

        <label for="bed-type" class="reservation--label">Bedding type:</label>
        <input type="text" name="bed-type" id="bed-type" value="<?php echo $bedType; ?>" readonly>

        <label for="number-of-room">Room Quantity:</label>
        <input type="text" name="number-of-room" id="number-of-room" value="<?php echo $numberOfRooms; ?>" readonly>

        <label for="guest">Guests:</label><br>
        <label for="children" class="reservation--label">Children:</label>
        <input type="text" name="children" id="children" value="<?php echo $children; ?>" readonly>

        <label for="adult" class="reservation--label">Adult:</label>
        <input type="text" name="adult" id="adult" value="<?php echo $adults; ?>" readonly>

        <label for="room-price" class="reservation--label">Price per night:</label>
        <input type="text" name="total-price" id="room-price" class="reservation--info"
          value="<?php echo $pricePerNight; ?>" readonly>
        <input type="hidden" name="price-per-night" id="price-per-night" value="<?php echo $pricePerNight; ?>">

        <label for="payment">Payment Method:</label>
        <input type="text" name="payment" id="payment" value="<?php echo $paymentMethod; ?>" readonly>

        <button type="submit" class="submit">Update Status</button>
      </div>
    </form>
  </div>
</body>

<script>
  document.getElementById('check-in').addEventListener('change', function () {
    var checkInDate = new Date(this.value);
    var checkOutInput = document.getElementById('check-out');
    checkOutInput.min = formatDate(new Date(checkInDate.setDate(checkInDate.getDate() + 1)));
  });

  function formatDate(date) {
    var day = date.getDate();
    var month = date.getMonth() + 1;
    var year = date.getFullYear();

    if (month < 10) {
      month = '0' + month;
    }
    if (day < 10) {
      day = '0' + day;
    }

    return year + '-' + month + '-' + day;
  }

</script>

</html>
<?php
include 'footer.php';
?>