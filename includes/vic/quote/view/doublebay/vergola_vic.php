<?php 
// ***************************** Louvres Poly or Square ********************************************//
echo "<tr><td colspan=\"8\" class=\"subheading\">Vergola System</td></tr>";
echo "<tr><td><input type=\"hidden\" name=\"id[49]\" value=\"{$getCFID[49]}\" /><select class=\"desclist\" name=\"desclist[]\" >";
		$louvres = array();
		while ($louvre = mysql_fetch_array($resultlouv)) {
		$louvres[] = $louvre;
		$heading = isset($louvre[0]) ? $louvre[0] : null;
		$BeamIDArrayPhp .= isset($louvre[1]) ? 'BeamIDArray["'.$heading.'"]="'.$louvre[1].'";' : null;	
		$BeamDESCArrayPhp .= isset($louvre[2]) ? 'BeamDESCArray["'.$heading.'"]="'.$louvre[2].'";' : null;
		$BeamRRPArrayPhp .= isset($louvre[4]) ? 'BeamRRPArray["'.$heading.'"]="'.$louvre[4].'";' : null;
		$BeamCOSTArrayPhp .= isset($louvre[5]) ? 'BeamCOSTArray["'.$heading.'"]="'.$louvre[5].'";' : null;
		}
		foreach($louvres as $louvre) {
      	echo "<option value=\"".$louvre['cf_id']."\"";
		if($louvre['cf_id'] == $getID[49]) {
		echo "selected=\"selected\""; 
		} else {echo "";}
		echo ">".$louvre['description']."</option>";	
		}
echo "</select>";
    
	 foreach($louvres as $louvre){
     if ($louvre['cf_id'] == $getID[49]) {
	 echo "<input type=\"hidden\" class=\"desc\" name=\"desc[49]\" value=\"".$louvre['description']."\" />".
     "<input type=\"hidden\" class=\"invent\" name=\"invent[49]\" value=\"".$louvre['inventoryid']."\" />".
     "<input type=\"hidden\" class=\"descrrp\" name=\"descrrp\" value=\"".$louvre['rrp']."\" />".
     "<input type=\"hidden\" class=\"desccost\" name=\"desccost\" value=\"".$louvre['cost']."\"/>"; }
	 else {echo "";}
	 } 
	 echo "</td>";
	 
// Webbing
echo"<td><input type=\"hidden\" class=\"webbing\" name=\"webbing[49]\" value=\"\" readonly=\"readonly\" /></td>";

// Colours
echo "<td><select name=\"colour[49]\">";
        foreach($colours as $colour) {
      	echo "<option value=\"".$colour."\"";
		if($colour == $getColour[49]){ echo "selected=\"selected\""; 
		} else {echo "";}
		echo ">".$colour."</option>";
		}
echo"</select></td>";

// Paint and Powder
echo "<td><select class=\"paint-list\" name=\"paintselect\" >";  
	    foreach($paints as $paint) {
      	echo "<option value=\"".$paint['cf_id']."\""; 
		if($paint['category'] == $getFinish[49]){ echo "selected=\"selected\"";
		} else {echo "";}
		echo">".$paint['category']."</option>";	
		}
echo "</select>";
foreach($paints as $paint) {
if($paint['category'] == $getFinish[49]){
echo "<input type=\"hidden\" class=\"paintdesc\" name=\"paint[49]\" value=\"".$paint['category']."\" readonly=\"readonly\" />".
     "<input type=\"hidden\" class=\"paintrrp\" name=\"paintrrp[]\" value=\"".$paint['rrp']."\" readonly=\"readonly\" />".
     "<input type=\"hidden\" class=\"paintcost\" name=\"paintcost[]\" value=\"".$paint['cost']."\" readonly=\"readonly\" />";
} else {echo "";}
}
	 echo "</td>";

// Unit of Measurement
echo "<td><input type=\"text\" name=\"uom[49]\" readonly=\"readonly\" value=\"{$getUOM[49]}\"></td>";

// Unit Quantity
echo "<td><input type=\"text\" class=\"qtylen\" name=\"qty[49]\" value=\"{$getQty[49]}\"></td>";

// Length or Width
echo "<td><input type=\"text\" class=\"width\" name=\"slength[49]\" value=\"{$getLength[49]}\"></td>";

// Total RRP
echo "<td><input type=\"text\" class=\"rrp\" readonly=\"readonly\" name=\"rrp[49]\" value=\"{$getRRP[49]}\"><input type=\"hidden\" class=\"cst\" name=\"cst[49]\" value=\"{$getCost[49]}\"></td></tr>";

// ***************************** Endcap ********************************************//
echo "<tr><td><input type=\"hidden\" name=\"id[50]\" value=\"{$getCFID[50]}\" />".$getDesc[50];
        $vergolas = array();
		while ($vergola = mysql_fetch_array($resultvergola)) {
		$vergolas[] = $vergola; 	}	
      	foreach($vergolas as $vergola) {
		if ($vergola['cf_id'] == $getID[50]) {  
		echo "<input type=\"hidden\" class=\"desc\" name=\"desc[50]\" value=\"".$vergola['description']."\" readonly=\"readonly\" />".
		"<input type=\"hidden\" class=\"invent\" name=\"invent[50]\" value=\"".$vergola['inventoryid']."\" readonly=\"readonly\" />".
		"<input type=\"hidden\" class=\"descrrp\" name=\"descrrp\" value=\"".$vergola['rrp']."\" readonly=\"readonly\" />".
        "<input type=\"hidden\" class=\"desccost\" name=\"desccost\" value=\"".$vergola['cost']."\" readonly=\"readonly\" /></td>";
		
	
// Webbing
echo"<td><input type=\"hidden\" class=\"webbing\" name=\"webbing[50]\" value=\"\" readonly=\"readonly\" /></td>";   

// Colours
echo "<td><select name=\"colour[50]\">";
        foreach($colours as $colour) {
      	echo "<option value=\"".$colour."\"";
		if($colour == $getColour[50]){ echo "selected=\"selected\""; 
		} else {echo "";}
		echo ">".$colour."</option>";
		}
echo"</select></td>";

// Paint and Powder
echo "<td><select class=\"paint-list\" name=\"paintselect\" >";  
	    foreach($paints as $paint) {
      	echo "<option value=\"".$paint['cf_id']."\""; 
		if($paint['category'] == $getFinish[50]){ echo "selected=\"selected\"";
		} else {echo "";}
		echo">".$paint['category']."</option>";	
		}
echo "</select>";
foreach($paints as $paint) {
if($paint['category'] == $getFinish[50]){
echo "<input type=\"hidden\" class=\"paintdesc\" name=\"paint[50]\" value=\"".$paint['category']."\" readonly=\"readonly\" />".
     "<input type=\"hidden\" class=\"paintrrp\" name=\"paintrrp[]\" value=\"".$paint['rrp']."\" readonly=\"readonly\" />".
     "<input type=\"hidden\" class=\"paintcost\" name=\"paintcost[]\" value=\"".$paint['cost']."\" readonly=\"readonly\" />";
} else {echo "";}
}
	 echo "</td>";

// Unit of Measurement
echo "<td><input type=\"text\" name=\"uom[50]\" readonly=\"readonly\" value=\"{$getUOM[50]}\"></td>"; }
else { echo " ";}
		}
// Unit Quantity
echo "<td><input type=\"text\" class=\"qtylen\" name=\"qty[50]\" value=\"{$getQty[50]}\"></td>";

// Length or Width
echo "<td><input type=\"hidden\" name=\"slength[50]\" value=\"{$getLength[50]}\"></td>";

// Total RRP
echo "<td><input type=\"text\" class=\"rrp\" readonly=\"readonly\" name=\"rrp[50]\" value=\"{$getRRP[50]}\"><input type=\"hidden\" class=\"cst\" name=\"cst[50]\" value=\"{$getCost[50]}\"></td></tr>";

// ***************************** Pivot Strip ********************************************//
echo "<tr><td><input type=\"hidden\" name=\"id[51]\" value=\"{$getCFID[51]}\" />".$getDesc[51];
      	foreach($vergolas as $vergola) {
		if ($vergola['cf_id'] == $getID[51]) {  
		echo "<input type=\"hidden\" class=\"desc\" name=\"desc[51]\" value=\"".$vergola['description']."\" readonly=\"readonly\" />".
		"<input type=\"hidden\" class=\"invent\" name=\"invent[51]\" value=\"".$vergola['inventoryid']."\" readonly=\"readonly\" />".
		"<input type=\"hidden\" class=\"descrrp\" name=\"descrrp\" value=\"".$vergola['rrp']."\" readonly=\"readonly\" />".
        "<input type=\"hidden\" class=\"desccost\" name=\"desccost\" value=\"".$vergola['cost']."\" readonly=\"readonly\" /></td>";
		
	
// Webbing
echo"<td><input type=\"hidden\" class=\"webbing\" name=\"webbing[51]\" value=\"\" readonly=\"readonly\" /></td>";   

// Colours
echo "<td><select name=\"colour[51]\">";
        foreach($colours as $colour) {
      	echo "<option value=\"".$colour."\"";
		if($colour == $getColour[51]){ echo "selected=\"selected\""; 
		} else {echo "";}
		echo ">".$colour."</option>";
		}
echo"</select></td>";

// Paint and Powder
echo "<td><select class=\"paint-list\" name=\"paintselect\" >";  
	    foreach($paints as $paint) {
      	echo "<option value=\"".$paint['cf_id']."\""; 
		if($paint['category'] == $getFinish[51]){ echo "selected=\"selected\"";
		} else {echo "";}
		echo">".$paint['category']."</option>";	
		}
echo "</select>";
foreach($paints as $paint) {
if($paint['category'] == $getFinish[51]){
echo "<input type=\"hidden\" class=\"paintdesc\" name=\"paint[51]\" value=\"".$paint['category']."\" readonly=\"readonly\" />".
     "<input type=\"hidden\" class=\"paintrrp\" name=\"paintrrp[]\" value=\"".$paint['rrp']."\" readonly=\"readonly\" />".
     "<input type=\"hidden\" class=\"paintcost\" name=\"paintcost[]\" value=\"".$paint['cost']."\" readonly=\"readonly\" />";
} else {echo "";}
}
	 echo "</td>";

// Unit of Measurement
echo "<td><input type=\"text\" name=\"uom[51]\" readonly=\"readonly\" value=\"{$getUOM[51]}\"></td>"; }
else { echo " ";}
		}
// Unit Quantity
echo "<td><input type=\"text\" class=\"qtylen\" name=\"qty[51]\" value=\"{$getQty[51]}\"></td>";

// Length or Width
echo "<td><input type=\"hidden\" name=\"slength[51]\" value=\"{$getLength[51]}\"></td>";

// Total RRP
echo "<td><input type=\"text\" class=\"rrp\" readonly=\"readonly\" name=\"rrp[51]\" value=\"{$getRRP[51]}\"><input type=\"hidden\" class=\"cst\" name=\"cst[51]\" value=\"{$getCost[51]}\"></td></tr>";
// ***************************** Link Bar ********************************************//
echo "<tr><td><input type=\"hidden\" name=\"id[52]\" value=\"{$getCFID[52]}\" />".$getDesc[52];
      	foreach($vergolas as $vergola) {
		if ($vergola['cf_id'] == $getID[52]) {  
		echo "<input type=\"hidden\" class=\"desc\" name=\"desc[52]\" value=\"".$vergola['description']."\" readonly=\"readonly\" />".
		"<input type=\"hidden\" class=\"invent\" name=\"invent[52]\" value=\"".$vergola['inventoryid']."\" readonly=\"readonly\" />".
		"<input type=\"hidden\" class=\"descrrp\" name=\"descrrp\" value=\"".$vergola['rrp']."\" readonly=\"readonly\" />".
        "<input type=\"hidden\" class=\"desccost\" name=\"desccost\" value=\"".$vergola['cost']."\" readonly=\"readonly\" /></td>";
		
	
// Webbing
echo"<td><input type=\"hidden\" class=\"webbing\" name=\"webbing[52]\" value=\"\" readonly=\"readonly\" /></td>";   

// Colours
echo "<td><select name=\"colour[52]\">";
        foreach($colours as $colour) {
      	echo "<option value=\"".$colour."\"";
		if($colour == $getColour[52]){ echo "selected=\"selected\""; 
		} else {echo "";}
		echo ">".$colour."</option>";
		}
echo"</select></td>";

// Paint and Powder
echo "<td><select class=\"paint-list\" name=\"paintselect\" >";  
	    foreach($paints as $paint) {
      	echo "<option value=\"".$paint['cf_id']."\""; 
		if($paint['category'] == $getFinish[52]){ echo "selected=\"selected\"";
		} else {echo "";}
		echo">".$paint['category']."</option>";	
		}
echo "</select>";
foreach($paints as $paint) {
if($paint['category'] == $getFinish[52]){
echo "<input type=\"hidden\" class=\"paintdesc\" name=\"paint[52]\" value=\"".$paint['category']."\" readonly=\"readonly\" />".
     "<input type=\"hidden\" class=\"paintrrp\" name=\"paintrrp[]\" value=\"".$paint['rrp']."\" readonly=\"readonly\" />".
     "<input type=\"hidden\" class=\"paintcost\" name=\"paintcost[]\" value=\"".$paint['cost']."\" readonly=\"readonly\" />";
} else {echo "";}
}
	 echo "</td>";

// Unit of Measurement
echo "<td><input type=\"text\" name=\"uom[52]\" readonly=\"readonly\" value=\"{$getUOM[52]}\"></td>"; }
else { echo " ";}
		}
// Unit Quantity
echo "<td><input type=\"text\" class=\"qtylen\" name=\"qty[52]\" value=\"{$getQty[52]}\"></td>";

// Length or Width
echo "<td><input type=\"hidden\" name=\"slength[52]\" value=\"{$getLength[52]}\"></td>";

// Total RRP
echo "<td><input type=\"text\" class=\"rrp\" readonly=\"readonly\" name=\"rrp[52]\" value=\"{$getRRP[52]}\"><input type=\"hidden\" class=\"cst\" name=\"cst[52]\" value=\"{$getCost[52]}\"></td></tr>";

// ***************************** Adjustable Angled Bracket ********************************************//
echo "<tr><td><input type=\"hidden\" name=\"id[53]\" value=\"{$getCFID[53]}\" />".$getDesc[53];
      	foreach($vergolas as $vergola) {
		if ($vergola['cf_id'] == $getID[53]) {  
		echo "<input type=\"hidden\" class=\"desc\" name=\"desc[53]\" value=\"".$vergola['description']."\" readonly=\"readonly\" />".
		"<input type=\"hidden\" class=\"invent\" name=\"invent[53]\" value=\"".$vergola['inventoryid']."\" readonly=\"readonly\" />".
		"<input type=\"hidden\" class=\"descrrp\" name=\"descrrp\" value=\"".$vergola['rrp']."\" readonly=\"readonly\" />".
        "<input type=\"hidden\" class=\"desccost\" name=\"desccost\" value=\"".$vergola['cost']."\" readonly=\"readonly\" /></td>";
		    
// Webbing
echo"<td><input type=\"hidden\" class=\"webbing\" name=\"webbing[53]\" value=\"\" readonly=\"readonly\" /></td>";

// Colours
echo"<td><input type=\"hidden\" class=\"colour\" name=\"colour[53]\" value=\"\" readonly=\"readonly\" /></td>";
     	
// Paint and Powder
echo"<td><input type=\"hidden\" name=\"paint[53]\" value=\"\" readonly=\"readonly\" /></td>";

// Unit of Measurement
echo "<td><input type=\"text\" name=\"uom[53]\" readonly=\"readonly\" value=\"".$vergola['uom']."\"></td>";	
}
else { echo " ";}
		}
// Unit Quantity
echo "<td><input type=\"text\" class=\"qtylen\" name=\"qty[53]\" value=\"{$getQty[53]}\"></td>";

// Length or Width
echo "<td><input type=\"hidden\" name=\"slength[53]\" value=\"{$getLength[53]}\" readonly=\"readonly\" /></td>";

// Total RRP
echo "<td><input type=\"text\" class=\"rrp\" readonly=\"readonly\" name=\"rrp[53]\" value=\"{$getRRP[53]}\"><input type=\"hidden\" class=\"cst\" name=\"cst[53]\" value=\"{$getCost[53]}\"></td></tr>";

// ***************************** Operator Motor ********************************************//
echo "<tr><td><input type=\"hidden\" name=\"id[54]\" value=\"{$getCFID[54]}\" />".$getDesc[54];
      	foreach($vergolas as $vergola) {
		if ($vergola['cf_id'] == $getID[54]) {  
		echo "<input type=\"hidden\" class=\"desc\" name=\"desc[54]\" value=\"".$vergola['description']."\" readonly=\"readonly\" />".
		"<input type=\"hidden\" class=\"invent\" name=\"invent[54]\" value=\"".$vergola['inventoryid']."\" readonly=\"readonly\" />".
		"<input type=\"hidden\" class=\"descrrp\" name=\"descrrp\" value=\"".$vergola['rrp']."\" readonly=\"readonly\" />".
        "<input type=\"hidden\" class=\"desccost\" name=\"desccost\" value=\"".$vergola['cost']."\" readonly=\"readonly\" /></td>";
		    
// Webbing
echo"<td><input type=\"hidden\" class=\"webbing\" name=\"webbing[54]\" value=\"\" readonly=\"readonly\" /></td>";

// Colours
echo"<td><input type=\"hidden\" class=\"colour\" name=\"colour[54]\" value=\"\" readonly=\"readonly\" /></td>";
     	
// Paint and Powder
echo"<td><input type=\"hidden\" name=\"paint[54]\" value=\"\" readonly=\"readonly\" /></td>";

// Unit of Measurement
echo "<td><input type=\"text\" name=\"uom[54]\" readonly=\"readonly\" value=\"".$vergola['uom']."\"></td>";	
}
else { echo " ";}
		}
// Unit Quantity
echo "<td><input type=\"text\" class=\"qtylen\" name=\"qty[54]\" value=\"{$getQty[54]}\"><input type=\"text\" id=\"motor\" name=\"motor\" value=\"{$getQty[54]}\" style=\"display:none;\"></td>";

// Length or Width
echo "<td><input type=\"hidden\" name=\"slength[54]\" value=\"{$getLength[54]}\" readonly=\"readonly\" /></td>";

// Total RRP
echo "<td><input type=\"text\" class=\"rrp\" readonly=\"readonly\" name=\"rrp[54]\" value=\"{$getRRP[54]}\"><input type=\"hidden\" class=\"cst\" name=\"cst[54]\" value=\"{$getCost[54]}\"></td></tr>";

// ***************************** Battery ********************************************//

echo "<tr><td><input type=\"hidden\" name=\"id[55]\" value=\"{$getCFID[55]}\" />".$getDesc[55];
      	foreach($vergolas as $vergola) {
		if ($vergola['cf_id'] == $getID[55]) {  
		echo "<input type=\"hidden\" class=\"desc\" name=\"desc[55]\" value=\"".$vergola['description']."\" readonly=\"readonly\" />".
		"<input type=\"hidden\" class=\"invent\" name=\"invent[55]\" value=\"".$vergola['inventoryid']."\" readonly=\"readonly\" />".
		"<input type=\"hidden\" class=\"descrrp\" name=\"descrrp\" value=\"".$vergola['rrp']."\" readonly=\"readonly\" />".
        "<input type=\"hidden\" class=\"desccost\" name=\"desccost\" value=\"".$vergola['cost']."\" readonly=\"readonly\" /></td>";
		    
// Webbing
echo"<td><input type=\"hidden\" class=\"webbing\" name=\"webbing[55]\" value=\"\" readonly=\"readonly\" /></td>";

// Colours
echo"<td><input type=\"hidden\" class=\"colour\" name=\"colour[55]\" value=\"\" readonly=\"readonly\" /></td>";
     	
// Paint and Powder
echo"<td><input type=\"hidden\" name=\"paint[55]\" value=\"\" readonly=\"readonly\" /></td>";

// Unit of Measurement
echo "<td><input type=\"text\" name=\"uom[55]\" readonly=\"readonly\" value=\"".$vergola['uom']."\"></td>";	
}
else { echo " ";}
		}
// Unit Quantity
echo "<td><input type=\"text\" class=\"qtylen\" name=\"qty[55]\" value=\"{$getQty[55]}\"></td>";

// Length or Width
echo "<td><input type=\"hidden\" name=\"slength[55]\" value=\"{$getLength[55]}\" readonly=\"readonly\" /></td>";

// Total RRP
echo "<td><input type=\"text\" class=\"rrp\" readonly=\"readonly\" name=\"rrp[55]\" value=\"{$getRRP[55]}\"><input type=\"hidden\" class=\"cst\" name=\"cst[55]\" value=\"{$getCost[55]}\"></td></tr>";
// ***************************** 1 to 6 Motor Rain ********************************************//
echo "<tr><td><input type=\"hidden\" name=\"id[56]\" value=\"{$getCFID[56]}\" />".$getDesc[56];
      	foreach($vergolas as $vergola) {
		if ($vergola['cf_id'] == $getID[56]) {  
		echo "<input type=\"hidden\" class=\"desc\" name=\"desc[56]\" value=\"".$vergola['description']."\" readonly=\"readonly\" />".
		"<input type=\"hidden\" class=\"invent\" name=\"invent[56]\" value=\"".$vergola['inventoryid']."\" readonly=\"readonly\" />".
		"<input type=\"hidden\" class=\"descrrp\" name=\"descrrp\" value=\"".$vergola['rrp']."\" readonly=\"readonly\" />".
        "<input type=\"hidden\" class=\"desccost\" name=\"desccost\" value=\"".$vergola['cost']."\" readonly=\"readonly\" /></td>";
		    
// Webbing
echo"<td><input type=\"hidden\" class=\"webbing\" name=\"webbing[56]\" value=\"\" readonly=\"readonly\" /></td>";

// Colours
echo"<td><input type=\"hidden\" class=\"colour\" name=\"colour[56]\" value=\"\" readonly=\"readonly\" /></td>";
     	
// Paint and Powder
echo"<td><input type=\"hidden\" name=\"paint[56]\" value=\"\" readonly=\"readonly\" /></td>";

// Unit of Measurement
echo "<td><input type=\"text\" name=\"uom[56]\" readonly=\"readonly\" value=\"".$vergola['uom']."\"></td>";	
}
else { echo " ";}
		}
// Unit Quantity
echo "<td><input type=\"text\" class=\"qtylen\" name=\"qty[56]\" value=\"{$getQty[56]}\"></td>";

// Length or Width
echo "<td><input type=\"hidden\" name=\"slength[56]\" value=\"{$getLength[56]}\" readonly=\"readonly\" /></td>";

// Total RRP
echo "<td><input type=\"text\" class=\"rrp\" readonly=\"readonly\" name=\"rrp[56]\" value=\"{$getRRP[56]}\"><input type=\"hidden\" class=\"cst\" name=\"cst[56]\" value=\"{$getCost[56]}\"></td></tr>";
// ***************************** 7 to 8 Motor Rain ********************************************//
echo "<tr><td><input type=\"hidden\" name=\"id[57]\" value=\"{$getCFID[57]}\" />".$getDesc[57];
      	foreach($vergolas as $vergola) {
		if ($vergola['cf_id'] == $getID[57]) {  
		echo "<input type=\"hidden\" class=\"desc\" name=\"desc[57]\" value=\"".$vergola['description']."\" readonly=\"readonly\" />".
		"<input type=\"hidden\" class=\"invent\" name=\"invent[57]\" value=\"".$vergola['inventoryid']."\" readonly=\"readonly\" />".
		"<input type=\"hidden\" class=\"descrrp\" name=\"descrrp\" value=\"".$vergola['rrp']."\" readonly=\"readonly\" />".
        "<input type=\"hidden\" class=\"desccost\" name=\"desccost\" value=\"".$vergola['cost']."\" readonly=\"readonly\" /></td>";
		    
// Webbing
echo"<td><input type=\"hidden\" class=\"webbing\" name=\"webbing[57]\" value=\"\" readonly=\"readonly\" /></td>";

// Colours
echo"<td><input type=\"hidden\" class=\"colour\" name=\"colour[57]\" value=\"\" readonly=\"readonly\" /></td>";
     	
// Paint and Powder
echo"<td><input type=\"hidden\" name=\"paint[57]\" value=\"\" readonly=\"readonly\" /></td>";

// Unit of Measurement
echo "<td><input type=\"text\" name=\"uom[57]\" readonly=\"readonly\" value=\"".$vergola['uom']."\"></td>";	
}
else { echo " ";}
		}
// Unit Quantity
echo "<td><input type=\"text\" class=\"qtylen\" name=\"qty[57]\" value=\"{$getQty[57]}\"></td>";

// Length or Width
echo "<td><input type=\"hidden\" name=\"slength[57]\" value=\"{$getLength[57]}\" readonly=\"readonly\" /></td>";

// Total RRP
echo "<td><input type=\"text\" class=\"rrp\" readonly=\"readonly\" name=\"rrp[57]\" value=\"{$getRRP[57]}\"><input type=\"hidden\" class=\"cst\" name=\"cst[57]\" value=\"{$getCost[57]}\"></td></tr>";

?>