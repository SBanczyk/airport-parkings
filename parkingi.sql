-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Maj 22, 2024 at 10:34 PM
-- Wersja serwera: 10.4.32-MariaDB
-- Wersja PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `parkingi`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `parkingi`
--

CREATE TABLE `parkingi` (
  `id_parkingu` int(11) NOT NULL,
  `miasto` varchar(255) NOT NULL,
  `id_wojewodztwa` int(11) NOT NULL,
  `ulica` varchar(255) NOT NULL,
  `nr_posesji` varchar(255) NOT NULL,
  `pojemnosc` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `parkingi`
--

INSERT INTO `parkingi` (`id_parkingu`, `miasto`, `id_wojewodztwa`, `ulica`, `nr_posesji`, `pojemnosc`) VALUES
(1, 'Warszawa', 7, 'Lotnicza', '10', 1000),
(2, 'Warszawa', 7, 'Generała Modlina', '30', 800),
(3, 'Gdańsk', 11, 'Portowa', '5', 700),
(4, 'Katowice', 12, 'Lotnicza', '15', 550),
(5, 'Kraków', 6, 'Medweckiego', '20', 770),
(6, 'Poznań', 15, 'Lotniskowa', '25', 400),
(7, 'Rzeszów', 9, 'Jasionka', '40', 300),
(8, 'Wrocław', 1, 'Graniczna', '35', 860);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `rezerwacje`
--

CREATE TABLE `rezerwacje` (
  `id_rezerwacji` int(11) NOT NULL,
  `parking` int(11) NOT NULL,
  `data_rezerwacji` datetime NOT NULL,
  `data_wylotu` date NOT NULL,
  `data_przylotu` date NOT NULL,
  `nr_rejestracyjny` varchar(20) NOT NULL,
  `imie` varchar(255) NOT NULL,
  `nazwisko` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `nr_telefonu` varchar(255) NOT NULL,
  `nip` varchar(10) DEFAULT NULL,
  `koszt` float NOT NULL,
  `id_uzytkownika` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `uzytkownicy`
--

CREATE TABLE `uzytkownicy` (
  `id_uzytkownika` int(11) NOT NULL,
  `imie` varchar(255) NOT NULL,
  `nazwisko` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `haslo` varchar(255) NOT NULL,
  `nr_telefonu` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `wojewodztwa`
--

CREATE TABLE `wojewodztwa` (
  `id_wojewodztwa` int(11) NOT NULL,
  `nazwa_wojewodztwa` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `wojewodztwa`
--

INSERT INTO `wojewodztwa` (`id_wojewodztwa`, `nazwa_wojewodztwa`) VALUES
(1, 'Dolnośląskie'),
(2, 'Kujawsko-pomorskie'),
(3, 'Lubelskie'),
(4, 'Lubuskie'),
(5, 'Łódzkie'),
(6, 'Małopolskie'),
(7, 'Mazowieckie'),
(8, 'Opolskie'),
(9, 'Podkarpackie'),
(10, 'Podlaskie'),
(11, 'Pomorskie'),
(12, 'Śląskie'),
(13, 'Świętokrzyskie'),
(14, 'Warmińsko-mazurskie'),
(15, 'Wielkopolskie'),
(16, 'Zachodniopomorskie');

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `parkingi`
--
ALTER TABLE `parkingi`
  ADD PRIMARY KEY (`id_parkingu`),
  ADD KEY `id_wojewodztwa` (`id_wojewodztwa`);

--
-- Indeksy dla tabeli `rezerwacje`
--
ALTER TABLE `rezerwacje`
  ADD PRIMARY KEY (`id_rezerwacji`),
  ADD KEY `parking` (`parking`),
  ADD KEY `fk_uzytkownik` (`id_uzytkownika`);

--
-- Indeksy dla tabeli `uzytkownicy`
--
ALTER TABLE `uzytkownicy`
  ADD PRIMARY KEY (`id_uzytkownika`);

--
-- Indeksy dla tabeli `wojewodztwa`
--
ALTER TABLE `wojewodztwa`
  ADD PRIMARY KEY (`id_wojewodztwa`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `parkingi`
--
ALTER TABLE `parkingi`
  MODIFY `id_parkingu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `rezerwacje`
--
ALTER TABLE `rezerwacje`
  MODIFY `id_rezerwacji` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `uzytkownicy`
--
ALTER TABLE `uzytkownicy`
  MODIFY `id_uzytkownika` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `wojewodztwa`
--
ALTER TABLE `wojewodztwa`
  MODIFY `id_wojewodztwa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `parkingi`
--
ALTER TABLE `parkingi`
  ADD CONSTRAINT `parkingi_ibfk_1` FOREIGN KEY (`id_wojewodztwa`) REFERENCES `wojewodztwa` (`id_wojewodztwa`);

--
-- Constraints for table `rezerwacje`
--
ALTER TABLE `rezerwacje`
  ADD CONSTRAINT `fk_uzytkownik` FOREIGN KEY (`id_uzytkownika`) REFERENCES `uzytkownicy` (`id_uzytkownika`),
  ADD CONSTRAINT `rezerwacje_ibfk_1` FOREIGN KEY (`parking`) REFERENCES `parkingi` (`id_parkingu`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
