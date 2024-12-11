<?php
/**
 * @package Profiler for Joomla! 2.5
 * @version $Id: fields.php 32 2013-01-12 21:42:54Z harold $
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

$user		= JFactory::getUser();
$userId		= $user->get('id');
$listOrder	= $this->state->get('list.ordering');
$listDirn	= $this->state->get('list.direction');

?>

<form action="<?php echo JRoute::_('index.php?option=com_profiler&view=profile');?>" method="post" name="adminForm" id="adminForm">

	<table class="adminlist">
		<thead>
			<tr>
				<th width="1%">
					<input type="checkbox" name="checkall-toggle" value="" onclick="checkAll(this)" />
				</th>
				<th width="10%">
					<?php echo JText::_('COM_PROFILER_FIELDS_HEADING_NAME'); ?>
				</th>
				<th width="10%">
					<?php echo JText::_('COM_PROFILER_FIELDS_HEADING_TITLE'); ?>
				</th>
				<th width="10%">
					<?php echo JText::_('COM_PROFILER_FIELDS_HEADING_TYPE'); ?>
				</th>
				<th width="5%">
					<?php echo JText::_('JCATEGORY'); ?>
				</th>
				<th width="1%">
					<?php echo JText::_('JGRID_HEADING_ORDERING'); ?>
				</th>
				<th width="1%">
					<?php echo JText::_('COM_PROFILER_PROFILE_HEADING_PUBLISHED'); ?>
				</th>
				<th width="1%">
					<?php echo JText::_('COM_PROFILER_PROFILE_HEADING_READONLY'); ?>
				</th>
				<th width="1%">
					<?php echo JText::_('COM_PROFILER_PROFILE_HEADING_READACCESS'); ?>
				</th>
				<th width="1%">
					<?php echo JText::_('COM_PROFILER_PROFILE_HEADING_READACCESSPRIVATE'); ?>
				</th>
				<th width="1%">
					<?php echo JText::_('COM_PROFILER_PROFILE_HEADING_EDITACCESS'); ?>
				</th>
				<th width="1%">
					<?php echo JText::_('COM_PROFILER_PROFILE_HEADING_EDITACCESSPRIVATE'); ?>
				</th>
				<th width="1%">
					<?php echo JText::_('COM_PROFILER_PROFILE_HEADING_REGISTERACCESS'); ?>
				</th>
				<th width="1%">
					<?php echo JText::_('COM_PROFILER_PROFILE_HEADING_REQUIRED'); ?>
				</th>
				<th width="1%">
					<?php echo JText::_('COM_PROFILER_PROFILE_HEADING_REGISTRATION'); ?>
				</th>
				<th width="1%" class="nowrap">
					<?php echo JHtml::_('grid.sort',  'FID', 'fid', $listDirn, $listOrder); ?>
				</th>
				<th width="1%" class="nowrap">
					<?php echo JText::_('JGRID_HEADING_ID'); ?>
				</th>
			</tr>
		</thead>
		<tfoot>
			<tr>
				<td colspan="17">
					<?php echo $this->pagination->getListFooter(); ?>
				</td>
			</tr>
		</tfoot>
		<tbody>
		<?php 

		$options = array();
		$options[] = JHtml::_('select.option', '0', JText::_("COM_PROFILER_GLOBAL"), 'value', 'text', false);
		$publishoptions = array();
		$publishoptions[] = JHtml::_('select.option', '2', JText::_("COM_PROFILER_GLOBAL"), 'value', 'text', false);
		$publishoptions[] = JHtml::_('select.option', '1', JText::_("JYES"), 'value', 'text', false);
		$publishoptions[] = JHtml::_('select.option', '0', JText::_("JNO"), 'value', 'text', false);
		
		
		foreach ($this->items as $i => $item) :
			$canEdit	= $user->authorise('core.edit',			'com_profiler');
			$canChange	= $user->authorise('core.edit.state',	'com_profiler');
			
			
		?>

			<tr class="row<?php echo $i % 2; ?>">
				<td class="center">
					<?php echo JHtml::_('grid.id', $i, $item->id); ?>
				</td>
				<td>
					<?php echo $this->escape($item->name); ?>
				</td>
				<td class="center">
					<?php echo JText::_($item->title);?>
				</td>
				<td class="center">
					<?php echo $item->type;?>
				</td>
				<td class="center">
					<?php echo $this->escape($item->category_title); ?>
				</td>
				<td class="order">
					<?php echo $item->ordering; ?>
				</td>
				<td class="center">
					<?php echo JHtml::_('select.genericlist', $publishoptions, 'published[]',
							array(
									'list.select' => $item->published,
									'id' => 'cb'.$i
							)
							);
					?>
				</td>
				<td class="center">
					<?php echo JHtml::_('select.genericlist', $publishoptions, 'readonly[]',
							array(
									'list.select' => $item->readonly,
									'id' => 'cb'.$i
							)
							);
					?>
				</td>
				<td class="center">
					<?php echo JHtml::_('access.level', 'accessro[]', $item->accessro, '', $options, 'cb'.$i); ?>
				</td>
				<td class="order">
					<?php echo JHtml::_('select.genericlist', $publishoptions, 'accessroprivate[]',
							array(
									'list.select' => $item->accessroprivate,
									'id' => 'cb'.$i
							)
							);
					?>
				</td>
				<td class="center">
					<?php echo JHtml::_('access.level', 'access[]', $item->access, '', $options, 'cb'.$i); ?>
				</td>
				<td class="order">
					<?php echo JHtml::_('select.genericlist', $publishoptions, 'accessprivate[]',
							array(
									'list.select' => $item->accessprivate,
									'id' => 'cb'.$i
							)
							);
					?>				
				</td>
				<td class="center">
					<?php echo JHtml::_('access.level', 'accessreg[]', $item->accessreg, '', $options, 'cb'.$i); ?>
				</td>
				<td class="center">
					<?php echo JHtml::_('select.genericlist', $publishoptions, 'required[]',
							array(
									'list.select' => $item->required,
									'id' => 'cb'.$i
							)
							);
					?>

				</td>
				<td class="center">
					<?php echo JHtml::_('select.genericlist', $publishoptions, 'registration[]',
							array(
									'list.select' => $item->registration,
									'id' => 'cb'.$i
							)
							);
					?>

				</td>
				<td class="center">
					<?php echo isset($item->fid) ? (int) $item->fid : "(new)"; ?> <input type="hidden" name="id[]" value="<?php echo $item->fid ?>" />
				</td>
				<td class="center">
					<?php echo $item->field_id; ?><input type="hidden" name="fieldid[]" value="<?php echo $item->field_id ?>" />
				</td>
			</tr>
			<?php endforeach; ?>
		</tbody>
	</table>

	<div>
		<input type="hidden" name="profile" value="<?php echo JRequest::getInt('profile'); ?>" />
		<input type="hidden" name="task" value="" />
		<input type="hidden" name="boxchecked" value="0" />
		<input type="hidden" name="layout" value="fields" />
		<?php echo JHtml::_('form.token'); ?>
	</div>
<div class="clr"></div>
</form>
<p class="copyright" align="center">
	<span class="version"><?php echo JText::_('COM_PROFILER_COPYRIGHT'); ?></span>
</p>
