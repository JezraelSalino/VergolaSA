<?php



//error_log(print_r($_POST,true), 3,'C:\\xampp\htdocs\\vergola_contract_system_v3\\my-error.log'); 

if(isset($_POST['command']) && $_POST['command']=='update'){
	$id = mysql_real_escape_string($_POST['id']);
	$desc = mysql_real_escape_string($_POST['desc']);
	$qty = mysql_real_escape_string($_POST['qty']);
	$price = mysql_real_escape_string($_POST['price']);
	$supplierid = mysql_real_escape_string($_POST['supplierid']);

	$sql = "UPDATE ver_chronoforms_data_materials_vic SET raw_description='{$desc}', qty={$qty}, raw_cost={$price}, supplierid='{$supplierid}' WHERE cf_id={$id} ";
	//error_log($sql, 3,'C:\\xampp\htdocs\\vergola_contract_system_v3\\my-error.log'); 
	mysql_query($sql);

	 $arr = array ('message'=>'successfully update','result'=>'1');

  
    echo json_encode($arr);
    exit();

}


//begin add section and category search filter
$sectionResult = null;
$section = "";
$category = "";
$description = "";
$uom = "";

if(isset($_POST['section']))
{
	$section = $_POST['section'];

	$sql = "SELECT inv.category FROM  ver_chronoforms_data_materials_vic AS m LEFT JOIN ver_chronoforms_data_inventory_vic AS inv ON inv.cf_id = m.cf_id   WHERE  inv.section='{$section}' GROUP BY inv.category ";
	$sectionResult = mysql_query ($sql);
	  
}else{
	//category items if frame is the default selected.
	$section = "Frame";

	$sql = "SELECT inv.category FROM  ver_chronoforms_data_materials_vic AS m LEFT JOIN ver_chronoforms_data_inventory_vic AS inv ON inv.cf_id = m.cf_id  WHERE  inv.section='{$section}' GROUP BY inv.category ";
	$sectionResult = mysql_query ($sql);
}

if(isset($_POST['category']))
{
	$category = $_POST['category'];
}
//end add section and category search filter

 
//our pagination function is now in this file
function pagination($current_page_number, $total_records_found, $query_string = null)
{
	$page = 1; 
	echo "Page: ";
	
	for ($total_pages = ($total_records_found/NUMBER_PER_PAGE); $total_pages > 0; $total_pages--)
	{
		if ($page != $current_page_number)
			// echo "<a href=\"" . "migrated-external/system-management-vic/raw-material-listing-ext" . "?page=$page" . (($query_string) ? "&$query_string" : "") . "\">";
			echo "<a href=\"" . "migrated-external/raw-material-listing-ext" . "?page=$page" . (($query_string) ? "&$query_string" : "") . "\">";

		if ($page == $current_page_number) {echo "<span class=\"current\">$page</span>";} else {echo "$page";}

		if ($page != $current_page_number)
			echo "</a>";

		$page++;
	}
}
 

define("NUMBER_PER_PAGE", 200); //number of records per page of the search results
$instance =& JURI::getInstance();
$url = JURI::getInstance()->toString();
 
//Display the category section filters
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
	<input type='button' class='add-btn' onclick=location.href='" . JURI::base() . "migrated-external/raw-material-listing-ext/raw-material-ext' value='Add New'>
</form> 
</div>";

//load the current paginated page number
$page = ($_GET['page']) ? $_GET['page'] : 1;
$start = ($page-1) * NUMBER_PER_PAGE;

/**
* if we used the search form use those variables, otherwise look for
* variables passed in the URL because someone clicked on a page number
**/
$search = (isset($_POST['search_string'])?$_POST['search_string']:"");
// $search = $_POST['search_string'];
$sql = "SELECT *, m.cf_id AS materialid FROM ver_chronoforms_data_materials_vic AS m LEFT JOIN ver_chronoforms_data_supplier_vic AS s ON s.supplierid=m.supplierid LEFT JOIN ver_chronoforms_data_inventory_vic AS inv ON inv.cf_id = m.cf_id  WHERE 1=1 ";
$result = mysql_query($sql) or die(mysql_error());

if ($search){
	// $sql .= " AND raw_description LIKE '%"  . $search .  "%'" . " ";
	$sql .= " AND section LIKE '%"  . $search .  "%'" . " OR category LIKE '%"  . $search .  "%'" . " OR raw_description LIKE '%"  . $search .  "%'" . " OR uom LIKE '%"  . $search .  "%' ";
}

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
// $sql .= " ORDER BY raw_description ASC  LIMIT $start, " . NUMBER_PER_PAGE;

//error_log($sql, 3,'C:\\xampp\htdocs\\vergola_contract_system_v3\\my-error.log');
/**
* Next we display our pagination at the top of our search results
* and we include the search words filled into our form so we can pass
* this information to the page numbers. That way as they click from page
* to page the query will pull up the correct results
**/
//echo "<center><h1 class='search-records'>" . number_format($total_records) . " Records Found</h1></center>";
echo "<div class='pagination-layer'>";
// pagination($page, $total_records, "");
pagination($page, $total_records, "section=$section&category=$category&description=$description&uom=$uom");
echo "</div>";

$result = mysql_query("SELECT * FROM ver_chronoforms_data_supplier_vic "); 
$suppliers = array();
$cbo_suppliers = "<select class='cbo_suppliers' style='padding:3px; margin:0 0 0 10px; display:none;' >";
while ($row = mysql_fetch_assoc($result)) { 
  $cbo_suppliers .= "<option value='{$row['supplierid']}' >{$row['company_name']}</option>"; 
} 
$cbo_suppliers .="</select>";


$loop = mysql_query($sql)
	or die ('cannot run the query because: ' . mysql_error());
	echo $cbo_suppliers;
	echo "<table class='listing-table table-bordered'>";
	echo "<thead> <th>Section</th><th>Category</th><th width='65%'>Description</th> <th width='5%'>Qty</th> <th width='7%'>Cost</th><th width='20%'>Supplier</th><th width='3%'>Action</th> </thead><tbody>";
	$i=0;
	while ($record = mysql_fetch_assoc($loop)){
	    // echo "<tr class='pointer' onclick=location.href='" . $this->baseurl . "raw-material-listing-vic/raw-material-updatelist-vic?cf_id={$record['cf_id']}' >";
    
		echo "<tr>
			<td>{$record['section']}</td> " . "<td>{$record['category']}</td>
			<td class='td_desc'>
				<input type='text' value='{$record['raw_description']}' style='display:none; padding:5px; width:80%;'/>  <span style='display:inline; cursor:pointer;' onclick='location.href = \"".JURI::base()."migrated-external/raw-material-listing-ext/raw-material-ext?cf_id={$record["materialid"]}\"' >{$record['raw_description']}</span></a> 
			</td> 
			<td class='td_qty'>
				<input type='text' value='{$record['qty']}' style='display:none; padding:5px;'  /><span style='display:inline;'>{$record['qty']}</span> 
			</td>
			<td class='td_price'><input type='text' value='{$record['raw_cost']}' style='display:none; padding:5px;'  /><span style='display:inline;'>{$record['raw_cost']}</span> </td>
			<td class='td_supplier'> 
				<input type='hidden' value='{$record['supplierid']}' /> <span style='display:inline;'>{$record['company_name']}</span> 
			</td> 
			<td class='td_id'>
				<span class='btn_edit' style='color:#02628f; cursor:pointer;  '/>Edit</span> <input type='hidden' value='{$record['materialid']}' /> 
			</td> 
			</tr>"; 

		$i++;
	}
	    echo "</tbody></table>"; 
    
echo "<div class='pagination-layer'>";
pagination($page, $total_records, " ");
echo "</div>";

?>

<script charset="UTF-8" type="text/javascript" src="<?php echo JURI::base().'jscript/datetime/js/jquery-1.8.3.min.js'; ?>"></script> 
<script src="<?php echo JURI::base().'jscript/jquery-ui-1.11.4/jquery-ui.min.js'; ?>"></script>

 <script>
 $(document).ready(function(){  
 	$(".btn_edit").click(function(){
 		//alert($(this).html());  
 		//alert($(this).parent().parent().children('.td_desc').children('span').html());
 		if($(this).html()=='Update'){ 
 			$(this).html('Edit');	
 			var url = "";
 			var id = $(this).parent().parent().children('.td_id').children('input').val();
 			var desc = $(this).parent().parent().children('.td_desc').children('input').val();
 			var qty = $(this).parent().parent().children('.td_qty').children('input').val();
 			var price = $(this).parent().parent().children('.td_price').children('input').val(); 
 			var supplierid = $('#supplierid option:selected').val();
 			var supplier_name = $('#supplierid option:selected').text();

 			var command = 'update';

 			//alert(id);


 			$.ajax({
				type: "POST",
				url: url,
				dataType: 'json', 	
				data: {id:id, desc:desc, qty:qty, price:price, supplierid:supplierid, command:command},	
				success: function(data) {					
					 if(data['result']=='1'){
					  
					 }else{
					 	alert('Error.. Something went wrong.'); 
					 }
					//window.location.href = redirect;  
				}		
			});

			$(this).parent().parent().children('.td_desc').children('span').html(desc);
			$(this).parent().parent().children('.td_qty').children('span').html(qty);
			$(this).parent().parent().children('.td_price').children('span').html(price);
			$(this).parent().parent().children('.td_supplier').children('span').html(supplier_name);
			$("#supplierid").remove();

 		}else{
 			//alert($(this).html());  
 			$(this).html('Update');
 			var supplierid = $(this).parent().parent().children('.td_supplier').children('input').val();

 			//$(".cbo_suppliers").val(supplierid).prop('selected', true);
 			$(".cbo_suppliers").clone().attr("id","supplierid").val(supplierid).show().appendTo($(this).parent().parent().children('.td_supplier'));
 		}
 		
	 	$(this).parent().parent().children('.td_desc').children('input').toggle();
	 	$(this).parent().parent().children('.td_qty').children('input').toggle();
	 	$(this).parent().parent().children('.td_price').children('input').toggle();


	 	$(this).parent().parent().children('.td_desc').children('span').toggle();
	 	$(this).parent().parent().children('.td_qty').children('span').toggle();
	 	$(this).parent().parent().children('.td_price').children('span').toggle();
	 	$(this).parent().parent().children('.td_supplier').children('span').toggle();

	 	
	 	  
	 	
	 });
 });

</script>