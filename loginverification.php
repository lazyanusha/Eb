<?php
session_start();
include 'connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $userLoginPassword = $_POST['password'];

    // Prepare and execute the SELECT query using a prepared statement
    $stmt = $conn->prepare("SELECT user_id, password FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $row = $result->fetch_assoc();
        $storedHashedPassword = $row['password'];

        // Verify the password
        if (password_verify($userLoginPassword, $storedHashedPassword)) {
            $_SESSION['email'] = $email;
            header("Location: landing.php");
            exit;
        } else {

            $error_message = "Invalid username or password";
        }
    } else {

        $error_message = "Invalid username or password";
    }


    $stmt->close();
} else {

    $error_message = "Invalid request method!";
}

// Include login page with error message
include 'login.php';
