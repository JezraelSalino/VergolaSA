<?php 
if ($projectid != '') {
	//error_log(" 1st..", 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_sa\\my-error.log');
	// Get Contract List
	//error_log("projectid inside: ".$projectid, 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_sa\\my-error.log'); 
	$resultdetails = mysql_query("SELECT * FROM ver_chronoforms_data_contract_list_vic WHERE projectid = '$projectid' ORDER BY quotedate DESC");
	$retrievedetails = mysql_fetch_array($resultdetails);
	if (!$resultdetails) {die("Error: Data not found..");} 
	$ListProjName = $retrievedetails['project_name'];
	$ListProjectID = $retrievedetails['projectid'];
	//$ListContractValue = $retrievedetails['total_rrp'];
	$ListContractValue = $retrievedetails['total_cost'];  
	$ListSalesValue = $retrievedetails['sales_comm_cost']; 
	$ListErectorsValue = $retrievedetails['install_comm_cost']; 

	// Get Travel Cost
	$resulttravel = mysql_query("SELECT * FROM ver_chronoforms_data_contract_items_vic WHERE quoteid = '$cust_id' and projectid = '$projectid' and inventoryid = 'IRV91'");
	$retrievetravel = mysql_fetch_array($resulttravel);
	if (!$resulttravel) {die("Error: Data not found..");}
	$Travel = $retrievetravel['rrp'];

	// Get Labour Cost
	$sql = "SELECT * FROM ver_chronoforms_data_contract_items_vic WHERE quoteid = '$cust_id' and projectid = '$projectid' and inventoryid = 'IRV89'";
	$resultlabour = mysql_query($sql);
	//error_log("projectid inside: ".$sql, 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_sa\\my-error.log'); 
	$retrievelabour = mysql_fetch_array($resultlabour);
	if (!$resultlabour) {die("Error: Data not found..");}
	$Labour = $retrievelabour['rrp'];

	// Get Accommodation Cost
	$sql = "SELECT * FROM ver_chronoforms_data_contract_items_vic WHERE quoteid = '$cust_id' and projectid = '$projectid' and inventoryid = 'IRV92'";
	$resultaccommodation = mysql_query($sql);
	
	$retrieveaccommodation = mysql_fetch_array($resultaccommodation);
	if (!$resultaccommodation) {die("Error: Data not found..");}
	$Accommodation = $retrieveaccommodation['rrp'];

	// Get Contract Vergola
	$resultvergola = mysql_query("SELECT * FROM ver_chronoforms_data_contract_vergola_vic WHERE quoteid = '$cust_id' and projectid = '$projectid' ORDER BY quotedate DESC");
	$retrievevergola = mysql_fetch_array($resultvergola);
	if (!$resultvergola) {die("Error: Data not found..");}

	$CheckMeasurer = $retrievevergola['check_measurer'];
	$CheckDate = $retrievevergola['check_measure_date'];
	$ReCheckDate = $retrievevergola['recheck_measure_date'];
	$DrawingDate = $retrievevergola['drawing_prepare_date'];
	$DrawingApprove = $retrievevergola['drawing_approve_date'];
		
	$ProductionStart = $retrievevergola['production_start_date'];	
	$ProductionComplete = $retrievevergola['production_complete_date'];
	$ClientNotified = $retrievevergola['client_notified_date'];
	$Erectors = $retrievevergola['erectors_name'];
	$ErectorNotified = $retrievevergola['erector_notified_date'];
	$WarrantyStart = $retrievevergola['warranty_start_date'];
	$WarrantyEnd = $retrievevergola['warranty_end_date'];

	$JobStart = $retrievevergola['job_start_date'];
	$JobEnd = $retrievevergola['job_end_date'];

	// Get Contract Statutory
	$resultstatutory = mysql_query("SELECT * FROM ver_chronoforms_data_contract_statutory_vic WHERE  projectid = '$projectid' ORDER BY quotedate DESC"); //quoteid = '$cust_id' and
	$retrievestatutory = mysql_fetch_array($resultstatutory);
	if (!$resultstatutory) {die("Error: Data not found..");}
	$Council = $retrievestatutory['council'];
	$PlanningDate = $retrievestatutory['planning_application_date'];
	$PlanningApproval = $retrievestatutory['planning_approval_date'];
	$WarrantyInsurance = $retrievestatutory['warranty_insurance_date'];
	$Certifier = $retrievestatutory['certifier_date'];
	$Development = $retrievestatutory['dev_approval_date'];


	// Get Contract Details
	$resultdate = mysql_query("SELECT * FROM ver_chronoforms_data_contract_details_vic WHERE projectid = '$projectid' ORDER BY quotedate DESC"); //quoteid = '$cust_id' and 
	$retrievedata = mysql_fetch_array($resultdate);
	if (!$resultdate) {die("Error: Data not found..");}
	$DepositDate = $retrievedata['deposit_paid'];
	$ProgressClaim = $retrievedata['progress_claim'];
	$FinalPayment = $retrievedata['final_payment'];
	$variation_amount = $retrievedata['variation_amount'];
	$variation_date = $retrievedata['variation_date'];  

	$deposit_paid_amount = $retrievedata['deposit_paid_amount'];
	$progress_claim_amount = $retrievedata['progress_claim_amount'];
	$final_payment_amount = $retrievedata['final_payment_amount'];

	//get which quote id was won in this contract.
	//error_log(print_r($retrievedata,true), 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_sa\\my-error.log');    
	$quote_projectid = "";

	//error_log("SELECT * FROM ver_chronoforms_data_contract_details_vic WHERE projectid = '$projectid' ORDER BY quotedate DESC", 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_sa\\my-error.log'); 
	if(substr($projectid, 0,3)!="PRV"){ //substr($projectid, 0,3)=="VIC" || substr($projectid, 0,3)=="QID" || substr($projectid, 0,4)=="QIDV"
		
		if(empty($retrievedetails['project_name'])){
			$sql = "SELECT * FROM ver_chronoforms_data_followup_vic WHERE quoteid = '{$retrievedetails['quoteid']}' ORDER BY cf_id DESC LIMIT 1 ";
			//error_log($sql, 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_sa\\my-error.log'); 
			$qQuote = mysql_query($sql); 
			$_quote = mysql_fetch_array($qQuote); 

		}
		else{
			$sql = "SELECT * FROM ver_chronoforms_data_followup_vic WHERE project_name = '{$retrievedetails['project_name']}' ";
			//error_log($sql, 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_sa\\my-error.log');
			$qQuote = mysql_query($sql); 
			$_quote = mysql_fetch_array($qQuote); 
		}

		$quote_projectid = $_quote['projectid'];
		//$projectid = $_quote['projectid'];
	}

	//error_log($projectid, 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_sa\\my-error.log');


}	   
// else { 
// 	//error_log(" 2nd..", 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_sa\\my-error.log');
// 	// Get Contract List
// 	$resultdetails = mysql_query("SELECT * FROM ver_chronoforms_data_contract_list_vic WHERE quoteid = '$cust_id' and projectid = '$projectid' ORDER BY quotedate DESC");
// 	$retrievedetails = mysql_fetch_array($resultdetails);
// 	if (!$resultdetails) {die("Error: Data not found..");} 
// 	$ListProjName = $retrievedetails['project_name'];
// 	$ListProjectID = $retrievedetails['projectid']; 
// 	//$ListContractValue = $retrievedetails['total_rrp']; 
// 	$ListContractValue = $retrievedetails['total_cost']; 
// 	$ListSalesValue = $retrievedetails['sales_comm_cost']; 
// 	$ListErectorsValue = $retrievedetails['install_comm_cost'];

// 	// Get Travel Cost
// 	$resulttravel = mysql_query("SELECT * FROM ver_chronoforms_data_contract_items_vic WHERE quoteid = '$cust_id' and projectid = '$ListProjectID' and inventoryid = 'IRV91'");
// 	$retrievetravel = mysql_fetch_array($resulttravel);
// 	if (!$resulttravel) {die("Error: Data not found..");}
// 	$Travel = $retrievetravel['rrp']; 

// 	// Get Labour Cost
// 	$resultlabour = mysql_query("SELECT * FROM ver_chronoforms_data_contract_items_vic WHERE quoteid = '$cust_id' and projectid = '$ListProjectID' and inventoryid = 'IRV89'");
// 	$retrievelabour = mysql_fetch_array($resultlabour);
// 	if (!$resultlabour) {die("Error: Data not found..");}
// 	$Labour = $retrievelabour['rrp'];

// 	// Get Accommodation Cost
// 	$resultaccommodation = mysql_query("SELECT * FROM ver_chronoforms_data_contract_items_vic WHERE quoteid = '$cust_id' and projectid = '$ListProjectID' and inventoryid = 'IRV92'");
// 	$retrieveaccommodation = mysql_fetch_array($resultaccommodation);
// 	if (!$resultaccommodation) {die("Error: Data not found..");}
// 	$Accommodation = $retrieveaccommodation['rrp'];

// 	// Get Contract Vergola
// 	$resultvergola = mysql_query("SELECT * FROM ver_chronoforms_data_contract_vergola_vic WHERE quoteid = '$cust_id' and projectid = '$ListProjectID' ORDER BY quotedate DESC");
// 	$retrievevergola = mysql_fetch_array($resultvergola);
// 	if (!$resultvergola) {die("Error: Data not found..");} 

// 	$CheckMeasurer = $retrievevergola['check_measurer'];
// 	$CheckDate = $retrievevergola['check_measure_date'];
// 	$ReCheckDate = $retrievevergola['recheck_measure_date'];
// 	$DrawingDate = $retrievevergola['drawing_prepare_date'];
// 	$DrawingApprove = $retrievevergola['drawing_approve_date'];

// 	$ProductionStart = $retrievevergola['production_start_date'];
// 	$ProductionComplete = $retrievevergola['production_complete_date'];
// 	$ClientNotified = $retrievevergola['client_notified_date'];
// 	$Erectors = $retrievevergola['erectors_name'];
// 	$ErectorNotified = $retrievevergola['erector_notified_date'];
// 	$WarrantyStart = $retrievevergola['warranty_start_date'];
// 	$WarrantyEnd = $retrievevergola['warranty_end_date'];

// 	$JobStart = $retrievevergola['job_start_date'];
// 	$JobEnd = $retrievevergola['job_end_date'];

// 	// Get Contract Statutory
// 	$resultstatutory = mysql_query("SELECT * FROM ver_chronoforms_data_contract_statutory_vic WHERE quoteid = '$cust_id' and projectid = '$ListProjectID' ORDER BY quotedate DESC");
// 	$retrievestatutory = mysql_fetch_array($resultstatutory);
// 	if (!$resultstatutory) {die("Error: Data not found..");}
// 	$Council = $retrievestatutory['council'];
// 	$PlanningDate = $retrievestatutory['planning_application_date'];
// 	$PlanningApproval = $retrievestatutory['planning_approval_date'];
// 	$WarrantyInsurance = $retrievestatutory['warranty_insurance_date'];
// 	$Certifier = $retrievestatutory['certifier_date'];
// 	$Development = $retrievestatutory['da_date'];

// 	// Get Contract Details
// 	$resultdate = mysql_query("SELECT * FROM ver_chronoforms_data_contract_details_vic WHERE quoteid = '$cust_id' and projectid = '$ListProjectID' ORDER BY quotedate DESC");
// 	$retrievedate = mysql_fetch_array($resultdate);
// 	if (!$resultdate) {die("Error: Data not found..");}
// 	$DepositDate = $retrievedate['deposit_paid'];
// 	$ProgressClaim = $retrievedate['progress_claim'];
// 	$FinalPayment = $retrievedate['final_payment'];

// 	$quote_projectid = "";
// 	//error_log("SELECT * ", 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_sa\\my-error.log'); 
// 	//if(substr($projectid, 0,3)=="VIC" || substr($projectid, 0,3)=="QID" || substr($projectid, 0,4)=="QIDV"){
// 	if(substr($projectid, 0,3)!="VIC"  ){	
// 		$qQuote = mysql_query("SELECT * FROM ver_chronoforms_data_followup_vic WHERE project_name = '{$retrievedetails['project_name']}' "); 
// 		//error_log("SELECT * FROM ver_chronoforms_data_followup_vic WHERE project_name = '{$retrievedetails['project_name']}' ", 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_sa\\my-error.log'); 
// 		$_quote = mysql_fetch_array($qQuote); 
// 		$quote_projectid = $_quote['projectid'];
// 		$projectid = $_quote['projectid'];
// 	}
	

// }

if(isset($_POST['update'])){
	
if ($_POST['checkmeasurer']!= "") {$POSTCheckMeasurer = $_POST['checkmeasurer'];} else {$POSTCheckMeasurer = $CheckMeasurer;}
if ($_POST['checkdate']!= ""){
$checkmeasuredate =  $_POST['checkdate']; 
$checkdatestamp = date('Y-m-d H:i:s', strtotime($checkmeasuredate));
$POSTCheckDate = $checkdatestamp;} else {$POSTCheckDate = $CheckDate;}

if ($_POST['recheckdate']!= ""){
$recheckmeasuredate =  $_POST['recheckdate']; 
$recheckdatestamp = date('Y-m-d H:i:s', strtotime($recheckmeasuredate));
$POSTReCheckDate = $recheckdatestamp;} else {$POSTReCheckDate = $ReCheckDate;}

if ($_POST['drawingdate']!= ""){
$drawingpreparedate =  $_POST['drawingdate']; 
$drawingdatestamp = date('Y-m-d H:i:s', strtotime($drawingpreparedate));
$POSTDrawingDate = $drawingdatestamp;} else {$POSTDrawingDate = $DrawingDate;}

if ($_POST['drawingapprovedate']!= ""){
$drawingapprovedate =  $_POST['drawingapprovedate']; 
$drawingapprovestamp = date('Y-m-d H:i:s', strtotime($drawingapprovedate));
$POSTDrawingApprove = $drawingapprovestamp;} else {$POSTDrawingApprove = $DrawingApprove;}

if ($_POST['productionstart']!= ""){
$productiondate =  $_POST['productionstart']; 
$productiondatestamp = date('Y-m-d H:i:s', strtotime($productiondate));
$POSTProductionStart = $productiondatestamp;} else {$POSTProductionStart = $ProductionStart;}

if ($_POST['productioncomplete']!= ""){
$productioncompletedate =  $_POST['productioncomplete']; 
$productioncompletestamp = date('Y-m-d H:i:s', strtotime($productioncompletedate));
$POSTProductionComplete = $productioncompletestamp;} else {$POSTProductionComplete = $ProductionComplete;}

if ($_POST['clientnotified']!= ""){
$clientnotifieddate =  $_POST['clientnotified']; 
$clientnotifiedstamp = date('Y-m-d H:i:s', strtotime($clientnotifieddate));
$POSTClientNotified = $clientnotifiedstamp;} else {$POSTClientNotified = $ClientNotified;}

if ($_POST['erectors']!= "") {$POSTErectors = $_POST['erectors'];} else {$POSTErectors = $Erectors;}

if ($_POST['erectornotified']!= ""){
$erectornotifieddate =  $_POST['erectornotified']; 
$erectornotifiedstamp = date('Y-m-d H:i:s', strtotime($erectornotifieddate));
$POSTErectorNotified = $erectornotifiedstamp;} else {$POSTErectorNotified = $ErectorNotified;}

if ($_POST['warrantystart']!= ""){
$warrantystartdate =  $_POST['warrantystart']; 
$warrantystartstamp = date('Y-m-d H:i:s', strtotime($warrantystartdate));
$POSTWarrantyStart = $warrantystartstamp;} else {$POSTWarrantyStart = $WarrantyStart;}

if ($_POST['warrantyend']!= ""){
$warrantyenddate =  $_POST['warrantyend']; 
$warrantyendstamp = date('Y-m-d H:i:s', strtotime($warrantyenddate));
$POSTWarrantyEnd = $warrantyendstamp;} else {$POSTWarrantyEnd = $WarrantyEnd;}

if ($_POST['jobstart']!= ""){
$jobstartdate =  $_POST['jobstart']; 
$jobstartstamp = date('Y-m-d H:i:s', strtotime($jobstartdate));
$POSTJobStart = $jobstartstamp;} else {$POSTJobStart = $JobStart;}

if ($_POST['jobend']!= ""){
$jobenddate =  $_POST['jobend']; 
$jobendstamp = date('Y-m-d H:i:s', strtotime($jobenddate));
$POSTJobEnd = $jobendstamp;} else {$POSTJobEnd = $JobEnd;}

mysql_query("UPDATE ver_chronoforms_data_contract_vergola_vic SET 
check_measurer = '$POSTCheckMeasurer', 
check_measure_date = ".(!empty($CheckDate) || !empty($_POST['checkdate']) ? "'$POSTCheckDate'" : "NULL").",
recheck_measure_date = ".(!empty($ReCheckDate) || !empty($_POST['recheckdate']) ? "'$POSTReCheckDate'" : "NULL").",
drawing_prepare_date = ".(!empty($DrawingDate) || !empty($_POST['drawingdate']) ? "'$POSTDrawingDate'" : "NULL").",
drawing_approve_date = ".(!empty($DrawingApprove) || !empty($_POST['drawingapprovedate']) ? "'$POSTDrawingApprove'" : "NULL").",
production_start_date = ".(!empty($ProductionStart) || !empty($_POST['productionstart']) ? "'$POSTProductionStart'" : "NULL").",
production_complete_date = ".(!empty($ProductionComplete) || !empty($_POST['productioncomplete']) ? "'$POSTProductionComplete'" : "NULL").",
client_notified_date = ".(!empty($ClientNotified) || !empty($_POST['clientnotified']) ? "'$POSTClientNotified'" : "NULL").",
erectors_name = '$POSTErectors',
erector_notified_date = ".(!empty($ErectorNotified) || !empty($_POST['erectornotified']) ? "'$POSTErectorNotified'" : "NULL").",
warranty_start_date = ".(!empty($WarrantyStart) || !empty($_POST['warrantystart']) ? "'$POSTWarrantyStart'" : "NULL").",
warranty_end_date = ".(!empty($WarrantyEnd) || !empty($_POST['warrantyend']) ? "'$POSTWarrantyEnd'" : "NULL").",
job_start_date = ".(!empty($JobStart) || !empty($_POST['jobstart']) ? "'$POSTJobStart'" : "NULL").",
job_end_date = ".(!empty($JobEnd) || !empty($_POST['jobend']) ? "'$POSTJobEnd'" : "NULL")."
WHERE projectid = '$ListProjectID'")or die(mysql_error());

if ($_POST['council']!= "") {$POSTCouncil = $_POST['council'];} 
else {$POSTCouncil = $Council;}

if ($_POST['planningdate']!= ""){
$planningapplicationdate =  $_POST['planningdate']; 
$planningdatestamp = date('Y-m-d H:i:s', strtotime($planningapplicationdate));
$POSTPlanningDate = $planningdatestamp;} else {$POSTPlanningDate = $PlanningDate;}

if ($_POST['planningapprove']!= ""){
$planningapprovedate =  $_POST['planningapprove']; 
$planningapprovestamp = date('Y-m-d H:i:s', strtotime($planningapprovedate));
$POSTPlanningApproval = $planningapprovestamp;} else {$POSTPlanningApproval = $PlanningApproval;}


if ($_POST['warrantyinsurance']!= ""){
$warrantyinsurancedate =  $_POST['warrantyinsurance']; 
$warrantyinsurancestamp = date('Y-m-d H:i:s', strtotime($warrantyinsurancedate));
$POSTWarrantyInsurance = $warrantyinsurancestamp;} else {$POSTWarrantyInsurance = $WarrantyInsurance;}


if ($_POST['certifier']!= ""){
$certifierdate =  $_POST['certifier']; 
$certifierstamp = date('Y-m-d H:i:s', strtotime($certifierdate));
$POSTCertifier = $certifierstamp;} else {$POSTCertifier = $Certifier;}


if ($_POST['development']!= ""){
$developmentdate =  $_POST['development']; 
$developmentstamp = date('Y-m-d H:i:s', strtotime($developmentdate));
$POSTDevelopment = $developmentstamp;} else {$POSTDevelopment = $Development;}

mysql_query("UPDATE ver_chronoforms_data_contract_statutory_vic SET 
council = ".(!empty($Council) || $_POST['council'] != 'Select Council' || $_POST['council'] == 'By Vergola' || $_POST['council'] == 'By Builder' ? "'$POSTCouncil'" : "NULL").",
planning_application_date = ".(!empty($PlanningDate) || !empty($_POST['planningdate']) ? "'$POSTPlanningDate'" : "NULL").",
planning_approval_date = ".(!empty($PlanningApproval) || !empty($_POST['planningapprove']) ? "'$POSTPlanningApproval'" : "NULL").",
warranty_insurance_date = ".(!empty($WarrantyInsurance) || !empty($_POST['warrantyinsurance']) ? "'$POSTWarrantyInsurance'" : "NULL").",
certifier_date = ".(!empty($Certifier) || !empty($_POST['certifier']) ? "'$POSTCertifier'" : "NULL").",
dev_approval_date = ".(!empty($Development) || !empty($_POST['development']) ? "'$POSTDevelopment'" : "NULL")."
WHERE projectid = '$ListProjectID'")or die(mysql_error());


if ($_POST['deposit_date']!= ""){
$depositpaiddate =  $_POST['deposit_date']; 
$depositpaidstamp = date('Y-m-d H:i:s', strtotime($depositpaiddate));
$POSTDepositDate = $depositpaidstamp;} else {$POSTDepositDate = $DepositDate;}

if ($_POST['progress_date']!= ""){
$progressdate =  $_POST['progress_date']; 
$progressdatestamp = date('Y-m-d H:i:s', strtotime($progressdate));
$POSTProgressClaim = $progressdatestamp;} else {$POSTProgressClaim = $ProgressClaim;}

if ($_POST['final_date']!= ""){
$finaldate =  $_POST['final_date']; 
$finaldatestamp = date('Y-m-d H:i:s', strtotime($finaldate));
$POSTFinalPayment = $finaldatestamp;} else {$POSTFinalPayment = $FinalPayment;}

mysql_query("UPDATE ver_chronoforms_data_contract_details_vic SET 
deposit_paid = ".(!empty($DepositDate) || !empty($_POST['deposit_date']) ? "'$POSTDepositDate'" : "NULL").",
progress_claim = ".(!empty($ProgressClaim) || !empty($_POST['progress_date']) ? "'$POSTProgressClaim'" : "NULL").",
final_payment = ".(!empty($FinalPayment) || !empty($_POST['final_date']) ? "'$POSTFinalPayment'" : "NULL")."
WHERE projectid = '$ListProjectID'")or die(mysql_error());

header('Location:'.JURI::base().'contract-listing-vic/contract-folder-vic?quoteid='.$cust_id.'&projectid='.$ListProjectID);	
}
?>
<script>
    $(function(){
      // bind change event to select
      $('.selproject').bind('change', function () {
          var url = $(this).val(); // get selected value
          if (url) { // require a URL
              window.location = url; // redirect
          }
          return false;
      });
    });
</script>
<!-- <span class="spanproject"><label>Select Project:</label>
<select class="selproject">
<?php  
$sqllist = "SELECT * FROM ver_chronoforms_data_contract_list_vic WHERE quoteid = '$cust_id' ORDER BY project_name ASC";
$resultlist = mysql_query ($sqllist) or die ('request "Could not execute SQL query" '.$sqllist);
while($row = mysql_fetch_assoc($resultlist))
	{	
	 echo "<option"; if($row['projectid'] == $ListProjectID) { echo " selected=\"selected\"";} else { echo " ";}
	 echo " value=\"".JURI::base()."contract-listing-vic/contract-folder-vic?quoteid=".$cust_id."&projectid=".$row['projectid']."\" >{$row['project_name']}</option>";
	} 
?>  
</select></span>-->

<div id="tabs_container">
	<ul id="contract-tabs" class="shadetabs"> 
      <li><a href="#" rel="contractdetails" class="<?php echo ($tab_active=="contract_details"?"selected":""); ?>">Contract Details</a></li> 
      <?php
      	//error_log("tab_active:".$tab_active, 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_sa\\my-error.log');
      	if(empty($projectid)){
      		$projectid = $_REQUEST['projectid'];
      	}
      	if(empty($quote_projectid)){
      		$quote_projectid = $_REQUEST['projectid'];
      	}
      ?>	
      <li><a href="<?php echo JURI::base()."view-quote-vic?projectid=".$quote_projectid."&ref_page=contracts&page_name=quote_details";?>">Quote Details</a></li>

      <?php 
	  $user = JFactory::getUser();
      $groups = $user->get('groups');
	/*  
	//error_log("tab_active: ".$tab_active, 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_sa\\my-error.log');
	foreach($groups as $group) {
    if($group == '10' || $group == '26' || $group == '27' || $group == '29' || $group == '28' ) { 
      // echo "<li class=\"\"><a href=\"".JURI::base()."contract-listing-vic/contract-folder-vic/contract-bom-vic?quoteid=".$QuoteID."&projectid=".$projectid."&page_name=bom\">Bill of Materials</a></li>";
      echo "<li class=\"\"><a href=\"".JURI::base()."contract-listing-vic/contract-folder-vic/contract-bom-vic?quoteid=".$QuoteID."&projectid=".$projectid."\">Bill of Materials</a></li>";
      //echo "<li><a href=\"#\" rel=\"purchaseorder\">Purchase Order</a></li>";
      echo "<li><a href=\"".JURI::base()."contract-listing-vic/contract-folder-vic/contract-po-vic?quoteid=".$QuoteID."&projectid=".$projectid."&page_name=po\">Purchase Order</a></li>";
      echo "<li><a href=\"".JURI::base()."contract-listing-vic/contract-folder-vic/contract-po-vic?quoteid=".$QuoteID."&projectid=".$projectid."&page_name=po&view=summary\">PO Summary</a></li>";
      echo "<li ><a href=\"#\" rel=\"checklist\" class=\"".($tab_active=='checklist'?'selected':'')."\">Check List</a></li>";
    } else { echo " ";} }
	*/
    ?>
      
    <?php //process user_access_profiles
    if ($current_signed_in_user_access_profiles['tab bill of materials']['show'] == true) {
		echo "<li class=\"\"><a href=\"".JURI::base()."contract-listing-vic/contract-folder-vic/contract-bom-vic?quoteid=".$QuoteID."&projectid=".$projectid."\">Bill of Materials</a></li>";
    } //end if

    if ($current_signed_in_user_access_profiles['tab purchase order']['show'] == true) {
		echo "<li><a href=\"".JURI::base()."contract-listing-vic/contract-folder-vic/contract-po-vic?quoteid=".$QuoteID."&projectid=".$projectid."&page_name=po\">Purchase Order</a></li>";
    } //end if

    if ($current_signed_in_user_access_profiles['tab po summary']['show'] == true) {
		echo "<li><a href=\"".JURI::base()."contract-listing-vic/contract-folder-vic/contract-po-vic?quoteid=".$QuoteID."&projectid=".$projectid."&page_name=po&view=summary\">PO Summary</a></li>";
    } //end if

    if ($current_signed_in_user_access_profiles['tab check list']['show'] == true) {
		echo "<li ><a href=\"#\" rel=\"checklist\" class=\"".($tab_active=='checklist'?'selected':'')."\">Check List</a></li>";
    } //end if
    ?>
   
    </ul> 
</div>

<div id="tabs_content_container"> 
    <!-- Contract Details Tab -->
    <div id="contractdetails" class="tab_content" style="display: block;">
	<h1>Project Name: <?php echo " ".$ListProjName; ?></h1>


<!-- <span><label>Deposit Paid:</label> <input type="text" id="depositdate" name="deposit_date" class="date_entered" value="<?php if ($DepositDate!="") {echo date(PHP_DFORMAT,strtotime($DepositDate)); } else {echo "";} ?>"/></span>
<span><label>Progress Claim:</label> <input type="text" id="progressclaim" name="progress_date" class="date_entered"value="<?php if ($ProgressClaim!="") {echo date(PHP_DFORMAT,strtotime($ProgressClaim)); } else {echo "";} ?>"/></span>
<span><label>Final Payment:</label> <input type="text" id="finalpayment" name="final_date" class="date_entered" value="<?php if ($FinalPayment!="") {echo date(PHP_DFORMAT,strtotime($FinalPayment)); } else {echo "";} ?>"/></span> -->

	<?php if(HOST_SERVER=="Victoria" || HOST_SERVER=="LA"){ //error_log("tab_active: ".$tab_active, 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_sa\\my-error.log'); ?>
		<span><label>Contract Value:</label> <?php echo " $".number_format($ListContractValue,2,".",","); ?></span>
		<span><label>Sales Commision:</label> <?php echo " $".number_format($ListSalesValue,2,".",","); ?></span>
		<span><label>Travel Cost:</label> <p><?php echo " $".number_format($Travel,2,".",","); ?></p></span>
		<span><label>Check Measurer:</label> <p><?php echo $CheckMeasurer; ?></p></span>
		<span><label>Check Date:</label> <p><?php if ($CheckDate!="") {echo date(PHP_DFORMAT,strtotime($CheckDate)); } else {echo "";} ?></p></span>
		<span><label>Re-Check Date:</label> <p><?php if ($ReCheckDate!="") {echo date(PHP_DFORMAT,strtotime($ReCheckDate)); } else {echo "";} ?></p></span>
		<span><label>Drawing Date:</label> <p><?php if ($DrawingDate!="") {echo date(PHP_DFORMAT,strtotime($DrawingDate)); } else {echo "";} ?></p></span>
		<span><label>Drawing Approve:</label> <p><?php if ($DrawingApprove!="") {echo date(PHP_DFORMAT,strtotime($DrawingApprove)); } else {echo "";} ?></p></span>
		<span><label>Site Labour:</label> <p><?php echo "$".number_format($Labour,2,".",","); ?></p></span>
		<span><label>Production Start:</label> <p><?php if ($ProductionStart!="") {echo date(PHP_DFORMAT,strtotime($ProductionStart)); } else {echo "";} ?></p></span>
		<span><label>Production Complete:</label> <p><?php if ($ProductionComplete!="") {echo date(PHP_DFORMAT,strtotime($ProductionComplete)); } else {echo "";} ?></p></span>
		<span><label>Client Notified:</label> <p><?php if ($ClientNotified!="") {echo date(PHP_DFORMAT,strtotime($ClientNotified)); } else {echo "";} ?></p></span>
		<span><label>Erector's Name:</label> <p><?php echo $Erectors; ?></p></span>
		<span><label>Erector Commision:</label> <?php echo " $".number_format("$ListErectorsValue",2,".",","); ?></span>
		<span><label>Erector's Notified:</label> <p><?php if ($ErectorNotified!="") {echo date(PHP_DFORMAT,strtotime($ErectorNotified)); } else {echo "";} ?></p></span>
		<span><label>Warranty Start:</label> <p><?php if ($WarrantyStart!="") {echo date(PHP_DFORMAT,strtotime($WarrantyStart)); } else {echo "";} ?></p></span>
		<span><label>Warranty End:</label> <p><?php if ($WarrantyEnd!="") {echo date(PHP_DFORMAT,strtotime($WarrantyEnd)); } else {echo "";} ?></p></span>
		<span><label>Accommodation:</label> <p><?php echo "$".number_format($Accommodation,2,".",","); ?></p></span>
		<span><label>Job Start:</label> <p><?php if ($JobStart!="") {echo date(PHP_DFORMAT,strtotime($JobStart)); } else {echo "";} ?></p></span>
		<span><label>Job End:</label> <p><?php if ($JobEnd!="") {echo date(PHP_DFORMAT,strtotime($JobEnd)); } else {echo "";} ?></p></span>
		<span><label>Council:</label> <p><?php echo $Council; ?></p></span>
		 
		<span><label>Planning Application:</label> <p><?php if ($PlanningDate!="") {echo date(PHP_DFORMAT,strtotime($PlanningDate)); } else {echo "";} ?></p></span>
		<span><label>Planning Approval:</label> <p><?php if ($PlanningApproval!="") {echo date(PHP_DFORMAT,strtotime($PlanningApproval)); } else {echo "";} ?></p></span>
		<span><label>Warranty Insurance:</label> <p><?php if ($WarrantyInsurance!="") {echo date(PHP_DFORMAT,strtotime($WarrantyInsurance)); } else {echo "";} ?></p></span>
		<span><label>Certifier:</label> <p><?php if ($Certifier!="") {echo date(PHP_DFORMAT,strtotime($Certifier)); } else {echo "";} ?></p></span>
		<span><label>Development Approval:</label> <p><?php if ($Development!="") {echo date(PHP_DFORMAT,strtotime($Development)); } else {echo "";} ?></p></span>


	<?php }else{ ?>
		<span><label>Contract Value:</label> <?php echo " $".number_format($retrievedetails['total_cost'],2,".",","); ?></span> 
		<span><label>Planning Application:</label> <p><?php echo ($retrievestatutory['planning_application_date']!="" ? date(PHP_DFORMAT,strtotime($retrievestatutory['planning_application_date'])):""); ?></p></span>
		<span><label>Handover:</label> <p><?php echo ($retrievevergola['handover_date']!="" ? date(PHP_DFORMAT,strtotime($retrievevergola['handover_date'])):""); ?></p></span>

		<span><label>Sales Comm.:</label> <?php echo " $".number_format($retrievedetails['sales_comm_cost'],2,".",","); ?></span>
		<span><label>Bldg. Rules Application:</label> <p><?php echo ($retrievestatutory['bldg_rules_application']!="" ? date(PHP_DFORMAT,strtotime($retrievestatutory['bldg_rules_application'])):""); ?> </p></span>
		<span><label>Warranty Start:</label> <p><?php echo ($retrievevergola['warranty_start_date']!="" ? date(PHP_DFORMAT,strtotime($retrievevergola['warranty_start_date'])):""); ?></p></span>

		<span><label>Installer Comm.:</label> <p><?php echo " $".number_format($retrievedetails['install_comm_cost'],2,".",","); ?></p></span> 
		<span><label>Development Approval:</label> <p><?php echo ($retrievestatutory['dev_approval_date']!="" ? date(PHP_DFORMAT,strtotime($retrievestatutory['dev_approval_date'])):""); ?></p></span>
		<span><label>Electrical Warranty End:</label> <p><?php echo ($retrievevergola['elect_warranty_end_date']!="" ? date(PHP_DFORMAT,strtotime($retrievevergola['elect_warranty_end_date'])):""); ?></p></span>

		<span><label>Check Measurer:</label> <p><?php echo $retrievevergola['check_measurer']; ?></p></span> 
		<span><label>Framework Complete:</label> <p><?php echo ($retrievevergola['fw_complete']!="" ? date(PHP_DFORMAT,strtotime($retrievevergola['fw_complete'])):""); ?></p></span>
		<span><label>Structure Warranty End:</label> <p><?php echo ($retrievevergola['warranty_end_date']!="" ? date(PHP_DFORMAT,strtotime($retrievevergola['warranty_end_date'])):""); ?></p></span> 

		<span><label>Check Measure:</label> <p><?php echo ($retrievevergola['check_measure_date']!="" ? date(PHP_DFORMAT,strtotime($retrievevergola['check_measure_date'])):""); ?></p></span>
		<span><label>Scheduled Install Date:</label> <p><?php echo ($retrievevergola['install_date']!="" ? date(PHP_DFORMAT,strtotime($retrievevergola['install_date'])):""); ?></p></span>
		<span><label>Travel:</label> <p><?php echo $retrievedata['travel']; ?></p></span> 
		
		<span><label>Time Frame Letter:</label> <p><?php echo ($retrievevergola['time_frame_letter']!="" ? date(PHP_DFORMAT,strtotime($retrievevergola['time_frame_letter'])):""); ?></p></span> 
		<span><label>Customer Notified:</label> <p><?php echo ($retrievevergola['client_notified_date']!="" ? date(PHP_DFORMAT,strtotime($retrievevergola['client_notified_date'])):""); ?></p></span>
		<span><label>Accomodation:</label> <p><?php echo $retrievedata['accomodation']; ?></p></span> 


		<span><label>Drawing Approve:</label> <p><?php echo ($retrievevergola['drawing_approve_date']!="" ? date(PHP_DFORMAT,strtotime($retrievevergola['drawing_approve_date'])):""); ?></p></span>
		<span><label>Installer Notified:</label> <p><?php echo ($retrievevergola['erector_notified_date']!="" ? date(PHP_DFORMAT,strtotime($retrievevergola['erector_notified_date'])):""); ?></p></span>
		<span><label>Cranage:</label> <p><?php echo $retrievedata['cranage']; ?></p></span> 

		   
		<span><label>Progress Claim:</label> <p><?php echo " $".number_format($retrievedata['progress_claim_amount'],2,".",","); ?> </p></span> 
		<span><label>Job Start:</label> <p><?php echo ($retrievevergola['job_start_date']!="" ? date(PHP_DFORMAT,strtotime($retrievevergola['job_start_date'])):""); ?></p></span> 
		<span><label>Scaffold:</label> <p><?php echo $retrievedata['scaffold']; ?></p></span>


		<span><label>Final Payment:</label> <p><?php echo " $".number_format($retrievedata['final_payment_amount'],2,".",","); ?></p></span> 
		<span><label>Job Complete:</label> <p><?php echo ($retrievevergola['job_end_date']!="" ? date(PHP_DFORMAT,strtotime($retrievevergola['job_end_date'])):""); ?></p></span> 
		<span><label> </label> <p> </p></span> 

	<?php } ?>
  </div>

  	<?php 
  	$user = JFactory::getUser();
		$groups = $user->get('groups');	
		foreach($groups as $group) {
	   		if($group == '10' || $group == '26' || $group == '27') { 
		    	echo "<div id='checklist' class='tab_content' style='display: none;'>";  
					include "check_list.php"; 	  
		    	echo "</div>";
	     	}  
	 	}

	?> 	

</div>	
 

