<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Hotel Reservation System - Sign Up</title>
  <link rel="stylesheet" href="./css/log.css">
</head>
<body>
  <div class="container">
    <form class="form--2" action="signupvalidate.php" method="post" onsubmit="return validateForm()">
      <h2>EasyBookings</h2>
      <div class="content">
        <label for="fname">Full Name:</label>
        <input type="text" id="fname" name="fname" required />

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required />

        <label for="phone">Phone Number:</label>
        <input type="tel" id="phone" name="phone" oninput="formatPhoneNumber(this)" maxlength="10" pattern="[0-9]{10}" required />

        <label for="password">Password:</label>
        <input type="password" id="password" name="password1" required />
        <div id="passwordFeedback"></div>

        <label for="password">Confirm password:</label>
        <input type="password" id="password2" name="password2" required />

        <!-- Submit Button -->
        <button class="button-1" type="submit">Sign Up</button>

        <p>
          Already have an account?
          <a href="login.php"><span style="color: blue;">Log In</span></a>
        </p>
      </div>
    </form>
  </div>

  <script>
    function validateForm() {
      var password = document.getElementById("password").value;
      var confirmPassword = document.getElementById("password2").value;

      if (password !== confirmPassword) {
        alert("Passwords do not match");
        return false;
      }

      var strength = 0;
      if (password.length >= 8) strength += 1;
      if (password.match(/[a-z]+/)) strength += 1;
      if (password.match(/[A-Z]+/)) strength += 1;
      if (password.match(/[0-9]+/)) strength += 1;
      if (password.match(/[\W_]+/)) strength += 1;

      var feedback = "";
      switch (strength) {
        case 0:
        case 1:
        case 2:
          feedback = "Weak";
          break;
        case 3:
        case 4:
          feedback = "Moderate";
          break;
        case 5:
          feedback = "Strong";
          break;
      }
      document.getElementById("passwordFeedback").innerText = "Password Strength: " + feedback;

      return strength >= 3;
    }

    function formatPhoneNumber(input) {
      var phoneNumber = input.value.replace(/\D/g, '');
      if (phoneNumber.length > 10) {
        phoneNumber = phoneNumber.slice(0, 10);
      }
      var formattedPhoneNumber = phoneNumber.replace(/(\d{3})(\d{3})(\d{4})/, '$1$2$3');
      input.value = formattedPhoneNumber;
    }
  </script>
</body>
</html>
