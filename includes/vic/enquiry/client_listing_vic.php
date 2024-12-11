<script src="<?php echo JURI::base().'jscript/jsapi.js'; ?>"></script>
<script type="text/javascript">google.load("jquery", "1");</script>
<script src="<?php echo JURI::base().'jscript/labels.js'; ?>"></script>
<link rel="stylesheet" type="text/css" media="screen,projection" href="<?php echo JURI::base().'jscript/custom.css'; ?>" />
<link rel="stylesheet" type="text/css" media="screen,projection" href="<?php echo JURI::base().'jscript/advance-search.css'; ?>" />

<?php

//error_log("start php: ".microtime(true), 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_sa\\my-error.log');
$user =& JFactory::getUser(); 
$is_builder = 0; 

$page_name = "";
$request = parse_url($_SERVER['REQUEST_URI']);
$page_name = substr($request["path"],1); 
//error_log($page, 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_sa\\my-error.log');
$showcontact =  "hide"; 
if($page_name == "new-builder-enquiry-vic" || $page_name == "builder-listing-vic"){
  $is_builder = 1;
  $showcontact =  ""; 
}else if(isset($_REQUEST['client_type']) && $_REQUEST['client_type']=="b"){
    $is_builder = 1;
    $showcontact =  ""; 
}


//our pagination function is now in this file
function pagination($current_page_number, $total_records_found, $query_string = null)
{
	$page = 1;	
	echo "Page: ";
	
	for ($total_pages = ($total_records_found/NUMBER_PER_PAGE); $total_pages > 0; $total_pages--)
	{
		if ($page != $current_page_number)
			echo "<a href=\"" . "client-listing-vic" . "?page=$page" . (($query_string) ? "&$query_string" : "") . "\">";

		if ($page == $current_page_number) {echo "<span class=\"current\">$page</span>";} else {echo "$page";}


		if ($page != $current_page_number)
			echo "</a>";

		$page++;
	}
	
}


$is_admin = 0;
define("NUMBER_PER_PAGE", 75); //number of records per page of the search results
$url = JURI::base().'client-listing-vic';
//display the search form


//load the current paginated page number
$page = 1;
$start = ($page-1) * NUMBER_PER_PAGE;
 

if(isset($user->groups['9'])){
	$is_admin = 0;
}else{
	$is_admin = 1;
}

$is_office_admin = 0;
if(isset($user->groups['26'])){
	$is_office_admin = 1;
}
 
/**
* if we used the search form use those variables, otherwise look for
* variables passed in the URL because someone clicked on a page number
**/
if (!isset($url)) $url ='';
if (!isset($search)) $search ='';
if (!isset($rep_name)) $rep_name = '';
if (!isset($suburb_name)) $suburb_name= '';
if (!isset($frdate)) $frdate =''; 
if (!isset($todate)) $todate = '';
if (!isset($rep_id)) $rep_id = '';
if (!isset($advance_search)) $advance_search = 0;
if (!isset($is_quoted)) $is_quoted = 0;
if (!isset($c_status)) $c_status = '';
if (!isset($c_status)) $c_status = '';
if (!isset($search_ID)) $search_ID = '';
if (!isset($default_18mon)) $default_18mon = 1;


$paging_url = "";  
$search_string = "";
$suburb_filter = "";
$date_filter = "";

//error_log(" _POST: ".print_r($_POST,true), 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_sa\\my-error.log');
//error_log(" _REQUEST: ".print_r($_REQUEST,true), 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_sa\\my-error.log');

if(isset($_REQUEST['submit']) || isset($_REQUEST['search'])){ 
	$default_18mon = 0;  // should be default to 0 when searching!
	
	if(isset($_POST['search_string'])){ $search_string = trim($_POST['search_string']); } 

	if(isset($_POST['suburblist'])){ $suburb_name = $_POST['suburblist']; } 

	if(isset($_POST['is_quoted'])){ $is_quoted = $_POST['is_quoted']; } 

	if(isset($_POST['c_status'])){ $c_status = $_POST['c_status']; } 

	if(isset($_POST['frdate'])){ $frdate = $_POST['frdate']; }

	if(isset($_POST['default_18mon'])){ $default_18mon = $_POST['default_18mon']; }

	if(isset($_POST['todate'])){ $todate = $_POST['todate']; }

	if(isset($_POST['replist'])){ $rep_id = $_POST['replist']; }

	if(isset($_POST['advance_search'])){ $advance_search = $_POST['advance_search']; }

	if(isset($_POST['search_ID'])){ $search_ID = $_POST['search_ID']; }

	// if($advance_search==1){
	// 	$default_18mon = 1;
	// }

	//error_log(" search_string".$search_string, 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_sa\\my-error.log');
	//error_log(" _REQUEST 1: ".print_r($_REQUEST,true), 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_sa\\my-error.log');

}else{
	//$default_18mon = 1;
	//error_log("paging", 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_sa\\my-error.log');
	//error_log(" _REQUEST 2: ".print_r($_REQUEST,true), 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_sa\\my-error.log');
	if(isset($_REQUEST['search_string'])){ $search_string = trim($_REQUEST['search_string']); } 

	if(isset($_REQUEST['suburblist'])){ $suburb_name = $_REQUEST['suburblist']; } 

	if(isset($_REQUEST['is_quoted'])){ $is_quoted = $_REQUEST['is_quoted']; } 

	if(isset($_REQUEST['c_status'])){ $c_status = $_REQUEST['c_status']; } 

	if(isset($_REQUEST['frdate'])){ $frdate = $_REQUEST['frdate']; }

	if(isset($_REQUEST['default_18mon'])){ $default_18mon = $_REQUEST['default_18mon']; }

	if(isset($_REQUEST['todate'])){ $todate = $_REQUEST['todate']; }

	if(isset($_REQUEST['rep_id'])){ $rep_id = $_REQUEST['rep_id']; }

	if(isset($_REQUEST['advance_search'])){ $advance_search = $_REQUEST['advance_search']; }

	if(isset($_REQUEST['search_ID'])){ $search_ID = $_REQUEST['search_ID']; }

	$page = isset($_GET['page']) ? $_GET['page'] : 1;
	$start = ($page-1) * NUMBER_PER_PAGE;

	// if($advance_search==1){
	// 	$default_18mon = 1;
	// }
	//error_log(print_r($_GET,true), 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_sa\\my-error.log');
	//error_log("page: ".$page, 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_sa\\my-error.log');

	//error_log("start: ".$start, 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_sa\\my-error.log');
	//error_log("search: ".$search." END", 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_sa\\my-error.log');
}

  

// if($is_admin==0){
// 	$rep_id = $user->RepID;
// }else{
// 	if(isset($_REQUEST['replist'])){ $rep_id = $_REQUEST['replist']; }
// }
//error_log(print_r($_POST,true), 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_sa\\my-error.log');

//-------------------------------- Paging Parameter --------------------------------


if($search_string){
	$paging_url .= "&search_string=".$search_string;
}

if($rep_id){
	$paging_url .= "&rep_id=".$rep_id; 
}	

if ($frdate && $todate){
	$paging_url .= "&frdate=".$frdate."&todate=".$todate;
}

if ($default_18mon){ //error_log("default_18mon:".$default_18mon, 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_sa\\my-error.log');
	$paging_url .= "&default_18mon=1";
}else{
	$paging_url .= "&default_18mon=0";
}


if($suburb_name){ 
	$paging_url .= "&suburb_name=".$suburb_name;
}

if($is_quoted){
	$paging_url .= "&is_quoted=1";
}

if($c_status){
	$paging_url .= "&c_status=".$c_status;
}

if($advance_search){
	$paging_url .= "&advance_search=1";
}

if($is_builder){
	$paging_url .= "&client_type=b";
}

if($rep_id){
	$paging_url .= "&rep_id=".$rep_id;
} 

if($search_ID){
	$paging_url .= "&search_ID=".$search_ID;
} 
  
//-------------------------------- END Paging Parameter --------------------------------
 

//error_log("is_builder:".$is_builder, 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_sa\\my-error.log');
// $url_filter = "";
// if($is_builder){
// 	$url_filter = "?client_type=b";
// } 
//action=\"" . JRoute::_($url) . "{$url_filter}\"

echo "<div class='search-listing'>
<form   method=\"post\" id=\"chronoform_Listing_Module\" class='Chronoform hasValidation' style='float:none; width:90%'>
	<label>Search:</label> <input type='text' name='search_string' value='{$search_string}' /> <input type='submit' name='search' value='Search' class='search-btn' id='btn_search' />";
if($advance_search==1){
	echo "<input type='button' id='advlist1' class='advance-search' value='Advance Search'>";
	echo "<input type='button' id='advlist2' class='advance-search' value='Advance Search'>";
	 
}else{
	echo "<input type='button' id='advlist1' class='advance-search' value='Advance Search'>";
	echo "<input type='button' id='advlist2' class='advance-search' value='Advance Search'>";
}	
echo "<input type='submit' id='download_pdf' class='advance-search' value='Download PDF' name='download_pdf'>";
 
echo "<label for='chk_default_18mon' id='lbl_default_18mon'><input type='checkbox' name='default_18mon' id='chk_default_18mon' ".($default_18mon==1?'checked':'')." value='1' style='height:14px; margin:0 5px 0 15px; padding:0; width:14px; vertical-align:middle;'   />Last 18 months </label>";
 
echo "<input type='hidden' name='advance_search' id='advance_search' value='{$advance_search}' />";

echo "<div id='advance-search' style='display:".($advance_search==1?'block':'none')."'>  
<!-- Start of Advance Search   onclick='$(\"#btn_search\").click(); '  --->
<!-- Start of Rep List --->
<label class='input' ". (isset($user->groups["9"]) ? "style='display:none;'":"") ."> ". (isset($user->groups["9"])==false && $rep_id==""? "<span>Consultant</span>":"") ." <select class=\"rep-list\" id=\"replist\" name=\"replist\"><option value=''></option>";
            $usergroup = 'Victoria Users';
            $queryrep="SELECT * FROM ver_users WHERE usertype = 'Victoria Users' AND block=0 ORDER BY name ASC";
            $resultrep = mysql_query($queryrep);
            if(!$resultrep){die ("Could not query the database: <br />" . mysql_error());
			}
			
			if(isset($user->groups['9'])){
				echo "<option value = '{$user->RepID}' selected>{$user->name}</option>";
				$is_admin = 0;
			}else{
 
			  while ($data=mysql_fetch_assoc($resultrep)){
			  		if($data['RepID']==$rep_id){
			  			echo "<option value = '{$data['RepID']}' selected>{$data['name']}</option>";
			  		}else{
	                  	echo "<option value = '{$data['RepID']}'>{$data['name']}</option>";
	                }
		        }
		        $is_admin = 1;
 			}

echo "</select></label>
<input type='hidden' name='rep_name' value='' />

<!-- Start of Suburb -->
<label class='input'>".($suburb_name==''?"<span id='suburbspan'>Suburb</span>":"")."<select class=\"suburb-list\" id=\"suburblist\" name=\"suburblist\"><option></option>";
      
            $querysub="SELECT suburb FROM ver_chronoforms_data_suburbs_vic  GROUP BY suburb ORDER BY suburb ASC";

            $resultsub = mysql_query($querysub);
            if(!$resultsub){die ("Could not query the database: <br />" . mysql_error());
			}
			
		  	while ($data=mysql_fetch_assoc($resultsub)){
		  		if($data['suburb']==$suburb_name){
	              	echo "<option value = '{$data['suburb']}' selected>{$data['suburb']}</option>";
	            }else{
	            	echo "<option value = '{$data['suburb']}'>{$data['suburb']}</option>";
	            }
	        }
echo "</select></label>";

echo "<label class='input'><select class=\"\"  name=\"c_status\">
	<option value='Show All' ".($c_status=='Show All'?"selected":"").">Show All</option> 
	<option value='Enquiry' ".($c_status=='Enquiry'?"selected":"").">Open Enquiry</option>
	<!-- <option value='Quoted' ".($c_status=='Quoted'?"selected":"").">Quoted</option> --> 
	<option value='Costed' ".($c_status=='Costed'?"selected":"").">Costed</option>  
	<option value='Not Interested' ".($c_status=='Not Interested'?"selected":"").">Not Interested</option>  
	<option value='Under Consideration' ".($c_status=='Under Consideration'?"selected":"").">Under Consideration</option> 
	<option value='Future Project' ".($c_status=='Future Project'?"selected":"").">Future Project</option> 
	<option value='Won' ".($c_status=='Won'?"selected":"").">Won</option> 
	<option value='Lost' ".($c_status=='Lost'?"selected":"").">Lost</option> 
	"; 
echo "</select></label>";

echo " 
	 <label class='input'><span>CR</span><input type='input' name='search_ID' value='".($search_ID!=''?$search_ID:"")."' style='border:1px solid #7C7D7F;' ></label>"; 
	  

        //onclick='$(\"#is_search_ID\").val(\"1\"); $(\"#btn_advance_search\").click();'

//error_log("todate: ".$todate, 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_sa\\my-error.log');
  
echo "  
<div id='searchdate'>
<div>
<span>From Date</span><br />
<input type='text' id='frdate' name='frdate' class='date_entered' value='".$frdate."'>
</div>
<div>
<span>To Date</span><br />
<input type='text' id='todate' name='todate' class='date_entered' value='".$todate."'></div>
<div>
<input type='submit' name='submit' value='Search' class='search-btn' id='btn_advance_search' />
</div>
</div>

<!-- End of Advance Search --->
</div>

</form>

</div>"; 
 

if($is_builder){
	$builder_filter = " AND c.is_builder=1 ";
}else{
	$builder_filter = " AND c.is_builder=0 ";
}

if ($suburb_name)
	$suburb_filter = " AND ((client_suburb LIKE '%" . mysql_real_escape_string($suburb_name) . "%') OR (site_suburb LIKE '%" . mysql_real_escape_string($suburb_name) . "%')) ";
	// $suburb_filter = " AND client_suburb LIKE '%" . mysql_real_escape_string($suburb_name) . "%'";

if (strlen($frdate)>0 && strlen($todate)>0)
	$date_filter = " AND datelodged BETWEEN '" .  $frdate . "'" . " AND '" . $todate . "'";

if ($default_18mon==1)
	$default_18month_filter = " AND datelodged BETWEEN DATE_ADD(NOW(),INTERVAL -18 MONTH) AND DATE_ADD(NOW(),INTERVAL 1 DAY) ";
  

$search_string_filter = "";
if ($search_string){
	// $search_string_filter .= " AND (CONCAT(c.client_firstname,' ',c.client_lastname) LIKE '%"  . $search_string .  "%'" . 
	// " OR c.builder_name LIKE '%"  . $search_string .  "%')";

	$search_string_filter .= " AND ( " . 
		" CONCAT(c.client_firstname,' ',c.client_lastname) LIKE '%"  . $search_string .  "%' " . 
		" OR c.builder_name LIKE '%"  . $search_string .  "%' " . 
		" OR c.clientid LIKE '%"  . $search_string .  "%' " .
		" OR c.client_address1 LIKE '%"  . $search_string .  "%' " . 
		" OR c.client_address2 LIKE '%"  . $search_string .  "%' " .
		" OR c.client_suburb LIKE '%"  . $search_string .  "%' " .
		" OR c.client_state LIKE '%"  . $search_string .  "%' " .
		" OR c.client_postcode LIKE '%"  . $search_string .  "%' " .
		" OR c.client_hmphone LIKE '%"  . $search_string .  "%' " .
		" OR c.client_mobile LIKE '%"  . $search_string .  "%' " . 
	" ) ";
}

//error_log(" search_string: ".$search_string, 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_sa\\my-error.log');

$rep_filter = " ";
$rep_filter2 = " ";
$rep_filter3 = " ";
if($is_admin ){

	if($rep_id!=""){  
		$rep_filter .= " AND repident='{$rep_id}' ";
		$rep_filter2 .= " AND rep_id='{$rep_id}' "; 
	}

	if($is_office_admin){
		$rep_filter2 .= " AND status='QUOTED'  "; 
	}

	$rep_filter3 .= "  "; //AND f.cf_id IS NOT NULL
}
else{
	 
	$rep_filter .= " AND repident='{$user->RepID}' ";
	$rep_filter2 = " AND rep_id='{$user->RepID}' ";
	 
} 

// $is_quoted_filter = "";
// if($is_quoted=="1"){
// 	$is_quoted_filter = " AND c.qdelivered IS NOT NULL ";
// }

$c_status_filter = "";
$c_status_filter_a = ""; //same filter but in different table query.
//error_log("c_status: ".$c_status, 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_sa\\my-error.log');
if(strlen($c_status)>0 && $advance_search==1){
	
	if($c_status=="Show All"){
		$c_status_filter_a = "";
	}else if ($c_status=="Enquiry") {
		// $c_status_filter_a = "AND c.qdelivered IS NULL AND status != 'Not Interested' AND status != 'Won' AND status != 'Lost' AND status != 'Quoted' AND status != 'Costed' AND status != 'Under Consideration' AND status != 'Future Project' AND status IS NULL";	
		// $c_status_filter_a = " AND c.qdelivered IS NULL AND status = ''";
		// $c_status_filter_a = " AND c.qdelivered IS NULL AND status IS NULL AND appointmentdate IS NULL";
		// $c_status_filter_a = "";
		$c_status_filter_a = " 	AND (c.status IS  NULL OR c.status = '')";
	}else if ($c_status=="Costed") {
		$c_status_filter = " 	AND (total_cost IS NOT NULL OR total_cost > 0.00)";	
	}else{
		$c_status_filter = " AND status='".$c_status."' ";
	}

	if($search_ID!=""){ 
		$c_status_filter_a .= " AND c.clientid LIKE '%"  . $search_ID .  "%'";
	}

}

  
// $sql = "SELECT *, c.clientid AS id, CONCAT(c.client_firstname,' ',c.client_lastname) AS client_name, c.site_address1, c.builder_name,n.content AS note  FROM (SELECT * FROM ver_chronoforms_data_clientpersonal_vic AS c WHERE  1=1 {$builder_filter} {$rep_filter} {$suburb_filter} {$date_filter} {$search_string_filter} {$is_quoted_filter} ) AS c LEFT JOIN (SELECT * FROM (SELECT * FROM ver_chronoforms_data_followup_vic WHERE 1=1 {$rep_filter2}  ORDER BY updated_at DESC, cf_id DESC) as f0  GROUP BY quoteid ) AS f ON f.quoteid=c.clientid LEFT JOIN (SELECT * FROM ver_chronoforms_data_notes_vic WHERE cf_id IN (SELECT MAX(cf_id) as max_id FROM ver_chronoforms_data_notes_vic GROUP BY clientid)) as n ON n.clientid=c.clientid WHERE 1=1  {$rep_filter3} ";

$sql = "
	SELECT 
		*, 
		c.clientid AS id, 
		CONCAT(c.client_firstname,' ',c.client_lastname) AS client_name, 
		c.site_sitename,
		c.site_streetno,
		c.site_streetname,
		c.site_address1, 
		c.site_address2, 
		c.site_suburb, 
		c.client_state, 
		c.client_postcode, 
		c.builder_name, 
		c.builder_contact_title,
		c.builder_contact_firstname,
		c.builder_contact_lastname,
		f.status as followup_status_, 
		IFNULL(f.status, c.status) AS `followup_status`,
		n.content AS note 
	FROM (
		SELECT * 
		FROM ver_chronoforms_data_clientpersonal_vic AS c 
		WHERE c.deleted_at is null 
		AND 1=1 
		{$builder_filter} 
		{$rep_filter} 
		{$suburb_filter} 
		{$date_filter} 
		{$default_18month_filter} 
		{$search_string_filter} 
		{$c_status_filter_a} 
	) AS c 
	".((strlen($search_string_filter)>0 || $c_status=="Show All" || $c_status=="Enquiry" || $advance_search==0)?" LEFT ":"")." JOIN (
			SELECT * 
			FROM (
				SELECT * 
				FROM ver_chronoforms_data_followup_vic WHERE 
				updated_at IN (SELECT max(updated_at) FROM ver_chronoforms_data_followup_vic GROUP BY quoteid)
				AND 1=1 
				{$rep_filter2} 
				{$c_status_filter} 
				ORDER BY updated_at DESC, cf_id DESC 
			) as f0 
			GROUP BY quoteid 
		) AS f ON f.quoteid=c.clientid 
		LEFT JOIN (
			SELECT * 
			FROM ver_chronoforms_data_notes_vic 
			WHERE cf_id IN (
				SELECT MAX(cf_id) as max_id 
				FROM ver_chronoforms_data_notes_vic 
				GROUP BY clientid
		)
	) as n ON n.clientid=c.clientid 
	WHERE
	".(($c_status=="Enquiry")?" f.status IS NULL AND ":"")."
	1=1 
	{$rep_filter3} 
";


//this return the total number of records returned by our query
//error_log("start count: ".microtime(true), 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_sa\\my-error.log');

$total_records = mysql_num_rows(mysql_query($sql));
 
//now we limit our query to the number of results we want per page
//$sql .= " ORDER BY datelodged DESC LIMIT $start, " . NUMBER_PER_PAGE;

if($is_admin){
	$sql .= " ORDER BY c.pid DESC";
}else{
	$sql .= " ORDER BY c.pid DESC ";
}

// if(isset($_POST['download_pdf'])==false){	
	$sql .= " LIMIT $start, " . NUMBER_PER_PAGE;
// }

// error_log("sql: ".$sql, 3,'C:\\xampp\htdocs\\vergola_contract_system_v3\\my-error.log');
//error_log(" total_records: ".$total_records, 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_sa\\my-error.log');
$loop = mysql_query($sql)
	or die ('cannot run the query because: ' . mysql_error());
//error_log("end query: ".microtime(true), 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_sa\\my-error.log'); 


echo "<div id='container'>";
echo "<div class='pagination-layer'>";
pagination($page, $total_records, $paging_url);
echo "</div>";

$style = "";  
$html = "";
$html_pdf = "";
$html_head = "";

if(isset($_POST['download_pdf'])==true){

	$style = ""; //$style=\"border:1px solid black; \"";  
	$html_pdf .= "<table border=\"1\" cellpadding=\"2\" BORDERCOLOR=\"GREY\"  > <tr><th width=\"60\" {$style}>&nbsp;<b>ID</b></th><th width=\"120\" {$style}>&nbsp;<b>Customer Name</b></th><th width=\"150\" {$style}>&nbsp;<b>Site Address</b></th><th width=\"80\" {$style}>&nbsp;<b>Home Phone</b></th><th width=\"90\" {$style}>&nbsp;<b>Mobile</b></th> <th width=\"120\" {$style}>&nbsp;<b>Consultant</b></th><th width=\"80\" {$style}>&nbsp;<b>Enquiry</b></th><th width=\"80\" {$style}>&nbsp;<b>Appointment</b></th><th width=\"80\" {$style}>&nbsp;<b>Quote Value</b></th><th width=\"80\" {$style}>&nbsp;<b>Delivered</b></th><th width=\"80\" {$style}>&nbsp;<b>Follow Up</b></th><th width=\"70\" {$style}>&nbsp;<b>Status</b></th><th width=\"350\" {$style} >&nbsp;<b>Note</b> </th> </tr>";
} 
/*if($page_name == "new-builder-enquiry-vic" || $page_name == "builder-listing-vic"){
  // $is_builder_ = 1;  
  $showcontact =  "";   
}else{
    // $is_builder_ = 0;        
    $showcontact =  "hide";
};*/
$html_head = "<table class=\"listing-table table-bordered\"   style=\"font-size: 10pt;\"> 
				<tr>
					<th width=\"3%\">ID</th><th width=\"10%\">Customer Name</th>            
                    <th width=\"12%\">Site Address</th>
					<th width=\"6%\">Home Phone</th><th width=\"6%\">Mobile</th>
					<th class=\"".(isset($user->groups['9'])?"hide":"")."\" width=\"10%\">Consultant</th>
					<th width=\"6%\">Date of Enquiry</th><th width=\"8%\">Appointment Date</th>
					<th width=\"6%\">Quote Value</th><th width=\"6%\">Quote Delivered</th>
					<th width=\"6%\">Follow Up</th><th width=\"3%\">Status</th>
					<th>Note</th> 
				</tr>";

//error_log("start loop: ".microtime(true), 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_sa\\my-error.log'); 
while ($record = mysql_fetch_assoc($loop)) {
	if(empty($record['builder_contact_firstname'])==false && empty($record['builder_contact_lastname'])==false){
	  $record['builder_contact'] = $record['builder_contact_title']." ".$record['builder_contact_firstname']." ".$record['builder_contact_lastname'];}
	  
	$QuoteID = $record['clientid'];
    $html .= "<tr class=\"pointer\" ".(isset($_POST['download_pdf'])?"":"onclick=location.href=\"" . JURI::base() .($record['is_builder']=="1" ? "builder-listing-vic/builder-folder-vic" : "client-listing-vic/client-folder-vic")."?pid={$record['pid']}\"") .
    "><td {$style}>{$record['id']}</td>" .
    /*($record['is_builder']==1?"<td {$style}>".(isset($_POST['download_pdf'])?addslashes($record['builder_name']):$record['builder_name'])."</td>":"<td {$style}>".(isset($_POST['download_pdf'])?addslashes($record['client_name']):$record['client_name'])."</td>").*/
	($record['is_builder']==1?
	"<td {$style}>
		<div  style=\"\">".(isset($_POST['download_pdf'])?addslashes($record['builder_name']):$record['builder_name'])."</div>
		<div  style=\"font-weight: bold; color: #a056ad;\">".(isset($_POST['download_pdf'])?addslashes($record['builder_contact']):$record['builder_contact'])."</div>
	</td>":
	"<td {$style}>
	<div  style=\"font-weight: ;\">".(isset($_POST['download_pdf'])?addslashes($record['client_name']):$record['client_name'])."</div></td>").     
		"<td {$style}>
			<div  style=\"font-weight: bold; color: #a056ad;\">".(isset($_POST['download_pdf'])?addslashes($record['site_sitename']):$record['site_sitename'])."</div>
			".(isset($_POST['download_pdf'])?addslashes($record['site_streetno'].' '.$record['site_streetname'].' '.$record['site_address1'].' '.$record['site_address2']):$record['site_streetno'].' '.$record['site_streetname'].' '.$record['site_address1'].' '.$record['site_address2'])." ".$record['site_suburb'].' '.$record['site_state'].' '.$record['site_postcode']."
		</td>"  .     
	"<td {$style}>{$record['client_hmphone']}</td>" .
	"<td {$style}>{$record['client_mobile']}</td>" .
	"<td {$style} class=\"".(isset($user->groups['9'])?"hide":"")."\">".(isset($_POST['download_pdf'])?addslashes($record['repname']):$record['repname'])."</td>" .
	"<td {$style}>". date(PHP_DFORMAT,strtotime($record['datelodged'])). "</td>" . 
	"<td {$style}>";
		if (empty($record['appointmentdate'])==false && $record['appointmentdate']!="" && $record['appointmentdate']!="0000-00-00 00:00:00" && $record['appointmentdate']!="1900-01-00 00:00:00" ){$html .=  date(PHP_DFORMAT.' @ h:i A',strtotime($record['appointmentdate']));} else {$html .=  "";}
	$html .=  "</td>";
	$html .=  "<td {$style}>".($record['total_cost']>0 ?  "$".number_format($record['total_cost'],2,".",",") :"")."</td>"; 
	$html .=  "<td {$style}>";
		if (empty($record['qdelivered'])==false && $record['qdelivered']!="" && $record['qdelivered']!="0000-00-00 00:00:00" && $record['qdelivered']!="1900-01-00 00:00:00" ){$html .=  date(PHP_DFORMAT,strtotime($record['qdelivered']));} else {$html .=  "";}
	$html .=  "</td><td {$style}>"; // Retrieve Follow Ups

	if(empty($record['ffdate1'])==false && $record['ffdate1']!="" && $record['ffdate1']!="0000-00-00 00:00:00" && $record['ffdate1']!="1900-01-00 00:00:00" ) {$html .=  date(PHP_DFORMAT,strtotime($record['ffdate1']));}
	else if (empty($record['appointmentdate'])==false && $record['appointmentdate']!="0000-00-00 00:00:00" && $record['appointmentdate']!="1900-01-00 00:00:00"){$html .=  date(PHP_DFORMAT.' @ h:i A',strtotime($record['appointmentdate']));}
 	else{$html .=  "";} 
	
	$html .=  "</td>";
	$html .=  "<td {$style}>".$record['followup_status']."</td>";
  	$html .=  "<td {$style}>".addslashes(substr($record['note'],0,350))."</td>";
	//$html .=  (isset($_POST['download_pdf'])==false ? "<td>".substr($record['note'],0,350)."</td>":"");

	$html .=  "</tr>";  
	
}
//error_log("end loop: ".microtime(true), 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_sa\\my-error.log'); 
    $html .=  " </table>"; 


    //-------------------------
    //echo $html;

    if(isset($_POST['download_pdf'])==true){

    	if(strlen($html)>200000){ //
 			return;
 		}
    	
    	if($advance_search){
    		$admin_add = "";
	    	$search_add = "";
	    	$suburb_add = "";
			
			if(strlen($search_string)>0){
				$search_add = "&nbsp;&nbsp;<b>Search :</b>&nbsp;".$search_string;
			}

			$admin_add = "";
			if($is_admin==1 && strlen($rep_id)>0){
				//$admin_add = "&nbsp;&nbsp;<b>Consultant:</b> ".$rep_name;
  
				$sql = "SELECT * FROM ver_users WHERE RepID='{$rep_id}';";
				//error_log($sql, 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_sa\\my-error.log');
				$loop = mysql_query($sql);
				$record = mysql_fetch_assoc($loop);
				//error_log(print_r($record,true), 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_sa\\my-error.log');

				$admin_add = "&nbsp;&nbsp;<b>Consultant:</b> &nbsp; ".$record['name'];
				 

			}
			
			if(strlen($suburb_name)>0){
				$suburb_add = "<b>Suburb:</b> &nbsp; {$suburb_name}";
			}

			$date_header = "";
			if(strlen($frdate) && strlen($todate)){
				$date_header = "<b>From :</b> ".date(PHP_DFORMAT, strtotime($frdate))." &nbsp;&nbsp;  &nbsp;&nbsp;  <b>To :</b> ".date(PHP_DFORMAT, strtotime($todate))."  ";

			}

			$html_pdf ="<div><b>Filter</b>  {$admin_add}   {$search_add}  &nbsp;&nbsp;  &nbsp;&nbsp;&nbsp;&nbsp; <br/> {$date_header} <br/> </div> <br/>".$html_pdf.$html;
 
		}else{
			$html_pdf = $html_pdf.$html;
			$search_add = "";
			if(strlen($search_string)>0){
				$search_add = " <b>Search :&nbsp;&nbsp;</b>".$search_string;
				$html_pdf ="<div><b>Filter</b>  &nbsp;&nbsp; {$search_add}   </div><br/><br/>".$html_pdf;

			}else{
				$html_pdf ="<div><b>Filter: None</b>   </div><br/><br/>".$html_pdf;
			}
 		
		}

	
	
		$title = $user->id."-".mt_rand();

		$sql = "DELETE FROM ver_chronoforms_data_letters_vic WHERE clientid='{$user->id}' AND template_type='client list'  ";
		mysql_query($sql);
		
		//$html_pdf = "<div style=\"font-family:Arial, Helvetica, sans-serif;  font-size: 9pt;\">".$html_pdf."</div>";
		 
		$sql = "INSERT INTO ver_chronoforms_data_letters_vic (clientid, template_name, datecreated, template_content, template_type) 
			 VALUES ('{$user->id}','$title', NOW(), '{$html_pdf}','client list')"; 

		
		mysql_query($sql); 

		  
		//error_log($sql, 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_sa\\my-error.log');  
	 	$redirect = "index.php?titleID={$title}&userid={$user->id}&option=com_chronoforms&tmpl=component&chronoform=Download-PDF-search-result";
		header('Location:'.JURI::base().$redirect); 
		exit(); 


		//echo "<a rel=\"nofollow\" id=\"download_pdf\" class=\"btn btn-s\" style=\"margin-left:-9000px\" onclick=\"window.open(this.href,'win2','status=no,toolbar=no,scrollbars=yes,titlebar=no,menubar=no,resizable=yes,width=auto,height=auto,directories=no,location=no'); return false;\" href=\"index.php?titleID={$title}&option=com_chronoforms&tmpl=component&chronoform=Download-PDF-search-result\"> Download PDF</a>";
	
	}
 
$html = $html_head.$html;	
echo $html;  
 
// $paging_url = ""; 
// if($is_builder){
// 	$paging_url = "&client_type=b";
// }

echo "<div class='pagination-layer'>";
pagination($page, $total_records, $paging_url);
echo "</div></div>";
//error_log("end php: ".microtime(true), 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_sa\\my-error.log');
?>

<script>
$(window).load(function(){
	//var is_default_18mon = 0;

	$('#advlist1').click(function(){
		$('#advance-search').css("display", "block");
		$('#advlist2').css("display", "inline-block");
		$('#advlist1').css("display", "none");
		$('.search-listing').css("height", "150px");
		$('#advance-search label.input span').css("visibility", "visible");
		$('#advance_search').val('1');
		//$( "#chk_default_18mon" ).prop( "checked", false ); 
		//$( "#chk_default_18mon" ).prop( "checked", true ); 
		//$("#chk_default_18mon").prop('disabled', true);
		//alert("here1");
	});

	$('#advlist2').click(function(){
		$('#advance-search').css("display", "none");
		$('#advlist2').css("display", "none");
		$('#advlist1').css("display", "inline-block");
		$('.search-listing').css("height", "28px");
		$('#builderlist').val('');
		$('#replist').val('');
		$('#suburblist').val('');
		$('.date_entered').val('');
		$('#advance_search').val('0');
		//$("#chk_default_18mon").prop('disabled', false);  
		//$( "#chk_default_18mon" ).prop( "checked"); 
		//alert("here2");
	});





//$("#download_pdf").click();
//var newWindow = window.open('', '_blank');
//newWindow.location.href = 'http://example.com';
	// $('#download_pdf').click(function(){
	// 	var url = $(location).attr('href')+"&download_pdf";
	// 	alert(url); 
		
	//         $.post("", { action : 'offsite', link: url}, function(data){
	//              	alert('<pre>'+data+'</pre>'); 
	//              	var newWindow = window.open('', '_blank');
	//                 // if the link is in the exception list, don't notify but do open the link in a new window:
	//                 newWindow.location.href("index.php?option=com_chronoforms&tmpl=component&chronoform=Download-PDF-search-result&titleID="+data.title);
	//         });     
	             
	// 	return false;
	// });
        
});

// function click_search(o){alert("click_search");
// 	$("#btn_search").click();
// }
</script>