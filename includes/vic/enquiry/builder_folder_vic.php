<?php 
date_default_timezone_set('Australia/Victoria');
$form->data['date_entered'] = date('d-M-Y');
$form->data['date_time'] = date('d-M-Y g:i A');

$id =$_REQUEST['pid'];
$pid =$_REQUEST['pid'];
$drawid = isset($_POST['drawingid']) ? $_POST['drawingid'] : NULL;
$picid = isset($_POST['picid']) ? $_POST['picid'] : NULL;
 
$result = mysql_query("SELECT * FROM ver_chronoforms_data_builderpersonal_vic WHERE pid  = '$id'");
$retrieve = mysql_fetch_array($result);
if (!$result) 
		{
		die("Error: Data not found..");
		}
	$BuildSuburbID = $retrieve['builder_suburbid'] ;
	$BuildName = $retrieve['builder_name'] ;
	$BuildContact = $retrieve['builder_contact'];					
	$BuildAddress1 = $retrieve['builder_address1'] ;
	$BuildAddress2 = $retrieve['builder_address2'] ;
	$BuildSuburb = $retrieve['builder_suburb'] ;
	$BuildState = $retrieve['builder_state'];					
	$BuildPostCode = $retrieve['builder_postcode'] ;
	$BuildWPhone = $retrieve['builder_wkphone'] ;
	$BuildMobile = $retrieve['builder_mobile'];					
	$BuildFax = $retrieve['builder_fax'] ;
	$BuildEmail = $retrieve['builder_email'] ;
	
	$SiteProject = $retrieve['site_project'];
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
	
	$date = $retrieve['datelodged'];
    $DateLodged = date('d-M-Y', strtotime($date));
	$datepoint = $retrieve['appointmentdate'];
    $AppointmentLodged = date('d-M-Y @ h:i A', strtotime($datepoint));
    $RepID = $retrieve['repid'];
	$RepIdent = $retrieve['repident'];
	$RepName = $retrieve['repname'];
	
	$LeadID = $retrieve['leadid'];
	$LeadName = $retrieve['leadname'];
	
	$EmployeeID = $retrieve['employeeid'];
	$NotesID = $retrieve['pid'];
	$ClientID = 'CR'.$NotesID;
	$BuilderID = $retrieve['builderid'];
    $QuoteID = $BuilderID;
	
if(isset($_POST['save']))
{	

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

//This is the Time Save 
$now = time();  

if(isset($_FILES['photo'])){ 

    foreach ($_FILES['photo']['tmp_name'] as $key => $tmp_name){
//This is the directory where images will be saved 
        $target="images/drawings/$now-";
        $target=$target.$_FILES['photo']['name'][$key];	
		if (move_uploaded_file($tmp_name, $target)) {

$query = "INSERT INTO ver_chronoforms_data_drawings_vic (clientid, photo) VALUES  ('$ClientID', '$target')";
 mysql_query($query) or trigger_error("Insert failed: " . mysql_error());

         		
            }
    }
}

if(isset($_FILES['pic'])){ 

    foreach ($_FILES['pic']['tmp_name'] as $key => $tmp_name){
//This is the directory where images will be saved 
        $target="images/pics/$now-";
        $target=$target.$_FILES['pic']['name'][$key];	
		if (move_uploaded_file($tmp_name, $target)) {

        $query = "INSERT INTO ver_chronoforms_data_pics_vic (clientid, datestamp, photo) VALUES  ('$ClientID', '$datestamp', '$target')";
        mysql_query($query) or trigger_error("Insert failed: " . mysql_error()); 
         		
          }
    }
}
	header('Location:'.JURI::base().'builder-listing-vic/builder-folder-vic?pid='.$id);		
}

if(isset($_POST['delete']))
{	

	mysql_query("DELETE from ver_chronoforms_data_builderpersonal_vic WHERE pid = '$id'")
				or die(mysql_error()); 
	echo "Deleted";
	
	header('Location:'.JURI::base().'builder-listing-vic');	
}

if(isset($_POST['delete-drawing'])) {
	  
	  $DrawInfo = mysql_query("SELECT * FROM ver_chronoforms_data_drawings_vic WHERE cf_id  = '$drawid'");
$RetDrawInfo = mysql_fetch_array($DrawInfo); if (!$DrawInfo) {die("Error: Data not found..");}
$RetPhoto=$RetDrawInfo['photo'];
	  
	  mysql_query("DELETE from ver_chronoforms_data_drawings_vic WHERE cf_id = '$drawid'") or die(mysql_error()); echo "Deleted";
	  
	       $file = $RetPhoto;
           if (!unlink($file))
           {
           echo ("Error deleting $file");
           }
           else
           {
           echo ("Deleted $file");
           }
	
	header('Location:'.JURI::base().'builder-listing-vic/builder-folder-vic?pid='.$id);
	  
	}
if(isset($_POST['delete-pic'])) {
	  
$DrawInfo = mysql_query("SELECT * FROM ver_chronoforms_data_pics_vic WHERE cf_id  = '$picid'");
$RetDrawInfo = mysql_fetch_array($DrawInfo); if (!$DrawInfo) {die("Error: Data not found..");}
$RetPhoto=$RetDrawInfo['photo'];
	  
	  mysql_query("DELETE from ver_chronoforms_data_pics_vic WHERE cf_id = '$picid'") or die(mysql_error()); echo "Deleted";
	  
	       $file = $RetPhoto;
           if (!unlink($file))
           {
           echo ("Error deleting $file");
           }
           else
           {
           echo ("Deleted $file");
           }
	
	header('Location:'.JURI::base().'builder-listing-vic/builder-folder-vic?pid='.$id);
	  
	}

if(isset($_POST['close']))
{	
	header('Location:'.JURI::base().'builder-listing-vic');		
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
<script type="text/javascript">
  $(document).ready(function(){
  $('.chkdraw').change(function() {
	 $('#drawingid').val($(this).val()); 
  });
  $('.chkpic').change(function() {
	 $('#picid').val($(this).val()); 
  });
  
  });
</script>
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
<form method="post" enctype="multipart/form-data" class="Chronoform hasValidation" id="chronoform_Builder_Folder_Vic">
<div id="tabs_wrapper" class="client-builder-tab">
  <div id="tabs_container">
    <ul id="client-builder-tabs" class="shadetabs">
      <li><a href="#" rel="client" class="selected" id="list-detail">Builder Details</a></li>
    </ul>
  </div>
  <div id="tabs_content_container"> 
    
    <!-- Client Tab -->
    <div id="client" class="tab_content" style="display: block;">
      <div id="client-layer">
		<p><?php echo $BuildName; ?> <?php echo $ClientLastName; ?> &nbsp; <a href ="<?php echo JURI::base()."new-builder-enquiry-vic?pid={$pid}"; ?> ">Edit</a> </p>
        <p><?php echo $BuildAddress1; ?></p>
        <?php if ($BuildAddress2!='') {echo "<p>" . $BuildAddress2 . "</p>";} else {echo "";} ?>
        <!--- Client Suburb --->
        <p><?php echo $BuildSuburb; ?> <?php echo $BuildState; ?> <?php echo $BuildPostCode; ?></p>
        <!-- End of Client Suburb ---> 
        
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
    </div>
  </div>
  <!--- End of Site Address ---> 
  
</div>
</div>
<script type="text/javascript">

var clientbuilder=new ddtabcontent("client-builder-tabs")
clientbuilder.setpersist(false)
clientbuilder.setselectedClassTarget("link") //"link" or "linkparent"
clientbuilder.init()

</script> 

<!-------------------------------------------------------- Info Quotes -------------------------------------------------------->

<div id="tabs_wrapper" class="quote-tab">
  <div id="tabs_container">
    <ul id="quote-tabs" class="shadetabs">
      <li><a href="#" rel="quote" class="selected">Quote Info</a></li>
      <!-- <li><a href="#" rel="followup">Follow Up</a></li> -->
    </ul>
  </div>
  <div id="tabs_content_container"> 
    
    <!-- Quote Tab -->
    <div id="quote" class="tab_content" style="display: block;">
      <input type="button" value="Add New Quote" <?php echo "onclick=location.href='" . JURI::base() . "add-quote-vic?quoteid=". $QuoteID. "'"; ?>  />
	  
	  <?php include 'includes/vic/quote/quote_vic.php'; ?>
    </div>
    
   
    

  </div>
</div>
<script type="text/javascript">

var quoteinfo=new ddtabcontent("quote-tabs")
quoteinfo.setpersist(false)
quoteinfo.setselectedClassTarget("link") //"link" or "linkparent"
quoteinfo.init()

</script> 
<!------------------------------------------------------------- Enquiry Tracker Tab ------------------------------------------------>
<div id="tabs_wrapper" class="info-tab">
  <div id="tabs_container">
    <ul id="tracker-tabs" class="shadetabs">
      <li><a href="#" rel="tracker" class="selected">Enquiry Tracker</a></li>
      <li><a href="#" rel="followup">Follow Up</a></li>
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
        <?php $resultproject = mysql_query("SELECT quotedate, qdelivered, ffdate1, ffdate2, ffdate3, project_name, status FROM ver_chronoforms_data_followup_vic WHERE quoteid  = '$QuoteID' ORDER BY quotedate DESC" );
  		while ($project = mysql_fetch_array($resultproject)) {
        	echo "<h1 class=\"siteproject\">Project Name: {$project['project_name']}</h1>".
  		 "<span class=\"ffinfo\"><label>Quote Date</label>:".date('d-M-Y',strtotime($project['quotedate']))."</span>";
  		 if ($project['qdelivered'] != "") { echo "<span class=\"ffinfo\"><label>Quote Delivered</label>:".date('d-M-Y',strtotime($project['qdelivered']))."</span>"; }
  		 else {echo "";}
  		 if ($project['ffdate1'] != "") { echo "<span class=\"ffinfo\"><label>Follow Up 1</label>:".date('d-M-Y',strtotime($project['ffdate1']))."</span>"; }
  		 else {echo "";}
  		 if ($project['ffdate2'] != "") { echo "<span class=\"ffinfo\"><label>Follow Up 2</label>:".date('d-M-Y',strtotime($project['ffdate2']))."</span>"; }
  		 else {echo "";}
  		 if ($project['ffdate3'] != "") { echo "<span class=\"ffinfo\"><label>Follow Up 3</label>:".date('d-M-Y',strtotime($project['ffdate3']))."</span>"; }
  		 else {echo "";}
  		 echo "<span class=\"ffinfo\"><label>Status</label>: {$project['status']}</span>";
  		}	?>
    </div>

     <!-- Quote Tab -->
    <div id="followup" class="tab_content" style="display: block;">
      <?php include 'includes/vic/quote/followup_vic.php'; ?>
    </div>
    
  </div>
</div>
<script type="text/javascript">

var trackerinfo=new ddtabcontent("tracker-tabs")
trackerinfo.setpersist(false)
trackerinfo.setselectedClassTarget("link") //"link" or "linkparent"
trackerinfo.init()

</script> 

<!------------------------------------------------- Notes Content Tab ------------------------------------------------------------>
<div id="tabs_wrapper" class="notes-tab">
  <div id="tabs_container">
    <ul id="notes-tabs" class="shadetabs">
      <li><a href="#" rel="notes" class="selected">Gen. Notes</a></li>
      <li><a href="#" rel="pics">Pics</a></li>
      <li><a href="#" rel="letter">Quote Letter</a></li>
      <li><a href="#" rel="contracts">Contract Doc</a></li>
      <li><a href="#" rel="drawing">Drawing</a></li>
      <li><a href="#" rel="statdocs">Stat. Docs</a></li>
      <li><a href="#" rel="documents">Correspondence Doc</a></li>    
    </ul>
  </div>
  <div id="tabs_content_container"> 
    
    <!---------------------------------------------------------------- Notes Tab ----------------------------------------------------->
    <!-- Removing This Temporarily ----- <input type='button' name="btnadd" id="btnadd" value='Add Notes' onClick="addRowEntry('tbl-notes');"> -->
    <div id="notes" class="tab_content" style="display: block;">
      
      <table id="tbl-notes">
        <?php $user =& JFactory::getUser(); $userName = $user->get( 'name' ); ?>
        <tr>
		  <td class="tbl-content"><textarea name="notestxt[]" id="notestxt"></textarea>
          <div class="layer-date">Date: <input type="text" id="date_display" name="date_display" class="datetime_display" value="<?php print(Date("d-M-Y")); ?>" readonly>
          <input type="hidden" id="date_notes" name="date_notes[]" class="date_time" value="<?php print(Date("Y-m-d H:i:s")); ?>" readonly> 
          </div>
          <div class="layer-whom">By Whom: <input type="text" id="username_notes" name="username_notes[]" class="username" value="<?php echo $userName; ?>" readonly></div>  
          </td>

		  </tr>
      </table>
      <table id="tbl-content">
        <?php
$resultnotes = mysql_query("SELECT cf_id, datenotes, username, content FROM ver_chronoforms_data_notes_vic WHERE clientid = '$ClientID' ORDER by datenotes DESC");
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
     <!---------------------------------------------- Pics Tab ------------------------------------------------------>

     <div id="pics" class="tab_content" style="display: block;">
      <!-- <INPUT type="button" value="Add Row" onclick="addRow('tbl-pic')" /> -->
      <INPUT type="submit" name="delete-pic" value="Delete Row" onclick="deleteRow('tbl-pic');deleteRow2('tbl-imgpic')" />
      <input type="hidden" value="" id="picid" name="picid" />
      <div id="drawing-tbl">
        <table id="tbl-imgpic">
          <?php
$resultimg = mysql_query("SELECT cf_id, clientid, photo FROM ver_chronoforms_data_pics_vic WHERE clientid = '$ClientID'");
if (!$resultimg) {
    echo 'Could not run query: ' . mysql_error();
    exit;
}

  while($row = mysql_fetch_row($resultimg))
	{

echo "<tr><td class=\"tbl-chk\"><input type=\"checkbox\" class=\"chkpic\" name=\"chk\" value=\"$row[0]\"/></td><td class=\"tbl-upload\"><a href=\"$row[2]\" download><img src=\"$row[2]\" height=\"75px\"></a></td></tr>";
	}
?>
        </table>
        <table id="tbl-pic">
          <tr>
            <td class="tbl-chk"><input type="checkbox" name="chk"/></td>
            <td class="tbl-upload">
              <input type="file" name="pic[]" multiple="multiple">
              <input type="submit" value="Save" id="bsbtn" name="save" class="bbtn">
            </td>
          </tr>
        </table>
      </div></div>
    
    <!---------------------------------------------------- Quote Letter Tab ------------------------------------------------>
    <div id="letter" class="tab_content"> 
        <!-- <a id="template_link" rel="nofollow" title="PDF" onclick="window.open(this.href,'win2','status=no,toolbar=no,scrollbars=yes,titlebar=no,menubar=no,resizable=yes,width=auto,height=auto,directories=no,location=no'); return false;" href="index.php?pid=<?php echo $ClientID; ?>&option=com_chronoforms&tmpl=component&chronoform=TemplateBuilder-NoFrame">Template Builder-No Frame</a> 
        <a id="template_link" rel="nofollow" title="PDF" onclick="window.open(this.href,'win2','status=no,toolbar=no,scrollbars=yes,titlebar=no,menubar=no,resizable=yes,width=auto,height=auto,directories=no,location=no'); return false;" href="index.php?pid=<?php echo $ClientID; ?>&option=com_chronoforms&tmpl=component&chronoform=TemplateResidential">Template Residential</a>-->

      <a id="template_link" rel="nofollow" title="PDF" onclick="window.open(this.href,'win2','status=no,toolbar=no,scrollbars=yes,titlebar=no,menubar=no,resizable=yes,width=auto,height=auto,directories=no,location=no'); return false;" href="index.php?cf_id=<?php echo $cf_id; ?>&pid=<?php echo $ClientID; ?>&option=com_chronoforms&tmpl=component&chronoform=TemplateBuilder_With_Frame" style="margin-right:5px;">Builder - Frame</a>
      <a id="template_link" rel="nofollow" title="PDF" onclick="window.open(this.href,'win2','status=no,toolbar=no,scrollbars=yes,titlebar=no,menubar=no,resizable=yes,width=auto,height=auto,directories=no,location=no'); return false;" href="index.php?cf_id=<?php echo $cf_id; ?>&pid=<?php echo $ClientID; ?>&option=com_chronoforms&tmpl=component&chronoform=TemplateBuilder_With_No_Frame" style="margin-right:5px;">Builder – No Frame</a>  
      <a id="template_link" href="<?php echo JURI::base().'images/template/Welcome_Book.pdf'; ?> " download  style="margin-right:5px;">Welcome Book</a>

      <div id="drawing-tbl">
        <table id="tbl-pdf">
          <tr>
            <td>Filename</td>
            <td>Date Created</td>
            <td>Download PDF</td>
          </tr>
          <?php 

 $data = mysql_query("SELECT * FROM ver_chronoforms_data_letters_vic WHERE template_name LIKE '%Builder with%' ORDER BY datecreated DESC ") or die(mysql_error()); 

 while($info = mysql_fetch_array( $data )) 
 { 
 if ($info['clientid'] == $ClientID) {
 Print "<tr>"; 
 Print "<td><a rel=\"nofollow\" onclick=\"window.open(this.href,'win2','status=no,toolbar=no,scrollbars=yes,titlebar=no,menubar=no,resizable=yes,width=auto,height=auto,directories=no,location=no'); return false;\" href=\"index.php?pid=".$info['cf_id']."?option=com_chronoforms&tmpl=component&chronoform=Letters_TemplateUpdate_PDF_Vic\">".$info['template_name'] . "</a></td> "; 
 Print "<td>" . date('d-M-Y',strtotime($info['datecreated'])) . " </td>";
 Print "<td style='border:none;'><a rel=\"nofollow\" onclick=\"window.open(this.href,'win2','status=no,toolbar=no,scrollbars=yes,titlebar=no,menubar=no,resizable=yes,width=auto,height=auto,directories=no,location=no'); return false;\" href=\"index.php?pid=".$info['cf_id']."?option=com_chronoforms&tmpl=component&chronoform=Download-PDF\">Click Here <img src='".JURI::base()."templates/".$mainframe->getTemplate()."/images/file_pdf.png' /></a></td> </tr>";
} 
 } 

 ?>
        </table>
      </div>
    </div>
    
    <!---------------------------------------- Contract Tab ---------------------------------------------->
    <div id="contracts" class="tab_content" style="display: block;">
        <a id="template_link" rel="nofollow" title="PDF" onclick="window.open(this.href,'win2','status=no,toolbar=no,scrollbars=yes,titlebar=no,menubar=no,resizable=yes,width=auto,height=auto,directories=no,location=no'); return false;" href="index.php?cf_id=<?php echo $cf_id; ?>&pid=<?php echo $ClientID; ?>&option=com_chronoforms&tmpl=component&chronoform=Sales_Contract_Builder" style="margin-right:5px;">Sales Contract - Builder</a>   
        <a id="template_link" rel="nofollow" title="PDF" onclick="window.open(this.href,'win2','status=no,toolbar=no,scrollbars=yes,titlebar=no,menubar=no,resizable=yes,width=auto,height=auto,directories=no,location=no'); return false;" href="index.php?cf_id=<?php echo $cf_id; ?>&pid=<?php echo $ClientID; ?>&option=com_chronoforms&tmpl=component&chronoform=Clients_Authority" style="margin-right:5px;">Clients Authority</a>
        <a id="template_link" rel="nofollow" title="PDF" onclick="window.open(this.href,'win2','status=no,toolbar=no,scrollbars=yes,titlebar=no,menubar=no,resizable=yes,width=auto,height=auto,directories=no,location=no'); return false;" href="index.php?cf_id=<?php echo $cf_id; ?>&pid=<?php echo $ClientID; ?>&option=com_chronoforms&tmpl=component&chronoform=Colour_Chart" style="margin-right:5px;">Colour Chart</a>
        <a id="template_link" rel="nofollow" title="PDF" onclick="window.open(this.href,'win2','status=no,toolbar=no,scrollbars=yes,titlebar=no,menubar=no,resizable=yes,width=auto,height=auto,directories=no,location=no'); return false;" href="index.php?cf_id=<?php echo $cf_id; ?>&pid=<?php echo $ClientID; ?>&option=com_chronoforms&tmpl=component&chronoform=Contract_Variation_Letter" style="margin-right:5px;">Contract Variation Letter</a>

        <div id="drawing-tbl">
          <table id="tbl-pdf">
            <tr>
              <td>Filename</td>
              <td>Date Created</td>
              <td>Download PDF</td>
            </tr>
            <?php 
             error_log("SELECT * FROM ver_chronoforms_data_letters_vic  WHERE template_name LIKE 'Sales Contract - Builder%' OR template_name LIKE 'Client Authority%' OR template_name LIKE 'Contract Variation Letter%'   ORDER BY datecreated DESC", 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_sa\\my-error.log');
           $data = mysql_query("SELECT * FROM ver_chronoforms_data_letters_vic  WHERE template_name LIKE 'Sales Contract - Builder%' OR template_name LIKE 'Client Authority%' OR template_name LIKE 'Contract Variation Letter%'   ORDER BY datecreated DESC") 
           or die(mysql_error()); 

           while($info = mysql_fetch_array( $data )) 
           { 

             if ($info['clientid'] == $ClientID) {                
                Print "<tr>"; 
                Print "<td>". $info['template_name'] . "</td> "; 
                Print "<td>" . date('d-M-Y',strtotime($info['datecreated'])) . " </td>";
                Print "<td style='border:none;'><a rel=\"nofollow\" onclick=\"window.open(this.href,'win2','status=no,toolbar=no,scrollbars=yes,titlebar=no,menubar=no,resizable=yes,width=auto,height=auto,directories=no,location=no'); return false;\" href=\"index.php?cf_id=<?php echo $cf_id; ?>&pid=".$info['cf_id']."?option=com_chronoforms&tmpl=component&chronoform=Download-PDF\">Click Here <img src='".JURI::base()."templates/".$mainframe->getTemplate()."/images/file_pdf.png'  /></a></td> </tr>";
              } 
           } 

           ?>
          </table>
        </div>

    </div>
    
    <!---------------------------------------------- Drawing Tab --------------------------------------------------->
    
    <div id="drawing" class="tab_content">
      <!--<INPUT type="button" value="Add Row" onclick="addRow('tbl-draw')" /> -->
      <INPUT type="submit" name="delete-drawing" value="Delete Row" onclick="deleteRow('tbl-draw');deleteRow2('tbl-img')" />
      <input type="hidden" value="" id="drawingid" name="drawingid" />
      <div id="drawing-tbl">
        <table id="tbl-img">
          <?php
$resultimg = mysql_query("SELECT cf_id, clientid, photo FROM ver_chronoforms_data_drawings_vic WHERE clientid = '$ClientID'");
if (!$resultimg) {
    echo 'Could not run query: ' . mysql_error();
    exit;
}

  while($row = mysql_fetch_row($resultimg))
	{

echo "<tr><td class=\"tbl-chk\"><input type=\"checkbox\" class=\"chkdraw\" name=\"chk\" value=\"$row[0]\"/></td><td class=\"tbl-upload\"><a href=\"$row[2]\" download><img src=\"$row[2]\" height=\"75px\"></a></td></tr>";
	}
?>
        </table>
        <table id="tbl-draw">
          <tr>
            <td class="tbl-chk"><input type="checkbox" name="chk"/></td>
            <td class="tbl-upload">
                <input type="file" name="photo[]" multiple="multiple">
                <input type="submit" value="Save" id="bsbtn" name="save" class="bbtn">  
            </td>
          </tr>
        </table>
      </div>
    </div>
    
    <!-------------------------------------------- Stat Docs -------------------------------------------------------->
    <div id="statdocs" class="tab_content" style="display: block;">
        <a id="template_link" rel="nofollow" title="PDF" onclick="window.open(this.href,'win2','status=no,toolbar=no,scrollbars=yes,titlebar=no,menubar=no,resizable=yes,width=auto,height=auto,directories=no,location=no'); return false;" href="index.php?cf_id=<?php echo $cf_id; ?>&pid=<?php echo $ClientID; ?>&option=com_chronoforms&tmpl=component&chronoform=Planning_Application_Letter" style="margin-right:5px;">Planning Application Letter</a>
        <a id="template_link" rel="nofollow" title="PDF" onclick="window.open(this.href,'win2','status=no,toolbar=no,scrollbars=yes,titlebar=no,menubar=no,resizable=yes,width=auto,height=auto,directories=no,location=no'); return false;" href="index.php?cf_id=<?php echo $cf_id; ?>&pid=<?php echo $ClientID; ?>&option=com_chronoforms&tmpl=component&chronoform=Amendment_Planning_Permit" style="margin-right:5px;">Amendment Planning Permit</a>
        <a id="template_link" rel="nofollow" title="PDF" onclick="window.open(this.href,'win2','status=no,toolbar=no,scrollbars=yes,titlebar=no,menubar=no,resizable=yes,width=auto,height=auto,directories=no,location=no'); return false;" href="index.php?cf_id=<?php echo $cf_id; ?>&pid=<?php echo $ClientID; ?>&option=com_chronoforms&tmpl=component&chronoform=Replacement_Drawing_Letter" style="margin-right:5px;">Replacement Drawing Letter</a>
        <a id="template_link" rel="nofollow" title="PDF" onclick="window.open(this.href,'win2','status=no,toolbar=no,scrollbars=yes,titlebar=no,menubar=no,resizable=yes,width=auto,height=auto,directories=no,location=no'); return false;" href="index.php?cf_id=<?php echo $cf_id; ?>&pid=<?php echo $ClientID; ?>&option=com_chronoforms&tmpl=component&chronoform=Building_Appeals_Board" style="margin-right:5px;">Building Appeals Board</a>
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
                Print "<td>" . date('d-M-Y',strtotime($info['datecreated'])) . " </td>";
                Print "<td style='border:none;'><a rel=\"nofollow\" onclick=\"window.open(this.href,'win2','status=no,toolbar=no,scrollbars=yes,titlebar=no,menubar=no,resizable=yes,width=auto,height=auto,directories=no,location=no'); return false;\" href=\"index.php?pid=".$info['cf_id']."?option=com_chronoforms&tmpl=component&chronoform=Download-PDF\">Click Here <img src='".JURI::base()."templates/".$mainframe->getTemplate()."/images/file_pdf.png'  /></a></td> </tr>";
              } 
           } 

           ?>
          </table>
        </div>

    </div>
    
    <!-------------------------------------------- Documents Tab ---------------------------------------------------->
    <div id="documents" class="tab_content" style="display: block;">
        <!-- <a id="template_link" href="<?php echo JURI::base().'images/template/time_frame_letter.docx'; ?> " download  style="margin-right:5px;">Time frame Letter</a>         -->
        <a id="template_link" rel="nofollow" title="PDF" onclick="window.open(this.href,'win2','status=no,toolbar=no,scrollbars=yes,titlebar=no,menubar=no,resizable=yes,width=auto,height=auto,directories=no,location=no'); return false;" href="index.php?cf_id=<?php echo $cf_id; ?>&pid=<?php echo $ClientID; ?>&option=com_chronoforms&tmpl=component&chronoform=Time_Frame_Letter" style="margin-right:5px;">Time Frame Letter</a>
        <!-- <a id="template_link" href="<?php echo JURI::base().'images/template/proposed_drawings_letter.docx'; ?> " download  style="margin-right:5px;">Proposed Drawings</a> -->
        <a id="template_link" rel="nofollow" title="PDF" onclick="window.open(this.href,'win2','status=no,toolbar=no,scrollbars=yes,titlebar=no,menubar=no,resizable=yes,width=auto,height=auto,directories=no,location=no'); return false;" href="index.php?cf_id=<?php echo $cf_id; ?>&pid=<?php echo $ClientID; ?>&option=com_chronoforms&tmpl=component&chronoform=Proposed_Drawings" style="margin-right:5px;">Proposed Drawings</a>
        <!-- <a id="template_link" href="<?php echo JURI::base().'images/template/amended_proposed_drawings.docx'; ?> " download  style="margin-right:5px;">Amended Proposed Drawings</a>  -->
        <a id="template_link" rel="nofollow" title="PDF" onclick="window.open(this.href,'win2','status=no,toolbar=no,scrollbars=yes,titlebar=no,menubar=no,resizable=yes,width=auto,height=auto,directories=no,location=no'); return false;" href="index.php?cf_id=<?php echo $cf_id; ?>&pid=<?php echo $ClientID; ?>&option=com_chronoforms&tmpl=component&chronoform=Amended_Proposed_Drawings" style="margin-right:5px;">Amended Proposed Drawings</a>
        <a id="template_link" rel="nofollow" title="PDF" onclick="window.open(this.href,'win2','status=no,toolbar=no,scrollbars=yes,titlebar=no,menubar=no,resizable=yes,width=auto,height=auto,directories=no,location=no'); return false;" href="index.php?cf_id=<?php echo $cf_id; ?>&pid=<?php echo $ClientID; ?>&option=com_chronoforms&tmpl=component&chronoform=Proposed_Drawing_Rescode" style="margin-right:5px;">Proposed Drawing Rescode</a>
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
                Print "<td>" . date('d-M-Y',strtotime($info['datecreated'])) . " </td>";
                Print "<td style='border:none;'><a rel=\"nofollow\" onclick=\"window.open(this.href,'win2','status=no,toolbar=no,scrollbars=yes,titlebar=no,menubar=no,resizable=yes,width=auto,height=auto,directories=no,location=no'); return false;\" href=\"index.php?pid=".$info['cf_id']."?option=com_chronoforms&tmpl=component&chronoform=Download-PDF\">Click Here <img src='".JURI::base()."templates/".$mainframe->getTemplate()."/images/file_pdf.png'  /></a></td> </tr>";
              } 
           } 

           ?>
          </table>
        </div> 
      </div>
    
       <!----------------------------------------- End of Tab Content -------------------------------------------------->
    
    </div>
  </div>
</div>
<script type="text/javascript">

var noteinfo=new ddtabcontent("notes-tabs")
noteinfo.setpersist(true)
noteinfo.setselectedClassTarget("link") //"link" or "linkparent"
noteinfo.init()

</script>
<div id="tabs_wrapper" class="button-tab">
  <input type="submit" value="Delete" id="bsbtn" name="delete" class="bbtn">
  <input type="submit" value="Close" id="bcbtn" name="close" class="bbtn">
  <input type="submit" value="Save" id="bsbtn" name="save" class="bbtn">
</div>
</form>
</body>
</html>