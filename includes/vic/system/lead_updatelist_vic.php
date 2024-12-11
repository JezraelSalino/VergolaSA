<?php
include 'includes/vic/custom_processes_user.php';
?>

<link rel="stylesheet" type="text/css" media="screen,projection" href="<?php echo JURI::base().'jscript/jquery-ui-1.11.4/jquery-ui.min.css'; ?>" />
<link rel="stylesheet" type="text/css" media="screen,projection" href="<?php echo JURI::base().'jscript/jquery-ui-1.11.4/jquery-ui.theme.min.css'; ?>" />
<link rel="stylesheet" type="text/css" media="screen,projection" href="<?php echo JURI::base().'jscript/new-enquiry.css'; ?>" />
<link rel="stylesheet" type="text/css" media="screen,projection" href="<?php echo JURI::base().'jscript/client-folder.css'; ?>" />

<script src="<?php echo JURI::base().'jscript/jquery-ui-1.11.4/jquery.js'; ?>"></script>
<script src="<?php echo JURI::base().'jscript/jquery-ui-1.11.4/jquery-ui.min.js'; ?>"></script>
<script src="<?php echo JURI::base().'jscript/jquery-dateFormat.min.js'; ?>"></script>

<?php  
$db = JFactory::getDbo();
$id =$_REQUEST['cf_id'];
$cf_id =$_REQUEST['cf_id'];

$expenditure_year = "";
$market_year = $_REQUEST['market_year'];
$show_marketing_spend = "";
$selected = date('Y');

$cbo_year = $_POST['cbo_year'];
$year = $_POST['cbo_year'];
$selected_year = $_POST['cbo_year'];
$is_create = "hidden";

$result = mysql_query("SELECT * FROM ver_chronoforms_data_lead_vic WHERE cf_id  = '$id'");
$retrieve = mysql_fetch_array($result);
if (!$result) 
        {
        die("Error: Data not found..");
        }
    $Lead=$retrieve['lead'] ;
    $LeadID=$retrieve['cf_id'] ;
    $YearExpenditure = $_POST['cbo_year'];


if(isset($_POST['save']))
{   
    $lead_save = $_POST['lead'];



    mysql_query("UPDATE ver_chronoforms_data_lead_vic SET lead ='$lead_save' WHERE cf_id = '$id'")
                or die(mysql_error()); 
    echo "Saved!";
    
    header('Location:'.JURI::base().'system-management-vic/lead-listing-vic');          
}

if(isset($_POST['delete']))
{   

    mysql_query("DELETE from ver_chronoforms_data_lead_vic WHERE cf_id = '$id'")
                or die(mysql_error()); 
    echo "Deleted";
    
    header('Location:'.JURI::base().'system-management-vic/lead-listing-vic');          
}

if(isset($_POST['cancel']))
{   
    header('Location:'.JURI::base().'system-management-vic/lead-listing-vic');          
}


/*if(isset($_POST['command']) && $_POST['command']=='update'){
    // $id = mysql_real_escape_string($_POST['id']);
    // $desc = mysql_real_escape_string($_POST['desc']);
    // $qty = mysql_real_escape_string($_POST['qty']);
    // $price = mysql_real_escape_string($_POST['price']);
    // $supplierid = mysql_real_escape_string($_POST['supplierid']);

    $id = mysql_real_escape_string($_POST['id']);
    $desc = mysql_real_escape_string($_POST['desc']) ?: 'N/A';
    $qty = mysql_real_escape_string($_POST['qty']) ?: 0;
    $price = mysql_real_escape_string($_POST['price']) ?: 0;
    $supplierid = mysql_real_escape_string($_POST['supplierid']);
    $order = mysql_real_escape_string($_POST['order']) ?: 0;

    $sql = "UPDATE ver_chronoforms_data_materials_vic SET raw_description='{$desc}', qty={$qty}, raw_cost={$price}, display_order={$order}, supplierid='{$supplierid}' WHERE cf_id={$id} ";
    //error_log($sql, 3,'C:\\xampp\htdocs\\vergola_contract_system_v3\\my-error.log'); 
    mysql_query($sql);

     $arr = array ('message'=>'successfully update','result'=>'1');

  
    echo json_encode($arr);
    exit();

}*/

if(isset($_POST['save_lead_expenditures']) || isset($_POST['save']))
{
    $id =mysql_real_escape_string($_POST['lead_id']);

    $qResult = mysql_query("SELECT * FROM ver_chronoforms_data_lead_vic WHERE cf_id  = '$cf_id'");
    $user = mysql_fetch_assoc($qResult);
    // print_r($user);return;

    $year = substr($_POST['dFrom'], 0,4);
    //echo $year; return;
    $queryn = "DELETE FROM ver_lead_marketing_spend WHERE lead_id='{$user['cf_id']}' AND year = {$year}";
    // mysql_query($queryn) or trigger_error("Insert failed: " . mysql_error());
    //error_log($queryn, 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_us\\my-error.log');
    $nMonth = count($_POST["marketing_date"]);
    //echo $nMonth;return;

    $dFrom = mysql_real_escape_string($_POST['dFrom']);//convertToMysqlDate($_POST['dFrom']);
    $dTo = mysql_real_escape_string($_POST['dTo']);
    // $year = substr($dFrom, 0,4);
    // $year = $cbo_year;
    // echo $year; return;
    $dateFromTo = $dFrom ." - ".$dTo;
    //echo $dateFromTo;return;
    for ($i=0; $i<$nMonth; $i++) {

        //echo "('".$user["cf_id"]."'," . mysql_real_escape_string($_POST['marketing_amount'][$i]) . ", '" . mysql_real_escape_string($_POST['marketing_date'][$i]) . "','{$dateFromTo}')";
        $insertArr[] = "('".$user["cf_id"]."','" . mysql_real_escape_string($_POST['marketing_amount'][$i]) . "','" . mysql_real_escape_string($_POST['target_contract'][$i]) . "', '" . mysql_real_escape_string($_POST['marketing_date'][$i]) . "','{$dateFromTo}', {$year})";

    }
    // echo implode(", ", $insertArr);return;

    $queryn = "INSERT INTO ver_lead_marketing_spend (lead_id, marketing_amount, target_contract, marketing_date, dateFromTo, year) VALUES " . implode(", ", $insertArr);
    //error_log($queryn, 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_us\\my-error.log'); // exit();
    mysql_query($queryn) or trigger_error("Insert failed: " . mysql_error());
    $notification = "Successfully saved..";
}


if(isset($_POST['update_sales_target']))
{
    $id =mysql_real_escape_string($_POST['lead_id']);

    $qResult = mysql_query("SELECT * FROM ver_chronoforms_data_lead_vic WHERE cf_id  = '$cf_id'");
    $user = mysql_fetch_assoc($qResult);
    //print_r($user);return;
    $year = substr($_POST['dFrom'], 0,4);
    //echo $year; return;
    $queryn = "DELETE FROM ver_lead_marketing_spend WHERE lead_id='{$user['cf_id']}' AND year = {$year}";
    //error_log($queryn, 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_us\\my-error.log'); // exit();
    mysql_query($queryn);// or trigger_error("Insert failed: " . mysql_error());

    // print_r($user);return;

    $nMonth = count($_POST["marketing_date"]);
    //echo $nMonth;return;

    $dFrom = mysql_real_escape_string($_POST['dFrom']);//convertToMysqlDate($_POST['dFrom']);
    $dTo = mysql_real_escape_string($_POST['dTo']);//convertToMysqlDate($_POST['dTo']);

    $dateFromTo = $dFrom ." - ".$dTo;
    //echo $dateFromTo;return;
    for ($i=0; $i<$nMonth; $i++) {

        //echo "('".$user["cf_id"]."'," . mysql_real_escape_string($_POST['marketing_amount'][$i]) . ", '" . mysql_real_escape_string($_POST['marketing_date'][$i]) . "','{$dateFromTo}')";
        $insertArr[] = "('".$user["cf_id"]."','" . mysql_real_escape_string($_POST['marketing_amount'][$i]) . "','" . mysql_real_escape_string($_POST['target_contract'][$i]) . "', '" . mysql_real_escape_string($_POST['marketing_date'][$i]) . "','{$dateFromTo}', {$year})";

    }
    // echo implode(", ", $insertArr);return;

    $queryn = "INSERT INTO ver_lead_marketing_spend (lead_id, marketing_amount, target_contract, marketing_date, dateFromTo, year) VALUES " . implode(", ", $insertArr);
    //error_log($queryn, 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_us\\my-error.log'); // exit();
    mysql_query($queryn) or trigger_error("Insert failed: " . mysql_error());
    $notification = "Successfully saved..";
}

//Reinitialize the id because it is being used in different way while saving post.
if(isset($_REQUEST['id'])){
    $id =$_REQUEST['id'];
}else if(isset($_POST['id'])){
    $id =$_POST['id'];
}else{
    $id = 0;
}

if(isset($_REQUEST['cbo_year'])){
    $cbo_year =$_REQUEST['cbo_year'];
    // echo "_REQUEST['cbo_year'] => ".$cbo_year;
}else if(isset($_POST['cbo_year'])){
    $cbo_year =$_POST['cbo_year'];
    // echo "POST['cbo_year'] => ".$cbo_year;
}else{
    $cbo_year = date('Y');
}

function convertToMysqlDate($iDate){

    if(HOST_SERVER=="LA"){
        //given if the input is dd/MM/yy
        return substr($iDate,6,4)."-".substr($iDate,3,2)."-".substr($iDate,0,2);
    }else{
        //given if the input is MM/dd/yy
        return substr($iDate,6,4)."-".substr($iDate,0,2)."-".substr($iDate,3,2);
    }


}

?>

<form name="leadForm" method="post">
<div style="width:500px; font-size:12px; float: left;">
    <?php
        if(strlen($notification)>0)
        {
            echo set_notification($notification);
        }

    function set_notification($msg){
        return "<div class='notification_result'>{$msg}</div>";
    }?>
    <table class="update-table">
        <tr>
            <td class="row1">Source</td>
            <td class="row2"><input type="text" name="lead" value="<?php echo $Lead ?>"/></td>
        </tr>
        
        <tr>
            <td class="row1">&nbsp;</td>
            <td class="row2"><input type="submit" name="save" value="Save" class="update-btn" /> <input type="submit" name="delete" value="Delete" class="update-btn" /> <input type="submit" name="cancel" value="Cancel" class="update-btn" /></td>
        </tr>
    </table>
</div>



<div style="width:500px; font-size:12px; float: left; position: relative; left: 50px;">
    <input type="hidden" name="lead_id" id="lead_id" value="<?php echo $LeadID ?>" />
    <input type="hidden" name="id" id="id" value="<?php echo $id ?>" />
    <input type="hidden" name="sel_year" id="sel_year" value="<?php echo $year ?>" />
    <table id="tblMarketingSpend" class="update-table">
        <tr>
            <td class="row1" width="200">Marketing Expenditures from</td>
            <td class="row2" width="200" colspan="2">
            <?php
                // $year = date('Y');
                // $cMonth = 9;
                $cMonth = date('m');
                // echo $cMonth;
                if($cMonth<7){
                    // $year = $year - 1;
                    // if(isset($_POST['cbo_year'])){
                        // $year = $_POST['cbo_year'];}
                } 
           
                $is_create = "hidden";
                $qResult = mysql_query("SELECT * FROM ver_lead_marketing_spend WHERE lead_id='$LeadID' AND year={$year}");
                //error_log("...=".$qResult, 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_us\\my-error.log');
                $r = mysql_fetch_assoc($qResult);
                // echo $LeadID; echo $year; print_r($r);
                // if(mysql_num_rows($r)<1){
                if(mysql_num_rows($qResult)<1){
                    //error_log("HERE=".$qResult, 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_us\\my-error.log');
                    $qResult = mysql_query("SELECT * FROM ver_lead_marketing_spend WHERE lead_id='Default Target' AND year={$year}");
                    $r = mysql_fetch_assoc($qResult);
                    // $is_create = false;
                }

                //error_log("r: ".print_r($r,true), 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_us\\my-error.log');
                $dFrom = substr($r['dateFromTo'], 0,10);
                $dTo = substr($r['dateFromTo'], -10,10);
                

                if (strlen($dFrom) == 0 || strlen($dTo) == 0) {
                    // $dFrom = (intval(date('Y')) - 1) . '-07-01';
                    // $dTo = date('Y') . '-06-30';
                    // if(isset($_POST['cbo_year'])){
                        $is_create = "visible";
                        $dFrom = $_POST['cbo_year'] . '-07-01';
                        $dTo = (intval($_POST['cbo_year']) + 1) . '-06-30';
                    // }
                }
                $formatFrom = "";
                $formatTo = "";
                if(isset($_POST['cbo_year'])){
                    $formatFrom = date_format(date_create($dFrom),PHP_DFORMAT);
                    $formatTo = date_format(date_create($dTo),PHP_DFORMAT);
                }



            ?>
                        <input type="hidden" value="<?php echo $dFrom; ?>" name="dFrom" id="dFrom"  />
                        <input type="hidden" value="<?php echo $dTo; ?>" name="dTo" id="dTo"/>
                        <label> <?php echo $formatFrom; ?> </label>
                        <input type="hidden" value="<?php echo $formatFrom; ?>" class="datepicker" style="display: inline;width:150px; " id="dpFrom" >
<!-- remove this part and adjust the retrieve and insert query to generate the date up to 12 months -->
                        &nbsp;<b>to:</b>&nbsp;
                        <label> <?php echo $formatTo; ?> </label>
                        <input type="hidden" value="<?php echo $formatTo; ?>" class="datepicker" style="display: inline;width:150px; "  id="dpTo" >
                        <br />
                        <!-- <select id="cbo_year" name="cbo_year" onchange="OnSelectionChange()"> -->
                        
                        <select id="cbo_year" name="cbo_year" onchange="this.form.submit();">
                            <option value="">Select Year</option>
                        <?php 
                            $year_start  = (intval(date('Y')) - 10);
                            $year_end = date('Y'); // current Year
                            $selected_year = ''; // user date of birth year
                            if(isset($_POST['cbo_year']))
                            { $selected_year = $_POST['cbo_year']; }
                            for ($i_year = $year_start; $i_year <= $year_end; $i_year++) {
                                $selected = $selected_year == $i_year ? ' selected' : '';
                                // $year = $selected;
                                // $dFrom = date($selected) . '-07-01';
                                // $dTo = (intval(date($selected)) + 1) . '-06-30';
                                echo '<option value="'.$i_year.'"'.$selected.'>'.$i_year.'</option>'."\n";
                            }
                        ?>
                        </select>
                        <!-- <input type="button" name="" value="View Expenditures" class="" onclick="show_data1($LeadID,$cbo_year);" style="width:100px;" /> -->
                        
                        <input type="button" style="width:100px; visibility: <?php echo $is_create; ?>;" name="" value="Open" class="" onclick="createMonthFields();" style="width:100px;" />
            </td>
        </tr>
        <tr>
            <td class="row1" width="200">&nbsp;</td>
            <td class="row2" width="200">&nbsp;</td>
        </tr>

        <?php
            $qResult = mysql_query("SELECT * FROM ver_lead_marketing_spend WHERE lead_id='$LeadID'  AND year={$year}");
            //error_log("SELECT * FROM ver_lead_marketing_spend WHERE lead_id='$cf_id'", 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_us\\my-error.log');
            //error_log("SELECT * FROM ver_lead_marketing_spend WHERE lead_id='$cf_id'  AND year={$year}", 3,'/home/vergola/public_html/quote-system/my-error.log');
            $i=0;
            while ($r = mysql_fetch_assoc($qResult)) {
                // print_r($r);
                $mDate = date_format(date_create($r["marketing_date"]),"F");
                $fDate = date_format(date_create($r["marketing_date"]),"Y-m-d");
                if($i==0){echo "<tr><th width='200'>Month</th><th width='200' style='text-align:left;'>Marketing Expenditures</th><th width='200' style='text-align:left;'></th></tr> ";}

                echo "<tr>";
                echo "<td >{$mDate}</td><td><input type='hidden' name='marketing_date[]' value='{$fDate}' /><input type='text' name='marketing_amount[]' value='".$r["marketing_amount"]."'></td><td><input type='hidden' name='target_contract[]' value='".$r["target_contract"]."'></td>";
                echo "</tr>";
                $i++;
            }

            if($i>0){
                echo "<tr>";
                echo "<td> &nbsp; </td><td><input type='submit' value='Update' style='width:100px; padding:3px;' name='update_sales_target' /></td>";
                echo "</tr>";
}        
 

        ?>



    </table>
</div>
</form>

<script type="text/javascript">

$(document).ready(function(){
        var dFormat = "dd-M-yy";
        <?php if(HOST_SERVER=="LA"){ ?>
            dFormat = "M-dd-yy";
        <?php }else{ ?>
            dFormat = "dd-M-yy";
        <?php } ?>

        $( ".datepicker" ).datepicker({ dateFormat: dFormat  });
        $( "#dpFrom" ).change(function() {
          $( "#dFrom" ).val($.datepicker.formatDate('yy-mm-dd', $( this ).datepicker('getDate')));
        });

        $( "#dpTo" ).change(function() {
           $( "#dTo" ).val($.datepicker.formatDate('yy-mm-dd', $( this ).datepicker('getDate')));
        });

        $("#cbo_year").change(OnSelectionChange());

        
}); 

function createMonthFields(){
    $("#tblMarketingSpend tr:not(:first)").remove();
    var dFrom = new Date($("#dFrom").val());
    var dTo = new Date($("#dTo").val());
    var tr = "<tr><td>&nbsp;</td><td>&nbsp;</td></tr><tr><th>Month</th><th style='text-align:left;'>Marketing Expenditures</th><th  style='text-align:left;'></th></tr> ";
    for (d=dFrom; dFrom <= dTo; d.setMonth(d.getMonth() + 1))
    {        
        tr += "<tr>";
        tr += "<td>"+$.format.date(d, "MMMM")+"</td><td><input type='hidden' name='marketing_date[]' value='"+$.format.date(d, "yyyy-MM-dd")+"'><input type='text' name='marketing_amount[]' ></td><td><input type='hidden' name='target_contract[]' ></td>";
        tr += "</tr>";        
    }

    tr += "<tr>";
    tr += "<td> &nbsp; </td><td><input type='submit' value='Save' style='width:100px; padding:3px;' name='save_lead_expenditures' /></td>";
    tr += "</tr>";

    $("#tblMarketingSpend").append(tr);
}

function OnSelectionChange()
{    
    var selected_option_value=$("#cbo_year option:selected").val();
    var leadid=$("#lead_id").val();
    var id=$("#id").val();
    var cf_id=$("#cf_id").val();
    var year=$("#year").val();

    var currentDate = new Date(), day = currentDate.getDate(),
        month = currentDate.getMonth() + 1, year = currentDate.getFullYear(),
        day1 = day + "." + month + "." + year;
    var dFrom = new Date("July 01, " + selected_option_value);
}
</script>