<?php
echo "<select class=\"desclist\" name=\"desclist[]\" >";
     $resultgutter = mysql_query("SELECT cf_id, inventoryid, description, uom, rrp, cost FROM ver_chronoforms_data_inventory_vic WHERE section = 'Guttering' and category  = 'Gutters Standard'" );
		while ($gutter = mysql_fetch_array($resultgutter)) {
		$heading = isset($gutter[0]) ? $gutter[0] : null;
        $BeamIDArrayPhp .= isset($gutter[1]) ? 'BeamIDArray["'.$heading.'"]="'.$gutter[1].'";' : null;	
        $BeamDESCArrayPhp .= isset($gutter[2]) ? 'BeamDESCArray["'.$heading.'"]="'.$gutter[2].'";' : null;
        $BeamRRPArrayPhp .= isset($gutter[4]) ? 'BeamRRPArray["'.$heading.'"]="'.$gutter[4].'";' : null;
        $BeamCOSTArrayPhp .= isset($gutter[5]) ? 'BeamCOSTArray["'.$heading.'"]="'.$gutter[5].'";' : null;
      	echo "<option value=\"".$gutter['cf_id']."\"";
		if($gutter['cf_id'] == '27') { echo "selected=\"selected\""; } echo ">".$gutter['description']."</option>";	
		}	

echo "</select>";
    
	 $guttering = mysql_query("SELECT cf_id, inventoryid, description, uom, rrp, cost FROM ver_chronoforms_data_inventory_vic WHERE section = 'Guttering' and category  = 'Gutters Standard' and cf_id = '27'" );
	 $retgut = mysql_fetch_array($guttering);
	 
echo "<input type=\"hidden\" class=\"desc\" name=\"desc[]\" value=\"".$retgut['description']."\" readonly=\"readonly\" />".
     "<input type=\"hidden\" class=\"invent\" name=\"invent[]\" value=\"".$retgut['inventoryid']."\" readonly=\"readonly\" />".
     "<input type=\"hidden\" class=\"descrrp\" name=\"descrrp\" value=\"".$retgut['rrp']."\" readonly=\"readonly\" />".
     "<input type=\"hidden\" class=\"desccost\" name=\"desccost\" value=\"".$retgut['cost']."\" readonly=\"readonly\" />";
?>