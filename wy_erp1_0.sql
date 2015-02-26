-- phpMyAdmin SQL Dump
-- version phpStudy 2014
-- http://www.phpmyadmin.net
--
-- 主机: localhost
-- 生成日期: 2014 年 12 月 27 日 20:54
-- 服务器版本: 5.5.36-log
-- PHP 版本: 5.4.26

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- 数据库: `wy_erp1.0`
--

-- --------------------------------------------------------

--
-- 表的结构 `wy_auth_group`
--

CREATE TABLE IF NOT EXISTS `wy_auth_group` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `title` char(100) NOT NULL DEFAULT '',
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `rules` char(80) NOT NULL DEFAULT '',
  `describe` char(50) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

--
-- 转存表中的数据 `wy_auth_group`
--

INSERT INTO `wy_auth_group` (`id`, `title`, `status`, `rules`, `describe`) VALUES
(1, '超级管理员', 1, '', '拥有全部权限'),
(2, '网站管理员', 1, '11,12,13,14,2,1,7,9,15,16,17', '拥有相对多的权限'),
(3, '发布人员', 1, '2,15,16,17', '拥有发布、修改文章的权限'),
(4, '编辑', 1, '11,12,13,14,2', '拥有文章模块的所有权限'),
(5, '积分小于50', 1, '2,15', '积分小于50'),
(6, '积分大于50小于200', 1, '2,16', '积分大于50小于200'),
(7, '积分大于200', 1, '2,17', '积分大于200'),
(8, '默认组', 1, '2,1,3', '拥有一些通用的权限');

-- --------------------------------------------------------

--
-- 表的结构 `wy_auth_group_access`
--

CREATE TABLE IF NOT EXISTS `wy_auth_group_access` (
  `uid` mediumint(8) unsigned NOT NULL,
  `group_id` mediumint(8) unsigned NOT NULL,
  UNIQUE KEY `uid_group_id` (`uid`,`group_id`),
  KEY `uid` (`uid`),
  KEY `group_id` (`group_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `wy_auth_group_access`
--

INSERT INTO `wy_auth_group_access` (`uid`, `group_id`) VALUES
(1, 1),
(2, 2),
(3, 3),
(4, 4),
(5, 5),
(6, 6),
(7, 7);

-- --------------------------------------------------------

--
-- 表的结构 `wy_auth_rule`
--

CREATE TABLE IF NOT EXISTS `wy_auth_rule` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `name` char(80) NOT NULL DEFAULT '',
  `title` char(20) NOT NULL DEFAULT '',
  `type` tinyint(1) NOT NULL DEFAULT '1',
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `condition` char(100) NOT NULL DEFAULT '',
  `mid` tinyint(3) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=18 ;

--
-- 转存表中的数据 `wy_auth_rule`
--

INSERT INTO `wy_auth_rule` (`id`, `name`, `title`, `type`, `status`, `condition`, `mid`) VALUES
(1, 'Admin/Auth/accessList', '权限列表', 1, 1, '', 3),
(2, 'Admin/Index/index', '后台首页', 1, 1, '', 2),
(3, 'Admin/Auth/accessAdd', '添加权限页面', 1, 1, '', 3),
(4, 'Admin/Auth/groupList', '角色管理页面', 1, 1, '', 3),
(5, 'Admin/Auth/addHandle', '添加权限', 1, 1, '', 3),
(6, 'Admin/Auth/groupAddHandle', '添加角色', 1, 1, '', 3),
(7, 'Admin/Auth/accessSelect', '角色授权页面', 1, 1, '', 3),
(8, 'Admin/Auth/accessSelectHandle', '更新角色权限', 1, 1, '', 3),
(9, 'Admin/Auth/groupMember', '角色组成员列表', 1, 1, '', 3),
(10, 'Admin/Auth/accessDelHandle', '删除权限', 1, 1, '', 3),
(11, 'Admin/Member/memberList', '会员列表', 1, 1, '', 1),
(12, 'Admin/Member/memberAdd', '添加会员页面', 1, 1, '', 1),
(13, 'Admin/Member/addHandle', '添加会员', 1, 1, '', 1),
(14, 'Admin/Member/deleteHandle', '删除会员', 1, 1, '', 1),
(15, 'score50', '积分小于50', 1, 1, '{score}<50', 4),
(16, 'score100', '积分大于50小于200', 1, 1, '{score}>50 and {score}<200', 4),
(17, 'score200', '积分大于200', 1, 1, '{score}>200', 4);

-- --------------------------------------------------------

--
-- 表的结构 `wy_bank`
--

CREATE TABLE IF NOT EXISTS `wy_bank` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(32) NOT NULL,
  `code` varchar(32) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

--
-- 转存表中的数据 `wy_bank`
--

INSERT INTO `wy_bank` (`id`, `name`, `code`) VALUES
(8, '招商银行', 'DDA'),
(7, '中国建设银行', 'CCCC'),
(6, '中国工商银行', ''),
(9, '交通银行', 'AA');

-- --------------------------------------------------------

--
-- 表的结构 `wy_bankcount`
--

CREATE TABLE IF NOT EXISTS `wy_bankcount` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(32) NOT NULL,
  `count` varchar(32) NOT NULL,
  `company` varchar(32) NOT NULL,
  `bank` varchar(32) NOT NULL,
  `bankcode` varchar(32) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=22 ;

--
-- 转存表中的数据 `wy_bankcount`
--

INSERT INTO `wy_bankcount` (`id`, `name`, `count`, `company`, `bank`, `bankcode`) VALUES
(1, 'adc', 'afdfw', 'et', '交通银行', 'AA'),
(2, 'acer', '', '', '', ''),
(3, 'adbc', '', '', '', ''),
(4, 'adcer', '', '', '', ''),
(5, 'adgc', '', '', '', ''),
(6, 'caga', '', '', '', ''),
(7, 'ad', '', '', '', ''),
(8, 'qwr', '', '', '', ''),
(9, 'aaaaaa', '111111', '333', '招商银行', 'DDA'),
(10, 'qqqqqq', '11111', '33', '中国建设银行', 'CCCC'),
(11, 'aaqwer', '12333333333', 'safw', '中国建设银行', 'CCCC'),
(12, 'ade', 'eqrq', '23', '中国建设银行', 'CCCC'),
(13, 'adeff', 'eqrq', '23', '中国建设银行', 'CCCC'),
(14, 'd1111', '2222222222', '33', '中国建设银行', 'CCCC'),
(15, 'd1112', '2222222222', '33', '中国建设银行', 'CCCC'),
(16, '12311', '333333', '11', '交通银行', 'AA'),
(17, '12313', '3444', '11', '交通银行', 'AA'),
(18, '2222223', '4566', '', '中国建设银行', 'CCCC'),
(19, '2777', '45667', '', '中国建设银行', 'CCCC'),
(20, 'addddddddd', '1234', 'dd', '中国建设银行', 'CCCC'),
(21, 'AAAAA', '', 'BBB', '交通银行', 'AA');

-- --------------------------------------------------------

--
-- 表的结构 `wy_company`
--

CREATE TABLE IF NOT EXISTS `wy_company` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(64) NOT NULL,
  `pname` varchar(32) NOT NULL,
  `legalperson` varchar(64) NOT NULL,
  `tax` varchar(32) NOT NULL,
  `registration` varchar(32) NOT NULL,
  `contacts` varchar(64) NOT NULL,
  `phone` varchar(32) NOT NULL,
  `qq` varchar(32) NOT NULL,
  `email` varchar(32) NOT NULL,
  `country` varchar(32) NOT NULL,
  `province` varchar(32) NOT NULL,
  `city` varchar(32) NOT NULL,
  `postcode` varchar(32) NOT NULL,
  `address` varchar(128) NOT NULL,
  `oeslogan` varchar(64) NOT NULL,
  `website` varchar(32) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=17 ;

--
-- 转存表中的数据 `wy_company`
--

INSERT INTO `wy_company` (`id`, `name`, `pname`, `legalperson`, `tax`, `registration`, `contacts`, `phone`, `qq`, `email`, `country`, `province`, `city`, `postcode`, `address`, `oeslogan`, `website`) VALUES
(12, '阿里', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(16, '新浪', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '');

-- --------------------------------------------------------

--
-- 表的结构 `wy_members`
--

CREATE TABLE IF NOT EXISTS `wy_members` (
  `uid` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(20) NOT NULL DEFAULT '',
  `password` char(32) NOT NULL DEFAULT '',
  `score` mediumint(8) unsigned NOT NULL,
  PRIMARY KEY (`uid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- 转存表中的数据 `wy_members`
--

INSERT INTO `wy_members` (`uid`, `username`, `password`, `score`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', 500),
(2, 'manager', '21232f297a57a5a743894a0e4a801fc3', 150),
(3, 'publish', '21232f297a57a5a743894a0e4a801fc3', 500),
(4, 'edit', '21232f297a57a5a743894a0e4a801fc3', 5000),
(5, 'score50', '21232f297a57a5a743894a0e4a801fc3', 30),
(6, 'score100', '21232f297a57a5a743894a0e4a801fc3', 150),
(7, 'score200', '21232f297a57a5a743894a0e4a801fc3', 300);

-- --------------------------------------------------------

--
-- 表的结构 `wy_menu`
--

CREATE TABLE IF NOT EXISTS `wy_menu` (
  `id` int(4) NOT NULL AUTO_INCREMENT,
  `pid` tinyint(4) NOT NULL,
  `title` varchar(32) NOT NULL,
  `path` varchar(32) NOT NULL,
  `link` varchar(64) NOT NULL,
  `sort` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id` (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=131 ;

--
-- 转存表中的数据 `wy_menu`
--

INSERT INTO `wy_menu` (`id`, `pid`, `title`, `path`, `link`, `sort`, `status`) VALUES
(1, 0, '主数据', '0', '', 1, 0),
(2, 0, '仓库', '0', '', 7, 0),
(3, 1, '公司', '0-1', 'Admin/Company/index', 2, 0),
(7, 1, '组织部门', '0-1', 'Admin/Department/index', 3, 0),
(8, 2, '仓库A', '0-2', '', 8, 0),
(11, 1, '角色', '0-1', '', 5, 0),
(12, 1, '权限', '0-1', '', 6, 0),
(13, 0, '采购', '0', '', 9, 0),
(130, 1, 'cc', '0-1', '', 0, 0),
(16, 7, '市场部', '0-1-7', '', 11, 0),
(17, 16, '市场部A', '0-1-7-16', '', 12, 0),
(18, 16, '市场部B', '0-1-7-16', '', 13, 0),
(19, 13, '采购A', '0-13', '', 18, 1);

-- --------------------------------------------------------

--
-- 表的结构 `wy_modules`
--

CREATE TABLE IF NOT EXISTS `wy_modules` (
  `id` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,
  `moduleName` varchar(20) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- 转存表中的数据 `wy_modules`
--

INSERT INTO `wy_modules` (`id`, `moduleName`) VALUES
(1, '会员管理'),
(2, '后台管理'),
(3, '权限管理'),
(4, '其他');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
