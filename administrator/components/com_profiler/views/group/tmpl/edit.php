<?php
/**
 * @package Profiler for Joomla! 2.5
 * @version $Id: edit.php 50 2013-06-14 21:37:27Z harold $
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
defined('_JEXEC') or die;

// Include the component HTML helpers.
JHtml::addIncludePath(JPATH_COMPONENT.'/helpers/html');

// Load the tooltip behavior.
JHtml::_('behavior.tooltip');
JHtml::_('behavior.formvalidation');
//Joomla25 JHtml::_('formbehavior.chosen', 'select');
$canDo = ProfilerHelper::getActions();

?>

<script type="text/javascript">
	Joomla.submitbutton = function(task)
	{
		if (task == 'group.cancel' || document.formvalidator.isValid(document.id('group-form'))) {
			Joomla.submitform(task, document.getElementById('group-form'));
		}
		else {
			alert('<?php echo $this->escape(JText::_('JGLOBAL_VALIDATION_FORM_FAILED'));?>');
		}
	}
</script>

<form action="<?php echo JRoute::_('index.php?option=com_profiler&view=group&layout=edit&groupid='.(int) $this->item->groupid); ?>" method="post" enctype="multipart/form-data" name="adminForm" id="group-form" class="form-validate form-horizontal">
	<fieldset class="adminform">
		<ul class="nav nav-tabs">
			<?php $count = 0;
			foreach ($this->fieldsets as $fieldset) :
				if($fieldset->type == 'plugin' || $fieldset->type == 'module' ) :
					continue;
				endif;
				$count++; ?>
				<li <?php echo $count == 1 ? "class=\"active\"" : "";?>><a data-toggle="tab" href="#<?php echo $fieldset->alias;?>"><?php echo $fieldset->label;?></a></li>
			<?php endforeach;
			//$plugin = $this->loadPlugin();
			//if(is_array($plugin) && isset($plugin['label'])) {
			//	foreach($plugin['label'] as $row => $label) {
			//		echo "<li><a data-toggle=\"tab\" href=\"#".$plugin['id'][$row]."\">".$label."</a></li>";
			//	}
			//}
			?>
		</ul>
		<div class="tab-content">
			<?php //body
			echo $this->loadTemplate('fields');
					
/*			if(is_array($plugin) && isset($plugin['content'])) {
//				foreach($plugin['content'] as $row => $content) { ?>
//					<div id="<?php echo $plugin['id'][$row];?>" class="tab-pane">
//						<?php echo $content; ?>
//					</div>
//				<?php }
			}*/
?>
						
		</div>
	</fieldset>
	<input type="hidden" name="task" value="" />
	<?php echo JHtml::_('form.token'); ?>
</form>
<div class="clr"></div>
<p class="copyright" align="center">
	<span class="version"><?php echo JText::_('COM_PROFILER_COPYRIGHT'); ?></span>
</p>
