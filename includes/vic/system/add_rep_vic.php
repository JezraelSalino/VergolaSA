<?php  
$db = JFactory::getDbo();
$id =$_REQUEST['id'];

$id =$_REQUEST['id'];

$result = mysql_query("SELECT * FROM ver_users WHERE id  = '$id'");
$retrieve = mysql_fetch_array($result);
if (!$result) 
		{
		die("Error: Data not found..");
		}
	$Name=$retrieve['name'] ;
	$Username=$retrieve['username'] ;
	$Email=$retrieve['email'] ;
	$Password=$retrieve['password'] ;
	$Block=$retrieve['block'] ;
	$Phone=$retrieve['Phone'] ;
	$Mobile=$retrieve['Mobile'] ;
	$ABN=$retrieve['ABN'] ;
	$RepID=$retrieve['RepID'] ;
				

if(isset($_POST['save']))
{	
	
	$first_name = $_POST['first_name'];
	$last_name = $_POST['last_name'];
	$name = $first_name.' '.$last_name;
	$username = $_POST['username']; 
	$email = $_POST['email'];
	$password = md5($_POST['password']);
	  
	$next_increment = 0;
	$qShowStatus = "SHOW TABLE STATUS LIKE 'ver_users'";
	$qShowStatusResult = mysql_query($qShowStatus) or die ( "Query failed: " . mysql_error() . "<br/>" . $qShowStatus );
	$row = mysql_fetch_assoc($qShowStatusResult);
	$next_increment = $row['Auto_increment'];
	$next_id = 'Rep'.$next_increment;  
	 
    $query = "insert into ver_users (first_name, last_name, name, username, email, password, RepID) VALUES('{$first_name}','{$last_name}','{$name}','{$username}','{$email}','{$password}','{$next_id}');";
    //error_log($query, 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_us\\my-error.log'); 
    $insert_result = mysql_query($query);

    $query2 = "insert into ver_user_usergroup_map (user_id, group_id) VALUES({$next_increment},9);";
    //error_log($query, 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_us\\my-error.log'); 
    $insert_result2 = mysql_query($query2);

    if($insert_result && $insert_result2){
    	

    	header("Location:".JURI::base()."system-management-vic/rep-listing-vic");
    }else{
    	$note = "Error while saving..";
    }
    	
 
 




//return $username_save;

   		
}
 

if(isset($_POST['cancel']))
{	
	header("Location: index.php");			
}

?>
<form method="post" >
<table class="update-table" style="width:60%;">
    <tr>
		<td class="row1">First Name</td>
		<td class="row2"><input type="text" name="first_name" value=""/></td>
	</tr>
	<tr>
		<td class="row1">Last Name</td>
		<td class="row2"><input type="text" name="last_name" value=""/></td>
	</tr>
	<tr>
		<td class="row1">Email</td>
		<td class="row2"><input type="text" name="email" value=""/></td>
	</tr>
	<tr>
		<td class="row1">Username</td>
		<td class="row2"><input type="text" name="username" value=""/></td>
	</tr>
	<tr>
		<td class="row1">Password</td>
		<td class="row2"><input type="text" name="password" value=""/></td>
	</tr>
	  
	<tr>
		<td class="row1">&nbsp;</td>
		<td class="row2"><input type="submit" name="save" value="Save" class="update-btn" /> 
		<input type="submit" name="cancel" value="Cancel" class="update-btn" /></td>
	</tr>
</table>