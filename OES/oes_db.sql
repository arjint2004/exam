-- phpMyAdmin SQL Dump
-- version 3.4.11.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Oct 08, 2013 at 01:42 AM
-- Server version: 5.5.23
-- PHP Version: 5.3.17

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `developm_oes`
--

-- --------------------------------------------------------

--
-- Table structure for table `administrators`
--

CREATE TABLE IF NOT EXISTS `administrators` (
  `adminid` int(11) NOT NULL AUTO_INCREMENT,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `username` varchar(20) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `password` varchar(40) DEFAULT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`adminid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `administrators`
--

INSERT INTO `administrators` (`adminid`, `firstname`, `lastname`, `username`, `email`, `password`, `created`) VALUES
(4, 'Demo', 'Demo', 'admindemo', 'demo@domain.com', 'cbdbe4936ce8be63184d9f2e13fc249234371b9a', '2013-05-03 06:17:42');

-- --------------------------------------------------------

--
-- Table structure for table `exams`
--

CREATE TABLE IF NOT EXISTS `exams` (
  `examid` int(11) NOT NULL AUTO_INCREMENT,
  `examname` varchar(300) NOT NULL,
  `description` text NOT NULL,
  `catid` int(11) NOT NULL,
  `availablefrom` date NOT NULL,
  `availableto` date NOT NULL,
  `duration` bigint(20) NOT NULL,
  `questions` int(11) NOT NULL,
  `accesscode` varchar(20) NOT NULL,
  `passmark` int(11) NOT NULL,
  PRIMARY KEY (`examid`),
  KEY `catid` (`catid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `exams`
--

INSERT INTO `exams` (`examid`, `examname`, `description`, `catid`, `availablefrom`, `availableto`, `duration`, `questions`, `accesscode`, `passmark`) VALUES
(2, 'PHP - Level 1', 'php test exam', 1, '2013-05-02', '2013-05-10', 60, 10, '', 70),
(5, 'PHP - Level 2', 'PHP level 2 exam', 1, '2013-05-01', '2013-05-23', 10, 20, '12345', 75),
(6, 'IT', 'info tech', 3, '2013-07-27', '2013-07-31', 60, 5, '', 90),
(7, 'exam ko', 'hehehehe', 5, '2013-07-20', '2013-07-25', 30, 10, '', 50),
(8, 'sdf', 'asdffsf', 6, '2013-07-27', '2013-07-31', 4, 2, '', 60);

-- --------------------------------------------------------

--
-- Table structure for table `exam_category`
--

CREATE TABLE IF NOT EXISTS `exam_category` (
  `catid` int(11) NOT NULL AUTO_INCREMENT,
  `catname` varchar(300) NOT NULL,
  `catdesc` text NOT NULL,
  PRIMARY KEY (`catid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `exam_category`
--

INSERT INTO `exam_category` (`catid`, `catname`, `catdesc`) VALUES
(1, 'Websites IT & Software', 'test description test'),
(3, 'another test', 'another test'),
(4, 'HTML & website', 'A category concerning websites and stuff'),
(5, 'my cat', 'all'),
(6, 'exam me', 'exam me');

-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

CREATE TABLE IF NOT EXISTS `questions` (
  `questionid` int(20) NOT NULL AUTO_INCREMENT,
  `examid` int(20) NOT NULL,
  `question` varchar(500) NOT NULL,
  `optiona` varchar(100) NOT NULL,
  `optionb` varchar(100) NOT NULL,
  `optionc` varchar(100) NOT NULL,
  `optiond` varchar(100) NOT NULL,
  `correctanswer` enum('A','B','C','D') NOT NULL,
  `marks` int(20) NOT NULL,
  PRIMARY KEY (`questionid`,`examid`),
  KEY `examid` (`examid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `questions`
--

INSERT INTO `questions` (`questionid`, `examid`, `question`, `optiona`, `optionb`, `optionc`, `optiond`, `correctanswer`, `marks`) VALUES
(1, 2, 'What is php?', 'server-side programing language', 'Client-side programming language', 'Hypertext markup language', 'All of the above', 'B', 5),
(3, 2, 'Test question', 'testa', 'testb', 'testc', 'testd', 'C', 5),
(4, 2, 'Test question', 'testa', 'testb', 'testc', 'testd', 'C', 5),
(5, 5, 'test query', 'answer 1', 'answer 2', 'answer 3', 'answer 4', 'A', 1),
(6, 5, 'test query', 'answer 1', 'answer 2', 'answer 3', 'answer 4', 'A', 1),
(7, 5, 'test query', 'answer 1', 'answer 2', 'answer 3', 'answer 4', 'A', 1);

-- --------------------------------------------------------

--
-- Table structure for table `userexam`
--

CREATE TABLE IF NOT EXISTS `userexam` (
  `userid` int(20) NOT NULL,
  `examid` int(20) NOT NULL,
  `starttime` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `endtime` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `correctlyanswered` int(11) NOT NULL DEFAULT '0',
  `status` enum('completed','inprogress') NOT NULL DEFAULT 'inprogress',
  PRIMARY KEY (`userid`,`examid`),
  KEY `examid` (`examid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `userexam`
--

INSERT INTO `userexam` (`userid`, `examid`, `starttime`, `endtime`, `correctlyanswered`, `status`) VALUES
(4, 2, '2013-10-07 08:11:04', '2013-10-07 08:11:59', 0, 'completed'),
(4, 5, '2013-10-07 13:41:47', '0000-00-00 00:00:00', 0, 'inprogress'),
(4, 6, '2013-09-30 06:30:41', '0000-00-00 00:00:00', 0, 'inprogress'),
(4, 7, '2013-09-08 03:43:01', '0000-00-00 00:00:00', 0, 'inprogress'),
(4, 8, '2013-09-30 17:55:04', '0000-00-00 00:00:00', 0, 'inprogress'),
(5, 2, '2013-05-08 07:59:06', '0000-00-00 00:00:00', 0, 'inprogress'),
(6, 2, '2013-05-18 04:16:14', '2013-05-18 04:16:57', 0, 'completed'),
(7, 2, '2013-05-23 11:55:34', '0000-00-00 00:00:00', 0, 'inprogress'),
(7, 5, '2013-05-23 12:15:34', '0000-00-00 00:00:00', 0, 'inprogress'),
(8, 2, '2013-06-27 20:44:24', '2013-06-27 20:44:32', 0, 'completed'),
(10, 2, '2013-07-12 14:33:22', '2013-07-12 14:33:42', 0, 'completed'),
(11, 2, '2013-07-23 07:59:53', '2013-07-23 08:00:13', 0, 'completed'),
(11, 5, '2013-07-23 08:00:51', '2013-07-23 08:01:04', 0, 'completed'),
(11, 6, '2013-07-23 08:00:30', '0000-00-00 00:00:00', 0, 'inprogress'),
(12, 6, '2013-08-13 22:45:24', '0000-00-00 00:00:00', 0, 'inprogress'),
(13, 5, '2013-08-21 11:50:40', '0000-00-00 00:00:00', 0, 'inprogress'),
(14, 2, '2013-09-01 06:21:08', '2013-09-01 06:21:38', 0, 'completed'),
(16, 2, '2013-09-19 11:19:44', '0000-00-00 00:00:00', 0, 'inprogress'),
(16, 6, '2013-09-19 10:40:14', '0000-00-00 00:00:00', 0, 'inprogress'),
(17, 2, '2013-10-04 08:47:39', '2013-10-04 08:47:47', 0, 'completed');

-- --------------------------------------------------------

--
-- Table structure for table `userquestions`
--

CREATE TABLE IF NOT EXISTS `userquestions` (
  `userid` int(20) NOT NULL,
  `examid` int(20) NOT NULL,
  `questionid` int(20) NOT NULL,
  `answered` enum('answered','unanswered','review') NOT NULL,
  `useranswer` enum('A','B','C','D') NOT NULL,
  KEY `userid` (`userid`,`examid`,`questionid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `userquestions`
--

INSERT INTO `userquestions` (`userid`, `examid`, `questionid`, `answered`, `useranswer`) VALUES
(4, 2, 1, 'answered', 'A'),
(4, 2, 4, 'answered', 'D'),
(4, 2, 3, 'answered', 'C'),
(4, 5, 5, 'answered', 'C'),
(4, 5, 6, 'answered', 'D'),
(4, 5, 7, 'answered', 'C'),
(5, 2, 4, 'answered', 'B'),
(6, 2, 1, 'answered', 'B'),
(6, 2, 3, 'answered', 'C'),
(6, 2, 4, 'answered', 'C'),
(10, 2, 1, 'answered', 'A'),
(10, 2, 3, 'answered', 'C'),
(10, 2, 4, 'answered', 'D'),
(11, 2, 1, 'answered', 'A'),
(11, 2, 3, 'answered', 'A'),
(11, 2, 4, 'answered', 'B'),
(11, 5, 5, 'answered', 'A'),
(13, 5, 5, 'answered', 'C'),
(13, 5, 6, 'answered', 'B'),
(13, 5, 7, 'answered', 'D'),
(16, 2, 1, 'answered', 'C'),
(16, 2, 3, 'answered', 'A'),
(16, 2, 4, 'answered', 'B'),
(17, 2, 1, 'answered', 'B'),
(17, 2, 3, 'answered', 'C'),
(17, 2, 4, 'answered', 'A');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `username` varchar(55) NOT NULL,
  `password` varchar(255) NOT NULL,
  `status` enum('0','1') NOT NULL DEFAULT '1',
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=18 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `firstname`, `lastname`, `email`, `username`, `password`, `status`) VALUES
(4, 'Developer', 'Demo', 'test@gmail.com', 'demo', '89e495e7941cf9e40e6980d14a16bf023ccd4c91', '1'),
(5, 'vishnu', 'singh', 'vishnusikarwar91@yahoo.com', 'vishnu91', '7c4a8d09ca3762af61e59520943dc26494f8941b', '1'),
(6, 'ram', 'bhatt', 'oceansoft@gmail.com', 'rgb1234', '8b1379fddedefbd00df868898ec13cdae0801eb8', '1'),
(7, 'bps', 'b', 'bps@gmail.com', 'bpsbps', '3912ee8d60dd6b595e141f8f3566656aa190b09e', '1'),
(8, 'John', 'Doe', 'jdoe@com.com', 'deodeo', '925756ed300fc928f63de9316f8e3ccafd490fff', '1'),
(9, 'Simon', 'Parterson', 'fabade2013@gmail.com', 'fabade2013', '0a565eb84985b6b97a4c7ac3ac438081b3cb1530', '1'),
(10, 'Kimberly Ann', 'Billones', 'kiann.bi24@gmail.com', 'eyakim', '653d1c945c3ce20a6298c6af43dc1be906609af6', '1'),
(11, 'rajaram', 'mohan', 'rajaram.tavalam@gmail.com', 'rajaram', 'e5f8697b25d9a614267072be6b6f36a11fb6b62d', '1'),
(12, 'bijendra', 'dhakar', 'dhakarvijendra1@gmail.com', 'bijendra', '7c4a8d09ca3762af61e59520943dc26494f8941b', '1'),
(13, 'TEst', 'test', 'test@test.com', 'test123', '7288edd0fc3ffcbe93a0cf06e3568e28521687bc', '1'),
(14, 'rere', 'rere', 'rere@re.er', 'rererere', '3e3abe024582c3535be3b9defccaf9273d053056', '1'),
(15, 'David', 'MADDHESHIA', 'abc@g.com', 'demo1234', '6ea7ccdcf642953a24672d10b0d32cef576e0329', '1'),
(16, 'HEMA', 'RAM', 'rhema.btech@gmail.com', 'HEMA RAM', 'a93fd1a91f90436247298ff2e30c0778da6b53a9', '1'),
(17, 'Jatin', 'Kothari', 'jaykayenter@gmail.com', 'jatin.kothari', 'fb63e04e628e9ba1a71eb5586c2af04ad8e017e8', '1');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `exams`
--
ALTER TABLE `exams`
  ADD CONSTRAINT `exams_ibfk_1` FOREIGN KEY (`catid`) REFERENCES `exam_category` (`catid`);

--
-- Constraints for table `questions`
--
ALTER TABLE `questions`
  ADD CONSTRAINT `questions_ibfk_1` FOREIGN KEY (`examid`) REFERENCES `exams` (`examid`);

--
-- Constraints for table `userexam`
--
ALTER TABLE `userexam`
  ADD CONSTRAINT `userexam_ibfk_1` FOREIGN KEY (`userid`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `userexam_ibfk_2` FOREIGN KEY (`examid`) REFERENCES `exams` (`examid`);

--
-- Constraints for table `userquestions`
--
ALTER TABLE `userquestions`
  ADD CONSTRAINT `userquestions_ibfk_1` FOREIGN KEY (`userid`) REFERENCES `users` (`user_id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
