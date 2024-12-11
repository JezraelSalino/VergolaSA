<?php 
// ***************************** Louvres Poly or Square ********************************************//
echo "<tr><td colspan=\"8\" class=\"subheading\">Vergola System</td></tr>";
echo "<tr><td><input type=\"hidden\" name=\"id[44]\" value=\"{$getCFID[44]}\" /><select class=\"desclist\" name=\"desclist[]\" >";
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
		if($louvre['cf_id'] == $getID[44]) {
		echo "selected=\"selected\""; 
		} else {echo "";}
		echo ">".$louvre['description']."</option>";	
		}
echo "</select>";
    
	 foreach($louvres as $louvre){
     if ($louvre['cf_id'] == $getID[44]) {
	 echo "<input type=\"hidden\" class=\"desc\" name=\"desc[44]\" value=\"".$louvre['description']."\" />".
     "<input type=\"hidden\" class=\"invent\" name=\"invent[44]\" value=\"".$louvre['inventoryid']."\" />".
     "<input type=\"hidden\" class=\"descrrp\" name=\"descrrp\" value=\"".$louvre['rrp']."\" />".
     "<input type=\"hidden\" class=\"desccost\" name=\"desccost\" value=\"".$louvre['cost']."\"/>"; }
	 else {echo "";}
	 } 
	 echo "</td>";
	 
// Webbing
echo"<td><input type=\"hidden\" class=\"webbing\" name=\"webbing[44]\" value=\"\" readonly=\"readonly\" /></td>";

// Colours
echo "<td><select name=\"colour[44]\">";
        foreach($colours as $colour) {
      	echo "<option value=\"".$colour."\"";
		if($colour == $getColour[44]){ echo "selected=\"selected\""; 
		} else {echo "";}
		echo ">".$colour."</option>";
		}
echo"</select></td>";

// Paint and Powder
echo "<td><select class=\"paint-list\" name=\"paintselect\" >";  
	    foreach($paints as $paint) {
      	echo "<option value=\"".$paint['cf_id']."\""; 
		if($paint['category'] == $getFinish[44]){ echo "selected=\"selected\"";
		} else {echo "";}
		echo">".$paint['category']."</option>";	
		}
echo "</select>";
foreach($paints as $paint) {
if($paint['category'] == $getFinish[44]){
echo "<input type=\"hidden\" class=\"paintdesc\" name=\"paint[44]\" value=\"".$paint['category']."\" readonly=\"readonly\" />".
     "<input type=\"hidden\" class=\"paintrrp\" name=\"paintrrp[]\" value=\"".$paint['rrp']."\" readonly=\"readonly\" />".
     "<input type=\"hidden\" class=\"paintcost\" name=\"paintcost[]\" value=\"".$paint['cost']."\" readonly=\"readonly\" />";
} else {echo "";}
}
	 echo "</td>";

// Unit of Measurement
echo "<td><input type=\"text\" name=\"uom[44]\" readonly=\"readonly\" value=\"{$getUOM[44]}\"></td>";

// Unit Quantity
echo "<td><input type=\"text\" class=\"qtylen\" name=\"qty[44]\" value=\"{$getQty[44]}\"></td>";

// Length or Width
echo "<td><input type=\"text\" class=\"width\" name=\"slength[44]\" value=\"{$getLength[44]}\"></td>";

// Total RRP
echo "<td><input type=\"text\" class=\"rrp\" readonly=\"readonly\" name=\"rrp[44]\" value=\"{$getRRP[44]}\"><input type=\"hidden\" class=\"cst\" name=\"cst[44]\" value=\"{$getCost[44]}\"></td></tr>";

// ***************************** Endcap ********************************************//
echo "<tr><td><input type=\"hidden\" name=\"id[45]\" value=\"{$getCFID[45]}\" />".$getDesc[45];
        $vergolas = array();
		while ($vergola = mysql_fetch_array($resultvergola)) {
		$vergolas[] = $vergola; 	}	
      	foreach($vergolas as $vergola) {
		if ($vergola['cf_id'] == $getID[45]) {  
		echo "<input type=\"hidden\" class=\"desc\" name=\"desc[45]\" value=\"".$vergola['description']."\" readonly=\"readonly\" />".
		"<input type=\"hidden\" class=\"invent\" name=\"invent[45]\" value=\"".$vergola['inventoryid']."\" readonly=\"readonly\" />".
		"<input type=\"hidden\" class=\"descrrp\" name=\"descrrp\" value=\"".$vergola['rrp']."\" readonly=\"readonly\" />".
        "<input type=\"hidden\" class=\"desccost\" name=\"desccost\" value=\"".$vergola['cost']."\" readonly=\"readonly\" /></td>";
		
	
// Webbing
echo"<td><input type=\"hidden\" class=\"webbing\" name=\"webbing[45]\" value=\"\" readonly=\"readonly\" /></td>";   

// Colours
echo "<td><select name=\"colour[45]\">";
        foreach($colours as $colour) {
      	echo "<option value=\"".$colour."\"";
		if($colour == $getColour[45]){ echo "selected=\"selected\""; 
		} else {echo "";}
		echo ">".$colour."</option>";
		}
echo"</select></td>";

// Paint and Powder
echo "<td><select class=\"paint-list\" name=\"paintselect\" >";  
	    foreach($paints as $paint) {
      	echo "<option value=\"".$paint['cf_id']."\""; 
		if($paint['category'] == $getFinish[45]){ echo "selected=\"selected\"";
		} else {echo "";}
		echo">".$paint['category']."</option>";	
		}
echo "</select>";
foreach($paints as $paint) {
if($paint['category'] == $getFinish[45]){
echo "<input type=\"hidden\" class=\"paintdesc\" name=\"paint[45]\" value=\"".$paint['category']."\" readonly=\"readonly\" />".
     "<input type=\"hidden\" class=\"paintrrp\" name=\"paintrrp[]\" value=\"".$paint['rrp']."\" readonly=\"readonly\" />".
     "<input type=\"hidden\" class=\"paintcost\" name=\"paintcost[]\" value=\"".$paint['cost']."\" readonly=\"readonly\" />";
} else {echo "";}
}
	 echo "</td>";

// Unit of Measurement
echo "<td><input type=\"text\" name=\"uom[45]\" readonly=\"readonly\" value=\"{$getUOM[45]}\"></td>"; }
else { echo " ";}
		}
// Unit Quantity
echo "<td><input type=\"text\" class=\"qtylen\" name=\"qty[45]\" value=\"{$getQty[45]}\"></td>";

// Length or Width
echo "<td><input type=\"hidden\" name=\"slength[45]\" value=\"{$getLength[45]}\"></td>";

// Total RRP
echo "<td><input type=\"text\" class=\"rrp\" readonly=\"readonly\" name=\"rrp[45]\" value=\"{$getRRP[45]}\"><input type=\"hidden\" class=\"cst\" name=\"cst[45]\" value=\"{$getCost[45]}\"></td></tr>";

// ***************************** Pivot Strip ********************************************//
echo "<tr><td><input type=\"hidden\" name=\"id[46]\" value=\"{$getCFID[46]}\" />".$getDesc[46];
      	foreach($vergolas as $vergola) {
		if ($vergola['cf_id'] == $getID[46]) {  
		echo "<input type=\"hidden\" class=\"desc\" name=\"desc[46]\" value=\"".$vergola['description']."\" readonly=\"readonly\" />".
		"<input type=\"hidden\" class=\"invent\" name=\"invent[46]\" value=\"".$vergola['inventoryid']."\" readonly=\"readonly\" />".
		"<input type=\"hidden\" class=\"descrrp\" name=\"descrrp\" value=\"".$vergola['rrp']."\" readonly=\"readonly\" />".
        "<input type=\"hidden\" class=\"desccost\" name=\"desccost\" value=\"".$vergola['cost']."\" readonly=\"readonly\" /></td>";
		
	
// Webbing
echo"<td><input type=\"hidden\" class=\"webbing\" name=\"webbing[46]\" value=\"\" readonly=\"readonly\" /></td>";   

// Colours
echo "<td><select name=\"colour[46]\">";
        foreach($colours as $colour) {
      	echo "<option value=\"".$colour."\"";
		if($colour == $getColour[46]){ echo "selected=\"selected\""; 
		} else {echo "";}
		echo ">".$colour."</option>";
		}
echo"</select></td>";

// Paint and Powder
echo "<td><select class=\"paint-list\" name=\"paintselect\" >";  
	    foreach($paints as $paint) {
      	echo "<option value=\"".$paint['cf_id']."\""; 
		if($paint['category'] == $getFinish[46]){ echo "selected=\"selected\"";
		} else {echo "";}
		echo">".$paint['category']."</option>";	
		}
echo "</select>";
foreach($paints as $paint) {
if($paint['category'] == $getFinish[46]){
echo "<input type=\"hidden\" class=\"paintdesc\" name=\"paint[46]\" value=\"".$paint['category']."\" readonly=\"readonly\" />".
     "<input type=\"hidden\" class=\"paintrrp\" name=\"paintrrp[]\" value=\"".$paint['rrp']."\" readonly=\"readonly\" />".
     "<input type=\"hidden\" class=\"paintcost\" name=\"paintcost[]\" value=\"".$paint['cost']."\" readonly=\"readonly\" />";
} else {echo "";}
}
	 echo "</td>";

// Unit of Measurement
echo "<td><input type=\"text\" name=\"uom[46]\" readonly=\"readonly\" value=\"{$getUOM[46]}\"></td>"; }
else { echo " ";}
		}
// Unit Quantity
echo "<td><input type=\"text\" class=\"qtylen\" name=\"qty[46]\" value=\"{$getQty[46]}\"></td>";

// Length or Width
echo "<td><input type=\"hidden\" name=\"slength[46]\" value=\"{$getLength[46]}\"></td>";

// Total RRP
echo "<td><input type=\"text\" class=\"rrp\" readonly=\"readonly\" name=\"rrp[46]\" value=\"{$getRRP[46]}\"><input type=\"hidden\" class=\"cst\" name=\"cst[46]\" value=\"{$getCost[46]}\"></td></tr>";
// ***************************** Link Bar ********************************************//
echo "<tr><td><input type=\"hidden\" name=\"id[47]\" value=\"{$getCFID[47]}\" />".$getDesc[47];
      	foreach($vergolas as $vergola) {
		if ($vergola['cf_id'] == $getID[47]) {  
		echo "<input type=\"hidden\" class=\"desc\" name=\"desc[47]\" value=\"".$vergola['description']."\" readonly=\"readonly\" />".
		"<input type=\"hidden\" class=\"invent\" name=\"invent[47]\" value=\"".$vergola['inventoryid']."\" readonly=\"readonly\" />".
		"<input type=\"hidden\" class=\"descrrp\" name=\"descrrp\" value=\"".$vergola['rrp']."\" readonly=\"readonly\" />".
        "<input type=\"hidden\" class=\"desccost\" name=\"desccost\" value=\"".$vergola['cost']."\" readonly=\"readonly\" /></td>";
		
	
// Webbing
echo"<td><input type=\"hidden\" class=\"webbing\" name=\"webbing[47]\" value=\"\" readonly=\"readonly\" /></td>";   

// Colours
echo "<td><select name=\"colour[47]\">";
        foreach($colours as $colour) {
      	echo "<option value=\"".$colour."\"";
		if($colour == $getColour[47]){ echo "selected=\"selected\""; 
		} else {echo "";}
		echo ">".$colour."</option>";
		}
echo"</select></td>";

// Paint and Powder
echo "<td><select class=\"paint-list\" name=\"paintselect\" >";  
	    foreach($paints as $paint) {
      	echo "<option value=\"".$paint['cf_id']."\""; 
		if($paint['category'] == $getFinish[47]){ echo "selected=\"selected\"";
		} else {echo "";}
		echo">".$paint['category']."</option>";	
		}
echo "</select>";
foreach($paints as $paint) {
if($paint['category'] == $getFinish[47]){
echo "<input type=\"hidden\" class=\"paintdesc\" name=\"paint[47]\" value=\"".$paint['category']."\" readonly=\"readonly\" />".
     "<input type=\"hidden\" class=\"paintrrp\" name=\"paintrrp[]\" value=\"".$paint['rrp']."\" readonly=\"readonly\" />".
     "<input type=\"hidden\" class=\"paintcost\" name=\"paintcost[]\" value=\"".$paint['cost']."\" readonly=\"readonly\" />";
} else {echo "";}
}
	 echo "</td>";

// Unit of Measurement
echo "<td><input type=\"text\" name=\"uom[47]\" readonly=\"readonly\" value=\"{$getUOM[47]}\"></td>"; }
else { echo " ";}
		}
// Unit Quantity
echo "<td><input type=\"text\" class=\"qtylen\" name=\"qty[47]\" value=\"{$getQty[47]}\"></td>";

// Length or Width
echo "<td><input type=\"hidden\" name=\"slength[47]\" value=\"{$getLength[47]}\"></td>";

// Total RRP
echo "<td><input type=\"text\" class=\"rrp\" readonly=\"readonly\" name=\"rrp[47]\" value=\"{$getRRP[47]}\"><input type=\"hidden\" class=\"cst\" name=\"cst[47]\" value=\"{$getCost[47]}\"></td></tr>";

// ***************************** Adjustable Angled Bracket ********************************************//
echo "<tr><td><input type=\"hidden\" name=\"id[48]\" value=\"{$getCFID[48]}\" />".$getDesc[48];
      	foreach($vergolas as $vergola) {
		if ($vergola['cf_id'] == $getID[48]) {  
		echo "<input type=\"hidden\" class=\"desc\" name=\"desc[48]\" value=\"".$vergola['description']."\" readonly=\"readonly\" />".
		"<input type=\"hidden\" class=\"invent\" name=\"invent[48]\" value=\"".$vergola['inventoryid']."\" readonly=\"readonly\" />".
		"<input type=\"hidden\" class=\"descrrp\" name=\"descrrp\" value=\"".$vergola['rrp']."\" readonly=\"readonly\" />".
        "<input type=\"hidden\" class=\"desccost\" name=\"desccost\" value=\"".$vergola['cost']."\" readonly=\"readonly\" /></td>";
		    
// Webbing
echo"<td><input type=\"hidden\" class=\"webbing\" name=\"webbing[48]\" value=\"\" readonly=\"readonly\" /></td>";

// Colours
echo"<td><input type=\"hidden\" class=\"colour\" name=\"colour[48]\" value=\"\" readonly=\"readonly\" /></td>";
     	
// Paint and Powder
echo"<td><input type=\"hidden\" name=\"paint[48]\" value=\"\" readonly=\"readonly\" /></td>";

// Unit of Measurement
echo "<td><input type=\"text\" name=\"uom[48]\" readonly=\"readonly\" value=\"".$vergola['uom']."\"></td>";	
}
else { echo " ";}
		}
// Unit Quantity
echo "<td><input type=\"text\" class=\"qtylen\" name=\"qty[48]\" value=\"{$getQty[48]}\"></td>";

// Length or Width
echo "<td><input type=\"hidden\" name=\"slength[48]\" value=\"{$getLength[48]}\" readonly=\"readonly\" /></td>";

// Total RRP
echo "<td><input type=\"text\" class=\"rrp\" readonly=\"readonly\" name=\"rrp[48]\" value=\"{$getRRP[48]}\"><input type=\"hidden\" class=\"cst\" name=\"cst[48]\" value=\"{$getCost[48]}\"></td></tr>";

// ***************************** Operator Motor ********************************************//
echo "<tr><td><input type=\"hidden\" name=\"id[49]\" value=\"{$getCFID[49]}\" />".$getDesc[49];
      	foreach($vergolas as $vergola) {
		if ($vergola['cf_id'] == $getID[49]) {  
		echo "<input type=\"hidden\" class=\"desc\" name=\"desc[49]\" value=\"".$vergola['description']."\" readonly=\"readonly\" />".
		"<input type=\"hidden\" class=\"invent\" name=\"invent[49]\" value=\"".$vergola['inventoryid']."\" readonly=\"readonly\" />".
		"<input type=\"hidden\" class=\"descrrp\" name=\"descrrp\" value=\"".$vergola['rrp']."\" readonly=\"readonly\" />".
        "<input type=\"hidden\" class=\"desccost\" name=\"desccost\" value=\"".$vergola['cost']."\" readonly=\"readonly\" /></td>";
		    
// Webbing
echo"<td><input type=\"hidden\" class=\"webbing\" name=\"webbing[49]\" value=\"\" readonly=\"readonly\" /></td>";

// Colours
echo"<td><input type=\"hidden\" class=\"colour\" name=\"colour[49]\" value=\"\" readonly=\"readonly\" /></td>";
     	
// Paint and Powder
echo"<td><input type=\"hidden\" name=\"paint[49]\" value=\"\" readonly=\"readonly\" /></td>";

// Unit of Measurement
echo "<td><input type=\"text\" name=\"uom[49]\" readonly=\"readonly\" value=\"".$vergola['uom']."\"></td>";	
}
else { echo " ";}
		}
// Unit Quantity
echo "<td><input type=\"text\" class=\"qtylen\" name=\"qty[49]\" value=\"{$getQty[49]}\"><input type=\"text\" id=\"motor\" name=\"motor\" value=\"{$getQty[49]}\" style=\"display:none;\"></td>";

// Length or Width
echo "<td><input type=\"hidden\" name=\"slength[49]\" value=\"{$getLength[49]}\" readonly=\"readonly\" /></td>";

// Total RRP
echo "<td><input type=\"text\" class=\"rrp\" readonly=\"readonly\" name=\"rrp[49]\" value=\"{$getRRP[49]}\"><input type=\"hidden\" class=\"cst\" name=\"cst[49]\" value=\"{$getCost[49]}\"></td></tr>";

// ***************************** Battery ********************************************//

echo "<tr><td><input type=\"hidden\" name=\"id[50]\" value=\"{$getCFID[50]}\" />".$getDesc[50];
      	foreach($vergolas as $vergola) {
		if ($vergola['cf_id'] == $getID[50]) {  
		echo "<input type=\"hidden\" class=\"desc\" name=\"desc[50]\" value=\"".$vergola['description']."\" readonly=\"readonly\" />".
		"<input type=\"hidden\" class=\"invent\" name=\"invent[50]\" value=\"".$vergola['inventoryid']."\" readonly=\"readonly\" />".
		"<input type=\"hidden\" class=\"descrrp\" name=\"descrrp\" value=\"".$vergola['rrp']."\" readonly=\"readonly\" />".
        "<input type=\"hidden\" class=\"desccost\" name=\"desccost\" value=\"".$vergola['cost']."\" readonly=\"readonly\" /></td>";
		    
// Webbing
echo"<td><input type=\"hidden\" class=\"webbing\" name=\"webbing[50]\" value=\"\" readonly=\"readonly\" /></td>";

// Colours
echo"<td><input type=\"hidden\" class=\"colour\" name=\"colour[50]\" value=\"\" readonly=\"readonly\" /></td>";
     	
// Paint and Powder
echo"<td><input type=\"hidden\" name=\"paint[50]\" value=\"\" readonly=\"readonly\" /></td>";

// Unit of Measurement
echo "<td><input type=\"text\" name=\"uom[50]\" readonly=\"readonly\" value=\"".$vergola['uom']."\"></td>";	
}
else { echo " ";}
		}
// Unit Quantity
echo "<td><input type=\"text\" class=\"qtylen\" name=\"qty[50]\" value=\"{$getQty[50]}\"></td>";

// Length or Width
echo "<td><input type=\"hidden\" name=\"slength[50]\" value=\"{$getLength[50]}\" readonly=\"readonly\" /></td>";

// Total RRP
echo "<td><input type=\"text\" class=\"rrp\" readonly=\"readonly\" name=\"rrp[50]\" value=\"{$getRRP[50]}\"><input type=\"hidden\" class=\"cst\" name=\"cst[50]\" value=\"{$getCost[50]}\"></td></tr>";
// ***************************** 1 to 6 Motor Rain ********************************************//
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
echo"<td><input type=\"hidden\" class=\"colour\" name=\"colour[51]\" value=\"\" readonly=\"readonly\" /></td>";
     	
// Paint and Powder
echo"<td><input type=\"hidden\" name=\"paint[51]\" value=\"\" readonly=\"readonly\" /></td>";

// Unit of Measurement
echo "<td><input type=\"text\" name=\"uom[51]\" readonly=\"readonly\" value=\"".$vergola['uom']."\"></td>";	
}
else { echo " ";}
		}
// Unit Quantity
echo "<td><input type=\"text\" class=\"qtylen\" name=\"qty[51]\" value=\"{$getQty[51]}\"></td>";

// Length or Width
echo "<td><input type=\"hidden\" name=\"slength[51]\" value=\"{$getLength[51]}\" readonly=\"readonly\" /></td>";

// Total RRP
echo "<td><input type=\"text\" class=\"rrp\" readonly=\"readonly\" name=\"rrp[51]\" value=\"{$getRRP[51]}\"><input type=\"hidden\" class=\"cst\" name=\"cst[51]\" value=\"{$getCost[51]}\"></td></tr>";
// ***************************** 7 to 8 Motor Rain ********************************************//
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
echo"<td><input type=\"hidden\" class=\"colour\" name=\"colour[52]\" value=\"\" readonly=\"readonly\" /></td>";
     	
// Paint and Powder
echo"<td><input type=\"hidden\" name=\"paint[52]\" value=\"\" readonly=\"readonly\" /></td>";

// Unit of Measurement
echo "<td><input type=\"text\" name=\"uom[52]\" readonly=\"readonly\" value=\"".$vergola['uom']."\"></td>";	
}
else { echo " ";}
		}
// Unit Quantity
echo "<td><input type=\"text\" class=\"qtylen\" name=\"qty[52]\" value=\"{$getQty[52]}\"></td>";

// Length or Width
echo "<td><input type=\"hidden\" name=\"slength[52]\" value=\"{$getLength[52]}\" readonly=\"readonly\" /></td>";

// Total RRP
echo "<td><input type=\"text\" class=\"rrp\" readonly=\"readonly\" name=\"rrp[52]\" value=\"{$getRRP[52]}\"><input type=\"hidden\" class=\"cst\" name=\"cst[52]\" value=\"{$getCost[52]}\"></td></tr>";

?>