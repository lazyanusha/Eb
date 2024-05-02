<?php

include 'connection.php';
$sql = "SELECT * FROM rooms
ORDER BY CASE WHEN availability = 'available' THEN 0 ELSE 1 END, room_id ASC";

$result = mysqli_query($conn, $sql);
$rooms = [];

if ($result) {
  while ($row = mysqli_fetch_assoc($result)) {
    $rooms[] = $row;
  }
} else {
  echo "Error fetching admins: " . mysqli_error($conn);
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
              <th>Room Id</th>
              <th>Hotel Id</th>
              <th>Room Type</th>
              <th>Room Number</th>
              <th>Status</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($rooms as $row): ?>
              <tr>
                <td><?php echo $row['room_id']; ?></td>
                <td>
                  <?php echo $row['hotel_id']; ?>
                </td>
                <td><?php echo $row['room_type']; ?></td>
                <td><?php echo $row['room_number']; ?></td>


                <td>
                  <form action="reservation_update.php" method="post"
                    onsubmit="updateReservationStatus(this); return false;">
                    <input type="hidden" name="room_id" value="<?php echo $row['room_id']; ?>">
                    <select name="availability">
                      <option value="available" <?php if ($row['availability'] == "available")
                        echo 'selected'; ?>>
                        Available</option>
                      <option value="bookeded" <?php if ($row['availability'] == "bookeded")
                        echo 'selected'; ?>>
                        Booked</option>
                      <option value="not in serviceled" <?php if ($row['availability'] == "not in serviceled")
                        echo 'selected'; ?>>
                        Not in service</option>

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
      var selectedOption = form.querySelector('select[name="availability"]').value;
      form.querySelector('input[name="availability"]').value = selectedOption;
      form.submit();
    }

  </script>

</body>

</html>