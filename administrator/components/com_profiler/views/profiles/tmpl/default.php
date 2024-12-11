<?php
/**
 * @package Profiler for Joomla! 2.5
 * @version $Id: default.php 45 2013-04-27 16:19:52Z harold $
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

// Load the tooltip behavior.
JHtml::_('behavior.tooltip');
JHtml::_('behavior.multiselect');
JHtml::_('behavior.modal');
//Joomla25 JHtml::_('formbehavior.chosen', 'select');

$user = JFactory::getUser();
$listOrder = $this->escape($this->state->get('list.ordering'));
$listDirn = $this->escape($this->state->get('list.direction'));
JText::script('COM_PROFILER_GROUPS_CONFIRM_DELETE');
?>
<script type="text/javascript">
	
	Joomla.submitbutton = function(task)
	{
		if (task == 'groups.delete')
		{
			var f = document.adminForm;
			var cb='';
<?php foreach ($this->items as $i=>$item):?>
<?php if ($item->user_count > 0):?>
			cb = f['cb'+<?php echo $i;?>];
			if (cb && cb.checked) {
				if (confirm(Joomla.JText._('COM_PROFILER_GROUPS_CONFIRM_DELETE'))) {
					Joomla.submitform(task);
				}
				return;
			}
<?php endif;?>
<?php endforeach;?>
		}
		Joomla.submitform(task);
	}
</script>
<div class="row-fluid">
<form action="<?php echo JRoute::_('index.php?option=com_profiler&view=profiles');?>" method="post" name="adminForm" id="adminForm">
	<fieldset id="filter-bar">
		<div class="filter-search fltlft">
			<label class="filter-search-lbl" for="filter_search"><?php echo JText::_('COM_PROFILER_PROFILES_SEARCH_GROUPS_LABEL'); ?></label>
			<input type="text" name="filter_search" id="filter_search" value="<?php echo $this->escape($this->state->get('filter.search')); ?>" title="<?php echo JText::_('COM_PROFILER_PROFILES_SEARCH_GROUPS_LABEL'); ?>" />

			<button type="submit" class=""><?php echo JText::_('JSEARCH_FILTER_SUBMIT'); ?></button>
			<button type="button" onclick="document.id('filter_search').value='';this.form.submit();"><?php echo JText::_('JSEARCH_FILTER_CLEAR'); ?></button>
		</div>
		<div class="filter-select fltrt">
			<?php echo $this->sidebar; ?>

		</div>
	</fieldset>

	<div id="j-main-container">
	<div class="clearfix"> </div>

	<table class="table table-striped">
		<thead>
			<tr>
				<th width="1%" rowspan="1">
					<input type="checkbox" name="checkall-toggle" value="" onclick="checkAll(this)" />
				</th>
				<th class="left" rowspan="1">
					<?php echo JText::_('COM_PROFILER_PROFILES_HEADING_GROUP_TITLE'); ?>
				</th>
				<th class="left" colspan="1">
					<?php echo JText::_('COM_PROFILER_PROFILES_HEADING_SETTINGS'); ?>
				</th>
				<th width="10%" rowspan="1">
					<?php echo JText::_('COM_PROFILER_PROFILES_HEADING_USERS_IN_GROUP'); ?>
				</th>
				<th width="5%" rowspan="1">
					<?php echo JText::_('JGRID_HEADING_ID'); ?>
				</th>
			</tr>
		</thead>
		<tfoot>
			<tr>
				<td colspan="7">
					<?php echo $this->pagination->getListFooter(); ?>
				</td>
			</tr>
		</tfoot>
		<tbody>
		<?php foreach ($this->items as $i => $item) :
			$canCreate	= $user->authorise('core.create',		'com_profiles');
			$canEdit	= $user->authorise('core.edit',			'com_profiles');
			// If this group is super admin and this user is not super admin, $canEdit is false
			if (!$user->authorise('core.admin') && (JAccess::checkGroup($item->id, 'core.admin'))) {
				$canEdit = false;
			}
			$canChange	= $user->authorise('core.edit.state',	'com_profiles');
		?>
			<tr class="row<?php echo $i % 2; ?>">
				<td class="center">
					<?php if ($canEdit) : ?>
						<?php echo JHtml::_('grid.id', $i, $item->id); ?>
					<?php endif; ?>
				</td>
				<td>
					<?php echo str_repeat('<span class="gi">|&mdash;</span>', $item->level) ?>
					<?php echo $this->escape($item->title); ?>
					<?php if (JDEBUG) : ?>
						<div class="fltrt"><div class="button2-left smallsub"><div class="blank"><a href="<?php echo JRoute::_('index.php?option=com_users&view=debuggroup&group_id='.(int) $item->id);?>">
						<?php echo JText::_('COM_PROFILER_DEBUG_GROUP');?></a></div></div></div>
					<?php endif; ?>
				</td>
				<td>
					<a href="<?php echo JRoute::_('index.php?option=com_profiler&task=profile.edit&id='.$item->id);?>"><?php echo JText::_('COM_PROFILER_PROFILES_SETTINGS_LABEL');?></a>
				</td>
				<td class="center">
					<?php echo $item->user_count ? $item->user_count : ''; ?>
				</td>
				<td class="center">
					<?php echo (int) $item->id; ?>
				</td>
			</tr>
			<?php endforeach; ?>
		</tbody>
	</table>

	<div>
		<input type="hidden" name="task" value="" />
		<input type="hidden" name="boxchecked" value="0" />
		<input type="hidden" name="filter_order" value="<?php echo $listOrder; ?>" />
		<input type="hidden" name="filter_order_Dir" value="<?php echo $listDirn; ?>" />
		<?php echo JHtml::_('form.token'); ?>
	</div>
</form>
<p class="copyright" align="center">
	<span class="version"><?php echo JText::_('COM_PROFILER_COPYRIGHT'); ?></span>
</p>
</div>
