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

$aclcount = $this->getACLfields($this->state->get('filter.acl'), "count");
$acltitle = $this->getACLfields($this->state->get('filter.acl'), "title");
?>
<div class="row-fluid">
<form action="<?php echo JRoute::_('index.php?option=com_profiler&view=rights');?>" method="post" name="adminForm" id="adminForm">
	<?php if(!empty( $this->sidebar)): ?>
		<div id="j-sidebar-container" class="span2">
		<?php echo $this->sidebar; ?>
		</div>
		<div id="j-main-container" class="span10">
	<?php else : ?>
		<div id="j-main-container">
	<?php endif;?>


<div class="clr"> </div>
<div style="height: 600px; width: 1100px; overflow: scroll;">
<table class="table table-bordered table-condensed" id="profilerrights">
	<thead>
<?php 

	//column titels
	echo "<tr>";
	$titlerow = array();
	$titlerow[0] = str_repeat("<th></th>", 3); // . '<td colspan="'.$aclcount.'">Default</td>';
	$lastrow = str_repeat("<td></td>", 3); //. $acltitle;
//	$this->columns[4]['id'] = "default";
//	$this->columns[4]['depth'] = 0;
	$colcount = 3;
	$oldlevel = 0;
	foreach($this->usergroups as $usergroup) {
		if(!isset($titlerow[$usergroup->level])) {
			$titlerow[$usergroup->level] = str_repeat("<th></th>", 3) . str_repeat('<th colspan="'.$aclcount.'"  style="border-top: 0px;"></th>', $colcount - 3);
		}
		$colcount++;
		foreach($titlerow AS $row => &$value) {
			if($row == $usergroup->level) {
				$value .= '<th colspan="'.$aclcount.'">'.$usergroup->text.' <span class="label">'.$usergroup->value.'</span></th>';
				$this->columns[$colcount]['id'] = $usergroup->value;
				$this->columns[$colcount]['depth'] = $usergroup->level + 1;
				$lastrow .= $acltitle;
			} elseif ($row < $usergroup->level) {
				$value .= '<th colspan="'.$aclcount.'" style="border-left: 0px;"></th>';
			} else {
				$value .= '<th colspan="'.$aclcount.'" style="border-top: 0px;"></th>';
			}
		}
	}
	echo implode("</tr><tr>",$titlerow);
	echo "</tr>";
	echo "<tr>" . $lastrow . "</tr>";
?>
	</thead>
	<tbody>
<?php 
	
	//row titels
	echo "<tr><td>Profiel</td><td></td><td></td>";
	$this->tmplrights = "profile";
	echo $this->loadTemplate('rights');
	echo "</tr>";
	$oldcategory = "";
	foreach ($this->fields as $field) {
		if($field->category != $oldcategory) {
			echo "<tr><td></td><td>".JText::_($field->category)."</td><td></td>";
			$this->tmplrights = "categories";
			$this->tmplid = $field->catid;
			echo $this->loadTemplate('rights');
			echo "</tr>";
			
		}

		echo "<tr><td></td><td></td><td>".JText::_($field->text)."</td>";
		$this->tmplrights = "fields";
		$this->tmplid = $field->value;
		echo $this->loadTemplate('rights');
		echo "</tr>";
		
		$oldcategory = $field->category;
	}


?>
	</tbody>
</table>
</div>

	<div>
		<input type="hidden" name="task" value="" />
		<?php echo JHtml::_('form.token'); ?>
	</div>
</form>
<p class="copyright" align="center">
	<span class="version"><?php echo JText::_('COM_PROFILER_COPYRIGHT'); ?></span>
</p>
</div>
