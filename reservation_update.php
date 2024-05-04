<?php
include 'connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve POST data
    $reservation_id = $_POST["reservation_id"];
    $reservation_status = $_POST["reservation_status"];

    $update_sql = "UPDATE reservations SET reservation_status = '$reservation_status' WHERE reservation_id = '$reservation_id'";
    $update_result = mysqli_query($conn, $update_sql);

    if ($update_result) {
        echo "<script>alert('Entry updated successfully!'); window.location='bookingmanage.php';</script>";

        exit;
    } else {
        echo "Error updating reservation: " . mysqli_error($conn);
    }
}
