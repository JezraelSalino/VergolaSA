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

	$builderLicence = "";

	//---------------------------------------------------------------------------------//	

	$ProjectID = $projectInfo["projectid"];
	$resultq = mysql_query("SELECT * FROM ver_chronoforms_data_quote_vic WHERE projectid  = '$ProjectID'");
	$retrieveq = mysql_fetch_array($resultq);
	if (!$resultq) {die("Error: Data not found..");}
	 


	$dimension = "";
	$resultm = mysql_query("SELECT * FROM ver_chronoforms_data_measurement_vic WHERE projectid  = '$ProjectID'");
	//error_log($resultm, 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_sa\\my-error.log');
	if (!$resultm) {die("Error: Data not found..");}

	$numBay = 0;
	$ReLen = null;
	$ReWid = null;
	$_ReWid = null;
	//error_log("vergola type : ".$VergolaType, 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_sa\\my-error.log');
	if($VergolaType == "Double Bay" || $VergolaType == "Double Bay - Drop-In" || $VergolaType == "Double Bay VR2" || $VergolaType == "Double Bay VR3" || $VergolaType == "Double Bay VR3 - Gutter" || $VergolaType == "Double Bay VR2 - Drop-In" || $VergolaType == "Double Bay VR3 - Drop-In" || $VergolaType == "Double Bay VR3 - Gutter - Drop-In"  ){
		$k=0; 
		while ($retrievem = mysql_fetch_array($resultm)){
			$ReLen[$k] = $retrievem['length'];
			$_ReWid = $retrievem['width'];
			$k++;
			//error_log("DOUBLE BAY width: ".$_ReWid, 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_sa\\my-error.log'); 
		}	
		$numBay = 2;
		$dimension = $ReLen[0].' X '.$_ReWid; 
		//error_log("AM HERE 1!", 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_sa\\my-error.log'); 
		//error_log("L1: ".$ReLen[0]. " L2: ".$ReLen[1]." W:".$_ReWid, 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_sa\\my-error.log');	
	}else if($VergolaType == "Multiple Bay" || $VergolaType == "Multiple Bay - Drop-In"){
		$k=0; 
		while ($retrievem = mysql_fetch_array($resultm)){
			$ReLen[$k] = $retrievem['length'];
			$ReWid[$k] = $retrievem['width']; 
			$k++;
			//error_log(print_r($retrievem['length'],true), 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_sa\\my-error.log');
			//error_log(print_r($retrievem['width'],true), 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_sa\\my-error.log'); 

		}	
		$numBay = $k;
		$dimension = $ReLen[0].' X '.$ReWid[0]; 
		//error_log("AM HERE 2!", 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_sa\\my-error.log'); 
	}else{
		$retrievem = mysql_fetch_array($resultm);
		$ReLen = $retrievem['length'];
		$ReWid = $retrievem['width'];
		  
		$numBay = 1; 
		$dimension = $ReLen.' X '.$ReWid;
	}


 
	?>
<html>
<title>Sales Contract - Builder</title>
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
<input name="title" id="title" type="hidden" value="Sales Contract - Builder (<?php echo $QuoteID; ?>)">

<textarea name="htmlcontent" id="htmlcontent" class="mce_editable" style="width:100%;height:100%!important; ">
<div style="font-family:Arial, Helvetica, sans-serif; width:700px;  font-size: 11pt;">
 
<table  >
	<tr>
		<td width="20%">
			<img src="<?php echo JURI::base().'images/company_logo.png'; ?> " style="float:left; width: 110px;" />
			
		</td>
		<td width="70%">
			<p style="float:left; font-size:12pt; padding-left:21px">
				PLAIN ENGLISH CONTRACT FOR SUPPLY AND INSTALLATION OF A VERGOLA OPENING ROOF SYSTEM FOR A BUILDER – COMMERCIAL AND/OR DOMESTIC (Vic)
			</p>
		</td>
	</tr>
</table> 

<p>This contract is between:</p><br/>

<p>
Vergola (Vic) Pty Ltd ACN 088 482 928 of 101 Port Road Thebarton SA 5031 Phone 8150 6888 and <?php echo $BuildName; ?>.  Builder’s Licence No: <?php echo $builderLicence; ?> (“we, our, us”).
</p><br/><br/>
and  
 
<p>The Builder (“you, your”): </p>
<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
<u>&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $BuildContact; ?>&nbsp;&nbsp;&nbsp;&nbsp;</u></p> <br/> 
 
<p>Your address: </p> 
<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  
<?php echo $SiteAddress1 .' '. $SiteAddress2; ?><br/>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
<u>&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $SiteSuburb .' '. $SiteState .' '. $SitePostcode; ?>&nbsp;&nbsp;&nbsp;&nbsp;</u><br/>
 

<p>The site: </p>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
<u>&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $SiteAddress1 .' '. $SiteAddress2.' '. $SiteSuburb.' '.$SiteState.' '.$SitePostcode; ?>&nbsp;&nbsp;&nbsp;&nbsp;</u>
<br/> <br/><br/>
(<b>The works</b>)<br/>
The Vergola size:  &nbsp;&nbsp;&nbsp;&nbsp;<u>&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $dimension; ?> &nbsp;&nbsp;&nbsp;&nbsp;</u>&nbsp;&nbsp;&nbsp;&nbsp;       Number of Bays:   &nbsp;&nbsp;&nbsp;&nbsp;<u>&nbsp;&nbsp;&nbsp;&nbsp; <?php echo $numBay; ?>&nbsp;&nbsp;&nbsp;&nbsp;</u>&nbsp;&nbsp;&nbsp;&nbsp;
<br/><br/> 
Type of Vergola:  &nbsp;&nbsp;&nbsp;&nbsp;<u>&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $retrieveq['framework']; ?>&nbsp;&nbsp;&nbsp;&nbsp;</u>&nbsp;&nbsp;&nbsp;&nbsp;      Structure: Attached to home / Freestanding
<br/><br/> 
Beam Type.................             Column Type................            Column fixing:  Footing / Bracket           
<br/><br/> 
Finish: Standard / Non Standard (specify).........................................................................................
<br/><br/> 



Special Conditions: ...............................................................................................................................         
<br/><br/> 



The price: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; $<?php echo $projectInfo['total_rrp']; ?>  <br/>
GST       &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  $<?php echo $projectInfo['total_gst']; ?>  <br/>
Total price &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  $<?php echo $projectInfo['total_rrp_gst']; ?> <br/>

<br/><br/> 

Progress claims and payments:<br/><br/> 
	
Deposit &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; $<?php echo $projectInfo['payment_deposit']; ?>  <br/>
(to be paid on signing Contract)	 <br/>


First installment $<?php echo $projectInfo['payment_progress']; ?><br/>
(to be paid prior to commencement of site works and delivery of materials)<br/>
<br/>
Balance  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; $<?php echo $projectInfo['payment_final']; ?><br/>
(to be paid on completion)	 

<p><b>Doing the work</b></p>  
<p>1.	&nbsp;&nbsp;&nbsp; We will do the works for you at the site.  We will supply and install the Vergola (the works) in a proper and workmanlike manner using good and proper materials.</p>
<br/>
 <b>Some things you must do</b> <br/>
<p>2. &nbsp;&nbsp;&nbsp;	At all times so that we can do the works you must provide to us and our employees, agents or subcontractors:</p><br/>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;2.1	&nbsp;&nbsp;&nbsp; a clear site;  <br/>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;2.2	exclusive, free and uninterrupted access to all areas of the site where work is to be carried out; and<br/>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;2.3	electrical power (no less than one 15 amp 240 volt GPO) to all areas of the site where work is to be carried out.<br/>
<br/>

<p>3.	If you do not, we may do the things necessary to get these things and charge you extra for that.</p>
<br/>

<p>4.	You must not:</p><br/>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;4.1	give instructions or directions to our employees, agents or subcontractors; or<br/>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;4.2	prevent or impede us from performing our obligations under these terms and conditions.<br/>
<br/>
<p>5.	Any communication from you about the work, or any variation, must be done in writing to us.</p>
<br/>
<p>6.	If we ask, you must show us the correct location of site boundaries.  If there is doubt, you must pay for a surveyor to peg the site and the position of the work.</p>
<br/>
<p>7.	You must tell us now of any easements or encumbrances.  You must tell us now anything else we should know about the site or its boundaries.  You are responsible for the correctness of everything you tell us.  (This includes any documents you provide to us.)</p>
<br/>
<p>8.	You are responsible for storm water disposal and relocation of any services unless it says otherwise in this contract.</p>
<br/>
<p>9.	You must apply and pay for all approvals and engineering necessary to allow the work to be carried out unless it says otherwise in this contract.</p>
<br/>
<p><b>Materials</b></p><br/>
<p>10.	Until that time you only have possession of the materials as bailee for us.</p>
<p>11.	Your right to possession of the materials ends if payment for the materials is due but is not paid.</p><br/>
<p>12.	In that case, we may enter any premises where the materials are, or are reasonably thought to be, and repossess them.  In that case we may use such reasonable force as is necessary to get access and we will not be liable to you for any damage caused in doing so.</p>
<br/>
<p>13.	You acknowledge that although we are installing the materials they will not be substantially fixed to any structure so it is not expected that removing them will cause any damage if we remove them under these terms and conditions.  You release us from any claims for any damage even if it happens.</p>
<br/>
<p>14.	We may substitute different materials if the original materials are difficult or impossible to get.</p>
<br/>
<p>15.	We own surplus materials supplied by us.</p>
<br/>
<p>	We will remove them from the site prior to practical completion.</p>
<br/>
<p><b>Payment</b></p><br/>
<p>16.	You must pay us the deposit and then the rest of the price in two instalments.</p>
<br/>
<p>17.	If you do not pay any amount on time, you must pay us interest on any amount outstanding at a rate of one percent (1%) more than the then current rate charged by the National Australia Bank for overdrafts of $10,000 or more.  Also, in that case, you must pay all legal or other collection costs we incur to collect any amount you owe us.</p>
<br/>
<p>18.	When the works are practically complete we will tell you.</p>
<br/>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Then you must -<br/>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 18.1	inspect the works with us; and<br/>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 18.2	write down a list of anything that is defective or incomplete and give it to us; and</p>
<br/>
<br/>
<p>19.	You must pay the balance of the price in full (that is, with no set-off or reduction) within 7 days of our invoice by cash or bank cheque and then we will hand over the works to you.  </p>
<br/>

<p>20.	You should give us a written notice of any defective or incomplete parts of the works.  We will then fix them within a reasonable time provided all of the price has been paid.</p>
<br/>

<p><b>Timing</b></p>
<br/>
<p>21.	We will start doing the works as soon as reasonable after the start date.</p>
<p>22.	The works must be practically complete within a reasonable time of the estimated finish date.  However, the estimated finish date will be put back by whatever time is reasonable if there is delay in doing the works because of anything beyond our control.</p>
<br/><br/>
<p><b>Variations</b></p>
<br/>
<p>23.	You and we must both agree to any variation, apart from those under Clause 3.</p>
<br/><br/>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Except for them, this Clause 23 applies.<br/>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 23.1	If you tell us you want a variation, or if we suggest a variation, then we will give you a written quote to do it.<br/>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 23.2	The quote must set out the change to the price to do the variation.<br/>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 23.3	We will not do the variation unless you have accepted the quote by signing it.<br/>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 23.4	The price will then go up or down according to the change you were quoted.<br/>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 23.5	When we suggest a variation, you must tell us within 2 days, or straightaway in an emergency, whether or not you accept our quote.<br/>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 23.6	We can still charge you for a variation if our quote for it is accepted by you verbally or by your conduct.<br/>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 23.7	In that case, it does not matter that the procedure in this Clause 23 is not followed.<br/>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 23.8	This is also the case where a variation is requested by you direct to one of our subcontractors contrary to Clause 4 and done without us knowing.<br/>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 23.9	You will be charged like under Clause 24 for these variations.<br/>
<br/>
<p>24.	It if is practical, we will forewarn you of any variation mentioned in Clauses 3 or 25.
	We will tell you the detail of the variation, and any extra cost, as soon as practical after it is done.<br/>
	You will be charged our actual cost (excluding GST) plus another 15% (which includes overheads) for the variation.  GST will be added to the total.
	</p>
<br/>

<p>25.	If the engineer requires extra work we will tell you and we will charge extra for that work.</p><br/>
<p><b>Work or materials by you</b></p>
<br/>
<p>26.	This clause applies if you are supplying materials or doing any of the works.  In that case, you must do that work and/or supply those materials free of defects at the right time and, in any case, within 7 days of our request.</p>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; If you do not, installation will not occur until all issues have been remedied to our satisfaction. <br/>

<p><b>Our liability and insurance</b></p>
<br/>
<p>27.	We are not responsible for damage to existing structures or fittings.  We will however take reasonable care not to cause such damage when doing the works.</p>
<br/>
<p>28.	We will insure the works until practical completion.  You are responsible for the works after practical completion.  </p>
<br/>
<p>29.	The Vergola system is guaranteed against defects in materials or workmanship for two (2) years from the date of installation.</p>
<br/>
<p><b>Breaches, stopping work and termination</b></p>
<br/>
<p>30.	We may stop the works by written notice if you breach (disobey) this contract.</p>
<br/>
<p>31.	If Clause 33 allows it, we can still terminate this contract because of the breach.  Stopping the works does not affect this right.</p>
<br/>
<p>32.	If you correct the breach before we terminate, we will re-start the works within a reasonable time.</p>
<br/>
<p>33.	We may terminate this contract by written notice if:</p>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;33.1	you fail to make any payment due<br/>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;33.2	you take possession of the work without our consent<br/>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;33.3	you disobey Clause 4<br/>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;33.4	you disobey Clause 26 or<br/>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;33.4	there is any other substantial breach of this contract by you.<br/>
<br/>
<p>34.	If we do that, we may remove any unfixed materials from the site.</p>
<br/>
<p>35.	You may terminate this contract by written notice if there is a substantial breach of this contract by us.</p>
<br/>
<p>36.	Termination does not affect rights rising from a breach of contract.</p>
<br/>
<p>37.	Either you, or we, may terminate this contract by written notice if the other -</p>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;37.1	commits a substantial breach of this contract; or<br/>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;37.2	does an act of bankruptcy (see the Bankruptcy Act); or<br/>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;37.3	comes under external administration, if a company (see the Corporations Law).<br/>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;	However, you cannot terminate this contract when you are in substantial breach of it.<br/>
<br/>
<p><b>Miscellaneous</b></p>
<br/>
<p>38.	We are not the “principal contractor” under the Occupational Health and Safety Act (Vic) 2004.  Instead you are the “principal contractor”.</p>
<br/>
<p>39.	We may sub-contract the works or any part of them.</p>
<br/>
<p>40.	Any example given in this contract is not meant to show all possible cases.</p>
<br/>
<p>41.	Using a right given in this contract does not affect any other right.</p>
<br/>
<p>42.	All notices must be in writing.</p>
<br/>
<p>43.	All notices must be given to the other party.</p>
<br/>
<p>44.	Notices can be given in person.</p>
<br/>
<p>45.	Notices can also be left at the other party’s last known address.</p>
<br/>
<p>46.	Notices can also be sent there by post, but they must be correctly addressed and posted.</p>
<br/>
<p>47.	If posted, the notice is treated as given 2 business days after posting.</p>
<br/><br/>
<p><b>Signed as a contract</b></p>
<br/><br/><br/><br/> <br/> 
_________________________ 	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  ___________________________	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; _________________________<br/>
For and on behalf of Builder&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 		Witness	
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Date

<br/><br/><br/><br/> 
		
		
_________________________ 	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  ___________________________	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; _________________________<br/>
For and on behalf of Builder&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 		Witness	
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Date


</div> 
</textarea>
<input type="submit" class="btn" name="add" value="Save"> <input class="btn" type="button" value="Close" onClick="window.opener=null; window.close(); return false;">

</form>
</body>
</html>