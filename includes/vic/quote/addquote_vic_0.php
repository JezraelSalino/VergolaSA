<link rel="stylesheet" type="text/css" media="screen,projection" href="<?php echo JURI::base().'jscript/new-enquiry.css'; ?>" />
<link rel="stylesheet" type="text/css" media="screen,projection" href="<?php echo JURI::base().'jscript/client-folder.css'; ?>" />
<script src="<?php echo JURI::base().'jscript/jquery.min.js'; ?>"></script>
<?php
$sql_dformat = SQL_DFORMAT;

$QuoteID = '';
if(isset($_REQUEST['quoteid']) )
{
	$QuoteID = $_REQUEST['quoteid'];
}

if(isset($_POST['save-singlebay-vr1']) || isset($_POST['save-close-singlebay-vr1']))
{
	require 'singlebay_vic_vr1.php';
}

if(isset($_POST['save-singlebay-vr0']) || isset($_POST['save-close-singlebay-vr0']))
{
	require 'singlebay_vic_vr0.php';
}

if(isset($_POST['save-doublebay-vr2']) || isset($_POST['save-close-doublebay-vr2']))
{
	require 'doublebay_vic_vr2.php';
}

if(isset($_POST['save-doublebay-vr3']) || isset($_POST['save-close-doublebay-vr3']))
{
	require 'doublebay_vic_vr3.php';
}

if(isset($_POST['save-doublebay-vr3-gutter']) || isset($_POST['save-close-doublebay-vr3-gutter']))
{
	require 'doublebay_vic_vr3_thru_gutter.php';
}

if(isset($_POST['save-doublebay-vr4']) || isset($_POST['save-close-doublebay-vr4']))
{
	require 'doublebay_vic_vr4.php';
}

if(isset($_POST['save-doublebay-vr6']) || isset($_POST['save-close-doublebay-vr6']))
{
	require 'doublebay_vic_vr6.php';
}

if(isset($_POST['save-doublebay-vr5']) || isset($_POST['save-close-doublebay-vr5']))
{
	require 'doublebay_vic_vr5.php';
}

if(isset($_POST['save-doublebay-vr7']) || isset($_POST['save-close-doublebay-vr7']))
{
	require 'doublebay_vic_vr7.php';
}

if(isset($_POST['save-singlebay-vs1']) || isset($_POST['save-close-singlebay-vs1']))
{
	require 'singlebay_vic_vs1.php';
}
//return; 
//error_log(print_r($_POST,true), 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_sa_prod\\my-error.log');//exit;
$fw = "";
$fwt = "";
if(isset($_REQUEST['fw'])){
	$fw = $_REQUEST['fw'];
}

if(isset($_REQUEST['fwt'])){
	$fwt = $_REQUEST['fwt'];
}

global $inventory_table;  
if(METRIC_SYSTEM=="inch" && IS_TEST_MODE == '1'){
	$inventory_table = "ver_chronoforms_data_inventory_vic_inch";
}else{
	$inventory_table = "ver_chronoforms_data_inventory_vic";
}

 
$PID = substr($QuoteID,3);
$BeamIDArrayPhp = '';
$BeamDESCArrayPhp = '';
$BeamRRPArrayPhp = '';
$BeamCOSTArrayPhp = '';
$BeamUOMArrayPhp = '';
$user = JFactory::getUser();

$is_tender_quote=0;
$is_builder = 0;

if(substr($QuoteID, 0,3)=="TRV"){
	$sql = "SELECT * FROM ver_chronoforms_data_builderpersonal_vic WHERE tenderid  = '$QuoteID' LIMIT 1";
	$is_tender_quote=1;
	$is_builder = 1;

}else{
	$sql = "SELECT * FROM ver_chronoforms_data_clientpersonal_vic WHERE clientid  = '$QuoteID'";	
}
//error_log($sql, 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_sa_prod\\my-error.log');exit();

$qResult = mysql_query($sql);
$_client = mysql_fetch_array($qResult);

$restable = mysql_query("SELECT * FROM ver_chronoforms_data_systable_vic WHERE cf_id  = '1'");
$rettable = mysql_fetch_array($restable);
if (!$rettable) {die("Error: Data not found..");}
$GST = $rettable['gst'];
$Commision = $rettable['commision'];
$SalesComm=$rettable['sales_comm'];
$InstallComm=$rettable['install_comm'];


//error_log(substr($QuoteID,3), 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_sa_prod\\my-error.log');
// if(substr($QuoteID,0,3)=="BRV"){
// 	$is_builder = 1;
// 	//error_log('is builder ddsaecsadfa;l;po lld', 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_sa_prod\\my-error.log');
// } 
//error_log($QuoteID, 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_sa_prod\\my-error.log');
?> 

<script>



function change_framework_type()
{
	var quoteid_param = "";
	 var fw_param = "";
	 var fw_type_param = "";

	 if($("#_quoteid").length>0){
	 	quoteid_param = "?quoteid="+$("#_quoteid").val();
	 }
	 
	 var fw = $("#framework").children("option:selected").val();
	 //alert("framework_type: "+fw);
	 if(fw=="Single Bay VR1" || fw=="Single Bay VR1 - Drop-In"){
	 	fw_param = "&fw="+"VR1"; 
	 }else if(fw=="Single Bay VR0" || fw=="Single Bay VR0 - Drop-In"){
	 	fw_param = "&fw="+"VR0"; 
	 }else if(fw=="Double Bay VR2" || fw=="Double Bay VR2 - Drop-In"){
	 	fw_param = "&fw="+"VR2"; 
	 }else if(fw=="Double Bay VR3" || fw=="Double Bay VR3 - Drop-In"){
	 	fw_param = "&fw="+"VR3"; 
	 }else if(fw=="Double Bay VR3 - Gutter" || fw=="Double Bay VR3 - Gutter - Drop-In"){
	 	fw_param = "&fw="+"VR3-G"; 
	 }else if(fw=="Three Bay VR4" || fw=="Three Bay VR4 - Drop-In"){
	 	fw_param = "&fw="+"VR4"; 
	 }else if(fw=="Four Bay VR6" || fw=="Four Bay VR6 - Drop-In"){
	 	fw_param = "&fw="+"VR6"; 
	 }else if(fw=="Three Bay VR5" || fw=="Three Bay VR5 - Drop-In"){
	 	fw_param = "&fw="+"VR5"; 
	 }else if(fw=="Four Bay VR7" || fw=="Four Bay VR7 - Drop-In"){
	 	fw_param = "&fw="+"VR7"; 
	 }else if(fw=="Single Bay VS1"){
	 	fw_param = "&fw="+"VS1"; 
	 }  

	 var fwt = $("#frameworktype").children("option:selected").val();
	 if(fwt=="Framework"){
	 	fw_type_param = "&fwt="+"fw"; 
	 }else{
	 	fw_type_param = "&fwt="+"drop-in"; 
	 }

	var ref = "&ref="+$("#ref").val();

	location.href="<?php echo JURI::base()."add-quote-vic"; ?>"+quoteid_param+fw_param+fw_type_param+ref;
 	//error_log('is VR5', 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_sa_prod\\my-error.log');
}

function change_framework()
{ 

	var quoteid_param = "";
	var fw_param = "";
	var fw_type_param = "";

	if($("#_quoteid").length>0){
	 	quoteid_param = "?quoteid="+$("#_quoteid").val();
	}
	 
	var fw = $("#framework").children("option:selected").val(); 
	if(fw=="Single Bay VR1" || fw=="Single Bay VR1 - Drop-In"){
	 	fw_param = "&fw="+"VR1"; 
	}else if(fw=="Single Bay VR0" || fw=="Single Bay VR0 - Drop-In"){
	 	fw_param = "&fw="+"VR0"; 
	}else if(fw=="Double Bay VR2" || fw=="Double Bay VR2 - Drop-In"){
	 	fw_param = "&fw="+"VR2"; 
	}else if(fw=="Double Bay VR3" || fw=="Double Bay VR3 - Drop-In"){
		fw_param = "&fw="+"VR3"; 
	}else if(fw=="Double Bay VR3 - Gutter" || fw=="Double Bay VR3 - Gutter - Drop-In"){
	 	fw_param = "&fw="+"VR3-G";
	}else if(fw=="Three Bay VR4" || fw=="Three Bay VR4 - Drop-In"){
	 	fw_param = "&fw="+"VR4"; 
	}else if(fw=="Four Bay VR6" || fw=="Four Bay VR6 - Drop-In"){
	 	fw_param = "&fw="+"VR6"; 
	}else if(fw=="Three Bay VR5" || fw=="Three Bay VR5 - Drop-In"){
	 	fw_param = "&fw="+"VR5"; 
	}else if(fw=="Four Bay VR7" || fw=="Four Bay VR7 - Drop-In"){
	 	fw_param = "&fw="+"VR7"; 
	}else if(fw=="Single Bay VS1"){
	 	fw_param = "&fw="+"VS1"; 
	}   

	 var fwt = $("#frameworktype").children("option:selected").val();
	 if(fwt=="Framework"){
	 	fw_type_param = "&fwt="+"fw"; 
	 }else{
	 	fw_type_param = "&fwt="+"drop-in";
	 }

	 var ref = "&ref="+$("#ref").val();
	location.href="<?php echo JURI::base()."add-quote-vic"; ?>"+quoteid_param+fw_param+fw_type_param+ref;
 
  
}
</script>
<script>
$(document).ready(function() {

	$('#save-dropin').css({display: "none"});
	$('#save-close-dropin').css({display: "none"});
	$('#save-dropin-down').css({display: "none"});
	$('#save-close-dropin-down').css({display: "none"});
	$('#save-singlebay').css({display: "none"});
	$('#save-close-singlebay').css({display: "none"});
	$('#save-singlebay-down').css({display: "none"});
	$('#save-close-singlebay-down').css({display: "none"});
	$('#save-doublebay').css({display: "none"});
	$('#save-close-doublebay').css({display: "none"});
	$('#save-doublebay-down').css({display: "none"});
	$('#save-close-doublebay-down').css({display: "none"});
	$('#save-multiplebay').css({display: "none"});
	$('#save-close-multiplebay').css({display: "none"});
	$('#save-multiplebay-down').css({display: "none"});
	$('#save-close-multiplebay-down').css({display: "none"});
	$('#save-gable').css({display: "none"});
	$('#save-close-gable').css({display: "none"});
	$('#save-gable-down').css({display: "none"});
	$('#save-close-gable-down').css({display: "none"});
	$('#save-angle').css({display: "none"});
	$('#save-close-angle').css({display: "none"});
	$('#save-angle-down').css({display: "none"});
	$('#save-close-angle-down').css({display: "none"});
	$('#cancel-down').css({display: "none"});
	 

	var frmSEL = document.getElementById("framework")
	var frmLEN = document.getElementById("lengthid")
	var frmWID = document.getElementById("widthid")
	var frmBAY = document.getElementById("bayid")
	var frmDBLEN1 = document.getElementById("dblengthid1")
	var frmDBWID1 = document.getElementById("dbwidthid1")
	var frmDBLEN2 = document.getElementById("dblengthid2")
	var frmDBWID2 = document.getElementById("dbwidthid2")


	
 

    //$('#framework').change( function() {
	   
	   var selectedValue = $("#framework").val();
	   
   //     $.ajax({ // create an AJAX call...
   //         data: $('#chronoform_Add_Quote_Vic').serialize(), // serialize the form
   //         type: $('#chronoform_Add_Quote_Vic').attr('method'), // GET or POST from the form
   //         url: $('#chronoform_Add_Quote_Vic').attr('action'), // the file to call from the form
   //         success: function(response) { // on success..
		    
			// $("#dblengthid1").change(function(){
   //             $('.length').each(function(){
   //             $(this).val($('#dblengthid1').val());
   //            });
   //             });
			// $("#dblengthid2").change(function(){
   //             $('.length2').each(function(){
   //             $(this).val($('#dblengthid2').val());
   //            });
   //             });
		 //    $("#dbwidthid1").change(function(){
   //             $('.width').each(function(){
   //             	$(this).val($('#dbwidthid1').val());
   //          	});
   //          });
  
		 
		if ('' == selectedValue || selectedValue == " - Drop-In") { 
			//alert("1" + selectedValue);
			$('#save-dropin').css({display: "none"});
			$('#save-close-dropin').css({display: "none"});
			$('#save-dropin-down').css({display: "none"});
			$('#save-close-dropin-down').css({display: "none"});
			$('#save-singlebay').css({display: "none"});
			$('#save-close-singlebay').css({display: "none"});
			$('#save-singlebay-down').css({display: "none"});
			$('#save-close-singlebay-down').css({display: "none"});
			$('#save-doublebay').css({display: "none"});
			$('#save-close-doublebay').css({display: "none"});
			$('#save-doublebay-down').css({display: "none"});
			$('#save-close-doublebay-down').css({display: "none"});
			$('#save-multiplebay').css({display: "none"});
			$('#save-close-multiplebay').css({display: "none"});
			$('#save-multiplebay-down').css({display: "none"});
			$('#save-close-multiplebay-down').css({display: "none"});
			$('#save-gable').css({display: "none"});
			$('#save-close-gable').css({display: "none"});
			$('#save-gable-down').css({display: "none"});
			$('#save-close-gable-down').css({display: "none"});
			$('#save-angle').css({display: "none"});
			$('#save-close-angle').css({display: "none"});
			$('#save-angle-down').css({display: "none"});
			$('#save-close-angle-down').css({display: "none"});
			$('#cancel-down').css({display: "none"});
			//$('#output').html('<?php //echo ""; ?>');
			   
		}
		 
		<?php if($fw=="VR1"){ ?>	
			$('#save-dropin').css({display: "none"});
			$('#save-close-dropin').css({display: "none"});
			$('#save-dropin-down').css({display: "none"});
			$('#save-close-dropin-down').css({display: "none"});
			$('#save-singlebay').css({display: "inline-block"});
			$('#save-close-singlebay').css({display: "inline-block"});
			$('#save-singlebay-down').css({display: "inline-block"});
			$('#save-close-singlebay-down').css({display: "inline-block"});
			$('#save-doublebay').css({display: "none"});
			$('#save-close-doublebay').css({display: "none"});
			$('#save-doublebay-down').css({display: "none"});
			$('#save-close-doublebay-down').css({display: "none"});
			$('#save-multiplebay').css({display: "none"});
			$('#save-close-multiplebay').css({display: "none"});
			$('#save-multiplebay-down').css({display: "none"});
			$('#save-close-multiplebay-down').css({display: "none"});
			$('#save-gable').css({display: "none"});
			$('#save-close-gable').css({display: "none"});
			$('#save-gable-down').css({display: "none"});
			$('#save-close-gable-down').css({display: "none"});
			$('#save-angle').css({display: "none"});
			$('#save-close-angle').css({display: "none"});
			$('#save-angle-down').css({display: "none"}); 
			$('#save-close-angle-down').css({display: "none"});
			$('#cancel-down').css({display: "inline-block"});
			if(selectedValue == 'Single Bay VR1' || 'Single Bay VR1 - Drop-In' == selectedValue){
				 //$('#output').html('<?php //require 'singlebay_vic_vr1.php'; ?>'); // update the DIV 
				
				<?php if(METRIC_SYSTEM=="inch"){ ?>
					$.getScript('<?php echo JURI::base().'jscript/singlebay_vr1_inch.js?v='.mt_rand(); ?>');
				<?php }else{ ?>
					$.getScript('<?php echo JURI::base().'jscript/singlebay_vr1.js?v='.mt_rand(); ?>');
				<?php } ?>	 
			 
			} 
 
			frmLEN.disabled = false;
			frmWID.disabled = false;
			frmBAY.disabled = true;
		    frmDBLEN1.disabled = true;
			frmDBWID1.disabled = true;
			frmDBLEN2.disabled = true;
			frmDBWID2.disabled = true;
			document.getElementById('length').style.display = 'inline-block'; 
			document.getElementById('width').style.display = 'inline-block'; 
			document.getElementById('bay').style.display = 'none'; 
			document.getElementById('doubletable').style.display = 'none';
			document.getElementById('lblL1').style.display = 'inline-block'; 
			document.getElementById('lblL2').style.display = 'inline-block'; 
			document.getElementById('lblBay').style.display = 'none'; 
			document.getElementById('lblLBay').style.display = 'none';
		     
		    $("#save-singlebay").attr("name","save-singlebay-vr1");
		    $("#save-close-singlebay").attr("name","save-close-singlebay-vr1");

		    $("#save-singlebay-down").attr("name","save-singlebay-vr1");
		    $("#save-close-singlebay-down").attr("name","save-close-singlebay-vr1");
 			 
			
		<?php } else if($fw == "VR0"){ ?>
			$('#save-dropin').css({display: "none"});
			$('#save-close-dropin').css({display: "none"});
			$('#save-dropin-down').css({display: "none"});
			$('#save-close-dropin-down').css({display: "none"});
			$('#save-singlebay').css({display: "inline-block"});
			$('#save-close-singlebay').css({display: "inline-block"});
			$('#save-singlebay-down').css({display: "inline-block"});
			$('#save-close-singlebay-down').css({display: "inline-block"});
			$('#save-doublebay').css({display: "none"});
			$('#save-close-doublebay').css({display: "none"});
			$('#save-doublebay-down').css({display: "none"});
			$('#save-close-doublebay-down').css({display: "none"});
			$('#save-multiplebay').css({display: "none"});
			$('#save-close-multiplebay').css({display: "none"});
			$('#save-multiplebay-down').css({display: "none"});
			$('#save-close-multiplebay-down').css({display: "none"});
			$('#save-gable').css({display: "none"});
			$('#save-close-gable').css({display: "none"});
			$('#save-gable-down').css({display: "none"});
			$('#save-close-gable-down').css({display: "none"});
			$('#save-angle').css({display: "none"});
			$('#save-close-angle').css({display: "none"});
			$('#save-angle-down').css({display: "none"}); 
			$('#save-close-angle-down').css({display: "none"});
			$('#cancel-down').css({display: "inline-block"});
			if(selectedValue == 'Single Bay VR0' || 'Single Bay VR0 - Drop-In' == selectedValue){
				//$('#output').html('<?php //require 'singlebay_vic_vr0.php'; ?>'); // update the DIV 
				
				<?php if(METRIC_SYSTEM=="inch"){ ?>
					$.getScript('<?php echo JURI::base().'jscript/singlebay_vr1_inch.js?v='.mt_rand(); ?>');
				<?php }else{ ?>
					$.getScript('<?php echo JURI::base().'jscript/singlebay_vr1.js?v='.mt_rand(); ?>');
				<?php } ?>	
				
			 
			} 
 
			frmLEN.disabled = false;
			frmWID.disabled = false;
			frmBAY.disabled = true;
		    frmDBLEN1.disabled = true;
			frmDBWID1.disabled = true;
			frmDBLEN2.disabled = true;
			frmDBWID2.disabled = true;
			document.getElementById('length').style.display = 'inline-block'; 
			document.getElementById('width').style.display = 'inline-block'; 
			document.getElementById('bay').style.display = 'none'; 
			document.getElementById('doubletable').style.display = 'none';
			document.getElementById('lblL1').style.display = 'inline-block'; 
			document.getElementById('lblL2').style.display = 'inline-block'; 
			document.getElementById('lblBay').style.display = 'none'; 
			document.getElementById('lblLBay').style.display = 'none';
		     
		    $("#save-singlebay").attr("name","save-singlebay-vr0");
		    $("#save-close-singlebay").attr("name","save-close-singlebay-vr0");

		    $("#save-singlebay-down").attr("name","save-singlebay-vr0");
		    $("#save-close-singlebay-down").attr("name","save-close-singlebay-vr0");


		<?php } else if($fw == "VR2"){ ?>
			 
		   //	alert("here 1"); 
			$('#save-dropin').css({display: "none"});
			$('#save-close-dropin').css({display: "none"});
			$('#save-dropin-down').css({display: "none"});
			$('#save-close-dropin-down').css({display: "none"});
			$('#save-singlebay').css({display: "none"});
			$('#save-close-singlebay').css({display: "none"});
			$('#save-singlebay-down').css({display: "none"});
			$('#save-close-singlebay-down').css({display: "none"});
			$('#save-doublebay').css({display: "inline-block"});
			$('#save-close-doublebay').css({display: "inline-block"});
			$('#save-doublebay-down').css({display: "inline-block"});
			$('#save-close-doublebay-down').css({display: "inline-block"});
			$('#save-multiplebay').css({display: "none"});
			$('#save-close-multiplebay').css({display: "none"});
			$('#save-multiplebay-down').css({display: "none"});
			$('#save-close-multiplebay-down').css({display: "none"});
			$('#save-gable').css({display: "none"});
			$('#save-close-gable').css({display: "none"});
			$('#save-gable-down').css({display: "none"});
			$('#save-close-gable-down').css({display: "none"});
			$('#save-angle').css({display: "none"});
			$('#save-close-angle').css({display: "none"});
			$('#save-angle-down').css({display: "none"});
			$('#save-close-angle-down').css({display: "none"});
			$('#cancel-down').css({display: "inline-block"});
			if('Double Bay VR2' == selectedValue    || 'Double Bay VR2 - Drop-In' == selectedValue  ){
 				//$('#output').html('<?php //require "doublebay_vic_vr2.php"; ?>');

			  
				<?php if(METRIC_SYSTEM=="inch"){ ?>
					$.getScript('<?php echo JURI::base().'jscript/doublebay_vr2_inch.js?v='.mt_rand(); ?>');
				<?php }else{ ?>
					$.getScript('<?php echo JURI::base().'jscript/doublebay_vr2.js?v='.mt_rand(); ?>');
				<?php } ?>


			} 
			 
		    frmDBLEN1.disabled = false;
			frmDBWID1.disabled = false;
			frmDBLEN2.disabled = false;
			frmDBWID2.disabled = false;
			 
			document.getElementById('lblL1').style.display = 'inline-block'; 
			document.getElementById('lblL2').style.display = 'inline-block'; 
			document.getElementById('lblBay').style.display = 'none'; 
			document.getElementById('lblLBay').style.display = 'none';
		    // alert("here 4"); 
		    $("#save-doublebay").attr("name","save-doublebay-vr2");
		    $("#save-close-doublebay").attr("name","save-close-doublebay-vr2");

		    $("#save-doublebay-down").attr("name","save-doublebay-vr2");
		    $("#save-close-doublebay-down").attr("name","save-close-doublebay-vr2");

		   // alert("here 5"); 
		<?php } else if($fw == "VR3"){ ?>	   
			  
			$('#save-dropin').css({display: "none"});
			$('#save-close-dropin').css({display: "none"});
			$('#save-dropin-down').css({display: "none"});
			$('#save-close-dropin-down').css({display: "none"});
			$('#save-singlebay').css({display: "none"});
			$('#save-close-singlebay').css({display: "none"});
			$('#save-singlebay-down').css({display: "none"});
			$('#save-close-singlebay-down').css({display: "none"});
			$('#save-doublebay').css({display: "inline-block"});
			$('#save-close-doublebay').css({display: "inline-block"});
			$('#save-doublebay-down').css({display: "inline-block"});
			$('#save-close-doublebay-down').css({display: "inline-block"});
			$('#save-multiplebay').css({display: "none"});
			$('#save-close-multiplebay').css({display: "none"});
			$('#save-multiplebay-down').css({display: "none"});
			$('#save-close-multiplebay-down').css({display: "none"});
			$('#save-gable').css({display: "none"});
			$('#save-close-gable').css({display: "none"});
			$('#save-gable-down').css({display: "none"});
			$('#save-close-gable-down').css({display: "none"});
			$('#save-angle').css({display: "none"});
			$('#save-close-angle').css({display: "none"});
			$('#save-angle-down').css({display: "none"});
			$('#save-close-angle-down').css({display: "none"});
			$('#cancel-down').css({display: "inline-block"});
			 
			//$('#output').html('<?php //require "doublebay_vic_vr3.php"; ?>');

			<?php if(METRIC_SYSTEM=="inch"){ ?>
				$.getScript('<?php echo JURI::base().'jscript/doublebay_vr2_inch.js?v='.mt_rand(); ?>');
			<?php }else{ ?>
				$.getScript('<?php echo JURI::base().'jscript/doublebay_vr2.js?v='.mt_rand(); ?>');
			<?php } ?>

		  
			// frmLEN.disabled = true;
			// frmWID.disabled = true;
			// frmBAY.disabled = true;
		    frmDBLEN1.disabled = false;
			frmDBWID1.disabled = false;
			frmDBLEN2.disabled = false;
			frmDBWID2.disabled = false;
			// document.getElementById('length').style.display = 'none'; 
			// document.getElementById('width').style.display = 'none'; 
			// document.getElementById('bay').style.display = 'none'; 
			//document.getElementById('doubletable').style.display = 'inline-block';
			document.getElementById('lblL1').style.display = 'inline-block';
			document.getElementById('lblL2').style.display = 'inline-block'; 
			document.getElementById('lblBay').style.display = 'none'; 
			document.getElementById('lblLBay').style.display = 'none';
		     
		    $("#save-doublebay").attr("name","save-doublebay-vr3");
		    $("#save-close-doublebay").attr("name","save-close-doublebay-vr3");

		    $("#save-doublebay-down").attr("name","save-doublebay-vr3");
		    $("#save-close-doublebay-down").attr("name","save-close-doublebay-vr3");
			 
        // else if ('Double Bay VR3 - Gutter' == selectedValue  || 'Double Bay VR3 - Gutter - Drop-In' == selectedValue) 
		<?php } else if($fw == "VR3-G"){ ?>	 
			 
			$('#save-dropin').css({display: "none"});
			$('#save-close-dropin').css({display: "none"});
			$('#save-dropin-down').css({display: "none"});
			$('#save-close-dropin-down').css({display: "none"});
			$('#save-singlebay').css({display: "none"});
			$('#save-close-singlebay').css({display: "none"});
			$('#save-singlebay-down').css({display: "none"});
			$('#save-close-singlebay-down').css({display: "none"});
			$('#save-doublebay').css({display: "inline-block"});
			$('#save-close-doublebay').css({display: "inline-block"});
			$('#save-doublebay-down').css({display: "inline-block"});
			$('#save-close-doublebay-down').css({display: "inline-block"});
			$('#save-multiplebay').css({display: "none"});
			$('#save-close-multiplebay').css({display: "none"});
			$('#save-multiplebay-down').css({display: "none"});
			$('#save-close-multiplebay-down').css({display: "none"});
			$('#save-gable').css({display: "none"});
			$('#save-close-gable').css({display: "none"});
			$('#save-gable-down').css({display: "none"});
			$('#save-close-gable-down').css({display: "none"});
			$('#save-angle').css({display: "none"});
			$('#save-close-angle').css({display: "none"});
			$('#save-angle-down').css({display: "none"});
			$('#save-close-angle-down').css({display: "none"});
			$('#cancel-down').css({display: "inline-block"});
			 
			//$('#output').html('<?php //require "doublebay_vic_vr3_thru_gutter.php"; ?>'); 
			 
			<?php if(METRIC_SYSTEM=="inch"){ ?>
				$.getScript('<?php echo JURI::base().'jscript/doublebay_vr2_inch.js?v='.mt_rand(); ?>');
			<?php }else{ ?>
				$.getScript('<?php echo JURI::base().'jscript/doublebay_vr2.js?v='.mt_rand(); ?>');
			<?php } ?>

			// frmLEN.disabled = true;
			// frmWID.disabled = true;
			// frmBAY.disabled = true;
		    frmDBLEN1.disabled = false;
			frmDBWID1.disabled = false;
			frmDBLEN2.disabled = false;
			frmDBWID2.disabled = false;
			// document.getElementById('length').style.display = 'none'; 
			// document.getElementById('width').style.display = 'none'; 
			// document.getElementById('bay').style.display = 'none'; 
			//document.getElementById('doubletable').style.display = 'inline-block';
			//document.getElementById('DoubleTable').style='inline-text';
			document.getElementById('lblL1').style.display = 'inline-block'; 
			document.getElementById('lblL2').style.display = 'inline-block'; 
			document.getElementById('lblBay').style.display = 'none'; 
			document.getElementById('lblLBay').style.display = 'none';
		     
		    $("#save-doublebay").attr("name","save-doublebay-vr3-gutter");
		    $("#save-close-doublebay").attr("name","save-close-doublebay-vr3-gutter");

		    $("#save-doublebay-down").attr("name","save-doublebay-vr3-gutter");
		    $("#save-close-doublebay-down").attr("name","save-close-doublebay-vr3-gutter"); 
 
			 
        // else if ('Double Bay VR4' == selectedValue)  
		<?php } else if($fw == "VR4"){ ?>
			 
		    //	alert("VR4"); 
			$('#save-dropin').css({display: "none"});
			$('#save-close-dropin').css({display: "none"});
			$('#save-dropin-down').css({display: "none"});
			$('#save-close-dropin-down').css({display: "none"});
			$('#save-singlebay').css({display: "none"});
			$('#save-close-singlebay').css({display: "none"});
			$('#save-singlebay-down').css({display: "none"});
			$('#save-close-singlebay-down').css({display: "none"});
			$('#save-doublebay').css({display: "inline-block"});
			$('#save-close-doublebay').css({display: "inline-block"});
			$('#save-doublebay-down').css({display: "inline-block"});
			$('#save-close-doublebay-down').css({display: "inline-block"});
			$('#save-multiplebay').css({display: "none"});
			$('#save-close-multiplebay').css({display: "none"});
			$('#save-multiplebay-down').css({display: "none"});
			$('#save-close-multiplebay-down').css({display: "none"});
			$('#save-gable').css({display: "none"});
			$('#save-close-gable').css({display: "none"});
			$('#save-gable-down').css({display: "none"});
			$('#save-close-gable-down').css({display: "none"});
			$('#save-angle').css({display: "none"});
			$('#save-close-angle').css({display: "none"});
			$('#save-angle-down').css({display: "none"});
			$('#save-close-angle-down').css({display: "none"});
			$('#cancel-down').css({display: "inline-block"});
			if('Three Bay VR4' == selectedValue    || 'Three Bay VR4 - Drop-In' == selectedValue  ){
 				//$('#output').html('<?php //require "doublebay_vic_vr2.php"; ?>'); 
					$.getScript('<?php echo JURI::base().'jscript/doublebay_vr4.js?v='.mt_rand(); ?>'); 
			} 
			//alert("here 2");
 			//frmLEN.disabled = true;
			//frmWID.disabled = true;
			//frmBAY.disabled = true;
		    frmDBLEN1.disabled = false;
			frmDBWID1.disabled = false;
			frmDBLEN2.disabled = false;
			frmDBWID2.disabled = false;
			//alert("here 3");
			//document.getElementById('length').style.display = 'none'; 
			//document.getElementById('width').style.display = 'none'; 
			//document.getElementById('bay').style.display = 'none'; 
			//document.getElementById('doubletable').style.display = 'inline-block';
			document.getElementById('lblL1').style.display = 'inline-block'; 
			document.getElementById('lblL2').style.display = 'inline-block'; 
			document.getElementById('lblBay').style.display = 'none'; 
			document.getElementById('lblLBay').style.display = 'none';
		    // alert("here 4"); 
		    $("#save-doublebay").attr("name","save-doublebay-vr4");
		    $("#save-close-doublebay").attr("name","save-close-doublebay-vr4");

		    $("#save-doublebay-down").attr("name","save-doublebay-vr4");
		    $("#save-close-doublebay-down").attr("name","save-close-doublebay-vr4");


		<?php } else if($fw == "VR6"){ ?>
			  
			$('#save-dropin').css({display: "none"});
			$('#save-close-dropin').css({display: "none"});
			$('#save-dropin-down').css({display: "none"});
			$('#save-close-dropin-down').css({display: "none"});
			$('#save-singlebay').css({display: "none"});
			$('#save-close-singlebay').css({display: "none"});
			$('#save-singlebay-down').css({display: "none"});
			$('#save-close-singlebay-down').css({display: "none"});
			$('#save-doublebay').css({display: "inline-block"});
			$('#save-close-doublebay').css({display: "inline-block"});
			$('#save-doublebay-down').css({display: "inline-block"});
			$('#save-close-doublebay-down').css({display: "inline-block"});
			$('#save-multiplebay').css({display: "none"});
			$('#save-close-multiplebay').css({display: "none"});
			$('#save-multiplebay-down').css({display: "none"});
			$('#save-close-multiplebay-down').css({display: "none"});
			$('#save-gable').css({display: "none"});
			$('#save-close-gable').css({display: "none"});
			$('#save-gable-down').css({display: "none"});
			$('#save-close-gable-down').css({display: "none"});
			$('#save-angle').css({display: "none"});
			$('#save-close-angle').css({display: "none"});
			$('#save-angle-down').css({display: "none"});
			$('#save-close-angle-down').css({display: "none"});
			$('#cancel-down').css({display: "inline-block"});
			if('Four Bay VR6' == selectedValue    || 'Four Bay VR6 - Drop-In' == selectedValue  ){  
				$.getScript('<?php echo JURI::base().'jscript/doublebay_vr4.js?v='.mt_rand(); ?>');  
			} 
	 
		    frmDBLEN1.disabled = false;
			frmDBWID1.disabled = false;
			frmDBLEN2.disabled = false;
			frmDBWID2.disabled = false; 

			document.getElementById('lblL1').style.display = 'inline-block'; 
			document.getElementById('lblL2').style.display = 'inline-block'; 
			document.getElementById('lblBay').style.display = 'none'; 
			document.getElementById('lblLBay').style.display = 'none';
		    // alert("here 4"); 
		    $("#save-doublebay").attr("name","save-doublebay-vr6");
		    $("#save-close-doublebay").attr("name","save-close-doublebay-vr6");

		    $("#save-doublebay-down").attr("name","save-doublebay-vr6");
		    $("#save-close-doublebay-down").attr("name","save-close-doublebay-vr6");

		   // alert("here 5"); 
		    
		<?php } else if($fw == "VR5"){ ?>	    
			 //alert("VR5"); 
			$('#save-dropin').css({display: "none"});
			$('#save-close-dropin').css({display: "none"});
			$('#save-dropin-down').css({display: "none"});
			$('#save-close-dropin-down').css({display: "none"});
			$('#save-singlebay').css({display: "none"});
			$('#save-close-singlebay').css({display: "none"});
			$('#save-singlebay-down').css({display: "none"});
			$('#save-close-singlebay-down').css({display: "none"});
			$('#save-doublebay').css({display: "inline-block"});
			$('#save-close-doublebay').css({display: "inline-block"});
			$('#save-doublebay-down').css({display: "inline-block"});
			$('#save-close-doublebay-down').css({display: "inline-block"});
			$('#save-multiplebay').css({display: "none"});
			$('#save-close-multiplebay').css({display: "none"});
			$('#save-multiplebay-down').css({display: "none"});
			$('#save-close-multiplebay-down').css({display: "none"});
			$('#save-gable').css({display: "none"});
			$('#save-close-gable').css({display: "none"});
			$('#save-gable-down').css({display: "none"});
			$('#save-close-gable-down').css({display: "none"});
			$('#save-angle').css({display: "none"});
			$('#save-close-angle').css({display: "none"});
			$('#save-angle-down').css({display: "none"});
			$('#save-close-angle-down').css({display: "none"});
			$('#cancel-down').css({display: "inline-block"});
			 
			//$('#output').html('<?php //require "doublebay_vic_vr3.php"; ?>');

			 
			$.getScript('<?php echo JURI::base().'jscript/doublebay_vr4.js?v='.mt_rand(); ?>');
		  
			// frmLEN.disabled = true;
			// frmWID.disabled = true;
			// frmBAY.disabled = true;
		    frmDBLEN1.disabled = false;
			frmDBWID1.disabled = false;
			frmDBLEN2.disabled = false;
			frmDBWID2.disabled = false;  
			// document.getElementById('length').style.display = 'none'; 
			// document.getElementById('width').style.display = 'none'; 
			// document.getElementById('bay').style.display = 'none'; 
			//document.getElementById('doubletable').style.display = 'inline-block';
			document.getElementById('lblL1').style.display = 'inline-block';
			document.getElementById('lblL2').style.display = 'inline-block'; 
			document.getElementById('lblL3').style.display = 'inline-block'; 
			document.getElementById('lblBay').style.display = 'none'; 
			document.getElementById('lblLBay').style.display = 'none';
		     
		    $("#save-doublebay").attr("name","save-doublebay-vr5");
		    $("#save-close-doublebay").attr("name","save-close-doublebay-vr5");

		    $("#save-doublebay-down").attr("name","save-doublebay-vr5");
		    $("#save-close-doublebay-down").attr("name","save-close-doublebay-vr5");
		     
			
        // else if ('Double Bay VR3 - Gutter' == selectedValue  || 'Double Bay VR3 - Gutter - Drop-In' == selectedValue) 
		<?php }else if($fw == "VR7"){ ?>	   
        // else if ('Double Bay VR3' == selectedValue  || 'Double Bay VR3 - Drop-In' == selectedValue  )  
			  
			$('#save-dropin').css({display: "none"});
			$('#save-close-dropin').css({display: "none"});
			$('#save-dropin-down').css({display: "none"});
			$('#save-close-dropin-down').css({display: "none"});
			$('#save-singlebay').css({display: "none"});
			$('#save-close-singlebay').css({display: "none"});
			$('#save-singlebay-down').css({display: "none"});
			$('#save-close-singlebay-down').css({display: "none"});
			$('#save-doublebay').css({display: "inline-block"});
			$('#save-close-doublebay').css({display: "inline-block"});
			$('#save-doublebay-down').css({display: "inline-block"});
			$('#save-close-doublebay-down').css({display: "inline-block"});
			$('#save-multiplebay').css({display: "none"});
			$('#save-close-multiplebay').css({display: "none"});
			$('#save-multiplebay-down').css({display: "none"});
			$('#save-close-multiplebay-down').css({display: "none"});
			$('#save-gable').css({display: "none"});
			$('#save-close-gable').css({display: "none"});
			$('#save-gable-down').css({display: "none"});
			$('#save-close-gable-down').css({display: "none"});
			$('#save-angle').css({display: "none"});
			$('#save-close-angle').css({display: "none"});
			$('#save-angle-down').css({display: "none"});
			$('#save-close-angle-down').css({display: "none"});
			$('#cancel-down').css({display: "inline-block"});
			   
			$.getScript('<?php echo JURI::base().'jscript/doublebay_vr4.js?v='.mt_rand(); ?>');
		  
		    frmDBLEN1.disabled = false;
			frmDBWID1.disabled = false;
			frmDBLEN2.disabled = false;
			frmDBWID2.disabled = false;
			 
			document.getElementById('lblL1').style.display = 'inline-block';
			document.getElementById('lblL2').style.display = 'inline-block'; 
			document.getElementById('lblL3').style.display = 'inline-block'; 
			document.getElementById('lblBay').style.display = 'none'; 
			document.getElementById('lblLBay').style.display = 'none';
		     
		    $("#save-doublebay").attr("name","save-doublebay-vr7");
		    $("#save-close-doublebay").attr("name","save-close-doublebay-vr7");

		    $("#save-doublebay-down").attr("name","save-doublebay-vr7");
		    $("#save-close-doublebay-down").attr("name","save-close-doublebay-vr7");
			 
        // else if ('Double Bay VR3 - Gutter' == selectedValue  || 'Double Bay VR3 - Gutter - Drop-In' == selectedValue) 
		<?php }else if($fw=="VS1"){ ?>	

			$('#save-dropin').css({display: "none"});
			$('#save-close-dropin').css({display: "none"});
			$('#save-dropin-down').css({display: "none"});
			$('#save-close-dropin-down').css({display: "none"});
			$('#save-singlebay').css({display: "inline-block"});
			$('#save-close-singlebay').css({display: "inline-block"});
			$('#save-singlebay-down').css({display: "inline-block"});
			$('#save-close-singlebay-down').css({display: "inline-block"});
			$('#save-doublebay').css({display: "none"});
			$('#save-close-doublebay').css({display: "none"});
			$('#save-doublebay-down').css({display: "none"});
			$('#save-close-doublebay-down').css({display: "none"});
			$('#save-multiplebay').css({display: "none"});
			$('#save-close-multiplebay').css({display: "none"});
			$('#save-multiplebay-down').css({display: "none"});
			$('#save-close-multiplebay-down').css({display: "none"});
			$('#save-gable').css({display: "none"});
			$('#save-close-gable').css({display: "none"});
			$('#save-gable-down').css({display: "none"});
			$('#save-close-gable-down').css({display: "none"});
			$('#save-angle').css({display: "none"});
			$('#save-close-angle').css({display: "none"});
			$('#save-angle-down').css({display: "none"}); 
			$('#save-close-angle-down').css({display: "none"});
			$('#cancel-down').css({display: "inline-block"});
			 
			$.getScript('<?php echo JURI::base().'jscript/singlebay_vs1.js?v='.mt_rand(); ?>');
			 
 
			frmLEN.disabled = false;
			frmWID.disabled = false;
			frmBAY.disabled = true;
		    frmDBLEN1.disabled = true;
			frmDBWID1.disabled = true;
			frmDBLEN2.disabled = true;
			frmDBWID2.disabled = true;
			document.getElementById('length').style.display = 'inline-block'; 
			document.getElementById('width').style.display = 'inline-block'; 
			document.getElementById('bay').style.display = 'none'; 
			document.getElementById('doubletable').style.display = 'none';
			document.getElementById('lblL1').style.display = 'inline-block'; 
			document.getElementById('lblL2').style.display = 'inline-block'; 
			document.getElementById('lblBay').style.display = 'none'; 
			document.getElementById('lblLBay').style.display = 'none';
		     
		    $("#save-singlebay").attr("name","save-singlebay-vs1");
		    $("#save-close-singlebay").attr("name","save-close-singlebay-vs1");

		    $("#save-singlebay-down").attr("name","save-singlebay-vs1");
		    $("#save-close-singlebay-down").attr("name","save-close-singlebay-vs1");
 			 
			
		<?php }  ?>
		   
		    
		   	var selframeworktypeIndex = $("#frameworktype")[0].selectedIndex;
			//alert("Framework: "+selframeworktypeIndex); 
		    if(selframeworktypeIndex == 1){ 
		    	//alert("Sel Drop In"); //return;
		    	$(".tbody_framework input").attr("disabled","disabled");
		    	$(".tbody_framework select").attr("disabled","disabled");
				$(".tbody_framework").css({'display':'none'});
				$("#framework option").each(function(){ 
					if($(this).val().indexOf("Drop-In")<1){
						//alert($(this).val());
						$(this).attr("value",$(this).val()+" - Drop-In");
					}
				 
				});
				
				//alert("selected: drop-in");
			}else{
				//alert("Sel Framework");
				$(".tbody_framework").css({'display':''}); 
				$("#framework option").each(function(){
					if($(this).val().indexOf("Drop-In")>0){
						//alert($(this).val().substring(0,$(this).val().length-10));
						$(this).attr("value",$(this).val().substring(0,$(this).val().length-10)); 
					}
					
				});
			}
		   
		   
		 //  } // end if 
      // }); // end of ajax.

   // }); //-------- END of $('#framework').change(
 
	$('input.num').removeClass('invisible');  
	 


});


</script>

 

<!------------- First Beam ------------------------------>
<script language="Javascript" type="text/javascript">
    var BeamDESCArray = new Array();
	<?php echo $BeamDESCArrayPhp; ?>
    var BeamRRPArray = new Array();
	<?php echo $BeamRRPArrayPhp; ?>
	var BeamCOSTArray = new Array();
	<?php echo $BeamCOSTArrayPhp; ?>
	var BeamIDArray = new Array();
	<?php echo $BeamIDArrayPhp; ?>
	var BeamUOMArray = new Array();
	<?php echo $BeamUOMArrayPhp; ?>
	
</script>

<?php
   
$color_select = "";
	$sqlcolour = "SELECT * FROM ver_chronoforms_data_colour_vic ORDER BY colour"; 
	$resultcolour = mysql_query ($sqlcolour);
 
 	$color_select .= "<select class=\"color_select\" name=\"paintselect\" >";
 	$default_color = "";
 	if(HOST_SERVER=="LA"){
 		$default_color = "Surfmist";
 	}
	while ($colour = mysql_fetch_assoc($resultcolour)){   
	  	$color_select .= "<option value=\"".$colour['colour']."\" ".($default_color==$colour['colour']?"selected":"")." >".$colour['colour']."</option>";  
	}
	$color_select .= "</select>";

global $colours;
$colours = [];
$sqlcolour = "SELECT * FROM ver_chronoforms_data_colour_vic ORDER BY colour"; 
$resultcolour = mysql_query ($sqlcolour); 
while ($colour = mysql_fetch_assoc($resultcolour)) 
	{ 
		//error_log($colour['colour'], 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_sa_prod\\my-error.log');
		array_push($colours,$colour['colour']);
	} 	

?>

<?php //error_log("QuoteID :".$QuoteID, 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_sa_prod\\my-error.log'); ?>

<form method="post" class="Chronoform hasValidation" id="chronoform_Add_Quote_Vic" action="<?php echo JURI::base().'add-quote-vic?quoteid='.$QuoteID;?>">
<input type="hidden" value="create" id="status"   />
<input type="hidden" value="<?php echo $QuoteID; ?>" id="_quoteid"  />
<input type="hidden" value="<?php echo ($_client['is_builder']==1?'builder':'client'); ?>" id="client_type"   />
<div id="project"> <input type="hidden" value="" name="quotedate" class="quotedate" /> 
<input type="hidden" value="<?php echo $_client['is_builder']; ?>" name="is_builder"  />
<input type="hidden" value="<?php echo $is_tender_quote; ?>" name="is_tender_quote"  />
 
<span class="quoteinfo"><label>Framework Type</label><select id="frameworktype" name="frameworktype" OnChange="change_framework_type();">
<option value="Framework" <?php echo ($fwt=="fw"?"selected":""); ?> >Framework</option>
<option value="Drop-In" <?php echo ($fwt=="drop-in"?"selected":""); ?> >Drop-In</option>
</select></span> 

<div id="frameset">
<span class="quoteinfo"><label>Type Of Vergola</label>
	<select id="framework" name="framework" OnChange="change_framework();">
		<option value="">Select Framework</option> 
		<option value="Single Bay VR0" <?php echo ($fw=="VR0"?"selected":""); ?> >Single Bay VR0</option>
		<option value="Single Bay VR1" <?php echo ($fw=="VR1"?"selected":""); ?> >Single Bay VR1</option>
		<option value="Double Bay VR2" <?php echo ($fw=="VR2"?"selected":""); ?> >Double Bay VR2</option>
		<option value="Double Bay VR3" <?php echo ($fw=="VR3"?"selected":""); ?> >Double Bay VR3</option>
		<option value="Double Bay VR3 - Gutter" <?php echo ($fw=="VR3-G"?"selected":""); ?> >Double Bay VR3 thru Gutter</option>
		<option value="Three Bay VR4" <?php echo ($fw=="VR4"?"selected":""); ?> >Three Bay VR4</option>
		<option value="Four Bay VR6" <?php echo ($fw=="VR6"?"selected":""); ?> >Four Bay VR6</option>
		<option value="Three Bay VR5" <?php echo ($fw=="VR5"?"selected":""); ?> >Three Bay VR5</option>
		<option value="Four Bay VR7" <?php echo ($fw=="VR7"?"selected":""); ?> >Four Bay VR7</option>
		<option value="Single Bay VS1" <?php echo ($fw=="VS1"?"selected":""); ?> >Single Bay VS1</option>
	</select>
</span>
<span class="quoteinfo"><label>Project Name</label><input type="text" value="" name="projectsite" id="projectsite" /></span>
<span class="quoteinfo"><label>Default Color</label>
<?php echo $color_select; ?>
</span>

<?php if($fw=="VR1" || $fw=="VS1"){ ?>
	<div id="singlebay_input" style="<?php if(METRIC_SYSTEM=="meter"){ echo "display:inline;";}else{echo "display:none;";} ?>">
		<span id="length" class="quoteinfo quote-length" style="display:none;"><label>Length</label><input type="text" value="" name="length" id="lengthid" class="num  invisible"  /></span>
		<span id="width" class="quoteinfo  quote-length" style="display:none;"><label><?php if($fw=="VR1"){echo "Width";}else{echo "Height";} ?></label><input type="text" value="" name="width" id="widthid" class="num invisible" /></span>
		<span id="bay" class="quoteinfo  quote-length" style="display:none;"><label>Bay</label><input type="text" value="" name="bay" id="bayid" class="num invisible" /></span>
	</div>
<?php }else if($fw=="VR0"){ ?>
	<div id="singlebay_input" style="<?php if(METRIC_SYSTEM=="meter"){ echo "display:none;";}else{echo "display:none;";} ?>">
		<span id="length" class="quoteinfo quote-length" style="display:none;"><label>Length</label><input type="text" value="0" name="length" id="lengthid" class=" "    /></span>
		<span id="width" class="quoteinfo  quote-length" style="display:none;"><label>Width</label><input type="text" value="0" name="width" id="widthid" class=" "    /></span>
		<span id="bay" class="quoteinfo  quote-length" style="display:none;"><label>Bay</label><input type="text" value="0" name="bay" id="bayid" class=" "    /></span>
	</div>
<?php } ?>

<div id="doubletable" style="<?php  if(($fw=="VR2" || $fw=="VR3" || $fw=="VR3-G" || $fw=="VR4" || $fw=="VR6" || $fw=="VR5" || $fw=="VR7" ) && METRIC_SYSTEM=="meter"){  echo "display:inline-block;";}else{echo "display:none;";} ?>">
	<table id="doublemeasurement"><tr><td valign="top">
	<span id="lblBay" style="vertical-align: text-top;" class=" quote-length"><label>Bay</label><input type="text" value="" name="dbbay" id="dbbay" class="num invisible" /></span>
	<span id="lblLBay" style="vertical-align: text-top;" class=" quote-length"><label>Length</label><input type="text" value="" name="bay_length[]" id="lbay1" placeholder="L1" class="num invisible" /> </span>
	<span id="lblL1" style="vertical-align: text-top;" class=" quote-length"><label>Length 1</label><input type="text" value="" name="dblength[]" id="dblengthid1" placeholder="L1" class="num invisible" /> </span>
	<span id="lblL2" style="vertical-align: text-top;" class=" quote-length"><label>Length 2</label><input type="text" value="" name="dblength[]" id="dblengthid2" placeholder="L2" class="num invisible" /></span>
	<?php if($fw=="VR4" || $fw=="VR5"){ ?>
		<span id="lblL3" style="vertical-align: text-top;" class=" quote-length"><label>Length 3</label><input type="text" value="" name="dblength[]" id="dblengthid3" placeholder="L3" class="num invisible" /></span>
	<?php } ?>	
	<?php if($fw=="VR6" || $fw=="VR7"){ ?>
		<span id="lblL3" style="vertical-align: text-top;" class=" quote-length"><label>Length 3</label><input type="text" value="" name="dblength[]" id="dblengthid3" placeholder="L3" class="num invisible" /></span>
		<span id="lblL4" style="vertical-align: text-top;" class=" quote-length"><label>Length 4</label><input type="text" value="" name="dblength[]" id="dblengthid4" placeholder="L4" class="num invisible" /></span>
	<?php } ?>	
	<span style="vertical-align: text-top;" class=" quote-length"><label>Width</label><input type="text" value="" name="dbwidth[]" id="dbwidthid1" placeholder="Width" class="num invisible" /></span>
	<input type="hidden" value="" name="dbwidth[]" id="dbwidthid2" />
	</td></tr>
	</table>
</div>  

<input type="hidden" value="" name="length_total_inch" id="length_total_inch" />
<input type="hidden" value="" name="length2_total_inch" id="length2_total_inch" />
<input type="hidden" value="" name="width_total_inch" id="width_total_inch" />

<div id="singlebay_input_us" style="<?php if(($fw=="VR1" ) && METRIC_SYSTEM=="inch"){ echo "display:inline;";}else{echo "display:none;";} ?>">
	 
	<span  class="quoteinfo quote-length" >
		<label>Length</label><input type="text" value="" name="length_ft" id="length_ft" class="num  invisible ft" placeholder="Ft." /> 
		<input type="text" value="" name="length_in" id="length_in" class="num  invisible in" style="width: 30px;" placeholder="In." />
	</span>
	<span  class="quoteinfo  quote-length" >
		<label>Width</label><input type="text" value="" name="width_ft" id="width_ft" class="num invisible" placeholder="Ft."/>
		<input type="text" value="" name="width_in" id="width_in" class="num  invisible in" style="width: 30px;" placeholder="In." placeholder="In." />
	</span>  
	 
</div>

<div id="doublebay_input_us" style="<?php if(($fw=="VR2" || $fw=="VR3" || $fw=="VR3-G") && METRIC_SYSTEM=="inch"){ echo "display:inline;";}else{echo "display:none;";} ?>">
	<span  class="quoteinfo quote-length" >
		<label>Length 1</label><input type="text" value="" name="bay_length_ft[]" id="length1_ft" class="num  invisible ft" placeholder="Ft." /> 
		<input type="text" value="" name="bay_length_in[]" id="length1_in" class="num  invisible in" style="width: 30px;" placeholder="In." />
	</span>
	<span  class="quoteinfo quote-length" >
		<label>Length 2</label><input type="text" value="" name="bay_length_ft[]" id="length2_ft" class="num  invisible ft" placeholder="Ft." /> 
		<input type="text" value="" name="bay_length_in[]" id="length2_in" class="num  invisible in" style="width: 30px;" placeholder="In." />
	</span>
	<span  class="quoteinfo  quote-length" >
		<label>Width</label><input type="text" value="" name="dbwidth_ft[]" id="dbwidth_ft" class="num invisible" placeholder="Ft."/>
		<input type="text" value="" name="dbwidth_in[]" id="dbwidth_in" class="num  invisible in" style="width: 30px;" placeholder="In." placeholder="In." /> 
	</span>  
</div>

 

</div>

<input type="submit" class="save-btn" value="Save" name="save-dropin" id="save-dropin" style="display:none;"/>
<input type="submit" class="save-btn" value="Save & Close" name="save-close-dropin" id="save-close-dropin" style="display:none;"/>
<input type="submit" class="save-btn" value="Save" name="save-singlebay" id="save-singlebay" style="display:none;"/>
<input type="submit" class="save-btn" value="Save & Close" name="save-close-singlebay" id="save-close-singlebay" style="display:none;"/>
<input type="submit" class="save-btn" value="Save" name="save-doublebay" id="save-doublebay" style="display:none;"/>
<input type="submit" class="save-btn" value="Save & Close" name="save-close-doublebay" id="save-close-doublebay" style="display:none;"/>
<input type="submit" class="save-btn" value="Save" name="save-multiplebay" id="save-multiplebay" style="display:none;"/>
<input type="submit" class="save-btn" value="Save & Close" name="save-close-multiplebay" id="save-close-multiplebay" style="display:none;"/>
<input type="submit" class="save-btn" value="Save" name="save-gable" id="save-gable" style="display:none;"/>
<input type="submit" class="save-btn" value="Save & Close" name="save-close-gable" id="save-close-gable" style="display:none;"/>
<input type="submit" class="save-btn" value="Save" name="save-angle" id="save-angle" style="display:none;"/>
<input type="submit" class="save-btn" value="Save & Close" name="save-close-angle" id="save-close-angle" style="display:none;"/>
<input type="button" class="save-btn" value="Cancel"  id="cancel" onclick="window.location='<?php echo JURI::base().(isset($_REQUEST['ref'])?$_REQUEST['ref']:'client-listing-vic/client-folder-vic?cid='.$QuoteID); ?>'" />


</div>
<div id="output">
	<?php 
	 		error_log(" fw: ".$fw, 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_sa_prod\\my-error.log');
			if ($fw == 'VR1') {  
				require "singlebay_vic_vr1.php";

			}else if ($fw == 'VR2') { 
				require "doublebay_vic_vr2.php";
			
			}else if ($fw == 'VR3') {
				require "doublebay_vic_vr3.php";

			}else if ($fw == 'VR3-G') {  				
				require "doublebay_vic_vr3_thru_gutter.php";				 
			
			}else if ($fw == 'VR0') { 
				require "singlebay_vic_vr0.php";		
			}else if ($fw == 'VR4') { 
				//error_log(" IN: ", 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_sa_prod\\my-error.log');
				require "doublebay_vic_vr4.php";
				//error_log(" OUT: ", 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_sa_prod\\my-error.log');
			}else if ($fw == 'VR6') { 
				require "doublebay_vic_vr6.php";
			
			}else if ($fw == 'VR5') { 
				require "doublebay_vic_vr5.php";
			
			}else if ($fw == 'VR7') { 
				require "doublebay_vic_vr7.php"; 
			}else if ($fw == 'VS1') { 
				require "singlebay_vic_vs1.php";
			}
	?>

</div>
<div id="projectcomm" style="padding-top:30px;">
<span id="gst"><label>GST %</label><input type="text" value="<?php echo $GST; ?>" name="gst" id="gstid" /></span><br />
<span id="commision"><label>Commision %</label><input type="text" value="<?php echo $Commision; ?>" name="commision" id="commisionid" /></span><br />
<span id="salescomm"><label>Sales Comm %</label><input type="text" value="<?php echo $SalesComm; ?>" name="salescomm" id="salescommid" /></span><br />
<span id="installercomm"><label>Installer Comm %</label><input type="text" value="<?php echo $InstallComm; ?>" name="installercomm" id="installercommid" /></span><br />
<span id="salescost"><label>Sales Cost</label><input type="text" value="" name="salescost" id="salescostid" /></span><br />
<span id="installercost"><label>Installer Cost</label><input type="text" value="" name="installercost" id="installercostid" /></span>

</div>

<div id="projectcost" style="padding-top:30px;">
<span id="subtotalvergola"><label>Subtotal Vergola</label><input type="text" value="" name="subtotalvergola" id="subtotalvergolaid" /></span><br />
<span id="subtotaldisd"><label>Subtotal Disbursement</label><input type="text" value="" name="subtotaldisd" id="subtotaldisdid" /></span><br />
<span id="totalrrp"><label>Total Sell</label><input type="text" value="" name="totalrrp" id="totalrrpid" /></span><br />
<span id="totalgst"><label>GST</label><input type="text" value="" name="totalgst" id="totalgstid" /></span><br />
<span id="totalrrpgst"><label>Total Sell Inc GST</label><input type="text" value="" name="totalrrpgst" id="totalrrpgstid" /></span><br />
<span id="totalcost"><label>Total Cost</label><input type="text" value="" name="totalcost" id="totalcostid" /></span><br />
<span id="totalcostgst"><label>Total Cost Inc GST</label><input type="text" value="" name="totalcostgst" id="totalcostgstid" /></span>
</div>


<div class="table-subtotal-holder" style="display:none">
	<table id="commision_table" class="table-subtotal">
	<tbody>
		<tr><th colspan="2">Commission</th></tr>
		<tr><td>Sales Commission </td><td><span style="margin-right:10px;">$</span><input type="text" class="" value="" id="com_sales_commission" name="com_sales_commission" /></td></tr>
		<tr><th colspan="2">Sales Commission payment schedule &nbsp; </th></td></tr>
		<tr><td>Pay 1  </td><td><span style="margin-right:10px;">$</span><input type="text" class="" value="" id="com_pay1" name="com_pay1" /></td></tr>
		<tr><td>Pay 2  </td><td><span style="margin-right:10px;">$</span><input type="text" class="" value="" id="com_pay2" name="com_pay2" /></td></tr>
		<tr><td>Final  </td><td><span style="margin-right:10px;">$</span><input type="text" class="" value="" id="com_final" name="com_final" /></td></tr> 
		<tr><td>Installer Payment  </td><td><span style="margin-right:10px;">$</span><input type="text" class="" value="" id="com_installer_payment" name="com_installer_payment" /></td></tr>
	</tbody>
	</table> 

	<table id="payment_table" class="table-subtotal">
	<tbody>
		<tr><th colspan="2">Payment</th></tr>
		<tr><td>Deposit  </td><td><span style="margin-right:10px;">$</span><input type="text" class="" value="" id="payment_deposit" name="payment_deposit" /></td></tr>
		<tr><td>Progress payment </td><td><span style="margin-right:10px;">$</span><input type="text" class="" value="" id="payment_progress" name="payment_progress" /></td></tr>
		<tr><td>Final payment </td><td><span style="margin-right:10px;">$</span><input type="text" class="" value="" id="payment_final" name="payment_final" /></td></tr>
		 
	</tbody>
	</table>
 
	<table id="total_table" class="table-subtotal">
	<tbody>
		<tr><th colspan="2">Total</th></tr>
		<tr><td>Vergola  </td><td><span style="margin-right:10px;">$</span><input type="text" class="" value="" id="total_vergola" name="total_vergola" /></td></tr>
		<tr><td>Disbursement Sub Total </td><td><span style="margin-right:10px;">$</span><input type="text" class="" value="" id="total_disbursement" name="total_disbursement" /></td></tr>
		<tr><td>Sub Total </td><td><span style="margin-right:10px;">$</span><input type="text" class="" value="" id="sub_total" name="sub_total" /></td></tr>
		<tr><td><?php if(HOST_SERVER=="LA"){echo "Sales Tax";}else{echo "GST";} ?>  </td><td><span style="margin-right:10px;">$</span><input type="text" class="" value="" id="total_gst" name="total_gst" /></td></tr>
		<tr class="tr-total"><td>Total  </td><td><span style="margin-right:10px;">$</span><input type="text" class="" value="" id="total_sum" name="total_sum" /> <input type="hidden" class="" value="" id="total_rrp" name="total_rrp" /> </td></tr> 
	</tbody>
	</table>
</div>

<div id="downbtn"><input type="submit" class="save-btn" value="Save" name="save-dropin" id="save-dropin-down" style="display:none;"/>
<input type="submit" class="save-btn" value="Save & Close" name="save-close-dropin" id="save-close-dropin-down" style="display:none;"/>
<input type="submit" class="save-btn" value="Save" name="save-singlebay" id="save-singlebay-down" style="display:none;"/>
<input type="submit" class="save-btn" value="Save & Close" name="save-close-singlebay" id="save-close-singlebay-down" style="display:none;"/>
<input type="submit" class="save-btn" value="Save" name="save-doublebay" id="save-doublebay-down" style="display:none;"/>
<input type="submit" class="save-btn" value="Save & Close" name="save-close-doublebay" id="save-close-doublebay-down" style="display:none;"/>
<input type="submit" class="save-btn" value="Save" name="save-multiplebay" id="save-multiplebay-down" style="display:none;"/>
<input type="submit" class="save-btn" value="Save & Close" name="save-close-multiplebay" id="save-close-multiplebay-down" style="display:none;"/>
<input type="submit" class="save-btn" value="Save" name="save-gable" id="save-gable-down" style="display:none;"/>
<input type="submit" class="save-btn" value="Save & Close" name="save-close-gable" id="save-close-gable-down" style="display:none;"/>
<input type="submit" class="save-btn" value="Save" name="save-angle" id="save-angle-down" style="display:none;"/>
<input type="submit" class="save-btn" value="Save & Close" name="save-close-angle" id="save-close-angle-down" style="display:none;"/>
<input type="button" class="save-btn" value="Cancel"  id="cancel-down" style="display:none;" onclick="window.location='<?php echo JURI::base().(isset($_REQUEST['ref'])?$_REQUEST['ref']:'client-listing-vic/client-folder-vic?cid='.$QuoteID); ?>'" /></div>

<input type="hidden" id="ref" value="<?php echo (isset($_REQUEST['ref'])?$_REQUEST['ref']:''); ?>" />

</form>

 
<?php


function addItem($inventoryid){ 
	global $inventory_table;

	$result = mysql_query("SELECT * FROM  {$inventory_table}  WHERE  inventoryid='{$inventoryid}' " );  
	$item = mysql_fetch_assoc($result);

	$tag = "{$item['description']} <input type=\"hidden\" class=\"price\" value=\"{$item['rrp']}\" inventoryid=\"{$item['inventoryid']}\" desc=\"{$item['description']}\" />";

	return $tag; 
}	

function getItemName($inventoryid){ 
	global $inventory_table;

	$result = mysql_query("SELECT * FROM  {$inventory_table}  WHERE  inventoryid='{$inventoryid}' " );  
	$item = mysql_fetch_assoc($result);

	$tag = "{$item['description']}";

	return $tag;  
}	
 
 

function listItem($framework_type,$item=null,$category=null,$itemId=""){
	global $inventory_table;  
	$tag = "";  
	$framework_type = strtolower($framework_type);

	if($framework_type=="frame"){ 
		 
 		$result = mysql_query("SELECT * FROM  {$inventory_table}  WHERE  LOWER(section) = '{$framework_type}' AND LOWER(category) = '{$category}'" );  

		$tag .= "<select class=\"desclist cbo_beam_post\" name=\"desclist[]\" id=\"{$itemId}\">";
		while ($r = mysql_fetch_assoc($result)) {  
		    $tag .= "<option value=\"".$r['inventoryid']."\" price=\"".$r['rrp']."\" category=\"".$r['category']."\" ";
			if($r['inventoryid'] == $item["inventoryid"]) { $tag .= " selected"; } 
			$tag .= ">".$r['description'];
			$tag .= "</option>";
	        }	
		$tag .= "</select>"; 
		
	}else if($framework_type=="guttering"){
	 	
 		$result = mysql_query("SELECT * FROM  {$inventory_table}  WHERE  LOWER(section) = '{$framework_type}'  AND category != 'Finish' " );  
		$tag .= "<select class=\"desclist\" name=\"desclist[]\" id=\"{$itemId}\">";
		while ($r = mysql_fetch_assoc($result)) {  
		    $tag .= "<option value=\"".$r['inventoryid']."\" price=\"".$r['rrp']."\" category=\"".$r['category']."\" ";
			if($r['inventoryid'] == $item["inventoryid"]) { $tag .= " selected"; } 
			$tag .= ">".$r['description'];
			$tag .= "</option>";
	        }	
		$tag .= "</select>"; 
		
	 }else if($framework_type=="non standard guttering"){
	 	
	 	//$sql = "SELECT * FROM  {$inventory_table}  WHERE  LOWER(section) = '{$framework_type}' AND category = 'Gutters Non Standard'";
	 	//error_log($sql, 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_sa_prod\\my-error.log');
 		$result = mysql_query("SELECT * FROM  {$inventory_table}  WHERE  LOWER(section) = 'guttering' AND category = 'Gutters Non Standard' " ); // 
		$tag .= "<select class=\"desclist\" name=\"desclist[]\" id=\"{$itemId}\">";
		while ($r = mysql_fetch_assoc($result)) {  
		    $tag .= "<option value=\"".$r['inventoryid']."\" price=\"".$r['rrp']."\" category=\"".$r['category']."\" ";
			 
			$tag .= ">".$r['description'];
			$tag .= "</option>";
	        }	
		$tag .= "</select>"; 

	 
 
	 }else if($framework_type=="posts"){
	 	
 		$result = mysql_query("SELECT * FROM  {$inventory_table}  WHERE LOWER(section) = 'frame' AND LOWER(category) = 'posts'" ); // 
		$tag .= "<select class=\"desclist\" name=\"desclist[]\" id=\"{$itemId}\">";
		while ($r = mysql_fetch_assoc($result)) {  
		    $tag .= "<option value=\"".$r['inventoryid']."\" price=\"".$r['rrp']."\" category=\"".$r['category']."\" ";
			if($r['inventoryid'] == $item["inventoryid"]) { $tag .= "selected=\"selected\""; } 
			$tag .= ">".$r['description'];
			$tag .= "</option>";
	        }	
		$tag .= "</select>"; 
		
	 }else if($framework_type=="beam_and_posts"){
	 	
 		$result = mysql_query("SELECT * FROM  {$inventory_table}  WHERE LOWER(section) = 'frame' AND (category='Beams' OR category='Intermediate' OR category='Posts')   ORDER BY FIELD(category, 'Post Fixings','Post','Beam Fixings','Intermediate','Beams') DESC " );  
		$tag .= "<select class=\"desclist cbo_beam_post\" name=\"desclist[]\" id=\"{$itemId}\">";
		while ($r = mysql_fetch_assoc($result)) {  
		    $tag .= "<option value=\"".$r['inventoryid']."\" price=\"".$r['rrp']."\" category=\"".$r['category']."\" ";
			if($r['inventoryid'] == $item["inventoryid"]) { $tag .= "selected=\"selected\""; } 
			$tag .= ">".$r['description'];
			$tag .= "</option>";
	        }	
		$tag .= "</select>"; 
		
	 }else if($framework_type=="flashing"){
	 	
 		$result = mysql_query("SELECT * FROM  {$inventory_table}  WHERE LOWER(section) = 'flashings' " ); // 
		$tag .= "<select class=\"desclist\" name=\"desclist[]\" id=\"{$itemId}\">";
		while ($r = mysql_fetch_assoc($result)) {  
			    $tag .= "<option value=\"".$r['inventoryid']."\" price=\"".$r['rrp']."\" category=\"".$r['category']."\" ".($r['inventoryid']=="IRV48"?"selected":"")." "; 
				$tag .= ">".$r['description'];
				$tag .= "</option>";
	        }	
		$tag .= "</select>"; 
		
	 }else if($framework_type=="louvers" || $framework_type=="louvres"){
	 	
 		$result = mysql_query("SELECT * FROM {$inventory_table} WHERE section = 'Vergola' and category  = 'Louvers'" );  
		$tag .= "<select class=\"desclist\" name=\"desclist[]\" id=\"{$itemId}\">";
		while ($r = mysql_fetch_assoc($result)) {  
		    $tag .= "<option value=\"".$r['inventoryid']."\" price=\"".$r['rrp']."\" category=\"".$r['category']."\" ";
			if($r['inventoryid'] == $item["inventoryid"]) { $tag .= "selected=\"selected\""; } 
			$tag .= ">".$r['description'];
			$tag .= "</option>";
	        }	
		$tag .= "</select>"; 
		
	 }else if($framework_type=="misc"){
	 	
 		$result = mysql_query("SELECT * FROM  {$inventory_table}  WHERE LOWER(section) = 'misc' " ); // 
		$tag .= "<select class=\"desclist\" name=\"desclist[]\" id=\"{$itemId}\">";
		while ($r = mysql_fetch_assoc($result)) {  
			    $tag .= "<option value=\"".$r['inventoryid']."\" price=\"".$r['rrp']."\" category=\"".$r['category']."\"  "; 
				$tag .= ">".$r['description'];
				$tag .= "</option>";
	        }	
		$tag .= "</select>"; 
		
	 }else if($framework_type=="extras"){
	 	
 		$result = mysql_query("SELECT * FROM  {$inventory_table}  WHERE LOWER(section) = 'extras' " ); 
		$tag .= "<select class=\"desclist\" name=\"desclist[]\" id=\"{$itemId}\">";
		while ($r = mysql_fetch_assoc($result)) {  
			    $tag .= "<option value=\"".$r['inventoryid']."\" price=\"".$r['rrp']."\" category=\"".$r['category']."\" "; 
				$tag .= ">".$r['description'];
				$tag .= "</option>";
	        }	
		$tag .= "</select>"; 
		
	 }else if($framework_type=="fixings"){
	 	
 		$result = mysql_query("SELECT * FROM  {$inventory_table}  WHERE LOWER(section) = 'fixings' " ); // 
		$tag .= "<select class=\"desclist\" name=\"desclist[]\" id=\"{$itemId}\">";
		while ($r = mysql_fetch_assoc($result)) {  
			    $tag .= "<option value=\"".$r['inventoryid']."\" price=\"".$r['rrp']."\" category=\"".$r['category']."\" "; 
				$tag .= ">".$r['description'];
				$tag .= "</option>";
	        }	
		$tag .= "</select>"; 
		
	 }else if($framework_type=="downpipe"){
	 	
 		$result = mysql_query("SELECT * FROM  {$inventory_table}  WHERE LOWER(section) = 'downpipe' " ); // 
		$tag .= "<select class=\"desclist\" name=\"desclist[]\" id=\"{$itemId}\">";
		while ($r = mysql_fetch_assoc($result)) {  
			    $tag .= "<option value=\"".$r['inventoryid']."\" price=\"".$r['rrp']."\" category=\"".$r['category']."\" "; 
				$tag .= ">".$r['description'];
				$tag .= "</option>";
	        }	
		$tag .= "</select>"; 
		
	 }else if($framework_type=="disbursements"){
	 	
 		$result = mysql_query("SELECT * FROM  {$inventory_table}  WHERE LOWER(section) = 'disbursements' " ); // 
		$tag .= "<select class=\"desclist\" name=\"desclist[]\" id=\"{$itemId}\">";
		while ($r = mysql_fetch_assoc($result)) {  
			    $tag .= "<option value=\"".$r['inventoryid']."\" price=\"".$r['rrp']."\" category=\"".$r['category']."\" "; 
				$tag .= ">".$r['description'];
				$tag .= "</option>";
	        }	
		$tag .= "</select>"; 
		
	 }else if($framework_type=="frame-vs"){
	 	
 		$result = mysql_query("SELECT * FROM  {$inventory_table}  WHERE inventoryid='IRV291' OR inventoryid='IRV292' " ); 
		$tag .= "<select class=\"desclist\" name=\"desclist[]\" id=\"{$itemId}\">";
		while ($r = mysql_fetch_assoc($result)) {  
			    $tag .= "<option value=\"".$r['inventoryid']."\" price=\"".$r['rrp']."\" category=\"".$r['category']."\" "; 
				$tag .= ">".$r['description'];
				$tag .= "</option>";
	        }	
		$tag .= "</select>"; 
		
	 }    
	  
	return $tag; 

}
 

function listWebbing($selected=""){
	global $inventory_table; 
	$querywebbing="SELECT cf_id, rrp, cost FROM {$inventory_table} WHERE cf_id = '5'";
	$webbingItem = mysql_fetch_array(mysql_query($querywebbing)); 
	$tr = "<select class=\"webbing-list\" name=\"webbing[]\" webrrp=\"".$webbingItem["rrp"]."\" >".
	          "<option value=\"No\" >No</option>".
	          "<option value=\"Yes\" >Yes</option>".
	     "</select>"; 
	 
	return $tr;
}

function listColours($selected=null,$item=null,$class=""){  
	 

	global $colours; 
	$r = "<select class=\"colour {$class} \" name=\"colour[]\" >";
	$e=0;
	foreach  ($colours as $c) 
	{ 
		$r .= "<option value=\"{$c}\" ";
		if ($selected != null && $c == $selected) { $r .= " selected=\"selected\"";} 
		else { 			 
			$r .= "";
		}
		$r .= ">{$c}</option>";
		$e++;
	}
	$r .= "</select>";
	return $r;
}

function listColours2($selected=null,$item,$class=""){   
	global $colours; 
 
	$r = "<select class=\"colour {$class}\" name=\"colour[]\" >";
	foreach  ($colours as $c) 
	{ 
		$r .= "<option value=\"{$c}\" ";
		if ($c == $selected) { $r .= " selected ";} 
		else {$r .= "";}
		$r .= ">{$c}</option>";
	}
	$r .= "</select>";
	 
	return $r;
}

function listColourBond($selected=null,$item=null,$section = "Frame"){  
	global $inventory_table;
	$sql = "SELECT cf_id, rrp, cost, category, description FROM {$inventory_table} WHERE  section = '{$section}' AND category = 'Finish' Order By description ";	

	$paints = mysql_query ($sql);

	$r = "<select class=\"paint-list\"  name=\"finish[]\"  >";  
    while ($paint = mysql_fetch_array($paints)){ 
	  	$r .= "<option value=\"".$paint['description']."\" finishrrp=\"".$paint["rrp"]."\" "; 
		if($paint['description'] == $selected){ $r .= "selected=\"selected\"";
		} else { $r .= "";}
		$r .= ">".$paint['description']."</option>";	
	}
	$r .= "</select>";
 
	return $r; 
}
   

?>

<div> 
	<table style="float:left; margin-left:-9000px;" id="template_table">
		<tbody id="additional_post">
		<tr class="added-post-tr"> 
		<?php
			$tr = "";  
			$tr .= "<td class=\"td-item\">".listItem("beam_and_posts")." <input type=\"hidden\" class=\"price select\" value=\"0\" category=\"Posts\"  inventoryid=\"\" />   </td>";
			$tr .= "<td class=\"td-webbing\"> ".listWebbing()." <br/> <input type=\"button\" class=\"added_item\" value=\"Remove\" >  </td>"; 
			$tr .= "<td>".listColours()."</td>";   
			$tr .= "<td class=\"td-finish-color\">".listColourBond()."</td>";  
			$tr .= "<td class=\"td-uom\">Mtrs <input type=\"hidden\" name=\"uom[]\" value=\"Mtrs\" \> </td>";  
			$tr .= "<td class=\"td-qty\"><input type=\"text\" class=\"qtylen\" name=\"qty[]\" value=\"1\"></td>";  
			$tr .= "<td class=\"td-len\"><input type=\"text\"  name=\"slength[]\" class=\"input-size input-in\" value=\"".(METRIC_SYSTEM=="inch"?"12":"1")."\"  ></td>";  
			if(METRIC_SYSTEM=="inch"){
				$tr .= "<td class=\"td-ft\"><input type=\"text\"  class=\"input-ft\" value=\"1\" ></td>";  
			}
			$tr .= "<td class=\"td-rrp\"><input type=\"text\" class=\"rrp\" readonly=\"readonly\" name=\"rrp[]\" value=\"\"></td>";  
	 		$tr .= "<input type=\"hidden\" class=\"desc\" name=\"desc[]\" value=\"\" readonly=\"readonly\" />".
					    "<input type=\"hidden\" class=\"invent\" name=\"invent[]\" value=\"\" readonly=\"readonly\" />
					     <input type=\"hidden\" class=\"\" name=\"is_additional[]\" value=\"1\" readonly=\"readonly\" />";
			echo $tr;
		?> 
		</tr>
		</tbody>

		<tbody id="additional_non_standard_gutter">
		<tr class="added-gutter-tr"> 
		<?php
			$tr = "";
			$tr .= "<td class=\"td-item\">".listItem("non standard guttering")." <input type=\"hidden\" class=\"price select\" value=\"0\" category=\"Gutters Non Standard\" inventoryid=\"\" />   </td>";
			$tr .= "<td><input type=\"button\" class=\"added_item\" value=\"Remove\" ></td>"; 
			$tr .= "<td>".listColours()."</td>";   
			$tr .= "<td class=\"td-finish-color\">".listColourBond(null,null,"Guttering")."</td>";  
			$tr .= "<td class=\"td-uom\">Mtrs <input type=\"hidden\" name=\"uom[]\" value=\"Mtrs\" \>  </td>";  
			$tr .= "<td class=\"td-qty\"><input type=\"text\" class=\"qtylen gutter-qty\" name=\"qty[]\" value=\"1\"></td>";  
			$tr .= "<td class=\"td-len\"><input type=\"text\"  name=\"slength[]\" class=\"input-size input-in gutter-length length\" value=\"".(METRIC_SYSTEM=="inch"?"12":"1")."\"  ></td>";
			if(METRIC_SYSTEM=="inch"){
				$tr .= "<td class=\"td-ft\"><input type=\"text\"  class=\"input-ft gutter-length\" value=\"1\" ></td>";  
			}
			$tr .= "<td class=\"td-rrp\"><input type=\"text\" class=\"rrp\" readonly=\"readonly\" name=\"rrp[]\" value=\"\"></td>";  
	 		$tr .= "<input type=\"hidden\" class=\"desc\" name=\"desc[]\" value=\"\" readonly=\"readonly\" />".
					       "<input type=\"hidden\" class=\"invent\" name=\"invent[]\" value=\"\" readonly=\"readonly\" />
					        <input type=\"hidden\" class=\"\" name=\"is_additional[]\" value=\"1\" readonly=\"readonly\" />";
			echo $tr;
		?> 
		</tr>
		</tbody>

		<tbody id="additional_gutter">
		<tr class="added-gutter-tr"> 
		<?php
			$tr = "";
			$tr .= "<td class=\"td-item\">".listItem("guttering")." <input type=\"hidden\" class=\"price select\" value=\"0\"  category=\"Gutters Standard\" inventoryid=\"\" />   </td>";
			$tr .= "<td><input type=\"button\" class=\"added_item\" value=\"Remove\" ></td>"; 
			$tr .= "<td>".listColours()."</td>";   
			$tr .= "<td class=\"td-finish-color\">".listColourBond(null,null,"Guttering")."</td>";  
			$tr .= "<td class=\"td-uom\">Mtrs <input type=\"hidden\" name=\"uom[]\" value=\"Mtrs\" \>  </td>";  
			$tr .= "<td class=\"td-qty\"><input type=\"text\" class=\"qtylen gutter-qty\" name=\"qty[]\" value=\"1\"></td>";  
			$tr .= "<td class=\"td-len\"><input type=\"text\" id=\"new_gutter_length\" name=\"slength[]\" class=\"input-size input-in gutter-length length\" value=\"".(METRIC_SYSTEM=="inch"?"12":"1")."\"  ></td>";  
			if(METRIC_SYSTEM=="inch"){
				$tr .= "<td class=\"td-ft\"><input type=\"text\"  class=\"input-ft gutter-length\" value=\"1\" ></td>";  
			}
			$tr .= "<td class=\"td-rrp\"><input type=\"text\" class=\"rrp\" readonly=\"readonly\" name=\"rrp[]\" value=\"\"></td>";  
	 		$tr .= "<input type=\"hidden\" class=\"desc\" name=\"desc[]\" value=\"\" readonly=\"readonly\" />".
					       "<input type=\"hidden\" class=\"invent\" name=\"invent[]\" value=\"\" readonly=\"readonly\" />
					        <input type=\"hidden\" class=\"\" name=\"is_additional[]\" value=\"1\" readonly=\"readonly\" />";
			echo $tr;
		?> 
		</tr>
		</tbody>
 

		<tbody id="additional_flashing">
		<tr class="added-flashing-tr"> 
		<?php
			$tr = "";
			$tr .= "<td class=\"td-item\">".listItem("flashing")." <input type=\"hidden\" class=\"price\" value=\"0\" category=\"flashing\" inventoryid=\"\" />   </td>";
			$tr .= "<td><input type=\"button\" class=\"added_item\" value=\"Remove\" ></td>"; 
			$tr .= "<td>".listColours()."</td>";   
			$tr .= "<td class=\"td-finish-color\">".listColourBond(null,null,"Guttering")."</td>";   
			$tr .= "<td class=\"td-uom\">Mtrs <input type=\"hidden\" name=\"uom[]\" value=\"Mtrs\" \> </td>";  
			$tr .= "<td class=\"td-qty\"><input type=\"text\" class=\"qtylen\" name=\"qty[]\" value=\"1\"></td>";  
			$tr .= "<td class=\"td-len\"> <input type=\"text\"  name=\"slength[]\" class=\"length input-in\" value=\"".(METRIC_SYSTEM=="inch"?"12":"1")."\" style=\"\"> </td>";  
			if(METRIC_SYSTEM=="inch"){
				$tr .= "<td class=\"td-ft\"><input type=\"text\"  class=\"input-ft length\" value=\"1\" ></td>";  
			}
			$tr .= "<td class=\"td-rrp\"><input type=\"text\" class=\"rrp\" readonly=\"readonly\" name=\"rrp[]\" value=\"\"></td>";  
	 		$tr .= "<input type=\"hidden\" class=\"desc\" name=\"desc[]\" value=\"\" readonly=\"readonly\" />".
					       "<input type=\"hidden\" class=\"invent\" name=\"invent[]\" value=\"\" readonly=\"readonly\" />
					        <input type=\"hidden\" class=\"\" name=\"is_additional[]\" value=\"1\" readonly=\"readonly\" />";
			echo $tr;
		?> 
		</tr>
		</tbody>

		

		<tbody id="additional_fixing">
		<tr class="added-fixing-tr"> 
		<?php
			$tr = "";
			$tr .= "<td class=\"td-item\">".listItem("fixings")." <input type=\"hidden\" class=\"price\" value=\"0\" category=\"Beam Fixings\" inventoryid=\"\" />   </td>";
			$tr .= "<td><input type=\"button\" class=\"added_item\" value=\"Remove\" ></td>"; 
			$tr .= "<td> <input type=\"hidden\" name=\"colour[]\" /> </td>";   
			$tr .= "<td> <input type=\"hidden\" name=\"finish[]\" /> </td>";  
			$tr .= "<td class=\"td-uom\">Ea <input type=\"hidden\" name=\"uom[]\" value=\"Ea\" \> </td>";  
			$tr .= "<td class=\"td-qty\"><input type=\"text\" class=\"qtylen\" name=\"qty[]\" value=\"1\"></td>";  
			$tr .= "<td class=\"td-len\"> <input type=\"text\"  name=\"slength[]\" class=\"length\" value=\"".(METRIC_SYSTEM=="inch"?"12":"1")."\" style=\"display:none\"> </td>";
			if(METRIC_SYSTEM=="inch"){
				$tr .= "<td class=\"td-ft\"><input type=\"text\"  class=\"input-ft\" value=\"1\" style=\"display:none\" ></td>";  
			}
			$tr .= "<td class=\"td-rrp\"><input type=\"text\" class=\"rrp\" readonly=\"readonly\" name=\"rrp[]\" value=\"\"></td>";  
	 		$tr .= "<input type=\"hidden\" class=\"desc\" name=\"desc[]\" value=\"\" readonly=\"readonly\" />".
					       "<input type=\"hidden\" class=\"invent\" name=\"invent[]\" value=\"\" readonly=\"readonly\" />
					        <input type=\"hidden\" class=\"\" name=\"is_additional[]\" value=\"1\" readonly=\"readonly\" />";
			echo $tr;
		?> 
		</tr>
		</tbody>

		<tbody id="additional_downpipe">
		<tr class="added-downpipe-tr"> 
		<?php
			$tr = "";
			$tr .= "<td class=\"td-item\">".listItem("downpipe")." <input type=\"hidden\" class=\"price\" value=\"0\" category=\"misc\" inventoryid=\"\" />   </td>";
			$tr .= "<td><input type=\"button\" class=\"added_item\" value=\"Remove\" ></td>"; 
			$tr .= "<td> <input type=\"hidden\" name=\"colour[]\" /> </td>";   
			$tr .= "<td> <input type=\"hidden\" name=\"finish[]\" /> </td>";  
			$tr .= "<td class=\"td-uom\">Ea <input type=\"hidden\" name=\"uom[]\" value=\"Ea\" \> </td>";  
			$tr .= "<td class=\"td-qty\"><input type=\"text\" class=\"qtylen\" name=\"qty[]\" value=\"1\"></td>";  
			$tr .= "<td class=\"td-len\"> <input type=\"text\"  name=\"slength[]\" class=\"length\" value=\"".(METRIC_SYSTEM=="inch"?"12":"1")."\" style=\"display:none\"> </td>";
			if(METRIC_SYSTEM=="inch"){
				$tr .= "<td class=\"td-ft\"><input type=\"text\"  class=\"input-ft\" value=\"1\" style=\"display:none\" ></td>";  
			}  
			$tr .= "<td class=\"td-rrp\"><input type=\"text\" class=\"rrp\" readonly=\"readonly\" name=\"rrp[]\" value=\"\"></td>";  
	 		$tr .= "<input type=\"hidden\" class=\"desc\" name=\"desc[]\" value=\"\" readonly=\"readonly\" />".
					       "<input type=\"hidden\" class=\"invent\" name=\"invent[]\" value=\"\" readonly=\"readonly\" />
					        <input type=\"hidden\" class=\"\" name=\"is_additional[]\" value=\"1\" readonly=\"readonly\" />";
			echo $tr;
		?> 
		</tr>
		</tbody>

		<tbody id="additional_louver">
		<tr class="added-louver-tr"> 
		<?php
			$colorSelection = listColours("",null,"vergola-colour");
			$listColourBondSelection = listColourBond("",null,"Vergola"); 

			$tr = "";
			$tr .= "<td class=\"td-item\">".listItem("louvers")." <input type=\"hidden\" class=\"price\" value=\"0\" category=\"\" inventoryid=\"\" />   </td>";
			$tr .= "<td><input type=\"button\" class=\"added_item\" value=\"Remove\" ></td>"; 
			$tr .= "<td  >{$colorSelection}</td>";   
			$tr .= "<td class=\"td-finish-color\">{$listColourBondSelection}</td>";  
			$tr .= "<td class=\"td-uom\">Mtrs <input type=\"hidden\" name=\"uom[]\" value=\"Mtrs\" \> </td>";  
			$tr .= "<td class=\"td-qty\"><input type=\"text\" class=\"qtylen added-louvres-qty\" name=\"qty[]\" value=\"\"></td>";  
			$tr .= "<td class=\"td-len\"> <input type=\"text\"  name=\"slength[]\" class=\"added-louvres-len input-in\" value=\"\" > </td>";
			if(METRIC_SYSTEM=="inch"){
				$tr .= "<td class=\"td-ft\"><input type=\"text\"  class=\"input-ft added-louvres-len\" value=\"\" ></td>";  
			}  
			$tr .= "<td class=\"td-rrp\"><input type=\"text\" class=\"rrp\" readonly=\"readonly\" name=\"rrp[]\" value=\"\"></td>";  
	 		$tr .= "<input type=\"hidden\" class=\"desc\" name=\"desc[]\" value=\"\" readonly=\"readonly\" />".
					       "<input type=\"hidden\" class=\"invent\" name=\"invent[]\" value=\"\" readonly=\"readonly\" />
					        <input type=\"hidden\" class=\"\" name=\"is_additional[]\" value=\"1\" readonly=\"readonly\" />";
			echo $tr;
		?> 
		</tr>

		<tr class="added-pivot-strip-tr"> 
		<?php 

			$tr = "";
			$tr .= "<td class=\"td-item\">  ".addItem("IRV59")." <input type=\"hidden\" class=\"price\" value=\"0\" category=\"\" inventoryid=\"\" /></td>";
			$tr .= "<td> </td>"; 
			$tr .= "<td>{$colorSelection}</td>";   
			$tr .= "<td>{$listColourBondSelection}</td>";  
			$tr .= "<td class=\"td-uom\">Ea <input type=\"hidden\" name=\"uom[]\" value=\"Ea\" \> </td>";  
			$tr .= "<td class=\"td-qty\"><input type=\"text\" class=\"qtylen\" name=\"qty[]\" value=\"0\"></td>";  
			$tr .= "<td class=\"td-len\"><input type=\"text\"  name=\"slength[]\" class=\"\" value=\"0\" style=\"display:none;\" > </td>";
			if(METRIC_SYSTEM=="inch"){
				$tr .= "<td class=\"td-ft\"><input type=\"text\"  class=\"input-ft\" value=\"0\" style=\"display:none;\"  ></td>";  
			}  
			$tr .= "<td class=\"td-rrp\"><input type=\"text\" class=\"rrp\" readonly=\"readonly\" name=\"rrp[]\" value=\"\"></td>";  
	 		$tr .= "<input type=\"hidden\" class=\"desc\" name=\"desc[]\" value=\"".getItemName("IRV59")."\" readonly=\"readonly\" />".
					       "<input type=\"hidden\" class=\"invent\" name=\"invent[]\" value=\"IRV59\" readonly=\"readonly\" />
					        <input type=\"hidden\" class=\"\" name=\"is_additional[]\" value=\"1\" readonly=\"readonly\" />";
			echo $tr;
		?> 
		</tr>

		<tr class="added-link-bar-tr"> 
		<?php
			$tr = "";
			$tr .= "<td class=\"td-item\">".addItem("IRV60")." <input type=\"hidden\" class=\"price\" value=\"0\" category=\"\" inventoryid=\"\" /></td>";
			$tr .= "<td> </td>"; 
			$tr .= "<td>{$colorSelection}</td>";   
			$tr .= "<td>$listColourBondSelection</td>";  
			$tr .= "<td class=\"td-uom\">Ea <input type=\"hidden\" name=\"uom[]\" value=\"Ea\" \> </td>";  
			$tr .= "<td class=\"td-qty\"><input type=\"text\" class=\"qtylen\" name=\"qty[]\" value=\"0\"></td>";  
			$tr .= "<td class=\"td-len\"> <input type=\"text\"  name=\"slength[]\" class=\"\" value=\"0\" style=\"display:none;\" > </td>";
			if(METRIC_SYSTEM=="inch"){
				$tr .= "<td class=\"td-ft\"><input type=\"text\"  class=\"input-ft\" value=\"0\" style=\"display:none;\" ></td>";  
			}  
			$tr .= "<td class=\"td-rrp\"><input type=\"text\" class=\"rrp\" readonly=\"readonly\" name=\"rrp[]\" value=\"\"></td>";  
	 		$tr .= "<input type=\"hidden\" class=\"desc\" name=\"desc[]\" value=\"".getItemName("IRV60")."\" readonly=\"readonly\" />".
					       "<input type=\"hidden\" class=\"invent\" name=\"invent[]\" value=\"IRV60\" readonly=\"readonly\" />
					        <input type=\"hidden\" class=\"\" name=\"is_additional[]\" value=\"1\" readonly=\"readonly\" />";
			echo $tr;
		?> 
		</tr>
		</tbody>

		<tbody id="additional_misc">
		<tr class="added-misc-tr"> 
		<?php
			$tr = "";
			$tr .= "<td class=\"td-item\">".listItem("misc")." <input type=\"hidden\" class=\"price\" value=\"0\" category=\"misc\" inventoryid=\"\" />   </td>";
			$tr .= "<td><input type=\"button\" class=\"added_item\" value=\"Remove\" ></td>"; 
			$tr .= "<td> </td>";   
			$tr .= "<td> </td>";  
			$tr .= "<td class=\"td-uom\">Ea <input type=\"hidden\" name=\"uom[]\" value=\"Ea\" \> </td>";  
			$tr .= "<td class=\"td-qty\"><input type=\"text\" class=\"qtylen\" name=\"qty[]\" value=\"1\"></td>";  
			$tr .= "<td class=\"td-len\"> <input type=\"text\"  name=\"slength[]\" class=\"length\" value=\"".(METRIC_SYSTEM=="inch"?"12":"1")."\" style=\"display:none\"> </td>"; 
			if(METRIC_SYSTEM=="inch"){
				$tr .= "<td class=\"td-ft\"><input type=\"text\"  class=\"input-ft\" value=\"1\" style=\"display:none\" ></td>";  
			}
			$tr .= "<td class=\"td-rrp\"><input type=\"text\" class=\"rrp\" readonly=\"readonly\" name=\"rrp[]\" value=\"\"></td>";  
	 		$tr .= "<input type=\"hidden\" class=\"desc\" name=\"desc[]\" value=\"\" readonly=\"readonly\" />".
					       "<input type=\"hidden\" class=\"invent\" name=\"invent[]\" value=\"\" readonly=\"readonly\" />
					        <input type=\"hidden\" class=\"\" name=\"is_additional[]\" value=\"1\" readonly=\"readonly\" />";
			echo $tr;
		?> 
		</tr>
		</tbody>

		<tbody id="additional_extra">
		<tr class="added-extra-tr"> 
		<?php
			$tr = "";
			$tr .= "<td class=\"td-item\">".listItem("extras")." <input type=\"hidden\" class=\"price\" value=\"1\"  category=\"extra\" inventoryid=\"\" />   </td>";
			$tr .= "<td><input type=\"button\" class=\"added_item\" value=\"Remove\" ></td>"; 
			$tr .= "<td> </td>";   
			$tr .= "<td> </td>";  
			$tr .= "<td class=\"td-uom\">Ea <input type=\"hidden\" name=\"uom[]\" value=\"Ea\" \> </td>";  
			$tr .= "<td class=\"td-qty\"><input type=\"text\" class=\"qtylen\" name=\"qty[]\" value=\"1\"></td>";
			$tr .= "<td class=\"td-len\"> <input type=\"text\"  name=\"slength[]\" class=\"length\" value=\"".(METRIC_SYSTEM=="inch"?"12":"1")."\" style=\"display:none\"> </td>";
			if(METRIC_SYSTEM=="inch"){
				$tr .= "<td class=\"td-ft\"><input type=\"text\"  class=\"input-ft\" value=\"1\" style=\"display:none\" ></td>";  
			}
			$tr .= "<td class=\"td-rrp\"><input type=\"text\" class=\"rrp\" readonly=\"readonly\" name=\"rrp[]\" value=\"\"></td>";  
	 		$tr .= "<input type=\"hidden\" class=\"desc\" name=\"desc[]\" value=\"\" readonly=\"readonly\" />".
					       "<input type=\"hidden\" class=\"invent\" name=\"invent[]\" value=\"\" readonly=\"readonly\" />
					        <input type=\"hidden\" class=\"\" name=\"is_additional[]\" value=\"1\" readonly=\"readonly\" />";
			echo $tr;
		?> 
		</tr>
		</tbody>

		<tbody id="additional_disbursement">
		<tr class="added-disbursement-tr tr-disbursements"> 
		<?php
			$tr = "";
			$tr .= "<td class=\"td-item\">".listItem("disbursements")." <input type=\"hidden\" class=\"price\" value=\"0\" category=\"misc\" inventoryid=\"\" />   </td>";
			$tr .= "<td><input type=\"button\" class=\"added_item\" value=\"Remove\" ></td>"; 
			$tr .= "<td> </td>";   
			$tr .= "<td> </td>";  
			$tr .= "<td class=\"td-uom\">Ea <input type=\"hidden\" name=\"uom[]\" value=\"Ea\" \> </td>";  
			$tr .= "<td class=\"td-qty\"><input type=\"text\" class=\"qtylen\" name=\"qty[]\" value=\"1\"></td>";  
			$tr .= "<td class=\"td-len\"> <input type=\"text\"  name=\"slength[]\" class=\"length\" value=\"".(METRIC_SYSTEM=="inch"?"12":"1")."\" style=\"display:none\"> </td>";
			if(METRIC_SYSTEM=="inch"){
				$tr .= "<td class=\"td-ft\"><input type=\"text\"  class=\"input-ft\" style=\"display:none;\"  value=\"1\" ></td>";  
			}  
			$tr .= "<td class=\"td-rrp\"><input type=\"text\" class=\"rrp rrp-disbursement\" readonly=\"readonly\" name=\"rrp[]\" value=\"\"></td>";  
	 		$tr .= "<input type=\"hidden\" class=\"desc\" name=\"desc[]\" value=\"\" readonly=\"readonly\" />".
					       "<input type=\"hidden\" class=\"invent\" name=\"invent[]\" value=\"\" readonly=\"readonly\" />
					        <input type=\"hidden\" class=\"\" name=\"is_additional[]\" value=\"1\" readonly=\"readonly\" />";
			echo $tr;
		?> 
		</tr>
		</tbody>

	</table>
	
</div>  

<?php  

function get_feet_value($inch){
	return floor($inch / 12)."&rsquo;" . floor($inch % 12);     
}


function generateHtmlReport($projectid,$title){ 
	global $inventory_table;
	
	if(METRIC_SYSTEM=="inch" && IS_TEST_MODE == '1'){
		$inventory_table = "ver_chronoforms_data_inventory_vic_inch";
	}else{
		$inventory_table = "ver_chronoforms_data_inventory_vic";
	}
	 
	 
	$sql = "SELECT *,DATE_FORMAT(quotedate,'{$sql_dformat}') fquotedate FROM ver_chronoforms_data_followup_vic AS f JOIN ver_chronoforms_data_clientpersonal_vic AS c ON c.clientid=f.quoteid   WHERE  f.projectid = '".$projectid."' "; 
	$proj = mysql_query($sql);
	$project = mysql_fetch_array($proj);  

	$sql = "SELECT * FROM ver_chronoforms_data_quote_vic  WHERE  projectid = '".$projectid."' "; 
	$quoteResult = mysql_query($sql);
	$quoteInfo = mysql_fetch_array($quoteResult);  

	$VergolaType = $quoteInfo['framework'];
	$client_id = $project['quoteid'];
	$project_id = $project['projectid'];

	$dimension = "";
	$resultm = mysql_query("SELECT * FROM ver_chronoforms_data_measurement_vic WHERE projectid  = '$projectid'"); 
	if (!$resultm) {die("Error: Data not found..");}

	$numBay = 0; 
	$ReLen = null;
	$ReWid = null;
	$_ReWid = null;

	 
	if($VergolaType == "Double Bay" || $VergolaType == "Double Bay - Drop-In" || $VergolaType == "Double Bay VR2" || $VergolaType == "Double Bay VR3" || $VergolaType == "Double Bay VR3 - Gutter" || $VergolaType == "Three Bay VR4" || $VergolaType == "Four Bay VR6" || $VergolaType == "Double Bay VR2 - Drop-In" || $VergolaType == "Double Bay VR3 - Drop-In" || $VergolaType == "Double Bay VR3 - Gutter - Drop-In" || $VergolaType == "Three Bay VR4 - Drop-In" || $VergolaType == "Four Bay VR6 - Drop-In"  || $VergolaType == "Three Bay VR5" || $VergolaType == "Three Bay VR5 - Drop-In" || $VergolaType == "Three Bay VR4 - Drop-In" || $VergolaType == "Four Bay VR7" || $VergolaType == "Four Bay VR7 - Drop-In"){
		$k=0; 
		while ($retrievem = mysql_fetch_array($resultm)){
			if(METRIC_SYSTEM=="meter"){
				$ReLen[$k] = $retrievem['length'];
				$_ReWid = $retrievem['width'];
			}else{
				$ReLen[$k] = html_entity_decode(get_feet_value($retrievem['length']));
				$_ReWid = html_entity_decode(get_feet_value($retrievem['width']));
			}

			$k++; 
		}	
		$numBay = 2;
		$dimension = $ReLen[0].' X '.$_ReWid; 
		 	
	}else if($VergolaType == "Multiple Bay" || $VergolaType == "Multiple Bay - Drop-In"){
		$k=0; 
		while ($retrievem = mysql_fetch_array($resultm)){
			if(METRIC_SYSTEM=="meter"){
				$ReLen[$k] = $retrievem['length'];
				$ReWid[$k] = $retrievem['width']; 
			}else{
				$ReLen[$k] = html_entity_decode(get_feet_value($retrievem['length']));
				$ReWid[$k] = html_entity_decode(get_feet_value($retrievem['width'])); 
			}	
			
			$k++; 

		}	
		$numBay = $k;
		$dimension = $ReLen[0].' X '.$ReWid[0]; 
		error_log("AM HERE 2!", 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_sa_prod\\my-error.log'); 
	}else{
		$retrievem = mysql_fetch_array($resultm);
		if(METRIC_SYSTEM=="meter"){
			$ReLen = $retrievem['length'];
			$ReWid = $retrievem['width'];
		}else{
			$ReLen = html_entity_decode(get_feet_value($retrievem['length']));
			$ReWid = html_entity_decode(get_feet_value($retrievem['width'])); 
		}
		
		  
		$numBay = 1; 
		$dimension = $ReLen.' X '.$ReWid;
	}


$html = "";
		$html .= "<div style=\"font-family:Arial, Helvetica, sans-serif; width:700px;  font-size: 10pt;\">
 
<table class=\"template_tbl\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\"  style=\"font-size:9pt; border-collapse:collapse;\">
	<tr>
		<td colspan=\"7\" align=\"center\"><h3>Vergola System Costing Summary</h3></td>
	</tr>
	<tr>
		<td colspan=\"7\">&nbsp;</td>
	</tr>
	<tr>
		<td colspan=\"2\"><b>Client Name</b></td>
		<td ><b>Client No</b></td>
		<td colspan=\"2\"><b>Consultant</b></td>
		<td colspan=\"2\"><b>Date Quoted</b></td>
	</tr> 
	<tr>
		<td colspan=\"2\">".($project['is_builder']=="1"?$project['builder_name']:$project['client_firstname'].' '.$project['client_lastname'])."</td>
		<td >{$project['quoteid']}</td>
		<td colspan=\"2\">{$project['sales_rep']}</td>
		<td colspan=\"2\">{$project['fquotedate']}</td>
	</tr>
	<tr>
		<td colspan=\"7\">&nbsp;</td>
	</tr>
	<tr>
		
		<td width=\"270\">
			 <b>Project Name </b> 
		</td>
		 
		<td width=\"80\">
		 	 <b>Quote No</b>
		</td>
		 
		<td width=\"100\">
			 <b>Type of Vergola </b> 
		</td>";
		//(fnmatch("*Single Bay VR1",$VergolaType)){ 
		if (fnmatch("*Single Bay VR*",$VergolaType)){ 			 
			$html .= "<td width=\"70\">
			 	 <b>Length </b>
			</td>
			<td width=\"70\" colspan=\"2\">
				 <b>Width </b> 
			</td>";
		}else{			 
			$html .= "<td width=\"70\" align=\"center\">
		 	 	<b>Length 1 </b>
			</td>
			<td width=\"70\" align=\"center\">
				 <b>Length 2 </b> 
			</td>
			<td width=\"70\" align=\"center\">
				 <b>Width </b> 
			</td>";
		}
	$html .= "</tr>
	<tr>
		 
		<td>
		 	".addslashes($project['project_name'])."
		</td>
		<td> 
			{$project['projectid']}
		</td>
		<td>
		 	{$quoteInfo['framework']}
		</td>";

		if (fnmatch("*Single Bay VR*",$VergolaType)){ 
			$html .= "<td align=\"center\"> {$ReLen}</td>
			<td align=\"center\">
				{$ReWid}
			</td>";
		}else{
			$html .= "<td align=\"center\">{$ReLen[0]}</td>
			<td align=\"center\">
				 {$ReLen[1]}
			</td>
			<td align=\"center\">
				{$_ReWid}
			</td>";
		}

	$html .= "</tr>	
	 
</table> <br/> ";  
 

$html .= "

<table class=\"\" border=\"0\" cellspacing=\"0\" style=\"border-collapse:collapse;font-size:9pt; \" >
	<tr>
		<th width=\"220\">
		 	<b>Description</b>  
		</th>
		<th width=\"70\">
			&nbsp;&nbsp;<b>Webbing</b>&nbsp;&nbsp;
		</th>
		<th width=\"65\">
			 <b>Colour</b>  
		</th>
		<th width=\"75\">
			&nbsp;&nbsp;<b>Finish</b> &nbsp;&nbsp;
		</th>
		<th width=\"50\">
			&nbsp;&nbsp;<b>UOM</b> &nbsp;&nbsp;
		</th>
		<th width=\"50\" style=\"text-align:right;\">
			&nbsp;&nbsp;<b>Qty</b> &nbsp;&nbsp;
		</th>
		<th width=\"60\" style=\"text-align:right;\">
			&nbsp;&nbsp;<b>Length</b> &nbsp;&nbsp;
		</th>
		<th width=\"100\" style=\"text-align:right;\">
			&nbsp;&nbsp;<b>RRP</b> &nbsp;&nbsp;
		</th>
	</tr>";
 
	//Framework
	$sql = " SELECT  i.inventoryid, q.* FROM ver_chronoforms_data_quote_vic AS q LEFT JOIN {$inventory_table} AS i ON i.inventoryid=q.inventoryid WHERE q.projectid='{$projectid}' AND LOWER(i.section) = 'frame'   ";
	//error_log($sql, 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_sa_prod\\my-error.log'); 
	$item_result = mysql_query ($sql);

	
	$html .= "<tr> <th colspan=\"8\" style=\"text-align:left;\" border=\"1\">&nbsp;<b>Framework</b></th> </tr>"; 
	while ($row = mysql_fetch_assoc($item_result)){  
			if($row['qty']>0){	
				$html .= "<tr>
					<td>{$row['description']}</td> 
					<td>{$row['webbing']}</td>
					<td>{$row['colour']}</td>
					<td>{$row['finish']}</td>
					<td>{$row['uom']}</td>  
					<td style=\"text-align:right;\">{$row['qty']}</td>
					<td style=\"text-align:right;\">";

					if(METRIC_SYSTEM=="meter"){
						$html .= ($row['uom']=="Mtrs"?$row['length']:"");
					}else{ 
						$html .= ($row['uom']=="Mtrs"?get_feet_value($row['length']):"");
					}					

					$html .= "</td>
					<td style=\"text-align:right;\">&#36;{$row['rrp']}</td>
				</tr>";  
			}
		}
		$html .= "<tr><td colspan=\"8\"></td></tr>";

	//fittings
	$sql = "SELECT  i.inventoryid ,q.* FROM ver_chronoforms_data_quote_vic AS q LEFT JOIN {$inventory_table} AS i ON i.inventoryid=q.inventoryid WHERE q.projectid=\"{$projectid}\"  AND i.section=\"Fixings\"  ";
	
	$item_result = mysql_query ($sql);
	
	$html .= "<tr> <th colspan=\"8\" style=\"text-align:left;\" border=\"1\">&nbsp;<b>Fittings</b></th> </tr>"; 
	while ($row = mysql_fetch_assoc($item_result)){  
		if($row['qty']>0){	
			$html .= "<tr>
				<td>{$row['description']}</td> 
				<td>{$row['webbing']}</td>
				<td>{$row['colour']}</td>
				<td>{$row['finish']}</td>
				<td>{$row['uom']}</td>
				<td style=\"text-align:right;\">{$row['qty']}</td>
				<td style=\"text-align:right;\">";

					if(METRIC_SYSTEM=="meter"){
						$html .= ($row['uom']=="Mtrs"?$row['length']:"");
					}else{ 
						$html .= ($row['uom']=="Mtrs"?get_feet_value($row['length']):"");
					}					

					$html .= "</td>
				<td style=\"text-align:right;\">&#36;{$row['rrp']}</td>
			</tr>";  
		}
	}
		$html .= "<tr><td colspan=\"8\"></td></tr>";


	//GUtters
	$sql = " SELECT  i.inventoryid,q.* FROM ver_chronoforms_data_quote_vic AS q LEFT JOIN {$inventory_table} AS i ON i.inventoryid=q.inventoryid WHERE q.projectid='{$projectid}' AND i.section = 'Guttering' ";

	$item_result = mysql_query ($sql);
	
	$html .= "<tr> <th colspan=\"8\" style=\"text-align:left;\" border=\"1\">&nbsp;<b>Gutter</b></th> </tr>"; 
	while ($row = mysql_fetch_assoc($item_result)){  
			if($row['qty']>0){
				$html .= "<tr>
					<td>{$row['description']}</td> 
					<td>{$row['webbing']}</td>
					<td>{$row['colour']}</td>
					<td>{$row['finish']}</td>
					<td>{$row['uom']}</td>  
					<td style=\"text-align:right;\">{$row['qty']}</td>
					<td style=\"text-align:right;\">";

					if(METRIC_SYSTEM=="meter"){
						$html .= ($row['uom']=="Mtrs"?$row['length']:"");
					}else{ 
						$html .= ($row['uom']=="Mtrs"?get_feet_value($row['length']):"");
					}					

					$html .= "</td>
					<td style=\"text-align:right;\">&#36;{$row['rrp']}</td>
				</tr>";  
			}
		}
		$html .= "<tr><td colspan=\"8\"></td></tr>";

	//Flashing
	$sql = "SELECT  i.inventoryid,  q.* FROM ver_chronoforms_data_quote_vic AS q LEFT JOIN {$inventory_table} AS i ON i.inventoryid=q.inventoryid WHERE q.projectid='{$projectid}'  AND i.section='Flashings'  ";
	
	$item_result = mysql_query ($sql);
	
	$html .= "<tr> <th colspan=\"8\" style=\"text-align:left;\" border=\"1\">&nbsp;<b>Flashings</b></th> </tr>"; 
	while ($row = mysql_fetch_assoc($item_result)){  
 		if($row['qty']>0){
			$html .= "<tr>
				<td>{$row['description']}</td> 
				<td>{$row['webbing']}</td>
				<td>{$row['colour']}</td>
				<td>{$row['finish']}</td>
				<td>{$row['uom']}</td>  
				<td style=\"text-align:right;\">{$row['qty']}</td>
				<td style=\"text-align:right;\">";

					if(METRIC_SYSTEM=="meter"){
						$html .= ($row['uom']=="Mtrs"?$row['length']:"");
					}else{ 
						$html .= ($row['uom']=="Mtrs"?get_feet_value($row['length']):"");
					}					

					$html .= "</td>
				<td style=\"text-align:right;\">&#36;{$row['rrp']}</td>
			</tr>"; 
		} 
	}
		$html .= "<tr><td colspan=\"8\"></td></tr>";	
		

	//downpipe 		
	$sql = "SELECT  i.inventoryid,  q.* FROM ver_chronoforms_data_quote_vic AS q LEFT JOIN {$inventory_table} AS i ON i.inventoryid=q.inventoryid WHERE q.projectid='{$projectid}'  AND i.section='Downpipe'  ";
	
	$item_result = mysql_query ($sql);
	
	$html .= "<tr> <th colspan=\"8\" style=\"text-align:left;\" border=\"1\">&nbsp;<b>Downpipe</b></th> </tr>"; 
	while ($row = mysql_fetch_assoc($item_result)){ 
		if($row['qty']>0){
			$html .= "<tr>
				<td>{$row['description']}</td> 
				<td>{$row['webbing']}</td>
				<td>{$row['colour']}</td>
				<td>{$row['finish']}</td>
				<td>{$row['uom']}</td>  
				<td style=\"text-align:right;\">{$row['qty']}</td>
				<td style=\"text-align:right;\">";

					if(METRIC_SYSTEM=="meter"){
						$html .= ($row['uom']=="Mtrs"?$row['length']:"");
					}else{ 
						$html .= ($row['uom']=="Mtrs"?get_feet_value($row['length']):"");
					}					

					$html .= "</td>
				<td style=\"text-align:right;\">&#36;{$row['rrp']}</td>
			</tr>";  
		}
	}
		$html .= "<tr><td colspan=\"8\"></td></tr>";

	//vergola		 
	$sql = "SELECT  i.inventoryid,  q.* FROM ver_chronoforms_data_quote_vic AS q LEFT JOIN {$inventory_table} AS i ON i.inventoryid=q.inventoryid WHERE q.projectid='{$projectid}'  AND i.section='Vergola'  ";

	$item_result = mysql_query ($sql);
	
	$html .= "<tr> <th colspan=\"8\" style=\"text-align:left;\" border=\"1\">&nbsp;<b>Vergola</b></th> </tr>"; 
	while ($row = mysql_fetch_assoc($item_result)){
		if($row['qty']>0){  
			$html .= "<tr>
				<td>{$row['description']}</td> 
				<td>{$row['webbing']}</td>
				<td>{$row['colour']}</td>
				<td>{$row['finish']}</td>
				<td>{$row['uom']}</td>  
				<td style=\"text-align:right;\">{$row['qty']}</td>
				<td style=\"text-align:right;\">";

					if(METRIC_SYSTEM=="meter"){
						$html .= ($row['uom']=="Mtrs"?$row['length']:"");
					}else{ 
						$html .= ($row['uom']=="Mtrs"?get_feet_value($row['length']):"");
					}					

					$html .= "</td>
				<td style=\"text-align:right;\">&#36;{$row['rrp']}</td>
			</tr>";  
		}
	}
		$html .= "<tr><td colspan=\"8\"></td></tr>";

	//misc  
	$sql = " SELECT  i.inventoryid,  q.* FROM ver_chronoforms_data_quote_vic AS q LEFT JOIN {$inventory_table} AS i ON i.inventoryid=q.inventoryid WHERE q.projectid='{$projectid}'   AND i.section='Misc'  ";		

	$item_result = mysql_query ($sql);
	
	$html .= "<tr> <th colspan=\"8\" style=\"text-align:left;\" border=\"1\">&nbsp;<b>Miscellaneous</b></th> </tr>"; 
	while ($row = mysql_fetch_assoc($item_result)){
		if($row['qty']>0){ 
				$html .= "<tr>
					<td>{$row['description']}</td> 
					<td>{$row['webbing']}</td>
					<td>{$row['colour']}</td>
					<td>{$row['finish']}</td>
					<td>{$row['uom']}</td>  
					<td style=\"text-align:right;\">{$row['qty']}</td>
					<td style=\"text-align:right;\">";

					if(METRIC_SYSTEM=="meter"){
						$html .= ($row['uom']=="Mtrs"?$row['length']:"");
					}else{ 
						$html .= ($row['uom']=="Mtrs"?get_feet_value($row['length']):"");
					}					

					$html .= "</td>
					<td style=\"text-align:right;\">&#36;{$row['rrp']}</td>
				</tr>";  
			}
		}
		$html .= "<tr><td colspan=\"8\"></td></tr>";

	//extras 
	$sql = "SELECT  i.inventoryid,  q.* FROM ver_chronoforms_data_quote_vic AS q LEFT JOIN {$inventory_table} AS i ON i.inventoryid=q.inventoryid WHERE q.projectid='{$projectid}'  AND i.section='Extras'  ";		
	
	$item_result = mysql_query ($sql);
	
	$html .= "<tr> <th colspan=\"8\" style=\"text-align:left;\" border=\"1\">&nbsp;<b>Extras</b></th> </tr>"; 
	while ($row = mysql_fetch_assoc($item_result)){ 
		if($row['qty']>0){
			$html .= "<tr>
				<td>{$row['description']}</td> 
				<td>{$row['webbing']}</td>
				<td>{$row['colour']}</td>
				<td>{$row['finish']}</td>
				<td>{$row['uom']}</td>  
				<td style=\"text-align:right;\">{$row['qty']}</td>
				<td style=\"text-align:right;\">";

					if(METRIC_SYSTEM=="meter"){
						$html .= ($row['uom']=="Mtrs"?$row['length']:"");
					}else{ 
						$html .= ($row['uom']=="Mtrs"?get_feet_value($row['length']):"");
					}					

					$html .= "</td>
				<td style=\"text-align:right;\">&#36;{$row['rrp']}</td>
			</tr>";  
		}
	}
	$html .= "<tr><td colspan=\"8\"></td></tr>";
 
	//disbursements   
	$sql = "SELECT  i.inventoryid, q.* FROM ver_chronoforms_data_quote_vic AS q LEFT JOIN {$inventory_table} AS i ON i.inventoryid=q.inventoryid WHERE q.projectid='{$projectid}'   AND i.section='Disbursements'  ";		

	//error_log($sql, 3,\"C:\\xampp\htdocs\\vergola_contract_system_v4_sa_prod\\my-error.log\"); 
	$item_result = mysql_query ($sql);
	
	$html .= "<tr> <th colspan=\"8\" style=\"text-align:left;\" border=\"1\">&nbsp;<b>Disbursements</b></th> </tr>"; 
	while ($row = mysql_fetch_assoc($item_result)){ 
 		if($row['qty']>0){
			$html .= "<tr>
				<td>{$row['description']}</td> 
				<td>{$row['webbing']}</td>
				<td>{$row['colour']}</td>
				<td>{$row['finish']}</td>
				<td>{$row['uom']}</td>  
				<td style=\"text-align:right;\">{$row['qty']}</td>
				<td style=\"text-align:right;\">";

					if(METRIC_SYSTEM=="meter"){
						$html .= ($row['uom']=="Mtrs"?$row['length']:"");
					}else{ 
						$html .= ($row['uom']=="Mtrs"?get_feet_value($row['length']):"");
					}					

					$html .= "</td>
				<td style=\"text-align:right;\">&#36;{$row['rrp']}</td>
			</tr>";  
		}
	}
	  
$html .= "	 
</table>
 
<br/><br/>
<table class=\"template_tbl\" cellspacing=\"0\" cellpadding=\"0\" style=\"border-collapse:collapse; font-size:8pt; \" >
	<tr>
		<td colspan=\"2\" style=\"text-align: left\" width=\"200\"> 
		 	 <b>Commission</b>
		</td> 
  
  		<td width=\"50\"> 
			 &nbsp; &nbsp; 
		</td>

		<td colspan=\"2\" style=\"text-align: left\" width=\"200\"> 
		 	 <b>Payment</b>
		</td> 
		 
	 	<td width=\"50\"> 
			 &nbsp; &nbsp;  
		</td>

		<td colspan=\"2\" style=\"text-align: left\" width=\"200\"> 
		 	<b>Total</b>
		</td> 
		 
	</tr>

	<tr>
		<td> 
			<u>Sales Commission</u>
		</td>
		<td>
		   <b>&#36;".$project["sales_comm"]."</b>
		</td>
		<td> 
			 &nbsp; &nbsp; &nbsp; 
		</td>

		<td> 
			Deposit
		</td>
		<td>
		 	 &#36;".$project["payment_deposit"]."
		</td>
		<td> 
			 &nbsp; &nbsp; &nbsp;  
		</td>

		<td> 
			Vergola
		</td>
		<td>
		 	&#36;".$project["subtotal_vergola"]."
		</td> 
	</tr>

	<tr>
		<td colspan=\"2\"> 
			Sales Commission Payment Schedule
		</td>
		 
		<td> 
			 &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp;
		</td>

		<td> 
			Progress payment
		</td>
		<td>
		 	&#36;".$project["payment_progress"]."
		</td>
		<td> 
			 &nbsp; &nbsp; &nbsp;  
		</td>

		<td> 
			Disbursement
		</td>
		<td>
		 	<u>&#36;".$project["subtotal_disbursement"]."</u>
		</td>
		 
	</tr>	

	<tr>
		<td> 
			Pay 1
		</td>
		<td>
		    &#36;".$project["com_pay1"]."
		</td>
		<td> 
			 &nbsp;
		</td>

		<td> 
			Final payment
		</td>
		<td>
		 	 &#36;".$project["payment_final"]."
		</td>
		<td> 
			 &nbsp;
		</td>

		<td> 
			Sub Total
		</td>
		<td>
		 	&#36;".$project["total_cost"]."
		</td>


	</tr>	

	<tr>
		<td> 
			Pay 2
		</td>
		<td>
		 &#36;".$project["com_pay2"]."
		</td>
		<td> 
			 &nbsp;
		</td>

		<td> 
			&nbsp;
		</td>
		<td>
		 	&nbsp;
		</td>
		<td> 
			&nbsp;
		</td>

		<td> 
			GST
		</td>
		<td>
		 	<u>&#36;".$project["total_cost_gst"]."</u>
		</td>
		 
	</tr>

	<tr>
		<td> 
			Final
		</td>
		<td>
		  &#36;".$project["com_final"]."
		</td>
		<td> 
			 &nbsp;
		</td>

		<td> 
			&nbsp;
		</td>
		<td> 
			&nbsp;
		</td>
		<td>
		 	&nbsp;
		</td>
		
		<td> 
			 
		</td>
		<td > 
		 	
		</td> 
		 
	</tr>	

	<tr>
		<td colspan=\"6\">
			&nbsp;
		</td>
		<td>
			<u>Total</u>
		</td>
		<td style=\"border-bottom:1pt solid black;\" >
			 <u>&#36;".$project["total_rrp_gst"]."</u>
		</td>
	</tr>

	<tr>
		<td> 
			<u>Installer Payment</u>
		</td>
		<td>
		  <b>&#36;".$project["install_comm_cost"]."</b>
		</td>
		<td> 
			 &nbsp;
		</td>

		<td> 
			&nbsp;
		</td>
		<td>
		 	&nbsp;
		</td>
		<td> 
			 &nbsp;
		</td>

		<td> 
			 &nbsp;
		</td>
		<td>
		 	 &nbsp;
		</td>
		 
	</tr>		
	 
</table>    
</div>";

return $html;
//I will convert every ' in html to \" to properly save in msyql string.

}




?>

