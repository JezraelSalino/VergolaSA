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
$cust_id = mysql_real_escape_string($_REQUEST['quoteid']);
$projectid = mysql_real_escape_string($_REQUEST['projectid']); 
 
if ($projectid != '') {
// Get Contract Items
$resultdetails = mysql_query("SELECT * FROM ver_chronoforms_data_contract_list_vic WHERE quoteid = '$cust_id' and projectid = '$projectid'");
$retrievedetails = mysql_fetch_array($resultdetails);
if (!$resultdetails) {die("Error: Data not found..");} 
$ListProjName = $retrievedetails['project_name'];
$ListProjectID = $retrievedetails['projectid'];
$ListFramework = $retrievedetails['framework_type'];
$ListVergolaType = $retrievedetails['framework'];

}	   
else {
// Get Contract Items
$resultdetails = mysql_query("SELECT * FROM ver_chronoforms_data_contract_list_vic WHERE quoteid = '$cust_id' ORDER BY quotedate DESC");
$retrievedetails = mysql_fetch_array($resultdetails);
if (!$resultdetails) {die("Error: Data not found..");} 
$ListProjName = $retrievedetails['project_name'];
$ListProjectID = $retrievedetails['projectid']; 
$ListFramework = $retrievedetails['framework_type'];
$ListVergolaType = $retrievedetails['framework'];
}

$resultbom = mysql_query("SELECT * FROM ver_chronoforms_data_contract_bom_vic WHERE quoteid = '$cust_id' and projectid = '$ListProjectID'");
$retrievebom = mysql_fetch_array($resultbom);
if (!$resultbom) {die("Error: Data not found..");} 
$BOMSupplierID = $retrievebom['supplierid'];
$BOMOrderDate = $retrievebom['orderdate'];
 
 
$print_id = "";
if(isset($_REQUEST["print_id"])){
	$print_id = $_REQUEST["print_id"];
} 

?>

<!-- <button class="btn" onclick="window.history.back();" style="margin:0 0 5px 0;">&nbsp; Close &nbsp; </button> -->
<?php echo "<a href=\"".JURI::base()."contract-listing-vic/contract-folder-vic/contract-bom-vic?quoteid=".$cust_id."&projectid=".$projectid."\" class='btn ' style='display:block; padding: 6px; text-align: center; width: 100px;'>&nbsp;&nbsp; Close &nbsp;&nbsp;</a>"; ?>
<br/>
<table class="listing-table"> 
<tr><td colspan="6" class="subheading" data-section='Frame' >Framework   </td></tr>

<!-- List inventory item based on the contract bom item table -->
<?php if(0){ ?>
<tr><td colspan="6" style="font-weight:bold">
		Supplier: <?php //echo $purchase["company_name"];		 
 		$titleID = $ListProjectID."_"."frame"."_".mt_rand();
 		 
		?>  &nbsp; 
			<input type="hidden" id="frame_po_titleID" value="<?php echo $titleID; ?>" />
			<a id="frame_create_po" class="btn btn-s" rel="nofollow" title="PDF" onclick="window.open(this.href,'win2','status=no,toolbar=no,scrollbars=yes,titlebar=no,menubar=no,resizable=yes,width=auto,height=auto,directories=no,location=no'); return false;" href="index.php?projectid=<?php echo $ListProjectID; ?>&section=frame&titleID=<?php echo $titleID; ?>&supplierid=<?php echo $purchase['supplierid']; ?>&option=com_chronoforms&tmpl=component&chronoform=Letters_TemplateUpdate_PDF_Vic" style="margin-right:5px; " >Print Purchase Order</a> 
			<!-- <a rel="nofollow" class="btn btn-s" onclick="create_pdf('frame_create_po','frame_po_titleID'); return false;" href="" id="btn_print_frame" style="display:none;">Gen Purchase Order</a>   -->
		</td>
	</tr>

<?php 
$sqlpurchase = "SELECT * FROM ver_chronoforms_data_contract_bom_vic AS i LEFT JOIN ver_chronoforms_data_inventory_vic AS inv ON inv.inventoryid=i.inventoryid  WHERE  i.projectid = '$ListProjectID' AND inv.section='Frame'   "; 
$resultpurchase = mysql_query ($sqlpurchase) or die ('request "Could not execute SQL query" '.$sqlpurchase);
while ($purchase = mysql_fetch_assoc($resultpurchase)) {  
?>
   
	<?php
	$sql = "SELECT * FROM ver_chronoforms_data_material_supplier_vic AS ms LEFT JOIN ver_chronoforms_data_materials_vic AS m ON m.cf_id=ms.materialid LEFT JOIN ver_chronoforms_data_supplier_vic AS s ON s.supplierid=ms.supplierid WHERE ms.inventoryid='{$purchase["inventoryid"]}'  ";
	$result = mysql_query ($sql) or die ('request "Could not execute SQL query" '.$sql);	
	?> 
	

	<tr><th>Description</th><th>UOM</th><th>QTY</th><th>Length</th><th>Colour</th><th>Unit Cost</th></tr>   
	  
	<tr>
		<td><?php echo $purchase['description']; ?></td> 
		<td><?php echo $purchase['uom']; ?></td>
		<td><?php echo $purchase['qty']; ?></td>
		<td><?php echo $purchase['length']; ?></td>
		<td><?php echo $purchase['colour']; ?></td>
		<td><?php echo $purchase['rrp']; ?></td>
	</tr> 

	<tr><th >Raw Material</th><th>Cost</th><th  colspan="2">Supplier</th> <th> </th> <th> </th> </tr>
	<?php while ($row = mysql_fetch_assoc($result)) { ?>	
		<tr>
			<td ><?php echo $row['raw_description']; ?></td> 
			<td ><?php echo $row['raw_cost']; ?></td>
			<td  colspan="2"><?php echo $row['company_name']; ?></td> 
			<th> </th>
			<th> </th>
		</tr> 
		  
	<?php } ?>

<?php } ?>	
<?php } ?>


<!-- List raw material based on the supplier --> 
  

<?php



$sqlpurchase = "SELECT i.inventoryid FROM ver_chronoforms_data_contract_bom_vic AS i LEFT JOIN ver_chronoforms_data_inventory_vic AS inv ON inv.inventoryid=i.inventoryid  WHERE  i.projectid = '$ListProjectID' AND inv.section='Frame'   "; 
//make a sql for list of raw material id based on the frame inventory item
//$sql_materials = "SELECT ms.materialid FROM ver_chronoforms_data_material_supplier_vic AS ms  WHERE ms.inventoryid = {$purchase['inventoryid']} ";

// $sql = "SELECT inventoryid, materialid, supplierid FROM ver_chronoforms_data_material_supplier_vic AS ms   WHERE ms.projectid = '{$ListProjectID}' AND ms.inventoryid IN (".$sqlpurchase.")  GROUP BY ms.supplierid  ";

$sql = "SELECT inventoryid, materialid, supplierid, s.company_name FROM ver_chronoforms_data_contract_bom_meterial_vic AS bm JOIN ver_chronoforms_data_supplier_vic AS s ON s.supplierid=bm.supplierid  WHERE ms.projectid = '{$ListProjectID}' AND ms.inventoryid IN (".$sqlpurchase.")   ";
 
//error_log($sql, 3,'C:\\xampp\htdocs\\vergola_contract_system_v3\\my-error.log'); //exit();
$qbm = mysql_query ($sql) or die ('request "Could not execute SQL query" '.$sql);	
while ($bm = mysql_fetch_assoc($qbm)) {

	// $sql_list_of_inv_in_supid = "SELECT inventoryid, materialid FROM ver_chronoforms_data_material_supplier_vic AS ms   WHERE ms.inventoryid IN (".$sqlpurchase.") AND ms.supplierid='".$s['supplierid']."' GROUP BY ms.inventoryid ";
	//error_log($sql_list_of_inv_in_supid, 3,'C:\\xampp\htdocs\\vergola_contract_system_v3\\my-error.log'); exit();
 

?> 

	<tr>
		<td colspan="6" style="font-weight:bold">
			<?php  //get supplier name  
				//$sup_sql = "SELECT * FROM ver_chronoforms_data_supplier_vic WHERE supplierid='{$s['supplierid']}' "; 
				//$sup = mysql_fetch_assoc(mysql_query($sup_sql)); 
 
			?>
				Supplier: <?php echo $bm["company_name"];		 
				$titleID = $ListProjectID."_"."frame"."_".mt_rand();
				 
			?>  &nbsp; 
				<input type="hidden" id="frame_po_titleID" value="<?php echo $titleID; ?>" />
				<a id="frame_create_po" class="btn btn-s" rel="nofollow" title="PDF" onclick="window.open(this.href,'win2','status=no,toolbar=no,scrollbars=yes,titlebar=no,menubar=no,resizable=yes,width=auto,height=auto,directories=no,location=no'); return false;" href="index.php?projectid=<?php echo $ListProjectID; ?>&section=frame&titleID=<?php echo $titleID; ?>&supplierid=<?php echo $bm['supplierid']; ?>&option=com_chronoforms&tmpl=component&chronoform=Letters_TemplateUpdate_PDF_Vic" style="margin-right:5px; " >Print Purchase Order</a> 
				<!-- <a rel="nofollow" class="btn btn-s" onclick="create_pdf('frame_create_po','frame_po_titleID'); return false;" href="" id="btn_print_frame" style="display:none;">Gen Purchase Order</a>   -->
		</td>
	</tr>
	<tr><th > &nbsp;</th><th>Raw Materials Per Item </th><th> Qty </th><th> Length </th> <th>Cost</th> <th> Amount </th> </tr>
	<?php 
		 
			// $sql = "SELECT inventoryid, materialid, supplierid FROM ver_chronoforms_data_material_supplier_vic AS ms   WHERE ms.inventoryid IN (".$sqlpurchase.")  AND ms.supplierid='{$s['supplierid']}'  ";
			// $m_result = mysql_query ($sql);
			// error_log($sql, 3,'C:\\xampp\htdocs\\vergola_contract_system_v3\\my-error.log'); exit();
			// while ($m = mysql_fetch_assoc($m_result)) { 

				//$sqlpurchase = "SELECT * FROM ver_chronoforms_data_contract_bom_vic AS i LEFT JOIN ver_chronoforms_data_inventory_vic AS inv ON inv.inventoryid=i.inventoryid  WHERE  i.projectid = '$ListProjectID' AND inv.section='Frame'   "; 
				//$resultpurchase = mysql_query ($sqlpurchase) or die ('request "Could not execute SQL query" '.$sqlpurchase);

				// $sql = "SELECT bom.cf_id, bom.inventoryid, bom.length, bom.qty, bom.uom, bom.description FROM (SELECT i.cf_id, i.inventoryid, i.length, i.qty, i.uom, inv.description  FROM ver_chronoforms_data_contract_bom_vic AS i JOIN ver_chronoforms_data_inventory_vic AS inv ON inv.inventoryid=i.inventoryid WHERE i.projectid = '{$ListProjectID}'  AND inv.section='Frame') AS bom LEFT JOIN ({$sql_list_of_inv_in_supid}) AS l ON l.inventoryid=bom.inventoryid "; 

			// $sql = "SELECT bom.cf_id, bom.inventoryid, bom.length, bom.qty, bom.uom, bom.description FROM (SELECT i.cf_id, i.inventoryid, i.length, i.qty, i.uom, inv.description  FROM ver_chronoforms_data_contract_bom_vic AS i JOIN ver_chronoforms_data_inventory_vic AS inv ON inv.inventoryid=i.inventoryid WHERE i.projectid = '{$ListProjectID}'  AND inv.section='Frame') AS bom   "; 

				//error_log($sql, 3,'C:\\xampp\htdocs\\vergola_contract_system_v3\\my-error.log'); exit();
				//$bom_item = mysql_fetch_assoc(mysql_query($bom_item_sql)); 
				//error_log($sql, 3,'C:\\xampp\htdocs\\vergola_contract_system_v3\\my-error.log'); exit();
				//while ($bom_item = mysql_fetch_assoc($bom_item_sql)){ 
 			
				//$bom_item_result = mysql_query ($sql);
				//while ($bom_item = mysql_fetch_assoc($bom_item_result)) {	// } comment bom 1 -- START
					//error_log($sql, 3,'C:\\xampp\htdocs\\vergola_contract_system_v3\\my-error.log'); 
	?>	 

				

			<?php 
				// $sql = "SELECT * FROM ver_chronoforms_data_material_supplier_vic AS ms LEFT JOIN ver_chronoforms_data_materials_vic AS m ON m.cf_id=ms.materialid LEFT JOIN ver_chronoforms_data_supplier_vic AS s ON s.supplierid=ms.supplierid  WHERE   ms.supplierid='{$s['supplierid']}' AND ms.inventoryid='{$bom_item['inventoryid']}' AND ms.projectid = '{$ListProjectID}' "; 
				$sql = "SELECT * FROM ver_chronoforms_data_material_supplier_vic AS ms LEFT JOIN ver_chronoforms_data_materials_vic AS m ON m.cf_id=ms.materialid LEFT JOIN ver_chronoforms_data_supplier_vic AS s ON s.supplierid=ms.supplierid  WHERE   ms.supplierid='{$s['supplierid']}' AND ms.inventoryid='{$bom_item['inventoryid']}' AND ms.projectid = '{$ListProjectID}' ";
			
				//error_log($sql, 3,'C:\\xampp\htdocs\\vergola_contract_system_v3\\my-error.log');  exit();
				$result = mysql_query ($sql) or die ('request "Could not execute SQL query" '.$sql);	
				//error_log($sql, 3,'C:\\xampp\htdocs\\vergola_contract_system_v3\\my-error.log');  exit();
			?> 

			<?php  

				if(mysql_fetch_assoc($result) != false){
					echo "<tr><td colspan='6'>{$bom_item['description']}</td></tr>";
					mysql_data_seek($result, 0); 	
				} 

				
				while ($row = mysql_fetch_assoc($result)){
				$amount = 0;
				if($bom_item['uom']=="Mtrs"){
					$amount = $row['raw_cost'] * $bom_item['qty'] * $bom_item['length'];
				}else{
					$amount = $row['raw_cost'] * $bom_item['qty'];
				}				
			?>	
				<tr>
					<td >&nbsp;</td>
					<td ><?php echo $row['raw_description']; ?></td> 
					<td ><?php echo number_format($bom_item['qty']); ?></td>
					<td ><?php echo $bom_item['length']; ?></td> 
					<th> <?php echo number_format($row['raw_cost'],2); ?> </th>
					<th> <?php echo number_format($amount,2) ?> </th> 
				</tr> 

				<?php } ?>	
			 
		<?php //} ?>	
	<?php // } comment bom 1  -- END ?>
<?php } ?>		  
 
 
  
<tr><td colspan="6" class="subheading" data-section='Fittings' >Fittings  </td></tr>
 

<?php 

$sqlpurchase = "SELECT i.inventoryid FROM ver_chronoforms_data_contract_bom_vic AS i LEFT JOIN ver_chronoforms_data_inventory_vic AS inv ON inv.inventoryid=i.inventoryid  WHERE  i.projectid = '$ListProjectID' AND inv.section='Fixings'   "; 
 
$sql = "SELECT inventoryid, materialid, supplierid FROM ver_chronoforms_data_material_supplier_vic AS ms   WHERE ms.projectid = '{$ListProjectID}' AND  ms.inventoryid IN (".$sqlpurchase.")  GROUP BY ms.supplierid  ";
//error_log($sql, 3,'C:\\xampp\htdocs\\vergola_contract_system_v3\\my-error.log'); exit();
$s_result = mysql_query ($sql) or die ('request "Could not execute SQL query" '.$sql);	
while ($s = mysql_fetch_assoc($s_result)) {

	$sql_list_of_inv_in_supid = "SELECT inventoryid, materialid FROM ver_chronoforms_data_material_supplier_vic AS ms   WHERE ms.inventoryid IN (".$sqlpurchase.") AND ms.supplierid='".$s['supplierid']."' GROUP BY ms.inventoryid ";
	//error_log($sql_list_of_inv_in_supid, 3,'C:\\xampp\htdocs\\vergola_contract_system_v3\\my-error.log'); exit();
 
?> 

	<tr>
		<td colspan="6" style="font-weight:bold">
			<?php  //get supplier name  
				$sup_sql = "SELECT * FROM ver_chronoforms_data_supplier_vic WHERE supplierid='{$s['supplierid']}' "; 
				$sup = mysql_fetch_assoc(mysql_query($sup_sql)); 
 
			?>
				Supplier: <?php echo $sup["company_name"];		 
				$titleID = $ListProjectID."_"."fittings"."_".mt_rand();
				 
			?>  &nbsp; 
				<input type="hidden" id="frame_po_titleID" value="<?php echo $titleID; ?>" />
				<a id="frame_create_po" class="btn btn-s" rel="nofollow" title="PDF" onclick="window.open(this.href,'win2','status=no,toolbar=no,scrollbars=yes,titlebar=no,menubar=no,resizable=yes,width=auto,height=auto,directories=no,location=no'); return false;" href="index.php?projectid=<?php echo $ListProjectID; ?>&section=fittings&titleID=<?php echo $titleID; ?>&supplierid=<?php echo $s['supplierid']; ?>&option=com_chronoforms&tmpl=component&chronoform=Letters_TemplateUpdate_PDF_Vic" style="margin-right:5px; " >Print Purchase Order</a> 
				<!-- <a rel="nofollow" class="btn btn-s" onclick="create_pdf('frame_create_po','frame_po_titleID'); return false;" href="" id="btn_print_frame" style="display:none;">Gen Purchase Order</a>   -->
		</td>
	</tr>
	<tr><th > &nbsp;</th><th>Raw Materials Per Item </th><th> Qty </th><th> Length </th> <th>Cost</th> <th> Amount </th> </tr>
	<?php 
		 
		 
				$sql = "SELECT bom.cf_id, bom.inventoryid, bom.length, bom.qty, bom.uom, bom.description FROM (SELECT i.cf_id, i.inventoryid, i.length, i.qty, i.uom, inv.description  FROM ver_chronoforms_data_contract_bom_vic AS i JOIN ver_chronoforms_data_inventory_vic AS inv ON inv.inventoryid=i.inventoryid WHERE i.projectid = '{$ListProjectID}'  AND inv.section='Fixings') AS bom LEFT JOIN ({$sql_list_of_inv_in_supid}) AS l ON l.inventoryid=bom.inventoryid "; 
				 
				$bom_item_result = mysql_query ($sql);
				while ($bom_item = mysql_fetch_assoc($bom_item_result)) {	 
					//error_log($sql, 3,'C:\\xampp\htdocs\\vergola_contract_system_v3\\my-error.log'); 
	?>	 

				

			<?php 
				$sql = "SELECT * FROM ver_chronoforms_data_material_supplier_vic AS ms LEFT JOIN ver_chronoforms_data_materials_vic AS m ON m.cf_id=ms.materialid LEFT JOIN ver_chronoforms_data_supplier_vic AS s ON s.supplierid=ms.supplierid  WHERE   ms.supplierid='{$s['supplierid']}' AND ms.inventoryid='{$bom_item['inventoryid']}' AND ms.projectid = '{$ListProjectID}' ";
				//error_log($sql, 3,'C:\\xampp\htdocs\\vergola_contract_system_v3\\my-error.log');  exit();
				$result = mysql_query ($sql) or die ('request "Could not execute SQL query" '.$sql);	
				//error_log($sql, 3,'C:\\xampp\htdocs\\vergola_contract_system_v3\\my-error.log');  exit();
			?> 

			<?php  

				if(mysql_fetch_assoc($result) != false){
					echo "<tr><td colspan='6'>{$bom_item['description']}</td></tr>";
					mysql_data_seek($result, 0); 
				}

				 
				while ($row = mysql_fetch_assoc($result)){
				$amount = 0;
				if($bom_item['uom']=="Mtrs"){
					$amount = $row['raw_cost'] * $bom_item['qty'] * $bom_item['length'];
				}else{
					$amount = $row['raw_cost'] * $bom_item['qty'];
				}				
			?>	
				<tr>
					<td >&nbsp;</td> 
					<td ><?php echo $row['qty'] . ' ea'  . $row['raw_description']; ?></td> 
					<td ><?php echo number_format($bom_item['qty']); ?></td>
					<td ><?php echo $bom_item['length']; ?></td> 
					<th> <?php echo number_format($row['raw_cost'],2); ?> </th>
					<th> <?php echo number_format($amount,2) ?> </th> 
				</tr> 

				<?php } ?>	
			 
		<?php //} ?>	
	<?php } ?>
<?php } ?>
 

<tr><td colspan="6" class="subheading" data-section='Gutters' >Gutters  </td></tr>

<?php 

$sqlpurchase = "SELECT i.inventoryid FROM ver_chronoforms_data_contract_bom_vic AS i LEFT JOIN ver_chronoforms_data_inventory_vic AS inv ON inv.inventoryid=i.inventoryid  WHERE  i.projectid = '$ListProjectID' AND inv.section='Guttering'   "; 
 
$sql = "SELECT inventoryid, materialid, supplierid FROM ver_chronoforms_data_material_supplier_vic AS ms   WHERE  ms.projectid = '{$ListProjectID}' AND  ms.inventoryid IN (".$sqlpurchase.")  GROUP BY ms.supplierid  ";
//error_log($sql, 3,'C:\\xampp\htdocs\\vergola_contract_system_v3\\my-error.log'); exit();
$s_result = mysql_query ($sql) or die ('request "Could not execute SQL query" '.$sql);	
while ($s = mysql_fetch_assoc($s_result)) {

	$sql_list_of_inv_in_supid = "SELECT inventoryid, materialid FROM ver_chronoforms_data_material_supplier_vic AS ms   WHERE ms.inventoryid IN (".$sqlpurchase.") AND ms.supplierid='".$s['supplierid']."' GROUP BY ms.inventoryid ";
	//error_log($sql_list_of_inv_in_supid, 3,'C:\\xampp\htdocs\\vergola_contract_system_v3\\my-error.log'); exit();
 
?> 

	<tr>
		<td colspan="6" style="font-weight:bold">
			<?php  //get supplier name  
				$sup_sql = "SELECT * FROM ver_chronoforms_data_supplier_vic WHERE supplierid='{$s['supplierid']}' "; 
				$sup = mysql_fetch_assoc(mysql_query($sup_sql)); 
 
			?>
				Supplier: <?php echo $sup["company_name"];		 
				$titleID = $ListProjectID."_"."frame"."_".mt_rand();
				 
			?>  &nbsp; 
				<input type="hidden" id="frame_po_titleID" value="<?php echo $titleID; ?>" />
				<a id="frame_create_po" class="btn btn-s" rel="nofollow" title="PDF" onclick="window.open(this.href,'win2','status=no,toolbar=no,scrollbars=yes,titlebar=no,menubar=no,resizable=yes,width=auto,height=auto,directories=no,location=no'); return false;" href="index.php?projectid=<?php echo $ListProjectID; ?>&section=gutter&titleID=<?php echo $titleID; ?>&supplierid=<?php echo $s['supplierid']; ?>&option=com_chronoforms&tmpl=component&chronoform=TemplateResidential" style="margin-right:5px; " >Print Purchase Order</a> 
				<!-- <a rel="nofollow" class="btn btn-s" onclick="create_pdf('frame_create_po','frame_po_titleID'); return false;" href="" id="btn_print_frame" style="display:none;">Gen Purchase Order</a>   -->
		</td>
	</tr>
	<tr><th > &nbsp;</th><th>Raw Materials Per Item </th><th> Qty </th><th> Length </th> <th>Cost</th> <th> Amount </th> </tr>
	<?php 
		  
				$sql = "SELECT bom.cf_id, bom.inventoryid, bom.length, bom.qty, bom.uom, bom.description FROM (SELECT i.cf_id, i.inventoryid, i.length, i.qty, i.uom, inv.description  FROM ver_chronoforms_data_contract_bom_vic AS i JOIN ver_chronoforms_data_inventory_vic AS inv ON inv.inventoryid=i.inventoryid WHERE i.projectid = '{$ListProjectID}'  AND inv.section='Guttering') AS bom LEFT JOIN ({$sql_list_of_inv_in_supid}) AS l ON l.inventoryid=bom.inventoryid "; 
				//error_log($sql, 3,'C:\\xampp\htdocs\\vergola_contract_system_v3\\my-error.log'); exit(); 
				$bom_item_result = mysql_query ($sql);
				while ($bom_item = mysql_fetch_assoc($bom_item_result)) {	 
					
	?>	  

			<?php 
				$sql = "SELECT * FROM ver_chronoforms_data_material_supplier_vic AS ms LEFT JOIN ver_chronoforms_data_materials_vic AS m ON m.cf_id=ms.materialid LEFT JOIN ver_chronoforms_data_supplier_vic AS s ON s.supplierid=ms.supplierid  WHERE   ms.supplierid='{$s['supplierid']}' AND ms.inventoryid='{$bom_item['inventoryid']}' AND ms.projectid = '{$ListProjectID}' ";
				//error_log($sql, 3,'C:\\xampp\htdocs\\vergola_contract_system_v3\\my-error.log');  exit();
				$result = mysql_query ($sql) or die ('request "Could not execute SQL query" '.$sql);	
				//error_log($sql, 3,'C:\\xampp\htdocs\\vergola_contract_system_v3\\my-error.log');  exit();
			?> 

			<?php  

				if(mysql_fetch_assoc($result) != false){
					echo "<tr><td colspan='6'>{$bom_item['description']}</td></tr>";
					mysql_data_seek($result, 0); 
				}

				 
				while ($row = mysql_fetch_assoc($result)){
				$amount = 0;
				if($bom_item['uom']=="Mtrs"){
					$amount = $row['raw_cost'] * $bom_item['qty'] * $bom_item['length'];
				}else{
					$amount = $row['raw_cost'] * $bom_item['qty'];
				}				
			?>	
				<tr>
					<td >&nbsp;</td>
					<td ><?php echo $row['raw_description']; ?></td> 
					<td ><?php echo number_format($bom_item['qty']); ?></td>
					<td ><?php echo $bom_item['length']; ?></td> 
					<th> <?php echo number_format($row['raw_cost'],2); ?> </th>
					<th> <?php echo number_format($amount,2) ?> </th> 
				</tr> 

				<?php } ?>	
			 
		<?php //} ?>	
	<?php } ?>
<?php } ?>

<tr><td colspan="6" class="subheading" data-section='Flashings' >Flashings  </td></tr>

<?php 

$sqlpurchase = "SELECT i.inventoryid FROM ver_chronoforms_data_contract_bom_vic AS i LEFT JOIN ver_chronoforms_data_inventory_vic AS inv ON inv.inventoryid=i.inventoryid  WHERE  i.projectid = '$ListProjectID' AND inv.section='Flashings'   "; 
 
$sql = "SELECT inventoryid, materialid, supplierid FROM ver_chronoforms_data_material_supplier_vic AS ms   WHERE  ms.projectid = '{$ListProjectID}' AND ms.inventoryid IN (".$sqlpurchase.")  GROUP BY ms.supplierid  ";
//error_log($sql, 3,'C:\\xampp\htdocs\\vergola_contract_system_v3\\my-error.log'); exit();
$s_result = mysql_query ($sql) or die ('request "Could not execute SQL query" '.$sql);	
while ($s = mysql_fetch_assoc($s_result)) {

	$sql_list_of_inv_in_supid = "SELECT inventoryid, materialid FROM ver_chronoforms_data_material_supplier_vic AS ms   WHERE ms.inventoryid IN (".$sqlpurchase.") AND ms.supplierid='".$s['supplierid']."' GROUP BY ms.inventoryid ";
	//error_log($sql_list_of_inv_in_supid, 3,'C:\\xampp\htdocs\\vergola_contract_system_v3\\my-error.log'); exit();
 
?> 

	<tr>
		<td colspan="6" style="font-weight:bold">
			<?php  //get supplier name  
				$sup_sql = "SELECT * FROM ver_chronoforms_data_supplier_vic WHERE supplierid='{$s['supplierid']}' "; 
				$sup = mysql_fetch_assoc(mysql_query($sup_sql)); 
 
			?>
				Supplier: <?php echo $sup["company_name"];		 
				$titleID = $ListProjectID."_"."flashings"."_".mt_rand();
				 
			?>  &nbsp; 
				<input type="hidden" id="frame_po_titleID" value="<?php echo $titleID; ?>" />
				<a id="frame_create_po" class="btn btn-s" rel="nofollow" title="PDF" onclick="window.open(this.href,'win2','status=no,toolbar=no,scrollbars=yes,titlebar=no,menubar=no,resizable=yes,width=auto,height=auto,directories=no,location=no'); return false;" href="index.php?projectid=<?php echo $ListProjectID; ?>&section=flashings&titleID=<?php echo $titleID; ?>&supplierid=<?php echo $s['supplierid']; ?>&option=com_chronoforms&tmpl=component&chronoform=TemplateResidential" style="margin-right:5px; " >Print Purchase Order</a> 
				<!-- <a rel="nofollow" class="btn btn-s" onclick="create_pdf('frame_create_po','frame_po_titleID'); return false;" href="" id="btn_print_frame" style="display:none;">Gen Purchase Order</a>   -->
		</td>
	</tr>
	<tr><th > &nbsp;</th><th>Raw Materials Per Item </th><th> Qty </th><th> Length </th> <th>Cost</th> <th> Amount </th> </tr>
	<?php 
		  
				$sql = "SELECT bom.cf_id, bom.inventoryid, bom.length, bom.qty, bom.uom, bom.description FROM (SELECT i.cf_id, i.inventoryid, i.length, i.qty, i.uom, inv.description  FROM ver_chronoforms_data_contract_bom_vic AS i JOIN ver_chronoforms_data_inventory_vic AS inv ON inv.inventoryid=i.inventoryid WHERE i.projectid = '{$ListProjectID}'  AND inv.section='Flashings') AS bom LEFT JOIN ({$sql_list_of_inv_in_supid}) AS l ON l.inventoryid=bom.inventoryid "; 
				//error_log($sql, 3,'C:\\xampp\htdocs\\vergola_contract_system_v3\\my-error.log'); exit(); 
				$bom_item_result = mysql_query ($sql);
				while ($bom_item = mysql_fetch_assoc($bom_item_result)) {	 
					
	?>	  

			<?php 
				$sql = "SELECT * FROM ver_chronoforms_data_material_supplier_vic AS ms LEFT JOIN ver_chronoforms_data_materials_vic AS m ON m.cf_id=ms.materialid LEFT JOIN ver_chronoforms_data_supplier_vic AS s ON s.supplierid=ms.supplierid  WHERE   ms.supplierid='{$s['supplierid']}' AND ms.inventoryid='{$bom_item['inventoryid']}' AND ms.projectid = '{$ListProjectID}' GROUP BY ms.inventoryid, ms.materialid";
				//error_log($sql, 3,'C:\\xampp\htdocs\\vergola_contract_system_v3\\my-error.log');  exit();
				$result = mysql_query ($sql) or die ('request "Could not execute SQL query" '.$sql);	
				//error_log($sql, 3,'C:\\xampp\htdocs\\vergola_contract_system_v3\\my-error.log');  exit();
			?> 

			<?php  

				if(mysql_fetch_assoc($result) != false){
					echo "<tr><td colspan='6'>{$bom_item['description']}</td></tr>";
					mysql_data_seek($result, 0); 
				}

				 
				while ($row = mysql_fetch_assoc($result)){
				$amount = 0;
				if($bom_item['uom']=="Mtrs"){
					$amount = $row['raw_cost'] * $bom_item['qty'] * $bom_item['length'];
				}else{
					$amount = $row['raw_cost'] * $bom_item['qty'];
				}				
			?>	
				<tr>
					<td >&nbsp;</td>
					<td ><?php echo $row['raw_description']; ?></td> 
					<td ><?php echo number_format($bom_item['qty']); ?></td>
					<td ><?php echo $bom_item['length']; ?></td> 
					<th> <?php echo number_format($row['raw_cost'],2); ?> </th>
					<th> <?php echo number_format($amount,2) ?> </th> 
				</tr> 

				<?php } ?>	
			 
		<?php //} ?>	
	<?php } ?>
<?php } ?>

<tr><td colspan="6" class="subheading" data-section='Downpipe' >Downpipe  </td></tr>

<?php 

$sqlpurchase = "SELECT i.inventoryid FROM ver_chronoforms_data_contract_bom_vic AS i LEFT JOIN ver_chronoforms_data_inventory_vic AS inv ON inv.inventoryid=i.inventoryid  WHERE  i.projectid = '$ListProjectID' AND inv.section='Downpipe'   "; 
 
$sql = "SELECT inventoryid, materialid, supplierid FROM ver_chronoforms_data_material_supplier_vic AS ms   WHERE ms.projectid = '{$ListProjectID}' AND  ms.inventoryid IN (".$sqlpurchase.")  GROUP BY ms.supplierid  ";
//error_log($sql, 3,'C:\\xampp\htdocs\\vergola_contract_system_v3\\my-error.log'); exit();
$s_result = mysql_query ($sql) or die ('request "Could not execute SQL query" '.$sql);	
while ($s = mysql_fetch_assoc($s_result)) {

	$sql_list_of_inv_in_supid = "SELECT inventoryid, materialid FROM ver_chronoforms_data_material_supplier_vic AS ms   WHERE ms.inventoryid IN (".$sqlpurchase.") AND ms.supplierid='".$s['supplierid']."' GROUP BY ms.inventoryid ";
	//error_log($sql_list_of_inv_in_supid, 3,'C:\\xampp\htdocs\\vergola_contract_system_v3\\my-error.log'); exit();
 
?> 

	<tr>
		<td colspan="6" style="font-weight:bold">
			<?php  //get supplier name  
				$sup_sql = "SELECT * FROM ver_chronoforms_data_supplier_vic WHERE supplierid='{$s['supplierid']}' "; 
				$sup = mysql_fetch_assoc(mysql_query($sup_sql)); 
 
			?>
				Supplier: <?php echo $sup["company_name"];		 
				$titleID = $ListProjectID."_"."downpipe"."_".mt_rand();
				 
			?>  &nbsp; 
				<input type="hidden" id="frame_po_titleID" value="<?php echo $titleID; ?>" />
				<a id="frame_create_po" class="btn btn-s" rel="nofollow" title="PDF" onclick="window.open(this.href,'win2','status=no,toolbar=no,scrollbars=yes,titlebar=no,menubar=no,resizable=yes,width=auto,height=auto,directories=no,location=no'); return false;" href="index.php?projectid=<?php echo $ListProjectID; ?>&section=downpipe&titleID=<?php echo $titleID; ?>&supplierid=<?php echo $s['supplierid']; ?>&option=com_chronoforms&tmpl=component&chronoform=Letters_TemplateUpdate_PDF_Vic" style="margin-right:5px; " >Print Purchase Order</a> 
				<!-- <a rel="nofollow" class="btn btn-s" onclick="create_pdf('frame_create_po','frame_po_titleID'); return false;" href="" id="btn_print_frame" style="display:none;">Gen Purchase Order</a>   -->
		</td>
	</tr>
	<tr><th > &nbsp;</th><th>Raw Materials Per Item </th><th> Qty </th><th> Length </th> <th>Cost</th> <th> Amount </th> </tr>
	<?php 
		  
				$sql = "SELECT bom.cf_id, bom.inventoryid, bom.length, bom.qty, bom.uom, bom.description FROM (SELECT i.cf_id, i.inventoryid, i.length, i.qty, i.uom, inv.description  FROM ver_chronoforms_data_contract_bom_vic AS i JOIN ver_chronoforms_data_inventory_vic AS inv ON inv.inventoryid=i.inventoryid WHERE i.projectid = '{$ListProjectID}'  AND inv.section='Downpipe') AS bom LEFT JOIN ({$sql_list_of_inv_in_supid}) AS l ON l.inventoryid=bom.inventoryid "; 
				//error_log($sql, 3,'C:\\xampp\htdocs\\vergola_contract_system_v3\\my-error.log'); exit(); 
				$bom_item_result = mysql_query ($sql);
				while ($bom_item = mysql_fetch_assoc($bom_item_result)) {	 
					
	?>	  

			<?php 
				$sql = "SELECT * FROM ver_chronoforms_data_material_supplier_vic AS ms LEFT JOIN ver_chronoforms_data_materials_vic AS m ON m.cf_id=ms.materialid LEFT JOIN ver_chronoforms_data_supplier_vic AS s ON s.supplierid=ms.supplierid  WHERE   ms.supplierid='{$s['supplierid']}' AND ms.inventoryid='{$bom_item['inventoryid']}' AND ms.projectid = '{$ListProjectID}' ";
				//error_log($sql, 3,'C:\\xampp\htdocs\\vergola_contract_system_v3\\my-error.log');  exit();
				$result = mysql_query ($sql) or die ('request "Could not execute SQL query" '.$sql);	
				//error_log($sql, 3,'C:\\xampp\htdocs\\vergola_contract_system_v3\\my-error.log');  exit();
			?> 

			<?php  

				if(mysql_fetch_assoc($result) != false){
					echo "<tr><td colspan='6'>{$bom_item['description']}</td></tr>";
					mysql_data_seek($result, 0); 
				}

				 
				while ($row = mysql_fetch_assoc($result)){
				$amount = 0;
				if($bom_item['uom']=="Mtrs"){
					$amount = $row['raw_cost'] * $bom_item['qty'] * $bom_item['length'];
				}else{
					$amount = $row['raw_cost'] * $bom_item['qty'];
				}				
			?>	
				<tr>
					<td >&nbsp;</td>
					<td ><?php echo $row['raw_description']; ?></td> 
					<td ><?php echo number_format($bom_item['qty']); ?></td>
					<td ><?php echo $bom_item['length']; ?></td> 
					<th> <?php echo number_format($row['raw_cost'],2); ?> </th>
					<th> <?php echo number_format($amount,2) ?> </th> 
				</tr> 

				<?php } ?>	
			 
		<?php //} ?>	
	<?php } ?>
<?php } ?>

<tr><td colspan="6" class="subheading" data-section='Vergola' >Vergola System  </td></tr>

<?php 

$sqlpurchase = "SELECT i.inventoryid FROM ver_chronoforms_data_contract_bom_vic AS i LEFT JOIN ver_chronoforms_data_inventory_vic AS inv ON inv.inventoryid=i.inventoryid  WHERE  i.projectid = '$ListProjectID' AND inv.section='Vergola'   "; 
 
$sql = "SELECT inventoryid, materialid, supplierid FROM ver_chronoforms_data_material_supplier_vic AS ms   WHERE  ms.projectid = '{$ListProjectID}' AND ms.inventoryid IN (".$sqlpurchase.")  GROUP BY ms.supplierid  ";
//error_log($sql, 3,'C:\\xampp\htdocs\\vergola_contract_system_v3\\my-error.log'); exit();
$s_result = mysql_query ($sql) or die ('request "Could not execute SQL query" '.$sql);	
while ($s = mysql_fetch_assoc($s_result)) {

	$sql_list_of_inv_in_supid = "SELECT inventoryid, materialid FROM ver_chronoforms_data_material_supplier_vic AS ms   WHERE ms.inventoryid IN (".$sqlpurchase.") AND ms.supplierid='".$s['supplierid']."' GROUP BY ms.inventoryid ";
	//error_log($sql_list_of_inv_in_supid, 3,'C:\\xampp\htdocs\\vergola_contract_system_v3\\my-error.log'); exit();
 
?> 

	<tr>
		<td colspan="6" style="font-weight:bold">
			<?php  //get supplier name  
				$sup_sql = "SELECT * FROM ver_chronoforms_data_supplier_vic WHERE supplierid='{$s['supplierid']}' "; 
				$sup = mysql_fetch_assoc(mysql_query($sup_sql)); 
 
			?>
				Supplier: <?php echo $sup["company_name"];		 
				$titleID = $ListProjectID."_"."vergola"."_".mt_rand();
				 
			?>  &nbsp; 
				<input type="hidden" id="frame_po_titleID" value="<?php echo $titleID; ?>" />
				<a id="frame_create_po" class="btn btn-s" rel="nofollow" title="PDF" onclick="window.open(this.href,'win2','status=no,toolbar=no,scrollbars=yes,titlebar=no,menubar=no,resizable=yes,width=auto,height=auto,directories=no,location=no'); return false;" href="index.php?projectid=<?php echo $ListProjectID; ?>&section=vergola&titleID=<?php echo $titleID; ?>&supplierid=<?php echo $s['supplierid']; ?>&option=com_chronoforms&tmpl=component&chronoform=Letters_TemplateUpdate_PDF_Vic" style="margin-right:5px; " >Print Purchase Order</a> 
				<!-- <a rel="nofollow" class="btn btn-s" onclick="create_pdf('frame_create_po','frame_po_titleID'); return false;" href="" id="btn_print_frame" style="display:none;">Gen Purchase Order</a>   -->
		</td>
	</tr>
	<tr><th > &nbsp;</th><th>Raw Materials Per Item </th><th> Qty </th><th> Length </th> <th>Cost</th> <th> Amount </th> </tr>
	<?php 
		  
				$sql = "SELECT bom.cf_id, bom.inventoryid, bom.length, bom.qty, bom.uom, bom.description FROM (SELECT i.cf_id, i.inventoryid, i.length, i.qty, i.uom, inv.description  FROM ver_chronoforms_data_contract_bom_vic AS i JOIN ver_chronoforms_data_inventory_vic AS inv ON inv.inventoryid=i.inventoryid WHERE i.projectid = '{$ListProjectID}'  AND inv.section='Vergola') AS bom LEFT JOIN ({$sql_list_of_inv_in_supid}) AS l ON l.inventoryid=bom.inventoryid "; 
				//error_log($sql, 3,'C:\\xampp\htdocs\\vergola_contract_system_v3\\my-error.log'); exit(); 
				$bom_item_result = mysql_query ($sql);
				while ($bom_item = mysql_fetch_assoc($bom_item_result)) {	 
					
	?>	  

			<?php 
				$sql = "SELECT * FROM ver_chronoforms_data_material_supplier_vic AS ms LEFT JOIN ver_chronoforms_data_materials_vic AS m ON m.cf_id=ms.materialid LEFT JOIN ver_chronoforms_data_supplier_vic AS s ON s.supplierid=ms.supplierid  WHERE   ms.supplierid='{$s['supplierid']}' AND ms.inventoryid='{$bom_item['inventoryid']}'  AND ms.projectid = '{$ListProjectID}' ";
				//error_log($sql, 3,'C:\\xampp\htdocs\\vergola_contract_system_v3\\my-error.log');  exit();
				$result = mysql_query ($sql) or die ('request "Could not execute SQL query" '.$sql);	
				//error_log($sql, 3,'C:\\xampp\htdocs\\vergola_contract_system_v3\\my-error.log');  exit();
			?> 

			<?php  

				if(mysql_fetch_assoc($result) != false){
					echo "<tr><td colspan='6'>{$bom_item['description']}</td></tr>";
					mysql_data_seek($result, 0); 
				}
 
				while ($row = mysql_fetch_assoc($result)){
				$amount = 0;
				if($bom_item['uom']=="Mtrs"){
					$amount = $row['raw_cost'] * $bom_item['qty'] * $bom_item['length'];
				}else{
					$amount = $row['raw_cost'] * $bom_item['qty'];
				}				
			?>	
				<tr>
					<td >&nbsp;</td>
					<td ><?php echo $row['raw_description']; ?></td> 
					<td ><?php echo number_format($bom_item['qty']); ?></td>
					<td ><?php echo $bom_item['length']; ?></td> 
					<th> <?php echo number_format($row['raw_cost'],2); ?> </th>
					<th> <?php echo number_format($amount,2) ?> </th> 
				</tr> 

				<?php } ?>	
			 
		<?php //} ?>	
	<?php } ?>
<?php } ?>


<tr><td colspan="6" class="subheading" data-section='Misc' >Miscellaneous</td></tr>

<?php 

$sqlpurchase = "SELECT i.inventoryid FROM ver_chronoforms_data_contract_bom_vic AS i LEFT JOIN ver_chronoforms_data_inventory_vic AS inv ON inv.inventoryid=i.inventoryid  WHERE  i.projectid = '$ListProjectID' AND inv.section='Misc'   "; 
 
$sql = "SELECT inventoryid, materialid, supplierid FROM ver_chronoforms_data_material_supplier_vic AS ms   WHERE  ms.projectid = '{$ListProjectID}' AND ms.inventoryid IN (".$sqlpurchase.")  GROUP BY ms.supplierid  ";
//error_log($sql, 3,'C:\\xampp\htdocs\\vergola_contract_system_v3\\my-error.log'); exit();
$s_result = mysql_query ($sql) or die ('request "Could not execute SQL query" '.$sql);	
while ($s = mysql_fetch_assoc($s_result)) {

	$sql_list_of_inv_in_supid = "SELECT inventoryid, materialid FROM ver_chronoforms_data_material_supplier_vic AS ms   WHERE ms.inventoryid IN (".$sqlpurchase.") AND ms.supplierid='".$s['supplierid']."' GROUP BY ms.inventoryid ";
	//error_log($sql_list_of_inv_in_supid, 3,'C:\\xampp\htdocs\\vergola_contract_system_v3\\my-error.log'); exit();
 
?> 

	<tr>
		<td colspan="6" style="font-weight:bold">
			<?php  //get supplier name  
				$sup_sql = "SELECT * FROM ver_chronoforms_data_supplier_vic WHERE supplierid='{$s['supplierid']}' "; 
				$sup = mysql_fetch_assoc(mysql_query($sup_sql)); 
 
			?>
				Supplier: <?php echo $sup["company_name"];		 
				$titleID = $ListProjectID."_"."misc"."_".mt_rand();
				 
			?>  &nbsp; 
				<input type="hidden" id="frame_po_titleID" value="<?php echo $titleID; ?>" />
				<a id="frame_create_po" class="btn btn-s" rel="nofollow" title="PDF" onclick="window.open(this.href,'win2','status=no,toolbar=no,scrollbars=yes,titlebar=no,menubar=no,resizable=yes,width=auto,height=auto,directories=no,location=no'); return false;" href="index.php?projectid=<?php echo $ListProjectID; ?>&section=misc&titleID=<?php echo $titleID; ?>&supplierid=<?php echo $s['supplierid']; ?>&option=com_chronoforms&tmpl=component&chronoform=Letters_TemplateUpdate_PDF_Vic" style="margin-right:5px; " >Print Purchase Order</a> 
				<!-- <a rel="nofollow" class="btn btn-s" onclick="create_pdf('frame_create_po','frame_po_titleID'); return false;" href="" id="btn_print_frame" style="display:none;">Gen Purchase Order</a>   -->
		</td>
	</tr>
	<tr><th > &nbsp;</th><th>Raw Materials Per Item </th><th> Qty </th><th> Length </th> <th>Cost</th> <th> Amount </th> </tr>
	<?php 
		  
				$sql = "SELECT bom.cf_id, bom.inventoryid, bom.length, bom.qty, bom.uom, bom.description FROM (SELECT i.cf_id, i.inventoryid, i.length, i.qty, i.uom, inv.description  FROM ver_chronoforms_data_contract_bom_vic AS i JOIN ver_chronoforms_data_inventory_vic AS inv ON inv.inventoryid=i.inventoryid WHERE i.projectid = '{$ListProjectID}'  AND inv.section='Misc') AS bom LEFT JOIN ({$sql_list_of_inv_in_supid}) AS l ON l.inventoryid=bom.inventoryid "; 
				//error_log($sql, 3,'C:\\xampp\htdocs\\vergola_contract_system_v3\\my-error.log'); exit(); 
				$bom_item_result = mysql_query ($sql);
				while ($bom_item = mysql_fetch_assoc($bom_item_result)) {	 
					
	?>	  

			<?php 
				$sql = "SELECT * FROM ver_chronoforms_data_material_supplier_vic AS ms LEFT JOIN ver_chronoforms_data_materials_vic AS m ON m.cf_id=ms.materialid LEFT JOIN ver_chronoforms_data_supplier_vic AS s ON s.supplierid=ms.supplierid  WHERE   ms.supplierid='{$s['supplierid']}' AND ms.inventoryid='{$bom_item['inventoryid']}'  AND ms.projectid = '{$ListProjectID}' ";
				//error_log($sql, 3,'C:\\xampp\htdocs\\vergola_contract_system_v3\\my-error.log');  exit();
				$result = mysql_query ($sql) or die ('request "Could not execute SQL query" '.$sql);	
				//error_log($sql, 3,'C:\\xampp\htdocs\\vergola_contract_system_v3\\my-error.log');  exit();
			?> 

			<?php  

				if(mysql_fetch_assoc($result) != false){
					echo "<tr><td colspan='6'>{$bom_item['description']}</td></tr>";
					mysql_data_seek($result, 0); 
				}

				 
				while ($row = mysql_fetch_assoc($result)){
				$amount = 0;
				if($bom_item['uom']=="Mtrs"){
					$amount = $row['raw_cost'] * $bom_item['qty'] * $bom_item['length'];
				}else{
					$amount = $row['raw_cost'] * $bom_item['qty'];
				}				
			?>	
				<tr>
					<td >&nbsp;</td>
					<td ><?php echo $row['raw_description']; ?></td> 
					<td ><?php echo number_format($bom_item['qty']); ?></td>
					<td ><?php echo $bom_item['length']; ?></td> 
					<th> <?php echo number_format($row['raw_cost'],2); ?> </th>
					<th> <?php echo number_format($amount,2) ?> </th> 
				</tr> 

				<?php } ?>	
			 
		<?php //} ?>	
	<?php } ?>
<?php } ?>


<tr><td colspan="6" class="subheading" data-section='Extras' >Extras</td></tr>

<?php 

$sqlpurchase = "SELECT i.inventoryid FROM ver_chronoforms_data_contract_bom_vic AS i LEFT JOIN ver_chronoforms_data_inventory_vic AS inv ON inv.inventoryid=i.inventoryid  WHERE  i.projectid = '$ListProjectID' AND inv.section='Extras'   "; 
 
$sql = "SELECT inventoryid, materialid, supplierid FROM ver_chronoforms_data_material_supplier_vic AS ms   WHERE  ms.projectid = '{$ListProjectID}' AND ms.inventoryid IN (".$sqlpurchase.")  GROUP BY ms.supplierid  ";
//error_log($sql, 3,'C:\\xampp\htdocs\\vergola_contract_system_v3\\my-error.log'); exit();
$s_result = mysql_query ($sql) or die ('request "Could not execute SQL query" '.$sql);	
while ($s = mysql_fetch_assoc($s_result)) {

	$sql_list_of_inv_in_supid = "SELECT inventoryid, materialid FROM ver_chronoforms_data_material_supplier_vic AS ms   WHERE ms.inventoryid IN (".$sqlpurchase.") AND ms.supplierid='".$s['supplierid']."' GROUP BY ms.inventoryid ";
	//error_log($sql_list_of_inv_in_supid, 3,'C:\\xampp\htdocs\\vergola_contract_system_v3\\my-error.log'); exit();
 
?> 

	<tr>
		<td colspan="6" style="font-weight:bold">
			<?php  //get supplier name  
				$sup_sql = "SELECT * FROM ver_chronoforms_data_supplier_vic WHERE supplierid='{$s['supplierid']}' "; 
				$sup = mysql_fetch_assoc(mysql_query($sup_sql)); 
 
			?>
				Supplier: <?php echo $sup["company_name"];		 
				$titleID = $ListProjectID."_"."extras"."_".mt_rand();
				 
			?>  &nbsp; 
				<input type="hidden" id="frame_po_titleID" value="<?php echo $titleID; ?>" />
				<a id="frame_create_po" class="btn btn-s" rel="nofollow" title="PDF" onclick="window.open(this.href,'win2','status=no,toolbar=no,scrollbars=yes,titlebar=no,menubar=no,resizable=yes,width=auto,height=auto,directories=no,location=no'); return false;" href="index.php?projectid=<?php echo $ListProjectID; ?>&section=extras&titleID=<?php echo $titleID; ?>&supplierid=<?php echo $s['supplierid']; ?>&option=com_chronoforms&tmpl=component&chronoform=Letters_TemplateUpdate_PDF_Vic" style="margin-right:5px; " >Print Purchase Order</a> 
				<!-- <a rel="nofollow" class="btn btn-s" onclick="create_pdf('frame_create_po','frame_po_titleID'); return false;" href="" id="btn_print_frame" style="display:none;">Gen Purchase Order</a>   -->
		</td>
	</tr>
	<tr><th > &nbsp;</th><th>Raw Materials Per Item </th><th> Qty </th><th> Length </th> <th>Cost</th> <th> Amount </th> </tr>
	<?php 
		  
				$sql = "SELECT bom.cf_id, bom.inventoryid, bom.length, bom.qty, bom.uom, bom.description FROM (SELECT i.cf_id, i.inventoryid, i.length, i.qty, i.uom, inv.description  FROM ver_chronoforms_data_contract_bom_vic AS i JOIN ver_chronoforms_data_inventory_vic AS inv ON inv.inventoryid=i.inventoryid WHERE i.projectid = '{$ListProjectID}'  AND inv.section='Extras') AS bom LEFT JOIN ({$sql_list_of_inv_in_supid}) AS l ON l.inventoryid=bom.inventoryid "; 
				//error_log($sql, 3,'C:\\xampp\htdocs\\vergola_contract_system_v3\\my-error.log'); exit(); 
				$bom_item_result = mysql_query ($sql);
				while ($bom_item = mysql_fetch_assoc($bom_item_result)) {	 
					
	?>	  

			<?php 
				$sql = "SELECT * FROM ver_chronoforms_data_material_supplier_vic AS ms LEFT JOIN ver_chronoforms_data_materials_vic AS m ON m.cf_id=ms.materialid LEFT JOIN ver_chronoforms_data_supplier_vic AS s ON s.supplierid=ms.supplierid  WHERE   ms.supplierid='{$s['supplierid']}' AND ms.inventoryid='{$bom_item['inventoryid']}'  AND ms.projectid = '{$ListProjectID}' ";
				//error_log($sql, 3,'C:\\xampp\htdocs\\vergola_contract_system_v3\\my-error.log');  exit();
				$result = mysql_query ($sql) or die ('request "Could not execute SQL query" '.$sql);	
				//error_log($sql, 3,'C:\\xampp\htdocs\\vergola_contract_system_v3\\my-error.log');  exit();
			?> 

			<?php  

				if(mysql_fetch_assoc($result) != false){
					echo "<tr><td colspan='6'>{$bom_item['description']}</td></tr>";
					mysql_data_seek($result, 0); 
				}

				  
				while ($row = mysql_fetch_assoc($result)){
				$amount = 0;
				if($bom_item['uom']=="Mtrs"){
					$amount = $row['raw_cost'] * $bom_item['qty'] * $bom_item['length'];
				}else{
					$amount = $row['raw_cost'] * $bom_item['qty'];
				}				
			?>	
				<tr>
					<td >&nbsp;</td>
					<td ><?php echo $row['raw_description']; ?></td> 
					<td ><?php echo number_format($bom_item['qty']); ?></td>
					<td ><?php echo $bom_item['length']; ?></td> 
					<th> <?php echo number_format($row['raw_cost'],2); ?> </th>
					<th> <?php echo number_format($amount,2) ?> </th> 
				</tr> 

				<?php } ?>	
			 
		<?php //} ?>	
	<?php } ?>
<?php } ?>

<tr><td colspan="6" class="subheading" data-section='Disbursements' >Disbursements</td></tr>

<?php 

$sqlpurchase = "SELECT i.inventoryid FROM ver_chronoforms_data_contract_bom_vic AS i LEFT JOIN ver_chronoforms_data_inventory_vic AS inv ON inv.inventoryid=i.inventoryid  WHERE  i.projectid = '$ListProjectID' AND inv.section='Disbursements'   "; 
 
$sql = "SELECT inventoryid, materialid, supplierid FROM ver_chronoforms_data_material_supplier_vic AS ms   WHERE  ms.projectid = '{$ListProjectID}' AND ms.inventoryid IN (".$sqlpurchase.")  GROUP BY ms.supplierid  ";
//error_log($sql, 3,'C:\\xampp\htdocs\\vergola_contract_system_v3\\my-error.log'); exit();
$s_result = mysql_query ($sql) or die ('request "Could not execute SQL query" '.$sql);	
while ($s = mysql_fetch_assoc($s_result)) {

	$sql_list_of_inv_in_supid = "SELECT inventoryid, materialid FROM ver_chronoforms_data_material_supplier_vic AS ms   WHERE ms.inventoryid IN (".$sqlpurchase.") AND ms.supplierid='".$s['supplierid']."' GROUP BY ms.inventoryid ";
	//error_log($sql_list_of_inv_in_supid, 3,'C:\\xampp\htdocs\\vergola_contract_system_v3\\my-error.log'); exit();
 
?> 

	<tr>
		<td colspan="6" style="font-weight:bold">
			<?php  //get supplier name  
				$sup_sql = "SELECT * FROM ver_chronoforms_data_supplier_vic WHERE supplierid='{$s['supplierid']}' "; 
				$sup = mysql_fetch_assoc(mysql_query($sup_sql)); 
 
			?>
				Supplier: <?php echo $sup["company_name"];		 
				$titleID = $ListProjectID."_"."disbursements"."_".mt_rand();
				 
			?>  &nbsp; 
				<input type="hidden" id="frame_po_titleID" value="<?php echo $titleID; ?>" />
				<a id="frame_create_po" class="btn btn-s" rel="nofollow" title="PDF" onclick="window.open(this.href,'win2','status=no,toolbar=no,scrollbars=yes,titlebar=no,menubar=no,resizable=yes,width=auto,height=auto,directories=no,location=no'); return false;" href="index.php?projectid=<?php echo $ListProjectID; ?>&section=disbursements&titleID=<?php echo $titleID; ?>&supplierid=<?php echo $s['supplierid']; ?>&option=com_chronoforms&tmpl=component&chronoform=Letters_TemplateUpdate_PDF_Vic" style="margin-right:5px; " >Print Purchase Order</a> 
				<!-- <a rel="nofollow" class="btn btn-s" onclick="create_pdf('frame_create_po','frame_po_titleID'); return false;" href="" id="btn_print_frame" style="display:none;">Gen Purchase Order</a>   -->
		</td>
	</tr>
	<tr><th > &nbsp;</th><th>Raw Materials Per Item </th><th> Qty </th><th> Length </th> <th>Cost</th> <th> Amount </th> </tr>
	<?php 
		  
				$sql = "SELECT bom.cf_id, bom.inventoryid, bom.length, bom.qty, bom.uom, bom.description FROM (SELECT i.cf_id, i.inventoryid, i.length, i.qty, i.uom, inv.description  FROM ver_chronoforms_data_contract_bom_vic AS i JOIN ver_chronoforms_data_inventory_vic AS inv ON inv.inventoryid=i.inventoryid WHERE i.projectid = '{$ListProjectID}'  AND inv.section='Disbursements') AS bom LEFT JOIN ({$sql_list_of_inv_in_supid}) AS l ON l.inventoryid=bom.inventoryid "; 
				//error_log($sql, 3,'C:\\xampp\htdocs\\vergola_contract_system_v3\\my-error.log'); exit(); 
				$bom_item_result = mysql_query ($sql);
				while ($bom_item = mysql_fetch_assoc($bom_item_result)) {	 
					
	?>	  

			<?php 
				$sql = "SELECT * FROM ver_chronoforms_data_material_supplier_vic AS ms LEFT JOIN ver_chronoforms_data_materials_vic AS m ON m.cf_id=ms.materialid LEFT JOIN ver_chronoforms_data_supplier_vic AS s ON s.supplierid=ms.supplierid  WHERE   ms.supplierid='{$s['supplierid']}' AND ms.inventoryid='{$bom_item['inventoryid']}' AND ms.projectid = '{$ListProjectID}' ";
				//error_log($sql, 3,'C:\\xampp\htdocs\\vergola_contract_system_v3\\my-error.log');  exit();
				$result = mysql_query ($sql) or die ('request "Could not execute SQL query" '.$sql);	
				//error_log($sql, 3,'C:\\xampp\htdocs\\vergola_contract_system_v3\\my-error.log');  exit();
			?> 

			<?php  

				if(mysql_fetch_assoc($result) != false){
					echo "<tr><td colspan='6'>{$bom_item['description']}</td></tr>";
					mysql_data_seek($result, 0); 
				}

				 
				while ($row = mysql_fetch_assoc($result)){
				$amount = 0;
				if($bom_item['uom']=="Mtrs"){
					$amount = $row['raw_cost'] * $bom_item['qty'] * $bom_item['length'];
				}else{
					$amount = $row['raw_cost'] * $bom_item['qty'];
				}				
			?>	
				<tr>
					<td >&nbsp;</td>
					<td ><?php echo $row['raw_description']; ?></td> 
					<td ><?php echo number_format($bom_item['qty']); ?></td>
					<td ><?php echo $bom_item['length']; ?></td> 
					<th> <?php echo number_format($row['raw_cost'],2); ?> </th>
					<th> <?php echo number_format($amount,2) ?> </th> 
				</tr> 

				<?php } ?>	
			 
		<?php //} ?>	
	<?php } ?>
<?php } ?>


<tr><td colspan="6" class="subheading" data-section='Reorders' >Reorders</td></tr>

<?php 

$sqlpurchase = "SELECT i.inventoryid FROM ver_chronoforms_data_contract_bom_vic AS i LEFT JOIN ver_chronoforms_data_inventory_vic AS inv ON inv.inventoryid=i.inventoryid  WHERE  i.projectid = '$ListProjectID' AND i.is_reorder=1   "; 
 
$sql = "SELECT inventoryid, materialid, supplierid FROM ver_chronoforms_data_material_supplier_vic AS ms   WHERE  ms.projectid = '{$ListProjectID}' AND  ms.inventoryid IN (".$sqlpurchase.")  GROUP BY ms.supplierid  ";
//error_log($sql, 3,'C:\\xampp\htdocs\\vergola_contract_system_v3\\my-error.log'); exit();
$s_result = mysql_query ($sql) or die ('request "Could not execute SQL query" '.$sql);	
while ($s = mysql_fetch_assoc($s_result)) {

	$sql_list_of_inv_in_supid = "SELECT inventoryid, materialid FROM ver_chronoforms_data_material_supplier_vic AS ms   WHERE ms.inventoryid IN (".$sqlpurchase.") AND ms.supplierid='".$s['supplierid']."' GROUP BY ms.inventoryid ";
	//error_log($sql_list_of_inv_in_supid, 3,'C:\\xampp\htdocs\\vergola_contract_system_v3\\my-error.log'); exit();
 
?> 

	<tr>
		<td colspan="6" style="font-weight:bold">
			<?php  //get supplier name  
				$sup_sql = "SELECT * FROM ver_chronoforms_data_supplier_vic WHERE supplierid='{$s['supplierid']}' "; 
				$sup = mysql_fetch_assoc(mysql_query($sup_sql)); 
 
			?>
				Supplier: <?php echo $sup["company_name"];		 
				$titleID = $ListProjectID."_"."reorder"."_".mt_rand();
				 
			?>  &nbsp; 
				<input type="hidden" id="frame_po_titleID" value="<?php echo $titleID; ?>" />
				<a id="frame_create_po" class="btn btn-s" rel="nofollow" title="PDF" onclick="window.open(this.href,'win2','status=no,toolbar=no,scrollbars=yes,titlebar=no,menubar=no,resizable=yes,width=auto,height=auto,directories=no,location=no'); return false;" href="index.php?projectid=<?php echo $ListProjectID; ?>&section=reorder&titleID=<?php echo $titleID; ?>&supplierid=<?php echo $s['supplierid']; ?>&option=com_chronoforms&tmpl=component&chronoform=Letters_TemplateUpdate_PDF_Vic" style="margin-right:5px; " >Print Purchase Order</a> 
				<!-- <a rel="nofollow" class="btn btn-s" onclick="create_pdf('frame_create_po','frame_po_titleID'); return false;" href="" id="btn_print_frame" style="display:none;">Gen Purchase Order</a>   -->
		</td>
	</tr>
	<tr><th > &nbsp;</th><th>Raw Materials Per Item </th><th> Qty </th><th> Length </th> <th>Cost</th> <th> Amount </th> </tr>
	<?php 
		  
				$sql = "SELECT bom.cf_id, bom.inventoryid, bom.length, bom.qty, bom.uom, bom.description FROM (SELECT i.cf_id, i.inventoryid, i.length, i.qty, i.uom, inv.description  FROM ver_chronoforms_data_contract_bom_vic AS i JOIN ver_chronoforms_data_inventory_vic AS inv ON inv.inventoryid=i.inventoryid WHERE i.projectid = '{$ListProjectID}'  AND i.is_reorder=1) AS bom LEFT JOIN ({$sql_list_of_inv_in_supid}) AS l ON l.inventoryid=bom.inventoryid "; 
				//error_log($sql, 3,'C:\\xampp\htdocs\\vergola_contract_system_v3\\my-error.log'); exit(); 
				$bom_item_result = mysql_query ($sql);
				while ($bom_item = mysql_fetch_assoc($bom_item_result)) {	 
					
	?>	  

			<?php 
				$sql = "SELECT * FROM ver_chronoforms_data_material_supplier_vic AS ms LEFT JOIN ver_chronoforms_data_materials_vic AS m ON m.cf_id=ms.materialid LEFT JOIN ver_chronoforms_data_supplier_vic AS s ON s.supplierid=ms.supplierid  WHERE   ms.supplierid='{$s['supplierid']}' AND ms.inventoryid='{$bom_item['inventoryid']}' AND ms.projectid = '{$ListProjectID}' ";
				//error_log($sql, 3,'C:\\xampp\htdocs\\vergola_contract_system_v3\\my-error.log');  exit();
				$result = mysql_query ($sql) or die ('request "Could not execute SQL query" '.$sql);	
				//error_log($sql, 3,'C:\\xampp\htdocs\\vergola_contract_system_v3\\my-error.log');  exit();
			?> 

			<?php  

				if(mysql_fetch_assoc($result) != false){
					echo "<tr><td colspan='6'>{$bom_item['description']}</td></tr>";
					mysql_data_seek($result, 0); 
				}
 
				while ($row = mysql_fetch_assoc($result)){
				$amount = 0;
				if($bom_item['uom']=="Mtrs"){
					$amount = $row['raw_cost'] * $bom_item['qty'] * $bom_item['length'];
				}else{
					$amount = $row['raw_cost'] * $bom_item['qty'];
				}				
			?>	
				<tr>
					<td >&nbsp;</td>
					<td ><?php echo $row['raw_description']; ?></td> 
					<td ><?php echo number_format($bom_item['qty']); ?></td>
					<td ><?php echo $bom_item['length']; ?></td> 
					<th> <?php echo number_format($row['raw_cost'],2); ?> </th>
					<th> <?php echo number_format($amount,2) ?> </th> 
				</tr> 

				<?php } ?>	
			 
		<?php //} ?>	
	<?php } ?>
<?php } ?>
</table>
<br/>
<!-- <button class="btn" onclick="window.history.back();" style="margin:10px 0 5px 0;">&nbsp; Close &nbsp; </button> -->
<?php echo "<a href=\"".JURI::base()."contract-listing-vic/contract-folder-vic/contract-bom-vic?quoteid=".$cust_id."&projectid=".$projectid."\" class='btn '>&nbsp;&nbsp; Close &nbsp;&nbsp;</a>"; ?>
 
<script type="text/javascript">

$(document).ready(function() {
	var titleID = getUrlParameter('titleID');
	//alert(print_section);
	if(titleID.length>0){
		window.location.href = "index.php?titleID="+titleID+"&option=com_chronoforms&tmpl=component&chronoform=Download-PDF"; 
	}

	removeParam('titleID');
		 

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