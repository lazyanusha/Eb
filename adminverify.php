<?php
session_start();
include 'connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $userLoginPassword = $_POST['password']; // The password the user submits on login

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
            // Username and password match
            echo "<script>alert('Login Successful');</script>";
            echo "<script>setTimeout(function() { document.querySelector('.alert').remove(); }, 3000);</script>";
            include 'dashboard.php';
            exit;
        } else {
            // Password does not match
            echo "<script>alert('Invalid username or password');</script>";
            include 'login.php';
        }
    } else {
        // User not found
        echo "<script>alert('Invalid username or password');</script>";
        include 'login.php';
    }

    // Close prepared statement
    $stmt->close();
} else {
    // Handle invalid request method
    echo "Invalid request method!";
}

