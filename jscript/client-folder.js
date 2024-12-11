$(document).ready(function(){  

	var user_group = $("#user_group").val();
	//alert(user_group);

	var is_account_user=0;

	if(user_group=="account_user"){
		is_account_user=1;
	 
		// $(".btn-delete, .btn-save, .btn-add, .modification-button-holder, .remove-link, .edit-link").each(function(){
		$(".btn-delete, .btn-add, .modification-button-holder, .remove-link").each(function(){
			
			$(this).hide();

		});

	}

});	