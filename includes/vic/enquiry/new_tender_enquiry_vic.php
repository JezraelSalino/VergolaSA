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


<?php 
date_default_timezone_set('Australia/Victoria');

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

  
$next_increment = 0;
$qShowStatus = "SHOW TABLE STATUS LIKE 'ver_chronoforms_data_builderpersonal_vic'";
$qShowStatusResult = mysql_query($qShowStatus) or die ( "Query failed: " . mysql_error() . "<br/>" . $qShowStatus );
$row = mysql_fetch_assoc($qShowStatusResult);
$next_increment = $row['Auto_increment'];
$getclientid = 'BRV'.$next_increment;
$gettenderid = 'TRV'.$next_increment;


if(isset($_POST['save']) || isset($_POST['sendmail']))
{	
    
	$BuildName1 = $_POST['builder_name1'];
	$BuildContact1 = $_POST['builder_contact1'];					
	$BuildAddress11 = $_POST['baddress11'];
	$BuildAddress21 = $_POST['baddress21'];
	$BuildSuburb1 = $_POST['builder_suburb1'] ;
	$BuildState1 = $_POST['builder_state1'];					
	$BuildPostcode1 = $_POST['builder_postcode1'];
	$BuildWPhone1 = $_POST['bwphone1'];
	$BuildMobile1 = $_POST['bmobile1'];					
	$BuildFax1 = $_POST['bfax1'];
	$BuildEmail1 = $_POST['bemail1'];
		
  $SiteProject = $_POST['sprojectname'];
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
  $TenderStatus = "Yes";


   
  $SiteProject = $_POST['sprojectname'];
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
  $TenderStatus = "Yes";

	
  //$AppointmentLodged = $_POST['dtp_appointment'];  
  if(empty($_POST['dtp_appointment'])==true || $_POST['dtp_appointment']=="0000-00-00 00:00:00")
     $AppointmentLodged = "NULL";
  else
    $AppointmentLodged = "'".$_POST['dtp_appointment']."'";

	  
  $date =  $_POST['idate'];
  $timestamp = date('Y-m-d H:i:s', strtotime($date)); 
  $DateLodged = $timestamp;  
	
    $RepID = $_POST['repid'];
	$RepIdent = $_POST['repident'];
	$RepName = $_POST['repname'];
	
	$LeadID = $_POST['leadid'];
	$LeadName = $_POST['leadname'];
	
	$EmployeeID = $_POST['username'];

  $sql = "INSERT INTO ver_chronoforms_data_builderpersonal_vic
                             (builderid,
                builder_suburbid, 
                builder_name, 
                builder_contact, 
                builder_address1, 
                builder_address2,
                builder_suburb,
                builder_state,
                builder_postcode,
                builder_wkphone,
                builder_mobile,
                builder_fax,
                builder_email,
                
                site_suburbid,
                site_project,
                site_address1,
                site_address2,
                site_suburb,
                site_state,
                site_postcode,
                site_wkphone,
                site_hmphone,
                site_mobile,
                site_other,
                site_email,
                tenderstatus,
                tenderid,
                              
                datelodged,
                repid,
                repident,
                repname,
                leadid,
                leadname,

                appointmentdate,
                employeeid) 
     VALUES ('$getclientid',
             '$BuildSuburbID1',
                 '$BuildName1',
                 '$BuildContact1',
                 '$BuildAddress11',
                 '$BuildAddress21',
                 '$BuildSuburb1',
                 '$BuildState1',  
                 '$BuildPostcode1',
                 '$BuildWPhone1',
                 '$BuildMobile1',
                 '$BuildFax1',
                 '$BuildEmail1',
         
                 '$SiteSuburbID',
                 '$SiteProject',
                 '$SiteAddress1',
                 '$SiteAddress2',
                 '$SiteSuburb',
                 '$SiteState',
                 '$SitePostcode',
                 '$SiteWKPhone',
                 '$SiteHMPhone',
                 '$SiteMobile',
                 '$SiteOther',
                 '$SiteEmail',
                 '$TenderStatus',
                 '$gettenderid', 
                 '$DateLodged',
                 '$RepID',
                 '$RepIdent',
                 '$RepName',
                 '$LeadID',
                 '$LeadName',
                 $AppointmentLodged,
                 '$EmployeeID')";  			

	mysql_query($sql);


  //save entry in personal client table

  $sql = "INSERT INTO ver_chronoforms_data_clientpersonal_vic
                             (clientid,
                builderid,
                client_suburbid, 
                builder_name, 
                builder_contact, 
                client_address1, 
                client_address2,
                client_suburb,
                client_state,
                client_postcode,
                client_wkphone,
                client_mobile,
                client_other,
                client_email,
                
                site_suburbid,
                tender_project_name,
                site_address1,
                site_address2,
                site_suburb,
                site_state,
                site_postcode,
                site_wkphone,
                site_hmphone,
                site_mobile,
                site_other,
                site_email, 
                tenderid,
                              
                datelodged,
                repid,
                repident,
                repname,
                leadid,
                leadname,

                appointmentdate,
                employeeid,
                is_builder) 

     VALUES ('$getclientid',
              '$getclientid',
             '$BuildSuburbID1',
                 '$BuildName1',
                 '$BuildContact1',
                 '$BuildAddress11',
                 '$BuildAddress21',
                 '$BuildSuburb1',
                 '$BuildState1',  
                 '$BuildPostcode1',
                 '$BuildWPhone1',
                 '$BuildMobile1',
                 '$BuildFax1',
                 '$BuildEmail1',
         
                 '$SiteSuburbID',
                 '$SiteProject',
                 '$SiteAddress1',
                 '$SiteAddress2',
                 '$SiteSuburb',
                 '$SiteState',
                 '$SitePostcode',
                 '$SiteWKPhone',
                 '$SiteHMPhone',
                 '$SiteMobile',
                 '$SiteOther',
                 '$SiteEmail', 
                 '$gettenderid', 
                 '$DateLodged',
                 '$RepID',
                 '$RepIdent',
                 '$RepName',
                 '$LeadID',
                 '$LeadName',
                 $AppointmentLodged,
                 '$EmployeeID',
                 '1')";       

  mysql_query($sql);



  if(strlen($_POST['builder_name2'])){
      $getclientid = 'BRV'.$next_increment+1;

      $BuildName1 = $_POST['builder_name2'];
      $BuildContact1 = $_POST['builder_contact2'];          
      $BuildAddress11 = $_POST['baddress12'];
      $BuildAddress21 = $_POST['baddress22'];
      $BuildSuburb1 = $_POST['builder_suburb2'] ;
      $BuildState1 = $_POST['builder_state2'];          
      $BuildPostcode1 = $_POST['builder_postcode2'];
      $BuildWPhone1 = $_POST['bwphone2'];
      $BuildMobile1 = $_POST['bmobile2'];         
      $BuildFax1 = $_POST['bfax2'];
      $BuildEmail1 = $_POST['bemail2'];

      $sql = "INSERT INTO ver_chronoforms_data_clientpersonal_vic
                             (clientid,
                builderid,
                client_suburbid, 
                builder_name, 
                builder_contact, 
                client_address1, 
                client_address2,
                client_suburb,
                client_state,
                client_postcode,
                client_wkphone,
                client_mobile,
                client_other,
                client_email,
                
                site_suburbid,
                site_title,
                site_address1,
                site_address2,
                site_suburb,
                site_state,
                site_postcode,
                site_wkphone,
                site_hmphone,
                site_mobile,
                site_other,
                site_email, 
                tenderid,
                              
                datelodged,
                repid,
                repident,
                repname,
                leadid,
                leadname,

                appointmentdate,
                employeeid,
                is_builder) 

     VALUES ('$getclientid',
             '$getclientid',
             '$BuildSuburbID1',
                 '$BuildName1',
                 '$BuildContact1',
                 '$BuildAddress11',
                 '$BuildAddress21',
                 '$BuildSuburb1',
                 '$BuildState1',  
                 '$BuildPostcode1',
                 '$BuildWPhone1',
                 '$BuildMobile1',
                 '$BuildFax1',
                 '$BuildEmail1',
         
                 '$SiteSuburbID',
                 '$SiteProject',
                 '$SiteAddress1',
                 '$SiteAddress2',
                 '$SiteSuburb',
                 '$SiteState',
                 '$SitePostcode',
                 '$SiteWKPhone',
                 '$SiteHMPhone',
                 '$SiteMobile',
                 '$SiteOther',
                 '$SiteEmail', 
                 '$gettenderid', 
                 '$DateLodged',
                 '$RepID',
                 '$RepIdent',
                 '$RepName',
                 '$LeadID',
                 '$LeadName',
                 $AppointmentLodged,
                 '$EmployeeID',
                 '1')";       

      mysql_query($sql);

  }

  if(strlen($_POST['builder_name3'])){
      $getclientid = 'BRV'.$next_increment+1;
      $BuildName1 = $_POST['builder_name3'];
      $BuildContact1 = $_POST['builder_contact3'];          
      $BuildAddress11 = $_POST['baddress13'];
      $BuildAddress21 = $_POST['baddress23'];
      $BuildSuburb1 = $_POST['builder_suburb3'] ;
      $BuildState1 = $_POST['builder_state3'];          
      $BuildPostcode1 = $_POST['builder_postcode3'];
      $BuildWPhone1 = $_POST['bwphone3'];
      $BuildMobile1 = $_POST['bmobile3'];         
      $BuildFax1 = $_POST['bfax3'];
      $BuildEmail1 = $_POST['bemail3'];

       $sql = "INSERT INTO ver_chronoforms_data_clientpersonal_vic
                             (clientid,
                builderid,
                client_suburbid, 
                builder_name, 
                builder_contact, 
                client_address1, 
                client_address2,
                client_suburb,
                client_state,
                client_postcode,
                client_wkphone,
                client_mobile,
                client_other,
                client_email,
                
                site_suburbid,
                site_title,
                site_address1,
                site_address2,
                site_suburb,
                site_state,
                site_postcode,
                site_wkphone,
                site_hmphone,
                site_mobile,
                site_other,
                site_email, 
                tenderid,
                              
                datelodged,
                repid,
                repident,
                repname,
                leadid,
                leadname,

                appointmentdate,
                employeeid,
                is_builder) 

     VALUES ('$getclientid',
             '$getclientid',
             '$BuildSuburbID1',
                 '$BuildName1',
                 '$BuildContact1',
                 '$BuildAddress11',
                 '$BuildAddress21',
                 '$BuildSuburb1',
                 '$BuildState1',  
                 '$BuildPostcode1',
                 '$BuildWPhone1',
                 '$BuildMobile1',
                 '$BuildFax1',
                 '$BuildEmail1',
         
                 '$SiteSuburbID',
                 '$SiteProject',
                 '$SiteAddress1',
                 '$SiteAddress2',
                 '$SiteSuburb',
                 '$SiteState',
                 '$SitePostcode',
                 '$SiteWKPhone',
                 '$SiteHMPhone',
                 '$SiteMobile',
                 '$SiteOther',
                 '$SiteEmail', 
                 '$gettenderid', 
                 '$DateLodged',
                 '$RepID',
                 '$RepIdent',
                 '$RepName',
                 '$LeadID',
                 '$LeadName',
                 $AppointmentLodged,
                 '$EmployeeID',
                 '1')";       

      mysql_query($sql);

  }

  if(strlen($_POST['builder_name4'])){
      $getclientid = 'BRV'.$next_increment+1;
      $BuildName1 = $_POST['builder_name4'];
      $BuildContact1 = $_POST['builder_contact4'];          
      $BuildAddress11 = $_POST['baddress14'];
      $BuildAddress21 = $_POST['baddress24'];
      $BuildSuburb1 = $_POST['builder_suburb4'] ;
      $BuildState1 = $_POST['builder_state4'];          
      $BuildPostcode1 = $_POST['builder_postcode4'];
      $BuildWPhone1 = $_POST['bwphone4'];
      $BuildMobile1 = $_POST['bmobile4'];         
      $BuildFax1 = $_POST['bfax4'];
      $BuildEmail1 = $_POST['bemail4'];

       $sql = "INSERT INTO ver_chronoforms_data_clientpersonal_vic
                             (clientid,
                builderid,
                client_suburbid, 
                builder_name, 
                builder_contact, 
                client_address1, 
                client_address2,
                client_suburb,
                client_state,
                client_postcode,
                client_wkphone,
                client_mobile,
                client_other,
                client_email,
                
                site_suburbid,
                site_title,
                site_address1,
                site_address2,
                site_suburb,
                site_state,
                site_postcode,
                site_wkphone,
                site_hmphone,
                site_mobile,
                site_other,
                site_email, 
                tenderid,
                              
                datelodged,
                repid,
                repident,
                repname,
                leadid,
                leadname,

                appointmentdate,
                employeeid,
                is_builder) 

     VALUES ('$getclientid',
              '$getclientid',
             '$BuildSuburbID1',
                 '$BuildName1',
                 '$BuildContact1',
                 '$BuildAddress11',
                 '$BuildAddress21',
                 '$BuildSuburb1',
                 '$BuildState1',  
                 '$BuildPostcode1',
                 '$BuildWPhone1',
                 '$BuildMobile1',
                 '$BuildFax1',
                 '$BuildEmail1', 
                 '$SiteSuburbID',
                 '$SiteProject',
                 '$SiteAddress1',
                 '$SiteAddress2',
                 '$SiteSuburb',
                 '$SiteState',
                 '$SitePostcode',
                 '$SiteWKPhone',
                 '$SiteHMPhone',
                 '$SiteMobile',
                 '$SiteOther',
                 '$SiteEmail', 
                 '$gettenderid', 
                 '$DateLodged',
                 '$RepID',
                 '$RepIdent',
                 '$RepName',
                 '$LeadID',
                 '$LeadName',
                 $AppointmentLodged,
                 '$EmployeeID',
                 '1')";       

      mysql_query($sql);

  }

  if(strlen($_POST['builder_name5'])){
      $getclientid = 'BRV'.$next_increment+1;
      $BuildName1 = $_POST['builder_name5'];
      $BuildContact1 = $_POST['builder_contact5'];          
      $BuildAddress11 = $_POST['baddress15'];
      $BuildAddress21 = $_POST['baddress25'];
      $BuildSuburb1 = $_POST['builder_suburb5'] ;
      $BuildState1 = $_POST['builder_state5'];          
      $BuildPostcode1 = $_POST['builder_postcode5'];
      $BuildWPhone1 = $_POST['bwphone5'];
      $BuildMobile1 = $_POST['bmobile5'];         
      $BuildFax1 = $_POST['bfax5'];
      $BuildEmail1 = $_POST['bemail5'];


       $sql = "INSERT INTO ver_chronoforms_data_clientpersonal_vic
                             (clientid,
                builderid,
                client_suburbid, 
                builder_name, 
                builder_contact, 
                client_address1, 
                client_address2,
                client_suburb,
                client_state,
                client_postcode,
                client_wkphone,
                client_mobile,
                client_other,
                client_email,
                
                site_suburbid,
                site_title,
                site_address1,
                site_address2,
                site_suburb,
                site_state,
                site_postcode,
                site_wkphone,
                site_hmphone,
                site_mobile,
                site_other,
                site_email, 
                tenderid,
                              
                datelodged,
                repid,
                repident,
                repname,
                leadid,
                leadname,

                appointmentdate,
                employeeid,
                is_builder) 

     VALUES ('$getclientid',
              '$getclientid',
             '$BuildSuburbID1',
                 '$BuildName1',
                 '$BuildContact1',
                 '$BuildAddress11',
                 '$BuildAddress21',
                 '$BuildSuburb1',
                 '$BuildState1',  
                 '$BuildPostcode1',
                 '$BuildWPhone1',
                 '$BuildMobile1',
                 '$BuildFax1',
                 '$BuildEmail1',
                 '$SiteSuburbID',
                 '$SiteProject',
                 '$SiteAddress1',
                 '$SiteAddress2',
                 '$SiteSuburb',
                 '$SiteState',
                 '$SitePostcode',
                 '$SiteWKPhone',
                 '$SiteHMPhone',
                 '$SiteMobile',
                 '$SiteOther',
                 '$SiteEmail', 
                 '$gettenderid', 
                 '$DateLodged',
                 '$RepID',
                 '$RepIdent',
                 '$RepName',
                 '$LeadID',
                 '$LeadName',
                 $AppointmentLodged,
                 '$EmployeeID',
                 '1')";       

      mysql_query($sql);

  }

  if(strlen($_POST['builder_name6'])){
      $getclientid = 'BRV'.$next_increment+1;
      $BuildName1 = $_POST['builder_name6'];
      $BuildContact1 = $_POST['builder_contact6'];          
      $BuildAddress11 = $_POST['baddress16'];
      $BuildAddress21 = $_POST['baddress26'];
      $BuildSuburb1 = $_POST['builder_suburb6'] ;
      $BuildState1 = $_POST['builder_state6'];          
      $BuildPostcode1 = $_POST['builder_postcode6'];
      $BuildWPhone1 = $_POST['bwphone6'];
      $BuildMobile1 = $_POST['bmobile6'];         
      $BuildFax1 = $_POST['bfax6'];
      $BuildEmail1 = $_POST['bemail6'];

       $sql = "INSERT INTO ver_chronoforms_data_clientpersonal_vic
                             (clientid,
                builderid,
                client_suburbid, 
                builder_name, 
                builder_contact, 
                client_address1, 
                client_address2,
                client_suburb,
                client_state,
                client_postcode,
                client_wkphone,
                client_mobile,
                client_other,
                client_email,
                
                site_suburbid,
                site_title,
                site_address1,
                site_address2,
                site_suburb,
                site_state,
                site_postcode,
                site_wkphone,
                site_hmphone,
                site_mobile,
                site_other,
                site_email, 
                tenderid,
                              
                datelodged,
                repid,
                repident,
                repname,
                leadid,
                leadname,

                appointmentdate,
                employeeid,
                is_builder) 

     VALUES ('$getclientid',
             '$getclientid',
             '$BuildSuburbID1',
                 '$BuildName1',
                 '$BuildContact1',
                 '$BuildAddress11',
                 '$BuildAddress21',
                 '$BuildSuburb1',
                 '$BuildState1',  
                 '$BuildPostcode1',
                 '$BuildWPhone1',
                 '$BuildMobile1',
                 '$BuildFax1',
                 '$BuildEmail1',
         
                 '$SiteSuburbID',
                 '$SiteProject',
                 '$SiteAddress1',
                 '$SiteAddress2',
                 '$SiteSuburb',
                 '$SiteState',
                 '$SitePostcode',
                 '$SiteWKPhone',
                 '$SiteHMPhone',
                 '$SiteMobile',
                 '$SiteOther',
                 '$SiteEmail', 
                 '$gettenderid', 
                 '$DateLodged',
                 '$RepID',
                 '$RepIdent',
                 '$RepName',
                 '$LeadID',
                 '$LeadName',
                 $AppointmentLodged,
                 '$EmployeeID',
                 '1')";       

      mysql_query($sql);

  }



 // error_log($sql, 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_sa\\my-error.log'); 
				 
$NotesTxt =  $_POST['notestxt'];
$DateNotes = $_POST['date_notes'];
$UsernameNotes = $_POST['username_notes'];	

mysql_query("INSERT INTO ver_chronoforms_data_notes_vic (clientid, datenotes, username, content)  
              VALUES ('$getclientid','$DateNotes', '$UsernameNotes','$NotesTxt')");
                 
//This is the Time Save 
$now = time();  

if(isset($_FILES['photo'])){ 

    foreach ($_FILES['photo']['tmp_name'] as $key => $tmp_name){
//This is the directory where images will be saved 
        $target="images/drawings/$now-";
        $target=$target.$_FILES['photo']['name'][$key];	
		if (move_uploaded_file($tmp_name, $target)) {

      $query = "INSERT INTO ver_chronoforms_data_drawings_vic (clientid, photo) VALUES  ('$getclientid', '$target')";
      mysql_query($query) or trigger_error("Insert failed: " . mysql_error());

         		
            }
    }
}
    
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
	
	header('Location:'.JURI::base().'tender-listing-vic/tender-folder-vic?tenderid='.$gettenderid);			
}



?>
<?php
$form->data['date_entered'] = date(PHP_DFORMAT);
$form->data['date_time'] = date(PHP_DFORMAT.' g:i A');
?>
<SCRIPT language="javascript">
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
</SCRIPT>

<script language="javascript">
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
</script>
<script language="javascript">
//<![CDATA[
$(window).load(function(){
	
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

});//]]>
</script>


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
                    url: "includes/vic/suburb_vic.php", 
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
                    url: "includes/vic/suburb_vic.php", 
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
                    url: "includes/vic/suburb_vic.php", 
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
                    url: "includes/vic/suburb_vic.php", 
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
                    url: "includes/vic/suburb_vic.php", 
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
                    url: "includes/vic/suburb_vic.php", 
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
                    url: "includes/vic/suburb_vic.php", 
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
                    url: "includes/vic/builder_vic.php", 
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
                    url: "includes/vic/builder_vic.php", 
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
                    url: "includes/vic/builder_vic.php", 
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
                    url: "includes/vic/builder_vic.php", 
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
                    url: "includes/vic/builder_vic.php", 
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
                    url: "includes/vic/builder_vic.php", 
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
/*
  $(document).ready(function(){
    var site_config = {
    source: "includes/vic/suburb_vic.php",
    select: function(event, ui){		
		$("#ssuburb").val(ui.item.suburb);
        $("#ssuburbstate").val(ui.item.suburb_state);
        $("#ssuburbpostcode").val(ui.item.suburb_postcode);
		$("#ssuburb_id").val(ui.item.cf_id);
    },
    minLength:1
    };
		$("#ssuburb").autocomplete(site_config);

    var builder1_config = {
    source: "includes/vic/suburb_vic.php",
    select: function(event, ui){
        $("#bsuburb1").val(ui.item.suburb);
        $("#bsuburbstate1").val(ui.item.suburb_state);
        $("#bsuburbpostcode1").val(ui.item.suburb_postcode);
    $("#bsuburb_id1").val(ui.item.cf_id); 
    },
    minLength:1
    };
    $("#bsuburb1").autocomplete(builder1_config);

    $("#ssuburbstate").keypress(function(){
         $("#notification").html("Please choose a suburb in the autocomplete box.");   
          //$("#notification").appendTo("."+dataClass+" .notification-area");
          $("#notification").removeClass('hide');  
          $("#notification").show(); 
          setTimeout(function() {
                $( "#notification" ).hide( "slow" );
          }, 7000);

          
          $("#ssuburb").css({ "border-color": "red"});
          $("#ssuburb").one("change",function(){ $(this).css({ "border-color": "#97989a"}); });
          $("#ssuburb").text(""); 
          $("#ssuburb").focus(); 
    });

    $("#bsuburbstate1").keypress(function(){
         $("#notification").html("Please choose a suburb in the autocomplete box.");   
          //$("#notification").appendTo("."+dataClass+" .notification-area");
          $("#notification").removeClass('hide');  
          $("#notification").show(); 
          setTimeout(function() {
                $( "#notification" ).hide( "slow" );
          }, 7000); 
          
          $("#bsuburb1").css({ "border-color": "red"});
          $("#bsuburb1").one("change",function(){ $(this).css({ "border-color": "#97989a"}); });
          $("#bsuburb1").text("");
          $("#bsuburb1").focus(); 
    });


    //  var buildername1_config = {
    // source: "includes/vic/builder_vic.php",
    // select: function(event, ui){    
    // $("#build_name1").val(ui.item.builder_name);
    //     $("#build_contact1").val(ui.item.builder_contact);
    //     $("#baddress_11").val(ui.item.builder_address1);
    // $("#baddress_21").val(ui.item.builder_address2);
    // $("#bsuburb1").val(ui.item.builder_suburb);
    //     $("#bsuburbstate1").val(ui.item.builder_state);
    //     $("#bsuburbpostcode1").val(ui.item.builder_postcode);
    // $("#b_wphone1").val(ui.item.builder_wkphone);
    // $("#b_mobile1").val(ui.item.builder_mobile);
    // $("#b_fax1").val(ui.item.builder_fax);
    // $("#b_email1").val(ui.item.builder_email);
    // $("#builder_id1").val(ui.item.cf_id);
    // $("#buildersuburbid1").val(ui.item.builder_suburbid);
    // },
    // minLength:1
    // };
    // $("#build_name1").autocomplete(buildername1_config);

    var builder_name = {
    source: "includes/vic/query_builder.php",
    select: function(event, ui){    
      
      
      $("#build_name1").val(ui.item.builder_name);
      $("#baddress_11").val(ui.item.address1); 
      $("#baddress_21").val(ui.item.address2); 

      $("#bsuburb1").val(ui.item.suburb);
      $("#bsuburbstate1").val(ui.item.state);
      $("#bsuburbpostcode1").val(ui.item.postcode);
      $("#b_wphone1").val(ui.item.workphone);   
    
    },
    minLength:2
    }; 

    $("#build_name1").autocomplete(builder_name);




    var builder_name2 = {
    source: "includes/vic/query_builder.php",
    select: function(event, ui){    
      
      
      $("#build_name2").val(ui.item.builder_name);
      $("#baddress_12").val(ui.item.address1); 
      $("#baddress_22").val(ui.item.address2); 

      $("#bsuburb2").val(ui.item.suburb);
      $("#bsuburbstate2").val(ui.item.state);
      $("#bsuburbpostcode2").val(ui.item.postcode);
      $("#b_wphone2").val(ui.item.workphone);   
    
    },
    minLength:2
    }; 

    $("#build_name2").autocomplete(builder_name2);


     var builder_name3 = {
    source: "includes/vic/query_builder.php",
    select: function(event, ui){    
      
      
      $("#build_name3").val(ui.item.builder_name);
      $("#baddress_13").val(ui.item.address1); 
      $("#baddress_23").val(ui.item.address2); 

      $("#bsuburb3").val(ui.item.suburb);
      $("#bsuburbstate3").val(ui.item.state);
      $("#bsuburbpostcode3").val(ui.item.postcode);
      $("#b_wphone2").val(ui.item.workphone);   
    
    },
    minLength:2
    }; 

    $("#build_name3").autocomplete(builder_name3);


     var builder_name4 = {
    source: "includes/vic/query_builder.php",
    select: function(event, ui){    
      
      
      $("#build_name4").val(ui.item.builder_name);
      $("#baddress_14").val(ui.item.address1); 
      $("#baddress_24").val(ui.item.address2); 

      $("#bsuburb4").val(ui.item.suburb);
      $("#bsuburbstate4").val(ui.item.state);
      $("#bsuburbpostcode4").val(ui.item.postcode);
      $("#b_wphone4").val(ui.item.workphone);   
    
    },
    minLength:2
    }; 

    $("#build_name4").autocomplete(builder_name4);


     var builder_name5 = {
    source: "includes/vic/query_builder.php",
    select: function(event, ui){    
      
      
      $("#build_name5").val(ui.item.builder_name);
      $("#baddress_15").val(ui.item.address1); 
      $("#baddress_25").val(ui.item.address2); 

      $("#bsuburb5").val(ui.item.suburb);
      $("#bsuburbstate5").val(ui.item.state);
      $("#bsuburbpostcode5").val(ui.item.postcode);
      $("#b_wphone5").val(ui.item.workphone);   
    
    },
    minLength:2
    }; 

    $("#build_name5").autocomplete(builder_name5);



     var builder_name6 = {
    source: "includes/vic/query_builder.php",
    select: function(event, ui){    
      
      
      $("#build_name6").val(ui.item.builder_name);
      $("#baddress_16").val(ui.item.address1); 
      $("#baddress_26").val(ui.item.address2); 

      $("#bsuburb6").val(ui.item.suburb);
      $("#bsuburbstate6").val(ui.item.state);
      $("#bsuburbpostcode6").val(ui.item.postcode);
      $("#b_wphone6").val(ui.item.workphone);   
    
    },
    minLength:2
    }; 

    $("#build_name6").autocomplete(builder_name6);


  });


 

  $(document).ready(function(){
    var builder2_config = {
    source: "includes/vic/suburb_vic.php",
    select: function(event, ui){
        $("#bsuburb2").val(ui.item.suburb);
        $("#bsuburbstate2").val(ui.item.suburb_state);
        $("#bsuburbpostcode2").val(ui.item.suburb_postcode);
		$("#bsuburb_id2").val(ui.item.cf_id);	
    },
    minLength:1
    };
        $("#bsuburb2").autocomplete(builder2_config);

  });

  $(document).ready(function(){
    var builder3_config = {
    source: "includes/vic/suburb_vic.php",
    select: function(event, ui){
        $("#bsuburb3").val(ui.item.suburb);
        $("#bsuburbstate3").val(ui.item.suburb_state);
        $("#bsuburbpostcode3").val(ui.item.suburb_postcode);
		$("#bsuburb_id3").val(ui.item.cf_id);	
    },
    minLength:1
    };
        $("#bsuburb3").autocomplete(builder3_config);

  });

  $(document).ready(function(){
    var builder4_config = {
    source: "includes/vic/suburb_vic.php",
    select: function(event, ui){
        $("#bsuburb4").val(ui.item.suburb);
        $("#bsuburbstate4").val(ui.item.suburb_state);
        $("#bsuburbpostcode4").val(ui.item.suburb_postcode);
		$("#bsuburb_id4").val(ui.item.cf_id);	
    },
    minLength:1
    };
        $("#bsuburb4").autocomplete(builder4_config);

  });

  $(document).ready(function(){
    var builder5_config = {
    source: "includes/vic/suburb_vic.php",
    select: function(event, ui){
        $("#bsuburb5").val(ui.item.suburb);
        $("#bsuburbstate5").val(ui.item.suburb_state);
        $("#bsuburbpostcode5").val(ui.item.suburb_postcode);
		$("#bsuburb_id5").val(ui.item.cf_id);	
    },
    minLength:1
    };
        $("#bsuburb5").autocomplete(builder5_config);

  });

  $(document).ready(function(){
    var builder6_config = {
    source: "includes/vic/suburb_vic.php",
    select: function(event, ui){
        $("#bsuburb6").val(ui.item.suburb);
        $("#bsuburbstate6").val(ui.item.suburb_state);
        $("#bsuburbpostcode6").val(ui.item.suburb_postcode);
		$("#bsuburb_id6").val(ui.item.cf_id);	
    },
    minLength:1
    };
        $("#bsuburb6").autocomplete(builder6_config);

  });
*/
</script>

<script>
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

</script>

<div id="notification" class="notification_box hide"  ></div>

<form method="post" action="<?php echo JURI::base().'new-tender-enquiry-vic/'; ?>" class="Chronoform hasValidation" id="chronoform_New_Tender_Enquiry_Vic" enctype="multipart/form-data">
<input type="hidden" value="" id="blank" name="blank" />
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
        
        <!--- Site Suburb --->
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
       <!-- End of Site Suburb --->
       
        <label class="input"><span id="shmphonespan">Home Phone</span>
          <input type="text" value="<?php echo $SiteHMPhone; ?>" id="shmphone" name="shmphone">
        </label>
         <label class="input"><span id="swkphonespan">Work Phone</span>
          <input type="text" value="<?php echo $SiteWKPhone; ?>" id="swkphone" name="swkphone">
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
  
   <!------------------------------------------------- Builder Content Tab -------------------------------------------------------------->
<div id="tabs_wrapper" class="builder-tab" style="width:28%;">
  <div id="tabs_container" >
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
    
    <!--  Builder 1 Tab  ->
    <!------------------------------------------------------- Builder 1 Details ------------------------------------------------------------>

    <div id="builder1" class="tab_content" style="display: block;">  
        <label class="input" style="width:95%"><span id="bnameid1">Company Name</span>
          <input type="text" value="<?php echo $BuildName; ?>" id="build_name1" name="builder_name1" onkeypress="bcompanychange1();" style="width:75%;">
          <input type="button" value="New" name="save_new_builder" class="btn"  style="width:75px;" onclick="open_create_builder_dialog('builder_dialog1')"> 
        </label>
        <label class="input"><span id="bcontactid1">Contact</span>
          <input type="text" value="<?php echo $BuildContact; ?>" id="build_contact1" name="builder_contact1">
        </label>
        <label class="input"><span id="baddress1id1">Address 1</span>
          <input type="text" value="<?php echo $BuildAddress1; ?>" id="baddress_11" name="baddress11">
        </label>
        <label class="input"><span id="baddress2id1">Address 2</span>
          <input type="text" value="<?php echo $BuildAddress2; ?>" id="baddress_21" name="baddress21">
        </label>
        
       <!--- Builder Suburb -->
        <label class="input"><span id="bsuburbspan1">Suburb</span>
          <input type="text" id="bsuburb1" name="builder_suburb1" class="bsub-class" value="<?php echo $BuilderSuburb; ?>"  onkeypress="bsuburbchange1();" />
         </label>
        <input type="hidden" id="bsuburb_id1" name="bsuburbid1" value="<?php echo $BuilderSuburbID; ?>" readonly />

        <label class="input"><span id="bstateid1">State</span>
          <input type="text" id="bsuburbstate1" name="builder_state1" class="bstate-class" value="<?php echo $BuilderState; ?>" readonly />
        </label>
        <label class="input"><span id="bpostid1">Postcode</span>
          <input type="text" id="bsuburbpostcode1" name="builder_postcode1" class="bpost-class" value="<?php echo $BuilderPostcode ?>" readonly />
        </label>
         <!-- End of Builder Suburb -->
         
        <label class="input"><span id="bwphoneid1">Work Phone</span>
          <input type="text" class="bphone-class" value="<?php echo $BuildWPhone; ?>" id="b_wphone1" name="bwphone1">
        </label>
        <label class="input"><span id="bmobileid1">Mobile</span>
          <input type="text" class="bmobile-class" value="<?php echo $BuildMobile; ?>" id="b_mobile1" name="bmobile1">
        </label>
        <label class="input"><span id="bfaxid1">Fax</span>
          <input type="text" class="bfax-class" value="<?php echo $BuildFax; ?>" id="b_fax1" name="bfax1" >
        </label>
        <label class="input"><span id="bemailid1">Email</span>
          <input type="text" class="bemail-class" value="<?php echo $BuildEmail; ?>" id="b_email1" name="bemail1" >
        </label>
    
    </div>
    
    <!---------------------------------------------------- Builder 2 Tab ------------------------------------------------>
    
    <div id="builder2" class="tab_content"> 
    
    <!------------------------------------------------------- Builder 2 Details ------------------------------------------------------------>
        
        <label class="input" style="width:95%"><span id="bnameid2">Company Name</span>
          <input type="text" value="<?php echo $BuildName; ?>" id="build_name2" name="builder_name2" onkeypress="bcompanychange2();" style="width:75%;">
          <input type="button" value="New" name="save_new_builder" class="btn"  style="width:75px;" onclick="open_create_builder_dialog('builder_dialog2')"> 
        </label>
 
        <label class="input"><span id="bcontactid2">Contact</span>
          <input type="text" value="<?php echo $BuildContact; ?>" id="build_contact2" name="builder_contact2">
        </label>
        <label class="input"><span id="baddress1id2">Address 1</span>
          <input type="text" value="<?php echo $BuildAddress1; ?>" id="baddress_12" name="baddress12">
        </label>
        <label class="input"><span id="baddress2id2">Address 2</span>
          <input type="text" value="<?php echo $BuildAddress2; ?>" id="baddress_22" name="baddress22">
        </label>
        
       <!--- Builder Suburb -->
        <label class="input"><span id="bsuburbspan2">Suburb</span>
          <input type="text" id="bsuburb2" name="builder_suburb2" class="bsub-class" value="<?php echo $BuilderSuburb; ?>"  onkeypress="bsuburbchange2();" />
         </label>
        <input type="hidden" id="bsuburb_id2" name="bsuburbid2" value="<?php echo $BuilderSuburbID; ?>" readonly />

        <label class="input"><span id="bstateid2">State</span>
          <input type="text" id="bsuburbstate2" name="builder_state2" class="bstate-class" value="<?php echo $BuilderState; ?>" readonly />
        </label>
        <label class="input"><span id="bpostid2">Postcode</span>
          <input type="text" id="bsuburbpostcode2" name="builder_postcode2" class="bpost-class" value="<?php echo $BuilderPostcode ?>" readonly />
        </label>
         <!-- End of Builder Suburb -->
         
        <label class="input"><span id="bwphoneid2">Work Phone</span>
          <input type="text" class="bphone-class" value="<?php echo $BuildWPhone; ?>" id="b_wphone2" name="bwphone2">
        </label>
        <label class="input"><span id="bmobileid2">Mobile</span>
          <input type="text" class="bmobile-class" value="<?php echo $BuildMobile; ?>" id="b_mobile2" name="bmobile2">
        </label>
        <label class="input"><span id="bfaxid2">Fax</span>
          <input type="text" class="bfax-class" value="<?php echo $BuildFax; ?>" id="b_fax2" name="bfax2" >
        </label>
        <label class="input"><span id="bemailid2">Email</span>
          <input type="text" class="bemail-class" value="<?php echo $BuildEmail; ?>" id="b_email2" name="bemail2" >
        </label>
    
        
    </div>
    
    <!---------------------------------------------------- Builder 3 Tab ------------------------------------------------>
    
    <div id="builder3" class="tab_content"> 
    
    <!------------------------------------------------------- Builder 3 Details ------------------------------------------------------------>
        
        <label class="input" style="width:95%"><span id="bnameid3" >Company Name</span>
          <input type="text" value="<?php echo $BuildName; ?>" id="build_name3" name="builder_name3" onkeypress="bcompanychange3();" style="width:75%;">
          <input type="button" value="New" name="save_new_builder" class="btn"  style="width:75px;" onclick="open_create_builder_dialog('builder_dialog3')"> 
        </label>
        <label class="input"><span id="bcontactid3">Contact</span>
          <input type="text" value="<?php echo $BuildContact; ?>" id="build_contact3" name="builder_contact3">
        </label>
        <label class="input"><span id="baddress1id3">Address 1</span>
          <input type="text" value="<?php echo $BuildAddress1; ?>" id="baddress_13" name="baddress13">
        </label>
        <label class="input"><span id="baddress2id3">Address 2</span>
          <input type="text" value="<?php echo $BuildAddress2; ?>" id="baddress_23" name="baddress23">
        </label>
        
       <!--- Builder Suburb -->
        <label class="input"><span id="bsuburbspan3">Suburb</span>
          <input type="text" id="bsuburb3" name="builder_suburb3" class="bsub-class" value="<?php echo $BuilderSuburb; ?>"  onkeypress="bsuburbchange3();" />
         </label>
        <input type="hidden" id="bsuburb_id3" name="bsuburbid3" value="<?php echo $BuilderSuburbID; ?>" readonly />

        <label class="input"><span id="bstateid3">State</span>
          <input type="text" id="bsuburbstate3" name="builder_state3" class="bstate-class" value="<?php echo $BuilderState; ?>" readonly />
        </label>
        <label class="input"><span id="bpostid3">Postcode</span>
          <input type="text" id="bsuburbpostcode3" name="builder_postcode3" class="bpost-class" value="<?php echo $BuilderPostcode ?>" readonly />
        </label>
         <!-- End of Builder Suburb -->
         
        <label class="input"><span id="bwphoneid3">Work Phone</span>
          <input type="text" class="bphone-class" value="<?php echo $BuildWPhone; ?>" id="b_wphone3" name="bwphone3">
        </label>
        <label class="input"><span id="bmobileid3">Mobile</span>
          <input type="text" class="bmobile-class" value="<?php echo $BuildMobile; ?>" id="b_mobile3" name="bmobile3">
        </label>
        <label class="input"><span id="bfaxid3">Fax</span>
          <input type="text" class="bfax-class" value="<?php echo $BuildFax; ?>" id="b_fax3" name="bfax3" >
        </label>
        <label class="input"><span id="bemailid3">Email</span>
          <input type="text" class="bemail-class" value="<?php echo $BuildEmail; ?>" id="b_email3" name="bemail3" >
        </label>
    
    </div>
    
    <!---------------------------------------------------- Builder 4 Tab ------------------------------------------------>
    
    <div id="builder4" class="tab_content"> 
    
        <label class="input" style="width:95%"><span id="bnameid4" >Company Name</span>
          <input type="text" value="<?php echo $BuildName; ?>" id="build_name4" name="builder_name4" onkeypress="bcompanychange4();" style="width:75%;">
          <input type="button" value="New" name="save_new_builder" class="btn"  style="width:75px;" onclick="open_create_builder_dialog('builder_dialog4')"> 
        </label>
        <label class="input"><span id="bcontactid4">Contact</span>
          <input type="text" value="<?php echo $BuildContact; ?>" id="build_contact4" name="builder_contact4">
        </label>
        <label class="input"><span id="baddress1id4">Address 1</span>
          <input type="text" value="<?php echo $BuildAddress1; ?>" id="baddress_14" name="baddress14">
        </label>
        <label class="input"><span id="baddress2id4">Address 2</span>
          <input type="text" value="<?php echo $BuildAddress2; ?>" id="baddress_24" name="baddress24">
        </label>
        
       <!--- Builder Suburb -->
        <label class="input"><span id="bsuburbspan4">Suburb</span>
          <input type="text" id="bsuburb4" name="builder_suburb4" class="bsub-class" value="<?php echo $BuilderSuburb; ?>"  onkeypress="bsuburbchange4();" />
         </label>
        <input type="hidden" id="bsuburb_id4" name="bsuburbid4" value="<?php echo $BuilderSuburbID; ?>" readonly />

        <label class="input"><span id="bstateid4">State</span>
          <input type="text" id="bsuburbstate4" name="builder_state4" class="bstate-class" value="<?php echo $BuilderState; ?>" readonly />
        </label>
        <label class="input"><span id="bpostid4">Postcode</span>
          <input type="text" id="bsuburbpostcode4" name="builder_postcode4" class="bpost-class" value="<?php echo $BuilderPostcode ?>" readonly />
        </label>
         <!-- End of Builder Suburb -->
         
        <label class="input"><span id="bwphoneid4">Work Phone</span>
          <input type="text" class="bphone-class" value="<?php echo $BuildWPhone; ?>" id="b_wphone4" name="bwphone4">
        </label>
        <label class="input"><span id="bmobileid4">Mobile</span>
          <input type="text" class="bmobile-class" value="<?php echo $BuildMobile; ?>" id="b_mobile4" name="bmobile4">
        </label>
        <label class="input"><span id="bfaxid4">Fax</span>
          <input type="text" class="bfax-class" value="<?php echo $BuildFax; ?>" id="b_fax4" name="bfax4" >
        </label>
        <label class="input"><span id="bemailid4">Email</span>
          <input type="text" class="bemail-class" value="<?php echo $BuildEmail; ?>" id="b_email4" name="bemail4" >
        </label>
    </div>
    
    <!---------------------------------------------------- Builder 5 Tab ------------------------------------------------>
    
    <div id="builder5" class="tab_content"> 
    
        <label class="input" style="width:95%"><span id="bnameid5">Company Name</span>
          <input type="text" value="<?php echo $BuildName; ?>" id="build_name5" name="builder_name5" onkeypress="bcompanychange5();" style="width:75%;">
          <input type="button" value="New" name="save_new_builder" class="btn"  style="width:75px;" onclick="open_create_builder_dialog('builder_dialog5')"> 
        </label>
        <label class="input"><span id="bcontactid5">Contact</span>
          <input type="text" value="<?php echo $BuildContact; ?>" id="build_contact5" name="builder_contact5">
        </label>
        <label class="input"><span id="baddress1id5">Address 1</span>
          <input type="text" value="<?php echo $BuildAddress1; ?>" id="baddress_15" name="baddress15">
        </label>
        <label class="input"><span id="baddress2id5">Address 2</span>
          <input type="text" value="<?php echo $BuildAddress2; ?>" id="baddress_25" name="baddress25">
        </label>
        
       <!--- Builder Suburb -->
        <label class="input"><span id="bsuburbspan5">Suburb</span>
          <input type="text" id="bsuburb5" name="builder_suburb5" class="bsub-class" value="<?php echo $BuilderSuburb; ?>"  onkeypress="bsuburbchange5();" />
         </label>
        <input type="hidden" id="bsuburb_id5" name="bsuburbid5" value="<?php echo $BuilderSuburbID; ?>" readonly />

        <label class="input"><span id="bstateid5">State</span>
          <input type="text" id="bsuburbstate5" name="builder_state5" class="bstate-class" value="<?php echo $BuilderState; ?>" readonly />
        </label>
        <label class="input"><span id="bpostid5">Postcode</span>
          <input type="text" id="bsuburbpostcode5" name="builder_postcode5" class="bpost-class" value="<?php echo $BuilderPostcode ?>" readonly />
        </label>
         <!-- End of Builder Suburb -->
         
        <label class="input"><span id="bwphoneid5">Work Phone</span>
          <input type="text" class="bphone-class" value="<?php echo $BuildWPhone; ?>" id="b_wphone5" name="bwphone5">
        </label>
        <label class="input"><span id="bmobileid5">Mobile</span>
          <input type="text" class="bmobile-class" value="<?php echo $BuildMobile; ?>" id="b_mobile5" name="bmobile5">
        </label>
        <label class="input"><span id="bfaxid5">Fax</span>
          <input type="text" class="bfax-class" value="<?php echo $BuildFax; ?>" id="b_fax5" name="bfax5" >
        </label>
        <label class="input"><span id="bemailid5">Email</span>
          <input type="text" class="bemail-class" value="<?php echo $BuildEmail; ?>" id="b_email5" name="bemail5" >
        </label>
    
    </div>
    
     <!---------------------------------------------------- Builder 6 Tab ------------------------------------------------> 
    <div id="builder6" class="tab_content"> 
        <label class="input"  style="width:95%"><span id="bnameid6">Company Name</span>
          <input type="text" value="<?php echo $BuildName; ?>" id="build_name6" name="builder_name6" onkeypress="bcompanychange6();" style="width:75%;">
          <input type="button" value="New" name="save_new_builder" class="btn"  style="width:75px;" onclick="open_create_builder_dialog('builder_dialog6')"> 
        </label>
        <label class="input"><span id="bcontactid6">Contact</span>
          <input type="text" value="<?php echo $BuildContact; ?>" id="build_contact6" name="builder_contact6">
        </label>
        <label class="input"><span id="baddress1id6">Address 1</span>
          <input type="text" value="<?php echo $BuildAddress1; ?>" id="baddress_16" name="baddress16">
        </label>
        <label class="input"><span id="baddress2id6">Address 2</span>
          <input type="text" value="<?php echo $BuildAddress2; ?>" id="baddress_26" name="baddress26">
        </label>
        
       <!--- Builder Suburb -->
        <label class="input"><span id="bsuburbspan6">Suburb</span>
          <input type="text" id="bsuburb6" name="builder_suburb6" class="bsub-class" value="<?php echo $BuilderSuburb; ?>"  onkeypress="bsuburbchange6();" />
         </label>
        <input type="hidden" id="bsuburb_id6" name="bsuburbid6" value="<?php echo $BuilderSuburbID; ?>" readonly />

        <label class="input"><span id="bstateid6">State</span>
          <input type="text" id="bsuburbstate6" name="builder_state6" class="bstate-class" value="<?php echo $BuilderState; ?>" readonly />
        </label>
        <label class="input"><span id="bpostid6">Postcode</span>
          <input type="text" id="bsuburbpostcode6" name="builder_postcode6" class="bpost-class" value="<?php echo $BuilderPostcode ?>" readonly />
        </label>
         <!-- End of Builder Suburb -->
         
        <label class="input"><span id="bwphoneid6">Work Phone</span>
          <input type="text" class="bphone-class" value="<?php echo $BuildWPhone; ?>" id="b_wphone6" name="bwphone6">
        </label>
        <label class="input"><span id="bmobileid6">Mobile</span>
          <input type="text" class="bmobile-class" value="<?php echo $BuildMobile; ?>" id="b_mobile6" name="bmobile6">
        </label>
        <label class="input"><span id="bfaxid6">Fax</span>
          <input type="text" class="bfax-class" value="<?php echo $BuildFax; ?>" id="b_fax6" name="bfax6" >
        </label>
        <label class="input"><span id="bemailid6">Email</span>
          <input type="text" class="bemail-class" value="<?php echo $BuildEmail; ?>" id="b_email6" name="bemail6" >
        </label>
    
    </div>
    
    <!----------------------------------------- End of Builder Tab Content -------------------------------------------------->
    

  </div>
</div>
<script type="text/javascript">

var builderinfo=new ddtabcontent("builder-tabs")
builderinfo.setpersist(false)
builderinfo.setselectedClassTarget("link") //"link" or "linkparent"
builderinfo.init()

</script>

<!----------------------------------------------------------- End of Builder Tabs ------------------------------------------------->
  
  <!------------------------------------------------------------- Enquiry Tracker Tab ------------------------------------------------>
  <div id="tabs_wrapper" class="info-tab" style="width: 40%;">
    <div id="tabs_container">
      <ul id="tabs_default">
        <li class="active"><span>Enquiry Tracker</span></li>
      </ul>
    </div>
    <div id="tabs_content_container">
      <div id="tracker" class="tab_content_default" style="display: block;">
        <label class="input"><span id="date-entered">Date Entered:</span>
          <input type="text" id="idate" name="idate" class="date_entered" value="<?php print(Date(PHP_DFORMAT)); ?>">
          <input type="submit" value="Send Mail" id="ibtn" name="sendmail" class="btn btn-add">
        </label>
       
        
        <!--- Sales Rep -->
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
	  	    echo "<label class='input'><span>Sales Rep</span><select class='rep-list' id='replist' name='replist' onchange='javascript:SelectChangedRep();'><option></option>";
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

<script language="Javascript" type="text/javascript">
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
</script>
        <input type="hidden" id="repname" name='repname' value="<?php echo $RepName; ?>" readonly />
        <input type="hidden" id="repident" name='repident' value="<?php echo $RepIdent; ?>" readonly />
        <input type="hidden" id="repid" name='repid' value="<?php echo $RepID; ?>" readonly />
        <input type="hidden" id="repemail" name='repemail' value="<?php echo $RepEmail; ?>" readonly />
        <!-- End of Sales Rep --> 
        
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
			



	  	    echo "<label class='input'><span>Lead Type</span><select class='lead-list' id='leadlist' name='leadlist' onchange='javascript:SelectChangedLead();'><option></option>";
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
        
        <label class='input' style="display: none;"><span>Last Rep Allocated</span>
          <select class="last-rep">
            <option value=""></option>
          </select>
        </label>
        
        
        <div class="input-group date form_datetime col-md-5" data-date-format="<?php echo JS_DFORMAT; ?> @ HH:ii P" data-link-field="dtp_appointment" style="display:inline-block">
            <label class='input'>
                <span id='date-entered'>Appointment: </span>
                <input type="text" id="iappointment" name="iappointment" class="form-control" value="" readonly>
            </label>    
            <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
					  <span class="input-group-addon"><span class="glyphicon glyphicon-th"></span></span>
        </div>

				<input type="hidden" id="dtp_appointment" name="dtp_appointment" value="" /><br/>
        <?php $user =& JFactory::getUser(); $userName = $user->get( 'name' );
       echo '<label class=\'input\'><span id=\'takenid\'>Taken by:</span><input type=\'text\' id=\'username\' name=\'username\' class=\'username\' value=\''.$userName.'\' readonly></label>';?>
         <?php $usermail =& JFactory::getUser(); $userEmail = $usermail->get( 'email' );
       echo '<input type=\'hidden\' id=\'usermail\' name=\'usermail\' value=\''.$userEmail.'\' readonly>';?>

        <script type="text/javascript">
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
</script>
      </div>
    </div>
  </div>
  
  <!-- Drawing Image Tab -->
  <div id="tabs_wrapper" class="drawing-tab" style="width: 28%;">
    <div id="tabs_container">
      <ul id="tabs_default">
        <li class="active"><span>Drawing</span></li>
      </ul>
    </div>
    <div id="tabs_content_container">
    <div id="draw" class="tab_content_default" style="display: block;">
    <!-- <INPUT type="button" value="Add Drawing" onclick="addRow('tbl-draw')" /> -->
    <INPUT type="button" value="Delete Drawing" class="bbtn btn-delete" onclick="deleteRow('tbl-draw')" />

        
        <table id="tbl-draw">
        <tr>
            <td class="tbl-chk"><input type="checkbox" name="chk"/></td>
             <td class="tbl-upload"><input type="file" name="photo[]" id="uploadme" multiple="multiple" accept=".jpg,.png,.bmp,.gif,.pdf">
            <input type="hidden" id="checkfile" value="No" name="checkfile"></td>
        </tr>
    </table>
        
        
        </div>
    </div>
  </div>
  
  <!-- Notes Tab -->
  
  <div id="tabs_wrapper" class="notes-tab">
    <div id="tabs_container">
      <ul id="tabs_default">
        <li class="active"><span>Notes</span></li>
      </ul>
    </div>
    <div id="tabs_content_container">

      <div id="notes" class="tab_content_default" style="display: block;">
        <table id="tbl-notes">
          <?php $user =& JFactory::getUser(); $userName = $user->get( 'name' ); 
		  //$date_notes = (Date('d-M-Y g:i A')); ?>

<tr>
		  <td class="tbl-content"><textarea name="notestxt" id="notestxt"><?php echo $NotesTxt; ?></textarea>
          <div class="layer-date">Date: <input type="text" id="date_display" name="date_display" class="datetime_display" value="<?php print(Date("d-M-Y")); ?>" readonly>
          <input type="hidden" id="date_notes" name="date_notes[]" class="date_time" value="<?php print(Date(PHP_DFORMAT." H:i:s")); ?>" readonly></div>
          <div class="layer-whom">By Whom: <input type="text" id="username_notes" name="username_notes[]" class="username" value="<?php echo $userName; ?>" readonly></div>
          
          
          </td>
		 
	 
		  </tr>

        </table>

      </div>
    </div>
  </div>
  <div id="tabs_wrapper" class="button-tab">
    <input type="submit" value="Cancel" id="bcbtn" name="cancel" class="bbtn" onclick=location.href='<?php echo JURI::base().'/client-listing-vic'; ?> />
    <input type="submit" value="Save" id="bsbtn" name="save" class="bbtn btn-save">
  </div>
</form>



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


<script language="Javascript" type="text/javascript">
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

 
function open_create_builder_dialog(dialog_name=""){
    var nsite_config = {
    source: "includes/vic/suburb_vic.php",
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
  //alert(index1); return;
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