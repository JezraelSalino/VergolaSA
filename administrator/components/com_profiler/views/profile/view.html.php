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

jimport('joomla.application.component.view');

class ProfilerViewProfile extends JViewLegacy
{
	protected $categories;
	protected $items;
	protected $pagination;
	protected $state;


	public function display($tpl = null)
	{
		
		$layout   = JRequest::getCmd( 'layout', 'default' );

		switch ($layout)
		{
			case 'fields':
				$this->fields($tpl);
				break;
			case 'categories':
				$this->categories($tpl);
				break;
			default:
				$this->displaydefault($tpl);
		}
		
	}
	
	private function displaydefault($tpl = null)
	{
		// Initialiase variables.
		$this->form		= $this->get('Form');
		$this->item		= $this->get('Item');
		$this->state	= $this->get('State');

		// Check for errors.
		if (count($errors = $this->get('Errors'))) {
			JError::raiseError(500, implode("\n", $errors));
			return false;
		}

		$this->addToolbarDefault();
		parent::display($tpl);
	}
	
	protected function addToolbarDefault()
	{
		JRequest::setVar('hidemainmenu', true);
		
		$canDo		= ProfilerHelper::getActions();

		JToolBarHelper::title(JText::_('COM_PROFILER_VIEW_EDIT_PROFILE_TITLE'), 'cpanel');

		if ($canDo->get('core.edit') || $canDo->get('core.create')) {
			JToolBarHelper::apply('profile.apply', 'JTOOLBAR_APPLY');
			JToolBarHelper::save('profile.save', 'JTOOLBAR_SAVE');
		}
		JToolBarHelper::cancel('profile.cancel', 'JTOOLBAR_CLOSE');

		JToolBarHelper::divider();
		$url = "http://www.haroldprins.nl/wiki/index.php?title=Profiler";
		JToolBarHelper::help("", "", $url);
		
	}
		
	private function categories($tpl = null)
	{
		// Initialise variables.
		$this->items		= $this->get('Items');
		$this->pagination	= $this->get('Pagination');
		$this->state		= $this->get('State');
		
		// Style sheet
		$document = JFactory::getDocument();
		$document->addStyleSheet(JURI::base(true).'/components/com_profiler/assets/css/profiler.css');		
		// Check for errors.
		if (count($errors = $this->get('Errors'))) {
			JError::raiseError(500, implode("\n", $errors));
			return false;
		}
		$this->addToolbarCategories();
		parent::display($tpl);
	}
	
	protected function addToolbarCategories()
	{
		JRequest::setVar('hidemainmenu', true);
		
		$canDo		= ProfilerHelper::getActions();

		JToolBarHelper::title(JText::_('COM_PROFILER_VIEW_EDIT_PROFILECATEGORIES_TITLE'), 'cpanel');

		if ($canDo->get('core.edit') || $canDo->get('core.create')) {
			JToolBarHelper::apply('profile.applyCategory', 'JTOOLBAR_APPLY');
			JToolBarHelper::save('profile.saveCategory', 'JTOOLBAR_SAVE');
			JToolBarHelper::divider();
			JToolBarHelper::trash('profile.removeCategory', 'COM_PROFILER_TOOLBAR_RESET', false);
		}
		JToolBarHelper::divider();
		JToolBarHelper::cancel('profile.cancel', 'JTOOLBAR_CLOSE');
		
		JToolBarHelper::divider();
		$url = "http://www.haroldprins.nl/wiki/index.php?title=Profiler";
		JToolBarHelper::help("", "", $url);
		

	}
	
	private function fields($tpl = null)
	{
		// Initialise variables.
		$this->categories	= $this->get('CategoryOrders');
		$this->items		= $this->get('Items');
		$this->pagination	= $this->get('Pagination');
		$this->state		= $this->get('State');


		// Style sheet
		$document = JFactory::getDocument();
		$document->addStyleSheet(JURI::base(true).'/components/com_profiler/assets/css/profiler.css');		
		
		// Check for errors.
		if (count($errors = $this->get('Errors'))) {
			JError::raiseError(500, implode("\n", $errors));
			return false;
		}

		$this->addToolbarFields();
		parent::display($tpl);
	}

	protected function addToolbarFields()
	{
		JRequest::setVar('hidemainmenu', true);
		
		$canDo		= ProfilerHelper::getActions();

		JToolBarHelper::title(JText::_('COM_PROFILER_VIEW_EDIT_PROFILEFIELDS_TITLE'), 'cpanel');

		if ($canDo->get('core.edit') || $canDo->get('core.create')) {
			JToolBarHelper::apply('profile.applyField', 'JTOOLBAR_APPLY');
			JToolBarHelper::save('profile.saveField', 'JTOOLBAR_SAVE');
			JToolBarHelper::divider();
			JToolBarHelper::trash('profile.removeField', 'COM_PROFILER_TOOLBAR_RESET', false);
		}
		JToolBarHelper::cancel('profile.cancel', 'JTOOLBAR_CLOSE');
		
		JToolBarHelper::divider();
		$url = "http://www.haroldprins.nl/wiki/index.php?title=Profiler";
		JToolBarHelper::help("", "", $url);
		

	}
}
