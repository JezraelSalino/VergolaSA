<?php  
$db = JFactory::getDbo();

$id =$_REQUEST['cf_id'];


$result = mysql_query("SELECT * FROM ver_chronoforms_data_builder_vic WHERE cf_id  = '$id'");

$retrieve = mysql_fetch_array($result);
if (!$result) 
		{
		die("Error: Data not found..");
		}
	$BuildSuburbID=$retrieve['suburbid'] ;
	$BuildName=$retrieve['builder_name'] ;
	$BuildContact= $retrieve['builder_contact'];					
	$BuildAddress1=$retrieve['builder_address1'] ;
	$BuildAddress2=$retrieve['builder_address2'] ;
	$BuildSuburb=$retrieve['builder_suburb'] ;
	$BuildState= $retrieve['builder_state'];					
	$BuildPostcode=$retrieve['builder_postcode'] ;
	$BuildWPhone=$retrieve['builder_wkphone'] ;
	$BuildHPhone=$retrieve['builder_hmphone'] ;
	$BuildMobile= $retrieve['builder_mobile'];					
	$BuildFax= $retrieve['builder_fax'] ;
	$BuildEmail=$retrieve['builder_email'] ;

if(isset($_POST['save']))
{	

    $BuildSuburbID_save = $_POST['buildersuburbid'] ;
    $BuildName_save = $_POST['buildername'] ;
	$BuildContact_save = $_POST['buildercontact'];					
	$BuildAddress1_save = $_POST['builderaddress1'] ;
	$BuildAddress2_save = $_POST['builderaddress2'] ;
	$BuildSuburb_save = $_POST['buildersuburb'] ;
	$BuildState_save = $_POST['builderstate'];					
	$BuildPostcode_save = $_POST['builderpostcode'] ;
	$BuildWPhone_save = $_POST['builderwkphone'] ;
	$BuildHPhone_save = $_POST['builderhmphone'] ;
	$BuildMobile_save = $_POST['buildermobile'];					
	$BuildFax_save = $_POST['builderfax'] ;
	$BuildEmail_save = $_POST['builderemail'] ;
	

	mysql_query("UPDATE ver_chronoforms_data_builder_vic SET suburbid ='$BuildSuburbID_save', builder_name ='$BuildName_save', builder_contact ='$BuildContact_save',
		 builder_address1 ='$BuildAddress1_save', builder_address2 ='$BuildAddress2_save', builder_suburb ='$BuildSuburb_save', builder_state ='$BuildState_save', builder_postcode ='$BuildPostcode_save', builder_wkphone ='$BuildWPhone_save', builder_hmphone ='$BuildHPhone_save', builder_mobile ='$BuildMobile_save', builder_fax ='$BuildFax_save', builder_email ='$BuildEmail_save' WHERE cf_id = '$id'")
				or die(mysql_error()); 
	echo "Saved!";
	
	header('Location:'.JURI::base().'system-management-vic/builder-listing-vic');		
}

if(isset($_POST['delete']))
{	

	mysql_query("DELETE from ver_chronoforms_data_builder_vic WHERE cf_id = '$id'")
				or die(mysql_error()); 
	echo "Deleted";
	
   header('Location:'.JURI::base().'system-management-vic/builder-listing-vic');	
}

if(isset($_POST['cancel']))
{	
	header('Location:'.JURI::base().'system-management-vic/builder-listing-vic');		
}

//mysql_close($conn);
?>
<form method="post">
<table class="update-table">
	<tr>
		<td class="row1">Builder Name:</td>
		<td class="row2"><input type="text" name="buildername" value="<?php echo $BuildName ?>"/></td>
	</tr>
	<tr>
		<td class="row1">Builder Contact</td>
		<td class="row2"><input type="text" name="buildercontact" value="<?php echo $BuildContact ?>"/></td>
	</tr>
	<tr>
		<td class="row1">Address 1</td>
		<td class="row2"><input type="text" name="builderaddress1" value="<?php echo $BuildAddress1 ?>"/></td>
	</tr>
	<tr>
		<td class="row1">Address 2</td>
		<td class="row2"><input type="text" name="builderaddress2" value="<?php echo $BuildAddress2 ?>"/></td>
	</tr>
	<tr>
		<td class="row1">Suburb</td>
		<td class="row2"><?php
 
$querysub="SELECT cf_id, suburb, suburb_state, suburb_postcode FROM ver_chronoforms_data_suburbs_vic ORDER BY suburb ASC";
$resultsub = mysql_query($querysub);
if(!$resultsub){die ("Could not query the database: <br />" . mysql_error());}
 //create selection list				
	while($row = mysql_fetch_row($resultsub))
	{
		$heading = $row[0];	
		$SuburbIDArrayPhp .= 'SuburbIDArray["'.$heading.'"]="'.$row[0].'";';
		$SuburbArrayPhp .= 'SuburbArray["'.$heading.'"]="'.$row[1].'";';
		$StateArrayPhp .= 'StateArray["'.$heading.'"]="'.$row[2].'";';
		$PostcodeArrayPhp .= 'PostcodeArray["'.$heading.'"]="'.$row[3].'";';

	}
	
echo "<select class='suburb-list' id='suburblist' onchange='javascript:SelectChanged();'>";
            $querysub2="SELECT cf_id, suburb, suburb_state, suburb_postcode FROM ver_chronoforms_data_suburbs_vic ORDER BY suburb ASC";
            $resultsub2 = mysql_query($querysub2);
            if(!$resultsub2){die ("Could not query the database: <br />" . mysql_error());
			}
			  while ($data=mysql_fetch_assoc($resultsub2)){
                  echo "<option value = '{$data[cf_id]}'";
                       if ($BuildSuburbID == $data[cf_id]) {
                            echo "selected = 'selected'";
					    }
                        echo ">{$data[suburb]}</option>";
		        }
 
echo "</select>";

?>

<script language="Javascript" type="text/javascript">
    var SuburbIDArray = new Array();
	<?php echo $SuburbIDArrayPhp; ?>
    var SuburbArray = new Array();
	<?php echo $SuburbArrayPhp; ?>
	var StateArray = new Array();
	<?php echo $StateArrayPhp; ?>
	var PostcodeArray = new Array();
	<?php echo $PostcodeArrayPhp; ?>

	function SelectChanged()
	{
		var Suburb = document.getElementById('suburblist').value;
		document.getElementById('suburb').value = SuburbArray[Suburb];
		document.getElementById('suburbstate').value = StateArray[Suburb];
		document.getElementById('suburbpostcode').value = PostcodeArray[Suburb];
		document.getElementById('suburbid').value = SuburbIDArray[Suburb];

	}
</script>

<input type="hidden" id="suburb" name='buildersuburb' value="<?php echo $BuildSuburb; ?>" readonly />	
<input type="hidden" id="suburbid" name='buildersuburbid' value="<?php echo $BuildSuburbID; ?>" readonly />
		</td>
	</tr>
	<tr>
		<td class="row1">State</td>
		<td class="row2"><input type="text" id="suburbstate" name="builderstate" value="<?php echo $BuildState; ?>" readonly /></td>
	</tr>
	<tr>
		<td class="row1">Postcode</td>
		<td class="row2"><input type="text" id="suburbpostcode" name="builderpostcode" value="<?php echo $BuildPostcode ?>" readonly /></td>
	</tr>
	<tr>
		<td class="row1">Work Phone</td>
		<td class="row2"><input type="text" name="builderwkphone" value="<?php echo $BuildWPhone ?>"/></td>
	</tr>
	<tr>
		<td class="row1">Home Phone</td>
		<td class="row2"><input type="text" name="builderhmphone" value="<?php echo $BuildHPhone ?>"/></td>
	</tr>
	<tr>
		<td class="row1">Mobile</td>
		<td class="row2"><input type="text" name="buildermobile" value="<?php echo $BuildMobile ?>"/></td>
	</tr>
	<tr>
		<td class="row1">Fax</td>
		<td class="row2"><input type="text" name="builderfax" value="<?php echo $BuildFax ?>"/></td>
	</tr>
	<tr>
		<td class="row1">Email</td>
		<td class="row2"><input type="text" name="builderemail" value="<?php echo $BuildEmail ?>"/></td>
	</tr>
	<tr>
		<td class="row1">&nbsp;</td>
		<td class="row2"><input type="submit" name="save" value="Save" class="update-btn" /> <input type="submit" name="delete" value="Delete" class="update-btn" /> <input type="submit" name="cancel" value="Cancel" class="update-btn" /></td>
	</tr>
</table>
</form>