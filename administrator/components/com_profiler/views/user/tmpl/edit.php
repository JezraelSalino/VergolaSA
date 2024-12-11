<?php
/**
 * @package Profiler for Joomla! 2.5
 * @version $Id: edit.php 45 2013-04-27 16:19:52Z harold $
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
		if (task == 'user.cancel' || document.formvalidator.isValid(document.id('user-form'))) {
			Joomla.submitform(task, document.getElementById('user-form'));
		}
		else {
			alert('<?php echo $this->escape(JText::_('JGLOBAL_VALIDATION_FORM_FAILED'));?>');
		}
	}
</script>


<form action="<?php echo JRoute::_('index.php?option=com_profiler&view=user&layout=edit&id='.(int) $this->item->id); ?>" method="post" enctype="multipart/form-data" name="adminForm" id="user-form" class="form-validate form-horizontal">
	<fieldset class="adminform">
		<ul class="nav nav-tabs">
			<?php $count = 0;
			foreach ($this->fieldsets as $fieldset) :
				if ($fieldset->name == 'settings') :
					//$fieldset->alias = $fieldset->name; 
					continue;
				endif;
				if($fieldset->type == 'plugin' || $fieldset->type == 'module' ) :
					continue;
				endif;
				$count++; ?>
				<li <?php echo $count == 1 ? "class=\"active\"" : "";?>><a data-toggle="tab" href="#<?php echo $fieldset->alias;?>"><?php echo $fieldset->label;?></a></li>
			<?php endforeach;
			?>
		</ul>
		<div class="tab-content">
			<?php //body
			echo $this->loadTemplate('fields');

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
