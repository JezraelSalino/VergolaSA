<?php 
// ***************************** Cbeam Face Flashing Z al ********************************************//
echo "<tr><td colspan=\"8\" class=\"subheading\">Flashing</td></tr>";
echo "<tr><td><input type=\"hidden\" name=\"id[17]\" value=\"{$getCFID[17]}\" />".$getDesc[17];
        $flashs = array();
		while ($flash = mysql_fetch_array($resultflash)){
		$flashs[] = $flash; }	
		
		foreach($flashs as $flash) {
		if ($flash['cf_id'] == $getID[17]) {     		
		echo "<input type=\"hidden\" class=\"desc\" name=\"desc[17]\" value=\"".$flash['description']."\" readonly=\"readonly\" />".
		"<input type=\"hidden\" class=\"invent\" name=\"invent[17]\" value=\"".$flash['inventoryid']."\" readonly=\"readonly\" />".
		"<input type=\"hidden\" class=\"descrrp\" name=\"descrrp\" value=\"".$flash['rrp']."\" readonly=\"readonly\" />".
        "<input type=\"hidden\" class=\"desccost\" name=\"desccost\" value=\"".$flash['cost']."\" readonly=\"readonly\" /></td>"; 

// Webbing
echo"<td><input type=\"hidden\" class=\"webbing\" name=\"webbing[17]\" value=\"\" readonly=\"readonly\" /></td>";   

// Colours
echo "<td><select name=\"colour[17]\">";
        foreach($colours as $colour){
      	echo "<option value=\"".$colour."\"";
		if($colour == $getColour[17]){echo "selected=\"selected\""; 
		} else {echo "";}
		echo ">".$colour."</option>";
		}	 	
echo"</select></td>";

// Paint and Powder
echo "<td><select class=\"paint-list\" name=\"paintselect\" >";  
	    foreach($paints as $paint){
      	echo "<option value=\"".$paint['cf_id']."\""; 
		if($paint['category'] == $getFinish[17]){ echo "selected=\"selected\"";
		} else {echo "";}
		echo">".$paint['category']."</option>";	
		}
echo "</select>";
foreach($paints as $paint){
if($paint['category'] == $getFinish[17]){
echo "<input type=\"hidden\" class=\"paintdesc\" name=\"paint[17]\" value=\"".$paint['category']."\" readonly=\"readonly\" />".
     "<input type=\"hidden\" class=\"paintrrp\" name=\"paintrrp[]\" value=\"".$paint['rrp']."\" readonly=\"readonly\" />".
     "<input type=\"hidden\" class=\"paintcost\" name=\"paintcost[]\" value=\"".$paint['cost']."\" readonly=\"readonly\" />";
} else {echo "";}
}
	 echo "</td>";

// Unit of Measurement
echo "<td><input type=\"text\" name=\"uom[17]\" readonly=\"readonly\" value=\"".$flash['uom']."\"></td>";
}
else { echo " ";}
		}

// Unit Quantity	
echo "<td><input type=\"text\" class=\"qtylen\" name=\"qty[17]\" value=\"{$getQty[17]}\"></td>";

// Length or Width
echo "<td><input type=\"text\" class=\"xlength\" name=\"slength[17]\" value=\"{$getLength[17]}\" /></td>";


// Total RRP
echo "<td><input type=\"text\" class=\"rrp\" readonly=\"readonly\" name=\"rrp[17]\" value=\"{$getRRP[17]}\"><input type=\"hidden\" class=\"cst\" name=\"cst[17]\" value=\"{$getCost[17]}\"></td></tr>";

// ***************************** Adaptor Flashing Cbd ********************************************//
echo "<tr><td><input type=\"hidden\" name=\"id[18]\" value=\"{$getCFID[18]}\" />".$getDesc[18];
       	foreach($flashs as $flash) {
		if ($flash['cf_id'] == $getID[18]) {     		
		echo "<input type=\"hidden\" class=\"desc\" name=\"desc[18]\" value=\"".$flash['description']."\" readonly=\"readonly\" />".
		"<input type=\"hidden\" class=\"invent\" name=\"invent[18]\" value=\"".$flash['inventoryid']."\" readonly=\"readonly\" />".
		"<input type=\"hidden\" class=\"descrrp\" name=\"descrrp\" value=\"".$flash['rrp']."\" readonly=\"readonly\" />".
        "<input type=\"hidden\" class=\"desccost\" name=\"desccost\" value=\"".$flash['cost']."\" readonly=\"readonly\" /></td>"; 

// Webbing
echo"<td><input type=\"hidden\" class=\"webbing\" name=\"webbing[18]\" value=\"\" readonly=\"readonly\" /></td>";   

// Colours
echo "<td><select name=\"colour[18]\">";
        foreach($colours as $colour){
      	echo "<option value=\"".$colour."\"";
		if($colour == $getColour[18]){echo "selected=\"selected\""; 
		} else {echo "";}
		echo ">".$colour."</option>";
		}	 	
echo"</select></td>";

// Paint and Powder
echo "<td><select class=\"paint-list\" name=\"paintselect\" >";  
	    foreach($paints as $paint){
      	echo "<option value=\"".$paint['cf_id']."\""; 
		if($paint['category'] == $getFinish[18]){ echo "selected=\"selected\"";
		} else {echo "";}
		echo">".$paint['category']."</option>";	
		}
echo "</select>";
foreach($paints as $paint){
if($paint['category'] == $getFinish[18]){
echo "<input type=\"hidden\" class=\"paintdesc\" name=\"paint[18]\" value=\"".$paint['category']."\" readonly=\"readonly\" />".
     "<input type=\"hidden\" class=\"paintrrp\" name=\"paintrrp[]\" value=\"".$paint['rrp']."\" readonly=\"readonly\" />".
     "<input type=\"hidden\" class=\"paintcost\" name=\"paintcost[]\" value=\"".$paint['cost']."\" readonly=\"readonly\" />";
} else {echo "";}
}
	 echo "</td>";

// Unit of Measurement
echo "<td><input type=\"text\" name=\"uom[18]\" readonly=\"readonly\" value=\"".$flash['uom']."\"></td>";
}
else { echo " ";}
		}

// Unit Quantity	
echo "<td><input type=\"text\" class=\"qtylen\" name=\"qty[18]\" value=\"{$getQty[18]}\"></td>";

// Length or Width
echo "<td><input type=\"text\" class=\"xlength\" name=\"slength[18]\" value=\"{$getLength[18]}\" /></td>";


// Total RRP
echo "<td><input type=\"text\" class=\"rrp\" readonly=\"readonly\" name=\"rrp[18]\" value=\"{$getRRP[18]}\"><input type=\"hidden\" class=\"cst\" name=\"cst[18]\" value=\"{$getCost[18]}\"></td></tr>";

// ***************************** Flashing Fascia ********************************************//
echo "<tr><td><input type=\"hidden\" name=\"id[19]\" value=\"{$getCFID[19]}\" />".$getDesc[19];
       	foreach($flashs as $flash) {
		if ($flash['cf_id'] == $getID[19]) {     		
		echo "<input type=\"hidden\" class=\"desc\" name=\"desc[19]\" value=\"".$flash['description']."\" readonly=\"readonly\" />".
		"<input type=\"hidden\" class=\"invent\" name=\"invent[19]\" value=\"".$flash['inventoryid']."\" readonly=\"readonly\" />".
		"<input type=\"hidden\" class=\"descrrp\" name=\"descrrp\" value=\"".$flash['rrp']."\" readonly=\"readonly\" />".
        "<input type=\"hidden\" class=\"desccost\" name=\"desccost\" value=\"".$flash['cost']."\" readonly=\"readonly\" /></td>"; 

// Webbing
echo"<td><input type=\"hidden\" class=\"webbing\" name=\"webbing[19]\" value=\"\" readonly=\"readonly\" /></td>";   

// Colours
echo "<td><select name=\"colour[19]\">";
        foreach($colours as $colour){
      	echo "<option value=\"".$colour."\"";
		if($colour == $getColour[19]){echo "selected=\"selected\""; 
		} else {echo "";}
		echo ">".$colour."</option>";
		}	 	
echo"</select></td>";

// Paint and Powder
echo "<td><select class=\"paint-list\" name=\"paintselect\" >";  
	    foreach($paints as $paint){
      	echo "<option value=\"".$paint['cf_id']."\""; 
		if($paint['category'] ==$getFinish[19]){ echo "selected=\"selected\"";
		} else {echo "";}
		echo">".$paint['category']."</option>";	
		}
echo "</select>";
foreach($paints as $paint){
if($paint['category'] == $getFinish[19]){
echo "<input type=\"hidden\" class=\"paintdesc\" name=\"paint[19]\" value=\"".$paint['category']."\" readonly=\"readonly\" />".
     "<input type=\"hidden\" class=\"paintrrp\" name=\"paintrrp[]\" value=\"".$paint['rrp']."\" readonly=\"readonly\" />".
     "<input type=\"hidden\" class=\"paintcost\" name=\"paintcost[]\" value=\"".$paint['cost']."\" readonly=\"readonly\" />";
} else {echo "";}
}
	 echo "</td>";

// Unit of Measurement
echo "<td><input type=\"text\" name=\"uom[19]\" readonly=\"readonly\" value=\"".$flash['uom']."\"></td>";
}
else { echo " ";}
		}

// Unit Quantity	
echo "<td><input type=\"text\" class=\"qtylen\" name=\"qty[19]\" value=\"{$getQty[19]}\"></td>";

// Length or Width
echo "<td><input type=\"text\" class=\"xlength\" name=\"slength[19]\" value=\"{$getLength[19]}\" /></td>";


// Total RRP
echo "<td><input type=\"text\" class=\"rrp\" readonly=\"readonly\" name=\"rrp[19]\" value=\"{$getRRP[19]}\"><input type=\"hidden\" class=\"cst\" name=\"cst[19]\" value=\"{$getCost[19]}\"></td></tr>";

// ***************************** Flashing (Perimeter of Cbeam) ********************************************//
echo "<tr><td><input type=\"hidden\" name=\"id[20]\" value=\"{$getCFID[20]}\" />".$getDesc[20];
       	foreach($flashs as $flash) {
		if ($flash['cf_id'] == $getID[20]) {     		
		echo "<input type=\"hidden\" class=\"desc\" name=\"desc[20]\" value=\"".$flash['description']."\" readonly=\"readonly\" />".
		"<input type=\"hidden\" class=\"invent\" name=\"invent[20]\" value=\"".$flash['inventoryid']."\" readonly=\"readonly\" />".
		"<input type=\"hidden\" class=\"descrrp\" name=\"descrrp\" value=\"".$flash['rrp']."\" readonly=\"readonly\" />".
        "<input type=\"hidden\" class=\"desccost\" name=\"desccost\" value=\"".$flash['cost']."\" readonly=\"readonly\" /></td>"; 

// Webbing
echo"<td><input type=\"hidden\" class=\"webbing\" name=\"webbing[20]\" value=\"\" readonly=\"readonly\" /></td>";   

// Colours
echo "<td><select name=\"colour[20]\">";
        foreach($colours as $colour){
      	echo "<option value=\"".$colour."\"";
		if($colour == $getColour[20]){echo "selected=\"selected\""; 
		} else {echo "";}
		echo ">".$colour."</option>";
		}	 	
echo"</select></td>";

// Paint and Powder
echo "<td><select class=\"paint-list\" name=\"paintselect\" >";  
	    foreach($paints as $paint){
      	echo "<option value=\"".$paint['cf_id']."\""; 
		if($paint['category'] == $getFinish[20]){ echo "selected=\"selected\"";
		} else {echo "";}
		echo">".$paint['category']."</option>";	
		}
echo "</select>";
foreach($paints as $paint){
if($paint['category'] == $getFinish[20]){
echo "<input type=\"hidden\" class=\"paintdesc\" name=\"paint[20]\" value=\"".$paint['category']."\" readonly=\"readonly\" />".
     "<input type=\"hidden\" class=\"paintrrp\" name=\"paintrrp[]\" value=\"".$paint['rrp']."\" readonly=\"readonly\" />".
     "<input type=\"hidden\" class=\"paintcost\" name=\"paintcost[]\" value=\"".$paint['cost']."\" readonly=\"readonly\" />";
} else {echo "";}
}
	 echo "</td>";

// Unit of Measurement
echo "<td><input type=\"text\" name=\"uom[20]\" readonly=\"readonly\" value=\"".$flash['uom']."\"></td>";
}
else { echo " ";}
		}

// Unit Quantity	
echo "<td><input type=\"text\" class=\"qtylen\" name=\"qty[20]\" value=\"{$getQty[20]}\"></td>";

// Length or Width
echo "<td><input type=\"text\" class=\"xlength\" name=\"slength[20]\" value=\"{$getLength[20]}\" /></td>";


// Total RRP
echo "<td><input type=\"text\" class=\"rrp\" readonly=\"readonly\" name=\"rrp[20]\" value=\"{$getRRP[20]}\"><input type=\"hidden\" class=\"cst\" name=\"cst[20]\" value=\"{$getCost[20]}\"></td></tr>";

// ***************************** Flashing Intermediate Beam (Dbl Bank) ********************************************//
echo "<tr><td><input type=\"hidden\" name=\"id[21]\" value=\"{$getCFID[21]}\" />".$getDesc[21];
       	foreach($flashs as $flash) {
		if ($flash['cf_id'] == $getID[21]) {     		
		echo "<input type=\"hidden\" class=\"desc\" name=\"desc[21]\" value=\"".$flash['description']."\" readonly=\"readonly\" />".
		"<input type=\"hidden\" class=\"invent\" name=\"invent[21]\" value=\"".$flash['inventoryid']."\" readonly=\"readonly\" />".
		"<input type=\"hidden\" class=\"descrrp\" name=\"descrrp\" value=\"".$flash['rrp']."\" readonly=\"readonly\" />".
        "<input type=\"hidden\" class=\"desccost\" name=\"desccost\" value=\"".$flash['cost']."\" readonly=\"readonly\" /></td>"; 

// Webbing
echo"<td><input type=\"hidden\" class=\"webbing\" name=\"webbing[21]\" value=\"\" readonly=\"readonly\" /></td>";   

// Colours
echo "<td><select name=\"colour[21]\">";
        foreach($colours as $colour){
      	echo "<option value=\"".$colour."\"";
		if($colour == $getColour[21]){echo "selected=\"selected\""; 
		} else {echo "";}
		echo ">".$colour."</option>";
		}	 	
echo"</select></td>";

// Paint and Powder
echo "<td><select class=\"paint-list\" name=\"paintselect\" >";  
	    foreach($paints as $paint){
      	echo "<option value=\"".$paint['cf_id']."\""; 
		if($paint['category'] == $getFinish[21]){ echo "selected=\"selected\"";
		} else {echo "";}
		echo">".$paint['category']."</option>";	
		}
echo "</select>";
foreach($paints as $paint){
if($paint['category'] == $getFinish[21]){
echo "<input type=\"hidden\" class=\"paintdesc\" name=\"paint[21]\" value=\"".$paint['category']."\" readonly=\"readonly\" />".
     "<input type=\"hidden\" class=\"paintrrp\" name=\"paintrrp[]\" value=\"".$paint['rrp']."\" readonly=\"readonly\" />".
     "<input type=\"hidden\" class=\"paintcost\" name=\"paintcost[]\" value=\"".$paint['cost']."\" readonly=\"readonly\" />";
} else {echo "";}
}
	 echo "</td>";

// Unit of Measurement
echo "<td><input type=\"text\" name=\"uom[21]\" readonly=\"readonly\" value=\"".$flash['uom']."\"></td>";
}
else { echo " ";}
		}

// Unit Quantity	
echo "<td><input type=\"text\" class=\"qtylen\" name=\"qty[21]\" value=\"{$getQty[21]}\"></td>";

// Length or Width
echo "<td><input type=\"text\" class=\"xlength\" name=\"slength[21]\" value=\"{$getLength[21]}\" /></td>";


// Total RRP
echo "<td><input type=\"text\" class=\"rrp\" readonly=\"readonly\" name=\"rrp[21]\" value=\"{$getRRP[21]}\"><input type=\"hidden\" class=\"cst\" name=\"cst[21]\" value=\"{$getCost[21]}\"></td></tr>";
// ***************************** Flashing Special ********************************************//
echo "<tr><td><input type=\"hidden\" name=\"id[22]\" value=\"{$getCFID[22]}\" />".$getDesc[22];
       	foreach($flashs as $flash) {
		if ($flash['cf_id'] == $getID[22]) {     		
		echo "<input type=\"hidden\" class=\"desc\" name=\"desc[22]\" value=\"".$flash['description']."\" readonly=\"readonly\" />".
		"<input type=\"hidden\" class=\"invent\" name=\"invent[22]\" value=\"".$flash['inventoryid']."\" readonly=\"readonly\" />".
		"<input type=\"hidden\" class=\"descrrp\" name=\"descrrp\" value=\"".$flash['rrp']."\" readonly=\"readonly\" />".
        "<input type=\"hidden\" class=\"desccost\" name=\"desccost\" value=\"".$flash['cost']."\" readonly=\"readonly\" /></td>"; 

// Webbing
echo"<td><input type=\"hidden\" class=\"webbing\" name=\"webbing[22]\" value=\"\" readonly=\"readonly\" /></td>";   

// Colours
echo "<td><select name=\"colour[22]\">";
        foreach($colours as $colour){
      	echo "<option value=\"".$colour."\"";
		if($colour == $getColour[22]){echo "selected=\"selected\""; 
		} else {echo "";}
		echo ">".$colour."</option>";
		}	 	
echo"</select></td>";

// Paint and Powder
echo "<td><select class=\"paint-list\" name=\"paintselect\" >";  
	    foreach($paints as $paint){
      	echo "<option value=\"".$paint['cf_id']."\""; 
		if($paint['category'] == $getFinish[22]){ echo "selected=\"selected\"";
		} else {echo "";}
		echo">".$paint['category']."</option>";	
		}
echo "</select>";
foreach($paints as $paint){
if($paint['category'] == $getFinish[22]){
echo "<input type=\"hidden\" class=\"paintdesc\" name=\"paint[22]\" value=\"".$paint['category']."\" readonly=\"readonly\" />".
     "<input type=\"hidden\" class=\"paintrrp\" name=\"paintrrp[]\" value=\"".$paint['rrp']."\" readonly=\"readonly\" />".
     "<input type=\"hidden\" class=\"paintcost\" name=\"paintcost[]\" value=\"".$paint['cost']."\" readonly=\"readonly\" />";
} else {echo "";}
}
	 echo "</td>";

// Unit of Measurement
echo "<td><input type=\"text\" name=\"uom[22]\" readonly=\"readonly\" value=\"".$flash['uom']."\"></td>";
}
else { echo " ";}
		}

// Unit Quantity	
echo "<td><input type=\"text\" class=\"qtylen\" name=\"qty[22]\" value=\"{$getQty[22]}\"></td>";

// Length or Width
echo "<td><input type=\"text\" class=\"xlength\" name=\"slength[22]\" value=\"{$getLength[22]}\" /></td>";


// Total RRP
echo "<td><input type=\"text\" class=\"rrp\" readonly=\"readonly\" name=\"rrp[22]\" value=\"{$getRRP[22]}\"><input type=\"hidden\" class=\"cst\" name=\"cst[22]\" value=\"{$getCost[22]}\"></td></tr>";
?>