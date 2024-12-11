<?php
include 'includes/vic/custom_processes_user.php';

$current_signed_in_user_access_profiles = $custom_configs_user['user_access_profiles'][$current_signed_in_user_group_key]['contract-folder-vic'];
?>


<?php  
date_default_timezone_set('Australia/Victoria');
$form->data['date_entered'] = date(PHP_DFORMAT);
$form->data['date_time'] = date('d-M-Y g:i A');

$user = JFactory::getUser();
$user_group = "";
$is_admin = 0; $is_system_admin = 0; $is_sales_manager = 0; $is_operation_manager = 0;   $is_sales_consultant = 0; $is_reception = 0; $is_account_user = 0; $is_site_manager = 0;
if(isset($user->groups['10'])){
  $is_system_admin = 1;
  $is_admin = 1;
  $user_group = "system_admin";
}else if(isset($user->groups['26']) ){
  $is_operation_manager = 1;
  $is_admin = 1;
  $user_group = "operation_manager";
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
}else if(isset($user->groups['30']) ){
  $is_site_manager = 1;
  $is_admin = 1;
  $user_group = "site_manager";
}else{
  $is_sales_consultant = 1;
  $user_group = "sales_consultant";
}

$drawid = isset($_POST['drawingid']) ? $_POST['drawingid'] : NULL;
$picid = isset($_POST['picid']) ? $_POST['picid'] : NULL;
$fileid = isset($_POST['fileid']) ? $_POST['fileid'] : NULL;
$tab_active = isset($_REQUEST['tab']) ? $_REQUEST['tab'] : 'contract_details'; //default active contract_details else checklist
$page_name = isset($_REQUEST['page_name']) ? $_REQUEST['page_name'] : '';
$ref = "";
if(isset($_REQUEST['ref'])){
  $ref = $_REQUEST['ref']; 
} 

$contract_readonly = 0;
if($page_name=="maintenancefolder"){
    $contract_readonly = 1; 
}
//error_log("tab_active:".$tab_active, 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_sa\\my-error.log');

$projectid = mysql_real_escape_string($_REQUEST['projectid']);
$resultp = mysql_query("SELECT * FROM ver_chronoforms_data_contract_list_vic WHERE projectid = '{$projectid}'");
$_proj = mysql_fetch_assoc($resultp);

//error_log("HERE 0: ", 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_sa\\my-error.log');
$cust_id = $_proj['quoteid'];
//$QuoteIDAlpha = substr($cust_id, 0, 2);

$sql = "SELECT * FROM ver_chronoforms_data_clientpersonal_vic WHERE clientid  = '$cust_id'";
//error_log($sql, 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_sa\\my-error.log');   return;
$result = mysql_query($sql);
$retrieve = mysql_fetch_array($result);
if (!$retrieve) {die("Error: Data not found..");}
$id = $retrieve['pid'];
$cf_id = "0"; 
//This is the Time Save 
$now = time();

//$result = mysql_query("SELECT * FROM ver_chronoforms_data_clientpersonal_vic WHERE pid  = '$id'");
//$retrieve = mysql_fetch_array($result);
//$retrieve = mysql_fetch_array($result);
 
    $ClientSuburbID = $retrieve['client_suburbid'];
    $ClientTitle = $retrieve['client_title'];
    $ClientFirstName = $retrieve['client_firstname']; 
    $ClientLastName = $retrieve['client_lastname'];
    $BuilderContact = $retrieve['builder_contact'];
    $ClientStreetNo = $retrieve['client_streetno'];
    $ClientStreetName = $retrieve['client_streetname']; 
    $ClientAddress1 = $retrieve['client_address1'];
    $ClientAddress2 = $retrieve['client_address2'];
    $ClientSuburb = $retrieve['client_suburb'];
    $ClientState = $retrieve['client_state'];
    $ClientPostCode = $retrieve['client_postcode'];
    $ClientWPhone = $retrieve['client_wkphone'];
    $ClientHPhone = $retrieve['client_hmphone'];
    $ClientMobile = $retrieve['client_mobile'];
    $ClientOther = $retrieve['client_other'];
    $ClientEmail = $retrieve['client_email'];
 
    //error_log("ClientFirstName: ".$ClientFirstName, 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_sa\\my-error.log');   
    
    $SiteTitle = $retrieve['site_title'];
    $SiteFirstName = $retrieve['site_firstname'];
    $SiteLastName = $retrieve['site_lastname'];
    $SiteSiteName = $retrieve['site_sitename'];
    $SiteStreetNo = $retrieve['site_streetno'];
    $SiteStreetName = $retrieve['site_streetname']; 
    $SiteAddress1 = $retrieve['site_address1'];
    $SiteAddress2 = $retrieve['site_address2'];
    $SiteSuburbID = $retrieve['site_suburbid'];
    $SiteSuburb = $retrieve['site_suburb'];
    $SiteState = $retrieve['site_state'];
    $SitePostcode = $retrieve['site_postcode'];
    $SiteWKPhone = $retrieve['site_wkphone'];
    $SiteHMPhone = $retrieve['site_hmphone'];
    $SiteMobile = $retrieve['site_mobile'];
    $SiteOther = $retrieve['site_other'];
    $SiteEmail = $retrieve['site_email'];
    
    $date = $retrieve['datelodged'];
    $DateLodged = date(PHP_DFORMAT, strtotime($date));
    $datepoint = $retrieve['appointmentdate'];
    $AppointmentLodged = "";
    if(strlen($datepoint)>0){
        $AppointmentLodged = date(PHP_DFORMAT.' @ h:i A', strtotime($datepoint));
    // $AppointmentLodged = date(PHP_DFORMAT.' @ HH:ii P', strtotime($datepoint));
    }  
    $RepID = $retrieve['repid'];
    $RepIdent = $retrieve['repident'];
    $RepName = $retrieve['repname'];
    
    $LeadID = $retrieve['leadid'];
    $LeadName = $retrieve['leadname'];
    
    $EmployeeID = $retrieve['employeeid'];
    $ClientID = $retrieve['clientid'];
    $QuoteID = $ClientID;
  $is_tender_quote = $_proj['is_tender_quote'];

if(isset($_POST['update']))
{
$deposit_paid_amount = mysql_real_escape_string($_POST['deposit_paid_amount']);
$progress_claim_amount = mysql_real_escape_string($_POST['progress_claim_amount']);
$final_payment_amount = mysql_real_escape_string($_POST['final_payment_amount']);
$variation_amount = mysql_real_escape_string($_POST['variation_amount']);
 

(floatval($deposit_paid_amount)<=0?$deposit_paid_amount=0:'');
(floatval($progress_claim_amount)<=0?$progress_claim_amount=0:'');
(floatval($final_payment_amount)<=0?$final_payment_amount=0:'');
(floatval($variation_amount)<=0?$variation_amount=0:''); 
 
$deposit_paid = "NULL";
if (strlen($_POST['deposit_paid']) && $_POST['deposit_paid'] != "0000-00-00 00:00:00"){
  $deposit_paid = "'".date('Y-m-d H:i:s', strtotime(mysql_real_escape_string($_POST['deposit_paid'])))."'";
}

  $progress_claim = "NULL";
if (strlen($_POST['progress_claim']) && $_POST['progress_claim'] != "0000-00-00 00:00:00"){
  $progress_claim = "'".date('Y-m-d H:i:s', strtotime(mysql_real_escape_string($_POST['progress_claim'])))."'";
}

$final_payment = "NULL";
if (strlen($_POST['final_payment']) && $_POST['final_payment'] != "0000-00-00 00:00:00"){
  $final_payment = "'".date('Y-m-d H:i:s', strtotime(mysql_real_escape_string($_POST['final_payment'])))."'";
}

$variation_date = "NULL";
if (strlen($_POST['variation_date']) && $_POST['variation_date'] != "0000-00-00 00:00:00"){
  $variation_date = "'".date('Y-m-d H:i:s', strtotime(mysql_real_escape_string($_POST['variation_date'])))."'";
}

$enable_update_contract_details = false;
if (isset($_POST['deposit_paid_amount'])) {
    $enable_update_contract_details = true;
}

if ($enable_update_contract_details == true) {
    $sql = "UPDATE ver_chronoforms_data_contract_details_vic SET 
    deposit_paid = {$deposit_paid},
    progress_claim = {$progress_claim},
    final_payment = {$final_payment},
    deposit_paid_amount = {$deposit_paid_amount},
    progress_claim_amount = {$progress_claim_amount},
    final_payment_amount = {$final_payment_amount},
    variation_amount = {$variation_amount},
    variation_date = {$variation_date}
    WHERE projectid = '$projectid'";
    mysql_query($sql)or die(mysql_error());
}


$check_measurer = mysql_real_escape_string($_POST['checkmeasurer']); 
$controller_sn = mysql_real_escape_string($_POST['controllersn']); 
$controller_pw = mysql_real_escape_string($_POST['controllerpw']);
$drawing_followup_by = mysql_real_escape_string($_POST['drawingfollowupby']); 
$client_notified_by = mysql_real_escape_string($_POST['clientnotifiedby']); 

$check_measure_date = "NULL";
if (strlen($_POST['checkdate']) && $_POST['checkdate'] != "0000-00-00 00:00:00"){
  $check_measure_date = "'".date('Y-m-d H:i:s', strtotime(mysql_real_escape_string($_POST['checkdate'])))."'";
}
//error_log("checkdate: ".$_POST['checkdate'], 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_sa\\my-error.log');
//error_log("check_measure_date: ".$check_measure_date, 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_sa\\my-error.log');  

$recheck_measure_date = "NULL";
if (strlen($_POST['recheckdate']) && $_POST['recheckdate'] != "0000-00-00 00:00:00"){
  $recheck_measure_date = "'".date('Y-m-d H:i:s', strtotime(mysql_real_escape_string($_POST['recheckdate'])))."'";
}

$drawing_prepare_date = "NULL";
if (strlen($_POST['drawing_prepare_date']) && $_POST['drawing_prepare_date'] != "0000-00-00 00:00:00"){
  $drawing_prepare_date = "'".date('Y-m-d H:i:s', strtotime(mysql_real_escape_string($_POST['drawing_prepare_date'])))."'";
}

$drawing_prepare_date_followup = "NULL";
if (strlen($_POST['drawing_prepare_date_followup']) && $_POST['drawing_prepare_date_followup'] != "0000-00-00 00:00:00"){
  $drawing_prepare_date_followup = "'".date('Y-m-d H:i:s', strtotime(mysql_real_escape_string($_POST['drawing_prepare_date_followup'])))."'";
}
 
$drawing_approve_date = "NULL"; 
if (strlen($_POST['drawingapprovedate']) && $_POST['drawingapprovedate'] != "0000-00-00 00:00:00"){
  $drawing_approve_date = "'".date('Y-m-d H:i:s', strtotime(mysql_real_escape_string($_POST['drawingapprovedate'])))."'";
}

$drawing_approve_date_followup = "NULL"; 
if (strlen($_POST['drawingapprovedatefollowup']) && $_POST['drawingapprovedatefollowup'] != "0000-00-00 00:00:00"){
  $drawing_approve_date_followup = "'".date('Y-m-d H:i:s', strtotime(mysql_real_escape_string($_POST['drawingapprovedatefollowup'])))."'";
}

$building_permit_issued = "NULL";
if (strlen($_POST['building_permit_issued']) && $_POST['building_permit_issued'] != "0000-00-00 00:00:00"){
  $building_permit_issued = "'".date('Y-m-d H:i:s', strtotime(mysql_real_escape_string($_POST['building_permit_issued'])))."'";
}

$production_start_date = "NULL";
if (strlen($_POST['productionstart']) && $_POST['productionstart'] != "0000-00-00 00:00:00"){
  $production_start_date = "'".date('Y-m-d H:i:s', strtotime(mysql_real_escape_string($_POST['productionstart'])))."'";
}

$production_complete_date = "NULL";
if (strlen($_POST['productioncomplete']) && $_POST['productioncomplete'] != "0000-00-00 00:00:00"){
  $production_complete_date = "'".date('Y-m-d H:i:s', strtotime(mysql_real_escape_string($_POST['productioncomplete'])))."'";
}

$install_date = "NULL";
if (strlen($_POST['install_date']) && $_POST['install_date'] != "0000-00-00 00:00:00"){
  $install_date = "'".date('Y-m-d H:i:s', strtotime(mysql_real_escape_string($_POST['install_date'])))."'";
}

$erectors_name = mysql_real_escape_string($_POST['erectors_name']);
$erectors_name2 = mysql_real_escape_string($_POST['erectors_name2']);

$client_notified_date = "NULL";
if (strlen($_POST['clientnotified']) && $_POST['clientnotified'] != "0000-00-00 00:00:00"){
  $client_notified_date = "'".date('Y-m-d H:i:s', strtotime(mysql_real_escape_string($_POST['clientnotified'])))."'";
}

$erector_notified_date = "NULL";
if (strlen($_POST['erectornotified']) && $_POST['erectornotified'] != "0000-00-00 00:00:00"){
  $erector_notified_date = "'".date('Y-m-d H:i:s', strtotime(mysql_real_escape_string($_POST['erectornotified'])))."'";
}

$warranty_start_date = "NULL";
 if (strlen($_POST['warrantystart']) && $_POST['warrantystart'] != "0000-00-00 00:00:00"){
  $warranty_start_date = "'".date('Y-m-d H:i:s', strtotime(mysql_real_escape_string($_POST['warrantystart'])))."'";
}
 
$warranty_end_date = "NULL"; 
if (strlen($_POST['warrantyend']) && $_POST['warrantyend'] != "0000-00-00 00:00:00"){
  $warranty_end_date = "'".date('Y-m-d H:i:s', strtotime(mysql_real_escape_string($_POST['warrantyend'])))."'";
}

$job_start_date = "NULL";
if (strlen($_POST['jobstart']) && $_POST['jobstart'] != "0000-00-00 00:00:00"){
  $job_start_date = "'".date('Y-m-d H:i:s', strtotime(mysql_real_escape_string($_POST['jobstart'])))."'";
}

$job_start_date_followup = "NULL";
if (strlen($_POST['jobstartfollowup']) && $_POST['jobstartfollowup'] != "0000-00-00 00:00:00"){
  $job_start_date_followup = "'".date('Y-m-d H:i:s', strtotime(mysql_real_escape_string($_POST['jobstartfollowup'])))."'";
}

$job_end_date = "NULL";
if (strlen($_POST['jobend']) && $_POST['jobend'] != "0000-00-00 00:00:00"){
  $job_end_date = "'".date('Y-m-d H:i:s', strtotime(mysql_real_escape_string($_POST['jobend'])))."'";
}

$final_inspection_date = "NULL";
if (strlen($_POST['final_inspection_date']) && $_POST['final_inspection_date'] != "0000-00-00 00:00:00"){
  $final_inspection_date = "'".date('Y-m-d H:i:s', strtotime(mysql_real_escape_string($_POST['final_inspection_date'])))."'";
} 

$fw_orderdate = "NULL";
if (strlen($_POST['fw_orderdate']) && $_POST['fw_orderdate'] != "0000-00-00 00:00:00"){
  $fw_orderdate = "'".date('Y-m-d H:i:s', strtotime(mysql_real_escape_string($_POST['fw_orderdate'])))."'";
} 

$gutter_flashing_ordered = "NULL";
if (strlen($_POST['gutter_flashing_ordered']) && $_POST['gutter_flashing_ordered'] != "0000-00-00 00:00:00"){
  $gutter_flashing_ordered = "'".date('Y-m-d H:i:s', strtotime(mysql_real_escape_string($_POST['gutter_flashing_ordered'])))."'";
} 

$louvers_ordered = "NULL";
if (strlen($_POST['louvers_ordered']) && $_POST['louvers_ordered'] != "0000-00-00 00:00:00"){
  $louvers_ordered = "'".date('Y-m-d H:i:s', strtotime(mysql_real_escape_string($_POST['louvers_ordered'])))."'";
} 

$louvers_complete = "NULL";
if (strlen($_POST['louvers_complete']) && $_POST['louvers_complete'] != "0000-00-00 00:00:00"){
  $louvers_complete = "'".date('Y-m-d H:i:s', strtotime(mysql_real_escape_string($_POST['louvers_complete'])))."'";
} 
$handover_date = "NULL";
$elect_warranty_end_date="NULL";
if (strlen($_POST['handover_date']) && $_POST['handover_date'] != "0000-00-00 00:00:00"){
  $_handover_date = date('Y-m-d H:i:s', strtotime(mysql_real_escape_string($_POST['handover_date'])));
  $handover_date = "'".$_handover_date."'";

   
  if($warranty_start_date=="NULL"){ 
    $warranty_start_date = $handover_date;  
  }

  if($elect_warranty_end_date=="NULL"){ 
    $elect_warranty_end_date = 'date_add('.$handover_date.',INTERVAL 2 YEAR)';
  }
  
  if($warranty_end_date=="NULL"){ 
    $warranty_end_date =  'date_add('.$handover_date.',INTERVAL 5 YEAR)';
  }
} 

$fw_complete = "NULL";
if (strlen($_POST['fw_complete']) && $_POST['fw_complete'] != "0000-00-00 00:00:00"){
  $fw_complete = "'".date('Y-m-d H:i:s', strtotime(mysql_real_escape_string($_POST['fw_complete'])))."'";
} 

$time_frame_letter = "NULL"; 
if (strlen($_POST['time_frame_letter']) && $_POST['time_frame_letter'] != "0000-00-00 00:00:00"){
  $time_frame_letter = "'".date('Y-m-d H:i:s', strtotime(mysql_real_escape_string($_POST['time_frame_letter'])))."'";
} 

$schedule_completion = "NULL"; 
if (strlen($_POST['schedule_completion']) && $_POST['schedule_completion'] != "0000-00-00 00:00:00"){
  $schedule_completion = "'".date('Y-m-d H:i:s', strtotime(mysql_real_escape_string($_POST['schedule_completion'])))."'";
} 

$enable_update_contract_vergola = false;
if (isset($_POST['checkdate'])) {
    $enable_update_contract_vergola = true;
}

if ($enable_update_contract_vergola == true) {
    $sql = "UPDATE ver_chronoforms_data_contract_vergola_vic SET 
    check_measurer = '{$check_measurer}',
    check_measure_date = {$check_measure_date},
    recheck_measure_date = {$recheck_measure_date},
    drawing_prepare_date = {$drawing_prepare_date},
    drawing_prepare_date_followup = {$drawing_prepare_date_followup},
    drawing_approve_date = {$drawing_approve_date},
    drawing_approve_date_followup = {$drawing_approve_date_followup},
    building_permit_issued ={$building_permit_issued},
    production_start_date ={$production_start_date},
    production_complete_date = {$production_complete_date},
    install_date = {$install_date},
    erectors_name = '{$erectors_name}',
    erectors_name2 = '{$erectors_name2}',
    client_notified_date = {$client_notified_date},
    erector_notified_date = {$erector_notified_date},
    warranty_start_date = {$warranty_start_date},
    elect_warranty_end_date = {$elect_warranty_end_date},
    warranty_end_date = {$warranty_end_date},
    job_start_date = {$job_start_date},
    job_start_date_followup = {$job_start_date_followup},
    job_end_date = {$job_end_date},
    final_inspection_date = {$final_inspection_date},
    fw_orderdate = {$fw_orderdate},
    gutter_flashing_ordered = {$gutter_flashing_ordered},
    louvers_ordered = {$louvers_ordered},
    louvers_complete = {$louvers_complete},                    
    handover_date = {$handover_date},
    fw_complete = {$fw_complete},
    time_frame_letter = {$time_frame_letter},
    schedule_completion = {$schedule_completion},
    controller_sn = '{$controller_sn}',
    controller_pw = '{$controller_pw}',
    drawing_followup_by = '{$drawing_followup_by}',
    client_notified_by = '{$client_notified_by}'
    WHERE projectid = '$projectid'"; 
    mysql_query($sql) or die(mysql_error()); 
}


$cancellation_fee_amount = mysql_real_escape_string($_POST['cancellation_fee_amount']);
$balanceowning_amount = mysql_real_escape_string($_POST['balanceowning_amount']);

(floatval($cancellation_fee_amount)<=0?$cancellation_fee_amount=0:'');
(floatval($balanceowning_amount)<=0?$balanceowning_amount=0:'');

/* $datecancellationpaid = $retrieve['cancellationpaid_date'];
$CancellationLodged = "";
$cancellationpaid_date = "";
  
if(strlen($datecancellationpaid)>0){
        $CancellationLodged = date(PHP_DFORMAT. strtotime($datecancellationpaid));
    $cancellationpaid_date = date(PHP_DFORMAT, strtotime($datecancellationpaid));
    // $AppointmentLodged = date(PHP_DFORMAT.' @ HH:ii P', strtotime($datepoint));
    }    */

$cancellation_date = "NULL";
if (strlen($_POST['cancellation_date']) && $_POST['cancellation_date'] != "0000-00-00 00:00:00"){
  $cancellation_date = "'".date('Y-m-d H:i:s', strtotime(mysql_real_escape_string($_POST['cancellation_date'])))."'";
}

$cancellationpaid_date = "NULL";
if (strlen($_POST['cancellationpaid_date']) && $_POST['cancellationpaid_date'] != "0000-00-00 00:00:00"){
  $cancellationpaid_date = "'".date('Y-m-d H:i:s', strtotime(mysql_real_escape_string($_POST['cancellationpaid_date'])))."'";
} 

$enable_update_contract_cancellation = false;
if (isset($_POST['cancellation_fee_amount'])) {
    $enable_update_contract_cancellation = true;
  

  /* $date = $retrieve['datelodged'];
    $DateLodged = date(PHP_DFORMAT, strtotime($date));
    $datecancellationpaid = $retrieve['cancellationpaid_date'];
    $CancellationLodged = "";
  $cancellationpaid_date = "";
    if(strlen($cancellation_fee_amount)>0){
        $CancellationLodged = date(PHP_DFORMAT.' @ h:i A', strtotime($datecancellationpaid));
    $cancellationpaid_date = date(PHP_DFORMAT, strtotime($datecancellationpaid));
    // $AppointmentLodged = date(PHP_DFORMAT.' @ HH:ii P', strtotime($datepoint));
    }   */
}

  
  
if ($enable_update_contract_cancellation == true) {
    $sql = "UPDATE ver_chronoforms_data_contract_vergola_vic SET 
    cancellation_date = {$cancellation_date},
    cancellation_fee_amount = {$cancellation_fee_amount},
    balanceowning_amount = {$balanceowning_amount},
    cancellationpaid_date = {$cancellationpaid_date}
    WHERE projectid = '$projectid'"; 
    mysql_query($sql)or die(mysql_error());
}

$planning_dates_enabled = "No";
if (strlen($_POST['planning_dates_enabled'])){
  $planning_dates_enabled = "'".mysql_real_escape_string($_POST['planning_dates_enabled'])."'";
}
$planning_application_date = "NULL";
if (strlen($_POST['planning_application_date']) && $_POST['planning_application_date'] != "0000-00-00 00:00:00"){
  $planning_application_date = "'".date('Y-m-d H:i:s', strtotime(mysql_real_escape_string($_POST['planning_application_date'])))."'";
}
$planning_approval_date = "NULL";
if (strlen($_POST['planning_approval_date']) && $_POST['planning_approval_date'] != "0000-00-00 00:00:00"){
  $planning_approval_date = "'".date('Y-m-d H:i:s', strtotime(mysql_real_escape_string($_POST['planning_approval_date'])))."'";
}
$planning_followup_date = "NULL";
if (strlen($_POST['planning_followup_date']) && $_POST['planning_followup_date'] != "0000-00-00 00:00:00"){
  $planning_followup_date = "'".date('Y-m-d H:i:s', strtotime(mysql_real_escape_string($_POST['planning_followup_date'])))."'";
}
$planning_followup_bywhom = mysql_real_escape_string($_POST['planningfollowupbywhom']);

$bldg_rules_dates_enabled = "No";
if (strlen($_POST['bldg_rules_dates_enabled'])){
  $bldg_rules_dates_enabled = "'".mysql_real_escape_string($_POST['bldg_rules_dates_enabled'])."'";
}
$bldg_rules_application = "NULL"; 
if (strlen($_POST['bldg_rules_application']) && $_POST['bldg_rules_application'] != "0000-00-00 00:00:00"){
  $bldg_rules_application = "'".date('Y-m-d H:i:s', strtotime(mysql_real_escape_string($_POST['bldg_rules_application'])))."'";
} 
$bldg_rules_approval = "NULL"; 
if (strlen($_POST['bldg_rules_approval']) && $_POST['bldg_rules_approval'] != "0000-00-00 00:00:00"){
  $bldg_rules_approval = "'".date('Y-m-d H:i:s', strtotime(mysql_real_escape_string($_POST['bldg_rules_approval'])))."'";
} 
$bldg_rules_followup_date = "NULL"; 
if (strlen($_POST['bldg_rules_followup_date']) && $_POST['bldg_rules_followup_date'] != "0000-00-00 00:00:00"){
  $bldg_rules_followup_date = "'".date('Y-m-d H:i:s', strtotime(mysql_real_escape_string($_POST['bldg_rules_followup_date'])))."'";
} 
$bldg_rules_followup_bywhom = mysql_real_escape_string($_POST['bldgrulesfollowupbywhom']);

$dev_dates_enabled = "No";
if (strlen($_POST['dev_dates_enabled'])){
  $dev_dates_enabled = "'".mysql_real_escape_string($_POST['dev_dates_enabled'])."'";
}
$dev_application_date = "NULL"; 
if (strlen($_POST['dev_application_date']) && $_POST['dev_application_date'] != "0000-00-00 00:00:00"){
  $dev_application_date = "'".date('Y-m-d H:i:s', strtotime(mysql_real_escape_string($_POST['dev_application_date'])))."'";
} 
$dev_approval_date = "NULL"; 
if (strlen($_POST['dev_approval_date']) && $_POST['dev_approval_date'] != "0000-00-00 00:00:00"){
  $dev_approval_date = "'".date('Y-m-d H:i:s', strtotime(mysql_real_escape_string($_POST['dev_approval_date'])))."'";
} 
$dev_followup_date = "NULL"; 
if (strlen($_POST['dev_followup_date']) && $_POST['dev_followup_date'] != "0000-00-00 00:00:00"){
  $dev_followup_date = "'".date('Y-m-d H:i:s', strtotime(mysql_real_escape_string($_POST['dev_followup_date'])))."'";
} 
$dev_followup_bywhom = mysql_real_escape_string($_POST['devfollowupbywhom']);

$warranty_insurance_dates_enabled = "No";
if (strlen($_POST['warranty_insurance_dates_enabled'])){
  $warranty_insurance_dates_enabled = "'".mysql_real_escape_string($_POST['warranty_insurance_dates_enabled'])."'";
}
$warranty_insurance_date = "NULL";
if (strlen($_POST['warranty_insurance_date']) && $_POST['warranty_insurance_date'] != "0000-00-00 00:00:00"){
  $warranty_insurance_date = "'".date('Y-m-d H:i:s', strtotime(mysql_real_escape_string($_POST['warranty_insurance_date'])))."'";
}
$warranty_insurance_followup_date = "NULL";
if (strlen($_POST['warranty_insurance_followup_date']) && $_POST['warranty_insurance_followup_date'] != "0000-00-00 00:00:00"){
  $warranty_insurance_followup_date = "'".date('Y-m-d H:i:s', strtotime(mysql_real_escape_string($_POST['warranty_insurance_followup_date'])))."'";
}
$warranty_insurance_followup_bywhom = mysql_real_escape_string($_POST['warrantyinsurancefollowupbywhom']);

$engineering_dates_enabled = "No";
if (strlen($_POST['engineering_dates_enabled'])){
  $engineering_dates_enabled = "'".mysql_real_escape_string($_POST['engineering_dates_enabled'])."'";
}
$engineering_application_date = "NULL"; 
if (strlen($_POST['engineering_application_date']) && $_POST['engineering_application_date'] != "0000-00-00 00:00:00"){
  $engineering_application_date = "'".date('Y-m-d H:i:s', strtotime(mysql_real_escape_string($_POST['engineering_application_date'])))."'";
}
$engineering_approved_date = "NULL"; 
if (strlen($_POST['engineering_approved_date']) && $_POST['engineering_approved_date'] != "0000-00-00 00:00:00"){
  $engineering_approved_date = "'".date('Y-m-d H:i:s', strtotime(mysql_real_escape_string($_POST['engineering_approved_date'])))."'";
}
$engineering_followup_date = "NULL"; 
if (strlen($_POST['engineering_followup_date']) && $_POST['engineering_followup_date'] != "0000-00-00 00:00:00"){
  $engineering_followup_date = "'".date('Y-m-d H:i:s', strtotime(mysql_real_escape_string($_POST['engineering_followup_date'])))."'";
}
$engineering_followup_bywhom = mysql_real_escape_string($_POST['engineeringfollowupbywhom']);


 
$certifier_date = "NULL"; 
if (strlen($_POST['certifier']) && $_POST['certifier'] != "0000-00-00 00:00:00"){
  $certifier_date = "'".date('Y-m-d H:i:s', strtotime(mysql_real_escape_string($_POST['certifier'])))."'";
}


// $stat_req_easement = mysql_real_escape_string($_POST['stat_req_easement']); 
$stat_req_planning = mysql_real_escape_string($_POST['stat_req_planning']);  
$con_note_number = mysql_real_escape_string($_POST['con_note_number']);
$controller_sn = mysql_real_escape_string($_POST['controller_sn']);
$controller_pw = mysql_real_escape_string($_POST['controller_pw']);

$m_o_d = mysql_real_escape_string($_POST['m_o_d']);
$m_o_d_followup = "NULL"; 
if (strlen($_POST['m_o_d_followup']) && $_POST['m_o_d_followup'] != "0000-00-00 00:00:00"){
  $m_o_d_followup= "'".date('Y-m-d H:i:s', strtotime(mysql_real_escape_string($_POST['m_o_d_followup'])))."'";
}

$stat_req_easement_waterboard_approval_date = "NULL"; 
if (strlen($_POST['stat_req_easement_waterboard_approval_date']) && $_POST['stat_req_easement_waterboard_approval_date'] != "0000-00-00 00:00:00"){
  $stat_req_easement_waterboard_approval_date= "'".date('Y-m-d H:i:s', strtotime(mysql_real_escape_string($_POST['stat_req_easement_waterboard_approval_date'])))."'";
}

$stat_req_easement_waterboard_followup = "NULL"; 
if (strlen($_POST['stat_req_easement_waterboard_followup']) && $_POST['stat_req_easement_waterboard_followup'] != "0000-00-00 00:00:00"){
  $stat_req_easement_waterboard_followup= "'".date('Y-m-d H:i:s', strtotime(mysql_real_escape_string($_POST['stat_req_easement_waterboard_followup'])))."'";
}


$stat_req_easement_council_approval_date = "NULL"; 
if (strlen($_POST['stat_req_easement_council_approval_date']) && $_POST['stat_req_easement_council_approval_date'] != "0000-00-00 00:00:00"){
  $stat_req_easement_council_approval_date= "'".date('Y-m-d H:i:s', strtotime(mysql_real_escape_string($_POST['stat_req_easement_council_approval_date'])))."'";
}

$stat_req_easement_council_followup = "NULL"; 
if (strlen($_POST['stat_req_easement_council_followup']) && $_POST['stat_req_easement_council_followup'] != "0000-00-00 00:00:00"){
  $stat_req_easement_council_followup= "'".date('Y-m-d H:i:s', strtotime(mysql_real_escape_string($_POST['stat_req_easement_council_followup'])))."'";
}

$stat_req_planning_approval_date = "NULL"; 
if (strlen($_POST['stat_req_planning_approval_date']) && $_POST['stat_req_planning_approval_date'] != "0000-00-00 00:00:00"){
  $stat_req_planning_approval_date = "'".date('Y-m-d H:i:s', strtotime(mysql_real_escape_string($_POST['stat_req_planning_approval_date'])))."'";
}  

$permit_application_date = "NULL"; 
if (strlen($_POST['permit_application_date']) && $_POST['permit_application_date'] != "0000-00-00 00:00:00"){
  $permit_application_date = "'".date('Y-m-d H:i:s', strtotime(mysql_real_escape_string($_POST['permit_application_date'])))."'";
}

$engineering_approved_date_followup = "NULL"; 
if (strlen($_POST['engineering_approved_date_followup']) && $_POST['engineering_approved_date_followup'] != "0000-00-00 00:00:00"){
  $engineering_approved_date_followup = "'".date('Y-m-d H:i:s', strtotime(mysql_real_escape_string($_POST['engineering_approved_date_followup'])))."'";
}

$permit_approved_date = "NULL"; 
if (strlen($_POST['permit_approved_date']) && $_POST['permit_approved_date'] != "0000-00-00 00:00:00"){
  $permit_approved_date = "'".date('Y-m-d H:i:s', strtotime(mysql_real_escape_string($_POST['permit_approved_date'])))."'";
} 

$citb = "NULL"; 
if (strlen($_POST['citb']) && $_POST['citb'] != "0000-00-00 00:00:00"){
  $citb = "'".date('Y-m-d H:i:s', strtotime(mysql_real_escape_string($_POST['citb'])))."'";
} 

$planning_application_followup = "NULL"; 
if (strlen($_POST['planning_application_followup']) && $_POST['planning_application_followup'] != "0000-00-00 00:00:00"){
  $planning_application_followup = "'".date('Y-m-d H:i:s', strtotime(mysql_real_escape_string($_POST['planning_application_followup'])))."'";
} 

$enable_update_contract_statutory = false;
if (isset($_POST['planning_dates_enabled'])) {
    $enable_update_contract_statutory = true;
}

if ($enable_update_contract_statutory == true) {
    $sql = "UPDATE ver_chronoforms_data_contract_statutory_vic SET 
    planning_dates_enabled = {$planning_dates_enabled},
    planning_application_date = {$planning_application_date},
    planning_approval_date = {$planning_approval_date},
    bldg_rules_dates_enabled = {$bldg_rules_dates_enabled},
    bldg_rules_application = {$bldg_rules_application},
    bldg_rules_approval = {$bldg_rules_approval},
    dev_dates_enabled = {$dev_dates_enabled},
    dev_application_date = {$dev_application_date},
    dev_approval_date = {$dev_approval_date},
    warranty_insurance_dates_enabled = {$warranty_insurance_dates_enabled},
    warranty_insurance_date = {$warranty_insurance_date},
    engineering_dates_enabled = {$engineering_dates_enabled},
    engineering_application_date = {$engineering_application_date},
    engineering_approved_date = {$engineering_approved_date},
    certifier_date = {$certifier_date},
    stat_req_easement_waterboard_approval_date = {$stat_req_easement_waterboard_approval_date},
    stat_req_easement_waterboard_followup = {$stat_req_easement_waterboard_followup},
    stat_req_easement_council_approval_date = {$stat_req_easement_council_approval_date},
    stat_req_easement_council_followup = {$stat_req_easement_council_followup},
    stat_req_planning = '{$stat_req_planning}',
    stat_req_planning_approval_date = {$stat_req_planning_approval_date},
    m_o_d = '{$m_o_d}',
    m_o_d_followup = {$m_o_d_followup},
    contract_note_number = '{$con_note_number}', 
    permit_application_date = {$permit_application_date},
    engineering_approved_date_followup = {$engineering_approved_date_followup},
    permit_approved_date = {$permit_approved_date},
    citb = {$citb},
    planning_application_followup = {$planning_application_followup},

    planning_followup_date = {$planning_followup_date},
    bldg_rules_followup_date = {$bldg_rules_followup_date},
    dev_followup_date = {$dev_followup_date},
    warranty_insurance_followup_date = {$warranty_insurance_followup_date},
    engineering_followup_date = {$engineering_followup_date},

    planning_followup_bywhom = '{$planning_followup_bywhom}',
    bldg_rules_followup_bywhom = '{$bldg_rules_followup_bywhom}',
    dev_followup_bywhom = '{$dev_followup_bywhom}',
    warranty_insurance_followup_bywhom = '{$warranty_insurance_followup_bywhom}',
    engineering_followup_bywhom = '{$engineering_followup_bywhom}'


    WHERE projectid = '$projectid'"; 
    mysql_query($sql)or die(mysql_error()); 
}
  

$getclientid = $ClientID;   
$checknotes = implode(", ", $_POST['notestxt']);
$cnt = count($_POST['date_notes']);
$cnt2 = count($_POST['username_notes']);
$cnt3 = count($_POST['notestxt']);


if ($cnt > 0 && $cnt == $cnt2 && $cnt2 == $cnt3 && $checknotes != '') {
    $insertArr = array();
    
    for ($i=0; $i<$cnt; $i++) {

        $insertArr[] = "('$getclientid', '" . mysql_real_escape_string($_POST['date_notes'][$i]) . "', '" . mysql_real_escape_string($_POST['username_notes'][$i]) . "', '" . mysql_real_escape_string($_POST['notestxt'][$i]) . "')";
}


 $queryn = "INSERT INTO ver_chronoforms_data_notes_vic (clientid, datenotes, username, content) VALUES " . implode(", ", $insertArr);
 
 mysql_query($queryn) or trigger_error("Insert failed: " . mysql_error());

}

// begin Special Condition
  $getclientid = $ClientID; 
  $checkspecialcondition = implode(", ", $_POST['specialconditions']);
  $cnt_special = count($_POST['date_specialconditions']);
  $cnt_special2 = count($_POST['username_specialconditions']);
  $cnt_special3 = count($_POST['specialconditions']);

  // get the local timezone 
  $date_created = $default_local_timezone;
  
  if ($cnt_special > 0 && $cnt_special == $cnt_special2 && $cnt_special2 == $cnt_special3 && $checkspecialcondition != '') {
    $insertArr = array();
    //, '" . mysql_real_escape_string($_POST['date_notes'][$i]) . "'
  for ($i=0; $i<$cnt; $i++) {
      $insertArr[] = "('$getclientid', '" . mysql_real_escape_string($_POST['date_specialconditions'][$i]) . "', '" . mysql_real_escape_string($_POST['username_specialconditions'][$i]) . "', '" . mysql_real_escape_string($_POST['specialconditions'][$i]) . "')";
  }
  $queryn = "INSERT INTO ver_chronoforms_data_special_condition_vic (clientid, datenotes, username, content) VALUES " . implode(", ", $insertArr);
  
  mysql_query($queryn) or trigger_error("Insert failed: " . mysql_error()); 
  echo($queryn);
  } 
// end Special Condition

    //header('Location:'.JURI::base().'contract-listing-vic');      
}



if(isset($_FILES['pic'])){  // upload pic from Pics tab

      foreach ($_FILES['pic']['tmp_name'] as $key => $tmp_name){
      //This is the directory where images will be saved 
         
          $path = "images/pic/{$ClientID}";
          if (!file_exists($path)) {
            mkdir($path, 0777, true);
          }

          // $file_name = $_FILES['pic']['name'][0];
          // $file_name = pathinfo($_FILES['pic']['name'][$key], PATHINFO_FILENAME); 
          // $target=$path."/{$file_name}_{$now}";  
          // $target=$target.'.'.pathinfo($_FILES['pic']['name'][$key], PATHINFO_EXTENSION);  
          $file_name = pathinfo($_FILES['pic']['name'][$key], PATHINFO_FILENAME).'.'.pathinfo($_FILES['pic']['name'][$key], PATHINFO_EXTENSION); 
          $target=$path."/{$file_name}_{$now}";  
          $target=$target.'.'.pathinfo($_FILES['pic']['name'][$key], PATHINFO_EXTENSION);   

      if (move_uploaded_file($tmp_name, $target)) {

  $query = "INSERT INTO ver_chronoforms_data_pics_vic (clientid, datestamp, photo, file_name, upload_type) VALUES  ('$ClientID', NOW(), '$target', '{$file_name}', 'pic')";
   mysql_query($query) or trigger_error("Insert failed: " . mysql_error());

              
              }
      }
}
  

 
if(isset($_FILES['photo'])){ // upload drawing photo from Drawing tab
        //error_log(" RepIdent: ".$RepIdent, 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_sa\\my-error.log');
      foreach ($_FILES['photo']['tmp_name'] as $key => $tmp_name){
          //This is the directory where images will be saved 
          $path = "images/drawings/{$ClientID}";
          if (!file_exists($path)) {
            mkdir($path, 0777, true);
          }

          // $file_name = $_FILES['photo']['name'][0];
          // $file_name = pathinfo($_FILES['photo']['name'][$key], PATHINFO_FILENAME); 
          // $target=$path."/{$file_name}_{$now}";  
          // $target=$target.'.'.pathinfo($_FILES['photo']['name'][$key], PATHINFO_EXTENSION);  
          $file_name = pathinfo($_FILES['photo']['name'][$key], PATHINFO_FILENAME).'.'.pathinfo($_FILES['photo']['name'][$key], PATHINFO_EXTENSION); 
          $target=$path."/{$file_name}_{$now}";  
          $target=$target.'.'.pathinfo($_FILES['photo']['name'][$key], PATHINFO_EXTENSION);  


      if (move_uploaded_file($tmp_name, $target)) { 
          $query = "INSERT INTO ver_chronoforms_data_drawings_vic (clientid, photo, file_name) VALUES  ('$ClientID', '$target','{$file_name}')";
          mysql_query($query) or trigger_error("Insert failed: " . mysql_error());
            
          }
      }
  }
 
  
if(isset($_FILES['doc'])){  //Upload file from Files tab
      //error_log("RepIdent:".$RepIdent, 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_sa\\my-error.log');
      foreach ($_FILES['doc']['tmp_name'] as $key => $tmp_name){
        $path = "images/file_upload/{$ClientID}";
        if (!file_exists($path)) {
          mkdir($path, 0777, true);
        }

         //This is the directory where images will be saved  
         // $file_name = $_FILES['doc']['name'][0];
         //  $file_name = pathinfo($_FILES['doc']['name'][$key], PATHINFO_FILENAME); 
         //  $target=$path."/{$file_name}_{$now}";  
         //  $target=$target.'.'.pathinfo($_FILES['doc']['name'][$key], PATHINFO_EXTENSION);
          //error_log($ext, 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_sa\\my-error.log');
          $file_name = pathinfo($_FILES['doc']['name'][$key], PATHINFO_FILENAME).'.'.pathinfo($_FILES['doc']['name'][$key], PATHINFO_EXTENSION); 
          $target=$path."/{$file_name}_{$now}";  
          $target=$target.'.'.pathinfo($_FILES['doc']['name'][$key], PATHINFO_EXTENSION);    
          
          $upload_type = $_POST['upload_type']; 

      if (move_uploaded_file($tmp_name, $target)) {

  //$query = "INSERT INTO ver_chronoforms_data_pics_vic (clientid, datestamp, photo, upload_type, file_name) VALUES  ('$ClientID', '$datestamp', '$target','file','{$file_name}')";
        $query = "INSERT INTO ver_chronoforms_data_pics_vic (clientid, datestamp, photo, upload_type, file_name) VALUES  ('$ClientID', NOW(), '$target','{$upload_type}','{$file_name}')";
   mysql_query($query) or trigger_error("Insert failed: " . mysql_error());
      //error_log($query, 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_sa\\my-error.log'); 
              
              }
      }
 }



if(isset($_FILES['signed_doc'])){  //Upload file from Files tab
      //error_log(print_r($_POST,true), 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_sa\\my-error.log');
      $doc_id = mysql_real_escape_string($_POST['doc_id']);
      foreach ($_FILES['signed_doc']['tmp_name'] as $key => $tmp_name){
        $path = "images/file_upload/{$ClientID}";
        if (!file_exists($path)) {
          mkdir($path, 0777, true);
        }

  //This is the directory where images will be saved 
          
          // $file_name = $_FILES['signed_doc']['name'][0];
          // $file_name = pathinfo($_FILES['signed_doc']['name'][$key], PATHINFO_FILENAME); 
          // $target=$path."/{$file_name}_{$now}";  
          // $target=$target.'.'.pathinfo($_FILES['signed_doc']['name'][$key], PATHINFO_EXTENSION);    
          
          $file_name = pathinfo($_FILES['signed_doc']['name'][$key], PATHINFO_FILENAME).'.'.pathinfo($_FILES['signed_doc']['name'][$key], PATHINFO_EXTENSION); 
          $target=$path."/{$file_name}_{$now}";  
          $target=$target.'.'.pathinfo($_FILES['signed_doc']['name'][$key], PATHINFO_EXTENSION);
          
          $upload_type = $_POST['upload_type'];
          
          //error_log($ext, 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_sa\\my-error.log'); 

      if (move_uploaded_file($tmp_name, $target)) {

        //$query = "UPDATE  ver_chronoforms_data_letters_vic SET uploaded_filename='{$file_name}' WHERE cf_id={$doc_id} ";
         $query = "INSERT INTO ver_chronoforms_data_pics_vic (clientid, datestamp, photo, upload_type, file_name, ref_id) VALUES  ('$ClientID', '$datestamp', '$target','{$upload_type}','{$file_name}', {$doc_id})";
         mysql_query($query) or trigger_error("Insert failed: " . mysql_error());
        //error_log($query, 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_sa\\my-error.log'); 
              
              }
      }

      $query = "UPDATE  ver_chronoforms_data_letters_vic SET has_upload_file=1 WHERE cf_id={$doc_id} ";
      mysql_query($query) or trigger_error("Insert failed: " . mysql_error());

 }  


  if(isset($_FILES['upload_doc'])){  //Upload file from Files tab
      //error_log(print_r($_POST,true), 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_sa\\my-error.log');
      //$doc_id = mysql_real_escape_string($_POST['doc_id']);
      foreach ($_FILES['upload_doc']['tmp_name'] as $key => $tmp_name){
        $path = "images/file_upload/{$ClientID}";
        if (!file_exists($path)) {
          mkdir($path, 0777, true);
        }

  //This is the directory where images will be saved 
          
          //$file_name = $_FILES['upload_doc']['name'][0];
          $file_name = pathinfo($_FILES['upload_doc']['name'][$key], PATHINFO_FILENAME).'.'.pathinfo($_FILES['upload_doc']['name'][$key], PATHINFO_EXTENSION); 
          $target=$path."/{$file_name}_{$now}";  
          $target=$target.'.'.pathinfo($_FILES['upload_doc']['name'][$key], PATHINFO_EXTENSION); 

          $upload_type = $_POST['upload_type'];
          
          //error_log($ext, 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_sa\\my-error.log'); 

        if (move_uploaded_file($tmp_name, $target)) {

        //$query = "UPDATE  ver_chronoforms_data_letters_vic SET uploaded_filename='{$file_name}' WHERE cf_id={$doc_id} ";
         $query = "INSERT INTO ver_chronoforms_data_pics_vic (clientid, datestamp, photo, upload_type, file_name) VALUES  ('$ClientID', NOW(), '$target','{$upload_type}','{$file_name}')";
         mysql_query($query) or trigger_error("Insert failed: " . mysql_error());
       //error_log($query, 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_sa\\my-error.log'); 
              
              }
      }



      //$query = "UPDATE  ver_chronoforms_data_letters_vic SET has_upload_file=1 WHERE cf_id={$doc_id} ";
      //mysql_query($query) or trigger_error("Insert failed: " . mysql_error());
      //header('Location:'.JURI::base().'client-listing-vic/client-folder-vic?pid='.$id);

 }  


if(isset($_POST['delete-pic'])) {
     //error_log('Inside delete-pic', 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_sa\\my-error.log'); 
    $DrawInfo = mysql_query("SELECT * FROM ver_chronoforms_data_pics_vic WHERE cf_id  = '$picid'");
    $RetDrawInfo = mysql_fetch_array($DrawInfo); if (!$DrawInfo) {die("Error: Data not found..");}
    $RetPhoto=$RetDrawInfo['photo'];
       
    if (!unlink($RetPhoto))
    {
       echo ("Error deleting $file");
    }
    else
    {
        mysql_query("DELETE from ver_chronoforms_data_pics_vic WHERE cf_id = '$picid'") or die(mysql_error());  
    }
     
}

if(isset($_POST['delete-drawing'])) {
    //error_log('Inside delete-drawing', 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_sa\\my-error.log'); 
      
    $DrawInfo = mysql_query("SELECT * FROM ver_chronoforms_data_drawings_vic WHERE cf_id  = '$drawid'");
    $RetDrawInfo = mysql_fetch_array($DrawInfo); if (!$DrawInfo) {die("Error: Data not found..");}
    $RetPhoto=$RetDrawInfo['photo'];
       
    if (!unlink($RetPhoto))
    {
        echo ("Error deleting $file");
    }
    else
    {
        mysql_query("DELETE from ver_chronoforms_data_drawings_vic WHERE cf_id = '$drawid'") or die(mysql_error());  
    }
        //header('Location:'.JURI::base().'contract-listing-vic/contract-folder-vic?quoteid='.$cust_id);
}

if(isset($_POST['delete-file'])) {
     //error_log('Inside delete-pic', 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_sa\\my-error.log'); 
    $DrawInfo = mysql_query("SELECT * FROM ver_chronoforms_data_pics_vic WHERE cf_id  = '$fileid'");
    $RetDrawInfo = mysql_fetch_array($DrawInfo); if (!$DrawInfo) {die("Error: Data not found..");}
    $RetPhoto=$RetDrawInfo['photo'];
       
    if (!unlink($RetPhoto))
    {
       echo ("Error deleting $file");
    }
    else
    {
        mysql_query("DELETE from ver_chronoforms_data_pics_vic WHERE cf_id = '$fileid'") or die(mysql_error());  
    }
     
}




if(isset($_POST['delete_pdf']))
{ 
  $cf_id = $_POST['pdf_cf_id'];
  //error_log('Inside delete delete_pdf: ', 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_sa\\my-error.log');
  mysql_query("DELETE from ver_chronoforms_data_letters_vic WHERE cf_id = '$cf_id'")
        or die(mysql_error()); 
  
  $result = array('success' => true, 'note' => '');

  echo json_encode($result);
  exit();
  
  //header('Location:'.JURI::base().'client-listing-vic');  
}   

//error_log('outside delete : ', 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_sa\\my-error.log');
//error_log(print_r($_POST,true), 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_sa\\my-error.log');


if(isset($_POST['delete']))
{   
    //mysql_query("DELETE from ver_chronoforms_data_clientpersonal_vic WHERE pid = '$id'") or die(mysql_error()); 
    //echo "Deleted";
    //error_log('Inside delete : ', 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_sa\\my-error.log');
    mysql_query("START TRANSACTION");

    $rcontract = mysql_query("DELETE from ver_chronoforms_data_contract_list_vic WHERE projectid = '$projectid'");
    $rcdetails = mysql_query("DELETE from ver_chronoforms_data_contract_details_vic WHERE projectid = '$projectid'");
    $rcvergola = mysql_query("DELETE from ver_chronoforms_data_contract_vergola_vic WHERE projectid = '$projectid'");
    $rcstatutory = mysql_query("DELETE from ver_chronoforms_data_contract_statutory_vic WHERE projectid = '$projectid'"); 
    $rcitems = mysql_query("DELETE from ver_chronoforms_data_contract_items_vic WHERE projectid = '$projectid'"); 
    $rccontractDeminsions = mysql_query("DELETE from ver_chronoforms_data_contract_items_deminsions WHERE projectid = '$projectid'"); 
    $rcbom = mysql_query("DELETE from ver_chronoforms_data_contract_bom_vic WHERE projectid = '$projectid'"); 
    $rcbom_m = mysql_query("DELETE from ver_chronoforms_data_contract_bom_meterial_vic WHERE projectid = '$projectid'"); 
    $rletter = mysql_query("DELETE FROM ver_chronoforms_data_letters_vic WHERE clientid='{$cust_id}' AND template_type='check list - gutter flashing' OR template_type='check list' ");  // no need to be included in filter parameter for commit because the content could be included or not.  
    
 
    $rfollowup = mysql_query("UPDATE ver_chronoforms_data_followup_vic SET status = 'Quoted', date_contract_system_created=NULL, date_won=NULL WHERE projectid = '$projectid'");

    $rclient = mysql_query("UPDATE ver_chronoforms_data_clientpersonal_vic SET status = 'Quoted' WHERE clientid = '{$cust_id}' ");
 
    //error_log("rfollowup:".$rfollowup. " rclient:".$rclient." rcontract:".$rcontract." rcdetails:".$rcdetails." rcvergola:".$rcvergola." rcstatutory:".$rcstatutory." rcitems:".$rcitems." rccontractDeminsions".$rccontractDeminsions , 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_sa\\my-error.log');

    if ($rfollowup AND $rclient AND $rcontract AND $rcdetails AND $rcvergola AND $rcstatutory AND $rcitems AND $rccontractDeminsions and $rcbom and $rcbom_m) {
        mysql_query("COMMIT");
    } else {        
        mysql_query("ROLLBACK");
    }
       

  if($ref!=""){

    header('Location:'.JURI::base().$ref);  
  }else if($is_tender_quote){
    
    header('Location:'.JURI::base().'tender-listing-vic/tender-folder-vic?tenderid='.$retrieve['tenderid']);  
  }else{ 
    header('Location:'.JURI::base().'client-listing-vic/client-folder-vic?cid='.$cust_id);  
  }  

    //header('Location:'.JURI::base().'client-listing-vic/client-folder-vic?cid='.$cust_id);    

}

 
if(isset($_POST['close']))
{   
   
    if($ref!=""){
    header('Location:'.JURI::base().$ref);  
  }else if($is_tender_quote){
    //error_log(' HERE A : ', 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_sa\\my-error.log');
    header('Location:'.JURI::base().'tender-listing-vic/tender-folder-vic?tenderid='.$retrieve['tenderid']);  
  }else{
    //error_log(' HERE B : ', 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_sa\\my-error.log');
    //header('Location:'.JURI::base().'client-listing-vic/client-folder-vic?cid='.$cust_id);  
    header('Location:'.JURI::base().'contract-listing-vic');  
  }  

}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Client Folder</title>
<script src="<?php echo JURI::base().'jscript/jsapi.js'; ?>"></script>
<script src="<?php echo JURI::base().'jscript/jquery.min.js'; ?>"></script>
<script src="<?php echo JURI::base().'jscript/jquery-ui.min.js'; ?>" type="text/javascript"></script>
<script src="<?php echo JURI::base().'jscript/labels.js'; ?>"></script>
<script type="text/javascript" src="<?php echo JURI::base().'jscript/lightbox.js'; ?>"></script>
<script type="text/javascript" src="<?php echo JURI::base().'jscript/tabcontent.js'; ?>"></script>
<link rel="stylesheet" type="text/css" media="screen,projection" href="<?php echo JURI::base().'jscript/custom.css'; ?>" />
<link rel="stylesheet" type="text/css" media="screen,projection" href="<?php echo JURI::base().'jscript/new-enquiry.css'; ?>" />
<link rel="stylesheet" type="text/css" media="screen,projection" href="<?php echo JURI::base().'jscript/client-folder.css'; ?>" />
<link rel="stylesheet" type="text/css" media="screen,projection" href="<?php echo JURI::base().'jscript/contract-folder.css'; ?>" />
<link rel="stylesheet" type="text/css" media="screen,projection" href="<?php echo JURI::base().'jscript/lightbox.css'; ?>" />
<!--
<script src="<?php echo JURI::base().'jscript/jquery-ui-1.11.4/jquery-ui.min.js'; ?>"></script> 
<link rel="stylesheet" type="text/css" media="screen,projection" href="<?php echo JURI::base().'jscript/jquery-ui-1.11.4/jquery-ui.min.css'; ?>" />
 -->

<style>
.tbl-letters tr:nth-child(1), #tbl-letters2 tr:nth-child(1), #tbl-letters3 tr:nth-child(1) {
  display: none;
}

.tbl-pdf td:nth-child(1), #tbl-letters td:nth-child(1), #tbl-letters2 td:nth-child(1), #tbl-letters3 td:nth-child(1) {
  width: 180px;
}

.tbl-pdf td:nth-child(2), #tbl-letters td:nth-child(2), #tbl-letters2 td:nth-child(2), #tbl-letters3 td:nth-child(2) {
  width: 90px;
}

.tbl-pdf td:nth-child(3), #tbl-letters td:nth-child(3), #tbl-letters2 td:nth-child(3), #tbl-letters3 td:nth-child(3) {
  width: 140px;
}

.tbl-pdf tr th{
  padding: 5px;
}

#template_link {
  background-color: #4285F4;
  border: 1px solid #026695;
  color: #FFFFFF;
  cursor: pointer;
  margin: 5px 0;
  padding: 5px;
  width: auto;
  display: inline-block;
}

.tbl-pdf td{
  padding: 5px;
}
</style>
</head>

<body>
<form method="post" enctype="multipart/form-data" class="Chronoform hasValidation" id="chronoform_Client_Folder_Vic">
<input type='hidden' name='doc_id' id='doc_id' / >
<input type='hidden' name='upload_type' id='upload_type' / >
<input type='hidden' name='user_group' id='user_group' value="<?php echo $user_group; ?>" / >
<div id="tabs_wrapper" class="client-builder-tab">
  <div id="tabs_container">
    <ul id="client-builder-tabs" class="shadetabs">
      <li><a href="#" rel="client" class="selected" id="list-detail">Client Details</a></li>
    </ul>
  </div>
  <div id="tabs_content_container"> 
    
    <!-- Client Tab --> 
    <div id="client" class="tab_content" style="display: block;">
    <?php if (true){ //set true bec. all clients are all in one table and no need switch table for different id. ?>
      <div id="client-layer">
         <p><?php echo $retrieve['clientid']; ?></p>

        <?php //process user_access_profiles
        if ($current_signed_in_user_access_profiles['tab client details']['edit'] == true) {
        ?>
            <?php if ($retrieve['is_builder'] == "1"){ ?>
            <p><?php echo $retrieve['builder_name']; ?>  &nbsp; <a href ="<?php echo JURI::base()."new-client-enquiry-vic?pid={$retrieve['pid']}&client_type=b"; ?> ">Edit</a></p>
            <?php }else{ ?>
            <p><?php echo $ClientTitle; ?> <?php echo $ClientFirstName; ?> <?php echo $ClientLastName; ?> &nbsp; <a href ="<?php echo JURI::base()."new-client-enquiry-vic?pid={$retrieve['pid']}"; ?> ">Edit</a></p>
            <?php } ?>
        <?php } //end if?>
        <p><?php echo $BuilderContact; ?></p>
        <p>
          <?php if ($ClientStreetNo!='') {echo $ClientStreetNo; } else {echo "";} ?>
          <?php if ($ClientStreetName!='') {echo "&nbsp;" .$ClientStreetName. "&nbsp;"; } else {echo "";} ?>        
        </p>
        <p><?php echo $ClientAddress1; ?></p>
        <?php if ($ClientAddress2!='') {echo "<p>" . $ClientAddress2 . "</p>";} else {echo "";} ?>
        <!--- Client Suburb -->
        <p><?php echo $ClientSuburb; ?> <?php echo $ClientState; ?> <?php echo $ClientPostCode; ?></p>
        <!-- End of Client Suburb --> 
        
        <!-- Info Filing : Telephone, Other, Email Info -->
        <?php if ($ClientHPhone!='') {echo "<p><label class='info'>Home Phone</label>: " .$ClientHPhone. "</p>"; } else {echo "";} ?>
        <?php if ($ClientWPhone!='') {echo "<p><label class='info'>Work Phone</label>: " .$ClientWPhone. "</p>"; } else {echo "";} ?>
        <?php if ($ClientMobile!='') {echo "<p><label class='info'>Mobile</label>: " .$ClientMobile. "</p>"; } else {echo "";} ?>
        <?php if ($ClientOther!='') {echo "<p><label class='info'>Other</label>: " .$ClientOther. "</p>"; } else {echo "";} ?>
        <?php if ($ClientEmail!='') {echo "<p><label class='info'>Email</label>: " .$ClientEmail. "</p>"; } else {echo "";} ?>
        <!-- End of Info Filing -->
        
        <div class='site-address' > <h1 >Site Address:</h1> 
            <p> <?php echo $SiteTitle ; ?> <?php echo $SiteFirstName; ?> <?php echo $SiteLastName; ?>  </p>
            <?php if ( $SiteSiteName!='') {echo "<p>" .  $SiteSiteName . "</p>";} else {echo "";} ?>
            <p><?php echo $BuildContact; ?> </p>
            <p>   
              <?php if ($SiteStreetNo!='') {echo $SiteStreetNo; } else {echo "";} ?>
              <?php if ($SiteStreetName!='') {echo "&nbsp;" .$SiteStreetName. "&nbsp;"; } else {echo "";} ?>        
            </p>
            <p><?php echo $SiteAddress1; ?></p>
            <?php if ( $SiteAddress2!='') {echo "<p>" .  $SiteAddress2 . "</p>";} else {echo "";} ?>
            <!--- Site Suburb -->
            <p><?php echo $SiteSuburb; ?> <?php echo $SiteState; ?> <?php echo $SitePostcode; ?></p>
        </div>
     <?php } else { ?>
        <div id="client-layer">
        <p><?php echo $BuildName; ?> </p>
        <p><?php echo $BuildAddress1; ?></p>
        <?php if ($BuildAddress2!='') {echo "<p>" . $BuildAddress2 . "</p>";} else {echo "";} ?>
        <!--- Client Suburb -->
        <p><?php echo $BuildSuburb; ?> <?php echo $BuildState; ?> <?php echo $BuildPostCode; ?></p>
        <!-- End of Client Suburb --> 
        
        <!-- Info Filing : Telephone, Fax, Email Info -->
        <?php if ($BuildWPhone!='') {echo "<p><label class='info'>Work Phone</label>: " .$BuildWPhone. "</p>"; } else {echo "";} ?>
        <?php if ($BuildMobile!='') {echo "<p><label class='info'>Mobile</label>: " .$BuildMobile. "</p>"; } else {echo "";} ?>
        <?php if ($BuildFax!='') {echo "<p><label class='info'>Fax</label>: " .$BuildFax. "</p>"; } else {echo "";} ?>
        <?php if ($BuildEmail!='') {echo "<p><label class='info'>Email</label>: " .$BuildEmail. "</p>"; } else {echo "";} ?>
        <!-- End of Info Filing -->   
        <div class="site-address"> <h1 class="section-heading">Site Address:</h1>
        <p><?php echo $BuildContact; ?> </p>
        <p><?php echo $SiteAddress1; ?></p>
        <?php if ( $SiteAddress2!='') {echo "<p>" .  $SiteAddress2 . "</p>";} else {echo "";} ?>
        <!--- Site Suburb --->
        <p><?php echo $SiteSuburb; ?> <?php echo $SiteState; ?> <?php echo $SitePostcode; ?></p>
        
         <!-- Info Filing : Telephone, Other, Email Info -->
        <?php if ($SiteHPhone!='') {echo "<p><label class='info'>Home Phone</label>: " .$SiteHPhone. "</p>"; } else {echo "";} ?>
        <?php if ($SiteWPhone!='') {echo "<p><label class='info'>Work Phone</label>: " .$SiteWPhone. "</p>"; } else {echo "";} ?>
        <?php if ($SiteMobile!='') {echo "<p><label class='info'>Mobile</label>: " .$SiteMobile. "</p>"; } else {echo "";} ?>
        <?php if ($SiteOther!='') {echo "<p><label class='info'>Other</label>: " .$SiteOther. "</p>"; } else {echo "";} ?>
        <?php if ($SiteEmail!='') {echo "<p><label class='info'>Email</label>: " .$SiteEmail. "</p>"; } else {echo "";} ?>
        <!-- End of Info Filing -->
      </div>
     <?php } ?>
    </div>
  </div>
  <!--- End of Site Address --> 
  
</div>
</div>


<!-------------------------------------------------------- Info Quotes -------------------------------------------------------->
<div id="tabs_wrapper" class="tab_content quote-tab">
    <?php if($page_name=="maintenancefolder"){ 
        include "maintenance_details_vic.php";
    }else{  
        //error_log("was here: 0", 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_sa\\my-error.log'); 
        include "contract_details_vic.php";     
    } ?>

</div>    
     

<!------------------------------------------------------------- Enquiry Tracker Tab ------------------------------------------------>
<div id="tabs_wrapper" class="info-tab">
  <div id="tabs_container">
    <ul id="tracker-tabs" class="shadetabs">
      <li><a href="#" rel="tracker" class="selected">Enquiry Tracker</a></li>
      <li><a href="#" rel="standard">Vergola Standard</a></li>
      <li><a href="#" rel="statutory">Statutory Approval</a></li>
      <li><a href="#" rel="contract-cancellation">Contract Cancellation</a></li>
    </ul>
  </div>
  <div id="tabs_content_container">
  
  <!--- Start of Enquiry Tracker -->
    <div id="tracker" class="tab_content">
      <p>
        <label class="info">Date Entered</label>
        : <?php echo $DateLodged; ?></p>
      <p>
        <label class="info">Sales Rep</label>
        : <?php echo $RepName; ?></p>
      <p>
        <label class="info">Lead Type</label>
        : <?php echo $LeadName; ?></p>
      <p>
        <label class="info">Taken By</label>
        : <?php echo $EmployeeID; ?></p>
      <p>
        <label class="info">Appointment</label>
        : <?php echo $AppointmentLodged; ?></p>   
  
    
      <?php $resultproject = mysql_query("SELECT cf_id, quotedate, qdelivered, ffdate1, ffdate2, ffdate3, project_name, status FROM ver_chronoforms_data_followup_vic WHERE quoteid  = '$QuoteID' AND projectid = '$projectid' ORDER BY quotedate DESC" );
        while ($project = mysql_fetch_array($resultproject)) {
        echo "<h1 class=\"siteproject\">Project Name: {$project['project_name']}</h1>".
         "<span class=\"ffinfo\"><label>Quote Date</label>:".date(PHP_DFORMAT,strtotime($project['quotedate']))."</span>";
         if ($project['qdelivered'] != "") { echo "<span class=\"ffinfo\"><label>Quote Delivered</label>:".date(PHP_DFORMAT,strtotime($project['qdelivered']))."</span>"; }
         else {echo "";}
         if ($project['ffdate1'] != "") { echo "<span class=\"ffinfo\"><label>Follow Up 1</label>:".date(PHP_DFORMAT,strtotime($project['ffdate1']))."</span>"; }
         else {echo "";}
         if ($project['ffdate2'] != "") { echo "<span class=\"ffinfo\"><label>Follow Up 2</label>:".date(PHP_DFORMAT,strtotime($project['ffdate2']))."</span>"; }
         else {echo "";}
         if ($project['ffdate3'] != "") { echo "<span class=\"ffinfo\"><label>Follow Up 3</label>:".date(PHP_DFORMAT,strtotime($project['ffdate3']))."</span>"; }
         else {echo "";}
         echo "<span class=\"ffinfo\"><label>Status</label>: {$project['status']}</span>";
         $cf_id = $project['cf_id'];
        }   ?>
    </div>
    <!-- End of Enquiry Tracker -->

    <?php

    $result = mysql_query("SELECT * FROM ver_chronoforms_data_contract_details_vic WHERE quoteid = '$cust_id' and projectid = '$ListProjectID'" ); 
    $contract_detail = mysql_fetch_array($result); 

    // $sql = "SELECT *, DATE_FORMAT(check_measure_date,'".SQL_DFORMAT."') fcheck_measure_date, DATE_FORMAT(recheck_measure_date,'".SQL_DFORMAT."') frecheck_measure_date, DATE_FORMAT(drawing_prepare_date,'".SQL_DFORMAT."') fdrawing_prepare_date, DATE_FORMAT(drawing_prepare_date_followup,'".SQL_DFORMAT."') fdrawing_prepare_date_followup, DATE_FORMAT(drawing_approve_date,'".SQL_DFORMAT."') fdrawing_approve_date, DATE_FORMAT(drawing_approve_date_followup,'".SQL_DFORMAT."') fdrawing_approve_date_followup, DATE_FORMAT(building_permit_issued,'".SQL_DFORMAT."') fbuilding_permit_issued, DATE_FORMAT(production_start_date,'".SQL_DFORMAT."') fproduction_start_date, DATE_FORMAT(production_complete_date,'%d-%b-%Y') fproduction_complete_date, DATE_FORMAT(client_notified_date,'%d-%b-%Y') fclient_notified_date, DATE_FORMAT(erector_notified_date,'".SQL_DFORMAT."') ferector_notified_date, DATE_FORMAT(warranty_start_date,'".SQL_DFORMAT."') fwarranty_start_date, DATE_FORMAT(warranty_end_date,'".SQL_DFORMAT."') fwarranty_end_date, DATE_FORMAT(job_start_date,'".SQL_DFORMAT."') fjob_start_date, DATE_FORMAT(job_start_date_followup,'".SQL_DFORMAT."') fjob_start_date_followup, DATE_FORMAT(job_end_date,'".SQL_DFORMAT."') fjob_end_date, DATE_FORMAT(final_inspection_date,'".SQL_DFORMAT."') ffinal_inspection_date, DATE_FORMAT(fw_orderdate,'".SQL_DFORMAT."') ffw_orderdate, DATE_FORMAT(fw_complete,'".SQL_DFORMAT."') ffw_complete, DATE_FORMAT(install_date,'".SQL_DFORMAT."') finstall_date, DATE_FORMAT(gutter_flashing_ordered,'".SQL_DFORMAT."') fgutter_flashing_ordered, DATE_FORMAT(louvers_ordered,'".SQL_DFORMAT."') flouvers_ordered, DATE_FORMAT(louvers_complete,'".SQL_DFORMAT."') flouvers_complete, DATE_FORMAT(handover_date,'".SQL_DFORMAT."') fhandover_date, DATE_FORMAT(time_frame_letter,'".SQL_DFORMAT."') ftime_frame_letter, DATE_FORMAT(schedule_completion,'".SQL_DFORMAT."') fschedule_completion  FROM ver_chronoforms_data_contract_vergola_vic WHERE quoteid = '$cust_id' and projectid = '$ListProjectID'"; 

        $sql = "SELECT *, DATE_FORMAT(check_measure_date,'".SQL_DFORMAT."') fcheck_measure_date, DATE_FORMAT(recheck_measure_date,'".SQL_DFORMAT."') frecheck_measure_date, DATE_FORMAT(drawing_prepare_date,'".SQL_DFORMAT."') fdrawing_prepare_date, DATE_FORMAT(drawing_prepare_date_followup,'".SQL_DFORMAT."') fdrawing_prepare_date_followup, DATE_FORMAT(drawing_approve_date,'".SQL_DFORMAT."') fdrawing_approve_date, DATE_FORMAT(drawing_approve_date_followup,'".SQL_DFORMAT."') fdrawing_approve_date_followup, DATE_FORMAT(building_permit_issued,'".SQL_DFORMAT."') fbuilding_permit_issued, DATE_FORMAT(production_start_date,'".SQL_DFORMAT."') fproduction_start_date, DATE_FORMAT(production_complete_date,'%d-%b-%Y') fproduction_complete_date, DATE_FORMAT(client_notified_date,'%d-%b-%Y') fclient_notified_date, DATE_FORMAT(erector_notified_date,'".SQL_DFORMAT."') ferector_notified_date, DATE_FORMAT(warranty_start_date,'".SQL_DFORMAT."') fwarranty_start_date, DATE_FORMAT(warranty_end_date,'".SQL_DFORMAT."') fwarranty_end_date, DATE_FORMAT(job_start_date,'".SQL_DFORMAT."') fjob_start_date, DATE_FORMAT(job_start_date_followup,'".SQL_DFORMAT."') fjob_start_date_followup, DATE_FORMAT(job_end_date,'".SQL_DFORMAT."') fjob_end_date, DATE_FORMAT(final_inspection_date,'".SQL_DFORMAT."') ffinal_inspection_date, DATE_FORMAT(fw_orderdate,'".SQL_DFORMAT."') ffw_orderdate, DATE_FORMAT(fw_complete,'".SQL_DFORMAT."') ffw_complete, DATE_FORMAT(install_date,'".SQL_DFORMAT."') finstall_date, DATE_FORMAT(gutter_flashing_ordered,'".SQL_DFORMAT."') fgutter_flashing_ordered, DATE_FORMAT(louvers_ordered,'".SQL_DFORMAT."') flouvers_ordered, DATE_FORMAT(louvers_complete,'".SQL_DFORMAT."') flouvers_complete, DATE_FORMAT(handover_date,'".SQL_DFORMAT."') fhandover_date, DATE_FORMAT(time_frame_letter,'".SQL_DFORMAT."') ftime_frame_letter, DATE_FORMAT(schedule_completion,'".SQL_DFORMAT."') fschedule_completion, DATE_FORMAT( cancellation_date, '".SQL_DFORMAT."' ) fcancellation_date, DATE_FORMAT( cancellation_fee_amount, '".SQL_DFORMAT."' ) fcancellation_fee_amount, DATE_FORMAT( balanceowning_amount, '".SQL_DFORMAT."' ) fbalanceowning_amount, DATE_FORMAT( cancellationpaid_date, '".SQL_DFORMAT."' ) fcancellationpaid_date FROM ver_chronoforms_data_contract_vergola_vic WHERE quoteid = '$cust_id' and projectid = '$ListProjectID'"; 

    $result = mysql_query($sql); 
    $contract_vergola = mysql_fetch_array($result); 
    //error_log("contract_vergola: ".print_r($contract_vergola), 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_sa\\my-error.log'); 
//error_log("sql: ".$sql, 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_sa\\my-error.log'); 

    // $sql = "SELECT *, DATE_FORMAT(planning_application_date,'".SQL_DFORMAT."') AS fplanning_application_date, DATE_FORMAT(planning_approval_date,'".SQL_DFORMAT."') AS fplanning_approval_date, DATE_FORMAT(warranty_insurance_date,'".SQL_DFORMAT."') AS fwarranty_insurance_date, DATE_FORMAT(certifier_date,'".SQL_DFORMAT."') AS fcertifier_date, DATE_FORMAT(bldg_rules_application,'".SQL_DFORMAT."') AS fbldg_rules_application, DATE_FORMAT(bldg_rules_approval,'".SQL_DFORMAT."') AS fbldg_rules_approval, DATE_FORMAT(da_date,'".SQL_DFORMAT."') AS fda_date, DATE_FORMAT(permit_application_date,'".SQL_DFORMAT."') AS fpermit_application_date, DATE_FORMAT(stat_req_easement_waterboard_approval_date,'".SQL_DFORMAT."') AS fstat_req_easement_waterboard_approval_date, DATE_FORMAT(stat_req_easement_waterboard_followup,'".SQL_DFORMAT."') AS fstat_req_easement_waterboard_followup, DATE_FORMAT(stat_req_easement_council_approval_date,'".SQL_DFORMAT."') AS fstat_req_easement_council_approval_date, DATE_FORMAT(stat_req_easement_council_followup,'".SQL_DFORMAT."') AS fstat_req_easement_council_followup, DATE_FORMAT(stat_req_planning_approval_date,'".SQL_DFORMAT."') AS fstat_req_planning_approval_date, DATE_FORMAT(engineering_approved_date,'".SQL_DFORMAT."') AS fengineering_approved_date, DATE_FORMAT(engineering_approved_date_followup,'".SQL_DFORMAT."') AS fengineering_approved_date_followup, DATE_FORMAT(permit_approved_date,'".SQL_DFORMAT."') AS fpermit_approved_date, DATE_FORMAT(m_o_d_followup,'".SQL_DFORMAT."') AS fm_o_d_followup, DATE_FORMAT(citb,'".SQL_DFORMAT."') AS fcitb, DATE_FORMAT(dev_application_date,'".SQL_DFORMAT."') AS fdev_application_date, DATE_FORMAT(planning_application_followup,'".SQL_DFORMAT."') AS fplanning_application_followup FROM ver_chronoforms_data_contract_statutory_vic WHERE quoteid = '$cust_id' and projectid = '$ListProjectID'";

    $sql = "
        SELECT 
            *, 
            planning_dates_enabled AS fplanning_dates_enabled,
            DATE_FORMAT(planning_application_date,'".SQL_DFORMAT_21."') AS fplanning_application_date, 
            DATE_FORMAT(planning_approval_date,'".SQL_DFORMAT_21."') AS fplanning_approval_date, 
            bldg_rules_dates_enabled AS fbldg_rules_dates_enabled,
            DATE_FORMAT(bldg_rules_application,'".SQL_DFORMAT_21."') AS fbldg_rules_application, 
            DATE_FORMAT(bldg_rules_approval,'".SQL_DFORMAT_21."') AS fbldg_rules_approval, 
            dev_dates_enabled AS fdev_dates_enabled,
            DATE_FORMAT(dev_application_date,'".SQL_DFORMAT_21."') AS fdev_application_date, 
            DATE_FORMAT(dev_approval_date,'".SQL_DFORMAT_21."') AS fdev_approval_date, 
            warranty_insurance_dates_enabled AS fwarranty_insurance_dates_enabled,
            DATE_FORMAT(warranty_insurance_date,'".SQL_DFORMAT_21."') AS fwarranty_insurance_date, 
            engineering_dates_enabled AS fengineering_dates_enabled,
            DATE_FORMAT(engineering_application_date,'".SQL_DFORMAT_21."') AS fengineering_application_date, 
            DATE_FORMAT(engineering_approved_date,'".SQL_DFORMAT_21."') AS fengineering_approved_date,  
            DATE_FORMAT(certifier_date,'".SQL_DFORMAT."') AS fcertifier_date, 
            DATE_FORMAT(permit_application_date,'".SQL_DFORMAT."') AS fpermit_application_date, 
            DATE_FORMAT(stat_req_easement_waterboard_approval_date,'".SQL_DFORMAT."') AS fstat_req_easement_waterboard_approval_date, 
            DATE_FORMAT(stat_req_easement_waterboard_followup,'".SQL_DFORMAT."') AS fstat_req_easement_waterboard_followup, 
            DATE_FORMAT(stat_req_easement_council_approval_date,'".SQL_DFORMAT."') AS fstat_req_easement_council_approval_date, 
            DATE_FORMAT(stat_req_easement_council_followup,'".SQL_DFORMAT."') AS fstat_req_easement_council_followup, 
            DATE_FORMAT(stat_req_planning_approval_date,'".SQL_DFORMAT."') AS fstat_req_planning_approval_date, 
            DATE_FORMAT(engineering_approved_date_followup,'".SQL_DFORMAT."') AS fengineering_approved_date_followup, 
            DATE_FORMAT(permit_approved_date,'".SQL_DFORMAT."') AS fpermit_approved_date, 
            DATE_FORMAT(m_o_d_followup,'".SQL_DFORMAT."') AS fm_o_d_followup, 
            DATE_FORMAT(citb,'".SQL_DFORMAT."') AS fcitb, 
            DATE_FORMAT(planning_application_followup,'".SQL_DFORMAT."') AS fplanning_application_followup,

            DATE_FORMAT(planning_followup_date,'".SQL_DFORMAT_21."') AS fplanning_followup_date, 
            DATE_FORMAT(bldg_rules_followup_date,'".SQL_DFORMAT_21."') AS fbldg_rules_followup_date, 
            DATE_FORMAT(dev_followup_date,'".SQL_DFORMAT_21."') AS fdev_followup_date, 
            DATE_FORMAT(warranty_insurance_followup_date,'".SQL_DFORMAT_21."') AS fwarranty_insurance_followup_date, 
            DATE_FORMAT(engineering_followup_date,'".SQL_DFORMAT_21."') AS fengineering_followup_date,

            planning_followup_bywhom AS fplanning_followup_bywhom,
            bldg_rules_followup_bywhom AS fbldg_rules_followup_bywhom,
            dev_followup_bywhom AS fdev_followup_bywhom,
            warranty_insurance_followup_bywhom AS fwarranty_insurance_followup_bywhom,
            engineering_followup_bywhom AS fengineering_followup_bywhom



        FROM ver_chronoforms_data_contract_statutory_vic 
        WHERE quoteid = '$cust_id' 
        AND projectid = '$ListProjectID'
    ";

    $result = mysql_query($sql); 
    $contract_stat = mysql_fetch_array($result);
    $RetCouncil = $contract_stat['council'];
    ?>

    
     <!--- Start of Vergola Standard -->
    <?php
    $disabled_div_class = 'disabled-div';
    //process user_access_profiles
    if ($current_signed_in_user_access_profiles['tab vergola standard']['edit'] == true) {
        $disabled_div_class = '';
    }
    $cbo_drawingfollowupby = "<select    name=\"drawingfollowupby\" id=\"drawingfollowupbyid\"  style='width:104%; padding:0px'><option value=''>Drawing Followup Person: </option>"; 
    // $querysub="SELECT * FROM ver_chronoforms_data_installer_vic Where block=0 ORDER BY name ASC";
    $querysub="SELECT u.block,u.`name`,g.group_id FROM ver_users AS u JOIN ver_user_usergroup_map AS g ON u.id=g.user_id WHERE (g.group_id=26 OR g.group_id=30 OR g.group_id=29 OR g.group_id=28 OR g.group_id=27 OR g.group_id=9) AND u.block=0";
    $resultsub = mysql_query($querysub);
        if(!$resultsub){die ("Could not query the database: <br />" . mysql_error()); }

    while ($data=mysql_fetch_assoc($resultsub)){  

        if($data['name']==$contract_vergola['drawing_followup_by']){ 
            $cbo_drawingfollowupby .= "<option value = \"".addslashes($data['name'])."\" selected>{$data['name']}</option>";
        }else{
            $cbo_drawingfollowupby .= "<option value = \"".addslashes($data['name'])."\">{$data['name']}</option>";
        } 
    }
    $cbo_drawingfollowupby .= "</select>"; 

    $cbo_clientnotifiedby = "<select    name=\"clientnotifiedby\" id=\"clientnotifiedbyid\"  style='width:104%; padding:0px'><option value=''>Client Notified By: </option>"; 
    // $querysub="SELECT * FROM ver_chronoforms_data_installer_vic Where block=0 ORDER BY name ASC";
    $querysub="SELECT u.block,u.`name`,g.group_id FROM ver_users AS u JOIN ver_user_usergroup_map AS g ON u.id=g.user_id WHERE (g.group_id=26 OR g.group_id=30 OR g.group_id=29 OR g.group_id=28 OR g.group_id=27 OR g.group_id=9) AND u.block=0";
    $resultsub = mysql_query($querysub);
        if(!$resultsub){die ("Could not query the database: <br />" . mysql_error()); }

    while ($data=mysql_fetch_assoc($resultsub)){  

        if($data['name']==$contract_vergola['client_notified_by']){ 
            $cbo_clientnotifiedby .= "<option value = \"".addslashes($data['name'])."\" selected>{$data['name']}</option>";
        }else{
            $cbo_clientnotifiedby .= "<option value = \"".addslashes($data['name'])."\">{$data['name']}</option>";
        } 
    }
    $cbo_clientnotifiedby .= "</select>";
    ?>
    <div id="standard" class="tab_content <?php echo $disabled_div_class; ?>">
    <!--
    <div id="standard" class="tab_content <?php echo ($is_operation_manager || $is_system_admin || $is_account_user ? "":"disabled-div"); ?>">
    -->
      <span class="vs-label"><label>Deposit Paid:</label> <input type="text" id="depositdate" name="deposit_paid_amount" class="" value="<?php echo $deposit_paid_amount; ?>" /> <input type="text" id="depositdate" name="deposit_paid" class="date_entered" autocomplete="off" value="<?php if ($DepositDate!="") {echo date(PHP_DFORMAT,strtotime($DepositDate)); } else {echo "";} ?>"/></span>
      <span class="vs-label"><label>Progress Claim:</label> <input type="text" id="progressclaim" name="progress_claim_amount" class="" value="<?php echo $progress_claim_amount; ?>" /> <input type="text" id="progressclaim" name="progress_claim" class="date_entered" autocomplete="off" value="<?php if ($ProgressClaim!="") {echo date(PHP_DFORMAT,strtotime($ProgressClaim)); } else {echo "";} ?>"/></span>
      <span class="vs-label"><label>Final Payment:</label> <input type="text" id="finalpayment" name="final_payment_amount" class="" value="<?php echo $final_payment_amount; ?>" /> <input type="text" id="finalpayment" name="final_payment" class="date_entered" autocomplete="off" style="margin-left:4px;" value="<?php if ($FinalPayment!="") {echo date(PHP_DFORMAT,strtotime($FinalPayment)); } else {echo "";} ?>"/></span>
      <?php if(HOST_SERVER!="LA"){ ?>
      <span class="vs-label"><label>Variation:</label> <input type="text" id="" name="variation_amount" class="" value="<?php echo $variation_amount; ?>" /> <input type="text" id="" name="variation_date" class="date_entered" autocomplete="off" style="margin-left:4px;" value="<?php if ($variation_date!="") {echo date(PHP_DFORMAT,strtotime($variation_date)); } else {echo "";} ?>"/></span> 
      <?php } ?>

     
      <?php if(HOST_SERVER=="LA"){ ?>
     
     <!--  <span class="legend"><label>Check Measurer: </label><input type="text" value="<?php echo $contract_vergola['check_measurer']; ?>" id="checkmeasurer" name="checkmeasurer"></span>     -->
    <div class="label-input-row">
        <label class="input legend"><span class="visible">Check Measurer: </span><input type="text" value="<?php echo $contract_vergola['check_measurer']; ?>" name="checkmeasurer" class=" "></label>
        <label class="input checkmeasure"><span class="visible">Check Measure: </span><input type="text" value="<?php echo $contract_vergola['fcheck_measure_date']; ?>" name="checkdate" class="date_entered" autocomplete="off"></label>
        <label class="input recheckmeasure"><span class="visible">Re-Check Measure: </span><input type="text" value="<?php echo $contract_vergola['frecheck_measure_date']; ?>" name="recheckdate" class="date_entered" autocomplete="off"></label> 
    </div>
  
    <div class="label-input-row">
        <label class="input drawingdate"><span class="visible">Drawing & Prep.: </span><input type="text" value="<?php echo $contract_vergola['fdrawing_prepare_date']; ?>" name="drawing_prepare_date" class="date_entered" autocomplete="off"></label>
        <label class="input drawingapprovedatefollowup"><span class="visible">Followup: </span><input type="text" value="<?php echo $contract_vergola['fdrawing_prepare_date_followup']; ?>" name="drawing_prepare_date_followup" class="date_entered" autocomplete="off"></label>
        <label class="input " style="visibility:hidden"><span class="visible">&nbsp; </span><input type="text" value="" name=" " class=" "></label>
    </div>
    
    <div class="label-input-row">
        <label class="input drawingapprovedate"><span class="visible">Drawing Approve: </span><input type="text" value="<?php echo $contract_vergola['fdrawing_approve_date']; ?>" name="drawingapprovedate" class="date_entered" autocomplete="off"></label>
        <label class="input drawingapprovedatefollowup"><span class="visible">Followup: </span><input type="text" value="<?php echo $contract_vergola['fdrawing_approve_date_followup']; ?>" name="drawingapprovedatefollowup" class="date_entered" autocomplete="off"></label>
        <label class="input " style="visibility:hidden"><span class="visible">&nbsp; </span><input type="text" value="" name=" " class=" "></label>
     </div> 

    <div class="label-input-row"> 
        <label class="input productionstart"><span class="visible">Bldg Permit Approve: </span><input type="text" value="<?php echo $contract_vergola['fbuilding_permit_issued']; ?>" name="building_permit_issued" class="date_entered" autocomplete="off"></label>

      <label class="input productionstart"><span class="visible">Production Start: </span><input type="text" value="<?php echo $contract_vergola['fproduction_start_date']; ?>" name="productionstart" class="date_entered" autocomplete="off"></label>
      <label class="input productioncomplete"><span class="visible">Prod. Complete: </span><input type="text" value="<?php echo $contract_vergola['fproduction_complete_date']; ?>" name="productioncomplete" class="date_entered" autocomplete="off"></label>
 
    </div>  

    <div class="label-input-row"> 
        <label class="input ">
            <span class="visible">Framework Ordered:</span>
            <input type="text" value="<?php echo $contract_vergola['ffw_orderdate']; ?>" name="fw_orderdate" class="date_entered" autocomplete="off" style="text-align: right;">
        </label>
        <label class="input checkmeasure">
            <span class="visible">Install Date: </span>
            <input type="text" value="<?php echo $contract_vergola['finstall_date']; ?>" name="install_date" class="date_entered" autocomplete="off">
        </label>
        <label class="input checkmeasure">
            <span class="visible">Installer: </span>
            <input type="text" value="<?php echo $contract_vergola['erectors_name']; ?>" id="erectors" name="erectors_name" style=" "> 
        </label>  
    </div>
  
    <div class="label-input-row">           
      <label class="input clientnotified"><span class="visible">Client Notified: </span><input type="text" value="<?php echo $contract_vergola['fclient_notified_date']; ?>" name="clientnotified" class="date_entered" autocomplete="off"></label>
      <label class="input erectornotified"><span class="visible">Erector Notified: </span><input type="text" value="<?php echo $contract_vergola['ferector_notified_date']; ?>" name="erectornotified" class="date_entered" autocomplete="off"></label>
      <label class="input " style="visibility:hidden"><span class="visible">&nbsp; </span><input type="text" value="" name=" " class=" "></label>
    </div>  
    
    <div class="label-input-row">             
      <label class="input warrantystart"><span class="visible">Warranty Start: </span><input type="text" value="<?php echo $contract_vergola['fwarranty_start_date']; ?>" name="warrantystart" class="date_entered" autocomplete="off"></label>
      <label class="input warrantyend"><span class="visible">Warranty End: </span><input type="text" value="<?php echo $contract_vergola['fwarranty_end_date']; ?>" name="warrantyend" class="date_entered" autocomplete="off"></label>
      <label class="input " style="visibility:hidden"><span class="visible">&nbsp; </span><input type="text" value="" name=" " class=" "></label>
    </div> 

    <div class="label-input-row"> 
      <label class="input jobstart"><span class="visible">Job Start: </span><input type="text" value="<?php echo $contract_vergola['fjob_start_date']; ?>" name="jobstart" class="date_entered" autocomplete="off"></label>
      <label class="input jobstart"><span class="visible">Followup: </span><input type="text" value="<?php echo $contract_vergola['fjob_start_date_followup']; ?>" name="jobstartfollowup" class="date_entered" autocomplete="off"></label>
      <label class="input jobend"><span class="visible">Job End: </span><input type="text" value="<?php echo $contract_vergola['fjob_end_date']; ?>" name="jobend" class="date_entered" autocomplete="off"></label>
       
    </div>  

    <div class="label-input-row"> 
       <label class="input jobend"><span class="visible">Final Inspection: </span><input type="text" value="<?php echo $contract_vergola['ffinal_inspection_date']; ?>" name="final_inspection_date" class="date_entered" autocomplete="off" style=" " ></label> 
       <label class="input " style="visibility:hidden"><span class="visible">&nbsp; </span><input type="text" value="" name=" " class=" "></label>
       <label class="input " style="visibility:hidden"><span class="visible">&nbsp; </span><input type="text" value="" name=" " class=" "></label>
    </div> 
     
    <?php }else{ ?> 

           <div class="label-input-row">
            <label class="input legend"><span class="visible">Check Measurer: </span><input type="text" value="<?php echo $contract_vergola['check_measurer']; ?>" name="checkmeasurer" class=" "></label>
            <label class="input checkmeasure"><span class="visible">Check Measure: </span><input type="text" value="<?php echo $contract_vergola['fcheck_measure_date']; ?>" name="checkdate" class="date_entered" autocomplete="off"></label>
            <label class="input recheckmeasure"><span class="visible">Re-Check Measure: </span><input type="text" value="<?php echo $contract_vergola['frecheck_measure_date']; ?>" name="recheckdate" class="date_entered" autocomplete="off"></label> 
           </div>

          <div class="label-input-row"> 
             <label class="input jobend"><span class="visible">Time Frame Letter: </span><input type="text" value="<?php echo $contract_vergola['ftime_frame_letter']; ?>" name="time_frame_letter" class="date_entered" autocomplete="off" style=" " ></label> 
             <label class="input " style="visibility:hidden"><span class="visible">&nbsp; </span><input type="text" value="" name=" " class=" "></label>
             <label class="input " style="visibility:hidden"><span class="visible">&nbsp; </span><input type="text" value="" name=" " class=" "></label>
          </div> 

          <div class="label-input-row">
            <label class="input drawingdate"><span class="visible">Drawing & Prep.: </span><input type="text" value="<?php echo $contract_vergola['fdrawing_prepare_date']; ?>" name="drawing_prepare_date" class="date_entered" autocomplete="off"></label>
              <label class="input drawingapprovedatefollowup"><span class="visible">Followup: </span><input type="text" value="<?php echo $contract_vergola['fdrawing_prepare_date_followup']; ?>" name="drawing_prepare_date_followup" class="date_entered" autocomplete="off"></label>
              <label class="input checkmeasure" > <?php echo $cbo_drawingfollowupby; ?> </label>
          </div>
          <div class="label-input-row">
              <label class="input drawingapprovedate"><span class="visible">Drawing Approve: </span><input type="text" value="<?php echo $contract_vergola['fdrawing_approve_date']; ?>" name="drawingapprovedate" class="date_entered" autocomplete="off"></label>
              <label class="input " style="visibility:hidden"><span class="visible">&nbsp; </span><input type="text" value="" name=" " class=" "></label>
              <label class="input " style="visibility:hidden"><span class="visible">&nbsp; </span><input type="text" value="" name=" " class=" "></label>
          </div>
          <div class="label-input-row">
              <label class="input "><span class="visible">Framework Ordered: </span><input type="text" value="<?php echo $contract_vergola['ffw_orderdate']; ?>" name="fw_orderdate" class="date_entered" autocomplete="off"></label>
              <label class="input "><span class="visible">Gutter/Flashing: </span><input type="text" value="<?php echo $contract_vergola['fgutter_flashing_ordered']; ?>" name="gutter_flashing_ordered" class="date_entered" autocomplete="off"></label>  
              <label class="input "><span class="visible">Louvers Ordered: </span><input type="text" value="<?php echo $contract_vergola['flouvers_ordered']; ?>" name="louvers_ordered" class="date_entered" autocomplete="off"></label> 
           </div> 
 
          <div class="label-input-row"> 
             <label class="input checkmeasure">
              <span class="visible">Framework Complete: </span>
              <input type="text" value="<?php echo $contract_vergola['ffw_complete']; ?>" name="fw_complete" class="date_entered" autocomplete="off">
            </label>   
             <label class="input " style="visibility:hidden"><span class="visible">&nbsp; </span><input type="text" value="" name=" " class=" "></label>
             <label class="input "><span class="visible">Louvers Complete: </span><input type="text" value="<?php echo $contract_vergola['flouvers_complete']; ?>" name="louvers_complete" class="date_entered" autocomplete="off"></label> 
          </div> 

          <div class="label-input-row">  
            <label class="input checkmeasure">
              <span class="visible">Sched. Install Date: </span>
              <input type="text" value="<?php echo $contract_vergola['finstall_date']; ?>" name="install_date" class="date_entered" autocomplete="off">
            </label>
            <label class="input checkmeasure">
              <span class="visible">Sched. Completion: </span>
              <input type="text" value="<?php echo $contract_vergola['fschedule_completion']; ?>" name="schedule_completion" class="date_entered" autocomplete="off">
            </label>
            <label class="input " style="visibility:hidden"><span class="visible">&nbsp; </span><input type="text" value="" name=" " class=" "></label>
              
          </div>

          <?php
            $cbo_installer1 = "<select    name=\"erectors_name\" style='width:107%;'><option value=''>Select Installer 1</option>"; 
            $querysub="SELECT * FROM ver_chronoforms_data_installer_vic ORDER BY name ASC";

                        $resultsub = mysql_query($querysub);
                            if(!$resultsub){die ("Could not query the database: <br />" . mysql_error()); }
                        
                        while ($data=mysql_fetch_assoc($resultsub)){  

                            if($data['name']==$contract_vergola['erectors_name']){ 
                                $cbo_installer1 .= "<option value = \"".addslashes($data['name'])."\" selected>{$data['name']}</option>";
                            }else{
                                $cbo_installer1 .= "<option value = \"".addslashes($data['name'])."\">{$data['name']}</option>";
                            } 
                        }
            $cbo_installer1 .= "</select>"; 


            $cbo_installer2 = "<select name=\"erectors_name2\" style='width:107%;'><option value=''>Select Installer 2</option>";  
                        mysql_data_seek($resultsub, 0);   
                          
                        while ($data=mysql_fetch_assoc($resultsub)){  

                            if($data['name']==$contract_vergola['erectors_name2']){ 
                                $cbo_installer2 .= "<option value = \"".addslashes($data['name'])."\" selected>{$data['name']}</option>";
                            }else{
                                $cbo_installer2 .= "<option value = \"".addslashes($data['name'])."\">{$data['name']}</option>";
                            } 
                        }
            $cbo_installer2 .= "</select>"; 

          ?> 

          <div class="label-input-row"> 
            <label class="input checkmeasure"> 
                <!-- <input type="text" value="<?php echo $contract_vergola['erectors_name']; ?>" id="erectors" name="erectors_name" style=" ">  -->
                <?php echo $cbo_installer1; ?>
            </label>
            <label class="input checkmeasure" style="visibility:hidden"> 
                <!-- <input type="text" value="<?php echo $contract_vergola['erectors_name2']; ?>" id="erectors2" name="erectors_name2" style=" ">  -->
                <?php echo $cbo_installer2; ?>
            </label>
            <label class="input " style="visibility:hidden"><span class="visible">&nbsp; </span><input type="text" value="" name=" " class=" "></label>

        </div>
            
          <div class="label-input-row">       
            <label class="input clientnotified"><span class="visible">Client Notified: </span><input type="text" value="<?php echo $contract_vergola['fclient_notified_date']; ?>" name="clientnotified" class="date_entered" autocomplete="off"></label>
            <label class="input checkmeasure" > <?php echo $cbo_clientnotifiedby; ?> </label>
            <label class="input erectornotified"><span class="visible">Installer Notified: </span><input type="text" value="<?php echo $contract_vergola['ferector_notified_date']; ?>" name="erectornotified" class="date_entered" autocomplete="off"></label>
            <!-- <label class="input " style="visibility:hidden"><span class="visible">&nbsp; </span><input type="text" value="" name=" " class=" "></label> -->
          </div>  
          
          <div class="label-input-row"> 
            <label class="input jobstart"><span class="visible">Job Start: </span><input type="text" value="<?php echo $contract_vergola['fjob_start_date']; ?>" name="jobstart" class="date_entered" autocomplete="off"></label> 
            <label class="input jobend"><span class="visible">Job Complete: </span><input type="text" value="<?php echo $contract_vergola['fjob_end_date']; ?>" name="jobend" class="date_entered" autocomplete="off"></label>  
            <?php if(HOST_SERVER=="Victoria"){ ?>
            <label class="input jobend"><span class="visible">Handover:</span><input type="text" value="<?php echo $contract_vergola['fhandover_date']; ?>" name="handover_date" class="date_entered" autocomplete="off" style=" " ></label>
            <?php }else{ ?>
              <label class="input " style="visibility:hidden"><span class="visible">&nbsp; </span><input type="text" value="" name=" " class=" "></label>
            <?php } ?>
          </div>

          <div class="label-input-row">
            <?php if(HOST_SERVER=="Victoria"){ ?>
             <label class="input jobend"><span class="visible">Final Inspection: </span><input type="text" value="<?php echo $contract_vergola['ffinal_inspection_date']; ?>" name="final_inspection_date" class="date_entered" autocomplete="off" style=" " ></label>  
            <?php }else{ ?>
              <label class="input jobend"><span class="visible">Handover:</span><input type="text" value="<?php echo $contract_vergola['fhandover_date']; ?>" name="handover_date" class="date_entered" autocomplete="off" style=" " ></label>
            <?php } ?>           
            <label class="input warrantystart"><span class="visible">Warranty Start: </span><input type="text" value="<?php echo $contract_vergola['fwarranty_start_date']; ?>" name="warrantystart" class="date_entered" autocomplete="off"></label>
            <label class="input warrantyend"><span class="visible">Warranty End: </span><input type="text" value="<?php echo $contract_vergola['fwarranty_end_date']; ?>" name="warrantyend" class="date_entered" autocomplete="off"></label>

            <label class="input ">
                <span class="visible">Con Note #: </span>
                <input type="text" value="<?php echo $contract_stat['contract_note_number']; ?>" name="con_note_number" id="con_note_number" class=""  >                
            </label>
            <label class="input controllersn"><span class="visible">Controller SN: </span><input type="text" value="<?php echo $contract_vergola['controller_sn']; ?>" name="controllersn" class=" "></label>
            <label class="input controllerpw"><span class="visible">Controller PW: </span><input type="text" value="<?php echo $contract_vergola['controller_pw']; ?>" name="controllerpw" class=" "></label>
          </div>  
    <?php } ?>
     
    </div>
    <!-- End of Vergola Standard --->
    
    <!--- Start of Statutory Approval -->
    <?php
    $disabled_div_class = 'disabled-div';
    //process user_access_profiles
    if ($current_signed_in_user_access_profiles['tab statutory approval']['edit'] == true) {
        $disabled_div_class = '';
    }
    ?>
    <div id="statutory" class="tab_content <?php echo $disabled_div_class; ?>">
    <!--
    <div id="statutory" class="tab_content  <?php echo ($is_operation_manager || $is_system_admin || $is_account_user ? "":"disabled-div"); ?>">
    -->
        <!--
        <?php if(HOST_SERVER=="Victoria" || HOST_SERVER=="LA"){ ?>
            <div class="label-input-row">  
                <input type="hidden" name="council" id="council" value="By Vergola" />
                <label class="input planningdate"><span class="visible">Plan. Application: </span><input type="text"  name="planningdate" id="planningdateid" class="date_entered" value="<?php echo $contract_stat['fplanning_application_date']; ?>"></label>
                <label class="input planningapprove"><span class="visible">Plan. Approval: </span><input type="text" value="<?php echo $contract_stat['fplanning_approval_date']; ?>" name="planningapprove" id="planningapproveid" class="date_entered"></label>
                <label class="input " style="visibility:hidden"><span class="visible">&nbsp; </span><input type="text" value="" name=" " class=" "></label>
            </div>

            <div class="label-input-row"> 
                <label class="input warrantyinsurance"><span class="visible">Warranty Insurance:</span><input type="text" value="<?php echo $contract_stat['fwarranty_insurance_date']; ?>" name="warrantyinsurance" id="warrantyinsuranceid" class="date_entered" style="text-align:right;"/></label>
           
                <label class="input cerfifier"><span class="visible">Certifier: </span><input type="text" value="<?php echo $contract_stat['fcertifier_date']; ?>" name="certifier" id="certifierid" class="date_entered"></label>
                <label class="input " style="visibility:hidden"><span class="visible">&nbsp; </span><input type="text" value="" name=" " class=" "></label>
            </div>
                
            <div class="label-input-row">       
                <label class="input development"><span class="visible">Development Approval: </span><input type="text" value="<?php echo $contract_stat['fda_date']; ?>" name="development" id="developmentid" class="date_entered"></label> 
                <label class="input " style=" ">
                    <span class="visible">Permit Application: </span><input type="text" style="  " value="<?php echo $contract_stat['fpermit_application_date']; ?>" name="permit_application_date" id="permit_application_date" class="date_entered" /></label> 
                    <label class="input " style="visibility:hidden"><span class="visible">&nbsp; </span><input type="text" value="" name=" " class=" "></label>
            </div>

            <div class="label-input-row">   
                <label class="input " style=" ">
                <span class="visible" style="color:#111;">Stat. Req. Ease. : Waterboard</span> 
                </label>  
                <label class="input " style=" ">    
                    <span class="visible">Approval Date: </span><input type="text" style=" " value="<?php echo $contract_stat['fstat_req_easement_waterboard_approval_date']; ?>" name="stat_req_easement_waterboard_approval_date" id="stat_req_easement_waterboard_approval_date" class="date_entered" />  
                </label>  
                <label class="input " style=" ">    
                    <span class="visible">Followup: </span><input type="text" style=" " value="<?php echo $contract_stat['fstat_req_easement_waterboard_followup']; ?>" name="stat_req_easement_waterboard_followup" id="stat_req_easement_waterboard_followup" class="date_entered" />  
                </label> 
            </div> 

            <div class="label-input-row">   
                <label class="input " style=" ">
                <span class="visible" style="color:#111;">Stat. Req. Ease. : Council</span> 
                </label>  
                <label class="input " style=" ">    
                    <span class="visible">Approval Date: </span><input type="text" style=" " value="<?php echo $contract_stat['fstat_req_easement_council_approval_date']; ?>" name="stat_req_easement_council_approval_date" id="stat_req_easement_council_approval_date" class="date_entered" />   
                </label>  
                <label class="input " style=" ">    
                    <span class="visible">Followup: </span><input type="text" style=" " value="<?php echo $contract_stat['fstat_req_easement_council_followup']; ?>" name="stat_req_easement_council_followup" id="stat_req_easement_council_followup" class="date_entered" />   
                </label> 
            </div> 
     
            <div class="label-input-row"> 
                    <label class="input " style=" width:40%;" > 
                        <span class="visible">Stat. Req. Planning:</span>  
                        <select name='stat_req_planning' style="padding:2px 2px 2px 115px;"><option value="T" <?php echo ($contract_stat['stat_req_planning']=='T' ? 'selected':''); ?> >Town Planning</option><option value="R" <?php echo ($contract_stat['stat_req_planning']=='R' ? 'selected':''); ?> >Report and Consent</option><option value="TR" <?php echo ($contract_stat['stat_req_planning']=='TR' ? 'selected':''); ?> >Both</option></select>
                    </label>

                    <label class="input " style="margin-left:10px;"  >      
                        <span class="visible">Approval:</span><input type="text" style="  " value="<?php echo $contract_stat['fstat_req_planning_approval_date']; ?>" name="stat_req_planning_approval_date" id="stat_req_planning_approval_date" class="date_entered" />
                     
                    </label> 
                     
            </div>

            <div class="label-input-row"> 
                <label class="input planningdate"><span class="visible">Eng. Approved: </span><input type="text" style="text-align:right;" name="engineering_approved_date" id="engineering_approved_date" class="date_entered" value="<?php echo $contract_stat['fengineering_approved_date']; ?>" ></label>

                <label class="input " style=" ">
                    <span class="visible">Followup: </span><input type="text" style=" " value="<?php echo $contract_stat['fengineering_approved_date_followup']; ?>" name="engineering_approved_date_followup" id="engineering_approved_date_followup" class="date_entered" />   
                </label> 

                <label class="input planningapprove"><span class="visible">Permit Approved: </span><input type="text"  style="width:65px;" value="<?php echo $contract_stat['fpermit_approved_date']; ?>" name="permit_approved_date" id="permit_approved_date" class="date_entered"></label>
               
            </div>

            <div class="label-input-row"> 

                <label class="input " > MOD: <select name='m_o_d' style="width: 75%; "><option <?php echo ($contract_stat['m_o_d']=='Yes' ? 'selected':''); ?> >Yes</option><option <?php echo ($contract_stat['m_o_d']=='No' ? 'selected':''); ?> >No</option></select>  </label>

                <label class="input " style=" ">    
                    <span class="visible">Followup: </span><input type="text" style=" " value="<?php echo $contract_stat['fm_o_d_followup']; ?>" name="m_o_d_followup" id="m_o_d_followup" class="date_entered" />   
                </label> 

                <label class="input ">
                    <span class="visible">Con Note #: </span>
                    <input type="text" value="<?php echo $contract_stat['contract_note_number']; ?>" name="con_note_number" id="con_note_number" class=""  >                
                </label>
                
                
            </div>  

        <?php }else{ ?>

            <div class="label-input-row">   
                <label class="input warrantyinsurance"><span class="visible">Indemnity Insurance: </span><input type="text" value="<?php echo $contract_stat['fwarranty_insurance_date']; ?>" name="warrantyinsurance" class="date_entered"></label>  
                <label class="input"><span class="visible">CITB: </span><input type="text" value="<?php echo $contract_stat['fcitb']; ?>" name="citb" class="date_entered"></label>
                <label class="input " style="visibility:hidden"><span class="visible">&nbsp; </span><input type="text" value="" name=" " class=" "></label>
            </div>

            <div class="label-input-row">  
        <label class="input cerfifier"><span class="visible">Bldg. Rules App.: </span><input type="text" value="<?php echo $contract_stat['fbldg_rules_application']; ?>" name="bldg_rules_application" id="" class="date_entered"></label> 
            <label class="input cerfifier"><span class="visible">Bldg. Rules Approval: </span><input type="text" value="<?php echo $contract_stat['fbldg_rules_approval']; ?>" name="bldg_rules_approval" id="" class="date_entered"></label> 
                <label class="input " style="visibility:hidden"><span class="visible">&nbsp; </span><input type="text" value="" name=" " class=" "></label>
            </div>

            <div class="label-input-row">  
                <label class="input development"><span class="visible">Dev. Approval: </span><input type="text" value="<?php echo $contract_stat['fda_date']; ?>" name="development" id="" class="date_entered"></label>
                <label class="input " style="visibility:hidden"><span class="visible">&nbsp; </span><input type="text" value="" name=" " class=" "></label>
                <label class="input " style="visibility:hidden"><span class="visible">&nbsp; </span><input type="text" value="" name=" " class=" "></label>
            </div>  

        <?php } ?>
        -->


        <!-- begin: enable/disable date fields settings -->
        <link rel="stylesheet" href="/jscript/custom_datepicker_1/datepicker_1.css" type="text/css" />
        <script type="text/javascript" src="<?php echo JURI::base().'jscript/date_field_entry_switch.js'; ?>"></script>
        <script type="text/javascript">
        var target_date_fields_11 = [
            {
                "date_enabler":{"field_id":"planning_dates_enabled", "field_value":"<?php echo $contract_stat['fplanning_dates_enabled']; ?>"}, 
                "date_fields": [
                    {"field_id":"planning_application_date", "field_value":"<?php echo $contract_stat['fplanning_application_date']; ?>"}, 
                    {"field_id":"planning_approval_date", "field_value":"<?php echo $contract_stat['fplanning_approval_date']; ?>"},
                    {"field_id":"planning_followup_date", "field_value":"<?php echo $contract_stat['fplanning_followup_date']; ?>"},
                    {"field_id":"planningfollowupbywhomid", "field_value":"<?php echo $contract_stat['fplanning_followup_bywhom']; ?>"}
                ]
            }, 
            {
                "date_enabler":{"field_id":"bldg_rules_dates_enabled", "field_value":"<?php echo $contract_stat['fbldg_rules_dates_enabled']; ?>"}, 
                "date_fields": [
                    {"field_id":"bldg_rules_application", "field_value":"<?php echo $contract_stat['fbldg_rules_application']; ?>"}, 
                    {"field_id":"bldg_rules_approval", "field_value":"<?php echo $contract_stat['fbldg_rules_approval']; ?>"},
                    {"field_id":"bldg_rules_followup_date", "field_value":"<?php echo $contract_stat['fbldg_rules_followup_date']; ?>"},
                    {"field_id":"bldgrulesfollowupbywhomid", "field_value":"<?php echo $contract_stat['fbldg_rules_followup_bywhom']; ?>"}
                ]
            }, 
            {
                "date_enabler":{"field_id":"dev_dates_enabled", "field_value":"<?php echo $contract_stat['fdev_dates_enabled']; ?>"}, 
                "date_fields": [
                    {"field_id":"dev_application_date", "field_value":"<?php echo $contract_stat['fdev_application_date']; ?>"}, 
                    {"field_id":"dev_approval_date", "field_value":"<?php echo $contract_stat['fdev_approval_date']; ?>"},
                    {"field_id":"dev_followup_date", "field_value":"<?php echo $contract_stat['fdev_followup_date']; ?>"},
                    {"field_id":"devfollowupbywhomid", "field_value":"<?php echo $contract_stat['fdev_followup_bywhom']; ?>"}
                ]
            }, 
            {
                "date_enabler":{"field_id":"warranty_insurance_dates_enabled", "field_value":"<?php echo $contract_stat['fwarranty_insurance_dates_enabled']; ?>"}, 
                "date_fields": [
                    {"field_id":"warranty_insurance_date", "field_value":"<?php echo $contract_stat['fwarranty_insurance_date']; ?>"},
                    {"field_id":"warranty_insurance_followup_date", "field_value":"<?php echo $contract_stat['fwarranty_insurance_followup_date']; ?>"},
                    {"field_id":"warrantyinsurancefollowupbywhomid", "field_value":"<?php echo $contract_stat['fwarranty_insurance_followup_bywhom']; ?>"}
                ]
            }, 
            {
                "date_enabler":{"field_id":"engineering_dates_enabled", "field_value":"<?php echo $contract_stat['fengineering_dates_enabled']; ?>"}, 
                "date_fields": [
                    {"field_id":"engineering_application_date", "field_value":"<?php echo $contract_stat['fengineering_application_date']; ?>"}, 
                    {"field_id":"engineering_approved_date", "field_value":"<?php echo $contract_stat['fengineering_approved_date']; ?>"},
                    {"field_id":"engineering_followup_date", "field_value":"<?php echo $contract_stat['fengineering_followup_date']; ?>"},
                    {"field_id":"engineeringfollowupbywhomid", "field_value":"<?php echo $contract_stat['fengineering_followup_bywhom']; ?>"}
                ]
            }
        ];
        </script>
        <!-- end: enable/disable date fields settings -->

        <!-- begin: For the Follow-up DropDown -->
        <?php
          $cbo_planningfollowupby = "<select    name=\"planningfollowupbywhom\" id=\"planningfollowupbywhomid\"  style=''><option value=''>Follow-up by: </option>"; 
          // $querysub="SELECT * FROM ver_chronoforms_data_installer_vic Where block=0 ORDER BY name ASC";
          $querysub="SELECT u.block,u.`name`,g.group_id FROM ver_users AS u JOIN ver_user_usergroup_map AS g ON u.id=g.user_id WHERE (g.group_id=26 OR g.group_id=30 OR g.group_id=29 OR g.group_id=28 OR g.group_id=27 OR g.group_id=9) AND u.block=0";
          $resultsub = mysql_query($querysub);
              if(!$resultsub){die ("Could not query the database: <br />" . mysql_error()); }

          while ($data=mysql_fetch_assoc($resultsub)){  

              if($data['name']==$contract_stat['planning_followup_bywhom']){ 
                  $cbo_planningfollowupby .= "<option value = \"".addslashes($data['name'])."\" selected>{$data['name']}</option>";
              }else{
                  $cbo_planningfollowupby .= "<option value = \"".addslashes($data['name'])."\">{$data['name']}</option>";
              } 
          }
          $cbo_planningfollowupby .= "</select>"; 

          $cbo_bldgrulesfollowupby = "<select    name=\"bldgrulesfollowupbywhom\" id=\"bldgrulesfollowupbywhomid\"  style=''><option value=''>Follow-up by: </option>"; 
          // $querysub="SELECT * FROM ver_chronoforms_data_installer_vic Where block=0 ORDER BY name ASC";
          $querysub="SELECT u.block,u.`name`,g.group_id FROM ver_users AS u JOIN ver_user_usergroup_map AS g ON u.id=g.user_id WHERE (g.group_id=26 OR g.group_id=30 OR g.group_id=29 OR g.group_id=28 OR g.group_id=27 OR g.group_id=9) AND u.block=0";
          $resultsub = mysql_query($querysub);
              if(!$resultsub){die ("Could not query the database: <br />" . mysql_error()); }

          while ($data=mysql_fetch_assoc($resultsub)){  

              if($data['name']==$contract_stat['bldg_rules_followup_bywhom']){ 
                  $cbo_bldgrulesfollowupby .= "<option value = \"".addslashes($data['name'])."\" selected>{$data['name']}</option>";
              }else{
                  $cbo_bldgrulesfollowupby .= "<option value = \"".addslashes($data['name'])."\">{$data['name']}</option>";
              } 
          }
          $cbo_bldgrulesfollowupby .= "</select>"; 

          $cbo_devfollowupby = "<select    name=\"devfollowupbywhom\" id=\"devfollowupbywhomid\"  style=''><option value=''>Follow-up by: </option>"; 
          // $querysub="SELECT * FROM ver_chronoforms_data_installer_vic Where block=0 ORDER BY name ASC";
          $querysub="SELECT u.block,u.`name`,g.group_id FROM ver_users AS u JOIN ver_user_usergroup_map AS g ON u.id=g.user_id WHERE (g.group_id=26 OR g.group_id=30 OR g.group_id=29 OR g.group_id=28 OR g.group_id=27 OR g.group_id=9) AND u.block=0";
          $resultsub = mysql_query($querysub);
              if(!$resultsub){die ("Could not query the database: <br />" . mysql_error()); }

          while ($data=mysql_fetch_assoc($resultsub)){  

              if($data['name']==$contract_stat['dev_followup_bywhom']){ 
                  $cbo_devfollowupby .= "<option value = \"".addslashes($data['name'])."\" selected>{$data['name']}</option>";
              }else{
                  $cbo_devfollowupby .= "<option value = \"".addslashes($data['name'])."\">{$data['name']}</option>";
              } 
          }
          $cbo_devfollowupby .= "</select>"; 

          $cbo_warrantyinsurancefollowupby = "<select    name=\"warrantyinsurancefollowupbywhom\" id=\"warrantyinsurancefollowupbywhomid\"  style=''><option value=''>Follow-up by: </option>"; 
          // $querysub="SELECT * FROM ver_chronoforms_data_installer_vic Where block=0 ORDER BY name ASC";
          $querysub="SELECT u.block,u.`name`,g.group_id FROM ver_users AS u JOIN ver_user_usergroup_map AS g ON u.id=g.user_id WHERE (g.group_id=26 OR g.group_id=30 OR g.group_id=29 OR g.group_id=28 OR g.group_id=27 OR g.group_id=9) AND u.block=0";
          $resultsub = mysql_query($querysub);
              if(!$resultsub){die ("Could not query the database: <br />" . mysql_error()); }

          while ($data=mysql_fetch_assoc($resultsub)){  

              if($data['name']==$contract_stat['warranty_insurance_followup_bywhom']){ 
                  $cbo_warrantyinsurancefollowupby .= "<option value = \"".addslashes($data['name'])."\" selected>{$data['name']}</option>";
              }else{
                  $cbo_warrantyinsurancefollowupby .= "<option value = \"".addslashes($data['name'])."\">{$data['name']}</option>";
              } 
          }
          $cbo_warrantyinsurancefollowupby .= "</select>"; 

          $cbo_engineeringfollowupby = "<select    name=\"engineeringfollowupbywhom\" id=\"engineeringfollowupbywhomid\"  style=''><option value=''>Follow-up by: </option>"; 
          // $querysub="SELECT * FROM ver_chronoforms_data_installer_vic Where block=0 ORDER BY name ASC";
          $querysub="SELECT u.block,u.`name`,g.group_id FROM ver_users AS u JOIN ver_user_usergroup_map AS g ON u.id=g.user_id WHERE (g.group_id=26 OR g.group_id=30 OR g.group_id=29 OR g.group_id=28 OR g.group_id=27 OR g.group_id=9) AND u.block=0";
          $resultsub = mysql_query($querysub);
              if(!$resultsub){die ("Could not query the database: <br />" . mysql_error()); }

          while ($data=mysql_fetch_assoc($resultsub)){  

              if($data['name']==$contract_stat['engineering_followup_bywhom']){ 
                  $cbo_engineeringfollowupby .= "<option value = \"".addslashes($data['name'])."\" selected>{$data['name']}</option>";
              }else{
                  $cbo_engineeringfollowupby .= "<option value = \"".addslashes($data['name'])."\">{$data['name']}</option>";
              } 
          }
          $cbo_engineeringfollowupby .= "</select>"; 
        ?> 
        <!-- end: For the Follow-up DropDown -->
                

<!-- begin statutory table -->
<div class="label-input-row" > 
  <input type="hidden" name="council" id="council" value="By Vergola" />
  <table class="table-statutory" style="font-size:12px; " ><tbody>
    <tr  class="" >
      <th width=""></th>
      <th width="5%" style="text-align: center;">Required</th>
      <th width="15%" style="text-align: center;">Application</th>
      <th width="15%" style="text-align: center;">Follow up</th>
      <th width="25%" style="text-align: center;">By Whom</th>
      <th width="15%" style="text-align: center;">Approval</th>
    </tr>
    <tr>
      <td width="">Planning</td>
        <td>
          <select class="visible" style="" name="planning_dates_enabled" id="planning_dates_enabled" class="" onchange="switchDateFieldEntryStatus(target_date_fields_11, this.id, this.value)">
              <option value="Yes">Yes</option>
              <option value="No">No</option>
          </select></td>
        <td><label class="input planningdate" ><input type="text" name="planning_application_date" id="planning_application_date" class="" value="" style="text-align: center;" autocomplete="off"></label></td>
        <td><label class="input planningdate" ><span class=""></span><input type="text" name="planning_followup_date" id="planning_followup_date" class="" value="" style="text-align: center;" autocomplete="off"></label></td>
        <td><label class="input " > 
          <?php echo $cbo_planningfollowupby; ?>
        </label></td>
        <td><label class="input planningapprove"><span class=""></span><input type="text" name="planning_approval_date" id="planning_approval_date" class="" value="" style="text-align: center;" autocomplete="off"></label></td>
      </tr>

      <tr><td width="">Building Rules</td>
        <td><select class="visible" style="" name="bldg_rules_dates_enabled" id="bldg_rules_dates_enabled" class="" onchange="switchDateFieldEntryStatus(target_date_fields_11, this.id, this.value)">
            <option value="Yes">Yes</option>
            <option value="No">No</option>
        </select></td>
        <td><label class="input planningdate" ><input type="text" name="bldg_rules_application" id="bldg_rules_application" class="" value="" style="text-align: center;" autocomplete="off"></label></td>
        <td><label class="input planningdate" ><span class=""></span><input type="text" name="bldg_rules_followup_date" id="bldg_rules_followup_date" class="" value="" style="text-align: center;" autocomplete="off"></label></td>
        <td><label class="input " > 
          <?php echo $cbo_bldgrulesfollowupby; ?>
        </label></td>
        <td><label class="input planningapprove"><span class=""></span><input type="text" name="bldg_rules_approval" id="bldg_rules_approval" class="" value="" style="text-align: center;" autocomplete="off"></label></td></tr>

      <tr><td width="">Development</td>
        <td><select class="visible" style="" name="dev_dates_enabled" id="dev_dates_enabled" class="" onchange="switchDateFieldEntryStatus(target_date_fields_11, this.id, this.value)">
            <option value="Yes">Yes</option>
            <option value="No">No</option>
        </select></td>
        <td><label class="input planningdate" ><input type="text" name="dev_application_date" id="dev_application_date" class="" value="" style="text-align: center;" autocomplete="off"></label></td>
        <td><label class="input planningdate" ><span class=""></span><input type="text" name="dev_followup_date" id="dev_followup_date" class="" value="" style="text-align: center;" autocomplete="off"></label></td>
        <td><label class="input " > 
          <?php echo $cbo_devfollowupby; ?>
        </label></td>
        <td><label class="input planningapprove"><span class=""></span><input type="text" name="dev_approval_date" id="dev_approval_date" class="" value="" style="text-align: center;" autocomplete="off"></label></td></tr>
        
      <tr><td width="">Indemnity</td>
        <td><select class="visible" style="" name="warranty_insurance_dates_enabled" id="warranty_insurance_dates_enabled" class="" onchange="switchDateFieldEntryStatus(target_date_fields_11, this.id, this.value)">
            <option value="Yes">Yes</option>
            <option value="No">No</option>
        </select></td>
        <td><label class="input planningdate" ><input type="text" name="warranty_insurance_date" id="warranty_insurance_date" class="" value="" style="text-align: center;" autocomplete="off"></label></td>
        <td><label   class="input planningdate" ><span class=""></span><input type="text" name="warranty_insurance_followup_date" id="warranty_insurance_followup_date" class="" value="" style="text-align: center;" autocomplete="off"></label></td>
        <td><label class="input " > 
          <?php echo $cbo_warrantyinsurancefollowupby; ?>
        </label></td>
        <td><label  class="input planningapprove" ><span class=""></span><input type="text" name="warranty_insurance_approveddate" id="warranty_insurance_approveddate" class="" value="" style="text-align: center;visibility:hidden" autocomplete="off"></label></td></tr>

        <tr><td width="">Engineering</td>
          <td><select class="visible" style="" name="engineering_dates_enabled" id="engineering_dates_enabled" class="" onchange="switchDateFieldEntryStatus(target_date_fields_11, this.id, this.value)">
              <option value="Yes">Yes</option>
              <option value="No">No</option>
          </select></td>
          <td><label class="input planningdate" ><input type="text" name="engineering_application_date" id="engineering_application_date" class="" value="" style="text-align: center;" autocomplete="off"></label></td>
          <td><label class="input planningdate" ><span class=""></span><input type="text" name="engineering_followup_date" id="engineering_followup_date" class="" value="" style="text-align: center;" autocomplete="off"></label></td>
          <td><label class="input " > 
            <?php echo $cbo_engineeringfollowupby; ?>
          </label></td>
          <td><label class="input planningapprove"><span class=""></span><input type="text" name="engineering_approved_date" id="engineering_approved_date" class="" value="" style="text-align: center;" autocomplete="off"></label></td></tr>

  </tbody></table>
</div>

<!-- end statutory table -->
<!--         <div class="label-input-row">   
            <label class="input " ><span class="visible" >Enable Date Entry: </span>
                <select class="visible" style="width:60px; text-align:left;margin-left: 120px" name="planning_dates_enabled" id="planning_dates_enabled" class="" onchange="switchDateFieldEntryStatus(target_date_fields_11, this.id, this.value)">
                    <option value="Yes">Yes</option>
                    <option value="No">No</option>
                </select>          
            </label>
            <label class="input planningdate"><span class="visible">Planning Appl.: </span><input type="text" name="planning_application_date" id="planning_application_date" class="" value="" style="text-align: right;" autocomplete="off"></label>
            <label class="input planningapprove"><span class="visible">Planning Appr.: </span><input type="text" name="planning_approval_date" id="planning_approval_date" class="" value="" style="text-align: right;" autocomplete="off"></label>
        </div>

        <div class="label-input-row">  
            <label class="input " ><span class="visible" >Enable Date Entry: </span>
                <select class="visible" style="width:60px; text-align:left;margin-left: 120px" name="bldg_rules_dates_enabled" id="bldg_rules_dates_enabled" class="" onchange="switchDateFieldEntryStatus(target_date_fields_11, this.id, this.value)">
                    <option value="Yes">Yes</option>
                    <option value="No">No</option>
                </select>          
            </label>
            <label class="input cerfifier"><span class="visible">Building Rules Appl.: </span><input type="text" name="bldg_rules_application" id="bldg_rules_application" class="" value="" style="text-align: right;" autocomplete="off"></label> 
            <label class="input cerfifier"><span class="visible">Building Rules Appr.: </span><input type="text" name="bldg_rules_approval" id="bldg_rules_approval" class="" value="" style="text-align: right;" autocomplete="off"></label> 
        </div>

        <div class="label-input-row">  
            <label class="input " ><span class="visible" >Enable Date Entry: </span>
                <select class="visible" style="width:60px; text-align:left;margin-left: 120px" name="dev_dates_enabled" id="dev_dates_enabled" class="" onchange="switchDateFieldEntryStatus(target_date_fields_11, this.id, this.value)">
                    <option value="Yes">Yes</option>
                    <option value="No">No</option>
                </select>          
            </label>
            <label class="input planningdate"><span class="visible">Development Appl.: </span><input type="text" name="dev_application_date" id="dev_application_date" class="" value="" style="text-align: right;" autocomplete="off"></label>
            <label class="input planningdate"><span class="visible">Development Appr.: </span><input type="text" name="dev_approval_date" id="dev_approval_date" class="" value="" style="text-align: right;" autocomplete="off"></label>
        </div>  

        <div class="label-input-row">   
            <label class="input " ><span class="visible" >Enable Date Entry: </span>
                <select class="visible" style="width:60px; text-align:left;margin-left: 120px" name="warranty_insurance_dates_enabled" id="warranty_insurance_dates_enabled" class="" onchange="switchDateFieldEntryStatus(target_date_fields_11, this.id, this.value)">
                    <option value="Yes">Yes</option>
                    <option value="No">No</option>
                </select>          
            </label>
            <label class="input warrantyinsurance"><span class="visible">Indemnity Insurance: </span><input type="text" name="warranty_insurance_date" id="warranty_insurance_date" class="" value="" style="text-align: right;" autocomplete="off"></label>  
            <label class="input " style="visibility:hidden"><span class="visible">&nbsp; </span><input type="text" value="" name=" " class=" "></label>
        </div>

        <div class="label-input-row"> 
            <label class="input " ><span class="visible" >Enable Date Entry: </span>
                <select class="visible" style="width:60px; text-align:left;margin-left: 120px" name="engineering_dates_enabled" id="engineering_dates_enabled" class="" onchange="switchDateFieldEntryStatus(target_date_fields_11, this.id, this.value)">
                    <option value="Yes">Yes</option>
                    <option value="No">No</option>
                </select>          
            </label>
            <label class="input planningdate"><span class="visible">Engineering Appl.: </span><input type="text" name="engineering_application_date" id="engineering_application_date" class="" value="" style="text-align: right;" autocomplete="off"></label>
            <label class="input planningdate"><span class="visible">Engineering Appr.: </span><input type="text" name="engineering_approved_date" id="engineering_approved_date" class="" value="" style="text-align: right;" autocomplete="off"></label>
        </div> -->

    </div>
    <!-- End of Statutory Approval -->

    <!--- Start of Contract Cancellation -->   

     
      <?php
      $disabled_div_class = 'disabled-div';
      //process user_access_profiles
      if ($current_signed_in_user_access_profiles['tab contract cancellation']['edit'] == true) {
          $disabled_div_class = '';
      }
      ?>
      <div id="contract-cancellation" class="tab_content <?php echo $disabled_div_class; ?>">

      <span class="vs-label"><label style="width: 120px;">Cancellation Date</label>
          <td >&nbsp;&nbsp; <input style="text-align: right; width: 120px;" type="text" id="cancellation_date" name="cancellation_date" class="date_entered" value="<?php echo $contract_vergola['fcancellation_date']; ?>" /> </td>        
      </span>

      <span class="vs-label"><label style="width: 120px;">Cancellation Fee</label> 
          <td>&#36; <input style="text-align: right; width: 120px;" type="text"  name="cancellation_fee_amount" class="cancellation_fee_amount" value="<?php echo $contract_vergola['cancellation_fee_amount']; ?>" /> </td>
          </span>

      <span class="vs-label"><label style="width: 120px;">Deposit Paid</label> 
          <td>&#36; <input style="text-align: right; width: 120px;" type="text" disabled="disabled"  name="deposit_paid_amount" class="deposit_paid_amount" value="<?php echo $deposit_paid_amount; ?>" /> </td>
          </span>
        
        <span class="vs-label"><label style="width: 120px;">Balance Owning</label>
          <td>&#36; <input style="text-align: right; width: 120px;" type="text" disabled="disabled"  id="balanceowning_amount" name="balanceowning_amount" class="balanceowning_amount" value="<?php echo $contract_vergola['balanceowning_amount']; ?>" /> </td>
          </span>

        <span class="vs-label" ><label style="width: 120px;">Cancellation Paid</label>
          <td >&nbsp;&nbsp; <input style="text-align: right; width: 120px;" type="text" id="cancellationpaid_date" name="cancellationpaid_date" class="date_entered" value="<?php echo $contract_vergola['fcancellationpaid_date']; ?>" /> </td>        
      </span>

    <div class="label-input-row" >
           <label class="input " style="visibility:hidden"><span class="visible" ></span>
             <input type="text"  name="balanceowning_amount" class="balanceowning_amount" id="balanceowning_amount" value="<?php echo $contract_vergola['balanceowning_amount']; ?>" style="width:75px; text-align:left;margin-left: 150px; " ></label>
           <label class="input " style="visibility:hidden"><span class="visible">&nbsp; </span><input type="text" value="" name=" " class=" "></label>
           <label class="input " style="visibility:hidden"><span class="visible">&nbsp; </span><input type="text" value="" name=" " class=" "></label>
          </div>
    
<!--        
      <script type='text/javascript'>      
          // $('.cancellationfee_').on('input', function(){
  $('.cancellation_fee_amount').on('input', function(){
              var form = $(this).closest('form');
             
              var deposit = parseInt(form.find('.deposit_paid_amount').val());           
                      
              var cancellation = parseInt($(this).val());
                          
              form.find('.balanceowning_amount').val(deposit - cancellation);             
             
       
    })
      </script>
 -->
           
     <script type='text/javascript'>      
       //On page load change search value & simulate enter key press
        $(document).ready(function(){
         if ($('#balanceowning_amount').val() <= 0 && $('.deposit_paid_amount').val() > 0 ){
         // if ($('#balanceowning_amount').val() <= 0){
                   // $('#balanceowning_amount').val($('.deposit_paid_amount').val());
                       $('#balanceowning_amount').val($('.deposit_paid_amount').val() - $('.cancellation_fee_amount').val());
                     };
                    $('.cancellation_fee_amount').on('input', function(){
             var form = $(this).closest('form');
            
             var deposit = parseInt(form.find('.deposit_paid_amount').val());           
                     
             var cancellation = parseInt($(this).val());
                         
             form.find('.balanceowning_amount').val(deposit - cancellation);             
           }) 
      
          })
     </script> 

    <!--- End of Contract Cancellation -->
</div>


    
  </div>
</div>






    <!--
    begin: template revamp > initialise program
    -->
    <?php
    include($_SERVER['DOCUMENT_ROOT'] . '/includes/vic/enquiry/document_handler/sql_templates.php');

    $system_base_url = $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['SERVER_NAME'] . ':' . $_SERVER['SERVER_PORT'] . '/';
    $template_base_url = $system_base_url . 'system-management-vic/template-listing-vic/template-manage-vic';
    $current_script_base_url = urlencode($system_base_url . $_SERVER['REQUEST_URI']);

    $template_module = 'template';
    $current_user_info = JFactory::getUser();
    $template_username = $current_user_info->username;
    $template_password = $current_user_info->password;
    $template_status = 'Published';
    $client_id_prefix = 'CR';

    function getTemplateListInHtml($sql_template, $template_module, $template_entity_name, $template_folder_name, $template_content_category, $template_status, $template_download_option, $adhoc_entity_name) {
        $html_text = '';
        $temp_text = '';
        $temp_text2 = '';

        $sql = str_replace(
            array(
                '[MODULE]', 
                '[ENTITY_NAME]', 
                '[FOLDER_NAME]', 
                '[CONTENT_CATEGORY]', 
                '[STATUS]'
            ), 
            array(
                addslashes($template_module), 
                addslashes($template_entity_name), 
                addslashes($template_folder_name), 
                addslashes($template_content_category),  
                addslashes($template_status) 
            ), 
            $sql_template
        );

        $results1 = mysql_query($sql) or die(mysql_error()); 
        $current_index = 0;
        while($rs1 = mysql_fetch_array($results1)) {
            $current_index++;

            $current_template_entity_name = $adhoc_entity_name;
            if ($template_download_option == 'dl') {
                $current_template_entity_name = $rs1['entity_name'];
            }

            $current_template_folder_name = $rs1['folder_name'];
            $current_template_file_id = $rs1['file_id'];
            $current_template_file_name = $rs1['file_name'];
            $current_template_file_external_ref_name = $rs1['file_external_ref_name'];
            if (!is_null($rs1['file_version_external_ref_name'])) {
                $current_template_file_external_ref_name = $rs1['file_version_external_ref_name'];
            }

            $hidden_field_prefix = '';
            if ($template_download_option == 'dl') {
                $hidden_field_prefix = 'edited_';
            }

            $html_text .= '
                <input type="hidden" id="' . $hidden_field_prefix . strtolower($template_folder_name) . '_template_entity_name_' . $current_index . '" value="' . $current_template_entity_name . '" />
                <input type="hidden" id="' . $hidden_field_prefix . strtolower($template_folder_name) . '_template_folder_name_' . $current_index . '" value="' . $current_template_folder_name . '" />
                <input type="hidden" id="' . $hidden_field_prefix . strtolower($template_folder_name) . '_template_file_id_' . $current_index . '" value="' . $current_template_file_id . '" />
                <input type="hidden" id="' . $hidden_field_prefix . strtolower($template_folder_name) . '_template_file_name_' . $current_index . '" value="' . $current_template_file_name . '" />
                <input type="hidden" id="' . $hidden_field_prefix . strtolower($template_folder_name) . '_template_file_external_ref_name_' . $current_index . '" value="' . $current_template_file_external_ref_name . '" />
            ';

            // --- begin adhoc feature > template file version list --- //
            $sql_template_retrieve_template_file_version_list = "
                SELECT 
                    document_handler_file_version.external_ref_name AS 'file_version_external_ref_name', 
                    document_handler_file_version.date_created AS 'file_version_date_created', 
                    ver_users.name AS 'file_version_user_name' 
                FROM document_handler_file 
                    LEFT JOIN document_handler_file_version 
                        ON document_handler_file.id = document_handler_file_version.file_id 
                    LEFT JOIN ver_users 
                        ON document_handler_file_version.user_id = ver_users.id 
                WHERE document_handler_file.id = '[FILE_ID]' 
                AND document_handler_file_version.external_ref_name <> '[FILE_VERSION_EXTERNAL_REF_NAME]' 
                ORDER BY document_handler_file_version.date_created DESC;
            ";

            $temp_text2 = '<option selected value="null"> -- file versions -- </option>';
            $sql = str_replace(
                array(
                    '[FILE_ID]', 
                    '[FILE_VERSION_EXTERNAL_REF_NAME]', 
                ), 
                array(
                    addslashes($current_template_file_id), 
                    addslashes($current_template_file_external_ref_name) 
                ), 
                $sql_template_retrieve_template_file_version_list
            );
            $results2 = mysql_query($sql) or die(mysql_error()); 
            while($rs2 = mysql_fetch_array($results2)) {
                $temp_text2 .= '<option value="' . $rs2['file_version_external_ref_name'] . '">' . $rs2['file_version_date_created'] . ' (' . $rs2['file_version_user_name'] . ')</option>';
            }
            $temp_text2 = '
                <select id="' . $hidden_field_prefix . strtolower($template_folder_name) . '_template_file_version_list_' . $current_index . '" onchange="downloadTemplateFile(\'edited_' . strtolower($template_folder_name) . '\', ' . $current_index . ', \'' . $template_download_option . '\', 1)">' . 
                    $temp_text2 . '
                </select>
            ';
            if (mysql_num_rows($results2) == 0) {
                $temp_text2 = '';
            }
            // --- end adhoc feature > template file version list --- //

            $temp_text = '
                <a id="template_link" rel="nofollow" title="" onclick="downloadTemplateFile(\'' . strtolower($template_folder_name) . '\', ' . $current_index . ', \'' . $template_download_option. '\', 0); return false;" href="" style="margin-right:5px;">' . $current_template_file_name . '</a>
            ';
            if ($template_download_option == 'dl') {
                $temp_text = '
                    <tr style="background-color: #cccccc;">
                        <td><a id="" rel="nofollow" title="" onclick="downloadTemplateFile(\'edited_' . strtolower($template_folder_name) . '\', ' . $current_index . ', \'' . $template_download_option . '\', 0); return false;" href="" style="margin-right:5px;">' . $rs1['file_name'] . '</a></td>
                        <td>' . date('d-M-Y H:i:s', strtotime($rs1['file_version_date_created'])) . ' (' . $rs1['file_version_user_name'] . ')' . '</td>
                        <td>&nbsp;</td>
                        <td>' . $temp_text2 . '</td>
                        <td><a id="" rel="nofollow" title="" onclick="deleteTemplateFile(\'edited_' . strtolower($template_folder_name) . '\', ' . $current_index . '); return false;" href="" style="margin-right:5px;">Delete</a></td>
                    </tr>
                ';
            }

            $html_text .= $temp_text;
        } //end while

        return $html_text;
    }
    ?>
    <script>
        var document_handler_template_config = {
            "module":"<?php echo $template_module; ?>", 
            "username":"<?php echo $template_username; ?>", 
            "password":"<?php echo $template_password; ?>", 
        };

        function downloadTemplateFile(template_section, template_info_index, download_option, option_key) {
            var entity_name = document.getElementById(template_section + '_template_entity_name_' + template_info_index).value;
            var folder_name = document.getElementById(template_section + '_template_folder_name_' + template_info_index).value;
            var file_name = document.getElementById(template_section + '_template_file_name_' + template_info_index).value;
            var file_external_ref_name = document.getElementById(template_section + '_template_file_external_ref_name_' + template_info_index).value;

            if (option_key != 0) {
                file_external_ref_name = document.getElementById(template_section + '_template_file_version_list_' + template_info_index).value;
            }

            var url = '<?php echo $template_base_url; ?>?api_mode=1';
            url += '&api_data={"document_handler_form_operation":"retrieve", "access_mode":"file_download", "module":"' + document_handler_template_config['module'] + '", "download_option":"' + download_option + '", "username":"' + document_handler_template_config['username'] + '", "password":"' + document_handler_template_config['password'] + '", "file_external_ref_name":"' + file_external_ref_name + '", "entity_name":"' + entity_name + '", "folder_name":"' + folder_name + '", "file_name":"' + file_name + '"}';

            if (option_key != 0) {
                if (file_external_ref_name != 'null') {
                    window.location = url;
                }
            } else {
                window.location = url;
            }
        }

        function deleteTemplateFile(template_section, template_info_index) {
            var entity_name = document.getElementById(template_section + '_template_entity_name_' + template_info_index).value;
            var folder_name = document.getElementById(template_section + '_template_folder_name_' + template_info_index).value;
            var file_id = document.getElementById(template_section + '_template_file_id_' + template_info_index).value;
            var file_name = document.getElementById(template_section + '_template_file_name_' + template_info_index).value;
            var file_external_ref_name = document.getElementById(template_section + '_template_file_external_ref_name_' + template_info_index).value;

            var url = '<?php echo $template_base_url; ?>?api_mode=1';
            url += '&api_data={"document_handler_form_operation":"delete", "access_mode":"file_delete", "module":"' + document_handler_template_config['module'] + '", "username":"' + document_handler_template_config['username'] + '", "password":"' + document_handler_template_config['password'] + '", "document_handler_form_file_data_entry":{"document_handler_form_file_id":"' + file_id + '"}}';
            url += '&return_url=<?php echo $current_script_base_url; ?>';
            window.location = url;
        }
    </script>
    <!--
    end: template revamp > initialise program
    -->






 
<!------------------------------------------------- Notes Content Tab -------------------------------------------------------------->
<div id="tabs_wrapper" class="notes-tab">
  <div id="tabs_container">
    <ul id="notes-tabs" class="shadetabs">
      <li><a href="#" rel="notes" class="selected">Notes</a></li>
      <li><a href="#" rel="sales">Sales</a></li>
      <li><a href="#" rel="documents">Correspondence</a></li>
      <li><a href="#" rel="statdocs">Statutory</a></li>
      <li><a href="#" rel="photos">Photos</a></li>  
      <li><a href="#" rel="drawing">Drawings</a></li> 
      <li><a href="#" rel="general">General</a></li> 
      <li><a href="#" rel="special">Special Conditions</a></li>
    </ul>
  </div>
  <div id="tabs_content_container"> 
    
    <!---------------------------------------------------------------- Notes Tab ------------------------------------------------------>
    <!-- Removing This Temporarily ----- <input type='button' name="btnadd" id="btnadd" value='Add Notes' onClick="addRowEntry('tbl-notes');"> -->
    <div id="notes" class="tab_content" style="display: block;">
      
      <table id="tbl-notes">
        <?php $user =& JFactory::getUser(); $userName = $user->get( 'name' ); ?>
        <tr>
          <td class="tbl-content">      
          <div class="layer-date">Date: <input type="text" id="date_display" name="date_display" class="datetime_display" value="<?php print(Date(PHP_DFORMAT)); ?>" readonly>
          <input type="hidden" id="date_notes" name="date_notes[]" class="date_time" value="<?php print(Date(PHP_DFORMAT." H:i:s")); ?>" readonly> 
          </div>
          <div class="layer-whom">By Whom: <input type="text" id="username_notes" name="username_notes[]" class="username" value="<?php echo $userName; ?>" readonly></div>  
      <textarea name="notestxt[]" id="notestxt"></textarea>
          </td> 
        </tr>
      </table>
      <table id="tbl-content">
        <?php
$resultnotes = mysql_query("SELECT cf_id, date_created, username, content FROM ver_chronoforms_data_notes_vic WHERE clientid = '$ClientID' ORDER by cf_id DESC");
$i=1;
if (!$resultnotes) {
    echo 'Could not run query: ' . mysql_error();
    exit;
}

  while($row = mysql_fetch_row($resultnotes))
    {

echo "
<tr><td class=\"tbl-content\"><h1>Notes ". $i++ ."</h1><p>$row[3]</p>
<div class=\"layer-date\">Date: " .date(PHP_DFORMAT, strtotime ($row[1])) . "</div>
<div class=\"layer-whom\">By Whom: $row[2]</div>
</td>
</tr>";
    }
?>
      </table>
    </div>

    
   <!---------------------------------------------------- Sales Tab  -->
    
    <div id="sales" class="tab_content"> 
      <!-- sales template documents section -->
      <!-- hide and make way for revamped template modules
      -->
      <div class="modification-button-holder"> 
          <a id="template_link" rel="nofollow" title="PDF" onclick="window.open(this.href,'win2','status=no,toolbar=no,scrollbars=yes,titlebar=no,menubar=no,resizable=yes,width=auto,height=auto,directories=no,location=no'); return false;" href="index.php?cf_id=<?php echo $cf_id; ?>&pid=<?php echo $ClientID; ?>&option=com_chronoforms&tmpl=component&chronoform=TemplateResidential_With_Frame" style="margin-right:5px;">Residential – Frame</a>
          <a id="template_link" rel="nofollow" title="PDF" onclick="window.open(this.href,'win2','status=no,toolbar=no,scrollbars=yes,titlebar=no,menubar=no,resizable=yes,width=auto,height=auto,directories=no,location=no'); return false;" href="index.php?cf_id=<?php echo $cf_id; ?>&pid=<?php echo $ClientID; ?>&option=com_chronoforms&tmpl=component&chronoform=TemplateResidential_With_No_Frame" style="margin-right:5px;">Residential – No Frame</a> 
          <a id="template_link" href="<?php echo JURI::base().'images/template/welcome_book.pdf'; ?> " download  style="margin-right:5px;">Welcome Book</a>

          <a id="template_link" rel="nofollow" title="PDF" onclick="window.open(this.href,'win2','status=no,toolbar=no,scrollbars=yes,titlebar=no,menubar=no,resizable=yes,width=auto,height=auto,directories=no,location=no'); return false;" href="index.php?cf_id=<?php echo $cf_id; ?>&pid=<?php echo $ClientID; ?>&option=com_chronoforms&tmpl=component&chronoform=Sales_Contract" style="margin-right:5px;">Sales Contract - Residential</a>
          <a id="template_link" rel="nofollow" title="PDF" onclick="window.open(this.href,'win2','status=no,toolbar=no,scrollbars=yes,titlebar=no,menubar=no,resizable=yes,width=auto,height=auto,directories=no,location=no'); return false;" href="index.php?cf_id=<?php echo $cf_id; ?>&pid=<?php echo $ClientID; ?>&option=com_chronoforms&tmpl=component&chronoform=Clients_Authority" style="margin-right:5px;">Clients Authority</a>
          <a id="template_link" rel="nofollow" title="PDF" onclick="window.open(this.href,'win2','status=no,toolbar=no,scrollbars=yes,titlebar=no,menubar=no,resizable=yes,width=auto,height=auto,directories=no,location=no'); return false;" href="index.php?cf_id=<?php echo $cf_id; ?>&pid=<?php echo $ClientID; ?>&option=com_chronoforms&tmpl=component&chronoform=Colour_Chart" style="margin-right:5px;">Colour Chart</a>
          
          <a id="template_link" rel="nofollow" title="PDF" onclick="window.open(this.href,'win2','status=no,toolbar=no,scrollbars=yes,titlebar=no,menubar=no,resizable=yes,width=auto,height=auto,directories=no,location=no'); return false;" href="index.php?cf_id=<?php echo $cf_id; ?>&pid=<?php echo $ClientID; ?>&option=com_chronoforms&tmpl=component&chronoform=Contract_Variation_Letter" style="margin-right:5px;">Contract Variation Letter</a>
      </div>






        <!--
        begin: template revamp > template download list > contract folder > sales
        -->
        <div class="modification-button-holder" style="background-color: #cccccc;">
            <?php
            $template_module = 'template';
            $template_entity_name = 'Contract Folder';
            $template_folder_name = 'Sales';
            $template_content_category = 'Template';
            $template_download_option = 'dl_dm';
            $adhoc_entity_name = $_REQUEST['projectid'];

            $html_text = getTemplateListInHtml(
                $sql_template_retrieve_template_download_list, 
                $template_module, 
                $template_entity_name, 
                $template_folder_name, 
                $template_content_category, 
                $template_status, 
                $template_download_option, 
                $adhoc_entity_name
            );
            echo $html_text;
            ?>
        </div>
        <!--
        end: template revamp > template download list > contract folder > sales
        -->






   
      <div class="drawing-tbl">
        <table class="tbl-pdf">
          <tr>
            <th>Filename</th>
            <th>Date Created</th>
            <th>Download PDF</th>
            <th>Uploaded Doc</th> 
            <th> </th> 
          </tr> 
          <?php 

 // $data = mysql_query("SELECT * FROM ver_chronoforms_data_letters_vic WHERE template_name LIKE '%Residential with%' ORDER BY datecreated DESC") 
 // or die(mysql_error()); 
  $sql = "SELECT * FROM ver_chronoforms_data_letters_vic  WHERE (template_name LIKE '%Residential with%' OR template_name LIKE 'Sales Contract - Residential%' OR template_name LIKE 'Client Authority%' OR template_name LIKE 'Contract Variation Letter%' OR template_name LIKE 'Color Chart%')   AND clientid='{$ClientID}'   ORDER BY datecreated DESC";
   $data = mysql_query($sql); 
//error_log($sql, 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_sa\\my-error.log');
while($info = mysql_fetch_array( $data )) 
{  
      //error_log("db clientid: ".$info['clientid']." ClientID:".$ClientID, 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_sa\\my-error.log');
      Print "<tr>";
      Print "<td> {$info['template_name']}</td> ";
      Print "<td>" . date(PHP_DFORMAT,strtotime($info['datecreated'])) . " </td>";
      Print "<td style='border:none;'><a rel=\"nofollow\" onclick=\"window.open(this.href,'win2','status=no,toolbar=no,scrollbars=yes,titlebar=no,menubar=no,resizable=yes,width=auto,height=auto,directories=no,location=no'); return false;\" href=\"index.php?pid=".$info['cf_id']."?option=com_chronoforms&tmpl=component&chronoform=Download-PDF\">Click Here <img src='".JURI::base()."templates/".$mainframe->getTemplate()."/images/file_pdf.png' /></a></td>";

      echo "<td>";
      if($info['has_upload_file']==1){
          echo '<div> 
                <ul style="list-style-type: none; margin: 5px 0 5px 10px;padding: 0;"  >';
         
            $resultimg = mysql_query("SELECT cf_id, clientid, photo, file_name FROM ver_chronoforms_data_pics_vic WHERE clientid = '$ClientID'  AND (upload_type ='signed_doc' OR upload_type ='signed_sales_doc') AND ref_id={$info['cf_id']} ");
            $thumbnail = "";
            while($row = mysql_fetch_array($resultimg))
            { 
              if(strtolower(substr($row['photo'],-3))=="pdf"){
                  $thumbnail = JURI::base()."images/file_pdf.png";
              }else if(strtolower(substr($row['photo'],-3))=="doc" || substr($row['photo'],-4)=="docx"){
                  $thumbnail = JURI::base()."images/doc_logo.png";
              }else if(strtolower(substr($row['photo'],-3))=="xls" || substr($row['photo'],-4)=="xlsx"){
                  $thumbnail = JURI::base()."images/excel-logo.jpg";
              }else{
                  $thumbnail = JURI::base()."images/file-icon.jpg";
              } 
             echo "<li><a href=\"".$row['photo']."\" download class='remove-link'>  <img src=\"{$thumbnail}\" height=\"20px\" style='display:inline'> ".$row['file_name']."</a>    <span class=\"ui-icon ui-icon-closethick\" style='display:inline-block; cursor: pointer;' onclick=\"if(confirm('Are you sure you want to delete?')){"."$('#picid').val('".$row["cf_id"]."'); $('#btn_picid').click();}\"   > </span></li>";
            }
          echo "</ul>
          </div>";
       
      } 

        //process user_access_profiles
        if ($current_signed_in_user_access_profiles['tab sales']['save'] == true) {
            echo "<input type='file' name='signed_doc[]' multiple='multiple' accept='.jpg,.png,.bmp,.gif,.pdf, .doc, .docx, .xls, .xlsx, .odt'> 
                  <input type='button' value='Save' id='' name='' class='bbtn btn-delete' onclick='$(\"#upload_type\").val(\"signed_sales_doc\"); $(\"#doc_id\").val(\"{$info['cf_id']}\"); $(\"#chronoform_Client_Folder_Vic\").submit();'>  "; 
        } //end if
        echo "</td>"; 

        echo "<td>";
        //process user_access_profiles
        if ($current_signed_in_user_access_profiles['tab sales']['delete'] == true) {
            echo "<a rel=\"nofollow\" onclick=\"delete_pdf_letter(event,this)\" cf_id=\"{$info['cf_id']}\" class='remove-link'  >Delete</a>"; 
        } //end if
        echo "<td>";
        echo "</tr>";
 } 

              $resultimg = mysql_query("SELECT cf_id, clientid, photo, file_name, datestamp FROM ver_chronoforms_data_pics_vic WHERE clientid = '$ClientID'  AND upload_type ='upload_sales_doc' ");
              if (!$resultimg) {
                  echo 'Could not run query: ' . mysql_error();
                  exit;
              }
              $thumbnail = "";
              while($row = mysql_fetch_array($resultimg))
              {
                  if(strtolower(substr($row['photo'],-3))=="pdf"){
                      $thumbnail = JURI::base()."images/file_pdf.png";
                  }else if(strtolower(substr($row['photo'],-3))=="doc" || substr($row['photo'],-4)=="docx"){
                      $thumbnail = JURI::base()."images/doc_logo.png";
                  }else if(strtolower(substr($row['photo'],-3))=="xls" || substr($row['photo'],-4)=="xlsx"){
                      $thumbnail = JURI::base()."images/excel-logo.jpg";
                  }else{
                      $thumbnail = JURI::base()."images/file-icon.jpg";
                  }

                echo "<tr>
                      <td><a href=\"{$row['photo']}\" download>{$row['file_name']}</a></td>";
                echo "<td>" . date(PHP_DFORMAT,strtotime($row['datestamp'])) . " </td>";
                echo "<td  >  </td>";
                echo "<td></td>";  

                echo "<td>";
                //process user_access_profiles
                if ($current_signed_in_user_access_profiles['tab sales']['delete'] == true) {
                    echo "<a rel=\"nofollow\" onclick=\"if(confirm('Are you sure you want to delete?')){"."$('#picid').val('".$row["cf_id"]."'); $('#btn_picid').click();}\"   class='remove-link'  >Delete</a>";
                } //end if
                echo "</td>";
                echo "</tr>";
              }
      
 ?>





            <!--
            begin: template revamp > edited template download list > contract folder > sales
            -->
            <?php
            $template_module = 'template_applied';
            $template_entity_name = $_REQUEST['projectid'];;
            $template_folder_name = 'Sales';
            $template_content_category = 'Download Data Merge';
            $template_download_option = 'dl';
            $adhoc_entity_name = '';

            $html_text = getTemplateListInHtml(
                $sql_template_retrieve_template_download_list, 
                $template_module, 
                $template_entity_name, 
                $template_folder_name, 
                $template_content_category, 
                $template_status, 
                $template_download_option, 
                $adhoc_entity_name
            );
            echo $html_text;
            ?>
            <!--
            end: template revamp > edited template download list > contract folder > sales
            -->





        </table>
        
      </div> 
      <br/><br/>
      <table id="tbl-pic">
          <tr>
            <td class="tbl-upload">

                <?php //process user_access_profiles
                if ($current_signed_in_user_access_profiles['tab sales']['save'] == true) {
                ?>
                    <input type='file' name='upload_doc[]' multiple='multiple' accept='.jpg,.png,.bmp,.gif,.pdf, .doc, .docx, .xls, .xlsx, .odt'> 
                    <input type='button' value='Save' id='' name='' class='bbtn btn-delete' onclick='$("#upload_type").val("upload_sales_doc"); $("#chronoform_Client_Folder_Vic").submit();'>
                <?php } //end if?>

            </td>
          </tr>
      </table>

    </div>
    <!-------------------------------------------- END of Sales Tab -->

    <!-------------------------------------------- Correspndence Doc  Tab -->
    <div id="documents" class="tab_content" style="display: block;"> 
      <!-- correspondence template documents section -->
      <!-- hide and make way for revamped template modules
      <div class="modification-button-holder">          
        <a id="template_link" rel="nofollow" title="PDF" onclick="window.open(this.href,'win2','status=no,toolbar=no,scrollbars=yes,titlebar=no,menubar=no,resizable=yes,width=auto,height=auto,directories=no,location=no'); return false;" href="index.php?cf_id=<?php echo $cf_id; ?>&pid=<?php echo $ClientID; ?>&option=com_chronoforms&tmpl=component&chronoform=Time_Frame_Letter" style="margin-right:5px;">Time Frame Letter</a>
      -->
        <!-- <a id="template_link" href="<?php echo JURI::base().'images/template/proposed_drawings_letter.docx'; ?> " download  style="margin-right:5px;">Proposed Drawings</a> -->
      <!--
        <a id="template_link" rel="nofollow" title="PDF" onclick="window.open(this.href,'win2','status=no,toolbar=no,scrollbars=yes,titlebar=no,menubar=no,resizable=yes,width=auto,height=auto,directories=no,location=no'); return false;" href="index.php?cf_id=<?php echo $cf_id; ?>&pid=<?php echo $ClientID; ?>&option=com_chronoforms&tmpl=component&chronoform=Proposed_Drawings" style="margin-right:5px;">Proposed Drawings</a>
      -->
        <!-- <a id="template_link" href="<?php echo JURI::base().'images/template/amended_proposed_drawings.docx'; ?> " download  style="margin-right:5px;">Amended Proposed Drawings</a>  -->
      <!--
        <a id="template_link" rel="nofollow" title="PDF" onclick="window.open(this.href,'win2','status=no,toolbar=no,scrollbars=yes,titlebar=no,menubar=no,resizable=yes,width=auto,height=auto,directories=no,location=no'); return false;" href="index.php?cf_id=<?php echo $cf_id; ?>&pid=<?php echo $ClientID; ?>&option=com_chronoforms&tmpl=component&chronoform=Amended_Proposed_Drawings" style="margin-right:5px;">Amended Proposed Drawings</a>
        <a id="template_link" rel="nofollow" title="PDF" onclick="window.open(this.href,'win2','status=no,toolbar=no,scrollbars=yes,titlebar=no,menubar=no,resizable=yes,width=auto,height=auto,directories=no,location=no'); return false;" href="index.php?cf_id=<?php echo $cf_id; ?>&pid=<?php echo $ClientID; ?>&option=com_chronoforms&tmpl=component&chronoform=Proposed_Drawing_Rescode" style="margin-right:5px;">Proposed Drawing Rescode</a><br/>
        <a id="template_link" rel="nofollow" title="PDF" onclick="window.open(this.href,'win2','status=no,toolbar=no,scrollbars=yes,titlebar=no,menubar=no,resizable=yes,width=auto,height=auto,directories=no,location=no'); return false;" href="index.php?cf_id=<?php echo $cf_id; ?>&pid=<?php echo $ClientID; ?>&option=com_chronoforms&tmpl=component&chronoform=Res_Code_Letter" style="margin-right:5px;">Res Code Letter</a>
        <a id="template_link" rel="nofollow" title="PDF" onclick="window.open(this.href,'win2','status=no,toolbar=no,scrollbars=yes,titlebar=no,menubar=no,resizable=yes,width=auto,height=auto,directories=no,location=no'); return false;" href="index.php?cf_id=<?php echo $cf_id; ?>&pid=<?php echo $ClientID; ?>&option=com_chronoforms&tmpl=component&chronoform=Protection_Work_Notice_Client" style="margin-right:5px;">Protection Work Notice Client</a>
        <a id="template_link" rel="nofollow" title="PDF" onclick="window.open(this.href,'win2','status=no,toolbar=no,scrollbars=yes,titlebar=no,menubar=no,resizable=yes,width=auto,height=auto,directories=no,location=no'); return false;" href="index.php?cf_id=<?php echo $cf_id; ?>&pid=<?php echo $ClientID; ?>&option=com_chronoforms&tmpl=component&chronoform=Protection_Work_Notice_Neighbour" style="margin-right:5px;">Protection Work Notice Neighbour</a>
        <a id="template_link" href="<?php echo JURI::base().'images/template/protection_work_notice_forms.pdf'; ?> " download  style="margin-right:5px;">Protection Work Notice forms</a>
      </div>
      -->




        <!--
        begin: template revamp > template download list > contract folder > correspondence
        -->
        <div class="modification-button-holder" style="background-color: #cccccc;">
            <?php
            $template_module = 'template';
            $template_entity_name = 'Contract Folder';
            $template_folder_name = 'Correspondence';
            $template_content_category = 'Template';
            $template_download_option = 'dl_dm';
            $adhoc_entity_name = $_REQUEST['projectid'];

            $html_text = getTemplateListInHtml(
                $sql_template_retrieve_template_download_list, 
                $template_module, 
                $template_entity_name, 
                $template_folder_name, 
                $template_content_category, 
                $template_status, 
                $template_download_option, 
                $adhoc_entity_name
            );
            echo $html_text;
            ?>
        </div>
        <!--
        end: template revamp > template download list > contract folder > correspondence
        -->






      <br/>

        <div class="drawing-tbl">
          <table class="tbl-pdf">
            <tr>
              <th>Filename</th>
              <th>Date Created</th>
              <th>Download PDF</th> 
              <th>Uploaded Doc</th>  
              <th>&nbsp; </th> 
            </tr>
            <?php 

           $sql = "SELECT * FROM ver_chronoforms_data_letters_vic  WHERE clientid='{$ClientID}' AND (template_name LIKE 'Time Frame Letter%' OR template_name LIKE 'Proposed Drawing%' OR template_name LIKE 'Amended Proposed Drawing%' OR template_name LIKE 'Proposed Drawing Rescode%' OR template_name LIKE 'Res Code Letter%'  OR template_name LIKE 'Protection Work Notice Client%' OR template_name  LIKE 'Protection Work Notice Neighbour%')  ORDER BY datecreated DESC";
           $data = mysql_query($sql) 
           or die(mysql_error()); 

            //error_log(" sql: ".$sql, 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_sa\\my-error.log');

           while($info = mysql_fetch_array( $data )) 
           {  
              if(strtolower(substr($row['photo'],-3))=="pdf"){
                  $thumbnail = JURI::base()."images/file_pdf.png";
              }else if(strtolower(substr($row['photo'],-3))=="doc" || substr($row['photo'],-4)=="docx"){
                  $thumbnail = JURI::base()."images/doc_logo.png";
              }else if(strtolower(substr($row['photo'],-3))=="xls" || substr($row['photo'],-4)=="xlsx"){
                  $thumbnail = JURI::base()."images/excel-logo.jpg";
              }else{
                  $thumbnail = JURI::base()."images/file-icon.jpg";
              }

              Print "<tr>"; 
              Print "<td>". $info['template_name'] . "</td> "; 
              Print "<td>" . date(PHP_DFORMAT,strtotime($info['datecreated'])) . " </td>";
              Print "<td style='border:none;'><a rel=\"nofollow\" href=\"index.php?pid=".$info['cf_id']."?option=com_chronoforms&tmpl=component&chronoform=Download-PDF\">Click Here <img src='".JURI::base()."templates/".$mainframe->getTemplate()."/images/file_pdf.png'  /></a></td>  ";
            
            echo "<td>";
            if($info['has_upload_file']==1){
                echo '<div> 
                      <ul style="list-style-type: none; margin: 5px 0 5px 10px;padding: 0;"  >';
               
                  $sql = "SELECT cf_id, clientid, photo, file_name FROM ver_chronoforms_data_pics_vic WHERE clientid = '$ClientID'  AND upload_type ='signed_correspondence_doc' AND ref_id={$info['cf_id']} ";
                  $resultimg = mysql_query($sql);

                  $thumbnail = "";
                  while($row = mysql_fetch_array($resultimg))
                  { 
                    if(strtolower(substr($row['photo'],-3))=="pdf"){
                        $thumbnail = JURI::base()."images/file_pdf.png";
                    }else if(strtolower(substr($row['photo'],-3))=="doc" || substr($row['photo'],-4)=="docx"){
                        $thumbnail = JURI::base()."images/doc_logo.png";
                    }else if(strtolower(substr($row['photo'],-3))=="xls" || substr($row['photo'],-4)=="xlsx"){
                        $thumbnail = JURI::base()."images/excel-logo.jpg";
                    }else{
                        $thumbnail = JURI::base()."images/file-icon.jpg";
                    } 
                   echo "<li><a href=\"".$row['photo']."\" download class='remove-link'>  <img src=\"{$thumbnail}\" height=\"20px\" style='display:inline'> ".$row['file_name']."</a>    <span class=\"ui-icon ui-icon-closethick\" style='display:inline-block; cursor: pointer;' onclick=\"if(confirm('Are you sure you want to delete?')){"."$('#picid').val('".$row["cf_id"]."'); $('#btn_picid').click();}\"   > </span></li>";
                  }
                echo "</ul>
                </div>";
             
            } 


            //process user_access_profiles
            if ($current_signed_in_user_access_profiles['tab correspondence']['save'] == true) {
                echo "<input type='file' name='signed_doc[]' multiple='multiple' accept='.jpg,.png,.bmp,.gif,.pdf, .doc, .docx, .xls, .xlsx, .odt'> 
                      <input type='button' value='Save' id='' name='' class='bbtn btn-delete' onclick='$(\"#upload_type\").val(\"signed_correspondence_doc\"); $(\"#doc_id\").val(\"{$info['cf_id']}\"); $(\"#chronoform_Client_Folder_Vic\").submit();'>  "; 
            } //end if
            echo "</td>"; 

            echo "<td>";
            //process user_access_profiles
            if ($current_signed_in_user_access_profiles['tab correspondence']['delete'] == true) {
                echo "<a rel=\"nofollow\" onclick=\"delete_pdf_letter(event,this)\" cf_id=\"{$info['cf_id']}\"   class='remove-link'  >Delete</a>";
            } //end if
            echo "</td>";
            echo "</tr>";
           }

           $resultimg = mysql_query("SELECT cf_id, clientid, photo, file_name, datestamp FROM ver_chronoforms_data_pics_vic WHERE clientid = '$ClientID'  AND upload_type ='upload_correspondence_doc' ");
              if (!$resultimg) {
                  echo 'Could not run query: ' . mysql_error();
                  exit;
              } 

              while($row = mysql_fetch_array($resultimg))
              {  
                echo "<tr>
                      <td><a href=\"{$row['photo']}\" download>{$row['file_name']}</a></td>";
                echo "<td>" . date(PHP_DFORMAT,strtotime($row['datestamp'])) . " </td>";
                echo "<td  >  </td>"; 
                echo "<td  >  </td>"; 

                echo "<td>";
                //process user_access_profiles
                if ($current_signed_in_user_access_profiles['tab correspondence']['delete'] == true) {
                    echo "<a rel=\"nofollow\" onclick=\"if(confirm('Are you sure you want to delete?')){"."$('#picid').val('".$row["cf_id"]."'); $('#btn_picid').click();}\"   class='remove-link'  >Delete</a>";  
                } //end if
                echo "</td>";
                echo "</tr>";
              } 

           ?>




            <!--
            begin: template revamp > edited template download list > contract folder > correspondence
            -->
            <?php
            $template_module = 'template_applied';
            $template_entity_name = $_REQUEST['projectid'];
            $template_folder_name = 'Correspondence';
            $template_content_category = 'Download Data Merge';
            $template_download_option = 'dl';
            $adhoc_entity_name = '';

            $html_text = getTemplateListInHtml(
                $sql_template_retrieve_template_download_list, 
                $template_module, 
                $template_entity_name, 
                $template_folder_name, 
                $template_content_category, 
                $template_status, 
                $template_download_option, 
                $adhoc_entity_name
            );
            echo $html_text;
            ?>
            <!--
            end: template revamp > edited template download list > contract folder > correspondence
            -->





          </table>
        </div>

         <br/><br/>
        <table id="tbl-pic">
          <tr>
            <td class="tbl-upload">

                <?php //process user_access_profiles
                if ($current_signed_in_user_access_profiles['tab correspondence']['save'] == true) {
                ?>
                    <input type='file' name='upload_doc[]' multiple='multiple' accept='.jpg,.png,.bmp,.gif,.pdf, .doc, .docx, .xls, .xlsx, .odt'>
                    <input type='button' value='Save' id='' name='' class='bbtn btn-delete' onclick='$("#upload_type").val("upload_correspondence_doc"); $("#chronoform_Client_Folder_Vic").submit();'>
                <?php } //end if?>

            </td>
          </tr>
      </table>

    </div>  
    <!-------------------------------------------- END of Correspondence  Tab -->
     
 
    <!-------------------------------------------- Stat Docs Tab-->
    <div id="statdocs" class="tab_content" style="display: block;">
      <!-- statutory template documents section -->
      <!-- hide and make way for revamped template modules
      <div class="modification-button-holder">
        <a id="template_link" rel="nofollow" title="PDF" onclick="window.open(this.href,'win2','status=no,toolbar=no,scrollbars=yes,titlebar=no,menubar=no,resizable=yes,width=auto,height=auto,directories=no,location=no'); return false;" href="index.php?cf_id=<?php echo $cf_id; ?>&pid=<?php echo $ClientID; ?>&option=com_chronoforms&tmpl=component&chronoform=Planning_Application_Letter" style="margin-right:5px;">Planning Application Letter</a>
        <a id="template_link" rel="nofollow" title="PDF" onclick="window.open(this.href,'win2','status=no,toolbar=no,scrollbars=yes,titlebar=no,menubar=no,resizable=yes,width=auto,height=auto,directories=no,location=no'); return false;" href="index.php?cf_id=<?php echo $cf_id; ?>&pid=<?php echo $ClientID; ?>&option=com_chronoforms&tmpl=component&chronoform=Amendment_Planning_Permit" style="margin-right:5px;">Amendment Planning Permit</a>
        <a id="template_link" rel="nofollow" title="PDF" onclick="window.open(this.href,'win2','status=no,toolbar=no,scrollbars=yes,titlebar=no,menubar=no,resizable=yes,width=auto,height=auto,directories=no,location=no'); return false;" href="index.php?cf_id=<?php echo $cf_id; ?>&pid=<?php echo $ClientID; ?>&option=com_chronoforms&tmpl=component&chronoform=Replacement_Drawing_Letter" style="margin-right:5px;">Replacement Drawing Letter</a>
        <a id="template_link" rel="nofollow" title="PDF" onclick="window.open(this.href,'win2','status=no,toolbar=no,scrollbars=yes,titlebar=no,menubar=no,resizable=yes,width=auto,height=auto,directories=no,location=no'); return false;" href="index.php?cf_id=<?php echo $cf_id; ?>&pid=<?php echo $ClientID; ?>&option=com_chronoforms&tmpl=component&chronoform=Building_Appeals_Board" style="margin-right:5px;">Building Appeals Board</a> <br/>
        <a id="template_link" rel="nofollow" title="PDF" onclick="window.open(this.href,'win2','status=no,toolbar=no,scrollbars=yes,titlebar=no,menubar=no,resizable=yes,width=auto,height=auto,directories=no,location=no'); return false;" href="index.php?cf_id=<?php echo $cf_id; ?>&pid=<?php echo $ClientID; ?>&option=com_chronoforms&tmpl=component&chronoform=Build_Over_Easement" style="margin-right:5px;">Build Over Easement</a>
        <a id="template_link" rel="nofollow" title="PDF" onclick="window.open(this.href,'win2','status=no,toolbar=no,scrollbars=yes,titlebar=no,menubar=no,resizable=yes,width=auto,height=auto,directories=no,location=no'); return false;" href="index.php?cf_id=<?php echo $cf_id; ?>&pid=<?php echo $ClientID; ?>&option=com_chronoforms&tmpl=component&chronoform=Report_And_Consent" style="margin-right:5px;">Report and Consent</a>
      </div>
      -->




        <!--
        begin: template revamp > template download list > contract folder > statutory
        -->
        <div class="modification-button-holder" style="background-color: #cccccc;">
            <?php
            $template_module = 'template';
            $template_entity_name = 'Contract Folder';
            $template_folder_name = 'Statutory';
            $template_content_category = 'Template';
            $template_download_option = 'dl_dm';
            $adhoc_entity_name = $_REQUEST['projectid'];

            $html_text = getTemplateListInHtml(
                $sql_template_retrieve_template_download_list, 
                $template_module, 
                $template_entity_name, 
                $template_folder_name, 
                $template_content_category, 
                $template_status, 
                $template_download_option, 
                $adhoc_entity_name
            );
            echo $html_text;
            ?>
        </div>
        <!--
        end: template revamp > template download list > contract folder > statutory
        -->





      <br/>
        <div class="drawing-tbl">
          <table class="tbl-pdf">
            <tr>
              <th>Filename</th>
              <th>Date Created</th>
              <th>Download PDF</th>
              <th>Uploaded Doc</th>
              <th> &nbsp; </th>
            </tr>
            <?php 

           $data = mysql_query("SELECT * FROM ver_chronoforms_data_letters_vic  WHERE  clientid='{$ClientID}' AND (template_name LIKE 'Replacement Drawing Letter%' OR   template_name LIKE 'Planning Application Letter%' OR template_name LIKE 'Amendment Planning Permit%' OR template_name LIKE 'Building Appeals Board%' OR template_name  LIKE 'Build Over Easement%' OR template_name LIKE 'Report And Consent%') ORDER BY datecreated DESC") 
           or die(mysql_error()); 

           while($info = mysql_fetch_array( $data )) 
           { 
              Print "<tr>"; 
              Print "<td>". $info['template_name'] . "</td> "; 
              Print "<td>" . date(PHP_DFORMAT,strtotime($info['datecreated'])) . " </td>";

              Print "<td style='border:none;'><a rel=\"nofollow\" onclick=\"window.open(this.href,'win2','status=no,toolbar=no,scrollbars=yes,titlebar=no,menubar=no,resizable=yes,width=auto,height=auto,directories=no,location=no'); return false;\" href=\"index.php?pid=".$info['cf_id']."?option=com_chronoforms&tmpl=component&chronoform=Download-PDF\">Click Here <img src='".JURI::base()."templates/".$mainframe->getTemplate()."/images/file_pdf.png'  /></a></td> ";

              echo "<td>";
              if($info['has_upload_file']==1){
                  echo '<div> 
                        <ul style="list-style-type: none; margin: 5px 0 5px 10px;padding: 0;"  >';
                 
                    $resultimg = mysql_query("SELECT cf_id, clientid, photo, file_name FROM ver_chronoforms_data_pics_vic WHERE clientid = '$ClientID'  AND upload_type ='signed_stat_doc' AND ref_id={$info['cf_id']} ");
                    $thumbnail = "";
                    while($row = mysql_fetch_array($resultimg))
                    { 
                      if(strtolower(substr($row['photo'],-3))=="pdf"){
                          $thumbnail = JURI::base()."images/file_pdf.png";
                      }else if(strtolower(substr($row['photo'],-3))=="doc" || substr($row['photo'],-4)=="docx"){
                          $thumbnail = JURI::base()."images/doc_logo.png";
                      }else if(strtolower(substr($row['photo'],-3))=="xls" || substr($row['photo'],-4)=="xlsx"){
                          $thumbnail = JURI::base()."images/excel-logo.jpg";
                      }else{
                          $thumbnail = JURI::base()."images/file-icon.jpg";
                      } 
                     echo "<li><a href=\"".$row['photo']."\" download class='remove-link'>  <img src=\"{$thumbnail}\" height=\"20px\" style='display:inline'> ".$row['file_name']."</a>    <span class=\"ui-icon ui-icon-closethick\" style='display:inline-block; cursor: pointer;' onclick=\"if(confirm('Are you sure you want to delete?')){"."$('#picid').val('".$row["cf_id"]."'); $('#btn_picid').click();}\"   > </span></li>";
                    }
                  echo "</ul>
                  </div>";
               
              } 

                //process user_access_profiles
                if ($current_signed_in_user_access_profiles['tab statutory']['save'] == true) {
                    echo "<input type='file' name='signed_doc[]' multiple='multiple' accept='.jpg,.png,.bmp,.gif,.pdf, .doc, .docx, .xls, .xlsx, .odt'> 
                          <input type='button' value='Save' id='' name='' class='bbtn btn-delete' onclick='$(\"#upload_type\").val(\"signed_stat_doc\"); $(\"#doc_id\").val(\"{$info['cf_id']}\"); $(\"#chronoform_Client_Folder_Vic\").submit();'>  "; 
                } //end if
                echo "</td>";

                echo "<td>";
                //process user_access_profiles
                if ($current_signed_in_user_access_profiles['tab statutory']['delete'] == true) {
                    echo "<a rel=\"nofollow\" onclick=\"delete_pdf_letter(event,this)\" cf_id=\"{$info['cf_id']}\" class='remove-link'  >Delete</a>";
                } //end if
                echo "</td>";
                echo "</tr>";
           } 

           $resultimg = mysql_query("SELECT cf_id, clientid, photo, file_name, datestamp FROM ver_chronoforms_data_pics_vic WHERE clientid = '$ClientID'  AND upload_type ='upload_stat_doc' ");
              if (!$resultimg) {
                  echo 'Could not run query: ' . mysql_error();
                  exit;
              } 

              while($row = mysql_fetch_array($resultimg))
              { 
                echo "<tr>
                      <td><a href=\"{$row['photo']}\" download>{$row['file_name']}</a></td>";
                echo "<td>" . date(PHP_DFORMAT,strtotime($row['datestamp'])) . " </td>";
                echo "<td  >  </td>"; 
                echo "<td  >  </td>"; 

                echo "<td>";
                //process user_access_profiles
                if ($current_signed_in_user_access_profiles['tab statutory']['delete'] == true) {
                    echo "<a rel=\"nofollow\" onclick=\"if(confirm('Are you sure you want to delete?')){"."$('#picid').val('".$row["cf_id"]."'); $('#btn_picid').click();}\"   class='remove-link'  >Delete</a>"; 
                } //end if
                echo "</td>";
                echo "</tr>";
              } 
           

           ?>




            <!--
            begin: template revamp > edited template download list > contract folder > statutory
            -->
            <?php
            $template_module = 'template_applied';
            $template_entity_name = $_REQUEST['projectid'];
            $template_folder_name = 'Statutory';
            $template_content_category = 'Download Data Merge';
            $template_download_option = 'dl';
            $adhoc_entity_name = '';

            $html_text = getTemplateListInHtml(
                $sql_template_retrieve_template_download_list, 
                $template_module, 
                $template_entity_name, 
                $template_folder_name, 
                $template_content_category, 
                $template_status, 
                $template_download_option, 
                $adhoc_entity_name
            );
            echo $html_text;
            ?>
            <!--
            end: template revamp > edited template download list > contract folder > statutory
            -->





          </table>
        </div>

         <br/><br/>
         <table id="tbl-pic">
            <tr>
              <td class="tbl-upload">

                <?php //process user_access_profiles
                if ($current_signed_in_user_access_profiles['tab statutory']['save'] == true) {
                ?>
                    <input type='file' name='upload_doc[]' multiple='multiple' accept='.jpg,.png,.bmp,.gif,.pdf, .doc, .docx, .xls, .xlsx, .odt'>
                    <input type='button' value='Save' id='' name='' class='bbtn btn-delete' onclick='$("#upload_type").val("upload_stat_doc"); $("#chronoform_Client_Folder_Vic").submit();'>  
                <?php } //end if?>

              </td>
            </tr>
        </table> 
       

    </div>
    <!---------------------------------------------- END Statutory Tab -->
 
    
    <!---------------------------------------------- Photos Tab -->
    <div id="photos" class="tab_content" style="display: block;">
      <!-- <INPUT type="button" value="Add Row" onclick="addRow('tbl-pic')" /> <input type="submit" name="delete-pic" value="Delete Picture" onclick="deleteRow('tbl-pic');deleteRow2('tbl-imgpic')" />   -->

        <?php //process user_access_profiles
        if ($current_signed_in_user_access_profiles['tab photos']['delete'] == true) {
        ?>
            <input type="submit" name="delete-pic" id="btn_picid" class="bbtn btn-delete" value="Delete Picture" style="margin-left: -1000px;float: left;"  />
        <?php } //end if?>

      <input type="hidden" value="" id="picid" name="picid" />
      <div id="drawing-tbl">
        <br/> 
       <table class="tbl-pdf" cellpadding="10">
            <tr>
              <th>Filename</th>
              <th>Date Created</th>    
              <th>&nbsp; </th>  
            </tr>
          <?php
$resultimg = mysql_query("SELECT cf_id, clientid, photo, file_name, datestamp FROM ver_chronoforms_data_pics_vic WHERE clientid = '$ClientID' AND upload_type ='pic' ");
if (!$resultimg) {
    echo 'Could not run query: ' . mysql_error();
    exit;
}
   while($row = mysql_fetch_assoc($resultimg))
      {
        echo "<tr>
                <td><a href=\"{$row['photo']}\" download>{$row['file_name']}</a></td>";
        echo "<td>" . date(PHP_DFORMAT,strtotime($row['datestamp'])) . " </td>"; 

        echo "<td>";
        //process user_access_profiles
        if ($current_signed_in_user_access_profiles['tab photos']['delete'] == true) {
            echo "<a rel=\"nofollow\" onclick=\"if(confirm('Are you sure you want to delete?')){"."$('#picid').val('".$row["cf_id"]."'); $('#btn_picid').click();}\"   class='remove-link'  >Delete</a>"; 
        } //end if
        echo "</td>";
        echo "</tr>";
      }     
   
?>
        </table>
        <br/>
        <table id="tbl-pic" >
          <tr> 
            <td class="tbl-upload">

                <?php //process user_access_profiles
                if ($current_signed_in_user_access_profiles['tab photos']['save'] == true) {
                ?>
                    <input type="file" name="pic[]" multiple="multiple" accept=".jpg,.png,.bmp,.gif,.pdf, .odt">                 
                    <input type="submit" value="Save" id="bsbtn" name="save_pic" class="bbtn btn-save">  
                <?php } //end if?>

            </td>
          </tr>
        </table>
      </div>
    </div> 
    <!---------------------------------------------- END Photos Tab -->


     <!---------------------------------------------- Drawing Tab -->
    
    <div id="drawing" class="tab_content">
      <!--<INPUT type="button" value="Add Row" onclick="addRow('tbl-draw')" /> onclick="deleteRow('tbl-draw');deleteRow2('tbl-img')" -->

        <?php //process user_access_profiles
        if ($current_signed_in_user_access_profiles['tab drawings']['delete'] == true) {
        ?>
            <input type="submit" id="delete_drawing" name="delete-drawing" class="bbtn btn-delete" value="Delete Drawing" style="margin-left: -1000px;float: left;"  />
        <?php } //end if?>

      <input type="hidden" value="" id="drawingid" name="drawingid" />
      <div id="drawing-tbl">
        <br/>
        <table class="tbl-pdf" cellpadding="10">
          <tr>
            <th>Filename</th>
            <th>Date Created</th>    
            <th>&nbsp; </th>  
          </tr>
        <?php
$resultimg = mysql_query("SELECT cf_id, clientid, photo, file_name, datestamp FROM ver_chronoforms_data_drawings_vic WHERE clientid = '$ClientID'");
if (!$resultimg) {
    echo 'Could not run query: ' . mysql_error();
    exit;
}

 
      while($row = mysql_fetch_assoc($resultimg))
      {
        echo "<tr>
                <td><a href=\"{$row['photo']}\" download>{$row['file_name']}</a></td>";
        echo "<td>" . date(PHP_DFORMAT,strtotime($row['datestamp'])) . " </td>"; 

        echo "<td>";
        //process user_access_profiles
        if ($current_signed_in_user_access_profiles['tab drawings']['delete'] == true) {
            echo "<a rel=\"nofollow\" onclick=\"if(confirm('Are you sure you want to delete?')){"."$('#drawingid').val('".$row["cf_id"]."'); $('#delete_drawing').click();}\"   class='remove-link'  >Delete</a>";  
        } //end if
        echo "</td>";
        echo "</tr>";
      }              

?>
        </table>
        <br/>
        <table id="tbl-draw">
          <tr> 
            <td class="tbl-upload">

                <?php //process user_access_profiles
                if ($current_signed_in_user_access_profiles['tab drawings']['save'] == true) {
                ?>
                    <input type="file" name="photo[]" multiple="multiple" accept=".jpg,.png,.bmp,.gif,.pdf">
                    <input type="submit" value="Save" id="bsbtn" name="save_drawing" class="bbtn btn-save">
                <?php } //end if?>

            </td>
          </tr>
        </table>
      </div>
    </div>
    <!---------------------------------------------- END of Drawing Tab -->


    <!---------------------------------------------- General Tab -->
    <div id="general" class="tab_content" style="display: block;">  
        <br/>
        <div class="drawing-tbl">
          <table class="tbl-pdf" cellpadding="10">
            <tr>
              <th>Filename</th>
              <th>Date Created</th>
              <th>&nbsp; </th>  
            </tr>
            <?php
                $resultimg = mysql_query("SELECT cf_id, clientid, photo, file_name, datestamp FROM ver_chronoforms_data_pics_vic WHERE clientid = '$ClientID'  AND upload_type ='file' ");
                if (!$resultimg) {
                    echo 'Could not run query: ' . mysql_error();
                    exit;
                }

                //error_log(" resultimg sql:"."SELECT cf_id, clientid, photo, file_name, datestamp FROM ver_chronoforms_data_pics_vic WHERE clientid = '$ClientID'  AND upload_type ='file' ", 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_sa\\my-error.log');
                //$thumbnail = "";
                while($row = mysql_fetch_assoc($resultimg))
                {
                    echo "<tr>
                          <td><a href=\"{$row['photo']}\" download>{$row['file_name']}</a></td>";
                    echo "<td>" . date(PHP_DFORMAT,strtotime($row['datestamp'])) . " </td>"; 

                    echo "<td>";
                    //process user_access_profiles
                    if ($current_signed_in_user_access_profiles['tab general']['delete'] == true) {
                        echo "<a rel=\"nofollow\" onclick=\"if(confirm('Are you sure you want to delete?')){"."$('#picid').val('".$row["cf_id"]."'); $('#btn_picid').click();}\"   class='remove-link'  >Delete</a>"; 
                    } //end if
                    echo "</td>";
                    echo "</tr>";
                }
                  
            ?>
          </table>
          
          <br/><br/>

          <table id="tbl-pic">
            <tr>
            <td class="tbl-upload">

                <?php //process user_access_profiles
                if ($current_signed_in_user_access_profiles['tab general']['save'] == true) {
                ?>
                    <input type="file" name="doc[]" multiple="multiple" accept=".jpg,.png,.bmp,.gif,.pdf, .doc, .docx, .xls, .xlsx, .odt"> 
                    <!-- <input type="submit" value="Save" id="btn_save_file" name="save_file" class="bbtn btn-save"> -->
                    <input type='button' value='Save' id='' name='' class='bbtn btn-delete' onclick='$("#upload_type").val("file"); $("#chronoform_Client_Folder_Vic").submit();'>    
                <?php } //end if?>

              </td>
            </tr>
          </table>

        </div>
        
    </div>
    <!---------------------------------------------- END of General Tab -->


    <!-- -----BEGIN of Special Conditions Tab ----- -->
    <div id="special" class="tab_content" style="display: block;">
      <table id="tbl-special">
        <?php
        $userName = $user->get( 'name' );
        ?>
       <tr>
          <td class="tbl-content">              
            <div class="layer-date">Date: <input type="text" id="date_display" name="date_display" class="datetime_display" value="<?php print(Date(PHP_DFORMAT)); ?>" readonly>
              <input type="hidden" id="date_specialconditions" name="date_specialconditions[]" class="date_time" value="<?php print(Date(PHP_DFORMAT." H:i:s")); ?>" readonly />
            </div>
            <div class="layer-whom">By Whom: <input type="text" id="username_specialconditions" name="username_specialconditions[]" class="username" value="<?php echo $userName; ?>" readonly></div>           
            <textarea name="specialconditions[]" id="specialconditions"></textarea>              
          </td>
        </tr>
      </table>
      <table id="tbl-content">
        <?php
        $resultnotes = mysql_query("
          SELECT cf_id, datenotes, username, content, date_created 
          FROM ver_chronoforms_data_special_condition_vic 
          WHERE clientid = '$ClientID' 
          ORDER by cf_id DESC
        ");
        $i=1;
        if (!$resultnotes) {
          echo 'Could not run query: ' . mysql_error();
          exit;
        }
        while($row = mysql_fetch_assoc($resultnotes))
        {
          echo "
          <tr><td class=\"tbl-content\"><h1>Notes ". $i++ ."</h1><p>{$row['content']}</p>
          <div class=\"layer-date\">Date: " .date(PHP_DFORMAT, strtotime ($row['date_created'])) . "</div>
          <div class=\"layer-whom\">By Whom: {$row['username']}</div>
          </td>
          </tr>";
        }
        ?>
      </table>
    </div>
    <!-- -----END of Special Conditions Tab ----- -->

    </div>
  </div>
</div>
  <!----------------------------------------- End of ALL Tab Content -------------------------------------------------->

<?php if($page_name=="maintenancefolder"){ ?>
    

<?php }else if($is_system_admin || $is_operation_manager || $is_account_user){ ?>
<div id="tabs_wrapper" class="button-tab">

        <?php //process user_access_profiles
        if ($current_signed_in_user_access_profiles['record action']['cancel contract'] == true) {
        ?>
            <input type="submit" value="Cancel Contract" id="bsbtn" name="delete" class="bbtn" onclick="return confirm('Are you sure you want to cancel contract?');">
        <?php } //end if?>

        <?php //process user_access_profiles
        if ($current_signed_in_user_access_profiles['record action']['update'] == true) {
        ?>
            <input type="submit" value="Update" id="bsbtn" name="update" class="bbtn">
        <?php } //end if?>

        <input type="submit" value="Close" id="bcbtn" name="close" class="bbtn">
</div>
<?php }else if($is_reception){ ?>
  <div id="tabs_wrapper" class="button-tab">

        <?php //process user_access_profiles
        if ($current_signed_in_user_access_profiles['record action']['update'] == true) {
        ?>
            <input type="submit" value="Update" id="bsbtn" name="update" class="bbtn"> 
        <?php } //end if?>

        <input type="submit" value="Close" id="bcbtn" name="close" class="bbtn">   
  </div>
 
<?php }else{ ?>
  <div id="tabs_wrapper" class="button-tab">

        <?php //process user_access_profiles
        if ($current_signed_in_user_access_profiles['record action']['update'] == true) {
        ?>
            <input type="submit" value="Update" id="bsbtn" name="update" class="bbtn"> 
        <?php } //end if?>

        <input type="submit" value="Close" id="bcbtn" name="close" class="bbtn">    
  </div>  
  
<?php } ?>

</form>

<form method="post" class="" id="form_pdf">  
    <input type="hidden" name="delete_pdf"  />
    <input type="hidden" name="pdf_cf_id" id="pdf_cf_id"  />
</form>

<form method="post"  action="" id="form_generate_checklist">  
  <input type="hidden" name="generate_load_list"   />
  <input type="hidden" name="clientid" value="<?php echo $QuoteID; ?>"  />
  <input type="hidden" name="projectid" value="<?php echo $projectid; ?>"  />
  
</form>

<script type="text/javascript">

var clientbuilder=new ddtabcontent("client-builder-tabs")
clientbuilder.setpersist(false)
clientbuilder.setselectedClassTarget("link") //"link" or "linkparent"
clientbuilder.init()
  
var quoteinfo=new ddtabcontent("contract-tabs")
quoteinfo.setpersist(false)
quoteinfo.setselectedClassTarget("link") //"link" or "linkparent"
quoteinfo.init()
 

var trackerinfo=new ddtabcontent("tracker-tabs")
trackerinfo.setpersist(false)
trackerinfo.setselectedClassTarget("link") //"link" or "linkparent"
trackerinfo.init()
 

var noteinfo=new ddtabcontent("notes-tabs")
noteinfo.setpersist(true)
noteinfo.setselectedClassTarget("link") //"link" or "linkparent"
noteinfo.init()


$(document).ready(function(){
  $('.chkdraw').change(function() {
     $('#drawingid').val($(this).val()); 
     var o = $(this);
     $('.chkdraw').each(function() { 
         $(this).prop('checked', false);
      });
     $(o).prop('checked', true);

  });
  
   $('.chkpic').change(function() {
       $('#picid').val($(this).val()); 
        var o = $(this);
        $('.chkpic').each(function() { 
             $(this).prop('checked', false);
          });
        $(o).prop('checked', true);
    });

    $('.chkfile').change(function() {
        $('#fileid').val($(this).val()); 
        var o = $(this);
        $('.chkfile').each(function() { 
             $(this).prop('checked', false);
          });
        $(o).prop('checked', true);
     
    });
  
    $(".disabled-div input" ).prop( "disabled", true );
    $(".disabled-div select" ).prop( "disabled", true );
  
  });
 
        function addRow(tableID) {
 
            var table = document.getElementById(tableID);
 
            var rowCount = table.rows.length;
            var row = table.insertRow(rowCount);
 
            var colCount = table.rows[0].cells.length;
 
            for(var i=0; i<colCount; i++) {
 
                var newcell = row.insertCell(i);
 
                newcell.innerHTML = table.rows[0].cells[i].innerHTML;
                //alert(newcell.childNodes);
                switch(newcell.childNodes[0].type) {
                    case "text":
                            newcell.childNodes[0].value = "";
                            break;
                    case "checkbox":
                            newcell.childNodes[0].checked = false;
                            break;
                    case "select-one":
                            newcell.childNodes[0].selectedIndex = 0;
                            break;
                }
            }
        }
 
        function deleteRow(tableID) {
            try {
            var table = document.getElementById(tableID);
            var rowCount = table.rows.length;
 
            for(var i=0; i<rowCount; i++) {
                var row = table.rows[i];
                var chkbox = row.cells[0].childNodes[0];
                if(null != chkbox && true == chkbox.checked) {
                    if(rowCount <= 1) {
                        alert("Cannot delete all the rows.");
                        break;
                    }
                    table.deleteRow(i);
                    rowCount--;
                    i--;
                }
 
 
            }
            }catch(e) {
                alert(e);
            }
        }
        
        function deleteRow2(tableID) {
            try {
            var table = document.getElementById(tableID);
            var rowCount = table.rows.length;
 
            for(var i=0; i<rowCount; i++) {
                var row = table.rows[i];
                var chkbox = row.cells[0].childNodes[0];
                if(null != chkbox && true == chkbox.checked) {
                    if(rowCount <= 0) {
                        alert("Cannot delete all the rows.");
                        break;
                    }
                    table.deleteRow(i);
                    rowCount--;
                    i--;
                }
 
 
            }
            }catch(e) {
                alert(e);
            }
        }
 
    function addRowEntry(tableID)
    {
      var table = document.getElementById(tableID);
      var rowCount = table.rows.length;
      // create a row element
      var row = document.createElement("tr");
      // add the row to the table
      table.appendChild(row);
      var colCount = table.rows[0].cells.length;
      for(var i=0; i<colCount; i++) 
      {
       var newcell = row.insertCell(i);
       newcell.innerHTML = table.rows[0].cells[i].innerHTML;
      }

    }
 
function DisEnableTYP()
{
var frmTYPE = document.getElementById("council");
var frmPlan = document.getElementById("planning_application_date");
var frmApp = document.getElementById("planning_approval_date");
var frmWar = document.getElementById("warrantyinsuranceid");
var frmCert = document.getElementById("certifierid");
var frmDev = document.getElementById("dev_approval_date");

if(frmTYPE.options[frmTYPE.selectedIndex].value == "By Vergola")
 {
    frmPlan.disabled = false;
    frmApp.disabled = false;
    frmWar.disabled = false;
    frmCert.disabled = false;
    frmDev.disabled = false;
    document.getElementById('statutory-approval').style.display = 'block'; 
    
 }
else
 {
    frmPlan.disabled = true;
    frmApp.disabled = true;
    frmWar.disabled = true;
    frmCert.disabled = true;
    frmDev.disabled = true;
    document.getElementById('statutory-approval').style.display = 'none';  
 }
}

$(document).ready(function() {
if ($('#council option:selected').val() == 'By Vergola'){
    $('#statutory-approval').show();
  }else{
    $('#statutory-approval').hide();
  }
});



function delete_pdf_letter(event,o){
  if(confirm('Are you sure you want to delete document?')){
    // alert("deleting"); 
    event.preventDefault();
    //var d = event.target.attributes;
    

    $("#pdf_cf_id").val($(o).attr('cf_id'));
  

    var action = $("#form_pdf").attr('action');  
    var iData = $("#form_pdf").serialize(); 
    //console.log(iData);  //return;

    $.ajax({
        type: "POST",
        url: action,
        dataType: 'json',   
        data: iData,  
        success: function(data) {         
          if(data.success==true){  
            //console.log(data); 
            // window.href("");
            // $(o).parent().parent("tr").remove();
            // //console.log($(o).parent().parent().remove());
            //  $(o).fadeTo("slow", 0.01, function(){
            //     $(this).slideUp("slow", function() { //slide up
            //            $(this).remove(); //then remove from the DOM
            //        });
            //  });

            $(o).parent().parent("tr").slideUp(250, function(){ $(this).remove() } );

          }else{
            $("#notification .message").show().addClass('error'); 
          }
   

        }   
      });

      return false;
    }
  } 



</script>

</body>
</html>


<?php
function list_statutory($name="",$selected=null){  
  $sqlcolour = "SELECT * FROM ver_chronoforms_data_colour_vic ORDER BY colour";
  $resultcolour = mysql_query ($sqlcolour);
  $r = "<select class='colour' name='{$name}' style='padding:2px 2px 2px 130px;' >";
  while ($colour = mysql_fetch_assoc($resultcolour)) 
  { 
    $r .= "<option value='{$colour['colour']}' ";
    if ($selected != null && $colour['colour'] == $selected) { $r .= " selected=\"selected\"";} 
    else {$r .= "";}
    $r .= ">{$colour['colour']}</option>";
  }
  $r .= "</select>";
  return $r;
}

function list_Stat_Req_Planning($name="",$selected=null){  
  $sqlcolour = "SELECT * FROM ver_chronoforms_data_colour_vic ORDER BY colour";
  $resultcolour = mysql_query ($sqlcolour);
  $r = "<select class='colour' name='{$name}' style='padding:2px 2px 2px 130px;'>";
  while ($colour = mysql_fetch_assoc($resultcolour)) 
  { 
    $r .= "<option value='{$colour['colour']}' ";
    if ($selected != null && $colour['colour'] == $selected) { $r .= " selected=\"selected\"";} 
    else {$r .= "";}
    $r .= ">{$colour['colour']}</option>";
  }
  $r .= "</select>";
  return $r;
}




?>