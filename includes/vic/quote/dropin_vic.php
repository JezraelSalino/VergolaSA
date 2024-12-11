<?php
$next_increment = 0;
$qShowStatus = "SHOW TABLE STATUS LIKE 'ver_chronoforms_data_followup_vic'";
$qShowStatusResult = mysql_query($qShowStatus) or die ( "Query failed: " . mysql_error() . "<br/>" . $qShowStatus );
$row = mysql_fetch_assoc($qShowStatusResult);
$next_increment = $row['Auto_increment'];
$getprojectid = 'PRV'.$next_increment;

$ReplaceCHAR = $QuoteID;

$resultb = mysql_query("SELECT builderid, repname FROM ver_chronoforms_data_builderpersonal_vic WHERE builderid  = '$QuoteID'");
$retrieveb = mysql_fetch_array($resultb);
if (!$resultb) {die("Error: Data not found..");}
$BuilderID = $retrieveb['builderid'];
if($BuilderID == $QuoteID) {$PID = str_replace('BRV', '', $ReplaceCHAR); } 
else {$PID = str_replace('CRV', '', $ReplaceCHAR); }

$salesrepb = $retrieveb['repname'];

$resultc = mysql_query("SELECT clientid, repname FROM ver_chronoforms_data_clientpersonal_vic WHERE clientid  = '$QuoteID'");
$retrievec = mysql_fetch_array($resultc);
if (!$resultc) {die("Error: Data not found..");}

$salesrepc = $retrievec['repname'];

if($salesrepb != "") {$salesrep = $salesrepb; }
elseif($salesrepc != ""){$salesrep = $salesrepc; }


if(isset($_POST['quotedate'])){ 
$date =  $_POST['quotedate']; 
$timestamp = date('Y-m-d H:i:s', strtotime($date)); 
$DateLodged = $timestamp;
}


$cbeam200ID = "1";
$cbeam250ID = "3";

if(isset($_POST['save-dropin']))
{	
$ProjectName = $_POST['projectsite'];
$DateQuote = $_POST['quotedate'];
$FrameworkTYP = $_POST['frameworktype'];
$Framework = $_POST['framework'];

$Length = $_POST['length'];
$Width = $_POST['width'];
$Bay = "";

$qty = implode(", ", $_POST['qty']);
$cnt = count($_POST['colour']);
$cnt2 = count($_POST['uom']);
$cnt3 = count($_POST['qty']);
$cnt4 = count($_POST['webbing']);
$cnt5 = count($_POST['paint']);
$cnt6 = count($_POST['invent']);
$cnt7 = count($_POST['slength']);
$cnt8 = count($_POST['rrp']);
$cnt9 = count($_POST['cst']);


if ($cnt > 0 && $cnt == $cnt2 && $cnt2 == $cnt3 && $cnt3 == $cnt4 && $cnt4 == $cnt5 && $cnt5 == $cnt6 && $cnt6 == $cnt7 && $cnt7 == $cnt8 && $cnt8 == $cnt9) {
    $insertArr = array();
    
	for ($i=0; $i<$cnt; $i++) {

       	
$insertArr[] = "('$QuoteID', '" . mysql_real_escape_string($_POST['invent'][$i]) . "', '$getprojectid', '$ProjectName', '$FrameworkTYP', '$Framework', '" . mysql_real_escape_string($_POST['slength'][$i]) . "', '" . mysql_real_escape_string($_POST['desc'][$i]) . "', '" . mysql_real_escape_string($_POST['colour'][$i]) . "', '" . mysql_real_escape_string($_POST['qty'][$i]) . "', '" . mysql_real_escape_string($_POST['webbing'][$i]) . "', '" . mysql_real_escape_string($_POST['paint'][$i]) . "', '" . mysql_real_escape_string($_POST['uom'][$i]) . "', '" . mysql_real_escape_string($_POST['rrp'][$i]) . "', '" . mysql_real_escape_string($_POST['cst'][$i]) . "')";
}

$queryn = "INSERT INTO ver_chronoforms_data_quote_vic (quoteid, inventoryid, projectid, project_name, framework_type, framework, length, description, colour, qty, webbing, finish, uom, rrp, cost) VALUES " . implode(", ", $insertArr);
 
 mysql_query($queryn) or trigger_error("Insert failed: " . mysql_error());

}
$SubtotalVergola = $_POST['subtotalvergola'];
$SubtotalDisbursement = $_POST['subtotaldisd'];
$Totalrrp = $_POST['totalrrp'];
$Totalgst = $_POST['totalgst'];
$Totalrrpgst = $_POST['totalrrpgst'];
$Totalcost = $_POST['totalcost'];
$Totalcostgst = $_POST['totalcostgst'];
$GSTPercent = $_POST['gst'];
$CommPercent = $_POST['commision'];
$SalesCost = $_POST['salescost'];
$InstallCost = $_POST['installercost'];




$queryp = "INSERT INTO ver_chronoforms_data_followup_vic 
(sales_rep, 
quoteid, 
projectid, 
quotedate, 
project_name, 
framework_type, 
subtotal_vergola, 
subtotal_disbursement, 
total_rrp, 
total_gst, 
total_rrp_gst, 
total_cost, 
total_cost_gst, 
gst_percent, 
comm_percent, 
sales_comm, 
install_comm, 
sales_comm_cost, 
install_comm_cost, 
status) 

VALUES 
('$salesrep', 
'$QuoteID', 
'$getprojectid', 
'$DateLodged', 
'$ProjectName', 
'$FrameworkTYP',
'$SubtotalVergola',
'$SubtotalDisbursement', 
'$Totalrrp',
'$Totalgst', 
'$Totalrrpgst',
'$Totalcost', 
'$Totalcostgst',  
'$GSTPercent', 
'$CommPercent', 
'$SalesComm', 
'$InstallComm', 
'$SalesCost', 
'$InstallCost', 'Quoted')";
 
 mysql_query($queryp) or trigger_error("Insert failed: " . mysql_error());
 
$querym = "INSERT INTO ver_chronoforms_data_measurement_vic (projectid, framework_type, width, length, bay) VALUES ('$getprojectid', '$FrameworkTYP', '$Width', '$Length', '$Bay')";
 
 mysql_query($querym) or trigger_error("Insert failed: " . mysql_error());
    
header('Location:'.JURI::base().'view-quote-vic?projectid='.$getprojectid);
	
}

if(isset($_POST['save-close-dropin']))
{	
$ProjectName = $_POST['projectsite'];
$DateQuote = $_POST['quotedate'];
$FrameworkTYP = $_POST['frameworktype'];
$Framework = $_POST['framework'];

$Length = $_POST['length'];
$Width = $_POST['width'];
$Bay = "";

$qty = implode(", ", $_POST['qty']);
$cnt = count($_POST['colour']);
$cnt2 = count($_POST['uom']);
$cnt3 = count($_POST['qty']);
$cnt4 = count($_POST['webbing']);
$cnt5 = count($_POST['paint']);
$cnt6 = count($_POST['invent']);
$cnt7 = count($_POST['slength']);
$cnt8 = count($_POST['rrp']);
$cnt9 = count($_POST['cst']);


if ($cnt > 0 && $cnt == $cnt2 && $cnt2 == $cnt3 && $cnt3 == $cnt4 && $cnt4 == $cnt5 && $cnt5 == $cnt6 && $cnt6 == $cnt7 && $cnt7 == $cnt8 && $cnt8 == $cnt9) {
    $insertArr = array();
    
	for ($i=0; $i<$cnt; $i++) {

       	
$insertArr[] = "('$QuoteID', '" . mysql_real_escape_string($_POST['invent'][$i]) . "', '$getprojectid', '$ProjectName', '$FrameworkTYP', '$Framework', '" . mysql_real_escape_string($_POST['slength'][$i]) . "', '" . mysql_real_escape_string($_POST['desc'][$i]) . "', '" . mysql_real_escape_string($_POST['colour'][$i]) . "', '" . mysql_real_escape_string($_POST['qty'][$i]) . "', '" . mysql_real_escape_string($_POST['webbing'][$i]) . "', '" . mysql_real_escape_string($_POST['paint'][$i]) . "', '" . mysql_real_escape_string($_POST['uom'][$i]) . "', '" . mysql_real_escape_string($_POST['rrp'][$i]) . "', '" . mysql_real_escape_string($_POST['cst'][$i]) . "')";
}

$queryn = "INSERT INTO ver_chronoforms_data_quote_vic (quoteid, inventoryid, projectid, project_name, framework_type, framework, length, description, colour, qty, webbing, finish, uom, rrp, cost) VALUES " . implode(", ", $insertArr);
 
 mysql_query($queryn) or trigger_error("Insert failed: " . mysql_error());

}
$SubtotalVergola = $_POST['subtotalvergola'];
$SubtotalDisbursement = $_POST['subtotaldisd'];
$Totalrrp = $_POST['totalrrp'];
$Totalgst = $_POST['totalgst'];
$Totalrrpgst = $_POST['totalrrpgst'];
$Totalcost = $_POST['totalcost'];
$Totalcostgst = $_POST['totalcostgst'];
$GSTPercent = $_POST['gst'];
$CommPercent = $_POST['commision'];
$SalesCost = $_POST['salescost'];
$InstallCost = $_POST['installercost'];




$queryp = "INSERT INTO ver_chronoforms_data_followup_vic 
(sales_rep, 
quoteid, 
projectid, 
quotedate, 
project_name, 
framework_type, 
subtotal_vergola, 
subtotal_disbursement, 
total_rrp, 
total_gst, 
total_rrp_gst, 
total_cost, 
total_cost_gst, 
gst_percent, 
comm_percent, 
sales_comm, 
install_comm, 
sales_comm_cost, 
install_comm_cost, 
status) 

VALUES 
('$salesrep', 
'$QuoteID', 
'$getprojectid', 
'$DateLodged', 
'$ProjectName', 
'$FrameworkTYP',
'$SubtotalVergola',
'$SubtotalDisbursement', 
'$Totalrrp',
'$Totalgst', 
'$Totalrrpgst',
'$Totalcost', 
'$Totalcostgst',  
'$GSTPercent', 
'$CommPercent', 
'$SalesComm', 
'$InstallComm', 
'$SalesCost', 
'$InstallCost', 'Quoted')";
 
 mysql_query($queryp) or trigger_error("Insert failed: " . mysql_error());
 
$querym = "INSERT INTO ver_chronoforms_data_measurement_vic (projectid, framework_type, width, length, bay) VALUES ('$getprojectid', '$FrameworkTYP', '$Width', '$Length', '$Bay')";
 
 mysql_query($querym) or trigger_error("Insert failed: " . mysql_error());
    
if($BuilderID == $QuoteID) {header('Location:'.JURI::base().'builder-listing-vic/builder-folder-vic?pid='.$PID);} 
else {header('Location:'.JURI::base().'client-listing-vic/client-folder-vic?pid='.$PID);}
	
}

echo "<table class=\"listing-table\"><tr><th>Description</th><th>Webbing</th><th>Colour</th><th>Finish</th><th>UOM</th><th>QTY</th><th>Length</th><th>RRP</th></tr>";
// ***************************** First Standard Vergola Gutter Lip Out 200 x 200 ********************************************//
echo "<tr><td colspan=\"8\" class=\"subheading\">Gutters</td></tr>";
echo "<tr id=\"stdgutter1\" style=\"display: table-row;\"><td><select class=\"desclist\" name=\"desclist[]\" >";
        $resultgutter = mysql_query("SELECT cf_id, inventoryid, description, uom, rrp, cost FROM ver_chronoforms_data_inventory_vic WHERE section = 'Guttering' and category  = 'Gutters Standard'" );
		while ($gutter = mysql_fetch_array($resultgutter)) {
		include "standardgutter_vic.php";
      	echo "<option value=\"".$gutter['cf_id']."\"";
		if($gutter['cf_id'] == '27') { echo "selected=\"selected\""; } echo ">".$gutter['description']."</option>";	
		}	

echo "</select>";
    
	 $guttering = mysql_query("SELECT cf_id, inventoryid, description, uom, rrp, cost FROM ver_chronoforms_data_inventory_vic WHERE section = 'Guttering' and category  = 'Gutters Standard' and cf_id = '27'" );
	 $retgut = mysql_fetch_array($guttering);
	 
echo "<input type=\"hidden\" class=\"desc\" name=\"desc[]\" value=\"".$retgut['description']."\" readonly=\"readonly\" />".
     "<input type=\"hidden\" class=\"invent\" name=\"invent[]\" value=\"".$retgut['inventoryid']."\" readonly=\"readonly\" />".
     "<input type=\"hidden\" class=\"descrrp\" name=\"descrrp\" value=\"".$retgut['rrp']."\" readonly=\"readonly\" />".
     "<input type=\"hidden\" class=\"desccost\" name=\"desccost\" value=\"".$retgut['cost']."\" readonly=\"readonly\" /></td>";

// Webbing
echo"<td><input type=\"hidden\" class=\"webbing\" name=\"webbing[]\" value=\"\" readonly=\"readonly\" /></td>";

// Colours
echo "<td><div id=\"col9\"></div></td>";

// Paint and Powder
echo "<td><div id=\"cbd1\"></div></td>";

// Unit of Measurement
$resultuom = mysql_query("SELECT uom FROM ver_chronoforms_data_inventory_vic WHERE section = 'Guttering' and category  = 'Gutters Standard' GROUP BY uom" );
echo "<td>";
     while ($uom = mysql_fetch_array($resultuom)) {
      	echo "<input type=\"text\" name=\"uom[]\" id=\"uom\" readonly=\"readonly\" value=\"".$uom['uom']."\">";	
		}	
echo "</td>";
 
 // Unit Quantity
echo "<td><input type=\"text\" id=\"addqty7\" name=\"qty[]\" value=\"1\"></td>";

// Length or Width
echo "<td><input type=\"text\" class=\"width\" name=\"slength[]\" value=\"0\"></td>";

// Total RRP
echo "<td><input type=\"text\" class=\"rrp\" readonly=\"readonly\" name=\"rrp[]\" value=\"\"><input type=\"hidden\" class=\"cst\" name=\"cst[]\" value=\"\"></td></tr>";

// ***************************** Second Standard Vergola Gutter Lip Out 250 x 250 ********************************************//

echo "<tr id=\"stdgutter2\" style=\"display: table-row;\"><td><select class=\"desclist\" name=\"desclist[]\" >";
     $resultgutter = mysql_query("SELECT cf_id, inventoryid, description, uom, rrp, cost FROM ver_chronoforms_data_inventory_vic WHERE section = 'Guttering' and category  = 'Gutters Standard'" );
		while ($gutter = mysql_fetch_array($resultgutter)) {
		include "standardgutter_vic.php";
      	echo "<option value=\"".$gutter['cf_id']."\"";
		if($gutter['cf_id'] == '28') { echo "selected=\"selected\""; } echo ">".$gutter['description']."</option>";	
		}	

echo "</select>";
    
	 $guttering = mysql_query("SELECT cf_id, inventoryid, description, uom, rrp, cost FROM ver_chronoforms_data_inventory_vic WHERE section = 'Guttering' and category  = 'Gutters Standard' and cf_id = '28'" );
	 $retgut = mysql_fetch_array($guttering);
	 
echo "<input type=\"hidden\" class=\"desc\" name=\"desc[]\" value=\"".$retgut['description']."\" readonly=\"readonly\" />".
     "<input type=\"hidden\" class=\"invent\" name=\"invent[]\" value=\"".$retgut['inventoryid']."\" readonly=\"readonly\" />".
     "<input type=\"hidden\" class=\"descrrp\" name=\"descrrp\" value=\"".$retgut['rrp']."\" readonly=\"readonly\" />".
     "<input type=\"hidden\" class=\"desccost\" name=\"desccost\" value=\"".$retgut['cost']."\" readonly=\"readonly\" /></td>";

// Webbing
echo"<td><input type=\"hidden\" class=\"webbing\" name=\"webbing[]\" value=\"\" readonly=\"readonly\" /></td>";

// Colours
echo "<td><div id=\"col10\"></div></td>";

// Paint and Powder
echo "<td><div id=\"cbd2\"></div></td>";

// Unit of Measurement
$resultuom = mysql_query("SELECT uom FROM ver_chronoforms_data_inventory_vic WHERE section = 'Guttering' and category  = 'Gutters Standard' GROUP BY uom" );
echo "<td>";
     while ($uom = mysql_fetch_array($resultuom)) {
      	echo "<input type=\"text\" name=\"uom[]\" id=\"uom\" readonly=\"readonly\" value=\"".$uom['uom']."\">";	
		}	
echo "</td>";

// Unit Quantity

echo "<td><input type=\"text\" id=\"addqty8\" name=\"qty[]\" value=\"1\"></td>";

// Length or Width
echo "<td><input type=\"text\"  class=\"width\" name=\"slength[]\" value=\"0\"></td>";

// Total RRP
echo "<td><input type=\"text\" class=\"rrp\" readonly=\"readonly\" name=\"rrp[]\" value=\"\"><input type=\"hidden\" class=\"cst\" name=\"cst[]\" value=\"\"></td></tr>";

// ***************************** Third Standard Vergola Tappered  Gutter Lip Out 200 x 250 ********************************************//

echo "<tr id=\"stdgutter3\" style=\"display: table-row;\"><td><select class=\"desclist\" name=\"desclist[]\" >";
     $resultgutter = mysql_query("SELECT cf_id, inventoryid, description, uom, rrp, cost FROM ver_chronoforms_data_inventory_vic WHERE section = 'Guttering' and category  = 'Gutters Standard'" );
		while ($gutter = mysql_fetch_array($resultgutter)) {
		include "standardgutter_vic.php";
      	echo "<option value=\"".$gutter['cf_id']."\"";
		if($gutter['cf_id'] == '29') { echo "selected=\"selected\""; } echo ">".$gutter['description']."</option>";	
		}	

echo "</select>";
    
	 $guttering = mysql_query("SELECT cf_id, inventoryid, description, uom, rrp, cost FROM ver_chronoforms_data_inventory_vic WHERE section = 'Guttering' and category  = 'Gutters Standard' and cf_id = '29'" );
	 $retgut = mysql_fetch_array($guttering);
	 
echo "<input type=\"hidden\" class=\"desc\" name=\"desc[]\" value=\"".$retgut['description']."\" readonly=\"readonly\" />".
     "<input type=\"hidden\" class=\"invent\" name=\"invent[]\" value=\"".$retgut['inventoryid']."\" readonly=\"readonly\" />".
     "<input type=\"hidden\" class=\"descrrp\" name=\"descrrp\" value=\"".$retgut['rrp']."\" readonly=\"readonly\" />".
     "<input type=\"hidden\" class=\"desccost\" name=\"desccost\" value=\"".$retgut['cost']."\" readonly=\"readonly\" /></td>";

// Webbing
echo"<td><input type=\"hidden\" class=\"webbing\" name=\"webbing[]\" value=\"\" readonly=\"readonly\" /></td>";

// Colours
echo "<td><div id=\"col11\"></div></td>";

// Paint and Powder
echo "<td><div id=\"cbd3\"></div></td>";

// Unit of Measurement
$resultuom = mysql_query("SELECT uom FROM ver_chronoforms_data_inventory_vic WHERE section = 'Guttering' and category  = 'Gutters Standard' GROUP BY uom" );
echo "<td>";
     while ($uom = mysql_fetch_array($resultuom)) {
      	echo "<input type=\"text\" name=\"uom[]\" id=\"uom\" readonly=\"readonly\" value=\"".$uom['uom']."\">";	
		}	
echo "</td>";

// Unit Quantity
echo "<td><input type=\"text\" id=\"addqty9\" name=\"qty[]\" value=\"1\"></td>";

// Length or Width
echo "<td><input type=\"text\" class=\"width\" name=\"slength[]\" value=\"0\"></td>";

// Total RRP
echo "<td><input type=\"text\" class=\"rrp\" readonly=\"readonly\" name=\"rrp[]\" value=\"\"><input type=\"hidden\" class=\"cst\" name=\"cst[]\" value=\"\"></td></tr>";

// ***************************** Fourth Standard Vergola Tappered Gutter Lip Out 250 x 200 ********************************************//

echo "<tr id=\"stdgutter4\" style=\"display: table-row;\"><td><select class=\"desclist\" name=\"desclist[]\" >";
     
		$resultgutter = mysql_query("SELECT cf_id, inventoryid, description, uom, rrp, cost FROM ver_chronoforms_data_inventory_vic WHERE section = 'Guttering' and category  = 'Gutters Standard'" );
		while ($gutter = mysql_fetch_array($resultgutter)) {
		include "standardgutter_vic.php";
      	echo "<option value=\"".$gutter['cf_id']."\"";
		if($gutter['cf_id'] == '30') { echo "selected=\"selected\""; } echo ">".$gutter['description']."</option>";	
		}	

echo "</select>";
    
	 $guttering = mysql_query("SELECT cf_id, inventoryid, description, uom, rrp, cost FROM ver_chronoforms_data_inventory_vic WHERE section = 'Guttering' and category  = 'Gutters Standard' and cf_id = '30'" );
	 $retgut = mysql_fetch_array($guttering);
	 
echo "<input type=\"hidden\" class=\"desc\" name=\"desc[]\" value=\"".$retgut['description']."\" readonly=\"readonly\" />".
     "<input type=\"hidden\" class=\"invent\" name=\"invent[]\" value=\"".$retgut['inventoryid']."\" readonly=\"readonly\" />".
     "<input type=\"hidden\" class=\"descrrp\" name=\"descrrp\" value=\"".$retgut['rrp']."\" readonly=\"readonly\" />".
     "<input type=\"hidden\" class=\"desccost\" name=\"desccost\" value=\"".$retgut['cost']."\" readonly=\"readonly\" /></td>";

// Webbing
echo"<td><input type=\"hidden\" class=\"webbing\" name=\"webbing[]\" value=\"\" readonly=\"readonly\" /></td>";

// Colours
echo "<td><div id=\"col12\"></div></td>";

// Paint and Powder
echo "<td><div id=\"cbd4\"></div></td>";

// Unit of Measurement
$resultuom = mysql_query("SELECT uom FROM ver_chronoforms_data_inventory_vic WHERE section = 'Guttering' and category  = 'Gutters Standard' GROUP BY uom" );
echo "<td>";
     while ($uom = mysql_fetch_array($resultuom)) {
      	echo "<input type=\"text\" name=\"uom[]\" id=\"uom\" readonly=\"readonly\" value=\"".$uom['uom']."\">";	
		}	
echo "</td>";

// Unit Quantity
echo "<td><input type=\"text\" id=\"addqty10\" name=\"qty[]\" value=\"1\"></td>";

// Length or Width
echo "<td><input type=\"text\" class=\"width\" name=\"slength[]\" value=\"0\"></td>";

// Total RRP
echo "<td><input type=\"text\" class=\"rrp\" readonly=\"readonly\" name=\"rrp[]\" value=\"\"><input type=\"hidden\" class=\"cst\" name=\"cst[]\" value=\"\"></td></tr>";

// ***************************** Fifth Standard Vergola Gutter Lip Out 200 x 200 ********************************************//

echo "<tr id=\"stdgutter5\" style=\"display: none;\">";

echo"<td><div id=\"stdgut1\"></div></td>";

// Webbing
echo"<td><input id=\"removegutter1\" onClick=\"hidegutter1();\" type=\"button\" value=\"Remove Gutter\" /><input type=\"hidden\" class=\"webbing\" name=\"webbing[]\" value=\"\" readonly=\"readonly\" /></td>";

// Colours
echo "<td><div id=\"col13\"></div></td>";

// Paint and Powder
echo "<td><div id=\"cbd5\"></div></td>";

// Unit of Measurement
$resultuom = mysql_query("SELECT uom FROM ver_chronoforms_data_inventory_vic WHERE section = 'Guttering' and category  = 'Gutters Standard' GROUP BY uom" );
echo "<td>";
     while ($uom = mysql_fetch_array($resultuom)) {
      	echo "<input type=\"text\" name=\"uom[]\" id=\"uom\" readonly=\"readonly\" value=\"".$uom['uom']."\">";	
		}	
echo "</td>";

// Unit Quantity
echo "<td><input type=\"text\" id=\"addqty11\" name=\"qty[]\" value=\"0\"></td>";

// Length or Width
echo "<td><input type=\"text\" class=\"xlength\" name=\"slength[]\" value=\"0\"></td>";

// Total RRP
echo "<td><input type=\"text\" class=\"rrp\" readonly=\"readonly\" name=\"rrp[]\" value=\"\"><input type=\"hidden\" class=\"cst\" name=\"cst[]\" value=\"\"></td></tr>";

// ***************************** Sixth Standard Vergola Gutter Lip Out 200 x 200 ********************************************//

echo "<tr id=\"stdgutter6\" style=\"display: none;\">";

echo"<td><div id=\"stdgut2\"></div></td>";

// Webbing
echo"<td><input id=\"removegutter2\" onClick=\"hidegutter2();\" type=\"button\" value=\"Remove Gutter\" /><input type=\"hidden\" class=\"webbing\" name=\"webbing[]\" value=\"\" readonly=\"readonly\" /></td>";

// Colours
echo "<td><div id=\"col14\"></div></td>";

// Paint and Powder
echo "<td><div id=\"cbd6\"></div></td>";

// Unit of Measurement
$resultuom = mysql_query("SELECT uom FROM ver_chronoforms_data_inventory_vic WHERE section = 'Guttering' and category  = 'Gutters Standard' GROUP BY uom" );
echo "<td>";
     while ($uom = mysql_fetch_array($resultuom)) {
      	echo "<input type=\"text\" name=\"uom[]\" id=\"uom\" readonly=\"readonly\" value=\"".$uom['uom']."\">";	
		}	
echo "</td>";

// Unit Quantity
echo "<td><input type=\"text\" id=\"addqty12\" name=\"qty[]\" value=\"0\"></td>";

// Length or Width
echo "<td><input type=\"text\" class=\"xlength\" name=\"slength[]\" value=\"0\"></td>";

// Total RRP
echo "<td><input type=\"text\" class=\"rrp\" readonly=\"readonly\" name=\"rrp[]\" value=\"\"><input type=\"hidden\" class=\"cst\" name=\"cst[]\" value=\"\"></td></tr>";

// ***************************** Seventh Standard Vergola Gutter Lip Out 200 x 200 ********************************************//

echo "<tr id=\"stdgutter7\" style=\"display: none;\">";

echo"<td><div id=\"stdgut3\"></div></td>";

// Webbing
echo"<td><input id=\"removegutter3\" onClick=\"hidegutter3();\" type=\"button\" value=\"Remove Gutter\" /><input type=\"hidden\" class=\"webbing\" name=\"webbing[]\" value=\"\" readonly=\"readonly\" /></td>";

// Colours
echo "<td><div id=\"col15\"></div></td>";

// Paint and Powder
echo "<td><div id=\"cbd7\"></div></td>";

// Unit of Measurement
$resultuom = mysql_query("SELECT uom FROM ver_chronoforms_data_inventory_vic WHERE section = 'Guttering' and category  = 'Gutters Standard' GROUP BY uom" );
echo "<td>";
     while ($uom = mysql_fetch_array($resultuom)) {
      	echo "<input type=\"text\" name=\"uom[]\" id=\"uom\" readonly=\"readonly\" value=\"".$uom['uom']."\">";	
		}	
echo "</td>";

// Unit Quantity
echo "<td><input type=\"text\" id=\"addqty13\" name=\"qty[]\" value=\"0\"></td>";

// Length or Width
echo "<td><input type=\"text\" class=\"xlength\" name=\"slength[]\" value=\"0\"></td>";

// Total RRP
echo "<td><input type=\"text\" class=\"rrp\" readonly=\"readonly\" name=\"rrp[]\" value=\"\"><input type=\"hidden\" class=\"cst\" name=\"cst[]\" value=\"\"></td></tr>";

// ***************************** Eight Standard Vergola Gutter Lip Out 200 x 200 ********************************************//

echo "<tr id=\"stdgutter8\" style=\"display: none;\">";

echo"<td><div id=\"stdgut4\"></div></td>";

// Webbing
echo"<td><input id=\"removegutter4\" onClick=\"hidegutter4();\" type=\"button\" value=\"Remove Gutter\" /><input type=\"hidden\" class=\"webbing\" name=\"webbing[]\" value=\"\" readonly=\"readonly\" /></td>";

// Colours
echo "<td><div id=\"col16\"></div></td>";

// Paint and Powder
echo "<td><div id=\"cbd8\"></div></td>";

// Unit of Measurement
$resultuom = mysql_query("SELECT uom FROM ver_chronoforms_data_inventory_vic WHERE section = 'Guttering' and category  = 'Gutters Standard' GROUP BY uom" );
echo "<td>";
     while ($uom = mysql_fetch_array($resultuom)) {
      	echo "<input type=\"text\" name=\"uom[]\" id=\"uom\" readonly=\"readonly\" value=\"".$uom['uom']."\">";	
		}	
echo "</td>";

// Unit Quantity
echo "<td><input type=\"text\" id=\"addqty14\" name=\"qty[]\" value=\"0\"></td>";

// Length or Width
echo "<td><input type=\"text\" class=\"xlength\" name=\"slength[]\" value=\"0\"></td>";

// Total RRP
echo "<td><input type=\"text\" class=\"rrp\" readonly=\"readonly\" name=\"rrp[]\" value=\"\"><input type=\"hidden\" class=\"cst\" name=\"cst[]\" value=\"\"></td></tr>";

// ***************************** First Non-Standard Vergola Gutter Lip Out 225 x 225 ********************************************//

echo "<tr id=\"nonstdgutter1\" style=\"display: none;\">";

echo "<td><div id=\"nonstdgut1\"></div></td>";


// Webbing
echo"<td><input id=\"removenonstd1\" onClick=\"hidenonstd1();\" type=\"button\" value=\"Remove Gutter\" /><input type=\"hidden\" class=\"webbing\" name=\"webbing[]\" value=\"\" readonly=\"readonly\" /></td>";

// Colours
echo "<td><div id=\"col17\"></div></td>";

// Paint and Powder
echo "<td><div id=\"cbd9\"></div></td>";

// Unit of Measurement
echo "<td><input type=\"text\" name=\"uom[]\" class=\"uom\" readonly=\"readonly\" value=\"Mtrs\"></td>";

// Unit Quantity
echo "<td><input type=\"text\" id=\"addqty15\" name=\"qty[]\" value=\"0\"></td>";

// Length or Width
echo "<td><input type=\"text\" class=\"xlength\" name=\"slength[]\" value=\"0\"></td>";

// Total RRP
echo "<td><input type=\"text\" class=\"rrp\" readonly=\"readonly\" name=\"rrp[]\" value=\"\"><input type=\"hidden\" class=\"cst\" name=\"cst[]\" value=\"\"></td></tr>";

// ***************************** Second Non-Standard Vergola Tapered Gutter Lip Out 200 x 225 ********************************************//

echo "<tr id=\"nonstdgutter2\" style=\"display: none;\">";

echo "<td><div id=\"nonstdgut2\"></div></td>";


// Webbing
echo"<td><input id=\"removenonstd2\" onClick=\"hidenonstd2();\" type=\"button\" value=\"Remove Gutter\" /><input type=\"hidden\" class=\"webbing\" name=\"webbing[]\" value=\"\" readonly=\"readonly\" /></td>";

// Colours
echo "<td><div id=\"col18\"></div></td>";

// Paint and Powder
echo "<td><div id=\"cbd10\"></div></td>";

// Unit of Measurement
echo "<td><input type=\"text\" name=\"uom[]\" class=\"uom\" readonly=\"readonly\" value=\"Mtrs\"></td>";

// Unit Quantity
echo "<td><input type=\"text\" id=\"addqty16\" name=\"qty[]\" value=\"0\"></td>";

// Length or Width
echo "<td><input type=\"text\" class=\"xlength\" name=\"slength[]\" value=\"0\"></td>";

// Total RRP
echo "<td><input type=\"text\" class=\"rrp\" readonly=\"readonly\" name=\"rrp[]\" value=\"\"><input type=\"hidden\" class=\"cst\" name=\"cst[]\" value=\"\"></td></tr>";

// ***************************** Third Non Standard Vergola Tappered Gutter Lip Out 225 x 250 ********************************************//


echo "<tr id=\"nonstdgutter3\" style=\"display: none;\">";

echo "<td><div id=\"nonstdgut3\"></div></td>";


// Webbing
echo"<td><input id=\"removenonstd3\" onClick=\"hidenonstd3();\" type=\"button\" value=\"Remove Gutter\" /><input type=\"hidden\" class=\"webbing\" name=\"webbing[]\" value=\"\" readonly=\"readonly\" /></td>";

// Colours
echo "<td><div id=\"col19\"></div></td>";

// Paint and Powder
echo "<td><div id=\"cbd11\"></div></td>";

// Unit of Measurement
echo "<td><input type=\"text\" name=\"uom[]\" class=\"uom\" readonly=\"readonly\" value=\"Mtrs\"></td>";

// Unit Quantity
echo "<td><input type=\"text\" id=\"addqty17\" name=\"qty[]\" value=\"0\"></td>";

// Length or Width
echo "<td><input type=\"text\" class=\"xlength\" name=\"slength[]\" value=\"0\"></td>";

// Total RRP
echo "<td><input type=\"text\" class=\"rrp\" readonly=\"readonly\" name=\"rrp[]\" value=\"\"><input type=\"hidden\" class=\"cst\" name=\"cst[]\" value=\"\"></td></tr>";

// ***************************** Fourth Non Standard Vergola Tappered Gutter Lip Out 250 x 225 ********************************************//

echo "<tr id=\"nonstdgutter4\" style=\"display: none;\">";

echo "<td><div id=\"nonstdgut4\"></div></td>";


// Webbing
echo"<td><input id=\"removenonstd4\" onClick=\"hidenonstd4();\" type=\"button\" value=\"Remove Gutter\" /><input type=\"hidden\" class=\"webbing\" name=\"webbing[]\" value=\"\" readonly=\"readonly\" /></td>";

// Colours
echo "<td><div id=\"col20\"></div></td>";

// Paint and Powder
echo "<td><div id=\"cbd12\"></div></td>";

// Unit of Measurement
echo "<td><input type=\"text\" name=\"uom[]\" class=\"uom\" readonly=\"readonly\" value=\"Mtrs\"></td>";

// Unit Quantity
echo "<td><input type=\"text\" id=\"addqty18\" name=\"qty[]\" value=\"0\"></td>";

// Length or Width
echo "<td><input type=\"text\" class=\"xlength\" name=\"slength[]\" value=\"0\"></td>";

// Total RRP
echo "<td><input type=\"text\" class=\"rrp\" readonly=\"readonly\" name=\"rrp[]\" value=\"\"><input type=\"hidden\" class=\"cst\" name=\"cst[]\" value=\"\"></td></tr>";

// ***************************** Fifth Non Standard Vergola Tappered Gutter Lip Out 225 x 200 ********************************************//

echo "<tr id=\"nonstdgutter5\" style=\"display: none;\">";

echo "<td><div id=\"nonstdgut5\"></div></td>";


// Webbing
echo"<td><input id=\"removenonstd5\" onClick=\"hidenonstd5();\" type=\"button\" value=\"Remove Gutter\" /><input type=\"hidden\" class=\"webbing\" name=\"webbing[]\" value=\"\" readonly=\"readonly\" /></td>";

// Colours
echo "<td><div id=\"col21\"></div></td>";

// Paint and Powder
echo "<td><div id=\"cbd13\"></div></td>";

// Unit of Measurement
echo "<td><input type=\"text\" name=\"uom[]\" class=\"uom\" readonly=\"readonly\" value=\"Mtrs\"></td>";

// Unit Quantity
echo "<td><input type=\"text\" id=\"addqty19\" name=\"qty[]\" value=\"0\"></td>";

// Length or Width
echo "<td><input type=\"text\" class=\"xlength\" name=\"slength[]\" value=\"0\"></td>";

// Total RRP
echo "<td><input type=\"text\" class=\"rrp\" readonly=\"readonly\" name=\"rrp[]\" value=\"\"><input type=\"hidden\" class=\"cst\" name=\"cst[]\" value=\"\"></td></tr>";

// ***************************** Sixth Non Standard Bracket Gutter 190-240 ********************************************//


echo "<tr id=\"nonstdgutter6\" style=\"display: none;\">";

echo "<td><div id=\"nonstdgut6\"></div></td>";


// Webbing
echo"<td><input id=\"removenonstd6\" onClick=\"hidenonstd6();\" type=\"button\" value=\"Remove Gutter\" /><input type=\"hidden\" class=\"webbing\" name=\"webbing[]\" value=\"\" readonly=\"readonly\" /></td>";

// Colours
echo "<td><div id=\"col22\"></div></td>";

// Paint and Powder
echo "<td><div id=\"cbd14\"></div></td>";

// Unit of Measurement
echo "<td><input type=\"text\" name=\"uom[]\" class=\"uom\" readonly=\"readonly\" value=\"Mtrs\"></td>";

// Unit Quantity
echo "<td><input type=\"text\" id=\"addqty20\" name=\"qty[]\" value=\"0\"></td>";

// Length or Width
echo "<td><input type=\"text\" class=\"xlength\" name=\"slength[]\" value=\"0\"></td>";

// Total RRP
echo "<td><input type=\"text\" class=\"rrp\" readonly=\"readonly\" name=\"rrp[]\" value=\"\"><input type=\"hidden\" class=\"cst\" name=\"cst[]\" value=\"\"></td></tr>";


// ***************************** Seventh Non Standard Vergola Guttering Sleeve ********************************************//

echo "<tr id=\"nonstdgutter7\" style=\"display: none;\">";

echo "<td><div id=\"nonstdgut7\"></div></td>";


// Webbing
echo"<td><input id=\"removenonstd7\" onClick=\"hidenonstd7();\" type=\"button\" value=\"Remove Gutter\" /><input type=\"hidden\" class=\"webbing\" name=\"webbing[]\" value=\"\" readonly=\"readonly\" /></td>";

// Colours
echo "<td><div id=\"col23\"></div></td>";

// Paint and Powder
echo "<td><div id=\"cbd15\"></div></td>";

// Unit of Measurement
echo "<td><input type=\"text\" name=\"uom[]\" class=\"uom\" readonly=\"readonly\" value=\"Mtrs\"></td>";

// Unit Quantity
echo "<td><input type=\"text\" id=\"addqty21\" name=\"qty[]\" value=\"0\"></td>";

// Length or Width
echo "<td><input type=\"text\" class=\"xlength\" name=\"slength[]\" value=\"0\"></td>";

// Total RRP
echo "<td><input type=\"text\" class=\"rrp\" readonly=\"readonly\" name=\"rrp[]\" value=\"\"><input type=\"hidden\" class=\"cst\" name=\"cst[]\" value=\"\"></td></tr>";

// ***************************** Eight Non Standard Vergola Zincalume STD 250mm ********************************************//


echo "<tr id=\"nonstdgutter8\" style=\"display: none;\">";

echo "<td><div id=\"nonstdgut8\"></div></td>";


// Webbing
echo"<td><input id=\"removenonstd8\" onClick=\"hidenonstd8();\" type=\"button\" value=\"Remove Gutter\" /><input type=\"hidden\" class=\"webbing\" name=\"webbing[]\" value=\"\" readonly=\"readonly\" /></td>";

// Colours
echo "<td><div id=\"col24\"></div></td>";

// Paint and Powder
echo "<td><div id=\"cbd16\"></div></td>";

// Unit of Measurement
echo "<td><input type=\"text\" name=\"uom[]\" class=\"uom\" readonly=\"readonly\" value=\"Mtrs\"></td>";

// Unit Quantity
echo "<td><input type=\"text\" id=\"addqty22\" name=\"qty[]\" value=\"0\"></td>";

// Length or Width
echo "<td><input type=\"text\" class=\"xlength\" name=\"slength[]\" value=\"0\"></td>";

// Total RRP
echo "<td><input type=\"text\" class=\"rrp\" readonly=\"readonly\" name=\"rrp[]\" value=\"\"><input type=\"hidden\" class=\"cst\" name=\"cst[]\" value=\"\"></td></tr>";

// ***************************** Ninth Non Standard Vergola Cbond 150mm pan ********************************************//

echo "<tr id=\"nonstdgutter9\" style=\"display: none;\">";

echo "<td><div id=\"nonstdgut9\"></div></td>";


// Webbing
echo"<td><input id=\"removenonstd9\" onClick=\"hidenonstd9();\" type=\"button\" value=\"Remove Gutter\" /><input type=\"hidden\" class=\"webbing\" name=\"webbing[]\" value=\"\" readonly=\"readonly\" /></td>";

// Colours
echo "<td><div id=\"col25\"></div></td>";

// Paint and Powder
echo "<td><div id=\"cbd17\"></div></td>";

// Unit of Measurement
echo "<td><input type=\"text\" name=\"uom[]\" class=\"uom\" readonly=\"readonly\" value=\"Mtrs\"></td>";

// Unit Quantity
echo "<td><input type=\"text\" id=\"addqty23\" name=\"qty[]\" value=\"0\"></td>";

// Length or Width
echo "<td><input type=\"text\" class=\"xlength\" name=\"slength[]\" value=\"0\"></td>";

// Total RRP
echo "<td><input type=\"text\" class=\"rrp\" readonly=\"readonly\" name=\"rrp[]\" value=\"\"><input type=\"hidden\" class=\"cst\" name=\"cst[]\" value=\"\"></td></tr>";

// Add New Standard Gutter 1
echo "<tr id=\"stdgutter10\" style=\"display: table-row;\"><td><input id=\"addgutter1\" onClick=\"showgutter1();\" type=\"button\" value=\"Add New Standard Gutter\" /></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td></tr>";

// Add New Standard Gutter 2
echo "<tr id=\"stdgutter11\" style=\"display: none;\"><td><input id=\"addgutter2\" onClick=\"showgutter2();\" type=\"button\" value=\"Add New Standard Gutter\" /></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td></tr>";

// Add New Standard Gutter 3
echo "<tr id=\"stdgutter12\" style=\"display: none;\"><td><input id=\"addgutter3\" onClick=\"showgutter3();\" type=\"button\" value=\"Add New Standard Gutter\" /></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td></tr>";

// Add New Standard Gutter 4
echo "<tr id=\"stdgutter13\" style=\"display: none;\"><td><input id=\"addgutter4\" onClick=\"showgutter4();\" type=\"button\" value=\"Add New Standard Gutter\" /></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td></tr>";

// Add Non Standard Gutter 1
echo "<tr id=\"nonstdgutter10\" style=\"display: table-row;\"><td><input id=\"addnonstd1\" onClick=\"shownonstd1();\" type=\"button\" value=\"Add Non-Standard Gutter\" /></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td></tr>";

// Add Non Standard Gutter 2
echo "<tr id=\"nonstdgutter11\" style=\"display: none;\"><td><input id=\"addnonstd2\" onClick=\"shownonstd2();\" type=\"button\" value=\"Add Non-Standard Gutter\" /></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td></tr>";

// Add Non Standard Gutter 3
echo "<tr id=\"nonstdgutter12\" style=\"display: none;\"><td><input id=\"addnonstd3\" onClick=\"shownonstd3();\" type=\"button\" value=\"Add Non-Standard Gutter\" /></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td></tr>";

// Add Non Standard Gutter 4
echo "<tr id=\"nonstdgutter13\" style=\"display: none;\"><td><input id=\"addnonstd4\" onClick=\"shownonstd4();\" type=\"button\" value=\"Add Non-Standard Gutter\" /></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td></tr>";

// Add Non Standard Gutter 5
echo "<tr id=\"nonstdgutter14\" style=\"display: none;\"><td><input id=\"addnonstd5\" onClick=\"shownonstd5();\" type=\"button\" value=\"Add Non-Standard Gutter\" /></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td></tr>";

// Add Non Standard Gutter 6
echo "<tr id=\"nonstdgutter15\" style=\"display: none;\"><td><input id=\"addnonstd6\" onClick=\"shownonstd6();\" type=\"button\" value=\"Add Non-Standard Gutter\" /></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td></tr>";

// Add Non Standard Gutter 7
echo "<tr id=\"nonstdgutter16\" style=\"display: none;\"><td><input id=\"addnonstd7\" onClick=\"shownonstd7();\" type=\"button\" value=\"Add Non-Standard Gutter\" /></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td></tr>";

// Add Non Standard Gutter 8
echo "<tr id=\"nonstdgutter17\" style=\"display: none;\"><td><input id=\"addnonstd8\" onClick=\"shownonstd8();\" type=\"button\" value=\"Add Non-Standard Gutter\" /></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td></tr>";

// Add Non Standard Gutter 9
echo "<tr id=\"nonstdgutter18\" style=\"display: none;\"><td><input id=\"addnonstd9\" onClick=\"shownonstd9();\" type=\"button\" value=\"Add Non-Standard Gutter\" /></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td></tr>";

// Add New Standard Gutter 0
echo "<tr id=\"stdgutter9\" style=\"display: none;\"><td><input id=\"addgutter0\" onClick=\"showgutter0();\" type=\"button\" value=\"Add Standard Gutter\" /></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td></tr>";


// ***************************** Cbeam Face Flashing Z al ********************************************//
echo "<tr><td colspan=\"8\" class=\"subheading\">Flashing</td></tr>";
$resultbeam = mysql_query("SELECT cf_id, inventoryid, description, uom, rrp, cost FROM ver_chronoforms_data_inventory_vic WHERE section = 'Flashings' and  cf_id = '43'" );
echo "<tr><td>";

		while ($beam = mysql_fetch_array($resultbeam)) {
		
      	echo $beam['description'];	
		echo "<input type=\"hidden\" class=\"desc\" name=\"desc[]\" value=\"".$beam['description']."\" readonly=\"readonly\" />".
		"<input type=\"hidden\" class=\"invent\" name=\"invent[]\" value=\"".$beam['inventoryid']."\" readonly=\"readonly\" />".
		"<input type=\"hidden\" class=\"descrrp\" name=\"descrrp\" value=\"".$beam['rrp']."\" readonly=\"readonly\" />".
        "<input type=\"hidden\" class=\"desccost\" name=\"desccost\" value=\"".$beam['cost']."\" readonly=\"readonly\" /></td>";
		}	

// Webbing
echo"<td><input type=\"hidden\" class=\"webbing\" name=\"webbing[]\" value=\"\" readonly=\"readonly\" /></td>";  

// Colours
echo "<td><div id=\"col26\"></div></td>";

// Paint and Powder
echo "<td><div id=\"cbd18\"></div></td>";


// Unit of Measurement
$resultbeam = mysql_query("SELECT cf_id, inventoryid, description, uom, rrp, cost FROM ver_chronoforms_data_inventory_vic WHERE section = 'Flashings' and  cf_id = '43'");
echo "<td>";
     while ($beam = mysql_fetch_array($resultbeam)) {
      	echo "<input type=\"text\" name=\"uom[]\" id=\"uom\" readonly=\"readonly\" value=\"".$beam['uom']."\">";	
		}	
echo "</td>";

// Unit Quantity
echo "<td><input type=\"text\" class=\"qtylen\" name=\"qty[]\" value=\"0\"></td>";

// Length or Width
echo "<td><input type=\"text\" class=\"xlength\" name=\"slength[]\" value=\"0\" /></td>";


// Total RRP
echo "<td><input type=\"text\" class=\"rrp\" readonly=\"readonly\" name=\"rrp[]\" value=\"\"><input type=\"hidden\" class=\"cst\" name=\"cst[]\" value=\"\"></td></tr>";

// ***************************** Adaptor Flashing Cbd ********************************************//

$resultbeam = mysql_query("SELECT cf_id, inventoryid, description, uom, rrp, cost FROM ver_chronoforms_data_inventory_vic WHERE section = 'Flashings' and  cf_id = '44'" );
echo "<tr><td>";

		while ($beam = mysql_fetch_array($resultbeam)) {
		
      	echo $beam['description'];	
		echo "<input type=\"hidden\" class=\"desc\" name=\"desc[]\" value=\"".$beam['description']."\" readonly=\"readonly\" />".
		"<input type=\"hidden\" class=\"invent\" name=\"invent[]\" value=\"".$beam['inventoryid']."\" readonly=\"readonly\" />".
		"<input type=\"hidden\" class=\"descrrp\" name=\"descrrp\" value=\"".$beam['rrp']."\" readonly=\"readonly\" />".
        "<input type=\"hidden\" class=\"desccost\" name=\"desccost\" value=\"".$beam['cost']."\" readonly=\"readonly\" /></td>";
		}	
     

// Webbing
echo"<td><input type=\"hidden\" class=\"webbing\" name=\"webbing[]\" value=\"\" readonly=\"readonly\" /></td>";  

// Colours
echo "<td><div id=\"col27\"></div></td>";

// Paint and Powder
echo "<td><div id=\"cbd19\"></div></td>";	

// Unit of Measurement
$resultbeam = mysql_query("SELECT cf_id, inventoryid, description, uom, rrp, cost FROM ver_chronoforms_data_inventory_vic WHERE section = 'Flashings' and  cf_id = '44'");
echo "<td>";
     while ($beam = mysql_fetch_array($resultbeam)) {
      	echo "<input type=\"text\" name=\"uom[]\" id=\"uom\" readonly=\"readonly\" value=\"".$beam['uom']."\">";	
		}	
echo "</td>";

// Unit Quantity
echo "<td><input type=\"text\" class=\"qtylen\" name=\"qty[]\" value=\"0\"></td>";

// Length or Width
echo "<td><input type=\"text\" class=\"xlength\" name=\"slength[]\" value=\"0\" /></td>";

// Total RRP
echo "<td><input type=\"text\" class=\"rrp\" readonly=\"readonly\" name=\"rrp[]\" value=\"\"><input type=\"hidden\" class=\"cst\" name=\"cst[]\" value=\"\"></td></tr>";

// ***************************** Flashing Fascia ********************************************//

$resultbeam = mysql_query("SELECT cf_id, inventoryid, description, uom, rrp, cost FROM ver_chronoforms_data_inventory_vic WHERE section = 'Flashings' and  cf_id = '45'" );
echo "<tr><td>";

		while ($beam = mysql_fetch_array($resultbeam)) {
		
      	echo $beam['description'];	
		echo "<input type=\"hidden\" class=\"desc\" name=\"desc[]\" value=\"".$beam['description']."\" readonly=\"readonly\" />".
		"<input type=\"hidden\" class=\"invent\" name=\"invent[]\" value=\"".$beam['inventoryid']."\" readonly=\"readonly\" />".
		"<input type=\"hidden\" class=\"descrrp\" name=\"descrrp\" value=\"".$beam['rrp']."\" readonly=\"readonly\" />".
        "<input type=\"hidden\" class=\"desccost\" name=\"desccost\" value=\"".$beam['cost']."\" readonly=\"readonly\" /></td>";
		}	
     
// Webbing
echo"<td><input type=\"hidden\" class=\"webbing\" name=\"webbing[]\" value=\"\" readonly=\"readonly\" /></td>";  

// Colours
echo "<td><div id=\"col28\"></div></td>";

// Paint and Powder
echo "<td><div id=\"cbd20\"></div></td>";


// Unit of Measurement
$resultbeam = mysql_query("SELECT cf_id, inventoryid, description, uom, rrp, cost FROM ver_chronoforms_data_inventory_vic WHERE section = 'Flashings' and  cf_id = '45'");
echo "<td>";
     while ($beam = mysql_fetch_array($resultbeam)) {
      	echo "<input type=\"text\" name=\"uom[]\" id=\"uom\" readonly=\"readonly\" value=\"".$beam['uom']."\">";	
		}	
echo "</td>";

// Unit Quantity
echo "<td><input type=\"text\" class=\"qtylen\" name=\"qty[]\" value=\"0\"></td>";

// Length or Width
echo "<td><input type=\"text\" class=\"xlength\" name=\"slength[]\" value=\"0\" /></td>";

// Total RRP
echo "<td><input type=\"text\" class=\"rrp\" readonly=\"readonly\" name=\"rrp[]\" value=\"\"><input type=\"hidden\" class=\"cst\" name=\"cst[]\" value=\"\"></td></tr>";

// ***************************** Flashing (Perimeter of Cbeam) ********************************************//

$resultbeam = mysql_query("SELECT cf_id, inventoryid, description, uom, rrp, cost FROM ver_chronoforms_data_inventory_vic WHERE section = 'Flashings' and  cf_id = '46'" );
echo "<tr><td>";

		while ($beam = mysql_fetch_array($resultbeam)) {
		
      	echo $beam['description'];	
		echo "<input type=\"hidden\" class=\"desc\" name=\"desc[]\" value=\"".$beam['description']."\" readonly=\"readonly\" />".
		"<input type=\"hidden\" class=\"invent\" name=\"invent[]\" value=\"".$beam['inventoryid']."\" readonly=\"readonly\" />".
		"<input type=\"hidden\" class=\"descrrp\" name=\"descrrp\" value=\"".$beam['rrp']."\" readonly=\"readonly\" />".
        "<input type=\"hidden\" class=\"desccost\" name=\"desccost\" value=\"".$beam['cost']."\" readonly=\"readonly\" /></td>";
		}	
     

// Webbing
echo"<td><input type=\"hidden\" class=\"webbing\" name=\"webbing[]\" value=\"\" readonly=\"readonly\" /></td>";  

// Colours
echo "<td><div id=\"col29\"></div></td>";

// Paint and Powder
echo "<td><div id=\"cbd21\"></div></td>";


// Unit of Measurement
$resultbeam = mysql_query("SELECT cf_id, inventoryid, description, uom, rrp, cost FROM ver_chronoforms_data_inventory_vic WHERE section = 'Flashings' and  cf_id = '46'");
echo "<td>";
     while ($beam = mysql_fetch_array($resultbeam)) {
      	echo "<input type=\"text\" name=\"uom[]\" id=\"uom\" readonly=\"readonly\" value=\"".$beam['uom']."\">";	
		}	
echo "</td>";

// Unit Quantity
echo "<td><input type=\"text\" class=\"qtylen\" name=\"qty[]\" value=\"0\"></td>";

// Length or Width
echo "<td><input type=\"text\" class=\"xlength\" name=\"slength[]\" value=\"0\" /></td>";

// Total RRP
echo "<td><input type=\"text\" class=\"rrp\" readonly=\"readonly\" name=\"rrp[]\" value=\"\"><input type=\"hidden\" class=\"cst\" name=\"cst[]\" value=\"\"></td></tr>";

// ***************************** Flashing Intermediate Beam (Dbl Bank) ********************************************//

$resultbeam = mysql_query("SELECT cf_id, inventoryid, description, uom, rrp, cost FROM ver_chronoforms_data_inventory_vic WHERE section = 'Flashings' and  cf_id = '47'" );
echo "<tr><td>";

		while ($beam = mysql_fetch_array($resultbeam)) {
		
      	echo $beam['description'];	
		echo "<input type=\"hidden\" class=\"desc\" name=\"desc[]\" value=\"".$beam['description']."\" readonly=\"readonly\" />".
		"<input type=\"hidden\" class=\"invent\" name=\"invent[]\" value=\"".$beam['inventoryid']."\" readonly=\"readonly\" />".
		"<input type=\"hidden\" class=\"descrrp\" name=\"descrrp\" value=\"".$beam['rrp']."\" readonly=\"readonly\" />".
        "<input type=\"hidden\" class=\"desccost\" name=\"desccost\" value=\"".$beam['cost']."\" readonly=\"readonly\" /></td>";
		}	
     
// Webbing
echo"<td><input type=\"hidden\" class=\"webbing\" name=\"webbing[]\" value=\"\" readonly=\"readonly\" /></td>";  

// Colours
echo "<td><div id=\"col30\"></div></td>";

// Paint and Powder
echo "<td><div id=\"cbd22\"></div></td>";
    	
// Unit of Measurement
$resultbeam = mysql_query("SELECT cf_id, inventoryid, description, uom, rrp, cost FROM ver_chronoforms_data_inventory_vic WHERE section = 'Flashings' and  cf_id = '47'");
echo "<td>";
     while ($beam = mysql_fetch_array($resultbeam)) {
      	echo "<input type=\"text\" name=\"uom[]\" id=\"uom\" readonly=\"readonly\" value=\"".$beam['uom']."\">";	
		}	
echo "</td>";

// Unit Quantity
echo "<td><input type=\"text\" class=\"qtylen\" name=\"qty[]\" value=\"0\"></td>";

// Length or Width
echo "<td><input type=\"text\" class=\"xlength\" name=\"slength[]\" value=\"1\" /></td>";

// Total RRP
echo "<td><input type=\"text\" class=\"rrp\" readonly=\"readonly\" name=\"rrp[]\" value=\"\"><input type=\"hidden\" class=\"cst\" name=\"cst[]\" value=\"\"></td></tr>";

// ***************************** Flashing Special ********************************************//

$resultbeam = mysql_query("SELECT cf_id, inventoryid, description, uom, rrp, cost FROM ver_chronoforms_data_inventory_vic WHERE section = 'Flashings' and  cf_id = '48'" );
echo "<tr><td>";

		while ($beam = mysql_fetch_array($resultbeam)) {
		
      	echo $beam['description'];	
		echo "<input type=\"hidden\" class=\"desc\" name=\"desc[]\" value=\"".$beam['description']."\" readonly=\"readonly\" />".
		"<input type=\"hidden\" class=\"invent\" name=\"invent[]\" value=\"".$beam['inventoryid']."\" readonly=\"readonly\" />".
		"<input type=\"hidden\" class=\"descrrp\" name=\"descrrp\" value=\"".$beam['rrp']."\" readonly=\"readonly\" />".
        "<input type=\"hidden\" class=\"desccost\" name=\"desccost\" value=\"".$beam['cost']."\" readonly=\"readonly\" /></td>";
		}	  

// Webbing
echo"<td><input type=\"hidden\" class=\"webbing\" name=\"webbing[]\" value=\"\" readonly=\"readonly\" /></td>";  

// Colours
echo "<td><div id=\"col31\"></div></td>";
     	
// Paint and Powder
echo "<td><div id=\"cbd23\"></div></td>";

// Unit of Measurement
$resultbeam = mysql_query("SELECT cf_id, inventoryid, description, uom, rrp, cost FROM ver_chronoforms_data_inventory_vic WHERE section = 'Flashings' and  cf_id = '48'");
echo "<td>";
     while ($beam = mysql_fetch_array($resultbeam)) {
      	echo "<input type=\"text\" name=\"uom[]\" id=\"uom\" readonly=\"readonly\" value=\"".$beam['uom']."\">";	
		}	
echo "</td>";

// Unit Quantity
echo "<td><input type=\"text\" class=\"qtylen\" name=\"qty[]\" value=\"0\"></td>";

// Length or Width
echo "<td><input type=\"text\" class=\"xlength\" name=\"slength[]\" value=\"1\" /></td>";

// Total RRP
echo "<td><input type=\"text\" class=\"rrp\" readonly=\"readonly\" name=\"rrp[]\" value=\"\"><input type=\"hidden\" class=\"cst\" name=\"cst[]\" value=\"\"></td></tr>";

// ***************************** Downpipe Plastic 3m ********************************************//
echo "<tr><td colspan=\"8\" class=\"subheading\">Downpipe</td></tr>";
$resultpipe = mysql_query("SELECT cf_id, inventoryid, description, uom, rrp, cost FROM ver_chronoforms_data_inventory_vic WHERE section = 'Downpipe' and  cf_id = '49'" );
echo "<tr><td>";

		while ($pipe = mysql_fetch_array($resultpipe)) {
		
      	echo $pipe['description'];	
		echo "<input type=\"hidden\" class=\"desc\" name=\"desc[]\" value=\"".$pipe['description']."\" readonly=\"readonly\" />".
		"<input type=\"hidden\" class=\"invent\" name=\"invent[]\" value=\"".$pipe['inventoryid']."\" readonly=\"readonly\" />".
		"<input type=\"hidden\" class=\"descrrp\" name=\"descrrp\" value=\"".$pipe['rrp']."\" readonly=\"readonly\" />".
        "<input type=\"hidden\" class=\"desccost\" name=\"desccost\" value=\"".$pipe['cost']."\" readonly=\"readonly\" /></td>";
     	
// Webbing
echo"<td><input type=\"hidden\" class=\"webbing\" name=\"webbing[]\" value=\"\" readonly=\"readonly\" /></td>";  

// Colours
echo"<td><input type=\"hidden\" class=\"colour\" name=\"colour[]\" value=\"\" readonly=\"readonly\" /></td>";
     	
// Paint and Powder
echo"<td><input type=\"hidden\" id=\"paint[]\" name=\"paint[]\" value=\"\" readonly=\"readonly\" /></td>";


// Unit of Measurement
echo "<td><input type=\"text\" name=\"uom[]\" id=\"uom\" readonly=\"readonly\" value=\"".$pipe['uom']."\"></td>";	
		}	


// Unit Quantity
echo "<td><input type=\"text\" class=\"qtylen\" name=\"qty[]\" value=\"0\"></td>";

// Length or Width
echo "<td><input type=\"hidden\" id=\"slength[]\" name=\"slength[]\" value=\"\" readonly=\"readonly\" /></td>";

// Total RRP
echo "<td><input type=\"text\" class=\"rrp\" readonly=\"readonly\" name=\"rrp[]\" value=\"\"><input type=\"hidden\" class=\"cst\" name=\"cst[]\" value=\"\"></td></tr>";

// ***************************** Plastic Fittings ********************************************//

$resultpipe = mysql_query("SELECT cf_id, inventoryid, description, uom, rrp, cost FROM ver_chronoforms_data_inventory_vic WHERE section = 'Downpipe' and  cf_id = '50'" );
echo "<tr><td>";

		while ($pipe = mysql_fetch_array($resultpipe)) {
		
      	echo $pipe['description'];	
		echo "<input type=\"hidden\" class=\"desc\" name=\"desc[]\" value=\"".$pipe['description']."\" readonly=\"readonly\" />".
		"<input type=\"hidden\" class=\"invent\" name=\"invent[]\" value=\"".$pipe['inventoryid']."\" readonly=\"readonly\" />".
		"<input type=\"hidden\" class=\"descrrp\" name=\"descrrp\" value=\"".$pipe['rrp']."\" readonly=\"readonly\" />".
        "<input type=\"hidden\" class=\"desccost\" name=\"desccost\" value=\"".$pipe['cost']."\" readonly=\"readonly\" /></td>";


// Webbing
echo"<td><input type=\"hidden\" class=\"webbing\" name=\"webbing[]\" value=\"\" readonly=\"readonly\" /></td>";  

// Colours
echo"<td><input type=\"hidden\" class=\"colour\" name=\"colour[]\" value=\"\" readonly=\"readonly\" /></td>";
     	
// Paint and Powder
echo"<td><input type=\"hidden\" id=\"paint[]\" name=\"paint[]\" value=\"\" readonly=\"readonly\" /></td>";    	

// Unit of Measurement
echo "<td><input type=\"text\" name=\"uom[]\" id=\"uom\" readonly=\"readonly\" value=\"".$pipe['uom']."\"></td>";	
		}	

// Unit Quantity
echo "<td><input type=\"text\" class=\"qtylen\" name=\"qty[]\" value=\"0\"></td>";

// Length or Width
echo "<td><input type=\"hidden\" id=\"slength[]\" name=\"slength[]\" value=\"\" readonly=\"readonly\" /></td>";

// Total RRP
echo "<td><input type=\"text\" class=\"rrp\" readonly=\"readonly\" name=\"rrp[]\" value=\"\"><input type=\"hidden\" class=\"cst\" name=\"cst[]\" value=\"\"></td></tr>";

// ***************************** Downpipe Cbond ********************************************//

$resultpipe = mysql_query("SELECT cf_id, inventoryid, description, uom, rrp, cost FROM ver_chronoforms_data_inventory_vic WHERE section = 'Downpipe' and  cf_id = '51'" );
echo "<tr><td>";

		while ($pipe = mysql_fetch_array($resultpipe)) {
		
      	echo $pipe['description'];	
		echo "<input type=\"hidden\" class=\"desc\" name=\"desc[]\" value=\"".$pipe['description']."\" readonly=\"readonly\" />".
		"<input type=\"hidden\" class=\"invent\" name=\"invent[]\" value=\"".$pipe['inventoryid']."\" readonly=\"readonly\" />".
		"<input type=\"hidden\" class=\"descrrp\" name=\"descrrp\" value=\"".$pipe['rrp']."\" readonly=\"readonly\" />".
        "<input type=\"hidden\" class=\"desccost\" name=\"desccost\" value=\"".$pipe['cost']."\" readonly=\"readonly\" /></td>";
  
// Webbing
echo"<td><input type=\"hidden\" class=\"webbing\" name=\"webbing[]\" value=\"\" readonly=\"readonly\" /></td>";  

// Colours
echo"<td><input type=\"hidden\" class=\"colour\" name=\"colour[]\" value=\"\" readonly=\"readonly\" /></td>";
     	
// Paint and Powder
echo"<td><input type=\"hidden\" id=\"paint[]\" name=\"paint[]\" value=\"\" readonly=\"readonly\" /></td>";

// Unit of Measurement
echo "<td><input type=\"text\" name=\"uom[]\" id=\"uom\" readonly=\"readonly\" value=\"".$pipe['uom']."\"></td>";	
		}	

// Unit Quantity
echo "<td><input type=\"text\" class=\"qtylen\" name=\"qty[]\" value=\"0\"></td>";

// Length or Width
echo "<td><input type=\"hidden\" id=\"slength[]\" name=\"slength[]\" value=\"\" readonly=\"readonly\" /></td>";

// Total RRP
echo "<td><input type=\"text\" class=\"rrp\" readonly=\"readonly\" name=\"rrp[]\" value=\"\"><input type=\"hidden\" class=\"cst\" name=\"cst[]\" value=\"\"></td></tr>";

// ***************************** Join to Stormwater ********************************************//

$resultpipe = mysql_query("SELECT cf_id, inventoryid, description, uom, rrp, cost FROM ver_chronoforms_data_inventory_vic WHERE section = 'Downpipe' and  cf_id = '52'" );
echo "<tr><td>";

		while ($pipe = mysql_fetch_array($resultpipe)) {
		
      	echo $pipe['description'];	
		echo "<input type=\"hidden\" class=\"desc\" name=\"desc[]\" value=\"".$pipe['description']."\" readonly=\"readonly\" />".
		"<input type=\"hidden\" class=\"invent\" name=\"invent[]\" value=\"".$pipe['inventoryid']."\" readonly=\"readonly\" />".
		"<input type=\"hidden\" class=\"descrrp\" name=\"descrrp\" value=\"".$pipe['rrp']."\" readonly=\"readonly\" />".
        "<input type=\"hidden\" class=\"desccost\" name=\"desccost\" value=\"".$pipe['cost']."\" readonly=\"readonly\" /></td>";
       	
// Webbing
echo"<td><input type=\"hidden\" class=\"webbing\" name=\"webbing[]\" value=\"\" readonly=\"readonly\" /></td>";  

// Colours
echo"<td><input type=\"hidden\" class=\"colour\" name=\"colour[]\" value=\"\" readonly=\"readonly\" /></td>";
     	
// Paint and Powder
echo"<td><input type=\"hidden\" id=\"paint[]\" name=\"paint[]\" value=\"\" readonly=\"readonly\" /></td>";


// Unit of Measurement
echo "<td><input type=\"text\" name=\"uom[]\" id=\"uom\" readonly=\"readonly\" value=\"".$pipe['uom']."\"></td>";	
		}	

// Unit Quantity
echo "<td><input type=\"text\" class=\"qtylen\" name=\"qty[]\" value=\"0\"></td>";

// Length or Width
echo "<td><input type=\"hidden\" id=\"slength[]\" name=\"slength[]\" value=\"\" readonly=\"readonly\" /></td>";

// Total RRP
echo "<td><input type=\"text\" class=\"rrp\" readonly=\"readonly\" name=\"rrp[]\" value=\"\"><input type=\"hidden\" class=\"cst\" name=\"cst[]\" value=\"\"></td></tr>";

// ***************************** Join into Existing Downpipe ********************************************//

$resultpipe = mysql_query("SELECT cf_id, inventoryid, description, uom, rrp, cost FROM ver_chronoforms_data_inventory_vic WHERE section = 'Downpipe' and  cf_id = '53'" );
echo "<tr><td>";

		while ($pipe = mysql_fetch_array($resultpipe)) {
		
      	echo $pipe['description'];	
		echo "<input type=\"hidden\" class=\"desc\" name=\"desc[]\" value=\"".$pipe['description']."\" readonly=\"readonly\" />".
		"<input type=\"hidden\" class=\"invent\" name=\"invent[]\" value=\"".$pipe['inventoryid']."\" readonly=\"readonly\" />".
		"<input type=\"hidden\" class=\"descrrp\" name=\"descrrp\" value=\"".$pipe['rrp']."\" readonly=\"readonly\" />".
        "<input type=\"hidden\" class=\"desccost\" name=\"desccost\" value=\"".$pipe['cost']."\" readonly=\"readonly\" /></td>";
    
// Webbing
echo"<td><input type=\"hidden\" class=\"webbing\" name=\"webbing[]\" value=\"\" readonly=\"readonly\" /></td>";  

// Colours
echo"<td><input type=\"hidden\" class=\"colour\" name=\"colour[]\" value=\"\" readonly=\"readonly\" /></td>";
     	
// Paint and Powder
echo"<td><input type=\"hidden\" id=\"paint[]\" name=\"paint[]\" value=\"\" readonly=\"readonly\" /></td>";

// Unit of Measurement
echo "<td><input type=\"text\" name=\"uom[]\" id=\"uom\" readonly=\"readonly\" value=\"".$pipe['uom']."\"></td>";	
		}	

// Unit Quantity
echo "<td><input type=\"text\" class=\"qtylen\" name=\"qty[]\" value=\"0\"></td>";

// Length or Width
echo "<td><input type=\"hidden\" id=\"slength[]\" name=\"slength[]\" value=\"\" readonly=\"readonly\" /></td>";

// Total RRP
echo "<td><input type=\"text\" class=\"rrp\" readonly=\"readonly\" name=\"rrp[]\" value=\"\"><input type=\"hidden\" class=\"cst\" name=\"cst[]\" value=\"\"></td></tr>";


// ***************************** Louvres Poly or Square ********************************************//
echo "<tr><td colspan=\"8\" class=\"subheading\">Vergola System</td></tr>";
$resultlouv = mysql_query("SELECT cf_id, inventoryid, description, uom, rrp, cost FROM ver_chronoforms_data_inventory_vic WHERE section = 'Vergola' and category  = 'Louvers'" );
echo "<tr><td><select class=\"desclist\" name=\"desclist[]\" >";
     
		while ($louvers = mysql_fetch_array($resultlouv)) {
		$heading = isset($louvers[0]) ? $louvers[0] : null;
		$BeamIDArrayPhp .= isset($louvers[1]) ? 'BeamIDArray["'.$heading.'"]="'.$louvers[1].'";' : null;	
		$BeamDESCArrayPhp .= isset($louvers[2]) ? 'BeamDESCArray["'.$heading.'"]="'.$louvers[2].'";' : null;
		$BeamRRPArrayPhp .= isset($louvers[4]) ? 'BeamRRPArray["'.$heading.'"]="'.$louvers[4].'";' : null;
		$BeamCOSTArrayPhp .= isset($louvers[5]) ? 'BeamCOSTArray["'.$heading.'"]="'.$louvers[5].'";' : null;
      	echo "<option value=\"".$louvers['cf_id']."\"";
		if($louvers['cf_id'] == '54') { echo "selected=\"selected\""; } echo ">".$louvers['description']."</option>";	
		}	

echo "</select>";
    
	 $louvers = mysql_query("SELECT cf_id, inventoryid, description, uom, rrp, cost FROM ver_chronoforms_data_inventory_vic WHERE section = 'Vergola' and category  = 'Louvers' and cf_id = '54'" );
	 $retlouv = mysql_fetch_array($louvers);
	 
echo "<input type=\"hidden\" class=\"desc\" name=\"desc[]\" value=\"".$retlouv['description']."\" readonly=\"readonly\" />".
     "<input type=\"hidden\" class=\"invent\" name=\"invent[]\" value=\"".$retlouv['inventoryid']."\" readonly=\"readonly\" />".
     "<input type=\"hidden\" class=\"descrrp\" name=\"descrrp\" value=\"".$retlouv['rrp']."\" readonly=\"readonly\" />".
     "<input type=\"hidden\" class=\"desccost\" name=\"desccost\" value=\"".$retlouv['cost']."\" readonly=\"readonly\" /></td>";
	 
// Webbing
echo"<td><input type=\"hidden\" class=\"webbing\" name=\"webbing[]\" value=\"\" readonly=\"readonly\" /></td>";

// Colours
echo "<td><div id=\"col32\"></div></td>";

// Paint and Powder
echo "<td><div id=\"cbd24\"></div></td>";

// Unit of Measurement
$resultuom = mysql_query("SELECT uom FROM ver_chronoforms_data_inventory_vic WHERE section = 'Vergola' and category  = 'Louvers' GROUP BY uom");
echo "<td>";
     while ($uom = mysql_fetch_array($resultuom)) {
      	echo "<input type=\"text\" name=\"uom[]\" id=\"uom\" readonly=\"readonly\" value=\"".$uom['uom']."\">";	
		}	
echo "</td>";

// Unit Quantity
echo "<td><input type=\"text\" class=\"qtylen\" name=\"qty[]\" value=\"0\"></td>";

//Length or Width
echo "<td><input type=\"text\" class=\"width\" name=\"slength[]\" value=\"0\"></td>";

// Total RRP
echo "<td><input type=\"text\" class=\"rrp\" readonly=\"readonly\" name=\"rrp[]\" value=\"\"><input type=\"hidden\" class=\"cst\" name=\"cst[]\" value=\"\"></td></tr>";

// ***************************** Endcap ********************************************//

$resultbeam = mysql_query("SELECT cf_id, inventoryid, description, uom, rrp, cost FROM ver_chronoforms_data_inventory_vic WHERE section = 'Vergola' and  cf_id = '58'" );
echo "<tr><td>";

		while ($beam = mysql_fetch_array($resultbeam)) {
		
      	echo $beam['description'];	
		echo "<input type=\"hidden\" class=\"desc\" name=\"desc[]\" value=\"".$beam['description']."\" readonly=\"readonly\" />".
		"<input type=\"hidden\" class=\"invent\" name=\"invent[]\" value=\"".$beam['inventoryid']."\" readonly=\"readonly\" />".
		"<input type=\"hidden\" class=\"descrrp\" name=\"descrrp\" value=\"".$beam['rrp']."\" readonly=\"readonly\" />".
        "<input type=\"hidden\" class=\"desccost\" name=\"desccost\" value=\"".$beam['cost']."\" readonly=\"readonly\" /></td>";
		
		}	
// Webbing
echo"<td><input type=\"hidden\" class=\"webbing\" name=\"webbing[]\" value=\"\" readonly=\"readonly\" /></td>";   

// Colours
echo "<td><div id=\"col33\"></div></td>";
     	
// Paint and Powder
echo "<td><div id=\"pow1\"></div></td>";

// Unit of Measurement
$resultbeam = mysql_query("SELECT cf_id, inventoryid, description, uom, rrp, cost FROM ver_chronoforms_data_inventory_vic WHERE section = 'Vergola' and  cf_id = '58'");
echo "<td>";
     while ($beam = mysql_fetch_array($resultbeam)) {
      	echo "<input type=\"text\" name=\"uom[]\" id=\"uom\" readonly=\"readonly\" value=\"".$beam['uom']."\">";	
		}	
echo "</td>";

// Unit Quantity
echo "<td><input type=\"text\" class=\"qtylen\" name=\"qty[]\" value=\"0\"></td>";

// Length or Width
echo "<td><input type=\"hidden\" id=\"slength[]\" name=\"slength[]\" value=\"\" readonly=\"readonly\" /></td>";


// Total RRP
echo "<td><input type=\"text\" class=\"rrp\" readonly=\"readonly\" name=\"rrp[]\" value=\"\"><input type=\"hidden\" class=\"cst\" name=\"cst[]\" value=\"\"></td></tr>";

// ***************************** Pivot Strip ********************************************//

$resultbeam = mysql_query("SELECT cf_id, inventoryid, description, uom, rrp, cost FROM ver_chronoforms_data_inventory_vic WHERE section = 'Vergola' and  cf_id = '59'" );
echo "<tr><td>";

		while ($beam = mysql_fetch_array($resultbeam)) {
		
      	echo $beam['description'];	
		echo "<input type=\"hidden\" class=\"desc\" name=\"desc[]\" value=\"".$beam['description']."\" readonly=\"readonly\" />".
		"<input type=\"hidden\" class=\"invent\" name=\"invent[]\" value=\"".$beam['inventoryid']."\" readonly=\"readonly\" />".
		"<input type=\"hidden\" class=\"descrrp\" name=\"descrrp\" value=\"".$beam['rrp']."\" readonly=\"readonly\" />".
        "<input type=\"hidden\" class=\"desccost\" name=\"desccost\" value=\"".$beam['cost']."\" readonly=\"readonly\" /></td>";
		}	
     
// Webbing
echo"<td><input type=\"hidden\" class=\"webbing\" name=\"webbing[]\" value=\"\" readonly=\"readonly\" /></td>";

// Colours
echo "<td><div id=\"col34\"></div></td>";
     	
// Paint and Powder
echo "<td><div id=\"pow2\"></div></td>";

// Unit of Measurement
$resultbeam = mysql_query("SELECT cf_id, inventoryid, description, uom, rrp, cost FROM ver_chronoforms_data_inventory_vic WHERE section = 'Vergola' and  cf_id = '59'");
echo "<td>";
     while ($beam = mysql_fetch_array($resultbeam)) {
      	echo "<input type=\"text\" name=\"uom[]\" id=\"uom\" readonly=\"readonly\" value=\"".$beam['uom']."\">";	
		}	
echo "</td>";

echo "<td><input type=\"text\" class=\"qtylen\" name=\"qty[]\" value=\"0\"></td>";

echo "<td><input type=\"hidden\" id=\"slength[]\" name=\"slength[]\" value=\"\" readonly=\"readonly\" /></td>";

// Total RRP
echo "<td><input type=\"text\" class=\"rrp\" readonly=\"readonly\" name=\"rrp[]\" value=\"\"><input type=\"hidden\" class=\"cst\" name=\"cst[]\" value=\"\"></td></tr>";

// ***************************** Link Bar ********************************************//

$resultbeam = mysql_query("SELECT cf_id, inventoryid, description, uom, rrp, cost FROM ver_chronoforms_data_inventory_vic WHERE section = 'Vergola' and  cf_id = '60'" );
echo "<tr><td>";

		while ($beam = mysql_fetch_array($resultbeam)) {
		
      	echo $beam['description'];	
		echo "<input type=\"hidden\" class=\"desc\" name=\"desc[]\" value=\"".$beam['description']."\" readonly=\"readonly\" />".
		"<input type=\"hidden\" class=\"invent\" name=\"invent[]\" value=\"".$beam['inventoryid']."\" readonly=\"readonly\" />".
		"<input type=\"hidden\" class=\"descrrp\" name=\"descrrp\" value=\"".$beam['rrp']."\" readonly=\"readonly\" />".
        "<input type=\"hidden\" class=\"desccost\" name=\"desccost\" value=\"".$beam['cost']."\" readonly=\"readonly\" /></td>";
		}	
     
// Webbing
echo"<td><input type=\"hidden\" class=\"webbing\" name=\"webbing[]\" value=\"\" readonly=\"readonly\" /></td>";

// Colours
echo "<td><div id=\"col35\"></div></td>";
     	
// Paint and Powder
echo "<td><div id=\"pow3\"></div></td>";

// Unit of Measurement
$resultbeam = mysql_query("SELECT cf_id, inventoryid, description, uom, rrp, cost FROM ver_chronoforms_data_inventory_vic WHERE section = 'Vergola' and  cf_id = '60'");
echo "<td>";
     while ($beam = mysql_fetch_array($resultbeam)) {
      	echo "<input type=\"text\" name=\"uom[]\" id=\"uom\" readonly=\"readonly\" value=\"".$beam['uom']."\">";	
		}	
echo "</td>";

echo "<td><input type=\"text\" class=\"qtylen\" name=\"qty[]\" value=\"0\"></td>";

echo "<td><input type=\"hidden\" id=\"slength[]\" name=\"slength[]\" value=\"\" readonly=\"readonly\" /></td>";

// Total RRP
echo "<td><input type=\"text\" class=\"rrp\" readonly=\"readonly\" name=\"rrp[]\" value=\"\"><input type=\"hidden\" class=\"cst\" name=\"cst[]\" value=\"\"></td></tr>";

// ***************************** Adjustable Angled Bracket ********************************************//

$resultaccess = mysql_query("SELECT cf_id, inventoryid, description, uom, rrp, cost FROM ver_chronoforms_data_inventory_vic WHERE section = 'Vergola' and  cf_id = '61'" );
echo "<tr><td>";

		while ($access = mysql_fetch_array($resultaccess)) {
		
      	echo $access['description'];	
		echo "<input type=\"hidden\" class=\"desc\" name=\"desc[]\" value=\"".$access['description']."\" readonly=\"readonly\" />".
		"<input type=\"hidden\" class=\"invent\" name=\"invent[]\" value=\"".$access['inventoryid']."\" readonly=\"readonly\" />".
		"<input type=\"hidden\" class=\"descrrp\" name=\"descrrp\" value=\"".$access['rrp']."\" readonly=\"readonly\" />".
        "<input type=\"hidden\" class=\"desccost\" name=\"desccost\" value=\"".$access['cost']."\" readonly=\"readonly\" /></td>";
		    
// Webbing
echo"<td><input type=\"hidden\" class=\"webbing\" name=\"webbing[]\" value=\"\" readonly=\"readonly\" /></td>";

// Colours
echo"<td><input type=\"hidden\" class=\"colour\" name=\"colour[]\" value=\"\" readonly=\"readonly\" /></td>";
     	
// Paint and Powder
echo"<td><input type=\"hidden\" id=\"paint[]\" name=\"paint[]\" value=\"\" readonly=\"readonly\" /></td>";

// Unit of Measurement
echo "<td><input type=\"text\" name=\"uom[]\" id=\"uom\" readonly=\"readonly\" value=\"".$access['uom']."\"></td>";	
		}	

echo "<td><input type=\"text\" class=\"qtylen\" name=\"qty[]\" value=\"0\"></td>";

echo "<td><input type=\"hidden\" id=\"slength[]\" name=\"slength[]\" value=\"\" readonly=\"readonly\" /></td>";

// Total RRP
echo "<td><input type=\"text\" class=\"rrp\" readonly=\"readonly\" name=\"rrp[]\" value=\"\"><input type=\"hidden\" class=\"cst\" name=\"cst[]\" value=\"\"></td></tr>";


// ***************************** Operator Motor ********************************************//

$resultaccess = mysql_query("SELECT cf_id, inventoryid, description, uom, rrp, cost FROM ver_chronoforms_data_inventory_vic WHERE section = 'Vergola' and  cf_id = '62'" );
echo "<tr><td>";

		while ($access = mysql_fetch_array($resultaccess)) {
		
      	echo $access['description'];	
		echo "<input type=\"hidden\" class=\"desc\" name=\"desc[]\" value=\"".$access['description']."\" readonly=\"readonly\" />".
		"<input type=\"hidden\" class=\"invent\" name=\"invent[]\" value=\"".$access['inventoryid']."\" readonly=\"readonly\" />".
		"<input type=\"hidden\" class=\"descrrp\" name=\"descrrp\" value=\"".$access['rrp']."\" readonly=\"readonly\" />".
        "<input type=\"hidden\" class=\"desccost\" name=\"desccost\" value=\"".$access['cost']."\" readonly=\"readonly\" /></td>";
     
// Webbing
echo"<td><input type=\"hidden\" class=\"webbing\" name=\"webbing[]\" value=\"\" readonly=\"readonly\" /></td>";

// Colours
echo"<td><input type=\"hidden\" class=\"colour\" name=\"colour[]\" value=\"\" readonly=\"readonly\" /></td>";
     	
// Paint and Powder
echo"<td><input type=\"hidden\" id=\"paint[]\" name=\"paint[]\" value=\"\" readonly=\"readonly\" /></td>";

// Unit of Measurement
echo "<td><input type=\"text\" name=\"uom[]\" id=\"uom\" readonly=\"readonly\" value=\"".$access['uom']."\"></td>";	
		}	

echo "<td><input type=\"text\" class=\"qtylen\" name=\"qty[]\" value=\"0\"><input type=\"text\" id=\"motor\" name=\"motor\" value=\"\" style=\"display:none;\"></td>";

echo "<td><input type=\"hidden\" id=\"slength[]\" name=\"slength[]\" value=\"\" readonly=\"readonly\" /></td>";

// Total RRP
echo "<td><input type=\"text\" class=\"rrp\" readonly=\"readonly\" name=\"rrp[]\" value=\"0\"><input type=\"hidden\" class=\"cst\" name=\"cst[]\" value=\"0\"></td></tr>";

// ***************************** Battery ********************************************//

$resultaccess = mysql_query("SELECT cf_id, inventoryid, description, uom, rrp, cost FROM ver_chronoforms_data_inventory_vic WHERE section = 'Vergola' and  cf_id = '63'" );
echo "<tr><td>";

		while ($access = mysql_fetch_array($resultaccess)) {
		
      	echo $access['description'];	
		echo "<input type=\"hidden\" class=\"desc\" name=\"desc[]\" value=\"".$access['description']."\" readonly=\"readonly\" />".
		"<input type=\"hidden\" class=\"invent\" name=\"invent[]\" value=\"".$access['inventoryid']."\" readonly=\"readonly\" />".
		"<input type=\"hidden\" class=\"descrrp\" name=\"descrrp\" value=\"".$access['rrp']."\" readonly=\"readonly\" />".
        "<input type=\"hidden\" class=\"desccost\" name=\"desccost\" value=\"".$access['cost']."\" readonly=\"readonly\" /></td>";
     
// Webbing
echo"<td><input type=\"hidden\" class=\"webbing\" name=\"webbing[]\" value=\"\" readonly=\"readonly\" /></td>";

// Colours
echo"<td><input type=\"hidden\" class=\"colour\" name=\"colour[]\" value=\"\" readonly=\"readonly\" /></td>";
     	
// Paint and Powder
echo"<td><input type=\"hidden\" id=\"paint[]\" name=\"paint[]\" value=\"\" readonly=\"readonly\" /></td>";

// Unit of Measurement
echo "<td><input type=\"text\" name=\"uom[]\" id=\"uom\" readonly=\"readonly\" value=\"".$access['uom']."\"></td>";	
		}	

echo "<td><input type=\"text\" class=\"qtylen\" name=\"qty[]\" value=\"0\"></td>";

echo "<td><input type=\"hidden\" id=\"slength[]\" name=\"slength[]\" value=\"\" readonly=\"readonly\" /></td>";

// Total RRP
echo "<td><input type=\"text\" class=\"rrp\" readonly=\"readonly\" name=\"rrp[]\" value=\"\"><input type=\"hidden\" class=\"cst\" name=\"cst[]\" value=\"\"></td></tr>";

// ***************************** 1 to 6 Motor Rain ********************************************//

$resultaccess = mysql_query("SELECT cf_id, inventoryid, description, uom, rrp, cost FROM ver_chronoforms_data_inventory_vic WHERE section = 'Vergola' and  cf_id = '64'" );
echo "<tr><td>";

		while ($access = mysql_fetch_array($resultaccess)) {
		
      	echo $access['description'];	
		echo "<input type=\"hidden\" class=\"desc\" name=\"desc[]\" value=\"".$access['description']."\" readonly=\"readonly\" />".
		"<input type=\"hidden\" class=\"invent\" name=\"invent[]\" value=\"".$access['inventoryid']."\" readonly=\"readonly\" />".
		"<input type=\"hidden\" class=\"descrrp\" name=\"descrrp\" value=\"".$access['rrp']."\" readonly=\"readonly\" />".
        "<input type=\"hidden\" class=\"desccost\" name=\"desccost\" value=\"".$access['cost']."\" readonly=\"readonly\" /></td>";
     
// Webbing
echo"<td><input type=\"hidden\" class=\"webbing\" name=\"webbing[]\" value=\"\" readonly=\"readonly\" /></td>";

// Colours
echo"<td><input type=\"hidden\" class=\"colour\" name=\"colour[]\" value=\"\" readonly=\"readonly\" /></td>";
     	
// Paint and Powder
echo"<td><input type=\"hidden\" id=\"paint[]\" name=\"paint[]\" value=\"\" readonly=\"readonly\" /></td>";

// Unit of Measurement
echo "<td><input type=\"text\" name=\"uom[]\" id=\"uom\" readonly=\"readonly\" value=\"".$access['uom']."\"></td>";	
		}	

echo "<td><input type=\"text\" class=\"qtylen\" name=\"qty[]\" value=\"0\"></td>";

echo "<td><input type=\"hidden\" id=\"slength[]\" name=\"slength[]\" value=\"\" readonly=\"readonly\" /></td>";

// Total RRP
echo "<td><input type=\"text\" class=\"rrp\" readonly=\"readonly\" name=\"rrp[]\" value=\"\"><input type=\"hidden\" class=\"cst\" name=\"cst[]\" value=\"\"></td></tr>";

// ***************************** 7 to 8 Motor Rain ********************************************//

$resultaccess = mysql_query("SELECT cf_id, inventoryid, description, uom, rrp, cost FROM ver_chronoforms_data_inventory_vic WHERE section = 'Vergola' and  cf_id = '65'" );
echo "<tr><td>";

		while ($access = mysql_fetch_array($resultaccess)) {
		
      	echo $access['description'];	
		echo "<input type=\"hidden\" class=\"desc\" name=\"desc[]\" value=\"".$access['description']."\" readonly=\"readonly\" />".
		"<input type=\"hidden\" class=\"invent\" name=\"invent[]\" value=\"".$access['inventoryid']."\" readonly=\"readonly\" />".
		"<input type=\"hidden\" class=\"descrrp\" name=\"descrrp\" value=\"".$access['rrp']."\" readonly=\"readonly\" />".
        "<input type=\"hidden\" class=\"desccost\" name=\"desccost\" value=\"".$access['cost']."\" readonly=\"readonly\" /></td>";
    
// Webbing
echo"<td><input type=\"hidden\" class=\"webbing\" name=\"webbing[]\" value=\"\" readonly=\"readonly\" /></td>";

// Colours
echo"<td><input type=\"hidden\" class=\"colour\" name=\"colour[]\" value=\"\" readonly=\"readonly\" /></td>";
     	
// Paint and Powder
echo"<td><input type=\"hidden\" id=\"paint[]\" name=\"paint[]\" value=\"\" readonly=\"readonly\" /></td>";

// Unit of Measurement
echo "<td><input type=\"text\" name=\"uom[]\" id=\"uom\" readonly=\"readonly\" value=\"".$access['uom']."\"></td>";	
		}	

echo "<td><input type=\"text\" class=\"qtylen\" name=\"qty[]\" value=\"0\"></td>";

echo "<td><input type=\"hidden\" id=\"slength[]\" name=\"slength[]\" value=\"\" readonly=\"readonly\" /></td>";

// Total RRP
echo "<td><input type=\"text\" class=\"rrp\" readonly=\"readonly\" name=\"rrp[]\" value=\"\"><input type=\"hidden\" class=\"cst\" name=\"cst[]\" value=\"\"></td></tr>";

// ***************************** Opaque Enclosure ********************************************//
echo "<tr><td colspan=\"8\" class=\"subheading\">Misc Items</td></tr>";
$resultaccess = mysql_query("SELECT cf_id, inventoryid, description, uom, rrp, cost FROM ver_chronoforms_data_inventory_vic WHERE section = 'Misc' and  cf_id = '66'" );
echo "<tr><td>";

		while ($access = mysql_fetch_array($resultaccess)) {
		
      	echo $access['description'];	
		echo "<input type=\"hidden\" class=\"desc\" name=\"desc[]\" value=\"".$access['description']."\" readonly=\"readonly\" />".
		"<input type=\"hidden\" class=\"invent\" name=\"invent[]\" value=\"".$access['inventoryid']."\" readonly=\"readonly\" />".
		"<input type=\"hidden\" class=\"descrrp\" name=\"descrrp\" value=\"".$access['rrp']."\" readonly=\"readonly\" />".
        "<input type=\"hidden\" class=\"desccost\" name=\"desccost\" value=\"".$access['cost']."\" readonly=\"readonly\" /></td>";
		    
// Webbing
echo"<td><input type=\"hidden\" class=\"webbing\" name=\"webbing[]\" value=\"\" readonly=\"readonly\" /></td>";

// Colours
echo"<td><input type=\"hidden\" class=\"colour\" name=\"colour[]\" value=\"\" readonly=\"readonly\" /></td>";
     	
// Paint and Powder
echo"<td><input type=\"hidden\" id=\"paint[]\" name=\"paint[]\" value=\"\" readonly=\"readonly\" /></td>";

// Unit of Measurement
echo "<td><input type=\"text\" name=\"uom[]\" id=\"uom\" readonly=\"readonly\" value=\"".$access['uom']."\"></td>";	
		}	

echo "<td><input type=\"text\" class=\"qtylen\" name=\"qty[]\" value=\"0\"></td>";

echo "<td><input type=\"hidden\" id=\"slength[]\" name=\"slength[]\" value=\"\" readonly=\"readonly\" /></td>";

// Total RRP
echo "<td><input type=\"text\" class=\"rrp\" readonly=\"readonly\" name=\"rrp[]\" value=\"\"><input type=\"hidden\" class=\"cst\" name=\"cst[]\" value=\"\"></td></tr>";

// ***************************** Misc Cost ********************************************//
$resultaccess = mysql_query("SELECT cf_id, inventoryid, description, uom, rrp, cost FROM ver_chronoforms_data_inventory_vic WHERE section = 'Misc' and  cf_id = '67'" );
echo "<tr><td>";

		while ($access = mysql_fetch_array($resultaccess)) {
		
      	echo $access['description'];	
		echo "<input type=\"hidden\" class=\"desc\" name=\"desc[]\" value=\"".$access['description']."\" readonly=\"readonly\" />".
		"<input type=\"hidden\" class=\"invent\" name=\"invent[]\" value=\"".$access['inventoryid']."\" readonly=\"readonly\" />".
		"<input type=\"hidden\" class=\"descrrp\" name=\"descrrp\" value=\"".$access['rrp']."\" readonly=\"readonly\" />".
        "<input type=\"hidden\" class=\"desccost\" name=\"desccost\" value=\"".$access['cost']."\" readonly=\"readonly\" /></td>";
		    
// Webbing
echo"<td><input type=\"hidden\" class=\"webbing\" name=\"webbing[]\" value=\"\" readonly=\"readonly\" /></td>";

// Colours
echo"<td><input type=\"hidden\" class=\"colour\" name=\"colour[]\" value=\"\" readonly=\"readonly\" /></td>";
     	
// Paint and Powder
echo"<td><input type=\"hidden\" id=\"paint[]\" name=\"paint[]\" value=\"\" readonly=\"readonly\" /></td>";

// Unit of Measurement
echo "<td><input type=\"text\" name=\"uom[]\" id=\"uom\" readonly=\"readonly\" value=\"".$access['uom']."\"></td>";	
		}	

echo "<td><input type=\"text\" class=\"qtylen\" name=\"qty[]\" value=\"0\"></td>";

echo "<td><input type=\"hidden\" id=\"slength[]\" name=\"slength[]\" value=\"\" readonly=\"readonly\" /></td>";

// Total RRP
echo "<td><input type=\"text\" class=\"rrp\" readonly=\"readonly\" name=\"rrp[]\" value=\"\"><input type=\"hidden\" class=\"cst\" name=\"cst[]\" value=\"\"></td></tr>";

// ***************************** Add Varied Misc Items********************************************//

echo "<tr id=\"extra1\" style=\"display: none\"><td><div id=\"misc1\"></div></td>";	
     
// Webbing
echo"<td><input type=\"button\" value=\"Remove Misc\" onclick=\"hidextra1();\" id=\"removextra1\"><input type=\"hidden\" class=\"webbing\" name=\"webbing[]\" value=\"\" readonly=\"readonly\" /></td>";

// Colours
echo"<td><input type=\"hidden\" class=\"colour\" name=\"colour[]\" value=\"\" readonly=\"readonly\" /></td>";
     	
// Paint and Powder
echo"<td><input type=\"hidden\" id=\"paint[]\" name=\"paint[]\" value=\"\" readonly=\"readonly\" /></td>";

// Unit of Measurement
$resultbeam = mysql_query("SELECT cf_id, inventoryid, description, uom, rrp, cost FROM ver_chronoforms_data_inventory_vic WHERE section = 'Misc' and  category = 'Varied Items' GROUP BY uom");
echo "<td>";
     while ($beam = mysql_fetch_array($resultbeam)) {
      	echo "<input type=\"text\" name=\"uom[]\" id=\"uom\" readonly=\"readonly\" value=\"".$beam['uom']."\">";	
		}	
echo "</td>";

echo "<td><input type=\"text\" id=\"addqty24\" name=\"qty[]\" value=\"0\"></td>";

echo "<td><input type=\"hidden\" id=\"slength[]\" name=\"slength[]\" value=\"\" readonly=\"readonly\" /></td>";

// Total RRP
echo "<td><input type=\"text\" class=\"rrp\" readonly=\"readonly\" name=\"rrp[]\" value=\"\"><input type=\"hidden\" class=\"cst\" name=\"cst[]\" value=\"\"></td></tr>";

// Add Misc
echo "<tr id=\"extra12\" style=\"display: table-row;\"><td><input id=\"addextra1\" onClick=\"showextra1();\" type=\"button\" value=\"Add Misc\" /></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td></tr>";

// ***************************** Add Extra 1 ********************************************//
echo "<tr><td colspan=\"8\" class=\"subheading\">Extras</td></tr>";
echo "<tr id=\"extra2\" style=\"display: none;\">";

echo "<td><div id=\"xtra1\"></div></td>";

// Webbing
echo"<td><input type=\"button\" value=\"Remove Extras\" onclick=\"hidextra2();\" id=\"removextra2\"><input type=\"hidden\" class=\"webbing\" name=\"webbing[]\" value=\"\" readonly=\"readonly\" /></td>";

// Colours
echo"<td><input type=\"hidden\" class=\"colour\" name=\"colour[]\" value=\"\" readonly=\"readonly\" /></td>";
     	
// Paint and Powder
echo"<td><input type=\"hidden\" id=\"paint[]\" name=\"paint[]\" value=\"\" readonly=\"readonly\" /></td>";

// Unit of Measurement
echo "<td><input type=\"text\" name=\"uom[]\" class=\"uom\" readonly=\"readonly\" value=\"Ea\"></td>";

// Unit Quantity
echo "<td><input type=\"text\" id=\"addqty25\" name=\"qty[]\" value=\"0\"></td>";

// Length or Width
echo "<td><input type=\"text\" class=\"xlength\" name=\"slength[]\" value=\"0\" style=\"display:none;\"></td>";

// Total RRP
echo "<td><input type=\"text\" class=\"rrp\" readonly=\"readonly\" name=\"rrp[]\" value=\"\"><input type=\"hidden\" class=\"cst\" name=\"cst[]\" value=\"\"></td></tr>";

// ***************************** Add Extra 2 ********************************************//

echo "<tr id=\"extra3\" style=\"display: none;\">";

echo "<td><div id=\"xtra2\"></div></td>";

// Webbing
echo"<td><input type=\"button\" value=\"Remove Extras\" onclick=\"hidextra3();\" id=\"removextra3\"><input type=\"hidden\" class=\"webbing\" name=\"webbing[]\" value=\"\" readonly=\"readonly\" /></td>";

// Colours
echo"<td><input type=\"hidden\" class=\"colour\" name=\"colour[]\" value=\"\" readonly=\"readonly\" /></td>";
     	
// Paint and Powder
echo"<td><input type=\"hidden\" id=\"paint[]\" name=\"paint[]\" value=\"\" readonly=\"readonly\" /></td>";

// Unit of Measurement
echo "<td><input type=\"text\" name=\"uom[]\" class=\"uom\" readonly=\"readonly\" value=\"Ea\"></td>";

// Unit Quantity
echo "<td><input type=\"text\" id=\"addqty26\" name=\"qty[]\" value=\"0\"></td>";

// Length or Width
echo "<td><input type=\"text\" class=\"xlength\" name=\"slength[]\" value=\"0\" style=\"display:none;\"></td>";

// Total RRP
echo "<td><input type=\"text\" class=\"rrp\" readonly=\"readonly\" name=\"rrp[]\" value=\"\"><input type=\"hidden\" class=\"cst\" name=\"cst[]\" value=\"\"></td></tr>";

// ***************************** Add Extra 3 ********************************************//

echo "<tr id=\"extra4\" style=\"display: none;\">";

echo "<td><div id=\"xtra3\"></div></td>";

// Webbing
echo"<td><input type=\"button\" value=\"Remove Extras\" onclick=\"hidextra4();\" id=\"removextra4\"><input type=\"hidden\" class=\"webbing\" name=\"webbing[]\" value=\"\" readonly=\"readonly\" /></td>";

// Colours
echo"<td><input type=\"hidden\" class=\"colour\" name=\"colour[]\" value=\"\" readonly=\"readonly\" /></td>";
     	
// Paint and Powder
echo"<td><input type=\"hidden\" id=\"paint[]\" name=\"paint[]\" value=\"\" readonly=\"readonly\" /></td>";

// Unit of Measurement
echo "<td><input type=\"text\" name=\"uom[]\" class=\"uom\" readonly=\"readonly\" value=\"Ea\"></td>";

// Unit Quantity
echo "<td><input type=\"text\" id=\"addqty27\" name=\"qty[]\" value=\"0\"></td>";

// Length or Width
echo "<td><input type=\"text\" class=\"xlength\" name=\"slength[]\" value=\"0\" style=\"display:none;\"></td>";

// Total RRP
echo "<td><input type=\"text\" class=\"rrp\" readonly=\"readonly\" name=\"rrp[]\" value=\"\"><input type=\"hidden\" class=\"cst\" name=\"cst[]\" value=\"\"></td></tr>";

// ***************************** Add Extra 4 ********************************************//

echo "<tr id=\"extra5\" style=\"display: none;\">";

echo "<td><div id=\"xtra4\"></div></td>";

// Webbing
echo"<td><input type=\"button\" value=\"Remove Extras\" onclick=\"hidextra5();\" id=\"removextra5\"><input type=\"hidden\" class=\"webbing\" name=\"webbing[]\" value=\"\" readonly=\"readonly\" /></td>";

// Colours
echo"<td><input type=\"hidden\" class=\"colour\" name=\"colour[]\" value=\"\" readonly=\"readonly\" /></td>";
     	
// Paint and Powder
echo"<td><input type=\"hidden\" id=\"paint[]\" name=\"paint[]\" value=\"\" readonly=\"readonly\" /></td>";

// Unit of Measurement
echo "<td><input type=\"text\" name=\"uom[]\" class=\"uom\" readonly=\"readonly\" value=\"Ea\"></td>";

// Unit Quantity
echo "<td><input type=\"text\" id=\"addqty28\" name=\"qty[]\" value=\"0\"></td>";

// Length or Width
echo "<td><input type=\"text\" class=\"xlength\" name=\"slength[]\" value=\"0\" style=\"display:none;\"></td>";

// Total RRP
echo "<td><input type=\"text\" class=\"rrp\" readonly=\"readonly\" name=\"rrp[]\" value=\"\"><input type=\"hidden\" class=\"cst\" name=\"cst[]\" value=\"\"></td></tr>";

// ***************************** Add Extra 5 ********************************************//

echo "<tr id=\"extra6\" style=\"display: none;\">";

echo "<td><div id=\"xtra5\"></div></td>";

// Webbing
echo"<td><input type=\"button\" value=\"Remove Extras\" onclick=\"hidextra6();\" id=\"removextra6\"><input type=\"hidden\" class=\"webbing\" name=\"webbing[]\" value=\"\" readonly=\"readonly\" /></td>";

// Colours
echo"<td><input type=\"hidden\" class=\"colour\" name=\"colour[]\" value=\"\" readonly=\"readonly\" /></td>";
     	
// Paint and Powder
echo"<td><input type=\"hidden\" id=\"paint[]\" name=\"paint[]\" value=\"\" readonly=\"readonly\" /></td>";

// Unit of Measurement
echo "<td><input type=\"text\" name=\"uom[]\" class=\"uom\" readonly=\"readonly\" value=\"Ea\"></td>";

// Unit Quantity
echo "<td><input type=\"text\" id=\"addqty29\" name=\"qty[]\" value=\"0\"></td>";

// Length or Width
echo "<td><input type=\"text\" class=\"xlength\" name=\"slength[]\" value=\"0\" style=\"display:none;\"></td>";

// Total RRP
echo "<td><input type=\"text\" class=\"rrp\" readonly=\"readonly\" name=\"rrp[]\" value=\"\"><input type=\"hidden\" class=\"cst\" name=\"cst[]\" value=\"\"></td></tr>";

// ***************************** Add Extra 6 ********************************************//

echo "<tr id=\"extra7\" style=\"display: none;\">";

echo "<td><div id=\"xtra6\"></div></td>";

// Webbing
echo"<td><input type=\"button\" value=\"Remove Extras\" onclick=\"hidextra7();\" id=\"removextra7\"><input type=\"hidden\" class=\"webbing\" name=\"webbing[]\" value=\"\" readonly=\"readonly\" /></td>";

// Colours
echo"<td><input type=\"hidden\" class=\"colour\" name=\"colour[]\" value=\"\" readonly=\"readonly\" /></td>";
     	
// Paint and Powder
echo"<td><input type=\"hidden\" id=\"paint[]\" name=\"paint[]\" value=\"\" readonly=\"readonly\" /></td>";

// Unit of Measurement
echo "<td><input type=\"text\" name=\"uom[]\" class=\"uom\" readonly=\"readonly\" value=\"Ea\"></td>";

// Unit Quantity
echo "<td><input type=\"text\" id=\"addqty30\" name=\"qty[]\" value=\"0\"></td>";

// Length or Width
echo "<td><input type=\"text\" class=\"xlength\" name=\"slength[]\" value=\"0\" style=\"display:none;\"></td>";

// Total RRP
echo "<td><input type=\"text\" class=\"rrp\" readonly=\"readonly\" name=\"rrp[]\" value=\"\"><input type=\"hidden\" class=\"cst\" name=\"cst[]\" value=\"\"></td></tr>";


// ***************************** Add Extra 7 ********************************************//

echo "<tr id=\"extra8\" style=\"display: none;\">";

echo "<td><div id=\"xtra7\"></div></td>";

// Webbing
echo"<td><input type=\"button\" value=\"Remove Extras\" onclick=\"hidextra8();\" id=\"removextra8\"><input type=\"hidden\" class=\"webbing\" name=\"webbing[]\" value=\"\" readonly=\"readonly\" /></td>";

// Colours
echo"<td><input type=\"hidden\" class=\"colour\" name=\"colour[]\" value=\"\" readonly=\"readonly\" /></td>";
     	
// Paint and Powder
echo"<td><input type=\"hidden\" id=\"paint[]\" name=\"paint[]\" value=\"\" readonly=\"readonly\" /></td>";

// Unit of Measurement
echo "<td><input type=\"text\" name=\"uom[]\" class=\"uom\" readonly=\"readonly\" value=\"Ea\"></td>";

// Unit Quantity
echo "<td><input type=\"text\" id=\"addqty31\" name=\"qty[]\" value=\"0\"></td>";

// Length or Width
echo "<td><input type=\"text\" class=\"xlength\" name=\"slength[]\" value=\"0\" style=\"display:none;\"></td>";

// Total RRP
echo "<td><input type=\"text\" class=\"rrp\" readonly=\"readonly\" name=\"rrp[]\" value=\"\"><input type=\"hidden\" class=\"cst\" name=\"cst[]\" value=\"\"></td></tr>";

// ***************************** Add Extra 8 ********************************************//

echo "<tr id=\"extra9\" style=\"display: none;\">";

echo "<td><div id=\"xtra8\"></div></td>";

// Webbing
echo"<td><input type=\"button\" value=\"Remove Extras\" onclick=\"hidextra9();\" id=\"removextra9\"><input type=\"hidden\" class=\"webbing\" name=\"webbing[]\" value=\"\" readonly=\"readonly\" /></td>";

// Colours
echo"<td><input type=\"hidden\" class=\"colour\" name=\"colour[]\" value=\"\" readonly=\"readonly\" /></td>";
     	
// Paint and Powder
echo"<td><input type=\"hidden\" id=\"paint[]\" name=\"paint[]\" value=\"\" readonly=\"readonly\" /></td>";

// Unit of Measurement
echo "<td><input type=\"text\" name=\"uom[]\" class=\"uom\" readonly=\"readonly\" value=\"Ea\"></td>";

// Unit Quantity
echo "<td><input type=\"text\" id=\"addqty32\" name=\"qty[]\" value=\"0\"></td>";

// Length or Width
echo "<td><input type=\"text\" class=\"xlength\" name=\"slength[]\" value=\"0\" style=\"display:none;\"></td>";

// Total RRP
echo "<td><input type=\"text\" class=\"rrp\" readonly=\"readonly\" name=\"rrp[]\" value=\"\"><input type=\"hidden\" class=\"cst\" name=\"cst[]\" value=\"\"></td></tr>";

// ***************************** Add Extra 9 ********************************************//

echo "<tr id=\"extra10\" style=\"display: none;\">";

echo "<td><div id=\"xtra9\"></div></td>";

// Webbing
echo"<td><input type=\"button\" value=\"Remove Extras\" onclick=\"hidextra10();\" id=\"removextra10\"><input type=\"hidden\" class=\"webbing\" name=\"webbing[]\" value=\"\" readonly=\"readonly\" /></td>";

// Colours
echo"<td><input type=\"hidden\" class=\"colour\" name=\"colour[]\" value=\"\" readonly=\"readonly\" /></td>";
     	
// Paint and Powder
echo"<td><input type=\"hidden\" id=\"paint[]\" name=\"paint[]\" value=\"\" readonly=\"readonly\" /></td>";

// Unit of Measurement
echo "<td><input type=\"text\" name=\"uom[]\" class=\"uom\" readonly=\"readonly\" value=\"Ea\"></td>";

// Unit Quantity
echo "<td><input type=\"text\" id=\"addqty33\" name=\"qty[]\" value=\"0\"></td>";

// Length or Width
echo "<td><input type=\"text\" class=\"xlength\" name=\"slength[]\" value=\"0\" style=\"display:none;\"></td>";

// Total RRP
echo "<td><input type=\"text\" class=\"rrp\" readonly=\"readonly\" name=\"rrp[]\" value=\"\"><input type=\"hidden\" class=\"cst\" name=\"cst[]\" value=\"\"></td></tr>";

// ***************************** Add Extra 10 ********************************************//

echo "<tr id=\"extra11\" style=\"display: none;\">";

echo "<td><div id=\"xtra10\"></div></td>";

// Webbing
echo"<td><input type=\"button\" value=\"Remove Extras\" onclick=\"hidextra11();\" id=\"removextra11\"><input type=\"hidden\" class=\"webbing\" name=\"webbing[]\" value=\"\" readonly=\"readonly\" /></td>";

// Colours
echo"<td><input type=\"hidden\" class=\"colour\" name=\"colour[]\" value=\"\" readonly=\"readonly\" /></td>";
     	
// Paint and Powder
echo"<td><input type=\"hidden\" id=\"paint[]\" name=\"paint[]\" value=\"\" readonly=\"readonly\" /></td>";

// Unit of Measurement
echo "<td><input type=\"text\" name=\"uom[]\" class=\"uom\" readonly=\"readonly\" value=\"Ea\"></td>";

// Unit Quantity
echo "<td><input type=\"text\" id=\"addqty34\" name=\"qty[]\" value=\"0\"></td>";

// Length or Width
echo "<td><input type=\"text\" class=\"xlength\" name=\"slength[]\" value=\"0\" style=\"display:none;\"></td>";

// Total RRP
echo "<td><input type=\"text\" class=\"rrp\" readonly=\"readonly\" name=\"rrp[]\" value=\"\"><input type=\"hidden\" class=\"cst\" name=\"cst[]\" value=\"\"></td></tr>";

/****************************************************************** Add Extra Show *****************************************************************/


// Add Extras 2
echo "<tr id=\"extra13\" style=\"display: table-row;\"><td><input id=\"addextra2\" onClick=\"showextra2();\" type=\"button\" value=\"Add Extras\" /></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td></tr>";

// Add Extras 3
echo "<tr id=\"extra14\" style=\"display: none;\"><td><input id=\"addextra3\" onClick=\"showextra3();\" type=\"button\" value=\"Add Extras\" /></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td></tr>";

// Add Extras 4
echo "<tr id=\"extra15\" style=\"display: none;\"><td><input id=\"addextra4\" onClick=\"showextra4();\" type=\"button\" value=\"Add Extras\" /></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td></tr>";

// Add Extras 5
echo "<tr id=\"extra16\" style=\"display: none;\"><td><input id=\"addextra5\" onClick=\"showextra5();\" type=\"button\" value=\"Add Extras\" /></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td></tr>";

// Add Extras 6
echo "<tr id=\"extra17\" style=\"display: none;\"><td><input id=\"addextra6\" onClick=\"showextra6();\" type=\"button\" value=\"Add Extras\" /></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td></tr>";

// Add Extras 7
echo "<tr id=\"extra18\" style=\"display: none;\"><td><input id=\"addextra7\" onClick=\"showextra7();\" type=\"button\" value=\"Add Extras\" /></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td></tr>";

// Add Extras 8
echo "<tr id=\"extra19\" style=\"display: none;\"><td><input id=\"addextra8\" onClick=\"showextra8();\" type=\"button\" value=\"Add Extras\" /></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td></tr>";

// Add Extras 9
echo "<tr id=\"extra20\" style=\"display: none;\"><td><input id=\"addextra9\" onClick=\"showextra9();\" type=\"button\" value=\"Add Extras\" /></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td></tr>";

// Add Extras 10
echo "<tr id=\"extra21\" style=\"display: none;\"><td><input id=\"addextra10\" onClick=\"showextra10();\" type=\"button\" value=\"Add Extras\" /></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td></tr>";

// Add Extras 11
echo "<tr id=\"extra22\" style=\"display: none;\"><td><input id=\"addextra11\" onClick=\"showextra11();\" type=\"button\" value=\"Add Extras\" /></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td></tr>";

// ***************************** Shop Drawings ********************************************//
echo "<tr><td colspan=\"8\" class=\"subheading\">Disbursements</td></tr>";
$resultdisb = mysql_query("SELECT cf_id, inventoryid, description, uom, rrp, cost FROM ver_chronoforms_data_inventory_vic WHERE section = 'Disbursements' and cf_id = '78'" );
echo "<tr><td>";

		while ($disburse = mysql_fetch_array($resultdisb)) {
		
      	echo $disburse['description'];	
		echo "<input type=\"hidden\" class=\"desc\" name=\"desc[]\" value=\"".$disburse['description']."\" readonly=\"readonly\" />".
		"<input type=\"hidden\" class=\"invent\" name=\"invent[]\" value=\"".$disburse['inventoryid']."\" readonly=\"readonly\" />".
		"<input type=\"hidden\" class=\"descrrp\" name=\"descrrp\" value=\"".$disburse['rrp']."\" readonly=\"readonly\" />".
        "<input type=\"hidden\" class=\"desccost\" name=\"desccost\" value=\"".$disburse['cost']."\" readonly=\"readonly\" /></td>";
			
// Webbing
echo"<td><input type=\"hidden\" class=\"webbing\" name=\"webbing[]\" value=\"\" readonly=\"readonly\" /></td>";   

// Colours
echo"<td><input type=\"hidden\" class=\"colour\" name=\"colour[]\" value=\"\" readonly=\"readonly\" /></td>";
     	
// Paint and Powder
echo"<td><input type=\"hidden\" id=\"paint[]\" name=\"paint[]\" value=\"\" readonly=\"readonly\" /></td>";

// Unit of Measurement
echo "<td><input type=\"text\" name=\"uom[]\" id=\"uom\" readonly=\"readonly\" value=\"".$disburse['uom']."\"></td>";	
		}

// Unit Quantity	
echo "<td><input type=\"text\" class=\"qtylen\" name=\"qty[]\" value=\"1\"></td>";

// Length or Width
echo "<td><input type=\"hidden\" id=\"slength[]\" name=\"slength[]\" value=\"\" readonly=\"readonly\" /></td>";

// Total RRP
echo "<td><input type=\"text\" class=\"rrpd\" readonly=\"readonly\" name=\"rrp[]\" value=\"\"><input type=\"hidden\" class=\"cstd\" name=\"cst[]\" value=\"\"></td></tr>";

// ***************************** Certifier ********************************************//

$resultdisb = mysql_query("SELECT cf_id, inventoryid, description, uom, rrp, cost FROM ver_chronoforms_data_inventory_vic WHERE section = 'Disbursements' and cf_id = '79'" );
echo "<tr><td>";

		while ($disburse = mysql_fetch_array($resultdisb)) {
		
      	echo $disburse['description'];	
		echo "<input type=\"hidden\" class=\"desc\" name=\"desc[]\" value=\"".$disburse['description']."\" readonly=\"readonly\" />".
		"<input type=\"hidden\" class=\"invent\" name=\"invent[]\" value=\"".$disburse['inventoryid']."\" readonly=\"readonly\" />".
		"<input type=\"hidden\" class=\"descrrp\" name=\"descrrp\" value=\"".$disburse['rrp']."\" readonly=\"readonly\" />".
        "<input type=\"hidden\" class=\"desccost\" name=\"desccost\" value=\"".$disburse['cost']."\" readonly=\"readonly\" /></td>";
			
// Webbing
echo"<td><input type=\"hidden\" class=\"webbing\" name=\"webbing[]\" value=\"\" readonly=\"readonly\" /></td>";   

// Colours
echo"<td><input type=\"hidden\" class=\"colour\" name=\"colour[]\" value=\"\" readonly=\"readonly\" /></td>";
     	
// Paint and Powder
echo"<td><input type=\"hidden\" id=\"paint[]\" name=\"paint[]\" value=\"\" readonly=\"readonly\" /></td>";

// Unit of Measurement
echo "<td><input type=\"text\" name=\"uom[]\" id=\"uom\" readonly=\"readonly\" value=\"".$disburse['uom']."\"></td>";	
		}

// Unit Quantity	
echo "<td><input type=\"text\" class=\"qtylen\" name=\"qty[]\" value=\"1\"></td>";

// Length or Width
echo "<td><input type=\"hidden\" id=\"slength[]\" name=\"slength[]\" value=\"\" readonly=\"readonly\" /></td>";

// Total RRP
echo "<td><input type=\"text\" class=\"rrpd\" readonly=\"readonly\" name=\"rrp[]\" value=\"\"><input type=\"hidden\" class=\"cstd\" name=\"cst[]\" value=\"\"></td></tr>";// ***************************** Council ********************************************//

$resultdisb = mysql_query("SELECT cf_id, inventoryid, description, uom, rrp, cost FROM ver_chronoforms_data_inventory_vic WHERE section = 'Disbursements' and cf_id = '80'" );
echo "<tr><td>";

		while ($disburse = mysql_fetch_array($resultdisb)) {
		
      	echo $disburse['description'];	
		echo "<input type=\"hidden\" class=\"desc\" name=\"desc[]\" value=\"".$disburse['description']."\" readonly=\"readonly\" />".
		"<input type=\"hidden\" class=\"invent\" name=\"invent[]\" value=\"".$disburse['inventoryid']."\" readonly=\"readonly\" />".
		"<input type=\"hidden\" class=\"descrrp\" name=\"descrrp\" value=\"".$disburse['rrp']."\" readonly=\"readonly\" />".
        "<input type=\"hidden\" class=\"desccost\" name=\"desccost\" value=\"".$disburse['cost']."\" readonly=\"readonly\" /></td>";
			
// Webbing
echo"<td><input type=\"hidden\" class=\"webbing\" name=\"webbing[]\" value=\"\" readonly=\"readonly\" /></td>";   

// Colours
echo"<td><input type=\"hidden\" class=\"colour\" name=\"colour[]\" value=\"\" readonly=\"readonly\" /></td>";
     	
// Paint and Powder
echo"<td><input type=\"hidden\" id=\"paint[]\" name=\"paint[]\" value=\"\" readonly=\"readonly\" /></td>";

// Unit of Measurement
echo "<td><input type=\"text\" name=\"uom[]\" id=\"uom\" readonly=\"readonly\" value=\"".$disburse['uom']."\"></td>";	
		}

// Unit Quantity	
echo "<td><input type=\"text\" class=\"qtylen\" name=\"qty[]\" value=\"1\"></td>";

// Length or Width
echo "<td><input type=\"hidden\" id=\"slength[]\" name=\"slength[]\" value=\"\" readonly=\"readonly\" /></td>";

// Total RRP
echo "<td><input type=\"text\" class=\"rrpd\" readonly=\"readonly\" name=\"rrp[]\" value=\"\"><input type=\"hidden\" class=\"cstd\" name=\"cst[]\" value=\"\"></td></tr>";// ***************************** Lands Title Office ********************************************//

$resultdisb = mysql_query("SELECT cf_id, inventoryid, description, uom, rrp, cost FROM ver_chronoforms_data_inventory_vic WHERE section = 'Disbursements' and cf_id = '81'" );
echo "<tr><td>";

		while ($disburse = mysql_fetch_array($resultdisb)) {
		
      	echo $disburse['description'];	
		echo "<input type=\"hidden\" class=\"desc\" name=\"desc[]\" value=\"".$disburse['description']."\" readonly=\"readonly\" />".
		"<input type=\"hidden\" class=\"invent\" name=\"invent[]\" value=\"".$disburse['inventoryid']."\" readonly=\"readonly\" />".
		"<input type=\"hidden\" class=\"descrrp\" name=\"descrrp\" value=\"".$disburse['rrp']."\" readonly=\"readonly\" />".
        "<input type=\"hidden\" class=\"desccost\" name=\"desccost\" value=\"".$disburse['cost']."\" readonly=\"readonly\" /></td>";
			
// Webbing
echo"<td><input type=\"hidden\" class=\"webbing\" name=\"webbing[]\" value=\"\" readonly=\"readonly\" /></td>";   

// Colours
echo"<td><input type=\"hidden\" class=\"colour\" name=\"colour[]\" value=\"\" readonly=\"readonly\" /></td>";
     	
// Paint and Powder
echo"<td><input type=\"hidden\" id=\"paint[]\" name=\"paint[]\" value=\"\" readonly=\"readonly\" /></td>";

// Unit of Measurement
echo "<td><input type=\"text\" name=\"uom[]\" id=\"uom\" readonly=\"readonly\" value=\"".$disburse['uom']."\"></td>";	
		}

// Unit Quantity	
echo "<td><input type=\"text\" class=\"qtylen\" name=\"qty[]\" value=\"1\"></td>";

// Length or Width
echo "<td><input type=\"hidden\" id=\"slength[]\" name=\"slength[]\" value=\"\" readonly=\"readonly\" /></td>";

// Total RRP
echo "<td><input type=\"text\" class=\"rrpd\" readonly=\"readonly\" name=\"rrp[]\" value=\"\"><input type=\"hidden\" class=\"cstd\" name=\"cst[]\" value=\"\"></td></tr>";// ***************************** Crane Hire ********************************************//

$resultdisb = mysql_query("SELECT cf_id, inventoryid, description, uom, rrp, cost FROM ver_chronoforms_data_inventory_vic WHERE section = 'Disbursements' and cf_id = '82'" );
echo "<tr><td>";

		while ($disburse = mysql_fetch_array($resultdisb)) {
		
      	echo $disburse['description'];	
		echo "<input type=\"hidden\" class=\"desc\" name=\"desc[]\" value=\"".$disburse['description']."\" readonly=\"readonly\" />".
		"<input type=\"hidden\" class=\"invent\" name=\"invent[]\" value=\"".$disburse['inventoryid']."\" readonly=\"readonly\" />".
		"<input type=\"hidden\" class=\"descrrp\" name=\"descrrp\" value=\"".$disburse['rrp']."\" readonly=\"readonly\" />".
        "<input type=\"hidden\" class=\"desccost\" name=\"desccost\" value=\"".$disburse['cost']."\" readonly=\"readonly\" /></td>";
			
// Webbing
echo"<td><input type=\"hidden\" class=\"webbing\" name=\"webbing[]\" value=\"\" readonly=\"readonly\" /></td>";   

// Colours
echo"<td><input type=\"hidden\" class=\"colour\" name=\"colour[]\" value=\"\" readonly=\"readonly\" /></td>";
     	
// Paint and Powder
echo"<td><input type=\"hidden\" id=\"paint[]\" name=\"paint[]\" value=\"\" readonly=\"readonly\" /></td>";

// Unit of Measurement
echo "<td><input type=\"text\" name=\"uom[]\" id=\"uom\" readonly=\"readonly\" value=\"".$disburse['uom']."\"></td>";	
		}

// Unit Quantity	
echo "<td><input type=\"text\" class=\"qtylen\" name=\"qty[]\" value=\"1\"></td>";

// Length or Width
echo "<td><input type=\"hidden\" id=\"slength[]\" name=\"slength[]\" value=\"\" readonly=\"readonly\" /></td>";

// Total RRP
echo "<td><input type=\"text\" class=\"rrpd\" readonly=\"readonly\" name=\"rrp[]\" value=\"\"><input type=\"hidden\" class=\"cstd\" name=\"cst[]\" value=\"\"></td></tr>";// ***************************** Genie Lift ********************************************//

$resultdisb = mysql_query("SELECT cf_id, inventoryid, description, uom, rrp, cost FROM ver_chronoforms_data_inventory_vic WHERE section = 'Disbursements' and cf_id = '83'" );
echo "<tr><td>";

		while ($disburse = mysql_fetch_array($resultdisb)) {
		
      	echo $disburse['description'];	
		echo "<input type=\"hidden\" class=\"desc\" name=\"desc[]\" value=\"".$disburse['description']."\" readonly=\"readonly\" />".
		"<input type=\"hidden\" class=\"invent\" name=\"invent[]\" value=\"".$disburse['inventoryid']."\" readonly=\"readonly\" />".
		"<input type=\"hidden\" class=\"descrrp\" name=\"descrrp\" value=\"".$disburse['rrp']."\" readonly=\"readonly\" />".
        "<input type=\"hidden\" class=\"desccost\" name=\"desccost\" value=\"".$disburse['cost']."\" readonly=\"readonly\" /></td>";
			
// Webbing
echo"<td><input type=\"hidden\" class=\"webbing\" name=\"webbing[]\" value=\"\" readonly=\"readonly\" /></td>";   

// Colours
echo"<td><input type=\"hidden\" class=\"colour\" name=\"colour[]\" value=\"\" readonly=\"readonly\" /></td>";
     	
// Paint and Powder
echo"<td><input type=\"hidden\" id=\"paint[]\" name=\"paint[]\" value=\"\" readonly=\"readonly\" /></td>";

// Unit of Measurement
echo "<td><input type=\"text\" name=\"uom[]\" id=\"uom\" readonly=\"readonly\" value=\"".$disburse['uom']."\"></td>";	
		}

// Unit Quantity	
echo "<td><input type=\"text\" class=\"qtylen\" name=\"qty[]\" value=\"1\"></td>";

// Length or Width
echo "<td><input type=\"hidden\" id=\"slength[]\" name=\"slength[]\" value=\"\" readonly=\"readonly\" /></td>";

// Total RRP
echo "<td><input type=\"text\" class=\"rrpd\" readonly=\"readonly\" name=\"rrp[]\" value=\"\"><input type=\"hidden\" class=\"cstd\" name=\"cst[]\" value=\"\"></td></tr>";// ***************************** Training Levy ********************************************//

$resultdisb = mysql_query("SELECT cf_id, inventoryid, description, uom, rrp, cost FROM ver_chronoforms_data_inventory_vic WHERE section = 'Disbursements' and cf_id = '84'" );
echo "<tr><td>";

		while ($disburse = mysql_fetch_array($resultdisb)) {
		
      	echo $disburse['description'];	
		echo "<input type=\"hidden\" class=\"desc\" name=\"desc[]\" value=\"".$disburse['description']."\" readonly=\"readonly\" />".
		"<input type=\"hidden\" class=\"invent\" name=\"invent[]\" value=\"".$disburse['inventoryid']."\" readonly=\"readonly\" />".
		"<input type=\"hidden\" class=\"descrrp\" name=\"descrrp\" value=\"".$disburse['rrp']."\" readonly=\"readonly\" />".
        "<input type=\"hidden\" class=\"desccost\" name=\"desccost\" value=\"".$disburse['cost']."\" readonly=\"readonly\" /></td>";
			
// Webbing
echo"<td><input type=\"hidden\" class=\"webbing\" name=\"webbing[]\" value=\"\" readonly=\"readonly\" /></td>";   

// Colours
echo"<td><input type=\"hidden\" class=\"colour\" name=\"colour[]\" value=\"\" readonly=\"readonly\" /></td>";
     	
// Paint and Powder
echo"<td><input type=\"hidden\" id=\"paint[]\" name=\"paint[]\" value=\"\" readonly=\"readonly\" /></td>";

// Unit of Measurement
echo "<td><input type=\"text\" name=\"uom[]\" id=\"uom\" readonly=\"readonly\" value=\"".$disburse['uom']."\"></td>";	
		}

// Unit Quantity	
echo "<td><input type=\"text\" class=\"qtylen\" name=\"qty[]\" value=\"1\"></td>";

// Length or Width
echo "<td><input type=\"hidden\" id=\"slength[]\" name=\"slength[]\" value=\"\" readonly=\"readonly\" /></td>";

// Total RRP
echo "<td><input type=\"text\" class=\"rrpd\" readonly=\"readonly\" name=\"rrp[]\" value=\"\"><input type=\"hidden\" class=\"cstd\" name=\"cst[]\" value=\"\"></td></tr>";// ***************************** Indemnity Insurance ********************************************//

$resultdisb = mysql_query("SELECT cf_id, inventoryid, description, uom, rrp, cost FROM ver_chronoforms_data_inventory_vic WHERE section = 'Disbursements' and cf_id = '85'" );
echo "<tr><td>";

		while ($disburse = mysql_fetch_array($resultdisb)) {
		
      	echo $disburse['description'];	
		echo "<input type=\"hidden\" class=\"desc\" name=\"desc[]\" value=\"".$disburse['description']."\" readonly=\"readonly\" />".
		"<input type=\"hidden\" class=\"invent\" name=\"invent[]\" value=\"".$disburse['inventoryid']."\" readonly=\"readonly\" />".
		"<input type=\"hidden\" class=\"descrrp\" name=\"descrrp\" value=\"".$disburse['rrp']."\" readonly=\"readonly\" />".
        "<input type=\"hidden\" class=\"desccost\" name=\"desccost\" value=\"".$disburse['cost']."\" readonly=\"readonly\" /></td>";
			
// Webbing
echo"<td><input type=\"hidden\" class=\"webbing\" name=\"webbing[]\" value=\"\" readonly=\"readonly\" /></td>";   

// Colours
echo"<td><input type=\"hidden\" class=\"colour\" name=\"colour[]\" value=\"\" readonly=\"readonly\" /></td>";
     	
// Paint and Powder
echo"<td><input type=\"hidden\" id=\"paint[]\" name=\"paint[]\" value=\"\" readonly=\"readonly\" /></td>";

// Unit of Measurement
echo "<td><input type=\"text\" name=\"uom[]\" id=\"uom\" readonly=\"readonly\" value=\"".$disburse['uom']."\"></td>";	
		}

// Unit Quantity	
echo "<td><input type=\"text\" class=\"qtylen\" name=\"qty[]\" value=\"1\"></td>";

// Length or Width
echo "<td><input type=\"hidden\" id=\"slength[]\" name=\"slength[]\" value=\"\" readonly=\"readonly\" /></td>";

// Total RRP
echo "<td><input type=\"text\" class=\"rrpd\" readonly=\"readonly\" name=\"rrp[]\" value=\"\"><input type=\"hidden\" class=\"cstd\" name=\"cst[]\" value=\"\"></td></tr>";// ***************************** Electrician ********************************************//

$resultdisb = mysql_query("SELECT cf_id, inventoryid, description, uom, rrp, cost FROM ver_chronoforms_data_inventory_vic WHERE section = 'Disbursements' and cf_id = '86'" );
echo "<tr><td>";

		while ($disburse = mysql_fetch_array($resultdisb)) {
		
      	echo $disburse['description'];	
		echo "<input type=\"hidden\" class=\"desc\" name=\"desc[]\" value=\"".$disburse['description']."\" readonly=\"readonly\" />".
		"<input type=\"hidden\" class=\"invent\" name=\"invent[]\" value=\"".$disburse['inventoryid']."\" readonly=\"readonly\" />".
		"<input type=\"hidden\" class=\"descrrp\" name=\"descrrp\" value=\"".$disburse['rrp']."\" readonly=\"readonly\" />".
        "<input type=\"hidden\" class=\"desccost\" name=\"desccost\" value=\"".$disburse['cost']."\" readonly=\"readonly\" /></td>";
			
// Webbing
echo"<td><input type=\"hidden\" class=\"webbing\" name=\"webbing[]\" value=\"\" readonly=\"readonly\" /></td>";   

// Colours
echo"<td><input type=\"hidden\" class=\"colour\" name=\"colour[]\" value=\"\" readonly=\"readonly\" /></td>";
     	
// Paint and Powder
echo"<td><input type=\"hidden\" id=\"paint[]\" name=\"paint[]\" value=\"\" readonly=\"readonly\" /></td>";

// Unit of Measurement
echo "<td><input type=\"text\" name=\"uom[]\" id=\"uom\" readonly=\"readonly\" value=\"".$disburse['uom']."\"></td>";	
		}

// Unit Quantity	
echo "<td><input type=\"text\" class=\"qtylen\" name=\"qty[]\" value=\"1\"></td>";

// Length or Width
echo "<td><input type=\"hidden\" id=\"slength[]\" name=\"slength[]\" value=\"\" readonly=\"readonly\" /></td>";

// Total RRP
echo "<td><input type=\"text\" class=\"rrpd\" readonly=\"readonly\" name=\"rrp[]\" value=\"\"><input type=\"hidden\" class=\"cstd\" name=\"cst[]\" value=\"\"></td></tr>";// ***************************** Engineering ********************************************//

$resultdisb = mysql_query("SELECT cf_id, inventoryid, description, uom, rrp, cost FROM ver_chronoforms_data_inventory_vic WHERE section = 'Disbursements' and cf_id = '87'" );
echo "<tr><td>";

		while ($disburse = mysql_fetch_array($resultdisb)) {
		
      	echo $disburse['description'];	
		echo "<input type=\"hidden\" class=\"desc\" name=\"desc[]\" value=\"".$disburse['description']."\" readonly=\"readonly\" />".
		"<input type=\"hidden\" class=\"invent\" name=\"invent[]\" value=\"".$disburse['inventoryid']."\" readonly=\"readonly\" />".
		"<input type=\"hidden\" class=\"descrrp\" name=\"descrrp\" value=\"".$disburse['rrp']."\" readonly=\"readonly\" />".
        "<input type=\"hidden\" class=\"desccost\" name=\"desccost\" value=\"".$disburse['cost']."\" readonly=\"readonly\" /></td>";
			
// Webbing
echo"<td><input type=\"hidden\" class=\"webbing\" name=\"webbing[]\" value=\"\" readonly=\"readonly\" /></td>";   

// Colours
echo"<td><input type=\"hidden\" class=\"colour\" name=\"colour[]\" value=\"\" readonly=\"readonly\" /></td>";
     	
// Paint and Powder
echo"<td><input type=\"hidden\" id=\"paint[]\" name=\"paint[]\" value=\"\" readonly=\"readonly\" /></td>";

// Unit of Measurement
echo "<td><input type=\"text\" name=\"uom[]\" id=\"uom\" readonly=\"readonly\" value=\"".$disburse['uom']."\"></td>";	
		}

// Unit Quantity	
echo "<td><input type=\"text\" class=\"qtylen\" name=\"qty[]\" value=\"1\"></td>";

// Length or Width
echo "<td><input type=\"hidden\" id=\"slength[]\" name=\"slength[]\" value=\"\" readonly=\"readonly\" /></td>";

// Total RRP
echo "<td><input type=\"text\" class=\"rrpd\" readonly=\"readonly\" name=\"rrp[]\" value=\"\"><input type=\"hidden\" class=\"cstd\" name=\"cst[]\" value=\"\"></td></tr>";// ***************************** Material Deliveries ********************************************//

$resultdisb = mysql_query("SELECT cf_id, inventoryid, description, uom, rrp, cost FROM ver_chronoforms_data_inventory_vic WHERE section = 'Disbursements' and cf_id = '88'" );
echo "<tr><td>";

		while ($disburse = mysql_fetch_array($resultdisb)) {
		
      	echo $disburse['description'];	
		echo "<input type=\"hidden\" class=\"desc\" name=\"desc[]\" value=\"".$disburse['description']."\" readonly=\"readonly\" />".
		"<input type=\"hidden\" class=\"invent\" name=\"invent[]\" value=\"".$disburse['inventoryid']."\" readonly=\"readonly\" />".
		"<input type=\"hidden\" class=\"descrrp\" name=\"descrrp\" value=\"".$disburse['rrp']."\" readonly=\"readonly\" />".
        "<input type=\"hidden\" class=\"desccost\" name=\"desccost\" value=\"".$disburse['cost']."\" readonly=\"readonly\" /></td>";
			
// Webbing
echo"<td><input type=\"hidden\" class=\"webbing\" name=\"webbing[]\" value=\"\" readonly=\"readonly\" /></td>";   

// Colours
echo"<td><input type=\"hidden\" class=\"colour\" name=\"colour[]\" value=\"\" readonly=\"readonly\" /></td>";
     	
// Paint and Powder
echo"<td><input type=\"hidden\" id=\"paint[]\" name=\"paint[]\" value=\"\" readonly=\"readonly\" /></td>";

// Unit of Measurement
echo "<td><input type=\"text\" name=\"uom[]\" id=\"uom\" readonly=\"readonly\" value=\"".$disburse['uom']."\"></td>";	
		}

// Unit Quantity	
echo "<td><input type=\"text\" class=\"qtylen\" name=\"qty[]\" value=\"1\"></td>";

// Length or Width
echo "<td><input type=\"hidden\" id=\"slength[]\" name=\"slength[]\" value=\"\" readonly=\"readonly\" /></td>";

// Total RRP
echo "<td><input type=\"text\" class=\"rrpd\" readonly=\"readonly\" name=\"rrp[]\" value=\"\"><input type=\"hidden\" class=\"cstd\" name=\"cst[]\" value=\"\"></td></tr>";// ***************************** Site Labour ********************************************//

$resultdisb = mysql_query("SELECT cf_id, inventoryid, description, uom, rrp, cost FROM ver_chronoforms_data_inventory_vic WHERE section = 'Disbursements' and cf_id = '89'" );
echo "<tr><td>";

		while ($disburse = mysql_fetch_array($resultdisb)) {
		
      	echo $disburse['description'];	
		echo "<input type=\"hidden\" class=\"desc\" name=\"desc[]\" value=\"".$disburse['description']."\" readonly=\"readonly\" />".
		"<input type=\"hidden\" class=\"invent\" name=\"invent[]\" value=\"".$disburse['inventoryid']."\" readonly=\"readonly\" />".
		"<input type=\"hidden\" class=\"descrrp\" name=\"descrrp\" value=\"".$disburse['rrp']."\" readonly=\"readonly\" />".
        "<input type=\"hidden\" class=\"desccost\" name=\"desccost\" value=\"".$disburse['cost']."\" readonly=\"readonly\" /></td>";
			
// Webbing
echo"<td><input type=\"hidden\" class=\"webbing\" name=\"webbing[]\" value=\"\" readonly=\"readonly\" /></td>";   

// Colours
echo"<td><input type=\"hidden\" class=\"colour\" name=\"colour[]\" value=\"\" readonly=\"readonly\" /></td>";
     	
// Paint and Powder
echo"<td><input type=\"hidden\" id=\"paint[]\" name=\"paint[]\" value=\"\" readonly=\"readonly\" /></td>";

// Unit of Measurement
echo "<td><input type=\"text\" name=\"uom[]\" id=\"uom\" readonly=\"readonly\" value=\"".$disburse['uom']."\"></td>";	
		}

// Unit Quantity	
echo "<td><input type=\"text\" class=\"qtylen\" name=\"qty[]\" value=\"1\"></td>";

// Length or Width
echo "<td><input type=\"hidden\" id=\"slength[]\" name=\"slength[]\" value=\"\" readonly=\"readonly\" /></td>";

// Total RRP
echo "<td><input type=\"text\" class=\"rrpd\" readonly=\"readonly\" name=\"rrp[]\" value=\"\"><input type=\"hidden\" class=\"cstd\" name=\"cst[]\" value=\"\"></td></tr>";// ***************************** Traveling Fix 1& 2 ********************************************//

$resultdisb = mysql_query("SELECT cf_id, inventoryid, description, uom, rrp, cost FROM ver_chronoforms_data_inventory_vic WHERE section = 'Disbursements' and cf_id = '90'" );
echo "<tr><td>";

		while ($disburse = mysql_fetch_array($resultdisb)) {
		
      	echo $disburse['description'];	
		echo "<input type=\"hidden\" class=\"desc\" name=\"desc[]\" value=\"".$disburse['description']."\" readonly=\"readonly\" />".
		"<input type=\"hidden\" class=\"invent\" name=\"invent[]\" value=\"".$disburse['inventoryid']."\" readonly=\"readonly\" />".
		"<input type=\"hidden\" class=\"descrrp\" name=\"descrrp\" value=\"".$disburse['rrp']."\" readonly=\"readonly\" />".
        "<input type=\"hidden\" class=\"desccost\" name=\"desccost\" value=\"".$disburse['cost']."\" readonly=\"readonly\" /></td>";
			
// Webbing
echo"<td><input type=\"hidden\" class=\"webbing\" name=\"webbing[]\" value=\"\" readonly=\"readonly\" /></td>";   

// Colours
echo"<td><input type=\"hidden\" class=\"colour\" name=\"colour[]\" value=\"\" readonly=\"readonly\" /></td>";
     	
// Paint and Powder
echo"<td><input type=\"hidden\" id=\"paint[]\" name=\"paint[]\" value=\"\" readonly=\"readonly\" /></td>";

// Unit of Measurement
echo "<td><input type=\"text\" name=\"uom[]\" id=\"uom\" readonly=\"readonly\" value=\"".$disburse['uom']."\"></td>";	
		}

// Unit Quantity	
echo "<td><input type=\"text\" class=\"qtylen\" name=\"qty[]\" value=\"1\"></td>";

// Length or Width
echo "<td><input type=\"hidden\" id=\"slength[]\" name=\"slength[]\" value=\"\" readonly=\"readonly\" /></td>";

// Total RRP
echo "<td><input type=\"text\" class=\"rrpd\" readonly=\"readonly\" name=\"rrp[]\" value=\"\"><input type=\"hidden\" class=\"cstd\" name=\"cst[]\" value=\"\"></td></tr>";// ***************************** Delivery Distance ********************************************//

$resultdisb = mysql_query("SELECT cf_id, inventoryid, description, uom, rrp, cost FROM ver_chronoforms_data_inventory_vic WHERE section = 'Disbursements' and cf_id = '91'" );
echo "<tr><td>";

		while ($disburse = mysql_fetch_array($resultdisb)) {
		
      	echo $disburse['description'];	
		echo "<input type=\"hidden\" class=\"desc\" name=\"desc[]\" value=\"".$disburse['description']."\" readonly=\"readonly\" />".
		"<input type=\"hidden\" class=\"invent\" name=\"invent[]\" value=\"".$disburse['inventoryid']."\" readonly=\"readonly\" />".
		"<input type=\"hidden\" class=\"descrrp\" name=\"descrrp\" value=\"".$disburse['rrp']."\" readonly=\"readonly\" />".
        "<input type=\"hidden\" class=\"desccost\" name=\"desccost\" value=\"".$disburse['cost']."\" readonly=\"readonly\" /></td>";
			
// Webbing
echo"<td><input type=\"hidden\" class=\"webbing\" name=\"webbing[]\" value=\"\" readonly=\"readonly\" /></td>";   

// Colours
echo"<td><input type=\"hidden\" class=\"colour\" name=\"colour[]\" value=\"\" readonly=\"readonly\" /></td>";
     	
// Paint and Powder
echo"<td><input type=\"hidden\" id=\"paint[]\" name=\"paint[]\" value=\"\" readonly=\"readonly\" /></td>";

// Unit of Measurement
echo "<td><input type=\"text\" name=\"uom[]\" id=\"uom\" readonly=\"readonly\" value=\"".$disburse['uom']."\"></td>";	
		}

// Unit Quantity	
echo "<td><input type=\"text\" class=\"qtylen\" name=\"qty[]\" value=\"1\"></td>";

// Length or Width
echo "<td><input type=\"hidden\" id=\"slength[]\" name=\"slength[]\" value=\"\" readonly=\"readonly\" /></td>";

// Total RRP
echo "<td><input type=\"text\" class=\"rrpd\" readonly=\"readonly\" name=\"rrp[]\" value=\"\"><input type=\"hidden\" class=\"cstd\" name=\"cst[]\" value=\"\"></td></tr>";// ***************************** Accomodation ********************************************//

$resultdisb = mysql_query("SELECT cf_id, inventoryid, description, uom, rrp, cost FROM ver_chronoforms_data_inventory_vic WHERE section = 'Disbursements' and cf_id = '92'" );
echo "<tr><td>";

		while ($disburse = mysql_fetch_array($resultdisb)) {
		
      	echo $disburse['description'];	
		echo "<input type=\"hidden\" class=\"desc\" name=\"desc[]\" value=\"".$disburse['description']."\" readonly=\"readonly\" />".
		"<input type=\"hidden\" class=\"invent\" name=\"invent[]\" value=\"".$disburse['inventoryid']."\" readonly=\"readonly\" />".
		"<input type=\"hidden\" class=\"descrrp\" name=\"descrrp\" value=\"".$disburse['rrp']."\" readonly=\"readonly\" />".
        "<input type=\"hidden\" class=\"desccost\" name=\"desccost\" value=\"".$disburse['cost']."\" readonly=\"readonly\" /></td>";
			
// Webbing
echo"<td><input type=\"hidden\" class=\"webbing\" name=\"webbing[]\" value=\"\" readonly=\"readonly\" /></td>";   

// Colours
echo"<td><input type=\"hidden\" class=\"colour\" name=\"colour[]\" value=\"\" readonly=\"readonly\" /></td>";
     	
// Paint and Powder
echo"<td><input type=\"hidden\" id=\"paint[]\" name=\"paint[]\" value=\"\" readonly=\"readonly\" /></td>";

// Unit of Measurement
echo "<td><input type=\"text\" name=\"uom[]\" id=\"uom\" readonly=\"readonly\" value=\"".$disburse['uom']."\"></td>";	
		}

// Unit Quantity	
echo "<td><input type=\"text\" class=\"qtylen\" name=\"qty[]\" value=\"1\"></td>";

// Length or Width
echo "<td><input type=\"hidden\" id=\"slength[]\" name=\"slength[]\" value=\"\" readonly=\"readonly\" /></td>";

// Total RRP
echo "<td><input type=\"text\" class=\"rrpd\" readonly=\"readonly\" name=\"rrp[]\" value=\"\"><input type=\"hidden\" class=\"cstd\" name=\"cst[]\" value=\"\"></td></tr>";// ***************************** Factory Labour ********************************************//

$resultdisb = mysql_query("SELECT cf_id, inventoryid, description, uom, rrp, cost FROM ver_chronoforms_data_inventory_vic WHERE section = 'Disbursements' and cf_id = '93'" );
echo "<tr><td>";

		while ($disburse = mysql_fetch_array($resultdisb)) {
		
      	echo $disburse['description'];	
		echo "<input type=\"hidden\" class=\"desc\" name=\"desc[]\" value=\"".$disburse['description']."\" readonly=\"readonly\" />".
		"<input type=\"hidden\" class=\"invent\" name=\"invent[]\" value=\"".$disburse['inventoryid']."\" readonly=\"readonly\" />".
		"<input type=\"hidden\" class=\"descrrp\" name=\"descrrp\" value=\"".$disburse['rrp']."\" readonly=\"readonly\" />".
        "<input type=\"hidden\" class=\"desccost\" name=\"desccost\" value=\"".$disburse['cost']."\" readonly=\"readonly\" /></td>";
			
// Webbing
echo"<td><input type=\"hidden\" class=\"webbing\" name=\"webbing[]\" value=\"\" readonly=\"readonly\" /></td>";   

// Colours
echo"<td><input type=\"hidden\" class=\"colour\" name=\"colour[]\" value=\"\" readonly=\"readonly\" /></td>";
     	
// Paint and Powder
echo"<td><input type=\"hidden\" id=\"paint[]\" name=\"paint[]\" value=\"\" readonly=\"readonly\" /></td>";

// Unit of Measurement
echo "<td><input type=\"text\" name=\"uom[]\" id=\"uom\" readonly=\"readonly\" value=\"".$disburse['uom']."\"></td>";	
		}

// Unit Quantity	
echo "<td><input type=\"text\" class=\"qtylen\" name=\"qty[]\" value=\"1\"></td>";

// Length or Width
echo "<td><input type=\"hidden\" id=\"slength[]\" name=\"slength[]\" value=\"\" readonly=\"readonly\" /></td>";

// Total RRP
echo "<td><input type=\"text\" class=\"rrpd\" readonly=\"readonly\" name=\"rrp[]\" value=\"\"><input type=\"hidden\" class=\"cstd\" name=\"cst[]\" value=\"\"></td></tr>";// ***************************** Other ********************************************//

$resultdisb = mysql_query("SELECT cf_id, inventoryid, description, uom, rrp, cost FROM ver_chronoforms_data_inventory_vic WHERE section = 'Disbursements' and cf_id = '94'" );
echo "<tr><td>";

		while ($disburse = mysql_fetch_array($resultdisb)) {
		
      	echo $disburse['description'];	
		echo "<input type=\"hidden\" class=\"desc\" name=\"desc[]\" value=\"".$disburse['description']."\" readonly=\"readonly\" />".
		"<input type=\"hidden\" class=\"invent\" name=\"invent[]\" value=\"".$disburse['inventoryid']."\" readonly=\"readonly\" />".
		"<input type=\"hidden\" class=\"descrrp\" name=\"descrrp\" value=\"".$disburse['rrp']."\" readonly=\"readonly\" />".
        "<input type=\"hidden\" class=\"desccost\" name=\"desccost\" value=\"".$disburse['cost']."\" readonly=\"readonly\" /></td>";
			
// Webbing
echo"<td><input type=\"hidden\" class=\"webbing\" name=\"webbing[]\" value=\"\" readonly=\"readonly\" /></td>";   

// Colours
echo"<td><input type=\"hidden\" class=\"colour\" name=\"colour[]\" value=\"\" readonly=\"readonly\" /></td>";
     	
// Paint and Powder
echo"<td><input type=\"hidden\" id=\"paint[]\" name=\"paint[]\" value=\"\" readonly=\"readonly\" /></td>";

// Unit of Measurement
echo "<td><input type=\"text\" name=\"uom[]\" id=\"uom\" readonly=\"readonly\" value=\"".$disburse['uom']."\"></td>";	
		}

// Unit Quantity	
echo "<td><input type=\"text\" class=\"qtylen\" name=\"qty[]\" value=\"0\"></td>";

// Length or Width
echo "<td><input type=\"hidden\" id=\"slength[]\" name=\"slength[]\" value=\"\" readonly=\"readonly\" /></td>";

// Total RRP
echo "<td><input type=\"text\" class=\"rrpd\" readonly=\"readonly\" name=\"rrp[]\" value=\"\"><input type=\"hidden\" class=\"cstd\" name=\"cst[]\" value=\"\"></td></tr>";

// End of Table
echo "</table>";

?>
