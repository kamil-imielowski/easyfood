-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Czas generowania: 09 Gru 2017, 16:41
-- Wersja serwera: 10.1.21-MariaDB
-- Wersja PHP: 7.1.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `easyfood`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `address`
--

CREATE TABLE `address` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `street` text NOT NULL,
  `street_number` varchar(8) NOT NULL,
  `post_code` varchar(6) NOT NULL,
  `city` text NOT NULL,
  `date_created` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `street` text NOT NULL,
  `street_number` varchar(8) NOT NULL,
  `post_code` varchar(6) NOT NULL,
  `city` text NOT NULL,
  `date` datetime NOT NULL,
  `total_price` decimal(10,2) NOT NULL,
  `state` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `orders_details`
--

CREATE TABLE `orders_details` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `price` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `name` text NOT NULL,
  `description` text NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `created_date` datetime NOT NULL,
  `updated_date` datetime NOT NULL,
  `state` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `user_type` enum('user','restaurateur','admin') COLLATE utf8_polish_ci NOT NULL DEFAULT 'user',
  `email` varchar(100) COLLATE utf8_polish_ci NOT NULL DEFAULT '',
  `pass` varchar(32) COLLATE utf8_polish_ci NOT NULL DEFAULT '',
  `firstname` varchar(200) COLLATE utf8_polish_ci NOT NULL DEFAULT '',
  `lastname` varchar(200) COLLATE utf8_polish_ci NOT NULL DEFAULT '',
  `city` varchar(100) COLLATE utf8_polish_ci NOT NULL DEFAULT '',
  `postcode` varchar(20) COLLATE utf8_polish_ci NOT NULL DEFAULT '',
  `street` varchar(100) COLLATE utf8_polish_ci NOT NULL DEFAULT '',
  `nip_number` varchar(40) COLLATE utf8_polish_ci DEFAULT NULL,
  `phone` varchar(100) COLLATE utf8_polish_ci NOT NULL DEFAULT '',
  `fax` varchar(55) COLLATE utf8_polish_ci NOT NULL,
  `state` enum('on','off','del','banned','moderate','on_verify') COLLATE utf8_polish_ci NOT NULL DEFAULT 'on'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci ROW_FORMAT=DYNAMIC;

--
-- Zrzut danych tabeli `users`
--

INSERT INTO `users` (`id`, `user_type`, `email`, `pass`, `firstname`, `lastname`, `city`, `postcode`, `street`, `nip_number`, `phone`, `fax`, `state`) VALUES
(1, 'user', 'test', '0cc175b9c0f1b6a831c399e269772661', 'Jan', 'Kowalski', 'Katowice', '41-100', 'Mariacka 32', NULL, '123123123', '', 'on');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `users_logging`
--

CREATE TABLE `users_logging` (
  `id` int(11) NOT NULL,
  `date_log` datetime DEFAULT NULL,
  `date_last_reload` datetime DEFAULT NULL,
  `count_reloads` int(11) NOT NULL DEFAULT '0',
  `login` varchar(200) COLLATE utf8_polish_ci NOT NULL DEFAULT '',
  `user_id` int(11) NOT NULL,
  `ip` char(15) COLLATE utf8_polish_ci DEFAULT NULL,
  `hostname` char(100) COLLATE utf8_polish_ci DEFAULT NULL,
  `system` char(255) COLLATE utf8_polish_ci DEFAULT NULL,
  `state` enum('in','out','','wrong_lp','blocked') COLLATE utf8_polish_ci NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci ROW_FORMAT=DYNAMIC;

--
-- Zrzut danych tabeli `users_logging`
--

INSERT INTO `users_logging` (`id`, `date_log`, `date_last_reload`, `count_reloads`, `login`, `user_id`, `ip`, `hostname`, `system`, `state`) VALUES
(1, '2017-12-08 13:12:09', NULL, 0, 'test', 1, '10.0.0.1', '10.0.0.1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_13_1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.84 Safari/537.36', 'in'),
(2, '2017-12-08 13:13:13', NULL, 0, 'test', 1, '10.0.0.1', '10.0.0.1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_13_1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.84 Safari/537.36', 'in'),
(3, '2017-12-08 13:13:13', NULL, 0, 'test', 1, '10.0.0.1', '10.0.0.1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_13_1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.84 Safari/537.36', 'in'),
(4, '2017-12-08 13:13:16', NULL, 0, 'test', 1, '10.0.0.1', '10.0.0.1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_13_1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.84 Safari/537.36', 'in'),
(5, '2017-12-08 13:13:17', NULL, 0, 'test', 1, '10.0.0.1', '10.0.0.1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_13_1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.84 Safari/537.36', 'in'),
(6, '2017-12-08 13:13:17', NULL, 0, 'test', 1, '10.0.0.1', '10.0.0.1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_13_1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.84 Safari/537.36', 'in'),
(7, '2017-12-08 13:13:18', NULL, 0, 'test', 1, '10.0.0.1', '10.0.0.1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_13_1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.84 Safari/537.36', 'in'),
(8, '2017-12-08 13:15:08', NULL, 0, 'test', 1, '10.0.0.1', '10.0.0.1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_13_1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.84 Safari/537.36', 'in'),
(9, '2017-12-08 13:15:09', NULL, 0, 'test', 1, '10.0.0.1', '10.0.0.1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_13_1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.84 Safari/537.36', 'in'),
(10, '2017-12-08 13:15:53', NULL, 0, 'test', 1, '10.0.0.1', '10.0.0.1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_13_1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.84 Safari/537.36', 'in'),
(11, '2017-12-08 13:18:27', NULL, 0, 'test', 1, '10.0.0.1', '10.0.0.1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_13_1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.84 Safari/537.36', 'in'),
(12, '2017-12-08 13:18:28', NULL, 0, 'test', 1, '10.0.0.1', '10.0.0.1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_13_1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.84 Safari/537.36', 'in'),
(13, '2017-12-08 13:18:46', NULL, 0, 'test', 1, '10.0.0.1', '10.0.0.1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_13_1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.84 Safari/537.36', 'in'),
(14, '2017-12-08 13:18:47', NULL, 0, 'test', 1, '10.0.0.1', '10.0.0.1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_13_1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.84 Safari/537.36', 'in'),
(15, '2017-12-08 13:18:48', NULL, 0, 'test', 1, '10.0.0.1', '10.0.0.1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_13_1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.84 Safari/537.36', 'in'),
(16, '2017-12-08 13:18:48', NULL, 0, 'test', 1, '10.0.0.1', '10.0.0.1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_13_1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.84 Safari/537.36', 'in'),
(17, '2017-12-08 13:18:49', NULL, 0, 'test', 1, '10.0.0.1', '10.0.0.1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_13_1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.84 Safari/537.36', 'in'),
(18, '2017-12-08 13:18:49', NULL, 0, 'test', 1, '10.0.0.1', '10.0.0.1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_13_1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.84 Safari/537.36', 'in'),
(19, '2017-12-08 13:19:01', NULL, 0, 'test', 1, '10.0.0.1', '10.0.0.1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_13_1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.84 Safari/537.36', 'in'),
(20, '2017-12-08 13:19:01', NULL, 0, 'test', 1, '10.0.0.1', '10.0.0.1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_13_1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.84 Safari/537.36', 'in');

--
-- Indeksy dla zrzutów tabel
--

--
-- Indexes for table `address`
--
ALTER TABLE `address`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `orders_details`
--
ALTER TABLE `orders_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `order_id` (`order_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users_logging`
--
ALTER TABLE `users_logging`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_user_id` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT dla tabeli `address`
--
ALTER TABLE `address`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT dla tabeli `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT dla tabeli `orders_details`
--
ALTER TABLE `orders_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT dla tabeli `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT dla tabeli `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT dla tabeli `users_logging`
--
ALTER TABLE `users_logging`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
--
-- Ograniczenia dla zrzutów tabel
--

--
-- Ograniczenia dla tabeli `address`
--
ALTER TABLE `address`
  ADD CONSTRAINT `address_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Ograniczenia dla tabeli `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`),
  ADD CONSTRAINT `orders_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Ograniczenia dla tabeli `orders_details`
--
ALTER TABLE `orders_details`
  ADD CONSTRAINT `orders_details_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`),
  ADD CONSTRAINT `orders_details_ibfk_2` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`);

--
-- Ograniczenia dla tabeli `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Ograniczenia dla tabeli `users_logging`
--
ALTER TABLE `users_logging`
  ADD CONSTRAINT `users_logging_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
