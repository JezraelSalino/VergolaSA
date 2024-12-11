ALTER TABLE `#__profiler_categories` ADD `type` VARCHAR( 50 ) NOT NULL AFTER `extension`, ADD `extension_id` INT NULL AFTER `type`;

UPDATE `#__profiler_categories` SET `type` = 'category'; 