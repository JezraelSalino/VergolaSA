CREATE TABLE IF NOT EXISTS `#__profiler` (
  `id` int(11) NOT NULL,
  `readaccess` int(11) NOT NULL,
  `access` int(11) NOT NULL DEFAULT '0',
  `deleteaccess` int(11) NOT NULL,
  `registeraccess` int(11) NOT NULL,
  `accessroprivate` int(11) NOT NULL DEFAULT '2',
  `accessprivate` int(11) NOT NULL DEFAULT '2',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO `#__profiler` (`id`, `readaccess`, `access`, `deleteaccess`, `registeraccess`, `accessroprivate`, `accessprivate`) VALUES
(1, 3, 3, 3, 3, 0, 0),
(2, 0, 0, 0, 1, 2, 2),
(3, 0, 0, 0, 3, 2, 2);

CREATE TABLE IF NOT EXISTS `#__profiler_fieldgroupprofile` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `catid` int(11) NOT NULL,
  `profile` int(11) NOT NULL,
  `published` int(11) NOT NULL,
  `registration` int(11) NOT NULL,
  `readonly` int(11) NOT NULL,
  `access` int(11) NOT NULL,
  `accessro` int(11) NOT NULL,
  `accessreg` int(11) NOT NULL,
  `accessroprivate` int(11) NOT NULL,
  `accessprivate` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

INSERT INTO `#__profiler_fieldgroupprofile` (`id`, `catid`, `profile`, `published`, `registration`, `readonly`, `access`, `accessro`, `accessreg`, `accessroprivate`, `accessprivate`) VALUES
(1, 1, 1, 1, 1, 0, 1, 1, 1, 0, 0),
(2, 2, 1, 1, 0, 0, 1, 1, 1, 0, 0),
(3, 3, 1, 1, 0, 0, 1, 1, 1, 0, 0);

CREATE TABLE IF NOT EXISTS `#__profiler_fieldprofile` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fieldid` int(11) NOT NULL,
  `profile` int(11) NOT NULL,
  `published` int(11) NOT NULL,
  `required` int(11) NOT NULL,
  `accessrequired` int(11) NOT NULL,
  `registration` int(11) NOT NULL,
  `readonly` int(11) NOT NULL,
  `access` int(11) NOT NULL,
  `accessro` int(11) NOT NULL,
  `accessreg` int(11) NOT NULL,
  `accessroprivate` int(11) NOT NULL,
  `accessprivate` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

INSERT INTO `#__profiler_fieldprofile` (`id`, `fieldid`, `profile`, `published`, `required`, `accessrequired`, `registration`, `readonly`, `access`, `accessro`, `accessreg`, `accessroprivate`, `accessprivate`) VALUES
(1, 1, 1, 1, 1, 1, 1, 0, 1, 1, 1, 0, 0),
(2, 2, 1, 1, 1, 1, 1, 0, 1, 1, 1, 0, 0),
(3, 3, 1, 1, 1, 1, 1, 0, 1, 1, 1, 0, 0),
(4, 4, 1, 1, 1, 1, 1, 0, 1, 1, 1, 0, 0),
(5, 5, 1, 1, 0, 1, 1, 0, 1, 1, 1, 0, 0),
(6, 6, 1, 1, 1, 1, 1, 0, 1, 1, 1, 0, 0),
(7, 7, 1, 1, 1, 1, 1, 0, 1, 1, 1, 0, 0),
(8, 8, 1, 1, 0, 1, 1, 1, 1, 1, 1, 0, 0),
(9, 9, 1, 1, 0, 1, 1, 1, 1, 1, 1, 0, 0),
(10, 10, 1, 1, 0, 1, 1, 0, 1, 1, 1, 0, 0),
(11, 11, 1, 1, 0, 1, 1, 1, 1, 1, 1, 0, 0),
(12, 12, 1, 1, 0, 1, 1, 1, 1, 1, 1, 0, 0),
(13, 13, 1, 1, 0, 1, 1, 1, 1, 1, 1, 0, 0),
(14, 14, 1, 1, 0, 1, 1, 1, 1, 1, 1, 0, 0),
(15, 15, 1, 1, 0, 1, 1, 1, 1, 1, 1, 0, 0),
(16, 16, 1, 1, 0, 1, 1, 0, 1, 1, 1, 0, 0),
(17, 17, 1, 1, 0, 1, 1, 0, 1, 1, 1, 0, 0),
(18, 18, 1, 1, 1, 1, 1, 0, 1, 1, 1, 0, 0),
(19, 19, 1, 1, 1, 1, 1, 0, 1, 1, 1, 0, 0);

INSERT INTO `#__profiler_fields` (`id`, `extension`, `name`, `table`, `ordering`, `title`, `value`, `multiple`, `description`, `type`, `maxlength`, `minlength`, `size`, `catid`, `cols`, `rows`, `default`, `accept`, `displaytitle`, `sys`, `regex`, `error`, `forbidden`, `mimeenable`, `extensionsenable`, `query`) VALUES
('1', 'com_profiler', 'username', '#__users', 2, 'COM_PROFILER_USER_FIELD_USERNAME_LABEL', '', 0, 'COM_PROFILER_USER_FIELD_USERNAME_DESC', 'text', NULL, 0, NULL, 1, NULL, NULL, NULL, '', 1, 1, '', NULL, NULL, '', '', ''),
('2', 'com_profiler', 'password', '#__users', 8, 'JGLOBAL_PASSWORD', '', 0, 'COM_PROFILER_USER_FIELD_PASSWORD_DESC', 'password', 0, 0, 0, 1, 0, 0, '', '', 1, 1, '', '', '', '', '', ''),
('3', 'com_profiler', 'name', '#__profiler', 1, 'COM_PROFILER_USER_FIELD_NAME_LABEL', '', 0, 'COM_PROFILER_USER_FIELD_NAME_DESC', 'text', NULL, 0, NULL, 1, NULL, NULL, NULL, '', 1, 1, '', NULL, NULL, '', '', ''),
('4', 'com_profiler', 'firstname', '#__profiler', 4, 'COM_PROFILER_USER_FIELD_FNAME_LABEL', '', 0, 'COM_PROFILER_USER_FIELD_FNAME_DESC', 'text', NULL, 0, NULL, 1, NULL, NULL, NULL, '', 1, 1, '', NULL, NULL, '', '', ''),
('5', 'com_profiler', 'middlename', '#__profiler', 5, 'COM_PROFILER_USER_FIELD_MNAME_LABEL', '', 0, 'COM_PROFILER_USER_FIELD_MNAME_DESC', 'text', NULL, 0, NULL, 1, NULL, NULL, NULL, '', 1, 1, '', NULL, NULL, '', '', ''),
('6', 'com_profiler', 'lastname', '#__profiler', 6, 'COM_PROFILER_USER_FIELD_LNAME_LABEL', '', 0, 'COM_PROFILER_USER_FIELD_LNAME_DESC', 'text', NULL, 0, NULL, 1, NULL, NULL, NULL, '', 1, 1, '', NULL, NULL, '', '', ''),
('7', 'com_profiler', 'email', '#__profiler', 7, 'JGLOBAL_EMAIL', '', 0, 'COM_PROFILER_USER_FIELD_EMAIL_DESC', 'email', NULL, 0, NULL, 1, NULL, NULL, NULL, '', 1, 1, '', NULL, NULL, '', '', ''),
('8', 'com_profiler', 'id', '#__profiler', 10, 'COM_PROFILER_USER_FIELD_ID_LABEL', '', 0, 'COM_PROFILER_USER_FIELD_ID_DESC', 'readonly', 0, 0, 0, 1, 0, 0, '', '', 1, 1, NULL, '', '', '', '', ''),
('9', 'com_profiler', 'userid', '#__profiler', 10, 'COM_PROFILER_USER_FIELD_USERID_LABEL', '', 0, 'COM_PROFILER_USER_FIELD_USERID_DESC', 'joomlauser', 0, 0, 0, 1, 0, 0, '', '', 1, 1, NULL, '', '', '', '', ''),
('10', 'com_profiler', 'avatar', '#__profiler', 1, 'COM_PROFILER_USER_FIELD_IMAGE_LABEL', '', 0, 'COM_PROFILER_USER_FIELD_IMAGE_DESC', 'avatar', 0, 0, 0, 3, 120, 0, '', '', 0, 1, '', '', '', '', '', ''),
('11', 'com_profiler', 'registerDate', '#__profiler', 2, 'COM_PROFILER_USER_FIELD_REGISTERDATE_LABEL', '', 0, 'COM_PROFILER_USER_FIELD_REGISTERDATE_DESC', 'calendar', NULL, 0, NULL, 2, NULL, NULL, NULL, '', 1, 1, '', NULL, NULL, '', '', ''),
('12', 'com_profiler', 'lastvisitDate', '#__users', 1, 'COM_PROFILER_USER_FIELD_LASTVISIT_LABEL', '', 0, 'COM_PROFILER_USER_FIELD_LASTVISIT_DESC', 'calendar', NULL, 0, NULL, 2, NULL, NULL, NULL, '', 1, 1, '', NULL, NULL, '', '', ''),
('13', 'com_profiler', 'lastupdatedate', '#__profiler', 3, 'COM_PROFILER_USER_FIELD_UPDATEDATE_LABEL', '', 0, 'COM_PROFILER_USER_FIELD_UPDATEDATE_DESC', 'calendar', NULL, 0, NULL, 2, NULL, NULL, NULL, '', 1, 1, '', NULL, NULL, '', '', ''),
('14', 'com_profiler', 'hits', '#__profiler', 4, 'COM_PROFILER_USER_FIELD_HITS_LABEL', '', 0, 'COM_PROFILER_USER_FIELD_HITS_DESC', 'text', NULL, 0, NULL, 2, NULL, NULL, NULL, '', 1, 1, '', NULL, NULL, '', '', ''),
('15', 'com_profiler', 'registeredby', '#__profiler', 5, 'COM_PROFILER_USER_FIELD_REGISTEREDBY_LABEL', '', 0, 'COM_PROFILER_USER_FIELD_REGISTEREDBY_DESC', 'text', NULL, NULL, NULL, 2, NULL, NULL, NULL, '', 1, 1, NULL, NULL, NULL, '', '', ''),
('16', 'com_profiler', 'block', '#__users', 6, 'COM_PROFILER_USER_FIELD_BLOCK_LABEL', '0=JNO,1=JYES', 0, 'COM_PROFILER_USER_FIELD_BLOCK_DESC', 'radio', NULL, NULL, NULL, 2, NULL, NULL, '0', '', 1, 1, NULL, NULL, NULL, '', '', ''),
('17', 'com_profiler', 'sendEmail', '#__users', 7, 'COM_PROFILER_USER_FIELD_SENDEMAIL_LABEL', '0=JNO,1=JYES', 0, 'COM_PROFILER_USER_FIELD_SENDEMAIL_DESC', 'radio', NULL, NULL, NULL, 2, NULL, NULL, '0', '', 1, 1, NULL, NULL, NULL, '', '', ''),
('18', 'com_profiler', 'groups', '#__profiler', 3, 'COM_PROFILER_USER_FIELD_PROFILE_LABEL', '', 1, 'COM_PROFILER_USER_FIELD_PROFILE_DESC', 'profile', 0, 0, 0, 1, 0, 0, '', '', 1, 1, NULL, '', '', '', '', ''),
('19', 'com_profiler', 'password2', '#__users', 9, 'COM_PROFILER_USER_FIELD_PASSWORD2_LABEL', '', 0, 'COM_PROFILER_USER_FIELD_PASSWORD2_DESC', 'password', NULL, NULL, NULL, 1, NULL, NULL, NULL, '', 1, 1, NULL, NULL, NULL, '', '', ''),
('20', 'com_profiler_groups', 'groupid', '#__groups', 1, 'COM_PROFILER_GROUP_FIELD_ID_LABEL', '', 0, 'COM_PROFILER_GROUP_FIELD_ID_DESC', 'readonly', 0, 0, 0, 4, 0, 0, '', '', 1, 1, NULL, '', '', '', '', ''),
('21', 'com_profiler_groups', 'groupname', '#__groups', 2, 'COM_PROFILER_GROUP_FIELD_NAME_LABEL', '', 0, 'COM_PROFILER_GROUP_FIELD_NAME_DESC', 'text', NULL, 0, NULL, 4, NULL, NULL, NULL, '', 1, 1, '', NULL, NULL, '', '', ''),
('22', 'com_profiler_groups', 'groupemail', '#__groups', 3, 'JGLOBAL_EMAIL', '', 0, 'COM_PROFILER_GROUP_FIELD_EMAIL_DESC', 'email', NULL, 0, NULL, 4, NULL, NULL, NULL, '', 1, 1, '', NULL, NULL, '', '', ''),
('23', 'com_profiler_groups', 'groupblock', '#__groups', 4, 'COM_PROFILER_GROUP_FIELD_BLOCK_LABEL', '0=JNO,1=JYES', 0, 'COM_PROFILER_GROUP_FIELD_BLOCK_DESC', 'radio', NULL, NULL, NULL, 4, NULL, NULL, '0', '', 1, 1, NULL, NULL, NULL, '', '', ''),
('24', 'com_profiler_groups', 'groupregisterDate', '#__groups', 5, 'COM_PROFILER_GROUP_FIELD_REGISTERDATE_LABEL', '', 0, 'COM_PROFILER_GROUP_FIELD_REGISTERDATE_DESC', 'calendar', NULL, 0, NULL, 4, NULL, NULL, NULL, '', 1, 1, '', NULL, NULL, '', '', '');

INSERT INTO `#__profiler_categories` (`id`, `extension`, `type`, `extension_id`, `title`, `alias`, `ordering`, `description`, `template`) VALUES
(1, 'com_profiler', 'category', null, 'User fields', 'user-fields', 1, '', '' ),
(2, 'com_profiler', 'category', null, 'User status', 'user-status', 2, '', ''),
(3, 'com_profiler', 'category', null, 'User image', 'user-image', 3, '', 'image'),
(4, 'com_profiler_groups', 'category', null, 'Groups', 'groups', 4, '', '');

INSERT INTO `#__profiler_categories` (`extension`, `type`, `extension_id`, `title`, `alias`, `ordering`) 
SELECT 'com_profiler_groups', 'plugin', extension_id, 'Users', 'plgdivisionusers', '5' from `#__extensions` WHERE `type`='plugin' AND `folder`='profiler' AND `element`='divisionusers';


CREATE TABLE IF NOT EXISTS `#__profiler_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userid` int(11) DEFAULT NULL,
  `firstname` varchar(100) DEFAULT NULL,
  `middlename` varchar(100) DEFAULT NULL,
  `lastname` varchar(100) DEFAULT NULL,
  `hits` int(11) NOT NULL DEFAULT '0',
  `avatar` varchar(255) DEFAULT NULL,
  `lastupdatedate` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `registeripaddr` varchar(50) NOT NULL DEFAULT '',
  `registeredby` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `registerDate` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;

CREATE TABLE IF NOT EXISTS `#__profiler_groups` (
  `groupid` int(11) NOT NULL AUTO_INCREMENT,
  `groupname` varchar(255) NOT NULL DEFAULT '',
  `groupemail` varchar(100) NOT NULL DEFAULT '',
  `groupblock` tinyint(4) NOT NULL DEFAULT '0',
  `groupregisterDate` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`groupid`),
  KEY `idx_name` (`groupname`),
  KEY `idx_block` (`groupblock`),
  KEY `email` (`groupemail`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10;

CREATE TABLE IF NOT EXISTS `#__profiler_usergroup_map` (
  `user_id` int(10) unsigned NOT NULL DEFAULT '0',
  `group_id` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`user_id`,`group_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `#__profiler_import` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL DEFAULT '',
  `params` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

