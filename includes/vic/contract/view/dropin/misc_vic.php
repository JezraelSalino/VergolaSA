<?php 
// ***************************** Add Misc ********************************************//
echo "<tr id=\"extra1\" style=\"display: table-row\"><td><input type=\"hidden\" name=\"id[38]\" value=\"{$getCFID[38]}\" /><select class=\"desclist\" name=\"desclist[]\" >"; 
        
        $miscs = array();
		while ($misc = mysql_fetch_array($resultmisc)) {
		$miscs[] = $misc;
		$heading = isset($extra[0]) ? $extra[0] : null;
        $BeamIDArrayPhp .= isset($extra[1]) ? 'BeamIDArray["'.$heading.'"]="'.$extra[1].'";' : null;	
        $BeamDESCArrayPhp .= isset($extra[2]) ? 'BeamDESCArray["'.$heading.'"]="'.$extra[2].'";' : null;
        $BeamRRPArrayPhp .= isset($extra[4]) ? 'BeamRRPArray["'.$heading.'"]="'.$extra[4].'";' : null;
        $BeamCOSTArrayPhp .= isset($extra[5]) ? 'BeamCOSTArray["'.$heading.'"]="'.$extra[5].'";' : null;
        $BeamUOMArrayPhp .= isset($extra[3]) ? 'BeamUOMArray["'.$heading.'"]="'.$extra[3].'";' : null;
		}
		foreach($miscs as $misc) {
      	echo "<option value=\"".$misc['cf_id']."\"";
		if($misc['cf_id'] == $getID[38]) {
		echo "selected=\"selected\""; 
		} else {echo "";}
		echo ">".$misc['description']."</option>";	
		}	
echo "</select>";
    
	  foreach($miscs as $misc){
     if ($misc['cf_id'] == $getID[38]) {
	 
echo "<input type=\"hidden\" class=\"desc\" name=\"desc[38]\" value=\"".$misc['description']."\" readonly=\"readonly\" />".
     "<input type=\"hidden\" class=\"invent\" name=\"invent[38]\" value=\"".$misc['inventoryid']."\" readonly=\"readonly\" />".
     "<input type=\"hidden\" class=\"descrrp\" name=\"descrrp\" value=\"".$misc['rrp']."\" readonly=\"readonly\" />".
     "<input type=\"hidden\" class=\"desccost\" name=\"desccost\" value=\"".$misc['cost']."\" readonly=\"readonly\" />"; }
	 else {echo" ";}
	 }
		
		echo "</td>";
// Webbing
echo"<td><input type=\"button\" value=\"Remove Misc\" onclick=\"hidextra1();\" id=\"removextra1\"><input type=\"hidden\" class=\"webbing\" name=\"webbing[38]\" value=\"\" readonly=\"readonly\" /></td>";

// Colours
echo"<td><input type=\"hidden\" class=\"colour\" name=\"colour[38]\" value=\"\" readonly=\"readonly\" /></td>";
     	
// Paint and Powder
echo"<td><input type=\"hidden\" name=\"paint[38]\" value=\"\" readonly=\"readonly\" /></td>";

// Unit of Measurement
echo "<td><input type=\"text\" name=\"uom[38]\" id=\"uom\" readonly=\"readonly\" value=\"".$misc['uom']."\"></td>";
			
// Unit Quantity
echo "<td><input type=\"text\" id=\"addqty24\" name=\"qty[38]\" value=\"{$getQty[38]}\"></td>";

// Length or Width
echo "<td><input type=\"hidden\" name=\"slength[38]\" value=\"{$getLength[38]}\" readonly=\"readonly\" /></td>";

// Total RRP
echo "<td><input type=\"text\" class=\"rrp\" readonly=\"readonly\" name=\"rrp[38]\" value=\"{$getRRP[38]}\"><input type=\"hidden\" class=\"cst\" name=\"cst[38]\" value=\"{$getCost[38]}\"></td></tr>";

// ***************************** Add Extra 1 ********************************************//
echo "<tr><td colspan=\"8\" class=\"subheading\">Extras</td></tr>";
if ($getQty[39] != '0.00') {
echo "<tr id=\"extra2\" style=\"display:table-row;\">";

echo "<td><input type=\"hidden\" name=\"id[39]\" value=\"{$getCFID[39]}\" /><select class=\"desclist\" name=\"desclist[]\" >"; 
        $extras = array();
		while ($extra = mysql_fetch_array($resultextras)) {
		$extras[] = $extra;
		$heading = isset($extra[0]) ? $extra[0] : null;
        $BeamIDArrayPhp .= isset($extra[1]) ? 'BeamIDArray["'.$heading.'"]="'.$extra[1].'";' : null;	
        $BeamDESCArrayPhp .= isset($extra[2]) ? 'BeamDESCArray["'.$heading.'"]="'.$extra[2].'";' : null;
        $BeamRRPArrayPhp .= isset($extra[4]) ? 'BeamRRPArray["'.$heading.'"]="'.$extra[4].'";' : null;
        $BeamCOSTArrayPhp .= isset($extra[5]) ? 'BeamCOSTArray["'.$heading.'"]="'.$extra[5].'";' : null;
        $BeamUOMArrayPhp .= isset($extra[3]) ? 'BeamUOMArray["'.$heading.'"]="'.$extra[3].'";' : null;
		}
		foreach($extras as $extra) {
      	echo "<option value=\"".$extra['cf_id']."\"";
		if($extra['cf_id'] == $getID[39]) {
		echo "selected=\"selected\""; 
		} else {echo "";}
		echo ">".$extra['description']."</option>";	
		}	
echo "</select>";
    
	  foreach($extras as $extra){
     if ($extra['cf_id'] == $getID[39]) {
	 
echo "<input type=\"hidden\" class=\"desc\" name=\"desc[39]\" value=\"".$extra['description']."\" readonly=\"readonly\" />".
     "<input type=\"hidden\" class=\"invent\" name=\"invent[39]\" value=\"".$extra['inventoryid']."\" readonly=\"readonly\" />".
     "<input type=\"hidden\" class=\"descrrp\" name=\"descrrp\" value=\"".$extra['rrp']."\" readonly=\"readonly\" />".
     "<input type=\"hidden\" class=\"desccost\" name=\"desccost\" value=\"".$extra['cost']."\" readonly=\"readonly\" />"; }
	 else {echo" ";}
	 }
}  else {echo "<tr id=\"extra2\" style=\"display:none;\">";

echo "<td><input type=\"hidden\" name=\"id[39]\" value=\"{$getCFID[39]}\" /><select class=\"desclist\" name=\"desclist[]\" >"; 
        $extras = array();
		while ($extra = mysql_fetch_array($resultextras)) {
		$extras[] = $extra;
		$heading = isset($extra[0]) ? $extra[0] : null;
        $BeamIDArrayPhp .= isset($extra[1]) ? 'BeamIDArray["'.$heading.'"]="'.$extra[1].'";' : null;	
        $BeamDESCArrayPhp .= isset($extra[2]) ? 'BeamDESCArray["'.$heading.'"]="'.$extra[2].'";' : null;
        $BeamRRPArrayPhp .= isset($extra[4]) ? 'BeamRRPArray["'.$heading.'"]="'.$extra[4].'";' : null;
        $BeamCOSTArrayPhp .= isset($extra[5]) ? 'BeamCOSTArray["'.$heading.'"]="'.$extra[5].'";' : null;
        $BeamUOMArrayPhp .= isset($extra[3]) ? 'BeamUOMArray["'.$heading.'"]="'.$extra[3].'";' : null;
		}
		foreach($extras as $extra) {
      	echo "<option value=\"".$extra['cf_id']."\"";
		if($extra['cf_id'] == $getID[39]) {
		echo "selected=\"selected\""; 
		} else {echo "";}
		echo ">".$extra['description']."</option>";	
		}	
echo "</select>";
    
	  foreach($extras as $extra){
     if ($extra['cf_id'] == $getID[39]) {
	 
echo "<input type=\"hidden\" class=\"desc\" name=\"desc[39]\" value=\"".$extra['description']."\" readonly=\"readonly\" />".
     "<input type=\"hidden\" class=\"invent\" name=\"invent[39]\" value=\"".$extra['inventoryid']."\" readonly=\"readonly\" />".
     "<input type=\"hidden\" class=\"descrrp\" name=\"descrrp\" value=\"".$extra['rrp']."\" readonly=\"readonly\" />".
     "<input type=\"hidden\" class=\"desccost\" name=\"desccost\" value=\"".$extra['cost']."\" readonly=\"readonly\" />"; }
	 else {echo" ";}
	 }
	 }
	 
	 echo "</td>";
// Webbing
echo"<td><input type=\"button\" value=\"Remove Extras\" onclick=\"hidextra2();\" id=\"removextra2\"><input type=\"hidden\" class=\"webbing\" name=\"webbing[39]\" value=\"\" readonly=\"readonly\" /></td>";

// Colours
echo"<td><input type=\"hidden\" class=\"colour\" name=\"colour[39]\" value=\"\" readonly=\"readonly\" /></td>";
     	
// Paint and Powder
echo"<td><input type=\"hidden\" name=\"paint[39]\" value=\"\" readonly=\"readonly\" /></td>";

// Unit of Measurement
echo "<td><input type=\"text\" name=\"uom[39]\" class=\"uom\" readonly=\"readonly\" value=\"{$getUOM[39]}\"></td>";

// Unit Quantity
echo "<td><input type=\"text\" id=\"addqty25\" name=\"qty[39]\" value=\"{$getQty[39]}\"></td>";

// Length or Width
if ($getID[39] == '76') {
echo "<td><input type=\"text\" class=\"xlength\" name=\"slength[39]\" value=\"{$getLength[39]}\"></td>"; }
else {
echo "<td><input type=\"text\" class=\"xlength\" name=\"slength[39]\" value=\"{$getLength[39]}\" style=\"display:none;\"></td>";}

// Total RRP
echo "<td><input type=\"text\" class=\"rrp\" readonly=\"readonly\" name=\"rrp[39]\" value=\"{$getRRP[39]}\"><input type=\"hidden\" class=\"cst\" name=\"cst[39]\" value=\"${getCost[39]}\"></td></tr>";

// ***************************** Add Extra 2 ********************************************//

if ($getQty[40] != '0.00') {
echo "<tr id=\"extra3\" style=\"display:table-row;\">";

echo "<td><input type=\"hidden\" name=\"id[40]\" value=\"{$getCFID[40]}\" /><select class=\"desclist\" name=\"desclist[]\" >"; 
		foreach($extras as $extra) {
      	echo "<option value=\"".$extra['cf_id']."\"";
		if($extra['cf_id'] == $getID[40]) {
		echo "selected=\"selected\""; 
		} else {echo "";}
		echo ">".$extra['description']."</option>";	
		}	
echo "</select>";
    
	  foreach($extras as $extra){
      if ($extra['cf_id'] == $getID[40]) {
	 
echo "<input type=\"hidden\" class=\"desc\" name=\"desc[40]\" value=\"".$extra['description']."\" readonly=\"readonly\" />".
     "<input type=\"hidden\" class=\"invent\" name=\"invent[40]\" value=\"".$extra['inventoryid']."\" readonly=\"readonly\" />".
     "<input type=\"hidden\" class=\"descrrp\" name=\"descrrp\" value=\"".$extra['rrp']."\" readonly=\"readonly\" />".
     "<input type=\"hidden\" class=\"desccost\" name=\"desccost\" value=\"".$extra['cost']."\" readonly=\"readonly\" />"; }
	 else {echo" ";}
	 }
}  else {echo "<tr id=\"extra3\" style=\"display:none;\">";

echo "<td><input type=\"hidden\" name=\"id[40]\" value=\"{$getCFID[40]}\" /><select class=\"desclist\" name=\"desclist[]\" >"; 
		foreach($extras as $extra) {
      	echo "<option value=\"".$extra['cf_id']."\"";
		if($extra['cf_id'] == $getID[40]) {
		echo "selected=\"selected\""; 
		} else {echo "";}
		echo ">".$extra['description']."</option>";	
		}	
echo "</select>";
    
	  foreach($extras as $extra){
     if ($extra['cf_id'] == $getID[40]) {
	 
echo "<input type=\"hidden\" class=\"desc\" name=\"desc[40]\" value=\"".$extra['description']."\" readonly=\"readonly\" />".
     "<input type=\"hidden\" class=\"invent\" name=\"invent[40]\" value=\"".$extra['inventoryid']."\" readonly=\"readonly\" />".
     "<input type=\"hidden\" class=\"descrrp\" name=\"descrrp\" value=\"".$extra['rrp']."\" readonly=\"readonly\" />".
     "<input type=\"hidden\" class=\"desccost\" name=\"desccost\" value=\"".$extra['cost']."\" readonly=\"readonly\" />"; }
	 else {echo" ";}
	 }
	 }
	 
	 echo "</td>";
// Webbing
echo"<td><input type=\"button\" value=\"Remove Extras\" onclick=\"hidextra3();\" id=\"removextra3\"><input type=\"hidden\" class=\"webbing\" name=\"webbing[40]\" value=\"\" readonly=\"readonly\" /></td>";

// Colours
echo"<td><input type=\"hidden\" class=\"colour\" name=\"colour[40]\" value=\"\" readonly=\"readonly\" /></td>";
     	
// Paint and Powder
echo"<td><input type=\"hidden\" name=\"paint[40]\" value=\"\" readonly=\"readonly\" /></td>";

// Unit of Measurement
echo "<td><input type=\"text\" name=\"uom[40]\" class=\"uom\" readonly=\"readonly\" value=\"{$getUOM[40]}\"></td>";

// Unit Quantity
echo "<td><input type=\"text\" id=\"addqty26\" name=\"qty[40]\" value=\"{$getQty[40]}\"></td>";

// Length or Width
if ($getID[40] == '76') {
echo "<td><input type=\"text\" class=\"xlength\" name=\"slength[40]\" value=\"{$getLength[40]}\"></td>"; }
else {
echo "<td><input type=\"text\" class=\"xlength\" name=\"slength[40]\" value=\"{$getLength[40]}\" style=\"display:none;\"></td>";}

// Total RRP
echo "<td><input type=\"text\" class=\"rrp\" readonly=\"readonly\" name=\"rrp[40]\" value=\"{$getRRP[40]}\"><input type=\"hidden\" class=\"cst\" name=\"cst[40]\" value=\"${getCost[40]}\"></td></tr>";

// ***************************** Add Extra 3 ********************************************//

if ($getQty[41] != '0.00') {
echo "<tr id=\"extra4\" style=\"display:table-row;\">";

echo "<td><input type=\"hidden\" name=\"id[41]\" value=\"{$getCFID[41]}\" /><select class=\"desclist\" name=\"desclist[]\" >"; 
		foreach($extras as $extra) {
      	echo "<option value=\"".$extra['cf_id']."\"";
		if($extra['cf_id'] == $getID[41]) {
		echo "selected=\"selected\""; 
		} else {echo "";}
		echo ">".$extra['description']."</option>";	
		}	
echo "</select>";
    
	  foreach($extras as $extra){
      if ($extra['cf_id'] == $getID[41]) {
	 
echo "<input type=\"hidden\" class=\"desc\" name=\"desc[41]\" value=\"".$extra['description']."\" readonly=\"readonly\" />".
     "<input type=\"hidden\" class=\"invent\" name=\"invent[41]\" value=\"".$extra['inventoryid']."\" readonly=\"readonly\" />".
     "<input type=\"hidden\" class=\"descrrp\" name=\"descrrp\" value=\"".$extra['rrp']."\" readonly=\"readonly\" />".
     "<input type=\"hidden\" class=\"desccost\" name=\"desccost\" value=\"".$extra['cost']."\" readonly=\"readonly\" />"; }
	 else {echo" ";}
	 }
}  else {echo "<tr id=\"extra4\" style=\"display:none;\">";

echo "<td><input type=\"hidden\" name=\"id[41]\" value=\"{$getCFID[41]}\" /><select class=\"desclist\" name=\"desclist[]\" >"; 
		foreach($extras as $extra) {
      	echo "<option value=\"".$extra['cf_id']."\"";
		if($extra['cf_id'] == $getID[41]) {
		echo "selected=\"selected\""; 
		} else {echo "";}
		echo ">".$extra['description']."</option>";	
		}	
echo "</select>";
    
	  foreach($extras as $extra){
     if ($extra['cf_id'] == $getID[41]) {
	 
echo "<input type=\"hidden\" class=\"desc\" name=\"desc[41]\" value=\"".$extra['description']."\" readonly=\"readonly\" />".
     "<input type=\"hidden\" class=\"invent\" name=\"invent[41]\" value=\"".$extra['inventoryid']."\" readonly=\"readonly\" />".
     "<input type=\"hidden\" class=\"descrrp\" name=\"descrrp\" value=\"".$extra['rrp']."\" readonly=\"readonly\" />".
     "<input type=\"hidden\" class=\"desccost\" name=\"desccost\" value=\"".$extra['cost']."\" readonly=\"readonly\" />"; }
	 else {echo" ";}
	 }
	 }
	 
	 echo "</td>";
// Webbing
echo"<td><input type=\"button\" value=\"Remove Extras\" onclick=\"hidextra4();\" id=\"removextra4\"><input type=\"hidden\" class=\"webbing\" name=\"webbing[41]\" value=\"\" readonly=\"readonly\" /></td>";

// Colours
echo"<td><input type=\"hidden\" class=\"colour\" name=\"colour[41]\" value=\"\" readonly=\"readonly\" /></td>";
     	
// Paint and Powder
echo"<td><input type=\"hidden\" name=\"paint[41]\" value=\"\" readonly=\"readonly\" /></td>";

// Unit of Measurement
echo "<td><input type=\"text\" name=\"uom[41]\" class=\"uom\" readonly=\"readonly\" value=\"{$getUOM[41]}\"></td>";

// Unit Quantity
echo "<td><input type=\"text\" id=\"addqty27\" name=\"qty[41]\" value=\"{$getQty[41]}\"></td>";

// Length or Width
if ($getID[41] == '76') {
echo "<td><input type=\"text\" class=\"xlength\" name=\"slength[41]\" value=\"{$getLength[41]}\"></td>"; }
else {
echo "<td><input type=\"text\" class=\"xlength\" name=\"slength[41]\" value=\"{$getLength[41]}\" style=\"display:none;\"></td>";}

// Total RRP
echo "<td><input type=\"text\" class=\"rrp\" readonly=\"readonly\" name=\"rrp[41]\" value=\"{$getRRP[41]}\"><input type=\"hidden\" class=\"cst\" name=\"cst[41]\" value=\"${getCost[41]}\"></td></tr>";

// ***************************** Add Extra 4 ********************************************//

if ($getQty[42] != '0.00') {
echo "<tr id=\"extra5\" style=\"display:table-row;\">";

echo "<td><input type=\"hidden\" name=\"id[42]\" value=\"{$getCFID[42]}\" /><select class=\"desclist\" name=\"desclist[]\" >"; 
		foreach($extras as $extra) {
      	echo "<option value=\"".$extra['cf_id']."\"";
		if($extra['cf_id'] == $getID[42]) {
		echo "selected=\"selected\""; 
		} else {echo "";}
		echo ">".$extra['description']."</option>";	
		}	
echo "</select>";
    
	  foreach($extras as $extra){
      if ($extra['cf_id'] == $getID[42]) {
	 
echo "<input type=\"hidden\" class=\"desc\" name=\"desc[42]\" value=\"".$extra['description']."\" readonly=\"readonly\" />".
     "<input type=\"hidden\" class=\"invent\" name=\"invent[42]\" value=\"".$extra['inventoryid']."\" readonly=\"readonly\" />".
     "<input type=\"hidden\" class=\"descrrp\" name=\"descrrp\" value=\"".$extra['rrp']."\" readonly=\"readonly\" />".
     "<input type=\"hidden\" class=\"desccost\" name=\"desccost\" value=\"".$extra['cost']."\" readonly=\"readonly\" />"; }
	 else {echo" ";}
	 }
}  else {echo "<tr id=\"extra5\" style=\"display:none;\">";

echo "<td><input type=\"hidden\" name=\"id[42]\" value=\"{$getCFID[42]}\" /><select class=\"desclist\" name=\"desclist[]\" >"; 
		foreach($extras as $extra) {
      	echo "<option value=\"".$extra['cf_id']."\"";
		if($extra['cf_id'] == $getID[42]) {
		echo "selected=\"selected\""; 
		} else {echo "";}
		echo ">".$extra['description']."</option>";	
		}	
echo "</select>";
    
	  foreach($extras as $extra){
     if ($extra['cf_id'] == $getID[42]) {
	 
echo "<input type=\"hidden\" class=\"desc\" name=\"desc[42]\" value=\"".$extra['description']."\" readonly=\"readonly\" />".
     "<input type=\"hidden\" class=\"invent\" name=\"invent[42]\" value=\"".$extra['inventoryid']."\" readonly=\"readonly\" />".
     "<input type=\"hidden\" class=\"descrrp\" name=\"descrrp\" value=\"".$extra['rrp']."\" readonly=\"readonly\" />".
     "<input type=\"hidden\" class=\"desccost\" name=\"desccost\" value=\"".$extra['cost']."\" readonly=\"readonly\" />"; }
	 else {echo" ";}
	 }
	 }
	 
	 echo "</td>";
// Webbing
echo"<td><input type=\"button\" value=\"Remove Extras\" onclick=\"hidextra5();\" id=\"removextra5\"><input type=\"hidden\" class=\"webbing\" name=\"webbing[42]\" value=\"\" readonly=\"readonly\" /></td>";

// Colours
echo"<td><input type=\"hidden\" class=\"colour\" name=\"colour[42]\" value=\"\" readonly=\"readonly\" /></td>";
     	
// Paint and Powder
echo"<td><input type=\"hidden\" name=\"paint[42]\" value=\"\" readonly=\"readonly\" /></td>";

// Unit of Measurement
echo "<td><input type=\"text\" name=\"uom[42]\" class=\"uom\" readonly=\"readonly\" value=\"{$getUOM[42]}\"></td>";

// Unit Quantity
echo "<td><input type=\"text\" id=\"addqty28\" name=\"qty[42]\" value=\"{$getQty[42]}\"></td>";

// Length or Width
if ($getID[42] == '76') {
echo "<td><input type=\"text\" class=\"xlength\" name=\"slength[42]\" value=\"{$getLength[42]}\"></td>"; }
else {
echo "<td><input type=\"text\" class=\"xlength\" name=\"slength[42]\" value=\"{$getLength[42]}\" style=\"display:none;\"></td>";}

// Total RRP
echo "<td><input type=\"text\" class=\"rrp\" readonly=\"readonly\" name=\"rrp[42]\" value=\"{$getRRP[42]}\"><input type=\"hidden\" class=\"cst\" name=\"cst[42]\" value=\"${getCost[42]}\"></td></tr>";

// ***************************** Add Extra 5 ********************************************//

if ($getQty[43] != '0.00') {
echo "<tr id=\"extra6\" style=\"display:table-row;\">";

echo "<td><input type=\"hidden\" name=\"id[43]\" value=\"{$getCFID[43]}\" /><select class=\"desclist\" name=\"desclist[]\" >"; 
		foreach($extras as $extra) {
      	echo "<option value=\"".$extra['cf_id']."\"";
		if($extra['cf_id'] == $getID[43]) {
		echo "selected=\"selected\""; 
		} else {echo "";}
		echo ">".$extra['description']."</option>";	
		}	
echo "</select>";
    
	  foreach($extras as $extra){
      if ($extra['cf_id'] == $getID[43]) {
	 
echo "<input type=\"hidden\" class=\"desc\" name=\"desc[43]\" value=\"".$extra['description']."\" readonly=\"readonly\" />".
     "<input type=\"hidden\" class=\"invent\" name=\"invent[43]\" value=\"".$extra['inventoryid']."\" readonly=\"readonly\" />".
     "<input type=\"hidden\" class=\"descrrp\" name=\"descrrp\" value=\"".$extra['rrp']."\" readonly=\"readonly\" />".
     "<input type=\"hidden\" class=\"desccost\" name=\"desccost\" value=\"".$extra['cost']."\" readonly=\"readonly\" />"; }
	 else {echo" ";}
	 }
}  else {echo "<tr id=\"extra6\" style=\"display:none;\">";

echo "<td><input type=\"hidden\" name=\"id[43]\" value=\"{$getCFID[43]}\" /><select class=\"desclist\" name=\"desclist[]\" >"; 
		foreach($extras as $extra) {
      	echo "<option value=\"".$extra['cf_id']."\"";
		if($extra['cf_id'] == $getID[43]) {
		echo "selected=\"selected\""; 
		} else {echo "";}
		echo ">".$extra['description']."</option>";	
		}	
echo "</select>";
    
	  foreach($extras as $extra){
     if ($extra['cf_id'] == $getID[43]) {
	 
echo "<input type=\"hidden\" class=\"desc\" name=\"desc[43]\" value=\"".$extra['description']."\" readonly=\"readonly\" />".
     "<input type=\"hidden\" class=\"invent\" name=\"invent[43]\" value=\"".$extra['inventoryid']."\" readonly=\"readonly\" />".
     "<input type=\"hidden\" class=\"descrrp\" name=\"descrrp\" value=\"".$extra['rrp']."\" readonly=\"readonly\" />".
     "<input type=\"hidden\" class=\"desccost\" name=\"desccost\" value=\"".$extra['cost']."\" readonly=\"readonly\" />"; }
	 else {echo" ";}
	 }
	 }
	 
	 echo "</td>";
// Webbing
echo"<td><input type=\"button\" value=\"Remove Extras\" onclick=\"hidextra6();\" id=\"removextra6\"><input type=\"hidden\" class=\"webbing\" name=\"webbing[43]\" value=\"\" readonly=\"readonly\" /></td>";

// Colours
echo"<td><input type=\"hidden\" class=\"colour\" name=\"colour[43]\" value=\"\" readonly=\"readonly\" /></td>";
     	
// Paint and Powder
echo"<td><input type=\"hidden\" name=\"paint[43]\" value=\"\" readonly=\"readonly\" /></td>";

// Unit of Measurement
echo "<td><input type=\"text\" name=\"uom[43]\" class=\"uom\" readonly=\"readonly\" value=\"{$getUOM[43]}\"></td>";

// Unit Quantity
echo "<td><input type=\"text\" id=\"addqty29\" name=\"qty[43]\" value=\"{$getQty[43]}\"></td>";

// Length or Width
if ($getID[43] == '76') {
echo "<td><input type=\"text\" class=\"xlength\" name=\"slength[43]\" value=\"{$getLength[43]}\"></td>"; }
else {
echo "<td><input type=\"text\" class=\"xlength\" name=\"slength[43]\" value=\"{$getLength[43]}\" style=\"display:none;\"></td>";}

// Total RRP
echo "<td><input type=\"text\" class=\"rrp\" readonly=\"readonly\" name=\"rrp[43]\" value=\"{$getRRP[43]}\"><input type=\"hidden\" class=\"cst\" name=\"cst[43]\" value=\"${getCost[43]}\"></td></tr>";

// ***************************** Add Extra 6 ********************************************//

if ($getQty[44] != '0.00') {
echo "<tr id=\"extra7\" style=\"display:table-row;\">";

echo "<td><input type=\"hidden\" name=\"id[44]\" value=\"{$getCFID[44]}\" /><select class=\"desclist\" name=\"desclist[]\" >"; 
		foreach($extras as $extra) {
      	echo "<option value=\"".$extra['cf_id']."\"";
		if($extra['cf_id'] == $getID[44]) {
		echo "selected=\"selected\""; 
		} else {echo "";}
		echo ">".$extra['description']."</option>";	
		}	
echo "</select>";
    
	  foreach($extras as $extra){
      if ($extra['cf_id'] == $getID[44]) {
	 
echo "<input type=\"hidden\" class=\"desc\" name=\"desc[44]\" value=\"".$extra['description']."\" readonly=\"readonly\" />".
     "<input type=\"hidden\" class=\"invent\" name=\"invent[44]\" value=\"".$extra['inventoryid']."\" readonly=\"readonly\" />".
     "<input type=\"hidden\" class=\"descrrp\" name=\"descrrp\" value=\"".$extra['rrp']."\" readonly=\"readonly\" />".
     "<input type=\"hidden\" class=\"desccost\" name=\"desccost\" value=\"".$extra['cost']."\" readonly=\"readonly\" />"; }
	 else {echo" ";}
	 }
}  else {echo "<tr id=\"extra7\" style=\"display:none;\">";

echo "<td><input type=\"hidden\" name=\"id[44]\" value=\"{$getCFID[44]}\" /><select class=\"desclist\" name=\"desclist[]\" >"; 
		foreach($extras as $extra) {
      	echo "<option value=\"".$extra['cf_id']."\"";
		if($extra['cf_id'] == $getID[44]) {
		echo "selected=\"selected\""; 
		} else {echo "";}
		echo ">".$extra['description']."</option>";	
		}	
echo "</select>";
    
	  foreach($extras as $extra){
     if ($extra['cf_id'] == $getID[44]) {
	 
echo "<input type=\"hidden\" class=\"desc\" name=\"desc[44]\" value=\"".$extra['description']."\" readonly=\"readonly\" />".
     "<input type=\"hidden\" class=\"invent\" name=\"invent[44]\" value=\"".$extra['inventoryid']."\" readonly=\"readonly\" />".
     "<input type=\"hidden\" class=\"descrrp\" name=\"descrrp\" value=\"".$extra['rrp']."\" readonly=\"readonly\" />".
     "<input type=\"hidden\" class=\"desccost\" name=\"desccost\" value=\"".$extra['cost']."\" readonly=\"readonly\" />"; }
	 else {echo" ";}
	 }
	 }
	 
	 echo "</td>";
// Webbing
echo"<td><input type=\"button\" value=\"Remove Extras\" onclick=\"hidextra7();\" id=\"removextra7\"><input type=\"hidden\" class=\"webbing\" name=\"webbing[44]\" value=\"\" readonly=\"readonly\" /></td>";

// Colours
echo"<td><input type=\"hidden\" class=\"colour\" name=\"colour[44]\" value=\"\" readonly=\"readonly\" /></td>";
     	
// Paint and Powder
echo"<td><input type=\"hidden\" name=\"paint[44]\" value=\"\" readonly=\"readonly\" /></td>";

// Unit of Measurement
echo "<td><input type=\"text\" name=\"uom[44]\" class=\"uom\" readonly=\"readonly\" value=\"{$getUOM[44]}\"></td>";

// Unit Quantity
echo "<td><input type=\"text\" id=\"addqty30\" name=\"qty[44]\" value=\"{$getQty[44]}\"></td>";

// Length or Width
if ($getID[44] == '76') {
echo "<td><input type=\"text\" class=\"xlength\" name=\"slength[44]\" value=\"{$getLength[44]}\"></td>"; }
else {
echo "<td><input type=\"text\" class=\"xlength\" name=\"slength[44]\" value=\"{$getLength[44]}\" style=\"display:none;\"></td>";}

// Total RRP
echo "<td><input type=\"text\" class=\"rrp\" readonly=\"readonly\" name=\"rrp[44]\" value=\"{$getRRP[44]}\"><input type=\"hidden\" class=\"cst\" name=\"cst[44]\" value=\"${getCost[44]}\"></td></tr>";


// ***************************** Add Extra 7 ********************************************//

if ($getQty[45] != '0.00') {
echo "<tr id=\"extra8\" style=\"display:table-row;\">";

echo "<td><input type=\"hidden\" name=\"id[45]\" value=\"{$getCFID[45]}\" /><select class=\"desclist\" name=\"desclist[]\" >"; 
		foreach($extras as $extra) {
      	echo "<option value=\"".$extra['cf_id']."\"";
		if($extra['cf_id'] == $getID[45]) {
		echo "selected=\"selected\""; 
		} else {echo "";}
		echo ">".$extra['description']."</option>";	
		}	
echo "</select>";
    
	  foreach($extras as $extra){
      if ($extra['cf_id'] == $getID[45]) {
	 
echo "<input type=\"hidden\" class=\"desc\" name=\"desc[45]\" value=\"".$extra['description']."\" readonly=\"readonly\" />".
     "<input type=\"hidden\" class=\"invent\" name=\"invent[45]\" value=\"".$extra['inventoryid']."\" readonly=\"readonly\" />".
     "<input type=\"hidden\" class=\"descrrp\" name=\"descrrp\" value=\"".$extra['rrp']."\" readonly=\"readonly\" />".
     "<input type=\"hidden\" class=\"desccost\" name=\"desccost\" value=\"".$extra['cost']."\" readonly=\"readonly\" />"; }
	 else {echo" ";}
	 }
}  else {echo "<tr id=\"extra8\" style=\"display:none;\">";

echo "<td><input type=\"hidden\" name=\"id[45]\" value=\"{$getCFID[45]}\" /><select class=\"desclist\" name=\"desclist[]\" >"; 
		foreach($extras as $extra) {
      	echo "<option value=\"".$extra['cf_id']."\"";
		if($extra['cf_id'] == $getID[45]) {
		echo "selected=\"selected\""; 
		} else {echo "";}
		echo ">".$extra['description']."</option>";	
		}	
echo "</select>";
    
	  foreach($extras as $extra){
     if ($extra['cf_id'] == $getID[45]) {
	 
echo "<input type=\"hidden\" class=\"desc\" name=\"desc[45]\" value=\"".$extra['description']."\" readonly=\"readonly\" />".
     "<input type=\"hidden\" class=\"invent\" name=\"invent[45]\" value=\"".$extra['inventoryid']."\" readonly=\"readonly\" />".
     "<input type=\"hidden\" class=\"descrrp\" name=\"descrrp\" value=\"".$extra['rrp']."\" readonly=\"readonly\" />".
     "<input type=\"hidden\" class=\"desccost\" name=\"desccost\" value=\"".$extra['cost']."\" readonly=\"readonly\" />"; }
	 else {echo" ";}
	 }
	 }
	 
	 echo "</td>";
// Webbing
echo"<td><input type=\"button\" value=\"Remove Extras\" onclick=\"hidextra8();\" id=\"removextra8\"><input type=\"hidden\" class=\"webbing\" name=\"webbing[45]\" value=\"\" readonly=\"readonly\" /></td>";

// Colours
echo"<td><input type=\"hidden\" class=\"colour\" name=\"colour[45]\" value=\"\" readonly=\"readonly\" /></td>";
     	
// Paint and Powder
echo"<td><input type=\"hidden\" name=\"paint[45]\" value=\"\" readonly=\"readonly\" /></td>";

// Unit of Measurement
echo "<td><input type=\"text\" name=\"uom[45]\" class=\"uom\" readonly=\"readonly\" value=\"{$getUOM[45]}\"></td>";

// Unit Quantity
echo "<td><input type=\"text\" id=\"addqty31\" name=\"qty[45]\" value=\"{$getQty[45]}\"></td>";

// Length or Width
if ($getID[45] == '76') {
echo "<td><input type=\"text\" class=\"xlength\" name=\"slength[45]\" value=\"{$getLength[45]}\"></td>"; }
else {
echo "<td><input type=\"text\" class=\"xlength\" name=\"slength[45]\" value=\"{$getLength[45]}\" style=\"display:none;\"></td>";}

// Total RRP
echo "<td><input type=\"text\" class=\"rrp\" readonly=\"readonly\" name=\"rrp[45]\" value=\"{$getRRP[45]}\"><input type=\"hidden\" class=\"cst\" name=\"cst[45]\" value=\"${getCost[45]}\"></td></tr>";

// ***************************** Add Extra 8 ********************************************//

if ($getQty[46] != '0.00') {
echo "<tr id=\"extra9\" style=\"display:table-row;\">";

echo "<td><input type=\"hidden\" name=\"id[46]\" value=\"{$getCFID[46]}\" /><select class=\"desclist\" name=\"desclist[]\" >"; 
		foreach($extras as $extra) {
      	echo "<option value=\"".$extra['cf_id']."\"";
		if($extra['cf_id'] == $getID[46]) {
		echo "selected=\"selected\""; 
		} else {echo "";}
		echo ">".$extra['description']."</option>";	
		}	
echo "</select>";
    
	  foreach($extras as $extra){
      if ($extra['cf_id'] == $getID[46]) {
	 
echo "<input type=\"hidden\" class=\"desc\" name=\"desc[46]\" value=\"".$extra['description']."\" readonly=\"readonly\" />".
     "<input type=\"hidden\" class=\"invent\" name=\"invent[46]\" value=\"".$extra['inventoryid']."\" readonly=\"readonly\" />".
     "<input type=\"hidden\" class=\"descrrp\" name=\"descrrp\" value=\"".$extra['rrp']."\" readonly=\"readonly\" />".
     "<input type=\"hidden\" class=\"desccost\" name=\"desccost\" value=\"".$extra['cost']."\" readonly=\"readonly\" />"; }
	 else {echo" ";}
	 }
}  else {echo "<tr id=\"extra9\" style=\"display:none;\">";

echo "<td><input type=\"hidden\" name=\"id[46]\" value=\"{$getCFID[46]}\" /><select class=\"desclist\" name=\"desclist[]\" >"; 
		foreach($extras as $extra) {
      	echo "<option value=\"".$extra['cf_id']."\"";
		if($extra['cf_id'] == $getID[46]) {
		echo "selected=\"selected\""; 
		} else {echo "";}
		echo ">".$extra['description']."</option>";	
		}	
echo "</select>";
    
	  foreach($extras as $extra){
     if ($extra['cf_id'] == $getID[46]) {
	 
echo "<input type=\"hidden\" class=\"desc\" name=\"desc[46]\" value=\"".$extra['description']."\" readonly=\"readonly\" />".
     "<input type=\"hidden\" class=\"invent\" name=\"invent[46]\" value=\"".$extra['inventoryid']."\" readonly=\"readonly\" />".
     "<input type=\"hidden\" class=\"descrrp\" name=\"descrrp\" value=\"".$extra['rrp']."\" readonly=\"readonly\" />".
     "<input type=\"hidden\" class=\"desccost\" name=\"desccost\" value=\"".$extra['cost']."\" readonly=\"readonly\" />"; }
	 else {echo" ";}
	 }
	 }
	 
	 echo "</td>";
// Webbing
echo"<td><input type=\"button\" value=\"Remove Extras\" onclick=\"hidextra9();\" id=\"removextra9\"><input type=\"hidden\" class=\"webbing\" name=\"webbing[46]\" value=\"\" readonly=\"readonly\" /></td>";

// Colours
echo"<td><input type=\"hidden\" class=\"colour\" name=\"colour[46]\" value=\"\" readonly=\"readonly\" /></td>";
     	
// Paint and Powder
echo"<td><input type=\"hidden\" name=\"paint[46]\" value=\"\" readonly=\"readonly\" /></td>";

// Unit of Measurement
echo "<td><input type=\"text\" name=\"uom[46]\" class=\"uom\" readonly=\"readonly\" value=\"{$getUOM[46]}\"></td>";

// Unit Quantity
echo "<td><input type=\"text\" id=\"addqty32\" name=\"qty[46]\" value=\"{$getQty[46]}\"></td>";

// Length or Width
if ($getID[46] == '76') {
echo "<td><input type=\"text\" class=\"xlength\" name=\"slength[46]\" value=\"{$getLength[46]}\"></td>"; }
else {
echo "<td><input type=\"text\" class=\"xlength\" name=\"slength[46]\" value=\"{$getLength[46]}\" style=\"display:none;\"></td>";}

// Total RRP
echo "<td><input type=\"text\" class=\"rrp\" readonly=\"readonly\" name=\"rrp[46]\" value=\"{$getRRP[46]}\"><input type=\"hidden\" class=\"cst\" name=\"cst[46]\" value=\"${getCost[46]}\"></td></tr>";

// ***************************** Add Extra 9 ********************************************//

if ($getQty[47] != '0.00') {
echo "<tr id=\"extra10\" style=\"display:table-row;\">";

echo "<td><input type=\"hidden\" name=\"id[47]\" value=\"{$getCFID[47]}\" /><select class=\"desclist\" name=\"desclist[]\" >"; 
		foreach($extras as $extra) {
      	echo "<option value=\"".$extra['cf_id']."\"";
		if($extra['cf_id'] == $getID[47]) {
		echo "selected=\"selected\""; 
		} else {echo "";}
		echo ">".$extra['description']."</option>";	
		}	
echo "</select>";
    
	  foreach($extras as $extra){
      if ($extra['cf_id'] == $getID[47]) {
	 
echo "<input type=\"hidden\" class=\"desc\" name=\"desc[47]\" value=\"".$extra['description']."\" readonly=\"readonly\" />".
     "<input type=\"hidden\" class=\"invent\" name=\"invent[47]\" value=\"".$extra['inventoryid']."\" readonly=\"readonly\" />".
     "<input type=\"hidden\" class=\"descrrp\" name=\"descrrp\" value=\"".$extra['rrp']."\" readonly=\"readonly\" />".
     "<input type=\"hidden\" class=\"desccost\" name=\"desccost\" value=\"".$extra['cost']."\" readonly=\"readonly\" />"; }
	 else {echo" ";}
	 }
}  else {echo "<tr id=\"extra10\" style=\"display:none;\">";

echo "<td><input type=\"hidden\" name=\"id[47]\" value=\"{$getCFID[47]}\" /><select class=\"desclist\" name=\"desclist[]\" >"; 
		foreach($extras as $extra) {
      	echo "<option value=\"".$extra['cf_id']."\"";
		if($extra['cf_id'] == $getID[47]) {
		echo "selected=\"selected\""; 
		} else {echo "";}
		echo ">".$extra['description']."</option>";	
		}	
echo "</select>";
    
	  foreach($extras as $extra){
     if ($extra['cf_id'] == $getID[47]) {
	 
echo "<input type=\"hidden\" class=\"desc\" name=\"desc[47]\" value=\"".$extra['description']."\" readonly=\"readonly\" />".
     "<input type=\"hidden\" class=\"invent\" name=\"invent[47]\" value=\"".$extra['inventoryid']."\" readonly=\"readonly\" />".
     "<input type=\"hidden\" class=\"descrrp\" name=\"descrrp\" value=\"".$extra['rrp']."\" readonly=\"readonly\" />".
     "<input type=\"hidden\" class=\"desccost\" name=\"desccost\" value=\"".$extra['cost']."\" readonly=\"readonly\" />"; }
	 else {echo" ";}
	 }
	 }
	 
	 echo "</td>";
// Webbing
echo"<td><input type=\"button\" value=\"Remove Extras\" onclick=\"hidextra10();\" id=\"removextra10\"><input type=\"hidden\" class=\"webbing\" name=\"webbing[47]\" value=\"\" readonly=\"readonly\" /></td>";

// Colours
echo"<td><input type=\"hidden\" class=\"colour\" name=\"colour[47]\" value=\"\" readonly=\"readonly\" /></td>";
     	
// Paint and Powder
echo"<td><input type=\"hidden\" name=\"paint[47]\" value=\"\" readonly=\"readonly\" /></td>";

// Unit of Measurement
echo "<td><input type=\"text\" name=\"uom[47]\" class=\"uom\" readonly=\"readonly\" value=\"{$getUOM[47]}\"></td>";

// Unit Quantity
echo "<td><input type=\"text\" id=\"addqty33\" name=\"qty[47]\" value=\"{$getQty[47]}\"></td>";

// Length or Width
if ($getID[47] == '76') {
echo "<td><input type=\"text\" class=\"xlength\" name=\"slength[47]\" value=\"{$getLength[47]}\"></td>"; }
else {
echo "<td><input type=\"text\" class=\"xlength\" name=\"slength[47]\" value=\"{$getLength[47]}\" style=\"display:none;\"></td>";}

// Total RRP
echo "<td><input type=\"text\" class=\"rrp\" readonly=\"readonly\" name=\"rrp[47]\" value=\"{$getRRP[47]}\"><input type=\"hidden\" class=\"cst\" name=\"cst[47]\" value=\"${getCost[47]}\"></td></tr>";

// ***************************** Add Extra 10 ********************************************//

if ($getQty[48] != '0.00') {
echo "<tr id=\"extra11\" style=\"display:table-row;\">";

echo "<td><input type=\"hidden\" name=\"id[48]\" value=\"{$getCFID[48]}\" /><select class=\"desclist\" name=\"desclist[]\" >"; 
		foreach($extras as $extra) {
      	echo "<option value=\"".$extra['cf_id']."\"";
		if($extra['cf_id'] == $getID[48]) {
		echo "selected=\"selected\""; 
		} else {echo "";}
		echo ">".$extra['description']."</option>";	
		}	
echo "</select>";
    
	  foreach($extras as $extra){
      if ($extra['cf_id'] == $getID[48]) {
	 
echo "<input type=\"hidden\" class=\"desc\" name=\"desc[48]\" value=\"".$extra['description']."\" readonly=\"readonly\" />".
     "<input type=\"hidden\" class=\"invent\" name=\"invent[48]\" value=\"".$extra['inventoryid']."\" readonly=\"readonly\" />".
     "<input type=\"hidden\" class=\"descrrp\" name=\"descrrp\" value=\"".$extra['rrp']."\" readonly=\"readonly\" />".
     "<input type=\"hidden\" class=\"desccost\" name=\"desccost\" value=\"".$extra['cost']."\" readonly=\"readonly\" />"; }
	 else {echo" ";}
	 }
}  else {echo "<tr id=\"extra11\" style=\"display:none;\">";

echo "<td><input type=\"hidden\" name=\"id[48]\" value=\"{$getCFID[48]}\" /><select class=\"desclist\" name=\"desclist[]\" >"; 
		foreach($extras as $extra) {
      	echo "<option value=\"".$extra['cf_id']."\"";
		if($extra['cf_id'] == $getID[48]) {
		echo "selected=\"selected\""; 
		} else {echo "";}
		echo ">".$extra['description']."</option>";	
		}	
echo "</select>";
    
	  foreach($extras as $extra){
     if ($extra['cf_id'] == $getID[48]) {
	 
echo "<input type=\"hidden\" class=\"desc\" name=\"desc[48]\" value=\"".$extra['description']."\" readonly=\"readonly\" />".
     "<input type=\"hidden\" class=\"invent\" name=\"invent[48]\" value=\"".$extra['inventoryid']."\" readonly=\"readonly\" />".
     "<input type=\"hidden\" class=\"descrrp\" name=\"descrrp\" value=\"".$extra['rrp']."\" readonly=\"readonly\" />".
     "<input type=\"hidden\" class=\"desccost\" name=\"desccost\" value=\"".$extra['cost']."\" readonly=\"readonly\" />"; }
	 else {echo" ";}
	 }
	 }
	 
	 echo "</td>";
// Webbing
echo"<td><input type=\"button\" value=\"Remove Extras\" onclick=\"hidextra11();\" id=\"removextra11\"><input type=\"hidden\" class=\"webbing\" name=\"webbing[48]\" value=\"\" readonly=\"readonly\" /></td>";

// Colours
echo"<td><input type=\"hidden\" class=\"colour\" name=\"colour[48]\" value=\"\" readonly=\"readonly\" /></td>";
     	
// Paint and Powder
echo"<td><input type=\"hidden\" name=\"paint[48]\" value=\"\" readonly=\"readonly\" /></td>";

// Unit of Measurement
echo "<td><input type=\"text\" name=\"uom[48]\" class=\"uom\" readonly=\"readonly\" value=\"{$getUOM[48]}\"></td>";

// Unit Quantity
echo "<td><input type=\"text\" id=\"addqty34\" name=\"qty[48]\" value=\"{$getQty[48]}\"></td>";

// Length or Width
if ($getID[48] == '76') {
echo "<td><input type=\"text\" class=\"xlength\" name=\"slength[48]\" value=\"{$getLength[48]}\"></td>"; }
else {
echo "<td><input type=\"text\" class=\"xlength\" name=\"slength[48]\" value=\"{$getLength[48]}\" style=\"display:none;\"></td>";}

// Total RRP
echo "<td><input type=\"text\" class=\"rrp\" readonly=\"readonly\" name=\"rrp[48]\" value=\"{$getRRP[48]}\"><input type=\"hidden\" class=\"cst\" name=\"cst[48]\" value=\"${getCost[48]}\"></td></tr>";

/****************************************************************** Add Extra Show *****************************************************************/
?>