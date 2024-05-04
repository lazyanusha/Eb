-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 04, 2024 at 07:28 PM
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
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `admin_id` int NOT NULL,
  `fullname` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `phone` varchar(20) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `images` blob
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`admin_id`, `fullname`, `email`, `password`, `phone`, `images`) VALUES
(3, 'Ujjwal Shrestha', 'ujjwal@gmail.com', 'ujjwal@143', '9803428166', 0x75706c6f6164732f616266672e6a7067),
(4, 'Sumina Rokaha', 'sumina@gmail.com', 'Sumina@123', '9876543213', 0x75706c6f6164732f6161612e6a7067),
(5, 'Rashmita Malla Thakuri', 'rashmita@gmail.com', 'Rashmi123', '9876543219', 0x75706c6f6164732f312e6a7067),
(6, 'Bishal Manandhar', 'bishal@gmail.com', 'Bishal@123', '9806789032', NULL);

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
(1, 'Kathmandu Eco Hotel', 'ecokathmandu@gmail.com', 'Thamel, Kathmandu', '9808001077', 'Featuring rooms with a private bathroom, Kathmandu Eco Hotel is located at Thamel, the bustling tourist hub of Kathmandu. A rooftop area with dining tables and chairs and free WiFi is available. Free airport pick up is provided.\r\n\r\nKathmandu Eco Hotel is a 2-minute walk from the Thamel Tourist Market. Kathmandu Durbar Square is 1 km from the hotel while Pashupatinath Temple is 5 km away. Tribhuvan International Airport is located 7 km from the hotel.\r\n\r\nStay in a fan-cooled or air-conditioned room with a flat-screen satellite TV, seating area and electric kettle. A private bathroom comes with a hot and cold shower.\r\n\r\nGuests have access to a 24-hour reception and free private parking. Laundry is available at an extra cost.\r\n\r\nEco Restaurant specialises in Nepali, Indian and Continental cuisines. It also has a fully stocked bar.\r\n\r\nCouples particularly like the location — they rated it 9.2 for a two-person trip.\r\n\r\nDistance in property description is calculated using © OpenStreetMap', 'keh-img1.jpg', 4),
(2, 'Lumbini Heritage Home', 'heritagelumbini@gmail.com', 'Lalitpur, Kathmandu', '9876543210', 'Take in the views from a terrace and make use of amenities such as complimentary wireless internet access and tour/ticket assistance.Enjoy a meal at the restaurant, or stay in and take advantage of the hotel\'s room service (during limited hours). Continental breakfasts are available daily from 7 AM to 10 AM for a fee.Featured amenities include dry cleaning/laundry services, a 24-hour front desk, and luggage storage. A roundtrip airport shuttle is provided for a surcharge (available 24 hours), and free self parking is available onsite.Make yourself at home in one of the 8 guestrooms featuring minibars. Complimentary wireless internet access is available to keep you connected. Bathrooms feature showers, complimentary toiletries, and slippers. Conveniences include desks and complimentary bottled water, and housekeeping is provided daily.When you stay at Lumbini Heritage Home in Lalitpur, you\'ll be in the historical district, within a 10-minute drive of Durbar Marg and Pashupatinath Temple. This hotel is 4.6 mi (7.4 km) from Boudhanath and 0.1 mi (0.2 km) from Golden Temple (Hiranya Varna Mahaa Vihar).', '202001291420137598-0300bf51_z.jpg', 3),
(3, 'Hotel Thamel House ', 'thamelhotel@gmail.com', 'Thamel, Kathmandu', '9876543287', 'Take in the views from a terrace and a garden and make use of amenities such as complimentary wireless internet access. Additional amenities at this hotel include tour/ticket assistance and a banquet hall.Enjoy a meal at the restaurant or snacks in the coffee shop/cafe. The hotel also offers room service (during limited hours). Wrap up your day with a drink at the bar/lounge.Featured amenities include express check-in, express check-out, and complimentary newspapers in the lobby. A roundtrip airport shuttle is provided for a surcharge (available 24 hours), and free self parking is available onsite.Make yourself at home in one of the 21 guestrooms featuring minibars and LED televisions. Complimentary wireless internet access keeps you connected, and satellite programming is available for your entertainment. Bathrooms feature showers, complimentary toiletries, and slippers. Conveniences include desks and electric kettles, and housekeeping is provided daily.With a stay at Hotel Thamel House in Kathmandu (Thamel), you\'ll be a 1-minute drive from Durbar Marg and 6 minutes from Pashupatinath Temple. This upscale hotel is 3.6 mi (5.8 km) from Boudhanath and 0.2 mi (0.3 km) from Temples of the Elements.', '202001291420137598-0300bf51_z.jpg', 3),
(4, 'Hotel Thamel House ', 'thamelhotel@gmail.com', 'Thamel, Kathmandu', '9876543287', 'Take in the views from a terrace and a garden and make use of amenities such as complimentary wireless internet access. Additional amenities at this hotel include tour/ticket assistance and a banquet hall.Enjoy a meal at the restaurant or snacks in the coffee shop/cafe. The hotel also offers room service (during limited hours). Wrap up your day with a drink at the bar/lounge.Featured amenities include express check-in, express check-out, and complimentary newspapers in the lobby. A roundtrip airport shuttle is provided for a surcharge (available 24 hours), and free self parking is available onsite.Make yourself at home in one of the 21 guestrooms featuring minibars and LED televisions. Complimentary wireless internet access keeps you connected, and satellite programming is available for your entertainment. Bathrooms feature showers, complimentary toiletries, and slippers. Conveniences include desks and electric kettles, and housekeeping is provided daily.With a stay at Hotel Thamel House in Kathmandu (Thamel), you\'ll be a 1-minute drive from Durbar Marg and 6 minutes from Pashupatinath Temple. This upscale hotel is 3.6 mi (5.8 km) from Boudhanath and 0.2 mi (0.3 km) from Temples of the Elements.', '202001291420137598-0300bf51_z.jpg', 3),
(9, 'Kathmandu Eco Hotel', 'bshal@gmail.com', 'Lalitpur, Kathmandu', '9808001077', 'fdyseruytifgoihjnbv kiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiie53sdddddddtygcbgh', '202001291420137598-854f041d_z.jpg', 5),
(10, 'Kathmandu Eco Hotel', 'bshal@gmail.com', 'Lalitpur, Kathmandu', '9808001077', 'fdyseruytifgoihjnbv kiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiie53sdddddddtygcbgh', '202001291420137598-854f041d_z.jpg', 5),
(11, 'Kathmandu Eco Hotel', 'bshal@gmail.com', 'Lalitpur, Kathmandu', '9808001077', 'fdyseruytifgoihjnbv kiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiie53sdddddddtygcbgh', '202001291420137598-854f041d_z.jpg', 5),
(12, 'Lumbini Heritage Home', 'ecokathmandu@gmail.com', 'Thamel, Kathmandu', '9876543287', 'aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaajjjjjjjjjjjjjjjjjjjjjjjjjjjjjjtggggrdcf oubjm', '202001291420137598-ceb918ff_z.jpg', 5),
(13, 'Lumbini Heritage Home', 'ecokathmandu@gmail.com', 'Thamel, Kathmandu', '9876543287', 'aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaajjjjjjjjjjjjjjjjjjjjjjjjjjjjjjtggggrdcf oubjm', '202001291420137598-ceb918ff_z.jpg', 5),
(14, 'Lumbini Heritage Home', 'ecokathmandu@gmail.com', 'Thamel, Kathmandu', '9876543287', 'aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaajjjjjjjjjjjjjjjjjjjjjjjjjjjjjjtggggrdcf oubjm', '202001291420137598-ceb918ff_z.jpg', 5),
(15, 'Lumbini Heritage Home', 'ecokathmandu@gmail.com', 'Thamel, Kathmandu', '9876543287', 'aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaajjjjjjjjjjjjjjjjjjjjjjjjjjjjjjtggggrdcf oubjm', '202001291420137598-ceb918ff_z.jpg', 5),
(16, 'Lumbini Heritage Home', 'ecokathmandu@gmail.com', 'Thamel, Kathmandu', '9876543287', 'aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaajjjjjjjjjjjjjjjjjjjjjjjjjjjjjjtggggrdcf oubjm', '202001291420137598-ceb918ff_z.jpg', 5),
(17, 'Ujjwal Hotel', 'thamelhotel@gmail.com', 'Balkhu', '9876543210', 'love you baby', '202001291420137598-0300bf51_z.jpg', 5),
(18, 'Ujjwal Hotel', 'thamelhotel@gmail.com', 'Balkhu', '9876543210', 'love you baby', '202001291420137598-0300bf51_z.jpg', 5),
(19, 'Ujjwal Hotel', 'heritagelumbini@gmail.com', 'Thamel, Kathmandu', '9876543210', 'MIssinh uhi ncus hnxjhdbchujd', '202001291420137598-0300bf51_z.jpg', 4),
(20, 'Ujjwal Hotel', 'heritagelumbini@gmail.com', 'Thamel, Kathmandu', '9876543210', 'MIssinh uhi ncus hnxjhdbchujd', '202001291420137598-0300bf51_z.jpg', 4),
(21, 'Ujjwal Hotel', 'heritagelumbini@gmail.com', 'Thamel, Kathmandu', '9876543210', 'MIssinh uhi ncus hnxjhdbchujd', '202001291420137598-0300bf51_z.jpg', 4),
(22, 'qnushuhed', 'ecokathmandu@gmail.com', 'kalimati', '9876543287', 'cwdc', '202001291420137598-7c7a8b2a_z.jpg', 5),
(23, 'qnushuhed', 'ecokathmandu@gmail.com', 'kalimati', '9876543287', 'cwdc', '202001291420137598-7c7a8b2a_z.jpg', 5),
(24, 'Kathmandu Eco Hotel', 'ecokathmandu@gmail.com', 'Thamel, Kathmandu', '9876543287', 'ynutgfxyuyzhbxuybnhiur', '202001291420137598-7ca68fcb_z.jpg', 3),
(25, 'Alisha Hotel', 'heritagelumbini@gmail.com', 'Balkhu', '9808001077', 'ahbcuig bnurch8minehmox', '202001291420137598-8ee31a48_z.jpg', 5),
(26, 'Lumbini Heritage Home', 'ecokathmandu@gmail.com', 'Lalitpur, Kathmandu', '9876543210', 'vse5yrbfnbnbfvdvdtfbyngugybfvcbvnmunbcuvbvnmnovbicgvhbj', '202001291420137598-7ca68fcb_z.jpg', 3),
(27, 'Kathmandu Eco Hotel', 'bshal@gmail.com', 'Lalitpur, Kathmandu', '9876543287', 'hvntyung,', '202001291420137598-7ca68fcb_z.jpg', 3),
(28, 'Bishal Hotel', 'ecokathmandu@gmail.com', 'kalimati', '9808001077', 'eiu hcboruhmbpo ercbx', '202001291420137598-7c7a8b2a_z.jpg', 2),
(29, 'Ujjwal Hotel', 'bshal@gmail.com', 'Thamel, Kathmandu', '9876543287', 'fduryfugigyfgxdgyuhcfhuijugvf', '202001291420137598-5c466a27_z.jpg', 3),
(30, 'Lumbini Heritage Home', 'heritagelumbini@gmail.com', 'kalimati', '9876543287', 'ebw ocu iygvcgi b', '202001291420137598-7c7a8b2a_z.jpg', 2);

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
(1, 'keh-img16.jpg', '2024-05-01 08:39:09'),
(29, '202001291420137598-0300bf51_z(1)_6636553075f91.jpg', '2024-05-04 15:33:04'),
(29, '202001291420137598-0300bf51_z_663655307c3d1.jpg', '2024-05-04 15:33:04'),
(29, '202001291420137598-854f041d_z_66365530803f0.jpg', '2024-05-04 15:33:04'),
(29, '202001291420137598-5364dd30_z_6636553082fca.jpg', '2024-05-04 15:33:04'),
(29, '202001291420137598-8289cc00_z_6636553085c72.jpg', '2024-05-04 15:33:04'),
(29, '202001291420137598-9378db2a_z_6636553087fe7.jpg', '2024-05-04 15:33:04'),
(29, '202001291420137598-989365be_z_663655308a5fb.jpg', '2024-05-04 15:33:04'),
(29, '202001291420137598-03060287_z_663655308cb34.jpg', '2024-05-04 15:33:04'),
(29, '202001291420137598-b0da6302_z_663655308ec89.jpg', '2024-05-04 15:33:04'),
(29, '202001291420137598-bb63ed03_z_6636553090d15.jpg', '2024-05-04 15:33:04'),
(29, '202001291420137598-be72455e_z_6636553092e96.jpg', '2024-05-04 15:33:04'),
(30, '202001291420137598-5a90d6b2_z_663655f19900a.jpg', '2024-05-04 15:36:17'),
(30, '202001291420137598-5c466a27_z_663655f19b705.jpg', '2024-05-04 15:36:17'),
(30, '202001291420137598-7c7a8b2a_z_663655f19d835.jpg', '2024-05-04 15:36:17'),
(30, '202001291420137598-7ca68fcb_z_663655f1a009c.jpg', '2024-05-04 15:36:17'),
(30, '202001291420137598-8ee31a48_z_663655f1a2273.jpg', '2024-05-04 15:36:17'),
(30, '202001291420137598-9f7dafcb_z(1)_663655f1a5575.jpg', '2024-05-04 15:36:17'),
(30, '202001291420137598-9f7dafcb_z_663655f1a7efe.jpg', '2024-05-04 15:36:17'),
(30, '202001291420137598-10e6ec3b_z_663655f1a9fb9.jpg', '2024-05-04 15:36:17'),
(30, '202001291420137598-78a19340_z(1)_663655f1ac433.jpg', '2024-05-04 15:36:17'),
(30, '202001291420137598-78a19340_z_663655f1ae4a5.jpg', '2024-05-04 15:36:17'),
(30, '202001291420137598-80ce573b_z_663655f1b0a38.jpg', '2024-05-04 15:36:17'),
(30, '202001291420137598-0300bf51_z(1)_663655f1b3528.jpg', '2024-05-04 15:36:17'),
(30, '202001291420137598-2b4e6aaf_z_6636567a7b213.jpg', '2024-05-04 15:38:34'),
(30, '202001291420137598-2edc9528_z_6636567a7d5a3.jpg', '2024-05-04 15:38:34'),
(30, '202001291420137598-5a90d6b2_z_6636567a7f4eb.jpg', '2024-05-04 15:38:34');

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
  `payment_method` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `hotel_id` int DEFAULT NULL,
  `booking_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `reservation_status` enum('confirmed','pending','cancelled') COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'pending',
  `email` varchar(255) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `reservations`
--

INSERT INTO `reservations` (`reservation_id`, `guest_name`, `guests_num`, `contact_information`, `check_in_date`, `check_out_date`, `room_number`, `room_type`, `bed_type`, `total_price`, `payment_method`, `hotel_id`, `booking_date`, `reservation_status`, `email`) VALUES
(1, 'Anusha Shrestha', 3, '9805872143', '2024-05-16', '2024-05-18', '2', 'luxury', 'double', 100.00, 'online', 1, '2024-05-01 14:55:19', 'cancelled', 'yanusashrestha@gmail.com'),
(2, 'Alisha Shrestha', 1, '9824718989', '2024-05-01', '2024-05-04', '1', 'luxury', 'single', 150.00, 'cash', 1, '2024-05-01 15:02:51', 'confirmed', 'sthaalisha61@gmail.com'),
(3, 'Anusha Shrestha', 1, '9805872143', '2024-05-09', '2024-05-12', '1', 'luxury', 'double', 150.00, 'cash', 1, '2024-05-01 16:35:20', 'confirmed', 'yanusashrestha@gmail.com'),
(4, 'Sumina Rokaha', 2, '987654321', '2024-05-04', '2024-05-07', '1', 'king', 'triple', 240.00, 'online', 1, '2024-05-02 02:49:11', 'confirmed', 'sumu@gmail.com'),
(5, 'Ujjwal Shrestha', 1, '9803428166', '2024-05-03', '2024-05-06', '1', 'king', 'triple', 240.00, 'online', 1, '2024-05-02 16:13:48', 'pending', 'ujjwal@gmail.com'),
(6, 'Anusha Shrestha', 3, '9805872143', '2024-05-05', '2024-05-09', '3', 'normal', 'double', 160.00, 'cash', 1, '2024-05-04 19:46:13', 'pending', 'yanusashrestha@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `rooms`
--

CREATE TABLE `rooms` (
  `room_id` int NOT NULL,
  `hotel_id` int NOT NULL,
  `room_type` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `quantity` int NOT NULL,
  `Price` decimal(10,2) NOT NULL,
  `availability` enum('available','booked','not in service') COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'available'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `rooms`
--

INSERT INTO `rooms` (`room_id`, `hotel_id`, `room_type`, `quantity`, `Price`, `availability`) VALUES
(1, 1, 'normal', 101, 40.00, 'booked'),
(2, 1, 'luxury', 102, 50.00, 'booked'),
(3, 1, 'king', 302, 80.00, 'booked'),
(4, 2, 'deluxe', 101, 50.00, 'available'),
(5, 4, 'luxury', 102, 90.00, 'available'),
(6, 16, 'unknown', 101, 0.00, 'available'),
(7, 16, 'unknown', 102, 0.00, 'available'),
(8, 16, 'unknown', 103, 0.00, 'available'),
(9, 16, 'unknown', 201, 0.00, 'available'),
(10, 16, 'unknown', 202, 0.00, 'available'),
(11, 17, 'unknown', 402, 0.00, 'available'),
(12, 17, 'unknown', 403, 0.00, 'available'),
(13, 24, 'luxury', 10, 40.00, 'available'),
(14, 25, 'deluxe', 20, 20.00, 'available'),
(15, 25, 'king', 10, 50.00, 'available'),
(16, 26, 'deluxe', 10, 50.00, 'available'),
(17, 26, 'luxury', 60, 40.00, 'available'),
(18, 27, 'luxury', 20, 10.00, 'available'),
(19, 28, 'luxury', 20, 30.00, 'available'),
(20, 29, 'deluxe', 10, 28.00, 'available'),
(21, 30, 'luxury', 10, 20.00, 'available');

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
(1, 'Room Service'),
(2, 'Housekeeping'),
(2, 'Free Wi-Fi'),
(2, 'Vehicle Rentals'),
(2, 'Outdoor Sports'),
(4, 'Restaurant'),
(4, 'Vehicle Rentals'),
(4, 'Kids\' Meals'),
(4, 'Air Conditioning'),
(8, 'free wifi'),
(16, 'free wifi'),
(16, 'Restaurant'),
(17, 'Huggs'),
(17, 'Kisses'),
(19, 'Free Wifi'),
(19, 'Huggs'),
(24, 'Housekeeping'),
(24, 'Free Wifi'),
(25, 'Free Wifi'),
(26, 'Free Wifi'),
(27, 'Restaurant'),
(28, 'free wifi'),
(28, 'Restaurant'),
(29, 'Free Wifi'),
(30, 'Restaurant');

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
  `images` blob
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `fullname`, `email`, `password`, `phone`, `images`) VALUES
(1, 'Anusha Shrestha', 'yanusashrestha@gmail.com', '$2y$10$hhJLR/ciong1uldGafOwB.Gu72wZXFRcOqZdTDA9Y4sEYxajjjqUm', '9805872143', NULL),
(2, 'Alisha Shrestha', 'sthaalisha61@gmail.com', '$2y$10$Wj48gcOmKUm6SSRHJYOx8eAu5wBSZttOjwzNpkRSJt4v6CxnOeF7e', '9824718989', NULL),
(3, 'Sumina Rokaha', 'sumu@gmail.com', '$2y$10$DA7Xk5oTD8qZ0ZULHWK9teU8VcFUSyvXxL1xshqBidp.greCvyJvO', '987654321', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`admin_id`),
  ADD UNIQUE KEY `email` (`email`);

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
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `admin_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `hotels`
--
ALTER TABLE `hotels`
  MODIFY `hotel_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `reservations`
--
ALTER TABLE `reservations`
  MODIFY `reservation_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `rooms`
--
ALTER TABLE `rooms`
  MODIFY `room_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

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
