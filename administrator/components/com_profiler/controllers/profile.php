<?php
/**
 * @package Profiler for Joomla! 2.5
 * @version $Id: profile.php 31 2013-01-09 22:33:43Z harold $
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
// No direct access
defined('_JEXEC') or die;

jimport('joomla.application.component.controllerform');


class ProfilerControllerProfile extends JControllerForm
{
	protected $text_prefix = 'COM_PROFILER_PROFILEFIELDS';

	public function __construct($config = array())
	{
		
		parent::__construct($config);
		$this->registerTask('applyField',		'saveField');
		$this->registerTask('applyCategory',		'saveCategory');
	}	
	
	
	public function cancel($key = null)
	{
		//$return = parent::cancel($key);

		// Redirect to the main page.
		$this->setRedirect(JRoute::_('index.php?option=com_profiler&view=profiles', false));

		return $return;
	}
	
	public function edit($key = null, $urlVar = null)
	{
		$this->context = 'profileedit';
		return parent::edit($key, $urlVar); 
	}
	
	public function save($key = null, $urlVar = null)
	{
		JRequest::checkToken() or jexit(JText::_('JINVALID_TOKEN'));
		$value = JRequest::getVar('jform', array(), 'post', 'array');
		$model	= $this->getModel('profileedit');
		$table	= $model->getTable();
				
		if ($value['access'] == 0 && $value['readaccess'] == 0 && $value['deleteaccess'] == 0 && $value['registeraccess'] == 0  && $value['accessroprivate'] == 2 && $value['accessprivate'] == 2) {
			$this->setRedirect(JRoute::_('index.php?option=com_profiler&view=profiles', false));
			if ($value['id'] > 0 && !$table->delete($value['id'])) {
				$this->setError(JText::sprintf('JLIB_APPLICATION_ERROR_SAVE_FAILED', $model->getError()));
				$this->setMessage($this->getError(), 'error');
				return false;
			}
		} else {
			$this->context = 'profileedit';
			$return = parent::save($key, $urlVar);
			$this->setRedirect(JRoute::_('index.php?option=com_profiler&view=profiles', false));
		}
		
		return $return;
	}
	
	public function saveCategory($key = null, $urlVar = null)
	{
		JRequest::checkToken() or jexit(JText::_('JINVALID_TOKEN'));
		$this->setRedirect(JRoute::_('index.php?option=com_profiler&view=profiles', false));
		$data = JRequest::get('post');
		$ids	= JRequest::getVar('catid', array(), '', 'array');
		if (empty($ids)) {
			JError::raiseWarning(500, JText::_('COM_PROFILER_ERROR_NO_CATEGORIES'));
		} else {
			$model	= $this->getModel('profilecategories');
			$table	= $model->getTable();
			foreach ($ids as $i => $id) {
				$value = array( "id" => $data['id'][$i],
								"catid" => $id,
								"profile" => $data['profile'],
								"access" => $data['access'][$i],
								"accessro" => $data['accessro'][$i],
								"accessreg" => $data['accessreg'][$i],
								"published" => $data['published'][$i],
								"registration" => $data['registration'][$i],
								"accessroprivate" => $data['accessroprivate'][$i],
								"accessprivate" => $data['accessprivate'][$i]
				);
				//print_r($value); die;
				if ($value['access'] == 0 && $value['accessro'] == 0 && $value['accessreg'] == 0 && $value['published'] == 2  && $value['registration'] == 2 && $value['accessroprivate'] == 2 && $value['accessprivate'] == 2) {
					if ($value['id'] > 0 && !$table->delete($value['id'])) {
						$this->setError(JText::sprintf('JLIB_APPLICATION_ERROR_SAVE_FAILED', $model->getError()));
						$this->setMessage($this->getError(), 'error');
						return false;
					}
				} elseif (!$model->save($value)) {
					$this->setError(JText::sprintf('JLIB_APPLICATION_ERROR_SAVE_FAILED', $model->getError()));
					$this->setMessage($this->getError(), 'error');
					return false;
				}				
			}
		}
		return true;
	}
	
	public function removeCategory()
	{
		JRequest::checkToken() or die(JText::_('JINVALID_TOKEN'));
		$this->setRedirect(JRoute::_('index.php?option=com_profiler&view=profiles', false));

		$ids	= JRequest::getVar('id', array(), '', 'array');
		if (!is_array($ids) || count($ids) < 1) {
			JError::raiseWarning(500, JText::_($this->text_prefix.'_NO_ITEM_SELECTED'));
		} else {
			$model	= $this->getModel('profilecategories');
			$table	= $model->getTable();
			jimport('joomla.utilities.arrayhelper');
			JArrayHelper::toInteger($ids);
			foreach ($ids as $i => $id) {
				if ($id > 0 && !$table->delete($id)) {
					$this->setMessage($table->getError());
					return;
				} 
			}
			$this->setMessage(JText::_($this->text_prefix.'_RESET'));
		}
	}
	
	public function saveField($key = null, $urlVar = null)
	{
		JRequest::checkToken() or jexit(JText::_('JINVALID_TOKEN'));
		$this->setRedirect(JRoute::_('index.php?option=com_profiler&view=profiles', false));
		$data = JRequest::get('post');
		$ids	= JRequest::getVar('fieldid', array(), '', 'array');
		if (empty($ids)) {
			JError::raiseWarning(500, JText::_('COM_PROFILER_ERROR_NO_FIELDS'));
		} else {
			$model	= $this->getModel('profilefields');
			$table	= $model->getTable();
			foreach ($ids as $i => $id) {
				$value = array( "id" => $data['id'][$i],
								"fieldid" => $id,
								"profile" => $data['profile'],
								"access" => $data['access'][$i],
								"accessro" => $data['accessro'][$i],
								"accessreg" => $data['accessreg'][$i],
								"published" => $data['published'][$i],
								"required" => $data['required'][$i],
								"registration" => $data['registration'][$i],
								"readonly" => $data['readonly'][$i],
								"accessroprivate" => $data['accessroprivate'][$i],
								"accessprivate" => $data['accessprivate'][$i]
				);
				//print_r($value); die;
				if ($value['access'] == 0 && $value['accessro'] == 0 && $value['accessreg'] == 0 && $value['published'] == 2 && $value['required'] == 2  && $value['registration'] == 2  && $value['readonly'] == 2 && $value['accessroprivate'] == 2 && $value['accessprivate'] == 2) {
					if ($value['id'] > 0 && !$table->delete($value['id'])) {
						$this->setError(JText::sprintf('JLIB_APPLICATION_ERROR_SAVE_FAILED', $model->getError()));
						$this->setMessage($this->getError(), 'error');
						return false;
					}
				} elseif (!$model->save($value)) {
					$this->setError(JText::sprintf('JLIB_APPLICATION_ERROR_SAVE_FAILED', $model->getError()));
					$this->setMessage($this->getError(), 'error');
					return false;
				}				
			}
		}
		return true;
	}
	
	public function removeField()
	{
		JRequest::checkToken() or die(JText::_('JINVALID_TOKEN'));
		$this->setRedirect(JRoute::_('index.php?option=com_profiler&view=profiles', false));

		$ids	= JRequest::getVar('id', array(), '', 'array');
		if (!is_array($ids) || count($ids) < 1) {
			JError::raiseWarning(500, JText::_($this->text_prefix.'_NO_ITEM_SELECTED'));
		} else {
			$model	= $this->getModel('profilefields');
			$table	= $model->getTable();
			jimport('joomla.utilities.arrayhelper');
			JArrayHelper::toInteger($ids);
			foreach ($ids as $i => $id) {
				if ($id > 0 && !$table->delete($id)) {
					$this->setMessage($table->getError());
					return;
				} 
			}
			$this->setMessage(JText::_($this->text_prefix.'_RESET'));
		}
	}
	
}
