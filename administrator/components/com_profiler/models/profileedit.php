<?php
/**
 * @package Profiler for Joomla! 2.5
 * @version $Id: profileedit.php 32 2013-01-12 21:42:54Z harold $
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

jimport('joomla.application.component.modeladmin');

class ProfilerModelProfileedit extends JModelAdmin
{
	protected $text_prefix = 'COM_PROFILER_PROFILE';
	
	protected function canDelete($record)
	{
		$user = JFactory::getUser();

		return $user->authorise('core.delete', 'com_profiler');

	}

	protected function canEditState($record)
	{
		$user = JFactory::getUser();

		return $user->authorise('core.edit.state', 'com_profiler');

	}

	public function getTable($type = 'Profile', $prefix = 'ProfilerTable', $config = array())
	{
		return JTable::getInstance($type, $prefix, $config);
	}

	public function getForm($data = array(), $loadData = true)
	{
		// Get the form.
		$form = $this->loadForm('com_profiler.profile', 'profile', array('control' => 'jform', 'load_data' => $loadData));
		if (empty($form)) {
			return false;
		}
		
		
		if ($this->getState('profileedit.id') != 1) {
			$form->setFieldAttribute('access', 'inherited', 'true');
			$form->setFieldAttribute('deleteaccess', 'inherited', 'true');
			$form->setFieldAttribute('readaccess', 'inherited', 'true');
			$form->setFieldAttribute('registeraccess', 'inherited', 'true');
			$form->setFieldAttribute('accessprivate', 'inherited', 'true');
			$form->setFieldAttribute('accessroprivate', 'inherited', 'true');
		}
		return $form;
	}

	protected function loadFormData()
	{
		// Check the session for previously entered form data.
		$data = JFactory::getApplication()->getUserState('com_profiler.edit.profileedit.data', array());

		if (empty($data)) {
			$data = $this->getItem();
		}
		
		// Determine correct permissions to check.
		if ($this->getState('profileedit.id')) {
			// Existing record.
		} else {
			// New record.
		}
		

		return $data;
	}
	
}
