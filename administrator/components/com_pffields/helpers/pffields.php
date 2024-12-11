<?php
/**
 * @package Profiler Fields for Joomla! 2.5
 * @version $Id: pffields.php 25 2013-03-28 18:05:11Z harold $
 * @author Harold Prins
 * @copyright (C) 2011-2013 Harold Prins
 * @license GNU/GPLv2 http://www.gnu.org/licenses/gpl-2.0.html
 *  
 * Profiler is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *  
 * You should have received a copy of the GNU General Public License
 * along with Profiler.  If not, see <http://www.gnu.org/licenses/gpl-2.0.html>.
*/
// No direct access
defined('_JEXEC') or die;

class PffieldsHelper
{

	public static function addSubmenu($vName, $extension = "com_pffields")
	{
		if ($extension == 'com_pffields') {
//			JSubMenuHelper::addEntry(JText::_('COM_PFFIELDS_SUBMENU_FIELDS'),	'index.php?option=com_pffields&view=fields', $vName == 'fields');
			JHtmlSidebar::addEntry(JText::_('COM_PFFIELDS_SUBMENU_PANEL'),	'index.php?option=com_pffields&view=panel', $vName == 'panel');
		} else {
			// Try to find the component helper.
			$eName	= str_replace('com_', '', $extension);
			$file	= JPath::clean(JPATH_ADMINISTRATOR.'/components/'.$extension.'/helpers/'.$eName.'.php');
			
			if (file_exists($file)) {
				require_once $file;

				$prefix	= ucfirst(str_replace('com_', '', $extension));
				$cName	= $prefix.'Helper';

				if (class_exists($cName)) {

					if (is_callable(array($cName, 'addSubmenu'))) {
						$lang = JFactory::getLanguage();
						// loading language file from the administrator/language directory then
						// loading language file from the administrator/components/*extension*/language directory
							$lang->load($extension, JPATH_BASE, null, false, false)
						||	$lang->load($extension, JPath::clean(JPATH_ADMINISTRATOR.'/components/'.$extension), null, false, false)
						||	$lang->load($extension, JPATH_BASE, $lang->getDefault(), false, false)
						||	$lang->load($extension, JPath::clean(JPATH_ADMINISTRATOR.'/components/'.$extension), $lang->getDefault(), false, false);
 						call_user_func(array($cName, 'addSubmenu'), $vName);
					}
				}
			}
		}	
	}
	
	public static function getActions($categoryId = 0)
	{
		$user	= JFactory::getUser();
		$result	= new JObject;

		if (empty($categoryId)) {
			$assetName = 'com_pffields';
		} else {
			$assetName = 'com_pffields.category.'.(int) $categoryId;
		}
		
		$actions = array(
			'core.admin', 'core.manage', 'core.create', 'core.edit', 'core.edit.state', 'core.delete'
		);

		foreach ($actions as $action) {
			$result->set($action, $assetName);
		}

		return $result;
	}
	
	public function validate($form, $data, $group = null, $model) {
		
		$table = $model->getTable();
		$key = $table->getKeyName();
		
		foreach($form->getFieldset() as $field) {
			if(($field->type == "Checkbox" || $field->type == "Checkboxes") && !isset($data[$field->fieldname])) {
				$data[$field->fieldname] = "";
		
			}
		
		}
		
				
		foreach ($data as $row => &$value)	{
			if($row == $key) {
				$value = JRequest::getInt($key);
				continue;
			} elseif ($row == "userid") {
				continue;
			}
			
			
			if($form->getFieldAttribute($row, "readonly", false) == "true") {
				unset($data[$row]);
			} elseif($form->getFieldAttribute($row, "disabled", false) == "true") {
				unset($data[$row]);
			}
			
			if($form->getFieldAttribute($row, "type") == "calendar") {
				$format = str_replace(array("%", "e", "M", "S"), array("", "j", "i", "s"), $form->getFieldAttribute($row, "format", "%Y-%m-%d"));
				$calendar = DateTime::createFromFormat($format, $value);
				if($calendar) {
					$value = $calendar->format('Y-m-d H:i:s');
				}
				
				
				
			}
		}
		
		
		return $data;
		
	}
	
	static function getCategoryOptions($extension)
	{
	
		$db		= JFactory::getDBO();
		$query	= $db->getQuery(true);
	
		// Build the query.
		$query->select('a.id AS value, a.title AS text');
		$query->from('#__profiler_categories AS a');
		$query->where('a.extension = "'.$extension.'" && a.type = "category"');
		$query->order('a.title');
	
		// Set the query and load the options.
		$db->setQuery($query);
		$options = $db->loadObjectList();
	
		// Detect errors
		if ($db->getErrorNum())
		{
			JError::raiseWarning(500, $db->getErrorMsg());
		}
	
		return $options;
	}
	
	static function getTypeOptions()
	{
		$options	= array();
		$options[]	= JHtml::_('select.option', 'category', JText::_('COM_PFFIELDS_CATEGORY'));
		$options[]	= JHtml::_('select.option', 'plugin', JText::_('COM_PFFIELDS_PLUGIN'));
		$options[]	= JHtml::_('select.option', 'module', JText::_('COM_PFFIELDS_MODULE'));
	
		return $options;
	}
}
