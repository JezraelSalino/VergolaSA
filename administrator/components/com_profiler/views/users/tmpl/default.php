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
//joomla25 JHtml::_('formbehavior.chosen', 'select');

$canDo = ProfilerHelper::getActions();
$listOrder = $this->escape($this->state->get('list.ordering'));
$listDirn = $this->escape($this->state->get('list.direction'));
$loggeduser = JFactory::getUser();

?>
<div class="row-fluid">
<form action="<?php echo JRoute::_('index.php?option=com_profiler&view=users');?>" method="post" name="adminForm" id="adminForm">
	<fieldset id="filter-bar">
		<div class="filter-search fltlft">
			<label class="filter-search-lbl" for="filter_search"><?php echo JText::_('COM_PROFILER_USERS_SEARCH_USERS_LABEL'); ?></label>
			<input type="text" name="filter_search" id="filter_search" value="<?php echo $this->escape($this->state->get('filter.search')); ?>" title="<?php echo JText::_('COM_PROFILER_USERS_SEARCH_USERS_LABEL'); ?>" />

			<button type="submit" class=""><?php echo JText::_('JSEARCH_FILTER_SUBMIT'); ?></button>
			<button type="button" onclick="document.id('filter_search').value='';this.form.submit();"><?php echo JText::_('JSEARCH_FILTER_CLEAR'); ?></button>
		</div>
		<div class="filter-select fltrt">
			<?php echo $this->sidebar; ?>

		</div>
	</fieldset>


	<div id="j-main-container">
	<div class="clearfix"> </div>	
	<table class="table table-striped adminlist">
		<thead>
			<tr>
				<th width="1%" class="nowrap center">
					<input type="checkbox" name="checkall-toggle" value="" onclick="Joomla.checkAll(this)" />
				</th>
				<th class="left">
					<?php echo JHtml::_('grid.sort', 'COM_PROFILER_USERS_HEADING_NAME', 'p.name', $listDirn, $listOrder); ?>
				</th>
				<th class="nowrap center" width="10%">
					<?php echo JHtml::_('grid.sort', 'JGLOBAL_USERNAME', 'a.username', $listDirn, $listOrder); ?>
				</th>
				<th class="nowrap center" width="5%">
					<?php echo JHtml::_('grid.sort', 'JENABLED', 'a.block', $listDirn, $listOrder); ?>
				</th>
				<th class="nowrap center" width="5%">
					<?php echo JHtml::_('grid.sort', 'COM_PROFILER_USERS_HEADING_ACTIVATED', 'a.activation', $listDirn, $listOrder); ?>
				</th>
				<th class="nowrap center" width="10%">
					<?php echo JText::_('COM_PROFILER_USERS_HEADING_GROUPS'); ?>
				</th>
				<th class="nowrap center" width="15%">
					<?php echo JHtml::_('grid.sort', 'JGLOBAL_EMAIL', 'p.email', $listDirn, $listOrder); ?>
				</th>
				<th class="nowrap center" width="10%">
					<?php echo JHtml::_('grid.sort', 'COM_PROFILER_USERS_HEADING_LAST_VISIT_DATE', 'a.lastvisitDate', $listDirn, $listOrder); ?>
				</th>
				<th class="nowrap center" width="10%">
					<?php echo JHtml::_('grid.sort', 'COM_PROFILER_USERS_HEADING_REGISTRATION_DATE', 'p.registerDate', $listDirn, $listOrder); ?>
				</th>
				<th class="nowrap center" width="3%">
					<?php echo JHtml::_('grid.sort', 'JGRID_HEADING_ID', 'p.userid', $listDirn, $listOrder); ?>
				</th>
				<th class="nowrap center" width="3%">
					<?php echo JHtml::_('grid.sort', 'JGRID_HEADING_ID', 'p.id', $listDirn, $listOrder); ?>
				</th>
			</tr>
		</thead>
		<tfoot>
			<tr>
				<td colspan="14">
					<?php echo $this->pagination->getListFooter(); ?>
				</td>
			</tr>
		</tfoot>
		<tbody>
		<?php foreach ($this->items as $i => $item) :
			$canEdit	= $canDo->get('core.edit');
			$canChange	= $loggeduser->authorise('core.edit.state',	'com_profiler');
			$joomlauser = $item->userid == -1 ? false : true;
			// If this group is super admin and this user is not super admin, $canEdit is false
			if ((!$loggeduser->authorise('core.admin')) && JAccess::check($item->id, 'core.admin')) {
				$canEdit	= false;
				$canChange	= false;
			}
		?>
			<tr class="row<?php echo $i % 2; ?>">
				<td class="center">
					<?php if ($canEdit) : ?>
						<?php echo JHtml::_('grid.id', $i, $item->id); ?>
					<?php endif; ?>
				</td>
				<td>
					<?php if ($canEdit) : ?>
					<a href="<?php echo JRoute::_('index.php?option=com_profiler&task=user.edit&id='.(int) $item->id . '&userid='.(int) $item->userid); ?>" title="<?php echo JText::sprintf('COM_PROFILER_EDIT_USER', $item->name); ?>">
						<?php echo $this->escape($item->name); ?></a>
					<?php else : ?>
						<?php echo $this->escape($item->name); ?>
					<?php endif; ?>
					<?php if (JDEBUG && $joomlauser) : ?>
						<div class="fltrt"><div class="button2-left smallsub"><div class="blank"><a href="<?php echo JRoute::_('index.php?option=com_profiler&view=debuguser&user_id='.(int) $item->id);?>">
						<?php echo JText::_('COM_PROFILER_USERS_DEBUG_USER');?></a></div></div></div>
					<?php endif; ?>
				</td>
				<td class="center">
					<?php echo $this->escape($item->username); ?>
				</td>
				<td class="center">
				  <?php if($joomlauser) : ?>
					<?php if ($canChange) : ?>
						<?php
						$self = $loggeduser->id == $item->id;
						echo JHtml::_('jgrid.state', JHtml::_('users.blockStates', $self), $item->block, $i, 'users.', !$self);
						?>
					<?php else : ?>
						<?php echo JText::_($item->block ? 'JNO' : 'JYES'); ?>
					<?php endif; ?>
				  <?php endif; ?>
				</td>
				<td class="center">
					<?php
					if($joomlauser) :
						$activated = empty( $item->activation) ? 0 : 1;
						echo JHtml::_('jgrid.state', JHtml::_('users.activateStates'), $activated, $i, 'users.', (boolean) $activated);
					endif;
					?>
				</td>
				<td class="center">
					<?php echo nl2br($item->group_names); ?>
				</td>
				<td class="center">
					<?php echo $this->escape($item->email); ?>
				</td>
				<td class="center">
				  <?php if($joomlauser) : ?>
					<?php if ($item->lastvisitDate!='0000-00-00 00:00:00'):?>
						<?php echo JHTML::_('date',$item->lastvisitDate, 'Y-m-d H:i:s'); ?>
					<?php else:?>
						<?php echo JText::_('JNEVER'); ?>
					<?php endif;?>
				  <?php endif;?>
				</td>
				<td class="center">
					<?php echo JHTML::_('date',$item->registerDate, 'Y-m-d H:i:s'); ?>
				</td>
				<td class="center">
					<?php echo ((int) $item->userid) == -1 ? "-": (int) $item->userid  ; ?>
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
