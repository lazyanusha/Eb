<?php
session_start();
include 'connection.php';

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Handle form submission and update query here
    $hotelName = $_POST['hotelName'];
    $hotelLocation = $_POST['hotelLocation'];
    $hotelEmail = $_POST['hotelEmail'];
    $hotelContact = $_POST['hotelContact'];
    $description = $_POST['description'];

    if (isset($_POST['hotel_id'])) {
        $id = $_POST['hotel_id'];

        // Update query
        $sql_update = "UPDATE hotels SET hotel_name=?, hotel_address=?, hotel_email=?, hotel_contact=?, description=? WHERE hotel_id=?";
        $stmt_update = $conn->prepare($sql_update);
        $stmt_update->bind_param("ssssssi", $hotelName, $hotelLocation, $hotelEmail, $hotelContact, $description, $id);

        // Execute the update query
        if ($stmt_update->execute()) {
            // Handle room data update
            if (isset($_POST['room-type']) && isset($_POST['price']) && isset($_POST['room-quantity'])) {
                // Delete existing room data for the hotel
                $sql_delete_rooms = "DELETE FROM rooms WHERE hotel_id=?";
                $stmt_delete_rooms = $conn->prepare($sql_delete_rooms);
                $stmt_delete_rooms->bind_param("i", $id);
                $stmt_delete_rooms->execute();

                // Insert new room data
                $sql_insert_room = "INSERT INTO rooms (hotel_id, room_type, quantity, price) VALUES (?, ?, ?, ?)";
                $stmt_insert_room = $conn->prepare($sql_insert_room);
                $stmt_insert_room->bind_param("isdd", $id, $roomType, $roomQuantity, $roomPrice);

                // Loop through room data and insert into database
                foreach ($_POST['room-type'] as $key => $roomType) {
                    $roomQuantity = $_POST['room-quantity'][$key];
                    $roomPrice = $_POST['price'][$key];
                    $stmt_insert_room->execute();
                }
            }

            // Handle service data update
            if (isset($_POST['service-name'])) {
                $sql_delete_services = "DELETE FROM services WHERE hotel_id=?";
                $stmt_delete_services = $conn->prepare($sql_delete_services);
                $stmt_delete_services->bind_param("i", $id);
                $stmt_delete_services->execute();

                // Insert new service data
                $sql_insert_service = "INSERT INTO services (hotel_id, service) VALUES (?, ?)";
                $stmt_insert_service = $conn->prepare($sql_insert_service);
                $stmt_insert_service->bind_param("is", $id, $service);

                // Loop through service data and insert into database
                foreach ($_POST['service-name'] as $service) {
                    $stmt_insert_service->execute();
                }
            }

            echo "<script>alert('Entry updated successfully!!'); window.location='hotel-list.php';</script>";
        } else {
            echo "<script>alert('Error: " . $conn->error . "'); window.location='hotel-list.php';</script>";
        }
    } else {
        echo "<script>alert('Error: Hotel ID not provided.'); window.location='hotel-list.php';</script>";
    }

    $conn->close();
} else {
    echo "<script>alert('Invalid request!'); window.location='hotel-list.php';</script>";
}

