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
// no direct access
defined('_JEXEC') or die;

// Load the tooltip behavior.
JHtml::addIncludePath(JPATH_COMPONENT.'/helpers/html');
//JHtml::_('bootstrap.tooltip');
JHtml::_('behavior.multiselect');
//JHtml::_('formbehavior.chosen', 'select');

//JHTML::_('script','system/multiselect.js',false,true);

$user		= JFactory::getUser();
$userId		= $user->get('id');
$listOrder = $this->escape($this->state->get('list.ordering'));
$listDirn = $this->escape($this->state->get('list.direction'));
$canOrder	= $user->authorise('core.edit.state', 'com_pffields');
$saveOrder	= $listOrder=='a.ordering';
if ($saveOrder)
{
	$saveOrderingUrl = 'index.php?option=com_pffields&task=categories.saveOrderAjax&tmpl=component';
//	JHtml::_('sortablelist.sortable', 'categoryList', 'adminForm', strtolower($listDirn), $saveOrderingUrl);
}

?>
<div class="row-fluid">
<form action="<?php echo JRoute::_('index.php?option=com_pffields&view=categories'); ?>" method="post" name="adminForm" id="adminForm">
	<fieldset id="filter-bar">
		<div class="filter-search fltlft">
			<label class="filter-search-lbl" for="filter_search"><?php echo JText::_('JSEARCH_FILTER_LABEL'); ?></label>
			<input type="text" name="filter_search" id="filter_search" value="<?php echo $this->escape($this->state->get('filter.search')); ?>" title="<?php echo JText::_('JSEARCH_FILTER_LABEL'); ?>" />

			<button type="submit" class=""><?php echo JText::_('JSEARCH_FILTER_SUBMIT'); ?></button>
			<button type="button" onclick="document.id('filter_search').value='';this.form.submit();"><?php echo JText::_('JSEARCH_FILTER_CLEAR'); ?></button>
		</div>
		<div class="filter-select fltrt">
			<?php echo $this->sidebar; ?>

		</div>
	</fieldset>
	
	<div id="j-main-container">
	<?php //if($this->extension == 'com_profiler') :?>
		<p class="alert"><?php echo JText::_('COM_PFFIELDS_CATEGORIES_EXPLAIN'); ?></p>
	<?php //endif;?>
	<div class="clearfix"> </div>	

	<table class="table table-striped adminlist" id="categoryList">
		<thead>
			<tr>
				<th width="1%" class="nowrap center hidden-phone">
					<?php echo JHtml::_('grid.sort', '<i class="icon-menu-2"></i>', 'a.ordering', $listDirn, $listOrder, null, 'asc', 'JGRID_HEADING_ORDERING'); ?>
				</th>
				<th width="1%" class="hidden-phone">
					<input type="checkbox" name="checkall-toggle" value="" title="<?php echo JText::_('JGLOBAL_CHECK_ALL'); ?>" onclick="Joomla.checkAll(this)" />
				</th>
				<th  class="title">
					<?php echo JHtml::_('grid.sort',  'COM_PFFIELDS_CATEGORIES_HEADING_TITLE', 'a.title', $listDirn, $listOrder); ?>
				</th>
				<th  class="title">
					<?php echo JHtml::_('grid.sort', 'COM_PFFIELDS_CATEGORIES_HEADING_ALIAS', 'a.alias', $listDirn, $listOrder); ?>
				</th>
				<th  class="title">
					<?php echo JHtml::_('grid.sort', 'COM_PFFIELDS_CATEGORIES_HEADING_TYPE', 'a.type', $listDirn, $listOrder); ?>
				</th>
				<th  class="title">
					<?php echo JHtml::_('grid.sort', 'COM_PFFIELDS_CATEGORIES_HEADING_TEMPLATE', 'a.template', $listDirn, $listOrder); ?>
				</th>
				
				<th width="1%" class="nowrap center hidden-phone">
					<?php echo JHtml::_('grid.sort', 'JGRID_HEADING_ID', 'id', $listDirn, $listOrder); ?>
				</th>
			</tr>
		</thead>
		<tfoot>
			<tr>
				<td colspan="12">
					<?php echo $this->pagination->getListFooter(); ?>
				</td>
			</tr>
		</tfoot>
		<tbody>
		<?php foreach ($this->items as $i => $item) :
			$ordering	= ($listOrder == 'a.ordering');

			$canCreate	= $user->authorise('core.create',		'com_pffields');
			$canEdit	= $user->authorise('core.edit',			'com_pffields');
			$canChange	= $user->authorise('core.edit.state',	'com_pffields');
			?>
			<tr class="row<?php echo $i % 2; ?>">
				<td class="order nowrap center hidden-phone">
					<?php if ($canChange) :
						$disableClassName = '';
						$disabledLabel	  = '';
						if (!$saveOrder) :
							$disabledLabel    = JText::_('JORDERINGDISABLED');
							$disableClassName = 'inactive tip-top';
						endif; ?>
						<span class="sortable-handler hasTooltip <?php echo $disableClassName?>" title="<?php echo $disabledLabel?>">
							<i class="icon-menu"></i>
						</span>
						<input type="text" style="display:none" name="order[]" size="5" value="<?php echo $item->ordering;?>" class="width-20 text-area-order " />
					<?php else : ?>
						<span class="sortable-handler inactive" >
							<i class="icon-menu"></i>
						</span>
					<?php endif; ?>
				</td>
				<td class="center hidden-phone">
					<?php echo JHtml::_('grid.id', $i, $item->id); ?>
				</td>
				<td class="nowrap">
					<?php if ($canEdit) : ?>
						<a href="<?php echo JRoute::_('index.php?option=com_pffields&task=category.edit&extension='.JRequest::getVar("extension", "pffields").'&prefix='.JRequest::getVar("prefix", "").'&id='.(int) $item->id); ?>">
							<?php echo $this->escape($item->title); ?></a>
					<?php else : ?>
						<?php echo $this->escape($item->title); ?>
					<?php endif; ?>
				</td>
				<td class="nowrap">
					<?php echo JText::_($item->alias);?>
				</td>
				<td class="nowrap">
					<?php echo JText::_($item->type);?>
				</td>
				<td class="nowrap">
					<?php echo JText::_($item->template);?>
				</td>
				<td class="center hidden-phone">
					<?php echo $item->id; ?>
				</td>
			</tr>
			<?php endforeach; ?>
		</tbody>
	</table>

	<div>
		<input type="hidden" name="extension" value="<?php echo JRequest::getVar("extension", "pffields");?>" />
		<input type="hidden" name="prefix" value="<?php echo JRequest::getVar("prefix", "");?>" />
		<input type="hidden" name="task" value="" />
		<input type="hidden" name="boxchecked" value="0" />
		<input type="hidden" name="filter_order" value="<?php echo $listOrder; ?>" />
		<input type="hidden" name="filter_order_Dir" value="<?php echo $listDirn; ?>" />
		<?php echo JHtml::_('form.token'); ?>
	</div>
</form>
<p class="copyright" align="center">
	<span class="version"><?php echo JText::_('COM_PFFIELDS_COPYRIGHT'); ?></span>
</p>
</div>
