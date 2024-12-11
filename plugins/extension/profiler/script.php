<?php

defined('_JEXEC') or die;

class plgExtensionProfilerInstallerScript
{

	function install($parent) {
		$db = JFactory::getDbo();
		$db->setQuery("UPDATE #__extensions SET enabled=1 WHERE element='profiler' AND folder='extension' AND type='plugin'");
		$db->query();
	
	}

}