-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Apr 22, 2022 at 04:15 AM
-- Server version: 8.0.28-0ubuntu0.20.04.3
-- PHP Version: 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `internPJ4_ecom`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `description`, `created_at`, `updated_at`) VALUES
(1, 'shoe', 'shoe', '2022-02-11 14:57:45', '2022-02-11 14:58:14'),
(2, 'top', 'top\r\n', NULL, '2022-02-11 15:25:44'),
(11, 'bottom', 'bottom', '2022-02-11 00:00:00', '2022-02-11 20:41:15'),
(12, 'coat', 'coat', '2022-02-14 00:00:00', '2022-02-14 19:39:36');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `category_id` int NOT NULL,
  `tag_id` int NOT NULL,
  `quantity` int NOT NULL,
  `price` int NOT NULL,
  `image` text NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `description`, `category_id`, `tag_id`, `quantity`, `price`, `image`, `created_at`, `updated_at`) VALUES
(1, 'Air Jordan High-1 Grey', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum', 1, 1, 20, 403, 'jd_grey.png', '2022-02-15 00:00:00', '2022-02-15 11:57:12'),
(3, 'Versace Medusa Logo T-Shirt for Men', 'versace versace versaceLorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum', 2, 1, 16, 68, 'versaceShirt.jpg', '2022-02-15 00:00:00', '2022-02-15 16:07:58'),
(4, 'Summer Legend Pant', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum', 11, 1, 10, 93, 'Summer_Legend_Pants_Black.jpg', '2022-02-15 00:00:00', '2022-02-15 16:12:31'),
(5, 'Louis Vuitton Salt Print Bomber Jacket', 'Louis Vuitton\r\nSalt Print Bomber JacketLorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum', 12, 1, 64, 3700, 'LVCoat.jpg', '2022-02-18 00:00:00', '2022-02-18 12:56:20'),
(6, 'Air Jordan 1 High OG “Brotherhood”', 'Air Jordan 1 High OG “Brotherhood”Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum', 1, 1, 29, 150, 'jordan1HighOGBrotherhood.jpg', '2022-02-18 00:00:00', '2022-02-18 13:06:52'),
(7, 'Air Jordan 4 “Zen Master”', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum', 1, 1, 48, 225, 'jordan4ZenMaster.jpg', '2022-02-18 00:00:00', '2022-02-18 13:08:17'),
(8, 'Jordan Animal Instinct Pant', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum', 11, 1, 26, 190, 'jordanAnimalPant.jpg', '2022-02-18 00:00:00', '2022-02-18 13:11:34'),
(9, 'LV striped track pants', 'A timeless pair of track pants refreshed in a crisp seasonal colorway. Cut from technical jersey that sets a sporty tone with contrasting racer stripes running down the sides, complemented by graphic functional finishes. Complete with an easy elasticated drawstring waistband and a tonal LV Circle patch for a subtle signature touch.', 11, 1, 27, 188, 'lvstripedPant.jpg', '2022-02-18 00:00:00', '2022-02-18 13:13:23'),
(16, 'Air Jordan High-1 Black & White', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum', 1, 1, 61, 354, 'aj_b&w.jpg', '2022-04-15 12:05:48', '2022-04-15 12:05:48'),
(17, 'Dior Skirt', '\"Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.\"\r\n\r\n', 11, 2, 61, 75, 'dior_skirt.jpeg', '2022-04-15 21:15:38', '2022-04-15 21:15:38'),
(22, 'Addidas Kid Classic White', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec sit amet ligula lectus. Phasellus sagittis risus eu cursus lacinia. Proin lobortis nec diam vel pretium. Integer ac eleifend metus, eu malesuada nunc. Nullam ac mi nec justo egestas congue et in nisl. Donec eleifend orci sit amet dui finibus elementum. Proin eu consectetur lacus, in tempor leo. Pellentesque vitae elit feugiat, vulputate orci quis, consectetur tortor. Ut eu leo nec sapien tristique sagittis. Cras mollis nibh sed ex sagittis, ut imperdiet urna gravida.', 1, 3, 9, 56, 'kid_ad_shoe.jpeg', '2022-04-16 14:56:08', '2022-04-16 14:56:08'),
(23, 'Addidas Kid Classic Black', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec sit amet ligula lectus. Phasellus sagittis risus eu cursus lacinia. Proin lobortis nec diam vel pretium. Integer ac eleifend metus, eu malesuada nunc. Nullam ac mi nec justo egestas congue et in nisl. Donec eleifend orci sit amet dui finibus elementum. Proin eu consectetur lacus, in tempor leo. Pellentesque vitae elit feugiat, vulputate orci quis, consectetur tortor. Ut eu leo nec sapien tristique sagittis. Cras mollis nibh sed ex sagittis, ut imperdiet urna gravida.', 1, 3, 15, 57, 'adshoe_kid_black.jpeg', '2022-04-16 14:59:11', '2022-04-16 14:59:11'),
(25, 'Addidas Kid Classic Pink', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec sit amet ligula lectus. Phasellus sagittis risus eu cursus lacinia. Proin lobortis nec diam vel pretium. Integer ac eleifend metus, eu malesuada nunc. Nullam ac mi nec justo egestas congue et in nisl. Donec eleifend orci sit amet dui finibus elementum. Proin eu consectetur lacus, in tempor leo. Pellentesque vitae elit feugiat, vulputate orci quis, consectetur tortor. Ut eu leo nec sapien tristique sagittis. Cras mollis nibh sed ex sagittis, ut imperdiet urna gravida.', 1, 3, 77, 45, 'adshoe_girl_kid_pink.jpg', '2022-04-16 15:02:08', '2022-04-16 15:02:08'),
(26, 'Nike Air Jordan 1 High Zoom Blue & Grey', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer molestie erat ante, ut vestibulum dui porttitor congue. Praesent fringilla non nisl a ultrices. Sed ut commodo ante, et laoreet lacus. Aliquam molestie nisi vulputate mauris congue, quis pharetra sapien suscipit. Donec rutrum augue nec purus rhoncus, quis varius lectus rutrum. Mauris finibus faucibus enim ac finibus. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Sed dictum mi sed egestas dapibus. Donec eu facilisis felis. Curabitur bibendum sem nec nisl tristique, eget hendrerit erat tristique. Phasellus ut viverra justo. Sed venenatis tellus justo, eu vestibulum leo commodo id. Vestibulum varius eu nisi id maximus. Nam dignissim malesuada justo, eu tempor lectus rutrum id. Phasellus convallis, risus a scelerisque vulputate, enim sapien tincidunt arcu, in luctus elit mi vel nulla.', 1, 1, 92, 1200, 'https___hypebeast.com_wp-content_blogs.dir_6_files_2020_03_nike-air-jordan-1-hi-zoom-sneakers-white-baby-blue-grey-release-date-0.jpg', '2022-04-16 21:07:11', '2022-04-16 21:07:11'),
(27, 'Winter Toddle Long Sleeve Girl', 'y. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Le', 2, 3, 41, 43, '61LVvVBG3wL._AC_UX385_.jpg', '2022-04-22 00:28:53', '2022-04-22 00:28:53'),
(28, 'Desigual VEST KEROWAC Black Long Sleeve Dress Size EUR 38 UK 10 US 4', 'n an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently wi', 2, 2, 54, 44, 's-l400.jpg', '2022-04-22 00:33:37', '2022-04-22 00:33:37'),
(29, 'LV lady bag', 'orem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unc', 2, 2, 6, 3080, 'lvbag.jpg', '2022-04-22 10:31:20', '2022-04-22 10:31:20'),
(30, 'LV Coat Lady', 'lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unc', 12, 2, 21, 5400, 'lvcoat.jpg', '2022-04-22 10:32:33', '2022-04-22 10:32:33'),
(31, 'Gucci Lady White Dress', 'orem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unc', 2, 2, 13, 79, 'gucciladydress.jpg', '2022-04-22 10:34:22', '2022-04-22 10:34:22');

-- --------------------------------------------------------

--
-- Table structure for table `product_sizes`
--

CREATE TABLE `product_sizes` (
  `id` int NOT NULL,
  `product_id` int NOT NULL,
  `size_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product_sizes`
--

INSERT INTO `product_sizes` (`id`, `product_id`, `size_id`) VALUES
(7, 19, 1),
(8, 19, 2),
(9, 20, 2),
(10, 20, 3),
(11, 21, 2),
(12, 21, 4),
(22, 9, 2),
(23, 9, 3),
(24, 8, 1),
(25, 8, 2),
(26, 8, 3),
(27, 7, 2),
(28, 7, 3),
(29, 6, 1),
(30, 6, 2),
(31, 6, 3),
(32, 6, 4),
(40, 4, 1),
(41, 4, 3),
(42, 4, 4),
(43, 3, 1),
(44, 3, 2),
(47, 22, 1),
(48, 23, 1),
(49, 24, 3),
(52, 51, 3),
(53, 52, 4),
(54, 1, 2),
(55, 1, 3),
(73, 25, 1),
(74, 26, 2),
(75, 16, 2),
(76, 16, 3),
(77, 16, 4),
(78, 17, 1),
(79, 17, 2),
(80, 17, 3),
(81, 17, 4),
(82, 5, 1),
(83, 5, 2),
(84, 5, 3),
(85, 5, 4),
(86, 27, 1),
(87, 86, 2),
(88, 28, 2),
(89, 88, 3),
(90, 29, 2),
(91, 30, 2),
(92, 91, 3),
(93, 31, 1),
(94, 93, 2);

-- --------------------------------------------------------

--
-- Table structure for table `sale_orders`
--

CREATE TABLE `sale_orders` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `total_price` int NOT NULL,
  `order_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `sale_orders`
--

INSERT INTO `sale_orders` (`id`, `user_id`, `total_price`, `order_date`) VALUES
(5, 5, 1174, '2022-02-19 17:17:32'),
(6, 5, 1035, '2022-02-01 17:20:07'),
(7, 5, 1035, '2022-02-19 17:21:16'),
(9, 6, 1186, '2022-02-19 17:49:30'),
(11, 5, 190, '2022-01-20 06:32:15'),
(12, 5, 1035, '2022-03-15 15:12:49'),
(13, 11, 550, '2022-04-09 17:31:59'),
(19, 16, 2655, '2022-04-21 17:02:28'),
(20, 11, 7400, '2022-04-21 17:09:47'),
(21, 11, 1257, '2022-04-21 17:11:44'),
(22, 11, 1257, '2022-04-21 17:12:14'),
(23, 11, 1257, '2022-04-21 17:12:33'),
(24, 11, 619, '2022-04-21 17:13:31'),
(25, 11, 280, '2022-04-21 17:15:42'),
(26, 11, 1275, '2022-04-21 17:17:19'),
(27, 11, 1425, '2022-04-21 17:19:14'),
(28, 15, 3462, '2022-04-21 17:22:07'),
(29, 15, 469, '2022-04-21 17:26:07'),
(30, 15, 225, '2022-04-21 17:28:41'),
(31, 15, 43, '2022-04-21 17:59:51'),
(32, 17, 1779, '2022-04-22 03:35:49'),
(33, 17, 708, '2022-04-22 03:39:09'),
(34, 17, 7443, '2022-04-22 03:46:33'),
(35, 18, 1580, '2022-04-22 03:52:44');

-- --------------------------------------------------------

--
-- Table structure for table `sale_order_detail`
--

CREATE TABLE `sale_order_detail` (
  `id` int NOT NULL,
  `sale_order_id` int NOT NULL,
  `product_id` int NOT NULL,
  `quantity` int NOT NULL,
  `order_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `sale_order_detail`
--

INSERT INTO `sale_order_detail` (`id`, `sale_order_id`, `product_id`, `quantity`, `order_date`) VALUES
(6, 5, 8, 1, '2022-02-19 17:17:32'),
(7, 5, 7, 2, '2022-02-19 17:17:32'),
(8, 5, 9, 3, '2022-02-19 17:17:32'),
(9, 6, 1, 3, '2022-02-19 17:20:07'),
(10, 7, 1, 3, '2022-02-19 17:21:16'),
(14, 9, 8, 2, '2022-02-19 17:49:30'),
(15, 9, 3, 3, '2022-02-19 17:49:30'),
(16, 9, 6, 1, '2022-02-19 17:49:30'),
(18, 11, 8, 1, '2022-02-20 06:32:15'),
(19, 12, 1, 3, '2022-03-15 15:12:49'),
(20, 13, 8, 2, '2022-04-09 17:31:59'),
(21, 13, 6, 1, '2022-04-09 17:31:59'),
(34, 19, 25, 4, '2022-04-21 17:02:28'),
(35, 19, 26, 2, '2022-04-21 17:02:28'),
(36, 19, 17, 1, '2022-04-21 17:02:28'),
(37, 20, 5, 2, '2022-04-21 17:09:47'),
(38, 21, 26, 1, '2022-04-21 17:11:44'),
(39, 22, 26, 1, '2022-04-21 17:12:14'),
(40, 23, 26, 1, '2022-04-21 17:12:33'),
(41, 24, 17, 1, '2022-04-21 17:13:31'),
(42, 24, 16, 1, '2022-04-21 17:13:31'),
(43, 24, 8, 1, '2022-04-21 17:13:31'),
(44, 25, 22, 5, '2022-04-21 17:15:42'),
(45, 26, 17, 1, '2022-04-21 17:17:19'),
(46, 26, 26, 1, '2022-04-21 17:17:19'),
(47, 27, 7, 1, '2022-04-21 17:19:14'),
(48, 27, 26, 1, '2022-04-21 17:19:14'),
(49, 28, 16, 3, '2022-04-21 17:22:07'),
(50, 28, 26, 2, '2022-04-21 17:22:07'),
(51, 29, 9, 2, '2022-04-21 17:26:07'),
(52, 29, 4, 1, '2022-04-21 17:26:07'),
(53, 30, 7, 1, '2022-04-21 17:28:41'),
(54, 31, 27, 1, '2022-04-21 17:59:51'),
(55, 32, 26, 1, '2022-04-22 03:35:49'),
(56, 32, 16, 1, '2022-04-22 03:35:49'),
(57, 32, 17, 3, '2022-04-22 03:35:49'),
(58, 33, 16, 2, '2022-04-22 03:39:09'),
(59, 34, 5, 2, '2022-04-22 03:46:33'),
(60, 34, 27, 1, '2022-04-22 03:46:33'),
(61, 35, 4, 1, '2022-04-22 03:52:44'),
(62, 35, 26, 1, '2022-04-22 03:52:44'),
(63, 35, 22, 1, '2022-04-22 03:52:44'),
(64, 35, 27, 1, '2022-04-22 03:52:44'),
(65, 35, 9, 1, '2022-04-22 03:52:44');

-- --------------------------------------------------------

--
-- Table structure for table `sizes`
--

CREATE TABLE `sizes` (
  `id` int NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `description` text COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sizes`
--

INSERT INTO `sizes` (`id`, `name`, `description`, `created_at`) VALUES
(1, 'sm', 'small size', '2022-04-15 14:52:51'),
(2, 'md', 'medium size', '2022-04-15 14:52:51'),
(3, 'lg', 'large size', '2022-04-15 14:53:52'),
(4, 'xl', 'extra large size', '2022-04-15 14:53:52');

-- --------------------------------------------------------

--
-- Table structure for table `tags`
--

CREATE TABLE `tags` (
  `id` int NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `description` text COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tags`
--

INSERT INTO `tags` (`id`, `name`, `description`, `created_at`) VALUES
(1, 'Man', 'Products for men.', '2022-04-14 03:31:25'),
(2, 'Woman', 'Products for women.', '2022-04-14 03:32:10'),
(3, 'Kid', 'Products for kids.', '2022-04-14 03:32:30');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `phone` varchar(100) NOT NULL,
  `address` text NOT NULL,
  `role` tinyint(1) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `phone`, `address`, `role`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'admin@gmail.com', '$2y$10$33aBXTWZmKmnJUsks2K9JedRqQR8bqxPqzRxLnLFPR0hhdaKJJAra', '09343425242', 'Yangon', 1, '2022-02-11 08:56:58', '2022-02-11 14:27:50'),
(5, 'Sana', 'sana@gmail.com', '$2y$10$yh.WPYgQEe5xOQMtVun7Juvk.N7.MotTvJ4Htrv./7v72OKE.P9hW', '09123456783', 'Osaka, Japan ', 0, '0000-00-00 00:00:00', '2022-02-11 20:15:28'),
(6, 'Momo', 'momo@gmail.com', '$2y$10$tGi6DE8NR0P.e2NfJLGI3.LWalcicdot4lBfphtCnTgvw.uiG4jYe', '02-343865325', 'Kyoto, Japan', 0, '0000-00-00 00:00:00', '2022-02-11 20:16:49'),
(11, 'Mg Mg', 'mgmg@gmail.com', '$2y$10$ElNMbYN3u9Q8r9F8k1ud0efiZgM/4KihCHA/0/gRgwlgR5944ixGa', '02-343865325', 'Yangon', 0, '2022-02-17 00:00:00', '2022-02-17 18:25:28'),
(15, 'Aung Aung', 'aung@gmail.com', '$2y$10$RKHXPgrlMQCM0J4A59ljeObflMfDKrQb7RDfj12g0ork7nf1bkZsu', '09123456789', 'Thingyan Gyun', 0, '2022-04-18 11:11:04', '2022-04-18 11:11:04'),
(16, 'Su Su', 'susu@gmail.com', '$2y$10$uU6U.3Cr5ffHAGrQ3na74uClUy4x1c7APF1mCmC/JGwBDxIO.73s2', '02-343865325', 'Taunggyi , Shan', 0, '2022-04-18 11:13:18', '2022-04-18 11:13:18'),
(17, 'test', 'test@gmail.com', '$2y$10$6kA2WnVHSl.7DtxbLFAzl.yV/j9Oz0c/2NwAkEyawyZF9PDyaASd2', '0212345678', 'usa', 0, '2022-04-21 18:25:28', '2022-04-21 18:25:28'),
(18, 'Kyaw Gyi', 'kg@gmail.com', '$2y$10$Ppf9iTNVfHhO0c.S1lX7buaV8hyUw.O0/U/ObmU43n9ynLldmdWbC', '09099999999', 'Taunggyi', 0, '2022-04-22 10:19:16', '2022-04-22 10:19:16');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `products_category_relation` (`category_id`),
  ADD KEY `products_tag_relation` (`tag_id`);

--
-- Indexes for table `product_sizes`
--
ALTER TABLE `product_sizes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sale_orders`
--
ALTER TABLE `sale_orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `orders_customer_relation` (`user_id`);

--
-- Indexes for table `sale_order_detail`
--
ALTER TABLE `sale_order_detail`
  ADD PRIMARY KEY (`id`),
  ADD KEY `orderDetails_orders_relation` (`sale_order_id`);

--
-- Indexes for table `sizes`
--
ALTER TABLE `sizes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tags`
--
ALTER TABLE `tags`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `product_sizes`
--
ALTER TABLE `product_sizes`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=95;

--
-- AUTO_INCREMENT for table `sale_orders`
--
ALTER TABLE `sale_orders`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `sale_order_detail`
--
ALTER TABLE `sale_order_detail`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=66;

--
-- AUTO_INCREMENT for table `sizes`
--
ALTER TABLE `sizes`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tags`
--
ALTER TABLE `tags`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_category_relation` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `products_tag_relation` FOREIGN KEY (`tag_id`) REFERENCES `tags` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `sale_orders`
--
ALTER TABLE `sale_orders`
  ADD CONSTRAINT `orders_customer_relation` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `sale_order_detail`
--
ALTER TABLE `sale_order_detail`
  ADD CONSTRAINT `orderDetails_orders_relation` FOREIGN KEY (`sale_order_id`) REFERENCES `sale_orders` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
