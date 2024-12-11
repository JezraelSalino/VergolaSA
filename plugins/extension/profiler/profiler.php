<?php

defined('_JEXEC') or die;

class plgExtensionProfiler extends JPlugin
{

	public function onExtensionAfterInstall($installer, $eid)
	{
		if ($eid)
		{
			$manifest		= $installer->getManifest();
			$type			= (string) $manifest->attributes()->type;
			if($type == "plugin") {
				$plugingroup	= (string) $manifest->attributes()->group;
				$pluginname		= (string) $manifest->name;
			
				if($plugingroup == "profiler") {
			
					//JPluginHelper::importPlugin('profiler', $pluginname);
					//$dispatcher =& JDispatcher::getInstance();
					//$results = $dispatcher->trigger('display', array(0));

					$db = JFactory::getDbo();
					
			
					foreach ($manifest->profiler->view AS $view) {
						$extension = isset($view->extension) ? $view->extension : "profiler";

						$query = "SELECT COUNT(*) FROM #__profiler_categories WHERE extension = " . $db->Quote("com_" . $extension) . " AND alias = " . $db->Quote((string) $view->id);
						$db->setQuery($query);
						$exists = $db->loadResult();
						
						if(!$exists) {
							$plugin = new stdClass();
							$plugin->extension = "com_" . $extension;
							$plugin->type = "plugin";
							$plugin->title = (string) $view->label;
							$plugin->alias = (string) $view->id;
							$plugin->extension_id = $eid;
							$db->insertObject("#__profiler_categories", $plugin);
						}
					}
					
				
				}
			}
		}
	}

	public function onExtensionAfterUninstall($installer, $eid, $result) {
		if ($eid)
		{
			try {
				$db = JFactory::getDBO();
				$query = $db->getQuery(true);
				$query->delete()->from('#__profiler_categories')->where('extension_id = '. $eid);
				$db->setQuery($query);
				$db->execute();
			} catch (Exception $e) {
			
			}
		}
		
	}
	
	public function  onExtensionAfterSave( $type, $data, $isNew) {
		$db = JFactory::getDBO();
		
		if($type == "com_modules.module") {
			if(strtolower($data->position) == "profiler" || "profiler_groups") {
				if(!$isNew) {
					$query = $db->getQuery(true);
					$query->select('id')->from('#__profiler_categories')->where('type = "module" && extension_id = '. $data->id);
					$db->setQuery($query);
					if(!$db->loadresult()) {
						$isNew = true;
					}
				}
				
				if($isNew) {
					$plugin = new stdClass();
					$plugin->extension = "com_" . $data->position;
					$plugin->type = "module";
					$plugin->title = $data->title;
					$plugin->alias = "module_" . $data->id;
					$plugin->extension_id = $data->id;
					$db->insertObject("#__profiler_categories", $plugin);
				}
			}
		}
		
		
		
		
		
	}

}
