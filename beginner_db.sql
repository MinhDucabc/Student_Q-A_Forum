-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th10 08, 2024 lúc 11:09 AM
-- Phiên bản máy phục vụ: 10.4.32-MariaDB
-- Phiên bản PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `beginner_db`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `content` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `modules`
--

CREATE TABLE `modules` (
  `id` int(11) NOT NULL,
  `module_name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `modules`
--

INSERT INTO `modules` (`id`, `module_name`, `description`, `created_at`, `updated_at`) VALUES
(1, 'Introduction to Programming', 'Learn the basics of programming, including variables, loops, and functions.', '2024-11-07 05:10:37', '2024-11-07 05:10:37'),
(2, 'Data Structures and Algorithms', 'Study common data structures like arrays, linked lists, stacks, queues, and algorithms for sorting and searching.', '2024-11-07 05:10:37', '2024-11-07 05:10:37'),
(3, 'Database Management Systems', 'Understand relational databases, SQL, and how to manage data efficiently.', '2024-11-07 05:10:37', '2024-11-07 05:10:37'),
(4, 'Web Development', 'Learn the fundamentals of front-end and back-end development, including HTML, CSS, JavaScript, and server-side programming.', '2024-11-07 05:10:37', '2024-11-07 05:10:37'),
(5, 'Machine Learning', 'An introduction to machine learning concepts and algorithms for data analysis and predictions.', '2024-11-07 05:10:37', '2024-11-07 05:10:37');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `posts`
--

CREATE TABLE `posts` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `image_url` mediumblob DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `module_id` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `posts`
--

INSERT INTO `posts` (`id`, `title`, `content`, `image_url`, `user_id`, `module_id`, `created_at`, `updated_at`) VALUES
(2, 'How to integrate React with PHP?', 'I am trying to connect React frontend with PHP backend. Any advice?', NULL, 1, NULL, '2024-11-03 04:04:12', '2024-11-06 09:49:37'),
(3, 'Understanding SQL Joins', 'Can someone explain different types of SQL joins and when to use them?', NULL, 1, NULL, '2024-11-04 03:40:01', '2024-11-04 03:40:01'),
(4, 'JavaScript Async/Await', 'I am having trouble understanding async and await in JavaScript. Any examples?', NULL, 2, NULL, '2024-11-04 03:40:01', '2024-11-04 03:40:01'),
(7, 'dasf', 'adsf', NULL, 13, 1, '2024-11-07 05:12:46', '2024-11-07 05:12:46'),
(8, 'fjhg', 'jhgjhhkg', NULL, 13, 3, '2024-11-07 05:46:34', '2024-11-07 05:46:34'),
(9, 'afsd', 'asdfdfa', NULL, 13, 2, '2024-11-07 05:52:35', '2024-11-07 05:52:35'),
(10, 'adfds', 'adfsass', NULL, 15, 2, '2024-11-07 09:01:38', '2024-11-07 09:01:38'),
(11, 'adfsgfd', 'dasfasdasfas', NULL, 15, 2, '2024-11-07 09:02:14', '2024-11-07 09:02:14');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`) VALUES
(1, 'johndoe', 'johndoe@example.com', 'hashed_password123'),
(2, 'admin', 'ducminhcao2005@gmail.com', '$2y$10$Yet33ya9ZUxv5mbeJKsnsOsjZPq7Aeo/yy7uL2oUXDgqrvE5RMhxC'),
(3, 'minhduc1222', 'abc@gmail.com', '$2y$10$no/3o2bCOPb/bxUa4hDWUeqS3Q0ICstKYbNPUGUV8yEIEPLkBGfEW'),
(4, 'abc', 'a@gmail.com', 'asd'),
(5, 'sad', 'ads', 'dsa'),
(8, 'dfas', 'dsfa', 'asdf'),
(10, 'asdasd', 'fdassdaf', 'dsafsda'),
(12, 'sdaf', 'adsf', 'dsfa'),
(13, 'user1', 'user1@gmail.com', '123456'),
(14, 'user2', 'user2@gmail.com', '123456'),
(15, 'user5', 'user5@gmail.com', '1234567');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `post_id` (`post_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Chỉ mục cho bảng `modules`
--
ALTER TABLE `modules`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `module_name` (`module_name`);

--
-- Chỉ mục cho bảng `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `module_id` (`module_id`);

--
-- Chỉ mục cho bảng `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `modules`
--
ALTER TABLE `modules`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT cho bảng `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT cho bảng `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `comments_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `posts_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `posts_ibfk_2` FOREIGN KEY (`module_id`) REFERENCES `modules` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
