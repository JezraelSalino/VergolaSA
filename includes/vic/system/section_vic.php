<?php  
$next_increment = 0;
$qShowStatus = "SHOW TABLE STATUS LIKE 'ver_chronoforms_data_section_vic'";
$qShowStatusResult = mysql_query($qShowStatus) or die ( "Query failed: " . mysql_error() . "<br/>" . $qShowStatus );
$row = mysql_fetch_assoc($qShowStatusResult);
$next_increment = $row['Auto_increment'];
$getsectionid = 'SEC'.$next_increment;

if(isset($_POST['add']))
{	
$section = $_POST['section'];			 
$category = implode(", ", $_POST['category']);
$cnt = count($_POST['category']);

if ($cnt > 0) {
    $insertArr = array();
    
	for ($i=0; $i<$cnt; $i++) {

        $insertArr[] = "('$getsectionid', '$section', '" . mysql_real_escape_string($_POST['category'][$i]) . "')";
}


  $queryn = "INSERT INTO ver_chronoforms_data_section_vic (sectionid, section, category) VALUES " . implode(", ", $insertArr);
 
 mysql_query($queryn) or trigger_error("Insert failed: " . mysql_error());

}
		 
	header('Location:'.JURI::base().'system-management-vic/section-listing-vic');	
		
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


<form class="Chronoform hasValidation" method="post" id="chronoform_Section_Vic" action="<?php echo JURI::base(); ?>system-management-vic/section-listing-vic/section-vic">
<div class="left-section">
<h2>Section</h2>
<table class="update-table">
   
	<tr>
		<td class="row2"><input type="text" id="section" name="section" value="<?php echo $section; ?>"/></td>
	</tr>
		
	<tr>
		<td class="row2"><div class="btnclass">
<input type="submit" name="add" value="Save" class="update-btn" /> <input type="button" name="cancel" value="Cancel" class="update-btn" onclick=location.href='<?php echo JURI::base(); ?>system-management-vic/section-listing-vic' /></div></td>
	</tr>
</table>
</div>

<div class="right-section">
<h2>Category</h2>
<INPUT type="button" value="Add Category" onclick="addRow('tbl-draw')" />
<INPUT type="button" value="Delete Category" onclick="deleteRow('tbl-draw');deleteRow2('tbl-img')" />

        <table id="tbl-img">
         
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