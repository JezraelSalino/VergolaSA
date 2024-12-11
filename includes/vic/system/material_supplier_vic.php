<img class="close" onclick="document.getElementById('lightbox').style.display='none';document.getElementById('lightbox-shadow').style.display='none'" src="<?php echo JURI::base().'jscript/close.png'; ?>">

<?php
$id = $_REQUEST['inventoryid'];
$matid = $_REQUEST['materialid'];
if(isset($_POST['update']))
{
$check = $_POST['chk'];
$inventid = $_POST['inventoryid'];
$materialid = $_POST['materialid'];
foreach ($check as $chk)
		{$sql = "INSERT INTO ver_chronoforms_data_material_supplier_vic ".
           "(materialid, supplierid, inventoryid) ".
           "VALUES ('$materialid', '$chk','$inventid')"; $retval = mysql_query( $sql );
		   }

if(! $retval )
{
header('Location:'.JURI::base().'system-management-vic/inventory-listing-vic/inventory-updatelist-vic?inventoryid='.$id);	
}
header('Location:'.JURI::base().'system-management-vic/inventory-listing-vic/inventory-updatelist-vic?inventoryid='.$id);	
} 
else
{ 

    $sql = "SELECT * FROM ver_chronoforms_data_supplier_vic ORDER BY company_name";
    $sql_result = mysql_query ($sql) or die ('request "Could not execute SQL query" '.$sql);
	echo "<form method=\"post\" action=\"".JURI::base()."system-management-vic/inventory-listing-vic/material-supplier-vic?inventoryid={$id}&materialid={$row[0]}\">";
	echo "<input type=\"hidden\" value=\"{$id}\"  name=\"inventoryid\">";
	echo "<div id=\"innerbox\"><table id=\"tbl-supplier\">";
    while ($row = mysql_fetch_assoc($sql_result)) 
    { 
	 $PostSupplierID = $row["supplierid"]; 
	 $result = mysql_query("SELECT * FROM ver_chronoforms_data_material_supplier_vic WHERE inventoryid  = '$id' and supplierid = '$PostSupplierID' and materialid = '$matid'");$retrieve = mysql_fetch_array($result);if (!$result) {die("Error: Data not found..");}
$GetMaterialID = $retrieve['materialid'];
$GetSupplierID = $retrieve['supplierid'];

	  echo "<tr><td class=\"tbl-chk\"><input type=\"hidden\" value=\"{$matid}\" name=\"materialid\"><input type=\"checkbox\" name=\"chk[]\" value=\"".$row["supplierid"]."\"";
	  if ($row["supplierid"] == $GetSupplierID && $GetMaterialID == $matid) { echo " checked=\"checked\"";} else {echo " ";}
	  echo "></td><td class=\"tbl-name\">".$row["company_name"]."</td></tr>";
    } 
	echo "</table></div>";
	
	echo "<input type=\"submit\" name=\"update\" value=\"Update\" id=\"btn-sup\" >";
	
	
	echo "</form>";
	
}

  ?>
  
 
            
            <?php exit; ?>