<?php
/**
 * @package Profiler Fields for Joomla! 2.5
 * @version $Id: view.html.php 17 2013-01-09 22:44:15Z harold $
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

class PffieldsViewField extends JViewLegacy
{
	protected $form;
	protected $item;
	protected $state;

	public function display($tpl = null)
	{
		// Initialiase variables.
		$this->form		= $this->get('Form');
		$this->item		= $this->get('Item');
		$this->state	= $this->get('State');
		$this->canDo	= PffieldsHelper::getActions();

		// Check for errors.
		if (count($errors = $this->get('Errors'))) {
			JError::raiseError(500, implode("\n", $errors));
			return false;
		}

		$this->addToolbar();
		parent::display($tpl);
	}

	protected function addToolbar()
	{
		JRequest::setVar('hidemainmenu', true);

		$user		= JFactory::getUser();
		$userId		= $user->get('id');
		$isNew		= ($this->item->id == 0);
		$canDo		= PffieldsHelper::getActions();

		JToolBarHelper::title($isNew ? JText::_('COM_PFFIELDS_VIEW_NEW_FIELD_TITLE') : JText::_('COM_PFFIELDS_VIEW_EDIT_FIELD_TITLE'), 'cpanel');

		if ($canDo->get('core.edit') || $canDo->get('core.create')) {
			JToolBarHelper::apply('field.apply', 'JTOOLBAR_APPLY');
			JToolBarHelper::save('field.save', 'JTOOLBAR_SAVE');

			if ($canDo->get('core.create')) {
				JToolBarHelper::custom('field.save2new', 'save-new.png', 'save-new_f2.png', 'JTOOLBAR_SAVE_AND_NEW', false);
			}
		}

		if (!$isNew && $canDo->get('core.create')) {
			JToolBarHelper::custom('field.save2copy', 'save-copy.png', 'save-copy_f2.png', 'JTOOLBAR_SAVE_AS_COPY', false);
		}

		if (empty($this->item->id))  {
			JToolBarHelper::cancel('field.cancel','JTOOLBAR_CANCEL');
		}
		else {
			JToolBarHelper::cancel('field.cancel', 'JTOOLBAR_CLOSE');
		}
	}
}
