<?php 
// ***************************** Louvres Poly or Square ********************************************//
echo "<tr><td colspan=\"8\" class=\"subheading\">Vergola System</td></tr>";
echo "<tr><td><input type=\"hidden\" name=\"id[28]\" value=\"{$getCFID[28]}\" /><select class=\"desclist\" name=\"desclist[]\" >";
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
		if($louvre['cf_id'] == $getID[28]) {
		echo "selected=\"selected\""; 
		} else {echo "";}
		echo ">".$louvre['description']."</option>";	
		}
echo "</select>";
    
	 foreach($louvres as $louvre){
     if ($louvre['cf_id'] == $getID[28]) {
	 echo "<input type=\"hidden\" class=\"desc\" name=\"desc[28]\" value=\"".$louvre['description']."\" />".
     "<input type=\"hidden\" class=\"invent\" name=\"invent[28]\" value=\"".$louvre['inventoryid']."\" />".
     "<input type=\"hidden\" class=\"descrrp\" name=\"descrrp\" value=\"".$louvre['rrp']."\" />".
     "<input type=\"hidden\" class=\"desccost\" name=\"desccost\" value=\"".$louvre['cost']."\"/>"; }
	 else {echo "";}
	 } 
	 echo "</td>";
	 
// Webbing
echo"<td><input type=\"hidden\" class=\"webbing\" name=\"webbing[28]\" value=\"\" readonly=\"readonly\" /></td>";

// Colours
echo "<td><select name=\"colour[28]\">";
        foreach($colours as $colour) {
      	echo "<option value=\"".$colour."\"";
		if($colour == $getColour[28]){ echo "selected=\"selected\""; 
		} else {echo "";}
		echo ">".$colour."</option>";
		}
echo"</select></td>";

// Paint and Powder
echo "<td><select class=\"paint-list\" name=\"paintselect\" >";  
	    foreach($paints as $paint) {
      	echo "<option value=\"".$paint['cf_id']."\""; 
		if($paint['category'] == $getFinish[28]){ echo "selected=\"selected\"";
		} else {echo "";}
		echo">".$paint['category']."</option>";	
		}
echo "</select>";
foreach($paints as $paint) {
if($paint['category'] == $getFinish[28]){
echo "<input type=\"hidden\" class=\"paintdesc\" name=\"paint[28]\" value=\"".$paint['category']."\" readonly=\"readonly\" />".
     "<input type=\"hidden\" class=\"paintrrp\" name=\"paintrrp[]\" value=\"".$paint['rrp']."\" readonly=\"readonly\" />".
     "<input type=\"hidden\" class=\"paintcost\" name=\"paintcost[]\" value=\"".$paint['cost']."\" readonly=\"readonly\" />";
} else {echo "";}
}
	 echo "</td>";

// Unit of Measurement
echo "<td><input type=\"text\" name=\"uom[28]\" readonly=\"readonly\" value=\"{$getUOM[28]}\"></td>";

// Unit Quantity
echo "<td><input type=\"text\" class=\"qtylen\" name=\"qty[28]\" value=\"{$getQty[28]}\"></td>";

// Length or Width
echo "<td><input type=\"text\" class=\"width\" name=\"slength[28]\" value=\"{$getLength[28]}\"></td>";

// Total RRP
echo "<td><input type=\"text\" class=\"rrp\" readonly=\"readonly\" name=\"rrp[28]\" value=\"{$getRRP[28]}\"><input type=\"hidden\" class=\"cst\" name=\"cst[28]\" value=\"{$getCost[28]}\"></td></tr>";

// ***************************** Endcap ********************************************//
echo "<tr><td><input type=\"hidden\" name=\"id[29]\" value=\"{$getCFID[29]}\" />".$getDesc[29];
        $vergolas = array();
		while ($vergola = mysql_fetch_array($resultvergola)) {
		$vergolas[] = $vergola; 	}	
      	foreach($vergolas as $vergola) {
		if ($vergola['cf_id'] == $getID[29]) {  
		echo "<input type=\"hidden\" class=\"desc\" name=\"desc[29]\" value=\"".$vergola['description']."\" readonly=\"readonly\" />".
		"<input type=\"hidden\" class=\"invent\" name=\"invent[29]\" value=\"".$vergola['inventoryid']."\" readonly=\"readonly\" />".
		"<input type=\"hidden\" class=\"descrrp\" name=\"descrrp\" value=\"".$vergola['rrp']."\" readonly=\"readonly\" />".
        "<input type=\"hidden\" class=\"desccost\" name=\"desccost\" value=\"".$vergola['cost']."\" readonly=\"readonly\" /></td>";
		
	
// Webbing
echo"<td><input type=\"hidden\" class=\"webbing\" name=\"webbing[29]\" value=\"\" readonly=\"readonly\" /></td>";   

// Colours
echo "<td><select name=\"colour[29]\">";
        foreach($colours as $colour) {
      	echo "<option value=\"".$colour."\"";
		if($colour == $getColour[29]){ echo "selected=\"selected\""; 
		} else {echo "";}
		echo ">".$colour."</option>";
		}
echo"</select></td>";

// Paint and Powder
echo "<td><select class=\"paint-list\" name=\"paintselect\" >";  
	    foreach($paints as $paint) {
      	echo "<option value=\"".$paint['cf_id']."\""; 
		if($paint['category'] == $getFinish[29]){ echo "selected=\"selected\"";
		} else {echo "";}
		echo">".$paint['category']."</option>";	
		}
echo "</select>";
foreach($paints as $paint) {
if($paint['category'] == $getFinish[29]){
echo "<input type=\"hidden\" class=\"paintdesc\" name=\"paint[29]\" value=\"".$paint['category']."\" readonly=\"readonly\" />".
     "<input type=\"hidden\" class=\"paintrrp\" name=\"paintrrp[]\" value=\"".$paint['rrp']."\" readonly=\"readonly\" />".
     "<input type=\"hidden\" class=\"paintcost\" name=\"paintcost[]\" value=\"".$paint['cost']."\" readonly=\"readonly\" />";
} else {echo "";}
}
	 echo "</td>";

// Unit of Measurement
echo "<td><input type=\"text\" name=\"uom[29]\" readonly=\"readonly\" value=\"{$getUOM[29]}\"></td>"; }
else { echo " ";}
		}
// Unit Quantity
echo "<td><input type=\"text\" class=\"qtylen\" name=\"qty[29]\" value=\"{$getQty[29]}\"></td>";

// Length or Width
echo "<td><input type=\"hidden\" name=\"slength[29]\" value=\"{$getLength[29]}\"></td>";

// Total RRP
echo "<td><input type=\"text\" class=\"rrp\" readonly=\"readonly\" name=\"rrp[29]\" value=\"{$getRRP[29]}\"><input type=\"hidden\" class=\"cst\" name=\"cst[29]\" value=\"{$getCost[29]}\"></td></tr>";

// ***************************** Pivot Strip ********************************************//
echo "<tr><td><input type=\"hidden\" name=\"id[30]\" value=\"{$getCFID[30]}\" />".$getDesc[30];
      	foreach($vergolas as $vergola) {
		if ($vergola['cf_id'] == $getID[30]) {  
		echo "<input type=\"hidden\" class=\"desc\" name=\"desc[30]\" value=\"".$vergola['description']."\" readonly=\"readonly\" />".
		"<input type=\"hidden\" class=\"invent\" name=\"invent[30]\" value=\"".$vergola['inventoryid']."\" readonly=\"readonly\" />".
		"<input type=\"hidden\" class=\"descrrp\" name=\"descrrp\" value=\"".$vergola['rrp']."\" readonly=\"readonly\" />".
        "<input type=\"hidden\" class=\"desccost\" name=\"desccost\" value=\"".$vergola['cost']."\" readonly=\"readonly\" /></td>";
		
	
// Webbing
echo"<td><input type=\"hidden\" class=\"webbing\" name=\"webbing[30]\" value=\"\" readonly=\"readonly\" /></td>";   

// Colours
echo "<td><select name=\"colour[30]\">";
        foreach($colours as $colour) {
      	echo "<option value=\"".$colour."\"";
		if($colour == $getColour[30]){ echo "selected=\"selected\""; 
		} else {echo "";}
		echo ">".$colour."</option>";
		}
echo"</select></td>";

// Paint and Powder
echo "<td><select class=\"paint-list\" name=\"paintselect\" >";  
	    foreach($paints as $paint) {
      	echo "<option value=\"".$paint['cf_id']."\""; 
		if($paint['category'] == $getFinish[30]){ echo "selected=\"selected\"";
		} else {echo "";}
		echo">".$paint['category']."</option>";	
		}
echo "</select>";
foreach($paints as $paint) {
if($paint['category'] == $getFinish[30]){
echo "<input type=\"hidden\" class=\"paintdesc\" name=\"paint[30]\" value=\"".$paint['category']."\" readonly=\"readonly\" />".
     "<input type=\"hidden\" class=\"paintrrp\" name=\"paintrrp[]\" value=\"".$paint['rrp']."\" readonly=\"readonly\" />".
     "<input type=\"hidden\" class=\"paintcost\" name=\"paintcost[]\" value=\"".$paint['cost']."\" readonly=\"readonly\" />";
} else {echo "";}
}
	 echo "</td>";

// Unit of Measurement
echo "<td><input type=\"text\" name=\"uom[30]\" readonly=\"readonly\" value=\"{$getUOM[30]}\"></td>"; }
else { echo " ";}
		}
// Unit Quantity
echo "<td><input type=\"text\" class=\"qtylen\" name=\"qty[30]\" value=\"{$getQty[30]}\"></td>";

// Length or Width
echo "<td><input type=\"hidden\" name=\"slength[30]\" value=\"{$getLength[30]}\"></td>";

// Total RRP
echo "<td><input type=\"text\" class=\"rrp\" readonly=\"readonly\" name=\"rrp[30]\" value=\"{$getRRP[30]}\"><input type=\"hidden\" class=\"cst\" name=\"cst[30]\" value=\"{$getCost[30]}\"></td></tr>";
// ***************************** Link Bar ********************************************//
echo "<tr><td><input type=\"hidden\" name=\"id[31]\" value=\"{$getCFID[31]}\" />".$getDesc[31];
      	foreach($vergolas as $vergola) {
		if ($vergola['cf_id'] == $getID[31]) {  
		echo "<input type=\"hidden\" class=\"desc\" name=\"desc[31]\" value=\"".$vergola['description']."\" readonly=\"readonly\" />".
		"<input type=\"hidden\" class=\"invent\" name=\"invent[31]\" value=\"".$vergola['inventoryid']."\" readonly=\"readonly\" />".
		"<input type=\"hidden\" class=\"descrrp\" name=\"descrrp\" value=\"".$vergola['rrp']."\" readonly=\"readonly\" />".
        "<input type=\"hidden\" class=\"desccost\" name=\"desccost\" value=\"".$vergola['cost']."\" readonly=\"readonly\" /></td>";
		
	
// Webbing
echo"<td><input type=\"hidden\" class=\"webbing\" name=\"webbing[31]\" value=\"\" readonly=\"readonly\" /></td>";   

// Colours
echo "<td><select name=\"colour[31]\">";
        foreach($colours as $colour) {
      	echo "<option value=\"".$colour."\"";
		if($colour == $getColour[31]){ echo "selected=\"selected\""; 
		} else {echo "";}
		echo ">".$colour."</option>";
		}
echo"</select></td>";

// Paint and Powder
echo "<td><select class=\"paint-list\" name=\"paintselect\" >";  
	    foreach($paints as $paint) {
      	echo "<option value=\"".$paint['cf_id']."\""; 
		if($paint['category'] == $getFinish[31]){ echo "selected=\"selected\"";
		} else {echo "";}
		echo">".$paint['category']."</option>";	
		}
echo "</select>";
foreach($paints as $paint) {
if($paint['category'] == $getFinish[31]){
echo "<input type=\"hidden\" class=\"paintdesc\" name=\"paint[31]\" value=\"".$paint['category']."\" readonly=\"readonly\" />".
     "<input type=\"hidden\" class=\"paintrrp\" name=\"paintrrp[]\" value=\"".$paint['rrp']."\" readonly=\"readonly\" />".
     "<input type=\"hidden\" class=\"paintcost\" name=\"paintcost[]\" value=\"".$paint['cost']."\" readonly=\"readonly\" />";
} else {echo "";}
}
	 echo "</td>";

// Unit of Measurement
echo "<td><input type=\"text\" name=\"uom[31]\" readonly=\"readonly\" value=\"{$getUOM[31]}\"></td>"; }
else { echo " ";}
		}
// Unit Quantity
echo "<td><input type=\"text\" class=\"qtylen\" name=\"qty[31]\" value=\"{$getQty[31]}\"></td>";

// Length or Width
echo "<td><input type=\"hidden\" name=\"slength[31]\" value=\"{$getLength[31]}\"></td>";

// Total RRP
echo "<td><input type=\"text\" class=\"rrp\" readonly=\"readonly\" name=\"rrp[31]\" value=\"{$getRRP[31]}\"><input type=\"hidden\" class=\"cst\" name=\"cst[31]\" value=\"{$getCost[31]}\"></td></tr>";

// ***************************** Adjustable Angled Bracket ********************************************//
echo "<tr><td><input type=\"hidden\" name=\"id[32]\" value=\"{$getCFID[32]}\" />".$getDesc[32];
      	foreach($vergolas as $vergola) {
		if ($vergola['cf_id'] == $getID[32]) {  
		echo "<input type=\"hidden\" class=\"desc\" name=\"desc[32]\" value=\"".$vergola['description']."\" readonly=\"readonly\" />".
		"<input type=\"hidden\" class=\"invent\" name=\"invent[32]\" value=\"".$vergola['inventoryid']."\" readonly=\"readonly\" />".
		"<input type=\"hidden\" class=\"descrrp\" name=\"descrrp\" value=\"".$vergola['rrp']."\" readonly=\"readonly\" />".
        "<input type=\"hidden\" class=\"desccost\" name=\"desccost\" value=\"".$vergola['cost']."\" readonly=\"readonly\" /></td>";
		    
// Webbing
echo"<td><input type=\"hidden\" class=\"webbing\" name=\"webbing[32]\" value=\"\" readonly=\"readonly\" /></td>";

// Colours
echo"<td><input type=\"hidden\" class=\"colour\" name=\"colour[32]\" value=\"\" readonly=\"readonly\" /></td>";
     	
// Paint and Powder
echo"<td><input type=\"hidden\" name=\"paint[32]\" value=\"\" readonly=\"readonly\" /></td>";

// Unit of Measurement
echo "<td><input type=\"text\" name=\"uom[32]\" readonly=\"readonly\" value=\"".$vergola['uom']."\"></td>";	
}
else { echo " ";}
		}
// Unit Quantity
echo "<td><input type=\"text\" class=\"qtylen\" name=\"qty[32]\" value=\"{$getQty[32]}\"></td>";

// Length or Width
echo "<td><input type=\"hidden\" name=\"slength[32]\" value=\"{$getLength[32]}\" readonly=\"readonly\" /></td>";

// Total RRP
echo "<td><input type=\"text\" class=\"rrp\" readonly=\"readonly\" name=\"rrp[32]\" value=\"{$getRRP[32]}\"><input type=\"hidden\" class=\"cst\" name=\"cst[32]\" value=\"{$getCost[32]}\"></td></tr>";

// ***************************** Operator Motor ********************************************//
echo "<tr><td><input type=\"hidden\" name=\"id[33]\" value=\"{$getCFID[33]}\" />".$getDesc[33];
      	foreach($vergolas as $vergola) {
		if ($vergola['cf_id'] == $getID[33]) {  
		echo "<input type=\"hidden\" class=\"desc\" name=\"desc[33]\" value=\"".$vergola['description']."\" readonly=\"readonly\" />".
		"<input type=\"hidden\" class=\"invent\" name=\"invent[33]\" value=\"".$vergola['inventoryid']."\" readonly=\"readonly\" />".
		"<input type=\"hidden\" class=\"descrrp\" name=\"descrrp\" value=\"".$vergola['rrp']."\" readonly=\"readonly\" />".
        "<input type=\"hidden\" class=\"desccost\" name=\"desccost\" value=\"".$vergola['cost']."\" readonly=\"readonly\" /></td>";
		    
// Webbing
echo"<td><input type=\"hidden\" class=\"webbing\" name=\"webbing[33]\" value=\"\" readonly=\"readonly\" /></td>";

// Colours
echo"<td><input type=\"hidden\" class=\"colour\" name=\"colour[33]\" value=\"\" readonly=\"readonly\" /></td>";
     	
// Paint and Powder
echo"<td><input type=\"hidden\" name=\"paint[33]\" value=\"\" readonly=\"readonly\" /></td>";

// Unit of Measurement
echo "<td><input type=\"text\" name=\"uom[33]\" readonly=\"readonly\" value=\"".$vergola['uom']."\"></td>";	
}
else { echo " ";}
		}
// Unit Quantity
echo "<td><input type=\"text\" class=\"qtylen\" name=\"qty[33]\" value=\"{$getQty[33]}\"><input type=\"text\" id=\"motor\" name=\"motor\" value=\"{$getQty[33]}\" style=\"display:none;\"></td>";

// Length or Width
echo "<td><input type=\"hidden\" name=\"slength[33]\" value=\"{$getLength[33]}\" readonly=\"readonly\" /></td>";

// Total RRP
echo "<td><input type=\"text\" class=\"rrp\" readonly=\"readonly\" name=\"rrp[33]\" value=\"{$getRRP[33]}\"><input type=\"hidden\" class=\"cst\" name=\"cst[33]\" value=\"{$getCost[33]}\"></td></tr>";

// ***************************** Battery ********************************************//

echo "<tr><td><input type=\"hidden\" name=\"id[34]\" value=\"{$getCFID[34]}\" />".$getDesc[34];
      	foreach($vergolas as $vergola) {
		if ($vergola['cf_id'] == $getID[34]) {  
		echo "<input type=\"hidden\" class=\"desc\" name=\"desc[34]\" value=\"".$vergola['description']."\" readonly=\"readonly\" />".
		"<input type=\"hidden\" class=\"invent\" name=\"invent[34]\" value=\"".$vergola['inventoryid']."\" readonly=\"readonly\" />".
		"<input type=\"hidden\" class=\"descrrp\" name=\"descrrp\" value=\"".$vergola['rrp']."\" readonly=\"readonly\" />".
        "<input type=\"hidden\" class=\"desccost\" name=\"desccost\" value=\"".$vergola['cost']."\" readonly=\"readonly\" /></td>";
		    
// Webbing
echo"<td><input type=\"hidden\" class=\"webbing\" name=\"webbing[34]\" value=\"\" readonly=\"readonly\" /></td>";

// Colours
echo"<td><input type=\"hidden\" class=\"colour\" name=\"colour[34]\" value=\"\" readonly=\"readonly\" /></td>";
     	
// Paint and Powder
echo"<td><input type=\"hidden\" name=\"paint[34]\" value=\"\" readonly=\"readonly\" /></td>";

// Unit of Measurement
echo "<td><input type=\"text\" name=\"uom[34]\" readonly=\"readonly\" value=\"".$vergola['uom']."\"></td>";	
}
else { echo " ";}
		}
// Unit Quantity
echo "<td><input type=\"text\" class=\"qtylen\" name=\"qty[34]\" value=\"{$getQty[34]}\"></td>";

// Length or Width
echo "<td><input type=\"hidden\" name=\"slength[34]\" value=\"{$getLength[34]}\" readonly=\"readonly\" /></td>";

// Total RRP
echo "<td><input type=\"text\" class=\"rrp\" readonly=\"readonly\" name=\"rrp[34]\" value=\"{$getRRP[34]}\"><input type=\"hidden\" class=\"cst\" name=\"cst[34]\" value=\"{$getCost[34]}\"></td></tr>";
// ***************************** 1 to 6 Motor Rain ********************************************//
echo "<tr><td><input type=\"hidden\" name=\"id[35]\" value=\"{$getCFID[35]}\" />".$getDesc[35];
      	foreach($vergolas as $vergola) {
		if ($vergola['cf_id'] == $getID[35]) {  
		echo "<input type=\"hidden\" class=\"desc\" name=\"desc[35]\" value=\"".$vergola['description']."\" readonly=\"readonly\" />".
		"<input type=\"hidden\" class=\"invent\" name=\"invent[35]\" value=\"".$vergola['inventoryid']."\" readonly=\"readonly\" />".
		"<input type=\"hidden\" class=\"descrrp\" name=\"descrrp\" value=\"".$vergola['rrp']."\" readonly=\"readonly\" />".
        "<input type=\"hidden\" class=\"desccost\" name=\"desccost\" value=\"".$vergola['cost']."\" readonly=\"readonly\" /></td>";
		    
// Webbing
echo"<td><input type=\"hidden\" class=\"webbing\" name=\"webbing[35]\" value=\"\" readonly=\"readonly\" /></td>";

// Colours
echo"<td><input type=\"hidden\" class=\"colour\" name=\"colour[35]\" value=\"\" readonly=\"readonly\" /></td>";
     	
// Paint and Powder
echo"<td><input type=\"hidden\" name=\"paint[35]\" value=\"\" readonly=\"readonly\" /></td>";

// Unit of Measurement
echo "<td><input type=\"text\" name=\"uom[35]\" readonly=\"readonly\" value=\"".$vergola['uom']."\"></td>";	
}
else { echo " ";}
		}
// Unit Quantity
echo "<td><input type=\"text\" class=\"qtylen\" name=\"qty[35]\" value=\"{$getQty[35]}\"></td>";

// Length or Width
echo "<td><input type=\"hidden\" name=\"slength[35]\" value=\"{$getLength[35]}\" readonly=\"readonly\" /></td>";

// Total RRP
echo "<td><input type=\"text\" class=\"rrp\" readonly=\"readonly\" name=\"rrp[35]\" value=\"{$getRRP[35]}\"><input type=\"hidden\" class=\"cst\" name=\"cst[35]\" value=\"{$getCost[35]}\"></td></tr>";
// ***************************** 7 to 8 Motor Rain ********************************************//
echo "<tr><td><input type=\"hidden\" name=\"id[36]\" value=\"{$getCFID[36]}\" />".$getDesc[36];
      	foreach($vergolas as $vergola) {
		if ($vergola['cf_id'] == $getID[36]) {  
		echo "<input type=\"hidden\" class=\"desc\" name=\"desc[36]\" value=\"".$vergola['description']."\" readonly=\"readonly\" />".
		"<input type=\"hidden\" class=\"invent\" name=\"invent[36]\" value=\"".$vergola['inventoryid']."\" readonly=\"readonly\" />".
		"<input type=\"hidden\" class=\"descrrp\" name=\"descrrp\" value=\"".$vergola['rrp']."\" readonly=\"readonly\" />".
        "<input type=\"hidden\" class=\"desccost\" name=\"desccost\" value=\"".$vergola['cost']."\" readonly=\"readonly\" /></td>";
		    
// Webbing
echo"<td><input type=\"hidden\" class=\"webbing\" name=\"webbing[36]\" value=\"\" readonly=\"readonly\" /></td>";

// Colours
echo"<td><input type=\"hidden\" class=\"colour\" name=\"colour[36]\" value=\"\" readonly=\"readonly\" /></td>";
     	
// Paint and Powder
echo"<td><input type=\"hidden\" name=\"paint[36]\" value=\"\" readonly=\"readonly\" /></td>";

// Unit of Measurement
echo "<td><input type=\"text\" name=\"uom[36]\" readonly=\"readonly\" value=\"".$vergola['uom']."\"></td>";	
}
else { echo " ";}
		}
// Unit Quantity
echo "<td><input type=\"text\" class=\"qtylen\" name=\"qty[36]\" value=\"{$getQty[36]}\"></td>";

// Length or Width
echo "<td><input type=\"hidden\" name=\"slength[36]\" value=\"{$getLength[36]}\" readonly=\"readonly\" /></td>";

// Total RRP
echo "<td><input type=\"text\" class=\"rrp\" readonly=\"readonly\" name=\"rrp[36]\" value=\"{$getRRP[36]}\"><input type=\"hidden\" class=\"cst\" name=\"cst[36]\" value=\"{$getCost[36]}\"></td></tr>";
// ***************************** Opaque Enclosure ********************************************//
echo "<tr><td colspan=\"8\" class=\"subheading\">Misc Items</td></tr>";
echo "<tr><td><input type=\"hidden\" name=\"id[37]\" value=\"{$getCFID[37]}\" />".$getDesc[37];
      	foreach($vergolas as $vergola) {
		if ($vergola['cf_id'] == $getID[37]) {  
		echo "<input type=\"hidden\" class=\"desc\" name=\"desc[37]\" value=\"".$vergola['description']."\" readonly=\"readonly\" />".
		"<input type=\"hidden\" class=\"invent\" name=\"invent[37]\" value=\"".$vergola['inventoryid']."\" readonly=\"readonly\" />".
		"<input type=\"hidden\" class=\"descrrp\" name=\"descrrp\" value=\"".$vergola['rrp']."\" readonly=\"readonly\" />".
        "<input type=\"hidden\" class=\"desccost\" name=\"desccost\" value=\"".$vergola['cost']."\" readonly=\"readonly\" /></td>";
		    
// Webbing
echo"<td><input type=\"hidden\" class=\"webbing\" name=\"webbing[37]\" value=\"\" readonly=\"readonly\" /></td>";

// Colours
echo"<td><input type=\"hidden\" class=\"colour\" name=\"colour[37]\" value=\"\" readonly=\"readonly\" /></td>";
     	
// Paint and Powder
echo"<td><input type=\"hidden\" name=\"paint[37]\" value=\"\" readonly=\"readonly\" /></td>";

// Unit of Measurement
echo "<td><input type=\"text\" name=\"uom[37]\" readonly=\"readonly\" value=\"".$vergola['uom']."\"></td>";	
}
else { echo " ";}
		}
// Unit Quantity
echo "<td><input type=\"text\" class=\"qtylen\" name=\"qty[37]\" value=\"{$getQty[37]}\"></td>";

// Length or Width
echo "<td><input type=\"hidden\" name=\"slength[37]\" value=\"{$getLength[37]}\" readonly=\"readonly\" /></td>";

// Total RRP
echo "<td><input type=\"text\" class=\"rrp\" readonly=\"readonly\" name=\"rrp[37]\" value=\"{$getRRP[37]}\"><input type=\"hidden\" class=\"cst\" name=\"cst[37]\" value=\"{$getCost[37]}\"></td></tr>";
?>