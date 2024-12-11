<?php  
if(isset($_POST['add']))
{	
//This is the directory where images will be saved 
$target = "images/"; 
$target = $target . basename( $_FILES['photo']['name']); 
 
 //This gets all the other information from the form 
$type=$_POST['type']; 
$name=$_POST['name']; 
$pic=($_FILES['photo']['name']); 
 
//Writes the information to the database 
mysql_query("INSERT INTO `ver_chronoforms_data_image_vic` (cf_id, type, name, photo) VALUES (NULL, '$type', '$name', '$pic')") ; 
 
//Writes the photo to the server 
if(move_uploaded_file($_FILES['photo']['tmp_name'], $target)) 
{ 
 
//Tells you if its all ok 
echo "The file ". basename( $_FILES['uploadedfile']['name']). " has been uploaded, and your information has been added to the directory"; 
 } 
else { 
 
//Gives and error if its not 
echo "Sorry, there was a problem uploading your file."; 
 } 
			
	
	header('Location:'.JURI::base().'system-management-vic/image-listing-vic');			
}

//if(isset($_POST['cancel']))
//{	
//	header("Location: index.php");			
//}

?>

<form enctype="multipart/form-data" class="Chronoform hasValidation" method="post" id="chronoform_Image_Vic" action="<?php echo JURI::base(); ?>system-management-vic/image-listing-vic/image-vic">
<table class="update-table">
    <tr>
		<td class="row1">Type</td>
		<td class="row2"><select class="image-list" id="imagelist" name="type" >
                  <option value="Gutter">Gutter</option>
				  <option value="Flashing">Flashing</option>
		 </select>

		</td>
	</tr>
	<tr>
		<td class="row1">Description</td>
		<td class="row2"><input type="text" name="name" value="<?php echo $Suburb ?>"/></td>
	</tr>
	<tr>
		<td class="row1">Image</td>
		<td class="row2"><input type="file" name="photo"></td>
	</tr>	
	
	<tr>
		<td class="row1">&nbsp;</td>
		<td class="row2"><input type="submit" name="add" value="Save" class="update-btn" /> <input type="button" name="cancel" value="Cancel" class="update-btn" onclick=location.href='<?php echo JURI::base(); ?>system-management-vic/image-listing-vic' /></td>
	</tr>
</table>

</form>