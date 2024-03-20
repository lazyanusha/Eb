<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta
      name="viewport"
      content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0"
    />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>Forgot Password</title>
    <link rel="stylesheet" href="../static/css/login.css" />
  </head>
  <body>
    <div class="form--3">
      <form action="password.php" method="post">
        <p>Please enter the email address.</p>
        <div class="login--2">
          <input
            type="text"
            id="email"
            name="email"
            placeholder="email"
            required
          />
          <!-- Submit Button -->
          <button type="submit" class="button">Send</button>
        </div>
      </form>
    </div>
  </body>
</html>
