<?php
/**
 * @package Profiler Fields for Joomla! 3.0
 * @version $Id: field.php 4 2013-01-12 21:43:18Z harold $
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

jimport('joomla.application.component.controllerform');

class PffieldsControllerField extends JControllerForm
{

	function changeType() {
		$fieldtype = JRequest::getVar( 'fieldtype', '', 'get', 'cmd' );
		$fieldid = JRequest::getVar( 'fieldid', '', 'get', 'int' );
		
		if(strpos($fieldtype, ".") !== false) {
			$plugintype = explode('.', $fieldtype);
			$type = $plugintype[0];
			$plugin = $plugintype[1];
		} else {
			return false;
		}
		
		if($fieldid > 0) {
			$db		= JFactory::getDBO();
			$query	= $db->getQuery(true);
		
			// Build the query.
			$query->select('param');
			$query->from('#__profiler_fields');
			$query->where('id = ' . $fieldid);
		
			// Set the query and load the options.
			$db->setQuery($query);
			$param = $db->loadAssoc();
			$values = json_decode($param['param'], true);
		} else {
			$values = array();
		}
		
		
		$dispatcher	= JDispatcher::getInstance();
		JPluginHelper::importPlugin('pffields', "field" . $plugin);
		$results = $dispatcher->trigger('getPffieldsParams', array($values));
		
		foreach($results as $result) {		
			$response['html']  = 	'<h4>' . $result['name'] . '</h4>';
			$response['html'] .= 	'<hr/>';
			$response['html'] .= 	'<fieldset class="form-vertical">';
			foreach($result['params'] as $param) {
				$response['html'] .= 	'	<div class="control-group">';
				$response['html'] .= 	'		<div class="control-label">';
				$response['html'] .= 	'			<label id="" class="hasTip" title="" for="">' . $param['label'] . '</label>';
				$response['html'] .= 	'		</div>';
				$response['html'] .= 	'		<div class="controls">' . $param['input'] . '</div>';
				$response['html'] .= 	'	</div>';
			}
			$response['html'] .= 	'</fieldset>';
		}
				
		$response['msg'] = 'true';
		echo (json_encode( $response )) ;
		return true;
	}
	
}
