<?php
session_start();
include 'nav.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <style>
    body{
      background-color: #f9f9f9;
    }
    header {
      background-color: #f0f0f0;
      text-align: center;
      padding: 20px 0;
      height: 40vh;
      display: flex;
      justify-content: center;
      align-items: center;

    }

    h1 {
      color: #333;
    }

    .container {
      display: flex;
      justify-content: space-around;
      margin: 20px;
      column-gap: 50px;
      min-height: 40vh;
    }

    section {
      flex: 1;
      padding: 20px;
    }

    .contact-info,  .contact-form {
      padding: 30px;
      display: flex;
      flex-wrap: wrap;
      justify-content: center;
      align-items: center;
      flex-direction: column;
      row-gap: 20px;
    }

    .contact-form form input,
    .contact-form form textarea,
    .contact-form form button {
      display: block !important;
      width: 100% !important;
      margin-bottom: 10px !important;
      padding: 10px !important;
      font-size: 16px !important;
      border: 1px solid #ccc !important;
      border-radius: 5px !important;
    }

    form button {
      background-color: #2b3454;
      color: #fff;
      cursor: pointer;
    }

    footer {
      background-color: #2b3454;
      color: #fff;
      text-align: center;
      padding: 20px 0;
    }
  </style>
</head>

<body>
  <header>
    <h1>Contact Us</h1>
  </header>
  <div class="container">
    <section class="contact-info">
      <h2>Our Location</h2>
      <p>Balkhu</p>
      <p>Kathmandu, 44700</p>
      <p>Nepal</p>
    </section>
    <section class="contact-form">
      <h2>Send us a Message</h2>
      <form action="#" method="POST">
        <input type="text" name="name" placeholder="Your Name" required>
        <input type="email" name="email" placeholder="Your Email" required>
        <textarea name="message" placeholder="Your Message" required></textarea>
        <button type="submit">Send</button>
      </form>
    </section>
  </div>
</body>

</html>
<?php
include 'footer.php';
?>