-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 28, 2023 at 06:28 PM
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
('CAG1001', 'OaIZWW0nolxFU5/Y', 'Alyssa', 'alyssa.woods@cherish.com', '$2y$10$N608dXBjtS/bwnD/c9xwxuqwj9y4TWAtIewJMfh3A5ZgeHsccsA4m');

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
('afd@disabledassociation.org', 'MaQZX2wpolxEWprc', '$2y$10$NsnBclg4z8aiRqW0UfthUue6avrio4oFYwXNKiOQPMiZ5J0ogQrTW', 'crt65660f4d64751'),
('booksproject@booktoall.org', 'PqIYXGwkolhEV5/e', '$2y$10$XfCnVllcKRw7S0m/U.TkceqFAfjREnJgAe9WbcYe9C0KUOUr5Of2m', 'crt6566013e6dd8d'),
('careclub@thecareclub.org', 'MKoZW2wnolxGWp3e', '$2y$10$6KvJbDU9VTk1c0EOt46R5.oYbTZcz53I55XhnJfsuzTfAoyWI9TKu', 'crt6566072321112'),
('cfmm@mentalhealthcenter.org', 'MaMYXWwmolxNV5re', '$2y$10$dAgQmKmM9P94DoA6HaO47.WNM4v/J4WOPGWDGQo3NGiqn/Y1WiCL.', 'crt65660808ae4be'),
('ecct@extracaretrust.org', 'MKAZWGwmolxBV53d', '$2y$10$N42elxi5KKyxqSu/AtGbgePZL.Ag3.y2/c30eI88xG3tF4xitYTHO', 'crt6566060f1c77c'),
('educatedfuture@futurevision.org', 'PqYZXWwlolxFU5jb', '$2y$10$8OlceAuEYW8JUfRzfSfMdOruzMzEi.BphM/u.YiNNKtZDUzEzB34u', 'crt656600681f0b6'),
('evndefense@environmentguardian.com', 'MKEYXm0kolxMVpTd', '$2y$10$al0R/SWn/4L8WbcGsOXQROeztGrGMJgdq65UoZiyGGMA.xAGrWWrO', 'crt65660b069a87e'),
('foodneeds@foodnecessity.org', 'OaIZXWwkolxHVZjc', '$2y$10$hqNbyrLz6m4jRlMKBtk2ZOakk3UxQ9na4ycmKP4VMRHXWnZWrRrle', 'crt656604f25e6c5'),
('fsts@straytostay.com', 'MKcYXGwlolxFU5/Z', '$2y$10$7hDR.taCODV7l6tcLuWZx.CMikvjOoIjOK8jMB4TfiL5tC97omPiK', 'crt6565fc1dd5c6b'),
('fww@foodwatch.org', 'MKAZWm8jolxFVZna', '$2y$10$zaCm9Sebpb6coQK.8ysfFeYSY2vZeUtEBt7sKo2IHjp.k77V31/ze', 'crt6566044669f76'),
('healthcareforall@greaterpurpose.org', 'MaUYXm0holxFWp/V', '$2y$10$Hkfm7r4waUPtRiVMM01KTu9g/waHtoDrGmWHNMAxyCLo2Hly0YIMS', 'crt6566026de97fd'),
('livehope@livinghope.org', 'MKYZWW8holxFV53f', '$2y$10$j5IH8wyeIUw/qYNYfLmrQ..g7BiUHuq.optKMicDebhf.oaDB4rUO', 'crt6565ff3d4d1c5'),
('lovetheenvironment@envlove.com.my', 'MaIZVW8nolxAUJTb', '$2y$10$UELyWxrE/C6Di8Y2MVrdpegZFm8fkjwDeI9FUQjkxmo8WAsygvXs2', 'crt65660de3cf50b'),
('mhca@mentalhealthcare.org', 'MKcZWW8molxNUZXV', '$2y$10$9x48W.Yl.53Bj0MC9cOHjuvbk6wwodu5o6LLzdz7YFxR8BI2ZEFk2', 'crt656609bd836b3'),
('rshv@rescuehaven.org', 'MaQYXW0jol5FU5nZ', '$2y$10$ynEWbmsMyPnQEDt/GqTk2OVTIMKPD72UknMDqbFR7YaiNkD441DQu', 'crt6565fd12e95c1'),
('savechild@savechildfoundation.org', 'MaYZX2wnolhEV53f', '$2y$10$S25hiw5rgDmgX5KVLujSI.LJT3w3.Vac23UW5jBuPgGtilDt7sZUO', 'crt6565fe4291806'),
('tac@ablecharities.org', 'PqoZVGwgolxNUZrb', '$2y$10$eLPJl2c.SkOjE18VJ6V2u.LxLpO/AlIu23ykI57Azns9eQpX7XS62', 'crt65660fe543b9a'),
('thrivelife@thrivinglife.com', 'MKIZWW8kolxGWpnU', '$2y$10$t7dwYUhFGlaAczB79yUS.OAiomYgvF/olDlTYMxeIiex3CFWefapS', 'crt65660319ae588');

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
('Cleaning the dogs house', '65661d6ee119c', 'We need 5 volunteers to clean the dog house. The dogs in the shelter requires clean house to stay healthy, and currently we are short handed, 5 volunteers needed to help with the dog house cleaning', '15, Jalan Raja 1', '11160', 'Georgetown', 'Pulau Pinang', '2023-12-07', '2023-12-05', '9:00AM-2:00PM', 5, 0, 'new', 'crt6565fc1dd5c6b65661d6ee11ab.jpg', 'crt6565fc1dd5c6b'),
('Play with the dogs', '65661e50125bc', 'We need 5 volunteers to play with the dogs. Lunch provided to the volunteers.', '42, Lorong Jalan Burma, Pulau Tikus', '10350', 'GeorgeTown', 'Pulau Pinang', '2023-12-05', '2023-12-03', '10:00AM-11:00AM', 5, 0, 'new', 'crt6565fd12e95c165661e50125cb.jpg', 'crt6565fd12e95c1'),
('Daily essential distribtion', '65661eed1f6f9', 'Need 10 volunteers to distribute the newly bought daily essential to different location for the children in need.', '27 Jalan Tikus, Pulau Tikus', '10150', 'Georgetown', 'Pulau Pinang', '2023-12-05', '2023-12-03', '1:00PM-3:00PM', 10, 0, 'new', 'crt6565fe429180665661eed1f705.jpg', 'crt6565fe4291806'),
('The Essential Distribution ', '6566200ee405c', '25 Volunteers is needed to help distribute the essentials to our list of children in need of help. The activity will cover for the volunteers meals.', '45, Lorong Kelawai', '10250', 'Georgetown', 'Pulau Pinang', '2023-12-15', '2023-12-10', '1:00PM-5:00PM', 25, 0, 'new', 'crt6565ff3d4d1c56566200ee406c.jpg', 'crt6565ff3d4d1c5'),
('Teachers Needed.', '656620dd8bbe4', 'We need teacher to help teach our classes that is provided to the children in need. The volunters will be provided with the necessary materials needed for the class.', '88, Jalan Pangkor 1', '11200', 'Tanjung Bungah', 'Pulau Pinang', '2023-12-05', '2023-12-03', '1:00PM-3:00PM', 5, 0, 'new', 'crt656600681f0b6656620dd8bbf3.png', 'crt656600681f0b6'),
('Distribute supplies to the student.', '656621c9d345b', 'We need 5 volunteers to help distribute the school supplies bought to our list of student.', '55, Lebuh Acheh 1', '11020', 'Georgetown', 'Pulau Pinang', '2023-12-07', '2023-12-05', '1:00PM-2:00PM', 5, 0, 'new', 'crt6566013e6dd8d6566220b6a9ee.jpg', 'crt6566013e6dd8d');

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
('Foods for The Shelter', '65661d031b29c', 'Funds needed to buy foods for the animal in the shelter. 50 bags of animal foods are needed.', 3000, 0, '2023-12-05', 'crt6565fc1dd5c6b', 'new', 'crt6565fc1dd5c6b65661d031b2aa.jpg'),
('Dogs Vaccination Funds', '65661dc870187', 'We currently needs fund to help vaccinate the newly comers.', 1000, 0, '2023-12-10', 'crt6565fd12e95c1', 'new', 'crt6565fd12e95c165661dc870190.jpg'),
('New cloths and daily essential', '65661ea719a12', 'Raising funds to buy new cloths and daily essentials for the children in need.', 5000, 0, '2023-12-10', 'crt6565fe4291806', 'new', 'crt6565fe429180665661ea719a1f.jpg'),
('A Hope Passed On', '65661f906f940', 'Raising fund to support the cause of providing daily necessity to the children in need. Food, toiletry, sanitary product and cloths.', 10000, 0, '2023-12-05', 'crt6565ff3d4d1c5', 'new', 'crt6565ff3d4d1c565661f906f94c.jpg'),
('Passing the knowledge torch', '656620753516d', 'Fund to help us continue running our teaching classes for the children in need.', 5000, 0, '2023-12-10', 'crt656600681f0b6', 'new', 'crt656600681f0b6656620753517c.png'),
('School Start Necessity', '656621735f33d', 'Funds to buy school supply for those student in need.', 3000, 0, '2023-12-05', 'crt6566013e6dd8d', 'new', 'crt6566013e6dd8d656621ff5a10e.jpg');

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
('fsts@straytostay.com', 'crt6565fc1dd5c6b', 'From Strary to Stays', '156-77A-561', '0125667411', '15, Jalan Raja 1', 'Georgetown', 'Pulau Pinang', 11600, 'crt6565fc1dd5c6b6565fca9c649d.jpg', 'crt6565fc1dd5c6b6565fca9c64a1.jpg', 'Compassionate Paws Foundation is a dedicated and passionate non governmental organization committed to the cause of animal welfare', 'www.fsts.straytostay.com', 'Animal Welfare', 'listed'),
('rshv@rescuehaven.org', 'crt6565fd12e95c1', 'Rescue Haven', '156-77A-561', '0135564137', '42 Lorong Jalan Burma, Pulau Tikus', 'George Town', 'Pulau Pinang', 10350, 'crt6565fd12e95c16565fe0e65ec4.png', 'crt6565fd12e95c16565fe0e65ec7.jpg', 'Resuce Haven is a dynamic non-profit organization committed to the welfare of animals. Our journey has been fueled by a deep-rooted passion for creating a harmonious coexistence between humans and animals. At the heart of our mission is the belief that every living being deserves respect, care, and a life free from suffering.', 'rshv.resucehaven.org', 'Animal Welfare', 'listed'),
('savechild@savechildfoundation.org', 'crt6565fe4291806', 'Save Child Foundation', '115-37A-153', '0162147532', '27 Jalan Tikus, Pulau Tikus', 'George Town', 'Pulau Pinang', 10150, 'crt6565fe42918066565ff087a3fb.jpg', 'crt6565fe42918066565ff087a3fe.jpg', 'To envision a society where every child experiences a childhood filled with love, security, and opportunities for growth. Save Child Foundation aims to break the cycle of poverty and inequality by addressing the unique needs of children and providing them with the tools to build a better future.', 'savechild.safechildfoundation.org', 'Children Welfare', 'listed'),
('livehope@livinghope.org', 'crt6565ff3d4d1c5', 'Living Hope Foundation', '454-771-13B', '0174235698', '45 Lorong Kelawai', 'Georgetown', 'Pulau Pinang', 10250, 'crt6565ff3d4d1c56566000729ed2.jfif', 'crt6565ff3d4d1c56566000729ed5.jpg', 'Living Hope Foundation is a compassionate non-governmental organization (NGO) devoted to the welfare and empowerment of children. Our organization has been a beacon of hope for countless children facing adversity. At the heart of our mission is the unwavering belief that every child deserves love, care, and the opportunity to thrive in a supportive and nurturing environment.', 'www.livehope.livinghope.org', 'Children Welfare', 'listed'),
('educatedfuture@futurevision.org', 'crt656600681f0b6', 'The Future Vision', '551-339-74N', '0165521147', '88 Jalan Pangkor 1', 'Tanjung Bungah', 'Pulau Pinang', 11200, 'crt656600681f0b6656600fa5d26a.jpg', 'crt656600681f0b6656600fa5d26f.png', 'The Future Vision is a dedicated non-profit organization committed to providing comprehensive support for education. Our mission is rooted in the belief that education is the key to unlocking individual potential and building thriving communities. We are driven by a passion for ensuring that every child, regardless of background, has access to quality education and the resources needed to succeed.', 'www.educatedfuture.futurevision.org', 'Education Support', 'listed'),
('booksproject@booktoall.org', 'crt6566013e6dd8d', 'The Books Project', '784-551-13B', '0124458713', '55 Lebuh Acheh 1', 'Georgetown', 'Pulau Pinang', 10200, 'crt6566013e6dd8d656602340822a.jpg', 'crt6566013e6dd8d656621f5cd42f.jpg', 'The Books Project is a dynamic non-governmental organization (NGO) dedicated to providing unwavering support for education. Our commitment is rooted in the belief that education is a fundamental right that can transform lives and communities. We strive to create an inclusive and equitable educational landscape where every individual has the opportunity to thrive and reach their full potential.', 'booksproject.booktoall.org', 'Education Support', 'listed'),
('healthcareforall@greaterpurpose.org', 'crt6566026de97fd', 'A Greater Purpose', '543-111-AB1', '0123347716', '36A, Lebuh Muntri 15', 'Georgetown', 'Pulau Pinang', 10200, 'crt6566026de97fd656602ea0b8e4.jpg', 'crt6566026de97fd656602ea0b8e8.jpg', 'Navigating Toward Health Equity - Fostering Well-being for All.', 'www.health4all.greaterpurpose.org', 'Healthcare', 'listed'),
('thrivelife@thrivinglife.com', 'crt65660319ae588', 'The Thriving Life', '151-333-N1A', '0175521493', '45A, Jalan Ampang 11', 'Kuala Lumpur Ci', 'Kuala Lumpur', 50450, 'crt65660319ae5886566040b38c19.jpg', 'crt65660319ae5886566040b38c1d.jpg', 'Empowering Lives through Health and Harmony - Building a Resilient Future for All.', 'www.thriveinhealth.thrivinglife.com', 'Healthcare', 'listed'),
('fww@foodwatch.org', 'crt6566044669f76', 'Food and Water Watch', '111-131-47BD', '0128873641', '27A, Jalan Bukit Bintang', 'Kuala Lumpur', 'Kuala Lumpur', 55100, 'crt6566044669f76656604ad81bb9.jpeg', 'crt6566044669f76656604ad81bbe.webp', 'Fighting Hunger, Nourishing Hope - A Community United Against Food Insecurity', 'www.nomorehunger.foodwatch.org', 'Food Bank', 'listed'),
('foodneeds@foodnecessity.org', 'crt656604f25e6c5', 'Food Necessity', 'A12-554-739', '0123347891', '15 Jalan SS 7/19, Kelana Jaya', 'Petaling Jaya,', 'Selangor', 47301, 'crt656604f25e6c5656605bfc3423.png', 'crt656604f25e6c5656605bfc3427.jpg', 'Feeding Hope, Nourishing Lives - Bridging Communities Through Sustainable Food Solutions', 'www.foodneeds.foodnecessity.org', 'Food Bank', 'listed'),
('ecct@extracaretrust.org', 'crt6566060f1c77c', 'Extra Care Charitable Trust', '453-151-NB5', '0175541973', '41A, Jalan SS 15/4, Subang Jaya', 'Petaling Jaya', 'Selangor', 47500, 'crt6566060f1c77c6566067eda5ef.jpg', 'crt6566060f1c77c6566067eda5f3.jpg', 'Dignifying Lives, Enriching Journeys - Fostering Holistic Senior Care with Compassion', 'www.ecct.extracaretrust.org', 'Seniors Welfare', 'listed'),
('careclub@thecareclub.org', 'crt6566072321112', 'The Care Club', '554-337-NMK', '0132247895', '19 Jalan SS 2/10, Taman Universiti', 'Kajang', 'Selangor', 43000, 'crt6566072321112656607d779e8a.jpg', 'crt6566072321112656607d779e93.jpg', 'Celebrating Aging, Fostering Joy - Empowering Seniors for a Fulfilling Journey.', 'www.careclub.thecareclub.org', 'Seniors Welfare', 'listed'),
('cfmm@mentalhealthcenter.org', 'crt65660808ae4be', 'Center for Mental Health', '151-334-KH1', '0134478951', '45A, Jalan Ibrahim', 'Johor Bahru', 'Johor', 80000, 'crt65660808ae4be6566092098114.png', 'crt65660808ae4be656609209811a.jpg', 'Nurturing Minds, Uplifting Lives - Breaking Stigmas, Fostering Mental Well-being.', 'www.cfmm.mentalhealthcenter.org', 'Mental Health', 'listed'),
('mhca@mentalhealthcare.org', 'crt656609bd836b3', 'Mental Health Care Association', '374-167-93M', '0128879546', '33 Jalan Meldrum', 'Johor Bahru', 'Johor', 80000, 'crt656609bd836b365660a6b6a676.png', 'crt656609bd836b365660a6b6a679.jpg', 'Promoting Mental Wellness, Fostering Resilience - Breaking Barriers, Inspiring Hope.', 'www.mha.mentalhealthcare.org', 'Mental Health', 'listed'),
('evndefense@environmentguardian.com', 'crt65660b069a87e', 'Environment Defense', '210-339-KT1', '0168895147', '15A, Jalan Tanjung Puteri', 'Johor Bahru', 'Johor', 80300, 'crt65660b069a87e65660c3ba2dfd.jpg', 'crt65660b069a87e65660c3ba2e01.webp', 'Safeguarding Our Planet, Nurturing Sustainable Communities - Uniting for a Thriving Global Environment', 'www.envdefense.envrionmentguardian.org', 'Enviroment Care', 'listed'),
('lovetheenvironment@envlove.com.my', 'crt65660de3cf50b', 'Environment Love', '743-153-KB1', '0175236891', '12A, Jalan Sultan Azlan Shah', 'Ipoh', 'Perak', 31400, 'crt65660de3cf50b65660f1ad1806.png', 'crt65660de3cf50b65660f1ad1809.jfif', 'Preserving Our Planet, Inspiring Sustainable Living - Uniting Communities for a Greener Future.', 'www.lovenvironment.envlove.com.my', 'Enviroment Care', 'listed'),
('afd@disabledassociation.org', 'crt65660f4d64751', 'Association For Disabled', '571-33-AN1', '0136658741', '78A, Jalan Raja Ekram', 'Ipoh', 'Perak', 30450, 'crt65660f4d6475165660fba8ba9c.jpg', 'crt65660f4d6475165660fba8baa0.jpg', 'Empowering Differently Abled Lives - Advocating for Inclusivity, Independence, and Equality.', 'www.afd.disabledassociation.org', 'Differently Abled', 'listed'),
('tac@ablecharities.org', 'crt65660fe543b9a', 'The Able Charities', '853-331-KT3', '0123365478', '42A, Jalan Tun Abdul Razak', 'Johor Bahru', 'Johor', 80000, 'crt65660fe543b9a6566118130a64.png', 'crt65660fe543b9a6566118130a69.jpg', 'Unleashing Potential, Embracing Diversity - Creating Opportunities for Differently Abled Individuals.', 'www.tac.ablecharities.org', 'Differently Abled', 'listed');

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
('MacYXWwholxEVJXU', '65661a497c941', 'Jennifer Log', '$2y$10$jIOwwhfLe8yyXi3IWc3dFeyPzkggTppp7Y.7YgpZmw3RUBQMmazFS', 'jennifer1111@gmail.com', '0123654715', 'Female', '10A, Jalan Murni', 'Ipoh', 'Perak', 30000, 'unlock'),
('MaEZX28golxEW57V', '65661b43a4e7f', 'Leo Loh', '$2y$10$43s0iMXTgV3PHWcPQ/tte.OXr8J6p/rV//ID5HzNu4.UZPCqUzRpK', 'leo0320@gmail.com', '0125874156', 'Male', '12A, Jalan Bahagia 1', 'Kota Kinabalu', 'Sabah', 88000, 'unlock'),
('MaUZVWwiolxCVZ3a', '65661b9a75225', 'Maia Ooi', '$2y$10$JAziYTgRvEIzmGTryIoSsumwgnHI3Nc9XY2NzqJVcRoO8FE4dDaR6', 'maia0912@gmail.com', '0164475261', 'Female', '45A, Jalan Bahagia 1', 'Ipoh', 'Perak', 30020, 'unlock'),
('MKAZXWwpolxMWp3d', '6566196bc8541', 'Dwayne Ooi', '$2y$10$sjbOB4SId86Oj4E9IoB.VOdHq7ajekUlSJGtUScM.rWXRpHjLk2ly', 'dwayne0119@gmail.com', '0175523697', 'Male', '12B, Jalan Harmony', 'Johor Bahru', 'Johor', 80100, 'unlock'),
('MKMZWWwnolxHUZvc', '6566191191504', 'Carly Lim', '$2y$10$8qukDLxJ.HaGjBYqXOipx.txrLd0ySfPk0SFClZgpfHKpvt3Z3ylC', 'carly0517@gmail.com', '0163324785', 'Female', '56A, Jalan Harmony 1', 'Johor Bahru', 'Johor', 80100, 'unlock'),
('MKoZVG8kolxHVJrY', '6566185bdad62', 'Beatrice Ooi', '$2y$10$pdOPoQQItsoIdwEND3l8xuimABsA/bsEfXd/UeElacdTEjtnbcvLq', 'beatrice0824@gmail.com', '0127895463', 'Female', '25A, Jalan Tranquility 1', ' GeorgeTown', 'Pulau Pinang', 10250, 'unlock'),
('MKUYXmwjolxMV5/c', '6566176069d8d', 'Jessica Lee', '$2y$10$qZJNJdL3XYReVL5lFnHqfeBoeNkUYOIIPUlLsD8JE5XJgG7V/Ujrm', 'jessica1213@gmail.com', '0174453291', 'Female', '42A, Jalan Harmony 1', 'GeorgeTown', 'Pulau Pinang', 10300, 'unlock'),
('MKYZWG0oolxBVpTZ', '65661aa55c4ab', 'Charlie Teoh', '$2y$10$la1R/T3ljtFCjNijQfKKN.M.NjC4zaSynxqaCpr.oiCssq.eByD4.', 'charlie0108@gmail.com', '0126574823', 'Male', '45A, Jalan Sentosa', 'Kuala Lumpur', 'Kuala Lumpur', 50450, 'unlock'),
('OaIZWW0molxFU5jY', '6566169182e29', 'Joyce Lee', '$2y$10$saXnMruQ58xM4NePnH0O0ubTSwWZWA9IUI.ewP575UOHRi.PmLdma', 'joyce0506@gmail.com', '0168952147', 'Female', '45A, Lorong Sungai Ara', 'Bayan Lepas', 'Pulau Pinang', 11900, 'unlock'),
('PqoYXG4holxGVZTf', '65661ae984f2b', 'Ed Tan', '$2y$10$v9rm/omvv0tiouWLP5wXJuRG7Rfq3wgysdiWoJokxUC7r1Y120Xoy', 'ed1031@gmail.com', '0169542311', 'Male', '79A, Jalan Damai 1', 'Kuala Lumpur,', 'Kuala Lumpur', 50200, 'unlock'),
('PqQZWm4golxGUZnc', '656617f5e6073', 'Christine Tan', '$2y$10$fiYTRHz2VIANbNUGoHDk6OaI7g.a2BaMckVO5y4mVYAUVLrxwCJC6', 'christine0630@gmail.com', '0176625891', 'Female', '87A, Lorong Serenity 1', 'Bayan Lepas', 'Pulau Pinang', 11900, 'unlock'),
('PqsZXmwlolxHVprb', '656619dc23e65', 'Brad Lee', '$2y$10$kUB5As6VE/9sFtuD1iZ0N.e9dnzigtOZY0CMBkFH.0dkxx.RXEOoW', 'brad0215@gmail.com', '0123347856', 'Male', '45A, Jalan Serenity 1', 'Melaka City', 'Melaka', 75000, 'unlock');

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
('6566169182e29', 'Joyce Lee', 'Hi, I am Joyce Lee', '6566169182e296566169f48dbd.jpg'),
('6566176069d8d', 'Jessica Lee', 'Hi, I am Jessica Lee', '6566176069d8d6566176af0f42.jpg'),
('656617f5e6073', 'Christine Tan', 'Hi, I am Christine Tan', '656617f5e6073656617ff2a132.jpg'),
('6566185bdad62', 'Beatrice Ooi', 'Hi I am Beatrice Ooi', '6566185bdad62656618690f0a8.jpg'),
('6566191191504', 'Carly Lim', 'Hi, I am Carly Lim', '656619119150465661919c54ad.jpg'),
('6566196bc8541', 'Dwayne Ooi', 'Hi, I am Dwayne', '6566196bc8541656619783dfc0.jpg'),
('656619dc23e65', 'Brad Lee', 'Hi, I am Brad', '656619dc23e65656619e34a23a.jpg'),
('65661a497c941', 'Jennifer Log', 'Hi, I am Jennifer', '65661a497c94165661a50cc23c.jpg'),
('65661aa55c4ab', 'Charlie Teoh', 'Hi, I am Charlie', '65661aa55c4ab65661aac1bc9e.jpg'),
('65661ae984f2b', 'Ed Tan', 'Hi, I am Ed', '65661ae984f2b65661af0977a6.jpg'),
('65661b43a4e7f', 'Leo Loh', 'Hi, I am Leo', '65661b43a4e7f65661b4ad2944.jpg'),
('65661b9a75225', 'Maia Ooi', 'Hi, I am Maia', '65661b9a7522565661ba1b3dc1.jpg');

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
  MODIFY `rid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `participants_record`
--
ALTER TABLE `participants_record`
  MODIFY `rid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

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
