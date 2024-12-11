<?php 
// Paint and Powder
$resultpp = mysql_query("SELECT cf_id, rrp, cost, category FROM ver_chronoforms_data_inventory_vic WHERE section = 'Frame' and  cf_id  = '13' or cf_id = '14' or section ='Guttering' and cf_id = '41' or cf_id = '42'" );
echo "<select class=\"paint-list\" name=\"paintselect\" >";
while ($paint = mysql_fetch_array($resultpp)) {
	    $heading = isset($paint[0]) ? $paint[0] : null;	
		$BeamDESCArrayPhp .= isset($paint[3]) ? 'BeamDESCArray["'.$heading.'"]="'.$paint[3].'";' : null;
		$BeamRRPArrayPhp .= isset($paint[1]) ? 'BeamRRPArray["'.$heading.'"]="'.$paint[1].'";' : null;
		$BeamCOSTArrayPhp .=  isset($paint[2]) ?'BeamCOSTArray["'.$heading.'"]="'.$paint[2].'";' : null;
      	echo "<option value=\"".$paint['cf_id']."\"";
		if ($paint['cf_id'] == '41'){echo "selected=\"selected\"";}
		echo ">".$paint['category']."</option>";	
		}
echo "</select>";
$datapaint = mysql_query("SELECT cf_id, rrp, cost, category FROM ver_chronoforms_data_inventory_vic WHERE section = 'Guttering' and category  = 'CBond'" );
$retpaint = mysql_fetch_array($datapaint);
echo "<input type=\"hidden\" class=\"paintdesc\" name=\"paint[]\" value=\"".$retpaint['category']."\" readonly=\"readonly\" />".
     "<input type=\"hidden\" class=\"paintrrp\" name=\"paintrrp[]\" value=\"".$retpaint['rrp']."\" readonly=\"readonly\" />".
     "<input type=\"hidden\" class=\"paintcost\" name=\"paintcost[]\" value=\"".$retpaint['cost']."\" readonly=\"readonly\" />";

?>