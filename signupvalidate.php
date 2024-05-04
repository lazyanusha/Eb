<?php

session_start();

include 'connection.php';

function hashPassword($password)
{
    return password_hash($password, PASSWORD_DEFAULT);
}

// Function to get the next available user ID
function getNextUserID($conn)
{
    $result = mysqli_query($conn, "SELECT MAX(user_id) AS max_id FROM users");
    $row = mysqli_fetch_assoc($result);
    $maxID = $row['max_id'];
    return ($maxID === null) ? 1 : ($maxID + 1);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fullname = $_POST['fname'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $password = $_POST['password1'];

    // Hash the password
    $hashedPassword = hashPassword($password);

    // Get the next available user ID
    $userID = getNextUserID($conn);

    // Prepare the SQL statement
    $stmt = mysqli_prepare($conn, "INSERT INTO users (user_id, fullname, email, password, phone) VALUES ( ?, ?, ?, ?, ?)");
    mysqli_stmt_bind_param($stmt, "issss", $userID, $fullname, $email, $hashedPassword, $phone);

    if (mysqli_stmt_execute($stmt)) {
        echo "<script>alert('Register success. You will be redirected to login page.!!'); window.location='login.php';</script>";

        exit();
    } else {
        // Registration failed
        echo "Failed to register";
        include 'signup.php';
    }
    mysqli_stmt_close($stmt);
}

mysqli_close($conn);
