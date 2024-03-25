<?php
session_start();
include 'connection.php';

// Retrieve form data
$hotelName = $_POST['hotelName'];
$hotelLocation = $_POST['hotelLocation'];
$hotelEmail = $_POST['hotelEmail'];
$hotelContact = $_POST['hotelContact'];
$description = $_POST['description'];
$ratings = $_POST['ratings'];

if (isset($_FILES['image'])) {
    $file_name = $_FILES['image']['name'];
    $file_temp = $_FILES['image']['tmp_name'];

    // Move uploaded file to destination directory
    move_uploaded_file($file_temp, "uploads/" . $file_name);
}

// Prepare the SQL statement using a prepared statement
$sql = "INSERT INTO hotels (hotel_name, hotel_email, hotel_address, hotel_contact, description, photos, ratings) 
        VALUES (?, ?, ?, ?, ?, ?,?)";

$stmt = mysqli_prepare($conn, $sql);

// Bind parameters to the prepared statement
mysqli_stmt_bind_param($stmt, "ssssssi", $hotelName, $hotelEmail, $hotelLocation, $hotelContact, $description, $file_name,$ratings);

// Execute the prepared statement
if (mysqli_stmt_execute($stmt)) {
    // Retrieve the last inserted hotel ID
    $hotelId = mysqli_insert_id($conn);

    $_SESSION['hotel_id'] = $hotelId; // Storing hotel ID in session variable

    // Insert data into the rooms table
    // (Assuming you have already validated and sanitized the input data)
    $roomTypes = $_POST['room-type'];
    $roomPrices = $_POST['price'];
    $roomQuantities = $_POST['room-quantity'];

    // Loop through room data and insert into database
    for ($i = 0; $i < count((array)$roomTypes); $i++) {
        $roomType = $roomTypes[$i];
        $roomPrice = $roomPrices[$i];
        $roomQuantity = $roomQuantities[$i];

        // Prepare the SQL statement for room insertion
        $sql = "INSERT INTO rooms (hotel_id, room_type, Quantity, Price) 
                VALUES (?, ?, ?, ?)";

        $stmt = mysqli_prepare($conn, $sql);

        // Bind parameters to the prepared statement
        mysqli_stmt_bind_param($stmt, "issd", $hotelId, $roomType, $roomQuantity, $roomPrice);

        // Execute the prepared statement
        mysqli_stmt_execute($stmt);
    }

    // Insert services data into the services table
    $services = $_POST['service-name'];
    for ($i = 0; $i < count((array)$services); $i++) {
        $service = $services[$i];

        $sql = "INSERT INTO services (hotel_id, service) VALUES (?, ?)";
        $stmt = mysqli_prepare($conn, $sql);

        // Bind parameters to the prepared statement
        mysqli_stmt_bind_param($stmt, "is", $hotelId, $service);

        // Execute the prepared statement
        mysqli_stmt_execute($stmt);
    }

    // Close the prepared statement
    mysqli_stmt_close($stmt);

    // Set success message
    $_SESSION['success_message'] = "Hotel added successfully.";

    // Redirect back to the form page
    header("Location: hoteladd.php");
    exit();
} else {
    // If insertion fails, display an error message
    echo "Error: " . mysqli_error($conn);
}

// Close the database connection
mysqli_close($conn);
