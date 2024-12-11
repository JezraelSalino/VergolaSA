ALTER TABLE `#__profiler_fieldprofile` ADD `accessrequired` INT NOT NULL AFTER `required`;
UPDATE `#__profiler_fieldprofile` SET `accessrequired` = '1';

DELETE FROM `#__profiler_categories` WHERE `alias` = 'plgdivisionusers';

INSERT INTO `#__profiler_categories` (`extension`, `type`, `extension_id`, `title`, `alias`, `ordering`) 
SELECT 'com_profiler_groups', 'plugin', extension_id, 'Users', 'plgdivisionusers', '5' from `#__extensions` WHERE `type`='plugin' AND `folder`='profiler' AND `element`='divisionusers';