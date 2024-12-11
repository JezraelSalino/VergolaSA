<?php
/**
 * @package Profiler for Joomla! 2.5
 * @version $Id: profile.php 31 2013-01-09 22:33:43Z harold $
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

class ProfilerTableProfile extends JTable
{
	function __construct(&$_db)
	{
		parent::__construct('#__profiler', 'id', $_db);
	}
	
	public function load($keys = null, $reset = true) {
		if(!parent::load($keys, $reset)) {
			$config = JComponentHelper::getParams('com_profiler');
			$id = JRequest::getInt('id');
			$row = array("id"=>$id, "readaccess"=> 0, "access"=> 0, "deleteaccess" => 0, "register"=> 2, "accessprivate"=> 2, "accessroprivate"=> 2);
			return $this->bind($row);
		}
	}
	
	public function store($updateNulls = false)
	{
		$query = "SELECT p.id AS value FROM #__profiler AS p WHERE id= $this->id";
		$this->_db->setQuery($query);
		if(!$this->_db->loadResult()){
			$stored = $this->_db->insertObject($this->_tbl, $this, $this->_tbl_key);	
		}
		return parent::store($updateNulls);
	}
	

}
