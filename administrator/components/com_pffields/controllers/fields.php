<?php
/**
 * @package Profiler Fields for Joomla! 2.5
 * @version $Id: fields.php 17 2013-01-09 22:44:15Z harold $
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

class PffieldsControllerFields extends JControllerAdmin
{
	protected $text_prefix = 'COM_PFFIELDS_FIELDS';

	public function getModel($name = 'Field', $prefix = 'PffieldsModel', $config = array('ignore_request' => true))
	{
		return parent::getModel($name, $prefix, $config);
	}
	
	public function delete()
	{
		parent::delete();
		
		$extension = JRequest::getCmd('extension');
		$extensionURL = ($extension) ? '&extension=' . JRequest::getCmd('extension') : '';
		$prefixURL = ($extension) ? '&prefix=' . JRequest::getCmd('prefix') : '';
		$this->setRedirect(JRoute::_('index.php?option=' . $this->option . '&view=' . $this->view_list . $extensionURL . $prefixURL, false));
		
	}

	public function saveOrderAjax()
	{
		// Get the input
		$input = JFactory::getApplication()->input;
		$pks = $input->post->get('cid', array(), 'array');
		$order = $input->post->get('order', array(), 'array');

		// Sanitize the input
		JArrayHelper::toInteger($pks);
		JArrayHelper::toInteger($order);

		// Get the model
		$model = $this->getModel();

		// Save the ordering
		$return = $model->saveorder($pks, $order);

		if ($return)
		{
			echo "1";
		}

		// Close the application
		JFactory::getApplication()->close();
	}
}
