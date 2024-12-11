<?php
/**
 * @package Profiler Fields for Joomla! 2.5
 * @version $Id: field.php 31 2013-06-10 21:37:32Z harold $
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


class PffieldsModelField extends JModelAdmin
{
	protected $text_prefix = 'COM_PFFIELDS_FIELD';


	public function getTable($type = 'Field', $prefix = 'PffieldsTable', $config = array())
	{
		return JTable::getInstance($type, $prefix, $config);
	}

	public function getForm($data = array(), $loadData = true)
	{
		$extension = JRequest::getCmd('extension', 'com_pffields');
		
		// Get the form.
		$form = $this->loadForm('com_pffields.field', 'field', array('control' => 'jform', 'load_data' => $loadData));
		if (empty($form)) {
			return false;
		}
		
		if (empty($data['extension']))
		{
			$data['extension'] = $extension;
		}
		
		$prefix = JRequest::getCmd('prefix', '');
		$extension = JRequest::getCmd('extension', 'com_pffields') . $prefix;
		$form->setFieldAttribute('catid', 'query', 'SELECT id AS value, title AS catid FROM #__profiler_categories WHERE type="category" AND extension="' . $extension . '"' );

		// Determine correct permissions to check.
		if ($this->getState('field.id') || (isset($data['id']) && $data['id'])) {
			// Existing record. Can only edit in selected categories.
			$form->setFieldAttribute('catid', 'action', 'core.edit');
			$form->setFieldAttribute('type', 'disabled', 'true');
			$form->setFieldAttribute('name', 'disabled', 'true');
			
						
		} else {
			// New record. Can only create in selected categories.
			$form->setFieldAttribute('catid', 'action', 'core.create');
			$form->setFieldAttribute('type', 'required', 'true');
			$form->setFieldAttribute('name', 'required', 'true');
			
		}

		
		
		// Modify the form based on access controls.
		if (!$this->canEditState((object) $data)) {
			// Disable fields for display.
			$form->setFieldAttribute('ordering', 'disabled', 'true');
			$form->setFieldAttribute('publish_up', 'disabled', 'true');
			$form->setFieldAttribute('publish_down', 'disabled', 'true');

			// Disable fields while saving.
			// The controller has already verified this is a record you can edit.
			$form->setFieldAttribute('ordering', 'filter', 'unset');
			$form->setFieldAttribute('publish_up', 'filter', 'unset');
			$form->setFieldAttribute('publish_down', 'filter', 'unset');
		}

		return $form;
	}

	protected function loadFormData()
	{
		// Check the session for previously entered form data.
		$data = JFactory::getApplication()->getUserState('com_pffields.edit.field.data', array());

		if (empty($data)) {
			$data = $this->getItem();

			// Prime some default values.
			if ($this->getState('field.id') == 0) {
				$app = JFactory::getApplication();
				$data->set('catid', JRequest::getInt('catid', $app->getUserState('com_pffields.fields.filter.category_id')));
			}

			if (!isset($data->valuesimple)) {
				$data->set('valuesimple', $data->value);
			}
		}

		return $data;
	}
	
	public function delete(&$pks)
	{
		$return = parent::delete($pks);
		return $return;
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

	function stick(&$pks, $value = 1)
	{
		// Initialise variables.
		$user	= JFactory::getUser();
		$table	= $this->getTable();
		$pks	= (array) $pks;

		// Access checks.
		foreach ($pks as $i => $pk) {
			if ($table->load($pk)) {
				if (!$this->canEditState($table)) {
					// Prune items that you can't change.
					unset($pks[$i]);
					JError::raiseWarning(403, JText::_('JLIB_APPLICATION_ERROR_EDITSTATE_NOT_PERMITTED'));
				}
			}
		}

		// Attempt to change the state of the records.
		if (!$table->stick($pks, $value, $user->get('id'))) {
			$this->setError($table->getError());
			return false;
		}

		return true;
	}

	protected function getReorderConditions($table)
	{
		$condition = array();
		$condition[] = 'catid = '. (int) $table->catid;
		return $condition;
	}
	
	public function save($data)
	{
		
		if (!parent::save($data)) {
			return false;
		}
		
		$values = JRequest::getVar('rights', array(), 'post', 'array');
		$fieldid = $this->getState('field.id');
		
		
		JLoader::import( 'models.profilefields', JPATH_ADMINISTRATOR . '/components/com_profiler' );
		JLoader::import( 'tables.profilefields', JPATH_ADMINISTRATOR . '/components/com_profiler' );
		$model	= JModelLegacy::getInstance( 'profilefields', 'ProfilerModel' );
		$table	= $model->getTable();
		
		foreach ($values as $profileid => $value) {
			$datarighst = array( "id" => $value['id'],
				"fieldid" => $fieldid,
				"profile" => $profileid,
				"access" => $value['access'],
				"accessro" => $value['accessro'],
				"accessreg" => $value['accessreg'],
				"published" => $value['published'],
				"required" => $value['required'],
				"accessrequired" => $value['accessrequired'],
				"registration" => $value['registration'],
				"readonly" => $value['readonly'],
				"accessroprivate" => $value['accessroprivate'],
				"accessprivate" => $value['accessprivate']
			);
			if ($datarighst['access'] == 0 && $datarighst['accessro'] == 0 && $datarighst['accessreg'] == 0 && $datarighst['published'] == 2 && $datarighst['required'] == 2  && $datarighst['registration'] == 2  && $datarighst['readonly'] == 2 && $datarighst['accessroprivate'] == 2 && $datarighst['accessprivate'] == 2) {
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
		
		
		
		return true;
	}
}
