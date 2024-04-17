<?php
session_start();
include 'nav.php';
include 'connection.php';

// Check if the search form is submitted
if (isset ($_POST['query'])) {
    // Sanitize the search query
    $search_query = mysqli_real_escape_string($conn, $_POST['query']);

    // Construct the SQL query to search for hotels
    $sql = "SELECT * FROM hotels WHERE hotel_name LIKE '%$search_query%' OR hotel_address LIKE '%$search_query%'";
    $result = mysqli_query($conn, $sql);

    // Fetch the filtered hotel data into an array
    $filtered_hotels = [];
    while ($row_hotel = mysqli_fetch_assoc($result)) {
        $filtered_hotels[] = $row_hotel;
    }
} else {
    // Retrieve all hotel information from the database
    $sql = "SELECT * FROM hotels";
    $result = mysqli_query($conn, $sql);

    // Fetch all hotel data into an array
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
        button{
            color: #343434;
            font-size: 14px;
            letter-spacing: 1px;
            margin-top: -10px;
            cursor: pointer;
        }
    </style>
</head>

<body>
    <div class="container1">
        <div class="search-container">
            <h2 style="text-decoration: underline;" >Hotels list !!</h2>
            <form action="hotellist.php" method="post">
                <input type="text" name="query" id="search-bar" placeholder="Search for hotels" autocomplete="off">
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
                            <div class="stars">
                                <?php
                                $ratings = $hotel['ratings'];
                                for ($i = 0; $i < $ratings; $i++) {
                                    echo '<i class="fas fa-star"></i>';
                                }
                                ?>
                            </div>
                            <p>Know more....</p>
                            <br />
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