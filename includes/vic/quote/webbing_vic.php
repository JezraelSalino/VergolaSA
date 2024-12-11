<?php 
//error_log("inside webbing..", 3,'C:\\xampp\htdocs\\vergola_contract_system_v3\\my-error.log'); 
// Webbing
$querywebbing="SELECT cf_id, rrp, cost FROM ver_chronoforms_data_inventory_vic WHERE   cf_id = '5'";
      $resultweb = mysql_query($querywebbing);
      if(!$resultweb){die ("Could not query the database: <br />" . mysql_error());}
      //create selection list				
	   while($row = mysql_fetch_row($resultweb))
	{
		$heading = isset($row[0]) ? $row[0] : null;	
		$BeamRRPArrayPhp .= isset($row[1]) ? 'BeamRRPArray["'.$heading.'"]="'.$row[1].'";' : null;
		$BeamCOSTArrayPhp .= isset($row[2]) ? 'BeamCOSTArray["'.$heading.'"]="'.$row[2].'";' : null;
	}
echo "<td><select class=\"webbing-list\" name=\"webname\" >".
          "<option value=\"No\">No</option>".
          "<option value=\"5\">Yes</option>".
     "</select>";
 
echo "<input type=\"hidden\" class=\"webbing\" name=\"webbing[]\" value=\"No\" readonly=\"readonly\" />".
     "<input type=\"hidden\" class=\"webrrp\" name=\"webrrp[]\" value=\"0\" readonly=\"readonly\" />".
     "<input type=\"hidden\" class=\"webcost\" name=\"webcost[]\" value=\"0\" readonly=\"readonly\" /></td>";
?>