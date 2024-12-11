<?php
/**
 * @package Profiler for Joomla! 2.5
 * @version $Id: user.php 42 2013-04-26 16:03:35Z harold $
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

//jimport('joomla.database.table.user');
//require_once JPATH_LIBRARIES.'/joomla/table/user.php';
require_once JPATH_LIBRARIES.'/joomla/database/table/user.php'; //joomla 25
require_once JPATH_ADMINISTRATOR.'/components/com_profiler/helpers/files.php';

class ProfilerTableUser extends JTableUser
{
	
	protected $_files = array();
	
	protected $_joomlauser;

	function __construct(&$db)
	{
		parent::__construct($db);

		// Set internal variables.
		$fields	= $this->_db->getTableColumns("#__profiler_users", false);

		if (!is_array($fields)) {
			$e = new JException(JText::_('JLIB_DATABASE_ERROR_COLUMNS_NOT_FOUND'));
			$this->setError($e);
			return false;
		}
		
		foreach ($fields as $name => $v)
		{
			// Add the field if it is not already present.
			if (!property_exists($this, $name)) {
				$this->$name = null;
			}
		}
		
	}

	function load($userId = null, $reset = true)
	{
		
		// Load the user data.
		$this->_db->setQuery(
				'SELECT *' .
				' FROM #__profiler_users' .
				' WHERE id = '.(int) $userId
		);
		$data = (array) $this->_db->loadAssoc();
		
		// Check for an error message.
		if ($this->_db->getErrorNum()) {
			$this->setError($this->_db->getErrorMsg());
			return false;
		}
		
		if(!count($data))
		{
			return false;
		}
		
		if($data['userid'] > -1) {
			$return = parent::load($data['userid'], $reset);
			if($return == false) {
				return false;
			}
		} else {
			// Load the user groups.
			$query = $this->_db->getQuery(true);
			$query->select($this->_db->quoteName('g.id'));
			$query->select($this->_db->quoteName('g.title'));
			$query->from($this->_db->quoteName('#__usergroups') . ' AS g');
			$query->join('INNER', $this->_db->quoteName('#__profiler_usergroup_map') . ' AS m ON m.group_id = g.id');
			$query->where($this->_db->quoteName('m.user_id') . ' = ' . (int) $userId);
			$this->_db->setQuery($query);
			
			// Add the groups to the user data.
			$this->groups = $this->_db->loadAssocList('id', 'id');
		}

		// Bind the data to the table.
		$return = $this->bind($data);
		
		
		return $return;
		
	}

	function bind($array, $ignore = '') {
		$return = parent::bind($array, $ignore);
		
		if(isset($array['joomlauser'])) {
			$this->_joomlauser = $array['joomlauser']; 
		} elseif(isset($array['userid']) && $array['userid'] > -1) {
			$this->_joomlauser = true;
		}
		
		
		return $return;
	}
	
	function check() {
		$files = JRequest::getVar('jform', '', 'files', 'array');
		$this->_files = new ProfilerHelperFiles($files, $this->id);
		
		$dispatcher	= JDispatcher::getInstance();
		
		$config = JComponentHelper::getParams('com_profiler');
		$this->lastupdatedate = JFactory::getDate()->toSql();
		if(isset($this->firstname) && isset($this->lastname)) {
			switch($config->get('namestyle')) {
				case "2": //first and lastname
					$this->name = $this->firstname . " " . $this->lastname;
					break;
				case "3": //fist, middle and lastname
					$this->name = $this->firstname; 
					$this->name .= $this->middlename ? " " . $this->middlename : "";
					$this->name .= " " . $this->lastname;
					break;
			}
		}
		
		//auto username
		if(!isset($this->username) && trim($this->name)) {
			$this->username = $this->name;
			
			$this->username = preg_replace("#[<>\"'%;()&]#i", '', $this->username);
			
			// check for existing username
			$query = 'SELECT username FROM #__users WHERE username REGEXP ' . $this->_db->Quote('^'.$this->username.'([1-9]?|[1-9]{1}[0-9]*)$'). ' AND id != '. (int) $this->id;
			$this->_db->setQuery($query);
			$usernamesexist = $this->_db->loadAssocList(null, 'username');
			if(in_array($this->username, $usernamesexist )) {
				for ($i = count($usernamesexist); $i <= count($usernamesexist) + 50; $i++) {
					if(!in_array($this->username . $i, $usernamesexist )) {
						$this->username .= $i;
						break;
					}
				}
			}
		
		}
		
		if($this->_joomlauser || $this->userid > -1) {
			$profiler_id = $this->id;
			$this->id = $this->userid;
			if(!parent::check()) {
				return false;
			}
			$this->id = $profiler_id;
		} else {
			if ($this->id === 0)
			{
				$this->id = null;
			}
			
			$this->userid = -1;
			
			if ($this->email && !JMailHelper::isEmailAddress($this->email))
			{
				$this->setError(JText::_('JLIB_DATABASE_ERROR_VALID_MAIL'));
				return false;
			}
			// Set the registration timestamp
			if (empty($this->registerDate) || $this->registerDate == $this->_db->getNullDate())
			{
				$this->registerDate = JFactory::getDate()->toSql();
			}
			
			// Set the lastvisitDate timestamp
			if (empty($this->lastvisitDate))
			{
				$this->lastvisitDate = $this->_db->getNullDate();
			}
				
		}
		
		$db = JFactory::getDbo();
		$query	= $db->getQuery(true);
		$query->select('a.name, a.title, a.type, a.maxlength, a.minlength, a.regex, a.error, a.forbidden, a.mimeenable, a.extensionsenable, a.cols, a.rows');
		$query->from('#__profiler_fields AS a');
		$query->where('a.extension = "com_profiler" AND (a.table = "#__profiler" OR a.table = "#__users")');
		
		$db->setQuery($query);
		$fields = $db->loadAssocList();
		
		foreach($fields as $field) {
			
			if($field['type'] == "calendar" && !empty($this->$field['name'])) {
				$jdate = new JDate();
				$this->$field['name'] = JFactory::getDate($this->$field['name'])->toSql();
			}
			
			if($field['type'] == "profile" && empty($this->$field['name']) && !$this->id) {
				$this->$field['name'] = array(0 => $config->get('new_usertype'));
			}
			
			if($field['name'] == "registeredby" && !$this->id) {
				$user = JFactory::getUser();
				$this->$field['name'] = $user->name ? $user->name : JText::_("COM_PROFILER_GUEST");
			}

			if(strpos($field['type'], ".") !== false) {
				$plugintype = explode('.', $field['type']);
				$field['type'] = $plugintype[0];
				$plugin = $plugintype[1];
			
				JPluginHelper::importPlugin('pffields', 'field' . $plugin);
				$results = $dispatcher->trigger('getPffieldsCheck_'  . $plugin, array(&$this->$field['name']));
				foreach($results as $result) {
					if($result) {
						$this->setError( $result );
						return false;
					}
				}
				//$return = implode("", $result);
			}
			
							
			if((isset($this->$field['name']) && ($field['type'] == "text" || $field['type'] == "textarea" || $field['type'] == "editor" )) || $field['type'] == "file" || $field['type'] == "avatar") {
				if($field['maxlength'] > 0 && strlen(trim($this->$field['name'])) > $field['maxlength']) {
					$this->setError( $field['error'] ? $field['error'] : JText::sprintf('COM_PROFILER_ERROR_WRONG_LENGTH', JText::_($field['title'])) );
					return false;	
				}
				if($field['minlength'] > 0 && strlen(trim($this->$field['name'])) < $field['minlength']) {
					$this->setError( $field['error'] ? $field['error'] : JText::sprintf('COM_PROFILER_ERROR_WRONG_LENGTH', JText::_($field['title'])) );
					return false;	
				}
				if($field['regex'] && !preg_match($field['regex'], $this->$field['name'])) {
					$this->setError(JText::sprintf($field['error'], JText::_($field['title'])));
					return false;	
				}
				if($field['forbidden']) {
					$forbidden = explode (",", $field['forbidden']);
					foreach ($forbidden as $value) {
						if (stristr($value, $forbiddenvalue)) {
							$this->setError(JText::sprintf('COM_PROFILER_ERROR_FORBIDDEN_WORDS', JText::_($field['title'])));
							return false;		
						}
					}
				}
				
				if(($field['type'] == "file" || $field['type'] == "avatar") && $this->id > 0) {
					
					$remove = $_POST['jform'][$field['name'].'_remove'];
					if($remove == "remove") {
						$this->_files->setRemove($field['name']);
						$this->$field['name'] = "";
					}
					
					if($this->_files->isUploadFile($field['name'])) {
						if($this->_files->getErrors()) {
							$this->setError($this->_files->getErrors(), $field['name']);
							return false;			
						}
					
						//check mime type
						if(!$this->_files->checkMime($field['name'], $field['mimeenable'])) {
							$this->setError(JText::_('COM_PROFILER_ERROR_FORBIDDEN_FILE'), $field['name']);
							return false;
						}
					
						if(!$this->_files->checkExtension($field['name'], $field['extensionsenable'])) {
							$this->setError(JText::_('COM_PROFILER_ERROR_FORBIDDEN_FILE'), $field['name']);
							return false;
						}
	
						if(!$this->_files->checkFilesize($field['name'])) {
							$this->setError(JText::_('COM_PROFILER_ERROR_MAXFILESIZE'), $field['name']);
							return false;
						}
					
					
						//resize image
						if($field['type'] == "avatar" && !$this->_files->imageResize($field['name'], $field['cols'], $field['rows']) && $config->get('resizeimages') == true) {
							$this->setError(JText::_('COM_PROFILER_ERROR_FORBIDDEN_FILE'), $field['name']);
							return false;
						}
					
						$this->$field['name'] = $this->_files->getName($field['name']);
					}
						

				}
				
			}
		}
		return true;
	}
	
	function store($updateNulls = false) {
		$k = $this->_tbl_key;
		$key =  $this->$k;
		$userid = $this->userid;
		$puserid = $this->id;
		$fields	= $this->_db->getTableColumns("#__profiler_users", false);
		$updateProfileUser = new stdClass();
		foreach ($fields as $name => $v)
		{
			// Add the field if it is not already present.
			if (property_exists($this, $name)) {
				if(is_array($this->$name)) {
					$registry = new JRegistry;		
					$registry->loadArray($this->$name);
					$updateProfileUser->$name = $registry->toString();
				} else {
					$updateProfileUser->$name = $this->$name;
				}
				if(!in_array($name, array('id', 'email', 'name', 'registerDate'))) {
					unset($this->$name);
				}
			}
		}

		if($this->_joomlauser || $userid > -1) {
			$this->id = $userid;
			$return = parent::store($updateNulls);
			
			if(!$return) {
				return $return;
			}

			if ($key) {
				$updateProfileUser->userid = $this->id;
				$return2 = $this->_db->updateObject("#__profiler_users", $updateProfileUser, $this->_tbl_key, $updateNulls);
			}
			else {
				$updateProfileUser->userid = $this->id;
				$return2 = $this->_db->insertObject("#__profiler_users", $updateProfileUser, $this->_tbl_key);
			}
			$this->id = $updateProfileUser->id;
			
			// Delete groups from usergroup map
			$query = $this->_db->getQuery(true);
			$query->delete();
			$query->from($this->_db->quoteName('#__profiler_usergroup_map'));
			$query->where($this->_db->quoteName('user_id') . ' = ' . (int) $this->id);
			$this->_db->setQuery($query);
			$this->_db->execute();
			
		} else {
			$return = true;
			if($this->id) {
				$return2 = $this->_db->updateObject("#__profiler_users", $updateProfileUser, 'id', $updateNulls);
			} else {
				$return2 = $this->_db->insertObject("#__profiler_users", $updateProfileUser, 'id');
			}
			$this->id = $updateProfileUser->id;
			
			
			// Store the group data if the user data was saved.
			if (is_array($this->groups) && count($this->groups))
			{
				// Delete the old user group maps.
				$query = $this->_db->getQuery(true);
				$query->delete();
				$query->from($this->_db->quoteName('#__profiler_usergroup_map'));
				$query->where($this->_db->quoteName('user_id') . ' = ' . (int) $this->id);
				$this->_db->setQuery($query);
				$this->_db->execute();
			
				// Set the new user group maps.
				$query->clear();
				$query->insert($this->_db->quoteName('#__profiler_usergroup_map'));
				$query->columns(array($this->_db->quoteName('user_id'), $this->_db->quoteName('group_id')));
			
				// Have to break this up into individual queries for cross-database support.
				foreach ($this->groups as $group)
				{
					$query->clear('values');
					$query->values($this->id . ', ' . $group);
					$this->_db->setQuery($query);
					$this->_db->execute();
				}
			}

		}
		

		if (!$return2)
		{
			$this->setError(JText::sprintf('JLIB_DATABASE_ERROR_STORE_FAILED', strtolower(get_class($this)), $this->_db->getErrorMsg()));
			return false;
		}
		
		if (is_object($this->_files) && !$this->_files->uploadFiles()) {
			$this->setError(implode($this->_files->getErrors));
			return false;
			
		}
		
		return $return;
	}
	
	function delete($userId = null, $joomlaonly = false) {
		
		
		$juserid = $this->userid;
		
		if($joomlaonly == true) {
			$this->userid = -1;
			$this->_joomlauser = false;
			$this->store();
		}
		
		//$juserid = $this->loadJoomlauserID($userId);
		$return = true;
		if($juserid > -1) {
			$return = parent::delete($juserid);
		}
		
		if($joomlaonly == false) {
			$k = $this->_tbl_key;
			if ($userId) {
				$this->$k = intval($userId);
			}
	
			$this->_db->setQuery(
				'DELETE FROM `#__profiler_users`' .
				' WHERE `id` = '.(int) $this->$k
			);
			$this->_db->query();

			if ($this->_db->getErrorNum()) {
				$this->setError($this->_db->getErrorMsg());
				return false;
			}
			
			$this->_db->setQuery(
					'DELETE FROM `#__profiler_usergroup_map`' .
					' WHERE `user_id` = '.(int) $this->$k
			);
			$this->_db->query();
			
			if ($this->_db->getErrorNum()) {
				$this->setError($this->_db->getErrorMsg());
				return false;
			}
				
		}
		return $return;
		
	}
	
	
	//@todo: is dit nodig?
	function loadJoomlauserID($userId) {
		$query = $this->_db->getQuery(true);
		$query->select($this->_db->quoteName('userid'));
		$query->from($this->_db->quoteName('#__profiler_users'));
		$query->where($this->_db->quoteName('id') . ' = ' . (int) $userId);
		$this->_db->setQuery($query);
		return $this->_db->loadResult();
	}
	
}
