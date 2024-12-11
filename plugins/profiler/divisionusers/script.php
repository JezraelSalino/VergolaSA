<?php

defined('_JEXEC') or die;

class plgProfilerDivisionusersInstallerScript
{

	function install($parent) {
		$db = JFactory::getDbo();
		$db->setQuery("UPDATE #__extensions SET enabled=1 WHERE element='divisionusers' AND folder='profiler' AND type='plugin'");
		$db->query();
	}

}