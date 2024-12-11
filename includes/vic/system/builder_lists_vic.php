<?php
//our pagination function is now in this file
function pagination($current_page_number, $total_records_found, $query_string = null)
{
	$page = 1;
	
	echo "Page: ";
	
	for ($total_pages = ($total_records_found/NUMBER_PER_PAGE); $total_pages > 0; $total_pages--)
	{
		if ($page != $current_page_number)
			echo "<a href=\"" . "system-management-vic/builder-listing-vic" . "?page=$page" . (($query_string) ? "&$query_string" : "") . "\">";

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
<input type='button' class='add-btn' onclick=location.href='" . JURI::base() . "system-management-vic/builder-listing-vic/builder-vic' value='Add New'>
</div>";

//load the current paginated page number
$page = ($_GET['page']) ? $_GET['page'] : 1;
$start = ($page-1) * NUMBER_PER_PAGE;

/**
* if we used the search form use those variables, otherwise look for
* variables passed in the URL because someone clicked on a page number
**/
$search = $_POST['search_string'];
$sql = "SELECT * FROM ver_chronoforms_data_builder_vic WHERE 1=1";
$result = mysql_query($sql) or die(mysql_error());

if ($search)
	$sql .= " AND builder_name LIKE '%"  . $search .  "%'" . " OR builder_address1 LIKE '%"  . $search .  "%'" . " OR builder_contact LIKE '%"  . $search .  "%'" . " OR builder_wkphone LIKE '%"  . $search .  "%'";

	
//this return the total number of records returned by our query
$total_records = mysql_num_rows(mysql_query($sql));

//now we limit our query to the number of results we want per page
$sql .= " LIMIT $start, " . NUMBER_PER_PAGE;

/**
* Next we display our pagination at the top of our search results
* and we include the search words filled into our form so we can pass
* this information to the page numbers. That way as they click from page
* to page the query will pull up the correct results
**/
echo "<center><h1 class='search-records'>" . number_format($total_records) . " Records Found</h1></center>";
echo "<div class='pagination-layer'>";
pagination($page, $total_records, "builder_name=$builder_name&builder_address1=$builder_address1&builder_contact=$builder_contact&builder_wkphone=$builder_wkphone");
echo "</div>";

$loop = mysql_query($sql)
	or die ('cannot run the query because: ' . mysql_error());
	echo "<table class='listing-table table-bordered'><thead><th>Builder</th><th>Address</th><th>Contact</th><th>Phone</th></thead><tbody>";
while ($record = mysql_fetch_assoc($loop))
    echo "<tr class='pointer' onclick=location.href='" . $this->baseurl . "builder-listing-vic/builder-updatelist-vic?cf_id={$record['cf_id']}' ><td>{$record['builder_name']}</td> " . "<td>{$record['builder_address1']}</td>" . "<td>{$record['builder_contact']}</td>" . "<td>{$record['builder_wkphone']}</td></tr>";
    echo "</tbody></table>"; 
    
echo "<div class='pagination-layer'>";
pagination($page, $total_records, "builder_name=$builder_name&builder_address1=$builder_address1&builder_contact=$builder_contact&builder_wkphone=$builder_wkphone");
echo "</div>";