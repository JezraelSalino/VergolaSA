<?php 
return;
$print_section = "";
if(isset($_GET["print_section"])){
	$print_section = $_GET["print_section"];
}
 
$QuoteID = 0;
if(isset($_REQUEST['pid']))
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
			
    echo('<script language="Javascript"> window.close();</script>');
  
    // echo('<script language="Javascript">window.opener.document.location.href("index.php?titleID='.$template_title.'&option=com_chronoforms&tmpl=component&chronoform=Download-PDF"); window.close();</script>');
 
}


?>

<html>
<title>Quote Report</title>
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
<?php

$projectid = mysql_real_escape_string($_REQUEST['projectid']);
$title = mysql_real_escape_string($_REQUEST['title']);
// $titleID = mysql_real_escape_string($_REQUEST['titleID']);
// $supplierid = mysql_real_escape_string($_REQUEST['supplierid']);

//$sql = "SELECT * FROM ver_chronoforms_data_contract_list_vic  AS contract LEFT JOIN ver_chronoforms_data_clientpersonal_vic AS c ON c.clientid = contract.quoteid WHERE  contract.projectid = '{$projectid}' ";
//error_log($sql, 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_sa\\my-error.log');exit();
$sql = "SELECT *,DATE_FORMAT(quotedate,'%d-%b-%Y') fquotedate FROM ver_chronoforms_data_followup_vic  WHERE  projectid = '".$projectid."' ";
//error_log($sql, 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_sa\\my-error.log');
$proj = mysql_query($sql);
$project = mysql_fetch_array($proj); 
//error_log(print_r($contract,true), 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_sa\\my-error.log');exit();

$sql = "SELECT * FROM ver_chronoforms_data_quote_vic  WHERE  projectid = '".$projectid."' ";
//error_log($sql, 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_sa\\my-error.log');
$quoteResult = mysql_query($sql);
$quoteInfo = mysql_fetch_array($quoteResult);  

$VergolaType = $quoteInfo['framework'];
$client_id = $project['quoteid'];
$project_id = $project['projectid'];

$dimension = "";
$resultm = mysql_query("SELECT * FROM ver_chronoforms_data_measurement_vic WHERE projectid  = '$projectid'");
//error_log("SELECT * FROM ver_chronoforms_data_measurement_vic WHERE projectid  = '$projectid'", 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_sa\\my-error.log');
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
		//error_log(print_r($ReLen,true), 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_sa\\my-error.log'); 
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

<form method="post">
  
<input name="clientid" id="clientid" type="hidden" value="<?php echo $client_id; ?>">
<input name="title" id="title" type="hidden" value="<?php echo $title; ?>">
 
<textarea name="htmlcontent" id="htmlcontent" class="mce_editable" style="width:100%;height:100%!important; ">
 <?php
 	$html = generateHtmlReport($projectid, $title);
 	echo $html;

 ?>
</textarea>
<input type="submit" class="btn" name="add" id="add1" value="Download PDF"> <input class="btn" type="button" value="Close" onClick="window.opener=null; window.close(); return false;">

</form>
</body>
</html>


<?php
//Not being used anymore.. this function was transfer in adding VR1,VR2,VR3 so that in view Quote the generated pdf can be download right away.
function generateHtmlReport($projectid,$title){
	
	// $projectid = mysql_real_escape_string($_REQUEST['projectid']);
	// $title = mysql_real_escape_string($_REQUEST['title']);
	 
	$sql = "SELECT *,DATE_FORMAT(quotedate,'%d-%b-%Y') fquotedate FROM ver_chronoforms_data_followup_vic  WHERE  projectid = '".$projectid."' ";
	//error_log($sql, 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_sa\\my-error.log');
	$proj = mysql_query($sql);
	$project = mysql_fetch_array($proj); 
	//error_log(print_r($contract,true), 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_sa\\my-error.log');exit();

	$sql = "SELECT * FROM ver_chronoforms_data_quote_vic  WHERE  projectid = '".$projectid."' ";
	//error_log($sql, 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_sa\\my-error.log');
	$quoteResult = mysql_query($sql);
	$quoteInfo = mysql_fetch_array($quoteResult);  

	$VergolaType = $quoteInfo['framework'];
	$client_id = $project['quoteid'];
	$project_id = $project['projectid'];

	$dimension = "";
	$resultm = mysql_query("SELECT * FROM ver_chronoforms_data_measurement_vic WHERE projectid  = '$projectid'");
	//error_log("SELECT * FROM ver_chronoforms_data_measurement_vic WHERE projectid  = '$projectid'", 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_sa\\my-error.log');
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
			//error_log(print_r($ReLen,true), 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_sa\\my-error.log'); 
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

	$html = "";
		$html .= "<div style='font-family:Arial, Helvetica, sans-serif; width:700px;  font-size: 10pt;'>
 
<table class='template_tbl' cellspacing='0' cellpadding='0'>
	<tr>
		<td width='120'>
		 	 <b>Date Entered </b>
		</td>
		<td width='120'>
			 <b>Project Name </b> 
		</td>
		<td width='120'>
		 	 <b>Framework Type </b>
		</td>
		<td width='120'>
			 <b>Type of Vergola </b> 
		</td>";

		if (fnmatch("*Single Bay VR1",$VergolaType)){ 
			$html .= '<td width="120">
			 	 <b>Length </b>
			</td>
			<td width="120">
				 <b>Width </b> 
			</td>';
		}else{
			$html .= '<td width="80">
		 	 	<b>Length 1 </b>
			</td>
			<td width="80">
				 <b>Length 2 </b> 
			</td>
			<td width="80">
				 <b>Width </b> 
			</td>';
		}
	$html .= "</tr>
	<tr>
		<td> 
			{$project['fquotedate']}
		</td>
		<td>
		 	{$project['project_name']}
		</td>
		<td> 
			{$quoteInfo['framework_type']}
		</td>
		<td>
		 	{$quoteInfo['framework']}
		</td>";

		if (fnmatch("*Single Bay VR1",$VergolaType)){
			$html .= "<td> {$ReLen}</td>
			<td>
				{$ReWid}
			</td>";
		}else{
			$html .= "<td>{$ReLen[0]}</td>
			<td>
				 {$ReLen[1]}
			</td>
			<td>
				{$_ReWid}
			</td>";
		}

	$html .= '</tr>	
	 
</table> <br/><br/>';  
 

$html .= '

<table class="" border="1" cellspacing="0" style="border-collapse:collapse;font-size:9pt; " >
	<tr>
		<th width="220">
			 	<b>Description</b>  
			</th>
			<th width="50">
				&nbsp;&nbsp;<b>Webbing</b>&nbsp;&nbsp;
			</th>
			<th width="75">
				 <b>Colour</b>  
			</th>
			<th width="50">
				&nbsp;&nbsp;<b>Finish</b> &nbsp;&nbsp;
			</th>
			<th width="50">
				&nbsp;&nbsp;<b>UOM</b> &nbsp;&nbsp;
			</th>
			<th width="60">
				&nbsp;&nbsp;<b>Qty</b> &nbsp;&nbsp;
			</th>
			<th width="75">
				&nbsp;&nbsp;<b>Length</b> &nbsp;&nbsp;
			</th>
			<th width="100">
				&nbsp;&nbsp;<b>RRP</b> &nbsp;&nbsp;
			</th>
	</tr>';
 
	//Framework
	$sql = " SELECT  i.inventoryid, q.* FROM ver_chronoforms_data_quote_vic AS q LEFT JOIN ver_chronoforms_data_inventory_vic AS i ON i.inventoryid=q.inventoryid WHERE q.projectid='{$projectid}' AND (LOWER(i.section) = 'frame' OR  LOWER(i.section) = 'posts')  ";

	$item_result = mysql_query ($sql);
	
	$html .= "<tr> <th colspan='8' style='text-align:center;'><b>Framework</b></th> </tr>"; 
	while ($row = mysql_fetch_assoc($item_result)){  
		$html .= "<tr>
			<td>{$row['description']}</td> 
			<td>{$row['webbing']}</td>
			<td>{$row['colour']}</td>
			<td>{$row['finish']}</td>
			<td>{$row['uom']}</td>  
			<td style='text-align:right;'>{$row['qty']}</td>
			<td style='text-align:right;'>{$row['length']}</td>
			<td style='text-align:right;'>&#36;{$row['rrp']}</td>
		</tr>";  
		}
		$html .= "<tr><td colspan='8'></td></tr>";

	//fittings
	$sql = "SELECT  i.inventoryid, q.* FROM ver_chronoforms_data_quote_vic AS q LEFT JOIN ver_chronoforms_data_inventory_vic AS i ON i.inventoryid=q.inventoryid WHERE q.projectid='{$projectid}'  AND i.section='Fixings'  ";
	
	$item_result = mysql_query ($sql);
	
	$html .= "<tr> <th colspan='8' style='text-align:center;'><b>Fittings</b></th> </tr>"; 
	while ($row = mysql_fetch_assoc($item_result)){  
		$html .= "<tr>
			<td>{$row['description']}</td> 
			<td>{$row['webbing']}</td>
			<td>{$row['colour']}</td>
			<td>{$row['finish']}</td>
			<td>{$row['uom']}</td>  
			<td style='text-align:right;'>{$row['qty']}</td>
			<td style='text-align:right;'>{$row['length']}</td>
			<td style='text-align:right;'>&#36;{$row['rrp']}</td>
		</tr>";  
		}
		$html .= "<tr><td colspan='8'></td></tr>";


	//GUtters
	$sql = " SELECT  i.inventoryid, q.* FROM ver_chronoforms_data_quote_vic AS q LEFT JOIN ver_chronoforms_data_inventory_vic AS i ON i.inventoryid=q.inventoryid WHERE q.projectid='{$projectid}' AND i.section = 'Guttering' ";

	$item_result = mysql_query ($sql);
	
	$html .= "<tr> <th colspan='8' style='text-align:center;'><b>Framework</b></th> </tr>"; 
	while ($row = mysql_fetch_assoc($item_result)){  
		$html .= "<tr>
			<td>{$row['description']}</td> 
			<td>{$row['webbing']}</td>
			<td>{$row['colour']}</td>
			<td>{$row['finish']}</td>
			<td>{$row['uom']}</td>  
			<td style='text-align:right;'>{$row['qty']}</td>
			<td style='text-align:right;'>{$row['length']}</td>
			<td style='text-align:right;'>&#36;{$row['rrp']}</td>
		</tr>";  
		}
		$html .= "<tr><td colspan='8'></td></tr>";

	//Flashing
	$sql = "SELECT  i.inventoryid, q.* FROM ver_chronoforms_data_quote_vic AS q LEFT JOIN ver_chronoforms_data_inventory_vic AS i ON i.inventoryid=q.inventoryid WHERE q.projectid='{$projectid}'  AND i.section='Flashings'  ";
	
	$item_result = mysql_query ($sql);
	
	$html .= "<tr> <th colspan='8' style='text-align:center;'><b>Flashings</b></th> </tr>"; 
	while ($row = mysql_fetch_assoc($item_result)){ 
 		
 		
		$html .= "<tr>
			<td>{$row['description']}</td> 
			<td>{$row['webbing']}</td>
			<td>{$row['colour']}</td>
			<td>{$row['finish']}</td>
			<td>{$row['uom']}</td>  
			<td style='text-align:right;'>{$row['qty']}</td>
			<td style='text-align:right;'>{$row['length']}</td>
			<td style='text-align:right;'>&#36;{$row['rrp']}</td>
		</tr>";  
		}
		$html .= "<tr><td colspan='8'></td></tr>";	
		

	//downpipe 		
	$sql = "SELECT  i.inventoryid, q.* FROM ver_chronoforms_data_quote_vic AS q LEFT JOIN ver_chronoforms_data_inventory_vic AS i ON i.inventoryid=q.inventoryid WHERE q.projectid='{$projectid}'  AND i.section='Downpipe'  ";
	
	$item_result = mysql_query ($sql);
	
	$html .= "<tr> <th colspan='8' style='text-align:center;'><b>Downpipe</b></th> </tr>"; 
	while ($row = mysql_fetch_assoc($item_result)){ 
		$html .= "<tr>
			<td>{$row['description']}</td> 
			<td>{$row['webbing']}</td>
			<td>{$row['colour']}</td>
			<td>{$row['finish']}</td>
			<td>{$row['uom']}</td>  
			<td style='text-align:right;'>{$row['qty']}</td>
			<td style='text-align:right;'>{$row['length']}</td>
			<td style='text-align:right;'>&#36;{$row['rrp']}</td>
		</tr>";  
		}
		$html .= "<tr><td colspan='8'></td></tr>";

	//vergola		 
	$sql = "SELECT  i.inventoryid, q.* FROM ver_chronoforms_data_quote_vic AS q LEFT JOIN ver_chronoforms_data_inventory_vic AS i ON i.inventoryid=q.inventoryid WHERE q.projectid='{$projectid}'  AND i.section='Vergola'  ";

	$item_result = mysql_query ($sql);
	
	$html .= "<tr> <th colspan='8' style='text-align:center;'><b>Vergola</b></th> </tr>"; 
	while ($row = mysql_fetch_assoc($item_result)){  
		$html .= "<tr>
			<td>{$row['description']}</td> 
			<td>{$row['webbing']}</td>
			<td>{$row['colour']}</td>
			<td>{$row['finish']}</td>
			<td>{$row['uom']}</td>  
			<td style='text-align:right;'>{$row['qty']}</td>
			<td style='text-align:right;'>{$row['length']}</td>
			<td style='text-align:right;'>&#36;{$row['rrp']}</td>
		</tr>";  
		}
		$html .= "<tr><td colspan='8'></td></tr>";

	//misc  
	$sql = " SELECT  i.inventoryid, q.* FROM ver_chronoforms_data_quote_vic AS q LEFT JOIN ver_chronoforms_data_inventory_vic AS i ON i.inventoryid=q.inventoryid WHERE q.projectid='{$projectid}'   AND i.section='Misc'  ";		

	$item_result = mysql_query ($sql);
	
	$html .= "<tr> <th colspan='8' style='text-align:center;'><b>Miscellaneous</b></th> </tr>"; 
	while ($row = mysql_fetch_assoc($item_result)){ 
		$html .= "<tr>
			<td>{$row['description']}</td> 
			<td>{$row['webbing']}</td>
			<td>{$row['colour']}</td>
			<td>{$row['finish']}</td>
			<td>{$row['uom']}</td>  
			<td style='text-align:right;'>{$row['qty']}</td>
			<td style='text-align:right;'>{$row['length']}</td>
			<td style='text-align:right;'>&#36;{$row['rrp']}</td>
		</tr>";  
		}
		$html .= "<tr><td colspan='8'></td></tr>";

	//extras 
	$sql = "SELECT  i.inventoryid, q.* FROM ver_chronoforms_data_quote_vic AS q LEFT JOIN ver_chronoforms_data_inventory_vic AS i ON i.inventoryid=q.inventoryid WHERE q.projectid='{$projectid}'  AND i.section='Extras'  ";		
	
	$item_result = mysql_query ($sql);
	
	$html .= "<tr> <th colspan='8' style='text-align:center;'><b>Extras</b></th> </tr>"; 
	while ($row = mysql_fetch_assoc($item_result)){ 

		$html .= "<tr>
			<td>{$row['description']}</td> 
			<td>{$row['webbing']}</td>
			<td>{$row['colour']}</td>
			<td>{$row['finish']}</td>
			<td>{$row['uom']}</td>  
			<td style='text-align:right;'>{$row['qty']}</td>
			<td style='text-align:right;'>{$row['length']}</td>
			<td style='text-align:right;'>&#36;{$row['rrp']}</td>
		</tr>";  
		}
	$html .= "<tr><td colspan='8'></td></tr>";
 
	//disbursements   
	$sql = "SELECT  i.inventoryid, q.* FROM ver_chronoforms_data_quote_vic AS q LEFT JOIN ver_chronoforms_data_inventory_vic AS i ON i.inventoryid=q.inventoryid WHERE q.projectid='{$projectid}'   AND i.section='Disbursements'  ";		

	//error_log($sql, 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_sa\\my-error.log'); 
	$item_result = mysql_query ($sql);
	
	$html .= "<tr> <th colspan='8' style='text-align:center;'><b>Disbursements</b></th> </tr>"; 
	while ($row = mysql_fetch_assoc($item_result)){ 
 		
 		
		$html .= "<tr>
			<td>{$row['description']}</td> 
			<td>{$row['webbing']}</td>
			<td>{$row['colour']}</td>
			<td>{$row['finish']}</td>
			<td>{$row['uom']}</td>  
			<td style='text-align:right;'>{$row['qty']}</td>
			<td style='text-align:right;'>{$row['length']}</td>
			<td style='text-align:right;'>&#36;{$row['rrp']}</td>
		</tr>";  
		}
	  
$html .= '	 
</table>


<br/><br/>
<table class="template_tbl" cellspacing="0" cellpadding="0" style="font-size: 10pt;" >
	<tr>
		<td colspan="2" style="text-align: left"> 
		 	 <b>Commission</b>
		</td> 
  
  		<td> 
			 &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
		</td>

		<td colspan="2" style="text-align: left"> 
		 	 <b>Payment</b>
		</td> 
		 
	 	<td> 
			 &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
		</td>

		<td colspan="2" style="text-align: left"> 
		 	 <b>Total</b>
		</td> 
		 
	</tr>

	<tr>
		<td> 
			 Sales Commission
		</td>
		<td>
		   &#36;'.$project["sales_comm"].'
		</td>
		<td> 
			 &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp;
		</td>

		<td> 
			Deposit
		</td>
		<td>
		 	 &#36;'.$project["payment_deposit"].'
		</td>
		<td> 
			 &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp;
		</td>

		<td> 
			Vergola Sub Total
		</td>
		<td>
		 	&#36;'.$project["subtotal_vergola"].'
		</td> 
	</tr>

	<tr>
		<td colspan="2"> 
			Sales Commission Payment Schedule
		</td>
		 
		<td> 
			 &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp;
		</td>

		<td> 
			Progress payment
		</td>
		<td>
		 	&#36;'.$project["payment_progress"].'
		</td>
		<td> 
			 &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp;
		</td>

		<td> 
			Disb. Sub Total
		</td>
		<td>
		 	&#36;'.$project["subtotal_disbursement"].'
		</td>
		 
	</tr>	

	<tr>
		<td> 
			Pay 1
		</td>
		<td>
		    &#36;'.$project["com_pay1"].'
		</td>
		<td> 
			 &nbsp;
		</td>

		<td> 
			Final payment
		</td>
		<td>
		 	 &#36;'.$project["payment_final"].'
		</td>
		<td> 
			 &nbsp;
		</td>

		<td> 
			Sub Total
		</td>
		<td>
		 	 &#36;'.$project["total_cost"].'
		</td>

		<td> 
			GST
		</td>
		<td>
		 	 &#36;'.$project["total_cost_gst"].'
		</td>
		 
	</tr>	

	<tr>
		<td> 
			Pay 2
		</td>
		<td>
		 &#36;'.$project["com_pay2"].'
		</td>
		<td> 
			 &nbsp;
		</td>

		<td> 
			&nbsp;
		</td>
		<td>
		 	&nbsp;
		</td>
		<td> 
			 &nbsp;
		</td>

		<td> 
			Total
		</td>
		<td>
		 	 &#36;'.$project["total_rrp_gst"].'
		</td>
		 
	</tr>

	<tr>
		<td> 
			Final
		</td>
		<td>
		  &#36;'.$project["com_final"].'
		</td>
		<td> 
			 &nbsp;
		</td>

		<td> 
			&nbsp;
		</td>
		<td>
		 	&nbsp;
		</td>
		<td> 
			 &nbsp;
		</td>

		<td> 
			 &nbsp;
		</td>
		<td>
		 	 &nbsp;
		</td>
		 
	</tr>	

	<tr>
		<td> 
			Installer Payment
		</td>
		<td>
		  &#36; '.$project["install_comm_cost"].'
		</td>
		<td> 
			 &nbsp;
		</td>

		<td> 
			&nbsp;
		</td>
		<td>
		 	&nbsp;
		</td>
		<td> 
			 &nbsp;
		</td>

		<td> 
			 &nbsp;
		</td>
		<td>
		 	 &nbsp;
		</td>
		 
	</tr>		
	 
</table>    
</div> ';

return $html;

}


?>