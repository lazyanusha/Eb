<?php
session_start();
include 'connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $userLoginPassword = $_POST['password'];

    // Prepare and execute the SELECT query using a prepared statement
    $stmt = $conn->prepare("SELECT password FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $row = $result->fetch_assoc();
        $storedHashedPassword = $row['password'];

        // Verify the password
        if (password_verify($userLoginPassword, $storedHashedPassword)) {
            // Password is correct, set session variable and redirect
            $_SESSION['email'] = $email;
            header("Location: landing.php");
            exit;
        } else {
            // Password does not match, set error message
            $error_message = "Invalid username or password";
        }
    } else {
        // User not found, set error message
        $error_message = "Invalid username or password";
    }

    // Close prepared statement
    $stmt->close();
} else {
    // Handle invalid request method
    $error_message = "Invalid request method!";
}

// Include login page with error message
include 'login.php';