-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Хост: localhost
-- Время создания: Май 03 2024 г., 20:57
-- Версия сервера: 5.7.27-30-log
-- Версия PHP: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `buchaches`
--

-- --------------------------------------------------------

--
-- Структура таблицы `bookings`
--

CREATE TABLE `bookings` (
  `booking_id` int(11) NOT NULL,
  `client_id` int(11) DEFAULT NULL,
  `slot_id` int(11) NOT NULL,
  `instructor_id` int(11) DEFAULT NULL,
  `booked_capacity` smallint(6) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` tinyint(4) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `bookings`
--

INSERT INTO `bookings` (`booking_id`, `client_id`, `slot_id`, `instructor_id`, `booked_capacity`, `timestamp`, `status`) VALUES
(25, 1, 7, 8, 4, '2024-05-03 17:50:55', 1);

-- --------------------------------------------------------

--
-- Структура таблицы `clients`
--

CREATE TABLE `clients` (
  `client_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `client_surname` varchar(50) NOT NULL,
  `client_name` varchar(50) NOT NULL,
  `client_phone` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `clients`
--

INSERT INTO `clients` (`client_id`, `user_id`, `client_surname`, `client_name`, `client_phone`) VALUES
(1, 10, 'Бучин', 'Глеб', '+7(903)691-71-17');

-- --------------------------------------------------------

--
-- Структура таблицы `instructors`
--

CREATE TABLE `instructors` (
  `instructor_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `instructor_surname` varchar(50) NOT NULL,
  `instructor_name` varchar(50) NOT NULL,
  `instructor_phone` varchar(20) NOT NULL,
  `status` enum('Основной состав','Запасной состав','Стажировка','Старший инструктор') NOT NULL DEFAULT 'Стажировка',
  `certification` enum('Пройдена','Не пройдена','Пройдена частично') NOT NULL DEFAULT 'Не пройдена'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `instructors`
--

INSERT INTO `instructors` (`instructor_id`, `user_id`, `instructor_surname`, `instructor_name`, `instructor_phone`, `status`, `certification`) VALUES
(1, 2, 'Бучин', 'Глеб', '+7(903)691-71-17', 'Основной состав', 'Пройдена'),
(2, 3, 'Мущинин', 'Иван', '+7(920)119-77-44', 'Основной состав', 'Пройдена'),
(3, 4, 'Харченко', 'Андрей', '+7(901)278-27-68', 'Старший инструктор', 'Пройдена'),
(4, 5, 'Горнушкин', 'Максим', '+7(906)529-60-38', 'Основной состав', 'Пройдена'),
(5, 6, 'Бабкин', 'Андрей', '+7(996)241-54-98', 'Запасной состав', 'Не пройдена'),
(6, 7, 'Сидоров', 'Андрей', '+7(915)973-91-43', 'Основной состав', 'Пройдена частично'),
(7, 8, 'Вельский', 'Вадим', '+7(917)534-90-34', 'Стажировка', 'Пройдена частично'),
(8, 9, 'Чупрасов', 'Максим', '+7(903)692-04-56', 'Запасной состав', 'Не пройдена');

-- --------------------------------------------------------

--
-- Структура таблицы `instructor_timeslots`
--

CREATE TABLE `instructor_timeslots` (
  `id` int(11) NOT NULL,
  `instructor_id` int(11) DEFAULT NULL,
  `slot_id` int(11) DEFAULT NULL,
  `total_capacity` smallint(6) DEFAULT NULL,
  `remaining_capacity` smallint(6) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `instructor_timeslots`
--

INSERT INTO `instructor_timeslots` (`id`, `instructor_id`, `slot_id`, `total_capacity`, `remaining_capacity`) VALUES
(1, 1, 1, 4, 4),
(2, 2, 1, 4, 4),
(3, 3, 1, 4, 4),
(4, 4, 1, 4, 4),
(5, 6, 1, 4, 4),
(6, 1, 2, 4, 4),
(7, 2, 2, 4, 4),
(8, 3, 2, 4, 4),
(9, 4, 2, 4, 4),
(10, 6, 2, 4, 4),
(11, 1, 3, 4, 4),
(12, 2, 3, 4, 4),
(13, 3, 3, 4, 4),
(14, 4, 3, 4, 4),
(15, 6, 3, 4, 4),
(16, 1, 4, 4, 4),
(17, 2, 4, 4, 4),
(18, 3, 4, 4, 4),
(19, 4, 4, 4, 4),
(20, 5, 4, 4, 4),
(21, 6, 4, 4, 4),
(22, 1, 5, 4, 4),
(23, 2, 5, 4, 4),
(24, 3, 5, 4, 4),
(25, 4, 5, 4, 4),
(26, 6, 6, 4, 4),
(27, 7, 6, 4, 4),
(28, 7, 7, 4, 4),
(29, 8, 7, 4, 0);

-- --------------------------------------------------------

--
-- Структура таблицы `roles`
--

CREATE TABLE `roles` (
  `role_id` int(11) NOT NULL,
  `name` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `roles`
--

INSERT INTO `roles` (`role_id`, `name`) VALUES
(1, 'admin'),
(2, 'instructor'),
(3, 'client');

-- --------------------------------------------------------

--
-- Структура таблицы `services`
--

CREATE TABLE `services` (
  `service_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text,
  `duration` decimal(5,2) NOT NULL,
  `price` decimal(10,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `services`
--

INSERT INTO `services` (`service_id`, `name`, `description`, `duration`, `price`) VALUES
(1, 'Прогулка', 'Парусные прогулки — это час безмятежного отдыха, полного расслабления и незабываемых впечатлений. И все это на наших красивых яхтах с опытными инструкторами, которые возьмут управление на себя — вам остается только наслаждаться.', 0.95, 1500),
(2, 'Тренировка', 'Присоединяйтесь к нам для увлекательной тренировки на яхте под руководством опытных инструкторов. Ощутите адреналин, покоряя волны, и углубите свои навыки парусного спорта в непринужденной атмосфере. Независимо от вашего уровня подготовки, наши тренировки обеспечат вам важный опыт, испытание своих сил и радость от улучшения навыков управления яхтой.', 1.95, 2000),
(3, 'Регата', 'Примите вызов и участвуйте в захватывающей регате на яхтах J70. Вас ждут не только эмоциональные ощущения и яркие впечатления, но и возможность продемонстрировать свои навыки в парусных гонках. Присоединяйтесь к нашей команде и почувствуйте дух соревнования, азарт и коллективный дух командной работы.', 2.95, 3000);

-- --------------------------------------------------------

--
-- Структура таблицы `timeslots`
--

CREATE TABLE `timeslots` (
  `slot_id` int(11) NOT NULL,
  `service_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `time_start` time NOT NULL,
  `time_finish` time NOT NULL,
  `total_capacity` smallint(6) NOT NULL,
  `remaining_capacity` smallint(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `timeslots`
--

INSERT INTO `timeslots` (`slot_id`, `service_id`, `date`, `time_start`, `time_finish`, `total_capacity`, `remaining_capacity`) VALUES
(1, 1, '2024-05-06', '10:00:00', '10:57:00', 12, 12),
(2, 2, '2024-05-06', '10:00:00', '11:57:00', 12, 12),
(3, 1, '2024-05-06', '11:00:00', '11:57:00', 12, 12),
(4, 3, '2024-05-06', '12:00:00', '14:57:00', 24, 24),
(5, 2, '2024-05-06', '15:00:00', '16:57:00', 16, 16),
(6, 1, '2024-05-06', '15:00:00', '15:57:00', 8, 8),
(7, 1, '2024-05-06', '17:00:00', '17:57:00', 8, 4);

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role_id` int(11) NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`user_id`, `email`, `password`, `role_id`, `created`) VALUES
(1, 'admin@yaryachts.ru', '$2y$10$JQCGaOl/Guvf446cIs1qv.0jfg1zrN2JoIg.mGrtZ.T8ucwuQVyeK', 1, '2024-04-08 12:54:53'),
(2, 'instructor1@yaryachts.ru', '$2y$10$UPLDtmwBF.mhoo9Amy3GgeHzrojLo2T1OJW26pizodGxSy34cVTEe', 2, '2024-05-03 17:28:38'),
(3, 'instructor2@yaryachts.ru', '$2y$10$5P5mc4nCduUzTYHbdVPJqefnYLjXnGsuGtV8gQegcSGALQMfQ0O7q', 2, '2024-05-03 17:31:21'),
(4, 'instructor3@yaryachts.ru', '$2y$10$oAPC.NLtvIB47gzwYkA7s.3YLgLYWmNEhSennEOclhZZ/kB9WLj/G', 2, '2024-05-03 17:32:28'),
(5, 'instructor4@yaryachts.ru', '$2y$10$gpVcVANAVe4kjdONuaylnuS2ESL4.Ds2GhtCJlYqcP/ErR2bKP6Ty', 2, '2024-05-03 17:33:16'),
(6, 'instructor5@yaryachts.ru', '$2y$10$doVM3hb76nxTxjGAHUYmReZLiFpLMiZZ/t79qyYTtd7n9QvZG/q2W', 2, '2024-05-03 17:34:06'),
(7, 'instructor6@yaryachts.ru', '$2y$10$ss2ohPCOnDWXNFooU1O.leSzr6YqN5OajFvZxe/lp0uvmg.luMcLe', 2, '2024-05-03 17:35:07'),
(8, 'instructor7@yaryachts.ru', '$2y$10$dDYAtB7PTMLTL3vogFE./uvnPAV6u8OCRUP5JuvkoOuvGTdsk7Tlq', 2, '2024-05-03 17:36:01'),
(9, 'instructor8@yaryachts.ru', '$2y$10$oaB/zK02YfOIFGTmThO75OzRrOLFWL9Imh2vwK9FAxZpLuJ14We8u', 2, '2024-05-03 17:37:03'),
(10, 'buchin.gleb@icloud.com', '$2y$10$rZcfxHVyCBs72xtETy/DU.nVHk9ODwTnp3fSzCwFAtlVCs776Tw3q', 3, '2024-05-03 17:43:31');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`booking_id`),
  ADD KEY `client_id` (`client_id`),
  ADD KEY `slot_id` (`slot_id`),
  ADD KEY `instructor_id` (`instructor_id`);

--
-- Индексы таблицы `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`client_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Индексы таблицы `instructors`
--
ALTER TABLE `instructors`
  ADD PRIMARY KEY (`instructor_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Индексы таблицы `instructor_timeslots`
--
ALTER TABLE `instructor_timeslots`
  ADD PRIMARY KEY (`id`),
  ADD KEY `instructor_id` (`instructor_id`),
  ADD KEY `slot_id` (`slot_id`);

--
-- Индексы таблицы `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`role_id`);

--
-- Индексы таблицы `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`service_id`);

--
-- Индексы таблицы `timeslots`
--
ALTER TABLE `timeslots`
  ADD PRIMARY KEY (`slot_id`),
  ADD KEY `service_id` (`service_id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `role_id` (`role_id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `bookings`
--
ALTER TABLE `bookings`
  MODIFY `booking_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT для таблицы `clients`
--
ALTER TABLE `clients`
  MODIFY `client_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT для таблицы `instructors`
--
ALTER TABLE `instructors`
  MODIFY `instructor_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT для таблицы `instructor_timeslots`
--
ALTER TABLE `instructor_timeslots`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT для таблицы `roles`
--
ALTER TABLE `roles`
  MODIFY `role_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT для таблицы `services`
--
ALTER TABLE `services`
  MODIFY `service_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT для таблицы `timeslots`
--
ALTER TABLE `timeslots`
  MODIFY `slot_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `bookings`
--
ALTER TABLE `bookings`
  ADD CONSTRAINT `bookings_ibfk_1` FOREIGN KEY (`client_id`) REFERENCES `clients` (`client_id`),
  ADD CONSTRAINT `bookings_ibfk_2` FOREIGN KEY (`slot_id`) REFERENCES `timeslots` (`slot_id`),
  ADD CONSTRAINT `bookings_ibfk_3` FOREIGN KEY (`instructor_id`) REFERENCES `instructors` (`instructor_id`);

--
-- Ограничения внешнего ключа таблицы `clients`
--
ALTER TABLE `clients`
  ADD CONSTRAINT `clients_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

--
-- Ограничения внешнего ключа таблицы `instructors`
--
ALTER TABLE `instructors`
  ADD CONSTRAINT `instructors_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

--
-- Ограничения внешнего ключа таблицы `instructor_timeslots`
--
ALTER TABLE `instructor_timeslots`
  ADD CONSTRAINT `instructor_timeslots_ibfk_1` FOREIGN KEY (`instructor_id`) REFERENCES `instructors` (`instructor_id`),
  ADD CONSTRAINT `instructor_timeslots_ibfk_2` FOREIGN KEY (`slot_id`) REFERENCES `timeslots` (`slot_id`);

--
-- Ограничения внешнего ключа таблицы `timeslots`
--
ALTER TABLE `timeslots`
  ADD CONSTRAINT `timeslots_ibfk_1` FOREIGN KEY (`service_id`) REFERENCES `services` (`service_id`);

--
-- Ограничения внешнего ключа таблицы `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `roles` (`role_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
