
CREATE TABLE IF NOT EXISTS `admins` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `botid` int(10) unsigned NOT NULL,
  `name` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `server` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=12 ;

-- --------------------------------------------------------

CREATE TABLE IF NOT EXISTS `bans` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `botid` int(10) unsigned NOT NULL,
  `server` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `ip` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `date` datetime NOT NULL,
  `gamename` varchar(31) COLLATE utf8_unicode_ci NOT NULL,
  `admin` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `reason` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `name` (`name`),
  KEY `date` (`date`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=190 ;

-- --------------------------------------------------------

CREATE TABLE IF NOT EXISTS `dotagames` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `botid` int(10) unsigned NOT NULL,
  `gameid` int(10) unsigned NOT NULL,
  `winner` enum('0','1','2') COLLATE utf8_unicode_ci NOT NULL,
  `min` tinyint(3) unsigned NOT NULL,
  `sec` tinyint(2) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id` (`id`),
  KEY `gameid` (`gameid`),
  KEY `winner` (`winner`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=4095 ;

-- --------------------------------------------------------

CREATE TABLE IF NOT EXISTS `dotaplayers` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `botid` int(10) unsigned NOT NULL,
  `gameid` int(10) unsigned NOT NULL,
  `colour` tinyint(2) unsigned NOT NULL,
  `kills` tinyint(3) unsigned NOT NULL,
  `deaths` tinyint(3) unsigned NOT NULL,
  `creepkills` smallint(4) unsigned NOT NULL,
  `creepdenies` tinyint(3) unsigned NOT NULL,
  `assists` tinyint(3) unsigned NOT NULL,
  `gold` smallint(5) unsigned NOT NULL,
  `neutralkills` tinyint(3) unsigned NOT NULL,
  `item1` varchar(4) COLLATE utf8_unicode_ci NOT NULL,
  `item2` varchar(4) COLLATE utf8_unicode_ci NOT NULL,
  `item3` varchar(4) COLLATE utf8_unicode_ci NOT NULL,
  `item4` varchar(4) COLLATE utf8_unicode_ci NOT NULL,
  `item5` varchar(4) COLLATE utf8_unicode_ci NOT NULL,
  `item6` varchar(4) COLLATE utf8_unicode_ci NOT NULL,
  `hero` varchar(4) COLLATE utf8_unicode_ci NOT NULL,
  `newcolour` tinyint(2) unsigned NOT NULL,
  `towerkills` tinyint(3) unsigned NOT NULL,
  `raxkills` tinyint(3) unsigned NOT NULL,
  `courierkills` tinyint(3) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `gameid` (`gameid`,`colour`),
  KEY `newcolour` (`newcolour`),
  KEY `hero` (`hero`),
  KEY `item1` (`item1`),
  KEY `item2` (`item2`),
  KEY `item3` (`item3`),
  KEY `item4` (`item4`),
  KEY `item5` (`item5`),
  KEY `item6` (`item6`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=34906 ;

-- --------------------------------------------------------

CREATE TABLE IF NOT EXISTS `downloads` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `botid` int(10) unsigned NOT NULL,
  `map` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `mapsize` int(10) unsigned NOT NULL,
  `datetime` datetime NOT NULL,
  `name` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `ip` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `spoofed` enum('0','1') COLLATE utf8_unicode_ci NOT NULL,
  `spoofedrealm` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `downloadtime` smallint(6) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=122 ;

-- --------------------------------------------------------

CREATE TABLE IF NOT EXISTS `gameplayers` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `botid` int(10) unsigned NOT NULL,
  `gameid` int(10) unsigned NOT NULL,
  `name` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `ip` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `spoofed` enum('0','1') COLLATE utf8_unicode_ci NOT NULL,
  `reserved` enum('0','1') COLLATE utf8_unicode_ci NOT NULL,
  `loadingtime` smallint(6) unsigned NOT NULL,
  `left` smallint(6) unsigned NOT NULL,
  `leftreason` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `team` tinyint(2) unsigned NOT NULL,
  `colour` tinyint(2) unsigned NOT NULL,
  `spoofedrealm` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `gameid` (`gameid`),
  KEY `gameid_2` (`gameid`),
  KEY `colour` (`colour`),
  KEY `name` (`name`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=40403 ;

-- --------------------------------------------------------

CREATE TABLE IF NOT EXISTS `games` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `botid` int(10) unsigned NOT NULL,
  `server` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `map` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `datetime` datetime NOT NULL,
  `gamename` varchar(31) COLLATE utf8_unicode_ci NOT NULL,
  `ownername` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `duration` smallint(6) unsigned NOT NULL,
  `gamestate` tinyint(2) unsigned NOT NULL,
  `creatorname` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `creatorserver` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `datetime` (`datetime`),
  KEY `map` (`map`),
  KEY `gamestate` (`gamestate`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=4095 ;

-- --------------------------------------------------------

CREATE TABLE IF NOT EXISTS `heroes` (
  `heroid` varchar(4) NOT NULL,
  `original` varchar(4) NOT NULL,
  `description` varchar(32) NOT NULL,
  `summary` varchar(900) NOT NULL,
  `stats` varchar(300) NOT NULL,
  `skills` varchar(300) NOT NULL,
  PRIMARY KEY (`heroid`),
  KEY `description` (`description`),
  KEY `original` (`original`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

CREATE TABLE IF NOT EXISTS `items` (
  `itemid` varchar(4) NOT NULL,
  `name` varchar(50) NOT NULL,
  `shortname` varchar(50) NOT NULL,
  `item_info` mediumtext CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `icon` varchar(50) NOT NULL,
  PRIMARY KEY (`itemid`),
  KEY `name` (`name`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------


CREATE TABLE IF NOT EXISTS `news` (
  `news_id` mediumint(8) NOT NULL AUTO_INCREMENT,
  `news_title` varchar(90) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `news_content` mediumtext CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `news_created` datetime NOT NULL,
  `news_updated` datetime NOT NULL,
  PRIMARY KEY (`news_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

CREATE TABLE IF NOT EXISTS `safelist` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `server` varchar(100) NOT NULL,
  `name` varchar(15) NOT NULL,
  `voucher` varchar(15) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

CREATE TABLE IF NOT EXISTS `scores` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category` varchar(25) NOT NULL,
  `name` varchar(15) NOT NULL,
  `server` varchar(100) NOT NULL,
  `score` double NOT NULL,
  PRIMARY KEY (`id`),
  KEY `name` (`name`),
  KEY `score` (`score`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;
