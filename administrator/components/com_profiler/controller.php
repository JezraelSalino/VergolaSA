<?php
/**
 * @package Profiler for Joomla! 2.5
 * @version $Id: controller.php 31 2013-01-09 22:33:43Z harold $
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

jimport('joomla.application.component.controller');

class ProfilerController extends JControllerLegacy
{
	protected function canView($view)
	{
		$canDo	= ProfilerHelper::getActions();

		switch ($view)
		{
			// Special permissions.
			case 'users':
				return $canDo->get('core.admin');
				break;

			// Default permissions.
			default:
				return true;
		}
	}
	
	
	public function display($cachable = false, $urlparams = false)
	{
		require_once JPATH_COMPONENT.'/helpers/profiler.php';

		// Load the submenu.
		ProfilerHelper::addSubmenu(JRequest::getCmd('view', 'users'));

		$vName	= JRequest::getCmd('view', 'profiler');
		$lName = JRequest::getCmd('layout', 'default');
		$mName = '';
		$id		= JRequest::getInt('id');

		
		// Check permission
		if (!$this->canView($vName)) {
			JError::raiseWarning(404, JText::_('JERROR_ALERTNOAUTHOR'));
		}
		
		// Check for edit form.
		if ($vName == 'field' && $lName == 'edit' && !$this->checkEditId('com_profiler.edit.field', $id)) {

			// Somehow the person just went to the form - we don't allow that.
			$this->setError(JText::sprintf('JLIB_APPLICATION_ERROR_UNHELD_ID', $id));
			$this->setMessage($this->getError(), 'error');
			$this->setRedirect(JRoute::_('index.php?option=com_profiler&view=fields', false));

			return false;
		} elseif ($vName == 'profile' && $lName == 'edit' && !$this->checkEditId('com_profiler.edit.profileedit', $id)) {
			// Somehow the person just went to the form - we don't allow that.
			$this->setError(JText::sprintf('JLIB_APPLICATION_ERROR_UNHELD_ID', $id));
			$this->setMessage($this->getError(), 'error');
			$this->setRedirect(JRoute::_('index.php?option=com_profiler&view=profiles', false));
			
			return false;
		}

		switch ($vName)
		{
			case 'profile':
				$mName = 'profile' . $lName;
				break;
				
			case 'profiler':
				$vName = "users";
				JRequest::setVar('view', $vName);
				break;
		}
		
		$document = JFactory::getDocument();
		$vType		= $document->getType();

		// Get/Create the view
		$view = $this->getView($vName, $vType, '', array('base_path' => $this->basePath, 'layout' => $lName));
		
		
		// Get/Create the model
		if ($model = $this->getModel($mName)) {
			// Push the model into the view (as default)
			$view->setModel($model, true);
		}
		

		
		parent::display();

		return $this;
	}


}
