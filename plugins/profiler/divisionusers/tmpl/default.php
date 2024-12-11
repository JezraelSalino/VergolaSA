<?php

defined('_JEXEC') or die;

?>




	<div id="ajaxdefault"></div>



<script type="text/javascript">

	onload = function()
	{
		ajaxdisplay();
	}


	jQuery("#filter_search").submit(function(event) {
		event.stopImmediatePropagation();

		ajaxsearch();

		return false;
	});

	
	function ajaxdisplay() {
		var url = "<?php echo JRoute::_(ProfilerHelperRoute::getUsersajaxdefaultRoute(), false); ?>";
		var postform = jQuery("#filter_search").serialize();

		jQuery.post(url,	postform)
			.done(function(result) {
				jQuery( "#ajaxdefault" ).empty().append( result );
				ajaxsearch();
		});

	}
	
	
	function ajaxsearch() {
		var url = "<?php echo JRoute::_(ProfilerHelperRoute::getUsersajaxRoute(), false); ?>";
		var postform = jQuery("#filter_search").serialize();

		jQuery.post(url,	postform)
			.done(function(result) {
				jQuery( "#ajaxuserlist" ).empty().append( result );
		});

	}



</script>