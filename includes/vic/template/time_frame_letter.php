<?php

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

$clientContactName = "";


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
<title>Time Frame Letter</title>
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
<input name="title" id="title" type="hidden" value="Time Frame Letter (<?php echo $QuoteID; ?>)">

<textarea name="htmlcontent" id="htmlcontent" class="mce_editable" style="width:100%;height:100%!important; ">
<div style="font-family:Arial, Helvetica, sans-serif; width:700px;  font-size: 11pt;">
<table class="template_tbl" cellspacing="0" cellpadding="0">
	<tr>
		<td valign="middle" style="font-family:Arial, Helvetica, sans-serif;font-size:11pt;width:80%;">
		 
		<p><?php print(Date("d M Y")); ?></p><br/> 

		<?php
			if($QuoteIDAlpha == "CRV") {
				$clientContactName = $ClientTitle.' '.$ClientLastName;
		?>
			<?php echo $ClientFirstName .' '. $ClientLastName; ?>  <br/> 
			<?php echo $ClientAddress1 .' '. $SiteAddress2; ?><br/>
			<?php echo $ClientSuburb .' '. $ClientState.' '. $ClientPostCode; ?><br/>
		<?php
			}else{ 
				$clientContactName = $BuildContact;
		?>  
			<?php echo $BuildName; ?>  <br/> 
			<?php echo $BuildAddress1 .' '. $BuildAddress2; ?><br/>
			<?php echo $BuildSuburb .' '. $BuildState.' '. $BuildPostcode; ?><br/>

		<?php } ?>
		<br/> 
		</td><td style="width:25%">
		<img src="<?php echo JURI::base().'images/template-logo-new.jpg'; ?> " class="template_img" style="float:right;padding:0px 20px 10px; width: 120px;"/>
		</td>
	</tr>
</table> 
 
<br/>

Dear <?php echo $clientContactName; ?>,<br/><br/><br/>
<b>Re:   Vergola Contract</b>    </b><br/>
<br/><br/>
<p>
Thank you for making the decision to purchase a Vergola louvered roof system. You are now a part of the growing number of clients who have seen fit to make an investment improving their outdoor lifestyle. 
</p>
<br/><br/>
<p>
Please find enclosed a copy of your contract. 
</p>
<br/><br/>
<p>
As discussed, the project will now continue in accordance with the following sequence of events:  
</p>
<br/><br/>
<p>
<b><u>Stage 1 – Check Measure & Drawings</u></b>
</p>
<br/><br/>
<p><br/>
Vergola will contact you to arrange for an on-site Check Measure. This will normally be carried out by our Check Measurer and your Design Consultant. We normally prefer you be present at the Check Measure. 
</p>
<br/><br/>
<p>
Once the Check Measure is complete, our draftsperson will proceed to prepare drawings for obtaining a Building Permit and Construction.
</p>
<br/><br/>
<p>
As part of this process, we will obtain a copy of the Certificate of Title, find out if there are any encumbrances and obtain any other relevant information.
</p>
<br/><br/>
<p>
A copy of the drawing will be also sent to you. Please review the drawings carefully and advise us in the event of any discrepancy. Otherwise please sign and return a copy of the drawings to us.
</p>
<br/><br/>
<p style="float:left;">

Time frame for Stage 1: Approximately 2-3 weeks from signing.
Contact Person: Your Design Consultant

</p>
<br/><br/>
<p>
<b><u>Stage 2 – Statutory Approval</u></b>
</p>
<br/><br/>
<p> 
Once the Drawings are complete, Vergola will submit an application to our Building Surveyor for the issue of a Building Permit.
</p>
<br/><br/>
<p> 
As part of this process we will also apply and take out Home Owner’s Warranty insurance on your behalf. All of these costs are included as part of your Contract Price.
</p>
<br/><br/>
<p> 
Often Vergola projects in Victoria do not require Planning Permission but in the event that it is required, Vergola will make the necessary application on your behalf. Please note that the cost associated with such an application is not included in your Contract Price and will be passed on to you.
</p>
<br/><br/>
<p> 
In some instances as part of the Building Permit application, it may become necessary to apply to the Victorian Building Commission for a modification or a dispensation. Once again the costs associated with this are not included in your Contract Price and will be passed on to you.
</p>
<br/><br/>
<p> 
*Please note that Planning Approvals or applications to the Building commission for modifications or dispensation if required can be quite a lengthy process and unfortunately a lot of this process is outside of our control once the application is submitted. 
</p>
<br/><br/>
<p style="float:left;">
Time frame for Stage 2: Approximately 6-12 weeks
Contact Person: Your Design Consultant
</p>
<br/><br/>
<p>
<b><u>Stage 3 – Job Scheduling & Fabrication</u></b>
</p>
<br/><br/>
<p> 
Upon receipt of the Planning Approval (if required) and Building Permit your job will be scheduled. Your job will then proceed to the next stage where materials are purchased and fabricated. You will be contacted at this stage and an approximate commencement date given subject to your availability.
You will also receive your next Progress Claim Invoice.
</p>
<br/><br/>
<p style="float:left;">
Time frame for Stage 3: Depends on current work load.
Contact Person: Your Design Consultant
</p>
<br/><br/>
<p>
<b><u>Stage 4 – Delivery & Job Start</u></b>
</p>
<br/><br/>
<p> 
You will be contacted 2 days prior to commencement to confirm the job start. You will also be informed as to who the installer will be. Your Vergola will then be delivered either the day before or that morning.
In the event that the installer is delayed you will be informed by the office.
</p>
<br/><br/>
<p style="float:left;"> 
Contact Person: Your Design Consultant
</p>
<br/><br/>
<p>  
*Please note that it is essential that your progress claim is paid prior to delivery.
</p>
<br/><br/>
<p>  
*Please also ensure that our Installer has free & unlimited access to the site. They also require access to an electrical socket during the period of the installation.
</p>
<br/><br/>
<p>
<b><u>Stage 5 – Job Completion</u></b>
</p> 
<p>
Upon completion of the installation the Vergola will be commissioned. The installer will review the job together with you and get you to sign off on the completion. Any defects will be noted and rectified. 
</p>
<br/><br/>
<p>  
Your final invoice will then be issued and once payment has been made you will be contacted by your Design Consultant who will also show you how to operate your Vergola and answer any questions you may have. He will then hand over the remote.
</p>
<br/><br/>
<p>  
We will then send out a final receipt together with your Warranty Card.
</p> 
 
<br/><br/>
<p>  
We will then send out a final receipt together with your Warranty Card.
</p>
<br/><br/>
<p style="float:left;"> 
Contact Person: Your Design Consultant
</p>
<br/><br/>	
<p> 						
Over the years we have found that it is important for you to be included as part of the process. This enables you to engage in the experience of purchasing a Vergola without the worry of having to manage any stage of the process. 
</p>
<br/><br/>	
<p> 
We take this opportunity once again to thank you for your custom and for making an investment in better living please do not hesitate to contact us should you have any further queries. 
</p>
<br/><br/>	<br/><br/>	 

Kind Regards,<br/><br/>	<br/><br/>

 
<b>Jitendra Ragunath</b><br/>
<b>Managing Director</b><br/>
<b>Vergola Pty Ltd</b><br/>

 

</div> 
</textarea>
<input type="submit" class="btn" name="add" value="Save"> <input class="btn" type="button" value="Close" onClick="window.opener=null; window.close(); return false;">

</form>
</body>
</html>