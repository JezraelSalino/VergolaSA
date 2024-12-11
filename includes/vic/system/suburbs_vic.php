<?php  
if(isset($_POST['add']))
{	
	$State_add=$_POST['suburb_state'] ;
	$Postcode_add=$_POST['suburb_postcode'];					
	$District_add=$_POST['suburb_district'] ;
	$Suburb_add=$_POST['suburb'] ;

	mysql_query("INSERT INTO ver_chronoforms_data_suburbs_vic (suburb_state, suburb_postcode, suburb_district, suburb) 
		 VALUES ('$State_add', '$Postcode_add', '$District_add', '$Suburb_add')");
			
	
	
	header('Location:'.JURI::base().'system-management-vic/suburb-listing-vic');		
}

//if(isset($_POST['cancel']))
//{	
//	header('Location:'.JURI::base().'system-management-vic/suburb-listing-vic');	
//}

?>

<form class="Chronoform hasValidation" method="post" id="chronoform_Suburbs_Vic" action="<?php echo JURI::base(); ?>system-management-vic/suburb-listing-vic/suburbs-vic">
<table class="update-table">
    <tr>
		<td class="row1">District</td>
		<td class="row2">
		<?php
 
$querysub="SELECT suburb_district, suburb_state FROM ver_chronoforms_data_suburbs_vic ORDER BY suburb_district ASC";
$resultsub = mysql_query($querysub);
if(!$resultsub){die ("Could not query the database: <br />" . mysql_error());}
 //create selection list				
	while($row = mysql_fetch_row($resultsub))
	{
		$heading = $row[0];	
		$StateArrayPhp .= 'StateArray["'.$heading.'"]="'.$row[1].'";';


	}
	
echo "<select class='suburb-list' id='suburblist' name='suburb_district' onchange='javascript:SelectChanged();'>";
            $querysub2="SELECT suburb_district, suburb_state FROM ver_chronoforms_data_suburbs_vic GROUP by suburb_district";
            $resultsub2 = mysql_query($querysub2);
            if(!$resultsub2){die ("Could not query the database: <br />" . mysql_error());
			}
			  while ($data=mysql_fetch_assoc($resultsub2)){
                  echo "<option value = '{$data[suburb_district]}'";
                       if ($District_add == $data[suburb_district]) {
                            echo "selected = 'selected'";
					    }
                        echo ">{$data[suburb_district]}</option>";
		        }
 
echo "</select>";

?>

<script language="Javascript" type="text/javascript">
	var StateArray = new Array();
	<?php echo $StateArrayPhp; ?>


	function SelectChanged()
	{
		var Suburb = document.getElementById('suburblist').value;
		document.getElementById('state').value = StateArray[Suburb];
	}
</script>
	
		
		</td>
	</tr>
	<tr>
		<td class="row1">Suburb</td>
		<td class="row2"><input type="text" name="suburb" value="<?php echo $Suburb ?>"/></td>
	</tr>
	<tr>
		<td class="row1">State</td>
		<td class="row2"><input type="text" name="suburb_state" id="state" value="VIC"/ readonly ></td>
	</tr>
	<tr>
		<td class="row1">Postal</td>
		<td class="row2"><input type="text" name="suburb_postcode" value="<?php echo $Postcode ?>"/></td>
	</tr>
	
	<tr>
		<td class="row1">&nbsp;</td>
		<td class="row2"><input type="submit" name="add" value="Save" class="update-btn" /> <input type="button" name="cancel" value="Cancel" class="update-btn" onclick=location.href='<?php echo JURI::base(); ?>system-management-vic/suburb-listing-vic' /></td>
	</tr>
</table>

</form>