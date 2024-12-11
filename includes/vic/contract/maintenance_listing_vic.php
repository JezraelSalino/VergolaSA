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
			echo "<a href=\"" . "maintenance" . "?page=$page" . (($query_string) ? "&$query_string" : "") . "\">";

		 if ($page == $current_page_number) {echo "<span class=\"current\">$page</span>";} else {echo "$page";}


		if ($page != $current_page_number)
			echo "</a>";

		$page++;
	}
}



define("NUMBER_PER_PAGE",75); //number of records per page of the search results
$url = JURI::base().'maintenance';
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
if (!isset($status)) $status= ''; //open
  
if(isset($user->groups['9'])){
	$is_admin = 0;
}else{
	$is_admin = 1;
}


//error_log(" submit: ".$_REQUEST['submit']." search:".$_REQUEST['search'], 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_sa\\my-error.log');

if(isset($_REQUEST['submit']) || isset($_REQUEST['search'])){
	  
	if(isset($_POST['search_string'])){ $search_string = trim($_POST['search_string']); }
	 
	if(isset($_POST['replist'])){ $rep_id = $_POST['replist']; }

	if(isset($_POST['suburblist'])){ $suburb_name = $_POST['suburblist']; }

	if(isset($_POST['frdate'])){ $frdate = $_POST['frdate']; }

	if(isset($_POST['todate'])){ $todate = $_POST['todate']; }

	if(isset($_POST['advance_search'])){ $advance_search = $_POST['advance_search']; }
 
	if(isset($_POST['status'])){ $status = $_POST['status']; }  

	//error_log("start 1: ".$start, 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_sa\\my-error.log');

}else{
	 
	if(isset($_REQUEST['search_string'])){ $search_string = trim($_REQUEST['search_string']); }
	 
	if(isset($_REQUEST['replist'])){ $rep_id = $_REQUEST['replist']; }

	if(isset($_REQUEST['suburblist'])){ $suburb_name = $_REQUEST['suburblist']; }

	if(isset($_REQUEST['frdate'])){ $frdate = $_REQUEST['frdate']; }

	if(isset($_REQUEST['todate'])){ $todate = $_REQUEST['todate']; }

	if(isset($_REQUEST['advance_search'])){ $advance_search = $_REQUEST['advance_search']; }
  
	if(isset($_REQUEST['status'])){ $status = $_REQUEST['status']; }

	$page = isset($_GET['page']) ? $_GET['page'] : 1;
	$start = ($page-1) * NUMBER_PER_PAGE;

	//error_log(print_r($_GET,true), 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_sa\\my-error.log');
	//error_log("page: ".$page, 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_sa\\my-error.log');

	//error_log("start 2: ".$start, 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_sa\\my-error.log');

}

//error_log("_REQUEST: ".print_r($_REQUEST,true), 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_sa\\my-error.log');
//error_log("_POST: ".print_r($_POST,true), 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_sa\\my-error.log');
// error_log(" rep_id:  ".$rep_id, 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_sa\\my-error.log');
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
 

if($advance_search){
	$paging_url .= "&advance_search=1";
}
 
if($status){
	$paging_url .= "&status=".$status;
}

  
//-------------------------------- END Paging Parameter --------------------------------

$user = JFactory::getUser();
$groups = $user->get('groups'); 

//$result = mysql_query($sql) or die(mysql_error());
if(strlen($frdate) && strlen($todate)){
	$searchdate = $frdate;
}
$search_string_filter = "";

if ($search_string)
	//$search_string_filter .= " AND (cp.client_firstname LIKE '%"  . $search_string .  "%'" .
	//" OR cp.client_lastname LIKE '%"  . $search_string .  "%'" .
	$search_string_filter .= " AND (CONCAT(cp.client_firstname,' ',cp.client_lastname) LIKE '%"  . $search_string .  "%'" . 	 
	" OR cp.builder_name LIKE '%"  . $search_string .  "%'" .
	" OR c.quoteid LIKE '%"  . $search_string .  "%'" . 
	" OR site_address LIKE '%"  . $search_string .  "%'" . 
	" OR c.projectid LIKE '%"  . $search_string .  "%'" . 
	" OR project_name LIKE '%"  . $search_string .  "%'" . 
	" OR sales_rep LIKE '%"  . $search_string .  "%') ";
	//" OR erectors_name LIKE '%"  . $search_string .  "%' )";
 
$rep_filter = "   ";
$rep_filter2 = "  ";
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

//error_log(" rep_filter2:  ".$rep_filter2, 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_sa\\my-error.log');

$suburb_filter = "";
$date_filter = "";
$suburb_filter1 = "";
$suburb_filter2 = "";

if ($suburb_name){
	$suburb_filter = " AND cp.client_suburb LIKE '%" . $suburb_name . "%' ";
	//$suburb_filter2 .= " ON c.quoteid = cb.client_id ";
}

if ($searchdate)
	$date_filter = " AND DATE(c.contractdate) BETWEEN DATE('{$frdate}') AND DATE('{$todate}') ";
	
     
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

//$status = "";
//error_log("1: job_status: ".$job_status, 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_sa\\my-error.log');
$status_filter = "";
$default_filter = ""; 
$default_table_filter = ""; 

 
if($advance_search==0){
	$default_filter = "  ";
}else{
	$default_filter = "  ";
}

if($search_string=="" && $advance_search==0){ 
	$default_filter = " AND m.status='open' ";
	$default_table_filter = " JOIN ver_chronoform_maintenance_case_vic AS m ON m.projectid=c.projectid ";

}else{

	if($status=="open"){ 
		$status_filter = " AND m.status='open' ";
		$default_table_filter = " JOIN ver_chronoform_maintenance_case_vic AS m ON m.projectid=c.projectid ";
		 
	}else if($status=="close"){ 
		$status_filter = " AND m.status='close' ";
		$default_table_filter = " JOIN ver_chronoform_maintenance_case_vic AS m ON m.projectid=c.projectid ";
		 
	}else if($status=="both"){ 
		$status_filter = " AND (m.status='close' OR m.status='open') ";
		$default_table_filter = " JOIN ver_chronoform_maintenance_case_vic AS m ON m.projectid=c.projectid ";
	}

}

	$sql = "SELECT c.projectid, c.quoteid, cp.clientid, CONCAT(coalesce(cp.client_firstname,''),' ',coalesce(cp.client_lastname,''),' ',coalesce(cp.builder_name,'')) as customer_name, CONCAT(coalesce(cp.site_address1,''),' ',coalesce(cp.site_suburb,''),' ',coalesce(cp.site_state,''),' ',coalesce(cp.site_postcode,'')) as client_address, cp.client_mobile, cv.erectors_name, cv.handover_date, DATE_FORMAT(cv.handover_date,'{$sql_dformat}') fhandover_date, cv.elect_warranty_end_date, DATE_FORMAT(cv.elect_warranty_end_date,'{$sql_dformat}') felect_warranty_end_date, cv.warranty_end_date, DATE_FORMAT(cv.warranty_end_date,'{$sql_dformat}') fwarranty_end_date FROM ver_chronoforms_data_contract_list_vic AS c JOIN ver_chronoforms_data_contract_vergola_vic AS cv ON cv.projectid=c.projectid JOIN ver_chronoforms_data_clientpersonal_vic AS cp ON cp.clientid=c.quoteid  {$default_table_filter} WHERE 1=1 {$default_filter} {$search_string_filter} {$status_filter} {$rep_filter2} {$suburb_filter} {$date_filter} ";


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

 
echo "<input type='hidden' name='advance_search' id='advance_search' value='{$advance_search}' />";

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
if(HOST_SERVER=="SA"){
	$class_hide = " hide ";
}


$cbo_status = "<select    name=\"status\"><option value=''>Select Status</option>"; 
	$cbo_status .= "<option value = \"\" ".($status==""?"selected":"").">No Case</option>"; 
	$cbo_status .= "<option value = \"open\" ".($status=="open"?"selected":"")." >Open Case</option>";
	$cbo_status .= "<option value = \"close\" ".($status=="close"?"selected":"").">Close Case</option>";
	$cbo_status .= "<option value = \"both\" ".($status=="both"?"selected":"").">Both Open & Close</option>"; 
$cbo_status .= "</select>";  

echo "  <label class='input' style=''> {$cbo_status} </label> ";


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
<input type='submit' name='search' value='Search' class='search-btn' />
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
 

	if(isset($_POST['download_pdf'])==true){	
	 	$html = "<table border=\"1\" cellpadding=\"1\" ><tbody><tr >".($is_admin?"<th width=\"60\">Consultant</th>  ":"")."<th width=\"50\">Contract ID</th><th width=\"80\">Client Name</th><th width=\"100\">Site Address</th><th width=\"60\">Mobile Number</th> <th width=\"35\">FR / DI</th> <th width=\"55\">Contract Date</th><th width=\"55\">Contract Value</th> <th width=\"60\">Check Measure Date</th> <th width=\"55\">Check Measurer</th> <th width=\"60\">Drawing Approval</th><th width=\"55\">Planning Application</th><th width=\"60\">Building Rules Application</th><th width=\"60\">Development Approval</th><th width=\"60\">Framework Ordered</th><th width=\"55\">Framework Completed</th><th width=\"55\">Scheduled Install Date</th> <th> Installer </th><th width=\"55\"> Job Complete</th><th width=\"55\"> Handover </th><th width=\"40\"> Warranty End</th><th width=\"170\"> Notes </th></tr>";

	}else{  
		$html .= "<table id=\"\" class=\"listing-table table-bordered\" style=\"font-size: 10pt;\"><tbody><tr  class=' '><th width=\"\">Contract</th><th width=\"\">Client Name</th><th width=\"\">Site Address</th><th>Handover Date</th><th>Warranty Start</th>  <th> Electical Warranty End</th><th>Structural  Warranty End</th><th>Action</th> </tr>"; 


	}

	while ($record = mysql_fetch_assoc($loop)) {
	 	//error_log(print_r($record,true), 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_sa\\my-error.log');
		$money =$record['total_cost'];
	    $html .= "<tr  class=\"pointer  \" onclick=location.href=\"" . JURI::base() . "maintenance/maintenance-folder-vic?page_name=maintenancefolder&quoteid={$record['quoteid']}&projectid={$record['projectid']}\" > 
	    <td>{$record['projectid']}</td>". 
		"<td>{$record['customer_name']}</td>" .
		"<td>{$record['client_address']}</td>" . 
		"<td> {$record['fhandover_date']}  </td>" .
		"<td>{$record['felect_warranty_end_date']}  </td>" . 
		"<td>{$record['fwarranty_end_date']}  </td>" . 
		"<td>  </td>".  
		"</tr>";
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