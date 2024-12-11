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
// No direct access
defined('_JEXEC') or die;

class ProfilerHelperImport {
	
	protected $importtype = 0; //csv
	protected $delimiter = ";";
	protected $enclosure = "";
	protected $synchronize = false;
	protected $synchronizefield = "";
	protected $newuserid = false;
	protected $password = 2;
	protected $multiple = array();
	
	protected $titlerow = array();
	protected $titlerowdb = array();
	protected $uploaddata = array();
	protected $rowcount = 0;
	protected $ignorecolumn = array();
	
	protected $uploadstat = array();
	
	protected $_messages = array();
	protected $_messagetype = "";
	
	public function __construct($post = false)
	{
		$session = JFactory::getSession();
		if($post) {
			$data = JRequest::getVar('jform', array(), 'post', 'array');
			$this->importtype = $data['type'];
			$this->delimiter = $data['delimiter'];
			$this->enclosure = $data['enclosure'] == "" ? '"' : $data['enclosure'];
			$this->synchronize = isset($data['synchronize']) ? $data['synchronize'] : false;
			$this->synchronizefield = $data['synchronizefield'] ? $data['synchronizefield'] : "id";
			$this->newuserid = isset($data['newuserid']) ? $data['newuserid'] : false;
			//$this->password = $data['password'];
			$this->multiple = explode(",", $data['multiple']);
			$session->set('upload', get_object_vars($this), 'profiler');
			
		} else {
			$this->uploadstat = $session->get('uploadstat', array(), 'profiler');
			$data = $session->get('upload', array(), 'profiler');
			$this->importtype = $data['importtype'];
			$this->delimiter = $data['delimiter'];
			$this->enclosure = $data['enclosure'] == "" ? '"' : $data['enclosure'];
			$this->synchronize = isset($data['synchronize']) ? $data['synchronize'] : false;
			$this->synchronizefield = $data['synchronizefield'] ? $data['synchronizefield'] : "id";
			$this->newuserid = isset($data['newuserid']) ? $data['newuserid'] : false;
			//$this->password = $data['password'];
			$this->multiple = $data['multiple'];
		}
		
	}
	
	public function clearSession() {
		$session = JFactory::getSession();
		$session->clear('upload', 'profiler');
	}
	
	public function setFile() {
		$file = JRequest::getVar('jform', array(), 'files', 'array');

		if(!file_exists($file['tmp_name']['file'])) {
			$this->setMessage(JText::_("COM_PROFILER_ERROR_FILEDONTEXISTS"));
			$this->setMessagetype("error");
			return false;
		}
		if($this->synchronize == true && !$this->synchronizefield) {
			$this->setMessage(JText::_("COM_PROFILER_ERROR_UNIQUEFIELD"));
			$this->setMessagetype("error");
			return false;
		}
		
		switch ($this->importtype) {
			case 0: //csv
				$return = $this->upload_csv($file);
				break;
				
			case 1: //xml
				$return = $this->upload_xml();
				break;
			
		}
		
		return $return;
	}

	public function saveUsers() {
		if($this->synchronize == 1) {
			$this->usersSynchronize(false);
		} elseif($this->synchronize == 2) {
			$this->usersSynchronize(true);
		} else {
			$this->usersNew();
		}
	}
	
	public function utf8_fopen_read($fileName) {
		//$fc = iconv('windows-1250', 'utf-8', file_get_contents($fileName));
		//$fc = mb_convert_encoding(file_get_contents($fileName), 'UTF-8', mb_detect_encoding(file_get_contents($fileName)));
		$fc = utf8_encode(file_get_contents($fileName));
		$handle=fopen("php://memory", "rw");
		fwrite($handle, $fc);
		fseek($handle, 0);
		return $handle;
	}

	public function upload_csv($file) {
		$data = JRequest::getVar('jform', array(), 'post', 'array');
		$csvfile = $this->utf8_fopen_read($file['tmp_name']['file']); //fopen($file['tmp_name']['file'], "r");
		if(!$csvfile) {
			$this->setMessage(JText::_("COM_PROFILER_ERROR_ERRORFILE"));
			$this->setMessagetype("error");
			return false;
		}
		if(!filesize($file['tmp_name']['file'])) {
			$this->setMessage(JText::_("COM_PROFILER_ERROR_EMPTYFILE"));
			$this->setMessagetype("error");
			return false;
		}
		
		
		
		$lines = 0;
		while(($line = fgetcsv($csvfile, 10000, $this->delimiter, $this->enclosure)) !== FALSE) {
			$lines++;
			//$line = trim($line, " \t");
			//$line = str_replace("\n", "", $line);
			if($lines == 1) {
				$column = 0;
				$this->titlerow = $line;
				$this->rowcount = count($this->titlerow);
				
				//rename titles and check titles
				foreach($this->titlerow as $title) {
					if($key = array_search($title, $data['renamefield'])) {
						$this->titlerowdb[$title] = $key;
					} elseif (array_key_exists($title, $data['renamefield'])) {
						$this->titlerowdb[$title] = $title;
					} else {
						$this->ignorecolumn[] = $column;
						//$this->setMessage(JText::_("COM_PROFILER_ERROR_CORRUPTFIELD") . $title);
						//return false;
					}
					$column++;
				}			
				
			} else {
				if(count($line) == $this->rowcount) {
					foreach($this->ignorecolumn as $ignore) {
						unset($line[$ignore]);
					}
					$array = array_combine($this->titlerowdb, $line);
					$key = (isset($array[$this->synchronizefield]) && $array[$this->synchronizefield] > 0) ? $array[$this->synchronizefield] : "new".$this->synchronizefield."_".$lines;

					foreach ($this->multiple as $multiplefield) {
						if(isset($array[trim($multiplefield)])) {
							$array[trim($multiplefield)] = explode(",", trim($array[trim($multiplefield)]));
						}
					}
					
					$this->uploaddata[$key] = $array;
					unset($array);
					//eventuele aanpassingen of bewerkingen van de uploaddata
				} elseif ($line) {
					//error te veel of te weinig fields, rij overslaan
					$this->setMessage(JText::_("COM_PROFILER_ERROR_CORRUPTLINE") . $lines);
				}
			}
		}
		
		fclose($csvfile);
		JRequest::setVar('jform', array(), 'files', true);
		
		
		$this->uploadstat['count'] = count($this->uploaddata);

		
		return true;
	}
	
	public function upload_xml() {
		$this->setMessage("XML not supported");
		$this->setMessagetype("error");
		return false;
	}
	
	public function createTable() {
		$db = JFactory::getDbo();
		$query = "CREATE TABLE IF NOT EXISTS `#__profiler_upload` (
  						`id` int(11) NOT NULL AUTO_INCREMENT,
						`key` varchar(100) DEFAULT NULL,
						`pid` int(11) DEFAULT NULL,
  						`userid` int(11) DEFAULT NULL,
  						`firstname` varchar(100) DEFAULT NULL,
  						`middlename` varchar(100) DEFAULT NULL,
  						`lastname` varchar(100) DEFAULT NULL,
  						`name` varchar(255) DEFAULT NULL,
  						`email` varchar(100) DEFAULT NULL,
						`json` text DEFAULT NULL,
  						PRIMARY KEY (`id`)
						) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;";
		$db->setQuery($query);
		$db->query();
	}
	
	public function deleteTable() {
		$db = JFactory::getDbo();
		$query = "DROP TABLE `#__profiler_upload`;";
		$db->setQuery($query);
		$db->query();
	}
	
	public function saveTable() {
		$db = JFactory::getDbo();
		foreach($this->uploaddata AS $syncid => $user) {
			$saveTable = new stdClass();
			$saveTable->key = $syncid;
			$saveTable->pid = isset($user['id']) ? $user['id'] : NULL;
			$saveTable->userid = isset($user['userid']) ? $user['userid'] : NULL;
			$saveTable->firstname = isset($user['firstname']) ? $user['firstname'] : NULL;
			$saveTable->middlename = isset($user['middlename']) ? $user['middlename'] : NULL;
			$saveTable->lastname = isset($user['lastname']) ? $user['lastname'] : NULL;
			$saveTable->name = isset($user['name']) ? $user['name'] : NULL;
			$saveTable->email = isset($user['email']) ? $user['email'] : NULL;
			$saveTable->json = json_encode($user);
			$return = $db->insertObject("#__profiler_upload", $saveTable);
		}
	}
	
	public function loadTable($start, $return = false) {
		$db = JFactory::getDbo();
		
		$query	= $db->getQuery(true);
		$query->select("u.*");
		$query->from('`#__profiler_upload` AS u');
		if(!$return) {
			$db->setQuery($query, ($start - 2), 1);
		} else {
			$db->setQuery($query);
			$allsync = array();
		}
		
		$uploaddata = $db->loadAssocList('key');		
		foreach($uploaddata AS $syncid => $user) {
			if(!$return) {
				$this->uploaddata[$syncid] = json_decode($user['json'], true);
			} else {
				$allsync[$syncid] = json_decode($user['json'], true);
			}
		}
		
		if($return) {
			return $allsync;
		}
	}

	public function usersNew() {
		foreach($this->uploaddata as $user) {
			 $this->addUser($user);
		}
	}
	
	public function usersSynchronize($full = false) {
		//array ophalen database en vergelijken
		$db = JFactory::getDbo();
		$query	= $db->getQuery(true);
		$query->select("u.*, p.*");
		$query->from('`#__profiler_users` AS p');
		$query->join('LEFT', '#__users AS u ON p.userid = u.id');
		$db->setQuery($query);
		$olddata = $db->loadAssocList($this->synchronizefield);
		//$diff = array_diff_key($olddata, $this->uploaddata);
		
		if($full == true && !isset($this->uploadstat['delete']['done'])) {
			$newdata = $this->loadTable(null, true);
			$diff = array_diff_key($olddata, $newdata);
			$this->uploadstat['delete']['count'] = 0;
			foreach($diff as $delete => $deleteid) {
				if($deleteid > 0) {
					$this->deleteUser($deleteid);
					$this->uploadstat['delete']['count']++;
				}	
			}
			$this->uploadstat['delete']['done'] = true;
			$this->setMessage("Delete sync users (" . $this->uploadstat['delete']['count'] . ")");
		}
		
		foreach($this->uploaddata AS $syncid => $user) {
			if(isset($olddata[$syncid])) {
				$differents[$syncid] = array_diff_assoc($user, $olddata[$syncid]);
				$differents[$syncid]['id'] = $olddata[$syncid]['id'];
				$differents[$syncid]['userid'] = $olddata[$syncid]['userid'];
				
				if(isset($differents[$syncid]['firstname']) || isset($differents[$syncid]['middlename']) || isset($differents[$syncid]['lastname'])) {
					$differents[$syncid]['firstname'] = isset($differents[$syncid]['firstname']) ? $differents[$syncid]['firstname'] : $olddata[$syncid]['firstname'];
					$differents[$syncid]['middlename'] = isset($differents[$syncid]['middlename']) ? $differents[$syncid]['middlename'] : $olddata[$syncid]['middlename'];
					$differents[$syncid]['lastname'] = isset($differents[$syncid]['lastname']) ? $differents[$syncid]['lastname'] : $olddata[$syncid]['lastname'];
				}
			} else {
				$differents[$syncid] = $user;
			}
		}
		
		foreach($differents as $different) {
			if( count($different) > 2) {
				if(isset($different[$this->synchronizefield]) ) {
					$this->addUser($different);
				} else {
					$this->addUser($different, true);
				}
			}
		}
		
	}
		
	public function addUser($data, $sync = false) {
		
		$dispatcher	= JDispatcher::getInstance();
		JPluginHelper::importPlugin('profiler');
		$result = $dispatcher->trigger('onProfilerUserBeforeValidate', array(&$data));
		
		
		$model	= $this->getModel();
		
		
		
		$form = $model->getForm($data, false, false);
		if (!$form) {
			$this->setMessage($model->getError());
			$this->setMessagetype("warning");
			return false;
		}
		$validData = $model->validate($form, $data);
		
		if ($validData === false) {
			$errors	= $model->getErrors();
			$this->setMessage(JText::_("COM_PROFILER_ERROR_VALIDATION") . $data[($this->synchronizefield ? $this->synchronizefield : 'name')] . ":");
			// Push up to three validation messages out to the user.
			for ($i = 0, $n = count($errors); $i < $n && $i < 3; $i++) {
				if (JError::isError($errors[$i])) {
					$this->setMessage(" -$i- " . $errors[$i]->getMessage());
					$this->setMessagetype("warning");
					return false;
				} else {
					$this->setMessage(" -$i- " . $errors[$i]);
					$this->setMessagetype("warning");
					return false;
				}
			}
		} else {
			if($sync) {
				$validData['id'] = (int) $data['id'];
			}
			//	$model->setState('user.id', 0);
			//}
			if(isset($data['registeripaddr']))
				$validData['registeripaddr'] = $data['registeripaddr']; 
			if(isset($data['activation']))
				$validData['activation'] = $data['activation'];
			if(isset($data['params']))
				$validData['params'] = $data['params'];
	
			
			if (!$model->save($validData)) {
				//save error
				$this->setMessage(JText::_("COM_PROFILER_ERROR_SAVEERRORS") . $data[($this->synchronizefield ? $this->synchronizefield : 'name')] . ":");
				$this->setMessage(" - " . $model->getError());
				$this->setMessagetype("warning");
				return false;
			} else {
				$this->setMessage('Store succeeded '.$validData['id']);
				return true;	
			}
		}
	}
	
	public function deleteUser($userid)
	{
		$model	= $this->getModel();
		$model->delete($userid);
		if ($model->delete($userid)) {
			//$this->setMessage(JText::plural($this->text_prefix . '_N_ITEMS_DELETED', count($cid)));
		} else {
			//$this->setMessage($model->getError());
		}
		
	}

	
	public function getModel($name = 'user', $prefix = 'ProfilerModel', $config = array('ignore_request' => true)) {
		$result = JModelLegacy::getInstance($name, $prefix, $config);
		return $result;
	}

	public function setMessage($message)
	{
		array_push($this->_messages, $message);
	}
	
	public function setMessagetype($type) {
		$this->_messagetype = $type;
	}
	
	public function getMessages()
	{
		return $this->_messages;
	}

	public function getMessageType()
	{
		return $this->_messagetype;
	}
	
	
	public function getMessage($i = null, $toString = true)
	{
		// Find the error
		if ($i === null)
		{
			// Default, return the last message
			$message = end($this->_messages);
		}
		elseif (!array_key_exists($i, $this->_messages))
		{
			// If $i has been specified but does not exist, return false
			return false;
		}
		else
		{
			$message = $this->_messages[$i];
		}

		// Check if only the string is requested
		if ($message instanceof Exception && $toString)
		{
			return (string) $message;
		}

		return $message;
	}
	
	public function getPercentage($count) {
		return ($count / ($this->uploadstat['count'] + 1) * 100);
	}
	
	public function saveStat() {
		$session = JFactory::getSession();
		$session->set('uploadstat', $this->uploadstat, 'profiler');
	}
}
