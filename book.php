
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Reservation</title>
  <link rel="stylesheet" href="../static/css/style.css" />
  <style>
    .image img {
      height: 70vh;
      width: 100%;

    }

    .image {
      margin-bottom: 100px;
    }
  </style>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
</head>

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
    <img src="../static/images/hotel.png" alt="image">
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
      <form action="#" class="form--container">
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

</html>
<?php
include('../static/particials/footer.php')
  ?>