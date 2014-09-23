-- phpMyAdmin SQL Dump
-- version 4.0.10
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Sep 23, 2014 at 10:11 PM
-- Server version: 5.5.35-0ubuntu0.12.04.2
-- PHP Version: 5.3.10-1ubuntu3.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `gleva`
--

-- --------------------------------------------------------

--
-- Table structure for table `Arxius`
--

CREATE TABLE IF NOT EXISTS `Arxius` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL DEFAULT 'Untitled.txt',
  `mime` varchar(50) NOT NULL DEFAULT 'text/plain',
  `size` bigint(20) unsigned NOT NULL DEFAULT '0',
  `data` mediumblob NOT NULL,
  `created` datetime NOT NULL,
  `description` varchar(255) NOT NULL,
  `uploadedby` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=37 ;

-- --------------------------------------------------------

--
-- Table structure for table `Data`
--

CREATE TABLE IF NOT EXISTS `Data` (
  `datid` int(11) NOT NULL AUTO_INCREMENT,
  `datdata` date NOT NULL DEFAULT '0000-00-00',
  `datestat` tinyint(3) unsigned DEFAULT '0',
  PRIMARY KEY (`datid`),
  UNIQUE KEY `datdata` (`datdata`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=482 ;

-- --------------------------------------------------------

--
-- Table structure for table `Ingres`
--

CREATE TABLE IF NOT EXISTS `Ingres` (
  `inuf` int(11) NOT NULL DEFAULT '0',
  `indata` date NOT NULL DEFAULT '0000-00-00',
  `inquantitat` float(10,2) NOT NULL DEFAULT '0.00',
  `inmemid` int(11) NOT NULL DEFAULT '0',
  `innota` varchar(255) NOT NULL DEFAULT '',
  KEY `UF` (`inuf`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `LiniaComanda`
--

CREATE TABLE IF NOT EXISTS `LiniaComanda` (
  `lcid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `lcdata` date NOT NULL DEFAULT '0000-00-00',
  `lcuf` int(4) unsigned NOT NULL DEFAULT '0',
  `lcprod` int(10) unsigned NOT NULL DEFAULT '0',
  `lcquantitat` float(10,2) unsigned NOT NULL DEFAULT '0.00',
  `lcpreuunitat` float(10,2) NOT NULL DEFAULT '0.00',
  `lcvenda` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`lcid`),
  KEY `users` (`lcuf`),
  KEY `data` (`lcdata`),
  KEY `lcprod` (`lcprod`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=578461 ;

-- --------------------------------------------------------

--
-- Table structure for table `Log`
--

CREATE TABLE IF NOT EXISTS `Log` (
  `lgid` int(11) NOT NULL AUTO_INCREMENT,
  `lgdate` datetime NOT NULL,
  `lgwho` char(255) NOT NULL,
  `lgwhoufid` int(11) NOT NULL,
  `lgwhat` varchar(2000) NOT NULL,
  `lgwhatobj` varchar(255) NOT NULL,
  `lgwhatobjid` int(11) NOT NULL,
  `lgwhatobjty` enum('UF','PROV','GENERAL') NOT NULL,
  PRIMARY KEY (`lgid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7712 ;

-- --------------------------------------------------------

--
-- Table structure for table `Membre`
--

CREATE TABLE IF NOT EXISTS `Membre` (
  `memid` int(11) NOT NULL AUTO_INCREMENT,
  `memuf` int(11) NOT NULL DEFAULT '0',
  `memnom` varchar(255) NOT NULL DEFAULT '',
  `memlogin` varchar(50) NOT NULL DEFAULT '',
  `mempassword` varchar(255) NOT NULL DEFAULT '',
  `memtipus` tinyint(4) NOT NULL DEFAULT '0',
  `memtel` varchar(255) DEFAULT NULL,
  `mememail` varchar(255) DEFAULT NULL,
  `memextrainfo` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`memid`),
  KEY `memuf` (`memuf`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=176 ;

-- --------------------------------------------------------

--
-- Table structure for table `Producte`
--

CREATE TABLE IF NOT EXISTS `Producte` (
  `prodid` int(11) NOT NULL AUTO_INCREMENT,
  `prodcode` varchar(255) NOT NULL DEFAULT '',
  `prodprov` int(11) DEFAULT '0',
  `prodnom` varchar(255) NOT NULL DEFAULT '',
  `prodcat` int(11) DEFAULT NULL,
  `prodpreuinicial` float(10,2) DEFAULT '0.00',
  `prodiva` int(11) DEFAULT '0',
  `prodpreu` float(10,2) NOT NULL DEFAULT '0.00',
  `prodisstock` tinyint(4) NOT NULL DEFAULT '0',
  `prodstockmin` int(11) DEFAULT '0',
  `prodstockmax` int(11) DEFAULT '0',
  `prodstockactual` float(10,2) DEFAULT '0.00',
  PRIMARY KEY (`prodid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1815 ;

-- --------------------------------------------------------

--
-- Table structure for table `ProducteCategoria`
--

CREATE TABLE IF NOT EXISTS `ProducteCategoria` (
  `pcid` int(11) NOT NULL AUTO_INCREMENT,
  `pcnom` varchar(255) NOT NULL DEFAULT '',
  `pcparentpc` int(11) DEFAULT NULL,
  PRIMARY KEY (`pcid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `ProducteComanda`
--

CREATE TABLE IF NOT EXISTS `ProducteComanda` (
  `pcprodid` int(3) unsigned NOT NULL DEFAULT '0',
  `pcdata` date NOT NULL DEFAULT '0000-00-00',
  PRIMARY KEY (`pcprodid`,`pcdata`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ProducteHistoric`
--

CREATE TABLE IF NOT EXISTS `ProducteHistoric` (
  `prodid` int(11) NOT NULL,
  `data` date NOT NULL,
  `prodpreu` float(10,2) NOT NULL,
  UNIQUE KEY `prodid` (`prodid`,`data`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Proveidor`
--

CREATE TABLE IF NOT EXISTS `Proveidor` (
  `provid` int(11) NOT NULL AUTO_INCREMENT,
  `provnom` varchar(255) NOT NULL DEFAULT '',
  `provtelefon` varchar(255) DEFAULT NULL,
  `provfax` varchar(255) DEFAULT NULL,
  `provextrainfo` text NOT NULL,
  `provresponsable` varchar(255) DEFAULT NULL,
  `provtelefonresponsable` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`provid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=96 ;

-- --------------------------------------------------------

--
-- Table structure for table `StockInput`
--

CREATE TABLE IF NOT EXISTS `StockInput` (
  `stidata` date NOT NULL DEFAULT '0000-00-00',
  `stiprod` int(11) NOT NULL DEFAULT '0',
  `stipreu` float(10,2) NOT NULL DEFAULT '0.00',
  `stiquantitat` float(10,2) NOT NULL DEFAULT '0.00',
  `stimem` int(11) NOT NULL DEFAULT '0',
  KEY `stidata` (`stidata`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Stock input table.  Does not maintain current stock.';

-- --------------------------------------------------------

--
-- Table structure for table `UnitatFamiliar`
--

CREATE TABLE IF NOT EXISTS `UnitatFamiliar` (
  `ufid` int(4) unsigned NOT NULL DEFAULT '0',
  `ufname` varchar(63) NOT NULL DEFAULT '',
  `ufcontact` varchar(255) DEFAULT NULL,
  `ufaddress` varchar(255) DEFAULT NULL,
  `ufval` float(10,2) NOT NULL DEFAULT '0.00',
  PRIMARY KEY (`ufid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Venda`
--

CREATE TABLE IF NOT EXISTS `Venda` (
  `venid` int(11) NOT NULL AUTO_INCREMENT,
  `venuf` int(11) NOT NULL DEFAULT '0',
  `vendata` date NOT NULL DEFAULT '0000-00-00',
  `venvendedor` int(11) NOT NULL DEFAULT '0',
  `vensubtotal` float(10,2) NOT NULL DEFAULT '0.00',
  `venafegit` float(10,2) NOT NULL DEFAULT '0.00',
  PRIMARY KEY (`venid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11925 ;
