<?php
include 'includes/vic/custom_processes_user.php';

$current_signed_in_user_access_profiles = $custom_configs_user['user_access_profiles'][$current_signed_in_user_group_key]['client-folder-vic'];
?>


<?php  
date_default_timezone_set('Australia/Victoria');

//$user->groups['10'] // is victoria  admin user 
//$user->groups['26'] //  is victoria office manager
//$user->groups['27'] //  is victoria sales manager
//$user->groups['9'] //9 is consultants general user
//$user->groups['28'] // is victoria  reception user
//top_admin is Jit user $user->groups['10']


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

$form->data['date_entered'] = date(PHP_DFORMAT);
$form->data['date_time'] = date(PHP_DFORMAT.' g:i A');

$id = isset($_REQUEST['pid'])?$_REQUEST['pid']:"";
$pid = isset($_REQUEST['pid'])?$_REQUEST['pid']:"";
$cid = isset($_REQUEST['quoteid'])?$_REQUEST['quoteid']:"";   
$cid = isset($_REQUEST['cid'])?$_REQUEST['cid']:""; 
$has_contract = 0;
$is_tender_quote = 0;
 
 
$cf_id = "0";
if(isset($_REQUEST['cf_id']) && $_REQUEST['cf_id']>0){
  $cf_id = mysql_real_escape_string($_REQUEST['cf_id']);
}



$drawid = isset($_POST['drawingid']) ? $_POST['drawingid'] : NULL;
$picid = isset($_POST['picid']) ? $_POST['picid'] : NULL;
$fileid = isset($_POST['fileid']) ? $_POST['fileid'] : NULL;

if(!empty($cid)){ //this is the query if the reference client id is cid based on client_id favor for old and new client id. if pid the system design query client based on pid.
  $result = mysql_query("SELECT * FROM ver_chronoforms_data_clientpersonal_vic WHERE clientid  = '$cid'");
  
}else{
  $result = mysql_query("SELECT * FROM ver_chronoforms_data_clientpersonal_vic WHERE pid  = '$id'");
  //error_log("SELECT * FROM ver_chronoforms_data_clientpersonal_vic WHERE pid  = '$id' ", 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_sa\\my-error.log'); 
}


$retrieve = mysql_fetch_array($result);
 

if (!$result) 
{
die("Error: Data not found..");
} 

  $id = $retrieve['pid'];
  $pid = $retrieve['pid'];

  $ClientSuburbID = $retrieve['client_suburbid'];
    $ClientSuburbID = $retrieve['client_suburbid'];
    $ClientTitle = $retrieve['client_title'];
    $ClientFirstName = $retrieve['client_firstname'];
    $ClientLastName = $retrieve['client_lastname'];
    $BuilderContact = $retrieve['builder_contact'];
    $BuilderContactTitle = $retrieve['builder_contact_title'];
    $BuilderContactFirstName = $retrieve['builder_contact_firstname'];
    $BuilderContactLastName = $retrieve['builder_contact_lastname'];   

    if($BuilderContact!=null && $BuilderContactFirstName==null && $BuilderContactLastName==null){
      $name = $BuilderContact;
      $name = explode(' ', $name);     
      $BuilderContactFirstName = $name[0];
      $BuilderContactLastName = (isset($name[count($name)-1])) ? $name[count($name)-1] : '';
      // alert("Please click save to apply changes for the builder contact...");
    }

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
    $Status = $retrieve['status'];   
    
    
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
  //error_log("DateLodged: ".$DateLodged, 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_sa\\my-error.log');  
    $datepoint = $retrieve['appointmentdate'];
  $AppointmentLodged = "";
  //error_log("DateLodged: ".$DateLodged, 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_sa\\my-error.log');  
  //  error_log(" strtotime: ".strtotime($datepoint), 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_sa\\my-error.log');  
  if(strtotime($datepoint) != 0){
    $AppointmentLodged = date(PHP_DFORMAT.' @ h:i A', strtotime($datepoint));
  
  // $AppointmentLodged = date(PHP_DFORMAT.' @ HH:ii P', strtotime($datepoint));
  }

  
 /*  if(empty($_POST['dtp_appointment'])==true || $_POST['dtp_appointment']=="0000-00-00 00:00:00")
    $AppointmentLodged = "NULL";
  else
    $AppointmentLodged = "'".$_POST['dtp_appointment']."'"; */

  //error_log(" AppointmentLodged: ".$AppointmentLodged, 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_sa\\my-error.log'); 
    
  $RepID = $retrieve['repid'];
    $RepIdent = $retrieve['repident'];
  $rep_id = $retrieve['repident'];
    $RepName = $retrieve['repname'];
    
    $LeadID = $retrieve['leadid'];
    $LeadName = $retrieve['leadname'];
    
    $EmployeeID = $retrieve['employeeid'];
    $ClientID = $retrieve['clientid'];
  $is_builder = $retrieve['is_builder'];
    $QuoteID = $ClientID;

  $now = time();  
  $datestamp = date(PHP_DFORMAT." h:i:sa");

//error_log(print_r($_POST,true), 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_sa\\my-error.log');
//error_log(print_r($_FILES,true), 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_sa\\my-error.log');

if(isset($_POST['save'])) // save note created part
{   
  $temp_appointment_date = 'NULL';
  if (isset($_POST['appointmentdate']) && 
      strlen(trim($_POST['appointmentdate'])) > 0) {
      $temp_appointment_date = trim($_POST['appointmentdate']);
      $temp_appointment_date = date('Y-m-d H:i:s', strtotime($temp_appointment_date));
  }
  $temp_date_delivered = 'NULL';
  if (isset($_POST['qdelivered']) && 
      strlen(trim($_POST['qdelivered'])) > 0) {
      $temp_date_delivered = trim($_POST['qdelivered']);
      $temp_date_delivered = date('Y-m-d H:i:s', strtotime($temp_date_delivered));
  }
  $temp_next_followup_date = 'NULL';
  if (isset($_POST['ffdate1']) && 
      strlen(trim($_POST['ffdate1'])) > 0) {
      $temp_next_followup_date = trim($_POST['ffdate1']);
      $temp_next_followup_date = date('Y-m-d H:i:s', strtotime($temp_next_followup_date));
  }
  $temp_date_contract_signed = 'NULL';
  if (isset($_POST['date_contract_signed']) && 
      strlen(trim($_POST['date_contract_signed'])) > 0) {
      $temp_date_contract_signed = trim($_POST['date_contract_signed']);
      $temp_date_contract_signed = date('Y-m-d H:i:s', strtotime($temp_date_contract_signed));
  }


  $temp_previous_date_delivered = 'NULL';
  if (isset($_POST['previous_date_delivered'])) {
      $temp_previous_date_delivered = trim($_POST['previous_date_delivered']);
  }


  $temp_previous_quote_status = '';
  if (isset($_POST['previous_quote_status'])) {
      $temp_previous_quote_status = trim($_POST['previous_quote_status']);
  }


  $temp_quote_status = '';
  $temp_quote_status = $temp_previous_quote_status;
  if ($temp_previous_date_delivered == 'NULL' || strlen($temp_previous_date_delivered) == 0) {
      if (strtolower($temp_previous_quote_status) == 'quoted') {
          $temp_quote_status = 'Costed';
      }
      if ($temp_date_delivered != 'NULL' && strlen($temp_date_delivered) > 0) {
          $temp_quote_status = 'Quoted';
      }
  }


  if (isset($_POST['status'])) {
      if (strtolower(trim($_POST['status'])) == 'under consideration' || 
          strtolower(trim($_POST['status'])) == 'future project') {
          if (strtolower($temp_previous_quote_status) == 'quoted') {
              $temp_quote_status = trim($_POST['status']);
          }
      } elseif (strtolower(trim($_POST['status'])) == 'lost') {
          $temp_quote_status = trim($_POST['status']);
      } elseif (strtolower(trim($_POST['status'])) == 'not interested') {
          $temp_quote_status = trim($_POST['status']);
      }
  }


  $temp_customisation_options = array();
  if (strtolower($temp_quote_status) == 'lost' && 
      isset($_POST['contract_lost_reason']) && 
      isset($_POST['previous_customisation_options'])) {
      if (strlen(trim($_POST['previous_customisation_options'])) > 0 && 
          json_decode(trim($_POST['previous_customisation_options']), true) != NULL) {
          $temp_customisation_options = json_decode(trim($_POST['previous_customisation_options']), true);
          if (!isset($temp_customisation_options['contract_lost_reason'])) {
              $temp_customisation_options['contract_lost_reason'] = trim($_POST['contract_lost_reason']);
          }
      } else {
          $temp_customisation_options['contract_lost_reason'] = trim($_POST['contract_lost_reason']);
      }
  }


  if ((isset($_POST['cf_id']) && strlen(trim($_POST['cf_id'])) > 0) && 
      (isset($_POST['current_quote_id']) && strlen(trim($_POST['current_quote_id'])) > 0) && 
      (isset($_POST['current_project_id']) && strlen(trim($_POST['current_project_id'])) > 0)) {
      $sql = "
          UPDATE ver_chronoforms_data_followup_vic SET 
              qdelivered = '". $temp_date_delivered . "', 
              ffdate1 = '". $temp_next_followup_date . "', 
              date_contract_signed = '". $temp_date_contract_signed . "', 
              status = '". $temp_quote_status . "', 
              customisation_options = '". json_encode($temp_customisation_options) . "' 
          WHERE cf_id = '" . $_POST['cf_id'] . "' 
          AND quoteid = '" . $_POST['current_quote_id'] . "' 
          AND projectid = '" . $_POST['current_project_id'] . "';
      ";
      mysql_query($sql)or die(mysql_error()); 

      $sql = "
          UPDATE ver_chronoforms_data_clientpersonal_vic SET 
              appointmentdate = '". $temp_appointment_date . "', 
              qdelivered = '". $temp_date_delivered . "', 
              next_followup = '". $temp_next_followup_date . "', 
              date_contract_signed = '". $temp_date_contract_signed . "', 
              status = '". $temp_quote_status . "' 
          WHERE clientid = '" . $_POST['current_quote_id'] . "';
      ";
      mysql_query($sql)or die(mysql_error()); 
  } else {
      $sql = "
          UPDATE ver_chronoforms_data_clientpersonal_vic SET 
              appointmentdate = '". $temp_appointment_date . "', 
              qdelivered = '". $temp_date_delivered . "', 
              next_followup = '". $temp_next_followup_date . "', 
              date_contract_signed = '". $temp_date_contract_signed . "', 
              status = '". $temp_quote_status . "' 
          WHERE clientid = '" . $_POST['current_quote_id'] . "';
      ";
      mysql_query($sql)or die(mysql_error()); 
  }

  if (strtolower($temp_quote_status) == 'lost') {
      /* --- begin mail sending --- */
      $mailer_sender = array(
          'name' => 'Vergola Australia', 
          'email' => 'Vergola.Aus@knowledgeplus.net.au'
      );

      $mailer_recipients = array();
      $sql = "
          SELECT 
              ver_users.RepID, 
              ver_users.name, 
              ver_users.username, 
              ver_users.email, 
              ver_usergroups.title 
          FROM ver_users 
              LEFT JOIN ver_user_usergroup_map 
                  ON ver_users.id = ver_user_usergroup_map.user_id 
              LEFT JOIN ver_usergroups 
                  ON ver_user_usergroup_map.group_id = ver_usergroups.id 
          WHERE ver_users.block = '0' 
          AND (LOWER(title) LIKE '%admin%' OR LOWER(title) LIKE '%sales manager%') 
          ORDER BY ver_users.RepID;
      ";
      $results1 = mysql_query($sql);
      while ($row1 = mysql_fetch_array($results1)) {
          $mailer_recipients[] = array(
              'name' => $row1['name'], 
              'email' => $row1['email']
          );
      }

      $mailer_ccs = array();

      $mailer_params = array(
          'mailer_type' => 'smtp', 
          'host' => 'smtp.gmail.com', 
          'username' => 'vglkp4u5@gmail.com', 
          'password' => '0ceanV!ew', 
          'sender' => $mailer_sender, 
          'recipients' => $mailer_recipients, 
          'ccs' => $mailer_ccs, 
          'subject' => 'Vergola SA > Contract Lost > ' . $_POST['current_quote_id'] . ' (' . date('d-M-Y') . ')', 
          'content' => 'Reason for losing this contract: ' . 
                        "<br />\n" . 
                        $_POST['contract_lost_reason'] . 
                        "<br />\n" . 
                        "<br />\n" . 
                        'Sales Rep: ' . 
                        "<br />\n" . 
                        $RepName, 
          'do_send' => true, 
      );

      include "/includes/vic/libraries/PHPMailer_custom_loader.php";
      /* --- end mail sending --- */
  }


  $getclientid = $ClientID; 
  $checknotes = implode(", ", $_POST['notestxt']);
  $cnt = count($_POST['date_notes']);
  $cnt2 = count($_POST['username_notes']);
  $cnt3 = count($_POST['notestxt']);


  if ($cnt > 0 && $cnt == $cnt2 && $cnt2 == $cnt3 && $checknotes != '') {
      $insertArr = array();
      //, '" . mysql_real_escape_string($_POST['date_notes'][$i]) . "'
    for ($i=0; $i<$cnt; $i++) {
        $insertArr[] = "('$getclientid', '" . mysql_real_escape_string($_POST['username_notes'][$i]) . "', '" . mysql_real_escape_string($_POST['notestxt'][$i]) . "')";
    } 
  
    $queryn = "INSERT INTO ver_chronoforms_data_notes_vic (clientid, username, content) VALUES " . implode(", ", $insertArr);   
    mysql_query($queryn) or trigger_error("Insert failed: " . mysql_error()); 

  }

  header('Location:'.JURI::base().'client-listing-vic/client-folder-vic?pid='.$id);
  //This is the Time Save       

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

}

 
if(isset($_FILES['pic'])){  // upload pic from Pics tab

      foreach ($_FILES['pic']['tmp_name'] as $key => $tmp_name){
      //This is the directory where images will be saved 
         
          $path = "images/pic/{$ClientID}";
          if (!file_exists($path)) {
            mkdir($path, 0777, true);
          }

          //$file_name = $_FILES['pic']['name'][0];
          $file_name = pathinfo($_FILES['pic']['name'][$key], PATHINFO_FILENAME).'.'.pathinfo($_FILES['pic']['name'][$key], PATHINFO_EXTENSION); 
          $target=$path."/{$file_name}_{$now}";  
          $target=$target.'.'.pathinfo($_FILES['pic']['name'][$key], PATHINFO_EXTENSION);  
          
          //error_log(print_r($file_name,true), 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_sa\\my-error.log'); 

          if (move_uploaded_file($tmp_name, $target)) {

            $query = "INSERT INTO ver_chronoforms_data_pics_vic (clientid, datestamp, photo, file_name, upload_type) VALUES  ('$ClientID', NOW(), '$target', '{$file_name}', 'pic')";
            mysql_query($query) or trigger_error("Insert failed: " . mysql_error());  
          }
      }

      header('Location:'.JURI::base().'client-listing-vic/client-folder-vic?pid='.$id);

}
  
 
if(isset($_FILES['photo'])){ // upload drawing photo from Drawing tab

      foreach ($_FILES['photo']['tmp_name'] as $key => $tmp_name){
  //This is the directory where images will be saved 
        $path = "images/drawings/{$ClientID}";
          if (!file_exists($path)) {
            mkdir($path, 0777, true);
          }

          //$file_name = $_FILES['photo']['name'][0];
          $file_name = pathinfo($_FILES['photo']['name'][$key], PATHINFO_FILENAME).'.'.pathinfo($_FILES['photo']['name'][$key], PATHINFO_EXTENSION); 
          $target=$path."/{$file_name}_{$now}";  
          $target=$target.'.'.pathinfo($_FILES['photo']['name'][$key], PATHINFO_EXTENSION);  
           

      if (move_uploaded_file($tmp_name, $target)) {

  $query = "INSERT INTO ver_chronoforms_data_drawings_vic (clientid, photo, file_name) VALUES  ('$ClientID', '$target','{$file_name}')";
  mysql_query($query) or trigger_error("Insert failed: " . mysql_error());
            
            }
      }

    header('Location:'.JURI::base().'client-listing-vic/client-folder-vic?pid='.$id);

}


 
  //error_log("HERE a1", 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_sa\\my-error.log'); 
//error_log(" #1: ".print_r($_POST,true), 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_sa\\my-error.log');
if(isset($_FILES['doc'])){  //Upload file from Files tab
      //error_log("RepIdent:".$RepIdent, 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_sa\\my-error.log');

      //error_log(" #2: ".print_r($_FILES['doc'],true), 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_sa\\my-error.log');
      foreach ($_FILES['doc']['tmp_name'] as $key => $tmp_name){
        $path = "images/file_upload/{$ClientID}";
        if (!file_exists($path)) {
          mkdir($path, 0777, true);
        }

      $doc_id = mysql_real_escape_string($_POST['doc_id']);  
      //This is the directory where images will be saved 
          
          //$file_name = $_FILES['doc']['name'][0];
          $file_name = pathinfo($_FILES['doc']['name'][$key], PATHINFO_FILENAME).'.'.pathinfo($_FILES['doc']['name'][$key], PATHINFO_EXTENSION); 
          $target=$path."/{$file_name}_{$now}";  
          $target=$target.'.'.pathinfo($_FILES['doc']['name'][$key], PATHINFO_EXTENSION);    
          
          $upload_type = $_POST['upload_type'];
          //error_log($ext, 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_sa\\my-error.log'); 

      if (move_uploaded_file($tmp_name, $target)) {

        $query = "INSERT INTO ver_chronoforms_data_pics_vic (clientid, datestamp, photo, upload_type, file_name) VALUES  ('$ClientID', NOW(), '$target','{$upload_type}','{$file_name}')";
        mysql_query($query) or trigger_error("Insert failed: " . mysql_error());
      //error_log(" HAS PROBLEM: ".$query, 3,'C:\\xampp\htdocs\\vergola_contract_system_v3\\my-error.log'); 
              
              }
      }

      //if($upload_type=="signed_sales_doc" || $upload_type=="signed_correspondence_doc" || $upload_type=="signed_stat_doc"){
      //$query = "UPDATE  ver_chronoforms_data_letters_vic SET has_upload_file=1 WHERE cf_id={$doc_id} ";
      //mysql_query($query) or trigger_error("Insert failed: " . mysql_error());  
       
       
      header('Location:'.JURI::base().'client-listing-vic/client-folder-vic?pid='.$id);

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
          
          //$file_name = $_FILES['signed_doc']['name'][0];
          $file_name = pathinfo($_FILES['signed_doc']['name'][$key], PATHINFO_FILENAME).'.'.pathinfo($_FILES['signed_doc']['name'][$key], PATHINFO_EXTENSION); 
          $target=$path."/{$file_name}_{$now}";  
          $target=$target.'.'.pathinfo($_FILES['signed_doc']['name'][$key], PATHINFO_EXTENSION);    
          
          $upload_type = $_POST['upload_type'];
          //error_log($ext, 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_sa\\my-error.log'); 

      if (move_uploaded_file($tmp_name, $target)) {

        //$query = "UPDATE  ver_chronoforms_data_letters_vic SET uploaded_filename='{$file_name}' WHERE cf_id={$doc_id} ";
         $query = "INSERT INTO ver_chronoforms_data_pics_vic (clientid, datestamp, photo, upload_type, file_name, ref_id) VALUES  ('$ClientID', NOW(), '$target','{$upload_type}','{$file_name}', {$doc_id})";
         mysql_query($query) or trigger_error("Insert failed: " . mysql_error());
        //error_log($query, 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_sa\\my-error.log'); 
              
              }
      }

      $query = "UPDATE  ver_chronoforms_data_letters_vic SET has_upload_file=1 WHERE cf_id={$doc_id} ";
      mysql_query($query) or trigger_error("Insert failed: " . mysql_error());

      header('Location:'.JURI::base().'client-listing-vic/client-folder-vic?pid='.$id);

 }  

//error_log("_POST: ".print_r($_POST,true), 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_sa\\my-error.log');  
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
       // error_log($query, 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_sa\\my-error.log'); 
              
              }
      }



      //$query = "UPDATE  ver_chronoforms_data_letters_vic SET has_upload_file=1 WHERE cf_id={$doc_id} ";
      //mysql_query($query) or trigger_error("Insert failed: " . mysql_error());
      header('Location:'.JURI::base().'client-listing-vic/client-folder-vic?pid='.$id);

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

$ref = ($is_builder?"builder-listing-vic/builder-folder-vic?pid={$pid}&is_builder=1":"client-listing-vic/client-folder-vic?pid={$pid}&is_builder=0");  

if(isset($_POST['close']))
{   
  if($is_builder){ 
    header('Location:'.JURI::base().'builder-listing-vic');  
  }else{
     header('Location:'.JURI::base().'client-listing-vic');  
  } 
        
}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Client Folder</title>
<script charset="UTF-8" type="text/javascript" src="<?php echo JURI::base().'jscript/jquery-2.1.4.min.js'; ?>"></script>
<script charset="UTF-8" type="text/javascript" src='<?php echo JURI::base();?>jscript/client-folder.js'></script>
<script src="<?php echo JURI::base().'jscript/jsapi.js'; ?>"></script>
<script src="<?php echo JURI::base().'jscript/jquery.min.js'; ?>"></script>
<script src="<?php echo JURI::base().'jscript/labels.js'; ?>"></script>
<script type="text/javascript" src="<?php echo JURI::base().'jscript/tabcontent.js'; ?>"></script>

<link rel="stylesheet" type="text/css" media="screen,projection" href="<?php echo JURI::base().'jscript/custom.css'; ?>" />
<link rel="stylesheet" type="text/css" media="screen,projection" href="<?php echo JURI::base().'jscript/new-enquiry.css'; ?>" />
<link rel="stylesheet" type="text/css" media="screen,projection" href="<?php echo JURI::base().'jscript/client-folder.css'; ?>" />
<script src="<?php echo JURI::base().'jscript/jquery-ui-1.11.4/jquery-ui.min.js'; ?>"></script> 
<link rel="stylesheet" type="text/css" media="screen,projection" href="<?php echo JURI::base().'jscript/jquery-ui-1.11.4/jquery-ui.min.css'; ?>" />

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
      <ul id="tabs_default">
        <li class="active"><span><?php echo ($is_builder==0?"Client Details":"Builder Details"); ?></span></li>
      </ul>
    </div>
    <div id="tabs_content_container"> 
    
    <!-- Client Tab -->
    <div id="client" class="tab_content" style="display: block;">
      <div id="client-layer">
        <p><?php echo $retrieve['clientid']; ?></p>

        <?php //process user_access_profiles
        if ($current_signed_in_user_access_profiles['tab client details']['edit'] == true) {
        ?>
            <?php if($retrieve['is_builder']==1){ ?>
                <p><?php echo $retrieve['builder_name']; ?>  &nbsp; <a href ="<?php echo JURI::base()."new-builder-enquiry-vic?pid={$pid}&client_type=b&ref=builder-listing-vic/builder-folder-vic?pid={$pid}"; ?> " class="edit-link">Edit</a></p>
            <?php }else{ ?>    
                <p><?php echo $ClientTitle; ?> <?php echo $ClientFirstName; ?> <?php echo $ClientLastName; ?> &nbsp; <a href ="<?php echo JURI::base()."new-client-enquiry-vic?pid={$pid}&ref=client-listing-vic/client-folder-vic?pid={$pid}"; ?> " class="edit-link">Edit</a></p>
            <?php } ?>
        <?php } //end if?>    
        <!-- <p><?php echo $BuilderContact; ?></p> -->
        <p><?php echo $BuilderContactTitle; ?> <?php echo $BuilderContactFirstName; ?> <?php echo $BuilderContactLastName; ?></p> 
        
    <p>
      <?php if ($ClientStreetNo!='') {echo $ClientStreetNo; } else {echo "";} ?>
      <?php if ($ClientStreetName!='') {echo "&nbsp;" .$ClientStreetName. "&nbsp;"; } else {echo "";} ?>        
    </p>
    <p><?php echo $ClientAddress1; ?></p>
        </p>
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
        <p>
          <?php if ($SiteStreetNo!='') {echo $SiteStreetNo; } else {echo "";} ?>
          <?php if ($SiteStreetName!='') {echo "&nbsp;" .$SiteStreetName. "&nbsp;"; } else {echo "";} ?>        
        </p>
        <p><?php echo $SiteAddress1; ?></p>
        </p>
        <?php if ( $SiteAddress2!='') {echo "<p>" .  $SiteAddress2 . "</p>";} else {echo "";} ?>
        <!--- Site Suburb -->
        <p><?php echo $SiteSuburb; ?> <?php echo $SiteState; ?> <?php echo $SitePostcode; ?></p>
      </div>
    </div>
  </div>
  <!--- End of Site Address --> 
  
</div>
</div>
<script type="text/javascript">

var clientbuilder=new ddtabcontent("client-builder-tabs")
clientbuilder.setpersist(false)
clientbuilder.setselectedClassTarget("link") //"link" or "linkparent"
clientbuilder.init()
 
</script> 

<!--- Info Quotes -->

<div id="tabs_wrapper" class="quote-tab">
  <div id="tabs_container">
    <ul id="quote-tabs" class="shadetabs">
      <li><a href="#" rel="quote" class="selected">Costing Info</a></li> 
    </ul>
  </div>
  <div id="tabs_content_container"> 
    
    <!-- Quote Tab -->
    <div id="quote" class="tab_content" style="display: block;">

        <?php //process user_access_profiles
        if ($current_signed_in_user_access_profiles['tab costing info']['add new costing'] == true) {
        ?>
            <input type="button" value="Add New Costing" class="bbtn btn-add" <?php echo "onclick=location.href='" . JURI::base() . "add-quote-vic?quoteid=". $QuoteID."&ref={$ref}'"; ?>  />
        <?php } //end if?>

      <?php 
      include 'includes/vic/quote/quote_vic.php'; 
     // error_log(" cf_id: ".$cf_id, 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_sa\\my-error.log');
    ?>
    </div> 
  </div>
</div>
<script type="text/javascript">

var quoteinfo=new ddtabcontent("quote-tabs")
quoteinfo.setpersist(false)
quoteinfo.setselectedClassTarget("link") //"link" or "linkparent"
quoteinfo.init()

</script> 
<!-- Enquiry Tracker Tab -->
<br/>
    
<div id="tabs_wrapper" class="info-tab"  >
  <div id="tabs_container">

  <ul id="tracker-tabs" class="shadetabs">
      <li><a href="#" rel="tracker" class="selected">Enquiry Tracker</a></li>      
    <li ><a href='#' rel='followup'>Follow Up</a></li> <?php //if($cf_id<1){echo "style='pointer-events: none;'";} ?> 
    </ul>
  </div>
  <div id="tabs_content_container">
    <div id="tracker" class="tab_content" style="display: block;">
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

<!--
  <div class="input-group date form_datetime col-md-5" data-date-format="<?php echo JS_DFORMAT." @ HH:ii P"; ?>" data-link-field="dtp_appointment" style="display:inline-block">
          <label class='input'><span id='date-entered'>Appointment: </span>
             <input type="text" id="iappointment" name="iappointment" class="form-control" value="<?php echo $retrieve['fappointmentdate'] ?>" readonly> 
      <label type="text" id="iappointment" name="iappointment" class="form-control" value="<?php echo $AppointmentLodged; ?>" readonly>
          </label>
          <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span> <span class="input-group-addon"><span class="glyphicon glyphicon-th"></span></span> </div>
        <input type="text" id="dtp_appointment" name="dtp_appointment" value="<?php echo $retrieve['appointmentdate'] ?>" />
        <br/>
  -->
    
    <?php
      // $sql = "SELECT quotedate, qdelivered, ffdate1, ffdate2, ffdate3, project_name, status FROM ver_chronoforms_data_followup_vic WHERE quoteid  = '$QuoteID' ORDER BY FIELD(status,'Won','In Progress','Under Consideration','Future Project', 'Quoted','Superseded','Lost'), quotedate DESC LIMIT 1";
     
       //error_log($sql, 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_sa\\my-error.log');
      //error_log($sql, 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_sa\\my-error.log');
      if(isset($cf_id) && $cf_id>0){
         $sql = "SELECT * FROM ver_chronoforms_data_followup_vic WHERE cf_id={$cf_id}";
        //error_log($sql, 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_sa\\my-error.log');
         $resultproject = mysql_query($sql);

            while ($project = mysql_fetch_array($resultproject)) { 
            //error_log(print_r($project,true), 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_sa\\my-error.log');
            echo "<h1 class=\"siteproject\">Project Name: {$project['project_name']}</h1>".
             "<span class=\"ffinfo\"><label>Quote Date</label>:".date(PHP_DFORMAT,strtotime($project['quotedate']))."</span>";
             if ($project['qdelivered'] != "") { echo "<span class=\"ffinfo\"><label>Quote Delivered</label>:".date(PHP_DFORMAT,strtotime($project['qdelivered']))."</span>"; }
             else {echo "";}
       // $AppointmentLodged = date(PHP_DFORMAT.' @ h:i A', strtotime($datepoint));
             if ($project['ffdate1'] != "") { echo "<span class=\"ffinfo\"><label>Follow Up 1</label>:".date(PHP_DFORMAT,strtotime($retrieve['appointmentdate']))."</span>"; }
             else {echo "";}
             if ($project['ffdate2'] != "") { echo "<span class=\"ffinfo\"><label>Follow Up 2</label>:".date(PHP_DFORMAT,strtotime($project['ffdate2']))."</span>"; }
             else {echo "";}
             if ($project['ffdate3'] != "") { echo "<span class=\"ffinfo\"><label>Next Followup</label>:".date(PHP_DFORMAT,strtotime($project['ffdate3']))."</span>"; }
             else {echo "";}
             echo "<span class=\"ffinfo\"><label>Status</label>: ".(strtolower($project['status'])=="quoted"?"Costing":$project['status'])."</span>";
         
            }
    }    
     ?>
    </div>

    <div id='followup' class='tab_content' style='display: block;'> 
    <?php    include 'includes/vic/quote/followup_vic.php'; ?>
    </div> 
    
  </div>
</div>
<script type="text/javascript">

var trackerinfo=new ddtabcontent("tracker-tabs")
trackerinfo.setpersist(false)
trackerinfo.setselectedClassTarget("link") //"link" or "linkparent" 
trackerinfo.init()

</script>  





    <!--
    begin: template revamp > initialise program
    -->
    <?php
    include('document_handler/sql_templates.php');

    $system_base_url = $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['SERVER_NAME'] . ':' . $_SERVER['SERVER_PORT'] . '/';
    $template_base_url = $system_base_url . 'system-management-vic/template-listing-vic/template-manage-vic';
    $current_script_base_url = urlencode($system_base_url . substr($_SERVER['REQUEST_URI'], 1));

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





<!-- Notes Content Tab -->
<div id="tabs_wrapper" class="notes-tab" >
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
    
    <!-- Notes Tab --> 
    <div id="notes" class="tab_content" style="display: block;"> 
      <table id="tbl-notes">
        <?php  $userName = $user->get( 'name' ); ?>
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
$resultnotes = mysql_query("SELECT cf_id, datenotes, username, content, date_created FROM ver_chronoforms_data_notes_vic WHERE clientid = '$ClientID' ORDER by cf_id DESC");
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
        
    <!---------------------------------------------- END of Notes Tab -->
    
    
    <!---------------------------------------------------- Sales Tab  -->
    
    <div id="sales" class="tab_content"> 
      <!-- sales template documents section -->
      <!-- hide and make way for revamped template modules
      <div class="modification-button-holder"> 
          <a id="template_link" rel="nofollow" title="PDF" onclick="window.open(this.href,'win2','status=no,toolbar=no,scrollbars=yes,titlebar=no,menubar=no,resizable=yes,width=auto,height=auto,directories=no,location=no'); return false;" href="index.php?cf_id=<?php echo $cf_id; ?>&pid=<?php echo $ClientID; ?>&option=com_chronoforms&tmpl=component&chronoform=TemplateResidential_With_Frame" style="margin-right:5px;">Residential – Frame</a>
          <a id="template_link" rel="nofollow" title="PDF" onclick="window.open(this.href,'win2','status=no,toolbar=no,scrollbars=yes,titlebar=no,menubar=no,resizable=yes,width=auto,height=auto,directories=no,location=no'); return false;" href="index.php?cf_id=<?php echo $cf_id; ?>&pid=<?php echo $ClientID; ?>&option=com_chronoforms&tmpl=component&chronoform=TemplateResidential_With_No_Frame" style="margin-right:5px;">Residential – No Frame</a> 
          <a id="template_link" href="<?php echo JURI::base().'images/template/welcome_book.pdf'; ?> " download  style="margin-right:5px;">Welcome Book</a>

          <a id="template_link" rel="nofollow" title="PDF" onclick="window.open(this.href,'win2','status=no,toolbar=no,scrollbars=yes,titlebar=no,menubar=no,resizable=yes,width=auto,height=auto,directories=no,location=no'); return false;" href="index.php?cf_id=<?php echo $cf_id; ?>&pid=<?php echo $ClientID; ?>&option=com_chronoforms&tmpl=component&chronoform=Sales_Contract" style="margin-right:5px;">Sales Contract - Residential</a>
          <a id="template_link" rel="nofollow" title="PDF" onclick="window.open(this.href,'win2','status=no,toolbar=no,scrollbars=yes,titlebar=no,menubar=no,resizable=yes,width=auto,height=auto,directories=no,location=no'); return false;" href="index.php?cf_id=<?php echo $cf_id; ?>&pid=<?php echo $ClientID; ?>&option=com_chronoforms&tmpl=component&chronoform=Clients_Authority" style="margin-right:5px;">Clients Authority</a>
          <a id="template_link" rel="nofollow" title="PDF" onclick="window.open(this.href,'win2','status=no,toolbar=no,scrollbars=yes,titlebar=no,menubar=no,resizable=yes,width=auto,height=auto,directories=no,location=no'); return false;" href="index.php?cf_id=<?php echo $cf_id; ?>&pid=<?php echo $ClientID; ?>&option=com_chronoforms&tmpl=component&chronoform=Colour_Chart" style="margin-right:5px;">Colour Chart</a>
          
          <a id="template_link" rel="nofollow" title="PDF" onclick="window.open(this.href,'win2','status=no,toolbar=no,scrollbars=yes,titlebar=no,menubar=no,resizable=yes,width=auto,height=auto,directories=no,location=no'); return false;" href="index.php?cf_id=<?php echo $cf_id; ?>&pid=<?php echo $ClientID; ?>&option=com_chronoforms&tmpl=component&chronoform=Contract_Variation_Letter" style="margin-right:5px;">Contract Variation Letter</a>
      </div>
      -->





      <!--
      begin: template revamp > template download list > client folder > sales
      -->
      <div class="modification-button-holder" style="background-color: #cccccc;">
          <?php
          $template_module = 'template';
          $template_entity_name = 'Client Folder';
          $template_folder_name = 'Sales';
          $template_content_category = 'Template';
          $template_download_option = 'dl_dm';
          $adhoc_entity_name = $client_id_prefix . $_REQUEST['pid'];

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
      end: template revamp > template download list > client folder > sales
      -->





      <br />
      <div class="drawing-tbl">
        <table class="tbl-pdf">
          <tr>
            <th>Filename</th>
            <th>Date Created</th>
            <th>Download PDF</th>
            <th>Uploaded Doc</th> 
            <th><input type="button" class="bbtn" name="button_sales_document_list_refresh" id="button_sales_document_list_refresh" value="Refresh" onclick="location.reload()" /></th> 
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
        echo "</td>"; 
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
        begin: template revamp > edited template download list > client folder > sales
        -->
        <?php
        $template_module = 'template_applied';
        $template_entity_name = $client_id_prefix . $_REQUEST['pid'];
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
        end: template revamp > edited template download list > client folder > sales
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
      <!-- hide and make way for revamped template modules
        <a id="template_link" rel="nofollow" title="PDF" onclick="window.open(this.href,'win2','status=no,toolbar=no,scrollbars=yes,titlebar=no,menubar=no,resizable=yes,width=auto,height=auto,directories=no,location=no'); return false;" href="index.php?cf_id=<?php echo $cf_id; ?>&pid=<?php echo $ClientID; ?>&option=com_chronoforms&tmpl=component&chronoform=Proposed_Drawings" style="margin-right:5px;">Proposed Drawings</a>
      -->
        <!-- <a id="template_link" href="<?php echo JURI::base().'images/template/amended_proposed_drawings.docx'; ?> " download  style="margin-right:5px;">Amended Proposed Drawings</a>  -->
      <!-- hide and make way for revamped template modules
        <a id="template_link" rel="nofollow" title="PDF" onclick="window.open(this.href,'win2','status=no,toolbar=no,scrollbars=yes,titlebar=no,menubar=no,resizable=yes,width=auto,height=auto,directories=no,location=no'); return false;" href="index.php?cf_id=<?php echo $cf_id; ?>&pid=<?php echo $ClientID; ?>&option=com_chronoforms&tmpl=component&chronoform=Amended_Proposed_Drawings" style="margin-right:5px;">Amended Proposed Drawings</a>
        <a id="template_link" rel="nofollow" title="PDF" onclick="window.open(this.href,'win2','status=no,toolbar=no,scrollbars=yes,titlebar=no,menubar=no,resizable=yes,width=auto,height=auto,directories=no,location=no'); return false;" href="index.php?cf_id=<?php echo $cf_id; ?>&pid=<?php echo $ClientID; ?>&option=com_chronoforms&tmpl=component&chronoform=Proposed_Drawing_Rescode" style="margin-right:5px;">Proposed Drawing Rescode</a><br/>
        <a id="template_link" rel="nofollow" title="PDF" onclick="window.open(this.href,'win2','status=no,toolbar=no,scrollbars=yes,titlebar=no,menubar=no,resizable=yes,width=auto,height=auto,directories=no,location=no'); return false;" href="index.php?cf_id=<?php echo $cf_id; ?>&pid=<?php echo $ClientID; ?>&option=com_chronoforms&tmpl=component&chronoform=Res_Code_Letter" style="margin-right:5px;">Res Code Letter</a>
        <a id="template_link" rel="nofollow" title="PDF" onclick="window.open(this.href,'win2','status=no,toolbar=no,scrollbars=yes,titlebar=no,menubar=no,resizable=yes,width=auto,height=auto,directories=no,location=no'); return false;" href="index.php?cf_id=<?php echo $cf_id; ?>&pid=<?php echo $ClientID; ?>&option=com_chronoforms&tmpl=component&chronoform=Protection_Work_Notice_Client" style="margin-right:5px;">Protection Work Notice Client</a>
        <a id="template_link" rel="nofollow" title="PDF" onclick="window.open(this.href,'win2','status=no,toolbar=no,scrollbars=yes,titlebar=no,menubar=no,resizable=yes,width=auto,height=auto,directories=no,location=no'); return false;" href="index.php?cf_id=<?php echo $cf_id; ?>&pid=<?php echo $ClientID; ?>&option=com_chronoforms&tmpl=component&chronoform=Protection_Work_Notice_Neighbour" style="margin-right:5px;">Protection Work Notice Neighbour</a>
        <a id="template_link" href="<?php echo JURI::base().'images/template/protection_work_notice_forms.pdf'; ?> " download  style="margin-right:5px;">Protection Work Notice forms</a>
      </div>
      -->




      <!--
      begin: template revamp > template download list > client folder > correspondence
      -->
      <div class="modification-button-holder" style="background-color: #cccccc;">
          <?php
          $template_module = 'template';
          $template_entity_name = 'Client Folder';
          $template_folder_name = 'Correspondence';
          $template_content_category = 'Template';
          $template_download_option = 'dl_dm';
          $adhoc_entity_name = $client_id_prefix . $_REQUEST['pid'];

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
      end: template revamp > template download list > client folder > correspondence
      -->





      <br/>

        <div class="drawing-tbl">
          <table class="tbl-pdf">
            <tr>
              <th>Filename</th>
              <th>Date Created</th>
              <th>Download PDF</th> 
              <th>Uploaded Doc</th>  
              <th><input type="button" class="bbtn" name="button_sales_document_list_refresh" id="button_sales_document_list_refresh" value="Refresh" onclick="location.reload()" /></th> 
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
          begin: template revamp > edited template download list > client folder > correspondence
          -->
          <?php
          $template_module = 'template_applied';
          $template_entity_name = $client_id_prefix . $_REQUEST['pid'];
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
          end: template revamp > edited template download list > client folder > correspondence
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
    <!-------------------------------------------- END of Correspndence Doc  Tab -->


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
      begin: template revamp > template download list > client folder > statutory
      -->
      <div class="modification-button-holder" style="background-color: #cccccc;">
          <?php
          $template_module = 'template';
          $template_entity_name = 'Client Folder';
          $template_folder_name = 'Statutory';
          $template_content_category = 'Template';
          $template_download_option = 'dl_dm';
          $adhoc_entity_name = $client_id_prefix . $_REQUEST['pid'];

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
      end: template revamp > template download list > client folder > statutory
      -->





      <br/>
        <div class="drawing-tbl">
          <table class="tbl-pdf">
            <tr>
              <th>Filename</th>
              <th>Date Created</th>
              <th>Download PDF</th>
              <th>Uploaded Doc</th>
              <th><input type="button" class="bbtn" name="button_sales_document_list_refresh" id="button_sales_document_list_refresh" value="Refresh" onclick="location.reload()" /></th>
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
          begin: template revamp > edited template download list > client folder > statutory
          -->
          <?php
          $template_module = 'template_applied';
          $template_entity_name = $client_id_prefix . $_REQUEST['pid'];
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
          end: template revamp > edited template download list > client folder > statutory
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
                  // echo "<td>";
                  // if($info['has_upload_file']==1){
                  //     echo '<div> 
                  //           <ul style="list-style-type: none; margin: 5px 0 5px 10px;padding: 0;"  >';
                     
                  //       $sql = "SELECT cf_id, clientid, photo, file_name FROM ver_chronoforms_data_pics_vic WHERE clientid = '$ClientID'  AND   upload_type ='signed_gen_doc'  AND ref_id={$info['cf_id']} ";
                  //       $resultimg = mysql_query($sql);
                  //       //error_log(" 0 sql:".$sql, 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_sa\\my-error.log');
                  //       $thumbnail = "";
                  //       while($row = mysql_fetch_array($resultimg))
                  //       { 
                  //          error_log(print_r($row,true), 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_sa\\my-error.log');
                  //         if(strtolower(substr($row['photo'],-3))=="pdf"){
                  //             $thumbnail = JURI::base()."images/file_pdf.png";
                  //         }else if(strtolower(substr($row['photo'],-3))=="doc" || substr($row['photo'],-4)=="docx"){
                  //             $thumbnail = JURI::base()."images/doc_logo.png";
                  //         }else if(strtolower(substr($row['photo'],-3))=="xls" || substr($row['photo'],-4)=="xlsx"){
                  //             $thumbnail = JURI::base()."images/excel-logo.jpg";
                  //         }else{
                  //             $thumbnail = JURI::base()."images/file-icon.jpg";
                  //         } 
                  //        echo "<li><a href=\"".$row['photo']."\" download class='remove-link'>  <img src=\"{$thumbnail}\" height=\"20px\" style='display:inline'> ".$row['file_name']."</a>    <span class=\"ui-icon ui-icon-closethick\" style='display:inline-block; cursor: pointer;' onclick=\"if(confirm('Are you sure you want to delete?')){"."$('#picid').val('".$row["cf_id"]."'); $('#btn_picid').click();}\"   > </span></li>";
                  //       }
                  //     echo "</ul>
                  //     </div>";
                   
                  // } 
                  // Print "<input type='file' name='signed_doc[]' multiple='multiple' accept='.jpg,.png,.bmp,.gif,.pdf, .doc, .docx, .xls, .xlsx, .odt'> 
                  //             <input type='button' value='Save' id='' name='' class='bbtn btn-delete' onclick=' $(\"#upload_type\").val(\"signed_gen_doc\"); $(\"#doc_id\").val(\"".$row["cf_id"]."\"); $(\"#chronoform_Client_Folder_Vic\").submit();'>  "; 
                  // echo "</td>";
                  
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

    <!-- ----- Special Conditions Tab ----- -->
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

    <!----------------------------------------- End of All Tab Content -->
    
    </div>
  </div>
</div>


<div id="tabs_wrapper" class="button-tab">
   <?php if(isset($_REQUEST['ref'])){ ?>
      <input type="button" value="Close" id="bcbtn" name="close" class="bbtn" onClick="window.history.back();" value='Cancel'> 
      <!--<input type="button" value="Close" id="bcbtn" name="close" class="bbtn" onClick="window.opener=null; window.close(); return false;" value='Cancel'>  -->
      <!-- <input type="submit" value="Save" id="bsbtn" name="save_dialog" class="bbtn" onClick="window.opener=null; window.close(); return false;"> -->

        <?php //process user_access_profiles
        if ($current_signed_in_user_access_profiles['record action']['save'] == true) {
        ?>
            <input type="submit" value="Save" id="save_client_folder" name="save" class="btn">
        <?php } //end if?>

      <input type="hidden" value="" id="ref" name="ref" class="bbtn">
       
    <?php }else{ ?> 

        <?php //process user_access_profiles
        if ($current_signed_in_user_access_profiles['record action']['delete'] == true) {
        ?>
            <input type="submit" value="Delete" id="btnDeleteClient" name="delete" class="bbtn btn-delete" style="width:190px;"  > 
        <?php } //end if?>

        <?php //process user_access_profiles
        if ($current_signed_in_user_access_profiles['record action']['save'] == true) {
        ?>
            <input type="submit" value="Save" id="save_client_folder" name="save" class="bbtn submit-look btn-save" style="width: 190px;"  >
        <?php } //end if?>

      <input type="submit" value="Close" id="bcbtn" name="close" class="bbtn" >
    <?php } ?>
 
</div>
</form>

<form method="post" class="" id="form_pdf">  
    <input type="hidden" name="delete_pdf"  />
    <input type="hidden" name="pdf_cf_id" id="pdf_cf_id"  /> 
</form>
 

<script type="text/javascript">

 
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
  
  var url = window.location.href;
  var ref = url.split("?");
  if(ref.length>1){
    
     //alert("inside");
     // alert(ref[1]);
       $("#ref").val(ref[1]);
  }

  //alert(ref);
  // $(".disabled-div input" ).prop( "disabled", true );
  // $(".disabled-div select" ).prop( "disabled", true );

 
  
  });

var noteinfo=new ddtabcontent("notes-tabs")
noteinfo.setpersist(true)
noteinfo.setselectedClassTarget("link") //"link" or "linkparent"
noteinfo.init();

$('#btnDeleteClient').click(function(evt){
  if(1==<?php echo $has_contract;?>){alert("Can't delete client with existing contract."); evt.preventDefault(); return false;}else{return confirm('Are you sure you want to delete this client?');}
});

function delete_pdf_letter(event,o){
  if(confirm('Are you sure you want to delete?')){
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
            //$(o).parent().parent("li").slideUp(250, function(){ $(this).remove() } );

          }else{
            $("#notification .message").show().addClass('error'); 
          }
   

        }   
      });

      return false;
    }
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

  
function setCostingStatusAndSubmit(status)
{
    if (status.toLowerCase() == 'lost') {
        var prompt_response = prompt('Please enter reason for losing this contract:');
        if (prompt_response) {
            $("#contract_lost_reason").val(prompt_response);
        } else {
            return false;
        }
    }

    $("#costing_status").val(status);//alert(status);
    $("#save_client_folder").click();
}

</script>
 



</body>
</html>