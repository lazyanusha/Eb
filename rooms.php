<?php
include 'connection.php';
function updateRoomAvailability($conn)
{
    // Get current date
    $currentDate = date('Y-m-d');

    $sql_reserved_count = "
        SELECT room_type, SUM(room_number) AS reserved_count
        FROM reservations
        WHERE check_in_date >= '$currentDate' AND check_out_date >= '$currentDate' AND reservation_status = 'confirmed'
        GROUP BY room_type
    ";
    $result_reserved_count = mysqli_query($conn, $sql_reserved_count);

    if ($result_reserved_count) {
        // Update room availability based on the reserved count
        while ($row_reserved_count = mysqli_fetch_assoc($result_reserved_count)) {
            $room_type = $row_reserved_count['room_type'];
            $reserved_count = $row_reserved_count['reserved_count'];

            // Get total room quantity for the current room type
            $sql_room_quantity = "SELECT room_id, quantity, rooms_booked FROM rooms WHERE room_type = '$room_type'";
            $result_room_quantity = mysqli_query($conn, $sql_room_quantity);

            if ($result_room_quantity) {
                while ($row_room_quantity = mysqli_fetch_assoc($result_room_quantity)) {
                    $room_id = $row_room_quantity['room_id'];
                    $room_quantity = $row_room_quantity['quantity'];

                    // Calculate available rooms ensuring it does not go below zero
                    $available_quantity = max(0, $room_quantity - $reserved_count);

                    // Determine availability status based on the room quantity
                    $availability = ($available_quantity <= 0) ? 'booked' : 'available';

                    // Update the rooms table
                    $sql_update_availability = "
                        UPDATE rooms 
                        SET availability = '$availability', rooms_booked = $reserved_count 
                        WHERE room_id = $room_id
                    ";
                    $result_update_availability = mysqli_query($conn, $sql_update_availability);

                    if (!$result_update_availability) {
                        echo "Error updating room availability: " . mysqli_error($conn);
                    }
                }
            }
        }
    } else {
        echo "Error retrieving reserved count: " . mysqli_error($conn);
    }

    // Free up rooms that have passed their checkout date
    $sql_free_rooms = "
        UPDATE rooms r
        LEFT JOIN reservations res
        ON r.room_type = res.room_type AND res.check_out_date < '$currentDate' AND res.reservation_status = 'confirmed'
        SET r.rooms_booked = r.rooms_booked - res.room_number
        WHERE res.reservation_id IS NOT NULL
    ";
    $result_free_rooms = mysqli_query($conn, $sql_free_rooms);

    if (!$result_free_rooms) {
        echo "Error freeing rooms: " . mysqli_error($conn);
    }
}

// Call the function to update room availability
updateRoomAvailability($conn);

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
    $room_id = $_POST['room_id'];
    $availability = $_POST['availability'];
    $sql = "UPDATE rooms SET availability = '$availability' WHERE room_id = $room_id";
    $result = mysqli_query($conn, $sql);
    if ($result) {
        echo "<script>alert('Entry success!!'); window.location='{$_SERVER['PHP_SELF']}';</script>";
        exit();
    } else {
        echo "Error updating reservation status: " . mysqli_error($conn);
    }
}

// Query to get rooms with the reserved count
$sql = "
    SELECT 
        rooms.*, 
        rooms.quantity - rooms.rooms_booked AS available_quantity 
    FROM rooms 
    ORDER BY CASE WHEN availability = 'available' THEN 0 ELSE 1 END, room_id ASC
";
$result = mysqli_query($conn, $sql);
$rooms = [];

if ($result) {
    while ($row = mysqli_fetch_assoc($result)) {
        $rooms[] = $row;
    }
} else {
    echo "Error fetching rooms: " . mysqli_error($conn);
}

mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Room Details</title>
    <link rel="stylesheet" href="./css/dashboard.css">
    <style>
        .second--section {
            padding: 20px 55px;
        }

        select {
            font-size: 16px;
            padding: 9px 13px;
            background-color: #f9f9f9;
            border: 1px solid #7969c7;
            border-radius: 5px;
            outline: none;
            cursor: pointer;
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
            <div class="part">
                <h2>Room Details</h2>
                <a href="dashboard.php"><button>Back</button></a>
            </div>
            <div class="more--details">
                <table border="1px" style="border-collapse: collapse; width: 100%">
                    <thead>
                        <tr>
                            <th>Room Id</th>
                            <th>Hotel Id</th>
                            <th>Room Type</th>
                            <th>Room Quantity</th>
                            <th>Reserved Count</th>
                            <th>Available Quantity</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($rooms as $row): ?>
                            <tr>
                                <td><?php echo $row['room_id']; ?></td>
                                <td><?php echo $row['hotel_id']; ?></td>
                                <td><?php echo $row['room_type']; ?></td>
                                <td><?php echo $row['quantity']; ?></td>
                                <td><?php echo $row['rooms_booked']; ?></td>
                                <td><?php echo $row['available_quantity']; ?></td>
                                <td>
                                    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                                        <input type="hidden" name="room_id" value="<?php echo $row['room_id']; ?>">
                                        <select name="availability">
                                            <option value="available" <?php if ($row['availability'] == "available")
                                                echo 'selected'; ?>>Available</option>
                                            <option value="booked" <?php if ($row['availability'] == "booked")
                                                echo 'selected'; ?>>Booked</option>
                                            <option value="not in service" <?php if ($row['availability'] == "not in service")
                                                echo 'selected'; ?>>Not in service</option>
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
</body>

</html>