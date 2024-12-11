<?php
/**
 * @package Profiler Fields for Joomla! 2.5
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
defined('_JEXEC') or die;

jimport('joomla.application.component.modellist');

class PffieldsModelCategories extends JModelList
{

	public function __construct($config = array())
	{
		if (empty($config['filter_fields'])) {
			$config['filter_fields'] = array(
				'id', 'a.id',
				'extension', 'a.extension',
				'title', 'a.title',
				'alias', 'a.alias',
				'ordering', 'a.ordering',
				'description', 'a.description',
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
				'a.id, a.title,'.
				'a.extension, a.alias, a.type, a.template, '.
				'a.ordering'
			)
		);
		$query->from($db->quoteName('#__profiler_categories').' AS a');

		// Filter by extension
		$prefix = JRequest::getCmd('prefix', '');
		$extension = JRequest::getCmd('extension', 'com_pffields') . $prefix;
		$query->where('a.extension = "'.$extension.'"');

		// Filter by type
		$type = $this->getState('filter.type');
		
		if ($type) {
			$query->where('a.type = '.$db->quote($type));
		}

		//categoryfilter
		$category = $this->getState('filter.category');
		
		if ($category) {
			$query->where('a.category = '.$db->quote($category));
		}
		
		
		// Filter by search in title
		$search = $this->getState('filter.search');
		if (!empty($search)) {
			if (stripos($search, 'id:') === 0) {
				$query->where('a.id = '.(int) substr($search, 3));
			} else {
				$search = $db->Quote('%'.$db->getEscaped($search, true).'%');
				$query->where('(a.title LIKE '.$search.' )');
			}
		}

		// Add the list ordering clause.
		$orderCol	= $this->state->get('list.ordering', 'a.ordering');
		$orderDirn	= $this->state->get('list.direction', 'asc');

		$query->order($db->escape($orderCol.' '.$orderDirn));

		//echo nl2br(str_replace('#__','r2gcb_',$query)); 
		return $query;
	}

	protected function getStoreId($id = '')
	{
		//Compile the store id.
		$id	.= ':'.$this->getState('filter.search');

		return parent::getStoreId($id);
	}

	public function getTable($type = 'Category', $prefix = 'PffieldsTable', $config = array())
	{
		return JTable::getInstance($type, $prefix, $config);
	}

	protected function populateState($ordering = null, $direction = null)
	{
		// Load the filter state.
		$search = $this->getUserStateFromRequest($this->context.'.filter.search', 'filter_search');
		$this->setState('filter.search', $search);

		$type = $this->getUserStateFromRequest($this->context.'.filter.type', 'filter_type', '');
		$this->setState('filter.type', $type);
		
		// Load the parameters.
		$params = JComponentHelper::getParams('com_pffields');
		$this->setState('params', $params);

		// List state information.
		parent::populateState('a.ordering', 'asc');
	}
}
