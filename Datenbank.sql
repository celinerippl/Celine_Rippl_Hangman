-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Erstellungszeit: 26. Nov 2021 um 19:51
-- Server-Version: 5.7.32
-- PHP-Version: 7.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Datenbank: `hangman`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `testWords`
--

CREATE TABLE `testWords` (
  `words` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `testWords`
--

INSERT INTO `testWords` (`words`) VALUES
('Hello'),
('Bye');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `surname` varchar(255) NOT NULL,
  `eMail` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `hash` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `Words`
--

CREATE TABLE `Words` (
  `words` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `Words`
--

INSERT INTO `Words` (`words`) VALUES
('romantic'),
('father'),
('escape'),
('photo'),
('wish'),
('blue'),
('history'),
('theory'),
('germany'),
('demon'),
('giraffe'),
('milkyway'),
('aluminium'),
('python'),
('skull'),
('deathly'),
('gift'),
('media'),
('currency'),
('duplicate'),
('arrow'),
('duck'),
('caramel'),
('hamstring'),
('ganache');

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT für exportierte Tabellen
--

--
-- AUTO_INCREMENT für Tabelle `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;