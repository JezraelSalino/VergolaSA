<?php
/**
 * @package Profiler for Joomla! 2.5
 * @version $Id: group.php 31 2013-01-09 22:33:43Z harold $
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

jimport('joomla.application.component.controllerform');

class ProfilerControllerGroup extends JControllerForm
{
	protected $text_prefix = 'COM_PROFILER_GROUP';

	protected function allowEdit($data = array(), $key = 'id')
	{
		if (JAccess::check($data[$key], 'core.admin')) {
			if (!JFactory::getUser()->authorise('core.admin')) {
				return false;
			}
		}

		return parent::allowEdit($data, $key);
	}
	
}
