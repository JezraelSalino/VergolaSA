<?php 
// ***************************** Opaque Enclosure ********************************************//
echo "<tr><td colspan=\"8\" class=\"subheading\">Misc Items</td></tr>";
echo "<tr><td><input type=\"hidden\" name=\"id[53]\" value=\"{$getCFID[53]}\" />".$getDesc[53];
	$miscitems = array();
	while ($item = mysql_fetch_array($resultmiscitems)) {
		$miscitems[] = $item; 	
	}	
	//echo "</td><td>HERE - ".print_r($miscitems)."</td><td>";
	if(count($miscitems)){
	  	foreach($miscitems as $miscitem) {
			if ($miscitem['cf_id'] == $getID[53]) {  
			echo "<input type=\"hidden\" class=\"desc\" name=\"desc[53]\" value=\"".$miscitem['description']."\" readonly=\"readonly\" />".
			"<input type=\"hidden\" class=\"invent\" name=\"invent[53]\" value=\"".$miscitem['inventoryid']."\" readonly=\"readonly\" />".
			"<input type=\"hidden\" class=\"descrrp\" name=\"descrrp\" value=\"".$miscitem['rrp']."\" readonly=\"readonly\" />".
	        "<input type=\"hidden\" class=\"desccost\" name=\"desccost\" value=\"".$miscitem['cost']."\" readonly=\"readonly\" /></td>";
			    
			}
			else { echo " ";}
		}
	}

// Webbing
echo"<td><input type=\"hidden\" class=\"webbing\" name=\"webbing[53]\" value=\"\" readonly=\"readonly\" /></td>";

// Colours
echo"<td><input type=\"hidden\" class=\"colour\" name=\"colour[53]\" value=\"\" readonly=\"readonly\" /></td>";
     	
// Paint and Powder
echo"<td><input type=\"hidden\" name=\"paint[53]\" value=\"\" readonly=\"readonly\" /></td>";

// Unit of Measurement
echo "<td><input type=\"text\" name=\"uom[53]\" readonly=\"readonly\" value=\"{$getUOM[53]}\"></td>";	
// Unit Quantity
echo "<td><input type=\"text\" class=\"qtylen\" name=\"qty[53]\" value=\"{$getQty[53]}\"></td>";

// Length or Width
echo "<td><input type=\"hidden\" name=\"slength[53]\" value=\"{$getLength[53]}\" readonly=\"readonly\" /></td>";

// Total RRP
echo "<td><input type=\"text\" class=\"rrp\" readonly=\"readonly\" name=\"rrp[53]\" value=\"{$getRRP[53]}\"><input type=\"hidden\" class=\"cst\" name=\"cst[53]\" value=\"{$getCost[53]}\"></td></tr>";


// ***************************** Misc Cost ********************************************//

echo "<tr><td><input type=\"hidden\" name=\"id[54]\" value=\"{$getCFID[54]}\" />".$getDesc[54];
    if(count($miscitems)){
      	foreach($miscitems as $miscitem) {
		if ($miscitem['cf_id'] == $getID[54]) {  
		echo "<input type=\"hidden\" class=\"desc\" name=\"desc[54]\" value=\"".$miscitem['description']."\" readonly=\"readonly\" />".
		"<input type=\"hidden\" class=\"invent\" name=\"invent[54]\" value=\"".$miscitem['inventoryid']."\" readonly=\"readonly\" />".
		"<input type=\"hidden\" class=\"descrrp\" name=\"descrrp\" value=\"".$miscitem['rrp']."\" readonly=\"readonly\" />".
        "<input type=\"hidden\" class=\"desccost\" name=\"desccost\" value=\"".$miscitem['cost']."\" readonly=\"readonly\" /></td>";
		    
}
else { echo " ";}
		}
	}
// Webbing
echo"<td><input type=\"hidden\" class=\"webbing\" name=\"webbing[54]\" value=\"\" readonly=\"readonly\" /></td>";

// Colours
echo"<td><input type=\"hidden\" class=\"colour\" name=\"colour[54]\" value=\"\" readonly=\"readonly\" /></td>";
     	
// Paint and Powder
echo"<td><input type=\"hidden\" name=\"paint[54]\" value=\"\" readonly=\"readonly\" /></td>";

// Unit of Measurement
echo "<td><input type=\"text\" name=\"uom[54]\" readonly=\"readonly\" value=\"{$getUOM[54]}\"></td>";	
// Unit Quantity
echo "<td><input type=\"text\" class=\"qtylen\" name=\"qty[54]\" value=\"{$getQty[54]}\"></td>";

// Length or Width
echo "<td><input type=\"hidden\" name=\"slength[54]\" value=\"{$getLength[54]}\" readonly=\"readonly\" /></td>";

// Total RRP
echo "<td><input type=\"text\" class=\"rrp\" readonly=\"readonly\" name=\"rrp[54]\" value=\"{$getRRP[54]}\"><input type=\"hidden\" class=\"cst\" name=\"cst[54]\" value=\"{$getCost[54]}\"></td></tr>";

// ***************************** Add Misc ********************************************//
echo "<tr id=\"extra1\" style=\"display: table-row\"><td><input type=\"hidden\" name=\"id[54]\" value=\"{$getCFID[54]}\" /><select class=\"desclist\" name=\"desclist[]\" >";
        
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
		if($misc['cf_id'] == $getID[54]) {
		echo "selected=\"selected\""; 
		} else {echo "";}
		echo ">".$misc['description']."</option>";	
		}	
echo "</select>";
    
	  foreach($miscs as $misc){
     if ($misc['cf_id'] == $getID[54]) {
	 
echo "<input type=\"hidden\" class=\"desc\" name=\"desc[54]\" value=\"".$misc['description']."\" readonly=\"readonly\" />".
     "<input type=\"hidden\" class=\"invent\" name=\"invent[54]\" value=\"".$misc['inventoryid']."\" readonly=\"readonly\" />".
     "<input type=\"hidden\" class=\"descrrp\" name=\"descrrp\" value=\"".$misc['rrp']."\" readonly=\"readonly\" />".
     "<input type=\"hidden\" class=\"desccost\" name=\"desccost\" value=\"".$misc['cost']."\" readonly=\"readonly\" />"; }
	 else {echo" ";}
	 }
		
		echo "</td>";
// Webbing
echo"<td><input type=\"button\" value=\"Remove Misc\" onclick=\"hidextra1();\" id=\"removextra1\"><input type=\"hidden\" class=\"webbing\" name=\"webbing[54]\" value=\"\" readonly=\"readonly\" /></td>";

// Colours
echo"<td><input type=\"hidden\" class=\"colour\" name=\"colour[54]\" value=\"\" readonly=\"readonly\" /></td>";
     	
// Paint and Powder
echo"<td><input type=\"hidden\" name=\"paint[54]\" value=\"\" readonly=\"readonly\" /></td>";

// Unit of Measurement
echo "<td><input type=\"text\" name=\"uom[54]\" id=\"uom\" readonly=\"readonly\" value=\"".$misc['uom']."\"></td>";
		
// Unit Quantity
echo "<td><input type=\"text\" id=\"addqty24\" name=\"qty[54]\" value=\"{$getQty[54]}\"></td>";

// Length or Width
echo "<td><input type=\"hidden\" name=\"slength[54]\" value=\"{$getLength[54]}\" readonly=\"readonly\" /></td>";

// Total RRP
echo "<td><input type=\"text\" class=\"rrp\" readonly=\"readonly\" name=\"rrp[54]\" value=\"{$getRRP[54]}\"><input type=\"hidden\" class=\"cst\" name=\"cst[54]\" value=\"{$getCost[54]}\"></td></tr>";

// ***************************** Add Extra 1 ********************************************//
echo "<tr><td colspan=\"8\" class=\"subheading\">Extras</td></tr>";
if ($getQty[55] != '0.00') {
echo "<tr id=\"extra2\" style=\"display:table-row;\">";

echo "<td><input type=\"hidden\" name=\"id[55]\" value=\"{$getCFID[55]}\" /><select class=\"desclist\" name=\"desclist[]\" >"; 
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
		if($extra['cf_id'] == $getID[55]) {
		echo "selected=\"selected\""; 
		} else {echo "";}
		echo ">".$extra['description']."</option>";	
		}	
echo "</select>";
    
	  foreach($extras as $extra){
     if ($extra['cf_id'] == $getID[55]) {
	 
echo "<input type=\"hidden\" class=\"desc\" name=\"desc[55]\" value=\"".$extra['description']."\" readonly=\"readonly\" />".
     "<input type=\"hidden\" class=\"invent\" name=\"invent[55]\" value=\"".$extra['inventoryid']."\" readonly=\"readonly\" />".
     "<input type=\"hidden\" class=\"descrrp\" name=\"descrrp\" value=\"".$extra['rrp']."\" readonly=\"readonly\" />".
     "<input type=\"hidden\" class=\"desccost\" name=\"desccost\" value=\"".$extra['cost']."\" readonly=\"readonly\" />"; }
	 else {echo" ";}
	 }
}  else {echo "<tr id=\"extra2\" style=\"display:none;\">";

echo "<td><input type=\"hidden\" name=\"id[55]\" value=\"{$getCFID[55]}\" /><select class=\"desclist\" name=\"desclist[]\" >"; 
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
		if($extra['cf_id'] == $getID[55]) {
		echo "selected=\"selected\""; 
		} else {echo "";}
		echo ">".$extra['description']."</option>";	
		}	
echo "</select>";
    
	  foreach($extras as $extra){
     if ($extra['cf_id'] == $getID[55]) {
	 
echo "<input type=\"hidden\" class=\"desc\" name=\"desc[55]\" value=\"".$extra['description']."\" readonly=\"readonly\" />".
     "<input type=\"hidden\" class=\"invent\" name=\"invent[55]\" value=\"".$extra['inventoryid']."\" readonly=\"readonly\" />".
     "<input type=\"hidden\" class=\"descrrp\" name=\"descrrp\" value=\"".$extra['rrp']."\" readonly=\"readonly\" />".
     "<input type=\"hidden\" class=\"desccost\" name=\"desccost\" value=\"".$extra['cost']."\" readonly=\"readonly\" />"; }
	 else {echo" ";}
	 }
	 }
	 
	 echo "</td>";
// Webbing
echo"<td><input type=\"button\" value=\"Remove Extras\" onclick=\"hidextra2();\" id=\"removextra2\"><input type=\"hidden\" class=\"webbing\" name=\"webbing[55]\" value=\"\" readonly=\"readonly\" /></td>";

// Colours
echo"<td><input type=\"hidden\" class=\"colour\" name=\"colour[55]\" value=\"\" readonly=\"readonly\" /></td>";
     	
// Paint and Powder
echo"<td><input type=\"hidden\" name=\"paint[55]\" value=\"\" readonly=\"readonly\" /></td>";

// Unit of Measurement
echo "<td><input type=\"text\" name=\"uom[55]\" class=\"uom\" readonly=\"readonly\" value=\"{$getUOM[55]}\"></td>";

// Unit Quantity
echo "<td><input type=\"text\" id=\"addqty25\" name=\"qty[55]\" value=\"{$getQty[55]}\"></td>";

// Length or Width
if ($getID[55] == '76') {
echo "<td><input type=\"text\" class=\"xlength\" name=\"slength[55]\" value=\"{$getLength[55]}\"></td>"; }
else {
echo "<td><input type=\"text\" class=\"xlength\" name=\"slength[55]\" value=\"{$getLength[55]}\" style=\"display:none;\"></td>";}

// Total RRP
echo "<td><input type=\"text\" class=\"rrp\" readonly=\"readonly\" name=\"rrp[55]\" value=\"{$getRRP[55]}\"><input type=\"hidden\" class=\"cst\" name=\"cst[55]\" value=\"${getCost[55]}\"></td></tr>";

// ***************************** Add Extra 2 ********************************************//

if ($getQty[56] != '0.00') {
echo "<tr id=\"extra3\" style=\"display:table-row;\">";

echo "<td><input type=\"hidden\" name=\"id[56]\" value=\"{$getCFID[56]}\" /><select class=\"desclist\" name=\"desclist[]\" >"; 
		foreach($extras as $extra) {
      	echo "<option value=\"".$extra['cf_id']."\"";
		if($extra['cf_id'] == $getID[56]) {
		echo "selected=\"selected\""; 
		} else {echo "";}
		echo ">".$extra['description']."</option>";	
		}	
echo "</select>";
    
	  foreach($extras as $extra){
      if ($extra['cf_id'] == $getID[56]) {
	 
echo "<input type=\"hidden\" class=\"desc\" name=\"desc[56]\" value=\"".$extra['description']."\" readonly=\"readonly\" />".
     "<input type=\"hidden\" class=\"invent\" name=\"invent[56]\" value=\"".$extra['inventoryid']."\" readonly=\"readonly\" />".
     "<input type=\"hidden\" class=\"descrrp\" name=\"descrrp\" value=\"".$extra['rrp']."\" readonly=\"readonly\" />".
     "<input type=\"hidden\" class=\"desccost\" name=\"desccost\" value=\"".$extra['cost']."\" readonly=\"readonly\" />"; }
	 else {echo" ";}
	 }
}  else {echo "<tr id=\"extra3\" style=\"display:none;\">";

echo "<td><input type=\"hidden\" name=\"id[56]\" value=\"{$getCFID[56]}\" /><select class=\"desclist\" name=\"desclist[]\" >"; 
		foreach($extras as $extra) {
      	echo "<option value=\"".$extra['cf_id']."\"";
		if($extra['cf_id'] == $getID[56]) {
		echo "selected=\"selected\""; 
		} else {echo "";}
		echo ">".$extra['description']."</option>";	
		}	
echo "</select>";
    
	  foreach($extras as $extra){
     if ($extra['cf_id'] == $getID[56]) {
	 
echo "<input type=\"hidden\" class=\"desc\" name=\"desc[56]\" value=\"".$extra['description']."\" readonly=\"readonly\" />".
     "<input type=\"hidden\" class=\"invent\" name=\"invent[56]\" value=\"".$extra['inventoryid']."\" readonly=\"readonly\" />".
     "<input type=\"hidden\" class=\"descrrp\" name=\"descrrp\" value=\"".$extra['rrp']."\" readonly=\"readonly\" />".
     "<input type=\"hidden\" class=\"desccost\" name=\"desccost\" value=\"".$extra['cost']."\" readonly=\"readonly\" />"; }
	 else {echo" ";}
	 }
	 }
	 
	 echo "</td>";
// Webbing
echo"<td><input type=\"button\" value=\"Remove Extras\" onclick=\"hidextra3();\" id=\"removextra3\"><input type=\"hidden\" class=\"webbing\" name=\"webbing[56]\" value=\"\" readonly=\"readonly\" /></td>";

// Colours
echo"<td><input type=\"hidden\" class=\"colour\" name=\"colour[56]\" value=\"\" readonly=\"readonly\" /></td>";
     	
// Paint and Powder
echo"<td><input type=\"hidden\" name=\"paint[56]\" value=\"\" readonly=\"readonly\" /></td>";

// Unit of Measurement
echo "<td><input type=\"text\" name=\"uom[56]\" class=\"uom\" readonly=\"readonly\" value=\"{$getUOM[56]}\"></td>";

// Unit Quantity
echo "<td><input type=\"text\" id=\"addqty26\" name=\"qty[56]\" value=\"{$getQty[56]}\"></td>";

// Length or Width
if ($getID[56] == '76') {
echo "<td><input type=\"text\" class=\"xlength\" name=\"slength[56]\" value=\"{$getLength[56]}\"></td>"; }
else {
echo "<td><input type=\"text\" class=\"xlength\" name=\"slength[56]\" value=\"{$getLength[56]}\" style=\"display:none;\"></td>";}

// Total RRP
echo "<td><input type=\"text\" class=\"rrp\" readonly=\"readonly\" name=\"rrp[56]\" value=\"{$getRRP[56]}\"><input type=\"hidden\" class=\"cst\" name=\"cst[56]\" value=\"${getCost[56]}\"></td></tr>";

// ***************************** Add Extra 3 ********************************************//

if ($getQty[57] != '0.00') {
echo "<tr id=\"extra4\" style=\"display:table-row;\">";

echo "<td><input type=\"hidden\" name=\"id[57]\" value=\"{$getCFID[57]}\" /><select class=\"desclist\" name=\"desclist[]\" >"; 
		foreach($extras as $extra) {
      	echo "<option value=\"".$extra['cf_id']."\"";
		if($extra['cf_id'] == $getID[57]) {
		echo "selected=\"selected\""; 
		} else {echo "";}
		echo ">".$extra['description']."</option>";	
		}	
echo "</select>";
    
	  foreach($extras as $extra){
      if ($extra['cf_id'] == $getID[57]) {
	 
echo "<input type=\"hidden\" class=\"desc\" name=\"desc[57]\" value=\"".$extra['description']."\" readonly=\"readonly\" />".
     "<input type=\"hidden\" class=\"invent\" name=\"invent[57]\" value=\"".$extra['inventoryid']."\" readonly=\"readonly\" />".
     "<input type=\"hidden\" class=\"descrrp\" name=\"descrrp\" value=\"".$extra['rrp']."\" readonly=\"readonly\" />".
     "<input type=\"hidden\" class=\"desccost\" name=\"desccost\" value=\"".$extra['cost']."\" readonly=\"readonly\" />"; }
	 else {echo" ";}
	 }
}  else {echo "<tr id=\"extra4\" style=\"display:none;\">";

echo "<td><input type=\"hidden\" name=\"id[57]\" value=\"{$getCFID[57]}\" /><select class=\"desclist\" name=\"desclist[]\" >"; 
		foreach($extras as $extra) {
      	echo "<option value=\"".$extra['cf_id']."\"";
		if($extra['cf_id'] == $getID[57]) {
		echo "selected=\"selected\""; 
		} else {echo "";}
		echo ">".$extra['description']."</option>";	
		}	
echo "</select>";
    
	  foreach($extras as $extra){
     if ($extra['cf_id'] == $getID[57]) {
	 
echo "<input type=\"hidden\" class=\"desc\" name=\"desc[57]\" value=\"".$extra['description']."\" readonly=\"readonly\" />".
     "<input type=\"hidden\" class=\"invent\" name=\"invent[57]\" value=\"".$extra['inventoryid']."\" readonly=\"readonly\" />".
     "<input type=\"hidden\" class=\"descrrp\" name=\"descrrp\" value=\"".$extra['rrp']."\" readonly=\"readonly\" />".
     "<input type=\"hidden\" class=\"desccost\" name=\"desccost\" value=\"".$extra['cost']."\" readonly=\"readonly\" />"; }
	 else {echo" ";}
	 }
	 }
	 
	 echo "</td>";
// Webbing
echo"<td><input type=\"button\" value=\"Remove Extras\" onclick=\"hidextra4();\" id=\"removextra4\"><input type=\"hidden\" class=\"webbing\" name=\"webbing[57]\" value=\"\" readonly=\"readonly\" /></td>";

// Colours
echo"<td><input type=\"hidden\" class=\"colour\" name=\"colour[57]\" value=\"\" readonly=\"readonly\" /></td>";
     	
// Paint and Powder
echo"<td><input type=\"hidden\" name=\"paint[57]\" value=\"\" readonly=\"readonly\" /></td>";

// Unit of Measurement
echo "<td><input type=\"text\" name=\"uom[57]\" class=\"uom\" readonly=\"readonly\" value=\"{$getUOM[57]}\"></td>";

// Unit Quantity
echo "<td><input type=\"text\" id=\"addqty27\" name=\"qty[57]\" value=\"{$getQty[57]}\"></td>";

// Length or Width
if ($getID[57] == '76') {
echo "<td><input type=\"text\" class=\"xlength\" name=\"slength[57]\" value=\"{$getLength[57]}\"></td>"; }
else {
echo "<td><input type=\"text\" class=\"xlength\" name=\"slength[57]\" value=\"{$getLength[57]}\" style=\"display:none;\"></td>";}

// Total RRP
echo "<td><input type=\"text\" class=\"rrp\" readonly=\"readonly\" name=\"rrp[57]\" value=\"{$getRRP[57]}\"><input type=\"hidden\" class=\"cst\" name=\"cst[57]\" value=\"${getCost[57]}\"></td></tr>";

// ***************************** Add Extra 4 ********************************************//

if ($getQty[58] != '0.00') {
echo "<tr id=\"extra5\" style=\"display:table-row;\">";

echo "<td><input type=\"hidden\" name=\"id[58]\" value=\"{$getCFID[58]}\" /><select class=\"desclist\" name=\"desclist[]\" >"; 
		foreach($extras as $extra) {
      	echo "<option value=\"".$extra['cf_id']."\"";
		if($extra['cf_id'] == $getID[58]) {
		echo "selected=\"selected\""; 
		} else {echo "";}
		echo ">".$extra['description']."</option>";	
		}	
echo "</select>";
    
	  foreach($extras as $extra){
      if ($extra['cf_id'] == $getID[58]) {
	 
echo "<input type=\"hidden\" class=\"desc\" name=\"desc[58]\" value=\"".$extra['description']."\" readonly=\"readonly\" />".
     "<input type=\"hidden\" class=\"invent\" name=\"invent[58]\" value=\"".$extra['inventoryid']."\" readonly=\"readonly\" />".
     "<input type=\"hidden\" class=\"descrrp\" name=\"descrrp\" value=\"".$extra['rrp']."\" readonly=\"readonly\" />".
     "<input type=\"hidden\" class=\"desccost\" name=\"desccost\" value=\"".$extra['cost']."\" readonly=\"readonly\" />"; }
	 else {echo" ";}
	 }
}  else {echo "<tr id=\"extra5\" style=\"display:none;\">";

echo "<td><input type=\"hidden\" name=\"id[58]\" value=\"{$getCFID[58]}\" /><select class=\"desclist\" name=\"desclist[]\" >"; 
		foreach($extras as $extra) {
      	echo "<option value=\"".$extra['cf_id']."\"";
		if($extra['cf_id'] == $getID[58]) {
		echo "selected=\"selected\""; 
		} else {echo "";}
		echo ">".$extra['description']."</option>";	
		}	
echo "</select>";
    
	  foreach($extras as $extra){
     if ($extra['cf_id'] == $getID[58]) {
	 
echo "<input type=\"hidden\" class=\"desc\" name=\"desc[58]\" value=\"".$extra['description']."\" readonly=\"readonly\" />".
     "<input type=\"hidden\" class=\"invent\" name=\"invent[58]\" value=\"".$extra['inventoryid']."\" readonly=\"readonly\" />".
     "<input type=\"hidden\" class=\"descrrp\" name=\"descrrp\" value=\"".$extra['rrp']."\" readonly=\"readonly\" />".
     "<input type=\"hidden\" class=\"desccost\" name=\"desccost\" value=\"".$extra['cost']."\" readonly=\"readonly\" />"; }
	 else {echo" ";}
	 }
	 }
	 
	 echo "</td>";
// Webbing
echo"<td><input type=\"button\" value=\"Remove Extras\" onclick=\"hidextra5();\" id=\"removextra5\"><input type=\"hidden\" class=\"webbing\" name=\"webbing[58]\" value=\"\" readonly=\"readonly\" /></td>";

// Colours
echo"<td><input type=\"hidden\" class=\"colour\" name=\"colour[58]\" value=\"\" readonly=\"readonly\" /></td>";
     	
// Paint and Powder
echo"<td><input type=\"hidden\" name=\"paint[58]\" value=\"\" readonly=\"readonly\" /></td>";

// Unit of Measurement
echo "<td><input type=\"text\" name=\"uom[58]\" class=\"uom\" readonly=\"readonly\" value=\"{$getUOM[58]}\"></td>";

// Unit Quantity
echo "<td><input type=\"text\" id=\"addqty28\" name=\"qty[58]\" value=\"{$getQty[58]}\"></td>";

// Length or Width
if ($getID[58] == '76') {
echo "<td><input type=\"text\" class=\"xlength\" name=\"slength[58]\" value=\"{$getLength[58]}\"></td>"; }
else {
echo "<td><input type=\"text\" class=\"xlength\" name=\"slength[58]\" value=\"{$getLength[58]}\" style=\"display:none;\"></td>";}

// Total RRP
echo "<td><input type=\"text\" class=\"rrp\" readonly=\"readonly\" name=\"rrp[58]\" value=\"{$getRRP[58]}\"><input type=\"hidden\" class=\"cst\" name=\"cst[58]\" value=\"${getCost[58]}\"></td></tr>";

// ***************************** Add Extra 5 ********************************************//

if ($getQty[59] != '0.00') {
echo "<tr id=\"extra6\" style=\"display:table-row;\">";

echo "<td><input type=\"hidden\" name=\"id[59]\" value=\"{$getCFID[59]}\" /><select class=\"desclist\" name=\"desclist[]\" >"; 
		foreach($extras as $extra) {
      	echo "<option value=\"".$extra['cf_id']."\"";
		if($extra['cf_id'] == $getID[59]) {
		echo "selected=\"selected\""; 
		} else {echo "";}
		echo ">".$extra['description']."</option>";	
		}	
echo "</select>";
    
	  foreach($extras as $extra){
      if ($extra['cf_id'] == $getID[59]) {
	 
echo "<input type=\"hidden\" class=\"desc\" name=\"desc[59]\" value=\"".$extra['description']."\" readonly=\"readonly\" />".
     "<input type=\"hidden\" class=\"invent\" name=\"invent[59]\" value=\"".$extra['inventoryid']."\" readonly=\"readonly\" />".
     "<input type=\"hidden\" class=\"descrrp\" name=\"descrrp\" value=\"".$extra['rrp']."\" readonly=\"readonly\" />".
     "<input type=\"hidden\" class=\"desccost\" name=\"desccost\" value=\"".$extra['cost']."\" readonly=\"readonly\" />"; }
	 else {echo" ";}
	 }
}  else {echo "<tr id=\"extra6\" style=\"display:none;\">";

echo "<td><input type=\"hidden\" name=\"id[59]\" value=\"{$getCFID[59]}\" /><select class=\"desclist\" name=\"desclist[]\" >"; 
		foreach($extras as $extra) {
      	echo "<option value=\"".$extra['cf_id']."\"";
		if($extra['cf_id'] == $getID[59]) {
		echo "selected=\"selected\""; 
		} else {echo "";}
		echo ">".$extra['description']."</option>";	
		}	
echo "</select>";
    
	  foreach($extras as $extra){
     if ($extra['cf_id'] == $getID[59]) {
	 
echo "<input type=\"hidden\" class=\"desc\" name=\"desc[59]\" value=\"".$extra['description']."\" readonly=\"readonly\" />".
     "<input type=\"hidden\" class=\"invent\" name=\"invent[59]\" value=\"".$extra['inventoryid']."\" readonly=\"readonly\" />".
     "<input type=\"hidden\" class=\"descrrp\" name=\"descrrp\" value=\"".$extra['rrp']."\" readonly=\"readonly\" />".
     "<input type=\"hidden\" class=\"desccost\" name=\"desccost\" value=\"".$extra['cost']."\" readonly=\"readonly\" />"; }
	 else {echo" ";}
	 }
	 }
	 
	 echo "</td>";
// Webbing
echo"<td><input type=\"button\" value=\"Remove Extras\" onclick=\"hidextra6();\" id=\"removextra6\"><input type=\"hidden\" class=\"webbing\" name=\"webbing[59]\" value=\"\" readonly=\"readonly\" /></td>";

// Colours
echo"<td><input type=\"hidden\" class=\"colour\" name=\"colour[59]\" value=\"\" readonly=\"readonly\" /></td>";
     	
// Paint and Powder
echo"<td><input type=\"hidden\" name=\"paint[59]\" value=\"\" readonly=\"readonly\" /></td>";

// Unit of Measurement
echo "<td><input type=\"text\" name=\"uom[59]\" class=\"uom\" readonly=\"readonly\" value=\"{$getUOM[59]}\"></td>";

// Unit Quantity
echo "<td><input type=\"text\" id=\"addqty29\" name=\"qty[59]\" value=\"{$getQty[59]}\"></td>";

// Length or Width
if ($getID[59] == '76') {
echo "<td><input type=\"text\" class=\"xlength\" name=\"slength[59]\" value=\"{$getLength[59]}\"></td>"; }
else {
echo "<td><input type=\"text\" class=\"xlength\" name=\"slength[59]\" value=\"{$getLength[59]}\" style=\"display:none;\"></td>";}

// Total RRP
echo "<td><input type=\"text\" class=\"rrp\" readonly=\"readonly\" name=\"rrp[59]\" value=\"{$getRRP[59]}\"><input type=\"hidden\" class=\"cst\" name=\"cst[59]\" value=\"${getCost[59]}\"></td></tr>";

// ***************************** Add Extra 6 ********************************************//

if ($getQty[60] != '0.00') {
echo "<tr id=\"extra7\" style=\"display:table-row;\">";

echo "<td><input type=\"hidden\" name=\"id[60]\" value=\"{$getCFID[60]}\" /><select class=\"desclist\" name=\"desclist[]\" >"; 
		foreach($extras as $extra) {
      	echo "<option value=\"".$extra['cf_id']."\"";
		if($extra['cf_id'] == $getID[60]) {
		echo "selected=\"selected\""; 
		} else {echo "";}
		echo ">".$extra['description']."</option>";	
		}	
echo "</select>";
    
	  foreach($extras as $extra){
      if ($extra['cf_id'] == $getID[60]) {
	 
echo "<input type=\"hidden\" class=\"desc\" name=\"desc[60]\" value=\"".$extra['description']."\" readonly=\"readonly\" />".
     "<input type=\"hidden\" class=\"invent\" name=\"invent[60]\" value=\"".$extra['inventoryid']."\" readonly=\"readonly\" />".
     "<input type=\"hidden\" class=\"descrrp\" name=\"descrrp\" value=\"".$extra['rrp']."\" readonly=\"readonly\" />".
     "<input type=\"hidden\" class=\"desccost\" name=\"desccost\" value=\"".$extra['cost']."\" readonly=\"readonly\" />"; }
	 else {echo" ";}
	 }
}  else {echo "<tr id=\"extra7\" style=\"display:none;\">";

echo "<td><input type=\"hidden\" name=\"id[60]\" value=\"{$getCFID[60]}\" /><select class=\"desclist\" name=\"desclist[]\" >"; 
		foreach($extras as $extra) {
      	echo "<option value=\"".$extra['cf_id']."\"";
		if($extra['cf_id'] == $getID[60]) {
		echo "selected=\"selected\""; 
		} else {echo "";}
		echo ">".$extra['description']."</option>";	
		}	
echo "</select>";
    
	  foreach($extras as $extra){
     if ($extra['cf_id'] == $getID[60]) {
	 
echo "<input type=\"hidden\" class=\"desc\" name=\"desc[60]\" value=\"".$extra['description']."\" readonly=\"readonly\" />".
     "<input type=\"hidden\" class=\"invent\" name=\"invent[60]\" value=\"".$extra['inventoryid']."\" readonly=\"readonly\" />".
     "<input type=\"hidden\" class=\"descrrp\" name=\"descrrp\" value=\"".$extra['rrp']."\" readonly=\"readonly\" />".
     "<input type=\"hidden\" class=\"desccost\" name=\"desccost\" value=\"".$extra['cost']."\" readonly=\"readonly\" />"; }
	 else {echo" ";}
	 }
	 }
	 
	 echo "</td>";
// Webbing
echo"<td><input type=\"button\" value=\"Remove Extras\" onclick=\"hidextra7();\" id=\"removextra7\"><input type=\"hidden\" class=\"webbing\" name=\"webbing[60]\" value=\"\" readonly=\"readonly\" /></td>";

// Colours
echo"<td><input type=\"hidden\" class=\"colour\" name=\"colour[60]\" value=\"\" readonly=\"readonly\" /></td>";
     	
// Paint and Powder
echo"<td><input type=\"hidden\" name=\"paint[60]\" value=\"\" readonly=\"readonly\" /></td>";

// Unit of Measurement
echo "<td><input type=\"text\" name=\"uom[60]\" class=\"uom\" readonly=\"readonly\" value=\"{$getUOM[60]}\"></td>";

// Unit Quantity
echo "<td><input type=\"text\" id=\"addqty30\" name=\"qty[60]\" value=\"{$getQty[60]}\"></td>";

// Length or Width
if ($getID[60] == '76') {
echo "<td><input type=\"text\" class=\"xlength\" name=\"slength[60]\" value=\"{$getLength[60]}\"></td>"; }
else {
echo "<td><input type=\"text\" class=\"xlength\" name=\"slength[60]\" value=\"{$getLength[60]}\" style=\"display:none;\"></td>";}

// Total RRP
echo "<td><input type=\"text\" class=\"rrp\" readonly=\"readonly\" name=\"rrp[60]\" value=\"{$getRRP[60]}\"><input type=\"hidden\" class=\"cst\" name=\"cst[60]\" value=\"${getCost[60]}\"></td></tr>";


// ***************************** Add Extra 7 ********************************************//

if ($getQty[61] != '0.00') {
echo "<tr id=\"extra8\" style=\"display:table-row;\">";

echo "<td><input type=\"hidden\" name=\"id[61]\" value=\"{$getCFID[61]}\" /><select class=\"desclist\" name=\"desclist[]\" >"; 
		foreach($extras as $extra) {
      	echo "<option value=\"".$extra['cf_id']."\"";
		if($extra['cf_id'] == $getID[61]) {
		echo "selected=\"selected\""; 
		} else {echo "";}
		echo ">".$extra['description']."</option>";	
		}	
echo "</select>";
    
	  foreach($extras as $extra){
      if ($extra['cf_id'] == $getID[61]) {
	 
echo "<input type=\"hidden\" class=\"desc\" name=\"desc[61]\" value=\"".$extra['description']."\" readonly=\"readonly\" />".
     "<input type=\"hidden\" class=\"invent\" name=\"invent[61]\" value=\"".$extra['inventoryid']."\" readonly=\"readonly\" />".
     "<input type=\"hidden\" class=\"descrrp\" name=\"descrrp\" value=\"".$extra['rrp']."\" readonly=\"readonly\" />".
     "<input type=\"hidden\" class=\"desccost\" name=\"desccost\" value=\"".$extra['cost']."\" readonly=\"readonly\" />"; }
	 else {echo" ";}
	 }
}  else {echo "<tr id=\"extra8\" style=\"display:none;\">";

echo "<td><input type=\"hidden\" name=\"id[61]\" value=\"{$getCFID[61]}\" /><select class=\"desclist\" name=\"desclist[]\" >"; 
		foreach($extras as $extra) {
      	echo "<option value=\"".$extra['cf_id']."\"";
		if($extra['cf_id'] == $getID[61]) {
		echo "selected=\"selected\""; 
		} else {echo "";}
		echo ">".$extra['description']."</option>";	
		}	
echo "</select>";
    
	  foreach($extras as $extra){
     if ($extra['cf_id'] == $getID[61]) {
	 
echo "<input type=\"hidden\" class=\"desc\" name=\"desc[61]\" value=\"".$extra['description']."\" readonly=\"readonly\" />".
     "<input type=\"hidden\" class=\"invent\" name=\"invent[61]\" value=\"".$extra['inventoryid']."\" readonly=\"readonly\" />".
     "<input type=\"hidden\" class=\"descrrp\" name=\"descrrp\" value=\"".$extra['rrp']."\" readonly=\"readonly\" />".
     "<input type=\"hidden\" class=\"desccost\" name=\"desccost\" value=\"".$extra['cost']."\" readonly=\"readonly\" />"; }
	 else {echo" ";}
	 }
	 }
	 
	 echo "</td>";
// Webbing
echo"<td><input type=\"button\" value=\"Remove Extras\" onclick=\"hidextra8();\" id=\"removextra8\"><input type=\"hidden\" class=\"webbing\" name=\"webbing[61]\" value=\"\" readonly=\"readonly\" /></td>";

// Colours
echo"<td><input type=\"hidden\" class=\"colour\" name=\"colour[61]\" value=\"\" readonly=\"readonly\" /></td>";
     	
// Paint and Powder
echo"<td><input type=\"hidden\" name=\"paint[61]\" value=\"\" readonly=\"readonly\" /></td>";

// Unit of Measurement
echo "<td><input type=\"text\" name=\"uom[61]\" class=\"uom\" readonly=\"readonly\" value=\"{$getUOM[61]}\"></td>";

// Unit Quantity
echo "<td><input type=\"text\" id=\"addqty31\" name=\"qty[61]\" value=\"{$getQty[61]}\"></td>";

// Length or Width
if ($getID[61] == '76') {
echo "<td><input type=\"text\" class=\"xlength\" name=\"slength[61]\" value=\"{$getLength[61]}\"></td>"; }
else {
echo "<td><input type=\"text\" class=\"xlength\" name=\"slength[61]\" value=\"{$getLength[61]}\" style=\"display:none;\"></td>";}

// Total RRP
echo "<td><input type=\"text\" class=\"rrp\" readonly=\"readonly\" name=\"rrp[61]\" value=\"{$getRRP[61]}\"><input type=\"hidden\" class=\"cst\" name=\"cst[61]\" value=\"${getCost[61]}\"></td></tr>";

// ***************************** Add Extra 8 ********************************************//

if ($getQty[62] != '0.00') {
echo "<tr id=\"extra9\" style=\"display:table-row;\">";

echo "<td><input type=\"hidden\" name=\"id[62]\" value=\"{$getCFID[62]}\" /><select class=\"desclist\" name=\"desclist[]\" >"; 
		foreach($extras as $extra) {
      	echo "<option value=\"".$extra['cf_id']."\"";
		if($extra['cf_id'] == $getID[62]) {
		echo "selected=\"selected\""; 
		} else {echo "";}
		echo ">".$extra['description']."</option>";	
		}	
echo "</select>";
    
	  foreach($extras as $extra){
      if ($extra['cf_id'] == $getID[62]) {
	 
echo "<input type=\"hidden\" class=\"desc\" name=\"desc[62]\" value=\"".$extra['description']."\" readonly=\"readonly\" />".
     "<input type=\"hidden\" class=\"invent\" name=\"invent[62]\" value=\"".$extra['inventoryid']."\" readonly=\"readonly\" />".
     "<input type=\"hidden\" class=\"descrrp\" name=\"descrrp\" value=\"".$extra['rrp']."\" readonly=\"readonly\" />".
     "<input type=\"hidden\" class=\"desccost\" name=\"desccost\" value=\"".$extra['cost']."\" readonly=\"readonly\" />"; }
	 else {echo" ";}
	 }
}  else {echo "<tr id=\"extra9\" style=\"display:none;\">";

echo "<td><input type=\"hidden\" name=\"id[62]\" value=\"{$getCFID[62]}\" /><select class=\"desclist\" name=\"desclist[]\" >"; 
		foreach($extras as $extra) {
      	echo "<option value=\"".$extra['cf_id']."\"";
		if($extra['cf_id'] == $getID[62]) {
		echo "selected=\"selected\""; 
		} else {echo "";}
		echo ">".$extra['description']."</option>";	
		}	
echo "</select>";
    
	  foreach($extras as $extra){
     if ($extra['cf_id'] == $getID[62]) {
	 
echo "<input type=\"hidden\" class=\"desc\" name=\"desc[62]\" value=\"".$extra['description']."\" readonly=\"readonly\" />".
     "<input type=\"hidden\" class=\"invent\" name=\"invent[62]\" value=\"".$extra['inventoryid']."\" readonly=\"readonly\" />".
     "<input type=\"hidden\" class=\"descrrp\" name=\"descrrp\" value=\"".$extra['rrp']."\" readonly=\"readonly\" />".
     "<input type=\"hidden\" class=\"desccost\" name=\"desccost\" value=\"".$extra['cost']."\" readonly=\"readonly\" />"; }
	 else {echo" ";}
	 }
	 }
	 
	 echo "</td>";
// Webbing
echo"<td><input type=\"button\" value=\"Remove Extras\" onclick=\"hidextra9();\" id=\"removextra9\"><input type=\"hidden\" class=\"webbing\" name=\"webbing[62]\" value=\"\" readonly=\"readonly\" /></td>";

// Colours
echo"<td><input type=\"hidden\" class=\"colour\" name=\"colour[62]\" value=\"\" readonly=\"readonly\" /></td>";
     	
// Paint and Powder
echo"<td><input type=\"hidden\" name=\"paint[62]\" value=\"\" readonly=\"readonly\" /></td>";

// Unit of Measurement
echo "<td><input type=\"text\" name=\"uom[62]\" class=\"uom\" readonly=\"readonly\" value=\"{$getUOM[62]}\"></td>";

// Unit Quantity
echo "<td><input type=\"text\" id=\"addqty32\" name=\"qty[62]\" value=\"{$getQty[62]}\"></td>";

// Length or Width
if ($getID[62] == '76') {
echo "<td><input type=\"text\" class=\"xlength\" name=\"slength[62]\" value=\"{$getLength[62]}\"></td>"; }
else {
echo "<td><input type=\"text\" class=\"xlength\" name=\"slength[62]\" value=\"{$getLength[62]}\" style=\"display:none;\"></td>";}

// Total RRP
echo "<td><input type=\"text\" class=\"rrp\" readonly=\"readonly\" name=\"rrp[62]\" value=\"{$getRRP[62]}\"><input type=\"hidden\" class=\"cst\" name=\"cst[62]\" value=\"${getCost[62]}\"></td></tr>";

// ***************************** Add Extra 9 ********************************************//

if ($getQty[63] != '0.00') {
echo "<tr id=\"extra10\" style=\"display:table-row;\">";

echo "<td><input type=\"hidden\" name=\"id[63]\" value=\"{$getCFID[63]}\" /><select class=\"desclist\" name=\"desclist[]\" >"; 
		foreach($extras as $extra) {
      	echo "<option value=\"".$extra['cf_id']."\"";
		if($extra['cf_id'] == $getID[63]) {
		echo "selected=\"selected\""; 
		} else {echo "";}
		echo ">".$extra['description']."</option>";	
		}	
echo "</select>";
    
	  foreach($extras as $extra){
      if ($extra['cf_id'] == $getID[63]) {
	 
echo "<input type=\"hidden\" class=\"desc\" name=\"desc[63]\" value=\"".$extra['description']."\" readonly=\"readonly\" />".
     "<input type=\"hidden\" class=\"invent\" name=\"invent[63]\" value=\"".$extra['inventoryid']."\" readonly=\"readonly\" />".
     "<input type=\"hidden\" class=\"descrrp\" name=\"descrrp\" value=\"".$extra['rrp']."\" readonly=\"readonly\" />".
     "<input type=\"hidden\" class=\"desccost\" name=\"desccost\" value=\"".$extra['cost']."\" readonly=\"readonly\" />"; }
	 else {echo" ";}
	 }
}  else {echo "<tr id=\"extra10\" style=\"display:none;\">";

echo "<td><input type=\"hidden\" name=\"id[63]\" value=\"{$getCFID[63]}\" /><select class=\"desclist\" name=\"desclist[]\" >"; 
		foreach($extras as $extra) {
      	echo "<option value=\"".$extra['cf_id']."\"";
		if($extra['cf_id'] == $getID[63]) {
		echo "selected=\"selected\""; 
		} else {echo "";}
		echo ">".$extra['description']."</option>";	
		}	
echo "</select>";
    
	  foreach($extras as $extra){
     if ($extra['cf_id'] == $getID[63]) {
	 
echo "<input type=\"hidden\" class=\"desc\" name=\"desc[63]\" value=\"".$extra['description']."\" readonly=\"readonly\" />".
     "<input type=\"hidden\" class=\"invent\" name=\"invent[63]\" value=\"".$extra['inventoryid']."\" readonly=\"readonly\" />".
     "<input type=\"hidden\" class=\"descrrp\" name=\"descrrp\" value=\"".$extra['rrp']."\" readonly=\"readonly\" />".
     "<input type=\"hidden\" class=\"desccost\" name=\"desccost\" value=\"".$extra['cost']."\" readonly=\"readonly\" />"; }
	 else {echo" ";}
	 }
	 }
	 
	 echo "</td>";
// Webbing
echo"<td><input type=\"button\" value=\"Remove Extras\" onclick=\"hidextra10();\" id=\"removextra10\"><input type=\"hidden\" class=\"webbing\" name=\"webbing[63]\" value=\"\" readonly=\"readonly\" /></td>";

// Colours
echo"<td><input type=\"hidden\" class=\"colour\" name=\"colour[63]\" value=\"\" readonly=\"readonly\" /></td>";
     	
// Paint and Powder
echo"<td><input type=\"hidden\" name=\"paint[63]\" value=\"\" readonly=\"readonly\" /></td>";

// Unit of Measurement
echo "<td><input type=\"text\" name=\"uom[63]\" class=\"uom\" readonly=\"readonly\" value=\"{$getUOM[63]}\"></td>";

// Unit Quantity
echo "<td><input type=\"text\" id=\"addqty33\" name=\"qty[63]\" value=\"{$getQty[63]}\"></td>";

// Length or Width
if ($getID[63] == '76') {
echo "<td><input type=\"text\" class=\"xlength\" name=\"slength[63]\" value=\"{$getLength[63]}\"></td>"; }
else {
echo "<td><input type=\"text\" class=\"xlength\" name=\"slength[63]\" value=\"{$getLength[63]}\" style=\"display:none;\"></td>";}

// Total RRP
echo "<td><input type=\"text\" class=\"rrp\" readonly=\"readonly\" name=\"rrp[63]\" value=\"{$getRRP[63]}\"><input type=\"hidden\" class=\"cst\" name=\"cst[63]\" value=\"${getCost[63]}\"></td></tr>";

// ***************************** Add Extra 10 ********************************************//

if ($getQty[64] != '0.00') {
echo "<tr id=\"extra11\" style=\"display:table-row;\">";

echo "<td><input type=\"hidden\" name=\"id[64]\" value=\"{$getCFID[64]}\" /><select class=\"desclist\" name=\"desclist[]\" >"; 
		foreach($extras as $extra) {
      	echo "<option value=\"".$extra['cf_id']."\"";
		if($extra['cf_id'] == $getID[64]) {
		echo "selected=\"selected\""; 
		} else {echo "";}
		echo ">".$extra['description']."</option>";	
		}	
echo "</select>";
    
	  foreach($extras as $extra){
      if ($extra['cf_id'] == $getID[64]) {
	 
echo "<input type=\"hidden\" class=\"desc\" name=\"desc[64]\" value=\"".$extra['description']."\" readonly=\"readonly\" />".
     "<input type=\"hidden\" class=\"invent\" name=\"invent[64]\" value=\"".$extra['inventoryid']."\" readonly=\"readonly\" />".
     "<input type=\"hidden\" class=\"descrrp\" name=\"descrrp\" value=\"".$extra['rrp']."\" readonly=\"readonly\" />".
     "<input type=\"hidden\" class=\"desccost\" name=\"desccost\" value=\"".$extra['cost']."\" readonly=\"readonly\" />"; }
	 else {echo" ";}
	 }
}  else {echo "<tr id=\"extra11\" style=\"display:none;\">";

echo "<td><input type=\"hidden\" name=\"id[64]\" value=\"{$getCFID[64]}\" /><select class=\"desclist\" name=\"desclist[]\" >"; 
		foreach($extras as $extra) {
      	echo "<option value=\"".$extra['cf_id']."\"";
		if($extra['cf_id'] == $getID[64]) {
		echo "selected=\"selected\""; 
		} else {echo "";}
		echo ">".$extra['description']."</option>";	
		}	
echo "</select>";
    
	  foreach($extras as $extra){
     if ($extra['cf_id'] == $getID[64]) {
	 
echo "<input type=\"hidden\" class=\"desc\" name=\"desc[64]\" value=\"".$extra['description']."\" readonly=\"readonly\" />".
     "<input type=\"hidden\" class=\"invent\" name=\"invent[64]\" value=\"".$extra['inventoryid']."\" readonly=\"readonly\" />".
     "<input type=\"hidden\" class=\"descrrp\" name=\"descrrp\" value=\"".$extra['rrp']."\" readonly=\"readonly\" />".
     "<input type=\"hidden\" class=\"desccost\" name=\"desccost\" value=\"".$extra['cost']."\" readonly=\"readonly\" />"; }
	 else {echo" ";}
	 }
	 }
	 
	 echo "</td>";
// Webbing
echo"<td><input type=\"button\" value=\"Remove Extras\" onclick=\"hidextra11();\" id=\"removextra11\"><input type=\"hidden\" class=\"webbing\" name=\"webbing[64]\" value=\"\" readonly=\"readonly\" /></td>";

// Colours
echo"<td><input type=\"hidden\" class=\"colour\" name=\"colour[64]\" value=\"\" readonly=\"readonly\" /></td>";
     	
// Paint and Powder
echo"<td><input type=\"hidden\" name=\"paint[64]\" value=\"\" readonly=\"readonly\" /></td>";

// Unit of Measurement
echo "<td><input type=\"text\" name=\"uom[64]\" class=\"uom\" readonly=\"readonly\" value=\"{$getUOM[64]}\"></td>";

// Unit Quantity
echo "<td><input type=\"text\" id=\"addqty34\" name=\"qty[64]\" value=\"{$getQty[64]}\"></td>";

// Length or Width
if ($getID[64] == '76') {
echo "<td><input type=\"text\" class=\"xlength\" name=\"slength[64]\" value=\"{$getLength[64]}\"></td>"; }
else {
echo "<td><input type=\"text\" class=\"xlength\" name=\"slength[64]\" value=\"{$getLength[64]}\" style=\"display:none;\"></td>";}

// Total RRP
echo "<td><input type=\"text\" class=\"rrp\" readonly=\"readonly\" name=\"rrp[64]\" value=\"{$getRRP[64]}\"><input type=\"hidden\" class=\"cst\" name=\"cst[64]\" value=\"${getCost[64]}\"></td></tr>";

/****************************************************************** Add Extra Show *****************************************************************/
?>