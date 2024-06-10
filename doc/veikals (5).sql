-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1
-- Время создания: Июн 10 2024 г., 09:55
-- Версия сервера: 10.4.28-MariaDB
-- Версия PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `veikals`
--

-- --------------------------------------------------------

--
-- Структура таблицы `admins`
--

CREATE TABLE `admins` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `admins`
--

INSERT INTO `admins` (`id`, `name`, `email`, `password`) VALUES
(1, 'Natalija', 'natalija@example.com', '112'),
(2, 'ib', 'ib@gm.com', '1');

-- --------------------------------------------------------

--
-- Структура таблицы `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `categories`
--

INSERT INTO `categories` (`id`, `name`) VALUES
(1, 'Skin_Care'),
(2, 'Hair_Care'),
(3, 'Makeup'),
(4, 'Fragrance'),
(5, 'Bath & Body'),
(6, 'Nail_Care'),
(7, 'Mens_Grooming'),
(8, 'Tools & Brushes'),
(9, 'Gift_Sets'),
(10, 'New_Arrivals'),
(11, 'Skin_Care'),
(12, 'Hair_Care'),
(13, 'Makeup'),
(14, 'Fragrance'),
(15, 'Bath & Body'),
(16, 'Nail_Care'),
(17, 'Mens_Grooming'),
(18, 'Tools & Brushes'),
(19, 'Gift_Sets'),
(20, 'New_Arrivals'),
(21, 'Skin_Care'),
(22, 'Hair_Care'),
(23, 'Makeup'),
(24, 'Fragrance'),
(25, 'Bath & Body'),
(26, 'Nail_Care'),
(27, 'Mens_Grooming'),
(28, 'Tools & Brushes'),
(29, 'Gift_Sets'),
(30, 'New_Arrivals');

-- --------------------------------------------------------

--
-- Структура таблицы `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `status` varchar(50) DEFAULT NULL,
  `total_price` decimal(10,2) DEFAULT NULL,
  `order_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `status`, `total_price`, `order_date`) VALUES
(5, 13, 'Shipped', NULL, NULL),
(6, 16, 'Processing', NULL, NULL),
(7, 18, 'Processing', NULL, NULL),
(8, 19, 'Shipped', NULL, NULL),
(9, 19, 'Processing', NULL, NULL),
(10, 19, 'Processing', NULL, NULL),
(11, 19, 'Processing', NULL, NULL),
(12, 19, 'Processing', NULL, NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `is_promotion` tinyint(1) DEFAULT 0,
  `promotion` varchar(255) DEFAULT NULL,
  `image2` varchar(255) DEFAULT NULL,
  `image3` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `products`
--

INSERT INTO `products` (`id`, `name`, `price`, `image`, `description`, `is_promotion`, `promotion`, `image2`, `image3`) VALUES
(35, '12', 0.00, 'foto/acai.jpg', '213', 0, '0', 'foto/calagen.jpeg', 'foto/calogen5.jpeg'),
(36, '123', 123.00, '651cd3669d07828e5fe3080728f5efdd-1000.jpg', '123213', 0, '0', 'foto/1dsouls-2560x1440-px-action-artwork-battle-dark-exploration-fantasy-fighting-souls-stealth-technical-warrior-1820047.jpg', 'foto/5j5-rUZBLrw.jpg'),
(37, '1', 1.00, '03957f81624191.5d051342301ad.png', '123213', 0, NULL, NULL, NULL),
(38, 'кон', 123.00, '1465499101_pO2l3g32r44.jpg', '123ыффв', 0, NULL, NULL, NULL),
(39, '12', 0.00, '5dd251eec9b5dfcc6e027945322645dd.jpg', 'йцу', 0, NULL, NULL, NULL),
(40, 'кон', 0.00, '5dd251eec9b5dfcc6e027945322645dd.jpg', 'asd', 0, NULL, NULL, NULL),
(42, '123', 123.00, '1.png', '21', 0, NULL, NULL, NULL),
(43, '12', 21.00, '1dsouls-2560x1440-px-action-artwork-battle-dark-exploration-fantasy-fighting-souls-stealth-technical-warrior-1820047.jpg', '12', 0, '1', NULL, NULL),
(44, 'ФЫВФЫВФЫВФЫВФ', 123.00, '651cd3669d07828e5fe3080728f5efdd-1000.jpg', '123', 0, '0', 'foto/1dsouls-2560x1440-px-action-artwork-battle-dark-exploration-fantasy-fighting-souls-stealth-technical-warrior-1820047.jpg', 'foto/860cbb15630101.562951077a1e6.jpg'),
(46, 'кон', 99.00, 'foto/1dsouls-2560x1440-px-action-artwork-battle-dark-exploration-fantasy-fighting-souls-stealth-technical-warrior-1820047.jpg', '123123', 0, '1', 'foto/5dd251eec9b5dfcc6e027945322645dd.jpg', 'foto/03957f81624191.5d051342301ad.png');

-- --------------------------------------------------------

--
-- Структура таблицы `reviews`
--

CREATE TABLE `reviews` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `user_name` varchar(255) NOT NULL,
  `review_text` text NOT NULL,
  `rating` int(11) NOT NULL CHECK (`rating` between 1 and 5),
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `reviews`
--

INSERT INTO `reviews` (`id`, `product_id`, `user_name`, `review_text`, `rating`, `created_at`) VALUES
(3, 43, 'trio', '12312', 5, '2024-06-09 21:07:28');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `is_admin` tinyint(1) DEFAULT 0,
  `address` varchar(255) NOT NULL,
  `phone` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `is_admin`, `address`, `phone`) VALUES
(1, 'Ruslan', 'ruslan@example.com', 'password1', 1, '', ''),
(6, 'КГ', 'BRU@GM.COM', '$2y$10$GbdPSiYBPG9SMgNh4eNJqO1yYKnJpex1XGiwccQrouKmPUl9qYLr6', 0, '', ''),
(7, 'ЙЦ', 'RU@MA.COM', '$2y$10$9KdWQmQIadeDGKrd89e7IOPdhY7byIiEA71CTMiX9LTpKy9ew3ezy', 0, '', ''),
(13, 'лг', 'ks@ks.cs', '$2y$10$erZ3q7cG/dZPGqxB6gdbge3uc/T1feEx.xjR/61Tg3t9cYK6mUHi6', 0, '', ''),
(16, 'кук', 'mb@mb.com', '$2y$10$cg6Q9QwrPB.jt3drrYCSl.SUt1eaejVka3Ospfr66lg63o41Db6QO', 0, '', ''),
(18, 'ru', '123@123.com', '$2y$10$jvbTkTLcMnpdFtFvLFnsgOvNeRw7RtP6xA9sZOzMEtTgh0eYZhYAm', 0, '', ''),
(19, 'qw', 'qw@qw.com', '$2y$10$.yp7D.2vvbHmPFi1QAK/.upSLGgUFpUggIIs4.UmruSLG.0D9N1z2', 0, '', ''),
(20, '123', 'myrambler0@gmail.com', '', 0, '', '123ц'),
(21, '123', '1qweq@qe.com', '', 0, '', '123123123');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Индексы таблицы `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_orders_users` (`user_id`);

--
-- Индексы таблицы `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`),
  ADD KEY `reviews_ibfk_1` (`product_id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `email_2` (`email`),
  ADD UNIQUE KEY `email_3` (`email`),
  ADD UNIQUE KEY `email_4` (`email`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT для таблицы `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT для таблицы `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT для таблицы `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT для таблицы `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `fk_orders_users` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Ограничения внешнего ключа таблицы `reviews`
--
ALTER TABLE `reviews`
  ADD CONSTRAINT `reviews_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
