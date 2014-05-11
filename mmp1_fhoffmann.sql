-- phpMyAdmin SQL Dump
-- version 4.1.6
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Erstellungszeit: 19. Apr 2014 um 00:53
-- Server Version: 5.6.16
-- PHP-Version: 5.5.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Datenbank: `mmp1_fhoffmann`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `category`
--

CREATE TABLE IF NOT EXISTS `category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

--
-- Daten für Tabelle `category`
--

INSERT INTO `category` (`id`, `name`) VALUES
(7, 'Computer'),
(6, 'Handwerk'),
(2, 'Musik'),
(9, 'Nachhilfe'),
(1, 'Sport'),
(5, 'Sprachen'),
(8, 'Technik');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `course`
--

CREATE TABLE IF NOT EXISTS `course` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `category` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `category` (`category`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=30 ;

--
-- Daten für Tabelle `course`
--

INSERT INTO `course` (`id`, `name`, `category`) VALUES
(1, 'C#', 7),
(2, 'HTML5/CSS3', 7),
(3, 'PHP/MYSQL', 7),
(4, 'Spanisch', 5),
(5, 'Schwedisch', 5),
(6, 'Englisch', 5),
(7, 'Deutsch', 5),
(8, 'Gitarre', 2),
(9, 'Piano', 2),
(10, 'Orgel', 2),
(11, 'Schlagzeug', 2),
(12, 'Violine', 2),
(13, 'Viola', 2),
(14, 'Kontrabass', 2),
(15, 'Blockflöte', 2),
(16, 'Querflöte', 2),
(17, 'Panflöte', 2),
(18, 'Bassgitarre', 2),
(19, 'Schlagwerk', 2),
(20, 'Trommel', NULL),
(21, 'Musiktheorie', 2),
(22, 'Musikgeschichte', 2),
(23, 'Musikkomposition', 2),
(24, 'DJ', 2),
(25, 'Trompete', 2),
(26, 'Tuba', 2),
(27, 'Horn', 2),
(28, 'Posaune', 2),
(29, 'Akkordeon', 2);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `meeting`
--

CREATE TABLE IF NOT EXISTS `meeting` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `course` int(100) NOT NULL,
  `teacher` int(11) NOT NULL,
  `student` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `course` (`course`),
  KEY `teacher` (`teacher`),
  KEY `student` (`student`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `offer`
--

CREATE TABLE IF NOT EXISTS `offer` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `course` int(11) NOT NULL,
  `teacher` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `course` (`course`),
  KEY `teacher` (`teacher`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=43 ;

--
-- Daten für Tabelle `offer`
--

INSERT INTO `offer` (`id`, `course`, `teacher`) VALUES
(39, 1, 3),
(40, 2, 3),
(41, 3, 3),
(42, 7, 3);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `search`
--

CREATE TABLE IF NOT EXISTS `search` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `course` int(11) NOT NULL,
  `student` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `course` (`course`),
  KEY `student` (`student`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Daten für Tabelle `search`
--

INSERT INTO `search` (`id`, `course`, `student`) VALUES
(1, 4, 3),
(2, 5, 3);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `surname` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `is_female` tinyint(4) NOT NULL,
  `birthdate` date NOT NULL,
  `credits` int(11) NOT NULL,
  `studienfach` varchar(255) DEFAULT NULL,
  `studienjahr` int(255) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `description` text NOT NULL,
  `register_date` date NOT NULL,
  `avatar` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

--
-- Daten für Tabelle `user`
--

INSERT INTO `user` (`id`, `username`, `firstname`, `surname`, `email`, `password`, `is_female`, `birthdate`, `credits`, `studienfach`, `studienjahr`, `city`, `description`, `register_date`, `avatar`) VALUES
(3, 'Fabi', 'Fabian', 'Hoffmann', 'ragnar_@gmx.at', 'asdf', 0, '2014-04-16', 5, 'Multimedia Technology', 2013, 'Salzburg', 'Hi,\r\nich bin der Admin.\r\n\r\nBei Fragen, Anregungen und Beschwerden könnt ihr euch gerne an mich wenden.\r\n\r\nAchja ihr könnt mich Fabi nennen.', '2014-04-16', 'profile.jpg'),
(5, 'Martin', 'Martin', 'Maier', 'asdff@asd.at', 'a', 0, '0000-00-00', 0, NULL, NULL, NULL, '', '0000-00-00', ''),
(6, 'asdf', 'asd', 'asd', 'fd@a.at', 'a', 1, '0000-00-00', 0, NULL, NULL, NULL, '', '0000-00-00', ''),
(7, 'Martina_xy', 'Martina', 'Peters', 'ewr@asd.at', 'a', 1, '0000-00-00', 0, NULL, NULL, NULL, '', '0000-00-00', ''),
(8, 'a', 'a', 'a', 'asd@asd.at', 'a', 0, '0000-00-00', 0, NULL, NULL, NULL, '', '2014-04-17', '');

--
-- Constraints der exportierten Tabellen
--

--
-- Constraints der Tabelle `course`
--
ALTER TABLE `course`
  ADD CONSTRAINT `course_ibfk_1` FOREIGN KEY (`category`) REFERENCES `category` (`id`);

--
-- Constraints der Tabelle `meeting`
--
ALTER TABLE `meeting`
  ADD CONSTRAINT `meeting_ibfk_1` FOREIGN KEY (`course`) REFERENCES `course` (`id`),
  ADD CONSTRAINT `meeting_ibfk_2` FOREIGN KEY (`teacher`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `meeting_ibfk_3` FOREIGN KEY (`student`) REFERENCES `user` (`id`);

--
-- Constraints der Tabelle `offer`
--
ALTER TABLE `offer`
  ADD CONSTRAINT `offer_ibfk_1` FOREIGN KEY (`course`) REFERENCES `course` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `offer_ibfk_2` FOREIGN KEY (`teacher`) REFERENCES `user` (`id`) ON DELETE CASCADE;

--
-- Constraints der Tabelle `search`
--
ALTER TABLE `search`
  ADD CONSTRAINT `search_ibfk_1` FOREIGN KEY (`course`) REFERENCES `course` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `search_ibfk_2` FOREIGN KEY (`student`) REFERENCES `user` (`id`) ON DELETE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
