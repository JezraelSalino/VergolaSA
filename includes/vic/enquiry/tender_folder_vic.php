<?php
include 'includes/vic/custom_processes_user.php';

$current_signed_in_user_access_profiles = $custom_configs_user['user_access_profiles'][$current_signed_in_user_group_key]['tender-folder-vic'];
?>
<script src="<?php echo JURI::base().'jscript/jsapi.js'; ?>"></script>
<script src="<?php echo JURI::base().'jscript/jquery.min.js'; ?>"></script>
<script src="<?php echo JURI::base().'jscript/labels.js'; ?>"></script>
<script type="text/javascript" src="<?php echo JURI::base().'jscript/tabcontent.js'; ?>"></script>

<script charset="UTF-8" type="text/javascript" src="<?php echo JURI::base().'jscript/datetime/js/jquery-1.8.3.min.js'; ?>"></script>
<script type="text/javascript" src="<?php echo JURI::base().'jscript/datetime/js/bootstrap.min.js'; ?>"></script>
<script charset="UTF-8" type="text/javascript" src="<?php echo JURI::base().'jscript/datetime/js/bootstrap-datetimepicker.js'; ?>"></script>


<link rel="stylesheet" type="text/css" media="screen,projection" href="<?php echo JURI::base().'jscript/custom.css'; ?>" />
<link rel="stylesheet" type="text/css" media="screen,projection" href="<?php echo JURI::base().'jscript/new-enquiry.css'; ?>" />
<link rel="stylesheet" type="text/css" media="screen,projection" href="<?php echo JURI::base().'jscript/client-folder.css'; ?>" />

<link rel="stylesheet" type="text/css" media="screen,projection" href="<?php echo JURI::base().'jscript/datetime/css/bootstrap.min.css'; ?>" />
<link rel="stylesheet" type="text/css" media="screen,projection" href="<?php echo JURI::base().'jscript/datetime/css/bootstrap-datetimepicker.min.css'; ?>" />

<?php 

if(isset($_POST['save_new_builder_to_lookup_table'])){ 
  
$next_increment = 0;

$qShowStatus = "SHOW TABLE STATUS LIKE 'ver_chronoforms_data_clientpersonal_vic'";
$qShowStatusResult = mysql_query($qShowStatus) or die ( "Query failed: " . mysql_error() . "<br/>" . $qShowStatus );
$row = mysql_fetch_assoc($qShowStatusResult);
$next_increment = $row['Auto_increment'];
//$next_increment++;

$client_code = "";
if(HOST_SERVER=="Victoria"){
  $client_code = "CRV";
}else if(HOST_SERVER=="SA"){
  $client_code = "CR";
}else if(HOST_SERVER=="LA"){
  $client_code = "CRC";
}

  $clientid = $client_code.$next_increment;

  $builder_name = mysql_escape_string($_POST['nbuilder_name']);  
  $SiteStreetNo = mysql_escape_string($_POST['nstreetno']);
  $SiteStreetName = mysql_escape_string($_POST['nstreetname']);
  $SiteAddress1 = mysql_escape_string($_POST['naddress1']);
  $SiteAddress2 = mysql_escape_string($_POST['naddress2']); 
  $SiteSuburb = mysql_escape_string($_POST['nsuburb']);
  $SiteState = mysql_escape_string($_POST['nstate']);
  $SitePostcode = $_POST['npostcode'];
  $SiteWKPhone = $_POST['nworkphone'];
   

  $sql = "INSERT INTO ver_chronoforms_data_builderpersonal_lookup
               (clientid, 
               builder_name,
                address1,
                address2,
                suburb,
                state,
                postcode,
                workphone
                  ) 
     VALUES ( '$clientid',  
          '$builder_name',
          '$SiteAddress1',
         '$SiteAddress2',
         '$SiteSuburb',
         '$SiteState',
         '$SitePostcode',
         '$SiteWKPhone' )";

    // error_log("INSERT to look up: ".$sql, 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_sa\\my-error.log'); //exit();
    mysql_query($sql);
    $result_id  = mysql_insert_id();

    //header('Location:'.JURI::base().'new-builder-enquiry-vic'); 
    $result = array('success' => true, 'note' => '');

    echo json_encode($result);
    exit();

}
 
date_default_timezone_set('Australia/Victoria');
?>
<?php   
$user = JFactory::getUser();
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

$id = isset($_REQUEST['pid'])?$_REQUEST['pid']:"";
$pid = isset($_REQUEST['pid'])?$_REQUEST['pid']:"";
$cid = isset($_REQUEST['quoteid'])?$_REQUEST['quoteid']:"";   
$cid = isset($_REQUEST['cid'])?$_REQUEST['cid']:""; 
$has_contract = 0;
 
 
$cf_id = "0";
if(isset($_REQUEST['cf_id']) && $_REQUEST['cf_id']>0){
  $cf_id = mysql_real_escape_string($_REQUEST['cf_id']);
}

$is_tender_quote = 1;

 
$drawid = isset($_POST['drawingid']) ? $_POST['drawingid'] : NULL;
$picid = isset($_POST['picid']) ? $_POST['picid'] : NULL;
$fileid = isset($_POST['fileid']) ? $_POST['fileid'] : NULL;

$next_increment = 0;
$qShowStatus = "SHOW TABLE STATUS LIKE 'ver_chronoforms_data_clientpersonal_vic'";
$qShowStatusResult = mysql_query($qShowStatus) or die ( "Query failed: " . mysql_error() . "<br/>" . $qShowStatus );
$row = mysql_fetch_assoc($qShowStatusResult);
$next_increment = $row['Auto_increment'];
$getclientid = 'BRV'.$next_increment;

$id = $_REQUEST['tenderid'];
$sql = "SELECT *, DATE_FORMAT(datelodged,'".SQL_DFORMAT."') fdatelodged, DATE_FORMAT(appointmentdate,'".SQL_DFORMAT." @ %h:%i %p') fappointmentdate FROM ver_chronoforms_data_clientpersonal_vic WHERE tenderid  = '$id'";
$result = mysql_query($sql);
//error_log($sql, 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_sa\\my-error.log');
$retrieve = mysql_fetch_array($result);
if (!$result) 
{
	die("Error: Data not found..");
}
		
$resultbuilder = mysql_query("SELECT pid, clientid FROM ver_chronoforms_data_clientpersonal_vic WHERE tenderid = '$id'");
if (!$resultbuilder) 
		{
		die("Error: Data not found!..");
		}
if (mysql_num_rows($resultbuilder) >=1) {
mysql_data_seek($resultbuilder, 0);
$row1 = mysql_fetch_row($resultbuilder);
$pid1 = $row1[0];
$BuildID1 = $row1[1]; }

//error_log("   BuildID1: ".$BuildID1." id".$id, 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_sa\\my-error.log');

if (mysql_num_rows($resultbuilder) >=2) {
mysql_data_seek($resultbuilder, 1);
$row2 = mysql_fetch_row($resultbuilder);
$pid2 = $row2[0];
$BuildID2 = $row2[1]; }

if (mysql_num_rows($resultbuilder) >=3) {
mysql_data_seek($resultbuilder, 2);
$row3 = mysql_fetch_row($resultbuilder);
$pid3 = $row3[0];
$BuildID3 = $row3[1]; }

if (mysql_num_rows($resultbuilder) >=4) {
mysql_data_seek($resultbuilder, 3);
$row4 = mysql_fetch_row($resultbuilder);
$pid4 = $row4[0];
$BuildID4 = $row4[1]; }

if (mysql_num_rows($resultbuilder) >=5) {
mysql_data_seek($resultbuilder, 4);
$row5 = mysql_fetch_row($resultbuilder);
$pid5 = $row5[0];
$BuildID5 = $row5[1]; }

if (mysql_num_rows($resultbuilder) >=6) {
mysql_data_seek($resultbuilder, 5);
$row6 = mysql_fetch_row($resultbuilder);
$pid6 = $row6[0];
$BuildID6 = $row6[1]; }
	
 
	// $result1 = mysql_query("SELECT * FROM ver_chronoforms_data_builderpersonal_vic WHERE  pid = '$pid1'");
 //    $retrieve1 = mysql_fetch_array($result1);										
 //    $BuildSuburbID1 = $retrieve1['builder_suburbid'] ;
	// $BuildName1 = $retrieve1['builder_name'] ;
	// $BuildContact1 = $retrieve1['builder_contact'];					
	// $BuildAddress11 = $retrieve1['builder_address1'] ;
	// $BuildAddress21 = $retrieve1['builder_address2'] ;
	// $BuildSuburb1 = $retrieve1['builder_suburb'] ;
	// $BuildState1 = $retrieve1['builder_state'];					
	// $BuildPostcode1 = $retrieve1['builder_postcode'] ;
	// $BuildWPhone1 = $retrieve1['builder_wkphone'] ;
	// $BuildMobile1 = $retrieve1['builder_mobile'];					
	// $BuildFax1 = $retrieve1['builder_fax'] ;
	// $BuildOther1 = $retrieve1['builder_other'] ;
	// $BuildEmail1 = $retrieve1['builder_email'] ; 

	//get client record counter part data in client table
	$result_a = mysql_query("SELECT * FROM ver_chronoforms_data_clientpersonal_vic WHERE  tenderid = '".$retrieve1['tenderid']."'");
    $client_tender = mysql_fetch_array($result_a);	
    $Status = $client_tender['status'];

	$tender_builders = array();
    while( $row = mysql_fetch_assoc( $result_a ) ) {
    	 array_push($tender_builders, $row); 
    }	


    $result1 = mysql_query("SELECT * FROM ver_chronoforms_data_clientpersonal_vic WHERE  pid = '$pid1'");
    $retrieve1 = mysql_fetch_array($result1);	 
	$BuildSuburbID1 = $retrieve1['builder_suburbid'] ;
	$BuildName1 = $retrieve1['builder_name'] ;
	$BuildContact1 = $retrieve1['builder_contact'];					
	$BuildAddress11 = $retrieve1['client_address1'] ;
	$BuildAddress21 = $retrieve1['client_address2'] ;
	$BuildSuburb1 = $retrieve1['client_suburb'] ;
	$BuildState1 = $retrieve1['client_state'];					
	$BuildPostcode1 = $retrieve1['client_postcode'] ;
	$BuildWPhone1 = $retrieve1['client_wkphone'] ;
	$BuildMobile1 = $retrieve1['client_mobile'];					
	$BuildFax1 = $retrieve1['fax'] ;
	$BuildOther1 = $retrieve1['client_other'] ;
	$BuildEmail1 = $retrieve1['client_email'] ; 

    //error_log("SELECT * FROM ver_chronoforms_data_clientpersonal_vic WHERE  tenderid = '".$retrieve1['tenderid']."'", 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_sa\\my-error.log');
    //error_log(print_r($tender_builder,true), 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_sa\\my-error.log');

	$result2 = mysql_query("SELECT * FROM ver_chronoforms_data_clientpersonal_vic WHERE pid = '$pid2'");
    $retrieve2 = mysql_fetch_array($result2);
	$BuildSuburbID2 = $retrieve2['builder_suburbid'] ;
	$BuildName2 = $retrieve2['builder_name'] ;
	$BuildContact2 = $retrieve2['builder_contact'];					
	$BuildAddress12 = $retrieve2['client_address1'] ;
	$BuildAddress22 = $retrieve2['client_address2'] ;
	$BuildSuburb2 = $retrieve2['client_suburb'] ;
	$BuildState2 = $retrieve2['client_state'];					
	$BuildPostcode2 = $retrieve2['client_postcode'] ;
	$BuildWPhone2 = $retrieve2['client_wkphone'] ;
	$BuildMobile2 = $retrieve2['client_mobile'];					
	$BuildFax2 = $retrieve2['fax'] ;
	$BuildEmail2 = $retrieve2['client_email'] ;
	
	$result3 = mysql_query("SELECT * FROM ver_chronoforms_data_clientpersonal_vic WHERE pid = '$pid3'");
    $retrieve3 = mysql_fetch_array($result3);
	$BuildSuburbID3 = $retrieve3['builder_suburbid'] ;
	$BuildName3 = $retrieve3['builder_name'] ;
	$BuildContact3 = $retrieve3['builder_contact'];					
	$BuildAddress13 = $retrieve3['client_address1'] ;
	$BuildAddress23 = $retrieve3['client_address2'] ;
	$BuildSuburb3 = $retrieve3['client_suburb'] ;
	$BuildState3 = $retrieve3['client_state'];					
	$BuildPostcode3 = $retrieve3['client_postcode'] ;
	$BuildWPhone3 = $retrieve3['client_wkphone'] ;
	$BuildMobile3 = $retrieve3['client_mobile'];					
	$BuildFax3 = $retrieve3['fax'] ;
	$BuildEmail3 = $retrieve3['client_email'] ;

	
	$result4 = mysql_query("SELECT * FROM ver_chronoforms_data_clientpersonal_vic WHERE pid = '$pid4'");
    $retrieve4 = mysql_fetch_array($result4);
	$BuildSuburbID4 = $retrieve4['builder_suburbid'] ;
	$BuildName4 = $retrieve4['builder_name'] ;
	$BuildContact4 = $retrieve4['builder_contact'];					
	$BuildAddress14 = $retrieve4['client_address1'] ;
	$BuildAddress24 = $retrieve4['client_address2'] ;
	$BuildSuburb4 = $retrieve4['client_suburb'] ;
	$BuildState4 = $retrieve4['client_state'];					
	$BuildPostcode4 = $retrieve4['client_postcode'] ;
	$BuildWPhone4 = $retrieve4['client_wkphone'] ;
	$BuildMobile4 = $retrieve4['client_mobile'];					
	$BuildFax4 = $retrieve4['fax'] ;
	$BuildEmail4 = $retrieve4['client_email'] ;
	
	$result5 = mysql_query("SELECT * FROM ver_chronoforms_data_clientpersonal_vic WHERE pid = '$pid5'");
    $retrieve5 = mysql_fetch_array($result5);
	$BuildSuburbID5 = $retrieve5['builder_suburbid'] ;
	$BuildName5 = $retrieve5['builder_name'] ;
	$BuildContact5 = $retrieve5['builder_contact'];					
	$BuildAddress15 = $retrieve5['client_address1'] ;
	$BuildAddress25 = $retrieve5['client_address2'] ;
	$BuildSuburb5 = $retrieve5['client_suburb'] ;
	$BuildState5 = $retrieve5['client_state'];					
	$BuildPostcode5 = $retrieve5['client_postcode'] ;
	$BuildWPhone5 = $retrieve5['client_wkphone'] ;
	$BuildMobile5 = $retrieve5['client_mobile'];					
	$BuildFax5 = $retrieve5['fax'] ;
	$BuildEmail5 = $retrieve5['client_email'] ;
	
	$result6 = mysql_query("SELECT * FROM ver_chronoforms_data_clientpersonal_vic WHERE pid = '$pid6'");
    $retrieve6 = mysql_fetch_array($result6);
	$BuildSuburbID6 = $retrieve6['builder_suburbid'];
	$BuildName6 = $retrieve6['builder_name'];
	$BuildContact6 = $retrieve6['builder_contact'];					
	$BuildAddress16 = $retrieve6['client_address1'] ;
	$BuildAddress26 = $retrieve6['client_address2'];
	$BuildSuburb6 = $retrieve6['client_suburb'];
	$BuildState6 = $retrieve6['client_state'];					
	$BuildPostcode6 = $retrieve6['client_postcode'];
	$BuildWPhone6 = $retrieve6['client_wkphone'];
	$BuildMobile6 = $retrieve6['client_mobile'];					
	$BuildFax6 = $retrieve6['fax'];
	$BuildEmail6 = $retrieve6['client_email'];


	$SiteProject = $retrieve['tender_project_name'];
	$SiteStreetNo = $retrieve['site_streetno'];
    $SiteStreetName = $retrieve['site_streetname']; 
	$SiteAddress1 = $retrieve['site_address1'];
	$SiteAddress2 = $retrieve['site_address2'];
	$SiteSuburbID = $retrieve['site_suburbid'];
	$SiteSuburb = $retrieve['site_suburb'];
	$SiteState = $retrieve['site_state'];
	$SitePostcode = $retrieve['site_postcode'];
	$SiteWPhone = $retrieve['site_wkphone'];
	$SiteHPhone = $retrieve['site_hmphone'];
	$SiteMobile = $retrieve['site_mobile'];
	$SiteOther = $retrieve['site_other'];
	$SiteEmail = $retrieve['site_email'];
	$TenderStatus = "Yes";
	$TenderID = $retrieve['tenderid'];
	$QuoteID = $TenderID;
	
	$date = $retrieve['datelodged'];
    $DateLodged = date('d-M-Y', strtotime($date));
	$DateNow = date("Y-m-d H:i:s");
	$datepoint = $retrieve['appointmentdate'];
    $AppointmentLodged = date('d-M-Y @ h:i A', strtotime($datepoint));
    $RepID = $retrieve['repid'];
	$RepIdent = $retrieve['repident'];
	$RepName = $retrieve['repname'];
	
	$LeadID = $retrieve['leadid'];
	$LeadName = $retrieve['leadname'];
	
	$EmployeeID = $retrieve['employeeid'];
	$NotesID = $retrieve['pid'];
	$ClientID = 'BRV'.$NotesID;
 
//error_log(" HERE #0: ", 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_sa\\my-error.log');
//error_log(" HERE: A1 ".print_r($_POST,true), 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_sa\\my-error.log'); 
if(isset($_POST['save']) || isset($_POST['sendmail']))
{	     
 
		//error_log(" HERE #1: ", 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_sa\\my-error.log');
        $BuilderSuburbID1 = $_POST['bsuburbid1'];
	    $BuilderName1 = $_POST['builder_name1'];
	    $BuilderContact1 = $_POST['builder_contact1'];				
	    $BuilderAddress11 = $_POST['baddress11'];
	    $BuilderAddress21 = $_POST['baddress21'];
	    $BuilderSuburb1 = $_POST['builder_suburb1'];
	    $BuilderState1 = $_POST['builder_state1'];			
	    $BuilderPostcode1 = $_POST['builder_postcode1'];
	    $BuilderWPhone1 = $_POST['bwphone1'];
	    $BuilderMobile1 = $_POST['bmobile1'];
	    $BuilderFax1 = $_POST['bfax1'];
	    $BuilderOther1 = $_POST['bother1'];
	    $BuilderEmail1 = $_POST['bemail1'];

        $BuilderSuburbID2 = $_POST['bsuburbid2'];
	    $BuilderName2 = $_POST['builder_name2'];
	    $BuilderContact2 = $_POST['builder_contact2'];				
	    $BuilderAddress12 = $_POST['baddress12'];
	    $BuilderAddress22 = $_POST['baddress22'];
	    $BuilderSuburb2 = $_POST['builder_suburb2'];
	    $BuilderState2 = $_POST['builder_state2'];					
	    $BuilderPostcode2 = $_POST['builder_postcode2'];
	    $BuilderWPhone2 = $_POST['bwphone2'];
	    $BuilderMobile2 = $_POST['bmobile2'];
	    $BuilderFax2 = $_POST['bfax2'];
	    $BuilderEmail2 = $_POST['bemail2'];
		
		$BuilderSuburbID3 = $_POST['bsuburbid3'];
	    $BuilderName3 = $_POST['builder_name3'];
	    $BuilderContact3 = $_POST['builder_contact3'];					
	    $BuilderAddress13 = $_POST['baddress13'];
	    $BuilderAddress23 = $_POST['baddress23'];
	    $BuilderSuburb3 = $_POST['builder_suburb3'];
	    $BuilderState3 = $_POST['builder_state3'];				
	    $BuilderPostcode3 = $_POST['builder_postcode3'];
	    $BuilderWPhone3 = $_POST['bwphone3'];
	    $BuilderMobile3 = $_POST['bmobile3'];				
	    $BuilderFax3 = $_POST['bfax3'];
	    $BuilderEmail3 = $_POST['bemail3'];
		
		$BuilderSuburbID4 = $_POST['bsuburbid4'];
	    $BuilderName4 = $_POST['builder_name4'];
	    $BuilderContact4 = $_POST['builder_contact4'];					
	    $BuilderAddress14 = $_POST['baddress14'];
	    $BuilderAddress24 = $_POST['baddress24'];
	    $BuilderSuburb4 = $_POST['builder_suburb4'];
	    $BuilderState4 = $_POST['builder_state4'];					
	    $BuilderPostcode4 = $_POST['builder_postcode4'];
	    $BuilderWPhone4 = $_POST['bwphone4'];
	    $BuilderMobile4 = $_POST['bmobile4'];					
	    $BuilderFax4 = $_POST['bfax4'];
	    $BuilderEmail4 = $_POST['bemail4'];
		
		$BuilderSuburbID5 = $_POST['bsuburbid5'];
	    $BuilderName5 = $_POST['builder_name5'];
	    $BuilderContact5 = $_POST['builder_contact5'];					
	    $BuilderAddress15 = $_POST['baddress15'];
	    $BuilderAddress25 = $_POST['baddress25'];
	    $BuilderSuburb5 = $_POST['builder_suburb5'];
	    $BuilderState5 = $_POST['builder_state5'];					
	    $BuilderPostcode5 = $_POST['builder_postcode5'];
	    $BuilderWPhone5 = $_POST['bwphone5'];
	    $BuilderMobile5 = $_POST['bmobile5'];					
	    $BuilderFax5 = $_POST['bfax5'];
	    $BuilderEmail5 = $_POST['bemail5'];
		
		$BuilderSuburbID6 = $_POST['bsuburbid6'];
	    $BuilderName6 = $_POST['builder_name6'];
	    $BuilderContact6 = $_POST['builder_contact6'];					
	    $BuilderAddress16 = $_POST['baddress16'];
	    $BuilderAddress26 = $_POST['baddress26'];
	    $BuilderSuburb6 = $_POST['builder_suburb6'] ;
	    $BuilderState6 = $_POST['builder_state6'];					
	    $BuilderPostcode6 = $_POST['builder_postcode6'];
	    $BuilderWPhone6 = $_POST['bwphone6'];
	    $BuilderMobile6 = $_POST['bmobile6'];					
	    $BuilderFax6 = $_POST['bfax6'];
	    $BuilderEmail6 = $_POST['bemail6'];


	    $SiteProject = $_POST['sprojectname'];
	    $SiteStreetNo = $retrieve['site_streetno'];
    	$SiteStreetName = $retrieve['site_streetname']; 
		$SiteAddress1 = $_POST['saddress1'];
		$SiteAddress2 = $_POST['saddress2'];
		$SiteSuburbID = $_POST['ssuburbid'];
		$SiteSuburb = $_POST['site_suburb'];
		$SiteState = $_POST['site_state'];
		$SitePostcode = $_POST['site_postcode'];
		$SiteWKPhone = $_POST['swkphone'];
	    $SiteHMPhone = $_POST['shmphone'];
		$SiteMobile = $_POST['smobile'];
		$SiteOther = $_POST['sother'];
		$SiteEmail = $_POST['semail'];
  

	    //error_log(" dtp_appointment: ".$_POST['dtp_appointment'], 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_sa\\my-error.log');
	    if(empty($_POST['dtp_appointment'])==true || $_POST['dtp_appointment']=="0000-00-00 00:00:00")
		    $AppointmentLodged = "NULL";
		else
		    $AppointmentLodged = $_POST['dtp_appointment'];

			  
		$date =  $_POST['idate'];
		$timestamp = date('Y-m-d H:i:s', strtotime($date)); 
		$DateLodged = $timestamp;  

		$RepID = $_POST['repid'];
		$RepIdent = $_POST['repident'];
		$RepName = $_POST['repname'];
		
		$LeadID = $_POST['leadid'];
		$LeadName = $_POST['leadname'];
		


   if (true) { //$BuilderName1!=$BuildName1
       	$sql = "UPDATE ver_chronoforms_data_clientpersonal_vic SET 
		             clientid ='$BuildID1', 
					 builder_name ='$BuilderName1', 
					 builder_contact ='$BuilderContact1', 
					 client_address1 ='$BuilderAddress11', 
					 client_address2 ='$BuilderAddress21',
					 client_suburb ='$BuilderSuburb1',
					 client_state ='$BuilderState1',
					 client_postcode ='$BuilderPostcode1',
					 client_wkphone ='$BuilderWPhone1',
					 client_mobile ='$BuilderMobile1',
					 fax ='$BuilderFax1',
					 client_other ='$BuilderOther1',
					 client_email ='$BuilderEmail1',

					 site_suburbid = '$SiteSuburbID',
	                tender_project_name = '$SiteProject',
	                site_address1 = '$SiteAddress1',
	                site_address2 = '$SiteAddress2',
	                site_suburb = '$SiteSuburb',
	                site_state = '$SiteState',
	                site_postcode = '$SitePostcode',
	                site_wkphone = '$SiteWKPhone',
	                site_hmphone = '$SiteHMPhone',
	                site_mobile = '$SiteMobile',
	                site_other = '$SiteOther',
	                site_email = '$SiteEmail', 
					 datelodged = '$DateLodged', 
					 site_mobile = '$SiteMobile', 
					 site_other = '$SiteOther',
					 repid = '$RepID',
	                 repident = '$RepIdent',
	                 repname = '$RepName',
	                 leadid = '$LeadID',
	                 leadname = '$LeadName',
					 appointmentdate = '$AppointmentLodged'


					 WHERE pid = '$pid1'";

					mysql_query($sql);
		//error_log(" HERE #1: ".$sql, 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_sa\\my-error.log');
   } 
   
   //error_log(" HERE #3: ", 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_sa\\my-error.log');
   if ($BuilderName2!="" && $BuildName2=="") 
   { 
   		$next_increment = 0;
		$qShowStatus = "SHOW TABLE STATUS LIKE 'ver_chronoforms_data_clientpersonal_vic'";
		$qShowStatusResult = mysql_query($qShowStatus) or die ( "Query failed: " . mysql_error() . "<br/>" . $qShowStatus );
		$row = mysql_fetch_assoc($qShowStatusResult);
		$next_increment = $row['Auto_increment'];
		$getclientid = 'BRV'.$next_increment;

   		mysql_query("INSERT INTO ver_chronoforms_data_clientpersonal_vic 
                 (clientid, builder_name, builder_contact, client_address1, client_address2,
				  client_suburb, client_state, client_postcode, client_wkphone, client_mobile, fax,
				  client_email, site_suburbid, tender_project_name, site_address1, site_address2, site_suburb,
				  site_state, site_postcode, site_wkphone, site_hmphone, site_mobile, site_other, site_email,
				    tenderid, datelodged, repid, repident, repname, leadid, leadname, appointmentdate,
				  employeeid) 
							  
	      VALUES('$getclientid',  '$BuilderName2', '$BuilderContact2', '$BuilderAddress12',
                 '$BuilderAddress22', '$BuilderSuburb2', '$BuilderState2', '$BuilderPostcode2', '$BuilderWPhone2',
                 '$BuilderMobile2', '$BuilderFax2', '$BuilderEmail2',
				 
				 '$SiteSuburbID', '$SiteProject', '$SiteAddress1', '$SiteAddress2', '$SiteSuburb', '$SiteState',
				 '$SitePostcode', '$SiteWPhone', '$SiteHPhone', '$SiteMobile', '$SiteOther', '$SiteEmail',
				   '$TenderID', 
                 
                 '$DateNow', '$RepID', '$RepIdent', '$RepName', '$LeadID', '$LeadName', '$AppointmentLodged',
				 '$EmployeeID')");
	   mysql_query($sql);
	}
	
	if (true) { // 
		$sql = "UPDATE ver_chronoforms_data_clientpersonal_vic SET 
		             clientid ='$BuildID2', 
					 builder_name ='$BuilderName2', 
					 builder_contact ='$BuilderContact2', 
					 client_address1 ='$BuilderAddress12', 
					 client_address2 ='$BuilderAddress22',
					 client_suburb ='$BuilderSuburb2',
					 client_state ='$BuilderState2',
					 client_postcode ='$BuilderPostcode2',
					 client_wkphone ='$BuilderWPhone2',
					 client_mobile ='$BuilderMobile2',
					 fax ='$BuilderFax2',
					 client_email ='$BuilderEmail2'
					 WHERE pid = '$pid2'";
		mysql_query($sql);

		//error_log(" HERE #2: ".$sql, 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_sa\\my-error.log'); 
   } 
   
   if ($BuilderName3!="" && $BuildName3=="") 
   {
   		$next_increment = 0;
		$qShowStatus = "SHOW TABLE STATUS LIKE 'ver_chronoforms_data_clientpersonal_vic'";
		$qShowStatusResult = mysql_query($qShowStatus) or die ( "Query failed: " . mysql_error() . "<br/>" . $qShowStatus );
		$row = mysql_fetch_assoc($qShowStatusResult);
		$next_increment = $row['Auto_increment'];
		$getclientid = 'BRV'.$next_increment;

		$sql = "INSERT INTO ver_chronoforms_data_clientpersonal_vic 
                 (clientid, builder_name, builder_contact, client_address1, client_address2,
				  client_suburb, client_state, client_postcode, client_wkphone, client_mobile, fax,
				  client_email, site_suburbid, tender_project_name, site_address1, site_address2, site_suburb,
				  site_state, site_postcode, site_wkphone, site_hmphone, site_mobile, site_other, site_email,
				    tenderid, datelodged, repid, repident, repname, leadid, leadname, appointmentdate,
				  employeeid) 
							  
	      VALUES('$getclientid', '$BuilderName3', '$BuilderContact3', '$BuilderAddress13',  '$BuilderAddress23',
	      		 '$BuilderSuburb3', '$BuilderState3', '$BuilderPostcode3', '$BuilderWPhone3',
                 '$BuilderMobile3', '$BuilderFax3', '$BuilderEmail3',
				 
				 '$SiteSuburbID', '$SiteProject', '$SiteAddress1', '$SiteAddress2', '$SiteSuburb', '$SiteState',
				 '$SitePostcode', '$SiteWPhone', '$SiteHPhone', '$SiteMobile', '$SiteOther', '$SiteEmail',
				  '$TenderID',                 
                 '$DateNow', '$RepID', '$RepIdent', '$RepName', '$LeadID', '$LeadName', '$AppointmentLodged',
				 '$EmployeeID')";

   		mysql_query($sql);
   		
	   
	   } 
	

	if (true) {//$BuilderName3!=$BuildName3
        
		$sql = "UPDATE ver_chronoforms_data_clientpersonal_vic SET 
		             clientid ='$BuildID3', 
					 builder_name ='$BuilderName3', 
					 builder_contact ='$BuilderContact3', 
					 client_address1 ='$BuilderAddress13', 
					 client_address2 ='$BuilderAddress23',
					 client_suburb ='$BuilderSuburb3',
					 client_state ='$BuilderState3',
					 client_postcode ='$BuilderPostcode3',
					 client_wkphone ='$BuilderWPhone3',
					 client_mobile ='$BuilderMobile3',
					 fax ='$BuilderFax3',
					 client_email ='$BuilderEmail3'
					 WHERE pid = '$pid3'";
		mysql_query($sql);
		  
   } 
   

   if ($BuilderName4!="" && $BuildName4=="") 
   { 
   		$next_increment = 0;
		$qShowStatus = "SHOW TABLE STATUS LIKE 'ver_chronoforms_data_clientpersonal_vic'";
		$qShowStatusResult = mysql_query($qShowStatus) or die ( "Query failed: " . mysql_error() . "<br/>" . $qShowStatus );
		$row = mysql_fetch_assoc($qShowStatusResult);
		$next_increment = $row['Auto_increment'];
		$getclientid = 'BRV'.$next_increment;

   	$sql = "INSERT INTO ver_chronoforms_data_clientpersonal_vic 
                 (clientid,  builder_name, builder_contact, client_address1, client_address2,
				  client_suburb, client_state, client_postcode, client_wkphone, client_mobile, fax,
				  client_email, site_suburbid, tender_project_name, site_address1, site_address2, site_suburb,
				  site_state, site_postcode, site_wkphone, site_hmphone, site_mobile, site_other, site_email,
				    tenderid, datelodged, repid, repident, repname, leadid, leadname, appointmentdate,
				  employeeid) 
							  
	      VALUES('$getclientid', '$BuilderName4', '$BuilderContact4', '$BuilderAddress14',  '$BuilderAddress24', 
	      		 '$BuilderSuburb4', '$BuilderState4', '$BuilderPostcode4', '$BuilderWPhone4',
                 '$BuilderMobile4', '$BuilderFax4', '$BuilderEmail4',
				 
				 '$SiteSuburbID', '$SiteProject', '$SiteAddress1', '$SiteAddress2', '$SiteSuburb', '$SiteState',
				 '$SitePostcode', '$SiteWPhone', '$SiteHPhone', '$SiteMobile', '$SiteOther', '$SiteEmail',
				  '$TenderID',
                 
                 '$DateNow', '$RepID', '$RepIdent', '$RepName', '$LeadID', '$LeadName', '$AppointmentLodged',
				 '$EmployeeID')";

   	mysql_query($sql);
	//error_log($sql, 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_sa\\my-error.log');

	} 
	
	if (true) { //$BuilderName4!=$BuildName4
        
	
		mysql_query("UPDATE ver_chronoforms_data_clientpersonal_vic SET 
		             clientid ='$BuildID4', 
					 builder_name ='$BuilderName4', 
					 builder_contact ='$BuilderContact4', 
					 client_address1 ='$BuilderAddress14', 
					 client_address2 ='$BuilderAddress24',
					 client_suburb ='$BuilderSuburb4',
					 client_state ='$BuilderState4',
					 client_postcode ='$BuilderPostcode4',
					 client_wkphone ='$BuilderWPhone4',
					 client_mobile ='$BuilderMobile4',
					 fax ='$BuilderFax4',
					 client_email ='$BuilderEmail4'
					 WHERE pid = '$pid4'");
		  
   } 
   

   if ($BuilderName5!="" && $BuildName5=="") 
   { 
   		$next_increment = 0;
		$qShowStatus = "SHOW TABLE STATUS LIKE 'ver_chronoforms_data_clientpersonal_vic'";
		$qShowStatusResult = mysql_query($qShowStatus) or die ( "Query failed: " . mysql_error() . "<br/>" . $qShowStatus );
		$row = mysql_fetch_assoc($qShowStatusResult);
		$next_increment = $row['Auto_increment'];
		$getclientid = 'BRV'.$next_increment;

   		mysql_query("INSERT INTO ver_chronoforms_data_clientpersonal_vic 
                 (clientid, builder_name, builder_contact, client_address1, client_address2,
				  client_suburb, client_state, client_postcode, client_wkphone, client_mobile, fax,
				  client_email, site_suburbid, tender_project_name, site_address1, site_address2, site_suburb,
				  site_state, site_postcode, site_wkphone, site_hmphone, site_mobile, site_other, site_email,
				   tenderid, datelodged, repid, repident, repname, leadid, leadname, appointmentdate,
				  employeeid) 
							  
	      VALUES('$getclientid',  '$BuilderName5', '$BuilderContact5', '$BuilderAddress15',  '$BuilderAddress25', 
	      		'$BuilderSuburb5', '$BuilderState5', '$BuilderPostcode5', '$BuilderWPhone5',
                 '$BuilderMobile5', '$BuilderFax5', '$BuilderEmail5',
				 
				 '$SiteSuburbID', '$SiteProject', '$SiteAddress1', '$SiteAddress2', '$SiteSuburb', '$SiteState',
				 '$SitePostcode', '$SiteWPhone', '$SiteHPhone', '$SiteMobile', '$SiteOther', '$SiteEmail',
				  '$TenderID',
                 
                 '$DateNow', '$RepID', '$RepIdent', '$RepName', '$LeadID', '$LeadName', '$AppointmentLodged',
				 '$EmployeeID')");
	   
	   } 
	
	if (true) {   //$BuilderName5!=$BuildName5     
	
		mysql_query("UPDATE ver_chronoforms_data_clientpersonal_vic SET   
					 builder_name ='$BuilderName5', 
					 builder_contact ='$BuilderContact5', 
					 client_address1 ='$BuilderAddress15', 
					 client_address2 ='$BuilderAddress25',
					 client_suburb ='$BuilderSuburb5',
					 client_state ='$BuilderState5',
					 client_postcode ='$BuilderPostcode5',
					 client_wkphone ='$BuilderWPhone5',
					 client_mobile ='$BuilderMobile5',
					 fax ='$BuilderFax5',
					 client_email ='$BuilderEmail5'
					 WHERE pid = '$pid5'");
		  
   } 
   

   if ($BuilderName6!="" && $BuildName6=="") 
   { 	
   		$next_increment = 0;
		$qShowStatus = "SHOW TABLE STATUS LIKE 'ver_chronoforms_data_clientpersonal_vic'";
		$qShowStatusResult = mysql_query($qShowStatus) or die ( "Query failed: " . mysql_error() . "<br/>" . $qShowStatus );
		$row = mysql_fetch_assoc($qShowStatusResult);
		$next_increment = $row['Auto_increment'];
		$getclientid = 'BRV'.$next_increment;

   		mysql_query("INSERT INTO ver_chronoforms_data_clientpersonal_vic 
                 (clientid,  builder_name, builder_contact, client_address1, client_address2,
				  client_suburb, client_state, client_postcode, client_wkphone, client_mobile, fax,
				  client_email, site_suburbid, tender_project_name, site_address1, site_address2, site_suburb,
				  site_state, site_postcode, site_wkphone, site_hmphone, site_mobile, site_other, site_email,
				   tenderid, datelodged, repid, repident, repname, leadid, leadname, appointmentdate,
				  employeeid) 
							  
	      VALUES('$getclientid', '$BuilderName6', '$BuilderContact6', '$BuilderAddress16',
                 '$BuilderAddress26', '$BuilderSuburb6', '$BuilderState6', '$BuilderPostcode6', '$BuilderWPhone6',
                 '$BuilderMobile6', '$BuilderFax6', '$BuilderEmail6', 
				 '$SiteSuburbID', '$SiteProject', '$SiteAddress1', '$SiteAddress2', '$SiteSuburb', '$SiteState',
				 '$SitePostcode', '$SiteWPhone', '$SiteHPhone', '$SiteMobile', '$SiteOther', '$SiteEmail',
				  '$TenderID', 
                 '$DateNow', '$RepID', '$RepIdent', '$RepName', '$LeadID', '$LeadName', '$AppointmentLodged',
				 '$EmployeeID')");
	   
	   } 
	 
	if (true) { //$BuilderName6!=$BuildName6     

		$sql = "UPDATE ver_chronoforms_data_clientpersonal_vic SET 
		             clientid ='$BuildID6', 
					 builder_name ='$BuilderName6', 
					 builder_contact ='$BuilderContact6', 
					 client_address1 ='$BuilderAddress16', 
					 client_address2 ='$BuilderAddress26',
					 client_suburb ='$BuilderSuburb6',
					 client_state ='$BuilderState6',
					 client_postcode ='$BuilderPostcode6',
					 client_wkphone ='$BuilderWPhone6',
					 client_mobile ='$BuilderMobile6',
					 fax ='$BuilderFax6',
					 client_email ='$BuilderEmail6'
					 WHERE pid = '$pid6'";

		mysql_query($sql);
		error_log($sql, 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_sa\\my-error.log');
		  
   }

   if(isset($_POST['sendmail'])){

		$to = $_POST['repemail']; // this is the Sales Rep Email address
	    $from = $_POST['usermail']; // this is the sender's Email address	
	    $subject = "New Enquiry";
	    $subject2 = "Copy of your New Enquiry";
	    
		// Email to the Sales Rep
		$message = "<table cellpadding=\"0\" cellspacing=\"0\" style=\"border-top: 1px solid #999;width:550px; font-family:calibri; font-size:13px;\">
	  <tr>
	    <td style=\"width:120px;border-bottom: 1px solid #999;border-left: 1px solid #999;padding:5px;\"><img src='".JURI::base().'images/vergola-email-logo.png'."'></td>
	    <td style=\"border-bottom: 1px solid #999;border-right: 1px solid #999;border-left: 1px solid #999;padding:5px;\">Enquiry Date: " .$_POST['idate']. "</td>
	  </tr>
	  <tr>
	    <td style=\"border-bottom: 1px solid #999;border-left: 1px solid #999;padding:5px;\">From</td>
	    <td style=\"border-bottom: 1px solid #999;border-right: 1px solid #999;border-left: 1px solid #999;padding:5px;\">" . $_POST['username'] . "</td>
	  </tr>
	  <tr>
	    <td style=\"border-bottom: 1px solid #999;border-left: 1px solid #999;padding:5px;\">Sales Rep</td>
	    <td style=\"border-bottom: 1px solid #999;border-right: 1px solid #999;border-left: 1px solid #999;padding:5px;\">" . $_POST['repname'] . "</td>
	  </tr>
	  <tr>
	    <td style=\"border-bottom: 1px solid #999;border-left: 1px solid #999;padding:5px;\">Builder</td>
	    <td style=\"border-bottom: 1px solid #999;border-right: 1px solid #999;border-left: 1px solid #999;padding:5px;\">" . $_POST['builder_name'] . "</td>
	  </tr>
	  <tr>
	    <td style=\"border-bottom: 1px solid #999;border-left: 1px solid #999;padding:5px;\">Contact Name</td>
	    <td style=\"border-bottom: 1px solid #999;border-right: 1px solid #999;border-left: 1px solid #999;padding:5px;\">" . $_POST['builder_contact'] . "</td>
	  </tr>
	  <tr>
	    <td style=\"border-bottom: 1px solid #999;border-left: 1px solid #999;padding:5px;\">Project Name</td>
	    <td style=\"border-bottom: 1px solid #999;border-right: 1px solid #999;border-left: 1px solid #999;padding:5px;\">" . $_POST['sprojectname'] . "</td>
	  </tr>
	  <tr>
	    <td style=\"border-bottom: 1px solid #999;border-left: 1px solid #999;padding:5px;\">Address</td>
	    <td style=\"border-bottom: 1px solid #999;border-right: 1px solid #999;border-left: 1px solid #999;padding:5px;\">" . $_POST['saddress1'] . " " . $_POST['saddress2'] . ", " . $_POST['site_suburb'] . " " . $_POST['site_state'] . " " . $_POST['site_postcode'] . "</td>
	  </tr>
	  <tr>
	    <td style=\"border-bottom: 1px solid #999;border-left: 1px solid #999;padding:5px;\">Phone</td>
	    <td style=\"border-bottom: 1px solid #999;border-right: 1px solid #999;border-left: 1px solid #999;padding:5px;\">" . $_POST['bwphone'] ."</td>
	  </tr>
	  <tr>
	    <td style=\"border-bottom: 1px solid #999;border-left: 1px solid #999;padding:5px;\">Mobile</td>
	    <td style=\"border-bottom: 1px solid #999;border-right: 1px solid #999;border-left: 1px solid #999;padding:5px;\">" . $_POST['bmobile'] . "</td>
	  </tr>
	  <tr>
	    <td style=\"border-bottom: 1px solid #999;border-left: 1px solid #999;padding:5px;\">Email</td>
	    <td style=\"border-bottom: 1px solid #999;border-right: 1px solid #999;border-left: 1px solid #999;padding:5px;\">" . $_POST['bemail'] . "</td>
	  </tr>
	  <tr>
	    <td style=\"border-bottom: 1px solid #999;border-left: 1px solid #999;padding:5px;\">Drawing</td>
	    <td style=\"border-bottom: 1px solid #999;border-right: 1px solid #999;border-left: 1px solid #999;padding:5px;\">" . $_POST['checkfile'] . "</td>
	  </tr>
	  <tr>
	    <td style=\"border-bottom: 1px solid #999;border-left: 1px solid #999;padding:5px;\">Note</td>
	    <td style=\"border-bottom: 1px solid #999;border-right: 1px solid #999;border-left: 1px solid #999;padding:5px;\">" . $_POST['notestxt'] . "</td>
	  </tr>
	</table>";
	    
		
		//Email copy of the Sender
		$message2 = "<table cellpadding=\"0\" cellspacing=\"0\" style=\"border-top: 1px solid #999;width:550px; font-family:calibri; font-size:13px;\">
	  <tr>
	    <td style=\"width:120px;border-bottom: 1px solid #999;border-left: 1px solid #999;padding:5px;\"><img src='".JURI::base().'images/vergola-email-logo.png'."'></td>
	    <td style=\"border-bottom: 1px solid #999;border-right: 1px solid #999;border-left: 1px solid #999;padding:5px;\">Enquiry Date: " .$_POST['idate']. "</td>
	  </tr>
	  <tr>
	    <td style=\"border-bottom: 1px solid #999;border-left: 1px solid #999;padding:5px;\">From</td>
	    <td style=\"border-bottom: 1px solid #999;border-right: 1px solid #999;border-left: 1px solid #999;padding:5px;\">" . $_POST['username'] . "</td>
	  </tr>
	  <tr>
	    <td style=\"border-bottom: 1px solid #999;border-left: 1px solid #999;padding:5px;\">Sales Rep</td>
	    <td style=\"border-bottom: 1px solid #999;border-right: 1px solid #999;border-left: 1px solid #999;padding:5px;\">" . $_POST['repname'] . "</td>
	  </tr>
	  <tr>
	    <td style=\"border-bottom: 1px solid #999;border-left: 1px solid #999;padding:5px;\">Builder</td>
	    <td style=\"border-bottom: 1px solid #999;border-right: 1px solid #999;border-left: 1px solid #999;padding:5px;\">" . $_POST['builder_name'] . "</td>
	  </tr>
	  <tr>
	    <td style=\"border-bottom: 1px solid #999;border-left: 1px solid #999;padding:5px;\">Contact Name</td>
	    <td style=\"border-bottom: 1px solid #999;border-right: 1px solid #999;border-left: 1px solid #999;padding:5px;\">" . $_POST['builder_contact'] . "</td>
	  </tr>
	  <tr>
	    <td style=\"border-bottom: 1px solid #999;border-left: 1px solid #999;padding:5px;\">Project Name</td>
	    <td style=\"border-bottom: 1px solid #999;border-right: 1px solid #999;border-left: 1px solid #999;padding:5px;\">" . $_POST['sprojectname'] . "</td>
	  </tr>
	  <tr>
	    <td style=\"border-bottom: 1px solid #999;border-left: 1px solid #999;padding:5px;\">Address</td>
	    <td style=\"border-bottom: 1px solid #999;border-right: 1px solid #999;border-left: 1px solid #999;padding:5px;\">" . $_POST['saddress1'] . " " . $_POST['saddress2'] . ", " . $_POST['site_suburb'] . " " . $_POST['site_state'] . " " . $_POST['site_postcode'] . "</td>
	  </tr>
	  <tr>
	    <td style=\"border-bottom: 1px solid #999;border-left: 1px solid #999;padding:5px;\">Phone</td>
	    <td style=\"border-bottom: 1px solid #999;border-right: 1px solid #999;border-left: 1px solid #999;padding:5px;\">" . $_POST['bwphone'] ."</td>
	  </tr>


	  <tr>
	    <td style=\"border-bottom: 1px solid #999;border-left: 1px solid #999;padding:5px;\">Mobile</td>
	    <td style=\"border-bottom: 1px solid #999;border-right: 1px solid #999;border-left: 1px solid #999;padding:5px;\">" . $_POST['bmobile'] . "</td>
	  </tr>
	  <tr>
	    <td style=\"border-bottom: 1px solid #999;border-left: 1px solid #999;padding:5px;\">Email</td>
	    <td style=\"border-bottom: 1px solid #999;border-right: 1px solid #999;border-left: 1px solid #999;padding:5px;\">" . $_POST['bemail'] . "</td>
	  </tr>
	  <tr>
	    <td style=\"border-bottom: 1px solid #999;border-left: 1px solid #999;padding:5px;\">Drawing</td>
	    <td style=\"border-bottom: 1px solid #999;border-right: 1px solid #999;border-left: 1px solid #999;padding:5px;\">" . $_POST['checkfile'] . "</td>
	  </tr>
	  <tr>
	    <td style=\"border-bottom: 1px solid #999;border-left: 1px solid #999;padding:5px;\">Note</td>
	    <td style=\"border-bottom: 1px solid #999;border-right: 1px solid #999;border-left: 1px solid #999;padding:5px;\">" . $_POST['notestxt'] . "</td>
	  </tr>
	</table>";

	    $headers = "From:" . $from. "\r\n";
		$headers .= "MIME-Version: 1.0\r\n";
		$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
	   // $headers2 = "From:" . $to. "\r\n";
		//$headers2 .= "MIME-Version: 1.0\r\n";
		//$headers2 .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
	    mail($to,$subject,$message,$headers);
	   // mail($from,$subject2,$message2,$headers2); // sends a copy of the message to the sender

	    //echo "Mail Sent. To " . $_POST['repname'];
	    // You can also use header('Location: thank_you.php'); to redirect to another page. 
		
		//header('Location:'.JURI::base().'tender-listing-vic/tender-folder-vic?tenderid='.$TenderID);
	}

}
   

//error_log(" #0: ".print_r($_POST,true), 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_sa\\my-error.log');

$gettenderid = $TenderID;	
$ref = "tender-listing-vic/tender-folder-vic?tenderid=".$TenderID;
$checknotes = implode(", ", $_POST['notestxt']);
$cnt = count($_POST['date_notes']);
$cnt2 = count($_POST['username_notes']);
$cnt3 = count($_POST['notestxt']);


if ($cnt > 0 && $cnt == $cnt2 && $cnt2 == $cnt3 && $checknotes != '') {
    $insertArr = array();
    
	for ($i=0; $i<$cnt; $i++) {
        $insertArr[] = "('$gettenderid', '" . mysql_real_escape_string($_POST['date_notes'][$i]) . "', '" . mysql_real_escape_string($_POST['username_notes'][$i]) . "', '" . mysql_real_escape_string($_POST['notestxt'][$i]) . "')";
	}


 	$queryn = "INSERT INTO ver_chronoforms_data_notes_vic (clientid, datenotes, username, content) VALUES " . implode(", ", $insertArr);
 
 	mysql_query($queryn) or trigger_error("Insert failed: " . mysql_error());

}
                 
//This is the Time Save 
$now = time();  

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
  // echo($queryn);
  } 
// end Special Condition
  
//-----------------------  SAVING FILES -------------------------


if(isset($_FILES['pic'])){  // upload pic from Pics tab

      foreach ($_FILES['pic']['tmp_name'] as $key => $tmp_name){
      //This is the directory where images will be saved 
         
          $path = "images/pic/{$ClientID}";
          if (!file_exists($path)) {
            mkdir($path, 0777, true);
          }

          $file_name = $_FILES['pic']['name'][0];
          $file_name = pathinfo($_FILES['pic']['name'][$key], PATHINFO_FILENAME); 
          $target=$path."/{$file_name}_{$now}";  
          $target=$target.'.'.pathinfo($_FILES['pic']['name'][$key], PATHINFO_EXTENSION);  
          
          //error_log(print_r($file_name,true), 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_sa\\my-error.log'); 

      if (move_uploaded_file($tmp_name, $target)) {

  $query = "INSERT INTO ver_chronoforms_data_pics_vic (clientid, datestamp, photo, file_name, upload_type) VALUES  ('$ClientID', '$datestamp', '$target', '{$file_name}', 'pic')";
   mysql_query($query) or trigger_error("Insert failed: " . mysql_error());  
              }
      }
}
  


 
  if(isset($_FILES['photo'])){ // upload drawing photo from Drawing tab

      foreach ($_FILES['photo']['tmp_name'] as $key => $tmp_name){
  //This is the directory where images will be saved 
        $path = "images/drawings/{$ClientID}";
          if (!file_exists($path)) {
            mkdir($path, 0777, true);
          }

          $file_name = $_FILES['photo']['name'][0];
          $file_name = pathinfo($_FILES['photo']['name'][$key], PATHINFO_FILENAME); 
          $target=$path."/{$file_name}_{$now}";  
          $target=$target.'.'.pathinfo($_FILES['photo']['name'][$key], PATHINFO_EXTENSION);  
           

      if (move_uploaded_file($tmp_name, $target)) {

  $query = "INSERT INTO ver_chronoforms_data_drawings_vic (clientid, photo, file_name) VALUES  ('$ClientID', '$target','{$file_name}')";
  mysql_query($query) or trigger_error("Insert failed: " . mysql_error());
            
            }
      }
  }


 
  //error_log("HERE a1", 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_sa\\my-error.log'); 
  //error_log(" #1: ".print_r($_FILES,true), 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_sa\\my-error.log');
if(isset($_FILES['doc'])){  //Upload file from Files tab
      //error_log("RepIdent:".$RepIdent, 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_sa\\my-error.log');
	 //error_log(" #2: ".print_r($_FILES['doc'],true), 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_sa\\my-error.log');
      foreach ($_FILES['doc']['tmp_name'] as $key => $tmp_name){
        $path = "images/file_upload/{$ClientID}";
        if (!file_exists($path)) {
          mkdir($path, 0777, true);
        }

  //This is the directory where images will be saved 
          
          $file_name = $_FILES['doc']['name'][0];
          $file_name = pathinfo($_FILES['doc']['name'][$key], PATHINFO_FILENAME); 
          $target=$path."/{$file_name}_{$now}";  
          $target=$target.'.'.pathinfo($_FILES['doc']['name'][$key], PATHINFO_EXTENSION);    
          
          //error_log($ext, 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_sa\\my-error.log'); 

      if (move_uploaded_file($tmp_name, $target)) {

  $query = "INSERT INTO ver_chronoforms_data_pics_vic (clientid, datestamp, photo, upload_type, file_name) VALUES  ('$ClientID', '$datestamp', '$target','file','{$file_name}')";
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
          
          $file_name = $_FILES['signed_doc']['name'][0];
          $file_name = pathinfo($_FILES['signed_doc']['name'][$key], PATHINFO_FILENAME); 
          $target=$path."/{$file_name}_{$now}";  
          $target=$target.'.'.pathinfo($_FILES['signed_doc']['name'][$key], PATHINFO_EXTENSION);    
          
          //error_log($ext, 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_sa\\my-error.log'); 

      if (move_uploaded_file($tmp_name, $target)) {

        //$query = "UPDATE  ver_chronoforms_data_letters_vic SET uploaded_filename='{$file_name}' WHERE cf_id={$doc_id} ";
         $query = "INSERT INTO ver_chronoforms_data_pics_vic (clientid, datestamp, photo, upload_type, file_name, ref_id) VALUES  ('$ClientID', '$datestamp', '$target','signed_doc','{$file_name}', {$doc_id})";
          //error_log($query, 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_sa\\my-error.log'); 
         mysql_query($query) or trigger_error("Insert failed: " . mysql_error());
      
              
              }
      }

      $query = "UPDATE  ver_chronoforms_data_letters_vic SET has_upload_file=1 WHERE cf_id={$doc_id} ";
      mysql_query($query) or trigger_error("Insert failed: " . mysql_error());

 }  

   
 

//error_log(print_r($_POST,true), 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_sa\\my-error.log');
if(isset($_POST['delete_pdf']))
{ 
  $cf_id = $_POST['pdf_cf_id'];
  //error_log('cf_id: '.$cf_id, 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_sa\\my-error.log');
  mysql_query("DELETE from ver_chronoforms_data_letters_vic WHERE cf_id = '$cf_id'")
        or die(mysql_error()); 
  
  $result = array('success' => true, 'note' => '');

  echo json_encode($result);
  exit();
  
  //header('Location:'.JURI::base().'client-listing-vic');  
}


if(isset($_POST['delete']))
{	

	mysql_query("UPDATE ver_chronoforms_data_clientpersonal_vic SET deleted_at=NOW() WHERE pid = '$id'")
				or die(mysql_error()); 
	echo "Deleted";
	
  if($is_builder){ 
    header('Location:'.JURI::base().'builder-listing-vic');  
  }else{
     header('Location:'.JURI::base().'client-listing-vic');  
  } 

	//header('Location:'.JURI::base().'client-listing-vic');	
}

if(isset($_POST['delete-drawing'])) {
	  
	  $DrawInfo = mysql_query("SELECT * FROM ver_chronoforms_data_drawings_vic WHERE cf_id  = '$drawid'");
$RetDrawInfo = mysql_fetch_array($DrawInfo); if (!$DrawInfo) {die("Error: Data not found..");}
$RetPhoto=$RetDrawInfo['photo'];
	   
	       $file = $RetPhoto;
           if (!unlink($file))
           {
           echo ("Error deleting $file");
           }
           else
           {
               mysql_query("DELETE from ver_chronoforms_data_drawings_vic WHERE cf_id = '$drawid'") or die(mysql_error()); echo "Deleted";
           }
	
	//header('Location:'.JURI::base().'client-listing-vic/client-folder-vic?pid='.$id);
	  
	}
	
if(isset($_POST['delete-pic'])) {
	  
$DrawInfo = mysql_query("SELECT * FROM ver_chronoforms_data_pics_vic WHERE cf_id  = '$picid'");
$RetDrawInfo = mysql_fetch_array($DrawInfo); if (!$DrawInfo) {die("Error: Data not found..");}
$RetPhoto=$RetDrawInfo['photo'];
	  
	  //error_log(" picid: ".$picid, 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_sa\\my-error.log');
	  
	       $file = $RetPhoto;
           if (!unlink($file))
           {
           echo ("Error deleting $file");
           }
           else
           {
              mysql_query("DELETE from ver_chronoforms_data_pics_vic WHERE cf_id = '$picid'") or die(mysql_error()); echo "Deleted";
           }
	
	//header('Location:'.JURI::base().'client-listing-vic/client-folder-vic?pid='.$id);
	  
	}

  if(isset($_POST['delete-file'])) {
    
$DrawInfo = mysql_query("SELECT * FROM ver_chronoforms_data_pics_vic WHERE cf_id  = '$fileid'");
$RetDrawInfo = mysql_fetch_array($DrawInfo); if (!$DrawInfo) {die("Error: Data not found..");}
$RetPhoto=$RetDrawInfo['photo'];
    
    
    
         $file = $RetPhoto;
           if (!unlink($file))
           {
           		echo ("Error deleting $file");
           }
           else
           {
               mysql_query("DELETE from ver_chronoforms_data_pics_vic WHERE cf_id = '$fileid'") or die(mysql_error()); echo "Deleted";
           }
  
  //header('Location:'.JURI::base().'client-listing-vic/client-folder-vic?pid='.$id);
    
  }



//----------------------- END OF SAVING FILES -------------------------


?>
<?php
	$form->data['date_entered'] = date('d-M-Y');
	$form->data['date_time'] = date('d-M-Y g:i A');
?>

<script src="<?php echo JURI::base().'jscript/jsapi.js'; ?>"></script>
<script src="<?php echo JURI::base().'jscript/jquery.min.js'; ?>"></script>
<script src="<?php echo JURI::base().'jscript/labels.js'; ?>"></script>
<script type="text/javascript" src="<?php echo JURI::base().'jscript/tabcontent.js'; ?>"></script>

<script charset="UTF-8" type="text/javascript" src="<?php echo JURI::base().'jscript/datetime/js/jquery-1.8.3.min.js'; ?>"></script>
<script type="text/javascript" src="<?php echo JURI::base().'jscript/datetime/js/bootstrap.min.js'; ?>"></script>
<script charset="UTF-8" type="text/javascript" src="<?php echo JURI::base().'jscript/datetime/js/bootstrap-datetimepicker.js'; ?>"></script>
<script charset="UTF-8" type="text/javascript" src='<?php echo JURI::base();?>jscript/client-folder.js'></script>
<script src="<?php echo JURI::base().'jscript/jquery-ui.min.js'; ?>" type="text/javascript"></script>

<link rel="stylesheet" type="text/css" media="screen,projection" href="<?php echo JURI::base().'jscript/jquery-ui-1.11.4/jquery-ui.min.css'; ?>" /> 
<link rel="stylesheet" type="text/css" media="screen,projection" href="<?php echo JURI::base().'jscript/custom.css'; ?>" />
<link rel="stylesheet" type="text/css" media="screen,projection" href="<?php echo JURI::base().'jscript/new-enquiry.css'; ?>" /> 
<link rel="stylesheet" type="text/css" media="screen,projection" href="<?php echo JURI::base().'jscript/datetime/css/bootstrap.min.css'; ?>" />
<link rel="stylesheet" type="text/css" media="screen,projection" href="<?php echo JURI::base().'jscript/datetime/css/bootstrap-datetimepicker.min.css'; ?>" /> 
<link rel="stylesheet" type="text/css" media="screen,projection" href="<?php echo JURI::base().'jscript/client-folder.css'; ?>" />


<style>
#tbl-letters tr:nth-child(1), #tbl-letters2 tr:nth-child(1), #tbl-letters3 tr:nth-child(1) {
	display: none;
}
#tbl-pdf td:nth-child(1), #tbl-letters td:nth-child(1), #tbl-letters2 td:nth-child(1), #tbl-letters3 td:nth-child(1) {
	width: 180px;
}
#tbl-pdf td:nth-child(2), #tbl-letters td:nth-child(2), #tbl-letters2 td:nth-child(2), #tbl-letters3 td:nth-child(2) {
	width: 90px;
}
#tbl-pdf td:nth-child(3), #tbl-letters td:nth-child(3), #tbl-letters2 td:nth-child(3), #tbl-letters3 td:nth-child(3) {
	width: 140px;
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
</style>

 
<form method="post" enctype="multipart/form-data" class="Chronoform hasValidation" id="chronoform_Client_Folder_Vic">
<input type="hidden" value="" id="blank" name="blank" />
<input type='hidden' name='doc_id' id='doc_id' / >
<input type='hidden' name='user_group' id='user_group' value="<?php echo $user_group; ?>" / >

  <div class="column-left"></div>
  <div class="column-right"></div>
  <!----------------------------------------------------- Site Address Tab ---------------------------------------------------->
  <div id="tabs_wrapper" class="siteadd-tab">
    <div id="tabs_container">
      <ul id="tabs_default">
        <li class="active"><span>Site Address</span></li>
      </ul>
    </div>
    <div id="tabs_content_container">
      <div id="site-address" class="tab_content_default" style="display: block;">
          <label class="input"><span id="sprojectnamespan">Project Name</span>
          <input type="text" value="<?php echo $SiteProject; ?>" id="sprojectname" name="sprojectname">
        </label>
        <label class="input"><span id="saddress1span">Address 1</span>
          <input type="text" value="<?php echo $SiteAddress1; ?>" id="saddress1" name="saddress1">
        </label>
        <label class="input"><span id="saddress2span">Address 2</span>
          <input type="text" value="<?php echo $SiteAddress2; ?>" id="saddress2" name="saddress2">
        </label>
        
        <!--- Site Suburb -->
        <label class="input"><span id="ssuburblistspan">Suburb</span>
          <input type="text" id="ssuburb" name="site_suburb" value="<?php echo $SiteSuburb; ?>"  onkeypress="ssuburbchange();" />
        </label>
        <input type="hidden" id="ssuburb_id" name="ssuburbid" value="<?php echo $SiteSuburbID; ?>" readonly />
        <label class="input"><span id="sstatespan">State</span>
          <input type="text" id="ssuburbstate" name="site_state" value="<?php echo $SiteState; ?>" readonly />
        </label>
        <label class="input"><span id="spostspan">Postcode</span>
          <input type="text" id="ssuburbpostcode" name="site_postcode" value="<?php echo $SitePostcode; ?>" readonly />
        </label>
       <!-- End of Site Suburb -->
       
        <label class="input"><span id="shmphonespan">Home Phone</span>
          <input type="text" value="<?php echo $SiteHPhone; ?>" id="shmphone" name="shmphone">

        </label>
         <label class="input"><span id="swkphonespan">Work Phone</span>
          <input type="text" value="<?php echo $SiteWPhone; ?>" id="swkphone" name="swkphone">
        </label>
        <label class="input"><span id="smobilespan">Mobile</span>
          <input type="text" value="<?php echo $SiteMobile; ?>" id="smobile" name="smobile">
        </label>
        <label class="input"><span id="sotherspan">Other</span>
          <input type="text" value="<?php echo $SiteOther; ?>" id="sother" name="sother">
        </label>
        <label class="input"><span id="semailspan">Email</span>
          <input type="text" value="<?php echo $SiteEmail; ?>" id="semail" name="semail">
        </label>
        
      </div>
    </div>
  </div>
  
  <!-------------------------------------------------------- Tender Builder Enquiry ---------------------------------------------------> 
  
   <!------------------------------------------------- Builder Content Tab ---------------------------------------------------------->
   <div id="tabs_wrapper" class="builder-tab" style="width:28%; margin-left:10px; margin-right:10px;" >
     <div id="tabs_container">
       <ul id="builder-tabs" class="shadetabs">
         <li><a href="#" rel="builder1" class="selected">Builder 1</a></li>
         <li><a href="#" rel="builder2">Builder 2</a></li>
         <li><a href="#" rel="builder3">Builder 3</a></li>
         <li><a href="#" rel="builder4">Builder 4</a></li>
         <li><a href="#" rel="builder5">Builder 5</a></li>
         <li><a href="#" rel="builder6">Builder 6</a></li>
       </ul>
     </div>
     <div id="tabs_content_container"> 
       
       <!---------------------------------------------------------------- Builder 1 Tab ------------------------------------------------------->
       
       <div id="builder1" class="tab_content" style="display: block;"> 
       
       <!------------------------------------------------------- Builder 1 Details ------------------------------------------------------------>
       <label class="input" style="width:95%"><span id="bnameid1">Company Name</span>
           <input type="text" value="<?php echo isset($_POST['builder_name1']) ? $_POST['builder_name1'] : $BuildName1 ?>" id="build_name1" name="builder_name1" onkeypress="bcompanychange1();" style="width:75%;">
           <input type="button" value="New" name="save_new_builder" class="btn" style="width:75px;" onclick="open_create_builder_dialog('builder_dialog1')">
       </label>
       <label class="input"><span id="bcontactid1">Contact</span>
           <input type="text" value="<?php echo isset($_POST['builder_contact1']) ? $_POST['builder_contact1'] : $BuildContact1; ?>" id="build_contact1" name="builder_contact1">
       </label>
       <label class="input"><span id="baddress1id1">Address 1</span>
           <input type="text" value="<?php echo isset($_POST['baddress11']) ? $_POST['baddress11'] : $BuildAddress11; ?>" id="baddress_11" name="baddress11">
       </label>
       <label class="input"><span id="baddress1id1">Address 1</span>
           <input type="text" value="<?php echo isset($_POST['baddress21']) ? $_POST['baddress21'] : $BuildAddress21; ?>" id="baddress_21" name="baddress21">
       </label>
       <!--- Builder Suburb -->
       <label class="input"><span id="bsuburbspan1">Suburb</span>
           <input type="text" id="bsuburb1" name="builder_suburb1" class="bsub-class" value="<?php echo isset($_POST['builder_suburb1']) ? $_POST['builder_suburb1'] : $BuildSuburb1; ?>" onkeypress="bsuburbchange1();" />
       </label>
       <input type="hidden" id="bsuburb_id1" name="bsuburbid1" value="<?php echo isset($_POST['bsuburbid1']) ? $_POST['bsuburbid1'] : $BuildSuburbID1; ?>" readonly />
       <label class="input"><span id="bstateid1">State</span>
           <input type="text" id="bsuburbstate1" name="builder_state1" class="bstate-class" value="<?php echo isset($_POST['builder_state1']) ? $_POST['builder_state1'] : $BuildState1; ?>" readonly />
       </label>
       <label class="input"><span id="bpostid1">Postcode</span>
           <input type="text" id="bsuburbpostcode1" name="builder_postcode1" class="bpost-class" value="<?php echo isset($_POST['builder_postcode1']) ? $_POST['builder_postcode1'] : $BuildPostcode1; ?>" readonly />
       </label>
       <!-- End of Builder Suburb -->
       <label class="input"><span id="bwphoneid1">Work Phone</span>
           <input type="text" class="bphone-class" value="<?php echo isset($_POST['bwphone1']) ? $_POST['bwphone1'] : $BuildWPhone1; ?>" id="b_wphone1" name="bwphone1">
       </label>
       <label class="input"><span id="bmobileid1">Mobile</span>
           <input type="text" class="bmobile-class" value="<?php echo isset($_POST['bmobile1']) ? $_POST['bmobile1'] : $BuildMobile1; ?>" id="b_mobile1" name="bmobile1">
       </label>
       <label class="input"><span id="bfaxid1">Fax</span>
           <input type="text" class="bfax-class" value="<?php echo isset($_POST['bfax1']) ? $_POST['bfax1'] : $BuildFax1; ?>" id="b_fax1" name="bfax1">
       </label>
       <label class="input"><span id="bemailid1">Email</span>
           <input type="text" class="bemail-class" value="<?php echo isset($_POST['bemail1']) ? $_POST['bemail1'] : $BuildEmail1; ?>" id="b_email1" name="bemail1">
       </label>

       <input type="submit" value="Save Builder" id="" name="save_choosen_builder" class="btn" style="display:none; width: 195px; margin:1px 0px 5px 1px; padding: 4px;">    
       
       </div>
       
       <!---------------------------------------------------- Builder 2 Tab ------------------------------------------------->
       
       <div id="builder2" class="tab_content"> 
       
       <!------------------------------------------------------- Builder 2 Details ------------------------------------------------------------>
           
       <label class="input" style="width:95%"><span id="bnameid2">Company Name</span>
           <input type="text" value="<?php echo isset($_POST['builder_name2']) ? $_POST['builder_name2'] : $BuildName2 ?>" id="build_name2" name="builder_name2" onkeypress="bcompanychange1();" style="width:75%;">
           <input type="button" value="New" name="save_new_builder" class="btn" style="width:75px;" onclick="open_create_builder_dialog('builder_dialog2')">
       </label>
       <label class="input"><span id="bcontactid2">Contact</span>
           <input type="text" value="<?php echo isset($_POST['builder_contact2']) ? $_POST['builder_contact2'] : $BuildContact2; ?>" id="build_contact2" name="builder_contact2">
       </label>
       <label class="input"><span id="baddress1id2">Address 1</span>
           <input type="text" value="<?php echo isset($_POST['baddress12']) ? $_POST['baddress12'] : $BuildAddress12; ?>" id="baddress_12" name="baddress12">
       </label>
       <label class="input"><span id="baddress2id2">Address 2</span>
           <input type="text" value="<?php echo isset($_POST['baddress22']) ? $_POST['baddress22'] : $BuildAddress22; ?>" id="baddress_22" name="baddress22">
       </label>
       <!--- Builder Suburb -->
       <label class="input"><span id="bsuburbspan2">Suburb</span>
           <input type="text" id="bsuburb2" name="builder_suburb2" class="bsub-class" value="<?php echo isset($_POST['builder_suburb2']) ? $_POST['builder_suburb2'] : $BuildSuburb2; ?>" onkeypress="bsuburbchange2();" />
       </label>
       <input type="hidden" id="bsuburb_id2" name="bsuburbid2" value="<?php echo isset($_POST['bsuburbid2']) ? $_POST['bsuburbid2'] : $BuildSuburbID2; ?>" readonly />
       <label class="input"><span id="bstateid2">State</span>
           <input type="text" id="bsuburbstate2" name="builder_state2" class="bstate-class" value="<?php echo isset($_POST['builder_state2']) ? $_POST['builder_state2'] : $BuildState2; ?>" readonly />
       </label>
       <label class="input"><span id="bpostid2">Postcode</span>
           <input type="text" id="bsuburbpostcode2" name="builder_postcode2" class="bpost-class" value="<?php echo isset($_POST['builder_postcode2']) ? $_POST['builder_postcode2'] : $BuildPostcode2; ?>" readonly />
       </label>
       <!-- End of Builder Suburb -->
       <label class="input"><span id="bwphoneid2">Work Phone</span>
           <input type="text" class="bphone-class" value="<?php echo isset($_POST['bwphone2']) ? $_POST['bwphone2'] : $BuildWPhone2; ?>" id="b_wphone2" name="bwphone2">
       </label>
       <label class="input"><span id="bmobileid2">Mobile</span>
           <input type="text" class="bmobile-class" value="<?php echo isset($_POST['bmobile2']) ? $_POST['bmobile2'] : $BuildMobile2; ?>" id="b_mobile2" name="bmobile2">
       </label>
       <label class="input"><span id="bfaxid2">Fax</span>
           <input type="text" class="bfax-class" value="<?php echo isset($_POST['bfax2']) ? $_POST['bfax2'] : $BuildFax2; ?>" id="b_fax2" name="bfax2">
       </label>
       <label class="input"><span id="bemailid2">Email</span>
           <input type="text" class="bemail-class" value="<?php echo isset($_POST['bemail2']) ? $_POST['bemail2'] : $BuildEmail2; ?>" id="b_email2" name="bemail2">
       </label>

       <input type="submit" value="Save Builder" id="" name="save_choosen_builder" class="btn" style="display:none; width: 295px; margin:2px 0px 5px 2px; padding: 4px;">    
           
       </div>
       
       <!---------------------------------------------------- Builder 3 Tab ------------------------------------------------->
       
       <div id="builder3" class="tab_content"> 
       
       <!------------------------------------------------------- Builder 3 Details ------------------------------------------------------------>
       <label class="input" style="width:95%"><span id="bnameid3">Company Name</span>
           <input type="text" value="<?php echo isset($_POST['builder_name3']) ? $_POST['builder_name3'] : $BuildName3 ?>" id="build_name3" name="builder_name3" onkeypress="bcompanychange1();" style="width:75%;">
           <input type="button" value="New" name="save_new_builder" class="btn" style="width:75px;" onclick="open_create_builder_dialog('builder_dialog3')">
       </label>
       <label class="input"><span id="bcontactid3">Contact</span>
           <input type="text" value="<?php echo isset($_POST['builder_contact3']) ? $_POST['builder_contact3'] : $BuildContact3; ?>" id="build_contact3" name="builder_contact3">
       </label>
       <label class="input"><span id="baddress1id3">Address 1</span>
           <input type="text" value="<?php echo isset($_POST['baddress13']) ? $_POST['baddress13'] : $BuildAddress13; ?>" id="baddress_13" name="baddress13">
       </label>
       <label class="input"><span id="baddress3id3">Address 3</span>
           <input type="text" value="<?php echo isset($_POST['baddress23']) ? $_POST['baddress23'] : $BuildAddress23; ?>" id="baddress_23" name="baddress23">
       </label>
       <!--- Builder Suburb -->
       <label class="input"><span id="bsuburbspan3">Suburb</span>
           <input type="text" id="bsuburb3" name="builder_suburb3" class="bsub-class" value="<?php echo isset($_POST['builder_suburb3']) ? $_POST['builder_suburb3'] : $BuildSuburb3; ?>" onkeypress="bsuburbchange3();" />
       </label>
       <input type="hidden" id="bsuburb_id3" name="bsuburbid3" value="<?php echo isset($_POST['bsuburbid3']) ? $_POST['bsuburbid3'] : $BuildSuburbID3; ?>" readonly />
       <label class="input"><span id="bstateid3">State</span>
           <input type="text" id="bsuburbstate3" name="builder_state3" class="bstate-class" value="<?php echo isset($_POST['builder_state3']) ? $_POST['builder_state3'] : $BuildState3; ?>" readonly />
       </label>
       <label class="input"><span id="bpostid3">Postcode</span>
           <input type="text" id="bsuburbpostcode3" name="builder_postcode3" class="bpost-class" value="<?php echo isset($_POST['builder_postcode3']) ? $_POST['builder_postcode3'] : $BuildPostcode3; ?>" readonly />
       </label>
       <!-- End of Builder Suburb -->
       <label class="input"><span id="bwphoneid3">Work Phone</span>
           <input type="text" class="bphone-class" value="<?php echo isset($_POST['bwphone3']) ? $_POST['bwphone3'] : $BuildWPhone3; ?>" id="b_wphone3" name="bwphone3">
       </label>
       <label class="input"><span id="bmobileid3">Mobile</span>
           <input type="text" class="bmobile-class" value="<?php echo isset($_POST['bmobile3']) ? $_POST['bmobile3'] : $BuildMobile3; ?>" id="b_mobile3" name="bmobile3">
       </label>
       <label class="input"><span id="bfaxid3">Fax</span>
           <input type="text" class="bfax-class" value="<?php echo isset($_POST['bfax3']) ? $_POST['bfax3'] : $BuildFax3; ?>" id="b_fax3" name="bfax3">
       </label>
       <label class="input"><span id="bemailid3">Email</span>
           <input type="text" class="bemail-class" value="<?php echo isset($_POST['bemail3']) ? $_POST['bemail3'] : $BuildEmail3; ?>" id="b_email3" name="bemail3">
       </label>

       <input type="submit" value="Save Builder" id="" name="save_choosen_builder" class="btn" style="display:none; width: 395px; margin:3px 0px 5px 3px; padding: 4px;">    
       
       </div>
       
       <!---------------------------------------------------- Builder 4 Tab ------------------------------------------------>
       
       <div id="builder4" class="tab_content"> 
       
       	<label class="input" style="width:95%"><span id="bnameid4">Company Name</span>
       	    <input type="text" value="<?php echo isset($_POST['builder_name4']) ? $_POST['builder_name4'] : $BuildName4 ?>" id="build_name4" name="builder_name4" onkeypress="bcompanychange1();" style="width:75%;">
       	    <input type="button" value="New" name="save_new_builder" class="btn" style="width:75px;" onclick="open_create_builder_dialog('builder_dialog4')">
       	</label>
       	<label class="input"><span id="bcontactid4">Contact</span>
       	    <input type="text" value="<?php echo isset($_POST['builder_contact4']) ? $_POST['builder_contact4'] : $BuildContact4; ?>" id="build_contact4" name="builder_contact4">
       	</label>
       	<label class="input"><span id="baddress1id4">Address 1</span>
       	    <input type="text" value="<?php echo isset($_POST['baddress14']) ? $_POST['baddress14'] : $BuildAddress14; ?>" id="baddress_14" name="baddress14">
       	</label>
       	<label class="input"><span id="baddress4id4">Address 4</span>
       	    <input type="text" value="<?php echo isset($_POST['baddress24']) ? $_POST['baddress24'] : $BuildAddress24; ?>" id="baddress_24" name="baddress24">
       	</label>
       	<!--- Builder Suburb -->
       	<label class="input"><span id="bsuburbspan4">Suburb</span>
       	    <input type="text" id="bsuburb4" name="builder_suburb4" class="bsub-class" value="<?php echo isset($_POST['builder_suburb4']) ? $_POST['builder_suburb4'] : $BuildSuburb4; ?>" onkeypress="bsuburbchange4();" />
       	</label>
       	<input type="hidden" id="bsuburb_id4" name="bsuburbid4" value="<?php echo isset($_POST['bsuburbid4']) ? $_POST['bsuburbid4'] : $BuildSuburbID4; ?>" readonly />
       	<label class="input"><span id="bstateid4">State</span>
       	    <input type="text" id="bsuburbstate4" name="builder_state4" class="bstate-class" value="<?php echo isset($_POST['builder_state4']) ? $_POST['builder_state4'] : $BuildState4; ?>" readonly />
       	</label>
       	<label class="input"><span id="bpostid4">Postcode</span>
       	    <input type="text" id="bsuburbpostcode4" name="builder_postcode4" class="bpost-class" value="<?php echo isset($_POST['builder_postcode4']) ? $_POST['builder_postcode4'] : $BuildPostcode4; ?>" readonly />
       	</label>
       	<!-- End of Builder Suburb -->
       	<label class="input"><span id="bwphoneid4">Work Phone</span>
       	    <input type="text" class="bphone-class" value="<?php echo isset($_POST['bwphone4']) ? $_POST['bwphone4'] : $BuildWPhone4; ?>" id="b_wphone4" name="bwphone4">
       	</label>
       	<label class="input"><span id="bmobileid4">Mobile</span>
       	    <input type="text" class="bmobile-class" value="<?php echo isset($_POST['bmobile4']) ? $_POST['bmobile4'] : $BuildMobile4; ?>" id="b_mobile4" name="bmobile4">
       	</label>
       	<label class="input"><span id="bfaxid4">Fax</span>
       	    <input type="text" class="bfax-class" value="<?php echo isset($_POST['bfax4']) ? $_POST['bfax4'] : $BuildFax4; ?>" id="b_fax4" name="bfax4">
       	</label>
       	<label class="input"><span id="bemailid4">Email</span>
       	    <input type="text" class="bemail-class" value="<?php echo isset($_POST['bemail4']) ? $_POST['bemail4'] : $BuildEmail4; ?>" id="b_email4" name="bemail4">
       	</label>

       	<input type="submit" value="Save Builder" id="" name="save_choosen_builder" class="btn" style="display:none; width: 495px; margin:4px 0px 5px 4px; padding: 4px;">    
       </div>
       
       <!---------------------------------------------------- Builder 5 Tab ------------------------------------------------>
       
       <div id="builder5" class="tab_content"> 
       
       	<label class="input" style="width:95%"><span id="bnameid5">Company Name</span>
       	    <input type="text" value="<?php echo isset($_POST['builder_name5']) ? $_POST['builder_name5'] : $BuildName5 ?>" id="build_name5" name="builder_name5" onkeypress="bcompanychange1();" style="width:75%;">
       	    <input type="button" value="New" name="save_new_builder" class="btn" style="width:75px;" onclick="open_create_builder_dialog('builder_dialog5')">
       	</label>
       	<label class="input"><span id="bcontactid5">Contact</span>
       	    <input type="text" value="<?php echo isset($_POST['builder_contact5']) ? $_POST['builder_contact5'] : $BuildContact5; ?>" id="build_contact5" name="builder_contact5">
       	</label>
       	<label class="input"><span id="baddress1id5">Address 1</span>
       	    <input type="text" value="<?php echo isset($_POST['baddress15']) ? $_POST['baddress15'] : $BuildAddress15; ?>" id="baddress_15" name="baddress15">
       	</label>
       	<label class="input"><span id="baddress5id5">Address 5</span>
       	    <input type="text" value="<?php echo isset($_POST['baddress25']) ? $_POST['baddress25'] : $BuildAddress25; ?>" id="baddress_25" name="baddress25">
       	</label>
       	<!--- Builder Suburb -->
       	<label class="input"><span id="bsuburbspan5">Suburb</span>
       	    <input type="text" id="bsuburb5" name="builder_suburb5" class="bsub-class" value="<?php echo isset($_POST['builder_suburb5']) ? $_POST['builder_suburb5'] : $BuildSuburb5; ?>" onkeypress="bsuburbchange5();" />
       	</label>
       	<input type="hidden" id="bsuburb_id5" name="bsuburbid5" value="<?php echo isset($_POST['bsuburbid5']) ? $_POST['bsuburbid5'] : $BuildSuburbID5; ?>" readonly />
       	<label class="input"><span id="bstateid5">State</span>
       	    <input type="text" id="bsuburbstate5" name="builder_state5" class="bstate-class" value="<?php echo isset($_POST['builder_state5']) ? $_POST['builder_state5'] : $BuildState5; ?>" readonly />
       	</label>
       	<label class="input"><span id="bpostid5">Postcode</span>
       	    <input type="text" id="bsuburbpostcode5" name="builder_postcode5" class="bpost-class" value="<?php echo isset($_POST['builder_postcode5']) ? $_POST['builder_postcode5'] : $BuildPostcode5; ?>" readonly />
       	</label>
       	<!-- End of Builder Suburb -->
       	<label class="input"><span id="bwphoneid5">Work Phone</span>
       	    <input type="text" class="bphone-class" value="<?php echo isset($_POST['bwphone5']) ? $_POST['bwphone5'] : $BuildWPhone5; ?>" id="b_wphone5" name="bwphone5">
       	</label>
       	<label class="input"><span id="bmobileid5">Mobile</span>
       	    <input type="text" class="bmobile-class" value="<?php echo isset($_POST['bmobile5']) ? $_POST['bmobile5'] : $BuildMobile5; ?>" id="b_mobile5" name="bmobile5">
       	</label>
       	<label class="input"><span id="bfaxid5">Fax</span>
       	    <input type="text" class="bfax-class" value="<?php echo isset($_POST['bfax5']) ? $_POST['bfax5'] : $BuildFax5; ?>" id="b_fax5" name="bfax5">
       	</label>
       	<label class="input"><span id="bemailid5">Email</span>
       	    <input type="text" class="bemail-class" value="<?php echo isset($_POST['bemail5']) ? $_POST['bemail5'] : $BuildEmail5; ?>" id="b_email5" name="bemail5">
       	</label>

       	<input type="submit" value="Save Builder" id="" name="save_choosen_builder" class="btn" style="display:none; width: 595px; margin:5px 0px 5px 5px; padding: 4px;">    
       
       </div>
       
        <!---------------------------------------------------- Builder 6 Tab ------------------------------------------------>
       
       <div id="builder6" class="tab_content"> 
       	<label class="input" style="width:95%"><span id="bnameid6">Company Name</span>
       	    <input type="text" value="<?php echo isset($_POST['builder_name6']) ? $_POST['builder_name6'] : $BuildName6 ?>" id="build_name6" name="builder_name6" onkeypress="bcompanychange1();" style="width:75%;">
       	    <input type="button" value="New" name="save_new_builder" class="btn" style="width:75px;" onclick="open_create_builder_dialog('builder_dialog6')">
       	</label>
       	<label class="input"><span id="bcontactid6">Contact</span>
       	    <input type="text" value="<?php echo isset($_POST['builder_contact6']) ? $_POST['builder_contact6'] : $BuildContact6; ?>" id="build_contact6" name="builder_contact6">
       	</label>
       	<label class="input"><span id="baddress1id6">Address 1</span>
       	    <input type="text" value="<?php echo isset($_POST['baddress16']) ? $_POST['baddress16'] : $BuildAddress16; ?>" id="baddress_16" name="baddress16">
       	</label>
       	<label class="input"><span id="baddress6id6">Address 6</span>
       	    <input type="text" value="<?php echo isset($_POST['baddress26']) ? $_POST['baddress26'] : $BuildAddress26; ?>" id="baddress_26" name="baddress26">
       	</label>
       	<!--- Builder Suburb -->
       	<label class="input"><span id="bsuburbspan6">Suburb</span>
       	    <input type="text" id="bsuburb6" name="builder_suburb6" class="bsub-class" value="<?php echo isset($_POST['builder_suburb6']) ? $_POST['builder_suburb6'] : $BuildSuburb6; ?>" onkeypress="bsuburbchange6();" />
       	</label>
       	<input type="hidden" id="bsuburb_id6" name="bsuburbid6" value="<?php echo isset($_POST['bsuburbid6']) ? $_POST['bsuburbid6'] : $BuildSuburbID6; ?>" readonly />
       	<label class="input"><span id="bstateid6">State</span>
       	    <input type="text" id="bsuburbstate6" name="builder_state6" class="bstate-class" value="<?php echo isset($_POST['builder_state6']) ? $_POST['builder_state6'] : $BuildState6; ?>" readonly />
       	</label>
       	<label class="input"><span id="bpostid6">Postcode</span>
       	    <input type="text" id="bsuburbpostcode6" name="builder_postcode6" class="bpost-class" value="<?php echo isset($_POST['builder_postcode6']) ? $_POST['builder_postcode6'] : $BuildPostcode6; ?>" readonly />
       	</label>
       	<!-- End of Builder Suburb -->
       	<label class="input"><span id="bwphoneid6">Work Phone</span>
       	    <input type="text" class="bphone-class" value="<?php echo isset($_POST['bwphone6']) ? $_POST['bwphone6'] : $BuildWPhone6; ?>" id="b_wphone6" name="bwphone6">
       	</label>
       	<label class="input"><span id="bmobileid6">Mobile</span>
       	    <input type="text" class="bmobile-class" value="<?php echo isset($_POST['bmobile6']) ? $_POST['bmobile6'] : $BuildMobile6; ?>" id="b_mobile6" name="bmobile6">
       	</label>
       	<label class="input"><span id="bfaxid6">Fax</span>
       	    <input type="text" class="bfax-class" value="<?php echo isset($_POST['bfax6']) ? $_POST['bfax6'] : $BuildFax6; ?>" id="b_fax6" name="bfax6">
       	</label>
       	<label class="input"><span id="bemailid6">Email</span>
       	    <input type="text" class="bemail-class" value="<?php echo isset($_POST['bemail6']) ? $_POST['bemail6'] : $BuildEmail6; ?>" id="b_email6" name="bemail6">
       	</label>

       	<input type="submit" value="Save Builder" id="" name="save_choosen_builder" class="btn" style="display:none; width: 695px; margin:6px 0px 5px 6px; padding: 4px;">    
       
       </div>
       
       <!----------------------------------------- End of Builder Tab Content -------------------------------------------------->
       

     </div>
   </div>


 


<!----------------------------------------------------------- End of Builder Tabs ------------------------------------------------->
  
  <!------------------------------------------------------------- Enquiry Tracker Tab ------------------------------------------------>

  <!-- Enquiry Tracker Tab -->
<div id="tabs_wrapper" class="drawing-tab" style="width:40%;">
    <div id="tabs_container">
        <ul id="tracker-tabs" class="shadetabs"> 
        	<li class="active"><a href='#' rel='tracker'  >Enquiry Tracker</a></li>
	        <li ><a href='#' rel='followup' >Follow Up</a></li> <?php //if($cf_id<1){echo "style='pointer-events: none;'";} ?> 
	    </ul>
    </div>
    <!-- <div id="tabs_content_container">
	    <div id="draw" class="tab_content_default" style="display: block;"> 
	    <INPUT type="button" value="Delete Drawing" onclick="deleteRow('tbl-draw')" /> 
	        <table id="tbl-draw">
	        <tr>
	            <td class="tbl-chk"><input type="checkbox" name="chk"/></td>
	             <td class="tbl-upload"><input type="file" name="photo[]" id="uploadme" multiple="multiple">
	            <input type="hidden" id="checkfile" value="No" name="checkfile"></td>
	        </tr>
	    </table> 
        </div>
    </div> --> 

    <div id="tabs_content_container">
      <div id="tracker" class="tab_content_default" style="display: block;">
	        <label class="input" style="width: 90%;"><span id="date-entered">Date Entered:</span>
	          <input type="text" id="idate" name="idate" class="date_entered" value="<?php echo $DateLodged; ?>">

                <?php //process user_access_profiles
                if ($current_signed_in_user_access_profiles['tab enquiry tracker']['send mail'] == true) {
                ?>
                    <input type="submit" value="Send Mail" id="ibtn" name="sendmail" class="btn">
                <?php } //end if?>

	        </label>         
	        
	        <!-- Sales Rep -->
	        <?php
		  $queryrep="SELECT id, name, RepID, email FROM ver_users ORDER BY name ASC";
	      $resultrep = mysql_query($queryrep);
	      if(!$resultrep){die ("Could not query the database: <br />" . mysql_error());}
	      //create selection list				
		   while($row = mysql_fetch_row($resultrep))
			{
				$heading = $row[0];	
				$RepIDArrayPhp .= 'RepIDArray["'.$heading.'"]="'.$row[0].'";';
				$RepNameArrayPhp .= 'RepNameArray["'.$heading.'"]="'.$row[1].'";';
				$RepIdentArrayPhp .= 'RepIdentArray["'.$heading.'"]="'.$row[2].'";';
				$RepEmailArrayPhp .= 'RepEmailArray["'.$heading.'"]="'.$row[3].'";';
			}
		  	    echo " <label class='input'><select class='rep-list' id='replist' name='replist' onchange='javascript:SelectChangedRep();'><option></option>";
	            $usergroup = 'Victoria Users';
	            $querysub2="SELECT id, name FROM ver_users WHERE usertype LIKE ('$usergroup') ORDER BY name ASC";
	            $resultsub2 = mysql_query($querysub2);
	            if(!$resultsub2){die ("Could not query the database: <br />" . mysql_error());
				}
				
				  while ($data=mysql_fetch_assoc($resultsub2)){
	                  echo "<option value = '{$data[id]}'";
	                       if ($RepID == $data[id]) {
	                            echo "selected = 'selected'";

						    }
	                        echo ">{$data[name]}</option>";
			        }
	 
	echo "</select></label>";


	?>
	       
	        <input type="hidden" id="repname" name='repname' value="<?php echo $RepName; ?>" readonly />
	        <input type="hidden" id="repident" name='repident' value="<?php echo $RepIdent; ?>" readonly />
	        <input type="hidden" id="repid" name='repid' value="<?php echo $RepID; ?>" readonly />
	        <input type="hidden" id="repemail" name='repemail' value="<?php echo $RepEmail; ?>" readonly />
	        <!-- End of Sales Rep ---> 
	        
	        <!--- Lead Type -->
	        <?php
	      $querylead="SELECT cf_id, lead FROM ver_chronoforms_data_lead_vic ORDER BY lead ASC";
	      $resultlead = mysql_query($querylead);
	      if(!$resultlead){die ("Could not query the database: <br />" . mysql_error());}
	      //create selection list				
		   while($row = mysql_fetch_row($resultlead))
		{
			$heading = $row[0];	
			$LeadIDArrayPhp .= 'LeadIDArray["'.$heading.'"]="'.$row[0].'";';
			$LeadNameArrayPhp .= 'LeadNameArray["'.$heading.'"]="'.$row[1].'";';

		} 

		echo "<label class='input'><select class='lead-list' id='leadlist' name='leadlist' onchange='javascript:SelectChangedLead();'><option></option>";
	    $querysub2="SELECT cf_id, lead FROM ver_chronoforms_data_lead_vic ORDER BY lead ASC";
	    $resultsub2 = mysql_query($querysub2);
	    if(!$resultsub2){die ("Could not query the database: <br />" . mysql_error());
		}
				
		while ($data=mysql_fetch_assoc($resultsub2)){
	      echo "<option value = '{$data[cf_id]}'";
	           if ($LeadID == $data[cf_id]) {
	                echo "selected = 'selected'";
			    }
	            echo ">{$data[lead]}</option>";
	    }
	 
	echo "</select></label>";
	?>
	    


	        <input type="hidden" id="leadname" name='leadname' value="<?php echo $LeadName; ?>" readonly />
	        <input type="hidden" id="leadid" name='leadid' value="<?php echo $LeadID; ?>" readonly />
	        
	        <!-- End of Lead Type -->
	        
	        <label class='input' style="display:none;"><span>Last Rep Allocated</span>
	          <select class="last-rep">
	            <option value=""></option>
	          </select>
	        </label>
	        

	        
	        <div class="input-group date form_datetime col-md-5" data-date-format="dd-M-yyyy @ HH:ii P" data-link-field="dtp_appointment" >
	            <label class='input'>
	            	<span id='date-entered'>Appointment: </span>
					<input type="text" id="iappointment" name="iappointment" class="form-control" value="<?php echo $retrieve['fappointmentdate'] ?>" readonly>
				</label>    
				<span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span> 
				<span class="input-group-addon"><span class="glyphicon glyphicon-th"></span></span>
	        </div>
	       <br/>
	       <?php 
	        $user =& JFactory::getUser(); $userName = $user->get( 'name' );
	        echo '<label class=\'input\' style=\'display:block;\'><span id=\'takenid\'>Taken by:</span><input type=\'text\' id=\'username\' name=\'username\' class=\'username\' value=\''.$userName.'\' readonly></label>';
	        ?>
	        <?php $usermail =& JFactory::getUser(); $userEmail = $usermail->get( 'email' );
	        echo '<input type=\'hidden\' id=\'usermail\' name=\'usermail\' value=\''.$userEmail.'\' readonly>';?>

			 <br/>
			<input type="hidden" id="dtp_appointment" name="dtp_appointment" value="<?php echo $retrieve['appointmentdate'] ?>" />
        
        </div>
   
  

	  	<div id='followup' class='tab_content' style='display: none;'> 
	    	<?php    
	    	// include 'includes/vic/quote/followup_vic.php'; ?>
	    </div> 

    </div>
</div>
  
  <!-- Notes Tab -->
  
<div id="tabs_wrapper" class="notes-tab" style="width: 58%;">
    <div id="tabs_container">
	    <ul id="notes-tabs" class="shadetabs">
	      <li><a href="#" rel="notes" >Notes</a></li>
	      <li><a href="#" rel="letter">Sales</a></li>
	      <li><a href="#" rel="documents">Correspondence</a></li>
	      <li><a href="#" rel="statdocs">Statutory</a></li>
	      <li><a href="#" rel="pics">Photos</a></li>  
	      <li><a href="#" rel="drawing">Drawings</a></li> 
	      <li><a href="#" rel="files">General</a></li>
	      <li><a href="#" rel="special">Special Conditions</a></li>
	    </ul>
	</div>
    <div id="tabs_content_container">

      <div id="notes" class="tab_content" style="display: block; width: 100%;">
        <table id="tbl-notes">
        <?php $user =& JFactory::getUser(); $userName = $user->get( 'name' ); ?>
        <tr>
		  <td class="tbl-content">		  
          <div class="layer-date">Date: <input type="text" id="date_display" name="date_display" class="datetime_display" value="<?php print(Date("d-M-Y")); ?>" readonly>
          <input type="hidden" id="date_notes" name="date_notes[]" class="date_time" value="<?php print(Date("Y-m-d H:i:s")); ?>" readonly> 
          </div>
          <div class="layer-whom">By Whom: <input type="text" id="username_notes" name="username_notes[]" class="username" value="<?php echo $userName; ?>" readonly></div>  
		  <textarea name="notestxt[]" id="notestxt"><?php echo $NotesTxt; ?></textarea>
          </td>

		  </tr>
      </table>
      <table id="tbl-content">
        <?php
$resultnotes = mysql_query("SELECT cf_id, datenotes, username, content FROM ver_chronoforms_data_notes_vic WHERE clientid = '$TenderID' ORDER by datenotes DESC");
$i=1;
if (!$resultnotes) {
    echo 'Could not run query: ' . mysql_error();
    exit;
}

while($row = mysql_fetch_row($resultnotes))
	{

echo "
<tr><td class=\"tbl-content\"><h1>Notes ". $i++ ."</h1><p>$row[3]</p>
<div class=\"layer-date\">Date: " .date('d-M-Y', strtotime ($row[1])) . "</div>
<div class=\"layer-whom\">By Whom: $row[2]</div>
</td>
</tr>";
	}
?>
      </table> 
      </div> 
     

<!---------------------------------------------- Pics Tab -->
    <div id="pics" class="tab_content" style="display: block;">
      <!-- <INPUT type="button" value="Add Row" onclick="addRow('tbl-pic')" /> <input type="submit" name="delete-pic" value="Delete Picture" onclick="deleteRow('tbl-pic');deleteRow2('tbl-imgpic')" />   -->

        <?php //process user_access_profiles
        if ($current_signed_in_user_access_profiles['tab photos']['delete'] == true) {
        ?>
            <input type="submit" name="delete-pic" id="btn_picid" class="bbtn btn-delete" value="Delete Picture"   />
        <?php } //end if?>

      <input type="hidden" value="" id="picid" name="picid" />
      <div id="drawing-tbl">
        <br/>
        <ul id="tbl-imgpic" class="picture-block">
          <?php
$resultimg = mysql_query("SELECT cf_id, clientid, photo, file_name FROM ver_chronoforms_data_pics_vic WHERE clientid = '$ClientID' AND upload_type ='pic' ");
if (!$resultimg) {
    echo 'Could not run query: ' . mysql_error();
    exit;
}
  $thumbnail = "";
  while($row = mysql_fetch_array($resultimg))
	{
      if(strtolower(substr($row[2],-3))=="pdf"){
          $thumbnail = JURI::base()."images/pdf_logo.jpg";
      }else if(strtolower(substr($row[2],-3))=="doc" || substr($row[2],-4)=="docx"){
          $thumbnail = JURI::base()."images/doc_logo.png";
      }else if(strtolower(substr($row[2],-3))=="xls" || substr($row[2],-4)=="xlsx"){
          $thumbnail = JURI::base()."images/excel-logo.jpg";
      }else{
          $thumbnail = JURI::base().$row[2];
      }

      //$a_file_name = explode("/", $row[2]);
     //error_log(print_r($row,true), 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_sa\\my-error.log');
      //$file_name = $a_file_name[3];
      //error_log(substr($file_name, 0,-4), 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_sa\\my-error.log');

echo "<li>  <a href=\"$row[2]\" download><img src=\"{$thumbnail}\" height=\"75px\" ></a><br/> <input type=\"checkbox\" class=\"chkpic\" name=\"chk\" value=\"$row[0]\"/> {$row['file_name']} </li>";
	}
?>
        </ul>
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
      <!---------------------------------------------- END Pics Tab -->


    <!---------------------------------------------------- Sales Tab    Quote Letter  -->
    
    <div id="letter" class="tab_content"> 
           
      <div class="modification-button-holder"> 
          <a id="template_link" rel="nofollow" title="PDF" onclick="window.open(this.href,'win2','status=no,toolbar=no,scrollbars=yes,titlebar=no,menubar=no,resizable=yes,width=auto,height=auto,directories=no,location=no'); return false;" href="index.php?cf_id=<?php echo $cf_id; ?>&pid=<?php echo $ClientID; ?>&option=com_chronoforms&tmpl=component&chronoform=TemplateResidential_With_Frame" style="margin-right:5px;">Residential – Frame</a>
          <a id="template_link" rel="nofollow" title="PDF" onclick="window.open(this.href,'win2','status=no,toolbar=no,scrollbars=yes,titlebar=no,menubar=no,resizable=yes,width=auto,height=auto,directories=no,location=no'); return false;" href="index.php?cf_id=<?php echo $cf_id; ?>&pid=<?php echo $ClientID; ?>&option=com_chronoforms&tmpl=component&chronoform=TemplateResidential_With_No_Frame" style="margin-right:5px;">Residential – No Frame</a> 
          <a id="template_link" href="<?php echo JURI::base().'images/template/welcome_book.pdf'; ?> " download  style="margin-right:5px;">Welcome Book</a>

          <a id="template_link" rel="nofollow" title="PDF" onclick="window.open(this.href,'win2','status=no,toolbar=no,scrollbars=yes,titlebar=no,menubar=no,resizable=yes,width=auto,height=auto,directories=no,location=no'); return false;" href="index.php?cf_id=<?php echo $cf_id; ?>&pid=<?php echo $ClientID; ?>&option=com_chronoforms&tmpl=component&chronoform=Sales_Contract" style="margin-right:5px;">Sales Contract - Residential</a>
          <a id="template_link" rel="nofollow" title="PDF" onclick="window.open(this.href,'win2','status=no,toolbar=no,scrollbars=yes,titlebar=no,menubar=no,resizable=yes,width=auto,height=auto,directories=no,location=no'); return false;" href="index.php?cf_id=<?php echo $cf_id; ?>&pid=<?php echo $ClientID; ?>&option=com_chronoforms&tmpl=component&chronoform=Clients_Authority" style="margin-right:5px;">Clients Authority</a>
          <a id="template_link" rel="nofollow" title="PDF" onclick="window.open(this.href,'win2','status=no,toolbar=no,scrollbars=yes,titlebar=no,menubar=no,resizable=yes,width=auto,height=auto,directories=no,location=no'); return false;" href="index.php?cf_id=<?php echo $cf_id; ?>&pid=<?php echo $ClientID; ?>&option=com_chronoforms&tmpl=component&chronoform=Colour_Chart" style="margin-right:5px;">Colour Chart</a>
          
          <a id="template_link" rel="nofollow" title="PDF" onclick="window.open(this.href,'win2','status=no,toolbar=no,scrollbars=yes,titlebar=no,menubar=no,resizable=yes,width=auto,height=auto,directories=no,location=no'); return false;" href="index.php?cf_id=<?php echo $cf_id; ?>&pid=<?php echo $ClientID; ?>&option=com_chronoforms&tmpl=component&chronoform=Contract_Variation_Letter" style="margin-right:5px;">Contract Variation Letter</a>
      </div> 
 
          
      <div id="drawing-tbl">
        <table id="tbl-pdf">
          <tr>
            <td>Filename</td>
            <td>Date Created</td>
            <td>Download PDF</td>
            <td>Signed Doc</td> 
            <td> </td> 
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
      Print "<td style='border:none;'><a rel=\"nofollow\" onclick=\"window.open(this.href,'win2','status=no,toolbar=no,scrollbars=yes,titlebar=no,menubar=no,resizable=yes,width=auto,height=auto,directories=no,location=no'); return false;\" href=\"index.php?pid=".$info['cf_id']."&option=com_chronoforms&tmpl=component&chronoform=Download-PDF\">Click Here <img src='".JURI::base()."templates/".$mainframe->getTemplate()."/images/file_pdf.png' /></a></td>";
      echo "<td>";
      if($info['has_upload_file']==1){
          echo '<div> 
                <ul style="list-style-type: none; margin: 5px 0 5px 10px;padding: 0;"  >';
         
            $resultimg = mysql_query("SELECT cf_id, clientid, photo, file_name FROM ver_chronoforms_data_pics_vic WHERE clientid = '$ClientID'  AND upload_type ='signed_doc' AND ref_id={$info['cf_id']} ");
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
             echo "<li><a href=\"".$row['photo']."\" download class='remove-link'>  <img src=\"{$thumbnail}\" height=\"20px\" style='display:inline'> ".$row['file_name']."</a>    <span class=\"ui-icon ui-icon-closethick\" style='display:inline-block; cursor: pointer;' onclick=\"if(confirm('Are you sure you want to delete document?')){"."$('#picid').val('".$row["cf_id"]."'); $('#btn_picid').click();}\"   > </span></li>";
            }
          echo "</ul>
          </div>";
       
      } 

    //process user_access_profiles
    if ($current_signed_in_user_access_profiles['tab sales']['save'] == true) {
        echo "<input type='file' name='signed_doc[]' multiple='multiple' accept='.jpg,.png,.bmp,.gif,.pdf, .doc, .docx, .xls, .xlsx, .odt'> 
              <input type='button' value='Save' id='' name='' class='bbtn btn-delete' onclick='$(\"#doc_id\").val(\"{$info['cf_id']}\"); $(\"#chronoform_Client_Folder_Vic\").submit();'>  ";
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

 ?>
        </table>
        
      </div>
 
    </div>
    
    <!-- Contract Doc Tab -->
    <div id="contracts" class="tab_content" style="display: block;"> 
    </div>
    
    <!---------------------------------------------- Drawing Tab -->
    
    <div id="drawing" class="tab_content">
      <!--<INPUT type="button" value="Add Row" onclick="addRow('tbl-draw')" /> onclick="deleteRow('tbl-draw');deleteRow2('tbl-img')" -->

        <?php //process user_access_profiles
        if ($current_signed_in_user_access_profiles['tab drawings']['delete'] == true) {
        ?>
            <input type="submit" name="delete-drawing" class="bbtn btn-delete" value="Delete Drawing"  />
        <?php } //end if?>

      <input type="hidden" value="" id="drawingid" name="drawingid" />
      <div id="drawing-tbl">
        <br/>
        <ul id="tbl-img" class="picture-block">
          <?php
$resultimg = mysql_query("SELECT cf_id, clientid, photo, file_name FROM ver_chronoforms_data_drawings_vic WHERE clientid = '$ClientID'");
if (!$resultimg) {
    echo 'Could not run query: ' . mysql_error();
    exit;
}

  while($row = mysql_fetch_array($resultimg))
	{
    if(strtolower(substr($row[2],-3))=="pdf"){
        $thumbnail = JURI::base()."images/file_pdf.png";
    }else if(strtolower(substr($row[2],-3))=="doc" || substr($row[2],-4)=="docx"){
        $thumbnail = JURI::base()."images/doc_logo.png";
    }else if(strtolower(substr($row[2],-3))=="xls" || substr($row[2],-4)=="xlsx"){
        $thumbnail = JURI::base()."images/excel-logo.jpg";
    }else{
        $thumbnail = JURI::base().$row[2];
    }

	echo "   <li><a href=\"$row[2]\" download><img src=\"{$thumbnail}\" height=\"75px\" ></a><br/><input type=\"checkbox\" class=\"chkdraw\" name=\"chk\" value=\"$row[0]\"/> {$row[3]}</li>";
	}
?>
        </ul>
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
    
    <!-------------------------------------------- Stat Docs -->
    <div id="statdocs" class="tab_content" style="display: block;">
      <div class="modification-button-holder">
        <a id="template_link" rel="nofollow" title="PDF" onclick="window.open(this.href,'win2','status=no,toolbar=no,scrollbars=yes,titlebar=no,menubar=no,resizable=yes,width=auto,height=auto,directories=no,location=no'); return false;" href="index.php?cf_id=<?php echo $cf_id; ?>&pid=<?php echo $ClientID; ?>&option=com_chronoforms&tmpl=component&chronoform=Planning_Application_Letter" style="margin-right:5px;">Planning Application Letter</a>
        <a id="template_link" rel="nofollow" title="PDF" onclick="window.open(this.href,'win2','status=no,toolbar=no,scrollbars=yes,titlebar=no,menubar=no,resizable=yes,width=auto,height=auto,directories=no,location=no'); return false;" href="index.php?cf_id=<?php echo $cf_id; ?>&pid=<?php echo $ClientID; ?>&option=com_chronoforms&tmpl=component&chronoform=Amendment_Planning_Permit" style="margin-right:5px;">Amendment Planning Permit</a>
        <a id="template_link" rel="nofollow" title="PDF" onclick="window.open(this.href,'win2','status=no,toolbar=no,scrollbars=yes,titlebar=no,menubar=no,resizable=yes,width=auto,height=auto,directories=no,location=no'); return false;" href="index.php?cf_id=<?php echo $cf_id; ?>&pid=<?php echo $ClientID; ?>&option=com_chronoforms&tmpl=component&chronoform=Replacement_Drawing_Letter" style="margin-right:5px;">Replacement Drawing Letter</a>
        <a id="template_link" rel="nofollow" title="PDF" onclick="window.open(this.href,'win2','status=no,toolbar=no,scrollbars=yes,titlebar=no,menubar=no,resizable=yes,width=auto,height=auto,directories=no,location=no'); return false;" href="index.php?cf_id=<?php echo $cf_id; ?>&pid=<?php echo $ClientID; ?>&option=com_chronoforms&tmpl=component&chronoform=Building_Appeals_Board" style="margin-right:5px;">Building Appeals Board</a> <br/>
        <a id="template_link" rel="nofollow" title="PDF" onclick="window.open(this.href,'win2','status=no,toolbar=no,scrollbars=yes,titlebar=no,menubar=no,resizable=yes,width=auto,height=auto,directories=no,location=no'); return false;" href="index.php?cf_id=<?php echo $cf_id; ?>&pid=<?php echo $ClientID; ?>&option=com_chronoforms&tmpl=component&chronoform=Build_Over_Easement" style="margin-right:5px;">Build Over Easement</a>
        <a id="template_link" rel="nofollow" title="PDF" onclick="window.open(this.href,'win2','status=no,toolbar=no,scrollbars=yes,titlebar=no,menubar=no,resizable=yes,width=auto,height=auto,directories=no,location=no'); return false;" href="index.php?cf_id=<?php echo $cf_id; ?>&pid=<?php echo $ClientID; ?>&option=com_chronoforms&tmpl=component&chronoform=Report_And_Consent" style="margin-right:5px;">Report and Consent</a>
      </div>

        <div id="drawing-tbl">
          <table id="tbl-pdf">
            <tr>
              <td>Filename</td>
              <td>Date Created</td>
              <td>Download PDF</td>
            </tr>
            <?php 

           $data = mysql_query("SELECT * FROM ver_chronoforms_data_letters_vic  WHERE   template_name LIKE 'Replacement Drawing Letter%' OR   template_name LIKE 'Planning Application Letter%' OR template_name LIKE 'Amendment Planning Permit%' OR template_name LIKE 'Building Appeals Board%' OR template_name  LIKE 'Build Over Easement%' OR template_name LIKE 'Report And Consent%' ORDER BY datecreated DESC") 
           or die(mysql_error()); 

           while($info = mysql_fetch_array( $data )) 
           { 

             if ($info['clientid'] == $ClientID) {                
                Print "<tr>"; 
                Print "<td>". $info['template_name'] . "</td> "; 
                Print "<td>" . date(PHP_DFORMAT,strtotime($info['datecreated'])) . " </td>";
                Print "<td style='border:none;'><a rel=\"nofollow\" onclick=\"window.open(this.href,'win2','status=no,toolbar=no,scrollbars=yes,titlebar=no,menubar=no,resizable=yes,width=auto,height=auto,directories=no,location=no'); return false;\" href=\"index.php?pid=".$info['cf_id']."&option=com_chronoforms&tmpl=component&chronoform=Download-PDF\">Click Here <img src='".JURI::base()."templates/".$mainframe->getTemplate()."/images/file_pdf.png'  /></a></td> ";

                echo "<td>";
                //process user_access_profiles
                if ($current_signed_in_user_access_profiles['tab statutory']['delete'] == true) {
                    echo "<a rel=\"nofollow\" onclick=\"delete_pdf_letter(event,this)\" cf_id=\"{$info['cf_id']}\" class='remove-link'  >Delete</a>";
                } //end if
                echo "</td>";
                echo "</tr>";
              } 
           } 

           ?>
          </table>
        </div>

    </div>
    
    <!-------------------------------------------- Correspndence Doc  Tab -->
    <div id="documents" class="tab_content" style="display: block;"> 
       
        <!-- <a id="template_link" href="<?php echo JURI::base().'images/template/time_frame_letter.docx'; ?> " download  style="margin-right:5px;">Time frame Letter</a> 
                -->
      <div class="modification-button-holder">          
        <a id="template_link" rel="nofollow" title="PDF" onclick="window.open(this.href,'win2','status=no,toolbar=no,scrollbars=yes,titlebar=no,menubar=no,resizable=yes,width=auto,height=auto,directories=no,location=no'); return false;" href="index.php?cf_id=<?php echo $cf_id; ?>&pid=<?php echo $ClientID; ?>&option=com_chronoforms&tmpl=component&chronoform=Time_Frame_Letter" style="margin-right:5px;">Time Frame Letter</a>
        <!-- <a id="template_link" href="<?php echo JURI::base().'images/template/proposed_drawings_letter.docx'; ?> " download  style="margin-right:5px;">Proposed Drawings</a> -->
        <a id="template_link" rel="nofollow" title="PDF" onclick="window.open(this.href,'win2','status=no,toolbar=no,scrollbars=yes,titlebar=no,menubar=no,resizable=yes,width=auto,height=auto,directories=no,location=no'); return false;" href="index.php?cf_id=<?php echo $cf_id; ?>&pid=<?php echo $ClientID; ?>&option=com_chronoforms&tmpl=component&chronoform=Proposed_Drawings" style="margin-right:5px;">Proposed Drawings</a>
        <!-- <a id="template_link" href="<?php echo JURI::base().'images/template/amended_proposed_drawings.docx'; ?> " download  style="margin-right:5px;">Amended Proposed Drawings</a>  -->
        <a id="template_link" rel="nofollow" title="PDF" onclick="window.open(this.href,'win2','status=no,toolbar=no,scrollbars=yes,titlebar=no,menubar=no,resizable=yes,width=auto,height=auto,directories=no,location=no'); return false;" href="index.php?cf_id=<?php echo $cf_id; ?>&pid=<?php echo $ClientID; ?>&option=com_chronoforms&tmpl=component&chronoform=Amended_Proposed_Drawings" style="margin-right:5px;">Amended Proposed Drawings</a>
        <a id="template_link" rel="nofollow" title="PDF" onclick="window.open(this.href,'win2','status=no,toolbar=no,scrollbars=yes,titlebar=no,menubar=no,resizable=yes,width=auto,height=auto,directories=no,location=no'); return false;" href="index.php?cf_id=<?php echo $cf_id; ?>&pid=<?php echo $ClientID; ?>&option=com_chronoforms&tmpl=component&chronoform=Proposed_Drawing_Rescode" style="margin-right:5px;">Proposed Drawing Rescode</a><br/>
        <a id="template_link" rel="nofollow" title="PDF" onclick="window.open(this.href,'win2','status=no,toolbar=no,scrollbars=yes,titlebar=no,menubar=no,resizable=yes,width=auto,height=auto,directories=no,location=no'); return false;" href="index.php?cf_id=<?php echo $cf_id; ?>&pid=<?php echo $ClientID; ?>&option=com_chronoforms&tmpl=component&chronoform=Res_Code_Letter" style="margin-right:5px;">Res Code Letter</a>
        <a id="template_link" rel="nofollow" title="PDF" onclick="window.open(this.href,'win2','status=no,toolbar=no,scrollbars=yes,titlebar=no,menubar=no,resizable=yes,width=auto,height=auto,directories=no,location=no'); return false;" href="index.php?cf_id=<?php echo $cf_id; ?>&pid=<?php echo $ClientID; ?>&option=com_chronoforms&tmpl=component&chronoform=Protection_Work_Notice_Client" style="margin-right:5px;">Protection Work Notice Client</a>
        <a id="template_link" rel="nofollow" title="PDF" onclick="window.open(this.href,'win2','status=no,toolbar=no,scrollbars=yes,titlebar=no,menubar=no,resizable=yes,width=auto,height=auto,directories=no,location=no'); return false;" href="index.php?cf_id=<?php echo $cf_id; ?>&pid=<?php echo $ClientID; ?>&option=com_chronoforms&tmpl=component&chronoform=Protection_Work_Notice_Neighbour" style="margin-right:5px;">Protection Work Notice Neighbour</a>
        <a id="template_link" href="<?php echo JURI::base().'images/template/protection_work_notice_forms.pdf'; ?> " download  style="margin-right:5px;">Protection Work Notice forms</a>
      </div>

        <div id="drawing-tbl">
          <table id="tbl-pdf">
            <tr>
              <td>Filename</td>
              <td>Date Created</td>
              <td>Download PDF</td>
            </tr>
            <?php 

           $data = mysql_query("SELECT * FROM ver_chronoforms_data_letters_vic  WHERE template_name LIKE 'Time Frame Letter%' OR template_name LIKE 'Proposed Drawing%' OR template_name LIKE 'Amended Proposed Drawing%' OR template_name LIKE 'Proposed Drawing Rescode%' OR template_name LIKE 'Res Code Letter%'  OR template_name LIKE 'Protection Work Notice Client%' OR template_name  LIKE 'Protection Work Notice Neighbour%'  ORDER BY datecreated DESC") 
           or die(mysql_error()); 

           while($info = mysql_fetch_array( $data )) 
           { 

             if ($info['clientid'] == $ClientID) {                
                Print "<tr>"; 
                Print "<td>". $info['template_name'] . "</td> "; 
                Print "<td>" . date(PHP_DFORMAT,strtotime($info['datecreated'])) . " </td>";
                Print "<td style='border:none;'><a rel=\"nofollow\" href=\"index.php?pid=".$info['cf_id']."&option=com_chronoforms&tmpl=component&chronoform=Download-PDF\">Click Here <img src='".JURI::base()."templates/".$mainframe->getTemplate()."/images/file_pdf.png'  /></a></td>  ";

                echo "<td>";
                //process user_access_profiles
                if ($current_signed_in_user_access_profiles['tab correspondence']['delete'] == true) {
                    echo "<a rel=\"nofollow\" onclick=\"delete_pdf_letter(event,this)\" cf_id=\"{$info['cf_id']}\" class='remove-link'  >Delete</a>";
                } //end if
                echo "</td>";
                echo "</tr>";
              } 
           } 

           ?>
          </table>
        </div>

    </div>  

      <!-- ----- General Tab (previously Files) ----- -->
    <div id="files" class="tab_content" style="display: block;"> 
        
            <?php //process user_access_profiles
            if ($current_signed_in_user_access_profiles['tab general']['delete'] == true) {
            ?>
                <input type="submit" name="delete-file" class="bbtn btn-delete" value="Delete File"  />
            <?php } //end if?>

          <input type="hidden" value="" id="fileid" name="fileid" />
          <br/><br/>
          <ul id="tbl-imgpic" class="picture-block" >
            <?php
              $resultimg = mysql_query("SELECT cf_id, clientid, photo, file_name FROM ver_chronoforms_data_pics_vic WHERE clientid = '$ClientID'  AND upload_type ='file' ");
              if (!$resultimg) {
                  echo 'Could not run query: ' . mysql_error();
                  exit;
              }
              $thumbnail = "";
              while($row = mysql_fetch_row($resultimg))
              {
                  if(strtolower(substr($row[2],-3))=="pdf"){
                      $thumbnail = JURI::base()."images/file_pdf.png";
                  }else if(strtolower(substr($row[2],-3))=="doc" || substr($row[2],-4)=="docx"){
                      $thumbnail = JURI::base()."images/doc_logo.png";
                  }else if(strtolower(substr($row[2],-3))=="xls" || substr($row[2],-4)=="xlsx"){
                      $thumbnail = JURI::base()."images/excel-logo.jpg";
                  }else{
                      $thumbnail = JURI::base().$row[2];
                  }

            echo "<li><a href=\"$row[2]\" download><img src=\"{$thumbnail}\" height=\"75px\" ></a><br/><input type=\"checkbox\" class=\"chkfile\" name=\"chk\" value=\"$row[0]\"/> {$row[3]}</li>";
              }
            ?>
          </ul>
          <br/>
          <table id="tbl-pic">
            <tr>
              
              <td class="tbl-upload">

                <?php //process user_access_profiles
                if ($current_signed_in_user_access_profiles['tab general']['save'] == true) {
                ?>
                    <input type="file" name="doc[]" multiple="multiple" accept=".jpg,.png,.bmp,.gif,.pdf, .doc, .docx, .xls, .xlsx, .odt"> 
                    <input type="submit" value="Save" id="btn_save_file" name="save_file" class="bbtn btn-save">  
                <?php } //end if?>

              </td>
            </tr>
          </table>
        
    </div>

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
    <!----------------------------------------- End of Tab Content -->  
 
  </div>
</div>

 
  <div id="tabs_wrapper" class="button-tab">
    <a href="<?php echo JURI::base().'tender-listing-vic'; ?>" class="bbtn" style="padding: 5px 60px !important; margin:0 8px 0 0;" />Cancel</a>

    <?php //process user_access_profiles
    if ($current_signed_in_user_access_profiles['record action']['save'] == true) {
    ?>
        <input type="submit" value="Save" id="btn_save_tender_folder_form" name="save" class="bbtn" style="padding: 5px 60px !important; margin:0 8px 0 0;">
    <?php } //end if?>

  </div>
</form>

<form method="post" class="" id="form_pdf">  
    <input type="hidden" name="delete_pdf"  />
    <input type="hidden" name="pdf_cf_id" id="pdf_cf_id"  />
</form>


<div id="chooseBuilderDialog" title="Choose Builder" style="padding: 7% 7% 7% 10%; text-align: left;" >
	 
  	<?php

  		$sql = "SELECT * FROM ver_chronoforms_data_clientpersonal_vic where tenderid='{$TenderID}' ";
  		$result = mysql_query($sql);
  		while($c = mysql_fetch_array( $result )) 
        { 
        	
        	echo "  <input type='checkbox' class='chkBuilder' id='' value='".$c['builderid']."' style=\"\" /> <span style='font-size:25px;'>".$c['builder_name']."</span> <br/> ";

        }   	

  	?>
  	<br/>
  	<input type="button" value="Save" name="" class="bbtn btn-save btn_dialog_ok">  &nbsp;&nbsp; 
   	<input type="button" value="Cancel" name="" class="bbtn btn-save btn_dialog_cancel">  	
</div>


  
<div id="form_new_builder" title="New Builder" style="display: none;">
    <form id="new_builder_form">
      <div style=" " class="tab-content" >
        <br/>
        <label class="input"><span id="saddress1span">Builder Name</span>
          <input type="text" value="" id="nbuilder_name" name="nbuilder_name">
        </label>
        <label class="input"><span id="saddress1span">Address 1</span>
          <input type="text" value="" id="naddress1" name="naddress1">
        </label>
        <label class="input"><span id="saddress2span">Address 2</span>
          <input type="text" value="" id="naddress2" name="naddress2">
        </label>
        
        <!--- Site Suburb -->
        <label class="input"><span >Suburb</span>
          <input type="text" id="nsuburb" name='nsuburb' value="" onkeypress="nsuburbchange();"  />
        </label>
        <input type="hidden" id="nsuburb_id" name='nsuburbid' value=""  />
        <label class="input"><span id="nstatespan">State</span>
          <input type="text" id="nsuburbstate" name="nstate" value=""  />
        </label>
        <label class="input"><span id="npostspan">Postcode</span>

          <input type="text" id="nsuburbpostcode" name="npostcode" value=""  />
        </label>
        <!-- End of Site Suburb -->
        <label class="input"><span id="shmphonespan">Work Phone</span>
          <input type="text" value="" id="nworkphone" name="nworkphone">
        </label>
        <label class="input"> &nbsp; </label>
         <input type="hidden"  id="dialog_name" value="" />
        <input type="hidden" name="save_new_builder_to_lookup_table" id="save_new_builder_to_lookup_table" value="1" />
        <input type="button" value="Save"  class="btn" style="width: 90%; margin:2px 0px 5px 2px; padding: 4px;" onclick="copy_data_from_new_builder(event,this);"> 
         <br/>
      </div> 
    </form>
</div>
 
  
<style>
    .ui-autocomplete {
        max-height: 200px;
        overflow-y: auto;
        overflow-x: hidden;
        padding-right: 20px;
        background-color: #ffffff;
        border: 1px solid #999999;
    }
</style>
<script type="text/javascript">
    $(document).ready(function() {
        var site_config = {
            source: function(request, response) {
                $.ajax({
                    url: "<?php echo JURI::base(); ?>includes/vic/suburb_vic.php", 
                    dataType: "json", 
                    cache: false, 
                    type: "get", 
                    data: {term: request.term}
                }).done(function(data) {
                    response(data);
                });
            }, 
            select: function(event, ui) {
                $("#ssuburb").val(ui.item.suburb);
                $("#ssuburbstate").val(ui.item.suburb_state);
                $("#ssuburbpostcode").val(ui.item.suburb_postcode);
                $("#ssuburb_id").val(ui.item.cf_id);
            },
            minLength:2
        };
        $("#ssuburb").autocomplete(site_config);

        $("#ssuburbstate").keypress(function() {
            $("#notification").html("Please choose a suburb in the autocomplete box.");
            //$("#notification").appendTo("."+dataClass+" .notification-area");
            $("#notification").removeClass('hide');
            $("#notification").show();
            setTimeout(
                function() {
                    $( "#notification" ).hide( "slow" );
                }, 
                7000
            );
            $("#ssuburb").css({"border-color": "red"});
            $("#ssuburb").on("change", function() {
                $(this).css({"border-color": "#97989a"});
            });
            $("#ssuburb").text("");
            $("#ssuburb").focus();
        });





        var builder_config = [];

        builder_config[0] = {
            source: function(request, response) {
                $.ajax({
                    url: "<?php echo JURI::base(); ?>includes/vic/suburb_vic.php", 
                    dataType: "json", 
                    cache: false, 
                    type: "get", 
                    data: {term: request.term}
                }).done(function(data) {
                    response(data);
                });
            }, 
            select: function(event, ui) {
                $("#bsuburb1").val(ui.item.suburb);
                $("#bsuburbstate1").val(ui.item.suburb_state);
                $("#bsuburbpostcode1").val(ui.item.suburb_postcode);
                $("#bsuburb_id1").val(ui.item.cf_id);
            },
            minLength:2
        };
        $("#bsuburb1").autocomplete(builder_config[0]);

        builder_config[1] = {
            source: function(request, response) {
                $.ajax({
                    url: "<?php echo JURI::base(); ?>includes/vic/suburb_vic.php", 
                    dataType: "json", 
                    cache: false, 
                    type: "get", 
                    data: {term: request.term}
                }).done(function(data) {
                    response(data);
                });
            }, 
            select: function(event, ui) {
                $("#bsuburb2").val(ui.item.suburb);
                $("#bsuburbstate2").val(ui.item.suburb_state);
                $("#bsuburbpostcode2").val(ui.item.suburb_postcode);
                $("#bsuburb_id2").val(ui.item.cf_id);
            },
            minLength:2
        };
        $("#bsuburb2").autocomplete(builder_config[1]);

        builder_config[2] = {
            source: function(request, response) {
                $.ajax({
                    url: "<?php echo JURI::base(); ?>includes/vic/suburb_vic.php", 
                    dataType: "json", 
                    cache: false, 
                    type: "get", 
                    data: {term: request.term}
                }).done(function(data) {
                    response(data);
                });
            }, 
            select: function(event, ui) {
                $("#bsuburb3").val(ui.item.suburb);
                $("#bsuburbstate3").val(ui.item.suburb_state);
                $("#bsuburbpostcode3").val(ui.item.suburb_postcode);
                $("#bsuburb_id3").val(ui.item.cf_id);
            },
            minLength:2
        };
        $("#bsuburb3").autocomplete(builder_config[2]);

        builder_config[3] = {
            source: function(request, response) {
                $.ajax({
                    url: "<?php echo JURI::base(); ?>includes/vic/suburb_vic.php", 
                    dataType: "json", 
                    cache: false, 
                    type: "get", 
                    data: {term: request.term}
                }).done(function(data) {
                    response(data);
                });
            }, 
            select: function(event, ui) {
                $("#bsuburb4").val(ui.item.suburb);
                $("#bsuburbstate4").val(ui.item.suburb_state);
                $("#bsuburbpostcode4").val(ui.item.suburb_postcode);
                $("#bsuburb_id4").val(ui.item.cf_id);
            },
            minLength:2
        };
        $("#bsuburb4").autocomplete(builder_config[3]);

        builder_config[4] = {
            source: function(request, response) {
                $.ajax({
                    url: "<?php echo JURI::base(); ?>includes/vic/suburb_vic.php", 
                    dataType: "json", 
                    cache: false, 
                    type: "get", 
                    data: {term: request.term}
                }).done(function(data) {
                    response(data);
                });
            }, 
            select: function(event, ui) {
                $("#bsuburb5").val(ui.item.suburb);
                $("#bsuburbstate5").val(ui.item.suburb_state);
                $("#bsuburbpostcode5").val(ui.item.suburb_postcode);
                $("#bsuburb_id5").val(ui.item.cf_id);
            },
            minLength:2
        };
        $("#bsuburb5").autocomplete(builder_config[4]);

        builder_config[5] = {
            source: function(request, response) {
                $.ajax({
                    url: "<?php echo JURI::base(); ?>includes/vic/suburb_vic.php", 
                    dataType: "json", 
                    cache: false, 
                    type: "get", 
                    data: {term: request.term}
                }).done(function(data) {
                    response(data);
                });
            }, 
            select: function(event, ui) {
                $("#bsuburb6").val(ui.item.suburb);
                $("#bsuburbstate6").val(ui.item.suburb_state);
                $("#bsuburbpostcode6").val(ui.item.suburb_postcode);
                $("#bsuburb_id6").val(ui.item.cf_id);
            },
            minLength:2
        };
        $("#bsuburb6").autocomplete(builder_config[5]);





        var buildername_config = [];

        buildername_config[0] = {
            source: function(request, response) {
                $.ajax({
                    url: "<?php echo JURI::base(); ?>includes/vic/builder_vic.php", 
                    dataType: "json", 
                    cache: false, 
                    type: "get", 
                    data: {term: request.term}
                }).done(function(data) {
                    response(data);
                });
            }, 
            select: function(event, ui) {    
                $("#build_name1").val(ui.item.builder_name);
                $("#build_contact1").val(ui.item.builder_contact);
                $("#baddress_11").val(ui.item.builder_address1);
                $("#baddress_21").val(ui.item.builder_address2);
                $("#bsuburb1").val(ui.item.builder_suburb);
                $("#bsuburbstate1").val(ui.item.builder_state);
                $("#bsuburbpostcode1").val(ui.item.builder_postcode);
                $("#b_wphone1").val(ui.item.builder_wkphone);
                $("#b_mobile1").val(ui.item.builder_mobile);
                $("#b_fax1").val(ui.item.builder_fax);
                $("#b_email1").val(ui.item.builder_email);
                $("#builder_id1").val(ui.item.cf_id);
                $("#buildersuburbid1").val(ui.item.builder_suburbid);
            },
            minLength:2
        };
        $("#build_name1").autocomplete(buildername_config[0]);

        buildername_config[1] = {
            source: function(request, response) {
                $.ajax({
                    url: "<?php echo JURI::base(); ?>includes/vic/builder_vic.php", 
                    dataType: "json", 
                    cache: false, 
                    type: "get", 
                    data: {term: request.term}
                }).done(function(data) {
                    response(data);
                });
            }, 
            select: function(event, ui) {    
                $("#build_name2").val(ui.item.builder_name);
                $("#build_contact2").val(ui.item.builder_contact);
                $("#baddress_12").val(ui.item.builder_address1);
                $("#baddress_22").val(ui.item.builder_address2);
                $("#bsuburb2").val(ui.item.builder_suburb);
                $("#bsuburbstate2").val(ui.item.builder_state);
                $("#bsuburbpostcode2").val(ui.item.builder_postcode);
                $("#b_wphone2").val(ui.item.builder_wkphone);
                $("#b_mobile2").val(ui.item.builder_mobile);
                $("#b_fax2").val(ui.item.builder_fax);
                $("#b_email2").val(ui.item.builder_email);
                $("#builder_id2").val(ui.item.cf_id);
                $("#buildersuburbid2").val(ui.item.builder_suburbid);
            },
            minLength:2
        };
        $("#build_name2").autocomplete(buildername_config[1]);

        buildername_config[2] = {
            source: function(request, response) {
                $.ajax({
                    url: "<?php echo JURI::base(); ?>includes/vic/builder_vic.php", 
                    dataType: "json", 
                    cache: false, 
                    type: "get", 
                    data: {term: request.term}
                }).done(function(data) {
                    response(data);
                });
            }, 
            select: function(event, ui) {    
                $("#build_name3").val(ui.item.builder_name);
                $("#build_contact3").val(ui.item.builder_contact);
                $("#baddress_13").val(ui.item.builder_address1);
                $("#baddress_23").val(ui.item.builder_address2);
                $("#bsuburb3").val(ui.item.builder_suburb);
                $("#bsuburbstate3").val(ui.item.builder_state);
                $("#bsuburbpostcode3").val(ui.item.builder_postcode);
                $("#b_wphone3").val(ui.item.builder_wkphone);
                $("#b_mobile3").val(ui.item.builder_mobile);
                $("#b_fax3").val(ui.item.builder_fax);
                $("#b_email3").val(ui.item.builder_email);
                $("#builder_id3").val(ui.item.cf_id);
                $("#buildersuburbid3").val(ui.item.builder_suburbid);
            },
            minLength:2
        };
        $("#build_name3").autocomplete(buildername_config[2]);

        buildername_config[3] = {
            source: function(request, response) {
                $.ajax({
                    url: "<?php echo JURI::base(); ?>includes/vic/builder_vic.php", 
                    dataType: "json", 
                    cache: false, 
                    type: "get", 
                    data: {term: request.term}
                }).done(function(data) {
                    response(data);
                });
            }, 
            select: function(event, ui) {    
                $("#build_name4").val(ui.item.builder_name);
                $("#build_contact4").val(ui.item.builder_contact);
                $("#baddress_14").val(ui.item.builder_address1);
                $("#baddress_24").val(ui.item.builder_address2);
                $("#bsuburb4").val(ui.item.builder_suburb);
                $("#bsuburbstate4").val(ui.item.builder_state);
                $("#bsuburbpostcode4").val(ui.item.builder_postcode);
                $("#b_wphone4").val(ui.item.builder_wkphone);
                $("#b_mobile4").val(ui.item.builder_mobile);
                $("#b_fax4").val(ui.item.builder_fax);
                $("#b_email4").val(ui.item.builder_email);
                $("#builder_id4").val(ui.item.cf_id);
                $("#buildersuburbid4").val(ui.item.builder_suburbid);
            },
            minLength:2
        };
        $("#build_name4").autocomplete(buildername_config[3]);

        buildername_config[4] = {
            source: function(request, response) {
                $.ajax({
                    url: "<?php echo JURI::base(); ?>includes/vic/builder_vic.php", 
                    dataType: "json", 
                    cache: false, 
                    type: "get", 
                    data: {term: request.term}
                }).done(function(data) {
                    response(data);
                });
            }, 
            select: function(event, ui) {    
                $("#build_name5").val(ui.item.builder_name);
                $("#build_contact5").val(ui.item.builder_contact);
                $("#baddress_15").val(ui.item.builder_address1);
                $("#baddress_25").val(ui.item.builder_address2);
                $("#bsuburb5").val(ui.item.builder_suburb);
                $("#bsuburbstate5").val(ui.item.builder_state);
                $("#bsuburbpostcode5").val(ui.item.builder_postcode);
                $("#b_wphone5").val(ui.item.builder_wkphone);
                $("#b_mobile5").val(ui.item.builder_mobile);
                $("#b_fax5").val(ui.item.builder_fax);
                $("#b_email5").val(ui.item.builder_email);
                $("#builder_id5").val(ui.item.cf_id);
                $("#buildersuburbid5").val(ui.item.builder_suburbid);
            },
            minLength:2
        };
        $("#build_name5").autocomplete(buildername_config[4]);

        buildername_config[5] = {
            source: function(request, response) {
                $.ajax({
                    url: "<?php echo JURI::base(); ?>includes/vic/builder_vic.php", 
                    dataType: "json", 
                    cache: false, 
                    type: "get", 
                    data: {term: request.term}
                }).done(function(data) {
                    response(data);
                });
            }, 
            select: function(event, ui) {    
                $("#build_name6").val(ui.item.builder_name);
                $("#build_contact6").val(ui.item.builder_contact);
                $("#baddress_16").val(ui.item.builder_address1);
                $("#baddress_26").val(ui.item.builder_address2);
                $("#bsuburb6").val(ui.item.builder_suburb);
                $("#bsuburbstate6").val(ui.item.builder_state);
                $("#bsuburbpostcode6").val(ui.item.builder_postcode);
                $("#b_wphone6").val(ui.item.builder_wkphone);
                $("#b_mobile6").val(ui.item.builder_mobile);
                $("#b_fax6").val(ui.item.builder_fax);
                $("#b_email6").val(ui.item.builder_email);
                $("#builder_id6").val(ui.item.cf_id);
                $("#buildersuburbid6").val(ui.item.builder_suburbid);
            },
            minLength:2
        };
        $("#build_name6").autocomplete(buildername_config[5]);

        var total_builder = 6;
        var c1 = 0;

        for (c1 = 1; c1 <= total_builder; c1++) {
            $("#bsuburbstate" + c1).keypress(function() {
                $("#notification").html("Please choose a suburb in the autocomplete box.");
                //$("#notification").appendTo("."+dataClass+" .notification-area");
                $("#notification").removeClass('hide');
                $("#notification").show();
                setTimeout(
                    function() {
                        $( "#notification" ).hide( "slow" );
                    }, 
                    7000
                );
                $("#bsuburb" + c1).css({"border-color": "red"});
                $("#bsuburb" + c1).on("change", function() {
                    $(this).css({"border-color": "#97989a"});
                });
                $("#bsuburb" + c1).text("");
                $("#bsuburb" + c1).focus();
            });
        }
    });
</script>


<script type="text/javascript">
	
$(document).ready(function(){

	$('input[type="checkbox"]').on('change', function() {
	   $(this).siblings('input[type="checkbox"]').prop('checked', false);
	});

 
 	$( "#chooseBuilderDialog" ).dialog({
      autoOpen: false,
      show: {
        effect: "blind",
        duration: 700
      },
      
    });
 
    $( "#contract" ).on( "click", function() {
    	$( "#chooseBuilderDialog" ).dialog( "open" );
    	return false; 
    });

    $( ".btn_dialog_ok" ).on( "click", function() {
    	var v = $('.chkBuilder:checked').val(); 
		$("#awarded_builderid").val(v);  // alert(v); //return;
		 
		$("#chronoform_Client_Folder_Vic").submit(); 
	});

	$( ".btn_dialog_cancel" ).on( "click", function() {
    	$( "#chooseBuilderDialog" ).dialog( "close" );
	});
    
    var noteinfo=new ddtabcontent("notes-tabs")
	noteinfo.setpersist(true)
	noteinfo.setselectedClassTarget("link") //"link" or "linkparent"
	noteinfo.init();

  	$('#bsbtn').click(function(){
        if($("#uploadme").val()=='') {
            $("#checkfile").val('No');
        } else {
			$("#checkfile").val('Yes');
		}
		
    });

	$('#ibtn').click(function(){
        if($("#uploadme").val()=='') {
            $("#checkfile").val('No');
        } else {
			$("#checkfile").val('Yes');
		}
		
    });


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

	var url = window.location.href;
	var ref = url.split("?");
	if(ref.length>1){

	 //alert("inside");
	 // alert(ref[1]);
	   $("#ref").val(ref[1]);
	}


});

$('#btnDeleteClient').click(function(evt){
  if(1==0){alert("Can't delete client with existing contract."); evt.preventDefault(); return false;}else{return confirm('Are you sure you want to delete this client?');}
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
             $(o).parent().parent("tr").slideUp(250, function(){ $(this).remove() } );
          }else{
            $("#notification .message").show().addClass('error'); 
          }
        }   
      });

      return false;
    }
  } 

var RepIDArray = new Array();
<?php echo $RepIDArrayPhp; ?>
var RepNameArray = new Array();
<?php echo $RepNameArrayPhp; ?>
var RepIdentArray = new Array();
<?php echo $RepIdentArrayPhp; ?>
var RepEmailArray = new Array();
<?php echo $RepEmailArrayPhp; ?>

function SelectChangedRep()
{
	var Rep = document.getElementById('replist').value;
	document.getElementById('repname').value = RepNameArray[Rep];
	document.getElementById('repident').value = RepIdentArray[Rep];
	document.getElementById('repid').value = RepIDArray[Rep];
    document.getElementById('repemail').value = RepEmailArray[Rep];
}
    

  
 
function ssuburbchange(){
    document.getElementById('sstatespan').style.visibility = 'hidden';
	document.getElementById('spostspan').style.visibility = 'hidden';
}

function bcompanychange1(){
    document.getElementById('bcontactid1').style.visibility = 'hidden';
	document.getElementById('baddress1id1').style.visibility = 'hidden';
	document.getElementById('baddress2id1').style.visibility = 'hidden';
	document.getElementById('bsuburbspan1').style.visibility = 'hidden';
	document.getElementById('bstateid1').style.visibility = 'hidden';
	document.getElementById('bpostid1').style.visibility = 'hidden';
	document.getElementById('bwphoneid1').style.visibility = 'hidden';
	document.getElementById('bmobileid1').style.visibility = 'hidden';
	document.getElementById('bfaxid1').style.visibility = 'hidden';
	document.getElementById('bemailid1').style.visibility = 'hidden';
}
function bsuburbchange1(){
    document.getElementById('bstateid1').style.visibility = 'hidden';
	document.getElementById('bpostid1').style.visibility = 'hidden';
}


function bcompanychange2(){
    document.getElementById('bcontactid2').style.visibility = 'hidden';
	document.getElementById('baddress1id2').style.visibility = 'hidden';
	document.getElementById('baddress2id2').style.visibility = 'hidden';
	document.getElementById('bsuburbspan2').style.visibility = 'hidden';
	document.getElementById('bstateid2').style.visibility = 'hidden';
	document.getElementById('bpostid2').style.visibility = 'hidden';
	document.getElementById('bwphoneid2').style.visibility = 'hidden';
	document.getElementById('bmobileid2').style.visibility = 'hidden';
	document.getElementById('bfaxid2').style.visibility = 'hidden';
	document.getElementById('bemailid2').style.visibility = 'hidden';
}
function bsuburbchange2(){
    document.getElementById('bstateid2').style.visibility = 'hidden';
	document.getElementById('bpostid2').style.visibility = 'hidden';
}

function bcompanychange3(){
    document.getElementById('bcontactid3').style.visibility = 'hidden';
	document.getElementById('baddress1id3').style.visibility = 'hidden';
	document.getElementById('baddress2id3').style.visibility = 'hidden';
	document.getElementById('bsuburbspan3').style.visibility = 'hidden';
	document.getElementById('bstateid3').style.visibility = 'hidden';
	document.getElementById('bpostid3').style.visibility = 'hidden';
	document.getElementById('bwphoneid3').style.visibility = 'hidden';
	document.getElementById('bmobileid3').style.visibility = 'hidden';
	document.getElementById('bfaxid3').style.visibility = 'hidden';
	document.getElementById('bemailid3').style.visibility = 'hidden';
}
function bsuburbchange3(){
    document.getElementById('bstateid3').style.visibility = 'hidden';
	document.getElementById('bpostid3').style.visibility = 'hidden';
}

function bcompanychange4(){
    document.getElementById('bcontactid4').style.visibility = 'hidden';
	document.getElementById('baddress1id4').style.visibility = 'hidden';
	document.getElementById('baddress2id4').style.visibility = 'hidden';
	document.getElementById('bsuburbspan4').style.visibility = 'hidden';
	document.getElementById('bstateid4').style.visibility = 'hidden';
	document.getElementById('bpostid4').style.visibility = 'hidden';
	document.getElementById('bwphoneid4').style.visibility = 'hidden';
	document.getElementById('bmobileid4').style.visibility = 'hidden';
	document.getElementById('bfaxid4').style.visibility = 'hidden';
	document.getElementById('bemailid4').style.visibility = 'hidden';
}
function bsuburbchange4(){
    document.getElementById('bstateid4').style.visibility = 'hidden';
	document.getElementById('bpostid4').style.visibility = 'hidden';
}


function bcompanychange5(){
    document.getElementById('bcontactid5').style.visibility = 'hidden';
	document.getElementById('baddress1id5').style.visibility = 'hidden';
	document.getElementById('baddress2id5').style.visibility = 'hidden';
	document.getElementById('bsuburbspan5').style.visibility = 'hidden';
	document.getElementById('bstateid5').style.visibility = 'hidden';
	document.getElementById('bpostid5').style.visibility = 'hidden';
	document.getElementById('bwphoneid5').style.visibility = 'hidden';
	document.getElementById('bmobileid5').style.visibility = 'hidden';
	document.getElementById('bfaxid5').style.visibility = 'hidden';
	document.getElementById('bemailid5').style.visibility = 'hidden';
}
function bsuburbchange5(){
    document.getElementById('bstateid5').style.visibility = 'hidden';
	document.getElementById('bpostid5').style.visibility = 'hidden';
}

function bcompanychange6(){
    document.getElementById('bcontactid6').style.visibility = 'hidden';
	document.getElementById('baddress1id6').style.visibility = 'hidden';
	document.getElementById('baddress2id6').style.visibility = 'hidden';
	document.getElementById('bsuburbspan6').style.visibility = 'hidden';
	document.getElementById('bstateid6').style.visibility = 'hidden';
	document.getElementById('bpostid6').style.visibility = 'hidden';
	document.getElementById('bwphoneid6').style.visibility = 'hidden';
	document.getElementById('bmobileid6').style.visibility = 'hidden';
	document.getElementById('bfaxid6').style.visibility = 'hidden';
	document.getElementById('bemailid6').style.visibility = 'hidden';
}
function bsuburbchange6(){
    document.getElementById('bstateid6').style.visibility = 'hidden';
	document.getElementById('bpostid6').style.visibility = 'hidden';
}

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


var trackerinfo=new ddtabcontent("tracker-tabs")
trackerinfo.setpersist(false)
trackerinfo.setselectedClassTarget("link") //"link" or "linkparent"
trackerinfo.init()    
    
 
var builderinfo=new ddtabcontent("builder-tabs")
builderinfo.setpersist(false)
builderinfo.setselectedClassTarget("link") //"link" or "linkparent"
builderinfo.init()

 $('.form_datetime').datetimepicker({
	        //language:  'en',
	        weekStart: 1,
	        todayBtn:  1,
			autoclose: 1,
			todayHighlight: 1,
			startView: 2,
			forceParse: 0,
	        showMeridian: 1
	    });
		$('.form_date').datetimepicker({
	        language:  'en',
	        weekStart: 1,
	        todayBtn:  1,
			autoclose: 1,
			todayHighlight: 1,
			startView: 2,
			minView: 2,
			forceParse: 0
	    });
		$('.form_time').datetimepicker({
	        language:  'en',
	        weekStart: 1,
	        todayBtn:  1,
			autoclose: 1,
			todayHighlight: 1,
			startView: 1,
			minView: 0,
			maxView: 1,
			forceParse: 0
	    });
	    
		var LeadIDArray = new Array();
		<?php echo $LeadIDArrayPhp; ?>
		var LeadNameArray = new Array();
		<?php echo $LeadNameArrayPhp; ?>


		function SelectChangedLead()
		{
			var Lead = document.getElementById('leadlist').value;
			document.getElementById('leadname').value = LeadNameArray[Lead];
			document.getElementById('leadid').value = LeadIDArray[Lead];

		}

function setCostingStatusAndSubmit(status)
{
    $("#costing_status").val(status);//alert(status);
    $("#btn_save_tender_folder_form").click();
}



function open_create_builder_dialog(dialog_name=""){
    var nsite_config = {
    source: "../includes/vic/suburb_vic.php",
    select: function(event, ui){    
        $("#nsuburb").val(ui.item.suburb);
        $("#nsuburbstate").val(ui.item.suburb_state);
        $("#nsuburbpostcode").val(ui.item.suburb_postcode); 
    },
    minLength:1
    }; 

    $("#nsuburb").autocomplete(nsite_config);

      $("#nbuilder_name").val("");
      $("#naddress1").val("");
      $("#naddress2").val("");
      $("#nsuburb").val("");
      $("#nsuburbstate").val("");
      $("#nsuburbpostcode").val("");
      $("#nworkphone").val("");
      $("#dialog_name").val(dialog_name);
      


    $("#form_new_builder").dialog();
} 



function copy_data_from_new_builder(event,o){
 
  //var d = event.target.attributes;
  // console.log(d); 
  // console.log($(event.target).attr('data-class')); 
  // console.log($(o).closes event.preventDefault();
  var action = $(o).closest('form').attr('action');  
  var iData = $(o).closest('form').serialize();  
  var index = $("#dialog_name").val().substring($("#dialog_name").val().length-1);
  //alert(index); return;
  //alert($("#nbuilder_name").val()); return;
  //console.log(iData); 
  //return false;

  $.ajax({
      type: "POST",
      url: action,
      dataType: 'json',   
      data: iData,  
      success: function(data) {     
        if(data.success==true){   
  
            $("#build_name"+index).val($("#nbuilder_name").val());
            $("#baddress_1"+index).val($("#naddress1").val());
            $("#baddress_2"+index).val($("#naddress2").val());
            $("#bsuburb"+index).val($("#nsuburb").val());
            $("#bsuburbstate"+index).val($("#nsuburbstate").val());
            $("#bsuburbpostcode"+index).val($("#nsuburbpostcode").val());
            $("#b_wphone"+index).val($("#nworkphone").val());

             
            $("#build_name"+index).parent().children('span').hide();
            $("#baddress_1"+index).parent().children('span').hide();
            $("#baddress_2"+index).parent().children('span').hide();
            $("#bsuburb"+index).parent().children('span').hide();
            $("#bsuburbstate"+index).parent().children('span').hide();
            $("#bsuburbpostcode"+index).parent().children('span').hide();
            $("#b_wphone"+index).parent().children('span').hide();
        
           
            $("#form_new_builder").dialog('close'); 
              
        }else{
           $("#notification .message").addClass('error'); 
        }
 

      }   
    });

    return false;

 
} 
  
function find_builder(event,o){
  event.preventDefault();
  var d = event.target.attributes;
  // console.log(d);  
  // console.log($(event.target).attr('data-class')); 
  // console.log($(o).closest('form').attr("action")); 

  var action = $(o).closest('form').attr('action');  
  var iData = $(o).closest('form').serialize(); 
 
  $.ajax({
      type: "POST",
      url: action,
      dataType: 'json',   
      data: iData,  
      success: function(data) {         
        if(data.success==true){  
            
                 
        }else{
          $("#notification .message").addClass('error'); 
        }
 

      }   
    });

    return false;
  }

</script>