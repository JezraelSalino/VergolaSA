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
$count = 0;
foreach ($this->fieldsets as $fieldsetid => $fieldset) :
	if ((!isset($fieldset->position) || $fieldset->position != $this->view_position) && $this->view_position) :
		continue;
	endif;
	$count++; ?>
	<div id="<?php echo $fieldset->alias;?>" class="tab-pane  <?php echo $count == 1 ? "active" : "";?>">
		<?php foreach($this->form->getFieldset($fieldset->name) as $field) : ?>
			<div class="control-group">
				<?php if($this->view_labels) : ?>
					<div class="control-label"><?php echo $field->label; ?></div>
				<?php endif; ?>
				<div class="controls"><?php echo $field->input; ?></div>
			</div>
		<?php endforeach; ?>
	</div>
	<?php unset($this->fieldsets[$fieldsetid]); 
endforeach; ?>
