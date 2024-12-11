<?php
/**
 * @package Profiler Fields for Joomla! 2.5
 * @version $Id: controller.php 17 2013-01-09 22:44:15Z harold $
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
jimport('joomla.application.component.controller');

class PffieldsController extends JControllerLegacy
{
	
	protected $extension;
	protected $prefix;
	
	public function __construct($config = array())
	{
		parent::__construct($config);

		// Guess the JText message prefix. Defaults to the option.
		if (empty($this->extension)) {
			$this->extension = JRequest::getCmd('extension', 'com_pffields');
			$this->prefix = JRequest::getCmd('prefix', '');
			JRequest::setVar($this->extension, 'com_pffields');
		}
	}
	
	public function display($cachable = false, $urlparams = false)
	{
		require_once JPATH_COMPONENT.'/helpers/pffields.php';
		
		$vName	= JRequest::getCmd('view', 'fields');
		$lName = JRequest::getCmd('layout', 'default');
		$id		= JRequest::getInt('id');
		

		// Load the submenu.
		if($this->extension == 'com_pffields') {
			$this->default_view = 'panel';
		} else {
			$this->default_view = 'fields';
		}
		PffieldsHelper::addSubmenu(JRequest::getCmd('view', 'fields').JRequest::getCmd('prefix', ''), $this->extension);
		
		
		// Check for edit form.
		if ($vName == 'field' && $lName == 'edit' && !$this->checkEditId('com_pffields.edit.field', $id)) {

			// Somehow the person just went to the form - we don't allow that.
			$this->setError(JText::sprintf('JLIB_APPLICATION_ERROR_UNHELD_ID', $id));
			$this->setMessage($this->getError(), 'error');
			$this->setRedirect(JRoute::_('index.php?option=com_pffields&view=fields&extension=' . $this->extension . '&prefix=' . $this->prefix, false));

			return false;
		} 
		
		parent::display();

		return $this;
		
	}
	
}
