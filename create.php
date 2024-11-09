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
//     description text,
//     photos blob not null
// )";


// $sql = "CREATE TABLE rooms (
//     room_id INT AUTO_INCREMENT PRIMARY KEY,
//     hotel_id INT NOT NULL,
//     room_type VARCHAR(255) NOT NULL,
//     room_number INT NOT NULL,
//     services VARCHAR(255),
//     availability BOOLEAN NOT NULL
// )";


// $sql = "CREATE TABLE admins (
//     user_id INT AUTO_INCREMENT PRIMARY KEY,
//     fullname VARCHAR(255) NOT NULL,
//     email VARCHAR(255) NOT NULL UNIQUE,
//     password VARCHAR(255) NOT NULL,
//     phone VARCHAR(20),
//     images blob
// )";

// $sql = "CREATE TABLE users (
//     user_id INT AUTO_INCREMENT PRIMARY KEY,
//     fullname VARCHAR(255) NOT NULL,
//     email VARCHAR(255) NOT NULL UNIQUE,
//     password VARCHAR(255) NOT NULL,
//     phone VARCHAR(20),
//     images blob
// )";

// $sql = "CREATE TABLE hotel_images (
//     image_id INT AUTO_INCREMENT PRIMARY KEY,
//     hotel_id INT,
//     image_data BLOB,
//     FOREIGN KEY (hotel_id) REFERENCES hotels(hotel_id)
// )";


// $sql = "CREATE TABLE reservations (
//     reservation_id INT AUTO_INCREMENT PRIMARY KEY,
//     guest_name VARCHAR(100) NOT NULL,
//     guests_num INT NOT NULL,
//     contact_information VARCHAR(255),
//     check_in_date DATE NOT NULL,
//     check_out_date DATE NOT NULL,
//     room_number VARCHAR(20) NOT NULL,
//     room_type VARCHAR(50),
//     bed_type VARCHAR(50), 
//     total_price DECIMAL(10,2) NOT NULL,
//     payment_status ENUM('paid', 'pending', 'cancelled') NOT NULL DEFAULT 'pending',
//     payment_method VARCHAR(50) NOT NULL,
//     hotel_id INT,
//     FOREIGN KEY (hotel_id) REFERENCES hotels(hotel_id),
//     booking_date DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
//     reservation_status ENUM('confirmed', 'pending', 'cancelled') NOT NULL DEFAULT 'pending'
// )";



// if (mysqli_query($conn, $sql)) {
//     echo "Table created successfully";
// } else {
//     echo "Error creating table: " . mysqli_error($conn);
// }




// mysqli_close($conn);
