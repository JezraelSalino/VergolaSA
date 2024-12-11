<?php
/**
 * @package Profiler for Joomla! 2.5
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

require_once JPATH_ADMINISTRATOR . '/components/com_pffields/helpers/form.php';
require_once JPATH_ADMINISTRATOR . '/components/com_pffields/helpers/pffields.php';

class ProfilerModelUser extends JModelAdmin
{
	
	//private static $multiplefields = array();

	
	public function getTable($type = 'User', $prefix = 'ProfilerTable', $config = array())
	{
		$table = JTable::getInstance($type, $prefix, $config);
		return $table;
	}

	public function getItem($pk = null)
	{
		$app	= JFactory::getApplication();
		
		$pk	= (!empty($pk)) ? $pk : (int) $this->getState($this->getName().'.id');
		
		if ($app->isSite()) {
			$this->setHits($pk);
		}
				
		$result = parent::getItem($pk);

		// Get the dispatcher and load the users plugins.
		$dispatcher	= JDispatcher::getInstance();
		JPluginHelper::importPlugin('user');

		// Trigger the data preparation event.
		$results = $dispatcher->trigger('onContentPrepareData', array('com_profiler.user', $result));

		return $result;
	}

	public function getForm($data = array(), $loadData = true, $acl = true)
	{
		// Initialise variables.
		$app	= JFactory::getApplication();
		$config = JComponentHelper::getParams('com_profiler');
		$readonlyfield = false;
		$userId = (!empty($data['id'])) ? $data['id'] : (int)$this->getState($this->getName().'.id');
		$meId = $this->loadProfileruserID(JFactory::getUser()->id);
		
		if ($app->isSite()) {
			$readonlyfield = true;			
		}
		
		// Get the form.
		$form = $this->loadForm('com_profiler.user', 'user', array('control' => 'jform', 'load_data' => $loadData));
		if (empty($form)) {
			return false;
		}
		
		$data = $this->loadFormData();
		
		// Get fields Profiler Fields
		$pffieldshelperform	= PffieldsHelperForm::getInstance();
		$pffieldshelperform->setDefaultValues($meId, $userId);
		$formxml = $pffieldshelperform->getForm('com_profiler', $form, $data, $readonlyfield, $acl);
		
		if (empty($formxml)) {
			return false;
		}
		
		$data = $this->loadFormData($pffieldshelperform->getMultiplefields());
		

		
		if ($app->isSite() && !($config->get('captcha') === 0 || $config->get('captcha') === "0") && !$userId && !$meId) {
			$form->setField(new JXMLElement('<fieldset name="captcha" alias="captcha" type="category" label="COM_PROFILER_CAPTCHA"><field name="captcha" type="captcha" label="COM_PROFILER_CAPTCHA" description="COM_PROFILER_CAPTCHA"	validate="captcha"/></fieldset>'));
		}
				
				
		$this->preprocessForm($form, $data);
		$form->bind($data);
	

		switch($config->get('namestyle')) {
			case "1": //single name
				$form->removeField('firstname');
				$form->removeField('middlename');
				$form->removeField('lastname');
				break;
			case "2": //first and lastname
				$form->removeField('middlename');
			case "3": //fist, middle and lastname
				$form->removeField('name');
				break;
		}
		
		if ($config->get('allowNonJoomlaUsers') == false) {
			$form->removeField('userid');
		}
		
		return $form;
	}
	
	public function getFormUpload($data = array(), $loadData = false)
	{
	
		// Get the form.
		$form = $this->loadForm('com_profiler.userupload', 'userupload', array('control' => 'jform', 'load_data' => $loadData));
		if (empty($form)) {
			return false;
		}
		
		// Get the data.
		//$data = JRequest::getVar('profilerform', array(), 'post', 'array');
		$filter = JFactory::getApplication()->getUserState('com_profiler.import.user.filter', array());
				
		if($filter) {
			$query	= $this->_db->getQuery(true);
			$query->select("i.*");
			$query->from('`#__profiler_import` AS i');
			$query->where($this->_db->quoteName('i.name') . ' = "' . $filter . '"');
			$this->_db->setQuery($query);
			$decodevalue = $this->_db->loadAssoc();
			
			$values = json_decode($decodevalue['params']);
			
			$form->bind($values);
				
			
		}
		
		
		return $form;
	}

	protected function loadFormData($multiple = array())
	{
		$postdata = JFactory::getApplication()->getUserState('com_profiler.edit.user.data', array());

		$data = $this->getItem();	
		if (!empty($postdata)) {
			foreach($postdata as $field => $value) {
				$data->$field = $value;
			}
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

	protected function preprocessForm(JForm $form, $data, $group = 'user')
	{
		parent::preprocessForm($form, $data, $group);
	}

	public function save($data)
	{
		// Initialise variables;
		$dispatcher	= JDispatcher::getInstance();
		$puser		= (!empty($data['id'])) ? $data['id'] : (int) $this->getState('user.id');
		$juser		= $data['userid'] == -1 ? 0 : $data['userid']; //(!empty($data['userid'])) ? $data['userid'] : (int) $this->getState('user.userid');// hier gaat iets fout
		$user		= new JUser();
		$table		= $user->getTable('user', 'JTable');
		$user		= new JUser($juser);
		$table		= $user->getTable('user', 'ProfilerTable');
		$params 	= JComponentHelper::getParams('com_profiler');

		JPluginHelper::importPlugin('profiler');
		$my = JFactory::getUser();

		if (isset($data['block']) && $data['block'] && $juser == $my->id && !$my->block) {
			$this->setError(JText::_('COM_PROFILER_USERS_ERROR_CANNOT_BLOCK_SELF'));
			return false;
		}
		
		// Check if the user needs to activate their account.
		$useractivation = $params->get('useractivation');
		if (!$juser && (($useractivation == 1) || ($useractivation == 2) || ($useractivation == 3))) {
			jimport('joomla.user.helper');
			if(!isset($data['activation'])) {
				$data['activation'] = JApplication::getHash(JUserHelper::genRandomPassword());
			}
			if(!isset($data['block'])) {
				$data['block'] = 1;
			}
		}
		
		// Load protected usergroups
		$olduser = $this->getItem($puser);
		$access = ProfilerHelperAccess::getInstance();
		$groups = $access->getRegisterUserGroups(true);
		if(is_array($olduser->groups) || is_object($olduser->groups)) {
			foreach ($olduser->groups as $id => $value) {
				if(!is_array($value)) {
					if(!in_array($value, $groups)) {
						$data['groups'][] = $value;
					}
				}
			}
		}
		
		// Make sure that we are not removing ourself from Super Admin group
		$iAmSuperAdmin = $my->authorise('core.admin');
		if ($iAmSuperAdmin && $my->get('id') == $juser) {
			// Check that at least one of our new groups is Super Admin
			$stillSuperAdmin = false;
			$myNewGroups = $data['groups'];
			foreach ($myNewGroups as $group) {
				$stillSuperAdmin = ($stillSuperAdmin) ? ($stillSuperAdmin) : JAccess::checkGroup($group, 'core.admin');
			}
			if (!$stillSuperAdmin) {
				$this->setError(JText::_('COM_PROFILER_USERS_ERROR_CANNOT_DEMOTE_SELF'));
				return false;
			}
		}

		// Bind the data.
		if (!$user->bind($data, "joomlauser")) {
			$this->setError($user->getError());
			return false;
		}

		
		
		$result = $dispatcher->trigger('onProfilerUserBeforeSave', array($olduser, &$user));
	
		// Store the data.
		if (!$user->save()) {
			$this->setError($user->getError());
			return false;
		}
	
		$this->setState('user.id', $user->id);
		
		$result = $dispatcher->trigger('onProfilerUserAfterSave', array($olduser, $user));

		// Email
		if (!$puser && $params->get('enableemail') == true) {
			if($useractivation == 0)
				$this->handleEmail($user->getProperties(), "activated");
			elseif($useractivation == 1 || $useractivation == 2)
				$this->handleEmail($user->getProperties(), "activate");
			elseif($useractivation == 3)
				$this->handleEmail($user->getProperties(), "approve");
		}
		
		if (!$puser && $useractivation == 1)
			return "useractivate";
		else if (!$puser && $useractivation == 2)
			return "adminactivate";
		else if (!$puser)
			return "usernew";
		else 
			return true;
		
		return true;
	}

	function block(&$pks, $value = 1)
	{
		// Initialise variables.
		$app		= JFactory::getApplication();
		$dispatcher	= JDispatcher::getInstance();
		$user		= JFactory::getUser();
        // Check if I am a Super Admin
		$iAmSuperAdmin	= $user->authorise('core.admin');
		$table		= $this->getTable();
		$pks		= (array) $pks;
		$juserid = 0;
		JPluginHelper::importPlugin('user');

		// Access checks.
		foreach ($pks as $i => $pk)
		{
			$loadresult = $table->load($pk);
			$juserid = $table->userid;
			if ($juserid == -1) {
				unset($pks[$i]);
				continue;
			}
			
			if ($value == 1 && $table->userid == $user->get('id')) {
				// Cannot block yourself.
				unset($pks[$i]);
				JError::raiseWarning(403, JText::_('COM_PROFILER_USERS_ERROR_CANNOT_BLOCK_SELF'));

			}
			else if ($loadresult) {
				$old	= $table->getProperties();
				$allow	= $user->authorise('core.edit.state', 'com_profiler');
				// Don't allow non-super-admin to delete a super admin
				$allow = (!$iAmSuperAdmin && JAccess::check($table->userid, 'core.admin')) ? false : $allow;

				// Prepare the logout options.
				$options = array(
					'clientid' => array(0, 1)
				);

				if ($allow) {
					// Skip changing of same state
					if ($table->block == $value) {
						unset($pks[$i]);
						continue;
					}

					$table->block = (int) $value;

					// Allow an exception to be thrown.
					try
					{
						if (!$table->check()) {
							$this->setError($table->getError());
							return false;
						}

						// Trigger the onUserBeforeSave event.
						$result = $dispatcher->trigger('onUserBeforeSave', array($old, false));
						if (in_array(false, $result, true)) {
							// Plugin will have to raise it's own error or throw an exception.
							return false;
						}

						// Store the table.
						if (!$table->store()) {
							$this->setError($table->getError());
							return false;
						}
						
						$table		= $this->getTable();

						// Trigger the onAftereStoreUser event
						$dispatcher->trigger('onUserAfterSave', array($table->getProperties(), false, true, null));
					}
					catch (Exception $e)
					{
						$this->setError($e->getMessage());

						return false;
					}

					// Log the user out.
					if ($value) {
						$app->logout($juserid, $options);
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
	
	function activate(&$pks)
	{
		// Initialise variables.
		$dispatcher	= JDispatcher::getInstance();
		$user		= JFactory::getUser();
        // Check if I am a Super Admin
		$iAmSuperAdmin	= $user->authorise('core.admin');
		$table		= $this->getTable();
		$pks		= (array) $pks;

		// Access checks.
		foreach ($pks as $i => $pk)
		{
			if ($table->load($pk)) {
				if($table->userid == -1) {
					unset($pks[$i]);
					continue;
				}
				
				$old	= $table->getProperties();
				$allow	= $user->authorise('core.edit.state', 'com_profiler');
				// Don't allow non-super-admin to delete a super admin
				$allow = (!$iAmSuperAdmin && JAccess::check($table->userid, 'core.admin')) ? false : $allow;

				if (empty($table->activation)) {
					// Ignore activated accounts.
					unset($pks[$i]);
				}
				else if ($allow) {
					$table->block		= 0;
					$table->activation	= '';

					// Allow an exception to be thrown.
					try
					{
						if (!$table->check()) {
							$this->setError($table->getError());
							return false;
						}

						// Trigger the onUserBeforeSave event.
						$result = $dispatcher->trigger('onUserBeforeSave', array($old, false));
						if (in_array(false, $result, true)) {
							// Plugin will have to raise it's own error or throw an exception.
							return false;
						}

						// Store the table.
						if (!$table->store()) {
							$this->setError($table->getError());
							return false;
						}
						$table		= $this->getTable();

						// Fire the onAftereStoreUser event
						$dispatcher->trigger('onUserAfterSave', array($table->getProperties(), false, true, null));
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
	
	public function siteactivate($token)
	{
		$params 	= JComponentHelper::getParams('com_profiler');
		$config	= JFactory::getConfig();
		$userParams	= JComponentHelper::getParams('com_profiler');
		$db		= $this->getDbo();

		// Get the user id based on the token.
		$db->setQuery(
			'SELECT '.$db->quoteName('id').' FROM '.$db->quoteName('#__users') .
			' WHERE '.$db->quoteName('activation').' = '.$db->Quote($token) .
			' AND '.$db->quoteName('block').' = 1' .
			' AND '.$db->quoteName('lastvisitDate').' = '.$db->Quote($db->getNullDate())
		);
		$userId = (int) $db->loadResult();

		// Check for a valid user id.
		if (!$userId) {
			$this->setError(JText::_('COM_PROFILER_ACTIVATION_TOKEN_NOT_FOUND'));
			return false;
		}

		// Load the users plugin group.
		JPluginHelper::importPlugin('user');

		// Activate the user.
		$user = JFactory::getUser($userId);

		// Admin activation is on and admin (only) is verifying their email
		if ($userParams->get('useractivation') == 3) {
			$user->set('activation', '');
			$user->set('block', '0');
			if ($params->get('enableemail') == true)
				$this->handleEmail($user->getProperties(), "approved");
		}
		// Admin activation is on and user is verifying their email
		elseif (($userParams->get('useractivation') == 2) && !$user->getParam('activate', 0))
		{
			$user->set('activation', JApplication::getHash(JUserHelper::genRandomPassword()));
			$user->setParam('activate', 1);
			if ($params->get('enableemail') == true)
				$this->handleEmail($user->getProperties(), "approve");

		}

		//Admin activation is on and admin is activating the account
		elseif (($userParams->get('useractivation') == 2) && $user->getParam('activate', 0))
		{
			$user->set('activation', '');
			$user->set('block', '0');
			$user->setParam('activate', 0);
			if ($params->get('enableemail') == true)
				$this->handleEmail($user->getProperties(), "approved");
			

		}
		else
		{
			$user->set('activation', '');
			$user->set('block', '0');
			
			if ($params->get('enableemail') == true)
				$this->handleEmail($user->getProperties(), "approved");
			
		}

		// Store the user object.
		if (!$user->save()) {
			$this->setError(JText::sprintf('COM_USERS_REGISTRATION_ACTIVATION_SAVE_FAILED', $user->getError()));
			return false;
		}

		return $user;
	}

	function approve(&$pks, $value = 0)
	{
		//@todo
		return true;
	}
	
	public function changeJoomla(&$pks)
	{
		$app		= JFactory::getApplication();
		$user	= JFactory::getUser();
		$table	= $this->getTable();
		$pks	= (array) $pks;
		$dispatcher	= JDispatcher::getInstance();
		JPluginHelper::importPlugin('user');
		
		$iAmSuperAdmin	= $user->authorise('core.admin');
		
		foreach ($pks as $i => $pk)
		{
			if ($loadresult = $table->load($pk)) {
								
				$juserid = $table->userid;
				if ($juserid > 0) {
					unset($pks[$i]);
					continue;
				}
				
			
				// Access checks.
				$allow = $user->authorise('core.edit.state', 'com_profiler');
				// Don't allow non-super-admin to delete a super admin
				$allow = (!$iAmSuperAdmin && JAccess::check($table->userid, 'core.admin')) ? false : $allow;
				
				$options = array(
						'clientid' => array(0, 1)
				);
				
				if ($table->userid == $user->get('id')) {
					unset($pks[$i]);
					JError::raiseWarning(403, JText::_('COM_PROFILER_USERS_ERROR_CANNOT_CHANGEJOOMLA_SELF'));
				
				}
				elseif ($allow) {
					$old	= $table->getProperties();
					$table->userid = 0;
					
					try
					{
						if (!$table->check()) {
							$this->setError($table->getError());
							return false;
						}

						// Trigger the onUserBeforeSave event.
						$result = $dispatcher->trigger('onUserBeforeSave', array($old, false));
						if (in_array(false, $result, true)) {
							// Plugin will have to raise it's own error or throw an exception.
							return false;
						}

						// Store the table.
						if (!$table->store()) {
							$this->setError($table->getError());
							return false;
						}
						
						$table		= $this->getTable();

						// Trigger the onAftereStoreUser event
						$dispatcher->trigger('onUserAfterSave', array($table->getProperties(), false, true, null));
					}
					catch (Exception $e)
					{
						$this->setError($e->getMessage());

						return false;
					}

					// Log the user out.
					if ($value) {
						$app->logout($juserid, $options);
					}
										
				} else {
					unset($pks[$i]);
					JError::raiseWarning(403, JText::_('COM_PROFILER_ERROR_SAVEUSER_NOT_PERMITTED'));
				}
			}
		}		
		return true;
	}
	
	
	public function delete(&$pks, $joomlaonly = false)
	{
		// Initialise variables.
		$user	= JFactory::getUser();
		$table	= $this->getTable();
		$pks	= (array) $pks;

        // Check if I am a Super Admin
		$iAmSuperAdmin	= $user->authorise('core.admin');

		// Trigger the onUserBeforeSave event.
		JPluginHelper::importPlugin('user');
		$dispatcher = JDispatcher::getInstance();

		// Iterate the items to delete each one.
		foreach ($pks as $i => $pk)
		{
			if ($loadresult = $table->load($pk)) {
				
				$juserid = $table->userid;
				if ($juserid == -1 && $joomlaonly == true) {
					unset($pks[$i]);
					continue;
				}
				
				// Access checks.
				$allow = $user->authorise('core.delete', 'com_profiler');
				// Don't allow non-super-admin to delete a super admin
				$allow = (!$iAmSuperAdmin && JAccess::check($table->userid, 'core.admin')) ? false : $allow;

				if ($user->id === $table->userid) {
					$this->setError(JText::_('COM_PROFILER_USERS_ERROR_CANNOT_DELETE_SELF'));
					return false;
				}
				
				
				if ($allow) {
					if($table->userid > -1) {
						$user_to_delete = JFactory::getUser($table->userid);
					}

					// Fire the onUserBeforeDelete event.
					$dispatcher->trigger('onUserBeforeDelete', array($table->getProperties()));

					if (!$table->delete($pk, $joomlaonly)) {
						$this->setError($table->getError());
						return false;
					} elseif ($table->userid > -1) {
						// Trigger the onUserAfterDelete event.
						$dispatcher->trigger('onUserAfterDelete', array($user_to_delete->getProperties(), true, $this->getError()));
					}
				}
				else {
					// Prune items that you can't change.
					unset($pks[$i]);
					JError::raiseWarning(403, JText::_('JERROR_CORE_DELETE_NOT_PERMITTED'));
				}
			}
			else {
				$this->setError($table->getError());
				return false;
			}
		}

		return true;
	}

	
	public function validate($form, $data, $group = null)
	{
		$params = JComponentHelper::getParams('com_profiler');
		$return = parent::validate($form, $data, $group);
		
		if ($return === false) {
			return false;
		}
		
		if($params->get('JoomlaUsers') == false && $params->get('allowNonJoomlaUsers') == true) {
			$joomlauser = -1;
		} else {
			$joomlauser = 0;
		}
				
		if(!isset($return['userid']))
			$return['userid'] = (isset($data['userid']) && $data['userid']) ? $data['userid'] : $joomlauser;
		
		if(!isset($return['id']))
			$return['id'] = (isset($data['id']) && $data['id']) ? $data['id'] : 0;
			
		$return2 = PffieldsHelper::validate($form, $return, $group, $this);
		
		return $return2;
		
	}
	

	private function handleEmail ($data, $type) {
		$params = JComponentHelper::getParams('com_profiler');
		$config = JFactory::getConfig();

		$data['fromname']	= $params->get('fromname');
		$data['mailfrom']	= $params->get('mailfrom');
		$data['sitename']	= $config->get('sitename');
		$data['siteurl']	= JUri::base();
		
		if (JFactory::getApplication()->isAdmin()) {
			$base = JURI::root();
			$data['link'] = $base.'index.php?option=com_profiler&task=user.activate&token='.$data['activation'];
		} else {
			$uri = JURI::getInstance();
			$base = $uri->toString(array('scheme', 'user', 'pass', 'host', 'port'));
			$data['link'] = $base.JRoute::_('index.php?option=com_profiler&task=user.activate&token='.$data['activation'], false);
		}
						
		switch($type) {
			case "activate":
				//user for email confirmation
				$emailSubject = preg_replace('/\{([a-zA-Z_]+)\}/e', '$data[\'$1\']', $params->get('subjectactivate'));
				$emailBody = preg_replace('/\{([a-zA-Z_]+)\}/e', '$data[\'$1\']', $params->get('emailbodyactivate'));
				$data['sendmail'] = $data['email'];
				break;
			case "approve":
				//user administrator for approve
				$emailSubject = preg_replace('/\{([a-zA-Z_]+)\}/e', '$data[\'$1\']', $params->get('subjectapprove'));
				$emailBody = preg_replace('/\{([a-zA-Z_]+)\}/e', '$data[\'$1\']', $params->get('emailbodyapprove'));
				$data['sendmail'] = $data['mailfrom'];
				break;
			case "approved":
				//account actief
				$emailSubject = preg_replace('/\{([a-zA-Z_]+)\}/e', '$data[\'$1\']', $params->get('subjectapproved'));
				$emailBody = preg_replace('/\{([a-zA-Z_]+)\}/e', '$data[\'$1\']', $params->get('emailbodyapproved'));
				$data['sendmail'] = $data['email'];
				break;
		}
		
		// Send the registration email.
		$mail = JFactory::getMailer();
		$mail->addRecipient($data['sendmail']);
		$mail->addReplyTo(array($data['mailfrom'], $data['fromname']));
		$mail->setSender(array($data['mailfrom'], $data['fromname']));
		$mail->setSubject($emailSubject);
		$mail->setBody($emailBody);
		$sent = $mail->Send();

		// Check for an error.
		if (!($sent instanceof Exception))
		{
			$this->setError(JText::_('COM_PROFILER_REGISTRATION_SEND_MAIL_FAILED'));
			return false;
		}		
	}
	
	public function getMenu() {
		$pffieldshelperform	= PffieldsHelperForm::getInstance();
		return $pffieldshelperform->editispossible;
	}
	
	function loadProfileruserID($userId) {
		static $meId;

		if($meId == false) {
			$query = $this->_db->getQuery(true);
			$query->select($this->_db->quoteName('id'));
			$query->from($this->_db->quoteName('#__profiler_users'));
			$query->where($this->_db->quoteName('userid') . ' = ' . (int) $userId);
			$this->_db->setQuery($query);
			$meId = $this->_db->loadResult();
		}
		
		return $meId;
	}
	
	function setHits($userid) {
		static $gedaan;
		
		
		if ($gedaan == false && $userid > 0 && $userid != $this->loadProfileruserID(JFactory::getUser()->id)) {
			//update points set points = points+1 where uid = 1;
			$query = $this->_db->getQuery(true);
			$query->update($this->_db->quoteName('#__profiler_users'));
			$query->set($this->_db->quoteName('hits') . ' = ' . $this->_db->quoteName('hits') . ' + 1');
			$query->where($this->_db->quoteName('id') . '=' . (int) $userid);
			$this->_db->setQuery($query);
			$this->_db->execute();
			$gedaan = true;
		}
		
	}
	
}
