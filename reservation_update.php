<?php
include 'connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve POST data
    $reservation_id = $_POST["reservation_id"];
    $reservation_status = $_POST["reservation_status"];
    
    // Check if the requested status is "Confirmed" and the current status is "Pending"
    if ($reservation_status === "Confirmed") {
        // Retrieve the reservation details
        $reservation_query = "SELECT room_number, room_type FROM reservations WHERE reservation_id = '$reservation_id'";
        $reservation_result = mysqli_query($conn, $reservation_query);

        if ($reservation_result && mysqli_num_rows($reservation_result) > 0) {
            $reservation_data = mysqli_fetch_assoc($reservation_result);
            $requested_room_number = $reservation_data["room_number"];
            $room_type = $reservation_data["room_type"];
            
            // Retrieve the available room quantity
            $room_query = "SELECT quantity, rooms_booked FROM rooms WHERE room_type = '$room_type'";
            $room_result = mysqli_query($conn, $room_query);
            
            if ($room_result && mysqli_num_rows($room_result) > 0) {
                $room_data = mysqli_fetch_assoc($room_result);
                $available_room_quantity = $room_data["quantity"] - $room_data["rooms_booked"];
                
                // Check if the requested room quantity exceeds the available room quantity
                if ($requested_room_number > $available_room_quantity) {
                    echo "<script>alert('Requested room quantity exceeds available room quantity. Status update to Confirmed failed.'); window.location='bookingmanage.php';</script>";
                    exit; // Prevent further execution
                }
            } else {
                echo "Error retrieving room data: " . mysqli_error($conn);
                exit;
            }
        } else {
            echo "Error retrieving reservation data: " . mysqli_error($conn);
            exit;
        }
    }
    
    // Proceed with updating the reservation status
    $update_sql = "UPDATE reservations SET reservation_status = '$reservation_status' WHERE reservation_id = '$reservation_id'";
    $update_result = mysqli_query($conn, $update_sql);

    if ($update_result) {
        echo "<script>alert('Entry updated successfully!'); window.location='bookingmanage.php';</script>";
        exit;
    } else {
        echo "Error updating reservation: " . mysqli_error($conn);
    }
}
?>
