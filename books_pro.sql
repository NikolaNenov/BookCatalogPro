-- phpMyAdmin SQL Dump
-- version 4.0.4.1
-- http://www.phpmyadmin.net
--
-- Хост: 127.0.0.1
-- Време на генериране: 
-- Версия на сървъра: 5.5.32
-- Версия на PHP: 5.4.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- БД: `books_pro`
--
CREATE DATABASE IF NOT EXISTS `books_pro` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `books_pro`;

-- --------------------------------------------------------

--
-- Структура на таблица `authors`
--

CREATE TABLE IF NOT EXISTS `authors` (
  `author_id` int(11) NOT NULL AUTO_INCREMENT,
  `author_name` varchar(250) NOT NULL,
  PRIMARY KEY (`author_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=106 ;

--
-- Схема на данните от таблица `authors`
--

INSERT INTO `authors` (`author_id`, `author_name`) VALUES
(93, 'David Sklar'),
(94, 'Nathan Torkington'),
(95, 'Adam Trachtenberg'),
(96, 'Carsten Lucke'),
(97, 'Chris Shiflett'),
(98, 'Sascha Schumann'),
(99, 'Harish Rawat'),
(100, 'Jesus Castagnetto '),
(101, 'Larry Ullman');

-- --------------------------------------------------------

--
-- Структура на таблица `books`
--

CREATE TABLE IF NOT EXISTS `books` (
  `book_id` int(11) NOT NULL AUTO_INCREMENT,
  `book_title` varchar(250) NOT NULL,
  PRIMARY KEY (`book_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=84 ;

--
-- Схема на данните от таблица `books`
--

INSERT INTO `books` (`book_id`, `book_title`) VALUES
(77, 'Learning PHP 5'),
(78, 'PHP Cookbook'),
(79, 'PHP 5 Kochbuch'),
(80, 'Essential PHP Security'),
(81, 'Professional Php Programming'),
(82, 'PHP 5 Advanced: Visual Quickpro Guide');

-- --------------------------------------------------------

--
-- Структура на таблица `books_authors`
--

CREATE TABLE IF NOT EXISTS `books_authors` (
  `book_id` int(11) NOT NULL,
  `author_id` int(11) NOT NULL,
  KEY `book_id` (`book_id`),
  KEY `author_id` (`author_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Схема на данните от таблица `books_authors`
--

INSERT INTO `books_authors` (`book_id`, `author_id`) VALUES
(77, 93),
(77, 94),
(78, 93),
(78, 95),
(79, 93),
(79, 95),
(79, 96),
(80, 94),
(80, 97),
(81, 98),
(81, 99),
(81, 100),
(82, 101),
(83, 94);

-- --------------------------------------------------------

--
-- Структура на таблица `comments`
--

CREATE TABLE IF NOT EXISTS `comments` (
  `comment_id` int(11) NOT NULL AUTO_INCREMENT,
  `comment_text` text NOT NULL,
  `comment_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `book_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`comment_id`),
  KEY `book_id` (`book_id`,`user_id`),
  KEY `user_id` (`user_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=31 ;

--
-- Схема на данните от таблица `comments`
--

INSERT INTO `comments` (`comment_id`, `comment_text`, `comment_date`, `book_id`, `user_id`) VALUES
(21, 'Not very helpful with realistic web developing, more like a beginners guide.', '2013-10-22 16:40:34', 82, 4),
(23, 'Great introduction to PHP and MySQL, but it''s just that, an introduction.', '2013-10-22 16:46:03', 82, 4),
(24, 'One of the best, need a function, here it is, detail powerful and easy to read. My PHP bible', '2013-10-22 16:49:07', 78, 4),
(25, 'Great PHP reference book.', '2013-10-22 16:49:33', 78, 4),
(27, 'Very useful reference book with some great examples.', '2013-10-22 16:52:54', 78, 9),
(28, 'I have to read this one.', '2013-10-22 16:53:18', 80, 9);

-- --------------------------------------------------------

--
-- Структура на таблица `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_name` varchar(50) NOT NULL,
  `user_pass` varchar(50) NOT NULL,
  PRIMARY KEY (`user_id`),
  KEY `user_name` (`user_name`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

--
-- Схема на данните от таблица `users`
--

INSERT INTO `users` (`user_id`, `user_name`, `user_pass`) VALUES
(1, 'user', '12345'),
(9, 'kolio', '12345'),
(4, 'admin', '12345');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
