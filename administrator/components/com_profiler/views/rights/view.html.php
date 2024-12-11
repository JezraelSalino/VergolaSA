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

class ProfilerViewRights extends JViewLegacy
{

	protected $fields;
	protected $usergroups;
	protected $rights;
	protected $params;

	public function display($tpl = null)
	{
		//$ProfilePermissions = ProfilerHelperAccess::getProfilePermissions();
		//$FieldPermissions = ProfilerHelperAccess::getFieldPermissions();
		//$CategoryPermissions = ProfilerHelperAccess::getCategoryPermissions();
		
		$this->fields	= $this->get('Fields');
		$this->usergroups = $this->get('Usergroups');
		$this->params 	= JComponentHelper::getParams('com_profiler');
		$this->rights = $this->get('Rights');
		$this->state	= $this->get('State');
		
//		JHtml::_('bootstrap.framework');
/*		JHtml::_('script', 'com_profiler/jquery.fixedheadertable.min.js', true, true);
		$document = JFactory::getDocument();
		$document->addScriptDeclaration("
			jQuery(document).ready(function() {
				jQuery('#profilerrights').fixedHeaderTable({
					altClass: 'odd',
					fixedColumns: 3,
				});
		
			});
		
		
		");
		

/*		$document->addScriptDeclaration("
			jQuery(document).ready(function() {
				jQuery('#profilerrights').fixedHeaderTable({ 
					altClass: 'odd',
					fixedColumns: 3,
				});

			});
				
		
		");
		JHtml::_('stylesheet', 'com_profiler/tablefixedheader.css', array(), true);
*/
		$this->addToolbar();
		$this->sidebar = JHtmlSidebar::render();
		parent::display($tpl);
	}

	protected function addToolbar()
	{
		require_once JPATH_COMPONENT.'/helpers/profiler.php';

		$canDo	= ProfilerHelper::getActions();

		JToolBarHelper::title(JText::_('COM_PROFILER_VIEW_RIGHTS_TITLE'), 'user');

		
		if ($canDo->get('core.admin')) {
			JToolBarHelper::preferences('com_profiler');
		}
		
		JToolBarHelper::divider();
		$url = "http://www.haroldprins.nl/wiki/index.php?title=Profiler";
		JToolBarHelper::help("", "", $url);
		
		
		JHtmlSidebar::setAction('index.php?option=com_profiler&view=rights');
		
		JHtmlSidebar::addFilter(
			JText::_('COM_PROFILER_GUEST'),
			'filter_users',
			JHtml::_('select.options', ProfilerHelper::getUsers(), 'value', 'text', $this->state->get('filter.users'))
		);

		JHtmlSidebar::addFilter(
			JText::_('COM_PROFILER_RIGHTS_FILTER_LABEL'),
			'filter_acl',
			JHtml::_('select.options', ProfilerHelper::getAclOptions(), 'value', 'text', $this->state->get('filter.acl'))
		);
		
		
	}
	
	protected function getACLfields($type, $return)
	{
		
		switch($type) {
			case 0: //all
				if($return == "title") {
					return '<th><a href="#" class="btn btn-mini btn-inverse disabled" rel="tooltip" title="published">P</a></th>
							<th><a href="#" class="btn btn-mini btn-inverse disabled" rel="tooltip" title="read">R</a></th>
							<th><a href="#" class="btn btn-mini btn-inverse disabled" rel="tooltip" title="edit">E</a></th>
							<th><a href="#" class="btn btn-mini btn-inverse disabled" rel="tooltip" title="register">R</a></th>
							<th><a href="#" class="btn btn-mini btn-inverse disabled" rel="tooltip" title="read only">O</a></th>
							<th><a href="#" class="btn btn-mini btn-inverse disabled" rel="tooltip" title="register">A</a></th>
							<th><a href="#" class="btn btn-mini btn-inverse disabled" rel="tooltip" title="required">*</a></th>
							<th><a href="#" class="btn btn-mini btn-inverse disabled" rel="tooltip" title="delete">D</a></th>
							<th><a href="#" class="btn btn-mini btn-inverse disabled" rel="tooltip" title="private read">P</a></th>
							<th><a href="#" class="btn btn-mini btn-inverse disabled" rel="tooltip" title="private edit">P</a></th>';
				} elseif($return == "fields") {
					$aclfields['fieldsaccess'] = array("published", "accessro", "access", "registration", "readonly", "accessreg", "required", "notset", "accessroprivate", "accessprivate");
					$aclfields['categoriesaccess'] =array("published", "accessro", "access", "registration", "notset",  "accessreg", "notset", "notset", "accessroprivate", "accessprivate"); //categories
					$aclfields['profileraccess'] = array("notset",  "readaccess", "access", "notset", "notset", "registeraccess", "notset","deleteaccess", "accessroprivate", "accessprivate");
					return $aclfields;
				} elseif($return == "count") {
					return 10;
				}
				break;
				
			case 1:
				if($return == "title") {
					return '<td><a href="#" class="btn btn-mini btn-inverse disabled" rel="tooltip" title="read">R</a></td><td><a href="#" class="btn btn-mini btn-inverse disabled" rel="tooltip" title="edit">E</a></td>';
				} elseif($return == "fields") {
					$aclfields['fieldsaccess'] = array("accessro", "access");
					$aclfields['categoriesaccess'] =array("accessro", "access");
					$aclfields['profileraccess'] = array("readaccess", "access");
					return $aclfields;
				} elseif($return == "count") {
					return 2;
				}
				break;
			
			case 2:
				if($return == "title") {
					return "<td>A</td>";
				} elseif($return == "fields") {
					$aclfields['fieldsaccess'] = array("accessreg");
					$aclfields['categoriesaccess'] =array("accessreg");
					$aclfields['profileraccess'] = array("registeraccess");
					return $aclfields;
				} elseif($return == "count") {
					return 1;
				}
				break;
				
			case 3:
				if($return == "title") {
					return "<td>P</td><td>RO</td><td>R</td><td>E</td><td>*</td>";
				} elseif($return == "fields") {
					$aclfields['fieldsaccess'] = array("published", "readonly", "accessro", "access",  "required");
					$aclfields['categoriesaccess'] =array("published", "notset", "accessro", "access",  "notset"); //categories
					$aclfields['profileraccess'] = array("notset", "notset", "readaccess", "access", "notset");
					return $aclfields;
				} elseif($return == "count") {
					return 5;
				}
				break;
				
			case 4:
				if($return == "title") {
					return "<td>PR</td><td>PE</td>";
				} elseif($return == "fields") {
					$aclfields['fieldsaccess'] = array("accessroprivate", "accessprivate");
					$aclfields['categoriesaccess'] =array("accessroprivate", "accessprivate"); //categories
					$aclfields['profileraccess'] = array("accessroprivate", "accessprivate");
					return $aclfields;
				} elseif($return == "count") {
					return 2;
				}
				break;

			case 5:
				if($return == "title") {
					return "<td>P</td><td>RO</td><td>*</td>";
				} elseif($return == "fields") {
					$aclfields['fieldsaccess'] = array("published", "readonly", "required");
					$aclfields['categoriesaccess'] =array("published", "notset", "notset");
					$aclfields['profileraccess'] = array("notset", "notset", "notset");
					return $aclfields;
				} elseif($return == "count") {
					return 3;
				}
				break;
				
				
			case 6:
				if($return == "title") {
					return "<td>PR</td>";
				} elseif($return == "fields") {
					$aclfields['fieldsaccess'] = array("registration");
					$aclfields['categoriesaccess'] =array("registration");
					$aclfields['profileraccess'] = array("notset");
					return $aclfields;
				} elseif($return == "count") {
					return 1;
				}
				break;

		}
		
		
	}
	
	function getAccessClass($accesslevel, $level, $acltype, $depth, $col)
	{
		//1 true
		//2 false
		//3 true default
		//4 false default


		$changeacltype = array("readaccess" => "accessro", "registeraccess" => "accessreg");
		if(array_key_exists($acltype, $changeacltype)) {
			$acltype = $changeacltype[$acltype];
		}
		
		$checkboxes = array("published", "registration", "readonly", "accessroprivate", "accessprivate", "required");
		
		if(in_array($acltype, $checkboxes)) {
			if( $level == 0 && $accesslevel != 2) {
			  	$access = $accesslevel == 1 ? 3 : 4;
			} elseif( $level > 0 && $accesslevel != 2) {
				$access = $accesslevel == 1 ? 1 : 2;
			} elseif($level > 0) {
				$access = $this->access[$depth][($level - 1)][$acltype];
			} else {
				//if($acltype == "readonly") {
				//	$access = 4;
				//} else {
					$access = 4;
				//}
			}
			
			switch ($access) {
				case 1:
					$class = "label-success";
					break;
					
				case 2:
					$class = "label-important";
					break;
					
				case 3:
					$class = "background-color: #66FF66; color: #FFFFFF";
					break;
					
				case 4:
					$class = "background-color: #FF6666; color: #FFFFFF";
					break;
			}
			
//			if(isset($this->access[$depth][($level - 1)][$acltype]) && $this->access[$depth][($level - 1)][$acltype] == 2) {
//				if($access == true && $accesslevel != 2) {
//					$class = "background-color: #FFA500; color: #FFFFFF";
//				} else {
//					$class = "background-color: #FF0000; color: #FFFFFF";
//				}
//				$access = 2;
			if(isset($this->accesslevel[$depth][($level - 1)][$acltype]) && !in_array($this->accesslevel[$depth][($level - 1)][$acltype], $meAutohorisedLevels) && $this->accesslevel[$depth][($level - 1)][$acltype] > 0 && $accesslevel == 2) {	
				$accesslevel = $this->accesslevel[$depth][($level - 1)][$acltype];				
				if($this->access[$depth][($level - 1)][$acltype] == 2) {
					$class = "label-important";
					$access = 2;
				} elseif($this->access[$depth][($level - 1)][$acltype] == 4)  {
					$class = "background-color: #FF6666; color: #FFFFFF";
					$access = 4;
					
				}
			} elseif(isset($this->accesscol[$depth - 1][$col][$acltype]) && $this->accesscol[$depth - 1][$col][$acltype] == 2) {
				$class = "label-important";
				$access = 2;
			} elseif(isset($this->accesscol[$depth - 1][$col][$acltype]) && $this->accesscol[$depth - 1][$col][$acltype] == 4 && ($accesslevel == 2 || $level == 0)) {
				$class = "background-color: #FF6666; color: #FFFFFF";
				$access = 4;
			} elseif($access == 4 && isset($this->accesscol[$depth - 1][$col][$acltype]) && $this->accesscol[$depth - 1][$col][$acltype] == 1) {
				$class = "label-success";
				$access = 1;
			} elseif($access == 2 && isset($this->accesscol[$depth - 1][$col][$acltype]) && $this->accesscol[$depth - 1][$col][$acltype] == 1 && $accesslevel == 2) {
				$class = "label-success";
				$access = 1;
			}
			
			$this->access[$depth][$level][$acltype] = $access;
			$this->accesscol[$depth][$col][$acltype] = $access;
			
		} else {
			$meAutohorisedLevels = JAccess::getAuthorisedViewLevels($this->state->get('filter.users'));
			if($accesslevel > 0 && $level == 0) {
				$access = in_array($accesslevel, $meAutohorisedLevels) ? 3 : 4;
			} elseif($accesslevel > 0 && $level > 0) {
				$access = in_array($accesslevel, $meAutohorisedLevels) ? 1 : 2;
			} elseif($level > 0) {
				$access = $this->access[$depth][($level - 1)][$acltype];
			} else {
				$access = 3;
			}
			
			switch ($access) {
				case 1:
					$class = "label-success";
					break;
					
				case 2:
					$class = "label-important";
					break;
					
				case 3:
					$class = "background-color: #66FF66; color: #FFFFFF";
					break;
					
				case 4:
					$class = "background-color: #FF6666; color: #FFFFFF";
					break;
			}
			
//			if(isset($this->access[$depth][($level - 1)][$acltype]) && $this->access[$depth][($level - 1)][$acltype] == 2) {
//				if($access == true && $accesslevel > 0) {
//					$class = "background-color: #FFA500; color: #FFFFFF";
//				} else {
//					$class = "background-color: #FF0000; color: #FFFFFF";
//				}
				
//				$access = 2;

			if(isset($this->accesslevel[$depth][($level - 1)][$acltype]) && !in_array($this->accesslevel[$depth][($level - 1)][$acltype], $meAutohorisedLevels) && $this->accesslevel[$depth][($level - 1)][$acltype] > 0 && $accesslevel == 0) {	
				$accesslevel = $this->accesslevel[$depth][($level - 1)][$acltype];				
				if($this->access[$depth][($level - 1)][$acltype] == 2) {
					$class = "label-important";
					$access = 2;
				} elseif($this->access[$depth][($level - 1)][$acltype] == 4)  {
					$class = "background-color: #FF6666; color: #FFFFFF";
					$access = 4;
					
				}
			} elseif(isset($this->accesscol[$depth - 1][$col][$acltype]) && $this->accesscol[$depth - 1][$col][$acltype] == 2) {
				$class = "label-important";
				$access = 2;
			} elseif(isset($this->accesscol[$depth - 1][$col][$acltype]) && $this->accesscol[$depth - 1][$col][$acltype] == 4 && ($accesslevel == 0 || $level == 0)) {
				$class = "background-color: #FF6666; color: #FFFFFF";
				$access = 4;
			} elseif($access == 4 && isset($this->accesscol[$depth - 1][$col][$acltype]) && $this->accesscol[$depth - 1][$col][$acltype] == 1) {
				$class = "label-success";
				$access = 1;
			} elseif($access == 2 && isset($this->accesscol[$depth - 1][$col][$acltype]) && $this->accesscol[$depth - 1][$col][$acltype] == 1 && $accesslevel == 0 ) {
				$class = "label-success";
				$access = 1;
				
			}
		
			$this->access[$depth][$level][$acltype] = $access;
			$this->accesslevel[$depth][$level][$acltype] = $accesslevel;
			$this->accesscol[$depth][$col][$acltype] = $access;
			//$this->accessrow[$this->tmplrights.isset($this->tmplid)] = $accesslevel;
		
		}
		
		
		return $class;
	}
}
