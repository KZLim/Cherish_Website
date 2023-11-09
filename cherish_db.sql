-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 09, 2023 at 05:55 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cherish_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `access_log`
--

CREATE TABLE `access_log` (
  `log_id` int(11) NOT NULL,
  `admin_id` varchar(7) NOT NULL,
  `action_performed` varchar(33) NOT NULL,
  `date_accessed` varchar(10) NOT NULL,
  `time_accessed` varchar(10) NOT NULL,
  `reason` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `access_log`
--

INSERT INTO `access_log` (`log_id`, `admin_id`, `action_performed`, `date_accessed`, `time_accessed`, `reason`) VALUES
(1, 'CAG1001', 'Has requested IC of 654cfc25cc492', '2023-11-10', '12:26:31am', 'test');

-- --------------------------------------------------------

--
-- Table structure for table `admin_account`
--

CREATE TABLE `admin_account` (
  `admin_id` varchar(7) NOT NULL,
  `admin_ic` varchar(16) NOT NULL,
  `admin_name` varchar(82) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin_account`
--

INSERT INTO `admin_account` (`admin_id`, `admin_ic`, `admin_name`, `email`, `password`) VALUES
('CAG1001', 'MKQZVW0jolxAUJre', 'Lim Jie Wei', 'jw.lim@gmail.com', '$2y$10$xwrWFo5403S6ECpofMbpseUVbBNJPAl4VIlq9j9C1LZXf1kURW.R2');

-- --------------------------------------------------------

--
-- Table structure for table `donors_record`
--

CREATE TABLE `donors_record` (
  `rid` int(11) NOT NULL,
  `donor_name` varchar(82) NOT NULL,
  `donor_uid` varchar(13) NOT NULL,
  `amount` int(6) NOT NULL,
  `donation_date` varchar(10) NOT NULL,
  `donation_time` varchar(10) NOT NULL,
  `campaign_id` varchar(13) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `donors_record`
--

INSERT INTO `donors_record` (`rid`, `donor_name`, `donor_uid`, `amount`, `donation_date`, `donation_time`, `campaign_id`) VALUES
(1, 'Joyce Lee', '654cf9015008a', 1000, '2023-11-10', '12:34:57am', '654d09964c6a4'),
(2, 'Jessica Ooi ', '654cfa34ba5ee', 50, '2023-11-10', '12:35:26am', '654d09964c6a4'),
(3, 'Koay Kah Sun', '654cfc25cc492', 100, '2023-11-10', '12:36:14am', '654d09964c6a4');

-- --------------------------------------------------------

--
-- Table structure for table `ngo_account`
--

CREATE TABLE `ngo_account` (
  `ngo_email` varchar(50) NOT NULL,
  `ic_number_representative` varchar(16) NOT NULL,
  `ngo_password` varchar(255) NOT NULL,
  `ouid` varchar(16) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ngo_account`
--

INSERT INTO `ngo_account` (`ngo_email`, `ic_number_representative`, `ngo_password`, `ouid`) VALUES
('healthforall@healthysociety.com', 'MasZVW0jolxAUZ/V', '$2y$10$5VMTz.i.2Msfv1m1/e8t..XAHyCbryGuueFcsVwUSP2t1RsjMfqKm', 'crt654cfcf878ca7'),
('nomorehunger@endhunger.com', 'MasZVG0oolxFU5jf', '$2y$10$hbx7p/V/v8vV/8h7aYTfr.MTLW8SLCiDYFc6pyDxQAIxEqjaZa2S6', 'crt654d0b885f7a2');

-- --------------------------------------------------------

--
-- Table structure for table `ngo_activity`
--

CREATE TABLE `ngo_activity` (
  `activity_name` varchar(100) NOT NULL,
  `activity_id` varchar(13) NOT NULL,
  `activity_info` text NOT NULL,
  `address_line` varchar(100) NOT NULL,
  `postal_code` varchar(5) NOT NULL,
  `city` varchar(15) NOT NULL,
  `state` varchar(17) NOT NULL,
  `activity_date` varchar(10) NOT NULL,
  `closing_date` varchar(10) NOT NULL,
  `activity_time` varchar(15) NOT NULL,
  `participation_limit` int(5) NOT NULL,
  `current_participant` int(5) NOT NULL,
  `activity_status` varchar(8) NOT NULL,
  `activity_banner` varchar(34) NOT NULL,
  `ouid` varchar(16) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ngo_activity`
--

INSERT INTO `ngo_activity` (`activity_name`, `activity_id`, `activity_info`, `address_line`, `postal_code`, `city`, `state`, `activity_date`, `closing_date`, `activity_time`, `participation_limit`, `current_participant`, `activity_status`, `activity_banner`, `ouid`) VALUES
('Distribute Tester to Old Folks Home', '654d0a043e549', 'We need volunteer to distribute thee blood pressure tester to the old folks home, and teach the person in charge how to use.', 'The jubilee old folks home', '11600', 'GeorgeTown', 'Pulau Pinang', '2023-11-25', '2023-11-20', '10:00AM-2:00PM', 10, 3, 'listed', 'crt654cfcf878ca7654d0a043e557.jpg', 'crt654cfcf878ca7');

-- --------------------------------------------------------

--
-- Table structure for table `ngo_campaign`
--

CREATE TABLE `ngo_campaign` (
  `campaign_name` varchar(100) NOT NULL,
  `campaign_id` varchar(13) NOT NULL,
  `campaign_info` text NOT NULL,
  `raise_goal` int(6) NOT NULL,
  `progress` int(6) NOT NULL,
  `closing_date` varchar(10) NOT NULL,
  `ouid` varchar(16) NOT NULL,
  `campaign_status` varchar(8) NOT NULL,
  `campaign_banner` varchar(34) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ngo_campaign`
--

INSERT INTO `ngo_campaign` (`campaign_name`, `campaign_id`, `campaign_info`, `raise_goal`, `progress`, `closing_date`, `ouid`, `campaign_status`, `campaign_banner`) VALUES
('Fund for Blood Pressure Tester', '654d09964c6a4', 'Buying Blood Pressure Tester for Old Folks Home', 5000, 1150, '2023-11-20', 'crt654cfcf878ca7', 'listed', 'crt654cfcf878ca7654d09964c6b1.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `ngo_profile`
--

CREATE TABLE `ngo_profile` (
  `ngo_email` varchar(50) NOT NULL,
  `ouid` varchar(16) NOT NULL,
  `ngo_name` varchar(150) NOT NULL,
  `register_number` varchar(16) NOT NULL,
  `ngo_contact` varchar(11) NOT NULL,
  `address_line` varchar(100) NOT NULL,
  `city` varchar(15) NOT NULL,
  `state` varchar(17) NOT NULL,
  `postal_code` int(5) NOT NULL,
  `profile_path` varchar(34) NOT NULL,
  `banner_path` varchar(34) NOT NULL,
  `ngo_bio` text NOT NULL,
  `ngo_url` text NOT NULL,
  `ngo_category` varchar(17) NOT NULL,
  `ngo_status` varchar(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ngo_profile`
--

INSERT INTO `ngo_profile` (`ngo_email`, `ouid`, `ngo_name`, `register_number`, `ngo_contact`, `address_line`, `city`, `state`, `postal_code`, `profile_path`, `banner_path`, `ngo_bio`, `ngo_url`, `ngo_category`, `ngo_status`) VALUES
('healthforall@healthysociety.com', 'crt654cfcf878ca7', 'Health4All', '156-77A-561', '0164512238', '33-01-01, HITECH Building, North Zone', 'Bayan Lepas', 'Pulau Pinang', 11900, 'crt654cfcf878ca7654cfd5fbf601.jpg', 'crt654cfcf878ca7654cfd5fbf604.jpg', 'Health4All', 'www.healthtoall.healthysociety.com', 'Healthcare', 'listed'),
('nomorehunger@endhunger.com', 'crt654d0b885f7a2', 'No More Hunger Food Bank', '156-17A-443', '0164785231', '33-01-01, The Ozone Industrial Park', 'GeorgeTown', 'Pulau Pinang', 11900, 'crt654d0b885f7a2654d0bd7ef78b.webp', 'crt654d0b885f7a2654d0bd7ef78e.jpeg', 'Everyone should have access to food', 'www.endhunger.com', 'Food Bank', 'unlisted');

-- --------------------------------------------------------

--
-- Table structure for table `participants_record`
--

CREATE TABLE `participants_record` (
  `rid` int(11) NOT NULL,
  `participant_name` varchar(82) NOT NULL,
  `participant_uid` varchar(13) NOT NULL,
  `register_date` varchar(10) NOT NULL,
  `register_time` varchar(10) NOT NULL,
  `activity_id` varchar(13) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `participants_record`
--

INSERT INTO `participants_record` (`rid`, `participant_name`, `participant_uid`, `register_date`, `register_time`, `activity_id`) VALUES
(1, 'Joyce Lee', '654cf9015008a', '2023-11-10', '12:35:03am', '654d0a043e549'),
(2, 'Jessica Ooi ', '654cfa34ba5ee', '2023-11-10', '12:35:31am', '654d0a043e549'),
(3, 'Koay Kah Sun', '654cfc25cc492', '2023-11-10', '12:36:19am', '654d0a043e549');

-- --------------------------------------------------------

--
-- Table structure for table `user_account`
--

CREATE TABLE `user_account` (
  `ic_number` varchar(16) NOT NULL,
  `uid` varchar(13) NOT NULL,
  `name` varchar(82) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email_address` varchar(50) NOT NULL,
  `phone_number` varchar(11) NOT NULL,
  `gender` varchar(6) NOT NULL,
  `address_line` varchar(100) NOT NULL,
  `city` varchar(15) NOT NULL,
  `state` varchar(17) NOT NULL,
  `postal_code` int(5) NOT NULL,
  `account_status` varchar(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_account`
--

INSERT INTO `user_account` (`ic_number`, `uid`, `name`, `password`, `email_address`, `phone_number`, `gender`, `address_line`, `city`, `state`, `postal_code`, `account_status`) VALUES
('MKAYXG8jolNDVJXf', '654cfc25cc492', 'Koay Kah Sun', '$2y$10$Oak.ukSTQDDgfeoyNpmhvuiQLYtb6s8Ax/dhnJx7VzLVfWe8HBaGm', 'kahsun01@gmail.com', '0175589306', 'Male', '33-01-01, Ivorry Tower, The Helium Residence, North Side', 'Ipoh', 'Perak', 30200, 'unlock'),
('MKQZX20iolxFU5na', '654cfa34ba5ee', 'Jessica Ooi ', '$2y$10$qsswA1a59lMKjnDa0fwWn.tSr4CudIUKZZto8xKShE1o.4OOLFYoO', 'jessica_0302@gmail.com', '0175406143', 'Female', '10-01-01, Platinium Tower, The Entopia Residence, North Side', 'Bayan Lepas', 'Pulau Pinang', 11600, 'unlock'),
('OaIZWW0molxFU5jY', '654cf9015008a', 'Joyce Lee', '$2y$10$nqj.p3iS4CtAtCiesHO/6.LzgZyu4q6RZjJQ5xTzX4cZafgOa2UE.', 'joyce0506@gmail.com', '0165976993', 'Female', '33-01-01, Platinium Tower, The Entopia Residence, North Side', 'Bayan Lepas', 'Pulau Pinang', 11900, 'unlock'),
('P6QZWW0oo1tAVJ7f', '654cfb1c1749e', 'Simon Lee', '$2y$10$dV6TVNhXRXzcY4p.pOh6ru8tE0s206xHvwLW.KaiE3vfd/3Rw.UGS', 'simon55@gmail.com', '0164713383', 'Male', '10-01-01, Mansion Tower, The Rainbow Residence, North Side', 'Shah Alam', 'Selangor', 40100, 'unlock');

-- --------------------------------------------------------

--
-- Table structure for table `user_profile`
--

CREATE TABLE `user_profile` (
  `uid` varchar(13) NOT NULL,
  `name` varchar(82) NOT NULL,
  `bio` varchar(100) NOT NULL,
  `profile_path` varchar(31) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_profile`
--

INSERT INTO `user_profile` (`uid`, `name`, `bio`, `profile_path`) VALUES
('654cf9015008a', 'Joyce Lee', 'Hi, I am Joyce Lee', '654cf9015008a654cf9157ba78.jpg'),
('654cfa34ba5ee', 'Jessica Ooi', 'Hi, Im Jessica Ooi', '654cfa34ba5ee654d088393a49.jpg'),
('654cfb1c1749e', 'Simon Lee', 'Hi, I am Simon Lee', '654cfb1c1749e654cfb2616ce4.jpg'),
('654cfc25cc492', 'Koay Kah Sun', 'Koay Kah Sun', '654cfc25cc492654cfc2db50b6.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `access_log`
--
ALTER TABLE `access_log`
  ADD PRIMARY KEY (`log_id`);

--
-- Indexes for table `admin_account`
--
ALTER TABLE `admin_account`
  ADD PRIMARY KEY (`admin_ic`),
  ADD UNIQUE KEY `admin_id` (`admin_id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `donors_record`
--
ALTER TABLE `donors_record`
  ADD PRIMARY KEY (`rid`),
  ADD KEY `campaign_id_fk` (`campaign_id`),
  ADD KEY `donor_uid_fk` (`donor_uid`);

--
-- Indexes for table `ngo_account`
--
ALTER TABLE `ngo_account`
  ADD PRIMARY KEY (`ngo_email`),
  ADD UNIQUE KEY `ouid` (`ouid`);

--
-- Indexes for table `ngo_activity`
--
ALTER TABLE `ngo_activity`
  ADD PRIMARY KEY (`activity_id`),
  ADD KEY `activity_ouid_fk` (`ouid`);

--
-- Indexes for table `ngo_campaign`
--
ALTER TABLE `ngo_campaign`
  ADD PRIMARY KEY (`campaign_id`),
  ADD KEY `campaign_ouid_fk` (`ouid`);

--
-- Indexes for table `ngo_profile`
--
ALTER TABLE `ngo_profile`
  ADD UNIQUE KEY `ouid` (`ouid`),
  ADD KEY `ngo_email_fk` (`ngo_email`);

--
-- Indexes for table `participants_record`
--
ALTER TABLE `participants_record`
  ADD PRIMARY KEY (`rid`),
  ADD KEY `activity_id_fk` (`activity_id`),
  ADD KEY `participant_uid_fk` (`participant_uid`);

--
-- Indexes for table `user_account`
--
ALTER TABLE `user_account`
  ADD PRIMARY KEY (`ic_number`),
  ADD UNIQUE KEY `uid` (`uid`),
  ADD UNIQUE KEY `email_address` (`email_address`);

--
-- Indexes for table `user_profile`
--
ALTER TABLE `user_profile`
  ADD UNIQUE KEY `uid` (`uid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `access_log`
--
ALTER TABLE `access_log`
  MODIFY `log_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `donors_record`
--
ALTER TABLE `donors_record`
  MODIFY `rid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `participants_record`
--
ALTER TABLE `participants_record`
  MODIFY `rid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `donors_record`
--
ALTER TABLE `donors_record`
  ADD CONSTRAINT `campaign_id_fk` FOREIGN KEY (`campaign_id`) REFERENCES `ngo_campaign` (`campaign_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `donor_uid_fk` FOREIGN KEY (`donor_uid`) REFERENCES `user_account` (`uid`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `ngo_activity`
--
ALTER TABLE `ngo_activity`
  ADD CONSTRAINT `activity_ouid_fk` FOREIGN KEY (`ouid`) REFERENCES `ngo_account` (`ouid`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `ngo_campaign`
--
ALTER TABLE `ngo_campaign`
  ADD CONSTRAINT `campaign_ouid_fk` FOREIGN KEY (`ouid`) REFERENCES `ngo_account` (`ouid`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `ngo_profile`
--
ALTER TABLE `ngo_profile`
  ADD CONSTRAINT `ngo_email_fk` FOREIGN KEY (`ngo_email`) REFERENCES `ngo_account` (`ngo_email`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `ngo_ouid_fk` FOREIGN KEY (`ouid`) REFERENCES `ngo_account` (`ouid`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `participants_record`
--
ALTER TABLE `participants_record`
  ADD CONSTRAINT `activity_id_fk` FOREIGN KEY (`activity_id`) REFERENCES `ngo_activity` (`activity_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `participant_uid_fk` FOREIGN KEY (`participant_uid`) REFERENCES `user_account` (`uid`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `user_profile`
--
ALTER TABLE `user_profile`
  ADD CONSTRAINT `uid_fk` FOREIGN KEY (`uid`) REFERENCES `user_account` (`uid`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
