<?php
include 'connection.php';
// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['declined'])) {
    // Retrieve reservation ID from the POST data
    $reservation_id = $_POST['reservation_id'];

    $sql = "UPDATE reservations SET reservation_status = 'declined' WHERE reservation_id = $reservation_id";

    // Execute the query
    $result = mysqli_query($conn, $sql);

    if ($result) {
        echo "<script>alert('You cancelled the reservation!!'); window.location='ubooking.php';</script>";
    } else {
        echo "<script>alert('Error cancelling reservation:'); window.location='ubooking.php';</script>";

    }
}
