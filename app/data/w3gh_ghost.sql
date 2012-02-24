
CREATE TABLE IF NOT EXISTS `admins` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `botid` int(11) NOT NULL,
  `name` varchar(15) NOT NULL,
  `server` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

CREATE TABLE IF NOT EXISTS `bans` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `botid` int(11) NOT NULL,
  `server` varchar(100) NOT NULL,
  `name` varchar(15) NOT NULL,
  `ip` varchar(15) NOT NULL,
  `date` datetime NOT NULL,
  `gamename` varchar(31) NOT NULL,
  `admin` varchar(15) NOT NULL,
  `reason` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `server` (`server`),
  KEY `name` (`name`),
  KEY `gamename` (`gamename`),
  KEY `admin` (`admin`),
  KEY `botid` (`botid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

CREATE TABLE IF NOT EXISTS `dotagames` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `botid` int(11) NOT NULL,
  `gameid` int(11) NOT NULL,
  `winner` int(11) NOT NULL,
  `min` int(11) NOT NULL,
  `sec` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `gameid` (`gameid`),
  KEY `winner` (`winner`),
  KEY `botid` (`botid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

CREATE TABLE IF NOT EXISTS `dotaplayers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `botid` int(11) NOT NULL,
  `gameid` int(11) NOT NULL,
  `colour` int(11) NOT NULL,
  `kills` int(11) NOT NULL,
  `deaths` int(11) NOT NULL,
  `creepkills` int(11) NOT NULL,
  `creepdenies` int(11) NOT NULL,
  `assists` int(11) NOT NULL,
  `gold` int(11) NOT NULL,
  `neutralkills` int(11) NOT NULL,
  `item1` char(4) NOT NULL,
  `item2` char(4) NOT NULL,
  `item3` char(4) NOT NULL,
  `item4` char(4) NOT NULL,
  `item5` char(4) NOT NULL,
  `item6` char(4) NOT NULL,
  `hero` char(4) NOT NULL,
  `newcolour` int(11) NOT NULL,
  `towerkills` int(11) NOT NULL,
  `raxkills` int(11) NOT NULL,
  `courierkills` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `gameid` (`gameid`,`colour`),
  KEY `botid` (`botid`),
  KEY `gameid_2` (`gameid`),
  KEY `colour` (`colour`),
  KEY `kills` (`kills`),
  KEY `deaths` (`deaths`),
  KEY `creepkills` (`creepkills`),
  KEY `creepdenies` (`creepdenies`),
  KEY `assists` (`assists`),
  KEY `gold` (`gold`),
  KEY `neutralkills` (`neutralkills`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

CREATE TABLE IF NOT EXISTS `downloads` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `botid` int(11) NOT NULL,
  `map` varchar(100) NOT NULL,
  `mapsize` int(11) NOT NULL,
  `datetime` datetime NOT NULL,
  `name` varchar(15) NOT NULL,
  `ip` varchar(15) NOT NULL,
  `spoofed` int(11) NOT NULL,
  `spoofedrealm` varchar(100) NOT NULL,
  `downloadtime` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `botid` (`botid`),
  KEY `map` (`map`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

CREATE TABLE IF NOT EXISTS `gameplayers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `botid` int(11) NOT NULL,
  `gameid` int(11) NOT NULL,
  `name` varchar(15) NOT NULL,
  `ip` varchar(15) NOT NULL,
  `spoofed` int(11) NOT NULL,
  `reserved` int(11) NOT NULL,
  `loadingtime` int(11) NOT NULL,
  `left` int(11) NOT NULL,
  `leftreason` varchar(100) NOT NULL,
  `team` int(11) NOT NULL,
  `colour` int(11) NOT NULL,
  `spoofedrealm` varchar(100) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `gameid` (`gameid`),
  KEY `botid` (`botid`),
  KEY `gameid_2` (`gameid`),
  KEY `name` (`name`),
  KEY `team` (`team`),
  KEY `colour` (`colour`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------


CREATE TABLE IF NOT EXISTS `games` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `botid` int(11) NOT NULL,
  `server` varchar(100) NOT NULL,
  `map` varchar(100) NOT NULL,
  `datetime` datetime NOT NULL,
  `gamename` varchar(31) NOT NULL,
  `ownername` varchar(15) NOT NULL,
  `duration` int(11) NOT NULL,
  `gamestate` int(11) NOT NULL,
  `creatorname` varchar(15) NOT NULL,
  `creatorserver` varchar(100) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `botid` (`botid`),
  KEY `server` (`server`),
  KEY `gamename` (`gamename`),
  KEY `ownername` (`ownername`),
  KEY `creatorname` (`creatorname`),
  KEY `creatorserver` (`creatorserver`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Дамп данных таблицы `games`
--


-- --------------------------------------------------------

--
-- Структура таблицы `scores`
--

CREATE TABLE IF NOT EXISTS `scores` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category` varchar(25) NOT NULL,
  `name` varchar(15) NOT NULL,
  `server` varchar(100) NOT NULL,
  `score` double NOT NULL,
  PRIMARY KEY (`id`),
  KEY `name` (`name`),
  KEY `score` (`score`),
  KEY `server` (`server`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Дамп данных таблицы `scores`
--


-- --------------------------------------------------------

--
-- Структура таблицы `w3mmdplayers`
--

CREATE TABLE IF NOT EXISTS `w3mmdplayers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `botid` int(11) NOT NULL,
  `category` varchar(25) NOT NULL,
  `gameid` int(11) NOT NULL,
  `pid` int(11) NOT NULL,
  `name` varchar(15) NOT NULL,
  `flag` varchar(32) NOT NULL,
  `leaver` int(11) NOT NULL,
  `practicing` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `botid` (`botid`),
  KEY `category` (`category`),
  KEY `gameid` (`gameid`),
  KEY `pid` (`pid`),
  KEY `name` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Дамп данных таблицы `w3mmdplayers`
--


-- --------------------------------------------------------

--
-- Структура таблицы `w3mmdvars`
--

CREATE TABLE IF NOT EXISTS `w3mmdvars` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `botid` int(11) NOT NULL,
  `gameid` int(11) NOT NULL,
  `pid` int(11) NOT NULL,
  `varname` varchar(25) NOT NULL,
  `value_int` int(11) DEFAULT NULL,
  `value_real` double DEFAULT NULL,
  `value_string` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `botid` (`botid`),
  KEY `gameid` (`gameid`),
  KEY `pid` (`pid`),
  KEY `varname` (`varname`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Дамп данных таблицы `w3mmdvars`
--

