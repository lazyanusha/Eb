<?php
session_start();
include 'connection.php';

if (!isset($_POST['hotel_id']) || !isset($_POST['check_in']) || !isset($_POST['check_out']) || !isset($_POST['room_type'])) {
    echo json_encode(['error' => 'Invalid request']);
    exit;
}

$hotel_id = $_POST['hotel_id'];
$check_in = $_POST['check_in'];
$check_out = $_POST['check_out'];
$room_type = $_POST['room_type'];

// Query to find available rooms for the given dates and room type
$sql = "SELECT quantity FROM rooms WHERE hotel_id = ? AND room_type = ? AND room_id NOT IN (
            SELECT room_id FROM reservations 
            WHERE hotel_id = ? 
            AND (? < check_out_date AND ? > check_in_date)
        )";
$stmt = mysqli_prepare($conn, $sql);
if ($stmt) {
    mysqli_stmt_bind_param($stmt, "issss", $hotel_id, $room_type, $hotel_id, $check_in, $check_out);
    if (mysqli_stmt_execute($stmt)) {
        $result = mysqli_stmt_get_result($stmt);
        if ($row = mysqli_fetch_assoc($result)) {
            $available_rooms = $row['quantity'];
            echo json_encode(['available_rooms' => $available_rooms]);
        } else {
            echo json_encode(['available_rooms' => 0]);
        }
    } else {
        echo json_encode(['error' => 'Error executing query: ' . mysqli_error($conn)]);
    }
    mysqli_stmt_close($stmt);
} else {
    echo json_encode(['error' => 'Error preparing query: ' . mysqli_error($conn)]);
}

mysqli_close($conn);