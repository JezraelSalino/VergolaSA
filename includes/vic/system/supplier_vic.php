<?php  
$next_increment = 0;
$qShowStatus = "SHOW TABLE STATUS LIKE 'ver_chronoforms_data_supplier_vic'";
$qShowStatusResult = mysql_query($qShowStatus) or die ( "Query failed: " . mysql_error() . "<br/>" . $qShowStatus );
$row = mysql_fetch_assoc($qShowStatusResult);
$next_increment = $row['Auto_increment'];
$getsupplierid = 'SRV'.$next_increment;

if(isset($_POST['add']))
{	
    // Supplier Details
    $SupplierSuburbID = $_POST['suburbid'] ;
	$SupplierName = $_POST['supplier_name'] ;					
	$SupplierAddress1 = $_POST['supplier_address1'] ;
	$SupplierAddress2 = $_POST['supplier_address2'] ;
	$SupplierSuburb = $_POST['supplier_suburb'] ;
	$SupplierState = $_POST['supplier_state'];					
	$SupplierPostcode = $_POST['supplier_postcode'] ;
	$SupplierWPhone = $_POST['supplier_wkphone'] ;				
	$SupplierFax = $_POST['supplier_fax'] ;
	$SupplierEmail = $_POST['supplier_email'] ;
	$SupplierWebsite = $_POST['supplier_website'] ;
	
	// Supplier Contact
	$ContactLastName = $_POST['lastname'];
	$ContactFirstName = $_POST['firstname'];
	$ContactTitle = $_POST['ctitle'];
	$ContactMobile = $_POST['mobile'];
	$ContactNotes = $_POST['notes'];
	
     mysql_query("INSERT INTO ver_chronoforms_data_supplier_vic (supplierid, suburbid, company_name, address1, address2, suburb, state, postcode, phone, fax, email, website, lastname, firstname, title, mobile, notes) 
		 VALUES ('$getsupplierid', '$SupplierSuburbID', '$SupplierName', '$SupplierAddress1', '$SupplierAddress2', '$SupplierSuburb', '$SupplierState', '$SupplierPostcode', '$SupplierWPhone', '$SupplierFax', '$SupplierEmail', '$SupplierWebsite', '$ContactLastName', '$ContactFirstName', '$ContactTitle', '$ContactMobile', '$ContactNotes')");
			
	
	header('Location:'.JURI::base().'system-management-vic/supplier-listing-vic');		
}

if(isset($_POST['cancel']))
{	
	header('Location:'.JURI::base().'system-management-vic/supplier-listing-vic');		
}

?>

<form class="Chronoform hasValidation" method="post" id="chronoform_Supplier_Vic" action="<?php echo JURI::base(); ?>system-management-vic/supplier-listing-vic/supplier-vic">
<table class="update-table supplier-table">
    <th colspan="2"><h2>Supplier Details</h2></th><th></th><th colspan="2"><h2>Supplier Contact</h2></th>
	<tr>
		<td class="row1">Company Name:</td>
		<td class="row2"><input tabindex="1" type="text" name="supplier_name" value="<?php echo $SupplierName; ?>"/></td>
		<td class="row3">&nbsp;</td>
		<td class="row4">Title</td>
		<td class="row5"><select tabindex="9" class="title" id="ctitle" name="ctitle">
            <option ></option>
            <option value="Mr">Mr</option>
            <option value="Mrs">Mrs</option>
            <option value="Ms">Ms</option>
            <option value="Dr">Dr</option>
            <option value="Prof.">Prof.</option>
          </select></td>
	</tr>
	<tr>
		<td class="row1">Address 1</td>
		<td class="row2"><input tabindex="2" type="text" name="supplier_address1" value="<?php echo $SupplierAddress1; ?>"/></td>
		<td class="row3">&nbsp;</td>
		<td class="row4">First Name</td>
		<td class="row5"><input tabindex="10" type="text" name="firstname" value="<?php echo $ContactFirstName; ?>"/></td>
	</tr>
	<tr>
		<td class="row1">Address 2</td>
		<td class="row2"><input tabindex="3" type="text" name="supplier_address2" value="<?php echo $SupplierAddress2; ?>"/></td>
		<td class="row3">&nbsp;</td>
		<td class="row4">Last Name</td>
		<td class="row5"><input tabindex="11" type="text" name="lastname" value="<?php echo $ContactLastName; ?>"/></td>
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
	
echo "<select tabindex='4' class='suburb-list' id='suburblist' onchange='javascript:SelectChanged();'>";
            $querysub2="SELECT cf_id, suburb, suburb_state, suburb_postcode FROM ver_chronoforms_data_suburbs_vic ORDER BY suburb ASC";
            $resultsub2 = mysql_query($querysub2);
            if(!$resultsub2){die ("Could not query the database: <br />" . mysql_error());
			}
			  while ($data=mysql_fetch_assoc($resultsub2)){
                  echo "<option value = '{$data[cf_id]}'";
                       if ($SupplierSuburbID == $data[cf_id]) {
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

<input type="hidden" id="suburb" name='supplier_suburb' value="<?php echo $SupplierSuburb; ?>" readonly />	
<input type="hidden" id="suburbid" name='suburbid' value="<?php echo $SupplierSuburbID; ?>" readonly />
		</td>
		<td class="row3">&nbsp;</td>
		<td class="row4">Mobile</td>
		<td class="row5"><input tabindex="12" type="text" name="mobile" value="<?php echo $ContactMobile; ?>"/></td>
	</tr>
	<tr>
	<tr>
		<td class="row1">State</td>
		<td class="row2"><input type="text" id="suburbstate" name="supplier_state" value="<?php echo $SupplierState; ?>" readonly />
		
		</td>
		<td class="row3">&nbsp;</td>
		<td class="row4">Notes</td>
		<td class="row5" rowspan="6" valign="top"><textarea tabindex="13" name="notes" id="notes"><?php echo $ContactNotes; ?></textarea></td>
	</tr>
	<tr>
		<td class="row1">Postcode</td>
		<td class="row2"><input type="text" id="suburbpostcode" name="supplier_postcode" value="<?php echo $SupplierPostcode; ?>" readonly /></td>
		<td class="row3">&nbsp;</td>
		<td class="row4">&nbsp;</td>

	</tr>
	<tr>
		<td class="row1">Work Phone</td>
		<td class="row2"><input tabindex="5" type="text" name="supplier_wkphone" value="<?php echo $SupplierWPhone; ?>"/></td>
		<td class="row3">&nbsp;</td>
		<td class="row4">&nbsp;</td>

	</tr>
	<tr>
		<td class="row1">Fax</td>
		<td class="row2"><input tabindex="6" type="text" name="supplier_fax" value="<?php echo $SupplierFax; ?>"/></td>
		<td class="row3">&nbsp;</td>
		<td class="row4">&nbsp;</td>

	</tr>
	<tr>
		<td class="row1">Email</td>
		<td class="row2"><input tabindex="7" type="text" name="supplier_email" value="<?php echo $SupplierEmail; ?>"/></td>
		<td class="row3">&nbsp;</td>
		<td class="row4">&nbsp;</td>

	</tr>
    <tr>
		<td class="row1">Website</td>
		<td class="row2"><input tabindex="8" type="text" name="supplier_website" value="<?php echo $SupplierWebsite; ?>"/></td>
		<td class="row3">&nbsp;</td>
		<td class="row4">&nbsp;</td>

	</tr>
	<tr>
		<td class="row1">&nbsp;</td>
		<td class="row2"><input tabindex="14" type="submit" name="add" value="Save" class="update-btn" /> <input tabindex="15" type="button" name="cancel" value="Cancel" class="update-btn" onclick=location.href='<?php echo JURI::base(); ?>system-management-vic/supplier-listing-vic' /></td>
		<td class="row3">&nbsp;</td>
		<td class="row4">&nbsp;</td>
		<td class="row5">&nbsp;</td>
	</tr>
</table>
</form>
