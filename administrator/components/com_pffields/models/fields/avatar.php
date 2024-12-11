<?php
/**
 * @package Profiler Fields for Joomla! 2.5
 * @version $Id: avatar.php 17 2013-01-09 22:44:15Z harold $
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
defined('_JEXEC') or die;

jimport('joomla.form.formfield');

class JFormFieldAvatar extends JFormField
{
	public $type = 'Avatar';

	protected function getInput()
	{
		
		$config = JComponentHelper::getParams('com_profiler');
		$folder = $config->get('hpdestfolder');
		// Initialize some field attributes.
		$accept		= $this->element['accept'] ? ' accept="'.(string) $this->element['accept'].'"' : '';
		$size		= $this->element['size'] ? ' size="'.(int) $this->element['size'].'"' : '';
		$class		= $this->element['class'] ? ' class="'.(string) $this->element['class'].'"' : '';
		$disabled	= ((string) $this->element['disabled'] == 'true') ? ' disabled="disabled"' : '';
		//$value		= $this->value ? JURI::root().$folder.'/'.$this->fieldname.'/'.$this->value : '';
		if($this->value) {
			$value		= $this->value ? JURI::root().'media/com_profiler/'.$folder.'/'.$this->fieldname.'/'.$this->value : '';
		} else {
			$value		= JURI::root().'media/com_profiler/img/user.png';
		}		
		$name_remove	= $this->getName($this->fieldname . '_remove');
		
		
		$imageinfo = getimagesize($value);
		if($imageinfo[0] > $imageinfo[1]) {
			$width		= $this->element['cols'] > 0 ? ' width:'.(int) $this->element['cols'].'px;' : '';
			$height		= ($this->element['rows'] > 0 && !$width) ? ' height:'.(int) $this->element['rows'].'px;' : '';
		} else {
			$height		= $this->element['rows'] > 0 ? ' height:'.(int) $this->element['rows'].'px;' : '';
			$width		= ($this->element['cols'] > 0 && !$height) ? ' width:'.(int) $this->element['cols'].'px;' : '';
		}
		
		// Initialize JavaScript field attributes.
		$onchange	= $this->element['onchange'] ? ' onchange="'.(string) $this->element['onchange'].'"' : '';

		return 	'<span class="avatar"><img src="'.$value.'" style="'.$width.$height.'" /><br/> ' .
				'<label>'.JText::_('').'</label>' .
				'<input type="file" name="'.$this->name.'" id="'.$this->id.'"' .
				' value=""' .
				$accept.$disabled.$class.$size.$onchange.' /><br/>' .
				'<label>'.JText::_('').'</label>' .
				'<fieldset class="checkboxes">' .
				'<input type="checkbox" name="'.$name_remove.'" value="remove" /> ' .
				'<label for="'.$name_remove.'">'.JText::_('COM_PROFILER_REMOVE').'</label>' .
				'</fieldset>' .
				'</span>';
	}
}
