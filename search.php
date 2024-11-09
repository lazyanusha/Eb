<?php
// Include database connection
include 'connection.php';

// Initialize variable
$searchedHotels = [];

// Check if there is a search query
if (isset($_GET['city']) && !empty($_GET['city'])) {
    $userCity = $_GET['city'];

    // Adjust SQL query to select hotels based on their city or region
    $sql = "SELECT hotel_id, hotel_name, hotel_contact, hotel_address, photos, ratings 
            FROM hotels 
            WHERE hotel_address LIKE '%$userCity%'";

    $result = mysqli_query($conn, $sql);

    // Fetch searched hotels
    while ($row_hotel = mysqli_fetch_assoc($result)) {
        $searchedHotels[] = $row_hotel; // Add hotel to searched hotels array
    }
}
