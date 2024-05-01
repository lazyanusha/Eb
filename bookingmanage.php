<?php

include 'connection.php';
$sql = "SELECT r.*, h.hotel_name, h.hotel_address, r.reservation_status FROM reservations r
        INNER JOIN hotels h ON r.hotel_id = h.hotel_id ORDER BY reservation_id ASC";


$result = mysqli_query($conn, $sql);

if (!$result) {
  echo "Error executing reservation query: " . mysqli_error($conn); // Display error message if query fails
  exit;
}

$reservations = [];

while ($row = mysqli_fetch_assoc($result)) {
  $reservations[] = $row;
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Booking Manage</title>
  <link rel="stylesheet" href="./css/dashboard.css">
  <style>
    select {
      font-size: 16px;
      padding: 9px 15px;
      background-color: #f9f9f9;
      border: 1px solid #7969c7;
      border-radius: 5px;
      outline: none;
      cursor: pointer;
    }

    option {
      padding: 30px;
      height: 300px;
    }

    /* Style for selected option */
    #status option:checked {
      background-color: ;
    }

    button {
      padding: 8px 15px !important;
      padding-top: 20px;
      cursor: pointer;
      background: linear-gradient(to top, #7969c7, #2b3454);
      color: #f9f9f9 !important;
    }

    input {
      padding: 8px 20px;
      border: 1px solid #7969c7;
    }


    .more--details {
      display: flex;
      flex-direction: column;
      row-gap: 20px;
    }
  </style>
</head>

<body>
  <!-- heading -->
  <?php
  include 'dashhead.php';
  ?>

  <div class="dashboard">
    <!-- Sidebar Section -->
    <?php
    include 'sidebar.php';
    ?>

    <!-- reservation details -->
    <div class="second--section">
      <div class="heading">
        <div class="part">
          <h2>Booking Details...</h2>
          <!-- <a href="dashboard.php"><button>Back</button></a> -->
        </div>
        <div class="search">
          <form action="#" id="searchForm" onsubmit="return true;">
            <input type="search" placeholder="search here" name="search" />
            <button type="submit" onclick="searchTable()">search</button>
          </form>
        </div>
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
              <th>Room number</th>

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
                  <select id="status<?php echo $info['reservation_id']; ?>" name="status"
                    onchange="changeBookingStatus(<?php echo $info['reservation_id']; ?>, this)">
                    <?php
                    // Define an array to hold unique reservation status values
                    $statusOptions = array();

                    foreach ($reservations as $info) {
                      $status = $info['reservation_status'];
                      // Check if the status value is not already in the array
                      if (!in_array($status, $statusOptions)) {
                        // Add the status value to the array
                        $statusOptions[] = $status;
                      }
                    }

                    // Generate the option tags for each status option
                    foreach ($statusOptions as $option) {
                      // Set the selected attribute based on the reservation status
                      $selected = ($info['reservation_status'] == $option) ? 'selected' : '';
                      echo "<option value='$option' $selected>" . ucfirst($option) . "</option>";
                    }
                    ?>
                  </select>
                </td>

                <td>
                  <form action="reservation_update.php" method="post">
                    <input type="hidden" name="reservation_id" value="<?php echo $info['reservation_id']; ?>">
                    <input type="hidden" name="reservation_status"
                      id="reservation_status_<?php echo $info['reservation_id']; ?>"
                      value="<?php echo $info['reservation_status']; ?>">
                    <button type="submit" name="submit">Update</button>
                  </form>
                </td>

              </tr>

            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    </div>

  </div>
  <div class="footer"></div>


  <script>
    function searchTable() {
      var input, filter, table, tr, td, i, txtValue;
      input = document.getElementById("searchInput");
      filter = input.value.toUpperCase();

      table = document.getElementById("myTable");
      tr = table.getElementsByTagName("tr");

      for (i = 0; i < tr.length; i++) {
        td = tr[i].getElementsByTagName("td")[2];

        if (td) {
          txtValue = td.textContent || td.innerText;
          if (txtValue.toUpperCase().indexOf(filter) > -1) {
            tr[i].style.display = "";
          } else {
            tr[i].style.display = "none";
          }
        }
      }
    }

    function changeBookingStatus(bookingId, status) {
      var xhr = new XMLHttpRequest();
      xhr.open("POST", "update_booking_status.php", true);
      xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
      xhr.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
          console.log(this.responseText);
        }
      };
      xhr.send("reservation_id=" + bookingId + "&reservation_status=" + status);
    }

  </script>

</body>

</html>