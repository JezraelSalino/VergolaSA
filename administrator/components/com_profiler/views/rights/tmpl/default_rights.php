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


$aclfields = $this->getACLfields($this->state->get('filter.acl'), "fields");
$checkboxes = array("published", "registration", "readonly", "accessroprivate", "accessprivate", "required"); 


foreach($this->columns as $column) {
	
	switch($this->tmplrights) {
		case "profile":
			
			foreach($aclfields['profileraccess'] as $profileaccess) {
				if($profileaccess == "notset") {
					echo '<td></td>';
				} elseif(isset($this->rights[$this->tmplrights][$column['id']][$profileaccess]) 
							&& (in_array($profileaccess, $checkboxes) || $this->rights[$this->tmplrights][$column['id']][$profileaccess] > 0)) {
					$style = $this->getAccessClass($this->rights[$this->tmplrights][$column['id']][$profileaccess], $column['depth'], $profileaccess, 0, $column['id']);
					if(in_array($profileaccess, $checkboxes) && $this->rights[$this->tmplrights][$column['id']][$profileaccess] == 2) {
						echo '<td><span class="label '.$style.'">&nbsp;</span></td>';
					} elseif(in_array($profileaccess, $checkboxes)) {
						if($this->rights[$this->tmplrights][$column['id']][$profileaccess] == 1) {
							echo '<td><span class="label '.$style.'">v</span></td>';
						} else {
							echo '<td><span class="label '.$style.'">x</span></td>';
						}
					} elseif ($this->rights[$this->tmplrights][$column['id']][$profileaccess] > 0) {
						echo '<td><span class="label '.$style.'">'.$this->rights[$this->tmplrights][$column['id']][$profileaccess]."</span></td>";
					}
				} else {
					if(in_array($profileaccess, $checkboxes)) {
						$style = $this->getAccessClass(2, $column['depth'], $profileaccess, 0, $column['id']);
					} else {
						$style = $this->getAccessClass(0, $column['depth'], $profileaccess, 0, $column['id']);
					}
					echo '<td><span class="label '.$style.'">&nbsp;</span></td>';
				}
			}
			break;
			
		case "categories":
			foreach($aclfields['categoriesaccess'] as $categoryaccess) {
				if($categoryaccess == "notset") {
					echo '<td></td>';
				} elseif(isset($this->rights[$this->tmplrights][$column['id']][$this->tmplid][$categoryaccess])
							&& (in_array($categoryaccess, $checkboxes) || $this->rights[$this->tmplrights][$column['id']][$this->tmplid][$categoryaccess] > 0)) {
					$style = $this->getAccessClass($this->rights[$this->tmplrights][$column['id']][$this->tmplid][$categoryaccess], $column['depth'], $categoryaccess, 1, $column['id']);
					if(in_array($categoryaccess, $checkboxes) && $this->rights[$this->tmplrights][$column['id']][$this->tmplid][$categoryaccess] == 2) {
						echo '<td><span class="label '.$style.'">&nbsp;</span></td>';
					} elseif(in_array($categoryaccess, $checkboxes)) {
						if($this->rights[$this->tmplrights][$column['id']][$this->tmplid][$categoryaccess] == 1) {
							echo '<td><span class="label '.$style.'">v</span></td>';
						} else {
							echo '<td><span class="label '.$style.'">x</span></td>';
						}
					} elseif ($this->rights[$this->tmplrights][$column['id']][$this->tmplid][$categoryaccess] > 0) {
						echo '<td><span class="label '.$style.'">'.$this->rights[$this->tmplrights][$column['id']][$this->tmplid][$categoryaccess]."</span></td>";
					}
				} else {
					if(in_array($categoryaccess, $checkboxes)) {
						$style = $this->getAccessClass(2, $column['depth'], $categoryaccess,1, $column['id']);
					} else {
						$style = $this->getAccessClass(0, $column['depth'], $categoryaccess,1, $column['id']);
					}
					echo '<td><span class="label '.$style.'">&nbsp;</span></td>';
				}
			}
			break;
			
		case "fields":
			foreach($aclfields['fieldsaccess'] as $fieldaccess) {
				if($fieldaccess == "notset") {
					echo '<td></td>';
				} elseif(isset($this->rights[$this->tmplrights][$column['id']][$this->tmplid][$fieldaccess])
						&& (in_array($fieldaccess, $checkboxes) || $this->rights[$this->tmplrights][$column['id']][$this->tmplid][$fieldaccess] > 0)) {
					$style = $this->getAccessClass($this->rights[$this->tmplrights][$column['id']][$this->tmplid][$fieldaccess], $column['depth'], $fieldaccess, 2, $column['id']);
					if(in_array($fieldaccess, $checkboxes) && $this->rights[$this->tmplrights][$column['id']][$this->tmplid][$fieldaccess] == 2) {
						echo '<td><span class="label '.$style.'">&nbsp;</span></td>';
					} elseif(in_array($fieldaccess, $checkboxes)) {
						if($this->rights[$this->tmplrights][$column['id']][$this->tmplid][$fieldaccess] == 1) {
							echo '<td><span class="label '.$style.'">v</span></td>';
						} else {
							echo '<td><span class="label '.$style.'">x</span></td>';
						}
					} elseif ($this->rights[$this->tmplrights][$column['id']][$this->tmplid][$fieldaccess] > 0) {
						echo '<td><span class="label '.$style.'">'.$this->rights[$this->tmplrights][$column['id']][$this->tmplid][$fieldaccess]."</span></td>";
					} 
				} else {
					if(in_array($fieldaccess, $checkboxes)) {
						$style = $this->getAccessClass(2, $column['depth'], $fieldaccess,2, $column['id']);
					} else {
						$style = $this->getAccessClass(0, $column['depth'], $fieldaccess,2, $column['id']);
					}
					echo '<td><span class="label '.$style.'">&nbsp;</span></td>';
				}
			}
			break;

			
	}
}
