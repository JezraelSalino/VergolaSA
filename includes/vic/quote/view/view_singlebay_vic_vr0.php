<?php 
$is_tender_quote=0;       
if(substr($QuoteID,0,3)=="TRV"){
	$is_tender_quote=1; 

	$sql = "SELECT * FROM ver_chronoforms_data_builderpersonal_vic WHERE tenderid  = '$QuoteID' LIMIT 1";
}else{
	$sql = "SELECT * FROM ver_chronoforms_data_clientpersonal_vic WHERE clientid  = '$QuoteID'";
}
 
$resultc = mysql_query($sql);
//$resultc = mysql_query("SELECT * FROM ver_chronoforms_data_clientpersonal_vic WHERE clientid  = '$QuoteID'");
$retrievec = mysql_fetch_array($resultc);
if (!$resultc) {die("Error: Data not found..");}

$salesrep = $retrievec['repname']; 
$rep_id = $retrievec['repident'];
$note = "";
//error_log("$salesrep:".$salesrep." rep_id:".$rep_id, 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_sa\\my-error.log'); 

if(isset($_POST['quotedate'])){ 
	$date =  $_POST['quotedate']; 
	$DateLodged = date('Y-m-d H:i:s', strtotime($date));  
}	
//error_log(print_r($_POST,true), 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_sa\\my-error.log'); exit();

if((isset($_POST['update']) || isset($_POST['save_duplicate']) || isset($_POST['save-close']) || isset($_POST['save_close_duplicate'])) && isset($_POST['projectid']))
{	
	//error_log("project id:".$_POST['projectid'], 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_sa\\my-error.log'); exit();
	$ProjectName = mysql_real_escape_string($_POST['projectsite']);
	//$DateLodged = $_POST['quotedate'];
	$FrameworkTYP = $_POST['frameworktype'];
	$Framework = $_POST['framework']; 
	$Length = $_POST['length'];
	$Width = $_POST['width'];
	$Bay = "";
	$default_color = $_POST['paintselect'];
	  
	$projectid = $_POST['projectid'];

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
 
	$insertArr = array();  

	$is_create_duplicate = 0;
	if(isset($_POST['save_duplicate']) || isset($_POST['save_close_duplicate'])){
		$is_create_duplicate = 1;
	} 

    if($is_create_duplicate==1){
    	//get the next project id for the duplicate quotation.
		$next_increment = 0;
		$qShowStatus = "SHOW TABLE STATUS LIKE 'ver_chronoforms_data_followup_vic'";
		$qShowStatusResult = mysql_query($qShowStatus) or die ( "Query failed: " . mysql_error() . "<br/>" . $qShowStatus );
		$row = mysql_fetch_assoc($qShowStatusResult);
		$next_increment = $row['Auto_increment'];
		$projectid = 'PRV'.$next_increment; 

		$i1 = 1;

	}else{
		//remove record every update of the quotation.
		$queryn = "DELETE FROM ver_chronoforms_data_quote_vic WHERE projectid = '{$projectid}'";
    	$i = mysql_query($queryn) or trigger_error("Insert failed: " . mysql_error());
	}
    
    //exit();
	for ($i=0; $i<$cnt6; $i++) { 
		$insertArr[] = "('$QuoteID', '" . mysql_real_escape_string($_POST['invent'][$i]) . "', '{$projectid}', '$ProjectName', '$FrameworkTYP', '$Framework', '" . mysql_real_escape_string($_POST['slength'][$i]) . "', '" . mysql_real_escape_string($_POST['desc'][$i]) . "', '" . mysql_real_escape_string($_POST['colour'][$i]) . "', '" . mysql_real_escape_string($_POST['qty'][$i]) . "', '" . mysql_real_escape_string($_POST['webbing'][$i]) . "', '" . mysql_real_escape_string($_POST['finish'][$i]) . "', '" . mysql_real_escape_string($_POST['uom'][$i]) . "', '" . mysql_real_escape_string($_POST['rrp'][$i]) . "', '" . mysql_real_escape_string($_POST['cst'][$i]) . "', '" . mysql_real_escape_string($_POST['is_additional'][$i]) . "')";
	}

	$queryn = "INSERT INTO ver_chronoforms_data_quote_vic (quoteid, inventoryid, projectid, project_name, framework_type, framework, length, description, colour, qty, webbing, finish, uom, rrp, cost, is_additional) VALUES " . implode(", ", $insertArr);
 	//error_log($queryn, 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_sa\\my-error.log'); // exit();
 	mysql_query($queryn) or trigger_error("Insert failed: " . mysql_error());

  
	//New computation
	$SubtotalVergola = $_POST['total_vergola'];
	$SubtotalDisbursement = $_POST['total_disbursement'];
	$Totalrrp = $_POST['total_rrp'];
	$Totalgst = $_POST['total_gst'];
	$Totalrrpgst = $_POST['total_sum'];

	$Totalcost = $_POST['sub_total'];
	$Totalcostgst = $_POST['total_gst'];
	$GSTPercent = $_POST['gst'];
	$CommPercent = $_POST['commision'];
	$SalesCost = $_POST['com_sales_commission'];
	$InstallCost = $_POST['com_installer_payment'];

	$payment_deposit = $_POST['payment_deposit'];
	$payment_progress = $_POST['payment_progress'];
	$payment_final = $_POST['payment_final'];
	$SalesComm = $_POST['com_sales_commission'];
	$com_pay1 = $_POST['com_pay1'];
	$com_pay2 = $_POST['com_pay2'];
	$com_final = $_POST['com_final'];

	if($is_create_duplicate==1){
		//$projectid 
	}else{  
		$queryp = "DELETE FROM ver_chronoforms_data_followup_vic WHERE projectid='{$projectid}'";
	}
	//error_log($queryp, 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_sa\\my-error.log');  //exit();  
	mysql_query($queryp) or trigger_error("Insert failed: " . mysql_error());

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
	status,
	payment_deposit,
	payment_progress,
	payment_final,
	com_pay1,
	com_pay2,
	com_final,
	rep_id,
	updated_at,
	default_color) 

	VALUES 
	('$salesrep', 
	'$QuoteID', 
	'{$projectid}', 
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
	'$SalesComm', 
	'$InstallCost', 'Quoted',
	'$payment_deposit',  
	'$payment_progress',  
	'$payment_final', 
	'$com_pay1', 
	'$com_pay2',  
	'$com_final',
	'$rep_id',
	NOW(),
	'$default_color')";
	//error_log($queryp, 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_sa\\my-error.log'); // exit();
	 mysql_query($queryp) or trigger_error("Insert failed: " . mysql_error());
	 
	if($is_create_duplicate==1){
		//$projectid 
	}else{ 
		$queryp = "DELETE FROM ver_chronoforms_data_measurement_vic WHERE projectid='{$projectid}'";  
		mysql_query($queryp) or trigger_error("Insert failed: " . mysql_error());
	}

	$querym = "INSERT INTO ver_chronoforms_data_measurement_vic (projectid, framework_type, width, length, bay) VALUES ('{$projectid}', '$FrameworkTYP', '$Width', '$Length', '$Bay')";
	//error_log("ENDING... ".$ProjectID, 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_sa\\my-error.log');//exit();
	mysql_query($querym) or trigger_error("Insert failed: " . mysql_error());
	 
	 
	$Framework = $FrameworkTYP;	
  
	//Save the quotation report
	$clientid=$QuoteID;
	$title=$projectid;
	$content=generateHtmlReport($projectid,$title);
 
	if($is_create_duplicate==1){
		$sql = "INSERT INTO ver_chronoforms_data_letters_vic (clientid, template_name, datecreated, template_content) 
				 VALUES ('$clientid','$title', NOW(), '{$content}')";
	}else{ 
		$sql = "UPDATE ver_chronoforms_data_letters_vic  SET template_content = '$content' WHERE template_name='{$title}'; "; 
	} 
	//error_log($sql, 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_sa\\my-error.log'); 
	mysql_query($sql); 

	if(isset($_POST['save-close'])){
		//header('Location:'.JURI::base().'client-listing-vic/client-folder-vic?cid='.$QuoteID); 
		if($is_tender_quote){
			header('Location:'.JURI::base()."tender-listing-vic/tender-folder-vic?tenderid=".$QuoteID);					
		}else if($retrievec['is_builder']){
			header('Location:'.JURI::base().'builder-listing-vic/builder-folder-vic?cid='.$QuoteID);
		}else{
			header('Location:'.JURI::base().'client-listing-vic/client-folder-vic?cid='.$QuoteID);
		}
	}else{ 
		header('Location:'.JURI::base().'view-quote-vic?projectid='.$projectid); 
	}


	if($is_create_duplicate==1){
		header('Location:'.JURI::base().'view-quote-vic?projectid='.$projectid);	
		exit();
	}


	$ProjectName = stripslashes($ProjectName);
	//error_log($sql, 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_sa\\my-error.log'); 
}

 



$sql = "SELECT * FROM ver_chronoforms_data_letters_vic WHERE template_name='{$ProjectID}' LIMIT 1"; 
$row = mysql_fetch_assoc(mysql_query($sql)); 


if(empty($row)){
	//Save the quotation report
	$clientid=$QuoteID;
	$title=$ProjectID;
	$projectid=$ProjectID;
	$content=generateHtmlReport($projectid,$title);

	$sql = "INSERT INTO ver_chronoforms_data_letters_vic (clientid, template_name, datecreated, template_content) 
			 VALUES ('$clientid','$title', NOW(), '{$content}')";  
	mysql_query($sql);  		 
	//error_log($sql, 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_sa\\my-error.log'); 		 
	  
}


//error_log("HERE 1", 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_sa\\my-error.log');
// if(isset($VergolaType) && $VergolaType=="Double Bay - VR2"){
// 	//$projectId = $ProjectID;
// }else{
// 	//$projectId = null;
// }
//error_log("PROJECTID : ".$ProjectID, 3,'/home/vergola/public_html/quote-system/my-error.log'); exit();

function generateRowItem($section,$projectId){
	$tr = "";
	//error_log("projectId:".$projectId, 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_sa\\my-error.log');
	if($section=="frame"){
	 	//error_log("SELECT  * FROM ver_chronoforms_data_quote_vic AS q LEFT JOIN ver_chronoforms_data_inventory_vic AS i ON i.inventoryid=q.inventoryid WHERE projectid='{$projectId}' AND LOWER(i.section) = 'frame'", 3,'/home/vergola/public_html/quote-system/my-error.log'); 
	  
	 	$fw = mysql_query("SELECT  i.inventoryid, q.* FROM ver_chronoforms_data_quote_vic AS q LEFT JOIN ver_chronoforms_data_inventory_vic AS i ON i.inventoryid=q.inventoryid WHERE projectid='{$projectId}' AND (LOWER(i.section) = 'frame' OR  LOWER(i.section) = 'posts')  " ); // 
	 	 

	 	//error_log("SELECT  * FROM ver_chronoforms_data_quote_vic AS q LEFT JOIN ver_chronoforms_data_inventory_vic AS i ON i.inventoryid=q.inventoryid WHERE projectid='{$projectId}' AND LOWER(i.section) = 'frame' AND (LOWER(section) = 'frame' OR LOWER(section) = 'posts') ORDER BY FIELD(i.inventoryid, 'IRV3','IRV4', 'IRV120', 'IRV121', 'IRV15', 'IRV15', 'IRV23', 'IRV24', 'IRV25', 'IRV22', 'IRV122') " , 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_sa\\my-error.log');
	 	
		$isFirst = 1;
		while ($r = mysql_fetch_assoc($fw)) { 
			$item = mysql_fetch_assoc(mysql_query("SELECT * FROM  ver_chronoforms_data_inventory_vic AS i  WHERE inventoryid='{$r["inventoryid"]}' " )); 
			$tr .= "<tr>"; 
					if(strtolower($item["category"])=="beams" || strtolower($item["category"])=="intermediate" || strtolower($item["category"])=="posts" || strtolower($item["category"])=="beam fixings"){ 
						
						$lw = ""; $isFirst==1?$lw = "length":$lw ="width";
						$tr .= "<td class=\"td-item\">".listItem($item["section"],$item,strtolower($item["category"]))." <input type=\"hidden\" class=\"price\" value=\"{$item['rrp']}\"  category=\"{$item['category']}\"  inventoryid=\"{$item['inventoryid']}\" desc=\"{$item['description']}\" />   </td>";
						if(strtolower($item["category"])=="posts" || strtolower($item["category"])=="beam fixings"){
							$tr .= "<td> <input type=\"hidden\" name=\"webbing[]\" /> </td>"; 
						}
						else{
							$tr .= "<td class=\"td-webbing\">".listWebbing("",$r)."</td>"; 
						}

						$tr .= "<td>".listColours("",$r)."</td>";   
						$tr .= "<td class=\"td-finish-color\">".listColourBond(null,$r)."</td>";  
						$tr .= "<td class=\"td-uom\">{$item["uom"]} <input type=\"hidden\" name=\"uom[]\" value=\"{$item["uom"]}\" \> </td>";  
						$tr .= "<td class=\"td-qty\"><input type=\"text\" class=\"qtylen\" name=\"qty[]\" value=\"{$r['qty']}\"></td>";

						if($item["category"] == "Posts"){
							$tr .= "<td class=\"td-len\"><input type=\"text\"  name=\"slength[]\" class=\"input-size input-in\" value=\"{$r['length']}\"  ></td>";  
						}else if($item["uom"]=="Ea"){
							$tr .= "<td class=\"td-len\"><input type=\"text\"  name=\"slength[]\" class=\"input-in\" value=\"{$r['length']}\" style=\"display:none;\"></td>";  
						}else{
							$tr .= "<td class=\"td-len\"><input type=\"text\"  name=\"slength[]\" class=\"".($r['is_additional']=="1"?"":$lw)." input-size input-in\" value=\"{$r['length']}\" style=\"".($item["uom"]=="Ea"?"display:none;":"")." \" ></td>"; 
						}

						if(METRIC_SYSTEM=="inch" && $item["category"]=="Posts" ){
							$tr .= "<td class=\"td-ft\"><input type=\"text\"  class=\"input-ft\" value=\"".get_feet_value($r['length'])."\"  ></td>";  
						}else if(METRIC_SYSTEM=="inch" && $item["uom"]=="Ea"){
							$tr .= "<td class=\"td-ft\"><input type=\"text\"  class=\"input-ft\" style=\"display:none;\" value=\"".get_feet_value($r['length'])."\" ></td>";  
						}else if(METRIC_SYSTEM=="inch"){
							$tr .= "<td class=\"td-ft\"><input type=\"text\"  class=\"input-ft\" value=\"".get_feet_value($r['length'])."\" ></td>";  
						}
 
						
						$tr .= "<td class=\"td-rrp\"><input type=\"text\" class=\"rrp\" readonly=\"readonly\" name=\"rrp[]\" value=\"{$r['rrp']}\"></td>";  
						$isFirst = 0;
					}else{
						$tr .= "<td class=\"td-item\">".$item["description"]." <input type=\"hidden\"  class=\"price\"  value=\"{$item['rrp']}\" category=\"{$item['category']}\" inventoryid=\"{$item['inventoryid']}\" desc=\"{$item['description']}\" /> </td>";
						$tr .= "<td> <input type=\"hidden\" name=\"webbing[]\" /> </td>"; 
						$tr .= "<td> <input type=\"hidden\" name=\"colour[]\" /> </td>";  
						$tr .= "<td> <input type=\"hidden\" name=\"finish[]\" /> </td>";   
						$tr .= "<td class=\"td-uom\"> {$item["uom"]} <input type=\"hidden\" name=\"uom[]\" value=\"{$item["uom"]}\" \> </td>";  
						$tr .= "<td class=\"td-qty\"><input type=\"text\" class=\"qtylen\" name=\"qty[]\" value=\"{$r['qty']}\"></td>";  
						$tr .= "<td class=\"td-len\"> <input type=\"text\"  name=\"slength[]\" class=\"input-in\" value=\"{$r['length']}\" style=\"display:none\"> </td>";  

						if(METRIC_SYSTEM=="inch"){
							$tr .= "<td class=\"td-ft\"><input type=\"text\"  class=\"input-ft\" value=\"".get_feet_value($r['length'])."\" style=\"".($item["uom"]=="Ea"?"display:none;":"")."\" ></td>";  
						} 

						$tr .= "<td class=\"td-rrp\"><input type=\"text\" class=\"rrp\" readonly=\"readonly\" name=\"rrp[]\" value=\"{$r['rrp']}\"></td>";  
					}

					$tr .= "<input type=\"hidden\" class=\"desc\" name=\"desc[]\" value=\"".$item['description']."\" readonly=\"readonly\" />".
					       "<input type=\"hidden\" class=\"invent\" name=\"invent[]\" value=\"".$item['inventoryid']."\" readonly=\"readonly\" />".
					       "<input type=\"hidden\" class=\"\" name=\"is_additional[]\" value=\"".$r['is_additional']."\" readonly=\"readonly\" />";
					
		   	$tr .= "</tr>";
	 	}

	 	$tr .= "<tr id=\"framework_last_row\">";  
			$tr .= "<td class=\"td-item\"> <input type=\"button\" class=\"save-btn\" value=\"Add Beam / Post\" onclick=\"add_new_post()\" />   </td>";
			$tr .= "<td> </td>"; 
			$tr .= "<td> </td>";   
			$tr .= "<td> </td>";  
			$tr .= "<td>  </td>";  
			$tr .= "<td class=\"td-qty\"> </td>";  
			$tr .= "<td class=\"td-len\"> </td>";  
			if(METRIC_SYSTEM=="inch"){
				$tr .= "<td class=\"td-ft\"> </td>";  
			} 
			$tr .= "<td class=\"td-rrp\"> </td>";   
	 	$tr .= "</tr>";
  
	 	
	 }else if($section=="fixings"){
	 	
		
		if($projectId==null){
	 		$fw = mysql_query("SELECT * FROM ver_vergola_default_framework_items  WHERE LOWER(framework) = 'single bay vr1' AND LOWER(section) = 'fixings'" ); // 
	 	}else{
	 		$fw = mysql_query("SELECT i.inventoryid, q.* FROM ver_chronoforms_data_quote_vic AS q LEFT JOIN ver_chronoforms_data_inventory_vic AS i ON i.inventoryid=q.inventoryid WHERE projectid='{$projectId}' AND LOWER(i.section) = 'fixings'  " ); // 
	 	}

		while ($r = mysql_fetch_assoc($fw)) { 
			$item = mysql_fetch_assoc(mysql_query("SELECT * FROM  ver_chronoforms_data_inventory_vic AS i  WHERE inventoryid='{$r["inventoryid"]}' " )); 
				
			$tr .= "<tr>";  
			 
			$tr .= "<td class=\"td-item\">".$item["description"]." <input type=\"hidden\" class=\"price\" value=\"{$item['rrp']}\" category=\"{$item['category']}\" inventoryid=\"{$item['inventoryid']}\" desc=\"{$item['description']}\" /> </td>";
			$tr .= "<td> </td>"; 
			$tr .= "<td> <input type=\"hidden\" name=\"colour[]\" /></td>";  
			$tr .= "<td> <input type=\"hidden\" name=\"finish[]\" /></td>";   
			$tr .= "<td class=\"td-uom\"> {$item["uom"]} <input type=\"hidden\" name=\"uom[]\" value=\"{$item["uom"]}\" \> </td>";  
			$tr .= "<td class=\"td-qty\"><input type=\"text\" class=\"qtylen\" name=\"qty[]\" value=\"{$r['qty']}\"></td>";  
			$tr .= "<td class=\"td-len\"><input type=\"text\"  name=\"slength[]\" class=\"input-in\" value=\"{$r['length']}\" style=\"display:none\"> </td>";  
			if(METRIC_SYSTEM=="inch"){
				$tr .= "<td class=\"td-ft\"><input type=\"text\"  class=\"input-ft\" value=\"".get_feet_value($r['length'])."\" style=\"".($item["uom"]=="Ea"?"display:none;":"")."\" ></td>";  
			} 
			$tr .= "<td class=\"td-rrp\"><input type=\"text\" class=\"rrp\" readonly=\"readonly\" name=\"rrp[]\" value=\"{$r['rrp']}\"><input type=\"hidden\" class=\"cst\" name=\"cst[]\" value=\"\"></td>";  
		   
	  		$tr .= "<input type=\"hidden\" class=\"desc\" name=\"desc[]\" value=\"".$item['description']."\" readonly=\"readonly\" />".
				   "<input type=\"hidden\" class=\"invent\" name=\"invent[]\" value=\"".$item['inventoryid']."\" readonly=\"readonly\" />".
				   "<input type=\"hidden\" class=\"\" name=\"is_additional[]\" value=\"".$r['is_additional']."\" readonly=\"readonly\" />";

		   	$tr .= "</tr>";
	 	}

	 	$tr .= "<tr id=\"fixing_last_row\" >";  
			$tr .= "<td class=\"td-item\"> <input type=\"button\" class=\"save-btn\" value=\"Add Fixing\" onclick=\"add_new_fixing()\" />   </td>";
			$tr .= "<td> </td>"; 
			$tr .= "<td> </td>";   
			$tr .= "<td> </td>";  
			$tr .= "<td>  </td>";  
			$tr .= "<td class=\"td-qty\"> </td>";  
			$tr .= "<td class=\"td-len\"> </td>";  
			if(METRIC_SYSTEM=="inch"){
				$tr .= "<td class=\"td-ft\"> </td>";  
			} 
			$tr .= "<td class=\"td-rrp\"> </td>";   
	 	$tr .= "</tr>";

	 }else if($section=="guttering"){
	 	
	 	
		if($projectId==null){
			//error_log("HERE 1", 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_sa\\my-error.log');
	 		$fw = mysql_query("SELECT * FROM ver_vergola_default_framework_items   WHERE  framework = 'Single Bay VR1' AND LOWER(section) = 'guttering'" ); // 
	 	}else{
	 		//error_log("HERE 2", 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_sa\\my-error.log');
	 		$fw = mysql_query("SELECT i.inventoryid, q.* FROM ver_chronoforms_data_quote_vic AS q LEFT JOIN ver_chronoforms_data_inventory_vic AS i ON i.inventoryid=q.inventoryid  WHERE  projectid='{$projectId}' AND LOWER(i.section) = 'guttering' " ); //  
	 	}

		$isFirstTwo = 1;$k=0; 
		
		while ($r = mysql_fetch_assoc($fw)) { 
			$item = mysql_fetch_assoc(mysql_query("SELECT * FROM  ver_chronoforms_data_inventory_vic AS i  WHERE inventoryid='{$r["inventoryid"]}' " )); 
			//error_log("IRV: {$item['inventoryid']} - {$r['rrp']}", 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_sa\\my-error.log');
			//error_log(print_r($r,true), 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_sa\\my-error.log');
			$lw = ""; $isFirstTwo==1?$lw = "length":$lw ="width"; 
			$k=$k+1;
			$tr .= "<tr>";  
			$tr .= "<td class=\"td-item\">".listItem("guttering",$item)." <input type=\"hidden\"  class=\"price\" value=\"{$item['rrp']}\" category=\"{$item['category']}\" inventoryid=\"{$item['inventoryid']}\" desc=\"{$item['description']}\" /> </td>";
			$tr .= "<td></td>"; 
			$tr .= "<td>".listColours("",$r)."</td>";   
			$tr .= "<td class=\"td-finish-color\">".listColourBond(null,$r,"Guttering")."</td>";  
			$tr .= "<td class=\"td-uom\">{$item["uom"]} <input type=\"hidden\" name=\"uom[]\" value=\"{$item["uom"]}\" \> </td>";  
		 
			if($item["inventoryid"] == "IRV31"){ 
				$tr .= "<td class=\"td-qty\"><input type=\"text\" class=\"qtylen\" name=\"qty[]\" value=\"{$r['qty']}\"></td>";  
			}else{
				$tr .= "<td class=\"td-qty\"><input type=\"text\" class=\"qtylen gutter-qty\" name=\"qty[]\" value=\"{$r['qty']}\"></td>";  
			}	

			if($item["inventoryid"] == "IRV31"){  
				$tr .= "<td class=\"td-len\"><input type=\"text\"  id=\"gutterLiningLength\" name=\"slength[]\"  class=\"".($r['is_additional']=="1"?"":$lw)." input-in\" value=\"{$r['length']}\"></td>"; 
			}else{
				$tr .= "<td class=\"td-len\"><input type=\"text\"  name=\"slength[]\" class=\"".($r['is_additional']=="1"?"":$lw)." input-in gutter-length\" value=\"{$r['length']}\"></td>"; 
			}

			if(METRIC_SYSTEM=="inch"){
				if($item["inventoryid"] == "IRV31"){  
					$tr .= "<td class=\"td-ft\"><input type=\"text\"  id=\"gutterLiningLength_ft\" class=\"input-ft\" value=\"".get_feet_value($r['length'])."\" style=\"".($item["uom"]=="Ea"?"display:none;":"")."\" ></td>";  
				}else{
					$tr .= "<td class=\"td-ft\"><input type=\"text\"  class=\"gutter-length input-ft\" value=\"".get_feet_value($r['length'])."\" style=\"".($item["uom"]=="Ea"?"display:none;":"")."\" ></td>";  
				}
			} 
			 
			$tr .= "<td class=\"td-rrp\"><input type=\"text\" class=\"rrp\" readonly=\"readonly\" name=\"rrp[]\" value=\"{$r['rrp']}\"></td>";  
			
			$tr .= "<input type=\"hidden\" class=\"desc\" name=\"desc[]\" value=\"".$item['description']."\" readonly=\"readonly\" />".
					"<input type=\"hidden\" class=\"invent\" name=\"invent[]\" value=\"".$item['inventoryid']."\" readonly=\"readonly\" />".
					"<input type=\"hidden\" class=\"\" name=\"is_additional[]\" value=\"".$r['is_additional']."\" readonly=\"readonly\" />";
			$tr .= "</tr>";
			
			if($k==2)$isFirstTwo=0;

	 	}

	 	$tr .= "<tr id=\"gutter_last_row\" >";  
			$tr .= "<td class=\"td-item\"> <input type=\"button\" class=\"save-btn\" value=\"Add Non-Standard Gutter\" onclick=\"add_new_non_standard_gutter()\" />   </td>";
			$tr .= "<td> </td>"; 
			$tr .= "<td> </td>";   
			$tr .= "<td> </td>";  
			$tr .= "<td>  </td>";  
			$tr .= "<td class=\"td-qty\"> </td>";  
			$tr .= "<td class=\"td-len\"> </td>";  
			if(METRIC_SYSTEM=="inch"){
				$tr .= "<td class=\"td-ft\"> </td>";  
			} 
			$tr .= "<td class=\"td-rrp\"> </td>";   
	 	$tr .= "</tr>";

 		$tr .= "<tr >";  
			$tr .= "<td class=\"td-item\"> <input type=\"button\" class=\"save-btn\" value=\"Add Standard Gutter\" onclick=\"add_new_gutter()\" />   </td>";
			$tr .= "<td> </td>"; 
			$tr .= "<td> </td>";   
			$tr .= "<td> </td>";  
			$tr .= "<td>  </td>";  
			$tr .= "<td class=\"td-qty\"> </td>";  
			$tr .= "<td class=\"td-len\"> </td>";  
			if(METRIC_SYSTEM=="inch"){
				$tr .= "<td class=\"td-ft\"> </td>";  
			} 
			$tr .= "<td class=\"td-rrp\"> </td>";   
	 	$tr .= "</tr>";


	}else if($section=="flashings"){ 
	 	
		if($projectId==null){
	 		$fw = mysql_query("SELECT * FROM ver_vergola_default_framework_items   WHERE  framework = 'Single Bay VR1' AND LOWER(section) = 'flashings'" ); // 
	 	}else{
	 		$fw = mysql_query("SELECT  i.inventoryid, q.* FROM ver_chronoforms_data_quote_vic AS q LEFT JOIN ver_chronoforms_data_inventory_vic AS i ON i.inventoryid=q.inventoryid WHERE  projectid='{$projectId}' AND LOWER(i.section) = 'flashings' " ); // 
	 	}

		while ($r = mysql_fetch_assoc($fw)) { 
			$item = mysql_fetch_assoc(mysql_query("SELECT * FROM  ver_chronoforms_data_inventory_vic AS i  WHERE inventoryid='{$r["inventoryid"]}' " )); 
			$tr .= "<tr>"; 
					$lw = "length";
					$tr .= "<td class=\"td-item\"> {$item['description']} <input type=\"hidden\" class=\"price\" value=\"{$item['rrp']}\" category=\"{$item['category']}\" inventoryid=\"{$item['inventoryid']}\" desc=\"{$item['description']}\" /> </td>";
					$tr .= "<td></td>"; 
					$tr .= "<td>".listColours("",$r)."</td>";   
					$tr .= "<td class=\"td-finish-color\">".listColourBond(null,$r,"Guttering")."</td>";  
					$tr .= "<td class=\"td-uom\">{$item["uom"]} <input type=\"hidden\" name=\"uom[]\" value=\"{$item["uom"]}\" \> </td>";  
					$tr .= "<td class=\"td-qty\"><input type=\"text\" class=\"qtylen\" name=\"qty[]\" value=\"{$r['qty']}\"></td>";  
					$tr .= "<td class=\"td-len\"><input type=\"text\"  name=\"slength[]\" class=\"".($r['is_additional']=="1"?"":$lw)." input-in\" value=\"{$r['length']}\"></td>";  

					if(METRIC_SYSTEM=="inch"){
						$tr .= "<td class=\"td-ft\"><input type=\"text\"  class=\"input-ft\" value=\"".get_feet_value($r['length'])."\" style=\"".($item["uom"]=="Ea"?"display:none;":"")."\" ></td>";  
					} 

					$tr .= "<td class=\"td-rrp\"><input type=\"text\" class=\"rrp\" readonly=\"readonly\" name=\"rrp[]\" value=\"{$r['rrp']}\"></td>";  
  
  					$tr .= "<input type=\"hidden\" class=\"desc\" name=\"desc[]\" value=\"".$item['description']."\" readonly=\"readonly\" />".
							"<input type=\"hidden\" class=\"invent\" name=\"invent[]\" value=\"".$item['inventoryid']."\" readonly=\"readonly\" />".
					       "<input type=\"hidden\" class=\"\" name=\"is_additional[]\" value=\"".$r['is_additional']."\" readonly=\"readonly\" />";

		   	$tr .= "</tr>";
	 	} 

	 	$tr .= "<tr id=\"flashing_last_row\">";  
			$tr .= "<td class=\"td-item\"> <input type=\"button\" class=\"save-btn\" value=\"Add Flashing\" onclick=\"add_new_flashing()\" />   </td>";
			$tr .= "<td> </td>"; 
			$tr .= "<td> </td>";   
			$tr .= "<td> </td>";  
			$tr .= "<td>  </td>";  
			$tr .= "<td class=\"td-qty\"> </td>";  
			$tr .= "<td class=\"td-len\"> </td>";  
			if(METRIC_SYSTEM=="inch"){
				$tr .= "<td class=\"td-ft\"> </td>";  
			} 
			$tr .= "<td class=\"td-rrp\"> </td>";   
	 	$tr .= "</tr>";

	}else if($section=="downpipe"){
	 	
	 	
		if($projectId==null){
	 		$fw = mysql_query("SELECT * FROM ver_vergola_default_framework_items   WHERE  framework = 'Single Bay VR1' AND LOWER(section) = 'downpipe'" ); // 
	 	}else{
	 		$fw = mysql_query("SELECT  i.inventoryid, q.* FROM ver_chronoforms_data_quote_vic AS q LEFT JOIN ver_chronoforms_data_inventory_vic AS i ON i.inventoryid=q.inventoryid WHERE  projectid='{$projectId}'  AND LOWER(section) = 'downpipe' " ); // 
	 	}

		while ($r = mysql_fetch_assoc($fw)) { 
			$item = mysql_fetch_assoc(mysql_query("SELECT * FROM  ver_chronoforms_data_inventory_vic AS i  WHERE inventoryid='{$r["inventoryid"]}' " )); 
			
			$tr .= "<tr>"; 
			$tr .= "<td class=\"td-item\">".addslashes($item["description"])." <input type=\"hidden\" class=\"price\"  value=\"{$item['rrp']}\" category=\"{$item['category']}\" inventoryid=\"{$item['inventoryid']}\" desc=\"".addslashes($item["description"])."\" /> </td>";
			$tr .= "<td> </td>"; 
			$tr .= "<td> <input type=\"hidden\" name=\"colour[]\" /> </td>";  
			$tr .= "<td> <input type=\"hidden\" name=\"finish[]\" /> </td>";   
			$tr .= "<td class=\"td-uom\"> {$item["uom"]} <input type=\"hidden\" name=\"uom[]\" value=\"{$item["uom"]}\" \> </td>";  
			$tr .= "<td class=\"td-qty\"><input type=\"text\" class=\"qtylen\" name=\"qty[]\" value=\"{$r['qty']}\"></td>";  
			$tr .= "<td class=\"td-len\"><input type=\"text\"  name=\"slength[]\" class=\"input-in\" value=\"{$r['length']}\" style=\"display:none\"> </td>";  
			if(METRIC_SYSTEM=="inch"){
				$tr .= "<td class=\"td-ft\"><input type=\"text\"  class=\"input-ft\" value=\"".get_feet_value($r['length'])."\" style=\"".($item["uom"]=="Ea"?"display:none;":"")."\" ></td>";  
			} 
			$tr .= "<td class=\"td-rrp\"><input type=\"text\" class=\"rrp\" readonly=\"readonly\" name=\"rrp[]\" value=\"{$r['rrp']}\"><input type=\"hidden\" class=\"cst\" name=\"cst[]\" value=\"\"></td>";  
			
			$tr .= "<input type=\"hidden\" class=\"desc\" name=\"desc[]\" value=\"".addslashes($item["description"])."\" readonly=\"readonly\" />".
					"<input type=\"hidden\" class=\"invent\" name=\"invent[]\" value=\"".$item['inventoryid']."\" readonly=\"readonly\" />".
					"<input type=\"hidden\" class=\"\" name=\"is_additional[]\" value=\"".$r['is_additional']."\" readonly=\"readonly\" />";

			$tr .= "</tr>";
	 	} 

	 	$tr .= "</tr>";

			$tr .= "<tr id=\"downpipe_last_row\" >";  
			$tr .= "<td class=\"td-item\"> <input type=\"button\" class=\"save-btn\" value=\"Add Downpipe\" onclick=\"add_new_downpipe()\" />   </td>";
			$tr .= "<td> </td>"; 
			$tr .= "<td> </td>";   
			$tr .= "<td> </td>";  
			$tr .= "<td>  </td>";  
			$tr .= "<td class=\"td-qty\"> </td>";  
			$tr .= "<td class=\"td-len\"> </td>";  
			if(METRIC_SYSTEM=="inch"){
				$tr .= "<td class=\"td-ft\"> </td>";  
			} 
			$tr .= "<td class=\"td-rrp\"> </td>";   
	 	$tr .= "</tr>";

	}else if($section=="vergola"){
	 
	 	$fw = mysql_query("SELECT  i.inventoryid, q.* FROM ver_chronoforms_data_quote_vic AS q LEFT JOIN ver_chronoforms_data_inventory_vic AS i ON i.inventoryid=q.inventoryid WHERE  projectid='{$projectId}' AND LOWER(i.section) = 'vergola'" ); // 
	 	 
	 	$isFirst = 1; $isSecond = 0;$isThird = 0;$isFourth = 0; $isFifth=0;  
	 	$colorSelection = ""; $listColourBondSelection = "";
	 	$itemName = "";


		while ($r = mysql_fetch_assoc($fw)) { 
			$item = mysql_fetch_assoc(mysql_query("SELECT * FROM  ver_chronoforms_data_inventory_vic AS i  WHERE inventoryid='{$r["inventoryid"]}' " ));  

			
			if($isFirst==1){ 
				$isSecond=1; 
				//$colorSelection = listColours2($r['colour'],null,"Vergola-colour");
				$colorSelection = listColours("",$r,"Vergola-colour");
				$listColourBondSelection = listColourBond(null,$r,"Vergola");
			
			}else if($isSecond==1){ 
				$isSecond=0; $isThird=1;  
				$colorSelection = listColours("",$r,"Vergola-colour");
				$listColourBondSelection = listColourBond(null,$r,"Vergola");

			}else if($isThird==1){ 
				$isThird=0; $isFourth=1; 
				$colorSelection = listColours("",$r,"Vergola-colour");
				$listColourBondSelection = listColourBond(null,$r,"Vergola");

			}else if($isFourth==1){ 
				$isFourth=0; $isFifth=1;  
				$colorSelection = "<input type=\"hidden\" name=\"colour[]\" />";
				$listColourBondSelection = "<input type=\"hidden\" name=\"finish[]\" />";

			}else if($isFifth==1){ 
				$isFifth=0;  

				$colorSelection = listColours("",$r,"Vergola-colour");
				$listColourBondSelection = listColourBond(null,$r,"Vergola");

			}else if($r["is_additional"]==1){  
				 
				$colorSelection = listColours("",$r,"Vergola-colour");
				$listColourBondSelection = listColourBond(null,$r,"Vergola");

			}else{
				$colorSelection = "<input type=\"hidden\" name=\"colour[]\" />";
				$listColourBondSelection = "<input type=\"hidden\" name=\"finish[]\" />";
			}

			$itemQty = "";
			$itemLen = ""; 

			if($item["category"]=="Louvers"){ //5 Louvres Poly in ever meter.
				$itemQty = 'id="louvres-qty"';
				$itemLen = 'id="louvres-len"'; 
				if(METRIC_SYSTEM=="inch"){ 
					$itemLen_ft = 'id="louvres-len_ft"'; 
				}	
				//$className = "";
			}else if($item["inventoryid"]=="IRV58"){ //2 Endcap every Louveres
				$itemQty = 'id="endcap-qty"';
				$itemLen = 'id="endcap-len"'; 
				if(METRIC_SYSTEM=="inch"){ 
					$itemLen_ft = 'id="endcap-len_ft"'; 
				}	
				//$className = "";
			}else if($item["inventoryid"]=="IRV59"){ //2 Endcap every Louveres
				$itemQty = 'id="pivot-qty"';
				$itemLen = 'id="pivot-len"'; 
				if(METRIC_SYSTEM=="inch"){ 
					$itemLen_ft = 'id="pivot-len_ft"'; 
				}	
				//$className = "";
			}else if($item["inventoryid"]=="IRV60"){ //2 Endcap every Louveres
				$itemQty = 'id="linkBar-qty"';
				$itemLen = 'id="linkBar-len"'; 
				if(METRIC_SYSTEM=="inch"){ 
					$itemLen_ft = 'id="pivot-len_ft"'; 
				}	 
			}

			
			$lengthInput = ""; $lengthInput_ft = "";
			if($isFirst){
				$itemName = listItem("louvres",$r);
				$lengthInput = "<input type=\"text\"  {$itemLen} name=\"slength[]\" class=\"input-in louver-item-len\" value=\"{$r['length']}\" />";
				if(METRIC_SYSTEM=="inch"){
					$lengthInput_ft = "<input type=\"text\"  {$itemLen_ft}  class=\"input-ft louver-item-len\" value=\"".get_feet_value($r['length'])."\" />";
				}
			}else if($r["is_additional"] == 1 && $item["category"]=="Louvers"){ 
				   
				$itemName = listItem("louvres",$r);
				$lengthInput = "<input type=\"text\"    name=\"slength[]\" class=\"input-in louver-item-len\" value=\"{$r['length']}\"  />";
				if(METRIC_SYSTEM=="inch"){
					$lengthInput_ft = "<input type=\"text\"    class=\"input-ft louver-item-len\" value=\"".get_feet_value($r['length'])."\"    />";
				}	
				 

			}else{
				$itemName = $item["description"];
				$lengthInput = "<input type=\"text\"  {$itemLen} name=\"slength[]\" class=\"length input-in\" value=\"{$r['length']}\"  style=\"display:none\" />";

				 
				if(METRIC_SYSTEM=="inch"){
					$lengthInput_ft = "<input type=\"text\"  {$itemLen_ft}   class=\"length input-ft\" value=\"".get_feet_value($r['length'])."\"  style=\"display:none\" />";
				}
			}


			$tr .= "<tr class=\"tr-vergola\">";
			$tr .= "<td class=\"td-item\"> {$itemName} <input type=\"hidden\" class=\"price\"  value=\"{$item['rrp']}\" category=\"{$item['category']}\" inventoryid=\"{$item['inventoryid']}\" desc=\"{$item['description']}\" /> </td>";
			$tr .= "<td> </td>";
			$tr .= "<td>".$colorSelection."</td>";
			$tr .= "<td  class=\"td-finish-color\">".$listColourBondSelection."</td>";
			$tr .= "<td class=\"td-uom\"> {$item["uom"]} <input type=\"hidden\" name=\"uom[]\" value=\"{$item["uom"]}\" \> </td>";
			 
			$tr .= "<td class=\"td-qty\"><input type=\"text\" {$itemQty} class=\"qtylen ".($isFirst?"louver-item-qty":($r["is_additional"] == 1?"louver-item-qty":""))."\" ".($isFirst?$itemQty:"")." name=\"qty[]\" value=\"{$r['qty']}\"></td>";
			 
			$tr .= "<td class=\"td-len\">  {$lengthInput} </td>"; 

			if(METRIC_SYSTEM=="inch"){
				$tr .= "<td class=\"td-ft\"> {$lengthInput_ft}</td>";
			} 

			$tr .= "<td class=\"td-rrp\"><input type=\"text\" class=\"rrp\" readonly=\"readonly\" name=\"rrp[]\" value=\"{$r['rrp']}\"><input type=\"hidden\" class=\"cst\" name=\"cst[]\" value=\"\"></td>"; 
			
			$tr .= "<input type=\"hidden\" class=\"desc\" name=\"desc[]\" value=\"".$item['description']."\" readonly=\"readonly\" />".
					"<input type=\"hidden\" class=\"invent\" name=\"invent[]\" value=\"".$item['inventoryid']."\" readonly=\"readonly\" />".
					"<input type=\"hidden\" class=\"\" name=\"is_additional[]\" value=\"".$r['is_additional']."\" readonly=\"readonly\" />";

			$tr .= "</tr>";
			$isFirst = 0;

	 	}

	 	$tr .= "<tr id=\"vergola_last_row\" >";  
		$tr .= "<td class=\"td-item\"> <input type=\"button\" class=\"save-btn\" value=\"Add Louver\" onclick=\"add_new_louver()\" />   </td>";

	}else if($section=="misc"){
	 		 	
		if($projectId==null){
	 		$fw = mysql_query("SELECT * FROM ver_vergola_default_framework_items   WHERE  framework = 'Single Bay VR1' AND LOWER(section) = 'misc'" ); // 
	 	}else{
	 		$fw = mysql_query("SELECT  i.inventoryid, q.* FROM ver_chronoforms_data_quote_vic AS q LEFT JOIN ver_chronoforms_data_inventory_vic AS i ON i.inventoryid=q.inventoryid WHERE  projectid='{$projectId}' AND LOWER(i.section) = 'misc'" ); // 
	 	}

		while ($r = mysql_fetch_assoc($fw)) { 
			$item = mysql_fetch_assoc(mysql_query("SELECT * FROM  ver_chronoforms_data_inventory_vic AS i  WHERE inventoryid='{$r["inventoryid"]}' " )); 
			
			$tr .= "<tr>"; 
			$tr .= "<td class=\"td-item\">".$item["description"]." <input type=\"hidden\" class=\"price\"  value=\"{$item['rrp']}\" category=\"{$item['category']}\" inventoryid=\"{$item['inventoryid']}\" desc=\"{$item['description']}\" /> </td>";
			$tr .= "<td> </td>"; 
			$tr .= "<td> <input type=\"hidden\" name=\"colour[]\" /> </td>";  
			$tr .= "<td> <input type=\"hidden\" name=\"finish[]\" /> </td>";   
			$tr .= "<td class=\"td-uom\"> {$item["uom"]} <input type=\"hidden\" name=\"uom[]\" value=\"{$item["uom"]}\" \> </td>";   
			$tr .= "<td class=\"td-qty\"><input type=\"text\" class=\"qtylen\" name=\"qty[]\" value=\"{$r['qty']}\"></td>";  
			 
			$tr .= "<td class=\"td-len\"><input type=\"text\"  name=\"slength[]\" class=\"input-in\" value=\"{$r['length']}\" style=\"display:none\"> </td>";  
			if(METRIC_SYSTEM=="inch"){
				$tr .= "<td class=\"td-ft\"><input type=\"text\"  class=\"input-ft\" value=\"0\" style=\"display:none\"  ></td>";  
			} 

			$tr .= "<td class=\"td-rrp\"><input type=\"text\" class=\"rrp\" readonly=\"readonly\" name=\"rrp[]\" value=\"{$r['rrp']}\"><input type=\"hidden\" class=\"cst\" name=\"cst[]\" value=\"\"></td>";  
			
			$tr .= "<input type=\"hidden\" class=\"desc\" name=\"desc[]\" value=\"".$item['description']."\" readonly=\"readonly\" />".
					"<input type=\"hidden\" class=\"invent\" name=\"invent[]\" value=\"".$item['inventoryid']."\" readonly=\"readonly\" />".
					"<input type=\"hidden\" class=\"\" name=\"is_additional[]\" value=\"".$r['is_additional']."\" readonly=\"readonly\" />";

			$tr .= "</tr>";
	 	} 

	 	$tr .= "<tr id=\"misc_last_row\" >";  
			$tr .= "<td class=\"td-item\"> <input type=\"button\" class=\"save-btn\" value=\"Add Misc\" onclick=\"add_new_misc()\" />   </td>";
			$tr .= "<td> </td>"; 
			$tr .= "<td> </td>";   
			$tr .= "<td> </td>";  
			$tr .= "<td>  </td>";  
			$tr .= "<td class=\"td-qty\"> </td>";  
			$tr .= "<td class=\"td-len\"> </td>";  
			$tr .= "<td class=\"td-rrp\"> </td>";   
	 	$tr .= "</tr>";


	}else if($section=="extras"){
	 	// error_log("SELECT  * FROM ver_chronoforms_data_quote_vic AS q LEFT JOIN ver_chronoforms_data_inventory_vic AS i ON i.inventoryid=q.inventoryid WHERE  projectid='{$projectId}' AND LOWER(i.section) = 'extras' ", 3,'/home/vergola/public_html/quote-system/my-error.log'); 
		if($projectId==null){
	 		$fw = mysql_query("SELECT * FROM ver_vergola_default_framework_items   WHERE  framework = 'Single Bay VR1' AND LOWER(i.section) = 'extras'" );  
	 	}else{
	 		$fw = mysql_query("SELECT i.inventoryid, q.* FROM ver_chronoforms_data_quote_vic AS q LEFT JOIN ver_chronoforms_data_inventory_vic AS i ON i.inventoryid=q.inventoryid WHERE  projectid='{$projectId}' AND LOWER(i.section) = 'extras' " ); // 
	 	}

		while ($r = mysql_fetch_assoc($fw)) { 
			$item = mysql_fetch_assoc(mysql_query("SELECT * FROM  ver_chronoforms_data_inventory_vic AS i  WHERE inventoryid='{$r["inventoryid"]}' " )); 
			
			$tr .= "<tr>";
			$tr .= "<td class=\"td-item\">".$item["description"]." <input type=\"hidden\" class=\"price\"  value=\"{$item['rrp']}\" category=\"{$item['category']}\" inventoryid=\"{$item['inventoryid']}\" desc=\"{$item['description']}\" /> </td>";
			$tr .= "<td> </td>";
			$tr .= "<td> <input type=\"hidden\" name=\"colour[]\" /> </td>";
			$tr .= "<td> <input type=\"hidden\" name=\"finish[]\" /> </td>";
			$tr .= "<td class=\"td-uom\"> {$item["uom"]} <input type=\"hidden\" name=\"uom[]\" value=\"{$item["uom"]}\" \> </td>";
			$tr .= "<td class=\"td-qty\"><input type=\"text\" class=\"qtylen\" name=\"qty[]\" value=\"{$r['qty']}\"></td>";
			$tr .= "<td class=\"td-len\"><input type=\"text\"  name=\"slength[]\" class=\"input-in\" value=\"{$r['length']}\" style=\"display:none\"> </td>";
			if(METRIC_SYSTEM=="inch"){
				$tr .= "<td class=\"td-ft\"><input type=\"text\"  class=\"input-ft\" value=\"0\" style=\"display:none\"  ></td>";  
			} 
			$tr .= "<td class=\"td-rrp\"><input type=\"text\" class=\"rrp\" readonly=\"readonly\" name=\"rrp[]\" value=\"{$r['rrp']}\"><input type=\"hidden\" class=\"cst\" name=\"cst[]\" value=\"\"></td>";
			
			$tr .= "<input type=\"hidden\" class=\"desc\" name=\"desc[]\" value=\"".$item['description']."\" readonly=\"readonly\" />".
					"<input type=\"hidden\" class=\"invent\" name=\"invent[]\" value=\"".$item['inventoryid']."\" readonly=\"readonly\" />".
					"<input type=\"hidden\" class=\"\" name=\"is_additional[]\" value=\"".$r['is_additional']."\" readonly=\"readonly\" />";

			$tr .= "</tr>";
	 	} 

 		$tr .= "<tr id=\"extra_last_row\" >";  
			$tr .= "<td class=\"td-item\"> <input type=\"button\" class=\"save-btn\" value=\"Add Extra\" onclick=\"add_new_extra()\" />   </td>";
			$tr .= "<td> </td>"; 
			$tr .= "<td> </td>";   
			$tr .= "<td> </td>";  
			$tr .= "<td>  </td>";  
			$tr .= "<td class=\"td-qty\"> </td>";  
			$tr .= "<td class=\"td-len\"> </td>";  
			$tr .= "<td class=\"td-rrp\"> </td>";   
	 	$tr .= "</tr>";

	}else if($section=="disbursements"){
	 	
	 	
		if($projectId==null){
	 		$fw = mysql_query("SELECT * FROM ver_vergola_default_framework_items   WHERE  framework = 'Single Bay VR1' AND LOWER(section) = 'Disbursements'" );
	 	}else{
	 		$fw = mysql_query("SELECT i.inventoryid, q.* FROM ver_chronoforms_data_quote_vic AS q LEFT JOIN ver_chronoforms_data_inventory_vic AS i ON i.inventoryid=q.inventoryid WHERE  projectid='{$projectId}' AND LOWER(i.section) = 'disbursements'" );   
	 	}

		while ($r = mysql_fetch_assoc($fw)) { 
			$item = mysql_fetch_assoc(mysql_query("SELECT * FROM  ver_chronoforms_data_inventory_vic AS i  WHERE inventoryid='{$r["inventoryid"]}' ")); 
			
			$tr .= "<tr>"; 
			$tr .= "<td class=\"td-item\">".$item["description"]." <input type=\"hidden\" class=\"price\"  value=\"{$item['rrp']}\" category=\"{$item['category']}\" inventoryid=\"{$item['inventoryid']}\" desc=\"{$item['description']}\" /> </td>";
			$tr .= "<td> </td>"; 
			$tr .= "<td> <input type=\"hidden\" name=\"colour[]\" /> </td>";  
			$tr .= "<td> <input type=\"hidden\" name=\"finish[]\" /> </td>";   
			$tr .= "<td class=\"td-uom\"> {$item["uom"]} <input type=\"hidden\" name=\"uom[]\" value=\"{$item["uom"]}\" \> </td>";  
			$tr .= "<td class=\"td-qty\"><input type=\"text\" class=\"qtylen\" name=\"qty[]\" value=\"{$r['qty']}\"></td>";  
			$tr .= "<td class=\"td-len\"><input type=\"text\"  name=\"slength[]\" class=\"input-in\" value=\"{$r['length']}\" style=\"display:none\"> </td>";  
			if(METRIC_SYSTEM=="inch"){
				$tr .= "<td class=\"td-ft\"><input type=\"text\"  class=\"input-ft\" value=\"0\" style=\"display:none\"  ></td>";  
			} 
			$tr .= "<td class=\"td-rrp\"><input type=\"text\" class=\"rrp rrp-disbursement\" readonly=\"readonly\" name=\"rrp[]\" value=\"{$r['rrp']}\"><input type=\"hidden\" class=\"cst\" name=\"cst[]\" value=\"\"></td>";  
			
			$tr .= "<input type=\"hidden\" class=\"desc\" name=\"desc[]\" value=\"".$item['description']."\" readonly=\"readonly\" />".
				   "<input type=\"hidden\" class=\"invent\" name=\"invent[]\" value=\"".$item['inventoryid']."\" readonly=\"readonly\" />".
				   "<input type=\"hidden\" class=\"\" name=\"is_additional[]\" value=\"".$r['is_additional']."\" readonly=\"readonly\" />";

			$tr .= "</tr>";
	 	}

	 	$tr .= "<tr id=\"disbursement_last_row\" >";  
			$tr .= "<td class=\"td-item\"> <input type=\"button\" class=\"save-btn\" value=\"Add Disbursement\" onclick=\"add_new_disbursement()\" />   </td>";
			$tr .= "<td> </td>"; 
			$tr .= "<td> </td>";   
			$tr .= "<td> </td>";  
			$tr .= "<td>  </td>";  
			$tr .= "<td class=\"td-qty\"> </td>";  
			$tr .= "<td class=\"td-len\"> </td>";  
			if(METRIC_SYSTEM=="inch"){
				$tr .= "<td class=\"td-ft\"> </td>";  
			} 
			$tr .= "<td class=\"td-rrp\"> </td>";   
	 	$tr .= "</tr>";
	 	 
	}     


	return $tr;

}

 

echo "<table class=\"listing-table\">";

// ***************************** Generate Framework Row ***********************************************//


// ***************************** Cbeam 200 Deep by 2.4mm ***********************************************//
echo "<tbody class=\"tbody_framework\">";
//error_log("Framework: ".$Framework, 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_sa\\my-error.log');
if($Framework != "Drop-In" ){  //$FrameworkTYP != "Drop-In"
	echo "<tr><th>Description</th><th>Webbing</th><th>Colour</th><th>Finish</th><th>UOM</th><th>QTY</th><th>Length</th><th>RRP</th></tr>";
	echo "<tr><td colspan=\"8\" class=\"subheading\">Framework</td></tr>"; 
	 
	echo generateRowItem("frame",$ProjectID);  
	  
	// ***************************** First Post 90 x 90 - 2mm Galv ********************************************//

	echo "<tr><td colspan=\"8\" class=\"subheading\">Fittings</td></tr>";
	 
	// ***************************** Fixing to Wall - Solid Brick ********************************************//
	 
	echo generateRowItem("fixings",$ProjectID); 
	 
	echo "</tbody>"; 
}

echo "<tbody class=\"tbody_non_framework\">";
// ***************************** First Standard Vergola Gutter Lip Out 200 x 200 ********************************************//
echo "<tr><th>Description</th><th>Webbing</th><th>Colour</th><th>Finish</th><th>UOM</th><th>QTY</th><th>Length</th><th>RRP</th></tr>";
	echo "<tr><td colspan=\"8\" class=\"subheading\">Gutters</td></tr>";
echo generateRowItem("guttering",$ProjectID); 
 

// ***************************** Cbeam Face Flashing Z al ********************************************//
echo "<tr><td colspan=\"8\" class=\"subheading\">Flashing</td></tr>";
 
echo generateRowItem("flashings",$ProjectID); 

 

// ***************************** Downpipe Plastic 3m ********************************************//
echo "<tr><td colspan=\"8\" class=\"subheading\">Downpipe</td></tr>";
echo generateRowItem("downpipe",$ProjectID);  

// ***************************** Louvres Poly or Square ********************************************//
echo "<tr><td colspan=\"8\" class=\"subheading\">Vergola System</td></tr>";
echo generateRowItem("vergola",$ProjectID); 
// ***************************** Opaque Enclosure ********************************************//
echo "<tr><td colspan=\"8\" class=\"subheading\">Misc Items</td></tr>";
echo generateRowItem("misc",$ProjectID); 

// ***************************** Misc Cost ********************************************//
 
// ***************************** Add Extra 1 ********************************************//
echo "<tr><td colspan=\"8\" class=\"subheading\">Extras</td></tr>";
echo generateRowItem("extras",$ProjectID); 
 
// ***************************** Shop Drawings ********************************************//
echo "<tr><td colspan=\"8\" class=\"subheading\">Disbursements</td></tr>";
echo generateRowItem("disbursements",$ProjectID); 

 
echo "</tbody>";
// End of Table
echo "</table>";



?>
