<?php
session_start();
include 'connection.php'; 

function hashPassword($password)
{
    return password_hash($password, PASSWORD_DEFAULT);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fullname = $_POST['fname'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $password = $_POST['password1'];

    // Hash the password
    $hashedPassword = hashPassword($password);

    // Prepare the SQL statement
    $stmt = mysqli_prepare($conn, "INSERT INTO users (fullname, email, password, phone) VALUES (?, ?, ?, ?)");
    mysqli_stmt_bind_param($stmt, "ssss", $fullname, $email, $hashedPassword, $phone);

    if (mysqli_stmt_execute($stmt)) {
        echo "Registered successfully.";
        header("Location: login.php");
        exit();
    } else {
        // Registration failed
        echo "Failed to register";
        include 'signup.php';
    }
    mysqli_stmt_close($stmt);
}

mysqli_close($conn);
