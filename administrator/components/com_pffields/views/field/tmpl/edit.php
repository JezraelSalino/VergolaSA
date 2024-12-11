<?php
/**
 * @package Profiler Fields for Joomla! 2.5
 * @version $Id: edit.php 32 2013-06-14 21:50:26Z harold $
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

//JHtml::addIncludePath(JPATH_COMPONENT.'/helpers/html');
JHtml::_('behavior.tooltip');
JHtml::_('behavior.formvalidation');
//JHtml::_('formbehavior.chosen', 'select');
$canDo = PffieldsHelper::getActions();

?>
<script type="text/javascript">
	jQuery.noConflict();
	
	Joomla.submitbutton = function(task)
	{
		if (task == 'field.cancel' || document.formvalidator.isValid(document.id('field-form'))) {
			Joomla.submitform(task, document.getElementById('field-form'));
		}
		else {
			alert('<?php echo $this->escape(JText::_('JGLOBAL_VALIDATION_FORM_FAILED'));?>');
		}
	}

	onload = function()
	{
		changefieldtype();
		changedatabase();
	}

	function changedatabase() {
		value = document.getElementById('jform_dbcreate').value;
		switch(value)
		{
		case 'manual':
			document.getElementById('lidbtype').style.display = "block";
			document.getElementById('lidblength').style.display = "block";
			document.getElementById('lidbdefaultvalue').style.display = "block";
			document.getElementById('lidbdefaultvaluedefined').style.display = "block";
			break;
		case 'auto':
			document.getElementById('lidbtype').style.display = "none";
			document.getElementById('lidblength').style.display = "none";
			document.getElementById('lidbdefaultvalue').style.display = "none";
			document.getElementById('lidbdefaultvaluedefined').style.display = "none";
			break;
		}
	}

	function changefieldtype() {

		var a = ["valuedetails", "hrvaluedetails", "viewdetails", "hrviewdetails", "advancedetails", "hradvancedetails", "livaluesimple", "livalue", "limultiple", "liaccept", "liformat", "liinputformat", "lidefault", "lisize", "limaxlength", "liminlength", "licols", "lirows", "liregex", "lierror", "liforbidden", "limimeenable", "liextensionsenable", "liquery"];
		value = document.getElementById('jform_type').value;

		var box = $('namechkregister');
    	box.style.display="block";
    	box.set('html','');
		
		switch(value)
		{
			case 'checkbox':
				var b = ["valuedetails","hrvaluedetails","livaluesimple","lidefault"];
				break;
			case 'checkboxes':
				var b = ["valuedetails","hrvaluedetails","livalue","lidefault"];
				break;
			case 'calendar':
				var b = ["valuedetails","hrvaluedetails","viewdetails","hrviewdetails","liformat","liinputformat","lidefault","lisize"];
				break;		
			case 'list':
				var b = ["valuedetails","hrvaluedetails","viewdetails","hrviewdetails","livalue","limultiple","lidefault","lisize"];
				break;	
			case 'editor':
				var b = ["valuedetails","hrvaluedetails","viewdetails","hrviewdetails","advancedetails","hradvancedetails","lidefault","lisize","limaxlength","liminlength","liregex","lierror","liforbidden"];
				break;	
			case 'file':
				var b = ["viewdetails","hrviewdetails","advancedetails","hradvancedetails","lisize","limimeenable","liextensionsenable","liaccept"];
				break;
			case 'avatar':
				var b = ["viewdetails","hrviewdetails","advancedetails","hradvancedetails","liaccept","lisize","licols","lirows","limimeenable","liextensionsenable"];
				break;
			case 'radio':
				var b = ["valuedetails","hrvaluedetails","livalue","lidefault"];
				break;
			case 'text':
				var b = ["valuedetails","hrvaluedetails","viewdetails","hrviewdetails","advancedetails","hradvancedetails","lidefault","lisize","limaxlength","liminlength","liregex","lierror","liforbidden"];
				break;
			case 'textarea':
				var b = ["valuedetails","hrvaluedetails","viewdetails","hrviewdetails","advancedetails","hradvancedetails","lidefault","limaxlength","liminlength","licols","lirows","liregex","lierror","liforbidden"];
				break;
			case 'sql':
				var b = ["valuedetails","hrvaluedetails","viewdetails","hrviewdetails","limultiple","lidefault","lisize","liquery"];
				break;
			default:
				if ( value.length > 0 ) {
		    	    var url="index.php?option=com_pffields&format=raw&task=field.changeType&fieldid=<?php echo $this->item->id; ?>&fieldtype=" + value ;
		    	    box.set('html','Check in progress...');
		        	var c=new Request.JSON({
		            	url:url,
		            	onComplete: function(response){  
		                	box.set('html',response.html);         
		                 	if (response.msg==='false'){
		                 		$(cun).value='';
		                 		$(cun).focus();                
		                	}            
		                 	var el = $(box);
		                 	(function(){                
		                   		el.set('html','');
		                 	});                                                                                            
		            	}
		        	});
		        	c.get();
				}
			
		}

		a.forEach(function(entry) {
			if(jQuery.inArray(entry, b) === -1) {
				document.getElementById(entry).style.display = "none";
			} else {
				document.getElementById(entry).style.display = "block";
			}
			
		});

	}
	
</script>

<form action="<?php echo JRoute::_('index.php?option=com_pffields&extension='.JRequest::getVar("extension", "pffields").'&layout=edit&id='.(int) $this->item->id); ?>" method="post" name="adminForm" id="field-form" class="form-validate form-horizontal">
	<div class="row-fluid">
	<div class="span9 form-horizontal">
		<fieldset class="adminform">
			<ul class="nav nav-tabs">
				<li class="active"><a href="#details" data-toggle="tab"><?php echo JText::_('COM_PFFIELDS_FIELD_LEGEND_DETAILS'); ?></a></li>
				<?php if ($canDo->get('core.admin') && $this->form->getValue('extension') == 'com_profiler' && JRequest::getVar("prefix", "") == ''): ?>
					<li><a href="#rights" data-toggle="tab"><?php echo JText::_('COM_PFFIELDS_FIELDSET_RIGHTS');?></a></li>
				<?php endif ?>
				
			</ul>
			
			<div class="tab-content">
				<div class="tab-pane active" id="details">
					<div class="control-group">
						<div class="control-label"><?php echo $this->form->getLabel('title'); ?></div>
						<div class="controls"><?php echo $this->form->getInput('title'); ?></div>
					</div>
					<div class="control-group">				
						<div class="control-label"><?php echo $this->form->getLabel('name'); ?></div>
						<div class="controls"><?php echo $this->form->getInput('name'); ?></div>
					</div>
	
						<?php echo $this->form->getLabel('extension'); ?>
						<?php echo $this->form->getInput('extension'); ?>

					<div class="control-group">
						<div class="control-label"><?php echo $this->form->getLabel('table'); ?></div>
						<div class="controls"><?php echo $this->form->getInput('table'); ?></div>
					</div>
					<div class="control-group">
						<div class="control-label"><?php echo $this->form->getLabel('type'); ?></div>
						<div class="controls"><?php echo $this->form->getInput('type'); ?></div>
					</div>
					<div class="control-group">
						<div class="control-label"><?php echo $this->form->getLabel('catid'); ?></div>
						<div class="controls"><?php echo $this->form->getInput('catid'); ?></div>
					</div>
					<div class="control-group">
						<div class="control-label"><?php echo $this->form->getLabel('ordering'); ?></div>
						<div class="controls"><?php echo $this->form->getInput('ordering'); ?></div>
					</div>
					<div class="control-group">
						<div class="control-label"><?php echo $this->form->getLabel('description'); ?></div>
						<div class="controls"><?php echo $this->form->getInput('description'); ?></div>
					</div>
					<div class="control-group">
						<div class="control-label"><?php echo $this->form->getLabel('id'); ?></div>
						<div class="controls"><?php echo $this->form->getInput('id'); ?></div>
					</div>
				</div>
				<?php if ($this->canDo->get('core.admin')  && $this->form->getValue('extension') == 'com_profiler' && JRequest::getVar("prefix", "") == ''): ?>
					<div class="tab-pane" id="rights">
						<fieldset>
							<?php echo $this->form->getInput('rights'); ?>
						</fieldset>
					</div>
				<?php endif; ?>
				
			</div>
			
			<input type="hidden" name="task" value="" />
			<input type="hidden" name="prefix" value="<?php echo JRequest::getVar("prefix", "");?>" />
			<?php echo JHtml::_('form.token'); ?>
			
		</fieldset>
	</div>
	<div class="span3">
		<h4 id="valuedetails"><?php echo JText::_('COM_PFFIELDS_FIELD_OPTIONSLABEL_VALUE_DETAILS');?></h4>
		<hr id="hrvaluedetails"/>
			<fieldset class="form-vertical adminform">
				<?php foreach($this->form->getFieldset('valueoptions') as $field): ?>
					<div class="control-group" id="li<?php echo $field->fieldname; ?>">
						<?php if (!$field->hidden): ?>
							<div class="control-label"><?php echo $field->label; ?></div>
						<?php endif; ?>
						<div class="controls"><?php echo $field->input; ?></div>
					</div>
			  	<?php endforeach; ?>
			</fieldset>
		<h4 id="viewdetails"><?php echo JText::_('COM_PFFIELDS_FIELD_OPTIONSLABEL_VIEW_DETAILS');?></h4>
		<hr id="hrviewdetails"/>
			<fieldset class="form-vertical adminform">
				<?php foreach($this->form->getFieldset('viewoptions') as $field): ?>
					<div class="control-group" id="li<?php echo $field->fieldname; ?>">
						<?php if (!$field->hidden): ?>
							<div class="control-label"><?php echo $field->label; ?></div>
						<?php endif; ?>
						<div class="controls"><?php echo $field->input; ?></div>
					</div>
				<?php endforeach; ?>
			</fieldset>
		<h4 id="advancedetails"><?php echo JText::_('COM_PFFIELDS_FIELD_OPTIONSLABEL_ADVANCE_DETAILS');?></h4>
		<hr id="hradvancedetails"/>
			<fieldset class="form-vertical adminform">
				<?php foreach($this->form->getFieldset('checkoptions') as $field): ?>
					<div class="control-group" id="li<?php echo $field->fieldname; ?>">
						<?php if (!$field->hidden): ?>
							<div class="control-label"><?php echo $field->label; ?></div>
						<?php endif; ?>
						<div class="controls"><?php echo $field->input; ?></div>
					</div>
				<?php endforeach; ?>
			</fieldset>
		<?php if(!$this->item->id): ?>	
		<h4><?php echo JText::_('COM_PFFIELDS_FIELD_OPTIONSLABEL_DATABASE_DETAILS');?></h4>
		<hr/>
			<fieldset class="form-vertical adminform">
				<?php foreach($this->form->getFieldset('dboptions') as $field): ?>
					<div class="control-group" id="li<?php echo $field->fieldname; ?>">
						<?php if (!$field->hidden): ?>
							<div class="control-label"><?php echo $field->label; ?></div>
						<?php endif; ?>
						<div class="controls"><?php echo $field->input; ?></div>
					</div>
				<?php endforeach; ?>
			</fieldset>
		<?php endif; ?>
		<fieldset class="adminform">
		<span id="namechkregister"></span>
		</fieldset>
	</div>
	</div>

</form>
<p class="copyright" align="center">
	<span class="version"><?php echo JText::_('COM_PFFIELDS_COPYRIGHT'); ?></span>
</p>
