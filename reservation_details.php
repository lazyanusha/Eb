<?php

session_start();
include 'connection.php';
$sql_reservation = "SELECT r.*, h.hotel_name, h.hotel_address  FROM reservations r
                    INNER JOIN hotels h ON r.hotel_id = h.hotel_id ORDER BY reservation_id ASC";
$stmt_reservation = mysqli_prepare($conn, $sql_reservation);
if ($stmt_reservation) {
    if (mysqli_stmt_execute($stmt_reservation)) {
        $result_reservation = mysqli_stmt_get_result($stmt_reservation);
        $reservations = [];
        while ($row_reservation = mysqli_fetch_assoc($result_reservation)) {
            $reservations[] = $row_reservation;
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
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <div class="second--section">
        <div class="heading">
            <p>Booking Details...</p>
            <div class="search">
                <form action="">
                    <input type="search" placeholder="search here" name="search" />
                    <button type="submit">search</button>
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
                        <th rowspan="2">Booking Status</th>
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
                            <td> <a
                                    href="book.php?hotel_id=<?php echo $info['hotel_id']; ?>"><?php echo $info['hotel_name']; ?></a>
                            </td>
                            <td>
                                <select id="status" name="status"
                                    onchange="changeBookingStatus(<?php echo $row['reservation_id']; ?>, this.value)">
                                    <option value="Pending" <?php if ($info['reservation_status'] == "Pending")
                                        echo 'selected'; ?>>Pending</option>
                                    <option value="Approved" <?php if ($info['reservation_status'] == "Approved")
                                        echo 'selected'; ?>>Approved</option>
                                    <option value="Denied" <?php if ($info['reservation_status'] == "Denied")
                                        echo 'selected'; ?>>Denied</option>
                                </select>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
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
            $bstatus = $_POST["reservation_status"];
            $bid = $_POST["reservation_id"];
            $sql = "UPDATE vehicle SET `reservation_status`= 'reservation_status'
            WHERE`reservation_id` = '$reservation_id'";
            $result = mysqli_query($conn, $sql);
            if ($result) {
                header("Location: bookingmanage.php");


            } else {
                echo "Error: ".mysqli_error($conn);
            }

        }
    </script>
</body>

</html>