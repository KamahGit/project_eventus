-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 25, 2019 at 01:04 AM
-- Server version: 10.1.36-MariaDB
-- PHP Version: 7.2.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `project_eventus`
--
CREATE DATABASE IF NOT EXISTS `project_eventus` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `project_eventus`;

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE IF NOT EXISTS `events` (
  `id` int(100) NOT NULL AUTO_INCREMENT COMMENT 'event id',
  `name` varchar(100) NOT NULL COMMENT 'event name',
  `location` varchar(255) NOT NULL COMMENT 'event locale',
  `type` varchar(100) NOT NULL,
  `from` datetime NOT NULL COMMENT 'start date/time',
  `to` datetime NOT NULL COMMENT 'stop date/time',
  `image` varchar(255) DEFAULT NULL,
  `admin_id` int(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `unique timestamps` (`created_at`,`updated_at`),
  KEY `admin_id` (`admin_id`)
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`id`, `name`, `location`, `type`, `from`, `to`, `image`, `admin_id`, `created_at`, `updated_at`) VALUES
(32, 'CHURCH', 'KAREN', 'church', '2019-01-27 09:30:00', '2019-01-27 13:00:00', 'events/f3ccdd27d2000e3f9255a7e3e2c48800.jpg', 7, '2019-01-24 23:48:54', '0000-00-00 00:00:00'),
(33, 'School', 'Town', 'School', '2019-01-30 08:00:00', '2019-11-30 21:00:00', 'events/8df7b73a7820f4aef47864f2a6c5fccf.jpg', 7, '2019-01-24 23:49:55', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE TABLE IF NOT EXISTS `role` (
  `id` int(100) NOT NULL AUTO_INCREMENT COMMENT 'role id',
  `name` varchar(100) NOT NULL COMMENT 'role description',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'admin', '2019-01-10 22:56:25', '2019-01-10 22:58:44'),
(2, 'member', '2019-01-16 06:33:39', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `tickets`
--

CREATE TABLE IF NOT EXISTS `tickets` (
  `id` int(100) NOT NULL AUTO_INCREMENT COMMENT 'ticket id',
  `category` enum('REGULAR','VIP','VVIP','FREE') NOT NULL COMMENT 'ticket category',
  `price` double(100,2) NOT NULL DEFAULT '0.00',
  `amount` int(100) NOT NULL DEFAULT '0',
  `event_id` int(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `event_id` (`event_id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tickets`
--

INSERT INTO `tickets` (`id`, `category`, `price`, `amount`, `event_id`, `created_at`, `updated_at`) VALUES
(10, 'FREE', 0.00, 995, 32, '2019-01-24 23:48:55', '2019-01-24 23:52:44'),
(11, 'FREE', 0.00, 149, 33, '2019-01-24 23:49:55', '2019-01-24 23:52:32');

-- --------------------------------------------------------

--
-- Table structure for table `tickets_purchased`
--

CREATE TABLE IF NOT EXISTS `tickets_purchased` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `user_id` int(100) NOT NULL,
  `ticket_id` int(100) NOT NULL,
  `amount` int(100) NOT NULL,
  `cost` double(100,2) NOT NULL DEFAULT '0.00',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `ticket_id` (`ticket_id`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tickets_purchased`
--

INSERT INTO `tickets_purchased` (`id`, `user_id`, `ticket_id`, `amount`, `cost`, `created_at`, `updated_at`) VALUES
(26, 42, 11, 1, 0.00, '2019-01-24 23:52:32', '0000-00-00 00:00:00'),
(27, 42, 10, 5, 0.00, '2019-01-24 23:52:44', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(25) NOT NULL AUTO_INCREMENT COMMENT 'the user''s id',
  `fname` varchar(100) NOT NULL COMMENT 'user''s first name',
  `lname` varchar(100) NOT NULL COMMENT 'user''s last name',
  `email` varchar(255) NOT NULL COMMENT 'user''s email',
  `photo` varchar(200) DEFAULT NULL COMMENT 'user''s picture',
  `password` varchar(255) NOT NULL COMMENT 'user''s password',
  `account_bal` double(100,2) NOT NULL DEFAULT '0.00' COMMENT 'user''s account balance',
  `role_id` int(100) NOT NULL DEFAULT '2',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `unique_email` (`email`),
  KEY `role_id` (`role_id`)
) ENGINE=InnoDB AUTO_INCREMENT=43 DEFAULT CHARSET=latin1 COMMENT='table for user details';

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `fname`, `lname`, `email`, `photo`, `password`, `account_bal`, `role_id`, `created_at`, `updated_at`) VALUES
(1, 'lsdfn', 'nlklkln', 'ksndsn', 'kndk', 'db304fcb4105dbd0c6e48df1be83c5807d65398e', 5545.25, 1, '2019-01-10 22:40:12', '2019-01-16 06:34:02'),
(3, 'bname', 'nn', 'a@h.com', 'dsnfk', '1245', 144.00, 2, '2019-01-14 11:49:01', '2019-01-16 06:34:12'),
(4, 'bruce', 'kamau', 'kk@g.com', 'users/fe5df232cafa4c4e0f1a0294418e5660.jpg', '827ccb0eea8a706c4c34a16891f84e7b', 0.00, 2, '2019-01-15 23:49:24', '2019-01-24 21:32:54'),
(5, 'bruce', 'lsal', 'klkls@e.com', '', 'c2890d44d06bafb6c7b4aa194857ccbc', 0.00, 2, '2019-01-15 23:53:15', '2019-01-24 21:33:24'),
(7, 'bro', 'ko', 'broko@rt.com', NULL, '827ccb0eea8a706c4c34a16891f84e7b', 450.00, 1, '2019-01-16 10:27:33', '2019-01-19 08:54:34'),
(8, 'ggjadvshjh', 'kjsbjbk', 'jj@j.com', '', '78867', 0.00, 2, '2019-01-16 11:12:57', '0000-00-00 00:00:00'),
(9, 'akjdbjb', 'sdklnc', 'hhh@r.com', '', 'sjdfnkj', 0.00, 2, '2019-01-16 11:15:48', '0000-00-00 00:00:00'),
(10, 'lndskv', 'jnknjk', 'kjn@y.com', NULL, 'kjjkn', 0.00, 2, '2019-01-17 21:07:07', '2019-01-17 21:07:07'),
(11, 'ifrhefwi', 'inin', 'k@h.com', '', 'njnj;', 0.00, 2, '2019-01-17 21:07:50', '0000-00-00 00:00:00'),
(19, 'achoib', 'iohb', 'bo@j.com', 'users/4314b868f4659e797dbede8ccadd650c.png', '4444', 5000.00, 2, '2019-01-18 10:58:43', '0000-00-00 00:00:00'),
(20, 'bjwekj', 'lnlln', 'lnlnl@j.com', 'users/d5fae34f0e93dd539a7d3c43d6740169.png', 'e3251075554389fe91d17a794861d47b', 4000.00, 2, '2019-01-18 11:00:52', '0000-00-00 00:00:00'),
(21, 'bfvj', 'nljl', 'obo@j.com', '', '6074c6aa3488f3c2dddff2a7ca821aab', 1000.00, 2, '2019-01-18 11:21:13', '0000-00-00 00:00:00'),
(22, 'admin', 'admin', 'admin@eventus.com', '', '21232f297a57a5a743894a0e4a801fc3', 0.00, 2, '2019-01-19 08:39:10', '0000-00-00 00:00:00'),
(23, '', '', '', '', 'd41d8cd98f00b204e9800998ecf8427e', 0.00, 2, '2019-01-19 08:42:38', '0000-00-00 00:00:00'),
(24, 'lboin', 'opln', 'kn@d.com', '', '5acdc9ca5d99ae66afdfe1eea0e3b26b', 500.00, 2, '2019-01-19 08:59:35', '0000-00-00 00:00:00'),
(25, 'ndlndl', 'dnwkwm', 'kkk@g.com', '', 'b096d7abd60d2f19ab03d674eb7b2669', 400.00, 2, '2019-01-19 09:03:17', '0000-00-00 00:00:00'),
(26, 'admin', '2', 'admin2@eventus.com', '', 'c84258e9c39059a89ab77d846ddab909', 0.00, 1, '2019-01-19 09:09:00', '0000-00-00 00:00:00'),
(27, 'lidh', 'opm', 'jj@g.com', '', '250cf8b51c773f3f8dc8b4be867a9a02', 555.00, 2, '2019-01-19 09:13:06', '0000-00-00 00:00:00'),
(28, 'FKLKNO', 'OKN', 'LK@5.COM', '', '614035b7286ed3b60d55a8d43e2f71ae', 44.00, 2, '2019-01-19 09:28:27', '0000-00-00 00:00:00'),
(29, 'lesfknlk', 'KNLKN', 'ADW@JU.DUH', '', 'e4270771aa8df98b3317d174170ca046', 500.00, 2, '2019-01-19 09:30:01', '0000-00-00 00:00:00'),
(31, 'knldl', 'klnlk', 'kan@dd.com', 'users4314b868f4659e797dbede8ccadd650c.png', '6074c6aa3488f3c2dddff2a7ca821aab', 5000.00, 2, '2019-01-23 09:36:44', '0000-00-00 00:00:00'),
(34, 'iposdfnje', 'lmklml', 'lkklm@f.com', 'users/d5fae34f0e93dd539a7d3c43d6740169.png', 'd79c8788088c2193f0244d8f1f36d2db', 0.00, 2, '2019-01-23 09:48:49', '0000-00-00 00:00:00'),
(35, 'lkdnfkn', 'klkl', 'a@f.com', 'users/4314b868f4659e797dbede8ccadd650c.png', 'c84258e9c39059a89ab77d846ddab909', 555.00, 2, '2019-01-23 09:49:35', '0000-00-00 00:00:00'),
(36, 'lncfn', 'knlknln', 'nwdnwlnl@e.com', 'users/4314b868f4659e797dbede8ccadd650c.png', 'c5fe25896e49ddfe996db7508cf00534', 4444.00, 2, '2019-01-23 10:00:34', '0000-00-00 00:00:00'),
(37, 'lnlkn', 'klnkllk', 'knlklkkl@kmkmk.cdok', 'users/d5fae34f0e93dd539a7d3c43d6740169.png', 'c84258e9c39059a89ab77d846ddab909', 777.00, 1, '2019-01-24 09:42:48', '0000-00-00 00:00:00'),
(38, 'dany', 'jumo', 'danyjumo@g.com', 'users/3654dbad39b2d6da56f097e96cc93ec4.PNG', 'b87c11a11e92b4ed8b516ebe9236b68a', 500.00, 2, '2019-01-24 10:06:10', '0000-00-00 00:00:00'),
(39, 'deno', 'james', 'denojames@g.com', 'users/b0aa2f53c1c7a8d1675259f502f8d709.jpg', '5eac43aceba42c8757b54003a58277b5', -100.00, 2, '2019-01-24 18:28:17', '2019-01-24 19:54:51'),
(40, 'peter', 'jones', 'pjones@yahoo.com', 'users/3fb2db6cccf4a23383383394b28b2b31.jpg', 'c5fe25896e49ddfe996db7508cf00534', 5000.00, 2, '2019-01-24 18:39:13', '0000-00-00 00:00:00'),
(41, 'mike', 'king', 'mikeking@g.com', 'users/f3ccdd27d2000e3f9255a7e3e2c48800.jpg', '827ccb0eea8a706c4c34a16891f84e7b', 300.00, 2, '2019-01-24 19:55:46', '2019-01-24 20:05:06'),
(42, 'bruce', 'kamau', 'bruce@kamau.com', 'users/f69150a1759b64b8d73ea7bcd596dfb4.jpg', '12345', 5000.00, 2, '2019-01-24 23:50:51', '0000-00-00 00:00:00');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `events`
--
ALTER TABLE `events`
  ADD CONSTRAINT `events_ibfk_1` FOREIGN KEY (`admin_id`) REFERENCES `user` (`id`);

--
-- Constraints for table `tickets`
--
ALTER TABLE `tickets`
  ADD CONSTRAINT `tickets_ibfk_1` FOREIGN KEY (`event_id`) REFERENCES `events` (`id`);

--
-- Constraints for table `tickets_purchased`
--
ALTER TABLE `tickets_purchased`
  ADD CONSTRAINT `tickets_purchased_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `tickets_purchased_ibfk_3` FOREIGN KEY (`ticket_id`) REFERENCES `tickets` (`id`);

--
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `role` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
