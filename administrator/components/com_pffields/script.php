<?php
/**
 * @package Profiler Fields for Joomla! 3.0
 * @version $Id: script.php 11 2013-03-09 15:33:47Z harold $
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
// No direct access to this file
defined('_JEXEC') or die('Restricted access');
 
class com_pffieldsInstallerScript
{
	
	function install($parent) 
	{

	}
 
	function uninstall($parent) 
	{
	
	}
 
	function update($parent) 
	{
	
	}
 
	function preflight($type, $parent) 
	{
	
	}
 
	function postflight($type, $parent) 
	{
		$db = JFactory::getDBO();
		
		//load extension id
		$query = "SELECT extension_id FROM #__extensions WHERE element='com_pffields'";
		$db->setQuery($query);
		$id = $db->loadResult();
		
		$this->removeAdminMenus($id);
	}
	
	protected function removeAdminMenus(&$id)
	{
		// Initialise Variables
		$db = JFactory::getDbo();
		$table = JTable::getInstance('menu');
		// Get the ids of the menu items
		$query = $db->getQuery(true);
		$query->select('id');
		$query->from('#__menu');
		$query->where($query->qn('client_id') . ' = 1');
		$query->where($query->qn('component_id') . ' = ' . (int) $id);
	
		$db->setQuery($query);
	
		$ids = $db->loadColumn();
	
		// Check for error
		if ($error = $db->getErrorMsg())
		{
			return false;
		}
		elseif (!empty($ids))
		{
			// Iterate the items to delete each one.
			foreach ($ids as $menuid)
			{
				if (!$table->delete((int) $menuid))
				{
					return false;
				}
			}
			// Rebuild the whole tree
			$table->rebuild();
		}
		return true;
	}
}
