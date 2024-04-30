-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 30, 2024 at 11:55 AM
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
  `hotel_name` varchar(255) NOT NULL,
  `hotel_email` varchar(255) NOT NULL,
  `hotel_address` varchar(255) NOT NULL,
  `hotel_contact` varchar(20) NOT NULL,
  `description` text,
  `photos` varchar(255) NOT NULL,
  `ratings` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `hotels`
--

INSERT INTO `hotels` (`hotel_id`, `hotel_name`, `hotel_email`, `hotel_address`, `hotel_contact`, `description`, `photos`, `ratings`) VALUES
(13, 'Ujjwal ', 'ujjwal@gmail.com', 'Balkhu', '9803428166', 'Welcome to our hotel, your next reliable home. We offer a comfortable and convenient stay for travelers of all kinds. Whether you\'re visiting for business or pleasure, location and friendly staff are here to make your stay unforgettable.\r\n\r\nRelax and unwind in our spacious rooms, each equipped with comfortable beds, private bathrooms, complimentary Wi-Fi. Enjoy a delicious meal at our on-site restaurant, featuring local specialties, international dishes. For those seeking relaxation, take a dip in our sparkling pool, soothing spa or explore the surrounding area with the help of our concierge team.\r\n\r\nBook your stay today and experience the comfort and hospitality that awaits you', 'taleju.jpg', 5),
(14, 'Ujeli', 'yanusashrestha@gmail.com', 'Balkhu', '9803428166', 'Welcome to our hotel, your next reliable home. We offer a comfortable and convenient stay for travelers of all kinds. Whether you\'re visiting for business or pleasure, location and friendly staff are here to make your stay unforgettable.\r\n\r\nRelax and unwind in our spacious rooms, each equipped with comfortable beds, private bathrooms, complimentary Wi-Fi. Enjoy a delicious meal at our on-site restaurant, featuring local specialties, international dishes. For those seeking relaxation, take a dip in our sparkling pool, soothing spa or explore the surrounding area with the help of our concierge team.\r\n\r\nBook your stay today and experience the comfort and hospitality that awaits you', 'login.jpg', 2),
(15, 'Oasis Hotel', 'oasis@gmail.com', 'Thamel', '9873785437', 'Welcome to our hotel, your next reliable home. We offer a comfortable and convenient stay for travelers of all kinds. Whether you\'re visiting for business or pleasure, location and friendly staff are here to make your stay unforgettable.\r\n\r\nRelax and unwind in our spacious rooms, each equipped with comfortable beds, private bathrooms, complimentary Wi-Fi. Enjoy a delicious meal at our on-site restaurant, featuring local specialties, international dishes. For those seeking relaxation, take a dip in our sparkling pool, soothing spa or explore the surrounding area with the help of our concierge team.\r\n\r\nBook your stay today and experience the comfort and hospitality that awaits you', 'oasis.jpg', NULL),
(16, 'Ujjwal Hotel and bar', 'yanusashrestha@gmail.com', 'Thamel', '9803428166', 'hello', 'login.jpg', NULL),
(17, 'Oasis Hotel and bar', 'yanusashrestha@gmail.com', 'Balkhu', '9803428166', 'grofhugvbhjohjd', 'login.jpg', NULL),
(18, 'Ujjwal ', 'ujjwal@gmail.com', 'Balkhu', '9803428166', 'hello', 'jampa.jpg', NULL),
(19, 'Kathmandu hotel ', 'hotelkathmandu@gmail.com', 'Thamel', '9856372435', 'Get your trip off to a great start with a stay at this property, which offers free Wi-Fi in all rooms. Conveniently situated in the Haeundae-gu part of Busan, this property puts you close to attractions and interesting dining options. Be sure to set some time aside to visit Gamcheon Culture Village as well as Haeundae Beach nearby.', 'manang.jpg', 4),
(20, 'Alisha Hotel', 'alisha@gmail.com', 'Satdobato', '9824718989', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.\r\n\r\nIt is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using \'Content here, content here\', making it look like readable English.', 'alisha.jpg', 4),
(21, 'Sumina Hotel', 'sumina@gmail.com', 'Satdobato', '9849862645', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 'kathmandu.jpg', 3),
(22, 'Rashmita Hotel', 'rashmita@gmail.com', 'Kalimati', '9865471019', 'Artudio, the Center for Contemporary Visual Arts, stands as a dynamic and pioneering art collective and platform at the forefront of Nepal’s cutting-edge contemporary art scene. Founded by visionary artist Kailash K Shrestha in 2010, this revolutionary space catalyzes transformative art practices, daring curatorial initiatives, groundbreaking exhibitions, residencies, and innovative education programs. Unapologetically challenging Western-centric perspectives, Artudio initiates a profound discourse, unveiling overlooked intricacies and diverse narratives. Embracing sustainability, it nurtures socially engaged art, forging interconnected art communities. Beyond traditional exhibitions, it fosters interdisciplinary networks, transcending boundaries and sparking critical dialogues. A hub for interdisciplinary practitioners, Artudio reshapes Nepal’s artistic landscape, driving social engagement and creating a vibrant art community.', 'alisha.jpg', 4),
(23, 'Anish Hotel', 'anish@gmail.com', 'Ashapuri Chwok', '9818184662', 'Located in Kathmandu, 300 metres from Boudhanath Stupa, HOTEL BHRIKUTI TARA provides accommodation with a garden, free private parking, a terrace and a restaurant. This 3-star hotel offers room service, a 24-hour front desk and free WiFi. Guests can have a drink at the snack bar.\r\n\r\nAt the hotel every room comes with air conditioning, a seating area, a flat-screen TV with cable channels, a safety deposit box and a private bathroom with a shower, free toiletries and a hairdryer. Every room is fitted with a kettle, while some rooms here will provide you with a kitchen with a dishwasher, an oven and a microwave. At HOTEL BHRIKUTI TARA each room has bed linen and towels.\r\n\r\nThe daily breakfast offers buffet, à la carte or continental options.\r\n\r\nThere is an on-site bar and guests can also make use of the business area.', 'alisha.jpg', 4),
(24, 'Bishal Hotel', 'bshal@gmail.com', 'kalimati', '9808001077', 'lorem ipsum bla bla bla', 'kathmandu.jpg', 4);

-- --------------------------------------------------------

--
-- Table structure for table `hotel_images`
--

CREATE TABLE `hotel_images` (
  `hotel_id` int NOT NULL,
  `image_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `hotel_images`
--

INSERT INTO `hotel_images` (`hotel_id`, `image_name`, `created_at`) VALUES
(17, 'taleju.jpg', '2024-03-24 17:26:39'),
(18, 'login.jpg', '2024-03-24 17:28:05'),
(19, 'taleju.jpg', '2024-03-25 09:31:55'),
(19, 'oasis.jpg', '2024-03-25 09:31:55'),
(19, 'kathmandu.jpg', '2024-03-25 09:31:55'),
(19, 'jampa.jpg', '2024-03-25 09:31:55'),
(20, 'taleju.jpg', '2024-03-25 17:10:58'),
(20, 'alisha.jpg', '2024-03-25 17:10:58'),
(20, 'kathmandu.jpg', '2024-03-25 17:10:58'),
(20, 'manang.jpg', '2024-03-25 17:10:58'),
(20, 'oasis.jpg', '2024-03-25 17:10:59'),
(21, 'oasis.jpg', '2024-03-26 05:25:26'),
(21, 'taleju.jpg', '2024-03-26 05:25:26'),
(21, 'oasis.jpg', '2024-03-26 05:25:38'),
(21, 'taleju.jpg', '2024-03-26 05:25:38'),
(22, 'taleju.jpg', '2024-03-26 08:36:20'),
(22, 'jampa.jpg', '2024-03-26 08:36:20'),
(22, 'kathmandu.jpg', '2024-03-26 08:36:20'),
(22, 'manang.jpg', '2024-03-26 08:36:20'),
(23, 'kathmandu.jpg', '2024-03-29 16:06:13'),
(23, 'manang.jpg', '2024-03-29 16:06:13'),
(23, 'jampa.jpg', '2024-03-29 16:06:13'),
(23, 'oasis.jpg', '2024-03-29 16:06:13'),
(24, 'jampa.jpg', '2024-04-28 06:54:45'),
(24, 'manang.jpg', '2024-04-28 06:54:46'),
(24, 'taleju.jpg', '2024-04-28 06:54:46');

-- --------------------------------------------------------

--
-- Table structure for table `reservations`
--

CREATE TABLE `reservations` (
  `reservation_id` int NOT NULL,
  `guest_name` varchar(100) NOT NULL,
  `guests_num` int NOT NULL,
  `contact_information` varchar(255) DEFAULT NULL,
  `check_in_date` date NOT NULL,
  `check_out_date` date NOT NULL,
  `room_number` varchar(20) NOT NULL,
  `room_type` varchar(50) DEFAULT NULL,
  `bed_type` varchar(50) DEFAULT NULL,
  `special_requests` text,
  `total_price` decimal(10,2) NOT NULL,
  `payment_status` enum('paid','pending','cancelled') NOT NULL DEFAULT 'pending',
  `payment_method` varchar(50) NOT NULL,
  `hotel_id` int DEFAULT NULL,
  `booking_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `reservation_status` enum('confirmed','pending','cancelled') NOT NULL DEFAULT 'pending',
  `email` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `reservations`
--

INSERT INTO `reservations` (`reservation_id`, `guest_name`, `guests_num`, `contact_information`, `check_in_date`, `check_out_date`, `room_number`, `room_type`, `bed_type`, `special_requests`, `total_price`, `payment_status`, `payment_method`, `hotel_id`, `booking_date`, `reservation_status`, `email`) VALUES
(29, 'Anusha Shrestha', 8, '9805872143', '2024-04-18', '2024-04-20', '4', 'luxury', 'single', 'yes', 6000.00, 'pending', 'online', 19, '2024-04-17 13:10:34', 'pending', 'yanusashrestha@gmail.com'),
(30, 'Alisha Shrestha', 2, '9824718989', '2024-04-18', '2024-04-19', '1', 'king', 'double', 'no', 5000.00, 'pending', 'online', 19, '2024-04-17 13:20:35', 'pending', 'sthaalisha61@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `rooms`
--

CREATE TABLE `rooms` (
  `room_id` int NOT NULL,
  `hotel_id` int NOT NULL,
  `room_type` varchar(255) NOT NULL,
  `availability` tinyint(1) DEFAULT NULL,
  `Quantity` int DEFAULT NULL,
  `Price` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `rooms`
--

INSERT INTO `rooms` (`room_id`, `hotel_id`, `room_type`, `availability`, `Quantity`, `Price`) VALUES
(2, 13, 'normal', NULL, 4, 1000.00),
(3, 13, 'normal', NULL, 2, 3000.00),
(4, 14, 'normal', NULL, 10, 2000.00),
(5, 14, 'luxury', NULL, 5, 4000.00),
(6, 15, 'normal', NULL, 5, 1500.00),
(7, 16, 'normal', NULL, 10, 3000.00),
(8, 17, 'luxury', NULL, 10, 3000.00),
(9, 18, 'king', NULL, 5, 10000.00),
(10, 19, 'normal', NULL, 5, 1000.00),
(11, 19, 'luxury', NULL, 10, 3000.00),
(12, 19, 'king', NULL, 15, 5000.00),
(13, 20, 'king', NULL, 5, 10000.00),
(14, 20, 'normal', NULL, 10, 1500.00),
(15, 20, 'luxury', NULL, 7, 5000.00),
(16, 21, 'normal', NULL, 10, 1000.00),
(17, 21, 'luxury', NULL, 2, 5000.00),
(18, 22, 'normal', NULL, 5, 1000.00),
(19, 22, 'luxury', NULL, 8, 2000.00),
(20, 23, 'normal', NULL, 5, 1000.00),
(21, 24, 'normal', NULL, 5, 490.00),
(22, 24, 'deluxe', NULL, 7, 500.00);

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE `services` (
  `hotel_id` int NOT NULL,
  `service` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`hotel_id`, `service`) VALUES
(15, 'Free Wifi'),
(15, 'Free Breakfast'),
(16, 'Free Wifi'),
(16, 'free drive'),
(17, 'Free Wifi'),
(18, 'Free Wifi'),
(19, 'Free Wifi'),
(19, 'Pickup services'),
(19, '5% early bird discount'),
(20, 'Free Wifi'),
(20, 'Pickup'),
(20, 'Snacks '),
(20, 'Free cancellation'),
(21, 'Free Wifi'),
(21, 'Pickup'),
(21, 'Room Service'),
(22, 'Free Wifi'),
(22, 'Parking'),
(22, 'Pickup'),
(23, 'Free Wifi'),
(24, 'free wifi'),
(24, 'pickup'),
(15, 'ALL FREE');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int NOT NULL,
  `fullname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `images` blob,
  `role` enum('user','admin','superadmin','custom_role') NOT NULL DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

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
  MODIFY `hotel_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `reservations`
--
ALTER TABLE `reservations`
  MODIFY `reservation_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `rooms`
--
ALTER TABLE `rooms`
  MODIFY `room_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

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
