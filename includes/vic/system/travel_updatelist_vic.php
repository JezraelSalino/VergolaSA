<?php  
$db = JFactory::getDbo();
$id =$_REQUEST['cf_id'];

$result = mysql_query("SELECT * FROM ver_chronoforms_data_travel_vic WHERE cf_id  = '$id'");
$retrieve = mysql_fetch_array($result);
if (!$result) 
		{
		die("Error: Data not found..");
		}
	$Zone=$retrieve['zone'] ;
	$Cost=$retrieve['cost'] ;
				

if(isset($_POST['save']))
{	
	$zone_save = $_POST['zone'];
	$cost_save = $_POST['cost'];



	mysql_query("UPDATE ver_chronoforms_data_travel_vic SET zone ='$zone_save', cost ='$cost_save' WHERE cf_id = '$id'")
				or die(mysql_error()); 
	echo "Saved!";
	
	header('Location:'.JURI::base().'system-management-vic/travel-listing-vic');		
}

if(isset($_POST['delete']))
{	

	mysql_query("DELETE from ver_chronoforms_data_travel_vic WHERE cf_id = '$id'")
				or die(mysql_error()); 
	echo "Deleted";
	
	header('Location:'.JURI::base().'system-management-vic/travel-listing-vic');		
}

if(isset($_POST['cancel']))
{	
	header('Location:'.JURI::base().'system-management-vic/travel-listing-vic');			
}

?>
<form method="post">
<table class="update-table">
    <tr>
		<td class="row1">Zone</td>
		<td class="row2"><input type="text" name="zone" value="<?php echo $Zone ?>"/></td>
	</tr>
	 <tr>
		<td class="row1">Cost</td>
		<td class="row2"><input type="text" name="cost" value="<?php echo $Cost ?>"/></td>
	</tr>

	<tr>
		<td class="row1">&nbsp;</td>
		<td class="row2"><input type="submit" name="save" value="Save" class="update-btn" /> <input type="submit" name="delete" value="Delete" class="update-btn" /> <input type="submit" name="cancel" value="Cancel" class="update-btn" /></td>
	</tr>
</table>