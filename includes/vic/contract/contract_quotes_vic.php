<?php
$QuoteIDAlpha = substr($QuoteID, 0, 3);
$sql = "SELECT * FROM ver_chronoforms_data_followup_vic WHERE quoteid = '$QuoteID' and status = 'Won' ORDER BY FIELD(status,'Won'), quotedate DESC ";
    $sql_result = mysql_query ($sql) or die ('request "Could not execute SQL query" '.$sql);
	
	echo "<table id=\"tbl-quoted\"><tr><th>Project Name</th><th>Quote Date</th><th>Quote Value</th><th>Sales Rep</th><th>Type</th><th>Status</th><th></th></tr>";
    while ($rowff = mysql_fetch_assoc($sql_result)) 
    {   $cfid = $rowff['cf_id'];
	    $money = $rowff["total_rrp"];
	  echo "<tr><td class=\"tbl-name\">".$rowff["project_name"]."</td>".
	       "<td class=\"tbl-date\">".date(PHP_DFORMAT,strtotime($rowff["quotedate"]))."</td>" .
		   "<td class=\"tbl-date\"> $".number_format("$money",2,".",",")."</td>" .
		   "<td class=\"tbl-date\">".$rowff["sales_rep"]."</td>" .
		   "<td class=\"tbl-date\">".$rowff["framework_type"]."</td>" .
		   "<td class=\"tbl-date\">{$rowff["status"]}</td>" .
		   "<td class=\"tbl-date\"><center><input type='button' value='View Quote' onclick=location.href='" . JURI::base() . "view-contractquote-vic?quoteid={$QuoteID}&projectid={$rowff['projectid']}'></center>
		   </td></tr>";
    } 
	
	echo "</table>";
 

?>
