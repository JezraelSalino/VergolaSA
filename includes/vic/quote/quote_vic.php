<?php //$cfid = $_REQUEST['cf_id'];  echo $cfid;?>
<script>
$(document).ready(
  function(){

<?php if (isset($_REQUEST['cf_id']) == "") { ?>   
	$('input[name=selproject]:first').attr('checked', true);
<?php } ?>

$('input.selinput').on('change', function() {
    $('input.selinput').not(this).prop('checked', false);   
});

});
  
</script>

<?php

//error_log("QuoteID: ".$QuoteID, 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_sa\\my-error.log');  
$QuoteIDAlpha = substr($QuoteID, 0, 3);
//echo $QuoteIDAlpha;
$sql = "SELECT * FROM ver_chronoforms_data_followup_vic WHERE quoteid = '$QuoteID' ORDER BY updated_at DESC, cf_id DESC ";
//FIELD(status,'Won','In Progress','Under Consideration','Future Project', 'Quoted','Superseded','Lost'), quotedate

//error_log(" is_tender_quote:".$is_tender_quote, 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_sa\\my-error.log');    
    $sql_result = mysql_query ($sql) or die ('request "Could not execute SQL query" '.$sql);
	
	$isFirst=1; $cf_id="";
	echo "<div id=\"innerbox\" style=\"margin:5px 0 0 0;\">". 
		 "<table id=\"tbl-quoted\">" .
	     "<tr><th>Project Name</th><th>Costing Date</th><th>Costing Value</th><th>Sales Rep</th><th>Type</th><th>Status</th><th>Select</th><th></th></tr>";
    while ($rowff = mysql_fetch_assoc($sql_result)) 
    {   
    	if(!empty($rowff["date_contract_system_created"])){$has_contract=1;}
    	$cfid = $rowff['cf_id'];
	    $money = $rowff["total_cost"];
     	$folder_link = "";
	    if($is_tender_quote==1){
	   		$folder_link = "tender-listing-vic/tender-folder-vic?tenderid={$id}&cf_id={$rowff["cf_id"]}";
	    }else{
	   		$folder_link = "client-listing-vic/client-folder-vic?pid={$id}&cf_id={$rowff["cf_id"]}";
	    }

	  echo "<tr><td class=\"tbl-name\">".$rowff["project_name"]."</td>".
	       "<td class=\"tbl-date\">".date('d-M-Y',strtotime($rowff["quotedate"]))."</td>" .
		   "<td class=\"tbl-date\"> $".number_format("$money",2,".",",")."</td>" .
		   "<td class=\"tbl-date\">".$rowff["sales_rep"]."</td>" .
		   "<td class=\"tbl-date\">".$rowff["framework_type"]."</td>" .
		   "<td class=\"tbl-date\">".(strtolower($rowff["status"])=="quoted"?"Costing":$rowff["status"])."</td>" .
		   "<td class=\"tbl-date\"><center><input type=\"checkbox\" class=\"selinput\" name=\"selproject\" value=\"{$rowff["cf_id"]}\" 
		   onclick=location.href='" . JURI::base() . "{$folder_link}' ";
		   //if ($QuoteIDAlpha == 'CRV'){ echo "onclick=location.href='" . JURI::base() . "client-listing-vic/client-folder-vic?pid={$id}&cf_id={$rowff["cf_id"]}'";} 
		   //else {echo "onclick=location.href='" . JURI::base() . "builder-listing-vic/builder-folder-vic?pid={$id}&cf_id={$rowff["cf_id"]}'";}
		  

		   if ($rowff["cf_id"] == (isset($_REQUEST['cf_id']) ? $_REQUEST['cf_id'] : NULL)) { echo " checked=\"checked\"";}
		   echo"></center></td>".
		   "<td class=\"tbl-date\"><center>".(!empty($rowff["date_contract_system_created"])?"<input type='button' value='View Contract' onclick=location.href='" . JURI::base() . "contract-listing-vic/contract-folder-vic?quoteid={$rowff['quoteid']}&projectid={$rowff['projectid']}&ref={$folder_link}'>":"<input type='button' value='View Costing' onclick=location.href='" . JURI::base() . "view-quote-vic?projectid={$rowff['projectid']}&ref={$ref}'>")."</center>
		   </td></tr>";

		   if($isFirst){
		   		if(isset($_REQUEST['cf_id'])){
		   			$cf_id = mysql_real_escape_string($_REQUEST['cf_id']);

		   		}else{
		   			$cf_id = mysql_real_escape_string($rowff["cf_id"]);
		   		}
		   		$isFirst = 0;
		   }
		   //"<td class=\"tbl-date\"><input type='button' value='View Quote' onclick=location.href='" . JURI::base() . "includes/quote/view/viewquote_vic.php?projectid={$row['projectid']}'>
		  // </td></tr>";
    } 

	echo "<input type='hidden' value='{$cf_id}' name='cf_id' />";
	echo "</table></div>";
 

?>