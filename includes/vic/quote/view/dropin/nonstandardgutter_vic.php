<?php
// ***************************** First Non-Standard Vergola Gutter Lip Out 225 x 225 ********************************************//
if ($getQty[8] != '0.00') {
echo "<tr id=\"nonstdgutter1\" style=\"display: table-row;\"><td><input type=\"hidden\" name=\"id[8]\" value=\"{$getCFID[8]}\" /><select class=\"desclist\" name=\"desclist[]\" >";
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
		if($nongutter['cf_id'] == $getID[8]) { 
		echo "selected=\"selected\""; 
		} else {echo "";}
		echo ">".$nongutter['description']."</option>";	
		}
		
echo "</select>";
    
	 foreach($nongutters as $nongutter) {
	 if ($nongutter['cf_id'] == $getID[8]) { 
	 
echo "<input type=\"hidden\" class=\"desc\" name=\"desc[8]\" value=\"".$nongutter['description']."\" readonly=\"readonly\" />".
     "<input type=\"hidden\" class=\"invent\" name=\"invent[8]\" value=\"".$nongutter['inventoryid']."\" readonly=\"readonly\" />".
     "<input type=\"hidden\" class=\"descrrp\" name=\"descrrp\" value=\"".$nongutter['rrp']."\" readonly=\"readonly\" />".
     "<input type=\"hidden\" class=\"desccost\" name=\"desccost\" value=\"".$nongutter['cost']."\" readonly=\"readonly\" />";
	 }
	else { echo "";}
	 }
	echo "</td>";
}
else {echo "<tr id=\"nonstdgutter1\" style=\"display: none;\"><td><input type=\"hidden\" name=\"id[8]\" value=\"{$getCFID[8]}\" /><select class=\"desclist\" name=\"desclist[]\" >";
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
		if($nongutter['cf_id'] == $getID[8]){ 
		echo "selected=\"selected\""; 
		} else {echo "";}
		echo ">".$nongutter['description']."</option>";	
		}
		
echo "</select>";
    
	 foreach($nongutters as $nongutter){
	 if ($nongutter['cf_id'] == $getID[8]) { 
	 
echo "<input type=\"hidden\" class=\"desc\" name=\"desc[8]\" value=\"".$nongutter['description']."\" readonly=\"readonly\" />".
     "<input type=\"hidden\" class=\"invent\" name=\"invent[8]\" value=\"".$nongutter['inventoryid']."\" readonly=\"readonly\" />".
     "<input type=\"hidden\" class=\"descrrp\" name=\"descrrp\" value=\"".$nongutter['rrp']."\" readonly=\"readonly\" />".
     "<input type=\"hidden\" class=\"desccost\" name=\"desccost\" value=\"".$nongutter['cost']."\" readonly=\"readonly\" />";
	 }
	else { echo "";}
	 }
	echo "</td>";

}

// Webbing
echo"<td><input id=\"removenonstd1\" onClick=\"hidenonstd1();\" type=\"button\" value=\"Remove Gutter\" /><input type=\"hidden\" class=\"webbing\" name=\"webbing[8]\" value=\"\" readonly=\"readonly\" /></td>";

// Colours
echo "<td><select name=\"colour[8]\">";
        foreach($colours as $colour){
      	echo "<option value=\"".$colour."\"";
		if($colour == $getColour[8]){echo "selected=\"selected\""; 
		} else {echo "";}
		echo ">".$colour."</option>";
		}	 	
echo"</select></td>";

// Paint and Powder
echo "<td><select class=\"paint-list\" name=\"paintselect\" >";  
	    foreach($paints as $paint){
      	echo "<option value=\"".$paint['cf_id']."\""; 
		if($paint['category'] == $getFinish[8]){ echo "selected=\"selected\"";
		} else {echo "";}
		echo">".$paint['category']."</option>";	
		}
echo "</select>";
foreach($paints as $paint){
if($paint['category'] == $getFinish[8]){
echo "<input type=\"hidden\" class=\"paintdesc\" name=\"paint[8]\" value=\"".$paint['category']."\" readonly=\"readonly\" />".
     "<input type=\"hidden\" class=\"paintrrp\" name=\"paintrrp[]\" value=\"".$paint['rrp']."\" readonly=\"readonly\" />".
     "<input type=\"hidden\" class=\"paintcost\" name=\"paintcost[]\" value=\"".$paint['cost']."\" readonly=\"readonly\" />";
} else {echo "";}
}
	 echo "</td>";

// Unit of Measurement
echo "<td><input type=\"text\" class=\"uom\" name=\"uom[8]\" readonly=\"readonly\" value=\"{$getUOM[8]}\"></td>";

 // Unit Quantity
echo "<td><input type=\"text\" id=\"addqty15\" name=\"qty[8]\" value=\"{$getQty[8]}\"></td>";

// Length or Width
if ($getID[8] == '37') {
echo "<td><input type=\"text\" class=\"xlength\" name=\"slength[8]\" value=\"{$getLength[8]}\" style=\"display:none;\"></td>";}
else {echo "<td><input type=\"text\" class=\"xlength\" name=\"slength[8]\" value=\"{$getLength[8]}\"></td>";}

// Total RRP
echo "<td><input type=\"text\" class=\"rrp\" readonly=\"readonly\" name=\"rrp[8]\" value=\"{$getRRP[8]}\"><input type=\"hidden\" class=\"cst\" name=\"cst[8]\" value=\"{$getCost[8]}\"></td></tr>";

// ***************************** Second Non-Standard Vergola Tapered Gutter Lip Out 200 x 225 ********************************************//
if ($getQty[9] != '0.00') {
echo "<tr id=\"nonstdgutter2\" style=\"display: table-row;\"><td><input type=\"hidden\" name=\"id[9]\" value=\"{$getCFID[9]}\" /><select class=\"desclist\" name=\"desclist[]\" >";
      
		foreach($nongutters as $nongutter) {
      	echo "<option value=\"".$nongutter['cf_id']."\"";
		if($nongutter['cf_id'] == $getID[9]) { 
		echo "selected=\"selected\""; 
		} else {echo "";}
		echo ">".$nongutter['description']."</option>";	
		}
		
echo "</select>";
    
	 foreach($nongutters as $nongutter) {
	 if ($nongutter['cf_id'] == $getID[9]) { 
	 
echo "<input type=\"hidden\" class=\"desc\" name=\"desc[9]\" value=\"".$nongutter['description']."\" readonly=\"readonly\" />".
     "<input type=\"hidden\" class=\"invent\" name=\"invent[9]\" value=\"".$nongutter['inventoryid']."\" readonly=\"readonly\" />".
     "<input type=\"hidden\" class=\"descrrp\" name=\"descrrp\" value=\"".$nongutter['rrp']."\" readonly=\"readonly\" />".
     "<input type=\"hidden\" class=\"desccost\" name=\"desccost\" value=\"".$nongutter['cost']."\" readonly=\"readonly\" />";
	 }
	else { echo "";}
	 }
	echo "</td>";
}
else {echo "<tr id=\"nonstdgutter2\" style=\"display: none;\"><td><input type=\"hidden\" name=\"id[9]\" value=\"{$getCFID[9]}\" /><select class=\"desclist\" name=\"desclist[]\" >";
        foreach($nongutters as $nongutter) {
      	echo "<option value=\"".$nongutter['cf_id']."\"";
		if($nongutter['cf_id'] == $getID[9]){ 
		echo "selected=\"selected\""; 
		} else {echo "";}
		echo ">".$nongutter['description']."</option>";	
		}
		
echo "</select>";
    
	 foreach($nongutters as $nongutter){
	 if ($nongutter['cf_id'] == $getID[9]) { 
	 
echo "<input type=\"hidden\" class=\"desc\" name=\"desc[9]\" value=\"".$nongutter['description']."\" readonly=\"readonly\" />".
     "<input type=\"hidden\" class=\"invent\" name=\"invent[9]\" value=\"".$nongutter['inventoryid']."\" readonly=\"readonly\" />".
     "<input type=\"hidden\" class=\"descrrp\" name=\"descrrp\" value=\"".$nongutter['rrp']."\" readonly=\"readonly\" />".
     "<input type=\"hidden\" class=\"desccost\" name=\"desccost\" value=\"".$nongutter['cost']."\" readonly=\"readonly\" />";
	 }
	else { echo "";}
	 }
	echo "</td>";

}

// Webbing
echo"<td><input id=\"removenonstd2\" onClick=\"hidenonstd2();\" type=\"button\" value=\"Remove Gutter\" /><input type=\"hidden\" class=\"webbing\" name=\"webbing[9]\" value=\"\" readonly=\"readonly\" /></td>";

// Colours
echo "<td><select name=\"colour[9]\">";
        foreach($colours as $colour){
      	echo "<option value=\"".$colour."\"";
		if($colour == $getColour[9]){echo "selected=\"selected\""; 
		} else {echo "";}
		echo ">".$colour."</option>";
		}	 	
echo"</select></td>";

// Paint and Powder
echo "<td><select class=\"paint-list\" name=\"paintselect\" >";  
	    foreach($paints as $paint){
      	echo "<option value=\"".$paint['cf_id']."\""; 
		if($paint['category'] == $getFinish[9]){ echo "selected=\"selected\"";
		} else {echo "";}
		echo">".$paint['category']."</option>";	
		}
echo "</select>";
foreach($paints as $paint){
if($paint['category'] == $getFinish[9]){
echo "<input type=\"hidden\" class=\"paintdesc\" name=\"paint[9]\" value=\"".$paint['category']."\" readonly=\"readonly\" />".
     "<input type=\"hidden\" class=\"paintrrp\" name=\"paintrrp[]\" value=\"".$paint['rrp']."\" readonly=\"readonly\" />".
     "<input type=\"hidden\" class=\"paintcost\" name=\"paintcost[]\" value=\"".$paint['cost']."\" readonly=\"readonly\" />";
} else {echo "";}
}
	 echo "</td>";

// Unit of Measurement
echo "<td><input type=\"text\" class=\"uom\" name=\"uom[9]\" readonly=\"readonly\" value=\"{$getUOM[9]}\"></td>";

 // Unit Quantity
echo "<td><input type=\"text\" id=\"addqty16\" name=\"qty[9]\" value=\"{$getQty[9]}\"></td>";

// Length or Width
if ($getID[9] == '37') {
echo "<td><input type=\"text\" class=\"xlength\" name=\"slength[9]\" value=\"{$getLength[9]}\" style=\"display:none;\"></td>";}
else {echo "<td><input type=\"text\" class=\"xlength\" name=\"slength[9]\" value=\"{$getLength[9]}\"></td>";}

// Total RRP
echo "<td><input type=\"text\" class=\"rrp\" readonly=\"readonly\" name=\"rrp[9]\" value=\"{$getRRP[9]}\"><input type=\"hidden\" class=\"cst\" name=\"cst[9]\" value=\"{$getCost[9]}\"></td></tr>";
// ***************************** Third Non Standard Vergola Tappered Gutter Lip Out 225 x 250 ********************************************//
if ($getQty[10] != '0.00') {
echo "<tr id=\"nonstdgutter3\" style=\"display: table-row;\"><td><input type=\"hidden\" name=\"id[10]\" value=\"{$getCFID[10]}\" /><select class=\"desclist\" name=\"desclist[]\" >";
      
		foreach($nongutters as $nongutter) {
      	echo "<option value=\"".$nongutter['cf_id']."\"";
		if($nongutter['cf_id'] == $getID[10]) { 
		echo "selected=\"selected\""; 
		} else {echo "";}
		echo ">".$nongutter['description']."</option>";	
		}
		
echo "</select>";
    
	 foreach($nongutters as $nongutter) {
	 if ($nongutter['cf_id'] == $getID[10]) { 
	 
echo "<input type=\"hidden\" class=\"desc\" name=\"desc[10]\" value=\"".$nongutter['description']."\" readonly=\"readonly\" />".
     "<input type=\"hidden\" class=\"invent\" name=\"invent[10]\" value=\"".$nongutter['inventoryid']."\" readonly=\"readonly\" />".
     "<input type=\"hidden\" class=\"descrrp\" name=\"descrrp\" value=\"".$nongutter['rrp']."\" readonly=\"readonly\" />".
     "<input type=\"hidden\" class=\"desccost\" name=\"desccost\" value=\"".$nongutter['cost']."\" readonly=\"readonly\" />";
	 }
	else { echo "";}
	 }
	echo "</td>";
}
else {echo "<tr id=\"nonstdgutter3\" style=\"display: none;\"><td><input type=\"hidden\" name=\"id[10]\" value=\"{$getCFID[10]}\" /><select class=\"desclist\" name=\"desclist[]\" >";
        foreach($nongutters as $nongutter) {
      	echo "<option value=\"".$nongutter['cf_id']."\"";
		if($nongutter['cf_id'] == $getID[10]){ 
		echo "selected=\"selected\""; 
		} else {echo "";}
		echo ">".$nongutter['description']."</option>";	
		}
		
echo "</select>";
    
	 foreach($nongutters as $nongutter){
	 if ($nongutter['cf_id'] == $getID[10]) { 
	 
echo "<input type=\"hidden\" class=\"desc\" name=\"desc[10]\" value=\"".$nongutter['description']."\" readonly=\"readonly\" />".
     "<input type=\"hidden\" class=\"invent\" name=\"invent[10]\" value=\"".$nongutter['inventoryid']."\" readonly=\"readonly\" />".
     "<input type=\"hidden\" class=\"descrrp\" name=\"descrrp\" value=\"".$nongutter['rrp']."\" readonly=\"readonly\" />".
     "<input type=\"hidden\" class=\"desccost\" name=\"desccost\" value=\"".$nongutter['cost']."\" readonly=\"readonly\" />";
	 }
	else { echo "";}
	 }
	echo "</td>";

}

// Webbing
echo"<td><input id=\"removenonstd3\" onClick=\"hidenonstd3();\" type=\"button\" value=\"Remove Gutter\" /><input type=\"hidden\" class=\"webbing\" name=\"webbing[10]\" value=\"\" readonly=\"readonly\" /></td>";

// Colours
echo "<td><select name=\"colour[10]\">";
        foreach($colours as $colour){
      	echo "<option value=\"".$colour."\"";
		if($colour == $getColour[10]){echo "selected=\"selected\""; 
		} else {echo "";}
		echo ">".$colour."</option>";
		}	 	
echo"</select></td>";

// Paint and Powder
echo "<td><select class=\"paint-list\" name=\"paintselect\" >";  
	    foreach($paints as $paint){
      	echo "<option value=\"".$paint['cf_id']."\""; 
		if($paint['category'] == $getFinish[10]){ echo "selected=\"selected\"";
		} else {echo "";}
		echo">".$paint['category']."</option>";	
		}
echo "</select>";
foreach($paints as $paint){
if($paint['category'] == $getFinish[10]){
echo "<input type=\"hidden\" class=\"paintdesc\" name=\"paint[10]\" value=\"".$paint['category']."\" readonly=\"readonly\" />".
     "<input type=\"hidden\" class=\"paintrrp\" name=\"paintrrp[]\" value=\"".$paint['rrp']."\" readonly=\"readonly\" />".
     "<input type=\"hidden\" class=\"paintcost\" name=\"paintcost[]\" value=\"".$paint['cost']."\" readonly=\"readonly\" />";
} else {echo "";}
}
	 echo "</td>";

// Unit of Measurement
echo "<td><input type=\"text\" class=\"uom\" name=\"uom[10]\" readonly=\"readonly\" value=\"{$getUOM[10]}\"></td>";

 // Unit Quantity
echo "<td><input type=\"text\" id=\"addqty17\" name=\"qty[10]\" value=\"{$getQty[10]}\"></td>";

// Length or Width
if ($getID[10] == '37') {
echo "<td><input type=\"text\" class=\"xlength\" name=\"slength[10]\" value=\"{$getLength[10]}\" style=\"display:none;\"></td>";}
else {echo "<td><input type=\"text\" class=\"xlength\" name=\"slength[10]\" value=\"{$getLength[10]}\"></td>";}

// Total RRP
echo "<td><input type=\"text\" class=\"rrp\" readonly=\"readonly\" name=\"rrp[10]\" value=\"{$getRRP[10]}\"><input type=\"hidden\" class=\"cst\" name=\"cst[10]\" value=\"{$getCost[10]}\"></td></tr>";

// ***************************** Fourth Non Standard Vergola Tappered Gutter Lip Out 250 x 225 ********************************************//
if ($getQty[11] != '0.00') {
echo "<tr id=\"nonstdgutter4\" style=\"display: table-row;\"><td><input type=\"hidden\" name=\"id[11]\" value=\"{$getCFID[11]}\" /><select class=\"desclist\" name=\"desclist[]\" >";
      
		foreach($nongutters as $nongutter) {
      	echo "<option value=\"".$nongutter['cf_id']."\"";
		if($nongutter['cf_id'] == $getID[11]) { 
		echo "selected=\"selected\""; 
		} else {echo "";}
		echo ">".$nongutter['description']."</option>";	
		}
		
echo "</select>";
    
	 foreach($nongutters as $nongutter) {
	 if ($nongutter['cf_id'] == $getID[11]) { 
	 
echo "<input type=\"hidden\" class=\"desc\" name=\"desc[11]\" value=\"".$nongutter['description']."\" readonly=\"readonly\" />".
     "<input type=\"hidden\" class=\"invent\" name=\"invent[11]\" value=\"".$nongutter['inventoryid']."\" readonly=\"readonly\" />".
     "<input type=\"hidden\" class=\"descrrp\" name=\"descrrp\" value=\"".$nongutter['rrp']."\" readonly=\"readonly\" />".
     "<input type=\"hidden\" class=\"desccost\" name=\"desccost\" value=\"".$nongutter['cost']."\" readonly=\"readonly\" />";
	 }
	else { echo "";}
	 }
	echo "</td>";
}
else {echo "<tr id=\"nonstdgutter4\" style=\"display: none;\"><td><input type=\"hidden\" name=\"id[11]\" value=\"{$getCFID[11]}\" /><select class=\"desclist\" name=\"desclist[]\" >";
        foreach($nongutters as $nongutter) {
      	echo "<option value=\"".$nongutter['cf_id']."\"";
		if($nongutter['cf_id'] == $getID[11]){ 
		echo "selected=\"selected\""; 
		} else {echo "";}
		echo ">".$nongutter['description']."</option>";	
		}
		
echo "</select>";
    
	 foreach($nongutters as $nongutter){
	 if ($nongutter['cf_id'] == $getID[11]) { 
	 
echo "<input type=\"hidden\" class=\"desc\" name=\"desc[11]\" value=\"".$nongutter['description']."\" readonly=\"readonly\" />".
     "<input type=\"hidden\" class=\"invent\" name=\"invent[11]\" value=\"".$nongutter['inventoryid']."\" readonly=\"readonly\" />".
     "<input type=\"hidden\" class=\"descrrp\" name=\"descrrp\" value=\"".$nongutter['rrp']."\" readonly=\"readonly\" />".
     "<input type=\"hidden\" class=\"desccost\" name=\"desccost\" value=\"".$nongutter['cost']."\" readonly=\"readonly\" />";
	 }
	else { echo "";}
	 }
	echo "</td>";

}

// Webbing
echo"<td><input id=\"removenonstd4\" onClick=\"hidenonstd4();\" type=\"button\" value=\"Remove Gutter\" /><input type=\"hidden\" class=\"webbing\" name=\"webbing[11]\" value=\"\" readonly=\"readonly\" /></td>";

// Colours
echo "<td><select name=\"colour[11]\">";
        foreach($colours as $colour){
      	echo "<option value=\"".$colour."\"";
		if($colour == $getColour[11]){echo "selected=\"selected\""; 
		} else {echo "";}
		echo ">".$colour."</option>";
		}	 	
echo"</select></td>";

// Paint and Powder
echo "<td><select class=\"paint-list\" name=\"paintselect\" >";  
	    foreach($paints as $paint){
      	echo "<option value=\"".$paint['cf_id']."\""; 
		if($paint['category'] == $getFinish[11]){ echo "selected=\"selected\"";
		} else {echo "";}
		echo">".$paint['category']."</option>";	
		}
echo "</select>";
foreach($paints as $paint){
if($paint['category'] == $getFinish[11]){
echo "<input type=\"hidden\" class=\"paintdesc\" name=\"paint[11]\" value=\"".$paint['category']."\" readonly=\"readonly\" />".
     "<input type=\"hidden\" class=\"paintrrp\" name=\"paintrrp[]\" value=\"".$paint['rrp']."\" readonly=\"readonly\" />".
     "<input type=\"hidden\" class=\"paintcost\" name=\"paintcost[]\" value=\"".$paint['cost']."\" readonly=\"readonly\" />";
} else {echo "";}
}
	 echo "</td>";

// Unit of Measurement
echo "<td><input type=\"text\" class=\"uom\" name=\"uom[11]\" readonly=\"readonly\" value=\"{$getUOM[11]}\"></td>";

 // Unit Quantity
echo "<td><input type=\"text\" id=\"addqty18\" name=\"qty[11]\" value=\"{$getQty[11]}\"></td>";

if ($getID[11] == '37') {
echo "<td><input type=\"text\" class=\"xlength\" name=\"slength[11]\" value=\"{$getLength[11]}\" style=\"display:none;\"></td>";}
else {echo "<td><input type=\"text\" class=\"xlength\" name=\"slength[11]\" value=\"{$getLength[11]}\"></td>";}

// Total RRP
echo "<td><input type=\"text\" class=\"rrp\" readonly=\"readonly\" name=\"rrp[11]\" value=\"{$getRRP[11]}\"><input type=\"hidden\" class=\"cst\" name=\"cst[11]\" value=\"{$getCost[11]}\"></td></tr>";

// ***************************** Fifth Non Standard Vergola Tappered Gutter Lip Out 225 x 200 ********************************************//

if ($getQty[12] != '0.00') {
echo "<tr id=\"nonstdgutter5\" style=\"display: table-row;\"><td><input type=\"hidden\" name=\"id[12]\" value=\"{$getCFID[12]}\" /><select class=\"desclist\" name=\"desclist[]\" >";
      
		foreach($nongutters as $nongutter) {
      	echo "<option value=\"".$nongutter['cf_id']."\"";
		if($nongutter['cf_id'] == $getID[12]) { 
		echo "selected=\"selected\""; 
		} else {echo "";}
		echo ">".$nongutter['description']."</option>";	
		}
		
echo "</select>";
    
	 foreach($nongutters as $nongutter) {
	 if ($nongutter['cf_id'] == $getID[12]) { 
	 
echo "<input type=\"hidden\" class=\"desc\" name=\"desc[12]\" value=\"".$nongutter['description']."\" readonly=\"readonly\" />".
     "<input type=\"hidden\" class=\"invent\" name=\"invent[12]\" value=\"".$nongutter['inventoryid']."\" readonly=\"readonly\" />".
     "<input type=\"hidden\" class=\"descrrp\" name=\"descrrp\" value=\"".$nongutter['rrp']."\" readonly=\"readonly\" />".
     "<input type=\"hidden\" class=\"desccost\" name=\"desccost\" value=\"".$nongutter['cost']."\" readonly=\"readonly\" />";
	 }
	else { echo "";}
	 }
	echo "</td>";
}
else {echo "<tr id=\"nonstdgutter5\" style=\"display: none;\"><td><input type=\"hidden\" name=\"id[12]\" value=\"{$getCFID[12]}\" /><select class=\"desclist\" name=\"desclist[]\" >";
        foreach($nongutters as $nongutter) {
      	echo "<option value=\"".$nongutter['cf_id']."\"";
		if($nongutter['cf_id'] == $getID[12]){ 
		echo "selected=\"selected\""; 
		} else {echo "";}
		echo ">".$nongutter['description']."</option>";	
		}
		
echo "</select>";
    
	 foreach($nongutters as $nongutter){
	 if ($nongutter['cf_id'] == $getID[12]) { 
	 
echo "<input type=\"hidden\" class=\"desc\" name=\"desc[12]\" value=\"".$nongutter['description']."\" readonly=\"readonly\" />".
     "<input type=\"hidden\" class=\"invent\" name=\"invent[12]\" value=\"".$nongutter['inventoryid']."\" readonly=\"readonly\" />".
     "<input type=\"hidden\" class=\"descrrp\" name=\"descrrp\" value=\"".$nongutter['rrp']."\" readonly=\"readonly\" />".
     "<input type=\"hidden\" class=\"desccost\" name=\"desccost\" value=\"".$nongutter['cost']."\" readonly=\"readonly\" />";
	 }
	else { echo "";}
	 }
	echo "</td>";

}

// Webbing
echo"<td><input id=\"removenonstd5\" onClick=\"hidenonstd5();\" type=\"button\" value=\"Remove Gutter\" /><input type=\"hidden\" class=\"webbing\" name=\"webbing[12]\" value=\"\" readonly=\"readonly\" /></td>";

// Colours
echo "<td><select name=\"colour[12]\">";
        foreach($colours as $colour){
      	echo "<option value=\"".$colour."\"";
		if($colour == $getColour[12]){echo "selected=\"selected\""; 
		} else {echo "";}
		echo ">".$colour."</option>";
		}	 	
echo"</select></td>";

// Paint and Powder
echo "<td><select class=\"paint-list\" name=\"paintselect\" >";  
	    foreach($paints as $paint){
      	echo "<option value=\"".$paint['cf_id']."\""; 
		if($paint['category'] == $getFinish[12]){ echo "selected=\"selected\"";
		} else {echo "";}
		echo">".$paint['category']."</option>";	
		}
echo "</select>";
foreach($paints as $paint){
if($paint['category'] == $getFinish[12]){
echo "<input type=\"hidden\" class=\"paintdesc\" name=\"paint[12]\" value=\"".$paint['category']."\" readonly=\"readonly\" />".
     "<input type=\"hidden\" class=\"paintrrp\" name=\"paintrrp[]\" value=\"".$paint['rrp']."\" readonly=\"readonly\" />".
     "<input type=\"hidden\" class=\"paintcost\" name=\"paintcost[]\" value=\"".$paint['cost']."\" readonly=\"readonly\" />";
} else {echo "";}
}
	 echo "</td>";

// Unit of Measurement
echo "<td><input type=\"text\" class=\"uom\" name=\"uom[12]\" readonly=\"readonly\" value=\"{$getUOM[12]}\"></td>";

 // Unit Quantity
echo "<td><input type=\"text\" id=\"addqty19\" name=\"qty[12]\" value=\"{$getQty[12]}\"></td>";

// Length or Width
if ($getID[12] == '37') {
echo "<td><input type=\"text\" class=\"xlength\" name=\"slength[12]\" value=\"{$getLength[12]}\" style=\"display:none;\"></td>";}
else {echo "<td><input type=\"text\" class=\"xlength\" name=\"slength[12]\" value=\"{$getLength[12]}\"></td>";}


// Total RRP
echo "<td><input type=\"text\" class=\"rrp\" readonly=\"readonly\" name=\"rrp[12]\" value=\"{$getRRP[12]}\"><input type=\"hidden\" class=\"cst\" name=\"cst[12]\" value=\"{$getCost[12]}\"></td></tr>";

// ***************************** Sixth Non Standard Bracket Gutter 190-240 ********************************************//
if ($getQty[13] != '0.00') {
echo "<tr id=\"nonstdgutter6\" style=\"display: table-row;\"><td><input type=\"hidden\" name=\"id[13]\" value=\"{$getCFID[13]}\" /><select class=\"desclist\" name=\"desclist[]\" >";
      
		foreach($nongutters as $nongutter) {
      	echo "<option value=\"".$nongutter['cf_id']."\"";
		if($nongutter['cf_id'] == $getID[13]) { 
		echo "selected=\"selected\""; 
		} else {echo "";}
		echo ">".$nongutter['description']."</option>";	
		}
		
echo "</select>";
    
	 foreach($nongutters as $nongutter) {
	 if ($nongutter['cf_id'] == $getID[13]) { 
	 
echo "<input type=\"hidden\" class=\"desc\" name=\"desc[13]\" value=\"".$nongutter['description']."\" readonly=\"readonly\" />".
     "<input type=\"hidden\" class=\"invent\" name=\"invent[13]\" value=\"".$nongutter['inventoryid']."\" readonly=\"readonly\" />".
     "<input type=\"hidden\" class=\"descrrp\" name=\"descrrp\" value=\"".$nongutter['rrp']."\" readonly=\"readonly\" />".
     "<input type=\"hidden\" class=\"desccost\" name=\"desccost\" value=\"".$nongutter['cost']."\" readonly=\"readonly\" />";
	 }
	else { echo "";}
	 }
	echo "</td>";
}
else {echo "<tr id=\"nonstdgutter6\" style=\"display: none;\"><td><input type=\"hidden\" name=\"id[13]\" value=\"{$getCFID[13]}\" /><select class=\"desclist\" name=\"desclist[]\" >";
        foreach($nongutters as $nongutter) {
      	echo "<option value=\"".$nongutter['cf_id']."\"";
		if($nongutter['cf_id'] == $getID[13]){ 
		echo "selected=\"selected\""; 
		} else {echo "";}
		echo ">".$nongutter['description']."</option>";	
		}
		
echo "</select>";
    
	 foreach($nongutters as $nongutter){
	 if ($nongutter['cf_id'] == $getID[13]) { 
	 
echo "<input type=\"hidden\" class=\"desc\" name=\"desc[13]\" value=\"".$nongutter['description']."\" readonly=\"readonly\" />".
     "<input type=\"hidden\" class=\"invent\" name=\"invent[13]\" value=\"".$nongutter['inventoryid']."\" readonly=\"readonly\" />".
     "<input type=\"hidden\" class=\"descrrp\" name=\"descrrp\" value=\"".$nongutter['rrp']."\" readonly=\"readonly\" />".
     "<input type=\"hidden\" class=\"desccost\" name=\"desccost\" value=\"".$nongutter['cost']."\" readonly=\"readonly\" />";
	 }
	else { echo "";}
	 }
	echo "</td>";

}

// Webbing
echo"<td><input id=\"removenonstd6\" onClick=\"hidenonstd6();\" type=\"button\" value=\"Remove Gutter\" /><input type=\"hidden\" class=\"webbing\" name=\"webbing[13]\" value=\"\" readonly=\"readonly\" /></td>";

// Colours
echo "<td><select name=\"colour[13]\">";
        foreach($colours as $colour){
      	echo "<option value=\"".$colour."\"";
		if($colour == $getColour[13]){echo "selected=\"selected\""; 
		} else {echo "";}
		echo ">".$colour."</option>";
		}	 	
echo"</select></td>";

// Paint and Powder
echo "<td><select class=\"paint-list\" name=\"paintselect\" >";  
	    foreach($paints as $paint){
      	echo "<option value=\"".$paint['cf_id']."\""; 
		if($paint['category'] == $getFinish[13]){ echo "selected=\"selected\"";
		} else {echo "";}
		echo">".$paint['category']."</option>";	
		}
echo "</select>";
foreach($paints as $paint){
if($paint['category'] == $getFinish[13]){
echo "<input type=\"hidden\" class=\"paintdesc\" name=\"paint[13]\" value=\"".$paint['category']."\" readonly=\"readonly\" />".
     "<input type=\"hidden\" class=\"paintrrp\" name=\"paintrrp[]\" value=\"".$paint['rrp']."\" readonly=\"readonly\" />".
     "<input type=\"hidden\" class=\"paintcost\" name=\"paintcost[]\" value=\"".$paint['cost']."\" readonly=\"readonly\" />";
} else {echo "";}
}
	 echo "</td>";

// Unit of Measurement
echo "<td><input type=\"text\" class=\"uom\" name=\"uom[13]\" readonly=\"readonly\" value=\"{$getUOM[13]}\"></td>";

 // Unit Quantity
echo "<td><input type=\"text\" id=\"addqty20\" name=\"qty[13]\" value=\"{$getQty[13]}\"></td>";

// Length or Width
if ($getID[13] == '37') {
echo "<td><input type=\"text\" class=\"xlength\" name=\"slength[13]\" value=\"{$getLength[13]}\" style=\"display:none;\"></td>";}
else {echo "<td><input type=\"text\" class=\"xlength\" name=\"slength[13]\" value=\"{$getLength[13]}\"></td>";}

// Total RRP
echo "<td><input type=\"text\" class=\"rrp\" readonly=\"readonly\" name=\"rrp[13]\" value=\"{$getRRP[13]}\"><input type=\"hidden\" class=\"cst\" name=\"cst[13]\" value=\"{$getCost[13]}\"></td></tr>";

// ***************************** Seventh Non Standard Vergola Guttering Sleeve ********************************************//
if ($getQty[14] != '0.00') {
echo "<tr id=\"nonstdgutter7\" style=\"display: table-row;\"><td><input type=\"hidden\" name=\"id[14]\" value=\"{$getCFID[14]}\" /><select class=\"desclist\" name=\"desclist[]\" >";
      
		foreach($nongutters as $nongutter) {
      	echo "<option value=\"".$nongutter['cf_id']."\"";
		if($nongutter['cf_id'] == $getID[14]) { 
		echo "selected=\"selected\""; 
		} else {echo "";}
		echo ">".$nongutter['description']."</option>";	
		}
		
echo "</select>";
    
	 foreach($nongutters as $nongutter) {
	 if ($nongutter['cf_id'] == $getID[14]) { 
	 
echo "<input type=\"hidden\" class=\"desc\" name=\"desc[14]\" value=\"".$nongutter['description']."\" readonly=\"readonly\" />".
     "<input type=\"hidden\" class=\"invent\" name=\"invent[14]\" value=\"".$nongutter['inventoryid']."\" readonly=\"readonly\" />".
     "<input type=\"hidden\" class=\"descrrp\" name=\"descrrp\" value=\"".$nongutter['rrp']."\" readonly=\"readonly\" />".
     "<input type=\"hidden\" class=\"desccost\" name=\"desccost\" value=\"".$nongutter['cost']."\" readonly=\"readonly\" />";
	 }
	else { echo "";}
	 }
	echo "</td>";
}
else {echo "<tr id=\"nonstdgutter7\" style=\"display: none;\"><td><input type=\"hidden\" name=\"id[14]\" value=\"{$getCFID[14]}\" /><select class=\"desclist\" name=\"desclist[]\" >";
        foreach($nongutters as $nongutter) {
      	echo "<option value=\"".$nongutter['cf_id']."\"";
		if($nongutter['cf_id'] == $getID[14]){ 
		echo "selected=\"selected\""; 
		} else {echo "";}
		echo ">".$nongutter['description']."</option>";	
		}
		
echo "</select>";
    
	 foreach($nongutters as $nongutter){
	 if ($nongutter['cf_id'] == $getID[14]) { 
	 
echo "<input type=\"hidden\" class=\"desc\" name=\"desc[14]\" value=\"".$nongutter['description']."\" readonly=\"readonly\" />".
     "<input type=\"hidden\" class=\"invent\" name=\"invent[14]\" value=\"".$nongutter['inventoryid']."\" readonly=\"readonly\" />".
     "<input type=\"hidden\" class=\"descrrp\" name=\"descrrp\" value=\"".$nongutter['rrp']."\" readonly=\"readonly\" />".
     "<input type=\"hidden\" class=\"desccost\" name=\"desccost\" value=\"".$nongutter['cost']."\" readonly=\"readonly\" />";
	 }
	else { echo "";}
	 }
	echo "</td>";

}

// Webbing
echo"<td><input id=\"removenonstd7\" onClick=\"hidenonstd7();\" type=\"button\" value=\"Remove Gutter\" /><input type=\"hidden\" class=\"webbing\" name=\"webbing[14]\" value=\"\" readonly=\"readonly\" /></td>";

// Colours
echo "<td><select name=\"colour[14]\">";
        foreach($colours as $colour){
      	echo "<option value=\"".$colour."\"";
		if($colour == $getColour[14]){echo "selected=\"selected\""; 
		} else {echo "";}
		echo ">".$colour."</option>";
		}	 	
echo"</select></td>";

// Paint and Powder
echo "<td><select class=\"paint-list\" name=\"paintselect\" >";  
	    foreach($paints as $paint){
      	echo "<option value=\"".$paint['cf_id']."\""; 
		if($paint['category'] == $getFinish[14]){ echo "selected=\"selected\"";
		} else {echo "";}
		echo">".$paint['category']."</option>";	
		}
echo "</select>";
foreach($paints as $paint){
if($paint['category'] == $getFinish[14]){
echo "<input type=\"hidden\" class=\"paintdesc\" name=\"paint[14]\" value=\"".$paint['category']."\" readonly=\"readonly\" />".
     "<input type=\"hidden\" class=\"paintrrp\" name=\"paintrrp[]\" value=\"".$paint['rrp']."\" readonly=\"readonly\" />".
     "<input type=\"hidden\" class=\"paintcost\" name=\"paintcost[]\" value=\"".$paint['cost']."\" readonly=\"readonly\" />";
} else {echo "";}
}
	 echo "</td>";

// Unit of Measurement
echo "<td><input type=\"text\" class=\"uom\" name=\"uom[14]\" readonly=\"readonly\" value=\"{$getUOM[14]}\"></td>";

 // Unit Quantity
echo "<td><input type=\"text\" id=\"addqty21\" name=\"qty[14]\" value=\"{$getQty[14]}\"></td>";

// Length or Width
if ($getID[14] == '37') {
echo "<td><input type=\"text\" class=\"xlength\" name=\"slength[14]\" value=\"{$getLength[14]}\" style=\"display:none;\"></td>";}
else {echo "<td><input type=\"text\" class=\"xlength\" name=\"slength[14]\" value=\"{$getLength[14]}\"></td>";}

// Total RRP
echo "<td><input type=\"text\" class=\"rrp\" readonly=\"readonly\" name=\"rrp[14]\" value=\"{$getRRP[14]}\"><input type=\"hidden\" class=\"cst\" name=\"cst[14]\" value=\"{$getCost[14]}\"></td></tr>";

// ***************************** Eight Non Standard Vergola Zincalume STD 250mm ********************************************//
if ($getQty[15] != '0.00') {
echo "<tr id=\"nonstdgutter8\" style=\"display: table-row;\"><td><input type=\"hidden\" name=\"id[15]\" value=\"{$getCFID[15]}\" /><select class=\"desclist\" name=\"desclist[]\" >";
      
		foreach($nongutters as $nongutter) {
      	echo "<option value=\"".$nongutter['cf_id']."\"";
		if($nongutter['cf_id'] == $getID[15]) { 
		echo "selected=\"selected\""; 
		} else {echo "";}
		echo ">".$nongutter['description']."</option>";	
		}
		
echo "</select>";
    
	 foreach($nongutters as $nongutter) {
	 if ($nongutter['cf_id'] == $getID[15]) { 
	 
echo "<input type=\"hidden\" class=\"desc\" name=\"desc[15]\" value=\"".$nongutter['description']."\" readonly=\"readonly\" />".
     "<input type=\"hidden\" class=\"invent\" name=\"invent[15]\" value=\"".$nongutter['inventoryid']."\" readonly=\"readonly\" />".
     "<input type=\"hidden\" class=\"descrrp\" name=\"descrrp\" value=\"".$nongutter['rrp']."\" readonly=\"readonly\" />".
     "<input type=\"hidden\" class=\"desccost\" name=\"desccost\" value=\"".$nongutter['cost']."\" readonly=\"readonly\" />";
	 }
	else { echo "";}
	 }
	echo "</td>";
}
else {echo "<tr id=\"nonstdgutter8\" style=\"display: none;\"><td><input type=\"hidden\" name=\"id[15]\" value=\"{$getCFID[15]}\" /><select class=\"desclist\" name=\"desclist[]\" >";
        foreach($nongutters as $nongutter) {
      	echo "<option value=\"".$nongutter['cf_id']."\"";
		if($nongutter['cf_id'] == $getID[15]){ 
		echo "selected=\"selected\""; 
		} else {echo "";}
		echo ">".$nongutter['description']."</option>";	
		}
		
echo "</select>";
    
	 foreach($nongutters as $nongutter){
	 if ($nongutter['cf_id'] == $getID[15]) { 
	 
echo "<input type=\"hidden\" class=\"desc\" name=\"desc[15]\" value=\"".$nongutter['description']."\" readonly=\"readonly\" />".
     "<input type=\"hidden\" class=\"invent\" name=\"invent[15]\" value=\"".$nongutter['inventoryid']."\" readonly=\"readonly\" />".
     "<input type=\"hidden\" class=\"descrrp\" name=\"descrrp\" value=\"".$nongutter['rrp']."\" readonly=\"readonly\" />".
     "<input type=\"hidden\" class=\"desccost\" name=\"desccost\" value=\"".$nongutter['cost']."\" readonly=\"readonly\" />";
	 }
	else { echo "";}
	 }
	echo "</td>";

}

// Webbing
echo"<td><input id=\"removenonstd8\" onClick=\"hidenonstd8();\" type=\"button\" value=\"Remove Gutter\" /><input type=\"hidden\" class=\"webbing\" name=\"webbing[15]\" value=\"\" readonly=\"readonly\" /></td>";

// Colours
echo "<td><select name=\"colour[15]\">";
        foreach($colours as $colour){
      	echo "<option value=\"".$colour."\"";
		if($colour == $getColour[15]){echo "selected=\"selected\""; 
		} else {echo "";}
		echo ">".$colour."</option>";
		}	 	
echo"</select></td>";

// Paint and Powder
echo "<td><select class=\"paint-list\" name=\"paintselect\" >";  
	    foreach($paints as $paint){
      	echo "<option value=\"".$paint['cf_id']."\""; 
		if($paint['category'] == $getFinish[15]){ echo "selected=\"selected\"";
		} else {echo "";}
		echo">".$paint['category']."</option>";	
		}
echo "</select>";
foreach($paints as $paint){
if($paint['category'] == $getFinish[15]){
echo "<input type=\"hidden\" class=\"paintdesc\" name=\"paint[15]\" value=\"".$paint['category']."\" readonly=\"readonly\" />".
     "<input type=\"hidden\" class=\"paintrrp\" name=\"paintrrp[]\" value=\"".$paint['rrp']."\" readonly=\"readonly\" />".
     "<input type=\"hidden\" class=\"paintcost\" name=\"paintcost[]\" value=\"".$paint['cost']."\" readonly=\"readonly\" />";
} else {echo "";}
}
	 echo "</td>";

// Unit of Measurement
echo "<td><input type=\"text\" class=\"uom\" name=\"uom[15]\" readonly=\"readonly\" value=\"{$getUOM[15]}\"></td>";

 // Unit Quantity
echo "<td><input type=\"text\" id=\"addqty22\" name=\"qty[15]\" value=\"{$getQty[15]}\"></td>";

// Length or Width
if ($getID[15] == '37') {
echo "<td><input type=\"text\" class=\"xlength\" name=\"slength[15]\" value=\"{$getLength[15]}\" style=\"display:none;\"></td>";}
else {echo "<td><input type=\"text\" class=\"xlength\" name=\"slength[15]\" value=\"{$getLength[15]}\"></td>";}

// Total RRP
echo "<td><input type=\"text\" class=\"rrp\" readonly=\"readonly\" name=\"rrp[15]\" value=\"{$getRRP[15]}\"><input type=\"hidden\" class=\"cst\" name=\"cst[15]\" value=\"{$getCost[15]}\"></td></tr>";
// ***************************** Ninth Non Standard Vergola Cbond 150mm pan ********************************************//
if ($getQty[16] != '0.00') {
echo "<tr id=\"nonstdgutter9\" style=\"display: table-row;\"><td><input type=\"hidden\" name=\"id[16]\" value=\"{$getCFID[16]}\" /><select class=\"desclist\" name=\"desclist[]\" >";
      
		foreach($nongutters as $nongutter) {
      	echo "<option value=\"".$nongutter['cf_id']."\"";
		if($nongutter['cf_id'] == $getID[16]) { 
		echo "selected=\"selected\""; 
		} else {echo "";}
		echo ">".$nongutter['description']."</option>";	
		}
		
echo "</select>";
    
	 foreach($nongutters as $nongutter) {
	 if ($nongutter['cf_id'] == $getID[16]) { 
	 
echo "<input type=\"hidden\" class=\"desc\" name=\"desc[16]\" value=\"".$nongutter['description']."\" readonly=\"readonly\" />".
     "<input type=\"hidden\" class=\"invent\" name=\"invent[16]\" value=\"".$nongutter['inventoryid']."\" readonly=\"readonly\" />".
     "<input type=\"hidden\" class=\"descrrp\" name=\"descrrp\" value=\"".$nongutter['rrp']."\" readonly=\"readonly\" />".
     "<input type=\"hidden\" class=\"desccost\" name=\"desccost\" value=\"".$nongutter['cost']."\" readonly=\"readonly\" />";
	 }
	else { echo "";}
	 }
	echo "</td>";
}
else {echo "<tr id=\"nonstdgutter9\" style=\"display: none;\"><td><input type=\"hidden\" name=\"id[16]\" value=\"{$getCFID[16]}\" /><select class=\"desclist\" name=\"desclist[]\" >";
        foreach($nongutters as $nongutter) {
      	echo "<option value=\"".$nongutter['cf_id']."\"";
		if($nongutter['cf_id'] == $getID[16]){ 
		echo "selected=\"selected\""; 
		} else {echo "";}
		echo ">".$nongutter['description']."</option>";	
		}
		
echo "</select>";
    
	 foreach($nongutters as $nongutter){
	 if ($nongutter['cf_id'] == $getID[16]) { 
	 
echo "<input type=\"hidden\" class=\"desc\" name=\"desc[16]\" value=\"".$nongutter['description']."\" readonly=\"readonly\" />".
     "<input type=\"hidden\" class=\"invent\" name=\"invent[16]\" value=\"".$nongutter['inventoryid']."\" readonly=\"readonly\" />".
     "<input type=\"hidden\" class=\"descrrp\" name=\"descrrp\" value=\"".$nongutter['rrp']."\" readonly=\"readonly\" />".
     "<input type=\"hidden\" class=\"desccost\" name=\"desccost\" value=\"".$nongutter['cost']."\" readonly=\"readonly\" />";
	 }
	else { echo "";}
	 }
	echo "</td>";

}

// Webbing
echo"<td><input id=\"removenonstd9\" onClick=\"hidenonstd9();\" type=\"button\" value=\"Remove Gutter\" /><input type=\"hidden\" class=\"webbing\" name=\"webbing[16]\" value=\"\" readonly=\"readonly\" /></td>";

// Colours
echo "<td><select name=\"colour[16]\">";
        foreach($colours as $colour){
      	echo "<option value=\"".$colour."\"";
		if($colour == $getColour[16]){echo "selected=\"selected\""; 
		} else {echo "";}
		echo ">".$colour."</option>";
		}	 	
echo"</select></td>";

// Paint and Powder
echo "<td><select class=\"paint-list\" name=\"paintselect\" >";  
	    foreach($paints as $paint){
      	echo "<option value=\"".$paint['cf_id']."\""; 
		if($paint['category'] == $getFinish[16]){ echo "selected=\"selected\"";
		} else {echo "";}
		echo">".$paint['category']."</option>";	
		}
echo "</select>";
foreach($paints as $paint){
if($paint['category'] == $getFinish[16]){
echo "<input type=\"hidden\" class=\"paintdesc\" name=\"paint[16]\" value=\"".$paint['category']."\" readonly=\"readonly\" />".
     "<input type=\"hidden\" class=\"paintrrp\" name=\"paintrrp[]\" value=\"".$paint['rrp']."\" readonly=\"readonly\" />".
     "<input type=\"hidden\" class=\"paintcost\" name=\"paintcost[]\" value=\"".$paint['cost']."\" readonly=\"readonly\" />";
} else {echo "";}
}
	 echo "</td>";

// Unit of Measurement
echo "<td><input type=\"text\" class=\"uom\" name=\"uom[16]\" readonly=\"readonly\" value=\"{$getUOM[16]}\"></td>";

 // Unit Quantity
echo "<td><input type=\"text\" id=\"addqty23\" name=\"qty[16]\" value=\"{$getQty[16]}\"></td>";

// Length or Width
if ($getID[16] == '37') {
echo "<td><input type=\"text\" class=\"xlength\" name=\"slength[16]\" value=\"{$getLength[16]}\" style=\"display:none;\"></td>";}
else {echo "<td><input type=\"text\" class=\"xlength\" name=\"slength[16]\" value=\"{$getLength[16]}\"></td>";}

// Total RRP
echo "<td><input type=\"text\" class=\"rrp\" readonly=\"readonly\" name=\"rrp[16]\" value=\"{$getRRP[16]}\"><input type=\"hidden\" class=\"cst\" name=\"cst[16]\" value=\"{$getCost[16]}\"></td></tr>";
?>