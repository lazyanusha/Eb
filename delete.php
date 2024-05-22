<?php
include 'connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['hotel_id'])) {
        $hotel_id = $_POST['hotel_id'];

        // First update related reservations
        $sql_update_reservations = "UPDATE reservations SET hotel_id = NULL WHERE hotel_id = ?";
        $stmt_reservations = mysqli_prepare($conn, $sql_update_reservations);
        mysqli_stmt_bind_param($stmt_reservations, "i", $hotel_id);
        mysqli_stmt_execute($stmt_reservations);
        mysqli_stmt_close($stmt_reservations);
        //delete related rooms
        $sql_delete_rooms = "DELETE FROM rooms WHERE hotel_id = ?";
        $stmt_rooms = mysqli_prepare($conn, $sql_delete_rooms);
        mysqli_stmt_bind_param($stmt_rooms, "i", $hotel_id);
        mysqli_stmt_execute($stmt_rooms);
        mysqli_stmt_close($stmt_rooms);

        // Delete related services
        $sql_delete_services = "DELETE FROM services WHERE hotel_id = ?";
        $stmt_services = mysqli_prepare($conn, $sql_delete_services);
        mysqli_stmt_bind_param($stmt_services, "i", $hotel_id);
        mysqli_stmt_execute($stmt_services);
        mysqli_stmt_close($stmt_services);

        // Delete related image gallery entries
        $sql_delete_images = "DELETE FROM hotel_images WHERE hotel_id = ?";
        $stmt_images = mysqli_prepare($conn, $sql_delete_images);
        mysqli_stmt_bind_param($stmt_images, "i", $hotel_id);
        mysqli_stmt_execute($stmt_images);
        mysqli_stmt_close($stmt_images);


        // Then delete the hotel
        $sql_delete_hotel = "DELETE FROM hotels WHERE hotel_id = ?";
        $stmt_hotel = mysqli_prepare($conn, $sql_delete_hotel);
        mysqli_stmt_bind_param($stmt_hotel, "i", $hotel_id);

        if (mysqli_stmt_execute($stmt_hotel)) {
            echo "<script>alert('Entry deleted successfully.!!'); window.location='hotel-list.php';</script>";
            exit();
        } else {
            echo "Error: " . mysqli_error($conn);
        }

        mysqli_stmt_close($stmt_hotel);
    } else {
        echo "Hotel ID not provided.";
    }
}
?>