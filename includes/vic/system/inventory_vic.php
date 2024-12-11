<?php  
$next_increment = 0;
$qShowStatus = "SHOW TABLE STATUS LIKE 'ver_chronoforms_data_inventory_vic'";
$qShowStatusResult = mysql_query($qShowStatus) or die ( "Query failed: " . mysql_error() . "<br/>" . $qShowStatus );
$row = mysql_fetch_assoc($qShowStatusResult);
$next_increment = $row['Auto_increment'];
$getinventoryid = 'IRV'.$next_increment;
$_section = "";
$inventoryid="";

if(isset($_REQUEST['section'])){
  $_section = $_REQUEST['section'];
}
if(isset($_REQUEST['inventoryid'])){
  $inventoryid = $_REQUEST['inventoryid'];
}


$inv = null;

if(isset($_REQUEST['inventoryid'])){
  $inventoryid = mysql_real_escape_string($_REQUEST['inventoryid']);
   
  //error_log($_REQUEST['cf_id'], 3,'C:\\xampp\htdocs\\vergola_contract_system_v3\\my-error.log');
  $result = mysql_query("SELECT * FROM ver_chronoforms_data_inventory_vic WHERE inventoryid  = {$inventoryid} ");

  $retrieve = mysql_fetch_assoc($result);
  if (!$result) 
      {
      die("Error: Data not found..");
      } 
    $m = $retrieve;
}

if(isset($_POST['save']))
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
$cost = array_sum($total_cost);
$pic=($_FILES['photo']['name']); 
 
//Writes the information to the database 
mysql_query("INSERT INTO `ver_chronoforms_data_inventory_vic` (cf_id, inventoryid, section, category, description, photo, uom, rrp, cost) VALUES (NULL, '$getinventoryid', '$section', '$category', '$name', '$pic', '$uom', '$rrp', '$cost')") ; 
 
//Writes the photo to the server 
if(move_uploaded_file($_FILES['photo']['tmp_name'], $target)) 
{ 
 
//Tells you if its all ok 
echo "The file ". basename( $_FILES['uploadedfile']['name']). " has been uploaded, and your information has been added to the directory"; 
 } 
else { 
 
//Gives and error if its not 
echo "Sorry, there was a problem uploading your file."; 
 }
$rawdesc = implode(", ", $_POST['rawdesc']);
$cnt = count($_POST['rawcost']);
$cnt2 = count($_POST['rawdesc']); 


if ($cnt > 0 && $cnt == $cnt2 && $rawdesc != '') {
    $insertArr = array();
    
	for ($i=0; $i<$cnt; $i++) {

        $insertArr[] = "('$getinventoryid', '" . mysql_real_escape_string($_POST['rawdesc'][$i]) . "', '" . mysql_real_escape_string($_POST['rawcost'][$i]) . "')";
}


 $queryn = "INSERT INTO ver_chronoforms_data_materials_vic (inventoryid, raw_description, raw_cost) VALUES " . implode(", ", $insertArr);
 
 mysql_query($queryn) or trigger_error("Insert failed: " . mysql_error());

}
	
	header('Location:'.JURI::base().'system-management-vic/inventory-listing-vic');		
}

if(isset($_POST['cancel']))
{	
	header('Location:'.JURI::base().'system-management-vic/inventory-listing-vic');		
}

?>
<link rel="stylesheet" type="text/css" media="screen,projection" href="<?php echo JURI::base().'jscript/custom.css'; ?>" />
<link rel="stylesheet" type="text/css" media="screen,projection" href="<?php echo JURI::base().'jscript/system-maintenance.css'; ?>" />
<script src="<?php echo JURI::base().'jscript/jquery.min.js'; ?>"></script>
 
<SCRIPT language="javascript">
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

        function change_section(){
          var section = $("#section option:selected").val();
          var inventoryid = $("#inventoryid").val();

          location.href = "<?php echo JURI::base(); ?>system-management-vic/inventory-listing-vic/inventory-vic?inventoryid="+inventoryid+"&section="+section;
        }

</SCRIPT>

<form class="Chronoform hasValidation" method="post" id="chronoform_Inventory_Vic" action="<?php echo JURI::base(); ?>system-management-vic/inventory-listing-vic/inventory-vic" enctype="multipart/form-data">
  <input type='hidden' name='inventoryid' id='inventoryid' value='<?php echo $inventoryid; ?>' />
  <table class="inventory-table">
    <tr>
      <th>Section</th>
      <th>Categories</th>
      <th>Description</th>
      <th>UOM</th>
      <th>RRP Price</th>
      <th></th>
    </tr>
    <tr>
      <td class="sec"><select name="section" onchange="change_section();" id="section">
          <option value=""></option>
          <?php
           $sql = "SELECT * FROM ver_chronoforms_data_section_vic GROUP BY section ORDER BY section";
           $sql_result = mysql_query ($sql) or die ('request "Could not execute SQL query" '.$sql);
              while ($sect = mysql_fetch_assoc($sql_result)) {
				  
                echo "<option value='".$sect["section"]."'".($sect["section"]==$_section ? " selected" : "").">".$sect["section"]."</option>"; } ?>
        </select></td>

      <td class="cat">
          <select name="category" id="category">  
      <?php

          if(!empty($_section)){
              $sql = "SELECT * FROM ver_chronoforms_data_section_vic WHERE  section='{$_section}' GROUP BY category";
              //error_log($sql, 3,'C:\\xampp\htdocs\\vergola_contract_system_v3\\my-error.log');
              $qresult = mysql_query($sql);
              while ($d = mysql_fetch_assoc($qresult)) {
                echo "<option value='{$d['category']}' ".($category=="$d['category']"?"selected":"").">{$d['category']}</option>";
              }
          }
      ?> 
      
          </select>
      </td>
      
      <td class="desc"><input type="text" id="desc" name="name" value=""></td>
      <td class="uom"><input type="text" id="uom" name="uom" value=""></td>
      <td class="rrp" id="rrp"><input type="text" id="rrp" name="rrp" value=""></td>
    </tr>
  </table>
  <div id="matcontainer">
    <INPUT type="button" value="Add Raw Material" onclick="addRow('tbl-raw')" />
    <INPUT type="button" value="Delete Raw Material" onclick="deleteRow('tbl-raw')" />
    <table id="tbl-retrieve">
      <tr>
        <th><img src="<?php echo JURI::base()."images/trashcan_delete.png"; ?>" class="del" /></th>
        <th>Raw Materials</th>
        <th>Cost</th>
      </tr>
    </table>
    <table id="tbl-raw">
      <tr>
        <td class="tbl-chk"><input type="checkbox" name="chk"/></td>
        <td class="tbl-desc"><input type="text" id="rawdesc[]" name="rawdesc[]" value="" class="inpdesc"></td>
        <td class="tbl-cost"><input type="text" id="rawcost[]" name="rawcost[]" value="" class="inpcost"></td> 
      </tr>
    </table>
  </div>
  <div id="img-container">
  <h2>Image File</h2>
  <img src="<?php echo JURI::base().'images/vergola_inventory.png'; ?>" class="imgup"><br />
    <input type="file" id="uploadimg" name="photo" >
  </div>
  <div id="postbtn">
    <input type="submit" value="Save" id="savebtn" name="save" class="update-btn">
    <input type="submit" value="Cancel" id="cancelbtn" name="cancel" class="update-btn" onclick=location.href='<?php echo JURI::base().'system-management-vic/inventory-listing-vic'; ?>' />
  </div>
</form>
