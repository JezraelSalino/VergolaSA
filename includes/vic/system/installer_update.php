<?php  
//$db = JFactory::getDbo();
$is_edit = 0;
if(isset($_REQUEST['view']) && $_REQUEST['view']=="add"){
	$is_edit = 0;
}else{
	$is_edit = 1;


$id =$_REQUEST['cf_id'];

$result = mysql_query("SELECT * FROM ver_chronoforms_data_installer_vic WHERE cf_id  = '$id'");
$installer = mysql_fetch_array($result);
if (!$result) 
		{
		die("Error: Data not found..");
		}
	//$Lead=$retrieve['lead'] ;
}

if(isset($_POST['save-new']))
{	
	$name = mysql_escape_string($_POST['name']);
	$mobile = mysql_escape_string($_POST['mobile']);
	$email = mysql_escape_string($_POST['email']);


	mysql_query("INSERT ver_chronoforms_data_installer_vic(name, mobile, email)   VALUES('$name','$mobile','$email'); ")
				or die(mysql_error()); 
	//echo "Saved!";
	
	header('Location:'.JURI::base().'system-management-vic/installer-listing-vic');

}else if(isset($_POST['save-update'])){	

	$name = mysql_escape_string($_POST['name']);
	$mobile = mysql_escape_string($_POST['mobile']);
	$email = mysql_escape_string($_POST['email']);


	mysql_query("UPDATE ver_chronoforms_data_installer_vic SET name ='$name', mobile='$mobile', email='$email' WHERE cf_id = '$id'")
				or die(mysql_error()); 
	echo "Saved!";
	
	header('Location:'.JURI::base().'system-management-vic/installer-listing-vic');			
}

if(isset($_POST['delete']))
{	

	mysql_query("DELETE from ver_chronoforms_data_installer_vic WHERE cf_id = '$id'")
				or die(mysql_error()); 
	echo "Deleted";
	
	header('Location:'.JURI::base().'system-management-vic/installer-listing-vic');			
}

if(isset($_POST['cancel']))
{	
	header('Location:'.JURI::base().'system-management-vic/installer-listing-vic');			
}



?>
<form method="post">
<table class="update-table">
	<tr>
		<td class="row1">Installer Name:</td>
		<td class="row2"><input type="text" name="name" value="<?php echo $installer['name']; ?>"/></td>
	</tr>
	<tr>
		<td class="row1">Mobile:</td>
		<td class="row2"><input type="text" name="mobile" value="<?php echo $installer['mobile']; ?>"/></td>
	</tr>
	<tr>
		<td class="row1">Email:</td>
		<td class="row2"><input type="text" name="email" value="<?php echo $installer['email']; ?>"/></td>
	</tr>
	
	<tr>
		<td class="row1">&nbsp;</td>
		<td class="row2"><input type="submit" name="<?php echo ($is_edit==1?"save-update":"save-new"); ?>" value="Save" class="update-btn" /> <input type="submit" name="delete" value="Delete" class="update-btn" /> <input type="submit" name="cancel" value="Cancel" class="update-btn" /></td>
	</tr>
</table>