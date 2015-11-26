-- phpMyAdmin SQL Dump
-- version 4.4.9
-- http://www.phpmyadmin.net
--
-- Host: localhost:8889
-- Generation Time: Aug 12, 2015 at 08:38 AM
-- Server version: 5.5.42
-- PHP Version: 5.6.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `auth`
--

-- --------------------------------------------------------

--
-- Table structure for table `think_auth_group`
--think_auth_group 用户组表， 
--id：主键， title:用户组中文名称， rules：用户组拥有的规则id， 多个规则","隔开，status 状态：为1正常，为0禁用

CREATE TABLE `think_auth_group` (
  `id` mediumint(8) unsigned NOT NULL,
  `title` char(100) NOT NULL DEFAULT '',
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `rules` char(80) NOT NULL DEFAULT ''
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `think_auth_group`
--

INSERT INTO `think_auth_group` (`id`, `title`, `status`, `rules`) VALUES
(1, '管理员', 1, '1'),
(2, '普通人', 1, '2');

-- --------------------------------------------------------

--
-- Table structure for table `think_auth_group_access`
--

CREATE TABLE `think_auth_group_access` (
  `uid` mediumint(8) unsigned NOT NULL,
  `group_id` mediumint(8) unsigned NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `think_auth_group_access`
--

INSERT INTO `think_auth_group_access` (`uid`, `group_id`) VALUES
(1, 1),
(2, 2),
(3, 2);

-- --------------------------------------------------------

--
-- Table structure for table `think_auth_rule`
--think_auth_rule，规则表，
--id:主键，name：规则唯一路径, title：规则中文名称 status 状态：为1正常，为0禁用，condition：规则表达式，为空表示存在就验证，不为空表示按照条件验证

CREATE TABLE `think_auth_rule` (
  `id` mediumint(8) unsigned NOT NULL,
  `name` char(80) NOT NULL DEFAULT '',
  `title` char(20) NOT NULL DEFAULT '',
  `type` tinyint(1) NOT NULL DEFAULT '1',
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `condition` char(100) NOT NULL DEFAULT ''
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `think_auth_rule`
--

INSERT INTO `think_auth_rule` (`id`, `name`, `title`, `type`, `status`, `condition`) VALUES
(1, 'Home/Index/admin', '管理员', 1, 1, ''),
(2, 'Home/Index/user', '普通用户', 1, 1, '');

-- --------------------------------------------------------

--
-- Table structure for table `think_user`
--

DROP TABLE IF EXISTS `think_user`;
CREATE TABLE `think_user` (
  `id` mediumint(8) NOT NULL AUTO_INCREMENT,
  `username` varchar(32) NOT NULL,
  `password` varchar(32) NOT NULL,
  `nickname` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
--
-- Dumping data for table `think_user`
--

INSERT INTO `think_user` (`id`, `username`, `password`, `nickname`) VALUES
(1, 'yomi', '123456', 'YOMI'),
(2, 'mingyoung', '123456', 'MINGYOUNG'),
(3,'wiki','123456','WIKI');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `think_auth_group`
--
ALTER TABLE `think_auth_group`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `think_auth_group_access`
--
ALTER TABLE `think_auth_group_access`
  ADD UNIQUE KEY `uid_group_id` (`uid`,`group_id`),
  ADD KEY `uid` (`uid`),
  ADD KEY `group_id` (`group_id`);

--
-- Indexes for table `think_auth_rule`
--
ALTER TABLE `think_auth_rule`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);


--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `think_auth_group`
--
ALTER TABLE `think_auth_group`
  MODIFY `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `think_auth_rule`
--
ALTER TABLE `think_auth_rule`
  MODIFY `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `think_user`
--
ALTER TABLE `think_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=1;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

CREATE table `think_account`(
  `id` mediumint(8) unsigned NOT NULL auto_increment primary key,
  `builder` varchar(30) NOT NULL,#发起人
  `department` varchar(50) NOT NULL,#发起部门
  `build_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP, #发起时间
  `project_name` varchar(30) NOT NULL,#项目名称
  `fee_kind_id` mediumint(8) unsigned NOT NULL,#费用类型id
  `pre_money` decimal(8,3) NOT NULL, #预计金额
  `attachment_id` mediumint(8) unsigned NOT NULL,#附件号
  `content` varchar(500) NOT NULL,#内容简介
  `leading_suggestion`  varchar(200),#负责人意见
  `director_suggestion` varchar(200),#总监意见
  `status` NOT NULL DEFAULT '0'#审批状态
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

CREATE table `think_fee_kind`(
  `id` mediumint(8) unsigned NOT NULL auto_increment primary key,
  `fee_kind` varchar(32) NOT NULL
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

CREATE table `think_department`(
  `id` mediumint(8) unsigned NOT NULL auto_increment primary key,
  `dname`  varchar(32) NOT NULL
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;
