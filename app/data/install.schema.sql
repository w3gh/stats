
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
  `id` mediumint(8) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `content` mediumtext CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1;

