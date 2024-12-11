<?php
/**
 * @package Profiler Fields for Joomla! 2.5
 * @version $Id$
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

class PffieldsTableCategory extends JTable
{
	
	function __construct(&$_db)
	{
		parent::__construct('#__profiler_categories', 'id', $_db);
	}
	
	function check()
	{
		jimport('joomla.filter.output');

		// Set name and extension if new
		if(!$this->id) {
			
			$prefix = JRequest::getCmd('prefix', '');
			$extension = JRequest::getCmd('extension', 'com_pffields') . $prefix;
			$this->extension = $extension;

			$this->type = "category";
		}
			
		// Set ordering
		if (empty($this->ordering)) {
			// Set ordering to last if ordering was 0
			$this->ordering = self::getNextOrder('`extension`=' . $this->_db->Quote($this->extension));
		}
		return true;
	}
	
	function delete($pk = null) {

		// don't delete if categorie has fields	
		$this->_db->setQuery( "select name from #__profiler_fields where catid = '$pk' limit 1");
		$result = $this->_db->loadAssoc();
		
		if ($result['name']) {
			$this->setError(JText::_("COM_PFFIELDS_ERROR_CATEGORY_DELETE_ACTIVEFIELDS"));
			return false;
		}
		
		// don't delete if it is a plugin
		$this->_db->setQuery( "select type, extension_id from #__profiler_categories where id = '$pk' limit 1");
		$result = $this->_db->loadAssoc();
		
		if ($result['type'] == "plugin") {
			$this->setError(JText::_("COM_PFFIELDS_ERROR_CATEGORY_DELETE_PLUGIN"));
			return false;
		}
		
		if ($result['type'] == "module") {
			$this->_db->setQuery( "select position from #__modules where id = " . $this->extension_id . " limit 1");
			$result = $this->_db->loadresult();
			if($result &&  strtolower($result) == "profiler") {
				$this->setError(JText::_("COM_PFFIELDS_ERROR_CATEGORY_DELETE_MODULE"));
				return false;
			}
			
		}
		
		
		
		$return = parent::delete($pk);
		
		$this->_db->setQuery( "DELETE FROM #__profiler_fieldgroupprofile WHERE `catid` = '$pk'" );
		$this->_db->query();
		
		if ($this->_db->getErrorNum()) {
			$this->setError($this->_db->getErrorMsg());
			return false;
		}
		return $return;
		
		
		
	}
}
