<?php
/**
 * @package Profiler Fields for Joomla! 2.5
 * @version $Id: pffields.php 31 2013-06-10 21:37:32Z harold $
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

require_once JPATH_COMPONENT.'/../com_profiler/helpers/backward.php';

// Access check.
if (!JFactory::getUser()->authorise('core.manage', 'com_pffields')) {
	return JError::raiseWarning(404, JText::_('JERROR_ALERTNOAUTHOR'));
}

// Include dependancies
jimport('joomla.application.component.controller');

$controller	= JControllerLegacy::getInstance('Pffields');
$controller->execute(JFactory::getApplication()->input->get('task'));
$controller->redirect();
