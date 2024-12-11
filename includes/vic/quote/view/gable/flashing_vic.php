<?php 
// ***************************** Cbeam Face Flashing Z al ********************************************//
echo "<tr><td colspan=\"8\" class=\"subheading\">Flashing</td></tr>";
echo "<tr><td><input type=\"hidden\" name=\"id[33]\" value=\"{$getCFID[33]}\" />".$getDesc[33];
        $flashs = array();
		while ($flash = mysql_fetch_array($resultflash)){
		$flashs[] = $flash; }	
		
		foreach($flashs as $flash) {
		if ($flash['cf_id'] == $getID[33]) {     		
		echo "<input type=\"hidden\" class=\"desc\" name=\"desc[33]\" value=\"".$flash['description']."\" readonly=\"readonly\" />".
		"<input type=\"hidden\" class=\"invent\" name=\"invent[33]\" value=\"".$flash['inventoryid']."\" readonly=\"readonly\" />".
		"<input type=\"hidden\" class=\"descrrp\" name=\"descrrp\" value=\"".$flash['rrp']."\" readonly=\"readonly\" />".
        "<input type=\"hidden\" class=\"desccost\" name=\"desccost\" value=\"".$flash['cost']."\" readonly=\"readonly\" /></td>"; 

// Webbing
echo"<td><input type=\"hidden\" class=\"webbing\" name=\"webbing[33]\" value=\"\" readonly=\"readonly\" /></td>";   

// Colours
echo "<td><select name=\"colour[33]\">";
        foreach($colours as $colour){
      	echo "<option value=\"".$colour."\"";
		if($colour == $getColour[33]){echo "selected=\"selected\""; 
		} else {echo "";}
		echo ">".$colour."</option>";
		}	 	
echo"</select></td>";

// Paint and Powder
echo "<td><select class=\"paint-list\" name=\"paintselect\" >";  
	    foreach($paints as $paint){
      	echo "<option value=\"".$paint['cf_id']."\""; 
		if($paint['category'] == $getFinish[33]){ echo "selected=\"selected\"";
		} else {echo "";}
		echo">".$paint['category']."</option>";	
		}
echo "</select>";
foreach($paints as $paint){
if($paint['category'] == $getFinish[33]){
echo "<input type=\"hidden\" class=\"paintdesc\" name=\"paint[33]\" value=\"".$paint['category']."\" readonly=\"readonly\" />".
     "<input type=\"hidden\" class=\"paintrrp\" name=\"paintrrp[]\" value=\"".$paint['rrp']."\" readonly=\"readonly\" />".
     "<input type=\"hidden\" class=\"paintcost\" name=\"paintcost[]\" value=\"".$paint['cost']."\" readonly=\"readonly\" />";
} else {echo "";}
}
	 echo "</td>";

// Unit of Measurement
echo "<td><input type=\"text\" name=\"uom[33]\" readonly=\"readonly\" value=\"".$flash['uom']."\"></td>";
}
else { echo " ";}
		}

// Unit Quantity	
echo "<td><input type=\"text\" class=\"qtylen\" name=\"qty[33]\" value=\"{$getQty[33]}\"></td>";

// Length or Width
echo "<td><input type=\"text\" class=\"xlength\" name=\"slength[33]\" value=\"{$getLength[33]}\" /></td>";


// Total RRP
echo "<td><input type=\"text\" class=\"rrp\" readonly=\"readonly\" name=\"rrp[33]\" value=\"{$getRRP[33]}\"><input type=\"hidden\" class=\"cst\" name=\"cst[33]\" value=\"{$getCost[33]}\"></td></tr>";

// ***************************** Adaptor Flashing Cbd ********************************************//
echo "<tr><td><input type=\"hidden\" name=\"id[34]\" value=\"{$getCFID[34]}\" />".$getDesc[34];
       	foreach($flashs as $flash) {
		if ($flash['cf_id'] == $getID[34]) {     		
		echo "<input type=\"hidden\" class=\"desc\" name=\"desc[34]\" value=\"".$flash['description']."\" readonly=\"readonly\" />".
		"<input type=\"hidden\" class=\"invent\" name=\"invent[34]\" value=\"".$flash['inventoryid']."\" readonly=\"readonly\" />".
		"<input type=\"hidden\" class=\"descrrp\" name=\"descrrp\" value=\"".$flash['rrp']."\" readonly=\"readonly\" />".
        "<input type=\"hidden\" class=\"desccost\" name=\"desccost\" value=\"".$flash['cost']."\" readonly=\"readonly\" /></td>"; 

// Webbing
echo"<td><input type=\"hidden\" class=\"webbing\" name=\"webbing[34]\" value=\"\" readonly=\"readonly\" /></td>";   

// Colours
echo "<td><select name=\"colour[34]\">";
        foreach($colours as $colour){
      	echo "<option value=\"".$colour."\"";
		if($colour == $getColour[34]){echo "selected=\"selected\""; 
		} else {echo "";}
		echo ">".$colour."</option>";
		}	 	
echo"</select></td>";

// Paint and Powder
echo "<td><select class=\"paint-list\" name=\"paintselect\" >";  
	    foreach($paints as $paint){
      	echo "<option value=\"".$paint['cf_id']."\""; 
		if($paint['category'] == $getFinish[34]){ echo "selected=\"selected\"";
		} else {echo "";}
		echo">".$paint['category']."</option>";	
		}
echo "</select>";
foreach($paints as $paint){
if($paint['category'] == $getFinish[34]){
echo "<input type=\"hidden\" class=\"paintdesc\" name=\"paint[34]\" value=\"".$paint['category']."\" readonly=\"readonly\" />".
     "<input type=\"hidden\" class=\"paintrrp\" name=\"paintrrp[]\" value=\"".$paint['rrp']."\" readonly=\"readonly\" />".
     "<input type=\"hidden\" class=\"paintcost\" name=\"paintcost[]\" value=\"".$paint['cost']."\" readonly=\"readonly\" />";
} else {echo "";}
}
	 echo "</td>";

// Unit of Measurement
echo "<td><input type=\"text\" name=\"uom[34]\" readonly=\"readonly\" value=\"".$flash['uom']."\"></td>";
}
else { echo " ";}
		}

// Unit Quantity	
echo "<td><input type=\"text\" class=\"qtylen\" name=\"qty[34]\" value=\"{$getQty[34]}\"></td>";

// Length or Width
echo "<td><input type=\"text\" class=\"xlength\" name=\"slength[34]\" value=\"{$getLength[34]}\" /></td>";


// Total RRP
echo "<td><input type=\"text\" class=\"rrp\" readonly=\"readonly\" name=\"rrp[34]\" value=\"{$getRRP[34]}\"><input type=\"hidden\" class=\"cst\" name=\"cst[34]\" value=\"{$getCost[34]}\"></td></tr>";

// ***************************** Flashing Fascia ********************************************//
echo "<tr><td><input type=\"hidden\" name=\"id[35]\" value=\"{$getCFID[35]}\" />".$getDesc[35];
       	foreach($flashs as $flash) {
		if ($flash['cf_id'] == $getID[35]) {     		
		echo "<input type=\"hidden\" class=\"desc\" name=\"desc[35]\" value=\"".$flash['description']."\" readonly=\"readonly\" />".
		"<input type=\"hidden\" class=\"invent\" name=\"invent[35]\" value=\"".$flash['inventoryid']."\" readonly=\"readonly\" />".
		"<input type=\"hidden\" class=\"descrrp\" name=\"descrrp\" value=\"".$flash['rrp']."\" readonly=\"readonly\" />".
        "<input type=\"hidden\" class=\"desccost\" name=\"desccost\" value=\"".$flash['cost']."\" readonly=\"readonly\" /></td>"; 

// Webbing
echo"<td><input type=\"hidden\" class=\"webbing\" name=\"webbing[35]\" value=\"\" readonly=\"readonly\" /></td>";   

// Colours
echo "<td><select name=\"colour[35]\">";
        foreach($colours as $colour){
      	echo "<option value=\"".$colour."\"";
		if($colour == $getColour[35]){echo "selected=\"selected\""; 
		} else {echo "";}
		echo ">".$colour."</option>";
		}	 	
echo"</select></td>";

// Paint and Powder
echo "<td><select class=\"paint-list\" name=\"paintselect\" >";  
	    foreach($paints as $paint){
      	echo "<option value=\"".$paint['cf_id']."\""; 
		if($paint['category'] ==$getFinish[35]){ echo "selected=\"selected\"";
		} else {echo "";}
		echo">".$paint['category']."</option>";	
		}
echo "</select>";
foreach($paints as $paint){
if($paint['category'] == $getFinish[35]){
echo "<input type=\"hidden\" class=\"paintdesc\" name=\"paint[35]\" value=\"".$paint['category']."\" readonly=\"readonly\" />".
     "<input type=\"hidden\" class=\"paintrrp\" name=\"paintrrp[]\" value=\"".$paint['rrp']."\" readonly=\"readonly\" />".
     "<input type=\"hidden\" class=\"paintcost\" name=\"paintcost[]\" value=\"".$paint['cost']."\" readonly=\"readonly\" />";
} else {echo "";}
}
	 echo "</td>";

// Unit of Measurement
echo "<td><input type=\"text\" name=\"uom[35]\" readonly=\"readonly\" value=\"".$flash['uom']."\"></td>";
}
else { echo " ";}
		}

// Unit Quantity	
echo "<td><input type=\"text\" class=\"qtylen\" name=\"qty[35]\" value=\"{$getQty[35]}\"></td>";

// Length or Width
echo "<td><input type=\"text\" class=\"xlength\" name=\"slength[35]\" value=\"{$getLength[35]}\" /></td>";


// Total RRP
echo "<td><input type=\"text\" class=\"rrp\" readonly=\"readonly\" name=\"rrp[35]\" value=\"{$getRRP[35]}\"><input type=\"hidden\" class=\"cst\" name=\"cst[35]\" value=\"{$getCost[35]}\"></td></tr>";

// ***************************** Flashing (Perimeter of Cbeam) ********************************************//
echo "<tr><td><input type=\"hidden\" name=\"id[36]\" value=\"{$getCFID[36]}\" />".$getDesc[36];
       	foreach($flashs as $flash) {
		if ($flash['cf_id'] == $getID[36]) {     		
		echo "<input type=\"hidden\" class=\"desc\" name=\"desc[36]\" value=\"".$flash['description']."\" readonly=\"readonly\" />".
		"<input type=\"hidden\" class=\"invent\" name=\"invent[36]\" value=\"".$flash['inventoryid']."\" readonly=\"readonly\" />".
		"<input type=\"hidden\" class=\"descrrp\" name=\"descrrp\" value=\"".$flash['rrp']."\" readonly=\"readonly\" />".
        "<input type=\"hidden\" class=\"desccost\" name=\"desccost\" value=\"".$flash['cost']."\" readonly=\"readonly\" /></td>"; 

// Webbing
echo"<td><input type=\"hidden\" class=\"webbing\" name=\"webbing[36]\" value=\"\" readonly=\"readonly\" /></td>";   

// Colours
echo "<td><select name=\"colour[36]\">";
        foreach($colours as $colour){
      	echo "<option value=\"".$colour."\"";
		if($colour == $getColour[36]){echo "selected=\"selected\""; 
		} else {echo "";}
		echo ">".$colour."</option>";
		}	 	
echo"</select></td>";

// Paint and Powder
echo "<td><select class=\"paint-list\" name=\"paintselect\" >";  
	    foreach($paints as $paint){
      	echo "<option value=\"".$paint['cf_id']."\""; 
		if($paint['category'] == $getFinish[36]){ echo "selected=\"selected\"";
		} else {echo "";}
		echo">".$paint['category']."</option>";	
		}
echo "</select>";
foreach($paints as $paint){
if($paint['category'] == $getFinish[36]){
echo "<input type=\"hidden\" class=\"paintdesc\" name=\"paint[36]\" value=\"".$paint['category']."\" readonly=\"readonly\" />".
     "<input type=\"hidden\" class=\"paintrrp\" name=\"paintrrp[]\" value=\"".$paint['rrp']."\" readonly=\"readonly\" />".
     "<input type=\"hidden\" class=\"paintcost\" name=\"paintcost[]\" value=\"".$paint['cost']."\" readonly=\"readonly\" />";
} else {echo "";}
}
	 echo "</td>";

// Unit of Measurement
echo "<td><input type=\"text\" name=\"uom[36]\" readonly=\"readonly\" value=\"".$flash['uom']."\"></td>";
}
else { echo " ";}
		}

// Unit Quantity	
echo "<td><input type=\"text\" class=\"qtylen\" name=\"qty[36]\" value=\"{$getQty[36]}\"></td>";

// Length or Width
echo "<td><input type=\"text\" class=\"xlength\" name=\"slength[36]\" value=\"{$getLength[36]}\" /></td>";


// Total RRP
echo "<td><input type=\"text\" class=\"rrp\" readonly=\"readonly\" name=\"rrp[36]\" value=\"{$getRRP[36]}\"><input type=\"hidden\" class=\"cst\" name=\"cst[36]\" value=\"{$getCost[36]}\"></td></tr>";

// ***************************** Flashing Intermediate Beam (Dbl Bank) ********************************************//
echo "<tr><td><input type=\"hidden\" name=\"id[37]\" value=\"{$getCFID[37]}\" />".$getDesc[37];
       	foreach($flashs as $flash) {
		if ($flash['cf_id'] == $getID[37]) {     		
		echo "<input type=\"hidden\" class=\"desc\" name=\"desc[37]\" value=\"".$flash['description']."\" readonly=\"readonly\" />".
		"<input type=\"hidden\" class=\"invent\" name=\"invent[37]\" value=\"".$flash['inventoryid']."\" readonly=\"readonly\" />".
		"<input type=\"hidden\" class=\"descrrp\" name=\"descrrp\" value=\"".$flash['rrp']."\" readonly=\"readonly\" />".
        "<input type=\"hidden\" class=\"desccost\" name=\"desccost\" value=\"".$flash['cost']."\" readonly=\"readonly\" /></td>"; 

// Webbing
echo"<td><input type=\"hidden\" class=\"webbing\" name=\"webbing[37]\" value=\"\" readonly=\"readonly\" /></td>";   

// Colours
echo "<td><select name=\"colour[37]\">";
        foreach($colours as $colour){
      	echo "<option value=\"".$colour."\"";
		if($colour == $getColour[37]){echo "selected=\"selected\""; 
		} else {echo "";}
		echo ">".$colour."</option>";
		}	 	
echo"</select></td>";

// Paint and Powder
echo "<td><select class=\"paint-list\" name=\"paintselect\" >";  
	    foreach($paints as $paint){
      	echo "<option value=\"".$paint['cf_id']."\""; 
		if($paint['category'] == $getFinish[37]){ echo "selected=\"selected\"";
		} else {echo "";}
		echo">".$paint['category']."</option>";	
		}
echo "</select>";
foreach($paints as $paint){
if($paint['category'] == $getFinish[37]){
echo "<input type=\"hidden\" class=\"paintdesc\" name=\"paint[37]\" value=\"".$paint['category']."\" readonly=\"readonly\" />".
     "<input type=\"hidden\" class=\"paintrrp\" name=\"paintrrp[]\" value=\"".$paint['rrp']."\" readonly=\"readonly\" />".
     "<input type=\"hidden\" class=\"paintcost\" name=\"paintcost[]\" value=\"".$paint['cost']."\" readonly=\"readonly\" />";
} else {echo "";}
}
	 echo "</td>";

// Unit of Measurement
echo "<td><input type=\"text\" name=\"uom[37]\" readonly=\"readonly\" value=\"".$flash['uom']."\"></td>";
}
else { echo " ";}
		}

// Unit Quantity	
echo "<td><input type=\"text\" class=\"qtylen\" name=\"qty[37]\" value=\"{$getQty[37]}\"></td>";

// Length or Width
echo "<td><input type=\"text\" class=\"xlength\" name=\"slength[37]\" value=\"{$getLength[37]}\" /></td>";


// Total RRP
echo "<td><input type=\"text\" class=\"rrp\" readonly=\"readonly\" name=\"rrp[37]\" value=\"{$getRRP[37]}\"><input type=\"hidden\" class=\"cst\" name=\"cst[37]\" value=\"{$getCost[37]}\"></td></tr>";
// ***************************** Flashing Special ********************************************//
echo "<tr><td><input type=\"hidden\" name=\"id[38]\" value=\"{$getCFID[38]}\" />".$getDesc[38];
       	foreach($flashs as $flash) {
		if ($flash['cf_id'] == $getID[38]) {     		
		echo "<input type=\"hidden\" class=\"desc\" name=\"desc[38]\" value=\"".$flash['description']."\" readonly=\"readonly\" />".
		"<input type=\"hidden\" class=\"invent\" name=\"invent[38]\" value=\"".$flash['inventoryid']."\" readonly=\"readonly\" />".
		"<input type=\"hidden\" class=\"descrrp\" name=\"descrrp\" value=\"".$flash['rrp']."\" readonly=\"readonly\" />".
        "<input type=\"hidden\" class=\"desccost\" name=\"desccost\" value=\"".$flash['cost']."\" readonly=\"readonly\" /></td>"; 

// Webbing
echo"<td><input type=\"hidden\" class=\"webbing\" name=\"webbing[38]\" value=\"\" readonly=\"readonly\" /></td>";   

// Colours
echo "<td><select name=\"colour[38]\">";
        foreach($colours as $colour){
      	echo "<option value=\"".$colour."\"";
		if($colour == $getColour[38]){echo "selected=\"selected\""; 
		} else {echo "";}
		echo ">".$colour."</option>";
		}	 	
echo"</select></td>";

// Paint and Powder
echo "<td><select class=\"paint-list\" name=\"paintselect\" >";  
	    foreach($paints as $paint){
      	echo "<option value=\"".$paint['cf_id']."\""; 
		if($paint['category'] == $getFinish[38]){ echo "selected=\"selected\"";
		} else {echo "";}
		echo">".$paint['category']."</option>";	
		}
echo "</select>";
foreach($paints as $paint){
if($paint['category'] == $getFinish[38]){
echo "<input type=\"hidden\" class=\"paintdesc\" name=\"paint[38]\" value=\"".$paint['category']."\" readonly=\"readonly\" />".
     "<input type=\"hidden\" class=\"paintrrp\" name=\"paintrrp[]\" value=\"".$paint['rrp']."\" readonly=\"readonly\" />".
     "<input type=\"hidden\" class=\"paintcost\" name=\"paintcost[]\" value=\"".$paint['cost']."\" readonly=\"readonly\" />";
} else {echo "";}
}
	 echo "</td>";

// Unit of Measurement
echo "<td><input type=\"text\" name=\"uom[38]\" readonly=\"readonly\" value=\"".$flash['uom']."\"></td>";
}
else { echo " ";}
		}

// Unit Quantity	
echo "<td><input type=\"text\" class=\"qtylen\" name=\"qty[38]\" value=\"{$getQty[38]}\"></td>";

// Length or Width
echo "<td><input type=\"text\" class=\"xlength\" name=\"slength[38]\" value=\"{$getLength[38]}\" /></td>";


// Total RRP
echo "<td><input type=\"text\" class=\"rrp\" readonly=\"readonly\" name=\"rrp[38]\" value=\"{$getRRP[38]}\"><input type=\"hidden\" class=\"cst\" name=\"cst[38]\" value=\"{$getCost[38]}\"></td></tr>";
?>