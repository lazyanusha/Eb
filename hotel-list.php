<?php
include 'connection.php';

if (isset($_POST['query'])) {
    $search_query = mysqli_real_escape_string($conn, $_POST['query']);
    $sql = "SELECT * FROM hotels WHERE hotel_name LIKE '%$search_query%' OR hotel_address LIKE '%$search_query%'";
} else {
    $sql = "SELECT * FROM hotels";
}

$result = mysqli_query($conn, $sql);
$filtered_hotels = [];

if ($result) {
    while ($row_hotel = mysqli_fetch_assoc($result)) {
        $hotel_id = $row_hotel['hotel_id'];
        // Count total rooms
        $sql_total_rooms = "SELECT SUM(quantity) AS total_rooms FROM rooms WHERE hotel_id = $hotel_id";
        $result_total_rooms = mysqli_query($conn, $sql_total_rooms);
        $row_total_rooms = mysqli_fetch_assoc($result_total_rooms);
        $row_hotel['total_rooms'] = $row_total_rooms['total_rooms'];

        // Count available rooms
        $sql_available_rooms = "SELECT SUM(quantity) AS available_rooms FROM rooms WHERE hotel_id = $hotel_id AND availability = 'available'";
        $result_available_rooms = mysqli_query($conn, $sql_available_rooms);
        $row_available_rooms = mysqli_fetch_assoc($result_available_rooms);
        $row_hotel['available_rooms'] = $row_available_rooms['available_rooms'];

        // Count inquired rooms
        $sql_inquired_rooms = "SELECT SUM(room_number) AS inquired_rooms FROM reservations WHERE hotel_id = $hotel_id AND reservation_status = 'confirmed'";
        $result_inquired_rooms = mysqli_query($conn, $sql_inquired_rooms);
        $row_inquired_rooms = mysqli_fetch_assoc($result_inquired_rooms);
        $row_hotel['inquired_rooms'] = $row_inquired_rooms['inquired_rooms'];

        $filtered_hotels[] = $row_hotel;
    }
} else {
    echo "Error executing hotel query: " . mysqli_error($conn);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Manage Hotels</title>
    <link rel="stylesheet" href="./css/dashboard.css">
</head>
<style>
    button {
        padding: 8px 10px !important;
        cursor: pointer;
        background: linear-gradient(to top, #7969c7, #2b3454);
        color: #f9f9f9 !important;
        border: none;
    }

    .button1 {
        padding: 8px 10px !important;
        cursor: pointer;
        background: linear-gradient(to top, #7969c7, #f00);
        border: none;
        color: #f9f9f9 !important;
    }

    .action {
        display: flex;
        column-gap: 10px;
        border: none;
        justify-content: center;
    }

    input {
        padding: 8px 20px;
        border: 1px solid #7969c7;
    }
</style>

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
                    <h2>Hotel Details...</h2>
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
                            <th rowspan="2">Hotel id</th>
                            <th rowspan="2">Name</th>
                            <th rowspan="2">Email</th>
                            <th rowspan="2">Contact</th>
                            <th rowspan="2">Location</th>
                            <th colspan="3">Rooms</th>
                            <th rowspan="2">Action</th>
                        </tr>
                        <tr>
                            <th>Total</th>
                            <th>Available</th>
                            <th>Booked</th>

                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($filtered_hotels as $hotel): ?>
                            <tr>
                                <td><?php echo $hotel['hotel_id']; ?></td>
                                <td>
                                    <a href="book.php?hotel_id=<?php echo $hotel['hotel_id']; ?>">
                                        <?php echo $hotel['hotel_name']; ?>
                                    </a>
                                </td>
                                <td><?php echo $hotel['hotel_email']; ?></td>
                                <td><?php echo $hotel['hotel_contact']; ?></td>
                                <td><?php echo $hotel['hotel_address']; ?></td>
                                <td><?php echo $hotel['total_rooms']; ?></td>
                                <td><?php echo $hotel['available_rooms']; ?></td>
                                <td><?php echo $hotel['inquired_rooms']; ?></td>

                                <td class="action">
                                    <form action="hupdate.php" method="post">
                                        <input type="hidden" name="hotel_id" value="<?php echo $hotel['hotel_id']; ?>">
                                        <button type="submit" name="update">Update</button>
                                    </form>
                                    <form action="delete.php" method="post">
                                        <input type="hidden" name="hotel_id" value="<?php echo $hotel['hotel_id']; ?>">
                                        <button class="button1" type="submit" name="delete"
                                            onclick="return confirm('Confirm delete?')">Delete</button>
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
</body>

</html>