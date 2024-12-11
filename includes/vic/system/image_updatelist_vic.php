<?php  
$db = JFactory::getDbo();
$id =$_REQUEST['cf_id'];

$result = mysql_query("SELECT * FROM ver_chronoforms_data_image_vic WHERE cf_id  = '$id'");
$retrieve = mysql_fetch_array($result);
if (!$result) 
		{
		die("Error: Data not found..");
		}
	$Type=$retrieve['type'] ;					
	$Description=$retrieve['name'] ;
	$Photo=$retrieve['photo'] ;

if(isset($_POST['save']))
{	
//This is the directory where images will be saved 
$target = "images/"; 
$target = $target . basename( $_FILES['photo']['name']); 
 
 //This gets all the other information from the form 
$type_save=$_POST['type']; 
$name_save=$_POST['name']; 
$pic=($_FILES['photo']['name']); 
 
//Writes the information to the database 
mysql_query("UPDATE ver_chronoforms_data_image_vic SET type ='$type_save', name ='$name_save', photo ='$pic' WHERE cf_id = '$id'");

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

if(isset($_POST['delete']))
{	

	mysql_query("DELETE from ver_chronoforms_data_image_vic WHERE cf_id = '$id'")
				or die(mysql_error()); 
	echo "Deleted";
	
	header('Location:'.JURI::base().'system-management-vic/image-listing-vic');		
}

if(isset($_POST['cancel']))
{	
	header('Location:'.JURI::base().'system-management-vic/image-listing-vic');			
}

?>
<form class="Chronoform hasValidation" method="post" id="chronoform_Image_Vic" enctype="multipart/form-data" >
<table class="update-table">
    <tr>
		<td class="row1">Type</td>
		<td class="row2">
		<?php
         echo "<select class='image-list' id='imagelist' name='type' >";
                if($Type == 'Gutter') { echo "<option value='Gutter' selected='selected' >Gutter</option> <option value='Flashing' >Flashing</option>"; }
                else { echo "<option value='Gutter' >Gutter</option> <option value='Flashing' selected='selected' >Flashing</option>"; }

				
echo "</select>";

?>		
		</td>
	</tr>
	 <tr>
		<td class="row1">Description</td>
		<td class="row2"><input type="text" name="name" value="<?php echo $Description ?>"/></td>
	</tr>

	<tr>
		<td class="row1">Image</td>
		<td class="row2"><?php echo "<span class='imagethumb'><img src=".JURI::base()."images/".$Photo." class='imagecrop' 
		  onmouseover=\"document.getElementById('PopUp').style.display='block'\" 
		  onmouseout=\"document.getElementById('PopUp').style.display='none'\" 
		  onfocus='this.blur();'		
		/></span> <div id='PopUp' class='updatepopup' ><img src=".JURI::base()."images/".$Photo." ></div>" ?>
		</td>
	</tr>
	
		<tr>
		<td class="row1">Upload New Image</td>
		<td class="row2"><input type="file" name="photo"></td>
	</tr>

	<tr>
		<td class="row1">&nbsp;</td>
		<td class="row2"><input type="submit" name="save" value="Save" class="update-btn" /> <input type="submit" name="delete" value="Delete" class="update-btn" /> <input type="submit" name="cancel" value="Cancel" class="update-btn" /></td>
	</tr>
</table>