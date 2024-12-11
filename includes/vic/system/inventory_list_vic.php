<?php 

$sectionResult = null;
$section = "";
$category = "";
$description = "";
$uom = "";

if(isset($_POST['section']))
{
	$section = $_POST['section'];

	$sql = "SELECT category FROM  ver_chronoforms_data_inventory_vic AS inv   WHERE  inv.section='{$section}' GROUP BY category ";
	$sectionResult = mysql_query ($sql);
	  
}else{
	//category items if frame is the default selected.
	$section = "Frame";

	$sql = "SELECT category FROM  ver_chronoforms_data_inventory_vic AS inv   WHERE  inv.section='{$section}' GROUP BY category ";
	$sectionResult = mysql_query ($sql);
}

if(isset($_POST['category']))
{
	$category = $_POST['category'];
}
//our pagination function is now in this file
function pagination($current_page_number, $total_records_found, $query_string = null)
{
	$page = 1;
	
	echo "Page: ";
	
	for ($total_pages = ($total_records_found/NUMBER_PER_PAGE); $total_pages > 0; $total_pages--)
	{
		if ($page != $current_page_number)
			echo "<a href=\"" . "system-management-vic/inventory-listing-vic" . "?page=$page" . (($query_string) ? "&$query_string" : "") . "\">";

		if ($page == $current_page_number) {echo "<span class=\"current\">$page</span>";} else {echo "$page";}

		if ($page != $current_page_number)
			echo "</a>";

		$page++;
	}
}
 

define("NUMBER_PER_PAGE", 100); //number of records per page of the search results
$instance =& JURI::getInstance();
$url = JURI::getInstance()->toString();

//display the filter form
// <option value='Extras' ".($section=="Extras" ? "selected":"") .">Extras</option> 
// 		<option value='Downpipe' ".($section=="Vergola" ? "selected":"") .">Vergola</option>  
// 		<option value='Fixings' ".($section=="Extras" ? "selected":"") .">Extras</option>  
echo "<div class='search-listing'>

<form id='filter_form'  method='post' method='post' style='float:none; width:90%;'>
	<label>Section:</label> 
	<select name='section' id='select_section' style='font-size:14px; padding:4px;' onchange='document.getElementById(\"filter_form\").submit();'>
		<option value='Frame' ".($section=="Frame" ? "selected":"") .">Frame</option>  
		<option value='Fittings' ".($section=="Fittings" ? "selected":"") .">Fittings</option>
		<option value='Guttering' ".($section=="Guttering" ? "selected":"") .">Guttering</option>    
		<option value='Flashings' ".($section=="Flashings" ? "selected":"") .">Flashings</option> 
		<option value='Downpipe' ".($section=="Downpipe" ? "selected":"") .">Downpipe</option> 
		<option value='Vergola' ".($section=="Vergola" ? "selected":"") .">Vergola</option> 
		<option value='Misc' ".($section=="Misc" ? "selected":"") .">Misc</option>  
		<option value='Extras' ".($section=="Extras" ? "selected":"") .">Extras</option>   
		<option value='Disbursements' ".($section=="Disbursements" ? "selected":"") .">Disbursements</option>  
	</select> 
	<select name='category' id='select_category' style='font-size:14px; padding:4px; min-width:100px;' onchange='document.getElementById(\"filter_form\").submit();'>";
		echo "<option value=\"\"  >Select All</option>";
		while ($data = mysql_fetch_array($sectionResult)) 
		{
			echo "<option value=\"{$data['category']}\" ".($data["category"]==$category ? "selected":"")." >{$data['category']}</option>";
		}	
	echo"
	</select> 
	<input type='submit' name='filter_item' id='filter_item' value='Filter' class='search-btn' onclick='document.getElementById(\"filter_form\").submit();'  />
</form>

</div>";

//display the search form
echo "<div class='search-listing'>
<form action='" . JRoute::_($url) . "' method='post' style='float:none; width:90%;'>
	<label>Search:</label> <input type='text' name='search_string' /> <input type='submit' name='submit' value='Search' class='search-btn' style='width:217px;' />
	<input type='button' class='add-btn' onclick=location.href='" . JURI::base() . "system-management-vic/inventory-listing-vic/inventory-updatelist-vic' value='Add New'>
</form>

</div>";

//load the current paginated page number
$page = (isset($_GET['page'])) ? $_GET['page'] : 1;
$start = ($page-1) * NUMBER_PER_PAGE;

/**
* if we used the search form use those variables, otherwise look for
* variables passed in the URL because someone clicked on a page number
**/
$search = (isset($_POST['search_string'])?$_POST['search_string']:"");
$sql = "SELECT * FROM ver_chronoforms_data_inventory_vic WHERE 1=1 ";
$result = mysql_query($sql) or die(mysql_error());

if ($search){
	$sql .= " AND section LIKE '%"  . $search .  "%'" . " OR category LIKE '%"  . $search .  "%'" . " OR description LIKE '%"  . $search .  "%'" . " OR uom LIKE '%"  . $search .  "%' ";
}
//$sql .= " AND section='{$section}' ";
if(strlen($section)>0){
	if(strlen($category)>0){
		$sql .= " AND section='{$section}' AND category='{$category}' "; 
	}else{
		$sql .= " AND section='{$section}' ";
	}
}

//this return the total number of records returned by our query
$total_records = mysql_num_rows(mysql_query($sql));

//now we limit our query to the number of results we want per page
$sql .= " ORDER BY section ASC, category ASC, description ASC LIMIT $start, " . NUMBER_PER_PAGE;

/**
* Next we display our pagination at the top of our search results
* and we include the search words filled into our form so we can pass
* this information to the page numbers. That way as they click from page
* to page the query will pull up the correct results
**/
//echo "<center><h1 class='search-records'>" . number_format($total_records) . " Records Found</h1></center>";
echo "<div class='pagination-layer'>";
pagination($page, $total_records, "section=$section&category=$category&description=$description&uom=$uom");
echo "</div>";

$loop = mysql_query($sql)
	or die ('cannot run the query because: ' . mysql_error());
	echo "<table class='listing-table table-bordered'><thead><th>Section</th><th>Category</th><th>Description</th><th>UOM</th></thead><tbody>";
while ($record = mysql_fetch_assoc($loop)){
    echo "<tr class='pointer' onclick=location.href='" . JURI::base() . "system-management-vic/inventory-listing-vic/inventory-updatelist-vic?inventoryid={$record['inventoryid']}' >";
		echo "<td>{$record['section']}</td> " . "<td>{$record['category']}</td>" . "<td>{$record['description']} </td>" . "<td>{$record['uom']}</td>";
	echo "</tr>";
	echo "<tr></tr>";
}		
    echo "</tbody></table>"; 
    
echo "<div class='pagination-layer'>";
pagination($page, $total_records, "section=$section&category=$category1&description=$description&uom=$uom");
echo "</div>";
