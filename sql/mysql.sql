-- phpMyAdmin SQL Dump
-- version 3.3.7deb7
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Temps de generació: 07-11-2013 a les 11:52:07
-- Versió del servidor: 5.1.66
-- Versió de PHP : 5.3.3-7+squeeze16

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de dades: `tofona`
--

-- --------------------------------------------------------

--
-- Estructura de la taula `Data`
--

CREATE TABLE IF NOT EXISTS `Data` (
  `datid` int(11) NOT NULL AUTO_INCREMENT,
  `datdata` date NOT NULL DEFAULT '0000-00-00',
  `datestat` tinyint(3) unsigned DEFAULT '0',
  PRIMARY KEY (`datid`),
  UNIQUE KEY `datdata` (`datdata`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=410 ;

-- --------------------------------------------------------

--
-- Estructura de la taula `Ingres`
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
-- Estructura de la taula `LiniaComanda`
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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=444413 ;

-- --------------------------------------------------------

--
-- Estructura de la taula `Membre`
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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=164 ;

-- --------------------------------------------------------

--
-- Estructura de la taula `Producte`
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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1361 ;

-- --------------------------------------------------------

--
-- Estructura de la taula `ProducteCategoria`
--

CREATE TABLE IF NOT EXISTS `ProducteCategoria` (
  `pcid` int(11) NOT NULL AUTO_INCREMENT,
  `pcnom` varchar(255) NOT NULL DEFAULT '',
  `pcparentpc` int(11) DEFAULT NULL,
  PRIMARY KEY (`pcid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de la taula `ProducteComanda`
--

CREATE TABLE IF NOT EXISTS `ProducteComanda` (
  `pcprodid` int(3) unsigned NOT NULL DEFAULT '0',
  `pcdata` date NOT NULL DEFAULT '0000-00-00',
  PRIMARY KEY (`pcprodid`,`pcdata`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de la taula `ProducteHistoric`
--

CREATE TABLE IF NOT EXISTS `ProducteHistoric` (
  `prodid` int(11) NOT NULL,
  `data` date NOT NULL,
  `prodpreu` float(10,2) NOT NULL,
  UNIQUE KEY `prodid` (`prodid`,`data`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de la taula `Proveidor`
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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=82 ;

-- --------------------------------------------------------

--
-- Estructura de la taula `StockInput`
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
-- Estructura de la taula `UnitatFamiliar`
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
-- Estructura de la taula `Venda`
--

CREATE TABLE IF NOT EXISTS `Venda` (
  `venid` int(11) NOT NULL AUTO_INCREMENT,
  `venuf` int(11) NOT NULL DEFAULT '0',
  `vendata` date NOT NULL DEFAULT '0000-00-00',
  `venvendedor` int(11) NOT NULL DEFAULT '0',
  `vensubtotal` float(10,2) NOT NULL DEFAULT '0.00',
  `venafegit` float(10,2) NOT NULL DEFAULT '0.00',
  PRIMARY KEY (`venid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9367 ;
