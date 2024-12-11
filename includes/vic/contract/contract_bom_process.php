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

function list_colours($name="",$selected=null){  
	$sqlcolour = "SELECT * FROM ver_chronoforms_data_colour_vic ORDER BY colour";
	$resultcolour = mysql_query ($sqlcolour);
	$r = "<select class='colour' name='{$name}' id='{$name}'>";
	while ($colour = mysql_fetch_assoc($resultcolour)) 
	{ 
		$r .= "<option";
		if ($selected != null && $colour['colour'] == $selected) { echo " selected=\"selected\"";} 
		else {$r .= "";}
		$r .= ">{$colour['colour']}</option>";
	}
	$r .= "</select>";
	return $r;
}

function list_colour_bond($name="",$selected=null){  
	$sql = "SELECT cf_id, rrp, cost, category FROM ver_chronoforms_data_inventory_vic WHERE section = 'Frame' and  cf_id  = '13' or cf_id = '14' or section ='Guttering' and cf_id = '41' or cf_id = '42'";	
	$paints = mysql_query ($sql);

	$r = "<select class=\"paint-list\" id='{$name}' name='{$name}' >";  
    while ($paint = mysql_fetch_array($paints)){
	  	$r .= "<option value=\"".$paint['category']."\" "; 
		if($paint['category'] == $selected){ $r .= "selected=\"selected\"";
		} else { $r .= "";}
		$r .= ">".$paint['category']."</option>";	
	}
	$r .= "</select>";

	return $r;

}

function list_suppliers($name,$selected=null){
	$sqlsupplier = "SELECT * FROM ver_chronoforms_data_supplier_vic ORDER BY company_name";
	$resultsupplier = mysql_query ($sqlsupplier);

	$r = "<select class=\"supplierpop\" name=\"{$name}\" id='{$name}'>";
	$r .= "<option value=\"Stock\">STOCK</option>";
	while ($supplier = mysql_fetch_array($resultsupplier)) 
	{  
		$r .= "<option value=\"{$supplier['supplierid']}\">{$supplier['company_name']}</option>";
	}
	$r .= "</select>"; 
	return $r;
}


?>
<script>
	$(document).ready(function() {
	var supplierpop=0;
	$('.supplierpop').each(function(){
	 supplierpop++;
	 var newID='supplierpop'+supplierpop;
	 $(this).attr('id',newID);           
	   });
	   
	var supplieridpop=0;
	$('.supplieridpop').each(function(){
	 supplieridpop++;
	 var newID='supplieridpop'+supplieridpop;
	 $(this).attr('id',newID);           
	   });   
	});
</script>

<?php  
$cust_id = $_REQUEST['quoteid'];
$projectid =$_REQUEST['projectid'];
if(isset($_POST['cancel'])){ 
	header('Location:'.JURI::base().'contract-listing-vic/contract-folder-vic?quoteid='.$cust_id);
}

$suplistpop = "1";
$supidpop = "1";


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


if(isset($_POST['process']))
{	
	$current_date = date('Y-m-d H:i:s');
	$cnt = count($_POST['desc']);
	$cnt2 = count($_POST['inventid']);
	$cnt3 = count($_POST['colour']);
	$cnt4 = count($_POST['uom']);
	$cnt5 = count($_POST['qty']);
	$cnt6 = count($_POST['length']);
	$cnt7 = count($_POST['cst']);
	$cnt8 = count($_POST['rrp']);
	$cnt9 = count($_POST['supplierid']);
 
	if ($cnt > 0 && $cnt == $cnt2 && $cnt2 == $cnt3 && $cnt3 == $cnt4 && $cnt4 == $cnt5 && $cnt5 == $cnt6 && $cnt6 == $cnt7 && $cnt7 == $cnt8 && $cnt8 == $cnt9) {
	    $insertArr = array();
	    
		for ($i=0; $i<$cnt; $i++) {       	
			$insertArr[] = "('$current_date', '$cust_id', '$ListProjectID', '$ListFramework', '$ListVergolaType', '" . mysql_real_escape_string($_POST['desc'][$i]) . "', '" . mysql_real_escape_string($_POST['inventid'][$i]) . "', '" . mysql_real_escape_string($_POST['colour'][$i]) . "', '" . mysql_real_escape_string($_POST['uom'][$i]) . "', '" . mysql_real_escape_string($_POST['qty'][$i]) . "', '" . mysql_real_escape_string($_POST['length'][$i]) . "', '" . mysql_real_escape_string($_POST['cst'][$i]) . "', '" . mysql_real_escape_string($_POST['rrp'][$i]) . "' , '" . mysql_real_escape_string($_POST['supplierid'][$i]) . "')";
		}

		$queryn = "INSERT INTO ver_chronoforms_data_contract_bom_vic (orderdate, quoteid, projectid, framework_type, framework, description, inventoryid, colour, uom, qty, length, cost, rrp, supplierid) VALUES " . implode(", ", $insertArr);
	 
	 	mysql_query($queryn) or trigger_error("Insert failed: " . mysql_error()); 
	} 
}

?>



  <h2><span>Project Name: <?php echo " ".$ListProjName; ?></span> <span>Contract ID: <?php echo " ".$ListProjectID; ?></span>
    <input type="submit" value="Process Order" name="process" class="btn-process"/>
    <input type="submit" value="Process Order & Close" name="process-save" class="btn-process"/>
    <input type="submit" value="Cancel" name="cancel" class="btn-process"/>
  </h2>
  
  <table class="listing-table">
    <thead>
      <tr>
        <th style="width:214px;">Description</th> 
        <th style="width:6%;">UOM</th>
        <th style="width:7%;">QTY</th>
        <th style="width:10%;">Length</th>
        <th style="width:10%;">Colour</th>
        <th style="width:10%;">Finish</th>
        <th style="width:10%;">Supplier</th>
        <th style="width:10%;">Image</th>
        <th style="width:10%;">Delete</th>
      </tr>
    </thead>
    <tbody>
    <?php
    //------------- Framework Layout ---------------
    $sqlquotes = "SELECT * FROM ver_chronoforms_data_contract_items_vic AS i  LEFT JOIN ver_chronoforms_data_inventory_vic AS inv ON inv.inventoryid=i.inventoryid   WHERE quoteid = '$cust_id' and projectid = '$projectid' and qty != '0.00'   "; //ORGINAL QUERY
    //$sqlquotes = "SELECT * FROM ver_chronoforms_data_contract_items_vic AS i LEFT JOIN ver_chronoforms_data_inventory_vic AS inv ON inv.inventoryid=i.inventoryid WHERE quoteid = '$cust_id' and projectid = '$projectid' and qty != '0.00' AND section = 'Frame' and category = 'CBeams' or category = 'Timber' ";
    //error_log($sqlquotes, 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_sa\\my-error.log');
	$resultquotes = mysql_query ($sqlquotes) or die ('request "Could not execute SQL query" '.$sqlquotes);
 	  
	//mysql_data_seek($result, 0);
	echo "<tr><td colspan=\"9\" class=\"subheading\" data-section='Frame' >Framework &nbsp;&nbsp; <button onclick='process_bom(event,this)'>Process</button> </td></tr>"; 
	while($row = mysql_fetch_assoc($resultquotes)){

		if($row["section"]=="Frame" && ($row["category"]=="Beams" || $row["category"]=="CBeams")){
			echo "<tr  data-inventoryid='".$row["inventoryid"]."'>";
			echo "<td> {$row["description"]} </td>"; 
			echo "<td> {$row["uom"]} </td>"; 
			echo "<td> <input type='text' id='qty' name='qty' value='{$row["qty"]}' /> </td>"; 
			echo "<td> <input type='text' id='length' name='length' value='{$row["length"]}' /> </td>";  
			echo "<td> ".list_colours("colour")."</td>"; 
			echo "<td> ".list_colour_bond("colour")."</td>"; 
			echo "<td> ".list_suppliers("supplier")."</td>"; 
			if(false && $row["photo"] !="") { //can't be use as of now bec. no photo record was included in inserting in ver_chronoforms_data_contract_items_vic from ver_chronoforms_data_inventory_vic table.
									
			}else{
				echo "<td>No image</td>"; 
			}
			echo"<td style=\"width:10%;\"><input type=\"submit\" class=\"btndel\" name=\"del\" value=\"Delete\"></td>";
			echo "</tr>";
		}
	}	

	mysql_data_seek($resultquotes, 0);
	echo "<tr><td colspan=\"9\" class=\"subheading\">Fittings</td></tr>"; 
	while($row = mysql_fetch_assoc($resultquotes)){

		if($row["section"]=="Fixings" || ($row["section"]=="Frame" && ($row["category"]=="Posts"))){
			echo "<tr data-section='Frame' data-inventoryid='".$row["inventoryid"]."'>";
			echo "<td> {$row["description"]} </td>"; 
			echo "<td> {$row["uom"]} </td>"; 
			echo "<td> <input type='text' id='qty' name='qty' value='{$row["qty"]}' /> </td>"; 
			echo "<td> <input type='text' id='length' name='length' value='{$row["length"]}' /> </td>";  
			echo "<td> ".list_colours("colour")."</td>"; 
			echo "<td> ".list_colour_bond("colour")."</td>"; 
			echo "<td> ".list_suppliers("supplier")."</td>"; 
			if(false && $row["photo"] !="") { //can't be use as of now bec. no photo record was included in inserting in ver_chronoforms_data_contract_items_vic from ver_chronoforms_data_inventory_vic table.
									
			}else{
				echo "<td>No image</td>"; 
			}
			echo"<td style=\"width:10%;\"><input type=\"submit\" class=\"btndel\" name=\"del\" value=\"Delete\"></td>";
			echo "</tr>";
		}
	}	


	mysql_data_seek($resultquotes, 0);
	echo "<tr><td colspan=\"9\" class=\"subheading\">Gutters</td></tr>"; 
	while($row = mysql_fetch_assoc($resultquotes)){

		if($row["section"]=="Guttering"){
			echo "<tr data-section='Frame' data-inventoryid='".$row["inventoryid"]."'>";
			echo "<td> {$row["description"]} </td>"; 
			echo "<td> {$row["uom"]} </td>"; 
			echo "<td> <input type='text' id='qty' name='qty' value='{$row["qty"]}' /> </td>"; 
			echo "<td> <input type='text' id='length' name='length' value='{$row["length"]}' /> </td>";  
			echo "<td> ".list_colours("colour")."</td>"; 
			echo "<td> ".list_colour_bond("colour")."</td>"; 
			echo "<td> ".list_suppliers("supplier")."</td>"; 
			if(false && $row["photo"] !="") { //can't be use as of now bec. no photo record was included in inserting in ver_chronoforms_data_contract_items_vic from ver_chronoforms_data_inventory_vic table.
									
			}else{
				echo "<td>No image</td>"; 
			}
			echo"<td style=\"width:10%;\"><input type=\"submit\" class=\"btndel\" name=\"del\" value=\"Delete\"></td>";
			echo "</tr>";
		}
	}	


	mysql_data_seek($resultquotes, 0);
	echo "<tr><td colspan=\"9\" class=\"subheading\">Flashings</td></tr>"; 
	while($row = mysql_fetch_assoc($resultquotes)){

		if($row["section"]=="Flashings"){
			echo "<tr data-section='Frame' data-inventoryid='".$row["inventoryid"]."'>";
			echo "<td> {$row["description"]} </td>"; 
			echo "<td> {$row["uom"]} </td>"; 
			echo "<td> <input type='text' id='qty' name='qty' value='{$row["qty"]}' /> </td>"; 
			echo "<td> <input type='text' id='length' name='length' value='{$row["length"]}' /> </td>";  
			echo "<td> ".list_colours("colour")."</td>";
			echo "<td> ".list_colour_bond("colour")."</td>";  
			echo "<td> ".list_suppliers("supplier")."</td>"; 
			if(false && $row["photo"] !="") { //can't be use as of now bec. no photo record was included in inserting in ver_chronoforms_data_contract_items_vic from ver_chronoforms_data_inventory_vic table.
									
			}else{
				echo "<td>No image</td>"; 
			}
			echo"<td style=\"width:10%;\"><input type=\"submit\" class=\"btndel\" name=\"del\" value=\"Delete\"></td>";
			echo "</tr>";
		}
	}	


	mysql_data_seek($resultquotes, 0);
	echo "<tr><td colspan=\"9\" class=\"subheading\">Downpipe</td></tr>"; 
	while($row = mysql_fetch_assoc($resultquotes)){

		if($row["section"]=="Downpipe"){
			echo "<tr data-section='Frame' data-inventoryid='".$row["inventoryid"]."'>";
			echo "<td> {$row["description"]} </td>"; 
			echo "<td> {$row["uom"]} </td>"; 
			echo "<td>  </td>"; 
			echo "<td>   </td>";  
			echo "<td>  </td>"; 
			echo "<td>  </td>"; 
			echo "<td> ".list_suppliers("supplier")."</td>"; 
			if(false && $row["photo"] !="") { //can't be use as of now bec. no photo record was included in inserting in ver_chronoforms_data_contract_items_vic from ver_chronoforms_data_inventory_vic table.
									
			}else{
				echo "<td>No image</td>"; 
			}
			echo"<td style=\"width:10%;\"><input type=\"submit\" class=\"btndel\" name=\"del\" value=\"Delete\"></td>";
			echo "</tr>";
		}
	}


	mysql_data_seek($resultquotes, 0);
	echo "<tr><td colspan=\"9\" class=\"subheading\">Vergola System</td></tr>"; 
	while($row = mysql_fetch_assoc($resultquotes)){

		if($row["section"]=="Vergola"){
			echo "<tr data-section='Frame' data-inventoryid='".$row["inventoryid"]."'>";
			echo "<td> {$row["description"]} </td>"; 
			echo "<td> {$row["uom"]} </td>"; 
			echo "<td> <input type='text' id='qty' name='qty' value='{$row["qty"]}' /> </td>"; 
			echo "<td> <input type='text' id='length' name='length' value='{$row["length"]}' /> </td>";  
			echo "<td> ".list_colours("colour")."</td>";
			echo "<td> ".list_colour_bond("colour")."</td>";  
			echo "<td> ".list_suppliers("supplier")."</td>"; 
			if(false && $row["photo"] !="") { //can't be use as of now bec. no photo record was included in inserting in ver_chronoforms_data_contract_items_vic from ver_chronoforms_data_inventory_vic table.
									
			}else{
				echo "<td>No image</td>"; 
			}
			echo"<td style=\"width:10%;\"><input type=\"submit\" class=\"btndel\" name=\"del\" value=\"Delete\"></td>";
			echo "</tr>";
		}
	}
 
	mysql_data_seek($resultquotes, 0);
	echo "<tr><td colspan=\"9\" class=\"subheading\">Miscellaneous</td></tr>"; 
	while($row = mysql_fetch_assoc($resultquotes)){

		if($row["section"]=="Misc"){
			echo "<tr data-section='Frame' data-inventoryid='".$row["inventoryid"]."'>";
			echo "<td> {$row["description"]} </td>"; 
			echo "<td> {$row["uom"]} </td>"; 
			echo "<td> <input type='text' id='qty' name='qty' value='{$row["qty"]}' /> </td>"; 
			echo "<td> <input type='text' id='length' name='length' value='{$row["length"]}' /> </td>";  
			echo "<td> ".list_colours("colour")."</td>"; 
			echo "<td> ".list_colour_bond("colour")."</td>"; 
			echo "<td> ".list_suppliers("supplier")."</td>"; 
			if(false && $row["photo"] !="") { //can't be use as of now bec. no photo record was included in inserting in ver_chronoforms_data_contract_items_vic from ver_chronoforms_data_inventory_vic table.
									
			}else{
				echo "<td>No image</td>"; 
			}
			echo"<td style=\"width:10%;\"><input type=\"submit\" class=\"btndel\" name=\"del\" value=\"Delete\"></td>";
			echo "</tr>";
		}
	}

	mysql_data_seek($resultquotes, 0);
	echo "<tr><td colspan=\"9\" class=\"subheading\">Extras</td></tr>"; 
	while($row = mysql_fetch_assoc($resultquotes)){

		if($row["section"]=="Extras"){
			echo "<tr data-section='Frame' data-inventoryid='".$row["inventoryid"]."'>";
			echo "<td> {$row["description"]} </td>"; 
			echo "<td> {$row["uom"]} </td>"; 
			echo "<td> <input type='text' id='qty' name='qty' value='{$row["qty"]}' /> </td>"; 
			echo "<td> <input type='text' id='length' name='length' value='{$row["length"]}' /> </td>";  
			echo "<td> ".list_colours("colour")."</td>"; 
			echo "<td> ".list_colour_bond("colour")."</td>"; 
			echo "<td> ".list_suppliers("supplier")."</td>"; 
			if(false && $row["photo"] !="") { //can't be use as of now bec. no photo record was included in inserting in ver_chronoforms_data_contract_items_vic from ver_chronoforms_data_inventory_vic table.
									
			}else{
				echo "<td>No image</td>"; 
			}
			echo"<td style=\"width:10%;\"><input type=\"submit\" class=\"btndel\" name=\"del\" value=\"Delete\"></td>";
			echo "</tr>";
		}
	}  

	mysql_data_seek($resultquotes, 0);
	echo "<tr><td colspan=\"9\" class=\"subheading\">Disbursements</td></tr>"; 
	while($row = mysql_fetch_assoc($resultquotes)){

		if($row["section"]=="Disbursements"){
			echo "<tr data-section='Frame' data-inventoryid='".$row["inventoryid"]."'>";
			echo "<td> {$row["description"]} </td>"; 
			echo "<td> {$row["uom"]} </td>"; 
			echo "<td> <input type='text' id='qty' name='qty' value='{$row["qty"]}' /> </td>"; 
			echo "<td> <input type='text' id='length' name='length' value='{$row["length"]}' /> </td>";  
			echo "<td> ".list_colours("colour")."</td>"; 
			echo "<td> ".list_colour_bond("colour")."</td>"; 
			echo "<td> ".list_suppliers("supplier")."</td>"; 
			if(false && $row["photo"] !="") { //can't be use as of now bec. no photo record was included in inserting in ver_chronoforms_data_contract_items_vic from ver_chronoforms_data_inventory_vic table.
									
			}else{
				echo "<td>No image</td>"; 
			}
			echo"<td style=\"width:10%;\"><input type=\"submit\" class=\"btndel\" name=\"del\" value=\"Delete\"></td>";
			echo "</tr>";
		}
	}  	
		
 
	?>


    </tbody>
  </table>

<form method="post" class="" id="">  
  <!-- <input type="submit" value="Process Order" name="process" class="btn-process"/>
  <input type="submit" value="Process Order & Close" name="process-save" class="btn-process"/>
  <input type="submit" value="Cancel" name="cancel" class="btn-process"/> -->
</form>


<script type="text/javascript">
	
function process_bom(event,o){
	event.preventDefault();
	var d = event.target.attributes;
	// console.log(d); 
		// console.log($(event.target).attr('data-class')); 
	// console.log($(o).closest('form').attr("action")); 

	var action = $(o).closest('form').attr('action');  
	var iData = $(o).closest('form').serialize(); 
 	console.log(iData); 
 	return false;

 	$.ajax({
			type: "POST",
			url: action,
			dataType: 'json', 	
			data: iData,	
			success: function(data) {					
				if(data.success==true){  
 					 window.href("");
						 		 
				}else{
					$("#notification .message").addClass('error'); 
				}
 

			}		
		});

		return false;
	}


}	


</script>