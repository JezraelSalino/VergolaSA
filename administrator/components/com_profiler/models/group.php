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
defined('_JEXEC') or die;

jimport('joomla.application.component.modeladmin');
require_once JPATH_ADMINISTRATOR . '/components/com_pffields/helpers/form.php';

class ProfilerModelGroup extends JModelAdmin
{
	
	private $multiplefields = array();
	
	public function getTable($type = 'Group', $prefix = 'ProfilerTable', $config = array())
	{
		$table = JTable::getInstance($type, $prefix, $config);
		return $table;
	}

	public function getForm($data = array(), $loadData = true, $groupname = "")
	{
		// Initialise variables.
		$app	= JFactory::getApplication();

		// Get the form.
		$form = $this->loadForm('com_profiler.group' . $groupname, 'group', array('control' => 'jform', 'load_data' => $loadData));
		if (empty($form)) {
			return false;
		}
		
		$data = $this->loadFormData();
		// Get fields Profiler Fields
		$pffieldshelperform	= PffieldsHelperForm::getInstance();
		$formxml = $pffieldshelperform->getForm('com_profiler_groups', $form, $data);
		
		if (empty($formxml)) {
			return false;
		}
		
		$data = $this->loadFormData($pffieldshelperform->getMultiplefields());
		
		
		$this->preprocessForm($form, $data);
		$form->bind($data);

		$form->setFieldAttribute('groupid', 'readonly', 'true');
		$form->setFieldAttribute('groupid', 'class', 'readonly');
		$form->setFieldAttribute('groupregisterDate', 'readonly', 'true');
		$form->setFieldAttribute('groupregisterDate', 'class', 'readonly');
		
		
		return $form;
	}
	

	protected function loadFormData($multiple = array())
	{
		$data = JFactory::getApplication()->getUserState('com_profiler.edit.group.data', array());

		
		if (empty($data)) {
			$data = $this->getItem();
		}
		
		foreach($multiple as $fields) {
			if(is_object($data) && is_string($data->$fields)) {
				$registry = new JRegistry;
				$registry->loadString($data->$fields);
				$data->$fields = $registry->toArray();
			}
			
		}
				
		return $data;
	}
	
	function block(&$pks, $value = 1)
	{
		// Initialise variables.
		$app		= JFactory::getApplication();
		$user		= JFactory::getUser();
		$table		= $this->getTable();
		$pks		= (array) $pks;

		JPluginHelper::importPlugin('user');

		// Access checks.
		foreach ($pks as $i => $pk)
		{
			if ($table->load($pk)) {
				$old	= $table->getProperties();
				$allow	= $user->authorise('core.edit.state', 'com_profiler');

				// Prepare the logout options.
				$options = array(
					'clientid' => array(0, 1)
				);

				if ($allow) {
					// Skip changing of same state
					if ($table->groupblock == $value) {
						unset($pks[$i]);
						continue;
					}

					$table->groupblock = (int) $value;

					// Allow an exception to be thrown.
					try
					{
						if (!$table->check()) {
							$this->setError($table->getError());
							return false;
						}

						// Store the table.
						if (!$table->store()) {
							$this->setError($table->getError());
							return false;
						}

					}
					catch (Exception $e)
					{
						$this->setError($e->getMessage());

						return false;
					}

				}
				else {
					// Prune items that you can't change.
					unset($pks[$i]);
					JError::raiseWarning(403, JText::_('JLIB_APPLICATION_ERROR_EDITSTATE_NOT_PERMITTED'));
				}
			}
		}

		return true;
	}
}
