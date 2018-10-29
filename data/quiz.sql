-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Erstellungszeit: 29. Okt 2018 um 16:33
-- Server-Version: 10.1.35-MariaDB
-- PHP-Version: 7.2.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Datenbank: `quiz`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `fach`
--

CREATE TABLE `fach` (
  `fid` int(11) NOT NULL,
  `fach` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Daten für Tabelle `fach`
--

INSERT INTO `fach` (`fid`, `fach`) VALUES
(1, 'Finanz und Rechnungswesen'),
(2, 'Mathematik'),
(3, 'Deutsch'),
(4, 'Französisch'),
(5, 'Englisch'),
(6, 'Technik und Umwelt'),
(7, 'Geschichte und Staatskunde'),
(8, 'IKA'),
(9, 'Wirtschaft und Recht');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `frage`
--

CREATE TABLE `frage` (
  `id` int(11) NOT NULL,
  `frage` varchar(200) NOT NULL,
  `a` varchar(100) NOT NULL,
  `b` varchar(100) NOT NULL,
  `c` varchar(100) NOT NULL,
  `d` varchar(100) NOT NULL,
  `antwort` varchar(2) NOT NULL,
  `qid` int(11) NOT NULL,
  `hatMangel` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Daten für Tabelle `frage`
--

INSERT INTO `frage` (`id`, `frage`, `a`, `b`, `c`, `d`, `antwort`, `qid`, `hatMangel`) VALUES
(4, 'Ist das eine Frage?', 'nein', 'ja', 'vielleicht', 'mir egal', '2', 4, 0),
(5, 'Wer hat das Quiz erstellt', 'ich', 'schmalstieg', 'cedi', 'SAP', '1', 4, 0),
(6, 'Wer hat keine Ideen', 'ich', 'du', 'er', 'sie', '4', 4, 0);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `note`
--

CREATE TABLE `note` (
  `id` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `fid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `quiz`
--

CREATE TABLE `quiz` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `uid` int(11) NOT NULL,
  `fid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Daten für Tabelle `quiz`
--

INSERT INTO `quiz` (`id`, `name`, `uid`, `fid`) VALUES
(1, 'BIP', 3, 9),
(2, 'Mietvertrag', 4, 9),
(3, 'Ungleichung', 3, 2),
(4, 'Conditionell', 3, 4);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `email` varchar(50) NOT NULL,
  `pwd` varchar(300) NOT NULL,
  `isTeacher` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Daten für Tabelle `users`
--

INSERT INTO `users` (`id`, `email`, `pwd`, `isTeacher`) VALUES
(2, 'rene.meisters@bwdbern.ch', '$2y$10$EK9t.1a.dD0pUwRDdeoyue.UADNd.KIQN8LU/x2vLrcmcU.mdoQhm', 2),
(3, 'dominik.schmalstieg@gmail.com', '$2y$10$Sf6tTwbYRwsZOrffFauqk.DNROvWMx4VxgjKfIJVB80w.rDDdO/C.', 1),
(4, 'cedric.girardin@bwdbern.ch', '$2y$10$Sf6tTwbYRwsZOrffFauqk.DNROvWMx4VxgjKfIJVB80w.rDDdO/C.', 0);

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `fach`
--
ALTER TABLE `fach`
  ADD PRIMARY KEY (`fid`);

--
-- Indizes für die Tabelle `frage`
--
ALTER TABLE `frage`
  ADD PRIMARY KEY (`id`),
  ADD KEY `frage_quiz` (`qid`);

--
-- Indizes für die Tabelle `note`
--
ALTER TABLE `note`
  ADD PRIMARY KEY (`id`),
  ADD KEY `note_user` (`uid`),
  ADD KEY `note_frage` (`fid`);

--
-- Indizes für die Tabelle `quiz`
--
ALTER TABLE `quiz`
  ADD PRIMARY KEY (`id`),
  ADD KEY `quiz_users` (`uid`),
  ADD KEY `quiz_fach` (`fid`);

--
-- Indizes für die Tabelle `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT für exportierte Tabellen
--

--
-- AUTO_INCREMENT für Tabelle `fach`
--
ALTER TABLE `fach`
  MODIFY `fid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT für Tabelle `frage`
--
ALTER TABLE `frage`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT für Tabelle `note`
--
ALTER TABLE `note`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT für Tabelle `quiz`
--
ALTER TABLE `quiz`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT für Tabelle `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints der exportierten Tabellen
--

--
-- Constraints der Tabelle `frage`
--
ALTER TABLE `frage`
  ADD CONSTRAINT `frage_quiz` FOREIGN KEY (`qid`) REFERENCES `quiz` (`id`);

--
-- Constraints der Tabelle `note`
--
ALTER TABLE `note`
  ADD CONSTRAINT `note_frage` FOREIGN KEY (`fid`) REFERENCES `frage` (`id`),
  ADD CONSTRAINT `note_user` FOREIGN KEY (`uid`) REFERENCES `users` (`id`);

--
-- Constraints der Tabelle `quiz`
--
ALTER TABLE `quiz`
  ADD CONSTRAINT `quiz_fach` FOREIGN KEY (`fid`) REFERENCES `fach` (`fid`),
  ADD CONSTRAINT `quiz_users` FOREIGN KEY (`uid`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
