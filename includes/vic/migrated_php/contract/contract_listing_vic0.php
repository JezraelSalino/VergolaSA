<script src="<?php echo JURI::base().'jscript/jsapi.js'; ?>"></script>
<script type="text/javascript">google.load("jquery", "1");</script>
<script src="<?php echo JURI::base().'jscript/labels.js'; ?>"></script>
<link rel="stylesheet" type="text/css" media="screen,projection" href="<?php echo JURI::base().'jscript/custom.css'; ?>" />
<link rel="stylesheet" type="text/css" media="screen,projection" href="<?php echo JURI::base().'jscript/advance-search.css'; ?>" />
 
<?php  	
$sql_dformat = SQL_DFORMAT;

$user =& JFactory::getUser();
//error_log(print_r($_POST,true), 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_sa\\my-error.log');
//our pagination function is now in this file
function pagination($current_page_number, $total_records_found, $query_string = null)
{
	$page = 1;
	
	echo "Page: ";
	
	for ($total_pages = ($total_records_found/NUMBER_PER_PAGE); $total_pages > 0; $total_pages--)
	{
		if ($page != $current_page_number)
			echo "<a href=\"" . "contract-listing-vic" . "?page=$page" . (($query_string) ? "&$query_string" : "") . "\">";

		 if ($page == $current_page_number) {echo "<span class=\"current\">$page</span>";} else {echo "$page";}


		if ($page != $current_page_number)
			echo "</a>";

		$page++;
	}
}



define("NUMBER_PER_PAGE",75); //number of records per page of the search results
$url = JURI::base().'contract-listing-vic';
//display the search form


//load the current paginated page number
$page = 1;
$start = ($page-1) * NUMBER_PER_PAGE;

/**
* if we used the search form use those variables, otherwise look for
* variables passed in the URL because someone clicked on a page number
**/
if (!isset($url)) $url ='';
if (!isset($search_string)) $search_string ='';
if (!isset($rep_id)) $rep_id = '';
if (!isset($suburb_name)) $suburb_name= '';
if (!isset($frdate)) $frdate ='';
if (!isset($todate)) $todate = '';
if (!isset($advance_search)) $advance_search = 0;
if (!isset($is_builder )) $is_builder  = 0;

if (!isset($drawing_no_date)) $drawing_no_date = 0;
if (!isset($easement)) $easement= '';
if (!isset($planning)) $planning= '';
if (!isset($installer)) $installer= '';
if (!isset($site_address)) $site_address= '';
if (!isset($drawing_no_approve_date)) $drawing_no_approve_date= '';
if (!isset($mod)) $mod= '';
if (!isset($contract_status)) $contract_status= '';
if (!isset($framework_type)) $framework_type= '';
if (!isset($job_status)) $job_status= 'incomplete';
if (!isset($search_ID)) $search_ID = '';
if (!isset($default_18mon)) $default_18mon = 1;
 
//if (!isset($mod)) $suburb_name= null;


if(isset($user->groups['9'])){
	$is_admin = 0;
}else{
	$is_admin = 1;
}


//error_log(" _POST: ".print_r($_POST,true), 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_sa\\my-error.log');
//error_log(" _REQUEST: ".print_r($_REQUEST,true), 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_sa\\my-error.log');

if(isset($_REQUEST['submit']) || isset($_REQUEST['search'])){

	//error_log(" INSIDE POST: ", 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_sa\\my-error.log');
	$default_18mon = 0;

	if(isset($_POST['search_string'])){ $search_string = trim($_POST['search_string']); }
	 
	if(isset($_POST['replist'])){ $rep_id = $_POST['replist']; }

	if(isset($_POST['suburblist'])){ $suburb_name = $_POST['suburblist']; }

	if(isset($_POST['frdate'])){ $frdate = $_POST['frdate']; }

	if(isset($_POST['todate'])){ $todate = $_POST['todate']; }

	if(isset($_POST['advance_search'])){ $advance_search = $_POST['advance_search']; }

	if(isset($_POST['installer'])){ $installer = trim($_POST['installer']); }
	
	if(isset($_POST['site_address'])){ $site_address = trim($_POST['site_address']); }

	if(isset($_POST['drawing_no_approve_date'])){ $drawing_no_approve_date = $_POST['drawing_no_approve_date']; }

	if(isset($_POST['easement'])){ $easement = $_POST['easement']; }

	if(isset($_POST['planning'])){ $planning = $_POST['planning']; }

	if(isset($_POST['mod'])){ $mod = $_POST['mod']; }

	if(isset($_POST['contract_status'])){ $contract_status = $_POST['contract_status']; }
	
	if(isset($_POST['framework_type'])){ $framework_type = $_POST['framework_type']; }
	
	if(isset($_POST['job_status'])){ $job_status = $_POST['job_status']; }

	if(isset($_POST['search_ID'])){ $search_ID = $_POST['search_ID']; } 

	if(isset($_POST['default_18mon'])){ $default_18mon = $_POST['default_18mon']; }

	// if($advance_search==1){
	// 	$default_18mon = 1;
	// }

	//error_log("1111: ", 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_sa\\my-error.log');

}else{

	//error_log(" INSIDE GET: ", 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_sa\\my-error.log');
	//$default_18mon = 1;

	if(isset($_REQUEST['search_string'])){ $search_string = trim($_REQUEST['search_string']); }
	 
	if(isset($_REQUEST['replist'])){ $rep_id = $_REQUEST['replist']; }

	if(isset($_REQUEST['suburblist'])){ $suburb_name = $_REQUEST['suburblist']; }

	if(isset($_REQUEST['frdate'])){ $frdate = $_REQUEST['frdate']; }

	if(isset($_REQUEST['todate'])){ $todate = $_REQUEST['todate']; }

	if(isset($_REQUEST['advance_search'])){ $advance_search = $_REQUEST['advance_search']; }

	if(isset($_REQUEST['installer'])){ $installer = trim($_REQUEST['installer']); }
	
	if(isset($_REQUEST['site_address'])){ $site_address = trim($_REQUEST['site_address']); }

	if(isset($_REQUEST['drawing_no_approve_date'])){ $drawing_no_approve_date = $_REQUEST['drawing_no_approve_date']; }

	if(isset($_REQUEST['easement'])){ $easement = $_REQUEST['easement']; }

	if(isset($_REQUEST['planning'])){ $planning = $_REQUEST['planning']; }

	if(isset($_REQUEST['mod'])){ $mod = $_REQUEST['mod']; }

	if(isset($_REQUEST['contract_status'])){ $contract_status = $_REQUEST['contract_status']; }

	if(isset($_REQUEST['framework_type'])){ $framework_type = $_REQUEST['framework_type']; }
	
	if(isset($_REQUEST['job_status'])){ $job_status = $_REQUEST['job_status']; }

	if(isset($_REQUEST['search_ID'])){ $search_ID = $_REQUEST['search_ID']; }

	if(isset($_REQUEST['default_18mon'])){ $default_18mon = $_REQUEST['default_18mon']; }

	$page = isset($_GET['page']) ? $_GET['page'] : 1;
	$start = ($page-1) * NUMBER_PER_PAGE;

	// if($advance_search==1){
	// 	$default_18mon = 1;
	// }

	//error_log(print_r($_GET,true), 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_sa\\my-error.log');
	//error_log("page: ".$page, 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_sa\\my-error.log');
	//error_log("start: ".$start, 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_sa\\my-error.log');

}

//error_log("_REQUEST: ".print_r($_REQUEST,true), 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_sa\\my-error.log');
//error_log("_POST: ".print_r($_POST,true), 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_sa\\my-error.log');
//error_log("0: job_status: ".$job_status, 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_sa\\my-error.log');
//error_log("0: installer : ".$installer, 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_sa\\my-error.log'); 

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

if($suburb_name){
	$paging_url .= "&suburb_name=".$suburb_name;
}

if($installer){
	$paging_url .= "&installer=".$installer;
}

if($site_address){
	$paging_url .= "&site_address=".$site_address;
}

if($drawing_no_approve_date){
	$paging_url .= "&drawing_no_approve_date=1";
}

if($easement){
	$paging_url .= "&easement=".$easement;
}

if($planning){
	$paging_url .= "&planning=".$planning;
}

if($mod){
	$paging_url .= "&mod=".$mod;
}

if($advance_search){
	$paging_url .= "&advance_search=1";
}

if($is_builder){
	$paging_url .= "&client_type=b";
}

if($contract_status){
	$paging_url .= "&contract_status=".$contract_status;
}

if($framework_type){
	$paging_url .= "&framework_type=".$framework_type;
}

if($job_status){
	$paging_url .= "&job_status=".$job_status;
}

if($search_ID){
	$paging_url .= "&search_ID=".$search_ID;
}

if ($default_18mon){ //error_log("default_18mon:".$default_18mon, 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_sa\\my-error.log');
	$paging_url .= "&default_18mon=1";
}else{
	$paging_url .= "&default_18mon=0";
} 



//-------------------------------- END Paging Parameter --------------------------------

$user = JFactory::getUser();
$groups = $user->get('groups'); 

//$result = mysql_query($sql) or die(mysql_error());
$searchdate = $frdate && $todate; 
$search_string_filter = "";

if ($search_string)
	//$search_string_filter .= " AND (cp.client_firstname LIKE '%"  . $search_string .  "%'" .
	//" OR cp.client_lastname LIKE '%"  . $search_string .  "%'" .

	// $search_string_filter .= " AND (CONCAT(cp.client_firstname,' ',cp.client_lastname) LIKE '%"  . $search_string .  "%'" . 	 
	// " OR cp.builder_name LIKE '%"  . $search_string .  "%')";

	$search_string_filter .= " AND ( " . 
		" CONCAT(cp.client_firstname,' ',cp.client_lastname) LIKE '%"  . $search_string .  "%' " . 
		" OR cp.builder_name LIKE '%"  . $search_string .  "%' " . 
		" OR c.quoteid LIKE '%"  . $search_string .  "%' " .
		" OR site_address LIKE '%"  . $search_string .  "%' " . 
		" OR c.projectid LIKE '%"  . $search_string .  "%' " . 
		" OR project_name LIKE '%"  . $search_string .  "%' " . 
		" OR sales_rep LIKE '%"  . $search_string .  "%' " . 
		" OR erectors_name LIKE '%"  . $search_string .  "%' " . 
	" ) ";



//error_log("search_string: ".$search_string." search_string_filter".$search_string_filter, 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_sa\\my-error.log');

$rep_filter = "   ";
$rep_filter2 = "  ";

$default_18month_filter = "";
if ($default_18mon==1)
	$default_18month_filter = " AND c.contractdate BETWEEN DATE_ADD(NOW(),INTERVAL -18 MONTH) AND DATE_ADD(NOW(),INTERVAL 1 DAY) ";
  

if($is_admin ){
	if($rep_id!=""){  
		$rep_filter .= " AND c.repident='{$rep_id}' ";
		$rep_filter2 .= " AND c.rep_id='{$rep_id}' "; 
	}
}
else{ 
	$rep_filter .= " AND c.repident='{$user->RepID}' ";
	$rep_filter2 = " AND c.rep_id='{$user->RepID}' ";  
}	
 
$suburb_filter = "";
$date_filter = "";
$suburb_filter1 = "";
$suburb_filter2 = "";
 	 
if ($suburb_name){
	$suburb_filter .= " AND ((cp.client_suburb LIKE '%" . $suburb_name . "%') OR (cp.site_suburb LIKE '%" . $suburb_name . "%')) ";
	//$suburb_filter .= " AND cp.client_suburb LIKE '%" . $suburb_name . "%' ";
	//$suburb_filter2 .= " ON c.quoteid = cb.client_id ";
}

if ($searchdate)
	$date_filter = " AND DATE(c.contractdate) BETWEEN DATE('{$frdate}') AND DATE('{$todate}') ";
	

$installer_filter = "";
if($installer){
	$installer_filter = " AND cv.erectors_name LIKE '%{$installer}%' ";
}

$site_address_filter = "";
if($site_address){
	$site_address_filter = " AND c.site_address LIKE '%{$site_address}%' ";

}

$drawing_no_approve_date_filter = "";
if($drawing_no_approve_date){
	$drawing_no_approve_date_filter = " AND drawing_approve_date IS NULL ";
}

// $easement_filter = "";
// if($easement){
// 	$easement_filter = " AND cs.stat_req_easement_approval_date = '{$easement}' ";
// }

// $planning_filter = "";
// if($planning){
// 	$planning_filter = " AND cs.stat_req_planning = '{$planning}' ";
// }

// $mod_filter = "";
// if($mod){
// 	$mod_filter = " AND cs.mod = '{$mod}' ";
// }


// $drawing_approval_filter_filter = "";
// if($drawing_approval_filter){
// 	if($drawing_approval_filter=="drawing_app_date_blank"){
// 		$drawing_approval_filter_filter = " AND cv.drawing_approve_date IS NULL ";
// 	}else if($drawing_approval_filter=="check_measure_date_entered"){
// 		$drawing_approval_filter_filter = " AND cv.check_measure_date IS NULL ";
// 	}else if($drawing_approval_filter=="complete_date_blank"){
// 		$drawing_approval_filter_filter = " AND cv.job_end_date IS NULL ";
// 	}	
// }

$contract_status_filter = "";
if($contract_status=="drawing_approval"){ 
	$contract_status_filter = " AND cv.drawing_approve_date IS NULL AND cv.check_measure_date IS NOT NULL AND cv.handover_date IS NULL ";
}else if($contract_status=="development_approval"){ 
	$contract_status_filter = " AND cs.dev_approval_date IS NULL AND cv.drawing_approve_date IS NOT NULL AND cv.handover_date IS NULL "; //drawing_prepare_date
}else if($contract_status=="framework_ordered"){ 
	$contract_status_filter = " AND cv.fw_complete IS NULL AND cs.dev_approval_date IS NOT NULL AND cv.handover_date IS NULL ";
}else if($contract_status=="jobs_scheduled"){ 
	$contract_status_filter = " AND cv.install_date IS NULL AND cs.dev_approval_date IS NOT NULL AND cv.handover_date IS NULL ";
}else if($contract_status=="job_in_progress"){ 
	$contract_status_filter = " AND cs.dev_approval_date IS NOT NULL AND cv.handover_date IS NULL ";
	if ($searchdate)
		$date_filter = " AND DATE(cv.install_date) BETWEEN DATE('{$frdate}') AND DATE('{$todate}') ";
}
 
 
$framework_type_filter = "";
if($framework_type){
	if($framework_type=="all"){
		$framework_type_filter = " ";
	}else if($framework_type=="dp"){
		$framework_type_filter = " AND c.framework_type = 'Drop-In' ";
	}else if($framework_type=="fw"){
		$framework_type_filter = " AND c.framework_type = 'Framework' ";
	}	
}

$job_status_filter = "";
//error_log("1: job_status: ".$job_status, 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_sa\\my-error.log');
if($job_status=="incomplete"){ 
	$job_status_filter = " AND cv.handover_date IS NULL ";
	 
}else if($job_status=="complete"){ 
	$job_status_filter = " AND cv.handover_date IS NOT NULL ";
	if ($searchdate){
		$date_filter  = " AND DATE(cv.handover_date) BETWEEN DATE('{$frdate}') AND DATE('{$todate}') ";
	} 
}

$search_ID_filter = "";
if($search_ID!=""){ 
		$search_ID_filter = " AND cp.clientid LIKE '%"  . $search_ID .  "%'";
	}

//error_log(" job_status_filter:".$job_status_filter, 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_sa\\my-error.log'); exit();


if($advance_search==0){
	$default_filter = " AND cv.handover_date IS NULL  ";
}else{
	$default_filter = " AND 1=1 "; 
}
 

//this return the total number of records returned by our query
//$total_records = mysql_num_rows(mysql_query($sql));

//now we limit our query to the number of results we want per page   

$sql = "
	SELECT 
		*, 
		n.content AS note, 
		c.clientid 
	FROM (
		SELECT 
			c.*, 
			CONCAT(cp.client_firstname,' ',cp.client_lastname) AS client_name, 
			cp.clientid, 
			cp.builder_name, 
			cp.is_builder, 
			check_measurer, 
			DATE_FORMAT(check_measure_date,'{$sql_dformat}') fcheck_measure_date, 
			DATE_FORMAT(drawing_approve_date,'{$sql_dformat}') fdrawing_approve_date, 
			DATE_FORMAT(production_complete_date,'{$sql_dformat}') fproduction_complete_date, 
			DATE_FORMAT(final_inspection_date,'{$sql_dformat}') ffinal_inspection_date, 
			erectors_name, 
			DATE_FORMAT(job_end_date,'{$sql_dformat}') fjob_end_date, 
			DATE_FORMAT(cv.install_date,'{$sql_dformat}') finstall_date, 
			DATE_FORMAT(cs.stat_req_easement_waterboard_approval_date,'{$sql_dformat}') fstat_req_easement_waterboard_approval_date, 
			DATE_FORMAT(cs.stat_req_easement_council_approval_date,'{$sql_dformat}') fstat_req_easement_council_approval_date, 
			stat_req_planning, 
			stat_req_planning_approval_date, 
			m_o_d, 
			contract_note_number, 
			DATE_FORMAT(cv.fw_orderdate,'{$sql_dformat}') ffw_orderdate, 
			DATE_FORMAT(cs.permit_application_date,'{$sql_dformat}') fpermit_application_date, 
			DATE_FORMAT(cs.engineering_approved_date,'{$sql_dformat}') fengineering_approved_date, 
			DATE_FORMAT(cs.permit_approved_date,'{$sql_dformat}') fpermit_approved_date, 
			DATE_FORMAT(c.contractdate,'{$sql_dformat}') fcontractdate, 
			cp.client_mobile, 
			DATE_FORMAT(planning_application_date,'{$sql_dformat}') AS fplanning_application_date, 
			DATE_FORMAT(bldg_rules_application,'{$sql_dformat}') AS fbldg_rules_application, 
			DATE_FORMAT(dev_approval_date,'{$sql_dformat}') AS fdev_approval_date, 
			DATE_FORMAT(fw_complete,'{$sql_dformat}') ffw_complete, 
			DATE_FORMAT(handover_date,'{$sql_dformat}') fhandover_date, 
			DATE_FORMAT(warranty_end_date,'{$sql_dformat}') fwarranty_end_date, 
			IF(c.framework_type='Drop-In','DI','FR') AS ftype 
		FROM ver_chronoforms_data_contract_list_vic AS c 
			LEFT JOIN ver_chronoforms_data_contract_vergola_vic AS cv ON cv.projectid = c.projectid 
			LEFT JOIN ver_chronoforms_data_contract_statutory_vic AS cs ON cs.projectid=c.projectid 
			LEFT JOIN (
				SELECT projectid, orderdate 
				FROM ver_chronoforms_data_contract_bom_vic 
				where inventory_section='Frame' 
				GROUP BY projectid
			) AS bom ON bom.projectid=c.projectid 
			LEFT JOIN ver_chronoforms_data_clientpersonal_vic AS cp ON cp.clientid=c.quoteid 
		WHERE 1=1 
		{$default_18month_filter} 
		{$default_filter} 
		{$rep_filter2} 
		{$suburb_filter} 
		{$date_filter} 
		{$search_string_filter} 
		{$installer_filter} 
		{$site_address_filter}
		{$contract_status_filter} 
		{$framework_type_filter} 
		{$job_status_filter} 
		{$search_ID_filter} 
		ORDER BY c.cf_id DESC
	) AS c 
		LEFT JOIN (
			SELECT * 
			FROM ver_chronoforms_data_notes_vic 
			WHERE cf_id IN (
				SELECT MAX(cf_id) as max_id 
				FROM ver_chronoforms_data_notes_vic 
				GROUP BY clientid
			)
		) as n ON n.clientid=c.quoteid 
";
//echo ($sql);
//error_log($sql, 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_sa\\my-error.log');
//error_log("start count: ".microtime(true), 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_sa\\my-error.log');  
$total_records = mysql_num_rows(mysql_query($sql));
//error_log("end count: ".microtime(true), 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_sa\\my-error.log');  
$sql .= " ORDER BY c.cf_id DESC ";
if(isset($_POST['download_pdf'])==false){	
	$sql .= " LIMIT $start, " . NUMBER_PER_PAGE;
}
//if(isset($_POST['download_pdf'])==false){	
	//$sql .= " LIMIT $start, " . NUMBER_PER_PAGE;
//}

//error_log($sql, 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_sa\\my-error.log');

/**
* Next we display our pagination at the top of our search results
* and we include the search words filled into our form so we can pass
* this information to the page numbers. That way as they click from page
* to page the query will pull up the correct results
**/

echo "<div class='search-listing'>
<form  action=\"\" method=\"post\" id=\"chronoform_Listing_Module\" class='Chronoform hasValidation'  style='float:none; width:90%'>
	<label>Search:</label> <input type='text' name='search_string' value='{$search_string}' /> <input type='submit' name='submit' value='Search' class='search-btn' />";

echo "<input type='button' id='advlist1' class='advance-search' value='Advance Search' >";
echo "<input type='button' id='advlist2' class='advance-search' value='Advance Search'>";

echo "<input type='submit' id='' class='advance-search' value='Download PDF' name='download_pdf'>";	
echo "<input type='hidden' name='advance_search' id='advance_search' value='{$advance_search}' />";

 
	echo "<label for='chk_default_18mon' id='lbl_default_18mon'><input type='checkbox' name='default_18mon' id='chk_default_18mon' ".($default_18mon==1?'checked':'')." value='1' style='height:14px; margin:0 5px 0 15px; padding:0; width:14px; vertical-align:middle;'   ".($advance_search==1?"is_advance_search":""
)." />Last 18 months</label>";
 

echo "	
<div id='advance-search' style='display:".($advance_search==1?'block':'none')."; width:90%; position:relative; float:none;'>
<!-- Start of Advance Search --->
<!-- Start of Rep List --->
<label class='input' ". (isset($user->groups["9"]) ? "style='display:none;'":"") ."> ". (isset($user->groups["9"])==false && $rep_id==""? "<span>Consultant</span>":"") ."<select class=\"rep-list\" id=\"replist\" name=\"replist\"><option></option>";
            $usergroup = 'Victoria Users';
            $queryrep="SELECT * FROM ver_users WHERE usertype LIKE ('$usergroup') ORDER BY name ASC";
            $resultrep = mysql_query($queryrep);
            if(!$resultrep){die ("Could not query the database: <br />" . mysql_error());
			}
			
			if(isset($user->groups['9'])){
				echo "<option value = '{$user->RepID}' selected>{$user->name}</option>";
			}else{	
			  while ($data=mysql_fetch_assoc($resultrep)){
                  //echo "<option value = '{$data['RepID']}'>{$data['name']}</option>";
                   if($data['RepID']==$rep_id){
			  			echo "<option value = '{$data['RepID']}' selected>{$data['name']}</option>";
			  		}else{
	                  	echo "<option value = '{$data['RepID']}'>{$data['name']}</option>";
	                }
		        }
		    }    
 
echo "</select></label>

<!-- Start of Suburb -->
<label class='input'>".($suburb_name==''?"<span id='suburbspan'>Suburb</span>":"")."<select class=\"suburb-list\" id=\"suburblist\" name=\"suburblist\"><option></option>";
      
            $querysub="SELECT suburb FROM ver_chronoforms_data_suburbs_vic ORDER BY suburb ASC";

            $resultsub = mysql_query($querysub);
            	if(!$resultsub){die ("Could not query the database: <br />" . mysql_error());
			}
			
			while ($data=mysql_fetch_assoc($resultsub)){
                  //echo "<option value = '{$data['suburb']}'>{$data['suburb']}</option>";
			  	if($data['suburb']==$suburb_name){
	              	echo "<option value = \"{$data['suburb']}\" selected>{$data['suburb']}</option>";
	            }else{
	            	echo "<option value = \"{$data['suburb']}\">{$data['suburb']}</option>";
	            } 
		    }
 
echo "</select></label>"; 
 
//error_log($data['name'].'  - '.$installer, 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_sa\\my-error.log'); 

$class_hide="";
if(HOST_SERVER=="Victoria"){
	$class_hide = " hide ";
}
//error_log("Here A: ", 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_vic\\my-error.log');


$cbo_installer = "<select    name=\"installer\"><option value=''>Select Installer</option>"; 
$querysub="SELECT * FROM ver_chronoforms_data_installer_vic ORDER BY name ASC";

            $resultsub = mysql_query($querysub);
            	if(!$resultsub){die ("Could not query the database: <br />" . mysql_error());
			}
			
			while ($data=mysql_fetch_assoc($resultsub)){  

			  	if($data['name']==$installer){ 
	              	$cbo_installer .= "<option value = \"{$data['name']}\" selected>{$data['name']}</option>";
	            }else{
	            	$cbo_installer .= "<option value = \"{$data['name']}\">{$data['name']}</option>";
	            } 
		    }
$cbo_installer .= "</select>"; 
// <span class='' >Installer </span>
echo " 
		<label class='input' style=''> {$cbo_installer} </label> 
		<label class='input' style=''> <span class='' >Site Address </span><input type='text' value='{$site_address}' name='site_address' class=' ' style='border:1px solid #97989a;' > &nbsp;&nbsp; </label>
		<label class='input' style=''>  <select name='contract_status' style='width: 160px;'> <option value='' ". ($contract_status=='' ? 'selected':'').">Select Filter </option> <option value='drawing_approval' ". ($contract_status=='drawing_approval' ? 'selected':'').">Drawing Approval</option> <option value='development_approval' ". ($contract_status=='development_approval' ? 'selected':'').">Development Approval</option> <option value='framework_ordered' ". ($contract_status=='framework_ordered' ? 'selected':'').">Framework Ordered</option> <option value='jobs_scheduled' ". ($contract_status=='jobs_scheduled' ? 'selected':'').">Jobs To Be Scheduled</option> <option value='job_in_progress' ". ($contract_status=='job_in_progress' ? 'selected':'').">Job In Progress</option></select>
		</label> 
		<label class='input ' style=''> <select name='framework_type' style='width:113px'  > <option value='all' ". ($framework_type=='all' ? 'selected':'').">All Framework</option> <option value='dp' ". ($framework_type=='dp' ? 'selected':'')." >Drop-In</option><option value='fw' ". ($framework_type=='fw' ? 'selected':'')." >Framework</option> </select>
		</label>
		<label class='input ' style=''> <select name='job_status' style='width:120px'  > <option value='all' ". ($job_status=='all' ? 'selected':'').">All Jobs</option> <option value='incomplete' ". ($job_status=='incomplete' ? 'selected':'')." >Incomplete Jobs</option><option value='complete' ". ($job_status=='complete' ? 'selected':'')." >Complete Jobs</option> </select>
		</label>
	";

echo " <label class='input'><span>CR</span><input type='input' name='search_ID' value='".($search_ID!=''?$search_ID:"")."' style='border:1px solid #7C7D7F;' ></label>";


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
"; 

 
echo "
</div>
</div>

<!-- End of Advance Search --->
</div>
</form> 
</div>";


echo "<div id='container'>";
echo "<div class='pagination-layer'>";
pagination($page, $total_records, $paging_url); 
//"frdate=$frdate&todate=$todate&search_string=$search_string&replist=$replist&suburblist=$suburblist&advance_search=$advance_search&drawing_no_date=$drawing_no_date&easement=$easement&planning=$planning&mod=$mod"
echo "</div>";

//error_log("sql: ".$sql, 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_sa\\my-error.log'); 
$loop = mysql_query($sql)
	or die ('cannot run the query because: ' . mysql_error());
//error_log("end query: ".microtime(true), 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_sa\\my-error.log'); 
$html = "";

if(HOST_SERVER=="Victoria" || HOST_SERVER=="LA"){
	 
	if(isset($_POST['download_pdf'])==false){	
		$html .= "<table id=\"contract_table_list\" class=\"listing-table table-bordered\" style=\"font-family: Arial; font-size: 5pt;\"><tbody><tr  class='th-smaller'>".($is_admin?"<th width=\"\">Consultant</th>  ":"")."<th width=\"\">Contract ID</th><th width=\"50\">CRV</th><th width=\"\">Client Name</th><th width=\"\">Site Address</th><th>Contract Date</th><th>Total Price</th>  <th>Check Measure Date</th><th>Check Measurer</th><th>Drawing Approval</th><th>Permit Application</th>";
		if(HOST_SERVER=="Victoria" || HOST_SERVER=="LA"){$html .= "<th>Easement Waterboard</th><th>Easement Council</th><th>Planning</th><th>MOD</th><th>Engineering Approved</th>";}
		$html .="<th>Permit Approved</th><th>Framework Ordered</th><th>Production Completed</th><th>Con Note Number</th><th>Install Date</th><th>Installer</th><th> Completion Date</th><th>Final Inspection</th><th>Note</th></tr>";
	}else{
		$html .= "<table border=\"1\" cellpadding=\"1\" ><tbody><tr >".($is_admin?"<th width=\"50\">Consultant</th>  ":"")."<th width=\"50\">Contract ID</th><th width=\"50\">CRV</th><th width=\"80\">Client Name</th><th width=\"100\">Site Address</th> <th width=\"65\">Contract Date</th><th width=\"60\">Total Price</th> <th width=\"50\">Check Measure Date</th> <th width=\"50\">Check Measurer</th> <th width=\"50\">Drawing Approval</th><th width=\"50\">Permit Application</th>";
			if(HOST_SERVER=="Victoria" || HOST_SERVER=="LA"){$html .= "<th width=\"50\">Easement</th><th width=\"50\">Planning</th><th width=\"50\">MOD</th><th width=\"50\">Engineering Approved</th>";}
			$html .= "<th width=\"50\">Permit Approved</th><th width=\"50\">Framework Ordered</th><th width=\"50\">Production Completed</th><th>Con Note Number</th><th width=\"50\">Install Date</th><th> Installer </th><th width=\"50\"> Completion Date </th><th width=\"50\"> Final Inspection </th><th width=\"50\"> Final Inspection </th><th width=\"170\"> Note </th></tr>";
	}

	

	//error_log("start loop: ".microtime(true), 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_sa\\my-error.log'); 
	while ($record = mysql_fetch_assoc($loop)) {
		$money =$record['total_cost'];
	    $html .= "<tr  class=\"pointer td-smaller\" onclick=location.href=\"" . JURI::base() . "contract-listing-vic/contract-folder-vic?quoteid={$record['quoteid']}&projectid={$record['projectid']}\" >".
	    ($is_admin==1?"<td>".(isset($_POST['download_pdf'])?addslashes($record['sales_rep']):$record['sales_rep'])."</td>":"").
	    "<td>{$record['projectid']}</td><td>{$record['clientid']}</td>".
		($record['is_builder']==1?"<td>".(isset($_POST['download_pdf'])?addslashes($record['builder_name']):$record['builder_name'])."</td>":"<td>".(isset($_POST['download_pdf'])?addslashes($record['client_name']):$record['client_name'])."</td>").
		"<td>".(isset($_POST['download_pdf'])?addslashes($record['site_address']):$record['site_address'])."</td>" . 

		"<td>{$record['fcontractdate']}</td>" .
		"<td>$".number_format("$money",2,".",",")."</td>" . 
		"<td>{$record['fcheck_measure_date']}</td>" . 
		"<td>{$record['check_measurer']}</td>" . 
		
		"<td>{$record['fdrawing_approve_date']}</td>" . 
		"<td>{$record['fpermit_application_date']} </td>";
		if(HOST_SERVER=="Victoria" || HOST_SERVER=="LA"){$html .= "<td>".(empty($record['fstat_req_easement_waterboard_approval_date'])?' ':'W')." - {$record['stat_req_easement_waterboard_approval_date']} </td>" .
		"<td>".(empty($record['fstat_req_easement_council_approval_date'])?' ':'W')." - {$record['stat_req_easement_council_approval_date']} </td>" .
		"<td>".(empty($record['stat_req_planning_approval_date'])?' ':'W')." - {$record['stat_req_planning']}  </td>" . 
		"<td>{$record['m_o_d']} </td>" .
		"<td> {$record['fengineering_approved_date']}  </td>";
		}
		$html .="<td> {$record['fpermit_approved_date']}   </td>".
		"<td> {$record['ffw_orderdate']}  </td>" .
		"<td>{$record['fproduction_complete_date']}  </td>" .
		"<td>{$record['contract_note_number']}  </td>" .
		"<td>{$record['finstall_date']}  </td>" .
		"<td> ".(isset($_POST['download_pdf'])?addslashes($record['erectors_name']):$record['erectors_name'])." </td>" .
		"<td>{$record['fjob_end_date']} </td>" .
		"<td>{$record['ffinal_inspection_date']}  </td>" . 
		"<td>".addslashes(substr($record['note'],0,350))."</td>".
		"</tr>";
	}

}else if(HOST_SERVER=="SA"){ 
	 
	if(isset($_POST['download_pdf'])==true){	
	 	$html = "<table border=\"1\" cellpadding=\"1\" ><tbody><tr >".($is_admin?"<th width=\"60\">Consultant</th>  ":"")."<th width=\"50\">Contract ID</th><th width=\"50\">CR</th><th width=\"80\">Client Name</th><th width=\"100\">Site Address</th><th width=\"60\">Mobile Number</th> <th width=\"35\">FR / DI</th>  <th width=\"55\">Contract Date</th><th width=\"55\">Contract Value</th> <th width=\"60\">Check Measure Date</th> <th width=\"55\">Check Measurer</th> <th width=\"60\">Drawing Approval</th><th width=\"55\">Planning Application</th><th width=\"60\">Building Rules Application</th><th width=\"60\">Development Approval</th><th width=\"60\">Framework Ordered</th><th width=\"55\">Framework Completed</th><th width=\"55\">Scheduled Install Date</th> <th> Installer </th><th width=\"55\"> Job Complete</th><th width=\"55\"> Handover </th><th width=\"40\"> Warranty End</th><th width=\"170\"> Notes </th></tr>";

	}else{  
		$html = "<table id=\"contract_table_list\" class=\"listing-table table-bordered\" style=\"font-family: Arial; font-size: 8pt;\" ><tbody><tr >".($is_admin?"<th width=\"60\">Consultant</th>  ":"")."<th>Contract ID</th><th width=\"50\">CR</th><th width=\"60\">Client Name</th><th width=\"70\">Site Address</th><th>Mobile Number</th> <th width=\"35\">FR / DI</th> <th width=\"50\">Contract Date</th><th width=\"40\">Contract Value</th> <th width=\"40\">Check Measure Date</th> <th>Check Measurer</th> <th width=\"40\">Drawing Approval</th><th width=\"50\">Planning Application</th><th width=\"50\">Building Rules Application</th><th width=\"50\">Development Approval</th><th>Framework Ordered</th><th>Framework Completed</th><th>Scheduled Install Date</th> <th>Installer</th><th width=\"40\">Job Complete</th><th width=\"40\"> Handover </th><th width=\"40\"> Warranty End</th><th > Notes </th></tr>";

	}

	 while ($record = mysql_fetch_assoc($loop)) {
	 	//error_log(print_r($record,true), 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_sa\\my-error.log');
		$money =$record['total_cost'];
	    $html .= "<tr  class=\"pointer td-smaller\" onclick=location.href=\"" . JURI::base() . "contract-listing-vic/contract-folder-vic?quoteid={$record['quoteid']}&projectid={$record['projectid']}&ref=contract-listing-vic\" >".
	    ($is_admin==1?"<td>".(isset($_POST['download_pdf'])?addslashes($record['sales_rep']):$record['sales_rep'])."</td>":"").
	    "<td>{$record['projectid']}</td><td>{$record['clientid']}</td>".
		($record['is_builder']==1?"<td>".(isset($_POST['download_pdf'])?addslashes($record['builder_name']):$record['builder_name'])."</td>":"<td>".(isset($_POST['download_pdf'])?addslashes($record['client_name']):$record['client_name'])."</td>").
		"<td>".(isset($_POST['download_pdf'])?addslashes($record['site_address']):$record['site_address'])."</td>" . 

		"<td>{$record['client_mobile']}</td>" .
		"<td>{$record['ftype']}</td>" .
		"<td>{$record['fcontractdate']}</td>" .
		"<td>$".number_format("$money",2,".",",")."</td>" . 
		"<td>{$record['fcheck_measure_date']}</td>" . 
		"<td>{$record['check_measurer']}</td>" .  
		"<td>{$record['fdrawing_approve_date']}</td>" . 
		"<td>{$record['fplanning_application_date']} </td>" .   
		"<td> {$record['fbldg_rules_application']}</td>".
		"<td> {$record['fdev_approval_date']}</td>".
		"<td> {$record['ffw_orderdate']}  </td>" .
		"<td>{$record['ffw_complete']}  </td>" . 
		"<td>{$record['finstall_date']}  </td>" .
		"<td> ".(isset($_POST['download_pdf'])?addslashes($record['erectors_name']):$record['erectors_name'])." </td>" .
		"<td>{$record['fjob_end_date']} </td>" .
		"<td>{$record['fhandover_date']}  </td>" . 
		"<td>{$record['fwarranty_end_date']}  </td>" .  
		"<td>".addslashes(substr($record['note'],0,350))."</td>".
		"</tr>";
	}

}
//error_log("end loop: ".microtime(true), 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_sa\\my-error.log'); 
 
$html .= "</tbody></table>";
//error_log("HTML B4 INSERT : ".$html, 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_sa\\my-error.log');

 if(isset($_POST['download_pdf'])==true){

 		if(strlen($html)>200000){
 			return;
 		}
    	
    	if($advance_search){
    		$admin_add = "";
	    	$search_add = "";
	    	$suburb_add = "";
			
			if(strlen($search)>0){
				$search_add = "&nbsp;&nbsp;<b>Search :</b>".$search;
			}

			$admin_add = "";
			if($is_admin==1 && strlen($rep_id)>0){
				$sql = "SELECT * FROM ver_users WHERE RepID='{$rep_id}';";
				//error_log($sql, 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_sa\\my-error.log');
				$loop = mysql_query($sql);
				$record = mysql_fetch_assoc($loop);
				//error_log(print_r($record,true), 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_sa\\my-error.log'); 
				$admin_add = "&nbsp;&nbsp;<b>Consultant:</b> ".$record['name'];
			}
			
			if(strlen($suburb_name)>0){
				$suburb_add = "<b>Suburb:</b> {$suburb_name}";
			}

			$date_header = "";
			if(strlen($frdate) && strlen($todate)){
				$date_header = "<b>From :</b> ".date(PHP_DFORMAT, strtotime($frdate))." &nbsp;&nbsp;  &nbsp;&nbsp;  <b>To :</b> ".date(PHP_DFORMAT, strtotime($todate))." ";
			}

			$html ="<div><b>Filter</b> {$search_add}  {$admin_add}  {$suburb_add} &nbsp;&nbsp;  &nbsp;&nbsp;&nbsp;&nbsp; <br/> ".$date_header."<br/></div><br/>".$html;
 
		}else{
			$search_add = "";
			if(strlen($search)>0){
				$search_add = " <b>Search :&nbsp;&nbsp;</b>".$search;
				$html ="<div><b>Filter</b>  &nbsp;&nbsp; {$search_add}   </div><br/><br/>".$html;

			}else{
				$html ="<div><b>Filter: None</b>   </div><br/><br/>".$html;
			} 		
		}
 
		$title = $user->id."-".mt_rand();

		$sql = "DELETE FROM ver_chronoforms_data_letters_vic WHERE clientid='{$user->id}' AND template_type='contract list'  ";
		mysql_query($sql);
		
		//$html_pdf = "<div style=\"font-family:Arial, Helvetica, sans-serif;  font-size: 9pt;\">".$html."</div>";
		$sql = "INSERT INTO ver_chronoforms_data_letters_vic (clientid, template_name, datecreated, template_content, template_type) 
			 VALUES ('{$user->id}','$title', NOW(), '{$html}', 'contract list')"; 

		
		$r = mysql_query($sql); 
		//error_log("size = ".strlen($html), 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_sa\\my-error.log');  
		//error_log($sql, 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_sa\\my-error.log');  
	 	$redirect = "index.php?titleID={$title}&userid={$user->id}&option=com_chronoforms&tmpl=component&chronoform=Download-PDF-search-result";
		header('Location:'.JURI::base().$redirect);
		exit(); 
	}

echo $html;
    
echo "<div class='pagination-layer'>";
pagination($page, $total_records, $paging_url);
echo "</div></div>";

?>


<script>
$(window).load(function(){

$('#advlist1').click(function(){
	$('#advance-search').css("display", "block");
	$('#advlist2').css("display", "inline-block");
	$('#advlist1').css("display", "none");
	$('.search-listing').css("height", "150px");
	$('#advance-search label.input span').css("visibility", "visible");
	$('#advance_search').val('1');
	//$( "#chk_default_18mon" ).prop( "checked", true ); 
	//$("#chk_default_18mon").prop('disabled', true);

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


});

});


</script>