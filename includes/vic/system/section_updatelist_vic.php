<?php  
$db = JFactory::getDbo();
$section_id =$_REQUEST['sectionid'];

$result = mysql_query("SELECT * FROM ver_chronoforms_data_section_vic WHERE sectionid  = '$section_id'");
$retrieve = mysql_fetch_array($result);
if (!$result) 
		{
		die("Error: Data not found..");
		}
	$Section=$retrieve['section'] ;
	$SectionID=$retrieve['sectionid'];
	$id=$retrieve['cf_id'];	
	
if(isset($_POST['add']))
{	
	$section = $_POST['section'];			 
    $category = implode(", ", $_POST['category']);
    $cnt = count($_POST['category']);


if ($cnt > 0 && $category!='') {
    $insertArr = array();
    
	for ($i=0; $i<$cnt; $i++) {

        $insertArr[] = "('$SectionID', '$section', '" . mysql_real_escape_string($_POST['category'][$i]) . "')";
}


  $queryn = "INSERT INTO ver_chronoforms_data_section_vic (sectionid, section, category) VALUES " . implode(", ", $insertArr);
 
 mysql_query($queryn) or trigger_error("Insert failed: " . mysql_error());

}


	
	header('Location:'.JURI::base().'system-management-vic/section-listing-vic');			
}

if(isset($_POST['delete']))
{	
    $category_id = $_POST['category_id'];
	mysql_query("DELETE from ver_chronoforms_data_section_vic WHERE cf_id = '$category_id'")
				or die(mysql_error()); 
	echo "Deleted";
	
			
}

if(isset($_POST['cancel']))
{	
	header('Location:'.JURI::base().'system-management-vic/section-listing-vic');			
}

if(isset($_POST['update']))
{	
	$categoryid = $_POST['category_id'];
	$category_retrieve = $_POST['category_update'];

	mysql_query("UPDATE ver_chronoforms_data_section_vic SET category ='$category_retrieve' WHERE cf_id = '$categoryid'")
				or die(mysql_error()); 
	echo "Saved!";
		
}

?>


<link rel="stylesheet" type="text/css" media="screen,projection" href="<?php echo JURI::base().'jscript/system-maintenance.css'; ?>" />
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
		
		function deleteRow2(tableID) {
            try {
            var table = document.getElementById(tableID);
            var rowCount = table.rows.length;
 
            for(var i=0; i<rowCount; i++) {
                var row = table.rows[i];
                var chkbox = row.cells[0].childNodes[0];
                if(null != chkbox && true == chkbox.checked) {
                    if(rowCount <= 0) {
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

<form method="post" >
<div class="left-section">
<h2>Section</h2>
<table class="update-table">
   
	<tr>
		<td class="row2"><input type="text" id="section" name="section" value="<?php echo $Section; ?>"/></td>
	</tr>
		
	<tr>
		<td class="row2"><div class="btnclass">
<input type="submit" name="add" value="Save" class="update-btn" /> <input type="button" name="cancel" value="Cancel" class="update-btn" onclick=location.href='<?php echo JURI::base(); ?>system-management-vic/section-listing-vic' />
</div></td>
	</tr>
</table>
</div>

<div class="right-section">
<h2>Category</h2>
<INPUT type="button" value="Add Category" onclick="addRow('tbl-draw')" />
<INPUT type="submit" class="del-section" name="delete" value="Delete Category" onclick="deleteRow('tbl-draw');deleteRow2('tbl-retrieve')" />

<input type="hidden" id="category_id" name="category_id" value=""/>
<input type="hidden" id="category_update" name="category_update" value=""/>

<table id="tbl-retrieve">
  
       <?php 
		   //Getting Categories
	$resultcat = mysql_query("SELECT category, cf_id FROM ver_chronoforms_data_section_vic WHERE sectionid = '$SectionID' ORDER BY category ASC");
	$j=0; $k=0;
	while ($recordcat = mysql_fetch_row($resultcat)) {
		
		echo "<tr><td class=\"tbl-chk\">
		
		<input type=\"checkbox\" name=\"chk\" onclick=\"document.getElementById('category_id').value='{$recordcat[1]}';\" /></td>
           <td class=\"tbl-chk\"><input type=\"text\" id=\"category_retrieve".$j++."\" name=\"category_retrieve\" value=\"{$recordcat[0]}\"/>
        </td>
		   <td><input type=\"submit\" id=\"update\" name=\"update\" value=\"Update\" class=\"update-btn\" onclick=\"document.getElementById('category_update').value=document.getElementById('category_retrieve".$k++."').value; document.getElementById('category_id').value='{$recordcat[1]}';\"/></td></tr>";
	}
	?>
            
          
      </table>
        <table id="tbl-draw">
        
          <tr>
          <td class="tbl-chk"><input type="checkbox" name="chk"/></td>
            <td class="tbl-chk">
            <input type="text" id="category" name="category[]" value="<?php echo $category; ?>"/></td>
          </tr>
        </table>
</div>
</form>