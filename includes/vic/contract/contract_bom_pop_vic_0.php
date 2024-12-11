<?php //error_log("HERE 0", 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_us\\my-error.log');
$page_name = isset($_REQUEST['page_name']) ? $_REQUEST['page_name'] : '';
  
if(isset($_GET['get_item_dimension']) && isset($_GET['cf_id']) && $_GET['cf_id']>0 )
{ 
	$cf_id = mysql_real_escape_string($_GET['cf_id']);
  
	$sql = "SELECT * FROM ver_chronoforms_data_contract_items_vic WHERE cf_id ={$cf_id}"; 
	$result = mysql_query($sql);
	$data = mysql_fetch_assoc($result); 
	
	if($data != false){ 
		$can_save = true;
		if(isset($_GET['disabled'])) $can_save = false;
		$cf_id = mysql_real_escape_string($_GET['cf_id']);
	 

		$sql = "SELECT * FROM ver_chronoforms_data_contract_items_deminsions WHERE cf_id ='{$cf_id}' ";  
		//echo $sql;exit();
		$result = mysql_query($sql);
		$dimension = mysql_fetch_assoc($result);
	  
		// $sql_1 = "SELECT * FROM ver_chronoforms_data_inventory_vic WHERE inventoryid ='{$dimension['inventoryid']}'";

		// $sql_2 = "SELECT * FROM ver_chronoforms_data_inventory_vic WHERE inventoryid ='{$dimension['inventoryid']}'";
		
		$sql = "
		SELECT
			inv.*,
			-- i.cf_id,
			-- inv.cf_id AS inv_cf_id,
			-- i.inventoryid AS inventory_id,
			-- inv.inventoryid,
			-- inv.section,
			-- inv.category,
			i.description,
			inv.description AS inv_description,
			inv.photo
			-- inv.uom
		FROM
			ver_chronoforms_data_inventory_vic inv
			-- LEFT JOIN ver_chronoforms_data_inventory_vic AS inv	ON inv.inventoryid = i.inventoryid
			LEFT JOIN ver_chronoforms_data_contract_items_vic AS i ON i.inventoryid = inv.inventoryid
			-- LEFT JOIN ver_chronoforms_data_contract_items_deminsions AS d ON d.cf_id = i.cf_id
		WHERE 
			i.cf_id='{$cf_id}'";
			

		//echo $sql;exit;
		$result = mysql_query($sql);
		$item = mysql_fetch_assoc($result);
		$html = "<form method='post' action='".JURI::base()."contract-listing-vic/contract-folder-vic/contract-bom-vic' >
				<input type='hidden' name='save_dimension' />
				<input type='hidden' name='cf_id' value='{$cf_id}' />
				<input type='hidden' name='quoteid' value='{$data['quoteid']}' />
				<input type='hidden' name='projectid' value='{$data['projectid']}' />
				<input type='hidden' name='inventoryid' value='{$data['inventoryid']}' />
				<input type='hidden' name='section' value='Guttering' />
				<div class='item-dimension-content' style='width:700px;'>
					<div class='content-left' style='padding-top:20px'> <img src='".JURI::base()."images/inventory/{$item['photo']}"."' class='inv-image' /> </div>
					<div class='content-right'>						
						<p class='title'><h3>{$item['inv_description']}</h3><span>Dimensions in mm</span></p>

						<p><label>Length: </label><input type='text' name='length' value='{$dimension['length']}' /></p>
						<p><label>A :</label><input type='text' name='dimension_a' value='{$dimension["dimension_a"]}' /></p>
						<p><label>B :</label><input type='text' name='dimension_b' value='{$dimension["dimension_b"]}' /></p>
						<p><label>C :</label><input type='text' name='dimension_c' value='{$dimension["dimension_c"]}' /></p>
						<p><label>D :</label><input type='text' name='dimension_d' value='{$dimension["dimension_d"]}' /></p>
						<p><label>E :</label><input type='text' name='dimension_e' value='{$dimension["dimension_e"]}' /></p>
						<p><label>F :</label><input type='text' name='dimension_f' value='{$dimension["dimension_f"]}' /></p>
						<p><label>P :</label><input type='text' name='dimension_p' value='{$dimension["dimension_p"]}' /></p> 
						
						<div class='action-area'>
							 
					";
					if($can_save)
						$html .= "<input type='submit' name='save_dimension' class='btn-s' value='save' />";	
								 
					$html .= " <input type='button' class='btn-s' onclick='$(\"#lightbox\").hide();$(\"#lightbox-shadow\").hide();' value='Cancel' />
						</div> 
					 
					</div>
					

				</div>
				</form>
		";
		 
		
		//$html = $html . $html1 .$html2; //Should be like this to work the html properly.
	}	
	   
	echo $html;
	exit;
}

?>

<script src="<?php echo JURI::base().'jscript/jsapi.js'; ?>"></script>
<script src="<?php echo JURI::base().'jscript/jquery.min.js'; ?>"></script>
<script src="<?php echo JURI::base().'jscript/jquery-ui.min.js'; ?>" type="text/javascript"></script>
<script src="<?php echo JURI::base().'jscript/labels.js'; ?>"></script>
<script src="<?php echo JURI::base().'jscript/script.js'; ?>"></script>
<script src="<?php echo JURI::base().'jscript/jquery.transit.min.js'; ?>"></script> 
<script type="text/javascript" src="<?php echo JURI::base().'jscript/lightbox.js'; ?>"></script>
<script type="text/javascript" src="<?php echo JURI::base().'jscript/tabcontent.js'; ?>"></script>
 
<link rel="stylesheet" type="text/css" media="screen,projection" href="<?php echo JURI::base().'jscript/custom.css'; ?>" />
<link rel="stylesheet" type="text/css" media="screen,projection" href="<?php echo JURI::base().'jscript/new-enquiry.css'; ?>" />
<link rel="stylesheet" type="text/css" media="screen,projection" href="<?php echo JURI::base().'jscript/client-folder.css'; ?>" />
<link rel="stylesheet" type="text/css" media="screen,projection" href="<?php echo JURI::base().'jscript/contract-folder.css'; ?>" />
<link rel="stylesheet" type="text/css" media="screen,projection" href="<?php echo JURI::base().'jscript/lightbox.css'; ?>" />

<?php

if(isset($_POST['close']))
{	 
	header("Location:".JURI::base()."contract-listing-vic/contract-folder-vic?quoteid={$_REQUEST['quoteid']}&projectid={$_REQUEST['projectid']}"); 
}

global $unprocess_framework, $unprocess_fittings, $unprocess_gutters, $unprocess_flashings, $unprocess_downpipe, $unprocess_vergola, 
			$unprocess_misc, $unprocess_extras, $unprocess_disbursements, $unprocess_reorder;

$unprocess_framework=1; $unprocess_fittings=1; $unprocess_gutters=1; $unprocess_flashings=1; $unprocess_downpipe=1; $unprocess_vergola=1; 
$unprocess_misc=1; $unprocess_extras=1; $unprocess_disbursements=1; $unprocess_reorder=1;

//error_log(count($_POST), 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_us\\my-error.log');
if(count($_POST) == 0 && isset($_REQUEST['quoteid']) && isset($_REQUEST['projectid']) ){
	 
	$quoteid = mysql_real_escape_string($_REQUEST['quoteid']);
	$projectid = mysql_real_escape_string($_REQUEST['projectid']);	

}else if(count($_POST)>0 && isset($_REQUEST['quoteid']) && isset($_REQUEST['projectid']) ){
	 
	$quoteid = mysql_real_escape_string($_REQUEST['quoteid'][0]);
	$projectid = mysql_real_escape_string($_REQUEST['projectid'][0]);	
}

if(isset($_POST['cancel'])){ 
	header('Location:'.JURI::base().'contract-listing-vic/contract-folder-vic?quoteid='.$quoteid);
}

$is_error = false;
$error_message = null;
if(isset($_POST['add_product']))
{ 	 
	$projectid = mysql_real_escape_string($_POST['projectid']); 
	if($_POST['qty']<1){ 
		$is_error = true;
		$error_messages[] ="Please input quantity.";
	}

	$inventoryid = mysql_real_escape_string($_POST['inventoryid']); 
	$sql = "SELECT * FROM ver_chronoforms_data_inventory_vic WHERE inventoryid = '{$inventoryid}'";
	$record = mysql_fetch_assoc(mysql_query ($sql));
  
	if($record['uom']=="Mtrs" && (empty($_POST['length']) || $_POST['length']<0)){ 
		$is_error = true;
		$error_messages[] ="Please input length."; 
	}else{

	}
	 
	if($is_error == false){ 
		
		$quoteid = mysql_real_escape_string($_POST['quoteid']);
		$projectid = mysql_real_escape_string($_POST['projectid']); 
		$project_name = mysql_real_escape_string($_POST['project_name']); 
		$framework_type = mysql_real_escape_string($_POST['framework_type']); 
		$framework = mysql_real_escape_string($_POST['framework']); 
		$colour = mysql_real_escape_string($_POST['colour']); 
		$finish = mysql_real_escape_string($_POST['finish'][$i]);
		 
		$qty = mysql_real_escape_string($_POST['qty']); 
		if(empty($_POST['length'])){
			$length = 0;
		}else{
			$length = mysql_real_escape_string($_POST['length']);
		}
		if(isset($_POST['is_reorder']))
			$is_reorder = mysql_real_escape_string($_POST['is_reorder']);
		else
			$is_reorder = 0;

		
		 
		$description = $record["description"];  
		$uom = $record["uom"];  

		// $sql = "SELECT cf_id, rrp, cost, category FROM ver_chronoforms_data_inventory_vic WHERE section = 'Frame' and  cf_id  = '13' or cf_id = '14' or section ='Guttering' and cf_id = '41' or cf_id = '42'";	
		// $paints = mysql_query ($sql);

		if($record["uom"]=="Mtrs"){
			$rrp = $record["rrp"] * $qty * $length;
			$cost = $record["cost"] * $qty * $length;  
		}else{
			$rrp = $record["rrp"] * $qty;
			$cost = $record["cost"] * $qty; 
		}

		  
		$insertArr = "( 
						'$project_name',
						'{$quoteid}', 
						'{$projectid}', 
						'{$framework_type}', 
						'{$framework}',
						'{$description}', 
						'{$inventoryid}', 
						'{$colour}', 
						'{$uom}', 
						{$qty}, 
						{$length}, 
						{$cost}, 
						{$rrp},
						{$is_reorder}
						)";


		$query = "INSERT INTO ver_chronoforms_data_contract_items_vic (project_name, quoteid, projectid, framework_type, framework, description, inventoryid, colour, uom, qty, length, cost, rrp, is_reorder) VALUES {$insertArr}";
		//error_log($query, 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_us\\my-error.log'); 
	 	//echo $queryn; return;
	 	mysql_query($query);// or trigger_error("Insert failed: " . mysql_error());  
	 	//header('Location: /contract-listing-vic/contract-folder-vic?quoteid='.$quoteid.'&projectid='.$projectid);
	 	
	 	$dimension_cf_id = mysql_insert_id();	 	
	 	$queryitems = "INSERT INTO ver_chronoforms_data_contract_items_deminsions 
	 				          ( 
	 				          	cf_id,
	 				          	quoteid, 
	 				          	projectid, 
	 						    inventoryid,  
	 						    length, 
	 						  	dimension_a,
	 						  	dimension_b,
	 						  	dimension_c,
	 						  	dimension_d,
	 						  	dimension_e,
	 						  	dimension_f,
	 						  	dimension_p
	 						  	) 
	 						   
	 						   (SELECT 
	 						   	c.cf_id,
	 						   c.quoteid, 
	 						   c.projectid, 
	 						   c.inventoryid,  
	 						   c.length, 
	 						   idd.dimension_a,
	 						   idd.dimension_b,
	 						  	idd.dimension_c,
	 						  	idd.dimension_d,
	 						  	idd.dimension_e,
	 						  	idd.dimension_f,
	 						  	idd.dimension_p	
	 						   FROM (SELECT * FROM ver_chronoforms_data_contract_items_vic WHERE cf_id='{$dimension_cf_id}') AS c LEFT JOIN ver_chronoforms_data_inventory_vic AS i ON i.inventoryid=c.inventoryid LEFT JOIN ver_chronoforms_data_contract_items_default_deminsions as idd ON i.inventoryid=idd.inventoryid WHERE c.qty !='0.00' AND i.section='Guttering' OR i.section='Flashings') ";
	 			 	//error_log($queryitems, 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_sa\\my-error.log');
	 			    //$rc_item_d = mysql_query($queryitems) or trigger_error("Insert failed: " . mysql_error());

	 	mysql_query($queryitems) or trigger_error("Insert failed: " . mysql_error());
	 	
		//error_log("Project ID:".$projectid." Quote ID:".$quoteid, 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_us\\my-error.log');
	}
	 	 
}
//error_log($projectid , 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_us\\my-error.log');
$suplistpop = "1";
$supidpop = "1";
$_SESSION["projectid"] = $projectid;
$_SESSION["quoteid"] = $quoteid;

if ($projectid != '') {
	// Get Contract Items
	$resultdetails = mysql_query("SELECT * FROM ver_chronoforms_data_contract_list_vic WHERE projectid = '$projectid'");
	$retrievedetails = mysql_fetch_array($resultdetails);
	if (!$resultdetails) {die("Error: Data not found..");} 
	$ListProjName = $retrievedetails['project_name'];
	$ListProjectID = $retrievedetails['projectid'];
	$ListFramework = $retrievedetails['framework_type'];
	$ListVergolaType = $retrievedetails['framework'];

}	   
else {
	// Get Contract Items
	$resultdetails = mysql_query("SELECT * FROM ver_chronoforms_data_contract_list_vic WHERE quoteid = '$quoteid' ORDER BY quotedate DESC");
	$retrievedetails = mysql_fetch_array($resultdetails);
	if (!$resultdetails) {die("Error: Data not found..");} 
	$ListProjName = $retrievedetails['project_name'];
	$ListProjectID = $retrievedetails['projectid']; 
	$ListFramework = $retrievedetails['framework_type'];
	$ListVergolaType = $retrievedetails['framework'];
}

$VergolaType = $ListVergolaType;

//error_log(print_r($_POST,true) , 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_us\\my-error.log');


if(isset($_POST['process_bom']) && $_POST['is_process_bom']>0)
{	 
	//echo count($_POST['cf_id']);return;
	//error_log("inside process_bom..", 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_us\\my-error.log');
	$projectid = mysql_real_escape_string($_POST['projectid'][0]);	
	$quoteid = mysql_real_escape_string($_POST['quoteid'][0]);
 
	$cnt = count($_POST['cf_id']); 
	$total_rrp = 0;
	$total_vergola = 0;
	$total_disbursement = 0;
	$total_gst = 0;
	$total_sum = 0;

	$payment_deposit = 0;
	$payment_progress = 0;
	$payment_final = 0;
 
	$com_sales_commission = 0;
	$com_sales_commission_ps = 0;
	$com_pay1 = 0;
	$com_pay2 = 0;
	$com_final = 0;
	$com_installer_payment = 0;
 
	if ($cnt > 0) {
	    $insertArr = array();
  
		for ($i=0; $i<$cnt; $i++) {  
			$cf_id = mysql_real_escape_string($_POST['cf_id'][$i]); 
			//$supplierid = mysql_real_escape_string($_POST['supplierid'][$i]);
			$inventoryid = mysql_real_escape_string($_POST['inventoryid'][$i]); 
			$is_reorder = 0;
			if(isset($_POST['is_reorder'][$i])){
				$is_reorder = mysql_real_escape_string($_POST['is_reorder'][$i]);
			} 

			$vals = "(
							NOW(), 
							'{$quoteid}', 
							'{$projectid}', 
							'".mysql_real_escape_string($_POST['framework_type'][$i])."', 
							'".mysql_real_escape_string($_POST['framework'][$i])."', 
							'" . mysql_real_escape_string($_POST['description'][$i]) . "', 
							'{$inventoryid}', 
							'" . mysql_real_escape_string($_POST['colour'][$i]) . "', 
							'" . mysql_real_escape_string($_POST['finish'][$i]) . "',
							'" . mysql_real_escape_string($_POST['uom'][$i]) . "', 
							'" . mysql_real_escape_string($_POST['qty'][$i]) . "', 
							'" . mysql_real_escape_string($_POST['length'][$i]) . "', 
							'" . mysql_real_escape_string($_POST['cost'][$i]) . "', 
							'" . mysql_real_escape_string($_POST['rrp'][$i]) . "' ,  
							'" . mysql_real_escape_string($_POST['cf_id'][$i]) . "',
							 " . $is_reorder . ",
							'" . mysql_real_escape_string($_POST['section'][$i]) . "',
							'" . mysql_real_escape_string($_POST['category'][$i]) . "')";
							
							
				$insertArr[] = $vals;
				//error_log($qry1, 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_us\\my-error.log');//exit;
				// $qry1 = "INSERT INTO ver_chronoforms_data_material_supplier_vic(projectid, supplierid, inventoryid, materialid) 
				// 		 	   (SELECT  '{$projectid}', '{$supplierid}', '{$inventoryid}', materialid 
				// 		 	   FROM ver_chronoforms_data_material_default_supplier_vic WHERE inventoryid = '{$inventoryid}'  )";

				$qty = mysql_real_escape_string($_POST['qty'][$i]);
				$length = mysql_real_escape_string($_POST['length'][$i]);
				$section = mysql_real_escape_string($_POST['section'][$i]);
				//if($is_reorder) $section = ""; //#notsure tried to remove section for reorder items.
				 
				$qry1 = "INSERT INTO ver_chronoforms_data_contract_bom_meterial_vic(contract_item_cf_id, projectid, inventoryid, materialid, raw_cost, qty, length, supplierid, section, is_reorder) 
						 	   (SELECT  {$cf_id}, '{$projectid}', im.inventoryid, im.materialid, m.raw_cost, 
								CASE WHEN m.is_per_length=1 THEN CASE WHEN m.uom='Ea' THEN  ".$qty."*floor(ROUND(".$length."/m.length_per_ea,3)) ELSE ".$qty."*m.qty END ELSE ".$qty."*m.qty END  AS qty,
						 	   ".$length.", m.supplierid, '{$section}', {$is_reorder}
						 	   FROM ver_chronoforms_data_inventory_material_vic AS im JOIN ver_chronoforms_data_materials_vic AS m ON m.cf_id=im.materialid WHERE im.inventoryid = '{$inventoryid}' )";

 				//error_log($qry1, 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_us\\my-error.log');
			 	mysql_query($qry1);

		}
		//error_log(print_r($insertArr,true), 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_us\\my-error.log');//exit;
		$query = "INSERT INTO ver_chronoforms_data_contract_bom_vic (orderdate, quoteid, projectid, framework_type, framework, description, inventoryid, colour, finish, uom, qty, length, cost, rrp, contract_item_cf_id, is_reorder, inventory_section, inventory_category) VALUES " . implode(", ", $insertArr);
	 	//error_log($query, 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_us\\my-error.log'); //exit;
	 	mysql_query($query) or trigger_error("Insert failed: " . mysql_error()); 
	 	
	 	 
	 	$quoteid = mysql_real_escape_string($_POST['quoteid'][0]);
		$projectid = mysql_real_escape_string($_POST['projectid'][0]); 
	 	 
	 	//header('Location: ?quoteid='.$quoteid.'&projectid='.$projectid);

	 	//Generate a load list
	 	//projectid=  $projectid clientid=  $ClientID titleID= $load_list_titleID 

		// if($_POST['section']=="gutters" || $_POST['section']=="flashings")
		// {
		// 	$template_title='Load List - Gutter Flashing';//$_POST['title'] ; 	 
		// 	$template_content=generate_html_load_list_gutter_flashing($projectid);  
		//     $sql = "INSERT INTO ver_chronoforms_data_letters_vic (clientid, template_name, datecreated, template_content, template_type) 
		// 		 VALUES ('$template_clientid','$template_title', '".date('Y-m-d H:i:s')."', '$template_content', 'check list - gutter flashing')";  
		// 	mysql_query($sql); 

		// }else if($_POST['section']=="reorder"){
		// 	$template_title='Load List - Gutter Flashing';//$_POST['title'] ; 	 
		// 	$template_content=generate_html_load_list_gutter_flashing($projectid);  
		//     $sql = "INSERT INTO ver_chronoforms_data_letters_vic (clientid, template_name, datecreated, template_content, template_type) 
		// 		 VALUES ('$template_clientid','$template_title', '".date('Y-m-d H:i:s')."', '$template_content', 'check list - gutter flashing')";  
		// 	mysql_query($sql); 

		// 	$template_clientid=$quoteid;
		// 	$template_title='Load List';//$_POST['title'] ; 
		// 	$template_content=generate_html_load_list($projectid);  
		//     $sql = "INSERT INTO ver_chronoforms_data_letters_vic (clientid, template_name, datecreated, template_content, template_type) 
		// 		 VALUES ('$template_clientid','$template_title', '".date('Y-m-d H:i:s')."', '$template_content', 'check list')"; 
		// 	mysql_query($sql); 


		// }else{
		// 	$template_clientid=$quoteid;
		// 	$template_title='Load List';//$_POST['title'] ; 
		// 	$template_content=generate_html_load_list($projectid);  
		//     $sql = "INSERT INTO ver_chronoforms_data_letters_vic (clientid, template_name, datecreated, template_content, template_type) 
		// 		 VALUES ('$template_clientid','$template_title', '".date('Y-m-d H:i:s')."', '$template_content', 'check list')"; 
		// 	mysql_query($sql); 
		// }
	 	
			 
		
	 	 
	}  
}

 
if(isset($_POST['delete_product_id']) && $_POST['delete_product_id']>0 ){
	//error_log("HRERE cf_id: ".$_POST['delete_product_id'], 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_us\\my-error.log');
	$cf_id = $_POST['delete_product_id'];
	$query = "DELETE FROM ver_chronoforms_data_contract_items_vic WHERE cf_id={$cf_id}";
 	mysql_query($query) or trigger_error("Insert failed: " . mysql_error()); 

 	$quoteid = mysql_real_escape_string($_POST['quoteid'][0]);
	$projectid = mysql_real_escape_string($_POST['projectid'][0]);
 	header('Location: ?quoteid='.$quoteid.'&projectid='.$projectid); 
 	// mysql_query($query);

 	// $arr = array ('message'=>'successfully deleted','result'=>'1');

 	// header('Content-Type: application/json'); 
  //   echo json_encode($arr);

 	// return;
}
 
 

if(isset($_POST['update_products']) && isset($_POST['is_modified']) && $_POST['is_modified']>0 ){
	//$quoteid = mysql_real_escape_string($_POST['quoteid'][0]);
	//$projectid = mysql_real_escape_string($_POST['projectid'][0]); 
	//echo "SELECT * FROM ver_chronoforms_data_contract_items_vic WHERE quoteid = '$quoteid' and projectid = '$projectid'";return;	  
	
	//$qResult = mysql_query("SELECT * FROM ver_chronoforms_data_contract_items_vic WHERE quoteid = '$quoteid' and projectid = '$projectid'");
	//$contractItems = mysql_fetch_assoc($qResult);
	//print_r($_POST);return;
		//echo count($_POST['inventoryid']);return;
		//error_log(print_r($_POST,true), 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_us\\my-error.log'); 	
	    for ($i=0; $i<count($_POST['cf_id']); $i++) { 
 
	    			$cf_id = mysql_real_escape_string($_POST['cf_id'][$i]);
	    			$inventoryid = mysql_real_escape_string($_POST['inventoryid'][$i]);
	    			$description = mysql_real_escape_string($_POST['description'][$i]);
	    			$qty = mysql_real_escape_string($_POST['qty'][$i]);
	    			$length = mysql_real_escape_string($_POST['length'][$i]);
	    			$webbing = mysql_real_escape_string($_POST['webbing'][$i]);	
	    			$colour = mysql_real_escape_string($_POST['colour'][$i]);      			
	    			$finish = mysql_real_escape_string($_POST['finish'][$i]);
	    			$rrp = mysql_real_escape_string($_POST['rrp'][$i]);
	    			$cost = mysql_real_escape_string($_POST['cost'][$i]);
	    			$supplierid = mysql_real_escape_string($_POST['supplierid'][$i]); 

	    		  
	    			$sql = "UPDATE ver_chronoforms_data_contract_items_vic SET inventoryid='$inventoryid', qty={$qty}, length={$length}, colour='{$colour}', finish='{$finish}', description='{$description}'  WHERE  cf_id={$cf_id}  ";
					//error_log($sql."- ", 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_us\\my-error.log'); //exit();
					mysql_query($sql);

				  
			 
		}

	  
  
}
 

if(isset($_POST['remove_products']) && isset($_POST['is_remove']) && $_POST['is_remove']>0 ){
	//error_log(print_r($_POST,true), 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_us\\my-error.log');	 
	$cnt = count($_POST['cf_id']); 
	$clientid = mysql_real_escape_string($_POST['quoteid'][0]); 
	//print_r($_POST);return;

	if ($cnt > 0) {
	    $insertArr = array();
	    
		for ($i=0; $i<$cnt; $i++) {     

			$cf_id = mysql_real_escape_string($_POST['cf_id'][$i]);
			 
			$inventoryid = mysql_real_escape_string($_POST['inventoryid'][$i]);
			$projectid = mysql_real_escape_string($_POST['projectid'][0]);
			// $supplier_id = mysql_real_escape_string($_POST['supplierid'][$i]); 
			// $qty = mysql_real_escape_string($_POST['qty'][$i]);
			// $length = mysql_real_escape_string($_POST['length'][$i]);
			// $uom = mysql_real_escape_string($_POST['uom'][$i]);
			// $colour = mysql_real_escape_string($_POST['colour'][$i]);  
			// $finish = mysql_real_escape_string($_POST['finish'][$i]);  	

		 
			$query = "DELETE FROM ver_chronoforms_data_contract_bom_vic  WHERE contract_item_cf_id={$cf_id}";
	 	 	//echo $query;return;
	 		mysql_query($query) or trigger_error("Update failed: " . mysql_error()); 

	 		$query2 = "DELETE FROM ver_chronoforms_data_contract_bom_meterial_vic  WHERE contract_item_cf_id='{$cf_id}'  ";
	 	 	//echo $query;return;
	 	 	//error_log($query2, 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_us\\my-error.log');
	 		mysql_query($query2); 
 
		} 
	 	 
	 	$quoteid = mysql_real_escape_string($_POST['quoteid'][0]);
		$projectid = mysql_real_escape_string($_POST['projectid'][0]); 
	 	header('Location: ?quoteid='.$quoteid.'&projectid='.$projectid);
	 	 
	}


	


}

if(isset($_POST['save_dimension'])){
		 
	
	//print_r($_POST);exit;
	//if($_POST['section'] == "Guttering"){
		$cf_id = mysql_real_escape_string($_POST['cf_id']);
		$quoteid = mysql_real_escape_string($_POST['quoteid']);  
		$inventoryid = mysql_real_escape_string($_POST['inventoryid']);  
		//$bom_id = mysql_real_escape_string($_POST['bom_id']);
		//$section = mysql_real_escape_string($_POST['section']); 
		$length = mysql_real_escape_string($_POST['length']);
		//$width = mysql_real_escape_string($_POST['width']); 
		$dimension_a = mysql_real_escape_string($_POST['dimension_a']);  
		$dimension_b = mysql_real_escape_string($_POST['dimension_b']); 
		$dimension_c = mysql_real_escape_string($_POST['dimension_c']);  
		$dimension_d = mysql_real_escape_string($_POST['dimension_d']); 
		$dimension_e = mysql_real_escape_string($_POST['dimension_e']);  
		$dimension_f = mysql_real_escape_string($_POST['dimension_f']);  
		$dimension_p = mysql_real_escape_string($_POST['dimension_p']); 
	 
		// $query = "DELETE FROM ver_chronoforms_data_contract_items_deminsions  WHERE cf_id={$cf_id}";
		// mysql_query($query);


		$query = "UPDATE ver_chronoforms_data_contract_items_deminsions  SET length='{$length}',  dimension_a='{$dimension_a}', dimension_b='{$dimension_b}', dimension_c='{$dimension_c}', dimension_d='{$dimension_d}', dimension_e='{$dimension_e}', dimension_f='{$dimension_f}', dimension_p='{$dimension_p}'  WHERE cf_id='{$cf_id}';";
		//echo $query; exit();
		mysql_query($query) or trigger_error("Update failed: " . mysql_error()); 

	 
	 	$quoteid = mysql_real_escape_string($_POST['quoteid']);
		$projectid = mysql_real_escape_string($_POST['projectid']); 
	 	header('Location: ?quoteid='.$quoteid.'&projectid='.$projectid);	

	//}   
}

 

function list_colours($name="",$selected=null){  
	$sqlcolour = "SELECT * FROM ver_chronoforms_data_colour_vic ORDER BY colour";
	$resultcolour = mysql_query ($sqlcolour);
	$r = "<select class='colour' name='{$name}' >";
	while ($colour = mysql_fetch_assoc($resultcolour)) 
	{ 
		$r .= "<option value='{$colour['colour']}' ";
		if ($selected != null && $colour['colour'] == $selected) { $r .= " selected=\"selected\"";} 
		else {$r .= "";}
		$r .= ">{$colour['colour']}</option>";
	}
	$r .= "</select>";
	return $r;
}

function list_colour_bond($name="",$selected=null,$section = "Frame"){  
	$sql = "SELECT * FROM ver_chronoforms_data_inventory_vic WHERE section = '{$section}' AND category = 'Finish' Order By description  ";	
	//error_log($sql, 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_us\\my-error.log'); 
	$paints = mysql_query ($sql);

	$r = "<select class=\"paint-list\"  name='{$name}' >";  
    while ($paint = mysql_fetch_array($paints)){
	  	$r .= "<option value=\"".$paint['description']."\" "; 
		if($paint['description'] == $selected){ $r .= "selected=\"selected\"";
		} else { $r .= "";}
		$r .= ">".$paint['description']."</option>";	
	}
	$r .= "</select>";

	return $r;

}

function listColourBond($selected=null,$item=null,$section = "Frame"){  
	$sql = "SELECT cf_id, rrp, cost, category, description FROM ver_chronoforms_data_inventory_vic WHERE  section = '{$section}' AND category = 'Finish' Order By description ";	

	$paints = mysql_query ($sql);

	$r = "<select class=\"paint-list\"  name=\"finish[]\"  >";  
    while ($paint = mysql_fetch_array($paints)){
    	//error_log(print_r($paint,true), 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_us\\my-error.log');
	  	$r .= "<option value=\"".$paint['description']."\" finishrrp=\"".$paint["rrp"]."\" "; 
		if($paint['description'] == $selected){ $r .= "selected=\"selected\"";
		} else { $r .= "";}
		$r .= ">".$paint['description']."</option>";	
	}
	$r .= "</select>";
 
	return $r; 
}

function list_suppliers($name,$selected=null){
	$sqlsupplier = "SELECT * FROM ver_chronoforms_data_supplier_vic ORDER BY company_name";
	$resultsupplier = mysql_query ($sqlsupplier);

	$r = "<select class=\"supplierpop\" name=\"{$name}\" >"; 
	while ($supplier = mysql_fetch_array($resultsupplier)) 
	{  
		if($supplier['supplierid'] == $selected)
			$r .= "<option selected=\"selected\" value=\"{$supplier['supplierid']}\">{$supplier['company_name']}</option>";
		else
			$r .= "<option value=\"{$supplier['supplierid']}\">{$supplier['company_name']}</option>";
	}
	$r .= "</select>"; 
	return $r;
}

function list_products($name){  
	$r = "<select class=\"list-products\" name=\"{$name}\" id=\"select_list_product\" >";
	$r .= "<option selected='selected'>Select Product</option>";
	global $unprocess_framework, $unprocess_fittings, $unprocess_gutters, $unprocess_flashings, $unprocess_downpipe, $unprocess_vergola, 
			$unprocess_misc, $unprocess_extras, $unprocess_disbursements;
	//Framwork products
	//if($unprocess_framework){
	$sql = "SELECT * FROM  ver_chronoforms_data_inventory_vic AS inv  WHERE  inv.section='Frame' ";
	$result = mysql_query ($sql);
	$label = "Framework"; $is_reorder="";
	if($unprocess_framework==false){$label="Reorder Framework Items"; $is_reorder = "data_value='is_reorder'";}
	$r .= "<optgroup label='{$label}'>"; 
	while ($data = mysql_fetch_array($result)) 
	{    
		$r .= "<option value=\"{$data['inventoryid']}\" {$is_reorder}>".stripslashes($data['description'])."</option>";
	}
	  
	//Fittings products 
	$sql = "SELECT * FROM  ver_chronoforms_data_inventory_vic AS inv  WHERE  inv.section='Fixings' ";
	$result = mysql_query ($sql);
	$label = "Fittings"; $is_reorder="";
	if($unprocess_fittings==false){$label="Reorder Fittings Items"; $is_reorder = "data_value='is_reorder'";}
	$r .= "<optgroup label='{$label}'>";
	while ($data = mysql_fetch_array($result)) 
	{    
		$r .= "<option value=\"{$data['inventoryid']}\" {$is_reorder}>".stripslashes($data['description'])."</option>";
	}
 


	//Guttering products 
	$sql = "SELECT * FROM  ver_chronoforms_data_inventory_vic AS inv  WHERE  inv.section='Guttering' ";
	$result = mysql_query ($sql);
	$label = "Gutters"; $is_reorder="";
	if($unprocess_gutters==false){$label="Reorder Gutters Items"; $is_reorder = "data_value='is_reorder'";}
	$r .= "<optgroup label='{$label}'>";
	while ($data = mysql_fetch_array($result)) 
	{    
		$r .= "<option value=\"{$data['inventoryid']}\" {$is_reorder}>".stripslashes($data['description'])."</option>";
	}
	 

	//Flashings products 
	$sql = "SELECT * FROM  ver_chronoforms_data_inventory_vic AS inv  WHERE  inv.section='Flashings' ";
	$result = mysql_query ($sql);
	$label = "Flashings"; $is_reorder="";
	if($unprocess_flashings==false){$label="Reorder Flashings Items"; $is_reorder = "data_value='is_reorder'";}
	$r .= "<optgroup label='{$label}'>";
	while ($data = mysql_fetch_array($result)) 
	{   
		$r .= "<option value=\"{$data['inventoryid']}\" {$is_reorder}>".stripslashes($data['description'])."</option>";
	}
 
	//Downpipe products 
	$sql = "SELECT * FROM  ver_chronoforms_data_inventory_vic AS inv WHERE  inv.section='Downpipe'  ";
	$result = mysql_query ($sql);
	$label = "Downpipe"; $is_reorder="";
	if($unprocess_downpipe==false){$label="Reorder Downpipe Items"; $is_reorder = "data_value='is_reorder'";}
	$r .= "<optgroup label='{$label}'>";
	while ($data = mysql_fetch_array($result)) 
	{   
		$r .= "<option value=\"{$data['inventoryid']}\" {$is_reorder}>".stripslashes($data['description'])."</option>";
	}
	  
	//Vergola products 
	$sql = "SELECT * FROM  ver_chronoforms_data_inventory_vic AS inv WHERE  inv.section='Vergola'  ";
	$result = mysql_query ($sql);
	$label = "Vergola"; $is_reorder="";
	if($unprocess_vergola==false){$label="Reorder Vergola Items"; $is_reorder = "data_value='is_reorder'";}
	$r .= "<optgroup label='{$label}'>";
	while ($data = mysql_fetch_array($result)) 
	{   
		$r .= "<option value=\"{$data['inventoryid']}\" {$is_reorder}>".stripslashes($data['description'])."</option>";
	}
	 

	//Misc products 
	$sql = "SELECT * FROM  ver_chronoforms_data_inventory_vic AS inv WHERE   inv.section='Misc'  ";
	$result = mysql_query ($sql);
	$label = "Miscellaneous"; $is_reorder="";
	if($unprocess_misc==false){$label="Reorder Miscellaneous Items"; $is_reorder = "data_value='is_reorder'";}
	$r .= "<optgroup label='{$label}'>";
	while ($data = mysql_fetch_array($result)) 
	{   
		$r .= "<option value=\"{$data['inventoryid']}\" {$is_reorder}>".stripslashes($data['description'])."</option>";
	}
	 

	//Extras products 
	$sql = "SELECT * FROM  ver_chronoforms_data_inventory_vic AS inv WHERE inv.section='Extras'  ";
	$result = mysql_query ($sql);
	$label = "Extras"; $is_reorder="";
	if($unprocess_extras==false){$label="Reorder Extras Items"; $is_reorder = "data_value='is_reorder'";}
	$r .= "<optgroup label='{$label}'>";
	while ($data = mysql_fetch_array($result)) 
	{   
		$r .= "<option value=\"{$data['inventoryid']}\" {$is_reorder}>".stripslashes($data['description'])."</option>";
	}
 

	
	//Disbursements products 
	$sql = "SELECT * FROM  ver_chronoforms_data_inventory_vic AS inv WHERE  inv.section='Disbursements'  ";
	$result = mysql_query ($sql);
	$label = "Disbursements"; $is_reorder="";
	if($unprocess_disbursements==false){$label="Reorder Disbursements Items"; $is_reorder = "data_value='is_reorder'";}
	$r .= "<optgroup label='{$label}'>";
	while ($data = mysql_fetch_array($result)) 
	{   
		$r .= "<option value=\"{$data['inventoryid']}\" {$is_reorder}>".stripslashes($data['description'])."</option>";
	}
 

 
	$r .= "</select>"; 
	
	return $r;
}


// Product Select
function products($name,$inventory_id,$product_category="",$cat=""){
	$r = "<select class=\"sel-products desclist\" name=\"{$name}\" style=\"width:auto;\"  >"; 
	global $unprocess_framework, $unprocess_gutters, $unprocess_flashings, $unprocess_downpipe, $unprocess_vergola, 
			$unprocess_misc, $unprocess_extras, $unprocess_disbursements;
			
	//Framwork products
	if($product_category == "framework" || $product_category == "Frame" ){
		//$sql = "SELECT * FROM  ver_chronoforms_data_inventory_vic AS inv  WHERE  inv.section='Frame' ";
		$sql = "SELECT * FROM  ver_chronoforms_data_inventory_vic  WHERE   section  = 'Frame' AND category = '{$cat}'";
		//error_log($sql, 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_us\\my-error.log');
		$result = mysql_query ($sql); 
		while ($data = mysql_fetch_array($result)) 
		{ 
			if($data['inventoryid'] == $inventory_id)
				$r .= "<option  selected='selected' value=\"{$data['inventoryid']}\">".stripslashes($data['description'])."</option>";
			else{
				$r .= "<option value=\"{$data['inventoryid']}\">".stripslashes($data['description'])."</option>";
			}
		}
	}

	//Fittings products
	if($product_category == "fixings" || $product_category == "Fixings"){
		$sql = "SELECT * FROM  ver_chronoforms_data_inventory_vic AS inv  WHERE  inv.section='Frame' AND inv.section='Fixings' ";
		$result = mysql_query ($sql); 
		while ($data = mysql_fetch_array($result)) 
		{    
			if($data['inventoryid'] == $inventory_id)
				$r .= "<option selected='selected' value=\"{$data['inventoryid']}\">".stripslashes($data['description'])."</option>";
			else
				$r .= "<option value=\"{$data['inventoryid']}\">".stripslashes($data['description'])."</option>";
		}
	}


	//Guttering products
	if($product_category == "guttering" || $product_category == "Guttering"){
		$sql = "SELECT * FROM  ver_chronoforms_data_inventory_vic AS inv  WHERE  inv.section='Guttering'   ";
		$result = mysql_query ($sql); 
		while ($data = mysql_fetch_array($result)) 
		{    
			if($data['inventoryid'] == $inventory_id)
				$r .= "<option selected='selected' value=\"{$data['inventoryid']}\">".stripslashes($data['description'])."</option>";
			else
				$r .= "<option value=\"{$data['inventoryid']}\">".stripslashes($data['description'])."</option>";
		}
	}

	//Flashings products
	if($product_category == "flashings" || $product_category == "Flashings"){
		$sql = "SELECT * FROM  ver_chronoforms_data_inventory_vic AS inv  WHERE  inv.section='Flashings' ";
		$result = mysql_query ($sql); 
		while ($data = mysql_fetch_array($result)) 
		{   
			if($data['inventoryid'] == $inventory_id)
				$r .= "<option selected='selected' value=\"{$data['inventoryid']}\">".stripslashes($data['description'])."</option>";
			else
				$r .= "<option value=\"{$data['inventoryid']}\">".stripslashes($data['description'])."</option>";
		}
	}

	//Downpipe products
	if($product_category == "downpipe" || $product_category == "Downpipe"){
		$sql = "SELECT * FROM  ver_chronoforms_data_inventory_vic AS inv WHERE  inv.section='Downpipe'  ";
		$result = mysql_query ($sql); 
		while ($data = mysql_fetch_array($result)) 
		{   
			if($data['inventoryid'] == $inventory_id)
				$r .= "<option selected='selected' value=\"{$data['inventoryid']}\">".stripslashes($data['description'])."</option>";
			else
				$r .= "<option value=\"{$data['inventoryid']}\">".stripslashes($data['description'])."</option>";
		}
	}

	//Vergola products
	if($product_category == "vergola" || $product_category == "Vergola"){
		$sql = "SELECT * FROM  ver_chronoforms_data_inventory_vic AS inv WHERE  inv.section='Vergola' AND category='Louvers' ";
		$result = mysql_query ($sql);
		while ($data = mysql_fetch_array($result)) 
		{   
			if($data['inventoryid'] == $inventory_id)
				$r .= "<option selected='selected' value=\"{$data['inventoryid']}\">".stripslashes($data['description'])."</option>";
			else
				$r .= "<option value=\"{$data['inventoryid']}\">".stripslashes($data['description'])."</option>";
		}
	}

	//Misc products
	if($product_category == "misc" || $product_category == "Misc"){
		$sql = "SELECT * FROM  ver_chronoforms_data_inventory_vic AS inv WHERE   inv.section='Misc'  ";
		$result = mysql_query ($sql); 
		while ($data = mysql_fetch_array($result)) 
		{   
			if($data['inventoryid'] == $inventory_id)
				$r .= "<option selected='selected' value=\"{$data['inventoryid']}\">".stripslashes($data['description'])."</option>";
			else
				$r .= "<option value=\"{$data['inventoryid']}\">".stripslashes($data['description'])."</option>";
		}
	}

	//Extras products
	if($product_category == "extras" || $product_category == "Extras"){
		$sql = "SELECT * FROM  ver_chronoforms_data_inventory_vic AS inv WHERE inv.section='Extras'  ";
		$result = mysql_query ($sql);
		while ($data = mysql_fetch_array($result)) 
		{   
			if($data['inventoryid'] == $inventory_id)
				$r .= "<option selected='selected' value=\"{$data['inventoryid']}\">".stripslashes($data['description'])."</option>";
			else
				$r .= "<option value=\"{$data['inventoryid']}\">".stripslashes($data['description'])."</option>";
		}
	}

	
	//Disbursements products
	if($product_category == "disbursements"){
		$sql = "SELECT * FROM  ver_chronoforms_data_inventory_vic AS inv WHERE  inv.section='Disbursements'  ";
		$result = mysql_query($sql);
		while ($data = mysql_fetch_array($result)) 
		{   
			if($data['inventoryid'] == $inventory_id)
				$r .= "<option selected='selected' value=\"{$data['inventoryid']}\">".stripslashes($data['description'])."</option>";
			else
				$r .= "<option value=\"{$data['inventoryid']}\">".stripslashes($data['description'])."</option>";

		}
	}
 
	$r .= "</select>";
	
	return $r;
	
}

//error_log("project id: ". $projectid, 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_us\\my-error.log');
//error_log("--- str: ".substr($projectid,3), 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_us\\my-error.log');

?>

<input id="url" type="hidden" value="<?php echo JURI::base(); ?>" />
<!-- Display old contract from old system show this part -->
<?php if(substr($projectid,0,3)=="VIC" || substr($projectid,0,3)=="JID" || substr($projectid,0,3)=="VSA" || substr($projectid,0,3)=="QID"){ ?>

	<table class="listing-table ">
    <thead>
    	<tr>
    		<td colspan="9" class="subheading" data-section='Frame' >
				Framework
    		</td>
    	</tr>
    	 
    	<tr><th style=" ">Description</th><th style="width:6%;">UOM</th><th style="width:7%;">QTY</th><th style="width:10%;">Length</th><th style="width:10%;">Colour</th> <th  >Supplier</th> 
    	</tr> 
    </thead>
    <tbody>   

	<?php
	$project_name = "";
    $project_framework_type = "";
    $project_framework = "";
    //------------- Framework Layout ---------------
    $sqlquotes = "SELECT i.*,i.cf_id AS id, inv.cf_id AS inv_cf_id, i.inventoryid AS inventory_id, inv.inventoryid, inv.section, inv.category, inv.description, inv.photo, inv.uom, s.company_name FROM ver_chronoforms_data_contract_items_vic AS i  LEFT JOIN ver_chronoforms_data_inventory_vic_old_system AS inv ON inv.inventoryid=i.inventoryid LEFT JOIN ver_chronoforms_data_supplier_vic as s ON s.sup_id=i.supplierid  WHERE  projectid = '$projectid' ";  
    //error_log($sqlquotes, 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_us\\my-error.log');
    
	$resultquotes = mysql_query ($sqlquotes) or die ('request "Could not execute SQL query" '.$sqlquotes);
 
		while($row = mysql_fetch_assoc($resultquotes)){

			if($row["section"]!="GUTTERING" && $row["section"]!="FLASHING"){
				echo "<tr>  "; 
				echo "<td> ".$row['description']." </td>";   
				echo "<td  class=\"td-item\"> {$row["uom"]}   </td>"; 
				echo "<td>  {$row["qty"]} </td>"; 
				echo "<td>  {$row["length"]}  </td>"; 

				echo "<td>{$row["colour"]}</td>"; 
				   
				
				echo "<td> ". $row["company_name"] ."</td>";  
			 
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
				GUTTER 
    		</td>
    	</tr> 
    	<tr><th style=" ">Description</th><th style="width:6%;">UOM</th><th style="width:7%;">QTY</th><th style="width:10%;">Length</th><th style="width:10%;">Colour</th> <th  >Supplier</th> 
    	</tr> 
    </thead>
    <tbody>  

	<?php
		mysql_data_seek($resultquotes, 0); 
		while($row = mysql_fetch_assoc($resultquotes)){

			if($row["section"]=="GUTTERING"){
				echo "<tr>  "; 
				echo "<td> ".$row['description']."  </td>";    
				echo "<td> {$row["uom"]}  </td>"; 
				echo "<td>  {$row["qty"]} </td>"; 
				echo "<td>  {$row["length"]}  </td>"; 
				echo "<td>{$row["colour"]}</td>";  
				echo "<td> ". $row["company_name"] ."</td>"; 
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
    	<tr><th style=" ">Description</th><th style="width:6%;">UOM</th><th style="width:7%;">QTY</th><th style="width:10%;">Length</th><th style="width:10%;">Colour</th> <th  >Supplier</th> 
    	</tr> 
    </thead>
    <tbody>  

	<?php
		mysql_data_seek($resultquotes, 0); 
		while($row = mysql_fetch_assoc($resultquotes)){

			if($row["section"]=="FLASHING"){
				echo "<tr>  "; 
				echo "<td> ".$row['description']."  </td>";    
				echo "<td  > {$row["uom"]}  </td>"; 
				echo "<td>  {$row["qty"]} </td>"; 
				echo "<td>  {$row["length"]}  </td>";  
				echo "<td>{$row["colour"]}</td>";  
				echo "<td> ". $row["company_name"] ."</td>";  
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
				PURCHASE ORDER
    		</td>
    	</tr>
    	 
    	<tr><th style=" ">Order Date</th><th style="width:6%;">Order No</th><th style="width:7%;">Supplier</th><th style="width:10%;">Total Cost</th><th style="width:10%;">Order Type</th> 
    	</tr> 
    </thead>
    <tbody>  

	<?php
		$sqlquotes = "SELECT *,DATE_FORMAT(date_entered,'%d-%b-%Y') fdate_entered FROM ver_chronoforms_data_contract_po_old_sys_vic AS po LEFT JOIN ver_chronoforms_data_supplier_vic AS s ON s.supplierid=po.supplierid WHERE projectid = '$projectid' ";  
    //error_log($sqlquotes, 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_us\\my-error.log'); 
		$resultquotes = mysql_query ($sqlquotes) or die ('request "Could not execute SQL query" '.$sqlquotes);
		while($row = mysql_fetch_assoc($resultquotes)){

			 
				echo "<tr>  "; 
				echo "<td> ".$row['fdate_entered']."   </td>";   
				echo "<td   > {$row["order_no"]}   </td>"; 
				echo "<td>  {$row["company_name"]} </td>"; 
				echo "<td>$".  number_format($row["total_ex_gst"],2,".",",") . "</td>";  
				echo "<td>{$row["type"]}</td>";  
				echo "</tr>"; 
		}
		?> 
		
	</tbody>
	</table>  



	<!-- If the contract is is new from new system then show this part -->
 	<?php }else{ ?>	



  
<?php
    $project_name = "";
    $project_framework_type = "";
    $project_framework = "";
    //------------- Framework Layout ---------------
    $sqlquotes = "SELECT i.*,i.cf_id AS id, inv.cf_id AS inv_cf_id, i.inventoryid AS inventory_id, inv.inventoryid, inv.section, inv.category, inv.description AS inv_description, inv.photo, inv.uom FROM ver_chronoforms_data_contract_items_vic AS i  LEFT JOIN ver_chronoforms_data_inventory_vic AS inv ON inv.inventoryid=i.inventoryid   WHERE projectid = '$projectid' and qty != 0 AND is_reorder=0 ORDER BY i.cf_id"; 



    //ORGINAL QUERY  FIELD(i.inventoryid, 'IRV64','IRV63','IRV62','IRV60','IRV61','IRV59','IRV58','IRV54',     'IRV122','IRV121','IRV26','IRV25','IRV24','IRV23','IRV15','IRV120','IRV3') DESC 

    //error_log($sqlquotes, 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_us\\my-error.log');

    //$sqlquotes = "SELECT * FROM ver_chronoforms_data_contract_items_vic AS i LEFT JOIN ver_chronoforms_data_inventory_vic AS inv ON inv.inventoryid=i.inventoryid WHERE quoteid = '$quoteid' and projectid = '$projectid' and qty != '0.00' AND section = 'Frame' and category = 'CBeams' or category = 'Timber' ";
	$resultquotes = mysql_query ($sqlquotes) or die ('request "Could not execute SQL query" '.$sqlquotes);

	$has_framework=0; $has_fittings=0; $has_gutters=0; $has_flashings=0; $has_downpipe=0; $has_vergola=0; $has_misc=0;  $has_extras=0; $has_disbursements=0; 
	//mysql_data_seek($resultquotes, 0); 
	while($row = mysql_fetch_assoc($resultquotes)){ 
		if($row["section"]=="Frame" || $row["section"]=="Posts"){
			$has_framework = 1;
		}
		//Get the framework type and framework of the particular project made. Get these data to be used for additional inventoryid/product in the BOM record.
		$project_name = $row["project_name"];
		$project_framework_type = $row["framework_type"];
   		$project_framework = $row["framework"];
	}	

	mysql_data_seek($resultquotes, 0); 
	while($row = mysql_fetch_assoc($resultquotes)){ 
		if($row["section"]=="Fixings"){
			$has_fittings = 1;
		}
	}

	mysql_data_seek($resultquotes, 0); 
	while($row = mysql_fetch_assoc($resultquotes)){ 
		if($row["section"]=="Guttering"){
			$has_gutters = 1;
		}
	}

	mysql_data_seek($resultquotes, 0); 
	while($row = mysql_fetch_assoc($resultquotes)){ 
		if($row["section"]=="Flashings"){
			$has_flashings = 1;
		}
	}

	mysql_data_seek($resultquotes, 0); 
	while($row = mysql_fetch_assoc($resultquotes)){ 
		if($row["section"]=="Downpipe"){
			$has_downpipe = 1;
		}
	}

	mysql_data_seek($resultquotes, 0); 
	while($row = mysql_fetch_assoc($resultquotes)){ 
		if($row["section"]=="Vergola"){
			$has_vergola = 1;
		}
	}

	mysql_data_seek($resultquotes, 0); 
	while($row = mysql_fetch_assoc($resultquotes)){ 
		if($row["section"]=="Misc"){
			$has_misc = 1;
		}
	}

	mysql_data_seek($resultquotes, 0); 
	while($row = mysql_fetch_assoc($resultquotes)){ 
		if($row["section"]=="Extras"){
			$has_extras = 1;
		}
	}

	mysql_data_seek($resultquotes, 0); 
	while($row = mysql_fetch_assoc($resultquotes)){ 
		if($row["section"]=="Disbursements"){
			$has_disbursements = 1;
		}
	}

	$sql = "SELECT * FROM ver_chronoforms_data_contract_bom_vic AS i LEFT JOIN ver_chronoforms_data_inventory_vic AS inv ON inv.inventoryid=i.inventoryid  WHERE i.projectid = '$projectid' AND is_reorder=0 "; //AND inv.section='Frame' AND (inv.category='Beams' OR inv.category='CBeams')
	//error_log($sql, 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_us\\my-error.log');
	$resultpo = mysql_query ($sql);
	//mysql_data_seek($resultpo, 0); 
	global $unprocess_framework; 
 
	while($row = mysql_fetch_assoc($resultpo)){ 
		 
		if($row["section"]=="Frame" || $row["category"]=="Posts" ){
			$unprocess_framework = 0; 
		}
	}
	// $num_framework = $result["count"];  
	// global $unprocess_framework;
	// $unprocess_framework = 0;
	// if($num_framework<1){$unprocess_framework = 1;}


	//$sql = "SELECT COUNT(i.cf_id) as count FROM ver_chronoforms_data_contract_bom_vic AS i LEFT JOIN ver_chronoforms_data_inventory_vic AS inv ON inv.inventoryid=i.inventoryid  WHERE i.projectid = '$projectid' AND inv.section='Fixings' OR (inv.section='Frame' AND inv.category='Posts') ";
	//$result = mysql_fetch_assoc(mysql_query ($sql));
	//$num_fittings = $result["count"];
	if(mysql_num_rows($resultpo)){
		mysql_data_seek($resultpo, 0); 
	}
	
	global $unprocess_fittings;  
	while($row = mysql_fetch_assoc($resultpo)){ 
		if($row["section"]=="Fixings"){
			$unprocess_fittings = 0;  
		}
	}

 
	//$sql = "SELECT COUNT(i.cf_id) as count FROM ver_chronoforms_data_contract_bom_vic AS i LEFT JOIN ver_chronoforms_data_inventory_vic AS inv ON inv.inventoryid=i.inventoryid  WHERE i.projectid = '$projectid' AND inv.section='Guttering' ";
	//$result = mysql_fetch_assoc(mysql_query ($sql));
	//$num_gutters = $result["count"];
	global $unprocess_gutters; 
	if(mysql_num_rows($resultpo)){
		mysql_data_seek($resultpo, 0);
	} 
	while($row = mysql_fetch_assoc($resultpo)){ 
		if($row["section"]=="Guttering"){
			$unprocess_gutters = 0; 
		}
	}

	    
	// $sql = "SELECT COUNT(i.cf_id) as count FROM ver_chronoforms_data_contract_bom_vic AS i LEFT JOIN ver_chronoforms_data_inventory_vic AS inv ON inv.inventoryid=i.inventoryid  WHERE i.projectid = '$projectid' AND inv.section='Flashings'  ";
	// $result = mysql_fetch_assoc(mysql_query ($sql));
	// $num_flashings = $result["count"];  
	if(mysql_num_rows($resultpo)){
		mysql_data_seek($resultpo, 0);
	} 
	global $unprocess_flashings;
	while($row = mysql_fetch_assoc($resultpo)){ 
		if($row["section"]=="Flashings"){
			$unprocess_flashings = 0; 
		}
	}
	    
	// $sql = "SELECT COUNT(i.cf_id) as count FROM ver_chronoforms_data_contract_bom_vic AS i LEFT JOIN ver_chronoforms_data_inventory_vic AS inv ON inv.inventoryid=i.inventoryid  WHERE i.projectid = '$projectid' AND inv.section='Downpipe'  ";
	// $result = mysql_fetch_assoc(mysql_query ($sql));
	// $num_downpipe = $result["count"];  
	if(mysql_num_rows($resultpo)){
		mysql_data_seek($resultpo, 0);
	} 
	global $unprocess_downpipe;   
	while($row = mysql_fetch_assoc($resultpo)){ 
		if($row["section"]=="Downpipe"){
			$unprocess_downpipe = 0; 
		}
	}

	// $sql = "SELECT COUNT(i.cf_id) as count FROM ver_chronoforms_data_contract_bom_vic AS i LEFT JOIN ver_chronoforms_data_inventory_vic AS inv ON inv.inventoryid=i.inventoryid  WHERE i.projectid = '$projectid' AND inv.section='Vergola'  ";
	// $result = mysql_fetch_assoc(mysql_query ($sql));
	// $num_vergola = $result["count"];  
	if(mysql_num_rows($resultpo)){
		mysql_data_seek($resultpo, 0);
	}
	global $unprocess_vergola; 
	while($row = mysql_fetch_assoc($resultpo)){ 
		if($row["section"]=="Vergola"){
			$unprocess_vergola = 0; 
		}
	}
	    
	// $sql = "SELECT COUNT(i.cf_id) as count FROM ver_chronoforms_data_contract_bom_vic AS i LEFT JOIN ver_chronoforms_data_inventory_vic AS inv ON inv.inventoryid=i.inventoryid  WHERE i.projectid = '$projectid' AND inv.section='Misc' ";
	// $result = mysql_fetch_assoc(mysql_query ($sql));
	// $num_misc = $result["count"];
	if(mysql_num_rows($resultpo)){ 
		mysql_data_seek($resultpo, 0);
	}
	global $unprocess_misc; 
	while($row = mysql_fetch_assoc($resultpo)){ 
		if($row["section"]=="Misc"){
			$unprocess_misc = 0; 
		}
	}

	// $sql = "SELECT COUNT(i.cf_id) as count FROM ver_chronoforms_data_contract_bom_vic AS i LEFT JOIN ver_chronoforms_data_inventory_vic AS inv ON inv.inventoryid=i.inventoryid  WHERE i.projectid = '$projectid' AND inv.section='Extras' ";
	// $result = mysql_fetch_assoc(mysql_query ($sql));
	// $num_extras = $result["count"];
	if(mysql_num_rows($resultpo)){
		mysql_data_seek($resultpo, 0);
	}  
	global $unprocess_extras; 
	while($row = mysql_fetch_assoc($resultpo)){ 
		if($row["section"]=="Extras"){
			$unprocess_extras = 0; 
		}
	}

	// $sql = "SELECT COUNT(i.cf_id) as count FROM ver_chronoforms_data_contract_bom_vic AS i LEFT JOIN ver_chronoforms_data_inventory_vic AS inv ON inv.inventoryid=i.inventoryid  WHERE i.projectid = '$projectid' AND inv.section='Disbursements' ";
	// $result = mysql_fetch_assoc(mysql_query ($sql));
	// $num_disbursements = $result["count"];  
	if(mysql_num_rows($resultpo)){
		mysql_data_seek($resultpo, 0);
	}  
	global $unprocess_disbursements; 
	while($row = mysql_fetch_assoc($resultpo)){ 
		if($row["section"]=="Disbursements"){
			$unprocess_disbursements = 0;
		}
	}
	     
	//print_r($num_framework); return;
  
	$notification = "";
	if($is_error && count($error_messages)){
		$notification = "<ul>";
		for($k=0; $k<count($error_messages);$k++){
			$notification .="<li>" .$error_messages[$k]."</li>";
		}
		$notification .= "</ul>";
	}
 	
 	?>  
 	 

 	<!----------- ADD ITEM ---------->
 	<form method="post"  >
 		
 		<div class="" style="display:inline-block;">		
  		<!-- <button class="btn" name="close"> Close </button> &nbsp; -->
  	 	
  	 	<!-- -------------------  BUTTON NAVIGATION ----------------------------- -->  		 
  		<?php echo "<a href=\"".JURI::base()."contract-listing-vic/contract-folder-vic/contract-folder-vic?quoteid=".$quoteid."&projectid=".$projectid."\" class='btn '>&nbsp;&nbsp; Contract Details &nbsp;&nbsp;</a>&nbsp;"; ?>
  		<?php echo "<a href=\"".JURI::base()."view-quote-vic?ref=back&quoteid=".$quoteid."&projectid=".$projectid."&ref_page=contracts&page_name=quote_details\" class='btn '>&nbsp;&nbsp; Quote Details &nbsp;&nbsp;</a>&nbsp;"; ?>
  		<?php echo "<a href=\"".JURI::base()."contract-listing-vic/contract-folder-vic/contract-bom-vic?quoteid=".$quoteid."&projectid=".$projectid."\" class='btn ".($page_name=="bom"?"btn-disabled":"")."'>&nbsp;&nbsp; BOM &nbsp;&nbsp;</a>&nbsp;"; ?>
  		<?php echo "<a href=\"".JURI::base()."contract-listing-vic/contract-folder-vic/contract-po-vic?quoteid=".$quoteid."&projectid=".$projectid."&page_name=po\" class='btn '>&nbsp;&nbsp; PO &nbsp;&nbsp;</a>&nbsp;"; ?>
  		<?php echo "<a href=\"".JURI::base()."contract-listing-vic/contract-folder-vic/contract-po-vic?quoteid=".$quoteid."&projectid=".$projectid."&page_name=po&view=summary\" class='btn '>&nbsp;&nbsp; PO Summary &nbsp;&nbsp;</a>&nbsp;"; ?>
  		<?php echo "<a href=\"".JURI::base()."contract-listing-vic/contract-folder-vic/contract-folder-vic?quoteid=".$quoteid."&projectid=".$projectid."&tab=checklist\" class='btn '>&nbsp;&nbsp; Check List &nbsp;&nbsp;</a>&nbsp;"; ?> 
  		<!-- -------------------  BUTTON NAVIGATION ----------------------------- -->


  	</div>	
  	<br/><br/>
  	<h2 style="display:inline-block;">
  		<span>Project Name: <?php echo " ".$ListProjName; ?></span> 
  		<span>Contract ID: <?php echo " ".$ListProjectID; ?> &nbsp;&nbsp;</span> 
  	</h2>
 		<?php if(strlen($notification)){ ?><div class="notification-area alert-warning"><?php echo $notification; ?></div><?php } ?>
		<div class="add-row"> 
		<?php
			//error_log("PAGE NAME:".$page_name, 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_us\\my-error.log');
			echo "
				<input type='hidden' name='quoteid' value='{$quoteid}'> 
				<input type='hidden' name='projectid' value='{$projectid}'>  
				<input type='hidden' name='project_name' value='{$project_name}'> 
				<input type='hidden' name='framework_type' value='{$project_framework_type}'> 
				<input type='hidden' name='framework' value='{$project_framework}'>  
				<input type='hidden' name='is_reorder' id='is_reorder' value='0'>   
				";
		 	 
		 	echo "".list_products("inventoryid")."";
			echo "<input type='text' name='qty' value='' class='number' placeholder='Qty' /> "; 

			echo "<input type='text' name='length' id='length'  value='' class='number' placeholder='Length'  ".(METRIC_SYSTEM=="inch"?"style='display:none;'":"")." /> ";  
			if(METRIC_SYSTEM=="inch"){
				echo "<input type='text' name='' id='length_ft'  value='' class='number' placeholder='Ft' style='width:60px'  /> ";
				echo "<input type='text' name='' id='length_in'  value='' class='number' placeholder='In' style='width:60px' /> ";
			}
			echo "".list_colours("colour").""; 
		  	echo "<input type='submit' name='add_product'  value='&nbsp;&nbsp; Add Product &nbsp;&nbsp;'   />";

		?>
	 	</div>
	</form>  

 

	
	<form method="post" class="<?php if($unprocess_framework){echo '';} else echo 'disable-form-input'; ?>" action="">
	<input type='hidden' name='section_type' value='framework'  >  
	<input type='hidden' name='clientid' value='<?php echo $quoteid;?>'  > 
	<table class="listing-table ">
    <thead>
    	<tr>
    		<td colspan="8" class="subheading" data-section='Frame' >
				Framework &nbsp;&nbsp;  
				<?php $unprocess_framework?$disabled="":$disabled="disabled='disabled'"; ?>
				<?php if($has_framework){ ?>
					<input type='submit' name='process_bom' <?php echo $disabled; ?> value='Process Order' onclick="$('.is-process-bom').val('1');" class='btn' /> 					
				<?php } ?> 

				<input type="hidden" name="is_process_bom" class="is-process-bom"  /> 
				<input type="submit" value="Save" name="update_products" class="btn btn-save-modification" style="display:none;" onclick="$('.is-modified').val('1');" />
				<input type="hidden" name="is_modified" value="0" class="is-modified" />

				<a href="javascript:void(0);" class="btn hide" onclick="$(this).closest('form').children('table').children('tbody').children('tr').children('td').children('select').prop('disabled', false);   " ></a>
				<?php if($unprocess_framework<1){ ?>
					<input type="submit" value="Cancel Order" name="remove_products" class="btn " onclick="$(this).closest('form').children('table').children('tbody').children('tr').children('td').children('select').prop('disabled', false);  $('.is-remove').val('1');" />
					<input type="hidden" name="is_remove" value="0" class="is-remove" /> 

				<?php } ?>
    		</td>
    	</tr>
    	<?php if($has_framework){ ?>
    	<tr><th style="width:214px;">Description</th><th style="width:6%;">UOM</th><th style="width:7%;">QTY</th><th style="width:10%;">Length</th><th style="width:10%;">Colour</th><th style="width:10%;">Finish</th> <th style="width:10%;">Image</th><th style="width:10%;">Delete</th></tr>
    	<?php } ?>
    </thead>
    <tbody> 
		<?php
		mysql_data_seek($resultquotes, 0); 
		while($row = mysql_fetch_assoc($resultquotes)){

			if($row["section"]=="Frame" || $row["section"]=="Posts"){
				echo "<tr> 
						<input type='hidden' name='cf_id[]' value='".$row["id"]."' class='cf_id'> 
						<input type='hidden' name='quoteid[]' value='".$row["quoteid"]."'> 
						<input type='hidden' name='projectid[]' value='".$row["projectid"]."'> 
						<input type='hidden' name='framework[]' value='".$row["framework"]."'>
						<input type='hidden' name='framework_type[]' value='".$row["framework_type"]."'>
						<input type='hidden' name='description[]' value='".$row["description"]."' class='inv_desc'>
						<input type='hidden' name='uom[]' value='".$row["uom"]."'>
						<input type='hidden' name='cost[]' value='".$row["cost"]."'>
						<input type='hidden' name='rrp[]' value='".$row["rrp"]."'>
						<input type='hidden' name='is_delete[]' value='0' class='is_delete'> 
						<input type='hidden' name='section[]' value='".$row["section"]."' >
						<input type='hidden' name='category[]' value='".$row["category"]."' > 
						<input type='hidden' class='delete_product_id' name='delete_product_id' value='' > 
					";

				//error_log(print_r($row,true), 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_us\\my-error.log');	
				if($row["section"]=="Frame" && ($row["category"]=="Posts" || $row["category"]=="Beams" || $row["category"]=="Intermediate" || $row["category"]=="Beam Fixings")){
					echo "<td class=\"td-item\"> ".products("inventoryid[]",$row['inventoryid'],'framework', $row["category"])." 
						<input type=\"hidden\"   class=\"price\"  category=\"{$row['category']}\" rrp=\"{$row['rrp']}\"   /> </td>";   
				}else{
					echo "<td class=\"td-item\"> ".$row['description']." <input type=\"hidden\" name='inventoryid[]' class=\"price\" value=\"{$row['inventoryid']}\" category=\"{$row['category']}\" rrp=\"{$row['rrp']}\"   /> </td>";  
				}
				
				echo "<td  > {$row["uom"]}  </td>"; 
				
				echo "<td> <input type='text' name='qty[]' value='".number_format($row["qty"])."' class='number' /> </td>"; 
				 
				echo "<td class=\"td-len\"> <input type='text' name='length[]' value='{$row["length"]}' class='number input-size input-in' style='".(($row['uom']=="Ea")?($row['category']!="Posts"?"display:none;":""):"")."' /> </td>";

				if(METRIC_SYSTEM=="inch"){
					echo "<td> <input type='text' name='' value='".get_feet_value($row["length"])."' class='number input-ft' style='".(($row['uom']=="Ea")?($row['category']!="Posts"?"display:none;":""):"")."' /> </td>"; 
				}else{
					echo "<td> <input type='text' name='' value='{$row["length"]}' class='number input-in' style='".(($row['uom']=="Ea")?($row['category']!="Posts"?"display:none;":""):"")."' /> </td>"; 
				}

				if($row["category"]=="Posts" || $row["category"]=="Beams" || $row["category"]=="Intermediate"){
					echo "<td > ".list_colours("colour[]",$row["colour"])." </td>"; 
					echo "<td > ".list_colour_bond("finish[]",$row["finish"])."</td>"; 
				}else{
					echo "<td ><input type='hidden' name='colour[]' ></td>"; 
					echo "<td ><input type='hidden' name='finish[]' ></td>"; 
				}
				
				
				//echo "<td> ".list_suppliers("supplierid[]",$row["supplierid"])."</td>"; 
				if($row["photo"] !="") { //can't be use as of now bec. no photo record was included in inserting in ver_chronoforms_data_contract_items_vic from ver_chronoforms_data_inventory_vic table.
					echo "<td> 
							<img src=\"".JURI::base()."images/inventory/{$row['photo']}"."\" class='inv-image imagecrop' onmouseover=\"document.getElementById('PopUp-".$row['cf_id']."').style.display='block'\" onmouseout=\"document.getElementById('PopUp-".$row['cf_id']."').style.display='none'\"    onfocus='this.blur();'  />  
					 		<div id='PopUp-".$row['cf_id']."' class='imagepopup' ><img src=\"".JURI::base()."images/inventory/".$row['photo']."\" ></div>
					</td>"; 
				}else{
					echo "<td></td>"; 
				}
				$unprocess_framework?$disabled="":$disabled="disabled='disabled'";
				echo"<td style=\"width:10%;\"> 
						<input type=\"button\" class=\"btndel\"   {$disabled} value=\"Delete\" onclick='delete_product(event,this,{$row["id"]})'> 

					</td>";
				echo "</tr>";
			}
		}
		?> 
		
	</tbody>
	</table>
	</form>
 

	<form method="post" action="" class="<?php if($unprocess_fittings){echo '';} else echo 'disable-form-input'; ?> ">
	<input type='hidden' name='section_type' value='fittings'  > 
	<input type='hidden' name='clientid' value='<?php echo $quoteid;?>'  >
	<table class="listing-table" >
    <thead>
    	<tr>	
    		<!-- <td colspan="9" class="subheading">Fittings &nbsp;&nbsp; <?php if($has_fittings){ $unprocess_fittings?$disabled="":$disabled="disabled='disabled'"; echo "<input type='submit' name='process_bom' {$disabled} value='Process Order'/>";}  ?> </td></tr>    	 -->
    		<td colspan="8" class="subheading" data-section='Frame' >
				Fittings &nbsp;&nbsp;  
				<?php $unprocess_fittings?$disabled="":$disabled="disabled='disabled'"; ?>
				<?php if($has_fittings){ ?>
					<input type='submit' name='process_bom' <?php echo $disabled; ?> value='Process Order' onclick="$('.is-process-bom').val('1');" class='btn' /> 
				<?php } ?>				
				<input type="hidden" name="is_process_bom" class="is-process-bom"  /> 
				<input type="submit" value="Save" name="update_products" class="btn btn-save-modification" style="display:none;" onclick="$('.is-modified').val('1');" />
				<input type="hidden" name="is_modified" value="0" class="is-modified" /> 

				<?php if($unprocess_fittings<1){ ?>
					<input type="submit" value="Cancel Order" name="remove_products" class="btn " onclick="$('.is-remove').val('1');" />
					<input type="hidden" name="is_remove" value="0" class="is-remove" /> 
				<?php } ?>
    		</td>
    	</tr>	
    	<?php if($has_fittings){ ?>
    	<tr><th style="width:214px;">Description</th><th style="width:6%;">UOM</th><th style="width:7%;">QTY</th><th style="width:10%;">Length</th><th style="width:10%;">Colour</th><th style="width:10%;">Finish</th> <th style="width:10%;">Image</th><th style="width:10%;">Delete</th></tr>
    	<?php } ?>
    </thead>
    <tbody>
		<?php 
		mysql_data_seek($resultquotes, 0); 
		while($row = mysql_fetch_assoc($resultquotes)){

			if(strtolower($row["section"])=="fixings" ){
				echo "<tr>  
						<input type='hidden' name='cf_id[]' value='".$row["id"]."'> 
						<input type='hidden' name='quoteid[]' value='".$row["quoteid"]."'> 
						<input type='hidden' name='projectid[]' value='".$row["projectid"]."'> 
						<input type='hidden' name='framework[]' value='".$row["framework"]."'>
						<input type='hidden' name='framework_type[]' value='".$row["framework_type"]."'>
						<input type='hidden' name='description[]' value='".$row["description"]."'  >
						<input type='hidden' name='uom[]' value='".$row["uom"]."'>
						<input type='hidden' name='cost[]' value='".$row["cost"]."'>
						<input type='hidden' name='rrp[]' value='".$row["rrp"]."'> 
						<input type='hidden' name='section[]' value='".$row["section"]."' >
						<input type='hidden' name='category[]' value='".$row["category"]."' >
						<input type='hidden' class='delete_product_id' name='delete_product_id' value='' >  
					";
				//echo "<td> ".products("inventoryid[]",$row['inventoryid'],'fixings')."  </td>"; 
				echo "<td> ".$row['description']." <input type='hidden' name='inventoryid[]' value='{$row['inventoryid']}' />  </td>"; 	
				echo "<td> {$row["uom"]} </td>"; 
				echo "<td> <input type='text' name='qty[]' value='".number_format($row["qty"])."' class='number' /> </td>"; 
				echo "<td class='td-len'> <input type='text' name='length[]' value='{$row["length"]}' class='number input-size input-in' /> </td>";  
				if(METRIC_SYSTEM=="inch"){
					echo "<td> <input type='text' name='' value='".get_feet_value($row["length"])."' class='number input-ft' /> </td>"; 
				}else{
					echo "<td> <input type='text' name='' value='".$row["length"]."' class='number input-in' /> </td>";
				}

				echo "<td> ".list_colours("colour[]",$row["colour"])." </td>"; 
				echo "<td> ".list_colour_bond("finish[]",$row["finish"])."</td>"; 
				//echo "<td> ".list_suppliers("supplierid[]",$row["supplierid"])."</td>"; 
				if($row["photo"] !="") { //can't be use as of now bec. no photo record was included in inserting in ver_chronoforms_data_contract_items_vic from ver_chronoforms_data_inventory_vic table.
					echo "<td> 
						
							<img src=\"".JURI::base()."images/inventory/{$row['photo']}"."\" class='inv-image' onmouseover=\"document.getElementById('PopUp-".$row['cf_id']."').style.display='block'\" onmouseout=\"document.getElementById('PopUp-".$row['cf_id']."').style.display='none'\"    onfocus='this.blur();' />  
						 	<div id='PopUp-".$row['cf_id']."' class='imagepopup' ><img src=\"".JURI::base()."images/inventory/".$row['photo']."\" ></div>
					</td>"; 				
				}else{
					echo "<td></td>"; 
				}
				$unprocess_fittings?$disabled="":$disabled="disabled='disabled'";
				echo"<td style=\"width:10%;\"><input type=\"submit\" class=\"btndel\" name=\"del\" {$disabled} value=\"Delete\" onclick='delete_product(event,this,{$row["id"]})'></td>";
				echo "</tr>";
			}
		}	
		?> 
	</tbody>
	</table>

	</form>


<!-- FOR GUTTERS -->
	<form method="post" class="<?php if($unprocess_gutters){echo '';} else echo 'disable-form-input'; ?>" action=""> 
	<input type='hidden' name='section_type' value='gutters'  >
	<input type='hidden' name='clientid' value='<?php echo $quoteid;?>'  > 
	<table class="listing-table">
    <thead>
    	<!-- <tr><td colspan="9" class="subheading">Gutters &nbsp;&nbsp; <?php if($has_gutters){ $unprocess_gutters?$disabled="":$disabled="disabled='disabled'"; echo "<input type='submit' name='process_bom' {$disabled} value='Process Order'/>";}  ?></td></tr> -->
    	<tr>
    		<td colspan="8" class="subheading" data-section='Frame' >
				Gutters &nbsp;&nbsp;  
				<?php $unprocess_gutters?$disabled="":$disabled="disabled='disabled'"; ?>
				<?php if($has_gutters){ ?>
					<input type='submit' name='process_bom' <?php echo $disabled; ?> value='Process Order' onclick="$('.is-process-bom').val('1');" class='btn' /> 
				<?php } ?>
				
				<input type="hidden" name="is_process_bom" class="is-process-bom"  /> 
				<input type="submit" value="Save" name="update_products" class="btn btn-save-modification" style="display:none;" onclick="$('.is-modified').val('1');" />
				<input type="hidden" name="is_modified" value="0" class="is-modified" /> 
				
				<?php if($unprocess_gutters<1){ ?>
					<input type="submit" value="Cancel Order" name="remove_products" class="btn " onclick="$('.is-remove').val('1');" />
					<input type="hidden" name="is_remove" value="0" class="is-remove" /> 
				<?php } ?>
    		</td>
    	</tr>
    	<?php if($has_gutters){ ?>
    	<tr><th style="width:214px;">Description</th><th style="width:6%;">UOM</th><th style="width:7%;">QTY</th><th style="width:10%;">Length</th><th style="width:10%;">Colour</th><th style="width:10%;">Finish</th> <th style="width:10%;">Image</th><th style="width:10%;">Delete</th></tr>
    	<?php } ?>
    </thead>
    <tbody> 
		<?php	

		mysql_data_seek($resultquotes, 0); 
		while($row = mysql_fetch_assoc($resultquotes)){

			if($row["section"]=="Guttering"){
				$unprocess_gutters?$disabled="":$disabled="disabled='disabled'";
				$disabled_save = "";
				if($unprocess_gutters==false) $disabled_save = "&disabled";
				echo "<tr>  
						<input type='hidden' name='cf_id[]' value='".$row["id"]."' class='cf_id'> 
						<input type='hidden' name='quoteid[]' value='".$row["quoteid"]."'> 
						<input type='hidden' name='projectid[]' value='".$row["projectid"]."'> 
						<input type='hidden' name='framework[]' value='".$row["framework"]."'>
						<input type='hidden' name='framework_type[]' value='".$row["framework_type"]."'>
						<input type='hidden' name='description[]' value='".$row["description"]."'>
						<input type='hidden' name='uom[]' value='".$row["uom"]."'>
						<input type='hidden' name='cost[]' value='".$row["cost"]."'>
						<input type='hidden' name='rrp[]' value='".$row["rrp"]."'> 
						<input type='hidden' name='section[]' value='".$row["section"]."' >
						<input type='hidden' name='category[]' value='".$row["category"]."' > 
						<input type='hidden' class='delete_product_id' name='delete_product_id' value='' > 
					";
				echo "<td> ".products("inventoryid[]",$row['inventoryid'],"guttering")."  </td>"; 
				echo "<td> {$row["uom"]} </td>"; 
				echo "<td> <input type='text' name='qty[]' value='".number_format($row["qty"])."' class='number' /> </td>"; 
				echo "<td class='td-len'> <input type='text' name='length[]' value='{$row["length"]}' class='number input-size input-in' /> </td>";  
				if(METRIC_SYSTEM=="inch"){
					echo "<td> <input type='text' name='' value='".get_feet_value($row["length"])."' class='number input-ft' /> </td>"; 
				}else{
					echo "<td> <input type='text' name='' value='".$row["length"]."' class='number input-in' /> </td>";
				}

				echo "<td> ".list_colours("colour[]",$row["colour"])." </td>"; 
				echo "<td> ".list_colour_bond("finish[]",$row["finish"],"Guttering")."</td>"; 
				//echo "<td> ".list_suppliers("supplierid[]",$row["supplierid"])."</td>"; //onclick='get_item_dimension(event,this,\"Guttering\")'
				 //can't be use as of now bec. no photo record was included in inserting in ver_chronoforms_data_contract_items_vic from ver_chronoforms_data_inventory_vic table.
					echo "<td> 
						<a onclick=\"javascript:lightbox(null,'".JURI::base()."/contract-listing-vic/contract-folder-vic/contract-bom-vic/?get_item_dimension&cf_id={$row["id"]}{$disabled_save}')"."\"  class='inv-link' >";
							if($row["photo"] !="") {
								echo "<img src=\"".JURI::base()."images/inventory/{$row['photo']}"."\" class='inv-image' /> ";
							}else{
								echo "  "; 
							}		
							echo "<div id='PopUp-".$row['cf_id']."' class='imagepopup' ><img src=\"".JURI::base()."images/inventory/".$row['photo']."\" ></div> 
							<span>Input dimension</span>
						</a>
					</td>";	

					// <a onclick="javascript:lightbox(null, ' ')" id="link">Link Supplier</a>			
				
				
				echo"<td style=\"width:10%;\"><input type=\"submit\" class=\"btndel\" name=\"del\" {$disabled} value=\"Delete\" onclick='delete_product(event,this,{$row["id"]})'></td>";
				echo "</tr>";
			}
		}	
		?> 
	</tbody>
	</table>
	</form>


	<form method="post" class="<?php if($unprocess_flashings){echo '';} else echo 'disable-form-input'; ?>" action=""> 
	<input type='hidden' name='section_type' value='flashings'  > 
	<input type='hidden' name='clientid' value='<?php echo $quoteid;?>'  >
	<table class="listing-table">
    <thead>
    	<!-- <tr><td colspan="9" class="subheading" data-section='Frame' >Flashings &nbsp;&nbsp; <?php if($has_flashings){ $unprocess_flashings?$disabled="":$disabled="disabled='disabled'"; echo "<input type='submit' name='process_bom' {$disabled} value='Process Order'/>";}  ?> </td></tr> -->
    	<tr>
    		<td colspan="8" class="subheading" data-section='Frame' >
				Flashings &nbsp;&nbsp;  
				<?php $unprocess_flashings?$disabled="":$disabled="disabled='disabled'"; ?>
				<?php if($has_flashings){ ?>
					<input type='submit' name='process_bom' <?php echo $disabled; ?> value='Process Order' onclick="$('.is-process-bom').val('1');" class='btn' /> 
				<?php } ?>
				<input type="hidden" name="is_process_bom" class="is-process-bom"  /> 
				<input type="submit" value="Save" name="update_products" class="btn btn-save-modification" style="display:none;" onclick="$('.is-modified').val('1');" />
				<input type="hidden" name="is_modified" value="0" class="is-modified" /> 

				<?php if($unprocess_flashings<1){ ?>
					<input type="submit" value="Cancel Order" name="remove_products" class="btn " onclick="$('.is-remove').val('1');" />
					<input type="hidden" name="is_remove" value="0" class="is-remove" /> 
				<?php } ?>
    		</td>
    	</tr>
    	<?php if($has_flashings){ ?>
    	<tr><th style="width:214px;">Description</th><th style="width:6%;">UOM</th><th style="width:7%;">QTY</th><th style="width:10%;">Length</th><th style="width:10%;">Colour</th><th style="width:10%;">Finish</th> <th style="width:10%;">Image</th><th style="width:10%;">Delete</th></tr>
    	<?php } ?>
    </thead>
    <tbody> 
		<?php mysql_data_seek($resultquotes, 0);  
		while($row = mysql_fetch_assoc($resultquotes)){

			if($row["section"]=="Flashings"){
				$unprocess_flashings?$disabled="":$disabled="disabled='disabled'";
				$disabled_save = "";
				if($unprocess_flashings==false) $disabled_save = "&disabled";
				echo "<tr>  
						<input type='hidden' name='cf_id[]' value='".$row["id"]."'> 
						<input type='hidden' name='quoteid[]' value='".$row["quoteid"]."'> 
						<input type='hidden' name='projectid[]' value='".$row["projectid"]."'> 
						<input type='hidden' name='framework[]' value='".$row["framework"]."'>
						<input type='hidden' name='framework_type[]' value='".$row["framework_type"]."'>
						<input type='hidden' name='description[]' value='".$row["description"]."'>
						<input type='hidden' name='uom[]' value='".$row["uom"]."'>
						<input type='hidden' name='cost[]' value='".$row["cost"]."'>
						<input type='hidden' name='rrp[]' value='".$row["rrp"]."'>
						<input type='hidden' name='section[]' value='".$row["section"]."' >
						<input type='hidden' name='category[]' value='".$row["category"]."' > 
						<input type='hidden' class='delete_product_id' name='delete_product_id' value='' > 


					";
				//echo "<td> ".products("inventoryid[]",$row['inventoryid'],"flashings")."  </td>"; 
				echo "<td> ".products("inventoryid[]",$row['inventoryid'],"Flashings")."   </td>"; 
				echo "<td> {$row["uom"]} </td>"; 
				echo "<td> <input type='text' name='qty[]' value='".number_format($row["qty"])."' class='number' /> </td>"; 
				echo "<td class='td-len'> <input type='text' name='length[]' value='{$row["length"]}' class='number input-size input-in' /> </td>";  
				if(METRIC_SYSTEM=="inch"){
					echo "<td> <input type='text' name='' value='".get_feet_value($row["length"])."' class='number input-ft' /> </td>"; 
				}else{
					echo "<td> <input type='text' name='' value='{$row["length"]}' class='number input-in' /> </td>"; 
				}
				echo "<td> ".list_colours("colour[]",$row["colour"])." </td>"; 
				echo "<td> ".list_colour_bond("finish[]",$row["finish"],"Guttering")."</td>"; 
				//echo "<td> ".list_suppliers("supplierid[]",$row["supplierid"])."</td>"; 
				if($row["photo"] !="") { //can't be use as of now bec. no photo record was included in inserting in ver_chronoforms_data_contract_items_vic from ver_chronoforms_data_inventory_vic table.
					echo "<td> 
						<a onclick=\"javascript:lightbox(null,'".JURI::base()."/contract-listing-vic/contract-folder-vic/contract-bom-vic/?get_item_dimension&cf_id={$row["id"]}{$disabled_save}')"."\"  class='inv-link'>
							<img src=\"".JURI::base()."images/inventory/{$row['photo']}"."\" class='inv-image' /> 
							<div id='PopUp-".$row['cf_id']."' class='imagepopup' ><img src=\"".JURI::base()."images/inventory/".$row['photo']."\" ></div>	 
							<span>Input dimension</span>
						</a>
 
					</td>";							
				}else{
					echo "<td></td>"; 
				}
				//$unprocess_flashings?$disabled="":$disabled="disabled='disabled'";
				echo"<td style=\"width:10%;\"><input type=\"submit\" class=\"btndel\" name=\"del\" {$disabled} value=\"Delete\" onclick='delete_product(event,this,{$row["id"]})'></td>";
				echo "</tr>";
			}
		}
		?>
		
	</tbody>
	</table>
	</form>	


	<form method="post" class="<?php if($unprocess_downpipe){echo '';} else echo 'disable-form-input'; ?>" action=""> 
	<input type='hidden' name='section_type' value='downpipe'  > 
	<input type='hidden' name='clientid' value='<?php echo $quoteid;?>'  >
	<table class="listing-table">
    <thead>
    	<!-- <tr><td colspan="9" class="subheading" data-section='Frame' >Downpipe &nbsp;&nbsp; <?php if($has_downpipe){ $unprocess_downpipe?$disabled="":$disabled="disabled='disabled'"; echo "<input type='submit' name='process_bom' {$disabled} value='Process Order'/>";}  ?>  </td></tr> -->
    	<tr>
    		<td colspan="8" class="subheading" data-section='Frame' >
				Downpipe &nbsp;&nbsp;  
				<?php $unprocess_downpipe?$disabled="":$disabled="disabled='disabled'"; ?>
				<?php if($has_downpipe){ ?>
					<input type='submit' name='process_bom' <?php echo $disabled; ?> value='Process Order' onclick="$('.is-process-bom').val('1');" class='btn' /> 
				<?php } ?>
				<input type="hidden" name="is_process_bom" class="is-process-bom"  />
				<input type="submit" value="Save" name="update_products" class="btn btn-save-modification" style="display:none;" onclick="$('.is-modified').val('1');" />
				<input type="hidden" name="is_modified" value="0" class="is-modified" />

				<?php if($unprocess_downpipe<1){ ?>
					<input type="submit" value="Cancel Order" name="remove_products" class="btn " onclick="$('.is-remove').val('1');" />
					<input type="hidden" name="is_remove" value="0" class="is-remove" />
				<?php } ?>
    		</td>
    	</tr>
    	<?php if($has_downpipe){ ?>
    	<tr><th style="width:214px;">Description</th><th style="width:6%;">UOM</th><th style="width:7%;">QTY</th><th style="width:10%;">Length</th><th style="width:10%;">Colour</th><th style="width:10%;">Finish</th> <th style="width:10%;">Image</th><th style="width:10%;">Delete</th></tr>
    	<?php } ?>
    </thead>
    <tbody>		
		<?php

		mysql_data_seek($resultquotes, 0); 
		while($row = mysql_fetch_assoc($resultquotes)){

			if($row["section"]=="Downpipe"){
				echo "<tr>  
						<input type='hidden' name='cf_id[]' value='".$row["id"]."'> 
						<input type='hidden' name='quoteid[]' value='".$row["quoteid"]."'> 
						<input type='hidden' name='projectid[]' value='".$row["projectid"]."'>  
						<input type='hidden' name='framework[]' value='".$row["framework"]."'>
						<input type='hidden' name='framework_type[]' value='".$row["framework_type"]."'>
						<input type='hidden' name='description[]' value='".$row["description"]."'>
						<input type='hidden' name='uom[]' value='".$row["uom"]."'>
						<input type='hidden' name='cost[]' value='".$row["cost"]."'>
						<input type='hidden' name='rrp[]' value='".$row["rrp"]."'>
						<input type='hidden' name='section[]' value='".$row["section"]."' >
						<input type='hidden' name='category[]' value='".$row["category"]."' > 
						<input type='hidden' class='delete_product_id' name='delete_product_id' value='' >  

					";
				//echo "<td> ".products("inventoryid[]",$row['inventoryid'],"downpipe")."  </td>"; 
				echo "<td> ".$row['description']."  <input type='hidden' name='inventoryid[]' value='{$row['inventoryid']}' /> </td>";	
				echo "<td> {$row["uom"]} </td>"; 
				echo "<td> <input type='text' name='qty[]' value='".number_format($row["qty"])."' class='number' /> </td>"; 
			 
				echo "<td class='td-len'> <input type='text' name='length[]' value='{$row["length"]}' class='number input-size input-in' style='".($row['uom']=="Ea"?"display:none;":"")."' /> </td>";  
				if(METRIC_SYSTEM=="inch"){
					echo "<td> <input type='text' name='' value='".get_feet_value($row["length"])."' class='number input-ft' style='".($row['uom']=="Ea"?"display:none;":"")."' /> </td>"; 
				}else{
					echo "<td> <input type='text' name='' value='{$row["length"]}' class='number input-in' /> </td>"; 
				}

				echo "<td><input type='hidden' name='colour[]' disabled='disabled'></td>"; 
					echo "<td><input type='hidden' name='finish[]' disabled='disabled'></td>"; 
				//echo "<td> ".list_suppliers("supplierid[]",$row["supplierid"])."</td>"; 
				if($row["photo"] !="") { //can't be use as of now bec. no photo record was included in inserting in ver_chronoforms_data_contract_items_vic from ver_chronoforms_data_inventory_vic table.
					echo "<td> 						
							<img src=\"".JURI::base()."images/inventory/{$row['photo']}"."\" class='inv-image' onmouseover=\"document.getElementById('PopUp-".$row['cf_id']."').style.display='block'\" onmouseout=\"document.getElementById('PopUp-".$row['cf_id']."').style.display='none'\"    onfocus='this.blur();' />  						 
							<div id='PopUp-".$row['cf_id']."' class='imagepopup' ><img src=\"".JURI::base()."images/inventory/".$row['photo']."\" ></div>
					</td>";						
				}else{
					echo "<td></td>"; 
				}
				$unprocess_downpipe?$disabled="":$disabled="disabled='disabled'";
				echo"<td style=\"width:10%;\"><input type=\"submit\" class=\"btndel\" name=\"del\" {$disabled} value=\"Delete\" onclick='delete_product(event,this,{$row["id"]})'></td>";
				echo "</tr>";
			}
		}
		?>
		
	</tbody>
	</table>	
	</form>


 	<form method="post" class="<?php if($unprocess_vergola){echo '';} else echo 'disable-form-input'; ?>" action=""> 
 	<input type='hidden' name='section_type' value='vergola'  > 
 	<input type='hidden' name='clientid' value='<?php echo $quoteid;?>'  >
	<table class="listing-table">
    <thead>
    	<!-- <tr><td colspan="9" class="subheading" data-section='Frame' >Vergola System &nbsp;&nbsp; <?php if($has_vergola){ $unprocess_vergola?$disabled="":$disabled="disabled='disabled'"; echo "<input type='submit' name='process_bom' {$disabled} value='Process Order'/>";}  ?> </td></tr> -->
    	<tr>
    		<td colspan="8" class="subheading" data-section='Frame' >
				Vergola System &nbsp;&nbsp;  
				<?php $unprocess_vergola?$disabled="":$disabled="disabled='disabled'"; ?>
				<?php if($has_vergola){ ?>
					<input type='submit' name='process_bom' <?php echo $disabled; ?> value='Process Order' onclick="$('.is-process-bom').val('1');" class='btn' /> 
				<?php } ?>
				<input type="hidden" name="is_process_bom" class="is-process-bom"  /> 
				<input type="submit" value="Save" name="update_products" class="btn btn-save-modification" style="display:none;" onclick="$('.is-modified').val('1');" />
				<input type="hidden" name="is_modified" value="0" class="is-modified" /> 

				<?php if($unprocess_vergola<1){ ?>
					<input type="submit" value="Cancel Order" name="remove_products" class="btn " onclick="$('.is-remove').val('1');" />
					<input type="hidden" name="is_remove" value="0" class="is-remove" /> 
				<?php } ?>
    		</td>
    	</tr>
    	<?php if($has_vergola){ ?>
    	<tr><th style="width:214px;">Description</th><th style="width:6%;">UOM</th><th style="width:7%;">QTY</th><th style="width:10%;">Length</th><th style="width:10%;">Colour</th><th style="width:10%;">Finish</th> <th style="width:10%;">Image</th><th style="width:10%;">Delete</th></tr>
    	<?php } ?>    	
    </thead>
    <tbody> 
		<?php
		$isFirst = 1; $isFirstItem = 1;
		$k = 0; 
		mysql_data_seek($resultquotes, 0); 
		while($row = mysql_fetch_assoc($resultquotes)){
			if(fnmatch("*Single Bay VR*",$VergolaType)){
				$isFirstItem=1;//always set isfirst for VR1. this is for VR2
			}
			if($row["section"]=="Vergola"){
				echo "<tr>  
							<input type='hidden' name='cf_id[]' value='".$row["id"]."'> 
							<input type='hidden' name='quoteid[]' value='".$row["quoteid"]."'> 
							<input type='hidden' name='projectid[]' value='".$row["projectid"]."'> 
							<input type='hidden' name='framework[]' value='".$row["framework"]."'>
							<input type='hidden' name='framework_type[]' value='".$row["framework_type"]."'>
							<input type='hidden' name='description[]' value='".$row["description"]."'>
							<input type='hidden' name='uom[]' value='".$row["uom"]."'>
							<input type='hidden' name='cost[]' value='".$row["cost"]."'>
							<input type='hidden' name='rrp[]' value='".$row["rrp"]."'>
							<input type='hidden' name='section[]' value='".$row["section"]."' >
							<input type='hidden' name='category[]' value='".$row["category"]."' > 
							<input type='hidden' class='delete_product_id' name='delete_product_id' value='' > 

						";
				//echo "<td> ".products("inventoryid[]",$row['inventoryid'],"vergola")."  </td>"; 
				$item_id = "";  $qty_class = ""; $len_class = "";		
				if($row['category']=="Louvers"){
					echo "<td> ".products("inventoryid[]",$row['inventoryid'],"vergola")."  </td>"; 
					$qty_class = "louver-item-qty"; $len_class = "louver-item-len";
					if($isFirst==1){
						$item_id = "louver-qty";	 
					}else{
						$item_id = "louver-qty-2";
					}
				}else{
					echo "<td> ".$row['description']." <input type='hidden' name='inventoryid[]' value='{$row['inventoryid']}' /> </td>"; 
				}

				
				if($row['inventoryid']=="IRV58"){
					$item_id = "endcap-qty";	
				}
				else if(fnmatch("*Double Bay VR*",$VergolaType) && $row['inventoryid']=="IRV59"){					
					
					if ($isFirstItem==1){ 	//fnmatch("*Single Bay VR*",$VergolaType) &&
						$item_id = "pivot-qty";	
						$isFirstItem = 0;
						//error_log("here1", 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_us\\my-error.log');
					}else{
						$item_id = "pivot-qty-2";
						$isFirstItem = 1; //back to be default as 1 for 2nd IRV60 if it is 1st or 2nd.
					}	
				}else if(fnmatch("*Double Bay VR*",$VergolaType) && $row['inventoryid']=="IRV60"){
					if ( $isFirstItem==1){ //fnmatch("*Single Bay VR*",$VergolaType) &&
						$item_id = "linkBar-qty";	
						$isFirstItem=0;
					}else{
						$item_id = "linkBar-qty-2";	

					}
				}				
					
				echo "<td> {$row["uom"]} </td>"; 
				echo "<td> <input type='text' name='qty[]' value='".number_format($row["qty"])."' class='number {$qty_class}' id='{$item_id}' /> </td>"; 
				echo "<td class='td-len'> <input type='text' name='length[]' value='{$row["length"]}' class='number input-size input-in {$len_class}' style='".($row['uom']=="Ea"?"display:none;":"")."' /> </td>";
				 
				if(METRIC_SYSTEM=="inch"){
					echo "<td > <input type='text' name='' value='".get_feet_value($row["length"])."' class='number input-ft' style='".($row['uom']=="Ea"?"display:none;":"")."' /> </td>";
				}else{
					echo "<td  > <input type='text' name='hh' value='{$row["length"]}' class='number input-in {$len_class}' /> </td>";
				}

				if($row["colour"]!=""){ //$row['category']=="Louvers"
					echo "<td> ".list_colours("colour[]",$row["colour"])."  </td>"; 
					echo "<td> ".list_colour_bond("finish[]",$row["finish"],"Vergola")."</td>"; 
				}else{
					echo "<td><input type='hidden' name='colour[]'  ></td>"; 
					echo "<td><input type='hidden' name='finish[]'  ></td>"; 
				}
				
				//echo "<td> ".list_suppliers("supplierid[]",$row["supplierid"])."</td>"; 
				if($row["photo"] !="") { //can't be use as of now bec. no photo record was included in inserting in ver_chronoforms_data_contract_items_vic from ver_chronoforms_data_inventory_vic table.
					echo "<td> 						
							<img src=\"".JURI::base()."images/inventory/{$row['photo']}"."\" class='inv-image' onmouseover=\"document.getElementById('PopUp-".$row['cf_id']."').style.display='block'\" onmouseout=\"document.getElementById('PopUp-".$row['cf_id']."').style.display='none'\"    onfocus='this.blur();' />  						
							<div id='PopUp-".$row['cf_id']."' class='imagepopup' ><img src=\"".JURI::base()."images/inventory/".$row['photo']."\" ></div>
					</td>";						
				}else{
					echo "<td></td>"; 
				}
				$unprocess_vergola?$disabled="":$disabled="disabled='disabled'";
				echo"<td style=\"width:10%;\"><input type=\"submit\" class=\"btndel\" name=\"del\" {$disabled} value=\"Delete\" onclick='delete_product(event,this,{$row["id"]})'></td>";
				echo "</tr>";
				$isFirst = 0;
				$k++;	
			}
		}
		?> 		
	</tbody>
	</table>
	</form>


	<form method="post" class="<?php if($unprocess_misc){echo '';} else echo 'disable-form-input'; ?>" action=""> 
	<input type='hidden' name='section_type' value='misc'  > 
	<input type='hidden' name='clientid' value='<?php echo $quoteid;?>'  >
	<table class="listing-table">
    <thead>
    	<!-- <tr><td colspan="9" class="subheading" data-section='Frame' >Miscellaneous &nbsp;&nbsp; <?php if($has_misc){ $unprocess_misc?$disabled="":$disabled="disabled='disabled'"; echo "<input type='submit' name='process_bom' {$disabled} value='Process Order'/>";}  ?> </td></tr> -->
    	<tr>
    		<td colspan="8" class="subheading" data-section='Frame' >
				Miscellaneous &nbsp;&nbsp;  
				<?php $unprocess_misc?$disabled="":$disabled="disabled='disabled'"; ?>
				<?php if($has_misc){ ?>
					<input type='submit' name='process_bom' <?php echo $disabled; ?> value='Process Order' onclick="$('.is-process-bom').val('1');" class='btn' /> 
				<?php } ?>
				<input type="hidden" name="is_process_bom" class="is-process-bom"  /> 
				<input type="submit" value="Save" name="update_products" class="btn btn-save-modification" style="display:none;" onclick="$('.is-modified').val('1');" />
				<input type="hidden" name="is_modified" value="0" class="is-modified" /> 

				<?php if($unprocess_misc<1){ ?>
					<input type="submit" value="Cancel Order" name="remove_products" class="btn " onclick="$('.is-remove').val('1');" />
					<input type="hidden" name="is_remove" value="0" class="is-remove" /> 
				<?php } ?>
    		</td>
    	</tr>
    	<?php if($has_misc){ ?>
    	<tr><th style="width:214px;">Description</th><th style="width:6%;">UOM</th><th style="width:7%;">QTY</th><th style="width:10%;">Length</th><th style="width:10%;">Colour</th><th style="width:10%;">Finish</th> <th style="width:10%;">Image</th><th style="width:10%;">Delete</th></tr>
    	<?php } ?> 
    </thead>
    <tbody>		
		<?php 

		mysql_data_seek($resultquotes, 0); 
		while($row = mysql_fetch_assoc($resultquotes)){

			if($row["section"]=="Misc"){
				echo "<tr>
						<input type='hidden' name='cf_id[]' value='".$row["id"]."'>  
						<input type='hidden' name='quoteid[]' value='".$row["quoteid"]."'> 
						<input type='hidden' name='projectid[]' value='".$row["projectid"]."'> 
						<input type='hidden' name='framework[]' value='".$row["framework"]."'>
						<input type='hidden' name='framework_type[]' value='".$row["framework_type"]."'>
						<input type='hidden' name='description[]' value='".$row["description"]."'>
						<input type='hidden' name='uom[]' value='".$row["uom"]."'>
						<input type='hidden' name='cost[]' value='".$row["cost"]."'>
						<input type='hidden' name='rrp[]' value='".$row["rrp"]."'> 
						<input type='hidden' name='section[]' value='".$row["section"]."' >
						<input type='hidden' name='category[]' value='".$row["category"]."' > 
						<input type='hidden' class='delete_product_id' name='delete_product_id' value='' > 

					";
				//echo "<td> ".products("inventoryid[]",$row['inventoryid'],"misc")."  </td>"; 
				echo "<td> ".$row['description']."  <input type='hidden' name='inventoryid[]' value='{$row['inventoryid']}' /> </td>"; 	
				echo "<td> {$row["uom"]} </td>"; 
				echo "<td> <input type='text' name='qty[]' value='".number_format($row["qty"])."' class='number' /> </td>"; 
				echo "<td class='td-len'> <input type='text' name='length[]' value='{$row["length"]}' class='number input-size input-in' style='".($row['uom']=="Ea"?"display:none;":"")."' /> </td>";  
			  
				if(METRIC_SYSTEM=="inch"){
					echo "<td> <input type='text' name='' value='".get_feet_value($row["length"])."' class='number input-ft' style='".($row['uom']=="Ea"?"display:none;":"")."' /> </td>"; 
				}else{
					echo "<td> <input type='text' name='' value='{$row["length"]}' class='number input-in' /> </td>"; 
				}

				echo "<td><input type='hidden' name='colour[]' disabled='disabled'></td>"; 
				echo "<td><input type='hidden' name='finish[]' disabled='disabled'></td>"; 
				//echo "<td> ".list_suppliers("supplierid[]",$row["supplierid"])."</td>"; 
				if($row["photo"] !="") { //can't be use as of now bec. no photo record was included in inserting in ver_chronoforms_data_contract_items_vic from ver_chronoforms_data_inventory_vic table.
					echo "<td> 						
							<img src=\"".JURI::base()."images/inventory/{$row['photo']}"."\" class='inv-image' onmouseover=\"document.getElementById('PopUp-".$row['cf_id']."').style.display='block'\" onmouseout=\"document.getElementById('PopUp-".$row['cf_id']."').style.display='none'\"    onfocus='this.blur();'/>  						
							<div id='PopUp-".$row['cf_id']."' class='imagepopup' ><img src=\"".JURI::base()."images/inventory/".$row['photo']."\" ></div>
					</td>";						
				}else{
					echo "<td></td>"; 
				}
				$unprocess_misc?$disabled="":$disabled="disabled='disabled'";
				echo"<td style=\"width:10%;\"><input type=\"submit\" class=\"btndel\" name=\"del\" {$disabled} value=\"Delete\" onclick='delete_product(event,this,{$row["id"]})'></td>";
				echo "</tr>";
			}
		}
		?>
		
	</tbody>
	</table>
	</form>	


	<form method="post" class="<?php if($unprocess_extras){echo '';} else echo 'disable-form-input'; ?>" action=""> 
	<input type='hidden' name='section_type' value='extras'  > 
	<input type='hidden' name='clientid' value='<?php echo $quoteid;?>'  >
	<table class="listing-table">
    <thead>
    	<!-- <tr><td colspan="9" class="subheading" data-section='Frame' >Extras &nbsp;&nbsp; <?php if($has_extras){ $unprocess_extras?$disabled="":$disabled="disabled='disabled'"; echo "<input type='submit' name='process_bom' {$disabled} value='Process Order'/>";}  ?> </td></tr> -->
    	<tr>
    		<td colspan="8" class="subheading" data-section='Frame' >
				Extras &nbsp;&nbsp;  
				<?php $unprocess_extras?$disabled="":$disabled="disabled='disabled'"; ?>
				<?php if($has_extras){ ?>
					<input type='submit' name='process_bom' <?php echo $disabled; ?> value='Process Order' onclick="$('.is-process-bom').val('1');" class='btn' /> 
				<?php } ?>
				<input type="hidden" name="is_process_bom" class="is-process-bom"  /> 
				<input type="submit" value="Save" name="update_products" class="btn btn-save-modification" style="display:none;" onclick="$('.is-modified').val('1');" />
				<input type="hidden" name="is_modified" value="0" class="is-modified" /> 

				<?php if($unprocess_extras<1){ ?>
					<input type="submit" value="Cancel Order" name="remove_products" class="btn " onclick="$('.is-remove').val('1');" />
					<input type="hidden" name="is_remove" value="0" class="is-remove" /> 
				<?php } ?>
    		</td>
    	</tr>
    	<?php if($has_extras){ ?>
    	<tr><th style="width:214px;">Description</th><th style="width:6%;">UOM</th><th style="width:7%;">QTY</th><th style="width:10%;">Length</th><th style="width:10%;">Colour</th><th style="width:10%;">Finish</th> <th style="width:10%;">Image</th><th style="width:10%;">Delete</th></tr>
    	<?php } ?> 
    </thead>
    <tbody> 
		<?php
		mysql_data_seek($resultquotes, 0); 
		while($row = mysql_fetch_assoc($resultquotes)){

			if($row["section"]=="Extras"){
				echo "<tr>  
						<input type='hidden' name='cf_id[]' value='".$row["id"]."'> 
						<input type='hidden' name='quoteid[]' value='".$row["quoteid"]."'> 
						<input type='hidden' name='projectid[]' value='".$row["projectid"]."'> 
						<input type='hidden' name='framework[]' value='".$row["framework"]."'>
						<input type='hidden' name='framework_type[]' value='".$row["framework_type"]."'>
						<input type='hidden' name='description[]' value='".$row["description"]."'>
						<input type='hidden' name='uom[]' value='".$row["uom"]."'>
						<input type='hidden' name='cost[]' value='".$row["cost"]."'>
						<input type='hidden' name='rrp[]' value='".$row["rrp"]."'>
						<input type='hidden' name='section[]' value='".$row["section"]."' >
						<input type='hidden' name='category[]' value='".$row["category"]."' > 
						<input type='hidden' class='delete_product_id' name='delete_product_id' value='' > 

					";
				//echo "<td> ".products("inventoryid[]",$row['inventoryid'],"extras")."  </td>"; 
				echo "<td> ".$row['description']." <input type='hidden' name='inventoryid[]' value='{$row['inventoryid']}' /> </td>"; 	
				echo "<td> {$row["uom"]} </td>"; 
				echo "<td> <input type='text' name='qty[]' value='".number_format($row["qty"])."' class='number' /> </td>"; 
				 
				echo "<td class='td-len'> <input type='text' name='length[]' value='{$row["length"]}' class='number input-size input-in' style='".($row['uom']=="Ea"?"display:none;":"")."' /> </td>";  
			  
				if(METRIC_SYSTEM=="inch"){
					echo "<td> <input type='text' name='' value='".get_feet_value($row["length"])."' class='number input-ft' style='".($row['uom']=="Ea"?"display:none;":"")."' /> </td>"; 
				}else{
					echo "<td> <input type='text' name='' value='{$row["length"]}' class='number input-in' /> </td>"; 
				}

				echo "<td><input type='hidden' name='colour[]' disabled='disabled'></td>"; 
				echo "<td><input type='hidden' name='finish[]' disabled='disabled'></td>"; 
				//echo "<td> ".list_suppliers("supplierid[]",$row["supplierid"])."</td>"; 
				if($row["photo"] !="") { //can't be use as of now bec. no photo record was included in inserting in ver_chronoforms_data_contract_items_vic from ver_chronoforms_data_inventory_vic table.
					echo "<td> 						
							<img src=\"".JURI::base()."images/inventory/{$row['photo']}"."\" class='inv-image' onmouseover=\"document.getElementById('PopUp-".$row['cf_id']."').style.display='block'\" onmouseout=\"document.getElementById('PopUp-".$row['cf_id']."').style.display='none'\"    onfocus='this.blur();' />  
							<div id='PopUp-".$row['cf_id']."' class='imagepopup' ><img src=\"".JURI::base()."images/inventory/".$row['photo']."\" ></div>
					</td>";						
				}else{
					echo "<td></td>"; 
				}
				$unprocess_extras?$disabled="":$disabled="disabled='disabled'";
				echo"<td style=\"width:10%;\"><input type=\"submit\" class=\"btndel\" name=\"del\" {$disabled} value=\"Delete\" onclick='delete_product(event,this,{$row["id"]})'></td>";
				echo "</tr>";
			}
		}
		?>
		
	</tbody>	  
	</table>
	</form>


	<form method="post" class="<?php if($unprocess_disbursements){echo '';} else echo 'disable-form-input'; ?>" action=""> 
	<input type='hidden' name='section_type' value='disbursements'  > 
	<input type='hidden' name='clientid' value='<?php echo $quoteid;?>'  >
	<table class="listing-table">
    <thead>
    	<!-- <tr><td colspan="9" class="subheading" data-section='Frame' >Disbursements &nbsp;&nbsp; <?php if($has_disbursements){ $unprocess_disbursements?$disabled="":$disabled="disabled='disabled'"; echo "<input type='submit' name='process_bom' {$disabled} value='Process Order'/>";}  ?> </td></tr> -->
    	<tr>
    		<td colspan="8" class="subheading" data-section='Frame' >
				Disbursements &nbsp;&nbsp;  
				<?php $unprocess_disbursements?$disabled="":$disabled="disabled='disabled'"; ?>
				<?php if($has_disbursements){ ?>
					<input type='submit' name='process_bom' <?php echo $disabled; ?> value='Process Order' onclick="$('.is-process-bom').val('1');" class='btn' /> 
				<?php } ?>
				<input type="hidden" name="is_process_bom" class="is-process-bom"  /> 
				<input type="submit" value="Save" name="update_products" class="btn btn-save-modification" style="display:none;" onclick="$('.is-modified').val('1');" />
				<input type="hidden" name="is_modified" value="0" class="is-modified" /> 

				<?php if($unprocess_disbursements<1){ ?>
					<input type="submit" value="Cancel Order" name="remove_products" class="btn " onclick="$('.is-remove').val('1');" />
					<input type="hidden" name="is_remove" value="0" class="is-remove" /> 
				<?php } ?>
    		</td>
    	</tr>
    	<?php if($has_disbursements){ ?>
    	<tr><th style="width:214px;">Description</th><th style="width:6%;">UOM</th><th style="width:7%;">QTY</th><th style="width:10%;">Length</th><th style="width:10%;">Colour</th><th style="width:10%;">Finish</th> <th style="width:10%;">Image</th><th style="width:10%;">Delete</th></tr>
    	<?php } ?> 
    </thead>
    <tbody> 
		<?php
		mysql_data_seek($resultquotes, 0); 
		while($row = mysql_fetch_assoc($resultquotes)){

			if($row["section"]=="Disbursements"){
				echo "<tr>  
						<input type='hidden' name='cf_id[]' value='".$row["id"]."'> 
						<input type='hidden' name='quoteid[]' value='".$row["quoteid"]."'> 
						<input type='hidden' name='projectid[]' value='".$row["projectid"]."'> 
						<input type='hidden' name='framework[]' value='".$row["framework"]."'>
						<input type='hidden' name='framework_type[]' value='".$row["framework_type"]."'>
						<input type='hidden' name='description[]' value='".$row["description"]."'>
						<input type='hidden' name='uom[]' value='".$row["uom"]."'>
						<input type='hidden' name='cost[]' value='".$row["cost"]."'>
						<input type='hidden' name='rrp[]' value='".$row["rrp"]."'> 
						<input type='hidden' name='section[]' value='".$row["section"]."' >
						<input type='hidden' name='category[]' value='".$row["category"]."' > 
						<input type='hidden' class='delete_product_id' name='delete_product_id' value='' > 

					";
				//echo "<td> ".products("inventoryid[]",$row['inventoryid'],"disbursements")."  </td>"; 
				echo "<td> ".$row['description']." <input type='hidden' name='inventoryid[]' value='{$row['inventoryid']}' /> </td>"; 	
				echo "<td> {$row["uom"]} </td>"; 
				echo "<td> <input type='text' name='qty[]' value='".number_format($row["qty"])."' class='number' /> </td>"; 
				 
				echo "<td class='td-len'> <input type='text' name='length[]' value='{$row["length"]}' class='number input-size input-in' style='".($row['uom']=="Ea"?"display:none;":"")."' /> </td>";  
			  
				if(METRIC_SYSTEM=="inch"){
					echo "<td> <input type='text' name='' value='".get_feet_value($row["length"])."' class='number input-ft' style='".($row['uom']=="Ea"?"display:none;":"")."' /> </td>"; 
				}else{
					echo "<td> <input type='text' name='' value='{$row["length"]}' class='number input-in' /> </td>"; 
				}

				echo "<td><input type='hidden' name='colour[]' disabled='disabled'></td>"; 
				echo "<td><input type='hidden' name='finish[]' disabled='disabled'></td>"; 
				//echo "<td> ".list_suppliers("supplierid[]",$row["supplierid"])."</td>"; 
				if($row["photo"] !="") { //can't be use as of now bec. no photo record was included in inserting in ver_chronoforms_data_contract_items_vic from ver_chronoforms_data_inventory_vic table.
					echo "<td> 
						<a onclick=\"javascript:lightbox(null,'".JURI::base()."/contract-listing-vic/contract-folder-vic/contract-bom-vic/?get_item_dimension&cf_id={$row["id"]}')"."\"  class='inv-link'>
							<img src=\"".JURI::base()."images/inventory/{$row['photo']}"."\" class='inv-image' /> 
							<div id='PopUp-".$row['cf_id']."' class='imagepopup' ><img src=\"".JURI::base()."images/inventory/".$row['photo']."\" ></div>	 
						</a>
					</td>";						
				}else{
					echo "<td></td>"; 
				}
				$unprocess_disbursements?$disabled="":$disabled="disabled='disabled'";
				echo"<td style=\"width:10%;\"><input type=\"submit\" class=\"btndel\" name=\"del\" {$disabled} value=\"Delete\" onclick='delete_product(event,this,{$row["id"]})'></td>";
				echo "</tr>";
			}
		}  	
			
	 
		?> 
		
    </tbody>
  	</table>
  	</form>

  	<?php
  		$sql = "SELECT *,i.cf_id AS id, inv.cf_id AS inv_cf_id, i.inventoryid AS inventory_id FROM ver_chronoforms_data_contract_items_vic AS i  LEFT JOIN ver_chronoforms_data_inventory_vic AS inv ON inv.inventoryid=i.inventoryid   WHERE quoteid = '$quoteid' and projectid = '$projectid' and qty != '0.00' AND is_reorder=1  "; //ORGINAL QUERY
	    //error_log($sql, 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_us\\my-error.log');
	    //$sqlquotes = "SELECT * FROM ver_chronoforms_data_contract_items_vic AS i LEFT JOIN ver_chronoforms_data_inventory_vic AS inv ON inv.inventoryid=i.inventoryid WHERE quoteid = '$quoteid' and projectid = '$projectid' and qty != '0.00' AND section = 'Frame' and category = 'CBeams' or category = 'Timber' ";
		$resultreorder = mysql_query ($sql);
 		//$reorder = mysql_fetch_assoc($resultreorder);
 		//error_log(print_r($reorder,true), 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_us\\my-error.log');
 		if(mysql_num_rows($resultreorder)>0){
		//error_log("INSIDE REORDER: (". count($reorder).")", 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_us\\my-error.log');
			

			while($row = mysql_fetch_assoc($resultreorder)){

			$sql = "SELECT * FROM ver_chronoforms_data_contract_bom_vic AS i WHERE i.projectid = '$projectid' AND inventoryid='".$row['inventoryid']."' AND is_reorder=1 "; //AND inv.section='Frame' AND (inv.category='Beams' OR inv.category='CBeams')
			//error_log($sql, 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_us\\my-error.log');
			$resultpo = mysql_query ($sql);

			$unprocess_reorder = 1; 
			while($p = mysql_fetch_assoc($resultpo)){ 
					$unprocess_reorder = 0;  
			}	

  	?>

  	<form method="post" class="<?php if($unprocess_reorder){echo '';} else echo 'disable-form-input'; ?>" action=""> 
  	<input type='hidden' name='section_type' value='reorder'  >
  	<input type='hidden' name='clientid' value='<?php echo $quoteid;?>'  > 
	<table class="listing-table">
    <thead>
    	<!-- <tr><td colspan="9" class="subheading" data-section='Frame' >Disbursements &nbsp;&nbsp; <?php if($has_disbursements){ $unprocess_disbursements?$disabled="":$disabled="disabled='disabled'"; echo "<input type='submit' name='process_bom' {$disabled} value='Process Order'/>";}  ?> </td></tr> -->
    	<tr>
    		<td colspan="8" class="subheading" data-section='Frame' >
				Reorder Items &nbsp;&nbsp;  
				<?php $unprocess_reorder?$disabled="":$disabled="disabled='disabled'"; ?>
				<input type='submit' name='process_bom' <?php echo $disabled; ?> value='Process Order' onclick="$('.is-process-bom').val('1');" class='btn' /> 
			 	<input type="hidden" name="is_process_bom" class="is-process-bom"  /> 
				<input type="submit" value="Save" name="update_products" class="btn btn-save-modification" style="display:none;" onclick="$('.is-modified').val('1');" />
				<input type="hidden" name="is_modified" value="0" class="is-modified" /> 

				<?php if($unprocess_reorder<1){ ?>
					<input type="submit" value="Cancel Order" name="remove_products" class="btn " onclick="$('.is-remove').val('1');" />
					<input type="hidden" name="is_remove" value="0" class="is-remove" /> 
				<?php } ?>
    		</td>
    	</tr>
    	 
    	<tr><th style="width:214px;">Description</th><th style="width:6%;">UOM</th><th style="width:7%;">QTY</th><th style="width:10%;">Length</th><th style="width:10%;">Colour</th><th style="width:10%;">Finish</th> <th style="width:10%;">Image</th><th style="width:10%;">Delete</th></tr>
    	 
    </thead>
    <tbody> 
		<?php
		   
			//error_log("OREDER = ".print_r($row,true), 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_us\\my-error.log');
		 
			echo "<tr>  
					<input type='hidden' name='cf_id[]' value='".$row["id"]."'> 
					<input type='hidden' name='quoteid[]' value='".$row["quoteid"]."'> 
					<input type='hidden' name='projectid[]' value='".$row["projectid"]."'> 
					<input type='hidden' name='framework[]' value='".$row["framework"]."'>
					<input type='hidden' name='framework_type[]' value='".$row["framework_type"]."'>
					<input type='hidden' name='description[]' value='".$row["description"]."'>
					<input type='hidden' name='uom[]' value='".$row["uom"]."'>
					<input type='hidden' name='cost[]' value='".$row["cost"]."'>
					<input type='hidden' name='rrp[]' value='".$row["rrp"]."'>
					<input type='hidden' name='is_reorder[]' id='is_reorder' value='1' />  
					<input type='hidden' name='section[]' value='".$row["section"]."' >
					<input type='hidden' name='category[]' value='".$row["category"]."' > 
					<input type='hidden' class='delete_product_id' name='delete_product_id' value='' > 

				";
			echo "<td> ".$row['description']." <input type='hidden' name='inventoryid[]' value='{$row['inventoryid']}' />  </td>"; 
			echo "<td> {$row["uom"]} </td>"; 
			echo "<td> <input type='text' name='qty[]' value='".number_format($row["qty"])."' class='number' /> </td>"; 
			//echo "<td> <input type='text' name='length[]' value='{$row["length"]}' class='number' /> </td>";
			echo "<td class='td-len'> <input type='text' name='length[]' value='{$row["length"]}' class='number input-size input-in'   /> </td>";  
			  
				if(METRIC_SYSTEM=="inch"){
					echo "<td> <input type='text' name='' value='".get_feet_value($row["length"])."' class='number input-ft' /> </td>"; 
				}else{
					echo "<td> <input type='text' name='' value='{$row["length"]}' class='number input-in' /> </td>"; 
				}
				  
			echo "<td> ".list_colours("colour[]",$row["colour"])." </td>"; 
			echo "<td> ".list_colour_bond("finish[]",$row["finish"])."</td>"; 
			//echo "<td> ".list_suppliers("supplierid[]",$row["supplierid"])."</td>"; 
			if($row["photo"] !="") { //can't be use as of now bec. no photo record was included in inserting in ver_chronoforms_data_contract_items_vic from ver_chronoforms_data_inventory_vic table.
				echo "<td> 
					<a onclick=\"javascript:lightbox(null,'".JURI::base()."/contract-listing-vic/contract-folder-vic/contract-bom-vic/?get_item_dimension&cf_id={$row["id"]}')"."\"  class='inv-link'>
						<img src=\"".JURI::base()."images/inventory/{$row['photo']}"."\" class='inv-image' /> 	 
					</a>
				</td>";						
			}else{
				echo "<td></td>"; 
			}
			$unprocess_reorder?$disabled="":$disabled="disabled='disabled'";
			echo"<td style=\"width:10%;\"><input type=\"submit\" class=\"btndel\" name=\"del\" {$disabled} value=\"Delete\" onclick='delete_product(event,this,{$row["id"]})'></td>";
			echo "</tr>";
			  
	 
		?> 
		
    </tbody>
  	</table>
  	</form>

  	<?php } } ?>

  	<?php } ?>	 <!-- End of else if new contract BOM is displayed -->

  	<br/><br/>
  	<div class="" style="display:inline-block;">		
  		<!-- <button class="btn" name="close"> Close </button> &nbsp; -->
  	 	
  	 	<!-- -------------------  BUTTON NAVIGATION ----------------------------- -->
  		<?php echo "<a href=\"".JURI::base()."contract-listing-vic/contract-folder-vic/contract-folder-vic?quoteid=".$quoteid."&projectid=".$projectid."\" class='btn '>&nbsp;&nbsp; Contract Details &nbsp;&nbsp;</a>&nbsp;"; ?>
  		<?php echo "<a href=\"".JURI::base()."view-quote-vic?ref=back&quoteid=".$quoteid."&projectid=".$projectid."&ref_page=contracts&page_name=quote_details\" class='btn '>&nbsp;&nbsp; Quote Details &nbsp;&nbsp;</a>&nbsp;"; ?>
  		<?php echo "<a href=\"".JURI::base()."contract-listing-vic/contract-folder-vic/contract-bom-vic?quoteid=".$quoteid."&projectid=".$projectid."\" class='btn ".($page_name=="bom"?"btn-disabled":"")."'>&nbsp;&nbsp; BOM &nbsp;&nbsp;</a>&nbsp;"; ?>
  		<?php echo "<a href=\"".JURI::base()."contract-listing-vic/contract-folder-vic/contract-po-vic?quoteid=".$quoteid."&projectid=".$projectid."&page_name=po\" class='btn '>&nbsp;&nbsp; PO &nbsp;&nbsp;</a>&nbsp;"; ?>
  		<?php echo "<a href=\"".JURI::base()."contract-listing-vic/contract-folder-vic/contract-po-vic?quoteid=".$quoteid."&projectid=".$projectid."&page_name=po&view=summary\" class='btn '>&nbsp;&nbsp; PO Summary &nbsp;&nbsp;</a>&nbsp;"; ?>
  		<?php echo "<a href=\"".JURI::base()."contract-listing-vic/contract-folder-vic/contract-folder-vic?quoteid=".$quoteid."&projectid=".$projectid."&tab=checklist\" class='btn '>&nbsp;&nbsp; Check List &nbsp;&nbsp;</a>&nbsp;"; ?> 

  		<?php echo "<a href=\"".JURI::base()."contract-listing-vic/contract-folder-vic/contract-folder-vic?quoteid=".$quoteid."&projectid=".$projectid."&tab=checklist\" class='btn '>&nbsp;&nbsp; Test &nbsp;&nbsp;</a>&nbsp;"; ?> 
  		<!-- -------------------  BUTTON NAVIGATION ----------------------------- -->


  	</div>	
  	<div id="dialog_container">
  		<div id="dialog_content"></div>
  	</div>

<?php
	
function get_feet_value($inches){
	return floor($inches / 12)."&rsquo;" . floor($inches % 12);
     
}

function get_feet_whole($inches){
	return floor($inches / 12);
     
}

function get_feet_inch($inches){
	return floor($inches % 12);
     
}


?>  	
 

<script>  
	$(document).ready(function() { 
		var supplierpop=0;
		 
		$("td.td-len").next('td').css("display", "none");

		$('.supplierpop').each(function(){
		supplierpop++;
		var newID='supplierpop'+supplierpop;
		$(this).attr('id',newID);           
		});

		var supplieridpop=0;
		$('.supplieridpop').each(function(){
		supplieridpop++;
		var newID='supplieridpop'+supplieridpop;
		$(this).attr('id',newID);           
		});  


		var qty_products = $('#inventoryid option').size();  
		qty_products=qty_products-1; //subtract 1 for the default select 
		if(qty_products==0){
			$(".add-row input, .add-row select").attr("disabled","disabled");
		}

		if($(".sel-products").length){
			$(".sel-products, .colour, .paint-list, .supplierpop").change(function(){
				//this.parent("table").children("btn-save-modification").show();
				$(this).parent().parent().parent().parent().children("thead").children("tr").children("td").children(".btn-save-modification").show();
			}); 

			$("form input:text").keypress(function(){
				$(this).parent().parent().parent().parent().children("thead").children("tr").children("td").children(".btn-save-modification").show();
			}); 


		}

		$(".disable-form-input input").prop( "disabled", true );
		$(".disable-form-input select").prop( "disabled", true );

		$(".disable-form-input input:hidden").removeAttr( "disabled");
		$(".disable-form-input input[name=remove_products]").removeAttr( "disabled");


		$("#select_list_product").change(function(e) {
			var optionSelected = $("option:selected", this);
			var data_value = $(optionSelected).attr('data_value');
			
			if(data_value=="is_reorder"){ 
				$("#is_reorder").val("1");
			}else{
				$("#is_reorder").val("0");
			}
		});

		$("input.input-ft").change(function(e) { 
	 		alert($(this).val());  
	        total_inch = get_feet_to_inch($(this).val()); alert(total_inch); 
	        $(this).parent().parent("tr").children("td.td-len").children("input").val(total_inch); 
		  
	 	});

	 	$("#length_ft, #length_in").change(function(e) { 
	 		var length_total_inch = 0;
	 	 	length_total_inch = Number($("#length_ft").val())*12 + Number($("#length_in").val());
	        $("#length").val(length_total_inch); 
 
	 	});	
	 	

		$('input.number').bind('keypress', function (event) {
			var key = window.event ? event.keyCode : event.which; 
			
		    switch (key) {
	            case 8:  // Backspace
	            case 9:  // Tab
	            case 13: // Enter
	            case 37: // Left
	            case 38: // Up
	            case 39: // Right
	            case 40: // Down 
	            case 116: // F5 refresh 
	            case 222: // " & '
	            break;
	            default:
	            	var theEvent = event || window.event;
					var key = theEvent.keyCode || theEvent.which;
					key = String.fromCharCode( key ); 
					var regex = /[0-9]|\./;
					if( !regex.test(key) ) {
					theEvent.returnValue = false;
					if(theEvent.preventDefault) theEvent.preventDefault();
					//alert(key+" privented");
					}else{
						//alert(key+" allowed");
					}

					break;
	        }
		}); 

		$(".louver-item-qty").trigger("change");

		

	});

 

function delete_product(event,o,id){
		
	event.preventDefault();
	 
 	 
 	$(o).closest('form').children("table").children("tbody").children("tr").children("input.delete_product_id").val(id);
 	//alert($(o).closest('form').children("table").children("tbody").children("tr").children("input.delete_product_id").val());
 	$(o).closest('form').submit();
 	//var action = $(o).closest('form').attr('action');
 	   
}	

function save_dimension(event,o){
	   
	event.preventDefault();
	  
	var action = $(o).closest('form').attr('action');
	//var action = "<?php echo JURI::base(); ?>";   
	var iData = $(o).closest('form').serialize(); 
 	var attr = $(event.target).attr('data-class');
 	//var id = $(o).closest('form').children("table").children("tbody").children("tr").find("input.cf_id").val();
 	$(o).closest('form').children("table").children("tbody").children("tr").find("input.cf_id").val();
 	var id = $(o).closest('form').children("table").children("tbody").children("tr").find("input.cf_id").val();//children("input.cf_id").val();
 	//alert(id); return;
 	//console.log(iData);return; 
	 
	$.ajax({
		type: "GET",
		url: action,
		dataType: 'json', 	
		data: iData,	
		success: function(data) {					
			alert(data['message']); 
		}		
	});

	 
}	

 
function get_feet_value(inches){
    return Math.floor(inches / 12)+"'"+ Math.floor(inches %= 12);
     
}

regexp = new RegExp("[0-9]+","g"); 

function get_feet_to_inch(f){ 
	var heightValue_array = f.match(regexp);
	return (typeof(heightValue_array[0]) != 'undefined' ? parseInt(heightValue_array[0] *12) : 0) + (typeof(heightValue_array[1]) != 'undefined' ? parseInt(heightValue_array[1]) : 0);
} 


$(".louver-item-qty, .louver-item-len").change(function(){  //#louvres-len_ft, #louvres-qty
	 
	<?php  	
	
	if (fnmatch("*Single Bay VR*",$VergolaType)){ 	

	?>
		 
		var endcap_qty = 0;
		var link_bar_qty = 0;
		$(".louver-item-qty").each(function(e){ 
		 	qty = Number($(this).val());
		 	link_bar_qty = link_bar_qty+qty;
			endcap_qty += qty*2;   
		});

		
 
		$("#endcap-qty").val(endcap_qty.toFixed(0)); 
		//$("#louvres-qty").val(qty); 
		//qty = $(this).parent().parent("tr").children("td.td-qty").children("input").val(); 
	 	  
	 	//len = $(this).parent().parent("tr").children("td.td-ft").children("input:visible").val();
	 	//len = get_feet_to_inch(len);
  
		// console.log("finishRrp: "+finishRrp);
		// console.log("width: "+width);
		// console.log("len: "+len);
		// console.log("qty: "+qty);
		// console.log("rrp: "+rrp);
		//alert("0:"+$(this).val());
		//$(this).parent().parent("tr").children("td.td-rrp").children("input").val(rrp.toFixed(2));
	  	//alert("1:"+$(this).val());

		//COMPUTE ENDCAP qty and cost.
		//qty = qty*2; 
		//console.log(qty);
		//$("#endcap-qty").val(qty.toFixed(0)); 
		   
		//price = $("#endcap-qty").parent().parent("tr").children("td.td-item").children("input.price").attr("price");  
		//finishRrp = Number($("#endcap-qty").parent().parent("tr").children("td.td-finish-color").children("select").children("option:selected").attr("finishrrp"));
		//qty = Number($("#endcap-qty").val());

		//rrp = qty*price;
		//rrp = rrp + finishRrp; 
		// console.log("qty: "+qty);
		// console.log("price: "+price);
		// console.log("rrp: "+rrp);
		//$("#endcap-qty").parent().parent("tr").children("td.td-rrp").children("input").val(rrp.toFixed(2));
	 	//alert("endcap-qty rrp: "+$("#endcap-qty").parent().parent("tr").children("td.td-rrp").children("input").val());

		//COMPUTE PIVOT STRIP qty and cost.
		//len = Number($("#lengthid").val());
		//qty = Math.ceil(((len/39.37)*5*2)/12); //pivot strip = no. of endcap / 12 (round up to the nearest unit.) ---(Every 5 lourves have 1 pivot strip-OLD formula)
		endcap_qty = $("#endcap-qty").val();
		qty = Math.ceil(endcap_qty/12);
		//console.log("PIVOT QTY: "+qty);
		$("#pivot-qty").val(qty);
		   
		//price = $("#pivot-qty").parent().parent("tr").children("td.td-item").children("input.price").attr("price");  
		//finishRrp = Number($("#pivot-qty").parent().parent("tr").children("td.td-finish-color").children("select").children("option:selected").attr("finishrrp"));

		//var rrp = (qty*price)+finishRrp;
		//$("#pivot-qty").parent().parent("tr").children("td.td-rrp").children("input").val(rrp.toFixed(2));

		//COMPUTE LINK BAR. 
		//len = Number($("#lengthid").val()); 
		//qty = Math.round((len*5*2)/12); //pivot strip = no. of endcap / 12 (round up to the nearest unit.) ---(Every 5 lourves have 1 pivot strip-OLD formula)
		//qty = $("#louvres-qty").val(); 
		qty = Math.ceil(link_bar_qty/12); 
		//console.log("PIVOT QTY: "+qty); 
		$("#linkBar-qty").val(qty); 
		
		//price = $("#linkBar-qty").parent().parent("tr").children("td.td-item").children("input.price").attr("price");  
		//finishRrp = Number($("#linkBar-qty").parent().parent("tr").children("td.td-finish-color").children("select").children("option:selected").attr("finishrrp"));

		//var rrp = (qty*price)+finishRrp;
		//$("#linkBar-qty").parent().parent("tr").children("td.td-rrp").children("input").val(rrp.toFixed(2));

	  
		//compute_project_cost();

	<?php }else{ ?>	

		var louver_qty = 0;
		var louver_qty_2 = 0;  
		var endcap_qty = 0;
		$(".louver-item-qty").each(function(e){ 
		 	qty = Number($(this).val());
		 	//link_bar_qty = link_bar_qty+qty;
			endcap_qty += qty*2;   
			
		});
		//alert(endcap_qty);
		 
		$("#endcap-qty").val(endcap_qty.toFixed(0)); 
		//$("#louvres-qty").val(qty); 
		//qty = $(this).parent().parent("tr").children("td.td-qty").children("input").val(); 
	 	  
	 	//len = $(this).parent().parent("tr").children("td.td-ft").children("input:visible").val();
	 	//len = get_feet_to_inch(len);
 

		//price = $(this).parent().parent("tr").children("td.td-item").children("select").children("option:selected").attr("price"); 
		//finishRrp = Number($(this).parent().parent("tr").children("td.td-finish-color").children("select").children("option:selected").attr("finishrrp"));
		
		//rrp = qty*price*len;
		//rrp = rrp + (finishRrp * len * qty);

		 
		//$(this).parent().parent("tr").children("td.td-rrp").children("input").val(rrp.toFixed(2));
	   
		   
		//price = $("#endcap-qty").parent().parent("tr").children("td.td-item").children("input.price").attr("price");  
		//finishRrp = Number($("#endcap-qty").parent().parent("tr").children("td.td-finish-color").children("select").children("option:selected").attr("finishrrp"));
		//qty = Number($("#endcap-qty").val());

		//rrp = qty*price;
		//rrp = rrp + finishRrp; 
		// console.log("qty: "+qty);
		// console.log("price: "+price);
		// console.log("rrp: "+rrp);
		//$("#endcap-qty").parent().parent("tr").children("td.td-rrp").children("input").val(rrp.toFixed(2));
	 	//alert("endcap-qty rrp: "+$("#endcap-qty").parent().parent("tr").children("td.td-rrp").children("input").val());

		//COMPUTE PIVOT STRIP qty and cost.
		//len = Number($("#lengthid").val());
		//qty = Math.ceil(((len/39.37)*5*2)/12); //pivot strip = no. of endcap / 12 (round up to the nearest unit.) ---(Every 5 lourves have 1 pivot strip-OLD formula)
		louver_qty = $("#louver-qty").val();
		qty = Math.ceil(louver_qty*2/12);
		//console.log("PIVOT QTY: "+qty);
		$("#pivot-qty").val(qty);

		louver_qty_2 = $("#louver-qty-2").val();
		qty = Math.ceil(louver_qty_2*2/12);
		//console.log("PIVOT QTY: "+qty);
		$("#pivot-qty-2").val(qty);
		   
		//price = $("#pivot-qty").parent().parent("tr").children("td.td-item").children("input.price").attr("price");  
		//finishRrp = Number($("#pivot-qty").parent().parent("tr").children("td.td-finish-color").children("select").children("option:selected").attr("finishrrp")); 
		//var rrp = (qty*price)+finishRrp;
		//$("#pivot-qty").parent().parent("tr").children("td.td-rrp").children("input").val(rrp.toFixed(2));

		//price = $("#pivot-qty-2").parent().parent("tr").children("td.td-item").children("input.price").attr("price");  
		//finishRrp = Number($("#pivot-qty-2").parent().parent("tr").children("td.td-finish-color").children("select").children("option:selected").attr("finishrrp")); 
		//var rrp = (qty*price)+finishRrp;
		//$("#pivot-qty-2").parent().parent("tr").children("td.td-rrp").children("input").val(rrp.toFixed(2));



		//COMPUTE LINK BAR. 
		//len = Number($("#lengthid").val()); 
		//qty = Math.round((len*5*2)/12); //pivot strip = no. of endcap / 12 (round up to the nearest unit.) ---(Every 5 lourves have 1 pivot strip-OLD formula)
		louver_qty = $("#louver-qty").val(); 
		qty = Math.ceil(louver_qty/12); 
		//console.log("PIVOT QTY: "+qty); 
		$("#linkBar-qty").val(qty); 
		
		//price = $("#linkBar-qty").parent().parent("tr").children("td.td-item").children("input.price").attr("price");  
		//finishRrp = Number($("#linkBar-qty").parent().parent("tr").children("td.td-finish-color").children("select").children("option:selected").attr("finishrrp"));

		//var rrp = (qty*price)+finishRrp;
		//$("#linkBar-qty").parent().parent("tr").children("td.td-rrp").children("input").val(rrp.toFixed(2));


		louver_qty = $("#louver-qty-2").val(); 
		qty = Math.ceil(louver_qty/12); 
		//console.log("PIVOT QTY: "+qty); 
		$("#linkBar-qty-2").val(qty); 
		
		//price = $("#linkBar-qty-2").parent().parent("tr").children("td.td-item").children("input.price").attr("price");  
		//finishRrp = Number($("#linkBar-qty-2").parent().parent("tr").children("td.td-finish-color").children("select").children("option:selected").attr("finishrrp"));

		//var rrp = (qty*price)+finishRrp;
		//$("#linkBar-qty-2").parent().parent("tr").children("td.td-rrp").children("input").val(rrp.toFixed(2));

	  
		//compute_project_cost();


	<?php } ?>
		
	});	


$(document).on("change","select.desclist",function(e){ 
	desc = $(this).parent().parent("tr").children("td.td-item").children("select").children("option:selected").text(); 
	$(this).parent().parent("tr").children(".inv_desc").val(desc);
	//alert(desc);
});


</script>


