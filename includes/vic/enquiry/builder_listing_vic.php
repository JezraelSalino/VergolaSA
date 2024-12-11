<script src="<?php echo JURI::base().'jscript/jsapi.js'; ?>"></script>
<script type="text/javascript">google.load("jquery", "1");</script>
<script src="<?php echo JURI::base().'jscript/labels.js'; ?>"></script>
<link rel="stylesheet" type="text/css" media="screen,projection" href="<?php echo JURI::base().'jscript/custom.css'; ?>" />
<link rel="stylesheet" type="text/css" media="screen,projection" href="<?php echo JURI::base().'jscript/advance-search.css'; ?>" />
<script>
$(window).load(function(){ 
//This page is not use anymore because client & builder is just one client. Just tag the client is_builder to mark it as a builder.
return;

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
			echo "<a href=\"" . "builder-listing-vic" . "?page=$page" . (($query_string) ? "&$query_string" : "") . "\">";

		 if ($page == $current_page_number) {echo "<span class=\"current\">$page</span>";} else {echo "$page";}


		if ($page != $current_page_number)
			echo "</a>";

		$page++;
	}
}
 
define("NUMBER_PER_PAGE", 100); //number of records per page of the search results
$url = JURI::base().'builder-listing-vic';

//load the current paginated page number
$page = isset($_GET['page']) ? $_GET['page'] : 1;
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
if (!isset($rep_name)) $rep_name = '';
if (!isset($suburb_name)) $suburb_name= '';
if (!isset($frdate)) $frdate ='';
if (!isset($todate)) $todate = '';
if (!isset($rep_id)) $rep_id = '';
if (!isset($advance_search)) $advance_search = 0;


if(isset($_POST['search_string'])){ $search = $_POST['search_string']; }

if(isset($_POST['replist'])){ $rep_id = isset($_POST['replist']) ? $_POST['replist'] : $_GET['replist']; }

if(isset($_POST['suburblist'])){ $suburb_name = ($_POST['suburblist']) ? $_POST['suburblist'] : $_GET['suburblist']; }

if(isset($_POST['frdate'])){ $frdate = ($_POST['frdate']) ? $_POST['frdate'] : $_GET['frdate']; }

if(isset($_POST['todate'])){ $todate = ($_POST['todate']) ? $_POST['todate'] : $_GET['todate']; }
 
if(isset($_POST['rep_name'])){ $rep_name = ($_POST['rep_name']) ? $_POST['rep_name'] : $_GET['rep_name']; }

if(isset($_POST['advance_search'])){ $advance_search = ($_POST['advance_search']) ? $_POST['advance_search'] : $_GET['advance_search']; }

//display the search form
echo "<div class='search-listing'>
<form  action=\"" . JRoute::_($url) . "\" method=\"post\" id=\"chronoform_Listing_Module\" class='Chronoform hasValidation' style='float:none; width:90%'>
	<label>Search:</label> <input type='text' name='search_string' value=\"{$search}\" /> <input type='submit' name='submit' value='Search' class='search-btn' />";

if($advance_search==1){
	echo "<input type='button' id='advlist1' class='advance-search' value='Advance Search'>";
	echo "<input type='button' id='advlist2' class='advance-search' value='Advance Search'>"; 
	
}else{
	echo "<input type='button' id='advlist1' class='advance-search' value='Advance Search'>";
	echo "<input type='button' id='advlist2' class='advance-search' value='Advance Search'>";
}	
echo "<input type='submit' id='' class='advance-search' value='Download PDF' name='download_pdf'>";	
echo "<input type='hidden' name='advance_search' id='advance_search' value='{$advance_search}' />";

echo "<div id='advance-search' style='display:".($advance_search==1?'block':'none')."'>  
<!-- Start of Advance Search --->
<!-- Start of Rep List --->
<label class='input' ". (isset($user->groups["9"]) ? "style='display:none;'":"") ."> ". (isset($user->groups["9"])==false && $rep_id==""? "<span>Consultant</span>":"") ." <select class=\"rep-list\" id=\"replist\" name=\"replist\"><option></option>";
            $usergroup = 'Victoria Users';
            $queryrep="SELECT * FROM ver_users WHERE usertype LIKE ('$usergroup') ORDER BY name ASC";
            $resultrep = mysql_query($queryrep);
            if(!$resultrep){die ("Could not query the database: <br />" . mysql_error());
			}

			if(isset($user->groups['9'])){
				echo "<option value = '{$user->RepID}' selected>{$user->name}</option>";
			}else{
 
			  while ($data=mysql_fetch_assoc($resultrep)){
                  	if($data['RepID']==$rep_id){
			  			echo "<option value = '{$data['RepID']}' selected>{$data['name']}</option>";
			  		}else{
	                  	echo "<option value = '{$data['RepID']}'>{$data['name']}</option>";
	                }
		        }
 			} 
echo "</select></label>";  

echo "<label class='input'>".($suburb_name==''?"<span id='suburbspan'>Suburb</span>":"")."<select class=\"suburb-list\" id=\"suburblist\" name=\"suburblist\"><option></option>";
      
            $querysub="SELECT suburb FROM ver_chronoforms_data_suburbs_vic ORDER BY suburb ASC";

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



//$sql = "SELECT * FROM ver_chronoforms_data_builderpersonal_vic WHERE tenderstatus='No'";
//$result = mysql_query($sql) or die(mysql_error());
$searchdate = $frdate && $todate;
$search_string_filter = "";
if ($search)
	$search_string_filter .= " AND (builder_name LIKE '%"  . $search .  "%'" . 
	" OR site_address1 LIKE '%"  . $search .  "%'" . 
	" OR site_address2 LIKE '%"  . $search .  "%'" .
	" OR site_suburb LIKE '%"  . $search .  "%'" .
	" OR site_state LIKE '%"  . $search .  "%'" .
	" OR site_postcode LIKE '%"  . $search .  "%'" .
	" OR builder_wkphone LIKE '%"  . $search .  "%'" .
	" OR builder_mobile LIKE '%"  . $search .  "%'" .
	($is_admin?" OR repname LIKE '%"  . $search .  "%'":"").
	" )";


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
	$search_string_filter .= " AND repname LIKE '%" . $user->name . "%'";
}else{ 
	if ($rep_name)
		$search_string_filter .= " AND repname LIKE '%" . mysql_real_escape_string($rep_name) . "%'"; 
}	

if ($suburb_name)
	$suburb_filter .= " AND ((client_suburb LIKE '%" . mysql_real_escape_string($suburb_name) . "%') OR (site_suburb LIKE '%" . mysql_real_escape_string($suburb_name) . "%')) ";
	//$suburb_filter .= " AND site_suburb LIKE '%" . mysql_real_escape_string($suburb_name) . "%'";

//error_log($frdate." ".$todate, 3,'C:\\xampp\htdocs\\vergola_contract_system_v3\\my-error.log');
if (strlen($frdate)>0 && strlen($todate))
	$date_filter .= " AND DATE(datelodged) BETWEEN DATE('{$frdate}') AND DATE('{$todate}')";
	
 //$date_filter = " AND datelodged BETWEEN '" .  date('Y-m-d 00:00:00', strtotime($frdate)) . "'" . " AND '" . $todate . "'";	
	
// $sql = "SELECT *,n.content AS note FROM (SELECT * FROM ver_chronoforms_data_builderpersonal_vic AS b WHERE 1=1 {$rep_filter} AND tenderstatus='No' {$suburb_filter} {$date_filter} {$search_string_filter} ) AS b LEFT JOIN (SELECT * FROM (SELECT * FROM ver_chronoforms_data_followup_vic WHERE 1=1  ORDER BY cf_id DESC) as f0  GROUP BY quoteid ) AS f ON f.quoteid=b.builderid JOIN (SELECT * FROM ver_chronoforms_data_notes_vic ORDER BY cf_id DESC) AS n ON n.clientid=c.clientid";

$sql = "SELECT *,n.content AS note  FROM (SELECT * FROM ver_chronoforms_data_clientpersonal_vic AS c WHERE  is_builder=1 {$rep_filter} {$suburb_filter} {$date_filter} {$search_string_filter} ) AS c LEFT JOIN (SELECT * FROM (SELECT * FROM ver_chronoforms_data_followup_vic WHERE 1=1 {$rep_filter2}  ORDER BY cf_id DESC) as f0  GROUP BY quoteid ) AS f ON f.quoteid=c.clientid JOIN (SELECT * FROM ver_chronoforms_data_notes_vic ORDER BY cf_id desc) as n ON n.clientid=c.clientid ";

//error_log($sql, 3,'C:\\xampp\htdocs\\vergola_contract_system_v3\\my-error.log');// exit();
//$result = mysql_query($sql) or die(mysql_error());	


//this return the total number of records returned by our query
$total_records = mysql_num_rows(mysql_query($sql));

//now we limit our query to the number of results we want per page
//$sql .= " ORDER BY builder_name ASC LIMIT $start, " . NUMBER_PER_PAGE;

$sql .= " "; //ORDER BY builder_name ASC 
if(isset($_POST['download_pdf'])==false){	
	$sql .= " LIMIT $start, " . NUMBER_PER_PAGE;
}

//error_log($sql, 3,'C:\\xampp\htdocs\\vergola_contract_system_v3\\my-error.log');


/**
* Next we display our pagination at the top of our search results
* and we include the search words filled into our form so we can pass
* this information to the page numbers. That way as they click from page
* to page the query will pull up the correct results
**/
echo "<div id='container'>";
echo "<div class='pagination-layer'>";
pagination($page, $total_records, "datelodged=$searchdate&rep_id=$rep_id&builder_suburb=$suburb_name");
echo "</div>";
$html = "";

$loop = mysql_query($sql)
	or die ('cannot run the query because: ' . mysql_error());
	
 if(isset($_POST['download_pdf'])==false){	
$html .= "<table class=\"listing-table table-bordered\" cellspacing=\"0\" cellpadding=\"0\" style=\"font-size: 10pt;\"><tbody><tr><th width=\"10%\">Company Name</th><th width=\"12%\">Site Address</th><th width=\"6%\">Work Phone</th><th width=\"6%\">Mobile</th><th class=\"".(isset($user->groups['9'])?"hide":"")."\"  width=\"9%\">  Consultant</th><th width=\"6%\">Date of Enquiry</th><th width=\"6%\">Appointment Date</th><th width=\"6%\">Quote Value</th><th width=\"8%\">Quote Delivered</th><th width=\"6%\">Follow Up</th><th width=\"4%\">Status</th><th>Note</th></tr> ";

}else{
$html .= "<table class=\"listing-table table-bordered\" cellspacing=\"0\" cellpadding=\"0\" style=\"font-size: 10pt;\"><tbody><tr><th width=\"13%\"><b>Company Name</b></th><th width=\"14%\"><b>Site Address</b></th><th width=\"6%\"><b>Work Phone</b></th><th width=\"6%\"><b>Mobile</b></th><th class=\"".(isset($user->groups['9'])?"hide":"")."\"  width=\"12%\"> <b>Consultant</b></th><th width=\"8%\"><b>Date of Enquiry</b></th><th width=\"8%\"><b>Appointment Date</b></th><th width=\"6%\"><b>Quote Value</b></th><th width=\"7%\"><b>Quote Delivered</b></th><th width=\"7%\"><b>Follow Up</b></th><th width=\"6%\"><b>Status</b></th> </tr> ";

}
$i=0;
while ($record = mysql_fetch_assoc($loop)) {
	$QuoteID = $record['builderid'];
    $html .= "<tr class=\"pointer\" onclick=location.href=\"" . JURI::base() . "client-listing-vic/client-folder-vic?pid={$record['pid']}\"  ><td>{$record['builder_name']} </td>" . 
	"<td>{$record['site_streetno']} {$record['site_streetname']} {$record['site_address1']} {$record['site_address2']} <br />{$record['site_suburb']} {$record['site_state']} {$record['site_postcode']}</td>" . 
	// "<td>{$record['site_address1']} {$record['site_address2']} <br />{$record['site_suburb']} {$record['site_state']} {$record['site_postcode']}</td>" . 
	"<td>{$record['builder_wkphone']}</td>" . "<td>{$record['builder_mobile']}</td>" . 
	"<td class=\"".(isset($user->groups['9'])?"hide":"")."\">{$record['repname']}</td>";
	$html .= "<td>". date('d-M-Y',strtotime($record['datelodged'])). "</td>"; // Retreive Quote Value
	$html .= "<td>";
	if(empty($record['ffdate1'])==false && $record['ffdate1']!="0000-00-00") {$html .=  date('d-M-Y',strtotime($record['ffdate1']));}
	else if (empty($record['appointmentdate'])==false && $record['appointmentdate']!="0000-00-00 00:00:00"){$html .=  date('d-M-Y @ h:i A',strtotime($record['appointmentdate']));}
 	else{$html .=  "";} 
 	$html .=  "</td>";
	$html .=  "<td>".($record['total_rrp']>0 ?  "$".number_format($record['total_rrp'],2,".",",") :"")."</td>"; 	
	$html .=  "<td>";
		if (empty($record['qdelivered'])==false && $record['qdelivered']!="" && $record['qdelivered']!="0000-00-00"){$html .=  date('d-M-Y',strtotime($record['qdelivered']));} else {$html .=  "";}
	$html .=  "</td><td>"; // Retrieve Follow Ups
	
	if(empty($record['ffdate1'])==false && $record['ffdate1']!="0000-00-00") {$html .=  date('d-M-Y',strtotime($record['ffdate1']));}
	else if (empty($record['appointmentdate'])==false && $record['appointmentdate']!="0000-00-00 00:00:00"){$html .=  date('d-M-Y @ h:i A',strtotime($record['appointmentdate']));}
 	else{$html .=  "";}  
	// Retrieve Status
	$html .=  "</td><td>".$record['status']."</td>"; 
	$html .=  (isset($_POST['download_pdf'])==false ? "<td>".substr($record['note'],0,350)."</td>":""); 
	$html .=  "</tr>"; 
	$i++;
}

    $html .= "</tbody></table>";
    
//error_log("i: ".$i, 3,'C:\\xampp\htdocs\\vergola_contract_system_v3\\my-error.log'); 

 if(isset($_POST['download_pdf'])==true){

    	//error_log($html, 3,'C:\\xampp\htdocs\\vergola_contract_system_v3\\my-error.log');
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
				//error_log($sql, 3,'C:\\xampp\htdocs\\vergola_contract_system_v3\\my-error.log');
				$loop = mysql_query($sql);
				$record = mysql_fetch_assoc($loop);
				//error_log(print_r($record,true), 3,'C:\\xampp\htdocs\\vergola_contract_system_v3\\my-error.log');

				$admin_add = "&nbsp;&nbsp;<b>Consultant:</b> ".$record['name'];
			}
			
			if(strlen($suburb_name)>0){
				$suburb_add = "<b>Suburb:</b> {$suburb_name}";
			}

			$date_header = "";
			if(strlen($frdate) && strlen($todate)){
				$date_header = "<b>From :</b> ".date('d-M-Y', strtotime($frdate))." &nbsp;&nbsp;  &nbsp;&nbsp;  <b>To :</b> ".date('d-M-Y', strtotime($todate))." ";

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
		
		//$html_pdf = "<div style=\"font-family:Arial, Helvetica, sans-serif;  font-size: 9pt;\">".$html."</div>";
		$sql = "INSERT INTO ver_chronoforms_data_letters_vic (clientid, template_name, datecreated, template_content) 
			 VALUES ('{$user->id}','$title', NOW(), '{$html}')"; 

		
		mysql_query($sql); 
		//error_log($sql, 3,'C:\\xampp\htdocs\\vergola_contract_system_v3\\my-error.log');  
	 	$redirect = "index.php?titleID={$title}&userid={$user->id}&option=com_chronoforms&tmpl=component&chronoform=Download-PDF-search-result";
		header('Location:'.JURI::base().$redirect);
		exit(); 
	}

$html .= "<div class=\"pagination-layer\">";
echo $html;
pagination($page, $total_records, "datelodged=$searchdate&rep_id=$rep_id&builder_suburb=$suburb_name");
echo "</div></div>";