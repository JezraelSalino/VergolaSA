<script src="<?php echo JURI::base().'jscript/jsapi.js'; ?>"></script>
<script src="<?php echo JURI::base().'jscript/jquery.min.js'; ?>"></script>
<script src="<?php echo JURI::base().'jscript/labels.js'; ?>"></script>
<script type="text/javascript" src="<?php echo JURI::base().'jscript/tabcontent.js'; ?>"></script>

<script charset="UTF-8" type="text/javascript" src="<?php echo JURI::base().'jscript/datetime/js/jquery-1.8.3.min.js'; ?>"></script>
<script type="text/javascript" src="<?php echo JURI::base().'jscript/datetime/js/bootstrap.min.js'; ?>"></script>
<script charset="UTF-8" type="text/javascript" src="<?php echo JURI::base().'jscript/datetime/js/bootstrap-datetimepicker.js'; ?>"></script>

<link rel="stylesheet" type="text/css" media="screen,projection" href="<?php echo JURI::base().'jscript/custom.css'; ?>" />
<link rel="stylesheet" type="text/css" media="screen,projection" href="<?php echo JURI::base().'jscript/new-enquiry.css'; ?>" />

<link rel="stylesheet" type="text/css" media="screen,projection" href="<?php echo JURI::base().'jscript/datetime/css/bootstrap.min.css'; ?>" />
<link rel="stylesheet" type="text/css" media="screen,projection" href="<?php echo JURI::base().'jscript/datetime/css/bootstrap-datetimepicker.min.css'; ?>" />
<?php
date_default_timezone_set('Australia/Victoria');
  

if(isset($_POST['update']))
{ 
    $pid = $_POST['pid'];
    $BuildID = $_POST['builderid'];
    $BuildSuburbID = $_POST['bsuburbid'];
  $BuildName = $_POST['builder_name'];
  $BuildContact = $_POST['builder_contact'];          
  $BuildAddress1 = $_POST['baddress1'];
  $BuildAddress2 = $_POST['baddress2'];
  $BuildSuburb = $_POST['builder_suburb'] ;
  $BuildState = $_POST['builder_state'];          
  $BuildPostcode = $_POST['builder_postcode'];
  $BuildWPhone = $_POST['bwphone'];
  $BuildMobile = $_POST['bmobile'];         
  $BuildFax = $_POST['bfax'];
  $BuildEmail = $_POST['bemail'];
    
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
  $TenderStatus = "No";
    
  $date =  $_POST['idate'];
    $timestamp = date(PHP_DFORMAT.' H:i:s', strtotime($date)); 
    $DateLodged = $timestamp;
  $AppointmentLodged = $_POST['dtp_appointment'];
    $RepID = $_POST['repid'];
  $RepIdent = $_POST['repident'];
  $RepName = $_POST['repname'];
  $RepEmail = $_POST['repemail'];
  
  $LeadID = $_POST['leadid'];
  $LeadName = $_POST['leadname'];
  
  $EmployeeID = $_POST['username'];
  $lastRepId = $_POST['lastRepId'];

        
  $sql = "UPDATE ver_chronoforms_data_builderpersonal_vic SET 
                builder_suburbid = '{$BuildSuburbID}', 
                builder_name = '$BuildName', 
                builder_contact = '$BuildContact', 
                builder_address1 = '$BuildAddress1', 
                builder_address2 = '$BuildAddress2',
                builder_suburb = '$BuildSuburb',
                builder_state = '$BuildState',
                builder_postcode = '$BuildPostcode',
                builder_wkphone = '$BuildWPhone',
                builder_mobile = '$BuildMobile',
                builder_fax = '$BuildFax',
                builder_email = '$BuildEmail', 
                site_suburbid = '$SiteSuburbID',
                site_project = '$SiteProject',
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
                tenderstatus = '$TenderStatus', 
                datelodged = '$DateLodged',
                repid = '$RepID',
                repident = '$RepIdent',
                repname = '$RepName',
                leadid = '$LeadID',
                leadname = '$LeadName',
                appointmentdate = '$AppointmentLodged',
                employeeid = '$EmployeeID',
                lastRepId = '$lastRepId'

                WHERE pid = {$pid}
     
     ";
    //error_log($sql, 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_sa\\my-error.log');  exit();
    mysql_query($sql);
  
  
  header('Location:'.JURI::base().'new-builder-enquiry-vic?pid='.$pid);     


}else if(isset($_POST['sendmail'])){

   $to = $_POST['bemail']; // this is the Sales Rep Email address
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

    // error_log("TO: ".$to. " FROM: ".$from. " Subject: ".$subject. "message: " .$message." header: ".$headers, 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_sa\\my-error.log'); 

  if(isset($_POST['pid'])){
    $pid = $_POST['pid'];
  }else if(isset($_REQUEST['pid'])){
     $pid = $_REQUEST['pid'];
  }else{
    $notification = "Error, Can't find id.";
    echo $notification;
    return;
  }


     header('Location:'.JURI::base().'new-builder-enquiry-vic?pid='.$pid);    
     return; 

}


$next_increment = 0;
$qShowStatus = "SHOW TABLE STATUS LIKE 'ver_chronoforms_data_builderpersonal_vic'";
$qShowStatusResult = mysql_query($qShowStatus) or die ( "Query failed: " . mysql_error() . "<br/>" . $qShowStatus );
$row = mysql_fetch_assoc($qShowStatusResult);
$next_increment = $row['Auto_increment'];
$getclientid = 'BRV'.$next_increment;


if(isset($_POST['save']) || isset($_POST['sendmail']))
{	
    //$ClientID = 'BRV'.$row['Auto_increment'];
    $BuildID = $_POST['builderid'];
    $BuildSuburbID = $_POST['bsuburbid'];
	$BuildName = $_POST['builder_name'];
	$BuildContact = $_POST['builder_contact'];					
	$BuildAddress1 = $_POST['baddress1'];
	$BuildAddress2 = $_POST['baddress2'];
	$BuildSuburb = $_POST['builder_suburb'] ;
	$BuildState = $_POST['builder_state'];					
	$BuildPostcode = $_POST['builder_postcode'];
	$BuildWPhone = $_POST['bwphone'];
	$BuildMobile = $_POST['bmobile'];					
	$BuildFax = $_POST['bfax'];
	$BuildEmail = $_POST['bemail'];
		
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
	$TenderStatus = "No";
    
	$date =  $_POST['idate'];
    $timestamp = date(PHP_DFORMAT.' H:i:s', strtotime($date)); 
    $DateLodged = $timestamp;
	$AppointmentLodged = $_POST['dtp_appointment'];
    $RepID = $_POST['repid'];
	$RepIdent = $_POST['repident'];
	$RepName = $_POST['repname'];
	$RepEmail = $_POST['repemail'];
	
	$LeadID = $_POST['leadid'];
	$LeadName = $_POST['leadname'];
	
	$EmployeeID = $_POST['username'];
  $lastRepId = $_POST['lastRepId'];

  			
	mysql_query("INSERT INTO ver_chronoforms_data_builderpersonal_vic
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
                              
                              datelodged,
                              repid,
							  repident,
							  repname,
							  leadid,
							  leadname,
							  appointmentdate,
							  employeeid,
                lastRepId) 
		 VALUES ('$getclientid',
				 '$BuildSuburbID',
                 '$BuildName',
                 '$BuildContact',
                 '$BuildAddress1',
                 '$BuildAddress2',
                 '$BuildSuburb',
                 '$BuildState',	
                 '$BuildPostcode',
                 '$BuildWPhone',
                 '$BuildMobile',
                 '$BuildFax',
                 '$BuildEmail',
				 
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
				 
                 '$DateLodged',
                 '$RepID',
				 '$RepIdent',
				 '$RepName',
				 '$LeadID',
				 '$LeadName',
				 '$AppointmentLodged',
				 '$EmployeeID',
         '$lastRepId')");
				
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
	
	header('Location:'.JURI::base().'builder-listing-vic/builder-folder-vic?pid='.$next_increment);			
}

$is_edit = 0;
if(isset($_REQUEST['pid']))
{ 
  $is_edit = 1;
  $pid = mysql_real_escape_string($_REQUEST['pid']);

  //if(substr($client_id, 0,3)=="CRV"){
  $sql = "SELECT *, DATE_FORMAT(datelodged,'".SQL_DFORMAT."') fdatelodged, DATE_FORMAT(appointmentdate,'".SQL_DFORMAT." @ %h:%i %p') fappointmentdate  FROM ver_chronoforms_data_builderpersonal_vic WHERE pid={$pid} ";
    
  $builder = mysql_fetch_assoc(mysql_query($sql));

  if($builder == null){
    echo "Can't find builder.";
    return;
  }

   $BuildID = $builder['builderid'];
    $BuildSuburbID = $builder['bsuburbid'];
  $BuildName = $builder['builder_name'];
  $BuildContact = $builder['builder_contact'];          
  $BuildAddress1 = $builder['builder_address1'];
  $BuildAddress2 = $builder['builder_address2'];
  $BuildSuburbID = $builder['builder_suburbid'] ;
  $BuildSuburb = $builder['builder_suburb'] ;
  $BuildState = $builder['builder_state'];          
  $BuildPostcode = $builder['builder_postcode'];
  $BuildWPhone = $builder['builder_wkphone'];
  $BuildMobile = $builder['builder_mobile'];         
  $BuildFax = $builder['builder_fax'];
  $BuildEmail = $builder['builder_email'];
    
    $SiteProject = $builder['site_project'];
  $SiteAddress1 = $builder['site_address1'];
  $SiteAddress2 = $builder['site_address2'];
  $SiteSuburbID = $builder['site_suburbid'];
  $SiteSuburb = $builder['site_suburb'];
  $SiteState = $builder['site_state'];
  $SitePostcode = $builder['site_postcode'];
  $SiteWKPhone = $builder['site_wkphone'];
    $SiteHMPhone = $builder['site_hmphone'];
  $SiteMobile = $builder['site_mobile'];
  $SiteOther = $builder['site_other'];
  $SiteEmail = $builder['site_email'];
  $TenderStatus = $builder['tenderstatus'];
    
  // $date =  $builder['idate'];
  //   $timestamp = date('Y-m-d H:i:s', strtotime($date)); 
  //   $DateLodged = $timestamp;
  $fappointmentdate = $builder['fappointmentdate'];
  $appointmentdate = $builder['appointmentdate'];
    $RepID = $builder['repid'];
  $RepIdent = $builder['repident'];
  $RepName = $builder['repname'];
  $RepEmail = $builder['repemail'];
  
  $LeadID = $builder['leadid'];
  $LeadName = $builder['leadname'];
  
  $EmployeeID = $builder['username'];
  $lastRepId = $builder['lastRepId'];

  //$pid=$client['pid'];
  //print_r($client);  
}

 
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

<!--- Copy Site Address Script -->
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
        var builder_config = {
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
                $("#bsuburb").val(ui.item.suburb);
                $("#bsuburbstate").val(ui.item.suburb_state);
                $("#bsuburbpostcode").val(ui.item.suburb_postcode);
                $("#bsuburb_id").val(ui.item.cf_id);
            },
            minLength:2
        };
        $("#bsuburb").autocomplete(builder_config);

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

        $("#bsuburbstate").keypress(function() {
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
            $("#bsuburb").css({"border-color": "red"});
            $("#bsuburb").on("change", function() {
                $(this).css({"border-color": "#97989a"});
            });
            $("#bsuburb").text(""); 
            $("#bsuburb").focus(); 
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
    });
</script>

<script type="text/javascript">
/*
  $(document).ready(function(){
  var builder_config = {
    source: "includes/vic/suburb_vic.php",
    select: function(event, ui){
        $("#bsuburb").val(ui.item.suburb);
        $("#bsuburbstate").val(ui.item.suburb_state);
        $("#bsuburbpostcode").val(ui.item.suburb_postcode);
    $("#bsuburb_id").val(ui.item.cf_id);  
    },
    minLength:1
    };
    $("#bsuburb").autocomplete(builder_config);

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
  });

  $("#bsuburbstate").keypress(function(){
         $("#notification").html("Please choose a suburb in the autocomplete box.");   
          //$("#notification").appendTo("."+dataClass+" .notification-area");
          $("#notification").removeClass('hide');  
          $("#notification").show(); 
          setTimeout(function() {
                $( "#notification" ).hide( "slow" );
          }, 7000);

          
          $("#bsuburb").css({ "border-color": "red"});
          $("#bsuburb").one("change",function(){ $(this).css({ "border-color": "#97989a"}); });
          $("#bsuburb").text(""); 
          $("#bsuburb").focus(); 
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
    });  
*/
</script>


<script type="text/javascript">
  $(document).ready(function(){
    var buildername_config = {
    source: "includes/vic/builder_vic.php",
    select: function(event, ui){		
		$("#build_name").val(ui.item.builder_name);
        $("#build_contact").val(ui.item.builder_contact);
        $("#baddress_1").val(ui.item.builder_address1);
		$("#baddress_2").val(ui.item.builder_address2);
		$("#bsuburb").val(ui.item.builder_suburb);
        $("#bsuburbstate").val(ui.item.builder_state);
        $("#bsuburbpostcode").val(ui.item.builder_postcode);
		$("#b_wphone").val(ui.item.builder_wkphone);
		$("#b_mobile").val(ui.item.builder_mobile);
		$("#b_fax").val(ui.item.builder_fax);
		$("#b_email").val(ui.item.builder_email);
		$("#builder_id").val(ui.item.cf_id);
		$("#bsuburb_id").val(ui.item.suburbid);
    },
    minLength:1
    };
		$("#build_name").autocomplete(buildername_config);
  });
</script>

<script>
function bcompanychange(){
    document.getElementById('bcontactid').style.visibility = 'hidden';
	document.getElementById('baddress1id').style.visibility = 'hidden';
	document.getElementById('baddress2id').style.visibility = 'hidden';
	document.getElementById('bsuburbspan').style.visibility = 'hidden';
	document.getElementById('bstateid').style.visibility = 'hidden';
	document.getElementById('bpostid').style.visibility = 'hidden';
	document.getElementById('bwphoneid').style.visibility = 'hidden';
	document.getElementById('bmobileid').style.visibility = 'hidden';
	document.getElementById('bfaxid').style.visibility = 'hidden';
	document.getElementById('bemailid').style.visibility = 'hidden';
}
function bsuburbchange(){
    document.getElementById('bstateid').style.visibility = 'hidden';
	document.getElementById('bpostid').style.visibility = 'hidden';
}
function ssuburbchange(){
    document.getElementById('sstatespan').style.visibility = 'hidden';
	document.getElementById('spostspan').style.visibility = 'hidden';
}
</script>

<div id="notification" class="notification_box hide"  ></div>

<form method="post" action="<?php echo JURI::base().'new-builder-enquiry-vic/'; ?>" class="Chronoform hasValidation" id="chronoform_New_Builder_Enquiry_Vic" enctype="multipart/form-data">
<input type="hidden" value="<?php echo $pid; ?>" id="" name="pid" />
<input type="hidden" value="" id="blank" name="blank" />
  <div class="column-left"></div>
  <div class="column-right"></div>
  <div id="tabs_wrapper" class="client-builder-tab">
    <div id="tabs_container">
      <ul id="tabs_default">
       <li class="active"><span>Builder</span></li>
      </ul>
    </div>
    <div id="tabs_content_container"> 
      
      <!--------------------------------------------------------- Builder Tab  -->
      
      <div id="builder" class="tab_content" style="display: block;">
      <!------------------------------------------------------- Builder Details  -->
        
        <!--<input type="hidden" id="buildersuburbid" name='builder_suburbid' value="<?php echo $BuilderSuburbID; ?>" /> -->
        <input type="hidden" id="builder_id" name='builderid' value="<?php echo $BuilderID; ?>" />
        <!--- End of Builder Details  -->
        
        <label class="input"><span id="bnameid">Company Name</span>
          <input type="text" value="<?php echo $BuildName; ?>" id="build_name" name="builder_name" onkeypress="bcompanychange();">
        </label>
        <label class="input"><span id="bcontactid">Contact</span>
          <input type="text" value="<?php echo $BuildContact; ?>" id="build_contact" name="builder_contact">
        </label>
        <label class="input"><span id="baddress1id">Address 1</span>
          <input type="text" value="<?php echo $BuildAddress1; ?>" id="baddress_1" name="baddress1">
        </label>
        <label class="input"><span id="baddress2id">Address 2</span>
          <input type="text" value="<?php echo $BuildAddress2; ?>" id="baddress_2" name="baddress2">
        </label>
        
        <!--- Builder Suburb  -->
        <label class="input"><span id="bsuburbspan">Suburb</span>
          <input type="text" id="bsuburb" name="builder_suburb" value="<?php echo $BuildSuburb; ?>"  onkeypress="bsuburbchange();" />
         </label>
        <input type="hidden" id="bsuburb_id" name="bsuburbid" value="<?php echo $BuildSuburbID; ?>" />

        <label class="input"><span id="bstateid">State</span>
          <input type="text" id="bsuburbstate" name="builder_state" value="<?php echo $BuildState; ?>" readonly="readonly" />
        </label>
        <label class="input"><span id="bpostid">Postcode</span>
          <input type="text" id="bsuburbpostcode" name="builder_postcode" value="<?php echo $BuildPostcode ?>" readonly="readonly" />
        </label>
         <!-- End of Builder Suburb  -->
         
        <label class="input"><span id="bwphoneid">Work Phone</span>
          <input type="text" value="<?php echo $BuildWPhone; ?>" id="b_wphone" name="bwphone">
        </label>
        <label class="input"><span id="bmobileid">Mobile</span>
          <input type="text" value="<?php echo $BuildMobile; ?>" id="b_mobile" name="bmobile">
        </label>
        <label class="input"><span id="bfaxid">Fax</span>
          <input type="text" value="<?php echo $BuildFax; ?>" id="b_fax" name="bfax" >
        </label>
        <label class="input"><span id="bemailid">Email</span>
          <input type="text" value="<?php echo $BuildEmail; ?>" id="b_email" name="bemail" >
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
          <label class="input"><span id="sprojectnamespan">Project Name</span>
          <input type="text" value="<?php echo $SiteProject; ?>" id="sprojectname" name="sprojectname">
        </label>
        <label class="input"><span id="saddress1span">Address 1</span>
          <input type="text" value="<?php echo $SiteAddress1; ?>" id="saddress1" name="saddress1">
        </label>
        <label class="input"><span id="saddress2span">Address 2</span>
          <input type="text" value="<?php echo $SiteAddress2; ?>" id="saddress2" name="saddress2">
        </label>
        
        <!--- Site Suburb  -->
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
       <!-- End of Site Suburb  -->
       
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
          <input type="text" id="idate" name="idate" class="date_entered" value="<?php print(Date(PHP_DFORMAT)); ?>">
        </label> 
        <input type="submit" value="Send Mail" id="ibtn" name="<?php echo ($is_edit==0?"save":"sendmail"); ?>" class="btn">
        
        <!--- Sales Rep -->
        <?php
	  $queryrep="SELECT id, name, RepID,email FROM ver_users ORDER BY name ASC";
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
	  	    echo "<label class='input'><span><?php if($is_edit==0){echo 'Sales Rep';} ?></span><select class='rep-list' id='replist' name='replist' onchange='javascript:SelectChangedRep();'><option></option>";
            $usergroup = 'Victoria Users';
            $user =& JFactory::getUser(); //$userName = $user->get( 'name' ); 
            if(isset($user->groups['27'])){ //27 is victoria sales manager
              $querysub2="SELECT id, name FROM ver_users WHERE id IN (SELECT user_id FROM ver_user_usergroup_map WHERE group_id=27 || group_id=9 ) ORDER BY name ASC";
            }else if(isset($user->groups['9'])){ //27 is victoria sales manager
              $querysub2="SELECT id, name FROM ver_users WHERE id IN (SELECT user_id FROM ver_user_usergroup_map WHERE  group_id=9 ) ORDER BY name ASC";
            }else{
              $querysub2="SELECT id, name FROM ver_users WHERE usertype LIKE ('$usergroup') ORDER BY name ASC";
            }

            //$querysub2="SELECT id, name FROM ver_users WHERE usertype LIKE ('$usergroup') ORDER BY name ASC";
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
			



	  	    echo "<label class='input'><span><?php if($is_edit==0){echo 'Lead Type'; } ?></span><select class='lead-list' id='leadlist' name='leadlist' onchange='javascript:SelectChangedLead();'><option></option>";
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
        <input type="hidden" id="leadname" name='leadname' value="<?php echo $LeadName; ?>" readonly />
        <input type="hidden" id="leadid" name='leadid' value="<?php echo $LeadID; ?>" readonly />
        
        <!-- End of Lead Type -->
        
        <label class='input'><span><?php if($is_edit==0){ echo 'Last Rep Allocated'; } ?></span>
          <!-- <select class="last-rep">
            <option value=""></option>
          </select> -->
          <?php
            echo "<select class='last-rep' id=' ' name='lastRepId' ><option></option>";
            $querysub3="SELECT u.RepID, u.name FROM ver_chronoforms_data_builderpersonal_vic AS b JOIN ver_users AS u ON u.RepID=b.repident WHERE b.repident != '' GROUP BY b.repident ORDER BY b.pid DESC LIMIT 10";
            $resultsub3 = mysql_query($querysub3);
            if(!$resultsub3){die ("Could not query the database: <br />" . mysql_error());  }
      
            while ($data=mysql_fetch_assoc($resultsub3)){

                      echo "<option value = '{$data['RepID']}' ".($lastRepId==$data['RepID']?" selected":"")." >{$data['name']}</option>"; 
                     
                }
       
            echo "</select>";
          ?>
        </label>
        <?php $user =& JFactory::getUser(); $userName = $user->get( 'name' );
       echo '<label class=\'input\'><span id=\'takenid\'>Taken by:</span><input type=\'text\' id=\'username\' name=\'username\' class=\'username\' value=\''.$userName.'\' readonly></label>';?>
         <?php $usermail =& JFactory::getUser(); $userEmail = $usermail->get( 'email' );
       echo '<input type=\'hidden\' id=\'usermail\' name=\'usermail\' value=\''.$userEmail.'\' readonly>';?>
        
                <div class="input-group date form_datetime col-md-5" data-date-format="<?php echo JS_DFORMAT; ?> @ HH:ii P" data-link-field="dtp_appointment" style="display:inline-block">
                    <label class='input'><span id='date-entered'>Appointment: </span>
          <input type="text" id="iappointment" name="iappointment" class="form-control" value="<?php echo $fappointmentdate; ?>" readonly>
        </label>    <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
					<span class="input-group-addon"><span class="glyphicon glyphicon-th"></span></span>
                </div>
				<input type="hidden" id="dtp_appointment" name="dtp_appointment" value="<?php echo $appointmentdate; ?>" /><br/>
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
  
<?php if($is_edit==0){ ?>  
  <!-- Drawing Image Tab -->
  <div id="tabs_wrapper" class="drawing-tab">
    <div id="tabs_container">
      <ul id="tabs_default">
        <li class="active"><span>Drawing</span></li>
      </ul>
    </div>
    <div id="tabs_content_container">
    <div id="draw" class="tab_content_default" style="display: block;">
    <!--<INPUT type="button" value="Add Drawing" onclick="addRow('tbl-draw')" />-->
    <INPUT type="button" value="Delete Drawing" onclick="deleteRow('tbl-draw')" />

        
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
          <div class="layer-date">Date: <input type="text" id="date_display" name="date_display" class="datetime_display" value="<?php print(Date(PHP_DFORMAT)); ?>" readonly>
          <input type="hidden" id="date_notes" name="date_notes" class="date_time" value="<?php print(Date(PHP_DFORMAT." H:i:s")); ?>" readonly></div>
          <div class="layer-whom">By Whom: <input type="text" id="username_notes" name="username_notes" class="username" value="<?php echo $userName; ?>" readonly></div>
          
          
          </td>
		 
	 
		  </tr>

        </table>
      </div>
    </div>
  </div>

<?php } ?>

  <div id="tabs_wrapper" class="button-tab">
 
    <input type="button" value="Cancel" id="bcbtn" name="cancel" class="bbtn" onclick=location.href='<?php echo (isset($pid) ? JURI::base()."builder-listing-vic/builder-folder-vic?pid={$pid}" : JURI::base()); ?>' />
    <input type="submit" value="Save" id="bsbtn" name="<?php echo ($is_edit==0?"save":"update"); ?>" class="bbtn">

  </div>
</form>
