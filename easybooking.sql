-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 01, 2024 at 12:21 PM
-- Server version: 8.0.36
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `easybooking`
--

-- --------------------------------------------------------

--
-- Table structure for table `hotels`
--

CREATE TABLE `hotels` (
  `hotel_id` int NOT NULL,
  `hotel_name` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `hotel_email` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `hotel_address` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `hotel_contact` varchar(20) COLLATE utf8mb4_general_ci NOT NULL,
  `description` text COLLATE utf8mb4_general_ci,
  `photos` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `ratings` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `hotels`
--

INSERT INTO `hotels` (`hotel_id`, `hotel_name`, `hotel_email`, `hotel_address`, `hotel_contact`, `description`, `photos`, `ratings`) VALUES
(1, 'Kathmandu Eco Hotel', 'ecokathmandu@gmail.com', 'Thamel, Kathmandu', '9808001077', 'Featuring rooms with a private bathroom, Kathmandu Eco Hotel is located at Thamel, the bustling tourist hub of Kathmandu. A rooftop area with dining tables and chairs and free WiFi is available. Free airport pick up is provided.\r\n\r\nKathmandu Eco Hotel is a 2-minute walk from the Thamel Tourist Market. Kathmandu Durbar Square is 1 km from the hotel while Pashupatinath Temple is 5 km away. Tribhuvan International Airport is located 7 km from the hotel.\r\n\r\nStay in a fan-cooled or air-conditioned room with a flat-screen satellite TV, seating area and electric kettle. A private bathroom comes with a hot and cold shower.\r\n\r\nGuests have access to a 24-hour reception and free private parking. Laundry is available at an extra cost.\r\n\r\nEco Restaurant specialises in Nepali, Indian and Continental cuisines. It also has a fully stocked bar.\r\n\r\nCouples particularly like the location — they rated it 9.2 for a two-person trip.\r\n\r\nDistance in property description is calculated using © OpenStreetMap', 'keh-img1.jpg', 4);

-- --------------------------------------------------------

--
-- Table structure for table `hotel_images`
--

CREATE TABLE `hotel_images` (
  `hotel_id` int NOT NULL,
  `image_name` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `hotel_images`
--

INSERT INTO `hotel_images` (`hotel_id`, `image_name`, `created_at`) VALUES
(1, 'keh-img.jpg', '2024-05-01 08:39:09'),
(1, 'keh-img2.jpg', '2024-05-01 08:39:09'),
(1, 'keh-img11.jpg', '2024-05-01 08:39:09'),
(1, 'keh-img4.jpg', '2024-05-01 08:39:09'),
(1, 'keh-img7.jpg', '2024-05-01 08:39:09'),
(1, 'keh-img8.jpg', '2024-05-01 08:39:09'),
(1, 'keh-img9.jpg', '2024-05-01 08:39:09'),
(1, 'keh-img10.jpg', '2024-05-01 08:39:09'),
(1, 'keh-img12.jpg', '2024-05-01 08:39:09'),
(1, 'keh-img15.jpg', '2024-05-01 08:39:09'),
(1, 'keh-img13.jpg', '2024-05-01 08:39:09'),
(1, 'keh-img16.jpg', '2024-05-01 08:39:09');

-- --------------------------------------------------------

--
-- Table structure for table `reservations`
--

CREATE TABLE `reservations` (
  `reservation_id` int NOT NULL,
  `guest_name` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `guests_num` int NOT NULL,
  `contact_information` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `check_in_date` date NOT NULL,
  `check_out_date` date NOT NULL,
  `room_number` varchar(20) COLLATE utf8mb4_general_ci NOT NULL,
  `room_type` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `bed_type` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `total_price` decimal(10,2) NOT NULL,
  `payment_status` enum('paid','pending','cancelled') COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'pending',
  `payment_method` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `hotel_id` int DEFAULT NULL,
  `booking_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `reservation_status` enum('confirmed','pending','cancelled') COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'pending',
  `email` varchar(255) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `reservations`
--

INSERT INTO `reservations` (`reservation_id`, `guest_name`, `guests_num`, `contact_information`, `check_in_date`, `check_out_date`, `room_number`, `room_type`, `bed_type`, `total_price`, `payment_status`, `payment_method`, `hotel_id`, `booking_date`, `reservation_status`, `email`) VALUES
(1, 'Anusha Shrestha', 3, '9805872143', '2024-05-16', '2024-05-18', '2', 'luxury', 'double', 100.00, 'pending', 'online', 1, '2024-05-01 14:55:19', 'pending', 'yanusashrestha@gmail.com'),
(2, 'Alisha Shrestha', 1, '9824718989', '2024-05-01', '2024-05-04', '1', 'luxury', 'single', 150.00, 'pending', 'cash', 1, '2024-05-01 15:02:51', 'pending', 'sthaalisha61@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `rooms`
--

CREATE TABLE `rooms` (
  `room_id` int NOT NULL,
  `hotel_id` int NOT NULL,
  `room_type` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `availability` tinyint(1) DEFAULT NULL,
  `Quantity` int DEFAULT NULL,
  `Price` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `rooms`
--

INSERT INTO `rooms` (`room_id`, `hotel_id`, `room_type`, `availability`, `Quantity`, `Price`) VALUES
(1, 1, 'normal', NULL, 20, 40.00),
(2, 1, 'luxury', NULL, 10, 50.00),
(3, 1, 'king', NULL, 5, 80.00);

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE `services` (
  `hotel_id` int NOT NULL,
  `service` varchar(50) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`hotel_id`, `service`) VALUES
(1, 'Free Wifi'),
(1, 'Airport Shuttle'),
(1, 'Non-smoking Rooms'),
(1, 'Free Parking'),
(1, 'Family Rooms'),
(1, 'Restaurant'),
(1, 'Fabulous Breakfast'),
(1, 'Room Service');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int NOT NULL,
  `fullname` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `phone` varchar(20) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `images` blob,
  `role` enum('user','admin','superadmin','custom_role') COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `fullname`, `email`, `password`, `phone`, `images`, `role`) VALUES
(1, 'Anusha Shrestha', 'yanusashrestha@gmail.com', '$2y$10$hhJLR/ciong1uldGafOwB.Gu72wZXFRcOqZdTDA9Y4sEYxajjjqUm', '9805872143', NULL, 'user'),
(2, 'Alisha Shrestha', 'sthaalisha61@gmail.com', '$2y$10$Wj48gcOmKUm6SSRHJYOx8eAu5wBSZttOjwzNpkRSJt4v6CxnOeF7e', '9824718989', NULL, 'user');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `hotels`
--
ALTER TABLE `hotels`
  ADD PRIMARY KEY (`hotel_id`);

--
-- Indexes for table `reservations`
--
ALTER TABLE `reservations`
  ADD PRIMARY KEY (`reservation_id`),
  ADD KEY `hotel_id` (`hotel_id`);

--
-- Indexes for table `rooms`
--
ALTER TABLE `rooms`
  ADD PRIMARY KEY (`room_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `hotels`
--
ALTER TABLE `hotels`
  MODIFY `hotel_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `reservations`
--
ALTER TABLE `reservations`
  MODIFY `reservation_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `rooms`
--
ALTER TABLE `rooms`
  MODIFY `room_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `reservations`
--
ALTER TABLE `reservations`
  ADD CONSTRAINT `reservations_ibfk_1` FOREIGN KEY (`hotel_id`) REFERENCES `hotels` (`hotel_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
