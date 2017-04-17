-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Gegenereerd op: 17 apr 2017 om 19:16
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
(3, '2017-04-17 15:30:08', 'b', '2017-04-17 18:00:00', 'p', 11, 'Betaald', '0000-00-00 00:00:00');

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
(3, 5, 11, 1, 'l');

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
(1, 'Avocado Special', 'Overheerlijke pizza met tomatensaus, avocado, olijven en een romige kaastopping', 6, 3),
(2, 'Pizza Tonijn', 'Heerlijke pizza met pittige tomatensaus, rode uitjes en stukjes tonijn ', 5, 2),
(3, 'Texas Buffalo', 'Pizza met pittige BBQ saus, tomaten, uitjes, en stukje biefstuk', 6, 1),
(4, 'Calzone', 'Dubbelgeslagen pizza met een tomaat, kaas en gehakt vulling', 4, 1),
(5, 'Pizza Hawai', 'Heerlijke pizza met tomatensaus, mango en schijfjes annanas', 4, 3),
(6, 'Zoute haringpizza', 'De Hollandse specialiteit, een pizza met zoute haring en uitjes.', 6, 2),
(7, 'Vier kazen pizza', 'Heerlijke pizza met een basis van tomatensaus, olijven en uitjes. Afgetopt met oude Goudse kaas, gorgonzola, brie en mozzarella.', 6, 3),
(8, 'Goornalen Special', 'Heerlijke pizza met tomatensaus, hollandse garnalen, scampi, tijgergarnalen en een topping van whiskeysaus.', 7, 2),
(9, 'Pizza Kebab', 'Zeer pittige pizza met tomatensaus, paprika, uitjes, kebab en getopt met een heerlijke kaassaus', 4, 1);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `user_login` varchar(100) NOT NULL,
  `user_pass` varchar(50) NOT NULL,
  `user_level` int(11) NOT NULL,
  `user_lastlogin` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `users`
--

INSERT INTO `users` (`user_id`, `user_login`, `user_pass`, `user_level`, `user_lastlogin`) VALUES
(1, 'admin', 'd8578edf8458ce06fbc5bb76a58c5ca4', 5, '2017-04-16 16:12:28'),
(16, 'Janita', 'd8578edf8458ce06fbc5bb76a58c5ca4', 5, '0000-00-00 00:00:00'),
(17, 'Peter', 'd8578edf8458ce06fbc5bb76a58c5ca4', 5, '0000-00-00 00:00:00'),
(7, 'geert.kruit@gmail.com', 'd8578edf8458ce06fbc5bb76a58c5ca4', 1, '2017-04-17 17:23:40'),
(15, 'Frank', 'd8578edf8458ce06fbc5bb76a58c5ca4', 5, '0000-00-00 00:00:00'),
(11, 'Geert', 'd8578edf8458ce06fbc5bb76a58c5ca4', 5, '2017-04-17 17:28:58'),
(14, 'piet.puk@gmail.com', 'd8578edf8458ce06fbc5bb76a58c5ca4', 1, '0000-00-00 00:00:00'),
(18, 'Wadeea', 'd8578edf8458ce06fbc5bb76a58c5ca4', 5, '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `user_profiles`
--

CREATE TABLE `user_profiles` (
  `profile_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `voornaam` varchar(80) NOT NULL,
  `achternaam` varchar(80) NOT NULL,
  `straat` varchar(80) NOT NULL,
  `huisnummer` int(11) NOT NULL,
  `postcode` char(6) NOT NULL,
  `woonplaats` varchar(25) NOT NULL,
  `telefoonnummer` varchar(15) NOT NULL,
  `aanhef` char(1) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `user_profiles`
--

INSERT INTO `user_profiles` (`profile_id`, `user_id`, `voornaam`, `achternaam`, `straat`, `huisnummer`, `postcode`, `woonplaats`, `telefoonnummer`, `aanhef`) VALUES
(25, 11, 'Geert', 'Kruit', 'De Waard', 124, '9734CT', 'Groningen', '06-42444949', 'D'),
(29, 14, 'Piet', 'Puk', 'Hoofdweg', 2, '9712AB', 'Groningen', '123456789', 'D'),
(28, 7, 'Geert', 'Kruit', 'De Waard', 124, '9734CT', 'Groningen', '06-42444949', 'D');

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
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT voor een tabel `producten`
--
ALTER TABLE `producten`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT voor een tabel `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT voor een tabel `user_profiles`
--
ALTER TABLE `user_profiles`
  MODIFY `profile_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
