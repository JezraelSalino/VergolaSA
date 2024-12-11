<?php
/**
 * @package Profiler for Joomla! 2.5
 * @version $Id: script.php 48 2013-06-10 21:36:21Z harold $
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
// No direct access to this file
defined('_JEXEC') or die('Restricted access');
 
class com_profilerInstallerScript
{
	protected $renamecategory_ids = array();
	
	protected $release;
	protected $oldrelease;
	
	function install($parent) 
	{
		$db = &JFactory::getDBO();
		
		//User update
		echo '<p>Synchonize users</p>';
		$query = "SELECT * FROM #__users";
		$db->setQuery($query);
		$users = $db->loadAssocList();
		foreach ($users as $user) {
			$query = "INSERT INTO #__profiler_users (userid , lastname, name, email, registerDate) VALUES ('".$user['id']."', '".$user['name']."', '".$user['name']."', '".$user['email']."', '".$user['registerDate']."');";
			$db->setQuery($query);
			$db->query();
			echo '<tr><td>V</td><td>Add user: '.$user['name'].'</td></tr>';
		}
		echo "</table>";
		
		
	
		echo '<p>' . JText::_('COM_PROFILER_INSTALL_TEXT') . '</p>';
	}
 
	function uninstall($parent) 
	{
		echo '<p>' . JText::_('COM_PROFILER_UNINSTALL_TEXT') . '</p>';
	}
 
	function update($parent) 
	{
		
	  if(version_compare("1.0", $this->oldrelease) > 0) {
		$db = &JFactory::getDBO();
			
		//Category update
		echo '<p>Synchonize categories</p>';
		$query = "SELECT * FROM #__categories WHERE extension='com_pffields'";
		$db->setQuery($query);
		$categories = $db->loadAssocList();
		$ordering = 0;
		foreach ($categories as $category) {
			$ordering++;
			$params = json_decode($category['params'], true);
			$query = "INSERT INTO #__profiler_categories (id , extension, title, alias, ordering, description, template) VALUES (
							'".$category['id']."',
							'com_profiler',
							'".$category['title']."',
							'".$category['alias']."',
							'".$ordering."',
							'".$category['description']."',
							'".$params['position']."'
						   );";
			$db->setQuery($query);
			$db->query();
			if ($db->getErrorNum()) {
				echo $db->getErrorMsg();
			}
		}
			
		//Rights update
		$query = "SELECT params FROM #__extensions WHERE element='com_profiler'";
		$db->setQuery($query);
		$comparams = $db->loadAssoc();
		$params = json_decode($comparams['params'], true);
			
		$query = "SELECT * FROM #__profiler WHERE id = 1";
		$db->setQuery($query);
		$existpro = $db->loadAssoc();
		if(!(isset($existpro['id']) && $existpro['id'] == 1)) {
			$query = "INSERT INTO #__profiler (id, readaccess, access, deleteaccess, registeraccess, accessroprivate, accessprivate) VALUES (
							1,
							'".$params['readaccess']."',
							'".$params['access']."',
							'".$params['deleteaccess']."',
							'".$params['registeraccess']."',
							'".$params['accessroprivate']."',
							'".$params['accessprivate']."'
						   );";
			$db->setQuery($query);
			$db->query();
			if ($db->getErrorNum()) {
				echo $db->getErrorMsg();
			}
				
		}
			
		$query = "SELECT * FROM #__profiler_fieldgroupprofile WHERE profile = 1";
		$db->setQuery($query);
		$existprocat = $db->loadAssocList('catid');
		$query = "";
		foreach($params['profilercategories'] AS $catid => $categories) {
			if(!isset($existprocat[$catid])) {
				if($query) $query .= ", ";
				$query .= "(
							".$catid.",
							1,
							'".(isset($categories['published']) ? $categories['published'] : 0) ."',
							'".(isset($categories['registration']) ? $categories['registration'] : 0) ."',
							'".(isset($categories['readonly']) ? $categories['readonly'] : 0) ."',
							'".$categories['access']."',
							'".$categories['accessro']."',
							'".$categories['accessreg']."',
							'".(isset($categories['accessroprivate']) ? $categories['accessroprivate'] : 0) ."',
							'".(isset($categories['accessprivate']) ? $categories['accessprivate'] : 0) ."'
						   )";
			}
						
		}
		if($query) {
			$query = "INSERT INTO #__profiler_fieldgroupprofile (catid, profile, published, registration, readonly, access, accessro, accessreg, accessroprivate, accessprivate) VALUES " . $query . ";" ;
			$db->setQuery($query);
			$db->query();
		}
		if ($db->getErrorNum()) {
			echo $db->getErrorMsg();
		}
			
		$query = "SELECT * FROM #__profiler_fieldprofile WHERE profile = 1";
		$db->setQuery($query);
		$existprofield = $db->loadAssocList('fieldid');
		$query = "";
		foreach($params['profilerfields'] AS $fieldid => $fields) {
			if(!isset($existprofield[$fieldid])) {
				if($query) $query .= ", ";
				$query .= "(
							".$fieldid.",
							1,
							'".(isset($fields['published']) ? $fields['published'] : 0) ."',
							'".(isset($fields['required']) ? $fields['required'] : 0) ."',
							'".(isset($fields['registration']) ? $fields['registration'] : 0) ."',
							'".(isset($fields['readonly']) ? $fields['readonly'] : 0) ."',
							'".$fields['access']."',
							'".$fields['accessro']."',
							'".$fields['accessreg']."',
							'".(isset($fields['accessroprivate']) ? $fields['accessroprivate'] : 0) ."',
							'".(isset($fields['accessprivate']) ? $fields['accessprivate'] : 0) ."'
						   )";
			}
		}
		if($query) {
			$query = "INSERT INTO #__profiler_fieldprofile (fieldid, profile, published, required, registration, readonly, access, accessro, accessreg, accessroprivate, accessprivate) VALUES " . $query . ";" ;
			$db->setQuery($query);
			$db->query();
		}
		if ($db->getErrorNum()) {
			echo $db->getErrorMsg();
		}
		
	  }
	  echo '<p>' . JText::_('COM_PROFILER_UPDATE_TEXT') . '</p>';
	}
 
	function preflight($type, $parent) 
	{
		$this->release = $parent->get( "manifest" )->version;
		$this->oldrelease = $this->getParam('version');
		
		
		
		echo '<p>' . JText::_('COM_PROFILER_PREFLIGHT_' . $type . '_TEXT') . '</p>';
	}
 
	function postflight($type, $parent) 
	{
		if($type == "install") {
			$db = &JFactory::getDBO();
			
			//load extension id
			$query = "SELECT extension_id FROM #__extensions WHERE element='com_profiler'";
			$db->setQuery($query);
			$id = $db->loadResult();
			
			//save default params
			$query = "UPDATE `#__extensions` SET `params` = ";
			$query .= "'{\"hppasswordconfirm\":\"0\",";
			$query .= "\"allowUserRegistration\":\"1\",\"new_usertype\":\"2\",\"useractivation\":\"0\",\"captcha\":\"0\",";
			$query .= "\"frontend_userparams\":\"0\",\"enable_css\":\"1\",\"namestyle\":\"1\",";
			$query .= "\"datetimedisplay\":\"Y-m-d H:i:s\",\"redirectregister\":\"437\",\"hpdestfolder\":\"profile\",";
			$query .= "\"usefilenameencryption\":\"1\",\"hphash\":\"LUC12v39\",\"hpimagefilesize\":\"2048\",";
			$query .= "\"hpimagemaxwidth\":\"200\",\"hpimagemaxheight\":\"200\",\"resizeimages\":\"1\",";
			$query .= "\"enableemail\":\"0\",\"mailfrom\":\"infoatyoursitedotcom\",\"fromname\":\"Your Name\",";
			$query .= "\"subjectactivate\":\"Welcome to my site\",";
			$query .= "\"emailbodyactivate\":\"Dear {username},\\\\r\\\\n\\\\r\\\\nWelcome to mysite.com. You can now activated your account:\\\\r\\\\n\\\\r\\\\n{link}\\\\r\\\\n\\\\r\\\\nYour site\",";
			$query .= "\"subjectapprove\":\"Approve user\",";
			$query .= "\"emailbodyapprove\":\"Dear Administrator,\\\\r\\\\n\\\\r\\\\nApprove user {username}\\\\r\\\\n\\\\r\\\\n{link}\\\\r\\\\n\\\\r\\\\nYour site\",";
			$query .= "\"subjectapproved\":\"Account on my site activated!\",";
			$query .= "\"emailbodyapproved\":\"Dear {username},\\\\r\\\\n\\\\r\\\\nYour account is activated.\\\\r\\\\n\\\\r\\\\nYour site\"}'";
			$query .= " WHERE `extension_id` = ".$id.";";
			
			$db->setQuery($query);
			$db->query();
		}
		

		echo '<p>' . JText::_('COM_PROFILER_POSTFLIGHT_' . $type . '_TEXT') . '</p>';
	}
	

	function getParam( $name ) {
		$db = JFactory::getDbo();
		$db->setQuery('SELECT manifest_cache FROM #__extensions WHERE name = "com_democompupdate"');
		$manifest = json_decode( $db->loadResult(), true );
		return $manifest[ $name ];
	}
	
}
