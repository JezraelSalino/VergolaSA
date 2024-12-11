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
 
	?>
<html>
<title>Builder with Frame</title>
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
<input name="title" id="title" type="hidden" value="Builder with Frame - (<?php echo $QuoteID; ?>)">
<textarea name="htmlcontent" id="htmlcontent" class="mce_editable" style="width:100%;height:100%!important;">
<div style="font-family:Arial, Helvetica, sans-serif;font-size:11pt; width:700px;">
<table class="template_tbl" cellspacing="0" cellpadding="0">
	<tr>
		<td valign="bottom" style="font-family:Arial, Helvetica, sans-serif;font-size:11pt;width:80%;vertical-align:bottom;">
		<p><?php print(Date("d M Y")); ?></p>
		<?php echo $BuildContact; ?> 
		<?php if($BuildName!=''):
		echo 'Company Name '. $BuildName;
		endif; ?><br/>
		<?php echo $SiteAddress1 .' '. $SiteAddress2; ?><br/>
		<?php echo $SiteSuburb .' '. $SiteState .' '. $SitePostcode; ?><br/>
		  
		<br/>

		<p>Dear <?php echo $ClientTitle.' '.$ClientLastName; ?></p>
		<br/> 
		</td><td style="width:25%">
		<img src="<?php echo JURI::base().'images/template-logo-new.jpg'; ?> " class="template_img" style="float:right;padding:0px 20px 10px; width: 120px;"/>
		</td>
	</tr>
</table>
 
<br/>
<p><b>Re:</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b > Preliminary Quotation for a Vergola Roof and Frame System</b></p>
<p><b>Project:</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <b > A three bay installed Vergola </b></p>
<br/>
<p>Our Ref NO CRV 4517</p><br/>

<p>Thank you for your request for a quotation. </p><br/>

<p>Our quote is based on our discussion and site visit earlier today.</p><br/>

<p>We confirm that we will be responsible for suppling and installing the entire Vergola including framework.</p><br/>

<p>We are pleased to provide our quote for the supply and installation of a three bay Vergola spanning approximately 3.600m x 2.147m x three bays. Our quote is subject to a site check measure.</p><br/> 

<br/>
<p>Cost :		$<?php echo $projectInfo['total_gst']; ?> &nbsp;<b>+ GST</b></p> 
<p><b>Total Cost:	$<?php echo $projectInfo['total_rrp_gst']; ?></b></p><br/>


<p>This quote includes the supply and installation of the following:</p><br/>

<b>Inclusions:</b><br/>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;•	Vergola Colorbond louvres, gutters and flashings<br/>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;•	Die cast aluminium end caps<br/>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;•	Vergola link bars, pivot strips and motors<br/>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;•	Painted galvanised steel 250 x 75 frame work<br/>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;•	Painted galvanised steel 90 x 90 posts<br/>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;•	Working  / engineering drawings<br/>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;•	Down pipe connection into existing house down pipes<br/>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;•	Automatic switching including rain sensor and remote control connection<br/>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;•	Control box to house back up battery and electronics panel<br/>
<br/>
<p>Our standard colour range is:  Colorbond Surfmist, Classic Cream, Paper Bark, Shale Grey, Woodland Grey and Zinc. 




<br/><br/> 
<b>Exclusions:</b><br/>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;•	All plans and permits required<br/>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;•	Platform over pool (if required)<br/>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;•	240 volt GPO<br/>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;•	Removal of existing structures (if required)<br/>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;•	Removal and re fitting of existing decking (if required)<br/>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;•	Scaffolding (if required) over 3.000m<br/>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;•	Rubbish removal<br/>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;•	Storm seals optional <br/><br/>


<p>Vergola motors are 12V motors which are connected to a computerised control box which has a step down transformer and backup battery. This control box is normally inserted into a waterproof opaque box (supplied by Vergola). You may locate this box anywhere provided it is not more than 15 metres from the Vergola.</p>
<br/>
<p>Once an order has been made and the site check has been completed, supply and installation of the Vergola can take place in approximately 2 – 6 weeks in most cases, pending work loads.</p>
<br/>
<p>We trust that you will find our offer acceptable and we look forward to working with you on this exciting project.</p>
<br/><br/>

<p>Yours sincerely</p>
<br/><br/>
 

<p><?php echo $RepName; ?> </p>
<p>Design Consultant</p>
<p>Vergola Victoria Pty Ltd</p> 


</div>
 
</textarea>
<input type="submit" class="btn" name="add" value="Save"> <input class="btn" type="button" value="Close" onClick="window.opener=null; window.close(); return false;">

</form>
</body>
</html>