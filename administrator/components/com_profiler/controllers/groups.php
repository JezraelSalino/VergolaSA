<?php
/**
 * @package Profiler for Joomla! 2.5
 * @version $Id: groups.php 31 2013-01-09 22:33:43Z harold $
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

jimport('joomla.application.component.controlleradmin');

class ProfilerControllerGroups extends JControllerAdmin
{
	protected $text_prefix = 'COM_PROFILER_GROUPS';

	public function __construct($config = array())
	{
		parent::__construct($config);
		
		$this->registerTask('block',		'changeBlock');
		$this->registerTask('unblock',		'changeBlock');
	}
	
	public function getModel($name = 'Group', $prefix = 'ProfilerModel', $config = array('ignore_request' => true))
	{
		return parent::getModel($name, $prefix, $config);
	}

	public function changeBlock()
	{
		// Check for request forgeries.
		JRequest::checkToken() or jexit(JText::_('JINVALID_TOKEN'));

		// Initialise variables.
		$ids	= JRequest::getVar('cid', array(), '', 'array');
		$values	= array('block' => 1, 'unblock' => 0);
		$task	= $this->getTask();
		$value	= JArrayHelper::getValue($values, $task, 0, 'int');

		if (empty($ids)) {
			JError::raiseWarning(500, JText::_('COM_PROFILER_GROUPS_NO_ITEM_SELECTED'));
		} else {
			// Get the model.
			$model = $this->getModel();

			// Change the state of the records.
			if (!$model->block($ids, $value)) {
				JError::raiseWarning(500, $model->getError());
			} else {
				if ($value == 1){
					$this->setMessage(JText::plural('COM_PROFILER_N_GROUPS_BLOCKED', count($ids)));
				} else if ($value == 0){
					$this->setMessage(JText::plural('COM_PROFILER_N_GROUPS_UNBLOCKED', count($ids)));
				}
			}
		}

		$this->setRedirect('index.php?option=com_profiler&view=groups');
	}
	
	public function activate()
	{
		JRequest::checkToken() or jexit(JText::_('JINVALID_TOKEN'));

		$ids	= JRequest::getVar('cid', array(), '', 'array');

		if (empty($ids)) {
			JError::raiseWarning(500, JText::_('COM_PROFILER_USERS_NO_ITEM_SELECTED'));
		} else {
			$model = $this->getModel();

			// Change the state of the records.
			if (!$model->activate($ids)) {
				JError::raiseWarning(500, $model->getError());
			} else {
				$this->setMessage(JText::plural('COM_PROFILER_N_USERS_ACTIVATED', count($ids)));
			}
		}

		$this->setRedirect('index.php?option=com_profiler&view=users');
	}


}
