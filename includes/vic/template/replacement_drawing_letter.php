<?php
$cf_id = mysql_real_escape_string($_REQUEST['cf_id']); 
$QuoteID =$_REQUEST['pid'];
$QuoteIDAlpha = substr($QuoteID, 0, 3);
$current_date = date('Y-m-d H:i:s');
if(isset($_POST['add']))
{	
    $template_clientid=$_POST['clientid'];
	$template_title=$_POST['title'] ;
	$template_content=addslashes($_POST['htmlcontent']);
    
	mysql_query("INSERT INTO ver_chronoforms_data_letters_vic (clientid, template_name, datecreated, template_content) 
		 VALUES ('$template_clientid','$template_title', '$current_date', '$template_content')");
			
    echo('<script language="Javascript">opener.window.location.reload(false); window.close();</script>');
	
}


$resulProject = mysql_query("SELECT * FROM ver_chronoforms_data_followup_vic WHERE cf_id  = '{$cf_id}'");
$projectInfo = mysql_fetch_array($resulProject);



if($QuoteIDAlpha == "CRV") {
$result = mysql_query("SELECT * FROM ver_chronoforms_data_clientpersonal_vic WHERE clientid  = '$QuoteID'");
$retrieve = mysql_fetch_array($result);
if (!$result) 
{
die("Error: Data not found..");
}
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
	$ClientFax = $retrieve['client_fax'];
	$ClientEmail = $retrieve['client_email'];
	
	
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
	$SiteFax = $retrieve['site_fax'];
	$SiteEmail = $retrieve['site_email'];
	
	$date = $retrieve['datelodged'];
    $DateLodged = date(PHP_DFORMAT, strtotime($date));
    $RepID = $retrieve['repid'];
	$RepIdent = $retrieve['repident'];
	$RepName = $retrieve['repname'];
	
	$LeadID = $retrieve['leadid'];
	$LeadName = $retrieve['leadname'];
	
	$EmployeeID = $retrieve['employeeid'];
	$ClientID = $retrieve['clientid']; 
} 
else {
// error_log("SELECT * FROM ver_chronoforms_data_builderpersonal_vic WHERE builderid  = '$QuoteID'", 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_sa\\my-error.log'); 
$resultb = mysql_query("SELECT * FROM ver_chronoforms_data_builderpersonal_vic WHERE builderid  = '$QuoteID'");
$retrieveb = mysql_fetch_array($resultb);
if (!$resultb) 
		{
		die("Error: Data not found..");
		}
	$BuildSuburbID = $retrieveb['builder_suburbid'] ;
	$BuildName = $retrieveb['builder_name'] ;
	$BuildContact = $retrieveb['builder_contact'];					
	$BuildAddress1 = $retrieveb['builder_address1'] ;
	$BuildAddress2 = $retrieveb['builder_address2'] ;
	$BuildSuburb = $retrieveb['builder_suburb'] ;
	$BuildState = $retrieveb['builder_state'];					
	$BuildPostcode = $retrieveb['builder_postcode'] ;
	$BuildWPhone = $retrieveb['builder_wkphone'] ;
	$BuildMobile = $retrieveb['builder_mobile'];					
	$BuildFax = $retrieveb['builder_fax'] ;
	$BuildEmail = $retrieveb['builder_email'] ;
	
	$SiteTitle = $retrieveb['site_title'];
	$SiteFirstName = $retrieveb['site_firstname'];
	$SiteLastName = $retrieveb['site_lastname'];
	$SiteAddress1 = $retrieveb['site_address1'];
	$SiteAddress2 = $retrieveb['site_address2'];
	$SiteSuburbID = $retrieveb['site_suburbid'];
	$SiteSuburb = $retrieveb['site_suburb'];
	$SiteState = $retrieveb['site_state'];
	$SitePostcode = $retrieveb['site_postcode'];
	$SiteWKPhone = $retrieveb['site_wkphone'];
	$SiteHMPhone = $retrieveb['site_hmphone'];
	$SiteMobile = $retrieveb['site_mobile'];
	$SiteFax = $retrieveb['site_fax'];
	$SiteEmail = $retrieveb['site_email'];
	
	$date = $retrieveb['datelodged'];
    $DateLodged = date(PHP_DFORMAT, strtotime($date));
    $RepID = $retrieveb['repid'];
	$RepIdent = $retrieveb['repident'];
	$RepName = $retrieveb['repname'];
	
	$LeadID = $retrieveb['leadid'];
	$LeadName = $retrieveb['leadname'];
	
	$EmployeeID = $retrieveb['employeeid'];
	$ClientID = $retrieveb['builderid'];
} 
 
 

	?>
<html>
<title>Replacement Drawing Letter</title>
<head>
<script src="<?php echo JURI::base().'media/editors/tinymce/jscripts/tiny_mce/tiny_mce.js'; ?>" type="text/javascript"></script>
<script type="text/javascript">
				tinyMCE.init({
					// General
					dialog_type : "modal",
					directionality: "ltr",
					editor_selector : "mce_editable",
					language : "en",
					mode : "specific_textareas",
					plugins : "paste,searchreplace,insertdatetime,table,emotions,media,advhr,directionality,fullscreen,layer,style,xhtmlxtras,visualchars,visualblocks,nonbreaking,wordcount,template,advimage,advlink,advlist,autosave,contextmenu,inlinepopups",
					skin : "default",
					theme : "advanced",
					// Cleanup/Output
					inline_styles : true,
					gecko_spellcheck : true,
					entity_encoding : "raw",
					extended_valid_elements : "hr[id|title|alt|class|width|size|noshade|style],img[class|src|border=0|alt|title|hspace|vspace|width|height|align|onmouseover|onmouseout|name|style],a[id|class|name|href|hreflang|target|title|onclick|rel|style]",
					force_br_newlines : false, force_p_newlines : true, forced_root_block : 'p',
					invalid_elements : "script,applet",
					// URL
					relative_urls : true,
					remove_script_host : false,
					document_base_url : "<?php echo JURI::base(); ?>",
					//Templates
					template_external_list_url : "<?php echo JURI::base().'media/editors/tinymce/templates/template_list.js'; ?>",
					// Layout
					content_css : "<?php echo JURI::base().'templates/system/css/editor.css'; ?>",
					// Advanced theme
					theme_advanced_toolbar_location : "top",
					theme_advanced_toolbar_align : "left",
					theme_advanced_source_editor_height : "550",
					theme_advanced_source_editor_width : "750",
					theme_advanced_resizing : true,
					theme_advanced_resize_horizontal : false,
					theme_advanced_statusbar_location : "bottom", theme_advanced_path : true,
					theme_advanced_buttons1_add_before : "",
					theme_advanced_buttons2_add_before : "search,replace,|",
					theme_advanced_buttons3_add_before : "tablecontrols",
					theme_advanced_buttons1_add : "fontselect,fontsizeselect",
					theme_advanced_buttons2_add : "insertdate,inserttime,forecolor,backcolor,fullscreen",
					theme_advanced_buttons3_add : "emotions,media,advhr,ltr,rtl",
					theme_advanced_buttons4 : "cut,copy,paste,pastetext,pasteword,selectall,|,insertlayer,moveforward,movebackward,absolute,styleprops,cite,abbr,acronym,ins,del,attribs,visualchars,visualblocks,nonbreaking,blockquote,template",
					plugin_insertdate_dateFormat : "%Y-%m-%d",
					plugin_insertdate_timeFormat : "%H:%M:%S",
					fullscreen_settings : {
						theme_advanced_path_location : "top"
					}
				});

 
function submitForm() { 
    document.getElementById("add").click();
}
window.onload = submitForm;
 
				</script>
<style>
p {margin: 0;}
.btn {background-color: #4285F4;
    border: 1px solid #026695;
    color: #FFFFFF;
    cursor: pointer;
    margin: 5px 0;
    padding: 2px;
    width: 190px;}
 
.template_tbl {border:1px solid black;  min-width:900px;padding:0px; border-collapse:collapse;  }
 
</style>
</head>
<body>
<form method="post">
<input name="clientid" id="clientid" type="hidden" value="<?php echo $QuoteID; ?>">
<input name="title" id="title" type="hidden" value="Replacement Drawing Letter (<?php echo $QuoteID; ?>)">

<textarea name="htmlcontent" id="htmlcontent" class="mce_editable" style="width:100%;height:100%!important; ">
<div style="font-family:Arial, Helvetica, sans-serif; width:700px;  font-size: 11pt;">
  
<table class="template_tbl" cellspacing="0" cellpadding="0">
	<tr>
		<td valign="middle" style="font-family:Arial, Helvetica, sans-serif;font-size:11pt;width:80%;">
		 
		<p><?php print(Date("d M Y")); ?></p><br/> 
		<?php echo $BuildName; ?>  <br/> 
		<?php echo $BuildAddress1 .' '. $BuildAddress2; ?><br/>
		<?php echo $BuildSuburb .' '. $BuildState.' '. $BuildPostcode; ?><br/>
		  
	  
		<br/> 
		</td><td style="width:25%">
		<img src="<?php echo JURI::base().'images/template-logo-new.jpg'; ?> " class="template_img" style="float:right;padding:0px 20px 10px; width: 120px;"/>
		</td>
	</tr>
</table>
<p>Dear <?php echo $BuildContact; ?></p>
<br/>
<p><b>Application No:</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  PA1429706</p><br/> 

<p><b>Address:</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;    <?php echo $SiteAddress1 .' '. $SiteAddress2.' '. $SiteSuburb.' '.$SiteState.' '.$SitePostcode; ?></p>
<br/><br/><br/>

<p >
Please find replacement drawings for above property showing amended dimension to boundary.
</p><br/><br/>

<p >
If you require any further information please contact me on 8150 6888 or by email: reception@vergola.com.
</p><br/><br/><br/><br/>
 
<p>Kind Regards </p>

 <br/><br/><br/>


<b>Mary Pensa- Kaine</b> <br/>
<b>Administration </b><br/>
<b>Vergola Pty Ltd </b><br/>


 
</div> 
</textarea>
<input type="submit" class="btn" id="add" name="add" value="Save"> <input class="btn" type="button" value="Close" onClick="window.opener=null; window.close(); return false;">

</form>

</body>
</html>