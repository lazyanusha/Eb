<?php
session_start();
include 'connection.php';
// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fullname = mysqli_real_escape_string($conn, $_POST['fullname']);
    $hotel_id = $_POST['hotel_id'];
    $contact = mysqli_real_escape_string($conn, $_POST['contact']);
    $userEmail = $_SESSION['email'];
    $roomType = $_POST['room-type'];
    $bedType = $_POST['bed-type'];
    $roomNumber = $_POST['number-of-room'];
    $children = $_POST['children'];
    $adult = $_POST['adult'];
    $checkIn = $_POST['check-in'];
    $checkOut = $_POST['check-out'];
    $totalPrice = floatval(str_replace('$', '', $_POST['total-price']));
    $paymentMethod = $_POST['payment'];

    // Calculate total number of guests
    $totalGuests = $children + $adult;

    // Insert into reservation table
    $sql_reservation = "INSERT INTO reservations (guest_name, hotel_id, email, contact_information, guests_num, room_number, room_type, bed_type, check_in_date, check_out_date,total_price, payment_method) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt_reservation = mysqli_prepare($conn, $sql_reservation);
    if ($stmt_reservation) {
        mysqli_stmt_bind_param($stmt_reservation, "ssssssssssss", $fullname, $hotel_id, $userEmail, $contact, $totalGuests, $roomNumber, $roomType, $bedType, $checkIn, $checkOut, $totalPrice, $paymentMethod);
        if (mysqli_stmt_execute($stmt_reservation)) {
            $reservation_id = mysqli_insert_id($conn);
            $_SESSION['reservation_id'] = $reservation_id;
            echo "<script>alert('Your form has been submitted! You will be notified soon!!'); window.location='landing.php';</script>";
            exit;
        } else {
            error_log("Error adding reservation: " . mysqli_error($conn));
            echo "An error occurred while processing your reservation. Please try again later.";
        }

        mysqli_stmt_close($stmt_reservation);
    } else {
        error_log("Error preparing reservation query: " . mysqli_error($conn));
        echo "An error occurred while processing your reservation. Please try again later.";
    }
} else {
    echo "Form not submitted.";
}

