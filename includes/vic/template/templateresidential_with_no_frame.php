<?php

$cf_id = mysql_real_escape_string($_REQUEST['cf_id']); 
$QuoteID = mysql_real_escape_string($_REQUEST['pid']);
//error_log("template residential no frame cf_id: ".$cf_id, 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_sa\\my-error.log');
//$QuoteIDAlpha = substr($QuoteID, 0, 3);
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
 
$result = mysql_query("SELECT * FROM ver_chronoforms_data_clientpersonal_vic WHERE clientid  = '$QuoteID'");
$retrieve = mysql_fetch_array($result);
 
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
 

 
	?>
<html>
<title>Builder With No Frame</title>
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
				</script>
<style>
.btn {background-color: #4285F4;
    border: 1px solid #026695;
    color: #FFFFFF;
    cursor: pointer;
    margin: 5px 0;
    padding: 2px;
    width: 190px;}
.template_img {float:right;padding:0px 20px 10px;}
.template_tbl {border:none;min-width:900px;padding:0px;border-spacing: 0;border-collapse: collapse;}
</style>
</head>
<body>
<form method="post">
<input name="clientid" id="clientid" type="hidden" value="<?php echo $QuoteID; ?>">
<input name="title" id="title" type="hidden" value="Residential with no Frame (<?php echo $QuoteID; ?>)">
<textarea name="htmlcontent" id="htmlcontent" class="mce_editable" style="width:100%;height:100%!important;">
<div style="font-family:Arial, Helvetica, sans-serif;font-size:11pt; width:700px;">
<table class="template_tbl" cellspacing="0" cellpadding="0">
	<tr>
		<td  style="font-family:Arial, Helvetica, sans-serif;font-size:11pt;width:80%;vertical-align:bottom;">
		<p><?php print(Date("d M Y")); ?></p>
		<?php echo $ClientFirstName .' '. $ClientLastName; ?> 
		<br/>
		<?php echo $ClientAddress1; ?><br/>
		<?php echo $ClientSuburb .' '. $ClientState .' '. $ClientPostCode; ?><br/>
		

		<br/><br/> 
		Our Ref <?php echo $QuoteID; ?>
		<br/><br/>

		<p>Dear <?php echo $ClientTitle.' '.$ClientLastName; ?></p>
		<br/> 
		</td><td style="width:20%">
		<img src="<?php echo JURI::base().'images/template-logo-new.jpg'; ?> " class="template_img" style="float:right;padding:0px 20px 10px; width: 120px;"/>
		</td>
	</tr>
</table>
 

<p>Thank you for allowing me the opportunity to present Vergola as a solution for your proposed new living area requirements.</p>
<br/>
<b>Task</b> 
<p>As discussed, the aim is to create an outdoor area that accommodates your family and dogs in a comfortable, controlled environment regardless of weather conditions. The proposal is to provide a versatile roof system operated by two motors, that can be individually controlled to suit your requirements.</p>

<br/> 
<b>Solution</b>
<p>I am confident that Vergola will be the perfect solution as it will afford you all of the protection of a fixed roof, whilst enabling you to have the flexibility of adjusting the Louvres to control the light and shade that affects your entertaining area as well as controlling ventilation. The unique double skinned design of the Vergola Louvres provides a great thermal break which will improve the energy efficiency of the alfresco area and provide outdoor comfort for you the dogs and your family. In the event of rain, the Vergola Louvres will shut automatically to protect the area from the elements keeping your outdoor furniture protected.</p>

<br/> 
<b>Design </b>
<p>We confirm that you will be responsible for providing the entire framework for the Vergola to our requirements. Accordingly our quote is limited to the supply and installation of the Vergola system, Vergola gutters and flashings.</p>

<br/> 
<b>Inclusions </b>
<p style="margin-left:40px;  font-style: italic; ">
* Vergola Colorbond Gutters <br/> 
* Vergola double skinned Colorbond louvers <br/> 
* Vergola aluminium end caps <br/> 
* Vergola Link bars & pivot strips  <br/> 
* Vergola Automatic switching including rain Sensor and Remote Control  <br/> 
* Vergola Link bars & pivot strips <br/> 
* Connection to your existing down pipe. <br/>  
* Vergola Automatic switching including rain Sensor and Remote Control <br/> 
* Vergola motors <br/> 
* Opaque enclosure to house Vergola control system <br/> 
(Colours – Surfmist, Shale Grey, Woodland Grey, Classic Cream or Paperbark)

</p>


<br/> 
<b>Exclusions (If Applicable) </b>
<p style="margin-left:40px;  font-style: italic; ">
	* Framework to our specifications  <br/> 
	* Colorbond Flashings <br/> 
	* Connection to your existing down pipe.  <br/> 
	* Down Pipe connection to storm water <br/> 
	* Residential Building permit <br/> 
	* Town Planning permits <br/> 
	* Fire Mods <br/> 
	* Siting Dispensations <br/>
	* Build over easements <br/>
	* Council Asset protection bonds <br/>
	* Bushfire assessments <br/>
	* any other permits or approvals over and above a standard building permit <br/> 

</p>


<br/> 
<b>Building Approval & Installation </b>
<p>
A building permit is required prior to installation of your Vergola system. Costs associated with the drawing of plans and submitting of this application as well as technical data that may be required are included in the quote. Vergola will also apply for and take out Home Owner’s Warranty insurance on your behalf. Vergola projects do not always require Planning permission but in the event that it is required, Vergola will make the necessary application on your behalf. Please note that the cost associated with such an application is not included in your contract price and will be passed on to you. Occasionally, as part of the Building Permit application, it may become necessary to apply to the Victorian Building Commission for a modification or a dispensation. Once again the costs associated with this are not included in your contract price and will be passed on to you.  Finally, in some circumstances, an Asset Protection Permit is also required by council.  The cost of this permit is not included in the quote.
</p>

<br/> 
<b>Lead Time to Delivery </b>
<p> 
Your Vergola Louvre System will be ready for installation in approximately 6 weeks or so from the date a building permit  is received (although, we will naturally seek a specific date as early as possible.) Please note that Planning Approvals or applications to the Building commission for modifications or dispensation if required can be quite a lengthy process and unfortunately a lot of this process is outside of our control once the application is submitted.  Additionally, please do appreciate that weather and supply can and does cause variables that we find difficult to control, so definitive dates are hard to advise so early in the process. Installation generally begins within 24 hours of delivery of materials to your site and in this instance will take a few days to complete. (Again the conditions play a big part). Updates can usually be obtained from our operations and scheduling people from time to time, but the actual delivery time is usually quite fluid up until the last week or so.
</p>

<br/> 
<b>Warranty & Maintenance </b>
<p> 
A 5-year unconditional warranty applies to the Vergola Louvre System and a 2-year warranty applies to the motor and electrical parts. The Louvres are manufactured from BHP Colorbond steel and there are no moving parts in the bearings, ensuring many years of virtually maintenance-free operation, apart from the occasional clean.
</p>

<br/> 
<b>Quotation </b>
<p>We are pleased to provide our quote for the supply and  installation of a </p>
<b>Cost: $ <?php echo $projectInfo['total_rrp_gst']; ?>  + GST</b>


<br/> 
<p>I trust that you have found our proposal and quotation to be an acceptable one, and we look forward to working on this project with you.</p>
<p>Kind Regards,</p>

<br/> 
<p><?php echo $RepName; ?> </p>
<p>Design Consultant</p>
<p>Vergola Victoria Pty Ltd</p>
<p>Mobile no.: <?php echo $BuildMobile; ?></p>

</div>
 
</textarea>
<input type="submit" class="btn" name="add" value="Save"> <input class="btn" type="button" value="Close" onClick="window.opener=null; window.close(); return false;">

</form>
</body>
</html>