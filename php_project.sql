-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 20 يناير 2023 الساعة 11:51
-- إصدار الخادم: 10.4.27-MariaDB
-- PHP Version: 8.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `php_project`
--

-- --------------------------------------------------------

--
-- بنية الجدول `cate`
--

CREATE TABLE `cate` (
  `cat_id` int(255) NOT NULL,
  `cat_title` varchar(255) NOT NULL,
  `cat_date` date NOT NULL,
  `cat_image` text NOT NULL,
  `cat_content` text NOT NULL,
  `cat_tags` varchar(255) NOT NULL,
  `cat_status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- إرجاع أو استيراد بيانات الجدول `cate`
--

INSERT INTO `cate` (`cat_id`, `cat_title`, `cat_date`, `cat_image`, `cat_content`, `cat_tags`, `cat_status`) VALUES
(1, 'The Old Way', '2023-01-20', 'sky63ca6019b49c811.jpg', 'The Old Way\r\nThe Old Way\r\nThe Old Way\r\nThe Old Way\r\nThe Old Way', '', 'published'),
(2, 'Sleepy Session', '2023-01-20', 'sky63ca6e3c94b6b13.jpg', 'Sleepy Session\r\nSleepy Session\r\nSleepy Session', '', 'published'),
(3, 'Halsey - Without Me', '2023-01-20', 'sky63ca70187b9dc12.jpg', 'Halsey - Without Me\r\nHalsey - Without Me\r\nHalsey - Without Me', '', 'published');

-- --------------------------------------------------------

--
-- بنية الجدول `comments`
--

CREATE TABLE `comments` (
  `comment_id` int(255) NOT NULL,
  `comment_user` varchar(255) NOT NULL,
  `comment_date` date NOT NULL,
  `comment_image` text NOT NULL,
  `comment_content` text NOT NULL,
  `reply_comment` text NOT NULL,
  `number_of_comment` int(255) NOT NULL,
  `comment_post_id` int(255) NOT NULL,
  `comment_status` varchar(255) NOT NULL,
  `comment_email` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- إرجاع أو استيراد بيانات الجدول `comments`
--

INSERT INTO `comments` (`comment_id`, `comment_user`, `comment_date`, `comment_image`, `comment_content`, `reply_comment`, `number_of_comment`, `comment_post_id`, `comment_status`, `comment_email`) VALUES
(1, 'admin', '2023-01-20', '', 'thanks for your test', '', 0, 2, 'approve', 'admin@info.com'),
(2, 'admin', '2023-01-20', '', '', 'cool movie', 1, 0, 'approve', 'admin@info.com'),
(3, 'ALmanar', '2023-01-20', '', 'i love this song!', '', 0, 3, 'approve', 'ahmad.89@gmail.com'),
(4, 'ahmad', '2023-01-20', '', '', 'me too i love Bebe Rexha', 3, 0, 'approve', 'ahmad@gmail.com'),
(5, 'admin', '2023-01-20', '', 'test for comment and reply in different users!', '', 0, 8, 'approve', 'admin.php@info.com'),
(6, 'admin', '2023-01-20', '', 'this is origins comment', '', 0, 8, 'approve', 'admin.php@info.com'),
(7, 'ahmad', '2023-01-20', '', '', 'the test is done and its good!', 5, 0, 'approve', 'ahmad@gmail.com'),
(8, 'ahmad', '2023-01-20', '', '', 'and this is reply!', 6, 0, 'approve', 'ahmad@gmail.com'),
(9, 'ALmanar', '2023-01-20', '', '', 'yaah its good job!', 5, 0, 'approve', 'ahmad.89@gmail.com'),
(10, 'ALmanar', '2023-01-20', '', '', 'second reply~!', 6, 0, 'approve', 'ahmad.89@gmail.com');

-- --------------------------------------------------------

--
-- بنية الجدول `posts`
--

CREATE TABLE `posts` (
  `post_id` int(255) NOT NULL,
  `post_title` varchar(255) NOT NULL,
  `post_date` date NOT NULL,
  `post_image` text NOT NULL,
  `post_content` text NOT NULL,
  `post_tags` varchar(255) NOT NULL,
  `post_status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- إرجاع أو استيراد بيانات الجدول `posts`
--

INSERT INTO `posts` (`post_id`, `post_title`, `post_date`, `post_image`, `post_content`, `post_tags`, `post_status`) VALUES
(1, 'Personal Attention', '2023-01-20', '1.jpg', 'Personal Attention Personal Attention\r\nPersonal Attention Personal Attention\r\nPersonal Attention Personal Attention\r\nPersonal Attention Personal Attention\r\nPersonal Attention Personal Attention\r\nPersonal Attention Personal Attention\r\nPersonal Attention Personal Attention', 'Personal Attention', 'published'),
(2, 'M3GAN', '2023-01-20', '2.jpg', 'تصبح جيما مسؤولة عن رعاية ابنة أختها اليتيمة كادي، ولمساعدتها على تجاوز أحزانها بفقدان والديها; تقدم جيما لـ كادي هدية تتمثل في دمية آلية تُدعى ميغان مصممة خصيصاً لمرافقتها وحمايتها ولكن يحدُث ما لم يكُن بالحُسبان', '', 'published'),
(3, 'Bebe Rexha - I\'m Good', '2023-01-20', '4.jpg', 'I\'m good, yeah, I\'m feelin\' alright\r\nBaby, I\'ma have the best fuckin\' night of my life\r\nAnd wherever it takes me, I\'m down for the ride\r\nBaby, don\'t you know I\'m good, yeah, I\'m feelin\' alright\r\n\'Cause I\'m good, yeah, I\'m feelin\' alright\r\nBaby, I\'ma have the best fuckin\' night of my life\r\nAnd wherever it takes me, I\'m down for the ride\r\nBaby, don\'t you know I\'m good, yeah, I\'m feelin\' alright', 'Im Good', 'published'),
(4, 'Dark Personal Attention', '2023-01-20', '3.jpg', 'Dark Personal Attention\r\nDark Personal Attention\r\nDark Personal Attention', 'Dark', 'Select Status'),
(5, 'Two Steps From Hell', '2023-01-20', '5.jpg', 'Two Steps From Hell\r\nTwo Steps From Hell\r\nTwo Steps From Hell', 'Star Sky', 'published'),
(6, 'Past and present now embrace', '2023-01-20', '7.jpg', 'Past and present now embrace\r\nPast and present now embrace\r\nPast and present now embrace\r\nPast and present now embrace', '', 'published'),
(7, 'Madonna - Frozen', '2023-01-20', '6.jpg', 'Madonna - Frozen\r\nMadonna - Frozen\r\nMadonna - Frozen\r\nMadonna - Frozen', 'Frozen', 'published'),
(8, 'Alexander Rybak - Fairytale', '2023-01-20', '21.png', 'Alexander Rybak - Fairytale\r\nAlexander Rybak - Fairytale\r\nAlexander Rybak - Fairytale', 'Fairytale', 'published');

-- --------------------------------------------------------

--
-- بنية الجدول `users`
--

CREATE TABLE `users` (
  `user_id` int(255) NOT NULL,
  `user_name` varchar(255) NOT NULL,
  `user_password` varchar(255) NOT NULL,
  `user_email` varchar(255) NOT NULL,
  `user_gender` varchar(255) NOT NULL,
  `user_role` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- إرجاع أو استيراد بيانات الجدول `users`
--

INSERT INTO `users` (`user_id`, `user_name`, `user_password`, `user_email`, `user_gender`, `user_role`) VALUES
(1, 'admin', 'admin', 'admin.php@info.com', 'male', 'admin'),
(2, 'ahmad', '321', 'ahmad@gmail.com', 'male', 'user'),
(3, 'ALmanar', '221', 'ahmad.89@gmail.com', 'female', 'user');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cate`
--
ALTER TABLE `cate`
  ADD PRIMARY KEY (`cat_id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`comment_id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`post_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cate`
--
ALTER TABLE `cate`
  MODIFY `cat_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `comment_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `post_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
