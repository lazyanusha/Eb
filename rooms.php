<?php
include 'connection.php';

// Function to update room availability based on check-out dates
function updateRoomAvailability($conn)
{
    // Get current date
    $currentDate = date('Y-m-d');

    // Retrieve reservations that have passed their check-out date
    $sql_check_out = "SELECT room_number FROM reservations WHERE check_out_date <= '$currentDate' AND reservation_status = 'confirmed'";
    $result_check_out = mysqli_query($conn, $sql_check_out);

    if ($result_check_out) {
        while ($row_check_out = mysqli_fetch_assoc($result_check_out)) {
            $room_id = $row_check_out['room_number'];
            $sql_update_availability = "UPDATE rooms SET availability = 'available' WHERE room_id = $room_id";
            $result_update_availability = mysqli_query($conn, $sql_update_availability);

            if (!$result_update_availability) {
                echo "Error updating room availability: " . mysqli_error($conn);
            }
        }
    } else {
        echo "Error retrieving check-out dates: " . mysqli_error($conn);
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

$sql = "SELECT * FROM rooms ORDER BY CASE WHEN availability = 'available' THEN 0 ELSE 1 END, room_id ASC";
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
    <title>Room Details </title>
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
                <h2>Room Details.!!</h2>
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
                                <td><?php echo $row['quantity']; ?></td>
                                <td>
                                    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                                        <input type="hidden" name="room_id" value="<?php echo $row['room_id']; ?>">
                                        <select name="availability">
                                            <option value="available" <?php if ($row['availability'] == "available")
                                                echo 'selected'; ?>>Available
                                            </option>
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
    </script>

</body>

</html>