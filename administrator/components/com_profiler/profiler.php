<?php
/**
 * @package Profiler for Joomla! 2.5
 * @version $Id: profiler.php 31 2013-01-09 22:33:43Z harold $
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
// no direct access
defined('_JEXEC') or die;

require_once JPATH_COMPONENT.'/helpers/backward.php';

// Access check.
if (!JFactory::getUser()->authorise('core.manage', 'com_profiler')) {
	return JError::raiseWarning(404, JText::_('JERROR_ALERTNOAUTHOR'));
}

// Include dependancies
//jimport('joomla.application.component.controller');
//require_once JPATH_ADMINISTRATOR . '/components/com_profiler/helpers/access.php';

JLoader::register('ProfilerHelperAccess', __DIR__ . '/helpers/access.php');

$controller	= JControllerLegacy::getInstance('Profiler');
$controller->execute(JFactory::getApplication()->input->get('task'));
$controller->redirect();
