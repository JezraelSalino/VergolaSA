<?php  
if(isset($_POST['add']))
{	
	$Lead_add=$_POST['lead'] ;
				


	mysql_query("INSERT INTO ver_chronoforms_data_lead_vic (lead) 
		 VALUES ('$Lead_add')");
			
	
	
	header('Location:'.JURI::base().'system-management-vic/lead-listing-vic');		
}

//if(isset($_POST['cancel']))
//{	
//	header('Location:'.JURI::base().'system-management-vic/lead-listing-vic');	
//}

?>

<form class="Chronoform hasValidation" method="post" id="chronoform_Lead_Vic" action="<?php echo JURI::base(); ?>system-management-vic/lead-listing-vic/lead-vic">
<table class="update-table">
   
	<tr>
		<td class="row1">Lead Source</td>
		<td class="row2"><input type="text" name="lead" value="<?php echo $Lead_add ?>"/></td>
	</tr>
	<tr>
		<td class="row1">&nbsp;</td>
		<td class="row2"><input type="submit" name="add" value="Save" class="update-btn" /> <input type="button" name="cancel" value="Cancel" class="update-btn" onclick=location.href='<?php echo JURI::base(); ?>system-management-vic/lead-listing-vic' /></td>
	</tr>
</table>

</form>