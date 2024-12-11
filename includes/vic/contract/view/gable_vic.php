<?php
//echo $ProjectID;

if(isset($_POST['quotedate'])){ 
$date =  $_POST['quotedate']; 
$timestamp = date('Y-m-d H:i:s', strtotime($date)); 
$DateLodged = $timestamp;
}
if(isset($_POST['update']))
{
$ProjectSite = $_POST['projectsite'];
$Length = $_POST['length'];
$Width = $_POST['width'];

$SubtotalVergola = $_POST['subtotalvergola'];
$SubtotalDisbursement = $_POST['subtotaldisd'];
$Totalrrp = $_POST['totalrrp'];
$Totalgst = $_POST['totalgst'];
$Totalrrpgst = $_POST['totalrrpgst'];
$Totalcost = $_POST['totalcost'];
$Totalcostgst = $_POST['totalcostgst'];
$GSTPercent = $_POST['gst'];
$CommPercent = $_POST['commision'];
$SalesComm = $_POST['salescomm'];
$InstallComm = $_POST['installercomm'];
$SalesCost = $_POST['salescost'];
$InstallCost = $_POST['installercost'];

mysql_query("UPDATE ver_chronoforms_data_quote_vic SET project_name = '$ProjectSite' WHERE projectid = '$ProjectID'")or die(mysql_error()); 

mysql_query("UPDATE ver_chronoforms_data_followup_vic SET 
project_name = '$ProjectSite',
subtotal_vergola = '$SubtotalVergola', 
subtotal_disbursement = '$SubtotalDisbursement', 
total_rrp = '$Totalrrp',
total_gst = '$Totalgst', 
total_rrp_gst = '$Totalrrpgst',
total_cost = '$Totalcost', 
total_cost_gst = '$Totalcostgst',  
gst_percent = '$GSTPercent', 
comm_percent = '$CommPercent', 
sales_comm = '$SalesComm', 
install_comm = '$InstallComm', 
sales_comm_cost = '$SalesCost', 
install_comm_cost = '$InstallCost' 

WHERE projectid = '$ProjectID'")or die(mysql_error()); 

mysql_query("UPDATE ver_chronoforms_data_measurement_vic SET length = '$Length', width = '$Width' WHERE projectid = '$ProjectID'")or die(mysql_error()); 

$description = count($_POST['desc']);
$inventoryid = count($_POST['invent']);
$web = count($_POST['webbing']);
$colours = count($_POST['colour']);
$finishs = count($_POST['paint']);
$units = count($_POST['uom']);
$quantity = count($_POST['qty']);
$slengths = count($_POST['slength']);
$itemrrp = count($_POST['rrp']);
$itemcst = count($_POST['cst']);

$i = 0;
while ($i < $description || $i < $inventoryid || $i < $web || $i < $colours || $i < $finishs || $i < $units || $i < $quantity || $i < $slengths || $i < $itemrrp || $i < $itemcst) {
	$desc = $_POST['desc'][$i];
	$inventpid = $_POST['invent'][$i];
	$webbing = $_POST['webbing'][$i];
	$colour = $_POST['colour'][$i];
	$finish = $_POST['paint'][$i];
	$uom = $_POST['uom'][$i];
	$qty = $_POST['qty'][$i];
	$slength = $_POST['slength'][$i];
	$unitrrp = $_POST['rrp'][$i];
	$unitcst = $_POST['cst'][$i];
	$id = $_POST['id'][$i];
	$query = "UPDATE ver_chronoforms_data_quote_vic SET 
	description = '$desc', 
	inventoryid = '$inventpid',
	webbing = '$webbing',
	colour = '$colour',	
	finish = '$finish',
	uom = '$uom',
	qty = '$qty',	
	length = '$slength',
	rrp = '$unitrrp',	
	cost = '$unitcst'
	WHERE cf_id = '$id' LIMIT 10";
	mysql_query($query) or die ("Error in query: $query");

	++$i;
}

header('Location:'.JURI::base().'view-quote-vic?projectid='.$ProjectID);

}

if(isset($_POST['save-close']))
{
$ProjectSite = $_POST['projectsite'];
$Length = $_POST['length'];
$Width = $_POST['width'];

$SubtotalVergola = $_POST['subtotalvergola'];
$SubtotalDisbursement = $_POST['subtotaldisd'];
$Totalrrp = $_POST['totalrrp'];
$Totalgst = $_POST['totalgst'];
$Totalrrpgst = $_POST['totalrrpgst'];
$Totalcost = $_POST['totalcost'];
$Totalcostgst = $_POST['totalcostgst'];
$GSTPercent = $_POST['gst'];
$CommPercent = $_POST['commision'];
$SalesComm = $_POST['salescomm'];
$InstallComm = $_POST['installercomm'];
$SalesCost = $_POST['salescost'];
$InstallCost = $_POST['installercost'];

mysql_query("UPDATE ver_chronoforms_data_quote_vic SET project_name = '$ProjectSite' WHERE projectid = '$ProjectID'")or die(mysql_error()); 

mysql_query("UPDATE ver_chronoforms_data_followup_vic SET 
project_name = '$ProjectSite',
subtotal_vergola = '$SubtotalVergola', 
subtotal_disbursement = '$SubtotalDisbursement', 
total_rrp = '$Totalrrp',
total_gst = '$Totalgst', 
total_rrp_gst = '$Totalrrpgst',
total_cost = '$Totalcost', 
total_cost_gst = '$Totalcostgst',  
gst_percent = '$GSTPercent', 
comm_percent = '$CommPercent', 
sales_comm = '$SalesComm', 
install_comm = '$InstallComm', 
sales_comm_cost = '$SalesCost', 
install_comm_cost = '$InstallCost' 

WHERE projectid = '$ProjectID'")or die(mysql_error()); 

mysql_query("UPDATE ver_chronoforms_data_measurement_vic SET length = '$Length', width = '$Width' WHERE projectid = '$ProjectID'")or die(mysql_error()); 

$description = count($_POST['desc']);
$inventoryid = count($_POST['invent']);
$web = count($_POST['webbing']);
$colours = count($_POST['colour']);
$finishs = count($_POST['paint']);
$units = count($_POST['uom']);
$quantity = count($_POST['qty']);
$slengths = count($_POST['slength']);
$itemrrp = count($_POST['rrp']);
$itemcst = count($_POST['cst']);

$i = 0;
while ($i < $description || $i < $inventoryid || $i < $web || $i < $colours || $i < $finishs || $i < $units || $i < $quantity || $i < $slengths || $i < $itemrrp || $i < $itemcst) {
	$desc = $_POST['desc'][$i];
	$inventpid = $_POST['invent'][$i];
	$webbing = $_POST['webbing'][$i];
	$colour = $_POST['colour'][$i];
	$finish = $_POST['paint'][$i];
	$uom = $_POST['uom'][$i];
	$qty = $_POST['qty'][$i];
	$slength = $_POST['slength'][$i];
	$unitrrp = $_POST['rrp'][$i];
	$unitcst = $_POST['cst'][$i];
	$id = $_POST['id'][$i];
	$query = "UPDATE ver_chronoforms_data_quote_vic SET 
	description = '$desc', 
	inventoryid = '$inventpid',
	webbing = '$webbing',
	colour = '$colour',	
	finish = '$finish',
	uom = '$uom',
	qty = '$qty',	
	length = '$slength',
	rrp = '$unitrrp',	
	cost = '$unitcst'
	WHERE cf_id = '$id' LIMIT 10";
	mysql_query($query) or die ("Error in query: $query");

	++$i;
}

if($QuoteIDAlpha == 'CRV'){		
header('Location:'.JURI::base().'client-listing-vic/client-folder-vic?pid='.$QuoteIDNum);} 
else {
header('Location:'.JURI::base().'builder-listing-vic/builder-folder-vic?pid='.$QuoteIDNum);}
}
// *************************** Include Cbeam Call Here *****************************************************//
echo "<table class=\"listing-table no-top-border\"><thead><tr><th>Description</th><th>Webbing</th><th>Colour</th><th>Finish</th><th>UOM</th><th>QTY</th><th>Length</th><th>RRP</th></tr></thead><tbody id=\"cbeam\" ></tbody></table>";
// *************************** End of Cbeam Call Here *****************************************************//

// *************************** Include Post Call Here *****************************************************//
echo "<table id=\"post\" class=\"listing-table no-top-border\"></table>";
// *************************** End of Post Call Here *****************************************************//

// *************************** Include Fixing Call Here *****************************************************//
echo "<table id=\"fixing\" class=\"listing-table no-top-border\"></table>";
// *************************** End of Fixing Call Here *****************************************************//

// *************************** Include Gutter Call Here *****************************************************//
echo "<table id=\"standardgutter\" class=\"listing-table no-top-border\"></table>";
echo "<table id=\"nonstandardgutter\" class=\"listing-table no-top-border\"></table>";
echo "<table id=\"addgutter\" class=\"listing-table no-top-border\"></table>";
// *************************** End of Gutter Call Here *****************************************************//

// *************************** Include Flashing Call Here *****************************************************//
echo "<table id=\"flashing\" class=\"listing-table no-top-border\"></table>";
// *************************** End of Flashing Call Here *****************************************************//

// *************************** Include Downpipe Call Here *****************************************************//
echo "<table id=\"downpipe\" class=\"listing-table no-top-border\"></table>";
// *************************** End of Pipe Call Here *****************************************************//


// *************************** Include Vergola Call Here *****************************************************//
echo "<table id=\"vergola\" class=\"listing-table no-top-border\"></table>";
// *************************** End of Vergola Call Here *****************************************************//

// *************************** Include Misc and Extras Call Here *****************************************************//
echo "<table id=\"misc\" class=\"listing-table no-top-border\"></table>";
echo "<table id=\"extras\" class=\"listing-table no-top-border\"></table>";
// *************************** End of Misc and Extras Call Here *****************************************************//

// *************************** Include Disbursement Call Here *****************************************************//
echo "<table id=\"disbursement\" class=\"listing-table no-top-border\"></table>";
// *************************** End of Disbursement Call Here *****************************************************//


?>
