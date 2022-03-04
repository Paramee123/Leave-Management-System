-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 27, 2022 at 06:17 AM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.1.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `elms`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `DelShort` ()  BEGIN
	DECLARE EMP varchar(100);

    DECLARE done INT DEFAULT FALSE;
   	DECLARE MyCursor CURSOR FOR 
    	SELECT DISTINCT EmpCode FROM shortleave;
     DECLARE CONTINUE HANDLER FOR NOT FOUND SET done = TRUE;
    OPEN MyCursor;
    myloop: LOOP
    	FETCH MyCursor INTO EMP;
        
    	IF done THEN
    	  LEAVE myloop;
    	END IF;
    DELETE FROM shortleave WHERE MONTH(CurDate) = MONTH(NOW()) AND EmpCode=EMP LIMIT 2; 
    END LOOP;
    CLOSE MyCursor;
    
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `dif` ()  BEGIN
	DECLARE df int(20);
    DECLARE emp int(11);
	DECLARE done INT DEFAULT FALSE;
    DECLARE exit_loop BOOLEAN DEFAULT FALSE;
	DECLARE MyCursor CURSOR FOR 
	SELECT DATEDIFF(ToDate,FromDate),id FROM tblleaves;
	DECLARE CONTINUE HANDLER FOR NOT FOUND SET exit_loop = TRUE;
	OPEN MyCursor;
    emp_leave: LOOP 
		FETCH MyCursor INTO df,emp;
        IF exit_loop THEN
        	LEAVE emp_leave;
        END IF;
	    UPDATE tblleaves SET DIFF = df WHERE id=emp; 
    END LOOP emp_leave;
	CLOSE MyCursor;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `half` (OUT `InTim` TIME, OUT `OutTim` TIME)  BEGIN
UPDATE attendance SET Type="HALFDAY" WHERE CurDate=CURRENT_DATE AND ((InTime BETWEEN "12:30:00" and "13:00:00") AND OutTime="16:00:00") OR ((OutTime BETWEEN "12:30:00" and "13:00:00")AND InTime="09:00:00");

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `Short` (OUT `InTim` TIME, OUT `OutTim` TIME)  BEGIN
UPDATE attendance SET Type="SHORTLEAVE" WHERE CurDate=CURRENT_DATE AND ((InTime BETWEEN "09:00:00" and "10:00:00") AND OutTime="16:00:00") OR ((OutTime BETWEEN "15:00:00" and "16:00:00")AND InTime="09:00:00");

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `ShortLeave` ()  INSERT INTO shortleave(EmpCode,InTime,OutTime,CurDate,Type)
SELECT EmpCode,InTime,OutTime,CurDate,Type AS CurDate 
FROM attendance
WHERE  
MONTH(CurDate) = MONTH(NOW()) AND Type="SHORTLEAVE"$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `UserName` varchar(100) NOT NULL,
  `Password` varchar(100) NOT NULL,
  `updationDate` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `UserName`, `Password`, `updationDate`) VALUES
(1, 'admin', '827ccb0eea8a706c4c34a16891f84e7b', '2020-07-07 09:30:42');

-- --------------------------------------------------------

--
-- Table structure for table `attendance`
--

CREATE TABLE `attendance` (
  `Empcode` varchar(20) DEFAULT NULL,
  `EmailId` varchar(200) NOT NULL,
  `InTime` time DEFAULT NULL,
  `OutTime` time DEFAULT NULL,
  `CurDate` date DEFAULT NULL,
  `Type` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `attendance`
--

INSERT INTO `attendance` (`Empcode`, `EmailId`, `InTime`, `OutTime`, `CurDate`, `Type`) VALUES
('PHPOINT23', '', '09:42:49', '16:00:00', '2022-01-21', 'SHORTLEAVE'),
('PHPOINT45', '', '09:05:00', '16:00:00', '2022-01-21', 'SHORTLEAVE'),
('PHPOINT23', '', '09:05:00', '16:00:00', '2022-01-26', 'SHORTLEAVE'),
('PHPOINT23', '', '09:43:12', '16:00:00', '2022-01-27', 'SHORTLEAVE'),
('PHPPOINT11', '', '12:45:00', '16:00:00', '2022-01-24', 'HALFDAY'),
('xcxzXczxc', '', '10:54:47', NULL, '2022-01-26', NULL),
('xcxzXczxc', 'aseldeelakaperera@gmail.com', '13:29:17', '13:34:18', '2022-01-26', NULL),
('jhkjg', 'phptpoint@gmail.com', '14:10:27', '15:24:56', '2022-01-26', NULL),
('12345', 'phptpoint@gmail.com', '14:47:30', '15:24:56', '2022-01-26', NULL),
('hwrkfgwqhk.ejqf.jkhu', 'phptpoint@gmail.com', '14:47:44', '15:24:56', '2022-01-26', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `shortleave`
--

CREATE TABLE `shortleave` (
  `EmpCode` varchar(20) NOT NULL,
  `InTime` time NOT NULL,
  `OutTime` time NOT NULL,
  `CurDate` date NOT NULL,
  `Type` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `shortleave`
--

INSERT INTO `shortleave` (`EmpCode`, `InTime`, `OutTime`, `CurDate`, `Type`) VALUES
('PHPOINT23', '09:05:00', '16:00:00', '2022-01-26', 'SHORTLEAVE'),
('PHPOINT23', '09:43:12', '16:00:00', '2022-01-27', 'SHORTLEAVE');

-- --------------------------------------------------------

--
-- Table structure for table `tbldepartments`
--

CREATE TABLE `tbldepartments` (
  `id` int(11) NOT NULL,
  `DepartmentName` varchar(150) DEFAULT NULL,
  `DepartmentShortName` varchar(100) NOT NULL,
  `DepartmentCode` varchar(50) DEFAULT NULL,
  `CreationDate` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbldepartments`
--

INSERT INTO `tbldepartments` (`id`, `DepartmentName`, `DepartmentShortName`, `DepartmentCode`, `CreationDate`) VALUES
(1, 'Human Resource', 'HR', 'HR001', '2017-11-01 07:16:25'),
(2, 'Information Technology', 'IT', 'IT001', '2017-11-01 07:19:37'),
(3, 'Operations', 'OP', 'OP1', '2017-12-02 21:28:56');

-- --------------------------------------------------------

--
-- Table structure for table `tblemployees`
--

CREATE TABLE `tblemployees` (
  `id` int(11) NOT NULL,
  `EmpId` varchar(100) NOT NULL,
  `NamewithInitials` varchar(20) NOT NULL,
  `FirstName` varchar(150) NOT NULL,
  `LastName` varchar(150) NOT NULL,
  `EmailId` varchar(200) NOT NULL,
  `Password` varchar(180) NOT NULL,
  `Gender` varchar(100) NOT NULL,
  `Dob` varchar(100) NOT NULL,
  `Team` varchar(255) NOT NULL,
  `DOJ` varchar(200) NOT NULL,
  `Designation` varchar(1000) NOT NULL,
  `Qualifications` varchar(1000) NOT NULL,
  `Supervisor` varchar(150) NOT NULL,
  `Address` varchar(100) NOT NULL,
  `Phonenumber` char(11) NOT NULL,
  `Status` int(1) NOT NULL,
  `RegDate` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblemployees`
--

INSERT INTO `tblemployees` (`id`, `EmpId`, `NamewithInitials`, `FirstName`, `LastName`, `EmailId`, `Password`, `Gender`, `Dob`, `Team`, `DOJ`, `Designation`, `Qualifications`, `Supervisor`, `Address`, `Phonenumber`, `Status`, `RegDate`) VALUES
(1, 'PHPTPOINT101', '', 'Gautam', 'Arya', 'er.gautamarya@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', 'Male', '3 February, 1999', 'Information Technology', 'Delhi', '', '', 'India', '', '9608993215', 1, '2020-07-07 11:29:59'),
(2, 'PHPTPOINT1012', '', 'sanjeev', 'kumar', 'phptpoint@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', 'Male', '3 February, 1990', 'Information Technology', 'Up', '', '', 'India', '', '8587944255', 1, '2017-11-10 13:40:02'),
(21, 'xcxzXczxc', 'AAPK Jayaratne', 'Paramee', 'Jayaratne', 'aseldeelakaperera@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', 'Female', '2021-12-30', 'Information Technology', '2022-01-16', 'sdfadfsdfdsfasdfsdfdf', ' dsfasdfdsfadsfdsfdfdf\r\n', 'sdfasdfsd', '59/7 , School Lane , Gangodawilla', '0779227152', 1, '2022-01-07 15:53:33'),
(22, 'sdadf', 'asfadsf', 'dsafdsfads', 'sdfasdfsd', 'parameekulangana@gmail.com', '8e186ad5c6d48d10482f4819a3eebc13', 'Female', '2022-01-06', 'Human Resource', '2022-01-19', 'dsafsdfsdf', ' asdfsdfsdfsdfdsf\r\n', 'cgasdfgfd', 'sadfdfsdf', '2144363467', 1, '2022-01-12 03:38:46'),
(23, '12345', 'qqqqqq', 'qqqqqq', 'qqqqq', 'qqq@gmail.com', '730b3045691d75441e5a6704c7ba6ca8', 'Male', '2021-04-06', 'Human Resource', '2021-12-27', 'qqqqq', 'qqqqq', 'qqq', 'qqqq', '0112789456', 1, '2022-01-26 10:00:29');

-- --------------------------------------------------------

--
-- Table structure for table `tblleaves`
--

CREATE TABLE `tblleaves` (
  `id` int(11) NOT NULL,
  `LeaveType` varchar(110) NOT NULL,
  `ToDate` varchar(120) NOT NULL,
  `FromDate` varchar(120) NOT NULL,
  `DIFF` int(11) NOT NULL,
  `Description` mediumtext NOT NULL,
  `PostingDate` timestamp NOT NULL DEFAULT current_timestamp(),
  `AdminRemark` mediumtext DEFAULT NULL,
  `AdminRemarkDate` varchar(120) DEFAULT NULL,
  `Status` int(1) NOT NULL,
  `IsRead` int(1) NOT NULL,
  `empid` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblleaves`
--

INSERT INTO `tblleaves` (`id`, `LeaveType`, `ToDate`, `FromDate`, `DIFF`, `Description`, `PostingDate`, `AdminRemark`, `AdminRemarkDate`, `Status`, `IsRead`, `empid`) VALUES
(23, 'Medical Leave test', '2022-01-13', '2022-01-06', 7, 'hh\r\n', '2022-01-21 08:41:44', 'sdsdsd', '2022-01-22 20:42:29 ', 1, 1, 21),
(26, 'Medical Leave test', '2022-01-19', '2022-01-06', 13, ' vzxcvxcv', '2022-01-21 10:06:13', 'rererer', '2022-01-22 20:42:07 ', 1, 1, 21);

-- --------------------------------------------------------

--
-- Table structure for table `tblleavetype`
--

CREATE TABLE `tblleavetype` (
  `id` int(11) NOT NULL,
  `LeaveType` varchar(200) DEFAULT NULL,
  `Description` mediumtext DEFAULT NULL,
  `CreationDate` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblleavetype`
--

INSERT INTO `tblleavetype` (`id`, `LeaveType`, `Description`, `CreationDate`) VALUES
(1, 'Casual Leave', 'Casual Leave ', '2017-11-01 12:07:56'),
(2, 'Medical Leave test', 'Medical Leave  test', '2017-11-06 13:16:09'),
(3, 'Restricted Holiday(RH)', 'Restricted Holiday(RH)', '2017-11-06 13:16:38');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbldepartments`
--
ALTER TABLE `tbldepartments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblemployees`
--
ALTER TABLE `tblemployees`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblleaves`
--
ALTER TABLE `tblleaves`
  ADD PRIMARY KEY (`id`),
  ADD KEY `UserEmail` (`empid`);

--
-- Indexes for table `tblleavetype`
--
ALTER TABLE `tblleavetype`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbldepartments`
--
ALTER TABLE `tbldepartments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tblemployees`
--
ALTER TABLE `tblemployees`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `tblleaves`
--
ALTER TABLE `tblleaves`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `tblleavetype`
--
ALTER TABLE `tblleavetype`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

DELIMITER $$
--
-- Events
--
CREATE DEFINER=```root```@```localhost``` EVENT `HalfDay` ON SCHEDULE EVERY 1 DAY STARTS '2022-01-20 13:06:50' ON COMPLETION NOT PRESERVE ENABLE DO call half()$$

CREATE DEFINER=```root```@```localhost``` EVENT `ShortLeave` ON SCHEDULE EVERY 1 DAY STARTS '2022-01-20 11:07:59' ON COMPLETION NOT PRESERVE ENABLE DO call Short()$$

CREATE DEFINER=```root```@```localhost``` EVENT `DeleteShort` ON SCHEDULE EVERY 1 MONTH STARTS '2022-01-01 11:08:49' ON COMPLETION NOT PRESERVE ENABLE DO call DelShort()$$

CREATE DEFINER=```root```@```localhost``` EVENT `AddShort` ON SCHEDULE EVERY 1 MONTH STARTS '2022-01-01 11:10:07' ON COMPLETION NOT PRESERVE ENABLE DO call ShortLeave()$$

CREATE DEFINER=`root`@`localhost` EVENT `diff` ON SCHEDULE EVERY 1 SECOND STARTS '2022-01-01 10:33:20' ON COMPLETION NOT PRESERVE ENABLE DO call dif()$$

DELIMITER ;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
