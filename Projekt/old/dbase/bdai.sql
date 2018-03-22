-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Czas generowania: 17 Gru 2017, 17:39
-- Wersja serwera: 10.1.28-MariaDB
-- Wersja PHP: 7.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `bdai`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `adresy`
--

CREATE TABLE `adresy` (
  `ID` int(11) NOT NULL,
  `MIEJSCOWOSC` varchar(255) DEFAULT NULL,
  `ULICA` varchar(255) DEFAULT NULL,
  `NUMER` varchar(255) DEFAULT NULL,
  `KOD` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Zrzut danych tabeli `adresy`
--

INSERT INTO `adresy` (`ID`, `MIEJSCOWOSC`, `ULICA`, `NUMER`, `KOD`) VALUES
(1, 'brak', 'brak', '0', '0'),
(3, 'Nysa', 'Rynek', '33/3', '48-300'),
(4, 'Nysa', 'Otmuchowska', '12/2', '48-300'),
(5, 'Trzeboszowice', 'GÅ‚Ã³wna', '125', '44-300'),
(6, 'qqq', 'aaaa', '23435345', '234234234'),
(7, 'Radoszowy', 'GÅ‚Ã³wna', '26', '47-280');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `obrazy`
--

CREATE TABLE `obrazy` (
  `ID` int(11) NOT NULL,
  `NAZWA` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `osoby`
--

CREATE TABLE `osoby` (
  `ID` int(11) NOT NULL,
  `IMIE` varchar(255) DEFAULT NULL,
  `NAZWISKO` varchar(255) DEFAULT NULL,
  `ID_ADRESY` int(11) DEFAULT NULL,
  `TELEFON` varchar(255) DEFAULT NULL,
  `EMAIL` varchar(255) DEFAULT NULL,
  `LOGIN` varchar(255) DEFAULT NULL,
  `HASLO` varchar(255) DEFAULT NULL,
  `UPRAWNIENIE` varchar(255) DEFAULT NULL,
  `NEWSLETTER` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Zrzut danych tabeli `osoby`
--

INSERT INTO `osoby` (`ID`, `IMIE`, `NAZWISKO`, `ID_ADRESY`, `TELEFON`, `EMAIL`, `LOGIN`, `HASLO`, `UPRAWNIENIE`, `NEWSLETTER`) VALUES
(3, 'Jakub', 'Kruczkowski', 3, '667787327', 'jakub.kruczkowski@o2.pl', 'jakkru', '12345', 'Administrator', '0'),
(4, 'Grzegorz', 'Kukuczka', 5, '765234564', 'gkukuczka@gmail.com', 'gkuk', '12345', 'Klient', '1'),
(5, 'admin', 'admin', 1, '000000000', 'admin@admin.admin', 'admin', 'admin', 'Administrator', '0'),
(6, 'RafaÅ‚', 'SiwoÅ„', 1, '880099221', 'rsiwon@yahoo.com', 'rafsiw', 'rafsiw', 'Administrator', '0');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `producenci`
--

CREATE TABLE `producenci` (
  `ID` int(11) NOT NULL,
  `NAZWA` varchar(255) DEFAULT NULL,
  `TELEFON` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Zrzut danych tabeli `producenci`
--

INSERT INTO `producenci` (`ID`, `NAZWA`, `TELEFON`) VALUES
(1, 'Asus', '00987654321'),
(2, 'Samsung', '00987654321'),
(3, 'Acer', '11234567890'),
(4, 'Lenovo', '881234567890'),
(5, 'Apple', '99081234567'),
(6, 'Nokia', '661234567890'),
(7, 'Sony', '00987123456'),
(8, 'LG', '81234567890'),
(9, 'Dell', '120987654321'),
(10, 'MSI', '8109812345678');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `producenci_typy`
--

CREATE TABLE `producenci_typy` (
  `ID` int(11) NOT NULL,
  `ID_PRODUCENCI` int(11) DEFAULT NULL,
  `ID_TYPY` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Zrzut danych tabeli `producenci_typy`
--

INSERT INTO `producenci_typy` (`ID`, `ID_PRODUCENCI`, `ID_TYPY`) VALUES
(1, 3, 5),
(2, 3, 1),
(3, 5, 5),
(4, 5, 1),
(6, 5, 2),
(7, 5, 3),
(8, 1, 5),
(9, 1, 1),
(10, 9, 5),
(11, 9, 2),
(12, 9, 1),
(13, 4, 5),
(14, 4, 1),
(15, 4, 2),
(16, 8, 4),
(17, 8, 3),
(18, 10, 1),
(19, 6, 3),
(20, 2, 5),
(21, 2, 1),
(22, 2, 4),
(23, 2, 3),
(24, 7, 4),
(25, 7, 3);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `produkty`
--

CREATE TABLE `produkty` (
  `ID` int(11) NOT NULL,
  `ID_PRODUCENCI_TYPY` int(11) DEFAULT NULL,
  `MODEL` varchar(255) DEFAULT NULL,
  `OPIS` varchar(255) DEFAULT NULL,
  `CENA` int(11) DEFAULT NULL,
  `ILOSC` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Zrzut danych tabeli `produkty`
--

INSERT INTO `produkty` (`ID`, `ID_PRODUCENCI_TYPY`, `MODEL`, `OPIS`, `CENA`, `ILOSC`) VALUES
(1, 23, 'S7 Edge', '<b>Przekatna ekranu [cal]:</b> 5.1 <br>\r\n\r\n<b>System operacyjny:</b> Android <br>\r\n\r\n<b>Pamiec RAM:</b> 4 GB <br>\r\n\r\n<b>Liczba rdzeni:</b> Osiem <br>\r\n\r\n<b>Pamiec wbudowana:</b> 32 GB<br>\r\n\r\n<b>Dual SIM:</b> Nie <br>\r\n\r\n<b>Kolor obudowy:</b> Zlota  ', 2400, 5),
(2, 23, 'S8', '<b>Przekatna ekranu [cal]:</b> 7.0 <br>\r\n\r\n<b>System operacyjny:</b> Android <br>\r\n\r\n<b>Pamiec RAM:</b> 8 GB <br>\r\n\r\n<b>Liczba rdzeni:</b> Dwanascie<br>\r\n\r\n<b>Pamiec wbudowana:</b> 32 GB<br>\r\n\r\n<b>Dual SIM:</b> Tak<br>\r\n\r\n<b>Kolor obudowy:</b> Czarna', 3500, 2);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `produkty_obrazy`
--

CREATE TABLE `produkty_obrazy` (
  `ID` int(11) NOT NULL,
  `ID_OBRAZY` int(11) DEFAULT NULL,
  `ID_PRODUKTY` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `produkty_transakcje`
--

CREATE TABLE `produkty_transakcje` (
  `ID` int(11) NOT NULL,
  `ID_PRODUKTY` int(11) DEFAULT NULL,
  `ID_TRANSAKCJE` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `rabaty`
--

CREATE TABLE `rabaty` (
  `ID` int(11) NOT NULL,
  `KOD` varchar(255) DEFAULT NULL,
  `ZNIZKA` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `rabaty_transakcje`
--

CREATE TABLE `rabaty_transakcje` (
  `ID` int(11) NOT NULL,
  `ID_RABATY` int(11) NOT NULL,
  `ID_TRANSAKCJI` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `transakcje`
--

CREATE TABLE `transakcje` (
  `ID` int(11) NOT NULL,
  `ID_OSOBY` int(11) DEFAULT NULL,
  `DATA_ZLOZENIA` datetime DEFAULT NULL,
  `DATA_PRZYJECIA` datetime DEFAULT NULL,
  `DATA_REALIZACJI` datetime DEFAULT NULL,
  `DATA_WPALTY` datetime DEFAULT NULL,
  `NR_FAKTURY` int(11) DEFAULT NULL,
  `FORMA_PLATNOSCI` varchar(255) DEFAULT NULL,
  `WARTOSC` int(11) DEFAULT NULL,
  `CZY_FAKTURA` tinyint(1) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `typy`
--

CREATE TABLE `typy` (
  `ID` int(11) NOT NULL,
  `NAZWA` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Zrzut danych tabeli `typy`
--

INSERT INTO `typy` (`ID`, `NAZWA`) VALUES
(1, 'Laptopy'),
(2, 'PC'),
(3, 'Smartfony'),
(4, 'Telewizory'),
(5, 'Akcesoria');

--
-- Indeksy dla zrzutów tabel
--

--
-- Indexes for table `adresy`
--
ALTER TABLE `adresy`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `KOD` (`KOD`),
  ADD KEY `NUMER` (`NUMER`);

--
-- Indexes for table `obrazy`
--
ALTER TABLE `obrazy`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `osoby`
--
ALTER TABLE `osoby`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `ID_ADRESY` (`ID_ADRESY`);

--
-- Indexes for table `producenci`
--
ALTER TABLE `producenci`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `producenci_typy`
--
ALTER TABLE `producenci_typy`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `ID_PRODUCENCI` (`ID_PRODUCENCI`),
  ADD KEY `ID_TYPY` (`ID_TYPY`);

--
-- Indexes for table `produkty`
--
ALTER TABLE `produkty`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `ID_PRODUCENCI_TYPY` (`ID_PRODUCENCI_TYPY`);

--
-- Indexes for table `produkty_obrazy`
--
ALTER TABLE `produkty_obrazy`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `ID_OBRAZY` (`ID_OBRAZY`),
  ADD KEY `ID_PRODUKTY` (`ID_PRODUKTY`);

--
-- Indexes for table `produkty_transakcje`
--
ALTER TABLE `produkty_transakcje`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `ID_TRANSAKCJE` (`ID_TRANSAKCJE`),
  ADD KEY `ID_PRODUKTY` (`ID_PRODUKTY`);

--
-- Indexes for table `rabaty`
--
ALTER TABLE `rabaty`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `KOD` (`KOD`);

--
-- Indexes for table `rabaty_transakcje`
--
ALTER TABLE `rabaty_transakcje`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `ID_RABATY` (`ID_RABATY`),
  ADD KEY `ID_TRANSAKCJI` (`ID_TRANSAKCJI`);

--
-- Indexes for table `transakcje`
--
ALTER TABLE `transakcje`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `ID_OSOBY` (`ID_OSOBY`);

--
-- Indexes for table `typy`
--
ALTER TABLE `typy`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT dla tabeli `adresy`
--
ALTER TABLE `adresy`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT dla tabeli `obrazy`
--
ALTER TABLE `obrazy`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT dla tabeli `osoby`
--
ALTER TABLE `osoby`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT dla tabeli `producenci`
--
ALTER TABLE `producenci`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT dla tabeli `producenci_typy`
--
ALTER TABLE `producenci_typy`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT dla tabeli `produkty`
--
ALTER TABLE `produkty`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT dla tabeli `produkty_obrazy`
--
ALTER TABLE `produkty_obrazy`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT dla tabeli `produkty_transakcje`
--
ALTER TABLE `produkty_transakcje`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT dla tabeli `rabaty`
--
ALTER TABLE `rabaty`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT dla tabeli `rabaty_transakcje`
--
ALTER TABLE `rabaty_transakcje`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT dla tabeli `transakcje`
--
ALTER TABLE `transakcje`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT dla tabeli `typy`
--
ALTER TABLE `typy`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Ograniczenia dla zrzutów tabel
--

--
-- Ograniczenia dla tabeli `osoby`
--
ALTER TABLE `osoby`
  ADD CONSTRAINT `osoby_ibfk_1` FOREIGN KEY (`ID_ADRESY`) REFERENCES `adresy` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ograniczenia dla tabeli `producenci_typy`
--
ALTER TABLE `producenci_typy`
  ADD CONSTRAINT `producenci_typy_ibfk_1` FOREIGN KEY (`ID_PRODUCENCI`) REFERENCES `producenci` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `producenci_typy_ibfk_2` FOREIGN KEY (`ID_TYPY`) REFERENCES `typy` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ograniczenia dla tabeli `produkty`
--
ALTER TABLE `produkty`
  ADD CONSTRAINT `produkty_ibfk_1` FOREIGN KEY (`ID_PRODUCENCI_TYPY`) REFERENCES `producenci_typy` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ograniczenia dla tabeli `produkty_obrazy`
--
ALTER TABLE `produkty_obrazy`
  ADD CONSTRAINT `produkty_obrazy_ibfk_1` FOREIGN KEY (`ID_OBRAZY`) REFERENCES `obrazy` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `produkty_obrazy_ibfk_2` FOREIGN KEY (`ID_PRODUKTY`) REFERENCES `produkty` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ograniczenia dla tabeli `produkty_transakcje`
--
ALTER TABLE `produkty_transakcje`
  ADD CONSTRAINT `produkty_transakcje_ibfk_1` FOREIGN KEY (`ID_PRODUKTY`) REFERENCES `produkty` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `produkty_transakcje_ibfk_2` FOREIGN KEY (`ID_TRANSAKCJE`) REFERENCES `transakcje` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ograniczenia dla tabeli `rabaty_transakcje`
--
ALTER TABLE `rabaty_transakcje`
  ADD CONSTRAINT `rabaty_transakcje_ibfk_1` FOREIGN KEY (`ID_TRANSAKCJI`) REFERENCES `transakcje` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `rabaty_transakcje_ibfk_2` FOREIGN KEY (`ID_RABATY`) REFERENCES `rabaty` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ograniczenia dla tabeli `transakcje`
--
ALTER TABLE `transakcje`
  ADD CONSTRAINT `transakcje_ibfk_1` FOREIGN KEY (`ID_OSOBY`) REFERENCES `osoby` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
