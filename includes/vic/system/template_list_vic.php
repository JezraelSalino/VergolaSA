<?php
function pagination($current_page_number, $total_records_found, $query_string = null)
{
	$page = 1;
	
	echo "Page: ";
	
	for ($total_pages = ($total_records_found/NUMBER_PER_PAGE); $total_pages > 0; $total_pages--)
	{
		if ($page != $current_page_number)
			echo "<a href=\"" . "system-management-vic/template-listing-vic" . "?page=$page" . (($query_string) ? "&$query_string" : "") . "\">";

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
	Search: <input type='text' name='search_string' /> <input type='submit' name='submit' value='Search' class='search-btn' />
</form>
<input type='button' class='add-btn' onclick=location.href='" . JURI::base() . "system-management-vic/template-listing-vic/template-manage-vic?module=template&default_content_category=Template' value='Add New'>
</div>";

//load the current paginated page number
$page = ($_GET['page']) ? $_GET['page'] : 1;
$start = ($page-1) * NUMBER_PER_PAGE;

/**
* if we used the search form use those variables, otherwise look for
* variables passed in the URL because someone clicked on a page number
**/
$search = $_POST['search_string'];
$sql = "
	SELECT 
		document_handler_entity.id AS 'document_handler_entity_id', 
		document_handler_entity.name AS 'document_handler_entity_name', 
		document_handler_folder.id AS 'document_handler_folder_id', 
		document_handler_folder.name AS 'document_handler_folder_name', 
		document_handler_file.id AS 'document_handler_file_id', 
		document_handler_file.name AS 'document_handler_file_name', 
		document_handler_file.status AS 'document_handler_file_status' 
	FROM document_handler_entity 
		LEFT JOIN document_handler_entity_folder 
			ON document_handler_entity.id = document_handler_entity_folder.entity_id 
		LEFT JOIN document_handler_folder 
			ON document_handler_entity_folder.folder_id = document_handler_folder.id 
		LEFT JOIN document_handler_folder_file 
			ON document_handler_folder.id = document_handler_folder_file.folder_id 
		LEFT JOIN document_handler_file 
			ON document_handler_folder_file.file_id = document_handler_file.id 
	WHERE document_handler_entity.date_deleted IS NULL 
	AND document_handler_entity_folder.date_deleted IS NULL 
	AND document_handler_folder.date_deleted IS NULL 
	AND document_handler_folder_file.date_deleted IS NULL 
	AND document_handler_file.date_deleted IS NULL 
	AND document_handler_entity.module = 'template' 
	AND document_handler_entity_folder.module = 'template' 
	AND document_handler_file.content_category = 'Template' 
	ORDER BY document_handler_entity.id, document_handler_folder.id, document_handler_file.id 
";
$result = mysql_query($sql) or die(mysql_error());

if ($search)
	$sql .= " 
		AND ( 
			document_handler_entity.name LIKE '%"  . $search .  "%' 
			OR document_handler_folder.name LIKE '%"  . $search .  "%' 
			OR document_handler_file.name LIKE '%"  . $search .  "%' 
		) 
	";
	
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
pagination($page, $total_records, "lead=$lead");
echo "</div>";

$loop = mysql_query($sql)
	or die ('cannot run the query because: ' . mysql_error());
	echo "<table class='listing-table table-bordered'><thead><tr><th>Sections</th><th>Categories</th><th>Templates</th><th>Status</th></tr></thead><tbody>";
while ($record = mysql_fetch_assoc($loop))
    echo "<tr class='pointer' onclick=location.href='" . $this->baseurl . "template-listing-vic/template-manage-vic?module=template&default_entity_id={$record['document_handler_entity_id']}&default_folder_id={$record['document_handler_folder_id']}&default_file_id={$record['document_handler_file_id']}&default_content_category=Template'><td>{$record['document_handler_entity_name']}</td><td>{$record['document_handler_folder_name']}</td><td>{$record['document_handler_file_name']}</td><td>{$record['document_handler_file_status']}</td></tr>";
    echo "</tbody></table>"; 
    
echo "<div class='pagination-layer'>";
pagination($page, $total_records, "lead=$lead");
echo "</div>";