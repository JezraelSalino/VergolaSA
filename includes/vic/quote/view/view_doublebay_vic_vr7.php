<?php 
//$resultc = mysql_query("SELECT * FROM ver_chronoforms_data_clientpersonal_vic WHERE clientid  = '$QuoteID'");
$is_tender_quote=0;       
if(substr($QuoteID,0,3)=="TRV"){
	$is_tender_quote=1; 

	$sql = "SELECT * FROM ver_chronoforms_data_builderpersonal_vic WHERE tenderid  = '$QuoteID' LIMIT 1";
}else{
	$sql = "SELECT * FROM ver_chronoforms_data_clientpersonal_vic WHERE clientid  = '$QuoteID'";
}
 
$resultc = mysql_query($sql);
$retrievec = mysql_fetch_array($resultc);
if (!$resultc) {die("Error: Data not found..");}

$salesrep = $retrievec['repname']; 
$rep_id = $retrievec['repident']; 
  

if(isset($_POST['quotedate'])){ 
	$date =  $_POST['quotedate']; 
	$DateLodged = date('Y-m-d H:i:s', strtotime($date));  
}	

if((isset($_POST['update']) || isset($_POST['save_duplicate']) || isset($_POST['save-close']) || isset($_POST['save_close_duplicate'])) && isset($_POST['projectid']))
{ 
	$ProjectName = mysql_real_escape_string($_POST['projectsite']);
	//$DateLodged = $_POST['quotedate'];
	$FrameworkTYP = $_POST['frameworktype'];
	$Framework = $_POST['framework'];
	$projectid = $_POST['projectid'];
	$is_builder = 0;
	$default_color = $_POST['paintselect'];

	if(isset($_POST['is_builder']) && $_POST['is_builder']=="1"){
		$is_builder = 1;
	}

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

	mysql_query("START TRANSACTION");

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

	    $queryn = "DELETE FROM ver_chronoforms_data_quote_vic WHERE projectid = '{$projectid}'";
		$i1 = mysql_query($queryn) or trigger_error("Insert failed: " . mysql_error());
    }

	for ($i=0; $i<$cnt6; $i++) {  
		$insertArr[] = "('$QuoteID', '" . mysql_real_escape_string($_POST['invent'][$i]) . "', '{$projectid}', '$ProjectName', '$FrameworkTYP', '$Framework', '" . mysql_real_escape_string($_POST['slength'][$i]) . "', '" . mysql_real_escape_string($_POST['desc'][$i]) . "', '" . mysql_real_escape_string($_POST['colour'][$i]) . "', '" . mysql_real_escape_string($_POST['qty'][$i]) . "', '" . mysql_real_escape_string($_POST['webbing'][$i]) . "', '" . mysql_real_escape_string($_POST['finish'][$i]) . "', '" . mysql_real_escape_string($_POST['uom'][$i]) . "', '" . mysql_real_escape_string($_POST['rrp'][$i]) . "', '" . mysql_real_escape_string($_POST['cst'][$i]) . "', '" . mysql_real_escape_string($_POST['is_additional'][$i]) . "')";
	}

	$queryn = "INSERT INTO ver_chronoforms_data_quote_vic (quoteid, inventoryid, projectid, project_name, framework_type, framework, length, description, colour, qty, webbing, finish, uom, rrp, cost, is_additional) VALUES " . implode(", ", $insertArr);
	//error_log($queryn, 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_vic\\my-error.log'); //exit();
	$i2 = mysql_query($queryn) or trigger_error("Insert failed: " . mysql_error());
 
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
	$SalesComm = $_POST['com_sales_commission'];
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
		$i3 = 1;
	}else{   
		$queryp = "DELETE FROM ver_chronoforms_data_followup_vic WHERE projectid='{$projectid}'";  
		$i3 = mysql_query($queryp) or trigger_error("Insert failed: " . mysql_error()); 
	}

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
	 
	//error_log($queryp, 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_vic\\my-error.log'); 
	$i4 = mysql_query($queryp) or trigger_error("Insert failed: " . mysql_error());
	 
	$Bay = "";
	$cnt = count($_POST['dblength']);
	$cnt2 = count($_POST['dbwidth']);
 
    $insertArr = array();

	if($is_create_duplicate==1){
			//$projectid 
		$i5 = 1;
	}else{  	
	    $queryp = "DELETE FROM ver_chronoforms_data_measurement_vic WHERE projectid='{$projectid}'";  
		$i5 = mysql_query($queryp) or trigger_error("Insert failed: " . mysql_error());
    }

	for ($i=0; $i<$cnt; $i++) { 
		$insertArr[] = "('{$projectid}', '$FrameworkTYP', '" . mysql_real_escape_string($_POST['dbwidth'][0]) . "', '" . mysql_real_escape_string($_POST['dblength'][$i]) . "', '$Bay')";
	}

	$querym = "INSERT INTO ver_chronoforms_data_measurement_vic (projectid, framework_type, width, length, bay) VALUES " . implode(", ", $insertArr); 
	//error_log($querym, 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_vic\\my-error.log');
	$i6 = mysql_query($querym) or trigger_error("Insert failed: " . mysql_error()); 
	    

	if ($i1 && $i2 && $i3 && $i4 && $i5 && $i6) {
		//Save the quotation report
		mysql_query("COMMIT");
	    $db_result = 1;    
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
			exit();	
		}else{ 
			header('Location:'.JURI::base().'view-quote-vic?projectid='.$projectid); 
		}     
		//header('Location:'.JURI::base().'view-quote-vic?projectid='.$getprojectid);
		if($is_create_duplicate==1){
			header('Location:'.JURI::base().'view-quote-vic?projectid='.$projectid);
			exit();	
		}
	}else{
		mysql_query("ROLLBACK");
	    $db_result = 0;
	    //error_log("DB Failed: i1:".$i1 .' i2:'. $i2 .' i3:'. $i3 .' i4:'. $i4 .' i5:'. $i5, 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_vic\\my-error.log');

	    $note = array();
	    $note['content'] = "Error while saving Client ID: {$clientid} Project ID: {$projectid} ";

	}

	


	$ProjectID = $projectid;
	$Framework = $FrameworkTYP;	
	$ProjectName = stripslashes($ProjectName);
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
	//error_log($sql, 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_vic\\my-error.log'); 		 
	  
}

 
function generateRowItemVR5($section,$projectId=null){
	$tr = ""; 

	if($section=="frame"){  
		$k=1;
	 	$fw = mysql_query("SELECT  i.inventoryid, q.* FROM ver_chronoforms_data_quote_vic AS q LEFT JOIN ver_chronoforms_data_inventory_vic AS i ON i.inventoryid=q.inventoryid WHERE projectid='{$projectId}'  AND (LOWER(i.section) = 'frame' OR  LOWER(i.section) = 'posts')   " ); // 
	  
		//error_log("SELECT  * FROM ver_chronoforms_data_quote_vic AS q LEFT JOIN ver_chronoforms_data_inventory_vic AS i ON i.inventoryid=q.inventoryid WHERE projectid='{$projectId}'  AND LOWER(i.section) = 'frame'  ORDER BY FIELD(i.category, 'Beams', 'Beam Fixings', 'Posts') " , 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_sa\\my-error.log');
		$isFirst = 1;$isSecond = 0;$isThird = 0;$isFourth = 0;//should be in order based on the list from the pulled record from database, beam(L), beam(L[2nd]), 
		while ($r = mysql_fetch_assoc($fw)) { 
			//error_log(print_r($r,true), 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_sa\\my-error.log'); 
			$item = mysql_fetch_assoc(mysql_query("SELECT * FROM  ver_chronoforms_data_inventory_vic AS i  WHERE inventoryid='{$r["inventoryid"]}'" ));
			//error_log(print_r($r,true), 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_sa\\my-error.log'); 
			$tr .= "<tr>"; 
					  
					$lw = ""; 
					if($isFirst==1){$lw = "length";  $isSecond=1; }
					else if($isSecond==1){$lw = "width"; $isSecond=0; $isThird=1; }
					else if($isThird==1){$lw = "length"; $isThird=0; $isFourth=1; }
					else{$lw = "length";} 
					 
					//error_log($item["section"], 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_sa\\my-error.log');
					if(strtolower($item["section"])=="frame" && (strtolower($item["category"])=="beams" || strtolower($item["category"])=="posts" || strtolower($item["category"])=="beam fixings" ||  strtolower($item["category"])=="intermediate")){ 
						$tr .= "<td class=\"td-item\">".listItem(strtolower($item["section"]),$item,strtolower($item["category"]))." <input type=\"hidden\" class=\"price\" value=\"{$item['rrp']}\" category=\"{$item['category']}\"  inventoryid=\"{$item['inventoryid']}\" desc=\"{$item['description']}\" /> </td>";
						if(strtolower($item["category"])=="posts" || strtolower($item["category"])=="beam fixings"){
							$tr .= "<td> <input type=\"hidden\" name=\"webbing[]\" /> </td>"; 
						}
						else{
							$tr .= "<td class=\"td-webbing\">".listWebbing2("",$r['webbing'])."</td>"; 
						}

						if( $k>5){
							$tr .= "<td> </td>";
						}else if($k==6){
							$tr .= "<td>HERE</td>";
							error_log(" colour:".listColours2("",$r['colour']), 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_sa\\my-error.log');
						}else{
							$tr .= "<td>".listColours2("",$r['colour'])."</td>";
						}
						
						
						$tr .= "<td class=\"td-finish-color\">".listColourBond2(null,$r['finish'])."</td>";  
						$tr .= "<td class=\"td-uom\">{$item["uom"]} <input type=\"hidden\" name=\"uom[]\" value=\"{$item["uom"]}\" \> </td>";  
						$tr .= "<td class=\"td-qty\"><input type=\"text\" class=\"qtylen\" name=\"qty[]\" value=\"{$r['qty']}\"></td>";  
						//$tr .= "<td class=\"td-len\"><input type=\"text\"  name=\"slength[]\" class=\"{$lw}\" value=\"{$r['length']}\"></td>";  
						if(strtolower($item["category"]) == "beams" && $isFirst ==1 ){ 
							$tr .= "<td class=\"td-len\"><input type=\"text\"  id=\"cbeam_length\" name=\"slength[]\" class=\"input-size input-in\" value=\"{$r['length']}\"></td>";  
							if(METRIC_SYSTEM=="inch"){
								$tr .= "<td class=\"td-ft\"><input type=\"text\"  id=\"cbeam_length_ft\"  class=\"input-size input-ft\" value=\"".get_feet_value($r['length'])."\"></td>";
							}	
							$isFirst = 0;
						}else if($isSecond ==1 ){ 
							$tr .= "<td class=\"td-len\"><input type=\"text\"  name=\"slength[]\" class=\"{$lw} input-size input-in\" value=\"{$r['length']}\"></td>"; 
							if(METRIC_SYSTEM=="inch"){
								$tr .= "<td class=\"td-ft\"><input type=\"text\"   class=\"{$lw} input-size input-ft\" value=\"".get_feet_value($r['length'])."\"></td>";
							} 
							$isFirst = 0;
						}else if($isThird ==1 || strtolower($item["category"])=="intermediate"){ 
							$tr .= "<td class=\"td-len\"><input type=\"text\"  name=\"slength[]\" class=\"input-size width input-in\" value=\"{$r['length']}\"></td>";
							if(METRIC_SYSTEM=="inch"){
								$tr .= "<td class=\"td-ft\"><input type=\"text\"   class=\"input-size width input-ft\" value=\"".get_feet_value($r['length'])."\"></td>";
							}	
						}else if($item["category"] == "Posts"){ //IRV15 = post 90 x 90
							$tr .= "<td class=\"td-len\"><input type=\"text\"  name=\"slength[]\" class=\"input-size input-in\" value=\"{$r['length']}\"></td>";  
							if(METRIC_SYSTEM=="inch"){
								$tr .= "<td class=\"td-ft\"><input type=\"text\"  class=\"input-size input-ft\" value=\"".get_feet_value($r['length'])."\"></td>";  
							}	
						}else if(strtolower($item["category"])=="beam fixings"){ //IRV15 = post 90 x 90
							$tr .= "<td class=\"td-len\"><input type=\"text\"  name=\"slength[]\" class=\"input-size input-in\" value=\"{$r['length']}\" style=\"display:none\" ></td>";  
							if(METRIC_SYSTEM=="inch"){
								$tr .= "<td class=\"td-ft\"><input type=\"text\"   class=\"input-size input-ft\" value=\"".get_feet_value($r['length'])."\" style=\"display:none\" ></td>";  
							}	
						}else{
							$tr .= "<td class=\"td-len\"><input type=\"text\"  name=\"slength[]\" class=\"".($r['is_additional']=="1"?"":$lw)." input-size input-in\" value=\"{$r['length']}\"></td>";  
							if(METRIC_SYSTEM=="inch"){
								$tr .= "<td class=\"td-ft\"><input type=\"text\" class=\"".($r['is_additional']=="1"?"":$lw)." input-size input-ft\" value=\"".get_feet_value($r['length'])."\"></td>";  
							}	
						}
						$tr .= "<td class=\"td-rrp\"><input type=\"text\" class=\"rrp\" readonly=\"readonly\" name=\"rrp[]\" value=\"{$r['rrp']}\"> </td>";  

					}else{
						$tr .= "<td class=\"td-item\">".$item["description"]." <input type=\"hidden\" class=\"price\" value=\"{$item['rrp']}\" desc=\"{$item['description']}\" /> </td>";
						$tr .= "<td> <input type=\"hidden\" name=\"webbing[]\" /> </td>"; 
						$tr .= "<td> <input type=\"hidden\" name=\"colour[]\" /> </td>";  
						$tr .= "<td> <input type=\"hidden\" name=\"finish[]\" /> </td>";   
						$tr .= "<td  class=\"td-uom\"> {$item["uom"]} <input type=\"hidden\" name=\"uom[]\" value=\"{$item["uom"]}\" \> </td>";  
						$tr .= "<td class=\"td-qty\"><input type=\"text\" class=\"qtylen\" name=\"qty[]\" value=\"{$r['qty']}\"></td>";  
						  
						$tr .= "<td class=\"td-len\"><input type=\"text\"  name=\"slength[]\" class=\"length input-in\" value=\"1\" style=\"display:none\"></td>"; 
						if(METRIC_SYSTEM=="inch"){
							$tr .= "<td class=\"td-ft\"><input type=\"text\"    class=\"length input-ft\" value=\"1\" style=\"display:none\"></td>"; 
						} 	
						 
						$tr .= "<td class=\"td-rrp\"><input type=\"text\" class=\"rrp\" readonly=\"readonly\" name=\"rrp[]\" value=\"{$r['rrp']}\"> </td>";  
					}

					if($isFirst==1){
						$isFirst=0;
						$isSecond = 1;
					} 

					$tr .= "<input type=\"hidden\" class=\"desc\" name=\"desc[]\" value=\"".$item['description']."\" readonly=\"readonly\" />".
					       "<input type=\"hidden\" class=\"invent\" name=\"invent[]\" value=\"".$item['inventoryid']."\" readonly=\"readonly\" />".
					       "<input type=\"hidden\" class=\"\" name=\"is_additional[]\" value=\"".$r['is_additional']."\" readonly=\"readonly\" />";
					
		   	$tr .= "</tr>"; 
		   	$k++;
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
	 	 
	 	$sql = "SELECT  i.inventoryid, q.* FROM ver_chronoforms_data_quote_vic AS q LEFT JOIN ver_chronoforms_data_inventory_vic AS i ON i.inventoryid=q.inventoryid WHERE projectid='{$projectId}' AND LOWER(i.section) = 'fixings' "; 
	 	$fw = mysql_query($sql); 

		while ($r = mysql_fetch_assoc($fw)) { 
			$item = mysql_fetch_assoc(mysql_query("SELECT * FROM  ver_chronoforms_data_inventory_vic AS i  WHERE inventoryid='{$r["inventoryid"]}' " )); 
			//error_log(print_r($r,true), 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_vic\\my-error.log'); 
			
			$tr .= "<tr>"; 
 
			$tr .= "<td class=\"td-item\">".$item["description"]." <input type=\"hidden\" class=\"price\" value=\"{$item['rrp']}\" category=\"{$item['category']}\" inventoryid=\"{$item['inventoryid']}\" desc=\"{$item['description']}\" /> </td>";
			$tr .= "<td> </td>"; 
			$tr .= "<td> <input type=\"hidden\" name=\"colour[]\" /> </td>";  
			$tr .= "<td> <input type=\"hidden\" name=\"finish[]\" /> </td>";   
			$tr .= "<td class=\"td-uom\"> {$item["uom"]} <input type=\"hidden\" name=\"uom[]\" value=\"{$item["uom"]}\" \> </td>";  
			$tr .= "<td class=\"td-qty\"><input type=\"text\" class=\"qtylen\" name=\"qty[]\" value=\"{$r['qty']}\"></td>";  
			$tr .= "<td class=\"td-len\"><input type=\"text\"  name=\"slength[]\" class=\"input-in\" value=\"{$r['length']}\" style=\"display:none\"> </td>";  
			if(METRIC_SYSTEM=="inch"){
				$tr .= "<td class=\"td-ft\"><input type=\"text\"  class=\"input-ft\" value=\"".get_feet_value($r['length'])."\" style=\"display:none\"> </td>";  
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
	 	 
	 	$fw = mysql_query("SELECT  i.inventoryid, q.* FROM ver_chronoforms_data_quote_vic AS q LEFT JOIN ver_chronoforms_data_inventory_vic AS i ON i.inventoryid=q.inventoryid WHERE projectid='{$projectId}' AND LOWER(i.section) = 'guttering' " ); // 
	 	 
		$isFirst = 1;$isSecond = 0;$isThird = 0;$isFourth = 0;//should be in order based on the list from the pulled record from database, beam(L), beam(L[2nd]), 
		$_isFirst = 1; 

		while ($r = mysql_fetch_assoc($fw)) { 
			$item = mysql_fetch_assoc(mysql_query("SELECT * FROM  ver_chronoforms_data_inventory_vic AS i  WHERE inventoryid='{$r["inventoryid"]}' " )); 
			
			//error_log("inventoryid: ".$r["inventoryid"]." length: ".$r["length"]." rrp: ".$r["rrp"], 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_vic\\my-error.log');

			$tr .= "<tr>"; 
					$lw = "";  

					if($isFirst==1){$lw = "width"; $isFirst=0; $isSecond=1; }
					else if($isSecond==1){$lw = "width"; $isSecond=0; $isThird=1; } 
					else if($isThird==1){$lw = "width"; $isThird=0; $isFourth=1; }
					else if($isFourth==1){$lw = "width"; $isFourth=0;   }
					 
					$tr .= "<td class=\"td-item\">".listItem("guttering",$item)." <input type=\"hidden\" class=\"price\" value=\"{$item['rrp']}\"  category=\"{$item['category']}\" inventoryid=\"{$item['inventoryid']}\" desc=\"{$item['description']}\"  /> </td>";
					$tr .= "<td></td>"; 
					$tr .= "<td>".listColours2("",$r['colour'])."</td>";   
					$tr .= "<td class=\"td-finish-color\">".listColourBond(null,$r,"Guttering")."</td>";  
					$tr .= "<td class=\"td-uom\">{$item["uom"]} <input type=\"hidden\" name=\"uom[]\" value=\"{$item["uom"]}\" \> </td>";  
					
					if($item["inventoryid"] == "IRV31"){ 
						$tr .= "<td class=\"td-qty\"><input type=\"text\" class=\"qtylen\" name=\"qty[]\" value=\"{$r['qty']}\"></td>";
					}else{
						$tr .= "<td class=\"td-qty\"><input type=\"text\" class=\"qtylen gutter-qty\" name=\"qty[]\" value=\"{$r['qty']}\"></td>";
					}	

					if($item["inventoryid"] == "" && $isSecond==1){ 
						$tr .= "<td class=\"td-len\"><input type=\"text\"  id=\"IRV27_length\" name=\"slength[]\" class=\"input-in gutter-length\" value=\"0\" ></td>";  
						if(METRIC_SYSTEM=="inch"){
							$tr .= "<td class=\"td-ft\"><input type=\"text\"  id=\"IRV27_length_ft\"   class=\"input-ft gutter-length\" value=\"0\" ></td>";
						}	
					}else if($item["inventoryid"] == "IRV29" || $item["inventoryid"] == "IRV30"){ 
						//$tr .= "<td class=\"td-len\"><input type=\"text\"   name=\"slength[]\" class=\"tapered_gutter_IRV29_30_length\" value=\"0\"></td>";  
						if($_isFirst == 1){ 
							$tr .= "<td class=\"td-len\"><input type=\"text\"   name=\"slength[]\" class=\"length input-in gutter-length\" value=\"{$r['length']}\"></td>"; //tapered_gutter_IRV29_30_length 
							if(METRIC_SYSTEM=="inch"){
								$tr .= "<td class=\"td-ft\"><input type=\"text\" class=\"length input-ft gutter-length\" value=\"".get_feet_value($r['length'])."\"></td>";
							}

							$_isFirst = 0;
						}else{

							$tr .= "<td class=\"td-len\"><input type=\"text\"   name=\"slength[]\" class=\"length2 input-in gutter-length\" value=\"{$r['length']}\"></td>";  //tapered_gutter_IRV29_30_length
							if(METRIC_SYSTEM=="inch"){
								$tr .= "<td class=\"td-ft\"><input type=\"text\"    class=\"length2 input-ft gutter-length\" value=\"".get_feet_value($r['length'])."\"></td>"; 
							}
							$_isFirst = 1;
						}
					}else if($item["inventoryid"] == "IRV31"){ 
						$tr .= "<td class=\"td-len\"><input type=\"text\"  id=\"gutterLiningLength\" name=\"slength[]\" class=\"input-in\" value=\"{$r['length']}\"></td>";  
						if(METRIC_SYSTEM=="inch"){
							$tr .= "<td class=\"td-ft\"><input type=\"text\"  id=\"gutterLiningLength_ft\" class=\"input-ft\" value=\"".get_feet_value($r['length'])."\"></td>";  
						}
					}else{
						$tr .= "<td class=\"td-len\"><input type=\"text\"  name=\"slength[]\" class=\"".($r['is_additional']=="1"?"":$lw)." gutter-length input-in\" value=\"{$r['length']}\"></td>";
						if(METRIC_SYSTEM=="inch"){
							$tr .= "<td class=\"td-ft\"><input type=\"text\"  class=\"".($r['is_additional']=="1"?"":$lw)." gutter-length input-ft\" value=\"".get_feet_value($r['length'])."\"></td>";
						}
					}

					//$tr .= "<td class=\"td-len\"><input type=\"text\"  name=\"slength[]\" class=\"{$lw}\" value=\"{$r['length']}\"></td>";  
					$tr .= "<td class=\"td-rrp\"><input type=\"text\" class=\"rrp\" readonly=\"readonly\" name=\"rrp[]\" value=\"{$r['rrp']}\"><input type=\"hidden\" class=\"cst\" name=\"cst[]\" value=\"\"></td>";  
 
					$tr .= "<input type=\"hidden\" class=\"desc\" name=\"desc[]\" value=\"".$item['description']."\" readonly=\"readonly\" />".
							"<input type=\"hidden\" class=\"invent\" name=\"invent[]\" value=\"".$item['inventoryid']."\" readonly=\"readonly\" />".
					       "<input type=\"hidden\" class=\"\" name=\"is_additional[]\" value=\"".$r['is_additional']."\" readonly=\"readonly\" />";		
		   	$tr .= "</tr>";
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
	 	 
	 	$fw = mysql_query("SELECT  i.inventoryid, q.* FROM ver_chronoforms_data_quote_vic AS q LEFT JOIN ver_chronoforms_data_inventory_vic AS i ON i.inventoryid=q.inventoryid WHERE projectid='{$projectId}' AND LOWER(i.section) = 'flashings'  " ); // 
	  
	 	$isFirst = 1; $isSecond = 0; $isThird=0;$isFourth=0; $isFirst_IRV44=1;
	 	
		while ($r = mysql_fetch_assoc($fw)) { 
			$item = mysql_fetch_assoc(mysql_query("SELECT * FROM  ver_chronoforms_data_inventory_vic AS i  WHERE inventoryid='{$r["inventoryid"]}' " )); 
			
			if($isFirst==1){$lw = ""; $isFirst=0; $isSecond=1; }
			else if($isSecond==1){$lw = ""; $isSecond=0; $isThird=1; } 
			else if($isThird==1){$lw = ""; $isThird=0; $isFourth=1; }
			else if($isFourth==1){$lw = ""; $isFourth=0; $isFifth=1;   }
			else if($isFifth==1){$lw = ""; $isFifth=0; $isSixth=1;   }
			else if($isSixth==1){$lw = ""; $isSixth=0; $isSeventh=1;   }
			else if($isSeventh==1){$lw = ""; $isSeventh=0;   }

			$tr .= "<tr>"; 
					 
					$tr .= "<td class=\"td-item\"> {$item['description']} <input type=\"hidden\" class=\"price\" value=\"{$item['rrp']}\" category=\"{$item['category']}\" inventoryid=\"{$item['inventoryid']}\" desc=\"{$item['description']}\" /> </td>";
					$tr .= "<td></td>"; 
					$tr .= "<td>".listColours2("",$r['colour'])."</td>";   
					$tr .= "<td class=\"td-finish-color\">".listColourBond(null,$r,"Guttering")."</td>";  
					$tr .= "<td class=\"td-uom\">{$item["uom"]} <input type=\"hidden\" name=\"uom[]\" value=\"{$item["uom"]}\" \> </td>";  
					$tr .= "<td class=\"td-qty\"><input type=\"text\" class=\"qtylen\" name=\"qty[]\" value=\"{$r['qty']}\"></td>";  
					//$tr .= "<td class=\"td-len\"><input type=\"text\"  name=\"slength[]\" class=\"length\" value=\"{$r['length']}\"></td>";  
					if($r['is_additional']==1){
						//error_log("is_additional cf_id :" . $item['cf_id'], 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_vic\\my-error.log');
						$tr .= "<td class=\"td-len\"><input type=\"text\"  name=\"slength[]\" class=\"input-in\" value=\"{$r['length']}\"></td>"; 
						if(METRIC_SYSTEM=="inch"){
							$tr .= "<td class=\"td-ft\"><input type=\"text\"  class=\"input-ft\" value=\"".get_feet_value($r['length'])."\"></td>";
						}
					
					}else if($isSecond == 1 || $isThird == 1 || $isFourth == 1){ //($item["inventoryid"]=="IRV43" || $item["inventoryid"]=="IRV46" )  && 
						$input_id="";
						//if($item["inventoryid"]=="IRV43"){
							//$input_id="IRV43_length";
						// }else if($item["inventoryid"]=="IRV46"){
						// 	$input_id="IRV46_length";
						// }  
						if($isSecond){
							$tr .= "<td class=\"td-len\"><input type=\"text\"  name=\"slength[]\" class=\"length input-in\" value=\"{$r['length']}\" ></td>"; //id=\"{$input_id}\"
							if(METRIC_SYSTEM=="inch"){
								 $tr .= "<td class=\"td-ft\"><input type=\"text\"  class=\"length input-ft\" value=\"".get_feet_value($r['length'])."\" ></td>";
							}
						}else if($isThird){
							$tr .= "<td class=\"td-len\"><input type=\"text\"  name=\"slength[]\" class=\"length2 input-in\" value=\"{$r['length']}\" ></td>"; //id=\"{$input_id}\"
							if(METRIC_SYSTEM=="inch"){
								$tr .= "<td class=\"td-ft\"><input type=\"text\"  class=\"length2 input-ft\" value=\"".get_feet_value($r['length'])."\" ></td>";  
							}
						}else if($isFourth){
							$tr .= "<td class=\"td-len\"><input type=\"text\"  name=\"slength[]\" class=\"width input-in\" value=\"{$r['length']}\" ></td>"; //id=\"{$input_id}\"
							if(METRIC_SYSTEM=="inch"){
								 $tr .= "<td class=\"td-ft\"><input type=\"text\"   class=\"width input-ft\" value=\"".get_feet_value($r['length'])."\" ></td>";
							}
						}
						
						 

					}else if($item["inventoryid"]=="IRV44" ){ //error_log("2nd", 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_vic\\my-error.log');
						if($isFirst_IRV44){
							$tr .= "<td class=\"td-len\"><input id=\"IRV44_l1\" type=\"text\"  name=\"slength[]\" class=\"input-in\" value=\"{$r['length']}\"></td>";	
							if(METRIC_SYSTEM=="inch"){
								$tr .= "<td class=\"td-ft\"><input id=\"IRV44_l1_ft\" type=\"text\"   class=\"input-ft\" value=\"".get_feet_value($r['length'])."\"></td>"; 
							}					 
					 	}else{
					 		$tr .= "<td class=\"td-len\"><input id=\"IRV44_l2\" type=\"text\"  name=\"slength[]\" class=\"input-in\" value=\"{$r['length']}\"></td>";						 
					 		if(METRIC_SYSTEM=="inch"){
								$tr .= "<td class=\"td-ft\"><input id=\"IRV44_l2_ft\" type=\"text\"    class=\"input-ft\" value=\"".get_feet_value($r['length'])."\"></td>"; 
							}
					 	}

					 	$isFirst_IRV44 = 0;
					}else if($item["inventoryid"]=="IRV45"  ){ 
						$tr .= "<td class=\"td-len\"><input type=\"text\"  name=\"slength[]\" class=\"input-in\" value=\"{$r['length']}\" id=\"IRV45_length\"></td>";
						if(METRIC_SYSTEM=="inch"){
							$tr .= "<td class=\"td-ft\"><input type=\"text\"   class=\"input-ft\" value=\"".get_feet_value($r['length'])."\" id=\"IRV45_length_ft\"></td>";	 
						}
				 		$isFirst = 1; //set it back to equal 1 for IRV46 as 1st item.

					}else if(($item["inventoryid"]=="IRV43" || $item["inventoryid"]=="IRV46" )   || $item["inventoryid"]=="IRV47" ){ //error_log("2nd", 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_vic\\my-error.log');
						$input_id="";
						if($item["inventoryid"]=="IRV47"){
							$input_id="IRV47_length"; 
						} 
						$tr .= "<td class=\"td-len\"><input type=\"text\"  name=\"slength[]\" class=\"width input-in\" value=\"{$r['length']}\" id=\"{$input_id}\"></td>";
						if(METRIC_SYSTEM=="inch"){
								$tr .= "<td class=\"td-ft\"><input type=\"text\"  class=\"width input-ft\" value=\"".get_feet_value($r['length'])."\" id=\"{$input_id}_ft\"></td>";		 
						}						 
						  
					}else{
						//error_log("here", 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_vic\\my-error.log');
						$tr .= "<td class=\"td-len\"><input type=\"text\"  name=\"slength[]\" class=\"length input-in\" value=\"{$r['length']}\"></td>";
						if(METRIC_SYSTEM=="inch"){
								$tr .= "<td class=\"td-ft\"><input type=\"text\"  class=\"length input-ft\" value=\"".get_feet_value($r['length'])."\"></td>";
						} 
					}

					$tr .= "<td class=\"td-rrp\"><input type=\"text\" class=\"rrp\" readonly=\"readonly\" name=\"rrp[]\" value=\"{$r['rrp']}\"> </td>";  
  
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
	 	 
	 	$fw = mysql_query("SELECT  i.inventoryid, q.* FROM ver_chronoforms_data_quote_vic AS q LEFT JOIN ver_chronoforms_data_inventory_vic AS i ON i.inventoryid=q.inventoryid WHERE projectid='{$projectId}' AND LOWER(i.section) = 'downpipe' " ); // 
	 	 

		while ($r = mysql_fetch_assoc($fw)) { 
			$item = mysql_fetch_assoc(mysql_query("SELECT * FROM  ver_chronoforms_data_inventory_vic AS i  WHERE inventoryid='{$r["inventoryid"]}' " )); 
			
			$tr .= "<tr>"; 
				$tr .= "<td class=\"td-item\">".addslashes($item["description"])." <input type=\"hidden\" class=\"price\" value=\"{$item['rrp']}\" category=\"{$item['category']}\" inventoryid=\"{$item['inventoryid']}\" desc=\"".addslashes($item["description"])."\" /> </td>";
				$tr .= "<td> </td>"; 
				$tr .= "<td> <input type=\"hidden\" name=\"colour[]\" /> </td>";  
				$tr .= "<td> <input type=\"hidden\" name=\"finish[]\" /> </td>";   
				$tr .= "<td class=\"td-uom\"> {$item["uom"]} <input type=\"hidden\" name=\"uom[]\" value=\"{$item["uom"]}\" \> </td>";  
				$tr .= "<td class=\"td-qty\"><input type=\"text\" class=\"qtylen\" name=\"qty[]\" value=\"{$r['qty']}\"></td>";  
				$tr .= "<td class=\"td-len\"><input type=\"text\"  name=\"slength[]\" class=\"input-in\" value=\"{$r['length']}\" style=\"display:none\"> </td>";  
				if(METRIC_SYSTEM=="inch"){
					$tr .= "<td class=\"td-ft\"><input type=\"text\"   class=\"input-ft\" value=\"".get_feet_value($r['length'])."\" style=\"display:none\"> </td>";  
				}	
				$tr .= "<td class=\"td-rrp\"><input type=\"text\" class=\"rrp\" readonly=\"readonly\" name=\"rrp[]\" value=\"{$r['rrp']}\"> </td>";  

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
	 	 
	 	$fw = mysql_query("SELECT i.inventoryid, q.* FROM ver_chronoforms_data_quote_vic AS q LEFT JOIN ver_chronoforms_data_inventory_vic AS i ON i.inventoryid=q.inventoryid WHERE projectid='{$projectId}' AND LOWER(i.section) = 'vergola' " ); // 
	 	  
	 	$isFirst = 1; $isSecond = 0; $isSecond2=0; $isSecond3=0; $isThird = 0;$isFourth = 0; $isFifth = 0; $isFifth2=0; $isSixth=0; $isSeventh=0; $isEighth=0;
		$colorSelection = ""; $listColourBondSelection = "";  $tr_index = 0;

		while ($r = mysql_fetch_assoc($fw)) { 
			$item = mysql_fetch_assoc(mysql_query("SELECT * FROM  ver_chronoforms_data_inventory_vic AS i  WHERE inventoryid='{$r["inventoryid"]}' " )); 

			if(strtolower($item["category"])=="louvers"){  
				$tr_index++;
			}
 
			$itemName = ""; $lengthInput = ""; $itemLen_ft = ""; $lengthInput_ft = "";
			$itemQty = "";
			$itemLen = "";
			if($isFirst==1){  
				$colorSelection = listColours2("",$r['colour']);
				$listColourBondSelection = listColourBond(null,$r,"Vergola");
				$itemQty = 'id="louvres-qty-1"'; //1st Louvres Poly in ever meter.
				$itemLen = 'id="louvres-len-1"'; 
 

			}else if($isSecond==1){  
				$colorSelection = listColours2("",$r['colour']);
				$listColourBondSelection = listColourBond(null,$r,"Vergola");
				$itemQty = 'id="louvres-qty-2"'; //2nd Louvres Poly in ever meter.
				$itemLen = 'id="louvres-len-2"';  
 
			}else if($isSecond2==1){  
				$colorSelection = listColours2("",$r['colour']);
				$listColourBondSelection = listColourBond(null,$r,"Vergola");
				$itemQty = 'id="louvres-qty-3"'; //2nd Louvres Poly in ever meter.
				$itemLen = 'id="louvres-len-3"';  
 
			}else if($isSecond3==1){  
				$colorSelection = listColours2("",$r['colour']);
				$listColourBondSelection = listColourBond(null,$r,"Vergola");
				$itemQty = 'id="louvres-qty-4"'; //2nd Louvres Poly in ever meter.
				$itemLen = 'id="louvres-len-4"';  
 
			}else if($isThird==1){ 
				$isThird=0; $isFourth=1; 
				$colorSelection = listColours2("",$r['colour'],"vergola-colour");
				$listColourBondSelection = listColourBond(null,$r,"Vergola");
				 
			}else if($isFourth==1){ 
				$isFourth=0; $isFifth=1;
				$colorSelection = listColours2("",$r['colour'],"vergola-colour");
				$listColourBondSelection = listColourBond(null,$r,"Vergola");

				$itemQty = 'id="pivot-qty-1"'; // 1st Pivot strip 
				$itemLen = 'id="pivot-len-1"'; 

			}else if($isFifth==1){ 
				$isFifth=0; $isFifth2=1;   
				$colorSelection = listColours2("",$r['colour'],"vergola-colour");
				$listColourBondSelection = listColourBond(null,$r,"Vergola");

				$itemQty = 'id="pivot-qty-2"'; // 2nd Pivot strip 
				$itemLen = 'id="pivot-len-2"'; 
			}else if($isFifth2==1){ 
				$isFifth2=0;  $isFifth3=1;
				$colorSelection = listColours2("",$r['colour'],"vergola-colour");
				$listColourBondSelection = listColourBond(null,$r,"Vergola");

				$itemQty = 'id="pivot-qty-3"'; // 2nd Pivot strip 
				$itemLen = 'id="pivot-len-3"'; 
			}else if($isFifth3==1){ 
				$isFifth3=0;  $isSixth=1;
				$colorSelection = listColours2("",$r['colour'],"vergola-colour");
				$listColourBondSelection = listColourBond(null,$r,"Vergola");

				$itemQty = 'id="pivot-qty-4"'; // 2nd Pivot strip 
				$itemLen = 'id="pivot-len-4"'; 
			}else if($isSixth==1){ 
				$isSixth=0;  $isSeventh=1;
				$colorSelection = "<input type=\"hidden\" name=\"colour[]\" />";
				$listColourBondSelection = "<input type=\"hidden\" name=\"finish[]\" />"; 
 
			}else if($r["is_additional"]==1){  
				$colorSelection = listColours2("",$r['colour'],"vergola-colour");
				$listColourBondSelection = listColourBond(null,$r,"Vergola");
 
			}else{
				$colorSelection = "<input type=\"hidden\" name=\"colour[]\" />";
				$listColourBondSelection = "<input type=\"hidden\" name=\"finish[]\" />"; 
			}

			
			if($item["inventoryid"]=="IRV54" || $item["inventoryid"]=="IRV55"){ //5 Louvres Poly in ever meter.
			
			}else if($item["inventoryid"]=="IRV58"){ //2 Endcap  
				$itemQty = 'id="endcap-qty"';
				$itemLen = 'id="endcap-len"'; 
			}else if($item["inventoryid"]=="IRV59"){ //  Pivot strip 
				
			}else if($item["inventoryid"]=="IRV60" && $isSeventh==1){ //  Link Bar 
				$isSeventh=0; $isEighth=1;

				$colorSelection = listColours2("",$r['colour'],"vergola-colour");
				$listColourBondSelection = listColourBond(null,$r,"Vergola");
				$itemQty = 'id="linkBar-qty-1"';
				$itemLen = 'id="linkBar-len-1"';

			}else if($item["inventoryid"]=="IRV60" && $isEighth==1){ //  Link Bar 
				$isEighth=0; $isEighth2=1;

				$colorSelection = listColours2("",$r['colour'],"vergola-colour");
				$listColourBondSelection = listColourBond(null,$r,"Vergola");
				$itemQty = 'id="linkBar-qty-2"';
				$itemLen = 'id="linkBar-len-2"';

			}else if($item["inventoryid"]=="IRV60" && $isEighth2==1){ //  Link Bar 
				$isEighth2=0; $isEighth3=1;

				$colorSelection = listColours2("",$r['colour'],"vergola-colour");
				$listColourBondSelection = listColourBond(null,$r,"Vergola");
				$itemQty = 'id="linkBar-qty-3"';
				$itemLen = 'id="linkBar-len-3"';

			}else if($item["inventoryid"]=="IRV60" && $isEighth3==1){ //  Link Bar 
				$isEighth3=0;  

				$colorSelection = listColours2("",$r['colour'],"vergola-colour");
				$listColourBondSelection = listColourBond(null,$r,"Vergola");
				$itemQty = 'id="linkBar-qty-4"';
				$itemLen = 'id="linkBar-len-4"';

			}

			
			if($isFirst || $isSecond || $isSecond2 || $isSecond3){
				$itemName = listItem("louvres",$r,null,"poly".($isFirst?"1":($isSecond?"2":($isSecond2?"3":($isSecond3?"4":"")))));
				$lengthInput = "<input type=\"text\"  {$itemLen} name=\"slength[]\" class=\"  input-in\" value=\"".$r['length']."\" />";
				 
			}
			else if(strtolower($item["category"])=="louvers"){  
				$itemName = listItem("louvres",$r,null,"");
				$lengthInput = "<input type=\"text\"  {$itemLen} name=\"slength[]\" class=\"width input-in ".(($r["is_additional"]==1 || $item["category"]=="Louvers")?"added-louvres-len":"")."\" value=\"{$r['length']}\" index=\"{$tr_index}\" />";
			    
			}else{
				$itemName = $item["description"];
				$lengthInput = "<input type=\"text\"  {$itemLen} name=\"slength[]\" class=\"length\" value=\"".$r['length']."\"  style=\"display:none\" />";
				 
			}

			$tr .= "<tr class=\"tr-vergola ".($r['is_additional']==1?"tr-added-item":"")."\">"; 
				$tr .= "<td class=\"td-item\">{$itemName}<input type=\"hidden\" class=\"price\" value=\"{$item['rrp']}\" category=\"{$item['category']}\" inventoryid=\"{$item['inventoryid']}\" desc=\"{$item['description']}\" /> </td>";
				$tr .= "<td> </td>"; 
				$tr .= "<td> ".$colorSelection." </td>";  
				$tr .= "<td class=\"td-finish-color\">".$listColourBondSelection." </td>";   
				$tr .= "<td class=\"td-uom\"> {$item["uom"]} <input type=\"hidden\" name=\"uom[]\" value=\"{$item["uom"]}\" \> </td>"; 
				if($item["inventoryid"] == "IRV61"){
					$tr .= "<td class=\"td-qty\"><input type=\"text\" {$itemQty} class=\"qtylen\" id=\"IRV61_qty\" name=\"qty[]\" value=\"{$r['qty']}\"></td>";  
				}else if($item["inventoryid"] == "IRV64"){
					$tr .= "<td class=\"td-qty\"><input type=\"text\" {$itemQty} class=\"qtylen\" id=\"IRV64_qty\" name=\"qty[]\" value=\"{$r['qty']}\"></td>";  
					 
				}else{
					$item_class = ""; 

					if($isFirst||$isSecond||$isSecond2||$isSecond3){
						$item_class .= "louver-item-qty";

					}else if($r["is_additional"]==1){
						if($item["category"]=="Louvers"){
							$item_class = " added-louvres-qty louver-item-qty ";
						}else if($item["inventoryid"]=="IRV59"){
							$item_class = "pivot-qty-{$tr_index}";
						}else if($item["inventoryid"]=="IRV60"){
							$item_class = "link-bar-qty-{$tr_index}";
						}
					}

					$tr .= "<td class=\"td-qty\"><input type=\"text\" {$itemQty} class=\"qtylen {$item_class}\" name=\"qty[]\" value=\"{$r['qty']}\" index=\"{$tr_index}\"></td>";
				} 
				
				$tr .= "<td class=\"td-len\">{$lengthInput}</td>";
				if(METRIC_SYSTEM=="inch"){
					$tr .= "<td class=\"td-ft\">{$lengthInput_ft}</td>";
				}  
				$tr .= "<td class=\"td-rrp\"><input type=\"text\" class=\"rrp\" readonly=\"readonly\" name=\"rrp[]\" value=\"{$r['rrp']}\"> </td>";  

				$tr .= "<input type=\"hidden\" class=\"desc\" name=\"desc[]\" value=\"".$item['description']."\" readonly=\"readonly\" />".
						"<input type=\"hidden\" class=\"invent\" name=\"invent[]\" value=\"".$item['inventoryid']."\" readonly=\"readonly\" />".
					    "<input type=\"hidden\" class=\"\" name=\"is_additional[]\" value=\"".$r['is_additional']."\" readonly=\"readonly\" />";

			$tr .= "</tr>";
			
			if($isFirst==1){
				$isSecond=1;
				$isFirst = 0;
			}else if($isSecond==1){
				$isFirst = 0;
				$isSecond=0;
				$isSecond2= 1;
				$isThird=0;
			}else if($isSecond2==1){ 
				$isSecond2= 0;  
				$isSecond3= 1;  
			}else if($isSecond3==1){
				$isFirst = 0;
				$isSecond3= 0;
				$isThird=1;
			}    

	 	} 

	 	$tr .= "<tr id=\"vergola_last_row\" >";  
		$tr .= "<td class=\"td-item\"> <input type=\"button\" class=\"save-btn\" value=\"Add Louver\" onclick=\"add_new_louver()\" />   </td>";
		$tr .= "<td> </td>";  
		$tr .= "<td> </td>";  
		$tr .= "<td> </td>";  
		$tr .= "<td class=\"td-uom\">  </td>";  
		$tr .= "<td class=\"td-qty\"> </td>";  
		$tr .= "<td class=\"td-len\"> </td>";  
		if(METRIC_SYSTEM=="inch"){
			$tr .= "<td class=\"td-ft\"> </td>";  
		} 
		$tr .= "<td class=\"td-rrp\"> </td>"; 
	 	$tr .= "</tr>";

	}else if($section=="misc"){
	 	 
	 		$fw = mysql_query("SELECT i.inventoryid, q.* FROM ver_chronoforms_data_quote_vic AS q LEFT JOIN ver_chronoforms_data_inventory_vic AS i ON i.inventoryid=q.inventoryid WHERE projectid='{$projectId}' AND LOWER(i.section) = 'misc' " ); // 
	 	 
		while ($r = mysql_fetch_assoc($fw)) { 
			$item = mysql_fetch_assoc(mysql_query("SELECT * FROM  ver_chronoforms_data_inventory_vic AS i  WHERE inventoryid='{$r["inventoryid"]}' " )); 
			
			$tr .= "<tr>"; 
				$tr .= "<td class=\"td-item\">".$item["description"]." <input type=\"hidden\" class=\"price\" value=\"{$item['rrp']}\" category=\"{$item['category']}\" inventoryid=\"{$item['inventoryid']}\" desc=\"{$item['description']}\" /> </td>";
				$tr .= "<td> </td>"; 
				$tr .= "<td> <input type=\"hidden\" name=\"colour[]\" /> </td>";  
				$tr .= "<td> <input type=\"hidden\" name=\"finish[]\" /> </td>";   
				$tr .= "<td class=\"td-uom\"> {$item["uom"]} <input type=\"hidden\" name=\"uom[]\" value=\"{$item["uom"]}\" \> </td>"; 
				if($item["inventoryid"] == "IRV66"){ 
					$tr .= "<td class=\"td-qty\"><input type=\"text\" class=\"qtylen\" id=\"IRV66_qty\" name=\"qty[]\" value=\"{$r['qty']}\"></td>";  
				}else{
					$tr .= "<td class=\"td-qty\"><input type=\"text\" class=\"qtylen\" name=\"qty[]\" value=\"{$r['qty']}\"></td>";  
				}
				$tr .= "<td class=\"td-len\"><input type=\"text\"  name=\"slength[]\" class=\"input-in\" value=\"{$r['length']}\" style=\"display:none\"> </td>";  
				if(METRIC_SYSTEM=="inch"){
					$tr .= "<td class=\"td-ft\"><input type=\"text\"    class=\"input-ft\" value=\"".get_feet_value($r['length'])."\" style=\"display:none\"> </td>";  
				}	
				$tr .= "<td class=\"td-rrp\"><input type=\"text\" class=\"rrp\" readonly=\"readonly\" name=\"rrp[]\" value=\"{$r['rrp']}\"> </td>";  

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
			if(METRIC_SYSTEM=="inch"){
				$tr .= "<td class=\"td-ft\"> </td>";  
			} 
			$tr .= "<td class=\"td-rrp\"> </td>";   
	 	$tr .= "</tr>";

	}else if($section=="extra"){
	 	
	 	 
	 	$fw = mysql_query("SELECT i.inventoryid, q.* FROM ver_chronoforms_data_quote_vic AS q LEFT JOIN ver_chronoforms_data_inventory_vic AS i ON i.inventoryid=q.inventoryid WHERE projectid='{$projectId}' AND LOWER(section) = 'extras' " ); // 
	 	 

		while ($r = mysql_fetch_assoc($fw)) { 
			$item = mysql_fetch_assoc(mysql_query("SELECT * FROM  ver_chronoforms_data_inventory_vic AS i  WHERE inventoryid='{$r["inventoryid"]}' " )); 
			
			$tr .= "<tr>"; 
				$tr .= "<td class=\"td-item\">".$item["description"]." <input type=\"hidden\" class=\"price\" value=\"{$item['rrp']}\" category=\"{$item['category']}\" inventoryid=\"{$item['inventoryid']}\" desc=\"{$item['description']}\" /> </td>";
				$tr .= "<td> </td>"; 
				$tr .= "<td> <input type=\"hidden\" name=\"colour[]\" /> </td>";  
				$tr .= "<td> <input type=\"hidden\" name=\"finish[]\" /> </td>";   
				$tr .= "<td class=\"td-uom\"> {$item["uom"]} <input type=\"hidden\" name=\"uom[]\" value=\"{$item["uom"]}\" \> </td>";  
				$tr .= "<td class=\"td-qty\"><input type=\"text\" class=\"qtylen\" name=\"qty[]\" value=\"{$r['qty']}\"></td>";  
				$tr .= "<td class=\"td-len\"><input type=\"text\"  name=\"slength[]\" class=\"input-in\" value=\"{$r['length']}\" style=\"display:none\"> </td>";  
				if(METRIC_SYSTEM=="inch"){
					$tr .= "<td class=\"td-ft\"><input type=\"text\"   class=\"input-ft\" value=\"".get_feet_value($r['length'])."\" style=\"display:none\"> </td>";  
				}	
				$tr .= "<td class=\"td-rrp\"><input type=\"text\" class=\"rrp\" readonly=\"readonly\" name=\"rrp[]\" value=\"{$r['rrp']}\"> </td>";  

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
			if(METRIC_SYSTEM=="inch"){
				$tr .= "<td class=\"td-ft\"> </td>";  
			} 
			$tr .= "<td class=\"td-rrp\"> </td>";   
	 	$tr .= "</tr>";


	}else if($section=="disbursements"){ 
	 	
		 
	 	$fw = mysql_query("SELECT i.inventoryid, q.* FROM ver_chronoforms_data_quote_vic AS q LEFT JOIN ver_chronoforms_data_inventory_vic AS i ON i.inventoryid=q.inventoryid WHERE projectid='{$projectId}' AND LOWER(section) = 'disbursements' " ); // 
	  

		while ($r = mysql_fetch_assoc($fw)) { 
			$item = mysql_fetch_assoc(mysql_query("SELECT * FROM  ver_chronoforms_data_inventory_vic AS i  WHERE inventoryid='{$r["inventoryid"]}' " )); 
			
			$tr .= "<tr>"; 
				$tr .= "<td class=\"td-item\">".$item["description"]." <input type=\"hidden\" class=\"price\" value=\"{$item['rrp']}\" category=\"{$item['category']}\" inventoryid=\"{$item['inventoryid']}\" desc=\"{$item['description']}\" /> </td>";
				$tr .= "<td> </td>"; 
				$tr .= "<td> <input type=\"hidden\" name=\"colour[]\" /> </td>";  
				$tr .= "<td> <input type=\"hidden\" name=\"finish[]\" /> </td>";   
				$tr .= "<td class=\"td-uom\"> {$item["uom"]} <input type=\"hidden\" name=\"uom[]\" value=\"{$item["uom"]}\" \> </td>";  
				$tr .= "<td class=\"td-qty\"><input type=\"text\" class=\"qtylen\" name=\"qty[]\" value=\"{$r['qty']}\"></td>";  
				$tr .= "<td class=\"td-len\"><input type=\"text\"  name=\"slength[]\" class=\"input-in\" value=\"{$r['length']}\" style=\"display:none\"> </td>"; 
				if(METRIC_SYSTEM=="inch"){
					$tr .= "<td class=\"td-ft\"><input type=\"text\" class=\"input-ft\" value=\"".get_feet_value($r['length'])."\" style=\"display:none\"> </td>"; 
				} 
				$tr .= "<td class=\"td-rrp\"><input type=\"text\" class=\"rrp rrp-disbursement\" readonly=\"readonly\" name=\"rrp[]\" value=\"{$r['rrp']}\"> </td>";  

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


if(isset($note)){
	echo "<div class=\"notification_error\"><span>{$note['content']}</span></div>";
}  

 
echo "<table class=\"listing-table\">";

// ***************************** Generate Framework Row ***********************************************//


// ***************************** Cbeam 200 Deep by 2.4mm ***********************************************//
echo "<tbody class=\"tbody_framework\">";
 
if($VergolaType != "Drop-In"){  

	echo "<tr><th>Description</th><th>Webbing</th><th>Colour</th><th>Finish</th><th>UOM</th><th>QTY</th><th>Length</th><th>RRP</th></tr>";
	echo "<tr><td colspan=\"8\" class=\"subheading\">Framework</td></tr>";
 
 
	echo generateRowItemVR5("frame",$ProjectID); 
	   
	// ***************************** First Post 90 x 90 - 2mm Galv ********************************************//

	echo "<tr><td colspan=\"8\" class=\"subheading\">Fittings</td></tr>";
	 
	// ***************************** Fixing to Wall - Solid Brick ********************************************//
	echo generateRowItemVR5("fixings",$ProjectID); 
 
	echo "</tbody>";
}

echo "<tbody class=\"tbody_non_framework\">";


echo "<tr><th>Description</th><th>Webbing</th><th>Colour</th><th>Finish</th><th>UOM</th><th>QTY</th><th>Length</th><th>RRP</th></tr>";
echo "<tr><td colspan=\"8\" class=\"subheading\">Gutters</td></tr>";

// ***************************** First Standard Vergola Gutter Lip Out 200 x 200 ********************************************//
echo generateRowItemVR5("guttering",$ProjectID); 
 
// ***************************** Cbeam Face Flashing Z al ********************************************//
echo "<tr><td colspan=\"8\" class=\"subheading\">Flashing</td></tr>";
 echo generateRowItemVR5("flashings",$ProjectID); 
 


// ***************************** Downpipe Plastic 3m ********************************************//
echo "<tr><td colspan=\"8\" class=\"subheading\">Downpipe</td></tr>";
echo generateRowItemVR5("downpipe",$ProjectID); 
 

//error_log("INSIDE -- b4: ", 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_vic\\my-error.log');
// ***************************** Louvres Poly or Square ********************************************//
echo "<tr><td colspan=\"8\" class=\"subheading\">Vergola System</td></tr>";
echo generateRowItemVR5("vergola",$ProjectID); 
  
// ***************************** Opaque Enclosure ********************************************//
echo "<tr><td colspan=\"8\" class=\"subheading\">Misc Items</td></tr>";
echo generateRowItemVR5("misc",$ProjectID); 
 
// ***************************** Misc Cost ********************************************//
 
// ***************************** Add Extra 1 ********************************************//
echo "<tr><td colspan=\"8\" class=\"subheading\">Extras</td></tr>";
echo generateRowItemVR5("extra",$ProjectID); 
  

// ***************************** Shop Drawings ********************************************//
echo "<tr><td colspan=\"8\" class=\"subheading\">Disbursements</td></tr>";
echo generateRowItemVR5("disbursements",$ProjectID); 
  
//error_log("INSIDE -- last: ", 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_vic\\my-error.log');
 
echo "</tbody>";
// End of Table
echo "</table>";
 //error_log("output vr4: ".$framework, 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_vic\\my-error.log');
?>
