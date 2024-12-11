<?php
/**
 * @package Profiler Fields for Joomla! 2.5
 * @version $Id: form.php 31 2013-06-10 21:37:32Z harold $
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

class PffieldsHelperForm
{
	private $meId;
	private $userId;
	public $multiplefields = array();
	public $editispossible = false;
	
	protected static $instance = null;

	
	public static function getInstance()
	{
		if (self::$instance === null)
		{
			self::$instance = new PffieldsHelperForm;
		}

		return self::$instance;
	}
	
	public function setDefaultValues ($meId, $userId) {
		$this->userId = $userId;
		$this->meId = $meId;
	}
	
	public function getMultiplefields() {
		return $this->multiplefields;
	}
	
	public function getForm($extension, &$form, &$data, $readonlyfield = false, $acl = true) {
		$app = JFactory::getApplication();
		$config = JComponentHelper::getParams('com_profiler');
		$db = JFactory::getDbo();
		$params = new JRegistry();
		$fieldxml = "";
		$readonly_pro = false;
		$private_pro = false;
		$isSuperAdmin = JFactory::getUser()->authorise('core.admin');

		$fieldsaddtoxml = array();
		
//		if($isSuperAdmin) {
//			$acl = false;
//		}

		if(JRequest::getCmd('ro', false, 'GET') == true) {
			$readonly_pro = true;
		}
		
		//com_profiler?
		if($extension == "com_profiler") {
			$profiler_config = JComponentHelper::getParams('com_profiler');
			$ProfilePermissions = ProfilerHelperAccess::getProfilePermissions($this->userId);
			$FieldPermissions = ProfilerHelperAccess::getFieldPermissions($this->userId);
			$CategoryPermissions = ProfilerHelperAccess::getCategoryPermissions($this->userId);

			//edit access???
			$this->editispossible = $this->editAccess($ProfilePermissions, $CategoryPermissions, $FieldPermissions);
		
			//access profile
			if($acl) {
				switch ($this->accessProfile($ProfilePermissions, $readonly_pro)) {
					case "readonly":
						JRequest::setVar('ro', 1);
						$readonly_pro = true;
						break;
					
					case "private":
						$readonly_pro = true;
						$private_pro = true;
						break;
						
					case "true":
						break;
			
					default:
						JError::raiseError(500, JText::_('COM_PROFILER_NO_ACCESS'));
						return null;
						//$app->enqueueMessage(JText::_('COM_PROFILER_NO_ACCESS'), 'error');
						//return false;
						break;
				}
			}
		}
		
		
		//load categories as fieldgroups
		$db->setQuery(
			'SELECT a.*' .
			' FROM #__profiler_categories AS a' .
			' WHERE a.extension = "'.$extension.'"' .
			' ORDER BY a.ordering ASC'
		);
		$fieldcategories = $db->loadObjectList();
		if ($db->getErrorNum()) {
			JError::raiseNotice(500, $db->getErrorMsg());
			return null;
		}
		
		foreach ($fieldcategories as &$category) {
			//$params->loadString($category->params);
			$readonly_cat = $readonly_pro == true ? true : false;
			$private_cat = $private_pro == true ? true : false;
			
			$query = "";
			//com_profiler?
			if($extension == "com_profiler" &&  $category->type == "category") {
				if($acl) {
					//access category
					switch ($this->accessCategory($CategoryPermissions, $category->id, $readonly_cat, $private_cat)) {
						case "readonly":
							$readonly_cat = true;
							$private_cat = false;
							break;
				
						case "private":
							$readonly_cat = true;
							$private_cat = true;
							break;
							
						case "true":
							break;
			
						default:
							continue 2;
							break;
					}
				}
				if($data->userid == -1) {
					$query = ' AND (a.table != "#__users")';
				}
			}
			
			$db->setQuery(
				'SELECT a.*' .
				' FROM #__profiler_fields AS a' .
				' WHERE a.extension = "'.$extension.'" AND a.catid = ' . $category->id .
				$query .
				' ORDER BY a.ordering'
			);
			$fields = $db->loadObjectList(); //$this->checkFieldlist($db->loadObjectList());
			
			if(count($fields) > 0 || $category->type == "plugin" || $category->type == "module") {
				$fieldxml .= "<fieldset name='$category->title' label='$category->title' alias='$category->alias' position='$category->template' type='$category->type' eid='$category->extension_id'>";
			} else {
				continue;
			}
	
			//Check for a database error.
			if ($db->getErrorNum()) {
				JError::raiseNotice(500, $db->getErrorMsg());
				return null;
			}

			foreach ($fields as &$field) {
				//default settings
				$filter = ""; //user_utc, raw, ContentHelper::filterText
				$format = $field->inputformat;
				$showformat = $field->format;
				$validate = ""; //email
				$onchange = NULL;
				$readonly = $readonly_cat == true ? 'true' : 'false';
				$private = $private_cat == true ? 'true' : 'false';
				$required = 'false';
				$class = $readonly_cat == true ? "readonly" : "inputbox";
				$typero = "";
				$prevalue = "";
				$plugin = "";
				$multiple = $field->multiple ? 'true' : 'false';

				//com_profiler?
				if($extension == "com_profiler") {
					if($acl) {
						//access field
						switch ($this->accessField($FieldPermissions, $field->id, $readonly, $private)) {
							case "readonly":
								$readonly = 'true';
								$private = 'false';
								break;
								
							case "private":
								$readonly = 'true';
								$private = 'true';
								break;
				
							case "true":
								break;
			
							default:
								continue 2;
								break;
						}
					
						if($private == 'true') {
							$readonly = 'false';
						}
					
						//readonly and required
						$fieldid = $field->id;
						$readonly = (isset($FieldPermissions->$fieldid->readonly) && $FieldPermissions->$fieldid->readonly == 1) ? 'true' : $readonly;

						
						$required = (isset($FieldPermissions->$fieldid->required) && $FieldPermissions->$fieldid->required == 1 && $FieldPermissions->$fieldid->accessrequired == 1 && $readonly == 'false') ? 'true' : $required;
					}
					
				}
				
				if($multiple == 'true' || $field->type == "checkboxes") {
					//set multiplefields for loading data in JSON
					$this->multiplefields[] = $field->name;
				}
				
				//plugin?
				if(strpos($field->type, ".") !== false) {
					$plugintype = explode(".", $field->type);
					$field->type = $plugintype[0];
					$plugin = $plugintype[1];
				}
				
				
				$type = $field->type;
				
				
				//readonly
				if(($readonly == 'true' || JRequest::getCmd('ro', false, 'GET') == true) && $readonlyfield == true) {
					$typero = $field->type;
					$field->type = "rotext";
				}
				
				switch ($type) {
					case "readonly":
						$field->type = $field->type == "rotext" ? "rotext" : "text";
						$class = "readonly";
						$readonly = 'true';
						$required = 'false';
						break;
						
					case "checkbox":
						$prevalue = $field->value;
						break;
						
					case "profile":
						$access = ProfilerHelperAccess::getInstance();
						$groups = $access->getRegisterUserGroups();
						if(count($groups) == 0) {
							continue;
						}
						$field->default = $profiler_config->get('new_usertype', 2);
						$filter = "ProfilerHelper::filterProfile";			
						break;
						
					case "calendar":
						if(!$format) {
							$format = $config->get('inputdatetimedisplay', "%Y-%m-%d %H:%M:%S");
						}
						if(!$showformat) {
							$showformat = $config->get('datetimedisplay', "Y-m-d H:i:s");
						}
						$fieldname = $field->name;
						if(isset($data->$fieldname) && $data->$fieldname != "0000-00-00 00:00:00") {
							$data->$fieldname = strftime($format, strtotime($data->$fieldname));
						}
						
						break;
						
					case "list":
						//$validate="options";
						break;
						
					case "editor":
						$filter = "SAFEHTML";
						break;		
				}
				
				//if ($readonly == "false") {
				//	$this->editispossible = true;
				//}
				
				
				$fieldsaddtoxml[] = $field->name;
								
				$fieldxml .= "<field 
						name='$field->name' 
						type='$field->type' 
						typero='$typero' 
						default='$field->default' 
						class='$class' 
						description='$field->description' 
						label='$field->title' 
						readonly='$readonly' 
						required='$required' 
						size='$field->size' 
						rows='$field->rows' 
						cols='$field->cols' 
						autocomplete='off' 
						filter='$filter' 
						format='$format' 
						showformat='$showformat'
						validate='$validate' 
						client='' 
						multiple='$multiple' 
						accept='$field->accept' 
						buttons='false' 
						onchange='$onchange' 
						value='$prevalue' 
						query='$field->query' 
						plugin='$plugin' 
						>";
				if($field->type == "list" || $field->type == "radio" || $field->type == "checkboxes" || $typero == "list" || $typero == "radio" || $typero == "checkboxes" ) {
					$values = explode(",", $field->value);
					foreach($values as $value) {
						$valuedetail = explode("=", $value);
						$fieldxml .= "<option value='$valuedetail[0]' >$valuedetail[1]</option>";
					}
				}
				$fieldxml .= "</field>";
			
			}


			if(!in_array("id", $fieldsaddtoxml)) {
				$fieldxml .= "<field
						name='id'
						type='hidden'
						></field>";
			}
				
			$fieldxml .= "</fieldset>";
			$newxml = new JXMLElement($fieldxml);

			
			$form->setField($newxml);
			$fieldxml = "";
			
		}
		return true;
	}
	
	private function checkFieldlist($fields) {
		//@plugin todo
		return $fields;
	}
	
	private function editAccess($pro, $categories, $fields) {
		if($pro->access || $pro->accessprivate) {
			foreach($categories as $catid => $category) {
				if($category->published &&  !$category->readonly && ($category->access || $category->accessroprivate)) {
					foreach($fields as $fieldid => $field) {
						if($field->catid == $catid && $field->published &&  !$field->readonly && ($field->access || $field->accessroprivate)) {
							return true;
						}
					}
				}
			}
			
			
		} else {
			return false;
		}
		return false;
	}
	
	private function accessProfile($permissions, $readonly) {
		$dispatcher	= JDispatcher::getInstance();
		JPluginHelper::importPlugin('profiler');
				
		if(($this->meId == $this->userId && $permissions->accessprivate == true) == false && $permissions->access == false  && $this->userId) { 
		 	if (($this->meId == $this->userId && $permissions->accessroprivate == true) || $permissions->readaccess == true) {
				$return = "readonly";
		 	} else {
				$return = "false";
		 	}
		} elseif (!$this->userId && ($permissions->registeraccess == false || JRequest::getCmd('ro')) ) {
			$return = "false";
		} elseif ($this->meId == $this->userId && $permissions->accessprivate == true && $permissions->access == false && $this->userId ) {
			$return = "private";
		} else {
			$return = "true";
		}
		
		$result = $dispatcher->trigger('onProfilerAccessProfile', array($return, $permissions, $this->userId, $this->meId));
		if(end($result)) {
			$return = end($result);
		}

		return $return;
	}
	
	private function accessCategory($permissions, $id, $readonly, $private) {
		$dispatcher	= JDispatcher::getInstance();
		JPluginHelper::importPlugin('profiler');
		
		if(!isset($permissions->$id->published) || !$permissions->$id->published) {
			$return = false;
		} elseif($readonly == true && !($this->meId == $this->userId && isset($permissions->$id->accessroprivate) && $permissions->$id->accessroprivate == true) && $permissions->$id->accessro == false) {
			$return = false;			
		} elseif(($this->meId == $this->userId && isset($permissions->$id->accessprivate) && $permissions->$id->accessprivate == true) == false && ($permissions->$id->access == true && $private == false) == false  && $this->userId) {
			if (($this->meId == $this->userId && isset($permissions->$id->accessroprivate) && $permissions->$id->accessroprivate == true) || $permissions->$id->accessro == true) {
				$return = "readonly";
			} else {
				$return = "false";
			}					
		} elseif (!$this->userId && ($permissions->$id->accessreg == false || (!isset($permissions->$id->registration) || !$permissions->$id->registration))) {
			$return = "false";
		} elseif ($this->meId == $this->userId && isset($permissions->$id->accessprivate) && $permissions->$id->accessprivate == true && $permissions->$id->access == false && $this->userId ) {
			$return = "private";
		} else {
			$return = "true";
		}
		
		$result = $dispatcher->trigger('onProfilerAccessCategory', array($return, $permissions->$id, $this->userId, $this->meId, $readonly, $private));
		if(end($result)) {
			$return = end($result);
		}
		
		return $return;
	}
	
	private function accessField($permissions, $id, $readonly, $private) {
		$dispatcher	= JDispatcher::getInstance();
		JPluginHelper::importPlugin('profiler');
		
		if(!isset($permissions->$id->published) || !$permissions->$id->published) {
			$return = false;
		} elseif($readonly == 'true' && !($this->meId == $this->userId && isset($permissions->$id->accessroprivate) && $permissions->$id->accessroprivate == true) && $permissions->$id->accessro == false) {
			$return = false;
		} elseif(($this->meId == $this->userId && isset($permissions->$id->accessprivate) && $permissions->$id->accessprivate == true) == false && ($permissions->$id->access == true && $private == 'false') == false  && $this->userId) {
			if (($this->meId == $this->userId && isset($permissions->$id->accessroprivate) && $permissions->$id->accessroprivate == true) || $permissions->$id->accessro == true) {
				$return = "readonly";
			} else {
				$return = "false";
			}					
	
		} elseif (!$this->userId && ($permissions->$id->accessreg == false || (!isset($permissions->$id->registration) || !$permissions->$id->registration))) {
			$return = "false";
		} elseif ($this->meId == $this->userId && isset($permissions->$id->accessprivate) && $permissions->$id->accessprivate == true && $permissions->$id->access == false && $this->userId ) {
			$return = "private";
		} else {
			$return = "true";
		}
				
		$result = $dispatcher->trigger('onProfilerAccessField', array($return, $permissions->$id, $this->userId, $this->meId, $readonly, $private));
		if(end($result)) {
			$return = end($result);
		}
		
		
		return $return;
	}
}
