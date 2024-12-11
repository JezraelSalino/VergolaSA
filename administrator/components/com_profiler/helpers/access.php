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

class ProfilerHelperAccess {
	
	public $meId = null;
	public $RightsProfiles = array();

	public function __construct()
	{
		$this->meId = JFactory::getUser()->id;
	}
	
	public static function getInstance()
	{
		static $instances;

		if (empty($instances)) {
			$ProfilerHelperAccess = new ProfilerHelperAccess();
			$instances = $ProfilerHelperAccess;
		}

		return $instances;
	}
	
	public function getRight($rights, $rule, $profile, $default)
	{
		$authorisedLevels = JAccess::getAuthorisedViewLevels($this->meId);
		if (empty($this->$rights)) {
			$function = "set".$rights;
			$this->$function();
		}
		
		foreach($this->$rights as $right) {
			if($right[$rule] > 0 && $profile >= $right['lft'] && $profile <= $right['rgt']) {
				return in_array($right[$rule], $authorisedLevels) ? true : false;
			}
		}
		return in_array($default, $authorisedLevels) ? true : false;
		
	}
	
	

	//return array(id) with usergroups where user have access to read
	public function getReadUserGroups()
	{
		$db 		= JFactory::getDbo();
		$config 	= JComponentHelper::getParams('com_profiler');
		$default	= $config->get('readaccess');
		
		$db->setQuery(
			'SELECT a.*, COUNT(DISTINCT b.id) AS level' .
			' FROM #__usergroups AS a' .
			' LEFT JOIN `#__usergroups` AS b ON a.lft > b.lft AND a.rgt < b.rgt' .
			' GROUP BY a.id' .
			' ORDER BY a.lft ASC'
		);
		$groups = $db->loadObjectList();
		$isSuperAdmin = JFactory::getUser()->authorise('core.admin');
		$options = array();
		
		for ($i=0, $n=count($groups); $i < $n; $i++) {
			$item = &$groups[$i];
			if (($isSuperAdmin || (!JAccess::checkGroup($item->id, 'core.admin'))) && $this->getRight("RightsProfiles", "readaccess", $item->lft, $default) ) {
				$options[] = $item->id;
			}
		}

		return $options;
		
	}
	
	//return array(id) with usergroups where user have access to edit
	public function getEditUserGroups()
	{
		$db 		= JFactory::getDbo();
		$config 	= JComponentHelper::getParams('com_profiler');
		$default	= $config->get('access');
		
		$db->setQuery(
			'SELECT a.*, COUNT(DISTINCT b.id) AS level' .
			' FROM #__usergroups AS a' .
			' LEFT JOIN `#__usergroups` AS b ON a.lft > b.lft AND a.rgt < b.rgt' .
			' GROUP BY a.id' .
			' ORDER BY a.lft ASC'
		);
		$groups = $db->loadObjectList();
		$isSuperAdmin = JFactory::getUser()->authorise('core.admin');
		$options = array();
		
		for ($i=0, $n=count($groups); $i < $n; $i++) {
			$item = &$groups[$i];
			if (($isSuperAdmin || (!JAccess::checkGroup($item->id, 'core.admin'))) && $this->getRight("RightsProfiles", "access", $item->lft, $default) ) {
				$options[] = $item->id;
			}
		}

		return $options;
		
	}
	
	public function getDeleteUserGroups()
	{
		$db 		= JFactory::getDbo();
		$config 	= JComponentHelper::getParams('com_profiler');
		$default	= $config->get('access');
		
		$db->setQuery(
			'SELECT a.*, COUNT(DISTINCT b.id) AS level' .
			' FROM #__usergroups AS a' .
			' LEFT JOIN `#__usergroups` AS b ON a.lft > b.lft AND a.rgt < b.rgt' .
			' GROUP BY a.id' .
			' ORDER BY a.lft ASC'
		);
		$groups = $db->loadObjectList();
		$isSuperAdmin = JFactory::getUser()->authorise('core.admin');
		$options = array();
		
		for ($i=0, $n=count($groups); $i < $n; $i++) {
			$item = &$groups[$i];
			if (($isSuperAdmin || (!JAccess::checkGroup($item->id, 'core.admin'))) && $this->getRight("RightsProfiles", "deleteaccess", $item->lft, $default) ) {
				$options[] = $item->id;
			}
		}

		return $options;
		
	}
	
	//return array(title, level and id) with usergroups where user have access to register
	public function getRegisterUserGroups($simplearray = false)
	{
		$db 		= JFactory::getDbo();
		$config 	= JComponentHelper::getParams('com_profiler');
		$default	= $config->get('registeraccess');
		
		$db->setQuery(
			'SELECT a.*, COUNT(DISTINCT b.id) AS level' .
			' FROM #__usergroups AS a' .
			' LEFT JOIN `#__usergroups` AS b ON a.lft > b.lft AND a.rgt < b.rgt' .
			' GROUP BY a.id' .
			' ORDER BY a.lft ASC'
		);
		$groups = $db->loadObjectList();
		$isSuperAdmin = JFactory::getUser()->authorise('core.admin');
		$options = array();
		
		for ($i=0, $n=count($groups); $i < $n; $i++) {
			$item = &$groups[$i];
			if (($isSuperAdmin || (!JAccess::checkGroup($item->id, 'core.admin'))) && $this->getRight("RightsProfiles", "registeraccess", $item->lft, $default) ) {
				if($simplearray) {
					$options[] = $item->id;
				} else {
					$options[] = array('title'=>$item->title,'level'=>$item->level,'id'=>$item->id);
				}
			}
		}

		return $options;
		
	}
	
	public function getJoomlaUserId($userid) {
		$db = JFactory::getDbo();
		$query	= $db->getQuery(true);
		$query->select('p.userid');
		$query->from('#__profiler_users AS p');
		$query->where('p.id = '. (int) $userid);
		$db->setQuery($query);
		return $db->loadResult();
	}
	
	public function getProfilerUserId($userid) {
		$db = JFactory::getDbo();
		$query	= $db->getQuery(true);
		$query->select('p.id');
		$query->from('#__profiler_users AS p');
		$query->where('p.userid = '. (int) $userid);
		$db->setQuery($query);
		return $db->loadResult();
	}
	
	public function getUserGroupIDs($userid)
	{
		$juserid = self::getJoomlaUserId($userid);

		
		$db = JFactory::getDbo();
		$query	= $db->getQuery(true);
		
		if($juserid > -1) {
			$query->select('map.group_id')
			->from('#__user_usergroup_map AS map')
			->where('map.user_id = '. $juserid.'');
		} else {
			$query->select('map.group_id')
			->from('#__profiler_usergroup_map AS map')
			->where('map.user_id = '. $userid.'');
		}
				
		$db->setQuery($query);
		return $db->loadAssoc();
	}
	
	public function getUserGroupTitles($groupids = array())
	{
		if(count($groupids)  > 0) {
			$db 		= JFactory::getDbo();
			$db->setQuery(
				'SELECT a.id as id, a.title AS title ' .
				' FROM #__usergroups AS a' .
				' WHERE a.id IN ('.implode(",", $groupids) . ') '
			);
			$titles = $db->loadAssocList("id", "title");
		} else {
			$titles = array();
		}
		return $titles;
	}
	
	public function setRightsProfiles() {
		if (empty($this->RightsProfiles)) {
			$db = JFactory::getDbo();
			$query	= $db->getQuery(true);
			$query->select(' b.lft, b.rgt, p.id AS pid, p.readaccess, p.access, p.deleteaccess, p.registeraccess');
			$query->from('#__usergroups AS a');
			$query->leftJoin('#__usergroups AS b ON b.lft <= a.lft AND b.rgt >= a.rgt');
			$query->innerJoin('#__profiler AS p ON p.id = b.id');
			$query->group(' b.lft, b.rgt, p.id, p.readaccess, p.access, p.deleteaccess, p.registeraccess');
			$query->order('b.lft DESC');
			$db->setQuery($query);
			$this->RightsProfiles = $db->loadAssocList();
		}
		return $this->RightsProfiles;
	}
	
	
	//rights for fields, categories and profiles
	
	public function getFieldPermissions ($userId = false)
	{
		$app	= JFactory::getApplication();
		$user	= JFactory::getUser();
		$meAutohorisedLevels = JAccess::getAuthorisedViewLevels($user->get('id'));
		$JuserId = self::getJoomlaUserId($userId);

		$config = JComponentHelper::getParams('com_profiler');
		
		$defaultFieldPermission = new stdClass();

		
		$userdata = $app->getUserState('com_profiler.edit.user.data'); //, 'groups', array($config->get('new_usertype', 2)));
		if(isset($userdata['groups']) && is_array($userdata['groups']) && count($userdata['groups']) > 0) {
			$usergroups = $userdata['groups'];
		} elseif (empty($userId)) {
			$usergroups = array($config->get('new_usertype', 2));
		} elseif($JuserId == -1) {
			$usergroups = self::getUserGroupIDs($userId);
		} else {
			$usergroups = JAccess::getGroupsByUser($JuserId, false);
		}


 		$fieldaccess = array();
		
		$db = JFactory::getDbo();
		$query	= $db->getQuery(true);
		$query->select(' a.id AS id, b.id AS subid, fp.fieldid, flds.catid, fp.published, fp.required, fp.accessrequired, fp.registration, fp.readonly, fp.access, fp.accessro, fp.accessreg, fp.accessroprivate, fp.accessprivate');
 		$query->from('#__usergroups AS a'); 
		$query->leftJoin('#__usergroups AS b ON b.lft <= a.lft AND b.rgt >= a.rgt');
		$query->innerJoin('#__profiler_fieldprofile AS fp ON fp.profile = b.id');
		$query->leftJoin('#__profiler_fields AS flds ON fp.fieldid = flds.id');
 		$query->where('a.id IN ('. implode(",", $usergroups)  .')');
		$query->order('a.id ASC, b.lft DESC');
		$db->setQuery($query);
		$results = $db->loadAssocList();

		$fieldcategorielist = array();
		
		foreach($usergroups as $usergroup) {
			foreach($results as $result) {
				if($result['id'] == $usergroup) {
					$fieldcategorielist[$result['fieldid']] = $result['catid'];
					foreach($result AS $row => $value) {
						if(in_array($row, array('published', 'required', 'registration', 'readonly', 'accessroprivate', 'accessprivate')) && $value != 2) {
							if(!isset($fieldaccess[$result['fieldid']][$row][$usergroup])) {
								$fieldaccess[$result['fieldid']][$row][$usergroup] = $value;
							}
						} elseif (in_array($row, array('access', 'accessro', 'accessreg', 'accessrequired')) && $value != 0) {
							if(!isset($fieldaccess[$result['fieldid']][$row][$usergroup])) {
								$value = in_array($value, $meAutohorisedLevels) ? 1 : 0;
								$fieldaccess[$result['fieldid']][$row][$usergroup] = $value;
							}
						}
					}
				}
			}
		}

		foreach($fieldaccess AS $fieldid => $fields) {
			foreach($fields AS $fieldpermissions => $fieldvalue) {
				$defaultFieldPermission->$fieldid->$fieldpermissions = max($fieldvalue);
			}
			$defaultFieldPermission->$fieldid->catid = $fieldcategorielist[$fieldid];
		}
		return $defaultFieldPermission;
	}

	public function getCategoryPermissions ($userId = false)
	{
		$app	= JFactory::getApplication();
		$user	= JFactory::getUser();
		$meAutohorisedLevels = JAccess::getAuthorisedViewLevels($user->get('id'));
		$JuserId = self::getJoomlaUserId($userId);

		$config = JComponentHelper::getParams('com_profiler');
		
		$defaultCategoryPermission = new stdClass();

		$userdata = $app->getUserState('com_profiler.edit.user.data'); //, 'groups', array($config->get('new_usertype', 2)));
		if(isset($userdata['groups']) && is_array($userdata['groups']) && count($userdata['groups']) > 0) {
			$usergroups = $userdata['groups'];
		} elseif (empty($userId)) {
			$usergroups = array($config->get('new_usertype', 2));
		} elseif($JuserId == -1) {
			$usergroups = self::getUserGroupIDs($userId);
		} else {
			$usergroups = JAccess::getGroupsByUser($JuserId, false);
		}
		$categoryaccess = array();
	
		$db = JFactory::getDbo();
		$query	= $db->getQuery(true);
		$query->select(' a.id AS id, b.id AS subid, fp.catid, fp.published, fp.registration, fp.readonly, fp.access, fp.accessro, fp.accessreg, fp.accessroprivate, fp.accessprivate');
		$query->from('#__usergroups AS a');
		$query->leftJoin('#__usergroups AS b ON b.lft <= a.lft AND b.rgt >= a.rgt');
		$query->innerJoin('#__profiler_fieldgroupprofile AS fp ON fp.profile = b.id');
		$query->where('a.id IN ('. implode(",", $usergroups)  .')');
		$query->order('a.id ASC, b.lft DESC');
		$db->setQuery($query);
		$results = $db->loadAssocList();
		
		foreach($usergroups as $usergroup) {
			foreach($results as $result) {
				if($result['id'] == $usergroup) {
					foreach($result AS $row => $value) {
						if(in_array($row, array('published', 'required', 'registration', 'readonly', 'accessroprivate', 'accessprivate')) && $value != 2) {
							if(!isset($categoryaccess[$result['catid']][$row][$usergroup])) {
								$categoryaccess[$result['catid']][$row][$usergroup] = $value;
							}
						} elseif (in_array($row, array('access', 'accessro', 'accessreg')) && $value != 0) {
							if(!isset($categoryaccess[$result['catid']][$row][$usergroup])) {
								$value = in_array($value, $meAutohorisedLevels) ? 1 : 0;
								$categoryaccess[$result['catid']][$row][$usergroup] = $value;
							}
						}
					}
				}
			}
		}

		foreach($categoryaccess AS $categoryid => $categories) {
			foreach($categories AS $categorypermissions => $categoryvalue) {
				$defaultCategoryPermission->$categoryid->$categorypermissions = max($categoryvalue);
			}
		}

		return $defaultCategoryPermission;
	}
	
	public function getProfilePermissions ($userId = false)
	{
		$app	= JFactory::getApplication();
		$user	= JFactory::getUser();
		$meAutohorisedLevels = JAccess::getAuthorisedViewLevels($user->get('id'));
		$JuserId = self::getJoomlaUserId($userId);

		$config = JComponentHelper::getParams('com_profiler');
		$defaultProfilePermission = new stdClass();

		
		$userdata = $app->getUserState('com_profiler.edit.user.data'); //, 'groups', array($config->get('new_usertype', 2)));
		if(isset($userdata['groups']) && is_array($userdata['groups']) && count($userdata['groups']) > 0) {
			$usergroups = $userdata['groups'];
		} elseif (empty($userId)) {
			$usergroups = array($config->get('new_usertype', 2));
		} elseif($JuserId == -1) {
			$usergroups = self::getUserGroupIDs($userId);
		} else {
			$usergroups = JAccess::getGroupsByUser($JuserId, false);
		}
		
		$profileaccess = array();
		
		$db = JFactory::getDbo();
		$query	= $db->getQuery(true);
		$query->select(' a.id AS id, b.id AS subid, p.id AS pid, p.readaccess, p.access, p.deleteaccess, p.registeraccess, p.accessroprivate, p.accessprivate');
		$query->from('#__usergroups AS a');
		$query->where('a.id IN (' . implode(',', $usergroups) . ')');
		$query->leftJoin('#__usergroups AS b ON b.lft <= a.lft AND b.rgt >= a.rgt');
		$query->innerJoin('#__profiler AS p ON p.id = b.id');
		$query->order('a.id ASC, b.lft DESC');
		
		$db->setQuery($query);
		$results = $db->loadAssocList();

		foreach($usergroups as $usergroup) {
			foreach($results as $result) {
				if($result['id'] == $usergroup) {
					foreach($result AS $row => $value) {
						if(in_array($row, array('accessroprivate', 'accessprivate')) && $value != 2) {
							if(!isset($profileaccess[$row][$usergroup])) {
								$profileaccess[$row][$usergroup] = $value;
							}
						}
						elseif (in_array($row, array('readaccess', 'access', 'deleteaccess', 'registeraccess')) && $value != 0) {
							if(!isset($profileaccess[$row][$usergroup])) {
								$value = in_array($value, $meAutohorisedLevels) ? 1 : 0;
								$profileaccess[$row][$usergroup] = $value;
							}
						}
					}
				}
			}
		}

		foreach($profileaccess AS $profilepermissions => $profilevalue) {
			$defaultProfilePermission->$profilepermissions = max($profilevalue);
		}

		return $defaultProfilePermission;
	}

}
