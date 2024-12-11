<?php
echo "<select class=\"desclist\" name=\"desclist[]\" >"; 
$resultmisc = mysql_query("SELECT cf_id, inventoryid, description, uom, rrp, cost FROM ver_chronoforms_data_inventory_vic WHERE section = 'Misc' AND category = 'Varied Items'" );
		while ($misc = mysql_fetch_array($resultmisc)) {
		$heading = isset($misc[0]) ? $misc[0] : null;
        $BeamIDArrayPhp .= isset($extras[1]) ? 'BeamIDArray["'.$heading.'"]="'.$misc[1].'";' : null;	
        $BeamDESCArrayPhp .= isset($extras[2]) ? 'BeamDESCArray["'.$heading.'"]="'.$misc[2].'";' : null;
        $BeamRRPArrayPhp .= isset($extras[4]) ? 'BeamRRPArray["'.$heading.'"]="'.$misc[4].'";' : null;
        $BeamCOSTArrayPhp .= isset($extras[5]) ? 'BeamCOSTArray["'.$heading.'"]="'.$misc[5].'";' : null;
        $BeamUOMArrayPhp .= isset($extras[3]) ? 'BeamUOMArray["'.$heading.'"]="'.$misc[3].'";' : null;
      	echo "<option value=\"".$misc['cf_id']."\"";
		if($misc['cf_id'] == '67') { echo "selected=\"selected\""; } echo ">".$misc['description']."</option>";	
		}	

echo "</select>";
    
	 $miscs = mysql_query("SELECT cf_id, inventoryid, description, uom, rrp, cost FROM ver_chronoforms_data_inventory_vic WHERE section = 'Misc' and cf_id = '67'" );
	 $retmiscs = mysql_fetch_array($miscs);
	 
echo "<input type=\"hidden\" class=\"desc\" name=\"desc[]\" value=\"".$retmiscs['description']."\" readonly=\"readonly\" />".
     "<input type=\"hidden\" class=\"invent\" name=\"invent[]\" value=\"".$retmiscs['inventoryid']."\" readonly=\"readonly\" />".
     "<input type=\"hidden\" class=\"descrrp\" name=\"descrrp\" value=\"".$retmiscs['rrp']."\" readonly=\"readonly\" />".
     "<input type=\"hidden\" class=\"desccost\" name=\"desccost\" value=\"".$retmiscs['cost']."\" readonly=\"readonly\" />";
?>