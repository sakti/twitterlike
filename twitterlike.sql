-- phpMyAdmin SQL Dump
-- version 3.3.3
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jun 02, 2010 at 05:24 PM
-- Server version: 5.1.41
-- PHP Version: 5.3.2-1ubuntu4.1

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `twitterlike`
--

-- --------------------------------------------------------

--
-- Table structure for table `follow`
--

CREATE TABLE IF NOT EXISTS `follow` (
  `idrel` int(11) NOT NULL AUTO_INCREMENT,
  `usera` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `userb` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`idrel`),
  UNIQUE KEY `usera` (`usera`,`userb`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=14 ;

--
-- Dumping data for table `follow`
--

INSERT INTO `follow` (`idrel`, `usera`, `userb`) VALUES
(1, 'saktidc', 'h1zbullah'),
(2, 'saktidc', 'gerrard'),
(10, 'saktidc', 'beukicot'),
(4, 'h1zbullah', 'saktidc'),
(13, 'saktidc', 'rakhmat'),
(11, 'gerrard', 'saktidc'),
(12, 'saktidc', 'cahyono');

-- --------------------------------------------------------

--
-- Table structure for table `tweet`
--

CREATE TABLE IF NOT EXISTS `tweet` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `tglwaktu` datetime NOT NULL,
  `isi` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=37 ;

--
-- Dumping data for table `tweet`
--

INSERT INTO `tweet` (`id`, `username`, `tglwaktu`, `isi`) VALUES
(1, 'saktidc', '2010-05-30 22:09:16', '@saktidc tweet ke diri sendiri'),
(3, 'saktidc', '2010-06-01 10:06:27', 'haha twetting alone'),
(4, 'h1zbullah', '2010-06-01 11:43:40', 'la la la la'),
(5, 'cahyono', '2010-06-01 11:48:14', 'tangan sampai keriting, nulis terus'),
(6, 'saktidc', '2010-06-01 11:49:32', '안녕 하세요'),
(7, 'saktidc', '2010-06-01 11:52:01', 'いただきますありがとねさよならおらんげらたおらんげらた'),
(8, 'gerrard', '2010-06-01 12:22:06', 'you''ll never tweet alone'),
(9, 'h1zbullah', '2010-06-02 07:55:15', 'twet lagi hari rabu'),
(10, 'rakhmat', '2010-06-02 07:58:20', 'coba tweet'),
(11, 'rakhmat', '2010-06-02 07:58:30', 'tweet lagi'),
(12, 'h1zbullah', '2010-06-02 07:59:15', 'hehe he'),
(13, 'saktidc', '2010-06-02 07:59:38', '@h1zbullah ngapain lo'),
(14, 'gerrard', '2010-06-02 08:57:22', 'mau ganti foto ah'),
(15, 'rakhmat', '2010-06-02 09:35:03', 'aku juga ganti foto\r\n\r\nhehe'),
(16, 'saktidc', '2010-06-02 09:38:04', '@gerrard kapan main bola lagi! <b>semangat</b>'),
(17, 'cahyono', '2010-06-02 09:47:11', 'aku juga pengen ganti icon'),
(18, 'cahyono', '2010-06-02 09:48:10', '아녕 하세요\r\ncoba ngetik pake bahasa korean'),
(19, 'cahyono', '2010-06-02 09:48:38', '&lt;br/&gt; &lt;script&gt;alert(&#039;coba ngecrack&#039;);&lt;/script&gt;'),
(20, 'rakhmat', '2010-06-02 09:49:21', '@cahyono ngecracknya kok masih pake cara ecek2'),
(21, 'cahyono', '2010-06-02 10:17:57', 'ngga bosen apa?'),
(22, 'gerrard', '2010-06-02 10:18:25', 'lalala'),
(23, 'rakhmat', '2010-06-02 10:18:41', 'yoi'),
(24, 'saktidc', '2010-06-02 10:19:23', 'mau number 1 di jumlah tweet'),
(25, 'h1zbullah', '2010-06-02 10:49:01', '@saktidc dibales ya?'),
(26, 'saktidc', '2010-06-02 11:22:26', 'satu'),
(27, 'saktidc', '2010-06-02 11:22:35', 'one'),
(29, 'saktidc', '2010-06-02 15:34:57', 'he he'),
(30, 'saktidc', '2010-06-02 15:49:19', 'koding terus'),
(31, 'gerrard', '2010-06-02 16:12:29', '@saktidc   gantian balas ah'),
(32, 'saktidc', '2010-06-02 16:12:45', '@gerrard aku juga ikut ikutan'),
(33, 'h1zbullah', '2010-06-02 16:14:28', '감사함니다\r\n사라'),
(34, 'saktidc', '2010-06-02 16:14:47', '@h1zbullah halah pake bahasa korea'),
(35, 'h1zbullah', '2010-06-02 16:15:18', '@saktidc 앗쿠코웰 ㅁ붛 아쿠 야 오라 에티 알티케 아살 아ㅆ란'),
(36, 'h1zbullah', '2010-06-02 16:16:01', 'تمي يب هثففق ان ئءؤر رلاىىةتنتنع ابل لبالالافغقفغ فثيبلسب شس');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `username` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `fullname` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `image` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `bio` text COLLATE utf8_unicode_ci,
  `lasttweet` int(11) DEFAULT NULL,
  PRIMARY KEY (`username`),
  UNIQUE KEY `email` (`email`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`username`, `password`, `email`, `fullname`, `image`, `bio`, `lasttweet`) VALUES
('saktidc', 'd77575cc735cf44edc38086c8df4e033', '54krpl@gmail.com', 'Sakti Dwi Cahyono', 'image.png', 'no comment lah', 34),
('h1zbullah', '7215ee9c7d9dc229d2921a40e899ec5f', 'h1zbullah@yahoo.co.id', 'dwi', '882c931b20f15e24b6b1db6dcbd1cb2d.jpg', 'orang biasa', 36),
('cahyono', 'd77575cc735cf44edc38086c8df4e033', 'sakti@mail.com', 'cahyono dwi sakti', '9e23b6cb382283bca3ca06b6b586ef65.png', 'seorang mahasiswa', 21),
('gerrard', 'b2f5ff47436671b6e533d8dc3614845d', 'g@gmail.com', 'stepen gerrard', '7965cfaf9f7a6e4d6510d823dd6e81f9.jpg', 'asdf jkl; persis keyboard', 31),
('beukicot', 'fd6cee015c4ec774cc3e6937d603ed15', 'beukicot@gmail.com', 'fauzan riyadi malik', 'default_1.png', 'asli sukabumi kang', NULL),
('rakhmat', '7215ee9c7d9dc229d2921a40e899ec5f', 'rakhmat@gmail.com', 'rakhmat hidayat', '3a8beb09b4c06b1aa66dc46a169681aa.jpg', 'no need to know', 23);
