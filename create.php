<?php

include 'connection.php';
//Create database
// $sql = "CREATE DATABASE easybooking"; 
// if (mysqli_query($conn, $sql)) {
//     echo "Database created successfully";
//   } else {
//     echo "Error creating database: " . mysqli_error($conn);
//   }

//create tables

// $sql = "CREATE TABLE hotels (
//     hotel_id INT AUTO_INCREMENT PRIMARY KEY,
//     hotel_name VARCHAR(255) NOT NULL,
//     hotel_email VARCHAR(255) NOT NULL,
//     hotel_password varchar(255) not null,
//     hotel_address VARCHAR(255) NOT NULL, 
//     hotel_contact VARCHAR(20) NOT NULL,
//     description text
// )";


// $sql = "CREATE TABLE rooms (
//     room_id INT AUTO_INCREMENT PRIMARY KEY,
//     hotel_id INT NOT NULL,
//     room_type VARCHAR(255) NOT NULL,
//     room_number INT NOT NULL,
//     services VARCHAR(255),
//     availability BOOLEAN NOT NULL
// )";


// $sql = "CREATE TABLE guests (
//     guest_id INT AUTO_INCREMENT PRIMARY KEY,
//     guest_name INT NOT NULL,
//     guest_email VARCHAR(255) NOT NULL,
//     guest_contact varchar(255) not null,
//     guest_pass varchar(255) not null
// )";

// $sql = "CREATE TABLE reservations (
//     reserve_id INT AUTO_INCREMENT PRIMARY KEY,
//     guest_id int not null,
//     hotel_id INT NOT NULL,
//     guest_count int not null,
//     room_number INT NOT NULL,
//     room_type VARCHAR(255) NOT NULL,
//     check_in datetime,
//     check_out datetime,
//     status boolean not null
// )";

// $sql = "CREATE TABLE users (
//     user_id INT AUTO_INCREMENT PRIMARY KEY,
//     fullname VARCHAR(255) NOT NULL,
//     email VARCHAR(255) NOT NULL UNIQUE,
//     password VARCHAR(255) NOT NULL,
//     phone VARCHAR(20)
// )";




// if (mysqli_query($conn, $sql)) {
//     echo "Table created successfully";
// } else {
//     echo "Error creating table: " . mysqli_error($conn);
// }



// Close connection
// mysqli_close($conn);
