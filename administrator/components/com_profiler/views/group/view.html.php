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
defined('_JEXEC') or die;

jimport('joomla.application.component.view');

class ProfilerViewGroup extends JViewLegacy
{
	protected $form;
	protected $item;
	protected $state;
	
	protected $fieldsets;
	
	protected $view_position;
	protected $view_labels;
	

	public function display($tpl = null)
	{
		
		$this->form			= $this->get('Form');
		$this->item			= $this->get('Item');
		$this->state		= $this->get('State');
		
		$this->fieldsets	= $this->form->getFieldsets();

		// Check for errors.
		if (count($errors = $this->get('Errors'))) {
			JError::raiseError(500, implode("\n", $errors));
			return false;
		}
		
		
		parent::display($tpl);
		$this->addToolbar();
	}

	public function loadTemplate($tpl = null, $position = null, $labels = true) {
	
		$this->view_position = $position;
		$this->view_labels = $labels;
	
		return parent::loadTemplate($tpl);
	
	}
	
	protected function addToolbar()
	{
		JRequest::setVar('hidemainmenu', 1);

		$isNew		= ($this->item->groupid == 0);
		$canDo		= ProfilerHelper::getActions();
		
		
		JToolBarHelper::title(JText::_($isNew ? 'COM_PROFILER_VIEW_NEW_GROUP_TITLE' : 'COM_PROFILER_VIEW_EDIT_GROUP_TITLE'), 'groups-add');
		if ($canDo->get('core.edit')||$canDo->get('core.edit.own')||$canDo->get('core.create')) {
			JToolBarHelper::apply('group.apply','JTOOLBAR_APPLY');
			JToolBarHelper::save('group.save','JTOOLBAR_SAVE');
		}
		if ($canDo->get('core.create')&&$canDo->get('core.manage')) {			
			JToolBarHelper::custom('group.save2new', 'save-new.png', 'save-new_f2.png', 'JTOOLBAR_SAVE_AND_NEW', false);
		}
		if (empty($this->item->id))  {
			JToolBarHelper::cancel('group.cancel','JTOOLBAR_CANCEL');
		} else {
			JToolBarHelper::cancel('group.cancel', 'JTOOLBAR_CLOSE');
		}

		JToolBarHelper::divider();
		$url = "http://www.haroldprins.nl/wiki/index.php?title=Profiler";
		JToolBarHelper::help("", "", $url);
		
	}
	

}
