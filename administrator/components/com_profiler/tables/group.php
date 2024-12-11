<?php
/**
 * @package Profiler for Joomla! 2.5
 * @version $Id: group.php 48 2013-06-10 21:36:21Z harold $
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
// No direct access.
defined('_JEXEC') or die;

class ProfilerTableGroup extends JTable
{

	function __construct(&$_db)
	{
		parent::__construct('#__profiler_groups', 'groupid', $_db);
	}
	
	function check()
	{
		if ($this->groupregisterDate == null || $this->groupregisterDate == $this->_db->getNullDate() ) {
			$this->groupregisterDate = JFactory::getDate()->toSql();
		}
		return true;
	}
	
	function store($updateNulls = false) {
		$fields	= $this->_db->getTableColumns("#__profiler_groups", false);
	
		foreach ($fields as $name => $v)
		{
			if (property_exists($this, $name)) {
				if(is_array($this->$name)) {
					$registry = new JRegistry;
					$registry->loadArray($this->$name);
					$this->$name = $registry->toString();
				}
			}
		}
	
		return parent::store($updateNulls);
	
	}

}
