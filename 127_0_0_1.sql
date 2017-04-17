-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1
-- Время создания: Апр 17 2017 г., 13:42
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

CREATE TABLE `table_time` (
  `ID` int(5) NOT NULL,
  `Время` datetime(6) NOT NULL,
  `ID_phone` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `table_user`
--

CREATE TABLE `table_user` (
  `ID` int(5) NOT NULL,
  `ФИО` text COLLATE utf8_unicode_ci NOT NULL,
  `Мобильный` int(15) NOT NULL,
  `MAC` varchar(20) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `table_time`
--
ALTER TABLE `table_time`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `ID_phone` (`ID_phone`);

--
-- Индексы таблицы `table_user`
--
ALTER TABLE `table_user`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `MAC` (`MAC`),
  ADD UNIQUE KEY `Мобильный` (`Мобильный`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `table_time`
--
ALTER TABLE `table_time`
  MODIFY `ID` int(5) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `table_user`
--
ALTER TABLE `table_user`
  MODIFY `ID` int(5) NOT NULL AUTO_INCREMENT;
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
