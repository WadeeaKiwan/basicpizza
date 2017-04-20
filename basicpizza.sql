-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Gegenereerd op: 20 apr 2017 om 15:01
-- Serverversie: 10.1.21-MariaDB
-- PHP-versie: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `basicpizza`
--
CREATE DATABASE `basicpizza` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `basicpizza`;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `categorie`
--

CREATE TABLE `categorie` (
  `categorie_id` smallint(6) NOT NULL,
  `categorie` varchar(80) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `categorie`
--

INSERT INTO `categorie` (`categorie_id`, `categorie`) VALUES
(1, 'Pizza\'s met vlees'),
(2, 'Pizza\'s met vis'),
(3, 'Vegetarische Pizza\'s');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `order`
--

CREATE TABLE `order` (
  `order_id` int(11) NOT NULL,
  `bestelmoment` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `type_bezorging` char(1) NOT NULL,
  `levermoment` datetime NOT NULL,
  `betaling` char(1) NOT NULL,
  `users_user_id` int(11) NOT NULL,
  `order_status` varchar(10) NOT NULL,
  `levering` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `order`
--

INSERT INTO `order` (`order_id`, `bestelmoment`, `type_bezorging`, `levermoment`, `betaling`, `users_user_id`, `order_status`, `levering`) VALUES
(1, '2017-04-17 14:16:17', 'b', '2017-04-17 16:30:00', 'c', 7, 'Afgeleverd', '2017-04-17 14:16:33'),
(2, '2017-04-17 15:25:04', 'b', '2017-04-17 20:00:00', 'c', 7, 'Betaald', '0000-00-00 00:00:00'),
(3, '2017-04-17 15:30:08', 'b', '2017-04-17 18:00:00', 'p', 11, 'Afgeleverd', '2017-04-18 19:34:02'),
(4, '2017-04-18 19:53:19', 'a', '2017-04-18 20:00:00', 'c', 16, 'Betaald', '0000-00-00 00:00:00'),
(5, '2017-04-18 19:53:20', 'a', '2017-04-18 20:00:00', 'p', 19, 'Afgeleverd', '2017-04-18 19:55:19'),
(6, '2017-04-18 20:01:31', 'b', '2017-04-18 21:30:00', 'p', 18, 'Betaald', '0000-00-00 00:00:00'),
(7, '2017-04-18 20:12:30', 'b', '2017-04-18 22:00:00', 'c', 7, 'Betaald', '0000-00-00 00:00:00'),
(8, '2017-04-18 20:14:32', 'a', '2017-04-18 20:30:00', 'c', 20, 'Betaald', '0000-00-00 00:00:00'),
(9, '2017-04-19 06:38:46', 'b', '2017-04-19 16:30:00', 'c', 19, 'Afgeleverd', '2017-04-19 06:41:58'),
(10, '2017-04-19 10:50:04', 'a', '2017-04-19 21:30:00', 'c', 16, 'Betaald', '0000-00-00 00:00:00'),
(11, '2017-04-19 17:58:58', 'a', '2017-04-19 19:30:00', 'c', 1, 'Betaald', '0000-00-00 00:00:00'),
(12, '2017-04-19 20:48:28', 'b', '2017-04-19 21:30:00', 'c', 7, 'Afgeleverd', '2017-04-19 20:51:15'),
(13, '2017-04-20 07:29:20', 'a', '2017-04-20 16:30:00', 'c', 21, 'Betaald', '0000-00-00 00:00:00'),
(14, '2017-04-20 11:55:33', 'a', '2017-04-20 16:30:00', 'c', 1, 'Betaald', '0000-00-00 00:00:00'),
(15, '2017-04-20 12:25:32', 'a', '2017-04-20 16:30:00', 'c', 1, 'Betaald', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `order_regel`
--

CREATE TABLE `order_regel` (
  `order_order_id` int(11) NOT NULL,
  `producten_product_id` int(11) NOT NULL,
  `order_user_id` int(11) NOT NULL,
  `aantal` smallint(6) NOT NULL,
  `grootte` char(1) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `order_regel`
--

INSERT INTO `order_regel` (`order_order_id`, `producten_product_id`, `order_user_id`, `aantal`, `grootte`) VALUES
(1, 4, 7, 1, 'l'),
(1, 2, 7, 1, 'm'),
(1, 1, 7, 1, 'l'),
(2, 9, 7, 1, 's'),
(2, 7, 7, 1, 'l'),
(3, 9, 11, 1, 'm'),
(3, 5, 11, 1, 'l'),
(4, 1, 16, 2, 'm'),
(5, 4, 19, 1, 'l'),
(6, 9, 18, 1, 'm'),
(6, 2, 18, 2, 's'),
(6, 1, 18, 1, 'l'),
(7, 1, 7, 1, 'l'),
(8, 3, 20, 1, 'm'),
(8, 8, 20, 1, 'l'),
(8, 6, 20, 1, 'm'),
(9, 8, 19, 1, 'm'),
(10, 6, 16, 1, 's'),
(11, 4, 1, 1, 's'),
(11, 9, 1, 1, 's'),
(12, 5, 7, 99, 'l'),
(13, 4, 21, 1, 'l'),
(14, 4, 1, 1, 's'),
(15, 4, 1, 1, 'm'),
(15, 351, 1, 2, 'l');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `producten`
--

CREATE TABLE `producten` (
  `product_id` int(11) NOT NULL,
  `naam` varchar(80) NOT NULL,
  `omschrijving` text NOT NULL,
  `prijs` smallint(6) NOT NULL,
  `categorie_categorie_id` smallint(6) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `producten`
--

INSERT INTO `producten` (`product_id`, `naam`, `omschrijving`, `prijs`, `categorie_categorie_id`) VALUES
(1, 'Avocado Special', 'Overheerlijke pizza met tomatensaus, avocado, olijven en een romige kaastopping', 750, 3),
(2, 'Pizza Tonijn', 'Heerlijke pizza met pittige tomatensaus, rode uitjes en stukjes tonijn ', 695, 2),
(3, 'Texas Buffalo', 'Pizza met pittige BBQ saus, tomaten, uitjes, en stukje biefstuk', 650, 1),
(4, 'Calzone', 'Dubbelgeslagen pizza met een tomaat, kaas en gehakt vulling', 495, 1),
(5, 'Pizza Hawai', 'Heerlijke pizza met tomatensaus, mango en schijfjes annanas', 350, 3),
(6, 'Zoute haringpizza', 'De Hollandse specialiteit, een pizza met zoute haring en uitjes.', 850, 2),
(7, 'Vier kazen pizza', 'Heerlijke pizza met een basis van tomatensaus, olijven en uitjes. Afgetopt met oude Goudse kaas, gorgonzola, brie en mozzarella.', 580, 3),
(8, 'Garnalen Special', 'Heerlijke pizza met tomatensaus, hollandse garnalen, scampi, tijgergarnalen en een topping van whiskeysaus.', 780, 2),
(9, 'Pizza Kebab', 'Zeer pittige pizza met tomatensaus, paprika, uitjes, kebab en getopt met een heerlijke kaassaus', 495, 1),
(351, 'Aardbeien met slagroom Pizza', 'Heerlijke zoete pizza met verse vruchten caramel en als topping aardbeien metslagroom', 750, 3);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `user_login` varchar(100) NOT NULL,
  `user_pass` char(32) NOT NULL,
  `user_level` char(1) NOT NULL,
  `user_lastlogin` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `users`
--

INSERT INTO `users` (`user_id`, `user_login`, `user_pass`, `user_level`, `user_lastlogin`) VALUES
(1, 'admin', 'd8578edf8458ce06fbc5bb76a58c5ca4', '5', '2017-04-20 11:47:28'),
(16, 'Janita', 'd8578edf8458ce06fbc5bb76a58c5ca4', '5', '2017-04-20 12:37:49'),
(17, 'Peter', 'd8578edf8458ce06fbc5bb76a58c5ca4', '5', '2017-04-18 19:54:36'),
(7, 'geert.kruit@gmail.com', 'd8578edf8458ce06fbc5bb76a58c5ca4', '1', '2017-04-19 20:47:22'),
(15, 'Frank', 'd8578edf8458ce06fbc5bb76a58c5ca4', '5', '0000-00-00 00:00:00'),
(11, 'Geert', 'd8578edf8458ce06fbc5bb76a58c5ca4', '5', '2017-04-19 20:49:39'),
(14, 'piet.puk@gmail.com', 'd8578edf8458ce06fbc5bb76a58c5ca4', '1', '0000-00-00 00:00:00'),
(18, 'Wadeea', 'd8578edf8458ce06fbc5bb76a58c5ca4', '5', '2017-04-20 11:49:05'),
(19, 'j.p.verschuur@st.hanze.nl', 'bab509abdec9dd1ce7c887d985e738f8', '1', '2017-04-19 06:38:33'),
(20, 'w.kiwan@st.hanze.nl', 'd8578edf8458ce06fbc5bb76a58c5ca4', '1', '2017-04-18 20:09:27'),
(21, 'aldershofam@umcg.nl', '51724c3e522a18af65544a806d1043cf', '1', '2017-04-20 07:29:12');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `user_profiles`
--

CREATE TABLE `user_profiles` (
  `profile_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `voornaam` varchar(40) NOT NULL,
  `achternaam` varchar(40) NOT NULL,
  `straat` varchar(25) NOT NULL,
  `huisnummer` varchar(5) NOT NULL,
  `postcode` char(6) NOT NULL,
  `woonplaats` varchar(25) NOT NULL,
  `telefoonnummer` char(10) NOT NULL,
  `aanhef` char(1) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `user_profiles`
--

INSERT INTO `user_profiles` (`profile_id`, `user_id`, `voornaam`, `achternaam`, `straat`, `huisnummer`, `postcode`, `woonplaats`, `telefoonnummer`, `aanhef`) VALUES
(25, 11, 'Geert', 'Kruit', 'De Waard', '124', '9734CT', 'Groningen', '6', 'D'),
(29, 14, 'Piet', 'Puk', 'Hoofdweg', '2', '9712AB', 'Groningen', '123456789', 'D'),
(28, 7, 'Geert', 'Kruit', 'De Waard', '124', '9734CT', 'Groningen', '6', 'D'),
(30, 19, 'Jan', 'Harms', 'boslaan', '1', '7921 L', 'Groningen', '631623324', 'D'),
(31, 20, 'Wadeea', 'Kiwan', 'Jasmijnhof', '5', '9753EA', 'Haren', '614699134', 'D'),
(32, 16, 'Janita', 'Top', 'Straat 4', '5', '6789', 'grunn', '654647084', 'M'),
(33, 1, 'Frank', 'Pons', 'Hoenderparkweg', '42', '123456', 'Apeldoorn', '611180627', 'D'),
(34, 21, 'Hilda', 'Alders', 'weetniet', '1', '9700LB', 'Groningen', '652265305', 'D');

--
-- Indexen voor geëxporteerde tabellen
--

--
-- Indexen voor tabel `categorie`
--
ALTER TABLE `categorie`
  ADD PRIMARY KEY (`categorie_id`);

--
-- Indexen voor tabel `order`
--
ALTER TABLE `order`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexen voor tabel `producten`
--
ALTER TABLE `producten`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexen voor tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexen voor tabel `user_profiles`
--
ALTER TABLE `user_profiles`
  ADD PRIMARY KEY (`profile_id`);

--
-- AUTO_INCREMENT voor geëxporteerde tabellen
--

--
-- AUTO_INCREMENT voor een tabel `categorie`
--
ALTER TABLE `categorie`
  MODIFY `categorie_id` smallint(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT voor een tabel `order`
--
ALTER TABLE `order`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT voor een tabel `producten`
--
ALTER TABLE `producten`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=352;
--
-- AUTO_INCREMENT voor een tabel `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
--
-- AUTO_INCREMENT voor een tabel `user_profiles`
--
ALTER TABLE `user_profiles`
  MODIFY `profile_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
