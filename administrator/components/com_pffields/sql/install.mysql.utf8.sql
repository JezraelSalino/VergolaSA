CREATE TABLE IF NOT EXISTS `#__profiler_fields` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `extension` varchar(50) NOT NULL DEFAULT '',
  `name` varchar(50) NOT NULL DEFAULT '',
  `table` varchar(50) NOT NULL DEFAULT '#__profiler',
  `ordering` int(11) NOT NULL,
  `title` varchar(255) NOT NULL DEFAULT '',
  `value` mediumtext NOT NULL,
  `multiple` int(11) NOT NULL,
  `description` mediumtext NOT NULL,
  `type` varchar(50) NOT NULL DEFAULT '',
  `maxlength` int(11) DEFAULT NULL,
  `minlength` int(11) DEFAULT NULL,
  `size` int(11) DEFAULT NULL,
  `catid` int(10) unsigned NOT NULL DEFAULT '0',
  `cols` int(11) DEFAULT NULL,
  `rows` int(11) DEFAULT NULL,
  `default` mediumtext,
  `accept` text NOT NULL,
  `displaytitle` tinyint(1) NOT NULL DEFAULT '1',
  `sys` tinyint(4) NOT NULL DEFAULT '0',
  `regex` mediumtext,
  `error` mediumtext,
  `forbidden` mediumtext,
  `format` varchar(50) NOT NULL,
  `inputformat` varchar(50) NOT NULL,
  `mimeenable` mediumtext NOT NULL,
  `extensionsenable` mediumtext NOT NULL,
  `query` mediumtext NOT NULL,
  `param` text NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`),
  KEY `tabid_pub_prof_order` (`catid`),
  KEY `readonly_published_tabid` (`catid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS `#__profiler_categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `extension` varchar(50) NOT NULL DEFAULT '',
  `type` varchar(50) NOT NULL,
  `extension_id` int(11) DEFAULT NULL,
  `title` varchar(255) NOT NULL,
  `alias` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL DEFAULT '',
  `ordering` int(11) NOT NULL,
  `description` mediumtext NOT NULL,
  `template` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;