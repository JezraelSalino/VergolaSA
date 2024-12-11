<?php  
if(isset($_POST['add']))
{	
	$Zone_add=$_POST['zone'] ;
	$Cost_add=$_POST['cost'] ;
				


	mysql_query("INSERT INTO ver_chronoforms_data_travel_vic (zone,cost) 
		 VALUES ('$Zone_add','$Cost_add')");
			
	
	
	header('Location:'.JURI::base().'system-management-vic/travel-listing-vic');			
}

//if(isset($_POST['cancel']))
//{	
//	header("Location: index.php");			
//}

?>

<form class="Chronoform hasValidation" method="post" id="chronoform_Travel_Vic" action="<?php echo JURI::base(); ?>system-management-vic/travel-listing-vic/travel-vic">
<table class="update-table">
	<tr>
		<td class="row1">Zone</td>
		<td class="row2"><input type="text" name="zone" value="<?php echo $Zone_add ?>"/></td>
	</tr>
		<tr>
		<td class="row1">Cost</td>
		<td class="row2"><input type="text" name="cost" value="<?php echo $Cost_add ?>"/></td>
	</tr>
	
	<tr>
		<td class="row1">&nbsp;</td>
		<td class="row2"><input type="submit" name="add" value="Save" class="update-btn" /> <input type="button" name="cancel" value="Cancel" class="update-btn" onclick=location.href='<?php echo JURI::base(); ?>system-management-vic/travel-listing-vic' /></td>
	</tr>
</table>

</form>