<?php
/**
 * @package Profiler Fields for Joomla! 2.5
 * @version $Id: calendar.php 17 2013-01-09 22:44:15Z harold $
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

class JFormRuleCalendar extends JFormRule
{

	public function test(&$element, $value, $group = null, &$input = null, &$form = null)
	{
	
		return true;
	}
}
