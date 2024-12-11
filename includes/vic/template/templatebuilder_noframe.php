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
<title>Template Builder-No Frame</title>
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
<input name="title" id="title" type="hidden" value="Template Builder-No Frame">
<textarea name="htmlcontent" id="htmlcontent" class="mce_editable" style="width:100%;height:100%!important;">
<div style="font-family:Arial, Helvetica, sans-serif;font-size:11pt">
<table class="template_tbl" cellspacing="0" cellpadding="0"><tr><td valign="bottom" style="font-family:Arial, Helvetica, sans-serif;font-size:11pt;width:75%;vertical-align:bottom;bottom:0px;">
<p><?php print(Date("d M Y")); ?></p>
<?php echo $ClientFirstName .' '. $ClientLastName; ?><br/>
<?php if($BuildName!=''):
echo 'Company Name '. $BuildName;
endif; ?><br/>
<?php echo $SiteAddress1 .' '. $SiteAddress2; ?><br/>
<?php echo $SiteSuburb .' '. $SiteState .' '. $SitePostcode; ?><br/>
<p class="fax">Fax No:<?php echo $SiteFax; ?></p>
<p>Email:<?php echo $SiteEmail; ?></p>
<p>Dear <?php echo $ClientTitle.' '.$ClientLastName; ?></p>
</td><td style="width:25%">
<img src="<?php echo JURI::base().'images/template-logo-new.jpg'; ?> " class="template_img" style="float:right;padding:0px 20px 10px;"/></td></tr></table>
<p><strong>Re: Preliminary Quotation for Vergola Roof System</strong></p>
<p><strong>Project: <?php echo $SiteAddress1; ?></strong></p>

<p>Thank you for your request for quotation.</p> 

<p>Our quote is based on the drawings provided by you to us (Ref: )</p>

<p>We confirm that you will be responsible for providing the entire framework for the Vergola to our requirements. Accordingly our quote is limited to the supply and installation of the Vergola system, Vergola gutters and flashings.</p>

<p>We are pleased to provide our quote for supply and installation of a <strong>{SINGLE / DOUBLE BAY FLAT Vergola spanning approximately 0.0m x 0.0m OR divided into 2 bays}</strong></p>

<p>Cost : $00 000.00 + GST</p>
<p>Total Cost:	$00 000.00</p>

<p>This quote includes the supply and installation of the following:</p>

<p>Supply and installation:</p>
<ul>
<li>Vergola Colorbond louvres</li>
<li>Die cast aluminium end caps</li>
<li>Vergola Link bars & pivot strips</li>
<li>Vergola motors</li>
<li>Vergola Colorbond gutters</li>
<li>Vergola Colorbond flashings – perimeter & top of mid beam</li>
<li>Automatic switching including Rain Sensor and remote control</li>
<li>(Colours – Surfmist, Shale Grey, Classic Cream, Woodland Gray or Paperbark only)</li>
</ul>



<p>We note that you will be responsible for the following:</p>
<ul>
<li>Framework to our specifications</li>
<li>Down Pipe connection to storm water (where not readily accessible)</li>
<li>Supply of a 240 V power point and cabling</li> 
<li>Scaffolding (if required)</li> 
</ul>

<p>We wish to confirm our requirements for the framework as follows:</p>
<ul>
<li>Framework can be of any structural member (eg C section, RHS or LVL) provided such beam has a minimum depth of 250mm.</li>
<li>In the event of a double bay, the intermediate beam must be the same as the perimeter and fascia beams.</li>
<li>The inside face of the beams must be clean with no protrusions as the Vergola gutters are fixed to run along all four internal faces of the beams.  This means that all fixings or cleats must either be countersunk, site welded or attached from the outside.  In the event that you opt to use an open face member such as a PFC or C Purlin and you are unable to allow us the use of the outer flat surface, you will then need to look at welding plates (30mm x 3mm thick) at 600mm intervals to enable us to pick up a fixing point.</li>
<li>All framework must be square and plumb.</li>
</ul>

<p>In relation to the electronics, the Vergola motors are 12V motors which are connected to a computerised control box which has a stepdown transformer and backup battery.  This control box is normally inserted into a waterproof opaque box (supplied by Vergola) and you may locate this anywhere provided it is not more than 15 metres from the Vergola.  As such we will require the following:</p>
<ul>
<li>a 240V GPO where the control box is to be mounted</li>
<li>2 single 2mm cables for each motor to run from the Vergola unit to the control box</li>
</ul>

<p>We trust that you will find our offer to be acceptable and we look forward to working with you on this exciting project.</p>


<p>Yours sincerely</p>


<?php echo $RepName; ?><br />
TITLE: <?php echo $RepIdent; ?><br />
<strong>Vergola SA Pty Ltd</strong><br />
</div>
</textarea>
<input type="submit" class="btn" name="add" value="Save" > <input type="button" class="btn" value="Close" onClick="window.opener=null; window.close(); return false;">
</form>
</body>
</html>
