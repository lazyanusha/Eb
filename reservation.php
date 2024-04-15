<?php
session_start();
include 'connection.php';
var_dump($_POST);
echo $_SESSION['email'];

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve data from the form
    $fullname = $_POST['fullname']; 
    $hotel_id = $_POST['hotel_id'];
    $contact = $_POST['contact'];
    $userEmail = $_SESSION['email'] ;
    $roomType = $_POST['room-type'];
    $bedType = $_POST['bed-type'];
    $roomNumber = $_POST['number-of-room'];
    $children = $_POST['children'];
    $adult = $_POST['adult'];
    $checkIn = $_POST['check-in'];
    $checkOut = $_POST['check-out'];
    $specialRequest = $_POST['special-request'];
    $totalPrice = $_POST['total-price'];
    $paymentMethod = $_POST['payment'];

    // Calculate total number of guests
    $totalGuests = $children + $adult;

    // Insert into reservation table
    $sql_reservation = "INSERT INTO reservations (guest_name, hotel_id, email, contact_information, guests_num, room_number, room_type, bed_type, check_in_date, check_out_date, special_requests, total_price, payment_method) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt_reservation = mysqli_prepare($conn, $sql_reservation);
    if ($stmt_reservation) {
        mysqli_stmt_bind_param($stmt_reservation, "sssssssssssss", $fullname, $hotel_id, $userEmail, $contact, $totalGuests, $roomNumber, $roomType, $bedType, $checkIn, $checkOut, $specialRequest, $totalPrice, $paymentMethod);
        if (mysqli_stmt_execute($stmt_reservation)) {
            // Get the last inserted ID (reservation_id)
            $reservation_id = mysqli_insert_id($conn);
            $_SESSION['reservation_id'] = $reservation_id;
            echo "Reservation successfully added. Reservation ID: " . $reservation_id;
        } else {
            echo "Error adding reservation: " . mysqli_error($conn);
        }

        mysqli_stmt_close($stmt_reservation);
    } else {
        echo "Error preparing reservation query: " . mysqli_error($conn);
    }
} else {
    echo "Form not submitted.";
}
