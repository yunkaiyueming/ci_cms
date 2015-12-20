SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

CREATE DATABASE IF NOT EXISTS `ci_cms` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `ci_cms`;

CREATE TABLE IF NOT EXISTS  `book` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `book_name` varchar(45)  NOT NULL,
  `type_name` varchar(45) DEFAULT '',
  `author` varchar(45) DEFAULT '',
  `publish_date` date,
  PRIMARY KEY (id),
  KEY `book_name_key` (`book_name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS  `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_name` varchar(45) DEFAULT '0'  NOT NULL,
  `pwd` varchar(45) DEFAULT '0' NOT NULL,
  PRIMARY KEY (id),
  KEY `user_name_key` (`user_name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



