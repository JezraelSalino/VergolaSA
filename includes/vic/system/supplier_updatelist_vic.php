<?php  
$db = JFactory::getDbo();

$id =$_REQUEST['cf_id'];


$result = mysql_query("SELECT * FROM ver_chronoforms_data_supplier_vic WHERE cf_id  = '$id'");

$retrieve = mysql_fetch_array($result);
if (!$result) 
		{
		die("Error: Data not found..");
		}
	// Supplier Details
    $SupplierSuburbID = $retrieve['suburbid'] ;
	$SupplierName = $retrieve['company_name'] ;					
	$SupplierAddress1 = $retrieve['address1'] ;
	$SupplierAddress2 = $retrieve['address2'] ;
	$SupplierSuburb = $retrieve['suburb'] ;
	$SupplierState = $retrieve['state'];					
	$SupplierPostcode = $retrieve['postcode'] ;
	$SupplierWPhone = $retrieve['phone'] ;				
	$SupplierFax = $retrieve['fax'] ;
	$SupplierEmail = $retrieve['email'] ;
	$SupplierWebsite = $retrieve['website'] ;
	
	// Supplier Contact
	$ContactLastName = $retrieve['lastname'];
	$ContactFirstName = $retrieve['firstname'];
	$ContactTitle = $retrieve['title'];
	$ContactMobile = $retrieve['mobile'];
	$ContactNotes = $retrieve['notes'];

if(isset($_POST['save']))
{	

    // Supplier Details
    $SupplierSuburbID_save = $_POST['suburbid'] ;
	$SupplierName_save = $_POST['supplier_name'] ;					
	$SupplierAddress1_save = $_POST['supplier_address1'] ;
	$SupplierAddress2_save = $_POST['supplier_address2'] ;
	$SupplierSuburb_save = $_POST['supplier_suburb'] ;
	$SupplierState_save = $_POST['supplier_state'];					
	$SupplierPostcode_save = $_POST['supplier_postcode'] ;
	$SupplierWPhone_save = $_POST['supplier_wkphone'] ;				
	$SupplierFax_save = $_POST['supplier_fax'] ;
	$SupplierEmail_save = $_POST['supplier_email'] ;
	$SupplierWebsite_save = $_POST['supplier_website'] ;
	
	// Supplier Contact
	$ContactLastName_save = $_POST['lastname'];
	$ContactFirstName_save = $_POST['firstname'];
	$ContactTitle_save = $_POST['ctitle'];
	$ContactMobile_save = $_POST['mobile'];
	$ContactNotes_save = $_POST['notes'];
	

	mysql_query("UPDATE ver_chronoforms_data_supplier_vic SET 
	suburbid ='$SupplierSuburbID_save', 
	company_name ='$SupplierName_save', 
	address1 ='$SupplierAddress1_save', 
	address2 ='$SupplierAddress2_save', 
	suburb ='$SupplierSuburb_save', 
	state ='$SupplierState_save', 
	postcode ='$SupplierPostcode_save',
    phone ='$SupplierWPhone_save', 
	fax ='$SupplierFax_save', 
	email ='$SupplierEmail_save',
	website ='$SupplierWebsite_save',
	
	lastname ='$ContactLastName_save',
	firstname ='$ContactFirstName_save',
	title ='$ContactTitle_save',
	notes ='$ContactNotes_save'
	
	WHERE cf_id = '$id'")
	
				or die(mysql_error()); 
	echo "Saved!";
	
	header('Location:'.JURI::base().'system-management-vic/supplier-listing-vic');		
}

if(isset($_POST['delete']))
{	

	mysql_query("DELETE from ver_chronoforms_data_supplier_vic WHERE cf_id = '$id'")
				or die(mysql_error()); 
	echo "Deleted";
	
   header('Location:'.JURI::base().'system-management-vic/supplier-listing-vic');	
}

if(isset($_POST['cancel']))
{	
	header('Location:'.JURI::base().'system-management-vic/supplier-listing-vic');		
}

?>

<form method="post">
<table class="update-table supplier-table">
    <th colspan="2"><h2>Supplier Details</h2></th><th></th><th colspan="2"><h2>Supplier Contact</h2></th>
	<tr>
		<td class="row1">Company Name:</td>
		<td class="row2"><input tabindex="1" type="text" name="supplier_name" value="<?php echo $SupplierName; ?>"/></td>
		<td class="row3">&nbsp;</td>
		<td class="row4">Title</td>
		<td class="row5"><select tabindex="9" class="title" id="ctitle" name="ctitle">
        <?php 
		if ($ContactTitle=="")
		{echo "<option value=\"\"></option>
		       <option value=\"Mr\">Mr</option>
		       <option value=\"Mrs\">Mrs</option>
               <option value=\"Ms\">Ms</option>
               <option value=\"Dr\">Dr</option>
               <option value=\"Prof.\">Prof.</option>"
		      ;}
			  
		elseif($ContactTitle=="Mr")
		{echo "<option value='".$ContactTitle."'>".$ContactTitle."</option>
		       <option value=\"Mrs\">Mrs</option>
               <option value=\"Ms\">Ms</option>
               <option value=\"Dr\">Dr</option>
               <option value=\"Prof.\">Prof.</option>
			   <option value=\"\"></option>"
		      ;}
		
		elseif($ContactTitle=="Mrs")
		{echo "<option value='".$ContactTitle."'>".$ContactTitle."</option>
               <option value=\"Mr\">Mr</option>
               <option value=\"Ms\">Ms</option>
               <option value=\"Dr\">Dr</option>
               <option value=\"Prof.\">Prof.</option>
			   <option value=\"\"></option>";}
			   
		elseif($ContactTitle=="Ms")
		{echo "<option value='".$ContactTitle."'>".$ContactTitle."</option>
               <option value=\"Mr\">Mr</option>
               <option value=\"Mrs\">Mrs</option>
               <option value=\"Dr\">Dr</option>
               <option value=\"Prof.\">Prof.</option>
			   <option value=\"\"></option>";}
			   
		elseif($ContactTitle=="Dr")
		{echo "<option value='".$ContactTitle."'>".$ContactTitle."</option>
               <option value=\"Mr\">Mr</option>
               <option value=\"Mrs\">Mrs</option>
               <option value=\"Ms\">Ms</option>
               <option value=\"Prof.\">Prof.</option>
			   <option value=\"\"></option>";}
			   
		elseif($ContactTitle=="Prof.")
		{echo "<option value='".$ContactTitle."'>".$ContactTitle."</option>
               <option value=\"Mr\">Mr</option>
               <option value=\"Mrs\">Mrs</option>
               <option value=\"Ms\">Ms</option>
               <option value=\"Dr\">Dr</option>
			   <option value=\"\"></option>";}	   
			    ?>
            
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
		<td class="row2"><input tabindex="14" type="submit" name="save" value="Save" class="update-btn" /> <input tabindex="15" type="submit" name="delete" value="Delete" class="update-btn" /> <input tabindex="16" type="submit" name="cancel" value="Cancel" class="update-btn" /></td>
		<td class="row3">&nbsp;</td>
		<td class="row4">&nbsp;</td>
		<td class="row5">&nbsp;</td>
	</tr>
</table>
</form>
