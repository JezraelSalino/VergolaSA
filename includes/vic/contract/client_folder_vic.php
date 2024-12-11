<?php  
date_default_timezone_set('Australia/Victoria');



$form->data['date_entered'] = date(PHP_DFORMAT);
$form->data['date_time'] = date(PHP_DFORMAT.' g:i A');

$id = isset($_REQUEST['pid'])?$_REQUEST['pid']:"";
$pid = isset($_REQUEST['pid'])?$_REQUEST['pid']:"";
$cid = isset($_REQUEST['quoteid'])?$_REQUEST['quoteid']:"";   
$cid = isset($_REQUEST['cid'])?$_REQUEST['cid']:""; 
$has_contract = 0;
 
 
$cf_id = "0";
if(isset($_REQUEST['cf_id']) && $_REQUEST['cf_id']>0){
  $cf_id = mysql_real_escape_string($_REQUEST['cf_id']);
}



$drawid = isset($_POST['drawingid']) ? $_POST['drawingid'] : NULL;
$picid = isset($_POST['picid']) ? $_POST['picid'] : NULL;
$fileid = isset($_POST['fileid']) ? $_POST['fileid'] : NULL;

if(!empty($cid)){ //this is the query if the reference client id is cid based on client_id favor for old and new client id. if pid the system design query client based on pid.
  $result = mysql_query("SELECT * FROM ver_chronoforms_data_clientpersonal_vic WHERE clientid  = '$cid'");
  //error_log("1: ", 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_us\\my-error.log'); 
}else{
  $result = mysql_query("SELECT * FROM ver_chronoforms_data_clientpersonal_vic WHERE pid  = '$id'");
  //error_log("SELECT * FROM ver_chronoforms_data_clientpersonal_vic WHERE pid  = '$id' ", 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_us\\my-error.log'); 
}


$retrieve = mysql_fetch_array($result);
//error_log(" retrieve: ", print_r($retrieve,true),'C:\\xampp\htdocs\\vergola_contract_system_v4_us\\my-error.log'); 

if (!$result) 
{
die("Error: Data not found..");
} 

  $id = $retrieve['pid'];
  $pid = $retrieve['pid'];  

  $ClientSuburbID = $retrieve['client_suburbid'] ;
	$ClientSuburbID = $retrieve['client_suburbid'] ;
	$ClientTitle = $retrieve['client_title'];
	$ClientFirstName = $retrieve['client_firstname'];
	$ClientLastName = $retrieve['client_lastname'];
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
  $Status = $retrieve['status'] ;    
	
	
	$SiteTitle = $retrieve['site_title'];
	$SiteFirstName = $retrieve['site_firstname'];
	$SiteLastName = $retrieve['site_lastname'];
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
  //error_log("DateLodged: ".$DateLodged, 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_us\\my-error.log');  
	$datepoint = $retrieve['appointmentdate'];
  $AppointmentLodged = "";
  //error_log("DateLodged: ".$DateLodged, 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_us\\my-error.log');  
  //  error_log(" strtotime: ".strtotime($datepoint), 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_us\\my-error.log');  
  if(strtotime($datepoint) != 0){
    $AppointmentLodged = date(PHP_DFORMAT.' @ h:i A', strtotime($datepoint));
  }
  //error_log(" AppointmentLodged: ".$AppointmentLodged, 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_us\\my-error.log'); 
    
  $RepID = $retrieve['repid'];
	$RepIdent = $retrieve['repident'];
  $rep_id = $retrieve['repident'];
	$RepName = $retrieve['repname'];
	
	$LeadID = $retrieve['leadid'];
	$LeadName = $retrieve['leadname'];
	
	$EmployeeID = $retrieve['employeeid'];
	$ClientID = $retrieve['clientid'];
	$QuoteID = $ClientID;

  $now = time();  
  $datestamp = date(PHP_DFORMAT." h:i:sa");

if(isset($_POST['save'])) // save note created part
{	

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

  //This is the Time Save 
   
   	
}


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

         
         
          
          //error_log(print_r($file_name,true), 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_us\\my-error.log'); 

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


 
  //error_log("HERE a1", 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_us\\my-error.log'); 
if(isset($_FILES['doc'])){  //Upload file from Files tab
      //error_log("RepIdent:".$RepIdent, 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_us\\my-error.log');
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
          
          //error_log($ext, 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_us\\my-error.log'); 

      if (move_uploaded_file($tmp_name, $target)) {

  $query = "INSERT INTO ver_chronoforms_data_pics_vic (clientid, datestamp, photo, upload_type, file_name) VALUES  ('$ClientID', '$datestamp', '$target','file','{$file_name}')";
   mysql_query($query) or trigger_error("Insert failed: " . mysql_error());
      //error_log($query, 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_us\\my-error.log'); 
              
              }
      }
 }


if(isset($_FILES['signed_doc'])){  //Upload file from Files tab
      error_log(print_r($_POST,true), 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_us\\my-error.log');
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
          
          //error_log($ext, 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_us\\my-error.log'); 

      if (move_uploaded_file($tmp_name, $target)) {

        //$query = "UPDATE  ver_chronoforms_data_letters_vic SET uploaded_filename='{$file_name}' WHERE cf_id={$doc_id} ";
         $query = "INSERT INTO ver_chronoforms_data_pics_vic (clientid, datestamp, photo, upload_type, file_name, ref_id) VALUES  ('$ClientID', '$datestamp', '$target','signed_doc','{$file_name}', {$doc_id})";
         mysql_query($query) or trigger_error("Insert failed: " . mysql_error());
        error_log($query, 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_us\\my-error.log'); 
              
              }
      }

      $query = "UPDATE  ver_chronoforms_data_letters_vic SET has_upload_file=1 WHERE cf_id={$doc_id} ";
      mysql_query($query) or trigger_error("Insert failed: " . mysql_error());

 }  

   
 

//error_log(print_r($_POST,true), 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_us\\my-error.log');
if(isset($_POST['delete_pdf']))
{ 
  $cf_id = $_POST['pdf_cf_id'];
  //error_log('cf_id: '.$cf_id, 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_us\\my-error.log');
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
	
	header('Location:'.JURI::base().'client-listing-vic');	
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

$ref = ($retrieve['is_builder']=="1"?"builder-listing-vic/builder-folder-vic?pid={$pid}&is_builder=1":"client-listing-vic/client-folder-vic?pid={$pid}&is_builder=0");  

if(isset($_POST['close']))
{	
	header('Location:'.JURI::base().'client-listing-vic');		
}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Client Folder</title>
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
</head>
 
<body>
<form method="post" enctype="multipart/form-data" class="Chronoform hasValidation" id="chronoform_Client_Folder_Vic">
<div id="tabs_wrapper" class="client-builder-tab">
  <div id="tabs_container">
    <ul id="client-builder-tabs" class="shadetabs">
      <li><a href="#" rel="client" class="selected" id="list-detail">Client Details</a></li>
    </ul>
  </div>
  <div id="tabs_content_container"> 
    
    <!-- Client Tab -->
    <div id="client" class="tab_content" style="display: block;">
      <div id="client-layer">
        <p><?php echo $retrieve['clientid']; ?></p>
        <?php if($retrieve['is_builder']==1){ ?>
            <p><?php echo $retrieve['builder_name']; ?>  &nbsp; <a href ="<?php echo JURI::base()."new-builder-enquiry-vic?pid={$pid}&client_type=b&ref=builder-listing-vic/builder-folder-vic?pid={$pid}"; ?> ">Edit</a></p>
        <?php }else{ ?>    
            <p><?php echo $ClientTitle; ?> <?php echo $ClientFirstName; ?> <?php echo $ClientLastName; ?> &nbsp; <a href ="<?php echo JURI::base()."new-client-enquiry-vic?pid={$pid}&ref=client-listing-vic/client-folder-vic?pid={$pid}"; ?> ">Edit</a></p>
        <?php } ?>
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
        <p><?php echo $SiteAddress1; ?></p>
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
     <input type="button" value="Add New Costing" <?php echo "onclick=location.href='" . JURI::base() . "add-quote-vic?quoteid=". $QuoteID."&ref={$ref}'"; ?>  />
	  <?php 
      include 'includes/vic/quote/quote_vic.php'; 
     // error_log(" cf_id: ".$cf_id, 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_us\\my-error.log');
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
<div id="tabs_wrapper" class="info-tab">
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
      <?php
      // $sql = "SELECT quotedate, qdelivered, ffdate1, ffdate2, ffdate3, project_name, status FROM ver_chronoforms_data_followup_vic WHERE quoteid  = '$QuoteID' ORDER BY FIELD(status,'Won','In Progress','Under Consideration','Future Project', 'Quoted','Superseded','Lost'), quotedate DESC LIMIT 1";
     
       //error_log($sql, 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_us\\my-error.log');
      //error_log($sql, 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_us\\my-error.log');
      if(isset($cf_id) && $cf_id>0){
         $sql = "SELECT * FROM ver_chronoforms_data_followup_vic WHERE cf_id={$cf_id}";
        //error_log($sql, 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_us\\my-error.log');
         $resultproject = mysql_query($sql);

    		while ($project = mysql_fetch_array($resultproject)) { 
            //error_log(print_r($project,true), 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_us\\my-error.log');
          	echo "<h1 class=\"siteproject\">Project Name: {$project['project_name']}</h1>".
    		 "<span class=\"ffinfo\"><label>Quote Date</label>:".date(PHP_DFORMAT,strtotime($project['quotedate']))."</span>";
    		 if ($project['qdelivered'] != "") { echo "<span class=\"ffinfo\"><label>Quote Delivered</label>:".date(PHP_DFORMAT,strtotime($project['qdelivered']))."</span>"; }
    		 else {echo "";}
    		 if ($project['ffdate1'] != "") { echo "<span class=\"ffinfo\"><label>Follow Up 1</label>:".date(PHP_DFORMAT,strtotime($project['ffdate1']))."</span>"; }
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

<!------------------------------------------------- Notes Content Tab -->
<div id="tabs_wrapper" class="notes-tab">
  <div id="tabs_container">
    <ul id="notes-tabs" class="shadetabs">
      <li><a href="#" rel="notes" class="selected">Notes</a></li>
      <li><a href="#" rel="letter">Sales Template Quotes</a></li>
      <li><a href="#" rel="documents">Customer Template</a></li>
       <li><a href="#" rel="statdocs">Stat. Doc</a></li>
      <li><a href="#" rel="pics">Pics</a></li> 
      <!-- <li><a href="#" rel="contracts">Contract</a></li> -->
      <li><a href="#" rel="drawing">Drawing</a></li> 
      <li><a href="#" rel="files">Files</a></li>
    </ul>
  </div>
  <div id="tabs_content_container"> 
    
    <!---------------------------------------------------------------- Notes Tab -->
    <!-- Removing This Temporarily ----- <input type='button' name="btnadd" id="btnadd" value='Add Notes' onClick="addRowEntry('tbl-notes');"> -->
    <div id="notes" class="tab_content" style="display: block;">
       
      <table id="tbl-notes">
        <?php  $userName = $user->get( 'name' ); ?>
        <tr>
		  <td class="tbl-content"><textarea name="notestxt[]" id="notestxt"></textarea>
          <div class="layer-date">Date: <input type="text" id="date_display" name="date_display" class="datetime_display" value="<?php print(Date(PHP_DFORMAT)); ?>" readonly>
          <input type="hidden" id="date_notes" name="date_notes[]" class="date_time" value="<?php print(Date(PHP_DFORMAT." H:i:s")); ?>" readonly> 
          </div>
          <div class="layer-whom">By Whom: <input type="text" id="username_notes" name="username_notes[]" class="username" value="<?php echo $userName; ?>" readonly></div>  
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
        
    <!---------------------------------------------- Pics Tab -->
    <div id="pics" class="tab_content" style="display: block;">
      <!-- <INPUT type="button" value="Add Row" onclick="addRow('tbl-pic')" /> <input type="submit" name="delete-pic" value="Delete Picture" onclick="deleteRow('tbl-pic');deleteRow2('tbl-imgpic')" />   -->
      <input type="submit" name="delete-pic" id="btn_picid" value="Delete Picture"   />
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
     // error_log(print_r($row,true), 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_us\\my-error.log');
      //$file_name = $a_file_name[3];
      //error_log(substr($file_name, 0,-4), 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_us\\my-error.log');

echo "<li>  <a href=\"$row[2]\" download><img src=\"{$thumbnail}\" height=\"75px\" ></a><br/> <input type=\"checkbox\" class=\"chkpic\" name=\"chk\" value=\"$row[0]\"/> {$row['file_name']} </li>";
	}
?>
        </ul>
        <br/>
        <table id="tbl-pic" >
          <tr> 
            <td class="tbl-upload">
                <input type="file" name="pic[]" multiple="multiple" accept=".jpg,.png,.bmp,.gif,.pdf, .odt">                 
                <input type="submit" value="Save" id="bsbtn" name="save_pic" class="bbtn">  
            </td>
          </tr>
        </table>
      </div></div>
    
    <!---------------------------------------------------- Quote Letter  -->
    
    <div id="letter" class="tab_content"> 
           
          <a id="template_link" rel="nofollow" title="PDF" onclick="window.open(this.href,'win2','status=no,toolbar=no,scrollbars=yes,titlebar=no,menubar=no,resizable=yes,width=auto,height=auto,directories=no,location=no'); return false;" href="index.php?cf_id=<?php echo $cf_id; ?>&pid=<?php echo $ClientID; ?>&option=com_chronoforms&tmpl=component&chronoform=TemplateResidential_With_Frame" style="margin-right:5px;">Residential – Frame</a>
          <a id="template_link" rel="nofollow" title="PDF" onclick="window.open(this.href,'win2','status=no,toolbar=no,scrollbars=yes,titlebar=no,menubar=no,resizable=yes,width=auto,height=auto,directories=no,location=no'); return false;" href="index.php?cf_id=<?php echo $cf_id; ?>&pid=<?php echo $ClientID; ?>&option=com_chronoforms&tmpl=component&chronoform=TemplateResidential_With_No_Frame" style="margin-right:5px;">Residential – No Frame</a> 
          <a id="template_link" href="<?php echo JURI::base().'images/template/welcome_book.pdf'; ?> " download  style="margin-right:5px;">Welcome Book</a>

          <a id="template_link" rel="nofollow" title="PDF" onclick="window.open(this.href,'win2','status=no,toolbar=no,scrollbars=yes,titlebar=no,menubar=no,resizable=yes,width=auto,height=auto,directories=no,location=no'); return false;" href="index.php?cf_id=<?php echo $cf_id; ?>&pid=<?php echo $ClientID; ?>&option=com_chronoforms&tmpl=component&chronoform=Sales_Contract" style="margin-right:5px;">Sales Contract - Residential</a>
          <a id="template_link" rel="nofollow" title="PDF" onclick="window.open(this.href,'win2','status=no,toolbar=no,scrollbars=yes,titlebar=no,menubar=no,resizable=yes,width=auto,height=auto,directories=no,location=no'); return false;" href="index.php?cf_id=<?php echo $cf_id; ?>&pid=<?php echo $ClientID; ?>&option=com_chronoforms&tmpl=component&chronoform=Clients_Authority" style="margin-right:5px;">Clients Authority</a>
          <a id="template_link" rel="nofollow" title="PDF" onclick="window.open(this.href,'win2','status=no,toolbar=no,scrollbars=yes,titlebar=no,menubar=no,resizable=yes,width=auto,height=auto,directories=no,location=no'); return false;" href="index.php?cf_id=<?php echo $cf_id; ?>&pid=<?php echo $ClientID; ?>&option=com_chronoforms&tmpl=component&chronoform=Colour_Chart" style="margin-right:5px;">Colour Chart</a>
          <!-- <a id="template_link" href="<?php echo JURI::base().'images/template/authority_letter.docx'; ?> " download  style="margin-right:5px;">Clients Authority to act on behalf of Client</a>
          <a id="template_link" href="<?php echo JURI::base().'images/template/colour_chart.doc'; ?> " download  style="margin-right:5px;">Color Chart</a> -->
          <a id="template_link" rel="nofollow" title="PDF" onclick="window.open(this.href,'win2','status=no,toolbar=no,scrollbars=yes,titlebar=no,menubar=no,resizable=yes,width=auto,height=auto,directories=no,location=no'); return false;" href="index.php?cf_id=<?php echo $cf_id; ?>&pid=<?php echo $ClientID; ?>&option=com_chronoforms&tmpl=component&chronoform=Contract_Variation_Letter" style="margin-right:5px;">Contract Variation Letter</a>
          

 
          
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
error_log($sql, 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_us\\my-error.log');
while($info = mysql_fetch_array( $data )) 
{ 
  
      //error_log("db clientid: ".$info['clientid']." ClientID:".$ClientID, 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_us\\my-error.log');
      Print "<tr>";
      Print "<td> {$info['template_name']}</td> ";
      Print "<td>" . date(PHP_DFORMAT,strtotime($info['datecreated'])) . " </td>";
      Print "<td style='border:none;'><a rel=\"nofollow\" onclick=\"window.open(this.href,'win2','status=no,toolbar=no,scrollbars=yes,titlebar=no,menubar=no,resizable=yes,width=auto,height=auto,directories=no,location=no'); return false;\" href=\"index.php?pid=".$info['cf_id']."?option=com_chronoforms&tmpl=component&chronoform=Download-PDF\">Click Here <img src='".JURI::base()."templates/".$mainframe->getTemplate()."/images/file_pdf.png' /></a></td>";
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
             echo "<li><a href=\"".$row['photo']."\" download class='remove-link'>  <img src=\"{$thumbnail}\" height=\"20px\" style='display:inline'> ".$row['file_name']."</a>    <span class=\"ui-icon ui-icon-closethick\" style='display:inline-block; cursor;pointer;' onclick=\"if(confirm('Are you sure you want to delete document?')){"."$('#picid').val('".$row["cf_id"]."'); $('#btn_picid').click();}\"   > </span></li>";
            }
          echo "</ul>
          </div>";
       
      } 
      Print "<input type='file' name='signed_doc[]' multiple='multiple' accept='.jpg,.png,.bmp,.gif,.pdf, .doc, .docx, .xls, .xlsx, .odt'> 
                  
                  <input type='button' value='Save' id='' name='' class='bbtn' onclick='$(\"#doc_id\").val(\"{$info['cf_id']}\"); $(\"#chronoform_Client_Folder_Vic\").submit();'>  ";
      echo "</td>";           
      Print "<td> <a rel=\"nofollow\" onclick=\"delete_pdf_letter(event,this)\" cf_id=\"{$info['cf_id']}\" class='remove-link'  >Delete</a> </td> </tr>";
      
    
 }

 ?>
        </table>
        <input type='hidden' name='doc_id' id='doc_id' / >
      </div>
 
    </div>
    
    <!-- Contract Doc Tab -->
    <div id="contracts" class="tab_content" style="display: block;"> 
    </div>
    
    <!---------------------------------------------- Drawing Tab -->
    
    <div id="drawing" class="tab_content">
      <!--<INPUT type="button" value="Add Row" onclick="addRow('tbl-draw')" /> onclick="deleteRow('tbl-draw');deleteRow2('tbl-img')" -->
      <input type="submit" name="delete-drawing" value="Delete Drawing"  />
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
                <input type="file" name="photo[]" multiple="multiple" accept=".jpg,.png,.bmp,.gif,.pdf">
                <input type="submit" value="Save" id="bsbtn" name="save_drawing" class="bbtn">
            </td>
          </tr>
        </table>
      </div>
    </div>
    
    <!-------------------------------------------- Stat Docs -->
    <div id="statdocs" class="tab_content" style="display: block;">
        <a id="template_link" rel="nofollow" title="PDF" onclick="window.open(this.href,'win2','status=no,toolbar=no,scrollbars=yes,titlebar=no,menubar=no,resizable=yes,width=auto,height=auto,directories=no,location=no'); return false;" href="index.php?cf_id=<?php echo $cf_id; ?>&pid=<?php echo $ClientID; ?>&option=com_chronoforms&tmpl=component&chronoform=Planning_Application_Letter" style="margin-right:5px;">Planning Application Letter</a>
        <a id="template_link" rel="nofollow" title="PDF" onclick="window.open(this.href,'win2','status=no,toolbar=no,scrollbars=yes,titlebar=no,menubar=no,resizable=yes,width=auto,height=auto,directories=no,location=no'); return false;" href="index.php?cf_id=<?php echo $cf_id; ?>&pid=<?php echo $ClientID; ?>&option=com_chronoforms&tmpl=component&chronoform=Amendment_Planning_Permit" style="margin-right:5px;">Amendment Planning Permit</a>
        <a id="template_link" rel="nofollow" title="PDF" onclick="window.open(this.href,'win2','status=no,toolbar=no,scrollbars=yes,titlebar=no,menubar=no,resizable=yes,width=auto,height=auto,directories=no,location=no'); return false;" href="index.php?cf_id=<?php echo $cf_id; ?>&pid=<?php echo $ClientID; ?>&option=com_chronoforms&tmpl=component&chronoform=Replacement_Drawing_Letter" style="margin-right:5px;">Replacement Drawing Letter</a>
        <a id="template_link" rel="nofollow" title="PDF" onclick="window.open(this.href,'win2','status=no,toolbar=no,scrollbars=yes,titlebar=no,menubar=no,resizable=yes,width=auto,height=auto,directories=no,location=no'); return false;" href="index.php?cf_id=<?php echo $cf_id; ?>&pid=<?php echo $ClientID; ?>&option=com_chronoforms&tmpl=component&chronoform=Building_Appeals_Board" style="margin-right:5px;">Building Appeals Board</a> <br/>
        <a id="template_link" rel="nofollow" title="PDF" onclick="window.open(this.href,'win2','status=no,toolbar=no,scrollbars=yes,titlebar=no,menubar=no,resizable=yes,width=auto,height=auto,directories=no,location=no'); return false;" href="index.php?cf_id=<?php echo $cf_id; ?>&pid=<?php echo $ClientID; ?>&option=com_chronoforms&tmpl=component&chronoform=Build_Over_Easement" style="margin-right:5px;">Build Over Easement</a>
        <a id="template_link" rel="nofollow" title="PDF" onclick="window.open(this.href,'win2','status=no,toolbar=no,scrollbars=yes,titlebar=no,menubar=no,resizable=yes,width=auto,height=auto,directories=no,location=no'); return false;" href="index.php?cf_id=<?php echo $cf_id; ?>&pid=<?php echo $ClientID; ?>&option=com_chronoforms&tmpl=component&chronoform=Report_And_Consent" style="margin-right:5px;">Report and Consent</a>
        
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
                Print "<td style='border:none;'><a rel=\"nofollow\" onclick=\"window.open(this.href,'win2','status=no,toolbar=no,scrollbars=yes,titlebar=no,menubar=no,resizable=yes,width=auto,height=auto,directories=no,location=no'); return false;\" href=\"index.php?pid=".$info['cf_id']."?option=com_chronoforms&tmpl=component&chronoform=Download-PDF\">Click Here <img src='".JURI::base()."templates/".$mainframe->getTemplate()."/images/file_pdf.png'  /></a></td> ";
                Print "<td> <a rel=\"nofollow\" onclick=\"delete_pdf_letter(event,this)\" cf_id=\"{$info['cf_id']}\" class='remove-link'  >Delete</a> </td> </tr>";
              } 
           } 

           ?>
          </table>
        </div>

    </div>
    
    <!-------------------------------------------- Correspndence Doc  Tab -->
    <div id="documents" class="tab_content" style="display: block;"> 
       
        <!-- <a id="template_link" href="<?php echo JURI::base().'images/template/time_frame_letter.docx'; ?> " download  style="margin-right:5px;">Time frame Letter</a>         -->
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
                Print "<td style='border:none;'><a rel=\"nofollow\" href=\"index.php?pid=".$info['cf_id']."?option=com_chronoforms&tmpl=component&chronoform=Download-PDF\">Click Here <img src='".JURI::base()."templates/".$mainframe->getTemplate()."/images/file_pdf.png'  /></a></td>  ";
                 Print "<td> <a rel=\"nofollow\" onclick=\"delete_pdf_letter(event,this)\" cf_id=\"{$info['cf_id']}\" class='remove-link'  >Delete</a> </td> </tr>";
              } 
           } 

           ?>
          </table>
        </div>

    </div>  
    <div id="files" class="tab_content" style="display: block;"> 
        
          <input type="submit" name="delete-file" value="Delete File"  />
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
                  <input type="file" name="doc[]" multiple="multiple" accept=".jpg,.png,.bmp,.gif,.pdf, .doc, .docx, .xls, .xlsx, .odt"> 
                  <input type="submit" value="Save" id="btn_save_file" name="save_file" class="bbtn">  
              </td>
            </tr>
          </table>
        
    </div>
    <!----------------------------------------- End of Tab Content -->
    
    </div>
  </div>
</div>


<div id="tabs_wrapper" class="button-tab">
   <?php if(isset($_REQUEST['ref'])){ ?>
      <input type="button" value="Close" id="bcbtn" name="close" class="bbtn" onClick="window.history.back();" value='Cancel'> 
      <!--<input type="button" value="Close" id="bcbtn" name="close" class="bbtn" onClick="window.opener=null; window.close(); return false;" value='Cancel'>  -->
      <!-- <input type="submit" value="Save" id="bsbtn" name="save_dialog" class="bbtn" onClick="window.opener=null; window.close(); return false;"> -->
      <input type="submit" value="Save" id="bsbtn" name="save" class="bbtn">
      <input type="hidden" value="" id="ref" name="ref" class="bbtn">
       
    <?php }else{ ?> 
      <input type="submit" value="Delete" id="btnDeleteClient" name="delete" class="bbtn" style="width:190px;"  > 
      <input type="submit" value="Save" id="save_client_folder" name="save" class="bbtn submit-look" style="width: 190px;"  >
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

 
  
  });

var noteinfo=new ddtabcontent("notes-tabs")
noteinfo.setpersist(true)
noteinfo.setselectedClassTarget("link") //"link" or "linkparent"
noteinfo.init();

$('#btnDeleteClient').click(function(evt){
  if(1==<?php echo $has_contract;?>){alert("Can't delete client with existing contract."); evt.preventDefault(); return false;}else{return confirm('Are you sure you want to delete this client?');}
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
    $("#costing_status").val(status);//alert(status);
    $("#save_client_folder").click();
  }

</script>
 



</body>
</html>