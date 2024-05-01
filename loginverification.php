<?php
session_start();
include 'connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $userLoginPassword = $_POST['password'];

    // Check if the email exists in either 'users' or 'admins' table
    $query = "SELECT user_id, password, 'user' as type FROM users WHERE email = '$email' 
              UNION ALL 
              SELECT admin_id, password, 'admin' as type FROM admins WHERE email = '$email'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) === 1) {
        $row = mysqli_fetch_assoc($result);
        $storedPassword = $row['password'];

        if (($row['type'] === 'user' && password_verify($userLoginPassword, $storedPassword)) ||
            ($row['type'] === 'admin' && $userLoginPassword === $storedPassword)) {
            $_SESSION['email'] = $email;
            if ($row['type'] === 'admin') {
                header("Location: dashboard.php");
            } else {
                header("Location: landing.php");
            }
            exit;
        } else {
            $error_message = "Invalid username or password";
        }
    } else {
        $error_message = "Invalid username or password";
    }

    mysqli_close($conn);
} else {
    $error_message = "Invalid request method!";
}


include 'login.php';
