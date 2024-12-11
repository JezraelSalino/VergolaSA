CREATE TABLE IF NOT EXISTS `#__profiler_categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `extension` varchar(50) NOT NULL DEFAULT '',
  `title` varchar(255) NOT NULL,
  `alias` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL DEFAULT '',
  `ordering` int(11) NOT NULL,
  `description` mediumtext NOT NULL,
  `template` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;

CREATE TABLE IF NOT EXISTS `#__profiler_import` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL DEFAULT '',
  `params` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS `#__profiler_usergroup_map` (
  `user_id` int(10) unsigned NOT NULL DEFAULT '0',
  `group_id` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`user_id`,`group_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

ALTER TABLE `#__profiler_users` ADD `userid` int(11) DEFAULT NULL;
ALTER TABLE `#__profiler_users` ADD `name` varchar(255) NOT NULL;
ALTER TABLE `#__profiler_users` ADD `email` varchar(100) NOT NULL;
ALTER TABLE `#__profiler_users` ADD `registerDate` datetime NOT NULL DEFAULT '0000-00-00 00:00:00';
ALTER TABLE `#__profiler_users` CHANGE `id` `id` INT( 11 ) NOT NULL AUTO_INCREMENT;

UPDATE `#__profiler_users` SET `userid` = `id`;
UPDATE `#__profiler_users` AS p, `#__users` AS u SET p.name=u.name, p.email = u.email, p.registerDate = u.registerDate WHERE p.userid = u.id; 

INSERT INTO `#__profiler_fields` (`extension`, `name`, `table`, `ordering`, `title`, `value`, `multiple`, `description`, `type`, `maxlength`, `minlength`, `size`, `catid`, `cols`, `rows`, `default`, `accept`, `displaytitle`, `sys`, `regex`, `error`, `forbidden`, `format`, `mimeenable`, `extensionsenable`, `query`) VALUES
('com_profiler', 'userid', '#__profiler', 10, 'COM_PROFILER_USER_FIELD_USERID_LABEL', '', 0, 'COM_PROFILER_USER_FIELD_USERID_DESC', 'joomlauser', 0, 0, 0, 8, 0, 0, '', '', 1, 1, '', '', '', '', '', '', '');

UPDATE `#__profiler_fields` SET `table` = '#__profiler' WHERE `name` = 'name';
UPDATE `#__profiler_fields` SET `table` = '#__profiler' WHERE `name` = 'email';
UPDATE `#__profiler_fields` SET `table` = '#__profiler' WHERE `name` = 'id';
UPDATE `#__profiler_fields` SET `table` = '#__profiler' WHERE `name` = 'registerDate';