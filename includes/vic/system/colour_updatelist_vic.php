<?php  
$db = JFactory::getDbo();
$id =$_REQUEST['cf_id'];

$result = mysql_query("SELECT * FROM ver_chronoforms_data_colour_vic WHERE cf_id  = '$id'");
$retrieve = mysql_fetch_array($result);
if (!$result) 
		{
		die("Error: Data not found..");
		}
	$Colour=$retrieve['colour'] ;


if(isset($_POST['save']))
{	
	$colour_save = $_POST['colour'];



	mysql_query("UPDATE ver_chronoforms_data_colour_vic SET colour ='$colour_save' WHERE cf_id = '$id'")
				or die(mysql_error()); 
	echo "Saved!";
	
	header('Location:'.JURI::base().'system-management-vic/colour-listing-vic');			
}

if(isset($_POST['delete']))
{	

	mysql_query("DELETE from ver_chronoforms_data_colour_vic WHERE cf_id = '$id'")
				or die(mysql_error()); 
	echo "Deleted";
	
	header('Location:'.JURI::base().'system-management-vic/colour-listing-vic');			
}

if(isset($_POST['cancel']))
{	
	header('Location:'.JURI::base().'system-management-vic/colour-listing-vic');			
}

?>
<form method="post">
<table class="update-table">
	<tr>
		<td class="row1">Colour</td>
		<td class="row2"><input type="text" name="colour" value="<?php echo $Colour ?>"/></td>
	</tr>
	
	<tr>
		<td class="row1">&nbsp;</td>
		<td class="row2"><input type="submit" name="save" value="Save" class="update-btn" /> <input type="submit" name="delete" value="Delete" class="update-btn" /> <input type="submit" name="cancel" value="Cancel" class="update-btn" /></td>
	</tr>
</table>