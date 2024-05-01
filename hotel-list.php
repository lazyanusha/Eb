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
        $filtered_hotels[] = $row_hotel;
    }
} else {
    echo "Error executing hotel query: " . mysqli_error($conn);
}

// Initialize variables
$services = [];
$rooms = [];
$total_rooms = 0;
$available_rooms = 0;
$inquired_rooms = 0;

if (!isset($_POST['query'])) {
    // Count total rooms
    $sql_total_rooms = "SELECT COUNT(*) AS total_rooms FROM rooms";
    $result_total_rooms = mysqli_query($conn, $sql_total_rooms);
    $row_total_rooms = mysqli_fetch_assoc($result_total_rooms);
    $total_rooms = $row_total_rooms['total_rooms'];

    // Count available rooms
    $sql_available_rooms = "SELECT COUNT(*) AS available_rooms FROM rooms WHERE availability = 'available'";
    $result_available_rooms = mysqli_query($conn, $sql_available_rooms);
    $row_available_rooms = mysqli_fetch_assoc($result_available_rooms);
    $available_rooms = $row_available_rooms['available_rooms'];

    // Count inquired rooms
    $sql_inquired_rooms = "SELECT COUNT(*) AS inquired_rooms FROM rooms WHERE availability = 'inquired'";
    $result_inquired_rooms = mysqli_query($conn, $sql_inquired_rooms);
    $row_inquired_rooms = mysqli_fetch_assoc($result_inquired_rooms);
    $inquired_rooms = $row_inquired_rooms['inquired_rooms'];
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
                            <th rowspan="2">Hotel id</th>
                            <th rowspan="2">Name</th>
                            <th rowspan="2">Email</th>
                            <th rowspan="2">Contact</th>
                            <th rowspan="2">Location</th>
                            <th colspan="4">Rooms</th>
                            <th rowspan="2">Services</th>
                            <th rowspan="2">Action</th>
                        </tr>
                        <tr>
                            <th>Room type</th>
                            <th>Available</th>
                            <th>Booked</th>
                            <th>Total</th>
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
                                <!-- Display rooms data -->
                                <td><?php echo implode(", ", array_keys($rooms)); ?></td>
                                <td><?php echo $total_rooms; ?></td>
                                <td><?php echo $available_rooms; ?></td>
                                <td><?php echo $inquired_rooms; ?></td>
                                <!-- Display services data -->
                                <td><?php echo implode(", ", $services); ?></td>

                                <td class="action">
                                    <form action="update.php" method="post">
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