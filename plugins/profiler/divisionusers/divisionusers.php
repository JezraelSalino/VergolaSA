<?php

defined('_JEXEC') or die;

jimport('joomla.plugin.plugin');

class plgProfilerDivisionusers extends JPlugin
{
	//tabs
	public function display($profileid) {
		
		
		JModelLegacy::addIncludePath(JPATH_SITE . '/components/com_profiler/models');
		$model = JModelLegacy::getInstance('Users', 'ProfilerModel');

		$items		= $model->getItems();
		
		
		
		
		ob_start();
		include 'tmpl/default.php';
		$content = ob_get_clean();
		
		$return[1]['label'] = JText::_("PLG_PROFILER_DIVISIONUSERS_TABLABEL");
		$return[1]['content'] = $content;
		$return[1]['id'] = "plgdivisionusers";
		return $return;
	}
	
}