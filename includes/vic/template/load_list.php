<?php
$print_section = "";
if(isset($_GET["print_section"])){
	$print_section = $_GET["print_section"];
}

$QuoteID = 0;
if(isset($_REQUEST['pid']))
	$QuoteID =$_REQUEST['pid'];

if(isset($_REQUEST['clientid']))
	$clientid =$_REQUEST['clientid'];

$QuoteIDAlpha = substr($QuoteID, 0, 3);
$current_date = date('Y-m-d H:i:s');

//error_log($QuoteIDAlpha, 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_sa\\my-error.log');
if(isset($_POST['add']))
{	
    $template_clientid=$_POST['clientid'];
	$template_title=$_POST['title'] ; 
	$template_content=addslashes($_POST['htmlcontent']);
     
    $sql = "INSERT INTO ver_chronoforms_data_letters_vic (clientid, template_name, datecreated, template_content, template_type) 
		 VALUES ('$template_clientid','$template_title', '".date('Y-m-d H:i:s')."', '$template_content', 'check list')"; 
	mysql_query($sql); 

	//error_log("sql: ".$sql, 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_sa\\my-error.log');
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
 
.template_tbl {border:1px solid black;  min-width:900px;padding:0px; border-collapse:collapse;  }
 
</style>
</head>
<body>
<?php
 
 
$projectid = mysql_real_escape_string($_REQUEST['projectid']);
$section = mysql_real_escape_string($_REQUEST['section']);
$titleID = mysql_real_escape_string($_REQUEST['titleID']);
$supplierid = mysql_real_escape_string($_REQUEST['supplierid']);

$ListProjectID = $projectid;

$inventoryid = "";
$is_reorder = 0;
if($section=="reorder"){
	$is_reorder = 1;
	$inventoryid = mysql_real_escape_string($_REQUEST['inventoryid']);
}

//$sql = "SELECT * FROM ver_chronoforms_data_contract_list_vic  AS contract LEFT JOIN ver_chronoforms_data_clientpersonal_vic AS c ON c.clientid = contract.quoteid WHERE  contract.projectid = '{$projectid}' ";
//error_log($sql, 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_sa\\my-error.log');exit();
$sql = "SELECT * FROM ver_chronoforms_data_contract_list_vic AS contract JOIN ver_chronoforms_data_clientpersonal_vic AS c ON c.clientid = contract.quoteid JOIN ver_chronoforms_data_contract_vergola_vic as cv ON cv.projectid=contract.projectid WHERE  contract.projectid = '".$projectid."' ";
// error_log($sql, 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_sa\\my-error.log');
$qContract = mysql_query($sql);
$contract = mysql_fetch_array($qContract); 
//error_log(print_r($contract,true), 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_sa\\my-error.log');exit();

 
 

?>

<form method="post">
<input name="clientid" id="clientid" type="hidden" value="<?php echo $clientid; ?>">
<input name="title" id="title" type="hidden" value="<?php echo $titleID; ?>">
 
<textarea name="htmlcontent" id="htmlcontent" class="mce_editable" style="width:100%;height:100%!important; ">
<div style="font-family:Arial, Helvetica, sans-serif; width:700px;  font-size: 9pt;">

<table border="0" cellspacing="0" style="border-collapse:collapse;" width="100%"  cellpadding="8">
<tr ><td colspan="5"  ><p style="font-size: 14pt; text-align: center;"><b>Vergola Installer General Load List</b></p></td></tr>

<tr  ><td colspan="2"  width="45%"  style="border:none; text-align: center;"><b>Job No.: <?php  echo $contract["projectid"]; ?></b> </td><td  border="0"   style="border:none;" width="5%"></td><td colspan="2"  border="0"  width="45%"  style="border:none; text-align: center;"> <b>Description: <?php  echo $contract["framework"]; ?></b></td>
</tr> 
</table>

<table border="1" cellspacing="0" style="border-collapse:collapse;" width="100%"  cellpadding="8"> 
<tr  >
	<td colspan="2" width="50%"  >
		<b>Client Name:</b>&nbsp;<?php if($contract["is_builder"]==1){ echo $contract["builder_name"]; }else{ echo $contract["client_firstname"]." ".$contract["client_lastname"];} ?> 
	</td> 
	<td colspan="2" width="50%"   >
		<b>Installer:</b> <?php echo $contract["erectors_name"]; ?> 
	</td  >
</tr>
 
<tr>
	<td  > Wk Ph:<?php echo $contract["client_wkphone"]; ?> </td>
	<td  > Hm Ph:<?php echo $contract["client_hmphone"]; ?> </td> 
	<td  >  Fees: $<?php echo $contract["client_wkphone"]; ?> </td>
	<td  >Extras: $<?php echo $contract["client_hmphone"]; ?></td>
</tr>
 
<tr>
	<td colspan="2" style="  vertical-align:top;"  >
		<span>Mobile:</span><?php echo $contract["client_mobile"]; ?> 
	</td> 
	<td  colspan="2"  ><b>Special Instructions:</b><br/><br/><br/></td>
</tr> 
</table>
 
<br/>
<table class=""   cellspacing="0" style="border-collapse:collapse;font-size:9pt;" >
	<tr >
		 	<th width="350" colspan="2" border="1" style="text-align: center;" >
				&nbsp;&nbsp;<b>Description</b> &nbsp;&nbsp;
			</th>
			<th width="50" border="1" style="text-align: right;">
				&nbsp;&nbsp;<b>Qty</b>&nbsp;&nbsp;
			</th>
			<th width="50" border="1" style="text-align: right;">
				 <b>Length</b> 
			</th>
			<th width="40" border="1" style="text-align: center;" >
				 <b>UOM</b> 
			</th> 
			<th width="60" border="1" style="text-align: left;">
				&nbsp;&nbsp;<b>Color</b> &nbsp;&nbsp;
			</th>
			<th width="75" border="1" >
				&nbsp;&nbsp;<b>Picked Up</b> &nbsp;&nbsp;
			</th>
			<th width="75"  >
				&nbsp;&nbsp;<b>Received</b> &nbsp;&nbsp;
			</th>  
	</tr>


	<?php
 
$has_materials = 0;
	$sql = "SELECT * FROM ver_chronoforms_data_inventory_vic WHERE section IN ('Frame','Fixings','Downpipe','Vergola') GROUP BY section  ORDER BY inventoryid";

	$qcat = mysql_query ($sql);
	while ($cat = mysql_fetch_assoc($qcat)) {
		 
		$has_materials = 0;
		
			$sql = "SELECT process_po FROM  ver_chronoforms_data_contract_bom_meterial_vic AS bm WHERE bm.projectid = '$ListProjectID' AND bm.section='{$cat['section']}'   "; 
			//error_log( $sql, 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_sa\\my-error.log');
			$req = mysql_query ($sql) or die ('request "Could not execute SQL query" '.$sql);  
			$n = mysql_num_rows($req);
			$r = mysql_fetch_assoc($req);
			//error_log( "n=".$n, 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_sa\\my-error.log');
			if($n>0){
				$has_materials = 1;
				$process_po = $r['process_po'];
			}else{
				echo "</td> </tr>";
				continue;
			}


			$titleID = $ListProjectID."_"."frame"."_".mt_rand(); 

			  
					//Main item of a raw material that should display first like beam and post.
					$sql = "SELECT bm.id, m.qty, (m.qty*bm.qty) AS m_qty, bm.qty  AS ls_qty, bm.length,
					    CASE WHEN m.uom='Mtrs' 
					        THEN bm.raw_cost * bm.qty * bm.length  
					        ELSE bm.raw_cost * bm.qty END AS ls_amount,
					    bm.projectid, bm.inventoryid, bm.materialid, bm.raw_cost, bm.qty as bm_qty, bm.supplierid, m.raw_description, m.is_per_length, m.length_per_ea, m.uom, inv.photo, b.colour, b.finish
					FROM ver_chronoforms_data_contract_bom_meterial_vic AS bm  
					JOIN ver_chronoforms_data_contract_bom_vic AS b ON b.contract_item_cf_id=bm.contract_item_cf_id
					JOIN ver_chronoforms_data_inventory_vic AS inv ON inv.inventoryid=bm.inventoryid 				
					JOIN ver_chronoforms_data_materials_vic AS m ON m.cf_id=bm.materialid  
					WHERE bm.projectid = '{$projectid}' AND inv.section='{$cat['section']}' ".($is_reorder==1?" AND bm.inventoryid='{$inventoryid}' ":"  ")."  AND m.is_main_item=1  "; //ORDER BY is_per_length DESC, bm.id, b.length DESC, b.qty DESC
 	
 					$sql2 = "SELECT bm.id,   m.qty, (m.qty*bm.qty) AS m_qty, bm.length, bm.qty  AS ls_qty, SUM(bm.qty) AS t_qty, 
					    CASE WHEN m.uom='Mtrs' 
					        THEN bm.raw_cost * bm.qty * bm.length  
					        ELSE bm.raw_cost * bm.qty END AS ls_amount,  
					    bm.projectid, bm.inventoryid, bm.materialid, bm.raw_cost, bm.qty as bm_qty, bm.supplierid, m.raw_description, m.is_per_length, m.length_per_ea, m.uom  
					FROM ver_chronoforms_data_contract_bom_meterial_vic AS bm   
					JOIN ver_chronoforms_data_inventory_vic AS inv ON inv.inventoryid=bm.inventoryid 				
					JOIN ver_chronoforms_data_materials_vic AS m ON m.cf_id=bm.materialid  
					WHERE bm.projectid = '{$projectid}' AND inv.section='{$cat['section']}'".($is_reorder==1?" AND bm.inventoryid='{$inventoryid}' ":"  ")."   AND m.is_main_item=0  GROUP BY materialid  ";//ORDER BY is_per_length DESC

	 				$totalRrp = 0; 
					//error_log("sql : ". $sql, 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_sa\\my-error.log'); 
					// error_log("sql 2: ". $sql2, 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_sa\\my-error.log');
					$item_result = mysql_query ($sql);
					//$num_result = mysql_num_rows($item_result);
					$i = 1; $num_same_inv_id = 0;
					$prev_inv_id = "";
					$m_qty = 0; $m_amount = 0; $is_1st = 1; $is_2nd = 0; 
					while ($m = mysql_fetch_assoc($item_result)){ 
						if($is_1st){ 
							echo "<tr><td colspan='7'><b><u>".($cat['section']=="Frame"?"Framework":($cat['section']=="Fixings"?"Fittings":$cat['section']))."</u></b></td></tr>";
						} 
						if($m['id']==""){continue;$is_1st=0;} 
						$totalRrp += $m['ls_amount']; 
						 // only 2nd of IRV59 and IRV60 will be displayed. 
						if(fnmatch("*Double Bay VR*",$contract['framework']) && $section=="Vergola" && $m["inventoryid"]=="IRV59" ){ //IRV59 is a Pivot strip
							$m_qty += $m['m_qty'];
							$m_amount += $m['ls_amount'];

							if($is_2nd==0){
								$is_2nd = 1; //come here just for 1st time.
								continue;
							} 
						}else if(fnmatch("*Double Bay VR*",$contract['framework'])  && $section=="Vergola" && $m["inventoryid"]=="IRV60" ){ //IRV60 is a Link Bar
							$m_qty += $m['m_qty'];
							$m_amount += $m['ls_amount'];

							if($is_2nd==0){
								$is_2nd = 1;  
								continue;
							} 
	 
						}else{
							$m_qty = 0; $m_amount = 0; $is_2nd = 0; 
						} 

					?>  
						<tr border="0"> 
							<td colspan="2"><?php echo $m['raw_description']; ?></td>  
							<td style="text-align:right;"><?php echo number_format(($m_qty>0?$m_qty:$m['m_qty'])); ?></td>
							<td style="text-align:right;"><?php echo ($m['uom']=="Mtrs" && METRIC_SYSTEM == "inch"?get_feet_value($m['length']):($m['uom']=="Mtrs"?$m['length']:"")); ?></td>
							<td style="text-align:right;"><?php echo $m['uom']; ?></td> 
							<td><?php echo $m['colour']; ?></td>
							<td style='text-align: center;'>  <img src='<?php echo JURI::base(); ?>images/box.jpg' class='' />  </td>
							<td style="text-align: center;"> <img src='<?php echo JURI::base(); ?>images/box.jpg' class='' /> </td> 
						</tr>  
   		 
						   
				  	<?php 
				  		$i++; 
				  		$is_1st=0;
				  		} //end of while for the no main item materials
				  	?>

				  	<?php
					$item_result2 = mysql_query ($sql2);
					
					while ($m = mysql_fetch_assoc($item_result2)){ 
						$totalRrp += $m['ls_amount']; 
						if($m['id']==""){continue;} 
					?>  
						<tr> 
							<td colspan="2"><?php echo $m['raw_description']; ?></td>  
							<td style="text-align:right;"><?php echo number_format($m['t_qty']); ?></td>
							<td style="text-align:right;"><?php echo ($m['uom']=="Mtrs" && METRIC_SYSTEM == "inch"?get_feet_value($m['length']):($m['uom']=="Mtrs"?$m['length']:"")); ?></td>
							<td style="text-align:right;"><?php echo $m['uom']; ?></td> 
							<td><?php echo $m['colour']; ?></td>
							<td style='text-align:center;'> <img src='<?php echo JURI::base(); ?>images/box.jpg' class='' /> </td>
							<td style="text-align:center;"> <img src='<?php echo JURI::base(); ?>images/box.jpg' class='' /> </td> 
						</tr> 

			  	<?php }  ?>

			  	<?php  
			//	} //end of bom material loop  	
			} //end of inventory section type
			  	?>

			   
  
		<?php //} //------------ bm END contract_bom_vic loop. 

			$gst = $totalRrp * 0.1;
			$totalSum = $totalRrp + $gst;

		 ?>  	
</table>

<br/> 


</div> 
</textarea>
<input type="submit" class="btn" name="add" id="add1" value="Save"> <input class="btn" type="button" value="Close" onClick="window.opener=null; window.close(); return false;">

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