/* create database moyvkus_db */
create database if not exists `moyvkus_db`;

/* CREATE TABLE users */
CREATE TABLE `users` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(100) DEFAULT NULL,
  `last_name` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `birthday` date DEFAULT NULL,
  UNIQUE KEY `UserID` (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/* CREATE TABLE menu */
CREATE TABLE `menu` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `text` varchar(50) DEFAULT NULL,
  `url` varchar(200) DEFAULT NULL,
  UNIQUE KEY `id` (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;