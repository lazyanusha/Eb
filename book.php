<?php
session_start();
include 'connection.php';
if (!isset($_SESSION['email'])) {
    header("location: login.php");
    exit;
}

$hotelName = $hotelLocation = $hotelEmail = $hotelContact = $description = '';
$services = $rooms = array();
$images = array();

if (isset($_GET['hotel_id'])) {
    $hotel_id = $_GET['hotel_id'];

    $sql = "SELECT * FROM hotels WHERE hotel_id = ?";
    $stmt = mysqli_prepare($conn, $sql);
    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "i", $hotel_id);
        if (mysqli_stmt_execute($stmt)) {
            $result = mysqli_stmt_get_result($stmt);
            if ($row = mysqli_fetch_assoc($result)) {
                $hotelName = $row['hotel_name'];
                $hotelLocation = $row['hotel_address'];
                $hotelEmail = $row['hotel_email'];
                $hotelContact = $row['hotel_contact'];
                $description = $row['description'];
            }
        } else {
            echo "Error executing hotel query: " . mysqli_error($conn);
        }
        mysqli_stmt_close($stmt);
    } else {
        echo "Error preparing hotel query: " . mysqli_error($conn);
    }

    $sql_services = "SELECT * FROM services WHERE hotel_id = ?";
    $stmt_services = mysqli_prepare($conn, $sql_services);
    if ($stmt_services) {
        mysqli_stmt_bind_param($stmt_services, "i", $hotel_id);
        if (mysqli_stmt_execute($stmt_services)) {
            $result_services = mysqli_stmt_get_result($stmt_services);
            while ($row_services = mysqli_fetch_assoc($result_services)) {
                $services[] = $row_services['service'];
            }
        } else {
            echo "Error executing services query: " . mysqli_error($conn);
        }
        mysqli_stmt_close($stmt_services);
    } else {
        echo "Error preparing services query: " . mysqli_error($conn);
    }

    // Fetch room numbers based on availability from the database
    $sql_rooms = "SELECT room_type, price, quantity FROM rooms WHERE hotel_id = ? AND availability = 'available'";
    $stmt_rooms = mysqli_prepare($conn, $sql_rooms);
    if ($stmt_rooms) {
        mysqli_stmt_bind_param($stmt_rooms, "i", $hotel_id);
        if (mysqli_stmt_execute($stmt_rooms)) {
            $result_rooms = mysqli_stmt_get_result($stmt_rooms);
            if (mysqli_num_rows($result_rooms) > 0) {
                $availableRooms = [];
                while ($row_rooms = mysqli_fetch_assoc($result_rooms)) {
                    $rooms[$row_rooms['room_type']] = $row_rooms['quantity'];
                    $prices[$row_rooms['room_type']] = $row_rooms['price'];
                    $availableRooms[] = $row_rooms['quantity'];
                }
            } else {
                echo "No rooms found for this hotel.";
            }
        } else {
            echo "Error executing rooms query: " . mysqli_error($conn);
        }
        if (empty($availableRooms)) {
            echo "No rooms available.";
            exit;
        }
        mysqli_stmt_close($stmt_rooms);
    }


    // Fetch image filenames from the database
    $sql_images = "SELECT image_name FROM hotel_images WHERE hotel_id = ?";
    $stmt_images = mysqli_prepare($conn, $sql_images);
    if ($stmt_images) {
        mysqli_stmt_bind_param($stmt_images, "i", $hotel_id);
        if (mysqli_stmt_execute($stmt_images)) {
            $result_images = mysqli_stmt_get_result($stmt_images);
            while ($row_images = mysqli_fetch_assoc($result_images)) {
                $images[] = "uploads/" . $row_images['image_name'];
            }
        } else {
            echo "Error executing image query: " . mysqli_error($conn);
        }
        mysqli_stmt_close($stmt_images);
    } else {
        echo "Error preparing image query: " . mysqli_error($conn);
    }


} else {
    echo "Hotel ID not found in query string.";
}

if (isset($_SESSION['email'])) {
    $userEmail = $_SESSION['email'];
    $sql_admin = "SELECT fullname, phone FROM admins WHERE email = ?";
    $sql_user = "SELECT fullname, phone FROM users WHERE email = ?";
    $stmt_admin = mysqli_prepare($conn, $sql_admin);
    $stmt_user = mysqli_prepare($conn, $sql_user);

    if ($stmt_admin && $stmt_user) {
        mysqli_stmt_bind_param($stmt_admin, "s", $_SESSION['email']);
        mysqli_stmt_bind_param($stmt_user, "s", $_SESSION['email']);

        if (mysqli_stmt_execute($stmt_admin)) {
            $result_admin = mysqli_stmt_get_result($stmt_admin);
            if ($row_admin = mysqli_fetch_assoc($result_admin)) {
                $guestName = $row_admin['fullname'];
                $contact = $row_admin['phone'];
            }
            mysqli_stmt_close($stmt_admin);
        } else {
            echo "Error executing admin query: " . mysqli_error($conn);
            exit;
        }

        if (empty($guestName)) {
            if (mysqli_stmt_execute($stmt_user)) {
                $result_user = mysqli_stmt_get_result($stmt_user);
                if ($row_user = mysqli_fetch_assoc($result_user)) {
                    $guestName = $row_user['fullname'];
                    $contact = $row_user['phone'];
                } else {
                    echo "User not found.";
                    exit;
                }
            } else {
                echo "Error executing user query: " . mysqli_error($conn);
                exit;
            }
        }
        mysqli_stmt_close($stmt_user);
    } else {
        echo "Error preparing queries: " . mysqli_error($conn);
        exit;
    }
} else {
    echo "User email not found in session.";
    exit;
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Reservation</title>
    <link rel="stylesheet" href="./css/home.css">
    <link rel="stylesheet" type="text/css"
        href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.css" />
    <link rel="stylesheet" type="text/css"
        href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick-theme.min.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <style>
        .image {
            max-width: fit-content;
            height: 83vh;
            padding: 20px 50px;
            overflow: hidden;
        }

        .image img {
            width: 100%;
            height: 75vh;
            display: block;
            margin: 0 auto;
            object-fit: cover;

        }

        .slick-prev::before,
        .slick-next::before {
            content: none;
        }

        .lists {
            width: 50%;
            display: flex;
            flex-direction: column;
            row-gap: 10px;
        }

        .lists ul {
            display: flex;
            flex-direction: column;
            row-gap: 10px;
        }

        .list ul {
            display: flex;
            flex-wrap: wrap;
            column-gap: 40px;
            row-gap: 3px;
        }
    </style>
</head>

<body>
    <div>
        <nav class="navigation_bar">
            <div class="logo">
                <a href="home.php"><img src="./images/logo3.png" alt="logo"></a>
            </div>
            <div class="menu">
                <ul>
                    <li><a href="landing.php">Home</a></li>
                    <li><a href="Aboutus.php">About Us</a></li>
                    <li><a href="hotellist.php">Hotels</a></li>
                    <li><a href="contact_us.php">Contact Us</a></li>
                </ul>
            </div>
            <div class="new">
                <a href="logout.php">Log Out</a>
            </div>
        </nav>
    </div>

    <div class="image">
        <div class="carousel-container">
            <div class="carousel">
                <?php foreach ($images as $image): ?>
                    <div>
                        <a href="<?php echo $image; ?>">
                            <img src="<?php echo $image; ?>" alt="Hotel Image" loading="lazy">
                        </a>
                    </div>
                <?php endforeach; ?>

            </div>
        </div>
    </div>
    <div class="section">
        <div class="hotel--info">
            <h2>
                <?php echo $hotelName; ?>
            </h2>
            <p><strong>Location:</strong>
                <?php echo $hotelLocation; ?>
            </p>
            <p><strong>Email:</strong>
                <?php echo $hotelEmail; ?>
            </p>
            <p><strong>Contact:</strong>
                <?php echo $hotelContact; ?>
            </p>
            <p class="paragraph1">
                <strong>Description:</strong>
                <?php echo "<br>" . $description; ?>
            </p>
            <div class="area">
                <div class="list">
                    <p><strong>Our Services</strong></p>
                    <ul>
                        <?php foreach ($services as $service): ?>
                            <li>
                                <?php echo $service; ?>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
                <div class="lists">
                    <p><strong>Rooms Available</strong></p>
                    <ul>
                        <?php foreach ($rooms as $roomType => $quantity): ?>
                            <li>
                                <?php echo $roomType . ": " . $quantity; ?>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </div>
            <div class="reviews">
                <p><strong>Feedbacks</strong></p>
                <p class="paragraph1">
                    How was your stay with us? We'd love to hear your thoughts!
                </p>
                <form action="" class="sec">
                    <textarea rows="9" cols="100" placeholder="Write your message here....."></textarea>
                    <div class="area">
                        <input class="input" type="email" placeholder="Your email address" />
                        <input class="button-1" type="submit" placeholder="Send" />
                    </div>
                </form>
            </div>

        </div>
        <div class="booking">
            <form action="reservation.php" class="form--container" method="post">
                <div class="first--section">
                    <h2>Reservation</h2>
                </div>
                <hr />
                <div class="reservation">
                    <input type="hidden" name="hotel_id" value="<?php echo $hotel_id; ?>">
                    <input type="hidden" name="fullname" value="<?php echo $guestName; ?>">
                    <input type="hidden" name="contact" value="<?php echo $contact; ?>">
                    <input type="hidden" name="email" value="<?php echo isset($userEmail) ? $userEmail : ''; ?>">

                    <!-- Room Type Selection -->
                    <label for="room-type" class="reservation--label">Type of room:</label>
                    <select class="reservation--info" name="room-type" id="room-type"
                        onchange="updatePriceAndOptions()">
                        <option value="" disabled selected>Select type of room</option>
                        <?php foreach ($rooms as $roomType => $quantity): ?>
                            <option value="<?php echo $roomType; ?>" data-price="<?php echo $prices[$roomType]; ?>">
                                <?php echo ucfirst($roomType); ?> Room - $<?php echo $prices[$roomType]; ?> per night
                            </option>
                        <?php endforeach; ?>
                    </select>

                    <label for="bed-type" class="reservation--label">Bedding type:</label>
                    <select class="reservation--info" name="bed-type" id="bed-type">
                        <option value="" disabled selected>Select bedding type</option>
                        <option value="single">Single Bed</option>
                        <option value="double">Double Bed</option>
                        <option value="triple">Triple Bed</option>
                    </select>
                    <label for="number-of-room" class="reservation--label">Room Number:</label>
                    <table class="reservation--info" id="number-of-room">
                        <tr>
                            <th>Date</th>
                            <?php foreach ($availableRooms as $roomNumber): ?>
                                <th><?php echo $roomNumber; ?></th>
                            <?php endforeach; ?>
                        </tr>
                        <?php
                        foreach ($availability as $date => $rooms) {
                            echo "<tr>";
                            echo "<td>$date</td>";
                            foreach ($availableRooms as $roomNumber) {
                                echo "<td>";
                                // Check if the room is available on the specific date
                                if ($rooms[$roomNumber] == 'available') {
                                    echo "<input type='radio' name='selected-room[$date]' value='$roomNumber'>";
                                } else {
                                    echo "Booked";
                                }
                                echo "</td>";
                            }
                            echo "</tr>";
                        }
                        ?>
                    </table>

                    <label for="guest">Guests:</label><br>
                    <label for="children" class="reservation--label">Children:</label>
                    <input type="number" name="children" id="children">

                    <label for="adult" class="reservation--label">Adult:</label>
                    <input type="number" name="adult" id="adult">

                    <label for="check-in" class="reservation--label">Check-in:</label>
                    <input type="date" name="check-in" id="check-in" onchange="updatePriceAndOptions()">

                    <label for="check-out" class="reservation--label">Check-out:</label>
                    <input type="date" name="check-out" id="check-out" onchange="updatePriceAndOptions()">

                    <label for="room-price" class="reservation--label">Price per night:</label>
                    <input type="text" name="total-price" id="room-price" class="reservation--info" readonly>
                    <input type="hidden" name="price-per-night" id="price-per-night">

                    <label for="payment">Payment Method:</label>
                    <select class="reservation--info" name="payment" id="payment">
                        <option value="cash">Cash</option>
                        <option value="online">Online payment</option>
                    </select>

                    <button type="submit" class="submit">Check Availability</button>

                </div>
            </form>
        </div>
    </div>
</body>

<script>
    $(document).ready(function () {
        $('.carousel').slick({
            dots: true,
            arrows: true,
            prevArrow: '<button type="button" class="slick-prev"><i class="fas fa-chevron-left"></i></button>',
            nextArrow: '<button type="button" class="slick-next"><i class="fas fa-chevron-right"></i></button>',
            infinite: true,
            speed: 500,
            slidesToShow: 1,
            slidesToScroll: 1,
            autoplay: true,
            autoplaySpeed: 3000
        });
    });

    // Function to update price based on the selected room type and number of days
    function updatePriceAndOptions() {
        var roomTypeSelect = document.getElementById('room-type');
        var priceDisplay = document.getElementById('room-price');
        var priceInput = document.getElementById('price-per-night');
        var checkInDate = new Date(document.getElementById('check-in').value);
        var checkOutDate = new Date(document.getElementById('check-out').value);

        // Get the selected room type and its price
        var selectedOption = roomTypeSelect.options[roomTypeSelect.selectedIndex];
        var pricePerNight = parseFloat(selectedOption.getAttribute('data-price'));

        // Calculate the number of days
        var oneDay = 24 * 60 * 60 * 1000; // hours*minutes*seconds*milliseconds
        var diffDays = Math.round(Math.abs((checkOutDate - checkInDate) / oneDay));

        // If check-out date is the same as check-in date, consider it as one night stay
        if (diffDays === 0) {
            diffDays = 1; // Consider it as one night stay
        }
        var totalPrice = pricePerNight * diffDays;

        // Update the displayed price
        priceDisplay.value = '$' + totalPrice.toFixed(2);
        priceInput.value = totalPrice.toFixed(2);
    }

    // // Function to update room numbers based on the selected room type
    // function updateRoomNumbers() {
    //     var roomType = document.getElementById('room-type').value;
    //     var maxRooms = <?php echo json_encode($rooms); ?>[roomType];

    //     // Clear the existing options
    //     var selectRoom = document.getElementById('number-of-room');
    //     selectRoom.innerHTML = '';

    //     // Generate options for room numbers
    //     for (var i = 1; i <= maxRooms; i++) {
    //         var option = document.createElement('option');
    //         option.value = i;
    //         option.textContent = i;
    //         selectRoom.appendChild(option);
    //     }
    // }


    document.getElementById('room-type').addEventListener('change', updateRoomNumbers);
    updateRoomNumbers();

    // Get today's date
    // Function to update the minimum date for check-out
    function updateMinCheckoutDate() {
        var checkinInput = document.getElementById('check-in');
        var checkoutInput = document.getElementById('check-out');

        // Get the value of the check-in date input
        var checkinDate = new Date(checkinInput.value);

        // Calculate the minimum check-out date (next day of check-in)
        var minCheckoutDate = new Date(checkinDate);
        minCheckoutDate.setDate(checkinDate.getDate() + 1);

        // Format the minimum check-out date to 'YYYY-MM-DD'
        var minCheckoutDateString = minCheckoutDate.toISOString().split('T')[0];

        // Set the minimum date for check-out input
        checkoutInput.min = minCheckoutDateString;
    }

    // Attach an event listener to the check-in input to trigger the updateMinCheckoutDate function
    document.getElementById('check-in').addEventListener('change', updateMinCheckoutDate);

    function updateRoomAvailability() {
        var checkinDate = document.getElementById('check-in').value;

        // AJAX call to fetch availability data based on the selected check-in date
        $.ajax({
            url: 'fetch_room_availability.php', // Change the URL to the PHP script that fetches availability data
            method: 'POST',
            data: { checkInDate: checkinDate },
            success: function (response) {
                // Update the table with new availability data
                $('#number-of-room').html(response);
            }
        });
    }

</script>

</html>