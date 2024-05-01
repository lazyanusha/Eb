<?php
include 'connection.php';

$adminSql = "SELECT * FROM admins";
$adminResult = mysqli_query($conn, $adminSql);

$admins = [];
if ($adminResult) {
    while ($adminRow = mysqli_fetch_assoc($adminResult)) {
        $admins[] = $adminRow;
    }
} else {
    echo "Error fetching admins: " . mysqli_error($conn);
}

$hotelSql = "SELECT * FROM hotels";
$hotelResult = mysqli_query($conn, $hotelSql);

$hotels = [];
if ($hotelResult) {
    while ($hotelRow = mysqli_fetch_assoc($hotelResult)) {
        $hotels[] = $hotelRow;
    }
} else {
    echo "Error fetching hotels: " . mysqli_error($conn);
}

mysqli_close($conn);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admins and Hotels</title>
</head>

<body>
    <h2>Admin Details</h2>
    <table border="1">
        <tr>
            <th>Admin ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Contact</th>
        </tr>
        <?php foreach ($admins as $admin): ?>
            <tr>
                <td><?php echo $admin['admin_id']; ?></td>
                <td><?php echo $admin['fullname']; ?></td>
                <td><?php echo $admin['email']; ?></td>
                <td><?php echo $admin['phone']; ?></td>
            </tr>
        <?php endforeach; ?>
    </table>

    <h2>Hotel Details</h2>
    <table border="1">
        <tr>
            <th>Hotel ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Contact</th>
            <th>Location</th>
        </tr>
        <?php foreach ($hotels as $hotel): ?>
            <tr>
                <td><?php echo $hotel['hotel_id']; ?></td>
                <td><?php echo $hotel['hotel_name']; ?></td>
                <td><?php echo $hotel['hotel_email']; ?></td>
                <td><?php echo $hotel['hotel_contact']; ?></td>
                <td><?php echo $hotel['hotel_address']; ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
</body>

</html>