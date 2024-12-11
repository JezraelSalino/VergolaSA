<div id="tabs_container">
	<ul id="contract-tabs" class="shadetabs">  
		<li><a href="#" rel="maintenancedetails" class="<?php echo ($tab_active=="maintenancedetails"?"selected":""); ?>">Maintenance Details</a></li>
		<li><a href="#" rel="jobhistory" class="<?php echo ($tab_active=="jobhistory"?"selected":""); ?>">Job History</a></li> 
	</ul> 
</div>

<div id="tabs_content_container"> 
    <!-- Contract Details Tab -->
    <div id="maintenancedetails" class="tab_content" style="display: block;">
    		<a class="btn" href="<?php echo JURI::base().'maintenance/maintenance-case?type=new&projectid='.$projectid; ?>" style='margin: 5px 0px 0px 5px;'>Create Case</a>

    		<?php
 
$sql = "SELECT m.id, CONCAT(coalesce(p.client_firstname,''),' ',coalesce(p.client_lastname,''),' ',coalesce(p.builder_name,'')) as customer_name,DATE_FORMAT(m.created_at,'".SQL_DFORMAT."') fcreated_at, m.issue, m.maintenance_person, m.status FROM ver_chronoform_maintenance_case_vic AS m JOIN ver_chronoforms_data_clientpersonal_vic as p ON p.clientid=m.clientid WHERE m.projectid='{$projectid}' AND m.status = 'open' ";
    $sql_result = mysql_query ($sql) or die ('request "Could not execute SQL query" '.$sql);
	
	echo "<table  class=\"listing-table\" style='margin:15px 0;'  ><tr class=\"th-smaller\"><th   style='width:10%;' >Case Number</th><th>Created Date</th><th>Customer</th><th>Issue</th><th>Maintenance Person</th><th>Status</th><th>&nbsp;</th></tr>";
    while ($row = mysql_fetch_assoc($sql_result)) 
    {   
	  echo "<tr class=\"td-smaller\">
		  		<td class=\"\"  >".$row["id"]."</td>".
		       	"<td >".$row["fcreated_at"]."</td>" .
			   	"<td class=\"\"> ".$row["customer_name"]."</td>" .
			   	"<td class=\"\">".$row["issue"]."</td>" .
			   	"<td class=\"\">".$row["maintenance_person"]."</td>" . 
			    "<td class=\"\">".$row["status"]."</td>" .
			    "<td class=\"\"> <a href='".JURI::base().'maintenance/maintenance-case?projectid='.$projectid.'&caseid='.$row["id"]."&type=edit"."'>Edit</a></td>" .
		   	"</tr>";
    } 
	
	echo "</table>"; 

?>
 
    </div>
 
    <!-- Contract Details Tab -->
    <div id="jobhistory" class="tab_content" style="display: none;">
    	  
<?php
 
$sql = "SELECT m.id, CONCAT(coalesce(p.client_firstname,''),' ',coalesce(p.client_lastname,''),' ',coalesce(p.builder_name,'')) as customer_name,DATE_FORMAT(m.created_at,'".SQL_DFORMAT."') fcreated_at, m.issue, m.maintenance_person, m.status FROM ver_chronoform_maintenance_case_vic AS m JOIN ver_chronoforms_data_clientpersonal_vic as p ON p.clientid=m.clientid WHERE m.projectid='{$projectid}' AND m.status = 'close' ";
    $sql_result = mysql_query ($sql) or die ('request "Could not execute SQL query" '.$sql);
	
	echo "<table  class=\"listing-table\" style='margin:10px 0;'  ><tr class=\"th-smaller\"><th   style='width:10%;' >Case Number</th><th>Created Date</th><th>Customer</th><th>Issue</th><th>Maintenance Person</th><th>Status</th> </tr>";
    while ($row = mysql_fetch_assoc($sql_result)) 
    {   
	  echo "<tr class=\"td-smaller\">
		  		<td class=\"\"  >".$row["id"]."</td>".
		       	"<td >".$row["fcreated_at"]."</td>" .
			   	"<td class=\"\"> ".$row["customer_name"]."</td>" .
			   	"<td class=\"\">".$row["issue"]."</td>" .
			   	"<td class=\"\">".$row["maintenance_person"]."</td>" . 
			    "<td class=\"\">".$row["status"]."</td>" . 
		   	"</tr>";
    } 
	
	echo "</table>"; 

?>


    </div>
</div>