<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
include 'connection.php';

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $hotelName = $_POST['hotelName'];
    $hotelLocation = $_POST['hotelLocation'];
    $hotelEmail = $_POST['hotelEmail'];
    $hotelContact = $_POST['hotelContact'];
    $description = $_POST['description'];

    // Check if image file is uploaded
    if (isset($_FILES['image'])) {
        $file_name = $_FILES['image']['name'];
        $file_temp = $_FILES['image']['tmp_name'];
        move_uploaded_file($file_temp, "uploads/" . $file_name);
    }

    // Prepare and execute SQL statement for hotel insertion
    $sql = "INSERT INTO hotels (hotel_name, hotel_email, hotel_address, hotel_contact, description, photos) 
            VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "ssssss", $hotelName, $hotelEmail, $hotelLocation, $hotelContact, $description, $file_name);

    if (mysqli_stmt_execute($stmt)) {
        // Retrieve the last inserted hotel ID
        $hotelId = mysqli_insert_id($conn);

        if ($hotelId) {
            $_SESSION['hotel_id'] = $hotelId;

            // Insert room data into rooms table
            $roomTypes = $_POST['room-type'];
            $roomPrices = $_POST['price'];
            $roomQuantities = $_POST['room-quantity'];

            foreach ($roomTypes as $key => $roomType) {
                $roomPrice = $roomPrices[$key];
                $roomQuantity = $roomQuantities[$key];

                $sql = "INSERT INTO rooms (hotel_id, room_type, quantity, price) VALUES (?, ?, ?, ?)";
                $stmtRoom = mysqli_prepare($conn, $sql);
                mysqli_stmt_bind_param($stmtRoom, "isdd", $hotelId, $roomType, $roomQuantity, $roomPrice);
                mysqli_stmt_execute($stmtRoom);
                mysqli_stmt_close($stmtRoom);
            }

            // Insert service data into services table
            $services = $_POST['service-name'];
            foreach ($services as $service) {
                $sql = "INSERT INTO services (hotel_id, service) VALUES (?, ?)";
                $stmtService = mysqli_prepare($conn, $sql);
                mysqli_stmt_bind_param($stmtService, "is", $hotelId, $service);
                mysqli_stmt_execute($stmtService);
                mysqli_stmt_close($stmtService);
            }

            mysqli_stmt_close($stmt);
            echo "<script>alert('Entry Successful!!'); window.location='imagegallery.php';</script>";
            exit();
        } else {
            echo "<script>alert('Error: Unable to retrieve hotel ID.'); window.location='hoteladd.php';</script>";
        }
    } else {
        echo "<script>alert('Error: " . mysqli_error($conn) . "'); window.location='hoteladd.php';</script>";
    }

    mysqli_close($conn);
} else {
    echo "<script>alert('Invalid request!'); window.location='hoteladd.php';</script>";
}
