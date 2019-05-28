-- phpMyAdmin SQL Dump
-- version 3.4.11.1deb2+deb7u8
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jun 18, 2018 at 01:03 PM
-- Server version: 5.5.59
-- PHP Version: 5.4.45-0+deb7u12

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `WebDiP2017x046`
--

-- --------------------------------------------------------

--
-- Table structure for table `anon_rezervacije`
--

CREATE TABLE IF NOT EXISTS `anon_rezervacije` (
  `id_arezervacija` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(30) NOT NULL,
  `pocetak_boravka` varchar(11) NOT NULL,
  `status` int(11) NOT NULL,
  `sobe_id_soba` int(11) NOT NULL,
  `hoteli_id_hotel` int(11) NOT NULL,
  PRIMARY KEY (`id_arezervacija`),
  KEY `fk_anon_rezervacije_sobe1_idx` (`sobe_id_soba`),
  KEY `fk_anon_rezervacije_hoteli1_idx` (`hoteli_id_hotel`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `anon_rezervacije`
--

INSERT INTO `anon_rezervacije` (`id_arezervacija`, `email`, `pocetak_boravka`, `status`, `sobe_id_soba`, `hoteli_id_hotel`) VALUES
(1, 'adasd@sad.com', '2018-06-14 ', 0, 1, 1),
(2, 'lgotovac@foi.hr', '2018-06-14 ', 0, 1, 1),
(5, 'adasd@sad.com', '2018-06-14 ', 0, 2, 2),
(6, 'test@gmail.com', '2018-06-14 ', 0, 2, 2),
(7, 'test@gmail.com', '2018-06-14 ', 0, 2, 2);

-- --------------------------------------------------------

--
-- Table structure for table `dnevnik`
--

CREATE TABLE IF NOT EXISTS `dnevnik` (
  `id_zapis` int(11) NOT NULL AUTO_INCREMENT,
  `korisnik` varchar(30) NOT NULL,
  `aktivnost` varchar(45) NOT NULL,
  `vrijeme` varchar(45) NOT NULL,
  `opis` varchar(100) NOT NULL,
  PRIMARY KEY (`id_zapis`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=154 ;

--
-- Dumping data for table `dnevnik`
--

INSERT INTO `dnevnik` (`id_zapis`, `korisnik`, `aktivnost`, `vrijeme`, `opis`) VALUES
(1, '', 'Registracija', '2018/06/14 00:06:22', 'Registracija novog racuna: iivek sa e-mail adresom: lgotovac@foi.hr'),
(2, '', 'Registracija', '2018/06/14 00:09:53', 'Registracija novog racuna: llukic sa e-mail adresom: lukagtvc@gmail.com'),
(3, '', 'Registracija', '2018/06/14 00:11:18', 'Registracija novog racuna: llukic sa e-mail adresom: lukagtvc@gmail.com'),
(4, '', 'Registracija', '2018/06/14 00:21:46', 'Registracija novog racuna: test sa e-mail adresom: lukagtvc@gmail.com'),
(5, '', 'Registracija', '2018/06/14 00:24:14', 'Registracija novog racuna: test sa e-mail adresom: lukagtvc@gmail.com'),
(6, '', '', '2018-06-14 01:50:57', 'Korisnik test se odjavio'),
(7, '', 'Prijava', '2018-06-14 01:52:00', 'Korisnik test se prijavio'),
(8, '', '', '2018-06-14 01:52:02', 'Korisnik test se odjavio'),
(9, '', 'Prijava', '2018-06-14 02:01:13', 'Korisnik test se prijavio'),
(10, '', '', '2018-06-14 02:01:16', 'Korisnik test se odjavio'),
(11, '', 'Prijava', '2018-06-14 02:04:12', 'Korisnik test se prijavio'),
(12, '', '', '2018-06-14 02:04:15', 'Korisnik test se odjavio'),
(13, '', 'Prijava', '2018-06-14 02:16:54', 'Korisnik test se prijavio'),
(14, '', '', '2018-06-14 02:17:00', 'Korisnik test se odjavio'),
(15, '', 'Prijava', '2018-06-14 02:21:48', 'Korisnik jradic se prijavio'),
(16, '', '', '2018-06-14 02:28:05', 'Korisnik jradic se odjavio'),
(17, '', 'Prijava', '2018-06-14 02:46:07', 'Korisnik jradic se prijavio'),
(18, '', '', '2018-06-14 02:46:32', 'Korisnik jradic se odjavio'),
(19, '', 'Prijava', '2018/06/14 03:05:46', 'Korisnik test se prijavio'),
(20, '', '', '2018-06-14 03:05:48', 'Korisnik test se odjavio'),
(21, '', 'Rezervacija', '2018-06-14 05:37:00', 'Rezervirana soba sa ID: '),
(22, '', 'Rezervacija', '2018-06-14 05:38:02', 'Rezervirana soba sa ID: '),
(23, '', 'Rezervacija', '2018-06-14 05:38:49', 'Rezervirana soba sa ID: '),
(24, '', 'Rezervacija', '2018-06-14 05:49:48', 'Rezervirana soba sa ID: '),
(25, '', 'Rezervacija', '2018-06-14 05:50:17', 'Rezervirana soba sa ID: '),
(26, '', 'Rezervacija', '2018-06-14 05:53:56', 'Rezervirana soba sa ID: '),
(27, '', 'Prijava', '2018/06/14 05:59:53', 'Korisnik test se prijavio'),
(28, '', '', '2018/06/14 06:00:06', 'Korisnik test se odjavio'),
(29, '', 'Prijava', '2018/06/14 06:06:28', 'Korisnik mkovac se prijavio'),
(30, '', 'Odjava', '2018/06/14 06:10:17', 'Korisnik mkovac se odjavio'),
(31, '', 'Prijava', '2018/06/14 06:48:30', 'Korisnik jradic se prijavio'),
(32, '', 'Odjava', '2018/06/14 07:05:23', 'Korisnik jradic se odjavio'),
(33, '', 'Rezervacija', '2018-06-14 07:11:17', 'Rezervirana soba sa ID: 2'),
(34, '', 'Rezervacija', '2018-06-14 07:13:42', 'Rezervirana soba sa ID: 2'),
(35, '', 'Rezervacija', '2018-06-14 07:15:46', 'Rezervirana soba sa ID: 1'),
(36, '', 'Rezervacija', '2018-06-14 07:16:03', 'Rezervirana soba sa ID: 1'),
(37, '', 'Rezervacija', '2018-06-14 07:16:39', 'Rezervirana soba sa ID: 1'),
(38, '', 'Rezervacija', '2018-06-14 07:17:36', 'Rezervirana soba sa ID: 2'),
(39, '', 'Rezervacija', '2018-06-14 07:19:55', 'Rezervirana soba sa ID: 2'),
(40, '', 'Prijava', '2018/06/14 07:26:07', 'Korisnik jradic se prijavio'),
(41, '', 'Odjava', '2018/06/14 07:26:14', 'Korisnik jradic se odjavio'),
(42, '', 'Prijava', '2018/06/14 07:26:29', 'Korisnik kpopovic se prijavio'),
(43, '', 'Odjava', '2018/06/14 07:26:38', 'Korisnik kpopovic se odjavio'),
(44, '', 'Rezervacija', '2018-06-14 07:34:51', 'Rezervirana soba sa ID: 2'),
(45, '', 'Registracija', '2018/06/14 07:36:58', 'Registracija novog racuna: asdasd sa e-mail adresom: lgotovac@foi.hr'),
(46, '', 'Prijava', '2018/06/14 07:37:58', 'Korisnik asdasd se prijavio'),
(47, '', 'Odjava', '2018/06/14 07:37:59', 'Korisnik asdasd se odjavio'),
(48, '', 'Prijava', '2018/06/14 07:41:18', 'Korisnik asdasd se prijavio'),
(49, '', 'Odjava', '2018/06/14 07:41:19', 'Korisnik asdasd se odjavio'),
(50, '', 'Prijava', '2018/06/14 07:59:26', 'Korisnik mkovac se prijavio'),
(51, '', 'Odjava', '2018/06/14 08:01:07', 'Korisnik mkovac se odjavio'),
(52, '', 'Prijava', '2018/06/14 08:02:06', 'Korisnik jradic se prijavio'),
(53, '', 'Odjava', '2018/06/14 08:02:10', 'Korisnik jradic se odjavio'),
(54, '', 'Prijava', '2018/06/14 08:10:49', 'Korisnik jradic se prijavio'),
(55, '', 'Odjava', '2018/06/14 08:10:57', 'Korisnik jradic se odjavio'),
(56, '', 'Prijava', '2018/06/14 09:06:20', 'Korisnik mkovac se prijavio'),
(57, '', 'Odjava', '2018/06/14 09:06:22', 'Korisnik mkovac se odjavio'),
(58, '', 'Registracija', '2018/06/14 09:13:38', 'Registracija novog racuna: ttester sa e-mail adresom: yevujar@dumoac.net'),
(59, '', 'Prijava', '2018/06/14 09:15:03', 'Korisnik ttester se prijavio'),
(60, '', 'Prijava', '2018/06/14 09:16:10', 'Korisnik mkovac se prijavio'),
(61, '', 'Registracija', '2018/06/14 09:18:13', 'Registracija novog racuna: iivic sa e-mail adresom: biha@nickrizos.com'),
(62, '', 'Prijava', '2018/06/14 09:22:09', 'Korisnik mkovac se prijavio'),
(63, '', 'Odjava', '2018/06/14 09:22:13', 'Korisnik mkovac se odjavio'),
(64, '', 'Odjava', '2018/06/14 09:24:42', 'Korisnik mkovac se odjavio'),
(65, '', 'Rezervacija', '2018-06-14 09:30:22', 'Rezervirana soba sa ID: 2'),
(66, '', 'Rezervacija', '2018-06-14 09:33:04', 'Rezervirana soba sa ID: 2'),
(67, '', 'Prijava', '2018/06/16 19:24:21', 'Korisnik iivic se prijavio'),
(68, '', 'Prijava', '2018/06/17 23:53:56', 'Korisnik: vhorvat se prijavio'),
(69, '', 'Prijava', '2018/06/17 23:54:36', 'Korisnik: nbunac se prijavio'),
(70, '', 'Odjava', '2018/06/17 23:55:04', 'Korisnik nbunac se odjavio'),
(71, '', 'Prijava', '2018/06/17 23:55:20', 'Korisnik: tjuric se prijavio'),
(72, '', 'Odjava', '2018/06/17 23:55:39', 'Korisnik tjuric se odjavio'),
(73, '', 'Prijava', '2018/06/18 00:15:06', 'Korisnik: vhorvat se prijavio'),
(74, '', 'Prijava', '2018/06/18 00:15:36', 'Korisnik: vhorvat se prijavio'),
(75, '', 'Novi zahtjev za blokiranje oglasa', '2018/06/18 01:19:18', 'Zahtjev za blokiranje oglasa pod ID: 9'),
(76, '', 'Novi zahtjev za blokiranje oglasa', '2018/06/18 01:20:18', 'Zahtjev za blokiranje oglasa pod ID: 9'),
(77, '', 'Prijava', '2018/06/18 03:55:46', 'Korisnik: vhorvat se prijavio'),
(78, 'vhorvat', 'Novi zahtjev za oglas', '2018/06/18 03:58:52', 'Zahtjev za novi oglas'),
(79, 'vhorvat', 'Novi zahtjev za oglas', '2018/06/18 04:01:10', 'Zahtjev za novi oglas'),
(80, 'vhorvat', 'Novi zahtjev za oglas', '2018/06/18 04:09:33', 'Zahtjev za novi oglas'),
(81, 'vhorvat', 'Novi zahtjev za oglas', '2018/06/18 04:15:41', 'Zahtjev za novi oglas'),
(82, 'vhorvat', 'Novi zahtjev za oglas', '2018/06/18 04:19:58', 'Zahtjev za novi oglas'),
(83, 'vhorvat', 'Novi zahtjev za oglas', '2018/06/18 04:21:30', 'Zahtjev za novi oglas'),
(84, 'vhorvat', 'Novi zahtjev za oglas', '2018/06/18 04:25:01', 'Zahtjev za novi oglas'),
(85, 'vhorvat', 'Novi zahtjev za oglas', '2018/06/18 04:30:47', 'Zahtjev za novi oglas'),
(86, 'vhorvat', 'Novi zahtjev za oglas', '2018/06/18 04:34:02', 'Zahtjev za novi oglas'),
(87, 'vhorvat', 'Novi zahtjev za oglas', '2018/06/18 04:36:33', 'Zahtjev za novi oglas'),
(88, 'vhorvat', 'Novi zahtjev za oglas', '2018/06/18 04:39:46', 'Zahtjev za novi oglas'),
(89, 'vhorvat', 'Novi zahtjev za oglas', '2018/06/18 04:42:03', 'Zahtjev za novi oglas'),
(90, 'vhorvat', 'Novi zahtjev za oglas', '2018/06/18 04:46:29', 'Zahtjev za novi oglas'),
(91, 'vhorvat', 'Novi zahtjev za oglas', '2018/06/18 04:47:50', 'Zahtjev za novi oglas'),
(92, 'vhorvat', 'Uredivanje zahtjeva za oglas', '2018/06/18 05:13:25', 'Zahtjev za novi oglas je ureden'),
(93, 'vhorvat', 'Uredivanje zahtjeva za oglas', '2018/06/18 05:20:29', 'Zahtjev za novi oglas je ureden'),
(94, '', 'Prijava', '2018/06/18 07:14:23', 'Korisnik: mbabic se prijavio'),
(95, '', 'Odjava', '2018/06/18 07:25:15', 'Korisnik mbabic se odjavio'),
(96, '', 'Prijava', '2018/06/18 07:25:42', 'Korisnik: lmodric se prijavio'),
(97, 'lmodric', 'Novi zahtjev za oglas', '2018/06/18 07:26:42', 'Zahtjev za novi oglas'),
(98, '', 'Prijava', '2018/06/18 07:27:31', 'Korisnik: mbabic se prijavio'),
(99, 'mbabic', 'Odbijen zahtjev za oglas', '2018/06/18 07:49:18', 'Zahtjev za oglas ID:26 je odbijen'),
(100, 'mbabic', 'Prihvacen zahtjev za oglas', '2018/06/18 07:49:50', 'Zahtjev za oglas ID:26 je prihvacen'),
(101, 'mbabic', 'Prihvacen zahtjev i blokiranje oglasa', '2018/06/18 08:28:29', 'Zahtjev za blokiranje ID:2 je prihvacen i blokiran je'),
(102, '', 'Odjava', '2018/06/18 08:28:57', 'Korisnik mbabic se odjavio'),
(103, '', 'Prijava', '2018/06/18 08:30:20', 'Korisnik: mbabic se prijavio'),
(104, 'mbabic', 'Odbijen zahtjev za blokiranje oglasa', '2018/06/18 08:31:44', 'Zahtjev za blokiranje ID:2 je odbijen'),
(105, 'mbabic', 'Unesena nova soba za hotel ID: ', '2018/06/18 09:05:57', 'Unesena je soba broj: 443u hotel ID: '),
(106, 'mbabic', 'Unesena nova soba za hotel ID: 6', '2018/06/18 09:09:48', 'Unesena je soba broj: 409 u hotel ID: 6'),
(107, 'mbabic', 'Unesena nova soba za hotel ID: 6', '2018/06/18 09:11:04', 'Unesena je soba broj: 409 u hotel ID: 6'),
(108, '', 'Nova rezervacija', '2018/06/18 09:47:34', 'Nova rezervacija: Korisnik: 25, soba ID: 1 u hotel ID: '),
(109, '', 'Nova rezervacija', '2018/06/18 09:54:15', 'Nova rezervacija: Korisnik ID: 25, soba ID: 1 u hotel ID: '),
(110, '', 'Nova rezervacija', '2018/06/18 09:55:46', 'Nova rezervacija: Korisnik ID: 27, soba ID: 1 u hotel ID: '),
(111, '', 'Nova rezervacija', '2018/06/18 09:56:53', 'Nova rezervacija: Korisnik ID: 27, soba ID: 1 u hotel ID: '),
(112, '', 'Nova rezervacija', '2018/06/18 09:59:46', 'Nova rezervacija: Korisnik ID: 27, soba ID: 1 u hotel ID: '),
(113, '', 'Nova rezervacija', '2018/06/18 10:04:34', 'Nova rezervacija: Korisnik ID: 26, soba ID: 1 u hotel ID: '),
(114, '', 'Odjava', '2018/06/18 10:20:28', 'Korisnik mbabic se odjavio'),
(115, '', 'Prijava', '2018/06/18 10:20:36', 'Korisnik: mkovac se prijavio'),
(116, 'mkovac', 'Zakljucan korisnik', '2018/06/18 10:45:03', 'Zakljucan je racun korisnika sa ID: 26'),
(117, 'mkovac', 'Otkljucan korisnik', '2018/06/18 10:45:05', 'Otkljucan je racun korisnika sa ID: 26'),
(118, 'mkovac', 'Zakljucan korisnik', '2018/06/18 10:45:07', 'Zakljucan je racun korisnika sa ID: 26'),
(119, 'mkovac', 'Otkljucan korisnik', '2018/06/18 10:45:14', 'Otkljucan je racun korisnika sa ID: 26'),
(120, '', 'Odjava', '2018/06/18 11:05:19', 'Korisnik mkovac se odjavio'),
(121, '', 'Prijava', '2018/06/18 12:13:12', 'Korisnik: mkovac se prijavio'),
(122, '', 'Odjava', '2018/06/18 12:13:14', 'Korisnik mkovac se odjavio'),
(123, '', 'Prijava', '2018/06/18 12:13:31', 'Korisnik: mkovac se prijavio'),
(124, '', 'Odjava', '2018/06/18 12:13:33', 'Korisnik mkovac se odjavio'),
(125, '', 'Prijava', '2018/06/18 12:13:52', 'Korisnik: mkovac se prijavio'),
(126, '', 'Odjava', '2018/06/18 12:13:56', 'Korisnik mkovac se odjavio'),
(127, '', 'Prijava', '2018/06/18 12:15:11', 'Korisnik: mkovac se prijavio'),
(128, 'mkovac', 'Otkljucan korisnik', '2018/06/18 12:15:31', 'Otkljucan je racun korisnika sa ID: 25'),
(129, 'mkovac', 'Zakljucan korisnik', '2018/06/18 12:15:59', 'Zakljucan je racun korisnika sa ID: 23'),
(130, '', 'Odjava', '2018/06/18 12:19:25', 'Korisnik mkovac se odjavio'),
(131, '', 'Prijava', '2018/06/18 12:20:02', 'Korisnik: mbabic se prijavio'),
(132, 'mbabic', 'Prihvacen zahtjev i blokiranje oglasa', '2018/06/18 12:21:32', 'Zahtjev za blokiranje ID:2 je prihvacen i blokiran je'),
(133, '', 'Odjava', '2018/06/18 12:21:38', 'Korisnik mbabic se odjavio'),
(134, '', 'Prijava', '2018/06/18 12:22:38', 'Korisnik: mbabic se prijavio'),
(135, '', 'Odjava', '2018/06/18 12:22:45', 'Korisnik mbabic se odjavio'),
(136, '', 'Prijava', '2018/06/18 12:22:59', 'Korisnik: dlovren se prijavio'),
(137, '', 'Novi zahtjev za blokiranje oglasa', '2018/06/18 12:23:10', 'Zahtjev za blokiranje oglasa pod ID: 27'),
(138, '', 'Prijava', '2018/06/18 12:23:18', 'Korisnik: mbabic se prijavio'),
(139, 'mbabic', 'Prihvacen zahtjev i blokiranje oglasa', '2018/06/18 12:23:24', 'Zahtjev za blokiranje ID:3 je prihvacen i blokiran je'),
(140, '', 'Odjava', '2018/06/18 12:23:46', 'Korisnik mbabic se odjavio'),
(141, '', 'Prijava', '2018/06/18 12:23:53', 'Korisnik: dlovren se prijavio'),
(142, 'dlovren', 'Novi zahtjev za oglas', '2018/06/18 12:24:59', 'Zahtjev za novi oglas'),
(143, '', 'Prijava', '2018/06/18 12:27:31', 'Korisnik: mbabic se prijavio'),
(144, '', 'Prijava', '2018/06/18 12:27:54', 'Korisnik: dlovren se prijavio'),
(145, 'dlovren', 'Uredivanje zahtjeva za oglas', '2018/06/18 12:29:19', 'Zahtjev za novi oglas je ureden'),
(146, '', 'Nova rezervacija', '2018/06/18 12:35:28', 'Nova rezervacija: Korisnik ID: 26, soba ID: 2 u hotel ID: '),
(147, '', 'Odjava', '2018/06/18 12:37:13', 'Korisnik mbabic se odjavio'),
(148, '', 'Registracija', '2018/06/18 12:38:52', 'Registracija novog racuna: abcde sa e-mail adresom: lgotovac@foi.hr'),
(149, '', 'Zaboravljena lozinka', '2018/06/18 12:39:01', 'Korisnik: abcde je zatrazio novu lozinku'),
(150, '', 'Prijava', '2018/06/18 12:39:41', 'Korisnik: abcde se prijavio'),
(151, '', 'Prijava', '2018/06/18 12:39:56', 'Korisnik: abcde se prijavio'),
(152, '', 'Prijava', '2018/06/18 12:40:35', 'Korisnik: mkovac se prijavio'),
(153, '', 'Odjava', '2018/06/18 12:43:49', 'Korisnik mkovac se odjavio');

-- --------------------------------------------------------

--
-- Table structure for table `hoteli`
--

CREATE TABLE IF NOT EXISTS `hoteli` (
  `id_hotel` int(11) NOT NULL AUTO_INCREMENT,
  `naziv` varchar(30) NOT NULL,
  `adresa` varchar(50) NOT NULL,
  `ocjena` int(11) NOT NULL,
  PRIMARY KEY (`id_hotel`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=26 ;

--
-- Dumping data for table `hoteli`
--

INSERT INTO `hoteli` (`id_hotel`, `naziv`, `adresa`, `ocjena`) VALUES
(1, 'Hotel Zagreb', 'Zagrebacka 3, 10000, Zagreb', 5),
(2, 'Hotel Park', 'Osjecka 4, 31000, Osijek', 3),
(3, 'Hotel Sky', 'Zagrebacka 1, 10000, Zagreb', 4),
(4, 'Hotel Concordia', 'Dankovecka 42, 10040, Zagreb', 4),
(5, 'Hotel Magnus', 'Splitska 21, 21000, Split', 5),
(6, 'Hotel Infinity', 'Vukovarska 12, 10000, Zagreb', 4),
(7, 'Hotel Star', 'Varaždinska 32, 42000, Varaždin', 4),
(8, 'Hotel Pula', 'Zagrebacka 21, 52100, Pula', 3),
(9, 'Hotel Rijeka', 'Vukovarska 3, 51000, Rijeka', 5),
(10, 'Hotel Zadar', 'Zadarska 32, 23000, Zadar', 4),
(11, 'Hotel Apple', 'Splitska 22, 21000, Split', 4),
(12, 'Hotel Banana', 'Splitska 23, 21000, Split', 5),
(13, 'Hotel Castle', 'Splitska 26, 21000, Split', 5),
(14, 'Hotel England', 'Splitska 31, 21000, Split', 3),
(15, 'Hotel France', 'Splitska 41, 21000, Split', 4),
(16, 'Hotel Japan', 'Splitska 61, 21000, Split', 4),
(17, 'Hotel Jungle', 'Splitska 71, 21000, Split', 5),
(18, 'Hotel Oceania', 'Splitska 55, 21000, Split', 3),
(19, 'Hotel Supreme', 'Splitska 29, 21000, Split', 5),
(20, 'Hotel Lucky 44', 'Splitska 44, 21000, Split', 4),
(21, 'Hotel Jordan', 'Zagrebacka 23, 10000, Zagreb', 5),
(22, 'Hotel Escape', 'Zagrebacka 33, 10000, Zagreb', 4),
(23, 'Hotel Croatia', 'Zagrebacka 55, 10000, Zagreb', 5),
(24, 'Hotel Island', 'Zagrebacka 16, 10000, Zagreb', 4),
(25, 'Hotel Enjoy', 'Zagrebacka 65, 10000, Zagreb', 4);

-- --------------------------------------------------------

--
-- Table structure for table `korisnici`
--

CREATE TABLE IF NOT EXISTS `korisnici` (
  `id_korisnik` int(11) NOT NULL AUTO_INCREMENT,
  `korisnicko_ime` varchar(20) NOT NULL,
  `ime` varchar(45) NOT NULL,
  `prezime` varchar(45) NOT NULL,
  `email` varchar(45) NOT NULL,
  `lozinka` varchar(100) NOT NULL,
  `kript_lozinka` varchar(100) DEFAULT NULL,
  `status` int(11) NOT NULL,
  `kriviUnosi` int(11) NOT NULL,
  `tip_korisnika_id_tip_kor` int(11) NOT NULL,
  PRIMARY KEY (`id_korisnik`),
  UNIQUE KEY `korisnicko_ime_UNIQUE` (`korisnicko_ime`),
  KEY `fk_korisnici_tip_korisnika_idx` (`tip_korisnika_id_tip_kor`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=30 ;

--
-- Dumping data for table `korisnici`
--

INSERT INTO `korisnici` (`id_korisnik`, `korisnicko_ime`, `ime`, `prezime`, `email`, `lozinka`, `kript_lozinka`, `status`, `kriviUnosi`, `tip_korisnika_id_tip_kor`) VALUES
(1, 'mkovac', 'Marko', 'Kovac', 'mkovac@gmail.com', 'mkovac123', '0', 1, 0, 3),
(2, 'jradic', 'Jelena', 'Radic', 'lukagtvc@gmail.com', '412d90240f880e1084f03ef8f17351d8489f8319', '0', 1, 0, 2),
(3, 'mbabic', 'Mirna', 'Babic', 'mbabic@gmail.com', 'mbabic123', '0', 1, 0, 2),
(4, 'kpopovic', 'Karlo', 'Popovic', 'kpopovic@gmail.com', 'kpopovic123', '0', 1, 0, 1),
(5, 'jpavic', 'Janko', 'Pavic', 'jpavic@gmail.com', 'jpavic123', '0', 1, 0, 1),
(6, 'tlovric', 'Tamara', 'Lovric', 'tlovric@gmail.com', 'tlovric123', '0', 1, 0, 1),
(7, 'ikralj', 'Ivan', 'Kralj', 'ikralj@gmail.com', 'ikralj123', '0', 1, 0, 1),
(8, 'nletica', 'Neven', 'Letica', 'nletica@gmail.com', 'nletica123', '0', 1, 0, 1),
(9, 'vhorvat', 'Vesna', 'Horvat', 'vhorvat@gmail.com', 'vhorvat123', '0', 1, 0, 1),
(10, 'mbogdan', 'Matej', 'Bogdan', 'mbogdan@gmail.com', 'mbogdan123', '0', 1, 0, 1),
(17, 'ttester', 'test', 'tester', 'yevujar@dumoac.net', '123', '7e335a1dd880dc3b89d495f17e3480f9dbaa4a43', 2, 4, 1),
(18, 'iivic', 'ivo', 'ivic', 'biha@nickrizos.com', '956d9b7d6512e1e32afbe4180a7b4ff0ccc1de5e', '539e3e875acc697ed167ea348d76a26bf31ec284', 1, 0, 1),
(19, 'vlalic', 'Vedran', 'Lalic', 'vlalic@gmail.com', 'vlalic123', NULL, 1, 0, 3),
(20, 'vtadic', 'Vjeko', 'Tadic', 'vtadic@gmail.com', 'vtadic123', NULL, 1, 0, 3),
(21, 'tjuric', 'Tena', 'Juric', 'tjuric@gmail.com', 'tjuric123', NULL, 1, 0, 3),
(22, 'kjedi', 'Karlo', 'Jedi', 'kjedi@gmail.com', 'kjedi123', NULL, 1, 0, 2),
(23, 'nbunac', 'Nenad', 'Bunac', 'nbunac@gmail.com', 'nbunac123', NULL, 0, 1, 2),
(24, 'grebic', 'Goran', 'Rebic', 'grebic@gmail.com', 'grebic123', NULL, 1, 0, 2),
(25, 'lmodric', 'Luka', 'Modric', 'lmodric@gmail.com', 'lmodric123', NULL, 1, 0, 1),
(26, 'dsrna', 'Dario', 'Srna', 'dsrna@gmail.com', 'dsrna123', NULL, 1, 0, 1),
(27, 'dlovren', 'Dejan', 'Lovren', 'dlovren@gmail.com', 'dlovren123', NULL, 1, 0, 1),
(28, 'dvida', 'Domagoj', 'Vida', 'dvida@gmail.com', 'dvida123', NULL, 1, 0, 1),
(29, 'abcde', 'Test', 'Tester', 'lgotovac@foi.hr', '49ead71281479d86bd38aecea568d12e861870be', '18ee7c37d66ccf7c47a454e0b454f87c2ef8db63', 1, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `moderacija_hotela`
--

CREATE TABLE IF NOT EXISTS `moderacija_hotela` (
  `korisnici_id_korisnik` int(11) NOT NULL,
  `hoteli_id_hotel` int(11) NOT NULL,
  KEY `fk_korisnici_has_hoteli_hoteli1_idx` (`hoteli_id_hotel`),
  KEY `fk_korisnici_has_hoteli_korisnici1_idx` (`korisnici_id_korisnik`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `moderacija_hotela`
--

INSERT INTO `moderacija_hotela` (`korisnici_id_korisnik`, `hoteli_id_hotel`) VALUES
(2, 2),
(2, 1),
(2, 3),
(2, 4),
(2, 5),
(3, 6),
(3, 7),
(3, 8),
(3, 9),
(3, 10),
(22, 11),
(22, 12),
(22, 13),
(22, 14),
(22, 15),
(23, 16),
(23, 17),
(23, 18),
(23, 19),
(23, 20),
(24, 21),
(24, 22),
(24, 23),
(24, 24),
(24, 25);

-- --------------------------------------------------------

--
-- Table structure for table `moderacija_pozicije`
--

CREATE TABLE IF NOT EXISTS `moderacija_pozicije` (
  `korisnici_id_korisnik` int(11) NOT NULL,
  `pozicije_oglasa_id_pozicija` int(11) NOT NULL,
  KEY `fk_korisnici_has_pozicije_oglasa_pozicije_oglasa1_idx` (`pozicije_oglasa_id_pozicija`),
  KEY `fk_korisnici_has_pozicije_oglasa_korisnici1_idx` (`korisnici_id_korisnik`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `moderacija_pozicije`
--

INSERT INTO `moderacija_pozicije` (`korisnici_id_korisnik`, `pozicije_oglasa_id_pozicija`) VALUES
(2, 1),
(3, 2),
(3, 1),
(3, 3),
(22, 8),
(22, 9),
(22, 10),
(24, 11),
(24, 10),
(24, 9),
(24, 8),
(22, 1),
(22, 2),
(22, 3),
(22, 11);

-- --------------------------------------------------------

--
-- Table structure for table `oglasi`
--

CREATE TABLE IF NOT EXISTS `oglasi` (
  `oglas_id` int(11) NOT NULL AUTO_INCREMENT,
  `naziv` varchar(45) NOT NULL,
  `status` varchar(30) NOT NULL,
  `pocetak` date NOT NULL,
  `url` varchar(100) NOT NULL,
  `slika_url` varchar(100) NOT NULL,
  `opis` varchar(100) NOT NULL,
  `broj_klik` int(11) NOT NULL,
  `korisnici_id_korisnik` int(11) NOT NULL,
  `oglasi_id_oglas` int(11) NOT NULL,
  PRIMARY KEY (`oglas_id`),
  KEY `fk_zahtjevi_za_oglas_korisnici1_idx` (`korisnici_id_korisnik`),
  KEY `fk_zahtjevi_za_oglas_oglasi1_idx` (`oglasi_id_oglas`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=28 ;

--
-- Dumping data for table `oglasi`
--

INSERT INTO `oglasi` (`oglas_id`, `naziv`, `status`, `pocetak`, `url`, `slika_url`, `opis`, `broj_klik`, `korisnici_id_korisnik`, `oglasi_id_oglas`) VALUES
(1, 'T-com', 'Blokiran', '2018-06-17', 'https://www.hrvatskitelekom.hr', 'https://image.ibb.co/dzhnxy/t_com_1024_450x450.jpg', '', 10, 9, 3),
(2, 'Bug', 'Aktivan', '2018-06-17', 'https://www.bug.hr/', 'https://image.ibb.co/mh8GPd/l64ZHyin.png', '', 4, 26, 3),
(3, 'Posta', 'Aktivan', '2018-06-17', 'https://www.posta.hr/', 'https://image.ibb.co/hfPXzd/HRVATSKA_POSTA_450x450.jpg', '', 4, 27, 1),
(4, 'Konzum', 'Aktivan', '2018-06-17', 'https://www.konzum.hr/', 'https://image.ibb.co/diechy/images.png', '', 1, 27, 4),
(5, 'Lidl', 'Aktivan', '2018-06-17', 'https://www.lidl.hr', 'https://preview.ibb.co/jgqpvJ/2000px_Lidl_Logo_svg.png', '', 1, 27, 5),
(6, 'Intersport', 'Blokiran', '2018-06-17', 'https://www.intersport.hr', 'https://image.ibb.co/bUHmaJ/intersport.png', '', 1, 27, 6),
(7, 'Nike', 'Aktivan', '2018-06-17', 'https://www.nike.com', 'https://image.ibb.co/hYAYNy/Ud_E5mfk_P_400x400.jpg', '', 1, 27, 7),
(8, 'Lidl2', 'Aktivan', '2018-06-17', 'https://www.lidl.hr', 'https://preview.ibb.co/jgqpvJ/2000px_Lidl_Logo_svg.png', '', 0, 27, 7),
(9, 'T-com2', 'Aktivan', '2018-06-17', 'https://www.hrvatskitelekom.hr', 'https://image.ibb.co/dzhnxy/t_com_1024_450x450.jpg', '', 0, 26, 4),
(10, 'Bug2', 'Aktivan', '2018-06-17', 'https://www.bug.hr/', 'https://image.ibb.co/mh8GPd/l64ZHyin.png', '', 0, 27, 5),
(11, 'Posta2', 'Aktivan', '2018-06-17', 'https://www.posta.hr/', 'https://image.ibb.co/hfPXzd/HRVATSKA_POSTA_450x450.jpg', '', 0, 27, 6),
(25, 'NikeDva', 'U obradi', '2018-06-15', 'https://www.nike.hr', '../img/UdE5mfkP_400x400.jpg', 'Oglas za marku Nike', 0, 9, 2),
(26, 'intersport2', 'U obradi', '2018-06-17', 'https://www.intersport.hr/', '../img/intersport.png', 'Oglas za intersport', 0, 25, 3),
(27, 'Novi naziv', 'U obradi', '2018-06-18', 'https://www.nike.com', '../img/1.jpeg', 'Test', 0, 27, 3);

-- --------------------------------------------------------

--
-- Table structure for table `pozicije_oglasa`
--

CREATE TABLE IF NOT EXISTS `pozicije_oglasa` (
  `id_pozicija` int(11) NOT NULL AUTO_INCREMENT,
  `lokacija` int(11) NOT NULL,
  `sirina` int(11) NOT NULL,
  `visina` int(11) NOT NULL,
  PRIMARY KEY (`id_pozicija`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `pozicije_oglasa`
--

INSERT INTO `pozicije_oglasa` (`id_pozicija`, `lokacija`, `sirina`, `visina`) VALUES
(1, 1, 200, 200),
(2, 2, 250, 250),
(3, 3, 300, 300),
(8, 4, 200, 200),
(9, 5, 250, 250),
(10, 6, 300, 300),
(11, 7, 300, 300);

-- --------------------------------------------------------

--
-- Table structure for table `rezervacije`
--

CREATE TABLE IF NOT EXISTS `rezervacije` (
  `id_rezervacija` int(11) NOT NULL AUTO_INCREMENT,
  `dolazak` datetime NOT NULL,
  `trajanje_boravka` int(11) NOT NULL,
  `korisnici_id_korisnik` int(11) NOT NULL,
  `sobe_id_soba` int(11) NOT NULL,
  `hoteli_id_hotel` int(11) NOT NULL,
  PRIMARY KEY (`id_rezervacija`),
  KEY `fk_rezervacije_korisnici1_idx` (`korisnici_id_korisnik`),
  KEY `fk_rezervacije_sobe1_idx` (`sobe_id_soba`),
  KEY `fk_rezervacije_hoteli1_idx` (`hoteli_id_hotel`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `rezervacije`
--

INSERT INTO `rezervacije` (`id_rezervacija`, `dolazak`, `trajanje_boravka`, `korisnici_id_korisnik`, `sobe_id_soba`, `hoteli_id_hotel`) VALUES
(6, '2018-06-19 00:00:00', 7, 26, 1, 6),
(7, '2018-06-18 00:00:00', 3, 26, 2, 6);

-- --------------------------------------------------------

--
-- Table structure for table `sobe`
--

CREATE TABLE IF NOT EXISTS `sobe` (
  `id_soba` int(11) NOT NULL AUTO_INCREMENT,
  `broj_sobe` int(11) NOT NULL,
  `broj_lezaja` int(11) NOT NULL,
  `tip_sobe` varchar(30) NOT NULL,
  `status` varchar(30) NOT NULL,
  `broj_rez` int(11) NOT NULL,
  `cijena` int(11) NOT NULL,
  `opis` varchar(100) DEFAULT NULL,
  `slika_url` varchar(45) DEFAULT NULL,
  `hoteli_id_hotel` int(11) NOT NULL,
  PRIMARY KEY (`id_soba`),
  KEY `fk_sobe_hoteli1_idx` (`hoteli_id_hotel`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=74 ;

--
-- Dumping data for table `sobe`
--

INSERT INTO `sobe` (`id_soba`, `broj_sobe`, `broj_lezaja`, `tip_sobe`, `status`, `broj_rez`, `cijena`, `opis`, `slika_url`, `hoteli_id_hotel`) VALUES
(1, 101, 2, 'Dvokrevetna', '1', 2, 1000, 'Luksuzna dvokrevetna soba', '1.jpeg', 1),
(2, 201, 1, 'Jednokrevetna', '1', 8, 2000, 'Luksuzna jednokrevetna soba', '2.jpeg', 2),
(3, 150, 3, 'Trokrevetna', '0', 0, 300, 'Trokrevetna soba', '3.jpeg', 3),
(4, 341, 5, 'Peterokrevetna', '0', 0, 200, 'Peterokrevetna soba', '4.jpeg', 4),
(5, 103, 2, 'Dvokrevetna', '0', 0, 400, 'Dvokrevetna soba', '5.jpeg', 5),
(6, 220, 1, 'Jednokrevetna', '0', 0, 2000, 'Luksuzna jednokrevetna soba', '6.jpeg', 6),
(7, 142, 3, 'Trokrevetna', '0', 0, 350, 'Trokrevetna soba', '7.jpeg', 7),
(8, 402, 2, 'Dvokrevetna', '0', 0, 500, 'Dvokrevetna soba', '8.jpeg', 8),
(9, 132, 1, 'Jednokrevetna', '0', 0, 600, 'Jednokrevetna sobaa', '9.jpeg', 9),
(10, 301, 3, 'Trokrevetna', '0', 0, 400, 'Trokrevetna soba', '10.jpeg', 10),
(11, 352, 2, 'Dvokrevetna', '0', 0, 1000, 'Luksuzna dvokrevetna soba', '1.jpeg', 11),
(12, 234, 2, 'Dvokrevetna', '0', 0, 1000, 'Luksuzna dvokrevetna soba', '1.jpeg', 12),
(13, 653, 2, 'Dvokrevetna', '0', 0, 1000, 'Luksuzna dvokrevetna soba', '1.jpeg', 13),
(14, 232, 2, 'Dvokrevetna', '0', 0, 1000, 'Luksuzna dvokrevetna soba', '1.jpeg', 14),
(15, 133, 2, 'Dvokrevetna', '0', 0, 1000, 'Luksuzna dvokrevetna soba', '1.jpeg', 15),
(16, 155, 2, 'Dvokrevetna', '0', 0, 1000, 'Luksuzna dvokrevetna soba', '1.jpeg', 16),
(17, 132, 2, 'Dvokrevetna', '0', 0, 1000, 'Luksuzna dvokrevetna soba', '1.jpeg', 17),
(18, 166, 2, 'Dvokrevetna', '0', 0, 1000, 'Luksuzna dvokrevetna soba', '1.jpeg', 18),
(19, 233, 2, 'Dvokrevetna', '0', 0, 1000, 'Luksuzna dvokrevetna soba', '1.jpeg', 19),
(20, 755, 2, 'Dvokrevetna', '0', 0, 1000, 'Luksuzna dvokrevetna soba', '1.jpeg', 20),
(21, 533, 2, 'Dvokrevetna', '0', 0, 1000, 'Luksuzna dvokrevetna soba', '1.jpeg', 21),
(22, 144, 2, 'Dvokrevetna', '0', 0, 1000, 'Luksuzna dvokrevetna soba', '1.jpeg', 22),
(23, 143, 2, 'Dvokrevetna', '0', 0, 1000, 'Luksuzna dvokrevetna soba', '1.jpeg', 23),
(24, 163, 2, 'Dvokrevetna', '0', 0, 1000, 'Luksuzna dvokrevetna soba', '1.jpeg', 24),
(25, 182, 2, 'Dvokrevetna', '0', 0, 1000, 'Luksuzna dvokrevetna soba', '1.jpeg', 25),
(26, 332, 1, 'Jednokrevetna', '0', 0, 2000, 'Luksuzna jednokrevetna soba', '2.jpeg', 11),
(27, 111, 1, 'Jednokrevetna', '0', 0, 2000, 'Luksuzna jednokrevetna soba', '2.jpeg', 12),
(28, 222, 1, 'Jednokrevetna', '0', 0, 2000, 'Luksuzna jednokrevetna soba', '2.jpeg', 13),
(29, 333, 1, 'Jednokrevetna', '0', 0, 2000, 'Luksuzna jednokrevetna soba', '2.jpeg', 14),
(30, 444, 1, 'Jednokrevetna', '0', 0, 2000, 'Luksuzna jednokrevetna soba', '2.jpeg', 15),
(31, 555, 1, 'Jednokrevetna', '0', 0, 2000, 'Luksuzna jednokrevetna soba', '2.jpeg', 16),
(32, 666, 1, 'Jednokrevetna', '0', 0, 2000, 'Luksuzna jednokrevetna soba', '2.jpeg', 17),
(33, 777, 1, 'Jednokrevetna', '0', 0, 2000, 'Luksuzna jednokrevetna soba', '2.jpeg', 18),
(34, 888, 1, 'Jednokrevetna', '0', 0, 2000, 'Luksuzna jednokrevetna soba', '2.jpeg', 19),
(35, 799, 1, 'Jednokrevetna', '0', 0, 2000, 'Luksuzna jednokrevetna soba', '2.jpeg', 20),
(36, 573, 1, 'Jednokrevetna', '0', 0, 2000, 'Luksuzna jednokrevetna soba', '2.jpeg', 21),
(37, 252, 1, 'Jednokrevetna', '0', 0, 2000, 'Luksuzna jednokrevetna soba', '2.jpeg', 22),
(38, 443, 1, 'Jednokrevetna', '0', 0, 2000, 'Luksuzna jednokrevetna soba', '2.jpeg', 23),
(39, 554, 1, 'Jednokrevetna', '0', 0, 2000, 'Luksuzna jednokrevetna soba', '2.jpeg', 24),
(40, 882, 1, 'Jednokrevetna', '0', 0, 2000, 'Luksuzna jednokrevetna soba', '2.jpeg', 25),
(41, 634, 3, 'Trokrevetna', '0', 0, 300, 'Trokrevetna soba', '3.jpeg', 11),
(42, 632, 3, 'Trokrevetna', '0', 0, 300, 'Trokrevetna soba', '3.jpeg', 12),
(43, 354, 3, 'Trokrevetna', '0', 0, 300, 'Trokrevetna soba', '3.jpeg', 13),
(44, 663, 3, 'Trokrevetna', '0', 0, 300, 'Trokrevetna soba', '3.jpeg', 14),
(45, 771, 3, 'Trokrevetna', '0', 0, 300, 'Trokrevetna soba', '3.jpeg', 15),
(46, 101, 3, 'Trokrevetna', '0', 0, 300, 'Trokrevetna soba', '3.jpeg', 16),
(47, 312, 3, 'Trokrevetna', '0', 0, 300, 'Trokrevetna soba', '3.jpeg', 17),
(48, 461, 3, 'Trokrevetna', '0', 0, 300, 'Trokrevetna soba', '3.jpeg', 18),
(49, 322, 3, 'Trokrevetna', '0', 0, 300, 'Trokrevetna soba', '3.jpeg', 19),
(50, 213, 3, 'Trokrevetna', '0', 0, 300, 'Trokrevetna soba', '3.jpeg', 20),
(51, 272, 3, 'Trokrevetna', '0', 0, 300, 'Trokrevetna soba', '3.jpeg', 21),
(52, 244, 3, 'Trokrevetna', '0', 0, 300, 'Trokrevetna soba', '3.jpeg', 22),
(53, 423, 3, 'Trokrevetna', '0', 0, 300, 'Trokrevetna soba', '3.jpeg', 23),
(54, 522, 3, 'Trokrevetna', '0', 0, 300, 'Trokrevetna soba', '3.jpeg', 24),
(55, 801, 3, 'Trokrevetna', '0', 0, 300, 'Trokrevetna soba', '3.jpeg', 25),
(56, 334, 5, 'Peterokrevetna', '0', 0, 200, 'Peterokrevetna soba', '4.jpeg', 11),
(57, 112, 5, 'Peterokrevetna', '0', 0, 200, 'Peterokrevetna soba', '4.jpeg', 12),
(58, 224, 5, 'Peterokrevetna', '0', 0, 200, 'Peterokrevetna soba', '4.jpeg', 13),
(59, 233, 5, 'Peterokrevetna', '0', 0, 200, 'Peterokrevetna soba', '4.jpeg', 14),
(60, 441, 5, 'Peterokrevetna', '0', 0, 200, 'Peterokrevetna soba', '4.jpeg', 15),
(61, 771, 5, 'Peterokrevetna', '0', 0, 200, 'Peterokrevetna soba', '4.jpeg', 16),
(62, 442, 5, 'Peterokrevetna', '0', 0, 200, 'Peterokrevetna soba', '4.jpeg', 17),
(63, 221, 5, 'Peterokrevetna', '0', 0, 200, 'Peterokrevetna soba', '4.jpeg', 18),
(64, 112, 5, 'Peterokrevetna', '0', 0, 200, 'Peterokrevetna soba', '4.jpeg', 19),
(65, 883, 5, 'Peterokrevetna', '0', 0, 200, 'Peterokrevetna soba', '4.jpeg', 20),
(66, 242, 5, 'Peterokrevetna', '0', 0, 200, 'Peterokrevetna soba', '4.jpeg', 21),
(67, 294, 5, 'Peterokrevetna', '0', 0, 200, 'Peterokrevetna soba', '4.jpeg', 22),
(68, 343, 5, 'Peterokrevetna', '0', 0, 200, 'Peterokrevetna soba', '4.jpeg', 23),
(69, 872, 5, 'Peterokrevetna', '0', 0, 200, 'Peterokrevetna soba', '4.jpeg', 24),
(70, 991, 5, 'Peterokrevetna', '0', 0, 200, 'Peterokrevetna soba', '4.jpeg', 25),
(73, 409, 2, '', '0', 0, 0, 'Dvokrevetna soba', '../img/', 6);

-- --------------------------------------------------------

--
-- Table structure for table `tip_korisnika`
--

CREATE TABLE IF NOT EXISTS `tip_korisnika` (
  `id_tip_kor` int(11) NOT NULL AUTO_INCREMENT,
  `naziv_tipa` varchar(30) NOT NULL,
  PRIMARY KEY (`id_tip_kor`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `tip_korisnika`
--

INSERT INTO `tip_korisnika` (`id_tip_kor`, `naziv_tipa`) VALUES
(1, 'user'),
(2, 'moderator'),
(3, 'administrator');

-- --------------------------------------------------------

--
-- Table structure for table `tip_oglasa`
--

CREATE TABLE IF NOT EXISTS `tip_oglasa` (
  `id_oglas` int(11) NOT NULL AUTO_INCREMENT,
  `naziv` varchar(45) NOT NULL,
  `trajanje` int(11) NOT NULL,
  `cijena` int(11) NOT NULL,
  `brzina` int(11) NOT NULL,
  `pozicije_oglasa_id_pozicija` int(11) NOT NULL,
  PRIMARY KEY (`id_oglas`),
  KEY `fk_oglasi_pozicije_oglasa1_idx` (`pozicije_oglasa_id_pozicija`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `tip_oglasa`
--

INSERT INTO `tip_oglasa` (`id_oglas`, `naziv`, `trajanje`, `cijena`, `brzina`, `pozicije_oglasa_id_pozicija`) VALUES
(1, 'Mali oglas na pocetnoj', 1, 1000, 5000, 1),
(2, 'Srednji oglas na pocetnoj', 2, 2000, 7000, 2),
(3, 'Veliki oglas na pocetnoj', 3, 3000, 9000, 3),
(4, 'Mali oglas na popisu hotela', 1, 1000, 5000, 8),
(5, 'Srednji oglas na popisu hotela', 2, 2000, 7000, 9),
(6, 'Veliki oglas na popisu hotela', 3, 3000, 9000, 10),
(7, 'Veliki oglas kod prijave', 3, 3000, 5000, 11);

-- --------------------------------------------------------

--
-- Table structure for table `zahtjevi_za_blok`
--

CREATE TABLE IF NOT EXISTS `zahtjevi_za_blok` (
  `id_blokzahtjev` int(11) NOT NULL AUTO_INCREMENT,
  `id_zahtjevatelja` int(11) NOT NULL,
  `opis_razloga` varchar(100) NOT NULL,
  `status` varchar(45) NOT NULL,
  `datum` varchar(45) NOT NULL,
  `oglasi_id_oglas` int(11) NOT NULL,
  PRIMARY KEY (`id_blokzahtjev`),
  KEY `fk_zahtjevi_za_blok_oglasi1_idx` (`oglasi_id_oglas`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `zahtjevi_za_blok`
--

INSERT INTO `zahtjevi_za_blok` (`id_blokzahtjev`, `id_zahtjevatelja`, `opis_razloga`, `status`, `datum`, `oglasi_id_oglas`) VALUES
(2, 9, 'Test', 'Prihvacen', '2018-06-18 01:20:18', 6),
(3, 27, 'asd', 'Prihvacen', '2018-06-18 12:23:10', 1);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `anon_rezervacije`
--
ALTER TABLE `anon_rezervacije`
  ADD CONSTRAINT `fk_anon_rezervacije_hoteli1` FOREIGN KEY (`hoteli_id_hotel`) REFERENCES `hoteli` (`id_hotel`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_anon_rezervacije_sobe1` FOREIGN KEY (`sobe_id_soba`) REFERENCES `sobe` (`id_soba`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `korisnici`
--
ALTER TABLE `korisnici`
  ADD CONSTRAINT `fk_korisnici_tip_korisnika` FOREIGN KEY (`tip_korisnika_id_tip_kor`) REFERENCES `tip_korisnika` (`id_tip_kor`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `moderacija_hotela`
--
ALTER TABLE `moderacija_hotela`
  ADD CONSTRAINT `fk_korisnici_has_hoteli_hoteli1` FOREIGN KEY (`hoteli_id_hotel`) REFERENCES `hoteli` (`id_hotel`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_korisnici_has_hoteli_korisnici1` FOREIGN KEY (`korisnici_id_korisnik`) REFERENCES `korisnici` (`id_korisnik`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `moderacija_pozicije`
--
ALTER TABLE `moderacija_pozicije`
  ADD CONSTRAINT `fk_korisnici_has_pozicije_oglasa_korisnici1` FOREIGN KEY (`korisnici_id_korisnik`) REFERENCES `korisnici` (`id_korisnik`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_korisnici_has_pozicije_oglasa_pozicije_oglasa1` FOREIGN KEY (`pozicije_oglasa_id_pozicija`) REFERENCES `pozicije_oglasa` (`id_pozicija`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `oglasi`
--
ALTER TABLE `oglasi`
  ADD CONSTRAINT `fk_zahtjevi_za_oglas_korisnici1` FOREIGN KEY (`korisnici_id_korisnik`) REFERENCES `korisnici` (`id_korisnik`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_zahtjevi_za_oglas_oglasi1` FOREIGN KEY (`oglasi_id_oglas`) REFERENCES `tip_oglasa` (`id_oglas`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `rezervacije`
--
ALTER TABLE `rezervacije`
  ADD CONSTRAINT `fk_rezervacije_hoteli1` FOREIGN KEY (`hoteli_id_hotel`) REFERENCES `hoteli` (`id_hotel`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_rezervacije_korisnici1` FOREIGN KEY (`korisnici_id_korisnik`) REFERENCES `korisnici` (`id_korisnik`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_rezervacije_sobe1` FOREIGN KEY (`sobe_id_soba`) REFERENCES `sobe` (`id_soba`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `sobe`
--
ALTER TABLE `sobe`
  ADD CONSTRAINT `fk_sobe_hoteli1` FOREIGN KEY (`hoteli_id_hotel`) REFERENCES `hoteli` (`id_hotel`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `tip_oglasa`
--
ALTER TABLE `tip_oglasa`
  ADD CONSTRAINT `fk_oglasi_pozicije_oglasa1` FOREIGN KEY (`pozicije_oglasa_id_pozicija`) REFERENCES `pozicije_oglasa` (`id_pozicija`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `zahtjevi_za_blok`
--
ALTER TABLE `zahtjevi_za_blok`
  ADD CONSTRAINT `fk_zahtjevi_za_blok_oglasi1` FOREIGN KEY (`oglasi_id_oglas`) REFERENCES `tip_oglasa` (`id_oglas`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
