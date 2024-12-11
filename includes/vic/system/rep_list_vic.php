<?php
include 'includes/vic/custom_processes_user.php';
?>


<?php
//our pagination function is now in this file
function pagination($current_page_number, $total_records_found, $query_string = null)
{
	$page = 1;
	
	echo "Page: ";
	
	for ($total_pages = ($total_records_found/NUMBER_PER_PAGE); $total_pages > 0; $total_pages--)
	{
		if ($page != $current_page_number)
			echo "<a href=\"" . "system-management-vic/rep-listing-vic" . "?page=$page" . (($query_string) ? "&$query_string" : "") . "\">";

		 if ($page == $current_page_number) {echo "<span class=\"current\">$page</span>";} else {echo "$page";}

		
		if ($page != $current_page_number)
			echo "</a>";

		$page++;
	}
}



define("NUMBER_PER_PAGE", 100); //number of records per page of the search results
$instance =& JURI::getInstance();
$url = JURI::getInstance()->toString();
//display the search form
echo "<div class='search-listing'>
<form action='" . JRoute::_($url) . "' method='post'>
	<label>Search:</label> <input type='text' name='search_string' /> <input type='submit' name='submit' value='Search' class='search-btn' />
</form>
<input type='button' class='add-btn' onclick=location.href='" . JURI::base() . "system-management-vic/rep-listing-vic/add-rep' value='Add New'>
</div>"; // old: system-management-vic/rep-listing-vic/add-user-vic

//load the current paginated page number
$page = ($_GET['page']) ? $_GET['page'] : 1;
$start = ($page-1) * NUMBER_PER_PAGE;
$usergroup = 'Victoria Users';

/**
* if we used the search form use those variables, otherwise look for
* variables passed in the URL because someone clicked on a page number
**/

$search = $_POST['search_string'];
$sql = "SELECT * FROM ver_users WHERE usertype LIKE ('$usergroup')";
$result = mysql_query($sql) or die(mysql_error());

if ($search)
	$sql .= " AND ( name LIKE '%"  . $search .  "%'" . " OR username LIKE '%"  . $search .  "%'" . " OR email LIKE '%"  . $search .  "%'" . " OR Phone LIKE '%"  . $search .  "%'" . " OR Mobile LIKE '%"  . $search .  "%'" . " OR usertype LIKE '%"  . $search .  "%')";

	
//this return the total number of records returned by our query
$total_records = mysql_num_rows(mysql_query($sql));

$sql .= " ORDER BY Block, name ";

//now we limit our query to the number of results we want per page
$sql .= " LIMIT $start, " . NUMBER_PER_PAGE;

/**
* Next we display our pagination at the top of our search results
* and we include the search words filled into our form so we can pass
* this information to the page numbers. That way as they click from page
* to page the query will pull up the correct results
**/
//error_log($sql, 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_sa\\my-error.log');  
//$user->groups['10'] // is victoria  admin user 
//$user->groups['26'] //  is victoria office manager
//$user->groups['27'] //  is victoria sales manager
//$user->groups['9'] //9 is consultants general user
//top_admin is Jit user $user->groups['10']

echo "<center><h1 class='search-records'>" . number_format($total_records) . " Records Found</h1></center>";
echo "<div class='pagination-layer'>";
pagination($page, $total_records, "name=$name&username=$username&email=$email&Phone=$phone&Mobile=$mobile&usertype=$usertype");
echo "</div>";

$loop = mysql_query($sql) or die ('cannot run the query because: ' . mysql_error());
	echo "<table class='listing-table table-bordered'><thead><tr><th>Name</th><th>Username</th><th>Email</th><th>Phone</th><th>Mobile</th><th>Usergroup</th></tr></thead><tbody>";

$user =& JFactory::getUser();
while ($record = mysql_fetch_assoc($loop)){
	$sel_user =& JFactory::getUser($record['id']);

	/*
	$user_group_name = "";
	if($sel_user->groups['10']){
		$user_group_name = "Sytem Admin";
	}else if($sel_user->groups['26']){
		$user_group_name = "Construction Manager";
	}else if($sel_user->groups['27']){
		$user_group_name = "Sales Manager";
	}else if($sel_user->groups['28']){
		$user_group_name = "Reception";
	}else if($sel_user->groups['29']){
		$user_group_name = "Account";
	}else{
		$user_group_name = "Sales Consultant";
	}
	echo "<tr class='pointer' onclick=location.href='" . $this->baseurl . "rep-listing-vic/rep-updatelist-vic?id={$record['id']}' ><td>{$record['name']}</td>" . "<td>{$record['username']}</td>" . "<td>{$record['email']}</td>" . "<td>{$record['Phone']}</td>" . "<td>{$record['Mobile']}</td>" . "<td>{$user_group_name}</td></tr>";
	*/

	$user_group_key = $custom_functions_user->getUserGroupKey($sel_user->groups);
	$user_group_name = $custom_configs_user['user_groups'][$user_group_key];

	$css_style_user_status = 'style="color: #008000;"';
	if (isset($record['block']) && $record['block'] == '1') {
		$css_style_user_status = 'style="color: #ff0000;"';
	}

	$output_record = true;
	if (isset($sel_user->groups['10']) && $current_signed_in_user_group_key != '10') {
		$output_record = false;
	}

	if ($output_record == true) {
		echo "<tr class='pointer' onclick=location.href='" . $this->baseurl . "rep-listing-vic/rep-updatelist-vic?id={$record['id']}' ><td {$css_style_user_status}>{$record['name']}</td>" . "<td>{$record['username']}</td>" . "<td>{$record['email']}</td>" . "<td>{$record['Phone']}</td>" . "<td>{$record['Mobile']}</td>" . "<td>{$user_group_name}</td></tr>";
	}
}

echo "</tbody></table>"; 
    
echo "<div class='pagination-layer'>";
pagination($page, $total_records, "name=$name&username=$username&email=$email&Phone=$phone&Mobile=$mobile&usertype=$usertype");
echo "</div>";
?>