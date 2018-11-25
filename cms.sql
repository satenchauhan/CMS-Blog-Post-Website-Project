-- phpMyAdmin SQL Dump
-- version 4.8.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 25, 2018 at 08:48 PM
-- Server version: 10.1.31-MariaDB
-- PHP Version: 7.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cms`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `category` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `category`) VALUES
(1, 'Bollywood'),
(2, 'Sports'),
(3, 'Entertainment'),
(4, 'Business'),
(5, 'News'),
(6, 'Social media');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `post_id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `country` varchar(255) NOT NULL,
  `comment` text NOT NULL,
  `status` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `date` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `name`, `username`, `post_id`, `email`, `country`, `comment`, `status`, `image`, `date`) VALUES
(1, 'Kaaml Kumar', 'Guest user', 1, 'kamal@gmail.com', 'India', 'This is nice post, hunting animal strictly prohibited.', 'replied', '', '06-11-18 05:39:55'),
(2, 'Tapan Kumar', 'Guest user', 1, 'tapan@gmail.com', 'India', 'Nice post all the hunters will be aware of this warning.', 'replied', '', '06-11-18 05:45:07'),
(3, 'Mukesh', 'Guest user', 2, 'mukesh@gmail.com', 'India', 'This is nice post commented by mukesh', 'replied', 'pic15.jpg', '06-11-18 07:05:49'),
(4, 'Raman Kumar', 'Raman', 2, 'admin@gmail.com', 'Australia', 'Thank you for comment by raman', 'replied', 'dami1.png', '06-11-18'),
(6, 'Mukesh', 'Guest user', 2, 'mukesh@gmail.com', 'India', 'This is nice post commented by mukesh', 'approved', 'pic15.jpg', '06-11-18 07:08:25');

-- --------------------------------------------------------

--
-- Table structure for table `media`
--

CREATE TABLE `media` (
  `id` int(11) NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `media`
--

INSERT INTO `media` (`id`, `image`) VALUES
(1, 'car5.jpg'),
(2, 'car6.jpg'),
(3, 'car7.jpg'),
(4, 'car8.jpg'),
(5, 'car9.jpg'),
(6, 'img3.jpg'),
(7, 'lap.png'),
(8, 'pic12.jpg'),
(9, 'pic23.jpg'),
(10, 'pic25.jpg'),
(11, 'pic26.jpg'),
(12, 'pic32.jpg'),
(13, 'pic34.jpg'),
(14, 'pic35.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `author` varchar(255) NOT NULL,
  `author_image` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `categories` varchar(255) NOT NULL,
  `tags` varchar(255) NOT NULL,
  `post_data` text NOT NULL,
  `views` int(11) NOT NULL,
  `status` varchar(255) NOT NULL,
  `date` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `title`, `author`, `author_image`, `image`, `categories`, `tags`, `post_data`, `views`, `status`, `date`) VALUES
(1, 'Hunter', 'Naman Kumar', 'pic15.jpg', 'car5.jpg', 'Bollywood', 'Animal, forest', 'Hunting animals is illegal act of killing animal.', 4, 'publish', '06-11-18 05:37:50'),
(2, 'Actress', 'Raman Kumar', 'dami1.png', 'pic15.jpg', 'Bollywood', 'Movies,films Actresses', 'All the actress are very beautifull, they perform in movies.', 18, 'publish', '06-11-18 05:53:15'),
(3, 'Green Enviroment', 'daman', 'pic19.jpg', 'pic32.jpg', 'Sports', 'Green, Nature', 'Natural green and environment is good for health', 0, 'publish', '06-11-18 07:14:07'),
(4, 'Hollywood', 'raman', 'dami1.png', 'pic23.jpg', 'Entertainment', 'Movies, Hollywood, Film', 'Hollywood producing best movies.', 0, 'publish', '25-11-18 20:01:48');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `dob` varchar(60) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `joined` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `username`, `email`, `dob`, `password`, `role`, `image`, `token`, `joined`) VALUES
(2, 'Raman', 'Kumar', 'raman', 'admin@gmail.com', '1984-10-20', '$2y$10$xeD/jXZdJQkoWwLEw.g0lOOQYlBgF4ZsLB.0QnTL7b7JaYERizSrK', 'admin', 'dami1.png', 'nx$3v15#br', '06-11-18 05:04:25'),
(3, 'Daman', 'Kumar', 'daman', 'example@gmail.com', '1984-12-10', '$2y$10$7/k.G9RUO8fDmsWMetgSG..RbQ5QMvMdcyxy319pBsMfdVuAler1.', 'author', 'pic19.jpg', '3#%M7Z4o6s', '06-11-18 07:10:29'),
(5, 'Naman', 'Kumar', 'naman', 'naman@gmail.com', '2018-11-22', '$2y$10$G7ZEqrPmH.gZFWS5KiPnLuZZVrOBJunW.C6XEC7d16tYQuZ/9dC8a', 'admin', 'dami1.png', '70K$x56mRT', '25-11-18 16:49:33'),
(6, 'John', 'Kumar', 'johnkumar', 'johnkumar@gmail.com', '2018-11-30', '$2y$10$RZICuT181HolNy0ml2a6S..mLZDKjy0P3bcrDio7XkO7.L4iMxgvy', 'author', 'dami1.png', 'N4TRLbghmz', '25-11-18 19:45:42'),
(8, 'Smith', 'Chauhan', 'smith123', 'smith123@gmail.com', '2018-11-20', '$2y$10$UYzFHhsAnmro5.TvTFh0wuA8UCD47ds0K2wNQq5kLroATTM0jSmgq', 'author', 'dami1.png', '80X4ZRhheM', '25-11-18 19:51:37');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `media`
--
ALTER TABLE `media`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `media`
--
ALTER TABLE `media`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
