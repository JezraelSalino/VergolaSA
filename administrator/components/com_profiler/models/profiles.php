<?php
/**
 * @package Profiler for Joomla! 2.5
 * @version $Id: profiles.php 31 2013-01-09 22:33:43Z harold $
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
defined('_JEXEC') or die;

jimport('joomla.application.component.modellist');

class ProfilerModelProfiles extends JModelList
{

	public function __construct($config = array())
	{
		if (empty($config['filter_fields'])) {
			$config['filter_fields'] = array(
				'id', 'a.id',
				'parent_id', 'a.parent_id',
				'title', 'a.title',
				'lft', 'a.lft',
				'rgt', 'a.rgt',
			);
		}

		parent::__construct($config);
	}

	protected function populateState($ordering = null, $direction = null)
	{
		// Initialise variables.
		$app = JFactory::getApplication('administrator');

		// Load the filter state.
		$search = $this->getUserStateFromRequest($this->context.'.filter.search', 'filter_search');
		$this->setState('filter.search', $search);

		// Load the parameters.
		$params = JComponentHelper::getParams('com_users');
		$this->setState('params', $params);

		// List state information.
		parent::populateState('a.lft', 'asc');
	}
	/**
	 * Method to get a store id based on model configuration state.
	 *
	 * This is necessary because the model is used by the component and
	 * different modules that might need different sets of data or different
	 * ordering requirements.
	 *
	 * @param	string		$id	A prefix for the store id.
	 *
	 * @return	string		A store id.
	 */
	protected function getStoreId($id = '')
	{
		// Compile the store id.
		$id	.= ':'.$this->getState('filter.search');
		$id	.= ':'.$this->getState('filter.search');

		return parent::getStoreId($id);
	}

	/**
	 * Gets the list of groups and adds expensive joins to the result set.
	 *
	 * @return	mixed	An array of data items on success, false on failure.
	 * @since	1.6
	 */
	public function getItems()
	{
		// Get a storage key.
		$store = $this->getStoreId();

		// Try to load the data from internal storage.
		if (empty($this->cache[$store])) {
			$items = parent::getItems();

			// Bail out on an error or empty list.
			if (empty($items)) {
				$this->cache[$store] = $items;

				return $items;
			}

			// First pass: get list of the group id's and reset the counts.
			$groupIds = array();
			foreach ($items as $item)
			{
				$groupIds[] = (int) $item->id;
				$item->user_count = 0;
			}

			// Get the counts from the database only for the users in the list.
			$db		= $this->getDbo();
			$query1	= $db->getQuery(true);
			$query2	= $db->getQuery(true);

			// Count the objects in the user group.
			$query1->select('map.group_id, COUNT(DISTINCT map.user_id) AS user_count')
				->from('`#__user_usergroup_map` AS map')
				->where('map.group_id IN ('.implode(',', $groupIds).')')
				->group('map.group_id');

			$db->setQuery($query1);

			// Load the counts into an array indexed on the user id field.
			$users = $db->loadObjectList('group_id');

			$error = $db->getErrorMsg();
			if ($error) {
				$this->setError($error);

				return false;
			}
			
			// Count the objects in the profiler user group.
			$query2->select('map.group_id, COUNT(DISTINCT map.user_id) AS user_count')
			->from('`#__profiler_usergroup_map` AS map')
			->where('map.group_id IN ('.implode(',', $groupIds).')')
			->group('map.group_id');
			
			$db->setQuery($query2);
			
			// Load the counts into an array indexed on the user id field.
			$profiler = $db->loadObjectList('group_id');
			
			$error = $db->getErrorMsg();
			if ($error) {
				$this->setError($error);
			
				return false;
			}
				

			// Second pass: collect the group counts into the master items array.
			foreach ($items as &$item)
			{
				if (isset($users[$item->id])) {
					$item->user_count = $users[$item->id]->user_count;
				}
				if (isset($profiler[$item->id])) {
					$item->user_count = $item->user_count + $profiler[$item->id]->user_count;
				}
			}

			// Add the items to the internal cache.
			$this->cache[$store] = $items;
		}

		return $this->cache[$store];
	}

	/**
	 * Build an SQL query to load the list data.
	 *
	 * @return	JDatabaseQuery
	 */
	protected function getListQuery()
	{
		// Create a new query object.
		$db		= $this->getDbo();
		$query	= $db->getQuery(true);

		// Select the required fields from the table.
		$query->select(
			$this->getState(
				'list.select',
				'a.*'
			)
		);
		$query->from('`#__usergroups` AS a');

		// Add the level in the tree.
		$query->select('COUNT(DISTINCT c2.id) AS level');
		$query->join('LEFT OUTER', '`#__usergroups` AS c2 ON a.lft > c2.lft AND a.rgt < c2.rgt');
		$query->group('a.id');

		// Filter the comments over the search string if set.
		$search = $this->getState('filter.search');
		if (!empty($search)) {
			if (stripos($search, 'id:') === 0) {
				$query->where('a.id = '.(int) substr($search, 3));
			} else {
				$search = $db->Quote('%'.$db->escape($search, true).'%');
				$query->where('a.title LIKE '.$search);
			}
		}

		// Add the list ordering clause.
		$query->order($db->escape($this->getState('list.ordering', 'a.lft')).' '.$db->escape($this->getState('list.direction', 'ASC')));

		//echo nl2br(str_replace('#__','jos_',$query));
		return $query;
	}
}
