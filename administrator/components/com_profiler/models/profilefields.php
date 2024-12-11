<?php
/**
 * @package Profiler for Joomla! 2.5
 * @version $Id: profilefields.php 31 2013-01-09 22:33:43Z harold $
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

class ProfilerModelProfilefields extends JModelList
{

	public function __construct($config = array())
	{
		parent::__construct($config);
	}

	function &getCategoryOrders()
	{
		if (!isset($this->cache['categoryorders'])) {
			$db		= $this->getDbo();
			$query	= $db->getQuery(true);
			$query->select('MAX(ordering) as `max`, catid');
			$query->select('catid');
			$query->from('#__profiler_fields');
			$query->where('extension = "com_profiler"');
			$query->group('catid');
			$db->setQuery($query);
			$this->cache['categoryorders'] = $db->loadAssocList('catid', 0);
		}
		return $this->cache['categoryorders'];
	}

	protected function getListQuery()
	{
		// Initialise variables.
		$db		= $this->getDbo();
		$query	= $db->getQuery(true);
		$id		= JRequest::getInt('profile');

		// Select the required fields from the table.
		$query->select(
			$this->getState(
				'list.select',
				'a.id AS field_id, a.name AS name, a.title AS title,'.
				'a.type AS type,'.
				'a.catid AS catid,' .
				'a.ordering AS ordering'
			)
		);
		$query->from('`#__profiler_fields` AS a');
		$query->where('a.extension = "com_profiler"');

		// Join over the categories.
		$query->select('c.title AS category_title');
		$query->join('LEFT', '#__profiler_categories AS c ON c.id = a.catid');

		// Join over the profile access.
		$query->select('fp.id AS fid, fp.*');
		$query->join('LEFT', '#__profiler_fieldprofile AS fp ON fp.fieldid = a.id AND fp.profile = ' . $id);
		
		
		
		// Add the list ordering clause.
		$orderCol	= $this->state->get('list.ordering');
		$orderDirn	= $this->state->get('list.direction');
		//if ($orderCol == 'ordering' || $orderCol == 'category_title') {
			$orderCol = 'category_title '.$orderDirn.', ordering';
		//}
		$query->order($db->escape($orderCol.' '.$orderDirn));

		//echo nl2br(str_replace('#__','jos_',$query));
		return $query;
	}
	

	protected function getStoreId($id = '')
	{
		// Compile the store id.
		$id	.= ':'.$this->getState('filter.search');
		$id	.= ':'.$this->getState('filter.category_id');

		return parent::getStoreId($id);
	}
	
	public function getTable($type = 'Profilefields', $prefix = 'ProfilerTable', $config = array())
	{
		return JTable::getInstance($type, $prefix, $config);
	}
	
	public function save($data)
	{
		// Initialise variables;
		$table		= $this->getTable();
		$id			= $data['id'];
		$isNew		= true;

		try
		{
			if ($id > 0) {
				$table->load($id);
				$isNew = false;
			}

			if (!$table->bind($data)) {
				$this->setError($table->getError());
				return false;
			}

			if (!$table->check()) {
				$this->setError($table->getError());
				return false;
			}

			if (!$table->store()) {
				$this->setError($table->getError());
				return false;
			}

			// Clean the cache.
			$cache = JFactory::getCache($this->option);
			$cache->clean();

		}
		catch (Exception $e)
		{
			$this->setError($e->getMessage());

			return false;
		}

		return true;
	}
}
