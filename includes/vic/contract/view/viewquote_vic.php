<?php
$cust_id =$_REQUEST['quoteid'];
$ProjectID = $_REQUEST['projectid'];
$BeamIDArrayPhp = '';
$BeamDESCArrayPhp = '';
$BeamRRPArrayPhp = '';
$BeamCOSTArrayPhp = '';
$BeamUOMArrayPhp = '';


$resultff = mysql_query("SELECT * FROM ver_chronoforms_data_followup_vic WHERE projectid  = '$ProjectID'");
$retrieveff = mysql_fetch_array($resultff);
if (!$resultff) {die("Error: Data not found..");}
	$ProjectName = $retrieveff['project_name'] ;
	$QuoteDate = $retrieveff['quotedate'] ;
	$RetrieveDate = date('d-M-Y',strtotime($QuoteDate));
	$Framework = $retrieveff['framework_type'] ;
	$QuoteID = $retrieveff['quoteid'] ;
	//echo $QuoteID;
	$QuoteIDAlpha = substr($QuoteID, 0, 3);
	//echo $QuoteIDAlpha;
	$QuoteIDNum = substr($QuoteID, 3);
	//echo $QuoteIDNum;
	$RetSubVergola = $retrieveff['subtotal_vergola'] ;
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

	
$resultq = mysql_query("SELECT * FROM ver_chronoforms_data_quote_vic WHERE projectid  = '$ProjectID'");
$retrieveq = mysql_fetch_array($resultq);
if (!$resultq) {die("Error: Data not found..");}
	$VergolaType = $retrieveq['framework'] ;	

$resultqarr = mysql_query("SELECT inventoryid, colour, qty, length, webbing, finish, rrp, cost, description, uom, cf_id FROM ver_chronoforms_data_quote_vic WHERE projectid  = '$ProjectID'");
if (!$resultqarr) {die("Error: Data not found..");}

$inventid ="0";
$colourid ="0";
$qtyid ="0";
$lengthid ="0";
$webbingid = "0";
$finishid ="0";	
$rrpid ="0";
$costid ="0";
$descid ="0";
$uomid = "0";
$cfid = "0";
$i = 0;


	while ($col = mysql_fetch_row($resultqarr)): 
	$getID[$inventid++] = substr($col[0],3);
	$getColour[$colourid++] = $col[1];
	$getQty[$qtyid++] = floor($col[2]);
	$getLength[$lengthid++] = $col[3];
	$getWeb[$webbingid++] = $col[4];
	$getFinish[$finishid++] = $col[5];
	$getRRP[$rrpid++] = $col[6];
	$getCost[$costid++] = $col[7];
	$getDesc[$descid++] = $col[8];
	$getUOM[$uomid++] = $col[9];
	$getCFID[$cfid++] = $col[10];
	
	
	endwhile; 
	

$resultm = mysql_query("SELECT * FROM ver_chronoforms_data_measurement_vic WHERE projectid  = '$ProjectID'");
 
$numBay = 0;
$ReLen = null;
$ReWid = null;
$_ReWid = null;

if($VergolaType == "Double Bay" || $VergolaType == "Double Bay - Drop-In" || $VergolaType == "Double Bay VR2" || $VergolaType == "Double Bay VR3" || $VergolaType == "Double Bay VR3 - Gutter" || $VergolaType == "Double Bay VR2 - Drop-In" || $VergolaType == "Double Bay VR3 - Drop-In" || $VergolaType == "Double Bay VR3 - Gutter - Drop-In"  ){
	 
if (!$resultm) {die("Error: Data not found..");}

	$k=0; $ReLen[] = null;
	while ($retrievem = mysql_fetch_array($resultm)){
		$ReLen[$k] = $retrievem['length'];
		$_ReWid = $retrievem['width'];
		
		//error_log("DOUBLE BAY ReLen[{$k}]: {$ReLen[$k]} ", 3,'C:\\xampp\htdocs\\vergola_contract_system_v3\\my-error.log');
		$k++;
	}	

	//error_log("AM HERE 1!", 3,'C:\\xampp\htdocs\\vergola_contract_system_v3\\my-error.log'); 
	//error_log("L1: ".$ReLen[0]. " L2: ".$ReLen[1]." W:".$_ReWid, 3,'C:\\xampp\htdocs\\vergola_contract_system_v3\\my-error.log');	
}else{
	$retrievem = mysql_fetch_array($resultm);
	if (!$resultm) {die("Error: Data not found..");}

	$ReLen = $retrievem['length'];
	$ReWid = $retrievem['width'];
	$ReBay 	 = $retrievem['bay'];
	//error_log("ReLen:".$ReLen.", ReWid:".$ReWid.", ReBay:".$ReBay, 3,'C:\\xampp\htdocs\\vergola_contract_system_v3\\my-error.log');	
}



$resultcolours = mysql_query("SELECT cf_id, colour FROM ver_chronoforms_data_colour_vic ORDER BY colour" );
$resultpp = mysql_query("SELECT cf_id, rrp, cost, category FROM ver_chronoforms_data_inventory_vic WHERE section = 'Frame' and  cf_id  = '13' or cf_id = '14' or section ='Guttering' and cf_id = '41' or cf_id = '42'" );	

$resultpost = mysql_query("SELECT cf_id, inventoryid, description, uom, rrp, cost FROM ver_chronoforms_data_inventory_vic WHERE section = 'Frame' and category  = 'Posts'");

$resultfix = mysql_query("SELECT cf_id, inventoryid, description, uom, rrp, cost FROM ver_chronoforms_data_inventory_vic WHERE section = 'Fixings'" );

$resultflash = mysql_query("SELECT cf_id, inventoryid, description, uom, rrp, cost FROM ver_chronoforms_data_inventory_vic WHERE section = 'Flashings'" );

$resultpipe = mysql_query("SELECT cf_id, inventoryid, description, uom, rrp, cost FROM ver_chronoforms_data_inventory_vic WHERE section = 'Downpipe'" );

$resultlouv = mysql_query("SELECT cf_id, inventoryid, description, uom, rrp, cost FROM ver_chronoforms_data_inventory_vic WHERE section = 'Vergola' and category  = 'Louvers'" );

$resultstdgutter = mysql_query("SELECT cf_id, inventoryid, description, uom, rrp, cost FROM ver_chronoforms_data_inventory_vic WHERE section = 'Guttering' and category  = 'Gutters Standard'");

$resultnonstdgutter = mysql_query("SELECT cf_id, inventoryid, description, uom, rrp, cost FROM ver_chronoforms_data_inventory_vic WHERE section = 'Guttering' and category  = 'Gutters Non Standard'");

$resultvergola = mysql_query("SELECT cf_id, inventoryid, description, uom, rrp, cost FROM ver_chronoforms_data_inventory_vic WHERE section = 'Vergola'" );

$resultmisc = mysql_query("SELECT cf_id, inventoryid, description, uom, rrp, cost FROM ver_chronoforms_data_inventory_vic WHERE section = 'Misc'");
$resultextras = mysql_query("SELECT cf_id, inventoryid, description, uom, rrp, cost FROM ver_chronoforms_data_inventory_vic WHERE section = 'Extras'");

$resultdisb = mysql_query("SELECT cf_id, inventoryid, description, uom, rrp, cost FROM ver_chronoforms_data_inventory_vic WHERE section = 'Disbursements'" );

?>

<link rel="stylesheet" type="text/css" media="screen,projection" href="<?php echo JURI::base().'jscript/new-enquiry.css'; ?>" />
<link rel="stylesheet" type="text/css" media="screen,projection" href="<?php echo JURI::base().'jscript/client-folder.css'; ?>" />
<script src="<?php echo JURI::base().'jscript/jquery.min.js'; ?>"></script>
<script src="<?php echo JURI::base().'jscript/add-item.js'; ?>"></script>

<?php if ($RetStatus == 'Won') {echo "<style>#project #update, #project #save-close, #downbtn #update-down, #downbtn #save-close-down {background-color:#ccc;color:#eee;border:1px solid #ddd}input[type=\"button\"] {display:none;} input.save-btn {display:inline-block;}</style>";} ?>

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
</script>
<script>
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
			   
			   			   
	           <?php  if ($Framework == 'Framework') {  ?>
			   <?php if ($VergolaType == 'Single Bay' || $VergolaType == 'Single Bay VR1') { 

				    if($VergolaType == 'Single Bay VR1'){  
				    ?>	
						$('#output').html('<?php require dirname(__FILE__)."/../../quote/view/view_singlebay_vic_vr1.php"; ?>'); // update the DIV
						$.when($.getScript('<?php echo JURI::base().'jscript/singlebay_vr1.js'; ?>')).done(function() {
							console.log('done singlebay_vic_vr1');
						});
					<?php }else{ ?>
					
				           $('#output').html('<?php require "singlebayview_vic.php"; ?>'); // update the DIV
						   $('#cbeam').html('<?php include "singlebay/cbeam_vic.php"; ?>'); // update the DIV
						   $('#post').html('<?php include "singlebay/post_vic.php"; ?>'); // update the DIV
						   $('#fixing').html('<?php include "singlebay/fixing_vic.php"; ?>'); // update the DIV
						   $('#standardgutter').html('<?php include "singlebay/standardgutter_vic.php"; ?>'); // update the DIV
						   $('#nonstandardgutter').html('<?php include "singlebay/nonstandardgutter_vic.php"; ?>'); // update the DIV
						   $('#addgutter').html('<?php include "singlebay/addgutter_vic.php"; ?>'); // update the DIV
						   $('#flashing').html('<?php include "singlebay/flashing_vic.php"; ?>'); // update the DIV
						   $('#downpipe').html('<?php include "singlebay/downpipe_vic.php"; ?>'); // update the DIV
						   $('#vergola').html('<?php include "singlebay/vergola_vic.php"; ?>'); // update the DIV
						   $('#misc').html('<?php include "singlebay/misc_vic.php"; ?>'); // update the DIV
						   $('#extras').html('<?php include "singlebay/addextras_vic.php"; ?>'); // update the DIV
						   $('#disbursement').html('<?php include "singlebay/disbursement_vic.php"; ?>'); // update the DIV
						   
						   $.when($.getScript('<?php echo JURI::base().'jscript/singlebay.js'; ?>')).done(function() {
			  					console.log('done');
							});	
							<?php if ($RetStatus == 'Won') {?>
							$.when($.getScript('<?php echo JURI::base().'jscript/disabled.js'; ?>')).done(function() {
			  					console.log('done');
							});
							<?php }?>
							
							$.when($.getScript('<?php echo JURI::base().'jscript/variable-id.js'; ?>')).done(function() {
			  					console.log('done');
							});	
					<?php	} ?>
			
				<?php }  elseif ($VergolaType == 'Double Bay VR2' || $VergolaType == 'Double Bay VR3'  || $VergolaType == 'Double Bay VR3 - Gutter') {?>

					$('#output').html('<?php require dirname(__FILE__)."/../../quote/view/view_doublebay_vic_vr2.php"; ?>'); // update the DIV
						$.when($.getScript('<?php echo JURI::base().'jscript/doublebay_vr2.js'; ?>')).done(function() {
							console.log('done double_vic_vr2');
						}); 

				<?php }  elseif ($VergolaType == 'Gable') {?>
				 $('#output').html('<?php require "gable_vic.php"; ?>'); // update the DIV
			   $('#cbeam').html('<?php include "gable/cbeam_vic.php"; ?>'); // update the DIV
			   $('#post').html('<?php include "gable/post_vic.php"; ?>'); // update the DIV
			   $('#fixing').html('<?php include "gable/fixing_vic.php"; ?>'); // update the DIV
			   $('#standardgutter').html('<?php include "gable/standardgutter_vic.php"; ?>'); // update the DIV
			   $('#nonstandardgutter').html('<?php include "gable/nonstandardgutter_vic.php"; ?>'); // update the DIV
			   $('#addgutter').html('<?php include "gable/addgutter_vic.php"; ?>'); // update the DIV
			   $('#flashing').html('<?php include "gable/flashing_vic.php"; ?>'); // update the DIV
			   $('#downpipe').html('<?php include "gable/downpipe_vic.php"; ?>'); // update the DIV
			   $('#vergola').html('<?php include "gable/vergola_vic.php"; ?>'); // update the DIV
			   $('#misc').html('<?php include "gable/misc_vic.php"; ?>'); // update the DIV
			   $('#extras').html('<?php include "gable/addextras_vic.php"; ?>'); // update the DIV
			   $('#disbursement').html('<?php include "gable/disbursement_vic.php"; ?>'); // update the DIV
			   
			   $.when($.getScript('<?php echo JURI::base().'jscript/singlebay.js'; ?>')).done(function() {
  					console.log('done');
				});	
				<?php if ($RetStatus == 'Won') {?>
				$.when($.getScript('<?php echo JURI::base().'jscript/disabled.js'; ?>')).done(function() {
  					console.log('done');
				});
				<?php }?>
				
				$.when($.getScript('<?php echo JURI::base().'jscript/variable-id.js'; ?>')).done(function() {
  					console.log('done');
				});	
				<?php }  elseif ($VergolaType == 'Angle') {?>
				  $('#output').html('<?php require "angle_vic.php"; ?>'); // update the DIV
			   $('#cbeam').html('<?php include "angle/cbeam_vic.php"; ?>'); // update the DIV
			   $('#post').html('<?php include "angle/post_vic.php"; ?>'); // update the DIV
			   $('#fixing').html('<?php include "angle/fixing_vic.php"; ?>'); // update the DIV
			   $('#standardgutter').html('<?php include "angle/standardgutter_vic.php"; ?>'); // update the DIV
			   $('#nonstandardgutter').html('<?php include "angle/nonstandardgutter_vic.php"; ?>'); // update the DIV
			   $('#addgutter').html('<?php include "angle/addgutter_vic.php"; ?>'); // update the DIV
			   $('#flashing').html('<?php include "angle/flashing_vic.php"; ?>'); // update the DIV
			   $('#downpipe').html('<?php include "angle/downpipe_vic.php"; ?>'); // update the DIV
			   $('#vergola').html('<?php include "angle/vergola_vic.php"; ?>'); // update the DIV
			   $('#misc').html('<?php include "angle/misc_vic.php"; ?>'); // update the DIV
			   $('#extras').html('<?php include "angle/addextras_vic.php"; ?>'); // update the DIV
			   $('#disbursement').html('<?php include "angle/disbursement_vic.php"; ?>'); // update the DIV
			   
			   $.when($.getScript('<?php echo JURI::base().'jscript/singlebay.js'; ?>')).done(function() {
  					console.log('done');
				});	
				<?php if ($RetStatus == 'Won') {?>
				$.when($.getScript('<?php echo JURI::base().'jscript/disabled.js'; ?>')).done(function() {
  					console.log('done');
				});
				<?php }?>
				
				$.when($.getScript('<?php echo JURI::base().'jscript/variable-id.js'; ?>')).done(function() {
  					console.log('done');
				});	
				<?php }  else {?>
				 $('#output').html('<?php echo "Nothing"; ?>'); // update the DIV
				<?php } ?>
				
				
				<?php } else { ?>
				$('#output').html('<?php require "dropin_vic.php"; ?>'); // update the DIV
			   $('#standardgutter').html('<?php include "dropin/standardgutter_vic.php"; ?>'); // update the DIV
			   $('#nonstandardgutter').html('<?php include "dropin/nonstandardgutter_vic.php"; ?>'); // update the DIV
			   $('#addgutter').html('<?php include "dropin/addgutter_vic.php"; ?>'); // update the DIV
			   $('#flashing').html('<?php include "dropin/flashing_vic.php"; ?>'); // update the DIV
			   $('#downpipe').html('<?php include "dropin/downpipe_vic.php"; ?>'); // update the DIV
			   $('#vergola').html('<?php include "dropin/vergola_vic.php"; ?>'); // update the DIV
			   $('#misc').html('<?php include "dropin/misc_vic.php"; ?>'); // update the DIV
			   $('#extras').html('<?php include "dropin/addextras_vic.php"; ?>'); // update the DIV
			   $('#disbursement').html('<?php include "dropin/disbursement_vic.php"; ?>'); // update the DIV
			   
			   $.when($.getScript('<?php echo JURI::base().'jscript/dropin.js'; ?>')).done(function() {
  					console.log('done');
				});	
				<?php if ($RetStatus == 'Won') {?>
				$.when($.getScript('<?php echo JURI::base().'jscript/disabled.js'; ?>')).done(function() {
  					console.log('done');
				});
				<?php }?>
				
				$.when($.getScript('<?php echo JURI::base().'jscript/variable-id-dropin.js'; ?>')).done(function() {
  					console.log('done');
				});	
			   
				<?php } ?>
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

<form method="post" class="show-form show-form-disable">
<div id="project"><span class="quoteinfo"><label>Date Entered</label><input type="text" value="<?php echo $RetrieveDate; ?>" name="quotedate" class="quotedate"  readonly="readonly" /></span>
<span class="quoteinfo"><label>Project Name</label><input type="text" value="<?php echo $ProjectName; ?>" name="projectsite" id="projectsite" autofocus /></span>

<span class="quoteinfo"><label>Framework Type</label><input type="text" id="frameworktype" name="frameworktype" value="<?php echo $Framework; ?>" readonly/>
</span>
<div id="frameset">
<?php if ($Framework == 'Framework') { ?>
<span class="quoteinfo"><label>Type Of Vergola</label><input type="text" id="framework" name="framework"  value="<?php echo $VergolaType; ?>"  readonly="readonly"/>
</span>
<?php }  else { echo "";} ?>

<?php if($VergolaType == 'Single Bay' || $VergolaType == 'Single Bay VR1' || $VergolaType == 'Gable' || $VergolaType == 'Angle') {

 ?>
<span id="length" class="quoteinfo"><label>Length</label><input type="text" value="<?php echo $ReLen; ?>" name="length" id=" " /></span>
<span id="width" class="quoteinfo"><label>Width</label><input type="text" value="<?php echo $ReWid; ?>" name="width" id=" " /></span>
<?php }else if($VergolaType == 'Double Bay VR2' || $VergolaType == 'Double Bay VR3'  || $VergolaType == 'Double Bay VR3 - Gutter'){ 
//error_log("ReLen[0]:".$ReLen[0].", ReLen[1]:".$ReLen[1].", _ReWid:".$_ReWid, 3,'C:\\xampp\htdocs\\vergola_contract_system_v3\\my-error.log');	
	?>
 	      
<span class="quoteinfo"><label>Length 1</label><input type="text" value="<?php echo $ReLen[0]; ?>" name="length" id="dblengthid1" /></span>
<span  class="quoteinfo"><label>Length 2</label><input type="text" value="<?php echo $ReLen[1]; ?>" name="length" id="dblengthid2" /></span>
<span   class="quoteinfo"><label>Width</label><input type="text" value="<?php echo $_ReWid; ?>" name="dbwidth[]" id="dbwidthid1" class="_width"/></span>
 
<?php } ?>
<span id="bay" class="quoteinfo" style="display:none;"><label>Bay</label><input type="text" value="" name="bay" id="bayid" /></span>
</div>
<input type="submit" class="save-btn" value="Save" name="update" id="update" />
<input type="submit" class="save-btn" value="Save & Close" name="save-close" id="save-close" />
<input type="button" class="save-btn" value="Cancel" name="cancel" id="cancel" onClick="location.href='<?php echo JURI::base(). "contract-listing-vic/contract-folder-vic?quoteid=".$cust_id."&projectid=".$ProjectID; ?>'" />
<input type="hidden" name="projectid" id="projectid" value="<?php echo $ProjectID; ?>" />
</div>
<div id="output"></div>
<div id="projectcomm" style="padding-top:30px;">
<span id="gst"><label>GST %</label><input type="text" value="<?php echo $RetGST; ?>" name="gst" id="gstid" /></span><br />
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
<div id="downbtn"><input type="submit" class="save-btn" value="Save" name="update" id="update-down" />
<input type="submit" class="save-btn" value="Save & Close" name="save-close" id="save-close-down" />
<input type="button" class="save-btn" value="Cancel" name="cancel" id="cancel-down" onClick="location.href='<?php echo JURI::base(). "contract-listing-vic/contract-folder-vic?quoteid=".$cust_id."&projectid=".$ProjectID; ?>'" />
</div>
</form>
