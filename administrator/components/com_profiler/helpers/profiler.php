<?php
/**
 * @package Profiler for Joomla! 2.5
 * @version $Id: profiler.php 31 2013-01-09 22:33:43Z harold $
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

class ProfilerHelper
{
	
	protected static $actions;

	public static function addSubmenu($vName)
	{
		JHtmlSidebar::addEntry(JText::_('COM_PROFILER_SUBMENU_USERS'),	'index.php?option=com_profiler&view=users', $vName == 'users');
		JHtmlSidebar::addEntry(JText::_('COM_PROFILER_SUBMENU_GROUPS'),	'index.php?option=com_profiler&view=groups', $vName == 'groups');
		JHtmlSidebar::addEntry(JText::_('COM_PROFILER_SUBMENU_FIELDS'), 'index.php?option=com_pffields&extension=com_profiler', $vName == 'fields');
		JHtmlSidebar::addEntry(JText::_('COM_PROFILER_SUBMENU_GROUPFIELDS'), 'index.php?option=com_pffields&extension=com_profiler&prefix=_groups', $vName == 'fields_groups');
		JHtmlSidebar::addEntry(JText::_('COM_PROFILER_SUBMENU_CATEGORIES'), 'index.php?option=com_pffields&extension=com_profiler&view=categories', $vName == 'categories');
		JHtmlSidebar::addEntry(JText::_('COM_PROFILER_SUBMENU_CATEGORIESGROUPS'), 'index.php?option=com_pffields&extension=com_profiler&prefix=_groups&view=categories', $vName == 'categories_groups');
		JHtmlSidebar::addEntry(JText::_('COM_PROFILER_SUBMENU_PROFILES'),	'index.php?option=com_profiler&view=profiles', $vName == 'profiles');
		JHtmlSidebar::addEntry(JText::_('COM_PROFILER_SUBMENU_RIGHTS'),	'index.php?option=com_profiler&view=rights', $vName == 'rights');
	}

	public static function getActions()
	{
		if (empty(self::$actions))
		{
			$user = JFactory::getUser();
			self::$actions = new JObject;

			$actions = JAccess::getActions('com_profiler');

			foreach ($actions as $action)
			{
				self::$actions->set($action->name, $user->authorise($action->name, 'com_profiler'));
			}
		}

		return self::$actions;
	}
	
	static function getStateOptions()
	{
		// Build the filter options.
		$options	= array();
		$options[]	= JHtml::_('select.option', '0', JText::_('JENABLED'));
		$options[]	= JHtml::_('select.option', '1', JText::_('JDISABLED'));

		return $options;
	}
	
	static function getActiveOptions()
	{
		// Build the filter options.
		$options	= array();
		$options[]	= JHtml::_('select.option', '0', JText::_('COM_PROFILER_ACTIVATED'));
		$options[]	= JHtml::_('select.option', '1', JText::_('COM_PROFILER_UNACTIVATED'));

		return $options;
	}
	
	static function getGroups()
	{
		$db = JFactory::getDbo();
		$db->setQuery(
			'SELECT a.id AS value, a.title AS text, COUNT(DISTINCT b.id) AS level' .
			' FROM #__usergroups AS a' .
			' LEFT JOIN `#__usergroups` AS b ON a.lft > b.lft AND a.rgt < b.rgt' .
			' GROUP BY a.id' .
			' ORDER BY a.lft ASC'
		);
		
		try
		{
			$options = $db->loadObjectList();
		}
		catch (RuntimeException $e)
		{
			JError::raiseNotice(500, $e->getMessage());
			return null;
		}

		foreach ($options as &$option) {
			$option->text = str_repeat('- ',$option->level).$option->text;
		}

		return $options;
	}
	
	static function getUsers()
	{
		
		$db		= JFactory::getDBO();
		$query	= $db->getQuery(true);

		// Build the query.
		$query->select('a.id AS value, a.name AS text');
		$query->from('#__users AS a');
		$query->where('a.block = 0');
		$query->order('a.name');

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
	
	static function getAclOptions()
	{
		// Build the filter options.
		$options	= array();
		$options[]	= JHtml::_('select.option', '1', JText::_('COM_PROFILER_RIGHTS_READEDIT'));
		$options[]	= JHtml::_('select.option', '2', JText::_('COM_PROFILER_RIGHTS_REGISTER'));
		$options[]	= JHtml::_('select.option', '4', JText::_('COM_PROFILER_RIGHTS_PRIVATE'));
		$options[]	= JHtml::_('select.option', '3', JText::_('COM_PROFILER_RIGHTS_CPUBLISHED'));
		$options[]	= JHtml::_('select.option', '5', JText::_('COM_PROFILER_RIGHTS_PUBLISHED'));
		$options[]	= JHtml::_('select.option', '6', JText::_('COM_PROFILER_RIGHTS_PUBLISHEDREG'));

		return $options;
	}
	
	public static function filterProfile($value)
	{

		$access = ProfilerHelperAccess::getInstance();
		$groups = $access->getRegisterUserGroups(true);
		
		foreach($value as $key => $selectgroupid) {
			if(!in_array($selectgroupid, $groups)) {
				unset($value[$key]);
			}
		}
		
		return $value;
		
	}
	
}
