<?php
session_start();
include 'connection.php'; // Include your database connection file

// Function to hash a password
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
    $stmt = mysqli_prepare($conn, "INSERT INTO users (fname, email, phone, password) VALUES (?, ?, ?, ?, ?)");
    mysqli_stmt_bind_param($stmt, "sssss", $fullname, $email, $phone, $hashedPassword);

    if (mysqli_stmt_execute($stmt)) {
        echo "<script>alert('Registered successfully');</script>";
        header("Location: login.php");
        exit();
    } else {
        // Registration failed
        echo "<script>alert('Failed to register');</script>";
        include 'signup.php';
    }
    mysqli_stmt_close($stmt);
}

$sql = "UPDATE users SET profile_pic_path = '$profilePicPath' WHERE id = $userId";
if(mysqli_query($conn, $sql)) {
    echo "Profile picture uploaded successfully.";
} else {
    echo "Error updating record: " . mysqli_error($conn);
}


mysqli_close($conn);

