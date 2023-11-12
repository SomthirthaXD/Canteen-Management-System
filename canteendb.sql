-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 07, 2023 at 06:49 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `canteendb`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `user` int(7) NOT NULL,
  `item` varchar(20) NOT NULL,
  `quantity` int(3) NOT NULL,
  `price` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`user`, `item`, `quantity`, `price`) VALUES
(2282003, 'Chicken Moburg', 1, 80);

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

CREATE TABLE `menu` (
  `name` varchar(40) NOT NULL,
  `image` varchar(100) NOT NULL,
  `about` varchar(100) NOT NULL,
  `category` varchar(20) NOT NULL,
  `price` int(5) NOT NULL,
  `veg` varchar(8) NOT NULL,
  `available` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`name`, `image`, `about`, `category`, `price`, `veg`, `available`) VALUES
('Blue Lagoon', 'img/lagoon.jpg', 'Refreshing blue lagoon soda served with ice cubes and a cherry on top', 'Drinks and Beverages', 40, 'Veg', 1),
('Bon Bon', 'img/bonbon.jpg', 'Vanilla ice cream bells coated in chocolate', 'Ice Cream', 5, 'Veg', 1),
('Chicken Biryani', 'img/biryani.jpg', 'Bengali style chicken biryani made with basmati rice. Comes with one piece of chicken and potato.', 'Main Course', 90, 'Non-Veg', 1),
('Chicken Burger', 'img/chickborgir.jpg', 'Burger with crispy chicken patty, lettuce, house-made sauce and caramelized onions', 'Snacks', 80, 'Non-Veg', 1),
('Chicken Hot Dog', 'img/hdog.jpg', 'Chicken sausage stuffed in hot dog bun served with ketchup and mustard', 'Snacks', 50, 'Non-Veg', 1),
('Chicken Meal', 'img/chickenmeal.jpg', 'Standard meal with rice, a vegetable side, daal and two pieces of chicken.', 'Main Course', 90, 'Non-Veg', 1),
('Chicken Moburg', 'img/cmo.jpg', 'Burger buns with two fried chicken momos in between, served with mint chutney and hot sauce', 'Snacks', 80, 'Non-Veg', 1),
('Chicken Pizza', 'img/cpizza.jpg', 'Thin crust pizza with house-made sauce, fresh basil and tikka chicken', 'Snacks', 120, 'Non-Veg', 1),
('Chicken Roll', 'img/chickroll.jpg', 'Laccha paratha wrap with diced kebab chicken, sauce and salad inside. Serves one.', 'Snacks', 50, 'Non-Veg', 1),
('Chocolate Cone', 'img/chococone.jpg', 'Chocolate Ice cream served in biscuit cone', 'Ice Cream', 35, 'Veg', 1),
('Chocolate Frappe', 'img/frappe.jpg', 'Chocolate frappe served with whipped cream and chocolate chips on top', 'Drinks and Beverages', 90, 'Veg', 1),
('Chocolate Stick', 'img/chocostick.jpg', 'Dark Chocolate ice cream that comes on a stick', 'Ice Cream', 35, 'Veg', 1),
('Chowmein with Chili Chicken', 'img/chow.jpg', 'Chicken chowmein served with two pieces of chili chicken and gravy', 'Main Course', 90, 'Non-Veg', 1),
('French Fries', 'img/frenchfries.jpg', 'Crispy Salted French Fries are the perfect snacks that needs no introduction.', 'Snacks', 40, 'Veg', 0),
('Fried Rice with Chili Chicken', 'img/cfrice.jpg', 'Veg fried rice served with two pieces of chili chicken and gravy', 'Main Course', 100, 'Non-Veg', 1),
('Fried Rice with Veg Manchurian', 'img/vfrice.jpg', 'Veg fried rice served with two pieces of veg manchurian in gravy', 'Main Course', 80, 'Veg', 1),
('Iced Tea', 'img/icetea.jpg', 'Refreshing iced Assamese tea served with ice cubes', 'Drinks and Beverages', 40, 'Veg', 0),
('Idli', 'img/idli.jpg', 'Plain idli served with sambar and coconut plus mint chutney', 'Main Course', 45, 'Veg', 1),
('Lassi', 'img/lassi.jpg', 'Cold refreshing lassi served with kesar and dried fruit on top', 'Drinks and Beverages', 35, 'Veg', 1),
('Mango Cone', 'img/mangocone.jpg', 'Mango ice cream served in biscuit cone', 'Ice Cream', 30, 'Veg', 1),
('Mango Stick', 'img/mangostick.jpg', 'Mango stick ice cream, made of real mango pulp', 'Ice Cream', 30, 'Veg', 1),
('Masala Dosa', 'img/mdosa.jpg', 'Masala dosa served with coconut chutney, mint chutney and sambar', 'Main Course', 50, 'Veg', 1),
('Milk Coffee', 'img/coffee.jpg', 'A classic cup of milk coffee with sugar, just how I like it', 'Drinks and Beverages', 15, 'Veg', 1),
('Milk Tea', 'img/tea.jpg', 'Classic milk tea with sugar, served hot', 'Drinks and Beverages', 10, 'Veg', 1),
('Paneer Pizza', 'img/ppizza.jpg', 'Paneer thin crust pizza with jalapeno, fresh basil and a house-made sauce', 'Snacks', 90, 'Veg', 1),
('Strawberry Cone', 'img/strawberrycone.jpg', 'Strawberry ice cream served in biscuit cone', 'Ice Cream', 25, 'Veg', 0),
('Two-in-One Cup', 'img/twoinonecup.jpg', 'Vanilla and strawberry flavors come together in one delicious cup of ice cream', 'Ice Cream', 25, 'Veg', 1),
('Vanilla Cone', 'img/vanillacone.jpeg', 'Vanilla ice cream served in biscuit cone', 'Ice Cream', 30, 'Veg', 1),
('Veg Burger', 'img/vegborgir.jpg', 'Burger with juicy vegetable patty, lettuce, house-made sauce and caramelized onions', 'Snacks', 55, 'Veg', 1),
('Veg Meal', 'img/vegmeal.jpg', 'Steamed rice is served with dal, two mixed vegs, chutney and papad', 'Main Course', 70, 'Veg', 0),
('Veg Moburg', 'img/vmo.jpg', 'Burger buns with two fried vegetable momos in between, served with mint chutney and hot sauce', 'Snacks', 60, 'Veg', 1),
('Veg Pulao Aloo Dum', 'img/pulaoalu.jpg', 'Bengali style sweet pulao made of basmati rice. Comes with one serving of aloo dum served hot.', 'Main Course', 75, 'Veg', 1),
('Waffle Ice Cream', 'img/waffle.jpg', 'Chocolate waffle served with vanilla ice cream on top, covered in chocolate syrup and sprinkles', 'Ice Cream', 70, 'Veg', 1);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(7) NOT NULL,
  `content` longblob NOT NULL,
  `time` datetime NOT NULL,
  `delivered` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;



--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `roll` int(7) NOT NULL,
  `name` text NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`user`,`item`),
  ADD KEY `FK2` (`item`);

--
-- Indexes for table `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`name`) USING BTREE;

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`,`time`) USING BTREE;

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`roll`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `FK1` FOREIGN KEY (`user`) REFERENCES `users` (`roll`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK2` FOREIGN KEY (`item`) REFERENCES `menu` (`name`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
