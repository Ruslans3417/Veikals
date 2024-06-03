-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1
-- Время создания: Июн 02 2024 г., 17:50
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
-- Структура таблицы `cart`
--

CREATE TABLE `cart` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `cart`
--

INSERT INTO `cart` (`id`, `user_id`, `product_id`, `quantity`) VALUES
(5, 9, 34, 1),
(6, 9, 34, 1),
(7, 9, 35, 1),
(8, 9, 35, 1),
(9, 11, 30, 1),
(10, 9, 30, 1),
(11, 9, 30, 1);

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
  `quantity` int(11) NOT NULL,
  `status` enum('Processing','Shipped','Cancelled') DEFAULT 'Processing'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `quantity`, `status`) VALUES
(3, 9, 0, 'Cancelled'),
(4, 9, 0, 'Processing'),
(5, 13, 0, 'Cancelled');

-- --------------------------------------------------------

--
-- Структура таблицы `order_items`
--

CREATE TABLE `order_items` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `order_items`
--

INSERT INTO `order_items` (`id`, `order_id`, `product_id`, `quantity`, `price`) VALUES
(1, 3, 29, 2, 30.99),
(2, 3, 30, 1, 25.99),
(3, 4, 29, 6, 30.99),
(4, 5, 32, 1, 123.00),
(5, 5, 35, 1, 0.00);

-- --------------------------------------------------------

--
-- Структура таблицы `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `products`
--

INSERT INTO `products` (`id`, `name`, `price`, `image`, `description`) VALUES
(29, '123', 100000.00, '5j5-rUZBLrw.jpg', 'asdasd'),
(30, 'Product10', 25.99, 'image10.jpg', NULL),
(32, 'кон', 123.00, 'calogen3.jpeg', NULL),
(33, 'кон', 2222.00, '25.png', NULL),
(34, '', 0.00, '1dsouls-2560x1440-px-action-artwork-battle-dark-exploration-fantasy-fighting-souls-stealth-technical-warrior-1820047.jpg', NULL),
(35, '', 0.00, '651cd3669d07828e5fe3080728f5efdd-1000.jpg', NULL),
(36, '123', 123.00, '651cd3669d07828e5fe3080728f5efdd-1000.jpg', '123213'),
(37, '1', 1.00, '03957f81624191.5d051342301ad.png', '123213'),
(38, 'кон', 123.00, '1465499101_pO2l3g32r44.jpg', '123ыффв'),
(39, '12', 0.00, '5dd251eec9b5dfcc6e027945322645dd.jpg', 'йцу'),
(40, 'кон', 0.00, '5dd251eec9b5dfcc6e027945322645dd.jpg', 'asd');

-- --------------------------------------------------------

--
-- Структура таблицы `ratings`
--

CREATE TABLE `ratings` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `rating` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `reviews`
--

CREATE TABLE `reviews` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `rating` int(11) NOT NULL,
  `comment` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `is_admin` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `is_admin`) VALUES
(1, 'Ruslan', 'ruslan@example.com', 'password1', 1),
(6, 'КГ', 'BRU@GM.COM', '$2y$10$GbdPSiYBPG9SMgNh4eNJqO1yYKnJpex1XGiwccQrouKmPUl9qYLr6', 1),
(7, 'ЙЦ', 'RU@MA.COM', '$2y$10$9KdWQmQIadeDGKrd89e7IOPdhY7byIiEA71CTMiX9LTpKy9ew3ezy', 0),
(8, 'RUS', 'RUSL@RUS.COM', '$2y$10$UR8WXd/hbpSgD0vSc2k7FOMwSJHnTGZk.Mdmg/dkwlDoBzOYxAWve', 1),
(9, 'иг', 'bubur@gmail.xn--com-cgd', '$2y$10$zo.FCOLGIrDLDL3LAVMkN.Yyyp9XUK03o73YzRr6JCfVMaW.d/zyy', 0),
(11, 'na', 'natalija@example.com', '$2y$10$I9YCidPLTwqc./V95XNMk.BMouD48cDp3Q/MjLAqc3sZX.psqyLFu', 0),
(12, 'ru', 'ru@gu.com', '$2y$10$ppvUx80Owv84ueNdPuMqCeagz3zySrT1oG1YyZvxCEb9vKPbVg5JW', 1),
(13, 'лг', 'ks@ks.cs', '$2y$10$erZ3q7cG/dZPGqxB6gdbge3uc/T1feEx.xjR/61Tg3t9cYK6mUHi6', 0),
(14, 'r', 'ru@ru.com', '$2y$10$m3lImqc8xYoYgGrxsCM1lOrz.36ndIIUVG0yMqizBweK16c/mMNUO', 1),
(15, 'ac', 'ru@ru.cu', '$2y$10$qbb9.NsZxyItbHP5zgh3SevDXm5Q9V74YQ8PJFXMgitfUmgVRQLDW', 0),
(16, 'фы', 'mb@mb.com', '$2y$10$cg6Q9QwrPB.jt3drrYCSl.SUt1eaejVka3Ospfr66lg63o41Db6QO', 1),
(17, '123', 'asd@asd.com', '$2y$10$1vHqa1QA3pxgrIV9YU6F5.y2OhIp1VhXCIfdPtcLSYLbZuG704hW.', 0);

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
-- Индексы таблицы `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `product_id` (`product_id`);

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
  ADD KEY `user_id` (`user_id`);

--
-- Индексы таблицы `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Индексы таблицы `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `ratings`
--
ALTER TABLE `ratings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Индексы таблицы `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `product_id` (`product_id`);

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
-- AUTO_INCREMENT для таблицы `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT для таблицы `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT для таблицы `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT для таблицы `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT для таблицы `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT для таблицы `ratings`
--
ALTER TABLE `ratings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `cart_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `cart_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Ограничения внешнего ключа таблицы `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Ограничения внешнего ключа таблицы `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `order_items_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`),
  ADD CONSTRAINT `order_items_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`);

--
-- Ограничения внешнего ключа таблицы `ratings`
--
ALTER TABLE `ratings`
  ADD CONSTRAINT `ratings_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `ratings_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`);

--
-- Ограничения внешнего ключа таблицы `reviews`
--
ALTER TABLE `reviews`
  ADD CONSTRAINT `reviews_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `reviews_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
