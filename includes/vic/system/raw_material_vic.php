<?php  
// $next_increment = 0;
// $qShowStatus = "SHOW TABLE STATUS LIKE 'ver_chronoforms_data_inventory_vic'";
// $qShowStatusResult = mysql_query($qShowStatus) or die ( "Query failed: " . mysql_error() . "<br/>" . $qShowStatus );
// $row = mysql_fetch_assoc($qShowStatusResult);
// $next_increment = $row['Auto_increment'];
// $getinventoryid = 'IRV'.$next_increment;

$user = JFactory::getUser();
if(isset($user->groups['10']) || isset($user->groups['26']) || isset($user->groups['29'])){ //only admin group=10 and group=26(office user) are allowed to modify.
}else{
  echo "User permission is not allowed..";
}

$is_adding = 1;
$m = null;
$notification = "";

if(isset($_POST['delete']))
{ 
    $has_error = 0;
    //cf_id > 216646 is the start of the quotes created by the new system. 216646 and below is from old system access record.
    $cf_id= mysql_real_escape_string($_POST['cf_id']); 

    $sql = "SELECT COUNT(*) AS n FROM ver_chronoforms_data_inventory_material_vic AS im WHERE im.materialid={$cf_id}  ";
   // error_log($sql, 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_sa\\my-error.log'); return;
  $result = mysql_query($sql);  
  $d = mysql_fetch_assoc($result);

  if($d['n']>0){
    $has_error = 1;
    $notification = "Sorry, can't delete a linked raw material."; 
     
  }

   $sql = "SELECT COUNT(*) AS n FROM  ver_chronoforms_data_contract_bom_meterial_vic AS bm WHERE bm.materialid={$cf_id}";
   // error_log($sql, 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_sa\\my-error.log'); return;
  $result = mysql_query($sql);  
  $d = mysql_fetch_assoc($result);

  if($d['n']>0){
    $has_error = 1;
    $notification = "Sorry, can't delete a linked raw material."; 
     
  }
 

  if($has_error==0){
    $sql = 'DELETE FROM ver_chronoforms_data_materials_vic WHERE cf_id='.$cf_id;
    
    $result = mysql_query($sql); 
    header('Location:'.JURI::base().'system-management-vic/raw-material-listing-vic'); 
  }

}


if(isset($_POST['save_add']))
{ 
 
// $target = "images/"; 
//$target = $target . basename( $_FILES['photo']['name']); 

//This gets all the other information from the form 
//$section = $_POST['section'];
//$category = $_POST['category'];
$raw_description= mysql_real_escape_string($_POST['raw_description']); 
$raw_cost = mysql_real_escape_string($_POST['raw_cost']); 
$qty = mysql_real_escape_string($_POST['qty']); 
$uom=mysql_real_escape_string($_POST['uom']); 
$supplierid = mysql_real_escape_string($_POST['supplierid']);  
$is_main_item = 0;
if(isset($_POST['is_main_item']))
   $is_main_item = 1; 
$is_per_length = 0;
if(isset($_POST['is_per_length']))
$is_per_length = 1; 
//$rrp = $_POST['rrp'];
//$cost = $_POST['totalcost'] + array_sum($total_cost);
//$pic=$Photo; 
 
//Writes the information to the database 
//if($supplier_id !=$SupplierID) {
$sql = "INSERT `ver_chronoforms_data_materials_vic`(raw_description, raw_cost, qty, uom, supplierid, is_main_item, is_per_length) VALUES('$raw_description', '$raw_cost', '$qty', '$uom', '$supplierid', {$is_main_item}, {$is_per_length}); ";
//error_log($sql, 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_sa\\my-error.log');
mysql_query($sql); 

$cf_id = mysql_insert_id();
//header('Location:'.JURI::base().'system-management-vic/raw-material-listing-vic/raw-material?cf_id='.$cf_id); 
$notification = "Successfully saved..";
}

if(isset($_POST['save_update']))
{ 
 
// $target = "images/"; 
//$target = $target . basename( $_FILES['photo']['name']); 


 //This gets all the other information from the form 
//$section = $_POST['section'] ;
//$category = $_POST['category'];
$cf_id= mysql_real_escape_string($_POST['cf_id']); 
$raw_description= mysql_real_escape_string($_POST['raw_description']); 
$raw_cost = mysql_real_escape_string($_POST['raw_cost']); 
$qty = mysql_real_escape_string($_POST['qty']); 
$uom=mysql_real_escape_string($_POST['uom']); 
$supplierid = mysql_real_escape_string($_POST['supplierid']);
$is_main_item = 0;
if(isset($_POST['is_main_item']))
   $is_main_item = 1; 
 $is_per_length = 0;
if(isset($_POST['is_per_length']))
   $is_per_length = 1; 
//$rrp = $_POST['rrp'];
//$cost = $_POST['totalcost'] + array_sum($total_cost);
//$pic=$Photo; 
 
//Writes the information to the database 
//if($supplier_id !=$SupplierID) {
$sql = "UPDATE `ver_chronoforms_data_materials_vic` SET raw_description='{$raw_description}', raw_cost='{$raw_cost}', qty='{$qty}', uom='{$uom}', supplierid='{$supplierid}', is_main_item={$is_main_item}, is_per_length={$is_per_length} WHERE cf_id={$cf_id}; ";
//error_log($sql, 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_sa\\my-error.log');
mysql_query($sql); 

$notification = "Successfully saved..";
 
//header('Location:'.JURI::base().'system-management-vic/raw-material-listing-vic/raw-material?cf_id='.$cf_id); 

}



if(isset($_REQUEST['cf_id']) || isset($cf_id)){
  if($cf_id>0){

  }else{
    $cf_id = $_REQUEST['cf_id'];
  }
  
  $is_adding = 0;
  //error_log($_REQUEST['cf_id'], 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_sa\\my-error.log');
  $result = mysql_query("SELECT * FROM ver_chronoforms_data_materials_vic WHERE cf_id  = {$cf_id} ");

  $retrieve = mysql_fetch_assoc($result);
  if (!$result) 
      {
      die("Error: Data not found..");
      } 
    $m = $retrieve;

    //error_log(print_r($retrieve,true), 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_sa\\my-error.log');
    // Inventory Details
    //$cf_id = $retrieve['cf_id'];        
    // $InventoryID = $retrieve['inventoryid'] ;
    // $Section = $retrieve['section'] ;
    // $Category = $retrieve['category'] ;
    $raw_description = $retrieve['raw_description'];          
    // $UOM = $retrieve['uom'] ;
    // $RRP = $retrieve['rrp'] ;        
    $raw_cost = $retrieve['raw_cost'] ;
  //$Photo = $retrieve['photo'];
    //error_log(print_r($retrieve,true), 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_sa\\my-error.log');
}


 

?>

<link rel="stylesheet" type="text/css" media="screen,projection" href="<?php echo JURI::base().'jscript/lightbox.css'; ?>" />
<link rel="stylesheet" type="text/css" media="screen,projection" href="<?php echo JURI::base().'jscript/jquery-ui-1.11.4/jquery-ui.css'; ?>" />  
<link rel="stylesheet" type="text/css" media="screen,projection" href="<?php echo JURI::base().'jscript/custom.css'; ?>" />
<link rel="stylesheet" type="text/css" media="screen,projection" href="<?php echo JURI::base().'jscript/system-maintenance.css'; ?>" />

<script src="<?php echo JURI::base().'jscript/jquery.min.js'; ?>"></script>
<script src="<?php echo JURI::base().'jscript/jquery-ui-1.11.4/jquery-ui.js'; ?>"></script> 
<script type="text/javascript" src="<?php echo JURI::base().'jscript/lightbox.js'; ?>"></script>
 
<?php
$result = mysql_query("SELECT * FROM ver_chronoforms_data_supplier_vic ");  
$cbo_suppliers = "<select class='cbo_suppliers' style=' ' name='supplierid' >";
while ($row = mysql_fetch_assoc($result)) { 
  if($m){
      if($m['supplierid']==$row['supplierid']){
        $cbo_suppliers .= "<option value='{$row['supplierid']}' selected >{$row['company_name']}</option>";
        continue;
      }
  } 
    $cbo_suppliers .= "<option value='{$row['supplierid']}' >{$row['company_name']}</option>"; 
   
  
} 
$cbo_suppliers .="</select>";

?> 
<h2><?php if($is_adding) echo "Add"; ?> Raw Material</h2>
<?php if(strlen($notification)>0){echo "<div class='notification_result'>{$notification}</div>";} ?>
<form method="post"  enctype="multipart/form-data">
  <input type="hidden" name='cf_id' value="<?php echo $m['cf_id']; ?>" name="cf_id" />
  <table class="inventory-table" style="width:60%">
    <tr>
     
      <th width="20%">Description</th> 
      <th>UOM</th>
      <th>Qty</th>
      <th>Cost</th>
      <th width="20%">Supplier</th>
      <th width="11%">Main Material</th>
      <th width="11%">Multiply by Length</th>
    </tr>
    <tr> 
      <td class="desc"><input type="text" id="desc" name="raw_description" value="<?php echo htmlspecialchars($m['raw_description']); ?>"></td> 
      <td class="rrp">
          <select name="uom"> 
            <option value="Ea" <?php echo ($m['uom']=="Ea"?"selected":""); ?> >Ea</option>
            <option value="Mtrs" <?php echo ($m['uom']=="Mtrs"?"selected":""); ?> >Mtrs</option> 
            <option value="$" <?php echo ($m['uom']=="$"?"selected":""); ?> >$</option>
          </select>
      </td>
      <td class="rrp"><input type="text" id="rrp" name="qty" value="<?php echo $m['qty']; ?>"></td>
      <td class="rrp"><input type="text" id="rrp" name="raw_cost" value="<?php echo $m['raw_cost']; ?>"></td>
      <td class="rrp"><?php echo $cbo_suppliers; ?></td>
      <td class="rrp"><input type="checkbox"   name="is_main_item" value="1" <?php echo ($m['is_main_item']=="1"?"checked":""); ?> ></td>
      <td class="rrp"><input type="checkbox"   name="is_per_length" value="1" <?php echo ($m['is_per_length']=="1"?"checked":""); ?> ></td>
    </tr>
  </table>
  <br/>
   
  
  <div id="postbtn" style="display:block; width:90%; margin-top:20px;">
    <input type="submit" value="Save" id="savebtn" name="<?php echo ($is_adding?'save_add':'save_update'); ?>" class="update-btn">
    <input type="button" value="Cancel" id="cancelbtn" name="cancel" class="update-btn" onclick=location.href='<?php echo JURI::base().'system-management-vic/raw-material-listing-vic'; ?>' />
    <!--<input type="submit" value="Duplicate" id="dupebtn" name="duplicate" class="update-btn">-->
    <input type="submit" value="Delete" id="delbtn" name="delete" class="update-btn" onclick="return confirm('Are you sure you want to delete this item?');" >
  </div>
</form>


 <?php
    // $qitem = mysql_query("SELECT * FROM ver_chronoforms_data_contract_items_default_deminsions WHERE inventoryid = '$InventoryID' ");
    // $item=mysql_fetch_assoc($qitem);

?>
 
