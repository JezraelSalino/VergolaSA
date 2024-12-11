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

class ProfilerViewGroups extends JViewLegacy
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

		$this->addToolbar();
		$this->sidebar = JHtmlSidebar::render();
		parent::display($tpl);
	}

	protected function addToolbar()
	{
		require_once JPATH_COMPONENT.'/helpers/profiler.php';

		$canDo	= ProfilerHelper::getActions();

		JToolBarHelper::title(JText::_('COM_PROFILER_VIEW_GROUPS_TITLE'), 'groups');

		if ($canDo->get('core.create')) {
			JToolBarHelper::addNew('group.add','JTOOLBAR_NEW');
		}

		if ($canDo->get('core.edit')) {
			JToolBarHelper::custom('group.edit', 'edit.png', 'edit_f2.png','JTOOLBAR_EDIT', true);
		}

		if ($canDo->get('core.edit.state')) {
			JToolBarHelper::divider();
			JToolBarHelper::custom('groups.block', 'unpublish.png', 'unpublish_f2.png', 'COM_PROFILER_TOOLBAR_BLOCK', true);
			JToolBarHelper::custom('groups.unblock', 'unblock.png', 'unblock_f2.png', 'COM_PROFILER_TOOLBAR_UNBLOCK', true);
			JToolBarHelper::divider();
		}
		
		if ($canDo->get('core.delete')) {
			JToolBarHelper::deleteList('', 'groups.delete','JTOOLBAR_DELETE');
			JToolBarHelper::divider();
		}
		
		if ($canDo->get('core.admin')) {
			JToolBarHelper::preferences('com_profiler');
		}
		
		JToolBarHelper::divider();
		$url = "http://www.haroldprins.nl/wiki/index.php?title=Profiler";
		JToolBarHelper::help("", "", $url);
		
	}
}
