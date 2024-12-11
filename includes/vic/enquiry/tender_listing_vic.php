<script src="<?php echo JURI::base().'jscript/jsapi.js'; ?>"></script>
<script type="text/javascript">google.load("jquery", "1");</script>
<script src="<?php echo JURI::base().'jscript/labels.js'; ?>"></script>
<link rel="stylesheet" type="text/css" media="screen,projection" href="<?php echo JURI::base().'jscript/custom.css'; ?>" />
<link rel="stylesheet" type="text/css" media="screen,projection" href="<?php echo JURI::base().'jscript/advance-search.css'; ?>" />
<script>
$(window).load(function(){

$('#advlist1').click(function(){
	$('#advance-search').css("display", "block");
	$('#advlist2').css("display", "inline-block");
	$('#advlist1').css("display", "none");
	$('.search-listing').css("height", "150px");
	$('#advance-search label.input span').css("visibility", "visible");
	$('#advance_search').val('1');
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
});

}); 
</script>

<?php
$user =& JFactory::getUser();
//our pagination function is now in this file
function pagination($current_page_number, $total_records_found, $query_string = null)
{
	$page = 1;
	
	echo "Page: ";
	
	for ($total_pages = ($total_records_found/NUMBER_PER_PAGE); $total_pages > 0; $total_pages--)
	{
		if ($page != $current_page_number)
			echo "<a href=\"" . "tender-listing-vic" . "?page=$page" . (($query_string) ? "&$query_string" : "") . "\">";

		 if ($page == $current_page_number) {echo "<span class=\"current\">$page</span>";} else {echo "$page";}


		if ($page != $current_page_number)
			echo "</a>";

		$page++;
	}
}

define("NUMBER_PER_PAGE", 100); //number of records per page of the search results
 

//load the current paginated page number
$page = ($_GET['page']) ? $_GET['page'] : 1;
$start = ($page-1) * NUMBER_PER_PAGE;

if(isset($user->groups['9'])){
	$is_admin = 0;
}else{
	$is_admin = 1;
}


/**
* if we used the search form use those variables, otherwise look for
* variables passed in the URL because someone clicked on a page number
**/
if (!isset($url)) $url ='';
if (!isset($search)) $search =''; 
if (!isset($suburb_name)) $suburb_name= '';
if (!isset($frdate)) $frdate ='';
if (!isset($todate)) $todate = '';
if (!isset($rep_id)) $rep_id = '';
if (!isset($advance_search)) $advance_search = 0;

if (!isset($is_quoted)) $is_quoted = 0;
if (!isset($c_status)) $c_status = '';
if (!isset($search_ID)) $search_ID = '';
if (!isset($default_18mon)) $default_18mon = 1;

// $search = $_POST['search_string'];
// $rep_id = ($_POST['replist']) ? $_POST['replist'] : $_GET['replist']; 
// $suburb_name = ($_POST['suburblist']) ? $_POST['suburblist'] : $_GET['suburblist'];
// $frdate = ($_POST['frdate']) ? $_POST['frdate'] : $_GET['frdate'];
// $todate = ($_POST['todate']) ? $_POST['todate'] : $_GET['todate']; 
// $advance_search = ($_POST['advance_search']) ? $_POST['advance_search'] : $_GET['advance_search'];

// if($is_admin==0){
	// $rep_id = $user->RepID;
// }else{
	// if(isset($_POST['replist'])){ $rep_id = ($_POST['replist']) ? $_POST['replist'] : $_GET['replist']; }
// }


if(isset($_REQUEST['submit']) || isset($_REQUEST['search'])){ 
	$default_18mon = 0;  // should be default to 0 when searching!
	//error_log("Inside search", 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_us\\my-error.log');
	if(isset($_POST['search_string'])){ $search_string = $_POST['search_string']; } 

	if(isset($_POST['suburblist'])){ $suburb_name = $_POST['suburblist']; } 

	if(isset($_POST['is_quoted'])){ $is_quoted = $_POST['is_quoted']; } 

	if(isset($_POST['c_status'])){ $c_status = $_POST['c_status']; } 

	if(isset($_POST['frdate'])){ $frdate = $_POST['frdate']; }

	if(isset($_POST['default_18mon'])){ $default_18mon = $_POST['default_18mon']; }
	if(isset($_POST['todate'])){ $todate = $_POST['todate']; }

	if(isset($_POST['replist'])){ $rep_id = $_POST['replist']; }

	if(isset($_POST['advance_search'])){ $advance_search = $_POST['advance_search']; }

	if(isset($_POST['search_ID'])){ $search_ID = $_POST['search_ID']; }
}else{
	//error_log("paging", 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_us\\my-error.log');
	if(isset($_REQUEST['search_string'])){ $search_string = $_REQUEST['search_string']; } 

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
	//error_log(print_r($_GET,true), 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_us\\my-error.log');
	//error_log("page: ".$page, 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_us\\my-error.log');

	//error_log("start: ".$start, 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_us\\my-error.log');
	//error_log("search: ".$search." END", 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_us\\my-error.log');
}

  

// if($is_admin==0){
// 	$rep_id = $user->RepID;
// }else{
// 	if(isset($_REQUEST['replist'])){ $rep_id = $_REQUEST['replist']; }
// }
//error_log(print_r($_POST,true), 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_us\\my-error.log');

//-------------------------------- Paging Parameter --------------------------------
$paging_url = "";  

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
 

 
//error_log("advance_search: ".$advance_search, 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_sa\\my-error.log'); 

//display the search form
echo "<div class='search-listing'>
<form  action='" . JRoute::_($url) . "' method='post' id='chronoform_Listing_Module' class='Chronoform hasValidation' style='float:none; width:90%'>
	<label>Search:</label> <input type='text' name='search_string' /> <input type='submit' name='submit' value='Search' class='search-btn' />";

	echo "<input type='button' id='advlist1' class='advance-search' value='Advance Search'>
<input type='button' id='advlist2' class='advance-search' value='Advance Search'>
<input type='hidden' name='advance_search' id='advance_search' value='{$advance_search}' />";

echo "<div id='advance-search' style='display:".($advance_search==1?'block':'none')."'>
<!-- Start of Advance Search --->
<!-- Start of Rep List --->
<label class='input' ". (isset($user->groups["9"]) ? "style='display:none;'":"") ."> ". (isset($user->groups["9"])==false && $rep_id==""? "<span>Consultant</span>":"") ." <select class='rep-list' id='replist' name='replist'><option></option>";
            $usergroup = 'Victoria Users';
            $queryrep="SELECT * FROM ver_users WHERE usertype LIKE ('$usergroup') ORDER BY name ASC";
            $resultrep = mysql_query($queryrep);
            if(!$resultrep){die ("Could not query the database: <br />" . mysql_error());
			}
			
			if(isset($user->groups['9'])){
				echo "<option value = '{$user->name}' selected>{$user->name}</option>";
			}else{	
			  while ($data=mysql_fetch_assoc($resultrep)){
                  	if($data['RepID']==$rep_id){
			  			echo "<option value = '{$data['RepID']}' selected>{$data['name']}</option>";
			  		}else{
	                  	echo "<option value = '{$data['RepID']}'>{$data['name']}</option>";
	                }
		        }
 			}

echo "</select></label>

<label class='input'>".($suburb_name==''?"<span id='suburbspan'>Suburb</span>":"")."<select class='suburb-list' id='suburblist' name='suburblist'><option></option>";
      
$querysub="SELECT suburb FROM ver_chronoforms_data_suburbs_vic GROUP BY suburb ORDER BY suburb ASC";

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
	<option value='Enquiry' ".($c_status=='Enquiry'?"selected":"").">Enquiry</option> 
	<option value='Quoted' ".($c_status=='Quoted'?"selected":"").">Quoted</option> 
	<option value='Costed' ".($c_status=='Costed'?"selected":"").">Costed</option>  
	<option value='Not Interested' ".($c_status=='Not Interested'?"selected":"").">Not Interested</option>  
	<option value='Under Consideration' ".($c_status=='Under Consideration'?"selected":"").">Under Consideration</option> 
	<option value='Future Project' ".($c_status=='Future Project'?"selected":"").">Future Project</option> 
	<option value='Won' ".($c_status=='Won'?"selected":"").">Won</option> 
	<option value='Lost' ".($c_status=='Lost'?"selected":"").">Lost</option> 
	"; 
echo "</select></label>";

echo " 
	 <label class='input'><span>TR</span><input type='input' name='search_ID' value='".($search_ID!=''?$search_ID:"")."' style='border:1px solid #7C7D7F;' ></label>"; 
	 
echo "  
<div id='searchdate'>
<div>
<span>From Date</span><br />
<input type='text' id='frdate' name='frdate' class='date_entered' value='{$frdate}'>
</div>
<div>
<span>To Date</span><br />
<input type='text' id='todate' name='todate' class='date_entered' value='{$todate}'></div>
<div>
<input type='submit' name='submit' value='Search' class='search-btn' />
</div>
</div>

<!-- End of Advance Search --->
</div>
</form>

</div>";
 
$searchdate = $frdate && $todate;
$search_string_filter = "";
if ($search)
	$search_string_filter .= " AND ( " . 
		" builder_name LIKE '%"  . $search .  "%' " . 
		" OR tenderid LIKE '%"  . $search .  "%' " . 
		" OR site_project LIKE '%"  . $search .  "%' " . 
		" OR site_streetno LIKE '%"  . $search .  "%' " . 
		" OR site_streetname LIKE '%"  . $search .  "%' " . 
		" OR site_address1 LIKE '%"  . $search .  "%' " . 
		" OR site_address2 LIKE '%"  . $search .  "%' " .
		" OR site_suburb LIKE '%"  . $search .  "%' " .
		" OR site_state LIKE '%"  . $search .  "%' " .
		" OR site_postcode LIKE '%"  . $search .  "%' " .
		" OR builder_wkphone LIKE '%"  . $search .  "%' " .
		" OR builder_mobile LIKE '%"  . $search .  "%' " .
		($is_admin?" OR repname LIKE '%"  . $search .  "%' ":"") .
	" ) ";

 
	
$rep_filter = "   ";
$rep_filter2 = "  ";
if($is_admin ){
	if($rep_id!=""){  
		$rep_filter .= " AND repident='{$rep_id}' ";
		$rep_filter2 .= " AND rep_id='{$rep_id}' "; 
	}
}
else{
	 
	$rep_filter .= " AND repident='{$user->RepID}' ";
	$rep_filter2 = " AND rep_id='{$user->RepID}' ";
	 
}	

$suburb_filter = "";
$date_filter = "";
// if ($rep_name)
// 	$sql .= " AND repname LIKE '%" . mysql_real_escape_string($rep_name) . "%'";
if(isset($user->groups['9'])){
	$sql .= " AND repname LIKE '%" . $user->name . "%'";
}else{
	if ($rep_name)
		$sql .= " AND repname LIKE '%" . mysql_real_escape_string($rep_name) . "%'"; 
}	

if ($suburb_name)
//$sql .= " (AND (site_suburb LIKE '%" . mysql_real_escape_string($suburb_name) . "%') OR (site_suburb LIKE '%" . mysql_real_escape_string($suburb_name) . "%'))";	
$suburb_filter .= " AND site_suburb LIKE '%" . mysql_real_escape_string($suburb_name) . "%'";

// if ($searchdate)
	// $sql .= " AND datelodged >= '" .  date('Y-m-d 00:00:00', strtotime($frdate)) . "'" . " AND datelodged <= '" . $todate . "'";
if (strlen($frdate)>0 && strlen($todate))
	$date_filter .= " AND DATE(datelodged) BETWEEN DATE('{$frdate}') AND DATE('{$todate}')";	

if ($default_18mon==1)
	$default_18month_filter = " AND datelodged BETWEEN DATE_ADD(NOW(),INTERVAL -18 MONTH) AND DATE_ADD(NOW(),INTERVAL 1 DAY) ";
// $sql = "SELECT distinct tenderid, site_project, site_address1, site_address2, site_suburb, site_postcode  FROM ver_chronoforms_data_builderpersonal_vic WHERE tenderstatus='Yes'"; 
$c_status_filter = "";
$c_status_filter_a = ""; //same filter but in different table query.
//error_log("c_status: ".$c_status, 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_sa\\my-error.log');
if(strlen($c_status)>0 && $advance_search==1){
	
	if($c_status=="Enquiry"){
		$c_status_filter_a = " ";
	}else{
		$c_status_filter = " AND status='".$c_status."' ";
	}

	if($search_ID!=""){ 
		$c_status_filter_a .= " AND b.tenderid LIKE '%"  . $search_ID .  "%'";
	}




}
	
// $sql = "SELECT *,(SELECT content FROM ver_chronoforms_data_notes_vic WHERE clientid = b.builderid  ORDER BY cf_id DESC LIMIT 1) AS note FROM (SELECT * FROM ver_chronoforms_data_clientpersonal_vic AS b  where tenderid IS NOT NULL  {$rep_filter}  {$suburb_filter} {$date_filter} {$search_string_filter}  GROUP BY tenderid  ) AS b LEFT JOIN (SELECT * FROM (SELECT * FROM ver_chronoforms_data_followup_vic WHERE 1=1 {$rep_filter2}  ORDER BY cf_id DESC) as f0  GROUP BY quoteid ) AS f ON f.quoteid=b.builderid ";
$sql = "SELECT *,(SELECT content FROM ver_chronoforms_data_notes_vic WHERE clientid = b.builderid  ORDER BY cf_id DESC LIMIT 1) AS note FROM (SELECT * FROM ver_chronoforms_data_builderpersonal_vic AS b WHERE 1=1 {$rep_filter} {$c_status_filter_a} AND tenderstatus='Yes' {$suburb_filter} {$date_filter} {$search_string_filter} ) AS b 
	LEFT JOIN (SELECT * FROM (SELECT * FROM ver_chronoforms_data_followup_vic WHERE 1=1 {$rep_filter2} {$c_status_filter}   ORDER BY cf_id DESC) as f0  GROUP BY quoteid ) AS f ON f.quoteid=b.builderid 
	LEFT JOIN (SELECT clientid, site_streetno, site_streetname FROM ver_chronoforms_data_clientpersonal_vic AS c  where tenderid IS NOT NULL  GROUP BY tenderid  ) AS cp ON cp.clientid = b.builderid
	-- LEFT JOIN (SELECT * FROM ver_chronoforms_data_clientpersonal_vic AS b  where tenderid IS NOT NULL}  GROUP BY tenderid  ) AS cp ON cp.clientid = b.builderid 
	-- LEFT JOIN ver_chronoforms_data_clientpersonal_vic AS cp ON cp.clientid = b.builderid 
	";

//this return the total number of records returned by our query
$total_records = mysql_num_rows(mysql_query($sql));


//now we limit our query to the number of results we want per page
$sql .= " ORDER BY b.pid desc LIMIT $start, " . NUMBER_PER_PAGE;
//error_log($sql, 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_sa\\my-error.log'); 

$loop = mysql_query($sql) or die ('cannot run the query because: ' . mysql_error());
//$searchdate = $frdate && $todate;

/**
* Next we display our pagination at the top of our search results
* and we include the search words filled into our form so we can pass
* this information to the page numbers. That way as they click from page
* to page the query will pull up the correct results
**/
echo "<div id='container'>";
// echo "<div class='pagination-layer'>";
// pagination($page, $total_records, "datelodged=$searchdate&rep_id=$rep_id&client_suburb=$suburb_name");
// echo "</div>";
 

//$distinct = mysql_query("SELECT distinct tenderid FROM ver_chronoforms_data_builderpersonal_vic WHERE tenderstatus='Yes'");
//while($getdistinct = mysql_fetch_assoc($distinct)){
//	$TenderID = $getdistinct['tenderid'];
//	echo $TenderID."<br/>"; 
//	}

$html = "<table class='listing-table table-bordered'><tbody><tr><th width=\"3%\">ID</th><th>Site Address</th><th>Project Name</th><th>Date of Enquiry</th><th>Sales Rep</th><th>Quote Value</th><th>Quote Delivered</th><th>Builder</th><th>Follow Up</th><th>Status</th><th>Note</th></r>";
 
while ($record = mysql_fetch_assoc($loop)) {
//$TenderID = $record['tenderid'];

	$html .= "<tr class='pointer' onclick=location.href='" . $this->baseurl . "tender-listing-vic/tender-folder-vic?tenderid={$record['tenderid']}' >
		<td>{$record['tenderid']}</td>" . 
		"<td>{$record['site_streetno']} {$record['site_streetname']} {$record['site_address1']} {$record['site_address2']} <br />{$record['site_suburb']} {$record['site_state']} {$record['site_postcode']} </td>" . 
		"<td>{$record['site_project']}</td>  ";
		
	$html .= "<td>". date(PHP_DFORMAT,strtotime($record['datelodged'])). "</td>";	 
	    
	$html .= "<td class='".(isset($user->groups['9'])?"hide":"")."'>{$record['repname']}</td>";
	$html .=  "<td>".($record['total_rrp']>0 ?  "$".number_format($record['total_rrp'],2,".",",") :"")."</td>"; 	
		$html .=  "<td>";
			if (empty($record['qdelivered'])==false && $record['qdelivered']!="" && $record['qdelivered']!="0000-00-00"){$html .=  date(PHP_DFORMAT,strtotime($record['qdelivered']));} else {$html .=  "";}
	$html .=  "</td>";

	$html .= "<td>{$record['builder_name']} </td>";
		
	$html .= "<td>";
		if (empty($record['qdelivered'])==false && $record['qdelivered']!="" && $record['qdelivered']!="0000-00-00"){$html .=  date(PHP_DFORMAT,strtotime($record['qdelivered']));} else {$html .=  "";}
	$html .= "</td>";
	$html .= "<td>".$record['status']."</td>";
	$html .= "<td>".$record['note']."</td>";
	$html .= "</tr>"; 

}

$html . "</tbody></table>";
echo $html;
    
echo "<div class='pagination-layer'>";
pagination($page, $total_records, "datelodged=$searchdate&rep_id=$rep_id&client_suburb=$suburb_name");
echo "</div></div>";