-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Erstellungszeit: 07. Mai 2020 um 08:37
-- Server-Version: 10.3.16-MariaDB
-- PHP-Version: 7.3.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Datenbank: `barman-db`
--
CREATE DATABASE IF NOT EXISTS `barman-db` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `barman-db`;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `bottle`
--

DROP TABLE IF EXISTS `bottle`;
CREATE TABLE IF NOT EXISTS `bottle` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL,
  `multi` float NOT NULL DEFAULT 1,
  `port` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `cocktails`
--

DROP TABLE IF EXISTS `cocktails`;
CREATE TABLE IF NOT EXISTS `cocktails` (
  `ID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL,
  `des` varchar(255) NOT NULL,
  `picture` mediumblob NOT NULL,
  `selected` bit(1) NOT NULL DEFAULT b'0',
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `recipe`
--

DROP TABLE IF EXISTS `recipe`;
CREATE TABLE IF NOT EXISTS `recipe` (
  `cocktails_ID` int(10) UNSIGNED NOT NULL,
  `bottles_ID` int(11) NOT NULL,
  `ammount` varchar(45) NOT NULL,
  `order` int(11) NOT NULL,
  PRIMARY KEY (`cocktails_ID`,`bottles_ID`,`order`),
  KEY `fk_reciept_cocktails_idx` (`cocktails_ID`),
  KEY `fk_reciept_bottles1_idx` (`bottles_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `settings`
--

DROP TABLE IF EXISTS `settings`;
CREATE TABLE IF NOT EXISTS `settings` (
  `key` varchar(45) NOT NULL,
  `value` varchar(45) NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- TRUNCATE Tabelle vor dem Einfügen `settings`
--

TRUNCATE TABLE `settings`;
--
-- Daten für Tabelle `settings`
--

INSERT INTO `settings` (`key`, `value`) VALUES
('countPorts', '8'),
('defaultTime', '1');

--
-- Constraints der exportierten Tabellen
--

--
-- Constraints der Tabelle `recipe`
--
ALTER TABLE `recipe`
  ADD CONSTRAINT `fk_reciept_bottles1` FOREIGN KEY (`bottles_ID`) REFERENCES `bottle` (`ID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_reciept_cocktails` FOREIGN KEY (`cocktails_ID`) REFERENCES `cocktails` (`ID`) ON DELETE CASCADE ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
