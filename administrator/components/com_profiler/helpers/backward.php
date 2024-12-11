<?php
/**
 * @package Profiler for Joomla! 2.5
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
//JHtml::_('stylesheet', 'com_profiler/bootstrap-responsive.min.css', array(), true);
JHtml::_('stylesheet', 'com_profiler/backend.min.css', array(), true);
JHtml::_('script', 'com_profiler/jquery.min.js', true, true);
JHtml::_('script', 'com_profiler/bootstrap-tab.js', true, true);
JHtml::_('script', 'com_profiler/bootstrap-collapse.js', true, true);
JHtml::_('script', 'com_profiler/bootstrap-modal.js', true, true);
JHtml::_('script', 'com_profiler/bootstrap-transition.js', true, true);




class JHtmlSidebar extends JSubMenuHelper {

	protected static $filters = array();

	public static function setAction($action)
	{
	
	}
	
	public static function addFilter($label, $name, $options, $noDefault = false)
	{
		array_push(self::$filters, array('label' => $label, 'name' => $name, 'options' => $options, 'noDefault' => $noDefault));
	}
	
	public static function render()
	{
		$filters        = self::getFilters();
		$html			= '';
//		$html 			= '<div class="row-fluid">';
//		$html			.= '<div class="sidebar-nav">';
		
		if ($filters) {
			foreach ($filters as $filter) {
				$html .= '<select name="'. $filter['name'] . '" id="' . $filter['name'] . '" class="inputbox" onchange="this.form.submit()">';
				if (!$filter['noDefault']) {
						$html .= '<option value="">'. $filter['label'] . '</option>';
				}
				$html .= $filter['options'];
				$html .= "</select>";
			}
		}
//		$html			.= '</div>';
		return $html;
		
	}
	
		public static function getFilters()
	{
		return self::$filters;
	}
}

//JHtml::_('formbehavior.chosen', 'select');
//X:\testen\joomla25\administrator\components\com_profiler\views\users\tmpl\default.php : 24
//X:\testen\joomla25\administrator\components\com_profiler\views\user\tmpl\edit.php : 25
//X:\testen\joomla25\administrator\components\com_profiler\views\group\tmpl\edit.php: 25
//X:\testen\joomla25\administrator\components\com_profiler\views\groups\tmpl\default.php
//X:\testen\joomla25\administrator\components\com_profiler\views\profile\tmpl\edit.php
//X:\testen\joomla25\administrator\components\com_profiler\views\profiles\tmpl\default.php
//X:\testen\joomla25\administrator\components\com_profiler\views\user\tmpl\import.php
//X:\testen\joomla25\administrator\components\com_pffields\views\fields\tmpl\default.php
//X:\testen\joomla25\administrator\components\com_pffields\views\field\tmpl\edit.php
//X:\testen\joomla25\administrator\components\com_pffields\views\category\tmpl\edit.php
//X:\testen\joomla25\administrator\components\com_pffields\views\categories\tmpl\default.php

//JHtml::_('bootstrap.tooltip');
//X:\testen\joomla25\administrator\components\com_pffields\views\fields\tmpl\default.php
//X:\testen\joomla25\administrator\components\com_pffields\views\categories\tmpl\default.php

//		JHtml::_('bootstrap.framework');
//X:\testen\joomla25\administrator\components\com_profiler\views\rights\view.html.php : 40

//	JHtml::_('sortablelist.sortable', 'fieldList', 'adminForm', strtolower($listDirn), $saveOrderingUrl);
//X:\testen\joomla25\administrator\components\com_pffields\views\categories\tmpl\default.php
//X:\testen\joomla25\administrator\components\com_pffields\views\fields\tmpl\default.php

//add div statement with class row-fluid to list views.
