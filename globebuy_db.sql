-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 04, 2026 at 08:03 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `globebuy_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `total` decimal(10,2) NOT NULL,
  `status` enum('pending','processing','shipped','delivered') DEFAULT 'pending',
  `shipping_address` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `total`, `status`, `shipping_address`, `created_at`) VALUES
(1, 2, 398000.00, 'delivered', 'rewrwrewr, 12345678', '2026-07-03 16:31:53'),
(2, 2, 199000.00, 'pending', 'jfhgfsg, 081234567807', '2026-07-03 17:10:10'),
(3, 2, 199000.00, 'pending', 'fadsf, 4543', '2026-07-03 17:10:52'),
(4, 2, 398000.00, 'pending', 'esda, 31231', '2026-07-03 17:34:14'),
(5, 2, 550000.00, 'pending', 'aserfaerar, 12345', '2026-07-04 03:48:10'),
(6, 2, 310000.00, 'pending', 'dewea<br><b>Telp:</b> 12345678<br><b>Metode Pembayaran:</b> Transfer Bank VA', '2026-07-04 04:16:52');

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `product_name` varchar(150) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `quantity` int(11) NOT NULL,
  `size` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`id`, `order_id`, `product_name`, `price`, `quantity`, `size`) VALUES
(1, 1, 'Premium Oversized Hoodie', 199000.00, 2, 'S'),
(2, 2, 'Premium Oversized Hoodie', 199000.00, 1, 'S'),
(3, 3, 'Premium Oversized Hoodie', 199000.00, 1, 'S'),
(4, 4, 'Premium Oversized Hoodie', 199000.00, 2, 'S'),
(5, 5, 'Slim Fit Modern Blazer', 550000.00, 1, 'S'),
(6, 6, 'Ribbed Turtleneck Knit', 310000.00, 1, 'L');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `sku` varchar(50) NOT NULL,
  `name` varchar(150) NOT NULL,
  `description` text DEFAULT NULL,
  `category` varchar(50) NOT NULL,
  `image` varchar(255) NOT NULL,
  `bg_class` varchar(50) DEFAULT 'bg-gray-100',
  `price` decimal(10,2) NOT NULL,
  `sizes` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`sizes`)),
  `colors` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`colors`)),
  `badge` varchar(50) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `sku`, `name`, `description`, `category`, `image`, `bg_class`, `price`, `sizes`, `colors`, `badge`, `created_at`) VALUES
(6, 'MEN-001', 'Premium Classic T-Shirt', 'Kaos basic premium berbahan 100% katun bambu yang sangat lembut, anti-bakteri, dan menyerap keringat dengan sempurna.', 'Men Fashion', 'https://images.unsplash.com/photo-1521572163474-6864f9cf17ab?auto=format&fit=crop&w=600&q=80', 'bg-gray-100', 150000.00, '[\"S\", \"M\", \"L\", \"XL\"]', '[{\"name\": \"White\", \"hex\": \"#FFFFFF\"}, {\"name\": \"Black\", \"hex\": \"#000000\"}]', 'Best Seller', '2026-07-03 17:37:05'),
(7, 'MEN-002', 'Slim Fit Chino Pants', 'Celana chino dengan potongan slim fit yang elegan. Material twill stretch membuat Anda bebas bergerak sepanjang hari.', 'Men Fashion', 'uploads/1783137554_Slim Fit Chino Pants.avif', 'bg-gray-100', 320000.00, '[\"M\",\"L\",\"XL\"]', '[{\"name\":\"Khaki\",\"hex\":\"#000000\"},{\"name\":\"Navy\",\"hex\":\"#000000\"}]', NULL, '2026-07-03 17:37:05'),
(8, 'MEN-003', 'Casual Oxford Shirt', 'Kemeja kerah button-down klasik dari kain Oxford. Cocok untuk tampilan smart-casual di kantor maupun akhir pekan.', 'Men Fashion', 'uploads/1783137506_Casual Oxford Shirt.avif', 'bg-gray-100', 250000.00, '[\"S\",\"M\",\"L\"]', '[{\"name\":\"Blue\",\"hex\":\"#000000\"},{\"name\":\"White\",\"hex\":\"#000000\"}]', 'New', '2026-07-03 17:37:05'),
(9, 'MEN-004', 'Knitted Polo Sweater', 'Polo rajut lengan panjang dengan material wool blend. Memberikan kehangatan dengan gaya vintage yang mewah.', 'Men Fashion', 'https://images.unsplash.com/photo-1617137968427-85924c800a22?auto=format&fit=crop&w=600&q=80', 'bg-gray-100', 380000.00, '[\"M\", \"L\", \"XL\"]', '[{\"name\": \"Brown\", \"hex\": \"#8B4513\"}, {\"name\": \"Grey\", \"hex\": \"#808080\"}]', 'Trending', '2026-07-03 17:37:05'),
(10, 'MEN-005', 'Formal Suit Trousers', 'Celana bahan formal dengan lipatan tegak yang sempurna. Dirancang untuk pakaian kantor profesional.', 'Men Fashion', 'uploads/1783137473_Formal Suit Trousers.avif', 'bg-gray-100', 450000.00, '[\"S\",\"M\",\"L\",\"XL\"]', '[{\"name\":\"Black\",\"hex\":\"#000000\"},{\"name\":\"Grey\",\"hex\":\"#000000\"}]', NULL, '2026-07-03 17:37:05'),
(11, 'MEN-006', 'Oversized Graphic Tee', 'Kaos berpotongan oversized dengan cetakan grafis modern art di bagian belakang. Material katun tebal 24s.', 'Men Fashion', 'https://images.unsplash.com/photo-1576566588028-4147f3842f27?auto=format&fit=crop&w=600&q=80', 'bg-gray-100', 185000.00, '[\"M\", \"L\", \"XL\"]', '[{\"name\": \"Black\", \"hex\": \"#000000\"}]', 'Hot', '2026-07-03 17:37:05'),
(12, 'MEN-007', 'Linen Short Sleeve', 'Kemeja lengan pendek berbahan 100% linen alami. Sangat sejuk dan bernapas untuk liburan musim panas Anda.', 'Men Fashion', 'https://images.unsplash.com/photo-1603252109303-2751441dd157?auto=format&fit=crop&w=600&q=80', 'bg-gray-100', 275000.00, '[\"S\", \"M\", \"L\"]', '[{\"name\": \"Beige\", \"hex\": \"#F5F5DC\"}, {\"name\": \"White\", \"hex\": \"#FFFFFF\"}]', NULL, '2026-07-03 17:37:05'),
(13, 'MEN-008', 'Classic Denim Jeans', 'Jeans denim berpotongan lurus (straight fit) dengan pewarnaan wash otentik. Tahan lama dan tak lekang oleh waktu.', 'Men Fashion', 'https://images.unsplash.com/photo-1542272604-787c3835535d?auto=format&fit=crop&w=600&q=80', 'bg-gray-100', 399000.00, '[\"M\", \"L\", \"XL\"]', '[{\"name\": \"Blue Denim\", \"hex\": \"#4682B4\"}]', 'Restock', '2026-07-03 17:37:05'),
(14, 'MEN-009', 'Techwear Cargo Shorts', 'Celana pendek kargo dengan material water-repellent. Dilengkapi banyak kantong untuk utilitas maksimal.', 'Men Fashion', 'https://images.unsplash.com/photo-1591195853828-11db59a44f6b?auto=format&fit=crop&w=600&q=80', 'bg-gray-100', 220000.00, '[\"M\", \"L\"]', '[{\"name\": \"Olive\", \"hex\": \"#556B2F\"}, {\"name\": \"Black\", \"hex\": \"#000000\"}]', NULL, '2026-07-03 17:37:05'),
(15, 'MEN-010', 'Ribbed Turtleneck Knit', 'Turtleneck rajut bertekstur rib yang elastis. Cocok digunakan sebagai layer di bawah jas atau coat Anda.', 'Men Fashion', 'uploads/1783137463_Ribbed Turtleneck Knit.avif', 'bg-gray-100', 310000.00, '[\"S\",\"M\",\"L\"]', '[{\"name\":\"Black\",\"hex\":\"#000000\"},{\"name\":\"Maroon\",\"hex\":\"#000000\"}]', NULL, '2026-07-03 17:37:05'),
(16, 'WMN-001', 'Floral Summer Midi Dress', 'Dress midi motif bunga dengan material viscose yang jatuh dengan indah. Dilengkapi tali pinggang yang bisa disesuaikan.', 'Women Fashion', 'uploads/1783137440_Floral Summer Midi Dress.avif', 'bg-gray-100', 350000.00, '[\"S\",\"M\",\"L\"]', '[{\"name\":\"Red Floral\",\"hex\":\"#000000\"}]', 'Best Seller', '2026-07-03 17:37:05'),
(17, 'WMN-002', 'High Waist Mom Jeans', 'Jeans potongan pinggang tinggi klasik dengan siluet rileks. Sangat nyaman dan mudah dipadukan dengan berbagai atasan.', 'Women Fashion', 'https://images.unsplash.com/photo-1541099649105-f69ad21f3246?auto=format&fit=crop&w=600&q=80', 'bg-gray-100', 280000.00, '[\"27\", \"28\", \"29\", \"30\"]', '[{\"name\": \"Light Blue\", \"hex\": \"#ADD8E6\"}]', NULL, '2026-07-03 17:37:05'),
(18, 'WMN-003', 'Satin Slip Skirt', 'Rok satin sutra berpotongan midi. Memberikan kilau mewah dan jatuh yang elegan menyusuri kaki.', 'Women Fashion', 'uploads/1783137407_Satin Slip Skirt.avif', 'bg-gray-100', 210000.00, '[\"S\",\"M\"]', '[{\"name\":\"Champagne\",\"hex\":\"#000000\"},{\"name\":\"Black\",\"hex\":\"#000000\"}]', 'Trending', '2026-07-03 17:37:05'),
(19, 'WMN-004', 'Elegant Ruffle Blouse', 'Blouse chiffon dengan aksen ruffle di bagian lengan dan leher. Sempurna untuk pakaian kantor yang feminin.', 'Women Fashion', 'https://images.unsplash.com/photo-1551163943-3f6a855d1153?auto=format&fit=crop&w=600&q=80', 'bg-gray-100', 245000.00, '[\"S\", \"M\", \"L\"]', '[{\"name\": \"White\", \"hex\": \"#FFFFFF\"}, {\"name\": \"Dusty Pink\", \"hex\": \"#D8BFD8\"}]', 'New', '2026-07-03 17:37:05'),
(20, 'WMN-005', 'Basic Ribbed Crop Top', 'Atasan crop rajut lengan pendek berbahan elastis. Desain simpel yang menonjolkan lekuk tubuh dengan nyaman.', 'Women Fashion', 'https://images.unsplash.com/photo-1503342217505-b0a15ec3261c?auto=format&fit=crop&w=600&q=80', 'bg-gray-100', 125000.00, '[\"S\", \"M\", \"L\"]', '[{\"name\": \"White\", \"hex\": \"#FFFFFF\"}, {\"name\": \"Black\", \"hex\": \"#000000\"}]', NULL, '2026-07-03 17:37:05'),
(21, 'WMN-006', 'Wide Leg Palazzo Pants', 'Celana panjang super lebar berbahan crinkle flowy. Sangat sejuk dan menutupi lekuk tubuh dengan elegan.', 'Women Fashion', 'https://images.unsplash.com/photo-1509631179647-0177331693ae?auto=format&fit=crop&w=600&q=80', 'bg-gray-100', 290000.00, '[\"M\", \"L\", \"XL\"]', '[{\"name\": \"Beige\", \"hex\": \"#F5F5DC\"}, {\"name\": \"Olive\", \"hex\": \"#556B2F\"}]', NULL, '2026-07-03 17:37:05'),
(22, 'WMN-007', 'V-Neck Silk Camisole', 'Tank top kerah V berbahan sutra lembut dengan tali spaghetti yang dapat disesuaikan. Layer dasar yang sempurna.', 'Women Fashion', 'uploads/1783137354_V-Neck Silk Camisole.avif', 'bg-gray-100', 160000.00, '[\"S\",\"M\",\"L\"]', '[{\"name\":\"Black\",\"hex\":\"#000000\"},{\"name\":\"Silver\",\"hex\":\"#000000\"}]', 'Hot', '2026-07-03 17:37:05'),
(23, 'WMN-008', 'Pleated Midi Skirt', 'Rok plisket berpotongan A-line dengan pinggang karet elastis. Desain klasik yang cocok untuk gaya preppy.', 'Women Fashion', 'https://images.unsplash.com/photo-1582142407894-ec85a1260a46?auto=format&fit=crop&w=600&q=80', 'bg-gray-100', 230000.00, '[\"All Size\"]', '[{\"name\": \"Navy\", \"hex\": \"#000080\"}, {\"name\": \"Camel\", \"hex\": \"#C19A6B\"}]', NULL, '2026-07-03 17:37:05'),
(24, 'WMN-009', 'Oversized Linen Shirt', 'Kemeja wanita potogan kebesaran berbahan rami alami. Bisa dikenakan sebagai atasan atau outer luaran yang chic.', 'Women Fashion', 'https://images.unsplash.com/photo-1598554747436-c9293d6a588f?auto=format&fit=crop&w=600&q=80', 'bg-gray-100', 265000.00, '[\"M\", \"L\"]', '[{\"name\": \"White\", \"hex\": \"#FFFFFF\"}, {\"name\": \"Terracotta\", \"hex\": \"#E2725B\"}]', NULL, '2026-07-03 17:37:05'),
(25, 'WMN-010', 'Knit Bodycon Maxi Dress', 'Dress maksi ketat berbahan rajut premium. Menonjolkan siluet tubuh dengan elegan untuk acara malam.', 'Women Fashion', 'uploads/1783137346_Knit Bodycon Maxi Dress.avif', 'bg-gray-100', 399000.00, '[\"S\",\"M\"]', '[{\"name\":\"Black\",\"hex\":\"#000000\"},{\"name\":\"Wine Red\",\"hex\":\"#000000\"}]', 'Premium', '2026-07-03 17:37:05'),
(26, 'OUT-001', 'Classic British Trench Coat', 'Coat panjang bergaya Inggris klasik berbahan gabardine tahan air. Dilengkapi sabuk pinggang dan detail epaulette bahu.', 'Outerwear', 'https://images.unsplash.com/photo-1591047139829-d91aecb6caea?auto=format&fit=crop&w=600&q=80', 'bg-gray-100', 850000.00, '[\"S\", \"M\", \"L\"]', '[{\"name\": \"Beige\", \"hex\": \"#F5F5DC\"}]', 'Best Seller', '2026-07-03 17:37:05'),
(27, 'OUT-002', 'Vintage Leather Biker Jacket', 'Jaket kulit sintetis premium dengan resleting asimetris khas gaya pengendara motor. Tangguh dan edgy.', 'Outerwear', 'uploads/1783137326_Vintage Leather Biker Jacket.avif', 'bg-gray-100', 650000.00, '[\"M\",\"L\",\"XL\"]', '[{\"name\":\"Black\",\"hex\":\"#000000\"}]', 'Trending', '2026-07-03 17:37:05'),
(28, 'OUT-003', 'Oversized Denim Jacket', 'Jaket jeans berpotongan kebesaran gaya retro tahun 90an. Cocok dilapiskan di atas kaos atau dress.', 'Outerwear', 'https://images.unsplash.com/photo-1576871337632-b9aef4c17ab9?auto=format&fit=crop&w=600&q=80', 'bg-gray-100', 350000.00, '[\"M\", \"L\"]', '[{\"name\": \"Light Blue\", \"hex\": \"#ADD8E6\"}, {\"name\": \"Vintage Wash\", \"hex\": \"#4682B4\"}]', NULL, '2026-07-03 17:37:05'),
(29, 'OUT-004', 'Minimalist Wool Blend Coat', 'Mantel wol campuran tanpa kerah dengan desain lapel minimalis. Sangat hangat untuk musim dingin atau bepergian.', 'Outerwear', 'https://images.unsplash.com/photo-1539533113208-f6df8cc8b543?auto=format&fit=crop&w=600&q=80', 'bg-gray-100', 780000.00, '[\"S\", \"M\", \"L\"]', '[{\"name\": \"Grey\", \"hex\": \"#808080\"}, {\"name\": \"Navy\", \"hex\": \"#000080\"}]', 'Premium', '2026-07-03 17:37:05'),
(30, 'OUT-005', 'Fleece Zip-Up Hoodie', 'Jaket hoodie dengan resleting penuh berbahan polar fleece tebal. Sangat lembut dan cocok untuk bersantai.', 'Outerwear', 'https://images.unsplash.com/photo-1556821840-3a63f95609a7?auto=format&fit=crop&w=600&q=80', 'bg-gray-100', 290000.00, '[\"M\", \"L\", \"XL\"]', '[{\"name\": \"Grey\", \"hex\": \"#D3D3D3\"}, {\"name\": \"Black\", \"hex\": \"#000000\"}]', NULL, '2026-07-03 17:37:05'),
(31, 'OUT-006', 'Varsity Bomber Jacket', 'Jaket bomber dengan bordir varsity otentik dan lengan berbahan kulit sintetis kontras.', 'Outerwear', 'https://images.unsplash.com/photo-1525450824786-227cbef70703?auto=format&fit=crop&w=600&q=80', 'bg-gray-100', 420000.00, '[\"S\", \"M\", \"L\"]', '[{\"name\": \"Green/White\", \"hex\": \"#006400\"}]', 'New', '2026-07-03 17:37:05'),
(32, 'OUT-007', 'Lightweight Windbreaker', 'Jaket penahan angin ultralight dengan tudung lipat. Cocok untuk lari pagi atau cuaca mendung tak menentu.', 'Outerwear', 'https://images.unsplash.com/photo-1544441893-675973e31985?auto=format&fit=crop&w=600&q=80', 'bg-gray-100', 275000.00, '[\"M\", \"L\", \"XL\"]', '[{\"name\": \"Black\", \"hex\": \"#000000\"}, {\"name\": \"Neon Yellow\", \"hex\": \"#CCFF00\"}]', NULL, '2026-07-03 17:37:05'),
(33, 'OUT-008', 'Quilted Puffer Vest', 'Rompi tahan dingin bermotif jahitan kotak-kotak. Menghangatkan inti tubuh tanpa membatasi pergerakan lengan.', 'Outerwear', 'uploads/1783137292_Quilted Puffer Vest.avif', 'bg-gray-100', 320000.00, '[\"M\",\"L\"]', '[{\"name\":\"Navy\",\"hex\":\"#000000\"}]', NULL, '2026-07-03 17:37:05'),
(34, 'OUT-009', 'Chunky Knit Cardigan', 'Kardigan panjang berbahan benang rajut super tebal (chunky). Memberikan nuansa bohemian yang sangat nyaman.', 'Outerwear', 'uploads/1783137054_Chunky Knit Cardigan.avif', 'bg-gray-100', 310000.00, '[\"S\",\"M\",\"L\",\"XL\"]', '[{\"name\":\"Cream\",\"hex\":\"#000000\"},{\"name\":\"Mustard\",\"hex\":\"#000000\"}]', 'Cozy', '2026-07-03 17:37:05'),
(35, 'OUT-010', 'Slim Fit Modern Blazer', 'Jas blazer dengan potongan slim modern. Bisa mengubah kaos biasa menjadi tampilan formal elegan dalam sekejap.', 'Outerwear', 'https://images.unsplash.com/photo-1507679799987-c73779587ccf?auto=format&fit=crop&w=600&q=80', 'bg-gray-100', 550000.00, '[\"S\", \"M\", \"L\", \"XL\"]', '[{\"name\": \"Black\", \"hex\": \"#000000\"}, {\"name\": \"Dark Grey\", \"hex\": \"#A9A9A9\"}]', 'Restock', '2026-07-03 17:37:05');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','user') DEFAULT 'user',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `role`, `created_at`) VALUES
(1, 'Super Admin', 'admin@globebuy.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'admin', '2026-07-03 15:28:09'),
(2, 'abu yazid', 'ayzd2005@gmail.com', '$2y$10$WZxD59Dxp6GY3avNcb1i5.Q2pZwG9k4duyIohSWvac3uQkYGA3XOC', 'admin', '2026-07-03 15:33:13');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_id` (`order_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `sku` (`sku`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `order_items_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
