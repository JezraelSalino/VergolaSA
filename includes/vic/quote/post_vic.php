<?php
echo "<select class=\"desclist\" name=\"desclist[]\" >";
$resultpost = mysql_query("SELECT cf_id, inventoryid, description, uom, rrp, cost FROM ver_chronoforms_data_inventory_vic WHERE section = 'Frame' and category  = 'Posts'" );
		while ($post = mysql_fetch_array($resultpost)) {
		$heading = isset($post[0]) ? $post[0] : null;
		$BeamIDArrayPhp .= isset($post[1]) ? 'BeamIDArray["'.$heading.'"]="'.$post[1].'";' : null;	
		$BeamDESCArrayPhp .= isset($post[2]) ? 'BeamDESCArray["'.$heading.'"]="'.$post[2].'";' : null;
		$BeamRRPArrayPhp .= isset($post[4]) ? 'BeamRRPArray["'.$heading.'"]="'.$post[4].'";' : null;
		$BeamCOSTArrayPhp .= isset($post[5]) ? 'BeamCOSTArray["'.$heading.'"]="'.$post[5].'";' : null;
      	echo "<option value=\"".$post['cf_id']."\"";
		if($post['cf_id'] == '15') { echo "selected=\"selected\""; } echo ">".$post['description']."</option>";	
		}	
echo "</select>";
    
	 $posting = mysql_query("SELECT cf_id, inventoryid, description, uom, rrp, cost FROM ver_chronoforms_data_inventory_vic WHERE section = 'Frame' and category  = 'Posts' and cf_id = '15'" );
	 $retpost = mysql_fetch_array($posting);
	 
echo "<input type=\"hidden\" class=\"desc\" name=\"desc[]\" value=\"".$retpost['description']."\" readonly=\"readonly\" />".
     "<input type=\"hidden\" class=\"invent\" name=\"invent[]\" value=\"".$retpost['inventoryid']."\" readonly=\"readonly\" />".
     "<input type=\"hidden\" class=\"descrrp\" name=\"descrrp\" value=\"".$retpost['rrp']."\" readonly=\"readonly\" />".
     "<input type=\"hidden\" class=\"desccost\" name=\"desccost\" value=\"".$retpost['cost']."\" readonly=\"readonly\" />";

?>