<?php

$next_increment = 0;
$qShowStatus = "SHOW TABLE STATUS LIKE 'ver_chronoforms_data_inventory_vic'";
$qShowStatusResult = mysql_query($qShowStatus) or die ( "Query failed: " . mysql_error() . "<br/>" . $qShowStatus );
$row = mysql_fetch_assoc($qShowStatusResult);
$next_increment = $row['Auto_increment'];
$getinventoryid = 'IRV'.$next_increment;
$_section = ""; 
$is_adding = 0;
$has_error = 0;
$notification = "";

if(isset($_POST['delbtn']))
{ 
  //error_log("INSIDE cf_id: ".$_POST['cf_id'], 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_sa\\my-error.log');
  $id= mysql_real_escape_string($_POST['inventoryid']); 

  $sql = "SELECT COUNT(*) AS n FROM ver_vergola_default_framework_items  WHERE inventoryid='{$id}' ";
  //error_log( $sql, 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_sa\\my-error.log');  
  $result = mysql_query($sql); 
  $d = mysql_fetch_assoc($result);

  if($d['n']>0){
    $has_error = 1;
    $notification = "Sorry, can't delete a linked inventory item."; 
  }

  $sql = "SELECT COUNT(*) AS n FROM ver_chronoforms_data_quote_vic AS q  WHERE q.cf_id > 216646 AND q.inventoryid='{$id}' ";

  $result = mysql_query($sql); 
  $d = mysql_fetch_assoc($result);

  if($d['n']>0){
    $has_error = 1;
    $notification = "Sorry, can't delete a linked inventory item."; 
  }

  $sql = "SELECT COUNT(*) AS n FROM ver_chronoforms_data_contract_items_vic  WHERE  inventoryid='{$id}' ";
  $result = mysql_query($sql); 
  $d = mysql_fetch_assoc($result);

  if($d['n']>0){
    $has_error = 1;
    $notification = "Sorry, can't delete a linked inventory item."; 
  }


  if($has_error==0){
    mysql_query("DELETE from ver_chronoforms_data_inventory_material_vic WHERE inventoryid = '$id'")
          or die(mysql_error()); 
    echo "Deleted";
    
    mysql_query("DELETE from ver_chronoforms_data_inventory_vic WHERE inventoryid = '$id'")
          or die(mysql_error()); 
    echo "Deleted";
    header('Location:'.JURI::base().'system-management-vic/inventory-listing-vic'); 
  } 
    
      
}



if(isset($_POST['save']) || isset($_POST['save_new']))
{  

  if(isset($_POST['save_new'])){
     
  }else{
    $id = mysql_real_escape_string($_POST['inventoryid']);
    // $id = mysql_real_escape_string($_REQUEST['inventoryid']); 
  }

    $sql = "SELECT * FROM `ver_chronoforms_data_inventory_vic` WHERE inventoryid = '$id'";
    $result = mysql_query($sql);
    $row = mysql_fetch_assoc($result);
    //error_log("sql: ".$sql, 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_sa\\my-error.log');

    $target = "images/inventory/"; 
    $target = $target . basename( $_FILES['photo']['name']); 
 
    $total_cost = $_POST['rawcost']; 
     //This gets all the other information from the form 
    $section_save = $_POST['section'] ;
    $category_save = $_POST['category'];
    $name_save=$_POST['name']; 
    $uom_save = $_POST['uom'];
    $rrp_save = $_POST['rrp'];
    $hidefromcosting_save = $_POST['hide_from_costing'];
    $cost_save = $_POST['totalcost'] + array_sum($total_cost);
    if(strlen($_POST['cur_photo_name'])>0 && $row['photo']==$_POST['cur_photo_name']){
      $pic_save=$_POST['cur_photo_name'];
    }else{
      $pic_save=($_FILES['photo']['size'] > 0?$_FILES['photo']['name']:'');
    }
     
    //Updates the information to the database  
    if (isset($_POST['save'])) { 
      $sql = "UPDATE `ver_chronoforms_data_inventory_vic` SET   
        inventoryid = '$id',
        section ='$section_save', 
        category ='$category_save',  
        description ='$name_save', 
        photo ='$pic_save', 
        uom ='$uom_save',
        rrp ='$rrp_save', 
        hide_from_costing ='$hidefromcosting_save',
        cost ='$cost_save'         
        WHERE inventoryid = '$id'";
      
      mysql_query($sql) or die(mysql_error()); echo "Saved! #a"; 

    }

    if (isset($_POST['save_new'])) { 
      $next_increment = 0;
      $qShowStatus = "SHOW TABLE STATUS LIKE 'ver_chronoforms_data_inventory_vic'";
      $qShowStatusResult = mysql_query($qShowStatus) or die ( "Query failed: " . mysql_error() . "<br/>" . $qShowStatus );
      $row = mysql_fetch_assoc($qShowStatusResult);
      $next_increment = $row['Auto_increment'];
      $getinventoryid = 'IRV'.$next_increment;

      $section_save = $_POST['section'];
      $sql = "INSERT INTO `ver_chronoforms_data_inventory_vic`(inventoryid, section, category, description, photo, uom, rrp, hide_from_costing) VALUES('{$getinventoryid}', '{$section_save}', '{$category_save}', '{$name_save}', '{$pic_save}', '{$uom_save}', '{$rrp_save}', '{$hidefromcosting_save}')";
      
      mysql_query($sql) or die(mysql_error()); //echo "Saved! #0"; 
      
      $CFID = mysql_insert_id();
      $id = $getinventoryid;
      $InventoryID = $getinventoryid;
      $inventoryid = $getinventoryid;
    

    }

    // if ($_FILES['photo']['size']!= 0  && $Photo!="") { 
    //   $sql = "UPDATE `ver_chronoforms_data_inventory_vic` SET 
         
    //     inventoryid = '$id',
    //     section ='$section_save', 
    //     category ='$category_save', 
    //     description ='$name_save', 
    //     photo ='$pic_save', 
    //     uom ='$uom_save',
    //       rrp ='$rrp_save', 
    //     cost ='$cost_save'
         
    //     WHERE inventoryid = '$id'";
    //   //error_log($sql, 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_sa\\my-error.log'); 
    //   mysql_query($sql) or die(mysql_error()); echo "Saved! #1"; 
    // }else {
    //   $sql = "UPDATE `ver_chronoforms_data_inventory_vic` SET 
        
    //   inventoryid = '$id',
    //   section ='$section_save', 
    //   category ='$category_save', 
    //   description ='$name_save', 
    //   photo ='$Photo', 
    //   uom ='$uom_save',
    //     rrp ='$rrp_save', 
    //   cost ='$cost_save'
       
    //   WHERE inventoryid = '$id'";
    // // error_log("with ERROR: ".$sql, 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_sa\\my-error.log');
    //  mysql_query($sql);// or die(mysql_error()); echo "Saved! #2";
    // }

 
   //error_log(print_r($_FILES,true), 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_sa\\my-error.log');
    //Writes the photo to the server 
    if($_FILES['photo']['size']!= 0) 
    {  
      //Tells you if its all ok 
      //echo "The file ". basename( $_FILES['uploadedfile']['name']). " has been uploaded, and your information has been added to the directory"; 
      if(move_uploaded_file($_FILES['photo']['tmp_name'], $target)){
        //$notification = "The file ". basename( $_FILES['uploadedfile']['name']). " has been uploaded, and your information has been added to the directory";
      }else {  
        //Gives and error if its not 
        $notification = "Sorry, there was a problem uploading your file."; 
     } 
      //
    }

    //error_log(print_r($_POST,true), 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_sa\\my-error.log');
    $rawdesc = implode(", ", $_POST['rawdesc']);
    $cnt = count($_POST['raw_material_id']);
     
    $queryn = "DELETE FROM ver_chronoforms_data_inventory_material_vic WHERE inventoryid='{$id}' ";
    //error_log($queryn, 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_sa\\my-error.log');
    mysql_query($queryn);


    if ($cnt > 0) {
        $insertArr = array();
        
      for ($i=0; $i<$cnt; $i++) { 
            $insertArr[] = "('{$id}', '" . mysql_real_escape_string($_POST['raw_material_id'][$i]) . "')";
      }


     $queryn = "INSERT INTO ver_chronoforms_data_inventory_material_vic (inventoryid, materialid) VALUES " . implode(", ", $insertArr);
     // error_log($queryn, 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_sa\\my-error.log');
     mysql_query($queryn) or trigger_error("Insert failed: " . mysql_error());

     $notification = "Successfully saved..";
    }
  
  //header('Location:'.JURI::base().'system-management-vic/inventory-listing-vic/inventory-updatelist-vic?inventoryid='.$id);   
}
// Begin delete image function
if (isset($_POST['delete-pic'])) {
    $id = mysql_real_escape_string($_POST['inventoryid']);
    //if ($photo!='')
    //{      
      $sql = "UPDATE `ver_chronoforms_data_inventory_vic` SET           
        photo = ''
        WHERE inventoryid = '$id'";
      //error_log($sql, 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_us\\my-error.log');
      mysql_query($sql) or die(mysql_error()); $notification = "Image file has been deleted."; 
      //echo "Image file has been successfully Deleted!"; 


    //}else
}
// End delete image function
//error_log("ID2: ".$id, 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_sa\\my-error.log');


if(isset($_REQUEST['section'])){
  $_section = $_REQUEST['section'];
}

if(isset($_REQUEST['inventoryid']) && strlen($_REQUEST['inventoryid'])>0){
  //error_log("inside 1: ", 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_sa\\my-error.log');
  //view inventory item based on request
  $inventoryid = mysql_real_escape_string($_REQUEST['inventoryid']);
  $id = mysql_real_escape_string($_REQUEST['inventoryid']);
}else if(!empty($id)){
  //error_log("inside 2: ", 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_sa\\my-error.log');
  //view item after adding.
  $is_adding = 0;
}else{
  //error_log("inside 3: ", 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_sa\\my-error.log');
  $is_adding = 1;
  $Section = $_section;
}

//error_log("ID3: ".$id, 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_sa\\my-error.log');
//Get record for update inventory item..
if(!empty($id) && $is_adding==0){ 
  //error_log("here 1: ".$id, 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_sa\\my-error.log');
  if($inventoryid>0 || $id>0 ){

  }else{
    $cf_id = $_REQUEST['cf_id'];
  }
$sql = "SELECT * FROM ver_chronoforms_data_inventory_vic WHERE inventoryid  = '$id'";  
//error_log($sql, 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_sa\\my-error.log');
$result = mysql_query($sql);


$retrieve = mysql_fetch_array($result);
if (!$result) 
		{
		die("Error: Data not found..");
		}	
	
	// Inventory Details
	$CFID = $retrieve['cf_id'];				
	$InventoryID = $retrieve['inventoryid'];

	$Section = (empty($_section)?$retrieve['section']:$_section);
	$Category = $retrieve['category'] ;
	$Description = $retrieve['description'];					
	$UOM = $retrieve['uom'] ;
	$RRP = $retrieve['rrp'] ; 
  $HIDEFROMCOSTING = $retrieve['hide_from_costing'] ;
  $Cost = $retrieve['cost'] ;
	$Photo = $retrieve['photo'];

}else{
  //error_log("here 2: ".$id, 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_sa\\my-error.log');
}	

if(isset($_POST['duplicate']))
{	 
    $target = "images/"; 
    $target = $target . basename( $_FILES['photo']['name']); 

    $total_cost = $_POST['rawcost']; 
     //This gets all the other information from the form 
    $section = $_POST['section'] ;
    $category = $_POST['category'];
    $name=$_POST['name']; 
    $uom = $_POST['uom'];
    $rrp = $_POST['rrp'];
    $hidefromcosting = $_POST['hide_from_costing'];
    $cost = $_POST['totalcost'] + array_sum($total_cost);
    $pic=$Photo; 
     
    //Writes the information to the database 
    if($supplier_id !=$SupplierID) {

    mysql_query("INSERT INTO `ver_chronoforms_data_inventory_vic` (cf_id, inventoryid, section, category, description, photo, uom, rrp, hide_from_costing, cost) VALUES (NULL, '$id', '$section', '$category', '$name', '$pic', '$uom', '$rrp', '$hidefromcosting' , '$cost')") ; 

    $rawdesc_ret = implode(", ", $_POST['rawdesc_ret']);
    $cnt_ret = count($_POST['rawcost_ret']);
    $cnt2_ret = count($_POST['rawdesc_ret']);

     
    $rawdesc = implode(", ", $_POST['rawdesc']);
    $cnt = count($_POST['rawcost']);
    $cnt2 = count($_POST['rawdesc']);



    if ($cnt > 0 && $cnt == $cnt2 && $rawdesc != '') {
        $insertArr = array();
        
    	for ($i=0; $i<$cnt; $i++) {

            $insertArr[] = "('$id', '" . mysql_real_escape_string($_POST['rawdesc'][$i]) . "', '" . mysql_real_escape_string($_POST['rawcost'][$i]) . "')";
      }


     $queryn = "INSERT INTO ver_chronoforms_data_materials_vic (inventoryid, raw_description, raw_cost) VALUES " . implode(", ", $insertArr);

     mysql_query($queryn) or trigger_error("Insert failed: " . mysql_error()); }


    if ($cnt_ret > 0 && $cnt_ret == $cnt2_ret && $rawdesc_ret != '') {
        $insertArr_ret = array();
        
    	for ($i=0; $i<$cnt_ret; $i++) {

            $insertArr_ret[] = "('$id', '" . mysql_real_escape_string($_POST['rawdesc_ret'][$i]) . "', '" . mysql_real_escape_string($_POST['rawcost_ret'][$i]) . "')";
    }


     $queryn_ret = "INSERT INTO ver_chronoforms_data_materials_vic (inventoryid, raw_description, raw_cost) VALUES " . implode(", ", $insertArr_ret);
     
     mysql_query($queryn_ret) or trigger_error("Insert failed: " . mysql_error()); }

    }

    header('Location:'.JURI::base().'system-management-vic/inventory-listing-vic/inventory-updatelist-vic?inventoryid='.$id);	

}
 


if(isset($_POST['save_dimension']))
{ 
  $id = mysql_real_escape_string($_POST['id']);
  $inventoryid = mysql_real_escape_string($_POST['inventoryid']);
  $length = mysql_real_escape_string($_POST['length']);
  $dimension_a = mysql_real_escape_string($_POST['dimension_a']);
  $dimension_b = mysql_real_escape_string($_POST['dimension_b']);
  $dimension_c = mysql_real_escape_string($_POST['dimension_c']);
  $dimension_d = mysql_real_escape_string($_POST['dimension_d']);
  $dimension_e = mysql_real_escape_string($_POST['dimension_e']);
  $dimension_f = mysql_real_escape_string($_POST['dimension_f']);
  $dimension_p = mysql_real_escape_string($_POST['dimension_p']);

  if (isset($_POST['id']) && strlen($_POST['id']) > 0) {
   $queryn = "UPDATE ver_chronoforms_data_contract_items_default_deminsions SET length={$length}, dimension_a={$dimension_a} , dimension_b={$dimension_b} , dimension_c={$dimension_c},
               dimension_d={$dimension_d} ,dimension_e={$dimension_e} ,dimension_f={$dimension_f}, dimension_p={$dimension_p} WHERE id={$id} ";
  } else {
    $queryn = "INSERT INTO ver_chronoforms_data_contract_items_default_deminsions SET inventoryid='{$inventoryid}', length={$length}, dimension_a={$dimension_a} , dimension_b={$dimension_b} , dimension_c={$dimension_c},
               dimension_d={$dimension_d} ,dimension_e={$dimension_e} ,dimension_f={$dimension_f}, dimension_p={$dimension_p}";
  }
  
   mysql_query($queryn) or trigger_error("Insert failed: " . mysql_error());
   header('Location:'.JURI::base().'system-management-vic/inventory-listing-vic/inventory-updatelist-vic?inventoryid='.$inventoryid);
   //header('Content-Type: application/json'); 
   //$arr = array ('message'=>'successfully deleted','result'=>1);
   //echo json_encode($arr);
   // echo "1";
   // exit;
}



// if(isset($_POST['delete']))
// {	
//     $raw_id = $_POST['raw_id'];
// 	mysql_query("DELETE from ver_chronoforms_data_materials_vic WHERE cf_id = '$raw_id'")
// 				or die(mysql_error()); 
// 	echo "Deleted";
	
			
// }




if(isset($_POST['cancel']))
{	
	header('Location:'.JURI::base().'system-management-vic/inventory-listing-vic');			
}

// if(isset($_POST['update']))
// {	
    
// 	$rawid = $_POST['raw_id'];
// 	$rawdesc_retrieve = $_POST['rawdesc_update'];
// 	$rawcost_retrieve = $_POST['rawcost_update'];
// 	$total_raw = $_POST['rawcost_ret'];
// 	$total_rawcost = array_sum($total_raw);

// 	mysql_query("UPDATE ver_chronoforms_data_materials_vic SET raw_description = '$rawdesc_retrieve', raw_cost = '$rawcost_retrieve' WHERE cf_id = '$rawid'")
// 				or die(mysql_error()); 
// 	echo "Saved!";
	
// 	mysql_query("UPDATE ver_chronoforms_data_inventory_vic SET cost = '$total_rawcost' WHERE inventoryid = '$InventoryID'")
// 				or die(mysql_error()); 
// 	echo "Saved!";
		
// }

?>

<link rel="stylesheet" type="text/css" media="screen,projection" href="<?php echo JURI::base().'jscript/lightbox.css'; ?>" />
<link rel="stylesheet" type="text/css" media="screen,projection" href="<?php echo JURI::base().'jscript/jquery-ui-1.11.4/jquery-ui.css'; ?>" />  
<link rel="stylesheet" type="text/css" media="screen,projection" href="<?php echo JURI::base().'jscript/custom.css'; ?>" />
<link rel="stylesheet" type="text/css" media="screen,projection" href="<?php echo JURI::base().'jscript/system-maintenance.css'; ?>" />
<!--
<script src="<?php echo JURI::base().'jscript/jsapi.js'; ?>"></script>
<script src="<?php echo JURI::base().'jscript/jquery.min.js'; ?>"></script>
<script src="<?php echo JURI::base().'jscript/jquery-ui.min.js'; ?>" type="text/javascript"></script>
<link rel="stylesheet" type="text/css" media="screen,projection" href="<?php echo JURI::base().'jscript/custom.css'; ?>" />
-->

<script src="<?php echo JURI::base().'jscript/jquery.min.js'; ?>"></script>
<script src="<?php echo JURI::base().'jscript/jquery-ui-1.11.4/jquery-ui.js'; ?>"></script> 
<script type="text/javascript" src="<?php echo JURI::base().'jscript/lightbox.js'; ?>"></script>
<SCRIPT language="javascript">

 function change_section(){
      var section = $("#section option:selected").val();
      var inventoryid = $("#inventoryid").val();
      var inv_param = "";
      if(inventoryid.length>0){
        inv_param = "&inventoryid="+inventoryid;
      }

      location.href = "<?php echo JURI::base(); ?>system-management-vic/inventory-listing-vic/inventory-updatelist-vic?section="+section+inv_param;
  }


function showdrop()
{
     var section=$("#section").val();   // get the value of currently selected section
     $.ajax({
    type:"post",
    dataType:"text",
    data:"section="+section,
    url:"<?php echo JURI::base().'includes/vic/category_vic.php'; ?>",         // page to which the ajax request is passed
    success:function(response)
    {
             $("#category").html(response);   // set the result to category dropdown
     $("#category").show();
    }
})


}
 

  function addRow(tableID) {

      var table = document.getElementById(tableID);

      var rowCount = table.rows.length;
      var row = table.insertRow(rowCount);

      var colCount = table.rows[0].cells.length;

      for(var i=0; i<colCount; i++) {

          var newcell = row.insertCell(i);

          newcell.innerHTML = table.rows[0].cells[i].innerHTML;
          //alert(newcell.childNodes);
          switch(newcell.childNodes[0].type) {
              case "text":
                      newcell.childNodes[0].value = "";
                      break;
              case "checkbox":
                      newcell.childNodes[0].checked = false;
                      break;
              case "select-one":
                      newcell.childNodes[0].selectedIndex = 0;
                      break;
          }
      }
  }

  function deleteRow(tableID) {
      try {
      var table = document.getElementById(tableID);
      var rowCount = table.rows.length;

      for(var i=0; i<rowCount; i++) {
          var row = table.rows[i];

          var chkbox = row.cells[0].childNodes[0];
          if(null != chkbox && true == chkbox.checked) {
              if(rowCount <= 1) {
                  alert("Cannot delete all the rows.");
                  break;
              }
              table.deleteRow(i);
              rowCount--;
              i--;
          }


      }
      }catch(e) {
          alert(e);
      }
  }
 

</SCRIPT>
<h2><?php if($is_adding) echo "Add";  ?> Inventory</h2>
<?php if(strlen($notification)>0){echo "<div class='notification_result'>{$notification}</div>";} ?>
<div id="notification" class="notification_box hide"  ></div>
<form method="post"  enctype="multipart/form-data">
  <input type='hidden' name='inventoryid' id='inventoryid' value='<?php echo $inventoryid; ?>' />
  <input type='hidden' name='cf_id' id='cf_id' value='<?php echo $CFID; ?>' />
  <table class="inventory-table">
    <tr>
      <th>Section</th>
      <th>Categories</th>
      <th>Description</th>
      <th>UOM</th>
      <th width="100">RRP Price</th>
      <th width="11%">Hide from Costing</th>
      <th></th>
    </tr>
    <tr>
      <td class="sec">
        <select name="section" onchange="change_section()" id="section">
          <option value=""></option>
          <?php
           $sql = "SELECT * FROM ver_chronoforms_data_section_vic GROUP BY section ORDER BY section";
           $sql_result = mysql_query ($sql) or die ('request "Could not execute SQL query" '.$sql);
              while ($sect = mysql_fetch_assoc($sql_result)) { 
                echo "<option value='".$sect["section"]."'".($sect["section"]==$Section ? " selected='selected'" : "").">".$sect["section"]."</option>"; } ?>
        </select>
      </td>
      <td class="cat">
        <select name="category" id="category">
          <?php 
           $sql = "SELECT * FROM ver_chronoforms_data_section_vic WHERE section='{$Section}' ORDER BY category";
           $sql_result = mysql_query ($sql) or die ('request "Could not execute SQL query" '.$sql);
              while ($cat = mysql_fetch_assoc($sql_result)) { 
                echo "<option value='".$cat["category"]."'".($cat["category"]==$Category ? " selected='selected'" : "").">".$cat["category"]."</option>"; } 
          ?>
        </select></td>
      <td class="desc"><input type="text" id="desc" name="name" value="<?php echo htmlspecialchars($Description); ?>"></td>
      <td class="uom"><select name="uom"> <option value="Ea" <?php echo ($UOM=="Ea"?"selected":""); ?> >Ea</option><option value="Mtrs" <?php echo ($UOM=="Mtrs"?"selected":""); ?>>Mtrs</option></select> </td>
      <td class="rrp"><input type="text" id="rrp" name="rrp" value="<?php echo $RRP; ?>"></td>
      <td class="rrp"><input type="checkbox" style="margin-left: 15px;" name="hide_from_costing" value="1" <?php echo ($HIDEFROMCOSTING=="1"?"checked":""); ?> ></td>
    </tr>
  </table>
  <div id="matcontainer">
    
   <?php
    $qitem = mysql_query("SELECT * FROM ver_chronoforms_data_inventory_vic WHERE inventoryid = '$InventoryID' ");
    $inv_item=mysql_fetch_assoc($qitem);
    //error_log(print_r($inv_item,true), 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_sa\\my-error.log');
    if($inv_item["section"]=="Guttering" || $inv_item["section"]=="Flashings"){
    ?>
      <INPUT type="button" class="del-section" name="set_dimension" value="Set default dimension" onclick="$('#default_dimension_box').dialog({
        minWidth: 600,maxWidth: 900,
      });$('#default_dimension_box').dialog();" />
    <?php
    } 
    ?>

     
   
    
<!-- <input type="hidden" id="raw_id" name="raw_id" value=""/>
<input type="hidden" id="rawdesc_update" name="rawdesc_update" value=""/>
<input type="hidden" id="rawcost_update" name="rawcost_update" value=""/> -->
<input type="hidden" name="inventory_id" value="<?php echo $InventoryID; ?>"/>

    <table id="tbl-retrieve">
    <tr>
        <th  ><img src="<?php echo JURI::base()."images/trashcan_delete.png"; ?>" class="del" /> Raw Materials</th> 
        <th  ><span style="margin:0;">Qty</span></th> 
        <th  ><span style="margin:0;">Cost</span></th> 
      </tr>
          <?php

$qry = "SELECT ms.id, ms.inventoryid,ms.materialid, m.supplierid, m.raw_description, m.qty, m.raw_cost, s.company_name FROM ver_chronoforms_data_inventory_material_vic AS ms  LEFT JOIN ver_chronoforms_data_materials_vic AS m ON m.cf_id=materialid LEFT JOIN ver_chronoforms_data_supplier_vic AS s ON m.supplierid=s.supplierid WHERE ms.inventoryid = '$InventoryID'   ";          
//error_log($qry, 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_sa\\my-error.log');
$resultmat = mysql_query($qry);
if (!$resultmat) {
    echo 'Could not run query: ' . mysql_error();
    exit;
}
  $j=0; $k=0; $l=0; $m=0;
  while($row = mysql_fetch_assoc($resultmat))
	{

echo '<tr>      
	  <td class="tbl-desc"><input type="text" id="rawdesc_ret'.$j++.'" name="rawdesc_ret[]" value="'.htmlspecialchars($row['raw_description']).'" readonly /> <input type="hidden" name="raw_material_id[]" value="'.$row["materialid"].'" /> <input type="hidden" name="supplier_id[]" value="'.$row["supplierid"].'" /></td>';

	  echo "<td class=\"tbl-qty\"><input type=\"text\" style=\"margin-left:10px; width:80px;\" id=\"rawqty_ret".$l++."\" name=\"rawqty_ret[]\" value=\"{$row['qty']}\" readonly /></td>
    <td class=\"tbl-cost\"><input type=\"text\" id=\"rawcost_ret".$l++."\" name=\"rawcost_ret[]\" value=\"{$row['raw_cost']}\" readonly /></td>
    <td class=\"tbl-desc\" style=\"display:none;\"><input type=\"text\" id=\"rawcost_ret".$l++."\" name=\"rawcost_ret[]\" value=\"".$row['company_name']."\" style=\"width:240px; padding:3px; margin:0 0 0 10px;\" readonly /></td>
	  <td class=\"btnupdate\">  <INPUT type=\"button\" value=\"Delete\" onclick=\"remove_raw_meterial(event,this)\" style=\"margin:0 0 0 5px;\" /></td>	  
	  </tr>";
	}
?>
</table>

<?php
   
  $result = mysql_query("SELECT * FROM ver_chronoforms_data_supplier_vic ");
    
  $suppliers = array();
  $cbo_suppliers = '<select id=\"suppliers\" style=\"padding:3px; margin:0 0 0 10px;\" >';
  while ($row = mysql_fetch_assoc($result)) { 
      $cbo_suppliers .= '<option value=\"'.$row['supplierid'].' >'.$row['company_name'].'</option>'; 
  } 
  $cbo_suppliers .='</select>';
   

  //error_log(print_r($raw_materials,true), 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_sa\\my-error.log');
 
?>


    <table id="tbl-raw" style="margin-top:15px;">
      <tr>
        <td><span style="  margin:0 0 0 12px; font-weight:bold;">Add Raw Matrial</span></td>
        <td></td>
        <td></td>
        <td></td>
      </tr>
      <tr>
       
        <td class="tbl-desc"><input type="text" id="raw_desc" name="raw_desc" value="" style="width:240px; margin:0 0 0 12px;"  placeholder="Type raw material"  > <input type="hidden" id="raw_material_id" name="" value=""   > </td>
        <td class=" "><input type="text" id="raw_qty" name="raw_qty" value="" class=" " style="width: 80px; margin-left: 12px;"> </td>
        <td class=" "><input type="text" id="raw_cost" name="raw_cost" value="" class=" " style="width: 80px; margin-left: 12px;"> </td> 

        <td class="tbl-add" style="">

            <INPUT type="button" value="Add Raw Material" onclick="add_raw_meterial(event,this)" style="margin:0 0 0 10px;" />
            
        </td>
      </tr>
      <tr>
        
        <td class="tbl-desc" style="text-align:right; padding: 8px;"> <span style="font-size:14px; font-weight:bold; margin-top:5px;">Total Cost :</span></td>
        <td class=" " style="text-align:left;"><span id="lbl_total_cost"  style="font-size:14px; font-weight:bold; margin-left:15px;"></span> </td>
        <td class="tbl-add" style=""> </td>
        <td class="tbl-add" style=""> </td>
      </tr>
    </table>
  </div>

 <!--  <div class="sum">
  </div> -->
  <div id="img-container">
  <h2>Image File</h2>
  <?php 
  if ($Photo!='') {
  echo "
  <img src='".JURI::base()."images/inventory/".$Photo."' class='imgup' />
  ";
  } else { echo "<img src=".JURI::base()."images/vergola_inventory.png"." "."class='imgup'>";}?>
  <!-- Begin Code for deleting the picture -->
  <INPUT type="submit" name="delete-pic" value="Delete Picture"   />
  <input type="hidden" value="" id="picid" name="picid" />
  <!-- End Code for deleting the picture -->
  <br />
    <input type="file" id="uploadimg" name="photo"  >
    <input type="hidden"   name="cur_photo_name" value="<?php echo $inv_item['photo']; ?>" >
    
  </div>
  <div id="postbtn">
    <input type="submit" value="Save" id="savebtn" name="<?php echo ($is_adding?"save_new":"save"); ?>" class="update-btn">
    <input type="submit" value="Cancel" id="cancelbtn" name="cancel" class="update-btn" onclick=location.href='<?php echo JURI::base().'system-management-vic/inventory-listing-vic'; ?>' />
    <!--<input type="submit" value="Duplicate" id="dupebtn" name="duplicate" class="update-btn">-->
    <input type="submit" value="Delete" id="delbtn" name="delbtn" class="update-btn" onclick="return confirm('Are you sure you want to delete this item?');" >
  </div>
</form>


 <?php
    $qitem = mysql_query("SELECT * FROM ver_chronoforms_data_contract_items_default_deminsions WHERE inventoryid = '$InventoryID' ");
    $item=mysql_fetch_assoc($qitem);

?>

<div id="default_dimension_box" style="display:none; width:100%;" title="Default Dimension">
<form method="post" id="default_dimension_form" enctype="multipart/form-data">

  <table style="margin:5px 0 10px 0;">
  <tr><th> </th><th>A</th><th>B</th><th>C</th><th>D</th><th>E</th><th>F</th><th>P</th></tr>
  <tr>
      <td>
        <?php
          $default_dimension_length = 0;
          if (isset($item["length"]) && is_numeric($item["length"])) {
            $default_dimension_length = $item["length"];
          }
          echo "<input type='hidden' value='{$item["id"]}' name='id' />";
          echo "<input type='hidden' value='{$InventoryID}' name='inventoryid' />";
          echo "<input type='hidden' value='{$default_dimension_length}' name='length' />";
          echo "<!-- <input type='text' name='length' value='{$item["length"]}' style='display:none;' /> --></td>
                    <td><input type='text' name='dimension_a' value='{$item["dimension_a"]}' /></td>
                    <td><input type='text' name='dimension_b' value='{$item["dimension_b"]}' /></td>
                    <td><input type='text' name='dimension_c' value='{$item["dimension_c"]}' /></td>
                    <td><input type='text' name='dimension_d' value='{$item["dimension_d"]}' /></td>
                    <td><input type='text' name='dimension_e' value='{$item["dimension_e"]}' /></td>
                    <td><input type='text' name='dimension_f' value='{$item["dimension_f"]}' /></td>
                    <td><input type='text' name='dimension_p' value='{$item["dimension_p"]}' /></td>
                ";
        ?>
      </tr>  
  </table>
  <input type='submit' value='Save' name="save_dimension"   />
  <input type='button' value='Cancel' onclick="$(this).closest('.ui-dialog-content').dialog( 'close' );" />
</form>

<script type="text/javascript">
  <?php
    $result = mysql_query("SELECT cf_id, raw_description, qty, raw_cost FROM ver_chronoforms_data_materials_vic ");
    
    $materials = array();
    while ($row = mysql_fetch_assoc($result)) {
    
        // Adding the necessary "value" and "label" fields and appending to result set
        $row_array['value'] = $row['raw_description'];
        $row_array['label'] = $row['raw_description'];
        $row_array['cf_id'] = $row['cf_id'];  
        $row_array['raw_description'] = $row['raw_description'];
        $row_array['raw_qty'] = $row['qty'];
        $row_array['raw_cost'] = $row['raw_cost'];

        array_push($materials,$row_array);
        
    } 
    //error_log(print_r($materials,true), 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_sa\\my-error.log');
    // Truncate, encode and return the results
    //$matches = array_slice($matches, 0, 5);
    echo "var materials = ".json_encode($materials);


  ?>

  $(document).ready(function(){  
       $("#raw_desc").val("");
        $("#raw_cost").val("");

       var client_config = {
      source: materials,
        select: function(event, ui){
            
            $("#raw_material_id").val(ui.item.cf_id);
            $("#raw_desc").val(ui.item.raw_description);
            $("#raw_qty").val(ui.item.raw_qty);
            $("#raw_cost").val(ui.item.raw_cost);
        //     $("#csuburbpostcode").val(ui.item.suburb_postcode);
        // $("#csuburb_id").val(ui.item.cf_id);  
        },
        minLength:1
      };
      
       $("#raw_desc").autocomplete(client_config);
      
      //recompute the total cost.
      var total_cost = 0.00; var qty = 0; var cost=0;
      $(".tbl-cost input").each(function(){
          qty = parseFloat($(this).parent().parent().children('.tbl-qty').children('input').val());
          cost = parseFloat($(this).val()); 
          total_cost += qty * cost; 
      });

      $("#lbl_total_cost").html(total_cost.toFixed(2));

   });

   


   function setDefaultDimension(){
    //event.preventDefault();
     
    var action = $(this).closest('form').attr('action');
    //var action = "<?php echo JURI::base(); ?>";   
    var iData = $(this).closest('form').serialize(); 
     
    //var id = $(o).closest('form').children("table").children("tbody").children("tr").find("input.cf_id").val();
    $(this).closest('form').children("table").children("tbody").children("tr").find("input.cf_id").val();
    var id = $(this).closest('form').children("table").children("tbody").children("tr").find("input.cf_id").val();//children("input.cf_id").val();
    //alert(id); return;
    //console.log(iData);return; 
     
    $.ajax({
      type: "POST",
      url: action,
      dataType: 'json',   
      data: iData,  
      success: function(data) {         
        // alert(data); 
        // if(data["success"]==1){
        //   $(this).dialog("close");
        // }else{
        //   alert("Error while saving");
        // }
      }   
    });    


   }


   function add_raw_meterial(event,o){
    event.preventDefault();
    var tr="";
    var raw_description = $("#raw_desc").val();
    var raw_material_id =  $("#raw_material_id").val();

    if(raw_description.length<1 && raw_material_id.length<1){
        //notification_body

        $("#notification").html("Please choose a raw material in the dropdown list.");   
          //$("#notification").appendTo("."+dataClass+" .notification-area");
          $("#notification").removeClass('hide');  
          $("#notification").show(); 
          setTimeout(function() {
                $( "#notification" ).hide( "slow" );
          }, 7000);

          
          $("#raw_desc").css({ "border-color": "red"});
          $("#raw_desc").one("change",function(){ $(this).css({ "border-color": "#4d4c4c"}); });
          $("#raw_desc").focus(); 
          return;
    }

    var raw_qty = $("#raw_qty").val();
    var raw_cost = $("#raw_cost").val();
    var supplier_name = $("#suppliers option:selected").text();
    //var supplier_id = $("#suppliers option:selected").val();

    tr = "<tr><td class='tbl-desc'><input type='text' value='"+raw_description+"' /><input type='hidden' value='"+raw_material_id+"' name='raw_material_id[]' /> <td class='tbl-qty'><input type='text'style='margin-left:10px; width:80px;' value='"+raw_qty+"' /> </td> <td class='tbl-cost'><input type='text' value='"+raw_cost+"' /> </td><td><input type='button' value='Delete' onclick='remove_raw_meterial(event,this)' style='margin:0 0 0 5px;' /></td> </tr>";

    $("#tbl-retrieve tr:last").after(tr);

    $("#raw_desc").val("");
    $("#raw_material_id").val("");
    $("#raw_qty").val("");
    $("#raw_cost").val("");

    var total_cost = 0.00; var qty = 0; var cost=0;
    $(".tbl-cost input").each(function(){
        qty = parseFloat($(this).parent().parent().children('.tbl-qty').children('input').val());
        cost = parseFloat($(this).val());  
        total_cost +=  qty*cost; 
    });


    $("#lbl_total_cost").html(total_cost.toFixed(2));

    if($("#section option:selected").val()=="Disbursements" || $("#section option:selected").val()=="Extras" || $("#section option:selected").val()=="Misc"){

    }else{
      total_cost = total_cost*2; 
    }
    
    $("#rrp").val(total_cost.toFixed(2));
    
    
    

   }


   function remove_raw_meterial(event,o){
      
     // alert($(o).closest('tr').html());
      $(o).closest('tr').remove();

      var total_cost = 0.00;
      $(".tbl-cost input").each(function(){
          total_cost += parseFloat($(this).val()); 
      });
      $("#lbl_total_cost").html(total_cost.toFixed(2));
      
      if($("#section option:selected").val()=="Disbursements"){

      }else{
        total_cost = total_cost*2; 
      }
      
      $("#rrp").val(total_cost.toFixed(2));

   } 



  //alert("here");

</script>
</div>

 
