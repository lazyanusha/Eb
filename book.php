<?php
session_start();

include 'connection.php';
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

    $sql_rooms = "SELECT room_type, quantity FROM rooms WHERE hotel_id = ?";
    $stmt_rooms = mysqli_prepare($conn, $sql_rooms);
    if ($stmt_rooms) {
        mysqli_stmt_bind_param($stmt_rooms, "i", $hotel_id);
        if (mysqli_stmt_execute($stmt_rooms)) {
            $result_rooms = mysqli_stmt_get_result($stmt_rooms);
            while ($row_rooms = mysqli_fetch_assoc($result_rooms)) {
                $rooms[$row_rooms['room_type']] = $row_rooms['quantity'];
            }
        } else {
            echo "Error executing rooms query: " . mysqli_error($conn);
        }
        mysqli_stmt_close($stmt_rooms);
    } else {
        echo "Error preparing rooms query: " . mysqli_error($conn);
    }

    $sql_images = "SELECT image_name FROM hotel_images WHERE hotel_id = ?";
    $stmt_images = mysqli_prepare($conn, $sql_images);
    if ($stmt_images) {
        mysqli_stmt_bind_param($stmt_images, "i", $hotel_id);
        if (mysqli_stmt_execute($stmt_images)) {
            $result_images = mysqli_stmt_get_result($stmt_images);
            while ($row_images = mysqli_fetch_assoc($result_images)) {
                $images[] = $row_images['image_name'];
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

    $sql_user = "SELECT fullname, phone FROM users WHERE email = ?";
    $stmt_user = mysqli_prepare($conn, $sql_user);
    if ($stmt_user) {
        mysqli_stmt_bind_param($stmt_user, "s", $_SESSION['email']);
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
        mysqli_stmt_close($stmt_user);
    } else {
        echo "Error preparing user query: " . mysqli_error($conn);
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
                    <div><a href="<?php echo $image; ?>"><img src="<?php echo $image; ?>" alt="Hotel Image"
                                loading="lazy"></a>
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
                <div class="list">
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
                    <label for="room-type" class="reservation--label">Type of room:</label>
                    <select class="reservation--info" name="room-type" id="room-type">
                        <option value="" disabled selected>Select type of room</option>
                        <?php foreach ($rooms as $roomType => $quantity): ?>
                            <option value="<?php echo $roomType; ?>">
                                <?php echo ucfirst($roomType); ?> Room
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
                    <select class="reservation--info" name="number-of-room" id="number-of-room">
                        <option value="" disabled selected>Select room number</option>
                        <?php for ($i = 1; $i <= $quantity; $i++): ?>
                            <option value="<?php echo $i; ?>">
                                <?php echo $i; ?>
                            </option>
                        <?php endfor; ?>
                    </select>
                    <label for="guest">Guests:</label><br>
                    <label for="children" class="reservation--label">Children:</label>
                    <input type="number" name="children" id="children">

                    <label for="adult" class="reservation--label">Adult:</label>
                    <input type="number" name="adult" id="adult">

                    <label for="check-in" class="reservation--label">Check-in:</label>
                    <input type="date" name="check-in" id="check-in">

                    <label for="check-out" class="reservation--label">Check-out:</label>
                    <input type="date" name="check-out" id="check-out">

                    <label for="contact">Special Request:</label>
                    <select class="reservation--info" name="special-request" id="special-request">
                        <option value="" disabled selected>Any special requests?</option>
                        <option value="yes">Yes</option>
                        <option value="no">No</option>
                    </select>
                    <label for="price">Total Price:</label>
                    <input type="number" name="total-price">
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
</script>

</html>