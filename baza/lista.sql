-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Czas generowania: 11 Paź 2020, 10:56
-- Wersja serwera: 10.4.13-MariaDB
-- Wersja PHP: 7.2.32

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `lista`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `zadania`
--

CREATE TABLE `zadania` (
  `id` int(11) NOT NULL,
  `nazwa` text COLLATE utf8_polish_ci NOT NULL,
  `longDes` text COLLATE utf8_polish_ci NOT NULL,
  `shortDes` text COLLATE utf8_polish_ci NOT NULL,
  `data_dodania` text COLLATE utf8_polish_ci NOT NULL,
  `data_rozpo` text COLLATE utf8_polish_ci DEFAULT NULL,
  `data_zakon` text COLLATE utf8_polish_ci DEFAULT NULL,
  `aktywne` varchar(10) COLLATE utf8_polish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `zadania`
--

INSERT INTO `zadania` (`id`, `nazwa`, `longDes`, `shortDes`, `data_dodania`, `data_rozpo`, `data_zakon`, `aktywne`) VALUES
(1, 'aaa', 'ccc', 'bbb', '2020-10-06', '-', '-', 'Nie'),
(2, 'bbb', 'bbb', 'bbb', '2020-10-06', '2020-10-06', '-', 'Tak'),
(3, 'cc', 'cc', 'ccc', '2020-10-06', '2020-10-06', '2020-10-06', 'Ukończone'),
(4, 'ddd', 'ddd', 'dddd', '2020-10-06', '-', '-', 'Nie'),
(5, 'eee', 'eee', 'eeeeee', '2020-10-06', '-', '-', 'Nie'),
(6, 'ff', 'ffffff', 'fff', '2020-10-06', '2020-10-06', '-', 'Tak'),
(7, 'gg', 'gggg', 'ggg', '2020-10-06', '2020-10-06', '2020-10-06', 'Ukończone');

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `zadania`
--
ALTER TABLE `zadania`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT dla tabeli `zadania`
--
ALTER TABLE `zadania`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
