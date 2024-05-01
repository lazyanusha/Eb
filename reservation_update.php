<?php
session_start();
include 'connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
    $reservation_id = $_POST['reservation_id'];
    $reservation_status = $_POST['reservation_status'];

    $sql = "UPDATE reservations SET reservation_status = '$reservation_status' WHERE reservation_id = $reservation_id";
    $result = mysqli_query($conn, $sql);
    if ($result) {
        echo "Changes saved successfully.";
        // Redirect to a page to display updated vehicle details
        header("Location: bookingmanage.php");


    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
