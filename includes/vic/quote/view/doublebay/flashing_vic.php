<?php 
// ***************************** Cbeam Face Flashing Z al ********************************************//
echo "<tr><td colspan=\"8\" class=\"subheading\">Flashing</td></tr>";
echo "<tr><td><input type=\"hidden\" name=\"id[38]\" value=\"{$getCFID[38]}\" />".$getDesc[38];
        $flashs = array();
		while ($flash = mysql_fetch_array($resultflash)){
		$flashs[] = $flash; }	
		 
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
echo "<td><input type=\"text\" class=\"rrp\" readonly=\"readonly\" name=\"rrp[38]\" value=\"{$getRRP[38]}\"><input type=\"hidden\" class=\"cst\" name=\"cst[38]\" value=\"{$getCost[36]}\"></td></tr>";

// ***************************** Adaptor Flashing Cbd ********************************************//
echo "<tr><td><input type=\"hidden\" name=\"id[39]\" value=\"{$getCFID[39]}\" />".$getDesc[39];
       	foreach($flashs as $flash) {
		if ($flash['cf_id'] == $getID[39]) {     		
		echo "<input type=\"hidden\" class=\"desc\" name=\"desc[39]\" value=\"".$flash['description']."\" readonly=\"readonly\" />".
		"<input type=\"hidden\" class=\"invent\" name=\"invent[39]\" value=\"".$flash['inventoryid']."\" readonly=\"readonly\" />".
		"<input type=\"hidden\" class=\"descrrp\" name=\"descrrp\" value=\"".$flash['rrp']."\" readonly=\"readonly\" />".
        "<input type=\"hidden\" class=\"desccost\" name=\"desccost\" value=\"".$flash['cost']."\" readonly=\"readonly\" /></td>"; 

// Webbing
echo"<td><input type=\"hidden\" class=\"webbing\" name=\"webbing[39]\" value=\"\" readonly=\"readonly\" /></td>";   

// Colours
echo "<td><select name=\"colour[39]\">";
        foreach($colours as $colour){
      	echo "<option value=\"".$colour."\"";
		if($colour == $getColour[39]){echo "selected=\"selected\""; 
		} else {echo "";}
		echo ">".$colour."</option>";
		}	 	
echo"</select></td>";

// Paint and Powder
echo "<td><select class=\"paint-list\" name=\"paintselect\" >";  
	    foreach($paints as $paint){
      	echo "<option value=\"".$paint['cf_id']."\""; 
		if($paint['category'] == $getFinish[39]){ echo "selected=\"selected\"";
		} else {echo "";}
		echo">".$paint['category']."</option>";	
		}
echo "</select>";
foreach($paints as $paint){
if($paint['category'] == $getFinish[39]){
echo "<input type=\"hidden\" class=\"paintdesc\" name=\"paint[39]\" value=\"".$paint['category']."\" readonly=\"readonly\" />".
     "<input type=\"hidden\" class=\"paintrrp\" name=\"paintrrp[]\" value=\"".$paint['rrp']."\" readonly=\"readonly\" />".
     "<input type=\"hidden\" class=\"paintcost\" name=\"paintcost[]\" value=\"".$paint['cost']."\" readonly=\"readonly\" />";
} else {echo "";}
}
	 echo "</td>";

// Unit of Measurement
echo "<td><input type=\"text\" name=\"uom[39]\" readonly=\"readonly\" value=\"".$flash['uom']."\"></td>";
}
else { echo " ";}
		}

// Unit Quantity	
echo "<td><input type=\"text\" class=\"qtylen\" name=\"qty[39]\" value=\"{$getQty[39]}\"></td>";

// Length or Width
echo "<td><input type=\"text\" class=\"xlength\" name=\"slength[39]\" value=\"{$getLength[39]}\" /></td>";


// Total RRP
echo "<td><input type=\"text\" class=\"rrp\" readonly=\"readonly\" name=\"rrp[39]\" value=\"{$getRRP[39]}\"><input type=\"hidden\" class=\"cst\" name=\"cst[39]\" value=\"{$getCost[39]}\"></td></tr>";

// ***************************** Flashing Fascia ********************************************//
echo "<tr><td><input type=\"hidden\" name=\"id[40]\" value=\"{$getCFID[40]}\" />".$getDesc[40];
       	foreach($flashs as $flash) {
		if ($flash['cf_id'] == $getID[40]) {     		
		echo "<input type=\"hidden\" class=\"desc\" name=\"desc[40]\" value=\"".$flash['description']."\" readonly=\"readonly\" />".
		"<input type=\"hidden\" class=\"invent\" name=\"invent[40]\" value=\"".$flash['inventoryid']."\" readonly=\"readonly\" />".
		"<input type=\"hidden\" class=\"descrrp\" name=\"descrrp\" value=\"".$flash['rrp']."\" readonly=\"readonly\" />".
        "<input type=\"hidden\" class=\"desccost\" name=\"desccost\" value=\"".$flash['cost']."\" readonly=\"readonly\" /></td>"; 

// Webbing
echo"<td><input type=\"hidden\" class=\"webbing\" name=\"webbing[40]\" value=\"\" readonly=\"readonly\" /></td>";   

// Colours
echo "<td><select name=\"colour[40]\">";
        foreach($colours as $colour){
      	echo "<option value=\"".$colour."\"";
		if($colour == $getColour[40]){echo "selected=\"selected\""; 
		} else {echo "";}
		echo ">".$colour."</option>";
		}	 	
echo"</select></td>";

// Paint and Powder
echo "<td><select class=\"paint-list\" name=\"paintselect\" >";  
	    foreach($paints as $paint){
      	echo "<option value=\"".$paint['cf_id']."\""; 
		if($paint['category'] ==$getFinish[40]){ echo "selected=\"selected\"";
		} else {echo "";}
		echo">".$paint['category']."</option>";	
		}
echo "</select>";
foreach($paints as $paint){
if($paint['category'] == $getFinish[40]){
echo "<input type=\"hidden\" class=\"paintdesc\" name=\"paint[40]\" value=\"".$paint['category']."\" readonly=\"readonly\" />".
     "<input type=\"hidden\" class=\"paintrrp\" name=\"paintrrp[]\" value=\"".$paint['rrp']."\" readonly=\"readonly\" />".
     "<input type=\"hidden\" class=\"paintcost\" name=\"paintcost[]\" value=\"".$paint['cost']."\" readonly=\"readonly\" />";
} else {echo "";}
}
	 echo "</td>";

// Unit of Measurement
echo "<td><input type=\"text\" name=\"uom[40]\" readonly=\"readonly\" value=\"".$flash['uom']."\"></td>";
}
else { echo " ";}
		}

// Unit Quantity	
echo "<td><input type=\"text\" class=\"qtylen\" name=\"qty[40]\" value=\"{$getQty[40]}\"></td>";

// Length or Width
echo "<td><input type=\"text\" class=\"xlength\" name=\"slength[40]\" value=\"{$getLength[40]}\" /></td>";


// Total RRP
echo "<td><input type=\"text\" class=\"rrp\" readonly=\"readonly\" name=\"rrp[40]\" value=\"{$getRRP[40]}\"><input type=\"hidden\" class=\"cst\" name=\"cst[40]\" value=\"{$getCost[40]}\"></td></tr>";

// ***************************** Flashing (Perimeter of Cbeam) ********************************************//
echo "<tr><td><input type=\"hidden\" name=\"id[41]\" value=\"{$getCFID[41]}\" />".$getDesc[41];
       	foreach($flashs as $flash) {
		if ($flash['cf_id'] == $getID[41]) {     		
		echo "<input type=\"hidden\" class=\"desc\" name=\"desc[41]\" value=\"".$flash['description']."\" readonly=\"readonly\" />".
		"<input type=\"hidden\" class=\"invent\" name=\"invent[41]\" value=\"".$flash['inventoryid']."\" readonly=\"readonly\" />".
		"<input type=\"hidden\" class=\"descrrp\" name=\"descrrp\" value=\"".$flash['rrp']."\" readonly=\"readonly\" />".
        "<input type=\"hidden\" class=\"desccost\" name=\"desccost\" value=\"".$flash['cost']."\" readonly=\"readonly\" /></td>"; 

// Webbing
echo"<td><input type=\"hidden\" class=\"webbing\" name=\"webbing[41]\" value=\"\" readonly=\"readonly\" /></td>";   

// Colours
echo "<td><select name=\"colour[41]\">";
        foreach($colours as $colour){
      	echo "<option value=\"".$colour."\"";
		if($colour == $getColour[41]){echo "selected=\"selected\""; 
		} else {echo "";}
		echo ">".$colour."</option>";
		}	 	
echo"</select></td>";

// Paint and Powder
echo "<td><select class=\"paint-list\" name=\"paintselect\" >";  
	    foreach($paints as $paint){
      	echo "<option value=\"".$paint['cf_id']."\""; 
		if($paint['category'] == $getFinish[41]){ echo "selected=\"selected\"";
		} else {echo "";}
		echo">".$paint['category']."</option>";	
		}
echo "</select>";
foreach($paints as $paint){
if($paint['category'] == $getFinish[41]){
echo "<input type=\"hidden\" class=\"paintdesc\" name=\"paint[41]\" value=\"".$paint['category']."\" readonly=\"readonly\" />".
     "<input type=\"hidden\" class=\"paintrrp\" name=\"paintrrp[]\" value=\"".$paint['rrp']."\" readonly=\"readonly\" />".
     "<input type=\"hidden\" class=\"paintcost\" name=\"paintcost[]\" value=\"".$paint['cost']."\" readonly=\"readonly\" />";
} else {echo "";}
}
	 echo "</td>";

// Unit of Measurement
echo "<td><input type=\"text\" name=\"uom[41]\" readonly=\"readonly\" value=\"".$flash['uom']."\"></td>";
}
else { echo " ";}
		}

// Unit Quantity	
echo "<td><input type=\"text\" class=\"qtylen\" name=\"qty[41]\" value=\"{$getQty[41]}\"></td>";

// Length or Width
echo "<td><input type=\"text\" class=\"xlength\" name=\"slength[41]\" value=\"{$getLength[41]}\" /></td>";


// Total RRP
echo "<td><input type=\"text\" class=\"rrp\" readonly=\"readonly\" name=\"rrp[41]\" value=\"{$getRRP[41]}\"><input type=\"hidden\" class=\"cst\" name=\"cst[41]\" value=\"{$getCost[41]}\"></td></tr>";

// ***************************** Flashing Intermediate Beam (Dbl Bank) ********************************************//
echo "<tr><td><input type=\"hidden\" name=\"id[42]\" value=\"{$getCFID[42]}\" />".$getDesc[42];
       	foreach($flashs as $flash) {
		if ($flash['cf_id'] == $getID[42]) {     		
		echo "<input type=\"hidden\" class=\"desc\" name=\"desc[42]\" value=\"".$flash['description']."\" readonly=\"readonly\" />".
		"<input type=\"hidden\" class=\"invent\" name=\"invent[42]\" value=\"".$flash['inventoryid']."\" readonly=\"readonly\" />".
		"<input type=\"hidden\" class=\"descrrp\" name=\"descrrp\" value=\"".$flash['rrp']."\" readonly=\"readonly\" />".
        "<input type=\"hidden\" class=\"desccost\" name=\"desccost\" value=\"".$flash['cost']."\" readonly=\"readonly\" /></td>"; 

// Webbing
echo"<td><input type=\"hidden\" class=\"webbing\" name=\"webbing[42]\" value=\"\" readonly=\"readonly\" /></td>";   

// Colours
echo "<td><select name=\"colour[42]\">";
        foreach($colours as $colour){
      	echo "<option value=\"".$colour."\"";
		if($colour == $getColour[42]){echo "selected=\"selected\""; 
		} else {echo "";}
		echo ">".$colour."</option>";
		}	 	
echo"</select></td>";

// Paint and Powder
echo "<td><select class=\"paint-list\" name=\"paintselect\" >";  
	    foreach($paints as $paint){
      	echo "<option value=\"".$paint['cf_id']."\""; 
		if($paint['category'] == $getFinish[42]){ echo "selected=\"selected\"";
		} else {echo "";}
		echo">".$paint['category']."</option>";	
		}
echo "</select>";
foreach($paints as $paint){
if($paint['category'] == $getFinish[42]){
echo "<input type=\"hidden\" class=\"paintdesc\" name=\"paint[42]\" value=\"".$paint['category']."\" readonly=\"readonly\" />".
     "<input type=\"hidden\" class=\"paintrrp\" name=\"paintrrp[]\" value=\"".$paint['rrp']."\" readonly=\"readonly\" />".
     "<input type=\"hidden\" class=\"paintcost\" name=\"paintcost[]\" value=\"".$paint['cost']."\" readonly=\"readonly\" />";
} else {echo "";}
}
	 echo "</td>";

// Unit of Measurement
echo "<td><input type=\"text\" name=\"uom[42]\" readonly=\"readonly\" value=\"".$flash['uom']."\"></td>";
}
else { echo " ";}
		}

// Unit Quantity	
echo "<td><input type=\"text\" class=\"qtylen\" name=\"qty[42]\" value=\"{$getQty[42]}\"></td>";

// Length or Width
echo "<td><input type=\"text\" class=\"xlength\" name=\"slength[42]\" value=\"{$getLength[42]}\" /></td>";


// Total RRP
echo "<td><input type=\"text\" class=\"rrp\" readonly=\"readonly\" name=\"rrp[42]\" value=\"{$getRRP[42]}\"><input type=\"hidden\" class=\"cst\" name=\"cst[42]\" value=\"{$getCost[42]}\"></td></tr>";
// ***************************** Flashing Special ********************************************//
echo "<tr><td><input type=\"hidden\" name=\"id[43]\" value=\"{$getCFID[43]}\" />".$getDesc[43];
       	foreach($flashs as $flash) {
		if ($flash['cf_id'] == $getID[43]) {     		
		echo "<input type=\"hidden\" class=\"desc\" name=\"desc[43]\" value=\"".$flash['description']."\" readonly=\"readonly\" />".
		"<input type=\"hidden\" class=\"invent\" name=\"invent[43]\" value=\"".$flash['inventoryid']."\" readonly=\"readonly\" />".
		"<input type=\"hidden\" class=\"descrrp\" name=\"descrrp\" value=\"".$flash['rrp']."\" readonly=\"readonly\" />".
        "<input type=\"hidden\" class=\"desccost\" name=\"desccost\" value=\"".$flash['cost']."\" readonly=\"readonly\" /></td>"; 

// Webbing
echo"<td><input type=\"hidden\" class=\"webbing\" name=\"webbing[43]\" value=\"\" readonly=\"readonly\" /></td>";   

// Colours
echo "<td><select name=\"colour[43]\">";
        foreach($colours as $colour){
      	echo "<option value=\"".$colour."\"";
		if($colour == $getColour[43]){echo "selected=\"selected\""; 
		} else {echo "";}
		echo ">".$colour."</option>";
		}	 	
echo"</select></td>";

// Paint and Powder
echo "<td><select class=\"paint-list\" name=\"paintselect\" >";  
	    foreach($paints as $paint){
      	echo "<option value=\"".$paint['cf_id']."\""; 
		if($paint['category'] == $getFinish[43]){ echo "selected=\"selected\"";
		} else {echo "";}
		echo">".$paint['category']."</option>";	
		}
echo "</select>";
foreach($paints as $paint){
if($paint['category'] == $getFinish[43]){
echo "<input type=\"hidden\" class=\"paintdesc\" name=\"paint[43]\" value=\"".$paint['category']."\" readonly=\"readonly\" />".
     "<input type=\"hidden\" class=\"paintrrp\" name=\"paintrrp[]\" value=\"".$paint['rrp']."\" readonly=\"readonly\" />".
     "<input type=\"hidden\" class=\"paintcost\" name=\"paintcost[]\" value=\"".$paint['cost']."\" readonly=\"readonly\" />";
} else {echo "";}
}
	 echo "</td>";

// Unit of Measurement
echo "<td><input type=\"text\" name=\"uom[43]\" readonly=\"readonly\" value=\"".$flash['uom']."\"></td>";
}
else { echo " ";}
		}

// Unit Quantity	
echo "<td><input type=\"text\" class=\"qtylen\" name=\"qty[43]\" value=\"{$getQty[43]}\"></td>";

// Length or Width
echo "<td><input type=\"text\" class=\"xlength\" name=\"slength[43]\" value=\"{$getLength[43]}\" /></td>";


// Total RRP
echo "<td><input type=\"text\" class=\"rrp\" readonly=\"readonly\" name=\"rrp[43]\" value=\"{$getRRP[43]}\"><input type=\"hidden\" class=\"cst\" name=\"cst[43]\" value=\"{$getCost[43]}\"></td></tr>";
?>