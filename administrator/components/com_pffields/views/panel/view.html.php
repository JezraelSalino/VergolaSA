<?php
/**
 * @package Profiler Fields for Joomla! 2.5
 * @version $Id: view.html.php 17 2013-01-09 22:44:15Z harold $
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

jimport('joomla.application.component.view');

class PffieldsViewPanel extends JViewLegacy
{

	
	public function display($tpl = null)
	{
		
		// Style sheet
		$document = JFactory::getDocument();
		$document->addStyleSheet(JURI::base(true).'/components/com_pffields/assets/css/pffields.css');
		
		$this->addToolbar();
		parent::display($tpl);
	}

	protected function addToolbar()
	{
		require_once JPATH_COMPONENT.'/helpers/pffields.php';

		$canDo	= PffieldsHelper::getActions();

		JToolBarHelper::title(JText::_('COM_PFFIELDS_VIEW_PANEL'), 'cpanel');
		
		if ($canDo->get('core.admin')) {
			JToolBarHelper::preferences('com_pffields');
		}
		
		JToolBarHelper::divider();
		$url = "http://www.haroldprins.nl/wiki/index.php?title=Profiler";
		JToolBarHelper::help("", "", $url);
		
	}
}
