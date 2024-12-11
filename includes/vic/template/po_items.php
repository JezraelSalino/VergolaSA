<?php
$print_section = "";
if(isset($_GET["print_section"])){
	$print_section = $_GET["print_section"];
}

$QuoteID = 0;
if(isset($_REQUEST['pid']))
	$QuoteID =$_REQUEST['pid'];

$QuoteIDAlpha = substr($QuoteID, 0, 3);
$current_date = date('Y-m-d H:i:s');

//error_log($QuoteIDAlpha, 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_sa\\my-error.log');
if(isset($_POST['add']))
{	
    $template_clientid=$_POST['clientid'];
	$template_title=$_POST['title'] ; 
	$template_content=addslashes($_POST['htmlcontent']);
     
	mysql_query("INSERT INTO ver_chronoforms_data_letters_vic (clientid, template_name, datecreated, template_content) 
		 VALUES ('$template_clientid','$template_title', '$current_date', '$template_content')"); 

	
	//$_GET['section'] = 'frame'; 
	//header("Location: ". JURI::base() . $_SERVER['REDIRECT_URI'] . '?' . http_build_query($_GET)); 		
    // echo('<script language="Javascript">opener.window.location.reload(false); window.close();</script>');
    //echo('<script language="Javascript">alert(opener.window.location.href);</script>');
    //var url = opener.window.location.href+'&section=frame';
    $titleID=$_POST['title'] ;
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
					theme_advanced_source_editor_height : "950",
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
 
.template_tbl {border:1px solid black;  min-width:800px;padding:0px; border-collapse:collapse;  }
 
</style>
</head>
<body>
<?php 
 
$projectid = mysql_real_escape_string($_REQUEST['projectid']);
$section = mysql_real_escape_string($_REQUEST['section']);
$titleID = mysql_real_escape_string($_REQUEST['titleID']);
$supplierid = mysql_real_escape_string($_REQUEST['supplierid']);
$is_uom_visible = 1;
$inventoryid = "";
$is_reorder = 0;
if($section=="reorder"){
	$is_reorder = 1;
	$inventoryid = mysql_real_escape_string($_REQUEST['inventoryid']);
}

//$sql = "SELECT * FROM ver_chronoforms_data_contract_list_vic  AS contract LEFT JOIN ver_chronoforms_data_clientpersonal_vic AS c ON c.clientid = contract.quoteid WHERE  contract.projectid = '{$projectid}' ";
//error_log($sql, 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_sa\\my-error.log');exit();
$sql = "SELECT * FROM ver_chronoforms_data_contract_list_vic  AS contract JOIN ver_chronoforms_data_clientpersonal_vic AS c ON c.clientid = contract.quoteid WHERE  contract.projectid = '".$projectid."' ";
//error_log($sql, 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_sa\\my-error.log');
$qContract = mysql_query($sql);
$contract = mysql_fetch_array($qContract); 
//error_log(print_r($contract,true), 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_sa\\my-error.log');exit();

 
$sql = "SELECT * FROM ver_chronoforms_data_supplier_vic  WHERE  supplierid = '".$supplierid."' ";
//error_log($sql, 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_sa\\my-error.log');
$qSupplier = mysql_query($sql);
$supplier = mysql_fetch_array($qSupplier);

?>

<form method="post">
<input name="clientid" id="clientid" type="hidden" value="<?php echo $projectid; ?>">
<input name="title" id="title" type="hidden" value="<?php echo $titleID; ?>">
 
<textarea name="htmlcontent" id="htmlcontent" class="mce_editable" style="width:100%;height:100%!important; ">
<div style="font-family:Arial, Helvetica, sans-serif; width:800px;  font-size: 10pt;">
<table class="template_tbl" cellspacing="0" cellpadding="5" width="100%">
	<tr>
		<td  style="width:50%; text-align:left; " >
		 	<img src="<?php echo JURI::base().'images/company_logo.png'; ?> " class="" style="float:left;padding:0px 0px 10px 0; width: 180px;"/>
			 
		</td>
		<td valign="top" style="padding-left: 5px; font-family:Arial, Helvetica, sans-serif;font-size:10pt;width:50%;text-align: right;">
			<br/>
			<b>Vergola (<?php echo (HOST_SERVER=="Victoria"?"Vic":""); echo (HOST_SERVER=="SA"?"SA":""); echo (HOST_SERVER=="LA"?"LA":""); ?>) Pty Ltd</b><br/>
			101 Port Road<br/>
			THEBARTON SA 5031<br/>
			Phone: 0881506888  &nbsp;&nbsp;&nbsp; FAX: 08 8150 6868 <br/>
			ABN: 14115578112 <br/>
			Email: admin@vergola.com
  
		</td>
	</tr>
	<tr>
		<td style="padding-left: 5px; border-collapse: collapse;vertical-align: top">
			 
			<div>				
				<b>PO Number: <?php echo $contract["cf_id"]  ?></b> &nbsp;&nbsp;
				<br/><br/><br/>
				<b>Order To:</b><br/>
				<?php if(empty($supplier["company_name"])==false){ 
					  echo $supplier["company_name"]; } ?> <br/>
				<?php if(empty($supplier["address1"])==false){ 
					  echo $supplier["address1"]; } ?> <br/>
				<?php if(empty($supplier["suburb"])==false){ 
					  echo $supplier["suburb"]." ".$supplier["state"]." ".$supplier["postcode"]; } ?> <br/>
				<?php if(empty($supplier["phone"])==false){ 
					  echo $supplier["phone"]; } ?> <br/>
			</div>
		</td>
		<td style="padding-left: 5px; border-collapse: collapse; vertical-align: top">
			 
			<!-- <div><b>Deliver To:</b></div> -->
			<div>
				<b>Project ID:</b> <?php echo $contract["projectid"]; ?>&nbsp;&nbsp;<br/><br/>		
				<b>Client:</b> <?php if($contract["is_builder"]==1){ echo $contract["builder_name"]; }else{ echo $contract["client_firstname"]." ".$contract["client_lastname"];} ?> &nbsp;&nbsp;&nbsp;&nbsp; 
				<br/>
				<b>Deliver To:</b><br/>
				<?php if($contract['is_builder']==1){  
					  echo $contract["builder_name"];    
				}else{
					 echo $contract["client_firstname"]." ".$contract["client_lastname"]; 
				} ?> <br/>

				<?php if(empty($contract['site_address1'])==false){  
					echo $contract["site_address1"]." ".$contract["site_address2"];  
				}else if(empty($contract['client_address1'])==false){
					echo $contract["client_address1"]." ".$contract["client_address2"]; 
				} ?><br/>
				
				<?php if(empty($contract['site_suburb'])==false){ 
					echo $contract["site_suburb"]." ".$contract["site_state"]." ".$contract["site_postcode"]; 
				}else if(empty($contract['client_suburb'])==false){
					echo $contract["client_suburb"]." ".$contract["client_state"]." ".$contract["client_postcode"]; 
				} ?><br/>

				<?php if((empty($contract["site_hmphone"])==false) || (empty($contract["site_mobile"])==false)) { 
					 echo $contract["site_hmphone"] ."      ". $contract["site_mobile"];
				}else if((empty($contract["client_hmphone"])==false) || (empty($contract["client_mobile"])==false)){
					echo $contract["client_hmphone"] ."      ". $contract["client_mobile"];
				} ?>

			</div>
		</td>
	</tr>
	<tr><td colspan="2"></td></tr>
	<tr>	
		<td colspan="2" style="padding-left: 5px;" height="30">
			<b>Date Ordered:</b> <?php print(Date(PHP_DFORMAT)); ?><br/>
			<b>Date Required:</b> 
		</td> 
	</tr> 
</table> 
<br/> 
 
<!-- <b>PO Order No.: <?php echo $contract["cf_id"]  ?></b> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <b>Ordered On:</b> <?php print(Date(PHP_DFORMAT)); ?>
<br/><br/> -->
<table class="" border="1" cellspacing="0" cellpadding="0" style="border-collapse:collapse;font-size:9pt; " width="100%"> <tr></tr>
	<?php
$order_by = ""; 
if($section=="Vergola"){ 
	$order_by = " ORDER BY FIELD(inv.category,'Louvers') DESC, FIELD(inv.inventoryid, 'IRV66', 'IRV64', 'IRV63', 'IRV62', 'IRV60', 'IRV59','IRV58') DESC, id   "; 
}
// echo ($projectid});
//Main item of a raw material that should display first like beam and post.
$sql_ = "
SELECT
	bm.id,
	m.qty,
	( im.inv_qty * bm.qty ) AS m_qty,
	bm.length,
	( bm.qty * im.inv_qty ) AS ls_qty,
	SUM( bm.qty * im.inv_qty ) AS ts_qty,	
CASE
	
	WHEN m.uom = 'Mtrs' THEN
	bm.raw_cost * ( im.inv_qty * bm.qty ) * bm.length ELSE bm.raw_cost * ( im.inv_qty * bm.qty ) 
	END AS ls_amount,	

CASE	
	WHEN m.is_per_length = 1 THEN
CASE	
	WHEN m.uom = 'Ea' THEN
	SUM( im.inv_qty * b.qty ) ELSE SUM( floor( b.length / m.length_per_ea ) ) 
	END ELSE SUM( im.inv_qty * b.qty ) 
	END AS ls_qty,
CASE		
		WHEN m.is_per_length = 1 THEN
	CASE			
			WHEN m.uom = 'Ea' THEN
			( m.raw_cost * im.inv_qty * bm.qty ) ELSE (
				(
					(m.raw_cost * im.inv_qty * (b.length  / m.length_per_ea ) )* b.qty 
				) 
			) 
		END ELSE ( m.raw_cost * im.inv_qty * b.qty ) 
	END AS ls_amount,
CASE		
		WHEN m.is_per_length = 1 THEN
	CASE			
			WHEN m.uom = 'Ea' THEN
			( m.raw_cost * im.inv_qty * bm.qty ) ELSE (
				(
					(m.raw_cost * im.inv_qty * (b.length  / m.length_per_ea ) )* b.qty 
				) 
			) 
		END ELSE ( m.raw_cost * im.inv_qty * b.qty ) 
	END AS ls_amount_guttering,
CASE		
		WHEN m.is_per_length = 1 THEN
		SUM( b.length ) 
	END AS s_length,
	( b.length ) AS length,

CASE
	
	WHEN m.uom = 'Mtrs' THEN
	SUM(bm.raw_cost * ( im.inv_qty * bm.qty ) * bm.length) ELSE SUM(bm.raw_cost * ( im.inv_qty * bm.qty ) )
	END AS lss_amount,

	bm.projectid,
	bm.inventoryid,
	bm.materialid,
	bm.raw_cost,
	bm.qty AS bm_qty,
	bm.supplierid,
	m.raw_description,
	m.is_per_length,
	m.length_per_ea,
	m.uom,
	s.company_name,
	inv.photo,
	b.colour,
	b.finish 
FROM
	ver_chronoforms_data_contract_bom_meterial_vic AS bm
	JOIN ver_chronoforms_data_inventory_vic AS inv ON inv.inventoryid = bm.inventoryid
	JOIN ver_chronoforms_data_contract_bom_vic AS b ON b.contract_item_cf_id = bm.contract_item_cf_id
	JOIN ver_chronoforms_data_inventory_material_vic AS im ON im.inventoryid = bm.inventoryid AND im.inventoryid = b.inventoryid
	AND im.materialid = bm.materialid
	JOIN ver_chronoforms_data_materials_vic AS m ON m.cf_id = im.materialid
	JOIN ver_chronoforms_data_supplier_vic AS s ON s.supplierid = bm.supplierid 
	
WHERE
	bm.projectid = '{$projectid}' 
	AND b.projectid = '{$projectid}' 
	AND bm.supplierid = '{$supplierid}' 	
	
	".($is_reorder==" 1 "?" AND b.inventoryid = '{$inventoryid}' ":" AND inv.section = '{$section}' ")." 
	AND is_main_item = 1 
GROUP BY
CASE
		
		WHEN inv.section = 'Guttering' 
		OR inv.section = 'Flashings' THEN
			bm.id ELSE bm.materialid 
		END,
		bm.length,
		b.colour 
	ORDER BY
		m.cf_id ASC,
		m.is_per_length DESC,
		bm.length DESC,
	bm.qty DESC
	,FIELD( inv.category, 'Post Fixings', 'Beam Fixings', 'Intermediates', 'Beams' ) DESC ";

$sql2_ = "
SELECT
	bm.id,
	m.qty,
	( im.inv_qty * bm.qty ) AS m_qty,
	bm.length,
	( bm.qty * im.inv_qty ) AS ls_qty,
	SUM( bm.qty ) AS ts_qty,	
	SUM(bm.qty) AS bms_qty,
CASE
	
	WHEN m.uom = 'Mtrs' THEN
	bm.raw_cost * ( im.inv_qty * bm.qty ) * bm.length ELSE bm.raw_cost * ( im.inv_qty * bm.qty ) 
	END AS ls_amount,	

CASE	
	WHEN m.is_per_length = 1 THEN
CASE	
	WHEN m.uom = 'Ea' THEN
	SUM( im.inv_qty * b.qty ) ELSE SUM( floor( b.length / m.length_per_ea ) ) 
	END ELSE SUM( im.inv_qty * b.qty ) 
	END AS ls_qty,
CASE		
		WHEN m.is_per_length = 1 THEN
	CASE			
			WHEN m.uom = 'Ea' THEN
			SUM( m.raw_cost * im.inv_qty * bm.qty ) ELSE SUM(
				(
					(m.raw_cost * im.inv_qty * (b.length  / m.length_per_ea ) )* b.qty 
				) 
			) 
		-- END ELSE ( m.raw_cost * im.inv_qty * b.qty ) 
		END ELSE SUM(m.raw_cost * bm.qty )
	END AS ls_amount,
CASE		
		WHEN m.is_per_length = 1 THEN
	CASE			
			WHEN m.uom = 'Ea' THEN
			( m.raw_cost * im.inv_qty * bm.qty ) ELSE (
				(
					(m.raw_cost * im.inv_qty * (b.length  / m.length_per_ea ) )* b.qty 
				) 
			) 
		END ELSE ( m.raw_cost * im.inv_qty * b.qty ) 
	END AS ls_amount_guttering,
CASE		
		WHEN m.is_per_length = 1 THEN
		SUM( b.length ) 
	END AS s_length,
	( b.length ) AS length,

CASE
	
	WHEN m.uom = 'Mtrs' THEN
	SUM(bm.raw_cost * ( im.inv_qty * bm.qty ) * bm.length) ELSE SUM(bm.raw_cost * ( im.inv_qty * bm.qty ) ) 
	END AS lss_amount,

	bm.projectid,
	bm.inventoryid,
	bm.materialid,
	bm.raw_cost,
	bm.qty AS bm_qty,
	bm.supplierid,
	m.raw_description,
	m.is_per_length,
	m.length_per_ea,
	m.uom,
	s.company_name,
	inv.photo,
	b.colour,
	b.finish 
FROM
	ver_chronoforms_data_contract_bom_meterial_vic AS bm
	JOIN ver_chronoforms_data_inventory_vic AS inv ON inv.inventoryid = bm.inventoryid
	JOIN ver_chronoforms_data_inventory_material_vic AS im ON im.inventoryid = bm.inventoryid 
	AND im.materialid = bm.materialid
	JOIN ver_chronoforms_data_materials_vic AS m ON m.cf_id = im.materialid
	JOIN ver_chronoforms_data_supplier_vic AS s ON s.supplierid = bm.supplierid 
	JOIN ver_chronoforms_data_contract_bom_vic AS b ON b.contract_item_cf_id = bm.contract_item_cf_id
WHERE
	bm.projectid = '{$projectid}' 
	".($is_reorder==1?" 
	AND bm.inventoryid = '{$inventoryid}' ":" 
	AND inv.section = '{$section}' ")." 
	AND bm.supplierid = '{$supplierid}' AND m.is_main_item = 0
GROUP BY
CASE
		
		WHEN inv.section = 'Guttering' 
		OR inv.section = 'Flashings' THEN
			bm.id ELSE bm.materialid 
		END,
		bm.length,
		b.colour 
	ORDER BY
		m.cf_id ASC,
		m.is_per_length DESC,
		bm.length DESC,
	bm.qty DESC
	,FIELD( inv.category, 'Post Fixings', 'Beam Fixings', 'Intermediates', 'Beams' ) DESC ";

$sql = "SELECT bm.id, m.qty, SUM(m.qty*bm.qty) AS m_qty, bm.qty  AS ls_qty, bm.length,
    CASE WHEN m.uom='Mtrs' 
        THEN SUM(bm.raw_cost * bm.qty * bm.length)  
        ELSE SUM(bm.raw_cost * bm.qty) END AS ls_amount,
    bm.projectid, bm.inventoryid, bm.materialid, bm.raw_cost, bm.qty as bm_qty, bm.supplierid, bm.contract_item_cf_id, m.raw_description, m.is_per_length, m.length_per_ea, m.uom, s.company_name, inv.photo, b.colour, b.finish
FROM ver_chronoforms_data_contract_bom_meterial_vic AS bm  
JOIN ver_chronoforms_data_contract_bom_vic AS b ON b.contract_item_cf_id=bm.contract_item_cf_id
JOIN ver_chronoforms_data_inventory_vic AS inv ON inv.inventoryid=bm.inventoryid 				
JOIN ver_chronoforms_data_materials_vic AS m ON m.cf_id=bm.materialid 
JOIN ver_chronoforms_data_supplier_vic AS s ON s.supplierid=bm.supplierid  
WHERE bm.projectid = '{$projectid}' ".($is_reorder==1?" AND bm.inventoryid='{$inventoryid}' ":" AND bm.section='{$section}'")." AND bm.supplierid='{$supplierid}' AND m.is_main_item=1 
 GROUP BY CASE WHEN inv.section='Guttering' OR inv.section='Flashings' THEN bm.id ELSE bm.materialid END,b.length,b.colour 
{$order_by}  
"; // ORDER BY is_per_length DESC, bm.id, b.length DESC, b.qty DESC

 
$sql2 = "SELECT bm.id,   m.qty, SUM(m.qty*bm.qty) AS m_qty, bm.length, SUM(bm.qty)  AS ls_qty, 
    CASE WHEN m.uom='Mtrs' 
        THEN SUM(bm.raw_cost * bm.qty * bm.length)  
        ELSE SUM(bm.raw_cost * bm.qty) END AS ls_amount,  
    bm.projectid, bm.inventoryid, bm.materialid, bm.raw_cost, bm.qty as bm_qty, bm.supplierid, m.raw_description, m.is_per_length, m.length_per_ea, m.uom, s.company_name 
FROM ver_chronoforms_data_contract_bom_meterial_vic AS bm   
JOIN ver_chronoforms_data_inventory_vic AS inv ON inv.inventoryid=bm.inventoryid 	
JOIN ver_chronoforms_data_contract_bom_vic AS b ON b.contract_item_cf_id=bm.contract_item_cf_id			
JOIN ver_chronoforms_data_materials_vic AS m ON m.cf_id=bm.materialid 
JOIN ver_chronoforms_data_supplier_vic AS s ON s.supplierid=bm.supplierid  
WHERE bm.projectid = '{$projectid}' ".($is_reorder==1?" AND bm.inventoryid='{$inventoryid}' ":" AND bm.section='{$section}'")."  AND bm.supplierid='{$supplierid}' AND m.is_main_item=0 
GROUP BY CASE WHEN inv.section='Guttering' OR inv.section='Flashings' THEN bm.id ELSE bm.materialid END,b.length,b.colour  
";//ORDER BY is_per_length DESC

 				$totalRrp = 0; 
 				$count = 0;
				//error_log("sql : ". $sql, 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_sa\\my-error.log'); 
				//error_log("sql 2: ". $sql2, 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_sa\\my-error.log');
				$item_result = mysql_query ($sql);
				//$num_result = mysql_num_rows($item_result);
				$i = 1; $num_same_inv_id = 0;
				$prev_inv_id = "";
				$m_qty = 0; $m_amount = 0; $is_1st=1; $is_2nd = 0;  
				$m_qty_IRV59 = 0; $m_amount_IRV59 = 0; $m_qty_IRV60 = 0; $m_amount_IRV60 = 0; // Just only for link bar and pivot strip

				if ($section == "Guttering" || $section == "Flashings"){ 

						$is_uom_visible = 0;
						echo " <tr>
				 			 	<th height='23' width='240' colspan='2'>
				 					&nbsp;&nbsp;<b>Description</b> &nbsp;&nbsp;
				 				</th>
				 				<th style='text-align:center;' width='35'>
				 					&nbsp;&nbsp;<b>Qty</b>&nbsp;&nbsp;
				 				</th>
				 				<th style='text-align:center;' width='60'>
				 					 &nbsp;<b>Length</b> &nbsp;
				 				</th>				 				
				 				<th style='text-align:center;' width='65'>
				 					&nbsp;&nbsp;<b>Color</b> &nbsp;&nbsp;
				 				</th>
				 				<th style='text-align:center;' width='80'>
				 					&nbsp;&nbsp;<b>Finish</b> &nbsp;&nbsp;
				 				</th>
				 				<th style='text-align:center;' width='60'>
				 					&nbsp;&nbsp;<b>Price</b> &nbsp;&nbsp;
				 				</th>
				 				<th style='text-align:center;' >
				 					&nbsp;&nbsp;<b>Amount</b> &nbsp;&nbsp;
				 				</th>
				 				<th colspan='2' rowspan='2' style='border:none;' width='100'>&nbsp;&nbsp; <b></b> &nbsp;&nbsp;</th>
				 			 
				 		</tr>";
				 	}else{

						$is_uom_visible = 1;
						echo " <tr>
				 			 	<th height='23' width='280' colspan='2'>
				 					&nbsp;&nbsp;<b>Description</b> &nbsp;&nbsp;
				 				</th>
				 				<th style='text-align:center;' width='35'>
				 					&nbsp;&nbsp;<b>Qty</b>&nbsp;&nbsp;
				 				</th>
				 				<th style='text-align:center;' width='60'>
				 					 &nbsp;<b>Length</b> &nbsp;
				 				</th>
				 				<th style='text-align:center;' width=45>
				 					<b>UOM</b> 
				 				</th>
				 				<th style='text-align:center;' width='65'>
				 					&nbsp;&nbsp;<b>Color</b> &nbsp;&nbsp;
				 				</th>
				 				<th style='text-align:center;' width='80'>
				 					&nbsp;&nbsp;<b>Finish</b> &nbsp;&nbsp;
				 				</th>
				 				<th style='text-align:center;' width='60'>
				 					&nbsp;&nbsp;<b>Price</b> &nbsp;&nbsp;
				 				</th>
				 				<th style='text-align:center;' >
				 					&nbsp;&nbsp;<b>Amount</b> &nbsp;&nbsp;
				 				</th>
				 			 
				 		</tr>";
					}		 	

				while ($m = mysql_fetch_assoc($item_result)){ //this is just to get get the sum of the link bar and pivot strip.
					if(fnmatch("*Double Bay VR*",$contract['framework']) && $section=="Vergola" && $m["inventoryid"]=="IRV59" ){ //IRV59 is a Pivot strip
						  
						$m_qty_IRV59 += $m['m_qty'];
						$m_amount_IRV59 += $m['ls_amount'];
 
					}else if(fnmatch("*Double Bay VR*",$contract['framework'])  && $section=="Vergola" && $m["inventoryid"]=="IRV60" ){ //IRV60 is a Link Bar
 
						$m_qty_IRV60 += $m['m_qty'];
						$m_amount_IRV60 += $m['ls_amount']; 
 
					}
				}	

				mysql_data_seek($item_result, 0); 
				$IRV59_1st=1; $IRV60_1st=1; 
				while ($m = mysql_fetch_assoc($item_result)){
					$m_qty = 0; $m_amount = 0;
					if($m['id']==""){continue;} 
					$totalRrp += $m['ls_amount']; 
					$count++;

					if(fnmatch("*Double Bay VR*",$contract['framework']) && $section=="Vergola" && $m["inventoryid"]=="IRV59" ){ //IRV59 is a Pivot strip
						  
						$m_qty = $m_qty_IRV59;
						$m_amount = $m_amount_IRV59;
 
						if($IRV59_1st==1){
							$IRV59_1st = 0;
						}else{
							continue;
						}
					}else if(fnmatch("*Double Bay VR*",$contract['framework'])  && $section=="Vergola" && $m["inventoryid"]=="IRV60" ){ //IRV60 is a Link Bar
 
						$m_qty = $m_qty_IRV60;
						$m_amount = $m_amount_IRV60;
 
						if($IRV60_1st==1){ 
							$IRV60_1st = 0;
						}else{
							continue;
						} 

						//error_log("INV: ".$m["inventoryid"]." m_qty:".$m_qty." m_amount:".$m_amount, 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_sa\\my-error.log');
 
					}
					//error_log("HERE 2: ", 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_sa\\my-error.log');
					 // only 2nd of IRV59 and IRV60 will be displayed. 
					//error_log("Double Bay VR:".$contract['framework']." section:".$section." inventoryid:".$m["inventoryid"], 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_sa\\my-error.log');
					
 
				?>
				<?php
				if($m["photo"] !="" && $count > 1 && $is_uom_visible == 0) { 
					echo " <tr>
						 	<th height='23' width='240' colspan='2'>
								&nbsp;&nbsp;<b>Description</b> &nbsp;&nbsp;
							</th>
							<th style='text-align:center;' width='35'>
								&nbsp;&nbsp;<b>Qty</b>&nbsp;&nbsp;
							</th>
							<th style='text-align:center;' width='60'>
								 &nbsp;<b>Length</b> &nbsp;
							</th>
							<th style='text-align:center;' width='65'>
								&nbsp;&nbsp;<b>Color</b> &nbsp;&nbsp;
							</th>
							<th style='text-align:center;' width='80'>
								&nbsp;&nbsp;<b>Finish</b> &nbsp;&nbsp;
							</th>
							<th style='text-align:center;' width='60'>
								&nbsp;&nbsp;<b>Price</b> &nbsp;&nbsp;
							</th>
							<th style='text-align:center;' >
								&nbsp;&nbsp;<b>Amount</b> &nbsp;&nbsp;
							</th>
							<th colspan='2' rowspan='2' style='border:none;' width='100'>&nbsp;&nbsp; <b></b> &nbsp;&nbsp;</th>

						 
					</tr>";
					}else{} 
					?>				
					<tr style='page-break-before: auto; page-break-after: avoid !important; clear:both;'> 

						<td style="border-collapse:collapse;font-size:9.8;"  colspan="2">&nbsp;&nbsp;<?php echo $m['raw_description']; ?></td>  
						<td style="border-collapse:collapse;font-size:9.8;text-align:right;"><?php echo number_format(($m_qty>0?$m_qty:$m['m_qty'])); ?>&nbsp;&nbsp;</td> 
						<td style="border-collapse:collapse;font-size:9.8;text-align:right;"><?php echo ($m['uom']=="Mtrs" && METRIC_SYSTEM == "inch"?get_feet_value($m['length']):($m['uom']=="Mtrs"?$m['length']:"")); ?>&nbsp;&nbsp;</td>						
						<?php if($is_uom_visible==1){ ?>
							<td style="border-collapse:collapse;font-size:9.8;text-align:center;"><?php echo $m['uom']; ?>&nbsp;&nbsp;</td> <?php } ?>
						<td style="border-collapse:collapse;font-size:9.8;text-align:center;"><?php echo ($m['colour'] == null?"":$m['colour']); ?>&nbsp;&nbsp;</td>
						<td style="border-collapse:collapse;font-size:9.8;text-align:center;"><?php echo ($m['finish'] == "null"?" ":$m['finish']); ?>&nbsp;&nbsp;</td>
						<td style="border-collapse:collapse;font-size:9.8;text-align:right;">$<?php echo number_format($m['raw_cost'],2); ?>&nbsp;&nbsp;</td>
						<td style="border-collapse:collapse;font-size:9.8;text-align:right;">$<?php echo number_format(($m_amount>0?$m_amount:$m['ls_amount']),2); ?>&nbsp;&nbsp;</td>

						<!-- 
						<td colspan="2"><?php echo $m['raw_description']; ?></td>  
						<td style="text-align:right;height:30px;"><?php echo number_format(($m_qty>0?$m_qty:$m['m_qty'])); ?></td>
						<td style="text-align:right;"><?php echo ($m['uom']=="Mtrs" && METRIC_SYSTEM == "inch"?get_feet_value($m['length']):($m['uom']=="Mtrs"?$m['length']:"")); ?></td>
						<td style="text-align:right;"><?php echo $m['uom']; ?></td> 
						<td><?php echo $m['colour']; ?></td>
						<td><?php echo $m['finish']; ?></td>
						<td style="text-align:right;">$<?php echo number_format($m['raw_cost'],2); ?></td>
						<td style="text-align:right;">$<?php echo number_format(($m_amount>0?$m_amount:$m['ls_amount']),2); ?></td>
						 -->

					</tr>  

				<?php
				$m_qty = 0; $m_amount = 0; $is_2nd = 0; 

				// if($m["photo"] !=""  ){ //$section=="Guttering"
				if($is_uom_visible==0) {

				?>
		<!-- <div style="page-break-inside: avoid !important;"> -->
		<table style='page-break-inside: avoid !important; table-row-group;'> 
			<tbody style='page-break-inside: avoid !important; page-break-after: auto; clear:both;'> 
				<tr style='page-break-inside: avoid !important;' nobr="true">
					<tr>
  						<?php if($is_uom_visible==1){ ?>
							<!-- <td colspan="8" rowspan="9" valign="middle" align="center" style="border:none; page-break-inside:avoid !important; table-row-group;">  -->
						<?php }else{

  							} ?>
  			  			<td colspan="8" rowspan="11" valign="middle" align="center" style="border:none; page-break-inside:avoid !important; table-row-group;">
  			  				<?php
  				  			if($is_uom_visible==0) { 
  				  				echo " <img src='".JURI::base()."images/inventory/".$m['photo']."' class='' style='float:middle; margin:1px; height: 176px; max-width: 600px;'/>";
  							} 
  							?>
  			  			</td>	
				<?php 
					//mysql_data_seek($item_result, 0); 
						
						if($prev_inv_id==""){
							$prev_inv_id = $m['inventoryid'];

						}else if($prev_inv_id == $m['inventoryid']){
							 
							$num_same_inv_id++;

						}else{
							$num_same_inv_id = 0;
						}

						// $sql = "SELECT id.length AS l,id.dimension_a,id.dimension_b,id.dimension_c,id.dimension_d,id.dimension_e,id.dimension_f,id.dimension_p, FLOOR (id.dimension_a+id.dimension_c+id.dimension_e+id.dimension_f+id.dimension_p) AS girth_a,FLOOR(id.dimension_b+id.dimension_d+id.dimension_e+id.dimension_f+id.dimension_p) AS girth_b  FROM ver_chronoforms_data_contract_items_deminsions  AS id   WHERE projectid = '{$projectid}' AND inventoryid='{$m['inventoryid']}' LIMIT 1  OFFSET {$num_same_inv_id} ";

			            $sql = "
					            SELECT
					            	bm.length AS l,
					            	id.dimension_a,
					            	id.dimension_b,
					            	id.dimension_c,
					            	id.dimension_d,
					            	id.dimension_e,
					            	id.dimension_f,
					            	id.dimension_p,
					            	id.dimension_g,
					            	id.dimension_h,
					            	FLOOR (	id.dimension_a + id.dimension_c + id.dimension_e + id.dimension_f + IFNULL(id.dimension_g,0) + IFNULL(id.dimension_h,0) + id.dimension_p ) AS girth_a,
					            	FLOOR (	id.dimension_b + id.dimension_d + id.dimension_e + id.dimension_f + IFNULL(id.dimension_g,0) + IFNULL(id.dimension_h,0) + id.dimension_p ) AS girth_b 
					            FROM	
					            	ver_chronoforms_data_contract_items_deminsions AS id
					            	LEFT JOIN ver_chronoforms_data_contract_bom_meterial_vic AS bm ON bm.contract_item_cf_id = id.cf_id
					            	LEFT JOIN ver_chronoforms_data_contract_items_default_deminsions AS idd ON idd.inventoryid = bm.inventoryid
					            WHERE
					            	id.projectid = '{$projectid}'
					            	AND id.inventoryid = '{$m['inventoryid']}'
			                 		AND id.cf_id = '{$m['contract_item_cf_id']}'
					            	LIMIT 1 OFFSET 0;";
						//error_log("sql G: ". $sql, 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_sa\\my-error.log');
						// echo $sql;
						$r_item_dimension = mysql_query ($sql);
						$item_dimension = mysql_fetch_assoc($r_item_dimension);	


							if(!empty($item_dimension) || empty($item_dimension)){
						?>   
						  	   
							<td colspan="1" valign="middle" align="right" style="border:none; background-color:#cccccc; height:23.20px;">Girth A&nbsp;&nbsp;</td>
							<td colspan="1" valign="middle" align="center" style="border:none; background-color:#cccccc; "><?php echo ($item_dimension["girth_a"] > 0 ? $item_dimension["girth_a"] :""); ?> </td>				
						</tr>
						<tr >
							<td colspan="1" valign="middle" align="right"  style="border:none; background-color:#cccccc; height:23.20px;">Girth B&nbsp;&nbsp;</td>
							<td colspan="1" valign="middle" align="center" style="border:none; background-color:#cccccc; "><?php echo ($item_dimension["girth_b"] > 0 ? $item_dimension["girth_b"] :""); ?> </td>
						</tr>							
						<tr >
							<td colspan="1" valign="middle" align="right"  style="border:none; background-color:#cccccc; height:23.20px;">A&nbsp;&nbsp;</td>
							<td colspan="1" valign="middle" align="center" style="border:none; background-color:#cccccc; "><?php echo ($item_dimension["dimension_a"] > 0 ? $item_dimension["dimension_a"] :""); ?> </td>
						</tr>
						<tr >
							<td colspan="1" valign="middle" align="right"  style="border:none; background-color:#cccccc; height:23.20px;">B&nbsp;&nbsp;</td>
							<td colspan="1" valign="middle" align="center" style="border:none; background-color:#cccccc; "><?php echo ($item_dimension["dimension_b"] > 0 ? $item_dimension["dimension_b"] :""); ?> </td>
						</tr>
						<tr >
							<td colspan="1" valign="middle" align="right"  style="border:none; background-color:#cccccc; height:23.20px;">C&nbsp;&nbsp;</td>
							<td colspan="1" valign="middle" align="center" style="border:none; background-color:#cccccc; "><?php echo ($item_dimension["dimension_c"] > 0 ? $item_dimension["dimension_c"] :""); ?> </td>
						</tr>
						<tr >
							<td colspan="1" valign="middle" align="right"  style="border:none; background-color:#cccccc; height:23.20px;">D&nbsp;&nbsp;</td>
							<td colspan="1" valign="middle" align="center" style="border:none; background-color:#cccccc; "><?php echo ($item_dimension["dimension_d"] > 0 ? $item_dimension["dimension_d"] :""); ?> </td>
						</tr>
						<tr > 
							<td colspan="1" valign="middle" align="right"  style="border:none; background-color:#cccccc; height:23.20px;">E&nbsp;&nbsp;</td>
							<td colspan="1" valign="middle" align="center" style="border:none; background-color:#cccccc; "><?php echo ($item_dimension["dimension_e"] > 0 ? $item_dimension["dimension_e"] :""); ?> </td>
						</tr>
						<tr >
							<td colspan="1" valign="middle" align="right"  style="border:none; background-color:#cccccc; height:23.20px;">F&nbsp;&nbsp;</td>
							<td colspan="1" valign="middle" align="center" style="border:none; background-color:#cccccc; "><?php echo ($item_dimension["dimension_f"] > 0 ? $item_dimension["dimension_f"] :""); ?> </td>
						</tr>
						<tr >
						  <td colspan="1" valign="middle" align="right"  style="border:none; background-color:#cccccc; height:23.20px;">G&nbsp;&nbsp;</td>
						  <td colspan="1" valign="middle" align="center" style="border:none; background-color:#cccccc; "><?php echo ($item_dimension["dimension_g"] > 0 ? $item_dimension["dimension_g"] :""); ?> </td>
						</tr> 
						<tr >
						  <td colspan="1" valign="middle" align="right"  style="border:none; background-color:#cccccc; height:23.20px;">H&nbsp;&nbsp;</td>
						  <td colspan="1" valign="middle" align="center" style="border:none; background-color:#cccccc; "><?php echo ($item_dimension["dimension_h"] > 0 ? $item_dimension["dimension_h"] :""); ?> </td>
						</tr> 						
						<tr >
							<td colspan="1" valign="middle" align="right"  style="border:none; background-color:#cccccc; height:23.20px;">P&nbsp;&nbsp;</td>
							<td colspan="1" valign="middle" align="center" style="border:none; background-color:#cccccc; "><?php echo ($item_dimension["dimension_p"] > 0 ? $item_dimension["dimension_p"] :""); ?> </td>
						</tr> 
					  		 
					   
			  	<?php 
			  		
			  	 	} //end if if it has a dimension
			   		
			   		$i++; 

			   		if($m["photo"] !="" ){

			   			// echo "<tr>
					  		// 	<td colspan=\"9\" style=\"border:none\">&nbsp;</td> 
					  		// </tr>";
						/*
						echo "<tr style=\"background-color: #cccccc;border-color: #000000;\">
							  	<td colspan=\"9\" style=\"border:none;\"></td></tr>
							
							<tr style=\"border-color: #000000;background-color: #ffffff;border-right-color: #ffffff;border-left-color: #ffffff;\">
								<td colspan=\"9\" style=\"height:27px;border-right-color: #ffffff;border-left-color: #ffffff; page-break-after: auto; clear:both;\"></td>
							</tr>
						*/	

			echo "</tr></tbody</table>";	
			   		}  
			   	?>

			  	<?php 
			  		} //end of if it has a photo	
			  	} //end of while for the no main item materials
			  	?>

			  	<?php
					$item_result2 = mysql_query ($sql2);
					
					while ($m = mysql_fetch_assoc($item_result2)){ 
						$totalRrp += $m['ls_amount']; 
						if($m['id']==""){continue;} 
					?>  
						<!-- 
						<tr> 
							<td colspan="2"><?php echo $m['raw_description']; ?></td>  
							<td style="text-align:right;"><?php echo number_format($m['ls_qty']); ?></td>
							<td style="text-align:right;"><?php echo ($m['uom']=="Mtrs" && METRIC_SYSTEM == "inch"?get_feet_value($m['length']):($m['uom']=="Mtrs"?$m['length']:"")); ?></td>
							<td style="text-align:right;"><?php echo $m['uom']; ?></td> 
							<td> &nbsp; </td>
							<td> &nbsp; </td>
							<td style="text-align:right;">$<?php echo number_format($m['raw_cost'],2); ?></td>
							<td style="text-align:right;">$<?php echo number_format($m['ls_amount'],2); ?></td> 
						</tr> 
						 -->

						<tr> 
							<td style="border-collapse:collapse;font-size:9.8;" colspan="2">&nbsp;&nbsp;<?php echo $m['raw_description']; ?></td>  
							<td style="border-collapse:collapse;font-size:9.8;text-align:right;"><?php echo number_format(($m_qty>0?$m_qty:$m['ls_qty'])); ?>&nbsp;&nbsp;</td> 
							<td style="border-collapse:collapse;font-size:9.8;text-align:right;"><?php echo ($m['uom']=="Mtrs" && METRIC_SYSTEM == "inch"?get_feet_value($m['length']):($m['uom']=="Mtrs"?$m['length']:"")); ?>&nbsp;&nbsp;</td>
							<td style="border-collapse:collapse;font-size:9.8;text-align:center;"><?php echo $m['uom']; ?></td> 
							<td> &nbsp; </td>
							<td> &nbsp; </td>
							<td style="border-collapse:collapse;font-size:9.8;text-align:right;">$<?php echo number_format($m['raw_cost'],2); ?>&nbsp;&nbsp;</td>
							<td style="border-collapse:collapse;font-size:9.8;text-align:right;">$<?php echo number_format($m['ls_amount'],2); ?>&nbsp;&nbsp;</td> 
						</tr> 

			  	<?php

				
			} // end of loop of m	

				?>
  
		<?php //} //------------ bm END contract_bom_vic loop. 

			$gst = $totalRrp * 0.1;
			$totalSum = $totalRrp + $gst;

		 ?>  	
</table>

<br/>
<div style="page-break-inside: avoid !important;">
<table width="100%" > 
 
 	<tr>
 		<td width="250" colspan="2">
			&nbsp;&nbsp; 
		</td>
		<td width="50">
			&nbsp;&nbsp; 
		</td>
		<td width="50">
			 &nbsp;&nbsp;
		</td>
		<td width="40">
			 &nbsp;&nbsp;
		</td> 
		 
		<td  colspan="2" style="text-align:right" width="120">
			<span><b>Sub Total</b></span>&nbsp;&nbsp;&nbsp;&nbsp;
		</td> 
		<td style="text-align:right" width="90">
		 	$<?php echo number_format($totalRrp,2); ?>
		</td>
	</tr>
	<tr>
		<td colspan="7" style="text-align:right"> 
			<span ><b>GST</b></span>&nbsp;&nbsp;&nbsp;&nbsp;
		</td>
		 	
		<td style="text-align:right">
		 	$<?php echo number_format($gst,2); ?>
		</td>
	</tr>
	<tr>
		<td colspan="7" style="text-align:right"> 
			<span  ><b>Total Inclusive of GST</b></span>&nbsp;&nbsp;&nbsp;&nbsp;
		</td>
	 			
		<td style="text-align:right">
		 	$<?php echo number_format($totalSum,2); ?>
		</td>
	</tr>  
	 
</table>
</div>
<br/><br/>
Measurement Tolerance - 0m / + 1mm &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Length Tolerance - 0m / + 10mm <br/>
NOTE: all folds are 90&deg; unless otherwise stated



</div> 
</textarea>
<input type="submit" class="btn" name="add" id="add1" value="Download PDF"> <input class="btn" type="button" value="Close" onClick="window.opener=null; window.close(); return false;">

</form>
</body>
</html>


<?php
	
function get_feet_value($inches){
	return floor($inches / 12)."&rsquo;" . floor($inches % 12);
     
}

function get_feet_whole($inches){
	return floor($inches / 12);
     
}

function get_feet_inch($inches){
	return floor($inches % 12);
     
}
 
?> 