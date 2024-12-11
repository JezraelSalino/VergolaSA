<script src="<?php echo JURI::base().'jscript/jsapi.js'; ?>"></script>
<script src="<?php echo JURI::base().'jscript/jquery.min.js'; ?>"></script>
<script src="<?php echo JURI::base().'jscript/labels.js'; ?>"></script>
<script type="text/javascript" src="<?php echo JURI::base().'jscript/tabcontent.js'; ?>"></script>
<script charset="UTF-8" type="text/javascript" src="<?php echo JURI::base().'jscript/datetime/js/jquery-1.8.3.min.js'; ?>"></script>
<script type="text/javascript" src="<?php echo JURI::base().'jscript/datetime/js/bootstrap.min.js'; ?>"></script>
<script charset="UTF-8" type="text/javascript" src="<?php echo JURI::base().'jscript/datetime/js/bootstrap-datetimepicker.js'; ?>"></script>
<link rel="stylesheet" type="text/css" media="screen,projection" href="<?php echo JURI::base().'jscript/custom.css'; ?>" />
<link rel="stylesheet" type="text/css" media="screen,projection" href="<?php echo JURI::base().'jscript/new-enquiry.css'; ?>" />
<link rel="stylesheet" type="text/css" media="screen,projection" href="<?php echo JURI::base().'jscript/datetime/css/bootstrap.min.css'; ?>" />
<link rel="stylesheet" type="text/css" media="screen,projection" href="<?php echo JURI::base().'jscript/datetime/css/bootstrap-datetimepicker.min.css'; ?>" />
<?php
date_default_timezone_set('Australia/Victoria');
?>
<?php  
$next_increment = 0;
$qShowStatus = "SHOW TABLE STATUS LIKE 'ver_chronoforms_data_clientpersonal_vic'";
$qShowStatusResult = mysql_query($qShowStatus) or die ( "Query failed: " . mysql_error() . "<br/>" . $qShowStatus );
$row = mysql_fetch_assoc($qShowStatusResult);
$next_increment = $row['Auto_increment'];
$getclientid = 'CRV'.$next_increment;

if(isset($_POST['save']) || isset($_POST['sendmail']))
{	
    $ClientID = 'CRV'.$row['Auto_increment'];
    $ClientSuburbID = $_POST['csuburbid'] ;
	$ClientTitle = $_POST['ctitle'];
	$ClientFirstName = $_POST['firstname'];
	$ClientLastName = $_POST['lastname'];
	$ClientAddress1 = $_POST['caddress1'];
	$ClientAddress2 = $_POST['caddress2'];
	$ClientSuburb = $_POST['client_suburb'];
	$ClientState = $_POST['client_state'];
	$ClientPostCode = $_POST['client_postcode'];
	$ClientWPhone = $_POST['cwkphone'];
	$ClientHPhone = $_POST['chmphone'];
	$ClientMobile = $_POST['cmobile'];
	$ClientOther = $_POST['cother'];
	$ClientEmail = $_POST['cemail'];
	
	
	$SiteTitle = $_POST['stitle'];
    $SiteFirstName = $_POST['sfirstname'];
    $SiteLastName = $_POST['slastname'];
	$SiteAddress1 = $_POST['saddress1'];
	$SiteAddress2 = $_POST['saddress2'];
	$SiteSuburbID = $_POST['ssuburbid'];
	$SiteSuburb = $_POST['site_suburb'];
	$SiteState = $_POST['site_state'];
	$SitePostcode = $_POST['site_postcode'];
	$SiteWKPhone = $_POST['swkphone'];
    $SiteHMPhone = $_POST['shmphone'];
	$SiteMobile = $_POST['smobile'];
	$SiteOther = $_POST['sother'];
	$SiteEmail = $_POST['semail'];
    
	$date =  $_POST['idate'];
    $timestamp = date('Y-m-d H:i:s', strtotime($date)); 
    $DateLodged = $timestamp;
	$AppointmentLodged = $_POST['dtp_appointment'];
    $RepID = $_POST['repid'];
	$RepIdent = $_POST['repident'];
	$RepName = $_POST['repname'];
	$RepEmail = $_POST['repemail'];
	
	$LeadID = $_POST['leadid'];
	$LeadName = $_POST['leadname'];
	
	$EmployeeID = $_POST['username'];
  $lastRepId = $_POST['lastRepId'];  

 			
$sql = "INSERT INTO ver_chronoforms_data_clientpersonal_vic


                             (clientid,
							  client_suburbid, 
							  client_title, 
							  client_firstname, 
							  client_lastname, 
							  client_address1, 
							  client_address2, 
							  client_suburb, 
							  client_state, 
							  client_postcode, 
							  client_wkphone, 
							  client_hmphone, 
							  client_mobile, 
							  client_other, 
							  client_email, 
							  
							  site_suburbid,
							  site_title,
                              site_firstname,
                              site_lastname,
							  site_address1,
							  site_address2,
							  site_suburb,
							  site_state,
							  site_postcode,
							  site_wkphone,
                              site_hmphone,
							  site_mobile,
							  site_other,
							  site_email,
                              
                              datelodged,
                              repid,
							  repident,
							  repname,
							  leadid,
							  leadname,
							  -- appointmentdate,
							  employeeid,
                lastRepId) 
		 VALUES ('$ClientID',
		         '$ClientSuburbID', 
		         '$ClientTitle', 
				 '$ClientFirstName', 
				 '$ClientLastName', 
				 '$ClientAddress1', 
				 '$ClientAddress2', 
				 '$ClientSuburb', 
				 '$ClientState', 
				 '$ClientPostCode', 
				 '$ClientWPhone', 
				 '$ClientHPhone', 
				 '$ClientMobile', 
				 '$ClientOther', 
				 '$ClientEmail',
				 
				 '$SiteSuburbID',
				 '$SiteTitle',
                 '$SiteFirstName',
                 '$SiteLastName',
				 '$SiteAddress1',
				 '$SiteAddress2',
				 '$SiteSuburb',
				 '$SiteState',
				 '$SitePostcode',
				 '$SiteWKPhone',
                 '$SiteHMPhone',
				 '$SiteMobile',
				 '$SiteOther',
				 '$SiteEmail',
                 
                 '$DateLodged',
                 '$RepID',
				 '$RepIdent',
				 '$RepName',
				 '$LeadID',
				 '$LeadName',
				 -- '$AppointmentLodged',
				 '$EmployeeID',
         '$lastRepId')";
//error_log($sql, 3,'C:\\xampp\htdocs\\vergola_contract_system_v4_sa\\my-error.log'); exit();
mysql_query($sql);

$NotesTxt =  $_POST['notestxt'];
$DateNotes = $_POST['date_notes'];
$UsernameNotes = $_POST['username_notes'];	

mysql_query("INSERT INTO ver_chronoforms_data_notes_vic (clientid, datenotes, username, content)  
              VALUES ('$getclientid','$DateNotes', '$UsernameNotes','$NotesTxt')");
                 
//This is the Time Save 
$now = time();  

if(isset($_FILES['photo'])){ 

    foreach ($_FILES['photo']['tmp_name'] as $key => $tmp_name){
//This is the directory where images will be saved 
        $target="images/drawings/$now-";
        $target=$target.$_FILES['photo']['name'][$key];	
		if (move_uploaded_file($tmp_name, $target)) {

$query = "INSERT INTO ver_chronoforms_data_drawings_vic (clientid, photo) VALUES  ('$getclientid', '$target')";
 mysql_query($query) or trigger_error("Insert failed: " . mysql_error());

         		
            }
    }
}
 
 
    $to = $_POST['repemail']; // this is the Sales Rep Email address
    $from = $_POST['usermail']; // this is the sender's Email address	
    $first_name = $_POST['firstname'];
    $last_name = $_POST['lastname'];
    $subject = "New Enquiry";
    $subject2 = "Copy of your New Enquiry";
    
	// Email to the Sales Rep
	$message = "<table cellpadding=\"0\" cellspacing=\"0\" style=\"border-top: 1px solid #999;width:550px; font-family:calibri; font-size:13px;\">
  <tr>
    <td style=\"width:120px;border-bottom: 1px solid #999;border-left: 1px solid #999;padding:5px;\"><img src='".JURI::base().'images/vergola-email-logo.png'."'></td>
    <td style=\"border-bottom: 1px solid #999;border-right: 1px solid #999;border-left: 1px solid #999;padding:5px;\">Enquiry Date: " .$_POST['idate']. "</td>
  </tr>
  <tr>
    <td style=\"border-bottom: 1px solid #999;border-left: 1px solid #999;padding:5px;\">From</td>
    <td style=\"border-bottom: 1px solid #999;border-right: 1px solid #999;border-left: 1px solid #999;padding:5px;\">" . $_POST['username'] . "</td>
  </tr>
  <tr>
    <td style=\"border-bottom: 1px solid #999;border-left: 1px solid #999;padding:5px;\">Sales Rep</td>
    <td style=\"border-bottom: 1px solid #999;border-right: 1px solid #999;border-left: 1px solid #999;padding:5px;\">" . $_POST['repname'] . "</td>
  </tr>
  <tr>
    <td style=\"border-bottom: 1px solid #999;border-left: 1px solid #999;padding:5px;\">Client</td>
    <td style=\"border-bottom: 1px solid #999;border-right: 1px solid #999;border-left: 1px solid #999;padding:5px;\">" . $_POST['firstname'] . " " . $_POST['lastname']. "</td>
  </tr>
  <tr>
    <td style=\"border-bottom: 1px solid #999;border-left: 1px solid #999;padding:5px;\">Address</td>
    <td style=\"border-bottom: 1px solid #999;border-right: 1px solid #999;border-left: 1px solid #999;padding:5px;\">" . $_POST['saddress1'] . " " . $_POST['saddress2'] . ", " . $_POST['site_suburb'] . " " . $_POST['site_state'] . " " . $_POST['site_postcode'] . "</td>
  </tr>
  <tr>
    <td style=\"border-bottom: 1px solid #999;border-left: 1px solid #999;padding:5px;\">Phone</td>
    <td style=\"border-bottom: 1px solid #999;border-right: 1px solid #999;border-left: 1px solid #999;padding:5px;\">" . $_POST['chmphone'] ."</td>
  </tr>
  <tr>
    <td style=\"border-bottom: 1px solid #999;border-left: 1px solid #999;padding:5px;\">Mobile</td>
    <td style=\"border-bottom: 1px solid #999;border-right: 1px solid #999;border-left: 1px solid #999;padding:5px;\">" . $_POST['cmobile'] . "</td>
  </tr>
  <tr>
    <td style=\"border-bottom: 1px solid #999;border-left: 1px solid #999;padding:5px;\">Email</td>
    <td style=\"border-bottom: 1px solid #999;border-right: 1px solid #999;border-left: 1px solid #999;padding:5px;\">" . $_POST['cemail'] . "</td>
  </tr>
  <tr>
    <td style=\"border-bottom: 1px solid #999;border-left: 1px solid #999;padding:5px;\">Drawing</td>
    <td style=\"border-bottom: 1px solid #999;border-right: 1px solid #999;border-left: 1px solid #999;padding:5px;\">" . $_POST['checkfile'] . "</td>
  </tr>
  <tr>
    <td style=\"border-bottom: 1px solid #999;border-left: 1px solid #999;padding:5px;\">Note</td>
    <td style=\"border-bottom: 1px solid #999;border-right: 1px solid #999;border-left: 1px solid #999;padding:5px;\">" . $_POST['notestxt'] . "</td>
  </tr>
</table>";
    
	
	//Email copy of the Sender
	$message2 = "<table cellpadding=\"0\" cellspacing=\"0\" style=\"border-top: 1px solid #999;min-width:600px;font-family:calibri; font-size:13px;\">
  <tr>
    <td style=\"border-bottom: 1px solid #999;border-left: 1px solid #999;padding:5px;\">Date of Enquiry</td>
    <td style=\"border-bottom: 1px solid #999;border-right: 1px solid #999;border-left: 1px solid #999;padding:5px;\">" .$_POST['idate']. "</td>
  </tr>
  <tr>
    <td style=\"border-bottom: 1px solid #999;border-left: 1px solid #999;padding:5px;\">From:</td>
    <td style=\"border-bottom: 1px solid #999;border-right: 1px solid #999;border-left: 1px solid #999;padding:5px;\">" . $_POST['username'] . "</td>
  </tr>
  <tr>
    <td style=\"border-bottom: 1px solid #999;border-left: 1px solid #999;padding:5px;\">To: </td>
    <td style=\"border-bottom: 1px solid #999;border-right: 1px solid #999;border-left: 1px solid #999;padding:5px;\">" . $_POST['repname'] . "</td>
  </tr>
  <tr>
    <td style=\"border-bottom: 1px solid #999;border-left: 1px solid #999;padding:5px;\">Client:</td>
    <td style=\"border-bottom: 1px solid #999;border-right: 1px solid #999;border-left: 1px solid #999;padding:5px;\">" . $_POST['firstname'] . " " . $_POST['lastname']. "</td>
  </tr>
  <tr>
    <td style=\"border-bottom: 1px solid #999;border-left: 1px solid #999;padding:5px;\">Address: </td>
    <td style=\"border-bottom: 1px solid #999;border-right: 1px solid #999;border-left: 1px solid #999;padding:5px;\">" . $_POST['saddress1'] . " " . $_POST['saddress2'] . ", " . $_POST['site_suburb'] . " " . $_POST['site_state'] . " " . $_POST['site_postcode'] . "</td>
  </tr>
  <tr>
    <td style=\"border-bottom: 1px solid #999;border-left: 1px solid #999;padding:5px;\">Phone: </td>
    <td style=\"border-bottom: 1px solid #999;border-right: 1px solid #999;border-left: 1px solid #999;padding:5px;\">" . $_POST['chmphone'] ."</td>
  </tr>
  <tr>
    <td style=\"border-bottom: 1px solid #999;border-left: 1px solid #999;padding:5px;\">Mobile: </td>
    <td style=\"border-bottom: 1px solid #999;border-right: 1px solid #999;border-left: 1px solid #999;padding:5px;\">" . $_POST['cmobile'] . "</td>
  </tr>
  <tr>
    <td style=\"border-bottom: 1px solid #999;border-left: 1px solid #999;padding:5px;\">Email: </td>
    <td style=\"border-bottom: 1px solid #999;border-right: 1px solid #999;border-left: 1px solid #999;padding:5px;\">" . $_POST['cemail'] . "</td>
  </tr>
 <tr>
    <td style=\"border-bottom: 1px solid #999;border-left: 1px solid #999;padding:5px;\">Drawing</td>
    <td style=\"border-bottom: 1px solid #999;border-right: 1px solid #999;border-left: 1px solid #999;padding:5px;\">" . $_POST['checkfile'] . "</td>
  </tr>
  <tr>
    <td style=\"border-bottom: 1px solid #999;border-left: 1px solid #999;padding:5px;\">Note: </td>
    <td style=\"border-bottom: 1px solid #999;border-right: 1px solid #999;border-left: 1px solid #999;padding:5px;\">" . $_POST['notestxt'] . "</td>
  </tr>
</table>";

    $headers = "From:" . $from. "\r\n";
	$headers .= "MIME-Version: 1.0\r\n";
	$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
   // $headers2 = "From:" . $to. "\r\n";
	//$headers2 .= "MIME-Version: 1.0\r\n";
	//$headers2 .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
    mail($to,$subject,$message,$headers);
   // mail($from,$subject2,$message2,$headers2); // sends a copy of the message to the sender

    //echo "Mail Sent. To " . $_POST['repname'];
    // You can also use header('Location: thank_you.php'); to redirect to another page.   
	
	header('Location:'.JURI::base().'client-listing-vic/client-folder-vic?pid='.$next_increment);			
}

//if(isset($_POST['cancel']))
//{	
//	header('Location:'.JURI::base().'client-listing-vic');			
//}



?>
<?php
$form->data['date_entered'] = date('d-M-Y');
$form->data['date_time'] = date('d-M-Y g:i A');
?>
<SCRIPT language="javascript">
        function addRow(tableID) {
 
            var table = document.getElementById(tableID);
 
            var rowCount = table.rows.length;
            var row = table.insertRow(rowCount);
 
            var colCount = table.rows[0].cells.length;
 
            for(var i=0; i<colCount; i++) {
 
                var newcell = row.insertCell(i);
 
                newcell.innerHTML = table.rows[0].cells[i].innerHTML;
                //alert(newcell.childNodes);
                switch(newcell.childNodes[0].type) {
                    case "text":
                            newcell.childNodes[0].value = "";
                            break;
                    case "checkbox":
                            newcell.childNodes[0].checked = false;
                            break;
                    case "select-one":
                            newcell.childNodes[0].selectedIndex = 0;
                            break;
                }
            }
        }
 
        function deleteRow(tableID) {
            try {
            var table = document.getElementById(tableID);
            var rowCount = table.rows.length;
 
            for(var i=0; i<rowCount; i++) {
                var row = table.rows[i];

                var chkbox = row.cells[0].childNodes[0];
                if(null != chkbox && true == chkbox.checked) {
                    if(rowCount <= 1) {
                        alert("Cannot delete all the rows.");
                        break;
                    }
                    table.deleteRow(i);
                    rowCount--;
                    i--;
                }
 
 
            }
            }catch(e) {
                alert(e);
            }
        }
</SCRIPT>
<script language="javascript">
    function addRowEntry(tableID)
	{
      var table = document.getElementById(tableID);
      var rowCount = table.rows.length;
      // create a row element
      var row = document.createElement("tr");
      // add the row to the table
      table.appendChild(row);
      var colCount = table.rows[0].cells.length;
      for(var i=0; i<colCount; i++) 
	  {
       var newcell = row.insertCell(i);
       newcell.innerHTML = table.rows[0].cells[i].innerHTML;
      }

    }
</script>

<!--- Copy Site Address Script -->
<script language="javascript">
//<![CDATA[
$(window).load(function(){
	
$('#sbtn').click(function(){
$('#ssuburb_id').val($('#csuburb_id').val());
$('#stitle').val($('#ctitle').val());
$('#stitlespan').css("visibility", "hidden");
$('#sfirstname').val($('#firstname').val());
$('#sfirstnamespan').css("visibility", "hidden");
$('#slastname').val($('#lastname').val());
$('#slastnamespan').css("visibility", "hidden");
$('#saddress1').val($('#caddress1').val());
$('#saddress1span').css("visibility", "hidden");
$('#saddress2').val($('#caddress2').val());
$('#saddress2span').css("visibility", "hidden");
$('#ssuburblist').val($('#csuburblist').val());
$('#ssuburblistspan').css("visibility", "hidden");
$('#ssuburb').val($('#csuburb').val());
$('#ssuburbstate').val($('#csuburbstate').val());
$('#sstatespan').css("visibility", "hidden");
$('#ssuburbpostcode').val($('#csuburbpostcode').val());
$('#spostspan').css("visibility", "hidden");
$('#swkphone').val($('#cwkphone').val());
$('#swkphonespan').css("visibility", "hidden");
$('#shmphone').val($('#chmphone').val());
$('#shmphonespan').css("visibility", "hidden");
$('#smobile').val($('#cmobile').val());
$('#smobilespan').css("visibility", "hidden");
$('#sother').val($('#cother').val());
$('#sotherspan').css("visibility", "hidden");
$('#semail').val($('#cemail').val());
$('#semailspan').css("visibility", "hidden");
});

$('#csuburb').change(function(){
  if($(this).val() == ''){ // or this.value == 'blank'
    $('#client input#csuburbstate').val($('#blank').val());
	$('#client input#csuburbpostcode').val($('#blank').val());
  }
});


$('#bsbtn').click(function(){
        if($("#uploadme").val()=='') {
            $("#checkfile").val('No');
        } else {
			$("#checkfile").val('Yes');
		}
		
    });

$('#ibtn').click(function(){
        if($("#uploadme").val()=='') {
            $("#checkfile").val('No');
        } else {
			$("#checkfile").val('Yes');
		}
		
    });


});//]]>
</script>
<script src="<?php echo JURI::base().'jscript/jquery-ui.min.js'; ?>" type="text/javascript"></script>

<style>
    .ui-autocomplete {
        max-height: 200px;
        overflow-y: auto;
        overflow-x: hidden;
        padding-right: 20px;
    }
</style>
<script type="text/javascript">
    $(document).ready(function() {
        var client_config = {
            source: function(request, response) {
                $.ajax({
                    url: "includes/vic/suburb_vic.php", 
                    dataType: "json", 
                    cache: false, 
                    type: "get", 
                    data: {term: request.term}
                }).done(function(data) {
                    response(data);
                });
            }, 
            select: function(event, ui) {
                $("#csuburb").val(ui.item.suburb);
                $("#csuburbstate").val(ui.item.suburb_state);
                $("#csuburbpostcode").val(ui.item.suburb_postcode);
                $("#csuburb_id").val(ui.item.cf_id);
            },
            minLength:2
        };
        $("#csuburb").autocomplete(client_config);

        var site_config = {
            source: function(request, response) {
                $.ajax({
                    url: "includes/vic/suburb_vic.php", 
                    dataType: "json", 
                    cache: false, 
                    type: "get", 
                    data: {term: request.term}
                }).done(function(data) {
                    response(data);
                });
            }, 
            select: function(event, ui) {
                $("#ssuburb").val(ui.item.suburb);
                $("#ssuburbstate").val(ui.item.suburb_state);
                $("#ssuburbpostcode").val(ui.item.suburb_postcode);
                $("#ssuburb_id").val(ui.item.cf_id);
            },
            minLength:2
        };
        $("#ssuburb").autocomplete(site_config);

        $("#csuburbstate").keypress(function() {
            $("#notification").html("Please choose a suburb in the autocomplete box.");   
            //$("#notification").appendTo("."+dataClass+" .notification-area");
            $("#notification").removeClass('hide');  
            $("#notification").show(); 
            setTimeout(
                function() {
                    $( "#notification" ).hide( "slow" );
                }, 
                7000
            );
            $("#csuburb").css({"border-color": "red"});
            $("#csuburb").on("change", function() {
                $(this).css({"border-color": "#97989a"});
            });
            $("#csuburb").text(""); 
            $("#csuburb").focus(); 
        });

        $("#ssuburbstate").keypress(function() {
            $("#notification").html("Please choose a suburb in the autocomplete box.");   
            //$("#notification").appendTo("."+dataClass+" .notification-area");
            $("#notification").removeClass('hide');  
            $("#notification").show(); 
            setTimeout(
                function() {
                    $( "#notification" ).hide( "slow" );
                }, 
                7000
            );
            $("#ssuburb").css({"border-color": "red"});
            $("#ssuburb").on("change", function() {
                $(this).css({"border-color": "#97989a"});
            });
            $("#ssuburb").text(""); 
            $("#ssuburb").focus(); 
        });
    });
</script>

<script type="text/javascript">
/*
  $(document).ready(function(){
    var client_config = {
    source: "includes/vic/suburb_vic.php",
    select: function(event, ui){
        $("#csuburb").val(ui.item.suburb);
        $("#csuburbstate").val(ui.item.suburb_state);
        $("#csuburbpostcode").val(ui.item.suburb_postcode);
		$("#csuburb_id").val(ui.item.cf_id);	
    },
    minLength:1
    };
        $("#csuburb").autocomplete(client_config);

     var site_config = {
    source: "includes/vic/suburb_vic.php",
    select: function(event, ui){    
    $("#ssuburb").val(ui.item.suburb);
        $("#ssuburbstate").val(ui.item.suburb_state);
        $("#ssuburbpostcode").val(ui.item.suburb_postcode);
    $("#ssuburb_id").val(ui.item.cf_id);
    },
    minLength:1
    };
    $("#ssuburb").autocomplete(site_config);
    
    $("#csuburbstate").keypress(function(){
         $("#notification").html("Please choose a suburb in the autocomplete box.");   
          //$("#notification").appendTo("."+dataClass+" .notification-area");
          $("#notification").removeClass('hide');  
          $("#notification").show(); 
          setTimeout(function() {
                $( "#notification" ).hide( "slow" );
          }, 7000);

          
          $("#csuburb").css({ "border-color": "red"});
          $("#csuburb").one("change",function(){ $(this).css({ "border-color": "#97989a"}); });
          $("#csuburb").text(""); 
          $("#csuburb").focus(); 
    });

    $("#ssuburbstate").keypress(function(){
         $("#notification").html("Please choose a suburb in the autocomplete box.");   
          //$("#notification").appendTo("."+dataClass+" .notification-area");
          $("#notification").removeClass('hide');  
          $("#notification").show(); 
          setTimeout(function() {
                $( "#notification" ).hide( "slow" );
          }, 7000);

          
          $("#ssuburb").css({ "border-color": "red"});
          $("#ssuburb").one("change",function(){ $(this).css({ "border-color": "#97989a"}); });
          $("#ssuburb").text(""); 
          $("#ssuburb").focus(); 
    });



  });
*/
</script>
 
<script>
function csuburbchange(){
    document.getElementById('cstateid').style.visibility = 'hidden';
	document.getElementById('cpostid').style.visibility = 'hidden';
}
function ssuburbchange(){
    document.getElementById('sstatespan').style.visibility = 'hidden';
	document.getElementById('spostspan').style.visibility = 'hidden';
}
</script>

<div id="notification" class="notification_box hide"  ></div>

<form method="post" action="<?php echo JURI::base().'new-client-enquiry-vic/'; ?>" class="Chronoform hasValidation" id="chronoform_New_Client_Enquiry_Vic" enctype="multipart/form-data">
  <input type="hidden" value="" id="blank" name="blank" />
  <div class="column-left"></div>
  <div class="column-right"></div>
  <div id="tabs_wrapper" class="client-builder-tab">
    <div id="tabs_container">
      <ul id="tabs_default">
        <li class="active"><span>Client</span></li>
      </ul>
    </div>
    <div id="tabs_content_container"> 
      
      <!-- Client Tab -->
      <div id="client" class="tab_content" style="display: block;">
        <label class="input"> <span>Title</span>
          <select class="title" id='ctitle' name='ctitle'>
            <option ></option>
            <option value="Mr">Mr</option>
            <option value="Mrs">Mrs</option>
            <option value="Ms">Ms</option>
            <option value="Dr">Dr</option>
            <option value="Prof.">Prof.</option>
          </select>
        </label>
        <label class="input"><span>First Name</span>
          <input type="text" value="" id="firstname" name="firstname">
        </label>
        <label class="input"><span>Last Name</span>
          <input type="text" value="" id="lastname" name="lastname">
        </label>
        <label class="input"><span hidden="true">Address 1</span>
          <input type="text" value="" id="caddress1" name="caddress1">
        </label>
        <label class="input"><span hidden="true">Address 2</span>
          <input type="text" value="" id="caddress2" name="caddress2">
        </label>
        
        <!--- Client Suburb -->
        <label class="input"><span>Suburb</span>
          <input type="text" id="csuburb" name="client_suburb" value=""  onkeypress="csuburbchange();" />
        </label>
        <input type="hidden" id="csuburb_id" name="csuburbid" value="" readonly />
        <label class="input"><span id="cstateid">State</span>
          <input type="text" id="csuburbstate" name="client_state" value="" readonly />
        </label>
        <label class="input"><span id="cpostid">Postcode</span>
          <input type="text" id="csuburbpostcode" name="client_postcode" value="" readonly />
        </label>
        <!-- End of Client Suburb -->
        <label class="input"><span>Home Phone</span>
          <input type="text" value="" id="chmphone" name="chmphone">
        </label>
        <label class="input"><span>Work Phone</span>
          <input type="text" value="" id="cwkphone" name="cwkphone">
        </label>
        <label class="input"><span>Mobile</span>
          <input type="text" value="" id="cmobile" name="cmobile">
        </label>
        <label class="input"><span>Other</span>
          <input type="text" value="" id="cother" name="cother">
        </label>
        <label class="input"><span>Email</span>
          <input type="text" value="" id="cemail" name="cemail">
        </label>
      </div>
    </div>
  </div>
  
  <!----------------------------------------------------- Site Address Tab -->
  <div id="tabs_wrapper" class="siteadd-tab">
    <div id="tabs_container">
      <ul id="tabs_default">
        <li class="active"><span>Site Address</span></li>
      </ul>
    </div>
    <div id="tabs_content_container">
      <div id="site-address" class="tab_content_default" style="display: block;">
        <label class="input"> <span id='stitlespan'>Title</span>
          <select class="title" id='stitle' name='stitle'>
            <option ></option>
            <option value="Mr">Mr</option>
            <option value="Mrs">Mrs</option>
            <option value="Ms">Ms</option>
            <option value="Dr">Dr</option>
            <option value="Prof.">Prof.</option>
          </select>
        </label>
        <label class="input"><span id="sfirstnamespan">First Name</span>
          <input type="text" value="" id="sfirstname" name="sfirstname">
        </label>
        <label class="input"><span id="slastnamespan">Last Name</span>
          <input type="text" value="" id="slastname" name="slastname">
        </label>
        <label class="input"><span hidden="true" id="saddress1span">Address 1</span>
          <input type="text" value="" id="saddress1" name="saddress1">
        </label>
        <label class="input"><span hidden="true" id="saddress2span">Address 2</span>
          <input type="text" value="" id="saddress2" name="saddress2">
        </label>
        
        <!--- Site Suburb -->
        <label class="input"><span id="ssuburblistspan">Suburb</span>
          <input type="text" id="ssuburb" name='site_suburb' value="" onkeypress="ssuburbchange();" />
        </label>
        <input type="hidden" id="ssuburb_id" name='ssuburbid' value="" readonly />
        <label class="input"><span id="sstatespan">State</span>
          <input type="text" id="ssuburbstate" name="site_state" value="" readonly />
        </label>
        <label class="input"><span id="spostspan">Postcode</span>

          <input type="text" id="ssuburbpostcode" name="site_postcode" value="" readonly />
        </label>
        <!-- End of Site Suburb -->
        <label class="input"><span id="shmphonespan">Home Phone</span>
          <input type="text" value="" id="shmphone" name="shmphone">
        </label>
        <label class="input"><span id="swkphonespan">Work Phone</span>
          <input type="text" value="" id="swkphone" name="swkphone">
        </label>
        <label class="input"><span id="smobilespan">Mobile</span>
          <input type="text" value="" id="smobile" name="smobile">
        </label>
        <label class="input"><span id="sotherspan">Other</span>
          <input type="text" value="" id="sother" name="sother">
        </label>
        <label class="input"><span id="semailspan">Email</span>
          <input type="text" value="" id="semail" name="semail">
        </label>
        <input type="button" value="Copy Site Address" id="sbtn" name="sbtn" class="btn">
      </div>
    </div>
  </div>
  
  <!------------------------------------------------------------- Enquiry Tracker Tab  -->
  <div id="tabs_wrapper" class="info-tab">
    <div id="tabs_container">
      <ul id="tabs_default">
        <li class="active"><span>Enquiry Tracker</span></li>
      </ul>
    </div>
    <div id="tabs_content_container">
      <div id="tracker" class="tab_content_default" style="display: block;">
        <label class="input"><span id="date-entered">Date Entered:</span>
          <input type="text" id="idate" name="idate" class="date_entered" autocomplete="off" value="<?php print(Date("d-M-Y")); ?>">
        </label>
        <input type="submit" value="Send Mail" id="ibtn" name="sendmail" class="btn">
        <!--- Sales Rep -->
        <?php
	  $queryrep="SELECT id, name, RepID, email FROM ver_users ORDER BY name ASC ";
      $resultrep = mysql_query($queryrep);
      if(!$resultrep){die ("Could not query the database: <br />" . mysql_error());}
	  $RepIDArrayPhp = '';
	  $RepNameArrayPhp = '';
	  $RepIdentArrayPhp = '';
	  $RepEmailArrayPhp = '';
	  $RepID = '';	  
      //create selection list				
	   while($row = mysql_fetch_row($resultrep))
	{
		$heading = $row[0];	
		$RepIDArrayPhp .= 'RepIDArray["'.$heading.'"]="'.$row[0].'";';
		$RepNameArrayPhp .= 'RepNameArray["'.$heading.'"]="'.$row[1].'";';
		$RepIdentArrayPhp .= 'RepIdentArray["'.$heading.'"]="'.$row[2].'";';
		$RepEmailArrayPhp .= 'RepEmailArray["'.$heading.'"]="'.$row[3].'";';
	}
	  	    echo "<label class='input'><span>Sales Rep</span><select class='rep-list' id='replist' name='replist' onchange='javascript:SelectChangedRep();'><option></option>";
            $usergroup = 'Victoria Users';

            $user =& JFactory::getUser(); //$userName = $user->get( 'name' ); 
            if(isset($user->groups['27'])){ //27 is victoria sales manager
              $querysub2="SELECT id, name FROM ver_users WHERE id IN (SELECT user_id FROM ver_user_usergroup_map WHERE group_id=27 || group_id=9 ) ORDER BY name ASC";
            }else if(isset($user->groups['9'])){ //27 is victoria sales manager
              $querysub2="SELECT id, name FROM ver_users WHERE id IN (SELECT user_id FROM ver_user_usergroup_map WHERE  group_id=9 ) ORDER BY name ASC";
            }else{
              $querysub2="SELECT id, name FROM ver_users WHERE usertype LIKE ('$usergroup') ORDER BY name ASC";
            }

            
            $resultsub2 = mysql_query($querysub2);
            if(!$resultsub2){die ("Could not query the database: <br />" . mysql_error());
			}
			
			  while ($data=mysql_fetch_assoc($resultsub2)){
                  echo "<option value = '{$data['id']}'";
                       if ($RepID == $data['id']) {
                            echo "selected = 'selected'";
					    }
                        echo ">{$data['name']}</option>";
		        }
 
echo "</select></label>";



?>
<script language="Javascript" type="text/javascript">
    var RepIDArray = new Array();
	<?php echo $RepIDArrayPhp; ?>
    var RepNameArray = new Array();
	<?php echo $RepNameArrayPhp; ?>
	var RepIdentArray = new Array();
	<?php echo $RepIdentArrayPhp; ?>
	var RepEmailArray = new Array();
	<?php echo $RepEmailArrayPhp; ?>


	function SelectChangedRep()
	{
		var Rep = document.getElementById('replist').value;
		document.getElementById('repname').value = RepNameArray[Rep];
		document.getElementById('repident').value = RepIdentArray[Rep];
		document.getElementById('repid').value = RepIDArray[Rep];
		document.getElementById('repemail').value = RepEmailArray[Rep];

	}
</script>
        <input type="hidden" id="repname" name='repname' value="" readonly />
        <input type="hidden" id="repident" name='repident' value="" readonly />
        <input type="hidden" id="repid" name='repid' value="" readonly />
        <input type="hidden" id="repemail" name='repemail' value="" readonly />
        
        <!-- End of Sales Rep --> 
        
        <!--- Lead Type -->
        <?php
      $querylead="SELECT cf_id, lead FROM ver_chronoforms_data_lead_vic ORDER BY lead ASC";
      $resultlead = mysql_query($querylead);
      if(!$resultlead){die ("Could not query the database: <br />" . mysql_error());}
	  $LeadIDArrayPhp = '';
	  $LeadNameArrayPhp = '';
	  $LeadID = '';
      //create selection list				
	   while($row = mysql_fetch_row($resultlead))
	{
		$heading = $row[0];	
		$LeadIDArrayPhp .= 'LeadIDArray["'.$heading.'"]="'.$row[0].'";';
		$LeadNameArrayPhp .= 'LeadNameArray["'.$heading.'"]="'.$row[1].'";';

	}
			



	  	    echo "<label class='input'><span>Lead Type</span><select class='lead-list' id='leadlist' name='leadlist' onchange='javascript:SelectChangedLead();'><option></option>";
            $querysub2="SELECT cf_id, lead FROM ver_chronoforms_data_lead_vic ORDER BY lead ASC";
            $resultsub2 = mysql_query($querysub2);
            if(!$resultsub2){die ("Could not query the database: <br />" . mysql_error());
			}
			
			  while ($data=mysql_fetch_assoc($resultsub2)){
                  echo "<option value = '{$data['cf_id']}'";
                       if ($LeadID == $data['cf_id']) {
                            echo "selected = 'selected'";
					    }
                        echo ">{$data['lead']}</option>";
		        }
 
echo "</select></label>";
?>
        <script language="Javascript" type="text/javascript">
    var LeadIDArray = new Array();
	<?php echo $LeadIDArrayPhp; ?>
    var LeadNameArray = new Array();
	<?php echo $LeadNameArrayPhp; ?>


	function SelectChangedLead()
	{
		var Lead = document.getElementById('leadlist').value;
		document.getElementById('leadname').value = LeadNameArray[Lead];
		document.getElementById('leadid').value = LeadIDArray[Lead];

	}
</script>
        <input type="hidden" id="leadname" name='leadname' value="" readonly />
        <input type="hidden" id="leadid" name='leadid' value="" readonly />
        
        <!-- End of Lead Type -->
        
        <label class='input'><span>Last Rep Allocated</span>
          <!-- <select class="last-rep">
            <option value=""></option>
          </select> -->
          <?php
            echo "<select class='last-rep' id=' ' name='lastRepId' ><option></option>";
            $querysub3="SELECT u.RepID, u.name FROM ver_chronoforms_data_clientpersonal_vic AS c JOIN ver_users AS u ON u.RepID=c.repident WHERE c.repident != '' GROUP BY c.repident ORDER BY c.pid DESC LIMIT 10";
            $resultsub3 = mysql_query($querysub3);
            if(!$resultsub3){die ("Could not query the database: <br />" . mysql_error());  }
      
            while ($data=mysql_fetch_assoc($resultsub3)){
                      echo "<option value = '{$data['RepID']}' >{$data['name']}</option>"; 
                     
                }
       
            echo "</select>";
          ?>
 
        </label>
        <?php $user =& JFactory::getUser(); $userName = $user->get( 'name' );
       echo '<label class=\'input\'><span id=\'takenid\'>Taken by:</span><input type=\'text\' id=\'username\' name=\'username\' class=\'username\' value=\''.$userName.'\' readonly></label>';?>
       <?php $usermail =& JFactory::getUser(); $userEmail = $usermail->get( 'email' );
       echo '<input type=\'hidden\' id=\'usermail\' name=\'usermail\' value=\''.$userEmail.'\' readonly>';?>
        <div class="input-group date form_datetime col-md-5" data-date-format="dd-M-yyyy @ HH:ii P" data-link-field="dtp_appointment" style="display:inline-block">
          <label class='input'><span id='date-entered'>Appointment: </span>
            <input type="text" id="iappointment" name="iappointment" class="form-control" autocomplete="off" value="" readonly>
          </label>
          <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span> <span class="input-group-addon"><span class="glyphicon glyphicon-th"></span></span> </div>
        <input type="hidden" id="dtp_appointment" name="dtp_appointment" value="" />
        <br/>
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
	$('.form_date').datetimepicker({
        language:  'en',
        weekStart: 1,
        todayBtn:  1,
		autoclose: 1,
		todayHighlight: 1,
		startView: 2,
		minView: 2,
		forceParse: 0
    });
	$('.form_time').datetimepicker({
        language:  'en',
        weekStart: 1,
        todayBtn:  1,
		autoclose: 1,
		todayHighlight: 1,
		startView: 1,
		minView: 0,
		maxView: 1,
		forceParse: 0
    });
</script> 
      </div>
    </div>
  </div>
  
  <!-- Drawing Image Tab -->
  <div id="tabs_wrapper" class="drawing-tab">
    <div id="tabs_container">
      <ul id="tabs_default">
        <li class="active"><span>Drawing</span></li>
      </ul>
    </div>
    <div id="tabs_content_container">
      <div id="draw" class="tab_content_default" style="display: block;">
        <!--<INPUT type="button" value="Add Drawing" onclick="addRow('tbl-draw')" /> -->
        <INPUT type="button" value="Delete Drawing" onclick="deleteRow('tbl-draw')" />
        <table id="tbl-draw">
          <tr>
            <td class="tbl-chk"><input type="checkbox" name="chk"/></td>
            <td class="tbl-upload"><input type="file" name="photo[]" id="uploadme" multiple="multiple">
            <input type="hidden" id="checkfile" value="No" name="checkfile"></td>
          </tr>
        </table>
      </div>
    </div>
  </div>
  
  <!-- Notes Tab -->
  
  <div id="tabs_wrapper" class="notes-tab">
    <div id="tabs_container">
      <ul id="tabs_default">
        <li class="active"><span>Notes</span></li>
      </ul>
    </div>
    <div id="tabs_content_container">
      <div id="notes" class="tab_content_default" style="display: block;">
        <table id="tbl-notes">
          <?php $user =& JFactory::getUser(); $userName = $user->get( 'name' ); 
		  //$date_notes = (Date('d-M-Y g:i A')); ?>
          <tr>
            <td class="tbl-content"><textarea name="notestxt" id="notestxt"></textarea>
              <div class="layer-date">Date:
                <input type="text" id="date_display" name="date_display" class="datetime_display" value="<?php print(Date("d-M-Y")); ?>" readonly>
                <input type="hidden" id="date_notes" name="date_notes" class="date_time" value="<?php print(Date("Y-m-d H:i:s")); ?>" readonly>
              </div>
              <div class="layer-whom">By Whom:
                <input type="text" id="username_notes" name="username_notes" class="username" value="<?php echo $userName; ?>" readonly>
              </div></td>
          </tr>
        </table>
      </div>
    </div>
  </div>
  <div id="tabs_wrapper" class="button-tab">
    <input type="submit" value="Cancel" id="bcbtn" name="cancel" class="bbtn" onclick=location.href='<?php echo JURI::base().'/client-listing-vic'; ?> />
    <input type="submit" value="Save" id="bsbtn" name="save" class="bbtn">
  </div>
</form>