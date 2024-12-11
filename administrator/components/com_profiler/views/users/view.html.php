<?php
/**
 * @package Profiler for Joomla! 2.5
 * @version $Id: view.html.php 31 2013-01-09 22:33:43Z harold $
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
// No direct access
defined('_JEXEC') or die;

class ProfilerViewUsers extends JViewLegacy
{
	protected $items;
	
	protected $pagination;
	
	protected $state;

	public function display($tpl = null)
	{
		// Initialise variables.
		$this->items		= $this->get('Items');
		$this->pagination	= $this->get('Pagination');
		$this->state		= $this->get('State');


		// Check for errors.
		if (count($errors = $this->get('Errors'))) {
			JError::raiseError(500, implode("\n", $errors));
			return false;
		}
		
		// Include the component HTML helpers.
		JHtml::addIncludePath(JPATH_COMPONENT . '/helpers/html');
		
		$this->addToolbar();
		$this->sidebar = JHtmlSidebar::render();
		parent::display($tpl);
	}

	protected function addToolbar()
	{
		//require_once JPATH_COMPONENT.'/helpers/profiler.php';

		$canDo	= ProfilerHelper::getActions();
		$config = JComponentHelper::getParams('com_profiler');

		JToolBarHelper::title(JText::_('COM_PROFILER_VIEW_USERS_TITLE'), 'user');

		if ($canDo->get('core.create')) {
			JToolBarHelper::addNew('user.add');
		}

		if ($canDo->get('core.edit')) {
			JToolbarHelper::editList('user.edit');
			//JToolBarHelper::custom('user.edit', 'edit.png', 'edit_f2.png','JTOOLBAR_EDIT', true);
		}

		if ($canDo->get('core.edit.state')) {
			JToolBarHelper::divider();
			JToolBarHelper::publish('users.activate', 'COM_PROFILER_TOOLBAR_ACTIVATE', true);
			JToolBarHelper::unpublish('users.block', 'COM_PROFILER_TOOLBAR_BLOCK', true);
			JToolBarHelper::custom('users.unblock', 'unblock.png', 'unblock_f2.png', 'COM_PROFILER_TOOLBAR_UNBLOCK', true);
			JToolBarHelper::divider();
		}
		
		if ($canDo->get('core.admin')) {
			//JToolBarHelper::custom('user.synchronize', 'copy.png', 'copy_f2.png', 'COM_PROFILER_TOOLBAR_SYNCHRONIZE', false);
			JToolBarHelper::custom('user.import', 'upload.png', 'upload_f2.png', 'COM_PROFILER_TOOLBAR_IMPORT', false);
			JToolBarHelper::divider();
			if ($config->get('allowNonJoomlaUsers') == true) {
				JToolBarHelper::custom('users.makejoomla', 'user.png', 'user_f2.png', 'COM_PROFILER_TOOLBAR_ADDJUSER', false);
				JToolBarHelper::custom('users.deletejoomla', 'user.png', 'user_f2.png', 'COM_PROFILER_TOOLBAR_DELJUSER', false);
			}
			JToolBarHelper::divider();
		}

		if ($canDo->get('core.delete')) {
			JToolbarHelper::deleteList('', 'users.delete');
			JToolBarHelper::divider();
		}
		
	
		if ($canDo->get('core.admin')) {
			JToolBarHelper::preferences('com_profiler');
		}
		
		JToolBarHelper::divider();
		$url = "http://www.haroldprins.nl/wiki/index.php?title=Profiler";
		JToolBarHelper::help("", "", $url);
		
		
		JHtmlSidebar::setAction('index.php?option=com_profiler&view=users');
		
		JHtmlSidebar::addFilter(
			JText::_('COM_PROFILER_USERS_FILTER_STATE'),
			'filter_state',
			JHtml::_('select.options', ProfilerHelper::getStateOptions(), 'value', 'text', $this->state->get('filter.state'))
		);

		JHtmlSidebar::addFilter(
			JText::_('COM_PROFILER_USERS_FILTER_ACTIVE'),
			'filter_active',
			JHtml::_('select.options', ProfilerHelper::getActiveOptions(), 'value', 'text', $this->state->get('filter.active'))
		);

		JHtmlSidebar::addFilter(
			JText::_('COM_PROFILER_USERS_FILTER_USERGROUP'),
			'filter_group_id',
			JHtml::_('select.options', ProfilerHelper::getGroups(), 'value', 'text', $this->state->get('filter.group_id'))
		);

//		JHtmlSidebar::addFilter(
//			JText::_('COM_USERS_OPTION_FILTER_DATE'),
//			'filter_range',
//			JHtml::_('select.options', ProfilerHelper::getRangeOptions(), 'value', 'text', $this->state->get('filter.range'))
//		);
	}
}
