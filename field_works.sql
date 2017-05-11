-- phpMyAdmin SQL Dump
-- version 4.4.11
-- http://www.phpmyadmin.net
--
-- Хост: localhost
-- Время создания: Апр 12 2017 г., 07:56
-- Версия сервера: 5.5.39
-- Версия PHP: 5.4.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `field_works`
--

-- --------------------------------------------------------

--
-- Структура таблицы `cultures`
--

CREATE TABLE IF NOT EXISTS `cultures` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `cultures`
--

INSERT INTO `cultures` (`id`, `name`) VALUES
(7, 'Кукуруза (з)'),
(8, 'Кукуруза (с)'),
(9, 'Луг'),
(10, 'Мн.травы'),
(11, 'Овес'),
(12, 'Пастбище'),
(13, 'Подсолнечник'),
(14, 'Рапс'),
(15, 'Оз.пшеница'),
(21, 'Ячмень');

-- --------------------------------------------------------

--
-- Структура таблицы `departments`
--

CREATE TABLE IF NOT EXISTS `departments` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `departments`
--

INSERT INTO `departments` (`id`, `name`) VALUES
(6, 'Бахметьево'),
(7, 'Волынский'),
(8, 'Клитчено'),
(9, 'Ламское'),
(10, 'Мещерка'),
(11, 'Сидорковский');

-- --------------------------------------------------------

--
-- Структура таблицы `fertilizers`
--

CREATE TABLE IF NOT EXISTS `fertilizers` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `fertilizers`
--

INSERT INTO `fertilizers` (`id`, `name`) VALUES
(1, 'КАС-32'),
(2, 'Аммофос'),
(5, 'Ам.селитра'),
(6, 'Сульфат аммония');

-- --------------------------------------------------------

--
-- Структура таблицы `fertilizer_expense`
--

CREATE TABLE IF NOT EXISTS `fertilizer_expense` (
  `id` int(11) NOT NULL,
  `release_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `department_id` int(11) NOT NULL,
  `fert_plan_id` int(11) NOT NULL,
  `fertilizer_id` int(11) NOT NULL,
  `weight` float(10,3) DEFAULT NULL,
  `treated_area` float(10,3) DEFAULT NULL,
  `deviation` float(10,3) DEFAULT NULL,
  `sowing_id` int(11) NOT NULL,
  `field_id` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=62 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `fertilizer_expense`
--

INSERT INTO `fertilizer_expense` (`id`, `release_date`, `department_id`, `fert_plan_id`, `fertilizer_id`, `weight`, `treated_area`, `deviation`, `sowing_id`, `field_id`) VALUES
(52, '2017-04-10 08:20:01', 9, 25, 5, 4.000, 50.000, -0.824, 33, 74),
(54, '2017-03-21 12:46:45', 9, 23, 6, 2.000, 10.000, 0.000, 34, 74),
(55, '2017-03-21 13:00:23', 9, 32, 1, 5.000, 60.000, -2.280, 33, 74),
(56, '2017-03-21 13:00:58', 9, 32, 1, 6.000, 70.000, -1.280, 33, 74),
(57, '2017-03-21 13:04:46', 9, 24, 2, 5.000, 10.000, 3.560, 34, 74),
(58, '2017-03-21 13:05:11', 9, 23, 6, 1.000, 3.000, -0.440, 34, 74),
(59, '2017-03-21 13:06:40', 9, 23, 6, 3.000, 12.000, 1.560, 34, 74),
(60, '2017-03-21 13:07:31', 9, 23, 6, 1.000, 14.000, -0.440, 34, 74),
(61, '2017-03-21 13:08:53', 9, 32, 1, 3.000, 50.000, -4.280, 33, 74);

-- --------------------------------------------------------

--
-- Структура таблицы `fertilizer_plans`
--

CREATE TABLE IF NOT EXISTS `fertilizer_plans` (
  `id` int(11) NOT NULL,
  `culture_id` int(11) DEFAULT NULL,
  `fertilizer_id` int(11) DEFAULT NULL,
  `norm` float(10,3) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `fertilizer_plans`
--

INSERT INTO `fertilizer_plans` (`id`, `culture_id`, `fertilizer_id`, `norm`) VALUES
(23, 21, 6, 0.080),
(24, 21, 2, 0.080),
(25, 15, 5, 0.080),
(26, 8, 5, 0.100),
(27, 7, 2, 0.080),
(28, 7, 5, 0.050),
(29, 13, 6, 0.100),
(30, 14, 6, 0.080),
(31, 14, 5, 0.080),
(32, 15, 1, 0.100);

-- --------------------------------------------------------

--
-- Структура таблицы `fields`
--

CREATE TABLE IF NOT EXISTS `fields` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `department_id` int(11) DEFAULT NULL,
  `total_area` float(10,3) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=75 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `fields`
--

INSERT INTO `fields` (`id`, `name`, `department_id`, `total_area`) VALUES
(12, 'Л2', 9, 162.000),
(13, 'Л3', 9, 81.900),
(14, 'Л4', 9, 23.500),
(15, 'Л5', 9, 108.000),
(16, 'Л6', 9, 127.000),
(17, 'Л7', 9, 138.500),
(18, 'Л8', 9, 102.000),
(19, 'Л9', 9, 25.300),
(20, 'Л10', 9, 112.000),
(21, 'Л11', 9, 11.400),
(22, 'Л12', 9, 118.000),
(23, 'Л13', 9, 86.200),
(24, 'Л14', 9, 51.000),
(25, 'Л15', 9, 115.000),
(26, 'Л16', 9, 160.000),
(27, 'Л17', 9, 28.900),
(28, 'Л20', 9, 80.000),
(29, 'Л21', 9, 51.700),
(30, 'Л22', 9, 28.900),
(31, 'Л23', 9, 67.000),
(32, 'Л46', 9, 31.000),
(33, 'Л47', 9, 39.200),
(34, 'Л50', 9, 130.000),
(35, 'Л52', 9, 155.000),
(36, 'Л53', 9, 32.500),
(37, 'М1', 10, 40.000),
(38, 'Л54', 9, 18.000),
(39, 'Л64', 9, 184.000),
(40, 'Л65', 9, 39.000),
(41, 'Л66', 9, 32.300),
(42, 'Л75', 9, 170.200),
(43, 'Л76', 9, 26.000),
(44, 'Л77', 9, 115.000),
(45, 'Л80', 9, 44.200),
(46, 'Л81', 9, 121.000),
(47, 'Л82', 9, 90.900),
(48, 'Л83', 9, 104.000),
(49, 'Л85', 9, 71.200),
(50, 'Л86', 9, 157.000),
(51, 'Л87', 9, 130.000),
(52, 'Л88', 9, 118.000),
(53, 'Л89', 9, 135.000),
(54, 'Л90', 9, 181.000),
(55, 'Л91', 9, 422.200),
(56, 'М2', 10, 76.200),
(57, 'М3', 10, 50.800),
(58, 'М4', 10, 143.000),
(59, 'М5', 10, 38.400),
(60, 'М6', 10, 257.000),
(61, 'М7', 10, 95.000),
(63, 'М8', 10, 60.300),
(64, 'М9', 10, 123.000),
(65, 'М11', 10, 162.000),
(66, 'М12', 10, 28.200),
(67, 'М13', 10, 108.000),
(68, 'М14', 10, 43.400),
(69, 'М15', 10, 93.300),
(74, 'Л1', 9, 90.800);

-- --------------------------------------------------------

--
-- Структура таблицы `grades`
--

CREATE TABLE IF NOT EXISTS `grades` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `grades`
--

INSERT INTO `grades` (`id`, `name`) VALUES
(0, 'Вакула');

-- --------------------------------------------------------

--
-- Структура таблицы `previous_fert_costs`
--

CREATE TABLE IF NOT EXISTS `previous_fert_costs` (
  `id` int(11) NOT NULL,
  `fertilizer_id` int(11) NOT NULL,
  `weight` float(10,3) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `sowings`
--

CREATE TABLE IF NOT EXISTS `sowings` (
  `id` int(11) NOT NULL,
  `field_id` int(11) NOT NULL,
  `culture_id` int(11) NOT NULL,
  `area` float(10,3) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `sowings`
--

INSERT INTO `sowings` (`id`, `field_id`, `culture_id`, `area`) VALUES
(11, 12, 10, 89.000),
(13, 14, 12, 23.500),
(19, 16, 15, 127.000),
(20, 17, 15, 138.500),
(21, 18, 10, 102.000),
(22, 19, 15, 25.300),
(23, 20, 15, 112.000),
(24, 21, 15, 11.400),
(25, 22, 15, 112.000),
(26, 13, 15, 81.900),
(27, 14, 12, 23.500),
(28, 37, 15, 40.000),
(33, 74, 15, 72.800),
(34, 74, 21, 18.000);

-- --------------------------------------------------------

--
-- Структура таблицы `sowing_seeds`
--

CREATE TABLE IF NOT EXISTS `sowing_seeds` (
  `id` int(11) NOT NULL,
  `sowing_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `field_id` int(11) NOT NULL,
  `sowing_id` int(11) NOT NULL,
  `grade_id` int(11) NOT NULL,
  `reproduction` int(11) DEFAULT NULL,
  `sown_area` float(10,3) DEFAULT NULL,
  `weight` float(10,3) DEFAULT NULL,
  `deviation` float(10,3) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `sowing_seeds`
--

INSERT INTO `sowing_seeds` (`id`, `sowing_date`, `field_id`, `sowing_id`, `grade_id`, `reproduction`, `sown_area`, `weight`, `deviation`) VALUES
(1, '2016-07-14 11:15:53', 74, 34, 0, 1, 18.000, 2.000, 0.100);

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL,
  `user` varchar(45) DEFAULT NULL,
  `password` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `user`, `password`) VALUES
(0, 'admin', 'admin');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `cultures`
--
ALTER TABLE `cultures`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `fertilizers`
--
ALTER TABLE `fertilizers`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `fertilizer_expense`
--
ALTER TABLE `fertilizer_expense`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fert_exp_department_id` (`department_id`),
  ADD KEY `fert_exp_fert_plan_id` (`fert_plan_id`),
  ADD KEY `fert_exp_fertilizer_id` (`fertilizer_id`),
  ADD KEY `fert_exp_sowing_id` (`sowing_id`),
  ADD KEY `fert_exp_field_id` (`field_id`);

--
-- Индексы таблицы `fertilizer_plans`
--
ALTER TABLE `fertilizer_plans`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fplans_culture_id` (`culture_id`),
  ADD KEY `fplans_fertilizer_id` (`fertilizer_id`);

--
-- Индексы таблицы `fields`
--
ALTER TABLE `fields`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fields_department_id` (`department_id`);

--
-- Индексы таблицы `grades`
--
ALTER TABLE `grades`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `previous_fert_costs`
--
ALTER TABLE `previous_fert_costs`
  ADD PRIMARY KEY (`id`,`fertilizer_id`),
  ADD UNIQUE KEY `fertilizer_id_UNIQUE` (`fertilizer_id`),
  ADD KEY `p_fert_costs_fert_id` (`fertilizer_id`);

--
-- Индексы таблицы `sowings`
--
ALTER TABLE `sowings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sowings_field_id` (`field_id`),
  ADD KEY `sowings_culture_id` (`culture_id`);

--
-- Индексы таблицы `sowing_seeds`
--
ALTER TABLE `sowing_seeds`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sow_seeds_field_id` (`field_id`),
  ADD KEY `sow_seeds_sowing_id` (`sowing_id`),
  ADD KEY `sow_seeds_grade_id` (`grade_id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `cultures`
--
ALTER TABLE `cultures`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=22;
--
-- AUTO_INCREMENT для таблицы `departments`
--
ALTER TABLE `departments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT для таблицы `fertilizers`
--
ALTER TABLE `fertilizers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT для таблицы `fertilizer_expense`
--
ALTER TABLE `fertilizer_expense`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=62;
--
-- AUTO_INCREMENT для таблицы `fertilizer_plans`
--
ALTER TABLE `fertilizer_plans`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=33;
--
-- AUTO_INCREMENT для таблицы `fields`
--
ALTER TABLE `fields`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=75;
--
-- AUTO_INCREMENT для таблицы `previous_fert_costs`
--
ALTER TABLE `previous_fert_costs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT для таблицы `sowings`
--
ALTER TABLE `sowings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=35;
--
-- AUTO_INCREMENT для таблицы `sowing_seeds`
--
ALTER TABLE `sowing_seeds`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `fertilizer_expense`
--
ALTER TABLE `fertilizer_expense`
  ADD CONSTRAINT `fert_exp_department_id` FOREIGN KEY (`department_id`) REFERENCES `departments` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `fert_exp_fertilizer_id` FOREIGN KEY (`fertilizer_id`) REFERENCES `fertilizers` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `fert_exp_fert_plan_id` FOREIGN KEY (`fert_plan_id`) REFERENCES `fertilizer_plans` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `fert_exp_field_id` FOREIGN KEY (`field_id`) REFERENCES `fields` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `fert_exp_sowing_id` FOREIGN KEY (`sowing_id`) REFERENCES `sowings` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Ограничения внешнего ключа таблицы `fertilizer_plans`
--
ALTER TABLE `fertilizer_plans`
  ADD CONSTRAINT `fplan_cult_id` FOREIGN KEY (`culture_id`) REFERENCES `cultures` (`id`) ON DELETE SET NULL ON UPDATE NO ACTION,
  ADD CONSTRAINT `fplan_fert_id` FOREIGN KEY (`fertilizer_id`) REFERENCES `fertilizers` (`id`) ON DELETE SET NULL ON UPDATE NO ACTION;

--
-- Ограничения внешнего ключа таблицы `fields`
--
ALTER TABLE `fields`
  ADD CONSTRAINT `fields_department_id` FOREIGN KEY (`department_id`) REFERENCES `departments` (`id`) ON DELETE SET NULL ON UPDATE NO ACTION;

--
-- Ограничения внешнего ключа таблицы `previous_fert_costs`
--
ALTER TABLE `previous_fert_costs`
  ADD CONSTRAINT `p_fert_costs_fert_id` FOREIGN KEY (`fertilizer_id`) REFERENCES `fertilizers` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Ограничения внешнего ключа таблицы `sowings`
--
ALTER TABLE `sowings`
  ADD CONSTRAINT `sowings_culture_id` FOREIGN KEY (`culture_id`) REFERENCES `cultures` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `sowings_field_id` FOREIGN KEY (`field_id`) REFERENCES `fields` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Ограничения внешнего ключа таблицы `sowing_seeds`
--
ALTER TABLE `sowing_seeds`
  ADD CONSTRAINT `sow_seeds_field_id` FOREIGN KEY (`field_id`) REFERENCES `fields` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `sow_seeds_grade_id` FOREIGN KEY (`grade_id`) REFERENCES `grades` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `sow_seeds_sowing_id` FOREIGN KEY (`sowing_id`) REFERENCES `sowings` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
