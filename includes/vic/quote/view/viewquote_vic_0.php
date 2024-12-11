<link rel="stylesheet" type="text/css" media="screen,projection" href="<?php echo JURI::base().'jscript/new-enquiry.css'; ?>" />
<link rel="stylesheet" type="text/css" media="screen,projection" href="<?php echo JURI::base().'jscript/client-folder.css'; ?>" />


<script src="<?php echo JURI::base().'jscript/jquery.min.js'; ?>"></script>
<script src="<?php echo JURI::base().'jscript/add-item.js'; ?>"></script>
<script charset="UTF-8" type="text/javascript" src='<?php echo JURI::base();?>jscript/client-folder.js'></script>

<?php
$sql_dformat = SQL_DFORMAT;

$user = JFactory::getUser();
//error_log(print_r($user,true), 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_vic\\my-error.log'); 
$user_group = "";
$is_admin = 0; $is_system_admin = 0; $is_sales_manager = 0; $is_construction_manager = 0;   $is_sales_consultant = 0; $is_reception = 0; $is_account_user = 0;
if(isset($user->groups['10'])){
  $is_system_admin = 1;
  $is_admin = 1;
  $user_group = "system_admin";
}else if(isset($user->groups['26']) ){
  $is_construction_manager = 1;
  $is_admin = 1;
  $user_group = "construction_manager";
}else if( isset($user->groups['27'])){
  $is_sales_manager = 1;
  $is_admin = 1;
  $user_group = "sales_manager";
}else if( isset($user->groups['28'])){
  $is_reception = 1; 
  $user_group = "reception";
}else if( isset($user->groups['29'])){
  $is_account_user = 1; 
  $user_group = "account_user"; 
}else{
  $is_sales_consultant = 1;
  $user_group = "sales_consultant";
}

//error_log("HERE 1:", 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_vic\\my-error.log'); 

if(isset($_REQUEST['projectid'])){
	$ProjectID = mysql_real_escape_string($_REQUEST['projectid']);
}else{
	$ProjectID = mysql_real_escape_string($_POST['projectid']);
}

if(isset($_POST['delete_quote'])){
	$quote_cf_id = mysql_real_escape_string($_POST['quote_cf_id']);
	$projectid = mysql_real_escape_string($_POST['projectid']);
	$clientid = mysql_real_escape_string($_POST['clientid']);
	$is_tender_quote = mysql_real_escape_string($_POST['is_tender_quote']);

	$sql = "DELETE FROM ver_chronoforms_data_quote_vic WHERE projectid='{$projectid}'  ";
	//error_log($sql, 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_vic\\my-error.log'); 
	mysql_query($sql);

	$sql = "DELETE FROM ver_chronoforms_data_followup_vic WHERE cf_id={$quote_cf_id} ";
	mysql_query($sql);

 
	if($is_tender_quote){  
		$sql = "SELECT * FROM ver_chronoforms_data_builderpersonal_vic WHERE tenderid  = '$clientid' LIMIT 1";
	}else{
		$sql = "SELECT * FROM ver_chronoforms_data_clientpersonal_vic WHERE clientid  = '$clientid'";
	}
	 
	$resultc = mysql_query($sql);
	$retrievec = mysql_fetch_array($resultc);

 
	//header("Location:".JURI::base()."client-listing-vic/client-folder-vic?cid={$clientid}"); 
	if($is_tender_quote){
		header('Location:'.JURI::base()."tender-listing-vic/tender-folder-vic?tenderid=".$clientid);					
	}else if($retrievec['is_builder']){
		header('Location:'.JURI::base().'builder-listing-vic/builder-folder-vic?cid='.$clientid);
	}else{
		header('Location:'.JURI::base().'client-listing-vic/client-folder-vic?cid='.$clientid);
	}

}
 
if(substr($ProjectID, 0,3)!="PRV"){ //substr($ProjectID, 0,3)!="QID" || substr($ProjectID, 0,4)=="QIDV"
	require "view_old_quote.php";
	return;
}

$BeamIDArrayPhp = '';
$BeamDESCArrayPhp = '';
$BeamRRPArrayPhp = '';
$BeamCOSTArrayPhp = '';
$BeamUOMArrayPhp = '';
$ref = "";
$user = JFactory::getUser();

if(isset($_REQUEST['ref']) && strlen($_REQUEST['ref'])>0){ 
	$ref = $_REQUEST['ref'];
}

global $inventory_table;  
if(METRIC_SYSTEM=="inch"  && IS_TEST_MODE == '1'){
	$inventory_table = "ver_chronoforms_data_inventory_vic_inch";
}else{
	$inventory_table = "ver_chronoforms_data_inventory_vic";
}


$resultff = mysql_query("SELECT * FROM ver_chronoforms_data_followup_vic WHERE projectid  = '$ProjectID'");
$retrieveff = mysql_fetch_array($resultff);
//error_log(" retrieveff:".print_r($retrieveff,true), 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_vic\\my-error.log'); 
if (!$resultff) {die("Error: Data not found..");}
$quote = $retrieveff;
$ProjectName = $retrieveff['project_name'];
$QuoteDate = $retrieveff['quotedate'];
$RetrieveDate = date(PHP_DFORMAT,strtotime($QuoteDate));
$Framework = $retrieveff['framework_type'];
 
$QuoteID = $retrieveff['quoteid'];
$quoteid = $QuoteID;
$quote_cf_id = $retrieveff['cf_id'];
//error_log("QuoteID 1:".$QuoteID, 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_vic\\my-error.log'); 

$is_tender_quote=0;       
if($retrieveff['is_tender_quote']==1){
	$is_tender_quote=1;

	if($ref==""){
		$ref = "tender-listing-vic/tender-folder-vic?tenderid=".$quoteid;
	}
}

//$is_builder=0;
//$is_builder = $retrieveff['is_builder'];
//error_log("ref: ".$ref, 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_vic\\my-error.log');
//error_log(print_r($retrieveff,true), 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_vic\\my-error.log');
// if(substr($QuoteID,0,3)=="BRV"){
// 	$is_builder = 1;
// 	//error_log('is builder', 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_vic\\my-error.log');
// }
//error_log("QuoteID: ".$QuoteID, 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_vic\\my-error.log');
$PID = substr($QuoteID,3);
//echo $QuoteID;
$QuoteIDAlpha = substr($QuoteID, 0, 3);
//echo $QuoteIDAlpha;
$QuoteIDNum = substr($QuoteID, 3);
//echo $QuoteIDNum;
$RetSubVergola = $retrieveff['subtotal_vergola'];
$RetSubDisburse = $retrieveff['subtotal_disbursement'];

$RetTotalRRP = $retrieveff['total_rrp'];
$RetTotalGST = $retrieveff['total_gst'];
$RetTotalRRPGST = $retrieveff['total_rrp_gst'];

$RetTotalCost = $retrieveff['total_cost'];
$RetTotalCostGST = $retrieveff['total_cost_gst'];

$RetGST = $retrieveff['gst_percent'];
$RetCommision = $retrieveff['comm_percent'];
$RetSalesComm= $retrieveff['sales_comm'] ;
$RetInstallComm= $retrieveff['install_comm'];
$RetSalesCost= $retrieveff['sales_comm_cost'] ;
$RetInstallCost= $retrieveff['install_comm_cost'];
$RetStatus = $retrieveff['status'] ;
$default_color = $retrieveff['status'] ;
 
//error_log("retrieveff: ".print_r($retrieveff,true), 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_vic\\my-error.log');
	
$resultq = mysql_query("SELECT * FROM ver_chronoforms_data_quote_vic WHERE projectid  = '$ProjectID'");
$retrieveq = mysql_fetch_array($resultq);
//error_log("retrieveq: ".print_r($retrieveq,true), 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_vic\\my-error.log');
if (!$resultq) {die("Error: Data not found..");}
$VergolaType = $retrieveq['framework'];	
 

$is_create_duplicate = 0;
if(isset($_REQUEST['req']) && $_REQUEST['req']=='duplicate'){
	$is_create_duplicate = 1;
}
 

?>
 

<?php 
	
	if ($RetStatus == 'Won') {echo "<style>#project #update, #project #save-close, #downbtn #update-down, #downbtn #save-close-down {background-color:#ccc;color:#eee;border:1px solid #ddd;} input[type=\"button\"] {display:none;} input.save-btn {display:inline-block;}</style>";} 
	 
?>

<script>
function DisEnableTYP()
{
	var frmTYPE = document.getElementById("frameworktype")
	var frmSEL = document.getElementById("framework")
	var frmLEN = document.getElementById("lengthid")
	var frmWID = document.getElementById("widthid")
	var frmBAY = document.getElementById("bayid")

	if(frmTYPE.options[frmTYPE.selectedIndex].value == "Framework")
	 {
	    frmSEL.disabled = false;
		frmLEN.disabled = true;
		frmWID.disabled = true;
		frmBAY.disabled = true;
		document.getElementById('frameset').style.display = 'inline-block';
		document.getElementById('length').style.display = 'none'; 
		document.getElementById('width').style.display = 'none'; 
		document.getElementById('bay').style.display = 'none'; 
		
	 }
	else
	 {
	    frmSEL.selectedIndex = 0;
	    frmSEL.disabled = true;
		frmLEN.disabled = true;
		frmWID.disabled = true;
		frmBAY.disabled = true;  
		document.getElementById('frameset').style.display = 'none';
	 }
}

function DisEnableBAY()
{
	var frmSEL = document.getElementById("framework")
	var frmLEN = document.getElementById("lengthid")
	var frmWID = document.getElementById("widthid")
	var frmBAY = document.getElementById("bayid")

	if(frmSEL.options[frmSEL.selectedIndex].value == "")
	{
		frmSEL.selectedIndex = 0;
		frmLEN.disabled = true;
		frmWID.disabled = true;
		frmBAY.disabled = true;  
		document.getElementById('length').style.display = 'none'; 
		document.getElementById('width').style.display = 'none'; 
		document.getElementById('bay').style.display = 'none';    
	}
	else if (frmSEL.options[frmSEL.selectedIndex].value == "Multiple Bay")
	{  
		frmLEN.disabled = false;
		frmWID.disabled = false;
		frmBAY.disabled = false;
		document.getElementById('length').style.display = 'inline-block'; 
		document.getElementById('width').style.display = 'inline-block'; 
		document.getElementById('bay').style.display = 'inline-block';  
	} 
	else
	{  
		frmLEN.disabled = false;
		frmWID.disabled = false;
		frmBAY.disabled = true;
		document.getElementById('length').style.display = 'inline-block'; 
		document.getElementById('width').style.display = 'inline-block'; 
		document.getElementById('save').style.display = 'inline-block';
		document.getElementById('bay').style.display = 'none';  
	}
}
 
 
$(document).ready(function() {  
	$("#lengthid").change(function(){
		$('.length').each(function(){
			$(this).val($('#lengthid').val());
		});
	});
	$("#widthid").change(function(){
		$('.width').each(function(){
		$(this).val($('#widthid').val());
		});
	});

   		   
	<?php 
		//error_log("VergolaType: ".$VergolaType, 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_vic\\my-error.log');
		//error_log(" VergolaType 2: ".$VergolaType, 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_vic\\my-error.log'); 
		//error_log("PROJECTID IN view quote: ".$ProjectID, 3,'/home/vergola/public_html/quote-system/my-error.log'); 
		//error_log("Framework: ".$Framework." VergolaType:".$VergolaType, 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_vic\\my-error.log');
		if ($VergolaType == 'Single Bay VR1' || $VergolaType == 'Single Bay VR1 - Drop-In'){  
			
		?>
			//$('#output').html('<?php  //require "view_singlebay_vic_vr1.php"; ?>'); 
			<?php if(METRIC_SYSTEM=="inch"){ ?>
				$.getScript('<?php echo JURI::base().'jscript/singlebay_vr1_inch.js?v='.mt_rand(); ?>');
			<?php }else{ ?>
				$.getScript('<?php echo JURI::base().'jscript/singlebay_vr1.js?v='.mt_rand(); ?>');
			<?php } ?>

		<?php
	  	}else if ($VergolaType == 'Single Bay VR0' || $VergolaType == 'Single Bay VR0 - Drop-In') { 		  		
	  	?>		
	  		//$('#output').html('<?php  //require "view_singlebay_vic_vr0.php"; ?>');
			

			<?php if(METRIC_SYSTEM=="inch"){ ?>
				$.getScript('<?php echo JURI::base().'jscript/singlebay_vr1_inch.js?v='.mt_rand(); ?>');
			<?php }else{ ?>
				$.getScript('<?php echo JURI::base().'jscript/singlebay_vr1.js?v='.mt_rand(); ?>');
			<?php } ?>

		<?php
	  	}else if ($VergolaType == 'Double Bay VR2'    || $VergolaType == 'Double Bay VR2 - Drop-In' ) { 
	  		//error_log(" VergolaType: ".$VergolaType, 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_vic\\my-error.log');
	  	?>	
	  	 
	  		<?php if(METRIC_SYSTEM=="inch"){ ?>
	  			$.getScript('<?php echo JURI::base().'jscript/doublebay_vr2_inch.js?v='.mt_rand(); ?>');
	  		<?php }else{ ?>
				$.getScript('<?php echo JURI::base().'jscript/doublebay_vr2.js?v='.mt_rand(); ?>');
			<?php } ?>				
	  		 
		<?php
	  	}else if ($VergolaType == 'Double Bay VR3'  || $VergolaType == 'Double Bay VR3 - Drop-In') { 
	  		
	  	?>	
	  		//$('#output').html('<?php  //require "view_doublebay_vic_vr3.php"; ?>');
			<?php if(METRIC_SYSTEM=="inch"){ ?>
	  			$.getScript('<?php echo JURI::base().'jscript/doublebay_vr2_inch.js?v='.mt_rand(); ?>');
	  		<?php }else{ ?>
				$.getScript('<?php echo JURI::base().'jscript/doublebay_vr2.js?v='.mt_rand(); ?>'); 
			<?php } ?>
		<?php
	  	}else if ($VergolaType == 'Double Bay VR3 - Gutter'  || $VergolaType == 'Double Bay VR3 - Gutter - Drop-In') { 
	  		
	  	?>	
	  		//$('#output').html('<?php //require "view_doublebay_vic_vr3_thru_gutter.php"; ?>');
			<?php if(METRIC_SYSTEM=="inch"){ ?>
	  			$.getScript('<?php echo JURI::base().'jscript/doublebay_vr2_inch.js?v='.mt_rand(); ?>');
	  		<?php }else{ ?>
				$.getScript('<?php echo JURI::base().'jscript/doublebay_vr2.js?v='.mt_rand(); ?>');
			<?php } ?>

		<?php
	  		}else if ($VergolaType == 'Three Bay VR4'  || $VergolaType == 'Three Bay VR4 - Drop-In' || $VergolaType == 'Four Bay VR6'  || $VergolaType == 'Four Bay VR6 - Drop-In' || $VergolaType == 'Three Bay VR5'  || $VergolaType == 'Three Bay VR5 - Drop-In' || $VergolaType == 'Four Bay VR7'  || $VergolaType == 'Four Bay VR7 - Drop-In') { 

	  			//error_log(" HERE 4: ", 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_vic\\my-error.log');
	  		
	  	?>	
	  		    
			$.getScript('<?php echo JURI::base().'jscript/doublebay_vr4.js?v='.mt_rand(); ?>');


		<?php }else if ($VergolaType == 'Single Bay VS1' || $VergolaType == 'Single Bay VS1') { ?>

			$.getScript('<?php echo JURI::base().'jscript/singlebay_vs1.js?v='.mt_rand(); ?>');

		<?php }else {?> 
			$('#output').html('<?php echo "Nothing"; ?>'); // update the DIV 
		<?php } ?>
 
});
 
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


$resultm = mysql_query("SELECT * FROM ver_chronoforms_data_measurement_vic WHERE projectid  = '$ProjectID'");
//error_log("SELECT * FROM ver_chronoforms_data_measurement_vic WHERE projectid  = '$ProjectID'", 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_vic\\my-error.log');
if (!$resultm) {die("Error: Data not found..");}

$numBay = 0;
$ReLen = null;
$ReWid = null;
$_ReWid = null;
//error_log("vergola type: ".$VergolaType, 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_vic\\my-error.log');

if($VergolaType == "Double Bay" || $VergolaType == "Double Bay - Drop-In" || $VergolaType == "Double Bay VR2" || $VergolaType == "Double Bay VR3" || $VergolaType == "Double Bay VR3 - Gutter" || $VergolaType == "Double Bay VR2 - Drop-In" || $VergolaType == "Double Bay VR3 - Drop-In" || $VergolaType == "Double Bay VR3 - Gutter - Drop-In" || $VergolaType == "Three Bay VR4" || $VergolaType == "Three Bay VR4 - Drop-In" || $VergolaType == "Four Bay VR6" || $VergolaType == "Four Bay VR6 - Drop-In" || $VergolaType == "Three Bay VR5" || $VergolaType == "Three Bay VR5 - Drop-In" || $VergolaType == "Four Bay VR7" || $VergolaType == "Four Bay VR7 - Drop-In" ){
	$k=0; 
	while ($retrievem = mysql_fetch_array($resultm)){
		$ReLen[$k] = $retrievem['length'];
		$_ReWid = $retrievem['width'];
		$k++;   
	}	

	
	//error_log("L4: ".$ReLen[3]. "L3: ".$ReLen[2]. " L2: ".$ReLen[1]. " L1: ".$ReLen[0]." W:".$_ReWid, 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_vic\\my-error.log');	
}else{
	//Get the length for single bay.
	$retrievem = mysql_fetch_array($resultm);
	$ReLen = $retrievem['length'];
	$ReWid = $retrievem['width'];
	  
}
// else if($VergolaType == "Three Bay VR4" || $VergolaType == "Three Bay VR4 - Drop-In"){
// 	$k=0; 
// 	while ($retrievem = mysql_fetch_array($resultm)){
// 		$ReLen[$k] = $retrievem['length'];
// 		$k++;
// 	}	
// 	$numBay = $k; 
// 	//error_log("AM HERE 2!", 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_vic\\my-error.log'); 
// }

//error_log(print_r($ReLen,true), 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_vic\\my-error.log');
//error_log(print_r($_ReWid,true), 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_vic\\my-error.log');

if($is_create_duplicate){
	//$RetrieveDate = Date("d-M-Y H:i:s");
	$ProjectName = $ProjectName." - Duplicate";
}

//error_log("VergolaType: ".$VergolaType, 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_vic\\my-error.log');
global $colours;
$colours = [];
$sqlcolour = "SELECT * FROM ver_chronoforms_data_colour_vic ORDER BY colour"; 
$resultcolour = mysql_query ($sqlcolour); 
while ($colour = mysql_fetch_assoc($resultcolour)) 
	{ 
		//error_log($colour['colour'], 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_vic\\my-error.log');
		array_push($colours,$colour['colour']);		 
	} 
//error_log("outside: ".print_r($colours,true), 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_vic\\my-error.log');
$ref_page = isset($_REQUEST['ref_page']) ? $_REQUEST['ref_page'] : '';

if($ref_page=="contracts"){
	$quoteid = $QuoteID;
	$projectid = $ProjectID;
	$page_name = isset($_REQUEST['page_name']) ? $_REQUEST['page_name'] : '';

?>
<div class="" style="display:<?php echo (($is_system_admin || $is_construction_manager || $is_account_user)?'inline-block':'none'); ?>;" >		
	<!-- <button class="btn" name="close"> Close </button> &nbsp; -->
 	
 	<!-- -------------------  BUTTON NAVIGATION ----------------------------- -->
	<?php echo "<a href=\"".JURI::base()."contract-listing-vic/contract-folder-vic/contract-folder-vic?quoteid=".$quoteid."&projectid=".$projectid."\" class='btn '>&nbsp;&nbsp; Contract Details &nbsp;&nbsp;</a>&nbsp;"; ?>
	<?php echo "<a href=\"".JURI::base()."view-quote-vic?ref=back&quoteid=".$quoteid."&projectid=".$projectid."&ref_page=contracts\" class='btn ".($page_name=="quote_details"?"btn-disabled":"")."'>&nbsp;&nbsp; Quote Details &nbsp;&nbsp;</a>&nbsp;"; ?>
	<?php echo "<a href=\"".JURI::base()."contract-listing-vic/contract-folder-vic/contract-bom-vic?quoteid=".$quoteid."&projectid=".$projectid."&page_name=bom\" class='btn '>&nbsp;&nbsp; BOM &nbsp;&nbsp;</a>&nbsp;"; ?>
	<?php echo "<a href=\"".JURI::base()."contract-listing-vic/contract-folder-vic/contract-po-vic?quoteid=".$quoteid."&projectid=".$projectid."&page_name=po\" class='btn '>&nbsp;&nbsp; PO &nbsp;&nbsp;</a>&nbsp;"; ?>
	<?php echo "<a href=\"".JURI::base()."contract-listing-vic/contract-folder-vic/contract-po-vic?quoteid=".$quoteid."&projectid=".$projectid."&page_name=po&view=summary\" class='btn '>&nbsp;&nbsp; PO Summary &nbsp;&nbsp;</a>&nbsp;"; ?>
	<?php echo "<a href=\"".JURI::base()."contract-listing-vic/contract-folder-vic/contract-folder-vic?quoteid=".$quoteid."&projectid=".$projectid."&tab=checklist\" class='btn '>&nbsp;&nbsp; Check List &nbsp;&nbsp;</a>&nbsp;"; ?> 
	<!-- -------------------  BUTTON NAVIGATION ----------------------------- -->  
</div>
<br/><br/><br/>	
<?php } ?>

<form method="post" class="<?php ($quote['status']=="Won" || $quote['status']=="Lost")?"show-form-disable":"" ?> <?php ($quote['status']=="Quoted" || $quote['status']=="In progress")?"edit-form":"" ?>">
<input type="hidden" value="<?php echo $quote['status']; ?>" id="status"   />
<input type="hidden" value="<?php echo $ProjectID; ?>" name="projectid" id="projectid"   />
<input type="hidden" value="<?php echo $quote['default_color']; ?>" id="default_color" name="paintselect"  /> 
<input type='hidden' name='user_group' id='user_group' value="<?php echo $user_group; ?>" / >
<input type='hidden' name='is_create_duplicate' id='is_create_duplicate' value="<?php echo $is_create_duplicate; ?>" / >
<input type='hidden' name='is_tender_quote' id='is_tender_quote' value="<?php echo $quote['is_tender_quote']; ?>" / >


<div id="project" class="<?php echo ($is_create_duplicate==1?'duplicating-fields':'') ?>">
	<span class="quoteinfo"><label>Date Entered</label><input type="text" value="<?php echo $RetrieveDate; ?>" name="quotedate" class="quotedate"  readonly="readonly" /></span> 
	<span class="quoteinfo"><label>Framework Type</label><input type="text" id="frameworktype" name="frameworktype" value="<?php echo $Framework; ?>" readonly/></span>
	<span class="quoteinfo"><label>Type Of Vergola</label><input type="text" id="framework" name="framework"  value="<?php if($VergolaType=="Three Bay VR4"){echo "Three Bay VR4";}else if($VergolaType=="Four Bay VR6"){echo "Four Bay VR6";}else if($VergolaType=="Three Bay VR5"){echo "Three Bay VR5";}else if($VergolaType=="Four Bay VR7"){echo "Four Bay VR7";}else{echo $VergolaType;} ?>"  readonly="readonly" style="width:150px" /></span>
	<span class="quoteinfo"><label>Project Name</label><input type="text" value="<?php echo htmlspecialchars($ProjectName); ?>" name="projectsite" id="projectsite" autofocus autocomplete="off"  /></span>
	<div id="frameset">  
	 	
	 	<?php if($VergolaType == 'Single Bay VR1' || $VergolaType == 'Single Bay VR1 - Drop-In' || $VergolaType == 'Single Bay VS1' || $VergolaType == 'Single Bay VS1 - Drop-In' ) { ?>
			<?php if(METRIC_SYSTEM=="inch"){ //error_log("ReWid: ".$ReWid." get_feet_whole: ".get_feet_whole($ReWid)." get_feet_inch: ".get_feet_inch($ReWid), 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_vic\\my-error.log');  ?>
				<div id="singlebay_input_us" style="display: inline;">	 
					<span  class="quoteinfo quote-length" >
						<label>Length</label><input type="text" value="<?php echo get_feet_whole($ReLen); ?>" name="length_ft" id="length_ft" class="num  ft" placeholder="Ft." autocomplete="off" /> 
						<input type="text" value="<?php echo get_feet_inch($ReLen); ?>" name="length_in" id="length_in" class="num  in" style="width: 30px;" placeholder="In." autocomplete="off" />
					</span>
					<span  class="quoteinfo  quote-length" >
						<label>Width</label><input type="text" value="<?php echo get_feet_whole($ReWid); ?>" name="width_ft" id="width_ft" class="num " placeholder="Ft." autocomplete="off"/>
						<input type="text" value="<?php echo get_feet_inch($ReWid); ?>" name="width_in" id="width_in" class="num  in" style="width: 30px;" placeholder="In." placeholder="In." autocomplete="off" />
					</span>  
				</div>

			<?php } ?>

			<div style="<?php echo (METRIC_SYSTEM=="inch"?"display:none;":""); ?>">
				<span id="length" class="quoteinfo quote-length"><label>Length</label><input type="text" value="<?php echo $ReLen; ?>" name="length" id="lengthid" class="num" autocomplete="off" /></span>
				<span id="width" class="quoteinfo quote-length"><label>Width</label><input type="text" value="<?php echo $ReWid; ?>" name="width" id="widthid" class="num" autocomplete="off" /></span>
			</div>

		<?php  }else if($VergolaType == 'Double Bay VR2' || $VergolaType == 'Double Bay VR3' || $VergolaType == 'Double Bay VR3 - Gutter' || $VergolaType == 'Double Bay VR2 - Drop-In' || $VergolaType == 'Double Bay VR3 - Drop-In' || $VergolaType == 'Double Bay VR3 - Gutter - Drop-In' ) {  ?>
			 
			<div id="doublebay_input" style="<?php echo (METRIC_SYSTEM=="inch"?"display:none;":"display:inline;"); ?>"> 
				<span  class="quoteinfo quote-length"><label>Length 1</label><input  type="text" value="<?php echo $ReLen[0]; ?>" name="dblength[]" id="dblengthid1" class="num" autocomplete="off" autocomplete="off" /></span>
				<span   class="quoteinfo quote-length"><label>Length 2</label><input type="text" value="<?php echo $ReLen[1]; ?>" name="dblength[]" id="dblengthid2" class="num" autocomplete="off" autocomplete="off" /></span>
				<span   class="quoteinfo quote-length"><label>Width</label><input type="text" value="<?php echo $_ReWid; ?>" name="dbwidth[]"  id="dbwidthid1"   class="_width num" autocomplete="off" /></span>
			</div>
		 
			<div id="doublebay_input_us" style="<?php echo (METRIC_SYSTEM=="inch"?"display:inline;":"display:none;"); ?>">	 
				<span  class="quoteinfo quote-length" >
					<label>Length 1</label><input type="text" value="<?php echo get_feet_whole($ReLen[0]); ?>" name="" id="length1_ft" class="num ft" placeholder="Ft." autocomplete="off" /> 
					<input type="text" value="<?php echo get_feet_inch($ReLen[0]); ?>" name="" id="length1_in" class="num  in" style="width: 30px;" placeholder="In." autocomplete="off" />
				</span>
				<span  class="quoteinfo quote-length" >
					<label>Length 2</label><input type="text" value="<?php echo get_feet_whole($ReLen[1]); ?>" name="" id="length2_ft" class="num ft" placeholder="Ft." autocomplete="off" /> 
					<input type="text" value="<?php echo get_feet_inch($ReLen[1]); ?>" name="" id="length2_in" class="num  in" style="width: 30px;" placeholder="In." autocomplete="off" />
				</span>
				<span  class="quoteinfo  quote-length" >
					<label>Width</label><input type="text" value="<?php echo get_feet_whole($_ReWid); ?>" name="" id="dbwidth_ft" class="num " placeholder="Ft." autocomplete="off"/>
					<input type="text" value="<?php echo get_feet_inch($_ReWid); ?>" name="" id="dbwidth_in" class="num in" style="width: 30px;" placeholder="In." placeholder="In." autocomplete="off" />
				</span>  
			</div>
 
		<?php }else if($VergolaType == 'Three Bay VR4' || $VergolaType == 'Three Bay VR4 - Drop-In' || $VergolaType == 'Four Bay VR6' || $VergolaType == 'Four Bay VR6 - Drop-In' || $VergolaType == 'Three Bay VR5' || $VergolaType == 'Three Bay VR5 - Drop-In' || $VergolaType == 'Four Bay VR7' || $VergolaType == 'Four Bay VR7 - Drop-In') { ?>
			<div id="doublebay_input" style="<?php echo (METRIC_SYSTEM=="inch"?"display:none;":"display:inline;"); ?>"> 
				<span  class="quoteinfo quote-length"><label>Length 1</label><input  type="text" value="<?php echo $ReLen[0]; ?>" name="dblength[]" id="dblengthid1" class="num" autocomplete="off" autocomplete="off" /></span>
				<span   class="quoteinfo quote-length"><label>Length 2</label><input type="text" value="<?php echo $ReLen[1]; ?>" name="dblength[]" id="dblengthid2" class="num" autocomplete="off" autocomplete="off" /></span>
				<span   class="quoteinfo quote-length"><label>Length 3</label><input type="text" value="<?php echo $ReLen[2]; ?>" name="dblength[]" id="dblengthid3" class="num" autocomplete="off" autocomplete="off" /></span>
				<?php
					if($VergolaType == 'Four Bay VR6' || $VergolaType == 'Four Bay VR6 - Drop-In' || $VergolaType == 'Four Bay VR7' || $VergolaType == 'Four Bay VR7 - Drop-In'){
				?>

					<span   class="quoteinfo quote-length"><label>Length 4</label><input type="text" value="<?php echo $ReLen[3]; ?>" name="dblength[]" id="dblengthid4" class="num" autocomplete="off" autocomplete="off" /></span>

				<?php } ?>
				<span   class="quoteinfo quote-length"><label>Width</label><input type="text" value="<?php echo $_ReWid; ?>" name="dbwidth[]"  id="dbwidthid1"   class="_width num" autocomplete="off" /></span>
			</div>
		 
			<div id="doublebay_input_us" style="<?php echo (METRIC_SYSTEM=="inch"?"display:inline;":"display:none;"); ?>">	 
				<span  class="quoteinfo quote-length" >
					<label>Length 1</label><input type="text" value="<?php echo get_feet_whole($ReLen[0]); ?>" name="" id="length1_ft" class="num ft" placeholder="Ft." autocomplete="off" /> 
					<input type="text" value="<?php echo get_feet_inch($ReLen[0]); ?>" name="" id="length1_in" class="num  in" style="width: 30px;" placeholder="In." autocomplete="off" />
				</span>
				<span  class="quoteinfo quote-length" >
					<label>Length 2</label><input type="text" value="<?php echo get_feet_whole($ReLen[1]); ?>" name="" id="length2_ft" class="num ft" placeholder="Ft." autocomplete="off" /> 
					<input type="text" value="<?php echo get_feet_inch($ReLen[1]); ?>" name="" id="length2_in" class="num  in" style="width: 30px;" placeholder="In." autocomplete="off" />
				</span>
				<span  class="quoteinfo quote-length" >
					<label>Length 3</label> 
					<input type="text" value="<?php echo get_feet_inch($ReLen[2]); ?>" name="" id="length3_in" class="num  in" style="width: 30px;" placeholder="In." autocomplete="off" />
				</span>

				<?php  
					if($VergolaType == 'Four Bay VR6' || $VergolaType == 'Four Bay VR6 - Drop-In' || $VergolaType == 'Four Bay VR7' || $VergolaType == 'Four Bay VR7 - Drop-In') {  ?>
					<span  class="quoteinfo quote-length" >
						<label>Length 4</label> 
						<input type="text" value="<?php echo get_feet_inch($ReLen[3]); ?>" name="" id="length4_in" class="num in" style="width: 30px;" placeholder="In." autocomplete="off" />
					</span>

				<?php }  ?>
				<span  class="quoteinfo  quote-length" >
					<label>Width</label><input type="text" value="<?php echo get_feet_whole($_ReWid); ?>" name="" id="dbwidth_ft" class="num " placeholder="Ft." autocomplete="off"/>ASDead
					<input type="text" value="<?php echo get_feet_inch($_ReWid); ?>" name="" id="dbwidth_in" class="num in" style="width: 30px;" placeholder="In." placeholder="In." autocomplete="off" />
				</span>  
			</div>

		<?php }  ?>
		
	</div>
	<span class="modification-button-holder">
		<?php if($is_create_duplicate){ ?>
			<input type="submit" class="save-btn" value="Save" name="save_duplicate" id="save_duplicate" />
			<input type="submit" class="save-btn" value="Save & Close" name="save_close_duplicate" id="save_duplicate" />
		<?php }else{ ?>
			<input type="submit" class="save-btn" value="Save" name="update" id="update" />
			<input type="submit" class="save-btn" value="Save & Close" name="save-close" id="save-close" />
			
			<input type="button" class="save-btn" value="Create Duplicate" name="create_duplicate" id="create_duplicate" onClick="location.href='<?php echo JURI::base(). "view-quote-vic?projectid={$ProjectID}&req=duplicate"; ?>'" />

			<?php
				$pdf_title = 'Quotation Items '.$ProjectID.'-'.rand();
			?>
 
	       <!--  <a id="template_link" rel="nofollow" title="PDF" class="btn btn-s" onclick="window.open(this.href,'win2','status=no,toolbar=no,scrollbars=yes,titlebar=no,menubar=no,resizable=yes,width=auto,height=auto,directories=no,location=no'); $('#download_pdf').show(); return false;" href="index.php?projectid=<?php echo $ProjectID; ?>&title=<?php echo $pdf_title; ?>&option=com_chronoforms&tmpl=component&chronoform=Quote_Report" style="margin-right:5px;">&nbsp; Create PDF &nbsp;</a> -->

	        <a rel="nofollow" id="download_pdf" class="btn btn-s" onclick="window.open(this.href,'win2','status=no,toolbar=no,scrollbars=yes,titlebar=no,menubar=no,resizable=yes,width=auto,height=auto,directories=no,location=no'); return false;" href="index.php?titleID=<?php echo $ProjectID; ?>&option=com_chronoforms&tmpl=component&chronoform=Download-PDF"> Download PDF</a>
	     
	     	<input type="submit" class="save-btn" value="Delete" name="delete_quote" onclick="return confirm('Are you sure you want to delete quote?');" />
        <?php } ?> 


        <?php if($ref=="back"){ ?>
        	<input type="button" class="save-btn" value="Cancel" name="cancel1" id="cancel" onClick="history.back();" />
        <?php }else if($ref!=""){ ?>  <!--if($QuoteIDAlpha == 'CRV')-->
        	<input type="button" class="save-btn" value="Cancel" name="cancel1" id="cancel" onClick="location.href='<?php echo JURI::base().$ref; ?>'"  />	
        <?php }else{ ?> 
			<input type="button" class="save-btn" value="Cancel" name="cancel2" id="cancel" onClick="location.href='<?php echo JURI::base(). "client-listing-vic/client-folder-vic?cid=".$QuoteID; ?>'" />
		<?php }  ?>
			 
 
	</span>
</div>

<div id="output">
	<?php 
			//error_log("VergolaType: ".$VergolaType, 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_vic\\my-error.log');
			if ($VergolaType == 'Single Bay VR1' || $VergolaType == 'Single Bay VR1 - Drop-In') { 
				require "view_singlebay_vic_vr1.php";

			}else if ($VergolaType == 'Double Bay VR2'    || $VergolaType == 'Double Bay VR2 - Drop-In' ) { 
				require "view_doublebay_vic_vr2.php";
			
			}else if ($VergolaType == 'Double Bay VR3'  || $VergolaType == 'Double Bay VR3 - Drop-In') {
				require "view_doublebay_vic_vr3.php";

			}else if ($VergolaType == 'Double Bay VR3 - Gutter'  || $VergolaType == 'Double Bay VR3 - Gutter - Drop-In') {  
				require "view_doublebay_vic_vr3_thru_gutter.php";
			
			}else if ($VergolaType == 'Single Bay VR0' || $VergolaType == 'Single Bay VR0 - Drop-In') { 
				require "view_singlebay_vic_vr0.php";
		
			}else if ($VergolaType == 'Three Bay VR4'    || $VergolaType == 'Three Bay VR4 - Drop-In' ) { 
				
				require "view_doublebay_vic_vr4.php";
				
		
			}else if ($VergolaType == 'Four Bay VR6'    || $VergolaType == 'Four Bay VR6 - Drop-In' ) { 
				//error_log("b4 - VergolaType: ".$VergolaType, 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_vic\\my-error.log');
				require "view_doublebay_vic_vr6.php";
				//error_log("After - VergolaType: ".$VergolaType, 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_vic\\my-error.log');


			}else if ($VergolaType == 'Three Bay VR5'    || $VergolaType == 'Three Bay VR5 - Drop-In' ) { 
				require "view_doublebay_vic_vr5.php";
		
			}else if ($VergolaType == 'Four Bay VR7'    || $VergolaType == 'Four Bay VR7 - Drop-In' ) { 
				  
				require "view_doublebay_vic_vr7.php";
			 

			}else if ($VergolaType == 'Single Bay VS1' || $VergolaType == 'Single Bay VS1 - Drop-In') { 
				require "view_singlebay_vic_vs1.php"; 
			}

			//error_log("After - VergolaType: ".$VergolaType, 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_vic\\my-error.log');
	?>

</div>

<div id="projectcomm" style="padding-top:30px;">
	<span id="gst"><label>GST %</label><input type="text" value="<?php echo $RetGST; ?>" name="gst" id="gstid"  /></span><br />
	<span id="commision"><label>Commision %</label><input type="text" value="<?php echo $RetCommision; ?>" name="commision" id="commisionid" /></span><br />
	<span id="salescomm"><label>Sales Comm %</label><input type="text" value="<?php echo $RetSalesComm; ?>" name="salescomm" id="salescommid" /></span><br />
	<span id="installercomm"><label>Installer Comm %</label><input type="text" value="<?php echo $RetInstallComm; ?>" name="installercomm" id="installercommid" /></span><br />
	<span id="salescost"><label>Sales Cost</label><input type="text" value="<?php echo $RetSalesCost; ?>" name="salescost" id="salescostid" /></span><br />
	<span id="installercost"><label>Installer Cost</label><input type="text" value="<?php echo $RetInstallCost; ?>" name="installercost" id="installercostid" /></span>
</div>

<div id="projectcost" style="padding-top:30px;">
	<span id="subtotalvergola"><label>Subtotal Vergola</label><input type="text" value="<?php echo $RetSubVergola; ?>" name="subtotalvergola" id="subtotalvergolaid" /></span><br />
	<span id="subtotaldisd"><label>Subtotal Disbursement</label><input type="text" value="<?php echo $RetSubDisburse; ?>" name="subtotaldisd" id="subtotaldisdid" /></span><br />
	<span id="totalrrp"><label>Total Sell</label><input type="text" value="<?php echo $RetTotalRRP; ?>" name="totalrrp" id="totalrrpid" /></span><br />
	<span id="totalgst"><label>GST</label><input type="text" value="<?php echo $RetTotalGST; ?>" name="totalgst" id="totalgstid" /></span><br />
	<span id="totalrrpgst"><label>Total Sell Inc GST</label><input type="text" value="<?php echo $RetTotalRRPGST; ?>" name="totalrrpgst" id="totalrrpgstid" /></span><br />
	<span id="totalcost"><label>Total Cost</label><input type="text" value="<?php echo $RetTotalCost; ?>" name="totalcost" id="totalcostid" /></span><br />
	<span id="totalcostgst"><label>Total Cost Inc GST</label><input type="text" value="<?php echo $RetTotalCostGST; ?>" name="totalcostgst" id="totalcostgstid" /></span>
</div> 


<div class="table-subtotal-holder" style="display:none">
	<table id="commision_table" class="table-subtotal">
	<tbody>
		<tr><th colspan="2">Commission</th></tr>
		<tr><td>Sales Commission  </td><td><span style="margin-right:10px;">$</span><input type="text" class="" value="" id="com_sales_commission" name="com_sales_commission" /></td></tr>
		<tr><th colspan="2">Sales Commission payment schedule  </th></tr>
		<tr><td>Pay 1 </td><td><span style="margin-right:10px;">$</span><input type="text" class="" value="" id="com_pay1" name="com_pay1" /></td></tr>
		<tr><td>Pay 2 </td><td><span style="margin-right:10px;">$</span><input type="text" class="" value="" id="com_pay2" name="com_pay2" /></td></tr>
		<tr><td>Final </td><td><span style="margin-right:10px;">$</span><input type="text" class="" value="" id="com_final" name="com_final" /></td></tr> 
		<tr><td>Installer Payment </td><td><span style="margin-right:10px;">$</span><input type="text" class="" value="" id="com_installer_payment" name="com_installer_payment" /></td></tr>
	</tbody>
	</table> 

	<table id="payment_table" class="table-subtotal">
	<tbody>
		<tr><th colspan="2">Payment</th></tr>
		<tr><td>Deposit </td><td><span style="margin-right:10px;">$</span><input type="text" class="" value="" id="payment_deposit" name="payment_deposit" /></td></tr>
		<tr><td>Progress payment </td><td><span style="margin-right:10px;">$</span><input type="text" class="" value="" id="payment_progress" name="payment_progress" /></td></tr>
		<tr><td>Final payment </td><td><span style="margin-right:10px;">$</span><input type="text" class="" value="" id="payment_final" name="payment_final" /></td></tr> 
	</tbody>
	</table>  

	<table id="total_table" class="table-subtotal">
	<tbody>
		<tr><th colspan="2">Total</th></tr>
		<tr><td>Vergola  </td><td><span style="margin-right:10px;">$</span><input type="text" class="" value="" id="total_vergola" name="total_vergola" /></td></tr>
		<tr><td>Disbursement </td><td><span style="margin-right:10px;">$</span><input type="text" class="" value="" id="total_disbursement" name="total_disbursement" /></td></tr>
		<tr><td>Sub Total </td><td><span style="margin-right:10px;">$</span><input type="text" class="" value="" id="sub_total" name="sub_total" /></td></tr>
		<tr><td><?php if(HOST_SERVER=="LA"){echo "Sales Tax";}else{echo "GST";} ?>  </td><td><span style="margin-right:10px;">$</span><input type="text" class="" value="" id="total_gst" name="total_gst" /></td></tr>
		<tr class="tr-total"><td>Total </td><td><span style="margin-right:10px;">$</span><input type="text" class="" value="" id="total_sum" name="total_sum" /> <input type="hidden" class="" value="" id="total_rrp" name="total_rrp" /> </td></tr> 
	</tbody>
	</table>
</div>
  

<div id="downbtn">
	<?php if($is_create_duplicate){ ?>
			<input type="submit" class="save-btn" value="Save" name="save_duplicate" id="save_duplicate" />
			<input type="submit" class="save-btn" value="Save & Close" name="save_close_duplicate" id="save_duplicate" />
	<?php }else{ ?>
		<input type="submit" class="save-btn" value="Save" name="update" id="update-down" >
		<input type="submit" class="save-btn" value="Save & Close" name="save-close" id="save-close-down" />

	<?php } ?>
	<input type="hidden" value="<?php echo $QuoteID; ?>" name="clientid"  />
	<input type="hidden" value="<?php echo $quote_cf_id; ?>" name="quote_cf_id"  />

	<?php if($ref=="back"){ ?>
        	<input type="button" class="save-btn" value="Cancel" name="cancel1" id="cancel" onClick="history.back();" />
          <?php }else if($ref!=""){ ?>   
        	<input type="button" class="save-btn" value="Cancel" name="cancel1" id="cancel" onClick="location.href='<?php echo JURI::base().$ref; ?>'"  />		
        <?php }else{ ?>
		<input type="button" class="save-btn" value="Cancel" name="cancel" id="cancel-down" onClick="location.href='<?php echo JURI::base(). "client-listing-vic/client-folder-vic?cid=".$QuoteID; ?>'" />
	<?php }   ?>
		 
	<input type="submit" class="save-btn" value="Delete" name="delete_quote" onclick="return confirm('Are you sure you want to delete quote?');" />
</div>

</form>

 

<div> 
	<table style="float:left; margin-left:-9000px;" id="template_table">
		<tbody id="additional_post">
		<tr class="added-post-tr"> 
		<?php
			$tr = "";  
			$tr .= "<td class=\"td-item\">".listItem("beam_and_posts")." <input type=\"hidden\" class=\"price select\" value=\"0\" category=\"Posts\"  inventoryid=\"\" />   </td>";
			$tr .= "<td class=\"td-webbing\">  ".listWebbing("",null)." <br/> <input type=\"button\" class=\"added_item\" value=\"Remove\" > </td>"; 
			$tr .= "<td>".listColours()."</td>";   
			$tr .= "<td class=\"td-finish-color\">".listColourBond(null,null,"Frame")."</td>";  
			$tr .= "<td class=\"td-uom\">Mtrs <input type=\"hidden\" name=\"uom[]\" value=\"Mtrs\" \> </td>";  
			$tr .= "<td class=\"td-qty\"><input type=\"text\" class=\"qtylen\" name=\"qty[]\" value=\"1\"></td>";  
			$tr .= "<td class=\"td-len\"><input type=\"text\"  name=\"slength[]\" class=\"input-size input-in\" value=\"".(METRIC_SYSTEM=="inch"?"12":"1")."\"  ></td>";  
			if(METRIC_SYSTEM=="inch"){
				$tr .= "<td class=\"td-ft\"><input type=\"text\"  class=\"input-ft\" value=\"1\" ></td>";  
			}
			$tr .= "<td class=\"td-rrp\"><input type=\"text\" class=\"rrp\" readonly=\"readonly\" name=\"rrp[]\" value=\"\"></td>";  
	 		$tr .= "<input type=\"hidden\" class=\"desc\" name=\"desc[]\" value=\"\" readonly=\"readonly\" />".
					       "<input type=\"hidden\" class=\"invent\" name=\"invent[]\" value=\"IRV15\" readonly=\"readonly\" />
					        <input type=\"hidden\" class=\"\" name=\"is_additional[]\" value=\"1\" readonly=\"readonly\" />";
			echo $tr;
		?> 
		</tr>
		</tbody>

		<tbody id="additional_non_standard_gutter">
		<tr class="added-gutter-tr"> 
		<?php
			$tr = "";
			$tr .= "<td class=\"td-item\">".listItem("non standard guttering")." <input type=\"hidden\" class=\"price select\" value=\"0\" category=\"Gutters Non Standard\" />   </td>";
			$tr .= "<td><input type=\"button\" class=\"added_item\" value=\"Remove\" ></td>"; 
			$tr .= "<td>".listColours()."</td>";   
			$tr .= "<td class=\"td-finish-color\">".listColourBond(null,null,"Guttering")."</td>";  
			$tr .= "<td class=\"td-uom\">Mtrs  </td>";  
			$tr .= "<td class=\"td-qty\"><input type=\"text\" class=\"qtylen gutter-qty\" name=\"qty[]\" value=\"1\"></td>";  
			$tr .= "<td class=\"td-len\"><input type=\"text\" class=\"input-size gutter-length input-in\" name=\"slength[]\" value=\"".(METRIC_SYSTEM=="inch"?"12":"1")."\"  ></td>";  
			if(METRIC_SYSTEM=="inch"){
				$tr .= "<td class=\"td-ft\"><input type=\"text\"  class=\"input-ft gutter-length\" value=\"1\" ></td>";  
			}
			$tr .= "<td class=\"td-rrp\"><input type=\"text\" class=\"rrp\" readonly=\"readonly\"  name=\"rrp[]\" value=\"\"></td>";  
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
			$tr .= "<td class=\"td-item\">".listItem("guttering")." <input type=\"hidden\" class=\"price select\" value=\"0\"  category=\"Gutters Standard\" />   </td>";
			$tr .= "<td><input type=\"button\" class=\"added_item\" value=\"Remove\" ></td>"; 
			$tr .= "<td>".listColours()."</td>";   
			$tr .= "<td class=\"td-finish-color\">".listColourBond(null,null,"Guttering")."</td>";  
			$tr .= "<td class=\"td-uom\">Mtrs  </td>";  
			$tr .= "<td class=\"td-qty\"><input type=\"text\"  name=\"qty[]\" class=\"qtylen gutter-qty\" value=\"1\"></td>";  
			$tr .= "<td class=\"td-len\"><input type=\"text\"  name=\"slength[]\" class=\"input-size gutter-length input-in\" value=\"".(METRIC_SYSTEM=="inch"?"12":"1")."\"  ></td>";  
			if(METRIC_SYSTEM=="inch"){
				$tr .= "<td class=\"td-ft\"><input type=\"text\"  class=\"input-ft gutter-length\" value=\"1\" ></td>";  
			}
			$tr .= "<td class=\"td-rrp\"><input type=\"text\" name=\"rrp[]\" readonly=\"readonly\" class=\"rrp\" value=\"\"></td>";  
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
			$tr .= "<td class=\"td-item\">".listItem("flashing")." <input type=\"hidden\" class=\"price\" value=\"0\" category=\"flashing\" />   </td>";
			$tr .= "<td><input type=\"button\" class=\"added_item\" value=\"Remove\" ></td>"; 
			$tr .= "<td>".listColours()."</td>";   
			$tr .= "<td class=\"td-finish-color\">".listColourBond(null,null,"Guttering")."</td>";   
			$tr .= "<td class=\"td-uom\">Mtrs  </td>";  
			$tr .= "<td class=\"td-qty\"><input type=\"text\" class=\"qtylen\" name=\"qty[]\" value=\"1\"></td>";  
			$tr .= "<td class=\"td-len\"> <input type=\"text\"  name=\"slength[]\" class=\"input-in\" value=\"".(METRIC_SYSTEM=="inch"?"12":"1")."\" style=\"0\"> </td>";  
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

	

		<tbody id="additional_fixing">
		<tr class="added-fixing-tr"> 
		<?php
			$tr = "";
			$tr .= "<td class=\"td-item\">".listItem("fixings")." <input type=\"hidden\" class=\"price\" value=\"0\" category=\"misc\" />   </td>";
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
			$tr .= "<td class=\"td-item\">".listItem("downpipe")." <input type=\"hidden\" class=\"price\" value=\"0\" category=\"misc\" />   </td>";
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
			$tr .= "<td class=\"td-item\">".listItem("louvres")." <input type=\"hidden\" class=\"price\" value=\"0\" category=\"misc\" />   </td>";
			$tr .= "<td><input type=\"button\" class=\"added_item\" value=\"Remove\" ></td>"; 
			$tr .= "<td>{$colorSelection}</td>";   
			$tr .= "<td class=\"td-finish-color\">{$listColourBondSelection}</td>";  
			$tr .= "<td class=\"td-uom\">Mtrs <input type=\"hidden\" name=\"uom[]\" value=\"Mtrs\" \> </td>";  
			$tr .= "<td class=\"td-qty\"><input type=\"text\" class=\"qtylen added-louvres-qty\" name=\"qty[]\" value=\"\"></td>";  
			$tr .= "<td class=\"td-len\"> <input type=\"text\"  name=\"slength[]\" class=\"added-louvres-len\" value=\"\" > </td>";
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
			$tr .= "<td class=\"td-item\">  ".addItem("IRV59")." </td>";
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
			$tr .= "<td class=\"td-item\">".addItem("IRV60")."</td>";
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
			$tr .= "<td class=\"td-item\">".listItem("misc")." <input type=\"hidden\" class=\"price\" value=\"0\" category=\"misc\" />   </td>";
			$tr .= "<td><input type=\"button\" class=\"added_item\" value=\"Remove\" ></td>"; 
			$tr .= "<td> </td>";   
			$tr .= "<td> </td>";  
			$tr .= "<td class=\"td-uom\">Ea  </td>";  
			$tr .= "<td class=\"td-qty\"><input type=\"text\" class=\"qtylen\" name=\"qty[]\" value=\"1\"></td>";  
			$tr .= "<td class=\"td-len\"> <input type=\"text\"  name=\"slength[]\" class=\"\" value=\"".(METRIC_SYSTEM=="inch"?"12":"1")."\" style=\"display:none\"> </td>";  
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
			$tr .= "<td class=\"td-item\">".listItem("extras")." <input type=\"hidden\" class=\"price\" value=\"1\"  category=\"extra\" />   </td>";
			$tr .= "<td><input type=\"button\" class=\"added_item\" value=\"Remove\" ></td>"; 
			$tr .= "<td> </td>";   
			$tr .= "<td> </td>";  
			$tr .= "<td class=\"td-uom\">Ea  </td>";  
			$tr .= "<td class=\"td-qty\"><input type=\"text\" class=\"qtylen\" name=\"qty[]\" value=\"1\"></td>";
			$tr .= "<td class=\"td-len\"> <input type=\"text\"  name=\"slength[]\" class=\"\" value=\"".(METRIC_SYSTEM=="inch"?"12":"1")."\" style=\"display:none\"> </td>";
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
			$tr .= "<td class=\"td-item\">".listItem("disbursements")." <input type=\"hidden\" class=\"price\" value=\"0\" category=\"misc\" />   </td>";
			$tr .= "<td><input type=\"button\" class=\"added_item\" value=\"Remove\" ></td>"; 
			$tr .= "<td> </td>";   
			$tr .= "<td> </td>";  
			$tr .= "<td class=\"td-uom\">Ea <input type=\"hidden\" name=\"uom[]\" value=\"Ea\" \> </td>";  
			$tr .= "<td class=\"td-qty\"><input type=\"text\" class=\"qtylen\" name=\"qty[]\" value=\"1\"></td>";  
			$tr .= "<td class=\"td-len\"> <input type=\"text\"  name=\"slength[]\" class=\"length\" value=\"".(METRIC_SYSTEM=="inch"?"12":"1")."\" style=\"display:none\"> </td>";
			if(METRIC_SYSTEM=="inch"){
				$tr .= "<td class=\"td-ft\"><input type=\"text\"  class=\"input-ft\" value=\"1\" style=\"display:none\" ></td>";  
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

if($ref_page=="contracts"){
	  
?>
<br/><br/><br/>
<div class="" style="float:left; margin-top:2em; display:<?php echo (($is_system_admin || $is_construction_manager || $is_account_user)?'inline-block':'none'); ?>;" >		
	<!-- <button class="btn" name="close"> Close </button> &nbsp; -->
 	
 	<!-- -------------------  BUTTON NAVIGATION ----------------------------- -->
	<?php echo "<a href=\"".JURI::base()."contract-listing-vic/contract-folder-vic/contract-folder-vic?quoteid=".$quoteid."&projectid=".$projectid."\" class='btn '>&nbsp;&nbsp; Contract Details &nbsp;&nbsp;</a>&nbsp;"; ?>
	<?php echo "<a href=\"".JURI::base()."view-quote-vic?ref=back&quoteid=".$quoteid."&projectid=".$projectid."&ref_page=contracts\" class='btn ".($page_name=="quote_details"?"btn-disabled":"")."'>&nbsp;&nbsp; Quote Details &nbsp;&nbsp;</a>&nbsp;"; ?>
	<?php echo "<a href=\"".JURI::base()."contract-listing-vic/contract-folder-vic/contract-bom-vic?quoteid=".$quoteid."&projectid=".$projectid."\" class='btn '>&nbsp;&nbsp; BOM &nbsp;&nbsp;</a>&nbsp;"; ?>
	<?php echo "<a href=\"".JURI::base()."contract-listing-vic/contract-folder-vic/contract-po-vic?quoteid=".$quoteid."&projectid=".$projectid."&page_name=po\" class='btn '>&nbsp;&nbsp; PO &nbsp;&nbsp;</a>&nbsp;"; ?>
	<?php echo "<a href=\"".JURI::base()."contract-listing-vic/contract-folder-vic/contract-po-vic?quoteid=".$quoteid."&projectid=".$projectid."&page_name=po&view=summary\" class='btn '>&nbsp;&nbsp; PO Summary &nbsp;&nbsp;</a>&nbsp;"; ?>
	<?php echo "<a href=\"".JURI::base()."contract-listing-vic/contract-folder-vic/contract-folder-vic?quoteid=".$quoteid."&projectid=".$projectid."&tab=checklist\" class='btn '>&nbsp;&nbsp; Check List &nbsp;&nbsp;</a>&nbsp;"; ?> 
	<!-- -------------------  BUTTON NAVIGATION ----------------------------- -->  
</div> 
<?php } ?>

  
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
		//error_log("SELECT * FROM  {$inventory_table}  WHERE  LOWER(section) = '{$framework_type}' AND LOWER(category) = '{$category}'", 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_vic\\my-error.log');
		$tag .= "<select class=\"desclist\" name=\"desclist[]\" id=\"{$itemId}\">";
		while ($r = mysql_fetch_assoc($result)) {  
		    $tag .= "<option value=\"".$r['inventoryid']."\" price=\"".$r['rrp']."\" category=\"".$r['category']."\" ";
			if($r['inventoryid'] == $item["inventoryid"]) { $tag .= " selected"; } 
			$tag .= ">".$r['description'];
			$tag .= "</option>";
	        }	
		$tag .= "</select>"; 
		
	}else if($framework_type=="guttering"){
	 	
 		$result = mysql_query("SELECT * FROM  {$inventory_table}  WHERE  LOWER(section) = '{$framework_type}' AND category != 'Finish' " ); // 
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
	 	//error_log($sql, 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_vic\\my-error.log');
 		$result = mysql_query("SELECT * FROM  {$inventory_table}  WHERE  LOWER(section) = 'guttering' AND category = 'Gutters Non Standard' " ); // 
		$tag .= "<select class=\"desclist\" name=\"desclist[]\" id=\"{$itemId}\" >";
		while ($r = mysql_fetch_assoc($result)) {  
		    $tag .= "<option value=\"".$r['inventoryid']."\" price=\"".$r['rrp']."\" category=\"".$r['category']."\" ";
			 
			$tag .= ">".$r['description'];
			$tag .= "</option>";
	        }	
		$tag .= "</select>";  
		//error_log($tag, 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_vic\\my-error.log');
		
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
	 	
 		$result = mysql_query("SELECT * FROM  {$inventory_table}  WHERE LOWER(section) = 'frame' AND (category='Beams' OR category='Intermediate' OR category='Posts')   ORDER BY FIELD(category, 'Post Fixings','Post','Beam Fixings','Intermediate','Beams') DESC  " );
		$tag .= "<select class=\"desclist\" name=\"desclist[]\" id=\"{$itemId}\">";
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
			    $tag .= "<option value=\"".$r['inventoryid']."\" price=\"".$r['rrp']."\" category=\"".$r['category']."\"  "; 
				$tag .= ">".$r['description'];
				$tag .= "</option>";
	        }	
		$tag .= "</select>"; 
		
	 }else if($framework_type=="louvres" || $framework_type=="louvres"){
	 	
 		$result = mysql_query("SELECT * FROM {$inventory_table} WHERE section = 'Vergola' and category  = 'Louvers'" ); // 
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
			    $tag .= "<option value=\"".$r['inventoryid']."\" price=\"".$r['rrp']."\" category=\"".$r['category']."\" "; 
				$tag .= ">".$r['description'];
				$tag .= "</option>";
	        }	
		$tag .= "</select>"; 
		
	 }else if($framework_type=="extras"){
	 	
 		$result = mysql_query("SELECT * FROM  {$inventory_table}  WHERE LOWER(section) = 'extras' " ); // 
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
		
	 }     
	 

	return $tag; 

}

 

$querywebbing="SELECT cf_id, rrp, cost FROM {$inventory_table} WHERE section = 'Frame' and category  = 'Beams' and cf_id = '5'";
$resultweb = mysql_query($querywebbing);
if(!$resultweb){die ("Could not query the database: <br />" . mysql_error());}
 
function listWebbing($selected="",$item){
	global $inventory_table;
	$querywebbing="SELECT cf_id, rrp, cost FROM {$inventory_table} WHERE cf_id = '5'";
	$webbingItem = mysql_fetch_array(mysql_query($querywebbing));
	$sel1=""; $sel2="";
	//error_log("webbing sql :".$querywebbing, 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_vic\\my-error.log');
	//error_log("webbing Item :".print_r($item,true), 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_vic\\my-error.log');
	if(isset($item) && $item["webbing"]=="Yes"){
		$sel2="selected";
	}else{
		$sel1="selected";
	}
	
	$tr = "<select class=\"webbing-list\" name=\"webbing[]\" webrrp=\"".$webbingItem["rrp"]."\" >".
	          "<option value=\"No\" {$sel1} >No</option>".
	          "<option value=\"Yes\" {$sel2} >Yes</option>".
	     "</select>";
	 
  	//error_log(" tr-select(webbing) :".$tr, 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_vic\\my-error.log');
	return $tr;
}

 
function listWebbing2($selected="",$webbing=""){
	global $inventory_table;
	$querywebbing="SELECT cf_id, rrp, cost FROM {$inventory_table} WHERE cf_id = '5'";
	$webbingItem = mysql_fetch_array(mysql_query($querywebbing));
	$sel1=""; $sel2="";
	//error_log("webbing sql :".$querywebbing, 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_vic\\my-error.log');
	//error_log("webbing Item :".print_r($item,true), 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_vic\\my-error.log');
	if($webbing=="Yes"){
		$sel2="selected";
	}else{
		$sel1="selected";
	}
	
	$tr = "<select class=\"webbing-list\" name=\"webbing[]\" webrrp=\"".$webbingItem["rrp"]."\" >".
	          "<option value=\"No\" {$sel1} >No</option>".
	          "<option value=\"Yes\" {$sel2} >Yes</option>".
	     "</select>";
	 
  	//error_log(" tr-select(webbing) :".$tr, 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_vic\\my-error.log');
	return $tr;
}


function listColours($selected=null,$item=null,$class=""){  
	//$sqlcolour = "SELECT * FROM ver_chronoforms_data_colour_vic ORDER BY colour";
	//$resultcolour = mysql_query ($sqlcolour); 
	global $colours;

	//error_log("listColours ".$resultcolour, 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_vic\\my-error.log');
	//error_log("colours   :".print_r($colours,true), 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_vic\\my-error.log');
	$_r = "<select class=\"{$class} \" name=\"colour[]\" >";
	//while ($colour = mysql_fetch_assoc($resultcolour)){ 
	foreach($colours as &$c) 
	{
		$_r .= "<option value=\"{$c}\" ";
		//error_log($c .'<=>' . $item['colour'], 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_vic\\my-error.log');
		if ($c == $item['colour']) { $_r .= " selected ";} 
		else { 
			$_r .= "";
		}
		$_r .= ">{$c}</option>";
	}
	$_r .= "</select>";
	//error_log(" return-color-select: ".$_r, 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_vic\\my-error.log');
	return $_r;
}

function listColours2($selected=null,$color="",$class=""){  
	$sqlcolour = "SELECT * FROM ver_chronoforms_data_colour_vic ORDER BY colour";
	$resultcolour = mysql_query ($sqlcolour); 
	//global $colours;

	//error_log("listColours ".$resultcolour, 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_vic\\my-error.log');
	//error_log(" item :".print_r($item,true), 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_vic\\my-error.log');
	$_r = "<select class=\"{$class}\" name=\"colour[]\" >";
	while ($c = mysql_fetch_assoc($resultcolour)){ 
	//foreach($colours as &$c){
		$_r .= "<option value=\"{$c['colour']}\" ";
		//error_log($c .'<=>' . $item['colour'], 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_vic\\my-error.log');
		if ($c['colour'] == $color) { $_r .= " selected ";}  
		else { 
			$_r .= "";
		}
		$_r .= ">{$c['colour']}</option>";
	}
	$_r .= "</select>";
	//error_log(" return-color-select: ".$_r, 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_vic\\my-error.log');
	return $_r;
}

  

function listColourBond($selected=null,$item=null,$section = "Frame"){  
	
	global $inventory_table;
	$sql = "SELECT cf_id, rrp, cost, category, description FROM {$inventory_table} WHERE section = '{$section}' AND category = 'Finish' Order By description  ";	
	$paints = mysql_query ($sql);

	$r = "<select class=\"paint-list\"  name=\"finish[]\" >";
    while ($paint = mysql_fetch_array($paints)){
	  	$r .= "<option value=\"".$paint['description']."\" finishrrp=\"".$paint["rrp"]."\""; 
		if(strtolower($paint['description']) == strtolower($item['finish'])){ $r .= "selected ";
		} else { $r .= "";}
		$r .= ">".$paint['description']."</option>";
	}
	$r .= "</select>";

	//$r .= "<input type=\"hidden\" class=\"paintdesc\" name=\"paint[]\" value=\"".$item['category']."\" readonly=\"readonly\" />".
    // "<input type=\"hidden\" class=\"paintrrp\" name=\"paintrrp[]\" value=\"".$item['rrp']."\" readonly=\"readonly\" />".
     //"<input type=\"hidden\" class=\"paintcost\" name=\"paintcost[]\" value=\"".$item['cost']."\" readonly=\"readonly\" />";

	return $r;

}

function listColourBond2($selected=null,$finish="",$section = "Frame"){  
	
	global $inventory_table;
	$sql = "SELECT cf_id, rrp, cost, category, description FROM {$inventory_table} WHERE section = '{$section}' AND category = 'Finish' Order By description  ";	
	$paints = mysql_query ($sql);

	$r = "<select class=\"paint-list\"  name=\"finish[]\" >";
    while ($paint = mysql_fetch_array($paints)){
	  	$r .= "<option value=\"".$paint['description']."\" finishrrp=\"".$paint["rrp"]."\""; 
		if(strtolower($paint['description']) == $finish){ $r .= "selected ";
		} else { $r .= "";}
		$r .= ">".$paint['description']."</option>";
	}
	$r .= "</select>";

	//$r .= "<input type=\"hidden\" class=\"paintdesc\" name=\"paint[]\" value=\"".$item['category']."\" readonly=\"readonly\" />".
    // "<input type=\"hidden\" class=\"paintrrp\" name=\"paintrrp[]\" value=\"".$item['rrp']."\" readonly=\"readonly\" />".
     //"<input type=\"hidden\" class=\"paintcost\" name=\"paintcost[]\" value=\"".$item['cost']."\" readonly=\"readonly\" />";

	return $r;

}
 

// function listColourBond2($selected=null,$item,$section="Frame"){  
// 	global $inventory_table;
// 	//error_log("Inside listColourBond2 :".print_r($item,true), 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_vic\\my-error.log');
// 	$sql = "SELECT cf_id, rrp, cost, category, description FROM {$inventory_table} WHERE section = '{$section}' AND category = 'Finish' ";	
// 	$paints = mysql_query ($sql);

// 	$r = "<select class=\"paint-list\"  name=\"finish[]\" >";  
//     while ($paint = mysql_fetch_array($paints)){
//     	//if($item["inventoryid"]=="IRV55")
//     		//error_log("invID: ".$item['finish']."list color :".$paint['description']." item color: ".$item['finish'], 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_vic\\my-error.log');
//     	//error_log(print_r($item,true), 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_vic\\my-error.log');
// 	  	$r .= "<option value=\"".$paint['description']."\"  finishrrp=\"".$paint["rrp"]."\""; 
// 		if(strtolower($paint['description']) == strtolower($item['finish'])){ $r .= "selected=\"selected\"";
// 		} else { $r .= "";}
// 		$r .= ">".$paint['description']."</option>";	
// 	}
// 	$r .= "</select>";

// 	return $r;

// }



function get_feet_value($inches){
	return floor($inches / 12)."&rsquo;" . floor($inches % 12);     
}

function get_feet_whole($inches){
	return floor($inches / 12);
     
}

function get_feet_inch($inches){
	return floor($inches % 12);
     
}

function get_inch_to_meter($inches){
	return number_format($inches * 0.0254,2);
     
}
 


function generateHtmlReport($projectid,$title){ 
	global $inventory_table;
	global $sql_dformat;
	// $projectid = mysql_real_escape_string($_REQUEST['projectid']);
	// $title = mysql_real_escape_string($_REQUEST['title']);
	 
	$sql = "SELECT *,DATE_FORMAT(quotedate,'{$sql_dformat}') fquotedate FROM ver_chronoforms_data_followup_vic AS f JOIN ver_chronoforms_data_clientpersonal_vic AS c ON c.clientid=f.quoteid   WHERE  f.projectid = '".$projectid."' ";
	error_log($sql, 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_vic\\my-error.log');
	$proj = mysql_query($sql);
	$project = mysql_fetch_array($proj); 
	//error_log(print_r($contract,true), 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_vic\\my-error.log');exit();

	$sql = "SELECT * FROM ver_chronoforms_data_quote_vic  WHERE  projectid = '".$projectid."' ";
	//error_log($sql, 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_vic\\my-error.log');
	$quoteResult = mysql_query($sql);
	$quoteInfo = mysql_fetch_array($quoteResult);  

	$VergolaType = $quoteInfo['framework'];
	$client_id = $project['quoteid'];
	$project_id = $project['projectid'];

	$dimension = "";
	$resultm = mysql_query("SELECT * FROM ver_chronoforms_data_measurement_vic WHERE projectid  = '$projectid'");
	//error_log("SELECT * FROM ver_chronoforms_data_measurement_vic WHERE projectid  = '$projectid'", 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_vic\\my-error.log');
	if (!$resultm) {die("Error: Data not found..");}

	$numBay = 0; 
	$ReLen = null;
	$ReWid = null;
	$_ReWid = null;

	//error_log("vergola type : ".$VergolaType, 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_vic\\my-error.log');
	if($VergolaType == "Double Bay" || $VergolaType == "Double Bay - Drop-In" || $VergolaType == "Double Bay VR2" || $VergolaType == "Double Bay VR3" || $VergolaType == "Double Bay VR3 - Gutter" || $VergolaType == "Double Bay VR2 - Drop-In" || $VergolaType == "Double Bay VR3 - Drop-In" || $VergolaType == "Double Bay VR3 - Gutter - Drop-In" || $VergolaType == "Three Bay VR4 - Drop-In" || $VergolaType == "Three Bay VR4 - Gutter - Drop-In" || $VergolaType == "Four Bay VR6 - Drop-In" || $VergolaType == "Four Bay VR6 - Gutter - Drop-In"  ){
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
		error_log("AM HERE 1!", 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_vic\\my-error.log'); 
		error_log(" L1: ".$ReLen[0]. " L2: ".$ReLen[1]. " L3: ".$ReLen[2]. " L4: ".$ReLen[3]." W:".$_ReWid, 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_vic\\my-error.log');	
	}else{
		$retrievem = mysql_fetch_array($resultm);
		if(METRIC_SYSTEM=="meter"){
			$ReLen = $retrievem['length'];
			$ReWid = $retrievem['width'];
		}else{
			$ReLen = html_entity_decode(get_feet_value($retrievem['length']));
			$ReWid = html_entity_decode(get_feet_value($retrievem['width']));
			//error_log("ReLen: ".html_entity_decode($ReLen), 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_vic\\my-error.log'); 
			//error_log("ReWid: ".html_entity_decode($ReWid), 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_vic\\my-error.log'); 
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
		<td colspan=\"2\">".($project['is_builder']=="1"?addslashes($project['builder_name']):addslashes($project['client_firstname']).' '.addslashes($project['client_lastname']))."</td>
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
	
	$item_result = mysql_query ($sql);

	
	$html .= "<tr> <th colspan=\"8\" style=\"text-align:left;\" border=\"1\">&nbsp;<b>Framework</b></th> </tr>"; 
	while ($row = mysql_fetch_assoc($item_result)){  
			if($row['qty']>0){	
				$html .= "<tr>
					<td>".addslashes($row['description'])."</td> 
					<td>{$row['webbing']}</td>
					<td>{$row['colour']}</td>
					<td>{$row['finish']}</td>
					<td>{$row['uom']}</td>  
					<td style=\"text-align:right;\">{$row['qty']}</td>
					<td style=\"text-align:right;\">";

					if(METRIC_SYSTEM=="meter"){
						$html .= ($row['uom']=="Mtrs"?$row['length']:"");
					}else{ 
						$html .= ($row['uom']=="Mtrs"?addslashes(get_feet_value($row['length'])):"");
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

	//error_log($sql, 3,\"C:\\xampp\htdocs\\vergola_contract_system_v4_vic\\my-error.log\"); 
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

//error_log($html, 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_vic\\my-error.log'); 	
return $html;
//I will convert every ' in html to \" to properly save in msyql string.

}








?>

