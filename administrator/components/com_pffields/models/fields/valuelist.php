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
defined('JPATH_BASE') or die;

jimport('joomla.html.html');
jimport('joomla.form.formfield');
jimport('joomla.form.helper');

class JFormFieldValuelist extends JFormField
{
	protected $type = 'Valuelist';

	protected function getInput()
	{
		// Initialise variables.
		$html = array();
		
		// Get the field value
		$valuetext = $this->value;
		
		$values = explode(",", $valuetext);
		if($valuetext) {
			foreach($values as $value) {
				$valuedetail = explode("=", $value);
				$valuelist[] = '<tr class="optionrow"><td>';
				$valuelist[] = '<input type="text" size="30" class="inputbox" value="'.$valuedetail[0].'" name="names[]">';
				$valuelist[] = '</td><td>';
				$valuelist[] = '<input type="text" size="30" class="inputbox" value="'.$valuedetail[1].'" name="values[]">';
				$valuelist[] = '</td></tr>';
			}
		} else {
			$valuelist[] = '<tr class="optionrow"><td>';
			$valuelist[] = '<input type="text" size="30" class="inputbox" value="" name="names[]">';
			$valuelist[] = '</td><td>';
			$valuelist[] = '<input type="text" size="30" class="inputbox" value="" name="values[]">';
			$valuelist[] = '</td></tr>';
		}
		

		// Load the javascript
		JHtml::_('behavior.framework');
		JHtml::_('behavior.modal', 'a.modal', array('onClose'=>'\function(){modalclose();}'));
		
		
		// Build the script.
		$script = array();

		$script[] = '	function modalclose() {';
		$script[] = '   	var div = document.id("modalhide");';
		$script[] = '		document.id("value-list").injectInside(div);';
		$script[] = '	};';		
		
		$script[] = '	function PostValueList(title) {';
		$script[] = '		var names = $$("input[name=names\[\]]").map(function(e) { return e.value; });';
		$script[] = '		var values = $$("input[name=values\[\]]").map(function(e) { return e.value; });';
		$script[] = '		var returnvalue = "";';
		$script[] = '		var count = 0;';
		$script[] = '		Array.each(names, function(name, index){';
		$script[] = '			count = count + 1;';
		$script[] = '			if(!!name || !!values[index]) {;';
		$script[] = '				if(count > 1) {';
		$script[] = '					returnvalue = returnvalue + ",";';
		$script[] = '				};';
		$script[] = '				returnvalue = returnvalue + name + "=" + values[index] ;';
		$script[] = '			};';    	
		$script[] = '		});';
		$script[] = '		document.getElementById("' . $this->id . '").value = returnvalue;';
		$script[] = '		SqueezeBox.close();';
		$script[] = '	};';
		
		$script[] = '   function createoption() {';
		$script[] = '		var modalbox = document.id("sbox-window");';
		$script[] = '		var optioncontainer = modalbox.getElement("tbody");'; 
		$script[] = '		var optionrow = modalbox.getElement(".optionrow");'; 
		$script[] = '   	var clone = optionrow.clone().inject(optioncontainer);';
		$script[] = '	};';
		
		JFactory::getDocument()->addScriptDeclaration(implode("\n", $script));

		$html[] = '<textarea id="' . $this->id . '" name="' . $this->name . '" class="inputbox" rows="3" cols="30" readonly="readonly" />'.$valuetext.'</textarea>';
		$html[] = '<div class="button2-left">';
		$html[] = '  <div class="blank">';
		$html[] = '		<a class="modal" title="' . JText::_('COM_PFFIELDS_FIELD_EDITOPTIONS') . '"' . ' href="#" rel="{handler: \'adopt\', target:\'value-list\', size: {x: 400, y: 300}}">';
		$html[] = '			' . JText::_('COM_PFFIELDS_FIELD_EDITOPTIONS') . '</a>';
		$html[] = '  </div>';
		$html[] = '</div>';
		
		
		//modal
		$html[] = '<div id="modalhide" style="display: none">';
		$html[] = '<div id="value-list">';
		$html[] = '<table>';
		$html[] = '<thead>';
		$html[] = '<tr><th>Value</th><th>Title</th></tr>';
		$html[] = '</thead>';
		$html[] = '<tbody>';
		$html[] = implode("\n", $valuelist);
		$html[] = '</tbody>';
		$html[] = '</table>';
		$html[] = '<div class="button2-left"><div class="blank"><a href="#" onClick="createoption()" title="'.JText::_("COM_PFFIELDS_FIELD_ADDOPTION").'">'.JText::_("COM_PFFIELDS_FIELD_ADDOPTION").'</a></div></div>';
		$html[] = '<div class="button2-left"><div class="blank"><a href="#" onClick="PostValueList(\'test\')" title="'.JText::_("JSAVE").'">'.JText::_("JSAVE").'</a></div></div>';
		$html[] = '</div>';
		$html[] = '</div>';
		
		return implode("\n", $html);
	}

}
