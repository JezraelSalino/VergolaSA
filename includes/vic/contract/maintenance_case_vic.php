<script src="<?php echo JURI::base().'jscript/jsapi.js'; ?>"></script>
<script src="<?php echo JURI::base().'jscript/jquery.min.js'; ?>"></script>
<!-- <script src="<?php echo JURI::base().'jscript/jquery-ui-1.11.4/jquery.js'; ?>"></script> -->
<script src="<?php echo JURI::base().'jscript/labels.js'; ?>"></script>
<script type="text/javascript" src="<?php echo JURI::base().'jscript/tabcontent.js'; ?>"></script>
<script charset="UTF-8" type="text/javascript" src="<?php echo JURI::base().'jscript/datetime/js/jquery-1.8.3.min.js'; ?>"></script>

<script type="text/javascript" src="<?php echo JURI::base().'jscript/datetime/js/bootstrap.min.js'; ?>"></script>
<script charset="UTF-8" type="text/javascript" src="<?php echo JURI::base().'jscript/datetime/js/bootstrap-datetimepicker.js'; ?>"></script>
 
<link rel="stylesheet" type="text/css" media="screen,projection" href="<?php echo JURI::base().'jscript/jquery-ui-1.11.4/jquery-ui.min.css'; ?>" /> 
<link rel="stylesheet" type="text/css" media="screen,projection" href="<?php echo JURI::base().'jscript/custom.css'; ?>" /> 
<link rel="stylesheet" type="text/css" media="screen,projection" href="<?php echo JURI::base().'jscript/datetime/css/bootstrap.min.css'; ?>" />
<link rel="stylesheet" type="text/css" media="screen,projection" href="<?php echo JURI::base().'jscript/datetime/css/bootstrap-datetimepicker.min.css'; ?>" />

 
<?php  
date_default_timezone_set('Australia/Victoria');
$notification = "";
$is_builder = 0;
  
$page_name = "";
$request = parse_url($_SERVER['REQUEST_URI']);
$page_name = substr($request["path"],1);
$projectid = mysql_escape_string($_REQUEST['projectid']);
$type = mysql_escape_string($_REQUEST['type']);
$caseid = mysql_escape_string($_REQUEST['caseid']);

//error_log(print_r($_POST,true), 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_sa\\my-error.log');
  
if(isset($_POST['save'])){	//create new case
  
  $projectid = mysql_escape_string($_POST['projectid']);
  $clientid = mysql_escape_string($_POST['clientid']);
  $caller_name = mysql_escape_string($_POST['caller_name']);
  $taken_by = mysql_escape_string($_POST['taken_by']);
  $issue = mysql_escape_string($_POST['issue']);
  $maintenance_person = mysql_escape_string($_POST['maintenance_person']);
  //$schedule_visit = mysql_escape_string($_POST['schedule_visit']);
  if(empty($_POST['schedule_visit'])==true || $_POST['schedule_visit']=="0000-00-00 00:00:00")
     $schedule_visit = "NULL";
  else
    $schedule_visit = "'".$_POST['schedule_visit']."'";

  			
  $sql = "INSERT INTO ver_chronoform_maintenance_case_vic
               (projectid,
							  clientid, 
							  caller_name, 
							  taken_by, 
							  issue,
                maintenance_person,
                schedule_visit,
                status) 
		 VALUES ('$projectid',
		         '$clientid', 
		         '$caller_name', 
				 '$taken_by', 
				 '$issue',
         '$maintenance_person',
         $schedule_visit,
         'open')";
  //error_log($sql, 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_sa\\my-error.log'); //exit();
  mysql_query($sql);

  //$last_id = mysqli_insert_id($con);
  $sql = "SELECT id FROM ver_chronoform_maintenance_case_vic ORDER BY id DESC limit 1  ";
    
  $result = mysql_fetch_assoc(mysql_query($sql)); 
  $last_id = $result['id'];

  $note = mysql_escape_string($_POST['note']);
  $sql = "INSERT INTO ver_chronoform_maintenance_case_job_vic
               (case_id,  
                taken_by, 
                maintenance_person,
                schedule_visit) 
     VALUES ('$last_id',
             '$taken_by',  
            '$maintenance_person',
            '$schedule_visit')";
  //error_log($sql, 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_sa\\my-error.log'); //exit();
  mysql_query($sql);
   
  header('Location:'.JURI::base().'maintenance/maintenance-folder-vic?page_name=maintenancefolder&projectid='.$projectid); 
				
}
else if(isset($_POST['update'])){ //update a case
  //error_log(print_r($_POST,true), 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_sa\\my-error.log');
  $caseid = mysql_escape_string($_POST['caseid']);
  $projectid = mysql_escape_string($_POST['projectid']);
  $clientid = mysql_escape_string($_POST['clientid']);
  $caller_name = mysql_escape_string($_POST['caller_name']);
  $taken_by = mysql_escape_string($_POST['taken_by']);
  $issue = mysql_escape_string($_POST['issue']);
  $maintenance_person = mysql_escape_string($_POST['maintenance_person']);
  $case_status = mysql_escape_string($_POST['case_status']);
  //$schedule_visit = mysql_escape_string($_POST['schedule_visit']);
  if(empty($_POST['schedule_visit'])==true || $_POST['schedule_visit']=="0000-00-00 00:00:00")
     $schedule_visit = "NULL";
  else
    $schedule_visit = "'".$_POST['schedule_visit']."'";


  $sql = "UPDATE ver_chronoform_maintenance_case_vic SET projectid='$projectid', clientid='$clientid', caller_name='$caller_name', taken_by='$taken_by', maintenance_person='$maintenance_person', schedule_visit=$schedule_visit, issue='$issue', status='$case_status' WHERE id='$caseid';";
  //error_log($sql, 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_sa\\my-error.log'); //exit();
  mysql_query($sql);
  
  //header('Location:'.JURI::base().'maintenance/maintenance-folder-vic?page_name=maintenancefolder&projectid='.$projectid);
    
}
else if(isset($_POST['update_job'])){ 
  //error_log(print_r($_POST,true), 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_sa\\my-error.log');
  $jobid = mysql_escape_string($_POST['jobid']);
  $caseid = mysql_escape_string($_POST['caseid']);
  $projectid = mysql_escape_string($_POST['projectid']);
  $clientid = mysql_escape_string($_POST['clientid']);
  $caller_name = mysql_escape_string($_POST['caller_name']);
  $taken_by = mysql_escape_string($_POST['taken_by']);
  $note = mysql_escape_string($_POST['note']);
  $maintenance_person = mysql_escape_string($_POST['maintenance_person']);
  //$schedule_visit = mysql_escape_string($_POST['schedule_visit']);
  //$site_visited = mysql_escape_string($_POST['site_visited']);

  if(empty($_POST['schedule_visit'])==true || $_POST['schedule_visit']=="0000-00-00 00:00:00")
     $schedule_visit = "NULL";
  else
    $schedule_visit = "'".$_POST['schedule_visit']."'";

  if(empty($_POST['site_visited'])==true || $_POST['site_visited']=="0000-00-00 00:00:00")
     $site_visited = "NULL";
  else
    $site_visited = "'".$_POST['site_visited']."'";

  
  $sql = "UPDATE ver_chronoform_maintenance_case_job_vic SET  taken_by='$taken_by', maintenance_person='$maintenance_person', schedule_visit=$schedule_visit, site_visited=$site_visited, note='$note' WHERE id='$jobid';";
  //error_log(" Update job: ".$sql, 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_sa\\my-error.log'); //exit();
  mysql_query($sql);
  
  //header('Location:'.JURI::base().'maintenance/maintenance-folder-vic?page_name=maintenancefolder&projectid='.$projectid);
    
}
else if(isset($_POST['new_job'])){ 
  $caseid = mysql_escape_string($_REQUEST['caseid']);
  $taken_by = mysql_escape_string($_POST['taken_by']);
  $issue = mysql_escape_string($_POST['issue']);
  $maintenance_person = mysql_escape_string($_POST['maintenance_person']); 

  if(empty($_POST['schedule_visit'])==true || $_POST['schedule_visit']=="0000-00-00 00:00:00")
     $schedule_visit = "NULL";
  else
    $schedule_visit = "'".$_POST['schedule_visit']."'";

  if(empty($_POST['site_visited'])==true || $_POST['site_visited']=="0000-00-00 00:00:00")
     $schedule_visit = "NULL";
  else
    $site_visited = "'".$_POST['site_visited']."'";

  $sql = "SELECT id FROM ver_chronoform_maintenance_case_vic ORDER BY id DESC limit 1  ";
    
  $result = mysql_fetch_assoc(mysql_query($sql));
  $last_id = $result['id'];

  $note = mysql_escape_string($_POST['note']);
  $sql = "INSERT INTO ver_chronoform_maintenance_case_job_vic
               (case_id, 
                taken_by, 
                maintenance_person,
                schedule_visit,
                site_visited,
                note) 
     VALUES ('$last_id',
             '$taken_by',  
            '$maintenance_person',
            $schedule_visit,
           $site_visited,
            '$note')";
           
  //error_log($sql, 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_sa\\my-error.log'); //exit();
  mysql_query($sql);
}

  
$is_edit = 0;
if(isset($_REQUEST['pid']))
{ 
  $is_edit = 1;
  $pid = mysql_real_escape_string($_REQUEST['pid']);
    
  $sql = "SELECT *, DATE_FORMAT(datelodged,'".SQL_DFORMAT."') fdatelodged, DATE_FORMAT(appointmentdate,'".SQL_DFORMAT." @ %h:%i %p') fappointmentdate  FROM ver_chronoforms_data_clientpersonal_vic WHERE pid={$pid} ";
    
  $client = mysql_fetch_assoc(mysql_query($sql));
  $is_builder = $client['is_builder'];


  if($client == null){
    echo "Can't find client.";
    return;
  }
 
}

$user =& JFactory::getUser(); 
?>

<?php  
  $form->data['date_entered'] = date(PHP_DFORMAT);
  $form->data['date_time'] = date(PHP_DFORMAT.' g:i A');

  if($type=="new"){ 
      $sql = "SELECT c.projectid, c.quoteid, cp.clientid, CONCAT(coalesce(cp.client_firstname,''),' ',coalesce(cp.client_lastname,''),' ',coalesce(cp.builder_name,'')) as customer_name, CONCAT(coalesce(cp.client_address1,''),' ',coalesce(cp.client_suburb,''),' ',coalesce(cp.client_state,''),' ',coalesce(cp.client_postcode,'')) as client_address, cp.client_mobile, cv.erectors_name, cv.handover_date, DATE_FORMAT(cv.handover_date,'{$sql_dformat}') fhandover_date, cv.elect_warranty_end_date, DATE_FORMAT(cv.elect_warranty_end_date,'{$sql_dformat}') felect_warranty_end_date, cv.warranty_end_date, DATE_FORMAT(cv.warranty_end_date,'{$sql_dformat}') fwarranty_end_date FROM ver_chronoforms_data_contract_list_vic AS c JOIN ver_chronoforms_data_contract_vergola_vic AS cv ON cv.projectid=c.projectid JOIN ver_chronoforms_data_clientpersonal_vic AS cp ON cp.clientid=c.quoteid WHERE c.projectid='{$projectid}' ";

       //error_log($sql, 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_sa\\my-error.log'); 
        $sql_result = mysql_query ($sql) or die ('request "Could not execute SQL query" '.$sql);
        $case = mysql_fetch_assoc($sql_result);
  }else{
      $sql = "SELECT c.projectid, cp.clientid, CONCAT(coalesce(cp.client_firstname,''),' ',coalesce(cp.client_lastname,''),' ',coalesce(cp.builder_name,'')) as customer_name, CONCAT(coalesce(cp.client_address1,''),' ',coalesce(cp.client_suburb,''),' ',coalesce(cp.client_state,''),' ',coalesce(cp.client_postcode,'')) as client_address, c.caller_name, c.issue, cp.client_mobile, c.maintenance_person, c.schedule_visit, DATE_FORMAT(c.schedule_visit,'".SQL_DFORMAT." @ %h:%i %p') AS fschedule_visit 
FROM  ver_chronoform_maintenance_case_vic AS c  
JOIN ver_chronoforms_data_clientpersonal_vic AS cp ON cp.clientid=c.clientid WHERE c.id='{$caseid}' ";

      $sql2 = "SELECT  *, DATE_FORMAT(c.schedule_visit,'".SQL_DFORMAT." @ %h:%i %p') AS fschedule_visit, DATE_FORMAT(c.site_visited,'".SQL_DFORMAT." @ %h:%i %p') AS fsite_visited    FROM  ver_chronoform_maintenance_case_job_vic AS c   WHERE c.case_id='{$caseid}' ";

      //error_log($sql, 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_sa\\my-error.log'); 
      $sql_result = mysql_query ($sql) or die ('request "Could not execute SQL query" '.$sql);
      $case = mysql_fetch_assoc($sql_result);

      $jobs_query = mysql_query ($sql2) or die ('request "Could not execute SQL query" '.$sql2);
       
  } 
 

?>
    
<div id="notification" class="notification_box hide"  ></div>
<h2 style="margin:0 0 5px 5px;">Case</h2>
<input type='button'  value='Close' style='width:100px;margin:0 0 5px 5px;' name='cancel' class='bbtn btn' onclick="location.href='<?php echo JURI::base(); ?>maintenance/maintenance-folder-vic?page_name=maintenancefolder&projectid=<?php echo $projectid; ?>'"  />


<!------ CASE FORM ----------> 
<form method="post" action="" class="Chronoform hasValidation" id="chronoform_New_Client_Enquiry_Vic" enctype="multipart/form-data">

  <div class="column-left"></div>
  <div class="column-right"></div>
  <div id="tabs_wrapper" class="client-builder-tab" style="width: 40%">

     <?php 
            $cbo_installer = "<select    name=\"maintenance_person\" style=''><option value=''>Select Maintenance</option>"; 
      $querysub="SELECT * FROM ver_chronoforms_data_installer_vic ORDER BY name ASC";

                  $resultsub = mysql_query($querysub);
                    if(!$resultsub){die ("Could not query the database: <br />" . mysql_error()); }
            
            while ($data=mysql_fetch_assoc($resultsub)){  

                if($data['name']==$case['maintenance_person']){ 
                        $cbo_installer .= "<option value = \"".addslashes($data['name'])."\" selected>{$data['name']}</option>";
                    }else{
                        $cbo_installer .= "<option value = \"".addslashes($data['name'])."\">{$data['name']}</option>";
                    } 
              }
      $cbo_installer .= "</select>";

      $cbo_status = "<select    name=\"case_status\" style='width:75px;'>
                      <option value='open' ".($case['status']=="open"?"selected":"").">Open</option> 
                      <option value='close' ".($case['status']=="close"?"selected":"").">Close</option>".
      $cbo_status .= "</select>"; 
    ?>
     
    <div id="tabs_content_container" style="border-top: 1px solid #ccc;">  
      <div id="client" class="tab_content" style="display: block; "> 
        <input type="hidden" name="projectid" value="<?php echo $projectid; ?>"   />
        <input type="hidden" name="clientid" value="<?php echo $case['clientid']; ?>" />
        <input type="hidden" name="taken_by" value="<?php echo $user->name; ?>"  />
        <input type="hidden" name="caseid" value="<?php echo $caseid; ?>" />
        <?php
            if($type=="edit"){
              echo "<span class='' style='display:inline-block;width: 48%; margin:10px 0;'><label>Case ID :</label> <label>".$caseid."</label></span>";
              echo "<span class='' style='display:inline-block;width: 48%; margin:10px 0;'><label>Status :</label> <label>".$cbo_status."</label></span>";
        } ?>
        <span class="" style="display:inline-block;width: 48%; margin:10px 0;"><label>Project ID :</label> <label><?php echo $projectid; ?></label></span>
        <span class="" style="display:inline-block;width: 48%; margin:10px 0;">  <label style="display:inline-block;width: 48%;">Date Logged :</label> <label><?php echo date(PHP_DFORMAT); ?></label></span>
        <span class="" style="display:inline-block;width: 48%; margin:10px 0;"><label>Customer Account :</label> <label><?php echo $case['customer_name']; ?></label>   </span> 
        <span class="" style="display:inline-block;width: 48%; margin:10px 0;"> <label>Taken By :</label> <label><?php echo $user->name; ?></label> </span> 
          
        <span class="" style="display:inline-block;width: 100%; margin:10px 0;"><label>Caller Name : <input type="text" value="<?php echo $case['caller_name']; ?>" name="caller_name" style="width: 175px; padding:3px;"></label>   </span>
         
        <span></span>
        Issue :
        <textarea name="issue" id="" style="width: 100%; height: 100px; margin:0 0 10px 0;"><?php echo $case['issue'] ?></textarea>

        <span class="" style="display:inline-block;width: 48%; margin:10px 0;"> <label>Maintenance Person:  <?php echo $cbo_installer ?></label> </span> 
        <!-- <span class="" style="display:inline-block;width: 48%; margin:10px 0;"><label>Schedule Visit: <input type="text" value="<?php echo $case['schedule_visit']; ?>" name="schedule_visit" style="width: 175px; padding:3px;"></label>   </span> -->

        Schedule Visit:
        <div class="input-group date form_datetime col-md-5" data-date-format="<?php echo JS_DFORMAT." @ HH:ii P"; ?>" data-link-field="case_schedule_visit" style="display:inline-block">
          <label class='input'> <span id='date-entered'> </span>
            <input type="text" id="iappointment" name="iappointment" class="form-control" value="<?php echo $case['fschedule_visit'] ?>" readonly style="width: 150px;">
          </label>
           <span class="input-group-addon"><span class="glyphicon glyphicon-th"></span></span> 
        </div>
        <input type="hidden" id="case_schedule_visit" name="schedule_visit" value="<?php echo $case['schedule_visit'] ?>" />

        <span style="display:inline-block;width: 100%; margin:10px 0;"> <input type="submit" value="<?php echo ($type=="new"?"save":"update"); ?>" style="width: 100px;" id=" " name="<?php echo ($type=="new"?"save":"update"); ?>" class="bbtn">   
          
        </span>  
         
      </div>
    </div>
  
</form>  
<!--- END OF CASE FORM ----------> 

<br/> <br/> 
<h2 style="margin:0 0 5px 5px;"><u>Jobs</u></h2>

<!------ JOBS ----------> 
<?php if($type=="edit"){  
            
  $i=0;
  while ($job=mysql_fetch_assoc($jobs_query)){  
      $i++;
      $cbo_installer = "<select    name=\"maintenance_person\" style=''><option value=''>Select Maintenance</option>"; 
       
            mysql_data_seek($resultsub, 0);  
            
            while ($data=mysql_fetch_assoc($resultsub)){  

                if($data['name']==$job['maintenance_person']){ 
                    $cbo_installer .= "<option value = \"".addslashes($data['name'])."\" selected>{$data['name']}</option>";
                }else{
                  $cbo_installer .= "<option value = \"".addslashes($data['name'])."\">{$data['name']}</option>";
                } 
            }
      $cbo_installer .= "</select>";  

?>
<br/> 

<form method="post"   class="Chronoform hasValidation" enctype="multipart/form-data" >
 <div id="tabs_content_container" style="border-top: 1px solid #ccc;">  
      <div id="client" class="tab_content" style="display: block; "> 
        <input type="hidden" name="projectid" value="<?php echo $projectid; ?>"   />
        <input type="hidden" name="clientid" value="<?php echo $case['clientid']; ?>"    />
        <input type="hidden" name="taken_by" value="<?php echo $user->name; ?>"  />
        <input type="hidden" name="caseid" value="<?php echo $caseid; ?>"  />
        <input type="hidden" name="jobid" value="<?php echo $job['id']; ?>"  />
        

        <span class="" style="display:inline-block;width: 48%; margin:10px 0;"><label>Job ID :</label> <label><?php echo $job['id']; ?></label></span> 
        <span class="" style="display:inline-block;width: 48%; margin:10px 0;">  <label style="display:inline-block;width: 48%;">Date Logged :</label> <label><?php echo date(PHP_DFORMAT); ?></label></span>
        <span class="" style="display:inline-block;width: 48%; margin:10px 0;"> <label>Maintenance Person:  <?php echo $cbo_installer ?></label> </span>   
        <span class="" style="display:inline-block;width: 48%; margin:10px 0;"> <label>Taken By :</label> <label><?php echo $user->name; ?></label> </span>    
        
        Note :
        <textarea name="note" id="" style="width: 100%; height: 100px; margin:0 0 10px 0;"><?php echo $job['note'] ?></textarea>

        <!-- <span class="" style="display:inline-block;width: 48%; margin:10px 0;"><label>Schedule Visit: <input type="text" value="<?php echo $job['schedule_visit']; ?>" name="schedule_visit" style="width: 175px; padding:3px;"></label>   </span>

        <span class="" style="display:inline-block;width: 48%; margin:10px 0;"><label>Site Visited: <input type="text" value="<?php echo $job['site_visited']; ?>" name="site_visited" style="width: 175px; padding:3px;"></label>   </span> -->

        Schedule Visit:
        <div class="input-group date form_datetime col-md-5" data-date-format="<?php echo JS_DFORMAT." @ HH:ii P"; ?>" data-link-field="<?php echo $i; ?>_schedule_visit" style="display:inline-block">
          <label class='input'> <span id='date-entered'> </span>
            <input type="text" id="schedule_visit" name="schedule_visit" class="form-control" value="<?php echo $job['fschedule_visit'] ?>" readonly style="width: 150px;">
          </label>
           <span class="input-group-addon"><span class="glyphicon glyphicon-th"></span></span> 
        </div>
        <input type="hidden" id="<?php echo $i; ?>_schedule_visit" name="schedule_visit" value="<?php echo $job['schedule_visit'] ?>" />


        <span style="margin-left: 25px;">Site Visited:</span>
        <div class="input-group date form_datetime col-md-5" data-date-format="<?php echo JS_DFORMAT." @ HH:ii P"; ?>" data-link-field="<?php echo $i; ?>_site_visited" style="display:inline-block">
          <label class='input'> <span id='date-entered'> </span>
            <input type="text" id=" " name=" " class="form-control" value="<?php echo $job['fsite_visited'] ?>" readonly style="width: 150px;">
          </label>
           <span class="input-group-addon"><span class="glyphicon glyphicon-th"></span></span> 
        </div>
        <input type="hidden" id="<?php echo $i; ?>_site_visited" name="site_visited" value="<?php echo $job['site_visited'] ?>" />
 
        <span style="display:inline-block;width: 100%; margin:10px 0;"> 
          <input type="submit" value="Update" style="width: 100px;" id=" " name="update_job" class="bbtn">    
        </span>
         
      </div>
    </div>
  </form> 
<?php } ?>  
  <!--- END OF JOBS ----------> 

  <br/> 
  <input type='button'  value='Create New Job' style='width:120px;margin:5px 0 5px 0px;'  class='bbtn btn' onclick='$("#form_new_job").show(); $(this).hide();'  />
  <input type='button'  value='Close' style='width:100px;margin:0 0 5px 5px;' name='cancel' class='bbtn btn' onclick="location.href='<?php echo JURI::base(); ?>maintenance/maintenance-folder-vic?page_name=maintenancefolder&projectid=<?php echo $projectid; ?>'"  />
    <br/> 

  <!--- CREATE NEW JOB ---------->  
  <form method="post"   class="Chronoform hasValidation" enctype="multipart/form-data"  id="form_new_job"  style="display:none;">
  <br/><h2>New Job</h2>
 <div id="tabs_content_container" style="border-top: 1px solid #ccc;">  
      <div id="client" class="tab_content" style="display: block; "> 
        <input type="hidden" name="projectid" value="<?php echo $projectid; ?>"   />
        <input type="hidden" name="clientid" value="<?php echo $case['clientid']; ?>"/>
        <input type="hidden" name="taken_by" value="<?php echo $user->name; ?>"  />
        <input type="hidden" name="caseid" value="<?php echo $caseid; ?>"  />
        

        <span class="" style="display:inline-block;width: 48%; margin:10px 0;"><label>Job ID :</label> <label> </label></span> 
        <span class="" style="display:inline-block;width: 48%; margin:10px 0;">  <label style="display:inline-block;width: 48%;">Date Logged :</label> <label><?php echo date(PHP_DFORMAT); ?></label></span>
        <span class="" style="display:inline-block;width: 48%; margin:10px 0;"> <label>Maintenance Person:  <?php echo $cbo_installer ?></label> </span>   
        <span class="" style="display:inline-block;width: 48%; margin:10px 0;"> <label>Taken By :</label> <label><?php echo $user->name; ?></label> </span>  

        Issue :   
        <textarea name="note" id="" style="width: 100%; height: 100px;  margin:0 0 10px 0;"> </textarea>

        <!-- <span class="" style="display:inline-block;width: 48%; margin:10px 0;"><label>Schedule Visit: <input type="text" value="<?php echo $case['schedule_visit']; ?>" name="schedule_visit" style="width: 175px; padding:3px;"></label>   </span> -->

        <!-- <span class="" style="display:inline-block;width: 48%; margin:10px 0;"><label>Site Visited: <input type="text" value="<?php echo $case['site_visited']; ?>" name="site_visited" style="width: 175px; padding:3px;"></label>   </span> -->
        Schedule Visit:
        <div class="input-group date form_datetime col-md-5" data-date-format="<?php echo JS_DFORMAT." @ HH:ii P"; ?>" data-link-field="new_schedule_visit" style="display:inline-block">
          <label class='input'> <span id='date-entered'> </span>
            <input type="text" id="schedule_visit" name="schedule_visit" class="form-control" value="" readonly style="width: 150px;">
          </label>
           <span class="input-group-addon"><span class="glyphicon glyphicon-th"></span></span> 
        </div>
        <input type="hidden" id="new_schedule_visit" name="schedule_visit" value=" " />
 
        <span style="margin-left: 25px;">Site Visited:</span>
        <div class="input-group date form_datetime col-md-5" data-date-format="<?php echo JS_DFORMAT." @ HH:ii P"; ?>" data-link-field="new_site_visited" style="display:inline-block">
          <label class='input'> <span id='date-entered'> </span>
            <input type="text" id=" " name=" " class="form-control" value="" readonly style="width: 150px;">
          </label>
           <span class="input-group-addon"><span class="glyphicon glyphicon-th"></span></span> 
        </div>
        <input type="hidden" id="new_site_visited" name="site_visited" value=" " />


      
        <span style="display:inline-block;width: 100%; margin:10px 0;"> 
          <input type="submit" value="Save" style="width: 100px;" id=" " name="new_job" class="bbtn">  
          <input type="button"  value="Cancel" style="width:100px;" name="cancel" class="bbtn btn" onclick='window.history.go(-1); return false;' />
          
        </span>
         
      </div>
    </div>
  </form> 
  <!--- END OF CREATE NEW JOB ---------->  


<?php } ?>

</div> 



<script type="text/javascript">
    $('.form_datetime').datetimepicker({
        //language:  'en',
        weekStart: 1,
        todayBtn:  1,
    autoclose: 1,
    todayHighlight: 1,
    startView: 2,
    forceParse: 0,
        showMeridian: 1
    });

</script>    

 





