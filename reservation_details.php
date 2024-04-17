<?php

session_start();
include 'connection.php';
$sql_reservation = "SELECT r.*, h.hotel_name, h.hotel_address  FROM reservations r
                    INNER JOIN hotels h ON r.hotel_id = h.hotel_id ORDER BY reservation_id ASC";
$stmt_reservation = mysqli_prepare($conn, $sql_reservation);
if ($stmt_reservation) {
    if (mysqli_stmt_execute($stmt_reservation)) {
        $result_reservation = mysqli_stmt_get_result($stmt_reservation);
        // Fetch all reservation records
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
            <p>Records...</p>
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
                            <td><?php echo $info['hotel_address']; ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</body>

</html>