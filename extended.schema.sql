CREATE TABLE IF NOT EXISTS `safelist` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `server` varchar(100) NOT NULL,
  `name` varchar(15) NOT NULL,
  `voucher` varchar(15) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;
