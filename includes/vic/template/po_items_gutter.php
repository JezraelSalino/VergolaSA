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
	 		
    //echo('<script language="Javascript">window.close();</script>');
    $titleID=$_POST['title'];
	echo('<script language="Javascript">window.opener.parent.location.href = opener.window.location.href + "&titleID='.$titleID.'"; window.close();</script>');
	
}


?>

<html>
<title>Print PO</title>
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
$section = mysql_real_escape_string($_REQUEST['section']);
$titleID = mysql_real_escape_string($_REQUEST['titleID']);
$supplierid = mysql_real_escape_string($_REQUEST['supplierid']);

$inventoryid = "";
$is_reorder = 0;
if($section=="reorder"){
	$is_reorder = 1;
	$inventoryid = mysql_real_escape_string($_REQUEST['inventoryid']);
}

//$sql = "SELECT * FROM ver_chronoforms_data_contract_list_vic  AS contract LEFT JOIN ver_chronoforms_data_clientpersonal_vic AS c ON c.clientid = contract.quoteid WHERE  contract.projectid = '{$projectid}' ";
//error_log($sql, 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_sa\\my-error.log');exit();
$qContract = mysql_query("SELECT * FROM ver_chronoforms_data_contract_list_vic  AS contract LEFT JOIN ver_chronoforms_data_clientpersonal_vic AS c ON c.clientid = contract.quoteid WHERE  contract.projectid = '".$projectid."' ");
$contract = mysql_fetch_array($qContract); 
//error_log(print_r($contract,true), 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_sa\\my-error.log');exit(); 

  
$sql_supplier = "SELECT * FROM ver_chronoforms_data_supplier_vic  WHERE  supplierid = '".$supplierid."' ";
//error_log($sqlSection, 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_sa\\my-error.log');
$qSupplier = mysql_query($sql_supplier);
$supplier = mysql_fetch_array($qSupplier);

?>

<form method="post">
<input name="clientid" id="clientid" type="hidden" value="<?php echo $projectid; ?>">
<input name="title" id="title" type="hidden" value="<?php echo $titleID; ?>">
 
<textarea name="htmlcontent" id="htmlcontent" class="mce_editable" style="width:100%;height:100%!important; ">
<div style="font-family:Arial, Helvetica, sans-serif; width:700px;  font-size: 10pt;">
<table class="template_tbl" cellspacing="0" cellpadding="0">
	<tr>
		<td  style="width:50%; text-align:left; " >
		 	<img src="<?php echo JURI::base().'images/company_logo.png'; ?> " class="" style="float:left;padding:0px 0px 30px 0; width: 120px;"/>
			 
		</td>
		<td valign="middle" style="padding-left: 5px; font-family:Arial, Helvetica, sans-serif;font-size:10pt;width:50%;">
			<br/>
			<b>Vergola (SA) Pty Ltd</b><br/>
			101 Port Road<br/>
			THEBARTON SA 5031<br/>
			Phone: 0881506888    &nbsp;&nbsp;&nbsp;    FAX: 08 8150 6868 <br/>
			ABN: 14115578112 <br/>
			Email: admin@vergola.com
  
		</td>
	</tr>
	<tr>
		<td style="padding-left: 5px; border: 1px solid black; border-collapse: collapse;">
			 
			<div><b>To:</b></div>
			<div>
				<?php echo $supplier["company_name"]; ?> <br/>
				<?php echo $supplier["address1"]; ?> <br/>
				<?php echo $supplier["suburb"]." ".$supplier["state"]." ".$supplier["postcode"]; ?> <br/> 
				<?php echo $supplier["phone"] ?> <br/>
				<?php echo $supplier["fax"]  ?> <br/>  

			</div>
		</td>
		<td style="padding-left: 5px; border: 1px solid black; border-collapse: collapse;">
			 
			<div><b>Deliver To:</b></div>
			<div>
				<?php echo $contract["client_firstname"]." ".$contract["client_lastname"]; ?> <br/>
				<?php echo $contract["site_address1"]." ".$contract["site_address2"]; ?> <br/>
				<?php echo $contract["site_suburb"]." ".$contract["site_state"]." ".$contract["site_postcode"]; ?> <br/>
				<?php echo $contract["site_address1"]." ".$contract["site_address2"]; ?> <br/>
				<?php echo $contract["site_hmphone"] ?> <br/>
				<?php echo $contract["site_mobile"]  ?> <br/>
			</div>
		</td>
	</tr>	
	<tr>	
		<td colspan="2">
			<b>Client:</b> <?php echo $contract["client_firstname"]." ".$contract["client_lastname"]; ?>  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<b>Account No:</b> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<b>Required Date:</b>  
		</td>
	</tr>	
</table> 
 
<br/>

 
<b>PO Order No.: <?php echo $contract["cf_id"]  ?> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </b> Ordered On: <?php print(Date(PHP_DFORMAT)); ?>
<br/> 


  
	<?php
	  

//Main item of a raw material that should display first like beam and post.
$sql = "SELECT bm.id, b.qty, m.qty, (m.qty*b.qty) AS m_qty, SUM(m.qty*b.qty) AS s_qty, 
	CASE WHEN m.is_per_length=1 THEN CASE WHEN m.uom='Ea' THEN SUM(m.qty*floor(b.length/m.length_per_ea)) ELSE SUM(b.qty) END ELSE SUM(m.qty*b.qty) END  AS ls_qty, 
    CASE WHEN m.is_per_length=1 
		THEN CASE WHEN m.uom='Ea' THEN SUM(m.raw_cost * m.qty * floor(b.length/m.length_per_ea)) 
        ELSE SUM(m.raw_cost * b.qty * b.length) END
	ELSE SUM(m.raw_cost * m.qty * b.qty)  END  AS ls_amount,
    b.length, CASE WHEN m.is_per_length=1 THEN SUM(b.length) END AS s_length, bm.projectid, bm.inventoryid, bm.materialid, bm.raw_cost, bm.qty, bm.supplierid, m.raw_description, m.is_per_length, m.length_per_ea, m.uom, s.company_name
FROM ver_chronoforms_data_contract_bom_meterial_vic AS bm  
JOIN ver_chronoforms_data_contract_bom_vic AS b ON b.inventoryid=bm.inventoryid
JOIN ver_chronoforms_data_inventory_vic AS inv ON inv.inventoryid=bm.inventoryid 				
JOIN ver_chronoforms_data_materials_vic AS m ON m.cf_id=bm.materialid 
JOIN ver_chronoforms_data_supplier_vic AS s ON s.supplierid=m.supplierid  
WHERE bm.projectid = '{$projectid}' AND b.projectid = '{$projectid}' AND b.is_reorder={$is_reorder}  ".($is_reorder==1?" AND b.inventoryid='{$inventoryid}' ":" AND inv.section='{$section}'")." AND m.supplierid='{$supplierid}' AND m.is_main_item=1 GROUP BY b.cf_id ORDER BY is_per_length DESC, bm.id, b.length DESC, b.qty DESC ";

//Non main item that are additional item like bolts & nuts for a post or a beam.
$sql2 = "SELECT bm.id, b.qty, m.qty, (m.qty*b.qty) AS m_qty, SUM(m.qty*b.qty) AS s_qty, 
	CASE WHEN m.is_per_length=1 THEN CASE WHEN m.uom='Ea' THEN SUM(m.qty*floor(b.length/m.length_per_ea)) ELSE SUM(b.qty) END ELSE SUM(m.qty*b.qty) END  AS ls_qty, 
    CASE WHEN m.is_per_length=1 
		THEN CASE WHEN m.uom='Ea' THEN SUM(m.raw_cost * m.qty * floor(b.length/m.length_per_ea)) 
        ELSE SUM(m.raw_cost * b.qty * b.length) END
	ELSE SUM(m.raw_cost * m.qty * b.qty)  END  AS ls_amount,
    b.length, CASE WHEN m.is_per_length=1 THEN SUM(b.length) END AS s_length, bm.projectid, bm.inventoryid, bm.materialid, bm.raw_cost, bm.qty, bm.supplierid, m.raw_description, m.is_per_length, m.length_per_ea, m.uom, s.company_name
FROM ver_chronoforms_data_contract_bom_meterial_vic AS bm  
JOIN ver_chronoforms_data_contract_bom_vic AS b ON b.inventoryid=bm.inventoryid
JOIN ver_chronoforms_data_inventory_vic AS inv ON inv.inventoryid=bm.inventoryid 				
JOIN ver_chronoforms_data_materials_vic AS m ON m.cf_id=bm.materialid 
JOIN ver_chronoforms_data_supplier_vic AS s ON s.supplierid=m.supplierid  
WHERE bm.projectid = '{$projectid}' AND b.projectid = '{$projectid}' AND b.is_reorder={$is_reorder}  ".($is_reorder==1?" AND b.inventoryid='{$inventoryid}' ":" AND inv.section='{$section}'")." AND m.supplierid='{$supplierid}' AND m.is_main_item=0 GROUP BY bm.materialid ORDER BY is_per_length DESC ";

 				$totalRrp = 0;
				error_log("sql 1: ". $sql1, 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_sa\\my-error.log'); 
				error_log("sql 2: ". $sql2, 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_sa\\my-error.log');exit();
?>
				<table>
				<?php
				$item_result = mysql_query ($sql);
				
				while ($m = mysql_fetch_assoc($item_result)){ 
					$totalRrp += $m['ls_amount']; 
				?>  
					<tr> 
						<td colspan="2"><?php echo $m['raw_description']; ?></td>  
						<td style="text-align:right;"><?php echo number_format($m['m_qty']); ?></td>
						<td style="text-align:right;"><?php echo ($m['uom']=="Mtrs"?$m['length']:""); ?></td>
						<td style="text-align:right;"><?php echo $m['uom']; ?></td> 
						<td><?php echo $bm['colour']; ?></td>
						<td style="text-align:right;">$<?php echo number_format($m['raw_cost'],2); ?></td>
						<td style="text-align:right;">$<?php echo number_format($m['ls_amount'],2); ?></td>
					</tr> 
					  
				<?php  
					}

				$item_result2 = mysql_query ($sql2);
				
				while ($m = mysql_fetch_assoc($item_result2)){ 
					$totalRrp += $m['ls_amount']; 
				?>  
					<tr> 
						<td colspan="2"><?php echo $m['raw_description']; ?></td>  
						<td style="text-align:right;"><?php echo ($m['is_per_length']=="0"?number_format($m['ls_qty']):''); ?></td>
						<td style="text-align:right;"><?php echo ($m['is_per_length']=="1"?$m['s_length']:''); ?></td>
						<td style="text-align:right;"><?php echo $m['uom']; ?></td> 
						<td><?php echo $bm['colour']; ?></td>
						<td style="text-align:right;">$<?php echo number_format($m['raw_cost'],2); ?></td>
						<td style="text-align:right;">$<?php echo number_format($m['ls_amount'],2); ?></td>
					</tr> 
					  
				<?php  
					} 
				?>

				

		  	 
		<?php //} //------------ bm END contract_bom_vic loop. 

			$gst = $totalRrp * 0.1;
			$totalSum = $totalRrp + $gst;

		 ?>
		 </table>
 


 <table style="width:100%"> 
 	<tr>
		<td   style="text-align:right" width="600"> 
			<span><b>Sub Total</b></span>&nbsp;&nbsp;&nbsp;&nbsp;
		</td> 
		<td>
		 	$<?php echo number_format($totalRrp,2); ?>
		</td>
	</tr>
	<tr>
		<td style="text-align:right" width="600"> 
			<span ><b>GST</b></span>&nbsp;&nbsp;&nbsp;&nbsp;
		</td>
		 	
		<td>
		 	$<?php echo number_format($gst,2); ?>
		</td>
	</tr>
	<tr>
		<td style="text-align:right" width="600"> 
			<span  ><b>Total Inclusive of GST</b></span>&nbsp;&nbsp;&nbsp;&nbsp;
		</td>
	 			
		<td>
		 	$<?php echo number_format($totalSum,2); ?>
		</td>
	</tr>  
	 
</table>

<br/><br/><br/><br/>
Measurement Tolerance - 0m / + 1mm &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Length Tolerance - 0m / + 10mm <br/>
NOTE: all folds are 90&deg; unless otherwise stated



</div> 
</textarea>
<input type="submit" class="btn" name="add" id="add1" value="Download PDF"> <input class="btn" type="button" value="Close" onClick="window.opener=null; window.close(); return false;">

</form>
</body>
</html>