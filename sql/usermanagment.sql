/*Table structure for table `users` */

CREATE TABLE `users` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(100) DEFAULT NULL,
  `last_name` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `birthday` date DEFAULT NULL,
  UNIQUE KEY `UserID` (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/* AddUser */;

DELIMITER $$

DROP PROCEDURE IF EXISTS `moyvkus_db`.`AddUser`$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `AddUser`(
_email VARCHAR(100),
_password VARCHAR(100),
_first_name VARCHAR(100),
_last_name VARCHAR(100),
_birthday date
)
BEGIN
insert into `moyvkus_db`.`users` (`email`, `password`, `first_name`, `last_name`, `birthday`) 	values (_email, _password, _first_name, _last_name, _birthday);
END$$

DELIMITER ;

/* IsUserExits */;

DELIMITER $$

DROP PROCEDURE IF EXISTS `moyvkus_db`.`IsUserExits`$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `IsUserExits`(
_email VARCHAR(100)
)
BEGIN
	SELECT COUNT(*) as c FROM `moyvkus_db`.`users` WHERE `email` = _email;
    END$$

DELIMITER ;

/* GetUser */;

DELIMITER $$

DROP PROCEDURE IF EXISTS `moyvkus_db`.`GetUser`$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `GetUser`(
_ID INT
)
BEGIN
SELECT `FirstName`,`LastName`,`Email`,`Password` FROM `moyvkus_db`.`users` WHERE `ID`=_ID;
    END$$

DELIMITER ;

/* IsPasswordValid */;

DELIMITER $$

DROP PROCEDURE IF EXISTS `moyvkus_db`.`IsPasswordValid`$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `IsPasswordValid`(
_email VARCHAR(100)
)
BEGIN
	SELECT `password` FROM `moyvkus_db`.`users` WHERE `email`=_email;
    END$$

DELIMITER ;