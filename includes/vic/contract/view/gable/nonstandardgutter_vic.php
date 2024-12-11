<?php
// ***************************** First Non-Standard Vergola Gutter Lip Out 225 x 225 ********************************************//
if ($getQty[24] != '0.00') {
echo "<tr id=\"nonstdgutter1\" style=\"display: table-row;\"><td><input type=\"hidden\" name=\"id[24]\" value=\"{$getCFID[24]}\" /><select class=\"desclist\" name=\"desclist[]\" >";
        $nongutters = array();
		while ($nongutter = mysql_fetch_array($resultnonstdgutter)) {
		$nongutters[] = $nongutter;
		$heading = isset($nongutter[0]) ? $nongutter[0] : null;
        $BeamIDArrayPhp .= isset($nongutter[1]) ? 'BeamIDArray["'.$heading.'"]="'.$nongutter[1].'";' : null;	
        $BeamDESCArrayPhp .= isset($nongutter[2]) ? 'BeamDESCArray["'.$heading.'"]="'.$nongutter[2].'";' : null;
        $BeamRRPArrayPhp .= isset($nongutter[4]) ? 'BeamRRPArray["'.$heading.'"]="'.$nongutter[4].'";' : null;
        $BeamCOSTArrayPhp .= isset($nongutter[5]) ? 'BeamCOSTArray["'.$heading.'"]="'.$nongutter[5].'";' : null;
		$BeamUOMArrayPhp .= isset($nongutter[3]) ? 'BeamUOMArray["'.$heading.'"]="'.$nongutter[3].'";' : null;
		}
		
		foreach($nongutters as $nongutter) {
      	echo "<option value=\"".$nongutter['cf_id']."\"";
		if($nongutter['cf_id'] == $getID[24]) { 
		echo "selected=\"selected\""; 
		} else {echo "";}
		echo ">".$nongutter['description']."</option>";	
		}
		
echo "</select>";
    
	 foreach($nongutters as $nongutter) {
	 if ($nongutter['cf_id'] == $getID[24]) { 
	 
echo "<input type=\"hidden\" class=\"desc\" name=\"desc[24]\" value=\"".$nongutter['description']."\" readonly=\"readonly\" />".
     "<input type=\"hidden\" class=\"invent\" name=\"invent[24]\" value=\"".$nongutter['inventoryid']."\" readonly=\"readonly\" />".
     "<input type=\"hidden\" class=\"descrrp\" name=\"descrrp\" value=\"".$nongutter['rrp']."\" readonly=\"readonly\" />".
     "<input type=\"hidden\" class=\"desccost\" name=\"desccost\" value=\"".$nongutter['cost']."\" readonly=\"readonly\" />";
	 }
	else { echo "";}
	 }
	echo "</td>";
}
else {echo "<tr id=\"nonstdgutter1\" style=\"display: none;\"><td><input type=\"hidden\" name=\"id[24]\" value=\"{$getCFID[24]}\" /><select class=\"desclist\" name=\"desclist[]\" >";
        $nongutters = array();
		while ($nongutter = mysql_fetch_array($resultnonstdgutter)) {
		$nongutters[] = $nongutter;
		$heading = isset($nongutter[0]) ? $nongutter[0] : null;
        $BeamIDArrayPhp .= isset($nongutter[1]) ? 'BeamIDArray["'.$heading.'"]="'.$nongutter[1].'";' : null;	
        $BeamDESCArrayPhp .= isset($nongutter[2]) ? 'BeamDESCArray["'.$heading.'"]="'.$nongutter[2].'";' : null;
        $BeamRRPArrayPhp .= isset($nongutter[4]) ? 'BeamRRPArray["'.$heading.'"]="'.$nongutter[4].'";' : null;
        $BeamCOSTArrayPhp .= isset($nongutter[5]) ? 'BeamCOSTArray["'.$heading.'"]="'.$nongutter[5].'";' : null;
		$BeamUOMArrayPhp .= isset($nongutter[3]) ? 'BeamUOMArray["'.$heading.'"]="'.$nongutter[3].'";' : null;
		}
        foreach($nongutters as $nongutter) {
      	echo "<option value=\"".$nongutter['cf_id']."\"";
		if($nongutter['cf_id'] == $getID[24]){ 
		echo "selected=\"selected\""; 
		} else {echo "";}
		echo ">".$nongutter['description']."</option>";	
		}
		
echo "</select>";
    
	 foreach($nongutters as $nongutter){
	 if ($nongutter['cf_id'] == $getID[24]) { 
	 
echo "<input type=\"hidden\" class=\"desc\" name=\"desc[24]\" value=\"".$nongutter['description']."\" readonly=\"readonly\" />".
     "<input type=\"hidden\" class=\"invent\" name=\"invent[24]\" value=\"".$nongutter['inventoryid']."\" readonly=\"readonly\" />".
     "<input type=\"hidden\" class=\"descrrp\" name=\"descrrp\" value=\"".$nongutter['rrp']."\" readonly=\"readonly\" />".
     "<input type=\"hidden\" class=\"desccost\" name=\"desccost\" value=\"".$nongutter['cost']."\" readonly=\"readonly\" />";
	 }
	else { echo "";}
	 }
	echo "</td>";

}

// Webbing
echo"<td><input id=\"removenonstd1\" onClick=\"hidenonstd1();\" type=\"button\" value=\"Remove Gutter\" /><input type=\"hidden\" class=\"webbing\" name=\"webbing[24]\" value=\"\" readonly=\"readonly\" /></td>";

// Colours
echo "<td><select name=\"colour[24]\">";
        foreach($colours as $colour){
      	echo "<option value=\"".$colour."\"";
		if($colour == $getColour[24]){echo "selected=\"selected\""; 
		} else {echo "";}
		echo ">".$colour."</option>";
		}	 	
echo"</select></td>";

// Paint and Powder
echo "<td><select class=\"paint-list\" name=\"paintselect\" >";  
	    foreach($paints as $paint){
      	echo "<option value=\"".$paint['cf_id']."\""; 
		if($paint['category'] == $getFinish[24]){ echo "selected=\"selected\"";
		} else {echo "";}
		echo">".$paint['category']."</option>";	
		}
echo "</select>";
foreach($paints as $paint){
if($paint['category'] == $getFinish[24]){
echo "<input type=\"hidden\" class=\"paintdesc\" name=\"paint[24]\" value=\"".$paint['category']."\" readonly=\"readonly\" />".
     "<input type=\"hidden\" class=\"paintrrp\" name=\"paintrrp[]\" value=\"".$paint['rrp']."\" readonly=\"readonly\" />".
     "<input type=\"hidden\" class=\"paintcost\" name=\"paintcost[]\" value=\"".$paint['cost']."\" readonly=\"readonly\" />";
} else {echo "";}
}
	 echo "</td>";

// Unit of Measurement
echo "<td><input type=\"text\" class=\"uom\" name=\"uom[24]\" readonly=\"readonly\" value=\"{$getUOM[24]}\"></td>";

 // Unit Quantity
echo "<td><input type=\"text\" id=\"addqty15\" name=\"qty[24]\" value=\"{$getQty[24]}\"></td>";

// Length or Width
if ($getID[24] == '37') {
echo "<td><input type=\"text\" class=\"xlength\" name=\"slength[24]\" value=\"{$getLength[24]}\" style=\"display:none;\"></td>";}
else {echo "<td><input type=\"text\" class=\"xlength\" name=\"slength[24]\" value=\"{$getLength[24]}\"></td>";}

// Total RRP
echo "<td><input type=\"text\" class=\"rrp\" readonly=\"readonly\" name=\"rrp[24]\" value=\"{$getRRP[24]}\"><input type=\"hidden\" class=\"cst\" name=\"cst[24]\" value=\"{$getCost[24]}\"></td></tr>";

// ***************************** Second Non-Standard Vergola Tapered Gutter Lip Out 200 x 225 ********************************************//
if ($getQty[25] != '0.00') {
echo "<tr id=\"nonstdgutter2\" style=\"display: table-row;\"><td><input type=\"hidden\" name=\"id[25]\" value=\"{$getCFID[25]}\" /><select class=\"desclist\" name=\"desclist[]\" >";
      
		foreach($nongutters as $nongutter) {
      	echo "<option value=\"".$nongutter['cf_id']."\"";
		if($nongutter['cf_id'] == $getID[25]) { 
		echo "selected=\"selected\""; 
		} else {echo "";}
		echo ">".$nongutter['description']."</option>";	
		}
		
echo "</select>";
    
	 foreach($nongutters as $nongutter) {
	 if ($nongutter['cf_id'] == $getID[25]) { 
	 
echo "<input type=\"hidden\" class=\"desc\" name=\"desc[25]\" value=\"".$nongutter['description']."\" readonly=\"readonly\" />".
     "<input type=\"hidden\" class=\"invent\" name=\"invent[25]\" value=\"".$nongutter['inventoryid']."\" readonly=\"readonly\" />".
     "<input type=\"hidden\" class=\"descrrp\" name=\"descrrp\" value=\"".$nongutter['rrp']."\" readonly=\"readonly\" />".
     "<input type=\"hidden\" class=\"desccost\" name=\"desccost\" value=\"".$nongutter['cost']."\" readonly=\"readonly\" />";
	 }
	else { echo "";}
	 }
	echo "</td>";
}
else {echo "<tr id=\"nonstdgutter2\" style=\"display: none;\"><td><input type=\"hidden\" name=\"id[25]\" value=\"{$getCFID[25]}\" /><select class=\"desclist\" name=\"desclist[]\" >";
        foreach($nongutters as $nongutter) {
      	echo "<option value=\"".$nongutter['cf_id']."\"";
		if($nongutter['cf_id'] == $getID[25]){ 
		echo "selected=\"selected\""; 
		} else {echo "";}
		echo ">".$nongutter['description']."</option>";	
		}
		
echo "</select>";
    
	 foreach($nongutters as $nongutter){
	 if ($nongutter['cf_id'] == $getID[25]) { 
	 
echo "<input type=\"hidden\" class=\"desc\" name=\"desc[25]\" value=\"".$nongutter['description']."\" readonly=\"readonly\" />".
     "<input type=\"hidden\" class=\"invent\" name=\"invent[25]\" value=\"".$nongutter['inventoryid']."\" readonly=\"readonly\" />".
     "<input type=\"hidden\" class=\"descrrp\" name=\"descrrp\" value=\"".$nongutter['rrp']."\" readonly=\"readonly\" />".
     "<input type=\"hidden\" class=\"desccost\" name=\"desccost\" value=\"".$nongutter['cost']."\" readonly=\"readonly\" />";
	 }
	else { echo "";}
	 }
	echo "</td>";

}

// Webbing
echo"<td><input id=\"removenonstd2\" onClick=\"hidenonstd2();\" type=\"button\" value=\"Remove Gutter\" /><input type=\"hidden\" class=\"webbing\" name=\"webbing[25]\" value=\"\" readonly=\"readonly\" /></td>";

// Colours
echo "<td><select name=\"colour[25]\">";
        foreach($colours as $colour){
      	echo "<option value=\"".$colour."\"";
		if($colour == $getColour[25]){echo "selected=\"selected\""; 
		} else {echo "";}
		echo ">".$colour."</option>";
		}	 	
echo"</select></td>";

// Paint and Powder
echo "<td><select class=\"paint-list\" name=\"paintselect\" >";  
	    foreach($paints as $paint){
      	echo "<option value=\"".$paint['cf_id']."\""; 
		if($paint['category'] == $getFinish[25]){ echo "selected=\"selected\"";
		} else {echo "";}
		echo">".$paint['category']."</option>";	
		}
echo "</select>";
foreach($paints as $paint){
if($paint['category'] == $getFinish[25]){
echo "<input type=\"hidden\" class=\"paintdesc\" name=\"paint[25]\" value=\"".$paint['category']."\" readonly=\"readonly\" />".
     "<input type=\"hidden\" class=\"paintrrp\" name=\"paintrrp[]\" value=\"".$paint['rrp']."\" readonly=\"readonly\" />".
     "<input type=\"hidden\" class=\"paintcost\" name=\"paintcost[]\" value=\"".$paint['cost']."\" readonly=\"readonly\" />";
} else {echo "";}
}
	 echo "</td>";

// Unit of Measurement
echo "<td><input type=\"text\" class=\"uom\" name=\"uom[25]\" readonly=\"readonly\" value=\"{$getUOM[25]}\"></td>";

 // Unit Quantity
echo "<td><input type=\"text\" id=\"addqty16\" name=\"qty[25]\" value=\"{$getQty[25]}\"></td>";

// Length or Width
if ($getID[25] == '37') {
echo "<td><input type=\"text\" class=\"xlength\" name=\"slength[25]\" value=\"{$getLength[25]}\" style=\"display:none;\"></td>";}
else {echo "<td><input type=\"text\" class=\"xlength\" name=\"slength[25]\" value=\"{$getLength[25]}\"></td>";}

// Total RRP
echo "<td><input type=\"text\" class=\"rrp\" readonly=\"readonly\" name=\"rrp[25]\" value=\"{$getRRP[25]}\"><input type=\"hidden\" class=\"cst\" name=\"cst[25]\" value=\"{$getCost[25]}\"></td></tr>";
// ***************************** Third Non Standard Vergola Tappered Gutter Lip Out 225 x 250 ********************************************//
if ($getQty[26] != '0.00') {
echo "<tr id=\"nonstdgutter3\" style=\"display: table-row;\"><td><input type=\"hidden\" name=\"id[26]\" value=\"{$getCFID[26]}\" /><select class=\"desclist\" name=\"desclist[]\" >";
      
		foreach($nongutters as $nongutter) {
      	echo "<option value=\"".$nongutter['cf_id']."\"";
		if($nongutter['cf_id'] == $getID[26]) { 
		echo "selected=\"selected\""; 
		} else {echo "";}
		echo ">".$nongutter['description']."</option>";	
		}
		
echo "</select>";
    
	 foreach($nongutters as $nongutter) {
	 if ($nongutter['cf_id'] == $getID[26]) { 
	 
echo "<input type=\"hidden\" class=\"desc\" name=\"desc[26]\" value=\"".$nongutter['description']."\" readonly=\"readonly\" />".
     "<input type=\"hidden\" class=\"invent\" name=\"invent[26]\" value=\"".$nongutter['inventoryid']."\" readonly=\"readonly\" />".
     "<input type=\"hidden\" class=\"descrrp\" name=\"descrrp\" value=\"".$nongutter['rrp']."\" readonly=\"readonly\" />".
     "<input type=\"hidden\" class=\"desccost\" name=\"desccost\" value=\"".$nongutter['cost']."\" readonly=\"readonly\" />";
	 }
	else { echo "";}
	 }
	echo "</td>";
}
else {echo "<tr id=\"nonstdgutter3\" style=\"display: none;\"><td><input type=\"hidden\" name=\"id[26]\" value=\"{$getCFID[26]}\" /><select class=\"desclist\" name=\"desclist[]\" >";
        foreach($nongutters as $nongutter) {
      	echo "<option value=\"".$nongutter['cf_id']."\"";
		if($nongutter['cf_id'] == $getID[26]){ 
		echo "selected=\"selected\""; 
		} else {echo "";}
		echo ">".$nongutter['description']."</option>";	
		}
		
echo "</select>";
    
	 foreach($nongutters as $nongutter){
	 if ($nongutter['cf_id'] == $getID[26]) { 
	 
echo "<input type=\"hidden\" class=\"desc\" name=\"desc[26]\" value=\"".$nongutter['description']."\" readonly=\"readonly\" />".
     "<input type=\"hidden\" class=\"invent\" name=\"invent[26]\" value=\"".$nongutter['inventoryid']."\" readonly=\"readonly\" />".
     "<input type=\"hidden\" class=\"descrrp\" name=\"descrrp\" value=\"".$nongutter['rrp']."\" readonly=\"readonly\" />".
     "<input type=\"hidden\" class=\"desccost\" name=\"desccost\" value=\"".$nongutter['cost']."\" readonly=\"readonly\" />";
	 }
	else { echo "";}
	 }
	echo "</td>";

}

// Webbing
echo"<td><input id=\"removenonstd3\" onClick=\"hidenonstd3();\" type=\"button\" value=\"Remove Gutter\" /><input type=\"hidden\" class=\"webbing\" name=\"webbing[26]\" value=\"\" readonly=\"readonly\" /></td>";

// Colours
echo "<td><select name=\"colour[26]\">";
        foreach($colours as $colour){
      	echo "<option value=\"".$colour."\"";
		if($colour == $getColour[26]){echo "selected=\"selected\""; 
		} else {echo "";}
		echo ">".$colour."</option>";
		}	 	
echo"</select></td>";

// Paint and Powder
echo "<td><select class=\"paint-list\" name=\"paintselect\" >";  
	    foreach($paints as $paint){
      	echo "<option value=\"".$paint['cf_id']."\""; 
		if($paint['category'] == $getFinish[26]){ echo "selected=\"selected\"";
		} else {echo "";}
		echo">".$paint['category']."</option>";	
		}
echo "</select>";
foreach($paints as $paint){
if($paint['category'] == $getFinish[26]){
echo "<input type=\"hidden\" class=\"paintdesc\" name=\"paint[26]\" value=\"".$paint['category']."\" readonly=\"readonly\" />".
     "<input type=\"hidden\" class=\"paintrrp\" name=\"paintrrp[]\" value=\"".$paint['rrp']."\" readonly=\"readonly\" />".
     "<input type=\"hidden\" class=\"paintcost\" name=\"paintcost[]\" value=\"".$paint['cost']."\" readonly=\"readonly\" />";
} else {echo "";}
}
	 echo "</td>";

// Unit of Measurement
echo "<td><input type=\"text\" class=\"uom\" name=\"uom[26]\" readonly=\"readonly\" value=\"{$getUOM[26]}\"></td>";

 // Unit Quantity
echo "<td><input type=\"text\" id=\"addqty17\" name=\"qty[26]\" value=\"{$getQty[26]}\"></td>";

// Length or Width
if ($getID[26] == '37') {
echo "<td><input type=\"text\" class=\"xlength\" name=\"slength[26]\" value=\"{$getLength[26]}\" style=\"display:none;\"></td>";}
else {echo "<td><input type=\"text\" class=\"xlength\" name=\"slength[26]\" value=\"{$getLength[26]}\"></td>";}

// Total RRP
echo "<td><input type=\"text\" class=\"rrp\" readonly=\"readonly\" name=\"rrp[26]\" value=\"{$getRRP[26]}\"><input type=\"hidden\" class=\"cst\" name=\"cst[26]\" value=\"{$getCost[26]}\"></td></tr>";

// ***************************** Fourth Non Standard Vergola Tappered Gutter Lip Out 250 x 225 ********************************************//
if ($getQty[27] != '0.00') {
echo "<tr id=\"nonstdgutter4\" style=\"display: table-row;\"><td><input type=\"hidden\" name=\"id[27]\" value=\"{$getCFID[27]}\" /><select class=\"desclist\" name=\"desclist[]\" >";
      
		foreach($nongutters as $nongutter) {
      	echo "<option value=\"".$nongutter['cf_id']."\"";
		if($nongutter['cf_id'] == $getID[27]) { 
		echo "selected=\"selected\""; 
		} else {echo "";}
		echo ">".$nongutter['description']."</option>";	
		}
		
echo "</select>";
    
	 foreach($nongutters as $nongutter) {
	 if ($nongutter['cf_id'] == $getID[27]) { 
	 
echo "<input type=\"hidden\" class=\"desc\" name=\"desc[27]\" value=\"".$nongutter['description']."\" readonly=\"readonly\" />".
     "<input type=\"hidden\" class=\"invent\" name=\"invent[27]\" value=\"".$nongutter['inventoryid']."\" readonly=\"readonly\" />".
     "<input type=\"hidden\" class=\"descrrp\" name=\"descrrp\" value=\"".$nongutter['rrp']."\" readonly=\"readonly\" />".
     "<input type=\"hidden\" class=\"desccost\" name=\"desccost\" value=\"".$nongutter['cost']."\" readonly=\"readonly\" />";
	 }
	else { echo "";}
	 }
	echo "</td>";
}
else {echo "<tr id=\"nonstdgutter4\" style=\"display: none;\"><td><input type=\"hidden\" name=\"id[27]\" value=\"{$getCFID[27]}\" /><select class=\"desclist\" name=\"desclist[]\" >";
        foreach($nongutters as $nongutter) {
      	echo "<option value=\"".$nongutter['cf_id']."\"";
		if($nongutter['cf_id'] == $getID[27]){ 
		echo "selected=\"selected\""; 
		} else {echo "";}
		echo ">".$nongutter['description']."</option>";	
		}
		
echo "</select>";
    
	 foreach($nongutters as $nongutter){
	 if ($nongutter['cf_id'] == $getID[27]) { 
	 
echo "<input type=\"hidden\" class=\"desc\" name=\"desc[27]\" value=\"".$nongutter['description']."\" readonly=\"readonly\" />".
     "<input type=\"hidden\" class=\"invent\" name=\"invent[27]\" value=\"".$nongutter['inventoryid']."\" readonly=\"readonly\" />".
     "<input type=\"hidden\" class=\"descrrp\" name=\"descrrp\" value=\"".$nongutter['rrp']."\" readonly=\"readonly\" />".
     "<input type=\"hidden\" class=\"desccost\" name=\"desccost\" value=\"".$nongutter['cost']."\" readonly=\"readonly\" />";
	 }
	else { echo "";}
	 }
	echo "</td>";

}

// Webbing
echo"<td><input id=\"removenonstd4\" onClick=\"hidenonstd4();\" type=\"button\" value=\"Remove Gutter\" /><input type=\"hidden\" class=\"webbing\" name=\"webbing[27]\" value=\"\" readonly=\"readonly\" /></td>";

// Colours
echo "<td><select name=\"colour[27]\">";
        foreach($colours as $colour){
      	echo "<option value=\"".$colour."\"";
		if($colour == $getColour[27]){echo "selected=\"selected\""; 
		} else {echo "";}
		echo ">".$colour."</option>";
		}	 	
echo"</select></td>";

// Paint and Powder
echo "<td><select class=\"paint-list\" name=\"paintselect\" >";  
	    foreach($paints as $paint){
      	echo "<option value=\"".$paint['cf_id']."\""; 
		if($paint['category'] == $getFinish[27]){ echo "selected=\"selected\"";
		} else {echo "";}
		echo">".$paint['category']."</option>";	
		}
echo "</select>";
foreach($paints as $paint){
if($paint['category'] == $getFinish[27]){
echo "<input type=\"hidden\" class=\"paintdesc\" name=\"paint[27]\" value=\"".$paint['category']."\" readonly=\"readonly\" />".
     "<input type=\"hidden\" class=\"paintrrp\" name=\"paintrrp[]\" value=\"".$paint['rrp']."\" readonly=\"readonly\" />".
     "<input type=\"hidden\" class=\"paintcost\" name=\"paintcost[]\" value=\"".$paint['cost']."\" readonly=\"readonly\" />";
} else {echo "";}
}
	 echo "</td>";

// Unit of Measurement
echo "<td><input type=\"text\" class=\"uom\" name=\"uom[27]\" readonly=\"readonly\" value=\"{$getUOM[27]}\"></td>";

 // Unit Quantity
echo "<td><input type=\"text\" id=\"addqty18\" name=\"qty[27]\" value=\"{$getQty[27]}\"></td>";

if ($getID[27] == '37') {
echo "<td><input type=\"text\" class=\"xlength\" name=\"slength[27]\" value=\"{$getLength[27]}\" style=\"display:none;\"></td>";}
else {echo "<td><input type=\"text\" class=\"xlength\" name=\"slength[27]\" value=\"{$getLength[27]}\"></td>";}

// Total RRP
echo "<td><input type=\"text\" class=\"rrp\" readonly=\"readonly\" name=\"rrp[27]\" value=\"{$getRRP[27]}\"><input type=\"hidden\" class=\"cst\" name=\"cst[27]\" value=\"{$getCost[27]}\"></td></tr>";

// ***************************** Fifth Non Standard Vergola Tappered Gutter Lip Out 225 x 200 ********************************************//

if ($getQty[28] != '0.00') {
echo "<tr id=\"nonstdgutter5\" style=\"display: table-row;\"><td><input type=\"hidden\" name=\"id[28]\" value=\"{$getCFID[28]}\" /><select class=\"desclist\" name=\"desclist[]\" >";
      
		foreach($nongutters as $nongutter) {
      	echo "<option value=\"".$nongutter['cf_id']."\"";
		if($nongutter['cf_id'] == $getID[28]) { 
		echo "selected=\"selected\""; 
		} else {echo "";}
		echo ">".$nongutter['description']."</option>";	
		}
		
echo "</select>";
    
	 foreach($nongutters as $nongutter) {
	 if ($nongutter['cf_id'] == $getID[28]) { 
	 
echo "<input type=\"hidden\" class=\"desc\" name=\"desc[28]\" value=\"".$nongutter['description']."\" readonly=\"readonly\" />".
     "<input type=\"hidden\" class=\"invent\" name=\"invent[28]\" value=\"".$nongutter['inventoryid']."\" readonly=\"readonly\" />".
     "<input type=\"hidden\" class=\"descrrp\" name=\"descrrp\" value=\"".$nongutter['rrp']."\" readonly=\"readonly\" />".
     "<input type=\"hidden\" class=\"desccost\" name=\"desccost\" value=\"".$nongutter['cost']."\" readonly=\"readonly\" />";
	 }
	else { echo "";}
	 }
	echo "</td>";
}
else {echo "<tr id=\"nonstdgutter5\" style=\"display: none;\"><td><input type=\"hidden\" name=\"id[28]\" value=\"{$getCFID[28]}\" /><select class=\"desclist\" name=\"desclist[]\" >";
        foreach($nongutters as $nongutter) {
      	echo "<option value=\"".$nongutter['cf_id']."\"";
		if($nongutter['cf_id'] == $getID[28]){ 
		echo "selected=\"selected\""; 
		} else {echo "";}
		echo ">".$nongutter['description']."</option>";	
		}
		
echo "</select>";
    
	 foreach($nongutters as $nongutter){
	 if ($nongutter['cf_id'] == $getID[28]) { 
	 
echo "<input type=\"hidden\" class=\"desc\" name=\"desc[28]\" value=\"".$nongutter['description']."\" readonly=\"readonly\" />".
     "<input type=\"hidden\" class=\"invent\" name=\"invent[28]\" value=\"".$nongutter['inventoryid']."\" readonly=\"readonly\" />".
     "<input type=\"hidden\" class=\"descrrp\" name=\"descrrp\" value=\"".$nongutter['rrp']."\" readonly=\"readonly\" />".
     "<input type=\"hidden\" class=\"desccost\" name=\"desccost\" value=\"".$nongutter['cost']."\" readonly=\"readonly\" />";
	 }
	else { echo "";}
	 }
	echo "</td>";

}

// Webbing
echo"<td><input id=\"removenonstd5\" onClick=\"hidenonstd5();\" type=\"button\" value=\"Remove Gutter\" /><input type=\"hidden\" class=\"webbing\" name=\"webbing[28]\" value=\"\" readonly=\"readonly\" /></td>";

// Colours
echo "<td><select name=\"colour[28]\">";
        foreach($colours as $colour){
      	echo "<option value=\"".$colour."\"";
		if($colour == $getColour[28]){echo "selected=\"selected\""; 
		} else {echo "";}
		echo ">".$colour."</option>";
		}	 	
echo"</select></td>";

// Paint and Powder
echo "<td><select class=\"paint-list\" name=\"paintselect\" >";  
	    foreach($paints as $paint){
      	echo "<option value=\"".$paint['cf_id']."\""; 
		if($paint['category'] == $getFinish[28]){ echo "selected=\"selected\"";
		} else {echo "";}
		echo">".$paint['category']."</option>";	
		}
echo "</select>";
foreach($paints as $paint){
if($paint['category'] == $getFinish[28]){
echo "<input type=\"hidden\" class=\"paintdesc\" name=\"paint[28]\" value=\"".$paint['category']."\" readonly=\"readonly\" />".
     "<input type=\"hidden\" class=\"paintrrp\" name=\"paintrrp[]\" value=\"".$paint['rrp']."\" readonly=\"readonly\" />".
     "<input type=\"hidden\" class=\"paintcost\" name=\"paintcost[]\" value=\"".$paint['cost']."\" readonly=\"readonly\" />";
} else {echo "";}
}
	 echo "</td>";

// Unit of Measurement
echo "<td><input type=\"text\" class=\"uom\" name=\"uom[28]\" readonly=\"readonly\" value=\"{$getUOM[28]}\"></td>";

 // Unit Quantity
echo "<td><input type=\"text\" id=\"addqty19\" name=\"qty[28]\" value=\"{$getQty[28]}\"></td>";

// Length or Width
if ($getID[28] == '37') {
echo "<td><input type=\"text\" class=\"xlength\" name=\"slength[28]\" value=\"{$getLength[28]}\" style=\"display:none;\"></td>";}
else {echo "<td><input type=\"text\" class=\"xlength\" name=\"slength[28]\" value=\"{$getLength[28]}\"></td>";}


// Total RRP
echo "<td><input type=\"text\" class=\"rrp\" readonly=\"readonly\" name=\"rrp[28]\" value=\"{$getRRP[28]}\"><input type=\"hidden\" class=\"cst\" name=\"cst[28]\" value=\"{$getCost[28]}\"></td></tr>";

// ***************************** Sixth Non Standard Bracket Gutter 190-240 ********************************************//
if ($getQty[29] != '0.00') {
echo "<tr id=\"nonstdgutter6\" style=\"display: table-row;\"><td><input type=\"hidden\" name=\"id[29]\" value=\"{$getCFID[29]}\" /><select class=\"desclist\" name=\"desclist[]\" >";
      
		foreach($nongutters as $nongutter) {
      	echo "<option value=\"".$nongutter['cf_id']."\"";
		if($nongutter['cf_id'] == $getID[29]) { 
		echo "selected=\"selected\""; 
		} else {echo "";}
		echo ">".$nongutter['description']."</option>";	
		}
		
echo "</select>";
    
	 foreach($nongutters as $nongutter) {
	 if ($nongutter['cf_id'] == $getID[29]) { 
	 
echo "<input type=\"hidden\" class=\"desc\" name=\"desc[29]\" value=\"".$nongutter['description']."\" readonly=\"readonly\" />".
     "<input type=\"hidden\" class=\"invent\" name=\"invent[29]\" value=\"".$nongutter['inventoryid']."\" readonly=\"readonly\" />".
     "<input type=\"hidden\" class=\"descrrp\" name=\"descrrp\" value=\"".$nongutter['rrp']."\" readonly=\"readonly\" />".
     "<input type=\"hidden\" class=\"desccost\" name=\"desccost\" value=\"".$nongutter['cost']."\" readonly=\"readonly\" />";
	 }
	else { echo "";}
	 }
	echo "</td>";
}
else {echo "<tr id=\"nonstdgutter6\" style=\"display: none;\"><td><input type=\"hidden\" name=\"id[29]\" value=\"{$getCFID[29]}\" /><select class=\"desclist\" name=\"desclist[]\" >";
        foreach($nongutters as $nongutter) {
      	echo "<option value=\"".$nongutter['cf_id']."\"";
		if($nongutter['cf_id'] == $getID[29]){ 
		echo "selected=\"selected\""; 
		} else {echo "";}
		echo ">".$nongutter['description']."</option>";	
		}
		
echo "</select>";
    
	 foreach($nongutters as $nongutter){
	 if ($nongutter['cf_id'] == $getID[29]) { 
	 
echo "<input type=\"hidden\" class=\"desc\" name=\"desc[29]\" value=\"".$nongutter['description']."\" readonly=\"readonly\" />".
     "<input type=\"hidden\" class=\"invent\" name=\"invent[29]\" value=\"".$nongutter['inventoryid']."\" readonly=\"readonly\" />".
     "<input type=\"hidden\" class=\"descrrp\" name=\"descrrp\" value=\"".$nongutter['rrp']."\" readonly=\"readonly\" />".
     "<input type=\"hidden\" class=\"desccost\" name=\"desccost\" value=\"".$nongutter['cost']."\" readonly=\"readonly\" />";
	 }
	else { echo "";}
	 }
	echo "</td>";

}

// Webbing
echo"<td><input id=\"removenonstd6\" onClick=\"hidenonstd6();\" type=\"button\" value=\"Remove Gutter\" /><input type=\"hidden\" class=\"webbing\" name=\"webbing[29]\" value=\"\" readonly=\"readonly\" /></td>";

// Colours
echo "<td><select name=\"colour[29]\">";
        foreach($colours as $colour){
      	echo "<option value=\"".$colour."\"";
		if($colour == $getColour[29]){echo "selected=\"selected\""; 
		} else {echo "";}
		echo ">".$colour."</option>";
		}	 	
echo"</select></td>";

// Paint and Powder
echo "<td><select class=\"paint-list\" name=\"paintselect\" >";  
	    foreach($paints as $paint){
      	echo "<option value=\"".$paint['cf_id']."\""; 
		if($paint['category'] == $getFinish[29]){ echo "selected=\"selected\"";
		} else {echo "";}
		echo">".$paint['category']."</option>";	
		}
echo "</select>";
foreach($paints as $paint){
if($paint['category'] == $getFinish[29]){
echo "<input type=\"hidden\" class=\"paintdesc\" name=\"paint[29]\" value=\"".$paint['category']."\" readonly=\"readonly\" />".
     "<input type=\"hidden\" class=\"paintrrp\" name=\"paintrrp[]\" value=\"".$paint['rrp']."\" readonly=\"readonly\" />".
     "<input type=\"hidden\" class=\"paintcost\" name=\"paintcost[]\" value=\"".$paint['cost']."\" readonly=\"readonly\" />";
} else {echo "";}
}
	 echo "</td>";

// Unit of Measurement
echo "<td><input type=\"text\" class=\"uom\" name=\"uom[29]\" readonly=\"readonly\" value=\"{$getUOM[29]}\"></td>";

 // Unit Quantity
echo "<td><input type=\"text\" id=\"addqty20\" name=\"qty[29]\" value=\"{$getQty[29]}\"></td>";

// Length or Width
if ($getID[29] == '37') {
echo "<td><input type=\"text\" class=\"xlength\" name=\"slength[29]\" value=\"{$getLength[29]}\" style=\"display:none;\"></td>";}
else {echo "<td><input type=\"text\" class=\"xlength\" name=\"slength[29]\" value=\"{$getLength[29]}\"></td>";}

// Total RRP
echo "<td><input type=\"text\" class=\"rrp\" readonly=\"readonly\" name=\"rrp[29]\" value=\"{$getRRP[29]}\"><input type=\"hidden\" class=\"cst\" name=\"cst[29]\" value=\"{$getCost[29]}\"></td></tr>";

// ***************************** Seventh Non Standard Vergola Guttering Sleeve ********************************************//
if ($getQty[30] != '0.00') {
echo "<tr id=\"nonstdgutter7\" style=\"display: table-row;\"><td><input type=\"hidden\" name=\"id[30]\" value=\"{$getCFID[30]}\" /><select class=\"desclist\" name=\"desclist[]\" >";
      
		foreach($nongutters as $nongutter) {
      	echo "<option value=\"".$nongutter['cf_id']."\"";
		if($nongutter['cf_id'] == $getID[30]) { 
		echo "selected=\"selected\""; 
		} else {echo "";}
		echo ">".$nongutter['description']."</option>";	
		}
		
echo "</select>";
    
	 foreach($nongutters as $nongutter) {
	 if ($nongutter['cf_id'] == $getID[30]) { 
	 
echo "<input type=\"hidden\" class=\"desc\" name=\"desc[30]\" value=\"".$nongutter['description']."\" readonly=\"readonly\" />".
     "<input type=\"hidden\" class=\"invent\" name=\"invent[30]\" value=\"".$nongutter['inventoryid']."\" readonly=\"readonly\" />".
     "<input type=\"hidden\" class=\"descrrp\" name=\"descrrp\" value=\"".$nongutter['rrp']."\" readonly=\"readonly\" />".
     "<input type=\"hidden\" class=\"desccost\" name=\"desccost\" value=\"".$nongutter['cost']."\" readonly=\"readonly\" />";
	 }
	else { echo "";}
	 }
	echo "</td>";
}
else {echo "<tr id=\"nonstdgutter7\" style=\"display: none;\"><td><input type=\"hidden\" name=\"id[30]\" value=\"{$getCFID[30]}\" /><select class=\"desclist\" name=\"desclist[]\" >";
        foreach($nongutters as $nongutter) {
      	echo "<option value=\"".$nongutter['cf_id']."\"";
		if($nongutter['cf_id'] == $getID[30]){ 
		echo "selected=\"selected\""; 
		} else {echo "";}
		echo ">".$nongutter['description']."</option>";	
		}
		
echo "</select>";
    
	 foreach($nongutters as $nongutter){
	 if ($nongutter['cf_id'] == $getID[30]) { 
	 
echo "<input type=\"hidden\" class=\"desc\" name=\"desc[30]\" value=\"".$nongutter['description']."\" readonly=\"readonly\" />".
     "<input type=\"hidden\" class=\"invent\" name=\"invent[30]\" value=\"".$nongutter['inventoryid']."\" readonly=\"readonly\" />".
     "<input type=\"hidden\" class=\"descrrp\" name=\"descrrp\" value=\"".$nongutter['rrp']."\" readonly=\"readonly\" />".
     "<input type=\"hidden\" class=\"desccost\" name=\"desccost\" value=\"".$nongutter['cost']."\" readonly=\"readonly\" />";
	 }
	else { echo "";}
	 }
	echo "</td>";

}

// Webbing
echo"<td><input id=\"removenonstd7\" onClick=\"hidenonstd7();\" type=\"button\" value=\"Remove Gutter\" /><input type=\"hidden\" class=\"webbing\" name=\"webbing[30]\" value=\"\" readonly=\"readonly\" /></td>";

// Colours
echo "<td><select name=\"colour[30]\">";
        foreach($colours as $colour){
      	echo "<option value=\"".$colour."\"";
		if($colour == $getColour[30]){echo "selected=\"selected\""; 
		} else {echo "";}
		echo ">".$colour."</option>";
		}	 	
echo"</select></td>";

// Paint and Powder
echo "<td><select class=\"paint-list\" name=\"paintselect\" >";  
	    foreach($paints as $paint){
      	echo "<option value=\"".$paint['cf_id']."\""; 
		if($paint['category'] == $getFinish[30]){ echo "selected=\"selected\"";
		} else {echo "";}
		echo">".$paint['category']."</option>";	
		}
echo "</select>";
foreach($paints as $paint){
if($paint['category'] == $getFinish[30]){
echo "<input type=\"hidden\" class=\"paintdesc\" name=\"paint[30]\" value=\"".$paint['category']."\" readonly=\"readonly\" />".
     "<input type=\"hidden\" class=\"paintrrp\" name=\"paintrrp[]\" value=\"".$paint['rrp']."\" readonly=\"readonly\" />".
     "<input type=\"hidden\" class=\"paintcost\" name=\"paintcost[]\" value=\"".$paint['cost']."\" readonly=\"readonly\" />";
} else {echo "";}
}
	 echo "</td>";

// Unit of Measurement
echo "<td><input type=\"text\" class=\"uom\" name=\"uom[30]\" readonly=\"readonly\" value=\"{$getUOM[30]}\"></td>";

 // Unit Quantity
echo "<td><input type=\"text\" id=\"addqty21\" name=\"qty[30]\" value=\"{$getQty[30]}\"></td>";

// Length or Width
if ($getID[30] == '37') {
echo "<td><input type=\"text\" class=\"xlength\" name=\"slength[30]\" value=\"{$getLength[30]}\" style=\"display:none;\"></td>";}
else {echo "<td><input type=\"text\" class=\"xlength\" name=\"slength[30]\" value=\"{$getLength[30]}\"></td>";}

// Total RRP
echo "<td><input type=\"text\" class=\"rrp\" readonly=\"readonly\" name=\"rrp[30]\" value=\"{$getRRP[30]}\"><input type=\"hidden\" class=\"cst\" name=\"cst[30]\" value=\"{$getCost[30]}\"></td></tr>";

// ***************************** Eight Non Standard Vergola Zincalume STD 250mm ********************************************//
if ($getQty[31] != '0.00') {
echo "<tr id=\"nonstdgutter8\" style=\"display: table-row;\"><td><input type=\"hidden\" name=\"id[31]\" value=\"{$getCFID[31]}\" /><select class=\"desclist\" name=\"desclist[]\" >";
      
		foreach($nongutters as $nongutter) {
      	echo "<option value=\"".$nongutter['cf_id']."\"";
		if($nongutter['cf_id'] == $getID[31]) { 
		echo "selected=\"selected\""; 
		} else {echo "";}
		echo ">".$nongutter['description']."</option>";	
		}
		
echo "</select>";
    
	 foreach($nongutters as $nongutter) {
	 if ($nongutter['cf_id'] == $getID[31]) { 
	 
echo "<input type=\"hidden\" class=\"desc\" name=\"desc[31]\" value=\"".$nongutter['description']."\" readonly=\"readonly\" />".
     "<input type=\"hidden\" class=\"invent\" name=\"invent[31]\" value=\"".$nongutter['inventoryid']."\" readonly=\"readonly\" />".
     "<input type=\"hidden\" class=\"descrrp\" name=\"descrrp\" value=\"".$nongutter['rrp']."\" readonly=\"readonly\" />".
     "<input type=\"hidden\" class=\"desccost\" name=\"desccost\" value=\"".$nongutter['cost']."\" readonly=\"readonly\" />";
	 }
	else { echo "";}
	 }
	echo "</td>";
}
else {echo "<tr id=\"nonstdgutter8\" style=\"display: none;\"><td><input type=\"hidden\" name=\"id[31]\" value=\"{$getCFID[31]}\" /><select class=\"desclist\" name=\"desclist[]\" >";
        foreach($nongutters as $nongutter) {
      	echo "<option value=\"".$nongutter['cf_id']."\"";
		if($nongutter['cf_id'] == $getID[31]){ 
		echo "selected=\"selected\""; 
		} else {echo "";}
		echo ">".$nongutter['description']."</option>";	
		}
		
echo "</select>";
    
	 foreach($nongutters as $nongutter){
	 if ($nongutter['cf_id'] == $getID[31]) { 
	 
echo "<input type=\"hidden\" class=\"desc\" name=\"desc[31]\" value=\"".$nongutter['description']."\" readonly=\"readonly\" />".
     "<input type=\"hidden\" class=\"invent\" name=\"invent[31]\" value=\"".$nongutter['inventoryid']."\" readonly=\"readonly\" />".
     "<input type=\"hidden\" class=\"descrrp\" name=\"descrrp\" value=\"".$nongutter['rrp']."\" readonly=\"readonly\" />".
     "<input type=\"hidden\" class=\"desccost\" name=\"desccost\" value=\"".$nongutter['cost']."\" readonly=\"readonly\" />";
	 }
	else { echo "";}
	 }
	echo "</td>";

}

// Webbing
echo"<td><input id=\"removenonstd8\" onClick=\"hidenonstd8();\" type=\"button\" value=\"Remove Gutter\" /><input type=\"hidden\" class=\"webbing\" name=\"webbing[31]\" value=\"\" readonly=\"readonly\" /></td>";

// Colours
echo "<td><select name=\"colour[31]\">";
        foreach($colours as $colour){
      	echo "<option value=\"".$colour."\"";
		if($colour == $getColour[31]){echo "selected=\"selected\""; 
		} else {echo "";}
		echo ">".$colour."</option>";
		}	 	
echo"</select></td>";

// Paint and Powder
echo "<td><select class=\"paint-list\" name=\"paintselect\" >";  
	    foreach($paints as $paint){
      	echo "<option value=\"".$paint['cf_id']."\""; 
		if($paint['category'] == $getFinish[31]){ echo "selected=\"selected\"";
		} else {echo "";}
		echo">".$paint['category']."</option>";	
		}
echo "</select>";
foreach($paints as $paint){
if($paint['category'] == $getFinish[31]){
echo "<input type=\"hidden\" class=\"paintdesc\" name=\"paint[31]\" value=\"".$paint['category']."\" readonly=\"readonly\" />".
     "<input type=\"hidden\" class=\"paintrrp\" name=\"paintrrp[]\" value=\"".$paint['rrp']."\" readonly=\"readonly\" />".
     "<input type=\"hidden\" class=\"paintcost\" name=\"paintcost[]\" value=\"".$paint['cost']."\" readonly=\"readonly\" />";
} else {echo "";}
}
	 echo "</td>";

// Unit of Measurement
echo "<td><input type=\"text\" class=\"uom\" name=\"uom[31]\" readonly=\"readonly\" value=\"{$getUOM[31]}\"></td>";

 // Unit Quantity
echo "<td><input type=\"text\" id=\"addqty22\" name=\"qty[31]\" value=\"{$getQty[31]}\"></td>";

// Length or Width
if ($getID[31] == '37') {
echo "<td><input type=\"text\" class=\"xlength\" name=\"slength[31]\" value=\"{$getLength[31]}\" style=\"display:none;\"></td>";}
else {echo "<td><input type=\"text\" class=\"xlength\" name=\"slength[31]\" value=\"{$getLength[31]}\"></td>";}

// Total RRP
echo "<td><input type=\"text\" class=\"rrp\" readonly=\"readonly\" name=\"rrp[31]\" value=\"{$getRRP[31]}\"><input type=\"hidden\" class=\"cst\" name=\"cst[31]\" value=\"{$getCost[31]}\"></td></tr>";
// ***************************** Ninth Non Standard Vergola Cbond 150mm pan ********************************************//
if ($getQty[32] != '0.00') {
echo "<tr id=\"nonstdgutter9\" style=\"display: table-row;\"><td><input type=\"hidden\" name=\"id[32]\" value=\"{$getCFID[32]}\" /><select class=\"desclist\" name=\"desclist[]\" >";
      
		foreach($nongutters as $nongutter) {
      	echo "<option value=\"".$nongutter['cf_id']."\"";
		if($nongutter['cf_id'] == $getID[32]) { 
		echo "selected=\"selected\""; 
		} else {echo "";}
		echo ">".$nongutter['description']."</option>";	
		}
		
echo "</select>";
    
	 foreach($nongutters as $nongutter) {
	 if ($nongutter['cf_id'] == $getID[32]) { 
	 
echo "<input type=\"hidden\" class=\"desc\" name=\"desc[32]\" value=\"".$nongutter['description']."\" readonly=\"readonly\" />".
     "<input type=\"hidden\" class=\"invent\" name=\"invent[32]\" value=\"".$nongutter['inventoryid']."\" readonly=\"readonly\" />".
     "<input type=\"hidden\" class=\"descrrp\" name=\"descrrp\" value=\"".$nongutter['rrp']."\" readonly=\"readonly\" />".
     "<input type=\"hidden\" class=\"desccost\" name=\"desccost\" value=\"".$nongutter['cost']."\" readonly=\"readonly\" />";
	 }
	else { echo "";}
	 }
	echo "</td>";
}
else {echo "<tr id=\"nonstdgutter9\" style=\"display: none;\"><td><input type=\"hidden\" name=\"id[32]\" value=\"{$getCFID[32]}\" /><select class=\"desclist\" name=\"desclist[]\" >";
        foreach($nongutters as $nongutter) {
      	echo "<option value=\"".$nongutter['cf_id']."\"";
		if($nongutter['cf_id'] == $getID[32]){ 
		echo "selected=\"selected\""; 
		} else {echo "";}
		echo ">".$nongutter['description']."</option>";	
		}
		
echo "</select>";
    
	 foreach($nongutters as $nongutter){
	 if ($nongutter['cf_id'] == $getID[32]) { 
	 
echo "<input type=\"hidden\" class=\"desc\" name=\"desc[32]\" value=\"".$nongutter['description']."\" readonly=\"readonly\" />".
     "<input type=\"hidden\" class=\"invent\" name=\"invent[32]\" value=\"".$nongutter['inventoryid']."\" readonly=\"readonly\" />".
     "<input type=\"hidden\" class=\"descrrp\" name=\"descrrp\" value=\"".$nongutter['rrp']."\" readonly=\"readonly\" />".
     "<input type=\"hidden\" class=\"desccost\" name=\"desccost\" value=\"".$nongutter['cost']."\" readonly=\"readonly\" />";
	 }
	else { echo "";}
	 }
	echo "</td>";

}

// Webbing
echo"<td><input id=\"removenonstd9\" onClick=\"hidenonstd9();\" type=\"button\" value=\"Remove Gutter\" /><input type=\"hidden\" class=\"webbing\" name=\"webbing[32]\" value=\"\" readonly=\"readonly\" /></td>";

// Colours
echo "<td><select name=\"colour[32]\">";
        foreach($colours as $colour){
      	echo "<option value=\"".$colour."\"";
		if($colour == $getColour[32]){echo "selected=\"selected\""; 
		} else {echo "";}
		echo ">".$colour."</option>";
		}	 	
echo"</select></td>";

// Paint and Powder
echo "<td><select class=\"paint-list\" name=\"paintselect\" >";  
	    foreach($paints as $paint){
      	echo "<option value=\"".$paint['cf_id']."\""; 
		if($paint['category'] == $getFinish[32]){ echo "selected=\"selected\"";
		} else {echo "";}
		echo">".$paint['category']."</option>";	
		}
echo "</select>";
foreach($paints as $paint){
if($paint['category'] == $getFinish[32]){
echo "<input type=\"hidden\" class=\"paintdesc\" name=\"paint[32]\" value=\"".$paint['category']."\" readonly=\"readonly\" />".
     "<input type=\"hidden\" class=\"paintrrp\" name=\"paintrrp[]\" value=\"".$paint['rrp']."\" readonly=\"readonly\" />".
     "<input type=\"hidden\" class=\"paintcost\" name=\"paintcost[]\" value=\"".$paint['cost']."\" readonly=\"readonly\" />";
} else {echo "";}
}
	 echo "</td>";

// Unit of Measurement
echo "<td><input type=\"text\" class=\"uom\" name=\"uom[32]\" readonly=\"readonly\" value=\"{$getUOM[32]}\"></td>";

 // Unit Quantity
echo "<td><input type=\"text\" id=\"addqty23\" name=\"qty[32]\" value=\"{$getQty[32]}\"></td>";

// Length or Width
if ($getID[32] == '37') {
echo "<td><input type=\"text\" class=\"xlength\" name=\"slength[32]\" value=\"{$getLength[32]}\" style=\"display:none;\"></td>";}
else {echo "<td><input type=\"text\" class=\"xlength\" name=\"slength[32]\" value=\"{$getLength[32]}\"></td>";}

// Total RRP
echo "<td><input type=\"text\" class=\"rrp\" readonly=\"readonly\" name=\"rrp[32]\" value=\"{$getRRP[32]}\"><input type=\"hidden\" class=\"cst\" name=\"cst[32]\" value=\"{$getCost[32]}\"></td></tr>";
?>