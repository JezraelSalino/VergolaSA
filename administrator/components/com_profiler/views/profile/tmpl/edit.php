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
// No direct access.
defined('_JEXEC') or die;

JHtml::_('behavior.tooltip');
JHtml::_('behavior.formvalidation');
//JHtml::_('formbehavior.chosen', 'select');
?>
<script type="text/javascript">
	Joomla.submitbutton = function(task)
	{
		if (task == 'profile.cancel' || document.formvalidator.isValid(document.id('profile-form'))) {
			Joomla.submitform(task, document.getElementById('profile-form'));
		}
		else {
			alert('<?php echo $this->escape(JText::_('JGLOBAL_VALIDATION_FORM_FAILED'));?>');
		}
	}
</script>

<form action="<?php echo JRoute::_('index.php?option=com_profiler&view=profile&id='.(int) $this->item->id); ?>" method="post" name="adminForm" id="profile-form" class="form-validate  form-horizontal">
	<div class="row-fluid">
	  <fieldset class="adminform">
		<ul class="nav nav-tabs">
			<li class="active"><a href="#details" data-toggle="tab"><?php echo JText::_('COM_PROFILER_PROFILE_LEGEND_DETAILS'); ?></a></li>
		</ul>

		<div class="tab-content">
			<div class="tab-pane active" id="details">
				<div class="control-group">
					<div class="control-label"><?php echo $this->form->getLabel('readaccess'); ?></div>
					<div class="controls"><?php echo $this->form->getInput('readaccess'); ?></div>
				</div>
				<div class="control-group">
					<div class="control-label"><?php echo $this->form->getLabel('accessroprivate'); ?></div>
					<div class="controls"><?php echo $this->form->getInput('accessroprivate'); ?></div>
				</div>
				<div class="control-group">
					<div class="control-label"><?php echo $this->form->getLabel('access'); ?></div>
					<div class="controls"><?php echo $this->form->getInput('access'); ?></div>
				</div>
				<div class="control-group">
					<div class="control-label"><?php echo $this->form->getLabel('accessprivate'); ?></div>
					<div class="controls"><?php echo $this->form->getInput('accessprivate'); ?></div>
				</div>
				<div class="control-group">
					<div class="control-label"><?php echo $this->form->getLabel('deleteaccess'); ?></div>
					<div class="controls"><?php echo $this->form->getInput('deleteaccess'); ?></div>
				</div>
				<div class="control-group">
					<div class="control-label"><?php echo $this->form->getLabel('registeraccess'); ?></div>
					<div class="controls"><?php echo $this->form->getInput('registeraccess'); ?></div>
				</div>
				<div class="control-group">
					<div class="control-label"><?php echo $this->form->getLabel('id'); ?></div>
					<div class="controls"><?php echo $this->form->getInput('id'); ?></div>
				</div>
			</div>
		</div>	
		
		<input type="hidden" name="task" value="" />
		<?php echo JHtml::_('form.token'); ?>
		
	</fieldset>
	</div>
</form>
<p class="copyright" align="center">
	<span class="version"><?php echo JText::_('COM_PROFILER_COPYRIGHT'); ?></span>
</p>

