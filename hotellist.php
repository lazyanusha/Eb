<?php
// if (session_status() === PHP_SESSION_NONE) {
//     session_start();
// }

include 'connection.php';
include 'nav.php';

if (isset($_POST['query'])) {
    $search_query = mysqli_real_escape_string($conn, $_POST['query']);

    $sql = "SELECT * FROM hotels WHERE hotel_name LIKE '%$search_query%' OR hotel_address LIKE '%$search_query%'";
    $result = mysqli_query($conn, $sql);
    $filtered_hotels = [];
    while ($row_hotel = mysqli_fetch_assoc($result)) {
        $filtered_hotels[] = $row_hotel;
    }
} else {
    $sql = "SELECT * FROM hotels";
    $result = mysqli_query($conn, $sql);
    $filtered_hotels = [];
    while ($row_hotel = mysqli_fetch_assoc($result)) {
        $filtered_hotels[] = $row_hotel;
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Easybookings</title>
    <link rel="stylesheet" href="./css/home.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <style>
        form button {
            font-size: 14px;
            letter-spacing: 1px;
            margin-top: -10px;
            cursor: pointer;
            padding: 10px 20px;
            align-self: center;
            border: none;
            border-radius: 10px;
        }
       
    </style>
</head>

<body>
    <div class="container1">
        <div class="search-container">
            <div class="info">
                <h2 class="heading">Hotels list</h2>
                <a href="landing.php" class="button">Back</a>
            </div>
            <form action="hotellist.php" method="post">
                <input type="text" name="query" id="search-bar" placeholder="Search for hotels" autocomplete="on">
                <button type="submit">Search</button>
            </form>
        </div>
        <div class="card--container">
            <?php foreach ($filtered_hotels as $hotel): ?>
                <div class="card">
                    <a href="book.php?hotel_id=<?php echo $hotel['hotel_id']; ?>">
                        <img src="uploads/<?php echo $hotel['photos']; ?>" alt="<?php echo $hotel['hotel_name']; ?>" />
                        <div class="card--content">
                            <h2 class="card--title">
                                <?php echo $hotel['hotel_name']; ?>
                            </h2>
                            <p class="card--details">
                                <?php echo $hotel['hotel_contact']; ?>
                            </p>
                            <p class="card--details">
                                <?php echo $hotel['hotel_address']; ?>
                            </p>
                            <!-- <div class="stars">
                                <?php
                                $ratings = $hotel['ratings'];
                                for ($i = 0; $i < $ratings; $i++) {
                                    echo '<i class="fas fa-star"></i>';
                                }
                                ?>
                            </div> -->
                            <?php if (isset($_SESSION['email'])): ?>
                                <a href="book.php?hotel_id=<?php echo $hotel['hotel_id']; ?>" class="button">Make
                                    Reservation</a>
                            <?php else: ?>
                                <a href="login.php" class="button">Login to Book</a>
                            <?php endif; ?>
                        </div>
                    </a>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</body>

</html>
<?php
include ('footer.php')
    ?>