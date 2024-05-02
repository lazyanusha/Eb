<?php

include 'connection.php';
$sql = "SELECT r.*, h.hotel_name, h.hotel_address, r.reservation_status 
FROM reservations r
INNER JOIN hotels h ON r.hotel_id = h.hotel_id 
ORDER BY CASE WHEN r.reservation_status = 'pending' THEN 0 ELSE 1 END, r.reservation_status ASC";



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
      padding: 9px 13px;
      background-color: #f9f9f9;
      border: 1px solid #7969c7;
      border-radius: 5px;
      outline: none;
      cursor: pointer;
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
      border: none;
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

    form {
      display: flex;
      column-gap: 20px;
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

    function updateReservationStatus(form) {
      var selectedOption = form.querySelector('select[name="reservation_status"]').value;
      form.querySelector('input[name="reservation_status"]').value = selectedOption;
      form.submit();
    }

  </script>

</body>

</html>