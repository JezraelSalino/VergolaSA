<?php  
return;
$db = JFactory::getDbo();
$result = mysql_query("SELECT * FROM ver_chronoforms_data_systable_vic Where cf_id = '1'");
$retrieve = mysql_fetch_array($result);
if (!$result) 
		{
		die("Error: Data not found..");
		}
	$GST=$retrieve['gst'] ;
	$Commision=$retrieve['commision'];
	$SalesComm=$retrieve['sales_comm'] ;
	$InstallComm=$retrieve['install_comm'];
	
if(isset($_POST['cancel']))
{	
	header('Location:'.JURI::base());			
}

if(isset($_POST['update']))
{	
	$GST_update = $_POST['gst'];
	$Commision_update = $_POST['commision'];
	$SalesComm_update=$_POST['salescomm'] ;
	$InstallComm_update=$_POST['installcomm'];

	mysql_query("UPDATE ver_chronoforms_data_systable_vic SET gst = '$GST_update', commision = '$Commision_update', sales_comm = '$SalesComm_update', install_comm = '$InstallComm_update' WHERE cf_id = '1'")
				or die(mysql_error()); 
	header('Location:'.JURI::base().'system-management-vic/system-table-vic');
		
}

?>


<link rel="stylesheet" type="text/css" media="screen,projection" href="<?php echo JURI::base().'jscript/system-maintenance.css'; ?>" />
<form method="post">
<table class="update-table">
   
	<tr>
        <td class="row1">GST %</td>
		<td class="row2"><input type="text" id="gst" name="gst" value="<?php echo $GST; ?>"/></td>
	</tr>
		
	<tr>
        <td class="row1">Commision %</td>
		<td class="row2"><input type="text" id="commision" name="commision" value="<?php echo $Commision; ?>"/></td>
	</tr>
    <tr>
        <td class="row1">Sales Commision %</td>
		<td class="row2"><input type="text" id="salescomm" name="salescomm" value="<?php echo $SalesComm; ?>"/></td>
	</tr>
    <tr>
        <td class="row1">Installer Commision %</td>
		<td class="row2"><input type="text" id="installcomm" name="installcomm" value="<?php echo $InstallComm; ?>"/></td>
	</tr>
</table>
<input type="submit" value="Update" name="update" id="update" />
<input type="submit" value="Cancel" name="cancel" id="cancel" />
</form>