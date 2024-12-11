<?php
/**
 * @package Profiler for Joomla! 2.5
 * @version $Id: users.php 38 2013-03-07 22:01:59Z harold $
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

class ProfilerModelUsers extends JModelList
{
	public function __construct($config = array())
	{
		if (empty($config['filter_fields'])) {
			$config['filter_fields'] = array(
				'id', 'p.id',
				'name', 'p.name',
				'username', 'a.username',
				'email', 'p.email',
				'block', 'a.block',
				'sendEmail', 'a.sendEmail',
				'registerDate', 'p.registerDate',
				'lastvisitDate', 'a.lastvisitDate',
				'activation', 'a.activation',
				'userid', 'p.userid',
			);
		}

		parent::__construct($config);
	}

	protected function populateState($ordering = null, $direction = null)
	{
		// Load the filter state.
		$search = $this->getUserStateFromRequest($this->context.'.filter.search', 'filter_search');
		$this->setState('filter.search', $search);

		$active = $this->getUserStateFromRequest($this->context.'.filter.active', 'filter_active');
		$this->setState('filter.active', $active);

		$state = $this->getUserStateFromRequest($this->context.'.filter.state', 'filter_state');
		$this->setState('filter.state', $state);

		$groupId = $this->getUserStateFromRequest($this->context.'.filter.group', 'filter_group_id', null, 'int');
		$this->setState('filter.group_id', $groupId);

		$groups = json_decode(base64_decode(JRequest::getVar('groups', '', 'default', 'BASE64')));
		if (isset($groups)) {
			JArrayHelper::toInteger($groups);
		}
		$this->setState('filter.groups', $groups);

		$excluded = json_decode(base64_decode(JRequest::getVar('excluded', '', 'default', 'BASE64')));
		if (isset($excluded)) {
			JArrayHelper::toInteger($excluded);
		}
		$this->setState('filter.excluded', $excluded);

		// Load the parameters.
		$params		= JComponentHelper::getParams('com_profiler');
		$this->setState('params', $params);

		// List state information.
		parent::populateState('p.name', 'asc');
	}

	protected function getStoreId($id = '')
	{
		// Compile the store id.
		$id	.= ':'.$this->getState('filter.search');
		$id	.= ':'.$this->getState('filter.active');
		$id	.= ':'.$this->getState('filter.state');
		$id	.= ':'.$this->getState('filter.group_id');

		return parent::getStoreId($id);
	}

	public function getItems()
	{
		// Get a storage key.
		$store = $this->getStoreId();

		// Try to load the data from internal storage.
		if (empty($this->cache[$store])) {
			$groups = $this->getState('filter.groups');
			$groupId = $this->getState('filter.group_id');
			if (isset($groups) && (empty($groups) || $groupId && !in_array($groupId, $groups))) {
				$items = array();
			}
			else {
				$items = parent::getItems();
			}

			// Bail out on an error or empty list.
			if (empty($items)) {
				$this->cache[$store] = $items;

				return $items;
			}

			// Joining the groups with the main query is a performance hog.
			// Find the information only on the result set.

			// First pass: get list of the user id's and reset the counts.
			$userIds = array();
			foreach ($items as $item)
			{
				$userIds[] = (int) $item->userid;
				$puserIds[] = (int) $item->id;
				$item->group_count = 0;
				$item->group_names = '';
			}

			// Get the counts from the database only for the users in the list.
			$db		= $this->getDbo();
			$query1	= $db->getQuery(true);
			$query2	= $db->getQuery(true);

			// Join over the group mapping table.
			$query1->select('p.id, map.user_id, COUNT(map.group_id) AS group_count')
				->from('#__user_usergroup_map AS map')
				->where('map.user_id IN ('.implode(',', $userIds).')')
				->group('map.user_id')

			// Join over the user groups table.
				->select('GROUP_CONCAT(g2.title SEPARATOR '.$db->Quote("\n").') AS group_names')
				->join('LEFT', '#__usergroups AS g2 ON g2.id = map.group_id')
				->join('LEFT', '#__profiler_users AS p ON map.user_id = p.userid');

			// Join over the group mapping table.
			$query2->select('map.user_id, COUNT(map.group_id) AS group_count')
			->from('#__profiler_usergroup_map AS map')
			->where('map.user_id IN ('.implode(',', $puserIds).')')
			->group('map.user_id')
			
			// Join over the user groups table.
			->select('GROUP_CONCAT(g2.title SEPARATOR '.$db->Quote("\n").') AS group_names')
			->join('LEFT', '#__usergroups AS g2 ON g2.id = map.group_id');
				
			$db->setQuery($query1);
			// Load the counts into an array indexed on the user id field.
			$result1 = $db->loadObjectList('id');
			$db->setQuery($query2);
			// Load the counts into an array indexed on the user id field.
			$userGroups = $result1 + $db->loadObjectList('user_id');
				
			
			$error = $db->getErrorMsg();
			if ($error) {
				$this->setError($error);

				return false;
			}

			// Second pass: collect the group counts into the master items array.
			foreach ($items as &$item)
			{
				if (isset($userGroups[$item->id])) {
					$item->group_count = $userGroups[$item->id]->group_count;
					$item->group_names = $userGroups[$item->id]->group_names;
				}
			}

			// Add the items to the internal cache.
			$this->cache[$store] = $items;
		}

		return $this->cache[$store];
	}

	protected function getListQuery()
	{
		// Create a new query object.
		$db		= $this->getDbo();
		$query	= $db->getQuery(true);

		// Select the required fields from the table.
		$query->select(
			$this->getState(
				'list.select',
				'p.id, p.userid, p.name, a.username, a.password, a.block, a.sendEmail, a.registerDate, a.lastvisitDate, a.activation, a.params, p.email'
			)
		);
		$query->from('`#__profiler_users` AS p');
		$query->join('left', '#__users AS a ON a.id=p.userid');

		// If the model is set to check item state, add to the query.
		$state = $this->getState('filter.state');

		if (is_numeric($state)) {
			$query->where('a.block = '.(int) $state);
		}

		// If the model is set to check the activated state, add to the query.
		$active = $this->getState('filter.active');

		if (is_numeric($active)) {
			if ($active == '0') {
				$query->where('a.activation = '.$db->quote(''));
			}
			else if ($active == '1') {
				$query->where('LENGTH(a.activation) = 32');
			}
		}

		// Filter the items over the group id if set.
		$groupId = $this->getState('filter.group_id');
		$groups = $this->getState('filter.groups');
		if ($groupId || isset($groups)) {
			$query->join('LEFT', '#__user_usergroup_map AS map2 ON map2.user_id = a.id');
			$query->join('LEFT', '#__profiler_usergroup_map AS map3 ON map3.user_id = p.id');
			$query->group($db->quoteName(array('p.id', 'p.userid', 'p.name', 'a.username', 'a.password', 'a.block', 'a.sendEmail', 'a.registerDate', 'a.lastvisitDate', 'a.activation', 'a.params', 'p.email')));
			if ($groupId) {
				$query->where('(map2.group_id = ' .(int) $groupId . ' || map3.group_id = '.(int) $groupId . ' )');
			}
			if (isset($groups)) {
				$query->where('(map2.group_id IN ('.implode(',', $groups).') || map3.group_id IN ('.implode(',', $groups).')');
			}
			
		}

		// Filter the items over the search string if set.
		if ($this->getState('filter.search') !== '') {
			// Escape the search token.
			$token	= $db->Quote('%'.$db->escape($this->getState('filter.search')).'%');

			// Compile the different search clauses.
			$searches	= array();
			$searches[]	= 'p.name LIKE '.$token;
			$searches[]	= 'a.username LIKE '.$token;
			$searches[]	= 'p.email LIKE '.$token;

			// Add the clauses to the query.
			$query->where('('.implode(' OR ', $searches).')');
		}

		// Filter by excluded users
		$excluded = $this->getState('filter.excluded');
		if (!empty($excluded)) {
			$query->where('id NOT IN ('.implode(',', $excluded).')');
		}

		// Add the list ordering clause.
		$query->order($db->escape($this->getState('list.ordering', 'p.name')).' '.$db->escape($this->getState('list.direction', 'ASC')));


		return $query;
	}
}
