<?php
session_start();
include 'connection.php';


// Check if user_id is set in the session
$user_id = 1; // Replace this with the actual user ID

// Set the user_id in the session
$_SESSION['user_id'] = $user_id;

// Redirect to another page after setting the session variable
header("Location: book.php");
exit;


// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $roomType = $_POST['room-type'];
    $bedType = $_POST['bed-type'];
    $numberOfRooms = $_POST['number-of-room'];
    $childrenCount = $_POST['children'];
    $adultCount = $_POST['adult'];
    $checkInDate = $_POST['check-in'];
    $checkOutDate = $_POST['check-out'];
    // Other data you need to retrieve from the session or elsewhere

    // Insert reservation data into the reservations table
    $sql = "INSERT INTO reservations (guest_id, hotel_id, guest_count, room_number, room_type, check_in, check_out, status)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($conn, $sql);
    if ($stmt) {
        // Bind parameters
        mysqli_stmt_bind_param($stmt, "iiisssss", $guestId, $hotelId, $guestCount, $roomNumber, $roomType, $checkInDate, $checkOutDate, $status);

        // Execute the statement
        if (mysqli_stmt_execute($stmt)) {
            echo "Reservation successfully added.";
        } else {
            echo "Error executing reservation query: " . mysqli_error($conn);
        }

        // Close the statement
        mysqli_stmt_close($stmt);
    } else {
        echo "Error preparing reservation query: " . mysqli_error($conn);
    }
} else {
    // Handle if the form is not submitted
    echo "Form submission failed.";
}
?>