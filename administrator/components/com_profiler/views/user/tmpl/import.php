<?php
/**
 * @package Profiler for Joomla! 2.5
 * @version $Id: import.php 47 2013-05-06 21:51:11Z harold $
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

JHtml::_('behavior.tooltip');
JHtml::_('behavior.formvalidation');
//Joomla25 JHtml::_('formbehavior.chosen', 'select');
$canDo = PffieldsHelper::getActions();

?>

<script type="text/javascript">

	function ProfilerAjaxUpload($url) {
		jQuery.ajax({
			url: $url,
			dataType: 'json',
			error: function(jqXHR, textStatus, errorThrown){
			
				alert(jqXHR.responseText);
			},
			success: function(response, textStatus, jqXHR){
			
				jQuery('.bar').css('width', response.percentage + '%');
				jQuery("#uploadlog").append(response.log);
			
				if(response.percentage >= '100') {
					alert('Upload voltooid!');
			    	return;
				}

				ProfilerAjaxUpload(response.next_page);
	    	}
		});
	}

	Joomla.submitbutton = function(task)
	{
		if (task == 'user.upload' && document.formvalidator.isValid(document.id('user-form'))) {
			jQuery('#myModal').modal('show');

			var $form = document.getElementById('user-form')
			if (typeof(task) !== 'undefined') {
				$form.task.value = "user.upload2";
			}

		    var $form = jQuery('#user-form'),
	        $inputs = $form.find("input, select, button, textarea"),
	        serializedData = $form.serialize();

		    var odata = new FormData(document.getElementById('user-form'));
		   
		   

		    $inputs.attr("disabled", "disabled");

		    jQuery.ajax({
		        url: "<?php echo JRoute::_('index.php?option=com_profiler&page=1', false); ?>",
		        type: 'post',
		        data: odata,
		        processData: false,
		        contentType: false,
		        dataType: 'json',
		        error: function(jqXHR, textStatus, errorThrown){
					
					alert(jqXHR.responseText);
				},
		        success: function(response, textStatus, jqXHR){
		        	
		        	jQuery('.bar').css('width', response.percentage + '%');
		        	jQuery("#uploadlog").append(response.log);

					if(response.percentage >= '100') {
						alert('Nieuwsbrief verstuurd!');
					    return;
					}

					ProfilerAjaxUpload(response.next_page);
		        }
		    });

		    
					

		}
		else {
			if (task == 'user.cancel' || document.formvalidator.isValid(document.id('user-form'))) {
				Joomla.submitform(task, document.getElementById('user-form'));
			}
			else {
				alert('<?php echo $this->escape(JText::_('JGLOBAL_VALIDATION_FORM_FAILED'));?>');
			}
		}
	}
</script>

<div id="myModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">X</button>
		<h3 id="myModalLabel"><?php echo JText::_("COM_PROFILER_VIEW_USERSUPLOAD_LOGTITLE"); ?></h3>
	</div>
	<div class="modal-body">
		<p><?php echo JText::_("COM_PROFILER_VIEW_USERSUPLOAD_LOG_DONTCLOSE"); ?></p>
    	<div class="progress progress-striped active">
    		<div class="bar" style="width: 5%;"></div>
   		</div>
		<ul style="height: 300px; overflow-x: hidden; overflow-y: scroll;" id="uploadlog">
			<li><?php echo JText::_("COM_PROFILER_VIEW_USERSUPLOAD_LOG_UPLOADFORM"); ?></li>
		</ul>
	</div>
	<div class="modal-footer">
		<button class="btn" data-dismiss="modal" aria-hidden="true"><?php echo JText::_("JTOOLBAR_CLOSE"); ?></button>
	</div>
</div>

<form action="<?php echo JRoute::_('index.php?option=com_profiler&view=user&layout=import'); ?>" method="post" enctype="multipart/form-data" name="adminForm" id="user-form" class="form-validate form-horizontal">

		<?php
		echo $this->showImports();
		
		?>

		<fieldset class="adminform">
			<ul class="nav nav-tabs">
				<li class="active"><a href="#upload" data-toggle="tab"><?php echo JText::_('COM_PROFILER_USERUPLOAD_LEGEND_UPLOAD'); ?></a></li>
				<li><a href="#csvoptions" data-toggle="tab"><?php echo JText::_('COM_PROFILER_USERUPLOAD_LEGEND_CSVOPTIONS'); ?></a></li>
				<li><a href="#details" data-toggle="tab"><?php echo JText::_('COM_PROFILER_USERUPLOAD_LEGEND_DETAILS'); ?></a></li>
			</ul>	
			<div class="tab-content">
				<div class="tab-pane active" id="upload">
					<div class="control-group">
						<div class="control-label"><?php echo $this->form->getLabel('name'); ?></div>
						<div class="controls"><?php echo $this->form->getInput('name'); ?></div>
					</div>
				
					<div class="control-group">
						<div class="control-label"><?php echo $this->form->getLabel('type'); ?></div>
						<div class="controls"><?php echo $this->form->getInput('type'); ?></div>
					</div>
					
						<?php //echo $this->form->getLabel('newuserid'); ?>
						<?php //echo $this->form->getInput('newuserid'); ?>
					
					<div class="control-group">
						<div class="control-label"><?php echo $this->form->getLabel('synchronize'); ?></div>
						<div class="controls"><?php echo $this->form->getInput('synchronize'); ?></div>
					</div>
					<div class="control-group">
						<div class="control-label"><?php echo $this->form->getLabel('synchronizefield'); ?></div>
						<div class="controls"><?php echo $this->form->getInput('synchronizefield'); ?></div>
					</div>
					
						<?php //echo $this->form->getLabel('password'); ?>
						<?php //echo $this->form->getInput('password'); ?>
					
					<div class="control-group">
						<div class="control-label"><?php echo $this->form->getLabel('file'); ?></div>
						<div class="controls"><?php echo $this->form->getInput('file'); ?></div>
					</div>
				</div>
				<div class="tab-pane" id="csvoptions">
					<div class="control-group">
						<div class="control-label"><?php echo $this->form->getLabel('delimiter'); ?></div>
						<div class="controls"><?php echo $this->form->getInput('delimiter'); ?></div>
					</div>
					<div class="control-group">
						<div class="control-label"><?php echo $this->form->getLabel('enclosure'); ?></div>
						<div class="controls"><?php echo $this->form->getInput('enclosure'); ?></div>
					</div>
					<div class="control-group">
						<div class="control-label"><?php echo $this->form->getLabel('multiple'); ?></div>
						<div class="controls"><?php echo $this->form->getInput('multiple'); ?></div>
					</div>
				</div>
				<div class="tab-pane" id="details">
						<?php echo $this->showColumnnames();?>
						<input type="hidden" name="task" value="" />
						<?php echo JHtml::_('form.token'); ?>
				</div>
			</div>
		</fieldset>






</form>
<p class="copyright" align="center">
	<span class="version"><?php echo JText::_('COM_PROFILER_COPYRIGHT'); ?></span>
</p>
