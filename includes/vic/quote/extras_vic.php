<?php
echo "<select class=\"desclist\" name=\"desclist[]\" >"; 
$resultextras = mysql_query("SELECT cf_id, inventoryid, description, uom, rrp, cost FROM ver_chronoforms_data_inventory_vic WHERE section = 'Extras'" );
		while ($extras = mysql_fetch_array($resultextras)) {
		$heading = isset($extras[0]) ? $extras[0] : null;
        $BeamIDArrayPhp .= isset($extras[1]) ? 'BeamIDArray["'.$heading.'"]="'.$extras[1].'";' : null;	
        $BeamDESCArrayPhp .= isset($extras[2]) ? 'BeamDESCArray["'.$heading.'"]="'.$extras[2].'";' : null;
        $BeamRRPArrayPhp .= isset($extras[4]) ? 'BeamRRPArray["'.$heading.'"]="'.$extras[4].'";' : null;
        $BeamCOSTArrayPhp .= isset($extras[5]) ? 'BeamCOSTArray["'.$heading.'"]="'.$extras[5].'";' : null;
        $BeamUOMArrayPhp .= isset($extras[3]) ? 'BeamUOMArray["'.$heading.'"]="'.$extras[3].'";' : null;
      	echo "<option value=\"".$extras['cf_id']."\"";
		if($extras['cf_id'] == '68') { echo "selected=\"selected\""; } echo ">".$extras['description']."</option>";	
		}	

echo "</select>";
    
	 $xtras = mysql_query("SELECT cf_id, inventoryid, description, uom, rrp, cost FROM ver_chronoforms_data_inventory_vic WHERE section = 'Extras' and cf_id = '68'" );
	 $retxtras = mysql_fetch_array($xtras);
	 
echo "<input type=\"hidden\" class=\"desc\" name=\"desc[]\" value=\"".$retxtras['description']."\" readonly=\"readonly\" />".
     "<input type=\"hidden\" class=\"invent\" name=\"invent[]\" value=\"".$retxtras['inventoryid']."\" readonly=\"readonly\" />".
     "<input type=\"hidden\" class=\"descrrp\" name=\"descrrp\" value=\"".$retxtras['rrp']."\" readonly=\"readonly\" />".
     "<input type=\"hidden\" class=\"desccost\" name=\"desccost\" value=\"".$retxtras['cost']."\" readonly=\"readonly\" />";
?>