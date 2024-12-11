<?php  
if(isset($_POST['add']))
{	
	$Colour_add=$_POST['colour'] ;
				


	mysql_query("INSERT INTO ver_chronoforms_data_colour_vic (colour) 
		 VALUES ('$Colour_add')");
			
	
	
	header('Location:'.JURI::base().'system-management-vic/colour-listing-vic');		
}

//if(isset($_POST['cancel']))
//{	
//	header('Location:'.JURI::base().'system-management-vic/colour-listing-vic');	
//}

?>

<form class="Chronoform hasValidation" method="post" id="chronoform_Colour_Vic" action="<?php echo JURI::base(); ?>system-management-vic/colour-listing-vic/colour-vic">
<table class="update-table">
   
	<tr>
		<td class="row1">Colour</td>
		<td class="row2"><input type="text" name="colour" value="<?php echo $Colour_add ?>"/></td>
	</tr>
	<tr>
		<td class="row1">&nbsp;</td>
		<td class="row2"><input type="submit" name="add" value="Save" class="update-btn" /> <input type="button" name="cancel" value="Cancel" class="update-btn" onclick=location.href='<?php echo JURI::base(); ?>system-management-vic/colour-listing-vic' /></td>
	</tr>
</table>

</form>