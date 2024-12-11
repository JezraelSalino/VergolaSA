<?php
/**
 * @package Profiler Fields for Joomla! 2.5
 * @version $Id: fields.php 23 2013-03-07 22:00:31Z harold $
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

class PffieldsModelFields extends JModelList
{

	public function __construct($config = array())
	{
		if (empty($config['filter_fields'])) {
			$config['filter_fields'] = array(
				'id', 'a.id',
				'name', 'a.name',
				'ordering', 'a.ordering',
				'title', 'a.title',
				'catid', 'a.catid', 'category_title',
				'type', 'a.type',
				'table', 'a.table',
			);
		}

		parent::__construct($config);
	}

	protected function getListQuery()
	{
		// Initialise variables.
		$db		= $this->getDbo();
		$query	= $db->getQuery(true);

		// Select the required fields from the table.
		$query->select(
			$this->getState(
				'list.select',
				'a.id, a.name, a.title,'.
				'a.extension, a.type,'.
				'a.catid,' .
				'a.ordering'
			)
		);
		$query->from($db->quoteName('#__profiler_fields').' AS a');

		// Join over the categories.
		$query->select('c.title AS category_title');
		$query->join('LEFT', '#__profiler_categories AS c ON c.id = a.catid');

		// Filter by extension
		$prefix = JRequest::getCmd('prefix', '');
		$extension = JRequest::getCmd('extension', 'com_pffields') . $prefix;
		$query->where('a.extension = "'.$extension.'"');
				
		// Filter by category.
		$categoryId = $this->getState('filter.category_id');
		if (is_numeric($categoryId)) {
			$query->where('a.catid = '.(int) $categoryId);
		}

		// Filter by search in title
		$search = $this->getState('filter.search');
		if (!empty($search)) {
			if (stripos($search, 'id:') === 0) {
				$query->where('a.id = '.(int) substr($search, 3));
			} else {
				$search = $db->Quote('%'.$db->getEscaped($search, true).'%');
				$query->where('(a.name LIKE '.$search.' )');
			}
		}

		// Add the list ordering clause.
		$orderCol	= $this->state->get('list.ordering', 'a.ordering');
		$orderDirn	= $this->state->get('list.direction', 'asc');
		if ($orderCol == 'a.ordering' || $orderCol == 'category_title') {
			$orderCol = 'c.title '.$orderDirn.', a.ordering';
		}

		$query->order($db->escape($orderCol.' '.$orderDirn));

		//echo nl2br(str_replace('#__','r2gcb_',$query)); 
		return $query;
	}

	protected function getStoreId($id = '')
	{
		//Compile the store id.
		$id	.= ':'.$this->getState('filter.search');
		$id	.= ':'.$this->getState('filter.category_id');

		return parent::getStoreId($id);
	}

	public function getTable($type = 'Field', $prefix = 'PffieldsTable', $config = array())
	{
		return JTable::getInstance($type, $prefix, $config);
	}

	protected function populateState($ordering = null, $direction = null)
	{
		// Initialise variables.
		$app = JFactory::getApplication('administrator');

		// Load the filter state.
		$search = $this->getUserStateFromRequest($this->context.'.filter.search', 'filter_search');
		$this->setState('filter.search', $search);

		$categoryId = $this->getUserStateFromRequest($this->context.'.filter.category_id', 'filter_category_id', '');
		$this->setState('filter.category_id', $categoryId);
		

		// Load the parameters.
		$params = JComponentHelper::getParams('com_pffields');
		$this->setState('params', $params);

		// List state information.
		parent::populateState('a.ordering', 'asc');
	}
}
