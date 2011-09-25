
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

