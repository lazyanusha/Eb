<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Reservation</title>
  <link rel="stylesheet" href="./css/style.css" />
  <!-- Slick Carousel CSS -->
  <link rel="stylesheet" type="text/css"
    href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.css" />
  <!-- Slick Carousel Theme CSS (optional) -->
  <link rel="stylesheet" type="text/css"
    href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick-theme.min.css" />
  <!-- jQuery (required by Slick Carousel) -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <!-- Slick Carousel JavaScript -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
  <style>
    .image img {
      height: 70vh;
      width: 100%;
    }

    .image {
      height: 80vh;
      margin-bottom: 150px;
    }

    
    .slick-prev,
    .slick-next {
      position: absolute;
      top: 50%;
      z-index: 1;
      width: 30px;
      height: 30px;
      background-color: rgba(0, 0, 0, 0.5);
      color: white;
      border: none;
      border-radius: 50%;
      cursor: pointer;
      transform: translateY(-50%);
      display: flex;
      justify-content: center;
      align-items: center;
    }

    .slick-prev {
      left: 10px;
    }

    .slick-next {
      right: 10px;
    }

    .thumbnails {
      gap: 0;
    }

    .thumbnails img {
      height: 50px;
      width: auto;
      margin: 5px;
      cursor: pointer;
    }
  </style>

<body>
  <div>
    <nav class="navigation_bar">
      <div class="logo">
        <a href="home.php">EasyBookings</a>
      </div>
      <div class="menu">
        <ul>
          <li><a href="landing.php">Home</a></li>
          <li><a href="About us.php">About Us</a></li>
          <li><a href="contact_us.php">Contact Us</a></li>
          <li><a href="services.php">Services</a></li>
        </ul>
      </div>
      <div class="new">
        <a href="g-dashboard.php">Dashboard</a>
        <a href="g-booking.php"><i class="fas fa-bed"></i>
        </a>

        <a href="home.php"><i class="fas fa-sign-out-alt"></i></a>

      </div>
    </nav>
  </div>
  <div class="image">
    <div class="carousel-container">
      <div class="carousel">
        <div><a href="jampa.jpg"><img src="jampa.jpg" alt="Image 1" loading="lazy"></a></div>
        <div><a href="logo.png"><img src="logo.png" alt="Image 2" loading="lazy"></a></div>
        <!-- Add more images as needed -->
      </div>
    </div>
    <!-- Thumbnails Carousel -->
    <div class="thumbnails-container">
      <div class="thumbnails">
        <div><img src="jampa.jpg" alt="Thumbnail 1" loading="lazy"></div>
        <div><img src="logo.png" alt="Thumbnail 2" loading="lazy"></div>
        <!-- Add more thumbnail images as needed -->
      </div>
    </div>
  </div>


  <div class="sections">
    <div class="hotel--info">
      <h2>Hotel Name</h2>
      <p class="paragraph1">
        Welcome to our hotel, your next reliable home. We offer a comfortable
        and convenient stay for travelers of all kinds. Whether you're
        visiting for business or pleasure, location and friendly staff are
        here to make your stay unforgettable.
        <br /><br />Relax and unwind in our spacious rooms, each equipped with
        comfortable beds, private bathrooms, complimentary Wi-Fi. Enjoy a
        delicious meal at our on-site restaurant, featuring local specialties,
        international dishes. For those seeking relaxation, take a dip in our
        sparkling pool, soothing spa or explore the surrounding area with the
        help of our concierge team. <br /><br />Book your stay today and
        experience the comfort and hospitality that awaits you
      </p>
      <div class="area">
        <div class="list">
          <p class="paragraph">Our Services</p>
          <ul>
            <li>Free Wifi</li>
            <li>Free Parking</li>
            <li>Free Breakfast</li>
            <li>Clean Swimming Pool</li>
          </ul>
        </div>
        <div class="list">
          <p class="paragraph">Rooms Available:</p>
          <ul>
            <li>King size: 10</li>
            <li>Luxury room: 8</li>
            <li>Deluxe room: 4</li>
            <li>Normal room: 20</li>
          </ul>
        </div>
      </div>
      <div class="reviews">
        <p class="paragraph">Feedbacks</p>
        <p class="paragraph1">
          How was your stay with us? We'd love to hear your thoughts!
        </p>
        <form action="">
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
          <select class="reservation--info" name="room-type" placeholder="Type of room" id="room-type">
            <option value="normal">Select type of room</option>
            <option value="normal">Normal Room</option>
            <option value="normal">Luxury Room</option>
            <option value="normal">Deluxe Room</option>
            <option value="normal">King Size</option>
          </select><br />
          <select class="reservation--info" name="bed-type" id="room-type">
            <option value="normal">Select bedding type</option>
            <option value="normal">Single Bed</option>
            <option value="normal">Double Bed</option>
            <option value="normal">Triple Bed</option>
            <option value="normal">None</option>
          </select><br />
          <select class="reservation--info" name="number-of-room" id="room-type">
            <option value="">No of Room</option>
            <option value="room">1</option>
            <option value="room">2</option>
            <option value="room">3</option>
            <option value="room">4</option>
          </select><br /><br />

          <label for="guest" style="font-weight: bold">Guest: </label><br /><br />
          <div class="count">
            <div class="child">
              <label for="children">Children: </label>
            </div>
            <div class="number">
              <input type="number" value="children" /><br />
            </div>
          </div>
          <div class="count">
            <div class="child">
              <label for="adult">Adult: </label>
            </div>
            <div class="number">
              <input type="number" value="adult" />
            </div>
          </div>
          <div class="count">
            <div class="child">
              <label for="check in">check in</label>
            </div>
            <div class="number"><input type="date" value="date" /><br /></div>
          </div>
          <div class="count">
            <div class="child">
              <label for="check out">check out</label>
            </div>
            <div class="number"><input type="date" value="date" /><br /></div>
          </div>
          <button type="submit" class="submit">Check Availability</button>
        </div>
        <div></div>
      </form>
    </div>
  </div>
</body>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js"></script>
<script>
  $(document).ready(function () {
    // Initialize main carousel
    $('.carousel').slick({
      dots: false,
      arrows: true, // Show navigation arrows
      prevArrow: '<button type="button" class="slick-prev">Previous</button>',
      nextArrow: '<button type="button" class="slick-next">Next</button>',
      infinite: true,
      speed: 500, // Set the speed to 500 milliseconds for smooth sliding
      slidesToShow: 1,
      slidesToScroll: 1,
      asNavFor: '.thumbnails',
      autoplay: true,
      autoplaySpeed: 2000
    });

    // Initialize thumbnail carousel
    $('.thumbnails').slick({
      dots: false,
      arrows: false,
      infinite: true,
      speed: 500, // Set the speed to 500 milliseconds for smooth sliding
      slidesToShow: 5,
      slidesToScroll: 1,
      focusOnSelect: true,
      asNavFor: '.carousel'
    });
  });
</script>



</html>
<?php
include ('footer.php')
  ?>