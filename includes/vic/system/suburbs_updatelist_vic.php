<?php  
$db = JFactory::getDbo();
$id =$_REQUEST['cf_id'];

$result = mysql_query("SELECT * FROM ver_chronoforms_data_suburbs_vic WHERE cf_id  = '$id'");
$retrieve = mysql_fetch_array($result);
if (!$result) 
		{
		die("Error: Data not found..");
		}
	$State=$retrieve['suburb_state'] ;
	$Postcode= $retrieve['suburb_postcode'];					
	$District=$retrieve['suburb_district'] ;
	$Suburb=$retrieve['suburb'] ;

if(isset($_POST['save']))
{	
	$state_save = $_POST['state'];
	$postcode_save = $_POST['postcode'];
	$district_save = $_POST['district'];
	$suburb_save = $_POST['suburb'];

	mysql_query("UPDATE ver_chronoforms_data_suburbs_vic SET suburb_state ='$state_save', suburb_postcode ='$postcode_save',
		 suburb_district ='$district_save', suburb ='$suburb_save' WHERE cf_id = '$id'")
				or die(mysql_error()); 
	echo "Saved!";
	
	header('Location:'.JURI::base().'system-management-vic/suburb-listing-vic');			
}

if(isset($_POST['delete']))
{	

	mysql_query("DELETE from ver_chronoforms_data_suburbs_vic WHERE cf_id = '$id'")
				or die(mysql_error()); 
	echo "Deleted";
	
	header('Location:'.JURI::base().'system-management-vic/suburb-listing-vic');			
}

if(isset($_POST['cancel']))
{	
	header('Location:'.JURI::base().'system-management-vic/suburb-listing-vic');			
}

?>
<form method="post">
<table class="update-table">
    <tr>
		<td class="row1">District</td>
		<td class="row2">
		<?php
 
$querysub="SELECT cf_id, suburb_district,suburb, suburb_state, suburb_postcode FROM ver_chronoforms_data_suburbs_vic ORDER BY suburb ASC";
$resultsub = mysql_query($querysub);
if(!$resultsub){die ("Could not query the database: <br />" . mysql_error());}
 //create selection list				
	while($row = mysql_fetch_row($resultsub))
	{
		$heading = $row[0];	
		$StateArrayPhp .= 'StateArray["'.$heading.'"]="'.$row[1].'";';


	}
	
echo "<select class='suburb-list' id='suburblist' name='district' onchange='javascript:SelectChanged();'>";
            $querysub2="SELECT cf_id, suburb_district, suburb, suburb_state, suburb_postcode FROM ver_chronoforms_data_suburbs_vic GROUP by suburb_district";
            $resultsub2 = mysql_query($querysub2);
            if(!$resultsub2){die ("Could not query the database: <br />" . mysql_error());
			}
			  while ($data=mysql_fetch_assoc($resultsub2)){
                  echo "<option value = '{$data[suburb_district]}'";
                       if ($District == $data[suburb_district]) {
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
		<td class="row2"><input type="text" name="state" value="<?php echo $State ?>"/ readonly ></td>
	</tr>
	<tr>
		<td class="row1">Postal</td>
		<td class="row2"><input type="text" name="postcode" value="<?php echo $Postcode ?>"/></td>
	</tr>
	
	<tr>
		<td class="row1">&nbsp;</td>
		<td class="row2"><input type="submit" name="save" value="Save" class="update-btn" /> <input type="submit" name="delete" value="Delete" class="update-btn" /> <input type="submit" name="cancel" value="Cancel" class="update-btn" /></td>
	</tr>
</table>