-- phpMyAdmin SQL Dump
-- version 4.1.6
-- http://www.phpmyadmin.net
--
-- Хост: 127.0.0.1
-- Время создания: Мар 29 2014 г., 22:31
-- Версия сервера: 5.6.16
-- Версия PHP: 5.5.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- База данных: `workers`
--

-- --------------------------------------------------------

--
-- Структура таблицы `w_employee`
--

CREATE TABLE IF NOT EXISTS `w_employee` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(128) NOT NULL,
  `surname` varchar(128) NOT NULL,
  `post_id` int(11) NOT NULL,
  `salary` double(10,2) unsigned DEFAULT NULL,
  `description` text,
  PRIMARY KEY (`id`),
  KEY `post_id` (`post_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=23 ;

--
-- Дамп данных таблицы `w_employee`
--

INSERT INTO `w_employee` (`id`, `name`, `surname`, `post_id`, `salary`, `description`) VALUES
(1, 'Вася', 'Пупкин', 2, 600.00, ''),
(2, 'Василий', 'Чапаев', 5, NULL, ''),
(13, 'Тётя', 'Галя', 1, 2000.00, '');

-- --------------------------------------------------------

--
-- Структура таблицы `w_post`
--

CREATE TABLE IF NOT EXISTS `w_post` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(64) NOT NULL,
  `description` tinytext,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=16 ;

--
-- Дамп данных таблицы `w_post`
--

INSERT INTO `w_post` (`id`, `name`, `description`) VALUES
(1, 'Программист', ''),
(2, 'Водитель', ''),
(5, 'Верстальщик', 'HTML, CSS'),
(6, 'Слон', 'Очень большой');

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `w_employee`
--
ALTER TABLE `w_employee`
  ADD CONSTRAINT `employee_post` FOREIGN KEY (`post_id`) REFERENCES `w_post` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
