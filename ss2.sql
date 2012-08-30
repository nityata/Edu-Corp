-- phpMyAdmin SQL Dump
-- version 3.3.9
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Aug 29, 2012 at 03:37 PM
-- Server version: 5.1.36
-- PHP Version: 5.2.9-2

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `ss2`
--

-- --------------------------------------------------------

--
-- Table structure for table `ads`
--

CREATE TABLE IF NOT EXISTS `ads` (
  `adid` int(11) NOT NULL AUTO_INCREMENT,
  `cid` int(11) NOT NULL,
  `content` varchar(1000) NOT NULL,
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `prid` int(11) NOT NULL,
  PRIMARY KEY (`adid`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `ads`
--

INSERT INTO `ads` (`adid`, `cid`, `content`, `created_on`, `prid`) VALUES
(1, 5, 'Launching new Adobe Flex 4.5', '2012-05-01 14:41:20', 1),
(2, 5, 'Introducing Adobe Air', '2012-05-01 14:41:34', 2);

-- --------------------------------------------------------

--
-- Table structure for table `appcomments`
--

CREATE TABLE IF NOT EXISTS `appcomments` (
  `apcid` int(11) NOT NULL AUTO_INCREMENT,
  `aaid` int(11) NOT NULL,
  `content` varchar(1000) NOT NULL,
  `submitterID` int(11) NOT NULL,
  `submitterType` varchar(50) NOT NULL,
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`apcid`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=16 ;

--
-- Dumping data for table `appcomments`
--

INSERT INTO `appcomments` (`apcid`, `aaid`, `content`, `submitterID`, `submitterType`, `created_on`) VALUES
(3, 7, 'lol arnd', 1, 'corp', '2012-04-27 21:05:01'),
(2, 1, 'hi', 1, 'corp', '2012-04-27 21:02:40'),
(4, 1, 'hello sir', 3, 'student', '2012-04-27 22:01:30'),
(5, 1, 'testing dynamically', 3, 'student', '2012-04-27 22:57:42'),
(6, 7, 'testing dynamically', 1, 'student', '2012-04-27 22:58:19'),
(7, 7, 'testing again', 1, 'student', '2012-04-29 08:52:20'),
(8, 2, 'test', 2, 'corp', '2012-04-30 20:14:44'),
(9, 11, 'test', 2, 'corp', '2012-04-30 20:19:19'),
(10, 4, 'test', 2, 'corp', '2012-04-30 20:46:02'),
(11, 11, 'tell me more', 6, 'corp', '2012-05-01 14:30:04'),
(12, 2, 'see', 3, 'student', '2012-05-01 17:10:38'),
(13, 14, 'can u be a little more specific', 5, 'corp', '2012-05-03 15:01:58'),
(14, 14, 'sure sir .', 7, 'student', '2012-05-03 15:02:30'),
(15, 16, 'cn', 5, 'corp', '2012-05-03 17:38:52');

-- --------------------------------------------------------

--
-- Table structure for table `applicant`
--

CREATE TABLE IF NOT EXISTS `applicant` (
  `aid` int(11) NOT NULL AUTO_INCREMENT,
  `sid` int(11) NOT NULL,
  PRIMARY KEY (`aid`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `applicant`
--

INSERT INTO `applicant` (`aid`, `sid`) VALUES
(2, 3),
(1, 1),
(3, 2),
(4, 7),
(5, 8);

-- --------------------------------------------------------

--
-- Table structure for table `application`
--

CREATE TABLE IF NOT EXISTS `application` (
  `aaid` int(11) NOT NULL AUTO_INCREMENT,
  `aid` int(11) NOT NULL,
  `jid` int(11) NOT NULL,
  `abstract` varchar(500) NOT NULL,
  `docs` varchar(500) NOT NULL,
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`aaid`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=17 ;

--
-- Dumping data for table `application`
--

INSERT INTO `application` (`aaid`, `aid`, `jid`, `abstract`, `docs`, `created_on`) VALUES
(1, 2, 1, 'Encog project porting to android. Use of neural networks for handwriting recognition', '', '2012-04-29 21:41:53'),
(4, 3, 2, 'Implement iText for text to pdf conversion and pdf box for pdf to text conversions', '', '0000-00-00 00:00:00'),
(2, 2, 2, 'Use socket programming to send messages to server. Text compression', '', '2012-04-29 21:42:00'),
(5, 1, 2, 'Use pdfbox and iText', '', '0000-00-00 00:00:00'),
(7, 1, 1, 'test -6', '', '2012-04-10 21:44:00'),
(13, 3, 1, 'testing ramya', '', '2012-04-24 20:23:42'),
(11, 1, 26, 'apllying thru corp', '', '2012-04-10 23:25:58'),
(14, 4, 1, 'Cell Writer porting to android', '', '2012-05-03 15:01:01'),
(15, 1, 29, 'IDT portal', '', '2012-05-03 15:18:13'),
(16, 5, 30, 'test so n so', '', '2012-05-03 17:36:44');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE IF NOT EXISTS `comments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cid` int(11) NOT NULL,
  `comment` text NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `comment_on` varchar(20) NOT NULL,
  `name` varchar(50) NOT NULL,
  `submitterID` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `cid` (`cid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=55 ;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `cid`, `comment`, `date`, `comment_on`, `name`, `submitterID`) VALUES
(13, 1, 'test 5 test 5 test 5 test 5 test 5 test 5 test 5 test 5 test 5 test 5 test 5 test 10 test 10 test 10 test 10 test 10 test 10 test 10 test 10 test 10 test 10 test 10 test 10 test 10 test 10 test 10 test 10 test 10 test 10 test 10 test 10 test 10 test 10 test 10 test 10 test 10 test 10 test 10 test 10 test 10 test 10 test 10 test 10 test 10 test 10 test 10 test 10 test 10 test 10 test 10 test 10 test 10 test 10 test 10 test 10 test 10 test 10 test 10 test 10 test 10 test 10 test 10 test 10 test 10 test 10 test 10 test 10 test 10 test 10 test 10 test 10 test 10 test 10 test 10 test 10', '2012-04-17 17:07:39', 'project', 'Nityata', 1),
(25, 1, 'test 10		', '2012-04-17 17:07:45', 'project', 'Nityata', 1),
(26, 1, 'test 12', '2012-04-17 17:07:50', 'project', 'Nityata', 1),
(27, 19, 'test -1', '2012-04-17 17:07:55', 'project', 'Nityata', 1),
(28, 19, 'test -2', '2012-04-17 17:08:00', 'project', 'Nityata', 1),
(29, 19, 'test -3', '2012-04-17 17:08:07', 'project', 'Nityata', 1),
(30, 20, 'test -1 with sid and csid', '2012-04-17 17:08:14', 'project', 'Nityata', 1),
(31, 1, 'test with sid and csid', '2012-04-17 17:08:19', 'project', 'Ramya', 2),
(32, 1, 'new test specific project', '2012-04-17 17:08:26', 'project', 'Nityata', 1),
(33, 20, 'lets test again', '2012-04-17 19:13:06', 'project', 'Ramya', 2),
(34, 1, 'i am commenting again - testing external comments', '2012-04-17 19:14:56', 'project', 'Nityata', 1),
(35, 20, 'again testing !!', '2012-04-18 21:29:08', 'project', 'Nityata', 1),
(36, 1, 'ramya testing ...', '2012-04-18 21:30:45', 'project', 'Ramya', 2),
(37, 20, 'hi im aashray', '2012-04-18 21:33:40', 'project', 'Aashray', 3),
(38, 21, 'nityata commenting', '2012-04-18 21:35:14', 'project', 'Nityata', 1),
(39, 21, 'ram', '2012-04-18 21:43:26', 'project', 'Ramya', 2),
(40, 20, 'nityata commenting from wall updates', '2012-04-18 23:39:45', 'project', 'Nityata', 1),
(41, 20, 'checking 123', '2012-04-18 23:41:23', 'project', 'Nityata', 1),
(42, 21, 'sup aashray ! nice work', '2012-04-18 23:42:17', 'project', 'Nityata', 1),
(43, 20, 'nit->aash->rum comment', '2012-04-18 23:44:47', 'project', 'Nityata', 1),
(44, 21, 'nit->rum->test4', '2012-04-18 23:56:19', 'project', 'Nityata', 1),
(45, 1, 'nit commenting on my own project', '2012-04-29 13:35:56', 'project', 'Nityata', 1),
(46, 21, 'nit commenting', '2012-04-29 14:11:10', 'project', 'Nityata', 1),
(47, 19, 'test -4', '2012-04-29 22:10:58', 'project', 'Nityata', 1),
(48, 21, 'mike testing', '2012-04-29 22:19:21', 'project', 'Nityata', 1),
(49, 21, 'sup :)', '2012-04-30 11:15:05', 'project', 'Nityata', 1),
(50, 1, 'rum posting ...', '2012-05-01 16:47:39', 'project', 'Ramya', 2),
(51, 21, 'bla', '2012-05-01 17:04:22', 'project', 'Nityata', 1),
(52, 21, 'suo', '2012-05-01 17:56:18', 'project', 'Nityata', 1),
(53, 22, 'awesome!', '2012-05-01 21:21:07', 'project', 'Ramya', 2),
(54, 20, 'hi', '2012-05-24 12:25:12', 'project', 'Nityata', 1);

-- --------------------------------------------------------

--
-- Table structure for table `corp`
--

CREATE TABLE IF NOT EXISTS `corp` (
  `cid` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) NOT NULL,
  `address` varchar(200) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `tags` varchar(500) NOT NULL,
  PRIMARY KEY (`cid`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `corp`
--

INSERT INTO `corp` (`cid`, `name`, `address`, `email`, `phone`, `tags`) VALUES
(5, 'Adobe, India', 'J. P Nagar, Bangalore', 'contact@adobe.com', '+91-123456', 'Android;compiler;software'),
(6, 'Adobe, Research', 'J P Nagar ', 'contact@adobelabs.com', '+91-80-6758403', 'Android;iPhone;Blackberry;Web');

-- --------------------------------------------------------

--
-- Table structure for table `intern`
--

CREATE TABLE IF NOT EXISTS `intern` (
  `iid` int(11) NOT NULL AUTO_INCREMENT,
  `jid` int(11) NOT NULL,
  `aid` int(11) NOT NULL,
  PRIMARY KEY (`iid`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `intern`
--

INSERT INTO `intern` (`iid`, `jid`, `aid`) VALUES
(2, 2, 3),
(3, 2, 2),
(4, 1, 1),
(6, 1, 2),
(7, 1, 4),
(8, 29, 1),
(9, 30, 5),
(10, 30, 5);

-- --------------------------------------------------------

--
-- Table structure for table `job`
--

CREATE TABLE IF NOT EXISTS `job` (
  `jid` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(100) NOT NULL,
  `abstract` text NOT NULL,
  `deadline` datetime NOT NULL,
  `tags` varchar(200) NOT NULL,
  `prerequisite` varchar(200) NOT NULL,
  `docs` text NOT NULL,
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `cid` int(11) NOT NULL,
  PRIMARY KEY (`jid`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=31 ;

--
-- Dumping data for table `job`
--

INSERT INTO `job` (`jid`, `title`, `abstract`, `deadline`, `tags`, `prerequisite`, `docs`, `created_on`, `cid`) VALUES
(26, 'Reader for the blind', 'Built using electronic devices and .Net', '2012-09-09 12:12:12', 'Web', 'Web;.Net', '', '2012-05-01 14:22:28', 6),
(1, 'Intelligent Editor for Android', 'Android;Java;Web', '2012-04-28 11:21:25', 'Android;Java', 'Android', 'AMSE REPORT.pdf;168615-gurmeet-and-debina-in-ramayan.jpg', '2012-05-01 18:26:19', 5),
(30, 'Test', 'test', '2012-09-09 12:12:12', 'Android', 'Android', '', '2012-05-03 17:35:31', 5),
(2, 'SMS Computing', 'SMS Computing is a mechanism by which users may use services provided by the internet and world wide web without internet enabled in the device.', '2012-03-28 10:41:34', 'Java', 'Android', 'FINAL PROJECT CONTENT.pdf', '2012-05-01 14:22:45', 6),
(29, 'IDT', 'Idea Management Tool', '2012-09-09 12:12:12', 'Android;Web', 'JSP', '', '2012-05-03 15:16:27', 5);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE IF NOT EXISTS `orders` (
  `orderid` int(11) NOT NULL AUTO_INCREMENT,
  `oprid` int(11) NOT NULL,
  `osid` int(11) NOT NULL,
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`orderid`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`orderid`, `oprid`, `osid`, `created_on`) VALUES
(2, 1, 1, '2012-04-22 22:10:15'),
(3, 1, 1, '2012-04-22 22:11:37'),
(4, 2, 1, '2012-05-01 14:44:31');

-- --------------------------------------------------------

--
-- Table structure for table `prcomments`
--

CREATE TABLE IF NOT EXISTS `prcomments` (
  `prcid` int(11) NOT NULL AUTO_INCREMENT,
  `pgrid` int(11) NOT NULL,
  `submitterID` int(11) NOT NULL,
  `content` varchar(1000) NOT NULL,
  `submitterType` varchar(20) NOT NULL,
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`prcid`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `prcomments`
--

INSERT INTO `prcomments` (`prcid`, `pgrid`, `submitterID`, `content`, `submitterType`, `created_on`) VALUES
(1, 1, 1, 'hi test-1', 'student', '2012-04-24 00:10:33'),
(2, 1, 1, 'hello test-1', 'student', '2012-04-24 00:10:40'),
(3, 1, 1, 'testing dynamically', 'student', '2012-04-24 21:32:05'),
(4, 1, 1, 'testing dynamically - 2', 'student', '2012-04-24 21:46:12'),
(5, 1, 1, 'the progress is good', 'corp', '2012-04-24 23:11:20'),
(6, 1, 1, 'testing dynamically corp', 'corp', '2012-04-25 18:47:03'),
(7, 2, 3, 'lets start work now', 'corp', '2012-04-25 18:59:13'),
(8, 2, 3, 'im ready sir . I have been researching on encog project', 'student', '2012-04-25 19:07:28'),
(9, 1, 1, 'good job', 'corp', '2012-04-30 14:13:14'),
(10, 1, 1, 'what wud be my next step', 'student', '2012-04-30 14:24:04'),
(11, 1, 1, 'wat next', 'student', '2012-05-24 12:19:03');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE IF NOT EXISTS `products` (
  `prdid` int(11) NOT NULL AUTO_INCREMENT,
  `cid` int(11) NOT NULL,
  `name` varchar(1000) NOT NULL,
  `price` double NOT NULL,
  `offers` varchar(1000) NOT NULL,
  PRIMARY KEY (`prdid`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`prdid`, `cid`, `name`, `price`, `offers`) VALUES
(1, 5, 'Launching Adobe Flex 4.5', 50.05, 'Student discount: 40 %'),
(2, 5, 'Introducing Adobe Air', 80.95, 'Student discount: 30 %');

-- --------------------------------------------------------

--
-- Table structure for table `progress`
--

CREATE TABLE IF NOT EXISTS `progress` (
  `pgrid` int(11) NOT NULL AUTO_INCREMENT,
  `iid` int(11) NOT NULL,
  `cid` int(11) NOT NULL,
  `work` varchar(2000) NOT NULL,
  `todo` varchar(2000) NOT NULL,
  `percentage` double NOT NULL,
  PRIMARY KEY (`pgrid`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `progress`
--

INSERT INTO `progress` (`pgrid`, `iid`, `cid`, `work`, `todo`, `percentage`) VALUES
(1, 4, 5, 'Ported encog project to android and UI', 'File Management', 50),
(2, 6, 5, '<p>PROGRESS</p><p>lets c</p>', '<p>TO-DO</p><p>make </p>', 0),
(3, 7, 5, '', '', 0),
(4, 8, 5, '', '', 0),
(5, 9, 5, '', '', 0),
(6, 10, 5, '', '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `project`
--

CREATE TABLE IF NOT EXISTS `project` (
  `pid` int(11) NOT NULL AUTO_INCREMENT,
  `submitter` int(11) NOT NULL,
  `title` varchar(50) NOT NULL,
  `abstract` text NOT NULL,
  `author` varchar(150) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `guide` varchar(50) NOT NULL,
  `duration` int(11) DEFAULT NULL,
  PRIMARY KEY (`pid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `project`
--

INSERT INTO `project` (`pid`, `submitter`, `title`, `abstract`, `author`, `date`, `guide`, `duration`) VALUES
(1, 1, 'SMS Computing', 'SMS Computing that brings to a certain amount the power of internet on the phones of people who cannot                                                               afford Internet on it (80% of Indian users). What I call SMS computing brings forward a plethora of internet based services like Google Maps, Emailing, etc. onto a device that is either very basic and hence not capable of such applications or the user does not have internet activated on the device.\r\n-	SMS is virtually free (or very cheap) in India. The device sends and receives text-messages to and from the server to do the required computation and output results.\r\n-           Users can send text messages like "Who is bill gates?" or "Where is Disney Land?" the server would receive the message, use internet and compute results at a fast speed and send the answer to the user in the form of a text message. We have used Natural Language Processing to achieve this.\r\n\r\n', 'Aashray,Nityata', '2012-02-14 09:12:15', 'Srikanth H R', 5),
(2, 1, 'Intelligent Editor for Android', 'Research project headed by Mr.P.N Anatharaman, Director of Engineering, Adobe. The final research which is to build an intelligent editor of tablet devices utilizes intelligent handwriting recognition for writing code, which we have implemented on the Android systems using Neural Network Learning Algorithm with approximately 85% accuracy, an Auto-complete feature exists where the words are automatically completed by understanding the context of the user and the syntax and semantics of the language the user is writing code in. We have decided to make this open source and would be up soon as it is currently under final review. The editor my team and I have made is like a light weight version of the one found in the Eclipse IDE. This kind of editor has been missing in Tablet devices. We are currently working on compiling and running the programs on a cloud machine and sending results back to the tablet device.', 'Aashray,Nityata', '2012-02-14 09:09:57', 'Anantharaman P N', 5),
(3, 1, 'Video conferencing and power management', 'Peer to peer video conferencing, Socket programming', 'Aashray', '2012-02-14 20:02:33', 'Anantharaman P N', 5),
(4, 1, 'test 5', 'test 5', 'test 5', '2012-03-22 20:59:24', 'test 5', 7),
(5, 1, 'test 2', 'test 2', 'test 2 ', '2012-03-23 12:06:42', 'test 2', 3);

-- --------------------------------------------------------

--
-- Table structure for table `project2`
--

CREATE TABLE IF NOT EXISTS `project2` (
  `pid` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(100) NOT NULL,
  `abstract` varchar(100) NOT NULL,
  `author` varchar(40) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `guide` varchar(50) NOT NULL,
  `files` varchar(200) NOT NULL,
  `submitter` int(11) NOT NULL,
  `duration` int(11) NOT NULL,
  PRIMARY KEY (`pid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=25 ;

--
-- Dumping data for table `project2`
--

INSERT INTO `project2` (`pid`, `title`, `abstract`, `author`, `date`, `guide`, `files`, `submitter`, `duration`) VALUES
(1, 'test 1', 'Social Computing;sth else', '3', '2012-04-18 23:55:12', 'test 1', ';me.jpg;corp.jpg', 1, 5),
(19, 'test 2', 'Android;something else', '2', '2012-04-18 23:54:52', 'test 2', ';itext.gif', 1, 2),
(20, 'test 3', 'Android;something else', '1;3', '2012-04-22 12:42:37', 'test 3', ';class.png', 2, 3),
(21, 'test 4', 'Web;something else', '2', '2012-04-18 23:02:18', 'test 4', ';bus-routes.png', 3, 4),
(22, 'test - 5', 'test - 5', '2', '2012-05-01 21:19:33', '5', '', 1, 4),
(23, 'test 6', 'test 6', '3', '2012-05-01 21:44:29', '6', ';DDD5162807~The-OC-Posters.jpg', 1, 5),
(24, 'test 7', 'test 7', '1', '2012-05-01 22:00:57', '5', ';169615-sita-pati-shri-ram.jpg', 2, 6);

-- --------------------------------------------------------

--
-- Table structure for table `recommendations`
--

CREATE TABLE IF NOT EXISTS `recommendations` (
  `rid` int(11) NOT NULL AUTO_INCREMENT,
  `rname` varchar(100) NOT NULL,
  `pid` int(11) NOT NULL,
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `reco_on` varchar(50) NOT NULL,
  `recommendation` varchar(1000) NOT NULL,
  PRIMARY KEY (`rid`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `recommendations`
--

INSERT INTO `recommendations` (`rid`, `rname`, `pid`, `created_on`, `reco_on`, `recommendation`) VALUES
(3, 'Nityata', 20, '2012-04-17 11:27:18', 'project', 'test with style sid and csid'),
(2, 'Nityata', 1, '2012-04-17 10:43:20', 'project', 'test -2'),
(4, 'Nityata', 20, '2012-04-17 11:29:37', 'project', 'yet another test'),
(5, 'Nityata', 20, '2012-04-17 11:30:11', 'project', 'test - 3'),
(6, 'Nityata', 21, '2012-04-17 11:30:33', 'project', 'test -1'),
(7, 'Ramya', 1, '2012-04-17 11:31:02', 'project', 'test - 3'),
(8, 'Nityata', 1, '2012-04-30 14:14:03', 'project', 'test-4');

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE IF NOT EXISTS `student` (
  `sid` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(30) NOT NULL,
  `dob` date NOT NULL,
  `profile` varchar(300) NOT NULL,
  `resume` varchar(100) NOT NULL,
  `usn` varchar(10) NOT NULL,
  `interests` varchar(300) NOT NULL,
  PRIMARY KEY (`sid`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`sid`, `name`, `dob`, `profile`, `resume`, `usn`, `interests`) VALUES
(1, 'Nityata', '1990-09-06', 'CGPA: 7.96', '', '1PI08CS069', 'Android;Web'),
(2, 'Ramya', '2011-10-12', 'CGPA: 7.09', '', '1PI08CS060', 'Social Computing;Web;Android'),
(3, 'Aashray', '1990-08-27', 'CGPA: 7.5', '', '1PI08CS001', 'Mobile Computing;Web Technologies;Android'),
(7, 'Preethi', '1990-08-27', 'CGPA: 8.90', '', '1PI08CS080', 'NLP;Android'),
(8, 'sandy', '1990-08-27', 'CGPA: 9.3', '', '1PI08CS081', 'Android;NLP');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `uid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `email` varchar(500) NOT NULL,
  `uname` varchar(100) NOT NULL,
  `fname` varchar(500) NOT NULL,
  `password` varchar(1000) NOT NULL,
  `utype` varchar(1) NOT NULL,
  `dob` date NOT NULL,
  `status` varchar(1) NOT NULL DEFAULT 'w',
  `photo` varchar(100) NOT NULL DEFAULT 'default.gif',
  `about` varchar(40000) NOT NULL DEFAULT 'Please write a brief about yourself here ',
  `institution` varchar(300) NOT NULL DEFAULT 'Unknown Institution',
  PRIMARY KEY (`uid`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`uid`, `email`, `uname`, `fname`, `password`, `utype`, `dob`, `status`, `photo`, `about`, `institution`) VALUES
(1, 'nityatakumar1990@gmail.com', 'nityata', 'Nityata N Kumar', 'nityata', 's', '1990-09-06', 'c', '1.jpg', 'Android;Web', 'PES Institute of Technology'),
(5, 'ananth@adobe.com', 'ananth', 'P.N Anantharaman', 'ananth', 'c', '1965-02-06', 'a', '2.jpg', 'Welcome to the Advanced Technology Labs, Adobe''s research and advanced development organization!   Over 25 years ago, Adobe’s founders and world-class researchers, Charles Geschke and John Warnock, founded the Advanced Technology Labs (ATL).  In doing so, they recognized the importance of supporting a dedicated group of researchers that could work on technologies that go beyond the current needs of the product teams.  Our researchers look years into the future, giving them the opportunity to explore innovations well in advance of clearly identified customer needs.     In ATL, we create innovative technologies relevant to our software products for consumers, creative professionals, developers, and enterprises. While that mission sounds simple enough, it takes a special mix of passionate employees, committed leadership and trust in the creative process to make it all happen. We begin by bringing together the smartest, most driven people we can find, and we allow them the freedom to nurture their intellectual curiosity, while providing them with the necessary resources, support and freedom to shape their ideas into tangible results.', 'Adobe'),
(3, 'aashrayarora@gmail.com', 'aashray', 'Aashray Arora', 'aashray', 's', '1990-08-27', 'a', '3.jpg', 'I ma Aashray Arora.', 'PES Institute of Technology'),
(4, 'roopat@pes.edu', 'roopa', 'Roopa', 'roopa', 't', '1980-02-05', 'a', '4.jpg', 'Please write a brief about yourself here.', 'PES Institute of Technology'),
(2, 'ramya@gmail.com', 'ramya', 'ramya', 'ramya', 's', '1990-01-02', 'w', '3.jpg', 'Please write a brief about yourself here ', 'PESIT'),
(6, 'ramesh@adobe.com', 'ramesh', 'Ramesh', 'ramesh', 'c', '1987-05-11', 'w', '2.jpg', 'Please write a brief about yourself here ', 'Unknown Institution'),
(7, 'preethi@gmail.com', 'preethi', 'Preethi', 'preethi', 's', '1990-08-27', 'w', '1.jpg', 'Please write a brief about yourself here ', 'PESIT'),
(8, 'sandy@gmail.com', 'sandy', 'sandy', 'sandy', 's', '1990-08-27', 'w', '2.jpg', 'Please write a brief about yourself here ', 'PESIT');

-- --------------------------------------------------------

--
-- Table structure for table `wall`
--

CREATE TABLE IF NOT EXISTS `wall` (
  `wid` int(11) NOT NULL AUTO_INCREMENT,
  `content` text NOT NULL,
  `link` text NOT NULL,
  `aid` int(11) NOT NULL,
  `jid` int(11) NOT NULL,
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_on` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`wid`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=37 ;

--
-- Dumping data for table `wall`
--

INSERT INTO `wall` (`wid`, `content`, `link`, `aid`, `jid`, `created_on`, `updated_on`) VALUES
(18, 'Rejected', '', 1, 2, '2012-04-09 10:55:00', '0000-00-00 00:00:00'),
(30, 'called for interview on 2012-09-09 12:12:12at bangalore', '', 1, 1, '2012-04-11 14:55:53', '0000-00-00 00:00:00'),
(8, 'Accepted', '', 2, 1, '2012-03-28 00:21:58', '0000-00-00 00:00:00'),
(23, 'Rejected', '', 1, 26, '2012-04-11 13:48:54', '0000-00-00 00:00:00'),
(32, 'Accepted', '', 2, 1, '2012-04-25 18:58:08', '0000-00-00 00:00:00'),
(31, 'Accepted', '', 3, 1, '2012-04-24 21:00:53', '0000-00-00 00:00:00'),
(15, 'Accepted', '', 3, 2, '2012-03-28 11:14:55', '0000-00-00 00:00:00'),
(16, 'Accepted', '', 2, 2, '2012-03-28 16:22:47', '0000-00-00 00:00:00'),
(19, 'Accepted', '', 1, 1, '2012-04-09 20:43:40', '0000-00-00 00:00:00'),
(33, 'Accepted', '', 4, 1, '2012-05-03 15:03:34', '0000-00-00 00:00:00'),
(34, 'Accepted', '', 1, 29, '2012-05-03 15:18:52', '0000-00-00 00:00:00'),
(35, 'Accepted', '', 5, 30, '2012-05-03 17:38:56', '0000-00-00 00:00:00'),
(36, 'Accepted', '', 5, 30, '2012-05-24 12:20:01', '0000-00-00 00:00:00');
