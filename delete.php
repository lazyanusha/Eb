<?php
include 'connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['hotel_id'])) {
        $hotel_id = $_POST['hotel_id'];
        $sql = "DELETE FROM hotels WHERE hotel_id = ?";
        $stmt = mysqli_prepare($conn, $sql);

        mysqli_stmt_bind_param($stmt, "i", $hotel_id);
        if (mysqli_stmt_execute($stmt)) {
            echo "<script>alert('Entry deleted successfully.!!'); window.location='hotel-list.php';</script>";
            exit();
        } else {

            echo "Error: " . mysqli_error($conn);
        }


        mysqli_stmt_close($stmt);
    } else {
        echo "Admin ID not provided.";
    }
}

