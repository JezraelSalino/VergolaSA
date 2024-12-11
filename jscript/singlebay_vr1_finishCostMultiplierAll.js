$(document).ready(function(){  
	var qty = 0;
	var len = 0;
	var price = 0;
	var rrp = 0;
	var obj = null; 
	var width = 0;

	$("table.table-subtotal input").val("");
	$(".table-subtotal-holder").show();

	$("#projectcomm").hide();
	$("#projectcost").hide();

	$(".table-subtotal input").each(function(){ 
		$(this).attr('readonly', true); 
	});
	 


	//alert("HEY vr1");
	$("script[src='singlebay.js']").remove();
	$("script[src='doublebay.js']").remove();
	$("script[src='doublebay_vr2.js']").remove();
	//$("script[src='/components/com_chronoforms/js/datepicker/datepicker.js']").remove();
 
	if($(".show-form").length==0){
		$("#lengthid").val(""); //empty the input dimension field if showing of created quote.
		$("#widthid").val(""); 
		//$("#dbwidthid1").val("");
		//alert("clear");
	}else{
		//alert("no clearing");  
	}
   
	var sel_colour = $(".color_select").children("option:selected").val();  
	$("select.colour").val(sel_colour); 
 
	
	$(".color_select").change(function() {  
		$("select.colour").val($(this).val()); 
	});	 

	 
	if($(".show-form-disable").length>0){
		//alert("disable");
		$("#project input, #output input,#output select, #downbtn input").each(function(){ 
			$(this).attr('disabled', true); 
		}); 
	}

 
	$(".length, .width").each(function(e){
		//alert("here");
	 	$(this).attr('readonly', true);
	 	//console.log($(this).html()); 
	 	id = $(this).parent().parent("tr").children("td.td-item").children("input.price").attr("inventoryid");

	});

	$("#output input,#output select").each(function(){
		if($(".show-form").length==0){
			$(this).attr('disabled', true);
		}
	});	
 
 	$("#widthid").focus(function(){
		$("#output input,#output select").each(function(e){
			$(this).removeAttr('disabled');
		});	
	});
 
	$("#lengthid, #widthid").change(function(){ //alert("is trigger");
		if(Number($("#lengthid").val())<1 || Number($("#widthid").val())<1 ){return; }
 
        $('.length').each(function(){
           $(this).val($('#lengthid').val());
        });
 
        $('.width').each(function(){
           $(this).val($('#widthid').val());
        });
		//alert("1");
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
		 	//console.log(price);

		 	if(finishRrp==0){
		 		finishRrp = 1;
		 	}

		 	// if(typeof(len) !== 'undefined' && len>0){ //if the row item has a length
		 	// 	rrp = qty*len*price*finishRrp;
		 	// }else{
		 	// 	rrp = qty*price*finishRrp;
		 	// }

		 	if(typeof(len) == 'undefined' || len<1){
		 		len = 1;
		 	}


		 	rrp = qty*len*price*finishRrp;

		 	
		 	//console.log("rrp B4: "+rrp); 
		 	//make sure the qty has 1 before including the finish rrp.
		 	// if(qty>0){
		 	// 	rrp = rrp + finishRrp;
		 	// }
 

		 	//console.log("rrp AFtr: "+rrp);
		 	$(this).val(rrp.toFixed(2));

		 	id = $(this).parent().parent("tr").children("td.td-item").children("input.price").attr("inventoryid");
			 
	 		if(id == "IRV54" || id == "IRV55"){ //|| id == "IRV31"
	 			
	 			//set the number and cost for the louver
	 			len = Number($("#lengthid").val());  
	 			
	 			width = $("#widthid").val();
	 			qty = Math.floor(5*len);;//Number($("#louvres-qty").val());
	 			
	 			//console.log("louvres-qty: "+ qty);
	 			//var f_qty = Math.floor(qty*len);
	 			//console.log("Floor louvres-qty: "+f_qty);
	 			$("#louvres-qty").val(qty); 
	 			price = $("#louvres-qty").parent().parent("tr").children("td.td-item").children("input.price").val();
	 			rrp = qty*len*price;	 
	 			
	 			//console.log(len);
	 			//$(this).parent().parent("tr").children("td.td-len").children("input").val(len);
	 			$(this).val(rrp.toFixed(2));
	 			//console.log(len);

	 			//compute endcap qty and cost.
	 			qty = qty*2;
	 			 
	 			//console.log(qty);
	 			$("#endcap-qty").val(qty); 
	 			   
		 		price = $("#endcap-qty").parent().parent("tr").children("td.td-item").children("input.price").val();

	 			rrp = qty*price;
	 			$("#endcap-qty").parent().parent("tr").children("td.td-rrp").children("input").val(rrp.toFixed(2));

	 			//compute pivot strip qty and cost.
	 			len = Number($("#lengthid").val());
	 			qty = Math.ceil((len*5*2)/12); //pivot strip = no. of endcap / 12 (round up to the nearest unit.) ---(Every 5 lourves have 1 pivot strip-OLD formula)
	 			//console.log("PIVOT QTY: "+qty);
	 			$("#pivot-qty").val(qty); 
	 			   
		 		price = $("#pivot-qty").parent().parent("tr").children("td.td-item").children("input.price").val();

	 			var rrp = qty*price;
	 			$("#pivot-qty").parent().parent("tr").children("td.td-rrp").children("input").val(rrp.toFixed(2));


	 			//compute link bar.
	 			len = Number($("#lengthid").val());
	 			
	 			//qty = Math.round((len*5*2)/12); //pivot strip = no. of endcap / 12 (round up to the nearest unit.) ---(Every 5 lourves have 1 pivot strip-OLD formula)
	 			qty = $("#louvres-qty").val(); 
	 			qty = Math.ceil(qty/12);
	 			//console.log("PIVOT QTY: "+qty);
	 			$("#linkBar-qty").val(qty); 
	 			   
		 		price = $("#linkBar-qty").parent().parent("tr").children("td.td-item").children("input.price").val();

	 			var rrp = qty*price;
	 			$("#linkBar-qty").parent().parent("tr").children("td.td-rrp").children("input").val(rrp.toFixed(2));
 
				 
	 		} 


	 		if(id == "IRV31"  ){ 
	 			//Compute Gutter lining.
	 			//len = Number($("#lengthid").val());
	 			len = Number($("#lengthid").val())  + Number($("#lengthid").val()) + Number($("#widthid").val()) + Number($("#widthid").val()) ; //sum length of all gutter length 
	 			
	 			qty = 1; 
	 			$("#gutterLiningLength").val(len); 
	 			   
		 		price = $("#gutterLiningLength").parent().parent("tr").children("td.td-item").children("input.price").val();

	 			

	 			var finishColor = $(this).parent().parent("tr").children("td.td-finish-color").children("select").length;
				var finishRrp = 0;
			 	if(finishColor>0){ 
				 	finishRrp = Number($(this).parent().parent("tr").children("td.td-finish-color").children("select").children("option:selected").attr("finishrrp"));
				}

				if(finishRrp==0){
			 		finishRrp = 1;
			 	}

			 	var rrp = len*price*finishRrp;
 

	 			// console.log("len :"+len+ " price: "+price);
	 			// console.log("RRP :"+rrp);
	 			//$("#linkBar-qty").parent().parent("tr").children("td.td-rrp").children("input").val(rrp.toFixed(2));

	 			$(this).val(rrp.toFixed(2));

	 		}

	 		// if($(this).parent().parent("tr").children("td.td-item").children("input.price").attr("category") !== undefined && $(this).parent().parent("tr").children("td.td-item").children("input.price").attr("category").toLowerCase() == "posts"){
		 	// 		price = $(this).parent().parent("tr").children("td.td-item").children("input.price").val();
		 	// 		finishRrp = Number($(this).parent().parent("tr").children("td.td-finish-color").children("select").children("option:selected").attr("finishrrp"));
		 	// 		qty = $(this).parent().parent("tr").children("td.td-qty").children("input").val();
 	
 			// 		if(qty<1){
 			// 			$(this).parent().parent("tr").children("td.td-rrp").children("input").val("0.00"); 	
 			// 			return;
 			// 		}
 					
				//  	rrp = (price*qty)*finishRrp; 
				//  	//alert(rrp);
		 	// 		//console.log("rrp :"+rrp);
		 	// 		// console.log("RRP :"+rrp);
		 	// 		$(this).parent().parent("tr").children("td.td-rrp").children("input").val(rrp.toFixed(2));

		 	// 	}

  			
		 	console.log("qty: "+qty);
		 	//$(this).parent().parent("tr").children("td:last").val();
		}); 

	
		 



}); 



 



if($( "#lengthid" ).val()>0 && $("#projectid").length>0){ //should only in create quote
	//alert("trigger each row length changes");
	//$( "#lengthid" ).trigger( "change" );
	compute_project_cost();
}



//Set event to the created select.desclist
		$(document).on("change","#output select.desclist",function(e){ //alert("trigger");
		 	
		 	//trigger_cbo_item(e, this);
		 	qty = $(this).parent().parent("tr").children("td.td-qty").children("input").val();
		 	len = $(this).parent().parent("tr").children("td.td-len").children("input:visible").val();
		 	 
		 	var price = 0; 
			//price = $("option:selected").attr("price");
			var selItem = $("option:selected", this);
			//console.log(selItem);
			//console.log(qty+" "+len);
			price = Number(selItem.attr("price"));
			//alert(price);
			var rrp = 0;
			var finishColor = $(this).parent().parent("tr").children("td.td-finish-color").children("select").length;
			var finishRrp = 0;
		 	if(finishColor>0){ 
			 	finishRrp = Number($(this).parent().parent("tr").children("td.td-finish-color").children("select").children("option:selected").attr("finishrrp"));
			 	//console.log("finishrrp: "+finishRrp);
			} 

			if(finishRrp==0){
				finishRrp = 1;
			}
			 
		 	
		 	if(typeof(len) !== 'undefined' && len>0){ //if the row item has a length
		 		rrp = qty*len*price*finishRrp;
		 	}else{
		 		rrp = qty*price*finishRrp;
		 	}
		 	// console.log("price: "+price);//return;
		 	// console.log("len: "+len);

		 	//alert(rrp);
		 	$(this).parent().parent("tr").children("td.td-rrp").children("input").val(rrp.toFixed(2));
		 	//console.log(qty);
		 	//$(this).parent().parent("tr").children("td:last").val();

		 	category = $(this).parent().parent("tr").children("td.td-item").children("input.price").attr("category");
		 	//console.log("category: "+category);//return;
		 	 
		 	if(typeof(category) !== 'undefined' && category.length>0 && category.toLowerCase()=="posts"){ 
		 		//console.log("price: "+price+" finishRrp"+finishRrp);
	 			//Compute Gutter lining.
	 			    
		 		  
	 			rrp = price*qty*finishRrp; 
			 	//rrp = rrp + finishRrp;  
	 			//console.log("rrp :"+rrp);
	 			// console.log("RRP :"+rrp);
	 			$(this).parent().parent("tr").children("td.td-rrp").children("input").val(rrp.toFixed(2));
	 
	 		}

	 		 $(this).parent().parent("tr").children(".invent").val(selItem.attr("value"));
		 	 $(this).parent().parent("tr").children(".desc").val(selItem.text());

		 	compute_project_cost();
		 	 
		});

	
		//return the total rrp price without finishrrp so that after the .paint-list is change function will work the same.
		//$(".paint-list").focus(function(){ //alert("is trigger");
		//Set event to the created select.paint-list
		//$(document).on("focus","#output select.paint-list",function(e){  
				// alert($(this).attr("webrrp"));
				// var finishRrp = Number($(this).parent().parent("tr").children("td.td-finish-color").children("select").children("option:selected").attr("finishrrp"));
				// //console.log("addedRRP :"+finishRrp);
				// var rrp = Number($(this).parent().parent("tr").children("td.td-rrp").children("input").val());
				// var qty = Number($(this).parent().parent("tr").children("td.td-qty").children("input").val());


				// if(qty>0){
				// 	rrp = rrp - finishRrp;  
				// }else{
				// 	return;
				// }

				// $(this).parent().parent("tr").children("td.td-rrp").children("input").val(rrp.toFixed(2));
			   	
		//});	  
	 


		//$(".paint-list").blur(function(){ //alert("is trigger");
		$(document).on("blur","#output select.paint-list",function(e){ 		 
			//alert($(this).attr("webrrp"));
			len = 1;
			var finishRrp = Number($(this).parent().parent("tr").children("td.td-finish-color").children("select").children("option:selected").attr("finishrrp"));
			//console.log("addedRRP :"+finishRrp);
			var rrp = Number($(this).parent().parent("tr").children("td.td-rrp").children("input").val());
			var qty = Number($(this).parent().parent("tr").children("td.td-qty").children("input").val());
			var len = Number($(this).parent().parent("tr").children("td.td-len").children("input:visible").val());

			var obj = $(this).parent().parent("tr").children("td.td-item").children("select").length;
		 	if(obj>0){
			 	price = $(this).parent().parent("tr").children("td.td-item").children("select").children("option:selected").attr("price");
			}else{
			 	price = $(this).parent().parent("tr").children("td.td-item").children("input.price").val();
			}


			if(finishRrp==0){
				finishRrp = 1;
			}

			if(typeof(len) == 'undefined' || len<1){				
				len = 1;	 
			} 

			rrp = price * qty * len * finishRrp; 

			category = $(this).parent().parent("tr").children("td.td-item").children("input.price").attr("category"); 
			if(typeof(category) !== 'undefined' && category.toLowerCase()=="posts"){ 
		 		//console.log("price: "+price+" finishRrp"+finishRrp);
	 			//Compute Gutter lining. 
	 			//rrp = price*qty*len*finishRrp; 
			 	rrp = price * qty * finishRrp;  
	 			//console.log("rrp :"+rrp);
	 			//console.log("RRP :"+rrp); 
	 		}


			$(this).parent().parent("tr").children("td.td-rrp").children("input").val(rrp.toFixed(2));
			compute_project_cost(); 
		});



		//$("#output .qtylen").change(function(){ //alert("is trigger");
	 	$(document).on("change","input","#output .qtylen",function(e){ 		 
			//var addedRrp = Number($(this).parent().parent("tr").children("td.td-rrp").children("input").val()) + Number($(this).attr("webrrp"));

			//$(this).parent().parent("tr").children("td.td-rrp").children("input").val(addedRrp);
		 	var price = 0.00;
		 	var rrp = 0.00;
		 	var id = 0;
		 	var category = "";
		 	var qty = 0;
		 	var len = 0;

		 	qty = $(this).val();
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
 
 			if(finishRrp == 0){				
				finishRrp = 1;  
			}

		 	//console.log(price);
		 	if(typeof $(this).parent().parent("tr").children("td.td-item").children("input.price").attr("category") !== null){
		 		category = $(this).parent().parent("tr").children("td.td-item").children("input.price").attr("category");
		 	}else{

		 	}

		 	c_item = $(this).parent().parent("tr").children("input.invent").val(); 
		 	
		 	if(c_item == "IRV64"){
		 		//alert("inv: "+c_item+" qty: "+qty +" len: "+len+" uprice:"+price+ "rrp: "+rrp);
		 		$("#IRV66_qty").val($(this).val());  

		 		_qty = $(this).val();
				_price = parseFloat($("#IRV66_qty").parent().parent("tr").children("td.td-item").children("input.price").val()); 
				_rrp = _qty*_price; 
				$("#IRV66_qty").parent().parent("tr").children("td.td-rrp").children("input").val(_rrp.toFixed(2));

		 	}
		 	else{
		 		//console.log("inv: "+c_item+" qty: "+qty +" len: "+len+" uprice:"+price+ "rrp: "+rrp);
		 	} 

		 	if(typeof(len) == 'undefined' || len<1){ //if the row item has a length
		 		len = 1;
		 	}
		 	 
		 	// if(typeof(category) !== 'undefined' && category.toLowerCase()=="posts"){ 
		 	// 	rrp = qty*price*finishRrp;
		 	// }else if(typeof(len) !== 'undefined' && len>0){ //if the row item has a length
		 	// 	rrp = qty*len*price*finishRrp;
		 	// }else{
		 	// 	rrp = qty*price*finishRrp;
		 	// }

		 	rrp = qty*len*price*finishRrp;
		 	  

		 	if(qty<1){
				$(this).parent().parent("tr").children("td.td-rrp").children("input").val("0.00");
				return; 
			} 
		 	 
		 	//console.log(rrp);
		 	$(this).parent().parent("tr").children("td.td-rrp").children("input").val(rrp.toFixed(2));
		 	compute_project_cost(); 
 

		});	
 
		//compute_project_cost();
		//set length to 4 for an trace js that modify the value. 
		$( "#additional_post .td-len input").val("4"); 

// $("select.desclist").on("change",function(){ 
// 	 	qty = Number($(this).parent().parent("tr").children("td.td-qty").children("input").val());
// 	 	len = Number($(this).parent().parent("tr").children("td.td-len").children("input").val());
// 	 	var price = 0;

// 	 	if(qty<1 || len<1){
// 	 		return;
// 	 	}
	 	 
// 		//price = $("option:selected").attr("price");
// 		var obj = $("option:selected", this);
// 		//console.log(qty+" "+len);
//     	price = Number(obj.attr("price"));
//     	//console.log("price: "+price);

//     	var rrp = 0;
//     	var finishColor = $(this).parent().parent("tr").children("td.td-finish-color").children("select").length;
// 		var finishRrp = 0;
// 	 	if(finishColor>0){ 
// 		 	finishRrp = Number($(this).parent().parent("tr").children("td.td-finish-color").children("select").children("option:selected").attr("finishrrp"));
// 		 	//console.log("finishrrp: "+finishRrp);
// 		} 
		 
// 	 	//console.log(price);return;
// 	 	if(len>0){ //if the row item has a length
// 	 		rrp = qty*len*price;
// 	 	}else{
// 	 		rrp = qty*price;
// 	 	}
 
// 	 	if(qty>0){
// 	 		rrp = rrp + finishRrp; 
// 	 	}
	 	
// 	 	//console.log(obj);
// 	 	//console.log(obj.attr("value"));
// 	 	//console.log($(this).parent().parent("tr").children(".invent").val());
	 	
	 	

// 	 	//console.log(rrp);
// 	 	$(this).parent().parent("tr").children("td.td-rrp").children("input").val(rrp.toFixed(2));
// 	 	//console.log(qty);
// 	 	//$(this).parent().parent("tr").children("td:last").val();

// 	 	category = $(this).parent().parent("tr").children("td.td-item").children("input.price").attr("category");

// 	 	if(category.toLowerCase()=="posts"){ 
// 	 		//console.log("price: "+price+" finishRrp"+finishRrp);
//  			//Compute Gutter lining. 			  
//  			rrp = price*qty;   
// 		 	rrp = rrp + finishRrp; 
		 	 
//  			//console.log("rrp :"+rrp);
//  			// console.log("RRP :"+rrp);
//  			$(this).parent().parent("tr").children("td.td-rrp").children("input").val(rrp.toFixed(2)); 			 

//  		}

//  		$(this).parent().parent("tr").children(".invent").val(obj.attr("value"));
// 	 	$(this).parent().parent("tr").children(".desc").val(obj.text());

// 	 	compute_project_cost();

// });




$(".webbing-list").change(function(){ //alert("is trigger");
	if($(this).val()=="Yes"){
		//alert($(this).attr("webrrp"));
		var addedRrp = Number($(this).parent().parent("tr").children("td.td-rrp").children("input").val()) + Number($(this).attr("webrrp"));

		$(this).parent().parent("tr").children("td.td-rrp").children("input").val(addedRrp.toFixed(2));

	}else{
		var addedRrp = Number($(this).parent().parent("tr").children("td.td-rrp").children("input").val()) - Number($(this).attr("webrrp"));

		$(this).parent().parent("tr").children("td.td-rrp").children("input").val(addedRrp.toFixed(2));
	}

	compute_project_cost();

});	



 
// //return the total rrp price without finishrrp so that after the .paint-list is change function will work the same.
// $(".paint-list").focus(function(){ //alert("is trigger");
	 
// 	//alert($(this).attr("webrrp"));
// 	var finishRrp = Number($(this).parent().parent("tr").children("td.td-finish-color").children("select").children("option:selected").attr("finishrrp"));
// 	//console.log("addedRRP :"+finishRrp);
// 	var rrp = Number($(this).parent().parent("tr").children("td.td-rrp").children("input").val());
// 	var qty = Number($(this).parent().parent("tr").children("td.td-qty").children("input").val());

// 	if(qty>0){
// 		rrp = rrp - finishRrp;  
// 	}else{
// 		return;
// 	}
	
// 	$(this).parent().parent("tr").children("td.td-rrp").children("input").val(rrp.toFixed(2));
   	 
// });	



// $(".paint-list").blur(function(){ //alert("is trigger");
	 
// 	//alert($(this).attr("webrrp"));
// 	var finishRrp = Number($(this).parent().parent("tr").children("td.td-finish-color").children("select").children("option:selected").attr("finishrrp"));
// 	//console.log("addedRRP :"+finishRrp);
// 	var rrp = Number($(this).parent().parent("tr").children("td.td-rrp").children("input").val()); 
// 	var qty = Number($(this).parent().parent("tr").children("td.td-qty").children("input").val());
 
// 	if(qty>0){
// 		rrp = rrp + finishRrp;  
// 	}else{
// 		return;
// 	}
 
// 	$(this).parent().parent("tr").children("td.td-rrp").children("input").val(rrp.toFixed(2));
//     compute_project_cost();
// });


$(".vergola-colour:first").change(function(){ //alert("is trigger");
	var sel = $(this).val();
	
	$(".vergola-colour").each(function(){
		$(this).val(sel);
	});  
	 
});	
 


// $("#output .qtylen").change(function(){ //alert("is trigger");
	 
// 	//var addedRrp = Number($(this).parent().parent("tr").children("td.td-rrp").children("input").val()) + Number($(this).attr("webrrp"));

// 	//$(this).parent().parent("tr").children("td.td-rrp").children("input").val(addedRrp);
//  	var price = 0.00;
//  	var rrp = 0.00;
//  	var id = 0;
//  	var category = "";
//  	var qty = 0;
//  	var len = 0;

//  	qty = $(this).val();
// 	len = $(this).parent().parent("tr").children("td.td-len").children("input").val();
//  	//var obj = $(this).parent().parent("tr").children("td.td-item").children("select").length;
 
 	
//  	if(obj>0){
// 	 	price = $(this).parent().parent("tr").children("td.td-item").children("select").children("option:selected").attr("price");
// 	 }else{
// 	 	price = $(this).parent().parent("tr").children("td.td-item").children("input.price").val();
// 	 }

// 	var finishColor = $(this).parent().parent("tr").children("td.td-finish-color").children("select").length;
// 	var finishRrp = 0;
//  	if(finishColor>0){ 
// 	 	finishRrp = Number($(this).parent().parent("tr").children("td.td-finish-color").children("select").children("option:selected").attr("finishrrp"));
// 	 	//console.log("finishrrp: "+finishRrp);
// 	} 
 

//  	//console.log(price);
//  	if(typeof $(this).parent().parent("tr").children("td.td-item").children("input.price").attr("category") !== null){
//  		category = $(this).parent().parent("tr").children("td.td-item").children("input.price").attr("category");
//  	}else{

//  	}
 	 
//  	if(typeof(category) !== 'undefined' && category.toLowerCase()=="posts"){ 
//  		rrp = qty*price;
//  	}else if(len>0){ //if the row item has a length
//  		rrp = qty*len*price;
//  	}else{
//  		rrp = qty*price;
//  	}

 
//  	if(qty>0){
// 		rrp = rrp + finishRrp;  
// 	}else{
// 		$(this).parent().parent("tr").children("td.td-rrp").children("input").val("0.00");
// 		return;
// 	}
 	 
//  	//console.log(rrp);
//  	$(this).parent().parent("tr").children("td.td-rrp").children("input").val(rrp.toFixed(2));
//  	compute_project_cost(); 
 

// });	

 
	 

$("#endcap-qty").change(function(){
		//console.log($("#louvres-len").val());
		//$("#louvres-len").val($("#dblengthid2").val() * $("#dblengthid2").val());
		qty = Number($(this).val()); 
 		price = parseFloat($(this).parent().parent("tr").children("td.td-item").children("input.price").val());

 		rrp = qty*price;
       
		$(this).parent().parent("tr").children("td.td-rrp").children("input").val(rrp.toFixed(2));
			//console.log(rrp);
	 	compute_project_cost();

	});

		// Change Disburment TotalRRP and TotalCost on Any Input Update
		

	

});	// END of jquery 1st init.



// $("#IRV64_qty").change(function(){
// 	//alert($(this).val());
// 	$("#IRV66_qty").val($(this).val()); 

// 	qty = Number($(this).val()); 
// 	price = parseFloat($(this).parent().parent("tr").children("td.td-item").children("input.price").val()); 
// 	rrp = qty*price; 
// 	$(this).parent().parent("tr").children("td.td-rrp").children("input").val(rrp.toFixed(2));


// 	qty = Number($("#IRV66_qty").val()); 
// 	price = parseFloat($("#IRV66_qty").parent().parent("tr").children("td.td-item").children("input.price").val()); 
// 	rrp = qty*price; 
// 	$("#IRV66_qty").parent().parent("tr").children("td.td-rrp").children("input").val(rrp.toFixed(2));


// 	compute_project_cost();
// });	


function compute_project_cost(){
	//Compute sum of the project cost.
	var total_rrp = 0;
	var total_vergola = 0;
	var total_disbursement = 0;
	var total_gst = 0;
	var total_sum = 0;

	$("#output .rrp").each(function() {

		total_rrp += Number($(this).val());
		//console.log($(this).val()+" - "+total_rrp);
	});

	$("#output .rrp-disbursement").each(function() {
		total_disbursement += Number($(this).val());
	});

	total_vergola = total_rrp - total_disbursement;
 
	total_gst = (total_vergola+total_disbursement) * 0.1;
	total_sum = total_rrp + total_gst;

	// console.log("total_rrp: "+total_rrp);
	// console.log("total_vergola: "+total_vergola);
	// console.log("total_disbursement: "+total_disbursement);
	// console.log("total_gst: "+total_gst);
	// console.log("total_sum: "+total_sum);


	$("#total_rrp").val(total_rrp.toFixed(2));
	$("#total_vergola").val(total_vergola.toFixed(2));
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


	var com_sales_commission = total_vergola * 0.1;
	var com_sales_commission_ps = 0;
	var com_pay1 = com_sales_commission * 0.4;
	var com_pay2 = com_sales_commission * 0.3;
	var com_final = com_sales_commission * 0.3;
	var com_installer_payment = total_vergola * 0.13;


	$("#com_sales_commission").val(com_sales_commission.toFixed(2));
	$("#com_sales_commission_ps").val(com_sales_commission_ps.toFixed(2));
	$("#com_pay1").val(com_pay1.toFixed(2));
	$("#com_pay2").val(com_pay2.toFixed(2));
	$("#com_final").val(com_final.toFixed(2));
	$("#com_installer_payment").val(com_installer_payment.toFixed(2));
}



// function add_new_post(){
	
// 	//console.log($("#additional_post").html());
// 	//$( "#framework_last_row" ).appendTo( $( "#framework_last_row" )  );
// 	$( "#additional_post tr" ).clone().insertBefore( "#framework_last_row" );
// 	$("select.desclist").trigger("change");

// 	$(".added_item").click(function(){ 
// 		$(this).parent().parent().remove();
// 	});	
// }


function add_new_post(){ 
	
	//console.log($("#additional_post").html());
	//$( "#framework_last_row" ).appendTo( $( "#framework_last_row" )  );
	$( "#additional_post tr" ).clone().insertBefore( "#framework_last_row" );
	 
 
	$(".added_item").click(function(){ 
		$(this).parent().parent().remove();
	});	
   
	$(".tbody_framework .added-post-tr:last select.desclist").trigger("change");


}

function add_new_gutter(){
	
	//console.log($("#additional_gutter tr").html());
	//$( "#framework_last_row" ).appendTo( $( "#framework_last_row" )  );
	$( "#additional_gutter tr" ).clone().insertBefore( "#gutter_last_row" );
	 

	$(".added_item").click(function(){ 
		$(this).parent().parent().remove();
		compute_project_cost(); 
	});	

	$(".tbody_non_framework .added-gutter-tr:last select.desclist").trigger("change");


}

function add_new_non_standard_gutter(){
	
	//console.log($("#additional_none_standard_gutter tr").html());
	//$( "#framework_last_row" ).appendTo( $( "#framework_last_row" )  );
	$( "#additional_non_standard_gutter tr" ).clone().insertBefore( "#gutter_last_row" );
	  
	$(".added_item").click(function(){ 
		$(this).parent().parent().remove();
		compute_project_cost(); 
	});

	$(".tbody_non_framework .added-gutter-tr:last select.desclist").trigger("change");	
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

}