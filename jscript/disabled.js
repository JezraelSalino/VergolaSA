$(document).ready(function() { 
	$(":input").prop("disabled", true);
	$("#cancel").prop("disabled", false);
	$("#cancel-down").prop("disabled", false);
	$("#cancel").val('Close');
	$("#cancel-down").val('Close');
});