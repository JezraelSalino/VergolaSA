<?php
/**
 * @package     Profiler.Plugin
 * @subpackage  System.Profiler
 *
 * @copyright   Copyright (C) 2013 Harold Prins. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

class plgSystemProfiler extends JPlugin
{
	
	function onAfterRoute() {
		
		$app = JFactory::getApplication();
		$option = JRequest::getCmd('option', '' , 'pdefault');
		$view = JRequest::getCmd('view', '' , 'pdefault');
		$task = JRequest::getCmd('task', '' , 'pdefault');
		$redirectPage = 'index.php';
		
		if ($app->getName() == 'site')
		{
			if ($option == 'com_users') {
				switch($view) {
					case 'profile':
						$app->redirect($redirectPage, "You install Profiler...");
						break;
						
					case 'registration':
						$redirectPage = JRoute::_('index.php?option=com_profiler&view=user&layout=edit');
						$app->redirect($redirectPage);
						break;
				}
			}
				
		}
		else {
			if ($option == 'com_users') {
				switch($view) {
					case 'users':
					case 'user':
						$app->redirect($redirectPage . "?option=com_profiler", "You install Profiler...");
						break;
				}
			}
		}
		
	
		return;
	}
}
