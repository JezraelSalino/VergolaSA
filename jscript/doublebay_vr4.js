$(document).ready(function(){  
	var qty = 0;
	var len = 0;
	var price = 0;
	var rrp = 0;
	var obj = null;
	var id = 0; 
	var selectedFramework = $("#framework option:selected").val();
	var l1 = 0; var l2 = 0; var l3 = 0;
	var isCreating = 0;  
	var isFirstLoad = 1;
	var viewType = "";
	
	$("script[src='singlebay.js']").remove();
	$("script[src='singlebay_vr1.js']").remove();
	$("script[src='doublebay.js']").remove();
	$("script[src='doublebay_vr4.js']").remove();

	$('.qtylen, .input-inch').attr('readonly', true);

	$("td.td-ft").css("display", "none"); 
	$("input.num, input.input-size").attr("autocomplete", "off");
  
	$('input.num, input.qtylen, input.length, input.width').bind('keypress', accept_number);
  
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
		$("#doublebay_input input").addClass("disabled-fields");

		var is_create_duplicate=0;
		is_create_duplicate = $("#is_create_duplicate").val();

		if(is_create_duplicate==1){
			$("#frameset input").removeClass("disabled-fields");
		}
		
	}

 
	if(isCreating==1){ 

		$("#dblengthid1").val(""); //empty the input dimension field if showing of created quote.
		$("#dblengthid2").val(""); 
		$("#dblengthid3").val(""); 
		$("#dblengthid4").val(""); 
		$("#dbwidthid1").val("");
		$("#dbbay").val("");


		$(".lbay").remove();

		$(".listing-table tbody tr .td-qty").children("input:text").not( ".qtylen-disbursements" ).each(function(){
			 
			if($(this).val()=="0" || $(this).val().length<1){
		 		 $(this).addClass("field-warning"); 
		 	} 
		});
			 
	}else{ 
		selectedFramework = $("#framework").val();

		if($("#default_color").val()!=""){
			$("#template_table select[name='colour[]'] option[value='"+$("#default_color").val()+"']").attr("selected", true);
		}
	}

	$(".color_select").change(function() {  
		$("select.colour").val($(this).val()); 
		$("#template_table select[name='colour[]'] option[value='"+$(this).val()+"']").attr("selected", true);
	});	 

	// if($(".show-form-disable").length>0){ 
	// 	$("#project input, #output input,#output select, #downbtn input").each(function(){ 
	// 			$(this).attr('disabled', true); 
	// 	});
	// }
	if($(".show-form-disable").length>0 || viewType=="read only"){

		$("#project input, #output input,#output select, .table-subtotal-holder input, #downbtn input").each(function(){
			$(this).attr('disabled', true); 			 
		});		

		$("#cancel").attr('disabled', false);
		
	}

	if($("#frameworktype").length>0 && ($("#frameworktype").children("option:selected").val()=="Drop-In" || $("#frameworktype").val()=="Drop-In" )){
		//alert("here");
		$(".tbody_framework").remove();
	}
	  
	$("table.table-subtotal input").val("");
	$(".table-subtotal-holder").show();

	$("#projectcomm").hide();
	$("#projectcost").hide();
 
 	$("#dbwidthid1").focus(function(){
		$("#output input,#output select").each(function(e){
			$(this).removeAttr('disabled');
		});	

		if(selectedFramework == "Three Bay VR4"){ 
			//disable the master item row is won't into the database after saving.
			$("#cbeam_master input,#cbeam_master select, #gutter_master_l1 input, #gutter_master_l1 select, #gutter_master_l2 input, #gutter_master_l2 select, #poly_master input, #poly_master select, #poly_dummy input, #poly_dummy select").each(function(){ 
					$(this).attr('disabled', true); 
			}); 
		}
		
	});
 

	$("#dblengthid1, #dblengthid2, #dblengthid3, #dblengthid4, #dbwidthid1, #dbbay").change(function(){ 
		//alert($("#dblengthid1").val());
		var tl_vr4 = 0;
		var nBay = 0;
		 
		if(Number($("#dblengthid1").val())<1 || Number($("#dblengthid2").val())<1 || Number($("#dbwidthid1").val())<1 )return;
		  
        $('.length').each(function(){
           $(this).val($('#dblengthid1').val());
        });

        $('.length2').each(function(){ 
           $(this).val($('#dblengthid2').val()); 
        });

        $('.length3').each(function(){ 
           $(this).val($('#dblengthid3').val()); 
        });

        $('.length4').each(function(){ 
           $(this).val($('#dblengthid4').val()); 
        });
 
        $('.width').each(function(){
           $(this).val($('#dbwidthid1').val());
        });
        
 
         
        if(selectedFramework == "Three Bay VR4" || selectedFramework == "Three Bay VR4 - Drop-In"){
        	 
  			var l1 = Number($('#dblengthid1').val());
        	var l2 = Number($('#dblengthid2').val());
        	var l3 = Number($('#dblengthid3').val());
        	var lw = (l1 + l2 + l3).toFixed(2); 

	        $("#cbeam_length").val(lw); 

	        $("#IRV43_length").val(lw);
	        $("#IRV45_length").val(lw);
	        $("#IRV46_length").val(lw);

	        qty1 = Math.floor(5*l1);
	        qty2 = Math.floor(5*l2);
	        qty3 = Math.floor(5*l3);
	        qty4 = 0;

	        $("#louvres-qty-1").val(qty1);
	        $("#louvres-qty-2").val(qty2); 
	        $("#louvres-qty-3").val(qty3); 

        } 

        if(selectedFramework == "Four Bay VR6" || selectedFramework == "Four Bay VR6 - Drop-In"){
        	//var lw = Number($('#dblengthid1').val()) + Number($('#dblengthid2').val()); 
  			var l1 = Number($('#dblengthid1').val());
        	var l2 = Number($('#dblengthid2').val());
        	var l3 = Number($('#dblengthid3').val());
        	var l4 = Number($('#dblengthid4').val());
        	var lw = (l1 + l2 + l3 + l4).toFixed(2); 

	        $("#cbeam_length").val(lw); 

	        $("#IRV43_length").val(lw);
	        $("#IRV45_length").val(lw);
	        $("#IRV46_length").val(lw);
	        $(".length_sum").val(lw);

	        qty1 = Math.floor(5*l1);
	        qty2 = Math.floor(5*l2);
	        qty3 = Math.floor(5*l3);
	        qty4 = Math.floor(5*l4);

	        $("#louvres-qty-1").val(qty1);
	        $("#louvres-qty-2").val(qty2); 
	        $("#louvres-qty-3").val(qty3); 
	         $("#louvres-qty-4").val(qty4); 

        }

        if(selectedFramework == "Three Bay VR5" || selectedFramework == "Three Bay VR5 - Drop-In" ){
        	var l1 = Number($('#dblengthid1').val());
        	var l2 = Number($('#dblengthid2').val());
        	var l3 = Number($('#dblengthid3').val());
        	var lw = (l1 + l2 + l3).toFixed(2); 
        	$("#louvres-len-1").val($('#dblengthid1').val()); 
        	$("#louvres-len-2").val($('#dblengthid2').val()); 
        	$("#louvres-len-3").val($('#dblengthid3').val()); 
        	 
	        $("#cbeam_length").val(lw); 
	        //$("#IRV27_length").val(lw);

	        $("#IRV43_length").val(lw);
	        $("#IRV45_length").val(lw);
	        $("#IRV46_length").val(lw);
	        $(".length_sum").val(lw);

	        
	        $(".tapered_gutter_IRV29_30_length").val(lw); 
	        
	        $("#IRV44_l1").val(l1); 
	        $("#IRV44_l2").val(l2); 
	        $("#IRV280_l1").val(l1);
	        $("#IRV280_l2").val(l2);
	           
        }

        if(selectedFramework == "Four Bay VR7" || selectedFramework == "Four Bay VR7 - Drop-In" ){
        	var l1 = Number($('#dblengthid1').val());
        	var l2 = Number($('#dblengthid2').val());
        	var l3 = Number($('#dblengthid3').val());
        	var l4 = Number($('#dblengthid4').val());
        	var lw = (l1 + l2 + l3 + l4).toFixed(2); 
        	$("#louvres-len-1").val($('#dblengthid1').val()); 
        	$("#louvres-len-2").val($('#dblengthid2').val()); 
        	$("#louvres-len-3").val($('#dblengthid3').val()); 
        	$("#louvres-len-4").val($('#dblengthid4').val()); 
        	 
	        $("#cbeam_length").val(lw); 
	        //$("#IRV27_length").val(lw);

	        $("#IRV43_length").val(lw);
	        $("#IRV45_length").val(lw);
	        $("#IRV46_length").val(lw);
	        $(".length_sum").val(lw);
	        
	        $(".tapered_gutter_IRV29_30_length").val(lw); 
	        
	        $("#IRV44_l1").val(l1); 
	        $("#IRV44_l2").val(l2); 
	        $("#IRV280_l1").val(l1);
	        $("#IRV280_l2").val(l2);
	           
        }
        
        

        $("#output .rrp").each(function(){ //alert("trigger rrp item computation");
        	var rrp = 0;
		 	//console.log($(this).parent().parent("tr").children("td.td-rrp").html());
		 	qty = $(this).parent().parent("tr").children("td.td-qty").children("input").val();
		 	len = $(this).parent().parent("tr").children("td.td-len").children("input:visible").val();
		 	obj = $(this).parent().parent("tr").children("td.td-item").children("select").length;
		 	id = $(this).parent().parent("tr").children("td.td-item").children("input.price").attr("inventoryid");
 

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

			if(typeof(len) == 'undefined' || len<1){
				len = 1;
			}	

		 	rrp = qty*len*price;
 
		 	//make sure the qty has 1 before including the finish rrp.   VR 
		 	if(qty>0){
		 		rrp = rrp + (finishRrp*len*qty) + webbingRrp; 
		 	}
   
		 	$(this).val(rrp.toFixed(2));

		 	selectedFramework = $("#framework option:selected").val();
		 	if(typeof(selectedFramework) == 'undefined'){
		 		selectedFramework = $("#framework").val();
		 	}
  
		 	// //console.log(selectedFramework+" "+$(this).parent().parent("tr").children("td.td-item").children("input.price").attr("inventoryid")); 
		 	// }else 
		 	if((selectedFramework == "Three Bay VR4" || selectedFramework == "Three Bay VR4 - Drop-In") || (selectedFramework == "Four Bay VR6" || selectedFramework == "Four Bay VR6 - Drop-In")){
		 	
		 		if($(this).parent().parent("tr").children("td.td-item").children("input.price").attr("inventoryid") == undefined){
		 			alert("Error encounter!");
		 			return true;
		 		}
		 		
		 		id = $(this).parent().parent("tr").children("td.td-item").children("input.price").attr("inventoryid");
		 		var category = $(this).parent().parent("tr").children("td.td-item").children("select").children("option:selected").attr("category");
		 		//alert(id); 
		 		if(typeof(category) !== 'undefined' && category.length>0 && category.toLowerCase()=="posts"){ 
			 		//console.log("price: "+price+" finishRrp"+finishRrp);
		 			//Compute Gutter lining.
		 			finishRrp = Number($(this).parent().parent("tr").children("td.td-finish-color").children("select").children("option:selected").attr("finishrrp"));	
		 			
					  
		 			rrp = price*qty*len; 
				 	rrp = rrp + (finishRrp*qty*len);  
		 			$(this).parent().parent("tr").children("td.td-rrp").children("input").val(rrp.toFixed(2));
		 
		 		}

		 		if(category == "Louvers"){   
		 			//set the number and cost for the louver 
		 			if(selectedFramework == "Three Bay VR4" || selectedFramework == "Three Bay VR4 - Drop-In"){ 
		 				len1 = $("#louvres-len-1").val();
		 				len2 = $("#louvres-len-2").val();
		 				len3 = $("#louvres-len-3").val();
		 			}else if(selectedFramework == "Four Bay VR6" || selectedFramework == "Four Bay VR6 - Drop-In"){
		 				//len1 = Number($("#dblengthid1").val());// + Number($("#dblengthid2").val());  
		 				//len2 = Number($("#dblengthid2").val());// + Number($("#dblengthid2").val());  
		 				len1 = $("#louvres-len-1").val();
		 				len2 = $("#louvres-len-2").val();
		 				len3 = $("#louvres-len-3").val();
		 				len4 = $("#louvres-len-4").val();
		 			}
		 				
	 				qty = $(this).parent().parent("tr").children("td.td-qty").children("input").val();	

	 				price = Number($(this).parent().parent("tr").children("td.td-item").children("select").children("option:selected").attr("price"));
	 				//alert(price);
	 				 
				 	finishRrp = Number($(this).parent().parent("tr").children("td.td-finish-color").children("select").children("option:selected").attr("finishrrp"));
				 	//w = Number($("#dbwidthid1").val());
				 	w = $(this).parent().parent("tr").children("td.td-len").children("input:visible").val();
				 	//w = $(this).parent().parent("tr").children("td.td-len").children("input:visible").val();

				 	rrp = qty*price*w;
				 // 	console.log("id :"+id);
				 // 	console.log("w :"+w);
					// console.log("price :"+price);
					// console.log("qty :"+qty);
					// console.log("finishRrp :"+finishRrp);
					// console.log("rrp :"+rrp);

					rrp = rrp+(finishRrp*w*qty1); //alert("rrp: "+rrp+" finish: "+finishRrp+" w:"+w+" qty1:"+qty1+ " (finishRrp*w*qty1): "+(finishRrp*w*qty1)); 
	 				//$("#louvres-qty-1").parent().parent("tr").children("td.td-rrp").children("input").val(rrp.toFixed(2));
	 				$(this).parent().parent("tr").children("td.td-rrp").children("input").val(rrp.toFixed(2));

  
	 				//compute endcap qty and cost.
		 			qty = (Number(qty1)+Number(qty2)+Number(qty3)+Number(qty4))*2;
		 			
		 		// 	console.log("qty1 :"+qty1);
					// console.log("qty2 :"+qty2);
					// console.log("qty3 :"+qty3);
					// console.log("qty4 :"+qty4);
					// console.log("qty :"+qty);
		 			 
		 			$("#endcap-qty").val(qty.toFixed(0));  
			 		price = $("#endcap-qty").parent().parent("tr").children("td.td-item").children("input.price").val();
			 		finishRrp = Number($("#pivot-qty-1").parent().parent("tr").children("td.td-finish-color").children("select").children("option:selected").attr("finishrrp"));

		 			rrp = qty*price+finishRrp;
		 			$("#endcap-qty").parent().parent("tr").children("td.td-rrp").children("input").val(rrp.toFixed(2));

		 			//compute 1st pivot qty and cost. 
		 			//qty = len; //Every 5 lourves have 1 pivot strip
		 			//qty = Math.ceil((len*5*2)/12); //pivot strip = no. of endcap / 12 (round up to the nearest unit.) ---(Every 5 lourves have 1 pivot strip-OLD formula)
		 			qty = Math.ceil((qty1*2)/12);
		 			console.log(qty);
		 			$("#pivot-qty-1").val(qty);  
			 		price = $("#pivot-qty-1").parent().parent("tr").children("td.td-item").children("input.price").val(); 
			 		finishRrp = Number($("#pivot-qty-1").parent().parent("tr").children("td.td-finish-color").children("select").children("option:selected").attr("finishrrp"));

		 			rrp = qty*price+finishRrp;
		 			$("#pivot-qty-1").parent().parent("tr").children("td.td-rrp").children("input").val(rrp.toFixed(2));

		 			//compute 2nd pivot qty and cost.  
		 			qty = Math.ceil((qty2*2)/12);
		 			//console.log(qty);
		 			$("#pivot-qty-2").val(qty);  
			 		price = $("#pivot-qty-2").parent().parent("tr").children("td.td-item").children("input.price").val(); 
			 		finishRrp = Number($("#pivot-qty-2").parent().parent("tr").children("td.td-finish-color").children("select").children("option:selected").attr("finishrrp"));
		 			rrp = qty*price+finishRrp;
		 			$("#pivot-qty-2").parent().parent("tr").children("td.td-rrp").children("input").val(rrp.toFixed(2));

		 			qty = Math.ceil((qty3*2)/12);
		 			//console.log(qty);
		 			$("#pivot-qty-3").val(qty);  
			 		price = $("#pivot-qty-3").parent().parent("tr").children("td.td-item").children("input.price").val(); 
			 		finishRrp = Number($("#pivot-qty-3").parent().parent("tr").children("td.td-finish-color").children("select").children("option:selected").attr("finishrrp"));
		 			rrp = qty*price+finishRrp;
		 			$("#pivot-qty-3").parent().parent("tr").children("td.td-rrp").children("input").val(rrp.toFixed(2));
 

		 			//1st link bar 
		 			qty = Math.ceil(qty1/12); 
		 			$("#linkBar-qty-1").val(qty);  
			 		price = $("#linkBar-qty-1").parent().parent("tr").children("td.td-item").children("input.price").val();

		 			rrp = qty*price;
		 			$("#linkBar-qty-1").parent().parent("tr").children("td.td-rrp").children("input").val(rrp.toFixed(2));


		 			//2nd link bar 
		 			qty = Math.ceil(qty2/12); 
		 			$("#linkBar-qty-2").val(qty);  
			 		price = $("#linkBar-qty-2").parent().parent("tr").children("td.td-item").children("input.price").val();

		 			rrp = qty*price;
		 			$("#linkBar-qty-2").parent().parent("tr").children("td.td-rrp").children("input").val(rrp.toFixed(2));


		 			//3nd link bar 
		 			qty = Math.ceil(qty3/12); 
		 			$("#linkBar-qty-3").val(qty);  
			 		price = $("#linkBar-qty-3").parent().parent("tr").children("td.td-item").children("input.price").val();

		 			rrp = qty*price;
		 			$("#linkBar-qty-3").parent().parent("tr").children("td.td-rrp").children("input").val(rrp.toFixed(2));
 

 					if(selectedFramework == "Four Bay VR6" || selectedFramework == "Four Bay VR6 - Drop-In"){
		 				qty = Math.ceil((qty4*2)/12);
		 				$("#pivot-qty-4").val(qty);  
				 		price = $("#pivot-qty-4").parent().parent("tr").children("td.td-item").children("input.price").val(); 
				 		finishRrp = Number($("#pivot-qty-4").parent().parent("tr").children("td.td-finish-color").children("select").children("option:selected").attr("finishrrp"));
			 			rrp = qty*price+finishRrp;
			 			$("#pivot-qty-4").parent().parent("tr").children("td.td-rrp").children("input").val(rrp.toFixed(2));

			 			//4nd link bar 
			 			qty = Math.ceil(qty4/12); 
			 			$("#linkBar-qty-4").val(qty);  
				 		price = $("#linkBar-qty-4").parent().parent("tr").children("td.td-item").children("input.price").val();

			 			rrp = qty*price;
			 			$("#linkBar-qty-4").parent().parent("tr").children("td.td-rrp").children("input").val(rrp.toFixed(2));

		 			}

		 			//compute link bar. 
		 			var no_louvers = (qty1+qty2+qty3+qty4);
		 			//console.log("no_louvers: "+no_louvers);
		 			qty = Math.ceil(no_louvers/12); //pivot strip = no. of endcap / 12 (round up to the nearest unit.) ---(Every 5 lourves have 1 pivot strip-OLD formula)
		 			//console.log("link bay QTY: "+qty);
		 			$("#linkBar-qty").val(qty); 
		 			   
			 		price = $("#linkBar-qty").parent().parent("tr").children("td.td-item").children("input.price").val();

		 			var rrp = qty*price;
		 			$("#linkBar-qty").parent().parent("tr").children("td.td-rrp").children("input").val(rrp.toFixed(2));
 
		 		} 
		 			  
	 		}else if((selectedFramework == "Three Bay VR5" || selectedFramework == "Three Bay VR5 - Drop-In" || selectedFramework == "Four Bay VR7" || selectedFramework == "Four Bay VR7 - Drop-In") && $(this).parent().parent("tr").children("td.td-item").children("input.price").attr("inventoryid") !== undefined){
		 		 
		 		id = $(this).parent().parent("tr").children("td.td-item").children("input.price").attr("inventoryid");
		 		var category = $(this).parent().parent("tr").children("td.td-item").children("select").children("option:selected").attr("category");

		 		if(typeof(category) !== 'undefined' && category.length>0 && category.toLowerCase()=="posts"){ 
			 		//console.log("price finish rrp: "+price+" finishRrp"+finishRrp);
		 			//Compute Gutter lining. 
		 			     
		 			rrp = price*qty*len; 
				 	rrp = rrp + (finishRrp*qty*len);   
		 			$(this).parent().parent("tr").children("td.td-rrp").children("input").val(rrp.toFixed(2)); 
		 		}

		 		if(category == "Louvers"){ 
		 			var rrp = 0;
		 			var len = 0;
		 			var qty=0; qty1=0; qty2=0; qty3=0; qty4=0;


		 			if(selectedFramework == "Three Bay VR5" || selectedFramework == "Three Bay VR5 - Drop-In"){
			 			 
			 			l1 = Number($("#dbwidthid1").val()); 
			 			l2 = Number($("#dbwidthid1").val());
			 			l3 = Number($("#dbwidthid1").val());

			 			len1 = $("#louvres-len-1").val();
			 			len2 = $("#louvres-len-2").val();
			 			len3 = $("#louvres-len-3").val();

			 			$("#louvres-qty-1").val(Math.floor(l1*5));
			 			$("#louvres-qty-2").val(Math.floor(l2*5));
			 			$("#louvres-qty-3").val(Math.floor(l3*5));

			 			qty1 = Math.floor(l1*5);	
			 			qty2 = Math.floor(l2*5); 
			 			qty3 = Math.floor(l3*5); 
			 			len4 = 0;

			 		}else if(selectedFramework == "Four Bay VR7" || selectedFramework == "Four Bay VR7 - Drop-In"){
			 			l1 = Number($("#dbwidthid1").val()); //* Number($("#dbwidthid1").val())
			 			l2 = Number($("#dbwidthid1").val());
			 			l3 = Number($("#dbwidthid1").val());
			 			l4 = Number($("#dbwidthid1").val());

			 			len1 = $("#louvres-len-1").val();
			 			len2 = $("#louvres-len-2").val();
			 			len3 = $("#louvres-len-3").val();
			 			len4 = $("#louvres-len-4").val();

			 			$("#louvres-qty-1").val(Math.floor(l1*5));
			 			$("#louvres-qty-2").val(Math.floor(l2*5));
			 			$("#louvres-qty-3").val(Math.floor(l3*5));
			 			$("#louvres-qty-4").val(Math.floor(l4*5));

			 			qty1 = Math.floor(l1*5);	
			 			qty2 = Math.floor(l2*5); 
			 			qty3 = Math.floor(l3*5); 
			 			qty4 = Math.floor(l4*5); 
			 		}

		 			//1st Louver
		 			priceL1 = $("#louvres-qty-1").parent().parent("tr").children("td.td-item").children("select").children("option:selected").attr("price");
		 			 
		 		// 	console.log("priceL1: ");console.log(priceL1);
		 		// 	console.log("qty1 :"+qty1);
					// console.log("priceL1 :"+priceL1);
					// console.log("len1 :"+len1);
		 			rrp = qty1*priceL1*len1;
		 			//console.log("rrp :"+rrp);	
		 
		 			var finishColor = $(this).parent().parent("tr").children("td.td-finish-color").children("select").length;
					var finishRrp = 0;
				 	if(finishColor>0){ 
					 	finishRrp = Number($("#louvres-qty-1").parent().parent("tr").children("td.td-finish-color").children("select").children("option:selected").attr("finishrrp"));
					 	//console.log("finishrrp: "+finishRrp);
					}
 	
 					// console.log("len1 :"+len1);
					// console.log("priceL1 :"+priceL1);
					// console.log("qty1 :"+qty1);
					// console.log("finishRrp :"+finishRrp);
					// console.log("rrp :"+rrp);

					rrp = rrp+(finishRrp*len1*qty1); 
					//console.log("louvres-qty-1 l1: "+l1);  
		 			$("#louvres-qty-1").parent().parent("tr").children("td.td-rrp").children("input").val(rrp.toFixed(2));
 

 					//2nd Louver
		 			priceL2 = $("#louvres-qty-2").parent().parent("tr").children("td.td-item").children("select").children("option:selected").attr("price");
		 			rrp = qty2*priceL2*len2;	

		 			var finishColor = $(this).parent().parent("tr").children("td.td-finish-color").children("select").length;
					var finishRrp = 0;
				 	if(finishColor>0){ 
					 	finishRrp = Number($("#louvres-qty-2").parent().parent("tr").children("td.td-finish-color").children("select").children("option:selected").attr("finishrrp"));
					 	//console.log("finishrrp: "+finishRrp);
					}
 
					rrp = rrp+(finishRrp*len2*qty2); 
					//console.log("louvres-qty-2 l2: "+l2); 
		 			$("#louvres-qty-2").parent().parent("tr").children("td.td-rrp").children("input").val(rrp.toFixed(2));


		 			//3rd Louver
		 			priceL3 = $("#louvres-qty-3").parent().parent("tr").children("td.td-item").children("select").children("option:selected").attr("price");
		 			rrp = qty3*priceL3*len3;	

		 			var finishColor = $(this).parent().parent("tr").children("td.td-finish-color").children("select").length;
					var finishRrp = 0;
				 	if(finishColor>0){ 
					 	finishRrp = Number($("#louvres-qty-3").parent().parent("tr").children("td.td-finish-color").children("select").children("option:selected").attr("finishrrp"));
					}
 
					rrp = rrp+(finishRrp*len3*qty3);  
		 			$("#louvres-qty-3").parent().parent("tr").children("td.td-rrp").children("input").val(rrp.toFixed(2));

		 			 
		 			if(selectedFramework == "Four Bay VR7" || selectedFramework == "Four Bay VR7 - Drop-In"){
		 				//4rd Louver
			 			priceL4 = $("#louvres-qty-4").parent().parent("tr").children("td.td-item").children("select").children("option:selected").attr("price");
			 			rrp = qty4*priceL4*len4;	

			 			var finishColor = $(this).parent().parent("tr").children("td.td-finish-color").children("select").length;
						var finishRrp = 0;
					 	if(finishColor>0){ 
						 	finishRrp = Number($("#louvres-qty-4").parent().parent("tr").children("td.td-finish-color").children("select").children("option:selected").attr("finishrrp"));
						}
	 
						rrp = rrp+(finishRrp*len4*qty4);  
			 			$("#louvres-qty-4").parent().parent("tr").children("td.td-rrp").children("input").val(rrp.toFixed(2));

			 			//compute endcap qty and cost.
			 			//l1 = len1; //Number($("#dblengthid1").val());
			 			//l2 = len2; //Number($("#dblengthid2").val());
			 			qty = Math.floor(qty1*2)+Math.floor(qty1*2)+Math.floor(qty1*2)+Math.floor(qty1*2);

		 			}else if(selectedFramework == "Three Bay VR5" || selectedFramework == "Three Bay VR5 - Drop-In"){
		 				//compute endcap qty and cost VR5.
			 			//l1 = len1; //Number($("#dblengthid1").val());
			 			//l2 = len2; //Number($("#dblengthid2").val());
			 			qty = Math.floor(qty1*2)+Math.floor(qty1*2)+Math.floor(qty1*2);
		 			}
		 			
		 			//console.log("qty l1:"+l1*5*2);
		 			//console.log("qty l2:"+l2*5*2);
		 			//console.log("qty l3:"+l3*5*2);
		 			$("#endcap-qty").val(qty.toFixed(0)); 
		 			   
			 		price = $("#endcap-qty").parent().parent("tr").children("td.td-item").children("input.price").val();

		 			rrp = qty*price;
		 			$("#endcap-qty").parent().parent("tr").children("td.td-rrp").children("input").val(rrp.toFixed(2));
		 			 
	 				   
		 			//compute 1st pivot qty and cost. 
		 			//qty = len; //Every 5 lourves have 1 pivot strip
		 			qty = Math.ceil((qty1*2)/12);
		 			//console.log(qty);
		 			$("#pivot-qty-1").val(qty);  
			 		price = $("#pivot-qty-1").parent().parent("tr").children("td.td-item").children("input.price").val(); 
		 			rrp = qty*price;
		 			$("#pivot-qty-1").parent().parent("tr").children("td.td-rrp").children("input").val(rrp.toFixed(2));

		 			//compute 2nd pivot qty and cost.  
		 			qty = Math.ceil((qty2*2)/12);
		 			//console.log(qty);
		 			$("#pivot-qty-2").val(qty);  
			 		price = $("#pivot-qty-2").parent().parent("tr").children("td.td-item").children("input.price").val(); 
		 			rrp = qty*price;
		 			$("#pivot-qty-2").parent().parent("tr").children("td.td-rrp").children("input").val(rrp.toFixed(2));

		 			//compute 3nd pivot qty and cost.  
		 			qty = Math.ceil((qty3*2)/12); 
		 			$("#pivot-qty-3").val(qty);  
			 		price = $("#pivot-qty-3").parent().parent("tr").children("td.td-item").children("input.price").val(); 
		 			rrp = qty*price;
		 			$("#pivot-qty-3").parent().parent("tr").children("td.td-rrp").children("input").val(rrp.toFixed(2));

		 			if(selectedFramework == "Four Bay VR7" || selectedFramework == "Four Bay VR7 - Drop-In"){
		 				//compute 4nd pivot qty and cost.  
			 			qty = Math.ceil((qty4*2)/12); 
			 			$("#pivot-qty-4").val(qty);  
				 		price = $("#pivot-qty-4").parent().parent("tr").children("td.td-item").children("input.price").val(); 
			 			rrp = qty*price;
			 			$("#pivot-qty-4").parent().parent("tr").children("td.td-rrp").children("input").val(rrp.toFixed(2));

		 			}
		 				
		 			//1st link bar 
		 			qty = Math.ceil(qty1/12);
		 			//console.log("PIVOT QTY: "+qty);
		 			$("#linkBar-qty-1").val(qty);  
			 		price = $("#linkBar-qty-1").parent().parent("tr").children("td.td-item").children("input.price").val();

		 			rrp = qty*price;
		 			$("#linkBar-qty-1").parent().parent("tr").children("td.td-rrp").children("input").val(rrp.toFixed(2));


		 			//2nd link bar 
		 			qty = Math.ceil(qty2/12); 
		 			$("#linkBar-qty-2").val(qty);  
			 		price = $("#linkBar-qty-2").parent().parent("tr").children("td.td-item").children("input.price").val();

		 			rrp = qty*price; 
		 			$("#linkBar-qty-2").parent().parent("tr").children("td.td-rrp").children("input").val(rrp.toFixed(2));

		 			//3nd link bar 
		 			qty = Math.ceil(qty3/12); 
		 			$("#linkBar-qty-3").val(qty);  
			 		price = $("#linkBar-qty-3").parent().parent("tr").children("td.td-item").children("input.price").val();

		 			rrp = qty*price;
		 			$("#linkBar-qty-3").parent().parent("tr").children("td.td-rrp").children("input").val(rrp.toFixed(2));
 	
 					if(selectedFramework == "Four Bay VR7" || selectedFramework == "Four Bay VR7 - Drop-In"){
 						//4nd link bar 
			 			qty = Math.ceil(qty4/12); 
			 			$("#linkBar-qty-4").val(qty);  
				 		price = $("#linkBar-qty-4").parent().parent("tr").children("td.td-item").children("input.price").val();

			 			rrp = qty*price;
			 			$("#linkBar-qty-4").parent().parent("tr").children("td.td-rrp").children("input").val(rrp.toFixed(2));
 					}
		 			 
		 			//compute link bar.  
		 			//qty = Number($("#dblengthid1").val()) + Number($("#dblengthid2").val());
		 			//console.log("total qty :"+qty);
		 			//console.log("qty1: "+qty1+" qty2:"+qty2);
		 			// var no_louvers = (qty1+qty2+qty3+qty4);
		 			// //console.log("no_louvers: "+no_louvers);
		 			// qty = Math.ceil(no_louvers/12); //pivot strip = no. of endcap / 12 (round up to the nearest unit.) ---(Every 5 lourves have 1 pivot strip-OLD formula)
		 			// //console.log("link bay QTY: "+qty);
		 			// $("#linkBar-qty").val(qty); 
		 			   
			 		// price = $("#linkBar-qty").parent().parent("tr").children("td.td-item").children("input.price").val();

		 			// var rrp = qty*price;
		 			// $("#linkBar-qty").parent().parent("tr").children("td.td-rrp").children("input").val(rrp.toFixed(2)); 

		 		}

  
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
			//end L1, L2, width change
		   	 
		});
 
  		compute_project_cost();
  		isFirstLoad = 0; 
		
	}); //END of L1, L2 and width changed   
 
 
		//Set event to the created select.desclist
	$(document).on("change","#output select.desclist, #output select.paint-list, #output select.webbing-list",function(e){// alert("trigger");
		 	
		 	//trigger_cbo_item(e, this);
		 	qty = $(this).parent().parent("tr").children("td.td-qty").children("input").val();
		 	len = $(this).parent().parent("tr").children("td.td-len").children("input:visible").val();
		 	 
		 	var price = 0; 
		 	var invID = "";
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

			var rrp = 0;
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
			 
			if(typeof(len) == 'undefined' || len==0){
				len = 1;
			} 
		 	rrp = qty*len*price;
		 	rrp = rrp + (finishRrp*len*qty) + webbingRrp; 
		 	  
		 	$(this).parent().parent("tr").children("td.td-rrp").children("input").val(rrp.toFixed(2));
		 	 
		 	var category = $(this).parent().parent("tr").children("td.td-item").children("select").children("option:selected").attr("category");
	  
		 	if(typeof(category) !== 'undefined' && category.length>0 && category.toLowerCase()=="posts"){ 
	 			//Compute Gutter lining.
	 			     
	 			rrp = price*qty*len; 
			 	rrp = rrp + (finishRrp*qty*len);   
	 			$(this).parent().parent("tr").children("td.td-rrp").children("input").val(rrp.toFixed(2));
	 
	 		}else if(category == "Louvers"){
				if($(".show-form").length==0){
					var selectedFramework = $("#framework option:selected").val();
				}else{ 
					var selectedFramework = $("#framework").val(); 
				}


				if(selectedFramework == "Three Bay VR4" || selectedFramework == "Three Bay VR4 - Drop-In" || selectedFramework == "Four Bay VR6" || selectedFramework == "Four Bay VR6 - Drop-In"){
					w = Number($("#dbwidthid1").val()); 

					rrp = (price * qty * w) + (finishRrp*w*qty); //alert(rrp);
				}else if(selectedFramework == "Double Bay VR3" || selectedFramework == "Double Bay VR3 - Gutter" || selectedFramework == "Double Bay VR3 - Drop-In" || selectedFramework == "Double Bay VR3 - Gutter - Drop-In"){
					len = $(this).parent().parent("tr").children("td.td-len").children("input").val(); 
					rrp = (price * qty *len) + (finishRrp*len*qty); 
				} 
 
				 
				$(this).parent().parent("tr").children("td.td-rrp").children("input").val(rrp.toFixed(2));
  
			}

	 		 $(this).parent().parent("tr").children(".invent").val(invID);
		 	 $(this).parent().parent("tr").children(".desc").val(desc);

		 	compute_project_cost();
		 	 
		});

	   
 	$(document).on("change","#output input",function(e){ 	 

	 	var price = 0.00;
	 	var rrp = 0.00;
	 	var id = 0;
	 	var category = "";
	 	var qty = 0;
	 	var len = 0;

	 	qty = $(this).parent().parent("tr").children("td.td-qty").children("input:visible").val();
		len = $(this).parent().parent("tr").children("td.td-len").children("input:visible").val();

		if($(this).val().length>0){
	 		$(this).removeClass("field-warning"); 
	 	}else{  
	 		if($(this).hasClass('qtylen-disbursements')==false){ 
	 			$(this).addClass("field-warning"); 
	 		}
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
	 		//alert("inv: "+c_item+" qty: "+qty +" len: "++" uprice:"+price+ "rrp: "+rrp);
	 		$("#IRV66_qty").val($(this).val());
	 		_qty = $(this).val();
			_price = parseFloat($("#IRV66_qty").parent().parent("tr").children("td.td-item").children("input.price").val()); 
			//alert(price);
			_rrp = _qty*_price; 
			$("#IRV66_qty").parent().parent("tr").children("td.td-rrp").children("input").val(_rrp.toFixed(2));
	 	}else{
	 		//console.log(c_item);
	 	}  

	 	if(typeof(len) == 'undefined'){
			len = 1;
		}
	 	
	 	var category = $(this).parent().parent("tr").children("td.td-item").children("select").children("option:selected").attr("category");
	 	id = $(this).parent().parent("tr").children("td.td-item").children("input.price").attr("inventoryid");
	 	//alert(category);
	 	if(typeof(category) !== 'undefined' && category.toLowerCase()=="posts"){
	 		rrp = qty*price*len;
	 		rrp = rrp + (finishRrp*qty*len);
	 		//alert("inside: 1 ="+rrp);
	 	}else if(typeof(len) !== 'undefined' && len>0){ //if the row item has a length 
	 		rrp = qty*len*price;
	 		rrp = rrp + (finishRrp*len*qty) + webbingRrp;
	 		//alert("inside: 2");
	 	}else{
	 		rrp = qty*price;
	 		rrp = rrp + (finishRrp*qty) + webbingRrp;
	 		//alert("inside: 3");
	 	}
	 	   
	 	if(qty<1){
			$(this).parent().parent("tr").children("td.td-rrp").children("input").val("0.00"); 
	 	}
	  
 
		//if(category != "Louvers"){ //don't need to recompute the pricing after editing the input because louvers row has a built in event change function for recomputation.
			 $(this).parent().parent("tr").children("td.td-rrp").children("input").val(rrp.toFixed(2));
		//}
	 	 
	 	 
	 	compute_project_cost(); 


	});		
 		 
 
	if($(".show-form").length==0){
		
	} 
  
 
	$(document).on("change","#output .gutter-length, #output .gutter-qty",function(e){ 		
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
 		compute_project_cost();

	});

	$(".added-louvres-len, .added-louvres-qty").on("change",added_louvers_handler);	 
 

	//alert($("#projectid").length); 
	if($( "#dblengthid1" ).val()>0 && $("#projectid").length>0){ 
		compute_project_cost();
	}
		
	$('.qtylen, .input-inch').attr('readonly', false);	
	 

 	
	//alert("end of 1st init");
});	//END of first jquery init.

  


 
$(".louver-item-qty, .louver-item-len").change(function(){  //#louvres-len_ft, #louvres-qty
	 	
		var endcap_qty = 0;
		//var louver_qty = 0;
		var index = 0;
		$(".louver-item-qty").each(function(e){ 
		 	qty = Number($(this).val());
		 	//louver_qty = louver_qty+qty;
			endcap_qty += qty*2;   
		});
 
 		
 		index = $(this).attr("id").substring($(this).attr("id").length-1);
 		//alert(index); 

		$("#endcap-qty").val(endcap_qty.toFixed(0)); 
		//$("#louvres-qty").val(qty); 
		qty = $(this).parent().parent("tr").children("td.td-qty").children("input").val();  
	 	len = $(this).parent().parent("tr").children("td.td-len").children("input:visible").val();
	 	 

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
		
		//endcap_qty = $("#endcap-qty").val();
		//alert($("#louvres-qty-"+index).val());
		endcap_qty = $("#louvres-qty-"+index).val()*2;
		qty = Math.ceil(endcap_qty/12);
		//console.log("PIVOT QTY: "+qty);
		$("#pivot-qty-"+index).val(qty);
		   
		price = $("#pivot-qty-"+index).parent().parent("tr").children("td.td-item").children("input.price").val();
		finishRrp = Number($("#pivot-qty-"+index).parent().parent("tr").children("td.td-finish-color").children("select").children("option:selected").attr("finishrrp"));

		var rrp = (qty*price)+finishRrp;
		$("#pivot-qty-"+index).parent().parent("tr").children("td.td-rrp").children("input").val(rrp.toFixed(2));

		//COMPUTE LINK BAR. 
		//len = Number($("#lengthid").val()); 
		//qty = Math.round((len*5*2)/12); //pivot strip = no. of endcap / 12 (round up to the nearest unit.) ---(Every 5 lourves have 1 pivot strip-OLD formula)
		//qty = $("#louvres-qty").val(); 
		qty = Math.ceil(endcap_qty/24); 
		console.log("endcap_qty QTY: "+qty); 
		$("#linkBar-qty-"+index).val(qty); 
		
		price = $("#linkBar-qty-"+index).parent().parent("tr").children("td.td-item").children("input.price").val();
		finishRrp = Number($("#linkBar-qty-"+index).parent().parent("tr").children("td.td-finish-color").children("select").children("option:selected").attr("finishrrp"));

		var rrp = (qty*price)+finishRrp;
		$("#linkBar-qty-"+index).parent().parent("tr").children("td.td-rrp").children("input").val(rrp.toFixed(2));

	  
		compute_project_cost();

	});	


function add_new_louver(){
	
	var tr_index = 0;
	tr_index = tr_index + Number($( ".tr-added-item" ).length) + 1;
	//alert(tr_index);


	$( ".added-louver-tr" ).clone().addClass("tr-added-item tr-added-louver-item tr-louver-"+tr_index).insertBefore( "#vergola_last_row" );
	$( ".added-pivot-strip-tr" ).clone().addClass("tr-added-louver-item tr-pivot-strip-"+tr_index).removeClass("added-pivot-strip-tr").insertBefore( "#vergola_last_row" );
	$( ".added-link-bar-tr" ).clone().addClass("tr-added-louver-item tr-link-bar-"+tr_index).removeClass("added-link-bar-tr").insertBefore( "#vergola_last_row" );
	  
	$(".tr-louver-"+tr_index+" .td-qty input").addClass("added-louvres-qty louver-item-qty louvres-qty-"+tr_index).attr("index",tr_index);
	$(".tr-louver-"+tr_index+" .td-len input").addClass("added-louvres-len louver-item-len louvres-len-"+tr_index).attr("index",tr_index); 

	$(".tr-pivot-strip-"+tr_index+" .td-qty input").addClass("pivot-qty-"+tr_index).attr("index",tr_index);
	$(".tr-link-bar-"+tr_index+" .td-qty input").addClass("link-bar-qty-"+tr_index).attr("index",tr_index);
	 
  	$(".tbody_non_framework .added-louver-tr:last select.desclist").trigger("change");
  	$( ".tr-louver-"+tr_index ).removeClass("added-louver-tr");

	$(".added_item").click(function(){ 
		//console.log($(this).parent().parent().next("tr").html());
		$(this).parent().parent().next("tr").remove();
		$(this).parent().parent().next("tr").remove();
		$(this).parent().parent().remove();
		
		//$(this).parent().parent().next().remove();
		$("#louvres-qty-1").trigger("change");
		compute_project_cost(); 
	});	
 


	$(".added-louvres-len, .added-louvres-qty").on("change",added_louvers_handler);	

	//$(".added-louvres-len").trigger("change");
	$('.qtylen, .input-in').bind('keypress', accept_number); 
	
}

function added_louvers_handler(event){
	var tr_index = "";
	tr_index = $(this).attr("index");
	 
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
	//alert(" id:"+id+" qty:"+qty+" len:"+len+" price:"+price+" finishRrp:"+finishRrp+" rrp:"+rrp);

	$(this).parent().parent("tr").children("td.td-rrp").children("input").val(rrp.toFixed(2));
	   
	//All Additonal item reflected that are affected re-calculate.
	var total_endcap = 0;
	$(".louver-item-qty").each(function(e){ 
	 	qty = $(this).val();
		total_endcap += qty*2;   
	});
	 
	 
	//console.log(qty);
	$("#endcap-qty").val(total_endcap.toFixed(0)); 
	   
	price = $("#endcap-qty").parent().parent("tr").children("td.td-item").children("input.price").val();
	finishRrp = Number($("#endcap-qty").parent().parent("tr").children("td.td-finish-color").children("select").children("option:selected").attr("finishrrp"));
	qty = Number($("#endcap-qty").val());

	rrp = qty*price;
	rrp = rrp + finishRrp;
	$("#endcap-qty").parent().parent("tr").children("td.td-rrp").children("input").val(rrp.toFixed(2));
 
    //endcap_qty = Number($("#endcap-qty").val());
    qty = $(this).parent().parent("tr").children("td.td-qty").children("input").val();
    endcap_qty = qty*2;
	pivot_qty = Math.ceil(endcap_qty/12); 

	
	$(".pivot-qty-"+tr_index).val(pivot_qty); 
	   
	price = $(".pivot-qty-"+tr_index).parent().parent("tr").children("td.td-item").children("input.price").val();
	//finishRrp = Number($("#pivot-qty").parent().parent("tr").children"(td.td-finish-color").children("select").children("option:selected").attr("finishrrp"));

	var rrp = (pivot_qty*price);
	$(".pivot-qty-"+tr_index).parent().parent("tr").children("td.td-rrp").children("input").val(rrp.toFixed(2));

	//COMPUTE LINK BAR.
	//len = Number($(this).parent().parent("tr").children("td.td-len").children("input:visible").val()); 
	//qty = Math.round((len*5*2)/12); //pivot strip = no. of endcap / 12 (round up to the nearest unit.) ---(Every 5 lourves have 1 pivot strip-OLD formula)
	//qty = $(this).parent().parent("tr").children("td.td-qty").children("input").val();			
	qty = Math.ceil(endcap_qty/24);
	//console.log("PIVOT QTY: "+qty);
	$(".link-bar-qty-"+tr_index).val(qty); 
	
	price = $(".link-bar-qty-"+tr_index).parent().parent("tr").children("td.td-item").children("input.price").val();
	
	var rrp = (qty*price);
	$(".link-bar-qty-"+tr_index).parent().parent("tr").children("td.td-rrp").children("input").val(rrp.toFixed(2));

	compute_project_cost();	
}


function compute_project_cost(){ //alert("trigger0");
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
 
	total_vergola = (total_rrp - total_disbursement) / 0.75;

	var com_sales_commission = total_vergola * 0.1;
	var com_sales_commission_ps = 0;
	var com_pay1 = com_sales_commission * 0.4;
	var com_pay2 = com_sales_commission * 0.3;
	var com_final = com_sales_commission * 0.3;
	var com_installer_payment = total_vergola * 0.13;
 
	//total_gst = (total_vergola+total_disbursement) * 0.1;
	//total_sum = total_rrp + total_gst;
	sub_total = total_vergola + total_disbursement; 
	total_gst = (total_vergola+total_disbursement) * 0.1;
	//total_sum = total_rrp + total_gst;

	total_sum = sub_total + total_gst; 

	// console.log("total_rrp: "+total_rrp);
	// console.log("total_vergola: "+total_vergola);
	// console.log("total_disbursement: "+total_disbursement);
	// console.log("total_gst: "+total_gst);
	// console.log("total_sum: "+total_sum);

	$("#sub_total").val(sub_total.toFixed(2));
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

 
	$("#com_sales_commission").val(com_sales_commission.toFixed(2));
	$("#com_sales_commission_ps").val(com_sales_commission_ps.toFixed(2));
	$("#com_pay1").val(com_pay1.toFixed(2));
	$("#com_pay2").val(com_pay2.toFixed(2));
	$("#com_final").val(com_final.toFixed(2));
	$("#com_installer_payment").val(com_installer_payment.toFixed(2));

}



function add_new_post(){ 
 
	$( "#additional_post tr" ).clone().insertBefore( "#framework_last_row" );
	  

	$(".added_item").click(function(){ 
		$(this).parent().parent().remove();
		compute_project_cost(); 
	});	 

	 
	$(".tbody_framework .added-post-tr:last select.desclist").trigger("change");
	$('.qtylen, .input-in').bind('keypress', accept_number); 
	 
}

function add_new_gutter(){
	
 
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
	 
	$( "#additional_non_standard_gutter tr" ).clone().insertBefore( "#gutter_last_row" );
	//$("select.desclist").trigger("change");

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
	 
	$( "#additional_flashing tr" ).clone().insertBefore( "#flashing_last_row" );
	  
	$(".added_item").click(function(){ 
		$(this).parent().parent().remove(); 
		compute_project_cost(); 
	});

	$(".tbody_non_framework .added-flashing-tr:last select.desclist").trigger("change");	
	$('.qtylen, .input-in').bind('keypress', accept_number); 
}

function add_new_misc(){
	 
	$( "#additional_misc tr" ).clone().insertBefore( "#misc_last_row" ); 

	$(".added_item").click(function(){ 
		$(this).parent().parent().remove();
		compute_project_cost(); 
	});	

	$(".tbody_non_framework .added-misc-tr:last select.desclist").trigger("change");
	$('.qtylen').bind('keypress', accept_number); 
}

function add_new_extra(){
	 
	$( "#additional_extra tr" ).clone().insertBefore( "#extra_last_row" );
	//$("select.desclist").trigger("change");

	$(".added_item").click(function(){ 
		$(this).parent().parent().remove();
		compute_project_cost(); 
	});	

	$(".tbody_non_framework .added-extra-tr:last select.desclist").trigger("change");
	$('.qtylen').bind('keypress', accept_number); 
}


function add_new_fixing(){
 
	$( "#additional_fixing tr" ).clone().insertBefore( "#fixing_last_row" );
	  
	$(".added_item").click(function(){ 
		$(this).parent().parent().remove();
		compute_project_cost(); 
	});	

	$(".tbody_framework .added-fixing-tr:last select.desclist").trigger("change"); 
	$('.qtylen').bind('keypress', accept_number); 
}

function add_new_downpipe(){
	
	//console.log($("#additional_none_standard_gutter tr").html());
	//$( "#framework_last_row" ).appendTo( $( "#framework_last_row" )  );
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
			    
			  }else{
			  	 
			  }

            break;
        }
	}