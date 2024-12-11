<?php
/**
 * @package Profiler for Joomla! 2.5
 * @version $Id: user.php 31 2013-01-09 22:33:43Z harold $
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

jimport('joomla.application.component.controllerform');

class ProfilerControllerUser extends JControllerForm
{
	protected $text_prefix = 'COM_PROFILER_USER';

	protected function allowEdit($data = array(), $key = 'id')
	{
		if (JAccess::check($data[$key], 'core.admin')) {
			if (!JFactory::getUser()->authorise('core.admin')) {
				return false;
			}
		}

		return parent::allowEdit($data, $key);
	}

	public function save($key = null, $urlVar = null)
	{
		$dispatcher	= JDispatcher::getInstance();
		JPluginHelper::importPlugin('profiler');
		$data = JRequest::getVar('jform', array(), 'post', 'array');
		
		$recordId = JRequest::getVar('id'); //$this->input->getInt('id');
		
		if(!isset($data['id'])) {
			$data['id'] = $recordId;
			JRequest::setVar('jform', $data, 'POST');
			//$this->input->post->set('jform', $data);
		}
		
		if(!isset($data['userid']) && $data['id'] > 0) {
			$access = ProfilerHelperAccess::getInstance();
			$data['userid'] = $access->getJoomlaUserId($data['id']);
			JRequest::setVar('jform', $data, 'POST');
			//$this->input->post->set('jform', $data);
		}
		
		$result = $dispatcher->trigger('onProfilerUserBeforeValidate', array(&$data));
		
		if($result) {
			JRequest::setVar('jform', $data, 'POST'); //Joomla25 update
			//$this->input->post->set('jform', $data); 
		}
		
		
		if (isset($data['password']) && isset($data['password2'])) {
			if ($data['password'] != $data['password2']) {
				$this->setMessage(JText::_('JLIB_USER_ERROR_PASSWORD_NOT_MATCH'), 'warning');
				$this->setRedirect(JRoute::_('index.php?option=com_users&view=user&layout=edit', false));
			}

			unset($data['password2']);
		}

		if(!parent::save()) {
			return false;
		}
		

		return true;
	}
	
	public function setProfile() {
		// Initialise variables.
		$app		= JFactory::getApplication();
		
		// Get the posted values from the request.
		$data		= JRequest::getVar('jform', array(), 'post', 'array');
		$recordId	= JRequest::getInt('id');
		
		//Save the data in the session.
		$app->setUserState('com_profiler.edit.user.data', $data);
		$this->setRedirect(JRoute::_('index.php?option='.$this->option.'&view='.$this->view_item.$this->getRedirectToItemAppend($recordId), false));
		
	}
	
	public function synchronize() {
		$app		= JFactory::getApplication();
		$db = &JFactory::getDBO();
		$query = "SELECT u.id, u.name FROM #__users AS u WHERE NOT EXISTS (SELECT pu.id FROM #__profiler_users AS pu WHERE pu.id=u.id)";
		$db->setQuery($query);
		$users = $db->loadAssocList();
		foreach ($users as $user) {
			$query = "INSERT INTO #__profiler_users (id , lastname) VALUES ('".$user['id']."', '".$user['name']."');";
			$db->setQuery($query);
			$db->query();
			$app->enqueueMessage('Synchronize user '.$user['id'].' '.$user['username']);
		}
		$this->setMessage('Synchronize complete');
		$this->setRedirect(JRoute::_('index.php?option=com_profiler&view=users', false));
		return true;
	}
	
	public function import() {
		
		// Initialise variables.
		$app		= JFactory::getApplication();
		$context	= "$this->option.import.$this->context";
		
		// Access check.
		if (!$this->allowAdd()) {
			// Set the internal error and also the redirect error.
			$this->setError(JText::_('JLIB_APPLICATION_ERROR_CREATE_RECORD_NOT_PERMITTED'));
			$this->setMessage($this->getError(), 'error');
			$this->setRedirect(JRoute::_('index.php?option='.$this->option.'&view='.$this->view_list.$this->getRedirectToListAppend(), false));

			return false;
		}

		// Clear the record edit information from the session.
		$app->setUserState($context.'.data', null);
		
		$data = JRequest::getVar('profilerform', array(), 'post', 'array');
		if(isset($data['save']) && $data['save']) {
			$app->setUserState($context.'.filter', $data['save']);
		} else {
			$app->setUserState($context.'.filter', null);
		}
		
		// Redirect to the import screen.
		$this->setRedirect(JRoute::_('index.php?option='.$this->option.'&view='.$this->view_item.'&layout=import', false));
		
		return true;

	}
	
	//remove
	public function upload() {
		JSession::checkToken() or jexit(JText::_('JINVALID_TOKEN'));
		
		// Access check.
		if (!$this->allowAdd()) {
			// Set the internal error and also the redirect error.
			$this->setError(JText::_('JLIB_APPLICATION_ERROR_CREATE_RECORD_NOT_PERMITTED'));
			$this->setMessage($this->getError(), 'error');
			$this->setRedirect(JRoute::_('index.php?option='.$this->option.'&view='.$this->view_list.$this->getRedirectToListAppend(), false));

			return false;
		}
		
		
		//set redirect
		$this->setRedirect(JRoute::_('index.php?option=com_profiler&view=users', false));

		require_once JPATH_ADMINISTRATOR . '/components/com_profiler/helpers/import.php';
		
		$upload = new ProfilerHelperImport();
		$upload->setFile();
		$upload->saveUsers();
		
		$message = implode("<br/>", $upload->getMessages());
		$this->setMessage($message, $upload->getMessageType());

		
		
	}

	public function upload2() {
		//JSession::checkToken() or jexit(JText::_('JINVALID_TOKEN'));
		// Access check.
		if (!$this->allowAdd()) {
			// Set the internal error and also the redirect error.
			$this->setError(JText::_('JLIB_APPLICATION_ERROR_CREATE_RECORD_NOT_PERMITTED'));
			$this->setMessage($this->getError(), 'error');
			$this->setRedirect(JRoute::_('index.php?option='.$this->option.'&view='.$this->view_list.$this->getRedirectToListAppend(), false));
	
			return false;
		}
	
		$page = JRequest::getVar('page', null , 'get');
		require_once JPATH_ADMINISTRATOR . '/components/com_profiler/helpers/import.php';
	
	
		switch ($page) {
			case 1:
				$upload = new ProfilerHelperImport(true);
				$return = $upload->setFile();
				if($return) {
					$upload->createTable();
					$upload->saveTable();
					$upload->setMessage("Upload succesfull, upload temporary saved in database table #__profiler_upload");
				}
				break;
	
			default:
				$upload = new ProfilerHelperImport();
				$upload->loadTable($page);
				$upload->saveUsers();
				break;
		}
	
		$upload->saveStat();
	
		if($upload->getPercentage($page) == 100) {
			$upload->deleteTable();
			$upload->clearSession();
		}
	
		$output = array(
				'percentage' => $upload->getPercentage($page),
				'next_page' => JRoute::_('index.php?option=com_profiler&task=user.upload2&page=' . ($page + 1), false),
				'log' => '<li>' . implode("</li><li>", $upload->getMessages()) . '</li>',
				'error' => $upload->getMessageType()
		);
		echo json_encode($output);
		die;
	
	}
	
	public function saveimport() {
		JSession::checkToken() or jexit(JText::_('JINVALID_TOKEN'));
		
		// Access check.
		if (!$this->allowAdd()) {
			// Set the internal error and also the redirect error.
			$this->setError(JText::_('JLIB_APPLICATION_ERROR_CREATE_RECORD_NOT_PERMITTED'));
			$this->setMessage($this->getError(), 'error');
			$this->setRedirect(JRoute::_('index.php?option='.$this->option.'&view='.$this->view_list.$this->getRedirectToListAppend(), false));
		
			return false;
		}
		
		$this->setRedirect(JRoute::_('index.php?option='.$this->option.'&view='.$this->view_item.'&layout=import', false));
		
		$data = JRequest::getVar('jform', array(), 'post', 'array');
		
		if(!$data['name']) {
			$this->setError(JText::_('COM_PROFILER_ERROR_WITHOUT_NAME_NOT_PERMITTED'));
			$this->setMessage($this->getError(), 'error');
			return false;
		}
		
		$updateImport = new stdClass();
		$updateImport->name = $data['name'];
		$updateImport->params = json_encode($data);
		
		
		$db = JFactory::getDbo();
		
		$return = $db->insertObject("#__profiler_import", $updateImport);
		//$query	= $db->getQuery(true);
		
		return true;
		
	}
	
}
