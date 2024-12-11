<?php
/**
 * @package Profiler for Joomla! 2.5
 * @version $Id$
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

jimport('joomla.application.component.modellist');

class ProfilerModelRights extends JModelList
{
	public function getFields()
	{
		// Get the user groups from the database.
		$this->_db->setQuery(
			'SELECT a.id AS value, a.title AS text, cat.title AS category, cat.id AS catid' .
			' FROM #__profiler_fields AS a' .
			' LEFT JOIN #__profiler_categories AS cat ON a.catid = cat.id' .
			' WHERE a.extension = "com_profiler"' . 
			' ORDER BY a.catid ASC, a.ordering ASC'
		);
		$result = $this->_db->loadObjectList();

		return $result;
		
	}
	
	public function getUsergroups()
	{
		$query = $this->_db->getQuery(true);
		$query->select('a.id AS value, a.title AS text, COUNT(DISTINCT b.id) AS level');
		$query->from($this->_db->quoteName('#__usergroups') . ' AS a');
		$query->join('LEFT', $this->_db->quoteName('#__usergroups') . ' AS b ON a.lft > b.lft AND a.rgt < b.rgt');
		$query->group('a.id, a.title, a.lft, a.rgt');
		$query->order('a.lft ASC');
		$this->_db->setQuery($query);
		$result = $this->_db->loadObjectList();
		
		return $result;
	}
	
	public function getRights()
	{
		$config 	= JComponentHelper::getParams('com_profiler');

		//profile
		$result['profile']['default']['access'] = $config->get('access');
		$result['profile']['default']['readaccess'] = $config->get('readaccess');
		$result['profile']['default']['deleteaccess'] = $config->get('deleteaccess');
		$result['profile']['default']['registeraccess'] = $config->get('registeraccess');
		$result['profile']['default']['accessroprivate'] = $config->get('accessroprivate');
		$result['profile']['default']['accessprivate'] = $config->get('accessprivate');

		$query	= $this->_db->getQuery(true);
		$query->select('p.*');
 		$query->from('#__profiler AS p'); 
		$this->_db->setQuery($query);
		$profileraccess = $this->_db->loadAssocList();
		
		foreach($profileraccess as $profileaccess) {
			$result['profile'][$profileaccess['id']] = $profileaccess;
		}
		
		
		//fields
//		foreach($config->get('profilerfields') AS $fieldid => $permissions) {
//			$result['fields']['default'][$fieldid] = (array) $permissions;
//		}
		
		$query	= $this->_db->getQuery(true);
		$query->select('fp.*');
 		$query->from('#__profiler_fieldprofile AS fp'); 
		$this->_db->setQuery($query);
		$fieldsaccess = $this->_db->loadAssocList();
		
		foreach($fieldsaccess as $fieldaccess) {
			$result['fields'][$fieldaccess['profile']][$fieldaccess['fieldid']] =  $fieldaccess;
		}
		
		//categories
//		foreach($config->get('profilercategories') AS $categoryid => $permissions) {
//			$result['categories']['default'][$categoryid] = (array) $permissions;
//		}
		
		$query	= $this->_db->getQuery(true);
		$query->select('fgp.*');
 		$query->from('#__profiler_fieldgroupprofile AS fgp'); 
		$this->_db->setQuery($query);
		$categoriesaccess = $this->_db->loadAssocList();
		
		foreach($categoriesaccess as $categoryaccess) {
			$result['categories'][$categoryaccess['profile']][$categoryaccess['catid']] = $categoryaccess;
		}
		
		return $result;
		
		
	}
	
	
	protected function populateState($ordering = null, $direction = null)
	{
		// Initialise variables.
		$app = JFactory::getApplication('administrator');

		// Load the filter state.
		$acl = $this->getUserStateFromRequest($this->context.'.filter.acl', 'filter_acl', '');
		$this->setState('filter.acl', $acl);
		
		$groups = $this->getUserStateFromRequest($this->context.'.filter.users', 'filter_users', '');
		$this->setState('filter.users', $groups);
		

		// Load the parameters.
		$params = JComponentHelper::getParams('com_profiler');
		$this->setState('params', $params);

		// List state information.
		parent::populateState($ordering, $direction);
	}
	
	
}
