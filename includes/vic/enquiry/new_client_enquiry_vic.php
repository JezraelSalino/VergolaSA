<?php   
date_default_timezone_set('Australia/Victoria');

if(isset($_POST['save_new_builder_to_lookup_table'])){ 
  
$next_increment = 0;

$qShowStatus = "SHOW TABLE STATUS LIKE 'ver_chronoforms_data_builderpersonal_vic'";
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
  $StreetNo = mysql_escape_string($_POST['nstreet_no']);  
  $StreetName = mysql_escape_string($_POST['nstreet_name']);  
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

    //error_log("INSERT to look up: ".$sql, 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_sa\\my-error.log'); //exit();
    mysql_query($sql);
    $result_id  = mysql_insert_id();

    //header('Location:'.JURI::base().'new-builder-enquiry-vic'); 
    $result = array('success' => true, 'note' => '');

    echo json_encode($result);
    exit();

}

//error_log("inside new builder 2", 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_sa\\my-error.log');  

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



$notification = "";
$is_builder = 0;
$is_query_builder = 1;
  
$page_name = "";
$request = parse_url($_SERVER['REQUEST_URI']);
$page_name = substr($request["path"],1); 

if(isset($_REQUEST['error'])){
  $notification = "Error while saving data..";
}  


if($page_name == "new-builder-enquiry-vic"){
  $is_builder = 1;
}else if(isset($_REQUEST['client_type']) && $_REQUEST['client_type']=="b"){
    $is_builder = 1;
}




if(isset($_POST['update']) || isset($_POST['send_and_update']) )
{ 
   
  $is_builder = $_POST['is_builder'];
  $pid = $_POST['pid'];
  $clientid = $_POST['clientid'];
  $ClientSuburbID = $_POST['csuburbid'] ;
  $ClientTitle = $_POST['ctitle'];
  $ClientFirstName = mysql_escape_string($_POST['firstname']);
  $ClientLastName = mysql_escape_string($_POST['lastname']);
  $ClientStreetNo = mysql_escape_string($_POST['cstreetno']);
  $ClientStreetName = mysql_escape_string($_POST['cstreetname']);
  $ClientAddress1 = mysql_escape_string($_POST['caddress1']);
  $ClientAddress2 = mysql_escape_string($_POST['caddress2']);
  $ClientSuburb = mysql_escape_string($_POST['client_suburb']);
  $ClientState = mysql_escape_string($_POST['client_state']);
  $ClientPostCode = $_POST['client_postcode'];
  $ClientWPhone = $_POST['cwkphone'];
  $ClientHPhone = $_POST['chmphone'];
  $ClientMobile = $_POST['cmobile'];
  $ClientOther = $_POST['cother'];
  $ClientEmail = $_POST['cemail'];

  $builder_name = mysql_escape_string($_POST['builder_name']);
  $builder_contact = mysql_escape_string($_POST['builder_contact']); 
  $BuilderContactTitle = mysql_escape_string($_POST['btitle']); 
  $BuilderContactFirstName = mysql_escape_string($_POST['contact_firstname']);   
  $BuilderContactLastName = mysql_escape_string($_POST['contact_lastname']); 
  
  $SiteTitle = $_POST['stitle'];
  $SiteFirstName = mysql_escape_string($_POST['sfirstname']);
  $SiteLastName = mysql_escape_string($_POST['slastname']);
  $SiteSiteName = mysql_escape_string($_POST['ssitename']);
  $SiteStreetNo = mysql_escape_string($_POST['sstreetno']);
  $SiteStreetName = mysql_escape_string($_POST['sstreetname']);
  $SiteAddress1 = mysql_escape_string($_POST['saddress1']);
  $SiteAddress2 = mysql_escape_string($_POST['saddress2']);
  $SiteSuburbID = $_POST['ssuburbid'];
  $SiteSuburb = $_POST['site_suburb'];
  $SiteState = mysql_escape_string($_POST['site_state']);
  $SitePostcode = $_POST['site_postcode'];
  $SiteWKPhone = $_POST['swkphone'];
  $SiteHMPhone = $_POST['shmphone'];
  $SiteMobile = $_POST['smobile'];
  $SiteOther = $_POST['sother'];
  $SiteEmail = $_POST['semail'];
    
  $date =  $_POST['idate'];
  $timestamp = date('Y-m-d H:i:s', strtotime($date)); 
  $DateLodged = $timestamp;

  if(empty($_POST['dtp_appointment'])==true || $_POST['dtp_appointment']=="0000-00-00 00:00:00")
     $AppointmentLodged = "NULL";
  else
    $AppointmentLodged = "'".$_POST['dtp_appointment']."'";

  $RepID = $_POST['repid']; 
  $RepName = $_POST['repname'];
  $RepEmail = $_POST['repemail']; 
  $LeadID = $_POST['leadid'];
  $LeadName = $_POST['leadname']; 
  $EmployeeID = $_POST['username']; 
  $lastRepId = $_POST['lastRepId'];
  $RepIdent = $_POST['repident'];
  
     
$sql = "UPDATE ver_chronoforms_data_clientpersonal_vic SET 
                client_suburbid = '$ClientSuburbID', 
                client_title = '$ClientTitle', 
                client_firstname = '$ClientFirstName', 
                client_lastname = '$ClientLastName',
                client_streetno = '$ClientStreetNo', 
                client_streetname = '$ClientStreetName', 
                client_address1 = '$ClientAddress1', 
                client_address2 = '$ClientAddress2', 
                client_suburb = '$ClientSuburb', 
                client_state = '$ClientState', 
                client_postcode = '$ClientPostCode', 
                client_wkphone = '$ClientWPhone', 
                client_hmphone = '$ClientHPhone', 
                client_mobile = '$ClientMobile', 
                client_other = '$ClientOther', 
                client_email = '$ClientEmail',  
                site_suburbid = '$SiteSuburbID',
                site_title = '$SiteTitle',
                site_firstname = '$SiteFirstName',
                site_lastname = '$SiteLastName',
				        site_sitename = '$SiteSiteName',
                site_streetno = '$SiteStreetNo', 
                site_streetname = '$SiteStreetName',
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
                builder_name = '$builder_name', 
                builder_contact = '$builder_contact',  
                builder_contact_title = '$BuilderContactTitle',
                builder_contact_firstname = '$BuilderContactFirstName',
                builder_contact_lastname = '$BuilderContactLastName',
                repid = '$RepID',
                repident = '$RepIdent',
                repname = '$RepName',
                leadid = '$LeadID',
                leadname = '$LeadName',
                appointmentdate = $AppointmentLodged,
                employeeid = '$EmployeeID',
                lastRepId = '$lastRepId' 

        WHERE pid={$pid};         
    
      ";
  //error_log($sql, 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_sa\\my-error.log'); exit();
  mysql_query($sql);
  
  //   $sql = "SELECT *, DATE_FORMAT(datelodged,'%d-%b-%Y') fdatelodged, DATE_FORMAT(appointmentdate,'%d-%b-%Y @ %h:%i %p') fappointmentdate  FROM ver_chronoforms_data_clientpersonal_vic WHERE clientid='{$client_id}' ";
    
  // $client = mysql_fetch_assoc(mysql_query($sql)); 
  $mail_result = send_email();

  //error_log("mail_result: ".$mail_result, 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_sa\\my-error.log');

  $notification = "Successfully saved.";

  if($is_builder){
    header('Location:'.JURI::base().'builder-listing-vic/builder-folder-vic?cid='.$clientid);
     
  }else{
    //header('Location:'.JURI::base().'new-client-enquiry-vic?pid='.$pid); 
    header("Location:".JURI::base()."client-listing-vic/client-folder-vic?cid={$clientid}"); 
  }
  return; 
  

}
else if(isset($_POST['save']) || isset($_POST['sendmail'])){	

$next_increment = 0;

$qShowStatus = "SHOW TABLE STATUS LIKE 'ver_chronoforms_data_clientpersonal_vic'";
$qShowStatusResult = mysql_query($qShowStatus) or die ( "Query failed: " . mysql_error() . "<br/>" . $qShowStatus );
$row = mysql_fetch_assoc($qShowStatusResult);
$next_increment = $row['Auto_increment'];

$client_code = "";
if(HOST_SERVER=="Victoria"){
  $client_code = "CRV";
}else if(HOST_SERVER=="SA"){
  $client_code = "CR";
}else if(HOST_SERVER=="LA"){
  $client_code = "CRC";
}

  $getclientid = $client_code.$next_increment;

  $ClientID = $client_code.$row['Auto_increment'];
  $ClientSuburbID = $_POST['csuburbid'];

	$ClientTitle = $_POST['ctitle'];
	$ClientFirstName = mysql_escape_string($_POST['firstname']);
	$ClientLastName = mysql_escape_string($_POST['lastname']);
	$ClientStreetNo = mysql_escape_string($_POST['cstreetno']);
	$ClientStreetName = mysql_escape_string($_POST['cstreetname']);
	$ClientAddress1 = mysql_escape_string($_POST['caddress1']);
	$ClientAddress2 = mysql_escape_string($_POST['caddress2']);
	$ClientSuburb = mysql_escape_string($_POST['client_suburb']);
	$ClientState = mysql_escape_string($_POST['client_state']);
	$ClientPostCode = $_POST['client_postcode'];
	$ClientWPhone = $_POST['cwkphone'];
	$ClientHPhone = $_POST['chmphone'];
	$ClientMobile = $_POST['cmobile'];
	$ClientOther = $_POST['cother'];
	$ClientEmail = $_POST['cemail'];
	$SiteTitle = $_POST['stitle'];
  $SiteFirstName = mysql_escape_string($_POST['sfirstname']);
  $SiteLastName = mysql_escape_string($_POST['slastname']);
  $SiteSiteName = mysql_escape_string($_POST['ssitename']);
  $SiteStreetNo = mysql_escape_string($_POST['sstreetno']);
  $SiteStreetName = mysql_escape_string($_POST['sstreetname']);
	$SiteAddress1 = mysql_escape_string($_POST['saddress1']);
	$SiteAddress2 = mysql_escape_string($_POST['saddress2']);
	$SiteSuburbID = $_POST['ssuburbid'];
	$SiteSuburb = mysql_escape_string($_POST['site_suburb']);
	$SiteState = mysql_escape_string($_POST['site_state']);
	$SitePostcode = $_POST['site_postcode'];
	$SiteWKPhone = $_POST['swkphone'];
  $SiteHMPhone = $_POST['shmphone'];
	$SiteMobile = $_POST['smobile'];
	$SiteOther = $_POST['sother'];
	$SiteEmail = $_POST['semail'];

  $BuilderContactTitle = mysql_escape_string($_POST['btitle']); 
  $BuilderContactFirstName = mysql_escape_string($_POST['contact_firstname']);   
  $BuilderContactLastName = mysql_escape_string($_POST['contact_lastname']); 
    
	$date =  $_POST['idate']; 
    $timestamp = date('Y-m-d H:i:s', strtotime($date)); 
    $DateLodged = $timestamp; 
  if(empty($_POST['dtp_appointment'])==true || $_POST['dtp_appointment']=="0000-00-00 00:00:00")
	  $AppointmentLodged = "NULL";
  else
    $AppointmentLodged = "'".$_POST['dtp_appointment']."'";

  $RepID = $_POST['repid'];
	$RepIdent = $_POST['repident'];
	$RepName = $_POST['repname'];
	$RepEmail = $_POST['repemail'];
	

	$LeadID = $_POST['leadid'];
	$LeadName = $_POST['leadname'];
	

	$EmployeeID = $_POST['username'];
  $lastRepId = $_POST['lastRepId']; 

  $builder_name = $_POST['builder_name'];
  $builder_contact = $_POST['builder_contact']; 
  $is_builder = $_POST['is_builder'];
 			

$sql = "INSERT INTO ver_chronoforms_data_clientpersonal_vic(
			clientid,
			client_suburbid, 
			client_title, 
			client_firstname, 
			client_lastname, 
			client_streetno,
			client_streetname,
			client_address1, 
			client_address2, 
			client_suburb, 
			client_state, 
			client_postcode, 
			client_wkphone, 
			client_hmphone, 
			client_mobile, 
			client_other, 
			client_email,  
			site_suburbid,
			site_title,
			site_firstname,
			site_lastname,
			site_sitename,
			site_streetno,
			site_streetname,
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
			datelodged,
			repid,
			repident,
			repname,
			leadid,
			leadname,
			appointmentdate,
			employeeid,
			lastRepId,
			builder_name,
			builder_contact,
      builder_contact_title,
      builder_contact_firstname,
      builder_contact_lastname,
			is_builder) 
		VALUES (
			'$ClientID',
			'$ClientSuburbID', 
			'$ClientTitle', 
			'$ClientFirstName', 
			'$ClientLastName', 
			'$ClientStreetNo', 
			'$ClientStreetName', 
			'$ClientAddress1', 
			'$ClientAddress2', 
			'$ClientSuburb', 
			'$ClientState', 
			'$ClientPostCode', 
			'$ClientWPhone', 
			'$ClientHPhone', 
			'$ClientMobile', 
			'$ClientOther', 
			'$ClientEmail',
			'$SiteSuburbID',
			'$SiteTitle',
			'$SiteFirstName',
			'$SiteLastName',
      '$SiteSiteName',
      '$SiteStreetNo',
      '$SiteStreetName',          
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
			'$DateLodged',
			'$RepID',
			'$RepIdent',
			'$RepName',
			'$LeadID',
			'$LeadName',
			'$AppointmentLodged',
			'$EmployeeID',
			'$lastRepId',
			'$builder_name',
			'$builder_contact',
      '$BuilderContactTitle',
      '$BuilderContactFirstName',
      '$BuilderContactLastName',
			'$is_builder')";
 //error_log($sql, 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_sa\\my-error.log'); exit();
mysql_query($sql);
$result_id  = mysql_insert_id();

$NotesTxt =  $_POST['notestxt'];
//$DateNotes = $_POST['date_notes'];
$UsernameNotes = $_POST['username_notes'];	
if(strlen($NotesTxt)>0){
  mysql_query("INSERT INTO ver_chronoforms_data_notes_vic (clientid, username, content)  
              VALUES ('$getclientid', '$UsernameNotes','$NotesTxt')");
}

                 
//This is the Time Save 
$now = time();  

if(isset($_FILES['photo'])){ 

    foreach ($_FILES['photo']['tmp_name'] as $key => $tmp_name){
//This is the directory where images will be saved 
        $file_name = pathinfo($_FILES['photo']['name'][$key], PATHINFO_FILENAME).'.'.pathinfo($_FILES['photo']['name'][$key], PATHINFO_EXTENSION); 
		$target="images/drawings/$now-";
        $target=$target.$_FILES['photo']['name'][$key];	
		if (move_uploaded_file($tmp_name, $target)) {

$query = "INSERT INTO ver_chronoforms_data_drawings_vic (clientid, photo, file_name) VALUES  ('$ClientID', '$target','{$file_name}')";

 mysql_query($query) or trigger_error("Insert failed: " . mysql_error());

         		

            }
    }
}

 $mail_result = send_email();

  //error_log("mail_result: ".$mail_result, 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_sa\\my-error.log');
   // mail($from,$subject2,$message2,$headers2); // sends a copy of the message to the sender

    //echo "Mail Sent. To " . $_POST['repname'];
    // You can also use header('Location: thank_you.php'); to redirect to another page.   
  //error_log("result_id: ".$result_id, 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_sa\\my-error.log');
	if($result_id<1){
     
    if($is_builder){
      header('Location:'.JURI::base().'new-builder-enquiry-vic?error=1'); 
    }else{
      header('Location:'.JURI::base().'new-client-enquiry-vic?error=1'); 
    } 
         
  }else if(isset($_REQUEST['ref']) && $_REQUEST['ref']=="home"){
    header('Location:'.JURI::base());
  }else if($is_builder){
    header('Location:'.JURI::base().'builder-listing-vic/builder-folder-vic?pid='.$next_increment);
    return;
  }else{
    header('Location:'.JURI::base().'client-listing-vic/client-folder-vic?pid='.$next_increment);
    return; 
  }
				

}


 



if(isset($_POST['save_site_address'])){ 
  
  $clientid = mysql_escape_string($_POST['clientid']); 
   $builder_contact = mysql_escape_string($_POST['builder_contact']); 
  $SiteAddress1 = mysql_escape_string($_POST['saddress1']);
  $SiteAddress2 = mysql_escape_string($_POST['saddress2']);
  $SiteSuburbID = $_POST['ssuburbid'];
  $SiteSuburb = mysql_escape_string($_POST['site_suburb']);
  $SiteState = mysql_escape_string($_POST['site_state']);
  $SitePostcode = $_POST['site_postcode'];
  $SiteWKPhone = $_POST['swkphone'];
    $SiteHMPhone = $_POST['shmphone'];
  $SiteMobile = $_POST['smobile'];
  $SiteOther = $_POST['sother'];
  $SiteEmail = $_POST['semail'];
  $is_builder = $_POST['is_builder'];   
      
$sql = "INSERT INTO ver_chronoforms_data_builderpersonal_site_address_vic
               (clientid,
                builder_contact, 
                site_streetno,
                site_streetname,
                site_address1,
                site_address2,
                site_suburb,
                site_state,
                site_postcode,
                site_wkphone,
                site_hmphone,
                site_mobile,
                site_other,
                site_email ) 

     VALUES ( '$clientid', 
          '$builder_contact',
          '$SiteStreetNo',
          '$SiteStreetName',
          '$SiteAddress1',
         '$SiteAddress2',
         '$SiteSuburb',
         '$SiteState',
         '$SitePostcode',
         '$SiteWKPhone',
         '$SiteHMPhone',
         '$SiteMobile',
         '$SiteOther',
         '$SiteEmail' )";

error_log("INSERT to site address: ".$sql, 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_sa\\my-error.log'); //exit();
mysql_query($sql);
$result_id  = mysql_insert_id();

  

  //error_log("mail_result: ".$mail_result, 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_sa\\my-error.log');
   // mail($from,$subject2,$message2,$headers2); // sends a copy of the message to the sender

    //echo "Mail Sent. To " . $_POST['repname'];
    // You can also use header('Location: thank_you.php'); to redirect to another page.   
  //error_log("result_id: ".$result_id, 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_sa\\my-error.log');
 header('Location:'.JURI::base().'new-builder-enquiry-vic'); 
        
}

function send_email(){

 
    $to = $_POST['repemail']; // this is the Sales Rep Email address
    $from = $_POST['usermail']; // this is the sender's Email address 
    $first_name = $_POST['firstname'];
    $last_name = $_POST['lastname'];
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
    <td style=\"border-bottom: 1px solid #999;border-left: 1px solid #999;padding:5px;\">Client</td>
    <td style=\"border-bottom: 1px solid #999;border-right: 1px solid #999;border-left: 1px solid #999;padding:5px;\">" . $_POST['firstname'] . " " . $_POST['lastname']. "</td>
  </tr>
  <tr>
    <td style=\"border-bottom: 1px solid #999;border-left: 1px solid #999;padding:5px;\">Address</td>
	<td style=\"border-bottom: 1px solid #999;border-right: 1px solid #999;border-left: 1px solid #999;padding:5px;\">" . $_POST['ssitename'] . " " . $_POST['sstreetno'] . " " . $_POST['sstreetname'] . " " . $_POST['saddress1'] . " " . $_POST['saddress2'] . ", " . $_POST['site_suburb'] . " " . $_POST['site_state'] . " " . $_POST['site_postcode'] . "</td>
  </tr>
  <tr>
    <td style=\"border-bottom: 1px solid #999;border-left: 1px solid #999;padding:5px;\">Phone</td>
    <td style=\"border-bottom: 1px solid #999;border-right: 1px solid #999;border-left: 1px solid #999;padding:5px;\">" . $_POST['chmphone'] ."</td>
  </tr>
  <tr>
    <td style=\"border-bottom: 1px solid #999;border-left: 1px solid #999;padding:5px;\">Mobile</td>
    <td style=\"border-bottom: 1px solid #999;border-right: 1px solid #999;border-left: 1px solid #999;padding:5px;\">" . $_POST['cmobile'] . "</td>
  </tr>
  <tr>
    <td style=\"border-bottom: 1px solid #999;border-left: 1px solid #999;padding:5px;\">Email</td>
    <td style=\"border-bottom: 1px solid #999;border-right: 1px solid #999;border-left: 1px solid #999;padding:5px;\">" . $_POST['cemail'] . "</td>
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
  $message2 = "<table cellpadding=\"0\" cellspacing=\"0\" style=\"border-top: 1px solid #999;min-width:600px;font-family:calibri; font-size:13px;\">
  <tr>
    <td style=\"border-bottom: 1px solid #999;border-left: 1px solid #999;padding:5px;\">Date of Enquiry</td>
    <td style=\"border-bottom: 1px solid #999;border-right: 1px solid #999;border-left: 1px solid #999;padding:5px;\">" .$_POST['idate']. "</td>
  </tr>
  <tr>
    <td style=\"border-bottom: 1px solid #999;border-left: 1px solid #999;padding:5px;\">From:</td>
    <td style=\"border-bottom: 1px solid #999;border-right: 1px solid #999;border-left: 1px solid #999;padding:5px;\">" . $_POST['username'] . "</td>
  </tr>
  <tr>
    <td style=\"border-bottom: 1px solid #999;border-left: 1px solid #999;padding:5px;\">To: </td>
    <td style=\"border-bottom: 1px solid #999;border-right: 1px solid #999;border-left: 1px solid #999;padding:5px;\">" . $_POST['repname'] . "</td>
  </tr>
  <tr>
    <td style=\"border-bottom: 1px solid #999;border-left: 1px solid #999;padding:5px;\">Client:</td>
    <td style=\"border-bottom: 1px solid #999;border-right: 1px solid #999;border-left: 1px solid #999;padding:5px;\">" . $_POST['firstname'] . " " . $_POST['lastname']. "</td>
  </tr>
  <tr>
    <td style=\"border-bottom: 1px solid #999;border-left: 1px solid #999;padding:5px;\">Address: </td>
    <td style=\"border-bottom: 1px solid #999;border-right: 1px solid #999;border-left: 1px solid #999;padding:5px;\">" . $_POST['ssitename'] . " " . $_POST['sstreetno'] . " " . $_POST['sstreetname'] . " " . $_POST['saddress1'] . " " . $_POST['saddress2'] . ", " . $_POST['site_suburb'] . " " . $_POST['site_state'] . " " . $_POST['site_postcode'] . "</td>
  </tr>
  <tr>
    <td style=\"border-bottom: 1px solid #999;border-left: 1px solid #999;padding:5px;\">Phone: </td>
    <td style=\"border-bottom: 1px solid #999;border-right: 1px solid #999;border-left: 1px solid #999;padding:5px;\">" . $_POST['chmphone'] ."</td>
  </tr>
  <tr>
    <td style=\"border-bottom: 1px solid #999;border-left: 1px solid #999;padding:5px;\">Mobile: </td>
    <td style=\"border-bottom: 1px solid #999;border-right: 1px solid #999;border-left: 1px solid #999;padding:5px;\">" . $_POST['cmobile'] . "</td>
  </tr>
  <tr>
    <td style=\"border-bottom: 1px solid #999;border-left: 1px solid #999;padding:5px;\">Email: </td>
    <td style=\"border-bottom: 1px solid #999;border-right: 1px solid #999;border-left: 1px solid #999;padding:5px;\">" . $_POST['cemail'] . "</td>
  </tr>
 <tr>
    <td style=\"border-bottom: 1px solid #999;border-left: 1px solid #999;padding:5px;\">Drawing</td>
    <td style=\"border-bottom: 1px solid #999;border-right: 1px solid #999;border-left: 1px solid #999;padding:5px;\">" . $_POST['checkfile'] . "</td>
  </tr>
  <tr>
    <td style=\"border-bottom: 1px solid #999;border-left: 1px solid #999;padding:5px;\">Note: </td>
    <td style=\"border-bottom: 1px solid #999;border-right: 1px solid #999;border-left: 1px solid #999;padding:5px;\">" . $_POST['notestxt'] . "</td>
  </tr>
</table>";

    $headers = "From:" . $from. "\r\n";
  $headers .= "MIME-Version: 1.0\r\n";
  $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
   // $headers2 = "From:" . $to. "\r\n";
  //$headers2 .= "MIME-Version: 1.0\r\n";
  //$headers2 .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
  return $mail_result = mail($to,$subject,$message,$headers);
}

//if(isset($_POST['cancel']))
//{	
//	header('Location:'.JURI::base().'client-listing-vic');			
//}
//error_log("  _REQUEST: ".print_r($_REQUEST,true), 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_sa\\my-error.log');
$is_edit = 0;
if(isset($_REQUEST['pid']) && $_REQUEST['pid']>0)
{ 
   
  $is_edit = 1;
  $pid = mysql_real_escape_string($_REQUEST['pid']);

  //if(substr($client_id, 0,3)=="CRV"){


  $sql = "SELECT *, DATE_FORMAT(datelodged,'".SQL_DFORMAT."') fdatelodged, DATE_FORMAT(appointmentdate,'".SQL_DFORMAT." @ %h:%i %p') fappointmentdate  FROM ver_chronoforms_data_clientpersonal_vic WHERE pid={$pid} ";
    
  $client = mysql_fetch_assoc(mysql_query($sql));
  $is_builder = $client['is_builder'];
// Check if builder contact is not empty and populate the lastname and firstname using the splitted value of the builder contact, would be better to automatically notify a popup msg for the user the save and apply the changes
  if($client['builder_contact']!=null && $client['builder_contact_firstname']==null && $client['builder_contact_lastname']==null){
    $name = $client['builder_contact'];
    $name = explode(' ', $name);     
    $client['builder_contact_firstname'] = $name[0];
    $client['builder_contact_lastname'] = (isset($name[count($name)-1])) ? $name[count($name)-1] : '';
  }
  if($client == null){ 
    echo "Can't find client.";
    return;
  }

  //$pid=$client['pid'];
  //print_r($client);  
}

$user =& JFactory::getUser();
 

?>

<?php 

  $form->data['date_entered'] = date(PHP_DFORMAT);
  $form->data['date_time'] = date(PHP_DFORMAT.' g:i A');
 
 
?>

<script src="<?php echo JURI::base().'jscript/jsapi.js'; ?>"></script>
<script src="<?php echo JURI::base().'jscript/jquery.min.js'; ?>"></script> 
<script src="<?php echo JURI::base().'jscript/labels.js'; ?>"></script>
<script type="text/javascript" src="<?php echo JURI::base().'jscript/tabcontent.js'; ?>"></script>
<script charset="UTF-8" type="text/javascript" src="<?php echo JURI::base().'jscript/datetime/js/jquery-1.8.3.min.js'; ?>"></script>
<script charset="UTF-8" type="text/javascript" src='<?php echo JURI::base();?>jscript/client-folder.js'></script>

<script type="text/javascript" src="<?php echo JURI::base().'jscript/datetime/js/bootstrap.min.js'; ?>"></script>
<script charset="UTF-8" type="text/javascript" src="<?php echo JURI::base().'jscript/datetime/js/bootstrap-datetimepicker.js'; ?>"></script>
<script src="<?php echo JURI::base().'jscript/jquery-ui.min.js'; ?>" type="text/javascript"></script>

<link rel="stylesheet" type="text/css" media="screen,projection" href="<?php echo JURI::base().'jscript/jquery-ui-1.11.4/jquery-ui.min.css'; ?>" /> 
<link rel="stylesheet" type="text/css" media="screen,projection" href="<?php echo JURI::base().'jscript/custom.css'; ?>" />
<link rel="stylesheet" type="text/css" media="screen,projection" href="<?php echo JURI::base().'jscript/new-enquiry.css'; ?>" />
<link rel="stylesheet" type="text/css" media="screen,projection" href="<?php echo JURI::base().'jscript/datetime/css/bootstrap.min.css'; ?>" />
<link rel="stylesheet" type="text/css" media="screen,projection" href="<?php echo JURI::base().'jscript/datetime/css/bootstrap-datetimepicker.min.css'; ?>" />

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

<!--- Copy Site Address Script -->
<script language="javascript">
//<![CDATA[
$(window).load(function(){
	

$('#sbtn').click(function(){
$('#ssuburb_id').val($('#csuburb_id').val());
$('#stitle').val($('#ctitle').val());
$('#stitlespan').css("visibility", "hidden");
$('#sfirstname').val($('#firstname').val());
$('#sfirstnamespan').css("visibility", "hidden");
$('#slastname').val($('#lastname').val());
$('#slastnamespan').css("visibility", "hidden");
$('#ssitename').val($('#sitename').val());
$('#ssitenamespan').css("visibility", "hidden");
$('#sstreetno').val($('#cstreetno').val());
$('#sstreetnospan').css("visibility", "hidden");
$('#sstreetname').val($('#cstreetname').val());
$('#sstreetnamespan').css("visibility", "hidden");
$('#saddress1').val($('#caddress1').val());
$('#saddress1span').css("visibility", "hidden");
$('#saddress2').val($('#caddress2').val());
$('#saddress2span').css("visibility", "hidden");
$('#ssuburblist').val($('#csuburblist').val());
$('#ssuburblistspan').css("visibility", "hidden");
$('#ssuburb').val($('#csuburb').val());
$('#ssuburbstate').val($('#csuburbstate').val());
$('#sstatespan').css("visibility", "hidden");
$('#ssuburbpostcode').val($('#csuburbpostcode').val());
$('#spostspan').css("visibility", "hidden");
$('#swkphone').val($('#cwkphone').val());
$('#swkphonespan').css("visibility", "hidden");
$('#shmphone').val($('#chmphone').val());
$('#shmphonespan').css("visibility", "hidden");
$('#smobile').val($('#cmobile').val());
$('#smobilespan').css("visibility", "hidden");
$('#sother').val($('#cother').val());
$('#sotherspan').css("visibility", "hidden");
$('#semail').val($('#cemail').val());
$('#semailspan').css("visibility", "hidden");
});

$('#csuburb').change(function(){
  if($(this).val() == ''){ // or this.value == 'blank'
    $('#client input#csuburbstate').val($('#blank').val());
	$('#client input#csuburbpostcode').val($('#blank').val());
  }
});


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
<script src="<?php echo JURI::base().'jscript/jquery-ui.min.js'; ?>" type="text/javascript"></script>


<style>
    .ui-autocomplete {
        max-height: 200px;
        overflow-y: auto;
        overflow-x: hidden;
        padding-right: 20px;
    }
</style>
<script type="text/javascript">
    $(document).ready(function() {
        var client_config = {
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
                $("#csuburb").val(ui.item.suburb);
                $("#csuburbstate").val(ui.item.suburb_state);
                $("#csuburbpostcode").val(ui.item.suburb_postcode);
                $("#csuburb_id").val(ui.item.cf_id);
            },
            minLength:2
        };
        $("#csuburb").autocomplete(client_config);

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

        $("#csuburbstate").keypress(function() {
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
            $("#csuburb").css({"border-color": "red"});
            $("#csuburb").on("change", function() {
                $(this).css({"border-color": "#97989a"});
            });
            $("#csuburb").text(""); 
            $("#csuburb").focus(); 
        });

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





        <?php if ($is_edit==0) { ?>
        var builder_name = {
            source: function(request, response) {
                $.ajax({
                    url: "includes/vic/query_builder.php", 
                    dataType: "json", 
                    cache: false, 
                    type: "get", 
                    data: {term: request.term}
                }).done(function(data) {
                    response(data);
                });
            }, 
            select: function(event, ui) {    
                $("#builder_name").val(ui.item.builder_name);
                $("#builder_contact").val(ui.item.builder_contact);
                $("#btitle.title").val(ui.item.btitle);
                $("#contact_firstname").val(ui.item.contact_firstname);
                $("#contact_lastname").val(ui.item.contact_lastname);

                $("#cstreetno").val(ui.item.streetno);
                $("#cstreetname").val(ui.item.streetname);

                $("#caddress1").val(ui.item.address1); 
                $("#caddress2").val(ui.item.address2); 
                $("#csuburb").val(ui.item.suburb);
                $("#csuburbstate").val(ui.item.state);
                $("#csuburbpostcode").val(ui.item.postcode);
                $("#cwkphone").val(ui.item.workphone);
                $("#chmphone").val(ui.item.homephone);
                $("#cmobile").val(ui.item.mobilephone);
                $("#cother").val(ui.item.other);
                $("#cemail").val(ui.item.email);
                
                $("#builder_contact").parent().children('span').hide(); 
                $("#btitle.title").parent().children('span').hide(); 
                $("#contact_firstname").parent().children('span').hide(); 
                $("#contact_lastname").parent().children('span').hide(); 

                $("#cstreetno").parent().children('span').hide(); 
                $("#cstreetname").parent().children('span').hide();                 
                $("#caddress1").parent().children('span').hide(); 
                $("#caddress2").parent().children('span').hide(); 
                $("#csuburb").parent().children('span').hide(); 
                $("#csuburbstate").parent().children('span').hide(); 
                $("#csuburbpostcode").parent().children('span').hide(); 
                $("#cwkphone").parent().children('span').hide();     
                $("#chmphone").parent().children('span').hide(); 
                $("#cmobile").parent().children('span').hide(); 
                $("#cother").parent().children('span').hide(); 
                $("#cemail").parent().children('span').hide(); 
            },
            minLength:2
        }; 
        $("#builder_name").autocomplete(builder_name);
        <?php } ?>
    });
</script>


<script type="text/javascript">
  $(document).ready(function(){
    /*
    <?php if($is_edit==0){ ?>
    var builder_name = {
    source: "includes/vic/query_builder.php",
    select: function(event, ui){    
      //$("div.client-builder-tab label span").hide();
      //$("div.siteadd-tab label span").hide();
      
      $("#builder_name").val(ui.item.builder_name);
      $("#caddress1").val(ui.item.address1); 
      $("#caddress2").val(ui.item.address2); 
      $("#csuburb").val(ui.item.suburb);
      $("#csuburbstate").val(ui.item.state);
      $("#csuburbpostcode").val(ui.item.postcode);
      $("#cwkphone").val(ui.item.workphone);

      $("#caddress1").parent().children('span').hide(); 
      $("#caddress2").parent().children('span').hide(); 
      $("#csuburb").parent().children('span').hide(); 
      $("#csuburbstate").parent().children('span').hide(); 
      $("#csuburbpostcode").parent().children('span').hide(); 
      $("#cwkphone").parent().children('span').hide();     

      //$("#builder_contact").val(ui.item.builder_contact); 
      // $("#ccaddress1").val(ui.item.client_address1); 
      // $("#ccaddress2").val(ui.item.client_address2); 

      // $("#csuburb").val(ui.item.client_suburb);
      // $("#csuburbstate").val(ui.item.client_state);
      // $("#csuburbpostcode").val(ui.item.client_postcode);
      

      // $("#chmphone").val(ui.item.client_hmphone);
      // $("#cwkphone").val(ui.item.client_wkphone);
      // $("#cmobile").val(ui.item.client_mobile); 
      // $("#cother").val(ui.item.client_other); 
      // $("#cemail").val(ui.item.client_email);   

      //$("div.info-tab input, div.info-tab select").prop('disabled', true);
      //$("div.drawing-tab input").prop('disabled', true);
      //$("div.notes-tab input, div.notes-tab textarea").prop('disabled', true);
      //alert("here5");
    
    },
    minLength:2
    }; 

    $("#builder_name").autocomplete(builder_name);
    
    <?php } ?>
    */




   
    /*
    var client_config = {
    source: "includes/vic/suburb_vic.php",
    select: function(event, ui){ 
        $("#csuburb").val(ui.item.suburb);
        $("#csuburbstate").val(ui.item.suburb_state);
        $("#csuburbpostcode").val(ui.item.suburb_postcode);
        $("#csuburb_id").val(ui.item.cf_id);  
    },
    minLength:1
    };

    $("#csuburb").autocomplete(client_config);

    
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


    $("#csuburbstate").keypress(function(){
         $("#notification").html("Please choose a suburb in the autocomplete box.");   
          //$("#notification").appendTo("."+dataClass+" .notification-area");
          $("#notification").removeClass('hide');  
          $("#notification").show(); 
          setTimeout(function() {
                $( "#notification" ).hide( "slow" );
          }, 7000);

          
          $("#csuburb").css({ "border-color": "red"});
          $("#csuburb").one("change",function(){ $(this).css({ "border-color": "#97989a"}); });
          $("#csuburb").text(""); 
          $("#csuburb").focus(); 
    });

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
    */
  });
</script>
 
<script>
function csuburbchange(){
  document.getElementById('cstateid').style.visibility = 'hidden';
	document.getElementById('cpostid').style.visibility = 'hidden';
}
function ssuburbchange(){
  document.getElementById('sstatespan').style.visibility = 'hidden';
	document.getElementById('spostspan').style.visibility = 'hidden';
}
function nsuburbchange(){
  document.getElementById('nstatespan').style.visibility = 'hidden';
  document.getElementById('npostspan').style.visibility = 'hidden';
}
</script>

<div id="notification" class="notification_box hide"  ></div>

<form method="post" action="<?php echo JURI::base().'new-client-enquiry-vic/'; ?>" class="Chronoform hasValidation" id="chronoform_New_Client_Enquiry_Vic" enctype="multipart/form-data">
<?php
  if(strlen($notification)>0)
  { 
    echo set_notification($notification);     
  }

function set_notification($msg){
  return "<div class='notification_result'>{$msg}</div>";
} 
?>   
  <input type="hidden" value="" id="blank" name="blank" />
  <input type="hidden" value="<?php if($is_edit){echo $client['pid'];} ?>" id="" name="pid" />
  <input type='hidden' name='user_group' id='user_group' value="<?php echo $user_group; ?>" / >
  <input type='hidden' name='is_builder'  value="<?php echo $is_builder; ?>" / >

  <div class="column-left"></div>
  <div class="column-right"></div>
  <div id="tabs_wrapper" class="client-builder-tab">
    <div id="tabs_container">
      <ul id="tabs_default">
        <li class="active"><span><?php echo ($is_builder==0?"Client":"Builder"); ?></span></li>
      </ul>
    </div>
    <div id="tabs_content_container"> 
      
      <!-- Client Tab -->
      <div id="client" class="tab_content" style="display: block;">
        <input type="hidden" value="<?php echo $client['clientid'] ?>" name="clientid" id="clientid"> 
        <?php if($is_builder==0){ ?>
           <input type="hidden" value="<?php echo $is_builder; ?>" name="is_builder">
        <label class="input"> <span><?php if($is_edit==0) echo "Title"; ?></span>
          <select class="title" id='ctitle' name='ctitle'>
            <option ></option>
            <option value="Mr" <?php echo ($client['client_title']=="Mr"?"selected":""); ?> >Mr</option>
            <option value="Mrs" <?php echo ($client['client_title']=="Mrs"?"selected":""); ?> >Mrs</option>
            <option value="Ms" <?php echo ($client['client_title']=="Ms"?"selected":""); ?>>Ms</option>
            <option value="Dr" <?php echo ($client['client_title']=="Dr"?"selected":""); ?>>Dr</option>
            <option value="Prof." <?php echo ($client['client_title']=="Prof."?"selected":""); ?>>Prof.</option>
          </select>
        </label>  
        <label class="input"><span>First Name</span>
          <input type="text" value="<?php echo $client['client_firstname'] ?>" id="firstname" name="firstname" >
        </label>
        <label class="input"><span>Last Name</span>
          <input type="text" value="<?php echo $client['client_lastname'] ?>" id="lastname" name="lastname">
        </label>
        <?php }else{ ?>
           <input type="hidden" value="<?php echo $is_builder; ?>" name="is_builder">
          <label class="input" style="width:95%"><span>Builder Name</span>
            <input type="text" value="<?php echo $client['builder_name'] ?>" id="builder_name" name="builder_name" <?php if($is_edit==0){ ?> style="width:75%;" <?php } ?>>
            <?php if($is_edit==0){ ?>
              <input type="button" value="New" name="" class="btn"  style="width:75px;" onclick="open_create_builder_dialog()">
            <?php } ?>
          </label>
          <!--           <label type="hidden" class="input"><span>Builder Contact</span>
            <input type="hidden" value="<?php echo $client['builder_contact'] ?>" id="builder_contact" name="builder_contact">
          </label>  -->

                    <label class="input"> <span><?php if($is_edit==0) echo "Title"; ?></span>
                      <select class="title" id='btitle' name='btitle'>
                        <option ></option>
                        <option value="Mr" <?php echo ($client['builder_contact_title']=="Mr"?"selected":""); ?> >Mr</option>
                        <option value="Mrs" <?php echo ($client['builder_contact_title']=="Mrs"?"selected":""); ?> >Mrs</option>
                        <option value="Ms" <?php echo ($client['builder_contact_title']=="Ms"?"selected":""); ?>>Ms</option>
                        <option value="Dr" <?php echo ($client['builder_contact_title']=="Dr"?"selected":""); ?>>Dr</option>
                        <option value="Prof." <?php echo ($client['builder_contact_title']=="Prof."?"selected":""); ?>>Prof.</option>
                      </select>
                    </label>  
                    <label class="input"><span>First Name</span>
                      <input type="text" value="<?php echo $client['builder_contact_firstname'] ?>" id="contact_firstname" name="contact_firstname" >
                    </label>
                    <label class="input"><span>Last Name</span>
                      <input type="text" value="<?php echo $client['builder_contact_lastname'] ?>" id="contact_lastname" name="contact_lastname">
                    </label>

        <?php } ?>  
        <label class="input"><span>Unit / Street No</span>
          <input type="text" value="<?php echo $client['client_streetno'] ?>" id="cstreetno" name="cstreetno">
        </label>
        <label class="input"><span>Street Name</span>
          <input type="text" value="<?php echo $client['client_streetname'] ?>" id="cstreetname" name="cstreetname">
        </label>       
        <label class="input"><span hidden="true">Address 1</span>
          <input type="text" value="<?php echo $client['client_address1'] ?>" id="caddress1" name="caddress1">
        </label>
        <label class="input"><span hidden="true">Address 2</span>
          <input type="text" value="<?php echo $client['client_address2'] ?>" id="caddress2" name="caddress2">
        </label>
        
        <!--- Client Suburb -->
        <label class="input"><span>Suburb</span>
          <input type="text" id="csuburb" name="client_suburb" value="<?php echo $client['client_suburb'] ?>"  onkeypress="csuburbchange();" />
        </label>
        <input type="hidden" id="csuburb_id" name="csuburbid" value="<?php echo $client['client_suburbid'] ?>" readonly />
        <label class="input"><span id="cstateid">State</span>
          <input type="text" id="csuburbstate" name="client_state" value="<?php echo $client['client_state'] ?>" readonly />
        </label>
        <label class="input"><span id="cpostid"><?php echo (METRIC_SYSTEM=="inch"?"Zipcode":"Postcode"); ?></span>
          <input type="text" id="csuburbpostcode" name="client_postcode" value="<?php echo $client['client_postcode'] ?>" readonly />
        </label>
        <!-- End of Client Suburb -->
        <label class="input"><span>Home Phone</span>
          <input type="text" value="<?php echo $client['client_hmphone'] ?>" id="chmphone" name="chmphone">
        </label>
        <label class="input"><span>Work Phone</span>
          <input type="text" value="<?php echo $client['client_wkphone'] ?>" id="cwkphone" name="cwkphone">
        </label>
        <label class="input"><span>Mobile</span>
          <input type="text" value="<?php echo $client['client_mobile'] ?>" id="cmobile" name="cmobile">
        </label>
        <label class="input"><span>Other</span>
          <input type="text" value="<?php echo $client['client_other'] ?>" id="cother" name="cother">
        </label>
        <label class="input"><span>Email</span>
          <input type="text" value="<?php echo $client['client_email'] ?>" id="cemail" name="cemail">
        </label>
      </div>
    </div>
  </div>
  
  <!----------------------------------------------------- Site Address Tab -->
  <div id="tabs_wrapper" class="siteadd-tab">
    <div id="tabs_container">
      <ul id="tabs_default">
        <li class="active"><span>Site Address</span></li>
      </ul>
    </div>
    <div id="tabs_content_container">
      <div id="site-address" class="tab_content_default" style="display: block;">
        <?php if($is_builder==0){ ?>
        <label class="input"> <span id='stitlespan'><?php if($is_edit==0) echo "Title"; ?></span>
          <select class="title" id='stitle' name='stitle'>
            <option ></option>
            <option value="Mr" <?php echo ($client['site_title']=="Mr"?"selected":""); ?> >Mr</option>
            <option value="Mrs" <?php echo ($client['site_title']=="Mrs"?"selected":""); ?> >Mrs</option>
            <option value="Ms" <?php echo ($client['site_title']=="Ms"?"selected":""); ?>>Ms</option>
            <option value="Dr" <?php echo ($client['site_title']=="Dr"?"selected":""); ?>>Dr</option>
            <option value="Prof." <?php echo ($client['site_title']=="Prof."?"selected":""); ?>>Prof.</option>
          </select>
        </label>
        <label class="input"><span id="sfirstnamespan">First Name</span>
          <input type="text" value="<?php echo $client['site_firstname'] ?>" id="sfirstname" name="sfirstname">
        </label>
        <label class="input"><span id="slastnamespan">Last Name</span>
          <input type="text" value="<?php echo $client['site_lastname'] ?>" id="slastname" name="slastname">
        </label>       
        
        <?php }else{ ?>
          <label class="input"><span id="ssitenamespan">Site Name</span>
            <input type="text" value="<?php echo $client['site_sitename'] ?>" id="ssitename" name="ssitename">
          </label>        
          
          <!-- <label class="input"><span id="sbuilder_name_span">Builder Name</span>
            <input type="text" value="<?php echo $client['builder_name'] ?>" id="sbuilder_name" name="sbuilder_name" >
          </label>
          <label class="input"><span id="sbuilder_contact_span">Builder Contact</span>
            <input type="text" value="<?php echo $client['builder_contact'] ?>" id="sbuilder_contact" name="sbuilder_contact">
          </label> -->


        <?php } ?>   		    
        <label class="input"><span id="sstreetnospan">Unit / Street No</span>
          <input type="text" value="<?php echo $client['site_streetno'] ?>" id="sstreetno" name="sstreetno">
        </label>
        <label class="input"><span id="sstreetnamespan">Street Name</span>
          <input type="text" value="<?php echo $client['site_streetname'] ?>" id="sstreetname" name="sstreetname">
        </label>
        <label class="input"><span id="saddress1span"  hidden="true">Address 1</span>
          <input type="text" value="<?php echo $client['site_address1'] ?>" id="saddress1" name="saddress1">
        </label>
        <label class="input"><span id="saddress2span"  hidden="true">Address 2</span>
          <input type="text" value="<?php echo $client['site_address2'] ?>" id="saddress2" name="saddress2">
        </label>
        
        <!--- Site Suburb -->
        <label class="input"><span id="ssuburblistspan">Suburb</span>
          <input type="text" id="ssuburb" name='site_suburb' value="<?php echo $client['site_suburb'] ?>" onkeypress="ssuburbchange();" />
        </label>
        <input type="hidden" id="ssuburb_id" name='ssuburbid' value="<?php echo $client['site_suburbid'] ?>" readonly />
        <label class="input"><span id="sstatespan">State</span>
          <input type="text" id="ssuburbstate" name="site_state" value="<?php echo $client['site_state'] ?>" readonly />
        </label>
        <label class="input"><span id="spostspan">Postcode</span>

          <input type="text" id="ssuburbpostcode" name="site_postcode" value="<?php echo $client['site_postcode'] ?>" readonly />
        </label>
        <!-- End of Site Suburb -->
        <label class="input"><span id="shmphonespan">Home Phone</span>
          <input type="text" value="<?php echo $client['site_hmphone'] ?>" id="shmphone" name="shmphone">
        </label>
        <label class="input"><span id="swkphonespan">Work Phone</span>
          <input type="text" value="<?php echo $client['site_wkphone'] ?>" id="swkphone" name="swkphone">
        </label>
        <label class="input"><span id="smobilespan">Mobile</span>
          <input type="text" value="<?php echo $client['site_mobile'] ?>" id="smobile" name="smobile">
        </label>
        <label class="input"><span id="sotherspan">Other</span>
          <input type="text" value="<?php echo $client['site_other'] ?>" id="sother" name="sother">
        </label>
        <label class="input"><span id="semailspan">Email</span>
          <input type="text" value="<?php echo $client['site_email'] ?>" id="semail" name="semail">
        </label>
        
        <?php if($is_builder==0){ ?>   <input type="button" value="Copy Site Address" id="sbtn" name="sbtn" class="btn">  <?php } ?>

        <?php if(false){ ?><input type="submit" value="Save Site Address" id="sbtn_save_saddress" name="save_site_address" class="btn" style="width: 395px; margin:2px 0px 5px 2px; padding: 4px;"> <?php } ?>
      </div>
    </div>
  </div>
  
  <!------------------------------------------------------------- Enquiry Tracker Tab  -->
  <div id="tabs_wrapper" class="info-tab">
    <div id="tabs_container">
      <ul id="tabs_default">
        <li class="active"><span>Enquiry Tracker</span></li>
      </ul>
    </div>
    <div id="tabs_content_container">
      <div id="tracker" class="tab_content_default" style="display: block;">
        <label class="input"><span id="date-entered">Date Entered:</span>
          <input type="text" id="idate" name="idate" class="date_entered" value="<?php  if($is_edit==1){echo $client['fdatelodged'];  } else{echo date(PHP_DFORMAT); } ?>">
        </label> 
        <input type="submit" value="Send Mail" id="ibtn" name="<?php echo ($is_edit==1?"send_and_update":"save"); ?>" class="btn btn-add">
        <!--- Sales Rep -->
        <?php
	  $queryrep="SELECT id, name, RepID, email FROM ver_users ORDER BY name ASC ";
      $resultrep = mysql_query($queryrep);
      if(!$resultrep){die ("Could not query the database: <br />" . mysql_error());}

	 


    if($is_edit){
      $RepID = $client['repident']; 
      // $RepIDArrayPhp = 'RepIDArray["'.$client['repid'].'"];';
      // $RepNameArrayPhp = 'RepNameArray["'.$client['repname'].'"];';
      // $RepIdentArrayPhp = 'RepIdentArray["'.$client['repident'].'"];';
      // $RepEmailArrayPhp = 'RepEmailArray["'.$client['repemail'].'"];';
      $RepIDArrayPhp = 'RepIDArray[""]="";';
      $RepNameArrayPhp = 'RepNameArray[""]="";';
      $RepIdentArrayPhp = 'RepIdentArray[""]="";';
      $RepEmailArrayPhp = 'RepEmailArray[""]="";';
      while($row = mysql_fetch_row($resultrep))
      {
        $heading = $row[0]; 
        $RepIDArrayPhp .= 'RepIDArray["'.$heading.'"]="'.$row[0].'";';
        $RepNameArrayPhp .= 'RepNameArray["'.$heading.'"]="'.$row[1].'";';
        $RepIdentArrayPhp .= 'RepIdentArray["'.$heading.'"]="'.$row[2].'";';
        $RepEmailArrayPhp .= 'RepEmailArray["'.$heading.'"]="'.$row[3].'";';
      }

    }else{
     
      $RepIDArrayPhp = 'RepIDArray[""]="";';
      $RepNameArrayPhp = 'RepNameArray[""]="";';
      $RepIdentArrayPhp = 'RepIdentArray[""]="";';
      $RepEmailArrayPhp = 'RepEmailArray[""]="";';
      $RepID = $user->RepID;  

      while($row = mysql_fetch_row($resultrep))
      {
        $heading = $row[0]; 
        $RepIDArrayPhp .= 'RepIDArray["'.$heading.'"]="'.$row[0].'";';
        $RepNameArrayPhp .= 'RepNameArray["'.$heading.'"]="'.$row[1].'";';
        $RepIdentArrayPhp .= 'RepIdentArray["'.$heading.'"]="'.$row[2].'";';
        $RepEmailArrayPhp .= 'RepEmailArray["'.$heading.'"]="'.$row[3].'";';
      }

    } 
    //error_log("user: ".print_r($user,true), 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_sa\\my-error.log');
    //error_log("fdatelodged: ".$client['fdatelodged'], 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_sa\\my-error.log');
      //create selection list				
	   

?>
    <input type="hidden" id="rep_id" value="<?php echo $RepID; ?>" />
    <label class='' style="color:#222; display: inline-table;"><span><?php if($is_edit==0){echo 'Last Rep Allocated: ';} ?></span>  
        <?php
          //echo "<select class='last-rep' id=' ' name='lastRepId' ><option></option>";
          // $querysub3="SELECT u.RepID, u.name FROM ver_chronoforms_data_clientpersonal_vic AS c JOIN ver_users AS u ON u.RepID=c.repident WHERE c.repident != '' GROUP BY c.repident ORDER BY c.pid DESC LIMIT 10";
         $querysub3="SELECT * FROM (SELECT * FROM (SELECT  distinct repident, pid, repid, repname, employeeid, leadid, datelodged FROM ver_chronoforms_data_clientpersonal_vic WHERE repident != '' group by repident, pid order by pid desc) AS t group by repident order by pid desc) as c JOIN ver_users AS u ON u.RepID=c.repident ORDER BY pid DESC";
          $resultsub3 = mysql_query($querysub3);
          if(!$resultsub3){die ("Could not query the database: <br />" . mysql_error());  }
          $i=0;
          while ($data=mysql_fetch_assoc($resultsub3)){ 
                  //echo "<option value = '{$data['RepID']}' ".($client['lastRepId']==$data['RepID']?'selected':'')." >{$data['name']}</option>";  
                  if($i==0){
                    echo "<span style='font-style: italic; color:#535454; '>{$data['name']}</span>";   
                  }
                  else{  
                    echo "<span style='font-style: italic; color:#535454; '>, {$data['name']}</span>";   
                  }  
                  $i++;
              } 
     
          //echo "</select>";

        ?>

      </label><br/>

<?php

	  	    echo "<label class='input'> <select class='rep-list' id='replist' name='replist' onchange='javascript:SelectChangedRep();'><option value=''>Select Sales Rep</option>";
            $usergroup = 'Victoria Users';

            //$user =& JFactory::getUser(); //$userName = $user->get( 'name' ); 
            if(isset($user->groups['27'])){ //27 is victoria sales manager
              $sql="SELECT id, name, RepID  FROM ver_users WHERE id IN (SELECT user_id FROM ver_user_usergroup_map WHERE group_id=27 || group_id=9 ) ORDER BY name ASC";
            }else if(isset($user->groups['9'])){ //27 is victoria sales manager
              $sql="SELECT id, name, RepID FROM ver_users WHERE id IN (SELECT user_id FROM ver_user_usergroup_map WHERE  group_id=9 ) ORDER BY name ASC";
            }else{
              $sql="SELECT id, name, RepID FROM ver_users WHERE usertype LIKE ('$usergroup') ORDER BY name ASC";
            }
 
            $result = mysql_query($sql);
            if(!$result){ die ("Could not query the database: <br />" . mysql_error());   }
			

			  while ($data=mysql_fetch_assoc($result)){
                 // error_log("rep id: ".$data['RepID'], 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_sa\\my-error.log');
                  echo "<option value = '{$data['id']}'";
                       if ($RepID == $data['RepID']) {
                            echo "selected = 'selected'";
					    }

                        echo ">{$data['name']}</option>";
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
    //alert(RepNameArray[Rep]);
		document.getElementById('repname').value = RepNameArray[Rep];
		document.getElementById('repident').value = RepIdentArray[Rep];
		document.getElementById('repid').value = RepIDArray[Rep];
		document.getElementById('repemail').value = RepEmailArray[Rep];

	}
</script>
      
      <?php 
        if($is_edit){ 
      ?>
        <input type="hidden" id="repname" name='repname' value="<?php echo $client['repname']; ?>"  />
        <input type="hidden" id="repident" name='repident' value="<?php echo $client['repident']; ?>"  />
        <input type="hidden" id="repid" name='repid' value="<?php echo $client['repid'] ?>"  />
        <input type="hidden" id="repemail" name='repemail' value="<?php echo $client['repemail']; ?>"  />

      <?php }else{ ?>  

        <input type="hidden" id="repname" name='repname' value="<?php echo $user->name; ?>" readonly />
        <input type="hidden" id="repident" name='repident' value="<?php echo $user->RepID; ?>" readonly />
        <input type="hidden" id="repid" name='repid' value="<?php echo $user->id ?>" readonly />
        <input type="hidden" id="repemail" name='repemail' value="<?php echo $user->email; ?>" readonly /> 

      <?php } ?>  
        <!-- End of Sales Rep --> 
        
        <!--- Lead Type -->
        <?php
      $querylead="SELECT cf_id, lead FROM ver_chronoforms_data_lead_vic ORDER BY lead ASC";
      $resultlead = mysql_query($querylead);
      if(!$resultlead){die ("Could not query the database: <br />" . mysql_error());}
	  $LeadIDArrayPhp = 'LeadIDArray[""]="";'; //default value
    $LeadNameArrayPhp = 'LeadNameArray[""]="";'; //default value
	  $LeadID = '';
    $leadname = '';
    if($is_edit){
      $LeadID = $client['leadid'];
      $leadname = $client['leadname'];
    }
    echo "<input type='hidden' id='is_edit' value='{$is_edit}' />";
    echo "<input type='hidden' id='lead_id' value='{$LeadID}' />";
      //create selection list				
	   while($row = mysql_fetch_row($resultlead))
	{
		$heading = $row[0];	
		$LeadIDArrayPhp .= 'LeadIDArray["'.$heading.'"]="'.$row[0].'";';
		$LeadNameArrayPhp .= 'LeadNameArray["'.$heading.'"]="'.$row[1].'";';

	}
			




	  	    echo "<label class='input'><span></span><select class='lead-list' id='leadlist' name='leadlist' onchange='javascript:SelectChangedLead();'><option value=''>Select Lead Source</option>";
            $querysub2="SELECT cf_id, lead FROM ver_chronoforms_data_lead_vic ORDER BY lead ASC";
            $resultsub2 = mysql_query($querysub2);
            if(!$resultsub2){die ("Could not query the database: <br />" . mysql_error());
			}
			


			  while ($data=mysql_fetch_assoc($resultsub2)){
                  echo "<option value = '{$data['cf_id']}'";
                       if ($leadname == $data['lead']) {
                            echo "selected = 'selected'";
					    }

                        echo ">{$data['lead']}</option>";
		        }

 
echo "</select></label>";
?>
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
</script>
        
        
        <!-- End of Lead Type -->
        
       
        <?php if($is_edit==1){
                $userName = $client['employeeid'];

        ?>
            <input type="hidden" id="leadname" name='leadname' value="<?php echo $client['leadname']; ?>" readonly />
            <input type="hidden" id="leadid" name='leadid' value="<?php echo $client['leadid']; ?>" readonly /> 

        <?php 
              }else{
                $user =& JFactory::getUser(); 
                $userName = $user->get( 'name' );
         ?>
              <input type="hidden" id="leadname" name='leadname' value="" readonly />
              <input type="hidden" id="leadid" name='leadid' value="" readonly />

         <?php   } ?> 

 
      <?php
       $usermail =& JFactory::getUser(); $userEmail = $usermail->get( 'email' );
       echo '<input type=\'hidden\' id=\'usermail\' name=\'usermail\' value=\''.$userEmail.'\' readonly>';?>
        <div class="input-group date form_datetime col-md-5" data-date-format="<?php echo JS_DFORMAT." @ HH:ii P"; ?>" data-link-field="dtp_appointment" style="display:inline-block">
          <label class='input'><span id='date-entered'>Appointment: </span>
            <input type="text" id="iappointment" name="iappointment" class="form-control" value="<?php echo $client['fappointmentdate'] ?>" readonly>
          </label>
          <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span> <span class="input-group-addon"><span class="glyphicon glyphicon-th"></span></span> </div>
        <input type="hidden" id="dtp_appointment" name="dtp_appointment" value="<?php echo $client['appointmentdate'] ?>" />
        <br/>

       <?php
            echo '<label class=\'input\'><span id=\'takenid\'>Taken by:</span><input type=\'text\' id=\'username\' name=\'username\' class=\'username\' value=\''.$userName.'\' readonly></label>'; 

       ?> 

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


<?php if($is_edit==0){  ?>  
  <!-- Drawing Image Tab -->
  <div id="tabs_wrapper" class="drawing-tab" style="width: 28%;">
    <div id="tabs_container">
      <ul id="tabs_default">
        <li class="active"><span>Drawing</span></li>
      </ul>
    </div>
    <div id="tabs_content_container">
      <div id="draw" class="tab_content_default" style="display: block;">
        <!--<INPUT type="button" value="Add Drawing" onclick="addRow('tbl-draw')" /> -->
        <INPUT type="button" value="Delete Drawing" onclick="deleteRow('tbl-draw')" class="bbtn btn-delete" />
        <table id="tbl-draw">
          <tr>
            <td class="tbl-chk"><input type="checkbox" name="chk"/></td>
            <td class="tbl-upload"><input type="file" name="photo[]" id="uploadme" multiple="multiple" accept=".jpg,.png,.bmp,.gif,.pdf">
            <input type="hidden" id="checkfile" value="No" name="checkfile" ></td>
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
            <td class="tbl-content"><textarea name="notestxt" id="notestxt"></textarea>
              <div class="layer-date">Date:
                <input type="text" id="date_display" name="date_display" class="datetime_display" value="<?php print(Date(PHP_DFORMAT)); ?>" readonly>
                <input type="hidden" id="date_notes" name="date_notes" class="date_time" value="<?php print(Date(PHP_DFORMAT." H:i:s")); ?>" readonly>
              </div>
              <div class="layer-whom">By Whom:
                <input type="text" id="username_notes" name="username_notes" class="username" value="<?php echo $userName; ?>" readonly>
              </div></td>
          </tr>
        </table>
      </div>
    </div>
  </div>
<?php  } ?>  

  <div id="_tabs_wrapper" class="button-tab">
    <?php if(isset($_REQUEST['ref']) && $_REQUEST['ref']=="home"){ ?>
    <input type="button" value="Cancel" id="" name="cancel" class="bbtn btn" onclick=location.href='<?php echo JURI::base(); ?>' />
    <?php }else if(isset($_REQUEST['ref'])){?> 
      <input type="button" value="Cancel" id="" name="cancel" class="bbtn btn" onclick=location.href='<?php echo JURI::base().$_REQUEST['ref']; ?>' />
    <?php }else{ ?>
      <input type="button" value="Cancel" id="" name="cancel" class="bbtn btn" onclick=location.href='<?php echo (isset($pid) ? JURI::base()."client-listing-vic/client-folder-vic?pid={$pid}" : JURI::base()); ?>' />
    <?php } ?>  
    <input type="submit" value="Save" id="bsbtn" name="<?php echo ($is_edit==0?"save":"update"); ?>" class="bbtn btn-save">
  </div>
</form> 





  
<div id="form_new_builder" title="New Builder" style="display: none;">
    <form id="new_builder_form">
      <div style=" " class="tab-content" >
        <br/>
        <label class="input"><span id="saddress1span">Builder Name</span>
          <input type="text" value="" id="nbuilder_name" name="nbuilder_name">
        </label>
		<label class="input"><span id="sstreetnospan">Unit / Street No</span>
          <input type="text" value="" id="nstreet_no" name="nstreet_no">
        </label>
        <label class="input"><span id="sstreetnamespan">Street Name</span>
          <input type="text" value="" id="nstreet_name" name="nstreet_name">
        </label>        
        <label class="input"><span id="saddress1span" hidden="true">Address 1</span>
          <input type="text" value="" id="naddress1" name="naddress1">
        </label>
        <label class="input"><span id="saddress2span" hidden="true">Address 2</span>
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


  

<script type="text/javascript">

function open_create_builder_dialog(){
    var nsite_config = {
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
            $("#nsuburb").val(ui.item.suburb);
            $("#nsuburbstate").val(ui.item.suburb_state);
            $("#nsuburbpostcode").val(ui.item.suburb_postcode);
        },
        minLength:2
    };
    $("#nsuburb").autocomplete(nsite_config);
    /*
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
    */

    $("#nbuilder_name").val("");
    $("#nstreet_no").val("");
    $("#nstreet_name").val("");
    $("#naddress1").val("");
    $("#naddress2").val("");
    $("#nsuburb").val("");
    $("#nsuburbstate").val("");
    $("#nsuburbpostcode").val("");
     $("#nworkphone").val("");

    $("#form_new_builder").dialog();
} 


function copy_data_from_new_builder(event,o){
 
  //var d = event.target.attributes;
  // console.log(d); 
  // console.log($(event.target).attr('data-class')); 
  // console.log($(o).closes event.preventDefault();
  var action = $(o).closest('form').attr('action');  
  var iData = $(o).closest('form').serialize(); 
  //console.log(iData); 
  //return false;

  $.ajax({
      type: "POST",
      url: action,
      dataType: 'json',   
      data: iData,  
      success: function(data) {     
        if(data.success==true){   

           
              $("#builder_name").val($("#nbuilder_name").val());
              $("#builder_contact").val(ui.item.builder_contact);
              $("#btitle.title").val(ui.item.builder_contact_title);
              $("#contact_firstname").val(ui.item.builder_contact_firstname);
              $("#contact_lastname").val(ui.item.builder_contact_lastname);       
              $("#cstreetno").val($("#nstreet_no").val());
              $("#cstreetname").val($("#nstreet_name").val());
              $("#caddress1").val($("#naddress1").val());
              $("#caddress2").val($("#naddress2").val());
              $("#csuburb").val($("#nsuburb").val());
              $("#csuburbstate").val($("#nsuburbstate").val());
              $("#csuburbpostcode").val($("#nsuburbpostcode").val());
              $("#cwkphone").val($("#nworkphone").val());

               
              $("#builder_name").parent().children('span').hide();
              $("#builder_contact").parent().children('span').hide(); 
              $("#btitle.title").parent().children('span').hide(); 
              $("#contact_firstname").parent().children('span').hide(); 
              $("#contact_lastname").parent().children('span').hide(); 
              $("#cstreetno").parent().children('span').hide();
              $("#cstreetname").parent().children('span').hide();
              $("#caddress1").parent().children('span').hide();
              $("#caddress2").parent().children('span').hide();
              $("#csuburb").parent().children('span').hide();
              $("#csuburbstate").parent().children('span').hide();
              $("#csuburbpostcode").parent().children('span').hide();
              $("#cwkphone").parent().children('span').hide();

          

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
  //console.log(iData); 
  //return false;

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