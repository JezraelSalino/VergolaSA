<?php
/**
 * @package Profiler Fields for Joomla! 2.5
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

//JHtml::addIncludePath(JPATH_COMPONENT.'/helpers/html');
JHtml::_('behavior.tooltip');
JHtml::_('behavior.formvalidation');
//JHtml::_('formbehavior.chosen', 'select');
$canDo = PffieldsHelper::getActions();

?>
<script type="text/javascript">
	Joomla.submitbutton = function(task)
	{
		if (task == 'category.cancel' || document.formvalidator.isValid(document.id('category-form'))) {
			Joomla.submitform(task, document.getElementById('category-form'));
		}
		else {
			alert('<?php echo $this->escape(JText::_('JGLOBAL_VALIDATION_FORM_FAILED'));?>');
		}
	}

</script>

<form action="<?php echo JRoute::_('index.php?option=com_pffields&view=category&extension='.JRequest::getVar("extension", "pffields").'&layout=edit&id='.(int) $this->item->id); ?>" method="post" name="adminForm" id="category-form" class="form-validate form-horizontal">
	<div class="row-fluid">

		<fieldset class="adminform">
			<ul class="nav nav-tabs">
				<li class="active"><a href="#details" data-toggle="tab"><?php echo JText::_('COM_PFFIELDS_CATEGORY_LEGEND_DETAILS'); ?></a></li>
				<?php if ($canDo->get('core.admin') && $this->form->getValue('type') == 'category' && $this->form->getValue('extension') == 'com_profiler'): ?>
					<li><a href="#rights" data-toggle="tab"><?php echo JText::_('COM_PFFIELDS_FIELDSET_RIGHTS');?></a></li>
				<?php endif ?>
				
			</ul>
			
			<div class="tab-content">
				<div class="tab-pane active" id="details">
					<div class="control-group">
						<div class="control-label"><?php echo $this->form->getLabel('title'); ?></div>
						<div class="controls"><?php echo $this->form->getInput('title'); ?></div>
					</div>
					<div class="control-group">				
						<div class="control-label"><?php echo $this->form->getLabel('alias'); ?></div>
						<div class="controls"><?php echo $this->form->getInput('alias'); ?></div>
					</div>
	
						<?php echo $this->form->getLabel('extension'); ?>
						<?php echo $this->form->getInput('extension'); ?>

					<div class="control-group">
						<div class="control-label"><?php echo $this->form->getLabel('ordering'); ?></div>
						<div class="controls"><?php echo $this->form->getInput('ordering'); ?></div>
					</div>
					<div class="control-group">
						<div class="control-label"><?php echo $this->form->getLabel('description'); ?></div>
						<div class="controls"><?php echo $this->form->getInput('description'); ?></div>
					</div>
					<div class="control-group">
						<div class="control-label"><?php echo $this->form->getLabel('template'); ?></div>
						<div class="controls"><?php echo $this->form->getInput('template'); ?></div>
					</div>
					<div class="control-group">
						<div class="control-label"><?php echo $this->form->getLabel('id'); ?></div>
						<div class="controls"><?php echo $this->form->getInput('id'); ?></div>
					</div>
					
				</div>
				<?php if ($canDo->get('core.admin') && $this->form->getValue('type') == 'category' && $this->form->getValue('extension') == 'com_profiler'): ?>
					<div class="tab-pane" id="rights">
						<fieldset>
							<?php echo $this->form->getInput('rights'); ?>
						</fieldset>
					</div>
				<?php endif; ?>
				
			</div>
			
			<input type="hidden" name="task" value="" />
			<input type="hidden" name="prefix" value="<?php echo JRequest::getVar("prefix", "");?>" />
			<?php echo JHtml::_('form.token'); ?>
			
		</fieldset>
	</div>

</form>
<p class="copyright" align="center">
	<span class="version"><?php echo JText::_('COM_PFFIELDS_COPYRIGHT'); ?></span>
</p>
