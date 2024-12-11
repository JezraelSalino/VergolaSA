<?php  
if(isset($_POST['add']))
{	

    $BuildSuburbID_add = $_POST['suburbid_add'] ;
	$BuildName_add = $_POST['builder_name_add'] ;
	$BuildContact_add = $_POST['builder_contact_add'];					
	$BuildAddress1_add = $_POST['builder_address1_add'] ;
	$BuildAddress2_add = $_POST['builder_address2_add'] ;
	$BuildSuburb_add = $_POST['builder_suburb_add'] ;
	$BuildState_add = $_POST['builder_state_add'];					
	$BuildPostcode_add = $_POST['builder_postcode_add'] ;
	$BuildWPhone_add = $_POST['builder_wkphone_add'] ;
	$BuildHPhone_add = $_POST['builder_hmphone_add'] ;
	$BuildMobile_add = $_POST['builder_mobile_add'];					
	$BuildFax_add = $_POST['builder_fax_add'] ;
	$BuildEmail_add = $_POST['builder_email_add'] ;
	
     mysql_query("INSERT INTO ver_chronoforms_data_builder_vic (suburbid, builder_name, builder_contact, builder_address1, builder_address2, builder_suburb, builder_state, builder_postcode, builder_wkphone, builder_hmphone, builder_mobile, builder_fax, builder_email) 
		 VALUES ('$BuildSuburbID_add', '$BuildName_add', '$BuildContact_add', '$BuildAddress1_add', '$BuildAddress2_add', '$BuildSuburb_add', '$BuildState_add', '$BuildPostcode_add', '$BuildWPhone_add', '$BuildHPhone_add', '$BuildMobile_add', '$BuildFax_add', '$BuildEmail_add')");
			
	
	header('Location:'.JURI::base().'system-management-vic/builder-listing-vic');		
}

//if(isset($_POST['cancel']))
//{	
//	header('Location:'.JURI::base().'system-management-vic/builder-listing-vic');		
//}

?>

<form class="Chronoform hasValidation" method="post" id="chronoform_Builder_Vic" action="<?php echo JURI::base(); ?>system-management-vic/builder-listing-vic/builder-vic">
<table class="update-table">
	<tr>
		<td class="row1">Builder Name:</td>
		<td class="row2"><input type="text" name="builder_name_add" value="<?php echo $BuildName ?>"/></td>
	</tr>
	<tr>
		<td class="row1">Builder Contact</td>
		<td class="row2"><input type="text" name="builder_contact_add" value="<?php echo $BuildContact ?>"/></td>
	</tr>
	<tr>
		<td class="row1">Address 1</td>
		<td class="row2"><input type="text" name="builder_address1_add" value="<?php echo $BuildAddress1 ?>"/></td>
	</tr>
	<tr>
		<td class="row1">Address 2</td>
		<td class="row2"><input type="text" name="builder_address2_add" value="<?php echo $BuildAddress2 ?>"/></td>
	</tr>
	<tr>
		<td class="row1">Suburb</td>
		<td class="row2">
 
 <?php
 
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

<input type="hidden" id="suburb" name='builder_suburb_add' value="<?php echo $BuildSuburb; ?>" readonly />	
<input type="hidden" id="suburbid" name='suburbid_add' value="<?php echo $BuildSuburbID; ?>" readonly />
		</td>
	</tr>
	<tr>
	<tr>
		<td class="row1">State</td>
		<td class="row2"><input type="text" id="suburbstate" name="builder_state_add" value="<?php echo $BuildState; ?>" readonly />
		
		</td>
	</tr>
	<tr>
		<td class="row1">Postcode</td>
		<td class="row2"><input type="text" id="suburbpostcode" name="builder_postcode_add" value="<?php echo $BuildPostcode ?>" readonly /></td>
	</tr>
	<tr>
		<td class="row1">Work Phone</td>
		<td class="row2"><input type="text" name="builder_wkphone_add" value="<?php echo $BuildWPhone ?>"/></td>
	</tr>
	<tr>
		<td class="row1">Home Phone</td>
		<td class="row2"><input type="text" name="builder_hmphone_add" value="<?php echo $BuildHPhone ?>"/></td>
	</tr>
	<tr>
		<td class="row1">Mobile</td>
		<td class="row2"><input type="text" name="builder_mobile_add" value="<?php echo $BuildMobile ?>"/></td>
	</tr>
	<tr>
		<td class="row1">Fax</td>
		<td class="row2"><input type="text" name="builder_fax_add" value="<?php echo $BuildFax ?>"/></td>
	</tr>
	<tr>
		<td class="row1">Email</td>
		<td class="row2"><input type="text" name="builder_email_add" value="<?php echo $BuildEmail ?>"/></td>
	</tr>
	<tr>
		<td class="row1">&nbsp;</td>
		<td class="row2"><input type="submit" name="add" value="Save" class="update-btn" /> <input type="button" name="cancel" value="Cancel" class="update-btn" onclick=location.href='<?php echo JURI::base(); ?>system-management-vic/builder-listing-vic' /></td>
	</tr>
</table>
</form>
