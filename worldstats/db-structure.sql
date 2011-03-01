CREATE TABLE `hlstats_ws_playerDataTable` (
  `uniqueID` varchar(128) CHARACTER SET latin1 NOT NULL DEFAULT '',
  `name` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `profile` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `country` varchar(64) CHARACTER SET latin1 DEFAULT NULL,
  `countryCode` varchar(5) CHARACTER SET latin1 DEFAULT NULL,
  `skill` int(10) DEFAULT NULL,
  `oldSkill` int(10) DEFAULT NULL,
  `kills` int(10) DEFAULT NULL,
  `deaths` int(10) DEFAULT NULL,
  `lastConnect` datetime DEFAULT NULL,
  `lastUpdate` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`uniqueID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;