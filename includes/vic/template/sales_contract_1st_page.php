<?php
$ProjectID = $projectInfo["projectid"];
$resultq = mysql_query("SELECT * FROM ver_chronoforms_data_quote_vic WHERE projectid  = '$ProjectID'");
$retrieveq = mysql_fetch_array($resultq);
if (!$resultq) {die("Error: Data not found..");}
  
$dimension = "";
$resultm = mysql_query("SELECT * FROM ver_chronoforms_data_measurement_vic WHERE projectid  = '$ProjectID'");
//error_log($resultm, 3,'C:\\xampp\htdocs\\vergola_contract_system_v3\\my-error.log');
if (!$resultm) {die("Error: Data not found..");}

$numBay = 0;
$ReLen = null;
$ReWid = null;
$_ReWid = null;
$VergolaType = $retrieveq['framework'];
//error_log("vergola type : ".$VergolaType, 3,'C:\\xampp\htdocs\\vergola_contract_system_v3\\my-error.log');
if($VergolaType == "Double Bay" || $VergolaType == "Double Bay - Drop-In" || $VergolaType == "Double Bay VR2" || $VergolaType == "Double Bay VR3" || $VergolaType == "Double Bay VR3 - Gutter" || $VergolaType == "Double Bay VR2 - Drop-In" || $VergolaType == "Double Bay VR3 - Drop-In" || $VergolaType == "Double Bay VR3 - Gutter - Drop-In"  ){
	$k=0; 
	while ($retrievem = mysql_fetch_array($resultm)){
		$ReLen[$k] = $retrievem['length'];
		$_ReWid = $retrievem['width'];
		$k++;
		//error_log("DOUBLE BAY width: ".$_ReWid, 3,'C:\\xampp\htdocs\\vergola_contract_system_v3\\my-error.log'); 
	}	
	$numBay = 2;
	$dimension = $ReLen[0].' X '.$_ReWid .' / '. $ReLen[1].' X '.$_ReWid; 
	//error_log("AM HERE 1!", 3,'C:\\xampp\htdocs\\vergola_contract_system_v3\\my-error.log'); 
	//error_log("L1: ".$ReLen[0]. " L2: ".$ReLen[1]." W:".$_ReWid, 3,'C:\\xampp\htdocs\\vergola_contract_system_v3\\my-error.log');	
}else if($VergolaType == "Multiple Bay" || $VergolaType == "Multiple Bay - Drop-In"){
	$k=0; 
	while ($retrievem = mysql_fetch_array($resultm)){
		$ReLen[$k] = $retrievem['length'];
		$ReWid[$k] = $retrievem['width']; 
		$k++;
		//error_log(print_r($retrievem['length'],true), 3,'C:\\xampp\htdocs\\vergola_contract_system_v3\\my-error.log');
		//error_log(print_r($retrievem['width'],true), 3,'C:\\xampp\htdocs\\vergola_contract_system_v3\\my-error.log'); 

	}	
	$numBay = $k;
	$dimension = $ReLen[0].' X '.$ReWid[0]; 
	//error_log("AM HERE 2!", 3,'C:\\xampp\htdocs\\vergola_contract_system_v3\\my-error.log'); 
}else{
	$retrievem = mysql_fetch_array($resultm);
	$ReLen = $retrievem['length'];
	$ReWid = $retrievem['width'];
	  
	$numBay = 1; 
	$dimension = $ReLen.' X '.$ReWid;
}

//error_log(print_r($retrieveq,true), 3,'C:\\xampp\htdocs\\vergola_contract_system_v3\\my-error.log');
//get the column type by Post 90x90 - 2mm Galv for VR1
// if($retrieveq['framework']=='Single Bay VR1'){
// 	//$sql = "SELECT * FROM ver_chronoforms_data_quote_vic WHERE projectid  = '$ProjectID'  LIMIT 1,1 ";
// 	$sql = "SELECT * FROM ver_chronoforms_data_quote_vic AS q JOIN ver_chronoforms_data_inventory_vic AS i ON i.inventoryid=q.inventoryid WHERE i.projectid  = '$ProjectID' and i.category='Posts' LIMIT 1  ";
// }else 
//error_log("Framewor: ".$retrieveq['framework'], 3,'C:\\xampp\htdocs\\vergola_contract_system_v3\\my-error.log'); 
$is_drop_in = 0;
if($retrieveq['framework']=='Single Bay VR1 - Drop-In' || $retrieveq['framework']=='Double Bay VR2 - Drop-In' || $retrieveq['framework']=='Double Bay VR3 - Drop-In' || $retrieveq['framework']=='Double Bay VR3 - Gutter - Drop-In'){
	$sql = null;
	$is_drop_in = 1;
}else{
	$sql = "SELECT * FROM ver_chronoforms_data_quote_vic AS q JOIN ver_chronoforms_data_inventory_vic AS i ON i.inventoryid=q.inventoryid WHERE q.projectid  = '$ProjectID' and i.category='Posts' LIMIT 1  ";
}
//error_log($sql, 3,'C:\\xampp\htdocs\\vergola_contract_system_v3\\my-error.log'); 

$itemResult = mysql_query($sql);
$postColumn = mysql_fetch_array($itemResult); 
//error_log(print_r($postColumn,true), 3,'C:\\xampp\htdocs\\vergola_contract_system_v3\\my-error.log'); 
 
$sql = "SELECT * FROM ver_chronoforms_data_quote_vic AS q JOIN ver_chronoforms_data_inventory_vic AS i ON i.inventoryid=q.inventoryid WHERE q.projectid  = '$ProjectID' and i.section='Guttering' LIMIT 1,1 "; 
 
$itemResult = mysql_query($sql);
$gutter = mysql_fetch_array($itemResult);

 
$sql = "SELECT * FROM ver_chronoforms_data_quote_vic AS q JOIN ver_chronoforms_data_inventory_vic AS i ON i.inventoryid=q.inventoryid WHERE q.projectid  = '$ProjectID' and i.section='Flashings' LIMIT 1,1 ";
 
$itemResult = mysql_query($sql);
$flashing = mysql_fetch_array($itemResult);


$vergolaType = $retrieveq['framework'];
$vergolaDimension = $dimension; 
$numberBays = $numBay;
$beamType = "";
if($is_drop_in==1?"":$beamType=$retrieveq['description']);
$columnType = $postColumn['description'];
$gutterType = $gutter['finish'];
$flashingType = $flashing['finish'];
 
?>
<table  >
	<tr>
		<td width="20%">
			<img src="<?php echo JURI::base().'images/company_logo.png'; ?> " style="float:left; width: 80px;" /> 
		</td>
		<td width="70%">
			<p style="float:left; font-size:12pt; padding-left:21px">
				Plain English Contract for Supply and Installation of a <br/>
				Vergola Opening Roof System
			</p>
		</td>
	</tr>
</table>

<br/> 
    
<table class="template_tbl" border="1" cellspacing="0" style="border-collapse:collapse;" >
	<tbody>
	<tr style="border:none;">
		<td colspan="4" style="border:none;" > 
				<p style="font-size:9pt;">This contract is between:</p> <br/>
				<p style="font-size:9pt;"><b>Vergola (Vic) Pty Ltd</b> &nbsp; ACN 088 482 928 of 101 Port Road Thebarton SA 5031 Phone 8150 6888 and Facsimile 81506868. Directors Registration Number: DBL33799 - (“we, our, us”).</p>
				<p style="font-size:9pt;">And</p>

		</td>
	</tr>
	<tr style="border:none;">	
		<td colspan="2"  style="border:none;">  
			<p style="font-size:9pt;" >
				<b>The Owner ("<?php echo ($retrieve['is_builder']=="1"? $retrieve['builder_name'] : $ClientFirstName .' '. $ClientLastName); ?>")</b> <br/>
				<b>Mobile Phone:</b> &nbsp;<?php echo $ClientMobile; ?> 
			</p>
		</td>
		<td colspan="2"  style="border:none;">	 
			<p style="font-size:9pt;">
				<b>Vergola contract #:</b> &nbsp;&nbsp;<?php echo $ProjectID; ?> <br/>
				<b>Design consultant:</b> &nbsp;&nbsp;<?php echo $sales_rep; ?> </p>
			</p>
		</td>
	</tr>

	<tr >
		<td colspan="4"  > 
				<p style="font-size:9pt;"><b>Your address: </b> &nbsp; <?php echo $ClientAddress1 .' '. $SiteAddress2; ?><br/>
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				<?php echo $ClientSuburb .' '. $ClientState.' '. $ClientPostCode; ?></p>   &nbsp;
		</td>
	</tr>  

	<tr>
		<td colspan="4"> 
				<p style="font-size:9pt; margin-top:3px;">
					<b>The site: </b>  
					&nbsp;<?php echo $SiteAddress1 .' '. $SiteAddress2; ?><br/>
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  
					<?php echo $SiteSuburb .' '. $SiteState.' '. $SitePostcode; ?>
				</p>
		</td> 
	</tr>

	<tr>
		<td width="165">
			<div style="font-size:9pt;">
				The Vergola dimension:
			</div>
		</td>
		<td width="165"> 
			<div style="font-size:9pt;">&nbsp;&nbsp;
			 	<?php echo $vergolaDimension; ?> 
			</div>
		</td>
		<td width="165">
			<div style="font-size:9pt;">
				Number of Bays:
			</div>
		</td>
		<td width="165">
			<div style="font-size:9pt;">&nbsp;&nbsp;
				 <?php echo $numberBays; ?> 
			</div>
		</td>
	</tr>

	<tr>
		<td width="165">
			<div style="font-size:9pt;">
				Type of Vergola:
			</div>
		</td>
		<td width="165"> 
			<div style="font-size:9pt;">&nbsp;&nbsp;
			 	<?php echo $vergolaType; ?> 
			</div>
		</td>
		<td width="165">
			<div style="font-size:9pt;">
				Beam Type:
			</div>
		</td>
		<td width="165">
			<div style="font-size:9pt;">&nbsp;&nbsp;
				  <?php echo $beamType; ?> 
			</div>
		</td>
	</tr>

	<tr>
		<td width="165">
			<div style="font-size:9pt;">
				Column Type:
			</div>
		</td>
		<td width="165"> 
			<div style="font-size:9pt;">&nbsp;&nbsp; 
			    <?php echo $columnType; ?> 
			</div>
		</td>
		<td width="165">
			<div style="font-size:9pt;">
				Gutter Type:
			</div>
		</td>
		<td width="165">
			<div style="font-size:9pt;">&nbsp;&nbsp;
				 <?php echo $gutterType; ?> 
			</div>
		</td>
	</tr>

	<tr>
		<td width="165">
			<div style="font-size:9pt;">
				Flashing Type:
			</div>
		</td>
		<td width="165"> 
			<div style="font-size:9pt;">&nbsp;&nbsp;
			 	 <?php echo $flashingType; ?>  
			</div>
		</td>
		<td colspan="2">
			<div style="font-size:9pt;">
				 
			</div>
		</td>
		 
	</tr>

	<tr>
		<td width="220">
			<div style="font-size:9pt;">
				<b>Structure</b><br/>
				<img src="<?php echo JURI::base().'images/box.jpg'; ?> " /> Attached to home<br/>
				<img src="<?php echo JURI::base().'images/box.jpg'; ?> " /> Freestanding 
			</div>
		</td>
		<td width="220"> 
			<div style="font-size:9pt;">
			 	<b>Column fixing</b><br/>
				<img src="<?php echo JURI::base().'images/box.jpg'; ?> " /> Footing<br/>
				<img src="<?php echo JURI::base().'images/box.jpg'; ?> " /> Bracket
			</div>
		</td>
		<td width="220" colspan="2">
			<div style="font-size:9pt;">
				<b>Finish</b><br/>
				<img src="<?php echo JURI::base().'images/box.jpg'; ?> " /> Standard<br/>
				<img src="<?php echo JURI::base().'images/box.jpg'; ?> " /> Non Standard (specify):     
			</div>
		</td>
	</tr>

	<tr>
		<td width="220" valign="top">
			<div style="font-size:9pt;">
				<b>Exclusions: </b> <br/>
				A standard building permit only is included. All other permits such as Town Planning, Build over easements permits, fire mod’s, siting dispensations and the like are NOT included. We will make application on your behalf if required. A 20% surcharge is applied to cover preparation of plans and application costs
			</div>
		</td>
		<td width="220" valign="top"> 
			<div style="font-size:9pt; ">
			 	<b>Non Standard Inclusions:  </b>
			</div>
		</td>
		<td width="220" valign="top" colspan="2">
			<div style="font-size:9pt;">
				<b>Special Conditions: </b> 
			</div>
		</td>
	</tr>

	<tr>
		<td width="220">
			<div style="font-size:9pt;">
				<b>Design wind category</b><br/>
				<img src="<?php echo JURI::base().'images/box1.jpg'; ?> "   /> 
			 
			</div>
		</td>
		<td width="220" style=" vertical-align: middle;"> 
			<div style="font-size:9pt;"> <b>Council approval required?</b> <br/>
			 <img src="<?php echo JURI::base().'images/box_yes_no.jpg'; ?> " align="top" style="display:inline;" />  
			</div>
		</td>
		<td width="220" colspan="2" style=" vertical-align: middle;">
			<div style="font-size:9pt;" valign="middle">
				<b>Strata or other consents required?</b><br/>
				<img src="<?php echo JURI::base().'images/box_yes_no.jpg'; ?> " align="top" style="display:inline;" />  
				 
			</div>
		</td>
	</tr>  
	 
	<tr>
		<td   width="165" border="0" style="border:none;" > 
			&nbsp;	 
			 
		</td>
		 
		<td width="496" colspan="3" rowspan="11" > 
		 	<p style="font-size:8pt;">
			 	<b>WARNING:  Changes to the price </b> <br/>
			 	<b>The price</b> &nbsp; is fixed but may be altered by: 
			 	<ul style=" margin:0">
			 		<li><span style="font-size:9pt;">The cost of obtaining planning permission if required (see clause 29)</span></li>
			 		<li><span style="font-size:9pt;">Variations, including those required by the engineer or a building surveyor or any authorised person under the Building Act 1993 (see clause 23)</span></li>
			 		<li><span style="font-size:9pt;">Interest on overdue payments (see clause 17)</span></li>
			 		<li><span style="font-size:9pt;">The cost of surveying the land if required (see clause 6)</span></li>
			 		<li><span style="font-size:9pt;"><b>Us</b> having to do work that <b>you</b> are supposed to do (see clauses 3, 8 and 25)</span></li>
			 		<li><span style="font-size:9pt;">Any order made by the Victorian Civil and Administrative Tribunal or other Court or Tribunal</span></li>
			 		<li><span style="font-size:9pt;">GST</span></li>
			 	</ul>
			</p>
		</td>
		 
	</tr> 
	<tr>
		<td  width="165" border="0" style="border:none;"> 
			&nbsp;	 
			 
		</td> 
	</tr> 

	<tr>
		<td width="165" border="0" style="border:none;" > 
			&nbsp;	 
		</td> 
	</tr> 
	<tr>
		<td width="165" style="border:none;"> 
			&nbsp;	 
		</td> 
	</tr>
	<tr >
		<td width="165" style="border:none;"> 
		</td> 
	</tr> 
	<tr>
		<td  width="165" style="border:none;"> 
			&nbsp;	 
			 
		</td> 
	</tr> 

	<tr>
		<td width="165" style="border:none;" > 
			&nbsp;	 
		</td> 
	</tr> 

	<tr>
		<td width="165" style="border:none;" > 
			&nbsp;	 
		</td> 
	</tr> 
	 
	<tr>
		<td  width="165" style="font-size:8pt;" >
		 	 The price: &nbsp;&nbsp; | &nbsp;&nbsp; $<?php echo number_format($projectInfo['total_cost'], 2, '.', ' '); ?>   
		</td>  
	 
	</tr> 
	<tr>
		<td  width="165" style="font-size:8pt;"  >
		 	 GST:  &nbsp;&nbsp;&nbsp;&nbsp; &nbsp; &nbsp;&nbsp; | &nbsp;&nbsp; $<?php echo number_format($projectInfo['total_gst'], 2, '.', ' '); ?> 
		</td> 
	 
	</tr> 
	<tr>
		<td  width="165" style="font-size:8pt;"  >
		 	 Total price: &nbsp;| &nbsp;&nbsp; $<?php echo number_format($projectInfo['total_rrp_gst'], 2, '.', ' '); ?>  
		</td> 
	</tr> 
	<tr>
		<td colspan="4"> 
			<div style="font-size:9pt;">
			 Progress claims and payments:
			</div>
		</td>
	</tr>

	<tr>
		<td width="220">
			<div style="font-size:9pt;">
				Deposit & Disbursements:
			</div>
		</td>
		<td width="220"> 
			<div style="font-size:9pt;">
			 	$<?php echo number_format($projectInfo['payment_deposit'], 2, '.', ' '); ?> 
			</div>
		</td>
		<td width="220" colspan="2">
			<div style="font-size:9pt;">
				(to be paid on signing Contract)
			</div>
		</td>
	</tr> 
	 
	<tr>
		<td width="220">
			<div style="font-size:9pt;">
				Progress Claim
			</div>
		</td>
		<td width="220"> 
			<div style="font-size:9pt;">
			 	$<?php echo number_format($projectInfo['payment_progress'], 2, '.', ' '); ?> 
			</div>
		</td>
		<td width="220" colspan="2">
			<div style="font-size:9pt;">
				(to be paid on signing Contract)
			</div>
		</td>
	</tr> 
	
	<tr>
		<td width="220">
			<div style="font-size:9pt;">
				Final Payment
			</div>
		</td>
		<td width="220"> 
			<div style="font-size:9pt;">
			 	$<?php echo number_format($projectInfo['payment_final'], 2, '.', ' '); ?> 
			</div>
		</td>
		<td width="220" colspan="2">
			<div style="font-size:9pt;">
				(to be paid on signing Contract)
			</div>
		</td>
	</tr>  

	<tr> 
		<td colspan="4">
			<div style="font-size:9pt;">
				Construction Period: 
			</div>
		</td>
	</tr> 


	</tbody>


</table>

<br/><br/> 