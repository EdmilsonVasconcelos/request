-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: May 03, 2021 at 03:42 AM
-- Server version: 10.4.18-MariaDB
-- PHP Version: 8.0.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `gas`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id_admin` int(11) NOT NULL,
  `name_admin` varchar(255) NOT NULL,
  `email_admin` varchar(255) NOT NULL,
  `password_admin` text NOT NULL,
  `privilege_admin` varchar(255) NOT NULL,
  `created_admin` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id_admin`, `name_admin`, `email_admin`, `password_admin`, `privilege_admin`, `created_admin`) VALUES
(1, 'Edmilson', 'edmilson.vasconcelos89@gmail.com', '4297f44b13955235245b2497399d7a93', 'FULL', '2021-04-29 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `id_product` int(11) NOT NULL,
  `name_product` varchar(255) NOT NULL,
  `price_product` float NOT NULL,
  `price_product_debit` float DEFAULT NULL,
  `price_product_credit` float DEFAULT NULL,
  `description_product` varchar(255) NOT NULL,
  `method_payment` varchar(256) NOT NULL,
  `available_product` tinyint(1) NOT NULL,
  `created_product` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id_product`, `name_product`, `price_product`, `price_product_debit`, `price_product_credit`, `description_product`, `method_payment`, `available_product`, `created_product`) VALUES
(7, 'Gás de cozinha', 89, 89, 95, '25 kg.', 'AVCCCD', 1, '2021-05-02 21:45:18'),
(8, 'Água mineral', 4, 4, 6, 'Água mineral indaiá 10 litros', 'AVCCCD', 0, '2021-05-02 21:45:55');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id_product`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id_admin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id_product` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
