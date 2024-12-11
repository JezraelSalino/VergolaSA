<?php  
 

$id =$_REQUEST['cf_id'];
 
$result = mysql_query("SELECT * FROM ver_chronoforms_data_materials_vic WHERE cf_id  = '$id'");

$retrieve = mysql_fetch_assoc($result);
if (!$result) 
		{
		die("Error: Data not found..");
		}	
	//error_log(print_r($retrieve,true), 3,'C:\\xampp\htdocs\\vergola_contract_system_v3\\my-error.log');
	// Inventory Details
	$cf_id = $retrieve['cf_id'];	 
	$raw_description = $retrieve['raw_description']; 		
	$raw_cost = $retrieve['raw_cost'];  
	$supplierid = $retrieve['supplierid'];

if(isset($_POST['save']))
{	 
	$raw_description=$_POST['raw_description']; 
	$raw_cost = $_POST['raw_cost']; 
	$cf_id = $_POST['cf_id'];
	 
	$sql = "UPDATE `ver_chronoforms_data_materials_vic` SET raw_description = '$raw_description' , raw_cost = '$raw_cost' WHERE cf_id={$cf_id} ";
	//error_log($sql, 3,'C:\\xampp\htdocs\\vergola_contract_system_v3\\my-error.log');
	mysql_query($sql); 
	header('Location:'.JURI::base().'system-management-vic/raw-material-listing-vic/raw-material-updatelist-vic?cf_id='.$cf_id); 
}
 

if(isset($_POST['delete']))
{	
    $cf_id = $_POST['cf_id'];
	mysql_query("DELETE from ver_chronoforms_data_materials_vic WHERE cf_id = '$cf_id'")
				or die(mysql_error()); 
  	header('Location:'.JURI::base().'system-management-vic/raw-material-listing-vic');  
			
}
 
?>

<link rel="stylesheet" type="text/css" media="screen,projection" href="<?php echo JURI::base().'jscript/lightbox.css'; ?>" />
<link rel="stylesheet" type="text/css" media="screen,projection" href="<?php echo JURI::base().'jscript/jquery-ui-1.11.4/jquery-ui.css'; ?>" />  
<link rel="stylesheet" type="text/css" media="screen,projection" href="<?php echo JURI::base().'jscript/custom.css'; ?>" />
<link rel="stylesheet" type="text/css" media="screen,projection" href="<?php echo JURI::base().'jscript/system-maintenance.css'; ?>" />

<script src="<?php echo JURI::base().'jscript/jquery.min.js'; ?>"></script>
<script src="<?php echo JURI::base().'jscript/jquery-ui-1.11.4/jquery-ui.js'; ?>"></script> 
<script type="text/javascript" src="<?php echo JURI::base().'jscript/lightbox.js'; ?>"></script>
  
<form method="post"  enctype="multipart/form-data">
  <input type="hidden" value="<?php echo $cf_id; ?>" name="cf_id" />
  <table class="inventory-table" style="width:30%">
    <tr> 
      <th>Description</th> 
      <th>Cost</th> 
      <th>Supplier</th> 
    </tr>
    <tr> 
      <td class="desc"><input type="text" id="desc" name="raw_description" value="<?php echo $raw_description; ?>"></td> 
      <td class="rrp"><input type="text" id="rrp" name="raw_cost" value="<?php echo $raw_cost; ?>"></td>
      <td class="supplier"><input type="hidden" id="supplierid" name="supplierid" value="<?php echo $supplierid; ?>"></td>
    </tr>
  </table>
  <br/>
  
  <div id="postbtn" style="display:block; width:90%; margin-top:20px;">
    <input type="submit" value="Save" id="savebtn" name="save" class="update-btn">
    <input type="button" value="Cancel" id="cancelbtn" name="cancel" class="update-btn" onclick=location.href='<?php echo JURI::base().'system-management-vic/raw-material-listing-vic'; ?>' />
    <!--<input type="submit" value="Duplicate" id="dupebtn" name="duplicate" class="update-btn">-->
    <input type="submit" value="Delete" name="delete" class="update-btn">
  </div>
</form>

 <?php
    $qitem = mysql_query("SELECT * FROM ver_chronoforms_data_contract_items_default_deminsions WHERE inventoryid = '$InventoryID' ");
    $item=mysql_fetch_assoc($qitem);

?>


