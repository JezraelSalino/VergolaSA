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
// No direct access.
defined('_JEXEC') or die;

jimport('joomla.application.component.modeladmin');


class PffieldsModelCategory extends JModelAdmin
{
	protected $text_prefix = 'COM_PFFIELDS_CATEGORY';


	public function getTable($type = 'Category', $prefix = 'PffieldsTable', $config = array())
	{
		return JTable::getInstance($type, $prefix, $config);
	}

	public function getForm($data = array(), $loadData = true)
	{
		$extension = JRequest::getCmd('extension', 'com_pffields');
		
		// Get the form.
		$form = $this->loadForm('com_pffields.category', 'category', array('control' => 'jform', 'load_data' => $loadData));
		if (empty($form)) {
			return false;
		}
		
		if (empty($data['extension']))
		{
			$data['extension'] = $extension;
		}
		
		$opendata = $this->getItem();
		
		if(isset($opendata->type) && $opendata->type == "plugin") {
			$form->setFieldAttribute('alias', 'type', 'hidden');
			$form->setFieldAttribute('rights', 'disabled', 'true');
		}
		
		return $form;
	}

	protected function loadFormData()
	{
		// Check the session for previously entered form data.
		$data = JFactory::getApplication()->getUserState('com_pffields.edit.category.data', array());

		if (empty($data)) {
			$data = $this->getItem();
		}

		return $data;
	}
	
	public function getItem($pk = null)
	{
		if ($item = parent::getItem($pk)) {
			
			if (empty($item->id))
			{
				$item->extension = JRequest::getCmd('extension', 'com_pffields');
			}
			
		}

		return $item;
	}

	public function save($data)
	{
	
		if (!parent::save($data)) {
			return false;
		}
	
		$catid = $this->getState('category.id');
		
		if($this->getCategoryType($catid) == "category") {
			
			$values = JRequest::getVar('rights', array(), 'post', 'array');
		
	
			
			JLoader::import( 'models.profilecategories', JPATH_ADMINISTRATOR . '/components/com_profiler' );
			JLoader::import( 'tables.profilecategories', JPATH_ADMINISTRATOR . '/components/com_profiler' );
			$model	= JModelLegacy::getInstance( 'profilecategories', 'ProfilerModel' );
			$table	= $model->getTable();
	
			foreach ($values as $profileid => $value) {
				$datarighst = array( "id" => $value['id'],
					"catid" => $catid,
					"profile" => $profileid,
					"access" => $value['access'],
					"accessro" => $value['accessro'],
					"accessreg" => $value['accessreg'],
					"published" => $value['published'],
					"registration" => $value['registration'],
					"accessroprivate" => $value['accessroprivate'],
					"accessprivate" => $value['accessprivate']
				);
				if ($datarighst['access'] == 0 && $datarighst['accessro'] == 0 && $datarighst['accessreg'] == 0 && $datarighst['published'] == 2  && $datarighst['registration'] == 2 && $datarighst['accessroprivate'] == 2 && $datarighst['accessprivate'] == 2) {
					if ($datarighst['id'] > 0 && !$table->delete($datarighst['id'])) {
						$this->setError(JText::sprintf('JLIB_APPLICATION_ERROR_SAVE_FAILED', $model->getError()));
						$this->setMessage($this->getError(), 'error');
						return false;
					}
				} elseif (!$model->save($datarighst)) {
					$this->setError(JText::sprintf('JLIB_APPLICATION_ERROR_SAVE_FAILED', $model->getError()));
					$this->setMessage($this->getError(), 'error');
					return false;
				}
	
			}
		}
		
		return true;
	}
	
	public function getCategoryType($catid) {
		$db = JFactory::getDbo();
		$query	= $db->getQuery(true);
		$query->select('c.type');
		$query->from('#__profiler_categories AS c');
		$query->where('c.id = '. (int) $catid);
		$db->setQuery($query);
		return $db->loadResult();
	}
	
}
