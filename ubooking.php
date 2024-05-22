<?php
if (session_status() === PHP_SESSION_NONE) {
  session_start();
}

include 'connection.php';

if (!isset($_SESSION['email'])) {
    header("Location: login.php");
    exit();
}

$loggedInEmail = $_SESSION['email'];

$sql = "SELECT r.*, h.hotel_name, h.hotel_address, r.reservation_status 
        FROM reservations r
        INNER JOIN hotels h ON r.hotel_id = h.hotel_id 
        WHERE r.email = ?
        ORDER BY CASE WHEN r.reservation_status = 'pending' THEN 0 ELSE 1 END, r.reservation_status ASC";

$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $loggedInEmail);
$stmt->execute();
$result = $stmt->get_result();

if (!$result) {
    echo "error ";
    exit();
}

$reservations = [];
while ($row = $result->fetch_assoc()) {
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
            padding: 8px 25px !important;
            padding-top: 20px;
            cursor: pointer;
            background: linear-gradient(to top, #7969c7, #2b3454);
            color: #f9f9f9 !important;
            border: none;
        }

        input {
            width: 100%;
            padding: 7px 20px;
            border: 1px solid #7969c7;
        }

        .second--section {
            padding: 55px;
            display: flex;
            flex-direction: column;
            row-gap: 30px;
        }

        .more--details {
            display: flex;
            flex-direction: column;
            row-gap: 20px;
        }

        .button1 {
            padding: 9px 25px !important;
            cursor: pointer;
            background: linear-gradient(to top, #7969c7, #f00);
            border: none;
            color: #f9f9f9 !important;
        }

        .action {
            display: flex;
            justify-content: space-around;
            border: none;
        }

        form {
            display: flex;
            column-gap: 20px;
            align-items: center;
        }
    </style>
</head>

<body>
    <!-- heading -->
    <?php
    include 'nav.php';
    ?>

    <div class="dashboard">
        <div class="second--section">
            <div class="info">
                <h2>Booking Details...</h2>
                <a href="dashboard.php"><button>Back</button></a>
            </div>
            <div class="search">
                <form action="#" id="searchForm" onsubmit="return true;">
                    <input type="search" placeholder="search here" name="search" />
                    <button type="submit" onclick="searchTable()">search</button>
                </form>
            </div>
            <div class="more--details">

                <table border="1px" style="border-collapse: collapse; width: 100%">
                    <thead>
                        <tr>
                            <th rowspan="2">Booking id</th>
                            <th rowspan="2">Date/Time</th>
                            <th colspan="4">Guests</th>
                            <th colspan="2">Date</th>
                            <th colspan="2">Room</th>
                            <th rowspan="2">Hotel Name</th>
                            <th rowspan="2" colspan="2">Action</th>
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
                                <!-- Table data -->
                                <td><?php echo $info['reservation_id']; ?></td>
                                <td><?php echo $info['booking_date']; ?></td>
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
                                <td class="action">

                                    <?php if ($info['reservation_status'] == 'confirmed' || $info['reservation_status'] == 'cancelled' || $info['reservation_status'] == 'declined'): ?>
                                        <button type="button" disabled><?php echo $info['reservation_status'] ?></button>
                                    <?php else: ?>
                                        <form action="cancel.php" method="POST">
                                            <input type="hidden" name="reservation_id"
                                                value="<?php echo $info['reservation_id']; ?>">
                                            <button type="submit" name="declined" class="button1">Cancel</button>
                                        </form>
                                    <?php endif; ?>
                                </td>

                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</body>

</html>
<?php
include 'footer.php';
?>