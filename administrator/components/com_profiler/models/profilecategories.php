<?php
/**
 * @package Profiler for Joomla! 2.5
 * @version $Id: profilecategories.php 31 2013-01-09 22:33:43Z harold $
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

class ProfilerModelProfilecategories extends JModelList
{

	protected function populateState($ordering = null, $direction = null)
	{
		// Initialise variables.
		$app		= JFactory::getApplication();
		$context	= $this->context;

		// List state information.
		parent::populateState('a.ordering', 'asc');
	}
	
	
	
	protected function getListQuery()
	{
		// Create a new query object.
		$db = $this->getDbo();
		$query = $db->getQuery(true);
		$id		= JRequest::getInt('profile');

		// Select the required fields from the table.
		$query->select(
			$this->getState(
				'list.select',
				'a.id AS cat_id, a.title, a.alias' .
				', a.ordering'
			)
		);
		$query->from('#__profiler_categories AS a');

		// Join over the profile access.
		$query->select('fgp.id AS fgid, fgp.*');
		$query->join('LEFT', '#__profiler_fieldgroupprofile AS fgp ON fgp.catid = a.id AND fgp.profile = ' . $id);
		
		// Add the list ordering clause.
		$query->order($db->escape($this->getState('list.ordering', 'a.ordering')));

		//echo nl2br(str_replace('#__','jos_',$query)); die();
		return $query;
	}
	

	protected function getStoreId($id = '')
	{
		// Compile the store id.
		//$id	.= ':'.$this->getState('filter.search');
		//$id	.= ':'.$this->getState('filter.category_id');

		return parent::getStoreId($id);
	}
	
	public function getTable($type = 'Profilecategories', $prefix = 'ProfilerTable', $config = array())
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
