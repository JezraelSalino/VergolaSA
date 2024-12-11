$(document).ready(function(){  
	var qty = 0;
	var len = 0;
	var price = 0;
	var rrp = 0;
	var obj = null; 
	var width = 0;
	var isCreating = 0;  
	var isFirstLoad = 1;
	var viewType = "";

	$("script[src='singlebay.js']").remove();
	$("script[src='doublebay.js']").remove();
	$("script[src='doublebay_vr2.js']").remove();

	$('.qtylen, .input-inch').attr('readonly', true);

	$("td.td-ft").css("display", "none"); 
	$("input.num, input.input-size").attr("autocomplete", "off");

	$('input.num, input.qtylen, input.length, input.width').bind('keypress', accept_number);
	 
	$("table.table-subtotal input").val("");
	$(".table-subtotal-holder").show();

	$("#projectcomm").hide();
	$("#projectcost").hide();

	$(".table-subtotal input").each(function(){ 
		$(this).attr('readonly', true); 
	});
	 

	//alert("HEY vr1"); 
	//$("script[src='/components/com_chronoforms/js/datepicker/datepicker.js']").remove();
  
 	var status = "quoted"; 
 	
  	if($("#status").val().length>0){
		status = $("#status").val();
  	} 

	if(status == "create"){ //status is blank and view type is in creating quote
		isCreating = 1;
		viewType = "create";
	}else if(status.toLowerCase()=="won" || status.toLowerCase()=="lost"){
		viewType = "read only";
		isCreating = 0;
	}else{
		viewType = "edit";
		isCreating = 0;
		$("#frameset input").addClass("disabled-fields");

		var is_create_duplicate=0;
		is_create_duplicate = $("#is_create_duplicate").val();

		if(is_create_duplicate==1){
			$("#frameset input").removeClass("disabled-fields");
		}

	}
  
	  
	if(isCreating==1){

		//create view
		$("#lengthid").val(""); //empty the input dimension field if showing of created quote.
		$("#widthid").val(""); 
		//$("#dbwidthid1").val("");

		//.listing-table tbody tr .td-qty
		$(".listing-table tr .td-qty").children("input:text").not( ".qtylen-disbursements" ).each(function(){
			 
 			//console.log($(this).val());
			if($(this).val()=="0" || !$(this).val()){
				$(this).addClass("field-warning");
			}
		}); 
		//addClass( "field-warning" );
		 
	  
	}else{ 
		//edit view 
		// $('.length').each(function(){
        $("#template_table .length").val($('#lengthid').val());
     	$("#template_table .width").val($('#widthid').val());

     	if($("#default_color").val()!=""){
			$("#template_table select[name='colour[]'] option[value='"+$("#default_color").val()+"']").attr("selected", true);
		}

	}

	if($(".show-form-disable").length>0 || viewType=="read only"){

		$("#project input, #output input,#output select, .table-subtotal-holder input, #downbtn input").each(function(){
			//if($(".show-form").length==0){
				$(this).attr('disabled', true);
			//}
		});		

		$("#cancel").attr('disabled', false);
		
	}


	if($("#frameworktype").length>0 && $("#frameworktype").children("option:selected").val()=="Drop-In"){
		//alert("here");
		$(".tbody_framework").remove();
	}
   
	// var sel_colour = $(".color_select").children("option:selected").val();  
	// $("select.colour").val(sel_colour); 
 
	
	$(".color_select").change(function() {  
		$("select.colour").val($(this).val()); 
		$("#template_table select[name='colour[]'] option[value='"+$(this).val()+"']").attr("selected", true);
	});	 
  
	$(".length, .width").each(function(e){
		  
	 	id = $(this).parent().parent("tr").children("td.td-item").children("input.price").attr("inventoryid");

	});

	 
	$("#widthid").focus(function(){
		$("#output input,#output select").each(function(e){
			$(this).removeAttr('disabled');
		});	
	});
 
	$("#lengthid, #widthid").change(function(){  
		selectedFramework = $("#framework option:selected").val();
	 	if(typeof(selectedFramework) == 'undefined'){
	 		selectedFramework = $("#framework").val();
	 	}

	 	if(selectedFramework=="Single Bay VR0" || selectedFramework=="Single Bay VR0 - Drop-In"){
	 		//alert("trigger 1");
	 	}else if((Number($("#lengthid").val())<1 || Number($("#widthid").val())<1)  ){  return; }
   		
        $('.length').each(function(){
           $(this).val($('#lengthid').val());
        });


        $('.width').each(function(){
           $(this).val($('#widthid').val());
        });
		
        $("#output .rrp").each(function(e){  
		 	//console.log($(this).parent().parent("tr").children("td.td-rrp").html()); 
		 	var len = 0;
		 	qty = $(this).parent().parent("tr").children("td.td-qty").children("input").val();
		 	len = $(this).parent().parent("tr").children("td.td-len").children("input:visible").val();
		 	var obj = $(this).parent().parent("tr").children("td.td-item").children("select").length;
		 	if(obj>0){
			 	price = $(this).parent().parent("tr").children("td.td-item").children("select").children("option:selected").attr("price");
			 }else{
			 	price = $(this).parent().parent("tr").children("td.td-item").children("input.price").val();
			 }

			var finishColor = $(this).parent().parent("tr").children("td.td-finish-color").children("select").length;
			var finishRrp = 0;
		 	if(finishColor>0){ 
			 	finishRrp = Number($(this).parent().parent("tr").children("td.td-finish-color").children("select").children("option:selected").attr("finishrrp"));
			 	//console.log("finishrrp: "+finishRrp);
			} 

			var webbing = $(this).parent().parent("tr").children("td.td-webbing").children("select").length;
			var webbingRrp = 0;
		 	if(webbing>0){ 
			 	if($(this).parent().parent("tr").children("td.td-webbing").children("select").children("option:selected").val()=="Yes"){
		 			webbingRrp = Number($(this).parent().parent("tr").children("td.td-webbing").children("select").attr("webrrp")); 
		 		}
			}

		 	//console.log(price);
		 	if(typeof(len) == 'undefined' || len==0){
		 		len = 1;
		 	}
		 	 
		 	rrp = qty*len*price;
		 	rrp = rrp + (finishRrp * len * qty) + webbingRrp;  
		 	 
		 	$(this).val(rrp.toFixed(2));

		 	var category = $(this).parent().parent("tr").children("td.td-item").children("select").children("option:selected").attr("category");
		 	id = $(this).parent().parent("tr").children("td.td-item").children("input.price").attr("inventoryid");
			   

	 		if((selectedFramework == "Single Bay VS1" || selectedFramework == "Single Bay VS1 - Drop-In") && category == "Louvers"){  //|| id == "IRV31"
	 			
	 			//set the number and cost for the louver
	 			len = Number($("#lengthid").val());  
	 			
	 			width = Number($("#widthid").val());
	 			qty = Math.floor(5*len);//Number($("#louvres-qty").val());
	 			
	 			//console.log("lengthid: "+ len);
	 			//console.log("louvres-qty: "+ qty);
	 			//var f_qty = Math.floor(qty*len);
	 			//console.log("Floor louvres-qty: "+f_qty);
	 			$("#louvres-qty").val(qty); 
	 			//console.log("louvres-qty: "+ $("#louvres-qty").val());
	 			price = $(this).parent().parent("tr").children("td.td-item").children("select").children("option:selected").attr("price");; 
	 			finishRrp = Number($(this).parent().parent("tr").children("td.td-finish-color").children("select").children("option:selected").attr("finishrrp"));
		 		
	 			rrp = qty*price*width;
	 			rrp = rrp + (finishRrp * width * qty);	 

	 			// console.log("finishRrp: "+finishRrp);
			 	// console.log("width: "+width);
			 	// console.log("len: "+len);
			 	// console.log("qty: "+qty);
			 	// console.log("rrp: "+rrp);

	 			$(this).val(rrp.toFixed(2)); 

	 			//COMPUTE ENDCAP qty and cost.
	 			qty = qty*2; 
	 			//console.log(qty);
	 			$("#endcap-qty").val(qty.toFixed(0)); 
	 			   
		 		price = $("#endcap-qty").parent().parent("tr").children("td.td-item").children("input.price").val();
		 		finishRrp = Number($("#endcap-qty").parent().parent("tr").children("td.td-finish-color").children("select").children("option:selected").attr("finishrrp"));

	 			rrp = qty*price;
	 			rrp = rrp + finishRrp;
	 			$("#endcap-qty").parent().parent("tr").children("td.td-rrp").children("input").val(rrp.toFixed(2));
	 		 

	 			//COMPUTE PIVOT STRIP qty and cost.
	 			len = Number($("#lengthid").val());
	 			qty = Math.ceil((len*5*2)/12); //pivot strip = no. of endcap / 12 (round up to the nearest unit.) ---(Every 5 lourves have 1 pivot strip-OLD formula)
	 			//console.log("PIVOT QTY: "+qty);
	 			$("#pivot-qty").val(qty); 
	 			   
		 		price = $("#pivot-qty").parent().parent("tr").children("td.td-item").children("input.price").val();
		 		finishRrp = Number($("#pivot-qty").parent().parent("tr").children("td.td-finish-color").children("select").children("option:selected").attr("finishrrp"));

	 			var rrp = (qty*price)+finishRrp;
	 			$("#pivot-qty").parent().parent("tr").children("td.td-rrp").children("input").val(rrp.toFixed(2));

 
	 			//COMPUTE LINK BAR.
	 			len = Number($("#lengthid").val()); 
	 			//qty = Math.round((len*5*2)/12); //pivot strip = no. of endcap / 12 (round up to the nearest unit.) ---(Every 5 lourves have 1 pivot strip-OLD formula)
	 			qty = $("#louvres-qty").val(); 
	 			qty = Math.ceil(qty/12);
	 			//console.log("PIVOT QTY: "+qty);  
	 			$("#linkBar-qty").val(qty); 
	 			   
		 		price = $("#linkBar-qty").parent().parent("tr").children("td.td-item").children("input.price").val();
		 		finishRrp = Number($("#linkBar-qty").parent().parent("tr").children("td.td-finish-color").children("select").children("option:selected").attr("finishrrp"));

	 			var rrp = (qty*price)+finishRrp;
	 			$("#linkBar-qty").parent().parent("tr").children("td.td-rrp").children("input").val(rrp.toFixed(2));
 
				 
	 		} 


	 		if(id == "IRV31"  ){ 
	 			var len = 0;

		 		$("#output .gutter-length").each(function(e){  
		 			if($(this).parent().parent("tr").children("td.td-qty").children("input").val()>0 && $(this).val().length>0){
			 			len = len + Number($(this).parent().parent("tr").children("td.td-qty").children("input").val()) * Number($(this).val());
			 		}
		 		});
		 		  
				qty = $("#gutterLiningLength").parent().parent("tr").children("td.td-qty").children("input").val();
				$("#gutterLiningLength").val(len.toFixed(2)); 
					   
		 		price = $("#gutterLiningLength").parent().parent("tr").children("td.td-item").children("input.price").val();

				var rrp = len*price;

				var finishColor = $(this).parent().parent("tr").children("td.td-finish-color").children("select").length;
				var finishRrp = 0;
			 	if(finishColor>0){ 
				 	finishRrp = Number($(this).parent().parent("tr").children("td.td-finish-color").children("select").children("option:selected").attr("finishrrp"));
				}

				if(qty>0){
			 		rrp = rrp + (len*finishRrp*qty); 
			 	}else{
			 		rrp = 0;
			 	}

				 
				$("#gutterLiningLength").parent().parent("tr").children("td.td-rrp").children("input").val(rrp.toFixed(2));
	 		}

	 		if($(this).parent().parent("tr").children("td.td-item").children("input.price").attr("category") !== undefined && $(this).parent().parent("tr").children("td.td-item").children("input.price").attr("category").toLowerCase() == "posts"){
		 			price = $(this).parent().parent("tr").children("td.td-item").children("input.price").val();
		 			finishRrp = Number($(this).parent().parent("tr").children("td.td-finish-color").children("select").children("option:selected").attr("finishrrp"));
		 			qty = $(this).parent().parent("tr").children("td.td-qty").children("input").val();
 	
 					if(qty<1){
 						$(this).parent().parent("tr").children("td.td-rrp").children("input").val("0.00"); 	
 						//return;
 					}
 					
				 	rrp = (price*qty*len)+(qty*len*finishRrp); 
				 	//alert(rrp);
		 			//console.log("rrp :"+rrp);
		 			// console.log("RRP :"+rrp);
		 			$(this).parent().parent("tr").children("td.td-rrp").children("input").val(rrp.toFixed(2));

		 	}

  			
		 	//console.log("log #3 qty: "+qty);
		 	//$(this).parent().parent("tr").children("td:last").val();
		});  
 
		compute_project_cost();
		//$("#louvres-len").prop('readonly', true);

	}); 



 
 




	//Set event to the created select.desclist
	$(document).on("change","#output select.desclist, #output select.paint-list, #output select.webbing-list",function(e){ //alert("trigger here 1");
	 	
	 	//trigger_cbo_item(event, this);
	 	qty = $(this).parent().parent("tr").children("td.td-qty").children("input").val();
	 	len = $(this).parent().parent("tr").children("td.td-len").children("input:visible").val();
	 	width = $("#widthid").val();
	 	 
	 	var rrp = 0;

	 	if(typeof(len) == 'undefined'){
			len = 1;
		}   
	 	 
		var price = 0; 
		var invID = "";
		var desc = "";
		var obj = $(this).parent().parent("tr").children("td.td-item").children("select").length;  
	 	if(obj>0){
		 	price = $(this).parent().parent("tr").children("td.td-item").children("select").children("option:selected").attr("price");
		 	invID = $(this).parent().parent("tr").children("td.td-item").children("select").children("option:selected").val();
		 	desc = $(this).parent().parent("tr").children("td.td-item").children("select").children("option:selected").text(); 
		 	category = $(this).parent().parent("tr").children("td.td-item").children("select").children("option:selected").attr("category");
 
		 	if(category.toLowerCase()=="beams" || category.toLowerCase()=="intermediate"){  
		 		$(this).parent().parent("tr").children("td.td-webbing").children("select").show();
		 	}else{ 
		 		$(this).parent().parent("tr").children("td.td-webbing").children("select").hide();
		 	}

		}else{
		 	price = $(this).parent().parent("tr").children("td.td-item").children("input.price").val();
		 	invID = $(this).parent().parent("tr").children("td.td-item").children("input").attr("inventoryid");
		 	desc = $(this).parent().parent("tr").children("td.td-item").children("input").attr("desc");
		}
 
		var finishColor = $(this).parent().parent("tr").children("td.td-finish-color").children("select").length;
		var finishRrp = 0;
	 	if(finishColor>0){ 

		 	finishRrp = Number($(this).parent().parent("tr").children("td.td-finish-color").children("select").children("option:selected").attr("finishrrp"));
		 	//console.log("finishrrp: "+finishRrp);
		} 

		var webbing = $(this).parent().parent("tr").children("td.td-webbing").children("select").length;
		var webbingRrp = 0;
	 	if(webbing>0){ 
	 		if($(this).parent().parent("tr").children("td.td-webbing").children("select").children("option:selected").val()=="Yes"){
	 			webbingRrp = Number($(this).parent().parent("tr").children("td.td-webbing").children("select").attr("webrrp")); 
	 		}
		 	
		}
		  
	 	rrp = qty*len*price;
	 	rrp = rrp + (finishRrp*len*qty) + webbingRrp; 
	  	$(this).parent().parent("tr").children("td.td-rrp").children("input").val(rrp.toFixed(2));
	 	//alert("invID: "+invID+" rrp: "+rrp);
	 	var category = $(this).parent().parent("tr").children("td.td-item").children("select").children("option:selected").attr("category");
	 	//console.log("category: "+category);//return;
	 	 
	 //console.log("category :"+category);
		// console.log("len :"+len);
		// console.log("price :"+price);
		// console.log("qty :"+qty);
		// console.log("finishRrp :"+finishRrp);
		 
	 	if(typeof(category) !== 'undefined' && category.length>0 && category.toLowerCase()=="posts"){ 
	 		 
 			rrp = price*qty*len; 
		 	rrp = rrp + (finishRrp * qty * len);   
 			$(this).parent().parent("tr").children("td.td-rrp").children("input").val(rrp.toFixed(2));
 
 		}else if(typeof(category) !== 'undefined' && category.length>0 && category.toLowerCase()=="lourves"){ //alert(invID);
			rrp = (price * qty * len) + (finishRrp*width*qty);  
			$(this).parent().parent("tr").children("td.td-rrp").children("input").val(rrp.toFixed(2));
		}
		//var invID = $(this).parent().parent("tr").children("td.td-item").children(".price").attr("category"); 


 		$(this).parent().parent("tr").children(".invent").val(invID);
	 	$(this).parent().parent("tr").children(".desc").val(desc);

	 	compute_project_cost();
	 	 
	});

 


	//$("#output .qtylen").change(function(){ //
 	$(document).on("change","#output input",function(e){ 	   //alert("running here1");
		//var addedRrp = Number($(this).parent().parent("tr").children("td.td-rrp").children("input").val()) + Number($(this).attr("webrrp"));

		//$(this).parent().parent("tr").children("td.td-rrp").children("input").val(addedRrp);
		//alert($(this).val());
		var category = $(this).parent().parent("tr").children("td.td-item").children("select").children("option:selected").attr("category");
		//alert("running category:"+category);	  
		if(category == "Louvers"){
			//This is not needed because the louver field has it's own event handler.
			//return;
		}	

	 	var price = 0.00;
	 	var rrp = 0.00;
	 	var id = 0; 
	 	var qty = 0;
	 	var len = 0;

	 	qty = $(this).parent().parent("tr").children("td.td-qty").children("input").val();
	 	len = $(this).parent().parent("tr").children("td.td-len").children("input:visible").val();

	 	// if(qty>0){
	 	// 	$(this).removeClass("field-warning");
	 	// }else if(qty==0){
	 	// 	if($(this).hasClass('qtylen-disbursements')==false)
	 	// 		$(this).addClass("field-warning");
	 	// }

	 	if($(this).val().length>0){
	 		$(this).removeClass("field-warning"); 
	 	}else{  
	 		if($(this).hasClass('qtylen-disbursements')==false){ 
	 			$(this).addClass("field-warning"); 
	 		}
	 	}

		
		if(typeof(len) == 'undefined'){
			len = 1;
		}

	 	var obj = $(this).parent().parent("tr").children("td.td-item").children("select").length; 
	 	
	 	if(obj>0){
		 	price = $(this).parent().parent("tr").children("td.td-item").children("select").children("option:selected").attr("price");
		 }else{
		 	price = $(this).parent().parent("tr").children("td.td-item").children("input.price").val();
		 }

		var finishColor = $(this).parent().parent("tr").children("td.td-finish-color").children("select").length;
		var finishRrp = 0;
	 	if(finishColor>0){ 
		 	finishRrp = Number($(this).parent().parent("tr").children("td.td-finish-color").children("select").children("option:selected").attr("finishrrp"));
		 	//console.log("finishrrp: "+finishRrp);
		} 

		var webbing = $(this).parent().parent("tr").children("td.td-webbing").children("select").length;
		var webbingRrp = 0;
	 	if(webbing>0){ 
		 	if($(this).parent().parent("tr").children("td.td-webbing").children("select").children("option:selected").val()=="Yes"){
	 			webbingRrp = Number($(this).parent().parent("tr").children("td.td-webbing").children("select").attr("webrrp")); 
	 		} 
		}


 

	 	c_item = $(this).parent().parent("tr").children("input.invent").val(); 
	 	
	 	if(c_item == "IRV64"){
	 		//alert("inv: "+c_item+" qty: "+qty +" len: "+len+" uprice:"+price+ "rrp: "+rrp);
	 		$("#IRV66_qty").val($(this).val());  

	 		_qty = $(this).parent().parent("tr").children("td.td-qty").children("input").val();
			_price = parseFloat($("#IRV66_qty").parent().parent("tr").children("td.td-item").children("input.price").val()); 
			_rrp = _qty*_price; 
			$("#IRV66_qty").parent().parent("tr").children("td.td-rrp").children("input").val(_rrp.toFixed(2));

	 	}
	 	else{
	 		//console.log("inv: "+c_item+" qty: "+qty +" len: "+len+" uprice:"+price+ "rrp: "+rrp);
	 	} 

	   
		rrp = qty*len*price;		 	  

		
		if(qty>0){ 
			rrp = rrp + (finishRrp*len*qty) + webbingRrp;   
		}else{
			$(this).parent().parent("tr").children("td.td-rrp").children("input").val("0.00"); 
		}
	 	 
	 	//console.log(rrp);
	 	$(this).parent().parent("tr").children("td.td-rrp").children("input").val(rrp.toFixed(2));

		var category = $(this).parent().parent("tr").children("td.td-item").children("select").children("option:selected").attr("category");
	 	id = $(this).parent().parent("tr").children("td.td-item").children("input.price").attr("inventoryid");
	 	//category = $(this).parent().parent("tr").children("td.td-item").children("input.price").attr("category");
	 	//console.log("len-category: "+category);//return;
	 	 
	 	if(typeof(category) !== 'undefined' && category.length>0 && category.toLowerCase()=="posts"){  
	 		//console.log("price: "+price+" finishRrp"+finishRrp);
 			//Compute Gutter lining.
 			     
 			rrp = price*qty*len; 
		 	rrp = rrp + (finishRrp * qty * len);  
 			//console.log("rrp :"+rrp);
 			// console.log("RRP :"+rrp);
 			$(this).parent().parent("tr").children("td.td-rrp").children("input").val(rrp.toFixed(2));
 
 		}

 		if(category == "Louvers"){  //|| id == "IRV31"
 			//alert(id);

 		}

	 	compute_project_cost();  

	});	

	 

 
	$(document).on("change","#output .gutter-length, #output .gutter-qty",function(e){ 	
		var len = 0;

 		$("#output .gutter-length").each(function(e){  
 			//alert("qty:"+$(this).parent().parent("tr").children("td.td-qty").children("input").val()+' '+$(this).parent().parent("tr").children("td.td-len").children("input").val());
 			if($(this).parent().parent("tr").children("td.td-qty").children("input").val()>0 && $(this).val().length>0){
	 			len = len + Number($(this).parent().parent("tr").children("td.td-qty").children("input").val()) * Number($(this).val());
	 		} 
 		});
 		  
		qty = $("#gutterLiningLength").parent().parent("tr").children("td.td-qty").children("input").val();
		$("#gutterLiningLength").val(len.toFixed(2));  
			   
 		price = $("#gutterLiningLength").parent().parent("tr").children("td.td-item").children("input.price").val();

		var rrp = len*price;

		var finishColor = $(this).parent().parent("tr").children("td.td-finish-color").children("select").length;
		var finishRrp = 0;
	 	if(finishColor>0){ 
		 	finishRrp = Number($(this).parent().parent("tr").children("td.td-finish-color").children("select").children("option:selected").attr("finishrrp"));
		}

		if(qty>0){
	 		rrp = rrp + (len*finishRrp*qty); 
	 	}else{
	 		rrp = 0;
	 	}

		 
		$("#gutterLiningLength").parent().parent("tr").children("td.td-rrp").children("input").val(rrp.toFixed(2));
		compute_project_cost();
		
 	});


	$(".vergola-colour:first").change(function(){ 
		var sel = $(this).val();
		
		$(".vergola-colour").each(function(){
			$(this).val(sel);
		});  
		 
	});	

 
	$("#endcap-qty").change(function(){   
		qty = Number($(this).val()); 
 		price = parseFloat($(this).parent().parent("tr").children("td.td-item").children("input.price").val());

 		rrp = qty*price;
       
		$(this).parent().parent("tr").children("td.td-rrp").children("input").val(rrp.toFixed(2));
		//console.log(rrp);
	 	compute_project_cost();

	});

	// Change Disburment TotalRRP and TotalCost on Any Input Update
		

	selectedFramework = $("#framework option:selected").val();
 	if(typeof(selectedFramework) == 'undefined'){
 		selectedFramework = $("#framework").val();
 	}
		 	
			
	if((selectedFramework == "Single Bay VR0" || selectedFramework == "Single Bay VR0 - Drop-In")){	 	 
		  
		$("#lengthid").val("0");
		$("#widthid").val("0");

		if(isCreating==0 || viewType == "edit"){
			$("#frameset").hide();
		}

		$(".listing-table tr .td-qty").not( ".qtylen-disbursements" ).children("input:text").each(function(){ 
 			//$(this).val("1");
			//$(this).trigger("change");
			//alert("here1");
		});   


		//ADD DEFAULT VALUE	
		$(".listing-table tr .td-qty, .listing-table tr .td-len").children("input:text").each(function(){ 
 			//$(this).val("1");
			//$(this).trigger("change");  
		});    

		$("#lengthid").trigger("change"); 

	}

	if($("#projectid").length>0){ //should only in create quote
		//alert("trigger each row length changes"); 
		compute_project_cost();
	}


	 $('.qtylen, .input-inch').attr('readonly', false);

});	// END of jquery 1st init.

  

function compute_project_cost(){
	//Compute sum of the project cost.
	var total_rrp = 0;
	var total_vergola = 0;
	var total_disbursement = 0;
	var total_gst = 0;
	var total_sum = 0;
	var sub_total = 0;

	 
	$("#output .rrp").each(function() { 
		total_rrp += Number($(this).val()); 
	});

	$("#output .rrp-disbursement").each(function() {
		total_disbursement += Number($(this).val()); 
	});
	//alert(total_disbursement);
 
  	total_vergola = (total_rrp - total_disbursement) / 0.75;

	var com_sales_commission = total_vergola * 0.1;
	var com_sales_commission_ps = 0;
	var com_pay1 = com_sales_commission * 0.4;
	var com_pay2 = com_sales_commission * 0.3;
	var com_final = com_sales_commission * 0.3;
	var com_installer_payment = total_vergola * 0.13;
  
	sub_total = total_vergola + total_disbursement;   
	total_gst = (total_vergola+total_disbursement) * 0.1;
	//total_sum = total_rrp + total_gst;

	total_sum = sub_total + total_gst; 

	// console.log("total_rrp: "+total_rrp);
	// console.log("total_vergola: "+total_vergola);
	// console.log("total_disbursement: "+total_disbursement);
	// console.log("total_gst: "+total_gst);
	// console.log("total_sum: "+total_sum);

	$("#total_rrp").val(total_rrp.toFixed(2));
	$("#total_vergola").val(total_vergola.toFixed(2));
	$("#sub_total").val(sub_total.toFixed(2));	 
	$("#total_disbursement").val(total_disbursement.toFixed(2));
	$("#total_gst").val(total_gst.toFixed(2));
	$("#total_sum").val(total_sum.toFixed(2)); 

	//Compute payment
	var payment_deposit = 2000;
	var payment_progress = total_sum * 0.65;
	var payment_final = total_sum - payment_deposit - payment_progress;

	$("#payment_deposit").val(payment_deposit.toFixed(2));
	$("#payment_progress").val(payment_progress.toFixed(2));
	$("#payment_final").val(payment_final.toFixed(2));
 

	$("#com_sales_commission").val(com_sales_commission.toFixed(2));
	$("#com_sales_commission_ps").val(com_sales_commission_ps.toFixed(2));
	$("#com_pay1").val(com_pay1.toFixed(2));
	$("#com_pay2").val(com_pay2.toFixed(2));
	$("#com_final").val(com_final.toFixed(2));
	$("#com_installer_payment").val(com_installer_payment.toFixed(2));
}

  

function add_new_post(){ 
	 
	//console.log($("#additional_post").html());
	//$( "#framework_last_row" ).appendTo( $( "#framework_last_row" )  );
	$( "#additional_post tr" ).clone().insertBefore( "#framework_last_row" );
	 
 
	$(".added-post-tr .added_item").click(function(){ 
		$(this).parent().parent().remove();
		compute_project_cost(); 
	});	
   

	

	//console.log($(".tbody_framework .added-post-tr:last").children("td.td-webbing").children("select").html()); //parent().children("td.td-webbing").children("select")
	// $(".tbody_framework .added-post-tr:last select.webbing-list").change(function(){//alert("is trigger inside");
	// 	if($(this).val()=="Yes"){ 
	// 		var addedRrp = Number($(this).parent().parent("tr").children("td.td-rrp").children("input").val()) + Number($(this).attr("webrrp"));

	// 		$(this).parent().parent("tr").children("td.td-rrp").children("input").val(addedRrp.toFixed(2));

	// 	}else{ 
	// 		var addedRrp = Number($(this).parent().parent("tr").children("td.td-rrp").children("input").val()) - Number($(this).attr("webrrp"));

	// 		$(this).parent().parent("tr").children("td.td-rrp").children("input").val(addedRrp.toFixed(2));
	// 	}

	// 	compute_project_cost();

	// });	

	
	$(".tbody_framework .added-post-tr:last select.desclist").trigger("change"); 
	$('.qtylen, .input-in').bind('keypress', accept_number); 

}

 

function add_new_gutter(){
	
	//console.log($("#additional_gutter tr").html());
	//$("#framework_last_row").appendTo( $("#framework_last_row"));
	$( "#additional_gutter tr" ).clone().insertBefore( "#gutter_last_row" );
	 

	$(".added_item").click(function(){ 
		$(this).parent().parent().remove();
		$(".tbody_non_framework tr:nth-child(3) td.td-qty input.gutter-qty").trigger("change");
		compute_project_cost(); 
	});	

	$(".tbody_non_framework .added-gutter-tr:last select.desclist").trigger("change");  
	$(".tbody_non_framework .added-gutter-tr:last td.td-qty input.gutter-qty").trigger("change");
	$('.qtylen, .input-in').bind('keypress', accept_number); 
}

function add_new_non_standard_gutter(){
	
	//console.log($("#additional_none_standard_gutter tr").html());
	//$( "#framework_last_row" ).appendTo( $( "#framework_last_row" )  );
	$( "#additional_non_standard_gutter tr" ).clone().insertBefore( "#gutter_last_row" );
	  
	$(".added_item").click(function(){ 
		$(this).parent().parent().remove(); 
		$(".tbody_non_framework tr:nth-child(3) td.td-qty input.gutter-qty").trigger("change");	
		compute_project_cost(); 
	});

	$(".tbody_non_framework .added-gutter-tr:last select.desclist").trigger("change"); 
	$(".tbody_non_framework .added-gutter-tr:last td.td-qty input.gutter-qty").trigger("change");	
	$('.qtylen, .input-in').bind('keypress', accept_number); 

}

function add_new_flashing(){
	
	//console.log($("#additional_none_standard_gutter tr").html());
	//$( "#framework_last_row" ).appendTo( $( "#framework_last_row" )  );
	$( "#additional_flashing tr" ).clone().insertBefore( "#flashing_last_row" );
	  
	$(".added_item").click(function(){ 
		$(this).parent().parent().remove(); 
		compute_project_cost(); 
	});

	 
	$(".tbody_non_framework .added-flashing-tr:last select.desclist").trigger("change");
	$('.qtylen, .input-in').bind('keypress', accept_number); 

}

function add_new_misc(){
	
	//console.log($("#additional_none_standard_gutter tr").html());
	//$( "#framework_last_row" ).appendTo( $( "#framework_last_row" )  );
	$( "#additional_misc tr" ).clone().insertBefore( "#misc_last_row" );
	  
	$(".added_item").click(function(){ 
		$(this).parent().parent().remove();
		compute_project_cost(); 
	});	

	$(".tbody_non_framework .added-misc-tr:last select.desclist").trigger("change");
	$('.qtylen').bind('keypress', accept_number); 
}

function add_new_extra(){
	
	//console.log($("#additional_none_standard_gutter tr").html());
	//$( "#framework_last_row" ).appendTo( $( "#framework_last_row" )  );
	$( "#additional_extra tr" ).clone().insertBefore( "#extra_last_row" );
	 

	$(".added_item").click(function(){ 
		$(this).parent().parent().remove();
		compute_project_cost(); 
	});	

	$(".tbody_non_framework .added-extra-tr:last select.desclist").trigger("change");
	$('.qtylen').bind('keypress', accept_number); 

}

function add_new_fixing(){
	
	//console.log($("#additional_none_standard_gutter tr").html());
	//$( "#framework_last_row" ).appendTo( $( "#framework_last_row" )  );
	$( "#additional_fixing tr" ).clone().insertBefore( "#fixing_last_row" );
	  
	$(".added_item").click(function(){ 
		$(this).parent().parent().remove();
		compute_project_cost(); 
	});	

	$(".tbody_framework .added-fixing-tr:last select.desclist").trigger("change");
	$('.qtylen, .input-in').bind('keypress', accept_number); 
}

function add_new_downpipe(){
	
	//console.log($("#additional_none_standard_gutter tr").html());
	//$( "#framework_last_row" ).appendTo( $( "#framework_last_row"));
	$( "#additional_downpipe tr" ).clone().insertBefore( "#downpipe_last_row" );
	  
	$(".added_item").click(function(){ 
		$(this).parent().parent().remove();
		compute_project_cost(); 
	});	

	$(".tbody_non_framework .added-downpipe-tr:last select.desclist").trigger("change");
	$('.qtylen').bind('keypress', accept_number); 
}

function add_new_disbursement(){
	
	//console.log($("#additional_none_standard_gutter tr").html());
	//$( "#framework_last_row" ).appendTo( $( "#framework_last_row" )  );
	$( "#additional_disbursement tr" ).clone().insertBefore( "#disbursement_last_row" );
	  
	$(".added_item").click(function(){ 
		$(this).parent().parent().remove();
		compute_project_cost(); 

	});	

	$(".tbody_non_framework .added-disbursement-tr:last select.desclist").trigger("change");

	$('.qtylen').bind('keypress', accept_number); 
}

 
$(".louver-item-qty, .louver-item-len").change(function(){ 
	 	
		var endcap_qty = 0;
		var link_bar_qty = 0;
		$(".louver-item-qty").each(function(e){ 
		 	qty = Number($(this).val());
		 	link_bar_qty = link_bar_qty+qty;
			endcap_qty += qty*2;   
		});

 
		$("#endcap-qty").val(endcap_qty.toFixed(0)); 
		//$("#louvres-qty").val(qty); 
		qty = $(this).parent().parent("tr").children("td.td-qty").children("input").val();  
	 	len = $(this).parent().parent("tr").children("td.td-len").children("input:visible").val();
	 	//len = get_feet_to_inch(len);
 

		price = $(this).parent().parent("tr").children("td.td-item").children("select").children("option:selected").attr("price"); 
		finishRrp = Number($(this).parent().parent("tr").children("td.td-finish-color").children("select").children("option:selected").attr("finishrrp"));
		
		rrp = qty*price*len;
		rrp = rrp + (finishRrp * len * qty); 

		// console.log("finishRrp: "+finishRrp); 
		// console.log("len: "+len);
		// console.log("qty: "+qty);
		// console.log("rrp: "+rrp);
		//alert("0:"+$(this).val());
		$(this).parent().parent("tr").children("td.td-rrp").children("input").val(rrp.toFixed(2));
	  	//alert("1:"+$(this).val());

		//COMPUTE ENDCAP qty and cost.
		//qty = qty*2; 
		//console.log(qty);
		//$("#endcap-qty").val(qty.toFixed(0)); 
		   
		price = $("#endcap-qty").parent().parent("tr").children("td.td-item").children("input.price").val();  
		finishRrp = Number($("#endcap-qty").parent().parent("tr").children("td.td-finish-color").children("select").children("option:selected").attr("finishrrp"));
		qty = Number($("#endcap-qty").val());

		rrp = qty*price;
		rrp = rrp + finishRrp; 
		// console.log("qty: "+qty);
		// console.log("price: "+price);
		// console.log("rrp: "+rrp);
		$("#endcap-qty").parent().parent("tr").children("td.td-rrp").children("input").val(rrp.toFixed(2));
	 	//alert("endcap-qty rrp: "+$("#endcap-qty").parent().parent("tr").children("td.td-rrp").children("input").val());

		//COMPUTE PIVOT STRIP qty and cost.
		//len = Number($("#lengthid").val());
		//qty = Math.ceil(((len/39.37)*5*2)/12); //pivot strip = no. of endcap / 12 (round up to the nearest unit.) ---(Every 5 lourves have 1 pivot strip-OLD formula)
		endcap_qty = $("#endcap-qty").val();
		qty = Math.ceil(endcap_qty/12);
		//console.log("PIVOT QTY: "+qty);
		$("#pivot-qty").val(qty);
		   
		price = $("#pivot-qty").parent().parent("tr").children("td.td-item").children("input.price").val();
		finishRrp = Number($("#pivot-qty").parent().parent("tr").children("td.td-finish-color").children("select").children("option:selected").attr("finishrrp"));

		var rrp = (qty*price)+finishRrp;
		$("#pivot-qty").parent().parent("tr").children("td.td-rrp").children("input").val(rrp.toFixed(2));

		//COMPUTE LINK BAR. 
		//len = Number($("#lengthid").val()); 
		//qty = Math.round((len*5*2)/12); //pivot strip = no. of endcap / 12 (round up to the nearest unit.) ---(Every 5 lourves have 1 pivot strip-OLD formula)
		//qty = $("#louvres-qty").val(); 
		qty = Math.ceil(link_bar_qty/12); 
		//console.log("PIVOT QTY: "+qty); 
		$("#linkBar-qty").val(qty); 
		
		price = $("#linkBar-qty").parent().parent("tr").children("td.td-item").children("input.price").val();
		finishRrp = Number($("#linkBar-qty").parent().parent("tr").children("td.td-finish-color").children("select").children("option:selected").attr("finishrrp"));

		var rrp = (qty*price)+finishRrp;
		$("#linkBar-qty").parent().parent("tr").children("td.td-rrp").children("input").val(rrp.toFixed(2));

	  
		compute_project_cost();

	});	


function add_new_louver(){
	
	var tr_index = 0;
	tr_index = tr_index + Number($( ".tr-added-item" ).length) + 1;
	//alert(tr_index);


	$( ".added-louver-tr" ).clone().addClass("tr-added-item tr-added-louver-item tr-louver-"+tr_index).insertBefore( "#vergola_last_row" );
	//$( ".added-pivot-strip-tr" ).clone().addClass("tr-added-louver-item tr-pivot-strip-"+tr_index).removeClass("added-pivot-strip-tr").insertBefore( "#vergola_last_row" );
	//$( ".added-link-bar-tr" ).clone().addClass("tr-added-louver-item tr-link-bar-"+tr_index).removeClass("added-link-bar-tr").insertBefore( "#vergola_last_row" );
	  
	$(".tr-louver-"+tr_index+" .td-qty input").addClass("louver-item-qty added-louvres-qty louvres-qty-"+tr_index).attr("index",tr_index);
	$(".tr-louver-"+tr_index+" .td-len input").addClass("added-louvres-len louvres-len-"+tr_index).attr("index",tr_index); 
	 
  	$(".tbody_non_framework .added-louver-tr:last select.desclist").trigger("change");
  	$( ".tr-louver-"+tr_index ).removeClass("added-louver-tr");

	$(".added_item").click(function(){ 
		//console.log($(this).parent().parent().next("tr").html());
		//$(this).parent().parent().next("tr").remove();
		//$(this).parent().parent().next("tr").remove();
		$(this).parent().parent().remove();
		
		//$(this).parent().parent().next().remove();
		$("#louvres-qty").trigger("change");
		compute_project_cost(); 
	});	
 


	$(".added-louvres-len, .added-louvres-qty").change(function(){
			var item_index = "";
			item_index = $(this).attr("index");
			//alert(item_index);
			//set the number and cost for the louver
		 	var price = 0.00;
		 	var rrp = 0.00;
		 	var id = 0;
		 	var category = "";
		 	var qty = 0;
		 	var len = 0; 

		 	id = $(this).parent().parent("tr").children("td.td-item").children("input.price").attr("inventoryid");
		 	qty = $(this).parent().parent("tr").children("td.td-qty").children("input").val();
		 	len = $(this).parent().parent("tr").children("td.td-len").children("input:visible").val();

		 	price = $(this).parent().parent("tr").children("td.td-item").children("select").children("option:selected").attr("price"); 
			finishRrp = Number($(this).parent().parent("tr").children("td.td-finish-color").children("select").children("option:selected").attr("finishrrp"));
			
			rrp = qty*price*len;
			rrp = rrp + (finishRrp * len * qty); 
 
			$(this).parent().parent("tr").children("td.td-rrp").children("input").val(rrp.toFixed(2));
 		   
			//All Additonal item reflected that are affected re-calculate.
			var total_louver_qty = 0;
			$(".louver-item-qty").each(function(e){ 
			 	qty = $(this).val();
				total_louver_qty += qty*2;
			});
 	 
			 
			$("#endcap-qty").val(total_louver_qty.toFixed(0)); 
			   
			price = $("#endcap-qty").parent().parent("tr").children("td.td-item").children("input.price").val();
			finishRrp = Number($("#endcap-qty").parent().parent("tr").children("td.td-finish-color").children("select").children("option:selected").attr("finishrrp"));
			qty = Number($("#endcap-qty").val());

			rrp = qty*price;
			rrp = rrp + finishRrp;
			$("#endcap-qty").parent().parent("tr").children("td.td-rrp").children("input").val(rrp.toFixed(2));
		 
		    endcap_qty = Number($("#endcap-qty").val());
			pivot_qty = Math.ceil(endcap_qty/12); 
			
			$("#pivot-qty").val(pivot_qty); 
			   
			price = $("#pivot-qty").parent().parent("tr").children("td.td-item").children("input.price").val();
			//finishRrp = Number($("#pivot-qty").parent().parent("tr").children"(td.td-finish-color").children("select").children("option:selected").attr("finishrrp"));

			var rrp = (pivot_qty*price);
			$("#pivot-qty").parent().parent("tr").children("td.td-rrp").children("input").val(rrp.toFixed(2));
 
			//COMPUTE LINK BAR.
			//len = Number($(this).parent().parent("tr").children("td.td-len").children("input:visible").val()); 
			//qty = Math.round((len*5*2)/12); //pivot strip = no. of endcap / 12 (round up to the nearest unit.) ---(Every 5 lourves have 1 pivot strip-OLD formula)
			//qty = $(this).parent().parent("tr").children("td.td-qty").children("input").val(); 
			qty = Math.ceil(endcap_qty/24);
			//console.log("PIVOT QTY: "+qty);
			$("#linkBar-qty").val(qty); 
			
			price = $("#linkBar-qty").parent().parent("tr").children("td.td-item").children("input.price").val();
			
			var rrp = (qty*price);
			$("#linkBar-qty").parent().parent("tr").children("td.td-rrp").children("input").val(rrp.toFixed(2));

			compute_project_cost();	 
		 
	});	

	//$(".added-louvres-len").trigger("change");
	$('.qtylen, .input-in').bind('keypress', accept_number); 
	
}


function get_feet_value(inches){
	return Math.floor(inches / 12)+"'"+ Math.floor(inches %= 12); 
}

regexp = new RegExp("[0-9]+","g"); 

function get_feet_to_inch(f){ 
	var heightValue_array = f.match(regexp);
	return parseInt(heightValue_array[0] *12) + parseInt(heightValue_array[1]);
}

function accept_number(event) {  
		var key = window.event ? event.keyCode : event.which; 

	    switch (key) { 
            case 8:  // Backspace
            case 9:  // Tab
            case 13: // Enter
            case 37: // Left
            case 38: // Up
            case 39: // Right
            case 40: // Down
            case 116: // F5 refresh
            break;
            default: 
           
 			  var theEvent = event || window.event;
			  var key = theEvent.keyCode || theEvent.which;
			  key = String.fromCharCode( key ); 
			  var regex = /[0-9]|\.|\t/;
			  if( !regex.test(key) ) {
			    theEvent.returnValue = false;
			    if(theEvent.preventDefault) theEvent.preventDefault();
			     //alert(key+" privented");
			  }else{
			  	//alert(key+" allowed");
			  }

             break;
        }
}