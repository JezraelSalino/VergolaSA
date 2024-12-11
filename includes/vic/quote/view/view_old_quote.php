 

<table class="listing-table ">
    <thead> 
    	<tr>
    		<td colspan="9" class="subheading" data-section='Frame' >
				VERGOLA 
    		</td>
    	</tr>
    	<tr>
    	<th style=" ">Description</th><th style="width:6%;">UOM</th><th style="width:7%;">QTY</th><th style="width:10%;">Length</th><th style="width:7%;">Cost</th><th style="width:7%;">RRP</th> 
    	</tr> 
    </thead>
    <tbody>  


	<?php
	$projectid = mysql_real_escape_string($_REQUEST['projectid']);

	$project_name = "";
    $project_framework_type = "";
    $project_framework = "";
    //------------- Framework Layout ---------------
    $sqlquotes = "SELECT i.*,i.cf_id AS id, inv.cf_id AS inv_cf_id, i.inventoryid AS inventory_id, inv.inventoryid, inv.section, inv.category, inv.description, inv.photo, inv.uom  FROM ver_chronoforms_data_quote_vic_old_system AS i  LEFT JOIN ver_chronoforms_data_inventory_vic_old_system AS inv ON inv.inventoryid=i.inventoryid   WHERE  i.projectid = '$projectid' ";  
    //error_log($sqlquotes, 3,'C:\\xampp\htdocs\\vergola_contract_system_v3\\my-error.log');
    
	$resultquotes = mysql_query ($sqlquotes) or die ('request "Could not execute SQL query" '.$sqlquotes);
 
		while($row = mysql_fetch_assoc($resultquotes)){

			if($row["section"]!="GUTTERING" && $row["section"]!="FLASHING" && $row["section"]!="MISCELLANOUS" && $row["section"]!="DISBURSEMENTS"){
				echo "<tr>  ";
 
				echo "<td> ".$row['description']." </td>";   
				
				echo "<td  class=\"td-item\"> {$row["uom"]}   </td>"; 
				echo "<td>  {$row["qty"]} </td>"; 
				echo "<td>  {$row["length"]}  </td>"; 
				echo "<td>{$row["cost"]}</td>";
				echo "<td>{$row["rrp"]}</td>"; 
				 
				echo "</tr>";
			}
		}
		?> 
		
	</tbody>
	</table> 


<table class="listing-table ">
    <thead>
    	<tr>
    		<td colspan="9" class="subheading" data-section='Frame' >
				Gutter 
    		</td>
    	</tr>
    	 
    	<tr><th style=" ">Description</th><th style="width:6%;">UOM</th><th style="width:7%;">QTY</th><th style="width:10%;">Length</th><th style="width:7%;">Cost</th><th style="width:7%;">RRP</th> 
    	</tr> 
    </thead>
    <tbody>  


	<?php
	$projectid = mysql_real_escape_string($_REQUEST['projectid']);
 
	 	mysql_data_seek($resultquotes, 0);
		while($row = mysql_fetch_assoc($resultquotes)){

			if($row["section"]=="GUTTERING"){
				echo "<tr>  "; 
				echo "<td> ".$row['description']." </td>";   
				
				echo "<td  class=\"td-item\"> {$row["uom"]}   </td>"; 
				echo "<td>  {$row["qty"]} </td>"; 
				echo "<td>  {$row["length"]}  </td>"; 
				echo "<td>{$row["cost"]}</td>";
				echo "<td>{$row["rrp"]}</td>"; 
				 
				echo "</tr>";
			}
		}
		?> 
		
	</tbody>
	</table> 	

	<table class="listing-table ">
    <thead>
    	<tr>
    		<td colspan="9" class="subheading" data-section='Frame' >
				FLASHING 
    		</td>
    	</tr>
    	 
    	<tr><th style=" ">Description</th><th style="width:6%;">UOM</th><th style="width:7%;">QTY</th><th style="width:10%;">Length</th><th style="width:7%;">Cost</th><th style="width:7%;">RRP</th> 
    	</tr> 
    </thead>
    <tbody>  


	<?php
	$projectid = mysql_real_escape_string($_REQUEST['projectid']);
 
	 	mysql_data_seek($resultquotes, 0);
		while($row = mysql_fetch_assoc($resultquotes)){

			if($row["section"]=="FLASHING"){
				echo "<tr>  ";
 
				echo "<td> ".$row['description']." </td>";   
				
				echo "<td  class=\"td-item\"> {$row["uom"]}   </td>"; 
				echo "<td>  {$row["qty"]} </td>"; 
				echo "<td>  {$row["length"]}  </td>"; 
				echo "<td>{$row["cost"]}</td>";
				echo "<td>{$row["rrp"]}</td>"; 
				 
				echo "</tr>";
			}
		}
		?> 
		
	</tbody>
	</table>


	<table class="listing-table ">
    <thead>
    	<tr>
    		<td colspan="9" class="subheading" data-section='Frame' >
				MISCELLANOUS 
    		</td>
    	</tr>
    	 
    	<tr><th style=" ">Description</th><th style="width:6%;">UOM</th><th style="width:7%;">QTY</th><th style="width:10%;">Length</th><th style="width:7%;">Cost</th><th style="width:7%;">RRP</th> 
    	</tr> 
    </thead>
    <tbody>  


	<?php
	$projectid = mysql_real_escape_string($_REQUEST['projectid']);
 
	 	mysql_data_seek($resultquotes, 0);
		while($row = mysql_fetch_assoc($resultquotes)){

			if($row["section"]=="MISCELLANOUS"){
				echo "<tr>  ";
 
				echo "<td> ".$row['description']." </td>";   
				
				echo "<td  class=\"td-item\"> {$row["uom"]}   </td>"; 
				echo "<td>  {$row["qty"]} </td>"; 
				echo "<td>  {$row["length"]}  </td>"; 
				echo "<td>{$row["cost"]}</td>";
				echo "<td>{$row["rrp"]}</td>"; 
				 
				echo "</tr>";
			}
		}
		?> 
		
	</tbody>
	</table>




	<table class="listing-table ">
    <thead>
    	<tr>
    		<td colspan="9" class="subheading" data-section='Frame' >
				DISBURSEMENTS 
    		</td>
    	</tr>
    	 
    	<tr><th style=" ">Description</th><th style="width:6%;">UOM</th><th style="width:7%;">QTY</th><th style="width:10%;">Length</th><th style="width:7%;">Cost</th><th style="width:7%;">RRP</th> 
    	</tr> 
    </thead>
    <tbody>  


	<?php
	$projectid = mysql_real_escape_string($_REQUEST['projectid']);
 
	 	mysql_data_seek($resultquotes, 0);
		while($row = mysql_fetch_assoc($resultquotes)){

			if($row["section"]=="DISBURSEMENTS"){
				echo "<tr>  ";
 
				echo "<td> ".$row['description']." </td>";   
				
				echo "<td  class=\"td-item\"> {$row["uom"]}   </td>"; 
				echo "<td>  {$row["qty"]} </td>"; 
				echo "<td>  {$row["length"]}  </td>"; 
				echo "<td>{$row["cost"]}</td>";
				echo "<td>{$row["rrp"]}</td>"; 
				 
				echo "</tr>";
			}
		}
		?> 
		
	</tbody>
	</table>


 

 