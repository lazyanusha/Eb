<?php
session_start();
include 'connection.php';

$hotelName = $_POST['hotelName'];
$hotelLocation = $_POST['hotelLocation'];
$hotelEmail = $_POST['hotelEmail'];
$hotelContact = $_POST['hotelContact'];
$description = $_POST['description'];
$ratings = $_POST['ratings'];

if (isset($_FILES['image'])) {
    $file_name = $_FILES['image']['name'];
    $file_temp = $_FILES['image']['tmp_name'];

    move_uploaded_file($file_temp, "uploads/" . $file_name);
}

$sql = "INSERT INTO hotels (hotel_name, hotel_email, hotel_address, hotel_contact, description, photos, ratings) 
        VALUES (?, ?, ?, ?, ?, ?, ?)";

$stmt = mysqli_prepare($conn, $sql);

mysqli_stmt_bind_param($stmt, "ssssssi", $hotelName, $hotelEmail, $hotelLocation, $hotelContact, $description, $file_name, $ratings);

if (mysqli_stmt_execute($stmt)) {
    $hotelId = mysqli_insert_id($conn);

    $_SESSION['hotel_id'] = $hotelId;

    // Retrieve room numbers from the form data
    $roomNumbers = $_POST['room_numbers'];

    // Loop through room data and insert into database
    // Retrieve room types and their associated prices
    $roomTypes = $_POST['room-type'];
    $roomPrices = $_POST['price'];

    // Loop through room data and insert into database
    foreach ($roomNumbers as $roomType => $roomTypeNumbers) {
        foreach ($roomTypeNumbers as $roomNumber) {
            // Retrieve the price for the current room type
            $roomPrice = $roomPrices[$roomType]; // Use room type as key to retrieve price

            // Prepare the SQL statement for room insertion
            $sql = "INSERT INTO rooms (hotel_id, room_type, room_number, Price) 
            VALUES (?, ?, ?, ?)";

            $stmt = mysqli_prepare($conn, $sql);

            // Bind parameters to the prepared statement
            mysqli_stmt_bind_param($stmt, "isss", $hotelId, $roomType, $roomNumber, $roomPrice);

            // Execute the prepared statement
            mysqli_stmt_execute($stmt);
        }
    }


    // Insert services
    $services = $_POST['service-name'];
    foreach ($services as $service) {
        $sql = "INSERT INTO services (hotel_id, service) VALUES (?, ?)";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "is", $hotelId, $service);
        mysqli_stmt_execute($stmt);
    }

    mysqli_stmt_close($stmt);

    echo "<script>alert('Entry Successful!!'); window.location='hoteladd.php';</script>";

    exit();
} else {
    $_SESSION['error_message'] = "Error: " . mysqli_error($conn);

    header("Location: hoteladd.php");
    exit();
}
