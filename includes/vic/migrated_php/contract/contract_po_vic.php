<?php
include 'includes/vic/custom_processes_user.php';

$current_signed_in_user_access_profiles = $custom_configs_user['user_access_profiles'][$current_signed_in_user_group_key]['contract-po-vic'];
?>


<script src="<?php echo JURI::base().'jscript/jsapi.js'; ?>"></script>
<script src="<?php echo JURI::base().'jscript/jquery.min.js'; ?>"></script>
<script src="<?php echo JURI::base().'jscript/jquery-ui.min.js'; ?>" type="text/javascript"></script>
<script src="<?php echo JURI::base().'jscript/labels.js'; ?>"></script>
<script type="text/javascript" src="<?php echo JURI::base().'jscript/lightbox.js'; ?>"></script>
<script type="text/javascript" src="<?php echo JURI::base().'jscript/tabcontent.js'; ?>"></script>
<link rel="stylesheet" type="text/css" media="screen,projection" href="<?php echo JURI::base().'jscript/custom.css'; ?>" />
<link rel="stylesheet" type="text/css" media="screen,projection" href="<?php echo JURI::base().'jscript/new-enquiry.css'; ?>" />
<link rel="stylesheet" type="text/css" media="screen,projection" href="<?php echo JURI::base().'jscript/client-folder.css'; ?>" />
<link rel="stylesheet" type="text/css" media="screen,projection" href="<?php echo JURI::base().'jscript/contract-folder.css'; ?>" />
<link rel="stylesheet" type="text/css" media="screen,projection" href="<?php echo JURI::base().'jscript/lightbox.css'; ?>" />

<?php 
$is_jump_to_download_pdf = 0;
$view = $_REQUEST['view']; 
$is_summary_view = 0;
$page_name = isset($_REQUEST['page_name']) ? $_REQUEST['page_name'] : '';


if(isset($_REQUEST['titleID']) ){
	$is_jump_to_download_pdf = 1;
}

if($view=="summary"){
	$is_summary_view = 1;
}



if(isset($_POST['update_materials']) ){
	   
	    for ($i=0; $i<count($_POST['contract_item_cf_id']); $i++) { 
	    		$id = mysql_real_escape_string($_POST['id'][$i]);
  				$contract_item_cf_id = mysql_real_escape_string($_POST['contract_item_cf_id'][$i]);
    			$cost = mysql_real_escape_string($_POST['raw_cost'][$i]);
    			$supplierid = mysql_real_escape_string($_POST['supplierid'][$i]);  

    			$sql = "UPDATE ver_chronoforms_data_contract_bom_meterial_vic SET raw_cost={$cost}, supplierid='{$supplierid}', process_po=1  WHERE  id={$id}  ";
				//error_log($sql."- ", 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_us\\my-error.log'); 
				mysql_query($sql);
 
		}
}

if(isset($_POST['cancel_process_po']) ){
	  // error_log(" here cancel ", 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_us\\my-error.log'); 
	    for ($i=0; $i<count($_POST['contract_item_cf_id']); $i++) { 
	    		$id = mysql_real_escape_string($_POST['id'][$i]);
  				//$contract_item_cf_id = mysql_real_escape_string($_POST['contract_item_cf_id'][$i]);
    			//$cost = mysql_real_escape_string($_POST['raw_cost'][$i]);
    			//$supplierid = mysql_real_escape_string($_POST['supplierid'][$i]); 
 
    			$sql = "UPDATE ver_chronoforms_data_contract_bom_meterial_vic SET   process_po=0 WHERE  id={$id}  ";
				//error_log($sql."- ", 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_us\\my-error.log'); 
				mysql_query($sql);
 
		}
}


$cust_id = mysql_real_escape_string($_REQUEST['quoteid']);
$projectid = mysql_real_escape_string($_REQUEST['projectid']); 
$quoteid = $cust_id;

if ($projectid != '') {
// Get Contract Items
	 
$sql = "SELECT * FROM ver_chronoforms_data_contract_list_vic WHERE quoteid = '$cust_id' and projectid = '$projectid'";
 // error_log($sql, 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_us\\my-error.log');	 
$resultdetails = mysql_query($sql);
$retrievedetails = mysql_fetch_array($resultdetails);
if (!$resultdetails) {die("Error: Data not found..");} 
$ListProjName = $retrievedetails['project_name'];
$ListProjectID = $retrievedetails['projectid'];
$ListFramework = $retrievedetails['framework_type'];
$ListVergolaType = $retrievedetails['framework'];
 

}else {
// Get Contract Items
$resultdetails = mysql_query("SELECT * FROM ver_chronoforms_data_contract_list_vic WHERE quoteid = '$cust_id' ORDER BY quotedate DESC");
$retrievedetails = mysql_fetch_array($resultdetails);
if (!$resultdetails) {die("Error: Data not found..");} 
$ListProjName = $retrievedetails['project_name'];
$ListProjectID = $retrievedetails['projectid']; 
$ListFramework = $retrievedetails['framework_type'];
$ListVergolaType = $retrievedetails['framework'];
 
}

// $qry = "SELECT * FROM ver_chronoforms_data_contract_bom_vic WHERE quoteid = '$cust_id' and projectid = '{$ListProjectID}' ";
// //error_log($qry, 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_us\\my-error.log');	
// $resultbom = mysql_query($qry);

// $retrievebom = mysql_fetch_array($resultbom);
// if (!$resultbom) {die("Error: Data not found..");} 
// $BOMSupplierID = $retrievebom['supplierid'];
// $BOMOrderDate = $retrievebom['orderdate'];
 
 
$print_id = "";
if(isset($_REQUEST["print_id"])){
	$print_id = $_REQUEST["print_id"];
} 




global $suppliers;
$suppliers = [];
$sql = "SELECT * FROM ver_chronoforms_data_supplier_vic "; 
$result = mysql_query ($sql); 
while ($supplier = mysql_fetch_assoc($result)) 
	{ 
		//error_log($colour['colour'], 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_us\\my-error.log');
		array_push($suppliers,$supplier);		 
	} 
//error_log(print_r($suppliers,true), 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_us\\my-error.log');  

function cbo_supplier($supplier_id=null,$name=null){
	global $suppliers;
	$cbo_suppliers = "<select class=\"cbo_suppliers\"   name=\"{$name}\" >";
		foreach  ($suppliers as $s){
			$cbo_suppliers .= "<option value=\"{$s['supplierid']}\" ";
			//error_log($colour['colour'] .'=' . $item['colour'], 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_us\\my-error.log');
			if ($supplier_id == $s['supplierid']) { $cbo_suppliers .= " selected ";} 
			else { 
				$cbo_suppliers .= "";
			}
			$cbo_suppliers .= ">{$s['company_name']}</option>";
		}
		$cbo_suppliers .= "</select>";
	return $cbo_suppliers;
  
 
}

$process_po = 0; 
  
?>

<!-- <button class="btn" onclick="window.history.back();" style="margin:0 0 5px 0;">&nbsp; Close &nbsp; </button> -->
<?php //echo "<a href=\"".JURI::base()."contract-listing-vic/contract-folder-vic/contract-bom-vic?quoteid=".$cust_id."&projectid=".$projectid."\" class='btn ' style='display:block; padding: 6px; text-align: center; width: 100px;'>&nbsp;&nbsp; Close &nbsp;&nbsp;</a>"; ?>
 <!-- -------------------  BUTTON NAVIGATION ----------------------------- --> 
  		<?php echo "<a href=\"".JURI::base()."contract-listing-vic/contract-folder-vic/contract-folder-vic?quoteid=".$quoteid."&projectid=".$projectid."\" class='btn '>&nbsp;&nbsp; Contract Details &nbsp;&nbsp;</a>&nbsp;"; ?>
  		<?php echo "<a href=\"".JURI::base()."view-quote-vic?ref=back&quoteid=".$quoteid."&projectid=".$projectid."&ref_page=contracts&page_name=quote_details\" class='btn '>&nbsp;&nbsp; Quote Details &nbsp;&nbsp;</a>&nbsp;"; ?>
  		<!-- <?php echo "<a href=\"".JURI::base()."contract-listing-vic/contract-folder-vic/contract-bom-vic?quoteid=".$quoteid."&projectid=".$projectid."&page_name=bom\" class='btn ".($page_name=="bom"?"btn-disabled":"")."'>&nbsp;&nbsp; BOM &nbsp;&nbsp;</a>&nbsp;"; ?> -->
  		<?php echo "<a href=\"".JURI::base()."contract-listing-vic/contract-folder-vic/contract-bom-vic?quoteid=".$quoteid."&projectid=".$projectid."\" class='btn ".($page_name=="bom"?"btn-disabled":"")."'>&nbsp;&nbsp; BOM &nbsp;&nbsp;</a>&nbsp;"; ?>
  		<?php echo "<a href=\"".JURI::base()."contract-listing-vic/contract-folder-vic/contract-po-vic?quoteid=".$quoteid."&projectid=".$projectid."&page_name=po\" class='btn ".($page_name=="po"&&$is_summary_view==0?"btn-disabled":"")."'>&nbsp;&nbsp; PO &nbsp;&nbsp;</a>&nbsp;"; ?>
  		<?php echo "<a href=\"".JURI::base()."contract-listing-vic/contract-folder-vic/contract-po-vic?quoteid=".$cust_id."&projectid=".$projectid."&page_name=po&view=summary\" class='btn ".($page_name=="po"&&$is_summary_view==1?"btn-disabled":"")."'>&nbsp;&nbsp; PO Summary &nbsp;&nbsp;</a>"; ?>
  		<?php echo "<a href=\"".JURI::base()."contract-listing-vic/contract-folder-vic/contract-folder-vic?quoteid=".$quoteid."&projectid=".$projectid."&page_name=contract_details&tab=checklist\" class='btn '>&nbsp;&nbsp; Check List &nbsp;&nbsp;</a>&nbsp;"; ?>
  		 
 <!-- -------------------  BUTTON NAVIGATION ----------------------------- -->
	
<br/><br/>

 <!-- Display PO From the old system -->
 <?php if(substr($projectid,0,3)=="VIC" || substr($projectid,0,3)=="JID" || substr($projectid,0,3)=="VSA" ){ ?>
 
 	<table class="listing-table ">
    <thead>
    	<tr>
    		<td colspan="9" class="subheading" data-section='Frame' >
				PURCHASE ORDER
    		</td>
    	</tr>
    	 
    	<tr><th style=" ">Order Date</th><th style="width:6%;">Order No</th><th style="width:7%;">Supplier</th><th style="width:10%;">Total Cost</th><th style="width:10%;">Order Type</th> 
    	</tr> 
    </thead>
    <tbody>  

	<?php
		$sqlquotes = "SELECT *,DATE_FORMAT(date_entered,'%d-%b-%Y') fdate_entered FROM ver_chronoforms_data_contract_po_old_sys_vic AS po LEFT JOIN ver_chronoforms_data_supplier_vic AS s ON s.supplierid=po.supplierid WHERE projectid = '$projectid' ";  
   		//error_log($sqlquotes, 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_us\\my-error.log'); 
		$resultquotes = mysql_query ($sqlquotes) or die ('request "Could not execute SQL query" '.$sqlquotes);
		while($row = mysql_fetch_assoc($resultquotes)){
 
				echo "<tr>  "; 
				echo "<td> ".$row['fdate_entered']."   </td>";   
				echo "<td   > {$row["order_no"]}   </td>"; 
				echo "<td>  {$row["company_name"]} </td>"; 
				echo "<td>$".  number_format($row["total_ex_gst"],2,".",",") . "</td>";  
				echo "<td>{$row["type"]}</td>";  
				echo "</tr>"; 
		}
		?> 
		
	</tbody>
	</table>

<?php return; } ?>
<!-- End of display PO From the old system -->

  

<!-- List raw material based on the supplier --> 


<?php
	
	
	if($is_jump_to_download_pdf==0){

	$has_materials = 0;
	$sql = "SELECT * FROM ver_chronoforms_data_inventory_vic GROUP BY section ORDER BY inventoryid";

	$qcat = mysql_query ($sql);
	while ($cat = mysql_fetch_assoc($qcat)) {	

?>

<form method="post" class="<?php if($unprocess_framework){echo '';} else echo 'disable-form-input'; ?>" action="">  
<table class="listing-table"> 
<tr><td colspan="7" class="subheading" data-section='Frame' > <?php if($cat['section']=="Frame"){ echo "Framework"; }else if($cat['section']=="Fixings"){ echo "Fittings"; }else{ echo $cat['section']; } ?>   </td></tr>
<tr>
		<td colspan="7" style="font-weight:bold">
				
			<?php
			$has_materials = 0;
		
			$sql = "SELECT process_po FROM  ver_chronoforms_data_contract_bom_meterial_vic AS bm WHERE bm.projectid = '$ListProjectID' AND bm.section='{$cat['section']}'   "; 
			//error_log( $sql, 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_us\\my-error.log');
			$req = mysql_query ($sql) or die ('request "Could not execute SQL query" '.$sql);  
			$n = mysql_num_rows($req);
			$r = mysql_fetch_assoc($req);
			//error_log( "n=".$n, 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_us\\my-error.log');
			if($n>0){
				$has_materials = 1;
				$process_po = $r['process_po'];
			}else{
				echo "</td> </tr>";
				continue;
			}
			

			if($process_po==0 && $is_summary_view==0){
                //process user_access_profiles
                if ($current_signed_in_user_access_profiles['record action']['save and process po'] == true) {
					echo "<input type=\"submit\" class=\"btn\" value=\"Save & Process PO\" name=\"update_materials\"  style=\"width:180px; padding: 5px; line-height: 1em;\"  \> ";
                } //end if
			}else if($process_po==1 && $is_summary_view==1){

				$titleID = $ListProjectID."_"."frame"."_".mt_rand(); 

				$sql = "SELECT * FROM  ver_chronoforms_data_contract_bom_meterial_vic AS bm  
				JOIN ver_chronoforms_data_materials_vic AS m ON m.cf_id=bm.materialid 
				JOIN ver_chronoforms_data_supplier_vic AS s ON s.supplierid=bm.supplierid 
				JOIN ver_chronoforms_data_inventory_vic AS inv ON inv.inventoryid=bm.inventoryid  
				WHERE bm.projectid = '{$ListProjectID}' AND bm.inventoryid IN (SELECT i.inventoryid FROM ver_chronoforms_data_contract_bom_vic AS i 
				WHERE i.projectid = '{$ListProjectID}' AND is_reorder=0 ) AND inv.section='{$cat['section']}' GROUP BY bm.supplierid   ";  
			//error_log( $sql, 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_us\\my-error.log');	
			$qsup = mysql_query ($sql);
				$is_first = 1;
				
				while ($sup = mysql_fetch_assoc($qsup)) {

					//error_log( print_r($sup,true), 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_us\\my-error.log');	
					if($is_first==1){
						echo "Print Purchase Order for : ";   
						$is_first=0;
					}
					 
			?>   

				<input type="hidden" id="frame_po_titleID"   value="<?php echo $titleID; ?>" />  

				<a id="frame_create_po" class="btn btn-s" rel="nofollow" title="PDF" onclick="window.open(this.href,'win2','status=no,toolbar=no,scrollbars=yes,titlebar=no,menubar=no,resizable=yes,width=auto,height=auto,directories=no,location=no'); return false;" href="index.php?projectid=<?php echo $ListProjectID; ?>&section=<?php echo $cat['section']; ?>&titleID=<?php echo $titleID; ?>&supplierid=<?php echo $sup['supplierid']; ?>&option=com_chronoforms&tmpl=component&chronoform=Letters_TemplateUpdate_PDF_Vic" style="margin-right:5px; " > <?php echo $sup['company_name']; ?> </a> 

				<!-- <a rel=\"nofollow\" onclick=\"window.open(this.href,'win2','status=no,toolbar=no,scrollbars=yes,titlebar=no,menubar=no,resizable=yes,width=auto,height=auto,directories=no,location=no'); return false;\" href=\"index.php?cf_id=".$cf_id."&pid=".$info['cf_id']."&option=com_chronoforms&tmpl=component&chronoform=Download-PDF\">Click Here <img src='".JURI::base()."templates/".$mainframe->getTemplate()."/images/file_pdf.png'  /></a> -->
	 
		<?php
			} }

			if($has_materials && $process_po && $is_summary_view==0){
                //process user_access_profiles
                if ($current_signed_in_user_access_profiles['record action']['cancel po'] == true) {
					echo "<input type=\"submit\" class=\"btn\" value=\"Cancel PO\" name=\"cancel_process_po\"  style=\"width:100px; padding: 5px; line-height: 1em;\"  \> ";
                } //end if
			} 
			
		?>

			 
		</td>
	</tr>

<?php


//($cat['section']=="Guttering"?"TemplateResidential":"Letters_TemplateUpdate_PDF_Vic")
$order_by = "";
if($cat['section']=="Frame"){
					//$order_by = " ORDER BY  FIELD(bm.inventoryid, 'IRV122','IRV121','IRV26','IRV25','IRV24','IRV23','IRV15','IRV120','IRV3') DESC ";
					//$order_by = " ORDER BY  FIELD(inv.category, 'Post Fixings','Beam Fixings','Intermediates','Beams') DESC  ";
					//$order_by = "";
				}

$sql = "SELECT *, i.rrp AS bom_rrp FROM ver_chronoforms_data_contract_bom_vic AS i LEFT JOIN ver_chronoforms_data_inventory_vic AS inv ON inv.inventoryid=i.inventoryid  WHERE  i.projectid = '$projectid' AND inv.section='{$cat['section']}' AND i.is_reorder=0  {$order_by}  "; 


$qbm = mysql_query ($sql) or die ('request "Could not execute SQL query" '.$sql);

$i=0;
while ($bm = mysql_fetch_assoc($qbm)) {

?>  
	<tbody class="<?php if($is_summary_view==1){ echo "tbody-hide"; }else if($process_po==1){echo " disable-input";} ?>"  >
		 
	<tr>
		 <th><?php if($i==0) echo "Inventory"; ?></th><th> Qty </th><th> Length </th> </th><th> UOM </th> <th>Cost</th> <th >Supplier</th>  <th>Amount </th> 
	</tr>
	
	<tr><td><?php echo $bm['description']; ?></td><td><?php echo number_format($bm['qty']); ?></td><td><?php if($bm['uom']=="Mtrs" && METRIC_SYSTEM == "inch") {echo get_feet_value($bm['length']);}else if($bm['uom']=="Mtrs"){echo $bm['length'];} ?></td><td><?php echo $bm['uom']; ?></td><td> &nbsp; </td><td> &nbsp; </td><td> </td></tr>

	<tr>
		 <th  colspan='7'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Raw Materials</th> 
	</tr>
	<?php 
		 
			 
	$sql = "SELECT bm.id, bm.contract_item_cf_id, bm.projectid, bm.inventoryid, bm.materialid, bm.raw_cost, bm.qty, bm.length, bm.supplierid, m.raw_description, m.uom, m.is_per_length, m.length_per_ea, s.company_name, m.length_per_ea_us FROM  ver_chronoforms_data_contract_bom_meterial_vic AS bm  JOIN ver_chronoforms_data_materials_vic AS m ON m.cf_id=bm.materialid JOIN ver_chronoforms_data_supplier_vic AS s ON s.supplierid=m.supplierid  WHERE bm.projectid = '$ListProjectID' AND bm.inventoryid='{$bm['inventoryid']}' and bm.contract_item_cf_id={$bm['contract_item_cf_id']} GROUP BY bm.inventoryid, bm.materialid    "; 

		//error_log("PO: ".$sql, 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_us\\my-error.log');
	 
		$bom_item_result = mysql_query ($sql);
		while ($m = mysql_fetch_assoc($bom_item_result)) {	// } comment bom 1 -- START
		//error_log($sql, 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_us\\my-error.log'); //exit();
	?>	 
 
			<?php  
  
				$amount = 0;
				$m_qty = 1;  
				$m_qty = $m['qty'];
				$m_length = $m['length'];// * floor($bm['length'] / $m['length_per_ea']); 
				if($m['uom']=="Mtrs"){
					$amount = $m['raw_cost'] * $m_qty * $m_length;
				}else{
					$amount = $m['raw_cost'] * $m_qty;
				}
 
 				
			?>	
				<tr> 
					<td >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $m['raw_description']; ?> 
						<input type="hidden" name="contract_item_cf_id[]"   value="<?php echo $m['contract_item_cf_id']; ?>" /> 
						<input type="hidden" name="id[]"   value="<?php echo $m['id']; ?>" />
					</td> 
					<td ><?php echo number_format($m_qty); ?></td>
					<td ><?php if($m['uom']=="Mtrs" && METRIC_SYSTEM == "inch") echo get_feet_value($m_length); else if($m['uom']=="Mtrs") echo $m_length; ?></td> 
					<td><?php echo $m['uom']; ?></td> 
					<td style="text-align:right"> $<input type="text" class="number" value="<?php echo number_format($m['raw_cost'],2); ?>" name="raw_cost[]" style="width: 80%; text-align:right;" /> </td>
					<td > <?php echo cbo_supplier($m['supplierid'],"supplierid[]"); ?></td> 
					<td> $<?php echo number_format($amount,2) ?> </td> 
				</tr>  
		 
	<?php $i++;  } //comment bom 1  -- END ?>

	</tbody>

<?php } //end of section 
 
?> 	  
 
 </table>
</form> 
 

<?php } //End of while for inventory categories  ?>  



<form method="post" class="<?php if($unprocess_framework){echo '';} else echo 'disable-form-input'; ?>" action="">  
<table class="listing-table"> 
<?php

$sql = "SELECT * FROM ver_chronoforms_data_contract_bom_vic AS i LEFT JOIN ver_chronoforms_data_inventory_vic AS inv ON inv.inventoryid=i.inventoryid  WHERE  i.projectid = '{$ListProjectID}' AND i.is_reorder=1 GROUP BY i.inventoryid ORDER BY i.cf_id "; 
//error_log($sql, 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_us\\my-error.log');  

$qbm = mysql_query ($sql) or die ('request "Could not execute SQL query" '.$sql);

$i=0;
while ($bm = mysql_fetch_assoc($qbm)) {
 
?>  
	<tr><td colspan="7" class="subheading" data-section='Reorders' >Reorders</td></tr>

	<tr>
		<td colspan="7" style="font-weight:bold">
			 
			<?php   

			$has_materials = 0;
		
			$sql = "SELECT process_po FROM  ver_chronoforms_data_contract_bom_meterial_vic AS bm WHERE bm.projectid = '$ListProjectID' AND contract_item_cf_id={$bm['contract_item_cf_id']}  AND is_reorder=1  "; 
			//error_log( $sql, 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_us\\my-error.log');
			$req = mysql_query ($sql) or die ('request "Could not execute SQL query" '.$sql);  
			$n = mysql_num_rows($req);
			$r = mysql_fetch_assoc($req);
			//error_log( "n=".$n, 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_us\\my-error.log');
			if($n>0){
				$has_materials = 1;
				$process_po = $r['process_po'];
			}else{
				echo "</td> </tr>";
				continue;
			}
			

			if($process_po==0){
                //process user_access_profiles
                if ($current_signed_in_user_access_profiles['record action']['save and process po'] == true) {
					echo "<input type=\"submit\" class=\"btn\" value=\"Save & Process PO\" name=\"update_materials\"  style=\"width:180px; padding: 5px; line-height: 1em;\"  \> ";
                } //end if
			}else{

				$titleID = $ListProjectID."_"."frame"."_".mt_rand();
 
				//$sql = "SELECT * FROM  ver_chronoforms_data_contract_bom_meterial_vic AS bm  JOIN ver_chronoforms_data_materials_vic AS m ON m.cf_id=bm.materialid JOIN ver_chronoforms_data_supplier_vic AS s ON s.supplierid=m.supplierid  WHERE bm.projectid = '$ListProjectID' AND bm.inventoryid='{$bm['inventoryid']}' GROUP BY m.supplierid   "; 
				$sql = "SELECT * FROM  ver_chronoforms_data_contract_bom_meterial_vic AS bm  
				JOIN ver_chronoforms_data_materials_vic AS m ON m.cf_id=bm.materialid 
				JOIN ver_chronoforms_data_supplier_vic AS s ON s.supplierid=bm.supplierid 
				JOIN ver_chronoforms_data_inventory_vic AS inv ON inv.inventoryid=bm.inventoryid  
				WHERE bm.projectid = '{$ListProjectID}' AND bm.inventoryid IN (SELECT i.inventoryid FROM ver_chronoforms_data_contract_bom_vic AS i 
				WHERE i.projectid = '{$ListProjectID}' AND is_reorder=1 )   GROUP BY bm.supplierid   "; 

				//error_log($sql, 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_us\\my-error.log');  

				$qsup = mysql_query ($sql);
				
				$is_first = 1;
				while ($sup = mysql_fetch_assoc($qsup)) {	
					if($is_first==1){echo "Print Purchase Order for : "; $is_first=0; }
					 
			?>   
				<input type="hidden" id="frame_po_titleID" value="<?php echo $titleID; ?>" />

				<a id="frame_create_po" class="btn btn-s" rel="nofollow" title="PDF" onclick="window.open(this.href,'win2','status=no,toolbar=no,scrollbars=yes,titlebar=no,menubar=no,resizable=yes,width=auto,height=auto,directories=no,location=no'); return false;" href="index.php?projectid=<?php echo $ListProjectID; ?>&section=reorder&titleID=<?php echo $titleID; ?>&supplierid=<?php echo $sup['supplierid']; ?>&option=com_chronoforms&tmpl=component&chronoform=Letters_TemplateUpdate_PDF_Vic&inventoryid=<?php echo $bm['inventoryid'];?>" style="margin-right:5px; " > <?php echo $sup['company_name']; ?> </a> 
			<?php }

			} ?>
			 
		</td>
	</tr>
	<tbody <?php if($is_summary_view==1){ echo "class='tbody-hide'"; } ?>  >
	<tr>
		 <th>Inventory</th><th> Qty </th><th> Length </th> </th><th> UOM </th> <th>Cost</th> <th >Supplier</th>  <th>Amount </th> 
	</tr>
	
	<tr><td><?php echo $bm['description']; ?></td><td><?php echo number_format($bm['qty']); ?></td><td><?php if($bm['uom']=="Mtrs") echo $bm['length']; ?></td><td><?php echo $bm['uom']; ?></td><td> &nbsp; </td><td> &nbsp; </td><td>$<?php echo $bm['rrp']; ?></td></tr>
	<tr>
		 <th  colspan='7'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Raw Materials</th> 
	</tr>
	<?php 
		 
			 
	//$sql = "SELECT *  FROM  ver_chronoforms_data_contract_bom_meterial_vic AS bm  JOIN ver_chronoforms_data_materials_vic AS m ON m.cf_id=bm.materialid JOIN ver_chronoforms_data_supplier_vic AS s ON s.supplierid=m.supplierid  WHERE bm.projectid = '$ListProjectID' AND bm.inventoryid='{$bm['inventoryid']}' GROUP BY bm.inventoryid, bm.materialid ORDER BY m.cf_id  "; 
	$sql = "SELECT bm.id, bm.contract_item_cf_id, bm.projectid, bm.inventoryid, bm.materialid, bm.raw_cost, bm.qty, bm.length, bm.supplierid, m.raw_description, m.uom, m.is_per_length, m.length_per_ea, s.company_name, m.length_per_ea_us FROM  ver_chronoforms_data_contract_bom_meterial_vic AS bm  JOIN ver_chronoforms_data_materials_vic AS m ON m.cf_id=bm.materialid JOIN ver_chronoforms_data_supplier_vic AS s ON s.supplierid=m.supplierid  WHERE bm.projectid = '$ListProjectID' AND bm.inventoryid='{$bm['inventoryid']}' and bm.contract_item_cf_id={$bm['contract_item_cf_id']} GROUP BY bm.inventoryid, bm.materialid    "; 

		//error_log($sql, 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_us\\my-error.log');
	 
		$bom_item_result = mysql_query ($sql);
		while ($m = mysql_fetch_assoc($bom_item_result)) {	// } comment bom 1 -- START
		//error_log($sql, 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_us\\my-error.log'); 
	?>	 
 
			<?php  
 
				$amount = 0;
				$m_qty = 1;  
				$m_qty = $m['qty'];
				$m_length = $m['length'];// * floor($bm['length'] / $m['length_per_ea']); 
				if($m['uom']=="Mtrs"){
					$amount = $m['raw_cost'] * $m_qty * $m_length;
				}else{
					$amount = $m['raw_cost'] * $m_qty;
				}				
			?>	
				<tr> 
					<td >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $m['raw_description']; ?> 
						<input type="hidden" name="contract_item_cf_id[]"   value="<?php echo $m['contract_item_cf_id']; ?>" /> 
						<input type="hidden" name="id[]"   value="<?php echo $m['id']; ?>" />
					</td> 
					<td ><?php echo number_format($m_qty); ?></td>
					<td ><?php if($m['uom']=="Mtrs" && METRIC_SYSTEM == "inch") echo get_feet_value($m_length); else if($m['uom']=="Mtrs") echo $m_length; ?></td> 
					<td><?php echo $m['uom']; ?></td> 
					<td style="text-align:right"> $<input type="text" value="<?php echo number_format($m['raw_cost'],2); ?>" name="raw_cost[]" style="width: 80%; text-align:right;" /> </td>
					<td > <?php echo cbo_supplier($m['supplierid'],"supplierid[]"); ?></td> 
					<td> $<?php echo number_format($amount,2) ?> </td> 
				</tr> 
		 
	<?php $i++;  } //comment bom 1  -- END ?>
	</tbody>
<?php }  ?>		  
</table>
</form>

<br/>
<?php }  ?>		


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
<!-- <button class="btn" onclick="window.history.back();" style="margin:10px 0 5px 0;">&nbsp; Close &nbsp; </button> -->
 <?php //echo "<a href=\"".JURI::base()."contract-listing-vic/contract-folder-vic/contract-bom-vic?quoteid=".$cust_id."&projectid=".$projectid."\" class='btn '>&nbsp;&nbsp; Close &nbsp;&nbsp;</a>"; ?>
 <!-- -------------------  BUTTON NAVIGATION ----------------------------- -->
		 
  		<?php echo "<a href=\"".JURI::base()."contract-listing-vic/contract-folder-vic/contract-folder-vic?quoteid=".$quoteid."&projectid=".$projectid."\" class='btn '>&nbsp;&nbsp; Contract Details &nbsp;&nbsp;</a>&nbsp;"; ?>
  		<?php echo "<a href=\"".JURI::base()."view-quote-vic?ref=back&quoteid=".$quoteid."&projectid=".$projectid."&ref_page=contracts&page_name=quote_details\" class='btn '>&nbsp;&nbsp; Quote Details &nbsp;&nbsp;</a>&nbsp;"; ?>
  		<!-- <?php echo "<a href=\"".JURI::base()."contract-listing-vic/contract-folder-vic/contract-bom-vic?quoteid=".$quoteid."&projectid=".$projectid."&page_name=bom\" class='btn ".($page_name=="bom"?"btn-disabled":"")."'>&nbsp;&nbsp; BOM &nbsp;&nbsp;</a>&nbsp;"; ?> -->
  		<?php echo "<a href=\"".JURI::base()."contract-listing-vic/contract-folder-vic/contract-bom-vic?quoteid=".$quoteid."&projectid=".$projectid."\" class='btn ".($page_name=="bom"?"btn-disabled":"")."'>&nbsp;&nbsp; BOM &nbsp;&nbsp;</a>&nbsp;"; ?>
  		<?php echo "<a href=\"".JURI::base()."contract-listing-vic/contract-folder-vic/contract-po-vic?quoteid=".$quoteid."&projectid=".$projectid."&page_name=po\" class='btn ".($page_name=="po"&&$is_summary_view==0?"btn-disabled":"")."'>&nbsp;&nbsp; PO &nbsp;&nbsp;</a>&nbsp;"; ?>
  		<?php echo "<a href=\"".JURI::base()."contract-listing-vic/contract-folder-vic/contract-po-vic?quoteid=".$cust_id."&projectid=".$projectid."&page_name=po&view=summary\" class='btn ".($page_name=="po"&&$is_summary_view==1?"btn-disabled":"")."'>&nbsp;&nbsp; PO Summary &nbsp;&nbsp;</a>"; ?>
  		<?php echo "<a href=\"".JURI::base()."contract-listing-vic/contract-folder-vic/contract-folder-vic?quoteid=".$quoteid."&projectid=".$projectid."&page_name=contract_details&tab=checklist\" class='btn '>&nbsp;&nbsp; Check List &nbsp;&nbsp;</a>&nbsp;"; ?>
  		 
 <!-- -------------------  BUTTON NAVIGATION ------------------------------->


<script type="text/javascript">

$(document).ready(function() {
	 
	$("tbody.tbody-hide").hide();  
	 
	$("tbody.disable-input :input[type!='hidden']").prop("disabled", true);  
	 


	var titleID = getUrlParameter('titleID');  
	if(titleID.length>0){
		window.location.href = "index.php?titleID="+titleID+"&option=com_chronoforms&tmpl=component&chronoform=Download-PDF"; 
	}

	removeParam('titleID');

	$('input.number').bind('keypress', function (event) {
			var key = window.event ? event.keyCode : event.which; 
			
		    switch (key) {
	            case 8:  // Backspace
	            case 9:  // Tab
	            case 13: // Enter
	            case 37: // Left
	            case 38: // Up
	            case 39: // Right
	            case 40: // Down 
	            case 116: // F5 refresh 
	            case 222: // " & '
	            break;
	            default:
	            	var theEvent = event || window.event;
					var key = theEvent.keyCode || theEvent.which;
					key = String.fromCharCode( key ); 
					var regex = /[0-9]|\./;
					if( !regex.test(key) ) {
					theEvent.returnValue = false;
					if(theEvent.preventDefault) theEvent.preventDefault();
					//alert(key+" privented");
					}else{
						//alert(key+" allowed");
					}

					break;
	        }
		}); 
 

});

  
function create_pdf(categoryPOCreate,titleIDHolder){


	//window.open(this.href,'win2','status=no,toolbar=no,scrollbars=yes,titlebar=no,menubar=no,resizable=yes,width=auto,height=auto,directories=no,location=no'); 
	$("#"+categoryPOCreate).click();
	//alert(categoryPOCreate+" "+titleIDHolder);
	//setTimeout(download_pdf(titleIDHolder), 5000);
	//download_pdf(titleIDHolder);
}
	
function download_pdf(titleID){
	
	//var titleID = $("#"+titleIDHolder).val();
	//alert(titleID);
	//$("#btn_print_frame").attr("href","index.php?titleID="+titleID+"?option=com_chronoforms&tmpl=component&chronoform=Download-PDF");
	$("#btn_print_frame").attr("onclick",""); 
	setTimeout(function(){
		window.location.href = "index.php?titleID="+titleID+"&option=com_chronoforms&tmpl=component&chronoform=Download-PDF"; 
	}, 3000);
	
}


var getUrlParameter = function getUrlParameter(sParam) {
    var sPageURL = decodeURIComponent(window.location.search.substring(1)),
        sURLVariables = sPageURL.split('&'),
        sParameterName,
        i;

    for (i = 0; i < sURLVariables.length; i++) {
        sParameterName = sURLVariables[i].split('=');

        if (sParameterName[0] === sParam) {
            return sParameterName[1] === undefined ? true : sParameterName[1];
        }
    }
};

function removeParam(parameter)
{
  var url=document.location.href;
  var urlparts= url.split('?');

 if (urlparts.length>=2)
 {
  var urlBase=urlparts.shift(); 
  var queryString=urlparts.join("?"); 

  var prefix = encodeURIComponent(parameter)+'=';
  var pars = queryString.split(/[&;]/g);
  for (var i= pars.length; i-->0;)               
      if (pars[i].lastIndexOf(prefix, 0)!==-1)   
          pars.splice(i, 1);
  url = urlBase+'?'+pars.join('&');
  window.history.pushState('',document.title,url); // added this line to push the new url directly to url bar .

}
return url;
}

</script>