-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Počítač: localhost:3306
-- Vytvořeno: Pon 14. říj 2019, 12:30
-- Verze serveru: 10.2.23-MariaDB-10.2.23+maria~stretch-log
-- Verze PHP: 7.1.30-2+0~20190710.21+debian9~1.gbp011d3c

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Databáze: `MaturitaDatabase`
--

-- --------------------------------------------------------

--
-- Struktura tabulky `clanky`
--
CREATE DATABASE IF NOT EXISTS MaturitaDatabase;
USE MaturitaDatabase;
CREATE TABLE `clanky` (
  `clanky_id` int(11) NOT NULL,
  `nadpis` varchar(50) COLLATE utf8_czech_ci NOT NULL,
  `datum` date NOT NULL,
  `obsah` text COLLATE utf8_czech_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci;

--
-- Vypisuji data pro tabulku `clanky`
--

INSERT INTO `clanky` (`clanky_id`, `nadpis`, `datum`, `obsah`) VALUES
(9, 'Nový web', '2017-03-02', '<p>Dnes, 3.2.2017, byla spuštěna nová verze našeho webu.</p>\r\n<p>Budeme rádi, za jakékoliv připomínky, proto neváhejte využít naší návštěvní knihu.</p>\r\n<p>S pozdravem,<strong> Tvarové pálení.</strong></p>'),
(28, 'Lorem ipsum', '2017-03-04', '<div id=\"lipsum\">\r\n<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum imperdiet vitae dolor eu luctus. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin volutpat, turpis in pretium pellentesque, ex nibh tempor lacus, ut pharetra justo dolor rhoncus nunc. Aenean sit amet enim quis nulla iaculis convallis eu gravida nunc. Mauris id eros et ex fermentum fermentum. Praesent eros magna, congue eu placerat eget, interdum non dui. Mauris hendrerit id felis non vehicula.</p>\r\n<p>Morbi sit amet bibendum urna, sed elementum velit. Nullam eget consectetur justo. Donec lacinia eleifend facilisis. Proin volutpat mollis felis vel consectetur. In pulvinar volutpat neque, nec aliquet neque scelerisque id. Fusce tempus est a lacus fringilla placerat. Nullam at erat libero. Vivamus fringilla orci metus, ac fermentum velit molestie in. Aenean maximus dignissim suscipit. Etiam justo nisl, feugiat vel lacinia in, dapibus in ipsum. Praesent gravida interdum lectus, eu fermentum arcu laoreet in. Pellentesque id tellus enim. Integer sed varius ex. Nulla facilisi. Donec tempor enim ut ex fringilla, ut sagittis libero pulvinar.</p>\r\n<p>Sed ex leo, pharetra non pretium id, luctus eu orci. Nulla nec mi quis augue commodo sollicitudin. Suspendisse varius lorem velit, in semper neque viverra vel. Proin vel tincidunt libero. Suspendisse lacus lectus, bibendum at consectetur id, vehicula vel lectus. Fusce vitae leo egestas, placerat nisl sed, vestibulum metus. Nullam vitae tellus in elit posuere pulvinar. Etiam vel nulla augue. Praesent bibendum, leo id vehicula egestas, nibh dui sagittis augue, nec cursus mi turpis at odio. Donec quam dolor, interdum eu tempus non, elementum sit amet dolor. Sed viverra ligula et nulla scelerisque, vel cursus ex aliquet.</p>\r\n<p>Morbi pretium velit ut mauris cursus, nec tempus ex volutpat. In hac habitasse platea dictumst. Maecenas posuere neque eu sem tincidunt, sit amet sagittis tortor faucibus. Vestibulum elementum enim vitae placerat accumsan. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Quisque mattis enim viverra odio feugiat viverra sit amet sed est. Mauris sed turpis justo.</p>\r\n<p>Nullam tempus, lorem nec condimentum accumsan, augue justo venenatis nisl, sit amet hendrerit risus odio dictum magna. Cras eget elit dictum, fringilla est id, ultricies nulla. Nullam et metus et est efficitur eleifend. Donec eros risus, vestibulum nec velit non, accumsan bibendum arcu. Maecenas et nisl et ante pretium finibus pellentesque quis sem. Aenean fringilla non nulla at egestas. Phasellus viverra maximus neque. Duis molestie hendrerit fermentum. Donec convallis vestibulum mauris, ac varius dui bibendum a. Sed ullamcorper tellus et eros eleifend, vitae euismod libero imperdiet. Praesent diam sapien, porttitor eget mi eu, luctus dignissim justo. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Pellentesque convallis ante nisl, vitae sollicitudin enim laoreet sed. Sed blandit, nunc rutrum elementum tincidunt, nunc justo congue turpis, in fringilla odio dolor a nisi. Nullam nec placerat nibh.</p>\r\n</div>'),
(30, 'XSS - tinymce editor', '2017-03-14', '<p>Tinymce editor byl stáhnut z důvodů xss chyb.</p>\r\n<p>Nyní bude pouze v administraci.</p>');

-- --------------------------------------------------------

--
-- Struktura tabulky `guestbook`
--

CREATE TABLE `guestbook` (
  `ID` int(11) NOT NULL,
  `name` varchar(50) COLLATE utf8_czech_ci NOT NULL,
  `email` varchar(100) COLLATE utf8_czech_ci NOT NULL,
  `content` text COLLATE utf8_czech_ci NOT NULL,
  `ip_address` varchar(30) COLLATE utf8_czech_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci;

--
-- Vypisuji data pro tabulku `guestbook`
--

INSERT INTO `guestbook` (`ID`, `name`, `email`, `content`, `ip_address`) VALUES
(18, 'Tester', 'tester@tester.com', 'Feel free to test website. Just please, dont break it :D', '192.168.3.181'),
(20, 'SkyForce', 'skyforce@nenajdes.cz', '&@{}đĐ[]#&!', '194.228.11.13'),
(22, 'Čeněk', 'Heeeker@seznam.cz', 'Finální testing', '192.168.0.97'),
(23, 'test', 'test@test.cz', 'awfwaf', '192.168.0.110');

-- --------------------------------------------------------

--
-- Struktura tabulky `login_admin`
--

CREATE TABLE `login_admin` (
  `id` int(11) NOT NULL,
  `user_name` varchar(100) COLLATE utf8_czech_ci DEFAULT NULL,
  `user_pass` varchar(200) COLLATE utf8_czech_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci;

--
-- Vypisuji data pro tabulku `login_admin`
--

INSERT INTO `login_admin` (`id`, `user_name`, `user_pass`) VALUES
(1, 'zdenek.kratochvil', '18f4cf6a646be215878c582bfc185bb90bff9cc7'),
(2, 'admin', 'd9430b64cd28fbf16fc98682e06fee7f8fbd3f22');

--
-- Klíče pro exportované tabulky
--

--
-- Klíče pro tabulku `clanky`
--
ALTER TABLE `clanky`
  ADD PRIMARY KEY (`clanky_id`);

--
-- Klíče pro tabulku `guestbook`
--
ALTER TABLE `guestbook`
  ADD PRIMARY KEY (`ID`);

--
-- Klíče pro tabulku `login_admin`
--
ALTER TABLE `login_admin`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pro tabulky
--

--
-- AUTO_INCREMENT pro tabulku `clanky`
--
ALTER TABLE `clanky`
  MODIFY `clanky_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT pro tabulku `guestbook`
--
ALTER TABLE `guestbook`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT pro tabulku `login_admin`
--
ALTER TABLE `login_admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
