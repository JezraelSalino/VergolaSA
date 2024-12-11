<?php
// ***************************** Fixing to Wall - Solid Brick ********************************************//
echo "<tr><td><input type=\"hidden\" name=\"id[18]\" value=\"{$getCFID[18]}\" />".$getDesc[18];
        $fixs = array();
		while ($fix = mysql_fetch_array($resultfix)){
		$fixs[] = $fix; }	
		
		foreach($fixs as $fix) {
		if ($fix['cf_id'] == $getID[18]) {     		
		echo "<input type=\"hidden\" class=\"desc\" name=\"desc[18]\" value=\"".$fix['description']."\" readonly=\"readonly\" />".
		"<input type=\"hidden\" class=\"invent\" name=\"invent[18]\" value=\"".$fix['inventoryid']."\" readonly=\"readonly\" />".
		"<input type=\"hidden\" class=\"descrrp\" name=\"descrrp\" value=\"".$fix['rrp']."\" readonly=\"readonly\" />".
        "<input type=\"hidden\" class=\"desccost\" name=\"desccost\" value=\"".$fix['cost']."\" readonly=\"readonly\" /></td>"; 

// Webbing
echo"<td><input type=\"hidden\" class=\"webbing\" name=\"webbing[18]\" value=\"\" readonly=\"readonly\" /></td>";   

// Colours
echo"<td><input type=\"hidden\" class=\"colour\" name=\"colour[18]\" value=\"\" readonly=\"readonly\" /></td>";
     	
// Paint and Powder
echo"<td><input type=\"hidden\" name=\"paint[18]\" value=\"\" readonly=\"readonly\" /></td>";

// Unit of Measurement
echo "<td><input type=\"text\" name=\"uom[18]\" readonly=\"readonly\" value=\"".$fix['uom']."\"></td>";
}
else { echo " ";}
		}

// Unit Quantity	
echo "<td><input type=\"text\" class=\"qtylen\" name=\"qty[18]\" value=\"{$getQty[18]}\"></td>";

// Length or Width
echo "<td><input type=\"hidden\" name=\"slength[18]\" value=\"{$getLength[18]}\" readonly=\"readonly\" /></td>";

// Total RRP
echo "<td><input type=\"text\" class=\"rrp\" readonly=\"readonly\" name=\"rrp[18]\" value=\"{$getRRP[18]}\"><input type=\"hidden\" class=\"cst\" name=\"cst[18]\" value=\"{$getCost[18]}\"></td></tr>";


// ***************************** Fixing to Wall - Soft Brick ********************************************//
echo "<tr><td><input type=\"hidden\" name=\"id[16]\" value=\"{$getCFID[16]}\" />".$getDesc[16];	
		foreach($fixs as $fix) {
		if ($fix['cf_id'] == $getID[16]) {     		
		echo "<input type=\"hidden\" class=\"desc\" name=\"desc[16]\" value=\"".$fix['description']."\" readonly=\"readonly\" />".
		"<input type=\"hidden\" class=\"invent\" name=\"invent[16]\" value=\"".$fix['inventoryid']."\" readonly=\"readonly\" />".
		"<input type=\"hidden\" class=\"descrrp\" name=\"descrrp\" value=\"".$fix['rrp']."\" readonly=\"readonly\" />".
        "<input type=\"hidden\" class=\"desccost\" name=\"desccost\" value=\"".$fix['cost']."\" readonly=\"readonly\" /></td>"; 

// Webbing
echo"<td><input type=\"hidden\" class=\"webbing\" name=\"webbing[16]\" value=\"\" readonly=\"readonly\" /></td>";   

// Colours
echo"<td><input type=\"hidden\" class=\"colour\" name=\"colour[16]\" value=\"\" readonly=\"readonly\" /></td>";
     	
// Paint and Powder
echo"<td><input type=\"hidden\" name=\"paint[16]\" value=\"\" readonly=\"readonly\" /></td>";

// Unit of Measurement
echo "<td><input type=\"text\" name=\"uom[16]\" readonly=\"readonly\" value=\"".$fix['uom']."\"></td>";
}
else { echo " ";}
		}

// Unit Quantity	
echo "<td><input type=\"text\" class=\"qtylen\" name=\"qty[16]\" value=\"{$getQty[16]}\"></td>";

// Length or Width
echo "<td><input type=\"hidden\" name=\"slength[16]\" value=\"{$getLength[16]}\" readonly=\"readonly\" /></td>";

// Total RRP
echo "<td><input type=\"text\" class=\"rrp\" readonly=\"readonly\" name=\"rrp[16]\" value=\"{$getRRP[16]}\"><input type=\"hidden\" class=\"cst\" name=\"cst[16]\" value=\"{$getCost[16]}\"></td></tr>";

// ***************************** Bracket Fascia ********************************************//
echo "<tr><td><input type=\"hidden\" name=\"id[17]\" value=\"{$getCFID[17]}\" />".$getDesc[17];	
		foreach($fixs as $fix) {
		if ($fix['cf_id'] == $getID[17]) {     		
		echo "<input type=\"hidden\" class=\"desc\" name=\"desc[17]\" value=\"".$fix['description']."\" readonly=\"readonly\" />".
		"<input type=\"hidden\" class=\"invent\" name=\"invent[17]\" value=\"".$fix['inventoryid']."\" readonly=\"readonly\" />".
		"<input type=\"hidden\" class=\"descrrp\" name=\"descrrp\" value=\"".$fix['rrp']."\" readonly=\"readonly\" />".
        "<input type=\"hidden\" class=\"desccost\" name=\"desccost\" value=\"".$fix['cost']."\" readonly=\"readonly\" /></td>"; 

// Webbing
echo"<td><input type=\"hidden\" class=\"webbing\" name=\"webbing[17]\" value=\"\" readonly=\"readonly\" /></td>";   

// Colours
echo"<td><input type=\"hidden\" class=\"colour\" name=\"colour[17]\" value=\"\" readonly=\"readonly\" /></td>";
     	
// Paint and Powder
echo"<td><input type=\"hidden\" name=\"paint[17]\" value=\"\" readonly=\"readonly\" /></td>";

// Unit of Measurement
echo "<td><input type=\"text\" name=\"uom[17]\" readonly=\"readonly\" value=\"".$fix['uom']."\"></td>";
}
else { echo " ";}
		}

// Unit Quantity	
echo "<td><input type=\"text\" class=\"qtylen\" name=\"qty[17]\" value=\"{$getQty[17]}\"></td>";

// Length or Width
echo "<td><input type=\"hidden\" name=\"slength[17]\" value=\"{$getLength[17]}\" readonly=\"readonly\" /></td>";

// Total RRP
echo "<td><input type=\"text\" class=\"rrp\" readonly=\"readonly\" name=\"rrp[17]\" value=\"{$getRRP[17]}\"><input type=\"hidden\" class=\"cst\" name=\"cst[17]\" value=\"{$getCost[17]}\"></td></tr>";
// ***************************** Post Footing to Earth ********************************************//
echo "<tr><td><input type=\"hidden\" name=\"id[18]\" value=\"{$getCFID[18]}\" />".$getDesc[18];	
		foreach($fixs as $fix) {
		if ($fix['cf_id'] == $getID[18]) {     		
		echo "<input type=\"hidden\" class=\"desc\" name=\"desc[18]\" value=\"".$fix['description']."\" readonly=\"readonly\" />".
		"<input type=\"hidden\" class=\"invent\" name=\"invent[18]\" value=\"".$fix['inventoryid']."\" readonly=\"readonly\" />".
		"<input type=\"hidden\" class=\"descrrp\" name=\"descrrp\" value=\"".$fix['rrp']."\" readonly=\"readonly\" />".
        "<input type=\"hidden\" class=\"desccost\" name=\"desccost\" value=\"".$fix['cost']."\" readonly=\"readonly\" /></td>"; 

// Webbing
echo"<td><input type=\"hidden\" class=\"webbing\" name=\"webbing[18]\" value=\"\" readonly=\"readonly\" /></td>";   

// Colours
echo"<td><input type=\"hidden\" class=\"colour\" name=\"colour[18]\" value=\"\" readonly=\"readonly\" /></td>";
     	
// Paint and Powder
echo"<td><input type=\"hidden\" name=\"paint[18]\" value=\"\" readonly=\"readonly\" /></td>";

// Unit of Measurement
echo "<td><input type=\"text\" name=\"uom[18]\" readonly=\"readonly\" value=\"".$fix['uom']."\"></td>";
}
else { echo " ";}
		}

// Unit Quantity	
echo "<td><input type=\"text\" class=\"qtylen\" name=\"qty[18]\" value=\"{$getQty[18]}\"></td>";

// Length or Width
echo "<td><input type=\"hidden\" name=\"slength[18]\" value=\"{$getLength[18]}\" readonly=\"readonly\" /></td>";

// Total RRP
echo "<td><input type=\"text\" class=\"rrp\" readonly=\"readonly\" name=\"rrp[18]\" value=\"{$getRRP[18]}\"><input type=\"hidden\" class=\"cst\" name=\"cst[18]\" value=\"{$getCost[18]}\"></td></tr>";

// ***************************** Post Footing to Earth (Reinforced) ********************************************//
echo "<tr><td><input type=\"hidden\" name=\"id[16]\" value=\"{$getCFID[16]}\" />".$getDesc[16];	
		foreach($fixs as $fix) {
		if ($fix['cf_id'] == $getID[16]) {     		
		echo "<input type=\"hidden\" class=\"desc\" name=\"desc[16]\" value=\"".$fix['description']."\" readonly=\"readonly\" />".
		"<input type=\"hidden\" class=\"invent\" name=\"invent[16]\" value=\"".$fix['inventoryid']."\" readonly=\"readonly\" />".
		"<input type=\"hidden\" class=\"descrrp\" name=\"descrrp\" value=\"".$fix['rrp']."\" readonly=\"readonly\" />".
        "<input type=\"hidden\" class=\"desccost\" name=\"desccost\" value=\"".$fix['cost']."\" readonly=\"readonly\" /></td>"; 

// Webbing
echo"<td><input type=\"hidden\" class=\"webbing\" name=\"webbing[16]\" value=\"\" readonly=\"readonly\" /></td>";   

// Colours
echo"<td><input type=\"hidden\" class=\"colour\" name=\"colour[16]\" value=\"\" readonly=\"readonly\" /></td>";
     	
// Paint and Powder
echo"<td><input type=\"hidden\" name=\"paint[16]\" value=\"\" readonly=\"readonly\" /></td>";

// Unit of Measurement
echo "<td><input type=\"text\" name=\"uom[16]\" readonly=\"readonly\" value=\"".$fix['uom']."\"></td>";
}
else { echo " ";}
		}

// Unit Quantity	
echo "<td><input type=\"text\" class=\"qtylen\" name=\"qty[16]\" value=\"{$getQty[16]}\"></td>";

// Length or Width
echo "<td><input type=\"hidden\" name=\"slength[16]\" value=\"{$getLength[16]}\" readonly=\"readonly\" /></td>";

// Total RRP
echo "<td><input type=\"text\" class=\"rrp\" readonly=\"readonly\" name=\"rrp[16]\" value=\"{$getRRP[16]}\"><input type=\"hidden\" class=\"cst\" name=\"cst[]\" value=\"{$getCost[16]}\"></td></tr>";
// ***************************** Post Fixing to Concrete ********************************************//
echo "<tr><td><input type=\"hidden\" name=\"id[17]\" value=\"{$getCFID[17]}\" />".$getDesc[17];	
		foreach($fixs as $fix) {
		if ($fix['cf_id'] == $getID[17]) {     		
		echo "<input type=\"hidden\" class=\"desc\" name=\"desc[17]\" value=\"".$fix['description']."\" readonly=\"readonly\" />".
		"<input type=\"hidden\" class=\"invent\" name=\"invent[17]\" value=\"".$fix['inventoryid']."\" readonly=\"readonly\" />".
		"<input type=\"hidden\" class=\"descrrp\" name=\"descrrp\" value=\"".$fix['rrp']."\" readonly=\"readonly\" />".
        "<input type=\"hidden\" class=\"desccost\" name=\"desccost\" value=\"".$fix['cost']."\" readonly=\"readonly\" /></td>"; 

// Webbing
echo"<td><input type=\"hidden\" class=\"webbing\" name=\"webbing[17]\" value=\"\" readonly=\"readonly\" /></td>";   

// Colours
echo"<td><input type=\"hidden\" class=\"colour\" name=\"colour[17]\" value=\"\" readonly=\"readonly\" /></td>";
     	
// Paint and Powder
echo"<td><input type=\"hidden\" name=\"paint[17]\" value=\"\" readonly=\"readonly\" /></td>";

// Unit of Measurement
echo "<td><input type=\"text\" name=\"uom[17]\" readonly=\"readonly\" value=\"".$fix['uom']."\"></td>";
}
else { echo " ";}
		}

// Unit Quantity	
echo "<td><input type=\"text\" class=\"qtylen\" name=\"qty[17]\" value=\"{$getQty[17]}\"></td>";

// Length or Width
echo "<td><input type=\"hidden\" name=\"slength[17]\" value=\"{$getLength[17]}\" readonly=\"readonly\" /></td>";

// Total RRP
echo "<td><input type=\"text\" class=\"rrp\" readonly=\"readonly\" name=\"rrp[17]\" value=\"{$getRRP[17]}\"><input type=\"hidden\" class=\"cst\" name=\"cst[17]\" value=\"{$getCost[17]}\"></td></tr>";
// ***************************** Additional Fixings to Stabilize Columns ********************************************//
echo "<tr><td><input type=\"hidden\" name=\"id[18]\" value=\"{$getCFID[18]}\" />".$getDesc[18];	
		foreach($fixs as $fix) {
		if ($fix['cf_id'] == $getID[18]) {     		
		echo "<input type=\"hidden\" class=\"desc\" name=\"desc[18]\" value=\"".$fix['description']."\" readonly=\"readonly\" />".
		"<input type=\"hidden\" class=\"invent\" name=\"invent[18]\" value=\"".$fix['inventoryid']."\" readonly=\"readonly\" />".
		"<input type=\"hidden\" class=\"descrrp\" name=\"descrrp\" value=\"".$fix['rrp']."\" readonly=\"readonly\" />".
        "<input type=\"hidden\" class=\"desccost\" name=\"desccost\" value=\"".$fix['cost']."\" readonly=\"readonly\" /></td>"; 

// Webbing
echo"<td><input type=\"hidden\" class=\"webbing\" name=\"webbing[18]\" value=\"\" readonly=\"readonly\" /></td>";   

// Colours
echo"<td><input type=\"hidden\" class=\"colour\" name=\"colour[18]\" value=\"\" readonly=\"readonly\" /></td>";
     	
// Paint and Powder
echo"<td><input type=\"hidden\" name=\"paint[18]\" value=\"\" readonly=\"readonly\" /></td>";

// Unit of Measurement
echo "<td><input type=\"text\" name=\"uom[18]\" readonly=\"readonly\" value=\"".$fix['uom']."\"></td>";
}
else { echo " ";}
		}

// Unit Quantity	
echo "<td><input type=\"text\" class=\"qtylen\" name=\"qty[18]\" value=\"{$getQty[18]}\"></td>";

// Length or Width
echo "<td><input type=\"hidden\" name=\"slength[18]\" value=\"{$getLength[18]}\" readonly=\"readonly\" /></td>";

// Total RRP
echo "<td><input type=\"text\" class=\"rrp\" readonly=\"readonly\" name=\"rrp[18]\" value=\"{$getRRP[18]}\"><input type=\"hidden\" class=\"cst\" name=\"cst[18]\" value=\"{$getCost[18]}\"></td></tr>";
?>