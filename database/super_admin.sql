-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 23, 2023 at 08:56 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `super_admin`
--

-- --------------------------------------------------------

--
-- Table structure for table `activity_logs`
--

CREATE TABLE `activity_logs` (
  `name` varchar(50) NOT NULL,
  `admin_id` int(50) NOT NULL,
  `date_change` datetime NOT NULL DEFAULT current_timestamp(),
  `department` varchar(50) NOT NULL,
  `status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `activity_logs`
--

INSERT INTO `activity_logs` (`name`, `admin_id`, `date_change`, `department`, `status`) VALUES
('Albert', 11, '2023-11-18 21:31:23', 'INVENTORY', 'active'),
('Jed', 12, '2023-11-18 21:36:33', 'REPOSITORY', 'inactive'),
('Jed Mico', 13, '2023-11-18 22:06:14', 'REPOSITORY', 'inactive');

-- --------------------------------------------------------

--
-- Table structure for table `admin_user`
--

CREATE TABLE `admin_user` (
  `ID` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `access` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin_user`
--

INSERT INTO `admin_user` (`ID`, `username`, `password`, `access`) VALUES
(1, 'admin', 'admin', 'super_admin'),
(2, 'user', 'user', 'user');

-- --------------------------------------------------------

--
-- Table structure for table `user_list`
--

CREATE TABLE `user_list` (
  `id` int(11) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `middlename` varchar(50) NOT NULL,
  `added_at` date NOT NULL DEFAULT current_timestamp(),
  `gender` varchar(10) NOT NULL,
  `age` int(100) NOT NULL,
  `email` varchar(50) NOT NULL,
  `contact` varchar(50) NOT NULL,
  `address` varchar(200) NOT NULL,
  `department` varchar(50) NOT NULL,
  `empID` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  `photo` blob NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_list`
--

INSERT INTO `user_list` (`id`, `lastname`, `firstname`, `middlename`, `added_at`, `gender`, `age`, `email`, `contact`, `address`, `department`, `empID`, `password`, `photo`) VALUES
(75, 'Semborio', 'Charlimagne', 'Bacala', '0000-00-00', 'Male', 21, 'charu.sembo@gmail.com', '12332', '', 'HR', '9372', 'Chario9372', ''),
(76, 'Desonia', 'Jed Mico Rizzqw', 'Victorious', '0000-00-00', 'Male', 22, 'jmdesonia10@gmail.com', '09123456789', '', 'HR', '7651', 'Jednia7651', ''),
(92, 'rick', 'pat', 'haguimit', '2023-11-20', 'Male', 23, 'pat@gmail.com', '091231231231', '', 'Repository', '8526', 'patick8526', ''),
(94, 'ng', 'jed', 'minecraft', '2023-11-20', 'Male', 22, 'jed@gmail.com', '12333', '', 'Repository', '7015', 'jedng7015', ''),
(95, 'mas', 'noah', 'pinainit', '2023-11-20', 'Male', 21, 'noah@gmail.com', '1232', '', 'HR', '8095', 'noamas8095', ''),
(96, 'ito', 'naway', 'gumana shish', '2023-11-20', 'Male', 22, 'na@gmail.com', '12', '', 'HR', '3564', 'nawito3564', ''),
(97, 'kjkj', 'sdssdsd', 's', '2023-11-20', 'Male', 12, 'asd12@gmail.com', '12123', '', 'HR', '4166', 'sdsjkj4166', ''),
(102, 'mga', 'ang', 'ibon', '2023-11-21', 'Male', 33, 'ang@gmail.com', '1233', '', 'HR', '1001', 'angmga1001', ''),
(103, 'na ', 'ito', 'last', '2023-11-21', 'Male', 45, 'whoah@gmail.com', '123213', '', 'HR', '1270', 'itona 1270', ''),
(104, 'ken', 'ken', 'kon', '2023-11-21', 'Male', 23, 'sd@gmail.com', '2323', '', 'HR', '2927', 'kenken2927', ''),
(105, 'ng', 'kilabot', 'gabi', '2023-11-21', 'Male', 22, '12asd@gmail.com', '232323', '', 'HR', '6023', 'kilng6023', ''),
(106, 'kjkjd', 'jhsjd', 'we', '2023-11-21', 'Male', 21, 'jjjjjjd@gmail.com', '983298', '', 'HR', '4990', 'jhskjd4990', ''),
(107, 'ar', 'ch', 'li', '2023-11-21', 'Male', 21, 'huhu@gmail.com', '123', '', 'HR', '8947', 'char8947', ''),
(108, 'sdsd', 'sampu', 'jhsd', '2023-11-21', 'Male', 21, 'asd@gmail.com', '123', '', 'HR', '2330', 'samdsd2330', ''),
(109, 'asdjhs', 'hfj', 'asdjhj', '2023-11-21', 'Male', 12, 'dasjd@gmail.com', '123213', '', 'HR', '3711', 'hfjjhs3711', ''),
(117, 'again', 'sample', 'naman', '2023-11-21', 'Male', 21, 'namn@gmail.com', '0912312332123', '', 'Inventory', '7100', 'samain7100', ''),
(118, 'klklk', 'kjkjk', 'klklkl', '2023-11-21', 'Male', 23, 'asdlk@gmail.com', '09812312321', '', 'HR', '4640', 'kjkklk4640asdsads11', ''),
(119, 'miguela', 'patrick', 'jin', '2023-11-21', 'Male', 50, 'mgapogi@gmail.com', '0912323', '', 'HR', '1476', 'badboys', ''),
(120, 'asdsdhkjkjk', 'asdmn', 'djsh', '2023-11-21', 'Male', 12, 'sadkj@gmail.com', '123192837', '', 'HR', '9254', 'asdkjk9254', ''),
(121, 'flag', 'wavin', 'coke', '2023-11-21', 'Male', 11, 'wavin@gmail.com', '1239821398', '', 'HR', '9359', 'wavlag9359', ''),
(122, 'flager', 'wavinnnn', 'shish', '2023-11-21', 'Male', 12, 'what@gmail.com', '123213098', '', 'HR', '6158', 'wavger6158', ''),
(123, 'asjdhsadjh', 'asdjh', 'asdjhasdlkjh', '2023-11-21', 'Male', 16, 'asdjh!@gmail.com', '1239821398', '', 'HR', '1700', 'asddjh1700', ''),
(124, 'iqiquq', 'ows', 'ksadkjaj', '2023-11-21', 'Male', 56, 'asdkj1232@gmail.com', '9123812398', '', 'HR', '6839', 'qwequq68391212', ''),
(125, 'qyu', 'asdn', 'yuie', '2023-11-21', 'Male', 12, 'asdj@gmail.com', '12398', '', 'HR', '9003', 'asdqyu9003', ''),
(126, 'night', 'goodqwasd', 'na', '2023-11-21', 'Female', 12, 'good@gmail.com', '123213', '', 'Inventory', '5081', 'googht5081', ''),
(127, 'aaaa', 'asd', 'assd', '2023-11-22', 'Male', 12, 'qwe@gmail.com', '12323', '', 'HR', '2506', 'asdaaa2506', ''),
(128, 'dg', 'gd', 'gd', '2023-11-22', 'Male', 12, 'gd@gmail.com', '78', '', 'HR', '6144', 'gddg6144', ''),
(129, 'sds', 'sda', 'asdsdsd', '2023-11-22', 'Male', 12, 'asd@gmail.com', '232', '', 'HR', '4571', 'sdasds4571', ''),
(130, 'kol', 'kol', 'kol', '2023-11-22', 'Male', 23, 'kol@gmail.com', '232', '', 'Inventory', '8449', 'kolkol8449', ''),
(131, 'asd', 'qwe', 'qwe', '2023-11-22', 'Male', 12, 'er@gmail.comasds', '11', '', 'Inventory', '1867', 'qweasd1867', ''),
(132, 'sdsd', 'asds', 'asd', '2023-11-22', 'Male', 12, 'w@gmail.com', '132', '', 'HR', '9054', 'asddsd9054', ''),
(133, 'sdsdsdsd', 'asdsdsdsd', 'sdssdsdsds', '2023-11-22', 'Male', 21, 'asdasd@gmail.comss', '123232', '', 'Repository', '9611', 'asddsd9611', ''),
(134, 'Miguela', 'Albert', 'Pogi', '2023-11-22', 'Male', 22, 'miguela@gmail.com', '09123123546', '', 'Inventory', '6923', 'Albela6923', ''),
(135, 'lang', 'Jin', 'sakalam', '2023-11-22', 'Male', 21, 'jin@gmail.com', '09565656565', 'asdkjadkj St. QC PH', 'HR', '7156', 'Jinang7156', ''),
(136, 'hope', 'i', 'so', '2023-11-22', 'Male', 22, 'jope@gmail.com', '23232', 'sdasd', 'Inventory', '4395', 'iope4395', 0x75706c6f6164732f70686f746f5f363535653264303735663132352e504e47),
(137, 'ss', 'asdssds', 'sdad', '2023-11-22', 'Male', 12, 'as@gmail.com', '12323', 'sdads', 'HR', '4510', 'asdss4510', 0x75706c6f6164732f70686f746f5f363535653264343732356133352e676966),
(138, 'ohw', 'who', 'hwo', '2023-11-22', 'Male', 23, 'cha2323@gmail.com', '1232', 'asdkjadkj St. QC', 'Inventory', '7074', 'whoohw7074', 0x75706c6f6164732f70686f746f5f363535653266303865313264342e676966),
(139, 'Miguela', 'Albert', 'pogiiii', '2023-11-22', 'Male', 21, 'asd@gmail.com', '12323', 'asdsda ', 'Inventory', '1512', 'Albela1512', 0x75706c6f6164732f70686f746f5f363535653333353761373933632e6a7067),
(140, 'asdsad', 'Maricris', 'asdsadsad', '2023-11-22', 'Female', 78, 'asdj12h@gmail.com', '12332', 'asdkjadkj St. QC PH', 'HR', '51647572', 'Marsad7572asasdasdadsad', 0x75706c6f6164732f70686f746f5f363535653335303633666333352e676966),
(141, 'sdsd', 'Charlimagne', 'qw', '2023-11-22', 'Male', 12, 'charu123123@gmail.com', '123', 'asdkjadkj St. QC PH', 'Inventory', '55796314', 'Chadsd6314', 0x75706c6f6164732f70686f746f5f363535653433396635353039622e6a7067),
(142, 'sdsdsd', 'Charlimagne', 'sdsdsdsdssdsdsd', '2023-11-22', 'Male', 22, 'chsdsd@gmail.com', '12332', 'asdkjadkj St. QC PH', 'Inventory', '62721720', 'Chadsd1720', ''),
(143, 'Semborio', 'asd', 'ss', '2023-11-22', 'Male', 21, 'charqwembo@gmail.com', '123', 'asdkjadkj St. QCasd', 'Inventory', '39443392', 'asdrio3392', 0x75706c6f6164732f70686f746f5f363535653438363436616337312e706e67),
(144, 'Doe', 'John', 'Cruz', '2023-11-23', 'Male', 34, 'john_doe@gmail.com', '09785647328', 'B12 L10 Sta. Lucia West Fairview Quezon City', 'Inventory', '67310547', 'JohDoe0547', 0x75706c6f6164732f70686f746f5f363535656335363964306632302e6a7067),
(145, 'sana', 'capstone', 'defended', '2023-11-23', 'Male', 21, 'cap@gmail.com', '09785647382', 'QC PH', 'Inventory', '22951154', 'capana1154', 0x75706c6f6164732f70686f746f5f363535656437343663393066312e6a7067),
(146, 'again', 'adudu', 'huh', '2023-11-23', 'Male', 23, 'cha23132u@gmail.com', '2321', 'asdkjadkj St. QC PH', 'Inventory', '39429256', 'samain9256', 0x75706c6f6164732f70686f746f5f363535656438363161336162362e6a7067),
(147, 'Dela Cruz', 'John', 'Vic', '2023-11-23', 'Male', 21, 'vic@gmail.com', '12323', 'asdkjadkj St. QC PH', 'Repository', '16998235', 'Johruz8235', 0x75706c6f6164732f70686f746f5f363535656536343237333632622e6a7067),
(148, 'i ', 'now', 'never', '2023-11-23', 'Male', 12, 'chawwwwru@gmail.com', '123', 'asdkjadkj St. QC PH', 'Inventory', '43554059', 'nowi 4059', ''),
(149, 'yes', 'haha', 'gumana', '2023-11-23', 'Male', 21, 'chasdasdru@gmail.com', '12332', 'asdsda ', 'HR', '90433849', 'hahyes3849', ''),
(150, 'so', 'hope', 'gumana', '2023-11-23', 'Male', 21, 'hope@gmail.com', '232323', 'sdads', 'Inventory', '70441066', 'hopso1066', ''),
(151, 'sda', 'asd', 'sdsa', '2023-11-23', 'Male', 21, 'char123u.sembo@gmail.com', '123236', 'sdasd', 'HR', '33801623', 'asdsda1623', ''),
(152, 'naitu', 'grabe', 'guys', '2023-11-23', 'Male', 21, 'charrrrrru@gmail.com', '12323', 'asdsda ', 'Inventory', '85926389', 'graitu6389', ''),
(153, 'rg', 'gr', 'gg', '2023-11-23', 'Male', 12, 'jmdesoasdsadnia10@gmail.com', '3213', 'asdsad as', 'Inventory', '67763638', 'grrg3638', ''),
(154, 'wew', 'sample', 'wewewe', '2023-11-23', 'Female', 22, 'char123em11@gmail.com', '123', 'sdasd', 'Inventory', '66595335', 'samwew5335', ''),
(155, 'sdsd', 'naway', 'lhkjhgf', '2023-11-23', 'Male', 11, 'afghjksd@gmail.com', '34543545', 'asdsda ', 'HR', '44786250', 'nawdsd6250', 0x706174682f746f2f796f75722f75706c6f61642f6469726563746f72792f6e617761795f70686f746f2e6a7067),
(156, 'Miguela', 'sample', 'shish', '2023-11-23', 'Male', 23, 'kjhyukmn@gmail.com', '09635335619', 'asdkjadkj St. QC', 'Inventory', '50558361', 'samela8361', 0x696d672f73616d706c655f70686f746f2e6a7067),
(157, 'uytr', 'Albert', 'qwertyu', '2023-11-23', 'Male', 7, 'jmdesonidfxa10@gmail.com', '12323', 'asdkjadkj St. QC PH', 'Repository', '34615722', 'Albytr5722', 0x433a78616d70706874646f63734f7065726174696f6e53797374656d696d67416c626572745f70686f746f2e6a7067),
(158, 'ssadas', 'Albert', 'qwewqe', '2023-11-23', 'Male', 21, 'charu.sembo@gmail.com', '12332', 'sdasd', 'Inventory', '10395009', 'Albdas5009', ''),
(159, 'si ', 'inaapi', 'adu', '2023-11-23', 'Male', 22, 'jmdeson123232ia10@gmail.com', '12332', 'asdkjadkj St. QC PH', 'Inventory', '24897076', 'inasi 7076', ''),
(160, 'sdada', 'Albert', 'ddd', '2023-11-23', 'Male', 22, 'chaasdsadborio11@gmail.com', '123', 'asdsda ', 'Repository', '27529449', 'Albada9449', 0x75706c6f6164732f70686f746f5f363535663031643432383966322e706e67),
(161, 'asd', 'sample', 'grabe', '2023-11-23', 'Male', 23, 'charlimagssorio11@gmail.com', '12323', 'asdkjadkj St. QC', 'Inventory', '86089661', 'samasd9661', 0x433a78616d70706874646f63734f7065726174696f6e53797374656d696d6770686f746f5f363535663032353566333265352e706e67),
(162, 'fhf', 'naway', 'asdsakj', '2023-11-23', 'Male', 27, 'charlqwem11@gmail.com', '123', 'asdkjadkj St. QC PH', 'Inventory', '68563629', 'nawfhf3629', 0x75706c6f6164732f70686f746f5f363535663035356562643361362e706e67);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_user`
--
ALTER TABLE `admin_user`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `user_list`
--
ALTER TABLE `user_list`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_user`
--
ALTER TABLE `admin_user`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `user_list`
--
ALTER TABLE `user_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=163;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
