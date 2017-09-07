-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1
-- Время создания: Сен 07 2017 г., 14:20
-- Версия сервера: 10.1.21-MariaDB
-- Версия PHP: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `wtc`
--
CREATE DATABASE IF NOT EXISTS `wtc` DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;
USE `wtc`;

-- --------------------------------------------------------

--
-- Структура таблицы `table_time`
--

CREATE TABLE IF NOT EXISTS `table_time` (
  `ID` int(5) NOT NULL AUTO_INCREMENT,
  `xTime` datetime(6) NOT NULL,
  `ID_phone` int(5) NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `ID_phone` (`ID_phone`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `table_user`
--

CREATE TABLE IF NOT EXISTS `table_user` (
  `ID` int(5) NOT NULL AUTO_INCREMENT,
  `FIO` text COLLATE utf8_unicode_ci NOT NULL,
  `Phone_number` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `MAC` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `GID` int(5) NOT NULL,
  PRIMARY KEY (`ID`),
  UNIQUE KEY `MAC` (`MAC`),
  UNIQUE KEY `Мобильный` (`Phone_number`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL,
  `login` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `table_time`
--
ALTER TABLE `table_time`
  ADD CONSTRAINT `table_time_ibfk_1` FOREIGN KEY (`ID_phone`) REFERENCES `table_user` (`ID`) ON DELETE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
