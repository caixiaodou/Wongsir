-- phpMyAdmin SQL Dump
-- version 2.11.2.1
-- http://www.phpmyadmin.net
--
-- 主机: localhost
-- 生成日期: 2015 年 07 月 21 日 23:20
-- 服务器版本: 5.0.45
-- PHP 版本: 5.2.5

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

--
-- 数据库: `caixiaodou`
--

-- --------------------------------------------------------

--
-- 表的结构 `manager`
--

CREATE TABLE `manager` (
  `managerId` int(255) NOT NULL,
  `managerPassword` varchar(30) NOT NULL,
  `managerName` varchar(30) NOT NULL,
  PRIMARY KEY  (`managerId`),
  KEY `index_ManagerName` (`managerName`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 导出表中的数据 `manager`
--


-- --------------------------------------------------------

--
-- 表的结构 `order`
--

CREATE TABLE `order` (
  `orderId` int(255) NOT NULL auto_increment,
  `orderNumber` int(30) NOT NULL,
  `userPhone` int(11) NOT NULL,
  `userName` varchar(30) NOT NULL,
  `orderAmount` int(30) NOT NULL,
  `orderDate` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  `orderTime` time NOT NULL default '18:00:00',
  `orderFlag` char(10) NOT NULL,
  `orderAddress` varchar(255) NOT NULL,
  PRIMARY KEY  (`orderId`),
  KEY `index_UserPhone` (`userPhone`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=12 ;

--
-- 导出表中的数据 `order`
--

INSERT INTO `order` (`orderId`, `orderNumber`, `userPhone`, `userName`, `orderAmount`, `orderDate`, `orderTime`, `orderFlag`, `orderAddress`) VALUES
(11, 1, 1, '1', 1, '2015-07-21 20:47:33', '18:00:00', '1', '');

-- --------------------------------------------------------

--
-- 表的结构 `product`
--

CREATE TABLE `product` (
  `productId` int(255) NOT NULL auto_increment,
  `productNumber` char(20) NOT NULL,
  `productName` varchar(30) NOT NULL,
  `productCharacter` text NOT NULL,
  `productInfo` text NOT NULL,
  `productWeigth` char(10) NOT NULL,
  `productOrigin` char(10) NOT NULL,
  `productPrice` char(10) NOT NULL,
  `productTime` char(10) NOT NULL,
  PRIMARY KEY  (`productId`),
  UNIQUE KEY `index_productName` (`productName`),
  KEY `index_productNumber` (`productNumber`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- 导出表中的数据 `product`
--


-- --------------------------------------------------------

--
-- 表的结构 `productimg`
--

CREATE TABLE `productimg` (
  `imgId` int(255) NOT NULL auto_increment,
  `productId` int(30) NOT NULL,
  `imgName` varchar(30) NOT NULL,
  `imgRoot` varchar(64) NOT NULL,
  `imgFlag` char(3) NOT NULL,
  PRIMARY KEY  (`imgId`),
  KEY `index_productId` (`productId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- 导出表中的数据 `productimg`
--


-- --------------------------------------------------------

--
-- 表的结构 `productkind`
--

CREATE TABLE `productkind` (
  `productId` int(255) NOT NULL,
  `productKind` char(5) NOT NULL,
  `productToday` char(5) NOT NULL,
  PRIMARY KEY  (`productId`),
  KEY `index_ProductKind` (`productKind`),
  KEY `index_ProductToday` (`productToday`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 导出表中的数据 `productkind`
--


-- --------------------------------------------------------

--
-- 表的结构 `productquantity`
--

CREATE TABLE `productquantity` (
  `productId` int(255) NOT NULL,
  `productQuantity` int(30) NOT NULL,
  PRIMARY KEY  (`productId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 导出表中的数据 `productquantity`
--


-- --------------------------------------------------------

--
-- 表的结构 `product_order`
--

CREATE TABLE `product_order` (
  `id` int(255) NOT NULL auto_increment,
  `productId` int(255) NOT NULL,
  `quantity` int(20) NOT NULL,
  `orderId` int(255) NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `index_orderId` (`orderId`),
  KEY `index_productId` (`productId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- 导出表中的数据 `product_order`
--


-- --------------------------------------------------------

--
-- 表的结构 `user`
--

CREATE TABLE `user` (
  `userId` int(255) NOT NULL auto_increment,
  `userTel` char(11) NOT NULL,
  `userPassword` varchar(255) NOT NULL,
  `userName` varchar(30) NOT NULL,
  `sex` char(3) default '保密',
  `email` varchar(30) default NULL,
  `regTime` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  PRIMARY KEY  (`userId`),
  UNIQUE KEY `Index_UserTel` (`userTel`),
  KEY `index_UserName` (`userName`),
  KEY `index_regTime` (`regTime`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- 导出表中的数据 `user`
--

INSERT INTO `user` (`userId`, `userTel`, `userPassword`, `userName`, `sex`, `email`, `regTime`) VALUES
(1, '13660559158', '17ba0791499db908433b80f37c5fbc89b870084b', '发', '保密', '', '0000-00-00 00:00:00'),
(2, '13660559157', '17ba0791499db908433b80f37c5fbc89b870084b', 'fas', '保密', '', '0000-00-00 00:00:00');
