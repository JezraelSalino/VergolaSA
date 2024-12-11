<?php  
if ($projectid != '') {
   $load_list_titleID = "Load List(".mt_rand().")";


}

//error_log("generate_load_list: ".print_r($_POST,true), 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_sa\\my-error.log');

if(isset($_POST['generate_load_list']))
{
    $projectid = mysql_real_escape_string($_POST['projectid']);
    $clientid = mysql_real_escape_string($_POST['clientid']);

    //error_log("projectid: ".$projectid, 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_sa\\my-error.log');
    //error_log("clientid: ".$clientid, 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_sa\\my-error.log');exit();

    $sql = "DELETE FROM ver_chronoforms_data_letters_vic WHERE clientid='{$clientid}-({$projectid})' AND (template_type='check list - gutter flashing' OR template_type='check list') ";   
    mysql_query($sql);

    $template_title='Load List - Gutter Flashing ('.$projectid.')';
      $template_content=generate_html_load_list_gutter_flashing($projectid);  
        $sql = "INSERT INTO ver_chronoforms_data_letters_vic (clientid, template_name, datecreated, template_content, template_type) 
         VALUES ('$clientid-({$projectid})','$template_title', '".date('Y-m-d H:i:s')."', '$template_content', 'check list - gutter flashing')";  
      mysql_query($sql);

    
      $template_title='Load List ('.$projectid.')'; 
      $template_content=generate_html_load_list($projectid); 
      $sql = "INSERT INTO ver_chronoforms_data_letters_vic (clientid, template_name, datecreated, template_content, template_type) 
         VALUES ('$clientid-({$projectid})','$template_title', '".date('Y-m-d H:i:s')."', '$template_content', 'check list')"; 
      mysql_query($sql);

}

// if(isset($_REQUEST['projectid'])){ 
//   $projectid = mysql_real_escape_string($_REQUEST['projectid']);
//   $resultdetails = mysql_query("SELECT * FROM ver_chronoforms_data_contract_list_vic WHERE projectid = '$projectid'");
//   $contract = mysql_fetch_array($resultdetails);
// }

$clientid = $_REQUEST['quoteid'];
$projectid = $_REQUEST['projectid'];

?>  
  

<?php

$ul_load_list = '<ul id="tbl-imgpic" class="picture-block" style="margin-top: 15px;">';        
$sql = "SELECT * FROM ver_chronoforms_data_letters_vic WHERE clientid = '{$clientid}-({$projectid})' AND template_type ='check list' ORDER BY cf_id DESC LIMIT 1 ";
$resultimg = mysql_query($sql);
 //error_log("sql: ".$sql, 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_sa\\my-error.log');
  $has_generated=0;
  $thumbnail = JURI::base()."images/pdf_logo.jpg"; 
  while($row = mysql_fetch_assoc($resultimg))
  {
    $has_generated=1;   
    $ul_load_list .= "<li style=' '>   <a rel=\"nofollow\" onclick=\"window.open(this.href,'win2','status=no,toolbar=no,scrollbars=yes,titlebar=no,menubar=no,resizable=yes,width=auto,height=auto,directories=no,location=no'); return false;\" href=\"index.php?pid=".$row['cf_id']."&option=com_chronoforms&tmpl=component&chronoform=Download-PDF\"> <img src='".JURI::base()."images/pdf_logo.jpg' style='width:70px;'  /><br/>Load List</a> </li>"; 
  }

$sql = "SELECT * FROM ver_chronoforms_data_letters_vic WHERE clientid = '{$clientid}-({$projectid})' AND template_type ='check list - gutter flashing' ORDER BY cf_id DESC LIMIT 1 ";
$resultimg = mysql_query($sql);
//error_log("sql: ".$sql, 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_sa\\my-error.log');
   
  while($row = mysql_fetch_assoc($resultimg))
  {
    $has_generated=1;   
    $ul_load_list .= "<li  >   <a rel=\"nofollow\" onclick=\"window.open(this.href,'win2','status=no,toolbar=no,scrollbars=yes,titlebar=no,menubar=no,resizable=yes,width=auto,height=auto,directories=no,location=no'); return false;\" href=\"index.php?pid=".$row['cf_id']."&option=com_chronoforms&tmpl=component&chronoform=Download-PDF\"> <img src='".JURI::base()."images/pdf_logo.jpg' style='width:70px;'  /><br/>Load List - Gutter Flashing </a> </li>"; 
  }  

$ul_load_list .= '</ul>';


echo "<input type='button' name='generate_load_list' value='".($has_generated==1?'Refresh Load List':'Create Load List')."' class='btn' style='margin: 14px 0px 10px 25px;' onclick='$(\"#form_generate_checklist\").submit();'/>";
echo $ul_load_list;
?>




<?php
 
function generate_html_load_list($projectid){
  $url=JURI::base();
  //error_log('url:'.$url, 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_sa\\my-error.log');
  $sql = "SELECT * FROM ver_chronoforms_data_contract_list_vic AS contract 
      JOIN ver_chronoforms_data_clientpersonal_vic AS c ON c.clientid = contract.quoteid 
      JOIN ver_chronoforms_data_contract_vergola_vic as cv ON cv.projectid=contract.projectid  
      JOIN ver_chronoforms_data_contract_details_vic AS cd ON cd.projectid=contract.projectid 
      WHERE  contract.projectid = '".$projectid."' ";
  // error_log($sql, 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_sa\\my-error.log');
  $qContract = mysql_query($sql);
  $contract = mysql_fetch_array($qContract); 

  $sql = "SELECT * FROM ver_chronoforms_data_contract_items_vic WHERE   projectid = '$projectid' and inventoryid = 'IRV89'";
  $resultlabour = mysql_query($sql);
  //error_log("projectid inside: ".$sql, 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_sa\\my-error.log'); 
  $labour = 0;
  $retrievelabour = mysql_fetch_array($resultlabour); 
  if(isset($retrievetravel['rrp']) && $retrievetravel['rrp']>0){
    $labour = $retrievelabour['rrp']; 
  }

  $$travel = 0;
  $resulttravel = mysql_query("SELECT * FROM ver_chronoforms_data_contract_items_vic WHERE projectid = '$projectid' and inventoryid = 'IRV91'");
  $retrievetravel = mysql_fetch_array($resulttravel); 
  if(isset($retrievetravel['rrp']) && $retrievetravel['rrp']>0){
    $travel = $retrievetravel['rrp'];
  }
  

  $extras = $labour+$travel; 
  $VergolaType = $contract['framework']; 

   
  $title = '
  <table border="0" cellspacing="0" style="border-collapse:collapse;font-size: 10pt;" width="100%"  cellpadding="0">
  <tr ><td colspan="3" style="vertical-align:bottom;"><p style="font-size: 14pt; text-align:right;"><b>Vergola Installer General Load List</b></p> </td><td style="text-align:right;"><img src="images/company_logo.png" style="width:50px;"/></td></tr>

<tr  ><td colspan="2"  width="50%" style="text-align:center;"> <b>Job No.:'.$contract["projectid"].'</b>  </td> <td colspan="2"  border="0"    >  <b>Description: '.$contract["framework"].'</b> </td>
</tr> 
</table>';
 
  $title_2 = '<table border="0" cellspacing="0" style="border-collapse:collapse;font-size: 10pt;" width="100%"  cellpadding="5">
<tr ><td colspan="4"  ><p style="font-size: 14pt; text-align: center;"><b>Vergola Factory Load List</b></p></td></tr>

<tr  ><td colspan="2"  width="50%" style="text-align:center;"> <b>Job No.:'.$contract["projectid"].'</b>  </td> <td colspan="2"  border="0"    >  <b>Description: '.$contract["framework"].'</b> </td>
</tr> 
</table>';

  $title_3 = '<table border="0" cellspacing="0" style="border-collapse:collapse;font-size: 10pt;" width="100%"  cellpadding="5">
<tr ><td colspan="4"  ><p style="font-size: 14pt; text-align: center;"><b>Vergola Installer Gutter/Flashing Load List</b></p></td></tr>

<tr  ><td colspan="2"  width="50%" style="text-align:center;"> <b>Job No.:'.$contract["projectid"].'</b>  </td> <td colspan="2"  border="0"    >  <b>Description: '.$contract["framework"].'</b> </td>
</tr> 
</table>';

  

$head ='
<table border="1" cellspacing="0" style="border-collapse:collapse;font-size: 9pt;" width="100%"  cellpadding="5"> 
<tr  >
  <td colspan="2" width="50%"  >
    <b>Client Name:</b>&nbsp;'; 
    if($contract["is_builder"]==1){ $head .= addslashes($contract["builder_name"]); }else{ $head .= addslashes($contract["client_firstname"])." ".addslashes($contract["client_lastname"]);}

  $head .='   
  </td> 
  <td colspan="2" width="50%"   >
    <b>Installer:</b>'. addslashes($contract["erectors_name"]).'
  </td  >
</tr>
 
<tr>
  <td  > Wk Ph:'. $contract["client_wkphone"].' </td>
  <td  > Hm Ph:'. $contract["client_hmphone"].' </td> 
  <td  >  Fees: $'. $contract["install_comm_cost"].' </td>
  <td  >Extras: $'.$extras.' </td>
</tr>
 
<tr>
  <td colspan="2" style="  vertical-align:top;"  >
    <span>Mobile:</span>'. $contract["client_mobile"].'
  </td>  
  <td  colspan="2"   >Installation Date: '. ($contract['install_date']!="" ? date(PHP_DFORMAT,strtotime($contract['install_date'])):"").'</td>
  
</tr> 
<tr>
  <td colspan="2" style="  vertical-align:top;" rowspan="2"  >
    <span>Site:</span>'. addslashes($contract["site_address1"]).'<br/>'.addslashes($contract["site_address2"]).'
  </td>  
  <td  colspan="2" rowspan="2" ><b>Special Instructions:</b> </td> 

<!--  begin Generate data for special condition notes -->

    <div>
      <table border="0" cellspacing="0" style="border-collapse:collapse;font-size: 10pt;" width="100%"> ';
     
        $resultnotes = mysql_query("
          SELECT cf_id, datenotes, username, content, date_created 
          FROM ver_chronoforms_data_special_condition_vic 
          WHERE clientid = '".mysql_real_escape_string($_POST['clientid'])."'
     
        ");
        $i=1;
        if (!$resultnotes) {
          echo 'Could not run query: ' . mysql_error();
          exit;
        }
        while($row = mysql_fetch_assoc($resultnotes)) { 
          $head .=' <tr><td colspan="2" width="50%"></td><td colspan="2" width="50%" ><p><b>&nbsp;'.$i++.'.&nbsp;</b>'.$row['content'].'</p></td></tr>';
        }

    $head .=' </table>
    </div>
<!-- end Generate data for special condition notes -->         

</tr>
<tr>

</tr>
</table><br/> ';

$head_2 ='
<table border="1" cellspacing="0" style="border-collapse:collapse;font-size: 9pt;" width="100%"  cellpadding="5"> 
<tr  >
  <td colspan="2" width="50%"  >
    <b>Client Name:</b>&nbsp;'; 
    if($contract["is_builder"]==1){ $head_2 .= addslashes($contract["builder_name"]); }else{ $head_2 .= addslashes($contract["client_firstname"])." ".addslashes($contract["client_lastname"]);}

  $head_2 .='   
  </td> 
  <td colspan="2" width="50%"   >
     In - InHouse   Pre - Prepared   Del - Delivered
  </td  >
</tr>
 
<tr>
  <td  > Wk Ph:'. $contract["client_wkphone"].' </td>
  <td  > Hm Ph:'. $contract["client_hmphone"].' </td> 
  <td colspan="2" style="  vertical-align:top;"  ><span>Mobile:</span>'. $contract["client_mobile"].'</td>  
</tr>

<tr>  
  <td colspan="2" style="  vertical-align:top;"  >
    <span>Site:</span>'. addslashes($contract["site_address1"]).'<br/>'.addslashes($contract["site_address2"]).'
  </td>

<td colspan="2" style="  vertical-align:top;"  >

  <!-- begin Generate data for special condition notes -->

     <div>
       <table border="0" cellspacing="0" style="border-collapse:collapse;font-size: 10pt;" width="100%"> 
       <tr>
        <td style="  vertical-align:top;"  ><span><b>Special Instructions:</b></span>
      ';
      
         $resultnotes = mysql_query("
           SELECT cf_id, datenotes, username, content, date_created 
           FROM ver_chronoforms_data_special_condition_vic 
           WHERE clientid = '".mysql_real_escape_string($_POST['clientid'])."'
      
         ");
         $i=1;
         if (!$resultnotes) {
           echo 'Could not run query: ' . mysql_error();
           exit;
         }
         while($row = mysql_fetch_assoc($resultnotes)) { 
           // $head_2 .=' <tr><td colspan="4" ><p><b>&nbsp;'.$i++.'.&nbsp;</b>'.$row['content'].'</p></td></tr>';
          $head_2 .=' <br><b>&nbsp;'.$i++.'.&nbsp;</b>'.$row['content'].'';
         }
       
     $head_2 .=' </td></tr></table>
     </div>
  <!-- end Generate data for special condition notes --> 

</td>
</tr>
</table> ';

 
 $body = ' 
<table class=""   cellspacing="0" style="border-collapse:collapse;font-size:9pt; margin-top:5px;" >
  <tr >
      <th width="270"   border="1" style="text-align: center;" >
         <b>Description</b> 
      </th>
      <th width="45" border="1" style="text-align: right;">
         <b>Qty</b> 
      </th>
      <th width="65" border="1" style="text-align: right;">
         <b>Length</b> 
      </th>
      <th width="45" border="1" style="text-align: center; " >
         <b>UOM</b> 
      </th> 
      <th width="75" border="1" style="text-align: left;">
         <b>Color</b> 
      </th>
      <th width="85" border="1" >
         <b>Picked Up</b> 
      </th>
      <th width="75" border="1" >
         <b>Received</b> 
      </th>  
  </tr>';

 $body_2 = '  
<table class=""   cellspacing="0" style="border-collapse:collapse;font-size:9pt;" >
  <tr >
      <th width="255"   border="1" style="text-align: center;" >
         <b>Description</b> 
      </th>
      <th width="45" border="1" style="text-align: right;">
         <b>Qty</b> 
      </th>
      <th width="65" border="1" style="text-align: right;">
         <b>Length</b> 
      </th>
      <th width="45" border="1" style="text-align: center;" >
         <b>UOM</b> 
      </th> 
      <th width="75" border="1" style="text-align: left;">
         <b>Color</b> 
      </th>
      <th width="55" border="1" >
         <b>In</b> 
      </th>
      <th width="55" border="1" >
         <b>Pre</b> 
      </th>  
      <th width="55" border="1" >
         <b>Del</b> 
      </th>  
  </tr>'; 

 
$has_materials = 0;
  $sql = "SELECT * FROM ver_chronoforms_data_inventory_vic WHERE section IN ('Frame','Fixings','Downpipe','Vergola','Downpipe') GROUP BY section  ORDER BY inventoryid";
  //error_log( " SECTION: ".$sql, 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_sa\\my-error.log');
  $qcat = mysql_query ($sql);
  while ($cat = mysql_fetch_assoc($qcat)) {
    
    $has_materials = 0;
    
    $sql = "SELECT process_po FROM  ver_chronoforms_data_contract_bom_meterial_vic AS bm WHERE bm.projectid = '$projectid' AND bm.section='{$cat['section']}'   "; 
    //error_log( " MATERIALS: ".$sql, 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_sa\\my-error.log');
    $req = mysql_query ($sql) or die ('request "Could not execute SQL query" '.$sql);  
    $n = mysql_num_rows($req);
    $r = mysql_fetch_assoc($req);
    //error_log( "n=".$n, 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_sa\\my-error.log');
    if($n>0){
      $has_materials = 1;
      $process_po = $r['process_po'];
    }else{
      //$html .= "";//'</td> </tr>';
      continue;
    }
  
      $titleID = $projectid."_"."frame"."_".mt_rand(); 
 
        //Main item of a raw material that should display first like beam and post.
        $sql = "SELECT bm.id, m.qty, (m.qty*bm.qty) AS m_qty, bm.qty  AS ls_qty, bm.length,
            CASE WHEN m.uom='Mtrs' 
                THEN bm.raw_cost * bm.qty * bm.length  
                ELSE bm.raw_cost * bm.qty END AS ls_amount,
            bm.projectid, bm.inventoryid, bm.materialid, bm.raw_cost, bm.qty as bm_qty, bm.supplierid, m.raw_description, m.is_per_length, m.length_per_ea, m.uom, inv.photo, b.colour, b.finish
        FROM ver_chronoforms_data_contract_bom_meterial_vic AS bm  
        JOIN ver_chronoforms_data_contract_bom_vic AS b ON b.contract_item_cf_id=bm.contract_item_cf_id
        JOIN ver_chronoforms_data_inventory_vic AS inv ON inv.inventoryid=bm.inventoryid        
        JOIN ver_chronoforms_data_materials_vic AS m ON m.cf_id=bm.materialid  
        WHERE bm.projectid = '{$projectid}' AND inv.section='{$cat['section']}'  AND m.is_main_item=1  "; //ORDER BY is_per_length DESC, bm.id, b.length DESC, b.qty DESC
  
          $sql2 = "SELECT bm.id,   m.qty, (m.qty*bm.qty) AS m_qty, bm.length, bm.qty  AS ls_qty, SUM(bm.qty) AS t_qty, 
            CASE WHEN m.uom='Mtrs' 
                THEN bm.raw_cost * bm.qty * bm.length  
                ELSE bm.raw_cost * bm.qty END AS ls_amount,  
            bm.projectid, bm.inventoryid, bm.materialid, bm.raw_cost, bm.qty as bm_qty, bm.supplierid, m.raw_description, m.is_per_length, m.length_per_ea, m.uom  
        FROM ver_chronoforms_data_contract_bom_meterial_vic AS bm   
        JOIN ver_chronoforms_data_inventory_vic AS inv ON inv.inventoryid=bm.inventoryid        
        JOIN ver_chronoforms_data_materials_vic AS m ON m.cf_id=bm.materialid  
        WHERE bm.projectid = '{$projectid}' AND inv.section='{$cat['section']}' AND m.is_main_item=0  GROUP BY materialid  ";//ORDER BY is_per_length DESC

        $totalRrp = 0; 
        //error_log("sql : ". $sql, 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_sa\\my-error.log'); 
        // error_log("sql 2: ". $sql2, 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_sa\\my-error.log');
        $item_result = mysql_query ($sql);
        //$num_result = mysql_num_rows($item_result);
        $i = 1; $num_same_inv_id = 0;
        $prev_inv_id = "";
        $m_qty = 0; $m_amount = 0; $is_1st = 1; $is_2nd = 0; 
        //error_log("section: ".print_r($item_result,true), 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_sa\\my-error.log');
        while ($m = mysql_fetch_assoc($item_result)){ // error_log("section: ".print_r($m,true), 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_sa\\my-error.log');
          //error_log("inside : ", 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_sa\\my-error.log'); 
          //error_log("section: ".print_r($cat,true), 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_sa\\my-error.log');
          if($is_1st){ 
            $body .= '<tr><td colspan="7"><b><u>'.($cat['section']=="Frame"?"Framework":($cat['section']=="Fixings"?"Fittings":$cat['section'])).'</u></b></td></tr>';
            $body_2 .= '<tr><td colspan="7"><b><u>'.($cat['section']=="Frame"?"Framework":($cat['section']=="Fixings"?"Fittings":$cat['section'])).'</u></b></td></tr>';
          } 
          if($m['id']==""){ continue;$is_1st=0;} 
          $totalRrp += $m['ls_amount']; 
           // only 2nd of IRV59 and IRV60 will be displayed. 
          if(fnmatch("*Double Bay VR*",$VergolaType) && $section=="Vergola" && $m["inventoryid"]=="IRV59" ){ //IRV59 is a Pivot strip
            $m_qty += $m['m_qty'];
            $m_amount += $m['ls_amount'];

            if($is_2nd==0){
              $is_2nd = 1; //come here just for 1st time.
              continue;
            } 
          }else if(fnmatch("*Double Bay VR*",$VergolaType)  && $section=="Vergola" && $m["inventoryid"]=="IRV60" ){ //IRV60 is a Link Bar
            $m_qty += $m['m_qty'];
            $m_amount += $m['ls_amount'];

            if($is_2nd==0){
              $is_2nd = 1;  
              continue;
            } 
 
          }else{
            $m_qty = 0; $m_amount = 0; $is_2nd = 0; 
          } 

            
          $body .= '<tr border="0"> 
            <td >'.$m['raw_description'].'</td>  
            <td style="text-align:right;">'. number_format(($m_qty>0?$m_qty:$m['m_qty'])).'</td>
            <td style="text-align:right;">'. ($m['uom']=="Mtrs" && METRIC_SYSTEM == "inch"?get_feet_value($m['length']):($m['uom']=="Mtrs"?$m['length']:"")).'</td>
            <td style="text-align:right;">'.$m['uom'].'</td> 
            <td>'.$m['colour'].'</td>
            <td style="text-align: center;"><img src="images/box.jpg"/></td>
            <td style="text-align: center;"><img src="images/box.jpg"/></td> 
          </tr> '; 

          $body_2 .= '<tr border="0"> 
            <td >'.$m['raw_description'].'</td>  
            <td style="text-align:right;">'. number_format(($m_qty>0?$m_qty:$m['m_qty'])).'</td>
            <td style="text-align:right;">'. ($m['uom']=="Mtrs" && METRIC_SYSTEM == "inch"?get_feet_value($m['length']):($m['uom']=="Mtrs"?$m['length']:"")).'</td>
            <td style="text-align:right;">'.$m['uom'].'</td> 
            <td>'.$m['colour'].'</td>
            <td style="text-align: center;"><img src="images/box.jpg"/></td>
            <td style="text-align: center;"><img src="images/box.jpg"/></td> 
            <td style="text-align: center;"><img src="images/box.jpg"/></td> 
          </tr> '; 

           
            //error_log("html 1: ".$html, 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_sa\\my-error.log'); 
            $i++; 
            $is_1st=0;

         
         
          
    }
         
    $item_result2 = mysql_query ($sql2);
    
    while ($m = mysql_fetch_assoc($item_result2)){ 
      $totalRrp += $m['ls_amount']; 
      if($m['id']==""){continue;} 
       
      $body .='<tr> 
        <td  >'.$m['raw_description'].'</td>  
        <td style="text-align:right;">'. number_format($m['t_qty']).'</td>
        <td style="text-align:right;">'. ($m['uom']=="Mtrs" && METRIC_SYSTEM == "inch"?get_feet_value($m['length']):($m['uom']=="Mtrs"?$m['length']:"")).'</td>
        <td style="text-align:right;">'.$m['uom'].'</td> 
        <td> </td>
        <td style="text-align:center;"><img src="images/box.jpg"/></td>
        <td style="text-align:center;"><img src="images/box.jpg"/></td> 
      </tr>';

      $body_2 .='<tr> 
        <td  >'.$m['raw_description'].'</td>  
        <td style="text-align:right;">'. number_format($m['t_qty']).'</td>
        <td style="text-align:right;">'. ($m['uom']=="Mtrs" && METRIC_SYSTEM == "inch"?get_feet_value($m['length']):($m['uom']=="Mtrs"?$m['length']:"")).'</td>
        <td style="text-align:right;">'.$m['uom'].'</td> 
        <td> </td>
        <td style="text-align:center;"><img src="images/box.jpg"/></td>
        <td style="text-align:center;"><img src="images/box.jpg"/></td> 
        <td style="text-align:center;"><img src="images/box.jpg"/></td> 
      </tr>';
      //error_log("html2 : ".$html, 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_sa\\my-error.log'); 
        }  

         
        //  } //end of bom material loop   <img src="'.JURI::base().'images/box.jpg"  />  
  } //end of inventory section type
         
 
    //} //------------ bm END contract_bom_vic loop. 

    $gst = $totalRrp * 0.1;
    $totalSum = $totalRrp + $gst;

        
  $body .='</table> 
    <p style="font-size:9pt;">
    <b>Authorised By:</b><u>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</u>
    <b>Signature:</b><u>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </u>
    <b>Date:</b><u>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </u>
    <br/><br/>
    <b>Comments:</b> 
    <br/><br/><br/>
    </p> ';

  $body_2 .='</table> 
    <p style="font-size:8pt;">&nbsp;</p>
    <p style="font-size:9pt;">
    <b>Authorised By:</b><u>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</u>
    <b>Signature:</b><u>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </u>
    <b>Date:</b><u>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </u>
    <br/><br/>
    <b>Comments:</b> 
    <br/><br/><br/>
    </p> '; 

  $p = '<div style="page-break-inside: always; page-break-after: always; ">'; 
  $p2 = '<div  style="page-break-inside: always;" >'; 
  $_p = '</div>';

  //$html = $p.$title.$head.$body.$_p;
  $html = $p.$title.$head.$body.$_p; //installer load list
  $html .= $p2.$title_2.$head_2.'<p style="font-size:8pt;">&nbsp;</p>'.$body_2 .$_p; //factory load list
  
  //error_log("html : ".$html, 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_sa\\my-error.log'); 
  return $html;
}


function generate_html_load_list_gutter_flashing($projectid){
  $url=JURI::base();
  //error_log('url:'.$url, 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_sa\\my-error.log');
  $sql = "SELECT * FROM ver_chronoforms_data_contract_list_vic AS contract JOIN ver_chronoforms_data_clientpersonal_vic AS c ON c.clientid = contract.quoteid JOIN ver_chronoforms_data_contract_vergola_vic as cv ON cv.projectid=contract.projectid WHERE  contract.projectid = '".$projectid."' ";
  // error_log($sql, 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_sa\\my-error.log');
  $qContract = mysql_query($sql);
  $contract = mysql_fetch_array($qContract); 

  $VergolaType = $contract['framework']; 

  $title_1 = '<table border="0" cellspacing="0" style="border-collapse:collapse;font-size: 10pt;" width="100%"  cellpadding="5">
<tr ><td colspan="4"  ><p style="font-size: 14pt; text-align: center;"><b>Vergola Installer Gutter/Flashing Load List</b></p></td></tr>

<tr  ><td colspan="2"  width="50%" style="text-align:center;"> <b>Job No.:'.$contract["projectid"].'</b>  </td> <td colspan="2"  border="0"    >  <b>Description: '.$contract["framework"].'</b> </td>
</tr> 
</table>';

  $title_2 = '<table border="0" cellspacing="0" style="border-collapse:collapse;font-size: 10pt;" width="100%"  cellpadding="5">
<tr ><td colspan="4"  ><p style="font-size: 14pt; text-align: center;"><b>Vergola Factory Gutter/Flashing Load List</b></p></td></tr>

<tr  ><td colspan="2"  width="50%" style="text-align:center;"> <b>Job No.:'.$contract["projectid"].'</b>  </td> <td colspan="2"  border="0"    >  <b>Description: '.$contract["framework"].'</b> </td>
</tr> 
</table>';

 

$head ='
<table border="1" cellspacing="0" style="border-collapse:collapse;font-size: 9pt;" width="100%"  cellpadding="5"> 
<tr  >
  <td colspan="2" width="50%"  >
    <b>Client Name:</b>&nbsp;'; 
    if($contract["is_builder"]==1){ $head .= addslashes($contract["builder_name"]); }else{ $head .= addslashes($contract["client_firstname"])." ".addslashes($contract["client_lastname"]);}

  $head .='   
  </td> 
  <td colspan="2" width="50%" rowspan="4"  >
    &nbsp; In - InHouse  |  Load - Load   <br/> Pre - Prepared  |  Del - Delivered 
  </td  >
   
</tr>
 
<tr>
  <td  > Wk Ph:'. $contract["client_wkphone"].' </td>
  <td  > Hm Ph:'. $contract["client_hmphone"].' </td> 
    
</tr>
 
<tr>
  <td colspan="2" style="  vertical-align:top;"  >
    <span>Mobile:</span>'. $contract["client_mobile"].'
  </td>    
</tr> 
<tr>
  <td colspan="2" style="  vertical-align:top;"  >
    <span>Site:</span>'. addslashes($contract["site_address1"]).'<br/>'.addslashes($contract["site_address2"]).'
  </td>  
</tr>
</table> ';


  $body = '<br/>  
<table class=""   cellspacing="0" style="border-collapse:collapse;font-size:9pt;" >
  <tr >
      <th width="270"   border="1" style="text-align: center;" >
         <b>Description</b> 
      </th>
      <th width="45" border="1" style="text-align: right;">
         <b>Qty</b> 
      </th>
      <th width="65" border="1" style="text-align: right;">
         <b>Length</b> 
      </th>
      <th width="45" border="1" style="text-align: center;" >
         <b>UOM</b> 
      </th> 
      <th width="75" border="1" style="text-align: left;">
         <b>Color</b> 
      </th>
      <th width="50" border="1" >
         <b>In</b> 
      </th>
      <th width="50" border="1" >
         <b>Load</b> 
      </th> 
      <th width="50" border="1" >
         <b>Pre</b> 
      </th>  
      <th width="50" border="1" >
         <b>Del</b> 
      </th>  
  </tr>'; 


$has_materials = 0;
  $sql = "SELECT * FROM ver_chronoforms_data_inventory_vic WHERE section IN ('Guttering','Flashings') GROUP BY section  ORDER BY inventoryid";

  $qcat = mysql_query ($sql);
  while ($cat = mysql_fetch_assoc($qcat)) {
    
    $has_materials = 0;
    
      $sql = "SELECT process_po FROM  ver_chronoforms_data_contract_bom_meterial_vic AS bm WHERE bm.projectid = '$projectid' AND bm.section='{$cat['section']}'   "; 
      //error_log( $sql, 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_sa\\my-error.log');
      $req = mysql_query ($sql) or die ('request "Could not execute SQL query" '.$sql);  
      $n = mysql_num_rows($req);
      $r = mysql_fetch_assoc($req);
      //error_log( "n=".$n, 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_sa\\my-error.log');
      if($n>0){
        $has_materials = 1;
        $process_po = $r['process_po'];
      }else{
        $html .= "";//'</td> </tr>';
        continue;
      }
   
      $titleID = $projectid."_"."frame"."_".mt_rand();  
        
        //Main item of a raw material that should display first like beam and post.
        $sql = "SELECT bm.id, m.qty, (m.qty*bm.qty) AS m_qty, bm.qty  AS ls_qty, bm.length,
            CASE WHEN m.uom='Mtrs' 
                THEN bm.raw_cost * bm.qty * bm.length  
                ELSE bm.raw_cost * bm.qty END AS ls_amount,
            bm.projectid, bm.inventoryid, bm.materialid, bm.raw_cost, bm.qty as bm_qty, bm.supplierid, m.raw_description, m.is_per_length, m.length_per_ea, m.uom, inv.photo, b.colour, b.finish
        FROM ver_chronoforms_data_contract_bom_meterial_vic AS bm  
        JOIN ver_chronoforms_data_contract_bom_vic AS b ON b.contract_item_cf_id=bm.contract_item_cf_id
        JOIN ver_chronoforms_data_inventory_vic AS inv ON inv.inventoryid=bm.inventoryid        
        JOIN ver_chronoforms_data_materials_vic AS m ON m.cf_id=bm.materialid  
        WHERE bm.projectid = '{$projectid}' AND inv.section='{$cat['section']}'  AND m.is_main_item=1  "; //ORDER BY is_per_length DESC, bm.id, b.length DESC, b.qty DESC
  
          $sql2 = "SELECT bm.id,   m.qty, (m.qty*bm.qty) AS m_qty, bm.length, bm.qty  AS ls_qty, SUM(bm.qty) AS t_qty, 
            CASE WHEN m.uom='Mtrs' 
                THEN bm.raw_cost * bm.qty * bm.length  
                ELSE bm.raw_cost * bm.qty END AS ls_amount,  
            bm.projectid, bm.inventoryid, bm.materialid, bm.raw_cost, bm.qty as bm_qty, bm.supplierid, m.raw_description, m.is_per_length, m.length_per_ea, m.uom  
        FROM ver_chronoforms_data_contract_bom_meterial_vic AS bm   
        JOIN ver_chronoforms_data_inventory_vic AS inv ON inv.inventoryid=bm.inventoryid        
        JOIN ver_chronoforms_data_materials_vic AS m ON m.cf_id=bm.materialid  
        WHERE bm.projectid = '{$projectid}' AND inv.section='{$cat['section']}' AND m.is_main_item=0  GROUP BY materialid  ";//ORDER BY is_per_length DESC

        $totalRrp = 0; 
        //error_log("sql : ". $sql, 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_sa\\my-error.log'); 
        // error_log("sql 2: ". $sql2, 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_sa\\my-error.log');
        $item_result = mysql_query ($sql);
        //$num_result = mysql_num_rows($item_result);
        $i = 1; $num_same_inv_id = 0;
        $prev_inv_id = "";
        $m_qty = 0; $m_amount = 0; $is_1st = 1; $is_2nd = 0; 
        while ($m = mysql_fetch_assoc($item_result)){ 

          //error_log("inside : ", 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_sa\\my-error.log'); 
          if($is_1st){ 
            $body .= '<tr><td colspan="7"><b><u>'.($cat['section']=="Frame"?"Framework":($cat['section']=="Fixings"?"Fittings":$cat['section'])).'</u></b></td></tr>';

          } 
          if($m['id']==""){ continue;$is_1st=0;} 
          $totalRrp += $m['ls_amount']; 
           // only 2nd of IRV59 and IRV60 will be displayed. 
          if(fnmatch("*Double Bay VR*",$VergolaType) && $section=="Vergola" && $m["inventoryid"]=="IRV59" ){ //IRV59 is a Pivot strip
            $m_qty += $m['m_qty'];
            $m_amount += $m['ls_amount'];

            if($is_2nd==0){
              $is_2nd = 1; //come here just for 1st time.
              continue;
            } 
          }else if(fnmatch("*Double Bay VR*",$VergolaType)  && $section=="Vergola" && $m["inventoryid"]=="IRV60" ){ //IRV60 is a Link Bar
            $m_qty += $m['m_qty'];
            $m_amount += $m['ls_amount'];

            if($is_2nd==0){
              $is_2nd = 1;  
              continue;
            } 
 
          }else{
            $m_qty = 0; $m_amount = 0; $is_2nd = 0; 
          } 

              
          $body .= '<tr border="0"> 
            <td width="285">'.$m['raw_description'].'</td>  
            <td width="40" style="text-align:right;">'. number_format(($m_qty>0?$m_qty:$m['m_qty'])).'</td>
            <td width="60" style="text-align:right;">'. ($m['uom']=="Mtrs" && METRIC_SYSTEM == "inch"?get_feet_value($m['length']):($m['uom']=="Mtrs"?$m['length']:"")).'</td>
            <td width="40" style="text-align:right;">'.$m['uom'].'</td> 
            <td width="75">'.$m['colour'].'</td>
            <td width="50" style="text-align: center;"><img src="images/box.jpg"/></td>
            <td width="50" style="text-align: center;"><img src="images/box.jpg"/></td>
            <td width="50" style="text-align: center;"><img src="images/box.jpg"/></td> 
            <td width="50" style="text-align: center;"><img src="images/box.jpg"/></td> 
          </tr> '; 
            //error_log("html 1: ".$html, 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_sa\\my-error.log'); 
            $i++; 
            $is_1st=0;

        if($m["photo"] !=""  ){ //$section=="Guttering"

          $body .=' 
          <tr>
              <td rowspan="3" width="285">';
                 
                if($m["photo"] !="") { 
                  $body .='<img src="images/inventory/'.$m['photo'].'"   style="float:left;padding:0px 0px 0px 0; width: 345px;"/>';
              } 
            $body .='    
              </td>
              <td colspan="8"></td> 
            </tr>'; 
     
          //mysql_data_seek($item_result, 0); 
            
          if($prev_inv_id==""){
            $prev_inv_id = $m['inventoryid'];

          }else if($prev_inv_id == $m['inventoryid']){
             
            $num_same_inv_id++;

          }else{
            $num_same_inv_id = 0;
          }

          $sql = "SELECT id.length AS l, id.dimension_a, id.dimension_b, id.dimension_c, id.dimension_d, id.dimension_e, id.dimension_f, id.dimension_p FROM ver_chronoforms_data_contract_items_deminsions  AS id   WHERE projectid = '{$projectid}' AND inventoryid='{$m['inventoryid']}' LIMIT 1  OFFSET {$num_same_inv_id} ";

          //error_log("sql G: ". $sql, 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_sa\\my-error.log');
          
          $r_item_dimension = mysql_query ($sql);
          $item_dimension = mysql_fetch_assoc($r_item_dimension); 


          if(!empty($item_dimension)){
        
          $body .='        
            <tr>
              <td align="right" width="70"  >Length</td>
              <td align="center" width="40">A</td>
              <td align="left" width="40">B</td>
              <td align="left" width="40">C</td>
              <td align="left" width="40">D</td>
              <td align="left" width="40">E</td>
              <td align="left" width="40">F</td>
              <td align="left" width="40">P</td>
            </tr>
            <tr> 
               
            <td valign="top" align="right" >'.$item_dimension["l"].' </td>
            <td valign="top" align="center"  >'.$item_dimension["dimension_a"].'</td>
            <td valign="top" align="left"  >'.$item_dimension["dimension_b"].'</td>
            <td valign="top" align="left"  >'.$item_dimension["dimension_c"].'</td>
              <td valign="top" align="left"  >'.$item_dimension["dimension_d"].'</td>
              <td valign="top" align="left"  >'.$item_dimension["dimension_e"].'</td>
              <td valign="top" align="left"  >'.$item_dimension["dimension_f"].'</td>
              <td valign="top" align="left"  >'.$item_dimension["dimension_p"].'</td>   
               
            </tr>';
                 
             
         
            
            } //end if if it has a dimension
            
            $i++; 

            if($m["photo"] !="" ){

              $body .=' <tr>
                  <td colspan="9" style="border:none">&nbsp;</td> 
                </tr>';
            }  
           
          } //end of if it has a photo   
          
    }
         
    $item_result2 = mysql_query ($sql2);
    
    while ($m = mysql_fetch_assoc($item_result2)){ 
      $totalRrp += $m['ls_amount']; 
      if($m['id']==""){continue;} 
       
        
      $body .='<tr> 
        <td width="285" >'.$m['raw_description'].'</td>  
        <td width="40" style="text-align:right;">'. number_format($m['t_qty']).'</td>
        <td width="60" style="text-align:right;">'. ($m['uom']=="Mtrs" && METRIC_SYSTEM == "inch"?get_feet_value($m['length']):($m['uom']=="Mtrs"?$m['length']:"")).'</td>
        <td width="40" style="text-align:right;">'.$m['uom'].'</td> 
        <td width="75"> </td>
        <td width="50" style="text-align:center;"><img src="images/box.jpg"/></td>
        <td width="50" style="text-align:center;"><img src="images/box.jpg"/></td> 
        <td width="50" style="text-align:center;"><img src="images/box.jpg"/></td> 
        <td width="50" style="text-align:center;"><img src="images/box.jpg"/></td> 
      </tr>';
      //error_log("html2 : ".$html, 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_sa\\my-error.log'); 
        }  

         
        //  } //end of bom material loop   <img src="'.JURI::base().'images/box.jpg"  />  
  } //end of inventory section type
         
  $body .='</table> ';
    //} //------------ bm END contract_bom_vic loop. 

    $gst = $totalRrp * 0.1;
    $totalSum = $totalRrp + $gst;

        
  $footer  ='  
    <p style="font-size:9pt;">
    <b>Authorised By:</b><u>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</u>
    <b>Signature:</b><u>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </u>
    <b>Date:</b><u>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </u>
    <br/><br/>
    <b>Comments:</b> 
    <br/><br/><br/>
    </p> ';
  

  $p = '<div style="page-break-inside: always; page-break-after: always; ">'; 
  $p2 = '<div  style="page-break-inside: always;" >'; 
  $_p = '</div>';

  //$html = $p.$title.$head.$body.$_p;
  $html = $p.$title_1.$head.$body.$footer.$_p; //installer load list
  $html .= $p2.$title_2.$head.'<p style="font-size:8pt;">&nbsp;</p>'.$body.$footer.'<p style="font-size:8pt;">&nbsp;</p>'.$_p; //factory load list
  
  //error_log("html2 : ".$html, 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_sa\\my-error.log'); 
  return $html;

}


?>